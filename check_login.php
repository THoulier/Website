<?php

include("fonction.php");
$bdd_users = con();
if (mysqli_connect_errno($bdd_users)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$mail = $_POST['InputEmail'];
$mdp_utilisateur = $_POST['InputPassword'];




$stmt = mysqli_prepare($bdd_users,"SELECT * from Utilisateur WHERE Mail = ?");
mysqli_stmt_bind_param($stmt, 's', $mail);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$assoc = mysqli_fetch_assoc($res);



if (empty($assoc['MdP'])) {
  header("Location: connexion.php?mess=1");
} else {
  if ($assoc['MdP']==$mdp_utilisateur) {
    session_start();
    $_SESSION['mail']=$mail;
    $_SESSION['time']=time();
    $_SESSION['ID']=$assoc['ID'];
    $_SESSION['Pseudo']=$assoc['Pseudo'];
    $_SESSION['Prenom']=$assoc['Prenom'];
    $_SESSION['Nom']=$assoc['Nom'];

    header("Location: index.php");
  } else {
    header("Location: connexion.php?mess=2");
  }
}

?>

<a href="ajouter_ami.php">Gestion des amis</a>

