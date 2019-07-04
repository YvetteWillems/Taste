<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/header.css">
    <!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>User</title>
</head>
<body>
    <div class="block-all">
        <div class="container block-height-100">
            <div class="row p-2 block-height-100">
                <div class="block-all-inside col-sm-12 block-height-100 test">
                    <!-- HEADER -->
                    <div class="block-header-mobile row">
                        <div class="col-xs-10">logo</div>
						<div class="col-xs-2 header-mobile-menu">
							<div class="btn-group">
								<button type="button" style="border:none;background-color:transparent;" class="color-text-neg" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fas fa-bars"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right user-dropdown">
									<div class="user-dropdown">
										<a class="dropdown-item" href="<?php echo base_url(); ?>usermenu/personal">personal information</a>
										<a class="dropdown-item" href="<?php echo base_url(); ?>usermenu/tasteboards">tasteboards</a>
                                        <a class="dropdown-item" href="<?php echo base_url(); ?>usermenu/recipes">recipes</a>
                                        <a class="dropdown-item" href="<?php echo base_url(); ?>usermenu/information">app information</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?php echo base_url(); ?>login/logout_user">log out</a>
									</div>
								</div>
							</div>
						</div>
					</div>