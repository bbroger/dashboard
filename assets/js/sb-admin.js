(function ($) {

    /*
     * O use strict é uma funcionalidade do ECMAScript a partir de sua versão 5, uma expressão literal ignorada por versões anteriores do ECMAScript, e do JavaScript a baixo da 1.8.5. 
     * O que é ela faz basicamente é melhorar a qualidade do código, pois chama exceções quando usamos variáveis não declaradas, por exemplo. 
     * Ou seja, o código é executado de forma mais rigorosa, por isso é chamado de strict mode ou modo restrito.
     * 
     * Você também não consegue usar palavras reservadas do JavaScript no strict mode, como por exemplo nomear uma variável como eval, e não consegue usar recursos obsoletos ou depreciados.
     */
    "use strict";

    $(document).ready(function () {

        /* Alternar a navegação lateral */
        $("#sidebarToggle").on('click', function (e) {
            e.preventDefault();
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
        });

        /* Evitar que o wrapper de conteúdo desloque quando a navegação lateral fixa passa por cima */
        $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
            if ($(window).width() > 768) {
                var e0 = e.originalEvent,
                        delta = e0.wheelDelta || -e0.detail;
                this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                e.preventDefault();
            }
        });

        /* Vá até o botão superior aparecer */
        $(document).on('scroll', function () {
            var scrollDistance = $(this).scrollTop();
            if (scrollDistance > 100) {
                $('.scroll-to-top').fadeIn();
            } else {
                $('.scroll-to-top').fadeOut();
            }
        });

        /* Rolagem suave usando o jQuery easing */
        $(document).on('click', 'a.scroll-to-top', function (event) {
            var $anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: ($($anchor.attr('href')).offset().top)
            }, 1000, 'easeInOutExpo');
            event.preventDefault();
        });

    });
    // READY 

})(jQuery); // End of use strict
