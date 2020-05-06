
<?php
include("ressource/fonction/fonction_error.php");
session_start();


$error = check_arg_transac($_POST['msg_ex'],$_POST['pseudo'],$_POST['montant']);

if (!empty($error)) {
    header("Location: transactions.php?".$error);
    exit();
}

$pseudo = $_POST['pseudo'];
$page = "transactions.php";
$msg_ex = $_POST['msg_ex'];
$montant = $_POST['montant'];
$mode = $_POST['mode'];


new_transaction(compact("pseudo","page","msg_ex","montant","mode"));
?>
