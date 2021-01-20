<?php
session_start();
include "scripts/functions.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php $_ENV['_TITULO_SISTEM'] ?></title>

  <!-- Favicons -->
  <link href="<?= $_ENV['_BASE_URL_']?>assests/img/favicon.png" rel="icon">
  <link href="<?= $_ENV['_BASE_URL_']?>assests/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= $_ENV['_BASE_URL_']?>assests/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="<?= $_ENV['_BASE_URL_']?>assests/css/style.css" rel="stylesheet">
  <link href="<?= $_ENV['_BASE_URL_']?>assests/css/style-responsive.css" rel="stylesheet">
  <link href="<?= $_ENV['_BASE_URL_']?>assests/lib/sweetalert/sweetalert.css" rel="stylesheet">
  <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/jquery/jquery.min.js"></script>
  <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/sweetalert/sweetalert.min.js"></script>
  <?php if (Islogin()): ?>
    <link rel="stylesheet" type="text/css" href="<?= $_ENV['_BASE_URL_']?>assests/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="<?= $_ENV['_BASE_URL_']?>assests/lib/gritter/css/jquery.gritter.css" />
    <link href="<?= $_ENV['_BASE_URL_']?>assests/lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?= $_ENV['_BASE_URL_']?>assests/lib/bootstrap-datetimepicker/css/datetimepicker.css" />
    <link href="<?= $_ENV['_BASE_URL_']?>assests/lib/datatables/jquery.dataTables.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= $_ENV['_BASE_URL_']?>assests/lib/advanced-datatable/css/DT_bootstrap.css" />
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/chart-master/Chart.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/datatables/dataTables.buttons.min.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/datatables/buttons.flash.min.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/datatables/buttons.html5.min.js"></script>
    <script src="<?= $_ENV['_BASE_URL_']?>assests/lib/datatables/buttons.print.min.js"></script>
  <?php endif; ?>
  
</head>

<body>
  <?php if (Islogin()): ?>
    <section id="container">
      <?php include 'navbar.php'; ?>
      <?php include 'sidebar.php'; ?>
      <?php if($_GET['page'] <> 'dashboard'): ?>
      <section id="main-content">
        <section class="wrapper">
      <?php endif; ?>
  <?php endif; ?>