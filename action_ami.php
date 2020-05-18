<?php
$bdd_friend = mysqli_connect("localhost", "root", "","LGBT");
if (mysqli_connect_errno($bdd_friend)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}


if ($_GET['action']=="delete"){
    $res = mysqli_query($bdd_friend, "DELETE FROM Amis WHERE ID='".$_GET['id']."'");
    header("Location:ajouter_ami.php");
}
if ($_GET['action']=="add"){
    $res = mysqli_query($bdd_friend, "UPDATE Amis SET etat=1 WHERE ID='".$_GET['id']."'");
    header("Location:ajouter_ami.php");
}


?>
