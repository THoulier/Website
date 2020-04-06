<?php
  include("fonction.php");
  session_start();
  include("ressource/head.php");
?>


<body>


  <?php
    include("ressource/header.php");
  ?>


  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Bienvenue !</p></h1>
       <p class="lead my-3">Je tiens à remercier toutes les personnes qui ont contribué à la création de ce site. Sans vos efforts, mon site n'aurait pas vu le jour. blablabla.</p>
       <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">En savoir plus...</a></p>
     </div>
   </div>
    
    <div class="container marketing">

    <?php
      if (isset($_SESSION['mail'])) {
        echo '<div class="bg-light shadow p-5 mb-5 text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">
              <div class="titre"><h2>Gestion des amis</h2></div>
              <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
              <p class="bouton"><a class="btn btn-secondary" href="ajouter_ami.php" role="button">Gérer mes amis &raquo;</a></p>
              </div><!-- col -->
              <div class="bg-light shadow p-5 mb-5 text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">
              <div class="titre"><h2>Gestion des transactions</h2></div>
              <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
              <p class="bouton"><a class="btn btn-secondary" href="transactions.php" role="button">Gérer mes transactions &raquo;</a></p>
              </div><!-- col -->';
      }
      else{
      echo '<div class="row ">
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

            </div><!-- row -->';

      }
        
      ?>
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
