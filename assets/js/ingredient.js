// INPUT ONCLICK SLIDE UP
function inputSlideUp(e){
    $('.input-home').animate({ 'margin-top': '30%' }, "slow");
}

// INPUT
getInputIngredient = (event) => {
    var searchText = event.target.value.toLowerCase(); 
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
                    class="search-result color-text click"
                    onclick="selectFirstIngredient(event)"
                    >${ingredient.igr_name}
                </option>
            `
        }); 
    }
    $("#list-ingredients").html(output);			
}

// INPUT SELECTED:
selectFirstIngredient = (event) => {
    // 1: Get the selected ingredient:
    var selectedIngredient = getSelectedIngredient(event); 
    // 2: Set 'session' original ingredient & last selected ingredient:
    OI = selectedIngredient[0].id; 
    selectedLast = OI;
    // 3: Hide input field & search results:
    $("#search-ingredient").css("display", "none"); 
    $("#list-ingredients").css("display", "none"); 
    // 4: Show first ingredient:
    original_output = `
        <div 
            id="i${selectedIngredient[0]['id']}"
            onclick="ingredientSelected(${selectedIngredient[0]['id']})" 
            class="original-ingr all-ingredients color-text-back-neg click choosen">
            <p>${selectedIngredient[0]['igr_name']}</p>
        </div>`
    $("#ingredient-results").html(original_output);
    // 5: Show save and empty button:
    if(OI !== ''){
        $("#save-button").css("display", "block"); 
    }
    if(OI !== ''){
        $("#empty-button").css("display", "block"); 
    }
    // 6: Display matching ingredients:
    getMatchingIngredients(selectedIngredient[0]);
    ingredientSelected(selectedIngredient[0].id);  
}

ingredientSelected = (id) => { 
    // 1: Give element a drop shadow:
    $(`.all-ingredients`).css("box-shadow", "0px 0px 5px 0px rgba(0, 20, 39, 0.5)");
    var element = 'i' + id; 
    $(`#${element}`).css("box-shadow", "0px 0px 20px 5px rgba(0, 20, 39, 0.5)"); 
    // 2: Show ingredient info:
    $(window).width() > 991 ? displayIngredientInfo(id) : console.log("don't show ingredient details when on a small screen");
    // 2: Change color to ingredient specific colors!
    var ingredient = getIngredient(id); 
    changeColor(ingredient);
    // 3: Show menu with add / delete:
    var check = checkTasteboard(id); 
    if(check == true){
        // If this element is in I array, show delete button:
        output = `<div class="row">	
                    <div class="col"><button onclick="displayTasteboardInfo(); closeImage();" class="button color-text">tasteboard</button></div>
                    <div class="col text-center"><button onclick="displayIngredientInfo(${id})" class="button color-text">info</button></div>
                    <div class="col text-right"><button onclick="deleteIngredientFromTasteboard(${id})" class="button color-text">delete</button></div>
                </div>`
        $("#extra-menu").html(output); 
        $("#mobile-extra-menu").html(output); 
        if(selectedLast == id){
            // Do nothing
        } else {
            // If this element is in I array, but selectedLast != this element, set this element to last selected: 
            selectedLast = id;
            // And show matches:
            var ingredient = getIngredient(id); 
            getMatchingIngredients(ingredient); 
            changeColor(ingredient);
            $(`.all-ingredients`).css("box-shadow", "none");
            var element = 'i' + id; 
            $(`#${element}`).css("box-shadow", "0px 0px 15px 1px #001427"); 
        }
        return;
    } else {
        // If this element is not in I array, show add button:
        output = `<div class="row">	
                    <div class="col"><button onclick="displayTasteboardInfo(); closeImage();" class="button color-text">tasteboard</button></div>
                    <div class="col text-center"><button onclick="displayIngredientInfo(${id})" class="button color-text">info</button></div>
                    <div class="col text-right"><button onclick="addIngredientToTasteboard(${id})" class="button color-text">add</button></div>
                </div>`
        $("#extra-menu").html(output); 
        $("#mobile-extra-menu").html(output); 
        return;
    }
}

