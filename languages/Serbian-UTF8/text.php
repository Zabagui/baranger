<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Izvori informacija";
		$text['shorttitle'] = "Kratak naslov";
		$text['callnum'] = "Pozivni broj";
		$text['author'] = "AUTOR";
		$text['publisher'] = "Izdavač";
		$text['other'] = "Ostale informacije";
		$text['sourceid'] = "IZVOR ID";
		$text['moresrc'] = "Drugi izvori";
		$text['repoid'] = "ID Repozitorijuma";
		$text['browseallrepos'] = "Prikaži sve Repozitorijume";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Novi jezik";
		$text['changelanguage'] = "Promena jezika";
		$text['languagesaved'] = "Aktiviraj odabrani jezik";
		$text['sitemaint'] = "Održavanje sajta je u toku";
		$text['standby'] = "Sajt je privremeno nedostupan, vrši se ažuriranje baze podataka. Molim vas pokušajte malo kasnije da otvorite sajt. Ako sajt ostane ugašen duže vreme, molim vas <a href=\"suggest.php\">kontaktirajte vlasnika sajta</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM počinje od";
		$text['producegedfrom'] = "Napravi GEDCOM fajl u kome se nalaze";
		$text['numgens'] = "Broj generacija";
		$text['includelds'] = "Ukljući LDS informacije";
		$text['buildged'] = "Napravi GEDCOM";
		$text['gedstartfrom'] = "GEDCOM startuje od";
		$text['nomaxgen'] = "Morate da odredite maksimalan broj generacija. Vratite se na prethodnu stranu, koristeći dugme za nazad i ispravite grešku.";
		$text['gedcreatedfrom'] = "GEDCOM napravljen od";
		$text['gedcreatedfor'] = "napravljen za";
		$text['creategedfor'] = "Kreiranje GEDCOM fajlova";
		$text['email'] = "Vaša E-mail adresa";
		$text['suggestchange'] = "Predlog za izmenu ili dopunu podataka";
		$text['yourname'] = "Vaše ime i prezime";
		$text['comments'] = "Opis <br />predloženih izmena";
		$text['comments2'] = "Vaš komentar";
		$text['submitsugg'] = "Pošalji sugestiju";
		$text['proposed'] = "Predložena izmena";
		$text['mailsent'] = "Hvala vam. Vaša poruka je poslata.";
		$text['mailnotsent'] = "Žao nam je, ali vaša poruka nemože biti isporućena.";
		$text['mailme'] = "Pošalji kopiju i na ovu adresu";
		$text['entername'] = "Zaboravili ste da upišete vaše ime.";
		$text['entercomments'] = "Zaboravili ste da upišite vaš komentar";
		$text['sendmsg'] = "Pošalji Poruku";
		//added in 9.0.0
		$text['subject'] = "Naslov poruke";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografije i istorije za";
		$text['indinfofor'] = "Informacije osobe za";
		$text['pp'] = "str."; //page abbreviation
		$text['age'] = "GODINA I DANA";
		$text['agency'] = "Kumstvo";
		$text['cause'] = "Uzrok";
		$text['suggested'] = "Predloženo";
		$text['closewindow'] = "Zatvori prozor";
		$text['thanks'] = "Hvala";
		$text['received'] = "Vaša sugestija je prosleđena administratoru na pregled.";
		$text['indreport'] = "Izveštaj o osobi";
		$text['indreportfor'] = "Izveštaj osobe za";
		$text['bkmkvis'] = "<strong>Napomena:</strong> Ove omiljene stranice su vidljive samo na ovom računaru i na ovom web pretraživaču.";
        //added in 9.0.0
		$text['reviewmsg'] = "Imate predloženu primedbu, za koju je potrebno vaše mišljenje. Ovaj podnesak odnosi se na:";
        $text['revsubject'] = "Predložena sugestija treba vašu recenziju";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Kalkulator stepena srodstva";
		$text['findrel'] = "Pronađi Srodstvo";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "IZRAČUNAJ";
		$text['select2inds'] = "Izaberite dve osobe.";
		$text['findpersonid'] = "Pronađi ID osobe";
		$text['enternamepart'] = "Upišite deo imena i / ili prezimena";
		$text['pleasenamepart'] = "Upišite deo imena ili prezimena.";
		$text['clicktoselect'] = "kliknite mišem i odaberite";
		$text['nobirthinfo'] = "Nema informacija o rođenju";
		$text['relateto'] = "Srodstvo sa osobom po imenu -";
		$text['sameperson'] = "Dve osobe su ista osoba.";
		$text['notrelated'] = "Ove dve osobe nisu u srodstvu unazad xxx generacija."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Da bi ste videli stepen srodstva između dve osobe, koristite dugme 'TRAŽI' za pronalaženje osoba (ili zadržite već upisanu osobu), zatim pritisnite dugme 'IZRAČUNAJ'.";
		$text['sometimes'] = "(Ponekad provera različitog broja generacija daje drugačiji rezultat.)";
		$text['findanother'] = "Pronađi drugo srodstvo";
		$text['brother'] = "brat";
		$text['sister'] = "sestra";
		$text['sibling'] = "polubrat";
		$text['uncle'] = "xxx stric";
		$text['aunt'] = "xxx tetka";
		$text['uncleaunt'] = "xxx stric/tetka";
		$text['nephew'] = "xxx nećak/bratanac";
		$text['niece'] = "xxx sestričina/sinovica";
		$text['nephnc'] = "xxx nećak/sestričina";
		$text['removed'] = "puta uklonjena";
		$text['rhusband'] = "muž ";
		$text['rwife'] = "žena ";
		$text['rspouse'] = "supruga ";
		$text['son'] = "sin";
		$text['daughter'] = "ćerka";
		$text['rchild'] = "dete";
		$text['sil'] = "sin po zakonu";
		$text['dil'] = "ćerka po zakonu";
		$text['sdil'] = "sin ili ćerka po zakonu";
		$text['gson'] = "xxx unuk";
		$text['gdau'] = "xxx unuka";
		$text['gsondau'] = "xxx unuk/unuka";
		$text['great'] = "veliki";
		$text['spouses'] = "su supružnici";
		$text['is'] = "je";
		$text['changeto'] = "Promeni u: (unesi ID):";
		$text['notvalid'] = "nije važeći ID broj Osobe ili broj ne postoji u bazi. Pokušajte ponovo.";
		$text['halfbrother'] = "polubrat";
		$text['halfsister'] = "polusestra";
		$text['halfsibling'] = "polubrat po zakonu";
		//changed in 8.0.0
		$text['gencheck'] = "Maksimalni broj generacija za proveru";
		$text['mcousin'] = "xxx rođak od yyy";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx rođakinja od yyy";  //female cousin
		$text['cousin'] = "xxx rođak od yyy";
		$text['mhalfcousin'] = "xxx polusestra od yyy";  //male cousin
		$text['fhalfcousin'] = "xxx polubrat od yyy";  //female cousin
		$text['halfcousin'] = "xxx polurođak od yyy";
		//added in 8.0.0
		$text['oneremoved'] = "od strica";
		$text['gfath'] = "xxx deda od";
		$text['gmoth'] = "xxx baba od";
		$text['gpar'] = "xxx deda/baba od";
		$text['mothof'] = "majka od";
		$text['fathof'] = "otac od";
		$text['parof'] = "roditelj od";
		$text['maxrels'] = "Maksimalni broj veza za prikaz";
		$text['dospouses'] = "Prikaži veze gde su uključeni i supružici";
		$text['rels'] = "SRODSTVO";
		$text['dospouses2'] = "Prikaži supružnike";
		$text['fil'] = "otac po zakonu (očuh)";
		$text['mil'] = "majka po zakonu (maćeha)";
		$text['fmil'] = "otac ili majka po zakonu (očuh/maćeha)";
		$text['stepson'] = "pastorak";
		$text['stepdau'] = "pastorka";
		$text['stepchild'] = "pastorče";
		$text['stepgson'] = "xxx usvojen-unuk";
		$text['stepgdau'] = "xxx usvojena-unuka";
		$text['stepgchild'] = "xxx usvojeni-unuci";
		//added in 8.1.1
		$text['ggreat'] = "pradeda";
		//added in 8.1.2
		$text['ggfath'] = "xxx pradeda od";
		$text['ggmoth'] = "xxx prababa od";
		$text['ggpar'] = "xxx pradeda/prababa od";
		$text['ggson'] = "xxx praunuk od";
		$text['ggdau'] = "xxx praunuka od";
		$text['ggsondau'] = "xxx praunuk/praunuka od";
		$text['gstepgson'] = "xxx usvojen-praunuk od";
		$text['gstepgdau'] = "xxx usvojena-praunuka od";
		$text['gstepgchild'] = "xxx usvojeno-praunuče od";
		$text['guncle'] = "xxx deda stric ";
		$text['gaunt'] = "xxx baba tetka od";
		$text['guncleaunt'] = "xxx deda stric/baba tetka od";
		$text['gnephew'] = "xxx pra nećak/bratanac od";
		$text['gniece'] = "xxx pra nećaka/bratanica od";
		$text['gnephnc'] = "xxx pra bratanac/bratanica od";
		//added in 14.0
		$text['pathscalc'] = "Potražite veze";
		$text['findrel2'] = "Pronađite srodstva i druge veze";
		$text['makeme2nd'] = "Koristi moj ID";
		$text['usebookmarks'] = "Koristite obeleživače/bookmarks";
		$text['select2inds'] = "Izaberite dve osobe.";
		$text['indinfofor'] = "Individualne informacije za";
		$text['nobookmarks'] = "Nema obeleživača/bookmark  za korišćenje";
		$text['bkmtitle'] = "Osobe pronađene u obeleživačima/bookmarks";
		$text['bkminfo'] = "Izaberite osobu:";
		$text['sortpathsby'] = "Sortiraj putanje po broju";
		$text['sortbyshort'] = "Sortiraj po";
		$text['bylengthshort'] = "Dužina";
		$text['badID1'] = ": ID loše osobe1 - vratite se i ispravite";
		$text['badID2'] = ": ID loše osobe2 - vratite se i ispravite";
		$text['notintree'] = ": osoba sa ovim ID-om nije u trenutnoj bazi podataka stabla.";
		$text['sameperson'] = "Dve osobe su ista osoba.";;
		$text['nopaths'] = "Ove osobe nisu povezane, nisu u srodstvu";
		$text['nopaths1'] = "Nema više veza kraćih od xxx";
		$text['nopaths2'] = "u xxx koracima pretrage";
		$text['longestpath'] = "(najduža do sada proverena putanja bila je duga xxx koraka)";
		$text['relevantpaths'] = "Broj pronađenih različitih relevantnih putanja: xxx";
		$text['skipMarr'] = "(pored toga, broj putanja pronađenih, ali nisu prikazani zbog prevelikog broja brakova bio je: xxx)";
		$text['mjaor'] = "ili";
		$text['connectionsto'] = "Veze za ";
		$text['findanotherpers'] = "Nađi drugu osobu...";
		$text['sometimes'] = "(Ponekad provera različitog broja generacija daje drugačiji rezultat.)";
		$text['anotherpath'] = "Potražite druge veze";
		$text['xpath'] = "Putanja ";
		$text['primary'] = "Početna osoba"; // note: used for both Start and End if text['fin'] not set
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
		$text['hdaughter'] = "ćerka";
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
		$text['familygroupfor'] = "Porodični list za - ";
		$text['ldsords'] = "LDS Uredbe (za mormonsku crkvu-nep.kod nas)";
		$text['baptizedlds'] = "Krštenje (LDS)";
		$text['endowedlds'] = "Obdaren (LDS)";
		$text['sealedplds'] = "Zapečaćen P (LDS)";
		$text['sealedslds'] = "Zapečaćen S (LDS)";
		$text['otherspouse'] = "DRUGI BRAKOVI";
		$text['husband'] = "Suprug";
		$text['wife'] = "Supruga";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "Rođ.";
		$text['capaltbirthabbr'] = "82A";
		$text['capdeathabbr'] = "Smr.";
		$text['capburialabbr'] = "Sahr.";
		$text['capplaceabbr'] = "85P";
		$text['capmarrabbr'] = "Ven.";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Iscrtava se";
		$text['unknownlit'] = "Nema podataka";
		$text['popupnote1'] = "= Dodatne informacije";
		$text['pedcompact'] = "ZBIJENO";
		$text['pedstandard'] = "STANDARDNO";
		$text['pedtextonly'] = "TEKST";
		$text['descendfor'] = "Potomci";
		$text['maxof'] = "Maksimalno";
		$text['gensatonce'] = "generacija prikazanih odjednom.";
		$text['sonof'] = "sin - roditelji";
		$text['daughterof'] = "kći - roditelji";
		$text['childof'] = "dete - roditelji";
		$text['stdformat'] = "STANDARDNI FORMAT";
		$text['ahnentafel'] = "PO GENERACIJAMA (PEDIGRE DIJ.)";
		$text['addnewfam'] = "Dodaj novu porodicu";
		$text['editfam'] = "Izmeni podatke o porodici";
		$text['side'] = "- Krilo";
		$text['familyof'] = "svih predaka koji vode do osobe sa imenom";
		$text['paternal'] = "Očevo";
		$text['maternal'] = "Majčino";
		$text['gen1'] = "Odabrana osoba";
		$text['gen2'] = "Roditelj";
		$text['gen3'] = "Deda i baba";
		$text['gen4'] = "Pradede i Prababe";
		$text['gen5'] = "Čukundede i čukunbabe";
		$text['gen6'] = "Navrdede i navrbabe";
		$text['gen7'] = "Kurđeli i Kurđele";
		$text['gen8'] = "Askurđeli i Askurđele";
		$text['gen9'] = "Kurđepi i Kurđepe";
		$text['gen10'] = "Kurlebali i Kurlebale";
		$text['gen11'] = "Sukurdovi i Sukurdove";
		$text['gen12'] = "Surdepači i Surdepače";
		$text['graphdesc'] = "Grafik do te tačke";
		$text['pedbox'] = "KARTICE";
		$text['regformat'] = "PO GENERACIJAMA";
		$text['extrasexpl'] = "Ako postoje fotografije, mediji ili neka druga dokumenta (istorije,...) za neku od osoba, odgovarajuća ikonica će se pojaviti pored tog imena.";
		$text['popupnote3'] = " = Novi grafikon";
		$text['mediaavail'] = "Dostupni mediji";
		$text['pedigreefor'] = "Graf Predaka (Pedigre) za";
		$text['pedigreech'] = "Graf Predaka (Pedigre)";
		$text['datesloc'] = "Datumi i Lokacije";
		$text['borchr'] = "Rođenje/Alternativno - Smrt/Sahrana (dva)";
		$text['nobd'] = "Nema datuma rođenja ili smrti";
		$text['bcdb'] = "Rođenje/Alt/Smrt/Sahrana (četiri)";
		$text['numsys'] = "Brojevni Sistem";
		$text['gennums'] = "Brojevi Generacije";
		$text['henrynums'] = "Henry Brojevi";
		$text['abovnums'] = "d'Aboville Brojevi";
		$text['devnums'] = "de Villiers Brojevi";
		$text['dispopts'] = "Prikaz Opcija";
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
		$text['showperson'] = "prikaz osobe";
		//added in 11.0.2
		$text['otherfamilies'] = "Druge porodice";
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
		$text['dteachfulltable'] = "Svaka puna tabela će imati";
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
		$text['soundexof'] = "zvući kao";
		$text['metaphoneof'] = "metafora od";
		$text['plusminus10'] = "+/- 10 godina od";
		$text['lessthan'] = "manje od";
		$text['greaterthan'] = "više od";
		$text['lessthanequal'] = "manje ili jedanko";
		$text['greaterthanequal'] = "veće ili jednako";
		$text['equalto'] = "jednako";
		$text['tryagain'] = "Pokušajte ponovo";
		$text['joinwith'] = "Odnos parametara";
		$text['cap_and'] = "I";
		$text['cap_or'] = "ILI";
		$text['showspouse'] = "Pokaži bračne partnere (će prikazati duplikate ako pojedinac ima više od jednog bračnog druga)";
		$text['submitquery'] = "Vaš upit";
		$text['birthplace'] = "Mesto rođenja";
		$text['deathplace'] = "Mesto smrti";
		$text['birthdatetr'] = "Godina rođenja";
		$text['deathdatetr'] = "Godina smrti";
		$text['plusminus2'] = "+/- 2 godine od";
		$text['resetall'] = "Resetuj sve vrednosti";
		$text['showdeath'] = "Prikaži informacije o smrti/sahrani";
		$text['altbirthplace'] = "Mesto krštenja";
		$text['altbirthdatetr'] = "Godina krštenja";
		$text['burialplace'] = "Mesto sahrane";
		$text['burialdatetr'] = "Godina sahrane";
		$text['event'] = "Događaj(i)";
		$text['day'] = "Dan";
		$text['month'] = "Mesec";
		$text['keyword'] = "Ključna reč (ie, \"Abt\")";
		$text['explain'] = "Unesite podatke o datumu da bi videli događaje koji odgovaraju zadatom kriterijumu. Ili ostavite prazno da bi videli sve odabrane događaje.";
		$text['enterdate'] = "Upišite ili odaberite minimum jednu od ovih informacija: dan, mesec, godina, ključna reč";
		$text['fullname'] = "Puno ime i prezime";
		$text['birthdate'] = "Datum rođenja";
		$text['altbirthdate'] = "Datum krštenja";
		$text['marrdate'] = "Datum sklapanja braka";
		$text['spouseid'] = "Bračni drug - ID";
		$text['spousename'] = "Ime bračnog druga";
		$text['deathdate'] = "Datum smrti";
		$text['burialdate'] = "Datum sahrane";
		$text['changedate'] = "Datum zadnje promene";
		$text['gedcom'] = "Porodično stablo";
		$text['baptdate'] = "Datum krštenja (LDS)";
		$text['baptplace'] = "Mesto krštenja (LDS)";
		$text['endldate'] = "Datum Zadužbine (LDS)";
		$text['endlplace'] = "Mesto Zadužbine (LDS)";
		$text['ssealdate'] = "Datum pečata S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Mesto pečata S (LDS)";
		$text['psealdate'] = "Datum pečata P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Mesto pečata P (LDS)";
		$text['marrplace'] = "Mesto sklapanja braka";
		$text['spousesurname'] = "Prezime bračnog druga";
		$text['spousemore'] = "Ako unesete prezime supružnika, morate uneti još jednu vrednost i za drugo polje.";
		$text['plusminus5'] = "+/- 5 years from";
		$text['exists'] = "postoji";
		$text['dnexist'] = "ne postoji";
		$text['divdate'] = "Datum Razvoda";
		$text['divplace'] = "Mesto Razvoda";
		$text['otherevents'] = "Drugi događaji";
		$text['numresults'] = "Rezultati po stranici";
		$text['mysphoto'] = "Zagonetne Fotografije";
		$text['mysperson'] = "Osobe koje se traže, za porodično stablo";
		$text['joinor'] = "Je 'Član sa ILI ' opcija ne može da se koristi sa prezimenom supružnika";
		$text['tellus'] = "Recite nam šta znate o njima";
		$text['moreinfo'] = "Više informacija:";
		//added in 8.0.0
		$text['marrdatetr'] = "Godina Braka";
		$text['divdatetr'] = "Godina Razvoda";
		$text['mothername'] = "Majčino Ime";
		$text['fathername'] = "Očevo Ime";
		$text['filter'] = "Filter";
		$text['notliving'] = "Nije u životu";
		$text['nodayevents'] = "Događaji za ovaj mesec, a koji nisu povezani sa određenim danoom:";
		//added in 9.0.0
		$text['csv'] = "Razdvojen zarezima CSV fajl";
		//added in 10.0.0
		$text['confdate'] = "Datum potvrde (LDS)";
		$text['confplace'] = "Mesto povrde (LDS)";
		$text['initdate'] = "Uvodni/Inicijatorni Datum (LDS)";
		$text['initplace'] = "Uvodno/Inicijatorno Mesto (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Tip Braka";
		$text['searchfor'] = "Traži";
		$text['searchnote'] = "Napomena: Ova stranica koristi Google za izvršavanje svojih pretraga. Broj odgovora će direktno uticati u kojoj meri Google je bio u stanju da indeksira sajt.";
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
		$text['cemeteriesheadstones'] = "Groblja i nadgrobni Spomenici";
		$text['showallhsr'] = "Pokaži sve zapise o Spomenicima";
		$text['in'] = "-";
		$text['showmap'] = "Pokaži mapu";
		$text['headstonefor'] = "Spomenik za";
		$text['photoof'] = "Fotografija - ";
		$text['photoowner'] = "AUTOR/IZVOR";
		$text['nocemetery'] = "Nema groblja";
		$text['iptc005'] = "225Naslov";
		$text['iptc020'] = "226Kategorije podrške";
		$text['iptc040'] = "227Posebna uputstva";
		$text['iptc055'] = "228Datum kreiranja";
		$text['iptc080'] = "229Autor";
		$text['iptc085'] = "230Pozicija Autora";
		$text['iptc090'] = "231Grad";
		$text['iptc095'] = "232Država/Pokrajna";
		$text['iptc101'] = "233Zemlja";
		$text['iptc103'] = "234OTR";
		$text['iptc105'] = "235Naslov";
		$text['iptc110'] = "236Izvor";
		$text['iptc115'] = "237Izvor Fotografije";
		$text['iptc116'] = "238Obaveštenje o autorskim pravima";
		$text['iptc120'] = "239Naslov";
		$text['iptc122'] = "240Pisac Naslova";
		$text['mapof'] = "241Mapa";
		$text['regphotos'] = "Lista sa detaljima";
		$text['gallery'] = "Samo sličice";
		$text['cemphotos'] = "Fotografije Groblja";
		$text['photosize'] = "Veličina";
        $text['iptc010'] = "Prioritet";
		$text['filesize'] = "Veličina Fajla";
		$text['seeloc'] = "Vidi Lokaciju";
		$text['showall'] = "Pokaži Sve";
		$text['editmedia'] = "Izmeni Medij";
		$text['viewitem'] = "Pogledaj ovu stavku";
		$text['editcem'] = "Izmemi Groblje";
		$text['numitems'] = "# Stavka";
		$text['allalbums'] = "Svi Albumi";
		$text['slidestop'] = "Pauziraj Foto slajd";
		$text['slideresume'] = "Nastavi Foto slajd";
		$text['slidesecs'] = "Sekunde za svaku fotografiju u slajdu:";
		$text['minussecs'] = "minus 0.5 sekundi";
		$text['plussecs'] = "plus 0.5 sekundi";
		$text['nocountry'] = "Nepoznata zamlja";
		$text['nostate'] = "Nepoznata država";
		$text['nocounty'] = "Nepoznat okrug";
		$text['nocity'] = "epoznat grad";
		$text['nocemname'] = "Nepoznat naziv groblja";
		$text['editalbum'] = "Izmeni Album";
		$text['mediamaptext'] = "<strong>Napomena:</strong> Pomerite pokazivač miša preko slike da biste videli imena osoba. Kliknite da biste videli stranicu osobe sa imenom.";
		//added in 8.0.0
		$text['allburials'] = "Sva Sahranjivanja";
		$text['moreinfo'] = "Kliknite mišem za više informacija o ovoj slici.";
		//added in 9.0.0
        $text['iptc025'] = "Ključne reči";
        $text['iptc092'] = "Pod-lokacija";
		$text['iptc015'] = "Kategorija";
		$text['iptc065'] = "Izvorni Program";
		$text['iptc070'] = "Verzija Programa";
		//added in 13.0
		$text['toggletags'] = "Toggle Tags";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Prikaz prezimena koja poćinju na";
		$text['showtop'] = "Prikaži prve";
		$text['showallsurnames'] = "Prikaz svih prezimena";
		$text['sortedalpha'] = "po abecedi";
		$text['byoccurrence'] = "po učestalosti";
		$text['firstchars'] = "Početna slova";
		$text['mainsurnamepage'] = "Početna strana sa prezimenima";
		$text['allsurnames'] = "Sva Prezimena";
		$text['showmatchingsurnames'] = "Kliknite na prezime da vidite osobe sa tim prezimenom.";
		$text['backtotop'] = "Povratak na početak";
		$text['beginswith'] = "Koja počinju sa";
		$text['allbeginningwith'] = "Sva prezimena koja počinju sa";
		$text['numoccurrences'] = "ukupan broj lokaliteta u zagradama";
		$text['placesstarting'] = "Prikaži najveća mesta/lokalitete ćije ime počinje sa";
		$text['showmatchingplaces'] = "Kliknite na ime mesta da vidite manje lokalitete. Kliknite na ikonu za pretragu ako želite da vidite ko je sve povezan sa tom osobom.";
		$text['totalnames'] = "ukupno osoba";
		$text['showallplaces'] = "Prikaži sva veća mesta/lokacije";
		$text['totalplaces'] = "ukupno mesta";
		$text['mainplacepage'] = "Glavna lista mesta";
		$text['allplaces'] = "Sva veća Mesta/Lokacije";
		$text['placescont'] = "Prikaži sva mesta koja u imenu sadrže";
		//changed in 8.0.0
		$text['top30'] = "Prvih xxx prezimena";
		$text['top30places'] = "Prvih xxx većih mesta/lokacija";
		//added in 12.0.0
		$text['firstnamelist'] = "Lista Imena";
		$text['firstnamesstarting'] = "Prikaži imena koja počinju sa";
		$text['showallfirstnames'] = "Prikaži sva imena";
		$text['mainfirstnamepage'] = "Glavna lista imena";
		$text['allfirstnames'] = "Sva Imena";
		$text['showmatchingfirstnames'] = "Kliknite na Ime da biste prikazali odgovarajuće zapise.";
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
		$text['history'] = "278Istorija/Dokument";
		$text['husbid'] = "ID Supruga";
		$text['husbname'] = "Ime i Prezime Supruga";
		$text['wifeid'] = "ID Supruge";
		//added in 11.0.0
		$text['wifename'] = "Ime i Prezime Supruge";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Obriši";
		$text['addperson'] = "Dodaj novu osobu";
		$text['nobirth'] = "Odabrana osoba nema korktan datum rođenja i ne može biti dodata.";
		$text['event'] = "Događaj(i)";
		$text['chartwidth'] = "Širina dijagrama";
		$text['timelineinstr'] = "Dodaj nove osobe unoseći njihov ID u donja polja:";
		$text['togglelines'] = "Priključene linije";
		//changed in 9.0.0
		$text['noliving'] = "Odabrana osoba je markirana kao živa i n može biti dodata jer vi nemate dovoljno prava, za tu aktivnost";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Pretražavanje svih porodičnih stabala";
		$text['treename'] = "Porodično stablo";
		$text['owner'] = "Vlasnik";
		$text['address'] = "Adresa";
		$text['city'] = "Mesto";
		$text['state'] = "Oblast/Provincija";
		$text['zip'] = "Poštanski broj";
		$text['country'] = "Država";
		$text['email'] = "Vaša registrovana E-mail adresa";
		$text['phone'] = "Telefon";
		$text['username'] = "Korisničko ime";
		$text['password'] = "Lozinka";
		$text['loginfailed'] = "Prijavljivanje nije uspelo.";

		$text['regnewacct'] = "<strong>Registrovanje novog korisničkog naloga</strong>";
		$text['realname'] = "Vaše puno ime i prezime";
		$text['phone'] = "Telefon";
		$text['email'] = "Vaša registrovana E-mail adresa";
		$text['address'] = "Adresa";
		$text['acctcomments'] = "Komentar";
		$text['submit'] = "Pošalji";
		$text['leaveblank'] = "(ostavite prezno ako želite novo porodično stablo)";
		$text['required'] = "Polja koja morate obavezno popuniti. <br><br> (NAPOMENA: Za UPIS LOZINKE, koristite najmanje 8 karaktera: bar jedno malo i veliko slovo i bar jedan broj), Hvala";
		$text['enterpassword'] = "Molim Vas upišite lozinku.";
		$text['enterusername'] = "Molim Vas upišite koriničko ime.";
		$text['failure'] = "Žao nam je, ali korisničko ime koje ste odabrali je već u upotrebi. Vratite se na prethodnu stranicu koristeći dugme za nazad i odaberite neko drugo korisničko ime.";
		$text['success'] = "Hvala. Dobili smo vaš zahtev za registraciju. Dobićete e-mail, ćim vaša registracija bude aktivirana ili u slučaju da su potrebne dodatne informacije. Posle toga možete se prijaviti na sajt.";
		$text['emailsubject'] = "Zahtev za registraciju novo korisnika";
		$text['website'] = "Web sajt";
		$text['nologin'] = "Niste registrovani na sajtu?";
		$text['loginsent'] = "319Informacije o prijavi su poslate";
		$text['loginnotsent'] = "Tražene informacije nisu poslate.";
		$text['enterrealname'] = "Molim Vas upišite vaše pravo, puno ime i prezime.";
		$text['rempass'] = "Aktiviraj stalnu prijavu na ovom vašem kompjuteru";
		$text['morestats'] = "Potpuna statistika";
		$text['accmail'] = "<strong>NAPOMENA:</strong> Da bi dobili e-mail poruku od administratora sajta o svom nalogu proverite da niste slučajno blokirali e-poštu za ovaj domen. Ovaj sajt je privatan sajt porodice Milićević. Svi podaci sakupljeni u ovom projektu podležu zakonu Republike Srbije  o zaštiti podataka o ličnosti Člana 6. Svako kopiranje podataka bez dozvole autora ovog sajta podleže istom zakonu i može dobiti sudski epolog.";
		$text['newpassword'] = "Nova Lozinka";
		$text['resetpass'] = "Resetuj lozinku";
		$text['nousers'] = "Ovaj obrazac se ne može koristiti, sve dok postoji bar jedan korisnički zapis. Ako ste vlasnik sajta, uđite kao Adiministrator da kreirate Administratorski nalog.";
		$text['noregs'] = "Žao nam je ali u ovom trenutku ne prihvatamo registraciju novih korisničkih naloga. Molim Vas <a href=\"suggest.php\">kontaktirajte nas</a> direktno, ako imate sugestije/komentare ili pitanja u vezi svega na ovom sajtu.";
		$text['emailmsg'] = "Primili ste novi zahtev za korisnički nalog sajta. Prijavite se na admin panel sajta i dodelite odgovarajuća prava za ovaj novi nalog. Ako odobrite ove registracije, molim vas obavestite podnosioca zahteva za odgovor na ovu poruku.";
		$text['accactive'] = "Korisnički nalog je sada aktiviran, ali korisnik neće imati specijalna prava dok se to ne potvrdi od strane administratora.";
		$text['accinactive'] = "Idite na Admin/Users/Review radi pristupu podešavanjima korisničkim nalozima. Korisnički nalog će ostati neaktivan dok se ne izmeni i snimi/sačuva zapis bar jednom.";
		$text['pwdagain'] = "Lozinka ponovo";
		$text['enterpassword2'] = "Unesite lozinku ponovo.";
		$text['pwdsmatch'] = "Lozinke se ne podudaraju. Unesite istu lozinku u svako polje. (NAPOMENA: Koristite najmanje 8 karaktera: bar jedno malo i veliko slovo i bar jedan broj)";
		$text['acksubject'] = "Hvala na registraciji"; //for a new user account
		$text['ackmessage'] = "Vaš zahtev za korisničkim nalogom je primljen. Vaš korisički nalog će biti NEAKTIVAN dok ne bude pregledan od strane administratora sajta. Bićete obavešteni putem e-maila kada vaš korisnički nalog bude spreman za upotrebu. Zbog drugih aktivnosti administratora, neki put može i duže trajati odgovor ali budite sigurni da ćete dobili e-mail";
		//added in 12.0.0
		$text['switch'] = "Prekidač";
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
		$text['browseallbranches'] = "Pregledaj sve Grane stabla";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "VELIČINA";
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
		$text['avglifespan'] = "Prosečan životni vek";
		$text['earliestbirth'] = "Najranije rođenje";
		$text['longestlived'] = "NAJDUŽE ŽIVELI";
		$text['days'] = "dana";
		$text['age'] = "GODINA I DANA";
		$text['agedisclaimer'] = "Izračunavanje godina je bazirano na podacima rođenja i smrti. Budući da postoje nepotpuni podaci kao što su pre \"1869\" ili oko \"1863\" ili iza \"1780\" ova izračunavanja ne mogu biti 100% tačna.";
		$text['treedetail'] = "345Više informacija o ovom drvetu";
		$text['total'] = "Ukupno";
		//added in 12.0
		$text['totdeceased'] = "Ukupno umrlih";
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
		$text['perms'] = "Prava su sva bila setovana.";
		$text['noperms'] = "Prava ne mogu da se podese za ove fajlove:";
		$text['manual'] = "Molim Vas postavite ih ručno.";
		$text['folder'] = "Folder";
		$text['created'] = "napravljeno je";
		$text['nocreate'] = "ne mogu da se kreiraju. Molim Vas kreirajte ih ručno.";
		$text['infosaved'] = "Informacije su sačuvane, konekcija potvrđena!";
		$text['tablescr'] = "Tabele su kreirane!";
		$text['notables'] = "Sledeće tabele nisu mogle biti kreirane:";
		$text['nocomm'] = "TNG ne komunicira sa vašom bazom podataka. Tabele nisu kreirane.";
		$text['newdb'] = "sačuvana informacija, verifikovana konekcija, stvorena nova baza podataka:";
		$text['noattach'] = "Informacije su sačuvane. Konekcija je uspostavljena i baza podataka je kreirana, ali TNG se ne može priključiti na nju.";
		$text['nodb'] = "Informacije su sačuvane. Veza je napravljena, ali baza podataka ne postoji i nije mogla biti kreirana ovde. Proverite da li je ime baze podataka tačno i da li korisnik baze podataka ima odgovarajući pristup, ili koristite kontrolni panel da biste ga kreirali.";
		$text['noconn'] = "Informacije su sačuvane, ali veza nije uspela. Jedno ili više od sledećih je pogrešno:";
		$text['exists'] = "već postoji.";
		$text['noop'] = "Nije izvršena nikakva operacija.";
		//added in 8.0.0
		$text['nouser'] = "Korisnik nije kreiran. Korisničko ime možda već postoji.";
		$text['notree'] = "Drvo nije kreirano. ID stabla možda već postoji.";
		$text['infosaved2'] = "Informacije su sačuvane";
		$text['renamedto'] = "preimenovan u";
		$text['norename'] = "nije moguće preimenovati";
		//changed in 13.0.0
		$text['loginfirst'] = "Prvo morate da se prijavite na sajt, a ukoliko nemate korisnički nalog morate se registrovati.";
		break;

	case "imgviewer":
		$text['magmode'] = "Prikaz Uveličavanja";
		$text['panmode'] = "Panoramski Prikaz";
		$text['pan'] = "Kliknite i povucite da biste se kretali unutar slike";
		$text['fitwidth'] = "Podesiva Širina";
		$text['fitheight'] = "Podesiva Visina";
		$text['newwin'] = "Novi Prozor";
		$text['opennw'] = "Otvori sliku u novom prozoru";
		$text['magnifyreg'] = "Kliknite da biste uvećali region slike";
		$text['imgctrls'] = "Omogući kontrole slike";
		$text['vwrctrls'] = "Omogućiti kontrole pregledača slika";
		$text['vwrclose'] = "Zatvorite pregledač slika";
		break;

	case "dna":
		$text['test_date'] = "Datum testa";
		$text['links'] = "Relevantni linkovi";
		$text['testid'] = "ID Testa";
		//added in 12.0.0
		$text['mode_values'] = "Vrednosti Moda";
		$text['compareselected'] = "Izaberi za upoređivanje";
		$text['dnatestscompare'] = "Upoređivanje Y-DNA Testove";
		$text['keep_name_private'] = "Zadrži Imena Privatno";
		$text['browsealltests'] = "Pregledati sve DNA Testove";
		$text['all_dna_tests'] = "Svi DNA Testovi";
		$text['fastmutating'] = "Brze&nbsp;Mutacije";
		$text['alltypes'] = "Svi Tipovi";
		$text['allgroups'] = "Sve Grupe";
		$text['Ydna_LITbox_info'] = "Testo(vi) koji su povezani sa ovom osobom nisu obavezno preuzeti od ove osobe.<br />'Haplogroupa' prikazuje podatke u crvenoj boji ako je rezultat 'Predviđen unapred' ili zelen ako je test 'Potvrđen'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Uporedite izabrane mtDNA Testove";
		$text['dnatestscompare_atdna'] = "Uporedite izabrane atDNA Testove";
		$text['chromosome'] = "Hrom";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "sekvenca";
		$text['extra_mutations'] = "Ekstra Mutacije";
		$text['mrca'] = "MRC Predak";
		$text['ydna_test'] = "Y-DNA Testovi";
		$text['mtdna_test'] = "mtDNA (Mitohondrijski) Testovi";
		$text['atdna_test'] = "atDNA (autozomni) Testovi";
		$text['segment_start'] = "Početak";
		$text['segment_end'] = "Kraj";
		$text['suggested_relationship'] = "Predloženo";
		$text['actual_relationship'] = "Aktuelno";
		$text['12markers'] = "Markeri 1-12";
		$text['25markers'] = "Markeri 13-25";
		$text['37markers'] = "Markeri 26-37";
		$text['67markers'] = "Markeri 38-67";
		$text['111markers'] = "Markeri 68-111";
		//added in 13.1
		$text['comparemore'] = "At least two tests must be selected to compare.";
		break;
}

