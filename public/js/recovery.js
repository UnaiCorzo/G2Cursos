$(document).ready(function () {
    // VALIDACIÓN FORMULARIOS
    $.validator.addMethod("formatoEmail", function (value, element) {
        var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        return this.optional(element) || pattern.test(value);
    });

    $.validator.addMethod("matchPassword", function (value, element) {
        if ($("#password").val() == value) {
            return true;
        }
        return this.optional(element);
    });

    let idioma = $('html').attr('lang');

    let password_2_1 = "Repite la contraseña";
    let password_2_2 = "Las contraseñas no coinciden";
    let email_1 = "El email es requerido";
    let email_2 = "Formato de email no válido";
    let password_1 = "La contraseña es requerida";
    let password_2 = "La contraseña debe tener al menos 8 caracteres";
    let password_3 = "La contraseña no puede exceder los 32 caracteres";

    if (idioma == 'en') {
        password_2_1 = "Repeat password";
        password_2_2 = "Passwords do not match";
        email_1 = "Email required";
        email_2 = "Invalid format";
        password_1 = "Password required";
        password_2 = "Password must be at least 8 characters long";
        password_3 = "Password cannot exceed 32 characters";
    }
    else if (idioma == 'eu') {
        password_2_1 = "Errepikatu pasahitza";
        password_2_2 = "Pasahitzak ez datoz bat";
        email_1 = "Posta elektronikoa beharrezkoa da";
        email_2 = "Formatua ez da baliozkoa";
        password_1 = "Pasahitza beharrezkoa da";
        password_2 = "Pasahitzak gutxienez 8 karaktere izan behar ditu";
        password_3 = "Pasahitzak ezin ditu 32 karaktere baino gehiago izan";
    }

    $("#recuperar_1").validate({
        onkeyup: false,
        rules: {
            email: {
                required: true,
                formatoEmail: true,
                email: true,
            },
        },
        messages: {
            email: {
                required: email_1,
                formatoEmail: email_2,
                email: email_2,
            },
        },
    });

    $("#recuperar_2").validate({
        onkeyup: false,
        rules: {
            email: {
                required: true,
                formatoEmail: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8,
                maxlength: 32,
            },
            password_confirmation: {
                required: true,
                matchPassword: true,
            },
        },
        messages: {
            email: {
                required: email_1,
                formatoEmail: email_2,
                email: email_2,
            },
            password: {
                required: password_1,
                minlength: password_2,
                maxlength: password_3,
            },
            password_confirmation: {
                required: password_2_1,
                matchPassword: password_2_2,
            },
        },
    });
    // FIN VALIDACIÓN FORMULARIOS
});
