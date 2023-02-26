<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Össze forrás böngészése";
		$text['shorttitle'] = "Rövid cím";
		$text['callnum'] = "Telefonszám";
		$text['author'] = "Szerző";
		$text['publisher'] = "Kiadó";
		$text['other'] = "További információ";
		$text['sourceid'] = "Forrás ID";
		$text['moresrc'] = "További források";
		$text['repoid'] = "Könyvtár ID";
		$text['browseallrepos'] = "Minden könyvtárban keres";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Új nyelv";
		$text['changelanguage'] = "Nyelvcsere";
		$text['languagesaved'] = "Nyelv mentése";
		$text['sitemaint'] = "Honlap karbantartás folyamatban";
		$text['standby'] = "A webhely átmenetileg elérhetetlen adatfrissítés miatt. Néhány perc múlva próbáld újra. Ha továbbra is elérhetetlen, kattints ide: <a href=\"suggest.php\">fordulj a webhely tulajdonosához</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM kezdve";
		$text['producegedfrom'] = "Készíts egy GEDCOM fájlt a";
		$text['numgens'] = "Nemzedékek száma";
		$text['includelds'] = "Tartalmazza az LDS információkat";
		$text['buildged'] = "GEDCOM mentése";
		$text['gedstartfrom'] = "GEDCOM kezdve";
		$text['nomaxgen'] = "Meg kell adni a generációk maximális számát. Kérem, használd a Vissza gombot az előző oldalra való visszatéréshez és a hiba kijavításához";
		$text['gedcreatedfrom'] = "A GEDCOM létrehozva";
		$text['gedcreatedfor'] = "számára készült";
		$text['creategedfor'] = "Hozz létre GEDCOM-ot";
		$text['email'] = "E-mail címed";
		$text['suggestchange'] = "Javasoljon változást";
		$text['yourname'] = "Neved";
		$text['comments'] = "A javasolt változtatások leírása";
		$text['comments2'] = "Megjegyzések";
		$text['submitsugg'] = "Javaslat elküldése";
		$text['proposed'] = "Javasolt változás";
		$text['mailsent'] = "Köszönöm. Az üzeneted el lett küldve.";
		$text['mailnotsent'] = "Sajnáljuk, de az üzenetet nem sikerült kézbesíteni. Kérlek, fordulj közvetlenül xxx -hez, yyy.";
		$text['mailme'] = "Küldjön másolatot erre a címre";
		$text['entername'] = "Kérem írd be a nevedet";
		$text['entercomments'] = "Kérem, írd be észrevételeit";
		$text['sendmsg'] = "Üzenet elküldése";
		//added in 9.0.0
		$text['subject'] = "Tárgy";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Képek és történetek";
		$text['indinfofor'] = "Egyedi információ";
		$text['pp'] = "old."; //page abbreviation
		$text['age'] = "Kor:";
		$text['agency'] = "Keresztelte";
		$text['cause'] = "Ok";
		$text['suggested'] = "Javaslat";
		$text['closewindow'] = "Ablak bezárása";
		$text['thanks'] = "Köszönöm";
		$text['received'] = "Javaslatodat elküldtük a webhely rendszergazdájának felülvizsgálatra.";
		$text['indreport'] = "A személy adatai";
		$text['indreportfor'] = "A személy adatai:";
		$text['bkmkvis'] = "<strong>Megjegyzés:</strong> Ezek a könyvjelzők csak ezen a számítógépen és ebben a böngészőben láthatók.";
        //added in 9.0.0
		$text['reviewmsg'] = "Van egy javasolt változtatása, amelyet felül kell vizsgálni. Ez az előterjesztés aggályos:";
        $text['revsubject'] = "A javasolt változtatás felülvizsgálatot igényel";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Rokonság-kalkulátor";
		$text['findrel'] = "Rokon keresése";
		$text['person1'] = "Személy 1:";
		$text['person2'] = "Személy 2:";
		$text['calculate'] = "Kiszámít";
		$text['select2inds'] = "Kérem, válasszon két személyt.";
		$text['findpersonid'] = "Keresse meg a személyi ID-t";
		$text['enternamepart'] = "írja be a kereszt- és/vagy vezetéknév egy részét";
		$text['pleasenamepart'] = "Kérem, add meg az utó- vagy vezetéknév egy részét.";
		$text['clicktoselect'] = "kattints a kiválasztáshoz";
		$text['nobirthinfo'] = "Nincs születési információ";
		$text['relateto'] = "Kapcsolat";
		$text['sameperson'] = "A két egyén ugyanaz a személy.";
		$text['notrelated'] = "A két egyén nem áll kapcsolatban xxx generációkon belül."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Két ember kapcsolatának megjelenítéséhez használd az alábbi „Keresés” gombokat az egyének megkereséséhez (vagy az emberek megjelenítéséhez), majd kattints a „Számítás” gombra.";
		$text['sometimes'] = "(Néha eltérő számú generáció ellenőrzése más eredményt ad.)";
		$text['findanother'] = "Keressen egy másik kapcsolatot";
		$text['brother'] = "fiútestvére";
		$text['sister'] = "nővére";
		$text['sibling'] = "testvére";
		$text['uncle'] = "nagybátyja:  xxx";
		$text['aunt'] = "nagynénje xxx";
		$text['uncleaunt'] = "nagybátyja/nagynénje: xxx";
		$text['nephew'] = "unokaöccse: xxx";
		$text['niece'] = "unokahúga: ";
		$text['nephnc'] = "unokaöccse/unokahúga: xxx";
		$text['removed'] = "alkalommal eltávolítva";
		$text['rhusband'] = "férje ";
		$text['rwife'] = "felesége ";
		$text['rspouse'] = "házastársa ";
		$text['son'] = "gyermeke";
		$text['daughter'] = "lánya";
		$text['rchild'] = "gyermeke";
		$text['sil'] = "veje";
		$text['dil'] = "menye";
		$text['sdil'] = "veje vagy menye";
		$text['gson'] = "xxx unokája";
		$text['gdau'] = "xxx unokája";
		$text['gsondau'] = "xxx unokája";
		$text['great'] = "nagy";
		$text['spouses'] = "házastársak";
		$text['is'] = "is";
		$text['changeto'] = "Váltás erre: (add meg az ID-t):";
		$text['notvalid'] = "nem érvényes személyazonosító szám, vagy nem létezik ebben az adatbázisban. Kérlek próbáld újra.";
		$text['halfbrother'] = "féltestvére";
		$text['halfsister'] = "féltestvére";
		$text['halfsibling'] = "féltestvére";
		//changed in 8.0.0
		$text['gencheck'] = "Az ellenőrzendő maximális generációk száma";
		$text['mcousin'] = "xxx első unokatestvérének a yyy";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx első unokatestvérének a yyy";  //female cousin
		$text['cousin'] = "xxx unokatestvére yyy";
		$text['mhalfcousin'] = "xxx fél-unokatestvére yyy-nak/nek";  //male cousin
		$text['fhalfcousin'] = "xxx fél-unokatestvére yyy-nak/nek";  //female cousin
		$text['halfcousin'] = "xxx fél-unokatestvére yyy-nak/nek";
		//added in 8.0.0
		$text['oneremoved'] = "gyermeke";
		$text['gfath'] = "xxx nagyapja";
		$text['gmoth'] = "xxx nagyanyja";
		$text['gpar'] = "xxx nagyanyja";
		$text['mothof'] = "anyja";
		$text['fathof'] = "apja";
		$text['parof'] = "szülője";
		$text['maxrels'] = "Megjeleníthető maximális kapcsolatok";
		$text['dospouses'] = "Mutasd meg a házastárssal való kapcsolatokat";
		$text['rels'] = "Kapcsolatok";
		$text['dospouses2'] = "Mutasd a házastársakat";
		$text['fil'] = "apósa";
		$text['mil'] = "anyósa";
		$text['fmil'] = "apósa, vagy anyósa";
		$text['stepson'] = "a mostohafia";
		$text['stepdau'] = "a mostohalánya";
		$text['stepchild'] = "a mostohagyermeke";
		$text['stepgson'] = "a mostohagyermeke";
		$text['stepgdau'] = "a xxx mostoha unokája";
		$text['stepgchild'] = "a xxx mostoha unokája";
		//added in 8.1.1
		$text['ggreat'] = "nagy";
		//added in 8.1.2
		$text['ggfath'] = "xxx nagyapja";
		$text['ggmoth'] = "xxx nagyanyja";
		$text['ggpar'] = "a xxx nagyszüle";
		$text['ggson'] = "a xxx dédunokája";
		$text['ggdau'] = "a xxx dédunokája";
		$text['ggsondau'] = "a xxx dédunokája";
		$text['gstepgson'] = "a xxx nagy mostoha unokája";
		$text['gstepgdau'] = "a xxx nagy mostoha unokája";
		$text['gstepgchild'] = "a xxx nagy mostoha unokája";
		$text['guncle'] = "xxx nagybátyja";
		$text['gaunt'] = "xxx nagynénje";
		$text['guncleaunt'] = "xxx nagybácsi/nagynénje";
		$text['gnephew'] = "xxx nagy unokaöccse";
		$text['gniece'] = "xxx nagy unokahúga";
		$text['gnephnc'] = "xxx nagy unokaöccse / unokahúga";
		//added in 14.0
		$text['pathscalc'] = "Kapcsolatok keresése";
		$text['findrel2'] = "Keressen rokonságot és egyéb kapcsolatokat";
		$text['makeme2nd'] = "Saját ID használata";
		$text['usebookmarks'] = "Használjon könyvjelzőket";
		$text['select2inds'] = "Kérem, válasszon két személyt.";
		$text['indinfofor'] = "Egyéni infó a(z)";
		$text['nobookmarks'] = "Nincs használható könyvjelző";
		$text['bkmtitle'] = "A könyvjelzők között talált személyek";
		$text['bkminfo'] = "Válasszon ki egy személyt:";
		$text['sortpathsby'] = "Rendezési útvonalak száma e szerint";
		$text['sortbyshort'] = "Sorrend (e szerint)";
		$text['bylengthshort'] = "Hosszan";
		$text['badID1'] = ": rossz személy1 ID – kérjük, menjen vissza és javítsa ki";
		$text['badID2'] = ": rossz személy2 azonosító – kérjük, menjen vissza és javítsa ki";
		$text['notintree'] = ": az ezzel az ID-vel rendelkező személy nem szerepel az aktuális fa adatbázisban.";
		$text['sameperson'] = "A két egyén ugyanaz a személy.";;
		$text['nopaths'] = "Ezek a személyek nincsenek kapcsolatban.";
		$text['nopaths1'] = "Nincs több ennél rövidebb kapcsolat: xxx";
		$text['nopaths2'] = "xxx keresési lépésben";
		$text['longestpath'] = "(az eddig ellenőrzött leghosszabb útvonal xxx lépés hosszú volt)";
		$text['relevantpaths'] = "A talált különböző releváns útvonalak száma: xxx";
		$text['skipMarr'] = "(emellett a talált, de a túl sok házasság miatt nem megjelenített utak száma is ez volt: xxx)";
		$text['mjaor'] = "vagy";
		$text['connectionsto'] = "Kapcsolatok ehhez ";
		$text['findanotherpers'] = "Keress másik embert...";
		$text['sometimes'] = "(Néha eltérő számú generáció ellenőrzése más eredményt ad.)";
		$text['anotherpath'] = "Keressen más kapcsolatokat";
		$text['xpath'] = "Útvonal ";
		$text['primary'] = "Kezdő személy"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Végső személy";
		$text['parent'] = "Szülő";
		$text['mhfather'] = "az apja";
		$text['mhmother'] = "az anyja";
		$text['mhhusband'] = "a férje";
		$text['mhwife'] = "a felesége";
		$text['mhson'] = "a fia";
		$text['mhdaughter'] = "a lánya";
		$text['fhfather'] = "haz apja";
		$text['fhmother'] = "az anyja";
		$text['fhhusband'] = "a férje";
		$text['fhwife'] = "a felesége";
		$text['fhson'] = "a fia";
		$text['fhdaughter'] = "a lánya";
		$text['hfather'] = "apa";
		$text['hmother'] = "anya";
		$text['hhusband'] = "férj";
		$text['hwife'] = "feleség";
		$text['hson'] = "fia";
		$text['hdaughter'] = "lánya";
		$text['maxruns'] = "Az ellenőrizendő útvonalak maximális száma";
		$text['maxrshort'] = "Max utak";
		$text['maxlength'] = "A csatlakozási utak nem hosszabbak, mint";
		$text['maxlshort'] = "Max hossz";
		$text['xstep'] = "lépés";
		$text['xsteps'] = "lépésben";
		$text['xmarriages'] = "xxx házasság";
		$text['xmarriage'] = "1. házasság";
		$text['showspouses'] = "Mutasd meg mindkét házastársat";
		$text['showTxt'] = "Szöveges útvonalleírás megjelenítése";
		$text['showTxtshort'] = "Szöveges útv.";
		$text['compactBox'] = "Személyes dobozok tömörített megjelenítése";
		$text['compactBoxshort'] = "Kompakt dobozok";
		$text['paths'] = "Útvonalak";
		$text['dospouses2'] = "Mutasd a házastársakat";
		$text['maxmopt'] = "Kapcsolatonkénti max. házasság";
		$text['maxm'] = "Max házasság";
		$text['arerelated'] = "Ezek a személyek rokonok - kapcsolatukat az 1. útvonal mutatja";
		$text['simplerel'] = "Egyszerű kapcsolatkeresés";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Családi csoport";
		$text['ldsords'] = "LDS előírások";
		$text['baptizedlds'] = "Megkeresztelkedett (LDS)";
		$text['endowedlds'] = "Endowed (LDS)";
		$text['sealedplds'] = "Sealed to Parents (LDS)";
		$text['sealedslds'] = "Sealed to Spouse (LDS)";
		$text['otherspouse'] = "Más házastárs";
		$text['husband'] = "Apa";
		$text['wife'] = "Anya";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "SZ";
		$text['capaltbirthabbr'] = "SZ";
		$text['capdeathabbr'] = "H";
		$text['capburialabbr'] = "T";
		$text['capplaceabbr'] = "H";
		$text['capmarrabbr'] = "E";
		$text['capspouseabbr'] = "PÁR";
		$text['redraw'] = "Újrarajzolni";
		$text['unknownlit'] = "Ismeretlen";
		$text['popupnote1'] = "További információ";
		$text['pedcompact'] = "Összetett";
		$text['pedstandard'] = "Szokásos";
		$text['pedtextonly'] = "Szöveg";
		$text['descendfor'] = "Leszármazása";
		$text['maxof'] = "Maximuma";
		$text['gensatonce'] = "egyszerre megjelenített generációk.";
		$text['sonof'] = "gyermeke:";
		$text['daughterof'] = "leánya";
		$text['childof'] = "gyermeke";
		$text['stdformat'] = "Normál formátum";
		$text['ahnentafel'] = "Családfa";
		$text['addnewfam'] = "Új család hozzáadása";
		$text['editfam'] = "Család szerkesztése";
		$text['side'] = "Oldal";
		$text['familyof'] = "Családja";
		$text['paternal'] = "Apai";
		$text['maternal'] = "Anyai";
		$text['gen1'] = "Önmaga";
		$text['gen2'] = "Szülők";
		$text['gen3'] = "Nagyszülők";
		$text['gen4'] = "Dédszülők";
		$text['gen5'] = "Ükszülők";
		$text['gen6'] = "Szépszülők";
		$text['gen7'] = "Szép-szépszülők";
		$text['gen8'] = "Szép-szép-szépszülők";
		$text['gen9'] = "Szép-szép-szép-szépszülők";
		$text['gen10'] = "Szép-szép-szép-szép-szépszülők";
		$text['gen11'] = "Szép-szép-szép-szép-szép-szépszülők";
		$text['gen12'] = "Szép-szép-szép-szép-szép-szép-szépszülők";
		$text['graphdesc'] = "Leszármazási diagram idáig";
		$text['pedbox'] = "Doboz";
		$text['regformat'] = "Generációk";
		$text['extrasexpl'] = "= Legalább egy fotó, előzmény vagy más médiaelem létezik ennél az egyénnél.";
		$text['popupnote3'] = "Új ábra";
		$text['mediaavail'] = "Média elérhető";
		$text['pedigreefor'] = "Származási ábrája";
		$text['pedigreech'] = "Származási ábra";
		$text['datesloc'] = "Dátumok és helyszínek";
		$text['borchr'] = "Születés/Alt - Halál/Temetés";
		$text['nobd'] = "Nincs születési vagy halálozási dátum";
		$text['bcdb'] = "Minden születési/alt/halál/temetkezési adat";
		$text['numsys'] = "Számozási rendszer";
		$text['gennums'] = "Generáció-számozás";
		$text['henrynums'] = "Henry számozás";
		$text['abovnums'] = "sz'Aboville számozás";
		$text['devnums'] = "de Villiers számozás";
		$text['dispopts'] = "Megjelenítési lehetőségek";
		//added in 10.0.0
		$text['no_ancestors'] = "Nem találtam ősöket";
		$text['ancestor_chart'] = "Vízszintes  ősábra";
		$text['opennewwindow'] = "Megnyitás új ablakban";
		$text['pedvertical'] = "Vízszintes";
		//added in 11.0.0
		$text['familywith'] = "Családja";
		$text['fcmlogin'] = "A részletek megtekintéséhez jelentkezz be";
		$text['isthe'] = "ban/ben";
		$text['otherspouses'] = "egyéb házastársak";
		$text['parentfamily'] = "A szülői család ";
		$text['showfamily'] = "Család megjelenítése";
		$text['shown'] = "látható";
		$text['showparentfamily'] = "szülői család megjelenítése";
		$text['showperson'] = "személy mutatása";
		//added in 11.0.2
		$text['otherfamilies'] = "Más családok";
		//added in 14.0
		$text['dtformat'] = "Táblázatok";
		$text['dtchildren'] = "Gyermekek";
		$text['dtgrandchildren'] = "Keresztgyerekek";
		$text['dtggrandchildren'] = "Dédunoka";
		$text['dtgggrandchildren'] = "Ük unoka"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Nincsenek leszármazottak";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Összes";
		$text['dtselect'] = "Válasszon";
		$text['dteachfulltable'] = "Minden tábla tele lesz";
		$text['dtrows'] = "sor";
		$text['dtdisplayingtable'] = "Tábla megjelenítése";
		$text['dtgototable'] = "Menjen a táblázathoz:";
		$text['fcinstrdn'] = "Mutasd meg a családot házastárssal";
		$text['fcinstrup'] = "Mutasd a családot a szülőkkel együtt";
		$text['fcinstrplus'] = "Válasszon más házastársat";
		$text['fcinstrfam'] = "Válasszon más szülőket";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Jelentés nem létezik.";
		$text['reportname'] = "Jelentés neve";
		$text['allreports'] = "Minden jelentés";
		$text['report'] = "Jelentés";
		$text['error'] = "Hiba";
		$text['reportsyntax'] = "A jelentéssel futó lekérdezés szintaxisa";
		$text['wasincorrect'] = "helyztelen volt  és ennek eredményeként a jelentést nem lehetett futtatni. Kérem, lépj kapcsolatba a rendszergazdával a következő címen:";
		$text['errormessage'] = "Hibaüzenet";
		$text['equals'] = "azonos";
		$text['endswith'] = "ezzel végződik ";
		$text['soundexof'] = "soundex a(z)";
		$text['metaphoneof'] = "hasonló";
		$text['plusminus10'] = "+/- 10 év ettől";
		$text['lessthan'] = "kevesebb mint";
		$text['greaterthan'] = "nagyobb mint";
		$text['lessthanequal'] = "kevesebb, vagy enyenlő";
		$text['greaterthanequal'] = "nagyobb, vagy enyenlő";
		$text['equalto'] = "egyenlő";
		$text['tryagain'] = "Próbáld újra";
		$text['joinwith'] = "Kapcsolat (logikai)";
		$text['cap_and'] = "ÉS";
		$text['cap_or'] = "VAGY";
		$text['showspouse'] = "Házastárs megjelenítése (megismétlődik, ha az egyénnek több házastársa van)";
		$text['submitquery'] = "Lekérdezés indítása";
		$text['birthplace'] = "Születési hely";
		$text['deathplace'] = "Halálozás helye";
		$text['birthdatetr'] = "Születési év";
		$text['deathdatetr'] = "Halálozás dátuma";
		$text['plusminus2'] = "+/- 2 év ettől";
		$text['resetall'] = "Az összes érték törlése";
		$text['showdeath'] = "Halálozási/temetési információ";
		$text['altbirthplace'] = "Keresztelés helye";
		$text['altbirthdatetr'] = "Keresztelés éve";
		$text['burialplace'] = "Temetés helye";
		$text['burialdatetr'] = "Temetés éve";
		$text['event'] = "Esemény";
		$text['day'] = "Nap";
		$text['month'] = "Hónap";
		$text['keyword'] = "Kulcsszó (pl, \"Kb.\")";
		$text['explain'] = "Add meg az adatkomponenst az adategyezőséghez. Hagyd a mezőt üresen az összes megjelenítéséhez.";
		$text['enterdate'] = "Kérem, add meg vagy válaszd ki az alábbiak közül legalább egyet: Nap, Hónap, Év, Kulcsszó";
		$text['fullname'] = "Teljes név";
		$text['birthdate'] = "Születési dátum";
		$text['altbirthdate'] = "Keresztelési dátum";
		$text['marrdate'] = "Házasság dátuma";
		$text['spouseid'] = "Házastárs ID";
		$text['spousename'] = "Házastárs neve";
		$text['deathdate'] = "Halálozás dátuma";
		$text['burialdate'] = "Temetés dátuma";
		$text['changedate'] = "Utolsó módosítás dátuma";
		$text['gedcom'] = "Családfa";
		$text['baptdate'] = "Baptism dátum (LDS)";
		$text['baptplace'] = "Baptism helye (LDS)";
		$text['endldate'] = "Endowment dátum (LDS)";
		$text['endlplace'] = "Endowment helye (LDS)";
		$text['ssealdate'] = "Seal dátum S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Seal helye S (LDS)";
		$text['psealdate'] = "Seal dátum P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Seal helye P (LDS)";
		$text['marrplace'] = "Házasság helye";
		$text['spousesurname'] = "Házastárs családneve";
		$text['spousemore'] = "Ha megadod a házastárs családnevét, a nemet is választanod kell.";
		$text['plusminus5'] = "+/- 5 év ettől";
		$text['exists'] = "létezik";
		$text['dnexist'] = "nem létezik";
		$text['divdate'] = "Válás dátuma";
		$text['divplace'] = "Válás helye";
		$text['otherevents'] = "Egyéb keresési kritérium";
		$text['numresults'] = "Laponkénti eredmény";
		$text['mysphoto'] = "Mesterségek képei";
		$text['mysperson'] = "Rejtett személy";
		$text['joinor'] = "'A Kapcsolat (logikai) VAGY' opció nem választható házastárs családnév esetén";
		$text['tellus'] = "Mond el Te mit tudsz";
		$text['moreinfo'] = "További információ:";
		//added in 8.0.0
		$text['marrdatetr'] = "Házasság éve";
		$text['divdatetr'] = "Válás éve";
		$text['mothername'] = "Az Anya neve";
		$text['fathername'] = "Az Apa neve";
		$text['filter'] = "Szűrő";
		$text['notliving'] = "Nem él";
		$text['nodayevents'] = "A hónap eseményei, amelyek nem kapcsolódnak egy adott naphoz:";
		//added in 9.0.0
		$text['csv'] = "Vesszővel elválasztott CSV-fájl";
		//added in 10.0.0
		$text['confdate'] = "Confirmation dátum (LDS)";
		$text['confplace'] = "Confirmation hely (LDS)";
		$text['initdate'] = "Initiatory dátum (LDS)";
		$text['initplace'] = "Initiatory hely (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Házasság típusa";
		$text['searchfor'] = "Keresés";
		$text['searchnote'] = "Megjegyzés: Ez az oldal a Google-t használja a kereséshez. A visszaküldött egyezések számát közvetlenül befolyásolja, hogy a Google milyen mértékben tudta indexelni a webhelyet.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Naplófájl a következőhöz:";
		$text['mostrecentactions'] = "Legfrissebb akciók";
		$text['autorefresh'] = "Automatikus frissítés (30 másodperc)";
		$text['refreshoff'] = "Kapcsolja ki az automatikus frissítést";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Temetők és sírkövek";
		$text['showallhsr'] = "Mutasd az összes sírköves rekordot";
		$text['in'] = "ban/ben";
		$text['showmap'] = "Térkép megjelenítése";
		$text['headstonefor'] = "Sírköve";
		$text['photoof'] = "Fotója";
		$text['photoowner'] = "Az eredeti tulajdonosa";
		$text['nocemetery'] = "Nincs temető";
		$text['iptc005'] = "Cím";
		$text['iptc020'] = "Supp. Kategóriák";
		$text['iptc040'] = "Különleges utasítások";
		$text['iptc055'] = "Létrehozás dátuma";
		$text['iptc080'] = "Szerző";
		$text['iptc085'] = "Szerző poziciója";
		$text['iptc090'] = "Város";
		$text['iptc095'] = "Állam/tartomány";
		$text['iptc101'] = "Ország";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Címsor";
		$text['iptc110'] = "Forrás";
		$text['iptc115'] = "Kép forrása";
		$text['iptc116'] = "Szerzői jogi közlemény";
		$text['iptc120'] = "Felirat";
		$text['iptc122'] = "Feliratíró";
		$text['mapof'] = "Térképe";
		$text['regphotos'] = "Leíró nézet";
		$text['gallery'] = "Csak bélyegképek";
		$text['cemphotos'] = "Temető fotók";
		$text['photosize'] = "Méretek";
        $text['iptc010'] = "Proritás";
		$text['filesize'] = "Fájlméret";
		$text['seeloc'] = "Lásd a helyet";
		$text['showall'] = "Mind mutasd";
		$text['editmedia'] = "Média szerkesztése";
		$text['viewitem'] = "Mutasd ezt az elemet";
		$text['editcem'] = "Temető szerkesztése";
		$text['numitems'] = "# Tételek";
		$text['allalbums'] = "Minden album";
		$text['slidestop'] = "Diavetítés szüneteltetése";
		$text['slideresume'] = "A diavetítés folytatása";
		$text['slidesecs'] = "Másodpercek minden egyes diához:";
		$text['minussecs'] = "minus 0.5 másodperc";
		$text['plussecs'] = "plus 0.5 másodperc";
		$text['nocountry'] = "Ismeretlen ország";
		$text['nostate'] = "Ismeretlen állam";
		$text['nocounty'] = "Ismeretlen megye";
		$text['nocity'] = "Ismeretlen város";
		$text['nocemname'] = "Ismeretlen temető neve";
		$text['editalbum'] = "Album szerkesztése";
		$text['mediamaptext'] = "<strong> Megjegyzés: </strong> Vidd az egérmutatót a kép fölé a nevek megjelenítéséhez. Kattints, hogy az egyes nevekhez megjelenjen egy oldal.";
		//added in 8.0.0
		$text['allburials'] = "Minden temetés";
		$text['moreinfo'] = "Kattints a képre vonatkozó további információkért";
		//added in 9.0.0
        $text['iptc025'] = "Kulcsszavak";
        $text['iptc092'] = "Alhelyzet";
		$text['iptc015'] = "Kategória";
		$text['iptc065'] = "Program eredete";
		$text['iptc070'] = "Program verzió";
		//added in 13.0
		$text['toggletags'] = "Tagok átkapcsolása";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Mutasd a családneveket az alábbi kezdőbetűvel";
		$text['showtop'] = "A legtöbb";
		$text['showallsurnames'] = "Mutasd az összes családnevet";
		$text['sortedalpha'] = "ÁBC szerinti sorrendben";
		$text['byoccurrence'] = "előfordulás szerint sorolva";
		$text['firstchars'] = "Első karakter";
		$text['mainsurnamepage'] = "Fő családnév oldal";
		$text['allsurnames'] = "Összes családnév";
		$text['showmatchingsurnames'] = "Kattints egy vezetéknévre az egyező rekordok megjelenítéséhez.";
		$text['backtotop'] = "Vissza a tetejére";
		$text['beginswith'] = "Kezdődik";
		$text['allbeginningwith'] = "Az összes családnév kezdődik a(z)";
		$text['numoccurrences'] = "zárójelben az összes helység száma";
		$text['placesstarting'] = "Mutassa a leggyakoribb helységeket kezdve";
		$text['showmatchingplaces'] = "Kattints egy helyre a kevesebb helység megjelenítéséhez. Kattints a keresés ikonra a megfelelő egyének megjelenítéséhez.";
		$text['totalnames'] = "összes egyén";
		$text['showallplaces'] = "Mutasd az összes leggyakoribb települést";
		$text['totalplaces'] = "összes hely";
		$text['mainplacepage'] = "Fő helyek oldal";
		$text['allplaces'] = "Az összes leggyakoribb helység";
		$text['placescont'] = "Az összes helyet tartalmazó hely megjelenítése";
		//changed in 8.0.0
		$text['top30'] = "Leggyakoribb xxx családnév";
		$text['top30places'] = "A leggyakoribb xxx helység";
		//added in 12.0.0
		$text['firstnamelist'] = "Keresztnév lista";
		$text['firstnamesstarting'] = "A keresztnevek kezdőbetűi";
		$text['showallfirstnames'] = "Az összes keresztnév megjelenítése";
		$text['mainfirstnamepage'] = "Fő keresztnév oldal";
		$text['allfirstnames'] = "Minden keresztnév";
		$text['showmatchingfirstnames'] = "Kattints az utónévre az egyező rekordok megjelenítéséhez.";
		$text['allfirstbegwith'] = "Minden keresztnév kezdve:";
		$text['top30first'] = "Legtöbb xxx családnév";
		$text['allothers'] = "Minden más";
		$text['amongall'] = "(az összes név közül)";
		$text['justtop'] = "Csak a legtöbb xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(xx elteltével)";

		$text['photo'] = "Fotó";
		$text['history'] = "Történet/Dokument";
		$text['husbid'] = "Apa ID";
		$text['husbname'] = "Az apa neve";
		$text['wifeid'] = "Anya ID";
		//added in 11.0.0
		$text['wifename'] = "Az anya neve";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Törlés";
		$text['addperson'] = "Személy megadása";
		$text['nobirth'] = "A következő személynek nincs érvényes születési dátuma, ezért nem adható hozzá";
		$text['event'] = "Esemény(ek)";
		$text['chartwidth'] = "Ábra-szélesség";
		$text['timelineinstr'] = "Személy hozzáadása";
		$text['togglelines'] = "Vonalak átkapcsolása";
		//changed in 9.0.0
		$text['noliving'] = "A következő személy élőként vagy privátként van megjelölve, és nem adható hozzá, mert nincs megfelelő jogosultsággal bejelentkezve";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Az összes családfában keresés";
		$text['treename'] = "Családfa neve";
		$text['owner'] = "Tulajdonos";
		$text['address'] = "Lakcím";
		$text['city'] = "Város";
		$text['state'] = "Állam/Tartomány";
		$text['zip'] = "Zip/Irányítószám";
		$text['country'] = "Ország";
		$text['email'] = "E-mail";
		$text['phone'] = "Telefon";
		$text['username'] = "Felhasználói név";
		$text['password'] = "Jelszó";
		$text['loginfailed'] = "Bejelentkezési hiba.";

		$text['regnewacct'] = "Új felhasználó fiók regisztrálása";
		$text['realname'] = "Valódi, teljes neve";
		$text['phone'] = "Telefon";
		$text['email'] = "E-mail";
		$text['address'] = "Lakcím";
		$text['acctcomments'] = "Megjegyzés, vagy vélemény";
		$text['submit'] = "Mehet";
		$text['leaveblank'] = "(hagy üresen, ha új családfát igényelsz)";
		$text['required'] = "Kötelező mezők";
		$text['enterpassword'] = "Kérem a jelszót add meg.";
		$text['enterusername'] = "Kérem a felhasználói nevedet.";
		$text['failure'] = "Sajnáljuk, de a megadott felhasználónév már használatban van. Kérem, használd a böngésző Vissza gombját az előző oldalra való visszatéréshez, és válassz másik felhasználónevet.";
		$text['success'] = "Köszönöm. Megkaptam regisztrációd. Ha fiókod aktív, vagy ha további információra van szükség, felveszem Veled a kapcsolatot.";
		$text['emailsubject'] = "Új TNG felhasználói regisztrációs kérelem";
		$text['website'] = "Honlap";
		$text['nologin'] = "Nincs még fiókod?";
		$text['loginsent'] = "Bejelentkezési információk elküldve";
		$text['loginnotsent'] = "A bejelentkezési információkat nem küldtük el";
		$text['enterrealname'] = "Kérjük, írd be a valódi nevét.";
		$text['rempass'] = "Maradjak bejelentkezve ezen a számítógépen";
		$text['morestats'] = "További statisztikák";
		$text['accmail'] = "<strong> MEGJEGYZÉS: </strong> Ahhoz, hogy a webhely adminisztrátorától e-mailt kapj a fiókoddal kapcsolatban, győződj meg arról, hogy nem blokkolja ebből a domainből érkező leveleket.";
		$text['newpassword'] = "Új jelszó";
		$text['resetpass'] = "A jelszavam megváltoztatása (Reset)";
		$text['nousers'] = "Ez az űrlap addig nem használható, amíg legalább egy felhasználói rekord nem létezik. Ha Te vagy a webhely tulajdonosa, kérem, lépj az Adminisztrátor/Felhasználók oldalra, és hozz létre rendszergazdai fiókot.";
		$text['noregs'] = "Sajnálom, de jelenleg nem fogadok el új felhasználói regisztrációkat. Kérem, közvetlenül <a href=\"suggest.php\"> vedd fel velem a kapcsolatot </a>, ha bármilyen észrevételed vagy kérdésed van ezen a webhelyen.";
		$text['emailmsg'] = "Új kérelmet kaptál egy TNG felhasználói fiókkal kapcsolatban. Kérem, jelentkezz be a TNG rendszergazdai területére, és rendelj hozzá megfelelő engedélyeket ehhez az új fiókhoz.";
		$text['accactive'] = "A fiók aktiválva van, de a felhasználónak nem lesznek külön jogai, amíg nem osztod ki őket.";
		$text['accinactive'] = "A fiókbeállítások eléréséhez lépj az Adminisztrátor/Felhasználók/Ellenőrzés oldalra. A fiók addig marad inaktív, amíg legalább egyszer nem szerkeszted és menteted a rekordot.";
		$text['pwdagain'] = "Jelszó újra";
		$text['enterpassword2'] = "Kérem, írd be újra a jelszavad.";
		$text['pwdsmatch'] = "A jelszó nem egyezik. Kérem, írd be ugyanazt a jelszót minden mezőbe.";
		$text['acksubject'] = "Köszönöm, hogy a regisztráltál"; //for a new user account
		$text['ackmessage'] = "Megkaptam felhasználói fiók iránti kérelmed. Fiókod inaktív lesz, amíg a webhely rendszergazdája át nem vizsgálja. E-mailben értesítlek, ha a bejelentkezése használatra kész.";
		//added in 12.0.0
		$text['switch'] = "Átkapcsol";
		//added in 14.0
		$text['newpassword2'] = "Új jelszó megint";
		$text['resetsuccess'] = "Sikeres: A jelszó visszaállítása megtörtént";
		$text['resetfail'] = "Hiba: A jelszó nem állítható vissza";
		$text['failreason0'] = " (ismeretlen adatbázis hiba)";
		$text['failreason2'] = " (nincs jogosultsága jelszava megváltoztatására)";
		$text['failreason3'] = " (a jelszó nem egyezik)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Tallózás az összes fiókban";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Mennyiség";
		$text['totindividuals'] = "Összes egyén";
		$text['totmales'] = "Össze férfi";
		$text['totfemales'] = "Összes nő";
		$text['totunknown'] = "Összes ismeretlen nemű";
		$text['totliving'] = "Összes élő";
		$text['totfamilies'] = "Összes család";
		$text['totuniquesn'] = "Összes egyedi vezetéknév";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Összes forrás";
		$text['avglifespan'] = "Átlagos élettartam";
		$text['earliestbirth'] = "Legkorábbi születés";
		$text['longestlived'] = "Leghosszabb élettartam";
		$text['days'] = "nap";
		$text['age'] = "Kor";
		$text['agedisclaimer'] = "Az életkorral kapcsolatos számítások rögzített születési <em> és </em> halálozási dátummal rendelkező egyéneken alapulnak. A hiányos dátummezők (például egy csak \"1945\" vagy \"BEF 1860\" néven felsorolt halálozási dátum) miatt ezek a számítások nem lehetnek 100% -ban pontosak.";
		$text['treedetail'] = "További információ erről a fáról";
		$text['total'] = "Teljes";
		//added in 12.0
		$text['totdeceased'] = "Total Deceased";
		//added in 14.0
		$text['totalsourcecitations'] = "Összes forráshivatkozás";
		break;

	case "notes":
		$text['browseallnotes'] = "Az összes megjegyzés böngészése";
		break;

	case "help":
		$text['menuhelp'] = "Menü név";
		break;

	case "install":
		$text['perms'] = "Az engedélyek mindegyike be van állítva.";
		$text['noperms'] = "Ezekhez a fájlokhoz nem lehet engedélyeket beállítani:";
		$text['manual'] = "Kérem, állítsd be őket kézzel.";
		$text['folder'] = "Mappa";
		$text['created'] = "létrejött";
		$text['nocreate'] = "nem hozható létre. Kérem, hozd létre manuálisan.";
		$text['infosaved'] = "Információ mentve, a kapcsolat ellenőrizve!";
		$text['tablescr'] = "A táblák elkészültek!";
		$text['notables'] = "A következő táblákat nem sikerült létrehozni:";
		$text['nocomm'] = "A TNG nem kommunikál az adatbázisával. Nincsenek táblázatok.";
		$text['newdb'] = "Mentett információk, a kapcsolat ellenőrzése, új adatbázis létrehozása:";
		$text['noattach'] = "Információ mentve. Csatlakozás létrejött és adatbázis létrehozva, de a TNG nem tud csatlakozni hozzá.";
		$text['nodb'] = "Információ mentve. Csatlakozás létrejött, de adatbázis nem létezik és nem hozható létre itt. Kérem, ellenőrizd, hogy az adatbázis neve helyes-e, és hogy az adatbázis felhasználója rendelkezik-e megfelelő hozzáféréssel, vagy használd a kezelőpanelt annak létrehozásához.";
		$text['noconn'] = "Az információ mentve, de a kapcsolat meghiúsult. Az alábbiak közül egy vagy több helytelen:";
		$text['exists'] = "már létezik.";
		$text['noop'] = "Nem végeztek műveletet.";
		//added in 8.0.0
		$text['nouser'] = "A felhasználót nem hozta létre. Lehet, hogy már létezik a felhasználónév.";
		$text['notree'] = "A fa nem jött létre. A fa azonosítója már létezhet.";
		$text['infosaved2'] = "Információ mentve";
		$text['renamedto'] = "átnevezve:";
		$text['norename'] = "nem lehetett átnevezni";
		//changed in 13.0.0
		$text['loginfirst'] = "Meglévő felhasználói rekordokat észleltem. A folytatáshoz először be kell jelentkezned, vagy el kell távolítani az összes rekordot a felhasználói táblából.";
		break;

	case "imgviewer":
		$text['magmode'] = "Nagyítási mód";
		$text['panmode'] = "Panoráma mód";
		$text['pan'] = "Kattints és húzd a képen való mozgáshoz";
		$text['fitwidth'] = "illeszkedési szélesség";
		$text['fitheight'] = "illeszkedési magasság";
		$text['newwin'] = "Új ablak";
		$text['opennw'] = "Kép megnyitása új ablakban";
		$text['magnifyreg'] = "Kattints a kép egy részének nagyításához";
		$text['imgctrls'] = "Képvezérlők engedélyezése";
		$text['vwrctrls'] = "Engedélyezd a Image Viewer vezérlőket";
		$text['vwrclose'] = "Image Viewer bezárása";
		break;

	case "dna":
		$text['test_date'] = "Teszt dátum";
		$text['links'] = "Releváns linkek";
		$text['testid'] = "Teszt ID";
		//added in 12.0.0
		$text['mode_values'] = "Módértékek";
		$text['compareselected'] = "Kiválasztott összehasonlítása";
		$text['dnatestscompare'] = "Hasonlítsd össze az Y-DNS tesztet";
		$text['keep_name_private'] = "Név privát";
		$text['browsealltests'] = "Tallózás az összes teszt között";
		$text['all_dna_tests'] = "Minden DNS-teszt";
		$text['fastmutating'] = "Gyors &nbsp; mutáció";
		$text['alltypes'] = "Minden típus";
		$text['allgroups'] = "Minden csoport";
		$text['Ydna_LITbox_info'] = "Az ehhez a személyhez kapcsolódó teszt(ek)et nem feltétlenül végezte el. <br/> A „Haplogroup” oszlop piros színnel jeleníti meg az adatokat, ha az eredmény „Jósolt”, vagy zöld, ha a teszt „Megerősítve”.";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Hasonlítsa össze a kiválasztott mtDNS teszteket";
		$text['dnatestscompare_atdna'] = "Hasonlítsa össze a kiválasztott atDNA teszteket";
		$text['chromosome'] = "Krom";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Extra mutációk";
		$text['mrca'] = "MRC ős";
		$text['ydna_test'] = "Y-DNA tesztek";
		$text['mtdna_test'] = "mtDNA (Mitochondrial) tesztek";
		$text['atdna_test'] = "atDNA (autosomal) tesztek";
		$text['segment_start'] = "Start";
		$text['segment_end'] = "Vége";
		$text['suggested_relationship'] = "Javasolt";
		$text['actual_relationship'] = "Actuális";
		$text['12markers'] = "Markers 1-12";
		$text['25markers'] = "Markers 13-25";
		$text['37markers'] = "Markers 26-37";
		$text['67markers'] = "Markers 38-67";
		$text['111markers'] = "Markers 68-111";
		//added in 13.1
		$text['comparemore'] = "At least two tests must be selected to compare.";
		break;
}

