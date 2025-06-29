<?php 
session_start();

$loginError = "";

include 'database.php';


if(isset($_POST['knop']) ){ 
  $email = $_POST["email"];
  $wachtwoord = $_POST["password"];
  $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
  

$stmt = $conn->prepare("SELECT Password FROM Account WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedWachtwoord);
        $stmt->fetch();

        if (password_verify($wachtwoord, $hashedWachtwoord)) {
            $_SESSION['email'] = $email;
            header("Location: account.php");
            exit;
        } else {
            $loginError = "Verkeerd wachtwoord";
        }
    } else {
        $loginError = "Geen account gevonden";
    }

    $stmt->close();
    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="login.css">
  <title>Document</title>
</head>
<body>
  
 <style>
 h1 {text-align: center;}
    form {text-align: center;}
    label {text-align: center;}
</style>

  
<div class="achtergrond">
<div  class="box"> 

  <h1>Login</h1>

  <form action="Login.php" method="post" >
    <?php if (!empty($loginError)) echo "<p style='color:red;'>$loginError</p>"; ?>


	<input class="textInput" type="email" name='email' placeholder="E-mail">   <br>
	<input class="textInput" type="password" name='password' placeholder="Wachtwoord">  <br><br>

  <input class="button" type="submit" name='knop' value="Login" >
  <a href='register.php'>Nog geen account? Klik dan op mij :D</a>

 
    
    </form>
</div> 
</div>

</div>

</body>
</html>