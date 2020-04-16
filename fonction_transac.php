<?php
function new_transaction($bdd_transac,$pseudo,$page,$mess,$montant) {
    $req = mysqli_query($bdd_transac, "SELECT * FROM Utilisateur WHERE Pseudo='".$pseudo."' OR Mail='".$pseudo."'");

    $user_cible = mysqli_fetch_row($req);
    $user_src = $_SESSION['ID'];

    $new_transac = "INSERT INTO Transactions(Msg_exp, User_src, User_cible, Montant) VALUES('".$mess."',". $user_src.",".$user_cible[0].",".$montant.")";
    if (mysqli_query($bdd_transac, $new_transac)) {
        header("Location: ".$page);
    } else {
        echo "Error: " . $new_transac . "<br>" . mysqli_error($bdd_transac);
    }

}
?>