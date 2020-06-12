<?php
session_start();
if (empty($_SESSION['connecter'])) {
    header("Location:../index.php");
    var_dump($_SESSION['data']);
    //var_dump($_SESSION['rep']);
}


require_once '../traitement/connexion.php';
include '../ressources/php/fonction.php';
$db = new Database();
//var_dump($_SESSION['trouver']);
$r = $db->dougalko($_SESSION['trouver'], $_SESSION['iduser']);
$scoring = $db->insertscore($_SESSION['iduser'], $_SESSION['monscore']);
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
    <style>

    </style>
</head>

<body class="bg-primary" style="background-color:#fff7">
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
                                        <div class="col-md-8 bg-success" style="height: 550px;overflow: scroll;">
                                            <div class="modal-header text-center">
                                                <h3 class="modal-title w-100">Historique des QUESTION</h3>
                                            </div>
                                            <!-- kkkkkkkkkkkkkkkkkkkk -->
                                            <?php
                                            if (!empty($_SESSION['data'])) {

                                                if (count($_SESSION['data']) > 1) {

                                                    for ($k = 0; $k < count($_SESSION['data']); $k++) {
                                                        if (!empty($_SESSION['data'][$k]['vrais'])) {
                                                            $tab = $_SESSION['data'][$k]['vrais'];
                                                        } else {
                                                            $tab = [];
                                                        }


                                            ?> <br>
                                                        <label for="" style="font-size: 30px;"><?php echo ($k + 1) . '. ' . $_SESSION['data'][$k]['question']; ?></label>

                                                        <?php
                                                        if ($_SESSION['data'][$k]['type'] == "choixmultiple") { // grand if 1
                                                            $tabquestion = $_SESSION['data'][$k]['reponse'];
                                                            $part = $_SESSION['total'][$k]['vrais'];

                                                            $rep = substr($part, 1);
                                                            $pol = explode('-', $rep);
                                                            // var_dump($pol);
                                                            if (count($tabquestion) > 1) {
                                                                for ($i = 0; $i < count($tabquestion); $i++) {
                                                                    $answer = $tabquestion[$i];
                                                        ?>
                                                                    <div class="form-inline">
                                                                        <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                        <input type="checkbox" name="vrais[]" value="<?php echo $i + 1; ?>" size="20" id="" <?php if (!empty($tab)) {
                                                                                                                                                                cocher($i + 1, $tab);
                                                                                                                                                            } ?>>
                                                                        <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>&nbsp;&nbsp;
                                                                        <?php if (cocher5($i + 1, $tab)) {
                                                                            if (cocher5($i + 1, $pol)) {
                                                                                echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                            } else {
                                                                                echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                <?php
                                                                }
                                                            } else {

                                                                $answer = $tabquestion[0];

                                                                if (!empty($_SESSION['data'][0]['vrais'])) {
                                                                    $tab = $_SESSION['data'][0]['vrais'][0];
                                                                } else {
                                                                    $tab = 0;
                                                                }
                                                                // var_dump($tab);
                                                                ?>
                                                                <div class="form-inline">
                                                                    <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                    <input type="checkbox" name="vrais[]" size="20" id="" value="<?php echo  1; ?>" <?php if (!empty($tab)) {
                                                                                                                                                        cocher2(1, $tab);
                                                                                                                                                    } ?>>
                                                                    <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>&nbsp;&nbsp;
                                                                    <?php if ($pol == $tab) {
                                                                        echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                    } else {
                                                                        echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                                    } ?>
                                                                </div>
                                                                <?php
                                                            }
                                                        } // fin grand if 1
                                                        elseif ($_SESSION['data'][$k]['type'] == "choixsimple") { // grand elseif

                                                            $pol = $_SESSION['total'][$k]['vrais'];
                                                            //var_dump($pol);

                                                            $reponse = $_SESSION['data'][$k]['reponse'];
                                                            $tabquestion = $_SESSION['data'][$k]['reponse'];

                                                            if (count($tabquestion) > 1) {
                                                                for ($i = 0; $i < count($tabquestion); $i++) {
                                                                    $answer = $tabquestion[$i];
                                                                ?>
                                                                    <div class="form-inline">
                                                                        <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                        <input type="radio" name="vrais" size="20" id="" value="<?php echo $i + 1; ?>" <?php if (!empty($tab)) {
                                                                                                                                                            cocher2($i + 1, $tab);
                                                                                                                                                        } ?>>
                                                                        <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>&nbsp;&nbsp;
                                                                        <?php if (cocher4($i + 1, $tab)) {
                                                                            if ($tab == $pol) {
                                                                                echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                            } else {
                                                                                echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                <?php
                                                                }
                                                            } else {
                                                                $answer = $tabquestion;
                                                                $pol = $_SESSION['total'][$k]['vrais'];
                                                                echo "<br>";
                                                                //var_dump($pol);
                                                                echo "<br>";
                                                                ?>
                                                                <div class="form-inline">
                                                                    <input type="hidden" name="reponse[]" value="<?php echo $i; ?>">
                                                                    <input type="radio" name="vrais" size="20" id="" <?php if (!empty($tab)) {
                                                                                                                            cocher2($i + 1, $tab);
                                                                                                                        } ?>>
                                                                    <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>&nbsp;&nbsp;
                                                                    <?php if ($pol == $i + 1) {
                                                                        echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                    } else {
                                                                        echo "<i class='fa fa-close' style='font-size:20px;color:red;margin-left:15px;'></i>";
                                                                    } ?>
                                                                </div>
                                                            <?php
                                                            }
                                                        } //fin grand elseif
                                                        else { // debut grand else
                                                            $pol = $_SESSION['total'][$k]['vrais'];
                                                            //echo "<br>";
                                                            // var_dump($pol);
                                                            // echo "<br>";
                                                            ?>
                                                            <div class="form-inline">
                                                                <input type="text" disabled class="form-control col-md-6" name="vrais" value="<?php if (!empty($tab)) {
                                                                                                                                                    echo $tab;
                                                                                                                                                } ?>">&nbsp;&nbsp;
                                                                <?php if ($pol == $tab) {
                                                                    echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                } else {
                                                                    echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                                } ?>
                                                            </div>
                                                    <?php
                                                        }
                                                    }
                                                } else { // mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm
                                                    if (!empty($_SESSION['data'][0]['vrais'])) {
                                                        $tab = $_SESSION['data'][0]['vrais'];
                                                    } else {
                                                        $tab = 0;
                                                    }

                                                    ?>
                                                    <label for=""><?php echo '1 .' . $_SESSION['data'][0]['question']; ?></label>
                                                    <?php
                                                    if ($_SESSION['data'][0]['type'] == "choixmultiple") { // grand if 1
                                                        $tabquestion = $_SESSION['data'][0]['reponse'];
                                                        $part = $_SESSION['total'][0]['vrais'];
                                                        $rep = substr($part, 1);
                                                        $pol = explode('-', $rep);

                                                        if (count($tabquestion) > 1) {
                                                            for ($i = 0; $i < count($tabquestion); $i++) {
                                                                $answer = $tabquestion[$i];
                                                    ?>
                                                                <div class="form-inline">
                                                                    <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                    <input type="checkbox" name="vrais[]" value="<?php echo $i + 1; ?>" size="20" id="" <?php if (!empty($tab)) {
                                                                                                                                                            cocher($i + 1, $tab);
                                                                                                                                                        } ?>>
                                                                    <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <?php if (cocher5($i + 1, $tab)) {
                                                                        if (cocher5($i + 1, $pol)) {
                                                                            echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                        } else {
                                                                            echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            <?php
                                                            }
                                                        } else {
                                                            $answer = $tabquestion[0];
                                                            if (!empty($_SESSION['data'][0]['vrais'])) {
                                                                $tab = $_SESSION['data'][0]['vrais'][0];
                                                            } else {
                                                                $tab = 0;
                                                            }
                                                            // var_dump($_SESSION['data'][0]['vrais']);

                                                            ?>
                                                            <div class="form-inline">
                                                                <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                <input type="checkbox" name="vrais[]" size="20" id="" value="<?php echo 1; ?>" <?php if (!empty($tab)) {
                                                                                                                                                    cocher2(1, $tab);
                                                                                                                                                } ?>>
                                                                <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                                                <?php if (cocher4(1, $tab)) {
                                                                    if (1 == $_SESSION['total'][0]['vrais']) {
                                                                        echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                    } else {
                                                                        echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <?php
                                                        }
                                                    } // fin grand if 1
                                                    elseif ($_SESSION['data'][0]['type'] == "choixsimple") { // grand elseif
                                                        $pol = $_SESSION['total'][0]['vrais'];
                                                        $reponse = $_SESSION['data'][0]['reponse'];
                                                        $tabquestion = $_SESSION['data'][0]['reponse'];

                                                        if (count($tabquestion) > 1) {
                                                            for ($i = 0; $i < count($tabquestion); $i++) {
                                                                $answer = $tabquestion[$i];
                                                            ?>
                                                                <div class="form-inline">
                                                                    <input type="hidden" name="reponse[]" value="<?php echo $answer; ?>">
                                                                    <input type="radio" name="vrais" size="20" id="" value="<?php echo $i + 1; ?>" <?php if (!empty($tab)) {
                                                                                                                                                        cocher2($i + 1, $tab);
                                                                                                                                                    } ?>>
                                                                    <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                                                    <?php if (cocher4($i + 1, $tab)) {
                                                                        if ($tab == $pol) {
                                                                            echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                        } else {
                                                                            echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            <?php
                                                            }
                                                        } else {
                                                            $answer = $tabquestion;
                                                            ?>
                                                            <div class="form-inline">
                                                                <input type="hidden" name="reponse[]" value="<?php echo $i; ?>">
                                                                <input type="radio" name="vrais" size="20" id="" <?php if (!empty($tab)) {
                                                                                                                        cocher2($i + 1, $tab);
                                                                                                                    } ?>>
                                                                <label for="" style="margin-left:8px;"><?php echo $answer; ?></label>
                                                                <?php if ($pol == $tab) {
                                                                    echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                                } else {
                                                                    echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                                } ?>
                                                            </div>
                                                        <?php
                                                        }
                                                    } //fin grand elseif
                                                    else { // debut grand else
                                                        $pol = $_SESSION['total'][0]['vrais'];
                                                        ?>

                                                        <div class="form-inline">
                                                            <input type="text" class="form-control col-md-6" name="vrais" value="<?php if (!empty($tab)) {
                                                                                                                                        echo $tab;
                                                                                                                                    } ?>" disabled>
                                                            <?php if ($pol == $tab) {
                                                                echo "<i class='fa fa-check-circle' style='font-size:20px;color:green'></i>";
                                                            } else {
                                                                echo "<i class='fa fa-close' style='font-size:20px;color:red'></i>";
                                                            } ?>
                                                        </div>
                                            <?php
                                                    }
                                                }
                                            }

                                            ?>
                                            <!-- kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk -->
                                        </div>
                                        <!-- fin partie affichage question -->

                                        <div class="col-md-4" style="height:500px;">

                                            <div class="col">
                                                <marquee>
                                                    <h3 for="" class=" h-25 text-success"> Merci la partie est terminée!!</h3>
                                                </marquee>
                                            </div>
                                            <div class="col">
                                                <label for="" class="form-control"><?php echo $_SESSION['prenom'] . '    ' .  $_SESSION['nom'];   ?></label>
                                            </div>
                                            <div class="col">
                                                <label for="" class="form-control">Votre score est : <?php echo $_SESSION['monscore']    ?></label>
                                            </div>
                                            <div class="col" style="height:290px;">
                                                <div class="col">
                                                    <label for="" class="form-control">Questions trouver est de <?php echo count($_SESSION['trouver']); ?>/<?php echo $_SESSION['nombret']; ?></label>
                                                </div>

                                                <div class="col">
                                                    <label for="" class="form-control">Moyenne de jeu : <?php echo ((count($_SESSION['trouver']) * 100) / $_SESSION['nombret']); ?> %</label>
                                                </div>
                                            </div>
                                            <div class="form-row col-12">
                                                <div class="col">
                                                    <a href="../traitement/rejouer.php"><input type="submit" class="btn btn-success" name="rejouer" id="rejouer" style="float:left;" value=" rejouer"></a>
                                                </div>
                                                <div class="col">
                                                    <a href="../traitement/retour.php"><input type="submit" class="btn btn-success" name="retour" id="retour" style="float:rignt;" value=" changer de Rubrique"></a>
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


                <script src="../ressources/js/fonction.js"></script>
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