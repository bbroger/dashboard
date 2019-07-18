<?php

class registroController extends Template {

    private $users;
    private $settingsUser;

    public function __construct() {
        parent::__construct();
        $this->users = new Users;
        if (!$this->users->verifyLogin()) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
        $this->settingsUser = $this->users->get_settings();
    }

    public function index() {

        $dados = [];

        /* Definir UI - User Interface Design (Design de Interface do Usuário). */
        if ($this->settingsUser['level'] == 1):
            $this->CarregaTemplate('registro-user', $dados);
        else:
            $this->CarregaTemplate('clientDashboard', $dados);
        endif;
    }

}
