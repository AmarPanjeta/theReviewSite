function validirajImeIPrezime(validiraj){
  if(validiraj.length==0) {
    document.getElementById("poruka").innerHTML = "Ime/Prezime ne moze biti prazno!";
    document.getElementById('poruka').style.display="block";
    return false;
  }
  else return true;
}

function validirajDatumRodjenja(validiraj){
  if(validiraj.length==0){
    document.getElementById("poruka").innerHTML = "Niste unijeli datum rodjenja!";
    document.getElementById('poruka').style.display="block";
    return false;
  }
  regDatum = /[0-9]{2}\/[0-9]{2}\/[0-9]{4}/;
  provjera = validiraj.match(regDatum);
  if(provjera!=null){
    if(provjera[0].length==validiraj.length){
      brojevi = validiraj.split('/');
      if(parseInt(brojevi[1])>12 || parseInt(brojevi[1])==0) {
        document.getElementById("poruka").innerHTML = "Neispravan format datuma!";
        document.getElementById('poruka').style.display="block";
        return false;
      }
      mjeseci = [0,31,28,31,30,31,30,31,31,30,31,30,31];
      if(parseInt(brojevi[0])>mjeseci[parseInt(brojevi[1])] || parseInt(brojevi[0])==0) return false;
      return true;
    }
    else{
      document.getElementById("poruka").innerHTML = "Neispravan format datuma!";
      document.getElementById('poruka').style.display="block";
      return false;
    }
  }
  else{
    document.getElementById("poruka").innerHTML = "Neispravan format datuma!";
    document.getElementById('poruka').style.display="block";
    return false;
  }
}

function validirajUsername(validiraj){
  if(validiraj.length==0) {
    document.getElementById("poruka").innerHTML = "Niste unijeli username!";
    document.getElementById('poruka').style.display="block";
    return false;
  }
  regprazno=/\s/;
  if(validiraj.match(regprazno)!=null) {
    document.getElementById("poruka").innerHTML = "Username ne moze sadrzavati razmake!";
    document.getElementById('poruka').style.display="block";
    return false;
  }
  return true;
}


document.getElementById('poruka').style.display="none";

document.getElementById('izmjeni').addEventListener("click", function(event){
  validno = true;
  event.preventDefault();
  username=document.getElementById('username_polje').value;
  imeprezime=document.getElementById('imeprezime_polje').value;
  datum=document.getElementById('datum_polje').value;
  korinikid=document.getElementById('korisnikid_polje').value;
  if(!validirajUsername(username)) return;
  if(!validirajImeIPrezime(imeprezime)) return;
  if(!validirajDatumRodjenja(datum)) return;
  var con = new XMLHttpRequest();
  con.onreadystatechange = function() {
  if (con.readyState == 4 && con.status == 200) {
     document.getElementById("poruka").innerHTML = con.responseText;
     console.log(con.responseText);
     document.getElementById('poruka').style.display="block";
    }
  };
  con.open("POST", "servisi/izmjenakorisnikaservis.php?username="+username+"&datum="+datum+"&imeprezime="+imeprezime+"&id="+korinikid, true);
  con.send();
  //alert("validno!");
});