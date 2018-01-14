<?php 
session_start();
session_name("logowanie");

include("dostep-lista.php"); 

function createForm($userlogin ="", $userpass = "", $error ="", $id="") { ?>


<!DOCTYPE HTML>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../styl.css" >
 
  
</head>

<body>
    
<form action="add.php" method="post">
        <input type="hidden" name="id" /> 
        <label>Login: </label><input type="text" name="login"/> <br>
        <label>Hasło: </label><input type="password" name="password"/> <br>
        <input type="submit" name="add" value="Dodaj" />

</form>

<span class="error"><?php echo $error ?></span>

</body>

<?php } ?>

<?php 

     if(isset($_POST["add"])) {
                
                $userlogin = htmlentities($_POST["login"], ENT_QUOTES);
                $userpass = htmlentities($_POST["password"], ENT_QUOTES);
                
                $hash = password_hash($userpass, PASSWORD_DEFAULT);

         
          if($userlogin == "" || $userpass == "") {
                    
                    $error = "Brak loginu bądź hasła";
                    createForm($userlogin, $userpass, $error, $id); 
                    
                }
                
                
                else {
                    
                    if ($query = $mysqli -> prepare("INSERT uzytkownicy (login,haslo) VALUES (?,?)")) {
                        
                        $query -> bind_param ("ss", $userlogin, $hash);
                        $query -> execute();
                        $query -> close();
                        
                    } else {
                        
                        echo "Błędny typ danych";
                        createForm($userlogin, $userpass, $error, $id); 
                    }
                        
                     header ("Location: ../index-lista.php");
                }
                
            } else {
                
            createForm(); 


            }
         
         

 $mysqli->close();

?>

</html>