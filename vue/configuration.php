<?php
session_start();
require_once '../traitement/connexion.php';
$db = new Database();
$rubrique = $db->rubrique();
if(empty($_SESSION['connecter'])){
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <link href="../ressources/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    </script>
    <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="card shadow-lg border-0 rounded-lg mt-5a ">
                                <div class="card-header">
                                    <div class="cadre row">
                                        <!-- <div class="form-row"> -->
                                        <div class="col-2 divimage">

                                            <img src="../ressources/images/avartar/<?php echo $_SESSION['photo']; ?>" class="col" id="pjoueur">

                                        </div>
                                        <div class="col">
                                            <h2 class=" font-weight-light my-4 text-center ">LE PLAISIR DE JOUER</h2>
                                        </div>
                                        <div class=" col">
                                            <a href="../traitement/deconnexion.php" class="text-decoration-none"><input class="btn btn-danger btn-block" type="button" onclick="if(!confirm('Voulez-vous vraiment vous déconnecter ?')) return false;" name="deconnect" value="Déconnexion" style="margin-top:25px;"></a>
                                        </div>
                                        <!-- </div> -->
                                        <!--
                                        <div class="cadre2">
                                            <p class=" font-weight-light my-4">LE PLAISIR DE JOUER</p>
                                        </div> -->
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <!-- partie affichage de question -->
                                        <div class="col-md-8 bg-success" style="height: 450px;">
                                            <div class="modal-header text-center">
                                                <h3 class="modal-title w-100">Configuration du jeu </h3>
                                            </div>
                                            <form action="" method="post" style="height: 370px;" id="form-rubrique">
                                                <div class="form-control">
                                                    <marquee><label for="">Veuillez choisir votre rubrique de jeu</label></marquee>
                                                </div>
                                                <div class="form-row" style="height: 294px;">
                                                    <div class="form-row col-md-6">

                                                        <div class="form-group  col-md-12">
                                                            <label for="staticprenom" class="col-md-12 col-form-label font-weight-normal">Prénom : <span class="font-weight-bold"><?php echo $_SESSION['prenom']; ?></span></label>
                                                            <div class="col-md-12">
                                                                <label for="staticnom" class="col-md-12 col-form-label font-weight-normal">Nom : <span class="font-weight-bold"><?php echo $_SESSION['nom']; ?></span></label>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="staticemail" class="col-md-12 col-form-label font-weight-normal">Email : <span class="font-weight-bold"><?php echo $_SESSION['email']; ?></span></label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class=" form-group col-6">
                                                        <label for="rubrique" class="col-md-12 font-weight-bold">Rubrique</label>
                                                        <select class="custom-select form-control col-md-11" style="margin-top: 8px;" align="center" name="rub" id="">
                                                            <option value="tous" selected>Open this select menu</option>
                                                            <?php
                                                            for ($i = 0; $i < count($rubrique); $i++) {
                                                                foreach ($rubrique[$i] as $key => $value) {
                                                            ?>
                                                                    <option value="<?php echo $value; ?>">
                                                                        <?php echo $value; ?>
                                                                    </option>
                                                            <?php
                                                                }
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-md-12 text-center">
                                                        <input class="btn btn-info  col-md-6" id="rubrique" name="rubrique" type="submit" value="Procéder au jeux">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- fin partie affichage question -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        </div>
        </main>
    </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="../ressources/jquery/jquery.min.js"></script>
    <script src="../ressources/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../ressources/DataTables/datatables.min.js"></script>
    <script src="../ressources/sweetalert2-9.13.4/package/dist/sweetalert2.min.js"></script>
    <script src="../ressources/fontawesome-free-5.13.0-web/js/all.js"></script>

    <script src="../ressources/js/joueur.js"></script>

</body>

</html>
