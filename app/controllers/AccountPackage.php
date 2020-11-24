<?php

namespace Altum\Controllers;

use Altum\Database\Database;
use Altum\Logger;
use Altum\Middlewares\Authentication;
use Altum\Middlewares\Csrf;
use Altum\Models\Package;
use Altum\Models\User;
use Altum\Response;

class AccountPackage extends Controller {

    public function index() {

        Authentication::guard();

        /* Establish the account header view */
        $menu = new \Altum\Views\View('partials/account_header', (array) $this);
        $this->add_view_content('account_header', $menu->run());

        /* Prepare the View */
        $view = new \Altum\Views\View('account-package/index', (array) $this);

        $this->add_view_content('content', $view->run());

    }

    public function redeem_code() {
        Authentication::guard();

        if(!$this->settings->payment->is_enabled || !$this->settings->payment->codes_is_enabled) {
            redirect('account-package');
        }

        if(empty($_POST)) {
            redirect('account-package');
        }

        if(!Csrf::check()) {
            $_SESSION['error'][] = $this->language->global->error_message->invalid_csrf_token;
        }

        $_POST['code'] = Database::clean_string($_POST['code']);

        /* Make sure the discount code exists */
        $code = $this->database->query("SELECT * FROM `codes` WHERE `code` = '{$_POST['code']}' AND `type` = 'redeemable'")->fetch_object();

        if(!$code) {
            $_SESSION['error'][] = $this->language->account_package->error_message->code_invalid;
        }

        /* Make sure the package id exists and get details about it */
        $package = (new Package(['settings' => $this->settings]))->get_package_by_id($code->package_id);

        if(!$package) {
            $_SESSION['error'][] = $this->language->account_package->error_message->code_invalid;
        }

        /* Make sure the code was not used previously */
        if(Database::exists('id', 'redeemed_codes', ['user_id' => $this->user->user_id, 'code_id' => $code->code_id])) {
            $_SESSION['error'][] = $this->language->account_package->error_message->code_used;
        }

        /* Cancel current subscription */
        try {
            (new User(['settings' => $this->settings, 'user' => $this->user]))->cancel_subscription();
        } catch (\Exception $exception) {

            /* Output errors properly */
            if(DEBUG) {
                echo $exception->getCode() . '-' . $exception->getMessage();

                die();
            } else {

                $_SESSION['error'][] = $exception->getMessage();
                redirect('account-package');

            }
        }

        if(empty($_SESSION['error'])) {

            $package_expiration_date = (new \DateTime())->modify('+' . $code->days . ' days')->format('Y-m-d H:i:s');
            $package_settings = json_encode($package->settings);

            /* Update the user package */
            $stmt = $this->database->prepare("
                UPDATE
                    `users`
                SET
                    `package_id` = ?,
                    `package_expiration_date` = ?,
                    `package_settings` = ?
                WHERE
                    `user_id` = ?
            ");
            $stmt->bind_param(
                'ssss',
                $package->package_id,
                $package_expiration_date,
                $package_settings,
                $this->user->user_id
            );
            $stmt->execute();
            $stmt->close();

            /* Update the code usage */
            $this->database->query("UPDATE `codes` SET `redeemed` = `redeemed` + 1 WHERE `code_id` = {$code->code_id}");

            /* Add log for the redeemed code */
            Database::insert('redeemed_codes', [
                'code_id'   => $code->code_id,
                'user_id'   => $this->user->user_id,
                'date'      => \Altum\Date::$date
            ]);

            Logger::users($this->user->user_id, 'codes.redeemed_code=' . $code->code);

            /* Success */
            $_SESSION['success'][] = $this->language->account_package->success_message->code_redeemed;

            redirect('account-package');
        }
    }

    /* Ajax to check if redemption codes are available */
    public function code() {
        Authentication::guard();

        if(!Csrf::check('global_token')) {
            die();
        }

        if(!$this->settings->payment->is_enabled || !$this->settings->payment->codes_is_enabled) {
            die();
        }

        if(empty($_POST)) {
            die();
        }

        $_POST['code'] = Database::clean_string($_POST['code']);

        /* Make sure the discount code exists */
        $code = $this->database->query("SELECT * FROM `codes` WHERE `code` = '{$_POST['code']}' AND `redeemed` < `quantity` AND `type` = 'redeemable'")->fetch_object();

        if(!$code) {
            Response::json($this->language->account_package->error_message->code_invalid, 'error');
        }

        /* Make sure the package id exists and get details about it */
        $package = (new Package(['settings' => $this->settings]))->get_package_by_id($code->package_id);

        if(!$package) {
            Response::json($this->language->account_package->error_message->code_invalid, 'error');
        }

        /* Make sure the code was not used previously */
        if(Database::exists('id', 'redeemed_codes', ['user_id' => $this->user->user_id, 'code_id' => $code->code_id])) {
            Response::json($this->language->account_package->error_message->code_used, 'error');
        }

        Response::json(sprintf($this->language->account_package->success_message->code, '<strong>' . $package->name . '</strong>', '<strong>' . $code->days . '</strong>'), 'success', ['discount' => $code->discount]);
    }
}
