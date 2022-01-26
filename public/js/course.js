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

    // VALIDACIÓN VALORAR CURSO
    let idioma = $('html').attr('lang');

    let comment_1 = "El comentario es requerido";


    if (idioma == 'en') {
        comment_1 = "Comment required";
    }
    else if (idioma == 'eu') {
        comment_1 = "Iruzkina beharrezkoa da";
    }

    $("#valorar").validate({
        ignore: "",
        onkeyup: false,
        rules: {
            comment: {
                required: true,
            },
        },
        messages: {
            comment: {
                required: comment_1,
            },
        },
    });
    // FIN VALIDACIÓN VALORAR CURSO
});
