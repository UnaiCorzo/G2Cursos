$(document).ready(function () {
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

    const input_zona = $('#zona');
    input_zona.change(cambiarFechaHora);

    function cambiarFechaHora () {
        let zona_cambiar = $('#zona option:selected').val();
        zona = zona_cambiar;
    }
    const widget_fecha_hora = $('.fecha_hora');
    const cabecera_fecha_hora = $('.cabecera_fecha_hora');
    cabecera_fecha_hora.click(mostrarOcultarWidget);
    var estado = 'cerrado';

    function mostrarOcultarWidget () {
        if (estado == 'cerrado') {
            estado = 'abierto';
        }
        else {
            estado = 'cerrado';
        }

        const intervalo_ajax = setInterval(function() {
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

                if (estado == 'abierto') {
                    widget_fecha_hora.css('width', '500px');
                    cabecera_fecha_hora.css('height', '50px');
                    cabecera_fecha_hora.css('justify-content', 'space-between');
                    cabecera_fecha_hora.html("<p>RELOJ</p><i class='fas fa-chevron-down flecha'></i>");
                    cabecera_fecha_hora.attr('title', 'Cerrar RELOJ');

                    let height_widget = widget_fecha_hora.css('height');
                    widget_fecha_hora.css('transition', 'all .2s ease-in-out');
                    widget_fecha_hora.css('top', 'calc(100vh - ' + height_widget + ')');
                }
                else {
                    widget_fecha_hora.css('width', '100px');
                    cabecera_fecha_hora.css('height', '70px');
                    cabecera_fecha_hora.css('justify-content', 'center');
                    cabecera_fecha_hora.html("<i class='far fa-clock reloj'></i>");
                    cabecera_fecha_hora.attr('title', 'Abrir RELOJ');

                    clearInterval(intervalo_ajax);
        
                    widget_fecha_hora.css('transition', 'all .2s ease-in-out');
                    widget_fecha_hora.css('top', 'calc(100vh - 70px)');
                }
            }
        }, 1000);
    }
    // FIN PETICIÓN AJAX FECHA/HORA API
});