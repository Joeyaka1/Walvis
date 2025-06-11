<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
</head>
<body>
  
 <style>
 h1 {text-align: center;}
    form {text-align: center;}
    label {text-align: center;}
</style>

  
    
<div  id="box"> 

  <h1 style="color:black;">Register</h1>

  <form action="register.php" method="post" >

	<input class="textInput" type="email" name='email' placeholder="E-mail" >   <br>
	<input class="textInput" type="password" name='password' placeholder="Wachtwoord">  <br><br>

    <input type="submit" name='knop' value="Register" >

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


$conn = new mysqli($servername, $username, $password, $dbname );  

  
if(isset($_POST['knop']) ){
       $email = $_POST["email"];
       $wachtwoord = $_POST["password"];
       

        if(empty($email)){
            echo "email is niet ingevoerd";
        }
        elseif(empty($wachtwoord)){
            echo"password is niet ingevoerd";
        }
        else
        {
            echo"hallo <br>";
            echo $_POST["email"];
            $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
            $sql = "INSERT INTO Account (Email, Password) VALUES ('$email', '$hash')";
            
        try
            {
                mysqli_query($conn, $sql);
                echo'Het werkt';
            }
            catch(mysqli_sql_exception){
                echo'werkt niet';
            }
        }


        
        
    }

?>