<?= $this->extend('template/index') ?>

<?= $this->section('main-content') ?>
    <div class="card-box pd-20 height-100-p mb-30">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img src="<?= base_url('vendors_be')?>/images/banner-img.png" alt="">
            </div>
            <div class="col-md-8">
                <h4 class="font-20 weight-500 mb-10 text-capitalize">
                    <?= salam(date('H:i')) ?>, <div class="weight-600 font-30 text-blue">Zainudin Abdullah!</div>                </h4>
                <p class="font-18 max-width-800">
                "Kenikmatan hidup paling nikmat di dunia ini adalah sehat karena apa pun yang kamu miliki di dunia ini tak akan kamu nikmati, jika kamu sakit" - Dani Kaizen
                </p>
            </div>
        </div>
    </div>

    <?= $this->include('dashboard/infoNumber') ?>


    <?= $this->include('dashboard/infoProv') ?>

<?= $this->endSection() ?>