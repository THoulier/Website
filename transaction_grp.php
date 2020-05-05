<?php
    session_start();
    include("ressource/head.php");
    include("ressource/fonction/fonction_group.php");
    include("ressource/fonction/fonction_transac.php");
?>

<body>


  <?php
    include("ressource/header.php");
  ?>


  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Gestion des transactions groupées</p></h1>
       <p class="lead my-3">Tu peux consulter tes transactions avec tes amis!</p>
       
     </div>
  </div>


  <div class="container">
    <h2>Ajoute une transaction</h2>
    <div class="row">
      <form action="pre_validation_ajout_transaction_grp.php" method="post">
        <div class="col-sm ">
          Nombre d'utilisateurs cibles: 
          <input type="number" name="nb" class="p-1"/></br><br>
          <?php if (isset($_GET["nbr"])){ 
            if ($_GET["nbr"]==1) {
              echo '<div class="alert alert-danger" role="alert">';
                  echo "Vous devez renseigner le nombre d'utilisateurs cibles!";
              echo "</div>";
            }
          }
          ?>
          Le montant doit être rentré:
          <input type="radio" id="manuel" name="choix" value="Manuellement">
          <label for="manuel">Manuellement</label>
          <input type="radio" id="egal" name="choix" value="Parts">
          <label for="egal">Automatiquement</label>
          <?php if (isset($_GET["case"])){ 
              if ($_GET["case"]==1) {
                echo '<div class="alert alert-danger" role="alert">';
                    echo "Vous devez cocher une case";
                echo "</div>";
              }
            }
          ?>
          <br>
          <button type="submit" class="btn btn-primary">Valider</button>
          
        </div>
      </form>
    </div>



    <?php
      if (isset($_GET['choix']) && isset($_GET['nb'])){
        echo '<hr><form action="validation_ajout_transaction_grp.php?choix='.$_GET['choix'].'&nb='.$_GET['nb'].'" method="POST">';
          choix_part($_GET['choix'],isset($_GET['montant_total']) ? $_GET['montant_total'] : '');
          echo '<div class="row">';
            echo '<div class="col-sm ">';
              echo 'Message explicatif commun:'; 
            echo '</div>';
          echo '</div>';
          echo '<div class="row">';
            echo '<div class="col-sm-4">';
              echo '<input type="text" name="msg_ex" class="p-2"/>';
            echo '</div>';
            echo '<div class="col-sm-8">';
              if (isset($_GET["msg_ex"])){ 
                if ($_GET["msg_ex"]==1) {
                  echo '<div class="alert alert-danger" role="alert">';
                      echo "Vous devez renseigner un message explicatif !";
                  echo "</div>";
                }
              }
            echo '</div>';
          echo '</div><br>';
          affichage_grp_nb($_GET['nb'],$_GET['choix']);
          echo '<div class ="row">';
            echo '<div class="col-sm ">';
              echo '<button type="submit" class="btn btn-primary">Ajouter une transaction groupée</button>';
            echo '</div>';
          echo '</div>';
        echo '</form>';
        echo '</br>';
      }
    ?>
  </div>







  <div class="container marketing">
    <div class="titre"><h2>Historique de tes transactions</h2></div>
      <?php
        $submode = (isset($_GET["submode"])) ? $_GET["submode"] : 0 ;
        if (isset($_GET["mode"])) {
          display_transac("transaction_grp.php","",$_GET["mode"],$submode);
        } else {
          display_transac("transaction_grp.php","",0,$submode);
        }
        
      ?>

  </div>

<script>


<?php if ($_GET["choix"]=="Manuellement"){ ?>
    document.getElementsByName("choix")[0].checked = true;
    document.getElementsByName("nb")[0].value =<?php echo $_GET["nb"]; ?>;
<?php } ?>

<?php if ($_GET['choix']=='Parts'){ ?>
    document.getElementsByName("choix")[1].checked = true;
    document.getElementsByName("nb")[0].value =<?php echo $_GET["nb"]; ?>;

    var montanttot = document.getElementsByName("montant_total");
    montanttot[0].addEventListener('change',function(e){
    for (var i=1;i<=<?php echo $_GET['nb']; ?>;i++){
      document.getElementsByName("montant"+i)[0].value =( montanttot[0].value/<?php echo $_GET['nb']; ?>).toFixed(2);
    }
    });

<?php } ?>


</script>

</body>
<?php
  include("ressource/footer.php");
?>

</html>
