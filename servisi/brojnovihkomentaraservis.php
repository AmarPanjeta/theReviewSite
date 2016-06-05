<?php
if(isset($_REQUEST['autor']) && is_numeric($_REQUEST['autor'])){
  $veza = new PDO("mysql:dbname=spirala4;host=localhost;charset=utf8", "spirala4", "spirala4");
  $veza->exec("set names utf8");
  $upitnovosti = $veza->query("SELECT id, autorid from novost where autorid=".$_REQUEST['autor']);
  $novosti=$upitnovosti->fetchAll();
  $brojnovih=0;
  foreach ($novosti as $novost) {
    $upitbrojnovosti= $veza -> query("SELECT count(*) from komentar where novostid=".$novost['id']." AND novikomentar=1");
    $brojnovosti = $upitbrojnovosti->fetchColumn();
    $brojnovih+=$brojnovosti;
  }
  print $brojnovih;
}
?>