//common
$text['matches'] = "Egyezőségek";
$text['description'] = "Leírás";
$text['notes'] = "Megjegyzések";
$text['status'] = "Státusz";
$text['newsearch'] = "Új keresés";
$text['pedigree'] = "Leszármazás";
$text['seephoto'] = "Lásd a képet";
$text['andlocation'] = "&amp; hely";
$text['accessedby'] = "hozzáférés";
$text['children'] = "Gyermekek";  //from getperson
$text['tree'] = "Családfa";
$text['alltrees'] = "Minden családfa";
$text['nosurname'] = "[családnév nem]";
$text['thumb'] = "Bélyegkép";  //as in Thumbnail
$text['people'] = "Személy";
$text['title'] = "Cím";  //from getperson
$text['suffix'] = "Előtag";  //from getperson
$text['nickname'] = "Becenév";  //from getperson
$text['lastmodified'] = "Utoljára módosított";  //from getperson
$text['married'] = "Házas";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Név"; //from showmap
$text['lastfirst'] = "Családnév, Keresztnevek";  //from search
$text['bornchr'] = "Született/Keresztelt";  //from search
$text['individuals'] = "Egyének";  //from whats new
$text['families'] = "Család";
$text['personid'] = "Személy ID";
$text['sources'] = "Források";  //from getperson (next several)
$text['unknown'] = "Ismeretlen";
$text['father'] = "Apa";
$text['mother'] = "Anya";
$text['christened'] = "Keresztelt";
$text['died'] = "Elhunyt";
$text['buried'] = "Eltemetett";
$text['spouse'] = "Házastárs";  //from search
$text['parents'] = "Szülők";  //from pedigree
$text['text'] = "Szöveg";  //from sources
$text['language'] = "Nyelv";  //from languages
$text['descendchart'] = "Leszármazás";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Egyén";
$text['edit'] = "Szerkeszt";
$text['date'] = "Dátum";
$text['login'] = "Bejelentkezés";
$text['logout'] = "Kijelentkezés";
$text['groupsheet'] = "Családi lap";
$text['text_and'] = "és";
$text['generation'] = "Generáció";
$text['filename'] = "Fájlnév";
$text['id'] = "ID";
$text['search'] = "Névre keres";
$text['user'] = "Felhasználó";
$text['firstname'] = "Keresztnév";
$text['lastname'] = "Családnév";
$text['searchresults'] = "Keresési eredmények";
$text['diedburied'] = "Elhunyt/Eltemetve";
$text['homepage'] = "Kezdőlap";
$text['find'] = "Keresés...";
$text['relationship'] = "Rokonság";		//in German, Verwandtschaft
$text['relationship2'] = "Kapcsolat"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Idővonal";
$text['yesabbr'] = "I";               //abbreviation for 'yes'
$text['divorced'] = "Elvált";
$text['indlinked'] = "Ehhez tartozik";
$text['branch'] = "Ág";
$text['moreind'] = "Több egyén";
$text['morefam'] = "Több család";
$text['surnamelist'] = "Családnév lista";
$text['generations'] = "Generációk";
$text['refresh'] = "Frissítés";
$text['whatsnew'] = "Mi újság";
$text['reports'] = "Jelentések";
$text['placelist'] = "Helylista";
$text['baptizedlds'] = "Baptized (LDS)";
$text['endowedlds'] = "Endowed (LDS)";
$text['sealedplds'] = "Sealed P (LDS)";
$text['sealedslds'] = "Sealed S (LDS)";
$text['ancestors'] = "Felmenők";
$text['descendants'] = "Leszármazottak";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Az utolsó GEDCOM-importálás dátuma";
$text['type'] = "Típus";
$text['savechanges'] = "Változások mentése";
$text['familyid'] = "Család ID";
$text['headstone'] = "Sírkövek";
$text['historiesdocs'] = "Történetek";
$text['anonymous'] = "névtelen";
$text['places'] = "Helyek";
$text['anniversaries'] = "Dátumok és évfordulók";
$text['administration'] = "Adminisztráció";
$text['help'] = "Segítség";
//$text['documents'] = "Documents";
$text['year'] = "Év";
$text['all'] = "Mind";
$text['address'] = "Cím";
$text['suggest'] = "Javaslat";
$text['editevent'] = "Javasoljon változást ehhez az eseményhez";
$text['morelinks'] = "További linkek";
$text['faminfo'] = "Családi információ";
$text['persinfo'] = "Személyes információ";
$text['srcinfo'] = "Forrásinformáció";
$text['fact'] = "Tény";
$text['goto'] = "Válassz egy lapot";
$text['tngprint'] = "Nyomtat";
$text['databasestatistics'] = "Statisztikák"; //needed to be shorter to fit on menu
$text['child'] = "Gyermek";  //from familygroup
$text['repoinfo'] = "Gyűjtemény-információ";
$text['tng_reset'] = "Alaphelyzet";
$text['noresults'] = "Nem található";
$text['allmedia'] = "Minden média";
$text['repositories'] = "Könyvtárak";
$text['albums'] = "Albumok";
$text['cemeteries'] = "Temetők";
$text['surnames'] = "Családnevek";
$text['dates'] = "Dátumok";
$text['link'] = "Link";
$text['media'] = "Média";
$text['gender'] = "Nem";
$text['latitude'] = "Szélesség";
$text['longitude'] = "Hosszúság";
$text['bookmarks'] = "Könyvjelzők";
$text['bookmark'] = "Könyvjelző";
$text['mngbookmarks'] = "Könyvjelzőhöz ugrás";
$text['bookmarked'] = "Könyvjelző elhelyezése";
$text['remove'] = "Eltávolít";
$text['find_menu'] = "Keresés";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Temető";
$text['gmapevent'] = "Esemény-térkép";
$text['gevents'] = "Esemény";
$text['googleearthlink'] = "Link a Google Earth-höz";
$text['googlemaplink'] = "Link a Google Maps-hez";
$text['gmaplegend'] = "Gombostű jelmagyarázat";
$text['unmarked'] = "Jelöletlen";
$text['located'] = "Elhelyezett";
$text['albclicksee'] = "Katt ide az album összes tartalmának megtekintéséhez";
$text['notyetlocated'] = "Még nincs elhelyezve";
$text['cremated'] = "Hamvasztott";
$text['missing'] = "Eltűnt";
$text['pdfgen'] = "PDF Generátor";
$text['blank'] = "Üres ábra";
$text['fonts'] = "Betűk";
$text['header'] = "Fejléc";
$text['data'] = "Adat";
$text['pgsetup'] = "Oldalbeállítás";
$text['pgsize'] = "Lapméret";
$text['orient'] = "Tájolás"; //for a page
$text['portrait'] = "Portré";
$text['landscape'] = "Fekvő";
$text['tmargin'] = "Felső margó";
$text['bmargin'] = "Alsó margó";
$text['lmargin'] = "Bal margó";
$text['rmargin'] = "Jobb margó";
$text['createch'] = "Ábra készítése";
$text['prefix'] = "Előtag";
$text['mostwanted'] = "Legkeresettebb";
$text['latupdates'] = "Legutoljára frissítve";
$text['featphoto'] = "További képek";
$text['news'] = "Újdonságok";
$text['ourhist'] = "Családunk története";
$text['ourhistanc'] = "Családunk története és leszármazása";
$text['ourpages'] = "Családtörténeti lapunk";
$text['pwrdby'] = "Ezt a rendszert támogatja:";
$text['writby'] = "fejlesztette:";
$text['searchtngnet'] = "Keresés a TNG Network-ön (GENDEX)";
$text['viewphotos'] = "Az összes kép megjelenítése";
$text['anon'] = "Jelenleg névtelen vagy";
$text['whichbranch'] = "Melyik ágból való vagy?";
$text['featarts'] = "További linkek:";
$text['maintby'] = "Ezt a honlapot üzemelteti:";
$text['createdon'] = "Létrehozva";
$text['reliability'] = "Megbízhatóság";
$text['labels'] = "Címkék";
$text['inclsrcs'] = "Forrásokkal";
$text['cont'] = "(folyt.)"; //abbreviation for continued
$text['mnuheader'] = "Kezdőlap";
$text['mnusearchfornames'] = "Keresés";
$text['mnulastname'] = "Családnév";
$text['mnufirstname'] = "Keresztnév";
$text['mnusearch'] = "Keresés";
$text['mnureset'] = "Elölről kezdés";
$text['mnulogon'] = "Bejelentkezés";
$text['mnulogout'] = "Kijelentkezés";
$text['mnufeatures'] = "Továbbiak";
$text['mnuregister'] = "Új felhasználói fiók regisztrálása";
$text['mnuadvancedsearch'] = "Összetett keresés";
$text['mnulastnames'] = "Vezetéknevek";
$text['mnustatistics'] = "Statisztikák";
$text['mnuphotos'] = "Képek";
$text['mnuhistories'] = "Történetek";
$text['mnumyancestors'] = "Fotók & amp; A [személy] őseinek története";
$text['mnucemeteries'] = "Temetők";
$text['mnutombstones'] = "Sírkövek";
$text['mnureports'] = "Jelentések";
$text['mnusources'] = "Források";
$text['mnuwhatsnew'] = "Mi újgág";
$text['mnushowlog'] = "Eseménynapló";
$text['mnulanguage'] = "Nyelvcsere";
$text['mnuadmin'] = "Adminisztráció";
$text['welcome'] = "Üdvözöllek";
$text['contactus'] = "Kapcsolat";
//changed in 8.0.0
$text['born'] = "Született";
$text['searchnames'] = "Személy keresése";
//added in 8.0.0
$text['editperson'] = "Személy szerkesztése";
$text['loadmap'] = "Töltse be a térképet";
$text['birth'] = "Születés";
$text['wasborn'] = "született";
$text['startnum'] = "Kezdőszám";
$text['searching'] = "Keresés";
//moved here in 8.0.0
$text['location'] = "Hely";
$text['association'] = "Összefüggés";
$text['collapse'] = "Összecsukás";
$text['expand'] = "Kiterjesztés";
$text['plot'] = "Parcella";
$text['searchfams'] = "Családok keresése";
//added in 8.0.2
$text['wasmarried'] = "Házas";
$text['anddied'] = "Elhunyt";
//added in 9.0.0
$text['share'] = "Megosztás";
$text['hide'] = "Elrejtés";
$text['disabled'] = "Felhasználói fiókját letiltottuk. További információért forduljon a webhely rendszergazdájához.";
$text['contactus_long'] = "Ha kérdésed, vagy véleményed van erről a honlapról, légy szíves <span class=\"emphasis\"><a href=\"suggest.php\">lépj kapcsolatba velem.</a></span>. Szeretném hallani a véleményed.";
$text['features'] = "Jellemzők";
$text['resources'] = "Források";
$text['latestnews'] = "Utolsó hírek";
$text['trees'] = "Családfák";
$text['wasburied'] = "eltemetve";
//moved here in 9.0.0
$text['emailagain'] = "E-mail ismét";
$text['enteremail2'] = "Kérlek, add meg az e-mail címedet ismét.";
$text['emailsmatch'] = "Az e-mail címed nem azonos. Kérlek, mindkét mezőben azonos e-mail címet adj meg.";
$text['getdirections'] = "Klikk ide az utasításokhoz";
$text['calendar'] = "Naptár";
//changed in 9.0.0
$text['directionsto'] = " a/az ";
$text['slidestart'] = "Diavetítés";
$text['livingnote'] = "Legalább egy élő- vagy rejtett személy kapcsolódik ehhez a megjegyzéshez - a részlet rejtve.";
$text['livingphoto'] = "Legalább egy élő- vagy rejtett személy kapcsolódik ehhez az adathoz - a részletek rejtve.";
$text['waschristened'] = "keresztelt";
//added in 10.0.0
$text['branches'] = "Ágak";
$text['detail'] = "Részletek";
$text['moredetail'] = "Több részlet";
$text['lessdetail'] = "Kevesebb részlet";
$text['conflds'] = "Konfirmáás (LDS)";
$text['initlds'] = "Beavatás (LDS)";
$text['wascremated'] = "eltemetve";
//moved here in 11.0.0
$text['text_for'] = "nak/nek";
//added in 11.0.0
$text['searchsite'] = "Ezt a honlapot keresd";
$text['searchsitemenu'] = "Honlap keresése";
$text['kmlfile'] = "Töltsd le a .kml fájlt a hely megtekintéséhez a Google Earth-ben";
$text['download'] = "Katt ide a letöltéshez";
$text['more'] = "Több";
$text['heatmap'] = "Hőtérkép";
$text['refreshmap'] = "Friss térkép";
$text['remnums'] = "Gombostűk és számok törlése";
$text['photoshistories'] = "Képek &amp; Történetek";
$text['familychart'] = "Családábra";
//added in 12.0.0
$text['firstnames'] = "Keresztnevek";
//moved here in 12.0.0
$text['dna_test'] = "DNA Teszt";
$text['test_type'] = "Teszt típusa";
$text['test_info'] = "Teszt Információ";
$text['takenby'] = "Készítette";
$text['haplogroup'] = "Haplo csoport";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Releváns kapcsolat";
$text['nofirstname'] = "[keresztnév nélkül]";
//added in 12.0.1
$text['cookieuse'] = "Figyelem: Ez a webhely cookie-kat használ!";
$text['dataprotect'] = "Adatvédelmi politika";
$text['viewpolicy'] = "Politika megtekintése";
$text['understand'] = "Megértettem";
$text['consent'] = "Hozzájárulásom adom személyes adataim gyűjtésére és tárolására itt. Megértettem, hogy bármikor kérhetem ezek eltávolítására a honlapról.";
$text['consentreq'] = "Kérem hozzájárulásodat személyes adataid tárolására a honlap számára.";

