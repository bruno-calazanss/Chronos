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
            <form action="<?= base_url("index.php/controle_relatorio/enviar_avaliacao/{$id}") ?>" method="POST">
                <div class="table-responsive">
                    <table class="collection table table-bordered table-hover">
                        <thead class="font-weight-bold bg-light">
                            <tr>
                                <th>Nome da atividade</th>
                                <th>Categoria</th>
                                <th>Data</th>
                                <th>Qtd. de horas</th>
                                <th>Comprovante</th>
                                <th>Avaliação</th>
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
                                    <?= date('d/m/Y', strtotime($atv->data)) ?>
                                </td>
                                <td>
                                    <?= $atv->qtd_horas ?>
                                </td>
                                <td class="comprovante">
                                    <?php if($atv->comprovante == ''): ?>
                                    <span class="px-3">
                                        Não enviado
                                    </span>
                                    <?php else: ?>
                                    <a href="<?= "http://localhost" . str_replace($_SERVER['DOCUMENT_ROOT'], "", $atv->comprovante); ?>" class="px-3" download>
                                        Baixar
                                    </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <input class="form-control" type="number" min="0" name="horas_validadas[]" required>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="6" onclick="$('#enviar').trigger('click')" class="d-table-cell border-0 btn btn-info">
                                    <i class="fas fa-check-double"></i>
                                    Avaliar relatório
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button id="enviar" type="submit" class="invisible">
            </form>
        </main>
        <div class="progress fixed-bottom" style="visibility: hidden;">
            <div class="progress-bar progress-bar-success" style="width: 0%;"></div>
        </div>
    </div>
</div>