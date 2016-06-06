-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: 127.5.2.130:3306
-- Generation Time: Jun 05, 2016 at 11:56 PM
-- Server version: 5.5.45
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spirala4`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `novostid` int(11) NOT NULL,
  `odgovornakomentar` int(11) DEFAULT NULL,
  `teks` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `autor` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `novikomentar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_komentar_novost1_idx` (`novostid`),
  KEY `fk_komentar_komentar1_idx` (`odgovornakomentar`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `novostid`, `odgovornakomentar`, `teks`, `autor`, `novikomentar`) VALUES
(1, 1, NULL, 'Ovo je odlican album!', 'amar', 1),
(2, 1, 1, 'Istina.', 'gost', 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE IF NOT EXISTS `korisnik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `imeprezime` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `datumrodjenja` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `password`, `admin`, `imeprezime`, `datumrodjenja`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin admin', '01/01/0001'),
(2, 'amar', '36341cbb9c5a51ba81e855523de49dfd', 0, 'Amar Panjeta', '05/02/1994');

-- --------------------------------------------------------

--
-- Table structure for table `novost`
--

CREATE TABLE IF NOT EXISTS `novost` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autorid` int(11) NOT NULL,
  `naslov` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `komentari` tinyint(1) NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_novost_korisnik_idx` (`autorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `novost`
--

INSERT INTO `novost` (`id`, `autorid`, `naslov`, `url`, `tekst`, `komentari`, `datum`) VALUES
(1, 1, 'Morphine - Cure for Pain', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg05.jpg', 'Rijeci su suvisne. ', 1, '2016-06-01 23:27:44'),
(2, 1, 'Tvoje oci gledaju unutra - kritika na djelo &quot;Razgovori na Nilu&quot;', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg01.jpg', 'Mada je bio napisao vi&scaron;e od trides', 1, '2016-06-02 00:10:34'),
(3, 1, 'Naslovi ispod svakodnevnih slika', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg03.jpg', 'Fridrih Niče rodio se 15. oktobra 1844. u Rekenu, blizu Licena, u Saksonskoj, kao sin lokalnog protestantskog paroha. Kad mu je bilo četiri godine, umro mu je otac, pa su napustili selo i pre&scaron;li u Naumburg. Godine 1858. stupio je u čuvenu srednju &scaron;kolu u Pforti, a 1864. godine upisao se na univerzitet u Bonu. Prvobitnu svoju nameru da se posveti teologiji ubrzo je napustio i pre&scaron;ao na klasičnu filologiju. Kad je njegov profesor klasične filologije Ričl pre&scaron;ao iz Bona u Lajpcig, Niče je po&scaron;ao s njim. Tamo se 1865. prvi put upoznao sa spisima Sopenhauerovim, koji je imao presudan uticaj na formiranje njegovog duha. Godine 1868. on se upoznaje sa Rihardom Vaterom, čovekom koji predstavlja jedan od najkrupnijih doživljaja njegova života, s čijim je imenom Ničeovo vezano nerazdvojno. Godine 1869. on biva izabran za vanrednog profesora klasične filologije na univerzitetu u Bazelu i pre doktorske habilitacije. Te iste godine, 17. maja, pada i njegova prva poseta Trib&scaron;enu, gde je Rihard Vagner živeo sa svojom porodicom. Te posete, koje su neobično zbližile ta dva čoveka i inspirisale Ničea za Rođenje tragedije, ostavile su duboka traga na Ničeu i u istoriji ljudskih odnosa važe kao značajna pojava. Deset dana posle prve posete održao je Niče svoje pristupno predavanje &bdquo;О utakmici kod Homera&quot;.', 0, '2016-06-02 00:22:55'),
(4, 2, 'The social network , Par godina kasnije... ', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg04.jpg', 'Istina je da se nista nije desilo par godina kasnije. Hvala na pažnji.', 1, '2016-06-05 14:17:17'),
(5, 2, 'Nedjelja navecer', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg06.jpg', 'Nerazvrstana sjećanja naviru dok zurim u zaslijepljujuću bjelinu otvorenog Word dokumenta. Nekad se pitam rađaju li ideje riječi ili je možda obrnuto? Kako sitnice mogu inicirati kreativnost u znatnijoj mjeri nego ogromne knjige? Ali postavljena pitanja ne garantiraju postojanje odgovora. Vrijeme ide neovisno o upitniku na kraju rečenice. Vjerojatno moramo živjeti u uvjerenju da smo barem malo posebni. Tek siću&scaron;an fragment, zanemariv postotak čovječanstva, unikatan. Ali istovremeno želimo biti slični, kompatibilni, a katkad čak i istovjetni. Čak da u univerzumu i postoje dvije identične stvari, njihova egzistencija može biti posve oprečna. Upravo ta sjećanja, na&scaron;a povijest i iskustva nam daju jedinstven otisak. Unikatan ključ u kojem leže na&scaron;e odluke sutra&scaron;njice. Sve te slike, probuđene iz dubine sinapsi. Nestvarne, a opet tako jasne i opojne. ', 0, '2016-06-05 23:41:29'),
(6, 1, '&lsquo;Citizen Kane&rsquo; is superb - 1941 movie review', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg07.jpg', ' The most talked about picture of the year, Orson Welles&rsquo; production of &ldquo;Citizen Kane,&rdquo; finally had its New York premiere at the Palace theatre last night, where an eager first night audience enthusiastically applauded the young theatrical man&rsquo;s latest achievement.&ldquo;Citizen Kane,&rdquo; the first picture made by Welles to reach the screen, arrived at the Palace only after a major battle of words and wits had been engaged in by the executives of RKO, who released the film, and Welles, on one side, and the legal advisers of William Randolph Hearst, on the other. The latter evidently imagined that the central character of the picture, one Charles Foster Kane, bore an uncomfortably close resemblance of the great California publisher.We are not, however, concerned with the controversy, except to say that the portrait of Kane seems more like a composite of a dozen or more American tycoons, rather than a faithful representation of an individual. We are interested in the picture, however, as a contribution to the screen and in that respect, it is one of the most interesting and technically superior films that has ever come out of a Hollywood studio. Aside from tendency to revert to the inadequate lighting of sets that distinguished primitive Russian, German and French films, Welles has approached his subject matter in an original manner.In the first place, he has done away with the long list of credits that clutter up the beginning of a film, and for this, he has earned our heartfelt gratitude. He begins his story with a March-of-Time-like review of Kane&rsquo;s life, immediately following the publisher&rsquo;s death in his castle-like home. In their search for a punch ending to the picture, the film men assign one of their reporters to interview Kane&rsquo;s most intimate friends and business associates. Thus the story is put together on the screen in piecemeal fashion as bits of information are gleaned from various people and light is thrown on the character of the man by his widow, his best friend and lifelong companion, the business manager of his publishing enterprises and the banker who controlled the purse-strings to his fabulous fortune.', 0, '2016-06-05 23:44:17'),
(7, 2, 'Pozoriste apsurda', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg09.jpg', ' EGZISTENCIJALNO I  POZORI&Scaron;TE APSURDADr. Ilir MuharremiJo&scaron; u staroj Grčkoj se smatralo da je pozori&scaron;te mesto gde se ne&scaron;to vidi, susreće ili spektakl među glumcima, horom i publikom.U to vreme su se igrale tragedije, koje su bile karakteristične za antičku Atinu, ali nije moguće nikako utvrditi tačan datum, kada je nastala tragedija. Eshilova tragedija Persej se može smatrati prvom tragedijom.Teatar služi za predstavljanje tragedija i vekovima je bila inspiracija mnogim autorima koji i danas ljubomorno čuvaju osnovni deo, subjektivnost ličnosti koja je zaista jedinstvena i ostaje u du&scaron;i čitalaca. Ličnosti u tragedijama se poznaju po fatalnom zapletu  beznadežnih situacija, za opis krivca. Filozofija, religija, egzistencija individue karakteri&scaron;e tragično stvaranje. Ali, u modernoj tragediji hor nije prisutan kao  &scaron;to je bio u antičkoj, gde pesmom komentari&scaron;e op&scaron;ti način onoga &scaron;to se de&scaron;ava na sceni. Međutim, danas, hor je udružen sa muzikom konkretno u operi. Ali, postavlja se pitanje, kako funkcionise egzistencijalno pozori&scaron;te? &Scaron;ta je ono u stvari? Ljudi koji najče&scaron;će upotrebljavaju naziv egzistencijalizam ne znaju &scaron;ta da kažu kada treba da objasne su&scaron;tinu naziva, iako se danas vratilo u modu i kada se kaže bez ikakvih lo&scaron;ih namera ovaj muzicar, slikar ili dramaturg je egzistencijalist. Ono &scaron;to zbunjuje je ustvari to &scaron;to postoje dve vrste egzistencijalizma: prvo  hri&scaron;ćani, a među njima navodim Jaspersa i Gabriel Marsela &ndash; katolici, i na drugoj strani egzistencijalisti, ateisti gde navodim Haidegera, egzistencijalisti Francuzi, itd. Razvoj te filozofije nalazimo 1928 . objavljivanjem dela Martina Haidegera &ldquo;Bitisanje i vreme&rdquo;, ali do  potpunog &scaron;irenja dolazi posle Drugog svetskog rata, a naročito posle objavljivanja Sartrovog dela &ldquo; Bitisanje i nistavilo&rdquo;. Egzistencijalizam se bavi vi&scaron;e idealizmom ako se posmatra sa književne strane, ali cilj ima ljudskih oblik na nivou individue koji nije ograničen realnim istorijskim uslovima, koje se smatraju totalnom absurdno&scaron;ću. U nekim filozofskim delima, mnogi mislioci ovu filozofiju egzistencijalizma su nazivali iracionalizmom, koja je suprotnost ni&scaron;tavilu racionalizmu. ', 1, '2016-06-05 23:46:15'),
(8, 2, 'Tormentni toranj', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg08.jpg', 'Jedan je od kraljeva sagradio kulu, ali joj nije dovr&scaron;io vrh. Ljudi su je bez riječi napustili i zanemarili ... Potresi i munje o&scaron;tetili su zdanje; glina se osu&scaron;ila, cigle razdvojile a zemlja nakupila u unutra&scaron;njosti građevine. Ugledni Merodah potaknuo me da obnovim kulu. Temeljno kamenje sam ostavio a ni izgled nisam izmjenio već je on ostao poput onog u stara vremena. Dakle, pronađoh i obnovih kulu. Uzdigao sam je do nebesa.', 0, '2016-06-05 23:50:01'),
(9, 1, 'Kritika romana Ante Tomića, Veličanstveni Poskokovi', 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/placeimg02.jpg', 'Ono na čemu je u ovom romanu naglasak je preobrazba glavnog lika, rečenog Zdeslava, od tatinog sina i ispraznog pripadnika tzv. zlatne mladeži do čovjeka koji u sebi ima i vi&scaron;e nego zrnce morala, hrabrosti i ljubavi. Upravo to izbjegavanje crno-bijelih stereotipa na relaciji bogati-siroma&scaron;ni, uz dakako nevjerojatan smisao za fabuliranje, najvrednija je dionica ovog proznog teksta. Tomić se u svome romanu koji preuzima kostur trilera, a zapravo je punokrvna satira hrvatskog dru&scaron;tva u kojoj su neke stvari namjerno dovedene do ekstrema, vje&scaron;to i neskriveno služi elementima tipičnog trivijalnog romana (ljubavna priča, neočekivani preokreti fabule, intrige, motiv Pepeljuge, izgubljenog sina, pa i nagli happyend), &scaron;to je svakako jedna od potencijalnih udica za čitatelje, ba&scaron; kao i nevjerojatan osjećaj za dinamiku i dramatiku, &scaron;to uostalom ne nedostaje nijednom Tomićevom romanu.', 0, '2016-06-05 23:54:56');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `fk_komentar_komentar1` FOREIGN KEY (`odgovornakomentar`) REFERENCES `komentar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_komentar_novost1` FOREIGN KEY (`novostid`) REFERENCES `novost` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `novost`
--
ALTER TABLE `novost`
  ADD CONSTRAINT `fk_novost_korisnik` FOREIGN KEY (`autorid`) REFERENCES `korisnik` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
