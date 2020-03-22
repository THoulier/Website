<?php
try
{
	$bdd_users = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
  catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
  die('Erreur : '.$e->getMessage());
}

$mail = $_POST['InputEmail'];
$mdp_utilisateur = $_POST['InputPassword'];

$req = $bdd_users->prepare('SELECT password FROM Utilisateur WHERE  = ?');
$req->execute(array($mail));
$mdp_bdd = $req->fetch();


if (empty($mdp_bdd)){
  echo "Aucun compte n'est relié à cette adresse";
}
elseif ($mdp_bdd == $mdp_utilisateur) {
  echo "mot de passe correct";
}
else {
  echo "Mot de passe incorrect";
}
?>
