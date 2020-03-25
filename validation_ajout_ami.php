<?php
include("functions.php");
session_start();

if(isset($_SESSION['mail']))
{
    echo 'Vous êtes connecté en tant que '  .$_SESSION['mail'];
}


$bdd_friend = con();
if (mysqli_connect_errno($bdd_friend)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$validationformulaire=1;

if (empty($_POST['id_to'])) {
    echo "Vous devez renseigner l'identifiant de votre ami";
    echo "</br>";
    $validationformulaire=0;
} 
 elseif (mysqli_num_rows(mysqli_query($bdd_friend,"SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['id_to']."'"))==1) {
    echo "</br>";
    $validationformulaire=1;
}



if ($validationformulaire){

$res = mysqli_query($bdd_friend, "SELECT * FROM Utilisateur WHERE Mail='".$_SESSION['mail']."'");
$ras = mysqli_query($bdd_friend, "SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['id_to']."'");

$id_ask_friend = mysqli_fetch_row($res);
$id_new_friend = mysqli_fetch_row($ras);

$new_friendship = "INSERT INTO Amis(id_from,id_to,etat) VALUES($id_ask_friend[0],$id_new_friend[0],0)";


if (mysqli_query($bdd_friend, $new_friendship)) {
    echo "Votre demande d'ami a bien été envoyée!";
} else {
    echo "Error: " . $new_friendship . "<br>" . mysqli_error($bdd_friend);
}
}
?>
<a href="ajouter_ami.php">Retour à la page pour ajouter un ami</a>