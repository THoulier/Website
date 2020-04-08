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
      
        $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_src='".$_GET['id']."' AND User_cible='".$_SESSION['ID']."' OR User_cible='".$_GET['id']."' AND User_src='".$_SESSION['ID']."' ORDER BY Date_creation DESC");
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
          echo '<tr>';
          echo '<th scope="row">'.$n.'</th>';
          echo '<td>'.$donnees[4].'€';
          //option modification du montant
          if (isset($_GET["modar"])) {
            if ($_GET["modar"]==$donnees[0]) {
              $tabb = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
              $lignee = mysqli_fetch_row($tabb);
              echo '<form action="" method="post"><input type="number" name="valeur" value="'.$lignee[1].'"/><input type="submit" value="Enregistrer"/></form></td>';
              if (isset($_POST['valeur'])){
                $mo = mysqli_query($bdd_transac, "UPDATE Transactions SET Montant='".$_POST['valeur']."' WHERE ID='".$donnees[0]."'");
                echo("<meta http-equiv='refresh' content='0'; URL=transactions_ami.php");
              }
            } else {
              echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction_ami.php?action=modifymontant&ID=".$donnees[0]."&id=".$_GET['id']."'> Modifier</a></td>";
            }
          } else {
            echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction_ami.php?action=modifymontant&ID=".$donnees[0]."&id=".$_GET['id']."'> Modifier</a></td>";
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
          if (isset($_GET["modmsg"])) {
            if ($_GET["modmsg"]==$donnees[0]) {
              $tab = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
              $ligne = mysqli_fetch_row($tab);
              echo '<form action="" method="post"><input type="text" name="msg_ex" value="'.$ligne[0].'"/><input type="submit" value="Enregistrer"/></form></td>';
              if(isset($_POST['msg_ex'])){
                $moo = mysqli_query($bdd_transac, "UPDATE Transactions SET Msg_exp='".$_POST['msg_ex']."' WHERE ID='".$donnees[0]."'");
                echo("<meta http-equiv='refresh' content='0'; URL=transactions_ami.php>"); 
              }
            } else {
              echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction_ami.php?action=modifymsg&ID=". $donnees[0] . "&id=".$_GET['id']."'> Modifier</a></td>";
          }
          } else {
            echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction_ami.php?action=modifymsg&ID=". $donnees[0] . "&id=".$_GET['id']."'> Modifier</a></td>";
          }
          echo '</td>';

          echo '<td>'.$donnees[5].'</td>';
          if ($donnees[6] == 0){
            echo '<td>Non réglée<td>';
          }elseif ($donnees[6] == 1){
            echo '<td>Réglée<td>';
          }elseif ($donnees[6] == 2){
            echo '<td>Annulée<td>';
          }
          echo "<td><a class='btn btn-primary' role='button' href='action_transaction_ami.php?action=regler&ID=". $donnees[0] . "&id=".$_GET['id']."'> Régler</a></td>";          
          echo "<td><a class='btn btn-primary' role='button' href='action_transaction_ami.php?action=annuler&ID=". $donnees[0] . "&id=".$_GET['id']."'> Annuler</a></td>";
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
