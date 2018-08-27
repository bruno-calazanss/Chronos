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
    </style>
</head>

<body>
    <?php require_once("include/navbar.inc.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once("include/sidebar.inc.php"); ?>
            <main role="main" class="col-10 ml-auto px-5">
                <div id="user">
                    <form class="mt-5">
                        <figure class="float-left mr-5 mb-5 mt-0">
                            <i class="fas fa-user-circle d-inline-block"></i>
                            <figcaption class="text-center h6">bruno.costa</figcaption>
                        </figure>
                        <div class="form-group mr-4">
                            <label class="h5">Aluno(a):</label>
                            <span class="form-control">Bruno Leite Calazans Costa</span>
                        </div>
                        <div class="form-group mr-4">
                            <label class="h5">E-mail:</label>
                            <span class="form-control">bruno.calazanss@gmail.com</span>
                        </div>
                        <div class="form-group mr-4">
                            <label class="h5">Mátricula:</label>
                            <span class="form-control">1610470400006</span>
                        </div>
                        <div class="form-group mr-4">
                            <label class="h5">Telefone:</label>
                            <span class="form-control">(21) 98729-4264</span>
                        </div>
                        <div class="form-group mr-4">
                            <label class="h5">Horas computadas:</label>
                            <span class="form-control">50</span>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <?php require_once("include/scripts.inc.php"); ?>
</body>

</html>