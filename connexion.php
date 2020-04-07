<?php
  include("ressource/head.php");
?>

<body>
  <?php
    include("ressource/header.php");
  ?>

  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Connectez-vous !</p></h1>
       <p class="lead my-3">Retrouvez vos amis sur notre application !</p>     
       </div>
  </div>

<div class="container" id="main">
<div class="row">
<form action="check_login.php" method="post">

  <div class="form-group">
        <label for="InputEmail1">Adresse email</label>
        <input type="email" name="InputEmail" class="form-control" id="InputEmail" aria-describedby="emailHelp">
        <?php
            if (isset($_GET["mess"]) && $_GET["mess"]==1) {
                  echo '<div class="alert alert-danger" role="alert">';
                        echo "Mail incorrecte !";
                  echo "</div>";
            }
      ?>

  </div>
  <div class="form-group">
        <label for="InputPassword">Mot de passe</label>
        <input type="password" name="InputPassword" class="form-control" id="InputPassword">
        <?php
            if (isset($_GET["mess"]) && $_GET["mess"]==2) {
                  echo '<div class="alert alert-danger" role="alert">';
                        echo "Mot de passe incorrecte !";
                  echo "</div>";
            }
      ?>
  </div>

  <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="Check">
        <label class="form-check-label" for="Check">Se souvenir de moi</label>
  </div>
        <button type="submit" class="btn btn-primary">Connexion</button>
  </form>

</div>
</div>
</body>
<?php
  include("ressource/footer.php");
?>

</html>
