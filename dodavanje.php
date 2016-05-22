<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ' . "index.php", true, 303);
  die();
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
                print '<a href="login.php?action=logout">Logout</a>';
              }
              else{
                print '<a href="login.php">Login</a>';
              }
             ?>
          </nav>
        </div>

      <div class="glavni-citav autovisina">
        <h1>Dodavanje novosti</h1>
        <h3 id="poruka">Poruka</h3>
        <form class="forma-kontakt" action="dodavanjeservis.php" method="post">

          <div class="grupa-unos">
            <label>Naslov novosti</label>
            <input id="naslov_polje" type="text" name="title" value=""><br>
          </div>

          <div class="grupa-unos">
            <label>Autor</label>
            <input id="autor_polje" type="text" name="author" value=""><br>
          </div>

          <div class="grupa-unos">
            <label>URL slike:</label>
            <input id="url_polje" type="text" name="url" value=""><br>
            <small>*Napomena: Preporucuje se da su slike velicine 400x270 zbog ispravnog prikaza i crno-bijele zbog konzistencije sa dizajnom</small>
          </div>

          <div class="grupa-unos">
            <label>Drzava(dvoslovni kod):</label>
            <input id="drzava_polje" type="text" name="ccode"  onblur="drzavaPozivniValidacija()"><br>
          </div>

          <div class="grupa-unos">
            <label>Telefon:</label>
            <input id="telefon_polje" type="text" name="telephone" value="" onblur="drzavaPozivniValidacija()"><br>
          </div>

          <input id="dodaj" class="dugme" type="submit" value="Dodaj">
          <div class="cistimo-float"></div>
        </form>
      </div>

    </div>
    <script src="validacijenovost.js"></script>
  </body>
</html>

<!-- onkeyup="telefonValidacija(this.value)"
