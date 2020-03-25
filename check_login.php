<?php
include("functions.php");
$bdd_users = con();
if (mysqli_connect_errno($bdd_users)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$mail = $_POST['InputEmail'];
$mdp_utilisateur = $_POST['InputPassword'];




$stmt = mysqli_prepare($bdd_users,"SELECT Mdp from Utilisateur WHERE mail = ?");
mysqli_stmt_bind_param($stmt, 'i', $mail);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$assoc = mysqli_fetch_assoc($res);



if (empty($assoc['MdP'])) {
  header("http://localhost/connexion.php*?mess=1");
} else {
  if ($assoc['MdP']==$mdp_utilisateur) {
    //session_start();
    //$_SESSION['mail']=$mail;
    header("Location: http://localhost/index.hmtl");
  } else {
    header("Location: http://localhost/connexion.php*?mess=2");
  }
}

session_start();
$_SESSION['mail']=$mail;
?>

<a href="ajouter_ami.php">Gestion des amis</a>

