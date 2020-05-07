
<?php
$error ="";
if (empty($_POST['choix'])) {
    if (!empty($error)) {
        $error=$error."&case=1";
    } else {
        $error="case=1";
    }

} 
if (empty($_POST['nb'])) {
    if (!empty($error)) {
        $error=$error."&nbr=1";
    } else {
        $error="nbr=1";
    }

} 
if ($_POST['nb'] <0) {
    if (!empty($error)) {
        $error=$error."&nbr=2";
    } else {
        $error="nbr=2";
    }

} 
if (!empty($error)) {
    header("Location: transaction_grp.php?".$error);
    exit();
}
else{
    header("Location: transaction_grp.php?choix=".$_POST['choix']."&nb=".$_POST['nb']."");
    exit();
}
?>