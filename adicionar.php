<!DOCTYPE html>
<html lang="pt">

<head>
    <?php require_once("include/head.inc.php"); ?>
    <link rel="stylesheet" href="blueimp-file-upload/css/jquery.fileupload.css">
    <style>
        .table thead tr th {
            vertical-align: middle;
        }

        .table {
            border-collapse: separate;
            border-spacing: 2px;
        }

        td {
            text-align: center;
        }

        .fileinput-button {
            border: 1px solid #dee2e6;
        }

        .btn {
            border-radius: 0;
        }
    </style>
</head>

<body>
    <?php require_once("include/navbar.inc.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require_once("include/sidebar.inc.php"); ?>
            <main role="main" class="col-10 mt-4 px-5 p-5">
                <table class="collection table table-bordered table-hover">
                    <thead class="font-weight-bold bg-light">
                        <tr>
                            <th>Nome da atividade</th>
                            <th>Data</th>
                            <th>Qtd. de horas</th>
                            <th>Comprovante</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=1; $i<=5; $i++): ?>
                        <tr id="<?= "item$i" ?>">
                            <td>
                                <input class="form-control" type="text" size="50" name="<?= "n$i" ?>">
                            </td>
                            <td>
                                <input class="form-control" type="date" name="<?= "d$i" ?>">
                            </td>
                            <td>
                                <input class="form-control" type="number" min="1" name="<?= "h$i" ?>">
                            </td>
                            <td>
                                <span class="btn btn-light fileinput-button px-3">
                                    <i class="fas fa-arrow-up"></i>
                                    <input type="file" min="1" name="<?= "c$i" ?>">
                                </span>
                            </td>
                        </tr>
                        <?php endfor; ?>
                        <tr>
                            <td colspan="2" class="d-table-cell border-0 btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Adicionar item
                            </td>
                            <td colspan="2" class="d-table-cell border-0 btn btn-success">
                                <i class="fas fa-save"></i>
                                Enviar relatório
                            </td>
                        </tr>
                    </tbody>
                </table>
            </main>
            <div class="progress fixed-bottom" style="visibility: hidden;">
                <div class="progress-bar progress-bar-success" style="width: 0%;"></div>
            </div>
        </div>
    </div>
    <?php require_once("include/scripts.inc.php"); ?>
    <script src="blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="blueimp-file-upload/js/jquery.iframe-transport.js"></script>
    <script src="blueimp-file-upload/js/jquery.fileupload.js"></script>
    <script>
        $(document).ready(function () {
            $("input[type=file]").fileupload({
                progressall: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('.progress').css("visibility", "visible");
                    $('.progress-bar').css(
                        'width',
                        progress + '%'
                    );
                },
                stop: function (e, data) {
                    window.setTimeout(() => {
                        $('.progress').css("visibility", "hidden");
                        $('.progress-bar').css("width", "0%");
                    }, 2000);
                }
            });
            $(".btn-primary").on("click", function () {
                qtdItens = $("tr").length - 2;
                item = $('#item' + qtdItens).clone().insertAfter('#item' + qtdItens);
                $(item).attr("id", 'item' + (++qtdItens));
                $(item).find("input").eq(0).attr("name", 'n' + qtdItens);
                $(item).find("input").eq(1).attr("name", 'd' + qtdItens);
                $(item).find("input").eq(2).attr("name", 'h' + qtdItens);
            });
        });
    </script>
</body>

</html>