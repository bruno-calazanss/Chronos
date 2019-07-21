<style scoped>
    .table thead tr th {
        vertical-align: middle;
    }
    .table tbody tr td {
        cursor: pointer;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-end">
        <main role="main" class="col-md-9 col-lg-10 px-5 pt-5">
            <div class="table-responsive">
                <table class="collection table table-bordered table-hover">
                    <thead class="font-weight-bold bg-light">
                        <tr>
                            <th id="header_HorasValidadas">Estado atual</th>
                            <th id="header_Data">Data de criação</th>
                            <th id="header_HorasInformadas">Horas informadas</th>
                            <th id="header_HorasValidadas">Horas Validadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($relatorios as $i => $relatorio): ?>
                        <tr>
                            <td><?= ($relatorio->estado == 0) ? "Pendente" : "Avaliado" ?></td>
                            <td><?= $relatorio->data ?></td>
                            <td><?= $soma_horas_informadas[$i] ?></td>
                            <td><?= ($soma_horas_validadas[$i] == '') ? 'Pendente' : $soma_horas_validadas[$i] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>