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

 
    
    </form>
</div> 


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
  $log = "SELECT * FROM Account WHERE Email = '?'";
  $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

$conn = new mysqli($servername, $username, $password, $dbname ); 

$stmt = $conn->prepare("SELECT Password FROM Account WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
$stmt->bind_result($hash);
$stmt->fetch();





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










    