
<?php
include("fonction_transac.php");
session_start();
$bdd_transac = con();
if (mysqli_connect_errno($bdd_transac)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$error = check_arg_transac($_POST['msg_ex'],$_POST['peusdo'],$_POST['montant']);
if (!empty($error)) {
    if($_POST['choix']=="Manuellement"){
    header("Location: transaction_grp.php?manuel&".$error);
    exit();
    }
    if($_POST['choix']=="Parts"){
    header("Location: transaction_grp.php?partsegales&".$error);
    exit();
    }
}


new_transaction($bdd_transac,$_GET['pseudo'],"transaction_grp.php",$_GET['msg_ex'],$_GET['montant']);

?>