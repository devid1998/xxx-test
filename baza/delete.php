<?php 

include("dostep.php");
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    
    $id = $_GET["id"];
    if ($query = $mysqli -> prepare("DELETE FROM Contacts WHERE id= ? LIMIT 1")){
        
        $query -> bind_param("i", $id);
        $query -> execute();
        $query -> close();
        
    } 
    
} 

$mysqli -> close();
header("Location: index.php");

