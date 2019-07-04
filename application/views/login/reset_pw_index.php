<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/css/style.css">
    <!-- jquery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Reset Password</title>
</head>
<body>
	<?php
		// $user_id = 1;
	
		if(isset($message)){
			echo $message;
		} 
	?>
    <div class="block-all">
        <div class="container block-height-100">
            <div class="row p-2 block-height-100">
                <div class="block-all-inside col-sm-12 block-height-100 test">
                    <!-- HEADER -->
                    <div class="block-header-mobile row">
                        <div class="col-xs-10">logo</div>
                        <div class="col-xs-2 header-mobile-menu"><i class="fas fa-bars"></i></div>
					</div>
                    <!-- BODY -->
                    <div class="container block-height-100 index-body">
                        <!-- INPUT -->
                        <div class="row justify-content-center mb-2">                        
                        <?php echo form_open('login/reset_password'); ?>
                            <p>Wachtwoord herstellen</p>
                            <p>vul uw email adres in om uw wachtwoord te herstellen.</p>
                                <?php echo validation_errors('<p class="color-text">'); 
                                ?>
                                <?php if (isset($success)) { ?>
                                    <p><?php echo $success; ?></p>
                                <?php } ?>
                                <?php if (isset($failed)) { ?>
                                    <p><?php echo $failed; ?></p>
                                <?php } ?>

                            <input type="email" class="color-input color-text-back input-login" name="veri_email" placeholder="email">

                            <input type="submit" value="naar herstellen" class="ingredient-menu-button color-text mt-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>