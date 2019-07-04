
					<!-- PHP DATA -->
					<?php
						$user_id = $this->session->userdata('user')['user_id'];
						if(isset($_SESSION['message'])){
							echo $_SESSION['message']; 
						}
					?>
                <div class="row block-height-100">
					<!-- left div / mobile div -->
                    <div class="col-md-8 col-sm-12 left-box block-height-100 overflow-hide">			
						<div class="row"><div class="col-sm-12 pt-2">
							<div id="" class="admin-content-block-all viewport-height-78">	
                                <h3 class="float-left"><b><?= $ingredient['igr_name']; ?></b></h3>
                                <a href="<?= base_url('admin/editIngredient/') . $ingredient['id']; ?>" class="button color-text float-right pr-3"><b>edit ingredient</b></a><br>
                                <div class="clearfix"></div>
            
                                <div class="admin-content-block">    
                                    <p><b>Description:</b> <?= $ingredient['igr_description']; ?></p>
                                    <p><b>Line color:</b> <?= $ingredient['linecolor_name']; ?>
                                        <span class="ingredient-color" style="background-color:<?= $ingredient['linecolor_code']; ?>;"></span>
                                        <?= ' ('.$ingredient['linecolor_code'].')'; ?>
                                    </p>
                                    <p><b>Background color:</b> <?= $ingredient['backcolor_name']; ?>
                                        <span class="ingredient-color" style="background-color:<?= $ingredient['backcolor_code']; ?>;"></span>
                                        <?= ' ('.$ingredient['linecolor_code'].')'; ?>
                                    </p>
                                    <br>
                                    <!-- aroma's -->
                                    <p><b>Aromas:</b></p>
                                    <div class="admin-content-aromas"> 
                                        <p>   
                                        <?php foreach($ingredient as $key=>$value){ ?>
                                            <?php 
                                                if ($key == 'id' or 
                                                    $key == 'igr_name' or 
                                                    $key == 'igr_description' or 
                                                    $key == 'igr_linecolor' or 
                                                    $key == 'igr_backcolor' or 
                                                    $key == 'igr_img' or
                                                    $key == 'linecolor_name' or $key == 'linecolor_code' or
                                                    $key == 'backcolor_name' or $key == 'backcolor_code'){
                                                    // do nothing
                                                } else {
                                                    echo ucwords($key).': '.$value.'<hr>'; 
                                                }
                                            ?>
                                        <?php } ?>
                                        </p>
                                    </div>
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
        
    </script>
</body>
</html>