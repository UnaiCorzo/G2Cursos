$(document).ready(function () {
    // PETICIÓN AJAX DE CURSOS
    var lang = $('html').attr('lang');
    var route = "/" + lang + "/find/all";
    var cursos;

    $.ajax({
        type: 'GET',
        url: route,
        dataType: "JSON",
        success: recibirCursos,
    });

    function recibirCursos(cursos_json) {
        cursos = cursos_json;
        const cursos_mostrar = $('#cursos_mostrar');

        for (let i = 0; i < cursos_json.length; i++) {
            let categorias_html = "";
            for (let j = 0; j < cursos_json[i].categories.length; j++) {
                categorias_html += "<span class='badge badge-pill text-white items categorias_cursos' id='" + cursos_json[i].categories[j].id + "' style='background-color: " + cursos_json[i].categories[j].color + "'>" + cursos_json[i].categories[j].name + "</span>"
            }

            let precio;
            if (cursos_json[i].course.price == 0) {
                precio = "GRATIS";
            }
            else {
                precio = cursos_json[i].course.price + " €";
            }

            let modalidad;
            if (cursos_json[i].course.location != null) {
                if (lang == 'es') {
                    modalidad = "Presencial";
                }
                else if (lang == 'en') {
                    modalidad = "Presential";
                }
                else {
                    modalidad = "Presentziala";
                }
            }
            else {
                modalidad = "Online";
            }

            let ruta = "/" + lang + "/course/view/" + cursos_json[i].course.id;

            cursos_mostrar.html(cursos_mostrar.html() + "<div class='col-lg-4 col-sm-6 mb-4 cursos_buscar'><div class='portfolio-item'><a href='" + ruta + "' class='link_curso' id='curso_" + cursos_json[i].course.id + "'><div class='imagen_card'><span class='badge badge-pill text-white bg-success items modalidad'>" + modalidad + "</span><img class='img-fluid' src='/images/" + cursos_json[i].course.image + "' alt='" + cursos_json[i].course.name + "'/></div><div class='portfolio-caption'><div class='d-flex justify-content-between align-items-center'><div class='portfolio-caption-heading lead items titulo_curso me-2'>" + cursos_json[i].course.name + "</div><div class='lead bold descripcion_cursos'>" + precio + "</div></div><div class='row m-0 p-0'><div class='col-12 p-0 docente_cursos'><p class='m-0 items'>" + cursos_json[i].teacher.name + " " + cursos_json[i].teacher.surnames +  "</p></div><div class='col-12 p-0 valoracion'><p class='m-0 me-1 pt-1 items'>3.5</p><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star-half-alt'></i><i class='far fa-star'></i><br><p class='m-0 pt-1 items'>(52)</p></div><div class='col-12 m-0 p-0 mt-2 categorias'>" + categorias_html + "</div></div></div></a></div></div>");
        }

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

        // MOSTRAR/OCULTAR OPCIONES FILTROS
        const boton_busqueda = $('.boton_busqueda');
        boton_busqueda.click(mostrarOcultarFiltros);

        function mostrarOcultarFiltros() {
            const div_filtros = $('.filtros');

            if (div_filtros.css('display') == 'none') {
                div_filtros.css('display', 'flex');
            }
            else {
                div_filtros.css('display', 'none');
            }
        }
        // FIN MOSTRAR/OCULTAR OPCIONES FILTROS

        // CATEGORÍAS ACTIVAS
        const categorias_buscar = $('.categorias_crear');
        categorias_buscar.click(anadirActiva);
        var cat_activas = "";

        function anadirActiva() {
            const categoria_buscar = $(this);
            categoria_buscar.addClass('categoria_activa');
            cat_activas += categoria_buscar.attr('id') + ";";
            categoria_buscar.click(quitarActiva);

            console.log("ANADIR: " + cat_activas);
        }

        function quitarActiva() {
            const categoria_buscar = $(this);
            categoria_buscar.removeClass('categoria_activa');

            let categorias_lista2 = cat_activas.split(';')

            cat_activas = "";

            for (let i = 0; i < categorias_lista2.length; i++) {
                if (categorias_lista2[i] != categoria_buscar.attr('id')) {
                    if (i < (categorias_lista2.length - 1)) {
                        cat_activas += categorias_lista2[i] + ";";
                    }
                    else {
                        cat_activas += categorias_lista2[i];
                    }
                }
            }
            categoria_buscar.click(anadirActiva);

            console.log("QUITAR: " + cat_activas);
        }
        // FIN CATEGORÍAS ACTIVAS

        // BÚSQUEDA Y FILTROS
        const input_busqueda = $('#course_name');
        input_busqueda.keyup("change paste keyup", filtrarCursos);

        const boton_aplicar = $('#aplicar');
        boton_aplicar.click(filtrarCursos);

        function filtrarCursos() {
            let num_coincidencias = 0;
            let min_precio;
            let max_precio;

            if($('#min').val() == "") {
                min_precio = 0;
            }
            else {
                min_precio = $('#min').val();
            }

            if($('#max').val() == "") {
                max_precio = 99999;
            }
            else {
                max_precio = $('#max').val();
            }

            let modalidad = [];

            if ($('.modalidad_select option:selected').val() == "default") {
                modalidad[0] = "presencial";
                modalidad[1] = "online";
            }
            else {
                modalidad[0] = $('.modalidad_select option:selected').val();
                modalidad[1] = $('.modalidad_select option:selected').val();
            }


            let nombre_busqueda = input_busqueda.val().toLowerCase();

            const cursos_filtrar = $('.cursos_buscar');

            cursos_filtrar.each(function(indice) {
                let nombre_curso = cursos[indice].course.name.toLowerCase();

                let modalidad_curso;
                if (cursos[indice].course.location != null) {
                    modalidad_curso = "presencial";
                }
                else {
                    modalidad_curso = "online";
                }
                

                if ((nombre_curso.includes(nombre_busqueda)) && (cursos[indice].course.price <= max_precio && cursos[indice].course.price >= min_precio) && (modalidad_curso == modalidad[0] || modalidad_curso == modalidad[1]) && filtrarCategorias(cursos[indice].categories)) {
                    $(this).css('display', 'inline');
                    num_coincidencias++;
                }
                else {
                    $(this).css('display', 'none');
                }

                if (num_coincidencias == 0) {
                    $('.no_coincidencias').css('display', 'flex');
                }
                else {
                    $('.no_coincidencias').css('display', 'none');
                }
            });
        }

        function filtrarCategorias(categorias_curso_filtrar) {
            let categorias_seleccionadas = cat_activas.split(';');

            if (categorias_seleccionadas.length != 0) {
                let coincidencias = 0;
                for (let i = 0; i < categorias_seleccionadas.length; i++) {
                    for (let j = 0; j < categorias_curso_filtrar.length; j++) {
                        if (categorias_curso_filtrar[j].id == categorias_seleccionadas[i]) {
                            coincidencias++;
                        } 
                    }
                }

                if (coincidencias == categorias_seleccionadas.length - 1) {
                    return true;
                }
            }
            return false;
        }
        // FIN BÚSQUEDA Y FILTROS

    }
    // FIN PETICIÓN AJAX DE CURSOS
});