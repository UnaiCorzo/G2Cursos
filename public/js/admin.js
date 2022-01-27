$(document).ready(function () {
    // PETICIÓN AJAX DE EMPRESAS API
    var lang = $('html').attr('lang');

    $.ajax({ 
        type: 'POST', 
        url: 'https://developers.einforma.com/api/v1/oauth/token', 
        crossDomain: true, 
        data: { 
            client_id: 'krqc455wv0z9cgqk0glwrlhx4fjzz18mm3qur0m0.api.einforma.com',
            client_secret : '1KD1FJetK2HyoCN_0o2RUQ38CxzleZ3N9ggUO_x4iH4',
            grant_type: 'client_credentials',
            scope: 'buscar:consultar:empresas'
        }, 
        dataType: 'json', 
        success: pedirEmpresa, 
        error: function() { 
          console.log(arguments); 
        } 
      });
    
    function pedirEmpresa() {
        $.ajax({ 
            type: 'GET', 
            url: 'https://developers.einforma.com/api/v1/balance', 
            crossDomain: true, 
            dataType: 'json', 
            success: function() {
                console.log(arguments); 
            }, 
            error: function() { 
              console.log(arguments); 
            } 
        });
    }
    
    // FIN PETICIÓN AJAX DE EMPRESAS API

    
});