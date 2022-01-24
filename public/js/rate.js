var stars;
$(document).ready(function () {
    stars = $('#contenedor_est .estrella');
    stars.click(colorear);
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