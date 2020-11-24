<?php defined('ALTUMCODE') || die() ?>

<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/Chart.bundle.min.js') ?>"></script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

<div class="mb-5 row justify-content-between">
    <div class="col-6 col-md-3 mb-5">
        <div class="card border-0 bg-gradient-primary text-white h-100 zoomer">
            <div class="card-body">
                <div class="card-title h4 mb-3"><?= $data->links->clicks_month ?> <i class="fa fa-chart-line fa-xs"></i></div>

                <p><?= $this->language->admin_index->display->clicks_month ?></p>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3 mb-5">
        <div class="card border-0 bg-gradient-danger text-white h-100 zoomer">
            <div class="card-body">
                <div class="card-title h4 mb-3"><?= $data->users->active_users_month ?> <i class="fa fa-users fa-xs"></i></div>

                <p><?= $this->language->admin_index->display->active_users_month ?></p>
            </div>
        </div>
    </div>

    <?php if($this->settings->payment->is_enabled): ?>
    <div class="col-6 col-md-3 mb-5">
        <div class="card border-0 bg-gradient-warning text-white h-100 zoomer">
            <div class="card-body pb-0">
                <p>
                    <span class="card-title h4"><?= $data->payments_month ?></span>

                    <?= $this->language->admin_index->display->payments_month ?>
                </p>
            </div>

            <div class="admin-widget-chart-container">
                <canvas id="payments"></canvas>
            </div>
        </div>
    </div>

    <?php ob_start() ?>
    <script>
        new Chart(document.getElementById('payments').getContext('2d'), {
            type: 'line',
            data: {
                labels: <?= $data->payments_month_chart['labels'] ?>,
                datasets: [{
                    data: <?= $data->payments_month_chart['payments'] ?? '[]' ?>,
                    backgroundColor: 'rgba(255, 255, 255, .5)',
                    borderColor: 'rgb(255, 255, 255)',
                    fill: true
                }]
            },
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        ticks: {
                            userCallback: (value, index, values) => {
                                if (Math.floor(value) === value) {
                                    return nr(value);
                                }
                            }
                        }
                    }],
                    xAxes: [{
                        display: false,
                        gridLines: false,
                    }]
                }
            }
        });
    </script>
    <?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>

    <div class="col-6 col-md-3 mb-5">
        <div class="card border-0 bg-gradient-info text-white h-100 zoomer">
            <div class="card-body pb-0">
                <p>
                    <span class="card-title h4"><?= $data->earnings_month ?> <?= $this->settings->payment->currency ?></span>

                    <?= $this->language->admin_index->display->earnings_month ?>
                </p>
            </div>

            <div class="admin-widget-chart-container">
                <canvas id="earnings"></canvas>
            </div>
        </div>
    </div>

    <?php ob_start() ?>
    <script>
        new Chart(document.getElementById('earnings').getContext('2d'), {
            type: 'line',
            data: {
                labels: <?= $data->payments_month_chart['labels'] ?>,
                datasets: [{
                    data: <?= $data->payments_month_chart['earnings'] ?? '[]' ?>,
                    backgroundColor: 'rgba(255, 255, 255, .5)',
                    borderColor: 'rgb(255, 255, 255)',
                    fill: true
                }]
            },
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                title: {
                    display: false
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        display: false,
                        gridLines: false,
                        ticks: {
                            userCallback: (value, index, values) => {
                                if (Math.floor(value) === value) {
                                    return nr(value);
                                }
                            }
                        }
                    }],
                    xAxes: [{
                        display: false,
                        gridLines: false,
                    }]
                }
            }
        });
    </script>
    <?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
    <?php endif ?>

    <div class="col-6 col-md-3 mb-5 mb-md-0 zoomer">
        <div class="card border-0 h-100">
            <div class="card-body">
                <div class="card-title h4 mb-3"><?= $data->links->clicks ?> <i class="fa fa-chart-line fa-xs"></i></div>

                <p><?= $this->language->admin_index->display->clicks ?></p>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3 mb-5 mb-md-0 zoomer">
        <div class="card border-0 h-100">
            <div class="card-body">
                <div class="card-title h4 mb-3"><?= $data->users->active_users ?>  <i class="fa fa-users fa-xs"></i></div>

                <p><?= $this->language->admin_index->display->active_users ?></p>
            </div>
        </div>
    </div>

    <?php if($this->settings->payment->is_enabled): ?>
    <div class="col-6 col-md-3 mb-5 mb-md-0 zoomer">
        <div class="card border-0 h-100">
            <div class="card-body">
                <div class="card-title h4 mb-3"><?= $data->payments->payments ?>  <i class="fa fa-dollar-sign fa-xs"></i></div>

                <p><?= $this->language->admin_index->display->payments ?></p>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3 mb-5 mb-md-0 zoomer">
        <div class="card border-0 h-100">
            <div class="card-body">
                <div class="card-title h4 mb-3"><span class="text-success"><?= $data->payments->earnings ?></span> <?= $this->settings->payment->currency ?></div>

                <p><?= $this->language->admin_index->display->earnings ?></p>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>