//common
$text['matches'] = "Lista pronađenih, od";
$text['description'] = "OPIS";
$text['notes'] = "BELEŠKE";
$text['status'] = "354Status";
$text['newsearch'] = "Nova pretraga";
$text['pedigree'] = "Pretci";
$text['seephoto'] = "Vidi fotografiju";
$text['andlocation'] = "360&amp; lokacija";
$text['accessedby'] = "pristup sa ";
$text['children'] = "DECA";  //from getperson
$text['tree'] = "Porodično stablo";
$text['alltrees'] = "Sva porodična stabla";
$text['nosurname'] = "[nema prezime]";
$text['thumb'] = "Sličica";  //as in Thumbnail
$text['people'] = "POVEZANO SA";
$text['title'] = "NASLOV";  //from getperson
$text['suffix'] = "373Sufiks";  //from getperson
$text['nickname'] = "NADIMAK";  //from getperson
$text['lastmodified'] = "PROMENA";  //from getperson
$text['married'] = "VENČANjE";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "PREZIME I IME"; //from showmap
$text['lastfirst'] = "PREZIME, IME";  //from search
$text['bornchr'] = "ROÐENJE ILI KRŠTENJE";  //from search
$text['individuals'] = "Osobe";  //from whats new
$text['families'] = "Porodice";
$text['personid'] = "LIČNI ID";
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
$text['descendchart'] = "Opadajući";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "ODABRANA OSOBA";
$text['edit'] = "IZMENE";
$text['date'] = "Datum";
$text['login'] = "Prijavljivanje";
$text['logout'] = "ODJAVA";
$text['groupsheet'] = "Porodični list";
$text['text_and'] = "i";
$text['generation'] = "Generacija";
$text['filename'] = "IME FAJLA";
$text['id'] = "ID";
$text['search'] = "TRAŽI";
$text['user'] = "Korisnik";
$text['firstname'] = "Ime";
$text['lastname'] = "Prezime";
$text['searchresults'] = "Rezultat pretrage";
$text['diedburied'] = "SMRT/SAHRANA";
$text['homepage'] = "POČETNA STRANA";
$text['find'] = "Pronađi...";
$text['relationship'] = "SRODSTVO";		//in German, Verwandtschaft
$text['relationship2'] = "Srodstvo"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "VREMEPLOV";
$text['yesabbr'] = "Y";               //abbreviation for 'yes'
$text['divorced'] = "RAZVOD";
$text['indlinked'] = "POVEZANO SA";
$text['branch'] = "Grana";
$text['moreind'] = "Još osoba";
$text['morefam'] = "Još porodica/familija";
$text['surnamelist'] = "Prezimena";
$text['generations'] = "BROJ GENERACIJA";
$text['refresh'] = "PONOVI";
$text['whatsnew'] = "Šta ima novo";
$text['reports'] = "Izveštaji";
$text['placelist'] = "Lista svih mesta koja u svome imenu sadrže";
$text['baptizedlds'] = "Krštenje (LDS)";
$text['endowedlds'] = "Obdaren (LDS)";
$text['sealedplds'] = "Zapečaćen P (LDS)";
$text['sealedslds'] = "Zapečaćen S (LDS)";
$text['ancestors'] = "PRETCI";
$text['descendants'] = "POTOMCI";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum poslednjeg prijema GEDCOM podataka";
$text['type'] = "Type";
$text['savechanges'] = "Zapiši promene";
$text['familyid'] = "PORODIČNI ID";
$text['headstone'] = "SPOMENIK";
$text['historiesdocs'] = "Istorije";
$text['anonymous'] = "anoniman";
$text['places'] = "Mesta";
$text['anniversaries'] = "Datumi i godišnjice";
$text['administration'] = "Administracija";
$text['help'] = "POMOĆ";
//$text['documents'] = "Documents";
$text['year'] = "Godina";
$text['all'] = "SVE";
$text['address'] = "Adresa";
$text['suggest'] = "Sugestija";
$text['editevent'] = "Predlog za izmenu za ovaj događaj";
$text['morelinks'] = "Više linkova";
$text['faminfo'] = "PORODIČNE INFORMACIJE";
$text['persinfo'] = "LIČNE INFORMACIJE";
$text['srcinfo'] = "DETALJI I VEZE";
$text['fact'] = "Činjenica";
$text['goto'] = "Odaberi stranu";
$text['tngprint'] = "ŠTAMPAJ";
$text['databasestatistics'] = "Statistika baze podataka"; //needed to be shorter to fit on menu
$text['child'] = "Dete";  //from familygroup
$text['repoinfo'] = "9Informacije o Repozitorijumu";
$text['tng_reset'] = "Reset";
$text['noresults'] = "Za zadati kriterijum nije pronađen ni jedan događaj.";
$text['allmedia'] = "Svi Mediji";
$text['repositories'] = "Repozitorijumi";
$text['albums'] = "Albumi";
$text['cemeteries'] = "Groblja";
$text['surnames'] = "Prezimena";
$text['dates'] = "Datumi";
$text['link'] = "Link";
$text['media'] = "MEDIJI";
$text['gender'] = "Pol";
$text['latitude'] = "Latitude";
$text['longitude'] = "Longitude";
$text['bookmarks'] = "Bookmarks";
$text['bookmark'] = "Add Bookmark";
$text['mngbookmarks'] = "Go to Bookmarks";
$text['bookmarked'] = "Bookmark dodan";
$text['remove'] = "Obrisati";
$text['find_menu'] = "TRAŽI";
$text['info'] = "INFO"; //this needs to be a very short abbreviation
$text['cemetery'] = "GROBLJE";
$text['gmapevent'] = "MAPA DOGAĐAJA";
$text['gevents'] = "Događaj";
$text['googleearthlink'] = "Link ka Google Earth";
$text['googlemaplink'] = "Link ka Google Maps";
$text['gmaplegend'] = "Oznake Legende";
$text['unmarked'] = "212Ne obeležen";
$text['located'] = "Lokalizovan";
$text['albclicksee'] = "Kliknite da biste videli sve stavke u ovom albumu";
$text['notyetlocated'] = "Još uvek nije lociran";
$text['cremated'] = "Kremiran";
$text['missing'] = "Nedostaje";
$text['pdfgen'] = "PDF Generator";
$text['blank'] = "Prazan Grafikon";
$text['fonts'] = "Fontovi";
$text['header'] = "Zaglavlje";
$text['data'] = "Podaci";
$text['pgsetup'] = "Podešavanje stranice";
$text['pgsize'] = "Veličina stranice";
$text['orient'] = "Orijentacija stranice"; //for a page
$text['portrait'] = "Uspravna orijentacija";
$text['landscape'] = "Horizontalna orijentacija";
$text['tmargin'] = "Gornja Margina";
$text['bmargin'] = "Donja Margina";
$text['lmargin'] = "Leva Margina";
$text['rmargin'] = "Desna Margina";
$text['createch'] = "Kreiraj Grafikon";
$text['prefix'] = "Prefiks";
$text['mostwanted'] = "U potrazi za";
$text['latupdates'] = "Poslednje Izmene";
$text['featphoto'] = "Istaknute Fotografije";
$text['news'] = "Vesti";
$text['ourhist'] = "Naša porodična istorija";
$text['ourhistanc'] = "Naša porodična istorija i poreklo";
$text['ourpages'] = "Naša porodična geneaološka stranica";
$text['pwrdby'] = "Ovaj sajt pokreće";
$text['writby'] = "napisan od";
$text['searchtngnet'] = "Search TNG Network (GENDEX)";
$text['viewphotos'] = "Pogledaj sve fotografije";
$text['anon'] = "Trenutno ste anonimni";
$text['whichbranch'] = "Kojoj grani pripadaš?";
$text['featarts'] = "Glavni Članci";
$text['maintby'] = "Održavanje je";
$text['createdon'] = "Kreirano od";
$text['reliability'] = "Verodostojnost";
$text['labels'] = "Labele";
$text['inclsrcs'] = "Uključuju Izvore";
$text['cont'] = "(nastavi)"; //abbreviation for continued
$text['mnuheader'] = "POČETNA STRANA";
$text['mnusearchfornames'] = "Potraži osobu";
$text['mnulastname'] = "Prezime";
$text['mnufirstname'] = "Ime";
$text['mnusearch'] = "Traži";
$text['mnureset'] = "481Početi iznova";
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
$text['editperson'] = "Izmena Osobe";
$text['loadmap'] = "Učitaj Mapu";
$text['birth'] = "Rođenje";
$text['wasborn'] = "je rođen";
$text['startnum'] = "Prvi Broj";
$text['searching'] = "Pretraga";
//moved here in 8.0.0
$text['location'] = "Lokacija/Mesto";
$text['association'] = "Asocijacija";
$text['collapse'] = "Skupi";
$text['expand'] = "Otvori";
$text['plot'] = "Plot";
$text['searchfams'] = "Potraži Porodice";
//added in 8.0.2
$text['wasmarried'] = "VENČANjE";
$text['anddied'] = "SMRT";
//added in 9.0.0
$text['share'] = "Deli";
$text['hide'] = "Sakri";
$text['disabled'] = "Vaš korisnički nalog je isključen. Kontaktirajte administratora sajta za više informacija.";
$text['contactus_long'] = "Ukoliko imate neko pitanje ili sugestiju oko ovog sajta, slobodno <span class=\"emphasis\"><a href=\"suggest.php\">kontaktirajte nas</a></span>. Mi očekujemo vaše sugestije.";
$text['features'] = "Karakteristika sajta";
$text['resources'] = "Genealoški sajtovi";
$text['latestnews'] = "Najnovije Vesti";
$text['trees'] = "Porodična stabla";
$text['wasburied'] = "sahranjen";
//moved here in 9.0.0
$text['emailagain'] = "e-mail ponovo";
$text['enteremail2'] = "Unesite vašu e-mail adresu ponovo.";
$text['emailsmatch'] = "Vaše e-mail adrese se ne podudaraju. Unesite istu e-mail adresu u svako polje.";
$text['getdirections'] = "Kliknite da biste dobili uputstva";
$text['calendar'] = "Kalendar";
//changed in 9.0.0
$text['directionsto'] = " do ";
$text['slidestart'] = "Startuj foto slajd";
$text['livingnote'] = "Najmanje jedna živa osoba je povezana sa ovom beleškom - Detalji uskraćeni.";
$text['livingphoto'] = "Najmanje jedna živa osoba je povezana sa ovom fotografijom - Detalji uskraćeni.";
$text['waschristened'] = "KRŠTENJE";
//added in 10.0.0
$text['branches'] = "Porodične Grane";
$text['detail'] = "Detalj";
$text['moredetail'] = "Više detalja";
$text['lessdetail'] = "Manje detalja";
$text['conflds'] = "Potvrđen (LDS)";
$text['initlds'] = "Uvodni (LDS)";
$text['wascremated'] = "je kremiran/a";
//moved here in 11.0.0
$text['text_for'] = "za traženi pojam";
//added in 11.0.0
$text['searchsite'] = "Pretraživanje ovog sajta";
$text['searchsitemenu'] = "Pretraga sajta";
$text['kmlfile'] = "Preuzmite .kml fajl za prikaz ove lokacije u Google Earth";
$text['download'] = "Klikni za download";
$text['more'] = "Više";
$text['heatmap'] = "Toplotna Mapa";
$text['refreshmap'] = "Osveži Mapu";
$text['remnums'] = "Obrisati Brojeve i oznake na karti";
$text['photoshistories'] = "Fotografije &amp; Istorijski dokumenti ";
$text['familychart'] = "Grafikon Porodice";
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
$text['relevant_links'] = "Relevantni linkovi";
$text['nofirstname'] = "[bez imena]";
//added in 12.0.1
$text['cookieuse'] = "Napomena: Ovaj sajt koristi tzv. kolačiće.";
$text['dataprotect'] = "Politika zaštite podataka";
$text['viewpolicy'] = "Prikaži politiku zaštite podataka";
$text['understand'] = "Razumem";
$text['consent'] = "Dajem svoj pristanak da ovaj sajt čuva lične podatke koji su sakupljeni ovde. Razumem da mogu zatražiti od vlasnika veb lokacije da ukloni ove informacije u bilo koje vreme.";
$text['consentreq'] = "Molimo Vas da date svoj pristanak da ovaj sajt čuva lične podatke.";

