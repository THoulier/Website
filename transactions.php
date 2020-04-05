<?php
    include("fonction.php");
    session_start();
    ?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Accueil</title>

  <style>
    /*.titre{
    }
    .bouton{
    }*/

    #welcome{
      text-shadow: 2px 2px 4px black;
    }
  </style>
</head>

<body>


  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-info">
  <a class="navbar-brand" href="index.php">Application LGBT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">

    <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ajouter_ami.php">Gestion des amis</a>
      </li>

      <li class="nav-item">
      <?php
      if (isset($_SESSION['mail'])) {
        echo '<a class="nav-link" href="transactions.php">Gestion des transactions</a>';
      
    }
    ?>
      </li>

    </ul>
    <?php
    ses();
    if (isset($_SESSION['mail'])) {
      echo '<div class="nav-item">';
        echo '<a class="nav-link text-body" href="deconnexion.php">Deconnexion</a>';
      echo '</div>';
      echo '<div class="nav-item">';
        echo $_SESSION['mail'];
      echo '</div>';
    }
    ?>
    <div class="nav-item">
      <a class="nav-link text-body" href="#">Nous contacter</a>
    </div>

  </nav>


  <div class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
     <div class="col-md-6 pt-4 px-0">
       <h1 class="display-4 font-italic"><p id="welcome">Gestion des transactions</p></h1>
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
</div>
    <div class="container marketing">

  <div class="titre"><h2>Voir tes transactions</h2></div>
  <?php
      
      $bdd_transac = con();
      if (mysqli_connect_errno($bdd_transac)) {
          echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
      }
     
      $cpt = 1;
      $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions ");
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
          while ($donnees = ($row = mysqli_fetch_row($ras))){
              
                if($donnees[2]==$_SESSION['ID']){
                  $res1 = mysqli_query($bdd_transac, "SELECT Pseudo FROM Utilisateur WHERE Utilisateur.ID='".$donnees[3]."'");
                  $raw1 = mysqli_fetch_row($res1);
                  echo '<tr>';
                  echo '<th scope="row">'.$cpt.'</th>';
                  echo '<td>'.$donnees[4].'€';
                  //option modification du montant
                  if (isset($_GET["mod"])) {
                    if ($_GET["mod"]==2) {
                      $tabb = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
                      $lignee = mysqli_fetch_row($tabb);
                      echo '<form action="" method="post"><input type="number" name="valeur" value="'.$lignee[1].'"/><input type="submit" value="Enregistrer"/></form></td>';
                      if(isset($_POST['valeur'])){
                        $mo = mysqli_query($bdd_transac, "UPDATE Transactions SET Montant='".$_POST['valeur']."' WHERE ID='".$donnees[0]."'");
                        header("Location:transactions.php");
                      }}}
                      else{
                        echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymontant&id=". $donnees[0] . "'> Modifier</a></td>";
                    }
                  echo '<td>'.$_SESSION['Pseudo'].'</td>';
                  echo '<td>'.$raw1[0].'</td>';
                  echo '<td>'.$donnees[1];
                  //option modification du msg explicatif
                  if (isset($_GET["mod"])) {
                    if ($_GET["mod"]==1) {
                      $tab = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
                      $ligne = mysqli_fetch_row($tab);
                      echo '<form action="" method="post"><input type="text" name="msg_ex" value="'.$ligne[0].'"/><input type="submit" value="Enregistrer"/></form></td>';
                      if(isset($_POST['msg_ex'])){
                        $moo = mysqli_query($bdd_transac, "UPDATE Transactions SET Msg_exp='".$_POST['msg_ex']."' WHERE ID='".$donnees[0]."'");
                        header("Location:transactions.php");
                        }}}
                      else{
                        echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymsg&id=". $donnees[0] . "'> Modifier</a></td>";
                    }
                  echo '<td>'.$donnees[5].'</td>';
                  if ($donnees[6] == 0){
                    echo '<td>Non réglée<td>';
                  }elseif ($donnees[6] == 1){
                    echo '<td>Réglée<td>';
                  }elseif ($donnees[6] == 2){
                    echo '<td>Annulée<td>';
                  }
                  echo "<td><a class='btn btn-primary' role='button' href='action_transaction.php?action=regler&id=". $donnees[0] . "'> Régler</a></td>";
                  echo "<td><a class='btn btn-primary' role='button' href='action_transaction.php?action=annuler&id=". $donnees[0] . "'> Annuler</a></td>";
                  echo '</tr>';
                  $cpt +=1;
                }



                if($donnees[3]==$_SESSION['ID']){
                    $res1 = mysqli_query($bdd_transac, "SELECT Pseudo FROM Utilisateur WHERE Utilisateur.ID='".$donnees[2]."'");
                    $raw1 = mysqli_fetch_row($res1);
                    echo '<tr>';
                    echo '<th scope="row">'.$cpt.'</th>';
                    echo '<td>'.$donnees[4].'€';
                    //option modification du montant
                    if (isset($_GET["mod"])) {
                      if ($_GET["mod"]==2) {
                        $tabb2 = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
                        $lignee2 = mysqli_fetch_row($tabb2);
                        echo '<form action="" method="post"><input type="number" name="valeur" value="'.$lignee2[1].'"/><input type="submit" value="Enregistrer"/></form></td>';
                        if(isset($_POST['valeur'])){
                          $mo2 = mysqli_query($bdd_transac, "UPDATE Transactions SET Montant='".$_POST['valeur']."' WHERE ID='".$donnees[0]."'");
                          header("Location:transactions.php");
                        }}}
                        else{
                          echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymontant&id=". $donnees[0] . "'> Modifier</a></td>";
                      }
                    echo '<td>'.$raw1[0].'</td>';
                    echo '<td>'.$_SESSION['Pseudo'].'</td>';
                    echo '<td>'.$donnees[1];
                    //option modification du msg explicatif
                    if (isset($_GET["mod"])) {
                      if ($_GET["mod"]==1) {
                        $tab2 = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
                        $ligne2 = mysqli_fetch_row($tab2);
                        echo '<form action="" method="post"><input type="text" name="msg_ex" value="'.$ligne2[0].'"/><input type="submit" value="Enregistrer"/></form></td>';
                        if(isset($_POST['msg_ex'])){
                          $moo2 = mysqli_query($bdd_transac, "UPDATE Transactions SET Msg_exp='".$_POST['msg_ex']."' WHERE ID='".$donnees[0]."'");
                          header("Location:transactions.php");
                          }}}
                        else{
                          echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymsg&id=". $donnees[0] . "'> Modifier</a></td>";
                      }
                    echo '<td>'.$donnees[5].'</td>';
                    if ($donnees[6] == 0){
                        echo '<td>Non réglée<td>';
                      }elseif ($donnees[6] == 1){
                        echo '<td>Réglée<td>';
                      }elseif ($donnees[6] == 2){
                        echo '<td>Annulée<td>';
                      }
                    echo "<td><a class='btn btn-primary' role='button' href='action_transaction.php?action=regler&id=". $donnees[0] . "'> Régler</a></td>";
                    echo "<td><a class='btn btn-primary' role='button' href='action_transaction.php?action=annuler&id=". $donnees[0] . "'> Annuler</a></td>";
                    echo '</tr>';
                    $cpt +=1;
                  }
              
          }
          
    ?>

</div>



</body>


</html>
