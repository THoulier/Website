<?php
$bdd_transac = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_transac)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}



foreach ($_POST as $key => $val) {
    if ($key != "mess_clot") {
        if ($val == "regler") {
            $date = date("Y-m-d");
            $res = mysqli_query($bdd_transac, "UPDATE Transactions SET Statut=1 , Msg_fer='".$_POST['mess_clot']."', Date_fermeture='".$date."' WHERE ID='".$key."'");
        } else {
            $date = date("Y-m-d");
            $res = mysqli_query($bdd_transac, "UPDATE Transactions SET Statut=2 , Msg_fer='".$_POST['mess_clot']."', Date_fermeture='".$date."' WHERE ID='".$key."'");
        }
    }
}




/*
if ($_GET['action']=="annuler"){
    $res = mysqli_query($bdd_transac, "UPDATE Transactions SET Statut=2 WHERE ID='".$_GET['id']."'");;
    header("Location:".$_GET['page']);
}
if ($_GET['action']=="regler"){
    $date = date("Y-m-d");
    $res = mysqli_query($bdd_transac, "UPDATE Transactions SET Statut=1 , Msg_fer='".$_POST['mess_clot']."', Date_fermeture='".$date."' WHERE ID='".$_GET['id']."'");
    header("Location:".$_GET['page']);
}
*/


$value ="";
if (isset($_GET['action'])) {
    if ($_GET['action']=="modifymsg"){
    
        if (!empty($value)) {
            $value=$value."&modmsg=".$_GET['id'];
        } else {
            $value="modmsg=".$_GET['id'];
        }
    
    } 
    if ($_GET['action']=="modifymontant"){
        
        if (!empty($value)) {
            $value=$value."&modar=".$_GET['id'];
        } else {
            $value="modar=".$_GET['id'];
        }
    
    } 
    
}
if (!empty($value)) {
    if (strpos($_GET['page'],"?")) {
        header("Location: ".$_GET['page']."&".$value);
        exit();
    } else {
        header("Location: ".$_GET['page']."?".$value);
        exit();
    }
} else {
    header("Location:".$_GET['page']);
    exit();
}





?>