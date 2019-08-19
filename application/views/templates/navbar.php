<style scoped>

    .navbar {
        z-index: 100;
    }

    .navbar div{
        padding-top: .75rem;
        padding-bottom: .75rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
    }

    .navbar-brand {
        font-size: 1rem;
    }

    .shadow {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15);
    }

</style>

<nav class="navbar navbar-dark bg-dark shadow p-0">
    <div class="navbar-brand mx-0 col-12 col-sm-5 col-md-3 col-lg-2 text-truncate">
        <a class="navbar-brand mr-2 p-0" href="#"><i class="fas fa-bars d-inline d-md-none"></i></a>
        <a class="navbar-brand p-0" href="#">Menu</a>
    </div>
    <div class="navbar-brand m-0 p-1 d-none d-sm-block col-sm-7 col-md-9 col-lg-10 position-absolute h-100" style="background-color: inherit; right: 0;" href="#">
        <img class="w-100 mx-auto h-100" src="<?= base_url("img/logo.svg"); ?>" style="filter: invert(1);" alt="Chronos">
    </div>
</nav>