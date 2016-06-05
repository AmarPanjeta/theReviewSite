<!DOCTYPE html>
<?php
session_start();
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Podstranica sa linkovima</title>
    <link rel="stylesheet" type="text/css" href="stil.css">
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="logo2.css" media="screen" title="no title">
    <!-- font-family: 'Josefin Sans', sans-serif;
    font-family: 'Oswald', sans-serif;
    font-family: 'Montserrat', sans-serif;
    font-family: 'Poiret One', cursive;
  -->
  </head>
  <body>
<!--                     LOGO                     -->
    <div class="baza">
      <div class="most">
        <div class="most1">
        </div>
      </div>
      <div class="okvir desno">
      </div>
      <div class="okvir lijevo">
      </div>
      <div class="rub" id="lijevi-rub">
      </div>
      <div class="rub" id="desni-rub">
      </div>
      <div class="gumica" id="lijeva-gumica">
      </div>
      <div class="gumica" id="desna-gumica">
      </div>
    </div>
<!--                     KRAJ LOGOa                    -->

    <div class="stranica">
        <div class="navpozicija">
          <nav class="navigacija">
            <a href="index.php">NASLOVNICA</a>
            <a href="tabela.php">Tabela</a>
            <a href="kontakt.php">Kontakt</a>
            <a href="linkovi.php">Linkovi</a>
            <?php
              if(isset($_SESSION['user'])){
                print '<a href="dodavanje.php?action=logout">Nova novost</a>';
                print '<a href="mojenovosti.php">Moje novosti <span id="broj-novosti"></span></a>';
                if($_SESSION['admin']==1) print '<a href="panel.php">Panel</a>';
                else print '<a href="promjenasifre.php">Promjena sifre</a>';
                print '<a href="login.php?action=logout">Logout</a>';
              }
              else{
                print '<a href="login.php">Login</a>';
              }
             ?>
          </nav>
        </div>
      <div class="glavni-citav autovisina">

        <div class="novost-okvir">
          <?php
            if(isset($_GET['id']) && is_numeric($_GET['id'])){
              $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
              $veza->exec("set names utf8");
              $upit = $veza -> query("SELECT id, autorid, naslov, url, tekst, komentari, datum FROM novost where id=".$_GET['id']);
              $novost = $upit -> fetch();
              if($novost!=null){
                $upitautor = $veza -> query("SELECT id,imeprezime,username FROM korisnik where id=".$novost['autorid']);
                $autor = $upitautor->fetch();
                if(isset($_SESSION['user']) && $_SESSION['user']==$autor['username']){
                  $upitnisunovikomentari = $veza->query("UPDATE komentar set novikomentar=0 where novostid=".$_GET['id']);
                }
                print '<img src="'.$novost['url'].'" alt="x"/>';
                print '<div class="novost-autor-info">';
                print 'Autor: '.$autor['imeprezime'].'<br>';
                print 'Username: <a href=index.php?autor='.$autor['id'].'>'.$autor['username'].'</a><br>';
                print 'Vrijeme objave: '.$novost['datum'];
                print '</div>';
                print '<p>';
                print '<strong>Naslov: '.$novost['naslov'].'</strong><br>';
                print $novost['tekst'];
                print '</p>';

                print '<div>';
                $upitkomentari =  $veza -> query("SELECT id, novostid, odgovornakomentar, teks , autor FROM komentar where novostid=".$_GET ['id']." AND odgovornakomentar IS NULL");
                if($upitkomentari!=false){
                $komentari = $upitkomentari -> fetchAll();
                if($komentari!=null){
                print '<span class="odvajac"></span>';
                print '<strong>Komentari:</strong>';
                foreach ($komentari as $komentar) {
                  print '<br><br><span style="text-decoration:underline">Broj komentara: #'.$komentar['id'].'</span><br>';
                  print '<span>Komentar: '.$komentar['teks'].'</span><br>';
                  print '<span>Autor: '.$komentar['autor'].'</span><br>';
                  $upitbrojodgovora = $veza -> query("SELECT COUNT(id) from komentar where odgovornakomentar=".$komentar ['id']);
                  $brojodgovora= $upitbrojodgovora->fetch()[0];
                  if($brojodgovora!=0) print '<span>Broj odgovora: '.$brojodgovora.' <a id="prikazi_'.$komentar['id'].'" class="prikazi-komentare" onclick="prikaziKomentare('.$komentar['id'].')">Prikazi komentare/Dodaj odgovor</a><a id="sakrij_'.$komentar['id'].'"  class="prikazi-komentare" onclick="sakrijKomentare('.$komentar['id'].')">Sakrij komentare</a></span>';
                  else {
                    print '<span>Komentar nema odgovora <a id="prikazi_'.$komentar['id'].'" class="prikazi-komentare" onclick="prikaziKomentare('.$komentar['id'].')">Dodaj odgovor</a></span><br>';
                    if($novost['komentari']){
                    print '<br><div id="odgovori_'.$komentar['id'].'" class="odgovori_'.$komentar['id'].'" style="margin-left:10%; width:50%">';
                    print '<strong>Ostavi odgovor na komentar:</strong><br>';
                    print '<form action="servisi/komentariredirectservis.php" method="post">';
                    print '<div class="grupa-unos">';
                    print '<label>Tekst</label>';
                    print '<input id="tekst_polje" type="text" name="tekst" value=""><br>';
                    print '</div>';
                    print '<input id="novost_polje" type="hidden" name="zahtjevid" value="'.$komentar['id'].'">';
                    print '<input id="vrsta_polje" type="hidden" name="vrsta" value="odgovor">';
                    print '<input class="dugme" type="submit" value="Komentarisi">';
                    print '</form>';
                    print '</div>';
                    }
                  }

                  $upitodgovori = $veza -> query("SELECT id, novostid, odgovornakomentar, teks , autor FROM komentar where odgovornakomentar=".$komentar ['id']);
                  if($upitkomentari!=null){

                      $odgovori = $upitodgovori -> fetchAll();

                      if(count($odgovori)>0) {

                        print '<div id="odgovori_'.$komentar['id'].'">';
                        print '<span> Odgovori na ovaj komentar: </span><br>';
                        foreach ($odgovori as $odgovor) {
                          print '<br><span style="margin-left:10%; text-decoration:underline">Broj komentara: #'.$odgovor['id'].'</span><br>';
                          print '<span style="margin-left:10%">Komentar: '.$odgovor['teks'].'</span><br>';
                          print '<span style="margin-left:10%">Autor: '.$odgovor['autor'].'</span><br>';
                        }
                        if($novost['komentari']){
                        print '<br><div style="margin-left:10%; width:50%">';
                        print '<strong>Ostavi odgovor na komentar:</strong><br>';
                        print '<form action="servisi/komentariredirectservis.php" method="post">';
                        print '<div class="grupa-unos">';
                        print '<label>Tekst</label>';
                        print '<input id="tekst_polje" type="text" name="tekst" value=""><br>';
                        print '</div>';
                        print '<input id="novost_polje" type="hidden" name="zahtjevid" value="'.$komentar['id'].'">';
                        print '<input id="vrsta_polje" type="hidden" name="vrsta" value="odgovor">';
                        print '<input class="dugme" type="submit" value="Komentarisi">';
                        print '</form>';
                        print '</div>';
                        }
                        print '</div>';
                      }
                    }
                  }

                  }
                }
                if($novost['komentari']){
                print '<span class="odvajac"></span>';
                print '<strong>Ostavi komentar:</strong><br>';
                print '<form action="servisi/komentariredirectservis.php" method="post">';
                print '<div class="grupa-unos">';
                print '<label>Tekst</label>';
                print '<input id="tekst_polje" type="text" name="tekst" value=""><br>';
                print '</div>';
                print '<input id="novost_polje" type="hidden" name="zahtjevid" value="'.$_GET['id'].'">';
                print '<input id="vrsta_polje" type="hidden" name="vrsta" value="komentar">';
                print '<input class="dugme" type="submit" value="Komentarisi">';
                print '</form>';
                }
                else{
                  print '<span class="odvajac"></span>';
                  print '<strong>Nije moguce ostavljati komentare na ovu novost</strong><br>';
                }
                print '</div>';
              }
              else{
                print "<h2>Vijest ne postoji</h2>";
              }
            }
            else{
              print "<h2>Nije proslijedjen nikakav parametar za novost</h2>";
            }
           ?>
        </div>
      </div>

    </div>
    <script src="js/novostprikaz.js" charset="utf-8"></script>
    <script src="js/ajaxkomentari.js"></script>
    <?php
    if(isset($_SESSION['id'])){
      print "<script>";
      print "window.setInterval(function(){
        brojkomentara(".$_SESSION['id'].");
      },350)";
      print "</script>";
    }
     ?>
  </body>
</html>
