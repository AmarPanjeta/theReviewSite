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
  <div class="filter-stranice">
    <span>Filter novosti:</span>
    <ul>
      <li><a href="index.php">Po datumu</a></li>
      <li><a href="index.php?sortiranje=abc">Abecedno</a></li>
    </ul>
  </div>



  <div class="glavni-citav autovisina">
    <?php
      function poredjenjeDatuma($a,$b){
        $t1 = strtotime($a[2]);
        $t2 = strtotime($b[2]);
        return $t2- $t1;
      }

      function poredjenjeNaslova($a,$b){
        return strcmp($a[0],$b[0]);
      }

      if(file_exists ( "data/news.csv" )){


      $file = fopen("data/news.csv","r");
      $novosti = array();
      while(!feof($file)){
        if(!feof($file)){
          $element = fgetcsv($file);
          if($element[0]!='')$novosti[]=$element;
        }
      }
      fclose($file);
      if(isset($_REQUEST['sortiranje']) && $_REQUEST['sortiranje']=="abc") usort($novosti,"poredjenjeNaslova");
      else usort($novosti,"poredjenjeDatuma");
        $otvoreno=false;
        for($i=0;$i<count($novosti);$i++){
            if($i%3==0){
              print '<div class="red">';
              $otvoreno = true;
            }
            $date = new DateTime($novosti[$i][2]);
            $datestring = $date->format('Y-m-d H:i:s');
            $datestring = str_replace(" ","T",$datestring);
            print  '<div id="clanak_'.$datestring.'" class="red-element">';
            print    '<img src="'.$novosti[$i][1].'" alt="kritika" />';
            print    '<p>';
            print     $novosti[$i][0].' - '.$novosti[$i][5]; // Nedjelja navecer - B. Krsulovic
            print    '</p>';
            print    '<p class="vrijeme-objave">';
            print    '</p>';
            print  '</div>';

            if($i%3==2){
              print "</div>";
              $otvoreno = false;
            }
        }
        if($otvoreno){
          print "</div>";
        }
      }
     ?>
  </div>

</div>

  </body>
</html>
