   <?php
  //session_start();
  class Database
  {

    private $dsn ="mysql:host=localhost;dbname=senquiz";
    private $user ="root";
    private $pass ="";
    public $conn;

    public function __construct() {
      try {
        $this->conn = new PDO($this->dsn, $this->user, $this->pass);

      }
      catch (PDOException $e) {
        echo $e->getMessage();
      }
    }
    // traitement des users
    public function insert($prenom,$nom,$email,$type,$login,$password,$photo){
        $erreur = "faux";
        $sql = "SELECT * FROM utilisateur WHERE login = :login";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['login' => $login]);
        $count = $stmt->rowCount();
        if ($count > 0) {
          $erreur = "vrai";
        }
        else{
          $sql= "INSERT INTO utilisateur( prenom, nom, email, type, login, password, photo) VALUES (:prenom,:nom,:email,:type,:login,:password,:photo)";
          $stmt= $this->conn->prepare($sql);
          $stmt->execute(['prenom'=>$prenom,'nom'=>$nom,'email'=>$email,'type'=>$type,'login'=>$login,'password'=>MD5($password),'photo'=>$photo]);
          $count = $stmt->rowCount();
          if($count >0){
            $erreur ="faux";
          }else{
            $erreur = "erreur";
          }
      }
      return $erreur;
    }
    // afficher tous les utilisateurs
    public function read(){
      $data = array();
      $sql = "SELECT * FROM utilisateur";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach ($result as  $row) {
         $data[] = $row;

      }
      return $data;
    }
    // selectionner un utilisateur specifique avec son id
    public function getUserById($id){
      $sql = "SELECT * FROM utilisateur WHERE iduser = :id  LIMIT 1";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result;
    }
    // mettre à jour les informations d'un utilisateur
    public function update($id,$prenom, $nom, $email, $type, $login, $password, $photo){
      $sql= "UPDATE utilisateur SET prenom = :prenom,nom = :nom,email = :email,type = :type,login = :login ,password = :password ,photo =:photo WHERE iduser = :id";
      $stmt = $this->conn->prepare($sql);
     $stmt->execute(['prenom'=>$prenom,'nom'=>$nom,'email'=>$email,'type'=>$type,'login'=>$login,'password'=> MD5($password),'photo'=>$photo,'id'=>$id]);
     return true;
    }
    // supprimer un utilisateur
    public function delete($id,$usersession){
      $sql = "DELETE FROM utilisateur WHERE iduser = :id AND iduser !=:session";
       $stmt = $this->conn->prepare($sql);
      $stmt->execute(['id' => $id,'session'=>$usersession]);
      return true;

    }
      // recuperer password
    public function recuperation($email){
      $sql="SELECT * FROM utilisateur WHERE email=:email LIMIT 1";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute(['email'=>$email]);
      $count = $stmt->rowCount();
      if($count>0){
          $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
          foreach ($result as  $row) {
            $data[] = $row['monpass'];
          }
          
      }else{
        $data[]=1;
      }
        return $data;
    }
    // bloquer un utilisateur
    public function bloquer($id,$usersession){
      $t='';
      $sql="UPDATE utilisateur SET privilege = 0 WHERE iduser=:id AND iduser!=:session";
      $stmt= $this->conn->prepare($sql);
      $stmt->execute(['id'=>$id,'session'=>$usersession]);
       $count = $stmt->rowCount();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($count >0){
          $t ="good";
        }elseif($result['iduser']==$usersession){
          $t ="connect";
        }else{
          $t ="faux";
        }
        return $t;
    }
    // partie insertion des scores
    public function insertscore($id,$point){
      $sql= "SELECT * FROM score where iduser = :id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $count = $stmt->rowCount();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
       if($count>0){
          if ($result['point'] < $point) {
            $sql = " UPDATE score SET point =:point WHERE iduser=:id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['id' => $id, 'point' => $point]);
            $count = $stmt->rowCount();
          }
       }else{
          $sql = "INSERT INTO score (iduser,point) VALUES(:id,:point)";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute(['id' => $id, 'point' => $point]);
          $count = $stmt->rowCount();
       }

    }
    // selection les 5 meilleurs score
    public function meilleurscore(){
      $data = array();
        $sql = "SELECT utilisateur.prenom, utilisateur.nom ,score.point FROM utilisateur INNER JOIN score ON score.iduser = utilisateur.iduser ORDER BY score.point DESC LIMIT 5 ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();
        foreach ($stmt as  $row) {
          $data[] = $row;
        }
        return $data;
    }
      // selection les 5 meilleurs score
      public function monmeilleurscore($id)
      {
        $data = array();
        $sql = "SELECT utilisateur.prenom, utilisateur.nom ,score.point FROM utilisateur INNER JOIN score ON score.iduser = utilisateur.iduser where iduser=:id ORDER BY score.point DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $count = $stmt->rowCount();
        foreach ($stmt as  $row) {
          $data[] = $row;
        }
        return $data;
      }

    // calculer le nombre total de' utilisateurs
    public function totalRowCount(){
      $sql= " SELECT * FROM utilisateur";
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();
      $t_rows = $stmt->rowCount();
      return $t_rows;
    }

