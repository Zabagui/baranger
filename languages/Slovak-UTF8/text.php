<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Prehliadať všetky zdroje";
		$text['shorttitle'] = "Krátky názov";
		$text['callnum'] = "Archívne číslo";
		$text['author'] = "Autor";
		$text['publisher'] = "Vydavateľ";
		$text['other'] = "Ďalšie informácie";
		$text['sourceid'] = "ID číslo zdroja";
		$text['moresrc'] = "Ďalšie zdroje";
		$text['repoid'] = "ID číslo archívu";
		$text['browseallrepos'] = "Prehliadať všetky archívy";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nový jazyk";
		$text['changelanguage'] = "Zmena jazyka";
		$text['languagesaved'] = "Jazyk uložený";
		$text['sitemaint'] = "Práve probieha údržba webových stránok";
		$text['standby'] = "Webová stránka je dočasne nedostupná, pretože probieha aktualizácia databázy. Skúste to, prosím, znova o pár minút. Ak bude stránka nedostupná dlhšiu dobu, kontaktujte majiteľa tejto stránky.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM začínajúci od";
		$text['producegedfrom'] = "Vytvoriť GEDCOM súbor z";
		$text['numgens'] = "Počet generácií";
		$text['includelds'] = "Včítane údajov CJKSpd";
		$text['buildged'] = "Vytvor GEDCOM";
		$text['gedstartfrom'] = "GEDCOM začínajúci od";
		$text['nomaxgen'] = "Musíte zadať maximálny počet generácií. Použijte tlačídlo Späť na návrat na predchádzajúcu stránku a chybu opravte.";
		$text['gedcreatedfrom'] = "GEDCOM vytvorený od";
		$text['gedcreatedfor'] = "vytvorený pre";
		$text['creategedfor'] = "Vytvoriť GEDCOM";
		$text['email'] = "Váš email";
		$text['suggestchange'] = "Navrhnúť zmenu";
		$text['yourname'] = "Vaše meno";
		$text['comments'] = "Popis <br />navrhovaných zmien";
		$text['comments2'] = "Komentáre";
		$text['submitsugg'] = "Odoslať návrh";
		$text['proposed'] = "Navrhovaná zmena";
		$text['mailsent'] = "Ďakujeme. Vaša správa bola odoslaná.";
		$text['mailnotsent'] = "Bohužiaľ, vaša správa nemohla byť doručená. Kontaktujte, prosím, xxx priamo na yyy.";
		$text['mailme'] = "Zaslať kópiu na túto adresu";
		$text['entername'] = "Zadajte, prosím, vaše meno";
		$text['entercomments'] = "Zadajte, prosím, vaše pripomienky";
		$text['sendmsg'] = "Poslať správu";
		//added in 9.0.0
		$text['subject'] = "Predmet";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografie a historky pre";
		$text['indinfofor'] = "Osobné informácie o";
		$text['pp'] = "str."; //page abbreviation
		$text['age'] = "Vek";
		$text['agency'] = "Inštitúcia";
		$text['cause'] = "Príčina";
		$text['suggested'] = "Navrhnuté";
		$text['closewindow'] = "Zatvoriť toto okno";
		$text['thanks'] = "Ďakujeme";
		$text['received'] = "Váš návrh bol odoslaný administrátorovi tejto stránky na posúdenie.";
		$text['indreport'] = "Zostava osoby";
		$text['indreportfor'] = "Zostava osoby";
		$text['bkmkvis'] = "Poznámka: Tieto záložky sú viditeľné len na tomto počítači a v tomto prehliadači.";
        //added in 9.0.0
		$text['reviewmsg'] = "Máte navrhnutú zmenu, ktorá vyžaduje vaše posúdenie. Táto zmena sa týka:";
        $text['revsubject'] = "Navrhovaná zmena vyžaduje vaše posúdenie";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Kalkulátor príbuzností";
		$text['findrel'] = "Nájsť príbuzenský vzťah";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "Vypočítať";
		$text['select2inds'] = "Prosím, vyberte dvoch jednotlivcov.";
		$text['findpersonid'] = "Nájsť ID číslo osoby";
		$text['enternamepart'] = "zadajte časť mena a/alebo priezviska";
		$text['pleasenamepart'] = "Prosím, zadajte časť mena alebo priezviska.";
		$text['clicktoselect'] = "kliknite na vybratie osoby";
		$text['nobirthinfo'] = "Chýbajú informácie o narodení";
		$text['relateto'] = "Príbuzenský vzťah k: ";
		$text['sameperson'] = "Títo dvaja jednotlivci sú tá istá osoba.";
		$text['notrelated'] = "Tieto dve osoby nemajú žiadny príbuzenský vzťah v rozsahu xxx generácií"; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Na zobrazenie vzťahu medzi dvoma osobami použite tlačidlo 'Nájsť' na nájdenie príslušných osôb, alebo ponechajte zobrazené osoby, potom kliknite na 'Vypočítať'.<br>(Anglické výrazy vzťahov sa nie vždy podarí kalkulátoru správne preložiť do slovenčiny.)";
		$text['sometimes'] = "(Niekedy kontrola cez rôzny počet generácií dáva odlišný výsledok.)";
		$text['findanother'] = "Nájsť iný príbuzenský vzťah";
		$text['brother'] = "brat od";
		$text['sister'] = "sestra od";
		$text['sibling'] = "súrodenec od";
		$text['uncle'] = " xxx strýko od";
		$text['aunt'] = " xxx teta od";
		$text['uncleaunt'] = " xxx strýko/teta od";
		$text['nephew'] = " xxx synovec od";
		$text['niece'] = " xxx neter od";
		$text['nephnc'] = "xxx synovec/neter od";
		$text['removed'] = "vzdialený príbuzný";
		$text['rhusband'] = "manžel od";
		$text['rwife'] = "manželka od";
		$text['rspouse'] = "partner od";
		$text['son'] = "syn od";
		$text['daughter'] = "dcéra od";
		$text['rchild'] = "dieťa od";
		$text['sil'] = "zať od";
		$text['dil'] = "nevesta od";
		$text['sdil'] = "zať alebo nevesta od";
		$text['gson'] = " xxx vnuk od";
		$text['gdau'] = " xxx vnučka od";
		$text['gsondau'] = "xxx vnuk/vnučka od";
		$text['great'] = "pra";
		$text['spouses'] = "sú manželia";
		$text['is'] = "je";
		$text['changeto'] = "Zmeniť na (zadajte ID číslo):";
		$text['notvalid'] = "nie je platné ID číslo osoby alebo neexistuje v tejto databáze. Skúste to, prosím, znova.";
		$text['halfbrother'] = "nevlastný brat od";
		$text['halfsister'] = "nevlastná sestra od";
		$text['halfsibling'] = "nevlastný súrodenec od";
		//changed in 8.0.0
		$text['gencheck'] = "Maximálny počet kontrolovaných generácií";
		$text['mcousin'] = "xxx bratranec yyy od";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx sesternica yyy od";  //female cousin
		$text['cousin'] = " xxx bratranec/sesternica yyy od";
		$text['mhalfcousin'] = "xxx nevlastný bratranec yyy od";  //male cousin
		$text['fhalfcousin'] = "xxx nevlastná sesternica yyy od";  //female cousin
		$text['halfcousin'] = "xxx nevlastný bratranec/sesternica yyy od";
		//added in 8.0.0
		$text['oneremoved'] = "vzdialený o jednu generáciu";
		$text['gfath'] = "xxx starý otec od";
		$text['gmoth'] = "xxx stará mama od";
		$text['gpar'] = "xxx starý rodič od";
		$text['mothof'] = "matka od";
		$text['fathof'] = "otec od ";
		$text['parof'] = "rodič od";
		$text['maxrels'] = "Maximálny počet vzťahov na zobrazenie";
		$text['dospouses'] = "Zobraziť vzťahy včítane manželov";
		$text['rels'] = "Príbuzenské vzťahy";
		$text['dospouses2'] = "Zobraziť manželov";
		$text['fil'] = "svokor od";
		$text['mil'] = "svokra od";
		$text['fmil'] = "svokor alebo svokra od";
		$text['stepson'] = "nevlastný syn od";
		$text['stepdau'] = "nevlastná dcéra od";
		$text['stepchild'] = "nevlastné dieťa od";
		$text['stepgson'] = "xxx nevlastný vnuk od";
		$text['stepgdau'] = "xxx nevlastná vnučka od";
		$text['stepgchild'] = "xxx nevlastné vnúča od";
		//added in 8.1.1
		$text['ggreat'] = "pra";
		//added in 8.1.2
		$text['ggfath'] = " xxx pradedko od";
		$text['ggmoth'] = " xxx prababička od";
		$text['ggpar'] = " xxx prarodič od";
		$text['ggson'] = " xxx pravnuk od";
		$text['ggdau'] = " xxx pravnučka od";
		$text['ggsondau'] = " xxx pradieťa od";
		$text['gstepgson'] = "xxx nevlastný pravnuk od";
		$text['gstepgdau'] = "xxx nevlastná pravnučka od";
		$text['gstepgchild'] = "xxx nevlastné prapradieťa od";
		$text['guncle'] = " xxx prastrýko od";
		$text['gaunt'] = " xxx prateta od";
		$text['guncleaunt'] = " xxx prastrýko/prateta od";
		$text['gnephew'] = " xxx prasynovec od";
		$text['gniece'] = " xxx praneter od";
		$text['gnephnc'] = " xxx prasynovec/praneter od";
		//added in 14.0
		$text['pathscalc'] = "Hľadať spojenia";
		$text['findrel2'] = "Nájsť vzťahy a iné spojenia";
		$text['makeme2nd'] = "Použiť moje ID";
		$text['usebookmarks'] = "Použiť záložky";
		$text['select2inds'] = "Prosím, vyberte dvoch jednotlivcov.";
		$text['indinfofor'] = "Info jednotlivca pre";
		$text['nobookmarks'] = "Nie je žiadna záložka na použitie";
		$text['bkmtitle'] = "Osoby nájdené pri záložkách";
		$text['bkminfo'] = "Vyberte osobu:";
		$text['sortpathsby'] = "Triediť cesty podľa počtu";
		$text['sortbyshort'] = "Triediť podľa";
		$text['bylengthshort'] = "Dĺžka";
		$text['badID1'] = ": zlé ID osoby 1 - prosím, vráťte sa späť a opravte to";
		$text['badID2'] = ": zlé ID osoby 2 - prosím, vráťte sa späť a opravte to";
		$text['notintree'] = ": osoba s týmto ID nie je v aktuálnej stromovej databáze.";
		$text['sameperson'] = "Títo dvaja jednotlivci sú tá istá osoba.";;
		$text['nopaths'] = "Tieto osoby nie sú spojené.";
		$text['nopaths1'] = "Nie sú žiadne ďalšie spojenia kratšie ako xxx";
		$text['nopaths2'] = "pri xxx krokoch hľadania";
		$text['longestpath'] = "(najdlhšia doteraz kontrolovaná cesta bola xxx krokov dlhá)";
		$text['relevantpaths'] = "Počet nájdených odlišných relevantných ciest: xxx";
		$text['skipMarr'] = "(naviac, počet nájdených ciest, ale nezobrazených kvôli veľkému počtu sobášov bol: xxx)";
		$text['mjaor'] = "alebo";
		$text['connectionsto'] = "Spojenia k ";
		$text['findanotherpers'] = "Nájsť ďalšiu osobu...";
		$text['sometimes'] = "(Niekedy kontrola cez rôzny počet generácií dáva odlišný výsledok.)";
		$text['anotherpath'] = "Hľadať ďalšie spojenia";
		$text['xpath'] = "Cesta ";
		$text['primary'] = "Začiatočná osoba"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Konečná osoba";
		$text['parent'] = "Rodič";
		$text['mhfather'] = "his father";
		$text['mhmother'] = "his mother";
		$text['mhhusband'] = "his husband";
		$text['mhwife'] = "his wife";
		$text['mhson'] = "his son";
		$text['mhdaughter'] = "his daughter";
		$text['fhfather'] = "her father";
		$text['fhmother'] = "her mother";
		$text['fhhusband'] = "her husband";
		$text['fhwife'] = "her wife";
		$text['fhson'] = "her son";
		$text['fhdaughter'] = "her daughter";
		$text['hfather'] = "otec";
		$text['hmother'] = "matka";
		$text['hhusband'] = "manžel";
		$text['hwife'] = "manželka";
		$text['hson'] = "syn";
		$text['hdaughter'] = "dcéra";
		$text['maxruns'] = "Maximálny počet ciest, ktoré sa majú skontrolovať";
		$text['maxrshort'] = "Maximálne cesty";
		$text['maxlength'] = "Cesty spojenia nie dlhšie ako";
		$text['maxlshort'] = "Maximálna dĺžka";
		$text['xstep'] = "krok";
		$text['xsteps'] = "kroky";
		$text['xmarriages'] = "xxx sobáše";
		$text['xmarriage'] = "1 sobáš";
		$text['showspouses'] = "Zobraziť oboch manželov";
		$text['showTxt'] = "Zobraziť textový popis cesty";
		$text['showTxtshort'] = "Textový popis";
		$text['compactBox'] = "Zobrazenie kompaktných okienok osôb";
		$text['compactBoxshort'] = "Kompaktné okienka";
		$text['paths'] = "Cesty";
		$text['dospouses2'] = "Zobraziť manželov";
		$text['maxmopt'] = "Max. manželstvá podľa spojenia";
		$text['maxm'] = "Max. manželstvá";
		$text['arerelated'] = "Tieto osoby sú príbuzné - ich vzťah je ukázaný v Ceste 1";
		$text['simplerel'] = "Jednoduché hľadanie vzťahu";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Zostava rodiny";
		$text['ldsords'] = "Obrady CJKSpd";
		$text['baptizedlds'] = "Krstenie (CJKSpd)";
		$text['endowedlds'] = "Obdarovanie (CJKSpd)";
		$text['sealedplds'] = "Pečatenie s rodičmi (CJKSpd)";
		$text['sealedslds'] = "Pečatenie s partnerom (CJKSpd)";
		$text['otherspouse'] = "Ďalší partner";
		$text['husband'] = "Otec";
		$text['wife'] = "Matka";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "N";
		$text['capaltbirthabbr'] = "K";
		$text['capdeathabbr'] = "Z";
		$text['capburialabbr'] = "P";
		$text['capplaceabbr'] = "v";
		$text['capmarrabbr'] = "S";
		$text['capspouseabbr'] = "M/P";
		$text['redraw'] = "Zobrazit s";
		$text['unknownlit'] = "Neznámy";
		$text['popupnote1'] = " = Ďalšie informácie";
		$text['pedcompact'] = "Kompaktne";
		$text['pedstandard'] = "Štandardne";
		$text['pedtextonly'] = "Len text";
		$text['descendfor'] = "Schéma potomkov osoby";
		$text['maxof'] = "Najviac";
		$text['gensatonce'] = "generácií zobrazených naraz.";
		$text['sonof'] = "syn od";
		$text['daughterof'] = "dcéra od";
		$text['childof'] = "dieťa od";
		$text['stdformat'] = "Štandardný formát";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Pridať novú rodinu";
		$text['editfam'] = "Upraviť rodinu";
		$text['side'] = "strana";
		$text['familyof'] = "Rodina";
		$text['paternal'] = "Otcova";
		$text['maternal'] = "Matkina";
		$text['gen1'] = "Ja";
		$text['gen2'] = "Rodičia";
		$text['gen3'] = "Prarodičia";
		$text['gen4'] = "Praprarodičia";
		$text['gen5'] = "3xprarodičia";
		$text['gen6'] = "4xprarodičia";
		$text['gen7'] = "5xprarodičia";
		$text['gen8'] = "6xprarodičia";
		$text['gen9'] = "7xprarodičia";
		$text['gen10'] = "8xprarodičia";
		$text['gen11'] = "9xprarodičia";
		$text['gen12'] = "10xprarodičia";
		$text['graphdesc'] = "Schéma potomkov až do tohto miesta";
		$text['pedbox'] = "Rámček";
		$text['regformat'] = "Register";
		$text['extrasexpl'] = "Pri tejto osobe existuje aspoň jedna fotografia, historka alebo iná mediálna položka.";
		$text['popupnote3'] = " = Nová schéma";
		$text['mediaavail'] = "Médiá sú k dispozícii";
		$text['pedigreefor'] = "Schéma rodokmeňa pre";
		$text['pedigreech'] = "Schéma rodokmeňa";
		$text['datesloc'] = "Dátumy a miesta";
		$text['borchr'] = "Narod/Krst - Úmrtie/Pohr (dva)";
		$text['nobd'] = "Bez dátumov narodenia alebo úmrtia";
		$text['bcdb'] = "Všetky údaje Narod/Krst/Úmrtie/Pohr (štyri)";
		$text['numsys'] = "Systém číslovania";
		$text['gennums'] = "Čísla generácií";
		$text['henrynums'] = "Číslovanie podľa Henryho";
		$text['abovnums'] = "Číslovanie podľa d'Aboville";
		$text['devnums'] = "Číslovanie podľa de Villiers";
		$text['dispopts'] = "Možnosti zobrazenia";
		//added in 10.0.0
		$text['no_ancestors'] = "Neboli nájdení žiadni predkovia";
		$text['ancestor_chart'] = "Zvislá schéma predkov";
		$text['opennewwindow'] = "Otvoriť v novom okne";
		$text['pedvertical'] = "Zvisle";
		//added in 11.0.0
		$text['familywith'] = "Rodina s";
		$text['fcmlogin'] = "Prosím, prihláste sa na pozretie detailov";
		$text['isthe'] = "je";
		$text['otherspouses'] = "ďalší partneri";
		$text['parentfamily'] = "Rodina rodičov ";
		$text['showfamily'] = "Zobraziť rodinu";
		$text['shown'] = "zobrazené";
		$text['showparentfamily'] = "zobraziť rodinu rodičov";
		$text['showperson'] = "zobraziť osobu";
		//added in 11.0.2
		$text['otherfamilies'] = "Ďalšie rodiny";
		//added in 14.0
		$text['dtformat'] = "Tabuľky";
		$text['dtchildren'] = "Deti";
		$text['dtgrandchildren'] = "Vnúčatá";
		$text['dtggrandchildren'] = "Pravnúčatá";
		$text['dtgggrandchildren'] = "Prapravnúčatá"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Žiadni potomkovia";
		$text['dtgen'] = "Gen.";
		$text['dttotal'] = "Celkom";
		$text['dtselect'] = "Vybrať";
		$text['dteachfulltable'] = "Každá plná tabuľka bude mať";
		$text['dtrows'] = "riadky";
		$text['dtdisplayingtable'] = "Zobrazenie tabuľky";
		$text['dtgototable'] = "Choď na tabuľku:";
		$text['fcinstrdn'] = "Zobraziť rodinu s manželmi";
		$text['fcinstrup'] = "Zobraziť rodinu s rodičmi";
		$text['fcinstrplus'] = "Vybrať iných manželov";
		$text['fcinstrfam'] = "Vybrať iných rodičov";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Žiadna zostava neexistuje.";
		$text['reportname'] = "Názov zostavy";
		$text['allreports'] = "Všetky zostavy";
		$text['report'] = "Zostava";
		$text['error'] = "Chyba";
		$text['reportsyntax'] = "Syntax dotazu pre túto zostavu";
		$text['wasincorrect'] = "bola chybná, a zostava nemohla byť vytvorená. Kontaktujte, prosím, administrátora systému na";
		$text['errormessage'] = "Hlásenie o chybe";
		$text['equals'] = "rovná sa";
		$text['endswith'] = "končí na";
		$text['soundexof'] = "soundex";
		$text['metaphoneof'] = "metaphone";
		$text['plusminus10'] = "+/- 10 rokov od";
		$text['lessthan'] = "menší ako";
		$text['greaterthan'] = "väčší ako";
		$text['lessthanequal'] = "menší alebo rovný";
		$text['greaterthanequal'] = "väčší alebo rovný";
		$text['equalto'] = "rovný";
		$text['tryagain'] = "Prosím, skúste to znova";
		$text['joinwith'] = "Spojiť s";
		$text['cap_and'] = "A";
		$text['cap_or'] = "ALEBO";
		$text['showspouse'] = "Zobraziť partnera (ak osoba má viac partnerov, bude zobrazená viackrát)";
		$text['submitquery'] = "Vykonať dotaz";
		$text['birthplace'] = "Miesto narodenia";
		$text['deathplace'] = "Miesto úmrtia";
		$text['birthdatetr'] = "Rok narodenia";
		$text['deathdatetr'] = "Rok úmrtia";
		$text['plusminus2'] = "+/- 2 roky od";
		$text['resetall'] = "Obnoviť všetky hodnoty na východzie";
		$text['showdeath'] = "Zobraziť informácie o úmrtí/pohrebe";
		$text['altbirthplace'] = "Miesto krstu";
		$text['altbirthdatetr'] = "Rok krstu";
		$text['burialplace'] = "Miesto pohrebu";
		$text['burialdatetr'] = "Rok pohrebu";
		$text['event'] = "Udalosť";
		$text['day'] = "Deň";
		$text['month'] = "Mesiac";
		$text['keyword'] = "Kľúčové slovo (napr. \"asi\")";
		$text['explain'] = "Na zobrazenie odpovedajúcich udalostí zadajte dátum. Na zobrazenie všetkých udalostí nechajte pole prázdne.";
		$text['enterdate'] = "Prosím, zadajte alebo vyberte aspoň jedno z nasledujúcich: Deň, Mesiac, Rok, Kľúčové slovo";
		$text['fullname'] = "Celé meno";
		$text['birthdate'] = "Dátum narodenia";
		$text['altbirthdate'] = "Dátum krstu";
		$text['marrdate'] = "Dátum sobáša";
		$text['spouseid'] = "ID číslo partnera";
		$text['spousename'] = "Meno partnera";
		$text['deathdate'] = "Dátum úmrtia";
		$text['burialdate'] = "Dátum pohrebu";
		$text['changedate'] = "Dátum poslednej zmeny";
		$text['gedcom'] = "Strom";
		$text['baptdate'] = "CJKSpd dátum krstu";
		$text['baptplace'] = "CJKSpd miesto krstu";
		$text['endldate'] = "CJKSpd dátum zasnúbenia";
		$text['endlplace'] = "CJKSpd miesto zasnúbenia";
		$text['ssealdate'] = "CJKSpd dátum pečatenia s partnerom";   //Sealed to spouse
		$text['ssealplace'] = "CJKSpd miesto pečatenia s partnerom";
		$text['psealdate'] = "CJKSpd dátum pečatenia s rodičmi";   //Sealed to parents
		$text['psealplace'] = "CJKSpd miesto pečatenia s rodičmi";
		$text['marrplace'] = "Miesto sobáša";
		$text['spousesurname'] = "Priezvisko partnera";
		$text['spousemore'] = "Ak zadávate priezvisko partnera, musíte vybrať pohlavie.";
		$text['plusminus5'] = "+/- 5 rokov od";
		$text['exists'] = "existuje";
		$text['dnexist'] = "neexistuje";
		$text['divdate'] = "Dátum rozvodu";
		$text['divplace'] = "Miesto rozvodu";
		$text['otherevents'] = "Iné kritériá hľadania";
		$text['numresults'] = "Počet výsledkov na stránke";
		$text['mysphoto'] = "Záhadné fotografie";
		$text['mysperson'] = "Hľadané osoby";
		$text['joinor'] = "Voľbu 'Join with OR' nemožno použiť s priezviskom partnera";
		$text['tellus'] = "Ak máte nejaké informácie, napíšte nám";
		$text['moreinfo'] = "Viac informácií";
		//added in 8.0.0
		$text['marrdatetr'] = "Rok sobáša";
		$text['divdatetr'] = "Rok rozvodu";
		$text['mothername'] = "Meno matky";
		$text['fathername'] = "Meno otca";
		$text['filter'] = "Filter";
		$text['notliving'] = "Zosnulí";
		$text['nodayevents'] = "Udalosti v tomto mesiaci, ktoré nie sú spojené s určitým dňom:";
		//added in 9.0.0
		$text['csv'] = "Súbor CSV s údajmi oddelenými čiarkami";
		//added in 10.0.0
		$text['confdate'] = "Dátum birmovania (CJKSpd)";
		$text['confplace'] = "Miesto birmovania (CJKSpd)";
		$text['initdate'] = "Dátum zasvätenia (CJKSpd)";
		$text['initplace'] = "Miesto zasvätenia (CJKSpd)";
		//added in 11.0.0
		$text['marrtype'] = "Typ sobáša";
		$text['searchfor'] = "Hľadať";
		$text['searchnote'] = "Poznámka: Táto stránka používa Google na vykonávanie hľadania. Počet nájdených zhôd bude priamo závisieť od rozsahu, v akom Google je schopný indexovať toto webové sídlo.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Protokolárny súbor";
		$text['mostrecentactions'] = "Nedávne aktivity";
		$text['autorefresh'] = "Automatická obnova (30 sekúnd)";
		$text['refreshoff'] = "Vypnúť automatickú obnovu";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cintoríny a náhrobky";
		$text['showallhsr'] = "Zobraziť všetky záznamy náhrobkov";
		$text['in'] = "v";
		$text['showmap'] = "Ukázať mapu";
		$text['headstonefor'] = "Náhrobok pre";
		$text['photoof'] = "Fotografie";
		$text['photoowner'] = "Vlastník originálu";
		$text['nocemetery'] = "Cintorín neuvedený";
		$text['iptc005'] = "Názov";
		$text['iptc020'] = "Podporované kategórie";
		$text['iptc040'] = "Zvláštne inštrukcie";
		$text['iptc055'] = "Dátum vytvorenia";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Autorova funkcia";
		$text['iptc090'] = "Mesto/obec";
		$text['iptc095'] = "Štát/Kraj";
		$text['iptc101'] = "Krajina";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Nadpis";
		$text['iptc110'] = "Zdroj";
		$text['iptc115'] = "Zdroj fotografie";
		$text['iptc116'] = "Všetky práva vyhradené";
		$text['iptc120'] = "Popis";
		$text['iptc122'] = "Popis vytvoril";
		$text['mapof'] = "Mapa";
		$text['regphotos'] = "Zobrazenie s popisom";
		$text['gallery'] = "Len miniatúry";
		$text['cemphotos'] = "Fotky z cintorínov";
		$text['photosize'] = "Rozmery";
        $text['iptc010'] = "Priorita";
		$text['filesize'] = "Veľkosť súboru";
		$text['seeloc'] = "Pozrite si miesto";
		$text['showall'] = "Zobraziť všetko";
		$text['editmedia'] = "Upraviť médium";
		$text['viewitem'] = "Prezrieť túto položku";
		$text['editcem'] = "Upraviť cintorín";
		$text['numitems'] = "Počet položiek";
		$text['allalbums'] = "Všetky albumy";
		$text['slidestop'] = "Pozastaviť prezentáciu";
		$text['slideresume'] = "Obnoviť prezentáciu";
		$text['slidesecs'] = "Počet sekúnd pre každú snímku:";
		$text['minussecs'] = "ubrať 0,5 sekundy";
		$text['plussecs'] = "pridať 0,5 sekundy";
		$text['nocountry'] = "Neznáma krajina";
		$text['nostate'] = "Neznámy štát/kraj";
		$text['nocounty'] = "Neznámy okres";
		$text['nocity'] = "Neznáme mesto/obec";
		$text['nocemname'] = "Neznámy názov cintorína";
		$text['editalbum'] = "Upraviť album";
		$text['mediamaptext'] = "<strong>Poznámka:</strong> Posúvaním ukazovateľa myši cez obrázok sa zobrazia názvy. Kliknutím sa zobrazí stránka k tomuto názvu.";
		//added in 8.0.0
		$text['allburials'] = "Všetky pohreby";
		$text['moreinfo'] = "Kliknutím sa zobrazí viac informácií o obrázku";
		//added in 9.0.0
        $text['iptc025'] = "Kľúčové slová";
        $text['iptc092'] = "Časť miesta";
		$text['iptc015'] = "Kategória";
		$text['iptc065'] = "Pôvodný program";
		$text['iptc070'] = "Verzia programu";
		//added in 13.0
		$text['toggletags'] = "Prepnúť značky";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Zobraziť priezviská začínajúce na";
		$text['showtop'] = "Zobraziť prvých ";
		$text['showallsurnames'] = "Zobraziť všetky priezviská";
		$text['sortedalpha'] = "zoradené podľa abecedy";
		$text['byoccurrence'] = "zoradených podľa početnosti";
		$text['firstchars'] = "Začiatočné písmená";
		$text['mainsurnamepage'] = "Hlavná stránka priezvisk";
		$text['allsurnames'] = "Všetky priezviská";
		$text['showmatchingsurnames'] = "Kliknutím na priezvisko sa zobrazia odpovedajúce záznamy.";
		$text['backtotop'] = "Späť na začiatok";
		$text['beginswith'] = "Začína na";
		$text['allbeginningwith'] = "Všetky priezviská začínajúce na";
		$text['numoccurrences'] = "celkový počet miest v zátvorke";
		$text['placesstarting'] = "Zobraziť najvýznamnejšie miesta, ktoré začínajú na";
		$text['showmatchingplaces'] = "Kliknutím na miesto sa zobrazia menšie lokality. Kliknutím na ikonu Hľadať sa zobrazia odpovedajúce osoby.";
		$text['totalnames'] = "celkom osôb";
		$text['showallplaces'] = "Zobraziť všetky najvýznamnejšie lokality";
		$text['totalplaces'] = "celkom miest";
		$text['mainplacepage'] = "Hlavná stránka miest";
		$text['allplaces'] = "Všetky najvýznamnejšie lokality";
		$text['placescont'] = "Zobraziť všetky miesta obsahujúce";
		//changed in 8.0.0
		$text['top30'] = "xxx najčastejšie sa vyskytujúcich priezvisk";
		$text['top30places'] = "xxx najvýznamnejších lokalít";
		//added in 12.0.0
		$text['firstnamelist'] = "Zoznam krstných mien";
		$text['firstnamesstarting'] = "Zobraziť krstné mená začínajúce na";
		$text['showallfirstnames'] = "Zobraziť všetky krstné mená";
		$text['mainfirstnamepage'] = "Hlavná stránka krstných mien";
		$text['allfirstnames'] = "Všetky krstné mená";
		$text['showmatchingfirstnames'] = "Kliknutím na krstné meno sa zobrazia odpovedajúce záznamy.";
		$text['allfirstbegwith'] = "Všetky krstné mená začínajúce na";
		$text['top30first'] = "Top xxx najčastejšie sa vyskytujúcich krstných mien";
		$text['allothers'] = "Všetky ostatné";
		$text['amongall'] = "(medzi všetkými menami)";
		$text['justtop'] = "Len top xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(v posledných xx dňoch)";

		$text['photo'] = "Fotografia";
		$text['history'] = "Historka/Dokument";
		$text['husbid'] = "ID číslo otca";
		$text['husbname'] = "Meno otca";
		$text['wifeid'] = "ID číslo matky";
		//added in 11.0.0
		$text['wifename'] = "Meno matky";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Odstrániť";
		$text['addperson'] = "Pridať osobu";
		$text['nobirth'] = "Nasledujúca osoba nemá platný dátum narodenia, a nemožno ju pridať";
		$text['event'] = "Udalosti";
		$text['chartwidth'] = "Šírka schémy";
		$text['timelineinstr'] = "Pridať osoby";
		$text['togglelines'] = "Prepnúť zobrazenie osi";
		//changed in 9.0.0
		$text['noliving'] = "Nasledujúca osoba je označená ako žijúca alebo neverejná, nemožno ju pridat, pretože nemáte náležité prístupové práva";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Prehliadať všetky stromy";
		$text['treename'] = "Názov stromu";
		$text['owner'] = "Majiteľ";
		$text['address'] = "Adresa";
		$text['city'] = "Mesto/obec";
		$text['state'] = "Štát/Kraj";
		$text['zip'] = "PSČ";
		$text['country'] = "Krajina";
		$text['email'] = "Email";
		$text['phone'] = "Telefón";
		$text['username'] = "Používateľské meno";
		$text['password'] = "Heslo";
		$text['loginfailed'] = "Chyba prihlásenia.";

		$text['regnewacct'] = "Registrácia nového účtu";
		$text['realname'] = "Vaše meno a priezvisko";
		$text['phone'] = "Telefón";
		$text['email'] = "Email";
		$text['address'] = "Adresa";
		$text['acctcomments'] = "Poznámky";
		$text['submit'] = "Odoslať";
		$text['leaveblank'] = "(nechajte toto pole prázdne, ak žiadate o nový strom)";
		$text['required'] = "Tieto údaje je nutné vyplniť";
		$text['enterpassword'] = "Zadajte heslo.";
		$text['enterusername'] = "Zadajte používateľské meno.";
		$text['failure'] = "Zadané používateľské meno sa už používa. Prosím, použite tlačidlo Späť na prehliadači na návrat späť na predchádzajúcu stránku a zadajte iné používateľské meno";
		$text['success'] = "Ďakujeme, vaša registrácia prebehla úspešne. Administrátor systému vás informovať kedy váš účet bude aktívny alebo ak budú potrebné ďalšie informácie.";
		$text['emailsubject'] = "Žiadosť o novú registráciu";
		$text['website'] = "Webová stránka";
		$text['nologin'] = "Nemáte prihlasovacie údaje?";
		$text['loginsent'] = "Prihlasovacie údaje boli odoslané";
		$text['loginnotsent'] = "Prihlasovacie údaje neboli odoslané";
		$text['enterrealname'] = "Zadajte, prosím, svoje skutočné meno.";
		$text['rempass'] = "Zostať prihlásený na tomto počítači";
		$text['morestats'] = "Ďalšia štatistika";
		$text['accmail'] = "POZNÁMKA: Aby ste mohli prijať email od administrátora ohľadom vášho účtu, skontrolujte, prosím, či váš emailový program neblokuje emaily z tejto domény.";
		$text['newpassword'] = "Nové heslo";
		$text['resetpass'] = "Obnoviť vaše heslo";
		$text['nousers'] = "Tento formulár nemožno použiť, kým nebude vytvorený aspoň jeden záznam používateľa. Ak ste majiteľom týchto stránok, choďte do ponuky Administrácia >> Používatelia a vytvorte si účet administrátora.";
		$text['noregs'] = "Je nám ľúto, ale v súčasnej dobe neprijímame nové registrácie. Kontaktujte nás, prosím, priamo, ak máte nejaké dotazy či pripomienky ohľadom týchto webových stránok.";
		$text['emailmsg'] = "Bola vám odoslaná nová žiadosť o používateľský účet TNG. Prihláste sa, prosím, do administrátorského prostredia a dajte novému účtu patričné prístupové práva.";
		$text['accactive'] = "Účet bol aktivovaný, ale používateľ nebude mať žiadné zvláštne práva, kým mu ich nepridelíte.";
		$text['accinactive'] = "Nastavenie účtu môžete urobiť v Administrácia >> Používatelia >> Hľadať. Účet zostane neaktívny, kým aspoň raz záznam neupravíte a neuložíte.";
		$text['pwdagain'] = "Znova heslo";
		$text['enterpassword2'] = "Prosím, vložte znova svoje heslo.";
		$text['pwdsmatch'] = "Vaše heslo sa nezhoduje. Prosím, zadajte to isté heslo do každého poľa.";
		$text['acksubject'] = "Ďakujeme za registráciu"; //for a new user account
		$text['ackmessage'] = "Vaša žiadosť o používateľský účet bola prijatá. Váš účet nebude aktívny, kým nebude schválený administrátorom. O výsledku budeme vás informovať emailom.";
		//added in 12.0.0
		$text['switch'] = "Prepnúť";
		//added in 14.0
		$text['newpassword2'] = "Ešte raz nové heslo";
		$text['resetsuccess'] = "Úspech: Heslo bolo obnovené";
		$text['resetfail'] = "Neúspech: Heslo nebolo obnovené";
		$text['failreason0'] = " (neznáma chyba databázy)";
		$text['failreason2'] = " (nemáte oprávnenie na zmenu vášho hesla)";
		$text['failreason3'] = " (heslá sa nezhodujú)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Prehliadať všetky vetvy";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Množstvo";
		$text['totindividuals'] = "Celkom osôb";
		$text['totmales'] = "Celkom mužov";
		$text['totfemales'] = "Celkom žien";
		$text['totunknown'] = "Celkom neurčeného pohlavia";
		$text['totliving'] = "Celkom žijúcich";
		$text['totfamilies'] = "Celkom rodín";
		$text['totuniquesn'] = "Celkom jedinečných priezvisk";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Celkom zdrojov";
		$text['avglifespan'] = "Priemerná dĺžka života";
		$text['earliestbirth'] = "Najskôr narodení";
		$text['longestlived'] = "Najdlhšie žijúci";
		$text['days'] = "dní";
		$text['age'] = "Vek";
		$text['agedisclaimer'] = "Výpočty spojené s vekom sa zakladajú na údajoch osôb, ktoré majú zadaný dátum narodenia <EM>a</EM> dátum úmrtia.  Keďže niektoré údaje sú neúplné (napr. pri úmrtí je zadaný len rok \"1945\" alebo \"pred 1860\"), tieto výpočty nemusia byť 100% presné.";
		$text['treedetail'] = "Ďalšie informácie o tomto strome";
		$text['total'] = "Celkom";
		//added in 12.0
		$text['totdeceased'] = "Celkom zosnulých";
		//added in 14.0
		$text['totalsourcecitations'] = "Celkový počet citácií zdroja";
		break;

	case "notes":
		$text['browseallnotes'] = "Prehliadať všetky poznámky";
		break;

	case "help":
		$text['menuhelp'] = "Pomocník ponuky";
		break;

	case "install":
		$text['perms'] = "Všetky povolenia boli nastavené.";
		$text['noperms'] = "Povolenia nemohli byť nastavené pre tieto súbory:";
		$text['manual'] = "Nastavte ich, prosím, manuálne.";
		$text['folder'] = "Priečinok";
		$text['created'] = "bol vytvorený";
		$text['nocreate'] = "nemohol byť vytvorený. Vytvorte ho, prosím, manuálne.";
		$text['infosaved'] = "Informácie sú uložené, spojenie overené!";
		$text['tablescr'] = "Tabuľky boli vytvorené!";
		$text['notables'] = "Nasledujúce tabuľky nemohli byť vytvorené:";
		$text['nocomm'] = "TNG nemôže nadviazať komunikáciu s vašou databázou. Žiadne tabuľky neboli vytvorené.";
		$text['newdb'] = "Informácie uložené, spojenie overené, bola vytvorená nová databáza:";
		$text['noattach'] = "Informácie uložené. Spojenie nadviazané a databáza vytvorená, ale TNG sa nemôže k nej pripojiť.";
		$text['nodb'] = "Informácie uložené. Spojenie nadviazané, ale databáza neexistuje a nemohla byť vytvorená. Overte si, či názov databázy je správny alebo použijte ovládací panel a vytvorte ju.";
		$text['noconn'] = "Informácie uložené, ale spojenie nebolo nadviazané.  Niektoré z následujúch vecí sú chybné:";
		$text['exists'] = "už existuje";
		$text['noop'] = "Nevykonala sa žiadna operácia.";
		//added in 8.0.0
		$text['nouser'] = "Účet nebol vytvorený. Používateľské meno asi už existuje.";
		$text['notree'] = "Strom nebol vytvorený. ID číslo stromu asi už existuje.";
		$text['infosaved2'] = "Informácia uložená";
		$text['renamedto'] = "premenovaný na";
		$text['norename'] = "nemohol byť premenovaný";
		//changed in 13.0.0
		$text['loginfirst'] = "Zistili sa používateľské záznamy. Na pokračovanie musíte sa najprv prihlásiť alebo odstrániť všetky záznamy z tabuľky používateľov.";
		break;

	case "imgviewer":
		$text['magmode'] = "Režim zväčšovania";
		$text['panmode'] = "Režim sledovania";
		$text['pan'] = "Ak obrázok je väčší ako okno prehliadača, po obrázku sa presúvate kliknutím a ťahaním myšou.";
		$text['fitwidth'] = "Na celú šírku";
		$text['fitheight'] = "Na celú výšku";
		$text['newwin'] = "Nové okno";
		$text['opennw'] = "Otvoriť obrázok v novom okne";
		$text['magnifyreg'] = "Kliknutím myšou do obrázka zväčšíte túto časť obrázka";
		$text['imgctrls'] = "Zapnúť ovládacie prvky obrázka";
		$text['vwrctrls'] = "Zapnúť ovládacie prvky prehliadača obrázkov";
		$text['vwrclose'] = "Zavrieť prehliadač obrázkov";
		break;

	case "dna":
		$text['test_date'] = "Dátum testu";
		$text['links'] = "Príslušné odkazy";
		$text['testid'] = "ID testu";
		//added in 12.0.0
		$text['mode_values'] = "Hodnoty modu";
		$text['compareselected'] = "Porovnať vybrané";
		$text['dnatestscompare'] = "Porovnať Y-DNA testy";
		$text['keep_name_private'] = "Držať meno ako neverejné";
		$text['browsealltests'] = "Prehľadávať všetky testy";
		$text['all_dna_tests'] = "Všetky DNA testy";
		$text['fastmutating'] = "Rýchle mutácie";
		$text['alltypes'] = "Všetky typy";
		$text['allgroups'] = "Všetky skupiny";
		$text['Ydna_LITbox_info'] = "Testy spojené s touto osobou nemuseli byť nutne absolvované touto osobou.<br />V stĺpci 'Haploskupina' sa zobrazia údaje červenou farbou, ak výsledok je 'Predpovedaný', alebo zelenou farbou, ak test je 'Potvrdený'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Porovnať vybrané testy mtDNA";
		$text['dnatestscompare_atdna'] = "Porovnať vybrané testy atDNA";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNP";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Zvláštne mutácie";
		$text['mrca'] = "Najbližší spoločný predok";
		$text['ydna_test'] = "Testy Y-DNA";
		$text['mtdna_test'] = "Testy mtDNA (mitochondriálne)";
		$text['atdna_test'] = "Testy atDNA (autozomálne)";
		$text['segment_start'] = "Začiatok";
		$text['segment_end'] = "Koniec";
		$text['suggested_relationship'] = "Navrhnuté";
		$text['actual_relationship'] = "Aktuálne";
		$text['12markers'] = "Markery 1-12";
		$text['25markers'] = "Markery 13-25";
		$text['37markers'] = "Markery 26-37";
		$text['67markers'] = "Markery 38-67";
		$text['111markers'] = "Markery 68-111";
		//added in 13.1
		$text['comparemore'] = "Na porovnanie je potrebné vybrať aspoň dva testy.";
		break;
}

