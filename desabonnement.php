<?php
require 'connexBdd.php';

if(isset($_GET['id'])){
  $req = $bdd->prepare('UPDATE email SET valide=0 WHERE id =:id');
  $req->bindValue('id', $_GET['id'], PDO::PARAM_INT);
  if($req->execute()){
    echo "Vous êtes désabonné. Méchant !";
  }
}else{
  echo "erreur";
}

?>
