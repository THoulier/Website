
<?php
$bdd_users = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_users)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}



$new_user =  "INSERT INTO Utilisateur(mail, MdP, Nom, Prenom, Date, Pseudo ) VALUES('$_POST[mail]', '$_POST[password]', '$_POST[nom]','$_POST[prenom]', '$_POST[date]', '$_POST[username]')";

if (mysqli_query($bdd_users, $new_user)) {
    echo "Votre compte a bien été enregistré!";
} else {
    echo "Error: " . $new_user . "<br>" . mysqli_error($bdd_users);
}

?>
<a href="page_creation.php">Retour au formulaire d'inscription</a>