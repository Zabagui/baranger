<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Søk i alle kilder";
		$text['shorttitle'] = "Tittel";
		$text['callnum'] = "Plassignatur";
		$text['author'] = "Forfatter";
		$text['publisher'] = "Utgiver";
		$text['other'] = "Andre informasjoner";
		$text['sourceid'] = "Kilde ID";
		$text['moresrc'] = "Flere kilder";
		$text['repoid'] = "Arkiv ID";
		$text['browseallrepos'] = "Søk alle arkiver";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nytt språk";
		$text['changelanguage'] = "Bytt Språk";
		$text['languagesaved'] = "Språk lagret";
		$text['sitemaint'] = "Vedlikehold pågår";
		$text['standby'] = "Sidene er midlertidig utilgjengelige mens vi oppdaterer vår database. Prøv gjerne igjen senere. Hvis sidene forblir nede i en lengre periode, <a href=\"suggest.php\">ta gjerne kontakt</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM starter fra";
		$text['producegedfrom'] = "Lag en GEDCOM fil for";
		$text['numgens'] = "Antall generasjoner";
		$text['includelds'] = "Inkluder LDS informajon";
		$text['buildged'] = "Lag GEDCOM";
		$text['gedstartfrom'] = "GEDCOM starter fra";
		$text['nomaxgen'] = "Du må angi antall generasjoner. Bruk Back-knappen for å rette opp feilen";
		$text['gedcreatedfrom'] = "GEDCOM opprettet fra";
		$text['gedcreatedfor'] = "opprettet for";
		$text['creategedfor'] = "Lag GEDCOM";
		$text['email'] = "E-postadresse";
		$text['suggestchange'] = "Foreslå en endring";
		$text['yourname'] = "Ditt navn";
		$text['comments'] = "Kommentarer";
		$text['comments2'] = "Kommentarer";
		$text['submitsugg'] = "Send forslag";
		$text['proposed'] = "Foreslått endring";
		$text['mailsent'] = "Takk. Din melding er sendt.";
		$text['mailnotsent'] = "Vi beklager, men meldingen kunne ikke leveres. Vennligst kontakt xxx direkte på yyy.";
		$text['mailme'] = "Send en kopi til denne adressen";
		$text['entername'] = "Skriv inn ditt navn";
		$text['entercomments'] = "Skriv dine kommentarer";
		$text['sendmsg'] = "Send melding";
		//added in 9.0.0
		$text['subject'] = "Emne";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Bilder og Historier";
		$text['indinfofor'] = "Personside for";
		$text['pp'] = "s."; //page abbreviation
		$text['age'] = "Alder";
		$text['agency'] = "Firma";
		$text['cause'] = "Årsak";
		$text['suggested'] = "Foreslått";
		$text['closewindow'] = "Lukk vinduet";
		$text['thanks'] = "Takk";
		$text['received'] = "Ditt forslag er sendt til Administrator for vurdering.";
		$text['indreport'] = "Personrapport";
		$text['indreportfor'] = "Personrapport for";
		$text['bkmkvis'] = "<strong>NB:</strong> Disse bokmerkene er kun synlige på denne datamaskinen og i denne nettleseren.";
        //added in 9.0.0
		$text['reviewmsg'] = "Du har mottatt et endringsforslag som krever din gjennomgang. Endringsforslaget gjelder:";
        $text['revsubject'] = "Endringsforslag krever din gjennomgang";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Beregning av slektskap";
		$text['findrel'] = "Finn slektskap";
		$text['person1'] = "Person 1:";
		$text['person2'] = "Person 2:";
		$text['calculate'] = "Beregn";
		$text['select2inds'] = "Vennligst velg to personer.";
		$text['findpersonid'] = "Finn personID";
		$text['enternamepart'] = "angi del av fornavn og/eller etternavn";
		$text['pleasenamepart'] = "Anngi en del av fornavn eller etternavn.";
		$text['clicktoselect'] = "klikk for å velge";
		$text['nobirthinfo'] = "Ingen informasjon om fødsel";
		$text['relateto'] = "Slektskap til";
		$text['sameperson'] = "Samme person er valgt to ganger.";
		$text['notrelated'] = "De to personene er ikke i slektskap innen xxx generasjoner."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "For å vise slektskap mellom to personer, bruk 'Finn' knappene nedenfor til å angi  to personer (eller behold viste personer, hvis relevante), klikk deretter på 'Beregn'.";
		$text['sometimes'] = "(Enkelte ganger vil søk med forskjellig antall generasjoner gi forskjellige resultat.)";
		$text['findanother'] = "Finn andre slektskap";
		$text['brother'] = "bror til";
		$text['sister'] = "søster til";
		$text['sibling'] = "søsken til";
		$text['uncle'] = "xxx onkel til";
		$text['aunt'] = "xxx tante til";
		$text['uncleaunt'] = "xxx onkel/tante til";
		$text['nephew'] = "xxx nevø til";
		$text['niece'] = "xxx niese til";
		$text['nephnc'] = "xxx nevø/niese til";
		$text['removed'] = "generasjoner forskjøvet";
		$text['rhusband'] = "ektemann til ";
		$text['rwife'] = "kone til ";
		$text['rspouse'] = "ektefelle til ";
		$text['son'] = "sønn til";
		$text['daughter'] = "datter til";
		$text['rchild'] = "barn til";
		$text['sil'] = "svigersønn til";
		$text['dil'] = "svigerdatter til";
		$text['sdil'] = "svigersønn eller svigerdatter til";
		$text['gson'] = "xxx barnebarn til";
		$text['gdau'] = "xxx barnebarn til";
		$text['gsondau'] = "xxx barnebarn til";
		$text['great'] = "great";
		$text['spouses'] = "er ektefeller";
		$text['is'] = "er";
		$text['changeto'] = "Bytt til (skriv inn ID):";
		$text['notvalid'] = "er ikke et gyldig ID-nummer i denne databasen. Prøv igjen.";
		$text['halfbrother'] = "halvbror til";
		$text['halfsister'] = "halvsøster til";
		$text['halfsibling'] = "halvsøsken til";
		//changed in 8.0.0
		$text['gencheck'] = "Maks antall generasjoner<br />å sjekke";
		$text['mcousin'] = "xxx fetter yyy til";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx kusine yyy til";  //female cousin
		$text['cousin'] = "xxx søskenbarn yyy til";
		$text['mhalfcousin'] = "xxx halvfetter yyy til";  //male cousin
		$text['fhalfcousin'] = "xxx halvkusine yyy til";  //female cousin
		$text['halfcousin'] = "xxx halvsøskenbarn yyy til";
		//added in 8.0.0
		$text['oneremoved'] = "en generasjon forskjøvet";
		$text['gfath'] = "xxx bestefar til";
		$text['gmoth'] = "xxx bestemor til";
		$text['gpar'] = "xxx besteforelder til";
		$text['mothof'] = "mor til";
		$text['fathof'] = "far til";
		$text['parof'] = "forelder til";
		$text['maxrels'] = "Maksimum slektskap å vise";
		$text['dospouses'] = "Vis slektskap som involverer en partner";
		$text['rels'] = "Slektskap";
		$text['dospouses2'] = "Vis ektefeller/partnere";
		$text['fil'] = "svigerfar til";
		$text['mil'] = "svigermor til";
		$text['fmil'] = "sviger til";
		$text['stepson'] = "stesønn av";
		$text['stepdau'] = "stedatter av";
		$text['stepchild'] = "stebarn av";
		$text['stepgson'] = "xxx step-grandson of";
		$text['stepgdau'] = "the xxx step-granddaughter of";
		$text['stepgchild'] = "xxx ste-barnebarn av";
		//added in 8.1.1
		$text['ggreat'] = "great";
		//added in 8.1.2
		$text['ggfath'] = "the xxx great grandfather of";
		$text['ggmoth'] = "the xxx great grandmother of";
		$text['ggpar'] = "the xxx great grandparent of";
		$text['ggson'] = "the xxx great grandson of";
		$text['ggdau'] = "the xxx great granddaughter of";
		$text['ggsondau'] = "the xxx great grandchild of";
		$text['gstepgson'] = "the xxx great step-grandson of";
		$text['gstepgdau'] = "the xxx great step-granddaughter of";
		$text['gstepgchild'] = "the xxx great step-grandchild of";
		$text['guncle'] = "xxx grandonkel til";
		$text['gaunt'] = "xxx grandtante til";
		$text['guncleaunt'] = "xxx grand- onkel/tante til";
		$text['gnephew'] = "xxx 'grandnevø' til";
		$text['gniece'] = "xxx 'grandniese' til";
		$text['gnephnc'] = "xxx 'grand- nevø/niese' til";
		//added in 14.0
		$text['pathscalc'] = "Søk etter forbindelser";
		$text['findrel2'] = "Finn slektskap og andre forbindelser";
		$text['makeme2nd'] = "Bruk min ID";
		$text['usebookmarks'] = "Bruk bokmerker";
		$text['select2inds'] = "Vennligst velg to personer.";
		$text['indinfofor'] = "Personside for";
		$text['nobookmarks'] = "Det finnes ingen bokmerker som kan brukes";
		$text['bkmtitle'] = "Personer funnet i bokmerker:";
		$text['bkminfo'] = "Velg en person:";
		$text['sortpathsby'] = "Sorter stier etter antall";
		$text['sortbyshort'] = "Sorter sti(er) etter";
		$text['bylengthshort'] = "lengde";
		$text['badID1'] = ": feil i person1 ID - vennligst gå tilbake og korriger";
		$text['badID2'] = ": feil i person2 ID - vennligst gå tilbake og korriger";
		$text['notintree'] = ": personen med denne ID'en finnes ikke i valgt database.";
		$text['sameperson'] = "Samme person er valgt to ganger.";;
		$text['nopaths'] = "Disse personene har ingen forbindelse.";
		$text['nopaths1'] = "Ingen flere forbindelser kortere enn xxx";
		$text['nopaths2'] = "i xxx søkesteg";
		$text['longestpath'] = "(lengste sti sjekket så langt var xxx steg lang)";
		$text['relevantpaths'] = "Antall forskjellige relevante stier funnet: xxx";
		$text['skipMarr'] = "(i tillegg, antall stier funnet men ikke vist på grunn av antall ekteskap/partnerskap var: xxx)";
		$text['mjaor'] = "eller";
		$text['connectionsto'] = "Forbindelse(r) til ";
		$text['findanotherpers'] = "Finn en annen person...";
		$text['sometimes'] = "(Enkelte ganger vil søk med forskjellig antall generasjoner gi forskjellige resultat.)";
		$text['anotherpath'] = "Finn slektskap og andre forbindelser";
		$text['xpath'] = "Sti ";
		$text['primary'] = "Startperson"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Målperson";
		$text['parent'] = "Forelder";
		$text['mhfather'] = "hans far";
		$text['mhmother'] = "hans mor";
		$text['mhhusband'] = "hans ektemann/partner";
		$text['mhwife'] = "hans kone/partner";
		$text['mhson'] = "hans sønn";
		$text['mhdaughter'] = "hans datter";
		$text['fhfather'] = "hennes far";
		$text['fhmother'] = "hennes mor";
		$text['fhhusband'] = "hennes ektemann/partner";
		$text['fhwife'] = "hennes kone/partner";
		$text['fhson'] = "hennes sønn";
		$text['fhdaughter'] = "hennes datter";
		$text['hfather'] = "far";
		$text['hmother'] = "mor";
		$text['hhusband'] = "ektemann/partner";
		$text['hwife'] = "kone/partner";
		$text['hson'] = "sønn";
		$text['hdaughter'] = "datter";
		$text['maxruns'] = "Maks antall stier som skal sjekkes";
		$text['maxrshort'] = "Maks antall stier";
		$text['maxlength'] = "Forbindelsesstier ikke lengre enn";
		$text['maxlshort'] = "Maks sti-lengde";
		$text['xstep'] = "steg";
		$text['xsteps'] = "steg";
		$text['xmarriages'] = "inklusiv xxx ekteskap/partnerskap";
		$text['xmarriage'] = "inklusiv 1 ekteskap/partnerskap";
		$text['showspouses'] = "Vis begge ektefeller/partnere";
		$text['showTxt'] = "Vis forbindelse(r) som tekst";
		$text['showTxtshort'] = "Tekst for sti(er)";
		$text['compactBox'] = "Vis kompakte personbokser";
		$text['compactBoxshort'] = "Kompakte bokser";
		$text['paths'] = "Stier";
		$text['dospouses2'] = "Vis ektefeller/partnere";
		$text['maxmopt'] = "Maks antall ekteskap/partnerskap i forbindelsen";
		$text['maxm'] = "Maks antall ekteskap/partnerskap";
		$text['arerelated'] = "Disse personene er beslektet - deres slektskap vises i Sti 1";
		$text['simplerel'] = "Finn direkte slektskap";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Familieskjema for";
		$text['ldsords'] = "LDS Ordinasjon";
		$text['baptizedlds'] = "Døpt (LDS)";
		$text['endowedlds'] = "Velsignet (LDS)";
		$text['sealedplds'] = "Bekreftet P (LDS)";
		$text['sealedslds'] = "Bekreftet S (LDS)";
		$text['otherspouse'] = "Andre partnere";
		$text['husband'] = "Mann";
		$text['wife'] = "Hustru";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "F";
		$text['capaltbirthabbr'] = "A";
		$text['capdeathabbr'] = "D";
		$text['capburialabbr'] = "G";
		$text['capplaceabbr'] = "S";
		$text['capmarrabbr'] = "G";
		$text['capspouseabbr'] = "E/P";
		$text['redraw'] = "Tegn på nytt med";
		$text['unknownlit'] = "Ukjent";
		$text['popupnote1'] = " = Tilleggsinformasjon";
		$text['pedcompact'] = "Kompakt";
		$text['pedstandard'] = "Standard";
		$text['pedtextonly'] = "Bare Tekst";
		$text['descendfor'] = "Etterkommere av";
		$text['maxof'] = "Maksimum";
		$text['gensatonce'] = "generasjoner vist samtidig.";
		$text['sonof'] = "sønn av";
		$text['daughterof'] = "datter av";
		$text['childof'] = "barn av";
		$text['stdformat'] = "Standard Format";
		$text['ahnentafel'] = "Generasjonsliste";
		$text['addnewfam'] = "Legg til ny familie";
		$text['editfam'] = "Rediger familie";
		$text['side'] = "Side";
		$text['familyof'] = "Familie til";
		$text['paternal'] = "Far";
		$text['maternal'] = "Mor";
		$text['gen1'] = "Selv";
		$text['gen2'] = "Foreldre";
		$text['gen3'] = "Besteforeldre";
		$text['gen4'] = "Oldeforeldre";
		$text['gen5'] = "Tippoldeforeldre";
		$text['gen6'] = "Tipptipp-oldeforeldre";
		$text['gen7'] = "3.tipp-oldeforeldre";
		$text['gen8'] = "4.tipp-oldeforeldre";
		$text['gen9'] = "5.tipp-oldeforeldre";
		$text['gen10'] = "6.tipp-oldeforeldre";
		$text['gen11'] = "7.tipp-oldeforeldre";
		$text['gen12'] = "8.tipp-oldeforeldre";
		$text['graphdesc'] = "Etterslektstre til dette punkt";
		$text['pedbox'] = "Boks";
		$text['regformat'] = "Generasjon Format";
		$text['extrasexpl'] = "Dersom bilder eller historier finnes for denne personen, vil et ikon vises sammen med navnet.";
		$text['popupnote3'] = " = Nytt skjema";
		$text['mediaavail'] = "Tilgjengelig media";
		$text['pedigreefor'] = "Anetre for";
		$text['pedigreech'] = "Anetre";
		$text['datesloc'] = "Datoer og steder";
		$text['borchr'] = "Fødsel/Alt - Død/Gravlagt (to)";
		$text['nobd'] = "Ingen datoer for fødsel eller død";
		$text['bcdb'] = "Fødsel/Alt/Død/Gravlagt (fire)";
		$text['numsys'] = "Nummer-system";
		$text['gennums'] = "Generasjonsnummer";
		$text['henrynums'] = "Henry nummer";
		$text['abovnums'] = "d'Aboville nummer";
		$text['devnums'] = "de Villiers nummer";
		$text['dispopts'] = "Visning";
		//added in 10.0.0
		$text['no_ancestors'] = "Ingen aner funnet";
		$text['ancestor_chart'] = "Vertikalt anetre";
		$text['opennewwindow'] = "Åpne i et nytt vindu";
		$text['pedvertical'] = "Vertikalt";
		//added in 11.0.0
		$text['familywith'] = "Familie med";
		$text['fcmlogin'] = "Logg inn for å se detaljer";
		$text['isthe'] = "som vises er";
		$text['otherspouses'] = "Andre partnere";
		$text['parentfamily'] = "Familien ";
		$text['showfamily'] = "Vis denne familien";
		$text['shown'] = "vist";
		$text['showparentfamily'] = "Vis foreldres familie";
		$text['showperson'] = "Vis person";
		//added in 11.0.2
		$text['otherfamilies'] = "Andre familier";
		//added in 14.0
		$text['dtformat'] = "Tabeller";
		$text['dtchildren'] = "Barn";
		$text['dtgrandchildren'] = "Barnebarn";
		$text['dtggrandchildren'] = "Oldebarn";
		$text['dtgggrandchildren'] = "Tippoldebarn"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "1"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Ingen etterkommere";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Totalt";
		$text['dtselect'] = "Velg";
		$text['dteachfulltable'] = "Hver fulle tabell vil ha";
		$text['dtrows'] = "rader";
		$text['dtdisplayingtable'] = "Viser tabell";
		$text['dtgototable'] = "Gå til tabell:";
		$text['fcinstrdn'] = "Vis familie med ektefelle/partner";
		$text['fcinstrup'] = "Vis familie med foreldre";
		$text['fcinstrplus'] = "Velg andre ektefeller/partnere";
		$text['fcinstrfam'] = "Velg andre foreldre";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Det finnes ingen rapporter.";
		$text['reportname'] = "Rapportnavn";
		$text['allreports'] = "Alle rapporter";
		$text['report'] = "Rapport";
		$text['error'] = "Feil";
		$text['reportsyntax'] = "Syntaksen for spørringen til denne rapporten";
		$text['wasincorrect'] = "var feil, og spørringen kunne derfor ikke bli utført. Vennligst kontakt system administrator på";
		$text['errormessage'] = "Feilmelding";
		$text['equals'] = "lik";
		$text['endswith'] = "slutter med";
		$text['soundexof'] = "soundex av";
		$text['metaphoneof'] = "metaphone av";
		$text['plusminus10'] = "+/- 10 år";
		$text['lessthan'] = "mindre enn";
		$text['greaterthan'] = "større enn";
		$text['lessthanequal'] = "mindre enn eller lik";
		$text['greaterthanequal'] = "større enn eller lik";
		$text['equalto'] = "lik";
		$text['tryagain'] = "Vennligst prøv igjen";
		$text['joinwith'] = "Kombiner med";
		$text['cap_and'] = "OG";
		$text['cap_or'] = "ELLER";
		$text['showspouse'] = "Vis ektefelle(r)/partner(e)";
		$text['submitquery'] = "Start søk";
		$text['birthplace'] = "Fødested";
		$text['deathplace'] = "Død sted";
		$text['birthdatetr'] = "Født år";
		$text['deathdatetr'] = "Død år";
		$text['plusminus2'] = "+/- 2 år";
		$text['resetall'] = "Tøm alle felt";
		$text['showdeath'] = "Vis informasjon om død/begravelse,";
		$text['altbirthplace'] = "Døpt sted";
		$text['altbirthdatetr'] = "Døpt år";
		$text['burialplace'] = "Gravlagt sted";
		$text['burialdatetr'] = "Gravlagt år";
		$text['event'] = "Hendelse(r)";
		$text['day'] = "Dag";
		$text['month'] = "Måned";
		$text['keyword'] = "Nøkkelord (f.eks. \"Abt\")";
		$text['explain'] = "Skriv del av dato for å finne sammenfallende hendelser. La feltet være tomt for å se treff på alle.";
		$text['enterdate'] = "Skriv inn eller velg minst ett av følgende: dag, måned, år, nøkkelord";
		$text['fullname'] = "Fullt navn";
		$text['birthdate'] = "Født dato";
		$text['altbirthdate'] = "Døpt dato";
		$text['marrdate'] = "Gift dato";
		$text['spouseid'] = "Partners ID";
		$text['spousename'] = "Partners navn";
		$text['deathdate'] = "Død dato";
		$text['burialdate'] = "Gravlagt dato";
		$text['changedate'] = "Sist endret dato";
		$text['gedcom'] = "Tre";
		$text['baptdate'] = "Dåp dato (LDS)";
		$text['baptplace'] = "Dåp sted (LDS)";
		$text['endldate'] = "Velsignelse dato (LDS)";
		$text['endlplace'] = "Velsignelse sted (LDS)";
		$text['ssealdate'] = "Bekreftet dato S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Bekreftet sted S (LDS)";
		$text['psealdate'] = "Bekreftet dato P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Bekreftet sted P (LDS)";
		$text['marrplace'] = "Gift sted";
		$text['spousesurname'] = "Ektefelles/partners etternavn";
		$text['spousemore'] = "Dersom du skriver inn 'Ektefelles/partners etternavn', må du i tillegg fylle inn minst ett felt til.";
		$text['plusminus5'] = "+/- 5 år";
		$text['exists'] = "eksisterer";
		$text['dnexist'] = "eksisterer ikke";
		$text['divdate'] = "Skilt Dato";
		$text['divplace'] = "Skilt Sted";
		$text['otherevents'] = "Andre Hendelser og Egenskaper";
		$text['numresults'] = "Resultat per side";
		$text['mysphoto'] = "Ukjente bilder";
		$text['mysperson'] = "Ikke identifisert";
		$text['joinor'] = "Valget 'slå sammen med OR' kan ikke brukes med ektefelles/partners etternavn";
		$text['tellus'] = "Fortell oss hva du vet";
		$text['moreinfo'] = "Mer informasjon:";
		//added in 8.0.0
		$text['marrdatetr'] = "Gift år";
		$text['divdatetr'] = "Skilt år";
		$text['mothername'] = "Mors navn";
		$text['fathername'] = "Fars navn";
		$text['filter'] = "Filter";
		$text['notliving'] = "Lever ikke";
		$text['nodayevents'] = "Hendelser denne måneden som ikke er assosiert med en spesifikk dag:";
		//added in 9.0.0
		$text['csv'] = "Kommaseparert CSV fil";
		//added in 10.0.0
		$text['confdate'] = "Konfirmasjonsdato (LDS)";
		$text['confplace'] = "Konfirmasjonssted (LDS)";
		$text['initdate'] = "Initiatory Date (LDS)";
		$text['initplace'] = "Initiatory Place (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Type ekteskap";
		$text['searchfor'] = "Søk etter";
		$text['searchnote'] = "Merk: Denne siden bruker Google for å utføre søket. Antallet søketreff er avhengig av i hvilken grad Google har vært i stand til å indeksere dette nettstedet.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Logg for";
		$text['mostrecentactions'] = "Siste hendelser";
		$text['autorefresh'] = "Automatisk oppdatering (30 sekunder)";
		$text['refreshoff'] = "Slå av automatisk oppdatering";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Kirkegårder og gravsteiner";
		$text['showallhsr'] = "Vis alle gravsteiner";
		$text['in'] = "i";
		$text['showmap'] = "Vis kart";
		$text['headstonefor'] = "Gravstein til";
		$text['photoof'] = "Bilde av";
		$text['photoowner'] = "Eier av original/Kilde";
		$text['nocemetery'] = "Ingen kirkegårder";
		$text['iptc005'] = "Tittel";
		$text['iptc020'] = "Tilleggskategorier";
		$text['iptc040'] = "Spesielle instruksjoner";
		$text['iptc055'] = "Opprettet dato";
		$text['iptc080'] = "Forfatter";
		$text['iptc085'] = "Forfatters stilling";
		$text['iptc090'] = "By";
		$text['iptc095'] = "Kommune/Fylke";
		$text['iptc101'] = "Land";
		$text['iptc103'] = "Referanse for overføring";
		$text['iptc105'] = "Overskrift";
		$text['iptc110'] = "Kilde";
		$text['iptc115'] = "Bilde kilde";
		$text['iptc116'] = "Opphavsrett";
		$text['iptc120'] = "Tekst";
		$text['iptc122'] = "Tekstforfatter";
		$text['mapof'] = "Kart over";
		$text['regphotos'] = "Beskrivelse";
		$text['gallery'] = "Kun miniatyrbilder";
		$text['cemphotos'] = "Kirkegårdsbilder";
		$text['photosize'] = "Dimensjoner";
        $text['iptc010'] = "Prioritet";
		$text['filesize'] = "Filstørrelse";
		$text['seeloc'] = "Se lokasjon";
		$text['showall'] = "Vis alle";
		$text['editmedia'] = "Rediger media";
		$text['viewitem'] = "Se på dette";
		$text['editcem'] = "Rediger kirkegård";
		$text['numitems'] = "Antall";
		$text['allalbums'] = "Alle album";
		$text['slidestop'] = "Pause lysbildefremvisning";
		$text['slideresume'] = "Fortsett lysbildefremvisning";
		$text['slidesecs'] = "Sekunder for hvert bilde:";
		$text['minussecs'] = "minus 0,5 sekunder";
		$text['plussecs'] = "pluss 0,5 sekunder";
		$text['nocountry'] = "Ukjent land";
		$text['nostate'] = "Ukjent Stat/Provins/Grevskap";
		$text['nocounty'] = "Ukjent Fylke/Sokn";
		$text['nocity'] = "Ukjent by";
		$text['nocemname'] = "Ukjent kirkegård";
		$text['editalbum'] = "Rediger album";
		$text['mediamaptext'] = "<strong>NB:</strong> Beveg muspekeren over bildet for å vise navnet. Klikk for å vise en side for hvert navn.";
		//added in 8.0.0
		$text['allburials'] = "Alle begravelser";
		$text['moreinfo'] = "Mer informasjon:";
		//added in 9.0.0
        $text['iptc025'] = "Søkeord";
        $text['iptc092'] = "Sted";
		$text['iptc015'] = "Kategori";
		$text['iptc065'] = "Opprettet i program";
		$text['iptc070'] = "Programversjon";
		//added in 13.0
		$text['toggletags'] = "Bildemerker av/på";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Vis etternavn som starter med";
		$text['showtop'] = "Vis topp";
		$text['showallsurnames'] = "Vis alle etternavn";
		$text['sortedalpha'] = "sortert alfabetisk";
		$text['byoccurrence'] = "sortert etter forekomst";
		$text['firstchars'] = "Første bokstav";
		$text['mainsurnamepage'] = "Etternavnside";
		$text['allsurnames'] = "Alle Etternavn";
		$text['showmatchingsurnames'] = "Klikk på et etternavn for å se data.";
		$text['backtotop'] = "Tilbake til toppen";
		$text['beginswith'] = "Begynner med";
		$text['allbeginningwith'] = "Alle etternavn som begynner med";
		$text['numoccurrences'] = "totalt antall ganger områdenavnet er brukt i fulle stedsnavn i parentes";
		$text['placesstarting'] = "Vis største områder som starter med";
		$text['showmatchingplaces'] = "Klikk på et sted for å vise et snevrere område. Klikk på søkeikonet for å vise personer med tilknytning til området eller stedet.";
		$text['totalnames'] = "totalt antall personer";
		$text['showallplaces'] = "Vis alle områder av størst geografisk omfang";
		$text['totalplaces'] = "totalt antall steder";
		$text['mainplacepage'] = "Steders hovedside";
		$text['allplaces'] = "Alle steder av størst geografisk omfang";
		$text['placescont'] = "Vis alle steder som inneholder";
		//changed in 8.0.0
		$text['top30'] = "Topp xxx etternavn";
		$text['top30places'] = "Topp xxx største områder";
		//added in 12.0.0
		$text['firstnamelist'] = "Fornavnsliste";
		$text['firstnamesstarting'] = "Vis fornavn som starter med";
		$text['showallfirstnames'] = "Vis alle fornavn";
		$text['mainfirstnamepage'] = "Fornavnside";
		$text['allfirstnames'] = "Alle fornavn";
		$text['showmatchingfirstnames'] = "Klikk på et fornavn for å se data.";
		$text['allfirstbegwith'] = "Alle fornavn som begynner med";
		$text['top30first'] = "Topp xxx fornavn";
		$text['allothers'] = "Alle andre";
		$text['amongall'] = "(blant alle navn)";
		$text['justtop'] = "Bare topp xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(siste xx dagene)";

		$text['photo'] = "Bilder";
		$text['history'] = "Historie/Dokument";
		$text['husbid'] = "Fars ID";
		$text['husbname'] = "Fars navn";
		$text['wifeid'] = "Mors ID";
		//added in 11.0.0
		$text['wifename'] = "Mors navn";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Slett";
		$text['addperson'] = "Legg til person";
		$text['nobirth'] = "Følgende person har ikke gyldig fødselsdato og kan derfor ikke oppdateres";
		$text['event'] = "Hendelse(r)";
		$text['chartwidth'] = "Diagrambredde";
		$text['timelineinstr'] = "Legg til inntil fire personer (om gangen) ved å legge inn deres ID i feltene under";
		$text['togglelines'] = "Linjer av/på";
		//changed in 9.0.0
		$text['noliving'] = "Følgende person er merket som nålevende eller privat og kan ikke oppdateres fordi du ikke er logget inn med nødvendige tillatelser";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Søk i alle trær";
		$text['treename'] = "Treets navn";
		$text['owner'] = "Eier";
		$text['address'] = "Adresse";
		$text['city'] = "By";
		$text['state'] = "Stat/Fylke";
		$text['zip'] = "Postnummer";
		$text['country'] = "Land";
		$text['email'] = "E-postadresse";
		$text['phone'] = "Telefon";
		$text['username'] = "Brukernavn";
		$text['password'] = "Passord";
		$text['loginfailed'] = "Feil ved pålogging.";

		$text['regnewacct'] = "Registrer ny bruker";
		$text['realname'] = "Fullt navn";
		$text['phone'] = "Telefon";
		$text['email'] = "E-postadresse";
		$text['address'] = "Adresse";
		$text['acctcomments'] = "Kommentarer";
		$text['submit'] = "Send";
		$text['leaveblank'] = "(la være åpent hvis du ønsker et nytt tre)";
		$text['required'] = "Obligatoriske felt";
		$text['enterpassword'] = "Angi et passord.";
		$text['enterusername'] = "Angi brukernavn.";
		$text['failure'] = "Beklager, men brukernavnet du oppgav er allerede i bruk. Bruk tilbaketasten og velg et annet brukernavn.";
		$text['success'] = "Tusen takk. Vi har mottatt din registrering. Vi tar kontakt når din konto er aktivert eller hvis vi trenger mer informasjon.";
		$text['emailsubject'] = "Forespørsel om ny TNG brukerkonto";
		$text['website'] = "Nettsted";
		$text['nologin'] = "Har du ikke brukernavn?";
		$text['loginsent'] = "Din påloggingsinformasjon er sendt";
		$text['loginnotsent'] = "Din påloggingsinformasjon er ikke sendt";
		$text['enterrealname'] = "Skriv ditt navn.";
		$text['rempass'] = "Forbli innlogget på denne datamaskinen";
		$text['morestats'] = "Mer statistikk";
		$text['accmail'] = "<strong>NB:</strong> For å kunne motta e-post fra Administrator, må du påse at du ikke blokkerer e-post fra dette domenet.";
		$text['newpassword'] = "Nytt passord";
		$text['resetpass'] = "Tilbakestill passordet ditt";
		$text['nousers'] = "Dette skjema kan ikke brukes før minst en brukerkonto er opprettet. Dersom du har adminrettigheter, gå til Administrasjon/Brukere for å opprette din Administratorkonto.";
		$text['noregs'] = "Beklager, men vi tar ikke imot flere brukere for øyeblikket. Vennligst <a href=\"suggest.php\">ta kontakt</a> direkte hvis du har noen kommentarer.";
		$text['emailmsg'] = "Du har mottatt en forespørsel om en ny TNG brukerkonto. Logg inn i TNG Adminstrasjonsområde og tildel nødvendige tillatelser for den nye brukeren. Dersom du godkjenner denne registreringen må du gi beskjed til søker ved å svare på denne meldingen.";
		$text['accactive'] = "Brukerkontoen er aktivert, men brukeren vil ikke ha noen spesielle rettigheter før du tildeler disse.";
		$text['accinactive'] = "Gå til Administrasjon/Brukere/Vurder for å få tilgang til brukerkontoinnstillinger. Kontoen vil forbli inaktiv inntil du redigerer og lagrer minst en gang.";
		$text['pwdagain'] = "Gjenta passord";
		$text['enterpassword2'] = "Vennligst oppgi passordet igjen";
		$text['pwdsmatch'] = "Passordene er ikke like. Vennligst skriv samme passord i hvert felt.";
		$text['acksubject'] = "Takk for at du registrerte deg"; //for a new user account
		$text['ackmessage'] = "Din forespørsel om brukerkonto er mottatt. Kontoen vil ikke bli aktivert før Administrator har godkjent den. Du vil få tilsendt mail når brukerkontoen er klar for innlogging.";
		//added in 12.0.0
		$text['switch'] = "Bytt";
		//added in 14.0
		$text['newpassword2'] = "Nytt passord en gang til";
		$text['resetsuccess'] = "Vellykket: Passordet har blitt tilbakestilt";
		$text['resetfail'] = "Feil: Passordet ikke tilbakestilt";
		$text['failreason0'] = " (ukjent databasefeil)";
		$text['failreason2'] = " (du har ikke tillatelse til å endre ditt passord)";
		$text['failreason3'] = " (passordene stemte ikke)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Bla i alle Grener";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Størrelser";
		$text['totindividuals'] = "Antall personer";
		$text['totmales'] = "Antall menn";
		$text['totfemales'] = "Antall kvinner";
		$text['totunknown'] = "Antall ukjent kjønn";
		$text['totliving'] = "Antall nålevende";
		$text['totfamilies'] = "Antall familier";
		$text['totuniquesn'] = "Antall unike etternavn";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Antall kilder";
		$text['avglifespan'] = "Gjennomsnittlig levetid";
		$text['earliestbirth'] = "Tidligste fødselsdato";
		$text['longestlived'] = "Lengstlevende";
		$text['days'] = "dager";
		$text['age'] = "Alder";
		$text['agedisclaimer'] = "Aldersrelaterte beregninger er basert på personer registrert med fødselsdato <EM>og</EM> dato for død.  Grunnet felter med ukomplette datoer (f.eks, dødsdato skrevet som \"1945\" eller \"Før 1860\"), kan disse beregningene ikke være 100% nøyaktige.";
		$text['treedetail'] = "Mere informasjon om dette slektstreet";
		$text['total'] = "Antall";
		//added in 12.0
		$text['totdeceased'] = "Antall avdøde";
		//added in 14.0
		$text['totalsourcecitations'] = "Antall kildehenvisninger";
		break;

	case "notes":
		$text['browseallnotes'] = "Bla gjennom alle notater";
		break;

	case "help":
		$text['menuhelp'] = "Meny nøkkel";
		break;

	case "install":
		$text['perms'] = "Alle rettigheter er satt.";
		$text['noperms'] = "Rettigheter kunne ikke bli satt for disse filene:";
		$text['manual'] = "Vennligst sett de manuelt.";
		$text['folder'] = "Mappe";
		$text['created'] = "har blitt opprettet";
		$text['nocreate'] = "kunne ikke opprettes. Vennligst opprett manuelt.";
		$text['infosaved'] = "Informasjon lagret, forbindelse bekreftet!";
		$text['tablescr'] = "Tabellene har blitt opprettet!";
		$text['notables'] = "Følgende tabeller kunne ikke bli opprettet:";
		$text['nocomm'] = "TNG har ikke kontakt med databasen. Ingen tabeller ble opprettet.";
		$text['newdb'] = "Informasjon lagret, forbindelse bekreftet, ny database opprettet:";
		$text['noattach'] = "Informasjon lagret. Ny database opprettet, men TNG kan ikke koble seg til den.";
		$text['nodb'] = "Informasjon lagret. Tilkobling forsøkt, men databasen finnes ikke og kan ikke bli opprettet. Vennligst kontroller at navnet på databasen er korrekt, eller bruk 'cpanel' for å opprette den.";
		$text['noconn'] = "Informasjon lagret men forbindelsen sviktet. En eller flere av følgende er feil:";
		$text['exists'] = "eksisterer";
		$text['noop'] = "Ingenting ble gjort.";
		//added in 8.0.0
		$text['nouser'] = "Brukerkonto ble ikke opprettet. Brukernavnet kan være brukt tidligere.";
		$text['notree'] = "Tre ble ikke opprettet. Samme tre ID kan være opprettet tidligere.";
		$text['infosaved2'] = "Informasjon lagret";
		$text['renamedto'] = "endret navn til";
		$text['norename'] = "kunne ikke endre navn";
		//changed in 13.0.0
		$text['loginfirst'] = "Eksisterende brukerposter er blitt oppdaget. For å fortsette, må du først logge på eller fjerne alle poster fra brukertabellen.";
		break;

	case "imgviewer":
		$text['magmode'] = "Forstørrelsesmodus";
		$text['panmode'] = "Panoreringsmodus";
		$text['pan'] = "Klikk og dra for å flytte innenfor bildet";
		$text['fitwidth'] = "Tilpass bredde";
		$text['fitheight'] = "Tilpass høyde";
		$text['newwin'] = "Nytt vindu";
		$text['opennw'] = "Åpne bilde i et nytt vindu";
		$text['magnifyreg'] = "Klikk for å forstørre et område av bildet";
		$text['imgctrls'] = "Aktiver bildekontroller";
		$text['vwrctrls'] = "Aktiver bildevisningskontroller";
		$text['vwrclose'] = "Lukk bildevisning";
		break;

	case "dna":
		$text['test_date'] = "Testdato";
		$text['links'] = "Relevante linker";
		$text['testid'] = "Test ID";
		//added in 12.0.0
		$text['mode_values'] = "'Mode' verdier";
		$text['compareselected'] = "Sammenlign valgte";
		$text['dnatestscompare'] = "Sammenligne Y-DNA tester";
		$text['keep_name_private'] = "Hold navn Privat";
		$text['browsealltests'] = "Søk i alle tester";
		$text['all_dna_tests'] = "Alle DNA tester";
		$text['fastmutating'] = "Hurtigere&nbsp;mutasjonsrate";
		$text['alltypes'] = "Alle typer";
		$text['allgroups'] = "Alle grupper";
		$text['Ydna_LITbox_info'] = "Test(er) koblet til denne personen ble ikke nødvendigvis tatt av denne personen.<br />'Haplogruppe' kolonnen viser data i rødt hvis resultatet er 'Beregnet' eller grønt hvis testen er 'Bekreftet'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Sammenlign valgte mtDNA tester";
		$text['dnatestscompare_atdna'] = "Sammenlign valgte atDNA tester";
		$text['chromosome'] = "Kromosom";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNP'er";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Ekstra mutasjoner";
		$text['mrca'] = "Yngste felles ane";
		$text['ydna_test'] = "Y-DNA tester";
		$text['mtdna_test'] = "mtDNA (Mitokondrial) tester";
		$text['atdna_test'] = "atDNA (autosomal) tester";
		$text['segment_start'] = "Start";
		$text['segment_end'] = "Slutt";
		$text['suggested_relationship'] = "Foreslått";
		$text['actual_relationship'] = "Faktisk";
		$text['12markers'] = "Markører 1-12";
		$text['25markers'] = "Markører 13-25";
		$text['37markers'] = "Markører 26-37";
		$text['67markers'] = "Markører 38-67";
		$text['111markers'] = "Markører 68-111";
		//added in 13.1
		$text['comparemore'] = "Minst to tester må velges for å sammenligne.";
		break;
}

