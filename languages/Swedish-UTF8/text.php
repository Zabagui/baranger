<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Bläddra i källor";
		$text['shorttitle'] = "Kort titel";
		$text['callnum'] = "Klassifikation";
		$text['author'] = "Författare";
		$text['publisher'] = "Förläggare";
		$text['other'] = "Annan information";
		$text['sourceid'] = "Källans ID";
		$text['moresrc'] = "Flera källor";
		$text['repoid'] = "Arkivets ID";
		$text['browseallrepos'] = "Sök alla arkiv";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nytt språk";
		$text['changelanguage'] = "Byt språk";
		$text['languagesaved'] = "Språket har sparats";
		$text['sitemaint'] = "Underhåll av sajten pågår";
		$text['standby'] = "Denna sajt är tillfälligt nere pga uppdatering av databasen. Försök igen om några minuter. Om sajten är nere en längre tid, <a href=\"suggest.php\">kontakta sajtens ägare</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM startar från";
		$text['producegedfrom'] = "Skapa GEDCOM-fil från";
		$text['numgens'] = "Antal generationer";
		$text['includelds'] = "Inkludera LDS-information";
		$text['buildged'] = "Generera GEDCOM";
		$text['gedstartfrom'] = "GEDCOM startar från";
		$text['nomaxgen'] = "Du måste ange maximum antal generationer. Använd bakåtknappen för att återvända till föregående sida och korrigera felet";
		$text['gedcreatedfrom'] = "GEDCOM skapad från";
		$text['gedcreatedfor'] = "skapad för";
		$text['creategedfor'] = "Skapa GEDCOM";
		$text['email'] = "E-postadress";
		$text['suggestchange'] = "Föreslå förändring";
		$text['yourname'] = "Ditt namn";
		$text['comments'] = "Anteckningar och kommentarer";
		$text['comments2'] = "Kommentarer";
		$text['submitsugg'] = "Skicka förslaget";
		$text['proposed'] = "Föreslagen förändring";
		$text['mailsent'] = "Tack. Ditt meddelande har skickats.";
		$text['mailnotsent'] = "Vi beklagar att ditt meddelande inte kunnat skickats. Kontakta xxx direkt på yyy.";
		$text['mailme'] = "Skicka en kopia till denna adress";
		$text['entername'] = "Skriv in ditt namn";
		$text['entercomments'] = "Skriv in dina kommentarer";
		$text['sendmsg'] = "Sänd meddelandet";
		//added in 9.0.0
		$text['subject'] = "Ämne";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Foton & text-dokument för";
		$text['indinfofor'] = "Individuell information för";
		$text['pp'] = "sid."; //page abbreviation
		$text['age'] = "Ålder";
		$text['agency'] = "Firma";
		$text['cause'] = "Orsak";
		$text['suggested'] = "Föreslagen";
		$text['closewindow'] = "Stäng detta fönster";
		$text['thanks'] = "Tack";
		$text['received'] = "Ditt förslag har skickats till sajtens administratör för behandling.";
		$text['indreport'] = "Individrapport";
		$text['indreportfor'] = "Individrapport för";
		$text['bkmkvis'] = "<strong>OBS:</strong> Dessa bokmärken syns bara på denna dator och i denna webläsare.";
        //added in 9.0.0
		$text['reviewmsg'] = "Du har ett ändringsförslag att kontrollera. Ändringen gäller:";
        $text['revsubject'] = "Ett ändringsförslag behöver kontrolleras";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Släktskapsberäkning";
		$text['findrel'] = "Beräkna släktskap";
		$text['person1'] = "Person 1:";
		$text['person2'] = "Person 2:";
		$text['calculate'] = "Beräkna";
		$text['select2inds'] = "Välj två individer.";
		$text['findpersonid'] = "Sök person-ID";
		$text['enternamepart'] = "mata in del av för- och/eller efternamn";
		$text['pleasenamepart'] = "Mata in en del av ett för- eller efternamn.";
		$text['clicktoselect'] = "klicka för val";
		$text['nobirthinfo'] = "Ingen födelseinformation";
		$text['relateto'] = "Släktskap med";
		$text['sameperson'] = "De två individerna är samma person.";
		$text['notrelated'] = "De två individerna är inte besläktade inom de xxx närmaste generationerna."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Skriv in ID för två individer, eller behåll de visade personerna, klicka sedan på 'Beräkna' för att visa deras släktskap.";
		$text['sometimes'] = "(Ibland får man ett annat resultat om man söker över ett annat antal generationer.)";
		$text['findanother'] = "Hitta ett annat släkskap";
		$text['brother'] = "bror till";
		$text['sister'] = "syster till";
		$text['sibling'] = "syskon till";
		$text['uncle'] = "xxx farbror/morbror till";
		$text['aunt'] = "xxx faster/moster till";
		$text['uncleaunt'] = "xxx farbror/morbror eller faster/moster till";
		$text['nephew'] = "xxx bror-/systerson till";
		$text['niece'] = "xxx bror-/systerdotter till";
		$text['nephnc'] = "xxx brors-/systersbarn till";
		$text['removed'] = "gånger borttagna";
		$text['rhusband'] = "make till ";
		$text['rwife'] = "maka till ";
		$text['rspouse'] = "make/make till ";
		$text['son'] = "son till";
		$text['daughter'] = "dotter till";
		$text['rchild'] = "barn till";
		$text['sil'] = "svärson till";
		$text['dil'] = "svärdotter till";
		$text['sdil'] = "svärson/-dotter till";
		$text['gson'] = "xxx son-/dotterson till";
		$text['gdau'] = "xxx son-/dotterdotter till";
		$text['gsondau'] = "xxx barnbarn till";
		$text['great'] = "far/mor";
		$text['spouses'] = "är makar";
		$text['is'] = "är";
		$text['changeto'] = "Ändra till:";
		$text['notvalid'] = "är inte ett giltigt person-ID eller finns inte i denna databas. Försök igen!";
		$text['halfbrother'] = "halvbror till";
		$text['halfsister'] = "halvsyster till";
		$text['halfsibling'] = "halvsyskon till";
		//changed in 8.0.0
		$text['gencheck'] = "Max generationer<br />att kontrollera";
		$text['mcousin'] = "xxx kusin yyy till";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx kusin yyy till";  //female cousin
		$text['cousin'] = "xxx kusin yyy till";
		$text['mhalfcousin'] = "xxx halvkusin yyy till";  //male cousin
		$text['fhalfcousin'] = " xxx halvkusin yyy till ";  //female cousin
		$text['halfcousin'] = " xxx halvkusin yyy till ";
		//added in 8.0.0
		$text['oneremoved'] = "en gång borttagen";
		$text['gfath'] = "xxx far-/morfar till";
		$text['gmoth'] = "xxx far-/mormor till";
		$text['gpar'] = "xxx far-/morförälder till";
		$text['mothof'] = "moder till";
		$text['fathof'] = "fader till";
		$text['parof'] = "förälder till";
		$text['maxrels'] = "Maximalt antal relationer att visa";
		$text['dospouses'] = "Visa relationer som innefattar en make/maka";
		$text['rels'] = "Relationer";
		$text['dospouses2'] = "Visa makar";
		$text['fil'] = "svärfader till";
		$text['mil'] = "svärmoder till";
		$text['fmil'] = "svärförälder till";
		$text['stepson'] = "styvson till";
		$text['stepdau'] = "styvdotter till";
		$text['stepchild'] = "styvbarn till";
		$text['stepgson'] = "xxx barns styvson till";
		$text['stepgdau'] = "xxx barns styvdotter till";
		$text['stepgchild'] = "xxx barns styvbarn till";
		//added in 8.1.1
		$text['ggreat'] = "far/mor (eng. great)";
		//added in 8.1.2
		$text['ggfath'] = "xxx far-/morföräldrars far till";
		$text['ggmoth'] = "xxx far-/morföräldrars mor till";
		$text['ggpar'] = "xxx far-/morföräldrars föräldrar till";
		$text['ggson'] = "xxx barnbarns son till";
		$text['ggdau'] = "xxx barnbarns dotter till";
		$text['ggsondau'] = "xxx barnbarns barn till";
		$text['gstepgson'] = "xxx barnbarns styvson till";
		$text['gstepgdau'] = "xxx barnbarns styvdotter till";
		$text['gstepgchild'] = "xxx barnbarns styvbarn till";
		$text['guncle'] = "xxx far-/morföräldrars far-/morbror till";
		$text['gaunt'] = "xxx far-/morföräldrars fas-/moster till";
		$text['guncleaunt'] = "xxx far-/morföräldrars far-/morbror eller fas-/moster till";
		$text['gnephew'] = "xxx syskonbarns son till";
		$text['gniece'] = "xxx syskonbarns dotter till";
		$text['gnephnc'] = "xxx syskonbarns barn till";
		//added in 14.0
		$text['pathscalc'] = "Sök kopplingar";
		$text['findrel2'] = "Hitta relationer och andra kopplingar";
		$text['makeme2nd'] = "Använd mitt ID";
		$text['usebookmarks'] = "Använd bokmärken";
		$text['select2inds'] = "Välj två individer.";
		$text['indinfofor'] = "Individ-info för";
		$text['nobookmarks'] = "Det finns inget bokmärke att använda";
		$text['bkmtitle'] = "Personer funna bland bokmärken";
		$text['bkminfo'] = "Välj en person:";
		$text['sortpathsby'] = "Sortera sökvägar på antal";
		$text['sortbyshort'] = "Sortera på";
		$text['bylengthshort'] = "Längd";
		$text['badID1'] = ": felaktigt person1-ID - gå tillbaka och rätta";
		$text['badID2'] = ": felaktigt person2-ID - gå tillbaka och rätta";
		$text['notintree'] = ": personen med detta ID finns inte i det valda trädet.";
		$text['sameperson'] = "De två individerna är samma person.";;
		$text['nopaths'] = "Dessa personer är inte kopplade.";
		$text['nopaths1'] = "Inga fler kopplingar kortare än xxx";
		$text['nopaths2'] = "i xxx söksteg";
		$text['longestpath'] = "(längsta kontrollerade sökväg hittills var xxx steg lång)";
		$text['relevantpaths'] = "Antal unika relevanta sökvägar funna: xxx";
		$text['skipMarr'] = "(dessutom  hittades följande antal sökvägar som inte visas pga för många vigslar: xxx)";
		$text['mjaor'] = "eller";
		$text['connectionsto'] = "Kopplingar till ";
		$text['findanotherpers'] = "Hitta ytterligare person...";
		$text['sometimes'] = "(Ibland får man ett annat resultat om man söker över ett annat antal generationer.)";
		$text['anotherpath'] = "Sök efter ytterligare kopplingar";
		$text['xpath'] = "Sökväg ";
		$text['primary'] = "Startperson"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Slutperson";
		$text['parent'] = "Förälder";
		$text['mhfather'] = "hans far";
		$text['mhmother'] = "hans mor";
		$text['mhhusband'] = "hans make";
		$text['mhwife'] = "hans hustru";
		$text['mhson'] = "hans son";
		$text['mhdaughter'] = "hans dotter";
		$text['fhfather'] = "hennes far";
		$text['fhmother'] = "hennes mor";
		$text['fhhusband'] = "hennes make";
		$text['fhwife'] = "hennes hustru";
		$text['fhson'] = "hennes son";
		$text['fhdaughter'] = "hennes dotter";
		$text['hfather'] = "far";
		$text['hmother'] = "mor";
		$text['hhusband'] = "make";
		$text['hwife'] = "maka";
		$text['hson'] = "son";
		$text['hdaughter'] = "dotter";
		$text['maxruns'] = "Max antal sökvägar att kontrollera";
		$text['maxrshort'] = "Max sökvägar";
		$text['maxlength'] = "Kopplingsvägar ej längre än";
		$text['maxlshort'] = "Max längd";
		$text['xstep'] = "steg";
		$text['xsteps'] = "steg";
		$text['xmarriages'] = "xxx vigslar";
		$text['xmarriage'] = "1 vigsel";
		$text['showspouses'] = "Visa båda makarna";
		$text['showTxt'] = "Visa sökvägsbeskrivningen i textformat";
		$text['showTxtshort'] = "Beskr. i textformat";
		$text['compactBox'] = "Visa kompakta personrutor";
		$text['compactBoxshort'] = "Kompakta rutor";
		$text['paths'] = "Sökvägar";
		$text['dospouses2'] = "Visa makar";
		$text['maxmopt'] = "Max vigslar per koppling"; 
		$text['maxm'] = "Max vigslar"; 
		$text['arerelated'] = "Dessa personer är släkt - deras släktskap visas i Sökväg 1";
		$text['simplerel'] = "Enkel släktskapssökning";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Familjeöversikt för";
		$text['ldsords'] = "LDS förrättningar";
		$text['baptizedlds'] = "Döpt (LDS)";
		$text['endowedlds'] = "Begåvad (LDS)";
		$text['sealedplds'] = "Beseglad F (LDS)";
		$text['sealedslds'] = "Beseglad M (LDS)";
		$text['otherspouse'] = "Annan make/maka";
		$text['husband'] = "Make";
		$text['wife'] = "Maka";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "F";
		$text['capaltbirthabbr'] = "F";
		$text['capdeathabbr'] = "D";
		$text['capburialabbr'] = "B";
		$text['capplaceabbr'] = "P";
		$text['capmarrabbr'] = "V";
		$text['capspouseabbr'] = "M";
		$text['redraw'] = "Rita om med";
		$text['unknownlit'] = "Okänd";
		$text['popupnote1'] = " = Ytterligare information";
		$text['pedcompact'] = "Kompakt";
		$text['pedstandard'] = "Standard";
		$text['pedtextonly'] = "Endast text";
		$text['descendfor'] = "Ättlingar till";
		$text['maxof'] = "Maximum";
		$text['gensatonce'] = "generationer visas samtidigt.";
		$text['sonof'] = "son till";
		$text['daughterof'] = "dotter till";
		$text['childof'] = "barn till";
		$text['stdformat'] = "Standardformat";
		$text['ahnentafel'] = "Listad antavla";
		$text['addnewfam'] = "Lägg till familj";
		$text['editfam'] = "Redigera familj";
		$text['side'] = "-sidan";
		$text['familyof'] = "Släkt till";
		$text['paternal'] = "På fädernet";
		$text['maternal'] = "På mödernet";
		$text['gen1'] = "Själv";
		$text['gen2'] = "Föräldrar";
		$text['gen3'] = "Far/morföräldrar";
		$text['gen4'] = "4:e generationen";
		$text['gen5'] = "5:e generationen";
		$text['gen6'] = "6:e generationen";
		$text['gen7'] = "7:e generationen";
		$text['gen8'] = "8:e generationen";
		$text['gen9'] = "9:e generationen";
		$text['gen10'] = "10:e generationen";
		$text['gen11'] = "11:e generationen";
		$text['gen12'] = "12:e generationen";
		$text['graphdesc'] = "Grafiskt ättlingaverk till denna punkt";
		$text['pedbox'] = "Ruta";
		$text['regformat'] = "Registerformat";
		$text['extrasexpl'] = "Om foton eller dokument finns för följande personer visas motsvarande symboler intill namnen.";
		$text['popupnote3'] = " = Nytt diagram";
		$text['mediaavail'] = "Media finns";
		$text['pedigreefor'] = "Antavla för";
		$text['pedigreech'] = "Antavla";
		$text['datesloc'] = "Datum och Platser";
		$text['borchr'] = "Födelse/Dop - Död/Begravning (två)";
		$text['nobd'] = "Inga födelse- eller dödsdatum";
		$text['bcdb'] = "Födelse/Dop/Död/Begravning (fyra)";
		$text['numsys'] = "Numreringssystem";
		$text['gennums'] = "Generationsnummer";
		$text['henrynums'] = "Henry-nummer";
		$text['abovnums'] = "d'Aboville-nummer";
		$text['devnums'] = "de Villiers-nummer";
		$text['dispopts'] = "Visa alternativ";
		//added in 10.0.0
		$text['no_ancestors'] = "Inga anor funna";
		$text['ancestor_chart'] = "Vertical antavla";
		$text['opennewwindow'] = "Öppna i nytt fönster";
		$text['pedvertical'] = "Vertikal";
		//added in 11.0.0
		$text['familywith'] = "Familj med";
		$text['fcmlogin'] = "Logga in för att se detaljer ";
		$text['isthe'] = "är";
		$text['otherspouses'] = "andra makar/makor";
		$text['parentfamily'] = "Förälderns familj ";
		$text['showfamily'] = "Visa familj";
		$text['shown'] = "visad";
		$text['showparentfamily'] = "visa förälders familj";
		$text['showperson'] = "visa person";
		//added in 11.0.2
		$text['otherfamilies'] = "Andra familjer";
		//added in 14.0
		$text['dtformat'] = "Tabeller";
		$text['dtchildren'] = "Barn";
		$text['dtgrandchildren'] = "Barnbarn";
		$text['dtggrandchildren'] = "Barnbarnsbarn";
		$text['dtgggrandchildren'] = "Barnbarnsbarnsbarn"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "1"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Inga ättlingar";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Totalt";
		$text['dtselect'] = "Välj";
		$text['dteachfulltable'] = "Varje hel tabell kommer att ha";
		$text['dtrows'] = "rader";
		$text['dtdisplayingtable'] = "Visar tabell";
		$text['dtgototable'] = "Gå till tabell:";
		$text['fcinstrdn'] = "Visa familj med make/maka";
		$text['fcinstrup'] = "Visa familj med föräldrar";
		$text['fcinstrplus'] = "Välj andra makar/makor";
		$text['fcinstrfam'] = "Välj andra föräldrar";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Det finns inga rapporter.";
		$text['reportname'] = "Rapportnamn";
		$text['allreports'] = "Rapporter";
		$text['report'] = "Rapport";
		$text['error'] = "Fel";
		$text['reportsyntax'] = "Denna rapports sök-syntax";
		$text['wasincorrect'] = "var ej korrekt, och rapporten kunde därför inte skapas. Kontakta systemadministratören på";
		$text['errormessage'] = "Felmeddelande";
		$text['equals'] = "lika med";
		$text['endswith'] = "slutar med";
		$text['soundexof'] = "soundex av";
		$text['metaphoneof'] = "metaphone av";
		$text['plusminus10'] = "±10 år från";
		$text['lessthan'] = "mindre än";
		$text['greaterthan'] = "större än";
		$text['lessthanequal'] = "mindre än eller lika med";
		$text['greaterthanequal'] = "större än eller lika med";
		$text['equalto'] = "lika med";
		$text['tryagain'] = "Försök igen";
		$text['joinwith'] = "Sammanfoga med";
		$text['cap_and'] = "OCH";
		$text['cap_or'] = "ELLER";
		$text['showspouse'] = "Visa make/maka (visar flera om individen har mer än en make/maka)";
		$text['submitquery'] = "Sök";
		$text['birthplace'] = "Födelseort";
		$text['deathplace'] = "Dödsort";
		$text['birthdatetr'] = "Födelseår";
		$text['deathdatetr'] = "Dödsår";
		$text['plusminus2'] = "±2 år från";
		$text['resetall'] = "Återställ alla värden";
		$text['showdeath'] = "Visa information om död/begravning";
		$text['altbirthplace'] = "Dopplats";
		$text['altbirthdatetr'] = "Dopår";
		$text['burialplace'] = "Begravningsplats";
		$text['burialdatetr'] = "Begravningsår";
		$text['event'] = "Händelse(r)";
		$text['day'] = "Dag";
		$text['month'] = "Månad";
		$text['keyword'] = "Nyckelord (t ex \"CA\")";
		$text['explain'] = "Skriv in datumfält för att se motsvarande händelser. Lämna fältet tomt för att se alla händelser.";
		$text['enterdate'] = "Skriv in eller välj minst en av följande: Dag, Månad, År, Nyckelord";
		$text['fullname'] = "Fullständigt namn";
		$text['birthdate'] = "Födelsedag";
		$text['altbirthdate'] = "Dopdag";
		$text['marrdate'] = "Bröllopsdag";
		$text['spouseid'] = "Make/maka ID";
		$text['spousename'] = "Makes/makas namn";
		$text['deathdate'] = "Dödsdag";
		$text['burialdate'] = "Begravningsdag";
		$text['changedate'] = "Senast ändrad, datum";
		$text['gedcom'] = "Träd";
		$text['baptdate'] = "Dopdag (LDS)";
		$text['baptplace'] = "Dopplats (LDS)";
		$text['endldate'] = "Begåvningsdag (LDS)";
		$text['endlplace'] = "Begåvningsplats (LDS)";
		$text['ssealdate'] = "Beseglingsdag S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Beseglingsplats S (LDS)";
		$text['psealdate'] = "Beseglingsdag P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Beseglingsplats P (LDS)";
		$text['marrplace'] = "Vigselort";
		$text['spousesurname'] = "Makes/makas efternamn";
		$text['spousemore'] = "Om du skriver in makes/makas efternamn, så måste du fylla i ytterligare minst ett fält.";
		$text['plusminus5'] = "±5 år från";
		$text['exists'] = "finns";
		$text['dnexist'] = "finns inte";
		$text['divdate'] = "Skilsmässodatum";
		$text['divplace'] = "Skilsmässoplats";
		$text['otherevents'] = "Andra Händelser";
		$text['numresults'] = "Resultat per sida";
		$text['mysphoto'] = "Gåtfulla foton";
		$text['mysperson'] = "Svårfångade personer";
		$text['joinor'] = "Alternativet 'Sammanfoga med ELLER' kan inte användas med makes/makas efternamn";
		$text['tellus'] = "Berätta vad du vet";
		$text['moreinfo'] = "Mera information:";
		//added in 8.0.0
		$text['marrdatetr'] = "Vigselår";
		$text['divdatetr'] = "Skilsmässoår";
		$text['mothername'] = "Moderns Namn";
		$text['fathername'] = "Faderns Namn";
		$text['filter'] = "Filter";
		$text['notliving'] = "Inte Levande";
		$text['nodayevents'] = "Händelser denna månad som inte är förknippade med en viss dag:";
		//added in 9.0.0
		$text['csv'] = "Kommaseparerad CSV-fil";
		//added in 10.0.0
		$text['confdate'] = "Confirmation Date (LDS)";
		$text['confplace'] = "Confirmation Place (LDS)";
		$text['initdate'] = "Initiatory Date (LDS)";
		$text['initplace'] = "Initiatory Place (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Vigseltyp";
		$text['searchfor'] = "Sök efter";
		$text['searchnote'] = "OBS: Denna sida använder Google för sin sökning. Antal träffar beror på hur Google lyckats indexera sajten.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Logg-fil för";
		$text['mostrecentactions'] = "Senaste åtgärder";
		$text['autorefresh'] = "Auto-uppdatering (30 sekunder)";
		$text['refreshoff'] = "Stäng av Auto-uppdatering";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Begravningsplatser och gravstenar";
		$text['showallhsr'] = "Visa alla gravstenar";
		$text['in'] = "i";
		$text['showmap'] = "Visa karta";
		$text['headstonefor'] = "Gravsten för";
		$text['photoof'] = "Foto av";
		$text['photoowner'] = "Ägare av original";
		$text['nocemetery'] = "Ingen begravningsplats";
		$text['iptc005'] = "Titel";
		$text['iptc020'] = "Tilläggskategorier";
		$text['iptc040'] = "Specialinstruktioner";
		$text['iptc055'] = "Skapat";
		$text['iptc080'] = "Författare";
		$text['iptc085'] = "Författarens position";
		$text['iptc090'] = "Stad";
		$text['iptc095'] = "Stat";
		$text['iptc101'] = "Land";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Rubrik";
		$text['iptc110'] = "Källa";
		$text['iptc115'] = "Fotografiets källa";
		$text['iptc116'] = "Upphovsmannarätten";
		$text['iptc120'] = "Bildtext";
		$text['iptc122'] = "Biltextens författare";
		$text['mapof'] = "Karta över";
		$text['regphotos'] = "Beskrivande översikt";
		$text['gallery'] = "Endast frimärksbilder";
		$text['cemphotos'] = "Begravningsplatsfoton";
		$text['photosize'] = "Storlek";
        $text['iptc010'] = "Prioritet";
		$text['filesize'] = "Filstorlek";
		$text['seeloc'] = "Se Plats";
		$text['showall'] = "Visa alla";
		$text['editmedia'] = "Redigera Media";
		$text['viewitem'] = "Se denna post";
		$text['editcem'] = "Redigera begravningsplats";
		$text['numitems'] = "# Poster";
		$text['allalbums'] = "Alla Album";
		$text['slidestop'] = "Pausa Bildspel";
		$text['slideresume'] = "Återuppta Bildspel";
		$text['slidesecs'] = "Sekunder per bild:";
		$text['minussecs'] = "minus 0.5 sekunder";
		$text['plussecs'] = "plus 0.5 sekunder";
		$text['nocountry'] = "Okänt land";
		$text['nostate'] = "Okänd stat";
		$text['nocounty'] = "Okänt län";
		$text['nocity'] = "Okänd stad";
		$text['nocemname'] = "Okänd begravningsplats";
		$text['editalbum'] = "Redigera Album";
		$text['mediamaptext'] = "<strong>OBS:</strong> Flytta muspekaren över bilden för att visa namn. Klicka för att se en sida för varje namn.";
		//added in 8.0.0
		$text['allburials'] = "Alla Begravningar";
		$text['moreinfo'] = "Mera information:";
		//added in 9.0.0
        $text['iptc025'] = "Nyckelord";
        $text['iptc092'] = "Plats";
		$text['iptc015'] = "Kategori";
		$text['iptc065'] = "Ursprungligt Program";
		$text['iptc070'] = "Programversion";
		//added in 13.0
		$text['toggletags'] = "Växla taggar";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Visa efternamn som börjar med";
		$text['showtop'] = "Visa de första";
		$text['showallsurnames'] = "Visa alla efternamn";
		$text['sortedalpha'] = "sorterade alfabetiskt";
		$text['byoccurrence'] = "sorterade efter förekomst";
		$text['firstchars'] = "Första bokstav";
		$text['mainsurnamepage'] = "Huvudsida för efternamn";
		$text['allsurnames'] = "Alla efternamn";
		$text['showmatchingsurnames'] = "Klicka på ett efternamn för att visa motsvarande poster.";
		$text['backtotop'] = "Tillbaka till början";
		$text['beginswith'] = "Börjar med";
		$text['allbeginningwith'] = "Alla efternamn som börjar med";
		$text['numoccurrences'] = "Antal förekomster inom parentes";
		$text['placesstarting'] = "Visa platser som börjar på";
		$text['showmatchingplaces'] = "Klicka på ett ortnamn för att visa mindre orter. Klicka på söksymbolen för att visa matchande personer.";
		$text['totalnames'] = "alla individer";
		$text['showallplaces'] = "Visa alla största platser";
		$text['totalplaces'] = "alla platser";
		$text['mainplacepage'] = "Huvudsida för platser";
		$text['allplaces'] = "Alla största platser";
		$text['placescont'] = "Visa alla platser som innehåller";
		//changed in 8.0.0
		$text['top30'] = "Topp-xxx efternamn";
		$text['top30places'] = "Topp-xxx platser";
		//added in 12.0.0
		$text['firstnamelist'] = "Förnamnslista";
		$text['firstnamesstarting'] = "Visa förnamn som börjar med";
		$text['showallfirstnames'] = "Visa alla förnamn";
		$text['mainfirstnamepage'] = "Huvudsida för förnamn";
		$text['allfirstnames'] = "Alla förnamn";
		$text['showmatchingfirstnames'] = "Klicka på ett förnamn för att visa alla träffar.";
		$text['allfirstbegwith'] = "Alla förnamn som börjar med";
		$text['top30first'] = "De xxx vanligaste förnamnen";
		$text['allothers'] = "Alla andra";
		$text['amongall'] = "(bland alla namn)";
		$text['justtop'] = "Bara de xxx vanligaste";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(senaste xx dagarna)";

		$text['photo'] = "Foto";
		$text['history'] = "Text-dokument";
		$text['husbid'] = "Makens ID";
		$text['husbname'] = "Makens namn";
		$text['wifeid'] = "Makans ID";
		//added in 11.0.0
		$text['wifename'] = "Hustruns Namn";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Stryk";
		$text['addperson'] = "Lägg till person";
		$text['nobirth'] = "Följande individ har inte korrekt födelsedatum och kunde inte läggas till";
		$text['event'] = "Händelse(r)";
		$text['chartwidth'] = "Diagrambredd";
		$text['timelineinstr'] = "Lägg till ytterligare upp till fyra individer genom att mata in deras ID:";
		$text['togglelines'] = "Visa/dölj linjer";
		//changed in 9.0.0
		$text['noliving'] = "Följande individer är märkta såsom levande och kunde inte läggas till p.g.a. att du inte är inloggad med tillräckliga rättigheter";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Bläddra i träd";
		$text['treename'] = "Trädets namn";
		$text['owner'] = "Ägare";
		$text['address'] = "Adress";
		$text['city'] = "Ort";
		$text['state'] = "Län/Provins/Delstat";
		$text['zip'] = "Postnummer";
		$text['country'] = "Land";
		$text['email'] = "E-postadress";
		$text['phone'] = "Telefon";
		$text['username'] = "Användarnamn";
		$text['password'] = "Lösenord";
		$text['loginfailed'] = "Inloggningen misslyckades.";

		$text['regnewacct'] = "Registrera användarkonto";
		$text['realname'] = "Ditt verkliga namn";
		$text['phone'] = "Telefon";
		$text['email'] = "E-postadress";
		$text['address'] = "Adress";
		$text['acctcomments'] = "Anteckningar och kommentarer";
		$text['submit'] = "Sänd bidrag";
		$text['leaveblank'] = "(lämna tomt om du önskar en ny trädstruktur)";
		$text['required'] = "Obligatoriska fält";
		$text['enterpassword'] = "skriv in ett lösenord.";
		$text['enterusername'] = "Skriv in ett användarnamn.";
		$text['failure'] = "Tyvärr är användarnamnet i bruk. Använd bakåt-knappen i din bläddrare och välj ett annat användarnamn.";
		$text['success'] = "Tack! Vi har emottagit din registrering. Vi kontaktar dig när kontot är aktivt eller om ytterligare information behövs.";
		$text['emailsubject'] = "Ny TNG användarregistrering";
		$text['website'] = "Websajt";
		$text['nologin'] = "Har du ingen inlogging?";
		$text['loginsent'] = "Inloggningsinformationen har skickats";
		$text['loginnotsent'] = "Inloggningsinformationen har inte skickats";
		$text['enterrealname'] = "Skriv in ditt namn.";
		$text['rempass'] = "Förbli inloggad på denna dator";
		$text['morestats'] = "Mera statistik";
		$text['accmail'] = "<strong>OBS:</strong> För att få e-post från administratören angående ditt konto, se till att du inte blockerar e-post från denna domän!";
		$text['newpassword'] = "Nytt lösenord";
		$text['resetpass'] = "Återställ ditt lösenord";
		$text['nousers'] = "Detta formulär kan inte användas förrän minst en användarregistrering gjorts. Om Du äger denna sajt, gå till Admin/Användare och skapa Administrator-konto.";
		$text['noregs'] = "Vi tar för tillfället inte emot nya användarregistreringar. <a href=\"suggest.php\">Kontakta oss</a> direkt om du har kommentarer eller frågor om något på denna sajt.";
		$text['emailmsg'] = "Du har fått en begäran om ett nytt TNG konto. Logga in på ditt TNG admin-område för att ge rätta befogengenheter för kontot. Om du godkänner registreringen, meddela personen i fråga genom att svara på denna e-post.";
		$text['accactive'] = "Kontot har aktiverats, men användaren kommer inte att ha några särskilda rättigheter förrän du tilldelat dessa.";
		$text['accinactive'] = "Gå till Admin/Användare/Granska för att komma åt kontoinställningar. Kontot förblir inaktivt tills du redigerar och sparar posten minst en gång.";
		$text['pwdagain'] = "Lösenordet igen";
		$text['enterpassword2'] = "Ange ditt lösenord igen.";
		$text['pwdsmatch'] = "Ditt lösenord stämmer inte överens. Ange samma lösenord i båda fälten.";
		$text['acksubject'] = "Tack för att du registrerat dig"; //for a new user account
		$text['ackmessage'] = "Din ansökan om användarkonto har tagits emot. Ditt konto kommer att vara inaktivt tills det har granskats av administratören. Du kommer att meddelas via e-post när din inloggning är klar för användning.";
		//added in 12.0.0
		$text['switch'] = "Byt";
		//added in 14.0
		$text['newpassword2'] = "Nytt lösenord igen";
		$text['resetsuccess'] = "OK: Lösenordet har ändrats";
		$text['resetfail'] = "FEL: Lösenordet har inte ändrats";
		$text['failreason0'] = " (okänt databasfel)";
		$text['failreason2'] = " (du har inte rättigheter att ändra ditt lösenord)";
		$text['failreason3'] = " (lösendordet passade inte)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Bläddra i alla Grenar";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Kvantitet";
		$text['totindividuals'] = "Totalt antal individer";
		$text['totmales'] = "- varav manliga";
		$text['totfemales'] = "- varav kvinnliga";
		$text['totunknown'] = "- varav av okänt kön";
		$text['totliving'] = "- varav levande";
		$text['totfamilies'] = "Antal familjer";
		$text['totuniquesn'] = "Antal unika efternamn";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Totalt antal källor";
		$text['avglifespan'] = "Medellivslängd";
		$text['earliestbirth'] = "Tidigaste födelse";
		$text['longestlived'] = "Största livslängd";
		$text['days'] = "dagar";
		$text['age'] = "Ålder";
		$text['agedisclaimer'] = "Åldersberäkningarna baserar sig på individer med registrerade födelse- <EM>och</EM> dödsdatum. P.g.a att det kan finnas ofullständiga datumfält (t ex enbart \"1945\" eller \"BEF 1860\"), är dessa beräkingar inte helt tillförlitliga.";
		$text['treedetail'] = "Mera information om detta träd";
		$text['total'] = "Totalt antal";
		//added in 12.0
		$text['totdeceased'] = "Totalt antal avlidna";
		//added in 14.0
		$text['totalsourcecitations'] = "Totalt antal Källhänvisningar";
		break;

	case "notes":
		$text['browseallnotes'] = "Bläddra i alla Noteringar";
		break;

	case "help":
		$text['menuhelp'] = "Meny";
		break;

	case "install":
		$text['perms'] = "Alla rättigheter är definierade.";
		$text['noperms'] = "Rättigheter kunde inte definieras för följande filer:";
		$text['manual'] = "Ställ in dem manuellt!";
		$text['folder'] = "Mapp";
		$text['created'] = "har skapats";
		$text['nocreate'] = "kunde inte skapas. Skapa den manuellt!";
		$text['infosaved'] = "Informationen sparad, kopplingen verifierad!";
		$text['tablescr'] = "Tabellerna har skapats!";
		$text['notables'] = "Följande tabeller kunde inte skapas:";
		$text['nocomm'] = "TNG kommunicerar inte med databasen. Inga tabeller skapades.";
		$text['newdb'] = "Informationen sparad, kopplingen verifierad, ny databas skapad:";
		$text['noattach'] = "Informationen sparad. Koppling gjord och databas skapad, men TNG kan inte ansluta till den.";
		$text['nodb'] = "Informationen sparad. Koppling gjord, men databasen existerar inte och kunde inte skapas här. Verifiera att databasnamnet är korrekt eller använd din kontrollpanel för att skapa den.";
		$text['noconn'] = "Informationen sparad men kopplingen misslyckades. Ett eller flera av följande är fel:";
		$text['exists'] = "finns";
		$text['noop'] = "Ingen åtgärd har utförts.";
		//added in 8.0.0
		$text['nouser'] = "Användaren skapades inte. Användarnamnet kanske redan finns.";
		$text['notree'] = "Trädet skapades inte. Trädnamnet kanske redan finns.";
		$text['infosaved2'] = "Informationen sparades";
		$text['renamedto'] = "omdöpt till";
		$text['norename'] = "kunde inte döpas om";
		//changed in 13.0.0
		$text['loginfirst'] = "Vi har hittat dataposter för existerande användare. För att fortsätta måste du först logga in och tömma användar-tabellen.";
		break;

	case "imgviewer":
		$text['magmode'] = "Zoomläge";
		$text['panmode'] = "Panoreringsläge";
		$text['pan'] = "Klicka och drag för att manövrera inom bilden";
		$text['fitwidth'] = "Passa bredd";
		$text['fitheight'] = "Passa höjd";
		$text['newwin'] = "Nytt fönster";
		$text['opennw'] = "Öppna bilden i nytt fönster";
		$text['magnifyreg'] = "Klicka för att förstora en del av bilden";
		$text['imgctrls'] = "Aktivera Bildkontroller";
		$text['vwrctrls'] = "Aktivera Bildläsarens kontroller";
		$text['vwrclose'] = "Stäng Bildläsaren";
		break;

	case "dna":
		$text['test_date'] = "Testdatum";
		$text['links'] = "Relevanta länkar";
		$text['testid'] = "Test-ID";
		//added in 12.0.0
		$text['mode_values'] = "DNA-lägesvärden";
		$text['compareselected'] = "Jämför valda";
		$text['dnatestscompare'] = "Jämför Y-DNA-tester";
		$text['keep_name_private'] = "Behåll namnet privat";
		$text['browsealltests'] = "Bläddra i alla tester";
		$text['all_dna_tests'] = "Alla DNA-tester";
		$text['fastmutating'] = "Snabbmuterande";
		$text['alltypes'] = "Alla Typer";
		$text['allgroups'] = "Alla Grupper";
		$text['Ydna_LITbox_info'] = "Test länkade till denna person har inte nödvändigtvis tagits av personen själv.<br />Kolumnen 'Haplogrupp' visar data med röd text om resultatet är 'Beräknat' och grön om testet är 'Bekräftat'";
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
$text['matches'] = "Träffar";
$text['description'] = "Beskrivning";
$text['notes'] = "Noteringar";
$text['status'] = "Status";
$text['newsearch'] = "Ny sökning";
$text['pedigree'] = "Antavla";
$text['seephoto'] = "Se foto";
$text['andlocation'] = "& placering";
$text['accessedby'] = "läst av";
$text['children'] = "Barn";  //from getperson
$text['tree'] = "Träd";
$text['alltrees'] = "Alla träd";
$text['nosurname'] = "[Inget efternamn]";
$text['thumb'] = "Frimärke";  //as in Thumbnail
$text['people'] = "Människor";
$text['title'] = "Titel";  //from getperson
$text['suffix'] = "Suffix";  //from getperson
$text['nickname'] = "Smeknamn";  //from getperson
$text['lastmodified'] = "Senast ändrad";  //from getperson
$text['married'] = "Gift";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Namn"; //from showmap
$text['lastfirst'] = "Efternamn, förnamn";  //from search
$text['bornchr'] = "Född/Döpt";  //from search
$text['individuals'] = "Individer";  //from whats new
$text['families'] = "Familjer";
$text['personid'] = "Person-ID";
$text['sources'] = "Källor";  //from getperson (next several)
$text['unknown'] = "Okänd";
$text['father'] = "Far";
$text['mother'] = "Mor";
$text['christened'] = "Döpt";
$text['died'] = "Död";
$text['buried'] = "Begravd";
$text['spouse'] = "Make/Maka";  //from search
$text['parents'] = "Föräldrar";  //from pedigree
$text['text'] = "Text";  //from sources
$text['language'] = "Språk";  //from languages
$text['descendchart'] = "Ättlingar";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Individ";
$text['edit'] = "Redigera";
$text['date'] = "Datum";
$text['login'] = "Logga in";
$text['logout'] = "Logga ut";
$text['groupsheet'] = "Familjeöversikt";
$text['text_and'] = "och";
$text['generation'] = "Generation";
$text['filename'] = "Filnamn";
$text['id'] = "ID";
$text['search'] = "Sök";
$text['user'] = "Användare";
$text['firstname'] = "Förnamn";
$text['lastname'] = "Efternamn";
$text['searchresults'] = "Sökresultat";
$text['diedburied'] = "Död/Begraven";
$text['homepage'] = "Hem";
$text['find'] = "Sök...";
$text['relationship'] = "Släktskap";		//in German, Verwandtschaft
$text['relationship2'] = "Relation"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Tidslinje";
$text['yesabbr'] = "J";               //abbreviation for 'yes'
$text['divorced'] = "Skilda";
$text['indlinked'] = "Länkad till";
$text['branch'] = "Gren";
$text['moreind'] = "Flera individer";
$text['morefam'] = "Flera familjer";
$text['surnamelist'] = "Efternamnslista";
$text['generations'] = "Generationer";
$text['refresh'] = "Uppdatera";
$text['whatsnew'] = "Nyheter";
$text['reports'] = "Rapporter";
$text['placelist'] = "Platslista";
$text['baptizedlds'] = "Döpt (LDS)";
$text['endowedlds'] = "Begåvad (LDS)";
$text['sealedplds'] = "Beseglad F (LDS)";
$text['sealedslds'] = "Beseglad M (LDS)";
$text['ancestors'] = "Anor";
$text['descendants'] = "Ättlingar";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Senaste GEDCOM import";
$text['type'] = "Typ";
$text['savechanges'] = "Spara ändringar";
$text['familyid'] = "Familjens ID";
$text['headstone'] = "Gravsten";
$text['historiesdocs'] = "Text-dokument";
$text['anonymous'] = "anonym";
$text['places'] = "Platser";
$text['anniversaries'] = "Datum & Bemärkelsedagar";
$text['administration'] = "Administration";
$text['help'] = "Hjälp";
//$text['documents'] = "Documents";
$text['year'] = "År";
$text['all'] = "Alla";
$text['address'] = "Adress";
$text['suggest'] = "Föreslå";
$text['editevent'] = "Föreslå ändring av denna händelse";
$text['morelinks'] = "Flera länkar";
$text['faminfo'] = "Familjeinformation";
$text['persinfo'] = "Personlig information";
$text['srcinfo'] = "Information om källan";
$text['fact'] = "Fakta";
$text['goto'] = "Välj en sida";
$text['tngprint'] = "Skriv ut";
$text['databasestatistics'] = "Databasstatistik"; //needed to be shorter to fit on menu
$text['child'] = "Barn";  //from familygroup
$text['repoinfo'] = "Arkivinformation";
$text['tng_reset'] = "Återställ";
$text['noresults'] = "Inget resultat";
$text['allmedia'] = "Alla Media";
$text['repositories'] = "Arkiv";
$text['albums'] = "Album";
$text['cemeteries'] = "Begravningsplatser";
$text['surnames'] = "Efternamn";
$text['dates'] = "Datum";
$text['link'] = "Länk";
$text['media'] = "Media";
$text['gender'] = "Kön";
$text['latitude'] = "Latitud";
$text['longitude'] = "Longitud";
$text['bookmarks'] = "Bokmärken";
$text['bookmark'] = "Lägg till Bokmärke";
$text['mngbookmarks'] = "Gå till Bokmärken";
$text['bookmarked'] = "Bokmärke tillagt";
$text['remove'] = "Ta bort";
$text['find_menu'] = "Hitta";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Begravningsplats";
$text['gmapevent'] = "Händelse-karta";
$text['gevents'] = "Händelse";
$text['googleearthlink'] = "Länk till Google Earth";
$text['googlemaplink'] = "Länk till Google Maps";
$text['gmaplegend'] = "Teckenförklaring, märken";
$text['unmarked'] = "Omarkerad";
$text['located'] = "Lokaliserad";
$text['albclicksee'] = "Klicka för att se alla poster i detta album.";
$text['notyetlocated'] = "Ej lokaliserad ännu";
$text['cremated'] = "Kremerad";
$text['missing'] = "Saknad";
$text['pdfgen'] = "PDF-Generator";
$text['blank'] = "Blankt diagram";
$text['fonts'] = "Fonter";
$text['header'] = "Rubrik";
$text['data'] = "Data";
$text['pgsetup'] = "Sidinställningar";
$text['pgsize'] = "Sidstorlek";
$text['orient'] = "Orientering"; //for a page
$text['portrait'] = "Stående";
$text['landscape'] = "Liggande";
$text['tmargin'] = "Toppmarginal";
$text['bmargin'] = "Bottenarginal";
$text['lmargin'] = "Vänstermarginal";
$text['rmargin'] = "Högermarginal";
$text['createch'] = "Skapa diagram";
$text['prefix'] = "Prefix";
$text['mostwanted'] = "Mest eftersökt";
$text['latupdates'] = "Senaste uppdateringar";
$text['featphoto'] = "Specialartikel foto";
$text['news'] = "Nyheter";
$text['ourhist'] = "Vår familjehistoria";
$text['ourhistanc'] = "Vår familjehistoria och anor";
$text['ourpages'] = "Vår familjs släktsida";
$text['pwrdby'] = "Denna sajt är byggd med";
$text['writby'] = "skapad av";
$text['searchtngnet'] = "Sök TNG Network (GENDEX)";
$text['viewphotos'] = "Se alla foton";
$text['anon'] = "Du är för närvarande anonym";
$text['whichbranch'] = "Vilken gren kommer du ifrån?";
$text['featarts'] = "Specialartiklar";
$text['maintby'] = "Underhålls av";
$text['createdon'] = "Skapad den";
$text['reliability'] = "Tillförlitlighet";
$text['labels'] = "Märken";
$text['inclsrcs'] = "Ta med källor";
$text['cont'] = "(forts.)"; //abbreviation for continued
$text['mnuheader'] = "Hemsida";
$text['mnusearchfornames'] = "Sök namn";
$text['mnulastname'] = "Efternamn";
$text['mnufirstname'] = "Förnamn";
$text['mnusearch'] = "Sök";
$text['mnureset'] = "Starta om";
$text['mnulogon'] = "Logga in";
$text['mnulogout'] = "Logga ut";
$text['mnufeatures'] = "Andra funktioner";
$text['mnuregister'] = "Ansök om användarkonto";
$text['mnuadvancedsearch'] = "Avancerad sökning";
$text['mnulastnames'] = "Efternamn";
$text['mnustatistics'] = "Statistik";
$text['mnuphotos'] = "Foton";
$text['mnuhistories'] = "Text-dokument";
$text['mnumyancestors'] = "Foton och Dokument för Anor till [Person]";
$text['mnucemeteries'] = "Begravningsplatser";
$text['mnutombstones'] = "Gravstenar";
$text['mnureports'] = "Rapporter";
$text['mnusources'] = "Källor";
$text['mnuwhatsnew'] = "Nyheter";
$text['mnushowlog'] = "Gå till Logg";
$text['mnulanguage'] = "Byt språk";
$text['mnuadmin'] = "Administration";
$text['welcome'] = "Välkommen";
$text['contactus'] = "Kontakt";
//changed in 8.0.0
$text['born'] = "Född";
$text['searchnames'] = "Sök namn";
//added in 8.0.0
$text['editperson'] = "Redigera person";
$text['loadmap'] = "Ladda kartan";
$text['birth'] = "Födelse";
$text['wasborn'] = "föddes";
$text['startnum'] = "Startnummer";
$text['searching'] = "Söker";
//moved here in 8.0.0
$text['location'] = "Plats";
$text['association'] = "Relation till";
$text['collapse'] = "Komprimera";
$text['expand'] = "Expandera";
$text['plot'] = "Grav";
$text['searchfams'] = "Sök Familjer";
//added in 8.0.2
$text['wasmarried'] = "Gift";
$text['anddied'] = "Död";
//added in 9.0.0
$text['share'] = "Dela";
$text['hide'] = "Dölj";
$text['disabled'] = "Ditt användarkonto har blivit inaktiverat. Kontakta webbadministratören för mera information.";
$text['contactus_long'] = "Om du har frågor eller kommentarer om innehållet på denna webbsida, <span class=\"emphasis\"><a href=\"suggest.php\">kontakta oss</a></span>. Vi ser fram emot att få höra ifrån dig.";
$text['features'] = "Funktioner";
$text['resources'] = "Resurser";
$text['latestnews'] = "Senaste nytt";
$text['trees'] = "Träd";
$text['wasburied'] = "är begravd";
//moved here in 9.0.0
$text['emailagain'] = "Upprepa e-mail";
$text['enteremail2'] = "Skriv in din e-mailadress igen.";
$text['emailsmatch'] = "Dina e-mailadresser matchar inte. Skriv in samma e-mailadress i båda fälten.";
$text['getdirections'] = "Klicka för att få guide";
$text['calendar'] = "Kalender";
//changed in 9.0.0
$text['directionsto'] = " till ";
$text['slidestart'] = "Bildspel";
$text['livingnote'] = "Minst en levande person är länkad till denna notering - Detaljer visas inte.";
$text['livingphoto'] = "Minst en levande person är länkad till denna bild - Detaljinformation visas inte.";
$text['waschristened'] = "Döpt";
//added in 10.0.0
$text['branches'] = "Grenar";
$text['detail'] = "Detalj";
$text['moredetail'] = "Flera detaljer";
$text['lessdetail'] = "Färre detaljer";
$text['conflds'] = "Konfirmerad (LDS)";
$text['initlds'] = "Initierad (LDS)";
$text['wascremated'] = "kremerades";
//moved here in 11.0.0
$text['text_for'] = "för";
//added in 11.0.0
$text['searchsite'] = "Sök på denna sajt";
$text['searchsitemenu'] = "Sök på denna sajt";
$text['kmlfile'] = "Ladda ner en .kml-fil för att visa denna plats i Google Earth";
$text['download'] = "Klicka för att ladda ner";
$text['more'] = "Mera";
$text['heatmap'] = "Populationskarta";
$text['refreshmap'] = "Ladda om kartan";
$text['remnums'] = "Rensa siffror och markörer";
$text['photoshistories'] = "Foton &amp; Historier";
$text['familychart'] = "Familjediagram";
//added in 12.0.0
$text['firstnames'] = "Förnamn";
//moved here in 12.0.0
$text['dna_test'] = "DNA-test";
$text['test_type'] = "Typ av test";
$text['test_info'] = "Information om testet";
$text['takenby'] = "Tagen av";
$text['haplogroup'] = "Haplogrupp";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevanta länkar";
$text['nofirstname'] = "[inget förnamn]";
//added in 12.0.1
$text['cookieuse'] = "OBS: Denna sajt använder cookies.";
$text['dataprotect'] = "Dataskyddspolicy ";
$text['viewpolicy'] = "Visa policy";
$text['understand'] = "Jag förstår";
$text['consent'] = "Jag godkänner att denna sajt lagrar den personliga information som samlas in här. Jag förstår att jag när som helst kan be sajtens ägare att radera denna information. ";
$text['consentreq'] = "Vänligen ge ditt samtycke till att denna sajt lagrar din personliga information.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Snabblänkar";
$text['yourname'] = "Ditt namn";
$text['youremail'] = "Din e-postadress";
$text['liketoadd'] = "All information du vill lägga till";
$text['webmastermsg'] = "Webmastermeddelande";
$text['gallery'] = "Se Galleri";
$text['wasborn_male'] = "föddes";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "föddes"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "döptes";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "döptes";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "dog";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "dog";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "begravdes"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "begravdes"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "kremerades";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "kremerades";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "gift";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "gift";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "skildes";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "skildes";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " i ";			// used as a preposition to the location
$text['onthisdate'] = " den ";		// when used with full date
$text['inthisyear'] = " ";		// when used with year only or month / year dates
$text['and'] = "och ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Information om DNA-test";
//added in 13.0
$text['visitor'] = "Besökare";

$text['popupnote2'] = " = Ny antavla";

//moved here in 14.0
$text['zoomin'] = "Zooma In";
$text['zoomout'] = "Zooma Ut";
$text['scrollnote'] = "Dra eller skrolla för att se mer av diagrammet.";
$text['general'] = "Allmänt";

//changed in 14.0
$text['otherevents'] = "Andra Händelser och Attribut";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Kopplingar";
$text['continue'] = "Fortsätt";
$text['title2'] = "Titel"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>