<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Prehliada» v¹etky zdroje";
		$text['shorttitle'] = "Krátky názov";
		$text['callnum'] = "Archívne èíslo";
		$text['author'] = "Autor";
		$text['publisher'] = "Vydavateµ";
		$text['other'] = "Ïal¹ie informácie";
		$text['sourceid'] = "ID èíslo zdroja";
		$text['moresrc'] = "Ïal¹ie zdroje";
		$text['repoid'] = "ID èíslo archívu";
		$text['browseallrepos'] = "Prehliada» v¹etky archívy";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nový jazyk";
		$text['changelanguage'] = "Zmena jazyka";
		$text['languagesaved'] = "Jazyk ulo¾ený";
		$text['sitemaint'] = "Práve probieha údr¾ba webových stránok";
		$text['standby'] = "Webová stránka je doèasne nedostupná, preto¾e probieha aktualizácia databázy. Skúste to, prosím, znova o pár minút. Ak bude stránka nedostupná dlh¹iu dobu, kontaktujte majiteµa tejto stránky.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM zaèínajúci od";
		$text['producegedfrom'] = "Vytvori» GEDCOM súbor z";
		$text['numgens'] = "Poèet generácií";
		$text['includelds'] = "Vèítane údajov CJKSpd";
		$text['buildged'] = "Vytvor GEDCOM";
		$text['gedstartfrom'] = "GEDCOM zaèínajúci od";
		$text['nomaxgen'] = "Musíte zada» maximálny poèet generácií. Pou¾ijte tlaèídlo Spä» na návrat na predchádzajúcu stránku a chybu opravte.";
		$text['gedcreatedfrom'] = "GEDCOM vytvorený od";
		$text['gedcreatedfor'] = "vytvorený pre";
		$text['creategedfor'] = "Vytvori» GEDCOM";
		$text['email'] = "Vá¹ email";
		$text['suggestchange'] = "Navrhnú» zmenu";
		$text['yourname'] = "Va¹e meno";
		$text['comments'] = "Popis <br />navrhovaných zmien";
		$text['comments2'] = "Komentáre";
		$text['submitsugg'] = "Odosla» návrh";
		$text['proposed'] = "Navrhovaná zmena";
		$text['mailsent'] = "Ïakujeme. Va¹a správa bola odoslaná.";
		$text['mailnotsent'] = "Bohu¾iaµ, va¹a správa nemohla by» doruèená. Kontaktujte, prosím, xxx priamo na yyy.";
		$text['mailme'] = "Zasla» kópiu na túto adresu";
		$text['entername'] = "Zadajte, prosím, va¹e meno";
		$text['entercomments'] = "Zadajte, prosím, va¹e pripomienky";
		$text['sendmsg'] = "Posla» správu";
		//added in 9.0.0
		$text['subject'] = "Predmet";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografie a historky pre";
		$text['indinfofor'] = "Osobné informácie o";
		$text['pp'] = "str."; //page abbreviation
		$text['age'] = "Vek";
		$text['agency'] = "In¹titúcia";
		$text['cause'] = "Príèina";
		$text['suggested'] = "Navrhnuté";
		$text['closewindow'] = "Zatvori» toto okno";
		$text['thanks'] = "Ïakujeme";
		$text['received'] = "Vá¹ návrh bol odoslaný administrátorovi tejto stránky na posúdenie.";
		$text['indreport'] = "Zostava osoby";
		$text['indreportfor'] = "Zostava osoby";
		$text['bkmkvis'] = "Poznámka: Tieto zálo¾ky sú viditeµné len na tomto poèítaèi a v tomto prehliadaèi.";
        //added in 9.0.0
		$text['reviewmsg'] = "Máte navrhnutú zmenu, ktorá vy¾aduje va¹e posúdenie. Táto zmena sa týka:";
        $text['revsubject'] = "Navrhovaná zmena vy¾aduje va¹e posúdenie";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Kalkulátor príbuzností";
		$text['findrel'] = "Nájs» príbuzenský vz»ah";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "Vypoèíta»";
		$text['select2inds'] = "Prosím, vyberte dvoch jednotlivcov.";
		$text['findpersonid'] = "Nájs» ID èíslo osoby";
		$text['enternamepart'] = "zadajte èas» mena a/alebo priezviska";
		$text['pleasenamepart'] = "Prosím, zadajte èas» mena alebo priezviska.";
		$text['clicktoselect'] = "kliknite na vybratie osoby";
		$text['nobirthinfo'] = "Chýbajú informácie o narodení";
		$text['relateto'] = "Príbuzenský vz»ah k: ";
		$text['sameperson'] = "Títo dvaja jednotlivci sú tá istá osoba.";
		$text['notrelated'] = "Tieto dve osoby nemajú ¾iadny príbuzenský vz»ah v rozsahu xxx generácií"; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Na zobrazenie vz»ahu medzi dvoma osobami pou¾ite tlaèidlo 'Nájs»' na nájdenie príslu¹ných osôb, alebo ponechajte zobrazené osoby, potom kliknite na 'Vypoèíta»'.<br>(Anglické výrazy vz»ahov sa nie v¾dy podarí kalkulátoru správne prelo¾i» do slovenèiny.)";
		$text['sometimes'] = "(Niekedy kontrola cez rôzny poèet generácií dáva odli¹ný výsledok.)";
		$text['findanother'] = "Nájs» iný príbuzenský vz»ah";
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
		$text['rhusband'] = "man¾el od";
		$text['rwife'] = "man¾elka od";
		$text['rspouse'] = "partner od";
		$text['son'] = "syn od";
		$text['daughter'] = "dcéra od";
		$text['rchild'] = "die»a od";
		$text['sil'] = "za» od";
		$text['dil'] = "nevesta od";
		$text['sdil'] = "za» alebo nevesta od";
		$text['gson'] = " xxx vnuk od";
		$text['gdau'] = " xxx vnuèka od";
		$text['gsondau'] = "xxx vnuk/vnuèka od";
		$text['great'] = "pra";
		$text['spouses'] = "sú man¾elia";
		$text['is'] = "je";
		$text['changeto'] = "Zmeni» na (zadajte ID èíslo):";
		$text['notvalid'] = "nie je platné ID èíslo osoby alebo neexistuje v tejto databáze. Skúste to, prosím, znova.";
		$text['halfbrother'] = "nevlastný brat od";
		$text['halfsister'] = "nevlastná sestra od";
		$text['halfsibling'] = "nevlastný súrodenec od";
		//changed in 8.0.0
		$text['gencheck'] = "Maximálny poèet kontrolovaných generácií";
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
		$text['gpar'] = "xxx starý rodiè od";
		$text['mothof'] = "matka od";
		$text['fathof'] = "otec od ";
		$text['parof'] = "rodiè od";
		$text['maxrels'] = "Maximálny poèet vz»ahov na zobrazenie";
		$text['dospouses'] = "Zobrazi» vz»ahy vèítane man¾elov";
		$text['rels'] = "Príbuzenské vz»ahy";
		$text['dospouses2'] = "Zobrazi» man¾elov";
		$text['fil'] = "svokor od";
		$text['mil'] = "svokra od";
		$text['fmil'] = "svokor alebo svokra od";
		$text['stepson'] = "nevlastný syn od";
		$text['stepdau'] = "nevlastná dcéra od";
		$text['stepchild'] = "nevlastné die»a od";
		$text['stepgson'] = "xxx nevlastný vnuk od";
		$text['stepgdau'] = "xxx nevlastná vnuèka od";
		$text['stepgchild'] = "xxx nevlastné vnúèa od";
		//added in 8.1.1
		$text['ggreat'] = "pra";
		//added in 8.1.2
		$text['ggfath'] = " xxx pradedko od";
		$text['ggmoth'] = " xxx prababièka od";
		$text['ggpar'] = " xxx prarodiè od";
		$text['ggson'] = " xxx pravnuk od";
		$text['ggdau'] = " xxx pravnuèka od";
		$text['ggsondau'] = " xxx pradie»a od";
		$text['gstepgson'] = "xxx nevlastný pravnuk od";
		$text['gstepgdau'] = "xxx nevlastná pravnuèka od";
		$text['gstepgchild'] = "xxx nevlastné prapradie»a od";
		$text['guncle'] = " xxx prastrýko od";
		$text['gaunt'] = " xxx prateta od";
		$text['guncleaunt'] = " xxx prastrýko/prateta od";
		$text['gnephew'] = " xxx prasynovec od";
		$text['gniece'] = " xxx praneter od";
		$text['gnephnc'] = " xxx prasynovec/praneter od";
		//added in 14.0
		$text['pathscalc'] = "Hµada» spojenia";
		$text['findrel2'] = "Nájs» vz»ahy a iné spojenia";
		$text['makeme2nd'] = "Pou¾i» moje ID";
		$text['usebookmarks'] = "Pou¾i» zálo¾ky";
		$text['select2inds'] = "Prosím, vyberte dvoch jednotlivcov.";
		$text['indinfofor'] = "Info jednotlivca pre";
		$text['nobookmarks'] = "Nie je ¾iadna zálo¾ka na pou¾itie";
		$text['bkmtitle'] = "Osoby nájdené pri zálo¾kách";
		$text['bkminfo'] = "Vyberte osobu:";
		$text['sortpathsby'] = "Triedi» cesty podµa poètu";
		$text['sortbyshort'] = "Triedi» podµa";
		$text['bylengthshort'] = "Då¾ka";
		$text['badID1'] = ": zlé ID osoby 1 - prosím, vrá»te sa spä» a opravte to";
		$text['badID2'] = ": zlé ID osoby 2 - prosím, vrá»te sa spä» a opravte to";
		$text['notintree'] = ": osoba s týmto ID nie je v aktuálnej stromovej databáze.";
		$text['sameperson'] = "Títo dvaja jednotlivci sú tá istá osoba.";;
		$text['nopaths'] = "Tieto osoby nie sú spojené.";
		$text['nopaths1'] = "Nie sú ¾iadne ïal¹ie spojenia krat¹ie ako xxx";
		$text['nopaths2'] = "pri xxx krokoch hµadania";
		$text['longestpath'] = "(najdlh¹ia doteraz kontrolovaná cesta bola xxx krokov dlhá)";
		$text['relevantpaths'] = "Poèet nájdených odli¹ných relevantných ciest: xxx";
		$text['skipMarr'] = "(naviac, poèet nájdených ciest, ale nezobrazených kvôli veµkému poètu sobá¹ov bol: xxx)";
		$text['mjaor'] = "alebo";
		$text['connectionsto'] = "Spojenia k ";
		$text['findanotherpers'] = "Nájs» ïal¹iu osobu...";
		$text['sometimes'] = "(Niekedy kontrola cez rôzny poèet generácií dáva odli¹ný výsledok.)";
		$text['anotherpath'] = "Hµada» ïal¹ie spojenia";
		$text['xpath'] = "Cesta ";
		$text['primary'] = "Zaèiatoèná osoba"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Koneèná osoba";
		$text['parent'] = "Rodiè";
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
		$text['hhusband'] = "man¾el";
		$text['hwife'] = "man¾elka";
		$text['hson'] = "syn";
		$text['hdaughter'] = "dcéra";
		$text['maxruns'] = "Maximálny poèet ciest, ktoré sa majú skontrolova»";
		$text['maxrshort'] = "Maximálne cesty";
		$text['maxlength'] = "Cesty spojenia nie dlh¹ie ako";
		$text['maxlshort'] = "Maximálna då¾ka";
		$text['xstep'] = "krok";
		$text['xsteps'] = "kroky";
		$text['xmarriages'] = "xxx sobá¹e";
		$text['xmarriage'] = "1 sobá¹";
		$text['showspouses'] = "Zobrazi» oboch man¾elov";
		$text['showTxt'] = "Zobrazi» textový popis cesty";
		$text['showTxtshort'] = "Textový popis";
		$text['compactBox'] = "Zobrazenie kompaktných okienok osôb";
		$text['compactBoxshort'] = "Kompaktné okienka";
		$text['paths'] = "Cesty";
		$text['dospouses2'] = "Zobrazi» man¾elov";
		$text['maxmopt'] = "Max. man¾elstvá podµa spojenia";
		$text['maxm'] = "Max. man¾elstvá";
		$text['arerelated'] = "Tieto osoby sú príbuzné - ich vz»ah je ukázaný v Ceste 1";
		$text['simplerel'] = "JednoduchÈ hµadanie vzªahu";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Zostava rodiny";
		$text['ldsords'] = "Obrady CJKSpd";
		$text['baptizedlds'] = "Krstenie (CJKSpd)";
		$text['endowedlds'] = "Obdarovanie (CJKSpd)";
		$text['sealedplds'] = "Peèatenie s rodièmi (CJKSpd)";
		$text['sealedslds'] = "Peèatenie s partnerom (CJKSpd)";
		$text['otherspouse'] = "Ïal¹í partner";
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
		$text['popupnote1'] = " = Ïal¹ie informácie";
		$text['pedcompact'] = "Kompaktne";
		$text['pedstandard'] = "©tandardne";
		$text['pedtextonly'] = "Len text";
		$text['descendfor'] = "Schéma potomkov osoby";
		$text['maxof'] = "Najviac";
		$text['gensatonce'] = "generácií zobrazených naraz.";
		$text['sonof'] = "syn od";
		$text['daughterof'] = "dcéra od";
		$text['childof'] = "die»a od";
		$text['stdformat'] = "©tandardný formát";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Prida» novú rodinu";
		$text['editfam'] = "Upravi» rodinu";
		$text['side'] = "strana";
		$text['familyof'] = "Rodina";
		$text['paternal'] = "Otcova";
		$text['maternal'] = "Matkina";
		$text['gen1'] = "Ja";
		$text['gen2'] = "Rodièia";
		$text['gen3'] = "Prarodièia";
		$text['gen4'] = "Praprarodièia";
		$text['gen5'] = "3xprarodièia";
		$text['gen6'] = "4xprarodièia";
		$text['gen7'] = "5xprarodièia";
		$text['gen8'] = "6xprarodièia";
		$text['gen9'] = "7xprarodièia";
		$text['gen10'] = "8xprarodièia";
		$text['gen11'] = "9xprarodièia";
		$text['gen12'] = "10xprarodièia";
		$text['graphdesc'] = "Schéma potomkov a¾ do tohto miesta";
		$text['pedbox'] = "Rámèek";
		$text['regformat'] = "Register";
		$text['extrasexpl'] = "Pri tejto osobe existuje aspoò jedna fotografia, historka alebo iná mediálna polo¾ka.";
		$text['popupnote3'] = " = Nová schéma";
		$text['mediaavail'] = "Médiá sú k dispozícii";
		$text['pedigreefor'] = "Schéma rodokmeòa pre";
		$text['pedigreech'] = "Schéma rodokmeòa";
		$text['datesloc'] = "Dátumy a miesta";
		$text['borchr'] = "Narod/Krst - Úmrtie/Pohr (dva)";
		$text['nobd'] = "Bez dátumov narodenia alebo úmrtia";
		$text['bcdb'] = "V¹etky údaje Narod/Krst/Úmrtie/Pohr (¹tyri)";
		$text['numsys'] = "Systém èíslovania";
		$text['gennums'] = "Èísla generácií";
		$text['henrynums'] = "Èíslovanie podµa Henryho";
		$text['abovnums'] = "Èíslovanie podµa d'Aboville";
		$text['devnums'] = "Èíslovanie podµa de Villiers";
		$text['dispopts'] = "Mo¾nosti zobrazenia";
		//added in 10.0.0
		$text['no_ancestors'] = "Neboli nájdení ¾iadni predkovia";
		$text['ancestor_chart'] = "Zvislá schéma predkov";
		$text['opennewwindow'] = "Otvori» v novom okne";
		$text['pedvertical'] = "Zvisle";
		//added in 11.0.0
		$text['familywith'] = "Rodina s";
		$text['fcmlogin'] = "Prosím, prihláste sa na pozretie detailov";
		$text['isthe'] = "je";
		$text['otherspouses'] = "ïal¹í partneri";
		$text['parentfamily'] = "Rodina rodièov ";
		$text['showfamily'] = "Zobrazi» rodinu";
		$text['shown'] = "zobrazené";
		$text['showparentfamily'] = "zobrazi» rodinu rodièov";
		$text['showperson'] = "zobrazi» osobu";
		//added in 11.0.2
		$text['otherfamilies'] = "Ïal¹ie rodiny";
		//added in 14.0
		$text['dtformat'] = "Tabuµky";
		$text['dtchildren'] = "Deti";
		$text['dtgrandchildren'] = "Vnúèatá";
		$text['dtggrandchildren'] = "Pravnúèatá";
		$text['dtgggrandchildren'] = "Prapravnúèatá"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "®iadni potomkovia";
		$text['dtgen'] = "Gen.";
		$text['dttotal'] = "Celkom";
		$text['dtselect'] = "Vybra»";
		$text['dteachfulltable'] = "Ka¾dá plná tabuµka bude ma»";
		$text['dtrows'] = "riadky";
		$text['dtdisplayingtable'] = "Zobrazenie tabuµky";
		$text['dtgototable'] = "Choï na tabuµku:";
		$text['fcinstrdn'] = "Zobrazi» rodinu s man¾elmi";
		$text['fcinstrup'] = "Zobrazi» rodinu s rodièmi";
		$text['fcinstrplus'] = "Vybra» iných man¾elov";
		$text['fcinstrfam'] = "Vybra» iných rodièov";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "®iadna zostava neexistuje.";
		$text['reportname'] = "Názov zostavy";
		$text['allreports'] = "V¹etky zostavy";
		$text['report'] = "Zostava";
		$text['error'] = "Chyba";
		$text['reportsyntax'] = "Syntax dotazu pre túto zostavu";
		$text['wasincorrect'] = "bola chybná, a zostava nemohla by» vytvorená. Kontaktujte, prosím, administrátora systému na";
		$text['errormessage'] = "Hlásenie o chybe";
		$text['equals'] = "rovná sa";
		$text['endswith'] = "konèí na";
		$text['soundexof'] = "soundex";
		$text['metaphoneof'] = "metaphone";
		$text['plusminus10'] = "+/- 10 rokov od";
		$text['lessthan'] = "men¹í ako";
		$text['greaterthan'] = "väè¹í ako";
		$text['lessthanequal'] = "men¹í alebo rovný";
		$text['greaterthanequal'] = "väè¹í alebo rovný";
		$text['equalto'] = "rovný";
		$text['tryagain'] = "Prosím, skúste to znova";
		$text['joinwith'] = "Spoji» s";
		$text['cap_and'] = "A";
		$text['cap_or'] = "ALEBO";
		$text['showspouse'] = "Zobrazi» partnera (ak osoba má viac partnerov, bude zobrazená viackrát)";
		$text['submitquery'] = "Vykona» dotaz";
		$text['birthplace'] = "Miesto narodenia";
		$text['deathplace'] = "Miesto úmrtia";
		$text['birthdatetr'] = "Rok narodenia";
		$text['deathdatetr'] = "Rok úmrtia";
		$text['plusminus2'] = "+/- 2 roky od";
		$text['resetall'] = "Obnovi» v¹etky hodnoty na východzie";
		$text['showdeath'] = "Zobrazi» informácie o úmrtí/pohrebe";
		$text['altbirthplace'] = "Miesto krstu";
		$text['altbirthdatetr'] = "Rok krstu";
		$text['burialplace'] = "Miesto pohrebu";
		$text['burialdatetr'] = "Rok pohrebu";
		$text['event'] = "Udalos»";
		$text['day'] = "Deò";
		$text['month'] = "Mesiac";
		$text['keyword'] = "Kµúèové slovo (napr. \"asi\")";
		$text['explain'] = "Na zobrazenie odpovedajúcich udalostí zadajte dátum. Na zobrazenie v¹etkých udalostí nechajte pole prázdne.";
		$text['enterdate'] = "Prosím, zadajte alebo vyberte aspoò jedno z nasledujúcich: Deò, Mesiac, Rok, Kµúèové slovo";
		$text['fullname'] = "Celé meno";
		$text['birthdate'] = "Dátum narodenia";
		$text['altbirthdate'] = "Dátum krstu";
		$text['marrdate'] = "Dátum sobá¹a";
		$text['spouseid'] = "ID èíslo partnera";
		$text['spousename'] = "Meno partnera";
		$text['deathdate'] = "Dátum úmrtia";
		$text['burialdate'] = "Dátum pohrebu";
		$text['changedate'] = "Dátum poslednej zmeny";
		$text['gedcom'] = "Strom";
		$text['baptdate'] = "CJKSpd dátum krstu";
		$text['baptplace'] = "CJKSpd miesto krstu";
		$text['endldate'] = "CJKSpd dátum zasnúbenia";
		$text['endlplace'] = "CJKSpd miesto zasnúbenia";
		$text['ssealdate'] = "CJKSpd dátum peèatenia s partnerom";   //Sealed to spouse
		$text['ssealplace'] = "CJKSpd miesto peèatenia s partnerom";
		$text['psealdate'] = "CJKSpd dátum peèatenia s rodièmi";   //Sealed to parents
		$text['psealplace'] = "CJKSpd miesto peèatenia s rodièmi";
		$text['marrplace'] = "Miesto sobá¹a";
		$text['spousesurname'] = "Priezvisko partnera";
		$text['spousemore'] = "Ak zadávate priezvisko partnera, musíte vybra» pohlavie.";
		$text['plusminus5'] = "+/- 5 rokov od";
		$text['exists'] = "existuje";
		$text['dnexist'] = "neexistuje";
		$text['divdate'] = "Dátum rozvodu";
		$text['divplace'] = "Miesto rozvodu";
		$text['otherevents'] = "Iné kritériá hµadania";
		$text['numresults'] = "Poèet výsledkov na stránke";
		$text['mysphoto'] = "Záhadné fotografie";
		$text['mysperson'] = "Hµadané osoby";
		$text['joinor'] = "Voµbu 'Join with OR' nemo¾no pou¾i» s priezviskom partnera";
		$text['tellus'] = "Ak máte nejaké informácie, napí¹te nám";
		$text['moreinfo'] = "Viac informácií";
		//added in 8.0.0
		$text['marrdatetr'] = "Rok sobá¹a";
		$text['divdatetr'] = "Rok rozvodu";
		$text['mothername'] = "Meno matky";
		$text['fathername'] = "Meno otca";
		$text['filter'] = "Filter";
		$text['notliving'] = "Zosnulí";
		$text['nodayevents'] = "Udalosti v tomto mesiaci, ktoré nie sú spojené s urèitým dòom:";
		//added in 9.0.0
		$text['csv'] = "Súbor CSV s údajmi oddelenými èiarkami";
		//added in 10.0.0
		$text['confdate'] = "Dátum birmovania (CJKSpd)";
		$text['confplace'] = "Miesto birmovania (CJKSpd)";
		$text['initdate'] = "Dátum zasvätenia (CJKSpd)";
		$text['initplace'] = "Miesto zasvätenia (CJKSpd)";
		//added in 11.0.0
		$text['marrtype'] = "Typ sobá¹a";
		$text['searchfor'] = "Hµada»";
		$text['searchnote'] = "Poznámka: Táto stránka pou¾íva Google na vykonávanie hµadania. Poèet nájdených zhôd bude priamo závisie» od rozsahu, v akom Google je schopný indexova» toto webové sídlo.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Protokolárny súbor";
		$text['mostrecentactions'] = "Nedávne aktivity";
		$text['autorefresh'] = "Automatická obnova (30 sekúnd)";
		$text['refreshoff'] = "Vypnú» automatickú obnovu";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cintoríny a náhrobky";
		$text['showallhsr'] = "Zobrazi» v¹etky záznamy náhrobkov";
		$text['in'] = "v";
		$text['showmap'] = "Ukáza» mapu";
		$text['headstonefor'] = "Náhrobok pre";
		$text['photoof'] = "Fotografie";
		$text['photoowner'] = "Vlastník originálu";
		$text['nocemetery'] = "Cintorín neuvedený";
		$text['iptc005'] = "Názov";
		$text['iptc020'] = "Podporované kategórie";
		$text['iptc040'] = "Zvlá¹tne in¹trukcie";
		$text['iptc055'] = "Dátum vytvorenia";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Autorova funkcia";
		$text['iptc090'] = "Mesto/obec";
		$text['iptc095'] = "©tát/Kraj";
		$text['iptc101'] = "Krajina";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Nadpis";
		$text['iptc110'] = "Zdroj";
		$text['iptc115'] = "Zdroj fotografie";
		$text['iptc116'] = "V¹etky práva vyhradené";
		$text['iptc120'] = "Popis";
		$text['iptc122'] = "Popis vytvoril";
		$text['mapof'] = "Mapa";
		$text['regphotos'] = "Zobrazenie s popisom";
		$text['gallery'] = "Len miniatúry";
		$text['cemphotos'] = "Fotky z cintorínov";
		$text['photosize'] = "Rozmery";
        $text['iptc010'] = "Priorita";
		$text['filesize'] = "Veµkos» súboru";
		$text['seeloc'] = "Pozrite si miesto";
		$text['showall'] = "Zobrazi» v¹etko";
		$text['editmedia'] = "Upravi» médium";
		$text['viewitem'] = "Prezrie» túto polo¾ku";
		$text['editcem'] = "Upravi» cintorín";
		$text['numitems'] = "Poèet polo¾iek";
		$text['allalbums'] = "V¹etky albumy";
		$text['slidestop'] = "Pozastavi» prezentáciu";
		$text['slideresume'] = "Obnovi» prezentáciu";
		$text['slidesecs'] = "Poèet sekúnd pre ka¾dú snímku:";
		$text['minussecs'] = "ubra» 0,5 sekundy";
		$text['plussecs'] = "prida» 0,5 sekundy";
		$text['nocountry'] = "Neznáma krajina";
		$text['nostate'] = "Neznámy ¹tát/kraj";
		$text['nocounty'] = "Neznámy okres";
		$text['nocity'] = "Neznáme mesto/obec";
		$text['nocemname'] = "Neznámy názov cintorína";
		$text['editalbum'] = "Upravi» album";
		$text['mediamaptext'] = "<strong>Poznámka:</strong> Posúvaním ukazovateµa my¹i cez obrázok sa zobrazia názvy. Kliknutím sa zobrazí stránka k tomuto názvu.";
		//added in 8.0.0
		$text['allburials'] = "V¹etky pohreby";
		$text['moreinfo'] = "Kliknutím sa zobrazí viac informácií o obrázku";
		//added in 9.0.0
        $text['iptc025'] = "Kµúèové slová";
        $text['iptc092'] = "Èas» miesta";
		$text['iptc015'] = "Kategória";
		$text['iptc065'] = "Pôvodný program";
		$text['iptc070'] = "Verzia programu";
		//added in 13.0
		$text['toggletags'] = "Prepnú» znaèky";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Zobrazi» priezviská zaèínajúce na";
		$text['showtop'] = "Zobrazi» prvých ";
		$text['showallsurnames'] = "Zobrazi» v¹etky priezviská";
		$text['sortedalpha'] = "zoradené podµa abecedy";
		$text['byoccurrence'] = "zoradených podµa poèetnosti";
		$text['firstchars'] = "Zaèiatoèné písmená";
		$text['mainsurnamepage'] = "Hlavná stránka priezvisk";
		$text['allsurnames'] = "V¹etky priezviská";
		$text['showmatchingsurnames'] = "Kliknutím na priezvisko sa zobrazia odpovedajúce záznamy.";
		$text['backtotop'] = "Spä» na zaèiatok";
		$text['beginswith'] = "Zaèína na";
		$text['allbeginningwith'] = "V¹etky priezviská zaèínajúce na";
		$text['numoccurrences'] = "celkový poèet miest v zátvorke";
		$text['placesstarting'] = "Zobrazi» najvýznamnej¹ie miesta, ktoré zaèínajú na";
		$text['showmatchingplaces'] = "Kliknutím na miesto sa zobrazia men¹ie lokality. Kliknutím na ikonu Hµada» sa zobrazia odpovedajúce osoby.";
		$text['totalnames'] = "celkom osôb";
		$text['showallplaces'] = "Zobrazi» v¹etky najvýznamnej¹ie lokality";
		$text['totalplaces'] = "celkom miest";
		$text['mainplacepage'] = "Hlavná stránka miest";
		$text['allplaces'] = "V¹etky najvýznamnej¹ie lokality";
		$text['placescont'] = "Zobrazi» v¹etky miesta obsahujúce";
		//changed in 8.0.0
		$text['top30'] = "xxx najèastej¹ie sa vyskytujúcich priezvisk";
		$text['top30places'] = "xxx najvýznamnej¹ích lokalít";
		//added in 12.0.0
		$text['firstnamelist'] = "Zoznam krstných mien";
		$text['firstnamesstarting'] = "Zobrazi» krstné mená zaèínajúce na";
		$text['showallfirstnames'] = "Zobrazi» v¹etky krstné mená";
		$text['mainfirstnamepage'] = "Hlavná stránka krstných mien";
		$text['allfirstnames'] = "V¹etky krstné mená";
		$text['showmatchingfirstnames'] = "Kliknutím na krstné meno sa zobrazia odpovedajúce záznamy.";
		$text['allfirstbegwith'] = "V¹etky krstné mená zaèínajúce na";
		$text['top30first'] = "Top xxx najèastej¹ie sa vyskytujúcich krstných mien";
		$text['allothers'] = "V¹etky ostatné";
		$text['amongall'] = "(medzi v¹etkými menami)";
		$text['justtop'] = "Len top xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(v posledných xx dòoch)";

		$text['photo'] = "Fotografia";
		$text['history'] = "Historka/Dokument";
		$text['husbid'] = "ID èíslo otca";
		$text['husbname'] = "Meno otca";
		$text['wifeid'] = "ID èíslo matky";
		//added in 11.0.0
		$text['wifename'] = "Meno matky";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Odstráni»";
		$text['addperson'] = "Prida» osobu";
		$text['nobirth'] = "Nasledujúca osoba nemá platný dátum narodenia, a nemo¾no ju prida»";
		$text['event'] = "Udalosti";
		$text['chartwidth'] = "©írka schémy";
		$text['timelineinstr'] = "Prida» osoby";
		$text['togglelines'] = "Prepnú» zobrazenie osi";
		//changed in 9.0.0
		$text['noliving'] = "Nasledujúca osoba je oznaèená ako ¾ijúca alebo neverejná, nemo¾no ju pridat, preto¾e nemáte nále¾ité prístupové práva";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Prehliada» v¹etky stromy";
		$text['treename'] = "Názov stromu";
		$text['owner'] = "Majiteµ";
		$text['address'] = "Adresa";
		$text['city'] = "Mesto/obec";
		$text['state'] = "©tát/Kraj";
		$text['zip'] = "PSÈ";
		$text['country'] = "Krajina";
		$text['email'] = "Email";
		$text['phone'] = "Telefón";
		$text['username'] = "Pou¾ívateµské meno";
		$text['password'] = "Heslo";
		$text['loginfailed'] = "Chyba prihlásenia.";

		$text['regnewacct'] = "Registrácia nového úètu";
		$text['realname'] = "Va¹e meno a priezvisko";
		$text['phone'] = "Telefón";
		$text['email'] = "Email";
		$text['address'] = "Adresa";
		$text['acctcomments'] = "Poznámky";
		$text['submit'] = "Odosla»";
		$text['leaveblank'] = "(nechajte toto pole prázdne, ak ¾iadate o nový strom)";
		$text['required'] = "Tieto údaje je nutné vyplni»";
		$text['enterpassword'] = "Zadajte heslo.";
		$text['enterusername'] = "Zadajte pou¾ívateµské meno.";
		$text['failure'] = "Zadané pou¾ívateµské meno sa u¾ pou¾íva. Prosím, pou¾ite tlaèidlo Spä» na prehliadaèi na návrat spä» na predchádzajúcu stránku a zadajte iné pou¾ívateµské meno";
		$text['success'] = "Ïakujeme, va¹a registrácia prebehla úspe¹ne. Administrátor systému vás bude informova» kedy vá¹ úèet bude aktívny alebo ak budú potrebné ïal¹ie informácie.";
		$text['emailsubject'] = "®iados» o novú registráciu";
		$text['website'] = "Webová stránka";
		$text['nologin'] = "Nemáte prihlasovacie údaje?";
		$text['loginsent'] = "Prihlasovacie údaje boli odoslané";
		$text['loginnotsent'] = "Prihlasovacie údaje neboli odoslané";
		$text['enterrealname'] = "Zadajte, prosím, svoje skutoèné meno.";
		$text['rempass'] = "Zosta» prihlásený na tomto poèítaèi";
		$text['morestats'] = "Ïal¹ia ¹tatistika";
		$text['accmail'] = "POZNÁMKA: Aby ste mohli prija» email od administrátora ohµadom vá¹ho úètu, skontrolujte, prosím, èi vá¹ emailový program neblokuje emaily z tejto domény.";
		$text['newpassword'] = "Nové heslo";
		$text['resetpass'] = "Obnovi» va¹e heslo";
		$text['nousers'] = "Tento formulár nemo¾no pou¾i», kým nebude vytvorený aspoò jeden záznam pou¾ívateµa. Ak ste majiteµom týchto stránok, choïte do ponuky Administrácia >> Pou¾ívatelia a vytvorte si úèet administrátora.";
		$text['noregs'] = "Je nám µúto, ale v súèasnej dobe neprijímame nové registrácie. Kontaktujte nás, prosím, priamo, ak máte nejaké dotazy èi pripomienky ohµadom týchto webových stránok.";
		$text['emailmsg'] = "Bola vám odoslaná nová ¾iados» o pou¾ívateµský úèet TNG. Prihláste sa, prosím, do administrátorského prostredia a dajte novému úètu patrièné prístupové práva.";
		$text['accactive'] = "Úèet bol aktivovaný, ale pou¾ívateµ nebude ma» ¾iadné zvlá¹tne práva, kým mu ich nepridelíte.";
		$text['accinactive'] = "Nastavenie úètu mô¾ete urobi» v Administrácia >> Pou¾ívatelia >> Hµada». Úèet zostane neaktívny, kým aspoò raz záznam neupravíte a neulo¾íte.";
		$text['pwdagain'] = "Znova heslo";
		$text['enterpassword2'] = "Prosím, vlo¾te znova svoje heslo.";
		$text['pwdsmatch'] = "Va¹e heslo sa nezhoduje. Prosím, zadajte to isté heslo do ka¾dého poµa.";
		$text['acksubject'] = "Ïakujeme za registráciu"; //for a new user account
		$text['ackmessage'] = "Va¹a ¾iados» o pou¾ívateµský úèet bola prijatá. Vá¹ úèet nebude aktívny, kým nebude schválený administrátorom. O výsledku budeme vás informova» emailom.";
		//added in 12.0.0
		$text['switch'] = "Prepnú»";
		//added in 14.0
		$text['newpassword2'] = "E¹te raz nové heslo";
		$text['resetsuccess'] = "Úspech: Heslo bolo obnovené";
		$text['resetfail'] = "Neúspech: Heslo nebolo obnovené";
		$text['failreason0'] = " (neznáma chyba databázy)";
		$text['failreason2'] = " (nemáte oprávnenie na zmenu vá¹ho hesla)";
		$text['failreason3'] = " (heslá sa nezhodujú)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Prehliada» v¹etky vetvy";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Mno¾stvo";
		$text['totindividuals'] = "Celkom osôb";
		$text['totmales'] = "Celkom mu¾ov";
		$text['totfemales'] = "Celkom ¾ien";
		$text['totunknown'] = "Celkom neurèeného pohlavia";
		$text['totliving'] = "Celkom ¾ijúcich";
		$text['totfamilies'] = "Celkom rodín";
		$text['totuniquesn'] = "Celkom jedineèných priezvisk";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Celkom zdrojov";
		$text['avglifespan'] = "Priemerná då¾ka ¾ivota";
		$text['earliestbirth'] = "Najskôr narodení";
		$text['longestlived'] = "Najdlh¹ie ¾ijúci";
		$text['days'] = "dní";
		$text['age'] = "Vek";
		$text['agedisclaimer'] = "Výpoèty spojené s vekom sa zakladajú na údajoch osôb, ktoré majú zadaný dátum narodenia <EM>a</EM> dátum úmrtia.  Keï¾e niektoré údaje sú neúplné (napr. pri úmrtí je zadaný len rok \"1945\" alebo \"pred 1860\"), tieto výpoèty nemusia by» 100% presné.";
		$text['treedetail'] = "Ïal¹ie informácie o tomto strome";
		$text['total'] = "Celkom";
		//added in 12.0
		$text['totdeceased'] = "Celkom zosnulých";
		//added in 14.0
		$text['totalsourcecitations'] = "Celkový poèet citácií zdroja";
		break;

	case "notes":
		$text['browseallnotes'] = "Prehliada» v¹etky poznámky";
		break;

	case "help":
		$text['menuhelp'] = "Pomocník ponuky";
		break;

	case "install":
		$text['perms'] = "V¹etky povolenia boli nastavené.";
		$text['noperms'] = "Povolenia nemohli by» nastavené pre tieto súbory:";
		$text['manual'] = "Nastavte ich, prosím, manuálne.";
		$text['folder'] = "Prieèinok";
		$text['created'] = "bol vytvorený";
		$text['nocreate'] = "nemohol by» vytvorený. Vytvorte ho, prosím, manuálne.";
		$text['infosaved'] = "Informácie sú ulo¾ené, spojenie overené!";
		$text['tablescr'] = "Tabuµky boli vytvorené!";
		$text['notables'] = "Nasledujúce tabuµky nemohli by» vytvorené:";
		$text['nocomm'] = "TNG nemô¾e nadviaza» komunikáciu s va¹ou databázou. ®iadne tabuµky neboli vytvorené.";
		$text['newdb'] = "Informácie ulo¾ené, spojenie overené, bola vytvorená nová databáza:";
		$text['noattach'] = "Informácie ulo¾ené. Spojenie nadviazané a databáza vytvorená, ale TNG sa nemô¾e k nej pripoji».";
		$text['nodb'] = "Informácie ulo¾ené. Spojenie nadviazané, ale databáza neexistuje a nemohla by» vytvorená. Overte si, èi názov databázy je správny alebo pou¾ijte ovládací panel a vytvorte ju.";
		$text['noconn'] = "Informácie ulo¾ené, ale spojenie nebolo nadviazané.  Niektoré z následujúch vecí sú chybné:";
		$text['exists'] = "u¾ existuje";
		$text['noop'] = "Nevykonala sa ¾iadna operácia.";
		//added in 8.0.0
		$text['nouser'] = "Úèet nebol vytvorený. Pou¾ívateµské meno asi u¾ existuje.";
		$text['notree'] = "Strom nebol vytvorený. ID èíslo stromu asi u¾ existuje.";
		$text['infosaved2'] = "Informácia ulo¾ená";
		$text['renamedto'] = "premenovaný na";
		$text['norename'] = "nemohol by» premenovaný";
		//changed in 13.0.0
		$text['loginfirst'] = "Najskôr sa musíte prihlási».";
		break;

	case "imgviewer":
		$text['magmode'] = "Re¾im zväè¹ovania";
		$text['panmode'] = "Re¾im sledovania";
		$text['pan'] = "Ak obrázok je väè¹í ako okno prehliadaèa, po obrázku sa presúvate kliknutím a »ahaním my¹ou.";
		$text['fitwidth'] = "Na celú ¹írku";
		$text['fitheight'] = "Na celú vý¹ku";
		$text['newwin'] = "Nové okno";
		$text['opennw'] = "Otvori» obrázok v novom okne";
		$text['magnifyreg'] = "Kliknutím my¹ou do obrázka zväè¹íte túto èas» obrázka";
		$text['imgctrls'] = "Zapnú» ovládacie prvky obrázka";
		$text['vwrctrls'] = "Zapnú» ovládacie prvky prehliadaèa obrázkov";
		$text['vwrclose'] = "Zavrie» prehliadaè obrázkov";
		break;

	case "dna":
		$text['test_date'] = "Dátum testu";
		$text['links'] = "Príslu¹né odkazy";
		$text['testid'] = "ID testu";
		//added in 12.0.0
		$text['mode_values'] = "Hodnoty modu";
		$text['compareselected'] = "Porovna» vybrané";
		$text['dnatestscompare'] = "Porovna» Y-DNA testy";
		$text['keep_name_private'] = "Dr¾a» meno ako neverejné";
		$text['browsealltests'] = "Prehµadáva» v¹etky testy";
		$text['all_dna_tests'] = "V¹etky DNA testy";
		$text['fastmutating'] = "Rýchle mutácie";
		$text['alltypes'] = "V¹etky typy";
		$text['allgroups'] = "V¹etky skupiny";
		$text['Ydna_LITbox_info'] = "Testy spojené s touto osobou nemuseli by» nutne absolvované touto osobou.<br />V ståpci 'Haploskupina' sa zobrazia údaje èervenou farbou, ak výsledok je 'Predpovedaný', alebo zelenou farbou, ak test je 'Potvrdený'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Porovna» vybrané testy mtDNA";
		$text['dnatestscompare_atdna'] = "Porovna» vybrané testy atDNA";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNP";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Zvlá¹tne mutácie";
		$text['mrca'] = "Najbli¾¹í spoloèný predok";
		$text['ydna_test'] = "Testy Y-DNA";
		$text['mtdna_test'] = "Testy mtDNA (mitochondriálne)";
		$text['atdna_test'] = "Testy atDNA (autozomálne)";
		$text['segment_start'] = "Zaèiatok";
		$text['segment_end'] = "Koniec";
		$text['suggested_relationship'] = "Navrhnuté";
		$text['actual_relationship'] = "Aktuálne";
		$text['12markers'] = "Markery 1-12";
		$text['25markers'] = "Markery 13-25";
		$text['37markers'] = "Markery 26-37";
		$text['67markers'] = "Markery 38-67";
		$text['111markers'] = "Markery 68-111";
		//added in 13.1
		$text['comparemore'] = "Na porovnanie je potrebné vybra» aspoò dva testy.";
		break;
}

