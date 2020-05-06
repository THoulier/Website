<?php
include("ressource/fonction/fonction.php");



function new_transaction($tab) {
    $pseudo = $tab['pseudo'];
    $page = $tab["page"];
    $mess = $tab['msg_ex'];
    $montant = $tab['montant'];
    $mode = $tab['mode'];
    $bdd_transac=con();
    $req = mysqli_query($bdd_transac, "SELECT * FROM Utilisateur WHERE Pseudo='".$pseudo."' OR Mail='".$pseudo."'");
    $mess=htmlentities($mess,ENT_QUOTES);
    $user_cible = mysqli_fetch_row($req);
    $user_src = $_SESSION['ID'];
    if ($mode == "moi") {
        $new_transac = "INSERT INTO Transactions(Msg_exp, User_src, User_cible, Montant) VALUES('".$mess."',". $user_src.",".$user_cible[0].",".$montant.")";
    } else {
        $new_transac = "INSERT INTO Transactions(Msg_exp, User_src, User_cible, Montant) VALUES('".$mess."',". $user_cible[0].",".$user_src.",".$montant.")";
    }
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
function entete_amis($page,$submode,$mode) {
    echo '<table class="table table-hover table-white">';
    if (strpos($page,"?")) {
        $page .= empty($mode) ? "&" : "&mode=$mode&";
    } else {
        $page .= empty($mode) ? "?" : "?mode=$mode&";
    }
    echo '<thead>';
        echo '<tr>';
        echo '<td>N°</td>';
        if ($submode==1) {
            echo '<td><a href="'.$page.'submode=2">Montant </a></td>';
        } else {
            echo '<td><a href="'.$page.'submode=1">Montant </a></td>';
        }
        
        echo '<td>Utilisateur</a></td>';
        echo '<td>Message explicatif</td>';
        if ($submode==4) {
            echo '<td><a href="'.$page.'submode=3">Date de création</a></td>';
        } else {
            echo '<td><a href="'.$page.'submode=4">Date de création</a></td>';
        }
        echo '<td>Statut</td>';
        echo "<td></td>";
        echo '<td>Régler ou <br>Date de fermeture</td>';
        echo '<td>Annuler ou <br>Message de clôture</td>';
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

function display_modify_solde($donnees,$tab) {
    $page=$tab['page'];
    $mode=$tab['mode'];
    $submode=$tab['submode'];
    $bdd_transac = con();
    if (mysqli_connect_errno($bdd_transac)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
    if ($donnees[6]==0){
        if (isset($_GET["modar"])) {
          if ($_GET["modar"]==$donnees[0]) {
            $tabb = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
            $lignee = mysqli_fetch_row($tabb);
            echo "<input type='hidden' name='id' value='$donnees[0]'>";
            echo "<input type='hidden' name='page' value='$page'>";
            echo "<input type='hidden' name='mode' value='$mode'>";
            echo "<input type='hidden' name='submode' value='$submode'>";
            echo '<input type="number" name="valeur" step="0.01" value="'.$lignee[1].'"/><input type="submit" value="Enregistrer"/></td>';
          } else {
            echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymontant&id=".$donnees[0]."&page=".$page."&mode=$mode&submode=$submode'> Modifier</a></td>";
          }
        } else {
          echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymontant&id=".$donnees[0]."&page=".$page."&mode=$mode&submode=$submode'> Modifier</a></td>";
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

function display_msg($donnees,$tab) {
    $bdd_transac = con();
    $page=$tab['page'];
    $mode=$tab['mode'];
    $submode=$tab['submode'];
    if (mysqli_connect_errno($bdd_transac)) {
        echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
    }
    if ($donnees[6]==0){
        if (isset($_GET["modmsg"])) {
          if ($_GET["modmsg"]==$donnees[0]) {
            $tab = mysqli_query($bdd_transac, "SELECT Msg_exp,Montant FROM Transactions WHERE ID='".$donnees[0]."'");
            $ligne = mysqli_fetch_row($tab);
            echo "<input type='hidden' name='id' value='$donnees[0]'>";
            echo "<input type='hidden' name='page' value='$page'>";
            echo "<input type='hidden' name='mode' value='$mode'>";
            echo "<input type='hidden' name='submode' value='$submode'>";
            echo '<input type="text" name="msg_ex" value="'.$ligne[0].'"/><input type="submit" value="Enregistrer"/></form></td>';
          } else {
            echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymsg&id=". $donnees[0] . "&page=".$page."&mode=$mode&submode=$submode'> Modifier</a></td>";
          }
        } else {
          echo "</br><a class='btn btn-secondary btn-sm' role='button' href='action_transaction.php?action=modifymsg&id=". $donnees[0] . "&page=".$page."&mode=$mode&submode=$submode'> Modifier</a></td>";
        }
      }
      echo '</td>';
}

function display_etat($donnees,$page) {
    if ($donnees[6] == 0){
        echo '<td>Non réglée<td>';
        echo "<td><input type='radio' name='$donnees[0]' value='regler'></td>";
        echo "<td><input type='radio' name='$donnees[0]' value='annuler'></td>";
      }elseif ($donnees[6] == 1){
        echo '<td>Réglée<td>';
        echo "<td>$donnees[7]</td>";
        echo "<td>$donnees[8]</td>";
      }elseif ($donnees[6] == 2){
        echo '<td>Annulée<td>';
        echo "<td>$donnees[7]</td>";
        echo "<td>$donnees[8]</td>";
      }
}

function selec_display_transac($tab,$submode) {
    $id=$tab['id'];
    $mode=$tab['mode'];
    $bdd_transac = con();
    $array = array("Date_creation DESC","Montant DESC","Montant ASC","Date_creation DESC","Date_creation ASC");
    $submode = $array[$submode];
    if (empty($id)) {
        switch ($mode) {
            case 0:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ( (User_src='".$_SESSION['ID']."') OR (User_cible='".$_SESSION['ID']."') ) AND Statut = 0 ORDER BY $submode ");
                break;
            case 1:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_src='".$_SESSION['ID']."') AND Statut = 0 ORDER BY $submode ");
                break;
            case 2:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_cible='".$_SESSION['ID']."') AND Statut = 0 ORDER BY $submode ");
                break;
            case 3:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ( (User_src='".$_SESSION['ID']."') OR (User_cible='".$_SESSION['ID']."') ) AND Statut != 0 ORDER BY $submode ");
                break;
            case 4:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_src='".$_SESSION['ID']."') AND Statut != 0 ORDER BY $submode ");
                break;
            case 5:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE (User_cible='".$_SESSION['ID']."') AND Statut != 0 ORDER BY $submode ");
                break;
        }
    } else {
        switch ($mode) {
            case 0:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ( User_src='".$id."' AND User_cible='".$_SESSION['ID']."' OR User_cible='".$id."' AND User_src='".$_SESSION['ID']."' ) AND Statut = 0 ORDER BY $submode ");
                break;
            case 1:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_cible='".$id."' AND User_src='".$_SESSION['ID']."' AND Statut = 0 ORDER BY $submode ");
                break;
            case 2:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_src='".$id."' AND User_cible='".$_SESSION['ID']."'  AND Statut = 0 ORDER BY $submode ");
                break;
            case 3:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE ( User_src='".$id."' AND User_cible='".$_SESSION['ID']."' OR User_cible='".$id."' AND User_src='".$_SESSION['ID']."' ) AND Statut != 0 ORDER BY $submode ");
                break;
            case 4:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_cible='".$id."' AND User_src='".$_SESSION['ID']."' AND Statut != 0 ORDER BY $submode ");
                break;
            case 5:
                $ras = mysqli_query($bdd_transac, "SELECT * FROM  Transactions WHERE User_src='".$id."' AND User_cible='".$_SESSION['ID']."'  AND Statut != 0 ORDER BY $submode ");
                break;
        }
    }
    return $ras;
}

function display_transac_aux($tab) {
    $n=$tab["n"];
    $ras = $tab["ras"];
    $page = $tab["page"];
    $mode = $tab["mode"];
    $submode = $tab["submode"];
    while ($donnees = ($row = mysqli_fetch_row($ras))){
        color_table($donnees);
        echo '<th scope="row">'.$n.'</th>';
        display_solde($donnees[0]);
        //option modification du montant
        display_modify_solde($donnees,compact('page','mode','submode'));

        display_user($donnees);


        echo '<td>'.$donnees[1];


        //option modification du msg explicatif
        display_msg($donnees,compact('page','mode','submode'));

        echo '<td>'.$donnees[5].'</td>';
        display_etat($donnees,$page);
        echo '</tr>';
        $n=$n+1;
    }
    return $n;

}

function afficher_bouton($page) {

    echo '<div class="row">';
        echo '<div class="col-10">'; 
            if (strpos($page,"?")) {
                echo '<a role="button" href="'.$page.'&mode=0" class="btn btn-primary">Tout</a>';
                echo '<a role="button" href="'.$page.'&mode=1" class="btn btn-success">Gain</a>';
                echo '<a role="button" href="'.$page.'&mode=2" class="btn btn-danger">Perte</a>';
            } else {
                echo '<a role="button" href="'.$page.'?mode=0" class="btn btn-primary">Tout</a>';
                echo '<a role="button" href="'.$page.'?mode=1" class="btn btn-success">Gain</a>';
                echo '<a role="button" href="'.$page.'?mode=2" class="btn btn-danger">Perte</a>';
            }
        echo "</div>";
        echo '<div class="col">';
            include("ressource/overlay.php");
        echo "</div>";
    echo "</div>";

}

function display_transac($page,$id,$mode,$submode) {
    echo "<form action='action_transaction.php?page=$page' method='POST'>";
    afficher_bouton($page);
    entete_amis($page,$submode,$mode);
    $ras = selec_display_transac(compact("id","mode"),$submode);
    $n=1;
    $n=display_transac_aux(compact("n","ras","page","mode","submode"));
    $mode+=3;
    $ras = selec_display_transac(compact("id","mode"),$submode);
    $mode-=3;
    display_transac_aux(compact("n","ras","page","mode","submode"));  
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
}


?>