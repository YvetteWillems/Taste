					<!-- PHP DATA -->
					<?php
						$user_id = $this->session->userdata('user')['user_id'];
                    ?>
                    <p><?php 
                        $message = $this->session->flashdata('message');
                        if(isset($message)){
                            echo $message;
                        }; 
                    ?></p>
                    <!-- BODY -->
                    <div class="container block-height-100 index-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <p>tasteboards:</p>
                                <?php foreach($user_tasteboards as $tasteboard){ ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p onclick="showTasteboardDetails(<?= $tasteboard['id']; ?>)" class="click"><?= $tasteboard['tst_name']; ?> <i class="fas fa-angle-down"></i></p>
                                            <!-- <p><?= $tasteboard['id']; ?></p> -->
                                        </div>
                                    </div>
                                    <!-- DETAILS -->
                                    <div id="<?= $tasteboard['id']; ?>" style="display:none;" class="click tasteboard-details">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="button color-text">make pdf</a><br>
                                                <p class="fs16">Choose which items on the right you want to include in this pdf.</p>
                                            </div>
                                            <div class="col-sm-6 fs16 pdf-options">
                                                <input type="radio" name="aroma" value=""> aroma's<br>
                                                <input type="radio" name="description" value=""> descriptions<br>
                                                <input type="radio" name="photo" value=""> photo's<br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">    
                                                <a href="<?= base_url('usermenu/editTasteboard/') . $tasteboard['id']; ?>" class="button color-text">edit</a><br>
                                                <a href="<?= base_url('usermenu/deleteTasteboard/') . $tasteboard['id']; ?>" class="button color-text">delete</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>         
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        showTasteboardDetails = (id) => {
            var details = document.getElementById(id);
            if(details.style.display == "none"){
                details.style.display = "block";
            } else {
                details.style.display = "none"
            }            
        }
    
    </script>