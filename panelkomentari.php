<?php
session_start();
if(!isset($_SESSION['user']) || !isset($_SESSION['admin']) || $_SESSION['admin']!=1){
  header('Location: ' . "index.php", true, 303);
  die();
}

 ?>
<?php
  if(isset($_REQUEST['obrisi'])){
    $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
    $veza->exec("set names utf8");

    $upitbrisanjeodgovori = $veza -> query ("DELETE FROM komentar WHERE odgovornakomentar=".$_REQUEST['obrisi']);
    $upitbrisanjeokomentar = $veza -> query ("DELETE FROM komentar WHERE id=".$_REQUEST['obrisi']);

  }
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Podstranica sa kontakt formom</title>
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
          <span>Opcije:</span>
          <ul>
            <li><a href="panel.php">Korisnici</a></li>
            <li><a href="novikorisnik.php">Dodavanje korisnika</a></li>
            <li><a href="panelnovosti.php">Novosti</a></li>
            <li><a href="panelkomentari.php">Komentari</a></li>
          </ul>
        </div>
      <div class="glavni-citav autovisina">
        <h1>Admin panel</h1>
        <h3>Komentari </h3>
        <?php

          print "<table>";
          print "<tr>";
          print "<th>ID</th>";
          print "<th>Autor</th>";
          print "<th>Tekst</th>";
          print "<th>Odgvor na</th>";
          print "<th>Opcije</th>";

          print "</tr>";
          $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
          $veza->exec("set names utf8");
          $rezultat = $veza ->query("SELECT id,autor, teks, odgovornakomentar from komentar");

          foreach ($rezultat as $komentar) {
            print "<tr>";
            print "<td>".$komentar['id']."</td>";
            print "<td>".$komentar['autor']."</td>";

            print "<td>".$komentar['teks']."</td>";
            if($komentar['odgovornakomentar']==0)   print "<td>  </td>";
            else print "<td>".$komentar['odgovornakomentar']."</td>";
            print "<td><a href='panelkomentari.php?obrisi=".$komentar['id']."'>Obrisi</a></td>";
            print "</tr>";
          }
          print "</table>";
         ?>
      </div>

    </div>
    <script src="validacijenovost.js"></script>
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

<!-- onkeyup="telefonValidacija(this.value)"
