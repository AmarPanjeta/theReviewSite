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

function validirajPassword(validiraj){
  if(validiraj.length==0) {
    document.getElementById("poruka").innerHTML = "Potrebno je unijeti password!";
    document.getElementById('poruka').style.display="block";
    return false;
  }
  regprazno=/\s/;
  if(validiraj.match(regprazno)!=null) {
    document.getElementById("poruka").innerHTML = "Password ne moze sadrzavati razmake!";
    document.getElementById('poruka').style.display="block";
    return false;
  }
  return true;
}

document.getElementById('poruka').style.display="none";

document.getElementById('dodaj').addEventListener("click", function(event){
  validno = true;
  event.preventDefault();
  username=document.getElementById('username_polje').value;
  imeprezime=document.getElementById('imeprezime_polje').value;
  datum=document.getElementById('datum_polje').value;
  pw1=document.getElementById('pw1_polje').value;
  pw2=document.getElementById("pw2_polje").value;
  if(!validirajUsername(username)) return;
  if(!validirajImeIPrezime(imeprezime)) return;
  if(!validirajDatumRodjenja(datum)) return;
  if(!validirajPassword(pw1)) return;
  if(pw1!=pw2) {
    document.getElementById("poruka").innerHTML = "Passwordi se ne poklapaju!";
    document.getElementById('poruka').style.display="block";
    return;
  }
  var con = new XMLHttpRequest();
  con.onreadystatechange = function() {
  if (con.readyState == 4 && con.status == 200) {
     document.getElementById("poruka").innerHTML = con.responseText;
     console.log(con.responseText);
     document.getElementById('poruka').style.display="block";
     if(con.responseText=="Uspjesno ste dodali korisnika!"){
       document.getElementById('username_polje').value="";
       document.getElementById('imeprezime_polje').value="";
       document.getElementById('datum_polje').value="";
       document.getElementById('pw1_polje').value="";
       document.getElementById("pw2_polje").value="";
     }
    }
  };
  con.open("POST", "servisi/dodavanjekorisnikaservis.php?username="+username+"&password="+pw1+"&datum="+datum+"&imeprezime="+imeprezime, true);
  con.send();
  //alert("validno!");
});