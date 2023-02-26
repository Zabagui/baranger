<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Prebrskaj vse vire";
		$text['shorttitle'] = "Kratek naslov";
		$text['callnum'] = "Klicna številka";
		$text['author'] = "Avtor";
		$text['publisher'] = "Založnik";
		$text['other'] = "Drugi podatki";
		$text['sourceid'] = "Koda vira";
		$text['moresrc'] = "Več virov";
		$text['repoid'] = "Koda zbirke virov";
		$text['browseallrepos'] = "Prebrskaj vse zbirke virov";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nov jezik";
		$text['changelanguage'] = "Spremeni jezik";
		$text['languagesaved'] = "Jezik je shranjen";
		$text['sitemaint'] = "Vzdrževanje spletnega mesta; prosimo, počakajte.";
		$text['standby'] = "Spletna stran trenutno ni dostopna, ker posodabljamo bazo podatkov. Poskusite znova čez nekaj minut. Če spletna stran še vedno ne deluje, se <a href=\"suggest.php\">obrnite na lastnika spletne strani</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM se začne od";
		$text['producegedfrom'] = "Izdelaj GEDCOM datoteko za";
		$text['numgens'] = "Število generacij";
		$text['includelds'] = "Vključi podatke LDS (Mormonske cerkve)";
		$text['buildged'] = "Izdelaj GEDCOM";
		$text['gedstartfrom'] = "GEDCOM naj se začne od";
		$text['nomaxgen'] = "Navedi maksimalno število generacij. Uporabi gumb Nazaj, da se vrneš na prejšnjo stran in popraviš napako";
		$text['gedcreatedfrom'] = "GEDCOM ustvarjen od";
		$text['gedcreatedfor'] = "ustvarjen";
		$text['creategedfor'] = "Ustvari GEDCOM";
		$text['email'] = "Tvoj e-naslov";
		$text['suggestchange'] = "Predlagaj spremembo za";
		$text['yourname'] = "Tvoje ime";
		$text['comments'] = "Opis<br />predlaganih sprememb";
		$text['comments2'] = "Tvoje sporočilo";
		$text['submitsugg'] = "Pošlji predlog";
		$text['proposed'] = "Predlagana sprememba";
		$text['mailsent'] = "Hvala. Vaše sporočilo je bilo poslano.";
		$text['mailnotsent'] = "Žal vašega sporočila ni bilo mogoče poslati. Obrnite se neposredno na xxx v yyy.";
		$text['mailme'] = "Pošlji si kopijo e-pisma na ta e-naslov";
		$text['entername'] = "Vnesi svoje ime";
		$text['entercomments'] = "Vnesi svoj komentar";
		$text['sendmsg'] = "Pošlji sporočilo";
		//added in 9.0.0
		$text['subject'] = "Zadeva";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografije in zgodbe od";
		$text['indinfofor'] = "Osebni podatki od";
		$text['pp'] = "str."; //page abbreviation
		$text['age'] = "starost";
		$text['agency'] = "Ustanova";
		$text['cause'] = "Vzrok";
		$text['suggested'] = "Predlagano";
		$text['closewindow'] = "Zapri okno";
		$text['thanks'] = "Hvala";
		$text['received'] = "Vaš predlog je bil posredovan skrbniku spletnega mesta v pregled.";
		$text['indreport'] = "Osebno poročilo";
		$text['indreportfor'] = "Osebno poročilo za";
		$text['bkmkvis'] = "<strong>Opomba:</strong> Ti zaznamki so vidni samo na tem računalniku in v tem brskalniku.";
        //added in 9.0.0
		$text['reviewmsg'] = "Nekdo je poslal predlog za spremembo, ki ga morate pregledati. Zadeva:";
        $text['revsubject'] = "Predlog za spremembo zahteva vaš pregled";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Kalkulator razmerij";
		$text['findrel'] = "Iskanje razmerij med osebami";
		$text['person1'] = "Oseba 1:";
		$text['person2'] = "Oseba 2:";
		$text['calculate'] = "Izračunaj";
		$text['select2inds'] = "Izberi dve osebi.";
		$text['findpersonid'] = "Poišči kodo osebe";
		$text['enternamepart'] = "Vnesi del imena in/ali priimka";
		$text['pleasenamepart'] = "Vnesi del imena ali priimka.";
		$text['clicktoselect'] = "Klikni za izbiro";
		$text['nobirthinfo'] = "Ni podatkov o rojstvu";
		$text['relateto'] = "Razmerje z:";
		$text['sameperson'] = "Ta dva posameznika sta ista oseba.";
		$text['notrelated'] = "Ti dve osebi nimata razmerja v xxx generacijah."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Najprej izberi osebi, za kateri želiš izvedeti, kakšno je njuno razmerje - za to uporabi spodnja gumba 'Poišči' (ali pa pusti že izbrani osebi). Nato klikni gumb 'Izračunaj'.";
		$text['sometimes'] = "(Preverjanje drugačnega števila generacij lahko da drugačen rezultat.)";
		$text['findanother'] = "Poišči drugo razmerje";
		$text['brother'] = "brat od:";
		$text['sister'] = "sestra od:";
		$text['sibling'] = "brat ali sestra od:";
		$text['uncle'] = "xxx stric od:";
		$text['aunt'] = "xxx teta od:";
		$text['uncleaunt'] = "xxx stric/teta od:";
		$text['nephew'] = "xxx nečak od:";
		$text['niece'] = "xxx nečakinja od:";
		$text['nephnc'] = "xxx nečak(inja) od:";
		$text['removed'] = "kolenu";
		$text['rhusband'] = "mož od:";
		$text['rwife'] = "žena od:";
		$text['rspouse'] = "zakonec od:";
		$text['son'] = "sin od:";
		$text['daughter'] = "hčerka od:";
		$text['rchild'] = "otrok od:";
		$text['sil'] = "zet od:";
		$text['dil'] = "snaha od:";
		$text['sdil'] = "zet ali snaha od:";
		$text['gson'] = "xxx vnuk od:";
		$text['gdau'] = "xxx vnukinja od:";
		$text['gsondau'] = "xxx vnuk(inja) od:";
		$text['great'] = "pra";
		$text['spouses'] = "sta zakonca";
		$text['is'] = "je";
		$text['changeto'] = "Vnesi kodo osebe ali klikni 'Poišči':";
		$text['notvalid'] = "ni veljavna koda osebe ali ni v tej bazi podatkov. Poskusite znova.";
		$text['halfbrother'] = "polbrat od:";
		$text['halfsister'] = "polsestra od:";
		$text['halfsibling'] = "polbrat ali polsestra od:";
		//changed in 8.0.0
		$text['gencheck'] = "Maksimalno število generacij za preverjanje";
		$text['mcousin'] = "xxx je bratranec yyy od:";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx je sestrična yyy od:";  //female cousin
		$text['cousin'] = "xxx je bratranec ali sestrična yyy od:";
		$text['mhalfcousin'] = "xxx je polbratranec yyy od:";  //male cousin
		$text['fhalfcousin'] = "xxx je polsestrična yyy od:";  //female cousin
		$text['halfcousin'] = "xxx je polbratranec ali polsestrična yyy od:";
		//added in 8.0.0
		$text['oneremoved'] = "v prvem kolenu";
		$text['gfath'] = "dedek xxx od:";
		$text['gmoth'] = "babica xxx od:";
		$text['gpar'] = "dedek ali babica xxx";
		$text['mothof'] = "mati od:";
		$text['fathof'] = "oče od:";
		$text['parof'] = "oče ali mati od:";
		$text['maxrels'] = "Maksimalno število razmerij za prikaz";
		$text['dospouses'] = "Prikaži razmerja, ki vključujejo zakonca";
		$text['rels'] = "Razmerja";
		$text['dospouses2'] = "Prikaži zakonca";
		$text['fil'] = "tast od:";
		$text['mil'] = "tašča od:";
		$text['fmil'] = "tast ali tašča od:";
		$text['stepson'] = "pastorek od:";
		$text['stepdau'] = "pastorka od:";
		$text['stepchild'] = "pastorek(ka) od:";
		$text['stepgson'] = "vnuk-pastorek xxx od:";
		$text['stepgdau'] = "vnukinja-pastorka xxx od:";
		$text['stepgchild'] = "vnuk-pastorek ali vnukinja-pastorka xxx od:";
		//added in 8.1.1
		$text['ggreat'] = "pra";
		//added in 8.1.2
		$text['ggfath'] = "pradedek xxx od:";
		$text['ggmoth'] = "prababica xxx od:";
		$text['ggpar'] = "pradedek ali prababica xxx od:";
		$text['ggson'] = "pravnuk xxx od:";
		$text['ggdau'] = "pravnukinja xxx od:";
		$text['ggsondau'] = "pravnuk(inja) xxx od:";
		$text['gstepgson'] = "pravnuk-pastorek xxx od:";
		$text['gstepgdau'] = "pravnukinja-pastorka xxx od:";
		$text['gstepgchild'] = "pravnuk-pastorek ali pravnukinja-pastorka xxx od:";
		$text['guncle'] = "prastric xxx od:";
		$text['gaunt'] = "prateta xxx od:";
		$text['guncleaunt'] = "prastric ali prateta xxx od:";
		$text['gnephew'] = "pranečak xxx od:";
		$text['gniece'] = "pranečakinja xxx od:";
		$text['gnephnc'] = "pranečak(inja) xxx od:";
		//added in 14.0
		$text['pathscalc'] = "Poišči povezave";
		$text['findrel2'] = "Poišči sorodstvene in druge povezave";
		$text['makeme2nd'] = "Uporabi mojo št.";
		$text['usebookmarks'] = "Uporabi zaznamke";
		$text['select2inds'] = "Izberi dve osebi.";
		$text['indinfofor'] = "Podatki o osebi";
		$text['nobookmarks'] = "Ni zaznamkov";
		$text['bkmtitle'] = "Osebe v zaznamkih";
		$text['bkminfo'] = "Izberi osebo:";
		$text['sortpathsby'] = "Razvrsti poti po številu";
		$text['sortbyshort'] = "Razvrsti po";
		$text['bylengthshort'] = "Dolžina";
		$text['badID1'] = ": nepravilno št. prve osebe – poskusi znova";
		$text['badID2'] = ": nepravilno št. druge osebe – poskusi znova";
		$text['notintree'] = ": v bazi podatkov tega drevesa ni osebe s tem številom.";
		$text['sameperson'] = "Ta dva posameznika sta ista oseba.";;
		$text['nopaths'] = "Ti dve osebi nista povezani.";
		$text['nopaths1'] = " Ni več povezav, krajših od xxx";
		$text['nopaths2'] = "v xxx korakih iskanja";
		$text['longestpath'] = "(najdaljša preverjena pot je bila dolga xxx korakov)";
		$text['relevantpaths'] = "Najdenih različnih ustreznih poti: xxx";
		$text['skipMarr'] = "(število poti, ki niso bile prikazane zaradi prevelikega števila porok: xxx)";
		$text['mjaor'] = "ali";
		$text['connectionsto'] = "Povezave s/z ";
		$text['findanotherpers'] = "Poišči drugo osebo ...";
		$text['sometimes'] = "(Preverjanje drugačnega števila generacij lahko da drugačen rezultat.)";
		$text['anotherpath'] = "Poišči druge povezave";
		$text['xpath'] = "Pot ";
		$text['primary'] = "Začetna oseba"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Končna oseba";
		$text['parent'] = "Starš";
		$text['mhfather'] = "his father";
		$text['mhmother'] = "his mother";
		$text['mhhusband'] = "his husband";
		$text['mhwife'] = "his wife";
		$text['mhson'] = "his son";
		$text['mhdaughter'] = "her daughter";
		$text['fhfather'] = "her father";
		$text['fhmother'] = "her mother";
		$text['fhhusband'] = "her husband";
		$text['fhwife'] = "her wife";
		$text['fhson'] = "her son";
		$text['fhdaughter'] = "her daughter";
		$text['hfather'] = "oče";
		$text['hmother'] = "mati";
		$text['hhusband'] = "mož";
		$text['hwife'] = "žena";
		$text['hson'] = "sin";
		$text['hdaughter'] = "hčer";
		$text['maxruns'] = "Največje število poti za preverjanje";
		$text['maxrshort'] = "Največ poti";
		$text['maxlength'] = "Poti povezav niso daljše od";
		$text['maxlshort'] = "Največja dolžina";
		$text['xstep'] = "korak";
		$text['xsteps'] = "korakov";
		$text['xmarriages'] = "xxx porok";
		$text['xmarriage'] = "1 poroka";
		$text['showspouses'] = "Prikaži oba zakonca";
		$text['showTxt'] = "Prikaži tekstovni opis poti";
		$text['showTxtshort'] = "Tekstovni opis";
		$text['compactBox'] = "Prikaži polja za osebe zgoščeno";
		$text['compactBoxshort'] = "Zgoščena polja";
		$text['paths'] = "Poti";
		$text['dospouses2'] = "Prikaži zakonca";
		$text['maxmopt'] = "Največje št. porok na povezavo";
		$text['maxm'] = "Največje št. porok";
		$text['arerelated'] = "Povezavo teh sorodnikov kaže Pot 1";
		$text['simplerel'] = "Preprosto iskanje sorodstvenih povezav";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Družinski skupinski list za";
		$text['ldsords'] = "LDS Ordinances";
		$text['baptizedlds'] = "Baptized (LDS)";
		$text['endowedlds'] = "Endowed (LDS)";
		$text['sealedplds'] = "Sealed to Parents (LDS)";
		$text['sealedslds'] = "Sealed to Spouse (LDS)";
		$text['otherspouse'] = "Drug zakonec";
		$text['husband'] = "Oče";
		$text['wife'] = "Mati";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "R";
		$text['capaltbirthabbr'] = "A";
		$text['capdeathabbr'] = "S";
		$text['capburialabbr'] = "Pok";
		$text['capplaceabbr'] = "K";
		$text['capmarrabbr'] = "Por";
		$text['capspouseabbr'] = "Z";
		$text['redraw'] = "Znova ustvari z";
		$text['unknownlit'] = "Neznano";
		$text['popupnote1'] = "Dodatni podatki";
		$text['pedcompact'] = "Strnjeno";
		$text['pedstandard'] = "Standardno";
		$text['pedtextonly'] = "Besedilo";
		$text['descendfor'] = "Potomci od:";
		$text['maxof'] = "Maksimalno";
		$text['gensatonce'] = "generacije, prikazane naenkrat.";
		$text['sonof'] = "sin od:";
		$text['daughterof'] = "hčerka od:";
		$text['childof'] = "otrok od:";
		$text['stdformat'] = "Standardna oblika";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Dodaj novo Družino";
		$text['editfam'] = "Uredi Družino";
		$text['side'] = "Stran";
		$text['familyof'] = "Družina od:";
		$text['paternal'] = "po očetovi strani";
		$text['maternal'] = "po materini strani";
		$text['gen1'] = "Jaz";
		$text['gen2'] = "Starši";
		$text['gen3'] = "dedek in babica";
		$text['gen4'] = "Prastarši";
		$text['gen5'] = "Praprastarši";
		$text['gen6'] = "3-kratni prastarši";
		$text['gen7'] = "4-kratni prastarši";
		$text['gen8'] = "5-kratni prastarši";
		$text['gen9'] = "6-kratni prastarši";
		$text['gen10'] = "7-kratni prastarši";
		$text['gen11'] = "8-kratni prastarši";
		$text['gen12'] = "9-kratni prastarši";
		$text['graphdesc'] = "Diagram potomcev do najnovejšega časa";
		$text['pedbox'] = "Kvadrati";
		$text['regformat'] = "Register";
		$text['extrasexpl'] = "= Ta oseba ima priloženo najmanj eno fotografijo, zgodbo ali drugo datoteko.";
		$text['popupnote3'] = "Nov diagram";
		$text['mediaavail'] = "Na voljo so priložene datoteke";
		$text['pedigreefor'] = "Diagram rodovnika za";
		$text['pedigreech'] = "Diagram rodovnika";
		$text['datesloc'] = "Datumi in lokacije";
		$text['borchr'] = "Rojstvo/Alt - Smrt/Pokop";
		$text['nobd'] = "Manjka datum rojstva ali smrti";
		$text['bcdb'] = "Vsi podatki za Rojstvo / Alt / Smrt / Pokop";
		$text['numsys'] = "Sistem številčenja";
		$text['gennums'] = "Številke generacij";
		$text['henrynums'] = "Henry številčenje";
		$text['abovnums'] = "d'Aboville številčenje";
		$text['devnums'] = "de Villiers številčenje";
		$text['dispopts'] = "Možnosti prikaza";
		//added in 10.0.0
		$text['no_ancestors'] = "Ni najdenih prednikov";
		$text['ancestor_chart'] = "Navpični diagram prednikov";
		$text['opennewwindow'] = "Odpri v novem oknu";
		$text['pedvertical'] = "Navpično";
		//added in 11.0.0
		$text['familywith'] = "Družina z";
		$text['fcmlogin'] = "Prijavite se, če želite videti podrobnosti";
		$text['isthe'] = "je";
		$text['otherspouses'] = "drugi zakonci";
		$text['parentfamily'] = "Nadrejena družina";
		$text['showfamily'] = "Prikaži družino";
		$text['shown'] = "prikazano";
		$text['showparentfamily'] = "pokaži nadrejeno družino";
		$text['showperson'] = "prikaži osebo";
		//added in 11.0.2
		$text['otherfamilies'] = "Druge družine";
		//added in 14.0
		$text['dtformat'] = "Preglednice";
		$text['dtchildren'] = "Otroci";
		$text['dtgrandchildren'] = "Vnuki/nje";
		$text['dtggrandchildren'] = "Pravnuki/nje";
		$text['dtgggrandchildren'] = "Great grandchildren"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Ni potomcev";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Skupaj";
		$text['dtselect'] = "Izberi";
		$text['dteachfulltable'] = "Vsaka cela preglednica naj ima";
		$text['dtrows'] = "vrstic";
		$text['dtdisplayingtable'] = "Prikaz preglednice";
		$text['dtgototable'] = "Pojdi na preglednico:";
		$text['fcinstrdn'] = "Prikaži družino z zakoncem";
		$text['fcinstrup'] = "Prikaži družino s staršema";
		$text['fcinstrplus'] = "Izberi druge zakonce";
		$text['fcinstrfam'] = "Izberi druge starše";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Ni poročil.";
		$text['reportname'] = "Ime poročila";
		$text['allreports'] = "Vsa poročila";
		$text['report'] = "Poročilo";
		$text['error'] = "Napaka";
		$text['reportsyntax'] = "Sintaksa poizvedbe za to poročilo";
		$text['wasincorrect'] = "je bila napačna, zato poročila ni bilo mogoče narediti. Obrnite se na skrbnika pri";
		$text['errormessage'] = "Sporočilo o napaki";
		$text['equals'] = "(ki je točno):";
		$text['endswith'] = "(ki se konča z):";
		$text['soundexof'] = "(algoritem soundex):";
		$text['metaphoneof'] = "(algoritem metaphone):";
		$text['plusminus10'] = "+/- 10 let od";
		$text['lessthan'] = "prej kot";
		$text['greaterthan'] = "več kot";
		$text['lessthanequal'] = "manj ali enako kot";
		$text['greaterthanequal'] = "več ali enako kot";
		$text['equalto'] = "enako kot";
		$text['tryagain'] = "Poskusite znova";
		$text['joinwith'] = "Za iskanje z več podatki uporabi kriterij";
		$text['cap_and'] = "IN";
		$text['cap_or'] = "ALI";
		$text['showspouse'] = "Pokaži zakonca (se podvaja, če ima oseba več kot enega zakonca)";
		$text['submitquery'] = "Pošlji poizvedbo";
		$text['birthplace'] = "Kraj rojstva";
		$text['deathplace'] = "Kraj smrti";
		$text['birthdatetr'] = "Leto rojstva";
		$text['deathdatetr'] = "Leto smrti";
		$text['plusminus2'] = "+/- 2 leti od";
		$text['resetall'] = "Ponastavi vse vrednosti";
		$text['showdeath'] = "Prikaži podatke o smrti / pokopu";
		$text['altbirthplace'] = "Kraj krsta";
		$text['altbirthdatetr'] = "Leto krsta";
		$text['burialplace'] = "Kraj pokopa";
		$text['burialdatetr'] = "Leto pokopa";
		$text['event'] = "Dogodek";
		$text['day'] = "Dan";
		$text['month'] = "Mesec";
		$text['keyword'] = "Ključna beseda (tj. \"Abt\")";
		$text['explain'] = "Vnesi želene dele datuma za prikaz želenega dogodka. Pusti polje 'Dogodek' prazno, da vidiš zadetke za vse dogodke.";
		$text['enterdate'] = "Vnesi ali izberi vsaj eno od teh postavk: dan, mesec, leto, ključna beseda";
		$text['fullname'] = "Polno ime";
		$text['birthdate'] = "Datum rojstva";
		$text['altbirthdate'] = "Datum krsta";
		$text['marrdate'] = "Datum poroke";
		$text['spouseid'] = "Koda zakonca";
		$text['spousename'] = "Ime zakonca";
		$text['deathdate'] = "Datum smrti";
		$text['burialdate'] = "Datum pokopa";
		$text['changedate'] = "Datum zadnje spremembe";
		$text['gedcom'] = "Drevo";
		$text['baptdate'] = "Baptism Date (LDS)";
		$text['baptplace'] = "Baptism Place (LDS)";
		$text['endldate'] = "Endowment Date (LDS)";
		$text['endlplace'] = "Endowment Place (LDS)";
		$text['ssealdate'] = "Seal Date S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Seal Place S (LDS)";
		$text['psealdate'] = "Seal Date P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Seal Place P (LDS)";
		$text['marrplace'] = "Kraj poroke";
		$text['spousesurname'] = "Priimek zakonca";
		$text['spousemore'] = "Če vneseš priimek zakonca, moraš izbrati spol.";
		$text['plusminus5'] = "+/- 5 let od";
		$text['exists'] = "obstaja";
		$text['dnexist'] = "ne obstaja";
		$text['divdate'] = "Datum razveze";
		$text['divplace'] = "Kraj razveze";
		$text['otherevents'] = "Ostali kriteriji iskanja";
		$text['numresults'] = "Število rezultatov na stran";
		$text['mysphoto'] = "Fotografije";
		$text['mysperson'] = "Osebe";
		$text['joinor'] = "Možnosti 'Združi z OR' ni mogoče uporabiti s priimkom zakonca.";
		$text['tellus'] = "Napiši / pošlji nam manjkajoče podatke";
		$text['moreinfo'] = "Več informacij o:";
		//added in 8.0.0
		$text['marrdatetr'] = "Leto poroke";
		$text['divdatetr'] = "Leto razveze";
		$text['mothername'] = "Ime matere";
		$text['fathername'] = "Ime očeta";
		$text['filter'] = "Filtriraj";
		$text['notliving'] = "preminuli";
		$text['nodayevents'] = "Dogodki v tem mesecu, ki niso povezani z določenim dnevom:";
		//added in 9.0.0
		$text['csv'] = "Prenesi v CSV datoteko";
		//added in 10.0.0
		$text['confdate'] = "Confirmation Date (LDS)";
		$text['confplace'] = "Confirmation Place (LDS)";
		$text['initdate'] = "Initiatory Date (LDS)";
		$text['initplace'] = "Initiatory Place (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Vrsta zakonske zveze";
		$text['searchfor'] = "Poišči";
		$text['searchnote'] = "OPOMBA: Iskanje z Googlom je za to spletno stran onemogočeno. Klikni na 'Iskanje oseb' ali 'Iskanje družin'.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Dnevniška datoteka za";
		$text['mostrecentactions'] = "najnovejših opravil";
		$text['autorefresh'] = "Samodejno osveževanje (30 sekund)";
		$text['refreshoff'] = "Izklopi samodejno osveževanje";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Pokopališča in nagrobniki";
		$text['showallhsr'] = "Pokaži vse nagrobniške zapise";
		$text['in'] = "v";
		$text['showmap'] = "Prikaži zemljevid";
		$text['headstonefor'] = "Nagrobnik od";
		$text['photoof'] = "Fotografija od";
		$text['photoowner'] = "Lastnik / vir";
		$text['nocemetery'] = "Ni pokopališča";
		$text['iptc005'] = "Naslov";
		$text['iptc020'] = "Dopolnilne kategorije";
		$text['iptc040'] = "Posebna navodila";
		$text['iptc055'] = "Datum kreiranja";
		$text['iptc080'] = "Avtor";
		$text['iptc085'] = "Položaj avtorja";
		$text['iptc090'] = "Kraj";
		$text['iptc095'] = "Pokrajina";
		$text['iptc101'] = "Država";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Naslov";
		$text['iptc110'] = "Vir";
		$text['iptc115'] = "Vir slike";
		$text['iptc116'] = "Obvestilo o avtorskih pravicah";
		$text['iptc120'] = "Besedilo pod sliko";
		$text['iptc122'] = "Avtor besedila pod sliko";
		$text['mapof'] = "Zemljevid od";
		$text['regphotos'] = "Seznam s slikami in opisi";
		$text['gallery'] = "Seznam le s slikami";
		$text['cemphotos'] = "Fotografije s pokopališča";
		$text['photosize'] = "Dimenzije";
        $text['iptc010'] = "Prednostno";
		$text['filesize'] = "Velikost datoteke";
		$text['seeloc'] = "Glej lokacijo";
		$text['showall'] = "Prikaži vse";
		$text['editmedia'] = "Uredi to prilogo";
		$text['viewitem'] = "Prikaži to prilogo";
		$text['editcem'] = "Uredi pokopališče";
		$text['numitems'] = "# prilog";
		$text['allalbums'] = "Vsi albumi";
		$text['slidestop'] = "Začasno ustavi diaprojekcijo";
		$text['slideresume'] = "Nadaljuj diaprojekcijo";
		$text['slidesecs'] = "sekund za vsak diapozitiv:";
		$text['minussecs'] = "minus 0,5 sekunde";
		$text['plussecs'] = "plus 0,5 sekunde";
		$text['nocountry'] = "Neznana država";
		$text['nostate'] = "Neznana pokrajina";
		$text['nocounty'] = "Neznana grofija";
		$text['nocity'] = "Neznan kraj";
		$text['nocemname'] = "Neznano ime pokopališča";
		$text['editalbum'] = "Uredi album";
		$text['mediamaptext'] = "<strong>Opomba:</strong> Za prikaz imen premakni kazalec miške nad sliko. Ob kliku na ime se odpre stran te osebe.";
		//added in 8.0.0
		$text['allburials'] = "Vsi Pogrebi";
		$text['moreinfo'] = "Klikni za več informacij o tej sliki";
		//added in 9.0.0
        $text['iptc025'] = "Ključne besede";
        $text['iptc092'] = "Podlokacija";
		$text['iptc015'] = "Kategorija";
		$text['iptc065'] = "Izvorni program";
		$text['iptc070'] = "Različica programa";
		//added in 13.0
		$text['toggletags'] = "Uporaba zavihkov";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Prikaži priimke, ki se začnejo s črko:";
		$text['showtop'] = "Prikaz prvih";
		$text['showallsurnames'] = "Prikaz vseh priimkov";
		$text['sortedalpha'] = "vse različice";
		$text['byoccurrence'] = "razvrščeno po pogostosti";
		$text['firstchars'] = "Prve črke";
		$text['mainsurnamepage'] = "Glavna stran za priimke";
		$text['allsurnames'] = "Vsi priimki";
		$text['showmatchingsurnames'] = "Klikni na priimek, da se prikažejo ujemanja.";
		$text['backtotop'] = "Nazaj na vrh";
		$text['beginswith'] = "Začne se z";
		$text['allbeginningwith'] = "Vsi priimki, ki se začnejo z";
		$text['numoccurrences'] = "po abecednem redu";
		$text['placesstarting'] = "Prikaži kraje, ki se začnejo s črko:";
		$text['showmatchingplaces'] = "<b>Če ob posameznem kraju klikneš na ikono za iskanje, dobiš s tem krajem povezane osebe.</b>";
		$text['totalnames'] = "skupaj oseb";
		$text['showallplaces'] = "Prikaz vseh krajev";
		$text['totalplaces'] = "</b>število v oklepaju pove, v koliko različicah se ta kraj pojavlja; klikni na posamezen kraj za prikaz vseh različic";
		$text['mainplacepage'] = "Nazaj na seznam vseh krajev";
		$text['allplaces'] = "Vsi kraji";
		$text['placescont'] = "Pokaži vse kraje, ki vsebujejo";
		//changed in 8.0.0
		$text['top30'] = "Najpogostejših xxx priimkov";
		$text['top30places'] = "NAJPOGOSTEJŠIH xxx KRAJEV";
		//added in 12.0.0
		$text['firstnamelist'] = "Seznam imen";
		$text['firstnamesstarting'] = "Pokaži imena, ki se začnejo z:";
		$text['showallfirstnames'] = "Pokaži vsa imena";
		$text['mainfirstnamepage'] = "Glavna stran za imena";
		$text['allfirstnames'] = "Vsa imena";
		$text['showmatchingfirstnames'] = "Klikni na ime, da se prikažejo ujemanja.";
		$text['allfirstbegwith'] = "Vsa imena, ki se začnejo z";
		$text['top30first'] = "Najpogostejših xxx imen";
		$text['allothers'] = "Vsi drugi";
		$text['amongall'] = "(izmed vseh)";
		$text['justtop'] = "Samo najštevilčnejših xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(zadnjih xx dni)";

		$text['photo'] = "Fotografija";
		$text['history'] = "Zgodba / Dokument";
		$text['husbid'] = "Koda očeta";
		$text['husbname'] = "Ime očeta";
		$text['wifeid'] = "Koda matere";
		//added in 11.0.0
		$text['wifename'] = "Ime matere";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Izbriši";
		$text['addperson'] = "Dodaj osebo";
		$text['nobirth'] = "Ta oseba nima veljavnega datuma rojstva in je ni bilo mogoče dodati";
		$text['event'] = "Dogodek/ki";
		$text['chartwidth'] = "Širina diagrama";
		$text['timelineinstr'] = "Dodaj ljudi";
		$text['togglelines'] = "Pomožne črte";
		//changed in 9.0.0
		$text['noliving'] = "Ta oseba ima oznako 'živeč' ali 'zasebno' in je ni bilo mogoče dodati, ker niste prijavljeni z ustreznimi dovoljenji";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Prebrskaj vsa drevesa";
		$text['treename'] = "Ime drevesa";
		$text['owner'] = "Lastnik";
		$text['address'] = "Naslov";
		$text['city'] = "Kraj";
		$text['state'] = "Pokrajina";
		$text['zip'] = "Poštna številka";
		$text['country'] = "Država";
		$text['email'] = "E-pošta";
		$text['phone'] = "Telefon";
		$text['username'] = "Uporabniško ime";
		$text['password'] = "Geslo";
		$text['loginfailed'] = "Prijava ni uspela.";

		$text['regnewacct'] = "Registracija";
		$text['realname'] = "Vaše pravo ime";
		$text['phone'] = "Telefon";
		$text['email'] = "E-pošta";
		$text['address'] = "Naslov";
		$text['acctcomments'] = "Opombe ali komentar";
		$text['submit'] = "Pošlji";
		$text['leaveblank'] = "(pustite prazno za novo drevo)";
		$text['required'] = "Obvezna polja";
		$text['enterpassword'] = "Vnesite geslo.";
		$text['enterusername'] = "Vnesite uporabniško ime.";
		$text['failure'] = "Žal je uporabniško ime, ki ste ga vnesli, že v uporabi. Uporabite gumb Nazaj v brskalniku, da se vrnete na prejšnjo stran in izberete drugo uporabniško ime.";
		$text['success'] = "Hvala. Prejeli smo vašo registracijo. Kontaktirali vas bomo, ko bo vaš račun aktiven ali če bo potrebnih več podatkov.";
		$text['emailsubject'] = "Zahteva za registracijo novega uporabnika TNG";
		$text['website'] = "Spletna stran";
		$text['nologin'] = "Nimate podatkov za prijavo?";
		$text['loginsent'] = "Podatki za prijavo so bili poslani";
		$text['loginnotsent'] = "Podatki za prijavo niso bili poslani";
		$text['enterrealname'] = "Vnesite svoje pravo ime.";
		$text['rempass'] = "Ostani prijavljen/-a na tem računalniku";
		$text['morestats'] = "Dodatni podatki";
		$text['accmail'] = "<strong>OPOMBA:</strong> Če želite prejeti pošto od skrbnika spletnega mesta glede vašega računa, se prepričajte, da ne blokirate pošte s te domene.";
		$text['newpassword'] = "Novo geslo";
		$text['resetpass'] = "Ponastavi svoje geslo";
		$text['nousers'] = "Tega obrazca ni mogoče uporabiti, dokler ne obstaja vsaj en uporabniški zapis. Če ste lastnik spletnega mesta, pojdite v Admin / Users, da ustvarite svoj skrbniški račun.";
		$text['noregs'] = "Žal trenutno ne sprejemamo novih registracij uporabnikov. Če imate kakšen komentar ali vprašanje v zvezi s to spletno stranjo, nas <a href=\"suggest.php\">kontaktirajte</a> direktno.";
		$text['emailmsg'] = "Prejeli ste novo zahtevo za uporabniški račun TNG. Prijavite se v vašo TNG administracijo in dodelite ustrezna dovoljenja za ta novi račun.";
		$text['accactive'] = "Račun je bil aktiviran, vendar uporabnik nima posebnih pravic, dokler mu jih ne dodelite.";
		$text['accinactive'] = "Pojdite na Admin/Users/Review za dostop do nastavitev računa. Račun bo ostal neaktiven, dokler ga ne uredite in ne shranite vsaj enkrat.";
		$text['pwdagain'] = "Ponovitev gesla";
		$text['enterpassword2'] = "Ponovi geslo.";
		$text['pwdsmatch'] = "Vaši gesli se ne ujemata. Vnesite enako geslo v obe polji.";
		$text['acksubject'] = "Hvala za registracijo"; //for a new user account
		$text['ackmessage'] = "Vaša zahteva za uporabniški račun je bila sprejeta. Vaš račun bo neaktiven, dokler ga ne pregleda skrbnik spletnega mesta. Ko bodo vaši podatki za prijavo pripravljeni, boste obveščeni po e-pošti.";
		//added in 12.0.0
		$text['switch'] = "Switch";
		//added in 14.0
		$text['newpassword2'] = "Ponovi novo geslo";
		$text['resetsuccess'] = "Geslo je bilo uspešno ponastavljeno";
		$text['resetfail'] = "Ponastavitev gesla ni uspela";
		$text['failreason0'] = " (neznana napaka v podatkovni bazi)";
		$text['failreason2'] = " (nimate dovoljenja za spremembo svojega gesla)";
		$text['failreason3'] = " (vpisali ste različni gesli)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Prebrskaj vse veje";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Število";
		$text['totindividuals'] = "Skupaj Vse osebe";
		$text['totmales'] = "Skupaj Moški";
		$text['totfemales'] = "Skupaj Ženske";
		$text['totunknown'] = "Skupaj Osebe neznanega spola";
		$text['totliving'] = "Skupaj Živeči";
		$text['totfamilies'] = "Skupaj Družine";
		$text['totuniquesn'] = "Skupaj Enkrat uporabljeni priimki";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Skupaj Viri";
		$text['avglifespan'] = "Povprečna življenjska doba";
		$text['earliestbirth'] = "Najstarejše leto rojstva";
		$text['longestlived'] = "Najdlje so živeli";
		$text['days'] = "dni";
		$text['age'] = "Starost";
		$text['agedisclaimer'] = "Izračuni, povezani s starostjo, vključujejo osebe z zabeleženimi datumi rojstva <em>in</em> smrti.  Zaradi nekaterih nepopolnih datumov (npr. zapis datuma smrti \"1945\" ali \"pred 1860\"), ti izračuni ne morejo biti docela točni.";
		$text['treedetail'] = "Več informacij o tem drevesu";
		$text['total'] = "Skupaj";
		//added in 12.0
		$text['totdeceased'] = "Skupaj Preminuli";
		//added in 14.0
		$text['totalsourcecitations'] = "Skupaj navedenih virov";
		break;

	case "notes":
		$text['browseallnotes'] = "Prebrskaj vse beležke";
		break;

	case "help":
		$text['menuhelp'] = "Menijska tipka";
		break;

	case "install":
		$text['perms'] = "Dovoljenja so bila nastavljena.";
		$text['noperms'] = "Dovoljenj za te datoteke ni bilo mogoče nastaviti:";
		$text['manual'] = "Nastavite jih ročno.";
		$text['folder'] = "Mapa";
		$text['created'] = "je bila ustvarjena";
		$text['nocreate'] = "ni bila ustvarjena. Ustvarite jo ročno.";
		$text['infosaved'] = "Podatki so bili shranjeni, povezava je bila preverjena!";
		$text['tablescr'] = "Tabele so bile ustvarjene!";
		$text['notables'] = "Naslednjih tabel ni bilo mogoče ustvariti:";
		$text['nocomm'] = "TNG ne komunicira z vašo bazo podatkov. Ustvarjena ni bila nobena tabela.";
		$text['newdb'] = "Podatki so bili shranjeni, povezava je bila preverjena, ustvarjena je bila nova baza podatkov:";
		$text['noattach'] = "Podatki so bili shranjeni. Povezava je vzpostavljena in baza podatkov ustvarjena, toda TNG se ne more navezati nanjo.";
		$text['nodb'] = "Podatki so bili shranjeni. Povezava je vzpostavljena, vendar baza podatkov ne obstaja in je tukaj ni bilo mogoče ustvariti. Preverite ime baze podatkov in ali ima uporabnik baze podatkov ustrezen dostop, ali pa ga ustvarite prek nadzorne plošče.";
		$text['noconn'] = "Podatki so bili shranjeni, vendar povezava ni uspela. Napačno je vsaj eno od naslednjega:";
		$text['exists'] = "že obstaja.";
		$text['noop'] = "Operacija ni bila izvedena.";
		//added in 8.0.0
		$text['nouser'] = "Uporabnik ni bil ustvarjen. To uporabniško ime morda že obstaja.";
		$text['notree'] = "Drevo ni bilo ustvarjeno. Ta koda drevesa morda že obstaja.";
		$text['infosaved2'] = "Podatki so bili shranjeni";
		$text['renamedto'] = "preimenovano v";
		$text['norename'] = "ni bilo mogoče preimenovati";
		//changed in 13.0.0
		$text['loginfirst'] = "Uporabniki že obstajajo. Da nadaljujete, se morate najprej prijaviti ali pobrisati vse vnose v tabelo z uporabniki.";
		break;

	case "imgviewer":
		$text['magmode'] = "Način povečave";
		$text['panmode'] = "Način pomikanja";
		$text['pan'] = "Klikni in povleci za premikanje po sliki";
		$text['fitwidth'] = "Prileganje po širini";
		$text['fitheight'] = "Prileganje po višini";
		$text['newwin'] = "Novo okno";
		$text['opennw'] = "Odpri sliko v novem oknu";
		$text['magnifyreg'] = "Klikni, da povečaš območje slike";
		$text['imgctrls'] = "Omogoči kontrole slike";
		$text['vwrctrls'] = "Omogoči kontrole pregledovalnika slik";
		$text['vwrclose'] = "Zapri pregledovalnik slik";
		break;

	case "dna":
		$text['test_date'] = "Datum testa";
		$text['links'] = "Relevantne povezave";
		$text['testid'] = "Koda testa";
		//added in 12.0.0
		$text['mode_values'] = "Mode Values";
		$text['compareselected'] = "Primerjaj izbrane";
		$text['dnatestscompare'] = "Primerjaj Y-DNK teste";
		$text['keep_name_private'] = "Ime naj ostane zasebno";
		$text['browsealltests'] = "Prebrskaj vse teste";
		$text['all_dna_tests'] = "Vsi DNK testi";
		$text['fastmutating'] = "Fast&nbsp;Mutating";
		$text['alltypes'] = "Vsi tipi";
		$text['allgroups'] = "Vse skupine";
		$text['Ydna_LITbox_info'] = "Testov s povezavami na to osebo ni nujno opravila ta oseba.<br />Stolpec 'Haploskupina' prikazuje podatke v rdeči barvi, če je rezultat 'Napovedan' ali v zeleni, če je test 'Potrjen'.";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Primerjaj izbrane mtDNK teste";
		$text['dnatestscompare_atdna'] = "Primerjaj izbrane atDNK teste";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNK";
		$text['mt_haplogroup'] = "mtDNK";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Dodatne mutacije";
		$text['mrca'] = "MRC prednik";
		$text['ydna_test'] = "Y-DNK testi";
		$text['mtdna_test'] = "MtDNK (mitohondrijski) testi";
		$text['atdna_test'] = "atDNK (avtosomni) testi";
		$text['segment_start'] = "Začetek";
		$text['segment_end'] = "Konec";
		$text['suggested_relationship'] = "Predlagano";
		$text['actual_relationship'] = "Dejansko";
		$text['12markers'] = "Markerji 1-12";
		$text['25markers'] = "Markerji 13-25";
		$text['37markers'] = "Markerji 26-37";
		$text['67markers'] = "Markerji 38-67";
		$text['111markers'] = "Markerji 68-111";
		//added in 13.1
		$text['comparemore'] = "Za primerjavo morata biti izbrana najmanj dva testa.";
		break;
}

