<?php
session_start();
if(isset($_POST['action']) && $_POST['action']==="Login"){
  $file = fopen("data/users.txt","r");
  while(!feof($file)){
    $korisnik=fgetcsv($file);
    if($korisnik[0]===$_POST['username']){
      if($korisnik[1]===md5($_POST['password'])){
        fclose($file);
        $_SESSION['user']=$_POST['username'];
        header('Location: ' . "index.php", true, 303);
        die();
      }
    }
  }
  fclose($file);
}
if(isset($_GET['action']) && $_GET['action']==="logout"){
  session_destroy();
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

    <script src="validacije.js"></script>
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
          </nav>
        </div>

      <div class="glavni-citav autovisina">
        <h1>Login</h1>
        <form class="forma-kontakt" action="login.php" method="post">

          <div class="grupa-unos">
            <label>Username:</label>
            <input id="ime_polje" type="text" name="username" value=""><br>
          </div>

          <div class="grupa-unos">
            <label>Password:</label>
            <input id="mail_polje" type="password" name="password" value=""><br>
          </div>

          <input class="dugme" type="submit" name="action" value="Login">
          <div class="cistimo-float"></div>
        </form>
      </div>

    </div>

  </body>
</html>
