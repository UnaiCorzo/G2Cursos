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
                required: "El email es requerido",
                formatoEmail: "Formato de email no válido",
                email: "Formato de email no válido",
            },
            password: {
                required: "La contraseña es requerida",
                minlength: "La contraseña debe tener al menos 8 caracteres",
                maxlength: "La contraseña no puede exceder los 32 caracteres",
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
                required: "El nombre es requerido",
                maxlength: "El nombre no puede exceder los 32 caracteres",
                formatoTexto: "El nombre no es válido",
            },
            surnames: {
                required: "El nombre es requerido",
                maxlength: "El nombre no puede exceder los 64 caracteres",
                formatoTexto: "El nombre no es válido",
            },
            dni: {
                required: "El DNI es requerido",
                formatoDNI: "DNI no válido",
            },
            email: {
                required: "El email es requerido",
                formatoEmail: "Formato de email no válido",
                email: "Formato de email no válido",
            },
            password1: {
                required: "La contraseña es requerida",
                minlength: "La contraseña debe tener al menos 8 caracteres",
                maxlength: "La contraseña no puede exceder los 32 caracteres",
            },
            password2: {
                required: "Repite la contraseña",
                matchPassword: "Las contraseñas no coinciden",
            },
        },
    });
    // FIN VALIDACIÓN FORMULARIOS
});
