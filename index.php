<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("include/head.inc.php"); ?>
    <style>
        
        html, body
        {
            width: 100%;
            height: 100%;
        }

        .container
        {
            min-height: 100vh;
        }

        .img-fluid
        {
            max-width: 40vmin;
        }
        
        .input-group-text
        {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

    </style>
</head>
<body>
    <div class="d-flex container justify-content-center">
        <div class="row align-self-center">
            <div class="col">
                <div class="card bg-light mb-3" style>
                    <div class="card-header text-center mb-3">Área de acesso</div>
                    <div class="card-body pt-0">
                        <!-- <img class="img-fluid w-75 d-block mx-auto my-3" src="img/pyramid-310785_960_720.png" alt="Gizah"> -->
                        <form action="inicial.php" class="mx-auto">
                            <div class="input-group form-group">
                                <span class="input-group-text input-group-prepend">
                                    <i class="fas fa-user" aria-hidden="true"></i>
                                </span>
                                <input class="form-control" placeholder="Usuário">
                            </div>
                            <div class="input-group form-group mb-2">
                                <span class="input-group-text input-group-prepend">
                                    <i class="fas fa-lock" aria-hidden="true"></i>
                                </span>
                                <input class="form-control" placeholder="Senha" type="password">
                            </div>
                            <div class="m-0 ml-1 mb-3">
                                <a href="">
                                    <u>Esqueceu sua senha?</u>
                                </a>
                            </div>
                            <input type="submit" value="Entrar" class="w-100">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("include/scripts.inc.php"); ?>
</body>
</html>