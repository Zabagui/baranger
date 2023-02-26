<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Prohlédnout všechny prameny";
		$text['shorttitle'] = "Krátký název";
		$text['callnum'] = "Archivní číslo";
		$text['author'] = "Autor";
		$text['publisher'] = "Vydavatel";
		$text['other'] = "Další informace";
		$text['sourceid'] = "ID číslo pramenu";
		$text['moresrc'] = "Další prameny";
		$text['repoid'] = "ID číslo úložiště";
		$text['browseallrepos'] = "Prohlédnout všechny úložiště";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nový jazyk";
		$text['changelanguage'] = "Změna jazyka";
		$text['languagesaved'] = "Jazyk uložen";
		$text['sitemaint'] = "Právě probíhá údržba webových stránek";
		$text['standby'] = "Webové stránky jsou dočasně nedostupné, protože probíhá aktualizace databáze. Zkuste to, prosím, znovu za pár minut. Pokud budou stránky nedostupné delší dobu, kontaktujte majitele těchto stránek.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM začínající od";
		$text['producegedfrom'] = "Vytvořit GEDCOM soubor pro";
		$text['numgens'] = "Počet generací";
		$text['includelds'] = "Včetně údajů CJKSpd";
		$text['buildged'] = "Vytvoř GEDCOM";
		$text['gedstartfrom'] = "GEDCOM začínající od";
		$text['nomaxgen'] = "Musíte zadat maximální počet generací. Použijte tlačítko Zpět k návratu na předchozí stránku a chybu opravte.";
		$text['gedcreatedfrom'] = "GEDCOM vytvořen od";
		$text['gedcreatedfor'] = "vytvořen pro";
		$text['creategedfor'] = "Vytvořit GEDCOM";
		$text['email'] = "Email";
		$text['suggestchange'] = "Navrhnout změnu";
		$text['yourname'] = "Vaše jméno";
		$text['comments'] = "Poznámky";
		$text['comments2'] = "Komentář";
		$text['submitsugg'] = "Poslat návrh";
		$text['proposed'] = "Navrhovaná změna";
		$text['mailsent'] = "Děkujeme. Vaše zpráva byla odeslána.";
		$text['mailnotsent'] = "Bohužel, vaše zpráva nemohla být doručena. Kontaktujte prosím xxx přímo na yyy.";
		$text['mailme'] = "Zaslat kopii na tuto adresu";
		$text['entername'] = "Zadejte, prosím, vaše jméno";
		$text['entercomments'] = "Zadejte, prosím, vaše připomínky";
		$text['sendmsg'] = "Poslat zprávu";
		//added in 9.0.0
		$text['subject'] = "Předmět";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografie a vyprávění pro";
		$text['indinfofor'] = "Osobní informace o";
		$text['pp'] = "str."; //page abbreviation
		$text['age'] = "Věk";
		$text['agency'] = "Instituce";
		$text['cause'] = "Příčina";
		$text['suggested'] = "Navržené";
		$text['closewindow'] = "Zavřít okno";
		$text['thanks'] = "Děkujeme";
		$text['received'] = "Váš návrh byl zaslán administrátorovi těchto stránek k posouzení.";
		$text['indreport'] = "Report osoby";
		$text['indreportfor'] = "Report osoby";
		$text['bkmkvis'] = "Pozn.: Tyto záložky jsou viditelné pouze na tomto počítači a v tomto prohlížeči.";
        //added in 9.0.0
		$text['reviewmsg'] = "Máte doporučenou změnu, která vyžaduje vaše posouzení. Tato změna se týká:";
        $text['revsubject'] = "Doporučená změna vyžaduje vaše posouzení";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Určení příbuzenského vztahu";
		$text['findrel'] = "Určení příbuzenského vztahu";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "Kalkulovat";
		$text['select2inds'] = "Zvolte dvě osoby.";
		$text['findpersonid'] = "Najít ID číslo osoby";
		$text['enternamepart'] = "zadejte část jména nebo příjmení";
		$text['pleasenamepart'] = "Zadejte, prosím, část jména nebo příjmení.";
		$text['clicktoselect'] = "kliknutím vyberte osobu";
		$text['nobirthinfo'] = "Chybí informace o narození";
		$text['relateto'] = "Příbuzenský vztah k: ";
		$text['sameperson'] = "Tyto dvě osoby jsou totožné";
		$text['notrelated'] = "Tyto dvě osoby nemají žádný příbuzenský vztah v posledních xxx generacích"; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Pro zobrazení příbuzenského vztahu mezi dvěma osobami nejprve klikněte na 'Najít', abyste našli příslušné osoby (nebo zanechte osoby, které jsou zobrazené), poté klikněte na 'Kalkulovat'.<br>(české výrazy v některých složitějších případech díky jiné struktuře názvosloví příbuzenských vztahů v anglickém jazyce a z toho pramenícího obtížného překladu nemusí být správné).";
		$text['sometimes'] = "(Použití jiného počtu generací může mít někdy jiný výsledek.)";
		$text['findanother'] = "Zjistit jiný příbuzenský vztah";
		$text['brother'] = "bratr od";
		$text['sister'] = "sestra od";
		$text['sibling'] = "sourozenec od";
		$text['uncle'] = " xxx strýc od";
		$text['aunt'] = " xxx teta od";
		$text['uncleaunt'] = " xxx strýc/teta od";
		$text['nephew'] = " xxx synovec od";
		$text['niece'] = " xxx neteř od";
		$text['nephnc'] = "xxx synovec/neteř od";
		$text['removed'] = "generace";
		$text['rhusband'] = "manžel od";
		$text['rwife'] = "manželka od";
		$text['rspouse'] = "partner od";
		$text['son'] = "syn od";
		$text['daughter'] = "dcera od";
		$text['rchild'] = "dítě od";
		$text['sil'] = "zeť od";
		$text['dil'] = "snacha od";
		$text['sdil'] = "zeť nebo snacha od";
		$text['gson'] = " xxx vnuk od";
		$text['gdau'] = " xxx vnučka od";
		$text['gsondau'] = "xxx vnuk/vnučka od";
		$text['great'] = "pra";
		$text['spouses'] = "jsou manželé";
		$text['is'] = "je";
		$text['changeto'] = "Změnit na:";
		$text['notvalid'] = "není platné ID číslo osoby nebo neexistuje v této databázi. Zkuste to prosím znovu.";
		$text['halfbrother'] = "nevlastní bratr od";
		$text['halfsister'] = "nevlastní sestra od";
		$text['halfsibling'] = "nevlastní sourozenec od";
		//changed in 8.0.0
		$text['gencheck'] = "Maximální počet kontrolovaných generací";
		$text['mcousin'] = "xxx bratranec yyy od";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx sestřenice yyy od";  //female cousin
		$text['cousin'] = " xxx bratranec yyy od";
		$text['mhalfcousin'] = "poloviční xxx bratranec yyy od";  //male cousin
		$text['fhalfcousin'] = "poloviční xxx sestřenice yyy od";  //female cousin
		$text['halfcousin'] = "poloviční xxx bratranec/sestřenice yyy od";
		//added in 8.0.0
		$text['oneremoved'] = "o jednu generaci";
		$text['gfath'] = "xxx dědeček od";
		$text['gmoth'] = "xxx babička od";
		$text['gpar'] = "xxx prarodiče od";
		$text['mothof'] = "matka od";
		$text['fathof'] = "otec od ";
		$text['parof'] = "rodiče od";
		$text['maxrels'] = "Maximální počet vztahů k zobrazení";
		$text['dospouses'] = "Zobrazit vztahy včetně manželů";
		$text['rels'] = "Příbuzenské vztahy";
		$text['dospouses2'] = "Zobrazit partnery";
		$text['fil'] = "tchán od";
		$text['mil'] = "tchyně od";
		$text['fmil'] = "tchán nebo tchyně od";
		$text['stepson'] = "nevlastní syn od";
		$text['stepdau'] = "nevlastní dcera od";
		$text['stepchild'] = "nevlastní dítě od";
		$text['stepgson'] = "xxx nevlastní vnuk od";
		$text['stepgdau'] = "xxx nevlastní vnučka od";
		$text['stepgchild'] = "xxx nevlastní vnouče od";
		//added in 8.1.1
		$text['ggreat'] = "pra";
		//added in 8.1.2
		$text['ggfath'] = " xxx pradědeček od";
		$text['ggmoth'] = " xxx prababička od";
		$text['ggpar'] = " xxx prarodič od";
		$text['ggson'] = " xxx pravnuk od";
		$text['ggdau'] = " xxx pravnučka od";
		$text['ggsondau'] = " xxx pradítě od";
		$text['gstepgson'] = "nevlastní xxx pravnuk od";
		$text['gstepgdau'] = "nevlastní xxx pravnučka od";
		$text['gstepgchild'] = "nevlastní xxx prapradítě od";
		$text['guncle'] = " xxx prastrýc od";
		$text['gaunt'] = " xxx prateta od";
		$text['guncleaunt'] = " xxx prastrýc/prateta od";
		$text['gnephew'] = " xxx prasynovec od";
		$text['gniece'] = " xxx praneteř od";
		$text['gnephnc'] = " xxx prasynovec/praneteř od";
		//added in 14.0
		$text['pathscalc'] = "Hledat spojení";
		$text['findrel2'] = "Určení příbuzenského vztahu";
		$text['makeme2nd'] = "Použít moje ID";
		$text['usebookmarks'] = "Použít záložky";
		$text['select2inds'] = "Zvolte dvě osoby.";
		$text['indinfofor'] = "Osobní informace o";
		$text['nobookmarks'] = "Nelze použít žádnou záložku";
		$text['bkmtitle'] = "Osoby nalezené v záložkách";
		$text['bkminfo'] = "Vybrat osobu:";
		$text['sortpathsby'] = "Seřadit cesty podle počtu";
		$text['sortbyshort'] = "Seřadit podle";
		$text['bylengthshort'] = "Délka";
		$text['badID1'] = ": špatné ID osoby1 – vraťte se prosím zpět a opravte";
		$text['badID2'] = ": špatné ID osoby2 – vraťte se prosím zpět a opravte";
		$text['notintree'] = ": osoba s tímto ID není v aktuální stromové databázi.";
		$text['sameperson'] = "Tyto dvě osoby jsou totožné";;
		$text['nopaths'] = "Tyto osoby nejsou spojeny.";
		$text['nopaths1'] = "Žádná další připojení kratší než xxx";
		$text['nopaths2'] = "v xxx krocích vyhledávání";
		$text['longestpath'] = "(nejdelší dosud kontrolovaná cesta byla dlouhá xxx kroků)";
		$text['relevantpaths'] = "Počet nalezených různých relevantních cest: xxx";
		$text['skipMarr'] = "(navíc počet cest nalezených, ale nezobrazených kvůli příliš velkému počtu sňatků byl: xxx)";
		$text['mjaor'] = "nebo";
		$text['connectionsto'] = "Spojení k osobě ";
		$text['findanotherpers'] = "Najít jinou osobu...";
		$text['sometimes'] = "(Použití jiného počtu generací může mít někdy jiný výsledek.)";
		$text['anotherpath'] = "Hledat další spojení";
		$text['xpath'] = "Cesta ";
		$text['primary'] = "Výchozí osoba"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Cílová osoba";
		$text['parent'] = "Rodič";
		$text['mhfather'] = "jeho otec";
		$text['mhmother'] = "jeho matka";
		$text['mhhusband'] = "jeho manžel";
		$text['mhwife'] = "jeho manželka";
		$text['mhson'] = "jeho syn";
		$text['mhdaughter'] = "jeho dcera";
		$text['fhfather'] = "její otec";
		$text['fhmother'] = "její matka";
		$text['fhhusband'] = "její manžel";
		$text['fhwife'] = "její manželka";
		$text['fhson'] = "její syn";
		$text['fhdaughter'] = "její dcera";
		$text['hfather'] = "otec";
		$text['hmother'] = "matka";
		$text['hhusband'] = "manžel";
		$text['hwife'] = "manželka";
		$text['hson'] = "syn";
		$text['hdaughter'] = "dcera";
		$text['maxruns'] = "Maximální počet cest, který má být zkontrolován";
		$text['maxrshort'] = "Max cesty";
		$text['maxlength'] = "Spojovací cesty ne delší než";
		$text['maxlshort'] = "Max délka";
		$text['xstep'] = "krok";
		$text['xsteps'] = "kroky";
		$text['xmarriages'] = "xxx manželství";
		$text['xmarriage'] = "1 manželství";
		$text['showspouses'] = "Zobrazit oba partnery";
		$text['showTxt'] = "Zobrazit textový popis cesty";
		$text['showTxtshort'] = "Textový popis";
		$text['compactBox'] = "Zobrazit rámečky osob v kompaktní podobě";
		$text['compactBoxshort'] = "Kompaktní rámečky";
		$text['paths'] = "Cesty";
		$text['dospouses2'] = "Zobrazit partnery";
		$text['maxmopt'] = "Maximální počet manželství na spojení";
		$text['maxm'] = "Maximální počet manželství";
		$text['arerelated'] = "Tyto osoby jsou příbuzní – jejich vztah je znázorněn na cestě 1";
		$text['simplerel'] = "Hledat jednoduchý vztah";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Report rodiny";
		$text['ldsords'] = "Obřady CJKSpd";
		$text['endowedlds'] = "Obdarován (CJKSpd)";
		$text['sealedplds'] = "Pečetěn R (CJKSpd)";
		$text['sealedslds'] = "Pečetěn P (CJKSpd)";
		$text['otherspouse'] = "Další partner";
		$text['husband'] = "Manžel";
		$text['wife'] = "Manželka";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "Nar.";
		$text['capaltbirthabbr'] = "Nar.";
		$text['capdeathabbr'] = "Zemř.";
		$text['capburialabbr'] = "Pohř.";
		$text['capplaceabbr'] = "v";
		$text['capmarrabbr'] = "Sň.";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Zobrazit s";
		$text['unknownlit'] = "Neznámý";
		$text['popupnote1'] = " = Další informace";
		$text['pedcompact'] = "Kompaktně";
		$text['pedstandard'] = "Standardně";
		$text['pedtextonly'] = "Pouze text";
		$text['descendfor'] = "Schéma potomků osoby";
		$text['maxof'] = "Nejvíce";
		$text['gensatonce'] = "generací zobrazených najednou.";
		$text['sonof'] = "syn od";
		$text['daughterof'] = "dcera od";
		$text['childof'] = "dítě od";
		$text['stdformat'] = "Standardní formát";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Přidat novou rodinu";
		$text['editfam'] = "Upravit rodinu";
		$text['side'] = "strana";
		$text['familyof'] = "Rodina";
		$text['paternal'] = "Otcova";
		$text['maternal'] = "Matčina";
		$text['gen1'] = "Vlastní";
		$text['gen2'] = "Rodiče";
		$text['gen3'] = "Prarodiče";
		$text['gen4'] = "Praprarodiče";
		$text['gen5'] = "3xprarodiče";
		$text['gen6'] = "4xprarodiče";
		$text['gen7'] = "5xprarodiče";
		$text['gen8'] = "6xprarodiče";
		$text['gen9'] = "7xprarodiče";
		$text['gen10'] = "8xprarodiče";
		$text['gen11'] = "9xprarodiče";
		$text['gen12'] = "10xprarodiče";
		$text['graphdesc'] = "Schéma potomků až do tohoto místa";
		$text['pedbox'] = "Rámeček";
		$text['regformat'] = "Registr";
		$text['extrasexpl'] = "U této osoby existuje fotografie, vyprávění nebo jiná mediální položka.";
		$text['popupnote3'] = " = Nové schéma";
		$text['mediaavail'] = "Média k dispozici";
		$text['pedigreefor'] = "Schéma předků osoby";
		$text['pedigreech'] = "Schéma předků";
		$text['datesloc'] = "Datumy a místa";
		$text['borchr'] = "Naroz/Křest - Úmrtí/Pohř (dva)";
		$text['nobd'] = "Bez dat narození nebo úmrtí";
		$text['bcdb'] = "Naroz/Křest/Úmrtí/Pohř (čtyři)";
		$text['numsys'] = "Systém číslování";
		$text['gennums'] = "Čísla generací";
		$text['henrynums'] = "Číslování dle Henryho";
		$text['abovnums'] = "Číslování dle d'Aboville";
		$text['devnums'] = "Číslování dle de Villiers";
		$text['dispopts'] = "Možnosti zobrazení";
		//added in 10.0.0
		$text['no_ancestors'] = "Nebyli nalezeni žádní předkové";
		$text['ancestor_chart'] = "Svislé schéma předků";
		$text['opennewwindow'] = "Otevřít v novém okně";
		$text['pedvertical'] = "Svisle";
		//added in 11.0.0
		$text['familywith'] = "Rodina s";
		$text['fcmlogin'] = "Pro zobrazení podrobností se musíte přihlásit";
		$text['isthe'] = "je";
		$text['otherspouses'] = "další partneři/partnerky";
		$text['parentfamily'] = "Rodina rodičů ";
		$text['showfamily'] = "Zobrazit rodinu";
		$text['shown'] = "zobrazeno";
		$text['showparentfamily'] = "zobrazit rodinu rodičů";
		$text['showperson'] = "zobrazit osobu";
		//added in 11.0.2
		$text['otherfamilies'] = "Další rodiny";
		//added in 14.0
		$text['dtformat'] = "Tabulky";
		$text['dtchildren'] = "Děti";
		$text['dtgrandchildren'] = "Vnoučata";
		$text['dtggrandchildren'] = "Pravnoučata";
		$text['dtgggrandchildren'] = "Pravnoučata"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Nejsou potomci";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Celkem";
		$text['dtselect'] = "Vybrat";
		$text['dteachfulltable'] = "Každá plná tabulky bude mít";
		$text['dtrows'] = "řádků";
		$text['dtdisplayingtable'] = "Zobrazení tabulky";
		$text['dtgototable'] = "Přejít na tabulku:";
		$text['fcinstrdn'] = "Zobrazit rodinu s partnerem";
		$text['fcinstrup'] = "Zobrazit rodinu s rodiči";
		$text['fcinstrplus'] = "Vybrat další partnery";
		$text['fcinstrfam'] = "Vybrat další rodiče";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Žádný report neexistuje.";
		$text['reportname'] = "Název reportu";
		$text['allreports'] = "Všechny reporty";
		$text['report'] = "Report";
		$text['error'] = "Chyba";
		$text['reportsyntax'] = "Syntaxe dotazu pro tento report";
		$text['wasincorrect'] = "byla chybná a report nemohl být vytvořen. Kontaktujte prosím administrátora systému na";
		$text['errormessage'] = "Chybové hlášení";
		$text['equals'] = "je";
		$text['endswith'] = "končí na";
		$text['soundexof'] = "soundex";
		$text['metaphoneof'] = "metaphone of";
		$text['plusminus10'] = "+/- 10 roků od";
		$text['lessthan'] = "méně než";
		$text['greaterthan'] = "více než";
		$text['lessthanequal'] = "méně nebo rovno";
		$text['greaterthanequal'] = "více nebo rovno";
		$text['equalto'] = "rovno";
		$text['tryagain'] = "Zkusit znovu";
		$text['joinwith'] = "Logika hledání";
		$text['cap_and'] = "A";
		$text['cap_or'] = "NEBO";
		$text['showspouse'] = "Zobrazit partnera (pokud měla dotyčná osoba více partnerů, bude zobrazena vícekrát)";
		$text['submitquery'] = "Provést dotaz";
		$text['birthplace'] = "Místo narození";
		$text['deathplace'] = "Místo úmrtí";
		$text['birthdatetr'] = "Rok narození";
		$text['deathdatetr'] = "Rok úmrtí";
		$text['plusminus2'] = "+/- 2 roky od";
		$text['resetall'] = "Obnovit všechny hodnoty na výchozí";
		$text['showdeath'] = "Zobrazit informace o úmrtí/pohřbu";
		$text['altbirthplace'] = "Místo křtu";
		$text['altbirthdatetr'] = "Rok křtu";
		$text['burialplace'] = "Místo pohřbu";
		$text['burialdatetr'] = "Rok pohřbu";
		$text['event'] = "Událost(i)";
		$text['day'] = "Den";
		$text['month'] = "Měsíc";
		$text['keyword'] = "Klíčové slovo (např. \"Abt\")";
		$text['explain'] = "Pro zobrazení odpovídajících událostí zadejte datum. Pro zobrazení všech událostí zanechte pole prázdné.";
		$text['enterdate'] = "Zadejte nebo zvolte alespoň jedno z následujících: Den, Měsíc, Rok, Klíčové slovo";
		$text['fullname'] = "Celé jméno";
		$text['birthdate'] = "Datum narození";
		$text['altbirthdate'] = "Datum křtu";
		$text['marrdate'] = "Datum sňatku";
		$text['spouseid'] = "ID číslo partnera";
		$text['spousename'] = "Jméno partnera";
		$text['deathdate'] = "Datum úmrtí";
		$text['burialdate'] = "Datum pohřbu";
		$text['changedate'] = "Datum poslední změny";
		$text['gedcom'] = "Strom";
		$text['baptdate'] = "CJKSpd datum křtu";
		$text['baptplace'] = "CJKSpd místo křtu";
		$text['endldate'] = "CJKSpd datum zaslíbení";
		$text['endlplace'] = "CJKSpd místo zaslíbení";
		$text['ssealdate'] = "CJKSpd datum pečetění s partnerem";   //Sealed to spouse
		$text['ssealplace'] = "CJKSpd místo pečetění s partnerem";
		$text['psealdate'] = "CJKSpd datum pečetění s rodiči";   //Sealed to parents
		$text['psealplace'] = "CJKSpd místo pečetění s rodiči";
		$text['marrplace'] = "Místo sňatku";
		$text['spousesurname'] = "Příjmení partnera";
		$text['spousemore'] = "Zapíšete-li příjmení partnera, musíte vybrat Pohlaví.";
		$text['plusminus5'] = "+/- 5 roku od";
		$text['exists'] = "existuje";
		$text['dnexist'] = "neexistuje";
		$text['divdate'] = "Datum rozvodu";
		$text['divplace'] = "Místo rozvodu";
		$text['otherevents'] = "Jiné události";
		$text['numresults'] = "Počet výsledků na stránce";
		$text['mysphoto'] = "Tajemné fotografie";
		$text['mysperson'] = "Hledané osoby";
		$text['joinor'] = "'Join with OR' možnost nelze použít s příjmením partnera";
		$text['tellus'] = "Máte-li nějaké informace, napište nám";
		$text['moreinfo'] = "Více informací";
		//added in 8.0.0
		$text['marrdatetr'] = "Rok sňatku";
		$text['divdatetr'] = "Rok rozvodu";
		$text['mothername'] = "Jméno matky";
		$text['fathername'] = "Jméno otce";
		$text['filter'] = "Filtr";
		$text['notliving'] = "Zesnulí";
		$text['nodayevents'] = "Události v tomto měsíci, které nejsou spojeny s určitým dnem:";
		//added in 9.0.0
		$text['csv'] = "Soubor CSV oddělený čárkami";
		//added in 10.0.0
		$text['confdate'] = "Datum biřmování (CJKSpd)";
		$text['confplace'] = "Místo biřmování (CJKSpd)";
		$text['initdate'] = "Datum zasvěcení (CJKSpd)";
		$text['initplace'] = "Místo zasvěcení (CJKSpd)";
		//added in 11.0.0
		$text['marrtype'] = "Typ sňatku";
		$text['searchfor'] = "Hledat";
		$text['searchnote'] = "Pozn.: Tato stránka pro vyhledání používá Google. Počet nalezených záznamů je přímo ovlivněn mírou, jakou má Google tyto stránky indexované.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Soubor záznamů pro";
		$text['mostrecentactions'] = "Nedávná aktivita";
		$text['autorefresh'] = "Automatické zobrazení (po 30 vteřinách)";
		$text['refreshoff'] = "Vypnout automatické zobrazení";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Hřbitovy a náhrobky";
		$text['showallhsr'] = "Zobrazit všechny záznamy náhrobků";
		$text['in'] = "v";
		$text['showmap'] = "Ukázat mapu";
		$text['headstonefor'] = "Náhrobek pro";
		$text['photoof'] = "Fotografie";
		$text['photoowner'] = "Vlastník originálu";
		$text['nocemetery'] = "Hřbitov není uveden";
		$text['iptc005'] = "Název";
		$text['iptc020'] = "Podporované kategorie";
		$text['iptc040'] = "Zvláštní instrukce";
		$text['iptc055'] = "Datum vytvoření";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Autorova funkce";
		$text['iptc090'] = "Město";
		$text['iptc095'] = "Kraj";
		$text['iptc101'] = "Země";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Nadpis";
		$text['iptc110'] = "Pramen";
		$text['iptc115'] = "Pramen fotografie";
		$text['iptc116'] = "Veškerá práva vyhrazena";
		$text['iptc120'] = "Popis";
		$text['iptc122'] = "Popis vytvořil";
		$text['mapof'] = "Mapa";
		$text['regphotos'] = "Zobrazení s popisem";
		$text['gallery'] = "Pouze náhledy";
		$text['cemphotos'] = "Obrázky hřbitovů";
		$text['photosize'] = "Velikost";
        $text['iptc010'] = "Priorita";
		$text['filesize'] = "Velikost souboru";
		$text['seeloc'] = "Prohlédnete místo";
		$text['showall'] = "Zobrazit vše";
		$text['editmedia'] = "Upravit médium";
		$text['viewitem'] = "Prohlédnout tuto položku";
		$text['editcem'] = "Upravit hřbitov";
		$text['numitems'] = "Počet položek";
		$text['allalbums'] = "Všechna alba";
		$text['slidestop'] = "Pozastavit prezentaci";
		$text['slideresume'] = "Pokračovat v prezentaci";
		$text['slidesecs'] = "Počet vteřin pro každý snímek:";
		$text['minussecs'] = "ubrat 0.5 vteřiny";
		$text['plussecs'] = "přidat 0.5 vteřiny";
		$text['nocountry'] = "Neznámá země";
		$text['nostate'] = "Neznámý kraj";
		$text['nocounty'] = "Neznámý okres";
		$text['nocity'] = "Neznámé město";
		$text['nocemname'] = "Neznámý hřbitov";
		$text['editalbum'] = "Upravit album";
		$text['mediamaptext'] = "<strong>Pozn.:</strong> Posouváním ukazatele myši přes obrázek zobrazíte popisky různých částí obrázku. Změní-li se ukazatel myši na tvar vztyčeného ukazováku, můžete kliknutím zobrazit stránku s podrobnostmi.";
		//added in 8.0.0
		$text['allburials'] = "Všechny pohřby";
		$text['moreinfo'] = "Klikněte pro více informací o obrázku";
		//added in 9.0.0
        $text['iptc025'] = "Klíčová slova";
        $text['iptc092'] = "Sub-location";
		$text['iptc015'] = "Kategorie";
		$text['iptc065'] = "Původní program";
		$text['iptc070'] = "Verze programu";
		//added in 13.0
		$text['toggletags'] = "Přepnout značky";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Zobrazit příjmení začínající na";
		$text['showtop'] = "Zobrazit prvních";
		$text['showallsurnames'] = "Zobrazit všechna příjmení";
		$text['sortedalpha'] = "seřazena podle abecedy";
		$text['byoccurrence'] = "seřazených podle četnosti";
		$text['firstchars'] = "Začáteční písmena";
		$text['mainsurnamepage'] = "Hlavní stránka příjmení";
		$text['allsurnames'] = "Všechna příjmení";
		$text['showmatchingsurnames'] = "Kliknutím na příjmení zobrazíte odpovídající záznamy.";
		$text['backtotop'] = "Zpět na začátek";
		$text['beginswith'] = "Začíná na";
		$text['allbeginningwith'] = "Všechna příjmení začínající na";
		$text['numoccurrences'] = "celkový počet míst v závorce";
		$text['placesstarting'] = "Zobrazit nejvýznamnější lokality, které začínají na";
		$text['showmatchingplaces'] = "Kliknutím na místo zobrazíte podrobnější lokality. Kliknutím na ikonu Hledat zobrazíte odpovídající osoby.";
		$text['totalnames'] = "celkem osob";
		$text['showallplaces'] = "Zobrazit všechny nejvýznamnější lokality";
		$text['totalplaces'] = "celkem míst";
		$text['mainplacepage'] = "Hlavní stránka míst";
		$text['allplaces'] = "Všechny nejvýznamnější lokality";
		$text['placescont'] = "Zobrazit všechna místa obsahující";
		//changed in 8.0.0
		$text['top30'] = "Top xxx nejčastěji se vyskytujících příjmení";
		$text['top30places'] = "Top xxx nejvýznamnějších lokalit";
		//added in 12.0.0
		$text['firstnamelist'] = "Seznam křestních jmen";
		$text['firstnamesstarting'] = "Zobrazit křestní jména začínající na";
		$text['showallfirstnames'] = "Zobrazit všechna křestní jména";
		$text['mainfirstnamepage'] = "Hlavní stránka křestních jmen";
		$text['allfirstnames'] = "Všechna křestní jména";
		$text['showmatchingfirstnames'] = "Kliknutím na křestní jméno zobrazíte odpovídající záznamy.";
		$text['allfirstbegwith'] = "Všechna křestní jména začínající na";
		$text['top30first'] = "Top xxx nejčastěji se vyskytujících křestních jmen";
		$text['allothers'] = "Všechna ostatní";
		$text['amongall'] = "(mezi všemi jmény)";
		$text['justtop'] = "Pouze Top xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(v posledních xx dnech)";

		$text['photo'] = "Fotografie";
		$text['history'] = "Vyprávění/dokument";
		$text['husbid'] = "ID číslo otce";
		$text['husbname'] = "Jméno otce";
		$text['wifeid'] = "ID číslo matky";
		//added in 11.0.0
		$text['wifename'] = "Jméno matky";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Vymazat";
		$text['addperson'] = "Přidat osobu";
		$text['nobirth'] = "Následující osoba nemá platné datum narození a nelze ji přidat";
		$text['event'] = "Událost(i)";
		$text['chartwidth'] = "Šířka schématu";
		$text['timelineinstr'] = "Přidat osoby";
		$text['togglelines'] = "Přepnout zobrazení linek";
		//changed in 9.0.0
		$text['noliving'] = "Následující osoba je označena jako žijící nebo neveřejná a nelze ji přidat, protože nemáte patřičná přístupová práva";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Prohlédnout všechny stromy";
		$text['treename'] = "Název stromu";
		$text['owner'] = "Majitel";
		$text['address'] = "Adresa";
		$text['city'] = "Město";
		$text['state'] = "Kraj/provincie";
		$text['zip'] = "PSČ";
		$text['country'] = "Země";
		$text['email'] = "Email";
		$text['phone'] = "Telefon";
		$text['username'] = "Uživatelské jméno";
		$text['password'] = "Heslo";
		$text['loginfailed'] = "Chyba přihlášení.";

		$text['regnewacct'] = "Registrace nového účtu";
		$text['realname'] = "Vaše jméno a příjmení";
		$text['phone'] = "Telefon";
		$text['email'] = "Email";
		$text['address'] = "Adresa";
		$text['acctcomments'] = "Poznámky";
		$text['submit'] = "Odeslat";
		$text['leaveblank'] = "(zanechte toto pole prázdné, pokud žádáte o nový strom)";
		$text['required'] = "Tyto údaje je nutné vyplnit";
		$text['enterpassword'] = "Zadejte heslo.";
		$text['enterusername'] = "Zadejte uživatelské jméno.";
		$text['failure'] = "Zadané uživatelské jméno je již vyhrazené. Stisknutím tlačítka zpět se vraťte na předchozí stránku a zvolte si jiné uživatelské jméno";
		$text['success'] = "Vaše registrace proběhla úspěšně. Administrátor systému vás bude informovat, kdy bude váš účet aktivován, nebo pokud budou potřeba další informace.";
		$text['emailsubject'] = "Žádost o novou registraci";
		$text['website'] = "Internetové stránky";
		$text['nologin'] = "Nemáte přihlašovací údaje?";
		$text['loginsent'] = "Údaje byly odeslány";
		$text['loginnotsent'] = "Přihlašovací údaje nebyly odeslány";
		$text['enterrealname'] = "Zadejte, prosím, své skutečné jméno.";
		$text['rempass'] = "Zůstat přihlášen na tomto počítači";
		$text['morestats'] = "Další statistika";
		$text['accmail'] = "POZN.: Abyste mohli obdržet email od administrátora ohledne vašeho účtu, zkontrolujte, prosím, že váš emailový program neblokuje emailové adresy z této domény.";
		$text['newpassword'] = "Nové heslo";
		$text['resetpass'] = "Obnovit heslo";
		$text['nousers'] = "Tento formulář nelze použít, dokud nebude vytvořen alespoň jeden záznam. Pokud jste majitelem těchto stránek, jděte do nabídky Admin/Uživatelé a vytvořte si účet administrátora.";
		$text['noregs'] = "Je nám líto, ale v současné době nepřijímáme nové registrace. Kontaktujte nás, prosím, přímo, pokud máte nějaké dotazy či připomínky ohledně těchto webových stránek.";
		$text['emailmsg'] = "Byla vám zaslána nová žádost o uživatelský účet TNG. Přihlaste se, prosím, do administrátorského prostředí a dejte novému účtu patřičná přístupová práva.";
		$text['accactive'] = "Úcet byl aktivován, ale uživatel nebude mít žádná zvláštní práva, dokud mu je nepřidělíte.";
		$text['accinactive'] = "Nastavení účtu můžete provést v Admin/Uživatelé/Přezkoumat. Účet zůstane neaktivní, dokud alespoň jednou záznam neupravíte a neuložíte.";
		$text['pwdagain'] = "Heslo znovu";
		$text['enterpassword2'] = "Prosím, vložte znovu heslo.";
		$text['pwdsmatch'] = "Heslo neodpovídá. Prosím, zadejte stejné heslo do každého pole.";
		$text['acksubject'] = "Registrace"; //for a new user account
		$text['ackmessage'] = "Vaše žádost o uživatelský účet byla přijata. Váš účet nebude aktivní, dokud nebude schválen administrátorem. O schválení budete informováni emailovou zprávou.";
		//added in 12.0.0
		$text['switch'] = "Prohodit";
		//added in 14.0
		$text['newpassword2'] = "Nové heslo znovu";
		$text['resetsuccess'] = "Úspěch: Heslo bylo obnoveno";
		$text['resetfail'] = "Selhání: Heslo nebylo obnoveno";
		$text['failreason0'] = " (neznámá chyba databáze)";
		$text['failreason2'] = " (nemáte oprávnění ke změně hesla)";
		$text['failreason3'] = " (hesla se neshodují)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Prohlédnout všechny větve";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Množství";
		$text['totindividuals'] = "Celkem osob";
		$text['totmales'] = "Celkem mužů";
		$text['totfemales'] = "Celkem žen";
		$text['totunknown'] = "Celkem neurčeného pohlaví";
		$text['totliving'] = "Celkem žijících";
		$text['totfamilies'] = "Celkem rodin";
		$text['totuniquesn'] = "Celkem jedinečných příjmení";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Celkem pramenů";
		$text['avglifespan'] = "Průměrná délka života";
		$text['earliestbirth'] = "Nejdříve narozený";
		$text['longestlived'] = "Osoby, které se dožily nejvyššího věku";
		$text['days'] = "dní";
		$text['age'] = "Věk";
		$text['agedisclaimer'] = "Výpočty spojené s věkem se zakládají na údajích osob s udaným datem narození <EM>a</EM> úmrtí.  Protože jsou některá data neúplná (např. úmrtí je zaznamenáno pouze jako rok \"1945\" nebo \"před 1860\"), tyto výpočty nemusí být 100% přesné.";
		$text['treedetail'] = "Další informace o tomto stromu";
		$text['total'] = "Celkem";
		//added in 12.0
		$text['totdeceased'] = "Celkem zesnulých";
		//added in 14.0
		$text['totalsourcecitations'] = "Celkem citací pramenů";
		break;

	case "notes":
		$text['browseallnotes'] = "Prohlédnout všechny poznámky";
		break;

	case "help":
		$text['menuhelp'] = "Nápověda nabídky";
		break;

	case "install":
		$text['perms'] = "Všechna povolení byla nastavena.";
		$text['noperms'] = "Povolení nemohla být nastavena pro tyto soubory:";
		$text['manual'] = "Nastavte je prosím manuálně.";
		$text['folder'] = "Složka";
		$text['created'] = "byla vytvořena";
		$text['nocreate'] = "nemohla být vytvořena. Založte ji, prosím, manuálně.";
		$text['infosaved'] = "Informace uloženy, spojení potvrzeno!";
		$text['tablescr'] = "Tabulky byly vytvořeny!";
		$text['notables'] = "Následující tabulky nemohly být vytvořeny:";
		$text['nocomm'] = "TNG nemůže navázat komunikaci s vaší databází. Žádné tabulky nebyly vytvořeny.";
		$text['newdb'] = "Informace uloženy, spojení potvrzeno, nová databáze byla vytvořena:";
		$text['noattach'] = "Informace uloženy. Spojení navázáno a databáze vytvořena, ale TNG se k ní nemůže připojit.";
		$text['nodb'] = "Informace uloženy. Spojení navázáno, ale databáze neexistuje a nemohla být vytvořena. Ověřte si, že název databáze je správný anebo použijte ovládací panel a vytvořte ji.";
		$text['noconn'] = "Informace uložena, ale spojení nebylo navázáno.  Některé z následujích věcí jsou chybné:";
		$text['exists'] = "existuje";
		$text['noop'] = "Žádná operace nebyla provedena.";
		//added in 8.0.0
		$text['nouser'] = "Účet nebyl vytvořen. Uživatelské jméno již zřejmě existuje.";
		$text['notree'] = "Strom nebyl vytvořen. ID číslo stromu zřejmě již existuje.";
		$text['infosaved2'] = "Informace uložena";
		$text['renamedto'] = "přejmenován na";
		$text['norename'] = "nemohl být přejmenován";
		//changed in 13.0.0
		$text['loginfirst'] = "Byly zjištěny existující záznamy uživatelů. Chcete-li pokračovat, musíte se nejprve přihlásit nebo odebrat všechny záznamy z tabulky uživatelů.";
		break;

	case "imgviewer":
		$text['magmode'] = "Režim zvětšování";
		$text['panmode'] = "Režim sledování";
		$text['pan'] = "Je-li obrázek větší než okno prohlížeče, obrázkem v okně posunete kliknutím myší dovnitř obrázku a jejím držením a tažením";
		$text['fitwidth'] = "Na celou šířku";
		$text['fitheight'] = "Na celou výšku";
		$text['newwin'] = "Nové okno";
		$text['opennw'] = "Otevřít obrázek v novém okně";
		$text['magnifyreg'] = "Kliknutím myši dovnitř obrázku zvětšíte tuto část obrázku";
		$text['imgctrls'] = "Zapnout ovládání obrázku";
		$text['vwrctrls'] = "Zapnout ovládání prohlížeče obrázku";
		$text['vwrclose'] = "Zavřít prohlížeč obrázku";
		break;

	case "dna":
		$text['test_date'] = "Datum testu";
		$text['links'] = "Odpovídající odkazy";
		$text['testid'] = "ID testu";
		//added in 12.0.0
		$text['mode_values'] = "Hodnoty módu";
		$text['compareselected'] = "Porovnat vybrané";
		$text['dnatestscompare'] = "Porovnat testy Y-DNA";
		$text['keep_name_private'] = "Zachovat jméno neveřejné";
		$text['browsealltests'] = "Procházet všechny testy";
		$text['all_dna_tests'] = "Všechny testy DNA";
		$text['fastmutating'] = "Rychlé mutace";
		$text['alltypes'] = "Všechny typy";
		$text['allgroups'] = "Všechny skupiny";
		$text['Ydna_LITbox_info'] = "Test(y) připojené k této osobě nemusí nutně od této osoby pocházet.<br />Ve sloupci 'Haploskupina' se zobrazí data červeně, pokud je výsledek 'Předpovězen', nebo zeleně, pokud je test 'Potvrzen'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Porovnat vybrané testy mtDNA";
		$text['dnatestscompare_atdna'] = "Porovnat vybrané testy atDNA";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNP";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Zvláštní mutace";
		$text['mrca'] = "Nejbližší společný předek";
		$text['ydna_test'] = "Testy Y-DNA";
		$text['mtdna_test'] = "Testy mtDNA (mitochondriální)";
		$text['atdna_test'] = "Testy atDNA (autozomální)";
		$text['segment_start'] = "Začátek";
		$text['segment_end'] = "Konec";
		$text['suggested_relationship'] = "Navrhnuté";
		$text['actual_relationship'] = "Aktuální";
		$text['12markers'] = "Markery 1-12";
		$text['25markers'] = "Markery 13-25";
		$text['37markers'] = "Markery 26-37";
		$text['67markers'] = "Markery 38-67";
		$text['111markers'] = "Markery 68-111";
		//added in 13.1
		$text['comparemore'] = "Ke srovnání je třeba vybrat alespoň dva testy.";
		break;
}

