<?php
  include("fonction_transac.php");
    session_start();
    include("ressource/head.php");
?>

<body>


  <?php
    include("ressource/header.php");
  ?>


  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Gestion des transactions simples</p></h1>
       <p class="lead my-3">Tu peux consulter tes transactions avec tes amis!</p>
       
     </div>
  </div>


  <div class="container" id="main">
    <div class="row">
      <h2>Ajoute une transaction</h2>
    </div>
    <form action="validation_ajout_transaction.php" method="post">
      <div class="row">
        <div class="col-sm ">
          Message explicatif: 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="msg_ex" class="p-2"/>
        </div>
        <div class="col-sm-8">
          <?php
            if (isset($_GET["msg_ex"])){ 
              if ($_GET["msg_ex"]==1) {
                echo '<div class="alert alert-danger" role="alert">';
                    echo "Vous devez renseigner un message explicatif !";
                echo "</div>";
              }
            }
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm ">
          Pseudo ou adresse mail de ton ami:  
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="pseudo" class="p-2"/>
        </div>
        <div class="col-sm-8">
          <?php
            error_pseudo();
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm ">
          Montant:  
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="number" name="montant" class="p-2"/>
        </div>
        <div class="col-sm-8">
          <?php
            if (isset($_GET["montant"])) {
              if ($_GET["montant"]==1) {
                echo '<div class="alert alert-danger" role="alert">';
                  echo "Vous devez renseigner un montant!";
                echo "</div>";
              }
              if ($_GET["montant"]==2) {
                echo '<div class="alert alert-danger" role="alert">';
                  echo "Le montant doit être supérieure a 0!";
                echo "</div>";
              }

            }
          ?>
        </div>
      </div>
      </br>
      <div class ="row">
        <div class="col-sm ">
          <button type="submit" class="btn btn-primary">Ajouter une transaction</button>
        </div>
      </div>
    </form>
    </br>
  </div>

  <div class="container marketing">
    <div class="titre"><h2>Historique de tes transactions</h2></div>
      <?php
        display_transac("transactions.php")
      ?>

  </div>



</body>
<?php
  include("ressource/footer.php");
?>

</html>
