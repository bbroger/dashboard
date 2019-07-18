<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Configurações</li>
    </ol>

    <!-- Page Content -->
    <h1>Atualizar dados do perfil</h1>

    <hr>

    <form autocomplete="off">

        <div class="form-group">

            <div class="form-row">

                <?php if ($settingsUser['level'] == 1): ?>
                    <div class="col-md-6">
                        <div class="form-label-group sb-input-reg-codUser">
                            <input type="text" id="code" class="form-control" placeholder="Código do cliente" required="required" autofocus="autofocus"  value="<?= $settingsUser['codeUser']; ?>" />
                            <label for="firstName">Código do cliente</label>
                        </div>
                    </div> 
                <?php endif; ?>

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-user">
                        <input type="text" id="firstName" class="form-control" placeholder="Nome" required="required" autofocus="autofocus"  value="<?= $settingsUser['username']; ?>" />
                        <label for="firstName">Nome</label>
                    </div>
                </div> 

            </div>

        </div>

        <div class="form-group">

            <div class="form-label-group sb-input-reg-email">
                <input type="text" id="inputEmail" class="form-control" placeholder="E-mail" required="required" value="<?= $settingsUser['email']; ?>" />
                <label for="inputEmail">E-mail</label>
            </div>

        </div>

        <div class="form-group">

            <div class="form-row">

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-psw">
                        <input type="password" id="inputPassword" class="form-control" placeholder="Senha" />
                        <label for="inputPassword">Nova senha</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-psw-2">
                        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirmar a senha" />
                        <label for="confirmPassword">Confirmar senha</label>
                    </div>
                </div>

            </div>

        </div>

        <div class="form-group">

            <div class="form-row">

                <div class="col-md-12">
                    <div class="form-label-group sb-input-reg-psw-3">
                        <input type="password" id="currentPassword" class="form-control" placeholder="Senha" required="required" />
                        <label for="currentPassword">Senha atual</label>
                    </div>
                </div>

            </div>

        </div>

        <div class="sb-error-msg sb-error-msg-reg toast hide" 
             data-messages="
             Senhas não coincidem.|
             O tamanho mínimo da senha é de 4 caracteres.|
             E-mail já registado.|
             E-mail não é válido.|
             O nome de usuário não deve conter caracteres especiais ou números.|
             Informe a senha|
             Informe o E-mail|
             Usuário atualizado|
             Informe a senha atual|
             Informe o código|
             Senha atual inválida.
             ">                 
        </div>

        <button class="btn btn-primary btn-block sb-submit-settings">Atualizar</button>

    </form>

    <hr>

</div>

</div>
<!-- /.container-fluid -->