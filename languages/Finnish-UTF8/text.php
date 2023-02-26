<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Lähdeaineistot";
		$text['shorttitle'] = "Lyhyt nimike";
		$text['callnum'] = "Paikkamerkki";
		$text['author'] = "Kirjoittaja";
		$text['publisher'] = "Julkaisija";
		$text['other'] = "Muut tiedot";
		$text['sourceid'] = "Lähteen ID-numero";
		$text['moresrc'] = "Lisää lähteitä";
		$text['repoid'] = "Tietovaraston ID";
		$text['browseallrepos'] = "Selaa kaikki tietovarastot";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Uusi kieli";
		$text['changelanguage'] = "Vaihda kieltä";
		$text['languagesaved'] = "Kieli vaihdettu";
		$text['sitemaint'] = "Sivuston ylläpito käynnissä";
		$text['standby'] = "Sivusto on tilapäisesti suljettu tietokannan päivittämisen vuoksi. Yritä uudelleen muutaman minuutin kuluttua. Jos sivusto pysyy suljettuna pidemmän aikaa, <a href=\"suggest.php\">ota yhteyttä ylläpitoon</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM alkaen tästä";
		$text['producegedfrom'] = "Sisällytä tiedostoon";
		$text['numgens'] = "Sukupolvien lukumäärä";
		$text['includelds'] = "Sisällytä LDS-tiedot";
		$text['buildged'] = "Luo GEDCOM";
		$text['gedstartfrom'] = "GEDCOM alkaen";
		$text['nomaxgen'] = "Sukupolvien enimmäismäärätieto puuttuu. Käytä selaimen takaisin-painiketta palataksesi edelliselle sivulle ja täytä kenttä.";
		$text['gedcreatedfrom'] = "GEDCOM luotu alkaen";
		$text['gedcreatedfor'] = "käyttäjälle";
		$text['creategedfor'] = "Luo GEDCOM-tiedosto";
		$text['email'] = "Sähköposti";
		$text['suggestchange'] = "Ehdota muutosta";
		$text['yourname'] = "Nimesi";
		$text['comments'] = "Kommentit";
		$text['comments2'] = "Kommentit";
		$text['submitsugg'] = "Lähetä muutospyyntö";
		$text['proposed'] = "Ehdotettu muutospyyntö";
		$text['mailsent'] = "Kiitos, viestisi on lähetetty.";
		$text['mailnotsent'] = "Virhe. Pahoittelemme, mutta viestiäsi ei voitu toimittaa. Ota yhteys henkilöön xxx osoitteessa yyy.";
		$text['mailme'] = "Lähetä kopio tähän osoitteeseen.";
		$text['entername'] = "Anna nimesi";
		$text['entercomments'] = "Kirjoita kommenttisi";
		$text['sendmsg'] = "Lähetä viesti";
		//added in 9.0.0
		$text['subject'] = "Aihe";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Kuvat ja elämäkerrat";
		$text['indinfofor'] = "Henkilötiedot:";
		$text['pp'] = "s."; //page abbreviation
		$text['age'] = "Ikä";
		$text['agency'] = "Toimisto";
		$text['cause'] = "Syy";
		$text['suggested'] = "Ehdotettu";
		$text['closewindow'] = "Sulje ikkuna";
		$text['thanks'] = "Kiitos";
		$text['received'] = "Lähettämäsi muutospyyntö on vastaanotettu ja lähetetty sivuston ylläpidolle.";
		$text['indreport'] = "Yksilöraportti";
		$text['indreportfor'] = "Yksilöraportti";
		$text['bkmkvis'] = "<strong>Huom:</strong> Nämä kirjanmerkit näkyvät vain tällä tietokoneella ja tässä selaimessa.";
        //added in 9.0.0
		$text['reviewmsg'] = "Sinulle on ehdotettu muutosta, joka vaatii hyväksyntäsi. Tämä ehdotus koskee:";
        $text['revsubject'] = "Ehdotettu muutos vaatii hyväksyntäsi";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Sukulaisuuslaskuri";
		$text['findrel'] = "Etsi sukulaisuussuhdetta";
		$text['person1'] = "Henkilö 1:";
		$text['person2'] = "Henkilö 2:";
		$text['calculate'] = "Tee haku";
		$text['select2inds'] = "Valitse kaksi henkilöä.";
		$text['findpersonid'] = "Etsi henkilön ID";
		$text['enternamepart'] = "anna osa etu- ja/tai sukunimestä";
		$text['pleasenamepart'] = "Ole hyvä ja anna osa etu- ja/tai sukunimestä.";
		$text['clicktoselect'] = "valitse henkilö klikkaamalla linkkiä";
		$text['nobirthinfo'] = "Ei syntymätietoja";
		$text['relateto'] = "Sukulaisuussuhde henkilöön";
		$text['sameperson'] = "Nämä kaksi henkilöä ovat sama henkilö.";
		$text['notrelated'] = "Henkilöille ei löydy sukulaisuussuhdetta xxx sukupolven ajalta."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Sukulaisuussuhteen selvittämiseksi, anna kahden henkilön ID-numerot, tai pidä henkilöt näkyvillä. Klikkaa sitten ‘Selvitä’ selvittääksesi heidän sukulaisuussuhteensa.";
		$text['sometimes'] = "(Joskus eri sukupolvien tarkistaminen antaa erilaisen tuloksen.)";
		$text['findanother'] = "Selvitä lisää sukulaisuussuhteita.";
		$text['brother'] = "veli";
		$text['sister'] = "sisar";
		$text['sibling'] = "sisarus";
		$text['uncle'] = "xxx setä";
		$text['aunt'] = "xxx täti";
		$text['uncleaunt'] = "xxx setä/täti";
		$text['nephew'] = "sisaren/veljenpoika";
		$text['niece'] = "sisaren/veljentytär";
		$text['nephnc'] = "xxx sisaren/veljen -tytär/poika";
		$text['removed'] = "kertaa poistettu";
		$text['rhusband'] = "mies ";
		$text['rwife'] = "vaimo ";
		$text['rspouse'] = "puoliso ";
		$text['son'] = "poika";
		$text['daughter'] = "tytär";
		$text['rchild'] = "lapsi";
		$text['sil'] = "vävy";
		$text['dil'] = "miniä";
		$text['sdil'] = "miniä tai vävy";
		$text['gson'] = "xxx pojan/tyttärenpoika";
		$text['gdau'] = "xxx pojan/tyttärentytär";
		$text['gsondau'] = "xxx pojan/tyttären poika/tytär";
		$text['great'] = "iso";
		$text['spouses'] = "ovat puolisoita";
		$text['is'] = "on";
		$text['changeto'] = "Vaihda henkilöksi:";
		$text['notvalid'] = "ei ole mahdollinen henkilön ID-numero tai ei ainakaan ole olemassa tässä tietokannassa. Ole hyvä ja yritä uudestaan.";
		$text['halfbrother'] = "velipuoli";
		$text['halfsister'] = "sisarpuoli";
		$text['halfsibling'] = "sisaruspuoli";
		//changed in 8.0.0
		$text['gencheck'] = "Selvitettävien<br />sukulaisuussuhteiden maksimimäärä";
		$text['mcousin'] = "xxx serkku yyy";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx serkku yyy";  //female cousin
		$text['cousin'] = "xxx serkku yyy";
		$text['mhalfcousin'] = "xxx serkkupuoli yyy";  //male cousin
		$text['fhalfcousin'] = "xxx serkkupuoli yyy";  //female cousin
		$text['halfcousin'] = "xxx serkkupuoli yyy";
		//added in 8.0.0
		$text['oneremoved'] = "sukupolven yli";
		$text['gfath'] = "xxx isoisä";
		$text['gmoth'] = "xxx isoäiti";
		$text['gpar'] = "xxx isovanhempi";
		$text['mothof'] = "äiti";
		$text['fathof'] = "isä";
		$text['parof'] = "vanhempi";
		$text['maxrels'] = "Suurin näytettävien suhteiden määrä";
		$text['dospouses'] = "Näytä suhteet sisältäen puolisot";
		$text['rels'] = "Suhteet";
		$text['dospouses2'] = "Näytä puolisot";
		$text['fil'] = "appi";
		$text['mil'] = "anoppi";
		$text['fmil'] = "appi tai anoppi";
		$text['stepson'] = "velipuoli";
		$text['stepdau'] = "sisarpuoli";
		$text['stepchild'] = "sisar/velipuoli";
		$text['stepgson'] = "xxx pojan/tyttären velipuoli";
		$text['stepgdau'] = "xxx pojan/tyttären sisarpuoli";
		$text['stepgchild'] = "xxx pojan/tyttären veli/sisarpuoli";
		//added in 8.1.1
		$text['ggreat'] = "iso";
		//added in 8.1.2
		$text['ggfath'] = "xxx iso isoisä";
		$text['ggmoth'] = "xxx iso isoäiti";
		$text['ggpar'] = "xxx iso isovanhempi";
		$text['ggson'] = "xxx iso pojan/tyttärenpoika";
		$text['ggdau'] = "xxx iso pojan/tyttärentytär";
		$text['ggsondau'] = "xxx iso pojan/tyttären poika/tytär";
		$text['gstepgson'] = "xxx iso pojan/tyttären velipuoli";
		$text['gstepgdau'] = "xxx iso pojan/tyttären sisarpuoli";
		$text['gstepgchild'] = "xxx iso pojan/tyttären veli/sisarpuoli";
		$text['guncle'] = "xxx iso setä";
		$text['gaunt'] = "xxx iso täti";
		$text['guncleaunt'] = "xxx iso setä/täti";
		$text['gnephew'] = "xxx iso sisaren/veljenpoika";
		$text['gniece'] = "xxx iso sisaren/veljentytär";
		$text['gnephnc'] = "xxx iso sisaren/veljen -tytär/poika";
		//added in 14.0
		$text['pathscalc'] = "Etsi yhteyksiä";
		$text['findrel2'] = "Valitse sukulaisuussuhteita ja muita kytköksiä";
		$text['makeme2nd'] = "Käytä minun ID:tä";
		$text['usebookmarks'] = "Käytä kirjanmerkkejä";
		$text['select2inds'] = "Valitse kaksi henkilöä.";
		$text['indinfofor'] = "Yksilölliset tiedot";
		$text['nobookmarks'] = "Käytettävää kirjanmerkkiä ei ole";
		$text['bkmtitle'] = "Kirjanmerkeistä löydetyt henkilöt";
		$text['bkminfo'] = "Valitse henkilö:";
		$text['sortpathsby'] = "Lajittele polut lukumäärän mukaan";
		$text['sortbyshort'] = "Lajittele";
		$text['bylengthshort'] = "Pituus";
		$text['badID1'] = ": väärä henkilö1 ID - palaa korjaamaan";
		$text['badID2'] = ": väärä henkilö2 ID - palaa korjaamaan";
		$text['notintree'] = ": henkilö tällä ID:llä ei ole nykyisessä tietokantapuussa.";
		$text['sameperson'] = "Nämä kaksi henkilöä ovat sama henkilö.";;
		$text['nopaths'] = "Nämä henkilöt eivät ole yhteydessä toisiinsa.";
		$text['nopaths1'] = "Ei enempää yhteyksiä lyhyempiä kuin xxx";
		$text['nopaths2'] = "xxx hakuvaihetta";
		$text['longestpath'] = "(pisin tarkastettu polku tähän mennessä oli xxx vaihetta pitkä)";
		$text['relevantpaths'] = "Löydettyjen erilaisten osuvien polkujen lukumäärä: xxx";
		$text['skipMarr'] = "(lisäksi löydettyjen polkujen määrä, joita ei näytetä liian monen avioliiton vuoksi, oli: xxx)";
		$text['mjaor'] = "tai";
		$text['connectionsto'] = "Yhteydet ";
		$text['findanotherpers'] = "Etsi toinen henkilö...";
		$text['sometimes'] = "(Joskus eri sukupolvien tarkistaminen antaa erilaisen tuloksen.)";
		$text['anotherpath'] = "Etsi muita yhteyksiä";
		$text['xpath'] = "Polku ";
		$text['primary'] = "Aloitushenkilö"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Loppuhenkilö";
		$text['parent'] = "Vanhempi";
		$text['mhfather'] = "isänsä";
		$text['mhmother'] = "äitinsä";
		$text['mhhusband'] = "aviomiehensä";
		$text['mhwife'] = "vaimonsa";
		$text['mhson'] = "poikansa";
		$text['mhdaughter'] = "tyttärensä";
		$text['fhfather'] = "isänsä";
		$text['fhmother'] = "äitinsä";
		$text['fhhusband'] = "aviomiehensä";
		$text['fhwife'] = "vaimonsa";
		$text['fhson'] = "poikansa";
		$text['fhdaughter'] = "tyttärensä";
		$text['hfather'] = "isä";
		$text['hmother'] = "äiti";
		$text['hhusband'] = "aviomies";
		$text['hwife'] = "vaimo";
		$text['hson'] = "poika";
		$text['hdaughter'] = "tytär";
		$text['maxruns'] = "Enimmäismäärä polkuja tarkistettavaksi";
		$text['maxrshort'] = "Enimmäispolut";
		$text['maxlength'] = "Yhteyspolut korkeintaan";
		$text['maxlshort'] = "Maksimipituus";
		$text['xstep'] = "vaihe";
		$text['xsteps'] = "vaiheet";
		$text['xmarriages'] = "xxx avioliitot";
		$text['xmarriage'] = "1 avioliitto";
		$text['showspouses'] = "Näytä molemmat puolisot";
		$text['showTxt'] = "Näytä tekstimuotoinen polun kuvaus";
		$text['showTxtshort'] = "Tekstimuotoinen kuvaus.";
		$text['compactBox'] = "Näytä henkilölaatikot tiiviinä";
		$text['compactBoxshort'] = "Kompaktit laatikot";
		$text['paths'] = "Polut";
		$text['dospouses2'] = "Näytä puolisot";
		$text['maxmopt'] = "Maksimi määrä avioliittoja kytkökselle";
		$text['maxm'] = "Maksimi avioliitot";
		$text['arerelated'] = "Nämä henkilöt ovat sukulaisia, joiden yhteys näytetään polulla 1";
		$text['simplerel'] = "Yksinkertainen sukulaisuussuhteen haku";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Perhetaulukko:";
		$text['ldsords'] = "LDS-tiedot";
		$text['baptizedlds'] = "Kastettu (LDS)";
		$text['endowedlds'] = "Endaumentti (LDS)";
		$text['sealedplds'] = "Sinetöity P (LDS)";
		$text['sealedslds'] = "Sinetöity S (LDS)";
		$text['otherspouse'] = "Toinen puoliso";
		$text['husband'] = "Aviomies";
		$text['wife'] = "Vaimo";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "s";
		$text['capaltbirthabbr'] = "(s)";
		$text['capdeathabbr'] = "k";
		$text['capburialabbr'] = "haud.";
		$text['capplaceabbr'] = "paikka";
		$text['capmarrabbr'] = "vih.";
		$text['capspouseabbr'] = "PUOL";
		$text['redraw'] = "Päivitä";
		$text['unknownlit'] = "Tuntematon";
		$text['popupnote1'] = " = Lisätietoja";
		$text['pedcompact'] = "Tiivis";
		$text['pedstandard'] = "Vakio";
		$text['pedtextonly'] = "Tekstimuoto";
		$text['descendfor'] = "Jälkeläiset:";
		$text['maxof'] = "Näytetään enintään";
		$text['gensatonce'] = "sukupolvea kerrallaan, ";
		$text['sonof'] = "vanhemmat";
		$text['daughterof'] = "vanhemmat";
		$text['childof'] = "vanhemmat";
		$text['stdformat'] = "Vakiomuoto";
		$text['ahnentafel'] = "Esipolvitaulu";
		$text['addnewfam'] = "Lisää uusi perhe";
		$text['editfam'] = "Muokkaa perhettä";
		$text['side'] = "Side";
		$text['familyof'] = "Sukutiedot henkilölle";
		$text['paternal'] = "Isän suku";
		$text['maternal'] = "Äidin suku";
		$text['gen1'] = "Henkilö itse";
		$text['gen2'] = "Vanhemmat";
		$text['gen3'] = "Isovanhemmat";
		$text['gen4'] = "Isovanhempien vanhemmat";
		$text['gen5'] = "Isovanhempien isovanhemmat";
		$text['gen6'] = "6. sukupolvi";
		$text['gen7'] = "7. sukupolvi";
		$text['gen8'] = "8. sukupolvi";
		$text['gen9'] = "9. sukupolvi";
		$text['gen10'] = "10. sukupolvi";
		$text['gen11'] = "11. sukupolvi";
		$text['gen12'] = "12. sukupolvi";
		$text['graphdesc'] = "Jälkipolvikartta tähän asti";
		$text['pedbox'] = "Lokero";
		$text['regformat'] = "Rekisterimuoto";
		$text['extrasexpl'] = "Mikäli seuraavilla henkilöillä on valokuvia tai elämäkertoja, niiden kuvakkeet näkyvät nimen vieressä.";
		$text['popupnote3'] = " = Uusi kaavio";
		$text['mediaavail'] = "Media tarjolla";
		$text['pedigreefor'] = "Sukutaulu:";
		$text['pedigreech'] = "Sukupuu kaavio";
		$text['datesloc'] = "Päivämäärät ja sijainnit";
		$text['borchr'] = "syntymä/Alt - kuolin/hautaus (kaksi)";
		$text['nobd'] = "Ei syntymä- tai kuolinpäiviä";
		$text['bcdb'] = "syntymä/Alt/kuolin/hautaus (neljä)";
		$text['numsys'] = "Numerointijärjestelmä";
		$text['gennums'] = "Sukupolvinumerot";
		$text['henrynums'] = "Henry numerot";
		$text['abovnums'] = "d'Aboville numerot";
		$text['devnums'] = "de Villiers numerot";
		$text['dispopts'] = "Näyttöasetukset";
		//added in 10.0.0
		$text['no_ancestors'] = "Esi-isiä ei löytynyt";
		$text['ancestor_chart'] = "Pystysuora esi-isäkaavio";
		$text['opennewwindow'] = "Avaa uudessa ikkunassa";
		$text['pedvertical'] = "Pystysuora";
		//added in 11.0.0
		$text['familywith'] = "Perhe puolisona";
		$text['fcmlogin'] = "Kirjaudu sisään nähdäksesi yksityiskohdat";
		$text['isthe'] = "on";
		$text['otherspouses'] = "muut puolisot";
		$text['parentfamily'] = "Vanhemman perhe ";
		$text['showfamily'] = "Näytä perhe";
		$text['shown'] = "näytetty";
		$text['showparentfamily'] = "näytä vanhemman perhe";
		$text['showperson'] = "näytä henkilö";
		//added in 11.0.2
		$text['otherfamilies'] = "Muut perheet";
		//added in 14.0
		$text['dtformat'] = "Taulukot";
		$text['dtchildren'] = "Lapset";
		$text['dtgrandchildren'] = "Lapsenlapset";
		$text['dtggrandchildren'] = "Lapsenlapsenlapset";
		$text['dtgggrandchildren'] = "lapsenlapsenlapsi"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Ei jälkeläisiä";
		$text['dtgen'] = "Sp";
		$text['dttotal'] = "Yhteensä";
		$text['dtselect'] = "Valitse";
		$text['dteachfulltable'] = "Jokaisessa täydessä taulussa on";
		$text['dtrows'] = "rivit";
		$text['dtdisplayingtable'] = "Näytetään taulukko";
		$text['dtgototable'] = "Siirry taulukkoon:";
		$text['fcinstrdn'] = "Näytä perhe puolison kanssa";
		$text['fcinstrup'] = "Näytä perhe vanhempien kanssa";
		$text['fcinstrplus'] = "Valitse muut puolisot";
		$text['fcinstrfam'] = "Valitse muut vanhemmat";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Ei raportteja.";
		$text['reportname'] = "Raportin nimi";
		$text['allreports'] = "Raportit";
		$text['report'] = "Raportti";
		$text['error'] = "Virhe";
		$text['reportsyntax'] = "Raportin";
		$text['wasincorrect'] = "syntaksi oli virheellinen, minkä takia sitä ei voitu koostaa. Ota yhteys palvelun ylläpitoon:";
		$text['errormessage'] = "Virhe";
		$text['equals'] = "on";
		$text['endswith'] = "loppuu";
		$text['soundexof'] = "soundex-haku";
		$text['metaphoneof'] = "metaphone-haku";
		$text['plusminus10'] = "+/- 10 vuotta alkaen";
		$text['lessthan'] = "vähemmän kuin";
		$text['greaterthan'] = "enemmän kuin";
		$text['lessthanequal'] = "vähemmän tai yhtä kuin";
		$text['greaterthanequal'] = "enemmän tai yhtä kuin";
		$text['equalto'] = "yhtä kuin";
		$text['tryagain'] = "Yritä uudelleen";
		$text['joinwith'] = "Hakuoperaatio";
		$text['cap_and'] = "JA";
		$text['cap_or'] = "TAI";
		$text['showspouse'] = "Näytä puolisot (mikäli useampi avioliitto)";
		$text['submitquery'] = "Etsi";
		$text['birthplace'] = "Syntymäpaikka";
		$text['deathplace'] = "Kuolinpaikka";
		$text['birthdatetr'] = "Syntymävuosi";
		$text['deathdatetr'] = "Kuolinvuosi";
		$text['plusminus2'] = "+/- 2 vuotta alkaen";
		$text['resetall'] = "Tyhjennä kentät";
		$text['showdeath'] = "Näytä kuolin- ja hautatiedot";
		$text['altbirthplace'] = "Ristiäispaikka";
		$text['altbirthdatetr'] = "Ristiäisvuosi";
		$text['burialplace'] = "Hautauspaikka";
		$text['burialdatetr'] = "Hautausvuosi";
		$text['event'] = "Tapahtuma(t)";
		$text['day'] = "Päivä";
		$text['month'] = "Kuukausi";
		$text['keyword'] = "Avainsana";
		$text['explain'] = "Anna päivämäärät nähdäksesi tapahtumat, tai jätä kentät tyhjiksi nähdäksesi kaikki.";
		$text['enterdate'] = "Syötä ainakin yksi seuraavista avainsanoista: päivä, kuukausi, vuosi";
		$text['fullname'] = "Koko nimi";
		$text['birthdate'] = "Syntymäpäivä";
		$text['altbirthdate'] = "Ristiäispäivä";
		$text['marrdate'] = "Hääpäivä";
		$text['spouseid'] = "Puolison ID-numero";
		$text['spousename'] = "Puolison nimi";
		$text['deathdate'] = "Kuolinpäivä";
		$text['burialdate'] = "Hautajaispäivä";
		$text['changedate'] = "Viimeisimmän muutoksen pvm";
		$text['gedcom'] = "Sukupuu";
		$text['baptdate'] = "Kastepäivä (mormoni)";
		$text['baptplace'] = "Kastepaikka (mormoni)";
		$text['endldate'] = "Endaumentin päivä (mormoni)";
		$text['endlplace'] = "Endaumentin paikka (mormoni)";
		$text['ssealdate'] = "Puolison sinetöimispäivä (mormoni)";   //Sealed to spouse
		$text['ssealplace'] = "Puolison sinetöimispaikka (mormoni)";
		$text['psealdate'] = "Vanhempien sinetöimispäivä (mormoni)";   //Sealed to parents
		$text['psealplace'] = "Vanhempien sinetöimispaikka (mormoni)";
		$text['marrplace'] = "Vihkipaikka";
		$text['spousesurname'] = "Puolison sukunimi";
		$text['spousemore'] = "Jos syötät puolison sukunimi-kenttään jotain, sinun täytyy syöttää jotain vähintään yhteen muuhunkin kenttään.";
		$text['plusminus5'] = "+/- 5 vuotta alkaen";
		$text['exists'] = "on olemassa";
		$text['dnexist'] = "ei ole olemassa";
		$text['divdate'] = "Avioeron päivämäärä";
		$text['divplace'] = "Avioeron paikka";
		$text['otherevents'] = "Muut tapahtumat";
		$text['numresults'] = "Tuloksia per sivu";
		$text['mysphoto'] = "Tunnistamattomat valokuvat";
		$text['mysperson'] = "Hämäräksi jääneet henkilöt";
		$text['joinor'] = "'Yhdistä OR:lla' asetusta ei voida käyttää puolison sukunimen kanssa";
		$text['tellus'] = "Kerro, mitä tiedät";
		$text['moreinfo'] = "Lisätietoja:";
		//added in 8.0.0
		$text['marrdatetr'] = "Vihkivuosi";
		$text['divdatetr'] = "Erovuosi";
		$text['mothername'] = "äidin nimi";
		$text['fathername'] = "isän nimi";
		$text['filter'] = "suodatin";
		$text['notliving'] = "ei elossa";
		$text['nodayevents'] = "Tämän kuun tapahtumat, joita ei ole sidottu mihinkään päivään:";
		//added in 9.0.0
		$text['csv'] = "Pilkkueroteltu CSV tiedosto";
		//added in 10.0.0
		$text['confdate'] = "Konfirmaatio aika (LDS)";
		$text['confplace'] = "Konfirmaatio paikka (LDS)";
		$text['initdate'] = "Pesu ja voitelu aika (LDS)";
		$text['initplace'] = "Pesu ja voitelu paikka (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Avioliiton tyypp";
		$text['searchfor'] = "Etsi";
		$text['searchnote'] = "Huom: Tämä sivu käyttää Google hakua. Löytyneiden sivujen määrä on riippuvainen siitä, missä määrin Google on pystynyt indeksoimaan sivustoa.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Tapahtumat:";
		$text['mostrecentactions'] = "viimeisintä tapahtumaa";
		$text['autorefresh'] = "Päivitä sivu 30 sek. välein";
		$text['refreshoff'] = "Ei sivun autom. päivitystä";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Hautausmaat ja hautakivet";
		$text['showallhsr'] = "Näytä kaikki hautakivitiedot";
		$text['in'] = "paikassa";
		$text['showmap'] = "Näytä kartta";
		$text['headstonefor'] = "Hautakivi:";
		$text['photoof'] = "Valokuva:";
		$text['photoowner'] = "Alkuperäisen kuvan omistaja";
		$text['nocemetery'] = "Ei hautausmaata";
		$text['iptc005'] = "Otsikko";
		$text['iptc020'] = "Lisäkategoriat";
		$text['iptc040'] = "Erityisohjeet";
		$text['iptc055'] = "Luontipäivä";
		$text['iptc080'] = "Kuvaaja";
		$text['iptc085'] = "Kuvaajan asema";
		$text['iptc090'] = "Kaupunki";
		$text['iptc095'] = "Osavaltio";
		$text['iptc101'] = "Maa";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Otsikko";
		$text['iptc110'] = "Lähde";
		$text['iptc115'] = "Valokuvan lähde";
		$text['iptc116'] = "Tekijänoikeustiedot";
		$text['iptc120'] = "Kuvateksti";
		$text['iptc122'] = "Kuvatekstin kirjoittaja";
		$text['mapof'] = "Kartta:";
		$text['regphotos'] = "Selitysten mukaan";
		$text['gallery'] = "Vain pikkukuvat";
		$text['cemphotos'] = "Hautausmaan kuvat";
		$text['photosize'] = "Kuvan koko";
        $text['iptc010'] = "Arvojärjestys";
		$text['filesize'] = "Tiedoston koko";
		$text['seeloc'] = "Näytä paikka";
		$text['showall'] = "Näytä kaikki";
		$text['editmedia'] = "Muokkaa aineistoja";
		$text['viewitem'] = "Näytä tämä kohta";
		$text['editcem'] = "Muokkaa hautausmaata";
		$text['numitems'] = "# jäsentä";
		$text['allalbums'] = "Kaikki albumit";
		$text['slidestop'] = "Keskeytä diaesitys";
		$text['slideresume'] = "Jatka diaesitystä";
		$text['slidesecs'] = "Sekuntia per kuva:";
		$text['minussecs'] = "- 0,5 sekuntia";
		$text['plussecs'] = "+ 0,5 sekuntia";
		$text['nocountry'] = "Tuntematon maa";
		$text['nostate'] = "Tuntematon valtio";
		$text['nocounty'] = "Tuntematon lääni";
		$text['nocity'] = "Tuntematon kaupunki";
		$text['nocemname'] = "Nimetän hautausmaa";
		$text['editalbum'] = "Muokkaa albumia";
		$text['mediamaptext'] = "<strong>Huom:</strong> Liikuta hiirtä kuvan päällä nähdäksesi nimet. Klikkaa nähdäksesi nimeä vastaava sivu.";
		//added in 8.0.0
		$text['allburials'] = "kaikki hautajaiset";
		$text['moreinfo'] = "Lisätietoja:";
		//added in 9.0.0
        $text['iptc025'] = "Avainsanat";
        $text['iptc092'] = "Alisijainti";
		$text['iptc015'] = "Kategoria";
		$text['iptc065'] = "Lähdeohjelmisto";
		$text['iptc070'] = "Ohjelmaversio";
		//added in 13.0
		$text['toggletags'] = "Vaihda tunnisteiden tilaa";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Näytä sukunimet, jotka alkavat kirjaimella";
		$text['showtop'] = "Listaa";
		$text['showallsurnames'] = "Näytä kaikki sukunimet";
		$text['sortedalpha'] = "aakkosjärjestyksessä";
		$text['byoccurrence'] = "yleisintä sukunimeä";
		$text['firstchars'] = "Alkukirjaimet";
		$text['mainsurnamepage'] = "Sukunimien pääsivu";
		$text['allsurnames'] = "Kaikki sukunimet";
		$text['showmatchingsurnames'] = "Valitse sukunimi listataksesi henkilöt";
		$text['backtotop'] = "Sivun alkuun";
		$text['beginswith'] = "Alkukirjain";
		$text['allbeginningwith'] = "Sukunimet jotka alkavat kirjaimella";
		$text['numoccurrences'] = "lukumäärä suluissa";
		$text['placesstarting'] = "Näytä paikat, jotka alkavat merkkijonolla";
		$text['showmatchingplaces'] = "Valitse paikka näyttääksesi osumat.";
		$text['totalnames'] = "henkilöiden kokonaismäärä";
		$text['showallplaces'] = "Näytä suurimmat paikat";
		$text['totalplaces'] = "paikkojen määrä";
		$text['mainplacepage'] = "Paikkojen pääsivu";
		$text['allplaces'] = "Kaikki paikat";
		$text['placescont'] = "Näytä kaikki paikat, joissa esiintyy";
		//changed in 8.0.0
		$text['top30'] = "Yleisimmät xxx sukunimeä";
		$text['top30places'] = "Yleisimmät xxx keskeistä paikkaa";
		//added in 12.0.0
		$text['firstnamelist'] = "Etunimilista";
		$text['firstnamesstarting'] = "Näytä etunimet, jotka alkavat kirjaimella";
		$text['showallfirstnames'] = "Näytä kaikki etunimet";
		$text['mainfirstnamepage'] = "Etunimisivu";
		$text['allfirstnames'] = "Kaikki etunimet";
		$text['showmatchingfirstnames'] = "Klikkaa etunimeä nähdäksesi osumat.";
		$text['allfirstbegwith'] = "Kaikki etunimet alkaen";
		$text['top30first'] = "Yleisimmät xxx etunimeä";
		$text['allothers'] = "Kaikki muut";
		$text['amongall'] = "(kaikista nimistä)";
		$text['justtop'] = "Suosituimmat xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(xx päivän ajalta)";

		$text['photo'] = "Valokuva";
		$text['history'] = "Elämäkerta/Dokumentti";
		$text['husbid'] = "Miehen ID";
		$text['husbname'] = "Miehen nimi";
		$text['wifeid'] = "Vaimon ID";
		//added in 11.0.0
		$text['wifename'] = "Äidin nimi";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Poista";
		$text['addperson'] = "Lisää henkilö";
		$text['nobirth'] = "Henkilöstä ei ole syntymätietoja joten häntä ei voida lisätä.";
		$text['event'] = "Tapahtuma(t)";
		$text['chartwidth'] = "Taulukon leveys";
		$text['timelineinstr'] = "Lisää korkeintaan neljä henkilöä syöttämällä heidän ID-numeronsa tai käyttämällä nimihakua:";
		$text['togglelines'] = "Muuta rivien järjestystä";
		//changed in 9.0.0
		$text['noliving'] = "Elossa olevien henkilöiden lisääminen on sallittu vain kirjautuneille käyttäjille.";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Sukupuut";
		$text['treename'] = "Sukupuun nimi";
		$text['owner'] = "Omistaja";
		$text['address'] = "Osoite";
		$text['city'] = "Paikkakunta";
		$text['state'] = "Lääni";
		$text['zip'] = "Postinumero";
		$text['country'] = "Maa";
		$text['email'] = "Sähköposti";
		$text['phone'] = "Puhelinnumero";
		$text['username'] = "Käyttäjätunnus";
		$text['password'] = "Salasana";
		$text['loginfailed'] = "Virhe sisäänkirjautumisessa";

		$text['regnewacct'] = "Rekisteröidy käyttäjäksi";
		$text['realname'] = "Koko nimi";
		$text['phone'] = "Puhelinnumero";
		$text['email'] = "Sähköposti";
		$text['address'] = "Osoite";
		$text['acctcomments'] = "Kommentit";
		$text['submit'] = "Lähetä";
		$text['leaveblank'] = "(jätä tyhjäksi jos haluat rekisteröidä uuden sukupuun)";
		$text['required'] = "Pakolliset kentät";
		$text['enterpassword'] = "Ole hyvä ja täytä salasanakenttä.";
		$text['enterusername'] = "Ole hyvä ja täytä käyttäjätunnuskenttä.";
		$text['failure'] = "Valitsemasi käyttäjätunnus on jo käytössä. Palaa edelliselle sivulle ja valitse toinen käyttäjätunnus.";
		$text['success'] = "Kiitos rekisteröitymisestäsi. Ilmoitamme sinulle kun tunnuksesi on aktivoitu.";
		$text['emailsubject'] = "TNG-rekisteröitymispyyntö";
		$text['website'] = "Kotisivu";
		$text['nologin'] = "Puuttuuko sinulta tunnukset?";
		$text['loginsent'] = "Tunnustiedot lähetetty";
		$text['loginnotsent'] = "Tunnustietoja ei lähtetetty";
		$text['enterrealname'] = "Anna oikea nimesi.";
		$text['rempass'] = "Pysy sisäänkirjautuneenä tällä tietokoneella";
		$text['morestats'] = "Lisää tilastoja";
		$text['accmail'] = "<strong>HUOM:</strong> Varmista, ettei sähköpostiasetuksissasi ole estetty sähköpostin vastaanottoa tältä verkkotunnukselta. Muuten et voi saada ylläpidon vastausta tunnuspyyntöösi.";
		$text['newpassword'] = "Uusi salasana";
		$text['resetpass'] = "Vaihda salasana";
		$text['nousers'] = "Tätä lomaketta ei voi käyttää kunnes järjestelmässä on vähintään yksi tunnus. Jos olet järjestelmän ylläpitäjä, mene Ylläpito-valikon Käyttäjät-kohtaan luomaan itsellesi ylläpitotunnus.";
		$text['noregs'] = "Emme ota vastaan uusia käyttäjärekisteröintejä tällä hetkellä. Ole hyvä ja  <a href=\"suggest.php\">ota yhteyttä</a> suoraan, jos sinulla on kommentteja tai kysymyksiä koskien tätä sivustoa.";
		$text['emailmsg'] = "Sinulle on saapunut uusi TNG-rekisteröitymispyyntö. Kirjaudu sisään TNG:n hallintaliittymään ja anna uudelle käyttäjälle sopivat käyttöoikeudet. Jos hyväksyt rekisteröitymisen, ole hyvä ja vastaa tähän viestiin ilmoittaaksesi asiasta käyttäjälle.";
		$text['accactive'] = "Tunnus on aktivoitu, mutta käyttäjällä ei ole erityisoikeuksia ennen kuin annat ne.";
		$text['accinactive'] = "Siirry Ylläpito/Käyttäjät/Hyväksyntä tarkistamaan tunnus. Tunnus on aktivoimaton kunnes olet muokannut sitä ja tallentanut tiedot vähintään kerran.";
		$text['pwdagain'] = "Salasana uudelleen";
		$text['enterpassword2'] = "Anna salasanasi uudelleen.";
		$text['pwdsmatch'] = "Salasanat eivät täsmää. Syötä sama salasana kumpaankin kenttään.";
		$text['acksubject'] = "Kiitos rekisteröitymisestäsi"; //for a new user account
		$text['ackmessage'] = "Käyttäjätunnuspyyntösi on vastaanotettu. Tunnuksesi on aktivoimatta kunnes ylläpitäjä tarkistaa sen. Sinulle ilmoitetaan sähköpostilla, kun tunnuksesi on käytettävissä.";
		//added in 12.0.0
		$text['switch'] = "Vaihda";
		//added in 14.0
		$text['newpassword2'] = "Uusi salasana uudestaan";
		$text['resetsuccess'] = "Onnistui: Salasana on nollattu";
		$text['resetfail'] = "Virhe: Salasanaa ei nollattu";
		$text['failreason0'] = " (tuntematon tietokantavirhe)";
		$text['failreason2'] = " (sinulla ei ole lupaa vaihtaa salasanaasi)";
		$text['failreason3'] = " (salasanat eivät täsmänneet)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Selaa kaikkia haaroja";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Arvo";
		$text['totindividuals'] = "Henkilöitä";
		$text['totmales'] = "Miehiä";
		$text['totfemales'] = "Naisia";
		$text['totunknown'] = "Sukupuoli tuntematon";
		$text['totliving'] = "Elossa";
		$text['totfamilies'] = "Perheitä";
		$text['totuniquesn'] = "Sukunimiä";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Lähteitä";
		$text['avglifespan'] = "Keskimääräinen elinikä";
		$text['earliestbirth'] = "Varhaisin syntymävuosi";
		$text['longestlived'] = "Pitkäikäisimmät henkilöt";
		$text['days'] = "päivää";
		$text['age'] = "Ikä";
		$text['agedisclaimer'] = "Ikään liittyvät laskelmat perustuvat henkilöihin joista on tiedossa sekä synnyin- että kuolinaika. Puutteellisten aikatietojen (esim. syntymä kirjattu vain \"1945\" tai \"ennen 1860\") takia laskelmat eivät ole täysin tarkkoja.";
		$text['treedetail'] = "Sukupuun lisätiedot";
		$text['total'] = "Yhteensä";
		//added in 12.0
		$text['totdeceased'] = "Kuolleita yhteensä";
		//added in 14.0
		$text['totalsourcecitations'] = "Lähdeviitteet yhteensä";
		break;

	case "notes":
		$text['browseallnotes'] = "Selaa kaikkia muistiinpanoja";
		break;

	case "help":
		$text['menuhelp'] = "Menuavain";
		break;

	case "install":
		$text['perms'] = "Kaikki oikeudet on asetettu.";
		$text['noperms'] = "Oikeuksia ei voitu asettaa näille tiedostoille:";
		$text['manual'] = "Aseta ne käsin.";
		$text['folder'] = "Hakemisto";
		$text['created'] = "on luotu";
		$text['nocreate'] = "ei voitu luoda. Luo se käsin.";
		$text['infosaved'] = "Tiedot tallennettu, yhteys tarkistettu!";
		$text['tablescr'] = "Taulut luotu!";
		$text['notables'] = "Seuraavia tauluja ei voitu luoda:";
		$text['nocomm'] = "TNG ei saa yhteyttä tietokantaan. Tauluja ei luotu.";
		$text['newdb'] = "Tiedot tallennettu, yhteys tarkistettu, uusi tietokanta luotu:";
		$text['noattach'] = "Tiedot tallennettu. Yhteys ja tietokanta luotu, mutta TNG ei voi käyttää sitä.";
		$text['nodb'] = "Tiedot tallennettu. Yhteys luotu, mutta tietokantaa ei ole tai sitä ei voitu luoda. Tarkista tietokannan nimi tai käytä ohjauspaneelia luodaksesi se.";
		$text['noconn'] = "Tiedot tallennettu, mutta yhteys epäonnistui. Yksi tai useampi seuraavista on väärin:";
		$text['exists'] = "on olemassa";
		$text['noop'] = "Toimintoa ei suoritettu.";
		//added in 8.0.0
		$text['nouser'] = "Käyttäjää ei voitu luoda, sillä käyttäjätunnus saattaa olla jo käytössä.";
		$text['notree'] = "Sukupuuta ei luotu. Sukupuun ID numero saattaa olla jo olemassa.";
		$text['infosaved2'] = "tieto tallennettu";
		$text['renamedto'] = "nimetty uudelleen";
		$text['norename'] = "ei voitu nimetä uudelleen";
		//changed in 13.0.0
		$text['loginfirst'] = "Käyttäjätiedot löydetty rekisteristä. Jatkaaksesi sinun tulee joko kirjautua sisään tai poistaa kaikki tiedot käyttäjätaulusta.";
		break;

	case "imgviewer":
		$text['magmode'] = "Suurennus";
		$text['panmode'] = "Panorointi";
		$text['pan'] = "Klikkaa ja raahaa liikkuaksesi kuvan sisällä";
		$text['fitwidth'] = "Sovita leveys";
		$text['fitheight'] = "Sovita korkeus";
		$text['newwin'] = "Uusi ikkuna";
		$text['opennw'] = "Avaa kuva uudessa ikkunassa";
		$text['magnifyreg'] = "Klikkaa surentaaksesi kuvan alue";
		$text['imgctrls'] = "Aktivoi kuvatoiminnot";
		$text['vwrctrls'] = "Aktivoi kuvaselaimen toiminnot";
		$text['vwrclose'] = "Sulje kuvaselain";
		break;

	case "dna":
		$text['test_date'] = "Testin päiväys";
		$text['links'] = "Liittyvät linkit";
		$text['testid'] = "Testin ID";
		//added in 12.0.0
		$text['mode_values'] = "Tila-arvot";
		$text['compareselected'] = "Vertaa valittuja";
		$text['dnatestscompare'] = "Vertaa Y-DNA testejä";
		$text['keep_name_private'] = "Pidä nimi yksityisenä";
		$text['browsealltests'] = "Selaa kaikkia testejä";
		$text['all_dna_tests'] = "Kaikki DNA testit";
		$text['fastmutating'] = "Nopeasti mutatoivat";
		$text['alltypes'] = "Kaikki tyypit";
		$text['allgroups'] = "Kaikki ryhmät";
		$text['Ydna_LITbox_info'] = "Henkilöön linkitetyt testi(t) eivät välttämättä ole henkilön itsensä suorittamia.<br />'Haploryhmä' sarake näyttää datan punaisella, jos tulos on  'Ennustettu' tai vihreällä, jos testi on 'Vahvistettu'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Vertaa valittuja mtDNA testejä";
		$text['dnatestscompare_atdna'] = "Vertaa valittuja atDNA testejä";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Extra Mutations";
		$text['mrca'] = "MRC Ancestor";
		$text['ydna_test'] = "Y-DNA Tests";
		$text['mtdna_test'] = "mtDNA (Mitochondrial) Tests";
		$text['atdna_test'] = "atDNA (autosomal) Tests";
		$text['segment_start'] = "Start";
		$text['segment_end'] = "End";
		$text['suggested_relationship'] = "Suggested";
		$text['actual_relationship'] = "Actual";
		$text['12markers'] = "Markers 1-12";
		$text['25markers'] = "Markers 13-25";
		$text['37markers'] = "Markers 26-37";
		$text['67markers'] = "Markers 38-67";
		$text['111markers'] = "Markers 68-111";
		//added in 13.1
		$text['comparemore'] = "Vähintään kaksi testiä tulee valita vertailtavaksi.";
		break;
}

