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

        if (input_habilitar.attr('name') == 'contrasena') {
            const bloque_repetir = $('#repetir_contrasena_perfil');
            bloque_repetir.removeClass('d-none');
            bloque_repetir.addClass('d-flex');
        }

        const boton_modificar = $('#modifyButton');
        boton_modificar.removeAttr('disabled');
    });
    // FIN HABILITAR INPUTS DE EDITAR INFORMACIÓN PERSONAL

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
    // FIN VALIDACIÓN FORMULARIO
});