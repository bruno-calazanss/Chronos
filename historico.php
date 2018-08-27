<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("include/head.inc.php"); ?>
</head>

<body>
    <?php require_once("include/navbar.inc.php"); ?>
    <nav class="container-fluid">
        <div class="row">
            <nav class="col-2 bg-light sidebar" style="overflow-y: auto;">
            <?php require_once("include/sidebar.inc.php"); ?>

            <main role="main" class="col-10 ml-auto px-5">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </nav>
    </div>
    <?php require_once("include/scripts.inc.php"); ?>
</body>

</html>