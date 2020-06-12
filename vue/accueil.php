<?php
session_start();
if (empty($_SESSION['connecter'])) {
  header("Location:../index.php");
}
require_once '../traitement/connexion.php';
$db = new Database();
$totaljoueur= $db->totalRowCount();
$totalquestion = $db->totalquestionsRowCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="../ressources/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- google icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

  <!-- Custom styles for this template -->
  <link href="../ressources/css/simple-sidebar.css" rel="stylesheet">
  <style type="text/css">
    .sticky {
      position: fixed;
      top: 0;
      width: 100%;
    }

    .sticky+.content {
      padding-top: 102px;
    }
  </style>

</head>

<body style="font-size: 25px;">

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
        <div class="droit " id="moncerclediv2c2">
          <span id="preview1"><img src="../ressources/images/avartar/<?php echo $_SESSION['photo']; ?>" alt="" srcset=""></span>

        </div>
        <div class="gauche" style="height:30px;padding-left: 170px;">
          <a href="#" title="Edit" class="text-success infodetcon" data-toggle="modal" id=" <?php echo $_SESSION['iduser']; ?>">
            <i class="fas fa-info-circle fa-lg"></i></a>
        </div>
        <?php

        ?>
      </div>
      <div class="list-group list-group-flush" id="menu">
        <a href="ajouterquestions.php" class="list-group-item list-group-item-action bg-light"><i class='fas fa-file-signature' style='font-size:24px;color:blue'></i>Add Questions</a>
        <a href="listerquestions.php" class="list-group-item list-group-item-action bg-light"><i class='fas fa-edit' style='font-size:24px;color:blue'></i>List/Edit Questions</a>
        <a href="ajouterutilisateurs.php" class="list-group-item list-group-item-action bg-light"><i class='fas fa-user-plus' style='font-size:24px;color:blue'></i>Add Users</a>
        <a href="listerutilisateurs.php" class="list-group-item list-group-item-action bg-light"><i class='fas fa-user-edit' style='font-size:24px;color:blue'></i>List/Edit Users</a>
        <a href="#" class="list-group-item list-group-item-action bg-light"></a>
        <a href="#" class="list-group-item list-group-item-action bg-light"></a>
        <input type="hidden" name="logout" value="logout" id="logout">


      </div>
      <div class="list-group list-group-flush">
          <a href="../traitement/deconnexion.php" onclick="if(!confirm('Voulez-vous vraiment vous déconnecter ?')) return false;" class="list-group-item list-group-item-action bg-light " value="logout"><i class="fa fa-power-off" style="font-size:24px;color:red"></i>Lougout</a>
        </div>
    </div>


    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

      </nav>

      <div class="container-fluid" id="contenu">
        <?php
        if (empty($_SESSION['connecter'])) {
          header("Location:./index.php");
        }
        if (!isset($_GET['lien']))
          $lien = 'accueil';
        // Sinon $lien est égal à la valeur de la variable lien qui provient de l'url
        else
          $lien = $_GET['lien'];

        // Quand $lien vaut :
        switch ($lien) {
          case 'ajouterquestions':
            include '.acceuil.php?page=ajouterquestions.php';
            break;
          case 'listerquestions':
            include './listerquestions.php';
            break;
          case 'ajouterutilisateurs':
            include './ajouterutilisateurs.php';
            break;
          case 'listerutilisateurs':
            include './listerutilisateurs.php';
            break;
          default:
            include './default.php';
        }

        ?>
      </div>
    </div>



    <!-- Bootstrap core JavaScript and others CDN Links -->

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../ressources/jquery/table-scroll.min.js"></script>

    <!-- Bootstrap core JavaScript and others Local Links -->

    <!-- mes fonctions js  -->


    <script src="../ressources/js/naviguer.js"></script>
    <script>

    </script>

    <!-- Menu Toggle Script -->
    <script>

    </script>

</body>

</html>
