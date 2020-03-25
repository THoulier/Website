<?php

$bdd_users = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_users)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$mail = $_POST['InputEmail'];
$mdp_utilisateur = $_POST['InputPassword'];




$stmt = mysqli_prepare($bdd_users,"SELECT Mdp from Utilisateur WHERE Mail = ?");
mysqli_stmt_bind_param($stmt, 's', $mail);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$assoc = mysqli_fetch_assoc($res);



if (empty($assoc['Mdp'])) {
  header("Location: http://localhost/connexion.php?mess=1");
} else {
  if ($assoc['Mdp']==$mdp_utilisateur) {
    session_start();
    $_SESSION['mail']=$mail;
    header("Location: http://localhost/index.html");
  } else {
    header("Location: http://localhost/connexion.php?mess=2");
  }
}

?>

<a href="ajouter_ami.php">Gestion des amis</a>

