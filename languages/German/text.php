<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Alle Quellen anzeigen";
		$text['shorttitle'] = "Kurztitel";
		$text['callnum'] = "Signatur";
		$text['author'] = "Autor";
		$text['publisher'] = "Veröffentlicht durch";
		$text['other'] = "Zusätzliche Angaben";
		$text['sourceid'] = "Quellen-Kennung";
		$text['moresrc'] = "Weitere Quellen";
		$text['repoid'] = "Aufbewahrungs-Kennung";
		$text['browseallrepos'] = "Alle Aufbewahrungsorte durchblättern";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Neue Sprache";
		$text['changelanguage'] = "Sprache ändern";
		$text['languagesaved'] = "Sprache gespeichert";
		$text['sitemaint'] = "Momentan werden auf dieser Website Wartungsarbeiten durchgeführt";
		$text['standby'] = "Diese Website ist zeitweilig nicht verfügbar, da eine Datenbank-Aktualisierung läuft. Bitte versuchen Sie es in einigen Minuten nochmals. Falls diese Website für längere Zeit nicht verfügbar bleibt, so <a href=\"suggest.php\">wenden Sie sich bitte an den Verwalter</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM-Datei startet bei";
		$text['producegedfrom'] = "GEDCOM-Datei erzeugen ab";
		$text['numgens'] = "Anzahl Generationen";
		$text['includelds'] = "einschließlich LDS-Angaben";
		$text['buildged'] = "Erzeuge GEDCOM-Datei";
		$text['gedstartfrom'] = "GEDCOM-Datei beginnt mit";
		$text['nomaxgen'] = "Sie müssen die maximale Zahl der Generationen angeben. Bitte mit 'Zurück' zur vorangehenden Seite und den Fehler beheben";
		$text['gedcreatedfrom'] = "GEDCOM-Datei erstellt ab";
		$text['gedcreatedfor'] = "Erstellt für";
		$text['creategedfor'] = "GEDCOM-Datei erzeugen";
		$text['email'] = "E-Mail";
		$text['suggestchange'] = "Änderungsvorschlag für";
		$text['yourname'] = "Ihr Name";
		$text['comments'] = "Notiz oder Kommentar";
		$text['comments2'] = "Ihre Mitteilung";
		$text['submitsugg'] = "Absenden";
		$text['proposed'] = "Vorgeschlagene Änderung";
		$text['mailsent'] = "Ihre Mitteilung wurde abgeschickt. Vielen Dank.";
		$text['mailnotsent'] = "Ihre Mitteilung konnte nicht gesendet werden. Bitte wenden Sie sich an xxx (E-Mail: yyy).";
		$text['mailme'] = "Kopie an diese Adresse senden";
		$text['entername'] = "Bitte geben Sie Ihren Namen ein";
		$text['entercomments'] = "Bitte geben Sie Ihre Mitteilung ein";
		$text['sendmsg'] = "Nachricht absenden";
		//added in 9.0.0
		$text['subject'] = "Titel";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotos und Geschichten von";
		$text['indinfofor'] = "Individuelle Angaben über";
		$text['pp'] = "S."; //page abbreviation
		$text['age'] = "Alter";
		$text['agency'] = "Stelle";
		$text['cause'] = "Ursache";
		$text['suggested'] = "Vorgeschlagene Änderung";
		$text['closewindow'] = "Fenster schließen";
		$text['thanks'] = "Vielen Dank";
		$text['received'] = "Ihre Anmerkung wurde zur Überprüfung an den Betreuer dieser Website gesendet.";
		$text['indreport'] = "Personen-Datenblatt";
		$text['indreportfor'] = "Personen-Datenblatt für";
		$text['bkmkvis'] = "<strong>Hinweis:</strong> Diese Lesezeichen sind nur auf diesem Rechner und nur mit diesem Browser sichtbar.";
        //added in 9.0.0
		$text['reviewmsg'] = "Sie haben einen Änderungsvorschlag erhalten, der Ihre Überprüfung benötigt. Dieser Vorschlag betrifft:";
        $text['revsubject'] = "Ein Änderungsvorschlag benötigt Ihre Überprüfung";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Verwandtschaftsrechner";
		$text['findrel'] = "Verwandtschaftsbeziehung darstellen";
		$text['person1'] = "Person 1:";
		$text['person2'] = "Person 2:";
		$text['calculate'] = "Berechnen";
		$text['select2inds'] = "Bitte zwei Personen auswählen.";
		$text['findpersonid'] = "Suche Personen-Kennung";
		$text['enternamepart'] = "Tragen Sie einen Teil des Vor- oder Nachnamens ein";
		$text['pleasenamepart'] = "Bitte tragen Sie einen Teil des Vor- oder Nachnamens ein.";
		$text['clicktoselect'] = "Klicken Sie einen Eintrag an, um ihn auszuwählen";
		$text['nobirthinfo'] = "Keine Geburts-Angaben";
		$text['relateto'] = "Verwandtschaftsbeziehung mit";
		$text['sameperson'] = "Die beiden Individuen sind dieselbe Person.";
		$text['notrelated'] = "Die zwei Personen sind nicht innerhalb von xxx Generationen verwandt."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Personen-Kennungen eingeben (oder angezeigte belassen), dann auf 'Berechnen' klicken, um die Verwandtschaftsbeziehung darzustellen.";
		$text['sometimes'] = "(Manchmal ergibt eine andere Anzahl von Generationen ein anderes Ergebnis.)";
		$text['findanother'] = "Eine andere Verwandtschaftsbeziehung suchen";
		$text['brother'] = "der Bruder von";
		$text['sister'] = "die Schwester von";
		$text['sibling'] = "der Bruder/die Schwester von";
		$text['uncle'] = "der xxx Onkel von";
		$text['aunt'] = "die xxx Tante von";
		$text['uncleaunt'] = "der xxx Onkel/die xxx Tante von";
		$text['nephew'] = "der xxx Neffe von";
		$text['niece'] = "die xxx Nichte von";
		$text['nephnc'] = "der xxx Neffe/die xxx Nichte von";
		$text['removed'] = "fach entfernt";
		$text['rhusband'] = "der/dem Ehemann von ";
		$text['rwife'] = "die/der Ehefrau von ";
		$text['rspouse'] = "der Ehemann/die Ehefrau von ";
		$text['son'] = "der Sohn von";
		$text['daughter'] = "die Tochter von";
		$text['rchild'] = "das Kind von";
		$text['sil'] = "der Schwiegersohn von";
		$text['dil'] = "die Schwiegertochter von";
		$text['sdil'] = "der Schwiegersohn/die Schwiegertochter von";
		$text['gson'] = "der xxx Enkel von";
		$text['gdau'] = "die xxx Enkelin von";
		$text['gsondau'] = "der xxx Enkel/die xxx Enkelin von";
		$text['great'] = "Groß-";
		$text['spouses'] = "sind Ehepartner";
		$text['is'] = "ist";
		$text['changeto'] = "Ändere zu:";
		$text['notvalid'] = "ist keine gültige Personen-Kennung oder existiert nicht in dieser Datenbank. Bitte nochmals versuchen.";
		$text['halfbrother'] = "der Halbbruder von";
		$text['halfsister'] = "die Halbschwester von";
		$text['halfsibling'] = "Halbgeschwister von";
		//changed in 8.0.0
		$text['gencheck'] = "Maximale Anzahl der<br />zu berücksichtigenden Generationen";
		$text['mcousin'] = "der xxx Cousin (Vetter) yyy von";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "die xxx Cousine (Base) yyy von";  //female cousin
		$text['cousin'] = "der xxx Cousin (Vetter)/die xxx Cousine (Base) yyy von";
		$text['mhalfcousin'] = "der xxx Halb-Cousin (Halb-Vetter) yyy von";  //male cousin
		$text['fhalfcousin'] = "die xxx Halb-Cousine (Halb-Base) yyy von";  //female cousin
		$text['halfcousin'] = "xxx Halb-Cousin/Halb-Cousine (Halb-Vetter/Halb-Base) yyy von";
		//added in 8.0.0
		$text['oneremoved'] = "einfach entfernt";
		$text['gfath'] = "der xxx Großvater von";
		$text['gmoth'] = "die xxx Großmutter von";
		$text['gpar'] = "die xxx Großeltern von";
		$text['mothof'] = "die Mutter von";
		$text['fathof'] = "der Vater von";
		$text['parof'] = "die Eltern von";
		$text['maxrels'] = "Max. Anzahl der Beziehungen";
		$text['dospouses'] = "Auch Beziehungen über einen Ehepartner anzeigen";
		$text['rels'] = "Anzahl Beziehungen";
		$text['dospouses2'] = "Zeige Ehepartner";
		$text['fil'] = "der Schwiegervater von";
		$text['mil'] = "die Schwiegermutter von";
		$text['fmil'] = "der Schwiegervater oder die Schwiegermutter von";
		$text['stepson'] = "der Stiefsohn von";
		$text['stepdau'] = "die Stieftochter von";
		$text['stepchild'] = "das Stiefkind von";
		$text['stepgson'] = "der xxx Stiefenkel von";
		$text['stepgdau'] = "die xxx Stiefenkelin von";
		$text['stepgchild'] = "das xxx Stiefenkelkind von";
		//added in 8.1.1
		$text['ggreat'] = "Ur-";
		//added in 8.1.2
		$text['ggfath'] = "der xxx Urgroßvater von";
		$text['ggmoth'] = "die xxx Urgroßmutter von";
		$text['ggpar'] = "die xxx Urgroßeltern von";
		$text['ggson'] = "der xxx Urenkel von";
		$text['ggdau'] = "die xxx Urenkelin von";
		$text['ggsondau'] = "das xxx Urenkelkind";
		$text['gstepgson'] = "der xxx Stiefurenkel von";
		$text['gstepgdau'] = "die xxx Stiefurenkelin von";
		$text['gstepgchild'] = "das xxx Stiefurenkelkind von";
		$text['guncle'] = "der xxx Großonkel von";
		$text['gaunt'] = "die xxx Großtante von";
		$text['guncleaunt'] = "der/die xxx Großonkel/Großtante von";
		$text['gnephew'] = "der xxx Großneffe von";
		$text['gniece'] = "die xxx Großnichte von";
		$text['gnephnc'] = "der/die xxx Großneffe/Großnichte von";
		//added in 14.0
		$text['pathscalc'] = "Nach Verbindungen suchen";
		$text['findrel2'] = "Suche Verwandtschaft und andere Verbindungen";
		$text['makeme2nd'] = "Verwende meine ID";
		$text['usebookmarks'] = "verwende Favoriten";
		$text['select2inds'] = "Bitte zwei Personen auswählen.";
		$text['indinfofor'] = "Personeninformation zu";
		$text['nobookmarks'] = "Es gibt keinen Favoriteneintrag";
		$text['bkmtitle'] = "Mehrere Personen in Favoriten gefunden";
		$text['bkminfo'] = "Wähle eine Person aus:";
		$text['sortpathsby'] = "Pfade sortieren nach Anzahl von";
		$text['sortbyshort'] = "Sortieren nach";
		$text['bylengthshort'] = "Länge";
		$text['badID1'] = ": Falsche ID für person1 - bitte zurückgehen und korrigieren";
		$text['badID2'] = ": Falsche ID für person2 - bitte zurückgehen und korrigieren";
		$text['notintree'] = ": Die Person mit dieser ID ist nicht im aktuellen Zweig.";
		$text['sameperson'] = "Die beiden Individuen sind dieselbe Person.";;
		$text['nopaths'] = "Diese Personen haben keine Verbindung.";
		$text['nopaths1'] = "Keine weiteren Verbindungen kürzer als xxx";
		$text['nopaths2'] = "in xxx Suchschritten";
		$text['longestpath'] = "(Der bis jetzt längste überprüfte Pfad war xxx Schritte lang)";
		$text['relevantpaths'] = "Anzahl gefundener relevanten Pfade: xxx";
		$text['skipMarr'] = "(zusätzlich, Anzahl gefundener aber wegen zu vieler Heiraten nicht dargestellter Pfade: xxx)";
		$text['mjaor'] = "oder";
		$text['connectionsto'] = "Verbindungen zu ";
		$text['findanotherpers'] = "Suche eine andere Person...";
		$text['sometimes'] = "(Manchmal ergibt eine andere Anzahl von Generationen ein anderes Ergebnis.)";
		$text['anotherpath'] = "Suche nach anderen Verbindungen";
		$text['xpath'] = "Pfad ";
		$text['primary'] = "Start Person"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "End Person";
		$text['parent'] = "Eltern";
		$text['mhfather'] = "sein Vater";
		$text['mhmother'] = "seine Mutter";
		$text['mhhusband'] = "sein Ehemann";
		$text['mhwife'] = "seine Ehefrau";
		$text['mhson'] = "sein Sohn";
		$text['mhdaughter'] = "seine Tochter";
		$text['fhfather'] = "ihr Vater";
		$text['fhmother'] = "her mother";
		$text['fhhusband'] = "ihr Ehemann";
		$text['fhwife'] = "ihre Ehefrau";
		$text['fhson'] = "ihr Sohn";
		$text['fhdaughter'] = "ihre Tochter";
		$text['hfather'] = "Vater";
		$text['hmother'] = "Mutter";
		$text['hhusband'] = "Ehemann";
		$text['hwife'] = "Ehefrau";
		$text['hson'] = "Sohn";
		$text['hdaughter'] = "Tochter";
		$text['maxruns'] = "Max. Anzahl Pfade zur Überprüfung";
		$text['maxrshort'] = "Max. Anzahl Pfade";
		$text['maxlength'] = "Verbindungspfade nicht länger als";
		$text['maxlshort'] = "Max. Länge";
		$text['xstep'] = "Schritt";
		$text['xsteps'] = "Schritte";
		$text['xmarriages'] = "xxx Eheschließungen";
		$text['xmarriage'] = "1 Eheschließung";
		$text['showspouses'] = "Zeige beide Ehepartner";
		$text['showTxt'] = "Zeige die Pfadbeschreibung als Text";
		$text['showTxtshort'] = "Beschreibungstext.";
		$text['compactBox'] = "Zeige Personen-Kästchen in kompakter Form";
		$text['compactBoxshort'] = "Kompakte Kästchen";
		$text['paths'] = "Pfade";
		$text['dospouses2'] = "Zeige Ehepartner";
		$text['maxmopt'] = "Max. Anzahl Eheschließungen pro Verbindung";
		$text['maxm'] = "Max. Anzahl Eheschließungen";
		$text['arerelated'] = "Diese Personen sind Verwandte - Ihre Beziehung ist in Pfad 1 dargestellt";
		$text['simplerel'] = "Einfache Verwandtschaftssuche";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Familienblatt von";
		$text['ldsords'] = "LDS Anordnungen";
		$text['baptizedlds'] = "Getauft (LDS)";
		$text['endowedlds'] = "Begabung (LDS)";
		$text['sealedplds'] = "Siegelung an die Eltern (LDS)";
		$text['sealedslds'] = "Siegelung an den Ehepartner (LDS)";
		$text['otherspouse'] = "Andere Ehepartner";
		$text['husband'] = "Vater";
		$text['wife'] = "Mutter";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "*";
		$text['capaltbirthabbr'] = "in";
		$text['capdeathabbr'] = "+";
		$text['capburialabbr'] = "begr.";
		$text['capplaceabbr'] = "in";
		$text['capmarrabbr'] = "oo";
		$text['capspouseabbr'] = "Gatt.";
		$text['redraw'] = "Neu zeichnen mit";
		$text['unknownlit'] = "Unbekannt";
		$text['popupnote1'] = " = Zusatz-Angaben";
		$text['pedcompact'] = "Kompakt";
		$text['pedstandard'] = "Standard";
		$text['pedtextonly'] = "Nur Text";
		$text['descendfor'] = "Nachkommen von";
		$text['maxof'] = "Maximum";
		$text['gensatonce'] = "Generationen gleichzeitig anzeigen.";
		$text['sonof'] = "Sohn von";
		$text['daughterof'] = "Tochter von";
		$text['childof'] = "Kind von";
		$text['stdformat'] = "Standardformat";
		$text['ahnentafel'] = "Ahnenliste";
		$text['addnewfam'] = "Neue Familie anlegen";
		$text['editfam'] = "Familie bearbeiten";
		$text['side'] = "-Seite";
		$text['familyof'] = "Familie von";
		$text['paternal'] = "Väterlicherseits";
		$text['maternal'] = "Mütterlicherseits";
		$text['gen1'] = "Selbst";
		$text['gen2'] = "Eltern";
		$text['gen3'] = "Großeltern";
		$text['gen4'] = "Urgroßeltern";
		$text['gen5'] = "Alteltern";
		$text['gen6'] = "Altgroßeltern";
		$text['gen7'] = "Alturgroßeltern";
		$text['gen8'] = "Obereltern";
		$text['gen9'] = "Obergroßeltern";
		$text['gen10'] = "Oberurgroßeltern";
		$text['gen11'] = "Stammeltern";
		$text['gen12'] = "Stammgroßeltern";
		$text['graphdesc'] = "Graphische Anzeige der Nachkommen";
		$text['pedbox'] = "Rahmen";
		$text['regformat'] = "Registerformat";
		$text['extrasexpl'] = "Falls für die folgenden Personen Fotos oder Geschichten vorhanden sind, werden die entsprechenden Vorschaubilder bei den Namen angezeigt.";
		$text['popupnote3'] = " = Neues Diagramm";
		$text['mediaavail'] = "Medien verfügbar";
		$text['pedigreefor'] = "Ahnentafel für";
		$text['pedigreech'] = "Ahnentafel";
		$text['datesloc'] = "Daten und Orte";
		$text['borchr'] = "Geburt/Taufe - Tod/Beerdigung (zwei)";
		$text['nobd'] = "Keine Angaben zu Geburt oder Tod";
		$text['bcdb'] = "Geburt/Taufe/Tod/Beerdigung (vier)";
		$text['numsys'] = "Nummerierungs-System";
		$text['gennums'] = "Generations-Nummern";
		$text['henrynums'] = "Nummerierung nach Henry";
		$text['abovnums'] = "Nummerierung nach d'Aboville";
		$text['devnums'] = "Nummerierung nach de Villiers";
		$text['dispopts'] = "Anzeige-Optionen";
		//added in 10.0.0
		$text['no_ancestors'] = "Keine Vorfahren gefunden";
		$text['ancestor_chart'] = "Vertikale Ahnentafel";
		$text['opennewwindow'] = "In einem neuen Fenster öffnen";
		$text['pedvertical'] = "Vertikal";
		//added in 11.0.0
		$text['familywith'] = "Familie mit";
		$text['fcmlogin'] = "Bitte einloggen, um die Details zu sehen";
		$text['isthe'] = "ist der/die";
		$text['otherspouses'] = "andere Partner";
		$text['parentfamily'] = "Die Eltern-Familie ";
		$text['showfamily'] = "Die Familie zeigen";
		$text['shown'] = "gezeigt";
		$text['showparentfamily'] = "Eltern-Familie zeigen";
		$text['showperson'] = "Person zeigen";
		//added in 11.0.2
		$text['otherfamilies'] = "Andere Familien";
		//added in 14.0
		$text['dtformat'] = "Tabellen";
		$text['dtchildren'] = "Kinder";
		$text['dtgrandchildren'] = "Enkel";
		$text['dtggrandchildren'] = "Urenkel";
		$text['dtgggrandchildren'] = "Urenkel"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Keine Nachkommen";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Gesamt";
		$text['dtselect'] = "Auswahl";
		$text['dteachfulltable'] = "Jede volle Tabelle wird";
		$text['dtrows'] = "Zeilen";
		$text['dtdisplayingtable'] = "Tabellendarstellung";
		$text['dtgototable'] = "Gehe zur Tabelle:";
		$text['fcinstrdn'] = "Zeige Familie mit Ehepartner";
		$text['fcinstrup'] = "Zeige Familie mit Eltern";
		$text['fcinstrplus'] = "Wähle andere Ehepartner";
		$text['fcinstrfam'] = "Wähle andere Eltern";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Es sind keine Berichte vorhanden.";
		$text['reportname'] = "Name des Bericht";
		$text['allreports'] = "Alle Berichte";
		$text['report'] = "Bericht";
		$text['error'] = "Fehler";
		$text['reportsyntax'] = "Die Syntax der Suchabfrage für diesen Bericht";
		$text['wasincorrect'] = "ist ungültig, deswegen kann dieser Bericht nicht erstellt werden. Benachrichtigen Sie den Systemverantwortlichen";
		$text['errormessage'] = "Fehlermeldung";
		$text['equals'] = "ist gleich";
		$text['endswith'] = "endet auf";
		$text['soundexof'] = "soundex von";
		$text['metaphoneof'] = "metafon von";
		$text['plusminus10'] = "+/- 10 Jahre von";
		$text['lessthan'] = "kleiner als";
		$text['greaterthan'] = "größer als";
		$text['lessthanequal'] = "kleiner oder gleich";
		$text['greaterthanequal'] = "größer oder gleich";
		$text['equalto'] = "ist gleich";
		$text['tryagain'] = "Bitte erneut versuchen";
		$text['joinwith'] = "Verknüpfen mit";
		$text['cap_and'] = "UND";
		$text['cap_or'] = "ODER";
		$text['showspouse'] = "Zeige Partner. Dubletten werden gezeigt, wenn eine Person mehrere Partner hat";
		$text['submitquery'] = "Suche";
		$text['birthplace'] = "Geburtsort";
		$text['deathplace'] = "Sterbeort";
		$text['birthdatetr'] = "Geburtsjahr";
		$text['deathdatetr'] = "Sterbejahr";
		$text['plusminus2'] = "+/- 2 Jahre von";
		$text['resetall'] = "Alle Werte zurücksetzen";
		$text['showdeath'] = "Zeige Todestag/Beerdigungsangaben";
		$text['altbirthplace'] = "Ort der Taufe";
		$text['altbirthdatetr'] = "Jahr der Taufe";
		$text['burialplace'] = "Ort der Beerdigung";
		$text['burialdatetr'] = "Jahr der Beerdigung";
		$text['event'] = "Ereignis(se)";
		$text['day'] = "Tag";
		$text['month'] = "Monat";
		$text['keyword'] = "Suchwort (z.B. \"ABT\", \"BEF\", \"AFT\")";
		$text['explain'] = "Datum oder Datumsteile eingeben, um passende Ereignisse zu erhalten. Oder Feld leerlassen, um alle Ereignisse zu erhalten.";
		$text['enterdate'] = "Bitte mindestens eines der folgenden eingeben oder auswählen: Tag, Monat, Jahr, Suchwort";
		$text['fullname'] = "Vollständiger Name";
		$text['birthdate'] = "Geburtsdatum";
		$text['altbirthdate'] = "Taufdatum";
		$text['marrdate'] = "Heiratsdatum";
		$text['spouseid'] = "Partner-Kennung";
		$text['spousename'] = "Partner-Name";
		$text['deathdate'] = "Sterbedatum";
		$text['burialdate'] = "Beerdigungsdatum";
		$text['changedate'] = "Datum der letzten Änderung";
		$text['gedcom'] = "Stammbaum";
		$text['baptdate'] = "Datum der Taufe (LDS)";
		$text['baptplace'] = "Ort der Taufe (LDS)";
		$text['endldate'] = "Datum der Begabung (LDS)";
		$text['endlplace'] = "Ort der Begabung (LDS)";
		$text['ssealdate'] = "Datum der Siegelung an den Ehepartner (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Ort der Siegelung an den Ehepartner (LDS)";
		$text['psealdate'] = "Datum der Siegelung an die Eltern (LDS)";   //Sealed to parents
		$text['psealplace'] = "Ort der Siegelung an die Eltern (LDS)";
		$text['marrplace'] = "Heiratsort";
		$text['spousesurname'] = "Nachname des Partners";
		$text['spousemore'] = "Wenn Sie einen Partner-Nachnamen eingeben, müssen Sie das Geschlecht der gesuchten Person auswählen.";
		$text['plusminus5'] = "+/- 5 Jahre von";
		$text['exists'] = "ist vorhanden";
		$text['dnexist'] = "ist nicht vorhanden";
		$text['divdate'] = "Scheidungsdatum";
		$text['divplace'] = "Scheidungsort";
		$text['otherevents'] = "Weitere Ereignisse";
		$text['numresults'] = "Ergebnisse pro Seite";
		$text['mysphoto'] = "Fotos mit unbekannten Personen";
		$text['mysperson'] = "Personen mit fehlenden Angaben";
		$text['joinor'] = "Die Option 'Verknüpfen mit ODER' kann nicht mit dem Nachnamen des Ehepartners verwendet werden";
		$text['tellus'] = "Teilen Sie uns mit, was Sie wissen";
		$text['moreinfo'] = "Weitere Informationen:";
		//added in 8.0.0
		$text['marrdatetr'] = "Jahr der Heirat";
		$text['divdatetr'] = "Jahr der Scheidung";
		$text['mothername'] = "Name der Mutter";
		$text['fathername'] = "Name des Vaters";
		$text['filter'] = "Filter";
		$text['notliving'] = "Nicht lebend";
		$text['nodayevents'] = "Ereignisse für diesen Monat, die nicht einem bestimmten Tag zugeordnet sind:";
		//added in 9.0.0
		$text['csv'] = "Komma-getrennte CSV-Datei";
		//added in 10.0.0
		$text['confdate'] = "Datum der Konfirmation (LDS)";
		$text['confplace'] = "Ort der Konfirmation (LDS)";
		$text['initdate'] = "Datum der Vorverordnungen (LDS)";
		$text['initplace'] = "Ort der Vorverordnungen (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Ehe-Typ";
		$text['searchfor'] = "Suchen nach";
		$text['searchnote'] = "Anmerkung: Diese Seite benutzt Google um die Suche auszuführen. Die Anzahl der Treffer hängt direkt davon ab, in wieweit Google die Seite indizieren konnte.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Protokolldatei für";
		$text['mostrecentactions'] = "letzte Aktionen";
		$text['autorefresh'] = "automatische Aktualisierung einschalten (alle 30 Sekunden)";
		$text['refreshoff'] = "automatische Aktualisierung abschalten";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Friedhöfe und Grabsteine";
		$text['showallhsr'] = "Zeige alle Grabsteine";
		$text['in'] = "in";
		$text['showmap'] = "Karte anzeigen";
		$text['headstonefor'] = "Grabstein von";
		$text['photoof'] = "Foto von";
		$text['photoowner'] = "Besitzer des Originals bzw. der Vorlage";
		$text['nocemetery'] = "Kein Friedhof";
		$text['iptc005'] = "Titel";
		$text['iptc020'] = "Zusätzliche Kategorien";
		$text['iptc040'] = "Spezielle Anweisungen";
		$text['iptc055'] = "Gestaltungsdatum";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Position des Autors";
		$text['iptc090'] = "Stadt";
		$text['iptc095'] = "Staat";
		$text['iptc101'] = "Land";
		$text['iptc103'] = "Auftraggeber";
		$text['iptc105'] = "Schlagzeile";
		$text['iptc110'] = "Quelle";
		$text['iptc115'] = "Quelle des Fotos";
		$text['iptc116'] = "Copyright-Notiz";
		$text['iptc120'] = "Bildtext";
		$text['iptc122'] = "Bildtext Autor";
		$text['mapof'] = "Karte von";
		$text['regphotos'] = "Übersicht mit Kurzbeschreibungen";
		$text['gallery'] = "Übersicht mit Vorschaubildern";
		$text['cemphotos'] = "Friedhofs-Fotos";
		$text['photosize'] = "Größe";
        $text['iptc010'] = "Priorität";
		$text['filesize'] = "Dateigröße";
		$text['seeloc'] = "Siehe Ort";
		$text['showall'] = "Alles anzeigen";
		$text['editmedia'] = "Medium bearbeiten";
		$text['viewitem'] = "Dieses Element ansehen";
		$text['editcem'] = "Friedhof bearbeiten";
		$text['numitems'] = "Elemente";
		$text['allalbums'] = "Alle Alben";
		$text['slidestop'] = "Diaschau beenden";
		$text['slideresume'] = "Diaschau fortsetzen";
		$text['slidesecs'] = "Sekunden für jedes Bild:";
		$text['minussecs'] = "minus 0,5 Sekunden";
		$text['plussecs'] = "plus 0,5 Sekunden";
		$text['nocountry'] = "Unbekanntes Land";
		$text['nostate'] = "Unbekannter/s (Bundes-)Staat/Land";
		$text['nocounty'] = "Unbekannte Provinz";
		$text['nocity'] = "Unbekannter Ort";
		$text['nocemname'] = "Unbekannter Friedhofs-Name";
		$text['editalbum'] = "Album bearbeiten";
		$text['mediamaptext'] = "<strong>Hinweis:</strong> Wenn Sie Ihren Mauszeiger über das Bild bewegen, werden Namen angezeigt. Klicken Sie diese an, um weitere Informationen zu erhalten.";
		//added in 8.0.0
		$text['allburials'] = "Alle Beerdigungen";
		$text['moreinfo'] = "Weitere Informationen:";
		//added in 9.0.0
        $text['iptc025'] = "Schlagwörter";
        $text['iptc092'] = "genauen Aufnahmeort";
		$text['iptc015'] = "Kategorie";
		$text['iptc065'] = "erzeugendes Grafikprogramm";
		$text['iptc070'] = "Programmversion";
		//added in 13.0
		$text['toggletags'] = "Beschriftungen ein-/ausschalten";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Nachnamen anzeigen, die mit ... anfangen";
		$text['showtop'] = "Zeige die ersten";
		$text['showallsurnames'] = "Zeige alle Nachnamen";
		$text['sortedalpha'] = "alphabetisch sortiert";
		$text['byoccurrence'] = "Einträge sortiert nach ihrer Häufigkeit";
		$text['firstchars'] = "Erster Buchstabe der obersten Orts-Ebene";
		$text['mainsurnamepage'] = "Übersichtsseite Nachnamen";
		$text['allsurnames'] = "Alle Nachnamen";
		$text['showmatchingsurnames'] = "Nachnamen anklicken, um weitere Angaben zu erhalten";
		$text['backtotop'] = "Zurück nach oben";
		$text['beginswith'] = "Beginnt mit";
		$text['allbeginningwith'] = "Alle Nachnamen beginnend mit";
		$text['numoccurrences'] = "Anzahl der Datensätze wird in Klammern angezeigt";
		$text['placesstarting'] = "Zeige oberste Orts-Ebenen beginnend mit";
		$text['showmatchingplaces'] = "Klicken Sie auf einen Eintrag, um die untergeordneten Ebenen anzuzeigen. Klicken Sie auf das 'Suchen'-Icon, um die Nachnamen zu diesem Ort zu zeigen.";
		$text['totalnames'] = "Anzahl der Personen";
		$text['showallplaces'] = "Zeige alle obersten Orts-Ebenen";
		$text['totalplaces'] = "Anzahl der Orte";
		$text['mainplacepage'] = "Zurück zur Orts-Hauptseite";
		$text['allplaces'] = "Alle obersten Orts-Ebenen";
		$text['placescont'] = "Zeige alle Orte, die ... enthalten";
		//changed in 8.0.0
		$text['top30'] = "Die xxx häufigsten Nachnamen";
		$text['top30places'] = "Die xxx bedeutendsten obersten Orts-Ebenen";
		//added in 12.0.0
		$text['firstnamelist'] = "Liste der Vornamen";
		$text['firstnamesstarting'] = "Zeige Vornamen beginnend mit";
		$text['showallfirstnames'] = "Zeige alle Vornamen";
		$text['mainfirstnamepage'] = "Hauptseite für Vornamen";
		$text['allfirstnames'] = "Alle Vornamen";
		$text['showmatchingfirstnames'] = "Einen Vornamen anklicken, um zugehörige Einträge zu zeigen";
		$text['allfirstbegwith'] = "Alle Vornamen beginnend mit";
		$text['top30first'] = "Die xxx häufigsten Vornamen";
		$text['allothers'] = "Alle anderen";
		$text['amongall'] = "(von allen Namen)";
		$text['justtop'] = "Nur die häufigsten xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(aus den letzten xx Tagen)";

		$text['photo'] = "Foto";
		$text['history'] = "Geschichte/Dokument";
		$text['husbid'] = "Vater-Kennung";
		$text['husbname'] = "Name des Vaters";
		$text['wifeid'] = "Mutter-Kennung";
		//added in 11.0.0
		$text['wifename'] = "Name der Mutter";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Löschen";
		$text['addperson'] = "Person hinzufügen";
		$text['nobirth'] = "Die folgende Person hat kein gültiges Geburtsdatum und konnte daher nicht hinzugefügt werden";
		$text['event'] = "Ereignis(se)";
		$text['chartwidth'] = "Breite der Graphik";
		$text['timelineinstr'] = "Weitere Kennungen eintragen";
		$text['togglelines'] = "Linien ein-/ausschalten";
		//changed in 9.0.0
		$text['noliving'] = "Die folgende Person ist als 'lebend' deklariert und konnte nicht hinzugefügt werden, da Sie nicht mit den entsprechenden Berechtigungen angemeldet sind";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Zeige alle Stammbäume";
		$text['treename'] = "Stammbaumname";
		$text['owner'] = "Besitzer";
		$text['address'] = "Adresse";
		$text['city'] = "Ort";
		$text['state'] = "(Bundes-)Staat/-Land";
		$text['zip'] = "Postleitzahl";
		$text['country'] = "Land";
		$text['email'] = "E-Mail";
		$text['phone'] = "Telefon";
		$text['username'] = "Benutzerkennung";
		$text['password'] = "Passwort";
		$text['loginfailed'] = "Anmeldung fehlgeschlagen.";

		$text['regnewacct'] = "Benutzerkennung beantragen";
		$text['realname'] = "Ihr Name";
		$text['phone'] = "Telefon";
		$text['email'] = "E-Mail";
		$text['address'] = "Adresse";
		$text['acctcomments'] = "Notiz oder Kommentar";
		$text['submit'] = "Eintragen";
		$text['leaveblank'] = "(Leer lassen, wenn Sie einen neuen Baum beginnen)";
		$text['required'] = "Erforderliche Angaben";
		$text['enterpassword'] = "Bitte Passwort eingeben.";
		$text['enterusername'] = "Bitte eine Benutzerkennung eingeben.";
		$text['failure'] = "Diese Benutzerkennung wird bereits verwendet. Bitte zur vorgehenden Seite zurück gehen und eine andere Benutzerkennung wählen.";
		$text['success'] = "Vielen Dank. Ich habe Ihre Anmeldung erhalten. Ich werde Sie nach Freischaltung Ihrer Benutzerkennung kontaktieren.";
		$text['emailsubject'] = "Registrierungsanfrage: Neuer TNG-Benutzer";
		$text['website'] = "Website (WWW-Adresse)";
		$text['nologin'] = "Sie haben keine Anmeldedaten?";
		$text['loginsent'] = "Anmeldedaten wurden versandt";
		$text['loginnotsent'] = "Anmeldedaten wurden nicht versandt";
		$text['enterrealname'] = "Bitte geben Sie Ihren Namen ein.";
		$text['rempass'] = "Auf diesem Gerät angemeldet bleiben";
		$text['morestats'] = "Weitere Statistiken";
		$text['accmail'] = "<strong>HINWEIS:</strong> Um vom Verwalter dieser Website E-Mails, betreffend Ihre Benutzerkennung, empfangen zu können, stellen Sie bitte sicher, dass E-Mails aus dieser Domain bei Ihnen nicht gesperrt werden.";
		$text['newpassword'] = "Neues Passwort";
		$text['resetpass'] = "Ihr Passwort zurücksetzen";
		$text['nousers'] = "Dieses Formular kann nicht verwendet werden, solange nicht mindestens ein Benutzer-Datensatz existiert. Wenn Sie der Eigentümer dieser Website sind, dann rufen Sie Verwaltung/Benutzer auf und legen Sie Ihre Verwalter-Kennung an.";
		$text['noregs'] = "Bedauerlicherweise werden momentan keine neuen Benutzer-Registrierungen akzeptiert. Bitte <a href=\"suggest.php\">kontaktieren</a> Sie uns, wenn Sie Anmerkungen oder Fragen zu dieser Website haben.";
		$text['emailmsg'] = "Sie haben eine Registrierungsanfrage für einen neuen TNG-Benutzer erhalten. Bitte besuchen Sie Ihren TNG-Verwaltungsbereich und stellen Sie die Zugriffsrechte ein. Wenn Sie der Registrierung zustimmen, unterrichten Sie den Antragsteller, indem Sie auf diese E-Mail antworten.";
		$text['accactive'] = "Die Benutzerkennung wurde freigeschaltet, aber der Benutzer wird solange keine besonderen Berechtigungen haben, bis Sie diese zuweisen.";
		$text['accinactive'] = "Gehen Sie zu Verwaltung/Benutzerverwaltung/Änderungsvorschläge prüfen, um die Angaben zur Benutzerkennung zu überprüfen. Die Benutzerkennung bleibt inaktiv, bis Sie die Einstellungen überprüft und den Benutzer-Datensatz mindestens einmal gespeichert haben.";
		$text['pwdagain'] = "Passwort-Wiederholung";
		$text['enterpassword2'] = "Bitte geben Sie Ihr Passwort nochmals ein.";
		$text['pwdsmatch'] = "Ihre Passwort-Angaben stimmen nicht überein. Bitte geben Sie jeweils dasselbe Passwort ein.";
		$text['acksubject'] = "Vielen Dank für Ihren Benutzer-Antrag"; //for a new user account
		$text['ackmessage'] = "Ihr Antrag für eine Benutzerkennung ist eingegangen. Die Benutzerkennung ist inaktiv, bis sie vom Verwalter der Website überprüft wurde. Sie erhalten eine E-Mail-Nachricht, sobald Ihre Benutzerkennung freigeschaltet ist.";
		//added in 12.0.0
		$text['switch'] = "Wechseln";
		//added in 14.0
		$text['newpassword2'] = "Neues Passwort wiederholen";
		$text['resetsuccess'] = "Erfolg: Das Passwort wurde zurückgesetzt";
		$text['resetfail'] = "Fehler: Passwort wurde nicht zurückgesetzt";
		$text['failreason0'] = " (unbekannter Datenbankfehler)";
		$text['failreason2'] = " (Du hast keine Berechtigung das Passwort zu ändern)";
		$text['failreason3'] = " (Passworte sind unterschiedlich)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Alle Zweige durchsuchen";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Anzahl";
		$text['totindividuals'] = "Personen";
		$text['totmales'] = "Männliche Personen";
		$text['totfemales'] = "Weibliche Personen";
		$text['totunknown'] = "Personen mit unbekanntem Geschlecht";
		$text['totliving'] = "Lebende Personen";
		$text['totfamilies'] = "Familien";
		$text['totuniquesn'] = "Eindeutige Nachnamen";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Quellen";
		$text['avglifespan'] = "Durchschnittliche Lebensspanne";
		$text['earliestbirth'] = "Früheste Geburt";
		$text['longestlived'] = "Älteste Personen";
		$text['days'] = "Tage";
		$text['age'] = "Alter";
		$text['agedisclaimer'] = "Altersbasierte Berechnungen sind bezogen auf Personen mit eingetragenem Geburtstag <EM>und</EM> Sterbedatum. Durch unvollständige Datumsfelder (z.B. Geburtstag nur eingetragen als \"1945\" oder \"BEF 1860\") können diese Berechnungen nicht immer 100 % korrekt sein.";
		$text['treedetail'] = "Weitere Angaben zu diesem Stammbaum";
		$text['total'] = "Anzahl";
		//added in 12.0
		$text['totdeceased'] = "Gesamtzahl der Verstorbenen";
		//added in 14.0
		$text['totalsourcecitations'] = "Gesamtzahl Quellen-Zitate";
		break;

	case "notes":
		$text['browseallnotes'] = "Alle Notizen durchblättern";
		break;

	case "help":
		$text['menuhelp'] = "Bedeutung der Menü-Icons";
		break;

	case "install":
		$text['perms'] = "Alle Berechtigungen wurden eingerichtet.";
		$text['noperms'] = "Die Berechtigungen für die folgenden Dateien konnten nicht eingerichtet werden:";
		$text['manual'] = "Bitte richten Sie sie von Hand ein.";
		$text['folder'] = "Verzeichnis";
		$text['created'] = "wurde angelegt";
		$text['nocreate'] = "konnte nicht angelegt werden. Bitte von Hand anlegen.";
		$text['infosaved'] = "Information wurde gespeichert, Datenbank-Verbindung wurde überprüft!";
		$text['tablescr'] = "Die Tabellen wurden angelegt!";
		$text['notables'] = "Die folgenden Tabellen konnten nicht angelegt werden:";
		$text['nocomm'] = "TNG kann nicht auf Ihre Datenbank zugreifen. Es wurden keine Tabellen angelegt.";
		$text['newdb'] = "Information wurde gespeichert, Datenbank-Verbindung wurde überprüft, neue Datenbank wurde angelegt:";
		$text['noattach'] = "Information wurde gespeichert. Datenbank-Verbindung wurde hergestellt und Datenbank wurde angelegt, aber TNG kann nicht darauf zugreifen.";
		$text['nodb'] = "Information wurde gespeichert. Verbindung wurde hergestellt, aber die Datenbank ist nicht vorhanden und konnte auch nicht angelegt werden. Bitte überprüfen Sie, ob der angegebene Datenbankname korrekt ist, oder verwenden Sie Ihr Verwaltungsprogramm, um sie anzulegen.";
		$text['noconn'] = "Information wurde gespeichert, aber die Verbindung zur Datenbank ist fehlgeschlagen. Einer oder mehrere der folgenden Punkte sind nicht korrekt:";
		$text['exists'] = "ist vorhanden";
		$text['noop'] = "Es wurde keine Datenbank-Operation ausgeführt.";
		//added in 8.0.0
		$text['nouser'] = "Benutzerkennung wurde nicht angelegt. Die angegebene Benutzerkennung existiert möglicherweise bereits.";
		$text['notree'] = "Baum wurde nicht angelegt. Die Baum-Kennung existiert möglicherweise bereits.";
		$text['infosaved2'] = "Information gespeichert";
		$text['renamedto'] = "Umbenannt zu";
		$text['norename'] = "Konnte nicht umbenannt werden";
		//changed in 13.0.0
		$text['loginfirst'] = "Es gibt bereits Nutzereinträge. Um fortzufahren, müssen Sie sich erst einloggen oder alle Einträge aus der Nutzer-Tabelle entfernen.";
		break;

	case "imgviewer":
		$text['magmode'] = "Vergrößerungsmodus";
		$text['panmode'] = "Zeiger";
		$text['pan'] = "Klicken und Ziehen Sie, um sich innerhalb des Bildes zu bewegen";
		$text['fitwidth'] = "Breite anpassen";
		$text['fitheight'] = "Höhe anpassen";
		$text['newwin'] = "Neues Fenster";
		$text['opennw'] = "Bild in einem neuen Fenster öffnen";
		$text['magnifyreg'] = "Klicken Sie, um einen Bereich des Bildes zu vergrößern";
		$text['imgctrls'] = "Bildsteuerung aktivieren";
		$text['vwrctrls'] = "Bildbetrachter Steuerung aktivieren";
		$text['vwrclose'] = "Bildbetrachter schließen";
		break;

	case "dna":
		$text['test_date'] = "Test-Datum";
		$text['links'] = "Relevante Links";
		$text['testid'] = "Test-Kennung";
		//added in 12.0.0
		$text['mode_values'] = "Einzelne Werte";
		$text['compareselected'] = "Ausgewählte vergleichen";
		$text['dnatestscompare'] = "yDNA-Tests vergleichen";
		$text['keep_name_private'] = "Namen nicht veröffentlichen";
		$text['browsealltests'] = "Alle Tests durchsuchen";
		$text['all_dna_tests'] = "Alle DNA-Tests";
		$text['fastmutating'] = "Bereiche mit häufigen Mutationen";
		$text['alltypes'] = "Alle Test-Typen";
		$text['allgroups'] = "Alle Gruppen";
		$text['Ydna_LITbox_info'] = "Mit dieser Person ist ein DNA-Test verbunden; das bedeutet nicht unbedingt, dass diese Person selbst getestet worden ist.<br />Die Haplogruppe wird in rot angezeigt, wenn sie vermutet ist; sie wird in grün angezeigt, wenn sie bestätigt ist.";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Vergleiche ausgewählte mtDNA-Tests";
		$text['dnatestscompare_atdna'] = "Vergleiche ausgewählte atDNA-Tests";
		$text['chromosome'] = "Chr.";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNP";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref.";
		$text['extra_mutations'] = "Zusätzliche Mutationen";
		$text['mrca'] = "Nächster gem. Vorfahre";
		$text['ydna_test'] = "Tests der Y-DNA";
		$text['mtdna_test'] = "Tests der mtDNA";
		$text['atdna_test'] = "Tests der atDNA";
		$text['segment_start'] = "Beginn";
		$text['segment_end'] = "Ende";
		$text['suggested_relationship'] = "Vermutet";
		$text['actual_relationship'] = "Tatsächlich";
		$text['12markers'] = "Marker 1-12";
		$text['25markers'] = "Marker 13-25";
		$text['37markers'] = "Marker 26-37";
		$text['67markers'] = "Marker 38-67";
		$text['111markers'] = "Marker 68-111";
		//added in 13.1
		$text['comparemore'] = "Für einen Vergleich müssen mindestens zwei Tests ausgewählt werden.";
		break;
}

