// EXTRA MENU:
	// CLOSE:
    closeExtraMenu = (id) => {
        $(`.${id}`).css("display", "none"); 
        document.getElementById('user-menu-content').style.display = "none";  
    }

    closeImage = () => {
        $('.image-ingredient').css("display", "none");
    }

    // EXTRA MENU
// TASTEBOARD INFO:
    displayTasteboardInfo = () => {
        var name_output = `
            <input id="tasteboard_name" 
                    name="name" 
                    type="text" 
                    class="color-input color-text-back input-login" 
                    value="${tasteboard.tst_name}">
            <br></br>`;
        tasteboard.tst_name == undefined ? name_output = 'This tasteboard has not been saved yet. Click on save to set a name.' : console.log('i guess it knows that tasteboard is not empty...');
        output = `
                <div class="tasteboard-info-id col-sm-12 block-height-100 extra-menu-styling">
                    <p class="float-left"><b>This tasteboard:</b></p>
                    <a href="#" onclick="closeExtraMenu('tasteboard-info-id');" class="color-text float-right">
                        <img class="cross_close" src="${base_url}assets/img/cross_close.svg">
                    </a>

                    <div class="clearfix"></div>
                    <div class="user-menu-content">
                        <p>${name_output}</p>
                        <button onclick="saveTasteboard()" class="button color-text">save</button> this tasteboard, <br>
                        <button onclick="emptyTasteboard()" class="button color-text">empty</button> it and start over <br>or 
                        <a href="${base_url}home/closeTasteboard" class="button color-text">close this tasteboard</a> and start a new one.
                    </div>
                </div>`
        $("#extra-menu-content").html(output); 
        $("#mobile-extra-menu-content").html(output);  
    }
// INGREDIENT INFO:
    displayIngredientInfo = (id) => {
        var ingredient = getIngredient(id);
        var top_three = getTopThree(ingredient);  
        output = `
                <div class="ingredient-info-id col-sm-12 block-height-100 extra-menu-styling">
                    <p class="float-left"><b>Ingredient Details</b></p>
                    <a href="#" onclick="closeExtraMenu('ingredient-info-id'); closeImage();" class="color-text float-right">
                        <img class="cross_close" src="${base_url}assets/img/cross_close.svg">
                    </a>

                    <div class="clearfix"></div>
                    <div class="user-menu-content">
                        <p>${ingredient.igr_name}</p>
                        <p><b>Description:</b> ${ingredient.igr_description}</p>
                        <p><b>It's top aromas:</b><br>
                        ${top_three[0]}, ${top_three[1]} and ${top_three[2]}</p>
                    </div>
                </div>`
        $("#extra-menu-content").html(output); 
        $("#mobile-extra-menu-content").html(output);

        $(".image-ingredient").css("background-image", `url('${base_url}assets/img/${ingredient.igr_img}')`);
        $(".image-ingredient").css("display", "block"); 
    }
// ADD INGREDIENT:
    addIngredientToTasteboard = (id) => {
        // 1: Check which variables are already set (I1 - I9):
        for(i = 0; i < 10; i++){
            if(I[i].id == ''){
                // 2: Set variable I if empty:
                I[i] = {
                    "id": id,
                    "connection":selectedLast
                };
                // 3: Select element html:
                $(`#i${id}`).addClass("choosen"); 
                var element = document.getElementById('i' + id);
                // 4: Add to original_output;
                original_output += element.outerHTML;
                var connection = selectedLast;
                ingredientSelected(id);
                // 5: Draw a line to connecting ingredient:
                drawLine(id, connection);
                // 6: Add line to original output:
                $(document).ready(function(){
                    var line = $('.line').last();
                    var output = line[0].outerHTML;
                    original_output += output;
                });
                return;
            }
        }
    }

    drawLine = (id, connection) => {
        // Ingredient x and y
        var ingredient = getIngredient(id);
        var igr_coords = getCoords(ingredient);
        var igr_width = getElementWidth(ingredient);
        var igr_x = igr_coords.left + (igr_width/2);
        var igr_y = igr_coords.top + (igr_width/2);
        // Connection x and y
        var con_ingredient = getIngredient(connection);
        var con_coords = getCoords(con_ingredient);
        var con_width = getElementWidth(con_ingredient);
        var con_x = con_coords.left + (con_width/2);
        var con_y = con_coords.top + (con_width/2);

        $('#ingredient-results').line(con_x, con_y, igr_x, igr_y, {
            zindex: -1, 
            color: '#001427', 
            stroke: '1',
            style: 'solid',
            class: 'line'
        });
    }

