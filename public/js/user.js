$(document).ready(function () {
    // INPUTS DE EMPRESA
    const switch_empresa = $('#mySwitch');
    switch_empresa.change(mostrarOcularOpciones);

    function mostrarOcularOpciones() {
        const nombre_empresa = $('#nombre');
        const direccion_empresa = $('#direccion');
        const localidad_empresa = $('#localidad');

        if (switch_empresa.prop('checked')) {
            nombre_empresa.removeClass('d-none');
            direccion_empresa.removeClass('d-none');
            localidad_empresa.removeClass('d-none');

            nombre_empresa.addClass('d-flex');
            direccion_empresa.addClass('d-flex');
            localidad_empresa.addClass('d-flex');
        }
        else {
            nombre_empresa.removeClass('d-flex');
            direccion_empresa.removeClass('d-flex');
            localidad_empresa.removeClass('d-flex');

            nombre_empresa.addClass('d-none');
            direccion_empresa.addClass('d-none');
            localidad_empresa.addClass('d-none');
        }
    }
    // FIN INPUTS DE EMPRESA

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

    // VALIDACIÓN HACERSE CREADOR
    $("#hacerse_creador").validate({
        onkeyup: false,
        rules: {
            file: {
                required: true,
            },
            name: {
                required: true,
            },
            address: {
                required: true,
            },
            locality: {
                required: true,
            },
        },
        messages: {
            file: {
                required: "El currículum es requerido",
            },
            name: {
                required: "El nombre es requerido",
            },
            address: {
                required: "La dirección es requerida",
            },
            locality: {
                required: "La localidad es requerida",
            },
        },
    });
    // FIN VALIDACIÓN HACERSE CREADOR

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
});