//common
$text['matches'] = "Treffer";
$text['description'] = "Beschreibung";
$text['notes'] = "Notizen";
$text['status'] = "Status";
$text['newsearch'] = "Neue Suche";
$text['pedigree'] = "Stammbaum";
$text['seephoto'] = "Siehe Foto";
$text['andlocation'] = "&amp; Ort";
$text['accessedby'] = "besucht durch";
$text['children'] = "Kinder";  //from getperson
$text['tree'] = "Stammbaum";
$text['alltrees'] = "Alle Stammbäume";
$text['nosurname'] = "Kein Nachname";
$text['thumb'] = "Vorschaubild";  //as in Thumbnail
$text['people'] = "Personen";
$text['title'] = "Titel";  //from getperson
$text['suffix'] = "Suffix";  //from getperson
$text['nickname'] = "Spitzname";  //from getperson
$text['lastmodified'] = "Zuletzt bearbeitet am";  //from getperson
$text['married'] = "Verheiratet";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Name"; //from showmap
$text['lastfirst'] = "Nachname, Taufnamen";  //from search
$text['bornchr'] = "Geboren/Getauft";  //from search
$text['individuals'] = "Personen";  //from whats new
$text['families'] = "Familien";
$text['personid'] = "Personen-Kennung";
$text['sources'] = "Quellen";  //from getperson (next several)
$text['unknown'] = "unbekannt";
$text['father'] = "Vater";
$text['mother'] = "Mutter";
$text['christened'] = "Getauft";
$text['died'] = "Gestorben";
$text['buried'] = "Begraben";
$text['spouse'] = "Ehepartner";  //from search
$text['parents'] = "Eltern";  //from pedigree
$text['text'] = "Text";  //from sources
$text['language'] = "Sprache";  //from languages
$text['descendchart'] = "Nachkommen";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Person";
$text['edit'] = "Bearbeiten";
$text['date'] = "Datum";
$text['login'] = "Anmelden";
$text['logout'] = "Abmelden";
$text['groupsheet'] = "Familienblatt";
$text['text_and'] = "und";
$text['generation'] = "Generation";
$text['filename'] = "Dateiname";
$text['id'] = "Kennung";
$text['search'] = "Suche";
$text['user'] = "Benutzer";
$text['firstname'] = "Vorname";
$text['lastname'] = "Nachname";
$text['searchresults'] = "Suchergebnisse";
$text['diedburied'] = "Verstorben/begraben";
$text['homepage'] = "Startseite";
$text['find'] = "Suchen...";
$text['relationship'] = "Verwandtschaft";		//in German, Verwandtschaft
$text['relationship2'] = "Beziehung"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Zeitstrahl";
$text['yesabbr'] = "J";               //abbreviation for 'yes'
$text['divorced'] = "Geschieden";
$text['indlinked'] = "Verknüpft mit";
$text['branch'] = "Zweig";
$text['moreind'] = "Weitere Personen...";
$text['morefam'] = "Weitere Familien...";
$text['surnamelist'] = "Liste der Nachnamen";
$text['generations'] = "Generationen";
$text['refresh'] = "Aktualisieren";
$text['whatsnew'] = "Aktuelles";
$text['reports'] = "Berichte";
$text['placelist'] = "Ortsliste";
$text['baptizedlds'] = "Getauft (LDS)";
$text['endowedlds'] = "Begabung (LDS)";
$text['sealedplds'] = "Siegelung an die Eltern (LDS)";
$text['sealedslds'] = "Siegelung an den Ehepartner (LDS)";
$text['ancestors'] = "Vorfahren";
$text['descendants'] = "Nachkommen";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Datum des letzten GEDCOM-Imports";
$text['type'] = "Typ";
$text['savechanges'] = "Speichern";
$text['familyid'] = "Familien-Kennung";
$text['headstone'] = "Grabsteine";
$text['historiesdocs'] = "Geschichten";
$text['anonymous'] = "anonym";
$text['places'] = "Orte";
$text['anniversaries'] = "Daten und Jahrestage";
$text['administration'] = "Verwaltung";
$text['help'] = "Hilfe";
//$text['documents'] = "Documents";
$text['year'] = "Jahr";
$text['all'] = "Alles";
$text['address'] = "Adresse";
$text['suggest'] = "Änderungsvorschlag";
$text['editevent'] = "Änderungsvorschlag für dieses Ereignis";
$text['morelinks'] = "Weitere Verknüpfungen";
$text['faminfo'] = "Angaben zur Familie";
$text['persinfo'] = "Angaben zur Person";
$text['srcinfo'] = "Angaben zur Quelle";
$text['fact'] = "Merkmal";
$text['goto'] = "Eine Seite auswählen";
$text['tngprint'] = "Drucken";
$text['databasestatistics'] = "Statistiken"; //needed to be shorter to fit on menu
$text['child'] = "Kind";  //from familygroup
$text['repoinfo'] = "Angaben zum Aufbewahrungsort";
$text['tng_reset'] = "Zurücksetzen";
$text['noresults'] = "Keine Suchergebnisse";
$text['allmedia'] = "Alle Medien";
$text['repositories'] = "Aufbewahrungsorte";
$text['albums'] = "Alben";
$text['cemeteries'] = "Friedhöfe";
$text['surnames'] = "Nachnamen";
$text['dates'] = "Jahrestage";
$text['link'] = "Link";
$text['media'] = "Medien";
$text['gender'] = "Geschlecht";
$text['latitude'] = "Geographische Breite";
$text['longitude'] = "Geographische Länge";
$text['bookmarks'] = "Lesezeichen";
$text['bookmark'] = "Lesezeichen hinzufügen";
$text['mngbookmarks'] = "Zu den Lesezeichen gehen";
$text['bookmarked'] = "Lesezeichen hinzugefügt";
$text['remove'] = "Entfernen";
$text['find_menu'] = "Suchen";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Friedhof";
$text['gmapevent'] = "Ereignis-Karte";
$text['gevents'] = "Ereignis";
$text['googleearthlink'] = "Link zu Google Earth";
$text['googlemaplink'] = "Link zu Google Maps";
$text['gmaplegend'] = "Pin-Bedeutungen";
$text['unmarked'] = "Nicht markiert";
$text['located'] = "Lokalisiert";
$text['albclicksee'] = "Anklicken, um alle Elemente in diesem Album anzuzeigen";
$text['notyetlocated'] = "Noch nicht lokalisiert";
$text['cremated'] = "eingeäschert";
$text['missing'] = "fehlend";
$text['pdfgen'] = "PDF-Datei erzeugen";
$text['blank'] = "ohne Daten-Inhalte";
$text['fonts'] = "Schriftname";
$text['header'] = "Überschrift";
$text['data'] = "Daten";
$text['pgsetup'] = "Seiten-Einstellungen";
$text['pgsize'] = "Seitengröße";
$text['orient'] = "Ausrichtung"; //for a page
$text['portrait'] = "Hochformat";
$text['landscape'] = "Querformat";
$text['tmargin'] = "Oberer Rand";
$text['bmargin'] = "Unterer Rand";
$text['lmargin'] = "Linker Rand";
$text['rmargin'] = "Rechter Rand";
$text['createch'] = "PDF-Datei erzeugen";
$text['prefix'] = "Präfix";
$text['mostwanted'] = "Gesuchte Angaben";
$text['latupdates'] = "Letzte Aktualisierungen";
$text['featphoto'] = "Aufmacher-Foto";
$text['news'] = "Aktuelles";
$text['ourhist'] = "Die Geschichte unserer Familie";
$text['ourhistanc'] = "Die Geschichte und Genealogie unserer Familie";
$text['ourpages'] = "Die Seiten zu unserer Familien-Genealogie";
$text['pwrdby'] = "Diese Website läuft mit";
$text['writby'] = "programmiert von";
$text['searchtngnet'] = "Suche im TNG-Network (GENDEX)";
$text['viewphotos'] = "Alle Fotos ansehen";
$text['anon'] = "Sie sind momentan nicht angemeldet (anonymer Benutzer)";
$text['whichbranch'] = "Zu welchem Zweig gehören Sie?";
$text['featarts'] = "Aufmacher-Artikel";
$text['maintby'] = "Betreut von";
$text['createdon'] = "Erzeugt am";
$text['reliability'] = "Verlässlichkeit";
$text['labels'] = "Beschriftungen";
$text['inclsrcs'] = "einschließlich Quellen-Angaben";
$text['cont'] = "(Forts.)"; //abbreviation for continued
$text['mnuheader'] = "Startseite";
$text['mnusearchfornames'] = "Suche nach Namen";
$text['mnulastname'] = "Nachname";
$text['mnufirstname'] = "Vorname";
$text['mnusearch'] = "Suchen";
$text['mnureset'] = "Zurücksetzen";
$text['mnulogon'] = "Anmelden";
$text['mnulogout'] = "Abmelden";
$text['mnufeatures'] = "Weitere Funktionen";
$text['mnuregister'] = "Benutzerkennung beantragen";
$text['mnuadvancedsearch'] = "Erweiterte Suche";
$text['mnulastnames'] = "Nachnamen";
$text['mnustatistics'] = "Statistik";
$text['mnuphotos'] = "Fotos";
$text['mnuhistories'] = "Geschichten";
$text['mnumyancestors'] = "Fotos &amp; Geschichten für Vorfahren von [Person]";
$text['mnucemeteries'] = "Friedhöfe";
$text['mnutombstones'] = "Grabsteine";
$text['mnureports'] = "Berichte";
$text['mnusources'] = "Quellen";
$text['mnuwhatsnew'] = "Aktuelles";
$text['mnushowlog'] = "Protokoll der Zugriffe";
$text['mnulanguage'] = "Sprache ändern";
$text['mnuadmin'] = "Verwaltung";
$text['welcome'] = "Willkommen";
$text['contactus'] = "Kontakt";
//changed in 8.0.0
$text['born'] = "Geboren";
$text['searchnames'] = "Suche nach Namen";
//added in 8.0.0
$text['editperson'] = "Person bearbeiten";
$text['loadmap'] = "Karte laden";
$text['birth'] = "Geburt";
$text['wasborn'] = "wurde geboren";
$text['startnum'] = "Erste Nummer";
$text['searching'] = "Suche läuft";
//moved here in 8.0.0
$text['location'] = "Ort";
$text['association'] = "Verbindung";
$text['collapse'] = "Darstellung reduzieren";
$text['expand'] = "Darstellung erweitern";
$text['plot'] = "Grab-Standort";
$text['searchfams'] = "Familien suchen";
//added in 8.0.2
$text['wasmarried'] = "Heiratete";
$text['anddied'] = "Gestorben";
//added in 9.0.0
$text['share'] = "Teilen";
$text['hide'] = "Ausblenden";
$text['disabled'] = "Ihr Benutzerkonto wurde deaktiviert. Bitte setzen Sie sich mit dem Administrator in Verbindung.";
$text['contactus_long'] = "Wenn Sie Fragen oder Anmerkungen zu dieser Website haben, so <span class=\"emphasis\"><a href=\"suggest.php\">kontaktieren</a></span> Sie uns bitte. Wir freuen uns, von Ihnen zu hören.";
$text['features'] = "Eigenschaften";
$text['resources'] = "Ressourcen";
$text['latestnews'] = "Aktuelle Neuigkeiten";
$text['trees'] = "Stammbäume";
$text['wasburied'] = "wurde beigesetzt";
//moved here in 9.0.0
$text['emailagain'] = "E-Mail nochmal";
$text['enteremail2'] = "Bitte geben Sie ihre E-Mail-Adresse nochmals ein.";
$text['emailsmatch'] = "Ihre E-Mail-Adressen stimmen nicht überein. Bitte geben Sie dieselbe E-Mail-Adresse in jedes Feld ein.";
$text['getdirections'] = "Hier klicken, um eine Wegbeschreibung zu bekommen";
$text['calendar'] = "Kalender";
//changed in 9.0.0
$text['directionsto'] = " nach ";
$text['slidestart'] = "Diaschau";
$text['livingnote'] = "Mit dieser Bemerkung ist mindestens eine lebende Person verknüpft - Details werden aus Datenschutzgründen nicht angezeigt.";
$text['livingphoto'] = "Mindestens eine geschützte Person ist mit diesem Medium verknüpft - Details werden aus Datenschutzgründen nicht angezeigt.";
$text['waschristened'] = "Getauft";
//added in 10.0.0
$text['branches'] = "Zweige";
$text['detail'] = "Details";
$text['moredetail'] = "Mehr Details";
$text['lessdetail'] = "Weniger Details";
$text['conflds'] = "Konfirmiert (LDS)";
$text['initlds'] = "Vorverordnungen (LDS)";
$text['wascremated'] = "wurde eingeäschert";
//moved here in 11.0.0
$text['text_for'] = "für";
//added in 11.0.0
$text['searchsite'] = "Diese Seite durchsuchen";
$text['searchsitemenu'] = "Seite durchsuchen";
$text['kmlfile'] = "Laden Sie eine Datei vom Typ .kml herunter, um den Ort in Google Earth zu sehen";
$text['download'] = "Klicken Sie um den Download zu starten";
$text['more'] = "Mehr";
$text['heatmap'] = "Verbreitungskarte";
$text['refreshmap'] = "Karte aktualisieren";
$text['remnums'] = "Nummern und Pins entfernen";
$text['photoshistories'] = "Fotos &amp; Geschichten";
$text['familychart'] = "Familientafel";
//added in 12.0.0
$text['firstnames'] = "Vornamen";
//moved here in 12.0.0
$text['dna_test'] = "DNA-Test";
$text['test_type'] = "Test-Typ";
$text['test_info'] = "Testinformation";
$text['takenby'] = "Durchgeführt von";
$text['haplogroup'] = "Haplogruppe";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Links";
$text['nofirstname'] = "[kein Vorname]";
//added in 12.0.1
$text['cookieuse'] = "Diese Website verwendet Cookies. Wenn Sie fortfahren, ohne Ihre Browser-Einstellungen zu ändern, erklären Sie sich mit der Nutzung von Cookies einverstanden.";
$text['dataprotect'] = "Datenschutzerklärung";
$text['viewpolicy'] = "Datenschutzerklärung anzeigen";
$text['understand'] = "Verstanden";
$text['consent'] = "Ich stimme zu, dass meine hier erfassten persönlichen Daten gespeichert werden. Ich verstehe, dass ich jederzeit den Betreiber dieser Website bitten kann, diese Daten zu löschen.";
$text['consentreq'] = "Bitte geben Sie uns die Einwilligung für die Speicherung Ihrer personenbezogenen Daten.";

