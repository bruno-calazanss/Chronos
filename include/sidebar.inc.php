<style scoped>
    /* .navbar .form-control {
        height: 2.24rem;
    } */

    .shadow {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
    }

    .nav-link *:first-child {
        margin-right: 0.1rem;
    }

    .nav-link:hover {
        font-weight: bold;
        padding-right: 0.3rem;
    }
</style>
<div class="col-2 invisible"></div>
<nav class="col-2 bg-light sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link d-block text-truncate" href="inicial.php">
                    <i class="far fa-id-card" aria-hidden="true"></i>
                    <span>Meus dados</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block text-truncate" href="historico.php">
                    <i class="fas fa-history" aria-hidden="true"></i>
                    <span>Histórico</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block text-truncate" href="adicionar.php">
                    <i class="fas fa-plus" aria-hidden="true"></i>
                    <span>Adicionar relatório</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block text-truncate" href="avaliar.php">
                    <i class="fas fa-check" aria-hidden="true"></i>
                    <span>Avaliar</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block text-truncate" href="index.php">
                    <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                    <span>Sair</span>
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted">
            <span>Documentos recentes</span>
        </h6>
        <ul class="nav d-flex flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link d-block text-truncate" href="#">
                    <span class="far fa-file-alt"></span>
                    <span>Relatório</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-block text-truncate" href="#">
                    <span class="far fa-file-alt"></span>
                    <span>Relatório</span>
                </a>
            </li>
        </ul>
    </div>
</nav>