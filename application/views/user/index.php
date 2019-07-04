
					<!-- PHP DATA -->
					<?php
						$user_id = $this->session->userdata('user')['user_id'];
						if(isset($_SESSION['tasteboard_id'])){
							$tasteboard_id = $_SESSION['tasteboard_id']; 
						}
						if(isset($_SESSION['tasteboard'])){
							$tasteboard = $_SESSION['tasteboard']; 
							
							// var_dump($tasteboard);
						}
						if(isset($_SESSION['tasteboard_ingredients'])){
							$tasteboard_ingredients = $_SESSION['tasteboard_ingredients']; 
							
							// var_dump($tasteboard_ingredients);
						}
						if(isset($_SESSION['message'])){
							$message = $_SESSION['message']; 
							// var_dump($message);
						}
					?>
				<!-- BODY -->
				<div class="row block-height-100">
					<!-- left div / mobile div -->
                    <div class="col-md-8 col-sm-12 left-box block-height-100 overflow-hide">
						<div class="to-front" style="width:95%;"> 
							<div id="save-button" class="float-left">
								<button onclick="saveTasteboard()" class="button color-text">save</button>
							</div>
							<div id="empty-button" class="float-right">
								<button onclick="emptyTasteboard()" class="button color-text">empty</button>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="row justify-content-center">
							<div id="search-ingredient" class="col-sm-6 to-front">
								<input 
									id="input-home-id"
									onfocus="inputSlideUp()" 
									onkeyup="getInputIngredient(event)"									
									type="text" 
									class="color-input color-text-back input-home"
									placeholder="Search for ingredient..."
								>
								<div id="list-ingredients" class="ingredient_list p-1">
									<!-- FIRST SEARCH RESULTS -->
								</div>							
							</div>		
						</div>
			
						<div class="row"><div class="col-sm-12">
							<div id="drag-ingredients" onmousedown="dragElement(event)" class="overflow-show color-text-back">	
								<div id="ingredient-results" class="ingredient-container ingredient-center block-height-100 color-text-back">
							
								</div>
							</div>
						</div></div> 
					</div>
					
					<!-- right div -->
					<div id="large-menu" class="col-md-4 d-none d-md-block block-height-100 extra-menu-large"> <!-- desktop version -->
						<div class="row p-2 block-height-100">
							<!-- user menu // default hidden -->
							<div id="user-menu-large" class="col-sm-12 block-height-100 color-text-back"> <!-- user menu -->
								<div class="block-height-100 p-3">
									<button class="button color-text-back" onclick="displayPersonalInformation(); closeImage();">personal information</button><hr>
									<button class="button color-text-back" onclick="displayTasteboards(); closeImage();">tasteboards</button><hr>
									<button class="button color-text-back" onclick="displayRecipes()">recipes</button><hr>
									<button class="button color-text-back" onclick="displayAppInformation(); closeImage();">app information</button><hr>
									<a class="button color-text-back" href="<?php echo base_url(); ?>login/logout_user">log out</a><hr>
								</div>
							</div>
							
						<!-- user menu content // default hidden -->								
							<div id="user-menu-content" class="col-sm-12 block-height-100 color-text-back">
							</div>

						<!-- extra/ingredient menu // default display block -->
							<div onclick="closeImage()" class="image-ingredient color-text-back click"></div>
							<div id="extra-menu-content" class="col-sm-12 viewport-height-78 color-text-back"> 
								<!-- hier komt alle content van de menu's terecht (save/empty/tasteboard/info) -->
								<!-- misschien moet hier een row tussen!! -->
							</div>
							<div id="extra-menu" class="col-sm-12">
								<!-- hier komen de tasteboard / info / add of delete button terecht -->
							</div>
						</div>
					</div>

					<!-- mobile extra menu's ... -->
					<div id="mobile-extra-menu-id" class="row d-sm-none block-height-100">
						<div class="col-sm-12 block-height-100">
							<div id="mobile-extra-menu-content" class="row color-text-back block-height-100">
								
							</div>
						</div>
					</div>
                </div>
				<!-- hier sluit dit index blok -->
			</div>   
        </div>
		   
	<script src="<?= base_url(); ?>/assets/js/menu.js"></script>
	<script src="<?= base_url(); ?>/assets/js/ingredient.js"></script>
	<script src="<?= base_url(); ?>/assets/js/tasteboard.js"></script>
	<script src="<?= base_url(); ?>/assets/js/color.js"></script>
	<script src="<?= base_url(); ?>/assets/js/jquery.line.js"></script>

    <script>
		// 'SESSION'
		var OI = '';
		var selectedLast = ''; 
		var I = [	// Maximum of 10 ingredients
			{		// [0]
				"id":'',
				"connection": ''
			}, {	// [1]
				"id":'',
				"connection": ''
			}, {	// [2]
				"id":'',
				"connection": ''
			}, {	// [3]
				"id":'',
				"connection": ''
			}, {	// [4]
				"id":'',
				"connection": ''
			}, {	// [5]
				"id":'',
				"connection": ''
			}, {	// [6]
				"id":'',
				"connection": ''
			}, {	// [7]
				"id":'',
				"connection": ''
			}, {	// [8]
				"id":'',
				"connection": ''
			}, {	// [9]
				"id":'',
				"connection": ''
			}
		];
		var user_id =  <?= json_encode($user_id); ?> ; // Nodig om data in database te zetten
		var user_details = <?= json_encode($user_details[0]); ?>;
		var user_tasteboards = <?= json_encode($user_tasteboards); ?>;

		// var tasteboard_id = <?php if(isset($tasteboard_id)){ echo json_encode($tasteboard_id); } else { echo "''"; } ?> ;
		var tasteboard = <?php if(isset($_SESSION['tasteboard'])){ echo json_encode($_SESSION['tasteboard']); } else { echo "''"; } ?> ;
		var tasteboard_ingredients = <?php if(isset($_SESSION['tasteboard_ingredients'])){ echo json_encode($_SESSION['tasteboard_ingredients']); } else { echo "''"; } ?> ;

		var ingredients = <?php echo json_encode($ingredients); ?> ;
		var base_url = "<?= base_url(); ?>";

		var coords = '';
		var original_output = '';

		var current_color = '';


		getUserTasteboards = (id = '') => {
			var user_tasteboards = <?= json_encode($user_tasteboards); ?>;
			if(id){
				var tasteboard = user_tasteboards.filter(tasteboard => tasteboard.id == id);
				return tasteboard;
			} else {
				return user_tasteboards;
			}
		}
		
		readTasteboard = () => {
			var tasteboard = <?php if(isset($tasteboard)){ echo json_encode($tasteboard); } else { echo "''"; } ?> ;
			return tasteboard;
		}

		readTasteboardIngredients = () => {
			var tasteboard_ingredients = <?php if(isset($tasteboard_ingredients)){ echo json_encode($tasteboard_ingredients); } else { echo "''"; } ?> ;
			return tasteboard_ingredients;
		}

		getIngredient = (id= '') => {
			var ingredients = <?php echo json_encode($ingredients); ?> ;
			if(id){
				var ingredient = ingredients.filter(ingredient => ingredient.id == id); 
				return ingredient[0]; 
			} else {
				return ingredients;
			}
		}
		
		getColors = () => {
			var colors = <?= json_encode($colors); ?>;
			return colors;
		}

		// openTasteboard = () => {
		// 	var tasteboard = readTasteboard();
		// 	var tasteboard_ingredients = readTasteboardIngredients();
		// 	if(tasteboard !== ''){
		// 		// 1: Set OI and I:
		// 		OI = tasteboard.org_id;
		// 		selectedLast = OI;
		// 		tasteboard_id = tasteboard.id;
		// 		if(tasteboard_ingredients !== false){
		// 			tasteboard_ingredients.map(function(ingredient, index){
		// 				I[index]['id'] = parseInt(ingredient.igr_id);
		// 				I[index]['connection'] = parseInt(ingredient.igr_connection);
		// 			}); 
		// 		}
		// 		// 2: Display ingredients:
		// 		// Do not show search input and ingredient list:
		// 		$("#search-ingredient").css("display", "none"); 
		// 		$("#list-ingredients").css("display", "none"); 
		// 		// Show empty and save button:
		// 		$("#save-button").css("display", "block"); 
		// 		$("#empty-button").css("display", "block"); 
		// 		readVariables();
		// 	}
		// }

		// readVariables = () => {
		// 	// 1: Display OI:
		// 	if(OI !== ''){
		// 		var original_ingredient = getIngredient(OI);
		// 		original_output = `
		// 			<div 
		// 				id="i${original_ingredient.id}"
		// 				onclick="ingredientSelected(${original_ingredient.id})" 
		// 				class="original-ingr all-ingredients color-text-back-neg click choosen">
		// 				<p>${original_ingredient.igr_name}</p>
		// 			</div>`
		// 		$("#ingredient-results").html(original_output);
		// 		// 2: Display I:
		// 		var degree = 0;
		// 		I.map(function(I_ingredient, index){
		// 			if(I_ingredient.id == ''){
		// 				// Do nothing
		// 			} else {
		// 				// Create ingredient:
		// 				selectedLast = I_ingredient.connection;
		// 				var connection_ingredient = getIngredient(I_ingredient.connection);
		// 				var connection_topthree = getTopThree(connection_ingredient);
		// 				var ingredient = getIngredient(I_ingredient.id);
		// 				var ingredientValues = getAromaValues(ingredient, connection_topthree);

		// 				I_ingredient.connection !== OI ? degree += 60 : console.log('connection id = OI');

		// 				coords = getCoords(connection_ingredient);
		// 				var output = createOutput(ingredientValues[0], degree);
		// 				output = $('<div></div>').html(output).find('div').addClass('choosen').end().html();
		// 				original_output += output;
		// 				$("#ingredient-results").html(original_output);
						
		// 				I_ingredient.connection !== OI ? degree -= 60 : console.log('connection id = OI');
		// 				degree += (360/10);	

		// 				// Create line:
		// 				drawLine(I_ingredient.id, I_ingredient.connection);
		// 				var line = $('.line').last();
		// 				var output_line = line[0].outerHTML;
		// 				original_output += output_line;
		// 				$("#ingredient-results").html(original_output); 
		// 			}
		// 		});	
		// 		selectedLast = '';
		// 	} else {
		// 		// do nothing
		// 	}			
		// }	

		saveTasteboardAction = (tasteboard_id) => {
			// This is an update
			var new_I = JSON.stringify(I); 
			$.get("<?php echo base_url('Home/saveTasteboard/'); ?>", { tasteboard_id:tasteboard_id, OI:OI, new_I:new_I}, function(resp){
				if(resp == 'err'){
					console.log(resp); 
					alert('Er is iets fout gegaan...');
				}else{
					console.log('het is gelukt!'); 
					alert('ja hoor, gelukt');
					tasteboard_id = resp;
				}
			});
		}
    </script>
</body>
</html>