//common
$text['matches'] = "Záznamy";
$text['description'] = "Popis";
$text['notes'] = "Poznámky";
$text['status'] = "Stav";
$text['newsearch'] = "Nové hµadanie";
$text['pedigree'] = "Rodokmeò";
$text['seephoto'] = "Pozrie» fotografiu";
$text['andlocation'] = "&amp; miesto";
$text['accessedby'] = "sprístupnil";
$text['children'] = "Deti";  //from getperson
$text['tree'] = "Strom";
$text['alltrees'] = "V¹etky stromy";
$text['nosurname'] = "[bez priezviska]";
$text['thumb'] = "Miniatúra";  //as in Thumbnail
$text['people'] = "¥udia";
$text['title'] = "Titul";  //from getperson
$text['suffix'] = "Prípona";  //from getperson
$text['nickname'] = "Prezývka";  //from getperson
$text['lastmodified'] = "Posledná zmena";  //from getperson
$text['married'] = "Sobá¹";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Meno"; //from showmap
$text['lastfirst'] = "Priezvisko, meno";  //from search
$text['bornchr'] = "Narod./krst";  //from search
$text['individuals'] = "Osoby";  //from whats new
$text['families'] = "Rodiny";
$text['personid'] = "ID èíslo osoby";
$text['sources'] = "Zdroje";  //from getperson (next several)
$text['unknown'] = "Neznáme";
$text['father'] = "Otec";
$text['mother'] = "Matka";
$text['christened'] = "Krstenie";
$text['died'] = "Úmrtie";
$text['buried'] = "Pohreb";
$text['spouse'] = "Partner";  //from search
$text['parents'] = "Rodièia";  //from pedigree
$text['text'] = "Text";  //from sources
$text['language'] = "Jazyk";  //from languages
$text['descendchart'] = "Schéma potomkov";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Osoba";
$text['edit'] = "Upravi»";
$text['date'] = "Dátum";
$text['login'] = "Prihlásenie";
$text['logout'] = "Odhlásenie";
$text['groupsheet'] = "Hárok rodiny";
$text['text_and'] = "a";
$text['generation'] = "Generácia";
$text['filename'] = "Názov súboru";
$text['id'] = "ID èíslo";
$text['search'] = "Hµada»";
$text['user'] = "Pou¾ívateµ";
$text['firstname'] = "Meno";
$text['lastname'] = "Priezvisko";
$text['searchresults'] = "Výsledky hµadania";
$text['diedburied'] = "Úmrtie/Pohreb";
$text['homepage'] = "Domovská stránka";
$text['find'] = "Nájs» (osobu)";
$text['relationship'] = "Príbuz. vz»ah";		//in German, Verwandtschaft
$text['relationship2'] = "Vz»ah"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Èasová línia";
$text['yesabbr'] = "Á";               //abbreviation for 'yes'
$text['divorced'] = "Rozvod";
$text['indlinked'] = "Spojené s";
$text['branch'] = "Vetva";
$text['moreind'] = "Ïal¹ie osoby";
$text['morefam'] = "Ïal¹ie rodiny";
$text['surnamelist'] = "Zoznam priezvisk";
$text['generations'] = "Generácie";
$text['refresh'] = "Obnovi»";
$text['whatsnew'] = "Èo je nové";
$text['reports'] = "Zostavy";
$text['placelist'] = "Zoznam miest";
$text['baptizedlds'] = "Krstenie (CJKSpd)";
$text['endowedlds'] = "Obdarovanie (CJKSpd)";
$text['sealedplds'] = "Peèatenie R (CJKSpd)";
$text['sealedslds'] = "Peèatenie P (CJKSpd)";
$text['ancestors'] = "Predkovia";
$text['descendants'] = "Potomkovia";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Dátum posledného importu súboru GEDCOM";
$text['type'] = "Druh";
$text['savechanges'] = "Ulo¾i» zmeny";
$text['familyid'] = "ID èíslo rodiny";
$text['headstone'] = "Náhrobky";
$text['historiesdocs'] = "Historky";
$text['anonymous'] = "anonymné";
$text['places'] = "Miesta";
$text['anniversaries'] = "Dátumy a výroèia";
$text['administration'] = "Administrácia";
$text['help'] = "Pomocník";
//$text['documents'] = "Documents";
$text['year'] = "Rok";
$text['all'] = "V¹etko";
$text['address'] = "Adresa";
$text['suggest'] = "Navrhnú»";
$text['editevent'] = "Navrhnú» zmenu pre túto udalos»";
$text['morelinks'] = "Viac odkazov";
$text['faminfo'] = "Informácie o rodine";
$text['persinfo'] = "Osobné informácie";
$text['srcinfo'] = "Informácie o zdroji";
$text['fact'] = "Fakt";
$text['goto'] = "Vyberte stránku";
$text['tngprint'] = "Tlaè";
$text['databasestatistics'] = "©tatistika databázy"; //needed to be shorter to fit on menu
$text['child'] = "Die»a";  //from familygroup
$text['repoinfo'] = "Údaje o archíve";
$text['tng_reset'] = "Obnovi»";
$text['noresults'] = "Neboli nájdené ¾iadne výsledky";
$text['allmedia'] = "V¹etky médiá";
$text['repositories'] = "Archívy";
$text['albums'] = "Albumy";
$text['cemeteries'] = "Cintoríny";
$text['surnames'] = "Priezviská";
$text['dates'] = "Dátumy";
$text['link'] = "Odkaz";
$text['media'] = "Médiá";
$text['gender'] = "Pohlavie";
$text['latitude'] = "Zem. ¹írka";
$text['longitude'] = "Zem. då¾ka";
$text['bookmarks'] = "Zálo¾ky";
$text['bookmark'] = "Zálo¾ka";
$text['mngbookmarks'] = "Prejs» na zálo¾ky";
$text['bookmarked'] = "Zálo¾ka pridaná";
$text['remove'] = "Odstráni»";
$text['find_menu'] = "Nájs»";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cintorín";
$text['gmapevent'] = "Mapa udalostí";
$text['gevents'] = "Udalos»";
$text['googleearthlink'] = "Odkaz na Google Earth";
$text['googlemaplink'] = "Odkaz na Google Maps";
$text['gmaplegend'] = "Pripnú» legendu";
$text['unmarked'] = "Neoznaèené";
$text['located'] = "Lokalizované";
$text['albclicksee'] = "Kliknite na zobrazenie v¹etkých polo¾iek v tomto albume";
$text['notyetlocated'] = "E¹te nelokalizované";
$text['cremated'] = "Spopolnený(á)";
$text['missing'] = "Chýbajúci";
$text['pdfgen'] = "Generátor PDF";
$text['blank'] = "Prázdna";
$text['fonts'] = "Fonty";
$text['header'] = "Hlavièka";
$text['data'] = "Dáta";
$text['pgsetup'] = "Nastavenie stránky";
$text['pgsize'] = "Veµkos» stránky";
$text['orient'] = "Orientácia"; //for a page
$text['portrait'] = "Na vý¹ku";
$text['landscape'] = "Na ¹írku";
$text['tmargin'] = "Horný okraj";
$text['bmargin'] = "Spodný okraj";
$text['lmargin'] = "¥avý okraj";
$text['rmargin'] = "Pravý okraj";
$text['createch'] = "Vytvori»";
$text['prefix'] = "Predpona";
$text['mostwanted'] = "Hµadá sa";
$text['latupdates'] = "Najnov¹ie aktualizácie";
$text['featphoto'] = "Hlavná fotografia";
$text['news'] = "Novinky";
$text['ourhist'] = "História na¹ej rodiny";
$text['ourhistanc'] = "História a predkovia na¹ej rodiny";
$text['ourpages'] = "Genealogické stránky na¹ej rodiny";
$text['pwrdby'] = "Tieto stránky be¾ia na";
$text['writby'] = "vytvoril";
$text['searchtngnet'] = "Prehliada» TNG sie» (GENDEX)";
$text['viewphotos'] = "Prezrie» v¹etky fotografie";
$text['anon'] = "Momentálne ste anonymný";
$text['whichbranch'] = "Z ktorej vetvy ste?";
$text['featarts'] = "Najzaujímavej¹ie èlánky";
$text['maintby'] = "Systém spravuje";
$text['createdon'] = "Vytvorené";
$text['reliability'] = "Vierohodnos»";
$text['labels'] = "Návestia";
$text['inclsrcs'] = "Zahrnú» zdroje";
$text['cont'] = "(pokraè.)"; //abbreviation for continued
$text['mnuheader'] = "Domovská stránka";
$text['mnusearchfornames'] = "Hµada»";
$text['mnulastname'] = "Priezvisko";
$text['mnufirstname'] = "Meno";
$text['mnusearch'] = "Hµada»";
$text['mnureset'] = "Zaèa» znova";
$text['mnulogon'] = "Prihlásenie";
$text['mnulogout'] = "Odhlásenie";
$text['mnufeatures'] = "Ïal¹ie mo¾nosti";
$text['mnuregister'] = "Registrácia úètu pou¾ívateµa";
$text['mnuadvancedsearch'] = "Roz¹írené hµadanie";
$text['mnulastnames'] = "Priezviská";
$text['mnustatistics'] = "©tatistika";
$text['mnuphotos'] = "Fotografie";
$text['mnuhistories'] = "Historky";
$text['mnumyancestors'] = "Fotografie &amp; Historky o predkoch od [Person]";
$text['mnucemeteries'] = "Cintoríny";
$text['mnutombstones'] = "Náhrobky";
$text['mnureports'] = "Zostavy";
$text['mnusources'] = "Zdroje";
$text['mnuwhatsnew'] = "Èo je nové";
$text['mnushowlog'] = "Protokol prístupov";
$text['mnulanguage'] = "Zmena jazyka";
$text['mnuadmin'] = "Administrácia";
$text['welcome'] = "Vitajte";
$text['contactus'] = "Napí¹te nám";
//changed in 8.0.0
$text['born'] = "Narodenie";
$text['searchnames'] = "Hµada» osoby";
//added in 8.0.0
$text['editperson'] = "Upravi» osobu";
$text['loadmap'] = "Zavies» mapu";
$text['birth'] = "Narodenie";
$text['wasborn'] = "sa narodil(a)";
$text['startnum'] = "Prvé èíslo";
$text['searching'] = "Hµadam";
//moved here in 8.0.0
$text['location'] = "Miesto";
$text['association'] = "Spojenie";
$text['collapse'] = "Zbali»";
$text['expand'] = "Rozbali»";
$text['plot'] = "Zaznaèi»";
$text['searchfams'] = "Hµada» rodiny";
//added in 8.0.2
$text['wasmarried'] = "sobá¹. s";
$text['anddied'] = "zomrel(a)";
//added in 9.0.0
$text['share'] = "Zdieµa»";
$text['hide'] = "Skry»";
$text['disabled'] = "Vá¹ pou¾ívateµský úèet bol zablokovaný.  Kontaktujte, prosím, administrátora týchto webových stránok.";
$text['contactus_long'] = "Ak máte nejaké otázky alebo pripomienky ohµadom informácií na týchto stránkach alebo by ste mali záujem spolupracova» na ïal¹om výskume, prípadne poskytnú» ïal¹ie informácie, neváhajte a <span class=\"emphasis\"><a href=\"suggest.php\">kontaktujte ma</a></span>.";
$text['features'] = "Zaujímavosti";
$text['resources'] = "Prostriedky";
$text['latestnews'] = "Posledné novinky";
$text['trees'] = "Stromy";
$text['wasburied'] = "pochov.:";
//moved here in 9.0.0
$text['emailagain'] = "Email znova";
$text['enteremail2'] = "Zadajte, prosím, znova va¹u emailovú adresu.";
$text['emailsmatch'] = "Zadané emailové adresy nie sú rovnaké. Zadajte rovnakú emailovú adresu do obidvoch polí.";
$text['getdirections'] = "Kliknite na získanie podrobností";
$text['calendar'] = "Kalendár";
//changed in 9.0.0
$text['directionsto'] = " k ";
$text['slidestart'] = "Prezentácia";
$text['livingnote'] = "S touto poznámkou je spojená aspoò jedna ¾ijúca alebo neverejná osoba - podrobnosti nie sú zverejnené.";
$text['livingphoto'] = "S touto polo¾kou je spojená aspoò jedna ¾ijúca alebo neverejná osoba - podrobnosti nie sú zverejnené.";
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
$text['searchsite'] = "Hµada» v tomto webovom sídle";
$text['searchsitemenu'] = "Hµadanie";
$text['kmlfile'] = "Stiahnite súbor .kml na zobrazenie tejto lokality v Google Earth";
$text['download'] = "Kliknite na stiahnutie";
$text['more'] = "Viac";
$text['heatmap'] = "Zobrazi» mapu";
$text['refreshmap'] = "Obnovi» mapu";
$text['remnums'] = "Vymaza» èísla a  ¹pendlíky";
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
$text['relevant_links'] = "Dôle¾ité spojenia";
$text['nofirstname'] = "[¾iadne krstné meno]";
//added in 12.0.1
$text['cookieuse'] = "V¹imnite si, ¾e toto webové sídlo pou¾íva cookies.";
$text['dataprotect'] = "Zásady ochrany údajov";
$text['viewpolicy'] = "Pozrie» zásady";
$text['understand'] = "Rozumiem";
$text['consent'] = "Dávam svoj súhlas pre toto webové sídlo na uchovávanie tu nazbieraných osobných informácií. Viem, ¾e hocikedy mô¾em po¾iada» vlastníka tohto sídla na odstránenie týchto informácií.";
$text['consentreq'] = "Prosím, dajte svoj súhlas pre toto webové sídlo na ukladanie osobných informácií.";

