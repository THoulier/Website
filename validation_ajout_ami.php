<?php
session_start();



$bdd_friend = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_friend)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}


$error ="";

if (empty($_POST['id_to'])) {
    if (!empty($error)) {
        $error=$error."&id=1";
    } else {
        $error="id=1";
    }

} elseif (mysqli_num_rows(mysqli_query($bdd_friend,"SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['id_to']."'"))==0) {
    if (!empty($error)) {
        $error=$error."&id=4";
    } else {
        $error="id=4";
    }
}


if (!empty($error)) {
    header("Location: ajouter_ami.php?".$error);
    exit();
}




$res = mysqli_query($bdd_friend, "SELECT * FROM Utilisateur WHERE Mail='".$_SESSION['mail']."'");
$ras = mysqli_query($bdd_friend, "SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['id_to']."'");

$id_ask_friend = mysqli_fetch_row($res);
$id_new_friend = mysqli_fetch_row($ras);

$new_friendship = "INSERT INTO Amis(id_from,id_to,etat) VALUES($id_ask_friend[0],$id_new_friend[0],0)";


if (mysqli_query($bdd_friend, $new_friendship)) {
    echo "Votre demande d'ami a bien été envoyée!";
    header("Location: ajouter_ami.php");
} else {
    echo "Error: " . $new_friendship . "<br>" . mysqli_error($bdd_friend);
}

?>
<a href="ajouter_ami.php">Retour à la page pour ajouter un ami</a>