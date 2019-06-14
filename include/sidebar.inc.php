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

    .sidebar span {
        white-space: normal;
        word-break: break-word;
    }


    .nav-link {
        position: relative;
        font-weight: 500;
        color: #333;
        font-size: .875rem;
    }

    .nav-link *:first-child {
        margin-right: 0.1rem;
    }

    .nav-link span {
        position: absolute;
        left: 0;
        margin-left: 1.5rem;
    }

    .nav-link:hover {
        color: #333;
        font-weight: bold;
        padding-right: 0.2rem;
    }

</style>

<nav class="col-8 col-sm-5 col-md-3 col-lg-2 bg-light sidebar d-none d-md-block">
    <ul class="nav flex-column pt-2">
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="inicial.php">
                <i class="far fa-id-card"></i>
                <span>Meus dados</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="historico.php">
                <i class="fas fa-history"></i>
                <span>Histórico</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="adicionar.php">
                <i class="fas fa-plus"></i>
                <span>Adicionar relatório</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="adicionar_usr.php">
                <i class="fas fa-user-plus"></i>
                <span>Cadastrar usuário</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="avaliar.php">
                <i class="fas fa-check"></i>
                <span>Avaliar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="index.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Sair</span>
            </a>
        </li>
    </ul>

    <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
        <span>Documentos recentes</span>
    </h6>
    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="relatorio.php">
                <i class="far fa-file-alt"></i>
                <span>Relatório</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="relatorio.php">
                <i class="far fa-file-alt"></i>
                <span>Relatório</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="relatorio.php">
                <i class="far fa-file-alt"></i>
                <span>Relatório</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link p-0 mx-3 my-2" href="relatorio.php">
                <i class="far fa-file-alt"></i>
                <span>Relatório</span>
            </a>
        </li>
    </ul>
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