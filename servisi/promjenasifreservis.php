<?php
  if(isset($_REQUEST['username']) && isset($_REQUEST['starasifra']) && isset($_REQUEST['novasifra'])){
    if(!empty($_REQUEST['username']) && !empty($_REQUEST['starasifra']) && !empty($_REQUEST['novasifra'])){
      $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
      $veza->exec("set names utf8");
      $upit = $veza->query("SELECT id,username,password from korisnik where username='".$_REQUEST['username']."';");
      $korisnik = $upit -> fetch();
      if($korisnik['password']!=md5($_REQUEST['starasifra'])) echo "Neispravna stara sifra!";
      else{
        $upitizmjena = $veza->query("UPDATE korisnik SET password='".md5($_REQUEST['novasifra'])."' WHERE id=".$korisnik['id'].";");
        if($upitizmjena) echo "Uspjesno ste izmijenili sifru!";
        else echo "Promjena sifre neuspjesna!";
      }
    }
    else echo "Niste ispunili sva polja!";
  }
  else echo "Neispravan zahtjev! Niste ispunili sva polja";
 ?>
