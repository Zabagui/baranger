<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Tutte le Fonti";
		$text['shorttitle'] = "Titolo Breve";
		$text['callnum'] = "Numero d'archivio";
		$text['author'] = "Autore";
		$text['publisher'] = "Editore";
		$text['other'] = "Altre Informazioni";
		$text['sourceid'] = "Fonte ID";
		$text['moresrc'] = "Altre Fonti";
		$text['repoid'] = "ID del Luogo di deposito";
		$text['browseallrepos'] = "Cercare i Luoghi di deposito";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nuova Lingua ";
		$text['changelanguage'] = "Cambia la Lingua";
		$text['languagesaved'] = "Lingua Registrata";
		$text['sitemaint'] = "Sito in Manutenzione.";
		$text['standby'] = "Il sito è temporaneamente non disponibile, stiamo aggiornando il DataBase. Prova ancora fra alcuni minuti. Se il sito rimane offline per un periodo esteso, contatta il <a href=\"suggest.php\">webmaster</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "Avvio GEDCOM";
		$text['producegedfrom'] = "Produrre un archivio GEDCOM da";
		$text['numgens'] = "Numero di Generazioni";
		$text['includelds'] = "Includere informazione LDS";
		$text['buildged'] = "Costruire GEDCOM";
		$text['gedstartfrom'] = "GEDCOM inizia da";
		$text['nomaxgen'] = "Dovete precisare un numero massimo di generazioni. Premere sul bottone 'precedente' e correggere l'errore ";
		$text['gedcreatedfrom'] = "GEDCOM creato da";
		$text['gedcreatedfor'] = "Creato per";
		$text['creategedfor'] = "Creare un archivio GEDCOM";
		$text['email'] = "Indirizzo elettronico";
		$text['suggestchange'] = "Suggerite una modifica";
		$text['yourname'] = "Il vostro Nome";
		$text['comments'] = "Note o commenti";
		$text['comments2'] = "Commenti";
		$text['submitsugg'] = "Presentate una Proposta";
		$text['proposed'] = "Cambiamento Proposto";
		$text['mailsent'] = "Grazie. Il vostro messaggio è stato inviato.";
		$text['mailnotsent'] = "Spiacente, ma il vostro messaggio non ha potuto essere inviato. Volete direttamente contattare xxx a yyy ";
		$text['mailme'] = "Inviate una copia a questo indirizzo";
		$text['entername'] = "Iscrivete il vostro nome";
		$text['entercomments'] = "Iscrivete i vostri commenti";
		$text['sendmsg'] = "Inviate un Messaggio";
		//added in 9.0.0
		$text['subject'] = "Soggetto";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotografie e Cronistoria di";
		$text['indinfofor'] = "Info. personale che riguarda";
		$text['pp'] = "pp."; //page abbreviation
		$text['age'] = "Età";
		$text['agency'] = "Agenzia";
		$text['cause'] = "Causa";
		$text['suggested'] = "Suggerito";
		$text['closewindow'] = "Chiudi finestra";
		$text['thanks'] = "Grazie";
		$text['received'] = "Il cambiamento che avete proposto sarà incluso dopo verifica dall'amministratore del sito.";
		$text['indreport'] = "Rapporto specifico";
		$text['indreportfor'] = "Rapporto specifico per";
		$text['bkmkvis'] = "<strong>Nota:</strong> Questi segnalibri sono soltanto visibili su questo computer ed in questo browser.";
        //added in 9.0.0
		$text['reviewmsg'] = "Hai suggerito un cambiamento che ha bisogno della tua opinione. Questa presentazione riguarda:";
        $text['revsubject'] = "Il cambiamento suggerito necessita della tua opinione";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Elaboratore di Relazione";
		$text['findrel'] = "Ricerca di Relazione";
		$text['person1'] = "Persona 1:";
		$text['person2'] = "Persona 2:";
		$text['calculate'] = "Calcolo";
		$text['select2inds'] = "Volete scegliere due individui.";
		$text['findpersonid'] = "Trova ID della persona";
		$text['enternamepart'] = "Introdurre il nome o il nome di famiglia";
		$text['pleasenamepart'] = "Volete introdurre il nome o il nome di famiglia.";
		$text['clicktoselect'] = "Premete per scegliere";
		$text['nobirthinfo'] = "Non dati di nascita";
		$text['relateto'] = "Relazione a";
		$text['sameperson'] = "I due individui sono identici";
		$text['notrelated'] = "I due individui non sono legati su xxx generazioni."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Per pubblicare la relazione tra due persone, utilizza il bottone 'ricerca 'sotto per trovare gli individui (o conservate gli individui pubblicati), in seguito premete 'su calcolare'.";
		$text['sometimes'] = "(a volte il fatto di verificare un altro numero di generazioni dà un risultato diverso)";
		$text['findanother'] = "Trovare un altro legame";
		$text['brother'] = "il fratello di";
		$text['sister'] = "la sorella di";
		$text['sibling'] = "fratello/sorella di";
		$text['uncle'] = "il xxx zio di";
		$text['aunt'] = "la xxx zia di";
		$text['uncleaunt'] = "il xxx zio/la zia di";
		$text['nephew'] = "il xxx nipote di";
		$text['niece'] = "la xxx nipote di";
		$text['nephnc'] = "i xxx nipote di";
		$text['removed'] = "di Secondo";
		$text['rhusband'] = "il Marito di ";
		$text['rwife'] = "la Moglje di ";
		$text['rspouse'] = "il Sposo(a) di ";
		$text['son'] = "il Figlio di";
		$text['daughter'] = "la Figlia di";
		$text['rchild'] = "il Bambino(a) di";
		$text['sil'] = "il Genero di";
		$text['dil'] = "la Nuora di";
		$text['sdil'] = "il Genero o la Nuora di";
		$text['gson'] = "il xxx Nipote di";
		$text['gdau'] = "la xxx Nipote di";
		$text['gsondau'] = "i xxx Nipote di";
		$text['great'] = "bis";
		$text['spouses'] = "sono Coniuge";
		$text['is'] = "è";
		$text['changeto'] = "Cambiate in:";
		$text['notvalid'] = "L' ID della Persona non è valido o non esiste in questo database. Riprovate di nuovo.";
		$text['halfbrother'] = "Il mezzo fratello di";
		$text['halfsister'] = "La mezza sorella di";
		$text['halfsibling'] = "Il mezzo figlio di ";
		//changed in 8.0.0
		$text['gencheck'] = "Generazioni max da verificare";
		$text['mcousin'] = "il xxx cugino yyy di";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "la xxx cugina yyy di";  //female cousin
		$text['cousin'] = "il xxx cugino(a) yyy di";
		$text['mhalfcousin'] = "Il mezzo cugino yyy di";  //male cousin
		$text['fhalfcousin'] = "La mezza cugina yyy di";  //female cousin
		$text['halfcousin'] = "Il mezzo cugino yyy di";
		//added in 8.0.0
		$text['oneremoved'] = "di primo grado";
		$text['gfath'] = "il xxx nonno di";
		$text['gmoth'] = "la xxx nonna di";
		$text['gpar'] = "i xxx nonni di";
		$text['mothof'] = "la madre di";
		$text['fathof'] = "il padre di";
		$text['parof'] = "i genitori di";
		$text['maxrels'] = "parentela massimi all'esposizione";
		$text['dospouses'] = "Mostri la parentela che fanno partecipare uno sposo";
		$text['rels'] = "Parentela";
		$text['dospouses2'] = "mostra i coniuge";
		$text['fil'] = "il suocero di";
		$text['mil'] = "la suocera di";
		$text['fmil'] = "il suocero o la suocera di";
		$text['stepson'] = "il figliastro di";
		$text['stepdau'] = "la figliastra di";
		$text['stepchild'] = "il figliastro/la figliastra di";
		$text['stepgson'] = "il xxx figliastro nipote di";
		$text['stepgdau'] = "la xxx figliastra nipote di";
		$text['stepgchild'] = "il/la xxx figliastro/figliastra nipote di";
		//added in 8.1.1
		$text['ggreat'] = "bis";
		//added in 8.1.2
		$text['ggfath'] = "il xxx bisnonno di";
		$text['ggmoth'] = "la xxx bisnonna di";
		$text['ggpar'] = "i xxx bisnonni di";
		$text['ggson'] = "il xxx pronipote di";
		$text['ggdau'] = "la xxx pronipote di";
		$text['ggsondau'] = "i xxx bisnipote di";
		$text['gstepgson'] = "il xxx pronipote figliastro di";
		$text['gstepgdau'] = "la xxx pronipote figliastra di";
		$text['gstepgchild'] = "i xxx pronipote figliastri di";
		$text['guncle'] = "il xxx prozio di";
		$text['gaunt'] = "la xxx prozia di";
		$text['guncleaunt'] = "il/la xxx prozio/prozia di";
		$text['gnephew'] = "il xxx pronipote di";
		$text['gniece'] = "la xxx pronipote di";
		$text['gnephnc'] = "il/la xxx pronipote di";
		//added in 14.0
		$text['pathscalc'] = "Search for connections";
		$text['findrel2'] = "Ricerca di Relazione";
		$text['makeme2nd'] = "Use my ID";
		$text['usebookmarks'] = "Use bookmarks";
		$text['select2inds'] = "Volete scegliere due individui.";
		$text['indinfofor'] = "Info. personale che riguarda";
		$text['nobookmarks'] = "There is no bookmark to use";
		$text['bkmtitle'] = "Persons found in bookmarks";
		$text['bkminfo'] = "Select a person:";
		$text['sortpathsby'] = "Sort paths by number of";
		$text['sortbyshort'] = "Sort by";
		$text['bylengthshort'] = "Length";
		$text['badID1'] = ": bad person1 ID - please go back and correct";
		$text['badID2'] = ": bad person2 ID - please go back and correct";
		$text['notintree'] = ": the person with this ID is not in the current tree database.";
		$text['sameperson'] = "I due individui sono identici";;
		$text['nopaths'] = "These persons are not connected.";
		$text['nopaths1'] = "No more connections shorter than xxx";
		$text['nopaths2'] = "in xxx search steps";
		$text['longestpath'] = "(longest path checked so far was xxx steps long)";
		$text['relevantpaths'] = "The number of different relevant paths found: xxx";
		$text['skipMarr'] = "(in addition, the number of paths found but not displayed due to too many marriages was: xxx)";
		$text['mjaor'] = "or";
		$text['connectionsto'] = "Connections to ";
		$text['findanotherpers'] = "Find another person...";
		$text['sometimes'] = "(a volte il fatto di verificare un altro numero di generazioni dà un risultato diverso)";
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
		$text['dospouses2'] = "mostra i coniuge";
		$text['maxmopt'] = "Max marriages per connection";
		$text['maxm'] = "Max marriages";
		$text['arerelated'] = "These persons are relatives - their relationship is shown in the Path 1";
		$text['simplerel'] = "Simple relationship search";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Pagina di";
		$text['ldsords'] = "Ordinanze LDS";
		$text['baptizedlds'] = "Battezzato (LDS)";
		$text['endowedlds'] = "Dotato (LDS)";
		$text['sealedplds'] = "Dotato genitori (LDS)";
		$text['sealedslds'] = "Coniuge dotato (LDS)";
		$text['otherspouse'] = "Altro Coniuge";
		$text['husband'] = "Marito";
		$text['wife'] = "Moglie";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "N";
		$text['capaltbirthabbr'] = "A";
		$text['capdeathabbr'] = "D";
		$text['capburialabbr'] = "E";
		$text['capplaceabbr'] = "L";
		$text['capmarrabbr'] = "M";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Ridefinire con";
		$text['unknownlit'] = "Sconosciuto";
		$text['popupnote1'] = "Informazione ulteriore";
		$text['pedcompact'] = "Compatto";
		$text['pedstandard'] = "Standard";
		$text['pedtextonly'] = "Testo solo";
		$text['descendfor'] = "Discesa di";
		$text['maxof'] = "Massimo di";
		$text['gensatonce'] = "Generazioni pubblicate allo stesso tempo";
		$text['sonof'] = "Figlio di";
		$text['daughterof'] = "Figlia di";
		$text['childof'] = "Bambino di";
		$text['stdformat'] = "formato stendardo";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Aggiungere una nuova famiglia";
		$text['editfam'] = "Pubblicare la famiglia";
		$text['side'] = "(ascendenti)";
		$text['familyof'] = "Famiglia di";
		$text['paternal'] = "Paterno";
		$text['maternal'] = "Materno";
		$text['gen1'] = "sé";
		$text['gen2'] = "Genitori";
		$text['gen3'] = "Grande-genitore (nonni)";
		$text['gen4'] = "Secondi nonni";
		$text['gen5'] = "Terzi nonni";
		$text['gen6'] = "quarti nonni";
		$text['gen7'] = "quinti nonni";
		$text['gen8'] = "sesti nonni";
		$text['gen9'] = "settimi nonni";
		$text['gen10'] = "ottavi nonni";
		$text['gen11'] = "noni nonni";
		$text['gen12'] = "decimi nonni";
		$text['graphdesc'] = "Tabella di discesa fino a questo punto";
		$text['pedbox'] = "Scatola";
		$text['regformat'] = "formato registro";
		$text['extrasexpl'] = "Se fotografie o storie esistono per gli individui seguenti, le icone corrispondenti saranno pubblicate accanto ai nomi.";
		$text['popupnote3'] = " = Carta Nouva";
		$text['mediaavail'] = "Mezzi Disponibile";
		$text['pedigreefor'] = "Albero di";
		$text['pedigreech'] = "Tabella di razza";
		$text['datesloc'] = "Date e posizioni";
		$text['borchr'] = "Nascita/Alt - morte/sepoltura (due)";
		$text['nobd'] = "Nessun date di morte o di nascita";
		$text['bcdb'] = "Nascita/Alt/Morte/Sepoltura (quattro)";
		$text['numsys'] = "Sistema di numerazione";
		$text['gennums'] = "Numeri di generazione";
		$text['henrynums'] = "Numeri del Henry";
		$text['abovnums'] = "Numeri di d'Aboville";
		$text['devnums'] = "Numeri di de Villiers";
		$text['dispopts'] = "Opzioni dell'esposizione";
		//added in 10.0.0
		$text['no_ancestors'] = "No ancestors found";
		$text['ancestor_chart'] = "Vertical ancestor chart";
		$text['opennewwindow'] = "Open in a new window";
		$text['pedvertical'] = "Vertical";
		//added in 11.0.0
		$text['familywith'] = "Famiglia con";
		$text['fcmlogin'] = "Si prega di autenticarsi per vedere dettagli";
		$text['isthe'] = "è il";
		$text['otherspouses'] = "altri coniugi";
		$text['parentfamily'] = "La famiglia del padre ";
		$text['showfamily'] = "Mostra la famiglia";
		$text['shown'] = "mostrato";
		$text['showparentfamily'] = "Visualizza famiglia genitore";
		$text['showperson'] = "Mostra la persona";
		//added in 11.0.2
		$text['otherfamilies'] = "Altre famiglie";
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
		$text['noreports'] = "Nulla Rapporto.";
		$text['reportname'] = "Nome del Rapporto";
		$text['allreports'] = "Tutte gli Rapporti";
		$text['report'] = "Rapporto";
		$text['error'] = "Errore";
		$text['reportsyntax'] = "la sintassi di questa richiesta";
		$text['wasincorrect'] = "è sbagliata, e il rapporto non ha potuto essere lanciato. Si prega di contattare il vostro amministratore sistema a ";
		$text['errormessage'] = "Messaggio d'errore";
		$text['equals'] = "uguale";
		$text['endswith'] = "si conclude";
		$text['soundexof'] = "soundex di";
		$text['metaphoneof'] = "metafono di";
		$text['plusminus10'] = "+/- 10 anni di";
		$text['lessthan'] = "inferiore a ";
		$text['greaterthan'] = "superiore a ";
		$text['lessthanequal'] = "inferiore o uguaglia a ";
		$text['greaterthanequal'] = "superiore o uguaglia a ";
		$text['equalto'] = "uguale a";
		$text['tryagain'] = "Volete provare di nuovo";
		$text['joinwith'] = "legame";
		$text['cap_and'] = "E";
		$text['cap_or'] = "O";
		$text['showspouse'] = "pubblicare coniuge (pubblicherà doppi se una persona ha più di uno coniuge)";
		$text['submitquery'] = "Ricercare";
		$text['birthplace'] = "Luogo di nascita";
		$text['deathplace'] = "Luogo di decessi";
		$text['birthdatetr'] = "Anno di nascita";
		$text['deathdatetr'] = "Anno di decessi";
		$text['plusminus2'] = "+/- 2 anni";
		$text['resetall'] = "Reinizializzare tutti i valori";
		$text['showdeath'] = "Mostrare le informazioni di decessi/sepoltura";
		$text['altbirthplace'] = "Luogo di Baptesimo";
		$text['altbirthdatetr'] = "Anno di Baptesimo";
		$text['burialplace'] = "Luogo della Sepoltura";
		$text['burialdatetr'] = "Anno della Sepoltura";
		$text['event'] = "Evento(i)";
		$text['day'] = "Giorno";
		$text['month'] = "Mese";
		$text['keyword'] = "Parola chiave (ad esempio, \"Verso\")";
		$text['explain'] = "Introdurre le date per vedere gli eventi corrispondenti. Lasciare un campo vuoto per vedere tutte le corrispondenze.";
		$text['enterdate'] = "Volete introdurre o scegliere almeno uno degli elementi seguenti: Giorno, mese, anno, parola chiave: ";
		$text['fullname'] = "Nome intero";
		$text['birthdate'] = "Data di nascita";
		$text['altbirthdate'] = "Data di baptesimo";
		$text['marrdate'] = "Data delle nozze";
		$text['spouseid'] = "ID del coniuge";
		$text['spousename'] = "Nome del coniuge";
		$text['deathdate'] = "Data di decessi";
		$text['burialdate'] = "Data della sepoltura";
		$text['changedate'] = "Data dell'ultima modifica";
		$text['gedcom'] = "Albero";
		$text['baptdate'] = "Data di baptesimo (SDJ)";
		$text['baptplace'] = "Luogo di baptesimo (SDJ)";
		$text['endldate'] = "Data di conferma (SDJ)";
		$text['endlplace'] = "Luogo di conferma (SDJ)";
		$text['ssealdate'] = "Data del sigillo S (SDJ)";   //Sealed to spouse
		$text['ssealplace'] = "Luogo del sigillo S (SDJ)";
		$text['psealdate'] = "Data del sigillo (SDJ)";   //Sealed to parents
		$text['psealplace'] = "Luogo del sigillo P (SDJ)";
		$text['marrplace'] = "Luogo di Nozze";
		$text['spousesurname'] = "Nome di famiglia del coniuge";
		$text['spousemore'] = "se inserite un valore per il nome di famiglia del coniuge, dovete inserire almeno un'altro valore.";
		$text['plusminus5'] = "+/- 5 anni da";
		$text['exists'] = "Esiste";
		$text['dnexist'] = "Non Esiste";
		$text['divdate'] = "Data di divorzio";
		$text['divplace'] = "Posto di divorzio";
		$text['otherevents'] = "Altri Eventi";
		$text['numresults'] = "Risultati per pagina";
		$text['mysphoto'] = "Foto di mistero";
		$text['mysperson'] = "Gente evasiva";
		$text['joinor'] = "Il ' Unisca con OR' l'opzione non può essere usata con il cognome del sposo/a";
		$text['tellus'] = "Dicci quello che sai";
		$text['moreinfo'] = "Ulteriori informazioni:";
		//added in 8.0.0
		$text['marrdatetr'] = "anno di matrimonio";
		$text['divdatetr'] = "anno di divorzio";
		$text['mothername'] = "nome della madre";
		$text['fathername'] = "nome del padre";
		$text['filter'] = "Filtro";
		$text['notliving'] = "non vivendo";
		$text['nodayevents'] = "Eventi per questo mese che non sono associati con un giorno specifico:";
		//added in 9.0.0
		$text['csv'] = "Delimitato da virgola file CSV";
		//added in 10.0.0
		$text['confdate'] = "Confirmation Date (LDS)";
		$text['confplace'] = "Confirmation Place (LDS)";
		$text['initdate'] = "Initiatory Date (LDS)";
		$text['initplace'] = "Initiatory Place (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Tipo di matrimonio";
		$text['searchfor'] = "Cerca";
		$text['searchnote'] = "Nota: Questa pagina utilizza Google per eseguire la ricerca. Il numero di risultati restituiti influiranno direttamente nella misura in cui Google è stato in grado di indicizzare il sito.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Archivio registro per";
		$text['mostrecentactions'] = "ultime azioni";
		$text['autorefresh'] = "Rinfreschi automatico (30 secondi)";
		$text['refreshoff'] = "Eliminare il rinfreschi automatico";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cimiteri e Pietri Tombale";
		$text['showallhsr'] = "Mostrare tutte le registrazioni delle tombe";
		$text['in'] = "in3";
		$text['showmap'] = "Mostrare la carta";
		$text['headstonefor'] = "Pietra Tombale di";
		$text['photoof'] = "Fotografia di";
		$text['photoowner'] = "Proprietario dell'originario";
		$text['nocemetery'] = "Non un cimitero";
		$text['iptc005'] = "Titolo";
		$text['iptc020'] = "Categorie supplementari";
		$text['iptc040'] = "Istruzioni speciali";
		$text['iptc055'] = "Data di creazione";
		$text['iptc080'] = "Autore";
		$text['iptc085'] = "Posizione dell'autore";
		$text['iptc090'] = "Città";
		$text['iptc095'] = "Stato";
		$text['iptc101'] = "Paese";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Titolo";
		$text['iptc110'] = "Fonte";
		$text['iptc115'] = "Fonte della fotografia";
		$text['iptc116'] = "Nota di diritto d'autore";
		$text['iptc120'] = "Sottotitolo";
		$text['iptc122'] = "Autore del sottotitolo";
		$text['mapof'] = "Carta di";
		$text['regphotos'] = "Vista descrittiva";
		$text['gallery'] = "Soltanto le etichette";
		$text['cemphotos'] = "Fotografie di cimiteri";
		$text['photosize'] = "Dimensione";
        $text['iptc010'] = "Priorita";
		$text['filesize'] = "Grandezza di File";
		$text['seeloc'] = "Vedeste Posizione";
		$text['showall'] = "Mostrare tutto";
		$text['editmedia'] = "Curare Media";
		$text['viewitem'] = "Vedere Questo Dettaglio";
		$text['editcem'] = "Curacre Cimiterio";
		$text['numitems'] = "# Dettaglio";
		$text['allalbums'] = "Tutti l'album";
		$text['slidestop'] = "Pausa La Proiezione di diapositive";
		$text['slideresume'] = "Riassunto La Proiezione di diapositive";
		$text['slidesecs'] = "Secondi per ogni scorrevole :";
		$text['minussecs'] = "di meno 0.5 secondi";
		$text['plussecs'] = "più 0.5 secondi";
		$text['nocountry'] = "Paese sconosciuto";
		$text['nostate'] = "Stato sconosciuto";
		$text['nocounty'] = "Paese sconosciuto";
		$text['nocity'] = "Città sconosciuta";
		$text['nocemname'] = "Nome sconosciuto del cimitero";
		$text['editalbum'] = "Pubblichi l'album";
		$text['mediamaptext'] = "<strong>Nota:</strong> Sposti il vostro puntatore del mouse sopra l'immagine verso i nomi di esposizione. Scatti per vedere una pagina per ogni nome.";
		//added in 8.0.0
		$text['allburials'] = "Tutte le sepolture";
		$text['moreinfo'] = "Ulteriori informazioni:";
		//added in 9.0.0
        $text['iptc025'] = "Parole Chiave";
        $text['iptc092'] = "Sub-luogo";
		$text['iptc015'] = "Categoria";
		$text['iptc065'] = "Originario del programma";
		$text['iptc070'] = "Programma Versione";
		//added in 13.0
		$text['toggletags'] = "Alternare etichette";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Pubblicare i cognome che cominciano con";
		$text['showtop'] = "Mostrare la cima";
		$text['showallsurnames'] = "Pubblicare tutti i Cognome";
		$text['sortedalpha'] = "Selezione alfabetica";
		$text['byoccurrence'] = "Classificati da verificarsi";
		$text['firstchars'] = "Primi caratteri";
		$text['mainsurnamepage'] = "Cognome";
		$text['allsurnames'] = "Tutti i Cognome";
		$text['showmatchingsurnames'] = "Premete su uno Cognomo per pubblicare i risultati.";
		$text['backtotop'] = "Rirtorno in testa della pagina";
		$text['beginswith'] = "Cominciando con";
		$text['allbeginningwith'] = "Tutti i Cognomo che cominciano con";
		$text['numoccurrences'] = "Numero di risultati tra parentesi";
		$text['placesstarting'] = "Mostrare i luoghi più grande cominciano con";
		$text['showmatchingplaces'] = "Premete su un nome per vedere le registrazioni legate.";
		$text['totalnames'] = "Totale degli individui";
		$text['showallplaces'] = "Mostrare i più grande luoghi";
		$text['totalplaces'] = "Totale dei luoghi";
		$text['mainplacepage'] = "Pagina dei luoghi principali";
		$text['allplaces'] = "Tutte le più grandi località";
		$text['placescont'] = "Mostrare tutti i luoghi che contengono";
		//changed in 8.0.0
		$text['top30'] = "Cognomi del principale xxx";
		$text['top30places'] = "Più grandi località del principale xxx";
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
		$text['pastxdays'] = "(ultimi xx giorni)";

		$text['photo'] = "Foto";
		$text['history'] = "Storia/documento";
		$text['husbid'] = "ID Coniuge";
		$text['husbname'] = "Nome del Coniuge";
		$text['wifeid'] = "ID Coniuge";
		//added in 11.0.0
		$text['wifename'] = "Nome della madre";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Eliminare";
		$text['addperson'] = "Aggiungere individuo";
		$text['nobirth'] = "L'individuo seguente non ha date di nascita valida e non è stato dunque aggiunto";
		$text['event'] = "Evento(i)";
		$text['chartwidth'] = "Larghezza del grafico";
		$text['timelineinstr'] = "Aggiungete fino a quattro individui che entrano nel loro IDs qui di seguito:";
		$text['togglelines'] = "Ginocchiera Linee";
		//changed in 9.0.0
		$text['noliving'] = "L'individuo seguente è registrato poiché essendo in vita e non è pubblicato perché non siete collegati con le autorizzazioni necessarie";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Tutti gli alberi";
		$text['treename'] = "Nome dell'albero";
		$text['owner'] = "Proprietario";
		$text['address'] = "Indirizzo";
		$text['city'] = "Città";
		$text['state'] = "Provincia";
		$text['zip'] = "Codice Postale";
		$text['country'] = "Paese";
		$text['email'] = "Indirizzo elettronico";
		$text['phone'] = "Telefono";
		$text['username'] = "Nome d'utente";
		$text['password'] = "Parola d'ordine";
		$text['loginfailed'] = "Errore di collegamento.";

		$text['regnewacct'] = "Registrazione nuovamente conta utente";
		$text['realname'] = "il vostro nome vero";
		$text['phone'] = "Telefono";
		$text['email'] = "Indirizzo elettronico";
		$text['address'] = "Indirizzo";
		$text['acctcomments'] = "Note o commenti";
		$text['submit'] = "Sottoporre";
		$text['leaveblank'] = "(lasciare in vuoto se desiderate un nuovo albero)";
		$text['required'] = "Campi necessari";
		$text['enterpassword'] = "Introdurte una parola d'ordine.";
		$text['enterusername'] = "Introdurte un nome d'utente.";
		$text['failure'] = "Il vostro nome d'utente è già preso. Utilizza il bottone indietro del vostro browser per ritornare alla pagina precedente e scegliere un altro nome di utente.";
		$text['success'] = "Grazie. Abbiamo ricevuto la vostra registrazione. Ti contatteremo quando il vostro account sarà attivato o se abbiamo bisogno di più informazioni.";
		$text['emailsubject'] = "Domanda di registrazione di nuovo utente TNG";
		$text['website'] = "Sito web";
		$text['nologin'] = "Non avete profilo di collegamento?";
		$text['loginsent'] = "I vostri dati di collegamento sono stati inviati";
		$text['loginnotsent'] = "I vostri dati di collegamento non sono stati inviati";
		$text['enterrealname'] = "volete inserire il vostro vero nome.";
		$text['rempass'] = "Restate collegati su questo computer";
		$text['morestats'] = "Statistiche addizionali";
		$text['accmail'] = "<strong>NOTA:</strong> Al fine di ricevere la posta dall'amministratore del sito relativo al tuo account, assicurati di non bloccare la posta da questo dominio.";
		$text['newpassword'] = "Nuova Password";
		$text['resetpass'] = "Resettare la vostra Password";
		$text['nousers'] = "Questa forma non può essere usata fino a che almeno un utente record non esista. Se siete il proprietario del sito, vai prego agli utenti di Admin / generare il vostro cliente del coordinatore.";
		$text['noregs'] = "Siamo spiacenti, ma non stiamo accettando i nuovi registri di utente attualmente. Si metta in <a href=\"suggest.php\">contatto</a> con prego direttamente se avete le osservazioni o domande per quanto riguarda qualche cosa su questo luogo.";
		$text['emailmsg'] = "Avete ricevuto una nuova domanda di conto utilizzatore TNG. Volete collegare alla sezione amministrazione di TNG ed accordare le autorizzazioni adeguate a questo nuovo conto. Se approvate questa registrazione, volete informare il richiedente rispondendo questo a message.";
		$text['accactive'] = "Il cliente è stato attivato, ma l'utente non avrà diritti dello special fino a che non li assegniate.";
		$text['accinactive'] = "Vada al Admin/Utenti/Revista accedere alle regolazioni di cliente. Il cliente rimarrà inattivo fino a che non pubblichiate almeno una volta e conserviate l'annotazione.";
		$text['pwdagain'] = "Parola d'accesso ancora";
		$text['enterpassword2'] = "Digiti prego ancora la vostra parola d'accesso.";
		$text['pwdsmatch'] = "Le vostre parole d'accesso non abbinano. Digiti prego la stessa parola d'accesso in ogni campo.";
		$text['acksubject'] = "Grazie per la registrazione"; //for a new user account
		$text['ackmessage'] = "La vostra richiesta per un account utente è stata ricevuta. Il vostro account sarà inattivo fino a che non sarà controllato dal coordinatore del sito. Sarete avvisati per email quando il vostro account sarà attivato.";
		//added in 12.0.0
		$text['switch'] = "Switch";
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
		$text['browseallbranches'] = "Browse All Branches";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Quantità";
		$text['totindividuals'] = "Numero totale di individui";
		$text['totmales'] = "Totale uomini";
		$text['totfemales'] = "Totale donne";
		$text['totunknown'] = "Totale sesso sconosciuto";
		$text['totliving'] = "Totale individui in vita";
		$text['totfamilies'] = "Totale famiglie";
		$text['totuniquesn'] = "Totale nomi di famiglia unici";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Totale fonti";
		$text['avglifespan'] = "Durata di vita media";
		$text['earliestbirth'] = "Nascita più vecchia";
		$text['longestlived'] = "Vita più lunga";
		$text['days'] = "Giorni";
		$text['age'] = "Età";
		$text['agedisclaimer'] = "i calcoli legati all'età sono basati sugli individui con una data di nascita conosciuta ed una data di decesso. A causa dell'esistenza di dati incompleti(p.e. una data di decessi registrata come \"1945 \" o \"avt 1860 \"), questi calcoli non sono precisi al 100%.";
		$text['treedetail'] = "Più informazione su quest'albero";
		$text['total'] = "Totale";
		//added in 12.0
		$text['totdeceased'] = "Total Deceased";
		//added in 14.0
		$text['totalsourcecitations'] = "Total Source Citations";
		break;

	case "notes":
		$text['browseallnotes'] = "Mostrare tutte le note";
		break;

	case "help":
		$text['menuhelp'] = "Chiave del frammento";
		break;

	case "install":
		$text['perms'] = "Tutti i permessi sono stati fissati.";
		$text['noperms'] = "I permessi non hanno potuto essere fissati per queste lime:";
		$text['manual'] = "Prego regolarli manualmente.";
		$text['folder'] = "Dispositivo di piegatura";
		$text['created'] = "è stato generato";
		$text['nocreate'] = "non ha potuto essere generato. Si prega di generarlo manualmente.";
		$text['infosaved'] = "Le informazioni conservate, il collegamento hanno verificato!";
		$text['tablescr'] = "Le tabelle sono state generate!";
		$text['notables'] = "Le seguenti tabelle non hanno potuto essere generate:";
		$text['nocomm'] = "TNG non sta comunicando con la vostra base di dati. Nessuna tabella è stata generata.";
		$text['newdb'] = "Le informazioni conservate, il collegamento verificato, nuova base di dati hanno generato:";
		$text['noattach'] = "Le informazioni hanno risparmiato. Il collegamento fatto e la base di dati generata, ma TNG non possono attaccare ad esso.";
		$text['nodb'] = "Le informazioni hanno risparmiato. Il collegamento fatto, ma la base di dati non esiste e non potrebbe essere generata qui. Verifichi prego che il nome di base di dati sia corretto, o usi il vostro quadro di controllo per generarlo.";
		$text['noconn'] = "Le informazioni conservate ma il collegamento sono venuto a mancare. Uno o piÃ¹ di quanto segue sono errati:";
		$text['exists'] = "Esiste";
		$text['noop'] = "Nessun funzionamento è stato realizzato.";
		//added in 8.0.0
		$text['nouser'] = "L'utente non è stato generato. Il username può già esistere.";
		$text['notree'] = "L'albero non è stato generato. L'identificazione dell'albero può già esistere.";
		$text['infosaved2'] = "Informazioni memorizzate";
		$text['renamedto'] = "rinominato";
		$text['norename'] = "non poteva essere rinominato";
		//changed in 13.0.0
		$text['loginfirst'] = "Sono stati rilevati i record degli utenti esistenti.  Per procedere è necessario anzitutto accedere o rimuovere tutti i record dalla tabella utenti.";
		break;

	case "imgviewer":
		$text['magmode'] = "Ingrandire modalità";
		$text['panmode'] = "Panoramicare modalità";
		$text['pan'] = "Fare clic e trascinare per spostare all'interno dell'immagine";
		$text['fitwidth'] = "Adatta alla Larghezza";
		$text['fitheight'] = "Adatta in Altezza";
		$text['newwin'] = "Nuova finestra";
		$text['opennw'] = "Apri l'immagine in una nuova finestra";
		$text['magnifyreg'] = "Clicca per ingrandire una regione dell'immagine";
		$text['imgctrls'] = "Attiva controlli immagine";
		$text['vwrctrls'] = "Attiva controllli visualizzatore di immagini";
		$text['vwrclose'] = "Chiudere il visualizzatore di immagini";
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
$text['matches'] = "Risultati";
$text['description'] = "Descrizione";
$text['notes'] = "Note";
$text['status'] = "Statuto";
$text['newsearch'] = "Nuova ricerca";
$text['pedigree'] = "Albero";
$text['seephoto'] = "Vedi fotografia";
$text['andlocation'] = "& luogo";
$text['accessedby'] = "consultato da";
$text['children'] = "Figlie";  //from getperson
$text['tree'] = "Albero";
$text['alltrees'] = "Tutti gli alberi";
$text['nosurname'] = "[nessun cognome]";
$text['thumb'] = "Etichetta";  //as in Thumbnail
$text['people'] = "Persone";
$text['title'] = "Titolo";  //from getperson
$text['suffix'] = "Suffisso";  //from getperson
$text['nickname'] = "Soprannome";  //from getperson
$text['lastmodified'] = "Ultimo modif.";  //from getperson
$text['married'] = "Sposato";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nome"; //from showmap
$text['lastfirst'] = "Nome, nome dato(i)";  //from search
$text['bornchr'] = "Nato/battezzato";  //from search
$text['individuals'] = "Persone";  //from whats new
$text['families'] = "Famiglie";
$text['personid'] = "ID persona";
$text['sources'] = "Fonti";  //from getperson (next several)
$text['unknown'] = "Sconosciuto";
$text['father'] = "Padre";
$text['mother'] = "Madre";
$text['christened'] = "Battezzato(a)";
$text['died'] = "Morto(a)";
$text['buried'] = "Sepolto(a)";
$text['spouse'] = "Coniuge";  //from search
$text['parents'] = "Genitori";  //from pedigree
$text['text'] = "Testo";  //from sources
$text['language'] = "Lingua";  //from languages
$text['descendchart'] = "Discendenti";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Persone";
$text['edit'] = "Pubblicare";
$text['date'] = "Data";
$text['login'] = "Collegarsi";
$text['logout'] = "Staccarsi";
$text['groupsheet'] = "Strato familiare";
$text['text_and'] = "e";
$text['generation'] = "Generazione";
$text['filename'] = "Nome del file";
$text['id'] = "ID";
$text['search'] = "Cercare";
$text['user'] = "Utilizzatore";
$text['firstname'] = "Primo nome";
$text['lastname'] = "Cognome";
$text['searchresults'] = "Risultati della ricerca";
$text['diedburied'] = "Deceduto/inumato";
$text['homepage'] = "Home";
$text['find'] = "Ricerca...";
$text['relationship'] = "Relazione";		//in German, Verwandtschaft
$text['relationship2'] = "Rapporto"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Linea del tempo";
$text['yesabbr'] = "Si";               //abbreviation for 'yes'
$text['divorced'] = "Divorziato";
$text['indlinked'] = "Legato a";
$text['branch'] = "Ramo";
$text['moreind'] = "Più individui";
$text['morefam'] = "Più famiglie";
$text['surnamelist'] = "Lista dei cognome";
$text['generations'] = "Generazioni";
$text['refresh'] = "Rinfrescare";
$text['whatsnew'] = "Che di nuovo?";
$text['reports'] = "Ripporti";
$text['placelist'] = "Lista di luoghi";
$text['baptizedlds'] = "Battezzato (LDS)";
$text['endowedlds'] = "Dotato (LDS)";
$text['sealedplds'] = "Dotato genitori (LDS)";
$text['sealedslds'] = "Coniuge dotato (LDS)";
$text['ancestors'] = "Antenati";
$text['descendants'] = "Discendenti";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Data dell'ultima importazione GEDCOM";
$text['type'] = "Tipo";
$text['savechanges'] = "Registrare le modifiche";
$text['familyid'] = "ID famiglia";
$text['headstone'] = "Lapidi";
$text['historiesdocs'] = "Storie";
$text['anonymous'] = "Anonimo";
$text['places'] = "Luoghi";
$text['anniversaries'] = "Data e Anniversario";
$text['administration'] = "Amministrazione";
$text['help'] = "Aiuto";
//$text['documents'] = "Documents";
$text['year'] = "Anno";
$text['all'] = "Tutti";
$text['address'] = "Indirizzo";
$text['suggest'] = "Proposta";
$text['editevent'] = "Suggerite una modifica per quest'evento";
$text['morelinks'] = "Più legami";
$text['faminfo'] = "Informazione sulla famiglia";
$text['persinfo'] = "Informazione Personelle";
$text['srcinfo'] = "Info. sulla fonte";
$text['fact'] = "Fatto";
$text['goto'] = "Scegliete una pagina";
$text['tngprint'] = "Stampare";
$text['databasestatistics'] = "Statistiche della base di dati"; //needed to be shorter to fit on menu
$text['child'] = "Bambino";  //from familygroup
$text['repoinfo'] = "Info. luogo di deposito";
$text['tng_reset'] = "Rimettere a zero";
$text['noresults'] = "Nulla risultato";
$text['allmedia'] = "Tutti Media";
$text['repositories'] = "Deposito";
$text['albums'] = "Album";
$text['cemeteries'] = "Cimiteri";
$text['surnames'] = "Cognome";
$text['dates'] = "Data";
$text['link'] = "Collegare";
$text['media'] = "Media";
$text['gender'] = "Genere";
$text['latitude'] = "Latitudine";
$text['longitude'] = "Longitudine";
$text['bookmarks'] = "Bookmark";
$text['bookmark'] = "Aggiungi Bookmark";
$text['mngbookmarks'] = "Andare a Bookmarks";
$text['bookmarked'] = "Bookmark Aggiungiato";
$text['remove'] = "Togliere";
$text['find_menu'] = "Trovare";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cimiteri";
$text['gmapevent'] = "Mappa Evento ";
$text['gevents'] = "Evento";
$text['googleearthlink'] = "Collegamento a Google Earth";
$text['googlemaplink'] = "Collegamento a Google Maps";
$text['gmaplegend'] = "Perno Leggenda";
$text['unmarked'] = "Non segnata (s)";
$text['located'] = "Situato(i)";
$text['albclicksee'] = "Premere per vedere tutti gli articoli in questo album";
$text['notyetlocated'] = "Non ancora individuato";
$text['cremated'] = "Cremato";
$text['missing'] = "Perso";
$text['pdfgen'] = "Generatore del PDF";
$text['blank'] = "Tabella in bianco";
$text['fonts'] = "Fonti";
$text['header'] = "Intestazione";
$text['data'] = "Dati";
$text['pgsetup'] = "Messa a punto di pagina";
$text['pgsize'] = "Formato di pagina";
$text['orient'] = "Orientamento"; //for a page
$text['portrait'] = "Ritratto";
$text['landscape'] = "Paesaggio";
$text['tmargin'] = "Margine superiore";
$text['bmargin'] = "Margine inferiore";
$text['lmargin'] = "Margine di sinistra";
$text['rmargin'] = "Margine di destra";
$text['createch'] = "Generi la tabella";
$text['prefix'] = "Prefisso";
$text['mostwanted'] = "La maggior parte hanno voluto";
$text['latupdates'] = "Aggiornamenti ultimi";
$text['featphoto'] = "Foto descritta";
$text['news'] = "Notizie";
$text['ourhist'] = "La nostra storia di famiglia";
$text['ourhistanc'] = "Nostre storia di famiglia ed ascendenza";
$text['ourpages'] = "Le nostre pagine di genealogia della famiglia";
$text['pwrdby'] = "Powered by";
$text['writby'] = "scritto da";
$text['searchtngnet'] = "Rete di ricerca TNG (GENDEX)";
$text['viewphotos'] = "Osservi tutte le foto";
$text['anon'] = "Siete attualmente anonimo";
$text['whichbranch'] = "Quale ramo siete?";
$text['featarts'] = "Articoli speciali";
$text['maintby'] = "Effettuato da";
$text['createdon'] = "Generato sopra";
$text['reliability'] = "Affidabilità";
$text['labels'] = "Etichette";
$text['inclsrcs'] = "Includi fonti";
$text['cont'] = "(cont.)"; //abbreviation for continued
$text['mnuheader'] = "Home";
$text['mnusearchfornames'] = "Cerca nomi";
$text['mnulastname'] = "Cognome";
$text['mnufirstname'] = "Primo nome";
$text['mnusearch'] = "Cercare";
$text['mnureset'] = "Ricomincia";
$text['mnulogon'] = "Login";
$text['mnulogout'] = "Logout";
$text['mnufeatures'] = "Altre funzioni";
$text['mnuregister'] = "Registrati";
$text['mnuadvancedsearch'] = "Ricerca Avanzata";
$text['mnulastnames'] = "Cognome";
$text['mnustatistics'] = "Statistici";
$text['mnuphotos'] = "Fotografie";
$text['mnuhistories'] = "Storie";
$text['mnumyancestors'] = "Fotografie &amp; Storie per Antenati di [Persona]";
$text['mnucemeteries'] = "Cimiteri";
$text['mnutombstones'] = "Lapidi";
$text['mnureports'] = "Rapporti";
$text['mnusources'] = "Fonti";
$text['mnuwhatsnew'] = "Che di nuovo?";
$text['mnushowlog'] = "Giornale d'Accesso";
$text['mnulanguage'] = "Cambiare lingua";
$text['mnuadmin'] = "Amministrazione";
$text['welcome'] = "Benvenuti";
$text['contactus'] = "Contattaci";
//changed in 8.0.0
$text['born'] = "Nato(a)";
$text['searchnames'] = "Ricerca";
//added in 8.0.0
$text['editperson'] = "Modifica la persona";
$text['loadmap'] = "Carica la mappa";
$text['birth'] = "Nascita";
$text['wasborn'] = "nasceva";
$text['startnum'] = "Primo numero";
$text['searching'] = "Ricerca";
//moved here in 8.0.0
$text['location'] = "Posizione";
$text['association'] = "Associazione";
$text['collapse'] = "Ridurre";
$text['expand'] = "Sviluppare";
$text['plot'] = "Edificabile";
$text['searchfams'] = "Ricerca Famiglie";
//added in 8.0.2
$text['wasmarried'] = "Sposato";
$text['anddied'] = "Morto(a)";
//added in 9.0.0
$text['share'] = "Dividere";
$text['hide'] = "Nascondere";
$text['disabled'] = "Il tuo conto utente è stato disattivato. Si prega di contattare l'amministratore del sito per ulteriori informazioni.";
$text['contactus_long'] = "Se avete domande o commenti su questo sito, <span class=\"emphasis\"><a href=\"suggest.php\">contatti</a></span>. Non vediamo l'ora di sentire qualcosa da te.";
$text['features'] = "Caratteristiche";
$text['resources'] = "Risorse";
$text['latestnews'] = "Ultime Notizie";
$text['trees'] = "gli alberi";
$text['wasburied'] = "è stato sepolto";
//moved here in 9.0.0
$text['emailagain'] = "E-mail di nuovo";
$text['enteremail2'] = "Inserisci il tuo indirizzo e-mail di nuovo.";
$text['emailsmatch'] = "I tuoi indirizzi e-mail non corrispondono. Inserisci lo stesso indirizzo e-mail in ogni campo.";
$text['getdirections'] = "Premi per ottenere indicazioni";
$text['calendar'] = "Calendario";
//changed in 9.0.0
$text['directionsto'] = " al ";
$text['slidestart'] = "Diapositive";
$text['livingnote'] = "Almeno una persona viva è legata a questa nota - i dettagli non sono dunque pubblicati.";
$text['livingphoto'] = "Almeno un individuo vivo è legato a questa fotografia - Dettagli nascosti.";
$text['waschristened'] = "Battezzato(a)";
//added in 10.0.0
$text['branches'] = "Branches";
$text['detail'] = "Detail";
$text['moredetail'] = "More detail";
$text['lessdetail'] = "Less detail";
$text['conflds'] = "Confirmed (LDS)";
$text['initlds'] = "Initiatory (LDS)";
$text['wascremated'] = "was cremated";
//moved here in 11.0.0
$text['text_for'] = "per";
//added in 11.0.0
$text['searchsite'] = "Search this site";
$text['searchsitemenu'] = "Cerca nel sito";
$text['kmlfile'] = "Scaricare un file .kml per mostrare questa posizione in Google Earth";
$text['download'] = "Clicca per scaricare";
$text['more'] = " più";
$text['heatmap'] = "Heat Map";
$text['refreshmap'] = "Refresh Map";
$text['remnums'] = "cancellare i numeri ed Pins";
$text['photoshistories'] = "Foto &amp; storie";
$text['familychart'] = "Famiglia grafico";
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
$text['cookieuse'] = "Nota: questo sito utilizza i cookie.";
$text['dataprotect'] = "Criterio di protezione dati";
$text['viewpolicy'] = "Visualizza i criteri";
$text['understand'] = "Ho capito";
$text['consent'] = "Io do il mio consenso per questo sito per memorizzare i dati personali raccolti qui. Capisco che io possa chiedere al proprietario del sito di rimuovere queste informazioni in qualsiasi momento.";
$text['consentreq'] = "Si prega di dare il vostro consenso per questo sito per memorizzare le informazioni personali.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Collegamenti rapidi";
$text['yourname'] = "Il tuo nome";
$text['youremail'] = "Il tuo indirizzo email";
$text['liketoadd'] = "Tutte le informazioni che desideri aggiungere";
$text['webmastermsg'] = "Messaggio del webmaster";
$text['gallery'] = "Vedi Gallery";
$text['wasborn_male'] = "è nato";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "è nato"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "è stato battezzato";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "è stato battezzato";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "morto";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "morto";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "è stato sepolto"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "è stato sepolto"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "era cremato";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "era cremato";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "sposato";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "sposato";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "era divorziato";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "era divorziato";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = "in";			// used as a preposition to the location
$text['onthisdate'] = "on";		// when used with full date
$text['inthisyear'] = "in";		// when used with year only or month / year dates
$text['and'] = "and";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Test Info";
//added in 13.0
$text['visitor'] = "Visitatore";

$text['popupnote2'] = "Nuovo albero";

//moved here in 14.0
$text['zoomin'] = "Zumare";
$text['zoomout'] = "Zumare all’indietro.";
$text['scrollnote'] = "Trascinare o scorrere per vedere di più del grafico.";
$text['general'] = "Generalità";

//changed in 14.0
$text['otherevents'] = "Altri Eventi";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Connections";
$text['continue'] = "Continue";
$text['title2'] = "Title"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>