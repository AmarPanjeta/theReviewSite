function brojkomentara(id) {
  var con = new XMLHttpRequest();
  con.onreadystatechange = function() {
    if (con.readyState == 4 && con.status == 200) {
      document.getElementById('broj-novosti').innerHTML=con.responseText;
     console.log(con.responseText);
    };
  }
con.open("get", "servisi/brojnovihkomentaraservis.php?autor="+id, true);
con.send();
}