/************************************ PARTIE DES QUESTIONS */
  // ajouter une questions
  public function insertquestions($question,  $rubrique, $type, $score, $reponse, $vrais)
  {
    $sql = "INSERT INTO questions( question,  rubrique, type, score, reponse, vrais) VALUES (:question,:rubrique,:type,:score,:reponse,:vrais)";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['question' => $question,  'rubrique' => $rubrique, 'type' => $type, 'score' => $score, 'reponse' => $reponse, 'vrais' => $vrais]);

     return true;
  }
// afficher le nombre total de question
  public function allquestions(){
    $sql="SELECT COUNT(idquestion)FROM questions";
    $stmt=$this->conn->prepare($sql);
   $totalRowCount= $stmt->execute();
   $result = $stmt->fetchColumn();
    return $result;
  }
  // afficher les questions par rubrique
  public function affichequestion($rubrique){
     $tab = array();
    $sql="SELECT * FROM questions WHERE rubrique=:rubrique";
    $stmt=$this->conn->prepare($sql);
    $stmt->execute(['rubrique'=>$rubrique]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row) {
      $tab[]=$row;
      }
      return $tab;
  }
  // afficher toutes les questions et le mettre dans un tableau
  public function readquestions()
  {
    $data = array();
    $sql = "SELECT * FROM questions";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as  $row) {
      $data[] = $row;
    }
    return $data;
  }

  // afficher les differentes rubriques sans doublons
  public function rubrique(){
    $tab = array();
    $sql = "SELECT DISTINCT rubrique FROM questions";
     $stmt=$this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
   return $result;
  }
  // afficher les informations d'une questions à travers son id
  public function getQuestionsById($id)
  {
    $sql = "SELECT * FROM questions WHERE idquestion = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  // mettre à jour une question
  public function updatequestions($id, $question, $rubrique, $type, $score, $reponse, $vrais)
  {
        $erreur = '';
        $sql = "SELECT idquestion FROM dejajouer WHERE idquestion=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        $count = $stmt->rowCount();
        if ($count > 0) {
          $erreur = 'vrai';
        } else {
    $sql = "UPDATE questions SET question = :question,rubrique = :rubrique,type = :type,score = :score ,reponse = :reponse ,vrais =:vrais WHERE idquestion = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['question' => $question, 'rubrique' => $rubrique, 'type' => $type, 'score' => $score, 'reponse' => $reponse, 'vrais' => $vrais, 'id' => $id]);
          $erreur = 'faux';
          }

    return $erreur;
  }
  //supprimer un question à travers son id
  public function deletequestions($id)
  {
        $sql = "SELECT idquestion FROM dejajouer WHERE idquestion=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
         $count = $stmt->rowCount();
         if($count >0){
          $erreur= 'vrai';
         }else{
          $sql = "DELETE FROM questions WHERE idquestion = :id";
          $stmt = $this->conn->prepare($sql);
          $stmt->execute(['id' => $id]);
          $erreur = 'faux';
         }

  return $erreur;
  }
  //afficher le nombre total de questions
  public function totalquestionsRowCount(){
    $sql = " SELECT * FROM questions";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $t_rows = $stmt->rowCount();
    return $t_rows;
  }
  /*********************PARTIE CONCERNANT JOUER ET QUESTION *******************/
  // question déjà jouer par un jouer bien défini
  public function dejatrouver($id){
    $tab = array();
    $sql="SELECT idquestion FROM dejajouer WHERE iduser=:id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id'=> $id]);
    foreach($stmt as $row) {
      $tab[]=$row['idquestion'];
      }
      return $tab;
  }

 /***********PARTIE CONCERNANT LA CONNEXION DES UTILISATEURS***************** */
/*fonction connection*/
       public function connexion($login,$password){
           try {
               $erreur = "";
            $sql="SELECT * FROM utilisateur WHERE login =:login AND password=:password AND privilege != 0 ";
            $stmt =$this->conn->prepare($sql);
            $stmt->execute(['login'=>$login,'password'=>$password]);
            $count = $stmt->rowCount();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
             if($count >0){
                $_SESSION['prenom'] = $result['prenom'];
                $_SESSION['nom'] = $result['nom'];
                $_SESSION['photo'] = $result['photo'];
                $_SESSION['type'] = $result['type'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['iduser'] = $result['iduser'];
                $_SESSION['connecter']="connecter";
                if ($result['type']=='joueur') {
                  $_SESSION['monscore'] = 0;
                  $_SESSION['trouver']=array();
                  $_SESSION['data']=array();
                  $_SESSION['bon']=array();
                   $_SESSION['nombre']  = 0;
                  $_SESSION['dejatrouver'] = $this->dejatrouver($result['iduser']);
                  $erreur= "joueur";
                 }
                else if($result['type'] =='admin'){

                  $erreur= "admin";
                }
             }else{
                 $erreur = "error";
             }
           }  catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $erreur;
       }

       public function kholalma ($iduser,$idquestion){
        $t=0;
        $sql="SELECT * FROM dejajouer WHERE iduser=:id AND idquestion=:idques";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$iduser,'idques'=>$idquestion]);
        $count = $stmt->rowCount();
        if($count >0){
          $t = 1;
        }
        return $t;
       }


      public function dougalko($tab, $iduser)
      {
        $sql = "INSERT INTO dejajouer( iduser,idquestion) VALUES (:id,:idquestion)";
        $stmt = $this->conn->prepare($sql);
        if (!empty($tab)) {
          if (count($tab) > 1) {
            for ($i = 0; $i < count($tab); $i++) {
              $idquestion = $tab[$i];
              $look = $this->kholalma($iduser,$idquestion);
              if($look !=1){
              $stmt->execute(['id' => $iduser, 'idquestion' => $idquestion]);
            }
            }
          } elseif (count($tab) == 1) {
            $idquestion = $tab[0];
            $look=$this->kholalma($iduser,$idquestion);
              if($look !=1){
              $stmt->execute(['id' => $iduser, 'idquestion' => $idquestion]);
            }
          }
        }
        return true;
      }

  }


  // function


  // fonction pour connaitre les bonnes reponses pour le control
  function bonne($reponse ,$vrais){
    $rep= array();
    $vrai= array();
    $f= array();
    $lesbon = array();
    $rep= explode('-', (substr($reponse,1)));
    $vrai= explode('-', (substr($vrais,1)));
    for ($i=0; $i <count($vrai) ; $i++) {
      array_push($f, $vrai[$i]);
    }
    for ($l=0; $l < count($rep); $l++) {
      if (in_array(($l+1), $f)) {
        array_push($lesbon, ($l+1));
       }
    }
    return $lesbon ;
  }



?>
