<?php 
session_start();
session_name("logowanie");

header("Location: ../index-lista.php");

session_destoy();

?>
