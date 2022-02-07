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
    else if (title_pagina == 'Cursos creados | G2Cursos'
        || title_pagina == 'Created Courses | G2Cursos'
        || title_pagina == 'Sortutako kurtsoak | G2Cursos'
    ) {
        $('#link1').addClass('link_activo');
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

    // ANIMACIÓN IMÁGENES CURSOS
    const cards_cursos = $('.portfolio-item a');
    cards_cursos.mouseover(escalarImagenes);
    cards_cursos.mouseout(rescalarImagenes);

    function escalarImagenes() {
        const card_curso = $(this);
        let id_card = card_curso.attr('id');

        let imagen_card = $('#' + id_card + ' .imagen_card img');
        imagen_card.css('transition', 'transform .2s');
        imagen_card.css('transform', 'scale(1.1)');

        const modalidad = $('#' + id_card + ' .imagen_card .modalidad');
        modalidad.css('transition', 'opacity .2s ease-in-out');
        modalidad.css('opacity', '1');
        modalidad.css('transition', 'box-shadow .2s ease-in-out');
        modalidad.css('box-shadow', '#0B132B 0px 0px 2px');
    }

    function rescalarImagenes() {
        const card_curso = $(this);
        let id_card = card_curso.attr('id');

        let imagen_card = $('#' + id_card + ' img');
        imagen_card.css('transition', 'transform .2s');
        imagen_card.css('transform', 'scale(1)');

        const modalidad = $('#' + id_card + ' .imagen_card .modalidad');
        modalidad.css('transition', 'opacity .2s ease-in-out');
        modalidad.css('opacity', '.8');
        modalidad.css('transition', 'box-shadow .2s ease-in-out');
        modalidad.css('box-shadow', 'transparent 0px 0px 0px');
    }
    // FIN ANIMACIÓN IMÁGENES CURSOS

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

    for (let i = 0; i < categorias_actuales.length; i++) {
        $('#' + categorias_actuales[i].id).click();
    }
    // FIN CATEGORÍAS ACTIVAS

    // MOSTRAR/OCULTAR MAPA (EDITAR CURSO)
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
            $("#location").val("");
        }
    }
    // FIN MOSTRAR/OCULTAR MAPA (EDITAR CURSO)

    // API MAPA
    const platform = new H.service.Platform({
        "app_id": "0JK53jN7Faa5a5rF35Sz",
        "app_code": "SqWcupOF8jY3JHYYKD0NSw",
    });

    var map;
    if (curso.location != null) {
        let coordenadas = curso.location.split(';');

        map = new H.Map(
            document.getElementById("map"),
            platform.createDefaultLayers().satellite.map,
            {
                zoom: 14,
                center: { lat: coordenadas[0], lng: coordenadas[1] }
            }
        );

        $('#switchPresencial').val('yes');
        $('#switchPresencial').prop('checked', 'checked');
        $('.map').css('opacity', '1');
    }
    else {
        map = new H.Map(
            document.getElementById("map"),
            platform.createDefaultLayers().satellite.map,
            {
                zoom: 14,
                center: { lat: 43.32738577185026, lng: -1.9703783098086092 }
            }
        );
    }

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

    // VALIDACIÓN CREAR CURSO
    $.validator.addMethod("priceMin", function (value, element) {
        if (value < 0) {
            return this.optional(element);
        }
        return true;
    });

    $.validator.addMethod("categoriesMin", function (value, element) {
        if (value == "") {
            return false;
        }
        return true;
    });

    $.validator.addMethod("categoriesMax", function (value, element) {
        if (value.split(";").length > 6) {
            return false;
        }
        return true;
    });

    $.validator.addMethod("imageFormat", function (value, element) {
        let filename = value.split(".");
        if (filename.length != 2) {
            return this.optional(element);
        }
        let extension = filename[1].toLowerCase();
        if (extension == "jpg" || extension == "jpeg" || extension == "png") {
            return true;
        }
        return this.optional(element);
    });

    $.validator.addMethod("locationSelection", function (value, element) {
        if (value == "" && $("#map").css("opacity") == 1) {
            return false;
        }
        return true;
    });

    let idioma = $('html').attr('lang');

    let name_1 = "El título es requerido";
    let name_2 = "El título no puede superar los 64 caracteres";
    let price_1 = "El precio es requerido";
    let price_2 = "El precio no puede ser negativo";
    let categories_1 = "Mínimo de categorías: 1";
    let categories_2 = "Máximo de categorías: 5";
    let image_2 = "Formatos válidos: .jpg, .jpeg, .png";
    let description_1 = "La descripción es requerida";
    let location_1 = "La ubicación es requerida";

    if (idioma == 'en') {
        name_1 = "Title required";
        name_2 = "Title cannot exceed 64 characters";
        price_1 = "Price required";
        price_2 = "Price cannot be negative";
        categories_1 = "Minimum categories: 1";
        categories_2 = "Maximum categories: 5";
        image_2 = "Valid formats: .jpg, .jpeg, .png";
        description_1 = "Description required";
        location_1 = "Location required";
    }
    else if (idioma == 'eu') {
        name_1 = "Izenburua beharrezkoa da";
        name_2 = "Izenburuak ezin ditu 64 karaktere baino gehiago izan";
        price_1 = "Prezioa beharrezkoa da";
        price_2 = "Prezioa ezin da negatiboa izan";
        categories_1 = "Gutxieneko kategoriak: 1";
        categories_2 = "Gehieneko kategoriak: 5";
        image_2 = "Baliozko formatuak: .jpg, .jpeg, .png";
        description_1 = "Deskribapena beharrezkoa da";
        location_1 = "Kokapena beharrezkoa da";
    }

    $("#crear_curso").validate({
        ignore: "",
        onkeyup: false,
        rules: {
            name: {
                required: true,
                maxlength: 64,
            },
            price: {
                required: true,
                priceMin: true,
            },
            categories: {
                categoriesMin: true,
                categoriesMax: true,
            },
            image: {
                imageFormat: true,
            },
            description: {
                required: true,
            },
            location: {
                locationSelection: true,
            },
        },
        messages: {
            name: {
                required: name_1,
                maxlength: name_2,
            },
            price: {
                required: price_1,
                priceMin: price_2,
            },
            categories: {
                categoriesMin: categories_1,
                categoriesMax: categories_2,
            },
            image: {
                imageFormat: image_2,
            },
            description: {
                required: description_1,
            },
            location: {
                locationSelection: location_1,
            },
        },
    });
    // FIN VALIDACIÓN CREAR CURSO
});
