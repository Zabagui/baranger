<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Przeglądaj źródła";
		$text['shorttitle'] = "Krótki tytuł";
		$text['callnum'] = "Nr wywołania";
		$text['author'] = "Autor";
		$text['publisher'] = "Wydawca";
		$text['other'] = "Inne informacje";
		$text['sourceid'] = "ID źródła";
		$text['moresrc'] = "Więcej źródeł";
		$text['repoid'] = "ID repozytorium";
		$text['browseallrepos'] = "Przeglądaj repozytoria";
	break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nowy język";
		$text['changelanguage'] = "Zmiana języka";
		$text['languagesaved'] = "Zapisz język";
		$text['sitemaint'] = "Strona jest w trakcie aktualizacji";
		$text['standby'] = "Z powodu aktualizacji bazy danych strona jest chwilowo niedostępna. Proszę spróbować za jakiś czas ponownie. Jeśli strona pozostanie przez dłuższy czas niedostępna, prosimy zwrócić się do administratora <a href=\"suggest.php\"></a>.";
	break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM zaczynaj od";
		$text['producegedfrom'] = "Twórz plik GEDCOM dla";
		$text['numgens'] = "Liczba generacji";
		$text['includelds'] = "Łącznie z informacjami LDS";
		$text['buildged'] = "Buduj GEDCOM";
		$text['gedstartfrom'] = "Zaczynaj GEDCOM od";
		$text['nomaxgen'] = "Określ maksymalną liczbę generacji.";
		$text['gedcreatedfrom'] = "Twórz GEDCOM z";
		$text['gedcreatedfor'] = "buduj dla";
		$text['creategedfor'] = "Twórz GEDCOM";
		$text['email'] = "Adres e-mail";
		$text['suggestchange'] = "Sugerowane zmiany";
		$text['yourname'] = "Twoje nazwisko";
		$text['comments'] = "Uwagi i komentarze";
		$text['comments2'] = "Komentarze";
		$text['submitsugg'] = "Dodaj sugestię";
		$text['proposed'] = "Sugestia zmian";
		$text['mailsent'] = "Dziękujemy, mail wysłany.";
		$text['mailnotsent'] = "Przepraszamy, Twój mail nie mógł być wysłany. Skontaktuj się z xxx bezpośrednio na yyy.";
		$text['mailme'] = "Wyślij kopię na ten adres";
		$text['entername'] = "Podaj imię";
		$text['entercomments'] = "Wpisz swoje uwagi";
		$text['sendmsg'] = "Wyślij";
		//added in 9.0.0
		$text['subject'] = "Temat";
	break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Zdjęcia i historie dla";
		$text['indinfofor'] = "Informacja indywidualna dla";
		$text['pp'] = "skr."; //page abbreviation
		$text['age'] = "wiek";
		$text['agency'] = "Urząd";
		$text['cause'] = "Przyczyna";
		$text['suggested'] = "Sugerowane";
		$text['closewindow'] = "Zamknij to okno";
		$text['thanks'] = "Dziękujemy";
		$text['received'] = "Twoja sugestia zostanie przekazana administratorowi witryny.";
		$text['indreport'] = "Raport indywidualny";
		$text['indreportfor'] = "Raport indywidualny dla";
		$text['bkmkvis'] = "<strong>Uwaga:</strong> Te zakładki będą widoczne tylko na tym komputerze i tylko w tej wyszukiwarce internetowej.";
		//added in 9.0.0
		$text['reviewmsg'] = "Masz sugestie zmian, które wymagają twojej akceptacji. Ten wniosek dotyczy:";
		$text['revsubject'] = "Sugerowane zmiany wymagają twojej akceptacji";
	break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Kalkulator pokrewieństwa";
		$text['findrel'] = "Znajdź pokrewieństwo";
		$text['person1'] = "Osoba 1:";
		$text['person2'] = "Osoba 2:";
		$text['calculate'] = "Oblicz";
		$text['select2inds'] = "Należy wskazać dwie osoby.";
		$text['findpersonid'] = "Znajdź ID osoby";
		$text['enternamepart'] = "Wpisz część imienia i/lub nazwiska";
		$text['pleasenamepart'] = "Podaj część imienia lub nazwiska.";
		$text['clicktoselect'] = "Kliknij, aby wybrać";
		$text['nobirthinfo'] = "Brak informacji o urodzeniu";
		$text['relateto'] = "Pokrewieństwo z";
		$text['sameperson'] = "Wskazano dwukrotnie tę samą osobę. Spróbuj jeszcze raz.";
		$text['notrelated'] = "Te dwie osoby nie są spokrewnione w obrębie xxx pokoleń."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Dla ustalenia pokrewieństwa dwóch osób naciśnij 'Szukaj' aby zlokalizować istniejące osoby a następnie kliknij na 'Oblicz'.";
		$text['sometimes'] = "(Czasami sprawdzenie innej liczby pokoleń daje inny rezultat.)";
		$text['findanother'] = "Szukaj innego pokrewieństwa";
		$text['brother'] = "bratem";
		$text['sister'] = "siostrą";
		$text['sibling'] = "rodzeństwem";
		$text['uncle'] = "xxx wujem";
		$text['aunt'] = "xxx ciotką";
		$text['uncleaunt'] = "xxx wujem/ciotką";
		$text['nephew'] = "xxx bratankiem/siostrzeńcem";
		$text['niece'] = "xxx bratanicą/siostrzenicą";
		$text['nephnc'] = "xxx bratankiem,siostrzeńcem / bratanicą,siostrzenicą";
		$text['removed'] = "młodszym(ą)";
		$text['rhusband'] = "mężem ";
		$text['rwife'] = "żoną ";
		$text['rspouse'] = "partnerem";
		$text['son'] = "synem";
		$text['daughter'] = "córką";
		$text['rchild'] = "dzieckiem";
		$text['sil'] = "zięciem";
		$text['dil'] = "synową";
		$text['sdil'] = "zięciem lub synową";
		$text['gson'] = "xxx wnukiem";
		$text['gdau'] = "xxx wnuczką";
		$text['gsondau'] = "xxx wnukiem/wnuczką";
		$text['great'] = "pra";
		$text['spouses'] = "są małżeństwem";
		$text['is'] = "jest";
		$text['changeto'] = "Zmień na (podaj ID):";
		$text['notvalid'] = "Wskazany ID osoby jest niepoprawny albo nie ma go w bazie danych. Spróbuj jeszcze raz.";
		$text['halfbrother'] = "przyrodnim bratem";
		$text['halfsister'] = "przyrodnią siostrą";
		$text['halfsibling'] = "przyrodnie rodzeństwo";
		//changed in 8.0.0
		$text['gencheck'] = "Maksymalna liczba pokoleń<br />do sprawdzenia";
		$text['mcousin'] = "xxx kuzynem";	//male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx kuzynką";	//female cousin
		$text['cousin'] = "xxx kuzynem/kuzynką";
		$text['mhalfcousin'] = "xxx przyrodnim kuzynem";	//male cousin
		$text['fhalfcousin'] = "xxx przyrodnią kuzynką";	//female cousin
		$text['halfcousin'] = "xxx przyrodni kuzyn";
		//added in 8.0.0
		$text['oneremoved'] = "młodszym/młodszą";
		$text['gfath'] = "xxx dziadkiem";
		$text['gmoth'] = "xxx babką";
		$text['gpar'] = "xxx dziadkowie";
		$text['mothof'] = "matką";
		$text['fathof'] = "ojcem";
		$text['parof'] = "rodzice";
		$text['maxrels'] = "Maksymalna ilość relacji do pokazania";
		$text['dospouses'] = "Wzajemna relacja, włączając w to małżonka";
		$text['rels'] = "Pokrewieństwo";
		$text['dospouses2'] = "Uwzględnij małżonków";
		$text['fil'] = "teściem";
		$text['mil'] = "teściową";
		$text['fmil'] = "teść lub teściowa";
		$text['stepson'] = "pasierbem";
		$text['stepdau'] = "pasierbicą";
		$text['stepchild'] = "pasierb(ica)";
		$text['stepgson'] = "xxx synem pasierba";
		$text['stepgdau'] = "xxx córką pasierba";
		$text['stepgchild'] = "xxx dziecko pasierba";
		//added in 8.1.1
		$text['ggreat'] = "pra";
		//added in 8.1.2
		$text['ggfath'] = "xxx pradziadkiem";
		$text['ggmoth'] = "xxx prababką";
		$text['ggpar'] = "xxx pradziadkowie";
		$text['ggson'] = "xxx prawnuczkiem";
		$text['ggdau'] = "xxx prawnuczką";
		$text['ggsondau'] = "xxx prawnuk";
		$text['gstepgson'] = "xxx pra pasierbem";
		$text['gstepgdau'] = "xxx pra pasierbicą";
		$text['gstepgchild'] = "xxx pra pasierb";
		$text['guncle'] = "xxx pra wujkiem";
		$text['gaunt'] = "pra ciotką";
		$text['guncleaunt'] = "xxx pra wujkiem/ciotką";
		$text['gnephew'] = "xxx pra bratankiem/siostrzenicą";
		$text['gniece'] = "xxx pra bratanicą/siostrzenicą";
		$text['gnephnc'] = "xxx pra bratanicą/siostrzenicą";
		$text['pathscalc'] = "Szukaj powiązań";
		$text['findrel2'] = "Znajdź pokrewieństwo i inne powiązania";
		$text['makeme2nd'] = "Użyj mojego ID";
		$text['usebookmarks'] = "Użyj zakładek";
		$text['select2inds'] = "Należy wskazać dwie osoby.";
		$text['indinfofor'] = "Informacja indywidualna dla";
		$text['nobookmarks'] = "Nie ma zakładek, które mogłyby być użyte";
		$text['bkmtitle'] = "Osoby znalezione w zakładkach";
		$text['bkminfo'] = "Wybierz osobę:";
		$text['sortpathsby'] = "Sortuj ścieżki wg liczby";
		$text['sortbyshort'] = "Sortuj wg";
		$text['bylengthshort'] = "długości";
		$text['badID1'] = ": niepoprawny ID Osoby 1 - wróć i popraw";
		$text['badID2'] = ": niepoprawny ID Osoby 2 - wróć i popraw";
		$text['notintree'] = ": osoby o tym ID nie ma w bieżącym drzewie.";
		$text['sameperson'] = "Wskazano dwukrotnie tę samą osobę.";;
		$text['nopaths'] = "Nie znaleziono powiązania pomiędzy tymi osobami.";
		$text['nopaths1'] = "Nie znaleziono więcej powiązań";
		$text['nopaths2'] = "w xxx krokach wyszukiwania";
		$text['longestpath'] = "Nnajdłuższa z dotąd zbadanych ścieżek miała długość xxx.";
		$text['relevantpaths'] = "Liczba znalezionych różnych powiązań (ścieżek): xxx";
		$text['skipMarr'] = "(ponadto liczba ścieżek znalezionych, lecz nie wyświetlonych z powodu zbyt dużej liczby małżeństw: xxx)";
		$text['mjaor'] = "albo";
		$text['connectionsto'] = "Powiązania z osobą: ";
		$text['findanotherpers'] = "lub znajdź inną osobę...";
		$text['sometimes'] = "(Czasami sprawdzenie innej liczby pokoleń daje inny rezultat.)";
		$text['anotherpath'] = "Znajdź powiązania z inną osobą";
		$text['xpath'] = "Ścieżka nr ";
		$text['primary'] = "Osoba początkowa"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Osoba końcowa";
		$text['parent'] = "rodzic / Parent";
		$text['mhfather'] = "jego ojciec";
		$text['mhmother'] = "jego matka";
		$text['mhhusband'] = "jego małżonek";
		$text['mhwife'] = "jego żona";
		$text['mhson'] = "jego syn";
		$text['mhdaughter'] = "jego córka";
		$text['fhfather'] = "jej ojciec";
		$text['fhmother'] = "jej matka";
		$text['fhhusband'] = "jej mąż";
		$text['fhwife'] = "jej małżonka";
		$text['fhson'] = "jej syn";
		$text['fhdaughter'] = "jej córka";
		$text['hfather'] = "ojciec";
		$text['hmother'] = "matka";
		$text['hhusband'] = "mąż";
		$text['hwife'] = "żona";
		$text['hson'] = "syn";
		$text['hdaughter'] = "córka";
		$text['maxruns'] = "Max. liczba ścieżek do sprawdzenia";
		$text['maxrshort'] = "Liczba prób";
		$text['maxlength'] = "Ścieżki powiązań nie dłuższe niż";
		$text['maxlshort'] = "max.dł.ścieżki";
		$text['xstep'] = "krok";
		$text['xsteps'] = "kroków";
		$text['xmarriages'] = "w tym xxx małżeństw";
		$text['xmarriage'] = "w tym 1 małżeństwo";
		$text['showspouses'] = "Pokazuj w ścieżce oboje małżonków";
		$text['showTxt'] = "Pokazuj również opis tekstowy powiązania";
		$text['showTxtshort'] = "Opis tekstowy";
		$text['compactBox'] = "Pokazuj diagram bardziej kompaktowy";
		$text['compactBoxshort'] = "Diagram kompaktowy";
		$text['paths'] = "Powiązania";
		$text['dospouses2'] = "Pokaż małżonków";
		$text['maxmopt'] = "Max liczba małżeństw w ścieżce"; // note: this is only to prevent the display of "too wide" diagrams, without changing the search process
		$text['maxm'] = "Max liczba małżeństw";
		$text['arerelated'] = "Te osoby są spokrewnione - ich pokrewieństwo pokazuje Ścieżka nr 1";
		$text['simplerel'] = "Szukanie pokrewieństwa";
	break;

	case "familygroup":
		$text['familygroupfor'] = "Arkusz rodzinny dla";
		$text['ldsords'] = "Wyświęcony (LDS)";
		$text['baptizedlds'] = "Ochrzczony/a (LDS)";
		$text['endowedlds'] = "Wprowadzony/a (LDS)";
		$text['sealedplds'] = "Przekazani P (LDS)";
		$text['sealedslds'] = "Przekazany/a S (LDS)";
		$text['otherspouse'] = "Inny partner";
		$text['husband'] = "Mąż";
		$text['wife'] = "Żona";
	break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "ur.";
		$text['capaltbirthabbr'] = "w";
		$text['capdeathabbr'] = "zm.";
		$text['capburialabbr'] = "poch.";
		$text['capplaceabbr'] = "w";
		$text['capmarrabbr'] = "śl.";
		$text['capspouseabbr'] = "małż.";
		$text['redraw'] = "Ponownie narysuj";
		$text['scrollnote'] = "Uwaga: Być może trzeba przewinąć/przeciągnąć w prawo lub w dół aby wszystko zobaczyć.";
		$text['unknownlit'] = "Nieznany";
		$text['popupnote1'] = " = Dodatkowe informacje";
		$text['pedcompact'] = "Kompaktowe";
		$text['pedstandard'] = "Standardowe";
		$text['pedtextonly'] = "Tekst";
		$text['descendfor'] = "Potomkowie od";
		$text['maxof'] = "Najwięcej z";
		$text['gensatonce'] = "Pokaż generacje jednocześnie.";
		$text['sonof'] = "synem";
		$text['daughterof'] = "córką";
		$text['childof'] = "dzieckiem";
		$text['stdformat'] = "Format standardowy";
		$text['ahnentafel'] = "Rodowód";
		$text['addnewfam'] = "Dodaj nową rodzinę";
		$text['editfam'] = "Edycja rodziny";
		$text['side'] = "strona";
		$text['familyof'] = "rodzina";
		$text['paternal'] = "ojcowski";
		$text['maternal'] = "matczyny";
		$text['gen1'] = "probant";
		$text['gen2'] = "rodzice";
		$text['gen3'] = "dziadkowie";
		$text['gen4'] = "pradziadkowie";
		$text['gen5'] = "prapradziadkowie";
		$text['gen6'] = "Pra(3)dziadkowie";
		$text['gen7'] = "Pra(4)dziadkowie";
		$text['gen8'] = "Pra(5)dziadkowie";
		$text['gen9'] = "Pra(6)dziadkowie";
		$text['gen10'] = "Pra(7)dziadkowie";
		$text['gen11'] = "Pra(8)dziadkowie";
		$text['gen12'] = "Pra(9)dziadkowie";
		$text['graphdesc'] = "Diagram potomków do tego miejsca";
		$text['pedbox'] = "Boks";
		$text['regformat'] = "Pokolenia";
		$text['extrasexpl'] = "= Dla tej osoby istnieje już przynajmniej jedno zdjęcie lub inny plik mediów.";
		$text['popupnote3'] = " = Nowy diagram";
		$text['mediaavail'] = "Są media";
		$text['pedigreefor'] = "Rodowód dla";
		$text['pedigreech'] = "Drzewo genealogiczne";
		$text['datesloc'] = "Daty i miejsca";
		$text['borchr'] = "narodziny/chrzciny - zgon/pogrzeb (dwa)";
		$text['nobd'] = "Brak danych dotyczących narodzin lub zgonu";
		$text['bcdb'] = "narodziny/chrzciny/zgon/pogrzeb (cztery)";
		$text['numsys'] = "System numerowania";
		$text['gennums'] = "Numery generacji";
		$text['henrynums'] = "Numerowanie wg Henry'ego";
		$text['abovnums'] = "Numerowanie wg d'Aboville";
		$text['devnums'] = "Numerowanie wg de Villiers";
		$text['dispopts'] = "Opcje widoku";
		//added in 10.0.0
		$text['no_ancestors'] = "Nie znaleziono przodków";
		$text['ancestor_chart'] = "Pionowy wykres przodków";
		$text['opennewwindow'] = "Otwórz w nowym oknie";
		$text['pedvertical'] = "Pionowo";
		//added in 11.0.0
		$text['familywith'] = "Rodzina dla";
		$text['fcmlogin'] = "Proszę się zalogować, aby zobaczyć szczegóły";
		$text['isthe'] = "jest";
		$text['otherspouses'] = "inni małżonkowie"; 
		$text['parentfamily'] = "Rodzina rodzica ";
		$text['showfamily'] = "Pokaż tę rodzinę";
		$text['shown'] = "pokazano";
		$text['showparentfamily'] = "pokaż rodzinę rodzica";
		$text['showperson'] = "pokaż osobę";
		//added in 11.0.2
		$text['otherfamilies'] = "Inne rodziny";
		//added in 14.0
		$text['dtformat'] = "Tabele";
		$text['dtchildren'] = "Dzieci";
		$text['dtgrandchildren'] = "Wnuki";
		$text['dtggrandchildren'] = "Prawnuki";
		$text['dtgggrandchildren'] = "Praprawnuki"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Nie ma potomstwa";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Razem";
		$text['dtselect'] = "Wybierz";
		$text['dteachfulltable'] = "Każda pełna tabela będzie miała";
		$text['dtrows'] = "wierszy";
		$text['dtdisplayingtable'] = "Wyświetlanie tabeli";
		$text['dtgototable'] = "Idź do tabeli:";
		$text['fcinstrdn'] = "Pokaż rodzinę z małżonkiem";
		$text['fcinstrup'] = "Pokaż rodzinę z rodzicami";
		$text['fcinstrplus'] = "Wybierz innego małżonka";
		$text['fcinstrfam'] = "Wybierz innych rodziców";
	break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Nie ma zdefiniowanych raportów.";
		$text['reportname'] = "Nazwa raportu";
		$text['allreports'] = "Wszystkie raporty";
		$text['report'] = "Raport";
		$text['error'] = "Błąd";
		$text['reportsyntax'] = "Składnia pytania do tego raportu";
		$text['wasincorrect'] = "był błędny i dlatego raport nie mógł zostać utworzony. Skontaktuj się z administratorem";
		$text['errormessage'] = "Błąd";
		$text['equals'] = "jest równy";
		$text['endswith'] = "kończy się na";
		$text['soundexof'] = "przybliżony (soundex)";
		$text['metaphoneof'] = "podobnie brzmiące (metaphone)";
		$text['plusminus10'] = "+/- 10 lat od";
		$text['lessthan'] = "mniejszy od";
		$text['greaterthan'] = "więcej niż";
		$text['lessthanequal'] = "Mniejszy lub równy z";
		$text['greaterthanequal'] = "Większy lub równy z";
		$text['equalto'] = "równy";
		$text['tryagain'] = "Spróbuj zmienić kryteria wyszukiwania";
		$text['joinwith'] = "Łączenie argumentów";
		$text['cap_and'] = "ORAZ";
		$text['cap_or'] = "LUB";
		$text['showspouse'] = "Pokaż małżonka (pokazuje duplikaty jeśli osoba ma więcej niż jednego partnera)";
		$text['submitquery'] = "Zatwierdzenie pytania";
		$text['birthplace'] = "Miejsce urodzenia";
		$text['deathplace'] = "Miejsce zgonu";
		$text['birthdatetr'] = "Rok urodzenia";
		$text['deathdatetr'] = "Rok zgonu";
		$text['plusminus2'] = "+/- 2 lata od";
		$text['resetall'] = "Usuń wpisy";
		$text['showdeath'] = "Pokaż informacje o zgonie i pogrzebie";
		$text['altbirthplace'] = "Miejsce chrztu";
		$text['altbirthdatetr'] = "Rok chrztu";
		$text['burialplace'] = "Miejsce pogrzebu";
		$text['burialdatetr'] = "Rok pogrzebu";
		$text['event'] = "Wydarzenie(a)";
		$text['day'] = "Dzień";
		$text['month'] = "Miesiąc";
		$text['keyword'] = "Słowo kluczowe (np. \"ok.\")";
		$text['explain'] = "Podaj składniki daty aby zobaczyć zgodności wydarzeń. Pozostaw pole wolne aby zobaczyć wszystkie zgodności.";
		$text['enterdate'] = "Podaj lub wybierz ostatni z podanych: dzień, miesiąc, rok, słowo kluczowe";
		$text['fullname'] = "Imie i Nazwisko";
		$text['birthdate'] = "Data urodzenia";
		$text['altbirthdate'] = "Data chrztu";
		$text['marrdate'] = "Data ślubu";
		$text['spouseid'] = "ID małżonka";
		$text['spousename'] = "Imię małżonka";
		$text['deathdate'] = "Data zgonu";
		$text['burialdate'] = "Data pogrzebu";
		$text['changedate'] = "Data ostatniej modyfikacji";
		$text['gedcom'] = "Drzewo";
		$text['baptdate'] = "Data chrztu (LDS)";
		$text['baptplace'] = "Miejsce chrztu (LDS)";
		$text['endldate'] = "Data wprowadzenia (LDS)";
		$text['endlplace'] = "Miejsce wprowadzenia (LDS)";
		$text['ssealdate'] = "Data przekazania S (LDS)";	 //Sealed to spouse
		$text['ssealplace'] = "Miejsce przekazania S (LDS)";
		$text['psealdate'] = "Data przekazania P (LDS)";	 //Sealed to parents
		$text['psealplace'] = "Miejsce przekazania P (LDS)";
		$text['marrplace'] = "Miejsce ślubu";
		$text['spousesurname'] = "Nazwisko małżonka";
		$text['spousemore'] = "Jeżeli podasz nazwisko małżonka, to musisz podać również płeć.";
		$text['plusminus5'] = "+/- 5 lat od";
		$text['exists'] = "istnieje";
		$text['dnexist'] = "nie istnieje";
		$text['divdate'] = "Data rozwodu";
		$text['divplace'] = "Miejsce rozwodu";
		$text['otherevents'] = "Inne wydarzenia";
		$text['numresults'] = "Wyników na stronę";
		$text['mysphoto'] = "Zagadkowe zdjęcia";
		$text['mysperson'] = "Zagadkowe osoby";
		$text['joinor'] = "Opcja 'Łączenie argumentów LUB' nie może być użyta przy nazwiskach małżonków";
		$text['tellus'] = "Powiedz nam co wiesz";
		$text['moreinfo'] = "Więcej informacji:";
		//added in 8.0.0
		$text['marrdatetr'] = "Rok ślubu";
		$text['divdatetr'] = "Rok rozwodu";
		$text['mothername'] = "Nazwisko matki";
		$text['fathername'] = "Nazwisko ojca";
		$text['filter'] = "Filter";
		$text['notliving'] = "Nieżyjący";
		$text['nodayevents'] = "Wydarzenia w tym miesiącu nie związane z konkretną datą:";
		//added in 9.0.0
		$text['csv'] = "Format pliku CSV (wartości rozdzielone przecinkami)";
		//added in 10.0.0
		$text['confdate'] = "Data konfirmacji (LDS)";
		$text['confplace'] = "Miejsce konfirmacji (LDS)";
		$text['initdate'] = "Data inicjacji (LDS)";
		$text['initplace'] = "Miejsce inicjacji (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Rodzaj ślubu";
		$text['searchfor'] = "Szukaj";
		$text['searchnote'] = "Uwaga: Ta strona korzysta z wyszukiwarki Google. Ilość trafień zależy od zaindeksowania przez Google."; 
	break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Logi dla";
		$text['mostrecentactions'] = "ostatnich operacji";
		$text['autorefresh'] = "Autoodświeżanie (30 sekund)";
		$text['refreshoff'] = "Wyłącz autoodświeżanie";
	break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cmentarze i nagrobki";
		$text['showallhsr'] = "Pokaż wszystkie nagrobki";
		$text['in'] = "w";
		$text['showmap'] = "Pokaż mapę";
		$text['headstonefor'] = "Nagrobek dla";
		$text['photoof'] = "Zdjęcie";
		$text['photoowner'] = "Właściciel/źródło";
		$text['nocemetery'] = "Brak cmentarza";
		$text['iptc005'] = "Tytuł";
		$text['iptc020'] = "Dodatkowe kategorie";
		$text['iptc040'] = "Specjalne instrukcje";
		$text['iptc055'] = "Data utworzenia";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Pozycja autora";
		$text['iptc090'] = "Miejscowość";
		$text['iptc095'] = "Województwo";
		$text['iptc101'] = "Kraj";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Artykuł";
		$text['iptc110'] = "Źródło";
		$text['iptc115'] = "Źródło zdjęcia";
		$text['iptc116'] = "Prawa autorskie";
		$text['iptc120'] = "Tytuł";
		$text['iptc122'] = "Autor";
		$text['mapof'] = "Mapa";
		$text['regphotos'] = "Pokaż z opisami";
		$text['gallery'] = "Tylko miniatury";
		$text['cemphotos'] = "Zdjęcia cmentarza";
		$text['photosize'] = "Wymiary";
		$text['iptc010'] = "Priorytet";
		$text['filesize'] = "Rozmiar pliku";
		$text['seeloc'] = "Zobacz lokalizację";
		$text['showall'] = "Pokaż wszystko";
		$text['editmedia'] = "Edytuj media";
		$text['viewitem'] = "Widok tej pozycji";
		$text['editcem'] = "Edytuj cmentarz";
		$text['numitems'] = "# pozycji";
		$text['allalbums'] = "Liczba albumów";
		$text['slidestop'] = "Wstrzymaj przegląd slajdów";
		$text['slideresume'] = "Zakończ przegląd slajdów";
		$text['slidesecs'] = "Sekundy dla każdego slajdu:";
		$text['minussecs'] = "minus 0.5 sekundy";
		$text['plussecs'] = "plus 0.5 sekundy";
		$text['nocountry'] = "Nieznany kraj";
		$text['nostate'] = "Nieznane województwo (stan)";
		$text['nocounty'] = "Nieznany powiat";
		$text['nocity'] = "Nieznana miejscowość";
		$text['nocemname'] = "Nieznana nazwa cmentarza";
		$text['editalbum'] = "Edycja albumu";
		$text['mediamaptext'] = "<strong>Uwaga:</strong> Podczas przesuwania kursora myszy po zdjęciu będą się pokazywać nazwiska. Klikając na wybrane otrzymasz bardziej szczegółowe informacje.";
		//added in 8.0.0
		$text['allburials'] = "Liczba pogrzebów";
		$text['moreinfo'] = "Więcej informacji:";
		//added in 9.0.0
				$text['iptc025'] =	"Słowa kluczowe";
				$text['iptc092'] =	"Dokładne miejsce wykonania zdjęcia";
				$text['iptc015'] =	"Kategoria";
				$text['iptc065'] =	"Wykorzystany program graficzny";
				$text['iptc070'] =	"Wersja programu";
		//added in 13.0
		$text['toggletags'] = "Przełącz znaczniki";
	break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Pokaż nazwiska na literę";
		$text['showtop'] = "Pokaż";
		$text['showallsurnames'] = "Pokaż wszystkie nazwiska";
		$text['sortedalpha'] = "sortuj alfabetycznie";
		$text['byoccurrence'] = "najczęściej występujących";
		$text['firstchars'] = "Pierwsze litery";
		$text['mainsurnamepage'] = "Strona główna nazwisk";
		$text['allsurnames'] = "Wszystkie nazwiska";
		$text['showmatchingsurnames'] = "Kliknij na nazwisko, aby zobaczyć wszystkie dane.";
		$text['backtotop'] = "Wróć do głównych";
		$text['beginswith'] = "Rozpoczyna się na";
		$text['allbeginningwith'] = "Wszystkie nazwiska zaczynające się na";
		$text['numoccurrences'] = "liczba wystąpień w nawiasie";
		$text['placesstarting'] = "Zaczynaj od najczęściej występujących miejsc";
		$text['showmatchingplaces'] = "<font color='brown'><b>Kliknij na jedną ze znalezionych pozycji, aby ograniczyć pole wyszukiwań. Kliknij na ikonę lupki, aby zobaczyć szczegóły.</b></font>";
		$text['totalnames'] = "Liczba osób";
		$text['showallplaces'] = "Pokaż wszystkie miejsca";
		$text['totalplaces'] = "Liczba miejsc";
		$text['mainplacepage'] = "Strona główna miejsc";
		$text['allplaces'] = "Najczęstsze miejsca";
		$text['placescont'] = "Pokaż wszystkie miejsca zawierające ";
		//changed in 8.0.0
		$text['top30'] = "xxx najczęściej występujących nazwisk";
		$text['top30places'] = "xxx najczęściej występujących lokalizacji";
		//added in 12.0.0
		$text['firstnamelist'] = "Lista imion";
		$text['firstnamesstarting'] = "Imiona zaczynające się od";
		$text['showallfirstnames'] = "Wszystkie imiona";
		$text['mainfirstnamepage'] = "Główna strona imion";
		$text['allfirstnames'] = "Imiona";
		$text['showmatchingfirstnames'] = "Kliknij na Imię, aby wyświetlić pasujące zapisy.";
		$text['allfirstbegwith'] = "Wszystkie imiona zaczynające się na";
		$text['top30first'] = "Pierwsze xxx imion";
		$text['allothers'] = "Inne";
		$text['amongall'] = "(wśród wszystkich imion)";
		$text['justtop'] = "Tylko pierwsze xxx";
	break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(ostatnie xx dni)";

		$text['photo'] = "Zdjęcie";
		$text['history'] = "Historia/Dokument";
		$text['husbid'] = "ID męża";
		$text['husbname'] = "Nazwisko męża";
		$text['wifeid'] = "ID żony";
		//added in 11.0.0
		$text['wifename'] = "Nazwisko matki";
	break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Usuń";
		$text['addperson'] = "Dodaj osobę";
		$text['nobirth'] = "Ta osoba nie może zostać dodana ponieważ brakuje jej daty urodzin";
		$text['event'] = "Wydarzenie(a)";
		$text['chartwidth'] = "Szerokość diagramu";
		$text['timelineinstr'] = "Dodaj osobę";
		$text['togglelines'] = "Rysuj linie";
		//changed in 9.0.0
		$text['noliving'] = "Ta osoba jest zaznaczona jako żyjąca i nie może zostać dodana, ponieważ nie jesteś do tego uprawniony/a";
	break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Przeglądaj wszystkie drzewa";
		$text['treename'] = "Drzewo";
		$text['owner'] = "Właściciel";
		$text['address'] = "Adres";
		$text['city'] = "Miejscowość";
		$text['state'] = "Województwo.";
		$text['zip'] = "Kod pocztowy";
		$text['country'] = "Kraj";
		$text['email'] = "Adres e-mail";
		$text['phone'] = "Telefon";
		$text['username'] = "Nazwa użytkownika (login)";
		$text['password'] = "Hasło";
		$text['loginfailed'] = "Logowanie nie powiodło się.";
		$text['regnewacct'] = "Rejestracja nowego użytkownika";
		$text['realname'] = "Nazwisko i imię";
		$text['phone'] = "Telefon";
		$text['email'] = "Adres e-mail";
		$text['address'] = "Adres";
		$text['acctcomments'] = "Uwagi i komentarze";
		$text['submit'] = "Zapisz";
		$text['leaveblank'] = "(pozostaw puste jeśli chodzi o nowe drzewo i wypełnij kolejne pole)";
		$text['required'] = "Pola wymagane";
		$text['enterpassword'] = "Podaj hasło";
		$text['enterusername'] = "Podaj nazwę użytkownika";
		$text['failure'] = "Przepraszamy - ta nazwa użytkownika jest zajęta. Kliknij przycisk Wstecz w przeglądarce, aby powrócić do rejestracji i wybrać inną nazwę.";
		$text['success'] = "Dziękujemy. Twoje dane zostały zarejestrowane. Skontaktujemy się z Tobą po aktywacji Twojego konta lub jeśli będziemy potrzebowali dalszych informacji.";
		$text['emailsubject'] = "W TNG zarejestrował się nowy użytkownik";
		$text['website'] = "Strona www";
		$text['nologin'] = "Nie masz Nazwy użytkownika?";
		$text['loginsent'] = "Informacja została wysłana";
		$text['loginnotsent'] = "Informacja nie została wysłana";
		$text['enterrealname'] = "Podaj prawdziwe nazwisko i imię.";
		$text['rempass'] = "Pozostań zalogowany";
		$text['morestats'] = "Więcej statystyk";
		$text['accmail'] = "<strong>UWAGA:</strong> Aby otrzymać pocztę od administratora dotyczącą Twego konta upewnij się, że ta domena nie jest przez Ciebie blokowana <br/>(czy wiadomość nie zostanie potraktowana jako spam).";
		$text['newpassword'] = "Nowe hasło";
		$text['resetpass'] = "Zmień hasło";
		$text['nousers'] = "Ta forma nie może zostać użyta dla co najmniej jednego istniejącego zapisu użytkownika. Jeśli ty jesteś właścicielem strony, przejdź do Administracja / Użytkownicy, by utworzyć Twoje konto administratora.";
		$text['noregs'] = "Niestety aktualnie nie przyjmujemy rejestracji nowych użytkowników. W przypadku pytań lub uwag dotyczących tej strony prosimy o <a href=\"suggest.php\">kontakt</a>.";
		$text['emailmsg'] = "Otrzymałeś wniosek o założenie konta dla nowego użytkownika. Zaloguj się na konto administratora i nadaj mu odpowiednie uprawnienia.";
		$text['accactive'] = "Konto zostało aktywowane, ale użytkownik nie ma uprawnień dopóki nie zostaną mu nadane.";
		$text['accinactive'] = "Idź do Administracja/Użytkownicy/Przegląd sugestii aby uruchomić ustawienia konta. Konto będzie nieaktywne do czasu, aż zostanie edytowane lub, przynajmniej raz, zachowane.";
		$text['pwdagain'] = "Hasło ponownie";
		$text['enterpassword2'] = "Proszę wpisać hasło ponownie.";
		$text['pwdsmatch'] = "Wpisane hasła są różne. Proszę wpisać to samo hasło w każdym polu.";
		$text['acksubject'] = "Dziękujmy za zarejestrowanie się"; //for a new user account
		$text['ackmessage'] = "Konto zostanie aktywowane po zatwierdzeniu przez Administratora. Zostaniesz o tym powiadomiony mailem.";
		//added in 12.0.0
		$text['switch'] = "Zmień";
		//added in 14.0
		$text['newpassword2'] = "Nowe hasło ponownie";
		$text['resetsuccess'] = "Sukces: hasło zostało zresetowane";
		$text['resetfail'] = "Błąd: hasło nie zostało zresetowane";
		$text['failreason0'] = " (nieznany błąd bazy danych)";
		$text['failreason2'] = " (nie masz uprawnień do zmiany hasła)";
		$text['failreason3'] = " (podane hasło nie zgadza się)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Przeglądaj wszystkie gałęzie";
	break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Liczba";
		$text['totindividuals'] = "Osoby";
		$text['totmales'] = "Mężczyźni";
		$text['totfemales'] = "Kobiety";
		$text['totunknown'] = "Osoby nieznanej płci";
		$text['totliving'] = "Żyjący";
		$text['totfamilies'] = "Rodziny";
		$text['totuniquesn'] = "Unikalne nazwiska";
		//$text['totphotos'] = "Zdjęcia";
		//$text['totdocs'] = "Historie i Dokumenty";
		//$text['totheadstones'] = "Nagrobki";
		$text['totsources'] = "Źródła";
		$text['avglifespan'] = "Średnia długość życia";
		$text['earliestbirth'] = "Najwcześniej urodzony/a";
		$text['longestlived'] = "Najstarsi zmarli";
		$text['days'] = "dni";
		$text['age'] = "wiek";
		$text['agedisclaimer'] = "Obliczenia wieku dotycza tylko osób z podanymi datami urodzenia <EM><B>oraz</B></EM> zgonu.	Przy niepełnych datach (np. data ur. podana jako \"1945\" lub \"JAN 1860\") obliczenia są mniej dokładne.";
		$text['treedetail'] = "Więcej informacji o tym drzewie";
		$text['total'] = "Razem";
		//added in 12.0
		$text['totdeceased'] = "Zmarli";
		//added in 14.0
		$text['totalsourcecitations'] = "Liczba odwołań do źródeł";
	break;

	case "notes":
		$text['browseallnotes'] = "Przeglądaj przypisy";
	break;

	case "help":
		$text['menuhelp'] = "Menu pomocy";
	break;

	case "install":
		$text['perms'] = "Uprawnienia zostały nadane.";
		$text['noperms'] = "Tym plikom nie mogą zostać nadane uprawnienia:";
		$text['manual'] = "Proszę ustawić je ręcznie.";
		$text['folder'] = "Folder";
		$text['created'] = "zostały utworzone";
		$text['nocreate'] = "nie można utworzyć. Proszę utworzyć go ręcznie.";
		$text['infosaved'] = "Informacje zapisane, połączenie sprawdzone!";
		$text['tablescr'] = "Tabele zostały utworzone!";
		$text['notables'] = "Następujące tabele nie mogły zostać utworzone:";
		$text['nocomm'] = "TNG nie może skomunikować się z bazą danych. Tabele nie zostały utworzone.";
		$text['newdb'] = "Informacje zapisane, sprawdzone połączenie, nowa baza danych utworzona:";
		$text['noattach'] = "Informacje zapisane. Połączenia wykonane i uaktualniona baza danych, ale TNG nie może do niej dołączyć.";
		$text['nodb'] = "Informacje zapisane. Połączenie wykonane, ale baza danych nie istnieje i nie może zostać utworzona. Proszę sprawdzić, czy nazwa bazy danych jest poprawna, lub użyć panelu sterowania, aby ją utworzyć.";
		$text['noconn'] = "Informacje zapisane, ale połączenie nie powiodło się. Jeden lub więcej z następujących jest nieprawidłowy:";
		$text['exists'] = "istnieje";
		$text['noop'] = "Żadna operacja nie została wykonana.";
		//added in 8.0.0
		$text['nouser'] = "Użytkownik nie został utworzony. Przypuszczalnie już istnieje.";
		$text['notree'] = "Drzewo nie zostało utworzone. ID drzewa przypuszczalnie istnieje.";
		$text['infosaved2'] = "Informacja zapisana";
		$text['renamedto'] = "zmieniono nazwę na";
		$text['norename'] = "nazwa nie może być zmieniona";
		//changed in 13.0.0
		$text['loginfirst'] = "Wykryto istniejące rekordy użytkowników. Aby kontynuować, zaloguj się lub usuń wszystkie rekordy z tabeli użytkowników.";
	break;

	case "imgviewer":
		$text['magmode'] = "Moduł powiększenia";
		$text['panmode'] = "Moduł przesunięcia";
		$text['pan'] = "Kliknij i przeciągnij, aby przesunąć grafikę";
		$text['fitwidth'] = "Dopasuj szerokość";
		$text['fitheight'] = "Dopasuj wysokość";
		$text['newwin'] = "Nowe okno";
		$text['opennw'] = "Otwórz grafikę w nowym oknie";
		$text['magnifyreg'] = "Kliknij, aby powiększyć wybrany obszar grafiki";
		$text['imgctrls'] = "Umożliwienie kontroli obrazu";
		$text['vwrctrls'] = "Umożliwienie kontroli przeglądarki grafiki";
		$text['vwrclose'] = "Zamknij przeglądarkę grafiki";
	break;

	case "dna":
		$text['test_date'] = "Data testu";
		$text['links'] = "Ważne linki";
		$text['testid'] = "ID testu";
		//added in 12.0.0
		$text['mode_values'] = "Wartości średnie (Mod)";
		$text['compareselected'] = "Porównaj Wybrane";
		$text['dnatestscompare'] = "Porównaj testy Y-DNA";
		$text['keep_name_private'] = "Zachowaj prywatność";
		$text['browsealltests'] = "Przeglądaj Wszystkie Testy";
		$text['all_dna_tests'] = "Wszystkie testy DNA";
		$text['fastmutating'] = "Szybko mutujące";
		$text['alltypes'] = "Rodzaje";
		$text['allgroups'] = "Grupy";
		$text['Ydna_LITbox_info'] = "Testy powiązane z tą osobą niekoniecznie zostały wykonane przez tę osobę.<br />Kolumna 'Haplogroup' wyświetla dane na czerwono, jeśli wynik jest 'Przewidywany' lub na zielono jeśli test jest 'Potwierdzony'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Porównaj wybrane testy mtDNA";
		$text['dnatestscompare_atdna'] = "Porównaj wybrane testy atDNA";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Sekw.";
		$text['extra_mutations'] = "Ekstra mutacje";
		$text['mrca'] = "Przodek MRC";
		$text['ydna_test'] = "Testy Y-DNA";
		$text['mtdna_test'] = "Testy mtDNA (Mitochondrialne)";
		$text['atdna_test'] = "Testy atDNA (autosomalne)";
		$text['segment_start'] = "Początek";
		$text['segment_end'] = "Koniec";
		$text['suggested_relationship'] = "Sugerowane";
		$text['actual_relationship'] = "Aktualne";
		$text['12markers'] = "Markery 1-12";
		$text['25markers'] = "Markery 13-25";
		$text['37markers'] = "Markery 26-37";
		$text['67markers'] = "Markery 38-67";
		$text['111markers'] = "Markery 68-111";
		//added in 13.1
		$text['comparemore'] = "Do porównania należy wskazać przynajmniej dwa testy.";
	break;
}

