
<?php
include("ressource/fonction/fonction_error.php");
session_start();


$error = check_arg_transac($_POST['msg_ex'],$_POST['pseudo'],$_POST['montant']);

if (!empty($error)) {
    header("Location: transactions.php?".$error);
    exit();
}


new_transaction($_POST['pseudo'],"transactions.php",$_POST['msg_ex'],$_POST['montant'],$_POST['mode']);
?>