//added in 12.1.0
$text['testsarelinked'] = "DNA testovi su povezani sa";
$text['testislinked'] = "DNA test je povezan sa";

//added in 12.2
$text['quicklinks'] = "Brzi Linkovi";
$text['yourname'] = "Tvoje ime";
$text['youremail'] = "Tvoja email adresa";
$text['liketoadd'] = "Bilo koju informaciju koju želite da dodate";
$text['webmastermsg'] = "Poruka Vebmastera";
$text['gallery'] = "Pogledajte Galeriju";
$text['wasborn_male'] = "je rođen";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "je rođena"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "kršten";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "krštena";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "umro";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "umrla";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "sahranjen"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "sahranjena"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "kremiran";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "kremirana";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "oženjen";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "udata";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "razveden";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "razvedena";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " na lokaciji";			// used as a preposition to the location
$text['onthisdate'] = " na ovaj datum ";		// when used with full date
$text['inthisyear'] = " za mesec/godinu ";		// when used with year only or month / year dates
$text['and'] = "i ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Test Info";
//added in 13.0
$text['visitor'] = "Visitor";

$text['popupnote2'] = "= Novi dijagram";

//moved here in 14.0
$text['zoomin'] = "Uveličaj";
$text['zoomout'] = "Smanji";
$text['scrollnote'] = "Ako ne vidite ceo dijagram pomerite sliku dole ili desno.";
$text['general'] = "Generalni";

//changed in 14.0
$text['otherevents'] = "Drugi događaji i atributi";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Veze";
$text['continue'] = "Nastavi";
$text['title2'] = "Naslov"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>