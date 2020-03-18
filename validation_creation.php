
<?php
$bdd_users = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_users)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}

$validationformulaire=1;

switch(isset($_POST['mail'], $_POST['password'], $_POST['nom'], $_POST['prenom'], $_POST['date'], $_POST['username'])){
    
    //si le formulaire n'est pas entièrement rempli
    case empty($_POST['mail']):
        echo "Vous devez renseigner votre adresse mail";
    break;
    case empty($_POST['mail']):
        echo "Vous devez renseigner votre mot de passe";
    break;
    case empty($_POST['mail']):
        echo "Vous devez renseigner votre nom";
    break;
    case empty($_POST['mail']):
        echo "Vous devez renseigner votre prénom";
    break;
    case empty($_POST['mail']):
        echo "Vous devez renseigner votre date de naissance";
    break;
    case empty($_POST['mail']):
        echo "Vous devez renseigner votre identifiant";
    break;

    //conditions sur l'identifiant
    case (!preg_match("#^[a-z0-9]+$#",$_POST['username'])):
        echo "L'identifiant doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
    break;
    case strlen($_POST['username'])>25:
        echo "L'identifiant est trop long, il dépasse 25 caractères.";
    break;
    case (mysqli_num_rows(mysqli_query($bdd_users,"SELECT * FROM Utilisateur WHERE Pseudo='".$_POST['username']."'"))==1):
        echo "Cet identifiant est déjà utilisé.";
    break;

    //conditions sur l'adresse mail
    case (mysqli_num_rows(mysqli_query($bdd_users,"SELECT * FROM Utilisateur WHERE mail='".$_POST['mail']."'"))==1):
        echo "Cette adresse mail est déjà utilisée.";
    break;

    default:
        $validationformulaire=0;
    break;
    }


if ($validationformulaire==0){
$new_user =  "INSERT INTO Utilisateur(mail, MdP, Nom, Prenom, Date, Pseudo ) VALUES('$_POST[mail]', '$_POST[password]', '$_POST[nom]','$_POST[prenom]', '$_POST[date]', '$_POST[username]')";

if (mysqli_query($bdd_users, $new_user)) {
    echo "Votre compte a bien été enregistré!";
} else {
    echo "Error: " . $new_user . "<br>" . mysqli_error($bdd_users);
}
}
?>
<a href="page_creation.php">Retour au formulaire d'inscription</a>