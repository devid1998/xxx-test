<?php 
session_start();
session_name("logowanie");

include("dostep-lista.php");

$logincheck = "davie";
$password = "123";


if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    
    $id = $_GET["id"];
    
    if ($query = $mysqli -> prepare("DELETE FROM lista WHERE id= ? LIMIT 1")){
        
        $query -> bind_param("i", $id);
        $query -> execute();
        $query -> close();
        
    } 
    
} 

$mysqli -> close();
 header("Location: show-lista.php");

?>
