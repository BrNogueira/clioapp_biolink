<?php defined('ALTUMCODE') || die() ?>

<header class="header pb-0">
    <div class="container">
        <?= $this->views['account_header'] ?>
    </div>
</header>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="container pt-5">

    <?php display_notifications() ?>

    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
        <div>
            <h2 class="h3"><?= $this->language->account_package->header ?></h2>
        </div>

        <?php if($this->settings->payment->is_enabled): ?>
            <div class="col-auto p-0">
                <?php if($this->user->package_id == 'free'): ?>
                    <a href="<?= url('package/upgrade') ?>" class="btn btn-primary rounded-pill"><i class="fa fa-arrow-up"></i> <?= $this->language->account->package->upgrade_package ?></a>
                <?php elseif($this->user->package_id == 'trial'): ?>
                    <a href="<?= url('package/renew') ?>" class="btn btn-primary rounded-pill"><i class="fa fa-sync-alt"></i> <?= $this->language->account->package->renew_package ?></a>
                <?php else: ?>
                    <a href="<?= url('package/renew') ?>" class="btn btn-primary rounded-pill"><i class="fa fa-sync-alt"></i> <?= $this->language->account->package->renew_package ?></a>
                <?php endif ?>
            </div>
        <?php endif ?>
    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <h2 class="h3"><?= $this->user->package->name ?></h2>

            <?php if($this->user->package_id != 'free'): ?>
                <p class="text-muted">
                    <?= sprintf(
                        $this->user->payment_subscription_id ? $this->language->account_package->package->renews : $this->language->account_package->package->expires,
                        '<strong>' . \Altum\Date::get($this->user->package_expiration_date, 2) . '</strong>'
                    ) ?>
                </p>
            <?php endif ?>
        </div>

        <div class="col">
            <ul class="list-style-none">

                <?php foreach(['no_ads', 'removable_branding', 'custom_branding', 'custom_colored_links', 'statistics', 'google_analytics', 'facebook_pixel','custom_backgrounds', 'verified', 'scheduling'] as $row): ?>
                <li class="d-flex align-items-baseline mb-2">
                    <i class="fa fa-sm mr-3 <?= $this->user->package_settings->{$row} ? 'fa-check-circle text-success' : 'fa-times-circle text-muted' ?>"></i>
                    <div>
                        <?= $this->language->global->package_settings->{$row} ?>
                    </div>
                </li>
                <?php endforeach ?>

                <li class="d-flex align-items-baseline mb-2">
                    <i class="fa fa-check-circle fa-sm mr-3 text-success"></i>
                    <div>
                        <?php if($this->user->package_settings->projects_limit == -1): ?>
                            <?= $this->language->global->package_settings->unlimited_projects_limit ?>
                        <?php else: ?>
                            <?= sprintf($this->language->global->package_settings->projects_limit, '<strong>' . nr($this->user->package_settings->projects_limit) . '</strong>') ?>
                        <?php endif ?>
                    </div>
                </li>

                <li class="d-flex align-items-baseline mb-2">
                    <i class="fa fa-check-circle fa-sm mr-3 text-success"></i>
                    <div>
                        <?php if($this->user->package_settings->biolinks_limit == -1): ?>
                            <?= $this->language->global->package_settings->unlimited_biolinks_limit ?>
                        <?php else: ?>
                            <?= sprintf($this->language->global->package_settings->biolinks_limit, '<strong>' . nr($this->user->package_settings->biolinks_limit) . '</strong>') ?>
                        <?php endif ?>
                    </div>
                </li>

                <li class="d-flex align-items-baseline mb-2">
                    <i class="fa fa-check-circle fa-sm mr-3 text-success"></i>
                    <div>
                        <?php if($this->user->package_settings->links_limit == -1): ?>
                            <?= $this->language->global->package_settings->unlimited_links_limit ?>
                        <?php else: ?>
                            <?= sprintf($this->language->global->package_settings->links_limit, '<strong>' . nr($this->user->package_settings->links_limit) . '</strong>') ?>
                        <?php endif ?>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <?php if($this->user->package_id != 'free' && $this->user->payment_subscription_id): ?>
        <div class="margin-top-6 d-flex justify-content-between">
            <div>
                <h2 class="h3"><?= $this->language->account_package->cancel->header ?></h2>
                <p class="text-muted"><?= $this->language->account_package->cancel->subheader ?></p>
            </div>

            <div class="col-auto">
                <a href="<?= url('account/cancelsubscription' . \Altum\Middlewares\Csrf::get_url_query()) ?>" class="btn btn-secondary" data-confirm="<?= $this->language->account_package->cancel->confirm_message ?>"><?= $this->language->account_package->cancel->cancel ?></a>
            </div>
        </div>
    <?php endif ?>

</section>
