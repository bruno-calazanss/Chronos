
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
                <div class="card-header text-center">Redefinição de senha</div>
                <div class="card-body text-center">
                    <p>Para redefinir sua senha digite o e-mail associado ao seu cadastro no sistema:</p>
                    <form action="<?= base_url('index.php/controle_senha/redefinir_senha')?>" method="POST" class="mx-auto">
                        <div class="input-group form-group">
                            <input type="email" class="form-control" name="email" placeholder="email@exemplo.com" required>
                        </div>
                        <input type="submit" value="Redefinir" class="w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>