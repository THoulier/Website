
<?php
include("fonction_transac.php");
session_start();

$bdd_transac = con();
if (mysqli_connect_errno($bdd_transac)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}
$error ="";

if (empty($_POST['msg_ex'])) {
    if (!empty($error)) {
        $error=$error."&msg_ex=1";
    } else {
        $error="msg_ex=1";
    }

} 
if (empty($_POST['pseudo'])) {
    if (!empty($error)) {
        $error=$error."&pseudo=1";
    } else {
        $error="pseudo=1";
    }

} 
elseif (mysqli_num_rows(mysqli_query($bdd_transac,"SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['pseudo']."' OR Mail='".$_POST['pseudo']."'"))==0) {
    if (!empty($error)) {
        $error=$error."&pseudo=2";
    } else {
        $error="pseudo=2";
    }
} 
elseif ($_POST['pseudo'] == $_SESSION['mail']) {
    if (!empty($error)) {
        $error=$error."&pseudo=3";
    } else {
        $error="pseudo=3";
    }

} 
if ($_POST['pseudo'] == $_SESSION['Pseudo']) {
    if (!empty($error)) {
        $error=$error."&pseudo=3";
    } else {
        $error="pseudo=3";
    }

} 
if (empty($_POST['montant'])) {
    if (!empty($error)) {
        $error=$error."&montant=1";
    } else {
        $error="montant=1";
    }
} elseif ($_POST['montant'] < 0) {
    if (!empty($error)) {
        $error=$error."&montant=2";
    } else {
        $error="montant=2";
    }
}

if (!empty($error)) {
    header("Location: transactions.php?".$error);
    exit();
}


new_transaction($bdd_transac,$_POST['pseudo'],"transactions.php",$_POST['msg_ex'],$_POST['montant']);
?>
