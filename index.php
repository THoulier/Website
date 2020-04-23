<?php
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
        include("ressource/body_connecter.php");
      }
      else{
        include("ressource/body_non_connecter.php");

      }
    ?>
  </div>





</body>
<?php
  include("ressource/footer.php");
?>
</html>