//common
$text['matches'] = "Treff";
$text['description'] = "Beskrivelse";
$text['notes'] = "Notater";
$text['status'] = "Status";
$text['newsearch'] = "Nytt Søk";
$text['pedigree'] = "Anetre";
$text['seephoto'] = "Se bilde";
$text['andlocation'] = "& lokasjon";
$text['accessedby'] = "utført av";
$text['children'] = "Barn";  //from getperson
$text['tree'] = "Tre";
$text['alltrees'] = "Alle Trær";
$text['nosurname'] = "[mangler etternavn]";
$text['thumb'] = "Miniatyrbilde";  //as in Thumbnail
$text['people'] = "Personer";
$text['title'] = "Tittel";  //from getperson
$text['suffix'] = "Suffiks";  //from getperson
$text['nickname'] = "Kallenavn";  //from getperson
$text['lastmodified'] = "Sist endret";  //from getperson
$text['married'] = "Gift";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Navn"; //from showmap
$text['lastfirst'] = "Etternavn, Fornavn";  //from search
$text['bornchr'] = "Født/Døpt";  //from search
$text['individuals'] = "Personer";  //from whats new
$text['families'] = "Familier";
$text['personid'] = "Person ID";
$text['sources'] = "Kilder";  //from getperson (next several)
$text['unknown'] = "Ukjent";
$text['father'] = "Far";
$text['mother'] = "Mor";
$text['christened'] = "Døpt";
$text['died'] = "Død";
$text['buried'] = "Gravlagt";
$text['spouse'] = "Ektefelle/partner";  //from search
$text['parents'] = "Foreldre";  //from pedigree
$text['text'] = "Tekst";  //from sources
$text['language'] = "Språk";  //from languages
$text['descendchart'] = "Etterkommere";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Person";
$text['edit'] = "Rediger";
$text['date'] = "Dato";
$text['login'] = "Logg inn";
$text['logout'] = "Logg ut";
$text['groupsheet'] = "Gruppeskjema";
$text['text_and'] = "og";
$text['generation'] = "Generasjon";
$text['filename'] = "Filnavn";
$text['id'] = "ID";
$text['search'] = "Søk";
$text['user'] = "Bruker";
$text['firstname'] = "Fornavn";
$text['lastname'] = "Etternavn";
$text['searchresults'] = "Søkeresultat";
$text['diedburied'] = "Død/Gravlagt";
$text['homepage'] = "Startside";
$text['find'] = "Finn...";
$text['relationship'] = "Slektskap";		//in German, Verwandtschaft
$text['relationship2'] = "Slektskap"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Tidslinje";
$text['yesabbr'] = "J";               //abbreviation for 'yes'
$text['divorced'] = "Skilt";
$text['indlinked'] = "Linket til";
$text['branch'] = "Gren";
$text['moreind'] = "Flere personer";
$text['morefam'] = "Flere familier";
$text['surnamelist'] = "Etternavnsliste";
$text['generations'] = "Generasjoner";
$text['refresh'] = "Oppdater";
$text['whatsnew'] = "Hva er nytt?";
$text['reports'] = "Rapporter";
$text['placelist'] = "Stedsliste";
$text['baptizedlds'] = "Døpt (LDS)";
$text['endowedlds'] = "Velsignet (LDS)";
$text['sealedplds'] = "Bekreftet P (LDS)";
$text['sealedslds'] = "Bekreftet S (LDS)";
$text['ancestors'] = "Aner";
$text['descendants'] = "Etterkommere";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Dato for siste GEDCOM import";
$text['type'] = "Type";
$text['savechanges'] = "Lagre endringer";
$text['familyid'] = "Famile ID";
$text['headstone'] = "Gravstein";
$text['historiesdocs'] = "Historier";
$text['anonymous'] = "anonymt";
$text['places'] = "Steder";
$text['anniversaries'] = "Datoer og jubileer";
$text['administration'] = "Administrasjon";
$text['help'] = "Hjelp";
//$text['documents'] = "Documents";
$text['year'] = "År";
$text['all'] = "Alle";
$text['address'] = "Adresse";
$text['suggest'] = "Foreslå";
$text['editevent'] = "Foreslå en endring av denne hendelsen";
$text['morelinks'] = "Flere koblinger";
$text['faminfo'] = "Familieinformasjon";
$text['persinfo'] = "Personlig informasjon";
$text['srcinfo'] = "Kildeinformasjon";
$text['fact'] = "Fakta";
$text['goto'] = "Velg en side";
$text['tngprint'] = "Skriv ut";
$text['databasestatistics'] = "Databasestatistikk"; //needed to be shorter to fit on menu
$text['child'] = "Barn";  //from familygroup
$text['repoinfo'] = "Informasjon om arkiv";
$text['tng_reset'] = "Tilbakestill";
$text['noresults'] = "Ingen funnet";
$text['allmedia'] = "Alle media";
$text['repositories'] = "Arkiver";
$text['albums'] = "Album";
$text['cemeteries'] = "Kirkegårder";
$text['surnames'] = "Etternavn";
$text['dates'] = "Datoer";
$text['link'] = "Kobling";
$text['media'] = "Media";
$text['gender'] = "Kjønn";
$text['latitude'] = "Breddegrad";
$text['longitude'] = "Lengdegrad";
$text['bookmarks'] = "Bokmerker";
$text['bookmark'] = "Legg til bokmerke";
$text['mngbookmarks'] = "Gå til bokmerke";
$text['bookmarked'] = "Bokmerke lagt til";
$text['remove'] = "Fjern";
$text['find_menu'] = "Finn";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Kirkegård";
$text['gmapevent'] = "Hendelseskart";
$text['gevents'] = "Hendelse";
$text['googleearthlink'] = "Link til Google Earth";
$text['googlemaplink'] = "Link til Google Maps";
$text['gmaplegend'] = "Tegnforklaring";
$text['unmarked'] = "Umerket";
$text['located'] = "Lokalisert";
$text['albclicksee'] = "Klikk for å se alt i dette album";
$text['notyetlocated'] = "Ikke lokalisert";
$text['cremated'] = "Kremert";
$text['missing'] = "Savnet";
$text['pdfgen'] = "PDF Generator";
$text['blank'] = "Blankt skjema";
$text['fonts'] = "Skrift";
$text['header'] = "Overskrift";
$text['data'] = "Data";
$text['pgsetup'] = "Sideoppsett";
$text['pgsize'] = "Arkstørrelse";
$text['orient'] = "Orientering"; //for a page
$text['portrait'] = "Portrett";
$text['landscape'] = "Landskap";
$text['tmargin'] = "Toppmarg";
$text['bmargin'] = "Bunnmarg";
$text['lmargin'] = "Venstre marg";
$text['rmargin'] = "Høyre marg";
$text['createch'] = "Lag dokument";
$text['prefix'] = "Prefiks";
$text['mostwanted'] = "Etterlysninger";
$text['latupdates'] = "Siste oppdatering";
$text['featphoto'] = "Siste bilde";
$text['news'] = "Nyheter";
$text['ourhist'] = "Vår historie";
$text['ourhistanc'] = "Vår historie og aner";
$text['ourpages'] = "Våre slektssider";
$text['pwrdby'] = "Sidene drives av";
$text['writby'] = "skrevet av";
$text['searchtngnet'] = "Søk TNG-nettet (GENDEX)";
$text['viewphotos'] = "Se alle bilder";
$text['anon'] = "Du er fremdeles anonym";
$text['whichbranch'] = "Hvilken gren tilhører du?";
$text['featarts'] = "Artiklene";
$text['maintby'] = "Redigert av";
$text['createdon'] = "Skrevet den";
$text['reliability'] = "Troverdighet";
$text['labels'] = "Ledetekster";
$text['inclsrcs'] = "Inkluder kilder";
$text['cont'] = "(forts.)"; //abbreviation for continued
$text['mnuheader'] = "Startside";
$text['mnusearchfornames'] = "Søk";
$text['mnulastname'] = "Etternavn";
$text['mnufirstname'] = "Fornavn";
$text['mnusearch'] = "Søk";
$text['mnureset'] = "Start på nytt";
$text['mnulogon'] = "Logg inn";
$text['mnulogout'] = "Logg ut";
$text['mnufeatures'] = "Flere muligheter";
$text['mnuregister'] = "Be om brukerkonto";
$text['mnuadvancedsearch'] = "Avansert søk";
$text['mnulastnames'] = "Etternavn";
$text['mnustatistics'] = "Statistikk";
$text['mnuphotos'] = "Bilder";
$text['mnuhistories'] = "Historier";
$text['mnumyancestors'] = "Bilder &amp; Historier for Aner til [Person]";
$text['mnucemeteries'] = "Kirkegårder";
$text['mnutombstones'] = "Gravsteiner";
$text['mnureports'] = "Rapporter";
$text['mnusources'] = "Kilder";
$text['mnuwhatsnew'] = "Hva er nytt?";
$text['mnushowlog'] = "Besøkslogg";
$text['mnulanguage'] = "Bytt Språk";
$text['mnuadmin'] = "Administrasjon";
$text['welcome'] = "Velkommen";
$text['contactus'] = "Ta kontakt";
//changed in 8.0.0
$text['born'] = "Født";
$text['searchnames'] = "Søk etter navn";
//added in 8.0.0
$text['editperson'] = "Rediger person";
$text['loadmap'] = "Vis kartet";
$text['birth'] = "Fødsel";
$text['wasborn'] = "ble født";
$text['startnum'] = "Første tall";
$text['searching'] = "Søker";
//moved here in 8.0.0
$text['location'] = "Lokasjon";
$text['association'] = "Assosiasjon";
$text['collapse'] = "Kollaps";
$text['expand'] = "Ekspander";
$text['plot'] = "Felt";
$text['searchfams'] = "Søk familier";
//added in 8.0.2
$text['wasmarried'] = "Giftet seg med";
$text['anddied'] = "og døde";
//added in 9.0.0
$text['share'] = "Del";
$text['hide'] = "Skjul";
$text['disabled'] = "Din brukerkonto har blitt deaktivert. Vennligst kontakt administrator for mer informasjon.";
$text['contactus_long'] = "Har du spørsmål eller kommentarer til informasjonen på dette nettstedet, <span class=\"emphasis\"><a href=\"suggest.php\">ta gjerne kontakt</a></span>. Vi ser frem til å høre fra deg.";
$text['features'] = "Aktuelt";
$text['resources'] = "Ressurser";
$text['latestnews'] = "Siste Nytt";
$text['trees'] = "Trær";
$text['wasburied'] = "ble begravet";
//moved here in 9.0.0
$text['emailagain'] = "Gjenta e-postadresse";
$text['enteremail2'] = "Skriv inn din e-postadresse en gang til.";
$text['emailsmatch'] = "E-postadressene var ikke like. Skriv inn samme e-postadresse i begge felt.";
$text['getdirections'] = "Klikk for å få veibeskrivelse";
$text['calendar'] = "Kalender";
//changed in 9.0.0
$text['directionsto'] = " til ";
$text['slidestart'] = "Lysbildefremvisning";
$text['livingnote'] = "Minst en nålevende eller privat person er linket til dette notatet. Detaljer ikke tilgjengelig.";
$text['livingphoto'] = "Minst en nålevende eller privat person er linket til dette bildet. Detaljer ikke tilgjengelig.";
$text['waschristened'] = "ble døpt";
//added in 10.0.0
$text['branches'] = "Grener";
$text['detail'] = "Detalj";
$text['moredetail'] = "Flere detaljer";
$text['lessdetail'] = "Færre detaljer";
$text['conflds'] = "Konfirmert (LDS)";
$text['initlds'] = "Initiatory (LDS)";
$text['wascremated'] = "ble kremert";
//moved here in 11.0.0
$text['text_for'] = "for";
//added in 11.0.0
$text['searchsite'] = "Søk dette nettstedet";
$text['searchsitemenu'] = "Søk nettsted";
$text['kmlfile'] = "Last ned en .kml fil for å vise dette stedet i Google Earth";
$text['download'] = "Klikk for å laste ned";
$text['more'] = "Mer";
$text['heatmap'] = "Spredningskart";
$text['refreshmap'] = "Frisk opp kart";
$text['remnums'] = "Fjern antall og kartnåler";
$text['photoshistories'] = "Bilder &amp; Historier";
$text['familychart'] = "Familiediagram";
//added in 12.0.0
$text['firstnames'] = "Fornavn";
//moved here in 12.0.0
$text['dna_test'] = "DNA test";
$text['test_type'] = "Testtype";
$text['test_info'] = "Testinformasjon";
$text['takenby'] = "Test tatt av";
$text['haplogroup'] = "Haplogruppe";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevante linker";
$text['nofirstname'] = "[mangler fornavn]";
//added in 12.0.1
$text['cookieuse'] = "Merk: Dette nettstedet bruker informasjonskapsler (cookies).";
$text['dataprotect'] = "Retningslinjer for personvern";
$text['viewpolicy'] = "Se retningslinjer";
$text['understand'] = "Jeg forstår";
$text['consent'] = "Jeg gir mitt samtykke til at dette nettstedet lagrer den personlige informasjonen nevnt under 'Retningslinjer for personvern'. JJeg forstår at jeg kan be nettstedets eier fjerne denne informasjonen når som helst.";
$text['consentreq'] = "Vennligst gi ditt samtykke til at dette nettstedet kan lagre personlig informasjon.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tester er linket til";
$text['testislinked'] = "DNA test er linket til";

