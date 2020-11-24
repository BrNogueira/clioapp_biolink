<?php defined('ALTUMCODE') || die() ?>

<div class="d-flex justify-content-between">
    <h1 class="h3"><i class="fa fa-xs fa-anchor text-gray-700"></i> <?= $this->language->admin_domain_create->header ?></h1>
</div>
<p class="text-muted"><?= $this->language->admin_domain_create->subheader ?></p>

<?php display_notifications() ?>

<div class="card border-0 shadow-sm mt-5">
    <div class="card-body">

        <form action="" method="post" role="form">
            <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" />

            <div class="form-group">
                <label><i class="fa fa-network-wired text-gray-700"></i> <?= $this->language->admin_domain_create->form->host ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <select name="scheme" class="appearance-none select-custom-altum form-control input-group-text">
                            <option value="https://">https://</option>
                            <option value="http://">http://</option>
                        </select>
                    </div>

                    <input type="text" class="form-control" name="host" placeholder="<?= $this->language->admin_domain_create->form->host_placeholder ?>" required="required" />
                </div>
                <small class="text-muted"><i class="fa fa-info-circle"></i> <?= $this->language->admin_domain_create->form->host_help ?></small>
            </div>

            <div class="mt-4">
                <button type="submit" name="submit" class="btn btn-primary"><?= $this->language->admin_domain_create->form->create ?></button>
            </div>
        </form>

    </div>
</div>

