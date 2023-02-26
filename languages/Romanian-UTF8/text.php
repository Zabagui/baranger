<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Navigheaza prin toate sursele";
		$text['shorttitle'] = "Titlu scurt";
		$text['callnum'] = "Numar telefon";
		$text['author'] = "Autor";
		$text['publisher'] = "Editor";
		$text['other'] = "Alte informatii";
		$text['sourceid'] = "ID Sursa";
		$text['moresrc'] = "Mai multe surse";
		$text['repoid'] = "ID depozit";
		$text['browseallrepos'] = "Navigheaza prin toate depozitele";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Adauga limba";
		$text['changelanguage'] = "Schimba Limba";
		$text['languagesaved'] = "Limba adaugata";
		$text['sitemaint'] = "Site maintenance in progress";
		$text['standby'] = "The site is temporarily unavailable while we update our database. Please try again in a few minutes. If the site remains down for an extended period of time, please <a href=\"suggest.php\">contact the site owner</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM incepe de la";
		$text['producegedfrom'] = "Creaza un fiser GEDCOM din";
		$text['numgens'] = "Numar de generatii";
		$text['includelds'] = "Informatii cuprins LDS ";
		$text['buildged'] = "Creeaza GEDCOM";
		$text['gedstartfrom'] = "GEDCOM incepe de la";
		$text['nomaxgen'] = "Trebuie sa indica-ti numarul maxim de generatii. Va rugam utiliza-ti butonul Inapoi pentru a revenii la pagina anterioara si a corecta eroarea";
		$text['gedcreatedfrom'] = "GEDCOM creeat de la";
		$text['gedcreatedfor'] = "creat pentru";
		$text['creategedfor'] = "Creeaza GEDCOM";
		$text['email'] = "Adresa email";
		$text['suggestchange'] = "Sugereaza o schimbare";
		$text['yourname'] = "Numele dumneavoastra";
		$text['comments'] = "Note sau comentarii";
		$text['comments2'] = "Comentarii";
		$text['submitsugg'] = "Trimite sugestie";
		$text['proposed'] = "Propune schimbare";
		$text['mailsent'] = "Va multumim. Mesajul dumneavoastra a fost trimis.";
		$text['mailnotsent'] = "Ne pare rau, dar mesajul dumneavoastra nu poate fi livrat.Va rugam contactati xxx direct la yyy.";
		$text['mailme'] = "Trimit o copie la aceasta adresa";
		$text['entername'] = "Va rugam introduceti numele dumneavoastra";
		$text['entercomments'] = "Va rugam introduceti comentariile dumneavoastra";
		$text['sendmsg'] = "Trimite mesaj";
		//added in 9.0.0
		$text['subject'] = "Subject";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Imagini si povestiri/istorioare pentru";
		$text['indinfofor'] = "Informatii personala pentru";
		$text['pp'] = "pag."; //page abbreviation
		$text['age'] = "Varsta";
		$text['agency'] = "Agentie";
		$text['cause'] = "Motiv";
		$text['suggested'] = "Sugerat";
		$text['closewindow'] = "Inchide aceasta fereastra";
		$text['thanks'] = "Va multumim";
		$text['received'] = "Sugestia dumneavoastra a fost trimisa la administratorii site-ului pentru verificare.";
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
		$text['relcalc'] = "Calculator rudenie";
		$text['findrel'] = "Gaseste rudenie";
		$text['person1'] = "Persoana 1:";
		$text['person2'] = "Persoana 2:";
		$text['calculate'] = "Calculeaza";
		$text['select2inds'] = "Selectează te rog  doi indivizi.";
		$text['findpersonid'] = "Gaseste ID persoana";
		$text['enternamepart'] = "introduceti partial prenumele si/sau numele familie";
		$text['pleasenamepart'] = "Va rugam introduceti o parte din prenume sau numele de familie.";
		$text['clicktoselect'] = "Apasa sa selectezi";
		$text['nobirthinfo'] = "Fara informatii nastere";
		$text['relateto'] = "Rudenie lui";
		$text['sameperson'] = "Chi dot indivisible sent aceeași persoană.";
		$text['notrelated'] = "Doua persoane nu sunt inrudita pana la xxx generatii."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Afisare relatii intre doua persoane, utilizeaza 'gasire' butoaneele de mai jos la localizare indivizi (sau pastreaza persoana afisata), si apasati 'Calculare'.";
		$text['sometimes'] = "(Cateodată căutând asupra numărului diferit de generații afișează un rezultat diferit.)";
		$text['findanother'] = "Gaseste alta rudenie";
		$text['brother'] = "fratele lui";
		$text['sister'] = "sora lui";
		$text['sibling'] = "sotul lui";
		$text['uncle'] = "unchi de gradul xxx al lui";
		$text['aunt'] = "matusa de gradul xxx al lui";
		$text['uncleaunt'] = "unchiul/matusa de gradul xxx al lui";
		$text['nephew'] = "nepotul de gradul xxx a lui";
		$text['niece'] = "nepoata de gradul xxx a lui";
		$text['nephnc'] = "nepotul/nepoata xxx lui";
		$text['removed'] = "timpuri sterse";
		$text['rhusband'] = "sotul lui ";
		$text['rwife'] = "sotia lui ";
		$text['rspouse'] = "soti lui ";
		$text['son'] = "fiul lui";
		$text['daughter'] = "sora lui";
		$text['rchild'] = "copii lui";
		$text['sil'] = "ginerele lui";
		$text['dil'] = "nora lui";
		$text['sdil'] = "ginere sau nora lui";
		$text['gson'] = "nepotul xxx lui";
		$text['gdau'] = "nepoata xxx lui";
		$text['gsondau'] = "nepotul/nepoata xxx lui";
		$text['great'] = "stra";
		$text['spouses'] = "sunt soti";
		$text['is'] = "este";
		$text['changeto'] = "Schimba la (introduceti ID-ul):";
		$text['notvalid'] = "nu este ID persona valid sau nu exista in baza de date. Va rugam incercati din nou.";
		$text['halfbrother'] = "the half brother of";
		$text['halfsister'] = "the half sister of";
		$text['halfsibling'] = "the half sibling of";
		//changed in 8.0.0
		$text['gencheck'] = "Maxim generatii <br />verificate";
		$text['mcousin'] = "varul de gradul xxx a yyy lui";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "vara de gradul xxx a yyy lui";  //female cousin
		$text['cousin'] = "varul de gard xxx a yyy lui";
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
		$text['dospouses2'] = "Arată soții";
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
		$text['ggreat'] = "stra";
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
		$text['pathscalc'] = "Caută după conexiuni";
		$text['findrel2'] = "Caută relații și alte conexiuni";
		$text['makeme2nd'] = "Folosește ID meu";
		$text['usebookmarks'] = "Folosește marcajul meu";
		$text['select2inds'] = "Selectează te rog  doi indivizi.";
		$text['indinfofor'] = "Informații individuale pentru";
		$text['nobookmarks'] = "Nu este maraca de folosit";
		$text['bkmtitle'] = "Persoane găsite în marcaje";
		$text['bkminfo'] = "Selectează o persoană:";
		$text['sortpathsby'] = "Sortati căile după număr de";
		$text['sortbyshort'] = "Filtrează după";
		$text['bylengthshort'] = "Lungime";
		$text['badID1'] = ": bad person1 ID - întoarce și corectează";
		$text['badID2'] = ": bad person2 ID - întoarce și corectează";
		$text['notintree'] = ":Persoana cu acest ID nu este în baza de date.";
		$text['sameperson'] = "Chi dot indivisible sent aceeași persoană.";;
		$text['nopaths'] = "Această persoană nu este conectată.";
		$text['nopaths1'] = "Nu mai sunt conexiuni decāt xxx";
		$text['nopaths2'] = "in xxx etape de căutare";
		$text['longestpath'] = "(Calea cea mai lungă verificată a fost xxx etape)";
		$text['relevantpaths'] = "numărul relevant de căi diferite a fost de: xxx";
		$text['skipMarr'] = "( în  plus, numărul de căi găsit dar nu afișat din cauza prea multelor căsătorii a fost: xxx)";
		$text['mjaor'] = "sau or";
		$text['connectionsto'] = "Conexiuni la ";
		$text['findanotherpers'] = "Găsește altă persoană ...";
		$text['sometimes'] = "(Cateodată căutând asupra numărului diferit de generații afișează un rezultat diferit.)";
		$text['anotherpath'] = "Caută alte conexiuni";
		$text['xpath'] = "Cale";
		$text['primary'] = "Person de pornire ,,notă folosește pantry amândouă Start și End  daca1 textual  fin nu setează"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "End Person";
		$text['parent'] = "Părinte";
		$text['mhfather'] = "his father";
		$text['mhmother'] = "his mother";
		$text['mhhusband'] = "his husband";
		$text['mhwife'] = "his wife";
		$text['mhson'] = "his son";
		$text['mhdaughter'] = "his daughter";
		$text['fhfather'] = "her father";
		$text['fhmother'] = "her mother";
		$text['fhhusband'] = "her husband";
		$text['fhwife'] = "her wife";
		$text['fhson'] = "her son";
		$text['fhdaughter'] = "her daughter";
		$text['hfather'] = "tată";
		$text['hmother'] = "mamă";
		$text['hhusband'] = "soț";
		$text['hwife'] = "soție";
		$text['hson'] = "fiu";
		$text['hdaughter'] = "fiică";
		$text['maxruns'] = "numărul maxim  de căi de verificat";
		$text['maxrshort'] = "Căile maxime";
		$text['maxlength'] = "Căile de conexiune nu mai lungi de";
		$text['maxlshort'] = "Lungimea maximă";
		$text['xstep'] = "Etapă";
		$text['xsteps'] = "Etape";
		$text['xmarriages'] = "xxx căsătorii";
		$text['xmarriage'] = "căsătorie";
		$text['showspouses'] = "Arată ambele soții";
		$text['showTxt'] = "Arată textual căilor descrise";
		$text['showTxtshort'] = "Descriere text";
		$text['compactBox'] = "Arată cutiile persoanei compacte";
		$text['compactBoxshort'] = "Cutii compacte";
		$text['paths'] = "Căile";
		$text['dospouses2'] = "Arată soții";
		$text['maxmopt'] = "Maximum de căsătorii pe conexiune";
		$text['maxm'] = "Maximum de căsătorii";
		$text['arerelated'] = "Aceste persoane sunt rude-relatația lor este în Path 1";
		$text['simplerel'] = "Modul simplu de căutare a rudeniei";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Schema grup familie pentru";
		$text['ldsords'] = "Ordine LDS";
		$text['baptizedlds'] = "Botez (LDS)";
		$text['endowedlds'] = "Endowed (LDS)";
		$text['sealedplds'] = "Casatorie P (LDS)";
		$text['sealedslds'] = "Casatorie S (LDS)";
		$text['otherspouse'] = "Alt sot(ie)";
		$text['husband'] = "Sot";
		$text['wife'] = "Sotie";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "N";
		$text['capaltbirthabbr'] = "A";
		$text['capdeathabbr'] = "D";
		$text['capburialabbr'] = "I";
		$text['capplaceabbr'] = "L";
		$text['capmarrabbr'] = "C";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Reinoit cu";
		$text['unknownlit'] = "Necunoscut";
		$text['popupnote1'] = " = Informati suplimentare";
		$text['pedcompact'] = "Compact";
		$text['pedstandard'] = "Standard";
		$text['pedtextonly'] = "Text";
		$text['descendfor'] = "Urmasi lui";
		$text['maxof'] = "Maxim de";
		$text['gensatonce'] = "generatii afisate odata.";
		$text['sonof'] = "fiul lui";
		$text['daughterof'] = "fiica lui";
		$text['childof'] = "copilul lui";
		$text['stdformat'] = "Format standard";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Adauga familie noua";
		$text['editfam'] = "Editeaza familie";
		$text['side'] = "parte";
		$text['familyof'] = "Familia lui";
		$text['paternal'] = "Din partea tatei";
		$text['maternal'] = "Din partea mamei";
		$text['gen1'] = "Proprie";
		$text['gen2'] = "Parinti";
		$text['gen3'] = "Bunici";
		$text['gen4'] = "Strabunici";
		$text['gen5'] = "Stra strabunici";
		$text['gen6'] = "Strabunici de gradul 3";
		$text['gen7'] = "Strabunici de gradul 4";
		$text['gen8'] = "Strabunici de gradul 5";
		$text['gen9'] = "Strabunici de gradul 6";
		$text['gen10'] = "Strabunici de gradul 7";
		$text['gen11'] = "Strabunici de gradul 8";
		$text['gen12'] = "Strabunici de gradul 9";
		$text['graphdesc'] = "Grafic urmasi din acest punct";
		$text['pedbox'] = "Casuta";
		$text['regformat'] = "Inregistrare";
		$text['extrasexpl'] = "= Macar o imagine, povestire sau alt articol media exista pentru aceasta persoana.";
		$text['popupnote3'] = " = Grafic nou";
		$text['mediaavail'] = "Media disponibil";
		$text['pedigreefor'] = "Arbore genealogic pentru";
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
		$text['dtformat'] = "Tables";
		$text['dtchildren'] = "Copii";
		$text['dtgrandchildren'] = "Nepoți";
		$text['dtggrandchildren'] = "Strănepoți";
		$text['dtgggrandchildren'] = "Great grandchildren"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Niciun descendent";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Total";
		$text['dtselect'] = "Selecteză Select";
		$text['dteachfulltable'] = "Fiecare tabel plin va avea";
		$text['dtrows'] = "rânduri";
		$text['dtdisplayingtable'] = "Afiseaza tabelul";
		$text['dtgototable'] = " Mergi la tabel:";
		$text['fcinstrdn'] = "Arată familia cu soție";
		$text['fcinstrup'] = "Arată familia cu parinți";
		$text['fcinstrplus'] = "Selectează alte soții";
		$text['fcinstrfam'] = "Selectează alți părinți";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Nu exista rapoarte existente.";
		$text['reportname'] = "Nume raport";
		$text['allreports'] = "Toate rapoartele";
		$text['report'] = "Raport";
		$text['error'] = "Eroare";
		$text['reportsyntax'] = "Sintaxa intrebarii rulate cu acest raport";
		$text['wasincorrect'] = "a fost incorecta, si ca rezultat raportul nu poate fi rulat. Va rugam contactati administratorul sistemului la";
		$text['errormessage'] = "Mesaj eroare";
		$text['equals'] = "egalitati";
		$text['endswith'] = "sfarseste cu";
		$text['soundexof'] = "Efecte ";
		$text['metaphoneof'] = "sunet la";
		$text['plusminus10'] = "+/- 10 ani de la";
		$text['lessthan'] = "mai mic ca";
		$text['greaterthan'] = "mai mare ca";
		$text['lessthanequal'] = "mai mic sau egal cu";
		$text['greaterthanequal'] = "mai mare sau egal cu";
		$text['equalto'] = "egal cu";
		$text['tryagain'] = "Va rugam incercati din nou";
		$text['joinwith'] = "Alaturate cu";
		$text['cap_and'] = "SI";
		$text['cap_or'] = "SAU";
		$text['showspouse'] = "Afiseaza soti (va afisa duplicate daca persoana are mai mult de un sot)";
		$text['submitquery'] = "Trimite cerere";
		$text['birthplace'] = "Loc nastere";
		$text['deathplace'] = "Loc deces";
		$text['birthdatetr'] = "An nastere";
		$text['deathdatetr'] = "An deces";
		$text['plusminus2'] = "+/- 2 ani de la";
		$text['resetall'] = "Reseteaza toate valorile";
		$text['showdeath'] = "Afiseaza informatii deces/inmormantare";
		$text['altbirthplace'] = "Loc botez";
		$text['altbirthdatetr'] = "An botez";
		$text['burialplace'] = "Loc inmormantare";
		$text['burialdatetr'] = "An inmormantare";
		$text['event'] = "Eveniment(e)";
		$text['day'] = "zi";
		$text['month'] = "luna";
		$text['keyword'] = "Cuvant cheie (ie, \"Abt\")";
		$text['explain'] = "Introduceti datele componenente pentru a vedea evenimentele care corespund. Lasa acest camp necompletata pentru a vedea potriviri pentru toate.";
		$text['enterdate'] = "Va rugam introduceti sau selectati cel putin una dintre urmatoarele: zi, luna, an, cuvant cheie";
		$text['fullname'] = "Nume complet";
		$text['birthdate'] = "Data nastere";
		$text['altbirthdate'] = "Data botez";
		$text['marrdate'] = "Data casatorie";
		$text['spouseid'] = "ID sot";
		$text['spousename'] = "Nume sot/sotie";
		$text['deathdate'] = "Data deces";
		$text['burialdate'] = "Data inmormantare";
		$text['changedate'] = "Data ultimei modificari";
		$text['gedcom'] = "Arbore";
		$text['baptdate'] = "Data botez(LDS)";
		$text['baptplace'] = "Loc botez (LDS)";
		$text['endldate'] = "Data Endowment (LDS)";
		$text['endlplace'] = "Loc Endowment (LDS)";
		$text['ssealdate'] = "Data casatorie (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Loc casatorie (LDS)";
		$text['psealdate'] = "Data casatorie parinti (LDS)";   //Sealed to parents
		$text['psealplace'] = "Loc casatorie pararinti (LDS)";
		$text['marrplace'] = "Loc casatorie";
		$text['spousesurname'] = "Nume familie sot";
		$text['spousemore'] = "Daca introduceti o valoare pentru nume familie sot/sotie, trebuie sa selectati gen.";
		$text['plusminus5'] = "+/- 5 ani de la";
		$text['exists'] = "exista";
		$text['dnexist'] = "nu exista";
		$text['divdate'] = "Data divort";
		$text['divplace'] = "Loc divort";
		$text['otherevents'] = "Alte evenimente";
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
		$text['logfilefor'] = "Fisier loc pentru";
		$text['mostrecentactions'] = "Actiunile cele mai recente";
		$text['autorefresh'] = "Reimprospatare automata (30 secunde)";
		$text['refreshoff'] = "Opreste reimprospatare automata";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cimitire si pietre funerare";
		$text['showallhsr'] = "Afiseaza toate inregistrarile pietre funerare";
		$text['in'] = "in";
		$text['showmap'] = "Afiseaya harta";
		$text['headstonefor'] = "Piatra funerara pentru";
		$text['photoof'] = "Imaginea lui";
		$text['photoowner'] = "Proprietar de original";
		$text['nocemetery'] = "Nici un cimitir";
		$text['iptc005'] = "Titlu";
		$text['iptc020'] = "Categorii Sup.";
		$text['iptc040'] = "Instructiuni speciale";
		$text['iptc055'] = "Data creari";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Functia autorului";
		$text['iptc090'] = "Oras";
		$text['iptc095'] = "Jutet/Stat";
		$text['iptc101'] = "Tara";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Titlu mare";
		$text['iptc110'] = "Sursa";
		$text['iptc115'] = "Sursa imagine";
		$text['iptc116'] = "Notite drepturi de autor";
		$text['iptc120'] = "Titlu articol";
		$text['iptc122'] = "Autor articol";
		$text['mapof'] = "Harta la";
		$text['regphotos'] = "Vezi descriere";
		$text['gallery'] = "Doar miniaturi";
		$text['cemphotos'] = "Imagini cimitir";
		$text['photosize'] = "Dimensiuni";
        $text['iptc010'] = "Prioritate";
		$text['filesize'] = "Dimensiune fisier";
		$text['seeloc'] = "Vezi locatie";
		$text['showall'] = "Afiseaza toate";
		$text['editmedia'] = "Editeaza media";
		$text['viewitem'] = "Vezi aceast articol";
		$text['editcem'] = "Editeaza cimitir";
		$text['numitems'] = "# articole";
		$text['allalbums'] = "Toate albumele";
		$text['slidestop'] = "Pauza Slide Show";
		$text['slideresume'] = "Reluati Slide Show";
		$text['slidesecs'] = "Secunde pentru fiecare slide:";
		$text['minussecs'] = "mai putin cu 0.5 secunde";
		$text['plussecs'] = "mai mult cu 0.5 secunde";
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
		$text['toggletags'] = "Etichetă de comutare, pornire/stopare";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Afiseaza numele de familie care incep cu";
		$text['showtop'] = "Afiseaza sus";
		$text['showallsurnames'] = "Afiseaza toate numele de familie";
		$text['sortedalpha'] = "sorteaza alfabetic";
		$text['byoccurrence'] = "ordoneaza la intimplare";
		$text['firstchars'] = "Primele caractere";
		$text['mainsurnamepage'] = "Meniu pagina nume familie";
		$text['allsurnames'] = "Toate numele de familie";
		$text['showmatchingsurnames'] = "Apasa pe un nume de familie pentru a afisa inregistrari care corespund.";
		$text['backtotop'] = "Inapoi sus";
		$text['beginswith'] = "Incep cu";
		$text['allbeginningwith'] = "Toate numele de familie care incep cu";
		$text['numoccurrences'] = "Numarul total de localitati";
		$text['placesstarting'] = "Afiseaza pe larg localitati care incep cu";
		$text['showmatchingplaces'] = "Apasa pe loc pentru afisare localitati mici. Apasa pe icoana cautare pentru afisare persoanelor potrivite.";
		$text['totalnames'] = "Total persoane";
		$text['showallplaces'] = "Afiseaza toate localitati";
		$text['totalplaces'] = "Total localitati";
		$text['mainplacepage'] = "Pagina meniu locuri";
		$text['allplaces'] = "Toate localitatile pe larg";
		$text['placescont'] = "Afisare toate localitatile continute";
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
		$text['pastxdays'] = "(ultimele xx zile)";

		$text['photo'] = "Imagine";
		$text['history'] = "Povestioare/Documente";
		$text['husbid'] = "ID sot";
		$text['husbname'] = "Nume sot";
		$text['wifeid'] = "ID sotie";
		//added in 11.0.0
		$text['wifename'] = "Mother's Name";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Sterge";
		$text['addperson'] = "Adauga persoana";
		$text['nobirth'] = "Urmatoarea persoana nu are o data de nastere valida si nu poate fi adaugata";
		$text['event'] = "Eveniment(e)";
		$text['chartwidth'] = "Latime grafic";
		$text['timelineinstr'] = "Adauga persoana";
		$text['togglelines'] = "Linii alternative";
		//changed in 9.0.0
		$text['noliving'] = "Urmatoarea persoana este marcata ca in viata si nu poate fi adaugata deoarece nu sunteti conectat cu permisiuni corespunzatoare";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Rasfoieste toti arborii";
		$text['treename'] = "Nume arbore";
		$text['owner'] = "Proprietar";
		$text['address'] = "Adresa";
		$text['city'] = "Oras";
		$text['state'] = "Jutet/stat";
		$text['zip'] = "Cod postal/zip";
		$text['country'] = "Tara";
		$text['email'] = "Adresa email";
		$text['phone'] = "Telefon";
		$text['username'] = "Nume utilizator";
		$text['password'] = "Parola";
		$text['loginfailed'] = "Conectare esuata.";

		$text['regnewacct'] = "Inregistrare un nou cont utilizator";
		$text['realname'] = "Numele dumneavoastra real";
		$text['phone'] = "Telefon";
		$text['email'] = "Adresa email";
		$text['address'] = "Adresa";
		$text['acctcomments'] = "Note sau comentarii";
		$text['submit'] = "Trimite";
		$text['leaveblank'] = "(lasa necompletat daca soliciti un nou arbore)";
		$text['required'] = "Campuri obligatorii";
		$text['enterpassword'] = "Va rugam introduceti o parola.";
		$text['enterusername'] = "Va rugam introduceti un nume utilizator.";
		$text['failure'] = "Ne apare rau, dar numele de utilizator introdus de dumneavoastra este deja folosit. Va rugam folositi butonul inapoi al browser-ului pentru a reveni la pagina precedenta si alegeti alt nume utilizator.";
		$text['success'] = "Va multumim. Am receptionat inregistrarea dumneavoastra. Va vom contacta cand contul dumneavoastra este activat sau daca avem nevoie de informatii suplimentare.";
		$text['emailsubject'] = "Noua cerere cont utilizator in aborelui familiei dumneavoastra";
		$text['website'] = "Pagina web";
		$text['nologin'] = "Nu aveti un cont de utilizator?";
		$text['loginsent'] = "Informatii conectare trimise";
		$text['loginnotsent'] = "Informatiile conectare nu au fost trimise";
		$text['enterrealname'] = "Va rugam introduceti numele dumneavoastra real.";
		$text['rempass'] = "Raman conectat pe acest calculator";
		$text['morestats'] = "Mai multe statistici";
		$text['accmail'] = "<strong>NOTA:</strong> Pentru a primi emailuri de la administratorul site-ului in ceea ce priveste contul dumneavoastra, va rugam asigurati-va ca nu blocati mesajele de la acest domeniu.";
		$text['newpassword'] = "Parola noua";
		$text['resetpass'] = "Reseteaza parola";
		$text['nousers'] = "Acest formular nu poate fi utilizat pana cand cel putin o inregistrare utilizator exista. Daca sunteti administrator site, va rugam mergeti la Admin/utilizatori pentru a crea contul dumneavoastra de administrator.";
		$text['noregs'] = "We're sorry, but we are not accepting new user registrations at this time. Please <a href=\"suggest.php\">contact us</a> directly if you have comments or questions regarding anything on this site.";
		$text['emailmsg'] = "Ati primit o noua cerere cont utilizator in arborele genealogic al familiei. Va rugam conectativa la interfata dumneavoastra de administrare TNG si asociati permisiunile proprii la acest cont nou. Daca aprobati aceasta cerere de inregistrare va rugam notificati solicitantul raspunzand la acest mesaj.";
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
		$text['newpassword2'] = "Parola noua din nou";
		$text['resetsuccess'] = "Parola a fost restată";
		$text['resetfail'] = "Eroare. Parola nu  a fost resetată";
		$text['failreason0'] = "(eroare baze de date necunoscuta)";
		$text['failreason2'] = "(nu ai permisiunea sa schimbi parola)";
		$text['failreason3'] = "(parola nu e corecta)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Browse All Branches";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Marime";
		$text['totindividuals'] = "Total persoane";
		$text['totmales'] = "Total barbati";
		$text['totfemales'] = "Total femei";
		$text['totunknown'] = "Total gen necunoscut";
		$text['totliving'] = "Total in viata";
		$text['totfamilies'] = "Total familii";
		$text['totuniquesn'] = "Toate nume familie unice";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Total Surse";
		$text['avglifespan'] = "Varsta mediu";
		$text['earliestbirth'] = "Nastere prematura";
		$text['longestlived'] = "Cel mai longeviv";
		$text['days'] = "zile";
		$text['age'] = "Varsta";
		$text['agedisclaimer'] = "Calculare varstei relatate se bazeaza pe data de nastere <EM>si</EM> deces inregistrata.  Datorita existentei unor campuri incomplete(ex., o data deces listata doar ca  \"1945\" sau \"BEF 1860\"), calcularea acesteia nu poate fi realizata 100%.";
		$text['treedetail'] = "Mai multe informatii pe acest arbore";
		$text['total'] = "Total";
		//added in 12.0
		$text['totdeceased'] = "Total Deceased";
		//added in 14.0
		$text['totalsourcecitations'] = "Sursele totale citate";
		break;

	case "notes":
		$text['browseallnotes'] = "Navigheaza toate notele";
		break;

	case "help":
		$text['menuhelp'] = "Meniu ajutor";
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
		$text['exists'] = "exista";
		$text['noop'] = "No operation was performed.";
		//added in 8.0.0
		$text['nouser'] = "User was not created. Username may already exist.";
		$text['notree'] = "Tree was not created. Tree ID may already exist.";
		$text['infosaved2'] = "Information saved";
		$text['renamedto'] = "renamed to";
		$text['norename'] = "could not be renamed";
		//changed in 13.0.0
		$text['loginfirst'] = "Au fost detectate înregistrări de utilizatori existente. Pentru a continua, trebuie mai întâi să vă autentificați sau să eliminați toate înregistrările din tabelul utilizatorilor.";
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
$text['matches'] = "Afiseaza de la ";
$text['description'] = "Descriere";
$text['notes'] = "Note";
$text['status'] = "Status";
$text['newsearch'] = "Cautare noua";
$text['pedigree'] = "Arbore genealogic";
$text['seephoto'] = "Veti imagini";
$text['andlocation'] = "&amp; localitate";
$text['accessedby'] = "accesat de";
$text['children'] = "Copii";  //from getperson
$text['tree'] = "Arbore";
$text['alltrees'] = "Toti arborii";
$text['nosurname'] = "[fara nume familie]";
$text['thumb'] = "Mini";  //as in Thumbnail
$text['people'] = "Persoane";
$text['title'] = "Titlu";  //from getperson
$text['suffix'] = "Sufix";  //from getperson
$text['nickname'] = "Pseudonim/porecla";  //from getperson
$text['lastmodified'] = "Ultima modificare";  //from getperson
$text['married'] = "Casatorit";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nume"; //from showmap
$text['lastfirst'] = "Nume familie, Prenume";  //from search
$text['bornchr'] = "Nascut/Botezat";  //from search
$text['individuals'] = "Persoane";  //from whats new
$text['families'] = "Familii";
$text['personid'] = "ID Persoana";
$text['sources'] = "Sursa";  //from getperson (next several)
$text['unknown'] = "Necunoscut";
$text['father'] = "Tata";
$text['mother'] = "Mama";
$text['christened'] = "Botez";
$text['died'] = "Deces";
$text['buried'] = "Inmormantare";
$text['spouse'] = "Sot";  //from search
$text['parents'] = "Parinti";  //from pedigree
$text['text'] = "Text";  //from sources
$text['language'] = "Limba";  //from languages
$text['descendchart'] = "Urmas";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Persoana";
$text['edit'] = "Editeaza";
$text['date'] = "Data";
$text['login'] = "Conectare";
$text['logout'] = "Deconectare";
$text['groupsheet'] = "Schita grup";
$text['text_and'] = "si";
$text['generation'] = "Generatii";
$text['filename'] = "Nume fisier";
$text['id'] = "ID";
$text['search'] = "Cauta";
$text['user'] = "Utilizator";
$text['firstname'] = "Prenume";
$text['lastname'] = "Nume familie";
$text['searchresults'] = "Rezultate cautare";
$text['diedburied'] = "Deces/Inmormantare";
$text['homepage'] = "Prima pagina";
$text['find'] = "Gasit...";
$text['relationship'] = "Rudenie";		//in German, Verwandtschaft
$text['relationship2'] = "Relationship"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Program";
$text['yesabbr'] = "Da";               //abbreviation for 'yes'
$text['divorced'] = "Divortat";
$text['indlinked'] = "Conectat la";
$text['branch'] = "Ramura";
$text['moreind'] = "Mai multe persoane";
$text['morefam'] = "Mai multe familii";
$text['surnamelist'] = "Lista nume familie";
$text['generations'] = "Generatii";
$text['refresh'] = "Reinprospatare";
$text['whatsnew'] = "Noutati";
$text['reports'] = "Repoarte";
$text['placelist'] = "Lista localitati";
$text['baptizedlds'] = "Botez (LDS)";
$text['endowedlds'] = "Endowed (LDS)";
$text['sealedplds'] = "Casatorie P (LDS)";
$text['sealedslds'] = "Casatorie S (LDS)";
$text['ancestors'] = "Stramosi";
$text['descendants'] = "Urmasi";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Data ultimului import GEDCOM";
$text['type'] = "Tip";
$text['savechanges'] = "Salveaza Schimbari";
$text['familyid'] = "ID Familie";
$text['headstone'] = "Pietre funerare";
$text['historiesdocs'] = "Povestioare";
$text['anonymous'] = "anonim";
$text['places'] = "Locatii";
$text['anniversaries'] = "Date si aniversari";
$text['administration'] = "Administrare";
$text['help'] = "Ajutor";
//$text['documents'] = "Documents";
$text['year'] = "An";
$text['all'] = "Toate";
$text['address'] = "Adresa";
$text['suggest'] = "Sugereaza";
$text['editevent'] = "Sugereaza o schimbare la acest eveniment";
$text['morelinks'] = "Mai multe legaturi";
$text['faminfo'] = "Informatii familie";
$text['persinfo'] = "Informatii persoana";
$text['srcinfo'] = "Informatii sursa";
$text['fact'] = "Fact";
$text['goto'] = "Selecteaza o pagine";
$text['tngprint'] = "Tipareste";
$text['databasestatistics'] = "Statistici"; //needed to be shorter to fit on menu
$text['child'] = "Copil";  //from familygroup
$text['repoinfo'] = "Informatii depozit";
$text['tng_reset'] = "Reseteaza";
$text['noresults'] = "Nici un rezultat gasit";
$text['allmedia'] = "Toate media";
$text['repositories'] = "Depozite";
$text['albums'] = "Albume";
$text['cemeteries'] = "Cimitire";
$text['surnames'] = "Nume familii";
$text['dates'] = "Date";
$text['link'] = "Legatura";
$text['media'] = "Media";
$text['gender'] = "Gen";
$text['latitude'] = "Latitudine";
$text['longitude'] = "Longitudine";
$text['bookmarks'] = "Semne de carte";
$text['bookmark'] = "Adauga semn de carte";
$text['mngbookmarks'] = "Dute la semne de carte";
$text['bookmarked'] = "Semn de carte adaugat";
$text['remove'] = "Sterge";
$text['find_menu'] = "Gaseste";
$text['info'] = "Informatie"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cimitir";
$text['gmapevent'] = "Harta eveniment";
$text['gevents'] = "Eveniment";
$text['googleearthlink'] = "Legatura la  Google Earth";
$text['googlemaplink'] = "legatura la Google Maps";
$text['gmaplegend'] = "Legenda punct";
$text['unmarked'] = "Ne marcat";
$text['located'] = "Localizat";
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
$text['reliability'] = "Secutitate";
$text['labels'] = "Labels";
$text['inclsrcs'] = "Include Sources";
$text['cont'] = "(cont.)"; //abbreviation for continued
$text['mnuheader'] = "Home Page";
$text['mnusearchfornames'] = "Cauta";
$text['mnulastname'] = "Nume familie";
$text['mnufirstname'] = "Prenume";
$text['mnusearch'] = "Cauta";
$text['mnureset'] = "Start";
$text['mnulogon'] = "Conectare";
$text['mnulogout'] = "Deconectare";
$text['mnufeatures'] = "Alte articole";
$text['mnuregister'] = "Inregistrare pentru cont utilizator";
$text['mnuadvancedsearch'] = "Cautare avansata";
$text['mnulastnames'] = "Nume familie";
$text['mnustatistics'] = "Statistici";
$text['mnuphotos'] = "Imagini";
$text['mnuhistories'] = "Povestioare";
$text['mnumyancestors'] = "Imagini &amp; povestioare pentru stramosii lui [Person]";
$text['mnucemeteries'] = "Cimitire";
$text['mnutombstones'] = "Pietre funerare";
$text['mnureports'] = "Repoarte";
$text['mnusources'] = "Surse";
$text['mnuwhatsnew'] = "Noutati";
$text['mnushowlog'] = "Log acces";
$text['mnulanguage'] = "Schimba limba";
$text['mnuadmin'] = "Administrare";
$text['welcome'] = "Bine ai venit";
$text['contactus'] = "Contacteaza-ne";
//changed in 8.0.0
$text['born'] = "Nastere";
$text['searchnames'] = "Cauta dupa Nume";
//added in 8.0.0
$text['editperson'] = "Edit Person";
$text['loadmap'] = "Load the map";
$text['birth'] = "Birth";
$text['wasborn'] = "was born";
$text['startnum'] = "First Number";
$text['searching'] = "Searching";
//moved here in 8.0.0
$text['location'] = "Location";
$text['association'] = "Asociere";
$text['collapse'] = "Restrange";
$text['expand'] = "Extinde";
$text['plot'] = "Plot";
$text['searchfams'] = "Search Families";
//added in 8.0.2
$text['wasmarried'] = "Casatorit";
$text['anddied'] = "Deces";
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
$text['slidestart'] = "Ruleaza Slide Show";
$text['livingnote'] = "Cel putin o persoana in viata conectata la aceasta nota - Detalii.";
$text['livingphoto'] = "Cel putin o persoana in viata conectata la acest articol- Detalii.";
$text['waschristened'] = "Botez";
//added in 10.0.0
$text['branches'] = "Branches";
$text['detail'] = "Detail";
$text['moredetail'] = "More detail";
$text['lessdetail'] = "Less detail";
$text['conflds'] = "Confirmed (LDS)";
$text['initlds'] = "Initiatory (LDS)";
$text['wascremated'] = "was cremated";
//moved here in 11.0.0
$text['text_for'] = "pentru";
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
$text['quicklinks'] = "Link-uri rapide";
$text['yourname'] = "Numele tău";
$text['youremail'] = "Adresa ta de e-mail";
$text['liketoadd'] = "Orice informație pe care doriți să o adăugați";
$text['webmastermsg'] = "Mesaj pentru webmasteri";
$text['gallery'] = "Vezi Galerie";
$text['wasborn_male'] = "sa născut";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "sa născut"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "a fost botezat";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "a fost botezat";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "a murit";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "a murit";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "a fost îngropat"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "a fost îngropat"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "a fost cremat";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "a fost cremat";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "căsătorit";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "căsătorit";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "a fost divorțat";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "a fost divorțat";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " in ";			// used as a preposition to the location
$text['onthisdate'] = " pe ";		// when used with full date
$text['inthisyear'] = " in ";		// when used with year only or month / year dates
$text['and'] = "și ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Test Info";
//added in 13.0
$text['visitor'] = "Vizitator";

$text['popupnote2'] = " = Arbore nou";

//moved here in 14.0
$text['zoomin'] = "Zoom In";
$text['zoomout'] = "Zoom Out";
$text['scrollnote'] = "Note: Trebuie sa rasfoiti in jos sau in dreapta pentru a vedea grafic.";
$text['general'] = "General";

//changed in 14.0
$text['otherevents'] = "Alte evenimente";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Conexiuni";
$text['continue'] = "Continua...";
$text['title2'] = "Titlu"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>