<div class="mb-5">
    <h1 class="h3"><?= $this->language->admin_index->users->header ?></h1>

    <?php $result = \Altum\Database\Database::$database->query("SELECT `user_id`, `name`, `email`, `active`, `date` FROM `users` ORDER BY `user_id` DESC LIMIT 5"); ?>
    <div class="table-responsive table-custom-container">
        <table class="table table-custom">
            <thead>
            <tr>
                <th><?= $this->language->admin_index->users->user ?></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_object()): ?>
                <tr>
                    <td>
                        <div class="d-flex">
                            <img src="<?= get_gravatar($row->email) ?>" class="user-avatar rounded-circle mr-3" alt="" />

                            <div class="d-flex flex-column">
                                <?= '<a href="' . url('admin/user-view/' . $row->user_id) . '">' . $row->name . '</a>' ?>

                                <span class="text-muted"><?= $row->email ?></span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column">
                            <div class="d-flex flex-column">
                                <div><?= $row->active ? '<span class="badge badge-pill badge-success"><i class="fa fa-check"></i> ' . $this->language->global->active . '</span>' : '<span class="badge badge-pill badge-warning"><i class="fa fa-eye-slash"></i> ' . $this->language->global->disabled . '</span>' ?></div>
                                <div><small class="text-muted" data-toggle="tooltip" title="<?= \Altum\Date::get($row->date, 1) ?>"><?= \Altum\Date::get($row->date, 2) ?></small></div>
                            </div>
                        </div>
                    </td>
                    <td><?= get_admin_options_button('user', $row->user_id) ?></td>
                </tr>
            <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>


<?php $result = \Altum\Database\Database::$database->query("SELECT `payments`.*, `users`.`name` AS `user_name` FROM `payments` LEFT JOIN `users` ON `payments`.`user_id` = `users`.`user_id` ORDER BY `id` DESC LIMIT 5"); ?>
<?php if($result->num_rows): ?>
    <div class="mb-5">
        <h1 class="h3"><?= $this->language->admin_index->payments->header ?></h1>

        <div class="table-responsive table-custom-container">
            <table class="table table-custom">
                <thead>
                <tr>
                    <th><?= $this->language->admin_index->payments->payment ?></th>
                    <th><?= $this->language->admin_index->payments->user ?></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php while($row = $result->fetch_object()): ?>

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
                        <td>
                            <div class="d-flex flex-column">
                                <?= $row->name ?>
                                <span class="text-muted"><?= $row->email ?></span>
                            </div>
                        </td>
                        <td>
                            <?= '<a href="' . url( 'admin/user-view/' . $row->user_id) . '">' . $row->user_name . '</a>' ?>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <div><span class="text-success"><?= $row->amount ?></span> <?= $row->currency ?></div>
                                <div><small class="text-muted" data-toggle="tooltip" title="<?= \Altum\Date::get($row->date, 1) ?>"><?= \Altum\Date::get($row->date, 2) ?></small><div>
                                    </div>
                        </td>
                        <td><?= $row->type == 'ONE-TIME' ? '<span data-toggle="tooltip" title="' . $this->language->admin_payments->table->one_time . '"><i class="fa fa-hand-holding-usd"></i></span>' : '<span data-toggle="tooltip" title="' . $this->language->admin_payments->table->recurring . '"><i class="fa fa-sync-alt"></i></span>' ?></td>
                        <td><?= $row->processor ?></td>
                    </tr>
                <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif ?>

<!-- <div class="mb-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th>⚡️ Version</th>
                        <td><?= PRODUCT_VERSION ?></td>
                    </tr>
                    <tr>
                        <th>📚 Documentation</th>
                        <td><a href="<?= PRODUCT_DOCUMENTATION_URL ?>" target="_blank">Check Documentation</a></td>
                    </tr>
                    <tr>
                        <th>👁 Check for updates</th>
                        <td><a href="<?= PRODUCT_URL ?>" target="_blank">Codecanyon</a></td>
                    </tr>
                    <tr>
                        <th>💼 More work of mine</th>
                        <td><a href="https://codecanyon.net/user/altumcode/portfolio" target="_blank">Envato // Codecanyon</a></td>
                    </tr>
                    <tr>
                        <th>🔥 Official website</th>
                        <td><a href="https://altumcode.io/" target="_blank">AltumCode.io</a></td>
                    </tr>
                    <tr>
                        <th>📈 Latest project</th>
                        <td><a href="https://66analytics.com/" target="_blank">66Analytics</a></td>
                    </tr>
                    <tr>
                        <th>🐦 Twitter Updates <br /><small>No support on twitter</small></th>
                        <td><a href="https://twitter.com/altumcode" target="_blank">@altumcode</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div> -->
