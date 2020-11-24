<?php defined('ALTUMCODE') || die() ?>

<?php require THEME_PATH . 'views/partials/ads_header.php' ?>

<div class="container">
    <nav aria-label="breadcrumb">
        <small>
            <ol class="custom-breadcrumbs">
                <li><a href="<?= url() ?>"><?= $this->language->index->breadcrumb ?></a> <i class="fa fa-angle-right"></i></li>
                <li><a href="<?= url('pages') ?>"><?= $this->language->pages->index->breadcrumb ?></a> <i class="fa fa-angle-right"></i></li>
                <li class="active" aria-current="page"><?= $this->language->pages->pages_category->breadcrumb ?></li>
            </ol>
        </small>
    </nav>

    <div class="d-flex justify-content-between">
        <div class="d-flex flex-row align-items-baseline">
            <?php if(!empty($data->pages_category->icon)): ?>
                <div class="mr-3">
                    <i class="<?= $data->pages_category->icon ?> fa-2x text-muted"></i>
                </div>
            <?php endif ?>

            <h1><?= $data->pages_category->title ?></h1>
        </div>

        <div class="d-print-none col-auto p-0 d-flex align-items-center">
            <?php if(\Altum\Middlewares\Authentication::is_admin()): ?>
                <?= get_admin_options_button('pages_category', $data->pages_category->pages_category_id) ?>
            <?php endif ?>
        </div>
    </div>
    <p class="text-muted"><?= $data->pages_category->description ?></p>

    <?php if($data->pages_result->num_rows): ?>
    <div class="mt-5">
        <div class="row">
            <?php while($row = $data->pages_result->fetch_object()): ?>

            <div class="col-12 col-md-6 mb-4">

                <div class="d-flex align-items-baseline">
                    <a href="<?= url('page/' . $row->url) ?>" class="h5 mr-1"><?= $row->title ?></a>
                    <small class="text-muted"><?= sprintf($this->language->pages->index->popular_pages->total_views, nr($row->total_views)) ?></small>
                </div>

                <span class="text-muted"><?= $row->description ?></span>
            </div>

            <?php endwhile ?>
        </div>
    </div>
    <?php endif ?>
</div>



