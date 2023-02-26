<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Søg i alle kilder";
		$text['shorttitle'] = "Titel";
		$text['callnum'] = "Nummer";
		$text['author'] = "Forfatter";
		$text['publisher'] = "Udgiver";
		$text['other'] = "Andre oplysninger";
		$text['sourceid'] = "Kilde-ID";
		$text['moresrc'] = "Flere kilder";
		$text['repoid'] = "Arkiv-ID";
		$text['browseallrepos'] = "Søg i alle arkiver";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nyt sprog";
		$text['changelanguage'] = "Skift sprog";
		$text['languagesaved'] = "Sproget er gemt";
		$text['sitemaint'] = "Webstedet opdateres i øjeblikket";
		$text['standby'] = "Webstedet er ikke tilgængelig i øjeblikket pga. opdatering. Prøv igen om nogle minutter. <a href=\"suggest.php\">Kontakt webstedets administrator,</a> hvis siden er nede i længere tid.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM begynder med";
		$text['producegedfrom'] = "Opret en GEDCOM-fil fra";
		$text['numgens'] = "Antal generationer";
		$text['includelds'] = "Inkluder SDH-oplysninger";
		$text['buildged'] = "Opret GEDCOM";
		$text['gedstartfrom'] = "GEDCOM begynder med";
		$text['nomaxgen'] = "Angiv antal generationer. Brug Tilbage-tasten for at rette fejlen";
		$text['gedcreatedfrom'] = "GEDCOM oprettet fra";
		$text['gedcreatedfor'] = "GEDCOM oprettet for";
		$text['creategedfor'] = "Opret GEDCOM for";
		$text['email'] = "mailadresse";
		$text['suggestchange'] = "Foreslå en ændring";
		$text['yourname'] = "Dit navn";
		$text['comments'] = "Bemærkninger og kommentarer";
		$text['comments2'] = "Bemærkninger";
		$text['submitsugg'] = "Send forslag";
		$text['proposed'] = "Foreslået ændring";
		$text['mailsent'] = "Tak. Beskeden er sendt.";
		$text['mailnotsent'] = "Beklager, men beskeden kunne ikke leveres. Kontakt xxx direkte på yyy.";
		$text['mailme'] = "Send en kopi til denne mailadresse";
		$text['entername'] = "Skriv dit navn";
		$text['entercomments'] = "Skriv dine bemærkninger";
		$text['sendmsg'] = "Send meddelelse";
		//added in 9.0.0
		$text['subject'] = "Emne";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Billeder og fortællinger for";
		$text['indinfofor'] = "Individuelle oplysninger om";
		$text['pp'] = "pp."; //page abbreviation
		$text['age'] = "Alder";
		$text['agency'] = "Firma";
		$text['cause'] = "Årsag";
		$text['suggested'] = "Foreslået";
		$text['closewindow'] = "Luk dette vindue";
		$text['thanks'] = "Tak";
		$text['received'] = "Forslaget er videresendt.";
		$text['indreport'] = "Personrapport";
		$text['indreportfor'] = "Personrapport for ";
		$text['bkmkvis'] = "<strong>Note:</strong> Disse bogmærker er kun synlige på denne PC og i denne browser.";
        //added in 9.0.0
		$text['reviewmsg'] = "Du har foreslået en ændring, som skal tjekkes. Indsendelsen vedrører:";
        $text['revsubject'] = "Foreslået ændring skal godkendes";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Slægtskabsberegner";
		$text['findrel'] = "Find slægtskab";
		$text['person1'] = "Person 1:";
		$text['person2'] = "Person 2:";
		$text['calculate'] = "Beregn";
		$text['select2inds'] = "Vælg to personer.";
		$text['findpersonid'] = "Find person-ID";
		$text['enternamepart'] = "indtast del af for- og/eller efternavn";
		$text['pleasenamepart'] = "Indtast del af for- eller efternavn.";
		$text['clicktoselect'] = "klik for at vælge";
		$text['nobirthinfo'] = "Ingen fødselsoplysninger";
		$text['relateto'] = "Slægtskab til";
		$text['sameperson'] = "De to personer er én og samme person.";
		$text['notrelated'] = "De to personer er ikke i slægt med hinanden indenfor xxx generationer."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "For at vise slægtskabet mellem to personer, skal man bruge 'Find'-knapperne nedenfor for at finde de aktuelle personer (eller behold de viste personer), derefter klikkes på 'Beregn'.";
		$text['sometimes'] = "(Nogle gange får man et andet resultat ved at søge et andet antal generationer.)";
		$text['findanother'] = "Find et andet slægtskab";
		$text['brother'] = "bror til";
		$text['sister'] = "søster til";
		$text['sibling'] = "bror/søster";
		$text['uncle'] = "xxx onkel til";
		$text['aunt'] = "xxx tante til";
		$text['uncleaunt'] = "xxx onkel/tante til";
		$text['nephew'] = "xxx nevø til";
		$text['niece'] = "xxx niece til";
		$text['nephnc'] = "xxx nevø/niece til";
		$text['removed'] = "gange forskudt";
		$text['rhusband'] = "ægtemand til ";
		$text['rwife'] = "hustru til ";
		$text['rspouse'] = "ægtefælle til ";
		$text['son'] = "søn af";
		$text['daughter'] = "datter af";
		$text['rchild'] = "barn af";
		$text['sil'] = "svigersøn til";
		$text['dil'] = "svigerdatter til";
		$text['sdil'] = "svigerdatter eller -søn til";
		$text['gson'] = "xxx barnebarn af";
		$text['gdau'] = "xxx barnebarn af";
		$text['gsondau'] = "xxx barnebarn af";
		$text['great'] = "olde";
		$text['spouses'] = "er ægtefæller";
		$text['is'] = "er";
		$text['changeto'] = "Skift til: (Indtast ID)";
		$text['notvalid'] = "er ikke et gyldigt person-ID eller eksisterer ikke i denne database. Prøv igen.";
		$text['halfbrother'] = "halvbror til";
		$text['halfsister'] = "halvsøster til";
		$text['halfsibling'] = "halvsøskende til";
		//changed in 8.0.0
        $text['gencheck'] = "Maks. antal generationer,<br />der skal tjekkes";
        $text['mcousin'] = "xxx fætter yyy til";  //male cousin; xxx = cousin number, yyy = times removed
        $text['fcousin'] = "xxx kusine yyy til";  //female cousin
        $text['cousin'] = "xxx fætter/kusine yyy til";
        $text['mhalfcousin'] = "xxx halvfætter yyy til";  //male cousin
        $text['fhalfcousin'] = "xxx halvkusine yyy til";  //female cousin
        $text['halfcousin'] = "xxx halvfætter eller halvkusine yyy til";
		//added in 8.0.0
		$text['oneremoved'] = "en gang forskudt";
		$text['gfath'] = "den xxx bedstefar til";
		$text['gmoth'] = "den xxx bedstemor til";
		$text['gpar'] = "den xxx bedsteforælder til";
		$text['mothof'] = "mor til";
		$text['fathof'] = "far til";
		$text['parof'] = "forælder til";
		$text['maxrels'] = "Maks. antal slægtskaber, der skal vises";
		$text['dospouses'] = "Vis slægtskaber, der involverer ægtefælle";
		$text['rels'] = "Slægtskaber";
		$text['dospouses2'] = "Vis ægtefæller";
		$text['fil'] = "svigerfar til";
		$text['mil'] = "svigermor til";
		$text['fmil'] = "svigerfar/-mor til";
		$text['stepson'] = "stedsøn til";
		$text['stepdau'] = "steddatter til";
		$text['stepchild'] = "stedbarn til";
		$text['stepgson'] = "den xxx stedsøns barn til";
		$text['stepgdau'] = "den xxx steddatters barn til";
		$text['stepgchild'] = "den xxx sted-barnebarn af";
		//added in 8.1.1
		$text['ggreat'] = "olde";
		//added in 8.1.2
		$text['ggfath'] = "xxx oldefar til";
		$text['ggmoth'] = "xxx oldemor til";
		$text['ggpar'] = "xxx oldeforældre til";
		$text['ggson'] = "xxx oldebarn af";
		$text['ggdau'] = "xxx oldebarn af";
		$text['ggsondau'] = "xxx oldebarn af";
		$text['gstepgson'] = "xxx stedoldebarn af";
		$text['gstepgdau'] = "xxx stedoldebarn af";
		$text['gstepgchild'] = "xxx stedoldebarn af";
		$text['guncle'] = "xxx grandonkel til";
		$text['gaunt'] = "xxx grantante til";
		$text['guncleaunt'] = "xxx grandonkel / grandtante til";
		$text['gnephew'] = "xxx grandnevø af";
		$text['gniece'] = "xxx grandniece af";
		$text['gnephnc'] = "xxx grandnevø / grandniece af";
		//added in 14.0
		$text['pathscalc'] = "Søg efter forbindelser";
		$text['findrel2'] = "Find slægtskaber og andre forbindelser";
		$text['makeme2nd'] = "Brug mit ID";
		$text['usebookmarks'] = "Brug bogmærker";
		$text['select2inds'] = "Vælg to personer.";
		$text['indinfofor'] = "Individual info for";
		$text['nobookmarks'] = "Der er ikke fundet nogen bogmærker";
		$text['bkmtitle'] = "Personer fundet i bogmærker";
		$text['bkminfo'] = "Vælg en person:";
		$text['sortpathsby'] = "Sortér stier efter antal af";
		$text['sortbyshort'] = "Sortér efter";
		$text['bylengthshort'] = "Længde";
		$text['badID1'] = ": forkert person1 ID - gå tilbage og ret";
		$text['badID2'] = ": forkert person2 ID - gå tilbage og ret";
		$text['notintree'] = ": personen med dette ID er ikke i dette træs database.";
		$text['sameperson'] = "De to personer er én og samme person.";;
		$text['nopaths'] = "Der er ingen forbindelse mellem disse personer.";
		$text['nopaths1'] = "Der er ingen forbindelser kortere end xxx";
		$text['nopaths2'] = "i xxx søge trin";
		$text['longestpath'] = "(længste sti tjekket var xxx trin lang)";
		$text['relevantpaths'] = "Antallet af forskellige relevante stier: xxx";
		$text['skipMarr'] = "(antal af stier, der ikke er vist på grund af for mange ægteskaber: xxx)";
		$text['mjaor'] = "eller";
		$text['connectionsto'] = "Forbindelser til ";
		$text['findanotherpers'] = "Find en anden person...";
		$text['sometimes'] = "(Nogle gange får man et andet resultat ved at søge et andet antal generationer.)";
		$text['anotherpath'] = "Søg efter andre forbindelser";
		$text['xpath'] = "Sti ";
		$text['primary'] = "Start Person"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Slut Person";
		$text['parent'] = "Forældre";
		$text['mhfather'] = "hans far";
		$text['mhmother'] = "hans mor";
		$text['mhhusband'] = "hans mand";
		$text['mhwife'] = "hans kone";
		$text['mhson'] = "hans søn";
		$text['mhdaughter'] = "hans datter";
		$text['fhfather'] = "hendes far";
		$text['fhmother'] = "hendes mor";
		$text['fhhusband'] = "hendes mand";
		$text['fhwife'] = "hendes kone";
		$text['fhson'] = "hendes søn";
		$text['fhdaughter'] = "hendes datter";
		$text['hfather'] = "far";
		$text['hmother'] = "mor";
		$text['hhusband'] = "mand";
		$text['hwife'] = "kone";
		$text['hson'] = "søn";
		$text['hdaughter'] = "datter";
		$text['maxruns'] = "Maks. antal stier, der skal tjekkes";
		$text['maxrshort'] = "Maks. antal stier";
		$text['maxlength'] = "Forbindelsesstien ikke længere end";
		$text['maxlshort'] = "Maks. længde";
		$text['xstep'] = "trin";
		$text['xsteps'] = "trin";
		$text['xmarriages'] = "xxx ægteskaber";
		$text['xmarriage'] = "1 ægteskab";
		$text['showspouses'] = "Vis begge ægtefæller";
		$text['showTxt'] = "Vis stibeskrivelse";
		$text['showTxtshort'] = "Beskriv.";
		$text['compactBox'] = "Vis kompakte personkasser";
		$text['compactBoxshort'] = "Kompakte kasser";
		$text['paths'] = "Stier";
		$text['dospouses2'] = "Vis ægtefæller";
		$text['maxmopt'] = " Maks. ægteskaber pr. forbindelse ";
		$text['maxm'] = " Maks. antal ægteskaber";
		$text['arerelated'] = "Disse personer er beslægtede - deres slægtskab er vist i sti 1";
		$text['simplerel'] = "Enkel slægtskabs søgning";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Familieskema for";
		$text['ldsords'] = "SDH ordinancer";
		$text['baptizedlds'] = "Døbt (SDH)";
		$text['endowedlds'] = "Begavet (SDH)";
		$text['sealedplds'] = "Beseglet F (SDH)";
		$text['sealedslds'] = "Beseglet Æ (SDH)";
		$text['otherspouse'] = "Andre partnere";
		$text['husband'] = "Far";
		$text['wife'] = "Mor";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "F";
		$text['capaltbirthabbr'] = "Dbt";
		$text['capdeathabbr'] = "D";
		$text['capburialabbr'] = "B";
		$text['capplaceabbr'] = "S";
		$text['capmarrabbr'] = "G";
		$text['capspouseabbr'] = "BTÆ";
		$text['redraw'] = "Tegn igen";
		$text['unknownlit'] = "Ukendt";
		$text['popupnote1'] = " = Tillægsoplysninger";
		$text['pedcompact'] = "Kompakt";
		$text['pedstandard'] = "Standard";
		$text['pedtextonly'] = "Kun tekst";
		$text['descendfor'] = "Efterkommere af";
		$text['maxof'] = "Maksimum";
		$text['gensatonce'] = "generationer vist samtidig.";
		$text['sonof'] = "søn af";
		$text['daughterof'] = "datter af";
		$text['childof'] = "barn af";
		$text['stdformat'] = "Standardformat";
		$text['ahnentafel'] = "Anetavle";
		$text['addnewfam'] = "Tilføj ny familie";
		$text['editfam'] = "Redigér familie";
		$text['side'] = "Side";
		$text['familyof'] = "Familie til";
		$text['paternal'] = "Far";
		$text['maternal'] = "Mor";
		$text['gen1'] = "Selv";
		$text['gen2'] = "Forældre";
		$text['gen3'] = "Bedsteforældre";
		$text['gen4'] = "Oldeforældre";
		$text['gen5'] = "Tipoldeforældre";
		$text['gen6'] = "Tiptip-oldeforældre";
		$text['gen7'] = "3xtip-oldeforældre";
		$text['gen8'] = "4xtip-oldeforældre";
		$text['gen9'] = "5xtip-oldeforældre";
		$text['gen10'] = "6xtip-oldeforældre";
		$text['gen11'] = "7xtip-oldeforældre";
		$text['gen12'] = "8xtip-oldeforældre";
		$text['graphdesc'] = "Efterkommere til dette punkt";
		$text['pedbox'] = "Felt";
		$text['regformat'] = "Register";
		$text['extrasexpl'] = "Hvis der eksisterer billeder eller fortællinger for de følgende personer, vil tilhørende ikoner blive vist ved siden af navnene.";
		$text['popupnote3'] = " = Ny tavle";
		$text['mediaavail'] = "Tilgængelige medier";
		$text['pedigreefor'] = "Aner til";
		$text['pedigreech'] = "Anetavle";
		$text['datesloc'] = "Datoer og steder";
		$text['borchr'] = "Fødsel/Alt - Død/Begravelse (to)";
		$text['nobd'] = "Ingen fødsels- eller dødsdatoer";
		$text['bcdb'] = "Fødsel/Alt/Død/Begravelse (fire)";
		$text['numsys'] = "Nummersystem";
		$text['gennums'] = "Generationsnumre";
		$text['henrynums'] = "Henry numre";
		$text['abovnums'] = "d'Aboville numre";
		$text['devnums'] = "de Villiers numre";
		$text['dispopts'] = "Vis mulighederne";
		//added in 10.0.0
		$text['no_ancestors'] = "Ingen aner fundet";
		$text['ancestor_chart'] = "Lodret anetavle";
		$text['opennewwindow'] = "Åbn i et nyt vindue";
		$text['pedvertical'] = "Lodret";
		//added in 11.0.0
		$text['familywith'] = "Familie med";
		$text['fcmlogin'] = "Log ind for at se flere oplysninger";
		$text['isthe'] = "er den";
		$text['otherspouses'] = "andre partnere";
		$text['parentfamily'] = "Den biologiske familie ";
		$text['showfamily'] = "Vis familie";
		$text['shown'] = "vist";
		$text['showparentfamily'] = "vis den biologiske familie";
		$text['showperson'] = "vis person";
		//added in 11.0.2
		$text['otherfamilies'] = "Andre familier";
		//added in 14.0
		$text['dtformat'] = "Tabeller";
		$text['dtchildren'] = "Børn";
		$text['dtgrandchildren'] = "Børnebørn";
		$text['dtggrandchildren'] = "Oldebørn";
		$text['dtgggrandchildren'] = "Oldebørn"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Ingen efterkommere";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Total";
		$text['dtselect'] = "Vælg";
		$text['dteachfulltable'] = "Hver fuld tabel vil have";
		$text['dtrows'] = "rækker";
		$text['dtdisplayingtable'] = "Viser tabel";
		$text['dtgototable'] = "Gå til tabel:";
		$text['fcinstrdn'] = "Vis familie med partner";
		$text['fcinstrup'] = "Vis familie med forældre";
		$text['fcinstrplus'] = "Vælg partner";
		$text['fcinstrfam'] = "Vælg forældre";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Der er ingen rapporter.";
		$text['reportname'] = "Rapportnavn";
		$text['allreports'] = "Alle rapporter";
		$text['report'] = "Rapport";
		$text['error'] = "Fejl";
		$text['reportsyntax'] = "Syntaxen for forespørgslen kører i denne rapport";
		$text['wasincorrect'] = "var forkert, og rapporten kunne ikke oprettes. Kontakt administratoren på";
		$text['errormessage'] = "Fejlmelding";
		$text['equals'] = "lig med";
		$text['endswith'] = "ender med";
		$text['soundexof'] = "soundex af";
		$text['metaphoneof'] = "metaphone af";
		$text['plusminus10'] = "+/- 10 år fra";
		$text['lessthan'] = "før";
		$text['greaterthan'] = "efter";
		$text['lessthanequal'] = "Præcis eller før";
		$text['greaterthanequal'] = "Præcis eller efter";
		$text['equalto'] = "lig med";
		$text['tryagain'] = "Prøv igen";
		$text['joinwith'] = "kombiner med";
		$text['cap_and'] = "OG";
		$text['cap_or'] = "ELLER";
		$text['showspouse'] = "Vis partner(e)";
		$text['submitquery'] = "Begynd søg";
		$text['birthplace'] = "Fødested";
		$text['deathplace'] = "Dødssted";
		$text['birthdatetr'] = "Født år";
		$text['deathdatetr'] = "Død år";
		$text['plusminus2'] = "+/- 2 år fra";
		$text['resetall'] = "Gendan alle værdier";
		$text['showdeath'] = "Vis døds-/begravelsesoplysninger";
		$text['altbirthplace'] = "Dåbssted";
		$text['altbirthdatetr'] = "Dåbsår";
		$text['burialplace'] = "Begravelsessted";
		$text['burialdatetr'] = "Begravelsesår";
		$text['event'] = "Begivenhed(er)";
		$text['day'] = "Dag";
		$text['month'] = "Måned";
		$text['keyword'] = "Nøgleord (f.eks., \"Omkr.\")";
		$text['explain'] = "Skriv del af dato for at se sammenfaldende begivenheder. Lad feltet være tomt for at se sammenfald for alle.";
		$text['enterdate'] = "Skriv eller vælg mindst én af de følgende: Dag, Måned, År, Nøgleord";
		$text['fullname'] = "Fuldt navn";
		$text['birthdate'] = "Fødselsdato";
		$text['altbirthdate'] = "Dåbsdato";
		$text['marrdate'] = "Vielsesdato";
		$text['spouseid'] = "Partners ID";
		$text['spousename'] = "Partners navn";
		$text['deathdate'] = "Dødsdato";
		$text['burialdate'] = "Begravelsesdato";
		$text['changedate'] = "Sidst ændret dato";
		$text['gedcom'] = "Træ";
		$text['baptdate'] = "Dåbsdato (SDH)";
		$text['baptplace'] = "Dåbssted (SDH)";
		$text['endldate'] = "Begavelsesdato (SDH)";
		$text['endlplace'] = "Begavelsessted (SDH)";
		$text['ssealdate'] = "Beseglingsdato Æ (SDH)";   //Sealed to spouse
		$text['ssealplace'] = "Beseglingssted Æ (SDH)";
		$text['psealdate'] = "Beseglingsdato F (SDH)";   //Sealed to parents
		$text['psealplace'] = "Beseglingssted F (SDH)";
		$text['marrplace'] = "Vielsessted";
		$text['spousesurname'] = "Ægtefælles efternavn";
		$text['spousemore'] = "Hvis der indtastes en værdi for ægtefælles efternavn, skal der også vælges køn.";
		$text['plusminus5'] = "+/- 5 år fra";
		$text['exists'] = "eksisterer";
		$text['dnexist'] = "eksisterer ikke";
		$text['divdate'] = "Skilsmissedato";
		$text['divplace'] = "Skilsmissested";
		$text['otherevents'] = "Andre begivenheder";
		$text['numresults'] = "Resultater pr. side";
		$text['mysphoto'] = "Uidentificerede billeder";
		$text['mysperson'] = "Personer, der er vanskelige at finde frem til";
		$text['joinor'] = "Muligheden 'Sammenføj med Eller' kan ikke bruges med en ægtefælles efternavn.";
		$text['tellus'] = "Fortæl, hvad du ved";
		$text['moreinfo'] = "Klik for at se mere om dette billede";
		//added in 8.0.0
		$text['marrdatetr'] = "Ægteskabet indgået";
		$text['divdatetr'] = "Skilsmisseår";
		$text['mothername'] = "Mors navn";
		$text['fathername'] = "Fars navn";
		$text['filter'] = "Filter";
		$text['notliving'] = "Ikke levende";
		$text['nodayevents'] = "Begivenheder i denne måned, der ikke er tilknyttet en specifik dato:";
		//added in 9.0.0
		$text['csv'] = "Kommasepareret CSV fil";
		//added in 10.0.0
		$text['confdate'] = "Bekræftelsesdato (SDH)";
		$text['confplace'] = "Bekræftelsessted (SDH)";
		$text['initdate'] = "Forberedende dato (SDH)";
		$text['initplace'] = "Forberedende sted (SDH)";
		//added in 11.0.0
		$text['marrtype'] = "Ægteskabstype";
		$text['searchfor'] = "Søg efter";
		$text['searchnote'] = "Bemærk: Denne side bruger Google til at udføre sin søgning. Antallet af matches vil blive direkte berørt af, i hvilket omfang Google har været i stand til at indeksere sitet.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Logfil for";
		$text['mostrecentactions'] = "Seneste aktiviteter";
		$text['autorefresh'] = "Automatisk opdatering (30 sekunder)";
		$text['refreshoff'] = "Slå automatisk opdatering fra";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Kirkegårde og gravsten";
		$text['showallhsr'] = "Vis alle gravstens poster";
		$text['in'] = "i";
		$text['showmap'] = "Vis kort";
		$text['headstonefor'] = "Gravsten for";
		$text['photoof'] = "Billeder af";
		$text['photoowner'] = "Ejer/Kilde";
		$text['nocemetery'] = "Ingen kirkegård";
		$text['iptc005'] = "Titel";
		$text['iptc020'] = "Supplerende kategorier";
		$text['iptc040'] = "Særlige vejledninger";
		$text['iptc055'] = "Dannet dato";
		$text['iptc080'] = "Forfatter";
		$text['iptc085'] = "Forfatters stilling";
		$text['iptc090'] = "By";
		$text['iptc095'] = "Stat";
		$text['iptc101'] = "Land";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Overskrift";
		$text['iptc110'] = "Kilde";
		$text['iptc115'] = "Billedkilde";
		$text['iptc116'] = "Copyright bemærkning";
		$text['iptc120'] = "Billedtekst";
		$text['iptc122'] = "Billedtekst forfatter";
		$text['mapof'] = "Kort over";
		$text['regphotos'] = "Beskrivelse";
		$text['gallery'] = "Kun thumbnails";
		$text['cemphotos'] = "Kirkegårdsbilleder";
		$text['photosize'] = "Størrelse";
        $text['iptc010'] = "Prioritet";
		$text['filesize'] = "Filstørrelse";
		$text['seeloc'] = "Se sted";
		$text['showall'] = "Vis alle";
		$text['editmedia'] = "Redigér medie";
		$text['viewitem'] = "Vis dette element";
		$text['editcem'] = "Redigér kirkegård";
		$text['numitems'] = "# elementer";
		$text['allalbums'] = "Alle albummer";
		$text['slidestop'] = "Pause lysbilledshow";
		$text['slideresume'] = "Genoptag lysbilledshow";
		$text['slidesecs'] = "Sekunder for hvert billede:";
		$text['minussecs'] = "minus 0.5 sekunder";
		$text['plussecs'] = "plus 0.5 sekunder";
		$text['nocountry'] = "Ukendt land";
		$text['nostate'] = "Ukendt stat";
		$text['nocounty'] = "Ukendt amt";
		$text['nocity'] = "Ukendt by";
		$text['nocemname'] = "Ukendt kirkegård";
		$text['editalbum'] = "Redigér album";
		$text['mediamaptext'] = "<strong>Note:</strong> Kør musen henover billedet for at vise navnene. Klik på et navn for at se siden.";
		//added in 8.0.0
		$text['allburials'] = "Alle begravelser";
		$text['moreinfo'] = "Klik for at se mere om dette billede";
		//added in 9.0.0
        $text['iptc025'] = "Nøgleord";
        $text['iptc092'] = "Underlokation";
		$text['iptc015'] = "Kategori";
		$text['iptc065'] = "Oprindeligt program";
		$text['iptc070'] = "Programversion";
		//added in 13.0
		$text['toggletags'] = "Skift Tags";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Vis efternavne, der begynder med";
		$text['showtop'] = "Vis mest brugte";
		$text['showallsurnames'] = "Vis alle efternavne";
		$text['sortedalpha'] = "sorteret alfabetisk";
		$text['byoccurrence'] = "sorteret efter hyppighed";
		$text['firstchars'] = "Første bogstav";
		$text['mainsurnamepage'] = "Efternavne";
		$text['allsurnames'] = "Alle efternavne";
		$text['showmatchingsurnames'] = "Klik på et efternavn for at se data.";
		$text['backtotop'] = "Tilbage til toppen";
		$text['beginswith'] = "Begynder med";
		$text['allbeginningwith'] = "Alle efternavne, der begynder med";
		$text['numoccurrences'] = "hyppigheden i parentes";
		$text['placesstarting'] = "Vis steder, der begynder med";
		$text['showmatchingplaces'] = "Klik på et sted for at vise matchende poster.";
		$text['totalnames'] = "totalt antal navne";
		$text['showallplaces'] = "Vis alle steder";
		$text['totalplaces'] = "totalt antal steder";
		$text['mainplacepage'] = "Steders primærside";
		$text['allplaces'] = "Alle steder";
		$text['placescont'] = "Vis alle steder, der indeholder";
		//changed in 8.0.0
		$text['top30'] = "Efternavnes top xxx";
		$text['top30places'] = "Steders top xxx";
		//added in 12.0.0
		$text['firstnamelist'] = "Fornavneliste";
		$text['firstnamesstarting'] = "Vis fornavne begyndende med";
		$text['showallfirstnames'] = "Vis alle fornavne";
		$text['mainfirstnamepage'] = "Forsiden med fornavne";
		$text['allfirstnames'] = "Alle fornavne";
		$text['showmatchingfirstnames'] = "Klik på et fornavn for at vise matchende poster.";
		$text['allfirstbegwith'] = "Alle fornavne begyndende med";
		$text['top30first'] = "Top xxx fornavne";
		$text['allothers'] = "Alle andre";
		$text['amongall'] = "(blandt alle navne)";
		$text['justtop'] = "Kun top xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(seneste xx dage)";

		$text['photo'] = "Billede";
		$text['history'] = "Fortælling/Dokument";
		$text['husbid'] = "Mands ID";
		$text['husbname'] = "Mands navn";
		$text['wifeid'] = "Kvindes ID";
		//added in 11.0.0
		$text['wifename'] = "Kvindes navn";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Slet";
		$text['addperson'] = "Tilføj person";
		$text['nobirth'] = "Den følgende person har ikke en gyldig fødselsdato og kunne ikke tilføjes";
		$text['event'] = "Begivenhed(er)";
		$text['chartwidth'] = "Tavlebredde";
		$text['timelineinstr'] = "Tilføj personer";
		$text['togglelines'] = "Vis/skjul linjer";
		//changed in 9.0.0
		$text['noliving'] = "Den følgende person er mærket som nulevende eller privat og kunne ikke tilføjes, fordi du ikke er logget ind med korrekte rettigheder";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Søg i alle træer";
		$text['treename'] = "Trænavn";
		$text['owner'] = "Ejer";
		$text['address'] = "Adresse";
		$text['city'] = "By";
		$text['state'] = "Stat";
		$text['zip'] = "Postnummer";
		$text['country'] = "Land";
		$text['email'] = "mailadresse";
		$text['phone'] = "Telefon";
		$text['username'] = "Brugernavn";
		$text['password'] = "Kodeord";
		$text['loginfailed'] = "Login mislykkedes";

		$text['regnewacct'] = "Registrér ny brugerkonto";
		$text['realname'] = "Dit fulde navn";
		$text['phone'] = "Telefon";
		$text['email'] = "mailadresse";
		$text['address'] = "Adresse";
		$text['acctcomments'] = "Bemærkninger og kommentarer";
		$text['submit'] = "Send";
		$text['leaveblank'] = "(skal være tomt, hvis man vil have nyt træ)";
		$text['required'] = "Nødvendige felter";
		$text['enterpassword'] = " Indtast en adgangskode.";
		$text['enterusername'] = "Indtast et brugernavn.";
		$text['failure'] = "Det angivne brugernavn er desværre allerede i brug. Brug Tilbage-tasten i browseren for at komme tilbage til forrige side og vælg et andet brugernavn.";
		$text['success'] = "Mange tak for anmodningen om adgang til webstedet. Vi kontakter dig, når kontoen er aktiv, eller hvis der er behov for flere oplysninger.";
		$text['emailsubject'] = "Ny brugeransøgning";
		$text['website'] = "Websted";
		$text['nologin'] = "Er du ikke oprettet som bruger?";
		$text['loginsent'] = "Login-oplysninger er sendt";
		$text['loginnotsent'] = "Login-oplysninger er ikke sendt";
		$text['enterrealname'] = "Indtast dit fulde navn.";
		$text['rempass'] = "Forbliv logget ind på denne computer";
		$text['morestats'] = "Mere statistik";
		$text['accmail'] = "<strong>OBS:</strong> For at kunne modtage mails fra webstedet vedr. registreringen, skal man sikre sig, at mails fra dette domæne ikke er blokeret.";
		$text['newpassword'] = "Ny adgangskode";
		$text['resetpass'] = "Gendan adgangskode";
		$text['nousers'] = "Dette skema kan ikke bruges, før der eksisterer mindst een brugerregistrering. Hvis du er ejer af denne side, skal du gå til Admin/Users og oprette en Administratorkonto.";
		$text['noregs'] = "Der kan desværre ikke accepteres flere nye brugerregistreringer for øjeblikket. <a href=\"suggest.php\">Skriv en besked,</a> hvis du har nogen spørgsmål eller bemærkninger ang. webstedet.";
		$text['emailmsg'] = "Du har modtaget en anmodning om adgang til webstedet.";
		$text['accactive'] = "Adgangen er blevet aktiveret, men brugeren har ingen ekstra rettigheder, før de er blevet indstillet.";
		$text['accinactive'] = "Gå til Admin/Brugere/Gennemse for at godkende brugerens adgang til webstedet. Brugerens konto vil forblive inaktiv, indtil den er redigeret og godkendt.";
		$text['pwdagain'] = "Gentag adgangskode";
		$text['enterpassword2'] = "Indtast adgangskoden igen.";
		$text['pwdsmatch'] = "Dine adgangskoder er ikke ens. Indtast den samme adgangskode i begge felter.";
		$text['acksubject'] = "Tak for henvendelsen"; //for a new user account
		$text['ackmessage'] = "Anmodningen er modtaget. Kontoen vil være inaktiv, indtil administratoren aktiverer den. Du vil modtage en mail, når dit login er klar til brug.";
		//added in 12.0.0
		$text['switch'] = "Skift";
		//added in 14.0
		$text['newpassword2'] = "Ny adgangskode igen";
		$text['resetsuccess'] = "Succes: Adgangskoden er blevet nulstillet";
		$text['resetfail'] = "Fejl: Adgangskoden blev ikke nulstillet";
		$text['failreason0'] = " (ukendt databasefejl)";
		$text['failreason2'] = " (du har ikke tilladelse til at ændre din adgangskode)";
		$text['failreason3'] = " (adgangskoderne matchede ikke)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Gennemse alle grene";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Antal";
		$text['totindividuals'] = "Antal personer";
		$text['totmales'] = "Heraf antal hankøn";
		$text['totfemales'] = "Heraf antal hunkøn";
		$text['totunknown'] = "Ukendt køn";
		$text['totliving'] = "Antal nulevende";
		$text['totfamilies'] = "Antal familier";
		$text['totuniquesn'] = "Antal unikke efternavne";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Antal kilder";
		$text['avglifespan'] = "Gennemsnitlig livslængde";
		$text['earliestbirth'] = "Tidligste fødsel";
		$text['longestlived'] = "Længstlevende person";
		$text['days'] = "dage";
		$text['age'] = "Alder";
		$text['agedisclaimer'] = "Aldersrelaterede beregninger er baseret på personer med angivne fødsels- <EM>og</EM> dødsdatoer.  Fordi der findes ukomplette datofelter(f.eks. en dødsdato, der kun er skrevet som \"1945\" eller \"FØR 1860\"), kan disse beregninger ikke være 100% præcise.";
		$text['treedetail'] = "Flere oplysninger om dette træ";
		$text['total'] = "Antal";
		//added in 12.0
		$text['totdeceased'] = "Antal afdøde";
		//added in 14.0
		$text['totalsourcecitations'] = "Totalt antal kildehenvisninger";
		break;

	case "notes":
		$text['browseallnotes'] = "Søg i alle notater";
		break;

	case "help":
		$text['menuhelp'] = "Menunøgle";
		break;

	case "install":
		$text['perms'] = "Alle tilladelser er oprettet.";
		$text['noperms'] = "Der kunne ikke oprettes tilladelser for disse filer:";
		$text['manual'] = "Oprette dem manuelt.";
		$text['folder'] = "Mappe";
		$text['created'] = "er oprettet";
		$text['nocreate'] = "Kunne ikke oprettes. Opret det manuelt.";
		$text['infosaved'] = "Oplysningerne er gemt, forbindelsen er bekræftet!";
		$text['tablescr'] = "Tabellerne er oprettet!";
		$text['notables'] = "Følgende tabeller kunne ikke oprettes:";
		$text['nocomm'] = "TNG kommunikerer ikke med databasen. Der er ikke oprettet tabeller.";
		$text['newdb'] = "Oplysningerne er gemt, forbindelsen er bekræftet, ny database er oprettet:";
		$text['noattach'] = "Oplysningerne er gemt. Forbindelsen er skabt, og databasen er oprettet, men TNG kan ikke tilknyttes hertil.";
		$text['nodb'] = "Oplysningerne er gemt. Forbindelsen er skabt, men databasen eksisterer ikke og kunne ikke oprettes her. Bekræft at navnet på databasen er korrekt, eller brug kontrolpanelet til at oprette den.";
		$text['noconn'] = "Oplysningerne er gemt, men forbindelsen mislykkedes. En eller flere af følgende er ikke i orden:";
		$text['exists'] = "eksisterer";
		$text['noop'] = "Der blev ikke udført noget.";
		//added in 8.0.0
		$text['nouser'] = "Bruger blev ikke oprettet. Brugernavnet eksisterer allerede.";
		$text['notree'] = "Træet blev ikke oprettet. Træ-ID findes muligvis allerede.";
		$text['infosaved2'] = "Oplysningerne er gemt";
		$text['renamedto'] = "omdøbt til";
		$text['norename'] = "kunne ikke omdøbes";
		//changed in 13.0.0
		$text['loginfirst'] = "Eksisterende brugerposter fundet. For at fortsætte skal man først logge ind eller fjerne alle poster fra brugertabellen.";
		break;

	case "imgviewer":
		$text['magmode'] = "Forstørrelse";
		$text['panmode'] = "Panorering";
		$text['pan'] = "Klik og træk for at flytte indenfor billedet";
		$text['fitwidth'] = "Tilpas bredde";
		$text['fitheight'] = "Tilpas højde";
		$text['newwin'] = "Nyt vindue";
		$text['opennw'] = "Åben billede i nyt vindue";
		$text['magnifyreg'] = "Klik for at forstørre en del af billedet";
		$text['imgctrls'] = "Aktiver billedværktøjer";
		$text['vwrctrls'] = "Aktiver billedvisningsværktøjer";
		$text['vwrclose'] = "Luk billedfremviseren";
		break;

	case "dna":
		$text['test_date'] = "Testdato";
		$text['links'] = "Relevante links";
		$text['testid'] = "Test ID";
		//added in 12.0.0
		$text['mode_values'] = "Mode Values";
		$text['compareselected'] = "Sammenlign valgte";
		$text['dnatestscompare'] = "Sammenlign Y-DNA tests";
		$text['keep_name_private'] = "Hold navn privat";
		$text['browsealltests'] = "Gennemse alle tests";
		$text['all_dna_tests'] = "Alle DNA-tests";
		$text['fastmutating'] = "Hurtigmuterende";
		$text['alltypes'] = "Alle typer";
		$text['allgroups'] = "Alle grupper";
		$text['Ydna_LITbox_info'] = "Test(s) knyttet til denne person blev ikke nødvendigvis taget af denne person.<br />Kolonnen 'Haplogroup' viser data i rødt, hvis resultatet er 'Forudset' eller grønt, hvis testen er 'Bekræftet'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Sammenlign valgte mtDNA-tests";
		$text['dnatestscompare_atdna'] = "Sammenlign valgte atDNA-tests";
		$text['chromosome'] = "Krom";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Ekstra mutationer";
		$text['mrca'] = "Most Recent Common Ancestor";
		$text['ydna_test'] = "Y-DNA-tests";
		$text['mtdna_test'] = "mtDNA (Mitochondrial) Tests";
		$text['atdna_test'] = "atDNA (autosomal) Tests";
		$text['segment_start'] = "Start";
		$text['segment_end'] = "Slut";
		$text['suggested_relationship'] = "Foreslået";
		$text['actual_relationship'] = "Aktuelt";
		$text['12markers'] = "Markører 1-12";
		$text['25markers'] = "Markører 13-25";
		$text['37markers'] = "Markører 26-37";
		$text['67markers'] = "Markører 38-67";
		$text['111markers'] = "Markører 68-111";
		//added in 13.1
		$text['comparemore'] = "At least two tests must be selected to compare.";
		break;
}

