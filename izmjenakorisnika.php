<?php
session_start();
if(!isset($_SESSION['user'])){
  header('Location: ' . "index.php", true, 303);
  die();
}

 ?>
<?php
  if(isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])){
    $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
    $veza->exec("set names utf8");
    $upitkorisnik = $veza -> query("SELECT id, username, imeprezime, datumrodjenja from korisnik where id=".$_REQUEST['id']);
    $korisnik = $upitkorisnik -> fetch();
  }
  else{
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
        <h1>Izmjena korisnika</h1>
        <h3 id="poruka">Poruka</h3>
        <form class="forma-kontakt" action="dodavanjeservis.php" method="post">

          <div class="grupa-unos">
            <label>Username:</label>
            <input id="username_polje" type="text" name="title" value="<?php if(isset($korisnik)) print $korisnik['username']; ?>"><br>
          </div>



          <div class="grupa-unos">
            <label>Ime i prezime</label>
            <input id="imeprezime_polje" type="text" name="url" value="<?php if(isset($korisnik)) print $korisnik['imeprezime']; ?>"><br>
          </div>

          <div class="grupa-unos">
            <label>Datum rodjenja</label>
            <input id="datum_polje" type="text" name="url" value="<?php if(isset($korisnik)) print $korisnik['datumrodjenja']; ?>" placeholder="dd/mm/YYYY"><br>
          </div>

          <input id="korisnikid_polje" type="hidden" name="korisnikid" value="<?php if(isset($korisnik)) print $korisnik['id']; ?>">

          <input id="izmjeni" class="dugme" type="submit" value="Izmjeni">
          <div class="cistimo-float"></div>
        </form>
      </div>

    </div>
    <script src="js/izmjenakorisnika.js"></script>
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
