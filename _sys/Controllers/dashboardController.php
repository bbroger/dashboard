<?php

class dashboardController {

    public function index() {

        $dados = [];



        Template::CarregaTemplate('dashboard', $dados);
    }

}
