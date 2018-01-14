<!DOCTYPE HTML>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../styl.css" >

  
</head>

<body>
    
    
<div class="baner">
    
    <h2>Lista twoich zadań</h2>
    
</div> 


<?php 
session_start();
session_name("logowanie");

include("dostep-lista.php"); 

  $check = $_COOKIE["login"];

              $_SESSION["error"] = "";
              
             $iduser = $mysqli->query("SELECT id FROM uzytkownicy WHERE  login= '$check'")->fetch_object()-> id;
             

             if($query = $mysqli->query("SELECT * FROM lista WHERE userid = '$iduser' ORDER BY id")) {
    
   
    
    
    
    if ($query->num_rows>0) {
        echo '<table>';
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>Treść zadania</td>";
        echo "<td>Data dodania </td>";
        echo "<td>Data wykonania</td>";
        echo "<td>Priorytet</td>";

        echo "</tr>";
        
        while ($row = $query->fetch_object()) {
            $id =  $row->id ;
            
            echo "<tr>";
            
            echo "<td><p class=\"checked\">" . $row->id . "</p></td>";
            echo "<td><p class=\"checked\">" . $row->tresc . "</p></td>";
            echo "<td><p class=\"checked\">" . $row->data_dodania . "</p></td>";
            echo "<td><p class=\"checked\">" . $row->data_wykonania . "</p></td>";
            echo "<td><p class=\"checked\">" . $row->priorytet . "</p></td>";
            echo "<td><input type=\"checkbox\" /></td>";
            echo "<td><a href=\"edit-lista.php?id=$id?userid=$iduser\" >Edytuj (niestety nie działa)</a></td>";
            echo "<td><a href=\"delete-lista.php?id=$id\" >Usuń</a></td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
             
             }    



         
        

           
               $mysqli->close();
               
    echo "<div class=\"add-div\"><a  class=\"add\" href=\"add-lista.php?userid=$iduser\" >Dodaj zadanie</a></div>";
    echo "<div class=\"add-div\"><a  class=\"add\" href=\"logout.php\" >Wyloguj</a></div>";    
?>
</body>
</html>

