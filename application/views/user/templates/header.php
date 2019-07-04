<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Catamaran&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/header.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/menu.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/classes.css">
    <!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="<?= base_url(); ?>/assets/js/html2canvas.js"></script>
    <script src="<?= base_url(); ?>/assets/js/jspdf.min.js"></script>
    <script>
        function toPDF() {
            console.log('toPDF function is activated');
            html2canvas(document.body,{
                onrendered:function(canvas) {
                    var img=canvas.toDataURL("image/png");
                    var doc = new jsPDF();
                    doc.addImage(img,'JPEG',20,20);
                    doc.save('test.pdf');
                }
            });
        }
    </script>
    <title>User</title>
</head>
<body class="color-text-back" onload="openTasteboard()">
    <div class="block-all">
        <div class="container container-change block-height-100">
            <!-- HEADER -->
            <div class="block-header block-height-9">
                <div class="float-left">
                    <a href="<?php echo base_url('home/index'); ?>">
                        <img class="header-logo" src="<?php echo base_url('home/index'); ?>../../../assets/img/logo.png">
                    </a>
                </div>
                <div class="float-left header-logo-click">
                    <a href="<?php echo base_url('admin/index'); ?>"></a>
                </div>
                <div class="float-right header-menu">
                    <div class="">
                        <button type="button" class="color-text button" onclick="showUserMenu()">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
			</div>
            <!-- BODY -->
            <div id="mobile-user-menu" class="row d-sm-none color-text-back"> <!-- mobile version -->
                <div class="col-sm-12">
                    <button class="button color-text-back" onclick="displayPersonalInformation()">personal information</button><hr>
					<button class="button color-text-back" onclick="displayTasteboards()">tasteboards</button><hr>
					<button class="button color-text-back" onclick="displayRecipes()">recipes</button><hr>
					<button class="button color-text-back" onclick="displayAppInformation()">app information</button><hr>
					<a class="button color-text-back" href="<?php echo base_url(); ?>login/logout_user">log out</a><hr>
                </div>
            </div>  
            <!-- <div class="container block-height-88 clearfix"> -->
            <div class="row block-height-87 clearfix p-2">
                <div class="col-sm-12 col-md-12">