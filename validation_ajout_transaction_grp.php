
<?php
include("fonction_error.php");
session_start();
$bdd_transac = con();
if (mysqli_connect_errno($bdd_transac)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$error = check_arg_transac_grp($_POST['msg_ex'],$_POST['pseudo1'],$_POST['montant1'],1);

for($i=2;$i<=$_GET['nb'];$i++){
    if (!empty(check_arg_transac_grp_bis($_POST["pseudo$i"],$_POST["montant$i"],$i))){
    $error .= '&'.check_arg_transac_grp_bis($_POST["pseudo$i"],$_POST["montant$i"],$i);
    }
}


if (empty($_GET['montant_total'])) {
    if (!empty($error)) {
        $error=$error."&montant_total=1";
    }else {
        $error="montant_total=1";
    }
}   elseif ($_GET['montant_total'] < 0) {
    if (!empty($error)) {
        $error=$error."&montant_total=2";
    }  else {
        $error="montant_total=2";
    }
}

if (!empty($error)) {
    //echo $error;
    header("Location: transaction_grp.php?choix=".$_GET['choix']."&nb=".$_GET['nb']."&".$error);
    exit();
}

for($i=1;$i<=$_GET['nb'];$i++){
    new_transaction($bdd_transac,$_POST["pseudo$i"],"transaction_grp.php",$_POST['msg_ex'],$_POST["montant$i"]);

}

?>