//common
$text['matches'] = "Match";
$text['description'] = "Beskrivelse";
$text['notes'] = "Notater";
$text['status'] = "Status";
$text['newsearch'] = "Ny søgning";
$text['pedigree'] = "Anetavle";
$text['seephoto'] = "Se billede";
$text['andlocation'] = "& sted";
$text['accessedby'] = "udført af";
$text['children'] = "Børn";  //from getperson
$text['tree'] = "Træ";
$text['alltrees'] = "Alle træer";
$text['nosurname'] = "[intet efternavn]";
$text['thumb'] = "Ikon";  //as in Thumbnail
$text['people'] = "Personer";
$text['title'] = "Titel";  //from getperson
$text['suffix'] = "Suffiks";  //from getperson
$text['nickname'] = "Kælenavn";  //from getperson
$text['lastmodified'] = "Sidst ændret";  //from getperson
$text['married'] = "Gift";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Navn"; //from showmap
$text['lastfirst'] = "Efternavn, Fornavn";  //from search
$text['bornchr'] = "Født/Døbt";  //from search
$text['individuals'] = "Personer";  //from whats new
$text['families'] = "Familier";
$text['personid'] = "Person-ID";
$text['sources'] = "Kilder";  //from getperson (next several)
$text['unknown'] = "Ukendt";
$text['father'] = "Far";
$text['mother'] = "Mor";
$text['christened'] = "Døbt";
$text['died'] = "Død";
$text['buried'] = "Begravet";
$text['spouse'] = "Ægtefælle/Partner";  //from search
$text['parents'] = "Forældre";  //from pedigree
$text['text'] = "Tekst";  //from sources
$text['language'] = "Sprog";  //from languages
$text['descendchart'] = "Efterslægt";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Egne data";
$text['edit'] = "Redigér";
$text['date'] = "Dato";
$text['login'] = "Login";
$text['logout'] = "Log ud";
$text['groupsheet'] = "Gruppeskema";
$text['text_and'] = "og";
$text['generation'] = "Generation";
$text['filename'] = "Filnavn";
$text['id'] = "ID";
$text['search'] = "Søg";
$text['user'] = "Bruger";
$text['firstname'] = "Fornavn";
$text['lastname'] = "Efternavn";
$text['searchresults'] = "Søgeresultat";
$text['diedburied'] = "Død/Begravet";
$text['homepage'] = "Forside";
$text['find'] = "Find...";
$text['relationship'] = "Slægtskab";		//in German, Verwandtschaft
$text['relationship2'] = "Tilknytning"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Tidslinje";
$text['yesabbr'] = "Ja";               //abbreviation for 'yes'
$text['divorced'] = "Skilt";
$text['indlinked'] = "Knyttet til";
$text['branch'] = "Gren";
$text['moreind'] = "Flere personer";
$text['morefam'] = "Flere familier";
$text['surnamelist'] = "Efternavneliste";
$text['generations'] = "Generationer";
$text['refresh'] = "Opdater";
$text['whatsnew'] = "Nyheder";
$text['reports'] = "Rapporter";
$text['placelist'] = "Stedfortegnelse";
$text['baptizedlds'] = "Døbt (SDH)";
$text['endowedlds'] = "Begavet (SDH)";
$text['sealedplds'] = "Beseglet F (SDH)";
$text['sealedslds'] = "Beseglet Æ (SDH)";
$text['ancestors'] = "Aner";
$text['descendants'] = "Efterkommere";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Dato for seneste opdatering";
$text['type'] = "Type";
$text['savechanges'] = "Gem ændringer";
$text['familyid'] = "Familie-ID";
$text['headstone'] = "Gravsten";
$text['historiesdocs'] = "Fortællinger & Dokumenter";
$text['anonymous'] = "Anonym";
$text['places'] = "Steder";
$text['anniversaries'] = "Datoer & Årsdage";
$text['administration'] = "Administration";
$text['help'] = "Hjælp";
//$text['documents'] = "Documents";
$text['year'] = "År";
$text['all'] = "Alle";
$text['address'] = "Adresse";
$text['suggest'] = "Foreslå";
$text['editevent'] = "Foreslå en ændring til denne begivenhed";
$text['morelinks'] = "Flere links";
$text['faminfo'] = "Familieoplysninger";
$text['persinfo'] = "Personlige oplysninger";
$text['srcinfo'] = "Kildeoplysninger";
$text['fact'] = "Fakta";
$text['goto'] = "Vælg en side";
$text['tngprint'] = "Udskriv";
$text['databasestatistics'] = "Databasestatistik"; //needed to be shorter to fit on menu
$text['child'] = "Barn";  //from familygroup
$text['repoinfo'] = "Oplysninger om arkiv";
$text['tng_reset'] = "Gendan";
$text['noresults'] = "Ingen fundet";
$text['allmedia'] = "Alle medier";
$text['repositories'] = "Arkiver";
$text['albums'] = "Albummer";
$text['cemeteries'] = "Kirkegårde";
$text['surnames'] = "Efternavne";
$text['dates'] = "Datoer";
$text['link'] = "Link";
$text['media'] = "Medie";
$text['gender'] = "Køn";
$text['latitude'] = "Breddegrad";
$text['longitude'] = "Længdegrad";
$text['bookmarks'] = "Bogmærker";
$text['bookmark'] = "Tilføj bogmærke";
$text['mngbookmarks'] = "Gå til bogmærke";
$text['bookmarked'] = "Bogmærke tilføjet";
$text['remove'] = "Fjern";
$text['find_menu'] = "Find";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Kirkegård";
$text['gmapevent'] = "Begivenhedskort";
$text['gevents'] = "Begivenhed";
$text['googleearthlink'] = "Link til Google Earth";
$text['googlemaplink'] = "Link til Google Maps";
$text['gmaplegend'] = "Kort forklaring";
$text['unmarked'] = "Umærket";
$text['located'] = "fundet";
$text['albclicksee'] = "Klik for at se alle poster i dette album";
$text['notyetlocated'] = "Endnu ikke fundet";
$text['cremated'] = "Kremeret";
$text['missing'] = "Savnes";
$text['pdfgen'] = "PDF Generator";
$text['blank'] = "Tomt kort";
$text['fonts'] = "Fonte";
$text['header'] = "Sidehoved";
$text['data'] = "Data";
$text['pgsetup'] = "Sideopsætning";
$text['pgsize'] = "Sidestørrelse";
$text['orient'] = "Orientering"; //for a page
$text['portrait'] = "Portræt";
$text['landscape'] = "Landskab";
$text['tmargin'] = "Margen øverst";
$text['bmargin'] = "Margen nederst";
$text['lmargin'] = "Margen til venstre";
$text['rmargin'] = "Margen til højre";
$text['createch'] = "Opret kort";
$text['prefix'] = "Præfiks";
$text['mostwanted'] = "Mest Eftersøgte";
$text['latupdates'] = "Seneste opdateringer";
$text['featphoto'] = "Udvalgt billede";
$text['news'] = "Nyheder";
$text['ourhist'] = "Fortællingen om vores familie";
$text['ourhistanc'] = "Fortællingen om vores familie og aner";
$text['ourpages'] = "Vores slægtsforskningsider";
$text['pwrdby'] = "Webstedet drives af";
$text['writby'] = "forfattet af";
$text['searchtngnet'] = "Søg i TNG Network (GENDEX)";
$text['viewphotos'] = "Se alle billeder";
$text['anon'] = "Du er i øjeblikket anonym";
$text['whichbranch'] = "Hvilken gren tilhører du?";
$text['featarts'] = "Temaartikler";
$text['maintby'] = "Opdateres af";
$text['createdon'] = "Oprettet den";
$text['reliability'] = "Troværdighed";
$text['labels'] = "Etiketter";
$text['inclsrcs'] = "Medtag kilder";
$text['cont'] = "(fort.)"; //abbreviation for continued
$text['mnuheader'] = "Forside";
$text['mnusearchfornames'] = "Søg";
$text['mnulastname'] = "Efternavn";
$text['mnufirstname'] = "Fornavn";
$text['mnusearch'] = "Søg";
$text['mnureset'] = "Begynd forfra";
$text['mnulogon'] = "Login";
$text['mnulogout'] = "Log ud";
$text['mnufeatures'] = "Andre muligheder";
$text['mnuregister'] = "Registrér for at få en brugerkonto";
$text['mnuadvancedsearch'] = "Avanceret søgning";
$text['mnulastnames'] = "Efternavne";
$text['mnustatistics'] = "Statistikker";
$text['mnuphotos'] = "Billeder";
$text['mnuhistories'] = "Fortællinger";
$text['mnumyancestors'] = "Billeder af &amp; fortællinger om aner til [Person]";
$text['mnucemeteries'] = "Kirkegårde";
$text['mnutombstones'] = "Gravsten";
$text['mnureports'] = "Rapporter";
$text['mnusources'] = "Kilder";
$text['mnuwhatsnew'] = "Nyheder";
$text['mnushowlog'] = "Adgangslog";
$text['mnulanguage'] = "Skift sprog";
$text['mnuadmin'] = "Administration";
$text['welcome'] = "Velkommen";
$text['contactus'] = "Kontakt";
//changed in 8.0.0
$text['born'] = "Født";
$text['searchnames'] = "Søg personer";
//added in 8.0.0
$text['editperson'] = "Redigér person";
$text['loadmap'] = "Hent kortet";
$text['birth'] = "Fødsel";
$text['wasborn'] = "blev født";
$text['startnum'] = "Første nummer";
$text['searching'] = "Søger";
//moved here in 8.0.0
$text['location'] = "Beliggenhed";
$text['association'] = "Tilknytning";
$text['collapse'] = "Fold sammen";
$text['expand'] = "Udvid";
$text['plot'] = "Plot";
$text['searchfams'] = "Søg familier";
//added in 8.0.2
$text['wasmarried'] = "blev gift med";
$text['anddied'] = "døde";
//added in 9.0.0
$text['share'] = "Del";
$text['hide'] = "Skjul";
$text['disabled'] = "Din bruger konto er blevet deaktiveret. Kontakt administrator for yderligere oplysninger.";
$text['contactus_long'] = "Hvis du har spørgsmål eller kommentarer til oplysningerne på dette websted, så <span class=\"emphasis\"><a href=\"suggest.php\">skriv til os</a></span>. ";
$text['features'] = "Artikler";
$text['resources'] = "Ressourcer";
$text['latestnews'] = "Seneste nyt";
$text['trees'] = "Træer";
$text['wasburied'] = "blev begravet";
//moved here in 9.0.0
$text['emailagain'] = "Gentag mail-adresse";
$text['enteremail2'] = "Indtast din mailadresse igen.";
$text['emailsmatch'] = "Mailadresserne er ikke ens. Indtast den samme mailadresse i begge felter.";
$text['getdirections'] = "Klik for at få kørselsanvisninger";
$text['calendar'] = "Kalender";
//changed in 9.0.0
$text['directionsto'] = " til ";
$text['slidestart'] = "Lysbilledshow";
$text['livingnote'] = "Mindst én nulevende eller privat person er knyttet til denne note - Detaljer er udeladt.";
$text['livingphoto'] = "Mindst én nulevende person er knyttet til dette - Detaljer er udeladt.";
$text['waschristened'] = "blev døbt";
//added in 10.0.0
$text['branches'] = "Grene";
$text['detail'] = "Detaljer";
$text['moredetail'] = "Flere detaljer";
$text['lessdetail'] = "Færre detaljer";
$text['conflds'] = "Bekræftet (SDH)";
$text['initlds'] = "Forberedende (SDH)";
$text['wascremated'] = "blev kremeret";
//moved here in 11.0.0
$text['text_for'] = "for";
//added in 11.0.0
$text['searchsite'] = "Søg på dette websted";
$text['searchsitemenu'] = "Søg websted";
$text['kmlfile'] = "Hent en .kml-fil for at se placeringen i Google Earth";
$text['download'] = "Klik for at hente";
$text['more'] = "Mere";
$text['heatmap'] = "Navnekort";
$text['refreshmap'] = "Opdatér kortet";
$text['remnums'] = "Fjern Numre og kortnåle";
$text['photoshistories'] = "Billeder &amp; Fortællinger";
$text['familychart'] = "Familietavle";
//added in 12.0.0
$text['firstnames'] = "Fornavne";
//moved here in 12.0.0
$text['dna_test'] = "DNA-test";
$text['test_type'] = "Testtype";
$text['test_info'] = "Testoplysning";
$text['takenby'] = "Taget af";
$text['haplogroup'] = "Haplogroup";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevante links";
$text['nofirstname'] = "[intet fornavn]";
//added in 12.0.1
$text['cookieuse'] = "Bemærk: Dette websted bruger cookies.";
$text['dataprotect'] = "EU-persondataforordningen";
$text['viewpolicy'] = "Vis databeskyttelsespolitik";
$text['understand'] = "OK";
$text['consent'] = "Jeg giver mit samtykke til, at dette websted kan gemme de personlige oplysninger, der er indsamlet her. Jeg forstår, at jeg kan bede webstedets ejer om at fjerne disse oplysninger til enhver tid.";
$text['consentreq'] = "Jeg giver mit samtykke til, at dette websted gemmer mine personlige oplysninger.";

