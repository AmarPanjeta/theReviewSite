README za Spiralu 4 iz predmeta Web Tehnologije

Kako bi projektni zadatak uradjen za spiralu 4 bio funkcionalan, 
potrebno je prvo osposobiti bazu podataka. Potrebno je u 
phpmyadmin napraviti novu bazu sa imenom "spirala 4", te korisnika
ciji je username "spirala4" i password "spirala4". Nakon toga je 
potrebno odabrati tu bazu i pokrenuti skriptu pod nazivom 
"spirala4dump.sql". Ova skripta ce kreirati potrebne tabele i 
ispuniti ih podacima, nakon cega je moguce koristiti  stranicu.

Sve stavke za ovaj projektni zadatak su implementirane i ispod ce
biti opisano gdje ih je moguce pronaci:

- Zadatak 1. Potrebno je osmisliti i kreirati bazu podataka tako da:

    Možete spašavati novosti
    Možete spašavati autore
    Komentare na novosti

Svaka novost ima svog autora.
U PHP-u napravite da se novosti ucitavaju iz baze i spašavaju u nju, 
listu novosti koju ste imali na prošloj vježbi sada prikazujte koristeci 
podatke iz baze. Prilikom unošenja novosti sada ponudite autoru da 
odabere da li je data novost otvorena za komentare ili ne. 


+ Strukturu baze je moguce vidjeti iz skripte za kreiranje ili u 
  phpmyadminu nakon sto se skripta pokrene. 
