<?php

class checkoutController extends Template {

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

        $this->CarregaTemplate('checkout', $dados);
    }

}
