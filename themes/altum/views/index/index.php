<?php defined('ALTUMCODE') || die() ?>
<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '208710860347560');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=208710860347560&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<div class="index-container">
    <div class="container">
        <?php display_notifications() ?>

        <div class="row">
            <div class="col">
                <div class="text-left">
                    <h1 class="index-header mb-4" data-aos="fade-down"><?= $this->language->index->header ?></h1>
                    <p class="index-subheader mb-5" data-aos="fade-down" data-aos-delay="300"><?= $this->language->index->subheader ?></p>

                    <div data-aos="fade-down" data-aos-delay="500">
                        <a href="<?= url('register') ?>" class="btn btn-primary index-button"><?= $this->language->index->sign_up ?></a>
                    </div>
                </div>
            </div>

            <div class="d-none d-lg-block col">
                <img src="<?= url(ASSETS_URL_PATH . 'images/illustration.png') ?>" class="index-image" />
            </div>
        </div>
    </div>
</div>

<div class="container margin-top-9">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= url(THEME_URL_PATH . 'assets/images/presentation.jpg') ?>" class="img-fluid" style="max-height: 580px;" />
        </div>

        <div class="col-md-6 d-flex align-items-center">
            <div>
                <span class="fa-stack fa-2x">
                  <i class="fas fa-circle fa-stack-2x text-primary-100"></i>
                  <i class="fas fa-globe fa-stack-1x text-primary"></i>
                </span>

                <h2 class="mt-3"><?= $this->language->index->presentation->header ?></h2>

                <p class="mt-3"><?= $this->language->index->presentation->subheader ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container margin-top-9">
    <div class="row reverse-flow">
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <span class="fa-stack fa-2x">
                  <i class="fas fa-circle fa-stack-2x text-primary-100"></i>
                  <i class="fas fa-users fa-stack-1x text-primary"></i>
                </span>

                <h2 class="mt-3"><?= $this->language->index->presentation2->header ?></h2>

                <p class="mt-3"><?= $this->language->index->presentation2->subheader ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <img src="<?= url(THEME_URL_PATH . 'assets/images/presentation2.jpg') ?>" class="img-fluid" style="max-height: 580px;" />
        </div>
    </div>
</div>

<div class="container margin-top-9">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= url(THEME_URL_PATH . 'assets/images/presentation3.jpg') ?>" class="img-fluid" style="max-height: 580px;" />
        </div>

        <div class="col-md-6 d-flex align-items-center">
            <div>
                <span class="fa-stack fa-2x">
                  <i class="fas fa-circle fa-stack-2x text-primary-100"></i>
                  <i class="fas fa-link fa-stack-1x text-primary"></i>
                </span>

                <h2 class="mt-3"><?= $this->language->index->presentation3->header ?></h2>

                <p class="mt-3"><?= $this->language->index->presentation3->subheader ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container margin-top-9">
    <div class="row reverse-flow">
        <div class="col-md-6 d-flex align-items-center">
            <div>
                <span class="fa-stack fa-2x">
                  <i class="fas fa-circle fa-stack-2x text-primary-100"></i>
                  <i class="fas fa-paint-brush fa-stack-1x text-primary"></i>
                </span>

                <h2 class="mt-3"><?= $this->language->index->presentation4->header ?></h2>

                <p class="mt-3"><?= $this->language->index->presentation4->subheader ?></p>
            </div>
        </div>

        <div class="col-md-6">
            <img src="<?= url(THEME_URL_PATH . 'assets/images/presentation4.jpg') ?>" class="img-fluid" style="max-height: 580px;" />
        </div>
    </div>
</div>

<div class="container margin-top-9">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= url(THEME_URL_PATH . 'assets/images/presentation5.jpg') ?>" class="img-fluid" style="max-height: 580px;" />
        </div>

        <div class="col-md-6 d-flex align-items-center">
            <div>
                <span class="fa-stack fa-2x">
                  <i class="fas fa-circle fa-stack-2x text-primary-100"></i>
                  <i class="fas fa-chart-bar fa-stack-1x text-primary"></i>
                </span>

                <h2 class="mt-3"><?= $this->language->index->presentation5->header ?></h2>

                <p class="mt-3"><?= $this->language->index->presentation5->subheader ?></p>
            </div>
        </div>
    </div>
</div>

<div class="container margin-top-7">
    <!-- <div class="text-center margin-bottom-6">
        <h2><?= $this->language->index->pricing->header ?></h2>

        <p class="text-muted"><?= $this->language->index->pricing->subheader ?></p>
    </div> -->

    <?= $this->views['packages'] ?>
</div>


<?php ob_start() ?>
<script src="<?= url(ASSETS_URL_PATH . 'js/libraries/lozad.min.js') ?>"></script>

<script>

    /* Lazy loading */
    const observer = lozad(); observer.observe();
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
