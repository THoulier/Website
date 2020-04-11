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
          <?php
                if (isset($_SESSION['mail'])) {
                    echo '<a class="nav-link" href="ajouter_ami.php">Gestion des amis</a>';
                
                }
            ?>
        </li>

        <li class="nav-item">
            <?php
                if (isset($_SESSION['mail'])) {
                    echo '<a class="nav-link" href="gestion_transaction.php">Gestion des transactions</a>';
                }
            ?>
        </li>

    </ul>
    <?php
    if (isset($_SESSION['mail'])) {
      echo '<div class="nav-item">';
        echo '<a class="nav-link text-body" href="deconnexion.php">Déconnexion</a>';
      echo '</div>';
      echo '<div class="nav-item">';
        echo $_SESSION['mail'];
      echo '</div>';
    }
    ?>
    <div class="nav-item">
      <a class="nav-link text-body" href="#">Nous contacter</a>
    </div>
  </div>

</nav>