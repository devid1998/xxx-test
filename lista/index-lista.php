<?php 

include("podstrony/dostep-lista.php"); 

session_start();
session_name("podstrony/logowanie");

?>
 
<!DOCTYPE HTML>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="styl.css" >
 
  
</head>

<body>
    
    
    <h1>Zaloguj się do naszej aplikacji:</h1>
    
    <div class="form">
    <form action="podstrony/show.php" method="post">
         
        <label>Login: </label><input type="text" name="login"/> <br>
        <label>Hasło: </label><input type="password" name="password"/> <br>
        <input type="submit" name="log-in" value="Zaloguj" />
        
        <span class="error"><?php echo  $_SESSION["error"];  ?></span>
</form>

        <h2><a href="podstrony/add.php" class="register">Zarejestruj się</a></h2>


</div>


</body>

 
</html>
