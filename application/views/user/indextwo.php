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
            <div id="user-menu" class="row d-sm-none color-text-back"> <!-- mobile version -->
                <div class="col-sm-12">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/recipes">recipes</a><hr>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/addRecipe">add recipe</a><hr>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/ingredients">ingredients</a><hr>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>admin/addIngredient">add ingredients</a><hr>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout_user">log out</a><hr>
                </div>
            </div>  
            <!-- <div class="container block-height-88 clearfix"> -->
            <div class="row block-height-85 clearfix">
                <div class="col-sm-12">	
					<!-- PHP DATA -->
					<?php
						$user_id = $this->session->userdata('user')['user_id'];
						if(isset($_SESSION['tasteboard_id'])){
							$tasteboard_id = $_SESSION['tasteboard_id']; 
						}
						if(isset($_SESSION['tasteboard'])){
							$tasteboard = $_SESSION['tasteboard']; 
							
							var_dump($tasteboard);
						}
						if(isset($_SESSION['tasteboard_ingredients'])){
							$tasteboard_ingredients = $_SESSION['tasteboard_ingredients']; 
							
							var_dump($tasteboard_ingredients);
						}
					?>
				<!-- BODY -->
				<div class="row block-height-100">
					<!-- left div / mobile div -->
                    <div class="col-md-8 col-sm-12">
						<div id="save-button" class="float-left">
							<button onclick="saveTasteboard()" class="button color-text">save</button>
						</div>
						<div id="empty-button" class="float-right">
							<button onclick="emptyTasteboard()" class="button color-text">empty</button>
						</div>
						<div class="clearfix"></div>
						<div class="row justify-content-center clearfix">
							<div id="search-ingredient" class="col-sm-6">
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
							<!-- you could close the row and start a new one. then you can set boundaries for that row. so everything stays in one container. -->
							<div class="ingredient-container">
								<div id="ingredient-original">
									<!-- ORIGINAL INGREDIENT -->
								</div>
								<div id="ingredient-results">
									<!-- MATCH RESULTS -->
								</div>
							</div>		
						</div>                     
					</div>
					
					<!-- right div -->
                    <div id="large-menu" class="col-md-4 d-none d-md-block block-height-100 extra-menu-large pt-2"> <!-- desktop version -->
                        <div id="user-menu-large" class="col-sm-12 block-height-100 menu-large-content pt-3"> <!-- user menu -->
                            <a class="" href="<?php echo base_url(); ?>admin/recipes">recipes</a><hr>
                            <a class="" href="<?php echo base_url(); ?>admin/addRecipe">add recipe</a><hr>
                            <a class="" href="<?php echo base_url(); ?>admin/ingredients">ingredients</a><hr>
                            <a class="" href="<?php echo base_url(); ?>admin/addIngredient">add ingredients</a><hr>
                            <a class="" href="<?php echo base_url(); ?>login/logout_user">log out</a><hr>
                        </div>
                        <div id="ingredient-menu-content" class="block-height-90 color-text-back-neg">
							hello
							<div id="extra-menu" class="row">
								<!-- hier komen alle menu's terecht (save/empty/tasteboard/info/evt delete) -->
							</div>
						</div>
                        <div id="ingredient-menu" class="color-text"></div>
                    </div>
				</div>
				<!-- mobile ingredient menu -->
                <!-- <div class="row d-sm-none footer-large block-height-5">
                    <div class="col-sm-12">
						<div id="ingredient-menu-id" class="row ingredient-menu-mobile">
						</div>
                    </div>
				</div>  -->
			</div>             
		</div>
		<div class="row d-sm-none footer-large block-height-5">
                    <div class="col-sm-12">
						<div id="ingredient-menu-id" class="row ingredient-menu-mobile">
						</div>
                    </div>
				</div> 
            <!-- nu de footer hierzo: -->
        <div class="row d-none d-md-block footer-large block-height-3">
            <div class="col-md-12">
                <p class="fs16">yvette willems for syntra eindproject - foodpairing update - matching aroma's</p>
            </div>
        </div>
    </div>
