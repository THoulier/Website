<?php
include("ressource/fonction/fonction.php");



function new_transaction($bdd_transac,$pseudo,$page,$mess,$montant) {
    $req = mysqli_query($bdd_transac, "SELECT * FROM Utilisateur WHERE Pseudo='".$pseudo."' OR Mail='".$pseudo."'");

    $user_cible = mysqli_fetch_row($req);
    $user_src = $_SESSION['ID'];

    $new_transac = "INSERT INTO Transactions(Msg_exp, User_src, User_cible, Montant) VALUES('".$mess."',". $user_src.",".$user_cible[0].",".$montant.")";
    if (mysqli_query($bdd_transac, $new_transac)) {
        header("Location: ".$page);
    } else {
        echo "Error: " . $new_transac . "<br>" . mysqli_error($bdd_transac);
    }

}
function error_pseudo(){
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
}
function entete_amis() {
    echo '<table class="table table-hover table-white">';

    echo '<thead>';
        echo '<tr>';
        echo '<td>N°</td>';
        echo '<td>Montant</td>';
        echo '<td>Utilisateur</td>';
        echo '<td>Message explicatif</td>';
        echo '<td>Date de création</td>';
        echo '<td>Statut</td>';
        echo '<td></td>';
        echo '<td>Actions</td>';
        echo '<td></td>';
        echo '</tr>';
    echo '</thead>';

    echo '<tbody>';
}

function color_table($donnees) {
    if($donnees[6]==2 || $donnees[6]==1){
        echo '<tr style="background-color: #D3D3D3;">';
    }else{
        echo '<tr>';
    }
}


function display_solde($ID_transac) {
    $bdd_transac = con();
    $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ID=".$ID_transac);
    $res=mysqli_fetch_row($ras);
    if ($res[2] == $_SESSION['ID']) {
        echo '<td style="color: green">'.$res[4].'€';
    } else {
        echo '<td style="color: red">'.-$res[4].'€';
    }

}

function display_modify_solde($donnees,$page) {
    $bdd_transac = con();
    if (mysqli_connect_errno($bdd_transac)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
    if ($donnees[6]==0){
        if (isset($_GET["modar"])) {
          if ($_GET["modar"]==$donnees[0]) {
            $tabb = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
            $lignee = mysqli_fetch_row($tabb);
            echo '<form action="" method="post"><input type="number" name="valeur" value="'.$lignee[1].'"/><input type="submit" value="Enregistrer"/></form></td>';
            if (isset($_POST['valeur'])){
              $mo = mysqli_query($bdd_transac, "UPDATE Transactions SET Montant='".$_POST['valeur']."' WHERE ID='".$donnees[0]."'");
              echo("<meta http-equiv='refresh' content='0'; URL=".$page);
            }
          } else {
            echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymontant&id=".$donnees[0]."&page=".$page."'> Modifier</a></td>";
          }
        } else {
          echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymontant&id=".$donnees[0]."&page=".$page."'> Modifier</a></td>";
        }
    }
    echo '</td>';
}

function display_user($donnees) {
    $bdd_transac = con();
    if ($_SESSION['ID'] == $donnees[2]) {
        $res1 = mysqli_query($bdd_transac, "SELECT Pseudo FROM Utilisateur WHERE Utilisateur.ID='".$donnees[3]."'");
        $raw1 = mysqli_fetch_row($res1);
        echo '<td>'.$raw1[0].'</td>';
    } else {
        $res1 = mysqli_query($bdd_transac, "SELECT Pseudo FROM Utilisateur WHERE Utilisateur.ID='".$donnees[2]."'");
        $raw1 = mysqli_fetch_row($res1);
        echo '<td>'.$raw1[0].'</td>';
    }
}

function display_msg($donnees,$page) {
    $bdd_transac = con();
    if (mysqli_connect_errno($bdd_transac)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
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
            echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymsg&id=". $donnees[0] . "&page=".$page."'> Modifier</a></td>";
          }
        } else {
          echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymsg&id=". $donnees[0] . "&page=".$page."'> Modifier</a></td>";
        }
      }
      echo '</td>';
}

