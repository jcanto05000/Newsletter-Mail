<?php
require 'PHPMailer/PHPMailerAutoload.php';
require 'connexBdd.php'; //connexion base

echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

/* function envoiDuMail
 * Envoi le mail au destinataire*/
function envoiDuMail($id,$email,$nom){

  $mail = new PHPMailer;

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = "YOUR_MAIL";                        // SMTP username
  $mail->Password = "YOUR_MDP";                          // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to
  $mail->setFrom("YOUR_MAIL", "NewsLetter MIW");
  $mail->addAddress($email, $nom);                      // Add a recipient
  $mail->addReplyTo("YOUR_MAIL", "Info NewsLetter MIW");
  $mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = 'Voici ma Newsletter';
  $mail->Body    = "<p>$nom, je suis content que tu sois abonne !</p><p>Des tonnes d'actu toutes les semaines !</p>";
  $mail->Body    .= "<br/><br/>";
  $mail->Body    .= "<p>Si tu cliques ici c'est que t'es mechant ! <a href='http://localhost/newsletter-jcanto/desabonnement.php?id=$id'>Se désabonner</a></p>";
  $mail->AltBody = 'Ma news!';

  if(!$mail->send()){
      echo 'Envoi impossible';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  }else{
      echo '<br/>Mail envoyé';
  }
}

$nb = 0;
if(isset($_GET['nb'])) {
    $nb = $_GET['nb'];
}
$page = $nb * 5;


$req = $bdd->prepare('SELECT * FROM email WHERE valide = 1 LIMIT :nb, 5');
$req->bindValue('nb', $page, PDO::PARAM_INT);
$req->execute();
if($req->rowCount() == 0) {
    echo "Newsletter envoyé !";
}
else {
    while($data = $req->fetch()) {
        envoiDuMail($data['id'],$data['email'],$data['nom']);
        usleep(50);
    }
    usleep(300);
    $nb++;
    header('refresh:1;url=newsletter.php?nb='.$nb);
}
?>