// DELETE INGREDIENT:
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
                I[i] = {
                    "id": '',
                    "connection": ''
                };
            }
        }
        original_output = '';
        readVariables();
        // 4: Set selected ingredient = original ingredient":
        ingredientSelected(OI); 
    }

// SAVE:
	saveTasteboard = () => {
        var new_I = JSON.stringify(I);
        console.log(new_I);
		// 1: Check if tasteboard is saved before:
		if(tasteboard == ''){
			// 2: If tasteboard is not saved before, show input name and add button (addTasteboardDatabase()):
			output = `
                <div class="tasteboard-save-id col-sm-12 block-height-100 extra-menu-styling">
                    <p class="float-left"><b>Save this board</b></p>
                    <a href="#" onclick="closeExtraMenu('tasteboard-save-id')" class="color-text float-right">
                        <img class="cross_close" src="${base_url}assets/img/cross_close.svg">
                    </a>

                    <div class="clearfix"></div>
                    <div class="user-menu-content">
                        <p>Hoe wil je dit tasteboard noemen?</p>
                        <form action="${base_url}home/addTasteboard" method="post">
                            <input name="tasteboard_name" type="text" class="color-input color-text-back" placeholder="Tasteboard 01">
                            <input name="user_id" type="hidden" value="${user_details.id}">
                            <input name="OI" type="hidden" value="${OI}">
                            <input name="I" type="hidden" value='${new_I}'>
                            <br><br>
                                            
                            <input type="submit" value="Add Tasteboard" class="button color-text">        
                        </form>
                    </div>
				</div>`
            $("#mobile-extra-menu-content").html(output);
            $("#extra-menu-content").html(output); 
		} else {
			// 3: If tasteboard is saved before, get tasteboard id from session:
            var id = tasteboard.id; 
			saveTasteboardAction(id); 
		}			
    }

// EMPTY:	
    emptyTasteboard = () => {
        // Delete all ingredients from OI and I array:
        OI = ''; 
        selectedLast = ''; 
        for(i = 0; i < 10; i++){
            I[i] = {
                "id": '', 
                "connection": ''
            } 
        }
        // Delete all displayed ingredients:
        original_output = '';
        $("#ingredient-results").html(''); 
        // Do not show save & empty button:
        $("#save-button").css("display", "block"); 
        $("#empty-button").css("display", "block"); 
        // Show input first ingredient:
        $("#search-ingredient").css("display", "block"); 
		$("#list-ingredients").css("display", "block"); 
    }


    // USER MENU
// PERSONAL INFORMATION:
    displayPersonalInformation = () => {
        // 1: Close user menu: 
        document.getElementById('user-menu-large').style.display = "none"; 
        document.getElementById('mobile-user-menu').style.display = "none"; 
        // 2: Display personal information:
        var output = `
            <div style="${current_color}" class="personal-information-id col-sm-12 block-height-100 extra-menu-styling">
                <p class="float-left"><b>Personal Information:</b></p>
                <a href="#" onclick="closeExtraMenu('personal-information-id')" class="color-text float-right">
                    <img class="cross_close" src="${base_url}assets/img/cross_close.svg">
                </a>

                <div class="clearfix"></div>
				<div class="user-menu-content">
                    <form 	onsubmit="updatePersonalInformation(event)" method="get">
						<input type="hidden" value="${user_details.id}" class="form-control" name="id" id="personal_user_id">
                        <p>Voornaam: </p>
						<input type="text" value="${user_details.usr_firstname}" class="color-input color-text-back" name="firstname" id="personal_firstname"><br><br>
						<p>Achternaam: </p>
						<input type="text" value="${user_details.usr_lastname}" class="color-input color-text-back" name="lastname" id="personal_lastname"><br><br>
						<p>E-mail: </p>
						<input type="hidden" value="${user_details.usr_email}" name="oldemail" id="personal_oldemail">
						<input type="text" value="${user_details.usr_email}" class="color-input color-text-back" name="email" id="personal_email"><br><br>
										
					    <input type="submit" value="update information" class="button color-text">        
					</form>
                </div> 
            </div> `; 
        document.getElementById('user-menu-content').innerHTML = output;
        document.getElementById('user-menu-content').style.display = "block"; 
        document.getElementById('mobile-extra-menu-content').innerHTML = output;
    }

    updatePersonalInformation = (event) => {
        // 1: Make a request to access php controller.
        event.preventDefault();
        // 2: We need: id, firstname, lastname, oldemail and email.
        var id = $("#personal_user_id").val();
        var firstname = $("#personal_firstname").val(); 
        var lastname = $("#personal_lastname").val();
        var oldemail = $("#personal_oldemail").val();
        var email = $("#personal_email").val(); 
        
        $.get(`${base_url}usermenu/updateUser/`, {id:id, firstname:firstname, lastname:lastname, oldemail:oldemail, email:email }, function(resp){
            if(resp == 'err'){
                alert('Er is iets fout gegaan...');
            }else{
                user_details = JSON.parse(resp);
                alert('Gelukt');
                displayPersonalInformation();
            }
        });
    }