//common
$text['matches'] = "Tulokset";
$text['description'] = "Kuvaus";
$text['notes'] = "Muistiinpanot";
$text['status'] = "Tila";
$text['newsearch'] = "Haku";
$text['pedigree'] = "Sukutaulu";
$text['seephoto'] = "Kts. valokuva";
$text['andlocation'] = "& sijainti";
$text['accessedby'] = "- kävijä:";
$text['children'] = "Lapset";  //from getperson
$text['tree'] = "Sukupuu";
$text['alltrees'] = "Sukupuut";
$text['nosurname'] = "[ei sukunimeä]";
$text['thumb'] = "Kuvake";  //as in Thumbnail
$text['people'] = "Henkilöt";
$text['title'] = "Nimike";  //from getperson
$text['suffix'] = "Loppuliite";  //from getperson
$text['nickname'] = "Kutsumanimi";  //from getperson
$text['lastmodified'] = "Muokattu";  //from getperson
$text['married'] = "Vihitty";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nimi"; //from showmap
$text['lastfirst'] = "Sukunimi, Etunimet";  //from search
$text['bornchr'] = "Syntynyt/Kastettu";  //from search
$text['individuals'] = "Henkilöt";  //from whats new
$text['families'] = "Perheet";
$text['personid'] = "Henkilön ID";
$text['sources'] = "Lähteet";  //from getperson (next several)
$text['unknown'] = "Tuntematon";
$text['father'] = "Isä";
$text['mother'] = "Äiti";
$text['christened'] = "Kastettu";
$text['died'] = "Kuollut";
$text['buried'] = "Haudattu";
$text['spouse'] = "Puoliso";  //from search
$text['parents'] = "Vanhemmat";  //from pedigree
$text['text'] = "Teksti";  //from sources
$text['language'] = "Kieli";  //from languages
$text['descendchart'] = "Jälkeläiset";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Henkilön tiedot";
$text['edit'] = "Muokkaa";
$text['date'] = "Päiväys";
$text['login'] = "Sisäänkirjautuminen";
$text['logout'] = "Kirjaudu ulos";
$text['groupsheet'] = "Perhetaulukko";
$text['text_and'] = "ja";
$text['generation'] = "Sukupolvi";
$text['filename'] = "Tiedoston nimi";
$text['id'] = "ID";
$text['search'] = "Etsi";
$text['user'] = "Käyttäjä";
$text['firstname'] = "Etunimi";
$text['lastname'] = "Sukunimi";
$text['searchresults'] = "Haun tulokset";
$text['diedburied'] = "Kuollut/Haudattu";
$text['homepage'] = "Etusivu";
$text['find'] = "Etsi...";
$text['relationship'] = "Sukulaisuus";		//in German, Verwandtschaft
$text['relationship2'] = "Sukulaisuussuhde"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Aikajana";
$text['yesabbr'] = "K";               //abbreviation for 'yes'
$text['divorced'] = "Eronnut";
$text['indlinked'] = "Liitetyt henkilöt";
$text['branch'] = "Sukuhaara";
$text['moreind'] = "Lisää henkilöitä";
$text['morefam'] = "Lisää perheitä";
$text['surnamelist'] = "Sukunimet";
$text['generations'] = "Sukupolvia";
$text['refresh'] = "Päivitä";
$text['whatsnew'] = "Mitä uutta";
$text['reports'] = "Raportit";
$text['placelist'] = "Paikkaluettelo";
$text['baptizedlds'] = "Kastettu (LDS)";
$text['endowedlds'] = "Endaumentti (LDS)";
$text['sealedplds'] = "Sinetöity P (LDS)";
$text['sealedslds'] = "Sinetöity S (LDS)";
$text['ancestors'] = "esi-isät";
$text['descendants'] = "jälkeläiset";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Viimeisin GEDCOM-tiedoston tuonti";
$text['type'] = "Tyyppi";
$text['savechanges'] = "Tallenna muutokset";
$text['familyid'] = "Perheen ID";
$text['headstone'] = "Hautakivet";
$text['historiesdocs'] = "Elämäkerrat";
$text['anonymous'] = "nimetön";
$text['places'] = "Paikat";
$text['anniversaries'] = "Vuosipäivät";
$text['administration'] = "Ylläpito";
$text['help'] = "Apua";
//$text['documents'] = "Documents";
$text['year'] = "Vuosi";
$text['all'] = "Kaikki";
$text['address'] = "Osoite";
$text['suggest'] = "Pyyntö";
$text['editevent'] = "Pyydä muutosta tähän tapahtumaan";
$text['morelinks'] = "Lisää linkkejä";
$text['faminfo'] = "Perheen tiedot";
$text['persinfo'] = "Omat tiedot";
$text['srcinfo'] = "Lähteen tiedot";
$text['fact'] = "Fakta";
$text['goto'] = "Valitse sivu";
$text['tngprint'] = "Tulosta";
$text['databasestatistics'] = "Tilastotietoja"; //needed to be shorter to fit on menu
$text['child'] = "Lapsi";  //from familygroup
$text['repoinfo'] = "Tietovaraston tiedot";
$text['tng_reset'] = "Tyhjennä";
$text['noresults'] = "Hakua vastaavia henkilöitä ei löytynyt";
$text['allmedia'] = "Kaikki aineistot";
$text['repositories'] = "Tietovarastot";
$text['albums'] = "Albumit";
$text['cemeteries'] = "Hautausmaat";
$text['surnames'] = "Sukunimet";
$text['dates'] = "Päivämäärät";
$text['link'] = "Linkki";
$text['media'] = "Aineisto";
$text['gender'] = "Sukupuoli";
$text['latitude'] = "Leveysaste";
$text['longitude'] = "Pituusaste";
$text['bookmarks'] = "Kirjanmerkit";
$text['bookmark'] = "Lisää kirjanmerkki";
$text['mngbookmarks'] = "Muokkaa kirjanmerkkejä";
$text['bookmarked'] = "Kirjanmerkki lisätty";
$text['remove'] = "Poista";
$text['find_menu'] = "Etsi";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Hautausmaa";
$text['gmapevent'] = "Tapahtumakartta";
$text['gevents'] = "Tapahtuma";
$text['googleearthlink'] = "Linkkaa Google Earth-palveluun";
$text['googlemaplink'] = "Linkkaa Google Maps-palveluun";
$text['gmaplegend'] = "Nupin selite";
$text['unmarked'] = "Merkitsemätön";
$text['located'] = "Sijainti";
$text['albclicksee'] = "Klikkaa nähdäksesi kaikki albumin kohteet";
$text['notyetlocated'] = "Ei vielä paikallistettu";
$text['cremated'] = "Tuhkattu";
$text['missing'] = "Puuttu";
$text['pdfgen'] = "PDF tuottaja";
$text['blank'] = "Tyhjä kaavio";
$text['fonts'] = "Kirjasimet";
$text['header'] = "Otsikko";
$text['data'] = "Data";
$text['pgsetup'] = "Sivun asetukset";
$text['pgsize'] = "Sivun koko";
$text['orient'] = "Paperin suunta"; //for a page
$text['portrait'] = "Pysty";
$text['landscape'] = "Vaaka";
$text['tmargin'] = "Ylämarginaali";
$text['bmargin'] = "Alamarginaali";
$text['lmargin'] = "Vasen marginaali";
$text['rmargin'] = "Oikea marginaali";
$text['createch'] = "Luo kaavio";
$text['prefix'] = "Etuliite";
$text['mostwanted'] = "Etsityimmät";
$text['latupdates'] = "Viimeisimmät päivitykset";
$text['featphoto'] = "Erikoiskuvat";
$text['news'] = "Uutiset";
$text['ourhist'] = "Perheemme historia";
$text['ourhistanc'] = "Perheemme historia ja suku";
$text['ourpages'] = "Perheemme sukututkimussivut";
$text['pwrdby'] = "Palvelun toteuttava sovellus";
$text['writby'] = "tekijä";
$text['searchtngnet'] = "Hae TNG verkosta (GENDEX)";
$text['viewphotos'] = "Näytä kaikki kuvat";
$text['anon'] = "Olet tällä hetkellä vierailijana";
$text['whichbranch'] = "Mistä sukuhaarasta olet?";
$text['featarts'] = "Erikoisartikkelit";
$text['maintby'] = "Ylläpitäjä";
$text['createdon'] = "Luotu";
$text['reliability'] = "Luotettavuus";
$text['labels'] = "Nimiöt";
$text['inclsrcs'] = "Ota mukaan lähteet";
$text['cont'] = "(jatk.)"; //abbreviation for continued
$text['mnuheader'] = "Kotisivu";
$text['mnusearchfornames'] = "Etsi nimiä";
$text['mnulastname'] = "Sukunimi";
$text['mnufirstname'] = "Etunimi";
$text['mnusearch'] = "Etsi";
$text['mnureset'] = "Aloita alusta";
$text['mnulogon'] = "Kirjaudu sisään";
$text['mnulogout'] = "Kirjaudu ulos";
$text['mnufeatures'] = "Muut ominaisuudet";
$text['mnuregister'] = "Hae käyttäjätunnusta";
$text['mnuadvancedsearch'] = "Tarkennettu haku";
$text['mnulastnames'] = "Sukunimet";
$text['mnustatistics'] = "Tilastot";
$text['mnuphotos'] = "Valokuvat";
$text['mnuhistories'] = "Elämäkerrat";
$text['mnumyancestors'] = "Valokuvat ja elämäkerrat [Person]in esi-isistä";
$text['mnucemeteries'] = "Hautausmaat";
$text['mnutombstones'] = "Hautakivet";
$text['mnureports'] = "Raportit";
$text['mnusources'] = "Lähteet";
$text['mnuwhatsnew'] = "Mitä uutta";
$text['mnushowlog'] = "Lokitiedot";
$text['mnulanguage'] = "Vaihda kieltä";
$text['mnuadmin'] = "Ylläpito";
$text['welcome'] = "Tervetuloa";
$text['contactus'] = "Ota yhteyttä";
//changed in 8.0.0
$text['born'] = "Syntynyt";
$text['searchnames'] = "Henkilöhaku";
//added in 8.0.0
$text['editperson'] = "muokkaa henkilöä";
$text['loadmap'] = "lataa kartta";
$text['birth'] = "Syntynyt";
$text['wasborn'] = "syntyi";
$text['startnum'] = "ensimmäinen numero";
$text['searching'] = "hakee";
//moved here in 8.0.0
$text['location'] = "Sijainti";
$text['association'] = "Kytkös";
$text['collapse'] = "Supista";
$text['expand'] = "Laajenna";
$text['plot'] = "Pohjapiirros";
$text['searchfams'] = "Perhehaku";
//added in 8.0.2
$text['wasmarried'] = "Vihitty";
$text['anddied'] = "Kuollut";
//added in 9.0.0
$text['share'] = "Jaa";
$text['hide'] = "Piilota";
$text['disabled'] = "Tunnuksesi on lukittu. Ole hyvä ja ota yhteyttä sivuston ylläpitäjään saadaksesi lisätietoja.";
$text['contactus_long'] = "Jos sinulla on kysymyksiä tai kommentteja koskien tämän sivuston sisältöä, ole hyvä ja <span class=\"emphasis\"><a href=\"suggest.php\">ota yhteyttä</a></span>. Odotamme yhteydenottoasi.";
$text['features'] = "Ominaisuudet";
$text['resources'] = "Resurssit";
$text['latestnews'] = "Viimeisimmät uutiset";
$text['trees'] = "Sukupuut";
$text['wasburied'] = "was buried";
//moved here in 9.0.0
$text['emailagain'] = "Sähköposti uudelleen";
$text['enteremail2'] = "Syötä sähköpostiosoitteesi uudelleen.";
$text['emailsmatch'] = "Sähköpostiosoitteet eivät täsmää. Syötä sama osoite molempiin kenttiin.";
$text['getdirections'] = "Klikkaa saadaksesi suunnat";
$text['calendar'] = "Kalenteri";
//changed in 9.0.0
$text['directionsto'] = " to the ";
$text['slidestart'] = "Diaesitys";
$text['livingnote'] = "Ainakin yksi elävä henkilö on linkitetty tähän muistiinpanoon – Yksityiskohtaisia tietoja ei näytetä.";
$text['livingphoto'] = "Kuvaan liittyy ainakin yksi elossa oleva henkilö - Yksityiskohtia ei näytetä.";
$text['waschristened'] = "Kastettu";
//added in 10.0.0
$text['branches'] = "Sukuhaarat";
$text['detail'] = "Yksityiskohta";
$text['moredetail'] = "Lisää yksityiskohtia";
$text['lessdetail'] = "Vähemmän yksityiskohtia";
$text['conflds'] = "Konfirmoitu (LDS)";
$text['initlds'] = "Pesu ja voitelu (LDS)";
$text['wascremated'] = "tuhkattiin";
//moved here in 11.0.0
$text['text_for'] = "haulle";
//added in 11.0.0
$text['searchsite'] = "Hae tältä sivustolta";
$text['searchsitemenu'] = "Hae sivustolta";
$text['kmlfile'] = "Lataa .kml tiedosto katsoaksesi tätä sijaintia Google Earthissä";
$text['download'] = "Klikkaa ladataksesi";
$text['more'] = "Lisää";
$text['heatmap'] = "Tiheyskartta";
$text['refreshmap'] = "Päivitä kartta";
$text['remnums'] = "Tyhjennä numerot ja nastat";
$text['photoshistories'] = "Valokuvat ja Historiat";
$text['familychart'] = "Perhekaavio";
//added in 12.0.0
$text['firstnames'] = "Etunimet";
//moved here in 12.0.0
$text['dna_test'] = "DNA testi";
$text['test_type'] = "Testin tyyppi";
$text['test_info'] = "Testin tiedot";
$text['takenby'] = "Suorittaja";
$text['haplogroup'] = "Haplogroup";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevant links";
$text['nofirstname'] = "[ei etunimeä]";
//added in 12.0.1
$text['cookieuse'] = "Tämä sivusto käyttää evästeitä.";
$text['dataprotect'] = "Tietosuojaseloste";
$text['viewpolicy'] = "Näytä tietosuojaseloste";
$text['understand'] = "Ymmärrän";
$text['consent'] = "Annan suostumukseni tallentaa kerätyt henkilötiedot tälle sivustolle. Ymmärrän, että voin pyytää sivuston ylläpitäjää poistamaan tietoni pyydettäessä.";
$text['consentreq'] = "Ole hyvä ja anna suostumuksesi tallentaa henkilötietoja tälle sivustolle.";

