<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Izvori informacija";
		$text['shorttitle'] = "Kratak naslov";
		$text['callnum'] = "4Call Number";
		$text['author'] = "AUTOR";
		$text['publisher'] = "6Publisher";
		$text['other'] = "Ostale informacije";
		$text['sourceid'] = "IZVOR ID";
		$text['moresrc'] = "Drugi izvori";
		$text['repoid'] = "11Repository ID";
		$text['browseallrepos'] = "12Browse All Repositories";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Novi jezik";
		$text['changelanguage'] = "Promena jezika";
		$text['languagesaved'] = "Aktiviraj odabrani jezik";
		$text['sitemaint'] = "Site maintenance in progress";
		$text['standby'] = "The site is temporarily unavailable while we update our database. Please try again in a few minutes. If the site remains down for an extended period of time, please <a href=\"suggest.php\">contact the site owner</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM pocinje od";
		$text['producegedfrom'] = "Napravi GEDCOM fajl u kome se nalaze";
		$text['numgens'] = "Broj generacija";
		$text['includelds'] = "Ukljuci LDS informacije";
		$text['buildged'] = "Napravi GEDCOM";
		$text['gedstartfrom'] = "GEDCOM startuje od";
		$text['nomaxgen'] = "Morate da odredite maksimalan broj generacija. Vratite se na prethodnu stranu, koristeci dugme za nazad i ispravite grešku.";
		$text['gedcreatedfrom'] = "GEDCOM napravljen od";
		$text['gedcreatedfor'] = "napravljen za";
		$text['creategedfor'] = "Kreiranje GEDCOM fajlova";
		$text['email'] = "Vaša E-mail adresa";
		$text['suggestchange'] = "Predlog za izmenu ili dopunu podataka";
		$text['yourname'] = "Vaše ime i prezime";
		$text['comments'] = "Komentar";
		$text['comments2'] = "Vaš komentar";
		$text['submitsugg'] = "Pošalji primedbu";
		$text['proposed'] = "Predložena izmena";
		$text['mailsent'] = "Hvala vam. Vaša poruka je poslata.";
		$text['mailnotsent'] = "Žao nam je, ali vaša poruka nemože biti isporucena.";
		$text['mailme'] = "Pošalji kopiju i na ovu adresu";
		$text['entername'] = "Zaboravili ste da upišete vaše ime.";
		$text['entercomments'] = "Zaboravili ste da upišite vaš komentar";
		$text['sendmsg'] = "Send Message";
		//added in 9.0.0
		$text['subject'] = "Subject";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografije i tekstovi - ";
		$text['indinfofor'] = "Licne informacije - ";
		$text['pp'] = "42pp."; //page abbreviation
		$text['age'] = "GODINA I DANA";
		$text['agency'] = "Kumstvo";
		$text['cause'] = "Uzrok";
		$text['suggested'] = "Predloženo";
		$text['closewindow'] = "Zatvori prozor";
		$text['thanks'] = "Hvala";
		$text['received'] = "Vaša primedba je prosledena administratoru.";
		$text['indreport'] = "Individual Report";
		$text['indreportfor'] = "Individual Report for";
		$text['bkmkvis'] = "<strong>Note:</strong> These bookmarks are only visible on this computer and in this browser.";
        //added in 9.0.0
		$text['reviewmsg'] = "You have a suggested change that needs your review. This submission concerns:";
        $text['revsubject'] = "Suggested change needs your review";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Izracunavanje stepena srodstva";
		$text['findrel'] = "Pronaðite srodstva";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "IZRACUNAJ";
		$text['select2inds'] = "Izaberite dve osobe.";
		$text['findpersonid'] = "Pronadi licni ID";
		$text['enternamepart'] = "Upišite deo imena i / ili prezimena";
		$text['pleasenamepart'] = "Upišite deo imena ili prezimena.";
		$text['clicktoselect'] = "Kliknite mišem i odaberite";
		$text['nobirthinfo'] = "Nema informacija o rodenju";
		$text['relateto'] = "Srodstvo sa osobom po imenu -";
		$text['sameperson'] = "Dve osobe su ista osoba.";
		$text['notrelated'] = "Ove dve ososbe nisu u srodstvu unazad xxx generacija."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Da bi ste videli stepen srodstva izmedu dve osobe, koristite dugme 'TRAŽI' za pronalaženje osoba (ili zadržite vec upisanu osobu), zatim pritisnite dugme 'IZRACUNAJ'.";
		$text['sometimes'] = "(Ponekad provera razlièitog broja generacija daje drugaèiji rezultat.)";
		$text['findanother'] = "SRODSTVO SA DRUGOM OSOBOM";
		$text['brother'] = "the brother of";
		$text['sister'] = "the sister of";
		$text['sibling'] = "the sibling of";
		$text['uncle'] = "the xxx uncle of";
		$text['aunt'] = "the xxx aunt of";
		$text['uncleaunt'] = "the xxx uncle/aunt of";
		$text['nephew'] = "the xxx nephew of";
		$text['niece'] = "the xxx niece of";
		$text['nephnc'] = "the xxx newphew/niece of";
		$text['removed'] = "times removed";
		$text['rhusband'] = "the husband of ";
		$text['rwife'] = "the wife of ";
		$text['rspouse'] = "the spouse of ";
		$text['son'] = "the son of";
		$text['daughter'] = "the daughter of";
		$text['rchild'] = "the child of";
		$text['sil'] = "the son-in-law of";
		$text['dil'] = "the daughter-in-law of";
		$text['sdil'] = "the son- or daughter-in-law of";
		$text['gson'] = "the xxx grandson of";
		$text['gdau'] = "the xxx granddaughter of";
		$text['gsondau'] = "the xxx grandson/granddaughter of";
		$text['great'] = "great";
		$text['spouses'] = "are spouses";
		$text['is'] = "is";
		$text['changeto'] = "Promeni u:";
		$text['notvalid'] = "is not a valid Person ID number or does not exist in this database. Please try again.";
		$text['halfbrother'] = "the half brother of";
		$text['halfsister'] = "the half sister of";
		$text['halfsibling'] = "the half sibling of";
		//changed in 8.0.0
		$text['gencheck'] = "Broj generacija<br />za proveru";
		$text['mcousin'] = "the xxx cousin yyy of";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "the xxx cousin yyy of";  //female cousin
		$text['cousin'] = "the xxx cousin yyy of";
		$text['mhalfcousin'] = "the xxx half cousin yyy of";  //male cousin
		$text['fhalfcousin'] = "the xxx half cousin yyy of";  //female cousin
		$text['halfcousin'] = "the xxx half cousin yyy of";
		//added in 8.0.0
		$text['oneremoved'] = "once removed";
		$text['gfath'] = "the xxx grandfather of";
		$text['gmoth'] = "the xxx grandmother of";
		$text['gpar'] = "the xxx grandparent of";
		$text['mothof'] = "the mother of";
		$text['fathof'] = "the father of";
		$text['parof'] = "the parent of";
		$text['maxrels'] = "Maximum relationships to show";
		$text['dospouses'] = "Show relationships involving a spouse";
		$text['rels'] = "Relationships";
		$text['dospouses2'] = "Prikaži supružnike";
		$text['fil'] = "the father-in-law of";
		$text['mil'] = "the mother-in-law of";
		$text['fmil'] = "the father- or mother-in-law of";
		$text['stepson'] = "the stepson of";
		$text['stepdau'] = "the stepdaughter of";
		$text['stepchild'] = "the stepchild of";
		$text['stepgson'] = "the xxx step-grandson of";
		$text['stepgdau'] = "the xxx step-granddaughter of";
		$text['stepgchild'] = "the xxx step-grandchild of";
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
		$text['guncle'] = "the xxx great uncle of";
		$text['gaunt'] = "the xxx great aunt of";
		$text['guncleaunt'] = "the xxx great uncle/aunt of";
		$text['gnephew'] = "the xxx great nephew of";
		$text['gniece'] = "the xxx great niece of";
		$text['gnephnc'] = "the xxx great nephew/niece of";
		//added in 14.0
		$text['pathscalc'] = "Potražite veze";
		$text['findrel2'] = "Pronaðite srodstva i druge veze";
		$text['makeme2nd'] = "Koristi moj ID";
		$text['usebookmarks'] = "Koristite obeleživaèe/bookmarks";
		$text['select2inds'] = "Izaberite dve osobe.";
		$text['indinfofor'] = "Individualne informacije za";
		$text['nobookmarks'] = "Nema obeleživaèa/bookmark  za korišc´enje";
		$text['bkmtitle'] = "Osobe pronaðene u obeleživaèima/bookmarks";
		$text['bkminfo'] = "Izaberite osobu:";
		$text['sortpathsby'] = "Sortiraj putanje po broju";
		$text['sortbyshort'] = "Sortiraj po";
		$text['bylengthshort'] = "Dužina";
		$text['badID1'] = ": ID loše osobe1 - vratite se i ispravite";
		$text['badID2'] = ": ID loše osobe2 - vratite se i ispravite";
		$text['notintree'] = ": osoba sa ovim ID-om nije u trenutnoj bazi podataka stabla.";
		$text['sameperson'] = "Dve osobe su ista osoba.";;
		$text['nopaths'] = "Ove osobe nisu povezane, nisu u srodstvu";
		$text['nopaths1'] = "Nema više veza krac´ih od xxx";
		$text['nopaths2'] = "u xxx koracima pretrage";
		$text['longestpath'] = "(najduža do sada proverena putanja bila je duga xxx koraka)";
		$text['relevantpaths'] = "Broj pronaðenih razlièitih relevantnih putanja: xxx";
		$text['skipMarr'] = "(pored toga, broj putanja pronaðenih, ali nisu prikazani zbog prevelikog broja brakova bio je: xxx)";
		$text['mjaor'] = "ili";
		$text['connectionsto'] = "Veze za ";
		$text['findanotherpers'] = "Naði drugu osobu...";
		$text['sometimes'] = "(Ponekad provera razlièitog broja generacija daje drugaèiji rezultat.)";
		$text['anotherpath'] = "Potražite druge veze";
		$text['xpath'] = "Putanja ";
		$text['primary'] = "Poèetna osoba"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Krajnja osoba";
		$text['parent'] = "Roditelj";
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
		$text['hfather'] = "otac";
		$text['hmother'] = "majka";
		$text['hhusband'] = "suprug";
		$text['hwife'] = "supruga";
		$text['hson'] = "sin";
		$text['hdaughter'] = "æerka";
		$text['maxruns'] = "Maksimalan broj putanja koje treba proveriti";
		$text['maxrshort'] = "Maksimalan broj putanja";
		$text['maxlength'] = "Putanje veza ne duže od";
		$text['maxlshort'] = "Maksimalna dužina";
		$text['xstep'] = "korak";
		$text['xsteps'] = "koraka";
		$text['xmarriages'] = "xxx brakova";
		$text['xmarriage'] = "1 brak";
		$text['showspouses'] = "Prikažite oba supružnika";
		$text['showTxt'] = "Prikaži tekstualni opis putanje";
		$text['showTxtshort'] = "Tekstualno potomci/descendant";
		$text['compactBox'] = "Prikažite osobe u kompatnom obliku";
		$text['compactBoxshort'] = "Kompaktni oblik";
		$text['paths'] = "Putanje";
		$text['dospouses2'] = "Prikaži supružnike";
		$text['maxmopt'] = "Maksimalan broj brakova po srodstvu";
		$text['maxm'] = "Maksimalan broj brakova";
		$text['arerelated'] = "Ove osobe su rodaci - njihovo srodstvo je prikazano u Putanji 1";
		$text['simplerel'] = "Jednostavna pretraga srodstva";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Porodicni list za - ";
		$text['ldsords'] = "70LDS Ordinances";
		$text['baptizedlds'] = "Baptized (LDS)";
		$text['endowedlds'] = "Endowed (LDS)";
		$text['sealedplds'] = "Sealed P (LDS)";
		$text['sealedslds'] = "Sealed S (LDS)";
		$text['otherspouse'] = "DRUGI BRAKOVI";
		$text['husband'] = "Suprug";
		$text['wife'] = "Supruga";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "Rod.";
		$text['capaltbirthabbr'] = "82A";
		$text['capdeathabbr'] = "Smr.";
		$text['capburialabbr'] = "Sah.";
		$text['capplaceabbr'] = "85P";
		$text['capmarrabbr'] = "Ven.";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "87Redraw with";
		$text['unknownlit'] = "Nema podataka";
		$text['popupnote1'] = "= Dodatne informacije";
		$text['pedcompact'] = "ZBIJENO";
		$text['pedstandard'] = "STANDARDNO";
		$text['pedtextonly'] = "TEKST";
		$text['descendfor'] = "Potomci";
		$text['maxof'] = "Maksimalno";
		$text['gensatonce'] = "generacija prikazanih odjednom.";
		$text['sonof'] = "sin - roditelji";
		$text['daughterof'] = "kci - roditelji";
		$text['childof'] = "dete - roditelji";
		$text['stdformat'] = "STANDARDNO";
		$text['ahnentafel'] = "PO GENERACIJAMA";
		$text['addnewfam'] = "Dodaj novu porodicu";
		$text['editfam'] = "Obradi porodicu";
		$text['side'] = "- krilo";
		$text['familyof'] = "svih predaka koji vode do osobe sa imenom";
		$text['paternal'] = "Ocevo";
		$text['maternal'] = "Majcino";
		$text['gen1'] = "Odabrana osoba";
		$text['gen2'] = "Roditelj";
		$text['gen3'] = "Deda i baba";
		$text['gen4'] = "Pradede i prababe";
		$text['gen5'] = "Cukundede i cukunbabe";
		$text['gen6'] = "Navrdede i navrbabe";
		$text['gen7'] = "Kurdeli i kurdele";
		$text['gen8'] = "Askurdeli i askurdele";
		$text['gen9'] = "Kurdupi i kurdupe";
		$text['gen10'] = "Kurlebala i kurlebale";
		$text['gen11'] = "Sukurdoli i sukurdole";
		$text['gen12'] = "Sudepaci i sudepace";
		$text['graphdesc'] = "Grafik do te tacke";
		$text['pedbox'] = "KARTICE";
		$text['regformat'] = "PO GENERACIJAMA";
		$text['extrasexpl'] = "Ako postoje fotografije ili neka druga dokumenta za neku od osoba, odgovarajuca ikonicace se pojaviti pored tog imena.";
		$text['popupnote3'] = " = New chart";
		$text['mediaavail'] = "Media Available";
		$text['pedigreefor'] = "Pretci - ";
		$text['pedigreech'] = "Pedigree Chart";
		$text['datesloc'] = "Dates and Locations";
		$text['borchr'] = "Birth/Alt - Death/Burial (two)";
		$text['nobd'] = "No Birth or Death Dates";
		$text['bcdb'] = "Birth/Alt/Death/Burial (four)";
		$text['numsys'] = "Numbering System";
		$text['gennums'] = "Generation Numbers";
		$text['henrynums'] = "Henry Numbers";
		$text['abovnums'] = "d'Aboville Numbers";
		$text['devnums'] = "de Villiers Numbers";
		$text['dispopts'] = "Display Options";
		//added in 10.0.0
		$text['no_ancestors'] = "No ancestors found";
		$text['ancestor_chart'] = "Vertical ancestor chart";
		$text['opennewwindow'] = "Open in a new window";
		$text['pedvertical'] = "Vertical";
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
		$text['dtchildren'] = "Deca";
		$text['dtgrandchildren'] = "Unuci";
		$text['dtggrandchildren'] = "Praunuci";
		$text['dtgggrandchildren'] = "Great grandchildren"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Nema potomaka";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Ukupno";
		$text['dtselect'] = "Izabrati";
		$text['dteachfulltable'] = "Svaka puna tabela æe imati";
		$text['dtrows'] = "redova";
		$text['dtdisplayingtable'] = "Prikaz tabele";
		$text['dtgototable'] = "Idi do tabele:";
		$text['fcinstrdn'] = "Prikaži porodicu sa supružnikom";
		$text['fcinstrup'] = "Prikaži porodicu sa roditeljima";
		$text['fcinstrplus'] = "Izaberite druge supružnike";
		$text['fcinstrfam'] = "Izaberite druge roditelje";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Ne postoji nijedan izveštaj.";
		$text['reportname'] = "Ime izveštaja";
		$text['allreports'] = "Svi izveštaji";
		$text['report'] = "Izveštaj";
		$text['error'] = "Greška";
		$text['reportsyntax'] = "Sintaksa upita koji radi uz izveštaj";
		$text['wasincorrect'] = "je pogrešna, i kao rezultat izveštaj nemože biti pokazan. Kontaktirajte system administratora : vladeta@batocanin.com";
		$text['errormessage'] = "Greška";
		$text['equals'] = "nalik na";
		$text['endswith'] = "završava se sa";
		$text['soundexof'] = "zvuci kao";
		$text['metaphoneof'] = "metafora od";
		$text['plusminus10'] = "+/- 10 godina od";
		$text['lessthan'] = "manje od";
		$text['greaterthan'] = "više od";
		$text['lessthanequal'] = "manje ili jedanko";
		$text['greaterthanequal'] = "vece ili jednako";
		$text['equalto'] = "jednako";
		$text['tryagain'] = "Pokušajte ponovo";
		$text['joinwith'] = "Odnos parametara";
		$text['cap_and'] = "I";
		$text['cap_or'] = "ILI";
		$text['showspouse'] = "Pokaži bracne partnere (ime se po";
		$text['submitquery'] = "Vaš upit";
		$text['birthplace'] = "Mesto rodenja";
		$text['deathplace'] = "Mesto smrti";
		$text['birthdatetr'] = "Godina rodenja";
		$text['deathdatetr'] = "Godina smrti";
		$text['plusminus2'] = "+/- 2 godine od";
		$text['resetall'] = "Resetuj sve vrednosti";
		$text['showdeath'] = "Pokaži informacije o smrti/sahrani";
		$text['altbirthplace'] = "Mesto krštenja";
		$text['altbirthdatetr'] = "Godina krštenja";
		$text['burialplace'] = "Mesto sahrant";
		$text['burialdatetr'] = "Godina sahrane";
		$text['event'] = "Dogadaj(i)";
		$text['day'] = "Dan";
		$text['month'] = "Mesec";
		$text['keyword'] = "Kljuc (ie, \"Abt\")";
		$text['explain'] = "Unesite podatke o datumu da bi ste videli dogadaje koji odgovaraju zadatom kriterijumu. Ili ostavite prazno da bi ste videli sve odabrane dogadaje.";
		$text['enterdate'] = "Upišite ili odaberite minimum jednu od ovih informacijs: dan, mesec, godina, kljucna rec";
		$text['fullname'] = "Puno ime i prezime";
		$text['birthdate'] = "Datum rodenja";
		$text['altbirthdate'] = "Datum krštenja";
		$text['marrdate'] = "Datum sklapanja braka";
		$text['spouseid'] = "Bracni drug - ID";
		$text['spousename'] = "Ime bracnog druga";
		$text['deathdate'] = "Datum smrti";
		$text['burialdate'] = "Datum sahrane";
		$text['changedate'] = "Datum zadnje promene";
		$text['gedcom'] = "Porodicno stablo";
		$text['baptdate'] = "191Baptism Date (LDS)";
		$text['baptplace'] = "192Baptism Place (LDS)";
		$text['endldate'] = "193Endowment Date (LDS)";
		$text['endlplace'] = "194Endowment Place (LDS)";
		$text['ssealdate'] = "195Seal Date S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "196Seal Place S (LDS)";
		$text['psealdate'] = "197Seal Date P (LDS)";   //Sealed to parents
		$text['psealplace'] = "198Seal Place P (LDS)";
		$text['marrplace'] = "Mesto sklapanja braka";
		$text['spousesurname'] = "Prezime bracnog druga";
		$text['spousemore'] = "203If you enter a value for Spouse's Last Name, you must enter a value for at least one other field.";
		$text['plusminus5'] = "+/- 5 years from";
		$text['exists'] = "exists";
		$text['dnexist'] = "does not exist";
		$text['divdate'] = "Divorce Date";
		$text['divplace'] = "Divorce Place";
		$text['otherevents'] = "Drugi dogadaji";
		$text['numresults'] = "Results per page";
		$text['mysphoto'] = "Mystery Photos";
		$text['mysperson'] = "Elusive People";
		$text['joinor'] = "The 'Join with OR' option cannot be used with Spouse's Last Name";
		$text['tellus'] = "Tell us what you know";
		$text['moreinfo'] = "More Information:";
		//added in 8.0.0
		$text['marrdatetr'] = "Marriage Year";
		$text['divdatetr'] = "Divorce Year";
		$text['mothername'] = "Mother's Name";
		$text['fathername'] = "Father's Name";
		$text['filter'] = "Filter";
		$text['notliving'] = "Not Living";
		$text['nodayevents'] = "Events for this month that are not associated with a specific day:";
		//added in 9.0.0
		$text['csv'] = "Comma-delimited CSV file";
		//added in 10.0.0
		$text['confdate'] = "Confirmation Date (LDS)";
		$text['confplace'] = "Confirmation Place (LDS)";
		$text['initdate'] = "Initiatory Date (LDS)";
		$text['initplace'] = "Initiatory Place (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Marriage Type";
		$text['searchfor'] = "Search for";
		$text['searchnote'] = "Note: This page uses Google to perform its search. The number of matches returned will be directly affected by the extent to which Google has been able to index the site.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Evidencija za";
		$text['mostrecentactions'] = "poslednjih izvršenih upita.";
		$text['autorefresh'] = "Startuj automatsko obnavljanje svakih 30 sekundi";
		$text['refreshoff'] = "Zaustavi automatsko obnavljanje";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Groblja i nadgrobni spomenici";
		$text['showallhsr'] = "Pokaži sve zapise o spomenicima";
		$text['in'] = "-";
		$text['showmap'] = "Pokaži plan";
		$text['headstonefor'] = "Spomenik za";
		$text['photoof'] = "Fotografija - ";
		$text['photoowner'] = "AUTOR/IZVOR";
		$text['nocemetery'] = "Nema groblja";
		$text['iptc005'] = "225Naslov";
		$text['iptc020'] = "226Supp. Categories";
		$text['iptc040'] = "227Special Instructions";
		$text['iptc055'] = "228Creation Date";
		$text['iptc080'] = "229Autor";
		$text['iptc085'] = "230Author's Position";
		$text['iptc090'] = "231City";
		$text['iptc095'] = "232State";
		$text['iptc101'] = "233Country";
		$text['iptc103'] = "234OTR";
		$text['iptc105'] = "235Headline";
		$text['iptc110'] = "236Source";
		$text['iptc115'] = "237Photo Source";
		$text['iptc116'] = "238Copyright Notice";
		$text['iptc120'] = "239Caption";
		$text['iptc122'] = "240Caption Writer";
		$text['mapof'] = "241Map of";
		$text['regphotos'] = "Lista sa detaljima";
		$text['gallery'] = "Samo slicice";
		$text['cemphotos'] = "Fotografija groblja";
		$text['photosize'] = "VELICINA";
        $text['iptc010'] = "Priority";
		$text['filesize'] = "File Size";
		$text['seeloc'] = "See Location";
		$text['showall'] = "Show All";
		$text['editmedia'] = "Edit Media";
		$text['viewitem'] = "View this item";
		$text['editcem'] = "Edit Cemetery";
		$text['numitems'] = "# Items";
		$text['allalbums'] = "All Albums";
		$text['slidestop'] = "Pause Slide Show";
		$text['slideresume'] = "Resume Slide Show";
		$text['slidesecs'] = "Seconds for each slide:";
		$text['minussecs'] = "minus 0.5 seconds";
		$text['plussecs'] = "plus 0.5 seconds";
		$text['nocountry'] = "Unknown country";
		$text['nostate'] = "Unknown state";
		$text['nocounty'] = "Unknown county";
		$text['nocity'] = "Unknown city";
		$text['nocemname'] = "Unknown cemetery name";
		$text['editalbum'] = "Edit Album";
		$text['mediamaptext'] = "<strong>Note:</strong> Move your mouse pointer over the image to show names. Click to see a page for each name.";
		//added in 8.0.0
		$text['allburials'] = "All Burials";
		$text['moreinfo'] = "More Information:";
		//added in 9.0.0
        $text['iptc025'] = "Keywords";
        $text['iptc092'] = "Sub-location";
		$text['iptc015'] = "Category";
		$text['iptc065'] = "Originating Program";
		$text['iptc070'] = "Program Version";
		//added in 13.0
		$text['toggletags'] = "Toggle Tags";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Prikaz prezimena koja pocinju na";
		$text['showtop'] = "Pokaži prvih";
		$text['showallsurnames'] = "Prikaz svih prezimena";
		$text['sortedalpha'] = "po abecedi";
		$text['byoccurrence'] = "po ucestalosti";
		$text['firstchars'] = "Pocetna slova";
		$text['mainsurnamepage'] = "Pocetna strana sa prezimenima";
		$text['allsurnames'] = "Sva prezimena";
		$text['showmatchingsurnames'] = "Kliknite na prezime da vidite osobe sa tim prezimenom";
		$text['backtotop'] = "Na pocetak";
		$text['beginswith'] = "koja pocinju sa";
		$text['allbeginningwith'] = "Prezimana koja pocinju sa";
		$text['numoccurrences'] = "broj osoba";
		$text['placesstarting'] = "Pokaži mesta cije ime pocinje sa";
		$text['showmatchingplaces'] = "Kliknite na ime mesta da vidite manje lokalitete. Kliknite na lupu ako želite da vidite koje sve povezan sa tom lokacijom.";
		$text['totalnames'] = "ukupno osoba";
		$text['showallplaces'] = "Pokaži sva veca mesta";
		$text['totalplaces'] = "ukupno mesta";
		$text['mainplacepage'] = "Pokaži pocetnu listu mesta";
		$text['allplaces'] = "Sva veca mesta";
		$text['placescont'] = "Pokaži sva mesta koja u imenu sadrže";
		//changed in 8.0.0
		$text['top30'] = "Top xxx surnames";
		$text['top30places'] = "Top xxx largest localities";
		//added in 12.0.0
		$text['firstnamelist'] = "First Name List";
		$text['firstnamesstarting'] = "Show first names starting with";
		$text['showallfirstnames'] = "Show all first names";
		$text['mainfirstnamepage'] = "Main first name page";
		$text['allfirstnames'] = "All First Names";
		$text['showmatchingfirstnames'] = "Click on a first name to show matching records.";
		$text['allfirstbegwith'] = "All first names beginning with";
		$text['top30first'] = "Top xxx first names";
		$text['allothers'] = "All others";
		$text['amongall'] = "(among all names)";
		$text['justtop'] = "Just the top xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(u zadnjih xx dana)";

		$text['photo'] = "Fotografije";
		$text['history'] = "278History/Document";
		$text['husbid'] = "SUPRUG ID";
		$text['husbname'] = "IME I PREZIME SUPRUGA";
		$text['wifeid'] = "SUPRUGA ID";
		//added in 11.0.0
		$text['wifename'] = "Mother's Name";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Obriši";
		$text['addperson'] = "Dodaj novu osobu";
		$text['nobirth'] = "Odabrana osoba nema korektan datum rodenja i nemože biti dodata.";
		$text['event'] = "Dogadaj(i)";
		$text['chartwidth'] = "ŠIRINA DIJAGRAMA";
		$text['timelineinstr'] = "Dodaj nove osobe unoseci njihov ID u donja polja:";
		$text['togglelines'] = "Toggle Lines";
		//changed in 9.0.0
		$text['noliving'] = "Odabrana osoba je markirana kao živa i ne može biti dodata jer vi nemate dovoljno prava";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Pretraživanje svih porodicnih stabala";
		$text['treename'] = "Porodicno stablo";
		$text['owner'] = "Vlasnik";
		$text['address'] = "Adresa";
		$text['city'] = "Mesto";
		$text['state'] = "Oblast";
		$text['zip'] = "Poštanski broj";
		$text['country'] = "Država";
		$text['email'] = "Vaša E-mail adresa";
		$text['phone'] = "Telefon";
		$text['username'] = "Korisnicko ime";
		$text['password'] = "Lozinka";
		$text['loginfailed'] = "Prijavljivanje nije uspelo.";

		$text['regnewacct'] = "Registrovanje novog korisnickog konta";
		$text['realname'] = "Vaše pravo ime";
		$text['phone'] = "Telefon";
		$text['email'] = "Vaša E-mail adresa";
		$text['address'] = "Adresa";
		$text['acctcomments'] = "Komentar";
		$text['submit'] = "Pošalji";
		$text['leaveblank'] = "(ostavite prazno ako želite novo porodicno stablo)";
		$text['required'] = "Polja koja morate obavezno popuniti";
		$text['enterpassword'] = "Molimo vas upišite lozinku";
		$text['enterusername'] = "Molimo vas upišite korisnicko ime";
		$text['failure'] = "Žao nam je, ali korisnicko ime koje ste odabrali je vec u upotrebi. Vratite se na prethodnu stranu koristeci dugme za nazad i odaberite neko drugo korisnicko ime.";
		$text['success'] = "Hvala. Dobili smo vaš zahtev za registraciju. Dobicete mail cim vaša registracija bude aktivirana ili u skucaju da su potrebne dodatne informacije.";
		$text['emailsubject'] = "Zahtev za registraciju novog korisnika";
		$text['website'] = "Web sajt";
		$text['nologin'] = "Niste registrovani?";
		$text['loginsent'] = "319Login information sent";
		$text['loginnotsent'] = "Tražene informacije nisu poslate.";
		$text['enterrealname'] = "Milomo vas upišite vaše pravo ime i prezime";
		$text['rempass'] = "Aktiviraj stalnu prijavu na ovom kompjuteru";
		$text['morestats'] = "Potpuna statistika";
		$text['accmail'] = "<strong>NOTE:</strong> In order to receive mail from the site administrator regarding your account, please make sure that you are not blocking mail from this domain.";
		$text['newpassword'] = "New Password";
		$text['resetpass'] = "Reset your password";
		$text['nousers'] = "This form cannot be used until at least one user record exists. If you are the site owner, please go to Admin/Users to create your Administrator account.";
		$text['noregs'] = "We're sorry, but we are not accepting new user registrations at this time. Please <a href=\"suggest.php\">contact us</a> directly if you have comments or questions regarding anything on this site.";
		$text['emailmsg'] = "You have received a new request for a TNG user account. Please log into your TNG Admin area and assign proper permissions to this new account. If you approve of this registration, please notify the applicant by replying to this message.";
		$text['accactive'] = "The account has been activated, but the user will have no special rights until you assign them.";
		$text['accinactive'] = "Go to Admin/Users/Review to access the account settings. The account will remain inactive until you edit and save the record at least once.";
		$text['pwdagain'] = "Password again";
		$text['enterpassword2'] = "Please enter your password again.";
		$text['pwdsmatch'] = "Your passwords do not match. Please enter the same password in each field.";
		$text['acksubject'] = "Thank you for registering"; //for a new user account
		$text['ackmessage'] = "Your request for a user account has been received. Your account will be inactive until it has been reviewed by the site administrator. You will be notified by email when your login is ready for use.";
		//added in 12.0.0
		$text['switch'] = "Switch";
		//added in 14.0
		$text['newpassword2'] = "Nova lozinka ponovo";
		$text['resetsuccess'] = "Uspeh: Lozinka je resetovana";
		$text['resetfail'] = "Greška: Lozinka nije resetovana";
		$text['failreason0'] = " (nepoznata greška baze podataka)";
		$text['failreason2'] = " (nemate dozvolu da promenite lozinku)";
		$text['failreason3'] = " (lozinke se ne poklapaju)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Browse All Branches";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "VELICINA";
		$text['totindividuals'] = "Ukupno ososba";
		$text['totmales'] = "Ukupno osoba muškog pola";
		$text['totfemales'] = "Ukupno osoba ženskog pola";
		$text['totunknown'] = "Ukupno osoba nepoznatog pola";
		$text['totliving'] = "Ukupno živih";
		$text['totfamilies'] = "Ukupno porodica";
		$text['totuniquesn'] = "Ukupno jedinstvenih prezimena";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Ukupno izvora";
		$text['avglifespan'] = "Prosecan životni vek";
		$text['earliestbirth'] = "Najranije rodenje";
		$text['longestlived'] = "NAJDUŽE ŽIVELI";
		$text['days'] = "dana";
		$text['age'] = "GODINA I DANA";
		$text['agedisclaimer'] = "Izracunavanje godina je bazirano na podacima rodenja i smrti. Buduci da postoje nepotpuni podaci kao što su pre 1869 ili oko 1863 ili iza 1780 ova izracunavanje ne mogu biti 100% tacna.";
		$text['treedetail'] = "345More information on this tree";
		$text['total'] = "Total";
		//added in 12.0
		$text['totdeceased'] = "Total Deceased";
		//added in 14.0
		$text['totalsourcecitations'] = "Ukupno Izvora Citata";
		break;

	case "notes":
		$text['browseallnotes'] = "Lista svih beleški";
		break;

	case "help":
		$text['menuhelp'] = "IZBOR";
		break;

	case "install":
		$text['perms'] = "Permissions have all been set.";
		$text['noperms'] = "Permissions could not be set for these files:";
		$text['manual'] = "Please set them manually.";
		$text['folder'] = "Folder";
		$text['created'] = "has been created";
		$text['nocreate'] = "could not be created. Please create it manually.";
		$text['infosaved'] = "Information saved, connection verified!";
		$text['tablescr'] = "The tables have been created!";
		$text['notables'] = "The following tables could not be created:";
		$text['nocomm'] = "TNG is not communicating with your database. No tables were created.";
		$text['newdb'] = "Information saved, connection verified, new database created:";
		$text['noattach'] = "Information saved. Connection made and database created, but TNG cannot attach to it.";
		$text['nodb'] = "Information saved. Connection made, but database does not exist and could not be created here. Please verify that the database name is correct, and that the database user has proper access, or use your control panel to create it.";
		$text['noconn'] = "Information saved but connection failed. One or more of the following is incorrect:";
		$text['exists'] = "exists";
		$text['noop'] = "No operation was performed.";
		//added in 8.0.0
		$text['nouser'] = "User was not created. Username may already exist.";
		$text['notree'] = "Tree was not created. Tree ID may already exist.";
		$text['infosaved2'] = "Information saved";
		$text['renamedto'] = "renamed to";
		$text['norename'] = "could not be renamed";
		//changed in 13.0.0
		$text['loginfirst'] = "You must log in first.";
		break;

	case "imgviewer":
		$text['magmode'] = "Magnify Mode";
		$text['panmode'] = "Pan Mode";
		$text['pan'] = "Click and drag to move within the image";
		$text['fitwidth'] = "Fit Width";
		$text['fitheight'] = "Fit Height";
		$text['newwin'] = "New Window";
		$text['opennw'] = "Open image in a new window";
		$text['magnifyreg'] = "Click to magnify a region of the image";
		$text['imgctrls'] = "Enable Image Controls";
		$text['vwrctrls'] = "Enable Image Viewer Controls";
		$text['vwrclose'] = "Close Image Viewer";
		break;

	case "dna":
		$text['test_date'] = "Test date";
		$text['links'] = "Relevant links";
		$text['testid'] = "Test ID";
		//added in 12.0.0
		$text['mode_values'] = "Mode Values";
		$text['compareselected'] = "Compare Selected";
		$text['dnatestscompare'] = "Compare Y-DNA Tests";
		$text['keep_name_private'] = "Keep Name Private";
		$text['browsealltests'] = "Browse All Tests";
		$text['all_dna_tests'] = "All DNA tests";
		$text['fastmutating'] = "Fast&nbsp;Mutating";
		$text['alltypes'] = "All Types";
		$text['allgroups'] = "All Groups";
		$text['Ydna_LITbox_info'] = "Test(s) linked to this person were not necessarily taken by this person.<br />The 'Haplogroup' column displays data in red if the result is 'Predicted' or green if the test is 'Confirmed'";
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
$text['matches'] = "Lista pronadenih, od";
$text['description'] = "OPIS";
$text['notes'] = "BELEŠKE";
$text['status'] = "354Status";
$text['newsearch'] = "Nova pretraga";
$text['pedigree'] = "Pretci";
$text['seephoto'] = "Vidi fotografiju";
$text['andlocation'] = "360&amp; location";
$text['accessedby'] = "pristup sa ";
$text['children'] = "DECA";  //from getperson
$text['tree'] = "Porodicno stablo";
$text['alltrees'] = "Sva porodicna stabla";
$text['nosurname'] = "[no surname]";
$text['thumb'] = "DETALJ";  //as in Thumbnail
$text['people'] = "POVEZANO SA";
$text['title'] = "NASLOV";  //from getperson
$text['suffix'] = "373Suffix";  //from getperson
$text['nickname'] = "NADIMAK";  //from getperson
$text['lastmodified'] = "PROMENA";  //from getperson
$text['married'] = "VENCANJE";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "PREZIME I IME"; //from showmap
$text['lastfirst'] = "PREZIME, IME";  //from search
$text['bornchr'] = "ROÐENJE ILI KRŠTENJE";  //from search
$text['individuals'] = "Osobe";  //from whats new
$text['families'] = "Porodice";
$text['personid'] = "LICNI ID";
$text['sources'] = "IZVORI";  //from getperson (next several)
$text['unknown'] = "Nepoznat";
$text['father'] = "OTAC";
$text['mother'] = "MAJKA";
$text['christened'] = "KRŠTENJE";
$text['died'] = "SMRT";
$text['buried'] = "SAHRANA";
$text['spouse'] = "BRAK";  //from search
$text['parents'] = "RODITELJI";  //from pedigree
$text['text'] = "TEKST";  //from sources
$text['language'] = "Jezik";  //from languages
$text['descendchart'] = "Opadajuci";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "ODABRANA OSOBA";
$text['edit'] = "IZMENE";
$text['date'] = "Datum";
$text['login'] = "Prijavljivanje";
$text['logout'] = "ODJAVA";
$text['groupsheet'] = "Porodicni list";
$text['text_and'] = "i";
$text['generation'] = "Generacija";
$text['filename'] = "IME FAJLA";
$text['id'] = "ID";
$text['search'] = "TRAŽI";
$text['user'] = "Korisnik";
$text['firstname'] = "Ime";
$text['lastname'] = "Prezime";
$text['searchresults'] = "Rezultat pretrage";
$text['diedburied'] = "SMRT / SAHRANA";
$text['homepage'] = "POCETNA STRANA";
$text['find'] = "TRAŽI";
$text['relationship'] = "SRODSTVO";		//in German, Verwandtschaft
$text['relationship2'] = "Relationship"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "VREMEPLOV";
$text['yesabbr'] = "Y";               //abbreviation for 'yes'
$text['divorced'] = "RAZVOD";
$text['indlinked'] = "POVEZANO SA";
$text['branch'] = "Branch";
$text['moreind'] = "More individuals";
$text['morefam'] = "More families";
$text['surnamelist'] = "Prezimena";
$text['generations'] = "BROJ GENERACIJA";
$text['refresh'] = "PONOVI";
$text['whatsnew'] = "Šta ima novo";
$text['reports'] = "Izveštaji";
$text['placelist'] = "Lista svih mesta koja u svome imenu sadrže";
$text['baptizedlds'] = "Baptized (LDS)";
$text['endowedlds'] = "Endowed (LDS)";
$text['sealedplds'] = "Sealed P (LDS)";
$text['sealedslds'] = "Sealed S (LDS)";
$text['ancestors'] = "PRETCI";
$text['descendants'] = "POTOMCI";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum poslednjeg prijema GEDCOM podataka";
$text['type'] = "Type";
$text['savechanges'] = "Zapiši promene";
$text['familyid'] = "PORODICNI ID";
$text['headstone'] = "SPOMENIK";
$text['historiesdocs'] = "TEKSTOVI";
$text['anonymous'] = "anonymous";
$text['places'] = "Mesta";
$text['anniversaries'] = "Datumi i godišnjice";
$text['administration'] = "Administracija";
$text['help'] = "POMOC";
//$text['documents'] = "Documents";
$text['year'] = "Godina";
$text['all'] = "SVE";
$text['address'] = "Adresa";
$text['suggest'] = "PRIMEDBA";
$text['editevent'] = "Suggest a change for this event";
$text['morelinks'] = "More Links";
$text['faminfo'] = "PORODICNE INFORMACIJE";
$text['persinfo'] = "LICNE INFORMACIJE";
$text['srcinfo'] = "DETALJI I VEZE";
$text['fact'] = "Fact";
$text['goto'] = "Odaberi stranu";
$text['tngprint'] = "ŠTAMPAJ";
$text['databasestatistics'] = "Statistika baze podataka"; //needed to be shorter to fit on menu
$text['child'] = "Dete";  //from familygroup
$text['repoinfo'] = "Repository Information";
$text['tng_reset'] = "BRIŠI";
$text['noresults'] = "Za zadati kriterijum nije pronaden ni jedan dogadaj.";
$text['allmedia'] = "All Media";
$text['repositories'] = "Repositories";
$text['albums'] = "Albums";
$text['cemeteries'] = "Cemeteries";
$text['surnames'] = "Surnames";
$text['dates'] = "Dates";
$text['link'] = "Link";
$text['media'] = "Media";
$text['gender'] = "Gender";
$text['latitude'] = "Latitude";
$text['longitude'] = "Longitude";
$text['bookmarks'] = "Bookmarks";
$text['bookmark'] = "Add Bookmark";
$text['mngbookmarks'] = "Go to Bookmarks";
$text['bookmarked'] = "Bookmark Added";
$text['remove'] = "Remove";
$text['find_menu'] = "Find";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "GROBLJE";
$text['gmapevent'] = "Event Map";
$text['gevents'] = "Event";
$text['googleearthlink'] = "Link to Google Earth";
$text['googlemaplink'] = "Link to Google Maps";
$text['gmaplegend'] = "Pin Legend";
$text['unmarked'] = "212Unmarked";
$text['located'] = "Lokalizovan";
$text['albclicksee'] = "Click to see all the items in this album";
$text['notyetlocated'] = "Not yet located";
$text['cremated'] = "Cremated";
$text['missing'] = "Missing";
$text['pdfgen'] = "PDF Generator";
$text['blank'] = "Blank Chart";
$text['fonts'] = "Fonts";
$text['header'] = "Header";
$text['data'] = "Data";
$text['pgsetup'] = "Page Setup";
$text['pgsize'] = "Page Size";
$text['orient'] = "Orientation"; //for a page
$text['portrait'] = "Portrait";
$text['landscape'] = "Landscape";
$text['tmargin'] = "Top Margin";
$text['bmargin'] = "Bottom Margin";
$text['lmargin'] = "Left Margin";
$text['rmargin'] = "Right Margin";
$text['createch'] = "Create Chart";
$text['prefix'] = "Prefix";
$text['mostwanted'] = "Most Wanted";
$text['latupdates'] = "Latest Updates";
$text['featphoto'] = "Featured Photo";
$text['news'] = "News";
$text['ourhist'] = "Our Family History";
$text['ourhistanc'] = "Our Family History and Ancestry";
$text['ourpages'] = "Our Family Genealogy Pages";
$text['pwrdby'] = "This site powered by";
$text['writby'] = "written by";
$text['searchtngnet'] = "Search TNG Network (GENDEX)";
$text['viewphotos'] = "View all photos";
$text['anon'] = "You are currently anonymous";
$text['whichbranch'] = "Which branch are you from?";
$text['featarts'] = "Feature Articles";
$text['maintby'] = "Maintained by";
$text['createdon'] = "Created on";
$text['reliability'] = "Verodostojnost";
$text['labels'] = "Labels";
$text['inclsrcs'] = "Include Sources";
$text['cont'] = "(cont.)"; //abbreviation for continued
$text['mnuheader'] = "Pocetna strana";
$text['mnusearchfornames'] = "Potraži ososbu";
$text['mnulastname'] = "Prezime";
$text['mnufirstname'] = "Ime";
$text['mnusearch'] = "Traži";
$text['mnureset'] = "481Start Over";
$text['mnulogon'] = "Prijavljivanje";
$text['mnulogout'] = "Odjavljivanje";
$text['mnufeatures'] = "Vaš izbor";
$text['mnuregister'] = "Registrujte se kao korisnik";
$text['mnuadvancedsearch'] = "Detaljnija pretraga";
$text['mnulastnames'] = "Prezimena";
$text['mnustatistics'] = "Statistika";
$text['mnuphotos'] = "Fotografije";
$text['mnuhistories'] = "Tekstovi";
$text['mnumyancestors'] = "Photos &amp; Histories for Ancestors of [Person]";
$text['mnucemeteries'] = "Groblja";
$text['mnutombstones'] = "Nadgrobni spomenici";
$text['mnureports'] = "Izveštaji";
$text['mnusources'] = "Izvori";
$text['mnuwhatsnew'] = "Šta ima novo";
$text['mnushowlog'] = "Lista pristupa";
$text['mnulanguage'] = "Promena jezika";
$text['mnuadmin'] = "Administracija";
$text['welcome'] = "Dobro došli";
$text['contactus'] = "Kontakt";
//changed in 8.0.0
$text['born'] = "ROÐENJE";
$text['searchnames'] = "Potraži prezime";
//added in 8.0.0
$text['editperson'] = "Edit Person";
$text['loadmap'] = "Load the map";
$text['birth'] = "Birth";
$text['wasborn'] = "was born";
$text['startnum'] = "First Number";
$text['searching'] = "Searching";
//moved here in 8.0.0
$text['location'] = "Location";
$text['association'] = "Association";
$text['collapse'] = "Skupi";
$text['expand'] = "Otvori";
$text['plot'] = "Plot";
$text['searchfams'] = "Search Families";
//added in 8.0.2
$text['wasmarried'] = "VENCANJE";
$text['anddied'] = "SMRT";
//added in 9.0.0
$text['share'] = "Share";
$text['hide'] = "Hide";
$text['disabled'] = "Your user account has been disabled. Please contact the site administrator for more information.";
$text['contactus_long'] = "If you have any questions or comments about the information on this site, please <span class=\"emphasis\"><a href=\"suggest.php\">contact us</a></span>. We look forward to hearing from you.";
$text['features'] = "Features";
$text['resources'] = "Resources";
$text['latestnews'] = "Latest News";
$text['trees'] = "Trees";
$text['wasburied'] = "was buried";
//moved here in 9.0.0
$text['emailagain'] = "Email again";
$text['enteremail2'] = "Please enter your email address again.";
$text['emailsmatch'] = "Your emails do not match. Please enter the same email address in each field.";
$text['getdirections'] = "Click to get directions";
$text['calendar'] = "Calendar";
//changed in 9.0.0
$text['directionsto'] = " to the ";
$text['slidestart'] = "Start Slide Show";
$text['livingnote'] = "At least one living individual is linked to this note - Details withheld.";
$text['livingphoto'] = "At least one living individual is linked to this photo - Details withheld.";
$text['waschristened'] = "KRŠTENJE";
//added in 10.0.0
$text['branches'] = "Branches";
$text['detail'] = "Detail";
$text['moredetail'] = "More detail";
$text['lessdetail'] = "Less detail";
$text['conflds'] = "Confirmed (LDS)";
$text['initlds'] = "Initiatory (LDS)";
$text['wascremated'] = "was cremated";
//moved here in 11.0.0
$text['text_for'] = "za traženi pojam";
//added in 11.0.0
$text['searchsite'] = "Search this site";
$text['searchsitemenu'] = "Search Site";
$text['kmlfile'] = "Download a .kml file to show this location in Google Earth";
$text['download'] = "Click to download";
$text['more'] = "More";
$text['heatmap'] = "Heat Map";
$text['refreshmap'] = "Refresh Map";
$text['remnums'] = "Clear Numbers and Pins";
$text['photoshistories'] = "Photos &amp; Histories";
$text['familychart'] = "Family Chart";
//added in 12.0.0
$text['firstnames'] = "First Names";
//moved here in 12.0.0
$text['dna_test'] = "DNA Test";
$text['test_type'] = "Test type";
$text['test_info'] = "Test Information";
$text['takenby'] = "Taken by";
$text['haplogroup'] = "Haplogroup";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevant links";
$text['nofirstname'] = "[no first name]";
//added in 12.0.1
$text['cookieuse'] = "Note: This site uses cookies.";
$text['dataprotect'] = "Data Protection Policy";
$text['viewpolicy'] = "View policy";
$text['understand'] = "I understand";
$text['consent'] = "I give my consent for this site to store the personal information collected here. I understand that I may ask the site owner to remove this information at any time.";
$text['consentreq'] = "Please give your consent for this site to store personal information.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Quick Links";
$text['yourname'] = "Your Name";
$text['youremail'] = "Your Email Address";
$text['liketoadd'] = "Any info you'd like to add";
$text['webmastermsg'] = "Webmaster Message";
$text['gallery'] = "See Gallery";
$text['wasborn_male'] = "was born";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "was born"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "was christened";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "was christened";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "died";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "died";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "was buried"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "was buried"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "was cremated";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "was cremated";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "married";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "married";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "was divorced";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "was divorced";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " in ";			// used as a preposition to the location
$text['onthisdate'] = " on ";		// when used with full date
$text['inthisyear'] = " in ";		// when used with year only or month / year dates
$text['and'] = "and ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Test Info";
//added in 13.0
$text['visitor'] = "Visitor";

$text['popupnote2'] = "= Novi dijagram";

//moved here in 14.0
$text['zoomin'] = "Zoom In";
$text['zoomout'] = "Zoom Out";
$text['scrollnote'] = "Ako ne vidite ceo dijagram pomerite sliku dole ili desno.";
$text['general'] = "General";

//changed in 14.0
$text['otherevents'] = "Drugi dogaðaji i atributi";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Veze";
$text['continue'] = "Nastavi";
$text['title2'] = "Naslov"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>