<!-- </div>   -->
                
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
		var tasteboard_id = <?php if(isset($tasteboard_id)){ echo json_encode($tasteboard_id); } else { echo "''"; } ?> ;
		var tasteboard = <?php if(isset($tasteboard)){ echo json_encode($tasteboard); } else { echo "''"; } ?> ;
		var tasteboard_ingredients = <?php if(isset($tasteboard_ingredients)){ echo json_encode($tasteboard_ingredients); } else { echo "''"; } ?> ;

		if(tasteboard !== ''){
			// 1: Empty the values of other tasteboard:
			// emptyTasteboard(); 
			// 2: Set new values:
			OI = tasteboard.org_id;
			lastSelected = OI;
			tasteboard_id = tasteboard.id;
			if(tasteboard_ingredients !== ''){
				tasteboard_ingredients.map(function(ingredient, index){
					I[index]['id'] = parseInt(ingredient.igr_id);
					I[index]['connection'] = parseInt(ingredient.igr_connection);
				}); 
			}
			// 3: Display tasteboard:
			
		}


		// if(OI == ''){
		// 	document.getElementById('search-ingredient').style.display = "block"; 
		// } else {
		// 	document.getElementById('search-ingredient').style.display = "none"; 
		// }
		
	

    // INPUT ONCLICK SLIDE UP
        function inputSlideUp(e){
            $('.input-home').animate({ 'margin-top': '30%' }, "slow");
            // .css("margin-top", "30%"); 
		}

	// SHOW SEARCH RESULTS
		getInputIngredient = (event) => {
			var searchText = event.target.value.toLowerCase(); 
			var ingredients = <?php echo json_encode($ingredients); ?> ;
			var output = ''; 
			var searchResults = ingredients.filter(ingredient => ingredient.igr_name.toLowerCase().includes(searchText)); 
			console.log(searchText); 
			if(searchText === ''){
				output = '';	
			} else {
				$.each(searchResults, (index, ingredient) => {
					output += `
						<option 
							value="${ingredient.id}" 
							class="search-result color-text"
							onclick="selectFirstIngredient(event)"
							>${ingredient.igr_name}
						</option>
					`
				}); 
			}
			$("#list-ingredients").html(output);			
		}

	// SELECT ORIGINAL INGREDIENT:
		selectFirstIngredient = (event) => {
			// 1: Get the selected ingredient:
			var selectedIngredient = getSelectedIngredient(event); 
			// 2: Set 'session' original ingredient:
			OI = selectedIngredient[0].id; 
			// 3: Set 'session' of last selected ingredient:
			selectedLast = OI;
			// 3: Hide input field & search results:
			$("#search-ingredient").css("display", "none"); 
			$("#list-ingredients").css("display", "none"); 
			var output = `
				<div onclick="ingredientSelected(${selectedIngredient[0]['id']})" class="ingredient-original ingredient-center color-text-back-neg">
					<p>${selectedIngredient[0]['igr_name']}</p>
				</div>`
			$("#ingredient-original").html(output);
			// SHOW SAVE TASTEBOARD BUTTON: 
			if(OI !== ''){
				$("#save-button").css("display", "block"); 
			}
			// SHOW EMPTY TASTEBOARD BUTTON: 
			if(OI !== ''){
				$("#empty-button").css("display", "block"); 
			}
			// 4: Display matching ingredients:
			getMatchingIngredients(selectedIngredient[0]);  
		}

	// GET SELECTED INGREDIENT:
		getSelectedIngredient = (event) => {
			var ingredients = <?php echo json_encode($ingredients); ?> ;
			var selectedIngredient = ingredients.filter(ingredient => ingredient.id === event.target.value); 
			return selectedIngredient; 
		}

	// GET INGREDIENT BY ID:
		getIngredient = (id) => {
			var ingredients = <?php echo json_encode($ingredients); ?> ;
			var ingredient = ingredients.filter(ingredient => ingredient.id == id); 
			return ingredient[0]; 
		}
	
	// CHECK IF IN I ARRAY:
		checkTasteboard = (id) => {
			var check = 0; 
			for(i = 0; i < 10; i++){
				if(I[i].id == id || OI == id){
					check = 1;
					return check;
				} else {
					check = 0;
				}
			}
			return check;
		}

	
