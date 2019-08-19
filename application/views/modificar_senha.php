<style scoped>

    #user form figure *:first-child {
        width: 100%;
        height: auto;
        max-width: 13rem;
    }

    .form-group px-2 {
        display: inline-block;
    }

</style>

<div class="container-fluid">
    <div class="row justify-content-end">
        <main role="main" class="col-md-9 col-lg-10 px-5 pt-5">
            <div id="user" class="card">
                <div class="card-header">
                    Mudança de senha
                </div>
                <div class="card-body">
                    <form action="<?= base_url('index.php/controle_senha/nova_senha')?>" method="POST">
                        <div class="form-row">
                            <div class="form-group px-2 col-md-4">
                                <label for="senha_atual">Senha atual:</label>
                                <input type="password" class="form-control" id="senha_atual" name="senha_atual" required>
                            </div>
                            <div class="form-group px-2 col-md-4">
                                <label for="nova_senha">Nova senha:</label>
                                <input type="password" class="form-control" id="nova_senha" name="nova_senha" pattern=".{8,}" required>
                                <small class="form-text text-muted ml-1">A senha deve conter no mínimo 8 caracteres</small>
                            </div>
                            <div class="form-group px-2 col-md-4">
                                <label for="conf_nova_senha">Confirmar nova senha:</label>
                                <input type="password" class="form-control" id="conf_nova_senha" name="conf_nova_senha" pattern=".{8,}" required>
                                <small class="form-text text-muted ml-1">A senha deve conter no mínimo 8 caracteres</small>
                            </div>
                        </div>
                        <button type="submit" class="d-block mx-auto btn btn-primary">Cadastrar nova senha</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>