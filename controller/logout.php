<?php 
    session_start();

    session_destroy();
    
    header("Location: ../view//Login.php");
    exit();

?>