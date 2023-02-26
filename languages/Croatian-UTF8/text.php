<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Pregledajte sve izvore";
		$text['shorttitle'] = "Kratki naslov";
		$text['callnum'] = "Pozivni broj";
		$text['author'] = "Autor";
		$text['publisher'] = "Izdavač";
		$text['other'] = "Ostale informacije";
		$text['sourceid'] = "Izvor ID";
		$text['moresrc'] = "Drugi izvori";
		$text['repoid'] = "ID spremišta";
		$text['browseallrepos'] = "Pregledajte sve spremišta";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Novi jezik";
		$text['changelanguage'] = "Promjeni jezika";
		$text['languagesaved'] = "Jezik sačuvan";
		$text['sitemaint'] = "U tijeku je održavanje web mjesta";
		$text['standby'] = "Stranica je privremeno nedostupna dok ažuriramo našu bazu podataka. Molim pokušajte ponovo za par minuta. Ako web lokacija ostaje duže vreme, <a href=\"suggest.php\">kontaktirajte vlasnika s web mjesta</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM počinje od";
		$text['producegedfrom'] = "Izradite GEDCOM datoteku iz";
		$text['numgens'] = "Broj generacija";
		$text['includelds'] = "Uključite podatke o LDS-u";
		$text['buildged'] = "Napravi GEDCOM";
		$text['gedstartfrom'] = "GEDCOM počima od";
		$text['nomaxgen'] = "Morate da odredite maksimalni broj generacija. Upotrijebite gumb Natrag za povratak na prethodnu stranicu i ispravljanje pogreške";
		$text['gedcreatedfrom'] = "GEDCOM napravljen od";
		$text['gedcreatedfor'] = "napravljen za";
		$text['creategedfor'] = "Stvori GEDCOM";
		$text['email'] = "Vaša e-pošte adresa";
		$text['suggestchange'] = "Predložite promjenu";
		$text['yourname'] = "Vaše ime i prezime";
		$text['comments'] = "Opis <br /> predloženih promjena";
		$text['comments2'] = "Komentar";
		$text['submitsugg'] = "Pošaljite prijedlog";
		$text['proposed'] = "Predložena promjena";
		$text['mailsent'] = "Hvala vam. Vaša poruka je poslana.";
		$text['mailnotsent'] = "Žao nam je, ali vašu poruku nismo mogli dostaviti. Molimo kontaktirajte xxx izravno na yyy.";
		$text['mailme'] = "Pošalji kopiju na ovu adresu";
		$text['entername'] = "Molin unesite svoje ime";
		$text['entercomments'] = "Unesite svoje komentare";
		$text['sendmsg'] = "Pošalji Poruku";
		//added in 9.0.0
		$text['subject'] = "Predmet";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografije i historija za";
		$text['indinfofor'] = "Informacije osobe za";
		$text['pp'] = "str."; //page abbreviation
		$text['age'] = "Starost:";
		$text['agency'] = "Agencija";
		$text['cause'] = "Uzrok";
		$text['suggested'] = "Predloženo";
		$text['closewindow'] = "Zatvori ovaj prozor";
		$text['thanks'] = "Hvala vam";
		$text['received'] = "Vaša sugestija je prosleđena administratoru na pregled.";
		$text['indreport'] = "Izvješće o osobi";
		$text['indreportfor'] = "Osobe izvješće za";
		$text['bkmkvis'] = "<strong>NAPOMENA:</strong> Te su oznake vidljive samo na ovom računalu i u ovom pregledniku.";
        //added in 9.0.0
		$text['reviewmsg'] = "Imate preporučenu promjenu koja vam treba recenziju. Ovaj se podnesak odnosi na:";
        $text['revsubject'] = "Predložena promjena treba vaš pregled";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Kalkulator odnosa";
		$text['findrel'] = "Pronađite vezu";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "Izračunaj";
		$text['select2inds'] = "Odaberite dvije osobe.";
		$text['findpersonid'] = "Pronađi osobe ID";
		$text['enternamepart'] = "Upišite dio imena i / ili prezimena";
		$text['pleasenamepart'] = "Upišite dio imena ili prezimena.";
		$text['clicktoselect'] = "kliknite za odabir";
		$text['nobirthinfo'] = "Nema informacija rođenja";
		$text['relateto'] = "Odnos prema";
		$text['sameperson'] = "Dvije osobe su ista osoba.";
		$text['notrelated'] = "Dvije jedinke nisu u srodstvu unutar xxx generacija."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Za prikaz odnosa između dvije osobe, pomoću gumba 'Traži' dolje pronađite pojedince (ili zadržite ljude prikazanim), a zatim kliknite 'Izračunaj'.";
		$text['sometimes'] = "(Ponekad provjera različitog broja generacija daje drugačiji rezultat.)";
		$text['findanother'] = "Pronađite drugu vezu";
		$text['brother'] = "brat od";
		$text['sister'] = "sestra od";
		$text['sibling'] = "brat i sestra od";
		$text['uncle'] = "xxx stric od";
		$text['aunt'] = "xxx tetka od";
		$text['uncleaunt'] = "xxx stric/tetka od";
		$text['nephew'] = "xxx nećak od";
		$text['niece'] = "xxx nećakinja od";
		$text['nephnc'] = "xxx nećak/nećakinja od";
		$text['removed'] = "puta uklonjen";
		$text['rhusband'] = "muž od";
		$text['rwife'] = "suproga od";
		$text['rspouse'] = "supružnika od";
		$text['son'] = "sin od";
		$text['daughter'] = "kći od";
		$text['rchild'] = "djete od";
		$text['sil'] = "zet od";
		$text['dil'] = "snaha od";
		$text['sdil'] = "zet ili snaha od";
		$text['gson'] = "xxx unuk od";
		$text['gdau'] = "xxx unuka od";
		$text['gsondau'] = "xxx unuk/unuka od";
		$text['great'] = "veliki";
		$text['spouses'] = "su supružnici";
		$text['is'] = "je";
		$text['changeto'] = "Promijenite na (unesite ID):";
		$text['notvalid'] = "nije važeći ID broj osobe ili ne postoji u ovoj bazi podataka. Molim pokušaj ponovno.";
		$text['halfbrother'] = "polubrat od";
		$text['halfsister'] = "polusestra od";
		$text['halfsibling'] = "polubrat/sestra od";
		//changed in 8.0.0
		$text['gencheck'] = "Maksimalni broj generacija za provjeru";
		$text['mcousin'] = "xxx rođak od yyy";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx rođakinja od yyy";  //female cousin
		$text['cousin'] = "xxx rođak od yyy";
		$text['mhalfcousin'] = "xxx pol rođak od yyy";  //male cousin
		$text['fhalfcousin'] = "xxx pol rođakinja od yyy";  //female cousin
		$text['halfcousin'] = "xxx pol rođak od yyy";
		//added in 8.0.0
		$text['oneremoved'] = "jednom uklonjen";
		$text['gfath'] = "xxx djed od";
		$text['gmoth'] = "xxx baka od";
		$text['gpar'] = "xxx djed/baka od";
		$text['mothof'] = "majka od";
		$text['fathof'] = "otac od";
		$text['parof'] = "roditelj od";
		$text['maxrels'] = "Maksimalni odnosi koji se pokazuju";
		$text['dospouses'] = "Pokažite odnose koji uključuju supružnika";
		$text['rels'] = "Odnosi";
		$text['dospouses2'] = "Prikaži supružnike";
		$text['fil'] = "svekar od";
		$text['mil'] = "svekrva od";
		$text['fmil'] = "svekar ili svekrva od";
		$text['stepson'] = "pastor od";
		$text['stepdau'] = "pastorka od";
		$text['stepchild'] = "pastorče od";
		$text['stepgson'] = "xxx očuh od";
		$text['stepgdau'] = "xxx očuha od";
		$text['stepgchild'] = "xxx očuh/očuha od";
		//added in 8.1.1
		$text['ggreat'] = "veliki";
		//added in 8.1.2
		$text['ggfath'] = "xxx pradjed od";
		$text['ggmoth'] = "xxx prababa od";
		$text['ggpar'] = "xxx pradjed/prababa od";
		$text['ggson'] = "xxx pra unuk od";
		$text['ggdau'] = "xxx pra unuka od";
		$text['ggsondau'] = "xxx pra unuk/unuka od";
		$text['gstepgson'] = "xxx pra očuh od";
		$text['gstepgdau'] = "xxx pra očuha od";
		$text['gstepgchild'] = "xxx pra očuh/očuha od";
		$text['guncle'] = "xxx pra ujak od";
		$text['gaunt'] = "xxx pra tetka od";
		$text['guncleaunt'] = "xxx pra ujak/tetka od";
		$text['gnephew'] = "xxx pra nećak od";
		$text['gniece'] = "xxx pra nećakinja od";
		$text['gnephnc'] = "xxx pra nećak/nećakinja od";
		//added in 14.0
		$text['pathscalc'] = "Potražite veze";
		$text['findrel2'] = "Pronađite odnose i druge veze";
		$text['makeme2nd'] = "Koristi moj ID";
		$text['usebookmarks'] = "Koristi oznake";
		$text['select2inds'] = "Odaberite dvije osobe.";
		$text['indinfofor'] = "Individualne informacije za";
		$text['nobookmarks'] = "Nema oznake za korištenje";
		$text['bkmtitle'] = "Osobe pronađene u oznakama";
		$text['bkminfo'] = "Odaberite osobu:";
		$text['sortpathsby'] = "Razvrstaj put po broju";
		$text['sortbyshort'] = "Poredaj po";
		$text['bylengthshort'] = "Duljina";
		$text['badID1'] = ": loše osobe1 ID - vratite se i ispravite";
		$text['badID2'] = ": loše osobe2 ID - vratite se i ispravite";
		$text['notintree'] = ": osoba s ovim ID-om nije u trenutnoj bazi podataka stabla.";
		$text['sameperson'] = "Dvije osobe su ista osoba.";;
		$text['nopaths'] = "Ove osobe nisu povezane.";
		$text['nopaths1'] = "Nema više veza kraćih od xxx";
		$text['nopaths2'] = "u xxx pretraživanja korak";
		$text['longestpath'] = "(najduži do sada provjereni put bio je xxx koraka dugo)";
		$text['relevantpaths'] = "Broj pronađenih različitih relevantnih putova: xxx";
		$text['skipMarr'] = "(osim toga, broj putova koji su pronađeni ali nisu prikazani zbog previše brakova bio je: xxx)";
		$text['mjaor'] = "ili";
		$text['connectionsto'] = "Veze s ";
		$text['findanotherpers'] = "Nađi drugu osobu...";
		$text['sometimes'] = "(Ponekad provjera različitog broja generacija daje drugačiji rezultat.)";
		$text['anotherpath'] = "Potražite druge veze";
		$text['xpath'] = "Put ";
		$text['primary'] = "Početna Osoba"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Krajnja Osoba";
		$text['parent'] = "Roditelj";
		$text['mhfather'] = "njegov otac";
		$text['mhmother'] = "njegova majka";
		$text['mhhusband'] = "njegov suprug";
		$text['mhwife'] = "njegova supruga";
		$text['mhson'] = "njegov sin";
		$text['mhdaughter'] = "njegova kćer";
		$text['fhfather'] = "njezin otac";
		$text['fhmother'] = "njezina majka";
		$text['fhhusband'] = "njezin suprug";
		$text['fhwife'] = "njezina supruga";
		$text['fhson'] = "njezin sin";
		$text['fhdaughter'] = "njezina kći";
		$text['hfather'] = "otac";
		$text['hmother'] = "majka";
		$text['hhusband'] = "suprug";
		$text['hwife'] = "supruga";
		$text['hson'] = "sin";
		$text['hdaughter'] = "kći";
		$text['maxruns'] = "Maksimalni broj puta koje treba provjeriti";
		$text['maxrshort'] = "Maksimalni putova";
		$text['maxlength'] = "Putovi veze ne dulji od";
		$text['maxlshort'] = "Maksimalna dužina";
		$text['xstep'] = "korak";
		$text['xsteps'] = "korakova";
		$text['xmarriages'] = "xxx brakova";
		$text['xmarriage'] = "1 brak";
		$text['showspouses'] = "Pokažite oba supružnika";
		$text['showTxt'] = "Prikaži tekstualni opis puta";
		$text['showTxtshort'] = "Tekstualni opis.";
		$text['compactBox'] = "Prikaži zbijene okvire osoba";
		$text['compactBoxshort'] = "Kompaktne kutije";
		$text['paths'] = "Put";
		$text['dospouses2'] = "Prikaži supružnike";
		$text['maxmopt'] = "Maksimalan broj brakova po vezi"; 
		$text['maxm'] = "Maksimalni brakovi"; 
		$text['arerelated'] = "Ove osobe su rođaci - njihov odnos prikazan je u Putu 1";
		$text['simplerel'] = "Jednostavna pretraga odnosa"; 
		break;

	case "familygroup":
		$text['familygroupfor'] = "Obiteljski list za";
		$text['ldsords'] = "Pravilnici o LDS";
		$text['baptizedlds'] = "Kršten (LDS)";
		$text['endowedlds'] = "Obdaren (LDS)";
		$text['sealedplds'] = "Zapečaćeno za roditeljima (LDS)";
		$text['sealedslds'] = "Zapečaćen za supružnika (LDS)";
		$text['otherspouse'] = "Drugi supružnik";
		$text['husband'] = "Otac";
		$text['wife'] = "Majka";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "R.";
		$text['capaltbirthabbr'] = "R.";
		$text['capdeathabbr'] = "U.";
		$text['capburialabbr'] = "P.";
		$text['capplaceabbr'] = "M.";
		$text['capmarrabbr'] = "V.";
		$text['capspouseabbr'] = "P.";
		$text['redraw'] = "Ponovo crtaj sa";
		$text['unknownlit'] = "Nepoznat";
		$text['popupnote1'] = "= Dodatne informacije";
		$text['pedcompact'] = "Kompaktni";
		$text['pedstandard'] = "Standard";
		$text['pedtextonly'] = "Tekst";
		$text['descendfor'] = "Potomci za";
		$text['maxof'] = "Maksimalno od";
		$text['gensatonce'] = "generacije prikazane u jednom trenutku.";
		$text['sonof'] = "sin od";
		$text['daughterof'] = "kći od";
		$text['childof'] = "djete od";
		$text['stdformat'] = "Standardni format";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Dodajte novu obitelj";
		$text['editfam'] = "Uredi obitelj";
		$text['side'] = "Krilo";
		$text['familyof'] = "Obitelj od";
		$text['paternal'] = "Očev";
		$text['maternal'] = "Majčin";
		$text['gen1'] = "Sam";
		$text['gen2'] = "Roditelj";
		$text['gen3'] = "Djed i baka";
		$text['gen4'] = "Pradjed i baka";
		$text['gen5'] = "Šukun djed i baka";
		$text['gen6'] = "3x Pra djed i baka";
		$text['gen7'] = "4x Pra djed i baka";
		$text['gen8'] = "5x Pra djed i baka";
		$text['gen9'] = "6x Pra djed i baka";
		$text['gen10'] = "7x Pra djed i baka";
		$text['gen11'] = "8x Pra djed i baka";
		$text['gen12'] = "9x Pra djed i baka";
		$text['graphdesc'] = "Tabela silaznosti do ove točke";
		$text['pedbox'] = "Kutija";
		$text['regformat'] = "Registar";
		$text['extrasexpl'] = "= Za ovu osobu postoji barem jedna fotografija, povijest ili drugi medijski predmet.";
		$text['popupnote3'] = " = Novi grafikon";
		$text['mediaavail'] = "Dostupni su mediji";
		$text['pedigreefor'] = "Pedigre karta za";
		$text['pedigreech'] = "Pedigre karta";
		$text['datesloc'] = "Datumi i Lokacije";
		$text['borchr'] = "Rođenje/Rođ - Umro/Pokop";
		$text['nobd'] = "Nema datuma Rođenja ili Pokop";
		$text['bcdb'] = "Svi podaci o Rođenju/Alt/Umro/Pokop";
		$text['numsys'] = "Sustav Numeriranja";
		$text['gennums'] = "Brojevi Generacije";
		$text['henrynums'] = "Henry Brojevi";
		$text['abovnums'] = "d'Aboville Brojevi";
		$text['devnums'] = "de Villiers Brojevi";
		$text['dispopts'] = "Postavke zaslona";
		//added in 10.0.0
		$text['no_ancestors'] = "Nema pronađenih predaka";
		$text['ancestor_chart'] = "Vertikalni grafikon predaka";
		$text['opennewwindow'] = "Otvori u novom prozoru";
		$text['pedvertical'] = "Vertikalno";
		//added in 11.0.0
		$text['familywith'] = "Porodica sa";
		$text['fcmlogin'] = "Prijavite se da biste videli detalje";
		$text['isthe'] = "je";
		$text['otherspouses'] = "drugi supružnici";
		$text['parentfamily'] = "Roditeljska porodica ";
		$text['showfamily'] = "Prikaz porodice";
		$text['shown'] = "pokazano";
		$text['showparentfamily'] = "prikaz roditeljske porodice";
		$text['showperson'] = "prikazi osobe";
		//added in 11.0.2
		$text['otherfamilies'] = "Druge porodice";
		//added in 14.0
		$text['dtformat'] = "Tablice";
		$text['dtchildren'] = "Djeca";
		$text['dtgrandchildren'] = "Unuci";
		$text['dtggrandchildren'] = "Pra pra unuci";
		$text['dtgggrandchildren'] = "Pra praunuci"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "1"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Nema potomaka";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Ukupno";
		$text['dtselect'] = "Odaberi";
		$text['dteachfulltable'] = "Svaka puna tablica imat će";
		$text['dtrows'] = "redaka";
		$text['dtdisplayingtable'] = "Prikaz tablice";
		$text['dtgototable'] = "Idi do tablice:";
		$text['fcinstrdn'] = "Pokažite obitelj sa supružnikom";
		$text['fcinstrup'] = "Pokažite obitelj s roditeljima";
		$text['fcinstrplus'] = "Odaberite druge supružnike";
		$text['fcinstrfam'] = "Odaberite druge roditelje";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Nema izvještaja.";
		$text['reportname'] = "Ime izveštaja";
		$text['allreports'] = "Svi izveštaji";
		$text['report'] = "Izveštaj";
		$text['error'] = "Greška";
		$text['reportsyntax'] = "Sintaksa upita pokreće se s ovim izvješćem";
		$text['wasincorrect'] = "nije bio točan i zbog toga se izvješće nije moglo pokrenuti. Molimo kontaktirajte administratora sustava na";
		$text['errormessage'] = "Poruka o pogrešci";
		$text['equals'] = "biti jednak";
		$text['endswith'] = "završava se sa";
		$text['soundexof'] = "zvući kao";
		$text['metaphoneof'] = "metafon od";
		$text['plusminus10'] = "+/- 10 godina od";
		$text['lessthan'] = "manje od";
		$text['greaterthan'] = "više od";
		$text['lessthanequal'] = "manje ili jednako";
		$text['greaterthanequal'] = "veće ili jednako";
		$text['equalto'] = "jednako";
		$text['tryagain'] = "Pokušajte ponovo";
		$text['joinwith'] = "Pridružite se";
		$text['cap_and'] = "I";
		$text['cap_or'] = "ILI";
		$text['showspouse'] = "Prikaži supružnika (pokazat će duplikate ako pojedinac ima više supružnika)";
		$text['submitquery'] = "Pošaljite upit";
		$text['birthplace'] = "Mjesto rođenja";
		$text['deathplace'] = "Mjesto smrti";
		$text['birthdatetr'] = "Godina rođenja";
		$text['deathdatetr'] = "Godina smrti";
		$text['plusminus2'] = "+/- 2 godine od";
		$text['resetall'] = "Poništite sve vrijednosti";
		$text['showdeath'] = "Pokažite podatke o smrti/pokopa";
		$text['altbirthplace'] = "Mjesto krštenja";
		$text['altbirthdatetr'] = "Godina krštenja";
		$text['burialplace'] = "Mjesto ukopa";
		$text['burialdatetr'] = "Godina ukopa";
		$text['event'] = "Događaj";
		$text['day'] = "Dan";
		$text['month'] = "Mjesec";
		$text['keyword'] = "Ključna riječ (tj. \"Abt\") ";
		$text['explain'] = "Unesite komponente datuma da biste vidjeli podudaranje događaja. Ostavite polje prazno da biste vidjeli utakmice za sve.";
		$text['enterdate'] = "Unesite ili odaberite barem jedno od sljedećeg: Dan, Mjesec, Godina, Ključna riječ";
		$text['fullname'] = "Puno ime i prezime";
		$text['birthdate'] = "Datum rođenja";
		$text['altbirthdate'] = "Datum krštenja";
		$text['marrdate'] = "Datum vjenčanja";
		$text['spouseid'] = "ID supružnika";
		$text['spousename'] = "Ime Supružnika";
		$text['deathdate'] = "Datum smrti";
		$text['burialdate'] = "Datum ukopa";
		$text['changedate'] = "Datum zadnje izmjene";
		$text['gedcom'] = "Porodično stablo";
		$text['baptdate'] = "Datum krštenja (LDS)";
		$text['baptplace'] = "Mjesto krštenja (LDS)";
		$text['endldate'] = "Datum Zadužbine (LDS)";
		$text['endlplace'] = "Mjesto Zadužbine (LDS)";
		$text['ssealdate'] = "Datum pečata S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Mjesto pečata S (LDS)";
		$text['psealdate'] = "Datum pečata P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Mjesto pečata P (LDS)";
		$text['marrplace'] = "Mjesto za vjenčanje";
		$text['spousesurname'] = "Prezime supružnika";
		$text['spousemore'] = "Ako unesete vrijednost za Prezime supružnika, morate odabrati spol.";
		$text['plusminus5'] = "+/- 5 godina od";
		$text['exists'] = "postoji";
		$text['dnexist'] = "ne postoji";
		$text['divdate'] = "Datum Razvoda";
		$text['divplace'] = "Mjesto Razvoda";
		$text['otherevents'] = "Ostali kriteriji za pretraživanje";
		$text['numresults'] = "Rezultati po stranici";
		$text['mysphoto'] = "Tajanstvene fotografije";
		$text['mysperson'] = "Nedostižni ljudi";
		$text['joinor'] = "Opcija 'Join with OR' ne može se koristiti s prezimenom supružnika";
		$text['tellus'] = "Recite nam šta znate";
		$text['moreinfo'] = "Više informacija:";
		//added in 8.0.0
		$text['marrdatetr'] = "Godina vjenčanja";
		$text['divdatetr'] = "Godina Razvode";
		$text['mothername'] = "Majčino Ime";
		$text['fathername'] = "Očevo Ime";
		$text['filter'] = "Filter";
		$text['notliving'] = "Ne živi";
		$text['nodayevents'] = "Događaji za ovaj mjesec koji nisu povezani s određenim danom:";
		//added in 9.0.0
		$text['csv'] = "CSV datoteka ograničena zarezom";
		//added in 10.0.0
		$text['confdate'] = "Datum potvrde (LDS)";
		$text['confplace'] = "Mjesto povrde (LDS)";
		$text['initdate'] = "Datum inicijative (LDS)";
		$text['initplace'] = "Mjesto inicijative (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Vrsta Braka";
		$text['searchfor'] = "Tragati za";
		$text['searchnote'] = "NAPOMENA: Ova stranica koristi Google za pretraživanje. Na broj vraćenih utakmica izravno će utjecati mjerilo u kojem je Google mogao indeksirati web mjesto.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Datoteka zapisnika";
		$text['mostrecentactions'] = "Najnovije akcije";
		$text['autorefresh'] = "Automatsko osvježavanje (30 sekundi)";
		$text['refreshoff'] = "Isključite automatsko osvježavanje";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Groblja i nadgrobni Spomenici";
		$text['showallhsr'] = "Pokaži sve zapise o Spomenicima";
		$text['in'] = "u";
		$text['showmap'] = "Pokaži mapu";
		$text['headstonefor'] = "Spomenik za";
		$text['photoof'] = "Fotografija od";
		$text['photoowner'] = "Vlasnik/Izvor";
		$text['nocemetery'] = "Nema groblja";
		$text['iptc005'] = "Naslov";
		$text['iptc020'] = "Kategorije potpore";
		$text['iptc040'] = "Posebne upute";
		$text['iptc055'] = "Datum stvaranja";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Pozicija Autora";
		$text['iptc090'] = "Grad";
		$text['iptc095'] = "Provincija";
		$text['iptc101'] = "Država";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Naslov";
		$text['iptc110'] = "Izvor";
		$text['iptc115'] = "Izvor Fotografije";
		$text['iptc116'] = "Obavijest o autorskim pravima";
		$text['iptc120'] = "Naslov";
		$text['iptc122'] = "Pisac Naslova";
		$text['mapof'] = "Karta od";
		$text['regphotos'] = "Opisni prikaz";
		$text['gallery'] = "Samo sličice";
		$text['cemphotos'] = "Fotografije Groblja";
		$text['photosize'] = "Dimenzije";
        $text['iptc010'] = "Prioritet";
		$text['filesize'] = "Veličina datoteke";
		$text['seeloc'] = "Vidi lokaciju";
		$text['showall'] = "Pokaži Sve";
		$text['editmedia'] = "Uredi Mediju";
		$text['viewitem'] = "Pogledaj ovaj stavku";
		$text['editcem'] = "Uredi Groblje";
		$text['numitems'] = "# Stavka";
		$text['allalbums'] = "Svi Albumi";
		$text['slidestop'] = "Pauza pokazati presentacije";
		$text['slideresume'] = "Nastavi pokazati presentacija";
		$text['slidesecs'] = "Sekunde za svaki slajd:";
		$text['minussecs'] = "minus 0.5 sekundi";
		$text['plussecs'] = "plus 0.5 sekundi";
		$text['nocountry'] = "Nepoznata država";
		$text['nostate'] = "Nepoznata provincija";
		$text['nocounty'] = "Nepoznata županja";
		$text['nocity'] = "Nepoznat grad";
		$text['nocemname'] = "Nepoznat naziv groblja";
		$text['editalbum'] = "Uredi Album";
		$text['mediamaptext'] = "<strong>NAPOMENA:</strong> Pomičite pokazivač miša preko slike da biste prikazali imena. Kliknite da biste vidjeli stranicu za svako ime.";
		//added in 8.0.0
		$text['allburials'] = "Sve sahrane";
		$text['moreinfo'] = "Kliknite za više informacija o ovoj slici";
		//added in 9.0.0
        $text['iptc025'] = "Ključne rječi";
        $text['iptc092'] = "Pod-lokacija";
		$text['iptc015'] = "Kategorija";
		$text['iptc065'] = "Izvorni Program";
		$text['iptc070'] = "Verzija Programa";
		//added in 13.0
		$text['toggletags'] = "Prebaci oznake";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Pokaži prezimena koja počinju sa";
		$text['showtop'] = "Prikaži vrh";
		$text['showallsurnames'] = "Prikaz sva prezimena";
		$text['sortedalpha'] = "razvrstano po abecedi";
		$text['byoccurrence'] = "poredani pojavom";
		$text['firstchars'] = "Početna slova";
		$text['mainsurnamepage'] = "Glavna stranica prezimena";
		$text['allsurnames'] = "Sva Prezimena";
		$text['showmatchingsurnames'] = "Kliknite na prezime za prikaz odgovarajućih zapisa.";
		$text['backtotop'] = "Povratak na vrh";
		$text['beginswith'] = "Koja počinju sa";
		$text['allbeginningwith'] = "Sva prezimena koja počinju sa";
		$text['numoccurrences'] = "broj ukupnih lokaliteta u zagradama";
		$text['placesstarting'] = "Pokažite najveće lokalitete počevši od";
		$text['showmatchingplaces'] = "Kliknite mjesto za prikaz manjih lokaliteta. Kliknite ikonu za pretraživanje da biste prikazali odgovarajuće pojedince.";
		$text['totalnames'] = "ukupno osoba";
		$text['showallplaces'] = "Prikaži sve najveće lokalitete";
		$text['totalplaces'] = "ukupno mjesta";
		$text['mainplacepage'] = "Stranica glavnih mjesta";
		$text['allplaces'] = "Sva veća Mjesta";
		$text['placescont'] = "Prikaži sva mjesta koja sadrže";
		//changed in 8.0.0
		$text['top30'] = "Prvih xxx prezimena";
		$text['top30places'] = "Prvih xxx najveći lokaliteti";
		//added in 12.0.0
		$text['firstnamelist'] = "Popis imena";
		$text['firstnamesstarting'] = "Pokažite imena koja počinju sa";
		$text['showallfirstnames'] = "Prikaži sva imena";
		$text['mainfirstnamepage'] = "Glavna stranica prvog imena";
		$text['allfirstnames'] = "Sva Imena";
		$text['showmatchingfirstnames'] = "Kliknite na ime da biste prikazali odgovarajuće zapise.";
		$text['allfirstbegwith'] = "Sva imena koja počinju sa";
		$text['top30first'] = "Prvih xxx Imena";
		$text['allothers'] = "Svi drugi";
		$text['amongall'] = "(među svim imenima)";
		$text['justtop'] = "Samo prvih xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(u poslednjih xx dana)";

		$text['photo'] = "Fotografije";
		$text['history'] = "Povijest/Dokument";
		$text['husbid'] = "ID Oca";
		$text['husbname'] = "Ime Oca";
		$text['wifeid'] = "ID Majke";
		//added in 11.0.0
		$text['wifename'] = "Majkino Ime";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Obriši";
		$text['addperson'] = "Dodaj osobu";
		$text['nobirth'] = "Sljedeći pojedinac nema važeći datum rođenja i ne može ga se dodati.";
		$text['event'] = "Događaj(i)";
		$text['chartwidth'] = "Širina grafikona";
		$text['timelineinstr'] = "Dodaj osobe";
		$text['togglelines'] = "Prebaci linije";
		//changed in 9.0.0
		$text['noliving'] = "Sljedeći pojedinac označen je kao živi ili privatni i nije ga moguće dodati jer niste prijavljeni s odgovarajućim dozvolama";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Pretražavanje svih porodičnih stabala";
		$text['treename'] = "Naziv stablo";
		$text['owner'] = "Vlasnik";
		$text['address'] = "Adresa";
		$text['city'] = "Mjesto";
		$text['state'] = "Provincija";
		$text['zip'] = "Poštanski broj";
		$text['country'] = "Država";
		$text['email'] = "Vaša e-pošta";
		$text['phone'] = "Telefon";
		$text['username'] = "Korisničko ime";
		$text['password'] = "Lozinka";
		$text['loginfailed'] = "Prijava nije uspjela.";

		$text['regnewacct'] = "<strong>Registrirajte se za novi korisnički račun</strong>";
		$text['realname'] = "Vaše ime i prezime";
		$text['phone'] = "Telefon";
		$text['email'] = "Vaša e-pošta";
		$text['address'] = "Adresa";
		$text['acctcomments'] = "Bilješke ili komentari";
		$text['submit'] = "Pošalji";
		$text['leaveblank'] = "(ostavite prazno ako tražite novo stablo)";
		$text['required'] = "Obavezna polja";
		$text['enterpassword'] = "Molimo unesite lozinku.";
		$text['enterusername'] = "Unesite korisničko ime.";
		$text['failure'] = "Žao nam je, ali korisničko ime koje ste unijeli već se koristi. Upotrijebite gumb Natrag u pregledniku da biste se vratili na prethodnu stranicu i odabrali drugo korisničko ime.";
		$text['success'] = "Hvala vam. Primili smo vašu registraciju. Kontaktirat ćemo vas kada je vaš račun aktivan ili ako su potrebne dodatne informacije.";
		$text['emailsubject'] = "Novi zahtjev za registraciju korisnika TNG-a";
		$text['website'] = "Web mjesto";
		$text['nologin'] = "Nemate prijavu?";
		$text['loginsent'] = "Podaci o prijavi su poslani";
		$text['loginnotsent'] = "Podaci o prijavi nisu poslani";
		$text['enterrealname'] = "Unesite svoje pravo ime.";
		$text['rempass'] = "Ostanite prijavljeni na ovom računalu";
		$text['morestats'] = "Više statistike";
		$text['accmail'] = "<strong>NAPOMENA:</strong> Kako biste primali poštu od administratora web lokacije u vezi s vašim računom, provjerite ne blokirate poštu s ove domene.";
		$text['newpassword'] = "Nova Lozinka";
		$text['resetpass'] = "Vraćanje izvorne lozinke";
		$text['nousers'] = "Ovaj se obrazac ne može upotrijebiti dok ne postoji barem jedan korisnički zapis. Ako ste vlasnik web mjesta, idite na Administrator / Korisnici da biste stvorili administratorski račun.";
		$text['noregs'] = "Žao nam je, ali trenutno ne prihvaćamo nove registracije korisnika. Molimo <a href=\"suggest.php\"> kontaktirajte nas</a> izravno ako imate komentare ili pitanja u vezi bilo čega na ovoj web stranici.";
		$text['emailmsg'] = "Primili ste novi zahtjev za TNG korisnički račun. Prijavite se na svoje područje TNG Administrator i dodijelite odgovarajuća dopuštenja ovom novom računu.";
		$text['accactive'] = "Račun je aktiviran, ali korisnik neće imati posebna prava dok ih ne dodijelite.";
		$text['accinactive'] = "Idite na Administrator / Korisnici / Pregled da biste pristupili postavkama računa. Račun će ostati neaktivan sve dok ga barem jednom ne uredite i spremite.";
		$text['pwdagain'] = "Lozinka ponovo";
		$text['enterpassword2'] = "Molimo unesite lozinku ponovo.";
		$text['pwdsmatch'] = "Vaše lozinke se ne podudaraju. Unesite istu lozinku u svako polje.";
		$text['acksubject'] = "Hvala vam na registraciji"; //for a new user account
		$text['ackmessage'] = "Vaš zahtjev za korisnički račun je primljen. Vaš račun bit će neaktivan dok ga administrator web mjesta ne pregleda. Obavijestit ćete vas e-poštom kada je vaša prijava spremna za upotrebu.";
		//added in 12.0.0
		$text['switch'] = "Prekidač";
		//added in 14.0
		$text['newpassword2'] = "Opet nova lozinka";
		$text['resetsuccess'] = "USPJEH: Lozinka je poništena";
		$text['resetfail'] = "GREŠKA: Lozinka nije poništena";
		$text['failreason0'] = " (nepoznata greška baze podataka)";
		$text['failreason2'] = " (nemate dopuštenje promijeniti lozinku)";
		$text['failreason3'] = " (lozinke nisu odgovarale)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Pregledaj sve Grane stabla";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Količina";
		$text['totindividuals'] = "Ukupno osoba";
		$text['totmales'] = "Ukupno muški";
		$text['totfemales'] = "Ukupno ženski";
		$text['totunknown'] = "Ukupno nepoznati spol";
		$text['totliving'] = "Ukupno živih";
		$text['totfamilies'] = "Ukupno obitelji";
		$text['totuniquesn'] = "Ukupno jedinstvenih prezimena";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Ukupno izvora";
		$text['avglifespan'] = "Prosječni životni vijek";
		$text['earliestbirth'] = "Najranije rođenje";
		$text['longestlived'] = "Najduže živio";
		$text['days'] = "dana";
		$text['age'] = "Doba života";
		$text['agedisclaimer'] = "Izračuni vezani za dob temelje se na pojedincima s evidentiranim datumima rođenja <em> i </em> datumima smrti. Zbog postojanja nepotpunih datumskih polja (npr., datum smrti naveden samo kao \"1945 \" ili \"BEF 1860 \"), ovi izračuni ne mogu biti 100% točni.";
		$text['treedetail'] = "Više informacija o ovom stablu";
		$text['total'] = "Ukupno";
		//added in 12.0
		$text['totdeceased'] = "Ukupno umrlih";
		//added in 14.0
		$text['totalsourcecitations'] = "Ukupni citati izvora";
		break;

	case "notes":
		$text['browseallnotes'] = "Pregledajte sve bilješke";
		break;

	case "help":
		$text['menuhelp'] = "Tipka izbornika";
		break;

	case "install":
		$text['perms'] = "Dozvola su sva postavljena.";
		$text['noperms'] = "Za te datoteke nije moguće postaviti dopuštenja:";
		$text['manual'] = "Postavite ih ručno.";
		$text['folder'] = "Mapa";
		$text['created'] = "stvoreno je";
		$text['nocreate'] = "nije se moglo stvoriti. Stvorite ga ručno.";
		$text['infosaved'] = "Podaci su sačuvani, veza je provjerena!";
		$text['tablescr'] = "Tabele su stvorene!";
		$text['notables'] = "Sljedeće tablice nije bilo moguće stvoriti:";
		$text['nocomm'] = "TNG ne komunicira s vašom bazom podataka. Nisu stvorene tablice.";
		$text['newdb'] = "Podaci su sačuvani, veza ovjerena, stvorena nova baza podataka:";
		$text['noattach'] = "Podaci su sačuvani. Uspostavljena je veza i stvorena baza podataka, ali TNG se na nju ne može priključiti.";
		$text['nodb'] = "Podaci su sačuvani. Veza je uspostavljena, ali baza podataka ne postoji i ne može se ovdje stvoriti. Provjerite je li naziv baze podataka točan i ima li korisnik baze podataka pravilan pristup, ili je za to stvorite na upravljačkoj ploči.";
		$text['noconn'] = "Podaci su sačuvani, ali veza nije uspjela. Jedno ili više sljedećeg nisu točni:";
		$text['exists'] = "već postoji.";
		$text['noop'] = "Nije izvršena nijedna operacija.";
		//added in 8.0.0
		$text['nouser'] = "Korisnik nije stvoren. Korisničko ime možda već postoji.";
		$text['notree'] = "Stablo nije stvoreno. ID stabla već može postojati.";
		$text['infosaved2'] = "Podaci su sačuvani";
		$text['renamedto'] = "preimenovan u";
		$text['norename'] = "nije moguće preimenovati";
		//changed in 13.0.0
		$text['loginfirst'] = "Otkriveni su postojeći korisnički zapisi. Da biste nastavili prvo se morate prijaviti ili ukloniti sve zapise iz korisničke tablice.";
		break;

	case "imgviewer":
		$text['magmode'] = "Uvećavanje";
		$text['panmode'] = "Panoramski Prikaz";
		$text['pan'] = "Kliknite i povucite za pomicanje unutar slike";
		$text['fitwidth'] = "Podesite širinu";
		$text['fitheight'] = "Podesite visina";
		$text['newwin'] = "Novi Prozor";
		$text['opennw'] = "Otvori sliku u novom prozoru";
		$text['magnifyreg'] = "Kliknite za povećanje regije na slici";
		$text['imgctrls'] = "Omogući kontrolu slike";
		$text['vwrctrls'] = "Omogućiti kontrolu pregledača slika";
		$text['vwrclose'] = "Zatvori preglednik slika";
		break;

	case "dna":
		$text['test_date'] = "Datum testa";
		$text['links'] = "Relevantne poveznice";
		$text['testid'] = "ID Testa";
		//added in 12.0.0
		$text['mode_values'] = "Vrednost načina";
		$text['compareselected'] = "Usporedite odabrano";
		$text['dnatestscompare'] = "Usporedite Y-DNA testove";
		$text['keep_name_private'] = "Neka ime ostane Privatno";
		$text['browsealltests'] = "Pregledajte sve testove";
		$text['all_dna_tests'] = "Svi DNA testovi";
		$text['fastmutating'] = "Brzo&nbsp;Mutira";
		$text['alltypes'] = "Svi Tipovi";
		$text['allgroups'] = "Sve Grupe";
		$text['Ydna_LITbox_info'] = "Test (e) povezane s ovom osobom nije nužno uzela ta osoba. <br /> Stupac 'Haplogroup' prikazuje podatke crvenom bojom ako je rezultat 'Predviđen' ili zelenom bojom ako je test 'Potvrđen'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Usporedite odabrane testove mtDNA";
		$text['dnatestscompare_atdna'] = "Usporedite odabrane testove atDNA";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "sekvenca";
		$text['extra_mutations'] = "Dodatne mutacije";
		$text['mrca'] = "MRC Predak";
		$text['ydna_test'] = "Y-DNA Testovi";
		$text['mtdna_test'] = "mtDNA (Mitochondrial) Testovi";
		$text['atdna_test'] = "atDNA (autosomal) Testovi";
		$text['segment_start'] = "Početak";
		$text['segment_end'] = "Kraj";
		$text['suggested_relationship'] = "Predložen";
		$text['actual_relationship'] = "Stvaran";
		$text['12markers'] = "Markeri 1-12";
		$text['25markers'] = "Markeri 13-25";
		$text['37markers'] = "Markeri 26-37";
		$text['67markers'] = "Markeri 38-67";
		$text['111markers'] = "Markeri 68-111";
		//added in 13.1
		$text['comparemore'] = "Za usporedbu moraju se odabrati najmanje dva testa";
		break;
}

