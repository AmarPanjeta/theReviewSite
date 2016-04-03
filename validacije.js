window.onload=function() {
  odaberiGrad();
}

function validiraj_mail(validiraj){
  var regmail=/[A-Za-z]((\-|\.|\_){0,1}[A-Za-z0-9]+)*\@([A-Za-z]+\.)+[A-Za-z]{2,3}/;
  provjera=validiraj.match(regmail);
  if(validiraj.length==0){
    document.getElementById('mail_polje').style.backgroundColor="white";
  }
  else if(provjera!=null){
    if(provjera[0]==validiraj){
      document.getElementById('mail_polje').style.backgroundColor="white";
    }
    else {
      document.getElementById('mail_polje').style.backgroundColor="orange";
    }
  }
  else {
    document.getElementById('mail_polje').style.backgroundColor="orange";
  }
}

function validiraj_ime(validiraj){
  var regime=/[A-Z][a-z]+(\s[A-Z][a-z]+)+\s*/
  provjera=validiraj.match(regime);
  if(validiraj.length==0){
    document.getElementById('ime_polje').style.backgroundColor="white";
  }
  else if(provjera!=null){
    if(provjera[0]==validiraj){
      document.getElementById('ime_polje').style.backgroundColor="white";
    }
    else {
      document.getElementById('ime_polje').style.backgroundColor="orange";
    }
  }
  else {
    document.getElementById('ime_polje').style.backgroundColor="orange";
  }
}

function validirajTelefon() {
  validiraj=document.getElementById('telefon_polje').value;
  var reggrad;
  if(document.querySelector('select').value=="Sarajevo") reggrad=/033\/\d{3}\-\d{3}/;
  else reggrad=/032\/\d{3}\-\d{3}/;
  provjera=validiraj.match(reggrad);
  if(validiraj.length==0){
    document.getElementById('telefon_polje').style.backgroundColor="white";
  }
  else if(provjera!=null){
    if(provjera==validiraj){
      document.getElementById('telefon_polje').style.backgroundColor="white";
    }
    else {
      document.getElementById('telefon_polje').style.backgroundColor="orange";
    }
  }
  else {
    document.getElementById('telefon_polje').style.backgroundColor="orange";
  }
}

function odaberiGrad(){
  if(document.querySelector('select').value=="Sarajevo") document.getElementById('telefon_polje').placeholder="033/xxx-xxx";
  else document.getElementById('telefon_polje').placeholder="032/xxx-xxx"
}

function izmjeniGrad() {
  odaberiGrad();
  validirajTelefon();
}
