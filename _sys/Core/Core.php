<?php

/**
 * Core [Load]
 * Classe responável pela estrutura MVC
 * 
 * @author André Camargo <andre.camargo@msn.com>
 * @version 1.6
 * @copyright 2017, André Camargo - andre.camargo@msn.com
 * 
 */
class Core {

    function Compilar() {
        $params = [];
        $url = '/';
        $url .= filter_input(INPUT_GET, "url", FILTER_DEFAULT);
        if (!empty($url) && $url != '/'):
            $url = explode('/', $url);
            array_shift($url);
            $currentController = $url[0] . 'Controller';
            array_shift($url);
            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }
            if (count($url) > 0 && $url != ''):
                $params = $url;
            endif;
        else:
            $currentController = 'homeController';
            $currentAction = 'index';
        endif;
        if (!file_exists('_sys' . DIRECTORY_SEPARATOR . 'Controllers' . DIRECTORY_SEPARATOR . $currentController . '.php') || !method_exists($currentController, $currentAction)):
            $currentController = 'errorController';
            $currentAction = 'index';
        endif;
        $controller = new $currentController;
        call_user_func_array(array($controller, $currentAction), $params);
    }

}
