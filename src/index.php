<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <?php 
  
  $hoi ="hoe gaat het<br>";
  echo $hoi;

  for($x = 0; $x <= 5; $x++){
    echo "met Lee-Ann <br>";
  }

  $kleur = array("rood","groen","blauw");
  echo $kleur[0], $kleur[1], $kleur[2] ;

  include 'partials/dbconnection.php';



  ?>

</body>

</html>