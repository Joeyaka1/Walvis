<?php

include 'database.php';  

if (isset($_POST['knop'])) {
    $email = $_POST["email"];
    $wachtwoord = $_POST["password"];
    $name = $_POST["name"];

    if (empty($email)) {
        echo "Email is niet ingevoerd";
    } elseif (empty($wachtwoord)) {
        echo "Wachtwoord is niet ingevoerd";
    } else {
        
        $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);

        
        $stmt = $conn->prepare("INSERT INTO Account (Email, Password, Username) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $hash, $name);

        try {
            $stmt->execute();
            header("Location: login.php?melding=succes");
                exit;
        } catch (mysqli_sql_exception $e) {
            echo "Registratie mislukt: " . $e->getMessage();
        }

        $stmt->close();
    }
}
?>

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
        <input class="textInput" type="text" name="name" placeholder="Username" required>
        <input class="textInput" type="email" name="email" placeholder="E-mail" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}"
               title="Geen geldig E-mail (moet een '@' en '.' bevatten)"
               required><br>
        <input class="textInput" type="password" name="password" placeholder="Wachtwoord" required><br>
        <input class="submitButton" type="submit" name="knop" value="Register">
        <a href='login.php'>Heb je een account? Klik dan op mij :D</a>
      </form>
    </div>
  </div>

</body>
</html>




    