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

</html>
