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
            if (isset($_GET["pseudo"])) {
                if ($_GET["pseudo"]==1) {
                    echo '<div class="alert alert-danger" role="alert">';
                        echo "Vous devez renseigner un pseudo ou une adresse mail d'un ami!";
                    echo "</div>";
                }
                if ($_GET["pseudo"]==2) {
                    echo '<div class="alert alert-danger" role="alert">';
                        echo "Cet utilisateur n'existe pas";
                    echo "</div>";
                }
                if ($_GET["pseudo"]==3) {
                    echo '<div class="alert alert-danger" role="alert">';
                        echo "Vous ne pouvez pas enregistrer une transaction à vous même!";
                    echo "</div>";
                }
            }
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
      
        $bdd_transac = con();
        if (mysqli_connect_errno($bdd_transac)) {
            echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
        }
      
        $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_src='".$_SESSION['ID']."') OR (User_cible='".$_SESSION['ID']."') ORDER BY Date_creation DESC");
        entete_amis();

        $n=1;
        while ($donnees = ($row = mysqli_fetch_row($ras))){
          color_table($donnees);
          echo '<th scope="row">'.$n.'</th>';
          display_solde($donnees[0],$bdd_transac,$_SESSION['ID']);
          //option modification du montant
          display_modify_solde($donnees,$bdd_transac);

          display_user($_SESSION['ID'], $donnees,$bdd_transac);


          echo '<td>'.$donnees[1];


          //option modification du msg explicatif
          display_msg($donnees,$bdd_transac);

          echo '<td>'.$donnees[5].'</td>';
          display_etat($donnees);
          echo '</tr>';
          $n=$n+1;
        }
      ?>
      </tbody>
      </table>

  </div>



</body>
<?php
  include("ressource/footer.php");
?>

</html>