//added in 12.1.0
$text['testsarelinked'] = "DNA-Tests sind verbunden mit";
$text['testislinked'] = "DNA-Test ist verbunden mit";

//added in 12.2
$text['quicklinks'] = "Quick Links";
$text['yourname'] = "Ihre Name";
$text['youremail'] = "Ihre E-Mail-Adresse";
$text['liketoadd'] = "Alle Informationen, die Sie hinzufügen möchten";
$text['webmastermsg'] = "Webmaster-Nachricht";
$text['gallery'] = "Galerie zeigen";
$text['wasborn_male'] = "wurde geboren";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "wurde geboren"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "getauft";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "getauft";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "gestorben";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "gestorben";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "wurde beigesetzt"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "wurde beigesetzt"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "wurde eingeäschert";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "wurde eingeäschert";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "heiratete";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "heiratete";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "geschieden";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "geschieden";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " in ";			// used as a preposition to the location
$text['onthisdate'] = " am ";		// when used with full date
$text['inthisyear'] = " in ";		// when used with year only or month / year dates
$text['and'] = "und ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Informationen zu DNA-Tests";
//added in 13.0
$text['visitor'] = "Besucher";

$text['popupnote2'] = " = neuen Stammbaum zeigen";

//moved here in 14.0
$text['zoomin'] = "Vergrößern";
$text['zoomout'] = "Verkleinern";
$text['scrollnote'] = "Ziehen oder scrollen, um mehr zu sehen";
$text['general'] = "Allgemein";

//changed in 14.0
$text['otherevents'] = "Anderer Ereignisse und Attribute";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Verbindungen";
$text['continue'] = "Fortsetzen";
$text['title2'] = "Titel"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>