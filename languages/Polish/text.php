<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Przegl±daj wszystkie ¼ród³a";
		$text['shorttitle'] = "Krótki tytu³";
		$text['callnum'] = "Nr wywo³ania";
		$text['author'] = "Autor";
		$text['publisher'] = "Wydawca";
		$text['other'] = "Inne informacje";
		$text['sourceid'] = "ID ¼ród³a";
		$text['moresrc'] = "Wiêcej ¼róde³";
		$text['repoid'] = "ID repozytorium";
		$text['browseallrepos'] = "Przegl±daj wszystkie repozytoria";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nowy jêzyk";
		$text['changelanguage'] = "Zmiana jêzyka";
		$text['languagesaved'] = "Zapisz jêzyk";
		$text['sitemaint'] = "Strona jest w trakcie aktualizacji";
		$text['standby'] = "Z powodu aktualizacji bazy danych strona jest chwilowo niedostêpna. Proszê spróbowaæ za jaki¶ czas ponownie. Je¶li strona pozostanie przez d³u¿szy czas niedostêpna, prosimy zwróciæ siê do administratora <a href=\"suggest.php\"></a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM zaczynaj od";
		$text['producegedfrom'] = "Twórz plik gedcom z";
		$text['numgens'] = "Liczba generacji";
		$text['includelds'] = "£±cznie z informacjami LDS";
		$text['buildged'] = "Buduj GEDCOM";
		$text['gedstartfrom'] = "Zaczynaj GEDCOM od";
		$text['nomaxgen'] = "Musisz wskazaæ maksymaln± liczbê generacji. Proszê powróæ i popraw ten b³±d";
		$text['gedcreatedfrom'] = "Twórz GEDCOM z";
		$text['gedcreatedfor'] = "buduj dla";
		$text['creategedfor'] = "Twórz GEDCOM";
		$text['email'] = "Adres e-mail";
		$text['suggestchange'] = "Proponowane zmiany";
		$text['yourname'] = "Twoje nazwisko";
		$text['comments'] = "Uwagi i komentarze";
		$text['comments2'] = "Komentarze";
		$text['submitsugg'] = "Dodaj sugestiê";
		$text['proposed'] = "Propozycja zmian";
		$text['mailsent'] = "Dziekujemy, list wys³any.";
		$text['mailnotsent'] = "Przepraszamy, Twój list nie móg³ byc wys³any. Skontaktuj siê z xxx bezpo¶rednio na yyy.";
		$text['mailme'] = "Wy¶lij kopiê na ten adres";
		$text['entername'] = "Podaj swoje imiê";
		$text['entercomments'] = "Wpisz swoje uwagi";
		$text['sendmsg'] = "Wy¶lij";
		//added in 9.0.0
		$text['subject'] = "Temat";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Zdjêcia i historie dla";
		$text['indinfofor'] = "Informacja indywidualna dla";
		$text['pp'] = "skr."; //page abbreviation
		$text['age'] = "Wiek";
		$text['agency'] = "Urz±d";
		$text['cause'] = "Przyczyna";
		$text['suggested'] = "Sugerowane";
		$text['closewindow'] = "Zamknij to okno";
		$text['thanks'] = "Dziêkujemy";
		$text['received'] = "Twoja sugestia zostanie dostarczona do administratora tej strony.";
		$text['indreport'] = "Raport indywidualny";
		$text['indreportfor'] = "Raport indywidualny dla";
		$text['bkmkvis'] = "<strong>Uwaga:</strong> Te zak³adki bêd± widoczne tylko na tym komputerze i tylko w tej wyszukiwarce internetowej.";
        //added in 9.0.0
		$text['reviewmsg'] = "Masz propozycjê zmian, które potrzebuj± twojej opinii. Ten wniosek dotyczy:";
        $text['revsubject'] = "Proponowane zmiany potrzebuj± twojej opinii";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Kalkulator pokrewieñstwa";
		$text['findrel'] = "Znajd¼ pokrewieñstwo";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "Oblicz";
		$text['select2inds'] = "Wybierz dwie osoby.";
		$text['findpersonid'] = "Znajd¼ ID osoby";
		$text['enternamepart'] = "Wpisz czê¶æ imienia i/lub nazwiska";
		$text['pleasenamepart'] = "Podaj czê¶æ imienia lub nazwiska.";
		$text['clicktoselect'] = "Kliknij, aby wybraæ";
		$text['nobirthinfo'] = "Brak informacji o urodzeniu";
		$text['relateto'] = "Pokrewnieñstwo z";
		$text['sameperson'] = "Ta sama osoba wystêpuje dwa razy.";
		$text['notrelated'] = "Te dwie osoby nie s± spokrewnione w obrêbie xxx pokoleñ."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Dla ustalenia pokrewieñstwa dwóch osób naci¶nij 'Szukaj' aby zlokalizowaæ istniej±ce osoby a nastêpnie kliknij na 'Oblicz'.";
		$text['sometimes'] = "(Czasami sprawdzenie innej liczby pokoleñ daje inny rezultat.)";
		$text['findanother'] = "Szukaj innego pokrewieñstwa";
		$text['brother'] = "brata(em)";
		$text['sister'] = "siostr±";
		$text['sibling'] = "rodzeñstwem";
		$text['uncle'] = "xxx wujem";
		$text['aunt'] = "xxx ciotk±";
		$text['uncleaunt'] = "xxx wujem/ciotk±";
		$text['nephew'] = "xxx bratankiem/siostrzenic±";
		$text['niece'] = "xxx bratanic±/siostrzenic±";
		$text['nephnc'] = "xxx bratankiem,siostrzenic±/bratanic±,siostrzenic±";
		$text['removed'] = "m³odszym(±)";
		$text['rhusband'] = "mê¿em ";
		$text['rwife'] = "¿on± ";
		$text['rspouse'] = "partnerem";
		$text['son'] = "synem";
		$text['daughter'] = "córk±";
		$text['rchild'] = "dzieckiem";
		$text['sil'] = "ziêciem";
		$text['dil'] = "synow±";
		$text['sdil'] = "ziêciem lub synow±";
		$text['gson'] = "xxx wnukiem";
		$text['gdau'] = "xxx wnuczk±";
		$text['gsondau'] = "xxx wnukiem/wnuczk±";
		$text['great'] = "pra";
		$text['spouses'] = "s± ma³¿eñstwem";
		$text['is'] = "jest";
		$text['changeto'] = "Zmieñ na (podaj ID):";
		$text['notvalid'] = "jest to, albo niewa¿ne ID osoby,albo nie ma go w bazie danych. Spróbuj jeszcze raz.";
		$text['halfbrother'] = "przyrodni brat";
		$text['halfsister'] = "przyrodnia siostra";
		$text['halfsibling'] = "przyrodnie rodzeñstwo";
		//changed in 8.0.0
		$text['gencheck'] = "Maksymalna liczba pokoleñ<br />do sprawdzenia";
		$text['mcousin'] = "xxx kuzynem";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx kuzynk±";  //female cousin
		$text['cousin'] = "xxx kuzynem/kuzynk±";
		$text['mhalfcousin'] = "xxx przyrodnim kuzyn";  //male cousin
		$text['fhalfcousin'] = "xxx przyrodni± kuzynk±";  //female cousin
		$text['halfcousin'] = "xxx przyrodni kuzyn";
		//added in 8.0.0
		$text['oneremoved'] = "m³odszym/m³odsz±";
		$text['gfath'] = "xxx dziadek";
		$text['gmoth'] = "xxx babka";
		$text['gpar'] = "xxx dziadkowie";
		$text['mothof'] = "matka";
		$text['fathof'] = "ojciec";
		$text['parof'] = "rodzice";
		$text['maxrels'] = "Maksymalna ilo¶æ relacji do pokazania";
		$text['dospouses'] = "Wzajemna relacja, w³±czaj±c w to ma³¿onka";
		$text['rels'] = "Pokrewieñstwo";
		$text['dospouses2'] = "Poka¿ ma³¿onków";
		$text['fil'] = "te¶æ";
		$text['mil'] = "te¶ciowa";
		$text['fmil'] = "te¶æ lub te¶ciowa";
		$text['stepson'] = "pasierbem";
		$text['stepdau'] = "pasierbic±";
		$text['stepchild'] = "pasierb(ica)";
		$text['stepgson'] = "the xxx synem pasierba";
		$text['stepgdau'] = "the xxx córk± pasierba";
		$text['stepgchild'] = "the xxx dzieckiem pasierba";
		//added in 8.1.1
		$text['ggreat'] = "pra";
		//added in 8.1.2
		$text['ggfath'] = "xxx pradziadkiem";
		$text['ggmoth'] = "xxx prababk±";
		$text['ggpar'] = "xxx pra rodzicami";
		$text['ggson'] = "xxx prawnukiem";
		$text['ggdau'] = "xxx prawnuczk±";
		$text['ggsondau'] = "xxx prawnukami";
		$text['gstepgson'] = "xxx pra pasierbem";
		$text['gstepgdau'] = "xxx pra pasierbic±";
		$text['gstepgchild'] = "xxx pra pasierbem";
		$text['guncle'] = "xxx pra wujkiem";
		$text['gaunt'] = "xxx pra ciotk±";
		$text['guncleaunt'] = "xxx pra wujkiem/ciotk±";
		$text['gnephew'] = "xxx pra bratankiem/siostrzenic±";
		$text['gniece'] = "xxx pra bratanic±/siostrzenic±";
		$text['gnephnc'] = "xxx pra bratanic±/siostrzenic±";
		//added in 14.0
		$text['pathscalc'] = "Search for connections";
		$text['findrel2'] = "Znajd¼ pokrewieñstwo";
		$text['makeme2nd'] = "Use my ID";
		$text['usebookmarks'] = "Use bookmarks";
		$text['select2inds'] = "Wybierz dwie osoby.";
		$text['indinfofor'] = "Informacja indywidualna dla";
		$text['nobookmarks'] = "There is no bookmark to use";
		$text['bkmtitle'] = "Persons found in bookmarks";
		$text['bkminfo'] = "Select a person:";
		$text['sortpathsby'] = "Sort paths by number of";
		$text['sortbyshort'] = "Sort by";
		$text['bylengthshort'] = "Length";
		$text['badID1'] = ": bad person1 ID - please go back and correct";
		$text['badID2'] = ": bad person2 ID - please go back and correct";
		$text['notintree'] = ": the person with this ID is not in the current tree database.";
		$text['sameperson'] = "Ta sama osoba wystêpuje dwa razy.";;
		$text['nopaths'] = "These persons are not connected.";
		$text['nopaths1'] = "No more connections shorter than xxx";
		$text['nopaths2'] = "in xxx search steps";
		$text['longestpath'] = "(longest path checked so far was xxx steps long)";
		$text['relevantpaths'] = "The number of different relevant paths found: xxx";
		$text['skipMarr'] = "(in addition, the number of paths found but not displayed due to too many marriages was: xxx)";
		$text['mjaor'] = "or";
		$text['connectionsto'] = "Connections to ";
		$text['findanotherpers'] = "Find another person...";
		$text['sometimes'] = "(Czasami sprawdzenie innej liczby pokoleñ daje inny rezultat.)";
		$text['anotherpath'] = "Search for other connections";
		$text['xpath'] = "Path ";
		$text['primary'] = "Start Person"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "End Person";
		$text['parent'] = "Parent";
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
		$text['hfather'] = "father";
		$text['hmother'] = "mother";
		$text['hhusband'] = "husband";
		$text['hwife'] = "wife";
		$text['hson'] = "son";
		$text['hdaughter'] = "daughter";
		$text['maxruns'] = "Max number of paths to be checked";
		$text['maxrshort'] = "Max paths";
		$text['maxlength'] = "Connection paths no longer than";
		$text['maxlshort'] = "Max length";
		$text['xstep'] = "step";
		$text['xsteps'] = "steps";
		$text['xmarriages'] = "xxx marriages";
		$text['xmarriage'] = "1 marriage";
		$text['showspouses'] = "Show both spouses";
		$text['showTxt'] = "Show textual path description";
		$text['showTxtshort'] = "Textual desc.";
		$text['compactBox'] = "Show person boxes compacted";
		$text['compactBoxshort'] = "Compact boxes";
		$text['paths'] = "Paths";
		$text['dospouses2'] = "Poka¿ ma³¿onków";
		$text['maxmopt'] = "Max marriages per connection";
		$text['maxm'] = "Max marriages";
		$text['arerelated'] = "These persons are relatives - their relationship is shown in the Path 1";
		$text['simplerel'] = "Simple relationship search";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Arkusz rodzinny dla";
		$text['ldsords'] = "Wy¶wiêcony (LDS)";
		$text['baptizedlds'] = "Ochrzczony/a (LDS)";
		$text['endowedlds'] = "Wprowadzony/a (LDS)";
		$text['sealedplds'] = "Przekazani P (LDS)";
		$text['sealedslds'] = "Przekazany/a S (LDS)";
		$text['otherspouse'] = "Inny partner";
		$text['husband'] = "M±¿";
		$text['wife'] = "¯ona";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "ur.";
		$text['capaltbirthabbr'] = "w";
		$text['capdeathabbr'] = "zm.";
		$text['capburialabbr'] = "pog.";
		$text['capplaceabbr'] = "w";
		$text['capmarrabbr'] = "¶l.";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Ponownie narysuj z";
		$text['unknownlit'] = "Nieznany";
		$text['popupnote1'] = " = Dodatkowe informacje";
		$text['pedcompact'] = "Kompaktowe";
		$text['pedstandard'] = "Standartowe";
		$text['pedtextonly'] = "Tekst";
		$text['descendfor'] = "Potomkowie od";
		$text['maxof'] = "Najwiêcej z";
		$text['gensatonce'] = "Poka¿ generacje jednocze¶nie.";
		$text['sonof'] = "syn";
		$text['daughterof'] = "córka";
		$text['childof'] = "dzieckiem";
		$text['stdformat'] = "Format standardowy";
		$text['ahnentafel'] = "Rodowód";
		$text['addnewfam'] = "Dodaj now± rodzinê";
		$text['editfam'] = "Edycja rodziny";
		$text['side'] = "strona";
		$text['familyof'] = "Rodzina";
		$text['paternal'] = "Ojcowski";
		$text['maternal'] = "Matczyny";
		$text['gen1'] = "Sam";
		$text['gen2'] = "Rodzice";
		$text['gen3'] = "Dziadkowie";
		$text['gen4'] = "Pradziadkowie";
		$text['gen5'] = "Prapradziadkowie";
		$text['gen6'] = "Praprapradziadkowie";
		$text['gen7'] = "Prapraprapradziadkowie";
		$text['gen8'] = "Praprapraprapradziadkowie";
		$text['gen9'] = "Prapraprapraprapradziadkowie";
		$text['gen10'] = "Praprapraprapraprapradziadkowie";
		$text['gen11'] = "Prapraprapraprapraprapradziadkowie";
		$text['gen12'] = "Praprapraprapraprapraprapradziadkowie";
		$text['graphdesc'] = "Diagram potomków do tego miejsca";
		$text['pedbox'] = "Boks";
		$text['regformat'] = "Pokolenia";
		$text['extrasexpl'] = "= Dla tej osoby istnieje ju¿ przynajmniej jedno zdjêcie,historia lub inne medium.";
		$text['popupnote3'] = " = Nowy diagram";
		$text['mediaavail'] = "S± media";
		$text['pedigreefor'] = "Rodowód dla";
		$text['pedigreech'] = "Drzewo genealogiczne";
		$text['datesloc'] = "Daty i miejsca";
		$text['borchr'] = "narodziny/chrzciny - zgon/pogrzeb (dwa)";
		$text['nobd'] = "Brak danych dotycz±cych narodzin lub zgonu";
		$text['bcdb'] = "narodziny/chrzciny/zgon/pogrzeb (cztery)";
		$text['numsys'] = "System numerowania";
		$text['gennums'] = "Numery generacji";
		$text['henrynums'] = "Numerowanie w.g Henry'ego";
		$text['abovnums'] = "Numerowanie w.g d'Aboville";
		$text['devnums'] = "Numerowanie w.g de Villiers";
		$text['dispopts'] = "Opcje widoku";
		//added in 10.0.0
		$text['no_ancestors'] = "Nie znaleziono przodków";
		$text['ancestor_chart'] = "Pionowy wykres przodków";
		$text['opennewwindow'] = "Otwórz w nowym oknie";
		$text['pedvertical'] = "Pionowo";
		//added in 11.0.0
		$text['familywith'] = "Rodzina z";
		$text['fcmlogin'] = "Proszê siê zalogowaæ, aby zobaczyæ szczegó³y";
		$text['isthe'] = "jest";
		$text['otherspouses'] = "inni ma³¿onkowie";
		$text['parentfamily'] = "Rodzina rodzica ";
		$text['showfamily'] = "Poka¿ rodzinê";
		$text['shown'] = "pokazano";
		$text['showparentfamily'] = "poka¿ rodzinê rodzica";
		$text['showperson'] = "poka¿ osobê";
		//added in 11.0.2
		$text['otherfamilies'] = "Inne rodziny";
		//added in 14.0
		$text['dtformat'] = "Tables";
		$text['dtchildren'] = "Children";
		$text['dtgrandchildren'] = "Grandchildren";
		$text['dtggrandchildren'] = "Great grandchildren";
		$text['dtgggrandchildren'] = "Great grandchildren"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "No descendants";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Total";
		$text['dtselect'] = "Select";
		$text['dteachfulltable'] = "Each full table will have";
		$text['dtrows'] = "rows";
		$text['dtdisplayingtable'] = "Displaying table";
		$text['dtgototable'] = "Go to table:";
		$text['fcinstrdn'] = "Show family with spouse";
		$text['fcinstrup'] = "Show family with parents";
		$text['fcinstrplus'] = "Select other spouses";
		$text['fcinstrfam'] = "Select other parents";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Raporty nie istniej±.";
		$text['reportname'] = "Nazwa raportu";
		$text['allreports'] = "Wszystkie raporty";
		$text['report'] = "Raport";
		$text['error'] = "B³±d";
		$text['reportsyntax'] = "Sk³adnia pytania do tego raportu";
		$text['wasincorrect'] = "by³ b³êdny i dlatego raport nie móg³ zostaæ utworzony. Skontaktuj siê z administratorem";
		$text['errormessage'] = "B³±d";
		$text['equals'] = "równe";
		$text['endswith'] = "koñczy siê na";
		$text['soundexof'] = "soundex of";
		$text['metaphoneof'] = "metaphone of";
		$text['plusminus10'] = "+/- 10 lat od";
		$text['lessthan'] = "mniejszy od";
		$text['greaterthan'] = "wiêcej ni¿";
		$text['lessthanequal'] = "Mniejszy lub równy z";
		$text['greaterthanequal'] = "Wiêkszy lub równy z";
		$text['equalto'] = "równy";
		$text['tryagain'] = "Spróbuj ponownie napisaæ nazwisko du¿ymi literami";
		$text['joinwith'] = "Po³±cz z";
		$text['cap_and'] = "ORAZ";
		$text['cap_or'] = "LUB";
		$text['showspouse'] = "Poka¿ wspó³ma³¿onka (pokazuje duplikaty je¶li osoba ma wiêcej ni¿ jednego partnera)";
		$text['submitquery'] = "Zatwierdzenie pytania";
		$text['birthplace'] = "Miejsce urodzenia";
		$text['deathplace'] = "Miejsce zgonu";
		$text['birthdatetr'] = "Rok urodzenia";
		$text['deathdatetr'] = "Rok zgonu";
		$text['plusminus2'] = "+/- 2 lata od";
		$text['resetall'] = "Usuñ wpisy";
		$text['showdeath'] = "Poka¿ informacje o zgonie i pogrzebie";
		$text['altbirthplace'] = "Miejsce chrztu";
		$text['altbirthdatetr'] = "Rok chrztu";
		$text['burialplace'] = "Miejsce pogrzebu";
		$text['burialdatetr'] = "Rok pogrzebu";
		$text['event'] = "Wydarzenie(a)";
		$text['day'] = "Dzieñ";
		$text['month'] = "Miesi±c";
		$text['keyword'] = "S³owo kluczowe (\"Oko³o\")";
		$text['explain'] = "Podaj sk³adniki daty aby zobaczyæ wydarzenia w danym dniu. Pozostaw wolne pole aby zobaczyæ wszystkie wydarzenia.";
		$text['enterdate'] = "Podaj lub wybierz ostatni z podanych: dzieñ, miesi±c, rok, s³owo kluczowe";
		$text['fullname'] = "Imie i nazwisko";
		$text['birthdate'] = "Data urodzenia";
		$text['altbirthdate'] = "Data chrztu";
		$text['marrdate'] = "Data ¶lubu";
		$text['spouseid'] = "ID wspó³ma³¿onka";
		$text['spousename'] = "Imiê wspó³ma³¿onka";
		$text['deathdate'] = "Data zgonu";
		$text['burialdate'] = "Data pogrzebu";
		$text['changedate'] = "Data ostatniej modyfikacji";
		$text['gedcom'] = "Drzewo";
		$text['baptdate'] = "Data chrztu (LDS)";
		$text['baptplace'] = "Miejsce chrztu (LDS)";
		$text['endldate'] = "Data wprowadzenia (LDS)";
		$text['endlplace'] = "Miejsce wprowadzenia (LDS)";
		$text['ssealdate'] = "Data przekazania S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Miejsce przekazania S (LDS)";
		$text['psealdate'] = "Data przekazania P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Miejsce przekazania P (LDS)";
		$text['marrplace'] = "Miejsce ¶lubu";
		$text['spousesurname'] = "Nazwisko wspó³ma³¿onka";
		$text['spousemore'] = "Je¿eli podasz nazwisko wspó³ma³¿onka, to musisz podaæ równie¿ p³eæ.";
		$text['plusminus5'] = "+/- 5 lat od";
		$text['exists'] = "istnieje";
		$text['dnexist'] = "nie istnieje";
		$text['divdate'] = "Data separacji";
		$text['divplace'] = "Miejsce separacji";
		$text['otherevents'] = "Inne wydarzenia";
		$text['numresults'] = "Wyniki dla strony";
		$text['mysphoto'] = "Zagadkowe zdjêcia";
		$text['mysperson'] = "Zagadkowe osoby";
		$text['joinor'] = "Opcja 'Do³±cz w LUB' nie mo¿e byæ u¿yta przy nazwiskach wspóma³¿onków";
		$text['tellus'] = "Powiedz nam co wiesz";
		$text['moreinfo'] = "Wiêcej informacji:";
		//added in 8.0.0
		$text['marrdatetr'] = "Rok ¶lubu";
		$text['divdatetr'] = "Rok rozwodu";
		$text['mothername'] = "Nazwisko matki";
		$text['fathername'] = "Nazwisko ojca";
		$text['filter'] = "Filter";
		$text['notliving'] = "Nie¿yj±cy";
		$text['nodayevents'] = "Wydarzenia w tym miesi±cu nie zwi±zane z konkretn± dat±:";
		//added in 9.0.0
		$text['csv'] = "Format pliku CSV (warto¶ci rozdzielone przecinkiem)";
		//added in 10.0.0
		$text['confdate'] = "Data konfirmacji (LDS)";
		$text['confplace'] = "Miejsce konfirmacji (LDS)";
		$text['initdate'] = "Data inicjacji (LDS)";
		$text['initplace'] = "Miejsce inicjacji (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Rodzaj ¶lubu";
		$text['searchfor'] = "Szukaj";
		$text['searchnote'] = "Uwaga: Ta strona korzysta z Google, aby wykonywaæ wyszukiwanie. Ilo¶æ wyszukowañ bêdzie zale¿na od tego w jakim stopniu Google indeksuje witryny.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Logi dla";
		$text['mostrecentactions'] = "Ostatnich logowañ";
		$text['autorefresh'] = "Autood¶wie¿anie (30 sekund)";
		$text['refreshoff'] = "Wy³±cz autood¶wie¿anie";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cmentarze i nagrobki";
		$text['showallhsr'] = "Poka¿ wszystkie nagrobki";
		$text['in'] = "w";
		$text['showmap'] = "Poka¿ mapê";
		$text['headstonefor'] = "Nagrobek dla";
		$text['photoof'] = "Zdjêcie";
		$text['photoowner'] = "U¿ytkownik/¼ród³o";
		$text['nocemetery'] = "Brak cmentarza";
		$text['iptc005'] = "Tytu³";
		$text['iptc020'] = "Dodatkowe kategorie";
		$text['iptc040'] = "Specjalne instrukcje";
		$text['iptc055'] = "Data utworzenia";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Pozycja autora";
		$text['iptc090'] = "Miejscowo¶æ";
		$text['iptc095'] = "Województwo";
		$text['iptc101'] = "Kraj";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Artyku³";
		$text['iptc110'] = "¬ród³o";
		$text['iptc115'] = "¬ród³o zdjêcia";
		$text['iptc116'] = "Prawa autorskie";
		$text['iptc120'] = "Tytu³";
		$text['iptc122'] = "Autor tytu³u";
		$text['mapof'] = "Mapa";
		$text['regphotos'] = "Poka¿ z opisami";
		$text['gallery'] = "Tylko miniatury";
		$text['cemphotos'] = "Zdjêcia cmentarza";
		$text['photosize'] = "Wymiary";
        $text['iptc010'] = "Priorytet";
		$text['filesize'] = "Rozmiar pliku";
		$text['seeloc'] = "Zobacz lokalizacjê";
		$text['showall'] = "Poka¿ wszystko";
		$text['editmedia'] = "Edytuj media";
		$text['viewitem'] = "Widok tej pozycji";
		$text['editcem'] = "Edytuj cmentarz";
		$text['numitems'] = "# pozycji";
		$text['allalbums'] = "Wszystkie albumy";
		$text['slidestop'] = "Pauza przegl±du slajdów";
		$text['slideresume'] = "Zakoñcz przegl±d slajdów";
		$text['slidesecs'] = "Sekundy dla ka¿dego slajdu:";
		$text['minussecs'] = "minus 0.5 sekundy";
		$text['plussecs'] = "plus 0.5 sekundy";
		$text['nocountry'] = "Nieznany kraj";
		$text['nostate'] = "Nieznane województwo (stan))";
		$text['nocounty'] = "Nieznany powiat";
		$text['nocity'] = "Nieznana miejscowo¶æ";
		$text['nocemname'] = "Nieznana nazwa cmentarza";
		$text['editalbum'] = "Edycja albumu";
		$text['mediamaptext'] = "<strong>Uwaga:</strong> Podczas przesuwania strza³ki myszy po zdjêciu bêd± siê pokazywaæ nazwiska. Klikaj±c na wybrane otrzymasz bardziej szczegó³owe informacje.";
		//added in 8.0.0
		$text['allburials'] = "Wszystkie pogrzeby";
		$text['moreinfo'] = "Wiêcej informacji:";
		//added in 9.0.0
        $text['iptc025'] = "S³owa";
        $text['iptc092'] = "Sub-lokalizacja";
		$text['iptc015'] = "Kategoria";
		$text['iptc065'] = "Pochodzenie programu";
		$text['iptc070'] = "Wersja programu";
		//added in 13.0
		$text['toggletags'] = "Toggle Tags";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Poka¿ nazwiska na literê";
		$text['showtop'] = "Poka¿";
		$text['showallsurnames'] = "Poka¿ wszystkie nazwiska";
		$text['sortedalpha'] = "sortuj alfabetycznie";
		$text['byoccurrence'] = "najczê¶ciej wystêpuj±cych";
		$text['firstchars'] = "Pierwsze litery";
		$text['mainsurnamepage'] = "Strona g³ówna nazwisk";
		$text['allsurnames'] = "Wszystkie nazwiska";
		$text['showmatchingsurnames'] = "Kliknij na nazwisko, aby zobaczyæ wszystkie dane.";
		$text['backtotop'] = "Wróæ do g³ównych";
		$text['beginswith'] = "Rozpoczyna siê na";
		$text['allbeginningwith'] = "Wszystkie nazwiska zaczynaj±ce siê na";
		$text['numoccurrences'] = "liczba wystêpuj±cych w nawiasie";
		$text['placesstarting'] = "Zaczynaj od najwiêkszych miejsc";
		$text['showmatchingplaces'] = "<font color='brown'><b>Kliknij na jedn± ze znalezionych pozycji, aby ograniczyæ pole wyszukiwañ. Kliknij na ikonê lupki, aby zobaczyæ szczegó³y.</b></font>";
		$text['totalnames'] = "wszystkie osoby";
		$text['showallplaces'] = "Poka¿ wszystkie miejsca";
		$text['totalplaces'] = "Wszystkie miejsca";
		$text['mainplacepage'] = "Strona g³ówna miejsc";
		$text['allplaces'] = "Wszystkie najwiêksze miejsca";
		$text['placescont'] = "Poka¿ wszystkie miejsca zawieraj±ce ";
		//changed in 8.0.0
		$text['top30'] = "xxx najczê¶ciej wystêpuj±cych nazwisk";
		$text['top30places'] = "xxx najwiêkszych lokalizacji";
		//added in 12.0.0
		$text['firstnamelist'] = "Lista imion";
		$text['firstnamesstarting'] = "Przedstawia imiona zaczynaj±ce siê od";
		$text['showallfirstnames'] = "Przedstawia wszystkie imiona";
		$text['mainfirstnamepage'] = "G³ówna strona imion";
		$text['allfirstnames'] = "Imiona";
		$text['showmatchingfirstnames'] = "Kliknij na Imiê, aby wy¶wietliæ pasuj±ce zapisy.";
		$text['allfirstbegwith'] = "Wszystkie imiona zaczynaj±ce siê na";
		$text['top30first'] = "Pierwsze xxx imion(a)";
		$text['allothers'] = "Inne";
		$text['amongall'] = "(w¶ród wszystkich imion)";
		$text['justtop'] = "Tylko pierwsze xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(ostatnie xx dni)";

		$text['photo'] = "Zdjêcie";
		$text['history'] = "Historia/Dokument";
		$text['husbid'] = "ID mê¿a";
		$text['husbname'] = "Imiê mê¿a";
		$text['wifeid'] = "ID ¿ony";
		//added in 11.0.0
		$text['wifename'] = "Nazwisko matki";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Usuñ";
		$text['addperson'] = "Dodaj osobê";
		$text['nobirth'] = "Ta osoba nie mo¿e zostaæ dodana poniewa¿ brakuje jej aktualnej daty urodzin";
		$text['event'] = "Wydarzenie(a)";
		$text['chartwidth'] = "Szeroko¶æ diagramu";
		$text['timelineinstr'] = "Dodaj osobê";
		$text['togglelines'] = "Rysuj linie";
		//changed in 9.0.0
		$text['noliving'] = "Ta osoba jest zaznaczona jako ¿yj±ca i nie mo¿e zostaæ dodana, poniewa¿ nie jeste¶ do tego uprawniony/a";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Przegl±daj wszystkie drzewa";
		$text['treename'] = "Nazwa drzewa";
		$text['owner'] = "W³a¶ciciel";
		$text['address'] = "Adres";
		$text['city'] = "Miejscowo¶æ";
		$text['state'] = "Województwo.";
		$text['zip'] = "Numer kodu poczt.";
		$text['country'] = "Kraj";
		$text['email'] = "Adres e-mail";
		$text['phone'] = "Telefon";
		$text['username'] = "Nazwisko (login)";
		$text['password'] = "Has³o";
		$text['loginfailed'] = "Logowanie nie powiod³o siê.";

		$text['regnewacct'] = "Rejestracja";
		$text['realname'] = "Nazwisko i imiê";
		$text['phone'] = "Telefon";
		$text['email'] = "Adres e-mail";
		$text['address'] = "Adres";
		$text['acctcomments'] = "Notatki lub komentarz";
		$text['submit'] = "Zapisz";
		$text['leaveblank'] = "(pozostaw puste je¶li chodzi o nowe drzewo i wype³nij kolejne pole)";
		$text['required'] = "Pola wymagane";
		$text['enterpassword'] = "Podaj has³o.";
		$text['enterusername'] = "Podaj nazwê u¿ytkownika.";
		$text['failure'] = "Przepraszamy. Ta nazwa drzewa jest zajêta albo nie podano Tree ID, gdzie trzeba podaæ krótk± nazwê drzewa, jedno s³owo, bez spacji. Prosimy powróciæ do rejestracji i wybraæ now± nazwê.";
		$text['success'] = "Dziêkujemy. Twoje dane zosta³y zarejestrowane. Skontaktujemy siê z Tob± po aktywacji Twojego konta lub je¶li bêdziemy potrzebowali dalszych informacji.";
		$text['emailsubject'] = "W  zarejestrowa³ siê nowy u¿ytkownik";
		$text['website'] = "Strona www";
		$text['nologin'] = "Nie masz Nazwy u¿ytkownika?";
		$text['loginsent'] = "Informacja zosta³a wys³ana";
		$text['loginnotsent'] = "Informacja nie zosta³a wys³ana";
		$text['enterrealname'] = "Podaj prawdziwe nazwisko i imiê.";
		$text['rempass'] = "Pozostañ zalogowany";
		$text['morestats'] = "Wiêcej statystyk";
		$text['accmail'] = "<strong>UWAGA:</strong> Aby otrzymaæ pocztê od administratora dotycz±c± Twego konta sprawd¼, czy ta domena nie jest przez Ciebie blokowana <br>(czy wiadomo¶æ nie zostanie potraktowana jako spam).";
		$text['newpassword'] = "Nowe has³o";
		$text['resetpass'] = "Zmieñ has³o";
		$text['nousers'] = "Ta forma nie mo¿e zostaæ u¿yta dla co najmniej jednego istniej±cego zapisu u¿ytkownika. Je¶li ty jeste¶ w³a¶cicielem strony, przejd¼ do Administracja / U¿ytkownicy, by utworzyæ Twoje konto administratora.";
		$text['noregs'] = "Niestety aktualnie nie przyjmujemy rejestracji nowych u¿ytkowników. W przypadku pytañ lub uwag dotycz±cych tej strony prosimy o <a href=\"suggest.php\">kontakt</a>.";
		$text['emailmsg'] = "Otrzyma³e¶ wniosek o za³o¿enie konta dla nowego u¿ytkownika TNG. Zaloguj siê na konto administratora i nadaj mu odpowiednie uprawnienia. Je¶li zatwierdzisz tê rejestracjê, powiadom wnioskodawcê, odpowiadaj±c na tê wiadomo¶æ.";
		$text['accactive'] = "Konto zosta³o aktywowane, ale u¿ytkownik nie ma specjalnych uprawnieñ do czasy, a¿ zostan± mu nadane.";
		$text['accinactive'] = "Id¼ do Admin/Users/Review aby uruchomiæ ustawienie konta. Konto bêdzie nieaktywne do czasu, a¿ zostanie edytowane lub, przynajmniej raz, zachowane.";
		$text['pwdagain'] = "Has³o ponownie";
		$text['enterpassword2'] = "Proszê wpisaæ has³o ponownie.";
		$text['pwdsmatch'] = "Wpisane has³a s± ró¿ne. Proszê wpisaæ to samo has³o w ka¿dym polu.";
		$text['acksubject'] = "Dziêkujê za zarejestrowanie siê"; //for a new user account
		$text['ackmessage'] = "Twoje zapotrzebowanie na otwarcie nowego konta zosta³o odebrane. Konto bêdzie nie aktywne do czasu, a¿ zostanie zatwierdzone przez Administratora. Zostaniesz powiadomiony emailem kiedy konto bêdzie aktywowane.";
		//added in 12.0.0
		$text['switch'] = "Zmieñ";
		//added in 14.0
		$text['newpassword2'] = "New password again";
		$text['resetsuccess'] = "Success: Password has been reset";
		$text['resetfail'] = "Failure: Password not reset";
		$text['failreason0'] = " (unknown database error)";
		$text['failreason2'] = " (you don't have permission to change your password)";
		$text['failreason3'] = " (passwords did not match)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Przejrzyj wszystkie ga³êzie";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Liczba";
		$text['totindividuals'] = "Wszystkie osoby";
		$text['totmales'] = "Wszyscy mê¿czy¼ni";
		$text['totfemales'] = "Wszystkie kobiety";
		$text['totunknown'] = "Wszyscy nieznanej p³ci";
		$text['totliving'] = "Wszyscy ¿yj±cy";
		$text['totfamilies'] = "Wszystkie rodziny";
		$text['totuniquesn'] = "Wszystkie unikalne nazwiska";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Wszystkie ¼ród³a";
		$text['avglifespan'] = "¦rednia d³ugo¶æ ¿ycia";
		$text['earliestbirth'] = "Najwcze¶niej urodzony/a";
		$text['longestlived'] = "Najstarsi zmarli";
		$text['days'] = "dni";
		$text['age'] = "Wiek";
		$text['agedisclaimer'] = "Obliczenia bazuj±ce na wieku odnosz± siê do osób z podan± dat± urodzenia <EM><B>oraz</B></EM> ¶mierci.  Przy niepe³nych datach(np., data urodzenia podana jako \"1945\" lub \"JAN 1860\"), obliczenia mog± byæ nieprecyzyjne.";
		$text['treedetail'] = "Wiêcej informacji o tym drzewie";
		$text['total'] = "Wszystkie";
		//added in 12.0
		$text['totdeceased'] = "Zmarli";
		//added in 14.0
		$text['totalsourcecitations'] = "Total Source Citations";
		break;

	case "notes":
		$text['browseallnotes'] = "Przeszukaj wszystkie notatki";
		break;

	case "help":
		$text['menuhelp'] = "Menu pomocy";
		break;

	case "install":
		$text['perms'] = "Uprawnienia zosta³y nadane.";
		$text['noperms'] = "Tym plikom nie mog± zostaæ nadane uprawnienia:";
		$text['manual'] = "Proszê ustawiæ je rêcznie.";
		$text['folder'] = "Folder";
		$text['created'] = "zosta³y utworzone";
		$text['nocreate'] = "nie mo¿na utworzyæ. Proszê utworzyæ go rêcznie.";
		$text['infosaved'] = "Informacje zapisane, po³±czenie sprawdzone!";
		$text['tablescr'] = "Tabele zosta³y utworzone!";
		$text['notables'] = "Nastêpuj±ce tabele nie mog³y zostaæ utworzone:";
		$text['nocomm'] = "TNG nie mo¿e skomunikowaæ siê z baz± danych. Tabele nie zosta³y utworzone.";
		$text['newdb'] = "Informacje zapisane, sprawdzone po³±czenie, nowa baza danych utworzona:";
		$text['noattach'] = "Informacje zapisane. Po³±czenia wykonane i uaktualniona baza danych, ale TNG nie mo¿e do niej do³±czyæ.";
		$text['nodb'] = "Informacje zapisane. Po³±czenie wykonane, ale baza danych nie istnieje i nie mo¿e zostaæ utworzona. Proszê sprawdziæ, czy nazwa bazy danych jest poprawna, lub u¿yæ panelu sterowania, aby j± utworzyæ.";
		$text['noconn'] = "Informacje zapisane, ale po³±czenie nie powiod³o siê. Jeden lub wiêcej z nastêpuj±cych jest nieprawid³owy:";
		$text['exists'] = "istnieje";
		$text['noop'] = "¯adna operacja nie zosta³a wykonana.";
		//added in 8.0.0
		$text['nouser'] = "U¿ytkownik nie zosta³ utworzony. Przypuszczalnie ju¿ istnieje.";
		$text['notree'] = "Drzewo nie zosta³o utworzone. ID drzewa przypuszczalnie istnieje.";
		$text['infosaved2'] = "Informacja zapisana";
		$text['renamedto'] = "zmieniono nazwê na";
		$text['norename'] = "nazwa nie mo¿e byæ zmieniona";
		//changed in 13.0.0
		$text['loginfirst'] = "Musisz siê najpierw zalogowaæ.";
		break;

	case "imgviewer":
		$text['magmode'] = "Modu³ powiekszenia";
		$text['panmode'] = "Modu³ przesuniêcia";
		$text['pan'] = "Kliknij i przeciagnij, aby przesun±æ grafikê";
		$text['fitwidth'] = "Dopasuj szeroko¶æ";
		$text['fitheight'] = "Dopasuj wysoko¶æ";
		$text['newwin'] = "Nowe okno";
		$text['opennw'] = "Otwórz grafikê w nowym oknie";
		$text['magnifyreg'] = "Kliknij, aby powiêkszyæ wybrany obszar grafiki";
		$text['imgctrls'] = "Umo¿liwienie kontroli obrazu";
		$text['vwrctrls'] = "Umo¿liwienie kontroli przegl±darki grafiki";
		$text['vwrclose'] = "Zamknij przegladarkê grafiki";
		break;

	case "dna":
		$text['test_date'] = "Data testu";
		$text['links'] = "Waøne linki";
		$text['testid'] = "Test ID";
		//added in 12.0.0
		$text['mode_values'] = "Warto¶ci Mod";
		$text['compareselected'] = "Porównaj Wybrane";
		$text['dnatestscompare'] = "Porównaj testy Y-DNA";
		$text['keep_name_private'] = "Zachowaj prywatno¶æ";
		$text['browsealltests'] = "Przegl±daj Wszystkie Testy";
		$text['all_dna_tests'] = "Wszystkie testy DNA";
		$text['fastmutating'] = "Szybka mutacja";
		$text['alltypes'] = "Rodzaje";
		$text['allgroups'] = "Grupy";
		$text['Ydna_LITbox_info'] = "Testy powi±zane z t± osob± niekoniecznie zosta³y wykonane przez tê osobê.<br />Kolumna 'Haplogroup' wy¶wietla dane na czerwono, je¶li wynik jest 'Przewidywany' lub na zielono je¶li test jest 'Potwierdzony'";
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
$text['matches'] = "Wyniki";
$text['description'] = "Opis";
$text['notes'] = "Notatki";
$text['status'] = "Status";
$text['newsearch'] = "Nowe szukanie";
$text['pedigree'] = "Rodowód";
$text['seephoto'] = "Zobacz zdjêcie";
$text['andlocation'] = "&amp; po³o¿enie";
$text['accessedby'] = "odwiedzone przez";
$text['children'] = "Dzieci";  //from getperson
$text['tree'] = "Istniej±ce drzewo";
$text['alltrees'] = "Wszystkie drzewa";
$text['nosurname'] = "[bez nazwiska]";
$text['thumb'] = "Miniatura";  //as in Thumbnail
$text['people'] = "Osoby";
$text['title'] = "Tytu³";  //from getperson
$text['suffix'] = "Przyrostek";  //from getperson
$text['nickname'] = "Przydomek";  //from getperson
$text['lastmodified'] = "Ostatnia modyfikacja";  //from getperson
$text['married'] = "¦lub";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nazwisko"; //from showmap
$text['lastfirst'] = "Nazwisko, imiê";  //from search
$text['bornchr'] = "Data i miejsce urodzenia";  //from search
$text['individuals'] = "Osoby";  //from whats new
$text['families'] = "Rodziny";
$text['personid'] = "ID osoby";
$text['sources'] = "¬ród³a";  //from getperson (next several)
$text['unknown'] = "Nieznane";
$text['father'] = "Ojciec";
$text['mother'] = "Matka";
$text['christened'] = "Chrzest";
$text['died'] = "Zgon";
$text['buried'] = "Pogrzeb";
$text['spouse'] = "Partner";  //from search
$text['parents'] = "Rodzice";  //from pedigree
$text['text'] = "Tekst";  //from sources
$text['language'] = "Jêzyk";  //from languages
$text['descendchart'] = "Linia potomków";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Osoba";
$text['edit'] = "Edycja";
$text['date'] = "Data";
$text['login'] = "Zaloguj";
$text['logout'] = "Wyloguj";
$text['groupsheet'] = "Arkusz rodzinny";
$text['text_and'] = "oraz";
$text['generation'] = "Pokolenie";
$text['filename'] = "Nazwa pliku";
$text['id'] = "ID";
$text['search'] = "Szukaj";
$text['user'] = "U¿ytkownik";
$text['firstname'] = "Imiê";
$text['lastname'] = "Nazwisko";
$text['searchresults'] = "Szukaj w wynikach";
$text['diedburied'] = "Zmar³";
$text['homepage'] = "Strona g³ówna";
$text['find'] = "Znajd¼...";
$text['relationship'] = "Pokrewieñstwo";		//in German, Verwandtschaft
$text['relationship2'] = "Wzajemna relacja"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Linia czasu";
$text['yesabbr'] = "R";               //abbreviation for 'yes'
$text['divorced'] = "Rozwód";
$text['indlinked'] = "Link do";
$text['branch'] = "Ga³±¼";
$text['moreind'] = "Wiêcej osób";
$text['morefam'] = "Wiêcej rodzin";
$text['surnamelist'] = "Lista nazwisk";
$text['generations'] = "Pokolenia";
$text['refresh'] = "Od¶wie¿";
$text['whatsnew'] = "Co nowego";
$text['reports'] = "Raporty";
$text['placelist'] = "Lista miejsc";
$text['baptizedlds'] = "Ochrzczony/a (LDS)";
$text['endowedlds'] = "Wprowadzony/a (LDS)";
$text['sealedplds'] = "Przekazani P (LDS)";
$text['sealedslds'] = "Przekazany/a S (LDS)";
$text['ancestors'] = "Przodkowie";
$text['descendants'] = "Potomkowie";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Data ostatniego importu GEDCOM-u";
$text['type'] = "Typ";
$text['savechanges'] = "Zapisz zmiany";
$text['familyid'] = "ID rodziny";
$text['headstone'] = "Nagrobki";
$text['historiesdocs'] = "Historie";
$text['anonymous'] = "anonimowy";
$text['places'] = "Miejsca";
$text['anniversaries'] = "Daty i rocznice";
$text['administration'] = "Administracja";
$text['help'] = "Pomoc";
//$text['documents'] = "Documents";
$text['year'] = "Rok";
$text['all'] = "Wszystko";
$text['address'] = "Adres";
$text['suggest'] = "Sugestie";
$text['editevent'] = "Sugestia zmiany dla tego wydarzenia";
$text['morelinks'] = "Wiêcej ³±czy";
$text['faminfo'] = "Informacja o zwi±zku";
$text['persinfo'] = "Info o osobie";
$text['srcinfo'] = "Informacje o ¼ródle";
$text['fact'] = "Zdarzenie";
$text['goto'] = "Wybierz stronê";
$text['tngprint'] = "Drukuj";
$text['databasestatistics'] = "Statystyki"; //needed to be shorter to fit on menu
$text['child'] = "Dziecko";  //from familygroup
$text['repoinfo'] = "Informacja o repozytoriach";
$text['tng_reset'] = "Cofnij";
$text['noresults'] = "Brak rezultatów";
$text['allmedia'] = "Wszystkie media";
$text['repositories'] = "Repozytoria";
$text['albums'] = "Albumy";
$text['cemeteries'] = "Cmentarze";
$text['surnames'] = "Nazwiska";
$text['dates'] = "Daty";
$text['link'] = "Link";
$text['media'] = "Media";
$text['gender'] = "P³eæ";
$text['latitude'] = "Szeroko¶æ";
$text['longitude'] = "D³ugo¶æ";
$text['bookmarks'] = "Zak³adki";
$text['bookmark'] = "Dodaj zak³adki";
$text['mngbookmarks'] = "Id¼ do zak³adek";
$text['bookmarked'] = "Zak³adka dodana";
$text['remove'] = "Usuñ";
$text['find_menu'] = "Znajd¼";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cmentarz";
$text['gmapevent'] = "Mapa wydarzenia";
$text['gevents'] = "Wydarzenie";
$text['googleearthlink'] = "£±cze do Google Earth";
$text['googlemaplink'] = "£±cze do Google Maps";
$text['gmaplegend'] = "Legenda szpilek";
$text['unmarked'] = "Nieoznakowany";
$text['located'] = "Zlokalizowany";
$text['albclicksee'] = "Kliknij aby pokazaæ wszystkie elementy tego albumu";
$text['notyetlocated'] = "Jeszcze nie zlokalizowany";
$text['cremated'] = "Skremowany";
$text['missing'] = "Zaginiony";
$text['pdfgen'] = "Generator PDF";
$text['blank'] = "Pusty diagram";
$text['fonts'] = "Czcionki";
$text['header'] = "Nag³ówek";
$text['data'] = "Dane";
$text['pgsetup'] = "Ustawienia strony";
$text['pgsize'] = "Wielko¶æ strony";
$text['orient'] = "Ukierunkowanie"; //for a page
$text['portrait'] = "Format pionowy";
$text['landscape'] = "Format poziomy";
$text['tmargin'] = "Górna krawêd¼";
$text['bmargin'] = "Dolna krawêd¼";
$text['lmargin'] = "Lewa krawêd¼";
$text['rmargin'] = "Prawa krawêd¼";
$text['createch'] = "Tworzenie diagramu";
$text['prefix'] = "Prefix";
$text['mostwanted'] = "Niewyja¶nione zagadki";
$text['latupdates'] = "Ostatnia aktualizacja";
$text['featphoto'] = "Przedstawione zdjêcie";
$text['news'] = "Nowo¶ci";
$text['ourhist'] = "Historia naszej rodziny";
$text['ourhistanc'] = "Historia i genealogia naszej rodziny";
$text['ourpages'] = "Strona genealogiczna naszej rodziny";
$text['pwrdby'] = "oparty na bazie";
$text['writby'] = "napisanej przez";
$text['searchtngnet'] = "Szukaj w TNG Network (GENDEX)";
$text['viewphotos'] = "Zobacz wszystkie zdjêcia";
$text['anon'] = "Jeste¶ w tej chwili anonimowy";
$text['whichbranch'] = "Do której ga³êzi nale¿ysz?";
$text['featarts'] = "Przedstawione artyku³y";
$text['maintby'] = "Zarz±dzane przez";
$text['createdon'] = "Utworzono dnia";
$text['reliability'] = "Pewno¶æ";
$text['labels'] = "Etykiety";
$text['inclsrcs'] = "Do³±cz ¼ród³a";
$text['cont'] = "(cont.)"; //abbreviation for continued
$text['mnuheader'] = "Strona domowa";
$text['mnusearchfornames'] = "Szukaj";
$text['mnulastname'] = "Nazwisko";
$text['mnufirstname'] = "Imiê";
$text['mnusearch'] = "Szukaj";
$text['mnureset'] = "Zacznij ponownie";
$text['mnulogon'] = "Zaloguj";
$text['mnulogout'] = "Wyloguj";
$text['mnufeatures'] = "Inne opcje";
$text['mnuregister'] = "Rejestracja nowego<br> konta u¿ytkownika";
$text['mnuadvancedsearch'] = "Szukanie zaawansowane";
$text['mnulastnames'] = "Nazwiska";
$text['mnustatistics'] = "Statystyka";
$text['mnuphotos'] = "Zdjêcia";
$text['mnuhistories'] = "Historie";
$text['mnumyancestors'] = "Zdjêcia &amp; Historie przodków [osoba]";
$text['mnucemeteries'] = "Lista cmentarzy";
$text['mnutombstones'] = "Nagrobki";
$text['mnureports'] = "Raporty";
$text['mnusources'] = "¬ród³a";
$text['mnuwhatsnew'] = "Co nowego";
$text['mnushowlog'] = "Ostatnie logowania";
$text['mnulanguage'] = "Language (Jêzyk)";
$text['mnuadmin'] = "Administracja";
$text['welcome'] = "Zalogowany: ";
$text['contactus'] = "Kontakt";
//changed in 8.0.0
$text['born'] = "Urodzenie";
$text['searchnames'] = "Szukaj";
//added in 8.0.0
$text['editperson'] = "Edytuj osobê";
$text['loadmap'] = "Za³aduj mapê";
$text['birth'] = "Urodzenie";
$text['wasborn'] = "urodzony(a)";
$text['startnum'] = "Pierwsza liczba";
$text['searching'] = "Szukanie";
//moved here in 8.0.0
$text['location'] = "Lokalizacja";
$text['association'] = "Relacja";
$text['collapse'] = "Sk³adanie";
$text['expand'] = "Rozszerzanie";
$text['plot'] = "Sektor";
$text['searchfams'] = "Szukaj rodzinê";
//added in 8.0.2
$text['wasmarried'] = "po¶lubi³(a)";
$text['anddied'] = "Zgon";
//added in 9.0.0
$text['share'] = "Wspólne korzystanie";
$text['hide'] = "Ukryj";
$text['disabled'] = "Twoje konto zosta³o zablokowane. Prosimy o kontakt z administratorem serwisu w celu uzyskania wiêcej informacji.";
$text['contactus_long'] = "Je¶li masz jakie¶ pytania lub komentarze dotycz±ce informacji na tej stronie, prosimy o <span class=\"emphasis\"><a href=\"suggest.php\">kontakt</a></span>. Czekamy na kontakt z Pañstwem.";
$text['features'] = "Nowe funkcje";
$text['resources'] = "Zasoby";
$text['latestnews'] = "Aktualno¶ci";
$text['trees'] = "Drzewa genealogiczne";
$text['wasburied'] = "was buried";
//moved here in 9.0.0
$text['emailagain'] = "Email ponownie";
$text['enteremail2'] = "Wpisz swój email adres ponownie.";
$text['emailsmatch'] = "Twoje maile nie zgadzaj± siê. Wpisz ten sam email adres w ka¿dym polu.";
$text['getdirections'] = "Kliknij aby uzyskaæ po³±czenie";
$text['calendar'] = "Kalendarz";
//changed in 9.0.0
$text['directionsto'] = " do ";
$text['slidestart'] = "Pokaz slajdów";
$text['livingnote'] = "<font color=\"#FF0000\"><b>Dane osób ¿yj±cych ukryte. - Dostêpne po zarejestrowaniu.</b></font>";
$text['livingphoto'] = "<font color=\"#FF0000\"><b>Detale ukryte poniewa¿ przynajmniej jedna ¿yj±ca osoba jest zwi±zana z t± informacj±. - Dostêpne po zarejestrowaniu.</b></font>";
$text['waschristened'] = "Chrzest";
//added in 10.0.0
$text['branches'] = "Ga³êzie";
$text['detail'] = "Szczegó³owo";
$text['moredetail'] = "Wiêcej szczegó³ów";
$text['lessdetail'] = "Mniej szczegó³ów";
$text['conflds'] = "Konfirmacja (LDS)";
$text['initlds'] = "Inicjacja (LDS)";
$text['wascremated'] = "zosta³/zosta³a skremowany";
//moved here in 11.0.0
$text['text_for'] = "dla";
//added in 11.0.0
$text['searchsite'] = "Przeszukaj tê stronê";
$text['searchsitemenu'] = "Szukaj strony";
$text['kmlfile'] = "Pobierz plik .kml aby pokazaæ tê lokalizacjê w Google Earth";
$text['download'] = "Kliknij aby pobraæ";
$text['more'] = "Wiêcej";
$text['heatmap'] = "Heat Map";
$text['refreshmap'] = "Od¶wie¿ mapê";
$text['remnums'] = "Usuñ liczby i zaznaczenia";
$text['photoshistories'] = "Zdjêcia &amp; Historie";
$text['familychart'] = "Wykres rodzinny";
//added in 12.0.0
$text['firstnames'] = "Imiona";
//moved here in 12.0.0
$text['dna_test'] = " Test DNA";
$text['test_type'] = "Rodzaj testu";
$text['test_info'] = "Informacja dotycz±ca testu";
$text['takenby'] = "Pobrane przez";
$text['haplogroup'] = "Haplogrupa";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Powi±zane linki";
$text['nofirstname'] = "[brak imienia]";
//added in 12.0.1
$text['cookieuse'] = "Uwaga: Ta strona u¿ywa plików cookie.";
$text['dataprotect'] = "Polityka ochrony danych";
$text['viewpolicy'] = "Zobacz zasady ochrony danych";
$text['understand'] = "Rozumiem";
$text['consent'] = "Wyra¿am zgodê, dla tej witryny, na umieszczenie, tu zgromadzonych, dotycz±cych mnie, danych osobowych. Rozumiem, ¿e mogê poprosiæ w³a¶ciciela witryny o usuniêcie tych informacji w dowolnym momencie. ";
$text['consentreq'] = "Proszê wyraziæ zgodê na przechowywanie Twoich danych osobowych w tej witrynie.";

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
$text['dna_info_head'] = "Informacja dotycz±ca testu DNA";
//added in 13.0
$text['visitor'] = "Visitor";

$text['popupnote2'] = " = Nowy rodowód";

//moved here in 14.0
$text['zoomin'] = "Powiêksz";
$text['zoomout'] = "Zmniejsz";
$text['scrollnote'] = "Uwaga: Byæ mo¿e musisz przewin±æ w prawo lub w dó³ aby wszystko zobaczyæ.";
$text['general'] = "Ogólny";

//changed in 14.0
$text['otherevents'] = "Inne wydarzenia";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Connections";
$text['continue'] = "Continue";
$text['title2'] = "Title"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>