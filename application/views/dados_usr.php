<style scoped>

    #user form figure *:first-child {
        width: 100%;
        height: auto;
        max-width: 13rem;
    }

    .form-group {
        display: inline-block;
    }

    .table th {
        text-align: center;
        vertical-align: middle;
    }

</style>

<div class="container-fluid">
    <div class="row justify-content-end">
        <main role="main" class="col-md-9 col-lg-10 mb-5 px-5 pt-5">
            <div id="user" class="card">
                <div class="card-header">
                    Dados de usuário
                </div>
                <form class="card-body bg-light rounded p-3 text-center text-lg-left" style="border-width: 4px !important;">
                    <figure class="d-inline-block float-left col-md-12 col-lg-4 col-xl-3 mb-0 p-4 pr-lg-5 text-center">
                        <i class="fas fa-user-circle d-inline-block"></i>
                        <figcaption class="text-center h6"><?= $usuario->nome_usr ?></figcaption>
                    </figure>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">Aluno(a):</label>
                        <input class="form-control" type="text" value="<?= $usuario->nome ?>" size="50" disabled>
                    </div>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">E-mail:</label>
                        <input class="form-control" type="text" value="<?= $usuario->email ?>" size="25" disabled>
                    </div>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">Mátricula:</label>
                        <input class="form-control" type="text" value="<?= $matricula ?>" size="13" disabled>
                    </div>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">Tipo de conta:</label>
                        <input class="form-control" type="text" value="<?= $tipo ?>" size="15" disabled>
                    </div>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">Horas computadas:</label>
                        <input class="form-control" type="text" value="<?= (!empty($total_horas_computadas)) ? $total_horas_computadas : "N/A"  ?>" size="4" disabled>
                    </div>
                </form>
            </div>
            <?php if($usuario->tipo == "AL"): ?>
            <div class="table-responsive mt-4">
                <table class="collection table table-bordered">
                    <thead class="font-weight-bold bg-light">
                        <tr>
                            <th colspan="3" id="header_Titulo">Somatória de horas</th>
                        </tr>
                        <tr>
                            <th id="header_Categoria">Categoria</th>
                            <th id="header_HorasValidadas">Horas validadas</th>
                            <th id="header_limite">Limite da categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="font-weight-bold">
                            <td>Ensino</td>
                            <td><?= $aluno->disc_nprevistas+$aluno->cursos_atualizacao+$aluno->monitoria ?></td>
                            <td>60</td>
                        </tr>
                        <tr>
                            <td>Disciplinas não previstas</td>
                            <td><?= $aluno->disc_nprevistas ?></td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Cursos de atualização</td>
                            <td><?= $aluno->cursos_atualizacao ?></td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Monitoria</td>
                            <td><?= $aluno->monitoria ?></td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Estágio não-obrigatório</td>
                            <td><?= $aluno->estagio_nobrigatorio ?></td>
                            <td>20</td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td>Extensão</td>
                            <td><?= $aluno->ev_internos+$aluno->ev_externos+$aluno->cursos_ext ?></td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td>Eventos internos</td>
                            <td><?= $aluno->ev_internos ?></td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>Eventos externos</td>
                            <td><?= $aluno->ev_externos ?></td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>Ministrar cursos de extensão</td>
                            <td><?= $aluno->cursos_ext ?></td>
                            <td>10</td>
                        </tr>
                        <tr class="font-weight-bold">
                            <td>Pesquisa</td>
                            <td><?= $aluno->init_cientifica+$aluno->publicacoes+$aluno->trab_cientifico ?></td>
                            <td>30</td>
                        </tr>
                        <tr>
                            <td>Iniciação científica (Tecnológica e Inovação)</td>
                            <td><?= $aluno->init_cientifica ?></td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Publicações</td>
                            <td><?= $aluno->publicacoes ?></td>
                            <td>20</td>
                        </tr>
                        <tr>
                            <td>Apresentação de trabalho científico</td>
                            <td><?= $aluno->trab_cientifico ?></td>
                            <td>20</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
            <?php endif; ?>
        </main>
    </div>
</div>