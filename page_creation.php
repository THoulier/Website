<?php
  include("ressource/head.php");
?>

	<body>


 
  <?php
    include("ressource/header.php");
  ?>

  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Inscrivez-vous !</p></h1>
       <p class="lead my-3">Cela ne prend que quelques secondes !</p>
     </div>
  </div>

  <div class="container">
    <form action="validation_creation.php" method="post">
      <div class="row">
        <div class="col-sm ">
          Identifiant: 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="username" class="p-2"/>
        </div>
        <div class="col-sm-8">
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
        </div>
      </div>
      <div class="row">
        <div class="col-sm ">
          Nom:  
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="nom" class="p-2"/>
        </div>
        <div class="col-sm-8">
        <?php
          if (isset($_GET["nom"])) {
            echo '<div class="alert alert-danger" role="alert">';
              echo "Vous devez renseigner votre nom.";
            echo "</div>";
          }
        ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm ">
          Prénom:  
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="prenom" class="p-2"/>
        </div>
        <div class="col-sm-8">
          <?php
            if (isset($_GET["prenom"])) {
              echo '<div class="alert alert-danger" role="alert">';
                echo "Vous devez renseigner votre prénom.";
              echo "</div>";
            }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm ">
          Date de naissance: 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="date" name="date" class="p-2"/> </br>
        </div>
        <div class="col-sm-8">
          <?php
            if (isset($_GET["date"])) {
              echo '<div class="alert alert-danger" role="alert">';
                echo "Vous devez renseigner votre date de naissance.";
              echo "</div>";
            }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm ">
          Mot de passe: 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="password" name="password" class="p-2"/>
        </div>
        <div class="col-sm-8">
          <?php
            if (isset($_GET["pass"])) {
              echo '<div class="alert alert-danger" role="alert">';
                echo "Vous devez renseigner votre mot de passe.";
              echo "</div>";
            }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm ">
          E-mail: 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="email" name="mail" class="p-2"/>
        </div>
        <div class="col-sm-8">
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
        </div>
      </div>
      <div class ="row">
      <div class="col-sm ">
        <button type="submit" class="btn btn-primary">Inscrivez-vous !</button>
      </div>
      </div>
    </form>
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