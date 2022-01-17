$(document).ready(function () {
    // HABILITAR INPUTS DE EDITAR INFORMACIÓN PERSONAL
    const botones_editar = $('.boton_editar');
    botones_editar.click(function () {
        const boton_editar = $(this);
        boton_editar.attr('disabled', 'disabled');
        let id_parent = boton_editar.parent().attr('id');

        const input_habilitar = $('#' + id_parent + ' input');
        input_habilitar.removeAttr('disabled');
        input_habilitar.focus();

        const boton_modificar = $('#modifyButton');
        boton_modificar.removeAttr('disabled');
    });
    // FIN HABILITAR INPUTS DE EDITAR INFORMACIÓN 

    // INPUTS DE EMPRESA
    const switch_empresa = $('#mySwitch');
    switch_empresa.change(function () {
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
    });
    // FIN INPUTS DE EMPRESA

    // VALIDACIÓN FORMULARIO
    $.validator.addMethod("formatoEmail", function (value, element) {
        var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        return this.optional(element) || pattern.test(value);
    });

    $.validator.addMethod("formatoTexto", function (value, element) {
        let matchPattern = value.match(/\d+/g);
        if (matchPattern != null) {
            return this.optional(element);
        }
        return true;
    });

    $.validator.addMethod("matchPassword", function (value, element) {
        if ($("#password_2").val() == value) {
            return true;
        }
        return this.optional(element);
    });

    let idioma = $('html').attr('lang');

    let name_1 = "El nombre es requerido";
    let name_2 = "El nombre no puede exceder los 32 caracteres";
    let name_3 = "El nombre no es válido";
    let surnames_1 = "Los apellidos son requeridos";
    let surnames_2 = "Los apellidos no pueden exceder los 32 caracteres";
    let surnames_3 = "Los apellidos no son válidos";
    let email_1 = "El email es requerido";
    let email_2 = "El email no es válido";
    let password_1 = "La contraseña es requerida";
    let password_2 = "La contraseña debe tener al menos 8 caracteres";
    let password_3 = "La contraseña no puede exceder los 32 caracteres";
    let password_2_1 = "Repite la contraseña";
    let password_2_2 = "Las contraseñas no coinciden";
    let file_1 = "El currículum es requerido";
    let address_1 = "La dirección es requerida";
    let locality_1 = "La localidad es requerida";

    if (idioma == 'en') {
        name_1 = "Name required";
        name_2 = "Name cannot exceed 32 characters";
        name_3 = "Invalid name";
        surnames_1 = "Surname is required";
        surnames_2 = "Surname cannot exceed 32 characters";
        surnames_3 = "Invalid surname";
        email_1 = "Email required";
        email_2 = "Invalid email";
        password_1 = "Password required";
        password_2 = "Password must be at least 8 characters long";
        password_3 = "Password cannot exceed 32 characters";
        password_2_1 = "Repeat password";
        password_2_2 = "Passwords do not match";
        file_1 = "Curriculum required";
        address_1 = "Address required";
        locality_1 = "Locality required";
    }
    else if (idioma == 'eu') {
        name_1 = "Izena beharrezkoa da";
        name_2 = "Izenak ezin ditu 32 karaktere baino gehiago izan";
        name_3 = "Formatua ez da baliozkoa";
        surnames_1 = "Abizena beharrezkoa da";
        surnames_2 = "Abizenak ezin ditu 32 karaktere baino gehiago izan";
        surnames_3 = "Formatua ez da baliozkoa";
        email_1 = "Helbide elektronikoa beharrezkoa da";
        email_2 = "Formatua ez da baliozkoa";
        password_1 = "Pasahitza beharrezkoa da";
        password_2 = "Pasahitzak gutxienez 8 karaktere izan behar ditu";
        password_3 = "Pasahitzak ezin ditu 32 karaktere baino gehiago izan";
        password_2_1 = "Errepikatu pasahitza";
        password_2_2 = "Pasahitzak ez datoz bat";
        file_1 = "Curriculuma beharrezkoa da";
        address_1 = "Helbidea beharrezkoa da";
        locality_1 = "Herria beharrezkoa da";
    }

    $("#modificar_perfil").validate({
        onkeyup: false,
        rules: {
            name: {
                required: true,
                maxlength: 32,
                formatoTexto: true,
            },
            surnames: {
                required: true,
                maxlength: 64,
                formatoTexto: true,
            },
            email: {
                required: true,
                formatoEmail: true,
            },
        },
        messages: {
            name: {
                required: name_1,
                maxlength: name_2,
                formatoTexto: name_3,
            },
            surnames: {
                required: surnames_1,
                maxlength: surnames_2,
                formatoTexto: surnames_3,
            },
            email: {
                required: email_1,
                formatoEmail: email_2,
            },
        },
    });

    $("#modificar_password").validate({
        onkeyup: false,
        rules: {
            password1: {
                required: true,
                minlength: 8,
                maxlength: 32,
            },
            password2: {
                required: true,
                minlength: 8,
                maxlength: 32,
            },
            password3: {
                required: true,
                matchPassword: true,
            },
        },
        messages: {
            password1: {
                required: password_1,
                minlength: password_2,
                maxlength: password_3,
            },
            password2: {
                required: password_1,
                minlength: password_2,
                maxlength: password_3,
            },
            password3: {
                required: password_2_1,
                matchPassword: password_2_2,
            },
        },
    });
    // FIN VALIDACIÓN FORMULARIO

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
                required: file_1,
            },
            name: {
                required: name_1,
            },
            address: {
                required: address_1,
            },
            locality: {
                required: locality_1,
            },
        },
    });
    // FIN VALIDACIÓN HACERSE CREADOR

    // ABRIR MODAL CON ERROR
    if ($("#error_password").length > 0) {
        $("#modal_password").modal("show");
    }
    // FIN ABRIR MODAL CON ERROR

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
