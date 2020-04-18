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
            <h1 class="display-5 font-italic"><p id="welcome">Gestion des transactions avec ton ami :
            <?php 
            $bdd_transac = con();
            if (mysqli_connect_errno($bdd_transac)) {
                echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
            }
            $req = mysqli_query($bdd_transac, "SELECT Pseudo FROM Utilisateur WHERE ID='".$_GET['id']."'");
            $row = mysqli_fetch_row($req);
            echo "</br>";
            echo $row[0];
            ?>
            </p></h1>
        </div>
    </div>

  <div class="container marketing">

      <?php
      
        $bdd_transac = con();
        if (mysqli_connect_errno($bdd_transac)) {
            echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
        }
      
        display_transac("transactions_ami.php",$_GET["id"],0);
      ?>

  </div>



</body>
<?php
  include("ressource/footer.php");
?>

</html>
