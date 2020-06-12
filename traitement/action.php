<?php
session_start();
require_once './connexion.php';
$db = new Database();

// connexion au plateforme
$erreur = "";
if (isset($_POST['username']) && $_POST['username'] != '' && isset($_POST['password']) && $_POST['password'] != '') {
    $username = trim($_POST['username']);
    $pass = trim($_POST['password']);
    $password = md5($pass);
    if (isset($_POST['remember'])) {
        setcookie('username', $username, time() + 360 * 24 * 3600, null, null, false, true);
        setcookie('password', $password, time() + 360 * 24 * 3600, null, null, false, true);
    }
    $rep = $db->connexion($username, $password);
    // echo json_encode($rep);
    echo json_encode(array('error' => $rep));
}




// view all users
if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = "";
    $data = $db->read();
    if ($db->totalRowCount() > 0) {
        $output .= ' <table class="table table-striped table-sm table-bordered">
                    <thead>
                        <!-- entete de la table -->
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>E-mail</th>
                            <th>Type</th>
                           <th>Action</th>
                        </tr>
                    </thead>
                    <!-- corps de la table -->
                    <tbody>';
        foreach ($data as  $row) {
            $output .= '<tr text-center text-secondary>
                    <td>' . $row['iduser'] . '</td>
                    <td>' . $row['prenom'] . '</td>
                    <td>' . $row['nom'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['type'] . '</td>
                    <td>
                    <a href="#" title="View Details" class="text-success infoBtn" id="' . $row['iduser'] . '">
                     <i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;

                     <a href="#" title="Edit" class="text-primary editBtn" data-toggle="modal"
                     data-target="#editModal" id="' . $row['iduser'] . '">
                     <i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;

                     <a href="#" title="Delete" class="text-danger delBtn" id="' . $row['iduser'] . '">
                     <i class="fas fa-trash-alt fa-lg"></i></a> &nbsp;&nbsp;<a href="#" title="lock" class="text-danger lockbnt" id="' . $row['iduser'] . '">
                     <i class="fa fa-lock" id="lo' . $row['iduser'] . '" style="font-size:20px ;color:#fd7e14"></i></a> </td>
                     </tr>';
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3  class="text-center text-secondary mt-5>:( No any user present in the database</h3>';
    }
}

