/*!
* Start Bootstrap - Agency v7.0.10 (https://startbootstrap.com/theme/agency)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
*/
//
// Scripts
// 

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
    setTimeout(function () {
        $("#cookieConsent").fadeIn(200);
    }, 1000);
    $("#closeCookieConsent, .cookieConsentOK").click(function () {
        $("#cookieConsent").fadeOut(200);
    });
});

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

