<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/svg+xml" href="<?= base_url('img/favicon.svg') ?>">
        <link rel="stylesheet" href="<?= base_url('css/reset.css') ?>">
        <link rel="stylesheet" href="<?= base_url('css/global.css') ?>">
        <link rel="stylesheet" href="<?= base_url('fontawesome/css/all.css') ?>">
        <link rel="stylesheet" href="<?= base_url('bootstrap4/css/bootstrap.css') ?>">
        <link rel="stylesheet" href="<?= base_url('css/sticky-footer.css') ?>">
        <?php if(!empty($fileUpload) && $fileUpload): ?>
        <link rel="stylesheet" href="<?= base_url('blueimp-file-upload/css/jquery.fileupload.css')?>">
        <?php endif; ?>
        <title>Chronos</title>
    </head>
    <body>