//common
$text['matches'] = "Meč";
$text['description'] = "Opis";
$text['notes'] = "Bilješke";
$text['status'] = "Status";
$text['newsearch'] = "Nova Pretraga";
$text['pedigree'] = "Pedigre";
$text['seephoto'] = "Pogledajte fotografiju";
$text['andlocation'] = "&amp; mjesto";
$text['accessedby'] = "kojima pristupa";
$text['children'] = "Djeca";  //from getperson
$text['tree'] = "Stablo";
$text['alltrees'] = "Sva stabla";
$text['nosurname'] = "[nema prezimena]";
$text['thumb'] = "Sličica";  //as in Thumbnail
$text['people'] = "Narod";
$text['title'] = "Titula";  //from getperson
$text['suffix'] = "Sufiks";  //from getperson
$text['nickname'] = "Nadimak";  //from getperson
$text['lastmodified'] = "Zadnja promjena";  //from getperson
$text['married'] = "Vjenčanje";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Ime"; //from showmap
$text['lastfirst'] = "Prezime, Ime";  //from search
$text['bornchr'] = "Rođen/Kršten";  //from search
$text['individuals'] = "Pojedinci";  //from whats new
$text['families'] = "Obitelji";
$text['personid'] = "ID Osobe";
$text['sources'] = "Izvori";  //from getperson (next several)
$text['unknown'] = "Nepoznat";
$text['father'] = "Otac";
$text['mother'] = "Majka";
$text['christened'] = "Kršten";
$text['died'] = "Smrt";
$text['buried'] = "Pokopan";
$text['spouse'] = "Suprog";  //from search
$text['parents'] = "Roditelji";  //from pedigree
$text['text'] = "Tekst";  //from sources
$text['language'] = "Jezik";  //from languages
$text['descendchart'] = "Potomak";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Pojedinac";
$text['edit'] = "Uredi";
$text['date'] = "Datum";
$text['login'] = "Prijava";
$text['logout'] = "Odjava";
$text['groupsheet'] = "Grupni list";
$text['text_and'] = "i";
$text['generation'] = "Generacija";
$text['filename'] = "Ime Datoteke";
$text['id'] = "ID";
$text['search'] = "Traži";
$text['user'] = "Korisnik";
$text['firstname'] = "Ime";
$text['lastname'] = "Prezime";
$text['searchresults'] = "Rezultati pretraživanja";
$text['diedburied'] = "Umrp/Pokopan";
$text['homepage'] = "Početna Strana";
$text['find'] = "Traži...";
$text['relationship'] = "Srodstvo";		//in German, Verwandtschaft
$text['relationship2'] = "Srodstvo"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Vremenska linija";
$text['yesabbr'] = "Da";               //abbreviation for 'yes'
$text['divorced'] = "Rastavljen";
$text['indlinked'] = "Povezan sa";
$text['branch'] = "Grana";
$text['moreind'] = "Više osoba";
$text['morefam'] = "Više obitelji";
$text['surnamelist'] = "Popis prezimena";
$text['generations'] = "Generacija";
$text['refresh'] = "Osvježiti";
$text['whatsnew'] = "Novosti";
$text['reports'] = "Izveštaji";
$text['placelist'] = "Popis mjesta";
$text['baptizedlds'] = "Kršten (LDS)";
$text['endowedlds'] = "Obdaren (LDS)";
$text['sealedplds'] = "Zapečaćen P (LDS)";
$text['sealedslds'] = "Zapečaćen S (LDS)";
$text['ancestors'] = "Pretci";
$text['descendants'] = "Potomci";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum zadnjeg uvoza GEDCOM-a";
$text['type'] = "Tip";
$text['savechanges'] = "Sačuvaj";
$text['familyid'] = "Porodični ID";
$text['headstone'] = "Spomenik";
$text['historiesdocs'] = "Historije";
$text['anonymous'] = "anoniman";
$text['places'] = "Mjesta";
$text['anniversaries'] = "Datumi i godišnjice";
$text['administration'] = "Administracija";
$text['help'] = "Pomoć";
//$text['documents'] = "Documents";
$text['year'] = "Godina";
$text['all'] = "Sve";
$text['address'] = "Adresa";
$text['suggest'] = "Predložiti";
$text['editevent'] = "Predložite promjenu za ovaj događaj";
$text['morelinks'] = "Više veza";
$text['faminfo'] = "Obiteljske informacije";
$text['persinfo'] = "Osobne informacije";
$text['srcinfo'] = "Izvor informacija";
$text['fact'] = "Činjenica";
$text['goto'] = "Odaberite stranicu";
$text['tngprint'] = "Štampaj";
$text['databasestatistics'] = "Statistika"; //needed to be shorter to fit on menu
$text['child'] = "Dijete";  //from familygroup
$text['repoinfo'] = "Informacije o spremištu";
$text['tng_reset'] = "Ponovo postaviti";
$text['noresults'] = "Nema rezultata";
$text['allmedia'] = "Sve Medije";
$text['repositories'] = "Sigurno Spremište";
$text['albums'] = "Albumi";
$text['cemeteries'] = "Groblja";
$text['surnames'] = "Prezimena";
$text['dates'] = "Datumi";
$text['link'] = "Veza";
$text['media'] = "Medija";
$text['gender'] = "Pol";
$text['latitude'] = "Zemljopisna širina";
$text['longitude'] = "Zemljopisna dužina";
$text['bookmarks'] = "Bookmarks";
$text['bookmark'] = "Dodaj Bookmark";
$text['mngbookmarks'] = "Idi do Bookmarka";
$text['bookmarked'] = "Bookmark dodan";
$text['remove'] = "Ukloni";
$text['find_menu'] = "Traži";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Groblje";
$text['gmapevent'] = "Mapa Događaja";
$text['gevents'] = "Događaj";
$text['googleearthlink'] = "Veza za Google Earth";
$text['googlemaplink'] = "Veza za Google Maps";
$text['gmaplegend'] = "Oznake Legende";
$text['unmarked'] = "Ne obilježen";
$text['located'] = "Smješten";
$text['albclicksee'] = "Kliknite da biste vidjeli sve stavke u ovom albumu";
$text['notyetlocated'] = "Još se ne nalazi";
$text['cremated'] = "Kremiran";
$text['missing'] = "Nedostaje";
$text['pdfgen'] = "PDF Generator";
$text['blank'] = "Prazan Grafikon";
$text['fonts'] = "Fontovi";
$text['header'] = "Zaglavlje";
$text['data'] = "Podaci";
$text['pgsetup'] = "Podešavanje stranice";
$text['pgsize'] = "Veličina stranice";
$text['orient'] = "Orijentacija"; //for a page
$text['portrait'] = "Portret";
$text['landscape'] = "Pejzažna";
$text['tmargin'] = "Gornja marža";
$text['bmargin'] = "Goljnja marža";
$text['lmargin'] = "Ljeva marža";
$text['rmargin'] = "Desna marža";
$text['createch'] = "Stvorite Grafikon";
$text['prefix'] = "Prefiks";
$text['mostwanted'] = "Najtraženiji";
$text['latupdates'] = "Najnovija ažuriranja";
$text['featphoto'] = "Izdvojena fotografija";
$text['news'] = "Vjesti";
$text['ourhist'] = "Naš Obitelji Povijest";
$text['ourhistanc'] = "Naša obiteljska povijest i rodovina";
$text['ourpages'] = "Naše obiteljske rodoslovne stranice";
$text['pwrdby'] = "Ovu web lokaciju pokreće";
$text['writby'] = "napisao";
$text['searchtngnet'] = "Traži TNG Mrežu (GENDEX)";
$text['viewphotos'] = "Pogledaj sve fotografije";
$text['anon'] = "Trenutno ste anonimni";
$text['whichbranch'] = "Kojoj grani pripadaš?";
$text['featarts'] = "Članci o značajkama";
$text['maintby'] = "Održava";
$text['createdon'] = "Napravljeno na";
$text['reliability'] = "Pouzdanost";
$text['labels'] = "Oznake";
$text['inclsrcs'] = "Uključuju Izvore";
$text['cont'] = "(nastav.)"; //abbreviation for continued
$text['mnuheader'] = "Početna Strana";
$text['mnusearchfornames'] = "Potraži";
$text['mnulastname'] = "Prezime";
$text['mnufirstname'] = "Ime";
$text['mnusearch'] = "Traži";
$text['mnureset'] = "Početi ispočetka";
$text['mnulogon'] = "Prijaviti se";
$text['mnulogout'] = "Odjavite se";
$text['mnufeatures'] = "Druge značajke";
$text['mnuregister'] = "Registrirajte se za korisnički račun";
$text['mnuadvancedsearch'] = "Napredna pretraga";
$text['mnulastnames'] = "Prezimena";
$text['mnustatistics'] = "Statistika";
$text['mnuphotos'] = "Fotografije";
$text['mnuhistories'] = "Povijesti";
$text['mnumyancestors'] = "Fotografije &amp; Povijesti za Pretke od [Person]";
$text['mnucemeteries'] = "Groblja";
$text['mnutombstones'] = "Nadgrobni Spomenici";
$text['mnureports'] = "Izveštaji";
$text['mnusources'] = "Izvori";
$text['mnuwhatsnew'] = "Novosti";
$text['mnushowlog'] = "Dnevnik pristupa";
$text['mnulanguage'] = "Promijeni jezik";
$text['mnuadmin'] = "Administracija";
$text['welcome'] = "Dobrodošli";
$text['contactus'] = "Kontaktirajte nas";
//changed in 8.0.0
$text['born'] = "Rođen";
$text['searchnames'] = "Pretražite osobe";
//added in 8.0.0
$text['editperson'] = "Uredi osobu";
$text['loadmap'] = "Učitajte kartu";
$text['birth'] = "Rođen";
$text['wasborn'] = "rođen je";
$text['startnum'] = "Prvi Broj";
$text['searching'] = "Pretraživanje";
//moved here in 8.0.0
$text['location'] = "Mjesto";
$text['association'] = "Asocijacija";
$text['collapse'] = "Kolaps";
$text['expand'] = "Proširi";
$text['plot'] = "Crtaj";
$text['searchfams'] = "Potraži Obitelji";
//added in 8.0.2
$text['wasmarried'] = "Vjenčan";
$text['anddied'] = "Umro";
//added in 9.0.0
$text['share'] = "Djeli";
$text['hide'] = "Sakri";
$text['disabled'] = "Vaš korisnički nalog je isključen. Kontaktirajte administratora sajta za više informacija.";
$text['contactus_long'] = "Ako imate bilo kakvih pitanja ili komentara o podacima na ovoj stranici, molimo <span class = \"emphasis\"> <a href=\"suggest.php\"> kontaktirajte nas</a> </span>. Radujemo se što ćete se javiti nam.";
$text['features'] = "Značajke";
$text['resources'] = "Resursi";
$text['latestnews'] = "Najnovije Vjesti";
$text['trees'] = "Porodična stabla";
$text['wasburied'] = "pokopan je";
//moved here in 9.0.0
$text['emailagain'] = "e-poštu ponovi";
$text['enteremail2'] = "Ponovno unesite svoju adresu e-pošte.";
$text['emailsmatch'] = "Vaše se adrese e-pošte ne podudaraju. Unesite istu adresu e-pošte u svako polje.";
$text['getdirections'] = "Kliknite za upute";
$text['calendar'] = "Kalendar";
//changed in 9.0.0
$text['directionsto'] = " do ";
$text['slidestart'] = "Prezentacija slike";
$text['livingnote'] = "Barem jedan živi ili privatni pojedinac povezan je s ovom bilješkom - Zadržani su detalji.";
$text['livingphoto'] = "Najmanje jedan živi ili privatni pojedinac povezan je s ovom stavkom - Zadržani su detalji.";
$text['waschristened'] = "je Kršten";
//added in 10.0.0
$text['branches'] = "Grane";
$text['detail'] = "Detalj";
$text['moredetail'] = "Više detalja";
$text['lessdetail'] = "Manje detalja";
$text['conflds'] = "Potvrđen (LDS)";
$text['initlds'] = "Uvodni (LDS)";
$text['wascremated'] = "je kremiran";
//moved here in 11.0.0
$text['text_for'] = "za";
//added in 11.0.0
$text['searchsite'] = "Pretražite ove web stranice";
$text['searchsitemenu'] = "Pretraga sajta";
$text['kmlfile'] = "Preuzmite .kml datoteku da biste prikazali ovu lokaciju u Google Earth";
$text['download'] = "Kliknite za preuzimanje";
$text['more'] = "Više";
$text['heatmap'] = "Topline Mapa";
$text['refreshmap'] = "Osviježite Mapu";
$text['remnums'] = "Obrisati Brojeve i oznake";
$text['photoshistories'] = "Fotografije &amp; Povijesti";
$text['familychart'] = "Grafikon Obitelji";
//added in 12.0.0
$text['firstnames'] = "Imena";
//moved here in 12.0.0
$text['dna_test'] = "DNA Test";
$text['test_type'] = "Tip Testa";
$text['test_info'] = "Informacije o testu";
$text['takenby'] = "Test uzet od";
$text['haplogroup'] = "Haplogrupa";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Relevantne poveznice";
$text['nofirstname'] = "[bez imena]";
//added in 12.0.1
$text['cookieuse'] = "NAPOMENA: Ova web stranica koristi kolačiće.";
$text['dataprotect'] = "Zaštite Podataka";
$text['viewpolicy'] = "Pogledajte dokumenat";
$text['understand'] = "Razumijem";
$text['consent'] = "Dajem pristanak na ovom web mjestu za pohranjivanje ovdje prikupljenih osobnih podataka. Razumijem da mogu tražiti od vlasnika web lokacije da ukloni ove podatke u bilo kojem trenutku.";
$text['consentreq'] = "Molimo dajte svoj pristanak za ovu web stranicu za pohranu osobnih podataka.";