//common
$text['matches'] = "Zadetki:";
$text['description'] = "Opis";
$text['notes'] = "Opombe";
$text['status'] = "Status";
$text['newsearch'] = "Novo iskanje";
$text['pedigree'] = "Rodovnik";
$text['seephoto'] = "Glej sliko";
$text['andlocation'] = "&amp; kraj";
$text['accessedby'] = "dostopal";
$text['children'] = "Otroci";  //from getperson
$text['tree'] = "Drevo";
$text['alltrees'] = "Vsa drevesa";
$text['nosurname'] = "[ni priimka]";
$text['thumb'] = "Predogled";  //as in Thumbnail
$text['people'] = "Ljudje";
$text['title'] = "Titula";  //from getperson
$text['suffix'] = "Pripona";  //from getperson
$text['nickname'] = "Drugo ime";  //from getperson
$text['lastmodified'] = "Zadnja sprememba";  //from getperson
$text['married'] = "Poroka";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Ime"; //from showmap
$text['lastfirst'] = "Priimek, ime";  //from search
$text['bornchr'] = "Rojstvo (krst)";  //from search
$text['individuals'] = "Osebe";  //from whats new
$text['families'] = "Družine";
$text['personid'] = "Koda osebe";
$text['sources'] = "Viri";  //from getperson (next several)
$text['unknown'] = "Neznano";
$text['father'] = "Oče";
$text['mother'] = "Mati";
$text['christened'] = "Krst";
$text['died'] = "Smrt";
$text['buried'] = "Pokop";
$text['spouse'] = "Zakonec";  //from search
$text['parents'] = "Starši";  //from pedigree
$text['text'] = "Besedilo";  //from sources
$text['language'] = "Jezik";  //from languages
$text['descendchart'] = "Potomci";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Oseba";
$text['edit'] = "Uredi";
$text['date'] = "Datum";
$text['login'] = "Prijava";
$text['logout'] = "Odjava";
$text['groupsheet'] = "Skupinski list";
$text['text_and'] = "in";
$text['generation'] = "Generacija";
$text['filename'] = "Ime datoteke";
$text['id'] = "Koda";
$text['search'] = "Iskanje";
$text['user'] = "Uporabnik";
$text['firstname'] = "<strong>Ime</strong>";
$text['lastname'] = "<strong>Priimek</strong>";
$text['searchresults'] = "Rezultati iskanja";
$text['diedburied'] = "umrl / pokopan";
$text['homepage'] = "Domov";
$text['find'] = "Poišči ...";
$text['relationship'] = "Sorodstvo";		//in German, Verwandtschaft
$text['relationship2'] = "Odnos"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Časovna premica";
$text['yesabbr'] = "D";               //abbreviation for 'yes'
$text['divorced'] = "Razveza";
$text['indlinked'] = "Povezava z:";
$text['branch'] = "Veja";
$text['moreind'] = "Več posameznikov";
$text['morefam'] = "Več družin";
$text['surnamelist'] = "Seznam priimkov";
$text['generations'] = "Generacije";
$text['refresh'] = "Osveži";
$text['whatsnew'] = "Nazadnje dodano";
$text['reports'] = "Poročila";
$text['placelist'] = "Seznam krajev";
$text['baptizedlds'] = "Baptized (LDS)";
$text['endowedlds'] = "Endowed (LDS)";
$text['sealedplds'] = "Sealed P (LDS)";
$text['sealedslds'] = "Sealed S (LDS)";
$text['ancestors'] = "Predniki";
$text['descendants'] = "Potomci";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum zadnjega uvoza GEDCOM datoteke";
$text['type'] = "Vrsta";
$text['savechanges'] = "Shrani spremembe";
$text['familyid'] = "Koda družine";
$text['headstone'] = "Nagrobniki";
$text['historiesdocs'] = "Zgodbe";
$text['anonymous'] = "anonimno";
$text['places'] = "Kraji";
$text['anniversaries'] = "Na današnji dan";
$text['administration'] = "Administracija";
$text['help'] = "Pomoč";
//$text['documents'] = "Documents";
$text['year'] = "Leto";
$text['all'] = "Vsi";
$text['address'] = "Kontakti";
$text['suggest'] = "Moj predlog";
$text['editevent'] = "Moj predlog za ta dogodek";
$text['morelinks'] = "Več povezav";
$text['faminfo'] = "Podatki o družini";
$text['persinfo'] = "Osebni podatki";
$text['srcinfo'] = "Podatki o viru";
$text['fact'] = "Dejstvo";
$text['goto'] = "Izberi stran";
$text['tngprint'] = "Natisni";
$text['databasestatistics'] = "Statistika"; //needed to be shorter to fit on menu
$text['child'] = "Otrok";  //from familygroup
$text['repoinfo'] = "Podatki o zbirki virov";
$text['tng_reset'] = "Ponastavi";
$text['noresults'] = "Ni rezultatov";
$text['allmedia'] = "Vse priloge";
$text['repositories'] = "Zbirke virov";
$text['albums'] = "Albumi";
$text['cemeteries'] = "Pokopališča";
$text['surnames'] = "Priimki";
$text['dates'] = "Na današnji dan";
$text['link'] = "Povezava";
$text['media'] = "Priloge";
$text['gender'] = "Spol";
$text['latitude'] = "Zemljepisna širina";
$text['longitude'] = "Zemljepisna dolžina";
$text['bookmarks'] = "Moji zaznamki";
$text['bookmark'] = "Naredi zaznamek";
$text['mngbookmarks'] = "Pojdi v zaznamke";
$text['bookmarked'] = "Zaznamek je dodan";
$text['remove'] = "Odstrani";
$text['find_menu'] = "Poišči";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Pokopališče";
$text['gmapevent'] = "Zemljevid dogodkov";
$text['gevents'] = "Dogodek";
$text['googleearthlink'] = "Povezava z Google Zemljo";
$text['googlemaplink'] = "Povezava z Google Zemljevidi";
$text['gmaplegend'] = "Legenda";
$text['unmarked'] = "Neoznačen";
$text['located'] = "Lociran";
$text['albclicksee'] = "Klikni, da vidiš vse priloge v tem albumu";
$text['notyetlocated'] = "Še ni lociran";
$text['cremated'] = "Kremiran(a)";
$text['missing'] = "Manjka";
$text['pdfgen'] = "Ustvari PDF";
$text['blank'] = "Prazen diagram";
$text['fonts'] = "Pisave";
$text['header'] = "Glava";
$text['data'] = "Podatki";
$text['pgsetup'] = "Nastavitve strani";
$text['pgsize'] = "Velikost strani";
$text['orient'] = "Usmerjenost"; //for a page
$text['portrait'] = "Pokončno";
$text['landscape'] = "Ležeče";
$text['tmargin'] = "Zgornji rob";
$text['bmargin'] = "spodnji rob";
$text['lmargin'] = "Levi rob";
$text['rmargin'] = "Desni rob";
$text['createch'] = "Ustvari diagram";
$text['prefix'] = "Predpona";
$text['mostwanted'] = "Morda pa ti veš ...";
$text['latupdates'] = "Zadnje posodobitve";
$text['featphoto'] = "Izpostavljena fotografija";
$text['news'] = "Novice";
$text['ourhist'] = "Naša družinska zgodovina";
$text['ourhistanc'] = "Naša družinska zgodovina in predniki";
$text['ourpages'] = "Naše družinske rodoslovne strani";
$text['pwrdby'] = "Izdelano po predlogi";
$text['writby'] = "written by";
$text['searchtngnet'] = "Iskanje po TNG Network (GENDEX)";
$text['viewphotos'] = "Prikaži vse fotografije";
$text['anon'] = "Trenutno ste anonimni";
$text['whichbranch'] = "Iz katere veje ste?";
$text['featarts'] = "Aktualni članki";
$text['maintby'] = "Vzdrževalec";
$text['createdon'] = "Ustvarjeno na";
$text['reliability'] = "Zanesljivost";
$text['labels'] = "Oznake";
$text['inclsrcs'] = "Vključi vire";
$text['cont'] = "(nadaljevanje)"; //abbreviation for continued
$text['mnuheader'] = "Domača stran";
$text['mnusearchfornames'] = "Iskanje";
$text['mnulastname'] = "Priimek";
$text['mnufirstname'] = "Ime";
$text['mnusearch'] = "Iskanje";
$text['mnureset'] = "Začni znova";
$text['mnulogon'] = "<big>Prijava</big>";
$text['mnulogout'] = "<br><big>Odjava</big>";
$text['mnufeatures'] = "Oglej si še:";
$text['mnuregister'] = "<br><big>Registracija</big>";
$text['mnuadvancedsearch'] = "Napredno iskanje";
$text['mnulastnames'] = "Priimki";
$text['mnustatistics'] = "Statistika";
$text['mnuphotos'] = "Fotografije";
$text['mnuhistories'] = "Zgodbe";
$text['mnumyancestors'] = "Fotografije in zgodbe prednikov [osebe]";
$text['mnucemeteries'] = "Pokopališča";
$text['mnutombstones'] = "Nagrobniki";
$text['mnureports'] = "Poročila";
$text['mnusources'] = "Viri";
$text['mnuwhatsnew'] = "Novosti";
$text['mnushowlog'] = "Dnevnik opravil";
$text['mnulanguage'] = "Spremeni jezik";
$text['mnuadmin'] = "Administracija";
$text['welcome'] = "<br>Pozdravljeni";
$text['contactus'] = "<b>KONTAKTNI OBRAZEC</b>";
//changed in 8.0.0
$text['born'] = "Rojstvo";
$text['searchnames'] = "Iskanje oseb";
//added in 8.0.0
$text['editperson'] = "Uredi osebo";
$text['loadmap'] = "Naloži zemljevid";
$text['birth'] = "Rojstvo";
$text['wasborn'] = "rojstvo:";
$text['startnum'] = "Prva številka";
$text['searching'] = "Iskanje";
//moved here in 8.0.0
$text['location'] = "Lokacija";
$text['association'] = "V odnosu z:";
$text['collapse'] = "Strni";
$text['expand'] = "Razširi";
$text['plot'] = "Parcela";
$text['searchfams'] = "Iskanje družin";
//added in 8.0.2
$text['wasmarried'] = "Poroka:";
$text['anddied'] = "Smrt:";
//added in 9.0.0
$text['share'] = "Podeli";
$text['hide'] = "Skrij";
$text['disabled'] = "Vaš uporabniški račun je onemogočen. Za več informacij se obrnite na skrbnika spletnega mesta.";
$text['contactus_long'] = "Svoje vprašanje ali komentar <span class=\"emphasis\"><a href=\"suggest.php\"><b>napiši tukaj</b></a></span>.";
$text['features'] = "Funkcije";
$text['resources'] = "Viri";
$text['latestnews'] = "Zadnje novice";
$text['trees'] = "Drevesa";
$text['wasburied'] = "pokop:";
//moved here in 9.0.0
$text['emailagain'] = "Ponovi svoj e-naslov";
$text['enteremail2'] = "Ponovno vnesi svoj e-poštni naslov.";
$text['emailsmatch'] = "Vaša e-naslova se ne ujemata. Vnesite isti e-poštni naslov v obe polji.";
$text['getdirections'] = "Klikni za usmeritev";
$text['calendar'] = "Koledar";
//changed in 9.0.0
$text['directionsto'] = "v";
$text['slidestart'] = "Diaprojekcija";
$text['livingnote'] = "Za ogled podrobnosti o tej osebi se prijavite oziroma registrirajte.";
$text['livingphoto'] = "Za ogled teh prilog se prijavite oziroma registrirajte.";
$text['waschristened'] = "krst:";
//added in 10.0.0
$text['branches'] = "Veje";
$text['detail'] = "Podrobnosti";
$text['moredetail'] = "Več podrobnosti";
$text['lessdetail'] = "Manj podrobnosti";
$text['conflds'] = "Confirmed (LDS)";
$text['initlds'] = "Initiatory (LDS)";
$text['wascremated'] = "je bil(a) kremiran(a)";
//moved here in 11.0.0
$text['text_for'] = "za";
//added in 11.0.0
$text['searchsite'] = "Preišči to spletno mesto";
$text['searchsitemenu'] = "Preišči z Googlom";
$text['kmlfile'] = "Prenesi datoteko .kml za prikaz te lokacije v programu Google Zemlja";
$text['download'] = "Klikni za prenos";
$text['more'] = "<b><big>Naprej</big></b>";
$text['heatmap'] = "Skupni zemljevid";
$text['refreshmap'] = "Osveži zemljevid";
$text['remnums'] = "Počisti številke in bucike";
$text['photoshistories'] = "Fotografije in zgodbe";
$text['familychart'] = "Družinski diagram";
//added in 12.0.0
$text['firstnames'] = "Imena";
//moved here in 12.0.0
$text['dna_test'] = "Test DNK";
$text['test_type'] = "Vrsta testa";
$text['test_info'] = "Informacije o testu";
$text['takenby'] = "Opravil(a)";
$text['haplogroup'] = "Haploskupina";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevantne povezave";
$text['nofirstname'] = "[ni imena]";
//added in 12.0.1
$text['cookieuse'] = "Opomba: Ta stran uporablja piškotke.";
$text['dataprotect'] = "Varovanje podatkov";
$text['viewpolicy'] = "Poglej";
$text['understand'] = "Razumem";
$text['consent'] = "Soglašam, da ta spletna stran hrani tukaj pridobljene osebne podatke. Razumem, da lahko od lastnika spletnega mesta kadar koli zahtevam, da te podatke odstrani.";
$text['consentreq'] = "Prosimo, da podate svoje soglasje za shranjevanje osebnih podatkov na tej spletni strani.";

