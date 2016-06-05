<?php
    if(isset($_REQUEST['autor']) && isset($_REQUEST['x'])){
      $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
      $veza->exec("set names utf8");
      $upit= $veza -> query("SELECT id, autorid, naslov, url, tekst, komentari, datum FROM novost WHERE autorid=".$_REQUEST['autor']." order by datum limit ".$_REQUEST['x'].";");
      print "{ \"novosti\": " . json_encode($upit->fetchAll()) . "}";
    }
 ?>