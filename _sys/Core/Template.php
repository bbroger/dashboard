<?php

/**
 * Template [Load]
 * Classe responável por carregar tema a ser utilizado
 * 
 * @author André Camargo <andre.camargo@msn.com>
 * @version 1.6
 * @copyright 2017, André Camargo - andre.camargo@msn.com
 * 
 */
class Template {

    private $ViewName;
    private $ViewData;

    public function __construct() {
        global $config;
    }

    public function CarregaTemplate($ViewName, array $ViewData) {
        $this->ViewName = (string) $ViewName;
        $this->ViewData = $ViewData;
        include_once ('_tpl' . DIRECTORY_SEPARATOR . 'template.php');
    }

    public function CarregaView() {
        extract($this->ViewData);
        include_once ('_sys' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $this->ViewName . '.php');
    }

    public function CarregaTemplateSolo($view) {
        include_once ('_sys' . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR . $view . '.html');
    }

}