// INGREDIENT IS SELECTED: MENU'S, MATCHES AND STYLING:
	// Show drop-shadow/extra menu/matches, set last-selected:
		ingredientSelected = (id) => {
			console.log('The id of the selected ingredient is: ' + id); 
			// SHOW SELECTED, SHOW MENU AT BOTTOM (info, add, ...), ONCLICK MENU POP UP MENU: 
			// 1: Give element a drop shadow:
				// 1.1 If the selected element is the original element:
				if(id == OI){
					// Set all other element css to no shadow:
					for(i = 1; i < 20; i++){
						$(`#i${i}`).css("box-shadow", "none"); 
					}
					// Set element css to shadow:
					$(".ingredient-original").css("box-shadow", "0px 0px 15px 1px #776274"); 
				} else {
				// 1.2 If the selected element is not the original element:
					// Set all other element css to no shadow:
					$(".ingredient-match").css("box-shadow", "none"); 
					$(".ingredient-original").css("box-shadow", "none"); 
					// Set element css to shadow:
					var element = 'i' + id; 
					$(`#${element}`).css("box-shadow", "0px 0px 15px 1px #776274"); 
				}
			// 2: Show menu with ingredient id value:
			// 3: If this element is in I array, set this element to last selected: 
			// 4: If this element is in I array, show matches:
			var check = checkTasteboard(id); 
			if(check == true){
				// 2.1 Show delete when ingredient.id is in I array:
				output = `	<div class="col"><button onclick="displayTasteboardInfo()" class="button color-text">recipes</button></div>
							<div class="col text-center"><button onclick="displayIngredientInfo(${id})" class="button color-text">info</button></div>
							<div class="col text-right"><button onclick="deleteIngredient(${id})" class="button color-text">delete</button></div>`
				$("#ingredient-menu-id").html(output); 
				// 3.1 Set selected last to element id:
				selectedLast = id; 
				console.log('Last selected: ' + selectedLast); 
				// 4.1 Show matches:
				var ingredient = getIngredient(id); 
				getMatchingIngredients(ingredient); 
				return;
			} else {
				// 2.2 Show add when ingredient.id is not in I array:
				output = `	<div class="col"><button onclick="displayTasteboardInfo()" class="button color-text">recipes</button></div>
							<div class="col text-center"><button onclick="displayIngredientInfo(${id})" class="button color-text">info</button></div>
							<div class="col text-right"><button onclick="addIngredient(${id})" class="button color-text">add</button></div>`
				$("#ingredient-menu-id").html(output); 
				return;
			}
		}

