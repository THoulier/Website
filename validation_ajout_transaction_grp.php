
<?php
include("fonction_transac.php");
session_start();
$bdd_transac = con();
if (mysqli_connect_errno($bdd_transac)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$error = check_arg_transac($_POST['msg_ex'],$_POST['pseudo'],$_POST['montant']);
if (!empty($error)) {
    if($_GET['choix']=="Manuellement"){
    header("Location: transaction_grp.php?choix=".$_GET['choix']."&nb=".$_GET['nb']."&".$error);
    exit();
    }
}


new_transaction($bdd_transac,$_POST['pseudo'],"transaction_grp.php",$_POST['msg_ex'],$_POST['montant']);

?>