//common
$text['matches'] = "Wyniki";
$text['description'] = "Opis";
$text['notes'] = "Przypisy";
$text['status'] = "Status";
$text['newsearch'] = "Nowe szukanie";
$text['pedigree'] = "Rodowód";
$text['seephoto'] = "Zobacz zdjęcie";
$text['andlocation'] = "&amp; położenie";
$text['accessedby'] = "odwiedzone przez";
$text['family'] = "Rodzina"; //from getperson
$text['children'] = "Dzieci"; //from getperson
$text['tree'] = "Drzewo";
$text['alltrees'] = "Wszystkie drzewa";
$text['nosurname'] = "[bez nazwiska]";
$text['thumb'] = "Miniatura";	//as in Thumbnail
$text['people'] = "Osoby";
$text['title'] = "Tytuł";	//from getperson
$text['suffix'] = "Suffix";	//from getperson
$text['nickname'] = "Przydomek";	//from getperson
$text['lastmodified'] = "Ostatnia modyfikacja";	//from getperson
$text['married'] = "Ślub";	//from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nazwisko"; //from showmap
$text['lastfirst'] = "Nazwisko, imię";	//from search
$text['bornchr'] = "Data urodzenia/chrztu";	//from search
$text['individuals'] = "Osoby";	//from whats new
$text['families'] = "Rodziny";
$text['personid'] = "ID osoby";
$text['sources'] = "Źródła";	//from getperson (next several)
$text['unknown'] = "Nieznane";
$text['father'] = "Ojciec";
$text['mother'] = "Matka";
$text['christened'] = "Chrzest";
$text['died'] = "Zgon";
$text['buried'] = "Pochówek";
$text['spouse'] = "Małżonek";	//from search
$text['parents'] = "Rodzice";	//from pedigree
$text['text'] = "Tekst";	//from sources
$text['language'] = "Język";	//from languages
$text['descendchart'] = "Diagram potomków";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Osoba";
$text['edit'] = "Edycja";
$text['date'] = "Data";
$text['login'] = "Zaloguj się";
$text['logout'] = "Wyloguj się";
$text['groupsheet'] = "Arkusz rodzinny";
$text['text_and'] = "oraz";
$text['generation'] = "Pokolenie";
$text['filename'] = "Nazwa pliku";
$text['id'] = "ID";
$text['search'] = "Szukaj";
$text['user'] = "Użytkownik";
$text['firstname'] = "Imię";
$text['lastname'] = "Nazwisko";
$text['searchresults'] = "Wyniki wyszukiwania";
$text['diedburied'] = "Zmarł/Poch.";
$text['homepage'] = "Strona główna";
$text['find'] = "Znajdź...";
$text['relationship'] = "Sprawdź pokrewieństwo";		//in German, Verwandtschaft
$text['relationship2'] = "Typ relacji"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Linia czasu";
$text['yesabbr'] = "T";							 //abbreviation for 'yes'
$text['divorced'] = "Rozwód";
$text['indlinked'] = "Dotyczy";
$text['branch'] = "Gałąź";
$text['moreind'] = "Więcej osób";
$text['morefam'] = "Więcej rodzin";
$text['surnamelist'] = "Lista nazwisk";
$text['generations'] = "Pokolenia";
$text['refresh'] = "Odśwież";
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
$text['type'] = "Rodzaj";
$text['savechanges'] = "Zapisz zmiany";
$text['familyid'] = "ID rodziny";
$text['headstone'] = "Nagrobki";
$text['historiesdocs'] = "Historie";
$text['anonymous'] = "anonimowy";
$text['places'] = "Miejsca";
$text['anniversaries'] = "Daty i rocznice";
$text['administration'] = "Administracja";
$text['help'] = "Pomoc";
//$text['documents'] = "Dokumenty";
$text['year'] = "rok";
$text['all'] = "Wszystko";
$text['address'] = "Adres";
$text['suggest'] = "Sugestie";
$text['editevent'] = "Sugestia zmiany dla tego wydarzenia";
$text['morelinks'] = "Więcej łączy";
$text['faminfo'] = "Informacja o rodzinie";
$text['persinfo'] = "Info o osobie";
$text['srcinfo'] = "Informacje o źródle";
$text['fact'] = "Zdarzenie";
$text['goto'] = "Wybierz stronę";
$text['tngprint'] = "Drukuj";
$text['databasestatistics'] = "Statystyki"; //needed to be shorter to fit on menu
$text['child'] = "Dziecko";	//from familygroup
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
$text['gender'] = "Płeć";
$text['latitude'] = "Szerokość";
$text['longitude'] = "Długość";
$text['bookmarks'] = "Zakładki";
$text['bookmark'] = "Dodaj zakładkę";
$text['mngbookmarks'] = "Idź do zakładek";
$text['bookmarked'] = "Zakładka dodana";
$text['remove'] = "Usuń";
$text['find_menu'] = "Znajdź";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cmentarz";
$text['gmapevent'] = "Mapa wydarzeń";
$text['gevents'] = "Wydarzenie";
$text['googleearthlink'] = "Łącze do Google Earth";
$text['googlemaplink'] = "Łącze do Google Maps";
$text['gmaplegend'] = "Legenda szpilek";
$text['unmarked'] = "Nieoznakowany";
$text['located'] = "Zlokalizowany";
$text['albclicksee'] = "Kliknij aby pokazać wszystkie elementy tego albumu";
$text['notyetlocated'] = "Jeszcze nie zlokalizowany";
$text['cremated'] = "Skremowany";
$text['missing'] = "Zaginiony";
$text['pdfgen'] = "Generator PDF";
$text['blank'] = "Pusty diagram";
$text['fonts'] = "Czcionki";
$text['header'] = "Nagłówek";
$text['data'] = "Data";
$text['pgsetup'] = "Ustawienia strony";
$text['pgsize'] = "Wielkość strony";
$text['orient'] = "Orientacja strony"; //for a page
$text['portrait'] = "Format pionowy";
$text['landscape'] = "Format poziomy";
$text['tmargin'] = "Górna krawędź";
$text['bmargin'] = "Dolna krawędź";
$text['lmargin'] = "Lewa krawędź";
$text['rmargin'] = "Prawa krawędź";
$text['createch'] = "Tworzenie diagramu";
$text['prefix'] = "Prefiks";
$text['mostwanted'] = "Niewyjaśnione zagadki";
$text['lastupdates'] = "Ostatnio aktualizowane";
$text['featphoto'] = "Losowo wybrane zdjęcie";
$text['news'] = "Nowości";
$text['ourhist'] = "Historia naszej rodziny";
$text['ourhistanc'] = "Historia i genealogia naszej rodziny";
$text['ourpages'] = "Strona genealogiczna naszej rodziny";
$text['pwrdby'] = "Strona www oparta jest na systemie";
$text['writby'] = "";
$text['searchtngnet'] = "Szukaj w TNG Network (GENDEX)";
$text['viewphotos'] = "Zobacz wszystkie zdjęcia";
$text['anon'] = "Jesteś w tej chwili anonimowy";
$text['whichbranch'] = "Do której gałęzi należysz?";
$text['featarts'] = "Przedstawione artykuły";
$text['maintby'] = "Administrator: ";
$text['createdon'] = "Utworzono dnia";
$text['reliability'] = "Pewność";
$text['labels'] = "Etykiety";
$text['inclsrcs'] = "Dołącz źródła";
$text['cont'] = "(c.d.)"; //abbreviation for continued
$text['mnuheader'] = "Strona startowa";
$text['mnusearchfornames'] = "Szukaj";
$text['mnulastname'] = "Nazwisko";
$text['mnufirstname'] = "Imię";
$text['mnusearch'] = "Szukaj";
$text['mnureset'] = "Zacznij ponownie";
$text['mnulogon'] = "Zaloguj się";
$text['mnulogout'] = "Wyloguj się";
$text['mnufeatures'] = "Inne opcje";
$text['mnuregister'] = "Rejestracja<br/>nowego<br/>użytkownika";
$text['mnuadvancedsearch'] = "Wyszukiwanie zaawansowane";
$text['mnulastnames'] = "Nazwiska";
$text['mnustatistics'] = "Statystyki";
$text['mnuphotos'] = "Zdjęcia";
$text['mnuhistories'] = "Historie";
$text['mnumyancestors'] = "Zdjęcia &amp; Historie przodków [osoba]";
$text['mnucemeteries'] = "Lista cmentarzy";
$text['mnutombstones'] = "Nagrobki";
$text['mnureports'] = "Raporty";
$text['mnusources'] = "Źródła";
$text['mnuwhatsnew'] = "Co nowego";
$text['mnushowlog'] = "Log użytkowników";
$text['mnulanguage'] = "Language<br/>(Zmiana języka)";
$text['mnuadmin'] = "Administracja";
$text['welcome'] = "Zalogowany: ";
$text['contactus'] = "Kontakt";
//changed in 8.0.0
$text['born'] = "Urodz.";
$text['searchnames'] = "Szukaj";
//added in 8.0.0
$text['editperson'] = "Edytuj osobę";
$text['loadmap'] = "Załaduj mapę";
$text['birth'] = "Urodz.";
$text['wasborn'] = "urodzony(a)";
$text['startnum'] = "Pierwsza liczba";
$text['searching'] = "Szukanie";
//moved here in 8.0.0
$text['location'] = "Lokalizacja";
$text['association'] = "Relacja";
$text['collapse'] = "Zwiń";
$text['expand'] = "Rozwiń";
$text['plot'] = "Sektor";
$text['searchfams'] = "Szukaj rodzinę";
//added in 8.0.2
$text['wasmarried'] = "poślubił(a)";
$text['anddied'] = "Zgon";
//added in 9.0.0
$text['share'] = "Udostępnij";
$text['hide'] = "Ukryj";
$text['disabled'] = "Twoje konto zostało zablokowane. Prosimy o kontakt z administratorem serwisu w celu uzyskania więcej informacji.";
$text['contactus_long'] = "Jeśli masz jakieś pytania lub komentarze dotyczące informacji na tej stronie, prosimy o <span class=\"emphasis\"><a href=\"suggest.php\">kontakt</a></span>.";
$text['features'] = "Nowości";
$text['resources'] = "Zasoby";
$text['latestnews'] = "Aktualności";
$text['trees'] = "Drzewa genealogiczne";
$text['wasburied'] = "pochowany";
//moved here in 9.0.0
$text['emailagain'] = "Adres mail ponownie";
$text['enteremail2'] = "Wpisz swój adres e-mail ponownie.";
$text['emailsmatch'] = "Podane maile nie zgadzają się. Wpisz ten sam adres email w obu polach.";
$text['getdirections'] = "Kliknij aby uzyskac wskazówki";
$text['calendar'] = "Kalendarz";
//changed in 9.0.0
$text['directionsto'] = " do ";
$text['slidestart'] = "Pokaz slajdów";
$text['livingnote'] = "Szczegóły nie są dostępne, ponieważ ten przypis jest związany z co najmniej jedną żyjącą lub prywatną osobą";
$text['livingphoto'] = "Szczegóły nie są dostępne, ponieważ ten obiekt jest związany z co najmniej jedną żyjącą lub prywatną osobą";
$text['waschristened'] = "Chrzest";
//added in 10.0.0
$text['branches'] = "Gałęzie";
$text['detail'] = "Szczegółowo";
$text['moredetail'] = "Więcej szczegółów";
$text['lessdetail'] = "Mniej szczegółów";
$text['conflds'] = "Konfirmacja (LDS)";
$text['initlds'] = "Inicjacja (LDS)";
$text['wascremated'] = "kremacja";
//moved here in 11.0.0
$text['text_for'] = "dla";
//added in 11.0.0
$text['searchsite'] = "Przeszukaj tę stronę";
$text['searchsitemenu'] = "Szukaj strony";
$text['kmlfile'] = "Pobierz plik .kml aby pokazać tę lokalizację w Google Earth";
$text['download'] = "Kliknij aby pobrać";
$text['more'] = "Więcej";
$text['heatmap'] = "\"Heat Map\"";
$text['refreshmap'] = "Odśwież mapę";
$text['remnums'] = "Usuń liczby i zaznaczenia";
$text['photoshistories'] = "Zdjęcia &amp; Historie";
$text['familychart'] = "Wykres rodzinny";
//added in 12.0.0
$text['firstnames'] = "Imiona";
//moved here in 12.0.0
$text['dna_test'] = " Test DNA";
$text['test_type'] = "Rodzaj testu";
$text['test_info'] = "Informacja dotycząca testu";
$text['takenby'] = "Laboratorium";
$text['haplogroup'] = "Haplogrupa";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Powiązane linki";
$text['nofirstname'] = "[brak imienia]";
//added in 12.0.1
$text['cookieuse'] = "Uwaga: Ta strona używa plików cookie.";
$text['dataprotect'] = "Polityka ochrony danych";
$text['viewpolicy'] = "Zobacz zasady ochrony danych";
$text['understand'] = "Rozumiem";
$text['consent'] = "Wyrażam zgodę dla tej witryny na przechowywanie tu podanych danych osobowych. Rozumiem, że mogę poprosić właściciela witryny o usunięcie tych informacji w dowolnym momencie.";
$text['consentreq'] = "Proszę o wyrażenie zgody na przechowywanie danych osobowych w tej witrynie.";