// TASTEBOARDS:
    displayTasteboards = () => {
        // 1: Close user menu: 
        document.getElementById('user-menu-large').style.display = "none";
        document.getElementById('mobile-user-menu').style.display = "none"; 
        // 2: Display tasteboards:
        var output = '';
        user_tasteboards.map(function(tasteboard, index) {
            output += 
                `<div class="row">
                    <div class="col-sm-12">
                        <p onclick="showTasteboardDetails(${tasteboard.id})" class="click">${tasteboard.tst_name} <i>- click for details</i></p>
                        <hr>
                    </div>
                </div>
                <div class="tst_${tasteboard.id}" style="display:none;" class="click tasteboard-details">
                    <div class="row tasteboard-details">
                        <div class="col-sm-6">
                            <button onclick="toPDF()" class="color-text button">make pdf</button><br>
                            <p class="fs16">Choose which items on the right you want to include in this pdf.</p>
                        </div>
                        <div class="col-sm-6 fs16 pdf-options">
                            <input type="radio" name="aroma" value=""> aroma's<br>
                            <input type="radio" name="description" value=""> descriptions<br>
                            <input type="radio" name="photo" value=""> photo's<br>
                        </div>
                    </div>
                    <div class="row tasteboard-details">
                        <div class="col-sm-4">    
                            <a class="button color-text" href="${base_url}/usermenu/editTasteboard/${tasteboard.id}">edit</a>, or
                            <button class="button" onclick="deleteTasteboard(${tasteboard.id})">delete</button>
                        </div>
                    </div>
                    <hr>
                </div>
            `
        });  
        var def_output = `
            <div class="user-tasteboards-id col-sm-12 block-height-100 extra-menu-styling">
                <p class="float-left"><b>Tasteboards:</b></p>
                <a href="#" onclick="closeExtraMenu('user-tasteboards-id')" class="color-text float-right">
                    <img class="cross_close" src="${base_url}assets/img/cross_close.svg">
                </a>

                <div class="clearfix"></div>
                <div class="user-menu-content">
                    ${output} 
                </div>
            </div> `;
        document.getElementById('user-menu-content').innerHTML = def_output;
        document.getElementById('user-menu-content').style.display = "block"; 
        document.getElementById('mobile-extra-menu-content').innerHTML = def_output; 
    }

    showTasteboardDetails = (id) => {
        var details = $('.tst_' + id);
        if(details[0].style.display == "none"){
            details[0].style.display = "block";
            details[1].style.display = "block";
        } else {
            details[0].style.display = "none";
            details[1].style.display = "none";
        }            
    }

    deleteTasteboard = (id) => {
        // 1: Make a request to access php controller.        
        $.get(`${base_url}usermenu/deleteTasteboard/`, {id:id}, function(resp){
            if(resp == 'err'){
                alert('Er is iets fout gegaan...');
            }else{
                alert('Gelukt');
                // 2: Update the user_tasteboards array:
                user_tasteboards = JSON.parse(resp);
                // 3: Fill the tasteboards menu again:
                displayTasteboards();
            }
        });
    }

