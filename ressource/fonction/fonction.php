<?php

function con() {
    return mysqli_connect("localhost", "root", "","LGBT");
}


function ses() {
    if (isset($_SESSION)) {
        if ( time() - $_SESSION['time'] > 3600 ) {
            session_destroy();
            header("Location: index.php");
        }
    }
}

function get_solde($ID_src,$ID_dst) {
    $bdd=con();
    if (mysqli_connect_errno($bdd)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
    $res1 = mysqli_query($bdd, "SELECT SUM(Montant) FROM `Transactions` WHERE User_src=".$ID_src." AND User_cible=".$ID_dst." AND Statut = 0");
    $row1 = mysqli_fetch_row($res1);
    $res2 = mysqli_query($bdd, "SELECT SUM(Montant) FROM `Transactions` WHERE User_src=".$ID_dst." AND User_cible=".$ID_src." AND Statut = 0");
    $row2 = mysqli_fetch_row($res2);
    if (!empty($row1) && !empty($row2)) {
        return round(($row2[0]-$row1[0]),2);
    } elseif (!empty($row1) && empty($row2)) {
        return round((-$row1[0]),2);
    } elseif (!empty($row2) && empty($row1)) {
        return round($row2[0],2);
    } else {
        return 0;
    }
    
}

function color_transaction($nb) {
    if ($nb<0) {
        echo '<td style="color: red">'.$nb.'€</td>';
    } else {
        echo '<td style="color: green">'.$nb.'€</td>';
    }
}

function get_friend($donnees) {
    $bdd_friend=con();
    if ($donnees[0] != $_SESSION['ID']) {
        $ras = mysqli_query($bdd_friend, "SELECT Pseudo FROM Utilisateur WHERE ID=".$donnees[0]);
    } else {
        $ras = mysqli_query($bdd_friend, "SELECT Pseudo FROM Utilisateur WHERE ID=".$donnees[1]);
    }
    $row = mysqli_fetch_row($ras);
    return $row[0];
}




?>