<?php defined('ALTUMCODE') || die() ?>

<header class="header pb-0">
    <div class="container">
        <?= $this->views['account_header'] ?>
    </div>
</header>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="container pt-5">

    <?php display_notifications() ?>

    <form action="" method="post" role="form">
        <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />

        <div class="row">
            <div class="col-12 col-md-4">
                <h2 class="h3"><?= $this->language->account->settings->header ?></h2>
                <p class="text-muted"><?= $this->language->account->settings->subheader ?></p>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="name"><?= $this->language->account->settings->name ?></label>
                    <input type="text" id="name" name="name" class="form-control" value="<?= $this->user->name ?>" />
                </div>

                <div class="form-group">
                    <label for="email"><?= $this->language->account->settings->email ?></label>
                    <input type="text" id="email" name="email" class="form-control" value="<?= $this->user->email ?>" />
                </div>

                <div class="form-group">
                    <label for="timezone"><?= $this->language->account->settings->timezone ?></label>
                    <select id="timezone" name="timezone" class="form-control">
                        <?php foreach(DateTimeZone::listIdentifiers() as $timezone) echo '<option value="' . $timezone . '" ' . ($this->user->timezone == $timezone ? 'selected' : null) . '>' . $timezone . '</option>' ?>
                    </select>
                    <small class="text-muted"><?= $this->language->account->settings->timezone_help ?></small>
                </div>
            </div>
        </div>

        <div class="margin-top-3"></div>

        <div class="row">
            <div class="col-12 col-md-4">
                <h2 class="h3"><?= $this->language->account->change_password->header ?></h2>
                <p class="text-muted"><?= $this->language->account->change_password->subheader ?></p>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="old_password"><?= $this->language->account->change_password->current_password ?></label>
                    <input type="password" id="old_password" name="old_password" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="new_password"><?= $this->language->account->change_password->new_password ?></label>
                    <input type="password" id="new_password" name="new_password" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="repeat_password"><?= $this->language->account->change_password->repeat_password ?></label>
                    <input type="password" id="repeat_password" name="repeat_password" class="form-control" />
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 col-md-4"></div>

            <div class="col">
                <button type="submit" name="submit" class="btn btn-primary"><?= $this->language->global->update ?></button>
            </div>
        </div>
    </form>

    <div class="margin-top-6 d-flex justify-content-between align-items-center">
        <div>
            <h2 class="h3"><?= $this->language->account->delete->header ?></h2>
            <p class="text-muted"><?= $this->language->account->delete->subheader ?></p>
        </div>

        <a href="<?= url('account/delete' . \Altum\Middlewares\Csrf::get_url_query()) ?>" class="btn btn-secondary" data-confirm="<?= $this->language->account->delete->confirm_message ?>"><?= $this->language->global->delete ?></a>
    </div>

</section>



