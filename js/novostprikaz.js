function prikaziKomentare(id){
  elementid="odgovori_"+id;
  document.getElementById(elementid).style.display='block';
  linkid="prikazi_"+id;
  document.getElementById(linkid).style.display='none';
  linkid="sakrij_"+id;
  document.getElementById(linkid).style.display='inline';
}

function sakrijKomentare(id){
  elementid="odgovori_"+id;
  document.getElementById(elementid).style.display='none';
  linkid="sakrij_"+id;
  document.getElementById(linkid).style.display='none';
  linkid="prikazi_"+id;
  document.getElementById(linkid).style.display='inline';
}