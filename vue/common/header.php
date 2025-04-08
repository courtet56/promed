<?php
/**
 * VUE : COMMON : header.php
 */
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= ASSET ?>/img/favicon.ico" type="image/x-icon" />
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSET ?>/css/popup.css">
    <link rel="stylesheet" href="<?= ASSET ?>/css/main.css">
    <?= $customCSS ?>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="<?= ASSET ?>/js/popup.js" defer></script>
    <script src="<?= ASSET ?>/js/main.js" defer></script>
    <script src="<?= ASSET ?>/js/<?= $_SESSION['CUSTOM_JS'] ?>" defer></script>
    <?= $customJS ?>
</head>

<body>
    <header>
        <!-- <div class="container-fluid"> -->
            <a class="navbar-brand" href="<?= $actual_link ?>">
                <img src="<?=ASSET?>/img/promed.jpg" id="main-logo">
            </a>
            <!-- <ul class="nav nav-pills">
                <li class="nav-item"><a href="admin/test" class="nav-link">Mon compte</a></li>';
                <li class="nav-item"><a href="about?app=10" class="nav-link">À propos</a></li>
            </ul> -->
        <!-- </div> -->
    </header>
    <!-- <nav class="header">
        
    </nav> -->