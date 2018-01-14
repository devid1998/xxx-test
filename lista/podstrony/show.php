
<?php 
session_start();
session_name("logowanie");

include("dostep-lista.php"); 

 $_SESSION["login"] = $_POST['login'];
 $_SESSION["pass"] = $_POST['password'];

  $logincheck = $_SESSION["login"];
  $password = $_SESSION["pass"];

$passwd = password_hash($password, PASSWORD_DEFAULT);

if($query = $mysqli->query("SELECT COUNT(*) FROM uzytkownicy WHERE login= '$logincheck'")-> fetch_array()) {
             if ($query[0] == 0) {
              
               $_SESSION["error"] = "Błąd logowania";
                header("Location: ../index-lista.php");  
          }
    
          if ($query[0] == 1) {
           
 $pass = $mysqli->query("SELECT haslo FROM uzytkownicy WHERE  login= '$logincheck'")->fetch_object()-> haslo;

               if (password_verify( $password , $pass)) {
              setcookie("login", $logincheck);
              
              $_SESSION["error"] = " ";
                             header("Location: show-lista.php");  

               }
          }
          
        

}


         
        

           
               $mysqli->close();
               
?>
</body>
</html>

