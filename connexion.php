<!DOCTYPE html>

<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Connexion</title>

  <style>
  #main{
    margin-left: 40%;
    margin-top: 100px;
  }


  </style>

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
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
<footer class="text-muted">
  <div class="container pt-5">
    <p class="float-right">
      <a href="#">Back to top</a>
    </p>
    <p>Ceci est un test. Nous allons penser plus tard au texte à mettre ici. blablabla. Gabriel Berger, Thomas Houllier, Leïla Bouidra.</p>
  </div>
</footer>

</html>
