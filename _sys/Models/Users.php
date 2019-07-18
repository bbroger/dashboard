<?php

class Users extends Model {

    private $uid;

    public function sb_register_user($userData) {

        /* Listar Usuários cadastrados */
        $users_arr = json_decode(str_replace('\\"', '"', $this->get_option("sb-users-arr")), true);

        /* Verificar se houve retorno */
        if ($users_arr != false) {

            /* O método foreach() executa uma determinada função em cada elemento de uma matriz. */
            foreach ($users_arr as $user):

                /* Verifique se você já tem um usuário registrado com o mesmo nome */
                if ($user["username"] == $userData["username"] && $user["email"] == $userData["email"]):
                    return "error-user-double";
                endif;

            endforeach;
        }else {
            $users_arr = [];
        }

        $userData["last-email"] = "-1";

        /* array_push — Adiciona um ou mais elementos ao final de um array */
        array_push($users_arr, $userData);

        /* Atualizar a matriz */
        $this->update_option("sb-users-arr", json_encode($users_arr));

        /* Devolver valores para requisição */
        return "success";
    }

    public function verifyLogin() {
        if (!empty($_SESSION['hashlogin'])) {

            /* Dados da session */
            $s = $_SESSION['hashlogin'];

            /* Lista todos Usuários cadastrados */
            $users_arr = json_decode(str_replace('\\"', '"', $this->get_option("sb-users-arr")), true);
            $user = null;
            $user_i = -1;

            if ($users_arr != false) {

                /* Percorre o json e verifica se ID do Usuário existe, Caso encontre, salve posição da matriz */
                for ($i = 0; $i < count($users_arr); $i++) {

                    if ($users_arr[$i]["loginhash"] == $s) {
                        $user = $users_arr[$i];
                        $user_i = $i;
                    }
                }
            }

            /* Verifica se algum registro foi encontrado */
            if (isset($user)) {
                $users_arr[$user_i] = $user;
                $this->uid = $users_arr[$user_i]['id'];

                return true;
            }

            return false;
        } else {
            return false;
        }
    }

    public function get_settings() {
        if (!empty($_SESSION['hashlogin'])) {

            /* Dados da session */
            $s = $_SESSION['hashlogin'];

            /* Lista todos Usuários cadastrados */
            $users_arr = json_decode(str_replace('\\"', '"', $this->get_option("sb-users-arr")), true);
            $user = null;
            $user_i = -1;

            if ($users_arr != false) {

                /* Percorre o json e verifica se ID do Usuário existe, Caso encontre, salve posição da matriz */
                for ($i = 0; $i < count($users_arr); $i++) {

                    if ($users_arr[$i]["loginhash"] == $s) {
                        $user = $users_arr[$i];
                        $user_i = $i;
                    }
                }

                return $user;
            }
        }
    }

    public function get_option($option_name) {

        $sql = "SELECT * FROM sb WHERE name =:n";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":n", $option_name);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $value = $sql->fetch()['value'];
            return $value;
        }
        /* Se não houver parametro, devolver requisição como falsa */
        return false;
    }

    function sb_update_user($id, array $userData) {

        /* Lista todos Usuários cadastrados */
        $users_arr = json_decode(str_replace('\\"', '"', $this->get_option("sb-users-arr")), true);
        $user = null;
        $user_i = -1;

        if ($users_arr != false) {
            /* Percorre o json e verifica se ID do Usuário existe, Caso encontre, salve posição da matriz */
            for ($i = 0; $i < count($users_arr); $i++) {
                if ($users_arr[$i]["id"] == $id) {
                    $user = $users_arr[$i];
                    $user_i = $i;
                }
            }
        }

        /* Verifica se algum registro foi encontrado */
        if (isset($user)) {

            /* Atualizar Login Hash */
            if (isset($userData['hash'])):
                $user["loginhash"] = $userData['hash'];
            endif;

            /* Atualizar dados do perfil */
            if (array_key_exists("codeUser", $userData) && array_key_exists("username", $userData) && array_key_exists("psw", $userData) && array_key_exists("newPsw", $userData) && array_key_exists("email", $userData)):

                /* Verificar se a senha atual está correta */
                if (password_verify($userData['psw'], $user["psw"]) == $userData['psw']):
                    $user["codeUser"] = $userData['codeUser'];
                    $user["username"] = $userData['username'];
                    /* Verifica se foi alterado a senha */
                    if (!empty($userData['newPsw'])):
                        $user["psw"] = password_hash($userData['newPsw'], PASSWORD_DEFAULT);
                    endif;
                else:
                    return "psw-Invalid";
                endif;

                /* Certifique-se de que o e-mail não está sendo usado */
                if ($userData["email"] <> $user["email"]):
                    for ($i = 0; $i < count($users_arr); $i++) {
                        if ($users_arr[$i]["email"] == $userData['email']) {
                            die("error-user-double");
                        }
                    }
                    $user["email"] = $userData['email'];
                endif;

            endif;

            $users_arr[$user_i] = $user;

            /* Atualiza dados na matriz */
            $this->update_option("sb-users-arr", json_encode($users_arr));

            return "success";
        }

        return "error";
    }

    public function encryptor($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'jd';
        $secret_iv = 'supportboard_jd';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    /*
     * ***************************************
     * **********  PRIVATE METHODS  **********
     * ***************************************
     */

    private function update_option($option_name, $value) {

        if (isset($option_name) && isset($value)) {

            $value = str_replace("'", "\'", $value);

            $sql = " INSERT INTO sb (name, value) VALUES(:n, :v) ON DUPLICATE KEY UPDATE name= :n, value= :v ";
            $sql = $this->db->prepare($sql);
            $sql->bindValue(":n", $option_name);
            $sql->bindValue(":v", $value);
            $result = $sql->execute();

            return $result;
        }
        return false;
    }

}