//common
$text['matches'] = "Záznamy";
$text['description'] = "Popis";
$text['notes'] = "Poznámky";
$text['status'] = "Stav";
$text['newsearch'] = "Nové hledání";
$text['pedigree'] = "Schéma předků";
$text['seephoto'] = "Prohlédnout fotografii";
$text['andlocation'] = "& místo";
$text['accessedby'] = "záznam prohlížel";
$text['children'] = "Děti";  //from getperson
$text['tree'] = "Strom";
$text['alltrees'] = "Všechny stromy";
$text['nosurname'] = "[bez příjmení]";
$text['thumb'] = "Náhled";  //as in Thumbnail
$text['people'] = "Lidé";
$text['title'] = "Titul";  //from getperson
$text['suffix'] = "Přípona";  //from getperson
$text['nickname'] = "Přezdívka";  //from getperson
$text['lastmodified'] = "Poslední změna";  //from getperson
$text['married'] = "Sňatek";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Jméno"; //from showmap
$text['lastfirst'] = "Příjmení, jméno";  //from search
$text['bornchr'] = "Narození/Křest";  //from search
$text['individuals'] = "Osoby";  //from whats new
$text['families'] = "Rodiny";
$text['personid'] = "ID číslo osoby";
$text['sources'] = "Prameny";  //from getperson (next several)
$text['unknown'] = "Neznámé";
$text['father'] = "Otec";
$text['mother'] = "Matka";
$text['christened'] = "Křest";
$text['died'] = "Úmrtí";
$text['buried'] = "Pohřeb";
$text['spouse'] = "Partner";  //from search
$text['parents'] = "Rodiče";  //from pedigree
$text['text'] = "Text";  //from sources
$text['language'] = "Jazyk";  //from languages
$text['descendchart'] = "Schéma potomků";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Osoba";
$text['edit'] = "Upravit";
$text['date'] = "Datum";
$text['login'] = "Přihlášení";
$text['logout'] = "Odhlášení";
$text['groupsheet'] = "Schéma rodiny";
$text['text_and'] = "a";
$text['generation'] = "Generace";
$text['filename'] = "Název souboru";
$text['id'] = "ID číslo";
$text['search'] = "Hledat";
$text['user'] = "Uživatel";
$text['firstname'] = "Jméno";
$text['lastname'] = "Příjmení";
$text['searchresults'] = "Výsledky hledání";
$text['diedburied'] = "Úmrtí/Pohřeb";
$text['homepage'] = "Domovská stránka";
$text['find'] = "Najít (osobu)";
$text['relationship'] = "Příbuzenský vztah";		//in German, Verwandtschaft
$text['relationship2'] = "Vztah"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Časová linie";
$text['yesabbr'] = "A";               //abbreviation for 'yes'
$text['divorced'] = "Rozvod";
$text['indlinked'] = "Spojeno s";
$text['branch'] = "Větev";
$text['moreind'] = "Další osoby";
$text['morefam'] = "Další rodiny";
$text['surnamelist'] = "Seznam příjmení";
$text['generations'] = "Generací";
$text['refresh'] = "Obnovit";
$text['whatsnew'] = "Co je nového";
$text['reports'] = "Reporty";
$text['placelist'] = "Seznam míst";
$text['baptizedlds'] = "Křest (CJKSpd)";
$text['endowedlds'] = "Obdarován (CJKSpd)";
$text['sealedplds'] = "Pečetěn R (CJKSpd)";
$text['sealedslds'] = "Pečetěn P (CJKSpd)";
$text['ancestors'] = "Předkové";
$text['descendants'] = "Potomci";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum posledního importu souboru GEDCOM";
$text['type'] = "Druh";
$text['savechanges'] = "Uložit změny";
$text['familyid'] = "ID číslo rodiny";
$text['headstone'] = "Náhrobky";
$text['historiesdocs'] = "Vyprávění";
$text['anonymous'] = "anonymní";
$text['places'] = "Místa";
$text['anniversaries'] = "Data a výročí";
$text['administration'] = "Administrace";
$text['help'] = "Nápověda";
//$text['documents'] = "Documents";
$text['year'] = "Rok";
$text['all'] = "Vše";
$text['address'] = "Adresa";
$text['suggest'] = "Navrhnout";
$text['editevent'] = "Navrhnout změnu pro tuto událost";
$text['morelinks'] = "Více odkazů";
$text['faminfo'] = "Informace o rodině";
$text['persinfo'] = "Osobní informace";
$text['srcinfo'] = "Informace o pramenu";
$text['fact'] = "Událost";
$text['goto'] = "Zvolte stránku";
$text['tngprint'] = "Tisk";
$text['databasestatistics'] = "Statistika databáze"; //needed to be shorter to fit on menu
$text['child'] = "Dítě";  //from familygroup
$text['repoinfo'] = "Údaje o úložišti";
$text['tng_reset'] = "Obnovit";
$text['noresults'] = "Žádné výsledky nebyly nalezeny";
$text['allmedia'] = "Všechna média";
$text['repositories'] = "Úložiště pramenů";
$text['albums'] = "Alba";
$text['cemeteries'] = "Hřbitovy";
$text['surnames'] = "Příjmení";
$text['dates'] = "Data";
$text['link'] = "Odkaz";
$text['media'] = "Média";
$text['gender'] = "Pohlaví";
$text['latitude'] = "Šířka";
$text['longitude'] = "Délka";
$text['bookmarks'] = "Záložky";
$text['bookmark'] = "Přidat záložku";
$text['mngbookmarks'] = "Zobrazit záložky";
$text['bookmarked'] = "Záložka přidána";
$text['remove'] = "Odebrat";
$text['find_menu'] = "Najít";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Hřbitov";
$text['gmapevent'] = "Mapa událostí";
$text['gevents'] = "Událost";
$text['googleearthlink'] = "Odkaz na Google Earth";
$text['googlemaplink'] = "Odkaz na Google Maps";
$text['gmaplegend'] = "Legenda";
$text['unmarked'] = "Neoznačené";
$text['located'] = "Nacházející se";
$text['albclicksee'] = "Kliknutím zobrazit všechny položky v tomto albu";
$text['notyetlocated'] = "Dosud nenalezen";
$text['cremated'] = "Zpopelněn";
$text['missing'] = "Chybějící";
$text['pdfgen'] = "Generátor PDF";
$text['blank'] = "Prázdné schéma";
$text['fonts'] = "Font";
$text['header'] = "Hlavička";
$text['data'] = "Data";
$text['pgsetup'] = "Nastavení stránky";
$text['pgsize'] = "Velikost stránky";
$text['orient'] = "Orientace"; //for a page
$text['portrait'] = "Na výšku";
$text['landscape'] = "Na šířku";
$text['tmargin'] = "Horní okraj";
$text['bmargin'] = "Spodní okraj";
$text['lmargin'] = "Levý okraj";
$text['rmargin'] = "Pravý okraj";
$text['createch'] = "Vytvořit schéma";
$text['prefix'] = "Předpona";
$text['mostwanted'] = "Hledá se";
$text['latupdates'] = "Poslední aktuality";
$text['featphoto'] = "Hlavní fotografie";
$text['news'] = "Novinky";
$text['ourhist'] = "Naše rodinná historie";
$text['ourhistanc'] = "Historie a předkové naší rodiny";
$text['ourpages'] = "Genealogické stránky naší rodiny";
$text['pwrdby'] = "Tyto stránky běží na";
$text['writby'] = "vytvořil";
$text['searchtngnet'] = "Prohledat TNG Network (GENDEX)";
$text['viewphotos'] = "Prohlédnout všechny fotografie";
$text['anon'] = "Současně jste anonymní";
$text['whichbranch'] = "Ze které větve jste?";
$text['featarts'] = "Nejzajímavější články";
$text['maintby'] = "Systém spravuje";
$text['createdon'] = "Vytvořeno";
$text['reliability'] = "Věrohodnost";
$text['labels'] = "Popisky";
$text['inclsrcs'] = "Zahrnout prameny";
$text['cont'] = "(pokrač.)"; //abbreviation for continued
$text['mnuheader'] = "Domovská stránka";
$text['mnusearchfornames'] = "Hledat";
$text['mnulastname'] = "Příjmení";
$text['mnufirstname'] = "Jméno";
$text['mnusearch'] = "Hledat";
$text['mnureset'] = "Začít znovu";
$text['mnulogon'] = "Přihlášení";
$text['mnulogout'] = "Odhlášení";
$text['mnufeatures'] = "Další možnosti";
$text['mnuregister'] = "Registrace nového účtu";
$text['mnuadvancedsearch'] = "Rozšířené hledání";
$text['mnulastnames'] = "Příjmení";
$text['mnustatistics'] = "Statistika";
$text['mnuphotos'] = "Fotografie";
$text['mnuhistories'] = "Vyprávění";
$text['mnumyancestors'] = "Fotografie &amp; vyprávění pro předky od [Person]";
$text['mnucemeteries'] = "Hřbitovy";
$text['mnutombstones'] = "Náhrobky";
$text['mnureports'] = "Reporty";
$text['mnusources'] = "Prameny";
$text['mnuwhatsnew'] = "Co je nového";
$text['mnushowlog'] = "Záznam přístupů";
$text['mnulanguage'] = "Změna jazyka";
$text['mnuadmin'] = "Administrace";
$text['welcome'] = "Vítejte";
$text['contactus'] = "Napište nám";
//changed in 8.0.0
$text['born'] = "Narození";
$text['searchnames'] = "Hledat osoby";
//added in 8.0.0
$text['editperson'] = "Upravit Osoby";
$text['loadmap'] = "Nahrát mapu";
$text['birth'] = "Narození";
$text['wasborn'] = "se narodil(a)";
$text['startnum'] = "První číslo";
$text['searching'] = "Vyhledávám";
//moved here in 8.0.0
$text['location'] = "Místo";
$text['association'] = "Spojení";
$text['collapse'] = "Sbalit";
$text['expand'] = "Rozbalit";
$text['plot'] = "Plot";
$text['searchfams'] = "Hledat rodiny";
//added in 8.0.2
$text['wasmarried'] = "byl(a) sezdán(a) s";
$text['anddied'] = "zemřel(a)";
//added in 9.0.0
$text['share'] = "Sdílet";
$text['hide'] = "Skrýt";
$text['disabled'] = "Váš uživatelský účet byl zablokován.  Kontaktujte, prosím, administrátora.";
$text['contactus_long'] = "Pokud máte nějaké dotazy nebo připomínky ohledně informací na těchto stránkách, nebo byste měli zájem spolupracovat na dalším výzkumu, případně poskytnout další informace, neváhejte a <span class=\"emphasis\"><a href=\"suggest.php\">kontaktujte mě</a></span>.";
$text['features'] = "Zajímavosti";
$text['resources'] = "Zdroje";
$text['latestnews'] = "Poslední novinky";
$text['trees'] = "Stromy";
$text['wasburied'] = "byl(a) pohřben(a)";
//moved here in 9.0.0
$text['emailagain'] = "Email znovu";
$text['enteremail2'] = "Zadejte, prosím, znovu vaši emailovou adresu.";
$text['emailsmatch'] = "Zadané emailové adresy nesouhlasí. Zadejte stejnou emailovou adresu do obou polí.";
$text['getdirections'] = "Klikněte pro podrobnosti";
$text['calendar'] = "Kalendář";
//changed in 9.0.0
$text['directionsto'] = " to the ";
$text['slidestart'] = "Zahájit prezentaci";
$text['livingnote'] = "S touto poznámkou je spojena alespoň jedna žijící osoba - podrobnosti nejsou zveřejněny.";
$text['livingphoto'] = "S touto položkou je spojena alespoň jedna žijící osoba nebo osoba označená jako neveřejná - podrobnosti nejsou zveřejněny.";
$text['waschristened'] = "byl(a) pokřtěn(a)";
//added in 10.0.0
$text['branches'] = "Větve";
$text['detail'] = "Detail";
$text['moredetail'] = "Více detailů";
$text['lessdetail'] = "Méně detailů";
$text['conflds'] = "Biřmován (CJKSpd)";
$text['initlds'] = "Zasvěcen (CJKSpd)";
$text['wascremated'] = "byl(a) zpopelněn(a)";
//moved here in 11.0.0
$text['text_for'] = "pro";
//added in 11.0.0
$text['searchsite'] = "Hledat na této stránce";
$text['searchsitemenu'] = "Hledat na stránce";
$text['kmlfile'] = "Nahrát soubor .kml pro zobrazení tohoto místa v Google Earth";
$text['download'] = "Kliknutím nahrát";
$text['more'] = "Více";
$text['heatmap'] = "Zobrazit mapu";
$text['refreshmap'] = "Obnovit mapu";
$text['remnums'] = "Vymazat čísla a špendlíky";
$text['photoshistories'] = "Fotografie &amp; Vyprávění";
$text['familychart'] = "Graf rodiny";
//added in 12.0.0
$text['firstnames'] = "Křestní jména";
//moved here in 12.0.0
$text['dna_test'] = "Test DNA";
$text['test_type'] = "Typ testu";
$text['test_info'] = "Informace o testu";
$text['takenby'] = "Testovaná osoba";
$text['haplogroup'] = "Haploskupina";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevantní odkazy";
$text['nofirstname'] = "[žádné křestní jméno]";
//added in 12.0.1
$text['cookieuse'] = "Poznámka: Tyto internetové stránky používají cookies.";
$text['dataprotect'] = "Ochrana osobních údajů";
$text['viewpolicy'] = "Zobrazit zásady";
$text['understand'] = "Rozumím";
$text['consent'] = "Souhlasím s uložením a zpracováním osobních údajů. Vlastníka těchto internetových stránek mohu kdykoli požádat, aby tyto informace odstranil.";
$text['consentreq'] = "Uveďte svůj souhlas k ukládání osobních údajů na tomto webu.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Rychlé odkazy";
$text['yourname'] = "Vaše jméno";
$text['youremail'] = "Vaše emailová adresa";
$text['liketoadd'] = "Jakékoli informace, které chcete přidat";
$text['webmastermsg'] = "Zpráva webmastera";
$text['gallery'] = "Zobrazit galerii";
$text['wasborn_male'] = "se narodil";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "se narodila"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "byl pokřtěn";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "byla pokřtěna";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "zemřel";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "zemřela";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "byl pohřbena"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "byla pohřbena"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "byl zpopelněn";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "byla zpopelněna";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "byl sezdán s";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "byla sezdána s";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "byl rozveden";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "byla rozveda";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " v ";			// used as a preposition to the location
$text['onthisdate'] = " dne ";		// when used with full date
$text['inthisyear'] = " v ";		// when used with year only or month / year dates
$text['and'] = "a ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Info o testu DNA";
//added in 13.0
$text['visitor'] = "Návštěvník";

$text['popupnote2'] = " = Nové schéma předků";

//moved here in 14.0
$text['zoomin'] = "Zvětšit";
$text['zoomout'] = "Zmenšit";
$text['scrollnote'] = "Přetažením nebo posunutím zobrazíte z grafu více.";
$text['general'] = "Obecně";

//changed in 14.0
$text['otherevents'] = "Jiné události";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Spojení";
$text['continue'] = "Pokračovat";
$text['title2'] = "Titul"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>