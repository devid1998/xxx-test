<?php 

include("dostep.php"); 

function createForm($imie ="", $nazwisko = "", $adres = "", $telefon = "", $error ="", $id="") { ?>
    
    <!DOCTYPE HTML>
<head>
  <meta charset="UTF-8">
  <title><?php if($id!=""){echo "Edytuj";} else { echo "Dodaj rekord";} ?></title>
</head>

<body>
   
   <h1><?php if($id!=""){echo "Edytuj";} else { echo "Dodaj rekord";} ?></h1> 
    
    <?php if($error!= "") {
        
        echo "<div>" . $error . "</div>"; } ?>
        
    <form action="" method="post">

        <?php if($id!=""){ ?>
        
        <input type="hidden" name="id" value=" <?php echo $id; ?> " />
        <p>ID: <?php echo $id; ?></p>
        <?php } ?>
        
        <label>Imię: </label><input type="text" name="imie" value=" <?php echo $imie; ?>" /> <br>
        <label>Nazwisko: </label><input type="text" name="nazwisko" value=" <?php echo $nazwisko; ?>" /><br>
        <label>Adres: </label><input type="text" name="adres" value=" <?php echo $adres; ?>" /><br>
        <label>Telefon: </label><input type="text" name="telefon" value=" <?php echo $telefon; ?>" /><br>
        
        <input type="submit" name="submit" value="Wyslij" />
   
        
   </form>
    
    <?php }
        if (isset($_GET["id"])) {
            
            // tryb edycji
            
            if(isset($_POST["submit"])) {
                
                if(is_numeric($_GET["id"])) {
                    
                    $id = $_GET["id"];
                    $imie = htmlentities($_POST["imie"], ENT_QUOTES);
                    $nazwisko = htmlentities($_POST["nazwisko"], ENT_QUOTES);
                    $adres = htmlentities($_POST["adres"], ENT_QUOTES);
                    $telefon = htmlentities($_POST["telefon"], ENT_QUOTES);
                    
                     if($imie == "" || $nazwisko == "" || $adres == "" || $telefon == "") {
                         
                         $error = "Wypełnij pola";
                         createForm($imie, $nazwisko, $adres, $telefon, $error);
                         
                     } else {
                         
                         if ($query=$mysqli -> prepare("UPDATE Contacts SET imie=?, nazwisko=?, adres=?, telefon=? WHERE id=?")){
                             
                             $query -> bind_param("sssii", $imie, $nazwisko, $adres, $telefon, $id);
                             $query -> execute();
                             $query -> close();
                             
                         } 
                     
                     }
                     
                     header("Location: index.php"); 
                }
                
                
            } else {
                
                if(is_numeric($_GET["id"]) && $_GET["id"] > 0) {
                    
                    $id=$_GET["id"];
                    if($query=$mysqli->prepare("SELECT * FROM Contacts WHERE id=?")) {
                        
                        $query -> bind_param("i", $id);
                        $query -> execute();
                        $query -> bind_result($id, $imie, $nazwisko, $adres, $telefon);
                        $query -> fetch();
                        createForm($imie, $nazwisko, $adres, $telefon, NULL, $id);
                        $query -> close();
                        
                    } else {
                        
                        echo "BŁĄD";
                        
                    }
                    
                }  else {
                    
                    header("Location: index.php");
                    
                }
                
                
            }
            

            
            
        } else {
            
            // tryb nowego rekordu
            
            if(isset($_POST["submit"])) {
                
                $imie = htmlentities($_POST["imie"], ENT_QUOTES);
                $nazwisko = htmlentities($_POST["nazwisko"], ENT_QUOTES);
                $adres = htmlentities($_POST["adres"], ENT_QUOTES);
                $telefon = htmlentities($_POST["telefon"], ENT_QUOTES);
                
                if($imie == "" || $nazwisko == "" || $adres == "" || $telefon == "") {
                    
                    $error = "wypełnij pole";
                    createForm($imie, $nazwisko, $adres, $telefon, $error, $id); 
                    
                } else {
                    
                    if ($query = $mysqli -> prepare("INSERT Contacts (imie,nazwisko,adres,telefon) VALUES (?,?,?,?)")) {
                        
                        $query -> bind_param ("sssi", $imie, $nazwisko, $adres, $telefon);
                        $query -> execute();
                        $query -> close();
                        
                    } else {
                        
                        echo "błąd";
                        
                    }
                        header ("Location: index.php");
                    
                }
                
            } else {
                
                createForm();
                
            }
            
        }
        $mysqli -> close();
    
    ?>
    
</body>

</html>
    
    



