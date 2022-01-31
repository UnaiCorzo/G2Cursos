// PETICIÓN AJAX FECHA/HORA API
var lang = $('html').attr('lang');
var zona = "";

$.ajax({
    url: "http://worldtimeapi.org/api/timezone/",
    dataType: 'json',
    success: rellenarZonas,
    error: function() {
      console.log(arguments);
    }
});

function rellenarZonas(respuesta) {
    const datalist_zonas = $('#zona');
    for (let i = 0; i < respuesta.length; i++) {
        if (respuesta[i] == "Europe/Madrid") {
            datalist_zonas.html(datalist_zonas.html() + "<option selected value='" + respuesta[i] + "'>" + respuesta[i] + "</option>");
        }
        else {
            datalist_zonas.html(datalist_zonas.html() + "<option value='" + respuesta[i] + "'>" + respuesta[i] + "</option>");
        }
    }

    zona = "Europe/Madrid";
}

setInterval(function() {
    $.ajax({
        url: "http://worldtimeapi.org/api/timezone/" + zona,
        dataType: 'json',
        success: mostrarFecha,
        error: function() {
          console.log(arguments);
        }
    });
  
    function mostrarFecha(respuesta) {
        const hora = $('.hora');
        const fecha = $('.fecha');

        let hora_mostrar = respuesta.datetime.split('T')[1].substring(0, 8);
        let fecha_mostrar = respuesta.datetime.split('T')[0];
  
        hora.html(hora_mostrar);
        fecha.html(fecha_mostrar);

        const nombre_zona = $('.nombre_zona');
        nombre_zona.html(zona);
    }
}, 1000);

const input_zona = $('#zona');
input_zona.change(cambiarFechaHora);

function cambiarFechaHora () {
    let zona_cambiar = $('#zona option:selected').val();
    zona = zona_cambiar;
}
const widget_fecha_hora = $('.fecha_hora');
const cabecera_fecha_hora = $('.cabecera_fecha_hora');
cabecera_fecha_hora.click(MostrarWidget);

function MostrarWidget () {
    let height_widget = widget_fecha_hora.css('height');
    widget_fecha_hora.css('transition', 'all .2s ease-in-out');
    widget_fecha_hora.css('top', 'calc(100vh - ' + height_widget + ')');

    cabecera_fecha_hora.click(ocultarWidget);

    const flecha_fecha_hora = $('.cabecera_fecha_hora svg');
    flecha_fecha_hora.css('transition', 'all .2s ease-in-out');
    flecha_fecha_hora.css('transform', 'rotate(180deg)');
}

function ocultarWidget () {
    widget_fecha_hora.css('transition', 'all .2s ease-in-out');
    widget_fecha_hora.css('top', 'calc(100vh - 50px)');

    cabecera_fecha_hora.click(MostrarWidget);

    const flecha_fecha_hora = $('.cabecera_fecha_hora svg');
    flecha_fecha_hora.css('transition', 'all .2s ease-in-out');
    flecha_fecha_hora.css('transform', 'rotate(0deg)');
}
// FIN PETICIÓN AJAX FECHA/HORA API