//added in 12.1.0
$text['testsarelinked'] = "DNK testi so povezani z";
$text['testislinked'] = "Test DNK je povezan z";

//added in 12.2
$text['quicklinks'] = "Hitre povezave";
$text['yourname'] = "Vaše ime";
$text['youremail'] = "Vaš e-naslov";
$text['liketoadd'] = "Če želite še kaj dodati";
$text['webmastermsg'] = "Naše družinsko drevo";
$text['gallery'] = "Poglej galerijo";
$text['wasborn_male'] = "se je rodil";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "se je rodila"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "je bil krščen";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "je bila krščena";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "je umrl";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "je umrla";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "je pokopan"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "je pokopana"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "je bil kremiran";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "je bila kremirana";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "se je poročil";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "se je poročila";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "se je ločil";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "se je ločila";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " v kraju ";			// used as a preposition to the location
$text['onthisdate'] = " dne ";		// when used with full date
$text['inthisyear'] = " leta ";		// when used with year only or month / year dates
$text['and'] = "in ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Podatki DNK testa";
//added in 13.0
$text['visitor'] = "Obiskovalec";

$text['popupnote2'] = "Nov rodovnik";

//moved here in 14.0
$text['zoomin'] = "Povečaj";
$text['zoomout'] = "Pomanjšaj";
$text['scrollnote'] = "Če ne vidiš celega diagrama, ga vleci ali skrolaj z miško.";
$text['general'] = "Splošno";

//changed in 14.0
$text['otherevents'] = "Drugi dogodki in lastnosti";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Povezave";
$text['continue'] = "Nadaljuj";
$text['title2'] = "Naslov"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>