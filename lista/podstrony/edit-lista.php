<?php 
session_start();
session_name("logowanie");

function createForm($tresc ="", $data1 = "", $data2 = "", $priorytet = "", $userid = "", $status = "", $error ="", $id="") { ?>


<!DOCTYPE HTML>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../styl.css" >
 
  
</head>

<body>
   

<form action="" method="post">
        <input type="hidden" name="id" value= "<?php echo $id; ?>" /> 
        <label>Treść: </label><input type="text" name="tresc"  value= "<?php echo $tresc; ?>" /> <br>
        <label>Data wykonania: </label><input type="date" name="data2"  value= "<?php echo $data2; ?>" /> <br>
        <label>Priorytet: </label><input type="text" name="priorytet"  value= "<?php echo $priorytet; ?>" /> <br>
        
        <input type="submit" name="change" value="Zmień" />
</form>

<span class="error"><?php echo $error; ?></span>



<?php }


include("dostep-lista.php");

createForm($tresc, $data1, $data2, $priorytet, $userid, $status, $error, $id); 

if(isset($_GET["id"])) {

            if(isset($_POST["change"])) {
                
                 if(is_numeric($_GET["id"])) {
                     
                    $id = $_GET["id"];
                    
                    
                $tresc = htmlentities($_POST["tresc"], ENT_QUOTES);
                $data1 = htmlentities($_POST["data1"], ENT_QUOTES);
                $data2 = htmlentities($_POST["data2"], ENT_QUOTES);
                $priorytet = htmlentities($_POST["priorytet"], ENT_QUOTES);
                $userid = 1;
                $status = 0;


                     if($tresc == "" || $data1 == "" || $data2 == "" || $priorytet == "") {
                    
                    $error = "Brak loginu bądź hasła";
                    createForm($tresc, $data1, $data2, $priorytet, $userid, $status, $error, $id); 
                    
                }
                     
                     else {
                         
                         if ($query=$mysqli -> prepare("UPDATE lista SET tresc=?, data_dodania=?, data_wykonania=?, priorytet=?, userid=?, status=? WHERE id=?")){
                             
                             $query -> bind_param("sssiiii", $tresc, $data1, $data2, $priorytet, $userid, $status, $id);
                             $query -> execute();
                             $query -> close();
                             
                         } 
                     
                     
                     }
          
                 }
                  header("Location: show-lista.php");

            } 
                
   
              
}

$mysqli->close();

?>

</body>
</html>