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
      <label for="egal">Parts égales</label>
      <?php if (isset($_GET["case"])){ 
              if ($_GET["case"]==1) {
                echo '<div class="alert alert-danger" role="alert">';
                    echo "Vous devez cocher une case";
                echo "</div>";
              }
            }
            ?>


        <!--<a class='btn btn-outline-primary' id='montant_manu' href='transaction_grp.php?manuel'>Manuellement</a>
        <a class='btn btn-outline-primary' id='montant_egal' href='transaction_grp.php?partsegales'>Parts égales</a>-->
        <br><br>
        <button type="submit" class="btn btn-primary">Créer une transaction groupée</button>
        <br><br>
      </div>
      </div>
      </form>



      <?php
      if (isset($_GET['nbnotempty']) && isset($_GET['casenotempty'])){
        if($_POST['choix']=='Manuellement'){

      echo '<form action="validation_ajout_transaction_grp.php?manu=1" method="post">
      <div class="row">
        <div class="col-sm ">
          Message explicatif: 
        </div>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <input type="text" name="msg_ex" class="p-2"/>
        </div>
        <div class="col-sm-8">';
          
            if (isset($_GET["msg_ex"])){ 
              if ($_GET["msg_ex"]==1) {
                echo '<div class="alert alert-danger" role="alert">';
                    echo "Vous devez renseigner un message explicatif !";
                echo "</div>";
              }
            }
        
        echo '</div>
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
        <div class="col-sm-8">';
          
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
          
        echo '</div>
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
        <div class="col-sm-8">';
          
            if (isset($_GET["montant"])) {
              if ($_GET["montant"]==1) {
                echo '<div class="alert alert-danger" role="alert">';
                  echo "Vous devez renseigner un montant!";
                echo "</div>";
              }

            }
        
       echo ' </div>
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
      
    </form>
    </br>
  </div>';}
  else if (isset($_GET['partsegales'])){
    echo '<form action="validation_ajout_transaction_grp.php?egal=1" method="post">
    <div class="row">
      <div class="col-sm ">
        Message explicatif: 
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <input type="text" name="msg_ex" class="p-2"/>
      </div>
      <div class="col-sm-8">';
        
          if (isset($_GET["msg_ex"])){ 
            if ($_GET["msg_ex"]==1) {
              echo '<div class="alert alert-danger" role="alert">';
                  echo "Vous devez renseigner un message explicatif !";
              echo "</div>";
            }
          }
      
      echo '</div>
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
      <div class="col-sm-8">';
        
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
        
      echo '</div>
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
      <div class="col-sm-8">';
        
          if (isset($_GET["montant"])) {
            if ($_GET["montant"]==1) {
              echo '<div class="alert alert-danger" role="alert">';
                echo "Vous devez renseigner un montant!";
              echo "</div>";
            }

          }
      
     echo ' </div>
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
    
  </form>
  </br>
</div>';}
  else {
    echo '</div>';
  }}
  ?>










  <div class="container marketing">
    <div class="titre"><h2>Historique de tes transactions</h2></div>
      <?php
      
        $bdd_transac = con();
        if (mysqli_connect_errno($bdd_transac)) {
            echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
        }
      
        $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_src='".$_SESSION['ID']."') OR (User_cible='".$_SESSION['ID']."') ORDER BY Date_creation DESC");
        echo '<table class="table table-hover table-white">';

        echo '<thead>';
        echo '<tr>';
        echo '<td>N°</td>';
        echo '<td>Montant</td>';
        echo '<td>Utilisateur source</td>';
        echo '<td>Utilisateur cible</td>';
        echo '<td>Message explicatif</td>';
        echo '<td>Date de création</td>';
        echo '<td>Statut</td>';
        echo '<td></td>';
        echo '<td>Actions</td>';
        echo '<td></td>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody>';

        $n=1;
        while ($donnees = ($row = mysqli_fetch_row($ras))){
          if($donnees[6]==2 || $donnees[6]==1){
            echo '<tr style="background-color: #D3D3D3;">';
          }else{
            echo '<tr>';}
          echo '<th scope="row">'.$n.'</th>';
          echo '<td>'.$donnees[4].'€';
          //option modification du montant
          if ($donnees[6]==0){
            if (isset($_GET["modar"])) {
              if ($_GET["modar"]==$donnees[0]) {
                $tabb = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
                $lignee = mysqli_fetch_row($tabb);
                echo '<form action="" method="post"><input type="number" name="valeur" value="'.$lignee[1].'"/><input type="submit" value="Enregistrer"/></form></td>';
                if (isset($_POST['valeur'])){
                  $mo = mysqli_query($bdd_transac, "UPDATE Transactions SET Montant='".$_POST['valeur']."' WHERE ID='".$donnees[0]."'");
                  echo("<meta http-equiv='refresh' content='0'; URL=transactions.php");
                }
              } else {
                echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction_grp.php?action=modifymontant&id=".$donnees[0]."'> Modifier</a></td>";
              }
            } else {
              echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction_grp.php?action=modifymontant&id=".$donnees[0]."'> Modifier</a></td>";
            }
          }
          echo '</td>';

          $res1 = mysqli_query($bdd_transac, "SELECT Pseudo FROM Utilisateur WHERE Utilisateur.ID='".$donnees[2]."'");
          $raw1 = mysqli_fetch_row($res1);
          echo '<td>'.$raw1[0].'</td>';

          $res1 = mysqli_query($bdd_transac, "SELECT Pseudo FROM Utilisateur WHERE Utilisateur.ID='".$donnees[3]."'");
          $raw1 = mysqli_fetch_row($res1);
          echo '<td>'.$raw1[0].'</td>';


          echo '<td>'.$donnees[1];


          //option modification du msg explicatif
          if ($donnees[6]==0){
            if (isset($_GET["modmsg"])) {
              if ($_GET["modmsg"]==$donnees[0]) {
                $tab = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
                $ligne = mysqli_fetch_row($tab);
                echo '<form action="" method="post"><input type="text" name="msg_ex" value="'.$ligne[0].'"/><input type="submit" value="Enregistrer"/></form></td>';
                if(isset($_POST['msg_ex'])){
                  $moo = mysqli_query($bdd_transac, "UPDATE Transactions SET Msg_exp='".$_POST['msg_ex']."' WHERE ID='".$donnees[0]."'");
                  echo("<meta http-equiv='refresh' content='0'; URL=transactions.php>"); 
                }
              } else {
                echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction_grp.php?action=modifymsg&id=". $donnees[0] . "'> Modifier</a></td>";
            }
            } else {
              echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction_grp.php?action=modifymsg&id=". $donnees[0] . "'> Modifier</a></td>";
            }
          }
          echo '</td>';

          echo '<td>'.$donnees[5].'</td>';
          if ($donnees[6] == 0){
            echo '<td>Non réglée<td>';
            echo "<td><a class='btn btn-primary' role='button' href='action_transaction_grp.php?action=regler&id=". $donnees[0] . "'> Régler</a></td>";          
            echo "<td><a class='btn btn-primary' role='button' href='action_transaction_grp.php?action=annuler&id=". $donnees[0] . "'> Annuler</a></td>";
          }elseif ($donnees[6] == 1){
            echo '<td>Réglée<td>';
            echo '<td></td>';
            echo '<td></td>';
          }elseif ($donnees[6] == 2){
            echo '<td>Annulée<td>';
            echo '<td></td>';
            echo '<td></td>';
          }
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