function display_etat($donnees,$page) {
    if ($donnees[6] == 0){
        echo '<td>Non réglée<td>';
        include("ressource/overlay_mess.php");
        echo '<form action="action_transaction.php?action=regler&page='.$page.'&id='.$donnees[0].'" method="post">';
        include("ressource/overlay_mess_fin.php");
                  
        echo "<td><a class='btn btn-primary' role='button' href='action_transaction.php?action=annuler&id=". $donnees[0] . "&page=".$page."'> Annuler</a></td>";
      }elseif ($donnees[6] == 1){
        echo '<td>Réglée<td>';
        echo '<td></td>';
        echo '<td></td>';
      }elseif ($donnees[6] == 2){
        echo '<td>Annulée<td>';
        echo '<td></td>';
        echo '<td></td>';
      }
}

function selec_display_transac($id,$mode) {
    $bdd_transac = con();
    if (empty($id)) {
        switch ($mode) {
            case 0:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ( (User_src='".$_SESSION['ID']."') OR (User_cible='".$_SESSION['ID']."') ) AND Statut = 0 ORDER BY Date_creation DESC");
                break;
            case 1:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_src='".$_SESSION['ID']."') AND Statut = 0 ORDER BY Date_creation DESC");
                break;
            case 2:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_cible='".$_SESSION['ID']."') AND Statut = 0 ORDER BY Date_creation DESC");
                break;
            case 3:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ( (User_src='".$_SESSION['ID']."') OR (User_cible='".$_SESSION['ID']."') ) AND Statut != 0 ORDER BY Date_creation DESC");
                break;
            case 4:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_src='".$_SESSION['ID']."') AND Statut != 0 ORDER BY Date_creation DESC");
                break;
            case 5:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_cible='".$_SESSION['ID']."') AND Statut != 0 ORDER BY Date_creation DESC");
                break;
        }
    } else {
        switch ($mode) {
            case 0:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ( User_src='".$id."' AND User_cible='".$_SESSION['ID']."' OR User_cible='".$id."' AND User_src='".$_SESSION['ID']."' ) AND Statut = 0 ORDER BY Date_creation DESC");
                break;
            case 1:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_cible='".$id."' AND User_src='".$_SESSION['ID']."' AND Statut = 0 ORDER BY Date_creation DESC");
                break;
            case 2:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_src='".$id."' AND User_cible='".$_SESSION['ID']."'  AND Statut = 0 ORDER BY Date_creation DESC");
                break;
            case 3:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ( User_src='".$id."' AND User_cible='".$_SESSION['ID']."' OR User_cible='".$id."' AND User_src='".$_SESSION['ID']."' ) AND Statut != 0 ORDER BY Date_creation DESC");
                break;
            case 4:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_cible='".$id."' AND User_src='".$_SESSION['ID']."' AND Statut != 0 ORDER BY Date_creation DESC");
                break;
            case 5:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_src='".$id."' AND User_cible='".$_SESSION['ID']."'  AND Statut != 0 ORDER BY Date_creation DESC");
                break;
        }
    }
    return $ras;
}

function display_transac_aux($n,$ras,$page) {
    while ($donnees = ($row = mysqli_fetch_row($ras))){
        color_table($donnees);
        echo '<th scope="row">'.$n.'</th>';
        display_solde($donnees[0],);
        //option modification du montant
        display_modify_solde($donnees,$page);

        display_user($donnees);


        echo '<td>'.$donnees[1];


        //option modification du msg explicatif
        display_msg($donnees,$page);

        echo '<td>'.$donnees[5].'</td>';
        display_etat($donnees,$page);
        echo '</tr>';
        $n=$n+1;
    }
    return $n;

}

function afficher_bouton($page) {

    if (strpos($page,"?")) {
        echo '<a role="button" href="'.$page.'&mode=0" class="btn btn-primary">Tout</a>';
        echo '<a role="button" href="'.$page.'&mode=1" class="btn btn-success">Gain</a>';
        echo '<a role="button" href="'.$page.'&mode=2" class="btn btn-danger">Perte</a>';
    } else {
        echo '<a role="button" href="'.$page.'?mode=0" class="btn btn-primary">Tout</a>';
        echo '<a role="button" href="'.$page.'?mode=1" class="btn btn-success">Gain</a>';
        echo '<a role="button" href="'.$page.'?mode=2" class="btn btn-danger">Perte</a>';
    }
    

}

function display_transac($page,$id,$mode) {
    afficher_bouton($page);
    entete_amis();
    $ras = selec_display_transac($id,$mode);
    $n=display_transac_aux(1,$ras,$page);
    $ras = selec_display_transac($id,$mode+3);
    display_transac_aux($n,$ras,$page);  
    echo "</tbody>";
    echo "</table>";
}


?>