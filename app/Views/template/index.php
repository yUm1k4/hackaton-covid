<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?= $title; ?></title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('/vendors_be') ?>/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('/vendors_be') ?>/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('/vendors_be') ?>/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('/vendors_be') ?>/styles/core.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/vendors_be') ?>/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/vendors_be') ?>/datatables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/vendors_be') ?>/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('/vendors_be') ?>/styles/style.css">

    <?= $this->renderSection('my-css') ?>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

	 <!-- Topbar / Header -->
	 <?= $this->include('template/topbar') ?>

	<!-- Sidebar -->
	<?= $this->include('template/sidebar') ?>


	 <!-- Main Container -->
	 <div class="main-container">
        <div class="pd-ltr-20 xs-pd-20-10 pb-20">

            <!-- Begin Contnet -->
            <?= $this->renderSection('main-content') ?>

            <div class="footer-wrap pd-20 mb-20 card-box">
                <small>Develop by Zainudin Abdullah - SEVIMA | Template by Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a></small>
            </div>
        </div>
    </div>

	
	<!-- js -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<script src="<?= base_url('/vendors_be') ?>/scripts/core.js"></script>
	<script src="<?= base_url('/vendors_be') ?>/scripts/script.min.js"></script>
	<script src="<?= base_url('/vendors_be') ?>/scripts/process.js"></script>
	<script src="<?= base_url('/vendors_be') ?>/scripts/layout-settings.js"></script>

	<!-- Datatable -->
    <script src="<?= base_url('/vendors_be') ?>/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('/vendors_be') ?>/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url('/vendors_be') ?>/datatables/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url('/vendors_be') ?>/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- Datatable Setting js -->
	<script src="<?= base_url() ?>/vendors_be/scripts/datatable-setting.js"></script>

	<script>
        // Jam yang ada di topbar
        function jam() {
            var waktu = new Date();
            var jam = waktu.getHours();
            var menit = waktu.getMinutes();
            var detik = waktu.getSeconds();

            if (jam < 10) {
                jam = "0" + jam;
            }
            if (menit < 10) {
                menit = "0" + menit;
            }
            if (detik < 10) {
                detik = "0" + detik;
            }
            var jam_div = document.getElementById('jam');
            jam_div.innerHTML = jam + ":" + menit + ":" + detik;
            setTimeout("jam()", 1000);
        }
        jam();
    </script>

    <?= $this->renderSection('my-js') ?>
</body>
</html>