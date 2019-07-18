<?php

class ajaxController extends Template {

    public function sb_ajax() {

        /* Vefificar se existe o parametro ação */
        if (array_key_exists("action", $_POST)):

            /* Limpar xss */
            $clearParam = $this->strip_tags_deep($_POST);
            $clearParam = $this->htmlSpecial_char($clearParam);
            $clearParam = $this->remove_space($clearParam);

            /* Armazenar o parametro ação */
            $sb_action = filter_var($clearParam["action"], FILTER_DEFAULT);

            /* Remove o parametro ação */
            $_POST['action'] = NULL;

            /* Verificar se o parametro ação começa com as iniciais sb_ */
            if (strpos($sb_action, "sb_") === 0):

                /* Verifica se a função existe e executa */

                $this->$sb_action();

            endif;

        endif;
    }

    // Executar login no sistema
    function sb_ajax_login() {

        /* Limpar xss */
        $clearParam = $this->strip_tags_deep($_POST);
        $clearParam = $this->htmlSpecial_char($clearParam);
        $clearParam = $this->remove_space($clearParam);

        /* Resgatar usuários cadastrados */
        $user = new Users;
        $option = $user->get_option('sb-users-arr');
        $users_arr = json_decode(str_replace('\\"', '"', $option), true);

        /* Verificar se houve retorno */
        if ($users_arr != false) {

            /* Vefificar se existe o parametro user */
            if (array_key_exists("user", $clearParam) && array_key_exists("password", $clearParam)):

                /* Armazenar o parametro user and password */
                $sb_user = filter_input(INPUT_POST, "user", FILTER_DEFAULT);
                $sb_user = $this->wordFormat_str($sb_user, 'strtolower');
                $sb_password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);

                /* Remove o parametro user and password */
                unset($_POST);

            endif;

            /* O método foreach() executa uma determinada função em cada elemento de uma matriz. */
            foreach ($users_arr as $users):

                /* Verifica na matriz se tem o valor solicitado Username ou Email */
                if ($users["username"] == $sb_user || $users["email"] == $sb_user):

                    /* password_verify() Verifique se uma senha corresponde a um hash */
                    if (password_verify($sb_password, $users["psw"]) == $sb_password):

                        /* Crie sessões do sistema criptografada sb-login e sb-user-infos */
                        $_SESSION['sb-login'] = $user->encryptor("encrypt", "sb-logged-in-" . rand());

                    else:

                        /* Retorno: Usuário e/ou senha inválidos. */
                        die("error");

                    endif;

                endif;

            endforeach;

            if (!empty($_SESSION['sb-login'])):

                unset($_SESSION['chathashlogin']);

                $loginhash = md5(rand(0, 9999) . time() . $users['id']);
                $userData = ["hash" => $loginhash];
                $_SESSION['hashlogin'] = $loginhash;

                $user->sb_update_user($users['id'], $userData);

                /* Retorno: Redirecionar ao Painel */
                die("success");
            endif;
        }

