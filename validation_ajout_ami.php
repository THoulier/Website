<?php
session_start();



$bdd_friend = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_friend)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}


$error ="";

if (mysqli_num_rows(mysqli_query($bdd_friend,"SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['id_to']."' OR Mail='".$_POST['id_to']."'"))==0) {
    if (!empty($error)) {
        $error=$error."&id=4";
    } else {
        $error="id=4";
    }
} 
if (empty($_POST['id_to'])) {
    if (!empty($error)) {
        $error=$error."&id=1";
    } else {
        $error="id=1";
    }

} 
if ($_POST['id_to'] == $_SESSION['mail']) {
    if (!empty($error)) {
        $error=$error."&id=6";
    } else {
        $error="id=6";
    }

} 
$res0 = mysqli_query($bdd_friend, "SELECT Pseudo FROM Utilisateur WHERE Mail='".$_SESSION['mail']."'");
$row0 = mysqli_fetch_row ($res0); 
if ($_POST['id_to'] == $row0[0]) {
    if (!empty($error)) {
        $error=$error."&id=6";
    } else {
        $error="id=6";
    }

} 

$res = mysqli_query($bdd_friend, "SELECT ID FROM Utilisateur WHERE Mail='".$_SESSION['mail']."'");
$row = mysqli_fetch_row ($res); 
if (mysqli_num_rows(mysqli_query($bdd_friend,"SELECT Amis.id_to,Amis.id_from FROM Utilisateur INNER JOIN Amis ON Amis.id_to=Utilisateur.ID WHERE Utilisateur.Pseudo='".$_POST['id_to']."' AND Amis.id_from='".$row[0]."'"))==1) {
    if (!empty($error)) {
        $error=$error."&id=2";
    } else {
        $error="id=2";
    }
}
$ras = mysqli_query($bdd_friend, "SELECT ID FROM Utilisateur WHERE Mail='".$_SESSION['mail']."'");
$raw = mysqli_fetch_row ($res); 
if (mysqli_num_rows(mysqli_query($bdd_friend,"SELECT Amis.id_to,Amis.id_from FROM Utilisateur INNER JOIN Amis ON Amis.id_to=Utilisateur.ID WHERE Utilisateur.Mail='".$_POST['id_to']."' AND Amis.id_from='".$row[0]."'"))==1) {
    if (!empty($error)) {
        $error=$error."&id=2";
    } else {
        $error="id=2";
    }
}
$res2 = mysqli_query($bdd_friend, "SELECT ID FROM Utilisateur WHERE Mail='".$_SESSION['mail']."'");
$row2 = mysqli_fetch_row ($res2); 
if (mysqli_num_rows(mysqli_query($bdd_friend,"SELECT Amis.id_to,Amis.id_from FROM Utilisateur INNER JOIN Amis ON Amis.id_from=Utilisateur.ID WHERE Utilisateur.Pseudo='".$_POST['id_to']."' AND Amis.id_to='".$row2[0]."'"))==1) {
    if (!empty($error)) {
        $error=$error."&id=5";
    } else {
        $error="id=5";
    }
}
$ras2 = mysqli_query($bdd_friend, "SELECT ID FROM Utilisateur WHERE Mail='".$_SESSION['mail']."'");
$raw2 = mysqli_fetch_row ($ras2); 
if (mysqli_num_rows(mysqli_query($bdd_friend,"SELECT Amis.id_to,Amis.id_from FROM Utilisateur INNER JOIN Amis ON Amis.id_from=Utilisateur.ID WHERE Utilisateur.Mail='".$_POST['id_to']."' AND Amis.id_to='".$raw2[0]."'"))==1) {
    if (!empty($error)) {
        $error=$error."&id=5";
    } else {
        $error="id=5";
    }
}
if (!empty($error)) {
    header("Location: ajouter_ami.php?".$error);
    exit();
}




$res = mysqli_query($bdd_friend, "SELECT * FROM Utilisateur WHERE Mail='".$_SESSION['mail']."'");
$ras = mysqli_query($bdd_friend, "SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['id_to']."' OR Mail='".$_POST['id_to']."'");

$id_ask_friend = mysqli_fetch_row($res);
$id_new_friend = mysqli_fetch_row($ras);

$new_friendship = "INSERT INTO Amis(id_from,id_to,etat) VALUES($id_ask_friend[0],$id_new_friend[0],0)";


if (mysqli_query($bdd_friend, $new_friendship)) {
    echo "Votre demande d'ami a bien été envoyée!";
    header("Location: ajouter_ami.php?&id=3");
} else {
    echo "Error: " . $new_friendship . "<br>" . mysqli_error($bdd_friend);
}

?>
<a href="ajouter_ami.php">Retour à la page pour ajouter un ami</a>