//added in 12.2
$text['quicklinks'] = "Hurtigkoblinger";
$text['yourname'] = "Ditt navn";
$text['youremail'] = "Din e-postadresse";
$text['liketoadd'] = "All informasjon du vil legge til";
$text['webmastermsg'] = "Webmaster melding";
$text['gallery'] = "Se galleri";
$text['wasborn_male'] = "ble født";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "ble født"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "ble døpt";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "ble døpt";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "døde";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "døde";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "ble begravet"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "ble begravet"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "ble kremert";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "ble kremert";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "giftet seg med";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "giftet seg med";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "ble skilt";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "ble skilt";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = ", ";			// used as a preposition to the location
$text['onthisdate'] = " ";		// when used with full date
$text['inthisyear'] = " ";		// when used with year only or month / year dates
$text['and'] = "og ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Test Info";
//added in 13.0
$text['visitor'] = "Besøkende";

$text['popupnote2'] = " = Nytt anetre";

//moved here in 14.0
$text['zoomin'] = "Zoom inn";
$text['zoomout'] = "Zoom ut";
$text['scrollnote'] = "NB: Du må kanskje dra eller bla ned for å se hele treet.";
$text['general'] = "Generelt";

//changed in 14.0
$text['otherevents'] = "Andre Hendelser og Egenskaper";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Forbindelser";
$text['continue'] = "Fortsett";
$text['title2'] = "Tittel"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>