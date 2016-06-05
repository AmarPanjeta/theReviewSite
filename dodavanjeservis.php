<?php
  session_start();
  if(isset($_REQUEST['naslov']) && isset($_REQUEST['url']) && isset($_REQUEST['tekst']) && isset($_REQUEST['komentari'])){
    if(!empty($_REQUEST['naslov']) && !empty($_REQUEST['url']) && !empty($_REQUEST['tekst'])){
      $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
      $veza->exec("set names utf8");
      $rezultat = $veza->query("INSERT INTO novost SET autorid=".$_SESSION['id'].", naslov='".htmlentities($_REQUEST['naslov'])."',url='".$_REQUEST['url']."', tekst='".htmlentities($_REQUEST['tekst'])."', komentari=".$_REQUEST['komentari'].",datum='".date('Y-m-d H:i:s')."';");
      if($rezultat) echo "Uspjesno ste dodali novost!";
      else echo "Novost nije sacuvana.";
    }
    else echo "Niste ispunili sva polja!";
  }
  else echo "Neispravan zahtjev! Niste ispunili sva polja";
 ?>