+ Novosti koje se ocitavaju iz baze se vidi na pocetnoj stranici 
  (http://localhost/thereviewsite/ ili
  http://thereviewsites4-wtphp.rhcloud.com/ ) ili pritiskom na 
  tab novosti
+ dodavanje nove novosti se radi tako sto se prijavi sa nekim 
  korisnickom racunom (dostavljena su 2 razlicita racuna
  1. un:admin pw:admin i 2. un:amar pw: amar) i nakon toga se 
  pritisne na nova novost. Tu je potrebno ispuniti sva polja.
  Takodjer, tu se vidi i mogucnost odabira opcije da li je 
  novost otvorena za komentare ili ne.

- Zadatak 2. Napravite detaljni prikaz novosti koji se otvara klikom 
na novost. Detaljni prikaz novosti nudi mogucnost komentarisanja, 
koliko to autor nije zabranio. Komentare mogu unositi svi korisnici 
(i gosti i autori). Omogucite korisnicima i odgovore na komentare 
(komentar na komentar).Na detaljnom prikazu novosti dodajte jedan 
link koji ce kao tekst imati naziv autora, a pri kliku na dati link 
prikažite sve novosti datog autora. Nacin prikazivanja novosti jednog 
autora se ne smije razlikovati od pocetnog prikazivanja novosti. I dalje 
klik na novost treba da otvara detalje date novosti.

+ detaljan prikaz novosti se otvara tako sto se pritisne bilo gdje unutar
  pravougaonika koji prikazuje novosti na naslovnici
+ ukoliko je novost otvorena za komentare, novi komentar se dodaje na dnu 
  stranice gdje pise "Ostavi komentar:". Nakon unosa komentara u polje 
  "Tekst" i pritiska na dugme "Komentarisi" komentar se dodaje na novost. 
+ omoguceno je komentarisanje i logovanim i nelogovanim korisnicima. U 
  U slucaju da se komentar ostavi kao logovani korisnik, u polje autor
  se upisuje username od tog korisnika. U suprotnom se kao autor upisuje
  "gost".
+ Odgovori na komentar su omoguceni ako novost ima neke komentare. Oni 
  se dodaju tako sto se na nekom komentaru na detaljnom prikazu pritisne
  opcija "Prikazi komentare/Dodaj odgovor" odnosno "Dodaj odgovor", u 
  zavisnosti od toga koja opcija je ponudjena. Nakon toga se ispod 
  komentara prikazuje forma za unos odgovora, na kojoj se slijedi ista 
  procedura kao i za dodavanje komentara.
+ Na detaljnom prikazu se prikazuje i username autora u vidu hiperlinka. 
  Kada se pritisne na username autora, prikaze se lista svih njegovih novosti, 
  slicna listi novosti na naslovnici. 


Zadatak 3. Periodicnim pozivanjem, koristeci AJAX-a provjeravajte da li je 
neko ostavio komentar na vjest autora koji je trenutno loginovan. Ukoliko jeste 
prikažite notifikaciju negdje u headeru stranice. Ukoliko ima više odgovora 
prikažite broj. Ovaj broj umanjite kada autor otvori detaljniji prikaz novosti 
koja sadrži navedene komentare. Pazite na situaciju kada postoji više novosti 
sa neprocitanim komentarima. Da bi autoru bilo lakše pronaci novost koja ima 
neprocitane komentare stavite u prikazu svake novosti i njen broj neprocitanih 
komentara (ukoliko ih ima). Dodajte u meniu link 'moje novosti', ukoliko autor 
nije prijavljen navedeni link se ne treba vidjeti. Ovah link ce otvarati novosti 
koje je kreirao prijavljeni autor.

+ Na tabu "Moje novosti" se prikazuje broj sa zutom podlogom, Taj broj predstavlja
  broj novih komentara na novosti autora koji je logovan i to je broj koji se dobija
  periodicnim ajax pozivima. 
+ Pritiskom na tab "Moje novosti" se prikazuje lista svih novosti koje je kreirao
  logovani korisnik. Tu je moguce vidjeti i broj novih komentara na neku novost, te 
  otici na detaljan prikaz novosti pritiskom na Naslov novosti. Ova akcija smanjuje broj 
  novih komentara na novost, jer autor dolazi na stranicu gdje se nalaze svi komentari za 
  datu novost. Takodjer, smanjivanje broja se vrsi i kada autor novost otvori sa
  naslovnice.


Zadatak 4. Vaša stranica treba da ima jednog administratora i autore kao korisnike 
koji se mogu prijaviti. Administrator je jedan (možete njegove podatke direktno upisati
u bazu) i on upravlja kreiranjem, brisanjem i editovanjem autora. Administrator treba
imati i mogucnost brisanja novosti i komentara, kao i promjene da li je novost otvorena
za komentare. Predpostavite da autori dobiju svoje korisnicke podatke od administratora.
Omogucite autorima da promijene svoju šifru kada se prijave. 

+ stranica ima jednog administrator ciji su pristupni podaci un:admin pw:admin. Nakon 
  logovanja sa ovin nalogom, prikazuje se tab "Panel". Pritiskom na ovaj tab se dolazi 
  na prikaz spiska korisnika (na kojem su opcije izmjene i brisanja korisnika). 
  Sa ovog prikaza je moguce odabrati i opcije za dodavanje korisnika, prikaz liste 
  novosti uz mogucnost brisanja i promjene statusa da li je otvorena za komentare i 
  prikaz liste komentara uz mogucnost brisanja, sto   pokriva sve funkcionalnosti navedene 
  za administratora. 
+ u slucaju da se loguje kao obicni korisnik (postoji jedan korisnik pored administratora
  sa pristupnim podacima un:amar pw:amar), prikazuje se tab "Promjena sifre". Pritiskom na
  ovaj tab se dolazi na stranicu na kojoj je moguce izvrsiti promjenu sifre. 


Zadatak 5. Napravite web servis koji ce vracati najviše x novosti datog autora u JSON formatu
(x i autor su parametri servisa). Dati web servis treba biti u skladu sa REST principima

+ servis se nalazi na linku http://localhost/thereviewsite/servisi/vijestiautoraservis.php
  odnosno http://thereviewsites4-wtphp.rhcloud.com/servisi/vijestiautoraservis.php i primjer
  koristenja servisa je 
  http://localhost/thereviewsite/servisi/vijestiautoraservis.php?autor=1&x=10



Sve pomenute funkcionalnosti je moguce isprobati i na openshiftu, na linku 
http://thereviewsites4-wtphp.rhcloud.com