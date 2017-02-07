<?php
define('USER', 'root');
define('PASS', '');
define('DATABASE', 'emailNewsletter');

global $bdd;
$bdd=false;
try{
    $bdd = new PDO(
        'mysql:host=localhost;dbname='.DATABASE.';charset=utf8',
        USER,
        PASS,
        array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)
    );
}catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
?>
