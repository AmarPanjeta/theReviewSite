function validirajImeAutora(validiraj){
  validacija = true;
  var regnaslov=/[A-Z][a-zA-Z ]+[a-z]/;
  provjera=validiraj.match(regnaslov);
  if(validiraj.length==0) validacija = false;
  else if(provjera==null) validacija = false;
  else if(provjera[0]!=validiraj) validacija = false;
  return validacija;
}

document.getElementById('dodaj').addEventListener("click", function(event){
    validno = true;
    event.preventDefault();
    title=document.getElementById('naslov_polje').value;
    url=document.getElementById('url_polje').value;
    ccode=document.getElementById('drzava_polje').value;
    telephone=document.getElementById('telefon_polje').value;
    author=document.getElementById("autor_polje").value;

    if(title==""){
      document.getElementById("poruka").innerHTML = "Potrebno je unijeti naslov!";
      document.getElementById('poruka').style.display="block";
      return;
    }
    else if(author==""){
      document.getElementById("poruka").innerHTML = "Potrebno je unijeti ime autora";
      document.getElementById('poruka').style.display="block";
      return;
    }
    else if(url==""){
      document.getElementById("poruka").innerHTML = "Potrebno je unijeti url slike!";
      document.getElementById('poruka').style.display="block";
      return;
    }
    validno = drzavaPozivniValidacija();
    if(!validno){
      return;
    }

    var con = new XMLHttpRequest();
    con.onreadystatechange = function() {
    if (con.readyState == 4 && con.status == 200) {
     document.getElementById("poruka").innerHTML = con.responseText;
     console.log(con.responseText);
     document.getElementById('poruka').style.display="block";
      }
    };
    con.open("POST", "dodavanjeservis.php?title="+title+"&url="+url+"&ccode="+ccode+"&telephone="+telephone+"&author="+author, true);
    con.send();
});

document.getElementById('poruka').style.display="none";

function dvoslovni(validiraj){
  if(validiraj.length>2){
    console.log("da");
    document.getElementById("poruka").innerHTML = "Kod drzave mora biti dvoslovni!";
    document.getElementById('poruka').style.display="block";
    return false;
  }
  else{
    document.getElementById('poruka').style.display="none";
    return true;
  }
}

function drzavaPozivniValidacija(){
  validacija = true;
  dvoslovni = document.getElementById('drzava_polje').value;
  telefon = document.getElementById('telefon_polje').value;
  if(dvoslovni.length>2 || dvoslovni.length==1){
    document.getElementById('poruka').innerHTML="Niste unijeli ispravan format za kod drzave";
    document.getElementById('poruka').style.display="block";
    validacija = false;
  }
  else if(dvoslovni.length==2){
    var con = new XMLHttpRequest();
    con.onreadystatechange=function(){
      if(con.readyState == 4 && con.status == 200){
        drzava=JSON.parse(con.responseText);
        if(drzava[0]!=null){
          validno = false;
          for(kod in drzava[0]['callingCodes']){
            if(telefon.startsWith('+'+drzava[0]['callingCodes'][kod])) validno = true;
          }
          if(validno) {
            document.getElementById('poruka').innerHTML="";
            document.getElementById('poruka').style.display="none";
            validacija = true;
          }
          else{
            document.getElementById('poruka').innerHTML="Broj telefona i kod drzave se ne poklapaju";
            document.getElementById('poruka').style.display="block";
            validacija=false;
          }
        }
        else {
          document.getElementById('poruka').innerHTML="Unijeli ste kod nepostojece drzave";
          document.getElementById('poruka').style.display="block";
          validacija = false;
        }
      }
      else {
        document.getElementById('poruka').innerHTML="";
        document.getElementById('poruka').style.display="block";
        validacija = false;
      }
    }
    con.open("GET","https://restcountries.eu/rest/v1/alpha?codes="+dvoslovni,false);
    con.send();
  }
  else{
    document.getElementById('poruka').innerHTML="Niste unijeli kod drzave";
    document.getElementById('poruka').style.display="";
    validacija = false;
  }
  return validacija;
}
