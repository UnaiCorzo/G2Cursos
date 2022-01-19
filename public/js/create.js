$(document).ready(function () {
    // LINKS MENÚ ACTIVOS
    var title_pagina = $(document).attr("title");
    eliminarActivoPerfil();

    if (title_pagina == 'Mis Cursos | G2Cursos'
        || title_pagina == 'My Courses | G2Cursos'
        || title_pagina == 'Nire Kurtsoak | G2Cursos'
    ) {
        $('#link2').addClass('link_activo');
    }
    else if (title_pagina == 'Mi Perfil | G2Cursos'
        || title_pagina == 'My Profile | G2Cursos'
        || title_pagina == 'Profila | G2Cursos'
    ) {
        $('#link3').addClass('link_activo');
    }

    function eliminarActivoPerfil() {
        $('.opciones_perfil').removeClass('link_activo');
    }
    // FIN LINKS MENÚ ACTIVOS

    // CAMBIAR IDIOMA
    $("#prueba").change(function () {
        let language = $("#prueba option:selected").val();
        $(location).attr("href", language);
    });
    // FIN CAMBIAR IDIOMA

    // CATEGORÍAS ACTIVAS
    const categorias = $('.categorias_crear');
    categorias.click(anadirActiva);
    const input_categorias = $('#categories');

    function anadirActiva() {
        const categoria = $(this);
        categoria.addClass('categoria_activa');
        input_categorias.val(input_categorias.val() + categoria.attr('id') + ';');
        // console.log('AÑADIR: ' + input_categorias.val());
        categoria.click(quitarActiva);
    }

    function quitarActiva() {
        const categoria = $(this);
        categoria.removeClass('categoria_activa');

        let categorias_lista = input_categorias.val().split(';')

        input_categorias.val('');

        for (let i = 0; i < categorias_lista.length; i++) {
            if (categorias_lista[i] != categoria.attr('id')) {
                if (i < (categorias_lista.length - 1)) {
                    input_categorias.val(input_categorias.val() + categorias_lista[i] + ';');
                }
                else {
                    input_categorias.val(input_categorias.val() + categorias_lista[i]);
                }
            }
        }
        // console.log('QUITAR: ' + input_categorias.val());
        categoria.click(anadirActiva);
    }
    // FIN CATEGORÍAS ACTIVAS

    // MOSTRAR/OCULTAR MAPA (CREAR CURSO)
    const switch_presencial = $('#switchPresencial');
    switch_presencial.change(mostrarOcularMapa);

    function mostrarOcularMapa() {
        const mapa = $('.map');

        if (switch_presencial.prop('checked')) {
            mapa.css('transition', 'all .2s ease-in-out');
            mapa.css('opacity', '1');
        }
        else {
            mapa.css('opacity', '0');
        }
    }
    // FIN MOSTRAR/OCULTAR MAPA (CREAR CURSO)

    // API MAPA
    const platform = new H.service.Platform({
        "app_id": "0JK53jN7Faa5a5rF35Sz",
        "app_code": "SqWcupOF8jY3JHYYKD0NSw",
    });
    const map = new H.Map(
        document.getElementById("map"),
        platform.createDefaultLayers().satellite.map,
        {
            zoom: 14,
            center: { lat: 43.32738577185026, lng: -1.9703783098086092 }
        }
    );
    const mapEvents = new H.mapevents.MapEvents(map);
    new H.mapevents.Behavior(mapEvents);

    map.addEventListener("tap", event => {
        map.removeObjects(map.getObjects());
        const position = map.screenToGeo(
            event.currentPointer.viewportX,
            event.currentPointer.viewportY
        );
        $("#location").val(position.lat + ";" + position.lng);
        const marker = new H.map.Marker(position);
        map.addObject(marker);
    });
    // FIN API MAPA
});
