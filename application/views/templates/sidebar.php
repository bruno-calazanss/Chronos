<style scoped>

    .sidebar {
        position: absolute;
        top: 3rem;
        min-height: calc(100% - 3rem);
        z-index: 50;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }
    
    .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
    }

    .nav-link {
        position: relative;
        font-weight: 500;
        color: #333;
        font-size: .875rem;
    }

    .nav-link *:first-child {
        position: absolute;
        height: 100%;
    }

    .nav-link div {
        padding-left: 1.6rem;
    }

    .nav-link:hover {
        color: #333;
        font-weight: bold;
        margin-left: 0 !important;
        padding-left: 0.5rem !important;
    }

</style>

<nav class="col-8 col-sm-5 col-md-3 col-lg-2 bg-light sidebar d-none d-md-block">
    <ul class="nav flex-column pt-2">
        <?php if($id != 0): ?>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_usuario/dados_usr')?>">
                <i class="far fa-id-card"></i>
                <div>Meus dados</div>
            </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_relatorio/historico')?>">
                <i class="fas fa-history"></i>
                <div>Histórico</div>
            </a>
        </li>
        <?php if($tipo == "AL"): ?>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_relatorio')?>">
                <i class="fas fa-plus"></i>
                <div>Adicionar relatório</div>
            </a>
        </li>
        <?php endif; ?>
        <?php if($tipo == "ADM"): ?>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_usuario/')?>">
                <i class="fas fa-user-plus"></i>
                <div>Cadastrar usuário</div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_usuario/listar_usuarios')?>">
                <i class="fas fa-users"></i>
                <div>Gerenciar usuários</div>
            </a>
        </li>
        <?php endif; ?>
        <?php if($tipo == "C"): ?>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_relatorio/relatorios_pendentes')?>">
                <i class="fas fa-check"></i>
                <div>Avaliar</div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_usuario/listar_usuarios')?>">
                <i class="fas fa-users"></i>
                <div>Visualizar alunos</div>
            </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_senha/modificar_senha')?>">
                <i class="fas fa-key"></i>
                <div>Alterar senha</div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="<?= base_url('index.php/Controle_usuario/sair')?>">
                <i class="fas fa-sign-out-alt"></i>
                <div>Sair</div>
            </a>
        </li>
    </ul>

    <!-- <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
        <div>Documentos recentes</div>
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="#">
                <i class="far fa-file-alt"></i>
                <div>Relatório</div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="#">
                <i class="far fa-file-alt"></i>
                <div>Relatório</div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="#">
                <i class="far fa-file-alt"></i>
                <div>Relatório</div>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 ml-3 my-2" href="#">
                <i class="far fa-file-alt"></i>
                <div>Relatório</div>
            </a>
        </li>
    </ul> -->
</nav>

<script>

window.onload = function() {
    $(".sidebar").sidebar().trigger("sidebar:toggle");
    $(".navbar-brand a:first-child").on("click", function () {
        $(".sidebar").trigger("sidebar:toggle");
        $(".sidebar").addClass("d-block");
        return false;
    });
}

</script>