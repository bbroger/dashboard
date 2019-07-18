<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.html">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Checkout</li>
        </ol>        

        <div class="row">

            <div class="col-md-4 order-md-2 mb-4">

                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Seu carrinho</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>

                <ul class="list-group mb-3">

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Produdo nome</h6>
                            <small class="text-muted">Descrição breve</small>
                        </div>
                        <span class="text-muted">R$ 12</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Segundo produto</h6>
                            <small class="text-muted">Descrição breve</small>
                        </div>
                        <span class="text-muted">R$ 8</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Terceiro produto</h6>
                            <small class="text-muted">Descrição breve</small>
                        </div>
                        <span class="text-muted">R$ 5</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Código promocional</h6>
                            <small>#2335S2GHG</small>
                        </div>
                        <span class="text-success">-R$ 5</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BRL)</span>
                        <strong>R$ 20</strong>
                    </li>

                </ul>

                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Código promocional">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Resgatar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Endereço de entrega</h4>
                <form class="needs-validation">

                    <div class="form-group">

                        <div class="form-row">

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group sb-input-firstName">
                                    <input type="text" id="firstName" class="form-control" placeholder="Primeiro nome" />
                                    <label for="firstName">Primeiro nome</label>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group sb-input-firstName">
                                    <input type="text" id="lastName" class="form-control" placeholder="Último nome" />
                                    <label for="lastName">Último nome</label>
                                </div>
                            </div>

                        </div>

                    </div>                   

                    <div class="form-group">

                        <div class="form-row">

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group sb-input-firstName">
                                    <input type="text" id="cep" class="form-control" placeholder="16072515" />
                                    <label for="cep">Cep</label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-row">

                            <div class="col-md-6 mb-3">
                                <div class="form-label-group sb-input-firstName">
                                    <input type="text" id="address" class="form-control" placeholder="1234 Main St" />
                                    <label for="address">Endereço</label>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-label-group sb-input-firstName">
                                    <input type="text" id="complement" class="form-control" placeholder="Apartamento ou suite" />
                                    <label for="complement">Complemento</label>
                                </div>
                            </div>

                            <div class="col-md-3 mb-3">
                                <div class="form-label-group sb-input-firstName">
                                    <input type="text" id="number" class="form-control" placeholder="Número" />
                                    <label for="number">Número</label>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <div class="form-row">

                            <div class="col-md-6 mb-3">
                                <label for="state">Estado</label>
                                <select class="custom-select d-block w-100" id="state" required>
                                    <option value="">Escolher...</option>
                                    <option>São Paulo</option>
                                </select>                                
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="country">Cidade</label>
                                <select class="custom-select d-block w-100" id="country" required>
                                    <option value="">Escolher...</option>
                                    <option>Araçatuba</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <hr class="mb-4">

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">O endereço de envio é o mesmo que o meu endereço de faturamento</label>
                    </div>

                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Guarde esta informação para a próxima vez</label>
                    </div>

                    <hr class="mb-4">

                    <h4 class="mb-3">Forma de pagamento</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Cartão de crédito</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="debit">Cartão de débito</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">PayPal</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">Boleto bancário</label>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Nome no cartão</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Full name as displayed on card</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Número do Cartão de Crédito</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiração</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                        </div>

                    </div>

                    <hr class="mb-4">

                    <button class="btn btn-primary btn-lg btn-block" type="submit">Efetuar pagamento</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->