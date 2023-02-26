<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Prohlédnout v¹echny prameny";
		$text['shorttitle'] = "Krátký název";
		$text['callnum'] = "Archivní èíslo";
		$text['author'] = "Autor";
		$text['publisher'] = "Vydavatel";
		$text['other'] = "Dal¹í informace";
		$text['sourceid'] = "ID èíslo pramenu";
		$text['moresrc'] = "Dal¹í prameny";
		$text['repoid'] = "ID èíslo úlo¾i¹tì";
		$text['browseallrepos'] = "Prohlédnout v¹echny úlo¾i¹tì";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nový jazyk";
		$text['changelanguage'] = "Zmìna jazyka";
		$text['languagesaved'] = "Jazyk ulo¾en";
		$text['sitemaint'] = "Právì probíhá údr¾ba webových stránek";
		$text['standby'] = "Webové stránky jsou doèasnì nedostupné, proto¾e probíhá aktualizace databáze. Zkuste to, prosím, znovu za pár minut. Pokud budou stránky nedostupné del¹í dobu, kontaktujte majitele tìchto stránek.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM zaèínající od";
		$text['producegedfrom'] = "Vytvoøit GEDCOM soubor pro";
		$text['numgens'] = "Poèet generací";
		$text['includelds'] = "Vèetnì údajù CJKSpd";
		$text['buildged'] = "Vytvoø GEDCOM";
		$text['gedstartfrom'] = "GEDCOM zaèínající od";
		$text['nomaxgen'] = "Musíte zadat maximální poèet generací. Pou¾ijte tlaèítko Zpìt k návratu na pøedchozí stránku a chybu opravte.";
		$text['gedcreatedfrom'] = "GEDCOM vytvoøen od";
		$text['gedcreatedfor'] = "vytvoøen pro";
		$text['creategedfor'] = "Vytvoøit GEDCOM";
		$text['email'] = "Email";
		$text['suggestchange'] = "Navrhnout zmìnu";
		$text['yourname'] = "Va¹e jméno";
		$text['comments'] = "Poznámky";
		$text['comments2'] = "Komentáø";
		$text['submitsugg'] = "Poslat návrh";
		$text['proposed'] = "Navrhovaná zmìna";
		$text['mailsent'] = "Dìkujeme. Va¹e zpráva byla odeslána.";
		$text['mailnotsent'] = "Bohu¾el, va¹e zpráva nemohla být doruèena. Kontaktujte prosím xxx pøímo na yyy.";
		$text['mailme'] = "Zaslat kopii na tuto adresu";
		$text['entername'] = "Zadejte, prosím, va¹e jméno";
		$text['entercomments'] = "Zadejte, prosím, va¹e pøipomínky";
		$text['sendmsg'] = "Poslat zprávu";
		//added in 9.0.0
		$text['subject'] = "Pøedmìt";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografie a vyprávìní pro";
		$text['indinfofor'] = "Osobní informace o";
		$text['pp'] = "str."; //page abbreviation
		$text['age'] = "Vìk";
		$text['agency'] = "Instituce";
		$text['cause'] = "Pøíèina";
		$text['suggested'] = "Navr¾ené";
		$text['closewindow'] = "Zavøít okno";
		$text['thanks'] = "Dìkujeme";
		$text['received'] = "Vá¹ návrh byl zaslán administrátorovi tìchto stránek k posouzení.";
		$text['indreport'] = "Report osoby";
		$text['indreportfor'] = "Report osoby";
		$text['bkmkvis'] = "Pozn.: Tyto zálo¾ky jsou viditelné pouze na tomto poèítaèi a v tomto prohlí¾eèi.";
        //added in 9.0.0
		$text['reviewmsg'] = "Máte doporuèenou zmìnu, která vy¾aduje va¹e posouzení. Tato zmìna se týká:";
        $text['revsubject'] = "Doporuèená zmìna vy¾aduje va¹e posouzení";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Urèení pøíbuzenského vztahu";
		$text['findrel'] = "Urèení pøíbuzenského vztahu";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "Kalkulovat";
		$text['select2inds'] = "Zvolte dvì osoby.";
		$text['findpersonid'] = "Najít ID èíslo osoby";
		$text['enternamepart'] = "zadejte èást jména nebo pøíjmení";
		$text['pleasenamepart'] = "Zadejte, prosím, èást jména nebo pøíjmení.";
		$text['clicktoselect'] = "kliknutím vyberte osobu";
		$text['nobirthinfo'] = "Chybí informace o narození";
		$text['relateto'] = "Pøíbuzenský vztah k: ";
		$text['sameperson'] = "Tyto dvì osoby jsou toto¾né";
		$text['notrelated'] = "Tyto dvì osoby nemají ¾ádný pøíbuzenský vztah v posledních xxx generacích"; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Pro zobrazení pøíbuzenského vztahu mezi dvìma osobami nejprve kliknìte na 'Najít', abyste na¹li pøíslu¹né osoby (nebo zanechte osoby, které jsou zobrazené), poté kliknìte na 'Kalkulovat'.<br>(èeské výrazy v nìkterých slo¾itìj¹ích pøípadech díky jiné struktuøe názvosloví pøíbuzenských vztahù v anglickém jazyce a z toho pramenícího obtí¾ného pøekladu nemusí být správné).";
		$text['sometimes'] = "(Pou¾ití jiného poètu generací mù¾e mít nìkdy jiný výsledek.)";
		$text['findanother'] = "Zjistit jiný pøíbuzenský vztah";
		$text['brother'] = "bratr od";
		$text['sister'] = "sestra od";
		$text['sibling'] = "sourozenec od";
		$text['uncle'] = " xxx strýc od";
		$text['aunt'] = " xxx teta od";
		$text['uncleaunt'] = " xxx strýc/teta od";
		$text['nephew'] = " xxx synovec od";
		$text['niece'] = " xxx neteø od";
		$text['nephnc'] = "xxx synovec/neteø od";
		$text['removed'] = "generace";
		$text['rhusband'] = "man¾el od";
		$text['rwife'] = "man¾elka od";
		$text['rspouse'] = "partner od";
		$text['son'] = "syn od";
		$text['daughter'] = "dcera od";
		$text['rchild'] = "dítì od";
		$text['sil'] = "ze» od";
		$text['dil'] = "snacha od";
		$text['sdil'] = "ze» nebo snacha od";
		$text['gson'] = " xxx vnuk od";
		$text['gdau'] = " xxx vnuèka od";
		$text['gsondau'] = "xxx vnuk/vnuèka od";
		$text['great'] = "pra";
		$text['spouses'] = "jsou man¾elé";
		$text['is'] = "je";
		$text['changeto'] = "Zmìnit na:";
		$text['notvalid'] = "není platné ID èíslo osoby nebo neexistuje v této databázi. Zkuste to prosím znovu.";
		$text['halfbrother'] = "nevlastní bratr od";
		$text['halfsister'] = "nevlastní sestra od";
		$text['halfsibling'] = "nevlastní sourozenec od";
		//changed in 8.0.0
		$text['gencheck'] = "Maximální poèet kontrolovaných generací";
		$text['mcousin'] = "xxx bratranec yyy od";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx sestøenice yyy od";  //female cousin
		$text['cousin'] = " xxx bratranec yyy od";
		$text['mhalfcousin'] = "polovièní xxx bratranec yyy od";  //male cousin
		$text['fhalfcousin'] = "polovièní xxx sestøenice yyy od";  //female cousin
		$text['halfcousin'] = "polovièní xxx bratranec/sestøenice yyy od";
		//added in 8.0.0
		$text['oneremoved'] = "o jednu generaci";
		$text['gfath'] = "xxx dìdeèek od";
		$text['gmoth'] = "xxx babièka od";
		$text['gpar'] = "xxx prarodièe od";
		$text['mothof'] = "matka od";
		$text['fathof'] = "otec od ";
		$text['parof'] = "rodièe od";
		$text['maxrels'] = "Maximální poèet vztahù k zobrazení";
		$text['dospouses'] = "Zobrazit vztahy vèetnì man¾elù";
		$text['rels'] = "Pøíbuzenské vztahy";
		$text['dospouses2'] = "Zobrazit partnery";
		$text['fil'] = "tchán od";
		$text['mil'] = "tchynì od";
		$text['fmil'] = "tchán nebo tchynì od";
		$text['stepson'] = "nevlastní syn od";
		$text['stepdau'] = "nevlastní dcera od";
		$text['stepchild'] = "nevlastní dítì od";
		$text['stepgson'] = "xxx nevlastní vnuk od";
		$text['stepgdau'] = "xxx nevlastní vnuèka od";
		$text['stepgchild'] = "xxx nevlastní vnouèe od";
		//added in 8.1.1
		$text['ggreat'] = "pra";
		//added in 8.1.2
		$text['ggfath'] = " xxx pradìdeèek od";
		$text['ggmoth'] = " xxx prababièka od";
		$text['ggpar'] = " xxx prarodiè od";
		$text['ggson'] = " xxx pravnuk od";
		$text['ggdau'] = " xxx pravnuèka od";
		$text['ggsondau'] = " xxx pradítì od";
		$text['gstepgson'] = "nevlastní xxx pravnuk od";
		$text['gstepgdau'] = "nevlastní xxx pravnuèka od";
		$text['gstepgchild'] = "nevlastní xxx prapradítì od";
		$text['guncle'] = " xxx prastrýc od";
		$text['gaunt'] = " xxx prateta od";
		$text['guncleaunt'] = " xxx prastrýc/prateta od";
		$text['gnephew'] = " xxx prasynovec od";
		$text['gniece'] = " xxx praneteø od";
		$text['gnephnc'] = " xxx prasynovec/praneteø od";
		//added in 14.0
		$text['pathscalc'] = "Hledat spojení";
		$text['findrel2'] = "Urèení pøíbuzenského vztahu";
		$text['makeme2nd'] = "Pou¾ít moje ID";
		$text['usebookmarks'] = "Pou¾ít zálo¾ky";
		$text['select2inds'] = "Zvolte dvì osoby.";
		$text['indinfofor'] = "Osobní informace o";
		$text['nobookmarks'] = "Nelze pou¾ít ¾ádnou zálo¾ku";
		$text['bkmtitle'] = "Osoby nalezené v zálo¾kách";
		$text['bkminfo'] = "Vybrat osobu:";
		$text['sortpathsby'] = "Seøadit cesty podle poètu";
		$text['sortbyshort'] = "Seøadit podle";
		$text['bylengthshort'] = "Délka";
		$text['badID1'] = ": ¹patné ID osoby1 – vra»te se prosím zpìt a opravte";
		$text['badID2'] = ": ¹patné ID osoby2 – vra»te se prosím zpìt a opravte";
		$text['notintree'] = ": osoba s tímto ID není v aktuální stromové databázi.";
		$text['sameperson'] = "Tyto dvì osoby jsou toto¾né";;
		$text['nopaths'] = "Tyto osoby nejsou spojeny.";
		$text['nopaths1'] = "®ádná dal¹í pøipojení krat¹í ne¾ xxx";
		$text['nopaths2'] = "v xxx krocích vyhledávání";
		$text['longestpath'] = "(nejdel¹í dosud kontrolovaná cesta byla dlouhá xxx krokù)";
		$text['relevantpaths'] = "Poèet nalezených rùzných relevantních cest: xxx";
		$text['skipMarr'] = "(navíc poèet cest nalezených, ale nezobrazených kvùli pøíli¹ velkému poètu sòatkù byl: xxx)";
		$text['mjaor'] = "nebo";
		$text['connectionsto'] = "Spojení k osobì ";
		$text['findanotherpers'] = "Najít jinou osobu...";
		$text['sometimes'] = "(Pou¾ití jiného poètu generací mù¾e mít nìkdy jiný výsledek.)";
		$text['anotherpath'] = "Hledat dal¹í spojení";
		$text['xpath'] = "Cesta ";
		$text['primary'] = "Výchozí osoba"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Cílová osoba";
		$text['parent'] = "Rodiè";
		$text['mhfather'] = "jeho otec";
		$text['mhmother'] = "jeho matka";
		$text['mhhusband'] = "jeho man¾el";
		$text['mhwife'] = "jeho man¾elka";
		$text['mhson'] = "jeho syn";
		$text['mhdaughter'] = "jeho dcera";
		$text['fhfather'] = "její otec";
		$text['fhmother'] = "její matka";
		$text['fhhusband'] = "její man¾el";
		$text['fhwife'] = "její man¾elka";
		$text['fhson'] = "její syn";
		$text['fhdaughter'] = "její dcera";
		$text['hfather'] = "otec";
		$text['hmother'] = "matka";
		$text['hhusband'] = "man¾el";
		$text['hwife'] = "man¾elka";
		$text['hson'] = "syn";
		$text['hdaughter'] = "dcera";
		$text['maxruns'] = "Maximální poèet cest, který má být zkontrolován";
		$text['maxrshort'] = "Max cesty";
		$text['maxlength'] = "Spojovací cesty ne del¹í ne¾";
		$text['maxlshort'] = "Max délka";
		$text['xstep'] = "krok";
		$text['xsteps'] = "kroky";
		$text['xmarriages'] = "xxx man¾elství";
		$text['xmarriage'] = "1 man¾elství";
		$text['showspouses'] = "Zobrazit oba partnery";
		$text['showTxt'] = "Zobrazit textový popis cesty";
		$text['showTxtshort'] = "Textový popis";
		$text['compactBox'] = "Zobrazit rámeèky osob v kompaktní podobì";
		$text['compactBoxshort'] = "Kompaktní rámeèky";
		$text['paths'] = "Cesty";
		$text['dospouses2'] = "Zobrazit partnery";
		$text['maxmopt'] = "Maximální poèet man¾elství na spojení";
		$text['maxm'] = "Maximální poèet man¾elství";
		$text['arerelated'] = "Tyto osoby jsou pøíbuzní – jejich vztah je znázornìn na cestì 1";
		$text['simplerel'] = "Hledat jednoduchý vztah";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Report rodiny";
		$text['ldsords'] = "Obøady CJKSpd";
		$text['endowedlds'] = "Obdarován (CJKSpd)";
		$text['sealedplds'] = "Peèetìn R (CJKSpd)";
		$text['sealedslds'] = "Peèetìn P (CJKSpd)";
		$text['otherspouse'] = "Dal¹í partner";
		$text['husband'] = "Man¾el";
		$text['wife'] = "Man¾elka";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "Nar.";
		$text['capaltbirthabbr'] = "Nar.";
		$text['capdeathabbr'] = "Zemø.";
		$text['capburialabbr'] = "Pohø.";
		$text['capplaceabbr'] = "v";
		$text['capmarrabbr'] = "Sò.";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Zobrazit s";
		$text['unknownlit'] = "Neznámý";
		$text['popupnote1'] = " = Dal¹í informace";
		$text['pedcompact'] = "Kompaktnì";
		$text['pedstandard'] = "Standardnì";
		$text['pedtextonly'] = "Pouze text";
		$text['descendfor'] = "Schéma potomkù osoby";
		$text['maxof'] = "Nejvíce";
		$text['gensatonce'] = "generací zobrazených najednou.";
		$text['sonof'] = "syn od";
		$text['daughterof'] = "dcera od";
		$text['childof'] = "dítì od";
		$text['stdformat'] = "Standardní formát";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Pøidat novou rodinu";
		$text['editfam'] = "Upravit rodinu";
		$text['side'] = "strana";
		$text['familyof'] = "Rodina";
		$text['paternal'] = "Otcova";
		$text['maternal'] = "Matèina";
		$text['gen1'] = "Vlastní";
		$text['gen2'] = "Rodièe";
		$text['gen3'] = "Prarodièe";
		$text['gen4'] = "Praprarodièe";
		$text['gen5'] = "3xprarodièe";
		$text['gen6'] = "4xprarodièe";
		$text['gen7'] = "5xprarodièe";
		$text['gen8'] = "6xprarodièe";
		$text['gen9'] = "7xprarodièe";
		$text['gen10'] = "8xprarodièe";
		$text['gen11'] = "9xprarodièe";
		$text['gen12'] = "10xprarodièe";
		$text['graphdesc'] = "Schéma potomkù a¾ do tohoto místa";
		$text['pedbox'] = "Rámeèek";
		$text['regformat'] = "Registr";
		$text['extrasexpl'] = "U této osoby existuje fotografie, vyprávìní nebo jiná mediální polo¾ka.";
		$text['popupnote3'] = " = Nové schéma";
		$text['mediaavail'] = "Média k dispozici";
		$text['pedigreefor'] = "Schéma pøedkù osoby";
		$text['pedigreech'] = "Schéma pøedkù";
		$text['datesloc'] = "Datumy a místa";
		$text['borchr'] = "Naroz/Køest - Úmrtí/Pohø (dva)";
		$text['nobd'] = "Bez dat narození nebo úmrtí";
		$text['bcdb'] = "Naroz/Køest/Úmrtí/Pohø (ètyøi)";
		$text['numsys'] = "Systém èíslování";
		$text['gennums'] = "Èísla generací";
		$text['henrynums'] = "Èíslování dle Henryho";
		$text['abovnums'] = "Èíslování dle d'Aboville";
		$text['devnums'] = "Èíslování dle de Villiers";
		$text['dispopts'] = "Mo¾nosti zobrazení";
		//added in 10.0.0
		$text['no_ancestors'] = "Nebyli nalezeni ¾ádní pøedkové";
		$text['ancestor_chart'] = "Svislé schéma pøedkù";
		$text['opennewwindow'] = "Otevøít v novém oknì";
		$text['pedvertical'] = "Svisle";
		//added in 11.0.0
		$text['familywith'] = "Rodina s";
		$text['fcmlogin'] = "Pro zobrazení podrobností se musíte pøihlásit";
		$text['isthe'] = "je";
		$text['otherspouses'] = "dal¹í partneøi/partnerky";
		$text['parentfamily'] = "Rodina rodièù ";
		$text['showfamily'] = "Zobrazit rodinu";
		$text['shown'] = "zobrazeno";
		$text['showparentfamily'] = "zobrazit rodinu rodièù";
		$text['showperson'] = "zobrazit osobu";
		//added in 11.0.2
		$text['otherfamilies'] = "Dal¹í rodiny";
		//added in 14.0
		$text['dtformat'] = "Tabulky";
		$text['dtchildren'] = "Dìti";
		$text['dtgrandchildren'] = "Vnouèata";
		$text['dtggrandchildren'] = "Pravnouèata";
		$text['dtgggrandchildren'] = "Pravnouèata"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Nejsou potomci";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Celkem";
		$text['dtselect'] = "Vybrat";
		$text['dteachfulltable'] = "Ka¾dá plná tabulky bude mít";
		$text['dtrows'] = "øádkù";
		$text['dtdisplayingtable'] = "Zobrazení tabulky";
		$text['dtgototable'] = "Pøejít na tabulku:";
		$text['fcinstrdn'] = "Zobrazit rodinu s partnerem";
		$text['fcinstrup'] = "Zobrazit rodinu s rodièi";
		$text['fcinstrplus'] = "Vybrat dal¹í partnery";
		$text['fcinstrfam'] = "Vybrat dal¹í rodièe";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "®ádný report neexistuje.";
		$text['reportname'] = "Název reportu";
		$text['allreports'] = "V¹echny reporty";
		$text['report'] = "Report";
		$text['error'] = "Chyba";
		$text['reportsyntax'] = "Syntaxe dotazu pro tento report";
		$text['wasincorrect'] = "byla chybná a report nemohl být vytvoøen. Kontaktujte prosím administrátora systému na";
		$text['errormessage'] = "Chybové hlá¹ení";
		$text['equals'] = "je";
		$text['endswith'] = "konèí na";
		$text['soundexof'] = "soundex";
		$text['metaphoneof'] = "metaphone of";
		$text['plusminus10'] = "+/- 10 rokù od";
		$text['lessthan'] = "ménì ne¾";
		$text['greaterthan'] = "více ne¾";
		$text['lessthanequal'] = "ménì nebo rovno";
		$text['greaterthanequal'] = "více nebo rovno";
		$text['equalto'] = "rovno";
		$text['tryagain'] = "Zkusit znovu";
		$text['joinwith'] = "Logika hledání";
		$text['cap_and'] = "A";
		$text['cap_or'] = "NEBO";
		$text['showspouse'] = "Zobrazit partnera (pokud mìla dotyèná osoba více partnerù, bude zobrazena vícekrát)";
		$text['submitquery'] = "Provést dotaz";
		$text['birthplace'] = "Místo narození";
		$text['deathplace'] = "Místo úmrtí";
		$text['birthdatetr'] = "Rok narození";
		$text['deathdatetr'] = "Rok úmrtí";
		$text['plusminus2'] = "+/- 2 roky od";
		$text['resetall'] = "Obnovit v¹echny hodnoty na výchozí";
		$text['showdeath'] = "Zobrazit informace o úmrtí/pohøbu";
		$text['altbirthplace'] = "Místo køtu";
		$text['altbirthdatetr'] = "Rok køtu";
		$text['burialplace'] = "Místo pohøbu";
		$text['burialdatetr'] = "Rok pohøbu";
		$text['event'] = "Událost(i)";
		$text['day'] = "Den";
		$text['month'] = "Mìsíc";
		$text['keyword'] = "Klíèové slovo (napø. \"Abt\")";
		$text['explain'] = "Pro zobrazení odpovídajících událostí zadejte datum. Pro zobrazení v¹ech událostí zanechte pole prázdné.";
		$text['enterdate'] = "Zadejte nebo zvolte alespoò jedno z následujících: Den, Mìsíc, Rok, Klíèové slovo";
		$text['fullname'] = "Celé jméno";
		$text['birthdate'] = "Datum narození";
		$text['altbirthdate'] = "Datum køtu";
		$text['marrdate'] = "Datum sòatku";
		$text['spouseid'] = "ID èíslo partnera";
		$text['spousename'] = "Jméno partnera";
		$text['deathdate'] = "Datum úmrtí";
		$text['burialdate'] = "Datum pohøbu";
		$text['changedate'] = "Datum poslední zmìny";
		$text['gedcom'] = "Strom";
		$text['baptdate'] = "CJKSpd datum køtu";
		$text['baptplace'] = "CJKSpd místo køtu";
		$text['endldate'] = "CJKSpd datum zaslíbení";
		$text['endlplace'] = "CJKSpd místo zaslíbení";
		$text['ssealdate'] = "CJKSpd datum peèetìní s partnerem";   //Sealed to spouse
		$text['ssealplace'] = "CJKSpd místo peèetìní s partnerem";
		$text['psealdate'] = "CJKSpd datum peèetìní s rodièi";   //Sealed to parents
		$text['psealplace'] = "CJKSpd místo peèetìní s rodièi";
		$text['marrplace'] = "Místo sòatku";
		$text['spousesurname'] = "Pøíjmení partnera";
		$text['spousemore'] = "Zapí¹ete-li pøíjmení partnera, musíte vybrat Pohlaví.";
		$text['plusminus5'] = "+/- 5 roku od";
		$text['exists'] = "existuje";
		$text['dnexist'] = "neexistuje";
		$text['divdate'] = "Datum rozvodu";
		$text['divplace'] = "Místo rozvodu";
		$text['otherevents'] = "Jiné události";
		$text['numresults'] = "Poèet výsledkù na stránce";
		$text['mysphoto'] = "Tajemné fotografie";
		$text['mysperson'] = "Hledané osoby";
		$text['joinor'] = "'Join with OR' mo¾nost nelze pou¾ít s pøíjmením partnera";
		$text['tellus'] = "Máte-li nìjaké informace, napi¹te nám";
		$text['moreinfo'] = "Více informací";
		//added in 8.0.0
		$text['marrdatetr'] = "Rok sòatku";
		$text['divdatetr'] = "Rok rozvodu";
		$text['mothername'] = "Jméno matky";
		$text['fathername'] = "Jméno otce";
		$text['filter'] = "Filtr";
		$text['notliving'] = "Zesnulí";
		$text['nodayevents'] = "Události v tomto mìsíci, které nejsou spojeny s urèitým dnem:";
		//added in 9.0.0
		$text['csv'] = "Soubor CSV oddìlený èárkami";
		//added in 10.0.0
		$text['confdate'] = "Datum biømování (CJKSpd)";
		$text['confplace'] = "Místo biømování (CJKSpd)";
		$text['initdate'] = "Datum zasvìcení (CJKSpd)";
		$text['initplace'] = "Místo zasvìcení (CJKSpd)";
		//added in 11.0.0
		$text['marrtype'] = "Typ sòatku";
		$text['searchfor'] = "Hledat";
		$text['searchnote'] = "Pozn.: Tato stránka pro vyhledání pou¾ívá Google. Poèet nalezených záznamù je pøímo ovlivnìn mírou, jakou má Google tyto stránky indexované.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Soubor záznamù pro";
		$text['mostrecentactions'] = "Nedávná aktivita";
		$text['autorefresh'] = "Automatické zobrazení (po 30 vteøinách)";
		$text['refreshoff'] = "Vypnout automatické zobrazení";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Høbitovy a náhrobky";
		$text['showallhsr'] = "Zobrazit v¹echny záznamy náhrobkù";
		$text['in'] = "v";
		$text['showmap'] = "Ukázat mapu";
		$text['headstonefor'] = "Náhrobek pro";
		$text['photoof'] = "Fotografie";
		$text['photoowner'] = "Vlastník originálu";
		$text['nocemetery'] = "Høbitov není uveden";
		$text['iptc005'] = "Název";
		$text['iptc020'] = "Podporované kategorie";
		$text['iptc040'] = "Zvlá¹tní instrukce";
		$text['iptc055'] = "Datum vytvoøení";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Autorova funkce";
		$text['iptc090'] = "Mìsto";
		$text['iptc095'] = "Kraj";
		$text['iptc101'] = "Zemì";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Nadpis";
		$text['iptc110'] = "Pramen";
		$text['iptc115'] = "Pramen fotografie";
		$text['iptc116'] = "Ve¹kerá práva vyhrazena";
		$text['iptc120'] = "Popis";
		$text['iptc122'] = "Popis vytvoøil";
		$text['mapof'] = "Mapa";
		$text['regphotos'] = "Zobrazení s popisem";
		$text['gallery'] = "Pouze náhledy";
		$text['cemphotos'] = "Obrázky høbitovù";
		$text['photosize'] = "Velikost";
        $text['iptc010'] = "Priorita";
		$text['filesize'] = "Velikost souboru";
		$text['seeloc'] = "Prohlédnete místo";
		$text['showall'] = "Zobrazit v¹e";
		$text['editmedia'] = "Upravit médium";
		$text['viewitem'] = "Prohlédnout tuto polo¾ku";
		$text['editcem'] = "Upravit høbitov";
		$text['numitems'] = "Poèet polo¾ek";
		$text['allalbums'] = "V¹echna alba";
		$text['slidestop'] = "Pozastavit prezentaci";
		$text['slideresume'] = "Pokraèovat v prezentaci";
		$text['slidesecs'] = "Poèet vteøin pro ka¾dý snímek:";
		$text['minussecs'] = "ubrat 0.5 vteøiny";
		$text['plussecs'] = "pøidat 0.5 vteøiny";
		$text['nocountry'] = "Neznámá zemì";
		$text['nostate'] = "Neznámý kraj";
		$text['nocounty'] = "Neznámý okres";
		$text['nocity'] = "Neznámé mìsto";
		$text['nocemname'] = "Neznámý høbitov";
		$text['editalbum'] = "Upravit album";
		$text['mediamaptext'] = "<strong>Pozn.:</strong> Posouváním ukazatele my¹i pøes obrázek zobrazíte popisky rùzných èástí obrázku. Zmìní-li se ukazatel my¹i na tvar vztyèeného ukazováku, mù¾ete kliknutím zobrazit stránku s podrobnostmi.";
		//added in 8.0.0
		$text['allburials'] = "V¹echny pohøby";
		$text['moreinfo'] = "Kliknìte pro více informací o obrázku";
		//added in 9.0.0
        $text['iptc025'] = "Klíèová slova";
        $text['iptc092'] = "Sub-location";
		$text['iptc015'] = "Kategorie";
		$text['iptc065'] = "Pùvodní program";
		$text['iptc070'] = "Verze programu";
		//added in 13.0
		$text['toggletags'] = "Pøepnout znaèky";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Zobrazit pøíjmení zaèínající na";
		$text['showtop'] = "Zobrazit prvních";
		$text['showallsurnames'] = "Zobrazit v¹echna pøíjmení";
		$text['sortedalpha'] = "seøazena podle abecedy";
		$text['byoccurrence'] = "seøazených podle èetnosti";
		$text['firstchars'] = "Zaèáteèní písmena";
		$text['mainsurnamepage'] = "Hlavní stránka pøíjmení";
		$text['allsurnames'] = "V¹echna pøíjmení";
		$text['showmatchingsurnames'] = "Kliknutím na pøíjmení zobrazíte odpovídající záznamy.";
		$text['backtotop'] = "Zpìt na zaèátek";
		$text['beginswith'] = "Zaèíná na";
		$text['allbeginningwith'] = "V¹echna pøíjmení zaèínající na";
		$text['numoccurrences'] = "celkový poèet míst v závorce";
		$text['placesstarting'] = "Zobrazit nejvýznamnìj¹í lokality, které zaèínají na";
		$text['showmatchingplaces'] = "Kliknutím na místo zobrazíte podrobnìj¹í lokality. Kliknutím na ikonu Hledat zobrazíte odpovídající osoby.";
		$text['totalnames'] = "celkem osob";
		$text['showallplaces'] = "Zobrazit v¹echny nejvýznamnìj¹í lokality";
		$text['totalplaces'] = "celkem míst";
		$text['mainplacepage'] = "Hlavní stránka míst";
		$text['allplaces'] = "V¹echny nejvýznamnìj¹í lokality";
		$text['placescont'] = "Zobrazit v¹echna místa obsahující";
		//changed in 8.0.0
		$text['top30'] = "Top xxx nejèastìji se vyskytujících pøíjmení";
		$text['top30places'] = "Top xxx nejvýznamnìj¹ích lokalit";
		//added in 12.0.0
		$text['firstnamelist'] = "Seznam køestních jmen";
		$text['firstnamesstarting'] = "Zobrazit køestní jména zaèínající na";
		$text['showallfirstnames'] = "Zobrazit v¹echna køestní jména";
		$text['mainfirstnamepage'] = "Hlavní stránka køestních jmen";
		$text['allfirstnames'] = "V¹echna køestní jména";
		$text['showmatchingfirstnames'] = "Kliknutím na køestní jméno zobrazíte odpovídající záznamy.";
		$text['allfirstbegwith'] = "V¹echna køestní jména zaèínající na";
		$text['top30first'] = "Top xxx nejèastìji se vyskytujících køestních jmen";
		$text['allothers'] = "V¹echna ostatní";
		$text['amongall'] = "(mezi v¹emi jmény)";
		$text['justtop'] = "Pouze Top xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(v posledních xx dnech)";

		$text['photo'] = "Fotografie";
		$text['history'] = "Vyprávìní/dokument";
		$text['husbid'] = "ID èíslo otce";
		$text['husbname'] = "Jméno otce";
		$text['wifeid'] = "ID èíslo matky";
		//added in 11.0.0
		$text['wifename'] = "Jméno matky";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Vymazat";
		$text['addperson'] = "Pøidat osobu";
		$text['nobirth'] = "Následující osoba nemá platné datum narození a nelze ji pøidat";
		$text['event'] = "Událost(i)";
		$text['chartwidth'] = "©íøka schématu";
		$text['timelineinstr'] = "Pøidat osoby";
		$text['togglelines'] = "Pøepnout zobrazení linek";
		//changed in 9.0.0
		$text['noliving'] = "Následující osoba je oznaèena jako ¾ijící nebo neveøejná a nelze ji pøidat, proto¾e nemáte patøièná pøístupová práva";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Prohlédnout v¹echny stromy";
		$text['treename'] = "Název stromu";
		$text['owner'] = "Majitel";
		$text['address'] = "Adresa";
		$text['city'] = "Mìsto";
		$text['state'] = "Kraj/provincie";
		$text['zip'] = "PSÈ";
		$text['country'] = "Zemì";
		$text['email'] = "Email";
		$text['phone'] = "Telefon";
		$text['username'] = "U¾ivatelské jméno";
		$text['password'] = "Heslo";
		$text['loginfailed'] = "Chyba pøihlá¹ení.";

		$text['regnewacct'] = "Registrace nového úètu";
		$text['realname'] = "Va¹e jméno a pøíjmení";
		$text['phone'] = "Telefon";
		$text['email'] = "Email";
		$text['address'] = "Adresa";
		$text['acctcomments'] = "Poznámky";
		$text['submit'] = "Odeslat";
		$text['leaveblank'] = "(zanechte toto pole prázdné, pokud ¾ádáte o nový strom)";
		$text['required'] = "Tyto údaje je nutné vyplnit";
		$text['enterpassword'] = "Zadejte heslo.";
		$text['enterusername'] = "Zadejte u¾ivatelské jméno.";
		$text['failure'] = "Zadané u¾ivatelské jméno je ji¾ vyhrazené. Stisknutím tlaèítka zpìt se vra»te na pøedchozí stránku a zvolte si jiné u¾ivatelské jméno";
		$text['success'] = "Va¹e registrace probìhla úspì¹nì. Administrátor systému vás bude informovat, kdy bude vá¹ úèet aktivován, nebo pokud budou potøeba dal¹í informace.";
		$text['emailsubject'] = "®ádost o novou registraci";
		$text['website'] = "Internetové stránky";
		$text['nologin'] = "Nemáte pøihla¹ovací údaje?";
		$text['loginsent'] = "Údaje byly odeslány";
		$text['loginnotsent'] = "Pøihla¹ovací údaje nebyly odeslány";
		$text['enterrealname'] = "Zadejte, prosím, své skuteèné jméno.";
		$text['rempass'] = "Zùstat pøihlá¹en na tomto poèítaèi";
		$text['morestats'] = "Dal¹í statistika";
		$text['accmail'] = "POZN.: Abyste mohli obdr¾et email od administrátora ohledne va¹eho úètu, zkontrolujte, prosím, ¾e vá¹ emailový program neblokuje emailové adresy z této domény.";
		$text['newpassword'] = "Nové heslo";
		$text['resetpass'] = "Obnovit heslo";
		$text['nousers'] = "Tento formuláø nelze pou¾ít, dokud nebude vytvoøen alespoò jeden záznam. Pokud jste majitelem tìchto stránek, jdìte do nabídky Admin/U¾ivatelé a vytvoøte si úèet administrátora.";
		$text['noregs'] = "Je nám líto, ale v souèasné dobì nepøijímáme nové registrace. Kontaktujte nás, prosím, pøímo, pokud máte nìjaké dotazy èi pøipomínky ohlednì tìchto webových stránek.";
		$text['emailmsg'] = "Byla vám zaslána nová ¾ádost o u¾ivatelský úèet TNG. Pøihlaste se, prosím, do administrátorského prostøedí a dejte novému úètu patøièná pøístupová práva.";
		$text['accactive'] = "Úcet byl aktivován, ale u¾ivatel nebude mít ¾ádná zvlá¹tní práva, dokud mu je nepøidìlíte.";
		$text['accinactive'] = "Nastavení úètu mù¾ete provést v Admin/U¾ivatelé/Pøezkoumat. Úèet zùstane neaktivní, dokud alespoò jednou záznam neupravíte a neulo¾íte.";
		$text['pwdagain'] = "Heslo znovu";
		$text['enterpassword2'] = "Prosím, vlo¾te znovu heslo.";
		$text['pwdsmatch'] = "Heslo neodpovídá. Prosím, zadejte stejné heslo do ka¾dého pole.";
		$text['acksubject'] = "Registrace"; //for a new user account
		$text['ackmessage'] = "Va¹e ¾ádost o u¾ivatelský úèet byla pøijata. Vá¹ úèet nebude aktivní, dokud nebude schválen administrátorem. O schválení budete informováni emailovou zprávou.";
		//added in 12.0.0
		$text['switch'] = "Prohodit";
		//added in 14.0
		$text['newpassword2'] = "Nové heslo znovu";
		$text['resetsuccess'] = "Úspìch: Heslo bylo obnoveno";
		$text['resetfail'] = "Selhání: Heslo nebylo obnoveno";
		$text['failreason0'] = " (neznámá chyba databáze)";
		$text['failreason2'] = " (nemáte oprávnìní ke zmìnì hesla)";
		$text['failreason3'] = " (hesla se neshodují)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Prohlédnout v¹echny vìtve";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Mno¾ství";
		$text['totindividuals'] = "Celkem osob";
		$text['totmales'] = "Celkem mu¾ù";
		$text['totfemales'] = "Celkem ¾en";
		$text['totunknown'] = "Celkem neurèeného pohlaví";
		$text['totliving'] = "Celkem ¾ijících";
		$text['totfamilies'] = "Celkem rodin";
		$text['totuniquesn'] = "Celkem jedineèných pøíjmení";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Celkem pramenù";
		$text['avglifespan'] = "Prùmìrná délka ¾ivota";
		$text['earliestbirth'] = "Nejdøíve narozený";
		$text['longestlived'] = "Osoby, které se do¾ily nejvy¹¹ího vìku";
		$text['days'] = "dní";
		$text['age'] = "Vìk";
		$text['agedisclaimer'] = "Výpoèty spojené s vìkem se zakládají na údajích osob s udaným datem narození <EM>a</EM> úmrtí.  Proto¾e jsou nìkterá data neúplná (napø. úmrtí je zaznamenáno pouze jako rok \"1945\" nebo \"pøed 1860\"), tyto výpoèty nemusí být 100% pøesné.";
		$text['treedetail'] = "Dal¹í informace o tomto stromu";
		$text['total'] = "Celkem";
		//added in 12.0
		$text['totdeceased'] = "Celkem zesnulých";
		//added in 14.0
		$text['totalsourcecitations'] = "Celkem citací pramenù";
		break;

	case "notes":
		$text['browseallnotes'] = "Prohlédnout v¹echny poznámky";
		break;

	case "help":
		$text['menuhelp'] = "Nápovìda nabídky";
		break;

	case "install":
		$text['perms'] = "V¹echna povolení byla nastavena.";
		$text['noperms'] = "Povolení nemohla být nastavena pro tyto soubory:";
		$text['manual'] = "Nastavte je prosím manuálnì.";
		$text['folder'] = "Slo¾ka";
		$text['created'] = "byla vytvoøena";
		$text['nocreate'] = "nemohla být vytvoøena. Zalo¾te ji, prosím, manuálnì.";
		$text['infosaved'] = "Informace ulo¾eny, spojení potvrzeno!";
		$text['tablescr'] = "Tabulky byly vytvoøeny!";
		$text['notables'] = "Následující tabulky nemohly být vytvoøeny:";
		$text['nocomm'] = "TNG nemù¾e navázat komunikaci s va¹í databází. ®ádné tabulky nebyly vytvoøeny.";
		$text['newdb'] = "Informace ulo¾eny, spojení potvrzeno, nová databáze byla vytvoøena:";
		$text['noattach'] = "Informace ulo¾eny. Spojení navázáno a databáze vytvoøena, ale TNG se k ní nemù¾e pøipojit.";
		$text['nodb'] = "Informace ulo¾eny. Spojení navázáno, ale databáze neexistuje a nemohla být vytvoøena. Ovìøte si, ¾e název databáze je správný anebo pou¾ijte ovládací panel a vytvoøte ji.";
		$text['noconn'] = "Informace ulo¾ena, ale spojení nebylo navázáno.  Nìkteré z následujích vìcí jsou chybné:";
		$text['exists'] = "existuje";
		$text['noop'] = "®ádná operace nebyla provedena.";
		//added in 8.0.0
		$text['nouser'] = "Úèet nebyl vytvoøen. U¾ivatelské jméno ji¾ zøejmì existuje.";
		$text['notree'] = "Strom nebyl vytvoøen. ID èíslo stromu zøejmì ji¾ existuje.";
		$text['infosaved2'] = "Informace ulo¾ena";
		$text['renamedto'] = "pøejmenován na";
		$text['norename'] = "nemohl být pøejmenován";
		//changed in 13.0.0
		$text['loginfirst'] = "Byly zji¹tìny existující záznamy u¾ivatelù. Chcete-li pokraèovat, musíte se nejprve pøihlásit nebo odebrat v¹echny záznamy z tabulky u¾ivatelù.";
		break;

	case "imgviewer":
		$text['magmode'] = "Re¾im zvìt¹ování";
		$text['panmode'] = "Re¾im sledování";
		$text['pan'] = "Je-li obrázek vìt¹í ne¾ okno prohlí¾eèe, obrázkem v oknì posunete kliknutím my¹í dovnitø obrázku a jejím dr¾ením a ta¾ením";
		$text['fitwidth'] = "Na celou ¹íøku";
		$text['fitheight'] = "Na celou vý¹ku";
		$text['newwin'] = "Nové okno";
		$text['opennw'] = "Otevøít obrázek v novém oknì";
		$text['magnifyreg'] = "Kliknutím my¹i dovnitø obrázku zvìt¹íte tuto èást obrázku";
		$text['imgctrls'] = "Zapnout ovládání obrázku";
		$text['vwrctrls'] = "Zapnout ovládání prohlí¾eèe obrázku";
		$text['vwrclose'] = "Zavøít prohlí¾eè obrázku";
		break;

	case "dna":
		$text['test_date'] = "Datum testu";
		$text['links'] = "Odpovídající odkazy";
		$text['testid'] = "ID testu";
		//added in 12.0.0
		$text['mode_values'] = "Hodnoty módu";
		$text['compareselected'] = "Porovnat vybrané";
		$text['dnatestscompare'] = "Porovnat testy Y-DNA";
		$text['keep_name_private'] = "Zachovat jméno neveøejné";
		$text['browsealltests'] = "Procházet v¹echny testy";
		$text['all_dna_tests'] = "V¹echny testy DNA";
		$text['fastmutating'] = "Rychlé mutace";
		$text['alltypes'] = "V¹echny typy";
		$text['allgroups'] = "V¹echny skupiny";
		$text['Ydna_LITbox_info'] = "Test(y) pøipojené k této osobì nemusí nutnì od této osoby pocházet.<br />Ve sloupci 'Haploskupina' se zobrazí data èervenì, pokud je výsledek 'Pøedpovìzen', nebo zelenì, pokud je test 'Potvrzen'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Porovnat vybrané testy mtDNA";
		$text['dnatestscompare_atdna'] = "Porovnat vybrané testy atDNA";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNP";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Zvlá¹tní mutace";
		$text['mrca'] = "Nejbli¾¹í spoleèný pøedek";
		$text['ydna_test'] = "Testy Y-DNA";
		$text['mtdna_test'] = "Testy mtDNA (mitochondriální)";
		$text['atdna_test'] = "Testy atDNA (autozomální)";
		$text['segment_start'] = "Zaèátek";
		$text['segment_end'] = "Konec";
		$text['suggested_relationship'] = "Navrhnuté";
		$text['actual_relationship'] = "Aktuální";
		$text['12markers'] = "Markery 1-12";
		$text['25markers'] = "Markery 13-25";
		$text['37markers'] = "Markery 26-37";
		$text['67markers'] = "Markery 38-67";
		$text['111markers'] = "Markery 68-111";
		//added in 13.1
		$text['comparemore'] = "Ke srovnání je tøeba vybrat alespoò dva testy.";
		break;
}

