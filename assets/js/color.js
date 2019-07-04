changeColor = (ingredient) => {
    var igr_linecolor = getIngredientColor(ingredient.igr_linecolor);
    var igr_backcolor = getIngredientColor(ingredient.igr_backcolor);
    $(".color-text").css("color", `${igr_linecolor.clr_code}`);
    $(".color-text-neg").css("color", `${igr_backcolor.clr_code}`);
    $(".color-text-back").css({
                    "color": `${igr_linecolor.clr_code}`, 
                    "background-color": `${igr_backcolor.clr_code}`
                });
    $(".color-text-back-neg").css({
                    "color": `${igr_backcolor.clr_code}`, 
                    "background-color": `${igr_linecolor.clr_code}`
                });
    $("a:hover").css("color", `${igr_linecolor.clr_code}`);
    $("a:visited").css("color", `${igr_linecolor.clr_code}`);
    $("input::placeholder").css("color", `${igr_linecolor.clr_code}`);

    current_color = `color:${igr_linecolor.clr_code};background-color:${igr_backcolor.clr_code}`;
}

getIngredientColor = (id) => {
    var colors = getColors();
    var ingredientColor = colors.filter(color => color.id === id); 
    return ingredientColor[0]; 
}