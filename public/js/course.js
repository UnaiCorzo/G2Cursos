$(document).ready(function () {
    // LINKS MENÚ ACTIVOS
    var title_pagina = $(document).attr("title");
    eliminarActivoPerfil();

    if (title_pagina == 'Mis Cursos | G2Cursos') {
        $('#link2').addClass('link_activo');
    }
    else if (title_pagina == 'Mi Perfil | G2Cursos') {
        $('#link3').addClass('link_activo');
    }

    function eliminarActivoPerfil() {
        $('.opciones_perfil').removeClass('link_activo');
    }
});

