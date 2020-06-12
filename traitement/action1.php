<?php
session_start();
 require_once './connexion.php';
    $db = new Database();
if (isset($_POST['login'])  ) {
    //var_dump($_POST);
    /******************************************************************************/
    $target_dir = "../ressources/images/avartar/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));



        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {

            $uploadOk = 1;
        } else {
            $msg = "le fichier n'est pas un image.";
           // echo $msg;
            $uploadOk = 0;
        }



    if ($_FILES["photo"]["size"] > 500000) {
        $msg = "Désoler votre fichiers est trop grand.";
        
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png") {
        $msg = "Désoler seul les formats jpg et png sont autorisés";
      
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $msg = "Désolé votre fichiers n'a pas été télécharger.";
       
    } else {

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {

            $photo = basename($_FILES["photo"]["name"]);
            
            $image=$photo;
        } else {
            $msg = "Désolé des erreurs on arreter le telechargement de votre fichier.";
          
        }
    }
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $login = $_POST['login'];

    $password = $_POST['password'];
    $type=$_POST['type'];
   $result = $db->insert($prenom, $nom, $email, $type, $login, $password, $image);
   echo json_encode($result);
}
?>