getMatchingIngredients = (ingredient) => {
    // 1: Get top 3 aromas of ingredient:
    var top_three = getTopThree(ingredient); 
    // 2: For each ingredient in ingredients, get a 'matching value'. Create array:
    var ingredientValues = []; 
    ingredients.map(function(ingredient, index){
        // Check if ingredient is in I array:
        var check = checkTasteboard(ingredient.id);
        if(check){
            // Do nothing
        } else {
            // Add to new array:
            // 3: Add up the values of top_three aroma's (as a way of checking which ingredient matches best):
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
    }); 
    // 5: Change var coords to coords selected ingredient:
    coords = getCoords(ingredient);
    // 6: Change to descending array: 
    var byValue = ingredientValues.slice(0);
    byValue.sort(function(a,b) {
        return b.aromaValue - a.aromaValue;
    });
    // 7: Limit to 20 results:
    var limitResults = byValue.filter(function(ingredient, index){
        return index < 20;
    });
    // 8: Display array:
    var random = randomizeIngredients(limitResults);
    displayIngredients(random); 
}

getTopThree = (ingredient) => {
    // 1: Get all aroma's of ingredient: 
    var ingredientAromas = getIngredientAromas(ingredient); 
    // 2: Get top aroma:
    var ingr_one = Object.keys(ingredientAromas).reduce((a, b) => ingredientAromas[a] > ingredientAromas[b] ? a : b); 
    // 3: Filter out top aroma:
    var ingredientAromasTwo = {};
    for (const [key, value] of Object.entries(ingredientAromas)) {
            if(key !== ingr_one){
                ingredientAromasTwo[key] = value;
            }
    };		
    // 4: Repeat:
    var ingr_two = Object.keys(ingredientAromasTwo).reduce((a, b) => ingredientAromasTwo[a] > ingredientAromasTwo[b] ? a : b); 
    var ingredientAromasThree = {};
    for (const [key, value] of Object.entries(ingredientAromasTwo)) {
            if(key !== ingr_two){
                ingredientAromasThree[key] = value;
            }
    };
    var ingr_three = Object.keys(ingredientAromasThree).reduce((a, b) => ingredientAromasThree[a] > ingredientAromasThree[b] ? a : b); 
    // 5: Make new array with top 3 values: 
    var top_three = [ingr_one, ingr_two, ingr_three]; 
    return top_three;
}

getIngredientAromas = (ingredient) => {
    var ingredientAromas = {
        "fruity": Number(ingredient.fruity),
        "green": Number(ingredient.green),
        "roasted": Number(ingredient.roasted),
        "cheese": Number(ingredient.cheese),
        "spicy": Number(ingredient.spicy),
        "almond": Number(ingredient.almond),
        "citrus": Number(ingredient.citrus),
        "fat": Number(ingredient.fat),
        "wood": Number(ingredient.wood),
        "floral": Number(ingredient.floral)
    };
    // etc, etc, etc.				
    return ingredientAromas; 
}

displayIngredients = (ingredientValues) => {
    var output = original_output;
    // 1: For each ingredient, create styling:
    var degree = 0;
    var count = ingredientValues.length;
    ingredientValues.map(function(ingredient, index){		        
        output += createOutput(ingredient, degree);       
        // 4: Change degree for next ingredient:
        degree += (360/count);
    }); 
    // 4: innerHTML output:	 
    document.getElementById('ingredient-results').innerHTML = output;
}

getIngredientPosition = (ingredient, degree) => {
    // 1: Get top and left value of the middle of the selected ingredient:
    var selected = getIngredient(selectedLast);
    var org_width = getElementWidth(selected);
    var org_correction = org_width/2;
    var left = coords.left + org_correction;
    var top = coords.top + org_correction;

    // 3: Set distance to selected ingredient:
    var distance = (170 - ingredient.aromaValue) * 1.8;
    var amount = parseFloat(distance + org_correction);
    var new_correction = ingredient.aromaValue/2; 
    // 4: Get new top and left value based on random degree:  
    var angle = degree * Math.PI/180; 
    var x = Math.cos(angle) * amount; 
    var y = Math.sin(angle) * amount; 
    var new_x = x - new_correction;
    var new_y = y - new_correction;

    top += new_y;
    left += new_x;
    var position = {
        "top": top, 
        "left": left
    }; 
    return position; 
}

getAromaValues = (ingredient, top_three) => {
    var ingredientValues = []; 
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

createOutput = (ingredient, degree) => {
    var position = getIngredientPosition(ingredient, degree);
    var top = position.top; 
    var left = position.left;
    var width = '';
    ingredient.aromaValue < 50 ? width = 50 : width = ingredient.aromaValue; 
    var borderRadius = width/2; 
    var opacity = ingredient.aromaValue/100;
    ingredient.aromaValue < 40 ? opacity = 0.4 : opacity = ingredient.aromaValue/100;
    var style = `"top:${top}px;left:${left}px;width:${width}px;height:${width}px;border-radius:${borderRadius}px;opacity:${opacity};"`; 
    // 3: Add ingredient to output:
        output = 
            `<div 
                id="i${ingredient.id}" 
                onclick="ingredientSelected(${ingredient.id})" 
                style=${style} 
                class="color-text-back-neg all-ingredients click">
                <p  class="ingredient-text">
                        ${ingredient.name}<br>
                </p>
            </div>`;
    return output;
}

function randomizeIngredients(results) {
    let ctr = results.length;
    let temp;
    let index;

    while (ctr > 0) {
        index = Math.floor(Math.random() * ctr);
        ctr--;
        temp = results[ctr];
        results[ctr] = results[index];
        results[index] = temp;
    }
    return results;
}

function dragElement(event) {
    ingredientContainer = document.getElementById('drag-ingredients');
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

    event = event || window.event;
    event.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = event.clientX;
    pos4 = event.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;

    function elementDrag(event) {
        event = event || window.event;
        event.preventDefault();
        // calculate the new cursor position:
        pos1 = pos3 - event.clientX;
        pos2 = pos4 - event.clientY;
        pos3 = event.clientX;
        pos4 = event.clientY;
        // set the element's new position:
        ingredientContainer.style.top = (ingredientContainer.offsetTop - pos2) + "px";
        ingredientContainer.style.left = (ingredientContainer.offsetLeft - pos1) + "px";
    }

    function closeDragElement() {
        // stop moving when mouse button is released:
        document.onmouseup = null;
        document.onmousemove = null;
    }
}

// functions:
getSelectedIngredient = (event) => {
    var selectedIngredient = ingredients.filter(ingredient => ingredient.id === event.target.value); 
    return selectedIngredient; 
}

getIngredient = (id) => {
    var ingredient = ingredients.filter(ingredient => ingredient.id == id); 
    return ingredient[0]; 
}

getCoords = (ingredient) => {
    id = 'i' + ingredient.id;
    var coords = $(`#${id}`).position();
    return coords;
}

getElementWidth = (ingredient) => {
    id = 'i' + ingredient.id;
    var element = document.getElementById(`${id}`);
    var coords = element.getBoundingClientRect();
    return coords.width;
}

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