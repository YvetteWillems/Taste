
					<!-- PHP DATA -->
					<?php
						$user_id = $this->session->userdata('user')['user_id'];
						if(isset($_SESSION['message'])){
							echo $_SESSION['message']; 
                        }
                        // var_dump($ingredients);
					?>
    
                <div class="row block-height-100">
					<!-- left div / mobile div -->
                    <div class="col-md-8 col-sm-12 left-box block-height-100 overflow-hide">			
						<div class="row"><div class="col-sm-12 pt-2">
							<div id="" class="admin-content-block-all viewport-height-78">	
                                <h3><b>Ingredients</b></h3>
                                <div class="admin-content-block">
                                    <?php foreach($ingredients as $ingredient){ ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p onclick="showIngredientOptions(<?= $ingredient['id']; ?>)" class="click">
                                                    <?= $ingredient['igr_name']; ?> 
                                                    <i>- click for details</i>
                                                    <!-- <i class="fas fa-angle-down"></i> -->
                                                </p>
                                                <hr>
                                            </div>
                                        </div>
                                        <!-- DETAILS -->
                                        <div id="<?= $ingredient['id']; ?>" style="display:none;" class="click tasteboard-details mb-1">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="fs16"><?= $ingredient['igr_description']; ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <a href="<?= base_url('admin/readIngredient/') . $ingredient['id']; ?>" class="button color-text">see more</a><br>    
                                                </div>
                                                <div class="col-sm-4 text-center">
                                                    <a href="<?= base_url('admin/editIngredient/') . $ingredient['id']; ?>" class="button color-text">edit</a><br>
                                                </div>
                                                <div class="col-sm-4 text-right">
                                                    <a href="<?= base_url('admin/deleteIngredient/') . $ingredient['id']; ?>" class="button color-text">delete</a>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    <?php } ?>
                                </div>
							</div>
						</div></div> 
					</div>
					
					<!-- right div -->
					<div id="large-menu" class="col-md-4 d-none d-md-block block-height-100"> <!-- desktop version -->
						<div class="row p-2 block-height-100">
							<!-- user menu // default hidden -->
							<div id="user-menu-large" class="col-sm-12 block-height-100 color-text-back"> <!-- user menu -->
								<div class="block-height-100 p-3">
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/ingredients">ingredients</a><hr>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>admin/addIngredient">add ingredients</a><hr>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout_user">log out</a><hr>
								</div>
							</div>
						</div>
					</div>
                </div>
				<!-- hier sluit dit index blok -->
			</div>   
        </div>







    <script>
        showIngredientOptions = (id) => {
            var details = document.getElementById(id);
            if(details.style.display == "none"){
                details.style.display = "block";
            } else {
                details.style.display = "none"
            }            
        }
    </script>
</body>
</html>