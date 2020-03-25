
<?php
$bdd_users = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_users)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}
$error ="";

if (empty($_POST['mail'])) {
    if (!empty($error)) {
        $error=$error."&mail=1";
    } else {
        $error="mail=1";
    }

} elseif (mysqli_num_rows(mysqli_query($bdd_users,"SELECT * FROM Utilisateur WHERE mail='".$_POST['mail']."'"))==1) {
    if (!empty($error)) {
        $error=$error."&mail=2";
    } else {
        $error="mail=2";
    }
}
if (empty($_POST['password'])) {
    if (!empty($error)) {
        $error=$error."&pass=1";
    } else {
        $error="pass=1";
    }
}
if (empty($_POST['nom'])) {
    if (!empty($error)) {
        $error=$error."&nom=1";
    } else {
        $error="nom=1";
    }
}
if (empty($_POST['prenom'])) {
    if (!empty($error)) {
        $error=$error."&prenom=1";
    } else {
        $error="prenom=1";
    }
}
if (empty($_POST['date'])) {
    if (!empty($error)) {
        $error=$error."&date=1";
    } else {
        $error="date=1";
    }}
if (empty($_POST['username'])) {
    if (!empty($error)) {
        $error=$error."&id=1";
    } else {
        $error="id=1";
    }
} elseif (!preg_match("#^[a-z0-9]+$#",$_POST['username'])) {
    if (!empty($error)) {
        $error=$error."&mail=1";
    } else {
        $error="mail=1";
    }
} elseif (strlen($_POST['username'])>25) {
    if (!empty($error)) {
        $error=$error."&id=1";
    } else {
        $error="id=1";
    } 
} elseif (mysqli_num_rows(mysqli_query($bdd_users,"SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['username']."'"))==1) {
    if (!empty($error)) {
        $error=$error."&id=1";
    } else {
        $error="id=1";
    }
}


if (!empty($error)) {
    header("Location: http://localhost/page_creation.php?".$error);
    exit();
}




$new_user =  "INSERT INTO Utilisateur(mail, MdP, Nom, Prenom, Date, Pseudo ) VALUES('$_POST[mail]', '$_POST[password]', '$_POST[nom]','$_POST[prenom]', '$_POST[date]', '$_POST[username]')";
if (mysqli_query($bdd_users, $new_user)) {
    echo "Votre compte a bien été enregistré!";
    header("Location: index.html");
} else {
    echo "Error: " . $new_user . "<br>" . mysqli_error($bdd_users);
}
?>
<a href="page_creation.php">Retour au formulaire d'inscription</a>
