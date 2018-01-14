<?php 
session_start();
session_name("logowanie");
include("dostep-lista.php"); 

function createForm($tresc ="", $data1 = "", $data2 = "", $priorytet = "", $userid = "", $status = "", $error ="", $id="") { ?>


<!DOCTYPE HTML>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../styl.css" >
 
  
</head>

<body>
   

<form action="" method="post">
        <input type="hidden" name="id" value= "<?php echo $id; ?>" /> 
        <label>Treść: </label><input type="text" name="tresc"/> <br>
        <label>Data wykonania: </label><input type="date" name="data2"/> <br>
        <label>Priorytet: </label><input maxlength="2" type="number" name="priorytet"/> <br>
        
        <input type="submit" name="add" value="Dodaj" />
</form>

<span class="error"><?php echo $error; ?></span>

</body>

<?php }
 ?>

<?php 

     if(isset($_POST["add"])) {
         
                 $userid = $_GET["userid"];

                $tresc = htmlentities($_POST["tresc"], ENT_QUOTES);
                $data1 = date("Y-m-d");
                $data2 = htmlentities($_POST["data2"], ENT_QUOTES);
                $priorytet = htmlentities($_POST["priorytet"], ENT_QUOTES);
                $status = 0;
                
          if($tresc == ""  || $data2 == "" || $priorytet == "") {
                    
                    $error = "Uzupełnij puste pole";
                    createForm($tresc, $data1, $data2, $priorytet, $userid, $status, $error, $id); 
                    
                }
                
                
                else {
                    
                    if ($query = $mysqli -> prepare("INSERT lista (tresc,data_dodania,data_wykonania,priorytet,userid,status) VALUES (?,?,?,?,?,?)")) {
                        
                        $query -> bind_param ("sssiii", $tresc, $data1, $data2, $priorytet, $userid, $status);
                        $query -> execute();
                        $query -> close();
                        
                    } else {
                        echo "błąd";
                    }
                       header("Location: show-lista.php");  
                }
                
            } else {
                
            createForm(); 

            }
         
         

 $mysqli->close();

?>

</html>