//common
$text['matches'] = "Záznamy";
$text['description'] = "Popis";
$text['notes'] = "Poznámky";
$text['status'] = "Stav";
$text['newsearch'] = "Nové hľadanie";
$text['pedigree'] = "Rodokmeň";
$text['seephoto'] = "Pozrieť fotografiu";
$text['andlocation'] = "&amp; miesto";
$text['accessedby'] = "sprístupnil";
$text['children'] = "Deti";  //from getperson
$text['tree'] = "Strom";
$text['alltrees'] = "Všetky stromy";
$text['nosurname'] = "[bez priezviska]";
$text['thumb'] = "Miniatúra";  //as in Thumbnail
$text['people'] = "Ľudia";
$text['title'] = "Titul";  //from getperson
$text['suffix'] = "Prípona";  //from getperson
$text['nickname'] = "Prezývka";  //from getperson
$text['lastmodified'] = "Posledná zmena";  //from getperson
$text['married'] = "Sobáš";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Meno"; //from showmap
$text['lastfirst'] = "Priezvisko, meno";  //from search
$text['bornchr'] = "Narod./krst";  //from search
$text['individuals'] = "Osoby";  //from whats new
$text['families'] = "Rodiny";
$text['personid'] = "ID číslo osoby";
$text['sources'] = "Zdroje";  //from getperson (next several)
$text['unknown'] = "Neznáme";
$text['father'] = "Otec";
$text['mother'] = "Matka";
$text['christened'] = "Krstenie";
$text['died'] = "Úmrtie";
$text['buried'] = "Pohreb";
$text['spouse'] = "Partner";  //from search
$text['parents'] = "Rodičia";  //from pedigree
$text['text'] = "Text";  //from sources
$text['language'] = "Jazyk";  //from languages
$text['descendchart'] = "Schéma potomkov";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Osoba";
$text['edit'] = "Upraviť";
$text['date'] = "Dátum";
$text['login'] = "Prihlásenie";
$text['logout'] = "Odhlásenie";
$text['groupsheet'] = "Hárok rodiny";
$text['text_and'] = "a";
$text['generation'] = "Generácia";
$text['filename'] = "Názov súboru";
$text['id'] = "ID číslo";
$text['search'] = "Hľadať";
$text['user'] = "Používateľ";
$text['firstname'] = "Meno";
$text['lastname'] = "Priezvisko";
$text['searchresults'] = "Výsledky hľadania";
$text['diedburied'] = "Úmrtie/Pohreb";
$text['homepage'] = "Domovská stránka";
$text['find'] = "Nájsť (osobu)";
$text['relationship'] = "Príbuz. vzťah";		//in German, Verwandtschaft
$text['relationship2'] = "Vzťah"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Časová línia";
$text['yesabbr'] = "Á";               //abbreviation for 'yes'
$text['divorced'] = "Rozvod";
$text['indlinked'] = "Spojené s";
$text['branch'] = "Vetva";
$text['moreind'] = "Ďalšie osoby";
$text['morefam'] = "Ďalšie rodiny";
$text['surnamelist'] = "Zoznam priezvisk";
$text['generations'] = "Generácie";
$text['refresh'] = "Obnoviť";
$text['whatsnew'] = "Čo je nové";
$text['reports'] = "Zostavy";
$text['placelist'] = "Zoznam miest";
$text['baptizedlds'] = "Krstenie (CJKSpd)";
$text['endowedlds'] = "Obdarovanie (CJKSpd)";
$text['sealedplds'] = "Pečatenie R (CJKSpd)";
$text['sealedslds'] = "Pečatenie P (CJKSpd)";
$text['ancestors'] = "Predkovia";
$text['descendants'] = "Potomkovia";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Dátum posledného importu súboru GEDCOM";
$text['type'] = "Druh";
$text['savechanges'] = "Uložiť zmeny";
$text['familyid'] = "ID číslo rodiny";
$text['headstone'] = "Náhrobky";
$text['historiesdocs'] = "Historky";
$text['anonymous'] = "anonymné";
$text['places'] = "Miesta";
$text['anniversaries'] = "Dátumy a výročia";
$text['administration'] = "Administrácia";
$text['help'] = "Pomocník";
//$text['documents'] = "Documents";
$text['year'] = "Rok";
$text['all'] = "Všetko";
$text['address'] = "Adresa";
$text['suggest'] = "Navrhnúť";
$text['editevent'] = "Navrhnúť zmenu pre túto udalosť";
$text['morelinks'] = "Viac odkazov";
$text['faminfo'] = "Informácie o rodine";
$text['persinfo'] = "Osobné informácie";
$text['srcinfo'] = "Informácie o zdroji";
$text['fact'] = "Fakt";
$text['goto'] = "Vyberte stránku";
$text['tngprint'] = "Tlač";
$text['databasestatistics'] = "Štatistika databázy"; //needed to be shorter to fit on menu
$text['child'] = "Dieťa";  //from familygroup
$text['repoinfo'] = "Údaje o archíve";
$text['tng_reset'] = "Obnoviť";
$text['noresults'] = "Neboli nájdené žiadne výsledky";
$text['allmedia'] = "Všetky médiá";
$text['repositories'] = "Archívy";
$text['albums'] = "Albumy";
$text['cemeteries'] = "Cintoríny";
$text['surnames'] = "Priezviská";
$text['dates'] = "Dátumy";
$text['link'] = "Odkaz";
$text['media'] = "Médiá";
$text['gender'] = "Pohlavie";
$text['latitude'] = "Zem. šírka";
$text['longitude'] = "Zem. dĺžka";
$text['bookmarks'] = "Záložky";
$text['bookmark'] = "Záložka";
$text['mngbookmarks'] = "Prejsť na záložky";
$text['bookmarked'] = "Záložka pridaná";
$text['remove'] = "Odstrániť";
$text['find_menu'] = "Nájsť";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cintorín";
$text['gmapevent'] = "Mapa udalostí";
$text['gevents'] = "Udalosť";
$text['googleearthlink'] = "Odkaz na Google Earth";
$text['googlemaplink'] = "Odkaz na Google Maps";
$text['gmaplegend'] = "Pripnúť legendu";
$text['unmarked'] = "Neoznačené";
$text['located'] = "Lokalizované";
$text['albclicksee'] = "Kliknite na zobrazenie všetkých položiek v tomto albume";
$text['notyetlocated'] = "Ešte nelokalizované";
$text['cremated'] = "Spopolnený(á)";
$text['missing'] = "Chýbajúci";
$text['pdfgen'] = "Generátor PDF";
$text['blank'] = "Prázdna";
$text['fonts'] = "Fonty";
$text['header'] = "Hlavička";
$text['data'] = "Dáta";
$text['pgsetup'] = "Nastavenie stránky";
$text['pgsize'] = "Veľkosť stránky";
$text['orient'] = "Orientácia"; //for a page
$text['portrait'] = "Na výšku";
$text['landscape'] = "Na šírku";
$text['tmargin'] = "Horný okraj";
$text['bmargin'] = "Spodný okraj";
$text['lmargin'] = "Ľavý okraj";
$text['rmargin'] = "Pravý okraj";
$text['createch'] = "Vytvoriť";
$text['prefix'] = "Predpona";
$text['mostwanted'] = "Hľadá sa";
$text['latupdates'] = "Najnovšie aktualizácie";
$text['featphoto'] = "Hlavná fotografia";
$text['news'] = "Novinky";
$text['ourhist'] = "História našej rodiny";
$text['ourhistanc'] = "História a predkovia našej rodiny";
$text['ourpages'] = "Genealogické stránky našej rodiny";
$text['pwrdby'] = "Tieto stránky bežia na";
$text['writby'] = "vytvoril";
$text['searchtngnet'] = "Prehliadať TNG sieť (GENDEX)";
$text['viewphotos'] = "Prezrieť všetky fotografie";
$text['anon'] = "Momentálne ste anonymný";
$text['whichbranch'] = "Z ktorej vetvy ste?";
$text['featarts'] = "Najzaujímavejšie články";
$text['maintby'] = "Systém spravuje";
$text['createdon'] = "Vytvorené";
$text['reliability'] = "Vierohodnosť";
$text['labels'] = "Návestia";
$text['inclsrcs'] = "Zahrnúť zdroje";
$text['cont'] = "(pokrač.)"; //abbreviation for continued
$text['mnuheader'] = "Domovská stránka";
$text['mnusearchfornames'] = "Hľadať";
$text['mnulastname'] = "Priezvisko";
$text['mnufirstname'] = "Meno";
$text['mnusearch'] = "Hľadať";
$text['mnureset'] = "Začať znova";
$text['mnulogon'] = "Prihlásenie";
$text['mnulogout'] = "Odhlásenie";
$text['mnufeatures'] = "Ďalšie možnosti";
$text['mnuregister'] = "Registrácia účtu používateľa";
$text['mnuadvancedsearch'] = "Rozšírené hľadanie";
$text['mnulastnames'] = "Priezviská";
$text['mnustatistics'] = "Štatistika";
$text['mnuphotos'] = "Fotografie";
$text['mnuhistories'] = "Historky";
$text['mnumyancestors'] = "Fotografie &amp; Historky o predkoch od [Person]";
$text['mnucemeteries'] = "Cintoríny";
$text['mnutombstones'] = "Náhrobky";
$text['mnureports'] = "Zostavy";
$text['mnusources'] = "Zdroje";
$text['mnuwhatsnew'] = "Čo je nové";
$text['mnushowlog'] = "Protokol prístupov";
$text['mnulanguage'] = "Zmena jazyka";
$text['mnuadmin'] = "Administrácia";
$text['welcome'] = "Vitajte";
$text['contactus'] = "Napíšte nám";
//changed in 8.0.0
$text['born'] = "Narodenie";
$text['searchnames'] = "Hľadať osoby";
//added in 8.0.0
$text['editperson'] = "Upraviť osobu";
$text['loadmap'] = "Zaviesť mapu";
$text['birth'] = "Narodenie";
$text['wasborn'] = "sa narodil(a)";
$text['startnum'] = "Prvé číslo";
$text['searching'] = "Hľadam";
//moved here in 8.0.0
$text['location'] = "Miesto";
$text['association'] = "Spojenie";
$text['collapse'] = "Zbaliť";
$text['expand'] = "Rozbaliť";
$text['plot'] = "Zaznačiť";
$text['searchfams'] = "Hľadať rodiny";
//added in 8.0.2
$text['wasmarried'] = "sobáš. s";
$text['anddied'] = "zomrel(a)";
//added in 9.0.0
$text['share'] = "Zdieľať";
$text['hide'] = "Skryť";
$text['disabled'] = "Váš používateľský účet bol zablokovaný.  Kontaktujte, prosím, administrátora týchto webových stránok.";
$text['contactus_long'] = "Ak máte nejaké otázky alebo pripomienky ohľadom informácií na týchto stránkach alebo by ste mali záujem spolupracovať na ďalšom výskume, prípadne poskytnúť ďalšie informácie, neváhajte a <span class=\"emphasis\"><a href=\"suggest.php\">kontaktujte ma</a></span>.";
$text['features'] = "Zaujímavosti";
$text['resources'] = "Prostriedky";
$text['latestnews'] = "Posledné novinky";
$text['trees'] = "Stromy";
$text['wasburied'] = "pochov.:";
//moved here in 9.0.0
$text['emailagain'] = "Email znova";
$text['enteremail2'] = "Zadajte, prosím, znova vašu emailovú adresu.";
$text['emailsmatch'] = "Zadané emailové adresy nie sú rovnaké. Zadajte rovnakú emailovú adresu do obidvoch polí.";
$text['getdirections'] = "Kliknite na získanie podrobností";
$text['calendar'] = "Kalendár";
//changed in 9.0.0
$text['directionsto'] = " k ";
$text['slidestart'] = "Prezentácia";
$text['livingnote'] = "S touto poznámkou je spojená aspoň jedna žijúca alebo neverejná osoba - podrobnosti nie sú zverejnené.";
$text['livingphoto'] = "S touto položkou je spojená aspoň jedna žijúca alebo neverejná osoba - podrobnosti nie sú zverejnené.";
$text['waschristened'] = "krst.:";
//added in 10.0.0
$text['branches'] = "Vetvy";
$text['detail'] = "Detail";
$text['moredetail'] = "Viac detailov";
$text['lessdetail'] = "Menej detailov";
$text['conflds'] = "Birmovanie (CJKSpd)";
$text['initlds'] = "Zasvätenie (CJKSpd)";
$text['wascremated'] = "bol(a) spopolnený(á)";
//moved here in 11.0.0
$text['text_for'] = "pre";
//added in 11.0.0
$text['searchsite'] = "Hľadať v tomto webovom sídle";
$text['searchsitemenu'] = "Hľadanie";
$text['kmlfile'] = "Stiahnite súbor .kml na zobrazenie tejto lokality v Google Earth";
$text['download'] = "Kliknite na stiahnutie";
$text['more'] = "Viac";
$text['heatmap'] = "Zobraziť mapu";
$text['refreshmap'] = "Obnoviť mapu";
$text['remnums'] = "Vymazať čísla a  špendlíky";
$text['photoshistories'] = "Fotografie &amp; Historky";
$text['familychart'] = "Rodinná schéma";
//added in 12.0.0
$text['firstnames'] = "Prvé mená";
//moved here in 12.0.0
$text['dna_test'] = "DNA test";
$text['test_type'] = "Typ testu";
$text['test_info'] = "Informácia o teste";
$text['takenby'] = "Testovaná osoba";
$text['haplogroup'] = "Haploskupina";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Dôležité spojenia";
$text['nofirstname'] = "[žiadne krstné meno]";
//added in 12.0.1
$text['cookieuse'] = "Všimnite si, že toto webové sídlo používa cookies.";
$text['dataprotect'] = "Zásady ochrany údajov";
$text['viewpolicy'] = "Pozrieť zásady";
$text['understand'] = "Rozumiem";
$text['consent'] = "Dávam svoj súhlas pre toto webové sídlo na uchovávanie tu nazbieraných osobných informácií. Viem, že hocikedy môžem požiadať vlastníka tohto sídla na odstránenie týchto informácií.";
$text['consentreq'] = "Prosím, dajte svoj súhlas pre toto webové sídlo na ukladanie osobných informácií.";

