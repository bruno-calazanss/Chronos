<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("include/head.inc.php"); ?>
    <style>
        #user form figure *:first-child {
            width: 10rem;
            height: auto;
        }

        #user form span {
            background-color: #e9ecef;
        }

        .form-group {
            display: inline-block;
        }

        #user {
            min-width: 15rem;
            min-height: 19rem;
        }
    </style>
</head>

<body>
    <?php require_once("include/navbar.inc.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once("include/sidebar.inc.php"); ?>
            <main role="main" class="col-10 ml-auto pl-5 mr-3">
                <div id="user" class="card mt-5">
                    <form class="card-body bg-light rounded p-3 mt-0" style="border-width: 4px !important;">
                        <figure class="d-inline-block float-left m-4 mr-5">
                            <i class="fas fa-user-circle d-inline-block"></i>
                            <figcaption class="text-center h6">exemplo.usr</figcaption>
                        </figure>
                        <div class="form-group mr-4">
                            <label class="h5">Aluno(a):</label>
                            <input class="form-control" type="text" value="Exemplo de nome" size="50" disabled>
                        </div>
                        <div class="form-group mr-4">
                            <label class="h5">E-mail:</label>
                            <input class="form-control" type="text" value="meu.email@abc.com" size="25" disabled>
                        </div>
                        <div class="form-group mr-4">
                            <label class="h5">Mátricula:</label>
                            <input class="form-control" type="text" value="0000000000000" size="13" disabled>
                        </div>
                        <div class="form-group mr-4">
                            <label class="h5">Telefone:</label>
                            <input class="form-control" type="text" value="(00) 00000-0000" size="15" disabled>
                        </div>
                        <div class="form-group mr-4">
                            <label class="h5">Horas computadas:</label>
                            <input class="form-control" type="text" value="50" size="4" disabled>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <?php require_once("include/scripts.inc.php"); ?>
</body>

</html>