//added in 12.1.0
$text['testsarelinked'] = "DNA testovi su povezani sa";
$text['testislinked'] = "DNA test je povezan sa";

//added in 12.2
$text['quicklinks'] = "Brze veze";
$text['yourname'] = "Tvoje ime";
$text['youremail'] = "Tvoja e-pošta adresa";
$text['liketoadd'] = "Sve podatke koje želite dodati";
$text['webmastermsg'] = "Poruka za Webmastere";
$text['gallery'] = "Pogledaj Galeriju";
$text['wasborn_male'] = "je rođen";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "je rođena"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "je kršten";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "je krštena";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "je umro";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "je umrla";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "je pokopan"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "je pokopana"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "je kremiran";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "je kremirana";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "oženjen";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "udata";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "je razveden";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "je razvedena";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " na ";			// used as a preposition to the location
$text['onthisdate'] = " na ";		// when used with full date
$text['inthisyear'] = " u godini ";		// when used with year only or month / year dates
$text['and'] = "i ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Test Informacija";
//added in 13.0
$text['visitor'] = "Gost";

$text['popupnote2'] = "= Novi redovnik";

//moved here in 14.0
$text['zoomin'] = "Povećaj";
$text['zoomout'] = "Smanji";
$text['scrollnote'] = "Povucite ili pomičite se da biste vidjeli više grafikona.";
$text['general'] = "Općenito";

//changed in 14.0
$text['otherevents'] = "Ostali događaji i atributi";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Veze";
$text['continue'] = "Nastavi";
$text['title2'] = "Naslov"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>