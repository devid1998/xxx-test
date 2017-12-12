<!DOCTYPE HTML>
<head>
  <meta charset="UTF-8">
</head>

<body>
    
    
    
</body>


<?php 

include("dostep.php"); 

if($result = $mysqli->query("SELECT * FROM Contacts ORDER BY id")) {
    
    if ($result->num_rows>0) {
        
        echo "<table>";
        echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>Imię</td>";
        echo "<td>Nazwisko</td>";
        echo "<td>Adres</td>";
        echo "<td>Telefon</td>";
        echo "</tr>";
        
        while ($row = $result->fetch_object()) {
            $id =  $row->id ;
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->imie . "</td>";
            echo "<td>" . $row->nazwisko . "</td>";
            echo "<td>" . $row->adres . "</td>";
            echo "<td>" . $row->telefon . "</td>";
            echo "<td><a href=\"edit.php?id=$id\" >Edytuj</a></td>";
            echo "<td><a href=\"delete.php?id=$id\" >Usuń</a></td>";
            echo "</tr>";
            
            

        }
        
        echo "</table>";
    }
    else {
        
        echo "Błąd rekordów";
        
    }
    
   
}
$mysqli->close();
?>

<a href="edit.php">Dodaj Nowy</a>
 
</html>