//common
$text['matches'] = "Záznamy";
$text['description'] = "Popis";
$text['notes'] = "Poznámky";
$text['status'] = "Stav";
$text['newsearch'] = "Nové hledání";
$text['pedigree'] = "Schéma pøedkù";
$text['seephoto'] = "Prohlédnout fotografii";
$text['andlocation'] = "& místo";
$text['accessedby'] = "záznam prohlí¾el";
$text['children'] = "Dìti";  //from getperson
$text['tree'] = "Strom";
$text['alltrees'] = "V¹echny stromy";
$text['nosurname'] = "[bez pøíjmení]";
$text['thumb'] = "Náhled";  //as in Thumbnail
$text['people'] = "Lidé";
$text['title'] = "Titul";  //from getperson
$text['suffix'] = "Pøípona";  //from getperson
$text['nickname'] = "Pøezdívka";  //from getperson
$text['lastmodified'] = "Poslední zmìna";  //from getperson
$text['married'] = "Sòatek";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Jméno"; //from showmap
$text['lastfirst'] = "Pøíjmení, jméno";  //from search
$text['bornchr'] = "Narození/Køest";  //from search
$text['individuals'] = "Osoby";  //from whats new
$text['families'] = "Rodiny";
$text['personid'] = "ID èíslo osoby";
$text['sources'] = "Prameny";  //from getperson (next several)
$text['unknown'] = "Neznámé";
$text['father'] = "Otec";
$text['mother'] = "Matka";
$text['christened'] = "Køest";
$text['died'] = "Úmrtí";
$text['buried'] = "Pohøeb";
$text['spouse'] = "Partner";  //from search
$text['parents'] = "Rodièe";  //from pedigree
$text['text'] = "Text";  //from sources
$text['language'] = "Jazyk";  //from languages
$text['descendchart'] = "Schéma potomkù";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Osoba";
$text['edit'] = "Upravit";
$text['date'] = "Datum";
$text['login'] = "Pøihlá¹ení";
$text['logout'] = "Odhlá¹ení";
$text['groupsheet'] = "Schéma rodiny";
$text['text_and'] = "a";
$text['generation'] = "Generace";
$text['filename'] = "Název souboru";
$text['id'] = "ID èíslo";
$text['search'] = "Hledat";
$text['user'] = "U¾ivatel";
$text['firstname'] = "Jméno";
$text['lastname'] = "Pøíjmení";
$text['searchresults'] = "Výsledky hledání";
$text['diedburied'] = "Úmrtí/Pohøeb";
$text['homepage'] = "Domovská stránka";
$text['find'] = "Najít (osobu)";
$text['relationship'] = "Pøíbuzenský vztah";		//in German, Verwandtschaft
$text['relationship2'] = "Vztah"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Èasová linie";
$text['yesabbr'] = "A";               //abbreviation for 'yes'
$text['divorced'] = "Rozvod";
$text['indlinked'] = "Spojeno s";
$text['branch'] = "Vìtev";
$text['moreind'] = "Dal¹í osoby";
$text['morefam'] = "Dal¹í rodiny";
$text['surnamelist'] = "Seznam pøíjmení";
$text['generations'] = "Generací";
$text['refresh'] = "Obnovit";
$text['whatsnew'] = "Co je nového";
$text['reports'] = "Reporty";
$text['placelist'] = "Seznam míst";
$text['baptizedlds'] = "Køest (CJKSpd)";
$text['endowedlds'] = "Obdarován (CJKSpd)";
$text['sealedplds'] = "Peèetìn R (CJKSpd)";
$text['sealedslds'] = "Peèetìn P (CJKSpd)";
$text['ancestors'] = "Pøedkové";
$text['descendants'] = "Potomci";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum posledního importu souboru GEDCOM";
$text['type'] = "Druh";
$text['savechanges'] = "Ulo¾it zmìny";
$text['familyid'] = "ID èíslo rodiny";
$text['headstone'] = "Náhrobky";
$text['historiesdocs'] = "Vyprávìní";
$text['anonymous'] = "anonymní";
$text['places'] = "Místa";
$text['anniversaries'] = "Data a výroèí";
$text['administration'] = "Administrace";
$text['help'] = "Nápovìda";
//$text['documents'] = "Documents";
$text['year'] = "Rok";
$text['all'] = "V¹e";
$text['address'] = "Adresa";
$text['suggest'] = "Navrhnout";
$text['editevent'] = "Navrhnout zmìnu pro tuto událost";
$text['morelinks'] = "Více odkazù";
$text['faminfo'] = "Informace o rodinì";
$text['persinfo'] = "Osobní informace";
$text['srcinfo'] = "Informace o pramenu";
$text['fact'] = "Událost";
$text['goto'] = "Zvolte stránku";
$text['tngprint'] = "Tisk";
$text['databasestatistics'] = "Statistika databáze"; //needed to be shorter to fit on menu
$text['child'] = "Dítì";  //from familygroup
$text['repoinfo'] = "Údaje o úlo¾i¹ti";
$text['tng_reset'] = "Obnovit";
$text['noresults'] = "®ádné výsledky nebyly nalezeny";
$text['allmedia'] = "V¹echna média";
$text['repositories'] = "Úlo¾i¹tì pramenù";
$text['albums'] = "Alba";
$text['cemeteries'] = "Høbitovy";
$text['surnames'] = "Pøíjmení";
$text['dates'] = "Data";
$text['link'] = "Odkaz";
$text['media'] = "Média";
$text['gender'] = "Pohlaví";
$text['latitude'] = "©íøka";
$text['longitude'] = "Délka";
$text['bookmarks'] = "Zálo¾ky";
$text['bookmark'] = "Pøidat zálo¾ku";
$text['mngbookmarks'] = "Zobrazit zálo¾ky";
$text['bookmarked'] = "Zálo¾ka pøidána";
$text['remove'] = "Odebrat";
$text['find_menu'] = "Najít";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Høbitov";
$text['gmapevent'] = "Mapa událostí";
$text['gevents'] = "Událost";
$text['googleearthlink'] = "Odkaz na Google Earth";
$text['googlemaplink'] = "Odkaz na Google Maps";
$text['gmaplegend'] = "Legenda";
$text['unmarked'] = "Neoznaèené";
$text['located'] = "Nacházející se";
$text['albclicksee'] = "Kliknutím zobrazit v¹echny polo¾ky v tomto albu";
$text['notyetlocated'] = "Dosud nenalezen";
$text['cremated'] = "Zpopelnìn";
$text['missing'] = "Chybìjící";
$text['pdfgen'] = "Generátor PDF";
$text['blank'] = "Prázdné schéma";
$text['fonts'] = "Font";
$text['header'] = "Hlavièka";
$text['data'] = "Data";
$text['pgsetup'] = "Nastavení stránky";
$text['pgsize'] = "Velikost stránky";
$text['orient'] = "Orientace"; //for a page
$text['portrait'] = "Na vý¹ku";
$text['landscape'] = "Na ¹íøku";
$text['tmargin'] = "Horní okraj";
$text['bmargin'] = "Spodní okraj";
$text['lmargin'] = "Levý okraj";
$text['rmargin'] = "Pravý okraj";
$text['createch'] = "Vytvoøit schéma";
$text['prefix'] = "Pøedpona";
$text['mostwanted'] = "Hledá se";
$text['latupdates'] = "Poslední aktuality";
$text['featphoto'] = "Hlavní fotografie";
$text['news'] = "Novinky";
$text['ourhist'] = "Na¹e rodinná historie";
$text['ourhistanc'] = "Historie a pøedkové na¹í rodiny";
$text['ourpages'] = "Genealogické stránky na¹í rodiny";
$text['pwrdby'] = "Tyto stránky bì¾í na";
$text['writby'] = "vytvoøil";
$text['searchtngnet'] = "Prohledat TNG Network (GENDEX)";
$text['viewphotos'] = "Prohlédnout v¹echny fotografie";
$text['anon'] = "Souèasnì jste anonymní";
$text['whichbranch'] = "Ze které vìtve jste?";
$text['featarts'] = "Nejzajímavìj¹í èlánky";
$text['maintby'] = "Systém spravuje";
$text['createdon'] = "Vytvoøeno";
$text['reliability'] = "Vìrohodnost";
$text['labels'] = "Popisky";
$text['inclsrcs'] = "Zahrnout prameny";
$text['cont'] = "(pokraè.)"; //abbreviation for continued
$text['mnuheader'] = "Domovská stránka";
$text['mnusearchfornames'] = "Hledat";
$text['mnulastname'] = "Pøíjmení";
$text['mnufirstname'] = "Jméno";
$text['mnusearch'] = "Hledat";
$text['mnureset'] = "Zaèít znovu";
$text['mnulogon'] = "Pøihlá¹ení";
$text['mnulogout'] = "Odhlá¹ení";
$text['mnufeatures'] = "Dal¹í mo¾nosti";
$text['mnuregister'] = "Registrace nového úètu";
$text['mnuadvancedsearch'] = "Roz¹íøené hledání";
$text['mnulastnames'] = "Pøíjmení";
$text['mnustatistics'] = "Statistika";
$text['mnuphotos'] = "Fotografie";
$text['mnuhistories'] = "Vyprávìní";
$text['mnumyancestors'] = "Fotografie &amp; vyprávìní pro pøedky od [Person]";
$text['mnucemeteries'] = "Høbitovy";
$text['mnutombstones'] = "Náhrobky";
$text['mnureports'] = "Reporty";
$text['mnusources'] = "Prameny";
$text['mnuwhatsnew'] = "Co je nového";
$text['mnushowlog'] = "Záznam pøístupù";
$text['mnulanguage'] = "Zmìna jazyka";
$text['mnuadmin'] = "Administrace";
$text['welcome'] = "Vítejte";
$text['contactus'] = "Napi¹te nám";
//changed in 8.0.0
$text['born'] = "Narození";
$text['searchnames'] = "Hledat osoby";
//added in 8.0.0
$text['editperson'] = "Upravit Osoby";
$text['loadmap'] = "Nahrát mapu";
$text['birth'] = "Narození";
$text['wasborn'] = "se narodil(a)";
$text['startnum'] = "První èíslo";
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
$text['anddied'] = "zemøel(a)";
//added in 9.0.0
$text['share'] = "Sdílet";
$text['hide'] = "Skrýt";
$text['disabled'] = "Vá¹ u¾ivatelský úèet byl zablokován.  Kontaktujte, prosím, administrátora.";
$text['contactus_long'] = "Pokud máte nìjaké dotazy nebo pøipomínky ohlednì informací na tìchto stránkách, nebo byste mìli zájem spolupracovat na dal¹ím výzkumu, pøípadnì poskytnout dal¹í informace, neváhejte a <span class=\"emphasis\"><a href=\"suggest.php\">kontaktujte mì</a></span>.";
$text['features'] = "Zajímavosti";
$text['resources'] = "Zdroje";
$text['latestnews'] = "Poslední novinky";
$text['trees'] = "Stromy";
$text['wasburied'] = "byl(a) pohøben(a)";
//moved here in 9.0.0
$text['emailagain'] = "Email znovu";
$text['enteremail2'] = "Zadejte, prosím, znovu va¹i emailovou adresu.";
$text['emailsmatch'] = "Zadané emailové adresy nesouhlasí. Zadejte stejnou emailovou adresu do obou polí.";
$text['getdirections'] = "Kliknìte pro podrobnosti";
$text['calendar'] = "Kalendáø";
//changed in 9.0.0
$text['directionsto'] = " to the ";
$text['slidestart'] = "Zahájit prezentaci";
$text['livingnote'] = "S touto poznámkou je spojena alespoò jedna ¾ijící osoba - podrobnosti nejsou zveøejnìny.";
$text['livingphoto'] = "S touto polo¾kou je spojena alespoò jedna ¾ijící osoba nebo osoba oznaèená jako neveøejná - podrobnosti nejsou zveøejnìny.";
$text['waschristened'] = "byl(a) pokøtìn(a)";
//added in 10.0.0
$text['branches'] = "Vìtve";
$text['detail'] = "Detail";
$text['moredetail'] = "Více detailù";
$text['lessdetail'] = "Ménì detailù";
$text['conflds'] = "Biømován (CJKSpd)";
$text['initlds'] = "Zasvìcen (CJKSpd)";
$text['wascremated'] = "byl(a) zpopelnìn(a)";
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
$text['remnums'] = "Vymazat èísla a ¹pendlíky";
$text['photoshistories'] = "Fotografie &amp; Vyprávìní";
$text['familychart'] = "Graf rodiny";
//added in 12.0.0
$text['firstnames'] = "Køestní jména";
//moved here in 12.0.0
$text['dna_test'] = "Test DNA";
$text['test_type'] = "Typ testu";
$text['test_info'] = "Informace o testu";
$text['takenby'] = "Testovaná osoba";
$text['haplogroup'] = "Haploskupina";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevantní odkazy";
$text['nofirstname'] = "[¾ádné køestní jméno]";
//added in 12.0.1
$text['cookieuse'] = "Poznámka: Tyto internetové stránky pou¾ívají cookies.";
$text['dataprotect'] = "Ochrana osobních údajù";
$text['viewpolicy'] = "Zobrazit zásady";
$text['understand'] = "Rozumím";
$text['consent'] = "Souhlasím s ulo¾ením a zpracováním osobních údajù. Vlastníka tìchto internetových stránek mohu kdykoli po¾ádat, aby tyto informace odstranil.";
$text['consentreq'] = "Uveïte svùj souhlas k ukládání osobních údajù na tomto webu.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Rychlé odkazy";
$text['yourname'] = "Va¹e jméno";
$text['youremail'] = "Va¹e emailová adresa";
$text['liketoadd'] = "Jakékoli informace, které chcete pøidat";
$text['webmastermsg'] = "Zpráva webmastera";
$text['gallery'] = "Zobrazit galerii";
$text['wasborn_male'] = "se narodil";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "se narodila"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "byl pokøtìn";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "byla pokøtìna";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "zemøel";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "zemøela";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "byl pohøbena"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "byla pohøbena"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "byl zpopelnìn";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "byla zpopelnìna";	// same as $text['wascremated'] if no gender verb
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
$text['visitor'] = "Náv¹tìvník";

$text['popupnote2'] = " = Nové schéma pøedkù";

//moved here in 14.0
$text['zoomin'] = "Zvìt¹it";
$text['zoomout'] = "Zmen¹it";
$text['scrollnote'] = "Pøeta¾ením nebo posunutím zobrazíte z grafu více.";
$text['general'] = "Obecnì";

//changed in 14.0
$text['otherevents'] = "Jiné události";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Spojení";
$text['continue'] = "Pokraèovat";
$text['title2'] = "Titul"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>