//added in 12.1.0
$text['testsarelinked'] = "DNS-vizsgálatok társulnak";
$text['testislinked'] = "DNS-teszt társul";

//added in 12.2
$text['quicklinks'] = "Gyors linkek";
$text['yourname'] = "Neved";
$text['youremail'] = "E-mail címed";
$text['liketoadd'] = "Bármely hozzáadni kívánt információ";
$text['webmastermsg'] = "Webmester üzenet";
$text['gallery'] = "Lásd: Galéria";
$text['wasborn_male'] = "született:";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "született:"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "keresztelés:";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "keresztelés:";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "elhunyt";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "elhunyt";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "temetés:"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "temetés:"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "elhamvasztva:";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "elhamvasztva:";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "megházasodott:";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "házas";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "elvált";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "elvált";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = "-ban/ben ";			// used as a preposition to the location
$text['onthisdate'] = "ekkor";		// when used with full date
$text['inthisyear'] = "ebbennen az évben";		// when used with year only or month / year dates
$text['and'] = "és ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Teszt Info";
//added in 13.0
$text['visitor'] = "Látogatók";

$text['popupnote2'] = "Új családfa";

//moved here in 14.0
$text['zoomin'] = "Nagyítás";
$text['zoomout'] = "Kicsinyítés";
$text['scrollnote'] = "Ragadd meg, vagy görgess az ábra többi részének megtekintéséhez.";
$text['general'] = "Általános";

//changed in 14.0
$text['otherevents'] = "Egyéb események és attribútumok";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Kapcsolatok";
$text['continue'] = "Folytatás";
$text['title2'] = "Cím"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>