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
                                <h3 class="float-left"><b>Add a new ingredient:</b></h3>
                                <!-- <a href="<?= base_url('admin/editIngredient/') . $ingredient['id']; ?>" class="button color-text float-right pr-3"><b>edit ingredient</b></a><br> -->
                                <div class="clearfix"></div>
            
                                <div class="admin-content-block"> 
                                <form action="<?= base_url('admin/addIngredientAction/'); ?>" method="post">
                                    <input type="hidden" value="<?= $ingredient['igr_img']; ?>" class="form-control" name="image">

                                    <p><b>Name:</b></p>
                                    <input type="text" class="color-input color-text-back" name="name"><br><br>    
                                
                                    <p><b>Description:</b></p>
                                    <textarea rows="4" cols="50" class="color-input color-text-back" name="description" id="editor">
                                    </textarea><br><br>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <!-- <p class="fs14"> When choosing a line and background color for the ingredient, think about how it will influence
                                                the readability. Choose a combination of a light and dark color, rather than two light or two 
                                                dark colors. 
                                            </p> -->
                                            <!-- linecolor: -->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p><b>Line color:</b></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="color-input color-text-back" onchange="changeLinecolor(event)" name="line_color">
                                                        <?php foreach($colors as $color){ ?>
                                                            <option value="<?= $color['id']; ?>">
                                                                <p><?= $color['clr_name']; ?>
                                                                <span class="ingredient-color" style="background-color:<?= $color['clr_code']; ?>;"></span></p>                                                
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- backcolor: -->
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <p><b>Background color:</b></p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <select class="color-input color-text-back" onchange="changeBackcolor(event)" name="back_color">
                                                        <?php foreach($colors as $color){ ?>
                                                            <option value="<?= $color['id']; ?>">
                                                                <p><?= $color['clr_name']; ?>
                                                                <span class="ingredient-color" style="background-color:<?= $color['clr_code']; ?>;"></span></p>                                                
                                                            </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <p class="fs14"> When choosing a line and background color for the ingredient, think about how it will influence
                                                the readability. Choose a combination of a light and dark color, rather than two light colors or two 
                                                dark colors. Also, stay away from dark background colors. 
                                                On the right is a preview of the colors you are selecting. 
                                            </p>
                                        </div>
                                            <!-- example: -->
                                        <div class="col-sm-3">
                                            <div id="example" class="example-colors float-right mr-2 text-center pt-4 color-text-back">
                                                <p>text</p>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- aroma's -->
                                    <p><b>Aromas:</b></p>
                                    <?php foreach($ingredient as $key=>$value){ 
                                        if ($key == 'id' or 
                                            $key == 'igr_name' or 
                                            $key == 'igr_description' or 
                                            $key == 'igr_linecolor' or 
                                            $key == 'igr_backcolor' or 
                                            $key == 'igr_img' or
                                            $key == 'linecolor_name' or $key == 'linecolor_code' or
                                            $key == 'backcolor_name' or $key == 'backcolor_code'){
                                        } else { 
                                        ?>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <p class="pl-3"><?= ucwords($key); ?></p>
                                                </div>
                                                <div class="col-sm-2 aroma-lineheight">
                                                    <p><input type="number" class="color-input color-text-back d-inline-block" name="<?= $key; ?>"></p> 
                                                </div>
                                            </div>
                                            <?php } ?>
                                    <?php } ?>
                                    <br>
                                    <!-- upload image -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p><b>Image:</b></p>
                                            <form method="post" action="<?=base_url('store-image')?>" enctype="multipart/form-data" class="button color-text-back">
                                                <input type="file" id="profile_image" name="profile_image" size="33" class="button color-text-back" />
                                                <br><br><input type="submit" value="Upload Image" class="button color-text-back" />
                                            </form>
                                        </div>
                                    </div>
                                    <!-- buttons -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <br>
                                            <input type="submit" value="save ingredient" class="button color-text"><br>
                                            <a href="<?= base_url('admin/ingredients'); ?>" class="button color-text">go back</a><br>    
                                        </div>
                                    </div>  
                                </form> 
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
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .then( editor => {
                    console.log( editor );
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script>
    <script>
        var colors = <?= json_encode($colors); ?>

        changeLinecolor = (event) => {
            var selectedColor = colors.filter(function(color){
                return color.id == event.target.value;
            }); 
            document.getElementById('example').style.border = "3px solid " + selectedColor[0].clr_code; 
            document.getElementById('example').style.color = selectedColor[0].clr_code; 
        }

        changeBackcolor = (event) => {
            var selectedColor = colors.filter(function(color){
                return color.id == event.target.value;
            }); 
            document.getElementById('example').style.backgroundColor = selectedColor[0].clr_code; 
        }
    </script>
    <script>
        var colors = <?= json_encode($colors); ?>

        changeLinecolor = (event) => {
            var selectedColor = colors.filter(function(color){
                return color.id == event.target.value;
            }); 
            document.getElementById('example').style.border = "3px solid " + selectedColor[0].clr_code; 
            document.getElementById('example').style.color = selectedColor[0].clr_code; 
        }

        changeBackcolor = (event) => {
            var selectedColor = colors.filter(function(color){
                return color.id == event.target.value;
            }); 
            document.getElementById('example').style.backgroundColor = selectedColor[0].clr_code; 
        }
    </script>
</body>
</html>