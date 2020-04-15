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
