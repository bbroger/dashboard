/*
 * Esta estrutura 
 * ( function () { .... } )();
 * É chamada IIFE (Expressão de Função Imediatamente Invocada), será executada imediatamente, quando o intérprete chegar a esta linha. 
 * Então, quando você está escrevendo estas linhas:
 * Isto significa que o interpretador invocará esta função imediatamente, e passará jQuery como parâmetro, que será usado dentro da função como $.
 * 
 */
(function ($) {

    /*
     * O use strict é uma funcionalidade do ECMAScript a partir de sua versão 5, uma expressão literal ignorada por versões anteriores do ECMAScript, e do JavaScript a baixo da 1.8.5. 
     * O que é ela faz basicamente é melhorar a qualidade do código, pois chama exceções quando usamos variáveis não declaradas, por exemplo. 
     * Ou seja, o código é executado de forma mais rigorosa, por isso é chamado de strict mode ou modo restrito.
     * 
     * Você também não consegue usar palavras reservadas do JavaScript no strict mode, como por exemplo nomear uma variável como eval, e não consegue usar recursos obsoletos ou depreciados.
     */
    "use strict";

    /*
     * É uma boa prática esperar que o documento esteja totalmente carregado e pronto antes de trabalhar com ele. 
     * Isso também permite que você tenha seu código JavaScript antes do corpo do seu documento, na seção head.
     * 
     * Uma página não pode ser manipulada com segurança até que o documento esteja "pronto". 
     * O jQuery detecta esse estado de prontidão para você. 
     * O código incluído dentro de $(document).ready() será executado somente quando a página (DOM - Document Document Model) estiver pronta para executar o código JavaScript. 
     * O código incluído dentro de $(window).on("load", function(){...}) será executado assim que a página inteira (imagens ou iframes), não apenas o DOM, estiver pronta.
     *
     */
    $(document).ready(function () {

        var sb_plugin_ajax_url, sb_plugin_url, lang_php = "", link, new_user_id = getRandomInt(9999999, 99999999), err = $(".sb-error-msg-reg"), msg;

        if (err.length > 0) {
            /* O método split() divide um objeto String em um array de strings ao separar a string em substrings */
            msg = $(err).attr("data-messages").split("|");
        }

        /* Obter endereço src # sb-php-init */
        sb_plugin_url = $("#sb-php-init").attr("src");
        lang_php = sb_plugin_url;

        /* O método substr() retorna os caracteres em uma string começando no local especificado através do número especificado de caracteres. */
        sb_plugin_url = sb_plugin_url.substr(0, sb_plugin_url.lastIndexOf("/assets"));

        /* Armazenar caminho para CORE.PHP */
        sb_plugin_ajax_url = sb_plugin_url + "/ajax";

        /* Login */
        $("body").on("click", ".sb-submit-login", function (e) {
            e.preventDefault();
            /*  Resgatar valores de entrada */
            var _user = $('.sb-input-user input').val();
            var _password = $('.sb-input-psw input').val();

            /* Verifique se USUÁRIO ou E-MAIL foram preenchidos */
            if ((_user.length == 0 || _user.length == null) && (_user == "" || _user == null)) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[0]).show();
                $(".sb-input-reg-codUser input").focus();
                return false;
            }

            /*  Verifique se a senha não está em branco, Verifique se a senha tem mais de quatro caracteres */
            if ((_password.length == 0 || _password.length == null) && (_password == "" || _password == null)) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[1]).show();
                $(".sb-input-reg-psw input").focus();
                return false;
            } else if (_password.length <= 3) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[2]).show();
                $(".sb-input-reg-psw input").focus();
                return false;
            } else {
                $(err).addClass('toast hide');
                $(err).hide();
            }

            /* Iniciar pedido de ajax */
            jQuery.ajax({
                method: "POST",
                url: sb_plugin_ajax_url + '/sb_ajax',
                xhrFields: {withCredentials: true},
                data: {
                    action: 'sb_ajax_login',
                    user: _user,
                    password: _password
                },
                async: false
            }).done(function (response) {
                if (response === "success") {
                    $(".sb-error-msg").hide();
                    link = window.location.href;
                    link = link.replace("&login=true", "").replace("?login=true", "");
                    if (link.indexOf("?") > 0) {
                        window.location.href = link + "&login=true";
                    } else {
                        window.location.href = link + "?login=true";
                    }
                } else {
                    $(err).removeClass('toast hide');
                    $(err).addClass('alert alert-danger');
                    $(err).html(msg[9]).show();
                    $(".sb-input-user input").focus();
                    return false;
                }
            });

        });

        /* Limpar - Encerrar sessão do usuário */
        $("body").on("click", ".sb-logout", function () {
            jQuery.ajax({
                method: "POST",
                url: sb_plugin_ajax_url + '/sb_ajax',
                xhrFields: {withCredentials: true},
                data: {action: 'sb_ajax_logout'}
            }).done(function (response) {
                if (response === "success") {
                    var link = window.location.href;
                    link = link.replace("&logout=true", "").replace("?logout=true", "").replace("&login=true", "").replace("?login=true", "");
                    if (link.indexOf("?") > 0) {
                        window.location.href = link + "&logout=true";
                    } else {
                        window.location.href = link + "?logout=true";
                    }
                }
            });
        });

        /* Cadastrar novos usuários */
        $("body").on("click", ".sb-submit-register", function (e) {
            e.preventDefault();

            /* Resgatar valores de entrada */
            var _codUser = $(".sb-input-reg-codUser input").val();
            var _user = $(".sb-input-reg-user input").val();

            var _lvl = $(".sb-input-reg-level input").val();

            var _email = $(".sb-input-reg-email input").val();
            var _psw = $(".sb-input-reg-psw input").val();

            /*
             * Validar usuário com expressão regular
             * a-zA-Z Somente letras com acentos
             * /i Não leva em consideração maiúsculas e minúsculas (case-insensitive).
             */
            var parse_email = /^[a-z0-9\\._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i;
            var parse_user = /^([a-zA-Z]|\s+)+$/;

            /* Verificar se código foi informado */
            if ((_codUser.length == 0 || _codUser.length == null) && (_codUser == "" || _codUser == null)) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[9]).show();
                $(".sb-input-reg-codUser input").focus();
                return false;
            }

            /* Verificar caracteres especiais ou números */
            if (parse_user.test(_user)) {
                $(err).addClass('toast hide');
                $(err).hide();
            } else {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[4]).show();
                $(".sb-input-reg-user input").focus();
                return false;
            }

            /* Validar e-mail */
            if (parse_email.test(_email)) {
                $(err).addClass('toast hide');
                $("").hide();
            } else {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[3]).show();
                $(".sb-input-reg-email input").focus();
                return false;
            }

            /* Verificar se nível foi informado */
            if ((_lvl.length == 0 || _lvl.length == null) && (_lvl == "" || _lvl == null)) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[8]).show();
                $(".sb-input-reg-level input").focus();
                return false;
            }

            /*  Verifique se a senha não está em branco, Verifique se a senha tem mais de quatro caracteres */
            if ((_psw.length == 0 || _psw.length == null) && (_psw == "" || _psw == null)) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[5]).show();
                $(".sb-input-reg-psw input").focus();
                return false;
            } else if (_psw.length <= 3) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[1]).show();
                $(".sb-input-reg-psw input").focus();
                return false;
            } else {
                $(err).addClass('toast hide');
                $(err).hide();
            }

            /* Verifique se as senhas correspondem */
            if (_psw === $(".sb-input-reg-psw-2 input").val()) {

                $(err).addClass('toast hide');
                /* Iniciar pedido de ajax */
                jQuery.ajax({
                    method: "POST",
                    url: sb_plugin_ajax_url + '/sb_ajax',
                    xhrFields: {withCredentials: true},
                    data: {
                        action: 'sb_ajax_register',
                        id: new_user_id,
                        codeUser: _codUser,
                        username: formatName(_user),
                        email: _email,
                        level: _lvl,
                        psw: _psw
                    },
                    async: false
                }).done(function (response) {
                    if (response === "success") {

                        $(err).removeClass('toast hide');
                        $(err).removeClass('alert alert-danger');
                        $(err).addClass('alert alert-success');
                        $(err).html(msg[7]).show();

                        setTimeout(function () {
                            $(err).toggleClass('toast hide');
                            $(err).removeClass('alert alert-success');
                        }, 5000);

                        $(".sb-login .sb-success-registration").show();

                        /* Limpar campos */
                        _codUser = $(".sb-input-reg-codUser input").val("");
                        _user = $(".sb-input-reg-user input").val("");
                        _email = $(".sb-input-reg-email input").val("");
                        _lvl = $(".sb-input-reg-level input").val("");
                        _psw = $(".sb-input-reg-psw input").val("");
                        _psw = $(".sb-input-reg-psw-2 input").val("");

                    }
                    if (response == "error-user-double") {
                        $(err).removeClass('toast hide');
                        $(err).addClass('alert alert-danger');
                        $(err).html(msg[2]).show();
                        return false;
                    }
                    if (response == "error-user-level") {
                        $(err).removeClass('toast hide');
                        $(err).addClass('alert alert-danger');
                        $(err).html(msg[10]).show();
                        return false;
                    }
                });

            } else {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[0]).show();
                $(".sb-input-reg-psw-2 input").focus();
                return false;
            }

        });

        /* Atualizar dados do usuário */
        $("body").on("click", ".sb-submit-settings", function (e) {
            e.preventDefault();

            /* Resgatar valores de entrada */
            var _user = $(".sb-input-reg-user input").val();
            var _email = $(".sb-input-reg-email input").val();
            var _psw = $(".sb-input-reg-psw input").val();
            var _confirmPsw = $(".sb-input-reg-psw-2 input").val();
            var _cpsw = $(".sb-input-reg-psw-3 input").val();
            if ($(".sb-input-reg-codUser").length > 0) {
                var _codUser = $(".sb-input-reg-codUser input").val();
            } else {
                var _codUser = null;
            }

            /*
             * Validar usuário com expressão regular
             * a-zA-Z Somente letras com acentos
             * /i Não leva em consideração maiúsculas e minúsculas (case-insensitive).
             */
            var parse_email = /^[a-z0-9\\._-]+@[a-z0-9]+\.[a-z]+(\.[a-z]+)?$/i;
            var parse_user = /^([a-zA-Z]|\s+)+$/;

            /* Verificar código */
            if ($(".sb-input-reg-codUser").length > 0) {
                if ((_codUser.length == 0 || _codUser.length == null) && (_codUser == "" || _codUser == null)) {
                    $(err).removeClass('toast hide');
                    $(err).addClass('alert alert-danger');
                    $(err).html(msg[9]).show();
                    return false;
                }
            }

            /* Verificar caracteres especiais ou números */
            if (parse_user.test(_user)) {
                $(err).addClass('toast hide');
                $(err).hide();
            } else {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[4]).show();
                _user = "";
                return false;
            }

            /* Validar e-mail */
            if (parse_email.test(_email)) {
                $(err).addClass('toast hide');
                $("").hide();
            } else {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[3]).show();
                _email = "";
                return false;
            }

            /*  Verifique se a senha não está em branco, Verifique se a senha tem mais de quatro caracteres */
            if (_psw.length >= 1 && _psw.length <= 3) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[1]).show();
                return false;
            } else {
                $(err).addClass('toast hide');
                $(err).hide();
            }

            /* Verifique se as senhas correspondem */
            if (_psw != _confirmPsw) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[0]).show();
                return false;
            } else {
                $(err).addClass('toast hide');
                $(err).hide();
            }

            /*  Verifique se a senha não está em branco, Verifique se a senha tem mais de quatro caracteres */
            if ((_cpsw.length == 0 || _cpsw.length == null) && (_cpsw == "" || _cpsw == null)) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[8]).show();
                return false;
            } else if (_cpsw.length <= 3) {
                $(err).removeClass('toast hide');
                $(err).addClass('alert alert-danger');
                $(err).html(msg[1]).show();
                return false;
            } else {
                $(err).addClass('toast hide');
                $(err).hide();
            }

            $(err).addClass('toast hide');

            /* Iniciar pedido de ajax */
            jQuery.ajax({
                method: "POST",
                url: sb_plugin_ajax_url + '/sb_ajax',
                xhrFields: {withCredentials: true},
                data: {
                    action: 'sb_ajax_settings',
                    code: _codUser,
                    username: formatName(_user),
                    psw: _psw,
                    currentPsw: _cpsw,
                    email: _email
                },
                async: false
            }).done(function (response) {
                if (response === "success") {
                    $(err).removeClass('toast hide');
                    $(err).removeClass('alert alert-danger');
                    $(err).addClass('alert alert-success');
                    $(err).html(msg[7]).show();

                    var link = window.location.href;
                    setTimeout(function () {
                        window.location.href = link;
                    }, 5000);

                }
                if (response === "error-user-double") {
                    $(err).removeClass('toast hide');
                    $(err).addClass('alert alert-danger');
                    $(err).html(msg[2]).show();
                    return false;
                }
                if (response === "psw-Invalid") {
                    $(err).removeClass('toast hide');
                    $(err).addClass('alert alert-danger');
                    $(err).html(msg[10]).show();
                    return false;
                }
            });



        });

    });
    // READY 

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function formatName(string) {
        if (string) {
            string = string.replace(/&#8220;/g, "'");
            string = string.replace(/&#39;/g, "'");
            string = string.replace(/&gt"/g, "'");
            return string;
        }
        return "";
    }

    function isEmpty(obj) {
        /* O operador typeof retorna uma string indicando o tipo de um operando. */
        var type = typeof (obj);
        if (type !== "undefined" && obj !== null && (obj.length > 0 || (type == "object" && Object.keys(obj).length > 0) || type === "boolean" || type == 'number') && obj !== "undefined")
            return false;
        else
            return true;
    }

}(jQuery));