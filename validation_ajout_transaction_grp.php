
<?php
include("ressource/fonction/fonction_error.php");
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

for($i=1;$i<=$_GET['nb'];$i++){
    for ($j=1;$j<=$_GET['nb'];$j++){
        if ($i != $j){
            if (!empty($_POST["pseudo$i"]) && !empty($_POST["pseudo$j"])){
                if ($_POST["pseudo$i"] == $_POST["pseudo$j"]){
                    if (!empty($error)) {
                        $error=$error."&pseudo".$i."=4";
                    } else {
                        $error="pseudo".$i."=4";
                    }
                }
            }
        } 
    }
}

$error = check_arg_montant_tot_grp($_POST['montant_total'],$error);


if (!empty($error)) {
    //echo $error;
    header("Location: transaction_grp.php?choix=".$_GET['choix']."&nb=".$_GET['nb']."&".$error);
    exit();
}

$pseudo = $_POST["pseudo$i"];
$page = "transaction_grp.php";
$msg_ex = $_POST['msg_ex'];
$montant = $_POST["montant$i"];
$mode = "moi";

for($i=1;$i<=$_GET['nb'];$i++){
    $pseudo = $_POST["pseudo$i"];
    $page = "transaction_grp.php";
    $msg_ex = $_POST['msg_ex'];
    $montant = $_POST["montant$i"];
    $mode = "moi";
    new_transaction(compact("pseudo","page","msg_ex","montant","mode"));

}

?>