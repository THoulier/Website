<?php
$bdd_transac = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_transac)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}


if ($_GET['action']=="annuler"){
    $res = mysqli_query($bdd_transac, "UPDATE Transactions SET Statut=2 WHERE ID='".$_GET['id']."'");
    header("Location:transactions.php");
}
if ($_GET['action']=="regler"){
    $res = mysqli_query($bdd_transac, "UPDATE Transactions SET Statut=1 WHERE ID='".$_GET['id']."'");
    header("Location:transactions.php");
}

?>