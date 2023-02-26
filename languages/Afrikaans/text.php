<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Soek deur Alle Bronne";
		$text['shorttitle'] = "Kort Titel";
		$text['callnum'] = "Kontaknommer";
		$text['author'] = "Outeur";
		$text['publisher'] = "Uitgewer";
		$text['other'] = "Ander Inligting";
		$text['sourceid'] = "Bron ID";
		$text['moresrc'] = "Meer Bronne";
		$text['repoid'] = "Argief ID";
		$text['browseallrepos'] = "Soek deurs alle Bewaarplekke";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nuwe Taal";
		$text['changelanguage'] = "Verander Taal";
		$text['languagesaved'] = "Taal is Bewaar";
		$text['sitemaint'] = "Webwerf tans in onderhoud";
		$text['standby'] = "Terwyl ons databank opdateer word is die webwerf tydelik nie beskikbaar nie. Probeer assblief weer in 'n paar minute. As die webwerf vir 'n langer tyd steeds nie beskikbaar is nie, <a href=\"suggest.php\">kontak asseblief die eienaar van die webwerf </a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM beginnende vanaf";
		$text['producegedfrom'] = "Skep'n GEDCOM lêer vanaf";
		$text['numgens'] = "Aantal generasies";
		$text['includelds'] = "Sluit LDS inligting in";
		$text['buildged'] = "Bou GEDCOM";
		$text['gedstartfrom'] = "GEDCOM beginnende vanaf";
		$text['nomaxgen'] = "Dui 'n maksimum aantal generasies aan. Gebruik [BACK] om terug te gaan na vorige bladsy om fout te herstel.";
		$text['gedcreatedfrom'] = "GEDCOM geskep vanaf";
		$text['gedcreatedfor'] = "geskep vir";
		$text['creategedfor'] = "Skep GEDCOM";
		$text['email'] = "E-posadres";
		$text['suggestchange'] = "Stel 'n verandering voor";
		$text['yourname'] = "Jou Naam";
		$text['comments'] = "Notas of Opmerkings";
		$text['comments2'] = "Opmerkings";
		$text['submitsugg'] = "Stuur Voorstel";
		$text['proposed'] = "Voorgestelde verandering";
		$text['mailsent'] = "Dankie. Jou boodskap is gestuur.";
		$text['mailnotsent'] = "Jammer, jou boodskap kon nie gestuur word nie. Kontak asseblief vir xxx direk by yyy.";
		$text['mailme'] = "Stuur 'n kopie aan hierdie adres";
		$text['entername'] = "Gee asseblief jou naam";
		$text['entercomments'] = "Vul asseblief jou opmerkings in";
		$text['sendmsg'] = "Stuur Boodskap";
		//added in 9.0.0
		$text['subject'] = "Onderwerp";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Foto's en Geskiedenis van";
		$text['indinfofor'] = "Persoonlike inligting van";
		$text['pp'] = "bl."; //page abbreviation
		$text['age'] = "Ouderdom";
		$text['agency'] = "Agentskap";
		$text['cause'] = "Oorsaak";
		$text['suggested'] = "Voorgestelde";
		$text['closewindow'] = "Maak venster toe";
		$text['thanks'] = "Dankie";
		$text['received'] = "Jou voorstel is aangestuur na die administrateur van die webwerf vir oorweging.";
		$text['indreport'] = "Individuele Verslag";
		$text['indreportfor'] = "Individuele Verslag vir";
		$text['bkmkvis'] = "<strong>LW:</strong> hierdie boekmerke is net op hierdie rekenaar en in hierdie internet blaaier sigbaar.";
        //added in 9.0.0
		$text['reviewmsg'] = "Daar is voorgestelde verandering wat jou aandag benodig. Hierdie voorlegging is vir:";
        $text['revsubject'] = "Voorgestelde verandering benodig aandag";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Berekening van Verwantskap";
		$text['findrel'] = "Soek Verwantskap";
		$text['person1'] = "Persoon 1:";
		$text['person2'] = "Persoon 2:";
		$text['calculate'] = "Bereken";
		$text['select2inds'] = "Kies asseblief twee individue.";
		$text['findpersonid'] = "Soek Persoon ID";
		$text['enternamepart'] = "vul deel van voornaam en/of van in";
		$text['pleasenamepart'] = "Vul asseblief gedeelte van 'n voornaam of van in.";
		$text['clicktoselect'] = "kliek om te kies";
		$text['nobirthinfo'] = "Geen geboorte-inligting";
		$text['relateto'] = "Verwant aan";
		$text['sameperson'] = "Die twee individue is dieselfde persoon.";
		$text['notrelated'] = "Die twee individue is nie verwant aan mekaar binne xxx generasies nie."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Om die verwantskap tussen twee persone te wys, gebruik die 'Soek' knoppies langs elke individu om die persoon op te spoor (of hou persone soos vertoon), kliek dan op 'Bereken'.";
		$text['sometimes'] = "(Soms, deur die nagaan van 'n aantal verskillende generasies word 'n ander resultaat gelewer.)";
		$text['findanother'] = "Soek 'n ander verwantskap";
		$text['brother'] = "die broer van";
		$text['sister'] = "die suster van";
		$text['sibling'] = "die broer/suster van";
		$text['uncle'] = "die xxx oom van";
		$text['aunt'] = "die xxx tante van";
		$text['uncleaunt'] = "die xxx oom/tante van";
		$text['nephew'] = "die xxx nefie van";
		$text['niece'] = "die xxx niggie van";
		$text['nephnc'] = "die xxx nefie/niggie van";
		$text['removed'] = "kere verwyder";
		$text['rhusband'] = "die man van";
		$text['rwife'] = "die vrou van";
		$text['rspouse'] = "die gade van";
		$text['son'] = "die seun van";
		$text['daughter'] = "die dogter van";
		$text['rchild'] = "die kind van";
		$text['sil'] = "die skoonseun van";
		$text['dil'] = "die skoondogter van";
		$text['sdil'] = "die skoonseun of -dogter van";
		$text['gson'] = "die xxx kleinseun van";
		$text['gdau'] = "die xxx kleindogter van";
		$text['gsondau'] = "die xxx kleinkind van";
		$text['great'] = "groot";
		$text['spouses'] = "is gades";
		$text['is'] = "is";
		$text['changeto'] = "Verander na:";
		$text['notvalid'] = "is nie 'n geldige Persoon ID-nommer of bestaan nie in hierdie databank nie. Probeer met ander waardes.";
		$text['halfbrother'] = "die half-broer van";
		$text['halfsister'] = "die half-suster van";
		$text['halfsibling'] = "Die half-broer/-suster van";
		//changed in 8.0.0
		$text['gencheck'] = "Maksimum aantal generasies<br />om na te gaan";
		$text['mcousin'] = "die xxx neef yyy van";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "die xxx nig yyy van";  //female cousin
		$text['cousin'] = "die xxx suster-/broerskind yyy van";
		$text['mhalfcousin'] = "Die xxx kleinneef yyy van ";  //male cousin
		$text['fhalfcousin'] = "Die xxx kleinnig yyy van";  //female cousin
		$text['halfcousin'] = "Die xxx kleinneef/kleinnig yyy van";
		//added in 8.0.0
		$text['oneremoved'] = "een keer verwyderd";
		$text['gfath'] = "die xxx oupa van";
		$text['gmoth'] = "die xxx ouma van";
		$text['gpar'] = "die xxx grootouer van";
		$text['mothof'] = "die moeder van";
		$text['fathof'] = "die vader van";
		$text['parof'] = "die ouer van";
		$text['maxrels'] = "Maksimum verwantskappe om te toon";
		$text['dospouses'] = "Wys verwantskappe met 'n gade betrokke daarin";
		$text['rels'] = "Verwantskappe";
		$text['dospouses2'] = "Wys eggenote";
		$text['fil'] = "die skoonvader van";
		$text['mil'] = "die skoonmoeder van";
		$text['fmil'] = "die skoonvader of -moeder van";
		$text['stepson'] = "die stiefseun van";
		$text['stepdau'] = "die stiefdogter van";
		$text['stepchild'] = "die stiefkind van";
		$text['stepgson'] = "die xxx stief-kleinseun van";
		$text['stepgdau'] = "die xxx stief-kleindogter van";
		$text['stepgchild'] = "die xxx stief-kleinkind van";
		//added in 8.1.1
		$text['ggreat'] = "groot";
		//added in 8.1.2
		$text['ggfath'] = "die xxx oupatgrootjie van";
		$text['ggmoth'] = "die xxx oumagrootjie van";
		$text['ggpar'] = "die xxx agter-ouer van";
		$text['ggson'] = "die xxx agter-kleinseun van";
		$text['ggdau'] = "die xxx agter-kleindogter van";
		$text['ggsondau'] = "die xxx agter-klienkind van";
		$text['gstepgson'] = "die xxx agter-stiefkleinseun van";
		$text['gstepgdau'] = "die xxx agter-stiefkleindogter van";
		$text['gstepgchild'] = "die xxx agter-stiefkleinkind van";
		$text['guncle'] = "die xxx groot oomg van";
		$text['gaunt'] = "die xxx groot tannie van";
		$text['guncleaunt'] = "die xxx groot oom/tannie van";
		$text['gnephew'] = "die xxx groot neef van";
		$text['gniece'] = "die xxx groot niggie van";
		$text['gnephnc'] = "die xxx groot neef/niggie van";
		//added in 14.0
		$text['pathscalc'] = "Soek vir verbindings";
		$text['findrel2'] = "Soek verhoudings en ander verbindings";
		$text['makeme2nd'] = "Gebruik my ID";
		$text['usebookmarks'] = "Gebruik bookmerke";
		$text['select2inds'] = "Kies asseblief twee individue.";
		$text['indinfofor'] = "Individuele inligting vir";
		$text['nobookmarks'] = "Daar is geen boekmerk om te gebruik nie";
		$text['bkmtitle'] = "Persone wat in boekmerke gevind word";
		$text['bkminfo'] = "Kies 'n persoon:";
		$text['sortpathsby'] = "Sorteer paaie volgens aantal";
		$text['sortbyshort'] = "Sorteer volgens";
		$text['bylengthshort'] = "Lengte";
		$text['badID1'] = ": slegte persoon1 ID - gaan asseblief terug en korregeer";
		$text['badID2'] = ": slegte persoon2 ID - gaan asseblief terug en korregeer";
		$text['notintree'] = ": die persoon met hierdie ID is nie in die huidige stamboom databasis nie.";
		$text['sameperson'] = "Die twee individue is dieselfde persoon.";;
		$text['nopaths'] = "Hierdie persone is nie verbind nie.";
		$text['nopaths1'] = "Nie meer verbindings korter as xxx nie";
		$text['nopaths2'] = "in xxx soekstappe";
		$text['longestpath'] = "(langste pad wat tot dusver nagegaan is, was xxx treë lank)";
		$text['relevantpaths'] = "Die aantal verskillende relevante paaie wat gevind is: xxx";
		$text['skipMarr'] = "(Addisioneel, as gevolg van te veel huwelike, vertoon al die roetes wat gevind was nie: xxx)";
		$text['mjaor'] = "of";
		$text['connectionsto'] = "verbindings met";
		$text['findanotherpers'] = "Vind ander persoon...";
		$text['sometimes'] = "(Soms, deur die nagaan van 'n aantal verskillende generasies word 'n ander resultaat gelewer.)";
		$text['anotherpath'] = "Soek na ander verbindings";
		$text['xpath'] = "Roete";
		$text['primary'] = "Oorspronklike persoon"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Laaste Persoon";
		$text['parent'] = "Ouer";
		$text['mhfather'] = "sy vader";
		$text['mhmother'] = "sy moeder";
		$text['mhhusband'] = "sy man";
		$text['mhwife'] = "sy vrou";
		$text['mhson'] = "sy seun";
		$text['mhdaughter'] = "sy dogter";
		$text['fhfather'] = "haar vader";
		$text['fhmother'] = "haar moeder";
		$text['fhhusband'] = "haar man";
		$text['fhwife'] = "haar vrou";
		$text['fhson'] = "haar seun";
		$text['fhdaughter'] = "haar dogter";
		$text['hfather'] = "vader";
		$text['hmother'] = "moeder";
		$text['hhusband'] = "man";
		$text['hwife'] = "vrou";
		$text['hson'] = "seun";
		$text['hdaughter'] = "dogter";
		$text['maxruns'] = "Maks aantal roetes wat nagegaan moet word";
		$text['maxrshort'] = "Maks roetes";
		$text['maxlength'] = "Verbindingsroetes nie langer as";
		$text['maxlshort'] = "Maks lengte";
		$text['xstep'] = "stap";
		$text['xsteps'] = "stape";
		$text['xmarriages'] = "xxx huwelike";
		$text['xmarriage'] = "1 huwelik";
		$text['showspouses'] = "Wys byde eggenote";
		$text['showTxt'] = "Wys beskrywing van tekstuele roetes";
		$text['showTxtshort'] = "Tekstuele beskrywing.";
		$text['compactBox'] = "Wys persoon kompartemente gekompakteer";
		$text['compactBoxshort'] = "Kompaktee kompartemente";
		$text['paths'] = "Roetes";
		$text['dospouses2'] = "Wys eggenote";
		$text['maxmopt'] = "Maksimum huwelike per verband";
		$text['maxm'] = "Maksimum huwelike";
		$text['arerelated'] = "Hierdie persone is familie - Hul verhoudinge word in Spoor (Pad) 1 gewys";
		$text['simplerel'] = "Soek eenvoudige verhouding op";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Gesinsgroepblad vir";
		$text['ldsords'] = "LDS Ordinansies";
		$text['baptizedlds'] = "Gedoop  (LDS)";
		$text['endowedlds'] = "Begiftig (LDS)";
		$text['sealedplds'] = "Verseël O (LDS)";
		$text['sealedslds'] = "Verseël G (LDS)";
		$text['otherspouse'] = "Ander Gade";
		$text['husband'] = "Man";
		$text['wife'] = "Vrou";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "*";
		$text['capaltbirthabbr'] = "&amp;asymp;";
		$text['capdeathabbr'] = "&amp;dagger;";
		$text['capburialabbr'] = "&amp;Omega;";
		$text['capplaceabbr'] = "P";
		$text['capmarrabbr'] = "x";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Herteken met";
		$text['unknownlit'] = "Onbekend";
		$text['popupnote1'] = " = Addisionele inligting";
		$text['pedcompact'] = "Kompak";
		$text['pedstandard'] = "Standaard";
		$text['pedtextonly'] = "Teks";
		$text['descendfor'] = "Nasgeslag van";
		$text['maxof'] = "Maksimum van";
		$text['gensatonce'] = "generasies vertoon op een tydstip.";
		$text['sonof'] = "seun van";
		$text['daughterof'] = "dogter van";
		$text['childof'] = "kind van";
		$text['stdformat'] = "Standaardformaat";
		$text['ahnentafel'] = "Kwatierstaat";
		$text['addnewfam'] = "Voeg nuwe Familie by";
		$text['editfam'] = "Verander Familie";
		$text['side'] = "Kant";
		$text['familyof'] = "Familie van";
		$text['paternal'] = "Vaderskant";
		$text['maternal'] = "Moederskant";
		$text['gen1'] = "Self";
		$text['gen2'] = "Ouers";
		$text['gen3'] = "Grootouers";
		$text['gen4'] = "Oorgrootouers";
		$text['gen5'] = "2de Generasie Oorgrootouers";
		$text['gen6'] = "3de Generasie Oorgrootouers";
		$text['gen7'] = "4de Generasie Oorgrootouers";
		$text['gen8'] = "5de Generasie Oorgrootouers";
		$text['gen9'] = "6de Generasie Oorgrootouers";
		$text['gen10'] = "7de Generasie Oorgrootouers";
		$text['gen11'] = "8ste Generasie Oorgrootouers";
		$text['gen12'] = "9de Generasie Oorgrootouers";
		$text['graphdesc'] = "Nageslag-kaart tot op die punt";
		$text['pedbox'] = "Blok";
		$text['regformat'] = "Register Formaat";
		$text['extrasexpl'] = "As foto's of geskiedenis vir die volgende individue bestaan, sal ooreenstemmende ikone vertoon word langs die name.";
		$text['popupnote3'] = " = Nuwe kaart";
		$text['mediaavail'] = "Media Beskikbaar";
		$text['pedigreefor'] = "Stamboom vir";
		$text['pedigreech'] = "Pedigree Kaart";
		$text['datesloc'] = "Datums en lokasies";
		$text['borchr'] = "Geboorte/Alt - Dood/Begrafnis (twee)";
		$text['nobd'] = "Geen geboorte- of doodsdatum nie";
		$text['bcdb'] = "Geboorte/Alt/Dood/Begrafnies (vier)";
		$text['numsys'] = "Nommerstelsel";
		$text['gennums'] = "Generasienommers";
		$text['henrynums'] = "Henry Nommers";
		$text['abovnums'] = "d'Aboville Nommers";
		$text['devnums'] = "de Villiers Nommers";
		$text['dispopts'] = "Wys opsies";
		//added in 10.0.0
		$text['no_ancestors'] = "Geen voorouers gevind";
		$text['ancestor_chart'] = "Vertikale voorouers kaart";
		$text['opennewwindow'] = "Maak oop in 'n nuwe venster";
		$text['pedvertical'] = "Vertikaal";
		//added in 11.0.0
		$text['familywith'] = "Family with";
		$text['fcmlogin'] = "Please log in to see details";
		$text['isthe'] = "is the";
		$text['otherspouses'] = "other spouses";
		$text['parentfamily'] = "The parent family ";
		$text['showfamily'] = "Show family";
		$text['shown'] = "shown";
		$text['showparentfamily'] = "show parent family";
		$text['showperson'] = "show person";
		//added in 11.0.2
		$text['otherfamilies'] = "Other families";
		//added in 14.0
		$text['dtformat'] = "Tabele";
		$text['dtchildren'] = "Kinders";
		$text['dtgrandchildren'] = "Kleinkinders";
		$text['dtggrandchildren'] = "Agter kleinkinders";
		$text['dtgggrandchildren'] = "Agter kleinkinders"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Geen afstammelinge nie";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Totaal";
		$text['dtselect'] = "Selekteer";
		$text['dteachfulltable'] = "Elke volle tabelle sal hê";
		$text['dtrows'] = "rye";
		$text['dtdisplayingtable'] = "Vertoon tabel";
		$text['dtgototable'] = "Gaan na tabel:";
		$text['fcinstrdn'] = "Wys familie met eggenoot";
		$text['fcinstrup'] = "Wys familie met ouers";
		$text['fcinstrplus'] = "Kies ander gades";
		$text['fcinstrfam'] = "Kies ander ouers";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Geen verslae bestaan nie.";
		$text['reportname'] = "Veslagnaam";
		$text['allreports'] = "Alle Verslae";
		$text['report'] = "Verslag";
		$text['error'] = "Fout";
		$text['reportsyntax'] = "Die sintaks van die navraag vir die verslag";
		$text['wasincorrect'] = "was verkeerd, daarom kon die verslag nie saamgestel word nie.  Kontak asseblief die stelsel-administrateur by";
		$text['errormessage'] = "Foutboodskap";
		$text['equals'] = "gelyk aan";
		$text['endswith'] = "eindig met";
		$text['soundexof'] = "soundex van";
		$text['metaphoneof'] = "metafoor vir";
		$text['plusminus10'] = "+/- 10 jaar vanaf";
		$text['lessthan'] = "minder as";
		$text['greaterthan'] = "groter as";
		$text['lessthanequal'] = "minder as of gelyk aan";
		$text['greaterthanequal'] = "meer as of gelyk aan";
		$text['equalto'] = "gelyk aan";
		$text['tryagain'] = "Probeer asseblief weer";
		$text['joinwith'] = "Verbind met";
		$text['cap_and'] = "EN";
		$text['cap_or'] = "OF";
		$text['showspouse'] = "Wys gade (sal duplikate wys as individue meer as een gade het)";
		$text['submitquery'] = "Stuur Navraag";
		$text['birthplace'] = "Geboorteplek";
		$text['deathplace'] = "Sterfteplek";
		$text['birthdatetr'] = "Geboortejaar";
		$text['deathdatetr'] = "Sterftejaar";
		$text['plusminus2'] = "+/- 2 jare vanaf";
		$text['resetall'] = "Herstel alle waardes";
		$text['showdeath'] = "Wys sterf-/grafinligting";
		$text['altbirthplace'] = "Doopplek";
		$text['altbirthdatetr'] = "Doopjaar";
		$text['burialplace'] = "Begraafplaas";
		$text['burialdatetr'] = "Jaartal van Begrafnis";
		$text['event'] = "Gebeurtenis(se)";
		$text['day'] = "Dag";
		$text['month'] = "Maand";
		$text['keyword'] = "Sleutelwoord (bv, \"±\")";
		$text['explain'] = "Vul datum in om verwante gebeurtenisse te sien. Los veld leeg om alle verwante gebeure te sien.";
		$text['enterdate'] = "Kies asseblief ten minste een van die volgende: Dag, Maand, Jaar, Sleutelwoord";
		$text['fullname'] = "Volle Name";
		$text['birthdate'] = "Geboortedatum";
		$text['altbirthdate'] = "Doopdatum";
		$text['marrdate'] = "Huweliksdatum";
		$text['spouseid'] = "Gade ID";
		$text['spousename'] = "Naam van Gade";
		$text['deathdate'] = "Sterftedatum";
		$text['burialdate'] = "Datum van Begrafnis";
		$text['changedate'] = "Datum van laaste verandering";
		$text['gedcom'] = "Stamboom";
		$text['baptdate'] = "Datum van Doop(LDS)";
		$text['baptplace'] = "Plek van Doop (LDS)";
		$text['endldate'] = "Begiftigingsdatum (LDS)";
		$text['endlplace'] = "Plek van Begiftiging (LDS)";
		$text['ssealdate'] = "Datum Verseël G (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Plek Verseël G (LDS)";
		$text['psealdate'] = "Datum Verseël O (LDS)";   //Sealed to parents
		$text['psealplace'] = "Plek Verseël O (LDS)";
		$text['marrplace'] = "Plek van Huwelik";
		$text['spousesurname'] = "Van van Gade";
		$text['spousemore'] = "As jy 'n waarde ingetoets het vir 'Van van Gade', moet ten minste een ander veld gevul word.";
		$text['plusminus5'] = "+/- 5 jaar vanaf";
		$text['exists'] = "bestaan";
		$text['dnexist'] = "bestaan nie";
		$text['divdate'] = "Datum van egskeiding";
		$text['divplace'] = "Plek van Egskeiding";
		$text['otherevents'] = "Ander gebeuternisse";
		$text['numresults'] = "Aantal per blad";
		$text['mysphoto'] = "Geheimsinnige Foto's";
		$text['mysperson'] = "Ontwykende Persone";
		$text['joinor'] = "Die opsie 'Koppel met OF' kan nie met 'Van van Gade' gebruik word nie";
		$text['tellus'] = "Gee die inligting bekend aan jou";
		$text['moreinfo'] = "Meer inligting:";
		//added in 8.0.0
		$text['marrdatetr'] = "Jaartal van huwelik";
		$text['divdatetr'] = "Jaartal van egskeiding";
		$text['mothername'] = "Naam van Moeder";
		$text['fathername'] = "Naam van Vader";
		$text['filter'] = "Filter";
		$text['notliving'] = "Leef nie meer nie";
		$text['nodayevents'] = "Gebeurtenisse van hierdie maand maar wat nie aan 'n gegewe dag gekoppel is nie:";
		//added in 9.0.0
		$text['csv'] = "Komma geskeide CSV leer";
		//added in 10.0.0
		$text['confdate'] = "Aanneming Datum (LDS)";
		$text['confplace'] = "Aanneming Plek (LDS)";
		$text['initdate'] = "Inwyding Datum (LDS)";
		$text['initplace'] = "Inwyding Plek (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Marriage Type";
		$text['searchfor'] = "Search for";
		$text['searchnote'] = "Note: This page uses Google to perform its search. The number of matches returned will be directly affected by the extent to which Google has been able to index the site.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Loglêer vir";
		$text['mostrecentactions'] = "Mees onlangse Aksies";
		$text['autorefresh'] = "Auto Herlaai (30 sekondes)";
		$text['refreshoff'] = "Skakel Auto Herlaai Af";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Begraafplase en Grafstene";
		$text['showallhsr'] = "Wys alle Grafsteen-rekords";
		$text['in'] = "in";
		$text['showmap'] = "Wys Kaart";
		$text['headstonefor'] = "Grafsteen van";
		$text['photoof'] = "Foto van";
		$text['photoowner'] = "Eienaar van die oorspronklike";
		$text['nocemetery'] = "Geen Begraafplaas";
		$text['iptc005'] = "Titel";
		$text['iptc020'] = "Aanvullende Kategorieë";
		$text['iptc040'] = "Spesiale Instruksies";
		$text['iptc055'] = "Datum Geskep";
		$text['iptc080'] = "Outeur";
		$text['iptc085'] = "Outeur se Adres";
		$text['iptc090'] = "Dorp";
		$text['iptc095'] = "Staat/Provinsie";
		$text['iptc101'] = "Land";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Grafskrif";
		$text['iptc110'] = "Bron";
		$text['iptc115'] = "Foto Bron";
		$text['iptc116'] = "Kopiereg Kennisgewing";
		$text['iptc120'] = "Opskrif";
		$text['iptc122'] = "Opskrif Skrywer";
		$text['mapof'] = "Kaart van";
		$text['regphotos'] = "Beskrywende Uitleg";
		$text['gallery'] = "Net Duimnaelsketse";
		$text['cemphotos'] = "Begraafplaas Foto's";
		$text['photosize'] = "Grootte";
        $text['iptc010'] = "Prioriteit";
		$text['filesize'] = "Lêergrootte";
		$text['seeloc'] = "Sien lokasie";
		$text['showall'] = "Wys alles";
		$text['editmedia'] = "Redigeer Media";
		$text['viewitem'] = "Kyk na hierdie item";
		$text['editcem'] = "Redigeer Begraafplaas";
		$text['numitems'] = "# Items";
		$text['allalbums'] = "Alle Albums";
		$text['slidestop'] = "Pouseer die Skuifievertoning";
		$text['slideresume'] = "Gaan verder met Skuifievertoning";
		$text['slidesecs'] = "Sekondes per beeld:";
		$text['minussecs'] = "minus 0.5 sekondes";
		$text['plussecs'] = "plus 0.5 sekondes";
		$text['nocountry'] = "Onbekende land";
		$text['nostate'] = "Onbekende staat";
		$text['nocounty'] = "Onbekende distrik";
		$text['nocity'] = "Onbekende Stad";
		$text['nocemname'] = "Onbekende begraafplaasnaam";
		$text['editalbum'] = "Redigeer Album";
		$text['mediamaptext'] = "<strong>LW:</strong> skuif jou muis oor die beeld on name te sien. Kliek om 'n bladsy vir elke naam te sien.";
		//added in 8.0.0
		$text['allburials'] = "Alle begrafnisdienste";
		$text['moreinfo'] = "Meer inligting:";
		//added in 9.0.0
        $text['iptc025'] = "Sleutel woorde";
        $text['iptc092'] = "Sub-plek";
		$text['iptc015'] = "Kategorie";
		$text['iptc065'] = "Program oorsprong";
		$text['iptc070'] = "Program weergawe";
		//added in 13.0
		$text['toggletags'] = "Wissel Tags";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Wys vanne wat begin met";
		$text['showtop'] = "Wys Top";
		$text['showallsurnames'] = "Wys alle vanne";
		$text['sortedalpha'] = "alfabeties gesorteerd";
		$text['byoccurrence'] = "gesorteerd volgens voorkoms";
		$text['firstchars'] = "Eerste Karakters";
		$text['mainsurnamepage'] = "Hoof VAN bladsy";
		$text['allsurnames'] = "Alle Vanne";
		$text['showmatchingsurnames'] = "Kliek op 'n van om verwante rekords te vertoon.";
		$text['backtotop'] = "Terug na top";
		$text['beginswith'] = "Begin met";
		$text['allbeginningwith'] = "Alle vanne wat begin met";
		$text['numoccurrences'] = "aantal verwante gevalle in hakies";
		$text['placesstarting'] = "Wys grootste liggings beginnende met";
		$text['showmatchingplaces'] = "Kliek op 'n plek om kleiner plekke te wys. Kliek op die 'Soek' ikoon om verwante individue te wys.";
		$text['totalnames'] = "totale individue";
		$text['showallplaces'] = "Wys alle groot plekke";
		$text['totalplaces'] = "totale plekke";
		$text['mainplacepage'] = "Hoof Plekke Bladsy";
		$text['allplaces'] = "Alle Groot Plekke";
		$text['placescont'] = "Wys alle plekke wat die volgende bevat";
		//changed in 8.0.0
		$text['top30'] = "Top xxx vanne";
		$text['top30places'] = "Top xxx groter plekke";
		//added in 12.0.0
		$text['firstnamelist'] = "Voornaam lys";
		$text['firstnamesstarting'] = "Wys alle voorname wat begin met";
		$text['showallfirstnames'] = "Wys alle voorname";
		$text['mainfirstnamepage'] = "Hoof voornaam bladsy";
		$text['allfirstnames'] = "Alle voorname";
		$text['showmatchingfirstnames'] = "Klik op 'n voornaam om ooreenstemmende rekords te vertoon.";
		$text['allfirstbegwith'] = "Alle voorname wat begin met";
		$text['top30first'] = "Meeste xxx voorname";
		$text['allothers'] = "Alle anders";
		$text['amongall'] = "(onder alle name)";
		$text['justtop'] = "Net die boonste xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(afgelope xx dae)";

		$text['photo'] = "Foto";
		$text['history'] = "Geskiedenis/Dokument";
		$text['husbid'] = "Man ID";
		$text['husbname'] = "Man se Naam";
		$text['wifeid'] = "Vrou ID";
		//added in 11.0.0
		$text['wifename'] = "Mother's Name";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Verwyder";
		$text['addperson'] = "Voeg Persoon By";
		$text['nobirth'] = "Die volgende individu het nie 'n geldige geboortedatum nie en kon daarom nie bygevoeg word nie";
		$text['event'] = "Gebeurtenis(se)";
		$text['chartwidth'] = "Wydte van Kaart";
		$text['timelineinstr'] = "Voeg tot vier individue by deur hul ID's in te vul:";
		$text['togglelines'] = "Wissel Reëls";
		//changed in 9.0.0
		$text['noliving'] = "Die volgende individue is gemerk as lewend en kon daarom nie bygevoeg word nie omdat jy nie met die nodige toestemming aangeteken is nie";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Deursoek Alle Stambome";
		$text['treename'] = "Stamboomnaam";
		$text['owner'] = "Eienaar";
		$text['address'] = "Adres";
		$text['city'] = "Dorp";
		$text['state'] = "Staat/Provisie";
		$text['zip'] = "Zip/Poskode";
		$text['country'] = "Land";
		$text['email'] = "E-posadres";
		$text['phone'] = "Telefoon";
		$text['username'] = "Gebruikersnaam";
		$text['password'] = "Wagwoord";
		$text['loginfailed'] = "Aanteken onsuksesvol.";

		$text['regnewacct'] = "Registreer vir Nuwe Gebruikersrekening";
		$text['realname'] = "Jou Regte Naam";
		$text['phone'] = "Telefoon";
		$text['email'] = "E-posadres";
		$text['address'] = "Adres";
		$text['acctcomments'] = "Notas of Opmerkings";
		$text['submit'] = "Stuur";
		$text['leaveblank'] = "(laat leeg as jy 'n nuwe stamboom verlang)";
		$text['required'] = "Verpligte Velde";
		$text['enterpassword'] = "Vul asseblief 'n wagwoord in.";
		$text['enterusername'] = "Vul asseblief 'n gebruikersnaam in.";
		$text['failure'] = "Ons is jammer, maar die gebruikersnaam wat jy opgegee het is reeds in gebruik. Gebruik asseblief die 'Terug'-knop op jou webblaaier (IE ens.) om na die vorige bladsy terug te keer, en kies 'n ander gebruikersnaam.";
		$text['success'] = "Dankie. Ons het jou registrasie ontvang. Ons sal jou kontak wanneer jou rekening aktief is of as nog inligting benodig word.";
		$text['emailsubject'] = "Nuwe TNG gebruiker registrasie versoek";
		$text['website'] = "Webwerf";
		$text['nologin'] = "Het jy nie aantekengegewens nie?";
		$text['loginsent'] = "Aantekengegewens gestuur";
		$text['loginnotsent'] = "Aantekengegewens is nie gestuur nie";
		$text['enterrealname'] = "Vul asseblief jou werklike naam in.";
		$text['rempass'] = "Bly aangeteken op hierdie rekenaar";
		$text['morestats'] = "Meer statistieke";
		$text['accmail'] = "<strong>LW:</strong> om pos insake jou gebruikersnaam van die administrateur van hierdie webwerf te ontvang, maak asseblief seker dat jy nie pos van hierdie domeinnaam blokkeer nie.";
		$text['newpassword'] = "Nuwe Wagwoord";
		$text['resetpass'] = "Herstel jou wagwoord";
		$text['nousers'] = "Hierdie vorm kan nie gebruik word voordat nie ten minste één gebruikersrekord bestaan nie. As jy die eienaar is van hierdie werf gaan dan asseblief na Amin/Gebruikers om jou Administrasiegebruiker te skep";
		$text['noregs'] = "Jammer, maar op die oomblik aanvaar ons nie enige registrasie van nuwe gebruikers nie. <a href=\"suggest.php\">Kontak ons</a> asseblief regstreeks as jy enige kommentaar of vrae het oor enigiets op hierdie webwerf.";
		$text['emailmsg'] = "Jy het 'n nuwe versoek ontvang vir 'n TNG gebruikersrekening. Teken asseblief aan by die TNG Administrasie area en gee die nodige toestemming aan die nuwe gebruikersrekening. As jy die registrasie goedkeur, stel asseblief die gebruiker in kennis deur terug te antwoord op hierdie boodskap";
		$text['accactive'] = "Die gebruiker is geaktiveer, maar sal geen spesiale regte hê totdat die toegewys is nie.";
		$text['accinactive'] = "Gaan na Admin/Gebruikers/Hersien vir toegang tot die instellinge van die rekening. Die gebruikersrekening bly onaktief totdat jy dit ten minste een keer geopen en bewaar het.";
		$text['pwdagain'] = "Gee Wagwoord weer";
		$text['enterpassword2'] = "Vul asseblief weer jou wagwoord in.";
		$text['pwdsmatch'] = "Die wagwoorde verskil. Vul asseblief die korrekte wagwoord in beide velde in.";
		$text['acksubject'] = "Dankie dat jy jou geregistreer het"; //for a new user account
		$text['ackmessage'] = "Jou versoek vir 'n gebruikersrekening is ontvang. Jou rekening bly onaktief totdat dit deur die Administrateur van die werf hersien is. Sodra jou gebruikersnaam gereed is vir gebruik word jy per e-pos in kennis gestel.";
		//added in 12.0.0
		$text['switch'] = "Skakel";
		//added in 14.0
		$text['newpassword2'] = "Doen weer nuwe wagwoord";
		$text['resetsuccess'] = "Sukses: Wagwoord is reg gestel";
		$text['resetfail'] = "Mislukking: Wagwoord is nie reg gestel nie";
		$text['failreason0'] = " (onbekende databasis fout)";
		$text['failreason2'] = " (jy het nie toestemming om jou wagwoord te verander nie)";
		$text['failreason3'] = " (wagwoorde stem nie ooreen nie)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Blaai deur alle takke";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Hoeveelheid";
		$text['totindividuals'] = "Totale aantal Individue";
		$text['totmales'] = "Aantal Mans";
		$text['totfemales'] = "Aantal Vroue";
		$text['totunknown'] = "Aantal met Onbekende Geslag";
		$text['totliving'] = "Aantal Lewendes";
		$text['totfamilies'] = "Aantal Families";
		$text['totuniquesn'] = "Aantal Unieke Vanne";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Aantal Bronne";
		$text['avglifespan'] = "Gemiddelde Lewensduur";
		$text['earliestbirth'] = "Vroegste Geboorte";
		$text['longestlived'] = "Langste Geleef";
		$text['days'] = "dae";
		$text['age'] = "Ouderdom";
		$text['agedisclaimer'] = "Ouderdomsverwante berekeninge is gebaseer op individue wie se geboorte- <EM>en</EM> sterfte-datums genoteer is.  A.g.v. die bestaan van onvolledige datum velde(bv., 'n sterfte wat slegs gelys word as \"1945\" of \"< 1860\"), kan hierdie berekening nie 100% akkuraat wees nie.";
		$text['treedetail'] = "Meer inligting oor hierdie stamboom";
		$text['total'] = "Totaal";
		//added in 12.0
		$text['totdeceased'] = "Oorledene toetale";
		//added in 14.0
		$text['totalsourcecitations'] = "Totale bronverwysings";
		break;

	case "notes":
		$text['browseallnotes'] = "Soek in Alle Notas";
		break;

	case "help":
		$text['menuhelp'] = "Toets vir Keuselys";
		break;

	case "install":
		$text['perms'] = "Alle regte is ingestel.";
		$text['noperms'] = "Vir die volgende lêers kan die regte nie ingestel word nie:";
		$text['manual'] = "Stel die regte aseblief handmatig in.";
		$text['folder'] = "Vouer";
		$text['created'] = "is geskep";
		$text['nocreate'] = "is nie geskep nie. Skep asseblief handmatig.";
		$text['infosaved'] = "Inligting is bewaar, verbinding is bevestig!";
		$text['tablescr'] = "Die tabelle is geskep!";
		$text['notables'] = "Die volgende tabelle is nie geskep nie:";
		$text['nocomm'] = "Die verbinding van TNG met die databankbeheerder is nie suksesvol nie. Geen tabelle is geskep nie.";
		$text['newdb'] = "Inligting is bewaar, verbinding is bevestig, nuwe databank is geskep:";
		$text['noattach'] = "Inligting is bewaar. Verbinding is gemaak en die databank geskep, maar TNG kry geen toegang daartoe.";
		$text['nodb'] = "Inligting is bewaar. Verbinding is gemaak, maar die databank bestaan nie en kan nie geskep word nie. Verifieer asseblief die naam van die databank, of gebruik jou beheerpaneel om dit te skep.";
		$text['noconn'] = "Inligting is bewaar maar die verbinding met die databankbestuurder werk nie. Een of meer van die volgende is foutief:";
		$text['exists'] = "bestaan";
		$text['noop'] = "Geen opdrag is uitgevoer nie.";
		//added in 8.0.0
		$text['nouser'] = "Gebruiker is nie geskep nie. Gebruikersnaam bestaan miskien reeds.";
		$text['notree'] = "Stamboom is nie geskep nie. Stamboom-ID bestaan miskien reeds.";
		$text['infosaved2'] = "Inligting is bewaar";
		$text['renamedto'] = "hernoem tot";
		$text['norename'] = "kan nie hernoem word nie";
		//changed in 13.0.0
		$text['loginfirst'] = "Bestaande gebruikers rekords is opgespoor. Om voort te gaan, moet u eers aanmeld of alle rekords van die gebruikertabel verwyder.";
		break;

	case "imgviewer":
		$text['magmode'] = "Vergrootglasmodus";
		$text['panmode'] = "Wye modus";
		$text['pan'] = "Kliek en sleep om binne die beeld te beweeg";
		$text['fitwidth'] = "Pas Wydte";
		$text['fitheight'] = "Pas Hoogte";
		$text['newwin'] = "Nuwe Venster";
		$text['opennw'] = "Maak beeld in nuwe venster oop";
		$text['magnifyreg'] = "Kliek om 'n deel van die beeld te vergroot";
		$text['imgctrls'] = "Staan Beeldkontroles toe";
		$text['vwrctrls'] = "Staan Beeldkyker kontroles toe";
		$text['vwrclose'] = "Sluit Beeldkyker";
		break;

	case "dna":
		$text['test_date'] = "Test date";
		$text['links'] = "Relevant links";
		$text['testid'] = "Test ID";
		//added in 12.0.0
		$text['mode_values'] = "Moduswaardes";
		$text['compareselected'] = "Vergelyk Geselekteerde";
		$text['dnatestscompare'] = "Vergelyk Y-DNA Toetse";
		$text['keep_name_private'] = "Behou Naam Privaatheid";
		$text['browsealltests'] = "Deurblaai van alle toetse";
		$text['all_dna_tests'] = "Alle DNA toetse";
		$text['fastmutating'] = "vinnige evolueering";
		$text['alltypes'] = "Alle Tipes";
		$text['allgroups'] = "Alle Groepe";
		$text['Ydna_LITbox_info'] = "Toets(e) wat aan hierdie persoon gekoppel is, is nie noodwendig deur hierdie persoon geneem nie. <br /> Die kolom 'Haplogroup' vertoon data in rooi as die resultaat 'Voorspel' of groen is as die toets 'Bevestig'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Compare selected mtDNA Tests";
		$text['dnatestscompare_atdna'] = "Compare selected atDNA Tests";
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
		$text['comparemore'] = "At least two tests must be selected to compare.";
		break;
}

