function validirajPassword(validiraj){
  if(validiraj.length==0) return false;
  regprazno=/\s/;
  if(validiraj.match(regprazno)!=null) return false;
  return true;
}

function isteSifre(validiraj1,validiraj2){
  if(validiraj1!=validiraj2) return false;
  return true;
}

document.getElementById('poruka').style.display="none";

document.getElementById('izmjena').addEventListener("click",function(event){
  event.preventDefault();
  username=document.getElementById('username_polje').value;
  starasifra=document.getElementById('starasifra_polje').value;
  novasifra=document.getElementById('novasifra_polje').value;
  novasifra2=document.getElementById('novasifra2_polje').value;
  if(!validirajPassword(starasifra)) return;
  if(!validirajPassword(novasifra)) return;
  if(!isteSifre(novasifra,novasifra2)) return;
  var con = new XMLHttpRequest();
  con.onreadystatechange = function() {
  if (con.readyState == 4 && con.status == 200) {
   document.getElementById("poruka").innerHTML = con.responseText;
   console.log(con.responseText);
   document.getElementById('poruka').style.display="block";
    }
  };
  con.open("POST", "servisi/promjenasifreservis.php?username="+username+"&starasifra="+starasifra+"&novasifra="+novasifra, true);
  con.send();
})