//added in 12.1.0
$text['testsarelinked'] = "DNA-testit kytketty henkilöön";
$text['testislinked'] = "DNA-testi kytketty henkilöön";

//added in 12.2
$text['quicklinks'] = "Pikalinkit";
$text['yourname'] = "Nimesi";
$text['youremail'] = "Sähköpostiosoitteesi";
$text['liketoadd'] = "Kaikki tiedot, jotka haluat lisätä";
$text['webmastermsg'] = "Verkkovastaavan viesti";
$text['gallery'] = "Katso galleria";
$text['wasborn_male'] = "syntyi";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "syntyi"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "kastettiin";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "kastettiin";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "died";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "died";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "haudattiin"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "haudattiin"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "tuhrattiin";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "tuhrattiin";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "naimisissa";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "naimisissa";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "erotettiin";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "erotettiin";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = "sisään";			// used as a preposition to the location
$text['onthisdate'] = "päällä";		// when used with full date
$text['inthisyear'] = "sisään";		// when used with year only or month / year dates
$text['and'] = "ja";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA testi tiedot";
//added in 13.0
$text['visitor'] = "Vierailija";

$text['popupnote2'] = " = Uusi sukupuu tästä henkilöstä alkaen";

//moved here in 14.0
$text['zoomin'] = "Suurenna";
$text['zoomout'] = "Pienennä";
$text['scrollnote'] = "Vedä tai vieritä nähdäksesi enemmän kaaviosta.";
$text['general'] = "Yleinen";

//changed in 14.0
$text['otherevents'] = "Muut tapahtumat ja määritteet";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Yhteydet";
$text['continue'] = "Jatka";
$text['title2'] = "Otsikko"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>