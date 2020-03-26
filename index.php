<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Accueil</title>

  <style>
    /*.titre{
    }
    .bouton{
    }*/

    #welcome{
      text-shadow: 2px 2px 4px black;
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
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Page 1</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">Page 2</a>
      </li>

    </ul>
    <?php
    session_start();
    if (isset($_SESSION['mail'])) {
      echo '<div class="nav-item">';
        echo '<a class="nav-link text-body" href="deconnexion.php">Deconnexion</a>';
      echo '</div>';
      echo '<div class="nav-item">';
        echo $_SESSION['mail'];
      echo '</div>';
    }
    ?>
    <div class="nav-item">
      <a class="nav-link text-body" href="#">Nous contacter</a>
    </div>

  </nav>


  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Bienvenue !</p></h1>
       <p class="lead my-3">Je tiens à remercier toutes les personnes qui ont contribué à la création de ce site. Sans vos efforts, mon site n'aurait pas vu le jour. blablabla.</p>
       <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">En savoir plus...</a></p>
     </div>
   </div>
    
    <div class="container marketing">


        <div class="row ">
          <div class="bg-dark shadow p-5 mb-5 text-white text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">

            <div class="titre"><h2>Déjà inscrit ?</h2></div>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p class="bouton"><a class="btn btn-secondary" href="connexion.php" role="button">Connexion &raquo;</a></p>
          </div><!-- col -->
          <div class="bg-light shadow p-5 mb-5 text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">

            <div class="titre"><h2>Crée ton compte !</h2></div>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p class="bouton"><a class="btn btn-secondary" href="page_creation.php" role="button">Inscription &raquo;</a></p>
          </div><!-- col -->

        </div><!-- row -->


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
