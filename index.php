<?php include('config.php'); ?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uuemõisa Miil 2023</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
        <a class="navbar-brand" href="#">Uuemõisa Miil</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Avaleht</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="galerii.php">Galerii</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kontakt.php">Kontakt</a>
                </li>
            </ul>
            <a class="btn btn-success mx-lg-2 my-2 d-xs-block" href="login.php">Logi sisse</a>
        </div>
    </nav>
    <div class="p-5 text-center bg-image rounded-3" style="
    background-image: url('https://wmimg.azureedge.net/public/img/marathons/marathon-de-montpellier/marathon-de-montpellier_5_marathon-de-montpellier.jpg?c=1574936301');
    height: 400px;
  ">
  <div  style="background-color: rgba(0, 0, 0, 0.2);">
    <div class="d-flex justify-content-center align-items-center h-100 text-center">
      <div class="text-white text-center">
        <h1 class="mb-3">Uuemõisa Miil 2023</h1>
      </div>
    </div>
  </div>
</div>
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
<div class="container">
<h2>Registeerimine</h2>
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
            <button type="submit" class="btn btn-primary">Registreeri</button>
        </form>
</div>
</div>