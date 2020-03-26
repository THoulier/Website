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


 
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">
    <a class="navbar-brand" href="index.php">Application LGBT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav mr-auto">

        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Page 1</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="#">Page 2</a>
        </li>

      </ul>
      <div class="nav-item">
        <a class="nav-link text-body" href="#">Nous contacter</a>
      </div>
    </div>

  </nav>

  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Inscrivez-vous !</p></h1>
       <p class="lead my-3">Cela ne prend que quelques secondes !</p>
     </div>
  </div>

    <div class="container ">

        <div class="col-sm ">
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
                  if ($_GET["mail"]==1) {
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
  <footer class="text-muted">
  <div class="container pt-5">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>Ceci est un test. Nous allons penser plus tard au texte à mettre ici. blablabla. Gabriel Berger, Thomas Houllier, Leïla Bouidra.</p>
  </div>
</footer>
</html>