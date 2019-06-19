<style scoped>

    #user form figure *:first-child {
        width: 100%;
        height: auto;
        max-width: 13rem;
    }

    .form-group {
        display: inline-block;
    }

</style>

<div class="container-fluid">
    <div class="row justify-content-end">
        <main role="main" class="col-md-9 col-lg-10 px-5 pt-5">
            <div id="user" class="card">
                <div class="card-header">
                    Dados de usuário
                </div>
                <form class="card-body bg-light rounded p-3 text-center text-lg-left" style="border-width: 4px !important;">
                    <figure class="d-inline-block float-left col-md-12 col-lg-4 col-xl-3 mb-0 p-4 pr-lg-5 text-center">
                        <i class="fas fa-user-circle d-inline-block"></i>
                        <figcaption class="text-center h6">exemplo.usr</figcaption>
                    </figure>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">Aluno(a):</label>
                        <input class="form-control" type="text" value="Exemplo de nome" size="50" disabled>
                    </div>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">E-mail:</label>
                        <input class="form-control" type="text" value="meu.email@abc.com" size="25" disabled>
                    </div>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">Mátricula:</label>
                        <input class="form-control" type="text" value="0000000000000" size="13" disabled>
                    </div>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">Telefone:</label>
                        <input class="form-control" type="text" value="(00) 00000-0000" size="15" disabled>
                    </div>
                    <div class="form-group d-block d-sm-inline-block mx-0 mr-sm-4 text-left text-lg-left">
                        <label class="h5">Horas computadas:</label>
                        <input class="form-control" type="text" value="50" size="4" disabled>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>