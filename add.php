<?php include('config.php'); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="fancybox/jquery.fancybox.css">

<style>


</style>

  </head>
  <body>

  <?php

 $artist = htmlspecialchars(trim($_GET['Nimi']));
 $album = htmlspecialchars(trim($_GET['Perekonnanimi']));
 $aasta = htmlspecialchars(trim($_GET['Võistlusklass']));
 $hind = htmlspecialchars(trim($_GET['Email']));
 $paring = "INSERT INTO Muusikapood(artist,album,aasta,hind) VALUES ('".$Nimi."','".$Perekonnanimi."','".$Võistlusklass."','".$Email."')";
 $valjund = mysqli_query($yhendus, $paring);
 //pĆ¤ringu vastuste arv
 $tulemus = mysqli_affected_rows($yhendus);
 if ($tulemus == 1) {
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin.php">';
 } else {
 echo "Kirjet ei lisatud";
 }
 //Ć¼henduse sulgemine
 mysqli_close($yhendus); 
?>
<h2>Uue albumi lisamine</h2>
<form action="" method="get" enctype="multipart/form-data">
<table>
    <tr><td>Artist: </td><td><input type="text" name="artist" required></td></tr>
    <tr><td>Album:</td><td> <input type="text" name="album" required></td></tr>
    <tr><td>Aasta: </td><td><input type="number" name="aasta" value="2000" min="1900" max="2099" required></td></tr>

    <tr><td>Hind: </td><td><input type="number" name="hind" value="1" min="0.01" max="10000000000000000" step="0.1" required></td></tr>
    <tr><td><input type="submit" value="Lisa uus album"></td><td><input type="reset" value="Tühjenda"></td></tr>
</table>
</form>
</div>
</body>
</html>