<?php
  if(isset($_REQUEST['title']) && isset($_REQUEST['url']) && isset($_REQUEST['ccode']) && isset($_REQUEST['telephone']) && isset($_REQUEST['author'])){
    if(!empty($_REQUEST['title']) && !empty($_REQUEST['url']) && !empty($_REQUEST['ccode']) && !empty($_REQUEST['telephone']) && !empty($_REQUEST['author'])){
      $news= array(htmlentities($_REQUEST['title']),htmlentities($_REQUEST['url']),date('D M d Y H:i:s O'),htmlentities($_REQUEST['ccode']),htmlentities($_REQUEST['telephone']),htmlentities($_REQUEST['author']));
      $file=fopen("data/news.csv","a");
      if(fputcsv($file,$news)){
        fclose($file);
        echo "Uspjesno ste dodali novost";
      }
      else{
        fclose($file);
        echo "Dodavanje novosti nije uspjelo";
      }
    }
    else echo "Niste ispunili sva polja!";
  }
  else echo "Neispravan zahtjev! Niste ispunili sva polja";
 ?>
