<?php
  session_start();
  if(isset($_POST['vrsta']) && isset($_POST['zahtjevid']) && isset($_POST['tekst'])){
    if(!empty($_POST['vrsta']) && !empty($_POST['zahtjevid']) && !empty($_POST['tekst'])){
      $autor = "gost";
      $novostid = $_POST['zahtjevid'];
      if(isset($_SESSION['user'])) $autor=$_SESSION['user'];
      if($_POST['vrsta']=="komentar"){
        $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
        $veza->exec("set names utf8");
        $mogucedodati = $veza ->query("SELECT COUNT(*) from novost where id=".$novostid." AND komentari=1")->fetchColumn();
        if($mogucedodati!=0) $upitnovikomentar = $veza -> query("INSERT INTO komentar SET autor='".$autor."', novostid=".$_POST['zahtjevid'].", teks='".$_POST['tekst']."', novikomentar=1");
      }
      else{
        $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
        $veza->exec("set names utf8");
        $upitroditeljkomentar = $veza -> query("SELECT id, novostid from komentar where id=".$_POST['zahtjevid']);
        $roditeljkomentar = $upitroditeljkomentar ->fetch();
        $mogucedodati = $veza ->query("SELECT COUNT(*) from novost where id=".$roditeljkomentar['novostid']." AND komentari=1")->fetchColumn();
        if($mogucedodati!=0) $upitnovikomentar = $veza -> query("INSERT INTO komentar SET autor='".$autor."', novostid=".$roditeljkomentar['novostid'].", teks='".$_POST['tekst']."', odgovornakomentar=".$roditeljkomentar['id'].", novikomentar=1");
        $novostid = $roditeljkomentar['novostid'];
      }
    }
  }
  header('Location: ' . "../novost.php?id=".$novostid."&uspjeh=1", true, 303);
  die();
 ?>