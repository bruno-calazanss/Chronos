<style scoped>

    <?php if($usr_autenticado['tipo'] == "C"): ?>
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
    <?php endif; ?>

    .text-dark:hover {
        text-decoration: none;
    }

    .paginacao a, .paginacao strong {
        padding: 0 0.2rem 0 0;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-end">
        <main role="main" class="col-md-9 col-lg-10 px-5 pt-5">
            <div class="table-responsive">
                <table class="collection table table-bordered table-hover">
                    <thead class="font-weight-bold bg-light">
                        <tr>
                            <th id="header_NomeUsr">Usuário</th>
                            <th id="header_HorasValidadas">Matrícula</th>
                            <th id="header_SomatorioHoras">Somatório de horas</th>
                            <?php if($usr_autenticado['tipo'] == "ADM"): ?>
                            <th id="header_TipoUsr">Tipo de usuário</th>
                            <?php endif; ?>
                            <th id="header_Estado">Estado</th>
                            <?php if($usr_autenticado['tipo'] == "ADM"): ?>
                            <th id="header_Ops">Opções</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=0, $max=0; $i<count($usuarios) && $max<8; $i++, $max++): ?>
                        <tr>
                            <td>
                                <?php if($usr_autenticado['tipo'] == "C"): ?>
                                <a href="<?= base_url("index.php/controle_usuario/dados_usr/{$usuarios[$i]->id}")?>">
                                <?php endif; ?>
                                <?= $usuarios[$i]->nome ?>
                                <?php if($usr_autenticado['tipo'] == "C"): ?>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($usr_autenticado['tipo'] == "C"): ?>
                                <a href="<?= base_url("index.php/controle_usuario/dados_usr/{$usuarios[$i]->id}")?>">
                                <?php endif; ?>
                                <?= $usuarios[$i]->matricula ?>
                                <?php if($usr_autenticado['tipo'] == "C"): ?>
                                </a>
                                <?php endif; ?>
                            </td>
                            <td <?= ($total_horas_computadas[$i] === "N/A") ? 'class="table-secondary"' : ''; ?>>
                                <?php if($usr_autenticado['tipo'] == "C"): ?>
                                <a href="<?= base_url("index.php/controle_usuario/dados_usr/{$usuarios[$i]->id}")?>">
                                <?php endif; ?>
                                <?= $total_horas_computadas[$i] ?>
                                <?php if($usr_autenticado['tipo'] == "C"): ?>
                                </a>
                                <?php endif; ?>
                            </td>
                            <?php if($usr_autenticado['tipo'] == "ADM"): ?>
                            <td>
                                <?= $tipo[$i] ?>
                            </td>
                            <?php endif; ?>
                            <td>
                                <?php if($usr_autenticado['tipo'] == "C"): ?>
                                <a href="<?= base_url("index.php/controle_usuario/dados_usr/{$usuarios[$i]->id}")?>">
                                <?php endif; ?>
                                <?= ($usuarios[$i]->status == TRUE) ? "Ativo" : "Inativo" ?>
                                <?php if($usr_autenticado['tipo'] == "C"): ?>
                                </a>
                                <?php endif; ?>
                            </td>
                            <?php if($usr_autenticado['tipo'] == "ADM"): ?>
                            <td class="text-center">
                                <a class="text-dark p-0 ml-2 my-2" href="<?= base_url("index.php/Controle_usuario/dados_usr/{$usuarios[$i]->id}")?>">
                                    <i title="Visualizar dados de usuário" class="far fa-id-card"></i>
                                </a>
                                <a class="text-dark p-0 ml-2 my-2" href="<?= base_url("index.php/Controle_usuario/alterar_usuario/{$usuarios[$i]->id}")?>">
                                    <i title="Alterar dados de usuário" class="fas fa-user-edit"></i>
                                </a>
                                <?php if($usuarios[$i]->status == TRUE): ?>
                                <a class="desativar text-dark p-0 ml-2 my-2" href="<?= base_url("index.php/Controle_usuario/desativar/{$usuarios[$i]->id}")?>">
                                    <i title="Desativar usuário" class="fas fa-user-slash"></i>
                                </a>
                                <?php else: ?>
                                <a class="ativar text-dark p-0 ml-2 my-2" href="<?= base_url("index.php/Controle_usuario/ativar/{$usuarios[$i]->id}")?>">
                                    <i title="Ativar usuário" class="fas fa-user-check"></i>
                                </a>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
            <div class="paginacao">
                <?= $links ?>
            </div>
        </main>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".desativar").click(function (e) {
            conf = confirm("O usuário selecionado não poderá usar o sistema após ser desativado.\nPressione \"OK\" para confirmar a operação.");
            if(!conf) {
                e.preventDefault();
            }
        });
        
        $(".ativar").click(function (e) {
            conf = confirm("O usuário selecionado será reativado.\nPressione \"OK\" para confirmar a operação.");
            if(!conf) {
                e.preventDefault();
            }
        });
    });
</script>