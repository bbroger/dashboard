<?php

class loginController extends Template {

    private $users;

    public function __construct() {
        parent::__construct();
        $this->users = new Users;
        if ($this->users->verifyLogin()) {
            header("Location: " . BASE_URL . "home");
            exit;
        }
    }

    public function index() {        
        
        $dados = [];
        
        $this->CarregaTemplateSolo("login");
    }

}
