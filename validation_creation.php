
<?php
include("functions.php");
$bdd_users = con();
if (mysqli_connect_errno($bdd_users)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$validationformulaire=1;

if (empty($_POST['mail'])) {
    echo "Vous devez renseigner votre adresse mail";
    echo "</br>";
    $validationformulaire=0;

} elseif (mysqli_num_rows(mysqli_query($bdd_users,"SELECT * FROM Utilisateur WHERE mail='".$_POST['mail']."'"))==1) {
    echo "Cette adresse mail est déjà utilisée.";
    echo "</br>";
    $validationformulaire=0;
}
if (empty($_POST['password'])) {
    echo "Vous devez renseigner votre mot de passe";
    echo "</br>";
    $validationformulaire=0;
}
if (empty($_POST['nom'])) {
    echo "Vous devez renseigner votre nom";
    echo "</br>";
    $validationformulaire=0;
}
if (empty($_POST['prenom'])) {
    echo "Vous devez renseigner votre prénom";
    echo "</br>";
    $validationformulaire=0;
}
if (empty($_POST['date'])) {
    echo "Vous devez renseigner votre date de naissance";
    echo "</br>";
    $validationformulaire=0;
}
if (empty($_POST['username'])) {
    echo "Vous devez renseigner votre identifiant";
    echo "</br>";
    $validationformulaire=0;
} elseif (!preg_match("#^[a-z0-9]+$#",$_POST['username'])) {
    echo "L'identifiant doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
    echo "</br>";
    $validationformulaire=0;
} elseif (strlen($_POST['username'])>25) {
    echo "L'identifiant est trop long, il dépasse 25 caractères.";
    echo "</br>";
    $validationformulaire=0;
} elseif (mysqli_num_rows(mysqli_query($bdd_users,"SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['username']."'"))==1) {
    echo "Cet identifiant est déjà utilisé.";
    echo "</br>";
    $validationformulaire=0;
}



if ($validationformulaire){
    $new_user =  "INSERT INTO Utilisateur(mail, MdP, Nom, Prenom, Date, Pseudo ) VALUES('$_POST[mail]', '$_POST[password]', '$_POST[nom]','$_POST[prenom]', '$_POST[date]', '$_POST[username]')";

    if (mysqli_query($bdd_users, $new_user)) {
        echo "Votre compte a bien été enregistré!";
        header("Location: index.html");
    } else {
        echo "Error: " . $new_user . "<br>" . mysqli_error($bdd_users);
    }
}
?>
<a href="page_creation.php">Retour au formulaire d'inscription</a>