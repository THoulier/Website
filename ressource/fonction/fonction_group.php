<?php

function check_montant_tot($mont) {
    if (isset($mont)) {
        if ($mont==1) {
          echo '<div class="alert alert-danger" role="alert">';
            echo "Vous devez renseigner un montant total!";
          echo "</div>";
        }
        elseif ($mont==2) {
          echo '<div class="alert alert-danger" role="alert">';
            echo "Vous devez renseigner un montant total positif!";
          echo "</div>";
        }
    }
}

function choix_part($part,$tot) {
    if ($part=='Parts'){
        echo '<div class="row">';
            echo '<div class="col-sm ">';
                echo 'Montant total:'; 
            echo '</div>';
        echo '</div>';
        echo '<div class="row">';
            echo '<div class="col-sm-4">';
                echo '<input type="number" name="montant_total" class="p-2"/>';
            echo '</div>';
            echo '<div class="col-sm-8">';
                check_montant_tot($tot);
            echo '</div>';
        echo '</div>';
    }
}

function error_monanti($i) {
    if (isset($_GET["montant$i"])) {
        if ($_GET["montant$i"]==1) {
            echo '<div class="alert alert-danger" role="alert">';
                echo "Vous devez renseigner un montant!";
            echo "</div>";
        }
        if ($_GET["montant$i"]==2) {
            echo '<div class="alert alert-danger" role="alert">';
                echo "Vous devez renseigner un montant positif!";
            echo "</div>";
        }
    }
}

function get_choix($choix,$i) {
    if ($choix=='Manuellement'){
        echo '<input type="number" name="montant'.$i.'" class="p-2"/>';
      }else if($choix=='Parts'){
        echo '<input type="number" name="montant'.$i.'" class="p-2" value="" step="any"/>';
      }
}

function error_pseudo_grp($var){
    if (isset($_GET["pseudo$var"])) {
        if ($_GET["pseudo$var"]==1) {
            echo '<div class="alert alert-danger" role="alert">';
                echo "Vous devez renseigner un pseudo ou une adresse mail d'un ami!";
            echo "</div>";
        }
        if ($_GET["pseudo$var"]==2) {
            echo '<div class="alert alert-danger" role="alert">';
                echo "Cet utilisateur n'existe pas";
            echo "</div>";
        }
        if ($_GET["pseudo$var"]==3) {
            echo '<div class="alert alert-danger" role="alert">';
                echo "Vous ne pouvez pas enregistrer une transaction à vous même!";
            echo "</div>";
        }
    }
}

function affichage_grp_nb($nbr,$choix) {
    echo '<div class="row">';
    for($i=1;$i<=$nbr;$i++){
        echo '<div class="col">';
            echo '<div class="row">';
                echo '<div class="col-sm ">';
                    echo 'Pseudo ou adresse mail de ton ami n°'.$i.':';  
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col-sm-4">';
                    echo '<input type="text" name="pseudo'.$i.'" class="p-2"/>';
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col-sm-8">';
                    error_pseudo_grp($i);
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col-sm ">';
                    echo 'Montant n°'.$i.':';  
                echo '</div>';
            echo '</div>';
            echo '<div class="row">';
                echo '<div class="col-sm-4">';
                    get_choix($choix,$i);
                echo '</div>';
                echo '<div class="col-sm-8">';
                    error_monanti($i);
                echo ' </div>';
            echo '</div>';
        echo '</div>';
        if ($i%3==0) {
            echo '</div>';
            echo '<br>';
            echo '<div class="row">';
        }
      }
      echo '</div>';
      echo '<br>';
}
?>