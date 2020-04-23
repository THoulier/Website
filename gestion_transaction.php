<?php
  include("ressource/fonction/fonction.php");
  session_start();
  include("ressource/head.php");
?>


<body>


  <?php
    include("ressource/header.php");
  ?>


<div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Gestion des transactions</p></h1>
       <p class="lead my-3">Tu peux consulter tes transactions avec tes amis!</p>
       
     </div>
  </div>
    
    <div class="container marketing">

    <?php
      if (isset($_SESSION['mail'])) {
        echo '<div class="bg-light shadow p-5 mb-5 text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">
              <div class="titre"><h2>Transactions simples</h2></div>
              <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
              <p class="bouton"><a class="btn btn-secondary" href="transactions.php" role="button">Gérer mes transactions &raquo;</a></p>
              </div><!-- col -->
              <div class="bg-light shadow p-5 mb-5 text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">
              <div class="titre"><h2>Transactions groupées</h2></div>
              <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
              <p class="bouton"><a class="btn btn-secondary" href="transaction_grp.php" role="button">Gérer mes transactions &raquo;</a></p>
              </div><!-- col -->';
      }
        
      ?>
  </div>





</body>
<?php
  include("ressource/footer.php");
?>
</html>