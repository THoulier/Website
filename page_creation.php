<!DOCTYPE html>
<html>

    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link href="accueil.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <title>Créer un compte</title>
    </head>

	<body>


 
    
    <div class="jumbotron jumbotron-fluid" style="background-color:#FF8800">
      <div class="container">
        <h1 class="display-4">Création d'un compte.</h1>
      </div>
    </div>
    <div class="container">

        <div class="col-sm">
          <div class="card" style="width: 18rem;">
            <div class="card-body">
            <form action="validation_creation.php" method="post">

                Identifiant: <input type="text" name="username" class="p-2"/>
                <?php
                if (isset($_GET["id"])){ 
                  if ($_GET["id"]==1) {
                    echo '<div class="alert alert-danger" role="alert">';
                          echo "Vous devez renseigner votre identifiant !";
                    echo "</div>";
                  } elseif ($_GET["id"]==2) {
                    echo '<div class="alert alert-danger" role="alert">';
                          echo "L'identifiant doit être renseigné en lettres minuscules sans accents, sans caractères spéciaux.";
                    echo "</div>";
                  } elseif ($_GET["id"]==3) {
                    echo '<div class="alert alert-danger" role="alert">';
                          echo "L'identifiant est trop long, il dépasse 25 caractères.";
                    echo "</div>";
                  } elseif ($_GET["id"]==4) {
                    echo '<div class="alert alert-danger" role="alert">';
                          echo "Cet identifiant est déjà utilisé.";
                    echo "</div>";
                  }
                }
                ?>
                Nom: <input type="text" name="nom" class="p-2"/> 
                <?php
                if (isset($_GET["nom"])) {
                  echo '<div class="alert alert-danger" role="alert">';
                        echo "Vous devez renseigner votre nom.";
                  echo "</div>";
                }
                ?>
                Prénom: <input type="text" name="prenom" class="p-2"/> 
                <?php
                if (isset($_GET["prenom"])) {
                  echo '<div class="alert alert-danger" role="alert">';
                        echo "Vous devez renseigner votre prénom.";
                  echo "</div>";
                }
                ?>
                Date de naissance: <input type="date" name="date" class="p-2"/> </br>
                <?php
                if (isset($_GET["date"])) {
                  echo '<div class="alert alert-danger" role="alert">';
                        echo "Vous devez renseigner votre date de naissance.";
                  echo "</div>";
                }
                ?>
                Mot de passe: <input type="password" name="password" class="p-2"/> 
                <?php
                if (isset($_GET["pass"])) {
                  echo '<div class="alert alert-danger" role="alert">';
                        echo "Vous devez renseigner votre mot de passe.";
                  echo "</div>";
                }
                ?>
                E-mail: <input type="email" name="mail" class="p-2"/> 
                <?php
                if (isset($_GET["mail"])) {
                  if ($_GET["mail"]=1) {
                    echo '<div class="alert alert-danger" role="alert">';
                          echo "Vous devez renseigner votre adresse mail.";
                    echo "</div>";
                  } elseif ($_GET["mail"]==2) {
                    echo '<div class="alert alert-danger" role="alert">';
                          echo "Cette adresse mail est déjà utilisée.";
                    echo "</div>";
                  }
                }
                ?>

                <input type="submit" value="Envoyer le formulaire"/>
            </form>
            </div>
          </div>
        </div>
    </div>

    

	</body>
</html>