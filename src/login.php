<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
 <style>
 h1 {text-align: center;}
    form {text-align: center;}
    label {text-align: center;}
</style>

  
    
<div  id="box"> 

  <h1 style="color:black;">Login</h1>

  <form action="Login.php" method="post" >

	<input class="textInput" type="email" name='email' placeholder="E-mail">   <br>
	<input class="textInput" type="password" name='password' placeholder="Wachtwoord">  <br><br>

  <input type="submit" name='knop' value="Login" >

</div>  
    
    </form>



</div>

</body>
</html>


<?php 
$servername = "mysql";
$username = "root";
$password = "password";
$dbname = "forms";


if(isset($_POST['knop']) ){ 
  $email = $_POST["email"];
  $wachtwoord = $_POST["password"];
  $log = "SELECT * FROM Account WHERE Email = '$email'";
  $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

$conn = new mysqli($servername, $username, $password, $dbname ); 

if($email == $log){
  echo'log in succesvol';
}
else{
  echo'werkt niet';
}

}
    

?>




    




   







<!--







-->










    