//added in 12.1.0
$text['testsarelinked'] = "Testy DNA są powiązane z";
$text['testislinked'] = "Test DNA jest powiązany z";

//added in 12.2
$text['quicklinks'] = "Szybkie łącza";
$text['yourname'] = "Twoje imię";
$text['youremail'] = "Twój adres e-mail";
$text['liketoadd'] = "Wszelkie informacje, które chcesz dodać";
$text['webmastermsg'] = "Wiadomość dla webmasterów";
$text['gallery'] = "Zobacz galerię";
$text['wasborn_male'] = "urodził się";		// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "urodziła się"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "został ochrzczony";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "została ochrzczona";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "zmarł";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "zmarła";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "został pochowany"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "została pochowana"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "został poddany kremacji";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "została poddana kremacji";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "żonaty";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "zamężna";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "rozwiedziony";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "rozwiedziona";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = "w";			// used as a preposition to the location
$text['onthisdate'] = "";		// when used with full date
$text['inthisyear'] = "";		// when used with year only or month / year dates
$text['and'] = "i";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Informacja dotycząca testu DNA";
//added in 13.0
$text['visitor'] = "Gość";

$text['popupnote2'] = "Nowy rodowód";

//moved here in 14.0
$text['zoomin'] = "Powiększ";
$text['zoomout'] = "Zmniejsz";
$text['scrollnote'] = "Przeciągnij lub przewiń, aby zobaczyć więcej.";
$text['general'] = "Ogólny";

//changed in 14.0
$text['otherevents'] = "Inne zdarzenia i atrybuty zdarzeń";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Powiązania";
$text['continue'] = "Kontynuacja";
$text['title2'] = "Tytuł"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>