//added in 12.1.0
$text['testsarelinked'] = "DNA testy sú združené s";
$text['testislinked'] = "DNA test je združený s";

//added in 12.2
$text['quicklinks'] = "Rýchle odkazy";
$text['yourname'] = "Vaše meno";
$text['youremail'] = "Vaša emailová adresa";
$text['liketoadd'] = "Akékoľvek informácie, ktoré chcete pridať";
$text['webmastermsg'] = "Správa správcu webu";
$text['gallery'] = "Zobraziť galériu";
$text['wasborn_male'] = "sa narodil";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "sa narodila"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "bol pokrstený";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "bola pokrstená";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "zomrel";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "zomrela";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "bol pochovaný"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "bola pochovaná"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "bol spopolnený";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "bola spopolnená";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "bol sobášený s";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "bola sobášená s";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "bol rozvedený";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "bola rozvedená";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " v ";			// used as a preposition to the location
$text['onthisdate'] = " dňa ";		// when used with full date
$text['inthisyear'] = " v ";		// when used with year only or month / year dates
$text['and'] = "a ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Informácia o teste DNA";
//added in 13.0
$text['visitor'] = "Návštevník";

$text['popupnote2'] = " = Nový rodokmeň";

//moved here in 14.0
$text['zoomin'] = "Priblížiť";
$text['zoomout'] = "Oddialiť";
$text['scrollnote'] = "Ťahajte alebo rolujte, aby ste si pozreli viac z tohto diagramu.";
$text['general'] = "Všeobecne";

//changed in 14.0
$text['otherevents'] = "Iné udalosti";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Spojenia";
$text['continue'] = "Pokračovať";
$text['title2'] = "Názov"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>