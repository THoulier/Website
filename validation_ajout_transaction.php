
<?php
include("fonction_error.php");
session_start();
$bdd_transac = con();
if (mysqli_connect_errno($bdd_transac)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$error = check_arg_transac($_POST['msg_ex'],$_POST['pseudo'],$_POST['montant']);

if (!empty($error)) {
    header("Location: transactions.php?".$error);
    exit();
}


new_transaction($bdd_transac,$_POST['pseudo'],"transactions.php",$_POST['msg_ex'],$_POST['montant']);
?>
