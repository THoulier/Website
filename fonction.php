<?php

function con() {
    return mysqli_connect("localhost", "root", "","test");
}


function ses() {
    if (isset($_SESSION)) {
        if ( time() - $_SESSION['time'] > 3600 ) {
            session_destroy();
            header("Location: index.php");
        }
    }
}

?>