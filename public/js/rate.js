var stars;
$(document).ready(function () {
    stars = $('#contenedor_est .estrella');
    stars.click(colorear);
    $('.rating').each(function(){
        var estrellas ="";
        for (let i = 0; i < $(this).attr("value"); i++) {
            estrellas +=  '<i class="bi bi-star-fill estrella"  style="color:yellow"></i>';
        }
        for (let i = 0; i <5 - $(this).attr("value"); i++) {
            estrellas +=  '<i class="bi bi-star estrella"  style="color:yellow"></i>';
            
        }
        $(this).html(estrellas);
    });
});
function colorear(){
    let current_star = $(this).attr('value');
    $('#estr_valor').val(current_star);
    stars.each(function() {
        if ($(this).attr('value')<=current_star) {
            $(this).removeClass("bi-star");
            $(this).addClass("bi-star-fill");
        }
        else{
            $(this).removeClass("bi-star-fill");
            $(this).addClass("bi-star");
        }
        
    });
 
}