// EXTRA MENU:
	// CLOSE:
		closeExtraMenu = () => {
			$(`#extra-menu`).css("display", "none");  
		}
	// TASTEBOARD INFO:
		displayTasteboardInfo = () => {
			output = `
					<div id="ingredient-info-id" class="block-all-inside col-sm-12 ingredient-info color-text-back">
						<p>Tasteboard Name</p>
						<p>maybe an input field for changing the name</p>
						<button onclick="saveTasteboard()" class="button color-text">save</button>
						<button onclick="emptyTasteboard()" class="button color-text">empty</button>
						<button onclick="closeTasteboard()" class="button color-text">close this tasteboard</button>
						<a href="#" onclick="closeExtraMenu()" class="color-text">x</a>
					</div>`
			$("#extra-menu").html(output); 
			$("#extra-menu").toggle(); 
		}

	// INFO:
		displayIngredientInfo = (id) => {
			var ingredient = getIngredient(id);
			var top_three = getTopThree(ingredient);  
			output = `
					<div id="ingredient-info-id" class="block-all-inside col-sm-12 ingredient-info color-text-back">
						<p>${ingredient.igr_name}</p>
						<p>${ingredient.igr_description}</p>
						<p>${top_three[0]}</p>
						<p>${top_three[1]}</p>
						<p>${top_three[2]}</p>
						<a href="#" onclick="closeExtraMenu()" class="color-text">x</a>
					</div>`
			$("#extra-menu").html(output); 
			$("#extra-menu").toggle(); 
		}

	// ADD:
		addIngredient = (id) => {
			ingredient = getIngredient(id); 
			output = `
					<div id="ingredient-add-id" class="block-all-inside col-sm-12 ingredient-info color-text-back">
						<p>Do you want to add this ingredient to your tasteboard?</p>
						<p>${ingredient.igr_name}</p>
						<a href="#" onclick="addIngredientToTasteboard(${id})" class="color-text">Add</a>
						<a href="#" onclick="closeExtraMenu()" class="color-text">x</a>
					</div>`
			$("#extra-menu").html(output);
			$("#extra-menu").toggle();  
			// Toggle visibility (ingredient-info display none); 
		}

		addIngredientToTasteboard = (id) => {
			// 1: Check which variables are already set (I1 - I9):
			for(i = 0; i < 10; i++){
				if(I[i].id == ''){
					// 2: Set variable I1:
					I[i] = {
						"id": id,
						"connection":selectedLast
					};
					console.log(I);
					// 3: Select element: 
					ingredientSelected(id);  
					// 4: Stop if statement:
					return;
				}
			}
		}

	// DELETE:
		deleteIngredient = (id) => {
			ingredient = getIngredient(id); 
			output = `
					<div id="ingredient-add-id" class="block-all-inside col-sm-12 ingredient-info color-text-back">
						<p>Do you want to delete this ingredient from your tasteboard?</p>
						<p>${ingredient.igr_name}</p>
						<a href="#" onclick="deleteIngredientFromTasteboard(${id})" class="color-text">Delete</a>
						<a href="#" onclick="closeExtraMenu()" class="color-text">x</a>
					</div>`
			$("#extra-menu").html(output);
			$("#extra-menu").toggle();  
			// Toggle visibility (ingredient-info display none); 
		}

		deleteIngredientFromTasteboard = (id) => {
			// 1: Check if id is in I array:
			for(i = 0; i < 10; i++){
				if(I[i].id == id){
					// 2: Delete ingredient:
					I[i] = {
						"id": '',
						"connection": ''
					};
				}
				if(I[i].connection == id){
					// 3: Delete ingredients that are connected:
					alert('You are deleting every ingredient connected to this ingredient. Oke?'); 
					I[i] = {
						"id": '',
						"connection": ''
					};
				}
			}
			console.log(I); 
			// 4: Set selected ingredient to original ingredient":
			ingredientSelected(OI); 
		}

	// SAVE:
		saveTasteboard = () => {
			// 1: Check if tasteboard is saved before:
			if(tasteboard_id == ''){
				// 2: If tasteboard is not saved before, show input name and add button (addTasteboardDatabase()):
				output = `
					<div id="tasteboard-save-id" style="display: block" class="block-all-inside col-sm-12 ingredient-info color-text-back">
						<p>Hoe wil je dit tasteboard noemen?</p>
						<input id="tasteboard_name" name="name" type="text" class="color-input color-text-back input-login" placeholder="Tasteboard 01">
						<a href="#" onclick="addTasteboardDatabase()" class="color-text">Add</a>
						<a href="#" onclick="closeExtraMenu()" class="color-text">x</a>
					</div>`
			$("#extra-menu").html(output);
			$("#extra-menu").toggle();  
			} else {
				// 3: If tasteboard is saved before, get tasteboard id from session:
				var id = tasteboard_id; 
				saveTasteboardAction(id); 
			}			
		}

		addTasteboardDatabase = () => {
			// 1: Make a http request to access php controller.
			var new_I = JSON.stringify(I); 
			var tasteboard_name = $("#tasteboard_name").val(); 
			$.get("<?php echo base_url('Home/addTasteboard/'); ?>", {user_id:user_id, OI:OI, new_I:new_I, tasteboard_name:tasteboard_name }, function(resp){
				// If response is not null (because response should be tasteboard_id):
				if(resp == 'err'){
					console.log(resp); 
					alert('Er is iets fout gegaan...');
				}else{
					console.log('het is gelukt!'); 
					console.log(resp); 
					// tasteboard_id = <?php if(isset($tasteboard_id)){ echo json_encode($tasteboard_id); } else { echo "''"; } ?> ;
					tasteboard_id = resp;
					alert('ja hoor, gelukt');
					// Is de location reload wel nodig?? 
					// location.reload();
				}
			});
			// 2: Give variables user_id, OI and I.
			// 3: In controller, pass user_id and OI to model function.
			// 4: Add variables to tasteboards table. 
			// 5: Add tasteboard id to session:
			// 6: Display home/index page. 
		}

		saveTasteboardAction = (tasteboard_id) => {
			// This is an update
			console.log('This is function saveTasteboardAction. It updates a tasteboard. Not yet.');
			console.log(tasteboard_id); 
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

	// EMPTY:	
		emptyTasteboard = () => {
			OI = ''; 
			selectedLast = ''; 
			for(i = 0; i < 10; i++){
				I[i] = {
					"id": '', 
					"connection": ''
				} 
			}
			console.log('the original: ' + OI + ', the selected last: ' + selectedLast + ' and the array I: ' + I); 
		}

// GET MATCH VALUES:
		getMatchingIngredients = (ingredient) => {
			console.log('getMatchtingIngredients is activated'); 
			// GET TOP 3 AROMA'S OF ORIGINAL INGREDIENT: 
			var top_three = getTopThree(ingredient); 

			// FOR EACH INGREDIENT, GET A "MATCHING VALUE":
			var ingredients = <?php echo json_encode($ingredients); ?> ;
			var ingredientValues = []; 
			// 1: For each ingredient
			ingredients.map(function(ingredient, index){
				// 2: Check if ingredient is in I array:
				for(i = 0; i < 10; i++){
					if(I[i].id == ingredient.id || OI == ingredient.id){
						// Do not add to new array:
					} else {
						// Add to new array:
						// 3: Add the values of top_three aroma's:
						var aromaValue = 0; 
						for (const [key, value] of Object.entries(ingredient)) {
							if(key === top_three[0]){
								aromaValue = parseFloat(aromaValue) + parseFloat(value); 
							}
							if(key === top_three[1]){
								aromaValue = parseFloat(aromaValue) + parseFloat(value); 
							}
							if(key === top_three[2]){
								aromaValue = parseFloat(aromaValue) + parseFloat(value); 
							}
						}
						// 4: Make a new array of [0] {"ingredient" & "matching-value"}:
						var object = {
							"id": ingredient.id, 
							"name": ingredient.igr_name, 
							"aromaValue": aromaValue 
						};
						ingredientValues.push(object); 
						return ingredientValues; 
					}
				}					
			}); 
			// Extra: order by value, limit to 40 results: 
			// 4: Return array:

			displayIngredients(ingredientValues); 
		}

	// GET TOP THREE INGREDIENTS:
		getTopThree = (ingredient) => {
			// 1: Get all aroma's of ingredient: 
			var ingredientAromas = getIngredientAromas(ingredient); 
			// 2: Get top aroma:
			var ingr_one = Object.keys(ingredientAromas).reduce((a, b) => ingredientAromas[a] > ingredientAromas[b] ? a : b); 
			// 3: Filter out top aroma and get top aroma nr 2:
			var ingredientAromas = {
				// "fruity": ingredient.fruity,
				"green": ingredient.green, 
				"roasted": ingredient.roasted
			}
			var ingr_two = Object.keys(ingredientAromas).reduce((a, b) => ingredientAromas[a] > ingredientAromas[b] ? a : b); 
			// 4: Filter out top aroma and get top aroma nr 3:
			var ingredientAromas = {
				// "fruity": ingredient.fruity,
				// "green": ingredient.green, 
				"roasted": ingredient.roasted
			}
			var ingr_three = Object.keys(ingredientAromas).reduce((a, b) => ingredientAromas[a] > ingredientAromas[b] ? a : b); 
			// 5: Make new array with top 3 values: 
			var top_three = [ingr_one, ingr_two, ingr_three]; 
			return top_three;
		}

	// GET INGREDIENT AROMA'S:
		getIngredientAromas = (ingredient) => {
			var ingredientAromas = {
				"fruity": ingredient.fruity,
				"green": ingredient.green, 
				"roasted": ingredient.roasted
				// etc, etc, etc.
			}				
			return ingredientAromas; 
		}

	// DISPLAY MATCHING INGREDIENTS:
		displayIngredients = (ingredientValues) => {
			console.log('displayIngredients is activated'); 
			// DISPLAY INGREDIENTS BY AROMA VALUE:
			var output= ''; 
			// FOR EACH INGREDIENT, SHOW A DIV WITH ITS OWN CSS STYLING
				// 1: For each ingredient
				ingredientValues.map(function(ingredient, index){			
					// 2: Create its own styling:
					// Get random left and right value based on aroma-value:
					var position = getIngredientPosition(ingredient); 
					// Top & Left, Width & Height, Radius, Opacity
					// var top = position.top; 
					// var left = position.left; 
					// var width = ingredient.aromaValue;
					var width = 100;
					var borderRadius = width/2; 
					var opacity = ingredient.aromaValue/100;
					// var style = `"top:${top}px;left:${left}px;width:${width}px;height:${width}px;border-radius:${borderRadius}px;opacity:${opacity};"`; 
					var style = `"width:${width}px;height:${width}px;border-radius:${borderRadius}px;opacity:${opacity};"`; 
					var style = `"opacity:${opacity};"`; 
				// 3: Add a div to output:
					output += 
						`<div id="i${ingredient.id}" onclick="ingredientSelected(${ingredient.id})" style=${style} class="ingredient-center color-text-back-neg ingredient-match">
							<p>${ingredient.name}</p>
						</div>`;
				}); 
				// 4: innerHTML output:				
				$('#ingredient-results').html(output); 
		}

	// GET RANDOM LEFT AND TOP VALUE BASED ON AROMA VALUE:
		getIngredientPosition = (ingredient) => {
			// 1: Declare original values and get 'random' degree:
			var top = 180; 
			var left = 50; 
			var degree = Math.floor(Math.random() * 360); 
			// 1: When the aromaValue is higher, the distance should be lower...
			var dummy = ingredient.aromaValue; 
			var amount = parseFloat(dummy); 
			// 2: Get new top and left value based on angle:
			var angle = degree * Math.PI/180; 
			var x = (Math.cos(angle) * amount) + 85; 
			var y = (Math.sin(angle) * amount) + 85; 
			top += y;
			left += x;
			// console.log(ingredient.name + ' top: ' + top); 
			// console.log(ingredient.name + ' left: ' + left); 
			var position = {
				"top": top, 
				"left": left
			}; 
			return position; 
		}		
    </script>
</body>
</html>