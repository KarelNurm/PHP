<?php include('config.php'); ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uuemõisa Miil 2023</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <?php
//haarame aadressiribalt ID, et täita väljad
if(empty($_GET['muuda'])){
 die('Sihtmärk jäi valimata!');
} else {
 $id = $_GET['muuda'];
//väljastamise päring
 $paring = "SELECT * FROM uuemoisa WHERE id='$id'";
 $valjund = mysqli_query($yhendus, $paring);
 $rida = mysqli_fetch_assoc($valjund); 
//muutmise päring
if(!empty($_POST['nimi'])){
 $nimi = htmlspecialchars(trim($_POST['nimi']));
 $pere = htmlspecialchars(trim($_POST['pere']));
 $klass = htmlspecialchars(trim($_POST['klass']));
 $email = htmlspecialchars(trim($_POST['email']));
 $muuda = "UPDATE uuemoisa
 SET nimi='".$nimi."',
 pere='$pere',
 klass='$klass',
 email='$email'
 WHERE id='$id'
 ";
 $muuda_db = mysqli_query($yhendus, $muuda);
 if($muuda_db){
 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin.php">';
 die();
 } else {
 echo "Oli mingi probleem tee korda!";
 }
}
?>
<h2>Uuemõisa Miili andmete muutmine</h2>
<form action="" method="post">
<table>
    <tr><td>Nimi: </td><td><input type="text" name="nimi" required value="<?php echo $rida['nimi']; ?>"></td></tr>
    <tr><td>Perekonnanimi:</td><td> <input type="text" name="pere" required value="<?php echo $rida['pere']; ?>"></td></tr>
    <tr><td>Võistlusklass: </td><td><input type="number" class="form-control" name="klass" value="1" min="1" max="100" required></td></tr>
    <tr><td>Email: </td><td><input type="text" name="email" required value="<?php echo $rida['email']; ?>"></td></tr>
    <tr><td><input type="reset" value="Tühjenda"></td><td><input type="submit" value="MUUDA"></td></tr>
    <tr><td><input type="submit" value="Tagasi"><a href="index.php"></a></td></tr></input></td></tr>
</table>
</form>
<?php
}
?>