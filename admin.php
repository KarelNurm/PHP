<?php include('config.php'); ?>
<!doctype html>
<html lang="en">
  <head>
       <script language="JavaScript" type="text/javascript">
      function checkDelete(){
          return confirm('Oled sa kindel?');
        }
      </script>
        <style type="text/css">
        body {
        background-image: url('<?php echo $wall_paper;?>');
        }
        </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Uuemõisa miil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
      <!-- Responsive navbar-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Avaleht</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    </ul>
                    <a class="btn btn-success mx-lg-2 my-2 d-xs-block" href="add.php">Lisa</a>
                    <a class="btn btn-danger mx-lg-2 my-2 d-xs-block" href="logout.php">Logi välja</a>
                </div>
            </div>
        </nav>
        
        <!-- Page content-->
        <div class="container mt-5">
            
            <div class="row">
                <div class="col-lg-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="" scope="col">#</th>
                            <th class="" scope="col">Nimi</th>
                            <th class="" scope="col">Perekonnanimi</th>
                            <th class="" scope="col">Võistlusklass</th>
                            <th class="" scope="col">Email</th>
                            <th class="" scope="col">Muuda</th>
                            <th class="" scope="col">Kustuta</th>
                        </tr>
                    </thead>
                    <tbody>
                    </div>



                  <?php
                  if (!empty($_GET['otsi'])) {
                    //kasutaja tekst vormist
                    $otsi = $_GET['otsi'];
                    $otsi = htmlspecialchars(trim($otsi));
                    //päring
                    $paring = 'SELECT * FROM uuemoisa WHERE nimi LIKE "%'.$otsi.'%" OR pere LIKE "%'.$otsi.'%"';
                    $valjund = mysqli_query($yhendus, $paring);
                    $tulemusi = mysqli_num_rows($valjund);
                    echo 'Otsingusõna: '.$otsi.'<br>';
                    echo 'Vastused: '.$tulemusi.' <br>';
                    if ($tulemusi == 0) {
                        echo "Leiti 0 vastust!";
                        }
                }

            else{
                    $paring = 'SELECT * FROM uuemoisa';
                }
               # print_r($paring);
                $jarjekord = 0;
                    $valjund = mysqli_query($yhendus, $paring);
                    //päringu vastuste arv
                    $tulemusi = mysqli_num_rows($valjund);
                    while($rida = mysqli_fetch_assoc($valjund)){
                        $jarjekord += 1;
                     //   print_r($rida);
                     echo "<tr>";
                     echo "<th>".$jarjekord."</th>";
                     echo "<td>".$rida["nimi"]."</td>";
                     echo "<td>".$rida["pere"]."</td>";
                     echo "<td>".$rida["klass"]."</td>"; 
                     echo "<td>".$rida["email"]."</td>";
                     echo "<td>".'<a href="edit.php?muuda='.$rida['id'].'"><button type="button" class="btn btn-success">Muuda</button></a>'."</td>";
                     echo '<td><a class="btn btn-danger" href="'.$_SERVER['PHP_SELF'].'?id='.$rida["id"].'" onclick="return checkDelete()">Kustuta</a></td>';
                     echo "</tr>  ";
                    }
                    if(!empty($_GET['id'])){
                        //kustutamise päringud
                        $id = $_GET['id'];
                        $kustuta_paring = "DELETE FROM uuemoisa WHERE id='$id'";
                        $kustuta_valjund = mysqli_query($yhendus, $kustuta_paring);
                        if($kustuta_valjund){
                            echo "Rida kustutatud!";
                            echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.$_SERVER['PHP_SELF'].'">';
                        } else {
                            echo "Viga kustutamisel!";
                        }
                    }
                    mysqli_free_result($valjund);
                    mysqli_close($yhendus);

                    ?>
  </tbody>
</table>
                </div>
                <!-- Side widgets-->

                <div class="col-lg-4">
                    <!-- Search widget-->      
                    <form class="d-flex">
                        <input class="form-control me-2 ms-2" type="search" placeholder="Otsi" aria-label="search" name="otsi">
                        <button class="btn btn-outline-success" type="submit">Otsi</button>
                    </form>
                </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy;</p></div>
        </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