//edit user
if (isset($_POST['edit_id'])) {
    $ids =  $_POST['edit_id'];
    $row = $db->getUserById($ids);
    echo json_encode($row);
}
//lock user
if (isset($_POST['lock_id'])) {
    $session = $_SESSION['iduser'];
    $ids =  $_POST['lock_id'];
    $row = $db->bloquer($ids, $session);
    echo json_encode(array('error' => $row));
}
/*********************************************add user  */
/************add user**********************************************************************************************************/
if (isset($_POST['classe'])) {


    $target_dir = "../ressources/images/avartar/";
    $target_file = $target_dir . basename($_FILES["files"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["files"]["tmp_name"]);
    if ($check !== false) {

        $uploadOk = 1;
    } else {
        $msg = "le fichier n'est pas un image.";
        // echo $msg;
        $uploadOk = 0;
    }
    if ($_FILES["files"]["size"] > 500000) {
        $msg = "Désoler votre fichiers est trop grand.";
        //echo $msg;
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png") {
        $msg = "Désoler seul les formats jpg et png sont autorisés";
        echo $msg;
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $msg = "Désolé votre fichiers n'a pas été télécharger.";
        // echo $msg;
    } else {

        if (move_uploaded_file($_FILES["files"]["tmp_name"], $target_file)) {

            $photo = basename($_FILES["files"]["name"]);
            // echo $photo;
            $image = $photo;
        } else {
            $msg = "Désolé des erreurs on arreter le telechargement de votre fichier.";
            // echo $msg;
        }
    }
    $prenom = $_POST['prenoms'];
    $nom = $_POST['noms'];
    $email = $_POST['emails'];
    $login = $_POST['logins'];

    $password = $_POST['passwords'];
    $type = $_POST['types'];
    $result = $db->insert($prenom, $nom, $email, $type, $login, $password, $image);
    echo json_encode(array('error' => $result));
}
/******************** update user*****************************************************************************************/
if (isset($_POST['action']) && $_POST['action'] == "update") {

    $id = $_POST['id'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    // $photo ="free.png";
    $db->update($id, $prenom, $nom, $email, $type, $login, $password, $photo);
}
/********* rubrique choisie*****************************************************/

if (isset($_POST['action']) && $_POST['action'] == "rubiquechoisi") {
    $rubrique = $_POST['rub'];
    echo $rubrique;
    if (!empty($rubrique)) {
        $_SESSION['rubrique'] = $rubrique;
        //echo $rubrique;
        $rep = "bon";
    }
    echo json_encode(array('error' => $rep));
}

/*delete user*/
if (isset($_POST['del_id'])) {
    $id = $_POST['del_id'];
    $db->delete($id, $_SESSION['iduser']);
}
/***** show details user****/
if (isset($_POST['info_id'])) {
    $id = $_POST['info_id'];
    $row = $db->getUserById($id);
    echo json_encode($row);
}
//mmmmmmmmmmmmmmmm
if (isset($_POST['infoss_id'])) {
    $id = $_POST['infoss_id'];
    $row = $db->getUserById($id);
    echo json_encode($row);
}
// expert to excel
if (isset($_GET['export']) && $_GET['export'] == "excel") {
    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=users.xls");
    header("Pregma: no-cache");
    header("Expires: 0");
    $data = $db->read();
    echo '<table  border="1">';
    echo '<tr><th>ID</th><th>Prenom</th><th>Nom</th><th>E-mail</th><th>Type</th><th>Login</th><th>Password</th></tr>';
    foreach ($data as  $row) {
        echo '<tr>
            <td>' . $row['iduser'] . '</td>
            <td>' . $row['prenom'] . '</td>
            <td>' . $row['nom'] . '</td>
            <td>' . $row['email'] . '</td>
            <td>' . $row['type'] . '</td>
            <td>' . $row['login'] . '</td>
         </tr>';
    }
    echo '</table>';
}

// add questions
if (isset($_POST['action']) && $_POST['action'] == "addquestions") {
    unset($_POST['action']);
    unset($_POST['valquestion']);
    unset($_POST['genereur']);
    $tab = $_POST;
    $question = $tab['question'];
    $rubrique = $tab['rubrique'];
    $score = $tab['score'];
    $type = $tab['type'];
    $reponse = '';
    $vrais = '';
    if ($type == "choixmultiple") {
        if (count($tab['rep']) > 1) {
            for ($i = 1; $i <= count($tab['rep']); $i++) {
                $reponse .= '-' . $tab['rep'][$i];
            }
        } else {
            $reponse = $tab['rep'][1];
        }

        if (count($tab['vrais']) > 1) {
            for ($i = 0; $i < count($tab['vrais']); $i++) {
                $vrais .= '-' . $tab['vrais'][$i];
            }
        } else {
            $vrais = $tab['vrais'][0];
        }
    } elseif ($type == "choixsimple") {
        $vrais = $tab['vrais'][0];

        if (count($tab['rep']) > 1) {
            for ($i = 1; $i <= count($tab['rep']); $i++) {
                $reponse .= '-' . $tab['rep'][$i];
            }
        } else {
            $reponse = $tab['rep'][1];
        }
    } else {
        $reponse = $tab['rep'];
        $vrais = $tab['rep'];
    }
    $db->insertquestions($question, $rubrique, $type, $score, $reponse, $vrais);
}


if (isset($_POST['action']) && $_POST['action'] == "viewquestions") {
    $tab = array();
    $tab1 = array();
    $ids = $db->totalquestionsRowCount();
    $row = $db->readquestions();
?>
    <div class="container-fluid">
        <table class="table table-sm table-bordered matable">
            <thead>
                <!-- entete de la table -->
                <tr class="text-center">
                    <th class="col"> QUESTIONS</th>
                    <th class="col">ACTION</th>

                </tr>
            </thead>
            <!-- corps de la table -->
            <tbody>
                <?php
                for ($i = 0; $i < $ids; $i++) :
                    $idquestion = $row[$i]['idquestion'];
                    $question = $row[$i]['question'];
                    $question = $row[$i]['question'];
                    $rubrique = $row[$i]['rubrique'];
                    $type = $row[$i]['type'];
                    $score = $row[$i]['score'];
                    $reponse = $row[$i]['reponse'];
                    $vrais = $row[$i]['vrais'];

                ?>
                    <tr text-center text-secondary>
                        <td>
                            <?php
                            if ($type == "choixmultiple") {
                                $good = bonne($reponse, $vrais);

                                $reponse = substr($reponse, 1);
                                $vrais = substr($vrais, 1);
                                $tab1 = explode('-', $reponse);
                                $pas = bonne($vrais, $reponse);

                            ?>
                                <div class="row">
                                    <div class=" form-group col-md-12">
                                        <label for="" class="col text-center text-secondary pr-3"></label><label for="" class=" text-center text-secondary"><?php echo ($i + 1) . '.'. $question; ?></label>
                                    </div>
                                </div>
                                <?php
                                if (count($tab1) > 0) {
                                    for ($p = 0; $p < count($tab1); $p++) {
                                ?>
                                        <div class="form-group">
                                            <input type="checkbox" class="checkbox-inline " name="<?php echo $tab1[$p]; ?>" id="<?php echo $p; ?>" <?php for ($x = 0; $x < count($good); $x++) {
                                                                                                                                                        if ($good[$x] == $p + 1) {
                                                                                                                                                            echo "checked";
                                                                                                                                                        }
                                                                                                                                                    } ?>><label for="" class=" text-center text-secondary pl-3"><?php echo $tab1[$p]; ?></label>
                                        </div>
                                <?php
                                    } //for p
                                } //count tab1
                            } //choix simple


                            elseif ($type == "choixsimple") {
                                $reponse = substr($reponse, 1);

                                // echo $reponse;
                                echo '<br>';
                                echo '<br>';
                                $tab1 = explode('-', $reponse);
                                //var_dump($tab1);
                                ?>
                                <div class="row">
                                    <div class=" form-group col-md-12 roundedOne">
                                        <label for="" class=" text-center text-secondary pr-3"></label><label for="" class=" text-center text-secondary"><?php echo ($i + 1) . '.'. $question; ?>


                                    </div>
                                </div>
                                <?php
                                if (count($tab1) > 0) {
                                    for ($p = 0; $p < count($tab1); $p++) {
                                ?>
                                        <div class="form-group ">
                                            <input type="radio" <?php if ($p == $vrais - 1) {
                                                                    echo "checked";
                                                                } ?> class="checkbox-inline " name="" id=""><label for="" class=" text-center text-secondary pl-3"><?php echo $tab1[$p]; ?></label>
                                        </div>
                                <?php
                                    }
                                }
                            } else {
                                ?>
                                <div class="row">
                                    <div class=" form-group col-md-12 roundedOne">
                                        <label for="" class=" text-center text-secondary pr-3"></label><label for="" class=" text-center text-secondary"><?php echo  ($i + 1) . '.'. $question; ?>


                                    </div>
                                </div>
                                <div class="form-group ">
                                    <input type="text" name="" value="<?php echo  $row[$i]['reponse']; ?>">
                                </div>
                            <?php

                            }
                            ?>

                        </td>
                        <td>
                            <a href="#" title="View Details" class="text-success infoBtnq float-right" style="margin-right: 15px;" id="<?php echo $row[$i]['idquestion']; ?>">
                                <i class="fas fa-info-circle fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;

                            <a href="#" title="Edit" class="text-primary editBtnq float-right" style="margin-right: 15px;" data-toggle="modal" data-target="#editqModal" id="<?php echo $row[$i]['idquestion']; ?>">
                                <i class="fas fa-edit fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;

                            <a href="#" title="Delete" class="text-danger delBtnq float-right" style="margin-right: 15px;" id="<?php echo $row[$i]['idquestion']; ?>">
                                <i class="fas fa-trash-alt fa-lg"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;

                        </td>

                    </tr>
                <?php
                endfor;

                ?>



            </tbody>
        </table>
    </div>




<?php

}


/***** show details questio****/
if (isset($_POST['infos_id'])) {
    $id = $_POST['infos_id'];
    $row = $db->getQuestionsById($id);
    echo json_encode($row);
}
/******************************* */
if (isset($_POST['limite'])) {
    $id = $_POST['limite'];
    $limite = file_get_contents('../ressources/json/questionparjeu.json');
    $limite = json_decode($limite, true);
    if (!empty($limite)) {
        $limite[0] = $id;
        $limite = json_encode($limite);
        file_put_contents("../ressources/json/questionparjeu.json", $limite);
    } else {
        $limite[] = $id;
        $limite = json_encode($limite);
        file_put_contents("../ressources/json/questionparjeu.json", $limite);
    }
    //echo json_encode($id);
}


/*delete question*/
if (isset($_POST['delq_id'])) {
    $id = $_POST['delq_id'];
    $result = $db->deletequestions($id);
    echo json_encode(array('error' => $result));
}


// update question
if (isset($_POST['editq_id'])) {
    $ids =  $_POST['editq_id'];
    $row = $db->getQuestionsById($ids);
    echo json_encode($row);
}
//updated question

if (isset($_POST['action']) && $_POST['action'] == "updateq") {

    unset($_POST['action']);
    unset($_POST['valquestion']);
    unset($_POST['genereur']);
    $tab = $_POST;
    //var_dump($tab);
    $id = $tab['id'];
    $question = $tab['question'];
    $rubrique = $tab['rubrique'];
    $score = $tab['score'];
    $type = $tab['type'];
    $reponse = '';
    $vrais = '';
    if ($type == "choixmultiple") {
        if (count($tab['rep']) > 1) {
            for ($i = 1; $i <= count($tab['rep']); $i++) {
                $reponse .= '-' . $tab['rep'][$i];
            }
        } else {
            $reponse = $tab['rep'][1];
        }

        if (count($tab['vrais']) > 1) {
            for ($i = 0; $i < count($tab['vrais']); $i++) {
                $vrais .= '-' . $tab['vrais'][$i];
            }
        } else {
            $vrais = $tab['vrais'][0];
        }
    } elseif ($type == "choixsimple") {
        $vrais = $tab['vrais'][0];

        if (count($tab['rep']) > 1) {
            for ($i = 1; $i <= count($tab['rep']); $i++) {
                $reponse .= '-' . $tab['rep'][$i];
            }
        } else {
            $reponse = $tab['rep'][1];
        }
    } else {
        $reponse = $tab['rep'];
        $vrais = $tab['rep'];
    }
    // echo $reponse;echo "<br>"; echo $vrais;
   $result = $db->updatequestions($id, $question, $rubrique, $type, $score, $reponse, $vrais);
   echo json_encode(array('error'=>$result));
}

// connexion












?>
