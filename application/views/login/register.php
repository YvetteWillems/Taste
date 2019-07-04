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
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/classes.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
    <title>Login</title>
</head>
<body class="color-text-back">
    <div class="block-all">
        <div class="container container-change block-height-100">
            <!-- HEADER -->
            <div class="block-header block-height-9">
                <div class="float-left">
                    <a href="<?php echo base_url('login/index'); ?>">
                        <img class="header-logo" src="<?php echo base_url('home/index'); ?>../../../assets/img/logo.png">
                    </a>
                </div>
                <div class="float-left header-logo-click">
                    <a href="<?php echo base_url('login/index'); ?>"></a>
                </div>
			</div>
            <!-- BODY --> 
            <div class="row block-height-87 clearfix p-2">
                <div class="col-sm-12 col-md-12">
					<div class="row justify-content-center">
						<div class="col-sm-5 mt-5">
                            <?php echo form_open('register/register_user'); ?>
								<p>Register</p><br>
								<?php 
									echo validation_errors('<p class="color-text">'); 
								?>
									
                                <input type="text" class="color-input color-text-back input-login" name="firstname" placeholder="First Name"><br><br>
                                <input type="text" class="color-input color-text-back input-login" name="lastname" placeholder="Last Name"><br><br>
                                <input type="text" class="color-input color-text-back input-login" name="email" placeholder="Email"><br><br>
                                <input type="password" class="color-input color-text-back input-login" name="password" placeholder="Password"><br><br>
                                <input type="password" class="color-input color-text-back input-login" name="confirmpassword" placeholder="Confirm Password"><br><br>

                                <input type="submit" value="Register" class="button color-text mt-4"><br>
                                <a href="<?= base_url(); ?>index.php/login" class="color-text-back">Terug</a>
					    	</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>