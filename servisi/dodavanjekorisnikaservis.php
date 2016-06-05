<?php
  if(isset($_REQUEST['username']) && isset($_REQUEST['password']) && isset($_REQUEST['datum']) && isset($_REQUEST['imeprezime'])){
    if(!empty($_REQUEST['username']) && !empty($_REQUEST['password']) && !empty($_REQUEST['datum']) && !empty($_REQUEST['imeprezime'])){
      $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
      $veza->exec("set names utf8");
      $postojikorisnik = $veza -> query("SELECT COUNT(*) from korisnik where username='".$_REQUEST['username']."'")->fetchColumn();
      if($postojikorisnik==0){
        $rezultat = $veza->query("INSERT INTO korisnik SET username='".htmlentities($_REQUEST['username'])."', password='".md5(htmlentities($_REQUEST['password']))."', admin=0, imeprezime='".htmlentities($_REQUEST['imeprezime'])."', datumrodjenja='".$_REQUEST['datum']."';");
        if($rezultat) echo "Uspjesno ste dodali korisnika!";
        else echo "Korisnik nije sacuvan.";
      }
      else echo "Korisnicko ime je vec zauzeto.";
    }
    else echo "Niste ispunili sva polja!";
  }
  else echo "Neispravan zahtjev! Niste ispunili sva polja!";
 ?>
