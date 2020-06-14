<?php
session_start();
if (empty($_SESSION['connecter'])) {
    header("Location:../index.php");
}


require_once '../traitement/connexion.php';
include '../ressources/php/fonction.php';
$db = new Database();
$_SESSION['dejatrouver'] = $db->dejatrouver($_SESSION['iduser']);

$mescore = $db->meilleurscore();
$monmeilleur = $db->monmeilleurscore($_SESSION['iduser']);
if ($_SESSION['rubrique'] == "tous") {
    $_SESSION['jeu'] = $db->readquestions();
} else {
    $_SESSION['jeu'] = $db->affichequestion($_SESSION['rubrique']);

}
$_SESSION['total'] =  ajouer2($_SESSION['dejatrouver'], $_SESSION['jeu']);

$limite = file_get_contents('../ressources/json/questionparjeu.json');
$limite = json_decode($limite, true);
if ($limite[0] < count($_SESSION['total'])) {
    $limite = $limite[0];
} else {
    $limite = count($_SESSION['total']);
}
// $_SESSION['total']= shuffle($_SESSION['total']);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>SamaJeux</title>
    <link href="../ressources/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        .dropbtn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            width: 50%;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 200%;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);

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

                                            <img src="./images/avartar/<?php echo $_SESSION['photo']; ?>" id="pjoueur">

                                        </div>
                                        <div class="col-8 ">
                                            <h2 class=" font-weight-light my-4 text-center ">LE PLAISIR DE JOUER</h2>
                                        </div>
                                        <div class="col-2">
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
                                                <h3 class="modal-title w-100">QUESTION <?php if (!empty($_SESSION['total'])) {
                                                                                            echo $_GET['page'] + 1;
                                                                                        } else {
                                                                                            echo '0';
                                                                                        } ?>/<?php echo $limite; ?></h3>
                                            </div>
                                            <form action="../traitement/verif.php" method="post" style="height: 370px;" id="verifdata">
                                                <div class="form-control">
                                                    <?php if (!empty($_SESSION['total'])) {   ?>
                                                        <input type="hidden" name="numero" value="<?php echo $_GET['page']; ?>">
                                                        <input type="hidden" name="idquestion" value="<?php echo $_SESSION['total'][$_GET['page']]['idquestion']; ?>">
                                                        <label for=""><?php echo $_SESSION['total'][$_GET['page']]['question']; ?></label>
                                                        <input type="hidden" name="question" value="<?php echo $_SESSION['total'][$_GET['page']]['question']; ?>">
                                                        <input type="hidden" name="type" value="<?php echo $_SESSION['total'][$_GET['page']]['type']; ?>">
                                                    <?php }  ?>
                                                </div>
                                                <div class="form-control" style="height: 294px;">
                                                    <?php
                                                    if (!empty($_SESSION['total'])) {
                                                        if ($_SESSION['total'][$_GET['page']]['type'] == "choixmultiple") { // grand if 1
                                                            $reponse = $_SESSION['total'][$_GET['page']]['reponse'];
                                                            $part = substr($reponse, 1);
                                                            $rep = explode('-', $part);
                                                            $tabquestion = $rep;
                                                            
                                                            if (count($tabquestion) > 1) {
                                                                for ($i = 0; $i < count($tabquestion); $i++) {
                                                                    $answer = $tabquestion[$i];
                                                    ?>
                                                                    <div class="form-inline">
                                                                        <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                        <input type="checkbox" name="vrais[]" value="<?php echo $i + 1; ?>" size="20" id="" <?php if (!empty($_SESSION['bon'])) {
                                                                                                                                                                cocher($i + 1, $_SESSION['bon']);
                                                                                                                                                            } ?>>
                                                                        <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                                                    </div>
                                                                <?php
                                                                }
                                                            } else {
                                                                $answer = $reponse;
                                                                //var_dump($answer);
                                                                ?>
                                                                <div class="form-inline">
                                                                    <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                    <input type="checkbox" name="vrais[]" size="20" id="" value="<?php echo 1; ?>" <?php if (!empty($_SESSION['bon'])) {
                                                                                                                                                        cocher(1, $_SESSION['bon']);
                                                                                                                                                    } ?>>
                                                                    <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                                                </div>
                                                                <?php
                                                            }
                                                        } // fin grand if 1
                                                        elseif ($_SESSION['total'][$_GET['page']]['type'] == "choixsimple") { // grand elseif

                                                            $reponse = $_SESSION['total'][$_GET['page']]['reponse'];
                                                            $rep = substr($reponse, 1);
                                                            $tabquestion = explode('-', $rep);

                                                            if (count($tabquestion) > 1) {
                                                                for ($i = 0; $i < count($tabquestion); $i++) {
                                                                    $answer = $tabquestion[$i];
                                                                ?>
                                                                    <div class="form-inline">
                                                                        <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                        <input type="radio" name="vrais" size="20" id="" value="<?php echo $i + 1; ?>" <?php if (!empty($_SESSION['bon'])) {
                                                                                                                                                            cocher2($i + 1, $_SESSION['bon']);
                                                                                                                                                        } ?>>
                                                                        <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                                                    </div>
                                                                <?php
                                                                }
                                                            } else {
                                                                $answer = $tabquestion;
                                                                ?>
                                                                <div class="form-inline">
                                                                    <input type="hidden" name="reponse[]" value="<?php echo $i; ?>">
                                                                    <input type="radio" name="vrais" size="20" id="" <?php if (!empty($_SESSION['bon'])) {
                                                                                                                            cocher2($i + 1, $_SESSION['bon']);
                                                                                                                        } ?>>
                                                                    <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                                                </div>
                                                            <?php
                                                            }
                                                        } //fin grand elseif
                                                        else { // debut grand else
                                                            ?>
                                                            <div class="form-inline">
                                                                <input type="text" class="form-control col-md-6" name="vrais" value="<?php if (!empty($_SESSION['bon'])) {
                                                                                                                                            echo $_SESSION['bon'];
                                                                                                                                        } ?>">
                                                            </div>
                                                    <?php
                                                        }
                                                    } // fin du si il n'y a pas de questions a joueur
                                                    else {
                                                        echo "le jeu est terminer";
                                                    }



                                                    ?>

                                                </div>
                                                <div class="form-row col-xs-12">
                                                    <div class="col-md-12">
                                                        <?php if ($_GET['page'] > 0) {  ?>
                                                            <input class="btn btn-info col-xs-12" type="submit" name="precedent" id="precedent" value="Précédent">
                                                        <?php  } ?>

                                                        <?php if ($_GET['page'] < $limite - 1) { ?>
                                                            <input class="btn btn-info col-xs-6" style="float: inline-end;" id="suivant" name="suivant" type="submit" value="Suivant">
                                                        <?php } else {  ?>
                                                            <input class="btn btn-info col-xs-6" style="float: inline-end;" id="suivant" name="suivant" type="submit" value="Terminer">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- fin partie affichage question -->
                                        <div class="col-md-4 " style="height:300px;">

                                            <div class="dropdown " style="float:left;">
                                                <button class="dropbtn">Les 5 meilleurs scores</button>
                                                <div class="dropdown-content col-md-12" style="left:0;">
                                                    <table class="table table-striped table-sm table-bordered">
                                                        <?php
                                                        for ($i = 0; $i < count($mescore); $i++) :
                                                        ?>
                                                            <tr style="width:50%;height: 35px;">
                                                                <td><?php echo $mescore[$i]['prenom']; ?></td>
                                                                <td><?php echo $mescore[$i]['nom']; ?></td>

                                                                <td><?php echo $mescore[$i]['point'] . ' pts'; ?>
                                                                </td>
                                                            </tr>




                                                        <?php
                                                        endfor;
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="dropdown " style="float:right;">
                                                <button class="dropbtn">Mon meilleur score</button>
                                                <div class="dropdown-content">
                                                    <table class="table table-striped table-sm table-bordered">
                                                        <?php
                                                       
                                                        ?>
                                                            <tr style="width:50%;height: 35px;">
                                                                <td><?php echo $mescore[0]['prenom']; ?></td>
                                                                <td><?php echo $mescore[0]['nom']; ?></td>

                                                                <td><?php echo $mescore[0]['point'] . ' pts'; ?>
                                                                </td>
                                                            </tr>




                                                        <?php
                                                       
                                                        ?>
                                                    </table>
                                                </div>
                                            </div>


                                        </div>
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
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Titre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                </div>
                <div class="modal-body">
                    <p>Texte du modal + choix et actions...</p>
                </div>
                <script src="https://kit.fontawesome.com/a076d05399.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

                <!-- Bootstrap core JavaScript and others Local Links -->
                <script src="../ressources/jquery/jquery.min.js"></script>
                <script src="../ressources/bootstrap/js/bootstrap.bundle.min.js"></script>
                <script src="../ressources/DataTables/datatables.min.js"></script>
                <script src="../ressources/sweetalert2-9.13.4/package/dist/sweetalert2.min.js"></script>
                <script src="../ressources/fontawesome-free-5.13.0-web/js/all.js"></script>

                <script src="../ressources/js/joueur.js"></script>
                <script type="text/javascript">
                    // $(document).ready(function () {
                    //             $('#valider').click(function (e) {
                    //             if ($('#verifdata')[0].checkValidity()) {
                    //                 e.preventDefault();
                    //                 $.ajax({
                    //                     url: "../traitement/verif.php",
                    //                     type: "POST",
                    //                     data: $('#verifdata').serialize() + "&verif=corrige",
                    //                     success: function () {

                    //                         //console.log(response);
                    //                     }
                    //                 });
                    //         }
                    //     });
                    // })
                </script>

</body>

</html>
<?php

?>
