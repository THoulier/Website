
<?php
$bdd_users = mysqli_connect("localhost", "root", "","test");
if (mysqli_connect_errno($bdd_users)) {
    echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
}



$new_user =  "INSERT INTO Utilisateurs(username, password, email) VALUES('$_POST[username]', '$_POST[password]','$_POST[mail]')";

if (mysqli_query($bdd_users, $new_user)) {
    echo "Votre compte a bien été enregistré!";
} else {
    echo "Error: " . $new_user . "<br>" . mysqli_error($bdd_users);
}

?>
<a href="page_creation.php">Retour au formulaire d'inscription</a>