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
                    Formulário de cadastro
                </div>
                <div class="card-body">
                    <form action="<?= base_url('index.php/controle_usuario/cadastrar')?>" method="POST">
                        <div class="form-row">
                            <div class="form-group px-2 col-md-6">
                                <label for="matricula">Matrícula:</label>
                                <input type="text" class="form-control" id="matricula" name="matricula" pattern="[0-9]{1,13}" required>
                                <small class="form-text text-muted ml-1">Ex: 0000000000000</small>
                            </div>
                            <div class="form-group px-2 col-md-6">
                                <label for="tipo">Tipo:</label>
                                <select id="tipo" name="tipo" class="form-control" required>
                                    <option disabled selected hidden></option>
                                    <option value="AL">Aluno</option>
                                    <option value="C">Coordenador</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group px-2 col-md-6">
                                <label for="nome">Nome completo:</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            <div class="form-group px-2 col-md-6">
                                <label for="nome_usr">Login do usuário:</label>
                                <input type="text" class="form-control" id="nome_usr" name="nome_usr" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group px-2 col-md-6">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <small class="form-text text-muted ml-1">Ex: exemplo@email.com</small>
                            </div>
                            <div class="form-group px-2 col-md-6">
                                <label for="conf_email">Confirmação de e-mail:</label>
                                <input type="email" class="form-control" id="conf_email" name="conf_email" required>
                                <small class="form-text text-muted ml-1">Ex: exemplo@email.com</small>
                            </div>
                        </div>
                        <button type="submit" class="d-block mx-auto btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>