<style scoped>
    .table thead tr th, .table tbody tr td {
        vertical-align: middle;
    }

    .table {
        /* border-collapse: separate; */
        border-spacing: 2px;
    }

    .table tbody tr .comprovante {
        text-align: center;
    }

    .fileinput-button {
        border: 1px solid #dee2e6;
    }

    .btn {
        border-radius: 0;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-end">
        <main role="main" class="col-md-9 col-lg-10 px-5 pt-5">
            <div class="table-responsive">
                <table class="collection table table-bordered table-hover">
                    <thead class="font-weight-bold bg-light">
                        <tr>
                            <th>Nome da atividade</th>
                            <th>Categoria</th>
                            <th>Data</th>
                            <th>Qtd. de horas</th>
                            <th>Horas validadas</th>
                            <th>Comprovante</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($atividades as $atv): ?>
                        <tr>
                            <td>
                            <?= $atv->nome ?>
                            </td>
                            <td>
                                <?= $strings_categoria[$atv->categoria] ?>
                            </td>
                            <td>
                                <?= $atv->data ?>
                            </td>
                            <td>
                                <?= $atv->qtd_horas ?>
                            </td>
                            <td>
                                <?= ($atv->horas_validadas != '') ? $atv->horas_validadas : "Pendente"; ?>
                            </td>
                            <td class="comprovante">
                                <span class="btn btn-light fileinput-button px-3">
                                    <i class="fas fa-arrow-up"></i>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
        <div class="progress fixed-bottom" style="visibility: hidden;">
            <div class="progress-bar progress-bar-success" style="width: 0%;"></div>
        </div>
    </div>
</div>