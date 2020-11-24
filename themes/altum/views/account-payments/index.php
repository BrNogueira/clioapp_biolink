<?php defined('ALTUMCODE') || die() ?>

<header class="header pb-0">
    <div class="container">
        <?= $this->views['account_header'] ?>
    </div>
</header>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="container pt-5">

    <?php display_notifications() ?>

    <h2 class="h3"><?= $this->language->account_payments->header ?></h2>
    <p class="text-muted"><?= $this->language->account_payments->subheader ?></p>

    <?php if($data->payments_result->num_rows): ?>
        <div class="table-responsive table-custom-container">
            <table class="table table-custom">
                <thead>
                <tr>
                    <th><?= $this->language->account_payments->payments->nr ?></th>
                    <th><?= $this->language->account_payments->payments->type ?></th>
                    <th></th>
                    <th><?= $this->language->account_payments->payments->package_id ?></th>
                    <th><?= $this->language->account_payments->payments->email ?></th>
                    <th><?= $this->language->account_payments->payments->name ?></th>
                    <th><?= $this->language->account_payments->payments->amount ?></th>
                    <th><?= $this->language->account_payments->payments->date ?></th>
                    <?php if($this->settings->business->invoice_is_enabled): ?>
                    <th></th>
                    <?php endif ?>
                </tr>
                </thead>
                <tbody>

                <?php $nr = 1; while($row = $data->payments_result->fetch_object()): ?>

                    <?php
                    switch($row->processor) {
                        case 'STRIPE':
                            $row->processor = '<span data-toggle="tooltip" title="' . $this->language->admin_payments->table->stripe .'"><i class="fab fa-stripe icon-stripe"></i></span>';
                            break;

                        case 'PAYPAL':
                            $row->processor = '<span data-toggle="tooltip" title="' . $this->language->admin_payments->table->paypal .'"><i class="fab fa-paypal icon-paypal"></i></span>';
                            break;
                    }
                    ?>

                    <tr>
                        <td class="text-muted"><?= $nr++ ?></td>
                        <td><?= $row->type == 'ONE-TIME' ? '<span data-toggle="tooltip" title="' . $row->type . '"><i class="fa fa-hand-holding-usd"></i></span>' : '<span data-toggle="tooltip" title="' . $row->type . '"><i class="fa fa-sync-alt"></i></span>' ?></td>
                        <td><?= $row->processor ?></td>
                        <td><?= (new \Altum\Models\Package())->get_package_by_id($row->package_id)->name ?></td>
                        <td><?= $row->email ?></td>
                        <td><?= $row->name ?></td>
                        <td><span class="text-success"><?= $row->amount ?></span> <?= $row->currency ?></td>
                        <td class="text-muted"><span data-toggle="tooltip" title="<?= \Altum\Date::get($row->date, true) ?>"><?= \Altum\Date::get($row->date) ?></span></td>
                        <?php if($this->settings->business->invoice_is_enabled): ?>
                        <td>
                            <a href="<?= url('invoice/' . $row->id) ?>">
                                <span data-toggle="tooltip" title="<?= $this->language->account_payments->payments->invoice ?>"><i class="fa fa-file-invoice"></i></span>
                            </a>
                        </td>
                        <?php endif ?>
                    </tr>
                <?php endwhile ?>

                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted"><?= $this->language->account_payments->info_message->no_payments ?></p>
    <?php endif ?>
</section>
