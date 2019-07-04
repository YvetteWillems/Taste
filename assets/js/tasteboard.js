$(window).resize(function() {
    console.log('resize!!!!!');
    readVariables();
});

openTasteboard = () => {
    var tasteboard = readTasteboard();
    var tasteboard_ingredients = readTasteboardIngredients();
    if(tasteboard !== ''){
        // 1: Set OI and I:
        OI = tasteboard.org_id;
        selectedLast = OI;
        tasteboard_id = tasteboard.id;
        if(tasteboard_ingredients !== false){
            tasteboard_ingredients.map(function(ingredient, index){
                I[index]['id'] = parseInt(ingredient.igr_id);
                I[index]['connection'] = parseInt(ingredient.igr_connection);
            }); 
        }
        // 2: Display ingredients:
        // Do not show search input and ingredient list:
        $("#search-ingredient").css("display", "none"); 
        $("#list-ingredients").css("display", "none"); 
        // Show empty and save button:
        $("#save-button").css("display", "block"); 
        $("#empty-button").css("display", "block"); 
        readVariables();
    }
}

readVariables = () => {
    // 1: Display OI:
    if(OI !== ''){
        var original_ingredient = getIngredient(OI);
        original_output = `
            <div 
                id="i${original_ingredient.id}"
                onclick="ingredientSelected(${original_ingredient.id})" 
                class="original-ingr all-ingredients color-text-back-neg click choosen">
                <p>${original_ingredient.igr_name}</p>
            </div>`
        $("#ingredient-results").html(original_output);
        // 2: Display I:
        var degree = 0;
        I.map(function(I_ingredient, index){
            if(I_ingredient.id == ''){
                // Do nothing
            } else {
                // Create ingredient:
                selectedLast = I_ingredient.connection;
                var connection_ingredient = getIngredient(I_ingredient.connection);
                var connection_topthree = getTopThree(connection_ingredient);
                var ingredient = getIngredient(I_ingredient.id);
                var ingredientValues = getAromaValues(ingredient, connection_topthree);

                I_ingredient.connection !== OI ? degree += 60 : console.log('connection id = OI');

                coords = getCoords(connection_ingredient);
                var output = createOutput(ingredientValues[0], degree);
                output = $('<div></div>').html(output).find('div').addClass('choosen').end().html();
                original_output += output;
                $("#ingredient-results").html(original_output);
                
                I_ingredient.connection !== OI ? degree -= 60 : console.log('connection id = OI');
                degree += (360/10);	

                // Create line:
                drawLine(I_ingredient.id, I_ingredient.connection);
                var line = $('.line').last();
                var output_line = line[0].outerHTML;
                original_output += output_line;
                $("#ingredient-results").html(original_output); 
            }
        });	
        selectedLast = '';
    } else {
        // do nothing
    }			
}	