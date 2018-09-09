<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("include/head.inc.php"); ?>
    <style>
        .table thead tr th, .table tbody tr td {
            vertical-align: middle;
        }
        .table tbody tr td {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php require_once("include/navbar.inc.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once("include/sidebar.inc.php"); ?>
            <main role="main" class="col-10 mt-4 px-5">
                <table class="collection table table-bordered table-hover">
                    <thead class="font-weight-bold bg-light">
                        <tr>
                            <th id="header_HorasValidadas">Aluno</th>
                            <th id="header_HorasValidadas">Matrícula</th>
                            <th id="header_HorasValidadas">Estado atual</th>
                            <th id="header_Data">Data de criação</th>
                            <th id="header_HorasInformadas">Horas informadas</th>
                            <th id="header_HorasValidadas">Horas Validadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bruno Leite Calazans Costa</td>
                            <td>0000000000000</td>
                            <td>Aprovado</td>
                            <td>00/00/0000</td>
                            <td>10</td>
                            <td>5</td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    <?php require_once("include/scripts.inc.php"); ?>
</body>

</html>