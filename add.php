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


  </head>
  <body>
<div class="container">
  <?php

$nimi = htmlspecialchars(trim($_GET['nimi']));
 $pere = htmlspecialchars(trim($_GET['pere']));
 $klass = htmlspecialchars(trim($_GET['klass']));
 $email = htmlspecialchars(trim($_GET['email']));

// Kontrollime, kas kõik väljad on täidetud
if ($nimi && $pere && $klass && $email) {
    // Kontrollime, kas kasutaja on juba registreeritud
    $kontroll_paring = "SELECT * FROM uuemoisa WHERE email = '$email'";
    $tulemus = $yhendus->query($kontroll_paring);

    if ($tulemus->num_rows > 0) {
        echo "Kasutaja e-posti aadress '$email' on juba registreeritud.";
    } else {
        // Registreerime kasutaja
        $paring = "INSERT INTO uuemoisa (nimi, pere, klass, email) VALUES ('$nimi', '$pere', '$klass', '$email')";
        if ($yhendus->query($paring) === true) {
            echo "Kasutaja '$nimi $pere $klass' on edukalt registreeritud.";
        } else {
            echo "Kasutaja registreerimine ebaõnnestus: " . $yhendus->error;
        }
    }
} else
 //Ć¼henduse sulgemine
 mysqli_close($yhendus); 
?>
<h2>Võistleja lisamine</h2>
        <!-- Registration Form -->
        <form>
            <div class="form-group">
                <label >Eesnimi</label>
                <input type="text" class="form-control" name="nimi" required>
            </div>
            <div class="form-group">
                <label >Perenimi</label>
                <input type="text" class="form-control" name="pere" required>
            </div>
            <div class="form-group">
                <label >Võistlusklass</label>
                <input type="number" class="form-control" name="klass" value="1" min="1" max="100" required>
            </div>
            <div class="form-group">
                <label >Email</label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Lisa uus võistleja</button>
        </form>
        <a href="admin.php"><button type="button" class="btn btn-success">Tagasi</button></a>
</div>
</body>
</html>
