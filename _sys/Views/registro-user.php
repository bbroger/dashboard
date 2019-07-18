<div class="container-fluid">

    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Registro</li>
    </ol>

    <!-- Page Content -->
    <h1>Cadastro para acesso painel</h1>

    <hr>

    <form autocomplete="off">

        <div class="form-group">

            <div class="form-row">

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-codUser">
                        <input type="text" id="code" class="form-control" placeholder="Código do cliente" required="required" autofocus="autofocus" />
                        <label for="code">Código do cliente</label>
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-user">
                        <input type="text" id="firstName" class="form-control" placeholder="Nome" required="required" autofocus="autofocus" />
                        <label for="firstName">Nome</label>
                    </div>
                </div> 

            </div>

        </div>


        <div class="form-group">

            <div class="form-row">

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-email">
                        <input type="text" id="inputEmail" class="form-control" placeholder="E-mail" required="required" />
                        <label for="inputEmail">E-mail</label>
                    </div>
                </div> 

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-level">
                        <input type="text" id="level" class="form-control" placeholder="CLIENTE / ADM" required="required" autofocus="autofocus" />
                        <label for="level">CLIENTE ou ADMINISTRADOR</label>
                    </div>
                </div> 

            </div>

        </div>

        <div class="form-group">

            <div class="form-row">

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-psw">
                        <input type="password" id="inputPassword" class="form-control" placeholder="Senha" required="required" />
                        <label for="inputPassword">Senha</label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-label-group sb-input-reg-psw-2">
                        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirmar a senha" required="required" />
                        <label for="confirmPassword">Confirmar senha</label>
                    </div>
                </div>

            </div>

        </div>

        <div class="sb-error-msg sb-error-msg-reg toast hide" 
             data-messages="
             Senhas não coincidem.|
             O tamanho mínimo da senha é de 4 caracteres.|
             Utilizador já registado.|
             E-mail não é válido.|
             O nome de usuário não deve conter caracteres especiais ou números.|
             Informe a senha|
             Informe o E-mail|
             Usuário cadastrado|
             Informe o nível de acesso|
             Informe o código do cliente|
             Digite a palavra CLIENTE ou ADMINISTRADOR para definir o nível de acesso."></div>

        <button class="btn btn-primary btn-block sb-submit-register">Registrar</button>

    </form>
    
    <hr>

</div>
<!-- /.container-fluid -->