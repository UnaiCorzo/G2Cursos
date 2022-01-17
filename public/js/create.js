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
        input_categorias.val(input_categorias.val() + categoria.text() + ';');
        console.log('AÑADIR: ' + input_categorias.val());

        categoria.click(quitarActiva);
    }

    function quitarActiva() {
        const categoria = $(this);
        categoria.removeClass('categoria_activa');

        let categorias_lista = input_categorias.val().split(';')
        
        input_categorias.val('');

        for (let i = 0; i < categorias_lista.length; i++) {
            if (categorias_lista[i] != categoria.text(  )) {
                if (i < (categorias_lista.length - 1)) {
                    input_categorias.val(input_categorias.val() + categorias_lista[i] + ';');
                }
                else {
                    input_categorias.val(input_categorias.val() + categorias_lista[i]);
                }
            }
        }
        console.log('QUITAR: ' + input_categorias.val());

        categoria.click(anadirActiva);
    }
    // FIN CATEGORÍAS ACTIVAS
});