// APP INFORMATION:
    displayAppInformation = () => {
        // 1: Close user menu: 
        document.getElementById('user-menu-large').style.display = "none"; 
        document.getElementById('mobile-user-menu').style.display = "none"; 
        // 2: Display app information:
        var output = `
            <div class="app-information-id col-sm-12 block-height-100 extra-menu-styling">
                <p class="float-left"><b>App Information:</b></p>
                <a href="#" onclick="closeExtraMenu('app-information-id')" class="color-text float-right">
                    <img class="cross_close" src="${base_url}assets/img/cross_close.svg">
                </a>

                <div class="clearfix"></div>
                <div class="user-menu-content">
                    <p>	Vanuit mijn achtergrond als grafisch vormgever heb ik geleerd te denken vanuit problemen. Een goed product is een product dat een 
                    probleem oplost. Dat probleem hoeft nog niet te bestaan, je mag een consument ook doen geloven dat dat probleem er is. Maar producten 
                    werken het best als ze een actueel probleem oplossen.
                    </p>
                    <p> Een goed probleem vínden, dat is vaak moeilijk. Door je te verplaatsen in een bepaalde situatie, aandachtig om je heen te kijken en 
                    in je dagelijks leven de kleinste details op te merken, zie je de problemen om je heen. Om die reden heb ik besloten mijn omgeving en 
                    interesses uit te pluizen: 
                    </p>
                    <p> Wanneer is mij iets niet gelukt en om welke reden? Wanneer heb ik iets niet kunnen vinden? Welke andere mooie, simpele applicaties 
                    heb ik gezien die mij aanspraken? Waar kan ik een handige applicatie gebruiken, ook al mis ik hem nu nog niet? 
                    </p>
                    
                    <p>Ik houd van design, natuur, cultuur… Ik houd van goed eten. En ik houd van lekker koken. <br>
                    Ik verras mensen graag met iets nieuws: interessante combinaties van ingrediënten, nieuwe smaken en texturen, recepten die vaak niet op 
                    oude, vertrouwde plekken te vinden zijn. Recepten waarvan ik van tevoren niet weet of ze écht goed in de smaak gaan vallen. <br>
                    Ik houd niet van safe, zou elke keer wel iets nieuws willen proberen of ontdekken, maar wil wel graag weten dat het klopt. 
                    Gaan deze smaken, van al deze ingrediënten wel goed samen? Dat is het probleem wat ik op wil lossen. 
                    </p>
                    <p>
                    Het is mij een genoegen om een applicatie te maken waarvan het probleem simpel is, en de oplossing uitdagend. Waarvoor een duidelijk, 
                    maar prikkelend design bedacht kan worden. Waardoor gebruikers nieuwe combinaties ontdekken en nieuwe dingen proberen. <br><br><br>
                    </p>
                </div>
            </div>`;
        document.getElementById('user-menu-content').innerHTML = output; 
        document.getElementById('user-menu-content').style.display = "block"; 
        document.getElementById('mobile-extra-menu-content').innerHTML = output; 
    }

    







//     // 1: Display OI:
//     var original_ingredient = getIngredient(OI);
//     original_output = `
//         <div 
//             id="i${original_ingredient.id}"
//             onclick="ingredientSelected(${original_ingredient.id})" 
//             class="original-ingr all-ingredients color-text-back-neg click choosen">
//             <p>${original_ingredient.igr_name}</p>
//         </div>`
//     $("#ingredient-results").html(original_output);
//     // 2: Display I:
//     if(tasteboard_ingredients !== false){
//         var degree = 36;
//         var count = tasteboard_ingredients.length;
//         tasteboard_ingredients.map(function(tst_ingredient, index){
//             // Create ingredient:
//             selectedLast = tst_ingredient.igr_connection;
//             var connection_ingredient = getIngredient(tst_ingredient.igr_connection);
//             var ingredient = getIngredient(tst_ingredient.igr_id);
            
//             var connection_topthree = getTopThree(connection_ingredient);							
//             var ingredientValues = getAromaValues(ingredient, connection_topthree);

//             tst_ingredient.igr_connection !== OI ? degree += 60 : console.log('connection id = OI');

//             coords = getCoords(connection_ingredient);
//             var output = createOutput(ingredientValues[0], degree);
//             output = $('<div></div>').html(output).find('div').addClass('choosen').end().html();

//             original_output += output;
//             $("#ingredient-results").html(original_output); 

//             tst_ingredient.igr_connection !== OI ? degree -= 60 : console.log('connection id = OI');
//             degree += (360/10);

//             // Create line:
//             drawLine(tst_ingredient.igr_id, tst_ingredient.igr_connection);
//             var line = $('.line').last();
//             var output_line = line[0].outerHTML;
//             original_output += output_line;
//             $("#ingredient-results").html(original_output); 
//         });	
//     } 
// selectedLast = '';				