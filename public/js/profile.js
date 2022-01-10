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
                email: true,
            },
        },
        messages: {
            name: {
                required: "El nombre es requerido",
                maxlength: "El nombre no puede exceder los 32 caracteres",
                formatoTexto: "El nombre no es válido",
            },
            surnames: {
                required: "El nombre es requerido",
                maxlength: "El nombre no puede exceder los 64 caracteres",
                formatoTexto: "El nombre no es válido",
            },
            email: {
                required: "El email es requerido",
                formatoEmail: "Formato de email no válido",
                email: "Formato de email no válido",
            },
        },
    });

    $.validator.addMethod("matchPassword", function (value, element) {
        if ($("#password_2").val() == value) {
            return true;
        }
        return this.optional(element);
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
                required: "La contraseña es requerida",
                minlength: "La contraseña debe tener al menos 8 caracteres",
                maxlength: "La contraseña no puede exceder los 32 caracteres",
            },
            password2: {
                required: "La contraseña es requerida",
                minlength: "La contraseña debe tener al menos 8 caracteres",
                maxlength: "La contraseña no puede exceder los 32 caracteres",
            },
            password3: {
                required: "Repite la contraseña",
                matchPassword: "Las contraseñas no coinciden",
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

    // ABRIR MODAL CON ERROR
    if ($("#error_password").length > 0) {
        $("#modal_password").modal("show");
    }
    // FIN ABRIR MODAL CON ERROR
});