//common
$text['matches'] = "Resultate";
$text['description'] = "Beskrywing";
$text['notes'] = "Notas";
$text['status'] = "Status";
$text['newsearch'] = "Nuwe Soektog";
$text['pedigree'] = "Stamboom";
$text['seephoto'] = "Sien foto";
$text['andlocation'] = "& plek";
$text['accessedby'] = "toegang verkry deur";
$text['children'] = "Kinders";  //from getperson
$text['tree'] = "Stamboom";
$text['alltrees'] = "Alle Stambome";
$text['nosurname'] = "[van onbekend]";
$text['thumb'] = "Duim";  //as in Thumbnail
$text['people'] = "Mense";
$text['title'] = "Titel";  //from getperson
$text['suffix'] = "Agtervoegsel";  //from getperson
$text['nickname'] = "Noemnaam";  //from getperson
$text['lastmodified'] = "Laaste Opgedateer";  //from getperson
$text['married'] = "Getroud";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Naam"; //from showmap
$text['lastfirst'] = "Van, Naam(e)";  //from search
$text['bornchr'] = "Gebore/Gedoop";  //from search
$text['individuals'] = "Individue";  //from whats new
$text['families'] = "Gesinne";
$text['personid'] = "Persoons ID";
$text['sources'] = "Bronne";  //from getperson (next several)
$text['unknown'] = "Onbekend";
$text['father'] = "Vader";
$text['mother'] = "Moeder";
$text['christened'] = "Gedoop";
$text['died'] = "Sterf";
$text['buried'] = "Begrawe";
$text['spouse'] = "Gade";  //from search
$text['parents'] = "Ouers";  //from pedigree
$text['text'] = "Teks";  //from sources
$text['language'] = "Taal";  //from languages
$text['descendchart'] = "Nageslag";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Individu";
$text['edit'] = "Verander";
$text['date'] = "Datum";
$text['login'] = "Teken aan";
$text['logout'] = "Teken af";
$text['groupsheet'] = "Groepsblad";
$text['text_and'] = "en";
$text['generation'] = "Generasie";
$text['filename'] = "lêernaam";
$text['id'] = "ID";
$text['search'] = "Soek";
$text['user'] = "Gebruiker";
$text['firstname'] = "Voornaam";
$text['lastname'] = "Van";
$text['searchresults'] = "Soekresultate";
$text['diedburied'] = "Gesterf/Begrawe";
$text['homepage'] = "Tuisblad";
$text['find'] = "Soek...";
$text['relationship'] = "Verwantskap";		//in German, Verwandtschaft
$text['relationship2'] = "Verwantskap"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Tydlyn";
$text['yesabbr'] = "J";               //abbreviation for 'yes'
$text['divorced'] = "Geskei";
$text['indlinked'] = "Geskakel aan";
$text['branch'] = "Tak";
$text['moreind'] = "Meer individue";
$text['morefam'] = "Meer gesinne";
$text['surnamelist'] = "Lys van Vanne";
$text['generations'] = "Generasies";
$text['refresh'] = "Herlaai";
$text['whatsnew'] = "Wat is Nuut";
$text['reports'] = "Verslae";
$text['placelist'] = "Lys van Plekke";
$text['baptizedlds'] = "Gedoop  (LDS)";
$text['endowedlds'] = "Begiftig (LDS)";
$text['sealedplds'] = "Verseël O (LDS)";
$text['sealedslds'] = "Verseël G (LDS)";
$text['ancestors'] = "Voorouers";
$text['descendants'] = "Nageslag";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum van Laaste GEDCOM Invoer";
$text['type'] = "Tipe";
$text['savechanges'] = "Bewaar Veranderinge";
$text['familyid'] = "Familie-ID";
$text['headstone'] = "Grafstene";
$text['historiesdocs'] = "Geskeidenis";
$text['anonymous'] = "anoniem";
$text['places'] = "Plekke";
$text['anniversaries'] = "Datums & Herdenkings";
$text['administration'] = "Administrasie";
$text['help'] = "Hulp";
//$text['documents'] = "Documents";
$text['year'] = "Jaar";
$text['all'] = "Almal";
$text['address'] = "Adres";
$text['suggest'] = "Stel Voor";
$text['editevent'] = "Stel 'n verandering voor vir hierdie gebeurtenis";
$text['morelinks'] = "Meer Skakels";
$text['faminfo'] = "Gesinsinligting";
$text['persinfo'] = "Persoonlike Inligting";
$text['srcinfo'] = "Broninligting";
$text['fact'] = "Feit";
$text['goto'] = "Kies 'n bladsy";
$text['tngprint'] = "Afdruk";
$text['databasestatistics'] = "Databankstatistieke"; //needed to be shorter to fit on menu
$text['child'] = "Kind";  //from familygroup
$text['repoinfo'] = "Inligting van Bewaarplek";
$text['tng_reset'] = "Herstel";
$text['noresults'] = "Geen resultate gekry nie";
$text['allmedia'] = "Alle Media";
$text['repositories'] = "Bewaarplekke";
$text['albums'] = "Albums";
$text['cemeteries'] = "Begraafplase";
$text['surnames'] = "Vanne";
$text['dates'] = "Datums";
$text['link'] = "Skakel";
$text['media'] = "Media";
$text['gender'] = "Geslag";
$text['latitude'] = "Breedtegraad";
$text['longitude'] = "Lengtegraad";
$text['bookmarks'] = "Boekmerke";
$text['bookmark'] = "Nuwe Boekmerk";
$text['mngbookmarks'] = "Gaan na Boekmerke";
$text['bookmarked'] = "Boekmerk Toegevoeg";
$text['remove'] = "Verwyder";
$text['find_menu'] = "Vind";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Begraafplaas";
$text['gmapevent'] = "Gebeurtenis Kaart";
$text['gevents'] = "Gebeurtenis";
$text['googleearthlink'] = "Koppel aan Google Earth";
$text['googlemaplink'] = "Koppel aan Google Maps";
$text['gmaplegend'] = "Pin Verklaring";
$text['unmarked'] = "Ongemerk";
$text['located'] = "Ligging";
$text['albclicksee'] = "Kliek om al die items in hierdie album te sien";
$text['notyetlocated'] = "Nog nie gevind nie";
$text['cremated'] = "Veras";
$text['missing'] = "Vermis";
$text['pdfgen'] = "PDF Genereerder";
$text['blank'] = "Blanko Kaart";
$text['fonts'] = "Lettertipe";
$text['header'] = "Kop";
$text['data'] = "Data";
$text['pgsetup'] = "Bladsyinstelling";
$text['pgsize'] = "Bladgrootte";
$text['orient'] = "Oriëntasie"; //for a page
$text['portrait'] = "Regop";
$text['landscape'] = "Liggend";
$text['tmargin'] = "Topgrens";
$text['bmargin'] = "Ondergrens";
$text['lmargin'] = "Linkergrens";
$text['rmargin'] = "Regtergrens";
$text['createch'] = "Skep Kaart";
$text['prefix'] = "Voorvoegsel";
$text['mostwanted'] = "Meeste Gesoek";
$text['latupdates'] = "Nuutste Veranderinge";
$text['featphoto'] = "Hooffoto";
$text['news'] = "Nuus";
$text['ourhist'] = "Ons Familiegeskiedenis";
$text['ourhistanc'] = "Ons Familiegeskiedenis en Voorgeslagte";
$text['ourpages'] = "Ons Familie se Genealogiese Bladsye";
$text['pwrdby'] = "Hierdie werf word aangedryf deur";
$text['writby'] = "geskryf deur";
$text['searchtngnet'] = "Soek in TNG Netwerk (GENDEX)";
$text['viewphotos'] = "Bekyk alle foto's";
$text['anon'] = "Jy is tans anoniem";
$text['whichbranch'] = "Van watter tak kom jy?";
$text['featarts'] = "Hoofartikels";
$text['maintby'] = "Onderhoud deur";
$text['createdon'] = "Geskep op";
$text['reliability'] = "Betroubaarheid";
$text['labels'] = "Etikette";
$text['inclsrcs'] = "Bronne ingesluit";
$text['cont'] = "(verder)"; //abbreviation for continued
$text['mnuheader'] = "Tuisblad";
$text['mnusearchfornames'] = "Soek vir Name";
$text['mnulastname'] = "Van";
$text['mnufirstname'] = "Voornaam";
$text['mnusearch'] = "Soek";
$text['mnureset'] = "Begin Weer";
$text['mnulogon'] = "Teken Aan";
$text['mnulogout'] = "Teken Af";
$text['mnufeatures'] = "Ander Kenmerke";
$text['mnuregister'] = "Registreer vir 'n Gebruikersrekening";
$text['mnuadvancedsearch'] = "Gevorderde Soek";
$text['mnulastnames'] = "Vanne";
$text['mnustatistics'] = "Statistieke";
$text['mnuphotos'] = "Foto's";
$text['mnuhistories'] = "Geskiedenis";
$text['mnumyancestors'] = "Foto's &amp; Geskiedenis vir Voorgeslagte van [Person]";
$text['mnucemeteries'] = "Begraafplase";
$text['mnutombstones'] = "Grafstene";
$text['mnureports'] = "Verslae";
$text['mnusources'] = "Bronne";
$text['mnuwhatsnew'] = "Wat is Nuut";
$text['mnushowlog'] = "Toegangslog";
$text['mnulanguage'] = "Verander Taal";
$text['mnuadmin'] = "Administrasie";
$text['welcome'] = "Welkom";
$text['contactus'] = "Kontak Ons";
//changed in 8.0.0
$text['born'] = "Geboorte";
$text['searchnames'] = "Soek vir Name";
//added in 8.0.0
$text['editperson'] = "Verander Persoon";
$text['loadmap'] = "Laai die kaart";
$text['birth'] = "Geboorte";
$text['wasborn'] = "is gebore";
$text['startnum'] = "Beginnommer";
$text['searching'] = "Soek";
//moved here in 8.0.0
$text['location'] = "Lokasie";
$text['association'] = "Assosiasie";
$text['collapse'] = "Opvou";
$text['expand'] = "Brei uit";
$text['plot'] = "Plot";
$text['searchfams'] = "Soek Families";
//added in 8.0.2
$text['wasmarried'] = "Getroud";
$text['anddied'] = "Sterf";
//added in 9.0.0
$text['share'] = "Deel";
$text['hide'] = "Skuil";
$text['disabled'] = "Jou rekening is gede-aktieveerd. Kontak asseblief die webtuiste administrateur vir verdere inligting.";
$text['contactus_long'] = "As jy enige vrae en voorstelle het oor die informasie op die tuisbald, wees so gaaf<span class=\"emphasis\"><a href=\"suggest.php\">en skakel ons gerus</a></span>.Ons sien uit om van jou te hoor.";
$text['features'] = "Kenmerke";
$text['resources'] = "Hulpbronne";
$text['latestnews'] = "Nuutste Nuus";
$text['trees'] = "Boom";
$text['wasburied'] = "was buried";
//moved here in 9.0.0
$text['emailagain'] = "Epos weer";
$text['enteremail2'] = "Vul asseblief weer jou e-posadres in.";
$text['emailsmatch'] = "Die e-posadresse verskil. Vul asseblief die korrekte e-posadres in.";
$text['getdirections'] = "Kliek vir instruksies";
$text['calendar'] = "Kalendar";
//changed in 9.0.0
$text['directionsto'] = " na die ";
$text['slidestart'] = "Skuifie vertoning";
$text['livingnote'] = "Ten minste een lewende individu word vermeld in hierdie nota - Besonderhede weerhou.";
$text['livingphoto'] = "Ten minste een lewende individu kom voor op hierdie foto - Besonderhede weerhou.";
$text['waschristened'] = "Gedoop";
//added in 10.0.0
$text['branches'] = "Takke";
$text['detail'] = "Besonderhede";
$text['moredetail'] = "Meer besonderhede";
$text['lessdetail'] = "Minder besonderhede";
$text['conflds'] = "Aangeneem (LDS)";
$text['initlds'] = "Ingewy (LDS)";
$text['wascremated'] = "was veras";
//moved here in 11.0.0
$text['text_for'] = "vir";
//added in 11.0.0
$text['searchsite'] = "Soek hierdie webblad";
$text['searchsitemenu'] = "Soek Webblad";
$text['kmlfile'] = "Laai 'n .kml leer af om hierdie plek in Google Earth aan te dui";
$text['download'] = "Kliek om af te laai";
$text['more'] = "Meer";
$text['heatmap'] = "Hitte Kaart";
$text['refreshmap'] = "Verfris Kaart";
$text['remnums'] = "Maak Nommers en Plekmerkers skoon";
$text['photoshistories'] = "Photos &amp; Histories";
$text['familychart'] = "Family Chart";
//added in 12.0.0
$text['firstnames'] = "Voorname";
//moved here in 12.0.0
$text['dna_test'] = "DNA Test";
$text['test_type'] = "Test type";
$text['test_info'] = "Test Information";
$text['takenby'] = "Taken by";
$text['haplogroup'] = "Haplogroup";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevant links";
$text['nofirstname'] = "[Geen voornaam]";
//added in 12.0.1
$text['cookieuse'] = "Let Op: Hierdie webwerf gebruik koekies";
$text['dataprotect'] = "Data beskermings beleid";
$text['viewpolicy'] = "Besigtig beleid";
$text['understand'] = "Ek verstaan";
$text['consent'] = "Ek gee my permissive aan hierdie webwerf om my persoonlike informasie te versamel. Ek verstaan dat ek enige tyd mag vra dat die eienaar van hierdie webwerf my informasie sal verwyder.";
$text['consentreq'] = "Verleen toestemming vir storing van persoonlike inligting op hierdie webwerf.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Vinnige skakels";
$text['yourname'] = "Jou naam";
$text['youremail'] = "Jou e-posadres";
$text['liketoadd'] = "Enige inligting wat u wil byvoeg";
$text['webmastermsg'] = "Webmeesterboodskap";
$text['gallery'] = "Kyk Gallery";
$text['wasborn_male'] = "is gebore";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "is gebore"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "is gedoop";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "is gedoop";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "gesterf";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "gesterf";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "is begrawe"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "is begrawe"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "is veras";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "is veras";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "getroud";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "getroud";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "is geskei";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "is geskei";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = "in";			// used as a preposition to the location
$text['onthisdate'] = "aan";		// when used with full date
$text['inthisyear'] = "in";		// when used with year only or month / year dates
$text['and'] = "en";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Toets Info";
//added in 13.0
$text['visitor'] = "Besoeker";

$text['popupnote2'] = " = Nuwe stamboom";

//moved here in 14.0
$text['zoomin'] = "Zoem In";
$text['zoomout'] = "Zoem Uit";
$text['scrollnote'] = "Sleep of blaai om meer van die kaart te sien.";
$text['general'] = "Algemeen";

//changed in 14.0
$text['otherevents'] = "Ander gebeurtenisse en kenmerke";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Verbindings";
$text['continue'] = "Vervolg";
$text['title2'] = "Titel"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>