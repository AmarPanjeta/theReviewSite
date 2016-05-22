window.onload=function () {
/*  postavljanjeDatuma=[prijeNSekundi(11),prijeNMinuta(1),prijeNMinuta(11),prijeNSati(1),prijeNSati(5),prijeNSati(22),prijeNDana(1),prijeNDana(7),prijeNDana(28)]
  elementi=document.getElementsByClassName('red-element');
  for(var i=0;i<elementi.length;i++) elementi[i].id="clanak_"+postavljanjeDatuma[i];*/
  postaviDatume();
}

function prijeNSekundi(n){
  sad = new Date();
  sad.setTime(sad.getTime()-n*1000);
  return sad.toString();
}

function prijeNMinuta(n){
  sad = new Date();
  sad.setTime(sad.getTime()-n*1000*60);
  return sad.toString();
}

function prijeNSati(n){
  sad = new Date();
  sad.setTime(sad.getTime()-n*1000*60*60);
  return sad.toString();
}

function prijeNDana(n){
  sad = new Date();
  sad.setTime(sad.getTime()-n*1000*60*60*24);
  return sad.toString();
}

function sakrij(kriterij){
  sad=new Date()
  idjevi=document.getElementsByClassName('red-element');
  for(var i=0;i<idjevi.length;i++){
    if(kriterij==1){
      datum=new Date(idjevi[i].id.split('_')[1]);
      console.log(datum);
      if(danas(datum,sad)) idjevi[i].style.display="inline-block";
      else idjevi[i].style.display="none";
    }
    if(kriterij==2){
      datum=new Date(idjevi[i].id.split('_')[1]);
      console.log(datum);
      if(uOvojSedmici(datum)) idjevi[i].style.display="inline-block";
      else idjevi[i].style.display="none";
    }
    if(kriterij==3){
      datum=new Date(idjevi[i].id.split('_')[1]);
      console.log(datum);
      if(uIstomMjesecu(datum,sad)) idjevi[i].style.display="inline-block";
      else idjevi[i].style.display="none";
    }
    if(kriterij==4){
      idjevi[i].style.display="inline-block";
    }
  }
}

function danas(datum,referent){
  return datum.getFullYear()==referent.getFullYear() && datum.getMonth()==referent.getMonth() && datum.getDate()==referent.getDate();
}

function uOvojSedmici(datum){
  d1=new Date();
  prviDan=new Date();
  prviDan.setSeconds(1);
  prviDan.setMinutes(0);
  prviDan.setHours(0);
  zadnjiDan=new Date();
  zadnjiDan.setSeconds(59);
  zadnjiDan.setMinutes(59);
  zadnjiDan.setHours(23);
  while(prviDan.getDay()!=1) {prviDan.setTime(prviDan.getTime()-24*3600*1000);}
  while(zadnjiDan.getDay()!=0) {zadnjiDan.setTime(zadnjiDan.getTime()+24*3600*1000);}
  console.log(prviDan);
  console.log(zadnjiDan);
  return prviDan<=datum && zadnjiDan>=datum;
}

function uIstomMjesecu(datum,referent) {
  return datum.getMonth()==referent.getMonth() && datum.getFullYear()==referent.getFullYear();
}


function vrijemeTekst(datum, referent){
  tekst="Novost je objavljena ";
  razlika=Math.abs(referent.getTime()-datum.getTime());
  console.log(razlika);
  if(datum>referent) tekst+=" u buducnosti!"
  else if((razlika/1000)<60){
    tekst+="prije par sekundi";
  }
  else if((razlika/1000>=60) && (razlika/(1000*60))<60){
    x=Math.floor(razlika/(1000*60))
    tekst+="prije " + x +" minut";
    if(x % 10 != 1 ||x==11 ) tekst+='a';
  }
  else if((razlika/(1000*60)>=60) && (razlika/(1000*60*60))<24){
    x=Math.floor(razlika/(1000*60*60))
    tekst+="prije " + x +" sat";
    if((x >= 2 && x <=4) || (x > 21 && x<=23)) tekst+='a';
    else if(x!=1 && x!=21) tekst+='i';
  }
  else if((razlika/(1000*60*60)>=24) && (razlika/(1000*60*60*24))<7){
    x=Math.floor(razlika/(1000*60*60*24))
    tekst+="prije " + x +" dan";
    if(x!=1) tekst+='a';
  }
  else if((razlika/(1000*60*60*24)>=7) && (razlika/(1000*60*60*24))<30){
    x=Math.floor(razlika/(1000*60*60*24*7))
    tekst+="prije " + x +" sedmic";
    if(x==1) tekst+='u';
    else tekst+='e'
  }
  else{
    tekst+=datum.getDate()+'/'+(datum.getMonth()+1)+'/'+datum.getFullYear();
  }
  return tekst;
}

function postaviDatume(){
  sad=new Date();
  novosti=document.getElementsByClassName("vrijeme-objave");
  datumi=document.getElementsByClassName("red-element")
  for(var i=0;i<novosti.length;i++){
    dateString=datumi[i].id.split('_')[1];
    novosti[i].innerHTML=vrijemeTekst(new Date(dateString),sad);
  }
}