//added in 12.1.0
$text['testsarelinked'] = "DNA testy sú zdru¾ené s";
$text['testislinked'] = "DNA test je zdru¾ený s";

//added in 12.2
$text['quicklinks'] = "Rýchle odkazy";
$text['yourname'] = "Va¹e meno";
$text['youremail'] = "Va¹a emailová adresa";
$text['liketoadd'] = "Akékoµvek informácie, ktoré chcete prida»";
$text['webmastermsg'] = "Správa správcu webu";
$text['gallery'] = "Zobrazi» galériu";
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
$text['wasmarried_male'] = "bol sobá¹ený s";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "bola sobá¹ená s";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "bol rozvedený";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "bola rozvedená";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " v ";			// used as a preposition to the location
$text['onthisdate'] = " dòa ";		// when used with full date
$text['inthisyear'] = " v ";		// when used with year only or month / year dates
$text['and'] = "a ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Informácia o teste DNA";
//added in 13.0
$text['visitor'] = "Náv¹tevník";

$text['popupnote2'] = " = Nový rodokmeò";

//moved here in 14.0
$text['zoomin'] = "Priblí¾i»";
$text['zoomout'] = "Oddiali»";
$text['scrollnote'] = "Poznámka: Na zobrazenie diagramu mô¾ete pou¾i» posuvník dole alebo doprava.";
$text['general'] = "V¹eobecne";

//changed in 14.0
$text['otherevents'] = "Iné udalosti";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Spojenia";
$text['continue'] = "Pokraèova»";
$text['title2'] = "Názov"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>