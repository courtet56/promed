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
    <script src="<?= ASSET ?>/js/logout.js" defer></script>
    <script src="<?= ASSET ?>/js/main.js" defer></script>
    <script src="<?= ASSET ?>/js/<?= $_SESSION['CUSTOM_JS'] ?>" defer></script>
    <?= $customJS ?>
    <!-- Bootstrap Bundle avec Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Icônes bootstrap: -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
    <header>
        <!-- <div class="container-fluid"> -->
            <?php
            if(isset($_SESSION['user']) && $_SESSION['user']['userType'] == "praticien") {
                $link = "./praticien";
            } else if (isset($_SESSION['user']) && $_SESSION['user']['userType'] == "patient") {
                $link = "./patient";
            } else {
                $link = $actual_link;
            }
            ?>
            <a class="navbar-brand" href="<?= $link ?>">
                <img src="<?=ASSET?>/img/promed.jpg" id="main-logo">
            </a>
            <!-- <ul class="nav nav-pills">
                <li class="nav-item"><a href="admin/test" class="nav-link">Mon compte</a></li>';
                <li class="nav-item"><a href="about?app=10" class="nav-link">À propos</a></li>
            </ul> -->
        <!-- </div> -->
        <?php
        // /if ($user->isLogin()) {
        ?>
         <?php
        //  }
         ?>
    </header>
    <?php
    if(isset($_SESSION['user']) && $_SESSION['user']['userType'] == "praticien" && $_SERVER['REQUEST_URI'] !== BASENAME . SLASH . 'accueil' && $_SERVER['REQUEST_URI'] !== BASENAME . SLASH . 'inscription' && $_SERVER['REQUEST_URI'] !== BASENAME . SLASH . 'auth' && $_SERVER['REQUEST_URI'] !== BASENAME . SLASH ) {
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"  style="align-items:center;">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?=$action == "accueil_praticien" ? "active" : ''?>" aria-current="page" href="./praticien?accueil_praticien">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$action == "agenda" ? "active" : ''?>" href="./praticien?agenda">Rendez-vous</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$action == "patients" ? "active" : ''?>" href="./praticien?patients">Patients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?=$action == "modif_profil" ? "active" : ''?>" href="./praticien?modif_profil">Mon profil</a>
        </li>
        <li>
          <a class="nav-link" id="logoutButton" data-bs-toggle="modal" data-bs-target="#logoutModal" style="color: red; cursor:pointer; font-weight:bold;">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <?php
    }
    ?>

<div class="modal fade" id="logoutModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Déconnexion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment vous déconnecter ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="logoutModalBtnClose" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="logoutModalBtnConfirm">Confirmer</button>
      </div>
    </div>
  </div>
</div>