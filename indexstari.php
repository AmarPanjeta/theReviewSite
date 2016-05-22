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
          print '<a href="dodavanje.php?action=logout">Nova novost</a>';
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
  <div class="glavni-citav autovisina">
    <h1>Novosti:</h1>
    <div class="red">
      <div id='clanak_2016-04-03T19:41:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg06.jpg" alt="kritika" />
        <p>
          Nedjelja navecer - B. Krsulovic
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>

      <div id='clanak_2016-04-01T12:00:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg07.jpg" alt="kritika" />
        <p>
          ‘Citizen Kane’ is superb: 1941 movie review
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>

      <div  id='clanak_2016-04-25T12:00:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg08.jpg" alt="kritika" />
        <p>
          Tormentni toranj - A. B. Cvitek
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>

    </div>
    <div  class="red">
      <div id='clanak_2015-03-25T12:00:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg09.jpg" alt="kritika" />
        <p>
          Pozoriste apsurda - Nepoznat autor
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>
      <div id='clanak_2016-04-02T12:00:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg01.jpg" alt="kritika" />
        <p>
          Tvoje oci gledaju unutra - kritika na djelo "Razgovori na Nilu"
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>
      <div id='clanak_2016-03-02T12:00:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg02.jpg" alt="kritika" />
        <p>
          Kritika romana Ante Tomića, 'Veličanstveni Poskokovi'
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>
    </div>
    <div  class="red">
      <div id='clanak_2016-04-03T18:00:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg04.jpg" alt="kritika" />
        <p>
          The social network - Par godina kasnije...
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>
      <div id='clanak_2016-04-04T12:00:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg03.jpg" alt="kritika" />
        <p>
          Naslovi ispod svakodnevnih slika - A. B. Cvitek
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>
      <div id='clanak_2015-03-25T12:11:00' class="red-element">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg05.jpg" alt="kritika" />
        <p>
          Morphine - Cure for Pain
        </p>
        <p class="vrijeme-objave">

        </p>
      </div>
    </div>
  </div>

</div>

  </body>
</html>
