<?php
include("fonction.php");

function check_msg($msg_ex,$error) {
    if (empty($msg_ex)) {
        if (!empty($error)) {
            $error=$error."&msg_ex=1";
        } else {
            $error="msg_ex=1";
        }

    } 
    return $error;
}

function check_pseudo($pseudo,$error) {
    $bdd_transac = con();
    if (mysqli_connect_errno($bdd_transac)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
    
    if (empty($pseudo)) {
        if (!empty($error)) {
            $error=$error."&pseudo=1";
        } else {
            $error="pseudo=1";
        }

    } 
    elseif (mysqli_num_rows(mysqli_query($bdd_transac,"SELECT * FROM Utilisateur WHERE Pseudo='".$pseudo."' OR Mail='".$pseudo."'"))==0) {
        if (!empty($error)) {
            $error=$error."&pseudo=2";
        } else {
            $error="pseudo=2";
        }
    } 
    elseif ($pseudo == $_SESSION['mail']) {
        if (!empty($error)) {
            $error=$error."&pseudo=3";
        } else {
            $error="pseudo=3";
        }

    } 
    if ($pseudo == $_SESSION['Pseudo']) {
        if (!empty($error)) {
            $error=$error."&pseudo=3";
        } else {
            $error="pseudo=3";
        }

    }
    return $error; 
}

function check_arg_transac($msg_ex,$pseudo,$montant) {
    

    $error ="";

    $error=check_msg($msg_ex,$error);

    $error=check_pseudo($pseudo,$error);

    
    if (empty($montant)) {
        if (!empty($error)) {
            $error=$error."&montant=1";
        } else {
            $error="montant=1";
        }
    } elseif ($montant < 0) {
        if (!empty($error)) {
            $error=$error."&montant=2";
        } else {
            $error="montant=2";
        }
    }
    return $error;
}

function check_pseudo_grp($pseudo,$error,$var) {
    $bdd_transac = con();
    if (mysqli_connect_errno($bdd_transac)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
    
    if (empty($pseudo)) {
        if (!empty($error)) {
            $error=$error."&pseudo".$var."=1";
        } else {
            $error="pseudo".$var."=1";
        }

    } 
    elseif (mysqli_num_rows(mysqli_query($bdd_transac,"SELECT * FROM Utilisateur WHERE Pseudo='".$pseudo."' OR Mail='".$pseudo."'"))==0) {
        if (!empty($error)) {
            $error=$error."&pseudo".$var."=2";
        } else {
            $error="pseudo".$var."=2";
        }
    } 
    elseif ($pseudo == $_SESSION['mail']) {
        if (!empty($error)) {
            $error=$error."&pseudo".$var."=3";
        } else {
            $error="pseudo".$var."=3";
        }

    } 
    if ($pseudo == $_SESSION['Pseudo']) {
        if (!empty($error)) {
            $error=$error."&pseudo".$var."=3";
        } else {
            $error="pseudo".$var."=3";
        }

    }
    return $error; 
}

function check_arg_transac_grp($msg_ex,$pseudo,$montant,$var) {
    

    $error ="";

    $error=check_msg($msg_ex,$error);

    $error=check_pseudo_grp($pseudo,$error,$var);

    
    if (empty($montant)) {
        if (!empty($error)) {
            $error=$error."&montant".$var."=1";
        } else {
            $error="montant".$var."=1";
        }
    } elseif ($montant < 0) {
        if (!empty($error)) {
            $error=$error."&montant".$var."=2";
        } else {
            $error="montant".$var."=2";
        }
    }
    return $error;
}
function check_arg_transac_grp_bis($pseudo,$montant,$var) {
    

    $error ="";

    $error=check_pseudo_grp($pseudo,$error,$var);

    
    if (empty($montant)) {
        if (!empty($error)) {
            $error=$error."&montant".$var."=1";
        }else {
            $error="montant".$var."=1";
        }
    } elseif ($montant < 0) {
        if (!empty($error)) {
            $error=$error."&montant".$var."=2";
        }  else {
            $error="montant".$var."=2";
        }
    }
    return $error;
}

function error_pseudo_grp($var){
    if (isset($_GET["pseudo$var"])) {
        if ($_GET["pseudo$var"]==1) {
            echo '<div class="alert alert-danger" role="alert">';
                echo "Vous devez renseigner un pseudo ou une adresse mail d'un ami!";
            echo "</div>";
        }
        if ($_GET["pseudo$var"]==2) {
            echo '<div class="alert alert-danger" role="alert">';
                echo "Cet utilisateur n'existe pas";
            echo "</div>";
        }
        if ($_GET["pseudo$var"]==3) {
            echo '<div class="alert alert-danger" role="alert">';
                echo "Vous ne pouvez pas enregistrer une transaction à vous même!";
            echo "</div>";
        }
    }
}

?>