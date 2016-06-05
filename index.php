<!DOCTYPE html>
<?php
session_start();
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pocetna strana</title>
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
    <script src="skriptica.js" charset="utf-8"></script>
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
          print '<a href="dodavanje.php">Nova novost</a>';
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
  <div class="filter-stranice">
    <span>Filter novosti:</span>
    <ul>
      <li onclick="sakrij(1)">Danasnje</li>
      <li onclick="sakrij(2)">Ove sedmice</li>
      <li onclick="sakrij(3)">Ovog mjeseca</li>
      <li onclick="sakrij(4)">Sve novosti</li>
    </ul>
  </div>
  <div class="filter-stranice">
    <span>Filter novosti:</span>
    <ul>
      <li><a href="index.php">Po datumu</a></li>
      <li><a href="index.php?sortiranje=abc">Abecedno</a></li>
    </ul>
  </div>



  <div class="glavni-citav autovisina">
     <?php
        $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
        $veza->exec("set names utf8");
        $rezultat = null;
        if(isset($_REQUEST['autor']) && is_numeric($_REQUEST['autor'])) $rezultat = $veza -> query("SELECT id, autorid, naslov, url, datum FROM novost WHERE autorid=".$_REQUEST['autor']);
        else if(isset($_REQUEST['sortiranje']) && $_REQUEST['sortiranje']=="abc")$rezultat = $veza -> query("SELECT id, autorid, naslov, url, datum FROM novost ORDER BY naslov asc");
        else $rezultat = $veza -> query("SELECT id, autorid, naslov, url, datum FROM novost");

        $brojac = 0;
        $otvoreno = false;
        foreach ($rezultat as $novost) {
          $upitautor=$veza -> query("SELECT imeprezime from korisnik where id=".$novost['autorid'].";");
          $autor=$upitautor ->fetch();
          if($brojac%3==0){
            print '<div class="red">';
            $otvoreno = true;
          }
          $date = $novost['datum'];
          //$datestring = $date->format('Y-m-d H:i:s');
          $datestring = str_replace(" ","T",$date);
          print  '<div id="clanak_'.$datestring.'" class="red-element" onclick="location.href=\'novost.php?id='.$novost['id'].'\';" style="cursor: pointer;">';
          print    '<img src="'.$novost['url'].'" alt="kritika" />';
          print    '<p>';
          print     $novost['naslov'].' - '.$autor['imeprezime']; // Nedjelja navecer - B. Krsulovic
          print    '</p>';
          print    '<p class="vrijeme-objave">';
          print    '</p>';
          print  '</div>';

          if($brojac%3==2){
            print "</div>";
            $otvoreno = false;
          }
          $brojac++;
        }
        if($otvoreno){
          print "</div>";
        }
      ?>
  </div>

</div>
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
