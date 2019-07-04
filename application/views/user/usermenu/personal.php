<!-- <?php echo $this->session->userdata('user')['user_id']; ?> -->
                    <!-- BODY -->
                    <div class="container block-height-100 index-body">
                        <div id="extra-menu" class="row p-2">
                                <p><?php 
                                    $message = $this->session->flashdata('message');
                                    echo $message; 
                                ?></p>
                            <?php	echo validation_errors('<p class="color-text">'); ?>
                            <form action="<?= base_url('usermenu/update_user'); ?>" method="post">
                                    <input type="hidden" value="<?= $user_details[0]['id']; ?>" class="form-control" name="id">
                                    <label>Voornaam: </label>
                                    <input type="text" value="<?= $user_details[0]['usr_firstname']; ?>" class="color-input color-text-back" name="firstname">
                                    <label>Achternaam: </label>
                                    <input type="text" value="<?= $user_details[0]['usr_lastname']; ?>" class="color-input color-text-back" name="lastname">
                                    <label>E-mail: </label>
                                    <input type="hidden" value="<?= $user_details[0]['usr_email']; ?>" name="oldemail">
                                    <input type="text" value="<?= $user_details[0]['usr_email']; ?>" class="color-input color-text-back" name="email">
                                </div>
                    
                                <a href="<?php echo base_url().'home';?>"><input type="button" value="terug" class="button color-text"></a>
                                <input type="submit" value="update gegevens" class="button color-text">        
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>