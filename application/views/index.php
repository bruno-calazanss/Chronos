
<style scoped>
    .container-fluid, .row {
        min-height: 100vh;
    }

    .img-fluid {
        width: 40%;
        max-width: 10rem;
    }
    
    .input-group-text
    {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

</style>

<div class="container-fluid">
    <div class="row justify-content-center align-content-center">
        <div class="col-10 col-sm-8 col-md-5 col-lg-4 col-xl-3">
            <div class="card bg-light mb-3" style>
                <div class="card-header text-center">Área de acesso</div>
                <div class="card-body pt-0">
                    <img class="img-fluid d-block mx-auto my-4" src="<?= base_url("img/hourglass-152090_960_720.png"); ?>" alt="Chronos">
                    <form action="<?= base_url('index.php/autenticar_usr/autenticar')?>" method="POST" class="mx-auto">
                        <div class="input-group form-group">
                            <span class="input-group-text input-group-prepend">
                                <i class="fas fa-user" aria-hidden="true"></i>
                            </span>
                            <input class="form-control" name="nome_usr" placeholder="Nome de usuário">
                        </div>
                        <div class="input-group form-group mb-2">
                            <span class="input-group-text input-group-prepend">
                                <i class="fas fa-lock" aria-hidden="true"></i>
                            </span>
                            <input class="form-control" name="senha" placeholder="Senha" type="password">
                        </div>
                        <div class="m-0 ml-1 mb-3">
                            <a href="">
                                <u>Esqueceu sua senha?</u>
                            </a>
                        </div>
                        <input type="submit" value="Entrar" class="w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>