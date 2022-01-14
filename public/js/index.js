window.addEventListener('DOMContentLoaded', event => {
    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }
    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    // Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            offset: 74,
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
});

$(document).ready(function () {
    // CERRAR COOKIES
    const boton_aceptar = $('.boton_cookie button');
    boton_aceptar.click(cerrarCookies);

    const boton_cerrar = $('.cerrar_cookies');
    boton_cerrar.click(cerrarCookies);

    function cerrarCookies() {
        const cookies = $('.cookies');
        cookies.fadeOut();
    }
    // FIN CERRAR COOKIES

    // ANIMACIÓN IMÁGENES CURSOS
    const cards_cursos = $('.portfolio-item');
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

    // COOKIES
    setTimeout(function () {
        $("#cookieConsent").fadeIn(200);
    }, 1000);
    $("#closeCookieConsent, .cookieConsentOK").click(function () {
        $("#cookieConsent").fadeOut(200);
    });
    // FIN COOKIES

    // ABRIR MODAL CON ERROR
    if ($("#error_sesion").length > 0) {
        $("#modal_sesion").modal("show");
    }
    // FIN ABRIR MODAL CON ERROR

    // VALIDACIÓN FORMULARIOS
    $.validator.addMethod("formatoEmail", function (value, element) {
        var pattern = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        return this.optional(element) || pattern.test(value);
    });

    let idioma = $('html').attr('lang');

    let email_1 = "El email es requerido";
    let email_2 = "Formato de email no válido";
    let password_1 = "La contraseña es requerida";
    let password_2 = "La contraseña debe tener al menos 8 caracteres";
    let password_3 = "La contraseña no puede exceder los 32 caracteres";

    if (idioma == 'en') {
        email_1 = "Email required";
        email_2 = "Invalid format";
        password_1 = "Password required";
        password_2 = "Password must be at least 8 characters long";
        password_3 = "Password cannot exceed 32 characters"; 
    }
    else if (idioma == 'eu') {
        email_1 = "Helbide elektronikoa beharrezkoa da";
        email_2 = "Formatua ez da baliozkoa";
        password_1 = "Pasahitza beharrezkoa da";
        password_2 = "Pasahitzak gutxienez 8 karaktere izan behar ditu";
        password_3 = "Pasahitzak ezin ditu 32 karaktere baino gehiago izan"; 
    }

    $("#iniciar_sesion").validate({
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
        },
    });

    $.validator.addMethod("formatoDNI", function (value, element) {
        if (/^([0-9]{8})*[a-zA-Z]+$/.test(value)) {
            var numero = value.substr(0, value.length - 1);
            var let = value.substr(value.length - 1, 1).toUpperCase();
            numero = numero % 23;
            var letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
            letra = letra.substring(numero, numero + 1);
            if (letra == let) {
                return true
            };
            return false;
        }
        return this.optional(element);
    });

    $.validator.addMethod("formatoTexto", function (value, element) {
        let matchPattern = value.match(/\d+/g);
        if (matchPattern != null) {
            return this.optional(element);
        }
        return true;
    });

    $.validator.addMethod("matchPassword", function (value, element) {
        if ($("#password_1").val() == value) {
            return true;
        }
        return this.optional(element);
    });

    let name_1 = "El nombre es requerido";
    let name_2 = "El nombre no puede exceder los 32 caracteres";
    let name_3 = "El nombre no es válido";
    let surnames_1 = "Los apellidos son requeridos";
    let surnames_2 = "Los apellidos no pueden exceder los 32 caracteres";
    let surnames_3 = "Los apellidos no son válidos";
    let dni_1 = "El DNI es requerido";
    let dni_2 = "DNI no válido";
    let password_2_1 = "Repite la contraseña";
    let password_2_2 = "Las contraseñas no coinciden";

    if (idioma == 'en') {
        name_1 = "Name is required";
        name_2 = "Name cannot exceed 32 characters";
        name_3 = "Invalid name";
        surnames_1 = "Surname required";
        surnames_2 = "Surname cannot exceed 32 characters";
        surnames_3 = "Invalid surname";
        dni_1 = "ID is required";
        dni_2 = "Invalid ID";
        password_2_1 = "Repeat password";
        password_2_2 = "Passwords do not match";
    }
    else if (idioma == 'eu') {
        name_1 = "Izena beharrezkoa da";
        name_2 = "Izenak ezin ditu 32 karaktere baino gehiago izan";
        name_3 = "Formatua ez da baliozkoa";
        surnames_1 = "Abizena beharrezkoa da";
        surnames_2 = "Abizenak ezin ditu 32 karaktere baino gehiago izan";
        surnames_3 = "Formatua ez da baliozkoa";
        dni_1 = "NAN-a beharrezkoa da";
        dni_2 = "Formatua ez da baliozkoa";
        password_2_1 = "Errepikatu pasahitza";
        password_2_2 = "Pasahitzak ez datoz bat";
    }

    $("#registrarse").validate({
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
            dni: {
                required: true,
                formatoDNI: true,
            },
            email: {
                required: true,
                formatoEmail: true,
                email: true,
            },
            password1: {
                required: true,
                minlength: 8,
                maxlength: 32,
            },
            password2: {
                required: true,
                matchPassword: true,
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
            dni: {
                required: dni_1,
                formatoDNI: dni_2,
            },
            email: {
                required: email_1,
                formatoEmail: email_2,
                email: email_2,
            },
            password1: {
                required: password_1,
                minlength: password_2,
                maxlength: password_3,
            },
            password2: {
                required: password_2_1,
                matchPassword: password_2_2,
            },
        },
    });

    $.validator.addMethod("formatoPhone", function (value, element) {
        var pattern = /^\d+/;
        return this.optional(element) || pattern.test(value);
    });

    let phone_1 = "El teléfono es requerido";
    let phone_2 = "El teléfono solo puede contener números";
    let comments_1 = "El comentario es requerido";

    if (idioma == 'en') {
        phone_1 = "Phone required";
        phone_2 = "Phone can only contain numbers";
        comments_1 = "Comments are required";
    }
    else if (idioma == 'eu') {
        phone_1 = "Telefonoa beharrezkoa da";
        phone_2 = "Telefonoak zenbakiak baino ezin ditu izan";
        comments_1 = "Iruzkina beharrezkoa da";
    }

    $("#contactForm").validate({
        onkeyup: false,
        rules: {
            name: {
                required: true,
                maxlength: 32,
                formatoTexto: true,
            },
            email: {
                required: true,
                formatoEmail: true,
                email: true,
            },
            phone: {
                required: true,
                formatoPhone: true,
            },
            comments: {
                required: true,
            },
        },
        messages: {
            name: {
                required: name_1,
                maxlength: name_2,
                formatoTexto: name_3,
            },
            email: {
                required: email_1,
                formatoEmail: email_2,
                email: email_2,
            },
            phone: {
                required: phone_1,
                formatoPhone: phone_2,
            },
            comments: {
                required: comments_1,
            },
        },
    });
    // FIN VALIDACIÓN FORMULARIOS

    // CAMBIAR IDIOMA
    $("#prueba").change(function () {
        let language = $("#prueba option:selected").val();
        $(location).attr("href", language);
    });
    // FIN CAMBIAR IDIOMA
});
