<?php
  $adr = $adr1_class = $adr2_class = '';
  /* Récupération de la langue dans la chaîne get */
  $adr = (isset($_GET['adr']) && file_exists('public/json/'.$_GET['adr'].'.json')) ? $_GET['adr'] : 'adr1';
  /* Définition de la class pour les liens de langue */
  echo ("adr: ".$adr);
  if ($adr == 'adr1')
    $adr1_class = ' class="active"';
  else
    $adr2_class = ' class="active"';
  /* Récupération du contenu du fichier .json */
  $contenu_fichier_json = file_get_contents('public/json/'.$adr.'.json');
  /* Les données sont récupérées sous forme de tableau (true) */
  $tr = json_decode($contenu_fichier_json, true);

  if (isset($_POST['adr1'])) {
    header("Location: contact.php?adr=adr1");
  }
  if (isset($_POST['adr2'])) {
    header("Location: contact.php?adr=adr2");
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
     integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
     crossorigin="">
    <title>npProject</title>
  </head>
  <body onload="showMap(<?php echo $tr['longitude']?>, <?php echo $tr['latitude']?>)">
    <?php require "header.php" ?>
    
    <div class="container" id="mainContainer">
      <h1 id="pageTitel" class="">Contact</h1>

       <!-- Map -->
      <div class="d-flex justify-content-around" >
       
        <div class="col-6" style="border: 1px solid black;">
          <div id="map" style="width: 600px; height: 400px;"></div>
        </div>
      </div>

       <!-- Données Contact -->
      <div class="d-flex justify-content-around" >
        <form method="POST">
          <button type="submit" class="btn btn-info" name="adr1">CJP Genappe</button>
          <button type="submit" class="btn btn-info" name="adr2">CJP Rixensart</button>
        </form>
        <div class="col-6" style="border: 1px solid black;">
          <?php echo $tr['nom']?>
          <?php echo $tr['rue']?>
          <?php echo $tr['localite']?>
          <?php echo $tr['telephone']?>
        </div>
      </div>
    </div>
    
    <?php require "footer.php" ?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>
    <script type="text/javascript">
      function showMap(longitude, latitude) {
        var map = L.map('map').setView([longitude, latitude], 12);
        //var marker = L.marker([50.6, 4.45]).addTo(map); // CJP Genappe
        //var marker = L.marker([50.7167, 4.5333]).addTo(map); // CJP Rixensart
        var marker = L.marker([longitude, latitude]).addTo(map);
        L.tileLayer('https://tile.openstreetmap.be/osmbe/{z}/{x}/{y}.png', {
        attribution:
          '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors' +
          ', Tiles courtesy of <a href="https://geo6.be/">GEO-6</a>',
        maxZoom: 18
        }).addTo(map);
      }

    </script>
  </body>
</html>