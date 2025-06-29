<?php if (isset($_GET['message']) && $_GET['message'] === 'verwijderd'): ?>
  <script>
    alert("Je account is succesvol verwijderd.");
  </script>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="frontpage.css">
  <title>Home Page</title>
</head>
<body>
  
<h1>Home Page</h1>

<div id='knopjes'>
  <a href="register.php">Hier kan je registreren</a> 
  <a href="login.php">Hier kan je inloggen</a>

</div>


</body>
</html>



