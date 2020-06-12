<?php
session_start();
include_once('../ressources/php/fonction.php');
$limite = file_get_contents('../ressources/json/questionparjeu.json');
$limite = json_decode($limite, true);
if($limite[0] < count($_SESSION['total'])){
  $limite=$limite[0];
}else{
  $limite = count($_SESSION['total']);
}
$_SESSION['nombret']= $limite;
if(isset($_POST['suivant'])){

      $numero = $_POST['numero'];
      $p=$numero+1;
      if($numero<$limite-1){
      //on recuper les donnes du formulaire envoyer
        unset($_SESSION['bon']);

             // echo "le numero".$numero;
              unset($_POST['suivant']);
              unset($_POST['numero']);
              $s=replacevrais($_SESSION['data'],$_POST,$numero);
              if ($s==1) {
                $_SESSION['data'][$numero]['vrais']=$_POST['vrais'];
              }else{
                array_push($_SESSION['data'],$_POST);
              }

            $recu =recupdonne('suivant');

            /*on recuper la questions avec les reponses correctes et le score*/

            $laquestionjouer = $_SESSION['total'][$numero];

            $score = $_SESSION['total'][$numero]['score'];
            $idquestion = $_SESSION['total'][$numero]['idquestion'];

            /***************recuperation des reponse du joueur***********************/
            $lesrepdonne = lesbonnes($recu);


            /***************recuperation des reponse du l'administrateur***********************/
            $reporiginal = lesbonreponses($laquestionjouer);

            // on verifie si les reponse donnez sont identiques au reponse original
                  $identic = identical_values( $lesrepdonne, $reporiginal);
                  if ($identic==1) {
                    $_SESSION['monscore']=$_SESSION['monscore']+$score;
                    array_push($_SESSION['trouver'],$idquestion);
                  // echo "le score est :".$score;
                  }

            //on redirige vars la pages suivantes

            header('location:../vue/joueur.php?page='.$p);
        }else{
                $_SESSION['rep']= $_POST;
              unset($_SESSION['bon']);
              unset($_POST['verif']);
              unset($_POST['numero']);
               $s=replacevrais($_SESSION['data'],$_POST,$numero);
              if ($s==1) {
                $_SESSION['data'][$numero]['vrais']=$_POST['vrais'];
              }else{
                array_push($_SESSION['data'],$_POST);
              }
            $recu =recupdonne('valider');

            /*on recuper la questions avec les reponses correctes et le score*/

            $laquestionjouer = $_SESSION['total'][$numero];

            $score = $_SESSION['total'][$numero]['score'];
            $idquestion = $_SESSION['total'][$numero]['idquestion'];
            /***************recuperation des reponse du joueur***********************/
            $lesrepdonne = lesbonnes($recu);
            /***************recuperation des reponse du l'administrateur***********************/
            $reporiginal = lesbonreponses($laquestionjouer);
                             // on verifie si les reponse donnez sont identiques au reponse original
                  $identic = identical_values( $lesrepdonne, $reporiginal);
                  if ($identic==1) {
                    $_SESSION['monscore'] = $_SESSION['monscore'] +$score;
                    array_push($_SESSION['trouver'],$idquestion);

                  }

            //on redirige vars la pages suivantes

           header('location:../vue/terminer.php');
        }


}



/******************************TARIE DU BOUTON PRECEDENT*********************************************************************************/

if(isset($_POST['precedent'])){
  // on recuper les donnees precedenment poster
    $p = $_POST['numero']-1;
    $tab=$_SESSION['data'][$p];
     $lesrepdonne = lesbonnes($tab);
// on compare  les reponses pour savoir si on decrement le score
     $laquestionjouer = $_SESSION['total'][$p];
     $decrement = $_SESSION['total'][$p]['score'];
     $idquestion = $_SESSION['total'][$p]['idquestion'];
    $repriginal = lesbonreponses($laquestionjouer);
// on verifie si les reponse donnez sont identiques au reponse original
    $identic = identical_values( $lesrepdonne, $repriginal);
    if ($identic==1) {
      $_SESSION['monscore']=$_SESSION['monscore']-$decrement;
    }
    $_SESSION['bon']=reponsecocher($tab,$p);
    $_SESSION['trouver']=replacetrouver($idquestion,$_SESSION['trouver']);
    header('location:../vue/joueur.php?page='.$p);
    echo $_SESSION['monscore'];
}

?>
