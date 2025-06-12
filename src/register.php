<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <link rel="stylesheet" href="register.css">
</head>
<body>

  <div class="form-wrapper">
    <div class="form-box">
      <h1>Register</h1>

      <form action="register.php" method="post">
        <input class="textInput" type="email" name="email" placeholder="E-mail" required><br>
        <input class="textInput" type="password" name="password" placeholder="Wachtwoord" required><br>
        <input class="submitButton" type="submit" name="knop" value="Register">
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

$conn = new mysqli($servername, $username, $password, $dbname);  

if (isset($_POST['knop'])) {
    $email = $_POST["email"];
    $wachtwoord = $_POST["password"];

    if (empty($email)) {
        echo "Email is niet ingevoerd";
    } elseif (empty($wachtwoord)) {
        echo "Wachtwoord is niet ingevoerd";
    } else {
        
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

        
        $stmt = $conn->prepare("INSERT INTO Account (Email, Password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hash);

        try {
            $stmt->execute();
            echo "Account is geregistreerd.";
        } catch (mysqli_sql_exception $e) {
            echo "Registratie mislukt: " . $e->getMessage();
        }

        $stmt->close();
    }
}
?>
    