<?php defined('ALTUMCODE') || die() ?>

<header class="header pb-0">
    <div class="container">
        <?= $this->views['account_header'] ?>
    </div>
</header>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<section class="container pt-5">

    <?php display_notifications() ?>

    <h2 class="h3"><?= $this->language->account_logs->header ?></h2>
    <p class="text-muted"><?= $this->language->account_logs->subheader ?></p>

    <?php if($data->logs_result->num_rows): ?>
        <div class="table-responsive table-custom-container">
            <table class="table table-custom">
                <thead>
                <tr>
                    <th><?= $this->language->account_logs->logs->type ?></th>
                    <th><?= $this->language->account_logs->logs->ip ?></th>
                    <th><?= $this->language->account_logs->logs->date ?></th>
                </tr>
                </thead>
                <tbody>

                <?php $nr = 1; while($row = $data->logs_result->fetch_object()): ?>
                    <tr>
                        <td><?= $row->type ?></td>
                        <td><?= $row->ip ?></td>
                        <td class="text-muted"><?= \Altum\Date::get($row->date, true) ?></td>
                    </tr>
                <?php endwhile ?>

                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted"><?= $this->language->account_logs->info_message->no_logs ?></p>
    <?php endif ?>

</section>
