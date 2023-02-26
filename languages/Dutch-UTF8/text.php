<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Toon alle bronnen";
		$text['shorttitle'] = "Korte titel";
		$text['callnum'] = "Archiefnummer";
		$text['author'] = "Auteur";
		$text['publisher'] = "Uitgever";
		$text['other'] = "Andere informatie";
		$text['sourceid'] = "Bron-ID";
		$text['moresrc'] = "Meer bronnen";
		$text['repoid'] = "Vindplaats-ID";
		$text['browseallrepos'] = "Toon alle vindplaatsen";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nieuwe taal";
		$text['changelanguage'] = "Wijzig taal";
		$text['languagesaved'] = "Taal opgeslagen";
		$text['sitemaint'] = "Website niet beschikbaar in verband met onderhoud";
		$text['standby'] = "De website is tijdelijk niet beschikbaar. Probeer het a.u.b. over een tijdje nogmaals. Indien de website voor langere tijd niet beschikbaar blijkt, neem dan contact op met de eigenaar van de website <a href=\"suggest.php\">Neem contact op met de eigenaar</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM start vanaf";
		$text['producegedfrom'] = "Maak een GEDCOM met zijn/haar";
		$text['numgens'] = "Aantal generaties";
		$text['includelds'] = "Inclusief HLD informatie";
		$text['buildged'] = "Maak GEDCOM";
		$text['gedstartfrom'] = "GEDCOM begint bij";
		$text['nomaxgen'] = "U moet het maximum aantal generaties aangeven. Gebruik uw browser om terug te gaan naar de vorige bladzijde en verbeter de fout";
		$text['gedcreatedfrom'] = "GEDCOM opgemaakt vanuit";
		$text['gedcreatedfor'] = "opgemaakt voor";
		$text['creategedfor'] = "Maak GEDCOM";
		$text['email'] = "E-mail adres";
		$text['suggestchange'] = "Suggestie / opmerking mbt ";
		$text['yourname'] = "Uw naam";
		$text['comments'] = "Commentaar";
		$text['comments2'] = "Commentaar";
		$text['submitsugg'] = "Verstuur suggestie / opmerking";
		$text['proposed'] = "Suggestie / opmerking mbt";
		$text['mailsent'] = "Bedankt, uw suggestie / opmerking is verstuurd.";
		$text['mailnotsent'] = "Helaas, uw bericht kon niet worden bezorgd. Neem aub rechtstreeks contact op met xxx via yyy.";
		$text['mailme'] = "Stuur een kopie van dit bericht naar dit e-mail adres";
		$text['entername'] = "Vul aub uw naam in";
		$text['entercomments'] = "Vul aub uw opmerking / suggestie in";
		$text['sendmsg'] = "Verstuur boodschap";
		//added in 9.0.0
		$text['subject'] = "Subject";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Foto's en (levens)verhalen van";
		$text['indinfofor'] = "Persoonlijke informatie van";
		$text['pp'] = "blz."; //page abbreviation
		$text['age'] = "Leeftijd";
		$text['agency'] = "Instantie";
		$text['cause'] = "Oorzaak";
		$text['suggested'] = "Voorstel";
		$text['closewindow'] = "Sluit dit venster";
		$text['thanks'] = "Dank u wel";
		$text['received'] = "Uw voorgestelde wijziging is doorgestuurd naar de beheerder van de site ter beoordeling.";
		$text['indreport'] = "Persoonlijk rapport";
		$text['indreportfor'] = "Persoonlijk rapport van";
		$text['bkmkvis'] = "<strong>Opm.:</strong> Deze bladwijzers zijn alleen op deze computer met deze browser zichtbaar.";
        //added in 9.0.0
		$text['reviewmsg'] = "Er is een verandering voorgesteld waar u naar moet kijken. Deze toevoeging gaat over:";
        $text['revsubject'] = "Verandering voorgesteld waar u naar moet kijken";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Verwantschap berekenen";
		$text['findrel'] = "Zoek verwantschap";
		$text['person1'] = "Persoon 1:";
		$text['person2'] = "Persoon 2:";
		$text['calculate'] = "Berekenen";
		$text['select2inds'] = "Selecteer twee personen.";
		$text['findpersonid'] = "Zoek Persoon-ID";
		$text['enternamepart'] = "Vul een deel van de voor- en/of achternaam in";
		$text['pleasenamepart'] = "Aub een deel van de voor- en/of achternaam invullen.";
		$text['clicktoselect'] = "Klik om te selecteren";
		$text['nobirthinfo'] = "Geen geboorte gegevens";
		$text['relateto'] = "Verwantschap met";
		$text['sameperson'] = "De twee individuen zijn dezelfde persoon.";
		$text['notrelated'] = "De twee personen zijn niet verwant aan elkaar binnen xxx generaties."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Vul de ID's van twee personen in, of laat de gegevens van de weergegeven perso(o)n(en) staan. Klik daarna op 'Berekenen' om de eventuele verwantschap grafisch weer te geven.";
		$text['sometimes'] = "(Door verschillende aantallen generaties te gebruiken zal ook verschillende uitkomsten geven.)";
		$text['findanother'] = "Terug: Zoek een nieuwe verwantschap";
		$text['brother'] = "de broer van";
		$text['sister'] = "de zus van";
		$text['sibling'] = "de broer/zus van";
		$text['uncle'] = "de xxx oom van";
		$text['aunt'] = "de xxx tante van";
		$text['uncleaunt'] = "de xxx oom/tante van";
		$text['nephew'] = "de xxx neef van";
		$text['niece'] = "de xxx nicht van";
		$text['nephnc'] = "de xxx neef/nicht van";
		$text['removed'] = "maal verwijderd";
		$text['rhusband'] = "de echtgenoot van ";
		$text['rwife'] = "de echtgenote van ";
		$text['rspouse'] = "de echtgeno(o)t(e) van ";
		$text['son'] = "de zoon van";
		$text['daughter'] = "de dochter van";
		$text['rchild'] = "het kind van";
		$text['sil'] = "de schoonzoon van";
		$text['dil'] = "de schoondochter van";
		$text['sdil'] = "de schoonzoon/dochter van";
		$text['gson'] = "de xxx kleinzoon van";
		$text['gdau'] = "de xxx kleindochter van";
		$text['gsondau'] = "de xxx kleinzoon/dochter van";
		$text['great'] = "groot";
		$text['spouses'] = "zijn echtelieden";
		$text['is'] = "is";
		$text['changeto'] = "Wijzig in (Persoon-ID):";
		$text['notvalid'] = "is geen geldig Persoon-ID (Ixxx) of is niet gevonden in het bestand. Probeer het aub nog een keer.";
		$text['halfbrother'] = "de halfbroer van";
		$text['halfsister'] = "de halfzuster van";
		$text['halfsibling'] = "de halfbroer of halfzuster van";
		//changed in 8.0.0
		$text['gencheck'] = "Max. aantal te<br />controleren generaties";
		$text['mcousin'] = "de xxx neef yyy van";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "de xxx nicht yyy van";  //female cousin
		$text['cousin'] = "de xxx neef/nicht yyy van";
		$text['mhalfcousin'] = "de xxx half neef yyy van";  //male cousin
		$text['fhalfcousin'] = "de xxx half nicht yyy van";  //female cousin
		$text['halfcousin'] = "de xxx half neef/nicht yyy van";
		//added in 8.0.0
		$text['oneremoved'] = "een keer verwijderd";
		$text['gfath'] = "de xxx grootvader van";
		$text['gmoth'] = "de xxx grootmoeder van";
		$text['gpar'] = "de xxx grootouder van";
		$text['mothof'] = "de moeder van";
		$text['fathof'] = "de vader van";
		$text['parof'] = "de ouder van";
		$text['maxrels'] = "Maximaal aantal relaties om te laten zien";
		$text['dospouses'] = "laat relaties van partner zien";
		$text['rels'] = "Relaties";
		$text['dospouses2'] = "Toon echtelieden";
		$text['fil'] = "de schoonvader van";
		$text['mil'] = "de schoonmoeder van";
		$text['fmil'] = "de schoon- vader of moeder van";
		$text['stepson'] = "de stiefzoon van";
		$text['stepdau'] = "de stiefdochter van";
		$text['stepchild'] = "het stiefkind van";
		$text['stepgson'] = "de xxx stief-kleinzoon van";
		$text['stepgdau'] = "de xxx stief-kleindochter van";
		$text['stepgchild'] = "het xxx stief-kleinkind van";
		//added in 8.1.1
		$text['ggreat'] = "groot";
		//added in 8.1.2
		$text['ggfath'] = "de xxx overgrootvader van";
		$text['ggmoth'] = "de xxx overgrootmoeder van";
		$text['ggpar'] = "de xxx overgrootouders van";
		$text['ggson'] = "de xxx achterkleinzoon van";
		$text['ggdau'] = "de xxx achterkleindochter van";
		$text['ggsondau'] = "de xxx achterkleinkind van";
		$text['gstepgson'] = "de xxx achterkleinstiefzoon van";
		$text['gstepgdau'] = "de xxx achterkleinstiefdochter van";
		$text['gstepgchild'] = "de xxx achterkleinstiefkind van";
		$text['guncle'] = "de xxx oudoom van";
		$text['gaunt'] = "de xxx oudtante van";
		$text['guncleaunt'] = "de xxx oudoom/oudtante van";
		$text['gnephew'] = "de xxx achterneef van";
		$text['gniece'] = "de xxx achternicht van";
		$text['gnephnc'] = "de xxx achterneef/achternicht van";
		//added in 14.0
		$text['pathscalc'] = "Zoek naar connecties";
		$text['findrel2'] = "Vind relaties en andere connecties";
		$text['makeme2nd'] = "Gebruik mijn ID";
		$text['usebookmarks'] = "Gebruik bookmarks";
		$text['select2inds'] = "Selecteer twee personen.";
		$text['indinfofor'] = "Individuele info voor";
		$text['nobookmarks'] = "Er is geen bookmark om te gebruiken";
		$text['bkmtitle'] = "Personen gevonden in bookmarks";
		$text['bkminfo'] = "Selecter een persoon:";
		$text['sortpathsby'] = "Sorteer paden op nummer";
		$text['sortbyshort'] = "Sorteer op";
		$text['bylengthshort'] = "Lengte";
		$text['badID1'] = ": verkeerd persoon1 ID - ga terug en corrigeer";
		$text['badID2'] = ": verkeerd persoon2 ID - ga terug en corrigeer";
		$text['notintree'] = ": de person met dit ID zit niet in de huidige tak database.";
		$text['sameperson'] = "De twee individuen zijn dezelfde persoon.";;
		$text['nopaths'] = "Deze personen zijn niet gerelateerd.";
		$text['nopaths1'] = "Niet meer connectie korter dan xxx";
		$text['nopaths2'] = "in xxx zoek stappen";
		$text['longestpath'] = "(langste pad tot nu toe was xxx stappen lang)";
		$text['relevantpaths'] = "Het aantal gevonden relevante paden is: xxx";
		$text['skipMarr'] = "(toelichting, Het aantal paden gevonden maar niet getoond (reden te veel huwelijken) is: xxx)";
		$text['mjaor'] = "of";
		$text['connectionsto'] = "Connecties naar ";
		$text['findanotherpers'] = "Vind nog een persoon...";
		$text['sometimes'] = "(Door verschillende aantallen generaties te gebruiken zal ook verschillende uitkomsten geven.)";
		$text['anotherpath'] = "Zoek naar andere connecties";
		$text['xpath'] = "Pad ";
		$text['primary'] = "Start Persoon"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Einde Persoon";
		$text['parent'] = "Ouder";
		$text['mhfather'] = "zijn vader";
		$text['mhmother'] = "zijn moeder";
		$text['mhhusband'] = "zijn echgenote";
		$text['mhwife'] = "zijn vrouw";
		$text['mhson'] = "zijn zoon";
		$text['mhdaughter'] = "zijn dochter";
		$text['fhfather'] = "haar vader";
		$text['fhmother'] = "haar moeder";
		$text['fhhusband'] = "haar echtgenoot";
		$text['fhwife'] = "haar vrouw";
		$text['fhson'] = "haar zoon";
		$text['fhdaughter'] = "haar dochter";
		$text['hfather'] = "vader";
		$text['hmother'] = "moeder";
		$text['hhusband'] = "echtgenoot";
		$text['hwife'] = "vrouw";
		$text['hson'] = "zoon";
		$text['hdaughter'] = "dochter";
		$text['maxruns'] = "Max paden om te controleren";
		$text['maxrshort'] = "Max paden";
		$text['maxlength'] = "Connectie paden niet langer dan";
		$text['maxlshort'] = "Max lengte";
		$text['xstep'] = "stap";
		$text['xsteps'] = "stappen";
		$text['xmarriages'] = "xxx huwelijken";
		$text['xmarriage'] = "1 huwelijk";
		$text['showspouses'] = "Toon beide echtelieden";
		$text['showTxt'] = "Toon pad in tekstvorm";
		$text['showTxtshort'] = "Tekst omsch.";
		$text['compactBox'] = "Toon persoons boxem compact";
		$text['compactBoxshort'] = "Compacte boxen";
		$text['paths'] = "Paden";
		$text['dospouses2'] = "Toon echtelieden";
		$text['maxmopt'] = "Max huwelijken per connectie";
		$text['maxm'] = "Max huwelijken";
		$text['arerelated'] = "Deze personen zijn gerelateerd - hun relatie word getoond in pad 1";
		$text['simplerel'] = "Simpele relatie zoeken";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Gezinsblad van";
		$text['ldsords'] = "HLD verordeningen";
		$text['baptizedlds'] = "Gedoopt (HLD)";
		$text['endowedlds'] = "Begiftigd (HLD)";
		$text['sealedplds'] = "Verzegeld ouders (HLD)";
		$text['sealedslds'] = "Verzegeld partner (HLD)";
		$text['otherspouse'] = "Andere partner";
		$text['husband'] = "Echtgenoot";
		$text['wife'] = "Echtgenote";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "G";
		$text['capaltbirthabbr'] = "D";
		$text['capdeathabbr'] = "O";
		$text['capburialabbr'] = "B";
		$text['capplaceabbr'] = "te";
		$text['capmarrabbr'] = "H";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Opnieuw tekenen met";
		$text['unknownlit'] = "Onbekend";
		$text['popupnote1'] = " = Extra informatie";
		$text['pedcompact'] = "Compact";
		$text['pedstandard'] = "Standaard";
		$text['pedtextonly'] = "Alleen tekst";
		$text['descendfor'] = "Nakomelingen van";
		$text['maxof'] = "Maximum";
		$text['gensatonce'] = "generaties tegelijk tonen.";
		$text['sonof'] = "zoon van";
		$text['daughterof'] = "dochter van";
		$text['childof'] = "kind van";
		$text['stdformat'] = "Standaard-formaat";
		$text['ahnentafel'] = "(Uitgebreide)kwartierstaat";
		$text['addnewfam'] = "Toevoegen nieuw gezin";
		$text['editfam'] = "Wijzig gezin";
		$text['side'] = "kant";
		$text['familyof'] = "Familie van";
		$text['paternal'] = "vaders kant";
		$text['maternal'] = "moeders kant";
		$text['gen1'] = "zelf";
		$text['gen2'] = "ouders";
		$text['gen3'] = "grootouders";
		$text['gen4'] = "overgrootouders";
		$text['gen5'] = "betovergrootouders";
		$text['gen6'] = "oudouders";
		$text['gen7'] = "oudgrootouders";
		$text['gen8'] = "oudovergrootouders";
		$text['gen9'] = "oudbetovergrootouders";
		$text['gen10'] = "stam-ouders";
		$text['gen11'] = "stam-grootouders";
		$text['gen12'] = "stam-overgrootouders";
		$text['graphdesc'] = "Nakomelingen tot dit punt grafisch weergegeven";
		$text['pedbox'] = "Box";
		$text['regformat'] = "Register";
		$text['extrasexpl'] = "= Er is zeker één foto, (levens)verhaal of ander medium bekend van deze persoon.";
		$text['popupnote3'] = " = Nieuw overzicht";
		$text['mediaavail'] = "Beschikbare media";
		$text['pedigreefor'] = "Stamboom van";
		$text['pedigreech'] = "Kwartierstaat";
		$text['datesloc'] = "Datums en plaatsen";
		$text['borchr'] = "Geboorte/Afw - Overlijden/Begraven (twee)";
		$text['nobd'] = "Geen geboorte- of overlijdensdatums";
		$text['bcdb'] = "Geboorte/Afw/Overlijden/Begraven (vier)";
		$text['numsys'] = "Nummersysteem";
		$text['gennums'] = "Generatienummers";
		$text['henrynums'] = "Henry nummers";
		$text['abovnums'] = "d'Aboville nummers";
		$text['devnums'] = "de Villiers nummers";
		$text['dispopts'] = "Weergave opties";
		//added in 10.0.0
		$text['no_ancestors'] = "Geen voorouders gevonden";
		$text['ancestor_chart'] = "Verticale voorouder kaart";
		$text['opennewwindow'] = "Openen in een nieuw venster";
		$text['pedvertical'] = "Verticaal";
		//added in 11.0.0
		$text['familywith'] = "Familie van";
		$text['fcmlogin'] = "Log a.u.b. in om de details te zien";
		$text['isthe'] = "de";
		$text['otherspouses'] = "andere echtelieden";
		$text['parentfamily'] = "Het ouderlijk gezin";
		$text['showfamily'] = "Toon het gezin";
		$text['shown'] = "getoond";
		$text['showparentfamily'] = "toon het ouderlijke gezin";
		$text['showperson'] = "toon persoon";
		//added in 11.0.2
		$text['otherfamilies'] = "Andere gezinnen";
		//added in 14.0
		$text['dtformat'] = "Tabellen";
		$text['dtchildren'] = "Kinderen";
		$text['dtgrandchildren'] = "Kleinkinderen";
		$text['dtggrandchildren'] = "Achter kleinkinderen";
		$text['dtgggrandchildren'] = "Achter kleinkindereren"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Geen nageslacht";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Totaal";
		$text['dtselect'] = "Selecteer";
		$text['dteachfulltable'] = "Iedere volle tabel bevat";
		$text['dtrows'] = "rijen";
		$text['dtdisplayingtable'] = "Toon tabel";
		$text['dtgototable'] = "Ga naar tabel:";
		$text['fcinstrdn'] = "Toon familie met partner";
		$text['fcinstrup'] = "Toon familie met ouders";
		$text['fcinstrplus'] = "Selecter andere partner";
		$text['fcinstrfam'] = "Selecter andere ouders";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Er bestaat geen actief rapport.";
		$text['reportname'] = "Rapportnaam";
		$text['allreports'] = "Alle rapporten";
		$text['report'] = "Rapport";
		$text['error'] = "Fout";
		$text['reportsyntax'] = "De syntax van de zoekvraag voor dit rapport";
		$text['wasincorrect'] = "is ongeldig, daarom kan het rapport niet worden gemaakt. Neem contact op met de beheerder via";
		$text['errormessage'] = "Foutmelding";
		$text['equals'] = "is gelijk aan";
		$text['endswith'] = "eindigt op";
		$text['soundexof'] = "soundex van";
		$text['metaphoneof'] = "metaphone van";
		$text['plusminus10'] = "+/- 10 jaar vanaf";
		$text['lessthan'] = "minder dan";
		$text['greaterthan'] = "groter dan";
		$text['lessthanequal'] = "minder dan of gelijk aan";
		$text['greaterthanequal'] = "groter dan of gelijk aan";
		$text['equalto'] = "gelijk aan";
		$text['tryagain'] = "Probeer het nog eens";
		$text['joinwith'] = "Bovenstaande<br />onderling<br />verbinden met";
		$text['cap_and'] = "EN";
		$text['cap_or'] = "OF";
		$text['showspouse'] = "Laat partner zien (laat dubbelen zien indien van de persoon meerdere partners bekend zijn)";
		$text['submitquery'] = "Zoek op";
		$text['birthplace'] = "Geboorteplaats";
		$text['deathplace'] = "Overlijdensplaats";
		$text['birthdatetr'] = "Geboortejaar";
		$text['deathdatetr'] = "Overlijdensjaar";
		$text['plusminus2'] = "+/- 2 jaar vanaf";
		$text['resetall'] = "Alle waarden terugzetten";
		$text['showdeath'] = "Laat overleden/begraven informatie zien";
		$text['altbirthplace'] = "Doopplaats";
		$text['altbirthdatetr'] = "Doopjaar";
		$text['burialplace'] = "Begraafplaats";
		$text['burialdatetr'] = "Begraafjaar";
		$text['event'] = "Gebeurtenis(sen)";
		$text['day'] = "Dag";
		$text['month'] = "Maand";
		$text['keyword'] = "Sleutelwoord (bv, 'Circa')";
		$text['explain'] = "Vul datum-gedeelten in om gebeurtenissen met gelijke datum-gedeelten te zien. Laat een veld leeg om alles te zien.";
		$text['enterdate'] = "Vul aub op zijn minst één van de volgende velden in: dag, maand, jaar, sleutelwoord";
		$text['fullname'] = "Volledige naam";
		$text['birthdate'] = "Geboortedatum";
		$text['altbirthdate'] = "Doopdatum";
		$text['marrdate'] = "Trouwdatum";
		$text['spouseid'] = "Partner-ID";
		$text['spousename'] = "Naam partner";
		$text['deathdate'] = "Overlijdensdatum";
		$text['burialdate'] = "Begraafdatum";
		$text['changedate'] = "Datum laatste wijziging";
		$text['gedcom'] = "Stamboom";
		$text['baptdate'] = "Doopdatum (HLD)";
		$text['baptplace'] = "Doopplaats (HLD)";
		$text['endldate'] = "Begiftigingsdatum (HLD)";
		$text['endlplace'] = "Begiftigingsplaats (HLD)";
		$text['ssealdate'] = "Verzegelingsdatum P (HLD)";   //Sealed to spouse
		$text['ssealplace'] = "Verzegelingsplaats P (HLD)";
		$text['psealdate'] = "Verzegelingsdatum O (HLD)";   //Sealed to parents
		$text['psealplace'] = "Verzegelingsplaats O (HLD)";
		$text['marrplace'] = "Huwelijksplaats";
		$text['spousesurname'] = "Achternaam van partner";
		$text['spousemore'] = "Indien 'Achternaam van partner' wordt ingevuld, moet ook 'Geslacht' ingevuld worden!";
		$text['plusminus5'] = "+/- 5 jaar vanaf";
		$text['exists'] = "is ingevuld";
		$text['dnexist'] = "is niet ingevuld";
		$text['divdate'] = "Datum echtscheiding";
		$text['divplace'] = "Plaats echtscheiding";
		$text['otherevents'] = "Andere Gebeurtenissen";
		$text['numresults'] = "Resultaten per pagina";
		$text['mysphoto'] = "Mysterieuze foto's";
		$text['mysperson'] = "Onbekende personen";
		$text['joinor'] = "De 'Join with OR' optie kan niet gebruikt worden met Achternaam van partner";
		$text['tellus'] = "Vertel ons wat je weet";
		$text['moreinfo'] = "Meer informatie:";
		//added in 8.0.0
		$text['marrdatetr'] = "Huwelijksjaar";
		$text['divdatetr'] = "Scheidingsjaar";
		$text['mothername'] = "Moeders naam";
		$text['fathername'] = "Vaders naam";
		$text['filter'] = "Filter";
		$text['notliving'] = "Niet levend";
		$text['nodayevents'] = "Gebeurtenissen deze maand niet verbonden met een specifieke dag:";
		//added in 9.0.0
		$text['csv'] = "Komma gescheiden CSV bestand";
		//added in 10.0.0
		$text['confdate'] = "Datum Bevestiging (LDS)";
		$text['confplace'] = "Plaats Bevestiging (LDS)";
		$text['initdate'] = "Datum Initiatie (LDS)";
		$text['initplace'] = "Plaats Initiatie (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Type huwelijk";
		$text['searchfor'] = "Zoek naar";
		$text['searchnote'] = "Note: This page uses Google to perform its search. The number of matches returned will be directly affected by the extent to which Google has been able to index the site.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Logbestand voor";
		$text['mostrecentactions'] = "Laatste acties";
		$text['autorefresh'] = "Schakel automatisch verversen AAN (30 seconden)";
		$text['refreshoff'] = "Schakel automatisch verversen UIT";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Begraafplaatsen en grafstenen";
		$text['showallhsr'] = "Toon alle grafstenen in:";
		$text['in'] = "in";
		$text['showmap'] = "Bekijk plattegrond";
		$text['headstonefor'] = "Grafsteen van";
		$text['photoof'] = "Foto van";
		$text['photoowner'] = "Eigenaar/Bron";
		$text['nocemetery'] = "Geen begraafplaats";
		$text['iptc005'] = "Titel";
		$text['iptc020'] = "Aanvullende categorieën";
		$text['iptc040'] = "Speciale instructies";
		$text['iptc055'] = "Aanmaakdatum";
		$text['iptc080'] = "Auteur";
		$text['iptc085'] = "Positie van de auteur";
		$text['iptc090'] = "Plaats";
		$text['iptc095'] = "Staat";
		$text['iptc101'] = "Land";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Koptekst";
		$text['iptc110'] = "Bron";
		$text['iptc115'] = "Bron van de foto";
		$text['iptc116'] = "Copyright";
		$text['iptc120'] = "Tekst";
		$text['iptc122'] = "Geschreven door";
		$text['mapof'] = "Kaart van";
		$text['regphotos'] = "Beschrijvend overzicht";
		$text['gallery'] = "Klikplaatjes-overzicht";
		$text['cemphotos'] = "Foto's van begraafplaats";
		$text['photosize'] = "Dimensies";
        $text['iptc010'] = "Prioriteit";
		$text['filesize'] = "Bestandgrootte";
		$text['seeloc'] = "Zie Plaats";
		$text['showall'] = "Allemaal zien";
		$text['editmedia'] = "Wijzig media";
		$text['viewitem'] = "Bekijk dit item";
		$text['editcem'] = "Wijzig begraafplaats";
		$text['numitems'] = "# items";
		$text['allalbums'] = "Alle albums";
		$text['slidestop'] = "Stop diashow";
		$text['slideresume'] = "Voortzetten diashow";
		$text['slidesecs'] = "Seconden per dia:";
		$text['minussecs'] = "min 0.5 seconden";
		$text['plussecs'] = "plus 0.5 seconden";
		$text['nocountry'] = "Onbekend land";
		$text['nostate'] = "Onbekende provincie/staat";
		$text['nocounty'] = "Onbekende gemeente";
		$text['nocity'] = "Onbekende plaats";
		$text['nocemname'] = "Onbekende begraafplaatsnaam";
		$text['editalbum'] = "Wijzig Album";
		$text['mediamaptext'] = "<strong>Opm.:</strong> Beweeg uw muis over de afbeelding voor de namen. Klik om een pagina voor elke naam te krijgen.";
		//added in 8.0.0
		$text['allburials'] = "Alle begrafenissen";
		$text['moreinfo'] = "Meer informatie:";
		//added in 9.0.0
        $text['iptc025'] = "Sleutelwoorden";
        $text['iptc092'] = "Sub-locatie";
		$text['iptc015'] = "Categorie";
		$text['iptc065'] = "Programma waarvan afkomstig";
		$text['iptc070'] = "Programma Versie";
		//added in 13.0
		$text['toggletags'] = "Toon / Toon niet Labels";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Toon familienamen beginnend met";
		$text['showtop'] = "Toon top";
		$text['showallsurnames'] = "Toon alle familienamen";
		$text['sortedalpha'] = "alfabetisch gesorteerd";
		$text['byoccurrence'] = "Op aantal treffers gerangschikt";
		$text['firstchars'] = "Eerste letter";
		$text['mainsurnamepage'] = "Hoofd-familienaam pagina";
		$text['allsurnames'] = "Alle familienamen";
		$text['showmatchingsurnames'] = "Klik op een familienaam om de bijbehorende namen te tonen.";
		$text['backtotop'] = "Terug naar boven";
		$text['beginswith'] = "Begint met";
		$text['allbeginningwith'] = "Alle familienamen beginnend met";
		$text['numoccurrences'] = "aantal resultaten tussen haakjes";
		$text['placesstarting'] = "Toon de grootste plaatsen beginnend met";
		$text['showmatchingplaces'] = "Klik op een plaatsnaam om een verdere onderverdeling van die betreffende plaats te zien. Klik op het zoek-pictogram om bijbehorende personen weer te geven.";
		$text['totalnames'] = "totaal aantal personen";
		$text['showallplaces'] = "Alle grootste plaatsen";
		$text['totalplaces'] = "totaal aantal plaatsen";
		$text['mainplacepage'] = "Hoofd-plaatsnamen pagina";
		$text['allplaces'] = "Alle grootste plaatsen";
		$text['placescont'] = "Laat alle plaatsen zien met";
		//changed in 8.0.0
		$text['top30'] = "Achternaam Top xxx";
		$text['top30places'] = "Top xxx grootste plaatsen";
		//added in 12.0.0
		$text['firstnamelist'] = "Voornamen Lijst";
		$text['firstnamesstarting'] = "Toon voornamen beginnend met";
		$text['showallfirstnames'] = "Toon alle voornamen";
		$text['mainfirstnamepage'] = "Hoofd voornamen pagina";
		$text['allfirstnames'] = "Alle Voornamen";
		$text['showmatchingfirstnames'] = "Klik op een voornamen om de overeenkomende gegevens te tonen.";
		$text['allfirstbegwith'] = "Alle voornamen beginnend met";
		$text['top30first'] = "Top xxx voornamen";
		$text['allothers'] = "Alle andere";
		$text['amongall'] = "(tussen alle namen)";
		$text['justtop'] = "Gewoon de top xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(sinds de laatste xx dagen)";

		$text['photo'] = "Foto";
		$text['history'] = "(Levens)verhaal/Document";
		$text['husbid'] = "Echtgenoot-ID";
		$text['husbname'] = "Naam echtgenoot";
		$text['wifeid'] = "Echtgenote-ID";
		//added in 11.0.0
		$text['wifename'] = "Naam echtgenote";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Verwijderen";
		$text['addperson'] = "Persoon toevoegen";
		$text['nobirth'] = "De volgende persoon heeft geen geldige geboortedatum en kan daarom niet toegevoegd worden";
		$text['event'] = "Gebeurtenis(sen)";
		$text['chartwidth'] = "Tijdlijn-breedte";
		$text['timelineinstr'] = "Personen toevoegen";
		$text['togglelines'] = "Regels omwisselen";
		//changed in 9.0.0
		$text['noliving'] = "De volgende persoon is gemarkeerd als levend en kon niet toegevoegd worden omdat u daarvoor geen rechten heeft";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Toon alle stambomen";
		$text['treename'] = "Stamboomnaam";
		$text['owner'] = "Eigenaar";
		$text['address'] = "Adres";
		$text['city'] = "Woonplaats";
		$text['state'] = "Provincie";
		$text['zip'] = "Postcode";
		$text['country'] = "Land";
		$text['email'] = "E-mail adres";
		$text['phone'] = "Telefoon";
		$text['username'] = "Gebruikersnaam";
		$text['password'] = "Wachtwoord";
		$text['loginfailed'] = "Fout bij het aanmelden.";

		$text['regnewacct'] = "Registreer als nieuwe gebruiker";
		$text['realname'] = "Uw echte naam";
		$text['phone'] = "Telefoon";
		$text['email'] = "E-mail adres";
		$text['address'] = "Adres";
		$text['acctcomments'] = "Commentaar";
		$text['submit'] = "Verzenden";
		$text['leaveblank'] = "(laat leeg als u een nieuwe stamboom aanvraagt)";
		$text['required'] = " Verplichte velden";
		$text['enterpassword'] = "Vul een wachtwoord in.";
		$text['enterusername'] = "Vul een gebruikersnaam in.";
		$text['failure'] = "Helaas is deze gebruikersnaam al in gebruik. Ga mbv de Vorige-knop naar de vorige pagina en kies een andere gebruikersnaam.";
		$text['success'] = "Dank u. De gegevens zijn verzonden. U krijgt een bericht als uw registratie is geactiveerd of als meer informatie noodzakelijk is.";
		$text['emailsubject'] = "Nieuwe TNG Gebruiker";
		$text['website'] = "Webpagina";
		$text['nologin'] = "Nog niet geregistreerd? Klik op: ";
		$text['loginsent'] = "Aanmeld-informatie verstuurd";
		$text['loginnotsent'] = "De aanmeld-informatie is niet verstuurd";
		$text['enterrealname'] = "Vul aub uw echte naam in.";
		$text['rempass'] = "Blijf aangemeld op deze computer";
		$text['morestats'] = "Meer statistieken";
		$text['accmail'] = "<strong>Opmerking:</strong> Om e-mail, mbt uw registratie, te kunnen ontvangen van de website-beheerder dient u er voor te zorgen dat er van dit domein geen mail wordt geblokkeerd.";
		$text['newpassword'] = "Nieuw wachtwoord";
		$text['resetpass'] = "Verander uw wachtwoord";
		$text['nousers'] = "Dit scherm kan pas gebruikt worden als minstens één gebruiker bekend is. Als u de eigenaar van deze site bent, ga dan naar Startpagina Beheerder > Gebruikers om een Administrator-account aan te maken.";
		$text['noregs'] = "Sorry, maar momenteel accepteren we geen nieuwe gebruikers. Neem aub <a href=\"suggest.php\">via mail contact</a> met ons op indien u vragen en/of opmerkingen heeft met betrekking tot deze website.";
		$text['emailmsg'] = "U heeft een aanvraag van een nieuwe gebruiker. Wilt u deze activeren door in het TNG Administratie scherm deze gebruiker de vereiste toegang te geven en de nieuwe gebruiker daarvan op de hoogte te stellen?";
		$text['accactive'] = "Het account is geactiveerd, maar de gebruiker heft geen speciale bevoegdheden tot je deze toewijst.";
		$text['accinactive'] = "Ga naar Beheer/Gebruikers/Beoordeel om de bevoegdheden in te stellen. Het account blijft inactief tot je het tenminste eenmaal hebt opgeslagen.";
		$text['pwdagain'] = "Wachtwoord opnieuw";
		$text['enterpassword2'] = "Type je wachtwoord opnieuw.";
		$text['pwdsmatch'] = "Uw wachtwoorden komen niet overeen.    Type hetzelfde wachtwoord in beide velden.";
		$text['acksubject'] = "Bedankt voor de registratie"; //for a new user account
		$text['ackmessage'] = "Uw aanvraag voor een gebruikers account is ontvangen. Het zal inactief blijven tot een beheerder het heeft goedgekeurd. U zult middels een e-mail op de hoogte worden gesteld als Uw gebruikersgegevens klaar zijn voor gebruik.";
		//added in 12.0.0
		$text['switch'] = "Verander";
		//added in 14.0
		$text['newpassword2'] = "Nogmaals nieuw wachtwoord";
		$text['resetsuccess'] = "Succes: Wachtwoord is hersteld";
		$text['resetfail'] = "Fout: Wachtwoord niet hersteld";
		$text['failreason0'] = " (onbekende database fout)";
		$text['failreason2'] = " (U heeft geen rechten om uw wachtwoord te wijzigen)";
		$text['failreason3'] = " (wachtwoorden komen niet overeen)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Doorzoek Alle Takken";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Totalen";
		$text['totindividuals'] = "Aantal personen";
		$text['totmales'] = "Aantal mannen";
		$text['totfemales'] = "Aantal vrouwen";
		$text['totunknown'] = "Aantal personen met onbekend geslacht";
		$text['totliving'] = "Aantal levenden";
		$text['totfamilies'] = "Aantal gezinnen";
		$text['totuniquesn'] = "Aantal unieke achternamen";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Aantal bronnen";
		$text['avglifespan'] = "Gemiddelde levensduur";
		$text['earliestbirth'] = "Vroegste geboorte";
		$text['longestlived'] = "Langst levende";
		$text['days'] = "dagen";
		$text['age'] = "Leeftijd";
		$text['agedisclaimer'] = "Leeftijd-berekeningen zijn gebaseerd op personen met een geboorte- <strong>en</strong> overlijdensdatum. Als deze niet volledig zijn (bv één van de datums is onvolledig, bv alleen het jaar '1945' of zonder dag 'mei 1755') dan zijn deze berekeningen niet 100% nauwkeurig. Datums met 'vóór', 'na', 'circa', 'tussen' en 'berekend' worden niet meegerekend.";
		$text['treedetail'] = "Meer informatie mbt deze stamboom";
		$text['total'] = "Totaal";
		//added in 12.0
		$text['totdeceased'] = "Totaal Overleden";
		//added in 14.0
		$text['totalsourcecitations'] = "Totaal Bron Citaten";
		break;

	case "notes":
		$text['browseallnotes'] = "Bekijk alle aantekeningen";
		break;

	case "help":
		$text['menuhelp'] = "Pictogrammen overzicht";
		break;

	case "install":
		$text['perms'] = "Alle machtigingen zijn ingesteld.";
		$text['noperms'] = "Machtigingen konden niet worden ingesteld voor deze bestanden:";
		$text['manual'] = "Stel ze handmatig in aub.";
		$text['folder'] = "Folder";
		$text['created'] = "is gemaakt";
		$text['nocreate'] = "kon niet worden gemaakt. maak ze handmatig aub.";
		$text['infosaved'] = "Informatie opgeslagen, verbinding geverifieerd!";
		$text['tablescr'] = "De tabellen zijn gemaakt!";
		$text['notables'] = "De volgende tabellen konden niet worden gemaakt:";
		$text['nocomm'] = "TNG communiceert niet met de database. Er zijn geen tabellen gemaakt.";
		$text['newdb'] = "Informatie opgeslagen, verbinding geverifieerd, nieuwe database gemaakt:";
		$text['noattach'] = "Informatie opgeslagen. Verbinding gemaakt en database gemaakt, maar TNG kan er geen verbinding mee maken.";
		$text['nodb'] = "Informatie opgeslagen. Verbinding gemaakt, maar de database bstaat net en kon hier niet worden gemaakt. Verifieer of e database naam juist is, of gebruik Uw controlepaneel om hem te maken.";
		$text['noconn'] = "Informatie opgeslagen maar er kon geen verbinding worden gemaakt. Een of meer van de volgende zaken klopt niet:";
		$text['exists'] = "is ingevuld";
		$text['noop'] = "Er is niets gedaan.";
		//added in 8.0.0
		$text['nouser'] = "Geen gebruiker gemaakt. Wellicht bestaat de gebruikersnaam al.";
		$text['notree'] = "Tak is niet gemaakt. Wellicht bestaat de Tak ID al.";
		$text['infosaved2'] = "Informatie opgeslagen";
		$text['renamedto'] = "hernoemd tot";
		$text['norename'] = "kon niet worden hernoemd";
		//changed in 13.0.0
		$text['loginfirst'] = "U moet zich eerst aanmelden.";
		break;

	case "imgviewer":
		$text['magmode'] = "Vergroot functie";
		$text['panmode'] = "Pan functie";
		$text['pan'] = "Klik en sleep om binnen de afbeelding te verplaatsen";
		$text['fitwidth'] = "Pas breedte aan";
		$text['fitheight'] = "Pas hoogte aan";
		$text['newwin'] = "Nieuw venster";
		$text['opennw'] = "Open de afbeelding in een nieuw venster";
		$text['magnifyreg'] = "Klik om een gedeelte van de afbeelding te vergroten";
		$text['imgctrls'] = "Zet afbeeldingen bediening aan";
		$text['vwrctrls'] = "Zet afbeelding Viewer bediening aan";
		$text['vwrclose'] = "Schakel afbeelding Viewer uit";
		break;

	case "dna":
		$text['test_date'] = "Testdatum";
		$text['links'] = "Relevante links";
		$text['testid'] = "Test ID";
		//added in 12.0.0
		$text['mode_values'] = "Mode Waardes";
		$text['compareselected'] = "Vergelijk Geselecteerd";
		$text['dnatestscompare'] = "Vergelijk Y-DNA Tests";
		$text['keep_name_private'] = "Hou Naam Priv&eacute;";
		$text['browsealltests'] = "Blader door Alle Tests";
		$text['all_dna_tests'] = "Alle DNA tests";
		$text['fastmutating'] = "Snel Bewerken";
		$text['alltypes'] = "Alle Types";
		$text['allgroups'] = "Alle Groepen";
		$text['Ydna_LITbox_info'] = "Test(en) gelinked aan deze persoon zijn niet noodzakelijk ook ondergaan door deze persoon.<br />De 'Haplogroep' kolom toont data in rood als het resultaat is 'voorspelt' of groen al de test is 'bevestigd'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Vergelijk geselecteerde mtDNA Tests";
		$text['dnatestscompare_atdna'] = "Vergelijk geselecteerde atDNA Tests";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Extra Mutaties";
		$text['mrca'] = "MRC voorouder";
		$text['ydna_test'] = "Y-DNA Tests";
		$text['mtdna_test'] = "mtDNA (Mitochondrial) Tests";
		$text['atdna_test'] = "atDNA (autosomal) Tests";
		$text['segment_start'] = "Start";
		$text['segment_end'] = "Einde";
		$text['suggested_relationship'] = "Voorgesteld";
		$text['actual_relationship'] = "Daadwerkelijk";
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
$text['matches'] = "Treffers";
$text['description'] = "Beschrijving";
$text['notes'] = "Aantekeningen";
$text['status'] = "Status";
$text['newsearch'] = "Nieuwe zoekopdracht";
$text['pedigree'] = "Stamboom";
$text['seephoto'] = "Zie foto";
$text['andlocation'] = "& plaats";
$text['accessedby'] = "bezocht door";
$text['children'] = "Kinderen";  //from getperson
$text['tree'] = "Stamboom";
$text['alltrees'] = "Alle stambomen";
$text['nosurname'] = "[geen familienaam]";
$text['thumb'] = "Klikplaatje";  //as in Thumbnail
$text['people'] = "Personen";
$text['title'] = "Titel";  //from getperson
$text['suffix'] = "Achtervoegsel";  //from getperson
$text['nickname'] = "Roepnaam";  //from getperson
$text['lastmodified'] = "Laatst gewijzigd op";  //from getperson
$text['married'] = "Getrouwd";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Naam"; //from showmap
$text['lastfirst'] = "Familienaam, Voorna(a)m(en)";  //from search
$text['bornchr'] = "Geboren / Gedoopt";  //from search
$text['individuals'] = "Personen";  //from whats new
$text['families'] = "Gezinnen";
$text['personid'] = "Persoon-ID";
$text['sources'] = "Bronnen";  //from getperson (next several)
$text['unknown'] = "Onbekend";
$text['father'] = "Vader";
$text['mother'] = "Moeder";
$text['christened'] = "Gedoopt";
$text['died'] = "Overleden";
$text['buried'] = "Begraven";
$text['spouse'] = "Partner";  //from search
$text['parents'] = "Ouders";  //from pedigree
$text['text'] = "Tekst";  //from sources
$text['language'] = "Taal";  //from languages
$text['descendchart'] = "Nakomelingen";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Persoon";
$text['edit'] = "Wijzig";
$text['date'] = "Datum";
$text['login'] = "Aanmelden";
$text['logout'] = "Afmelden";
$text['groupsheet'] = "Gezinsblad";
$text['text_and'] = "en";
$text['generation'] = "Generatie";
$text['filename'] = "Bestandsnaam";
$text['id'] = "ID";
$text['search'] = "Zoek";
$text['user'] = "Gebruiker";
$text['firstname'] = "Voornaam";
$text['lastname'] = "Familienaam";
$text['searchresults'] = "Zoekresultaten";
$text['diedburied'] = "Overleden / Begraven";
$text['homepage'] = "Startpagina";
$text['find'] = "Zoeken...";
$text['relationship'] = "Verwantschap";		//in German, Verwandtschaft
$text['relationship2'] = "Verwantschap"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Tijdlijn";
$text['yesabbr'] = "J";               //abbreviation for 'yes'
$text['divorced'] = "Gescheiden";
$text['indlinked'] = "Verbonden met";
$text['branch'] = "Tak";
$text['moreind'] = "Meer personen";
$text['morefam'] = "Meer gezinnen";
$text['surnamelist'] = "Familienamenlijst";
$text['generations'] = "Generaties";
$text['refresh'] = "Verversen";
$text['whatsnew'] = "Wat is er nieuw";
$text['reports'] = "Rapporten";
$text['placelist'] = "Plaatsen overzicht";
$text['baptizedlds'] = "Gedoopt (HLD)";
$text['endowedlds'] = "Begiftigd (HLD)";
$text['sealedplds'] = "Verzegeld ouders (HLD)";
$text['sealedslds'] = "Verzegeld partner (HLD)";
$text['ancestors'] = "Voorouders";
$text['descendants'] = "Nakomelingen";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum van laatste GEDCOM import";
$text['type'] = "Type";
$text['savechanges'] = "Veranderingen opslaan";
$text['familyid'] = "Gezins-ID";
$text['headstone'] = "Grafstenen";
$text['historiesdocs'] = "(Levens)verhalen";
$text['anonymous'] = "anoniem";
$text['places'] = "Plaatsen";
$text['anniversaries'] = "Datums & verjaardagen";
$text['administration'] = "Administratie";
$text['help'] = "Help";
//$text['documents'] = "Documents";
$text['year'] = "Jaar";
$text['all'] = "Alles";
$text['address'] = "Adres";
$text['suggest'] = "Suggestie";
$text['editevent'] = "Wijzigingsvoorstel mbt deze gebeurtenis";
$text['morelinks'] = "Meer linken";
$text['faminfo'] = "Gezinsinformatie";
$text['persinfo'] = "Persoonlijke informatie";
$text['srcinfo'] = "Bron informatie";
$text['fact'] = "Feit";
$text['goto'] = "Selecteer een pagina";
$text['tngprint'] = "Print";
$text['databasestatistics'] = "Statistieken"; //needed to be shorter to fit on menu
$text['child'] = "Kind";  //from familygroup
$text['repoinfo'] = "Vindplaats informatie";
$text['tng_reset'] = "Maak leeg";
$text['noresults'] = "Geen resultaten gevonden";
$text['allmedia'] = "Alle Media";
$text['repositories'] = "Vindplaatsen";
$text['albums'] = "Albums";
$text['cemeteries'] = "Begraafplaatsen";
$text['surnames'] = "Familienamen";
$text['dates'] = "Datums";
$text['link'] = "Link";
$text['media'] = "Media";
$text['gender'] = "Geslacht";
$text['latitude'] = "Latitude (Breedte)";
$text['longitude'] = "Longitude (Lengte)";
$text['bookmarks'] = "Bladwijzers";
$text['bookmark'] = "Voeg bladwijzer toe";
$text['mngbookmarks'] = "Ga naar de bladwijzers";
$text['bookmarked'] = "Bladwijzer toegevoegd";
$text['remove'] = "Verwijder";
$text['find_menu'] = "Zoek";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Begraafplaats";
$text['gmapevent'] = "Gebeurteniskaart";
$text['gevents'] = "Gebeurtenissen";
$text['googleearthlink'] = "Link naar Google Earth";
$text['googlemaplink'] = "Link naar Google Maps";
$text['gmaplegend'] = "Pin Legenda";
$text['unmarked'] = "Niet gemarkeerd";
$text['located'] = "Gelokaliseerd";
$text['albclicksee'] = "Klik hier om alle items in dit album te zien";
$text['notyetlocated'] = "Nog niet gelokaliseerd";
$text['cremated'] = "Gecremeerd";
$text['missing'] = "Vermist";
$text['pdfgen'] = "PDF-maker";
$text['blank'] = "Blanco formulier";
$text['fonts'] = "Lettertypen";
$text['header'] = "Kop";
$text['data'] = "Gegevens";
$text['pgsetup'] = "Paginaopmaak";
$text['pgsize'] = "Paginagrootte";
$text['orient'] = "Oriëntatie"; //for a page
$text['portrait'] = "Portret";
$text['landscape'] = "Landschap";
$text['tmargin'] = "Bovenmarge";
$text['bmargin'] = "Ondermarge";
$text['lmargin'] = "Linkermarge";
$text['rmargin'] = "Rechtermarge";
$text['createch'] = "Maak overzicht";
$text['prefix'] = "Prefix";
$text['mostwanted'] = "Gezocht";
$text['latupdates'] = "Laatste wijzigingen";
$text['featphoto'] = "Speciale foto";
$text['news'] = "Nieuws";
$text['ourhist'] = "Onze familiegeschiedenis";
$text['ourhistanc'] = "Onze familiegeschiedenis en voorouders";
$text['ourpages'] = "Genealogie-pagina's van onze familie";
$text['pwrdby'] = "Deze site werd aangemaakt door";
$text['writby'] = "geschreven door";
$text['searchtngnet'] = "Zoek in TNG Network (GENDEX)";
$text['viewphotos'] = "Bekijk alle foto's";
$text['anon'] = "U bent momenteel anoniem";
$text['whichbranch'] = "Van welke tak bent u?";
$text['featarts'] = "Speciale artikelen";
$text['maintby'] = "Gegevens onderhouden door";
$text['createdon'] = "Aangemaakt op";
$text['reliability'] = "Betrouwbaarheid";
$text['labels'] = "Labels";
$text['inclsrcs'] = "Laat bronnen zien";
$text['cont'] = "(vervolg)"; //abbreviation for continued
$text['mnuheader'] = "Startpagina";
$text['mnusearchfornames'] = "Zoeken naar namen";
$text['mnulastname'] = "Familienaam";
$text['mnufirstname'] = "Voorna(a)m(en)";
$text['mnusearch'] = "Zoek";
$text['mnureset'] = "Opnieuw";
$text['mnulogon'] = "Aanmelden";
$text['mnulogout'] = "Afmelden";
$text['mnufeatures'] = "Andere mogelijkheden";
$text['mnuregister'] = "Registreer uzelf";
$text['mnuadvancedsearch'] = "Geavanceerd zoeken";
$text['mnulastnames'] = "Familienamen";
$text['mnustatistics'] = "Statistieken";
$text['mnuphotos'] = "Foto's";
$text['mnuhistories'] = "(Levens)verhalen";
$text['mnumyancestors'] = "Foto's &amp; (Levens)verhalen mbt de voorouders van [Persoon]";
$text['mnucemeteries'] = "Begraafplaatsen";
$text['mnutombstones'] = "Grafstenen";
$text['mnureports'] = "Rapporten";
$text['mnusources'] = "Bronnen";
$text['mnuwhatsnew'] = "Wat is er nieuw";
$text['mnushowlog'] = "Laatste acties log";
$text['mnulanguage'] = "Verander van taal";
$text['mnuadmin'] = "Startpagina beheerder";
$text['welcome'] = "Welkom";
$text['contactus'] = "Contact";
//changed in 8.0.0
$text['born'] = "Geboren";
$text['searchnames'] = "Zoeken Personen";
//added in 8.0.0
$text['editperson'] = "Verander persoon";
$text['loadmap'] = "Laad de kaart";
$text['birth'] = "Geboorte";
$text['wasborn'] = "is geboren";
$text['startnum'] = "Eerste nummer";
$text['searching'] = "Zoekt";
//moved here in 8.0.0
$text['location'] = "Plaats";
$text['association'] = "Connectie";
$text['collapse'] = "Samenvouwen";
$text['expand'] = "Uitvouwen";
$text['plot'] = "Perceel";
$text['searchfams'] = "Zoek Families";
//added in 8.0.2
$text['wasmarried'] = "trouwt";
$text['anddied'] = "Overleden";
//added in 9.0.0
$text['share'] = "Deel";
$text['hide'] = "Onzichtbaar";
$text['disabled'] = "Uw gebruikersaccount is uitgezet. Neem aub contact op met de site administrator voor meer informatie.";
$text['contactus_long'] = "Als u vragen heeft over of commentaar op de informatie van deze site, <span class=\"emphasis\"><a href=\"suggest.php\">neem dan a.u.b. contact met ons op</a></span>. We horen graag van u.";
$text['features'] = "Rubrieken";
$text['resources'] = "Bronnen";
$text['latestnews'] = "Laatste nieuws";
$text['trees'] = "Stambomen";
$text['wasburied'] = "werd begraven";
//moved here in 9.0.0
$text['emailagain'] = "Bevestig e-mailadres";
$text['enteremail2'] = "Vul uw e-mail adres opnieuw in aub.";
$text['emailsmatch'] = "Uw e-mail adressen komen niet overeen.    Type hetzelfde e-mail adres in beide vakken.";
$text['getdirections'] = "Klik voor aanwijzingen";
$text['calendar'] = "Kalender";
//changed in 9.0.0
$text['directionsto'] = " naar de ";
$text['slidestart'] = "Dia voorstelling";
$text['livingnote'] = "Tenminste nog één levende persoon is verbonden aan deze aantekening - detailgegevens worden niet weergegeven.";
$text['livingphoto'] = "Tenminste één, nog levende, persoon is verbonden aan dit item - detailgegevens worden niet weergegeven.";
$text['waschristened'] = "Gedoopt";
//added in 10.0.0
$text['branches'] = "Takken";
$text['detail'] = "Detail";
$text['moredetail'] = "Meer details";
$text['lessdetail'] = "Minder details";
$text['conflds'] = "Bevestigd (LDS)";
$text['initlds'] = "Initiatie (LDS)";
$text['wascremated'] = "werd gecremeerd";
//moved here in 11.0.0
$text['text_for'] = "voor";
//added in 11.0.0
$text['searchsite'] = "Doorzoek deze site";
$text['searchsitemenu'] = "Doorzoek site";
$text['kmlfile'] = "Download een .kml file om deze locatie te tonen in Google Earth";
$text['download'] = "Klik om te downloaden";
$text['more'] = "Meer";
$text['heatmap'] = "Spreidingskaart";
$text['refreshmap'] = "Vernieuw de kaart";
$text['remnums'] = "Verwijder nummers en pinnen";
$text['photoshistories'] = "Photos &amp; Histories";
$text['familychart'] = "Familiekaart";
//added in 12.0.0
$text['firstnames'] = "Voornamen";
//moved here in 12.0.0
$text['dna_test'] = "DNA Test";
$text['test_type'] = "Test Type";
$text['test_info'] = "Test Informatie";
$text['takenby'] = "Taken by";
$text['haplogroup'] = "Haplogroep";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevante links";
$text['nofirstname'] = "[geen voornaam]";
//added in 12.0.1
$text['cookieuse'] = "Opmerking: Deze website gebruikt cookies.";
$text['dataprotect'] = "Data Beschermings Beleid";
$text['viewpolicy'] = "Bekijk beleid";
$text['understand'] = "Ik begrijp het";
$text['consent'] = "Ik geef mijn toestemming aan deze website om de persoonlijke informatie die ik hier opgeef op te slaan.. Ik begrijp dat ik de website eigenaar op ieder moment mag vragen om deze informatie weer te verwijderen.";
$text['consentreq'] = "Geef altublieft uw toestemming aan deze website om persoonlijke informatie op te slaan.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Snelle Links ";
$text['yourname'] = "Uw naam";
$text['youremail'] = "Uw e-mailadres";
$text['liketoadd'] = "Alle informatie die u wilt toevoegen";
$text['webmastermsg'] = "Bericht Beheerder";
$text['gallery'] = "Zie Galerij";
$text['wasborn_male'] = "is geboren";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "is geboren"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "is gedoopt";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "is gedoopt";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "is gestorven";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "is gestorven";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "is begraven"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "is begraven"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "is gecremeerd";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "is gecremeerd";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "is getrouwd met";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "is getrouwd met";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "is gescheiden van";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "is gescheiden van";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " in ";			// used as a preposition to the location
$text['onthisdate'] = " op ";		// when used with full date
$text['inthisyear'] = " in ";		// when used with year only or month / year dates
$text['and'] = "en ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Test Info";
//added in 13.0
$text['visitor'] = "Bezoeker";

$text['popupnote2'] = " = Start nieuw voorouder-overzicht vanaf deze persoon";

//moved here in 14.0
$text['zoomin'] = "Zoom In";
$text['zoomout'] = "Zoom Uit";
$text['scrollnote'] = "Opm.: Scroll eventueel naar beneden of naar rechts om alles te kunnen zien.";
$text['general'] = "Algemeen";

//changed in 14.0
$text['otherevents'] = "Andere gebeurtenis soorten en attributen";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Connecties";
$text['continue'] = "Doorgaan";
$text['title2'] = "Titel"; //voor media, bronnen, etc (geen personen)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>