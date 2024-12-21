<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo PROJECT_NAME.': '.$page_title; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo BASE_URL_PUBLIC . 'assets/css/custom.css'; ?>" rel="stylesheet">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <?php include 'sidebar.php'; ?>

                <!-- Main Content -->
                <div class="col-md-9 col-lg-10 main-content">
                    
                    <header class="mb-4">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#"><?php echo $page_title; ?></a>
                            </div>
                        </nav>
                    </header>
                    
                    <?= _flash_message() ?>