        /* Se não houver registro */
        die("error");
    }

    /* Limpar - Encerrar sessão do usuário */

    function sb_ajax_logout() {
        session_unset();
        die("success");
    }

    function sb_ajax_register() {

        /* Limpar xss */
        $clearParam = $this->strip_tags_deep($_POST);
        $clearParam = $this->htmlSpecial_char($clearParam);
        $clearParam = $this->remove_space($clearParam);

        /* Vefificar se existe o parametro id, img, username, psw, email */
        if (
                array_key_exists("id", $clearParam) &&
                array_key_exists("codeUser", $clearParam) &&
                array_key_exists("username", $clearParam) &&
                array_key_exists("email", $clearParam) &&
                array_key_exists("level", $clearParam) &&
                array_key_exists("psw", $clearParam)
        ):

            /* Armazenar os parametros */
            $sb_id = filter_var($clearParam["id"], FILTER_DEFAULT);
            $sb_code = filter_var($clearParam["codeUser"], FILTER_DEFAULT);

            $sb_user = filter_var($clearParam["username"], FILTER_DEFAULT);
            $sb_user = $this->wordFormat_str($sb_user, 'strtolower');

            $sb_email = filter_var($clearParam["email"], FILTER_VALIDATE_EMAIL);
            $sb_email = $this->wordFormat_str($sb_email, 'strtolower');

            $sb_level = filter_var($clearParam['level'], FILTER_DEFAULT);
            $sb_level = $this->wordFormat_str($sb_level, 'strtoupper');

            $sb_psw = filter_var($clearParam["psw"], FILTER_DEFAULT);

            if ($sb_level == "CLIENTE" || $sb_level == "ADMINISTRADOR"):

                $sb_level = ($sb_level == "CLIENTE" ? $sb_level = 0 : ($sb_level == "ADMINISTRADOR" ? $sb_level = 1 : $sb_level = null));

                /* Criar uma matriz com dados informados pelo usuário */
                $userData = ["id" => $sb_id, "codeUser" => $sb_code, "username" => $sb_user, "email" => $sb_email, "level" => $sb_level, "psw" => password_hash($sb_psw, PASSWORD_DEFAULT), "loginhash" => ""];

                $user = new Users;
                $result = $user->sb_register_user($userData);
                die($result);

            else:
                die("error-user-level");
            endif;

        endif;
    }

    function sb_ajax_settings() {

        /* Limpar xss */
        $clearParam = $this->strip_tags_deep($_POST);
        $clearParam = $this->htmlSpecial_char($clearParam);
        $clearParam = $this->remove_space($clearParam);

        /* Vefificar se existe o parametro id, img, username, psw, email */
        if (
                array_key_exists("code", $clearParam) &&
                array_key_exists("username", $clearParam) &&
                array_key_exists("psw", $clearParam) &&
                array_key_exists("email", $clearParam) &&
                array_key_exists("currentPsw", $clearParam)
        ):

            /* Armazenar os parametros */
            $sb_code = filter_var($clearParam["code"], FILTER_DEFAULT);

            $sb_user = filter_var($clearParam["username"], FILTER_DEFAULT);
            $sb_user = $this->wordFormat_str($sb_user, 'strtolower');

            $sb_psw = filter_var($clearParam["psw"], FILTER_DEFAULT);

            $sb_email = filter_var($clearParam["email"], FILTER_VALIDATE_EMAIL);
            $sb_email = $this->wordFormat_str($sb_email, 'strtolower');

            $sb_currentPsw = filter_var($clearParam['currentPsw'], FILTER_DEFAULT);

            unset($_POST);

            /* Pegar codigo automatico CLIENTE */
            $settings = new Users;
            $resultado = $settings->get_settings();

            $sb_code = ( ($sb_code == null || $sb_code == "") ? $resultado['codeUser'] : $sb_code );

            /* Criar uma matriz com dados informados pelo usuário */
            $userData = ["codeUser" => $sb_code, "username" => $sb_user, "psw" => $sb_currentPsw, "newPsw" => $sb_psw, "email" => $sb_email];

            //"psw" => password_hash($sb_psw, PASSWORD_DEFAULT)

            /* Remove o parametro user and password */
            unset($_POST);

            $user = new Users;
            $result = $user->sb_update_user($resultado['id'], $userData);

            die($result);

        endif;

        die("error");
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    /*
     * Evitar XSS
     * strip_tags() remove tags, mas não caracteres especiais como , " ou '.
     * se você usar, strip_tags() também precisará usar htmlspecialchars().
     * 
     * Cross-site scripting (XSS) é um tipo de vulnerabilidade do sistema de segurança de um computador, 
     * encontrado normalmente em aplicações web que ativam ataques maliciosos ao injetarem client-side 
     * script dentro das páginas web vistas por outros usuários.
     */

    private function strip_tags_deep($value) {
        return is_array($value) ? array_map('strip_tags', $value) : strip_tags($value);
    }

    private function htmlSpecial_char($value) {
        return is_array($value) ? array_map('htmlspecialchars', $value) : htmlSpecial_char($value);
    }

    private function remove_space($value) {
        return is_array($value) ? array_map('trim', $value) : trim($value);
    }

    /*
     * Função usada para manipular strings
     * 
     * strtolower - Converte uma string para minúsculas
     * strtoupper - Converte uma string para maiúsculas
     * ucfirst - Converte para maiúscula o primeiro caractere de uma string
     * ucwords - Converte para maiúsculas o primeiro caractere de cada palavra
     * mb_strtolower - Torna uma string minúscula
     * 
     * @value string
     * @param string
     */

    private function wordFormat_str($value, $param) {
        return is_array($value) ? array_map($param, $value) : $param($value);
    }

}