//added in 12.1.0
$text['testsarelinked'] = "DNA-tests er knyttet til";
$text['testislinked'] = "DNA-test er knyttet til";

//added in 12.2
$text['quicklinks'] = "Hurtige links";
$text['yourname'] = "Dit navn";
$text['youremail'] = "Din mailadresse";
$text['liketoadd'] = "Alle oplysninger, du gerne vil tilføje";
$text['webmastermsg'] = "Webmaster-meddelelse";
$text['gallery'] = "Se Galleri";
$text['wasborn_male'] = "blev født";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "blev født"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "blev døbt";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "blev døbt";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "døde";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "døde";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "blev begravet"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "blev begravet"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "blev kremeret";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "blev kremeret";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "blev gift med ";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "blev gift med ";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "blev skilt";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "blev skilt";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " i ";			// used as a preposition to the location
$text['onthisdate'] = " den ";		// when used with full date
$text['inthisyear'] = " i ";		// when used with year only or month / year dates
$text['and'] = "og ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA-testoplysning";
//added in 13.0
$text['visitor'] = "Gæst";

$text['popupnote2'] = " = Ny anetavle";

//moved here in 14.0
$text['zoomin'] = "Zoom ind";
$text['zoomout'] = "Zoom ud";
$text['scrollnote'] = "Træk eller rul for at se mere af diagrammet.";
$text['general'] = "Generelt";

//changed in 14.0
$text['otherevents'] = "Andre Begivenheder og Egenskaber";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Forbindelser";
$text['continue'] = "Fortsæt";
$text['title2'] = "Titel"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>