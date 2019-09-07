<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Evaluation System - <?= $subtitle ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/jquery.dataTables.min.css'); ?>">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/site.css'); ?>">
    
    <script src="<?= base_url('assets/js/Chart.bundle.js');?>"></script>
</head>

<body>
    <nav class="navbar nav-header navbar-light bg-light">
        <div class="container-fluid">
            <div class="row" style="width:100%;">
                <div class="col col-md-10 ">
                    <a class="navbar-brand" href="<?= base_url(); ?>">Evaluate System</a>
                </div>
                <div class="col col-md-2 login-bar">
                <?php if (isset($user_detail)) : ?>
                    <span class="login-name">
                        <?= $user_detail['name']; ?>
                    </span>                    
                    <a href="<?php echo base_url('/logout'); ?>">Logout</a>
                <?php endif; ?>
                </div>
            </div>
        </div>
       
    </nav>
    <div class="container">