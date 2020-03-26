
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
  <a class="navbar-brand" href="#">Application LGBT</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">

      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Page 1</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="#">Page 2</a>
      </li>

    </ul>
    <?php
    session_start();
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
       <h1 class="display-4 font-italic"><p id="welcome">Gestion des amis</p></h1>
       <p class="lead my-3">Rentre l'identifiant de ton ami dans le formulaire et ajoute le!</p>
       
     </div>
   </div>


   <div class="container marketing">


<div class="row ">
  <div class="bg-dark shadow p-5 mb-5 text-white text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">

  <div class="titre"><h2>Ajouter un ami</h2></div>
            <form action="validation_ajout_ami.php" method="post">

                Identifiant: <input type="text" name="id_to" class="p-2"/> </br>
                <input type="submit" value="Ajouter en ami"/>
            </form>
  </div>
  <div class="bg-light shadow p-5 mb-5 text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">

  <div class="titre"><h2>Ils souhaitent être ami avec toi:</h2></div>
    <?php
      //include("functions.php");
      $bdd_friend = mysqli_connect("localhost", "root", "","test");
      if (mysqli_connect_errno($bdd_friend)) {
          echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
      }

      $ras = mysqli_query($bdd_friend, "SELECT Amis.etat,Amis.id_from,Amis.ID FROM Utilisateur INNER JOIN Amis ON Amis.id_to=Utilisateur.ID WHERE Utilisateur.Mail='".$_SESSION['mail']."'");

      while ($donnees = ($row = mysqli_fetch_row($ras))){
        $res = mysqli_query($bdd_friend, "SELECT Utilisateur.Pseudo FROM Utilisateur INNER JOIN Amis ON Amis.id_from=Utilisateur.ID WHERE Utilisateur.ID='".$donnees[1]."'");
        $raw=mysqli_fetch_row ($res); 
        if($donnees[0]==0){
                
          echo $raw[0]." </br><a href='action_ami.php?action=delete&id=". $donnees[2] . "'>Supprimer</a><a href='action_ami.php?action=add&id=". $donnees[2] . "'>Ajouter</a></br>";
        }}
    

    ?>
           

    
</div>




  <div class="bg-dark shadow p-5 mb-5 text-white text-center mr-md-3 pt-3 px-3 pt-md-5 px-md-5 col">

  <div class="titre"><h2>Tes amis</h2></div>
    <?php
      
      $bdd_friend = mysqli_connect("localhost", "root", "","test");
      if (mysqli_connect_errno($bdd_friend)) {
          echo "Echec lors de la connexion à MySQL : " . mysqli_connect_error();
      }
      
      $ras = mysqli_query($bdd_friend, "SELECT Amis.etat,Amis.id_from,Amis.ID FROM Utilisateur INNER JOIN Amis ON Amis.id_to=Utilisateur.ID WHERE Utilisateur.Mail='".$_SESSION['mail']."'");

      while ($donnees = ($row = mysqli_fetch_row($ras))){
        $res = mysqli_query($bdd_friend, "SELECT Utilisateur.Pseudo FROM Utilisateur INNER JOIN Amis ON Amis.id_from=Utilisateur.ID WHERE Utilisateur.ID='".$donnees[1]."'");
        $raw=mysqli_fetch_row ($res); 
        if($donnees[0]==1){
                
          echo $raw[0] ."<a href='action_ami.php?action=delete&id=". $donnees[2] . "'>Supprimer</a></br>";          
        }}

        $ras2 = mysqli_query($bdd_friend, "SELECT Amis.etat,Amis.id_to,Amis.ID FROM Utilisateur INNER JOIN Amis ON Amis.id_from=Utilisateur.ID WHERE Utilisateur.Mail='".$_SESSION['mail']."'");

      while ($donnees = ($row2 = mysqli_fetch_row($ras2))){
        $res2 = mysqli_query($bdd_friend, "SELECT Utilisateur.Pseudo FROM Utilisateur INNER JOIN Amis ON Amis.id_to=Utilisateur.ID WHERE Utilisateur.ID='".$donnees[1]."'");
        $raw2=mysqli_fetch_row ($res2); 
        if($donnees[0]==1){
                
          echo $raw2[0] ."<a href='action_ami.php?action=delete&id=". $donnees[2] . "'>Supprimer</a></br>";

        }}
        
    ?>
   
</div>
</div>

</body>


</html>