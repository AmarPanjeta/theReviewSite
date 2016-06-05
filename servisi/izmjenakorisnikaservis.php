<?php
  if(isset($_REQUEST['id']) && isset($_REQUEST['username']) && isset($_REQUEST['datum']) && isset($_REQUEST['imeprezime'])){
    if(!empty($_REQUEST['id']) && !empty($_REQUEST['username']) && !empty($_REQUEST['datum']) && !empty($_REQUEST['imeprezime'])){
      $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
      $veza->exec("set names utf8");
      $postojiusername = $veza -> query("SELECT COUNT(*) from korisnik where username='".$_REQUEST['username']."'")->fetchColumn();
      if($postojiusername==0){
        $rezultat = $veza->query("UPDATE korisnik SET username='".htmlentities($_REQUEST['username'])."', imeprezime='".htmlentities($_REQUEST['imeprezime'])."', datumrodjenja='".$_REQUEST['datum']."' where id=".$_REQUEST['id']);
        if($rezultat) echo "Uspjesno ste izmjenili podatke o korisniku!";
        else echo "Izmjene nisu sacuvane.";
      }
      else{
        $korisnikkojisemijenja = $veza -> query("SELECT COUNT(*) from korisnik where username='".$_REQUEST['username']."' AND id=".$_REQUEST['id'])->fetchColumn();
        if($korisnikkojisemijenja==1){
          $rezultat = $veza->query("UPDATE korisnik SET username='".htmlentities($_REQUEST['username'])."', imeprezime='".htmlentities($_REQUEST['imeprezime'])."', datumrodjenja='".$_REQUEST['datum']."' where id=".$_REQUEST['id']);
          if($rezultat) echo "Uspjesno ste izmjenili podatke o korisniku!";
          else echo "Izmjene nisu sacuvane.";
        }
        else echo "Korisnicko ime je vec zauzeto.";
      }
    }
    else echo "Niste ispunili sva polja!";
  }
  else echo "Neispravan zahtjev! Niste ispunili sva polja!";
 ?>
