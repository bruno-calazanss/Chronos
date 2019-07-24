<style scoped>
    
    .table tbody tr td {
        padding: 0;
        cursor: pointer;
    }

    .table tbody tr td a {
        display: block;
        padding: 0.75rem;
        text-decoration: none;
        color: inherit;
    }

    .table tbody tr:hover td a {
        padding-right: 0;
        font-weight: bold;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-end">
        <main role="main" class="col-md-9 col-lg-10 px-5 pt-5">
            <div class="table-responsive">
                <table class="collection table table-bordered table-hover">
                    <thead class="font-weight-bold bg-light">
                        <tr>
                            <?php if($_SESSION['usr_autenticado']['tipo'] !== "AL"): ?>
                            <th id="header_NomeAluno">Aluno</th>
                            <th id="header_HorasValidadas">Matrícula</th>
                            <?php endif; ?>
                            <th id="header_HorasValidadas">Estado atual</th>
                            <th id="header_Data">Data de criação</th>
                            <th id="header_HorasInformadas">Horas informadas</th>
                            <th id="header_HorasValidadas">Horas Validadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($relatorios as $i => $relatorio): ?>
                        <tr>
                            <?php if($_SESSION['usr_autenticado']['tipo'] !== "AL"): ?>
                            <td>
                                <a href="<?= base_url("index.php/controle_relatorio/visualizar/{$relatorio->id}")?>">
                                    <?= $alunos[$i]->nome ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url("index.php/controle_relatorio/visualizar/{$relatorio->id}")?>">
                                    <?= $alunos[$i]->matricula ?>
                                </a>
                            </td>
                            <?php endif; ?>
                            <td>
                                <a href="<?= base_url("index.php/controle_relatorio/visualizar/{$relatorio->id}")?>">
                                    <?= ($relatorio->estado == 0) ? "Pendente" : "Avaliado" ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url("index.php/controle_relatorio/visualizar/{$relatorio->id}")?>">
                                    <?= $relatorio->data ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url("index.php/controle_relatorio/visualizar/{$relatorio->id}")?>">
                                  <?= $soma_horas_informadas[$i] ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= base_url("index.php/controle_relatorio/visualizar/{$relatorio->id}")?>">
                                   <?= ($soma_horas_validadas[$i] == '') ? 'Pendente' : $soma_horas_validadas[$i] ?>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>