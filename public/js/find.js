$(document).ready(function () {
    // PETICIÓN AJAX DE CURSOS
    var lang = $('html').attr('lang');
    var route = "/" + lang + "/find/all";

    $.ajax({
        type: 'GET',
        url: route,
        dataType: "JSON",
        success: recibirCursos,
    });

    function recibirCursos(cursos_json) {
        console.log(cursos_json);
        const cursos_mostrar = $('#cursos_mostrar');

        for (let i = 0; i < cursos_json.length; i++) {
            // let categorias = "";
            // console.log(cursos_json[i]);
            // for (let i = 1; i <= cursos_json[i].categories.length; i++) {
            //     categorias += "<span class='badge badge-pill text-white items categorias_crear' id='" + cursos_json[i].categories[i].id + "' style='background-color: " + cursos_json[i].categories[i].color + "'>" + cursos_json[i].categories[i].name + "</span>";
            // }

            cursos_mostrar.html(cursos_mostrar.html() + "<div class='col-lg-4 col-sm-6 mb-4'><div class='portfolio-item'><a href='' class='link_curso' id='curso'><div class='imagen_card'><span class='badge badge-pill text-white bg-success items modalidad'>{{ __('Presencial') }}</span><img class='img-fluid' src='/images/" + cursos_json[i].course.image + "' alt='...'/></div><div class='portfolio-caption'><div class='d-flex justify-content-between align-items-center'><div class='portfolio-caption-heading lead items titulo_curso me-2'>" + cursos_json[i].course.name + "</div><div class='lead bold descripcion_cursos'><i class='fas fa-check-circle check_curso'></i></div></div><div class='row m-0 p-0'><div class='col-12 p-0 docente_cursos'><p class='m-0 items'>Alberto Ramírez (Backskills)</p></div><div class='col-12 p-0 valoracion'><p class='m-0 me-1 pt-1 items'>3.5</p><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star-half-alt'></i><i class='far fa-star'></i><br><p class='m-0 pt-1 items'>(52)</p></div><div class='col-12 m-0 p-0 mt-2 categorias'>CATEGORÍAS</div></div></div></a></div></div>");
        }
    }
    // FIN PETICIÓN AJAX DE CURSOS

    // for (let i = 0; i < cursos_json.length; i++) {
    //     if (cursos[i].name.substring(0, nombre_busqueda.length) == nombre_busqueda) {
    //         cursos_mostrar.html(cursos_mostrar.html() + "<div class='col-lg-4 col-sm-6 mb-4'><div class='portfolio-item'><a href='' class='link_curso' id='curso'><div class='imagen_card'><span class='badge badge-pill text-white bg-success items modalidad'>{{ __('Presencial') }}</span><img class='img-fluid' src='{{ asset('assets/img/" + cursos_json[i].image + "laravel.png') }}' alt='...'/></div><div class='portfolio-caption'><div class='d-flex justify-content-between align-items-center'><div class='portfolio-caption-heading lead items titulo_curso me-2'>" + cursos_json[i].name + "</div><div class='lead bold descripcion_cursos'><i class='fas fa-check-circle check_curso'></i></div></div><div class='row m-0 p-0'><div class='col-12 p-0 docente_cursos'><p class='m-0 items'>Alberto Ramírez (Backskills)</p></div><div class='col-12 p-0 valoracion'><p class='m-0 me-1 pt-1 items'>3.5</p><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star-half-alt'></i><i class='far fa-star'></i><br><p class='m-0 pt-1 items'>(52)</p></div><div class='col-12 m-0 p-0 mt-2 categorias'><span class='badge badge-pill text-white items categorias_cursos bg-info'>PHP</span><span class='badge badge-pill text-white items categorias_cursos bg-warning'>Laravel</span><span class='badge badge-pill text-white items categorias_cursos bg-success'>Backend</span></div></div></div></a></div></div>");
    //     }
    // }
});