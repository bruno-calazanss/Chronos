<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("include/head.inc.php"); ?>
</head>

<body>
    <?php require_once("include/navbar.inc.php"); ?>
    <?php require_once("include/sidebar.inc.php"); ?>

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
                        <form>
                            <div class="form-row">
                                <div class="form-group px-2 col-md-6">
                                    <label for="matricula">Matrícula:</label>
                                    <input type="text" class="form-control" id="matricula">
                                </div>
                                <div class="form-group px-2 col-md-6">
                                    <label for="tipo">Tipo:</label>
                                    <select id="tipo" class="form-control">
                                        <option disabled selected hidden></option>
                                        <option>Aluno</option>
                                        <option>Coordenador</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group px-2 col-md-6">
                                    <label for="email">E-mail:</label>
                                    <input type="email" class="form-control" id="email" placeholder="exemplo@email.com">
                                </div>
                                <div class="form-group px-2 col-md-6">
                                    <label for="conf_email">Confirmação de e-mail:</label>
                                    <input type="email" class="form-control" id="conf_email" placeholder="exemplo@email.com">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group px-2 col-md-6">
                                    <label for="senha">Senha:</label>
                                    <input type="password" class="form-control" id="senha">
                                </div>
                                <div class="form-group px-2 col-md-6">
                                    <label for="conf_senha">Confirmação de senha:</label>
                                    <input type="password" class="form-control" id="conf_senha">
                                </div>
                            </div>
                            <button type="submit" class="d-block mx-auto btn btn-primary">Cadastrar</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php require_once("include/scripts.inc.php"); ?>
</body>

</html>