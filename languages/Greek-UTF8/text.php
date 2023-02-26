<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Φυλλομέτρημα Πηγών";
		$text['shorttitle'] = "Περιληπτικός Τίτλος";
		$text['callnum'] = "Call Number";
		$text['author'] = "Συγγραφέας";
		$text['publisher'] = "Εκδότης";
		$text['other'] = "Άλλες Πληροφορίες";
		$text['sourceid'] = "Κωδικός Πηγής";
		$text['moresrc'] = "Άλλες πηγές";
		$text['repoid'] = "ID Αποθετηρίου";
		$text['browseallrepos'] = "Εποσκόπηση σε όλα τα Αποθετήρια";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Νέα Γλώσσα";
		$text['changelanguage'] = "Αλλαγή Γλώσσας";
		$text['languagesaved'] = "Γλώσσα Αποθηκεύτηκε";
		$text['sitemaint'] = "Site maintenance in progress";
		$text['standby'] = "The site is temporarily unavailable while we update our database. Please try again in a few minutes. If the site remains down for an extended period of time, please <a href=\"suggest.php\">contact the site owner</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "Αρχείο GEDCOM που ξεκινά από";
		$text['producegedfrom'] = "Δημιουργία αρχείου GEDCOM από";
		$text['numgens'] = "Αριθμός γενεών";
		$text['includelds'] = "Να συμπεριληφθούν πληροφορίες LDS";
		$text['buildged'] = "Κατασκευή GEDCOM";
		$text['gedstartfrom'] = "Αρχείο GEDCOM που ξεκινά από";
		$text['nomaxgen'] = "Πρέπει να δηλώσετε τον μέγιστο αριθμό γενεών. Παρακαλώ χρησιμοποιήστε το κουμπί Πίσω για να επιστρέψετε στην προηγούμενη σελίδα και να διορθώσετε το λάθος";
		$text['gedcreatedfrom'] = "Το GEDCOM δημιουργήθηκε από";
		$text['gedcreatedfor'] = "δημιουργήθηκε για";
		$text['creategedfor'] = "Δημιουργία GEDCOM";
		$text['email'] = "Διεύθυνση Ηλεκτρονικού Ταχυδρομείου";
		$text['suggestchange'] = "Προτείνετε κάποια αλλαγή";
		$text['yourname'] = "Το όνομά σας";
		$text['comments'] = "Σημειώσεις ή Σχόλια";
		$text['comments2'] = "Σχόλια";
		$text['submitsugg'] = "Υποβολή Πρότασης";
		$text['proposed'] = "Προτεινόμενη Αλλαγή";
		$text['mailsent'] = "Ευχαριστούμε. Το μήνυμά σας έχει σταλεί.";
		$text['mailnotsent'] = "Μας συγχωρείτε, το μήνυμά σας δεν μπορέσαμε να το παραδώσουμε. Παρακαλώ επικοινωνήστε με τον διαχειριστή απευθείας στο yyy.";
		$text['mailme'] = "Στείλε αντίγραφο στη διεύθυνση αυτή";
		$text['entername'] = "Please enter your name";
		$text['entercomments'] = "Please enter your comments";
		$text['sendmsg'] = "Send Message";
		//added in 9.0.0
		$text['subject'] = "Subject";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Φωτογραφίες και Ιστορικά για";
		$text['indinfofor'] = "Ατομικές πληροφορίες για";
		$text['pp'] = "pp."; //page abbreviation
		$text['age'] = "Ηλικία";
		$text['agency'] = "Agency";
		$text['cause'] = "Αιτία";
		$text['suggested'] = "Προτίνεται";
		$text['closewindow'] = "Κλείσε το παράθυρο αυτό";
		$text['thanks'] = "Thank you";
		$text['received'] = "Your suggestion was forwarded to the site administrator for review.";
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
		$text['relcalc'] = "Εργαλείο Υπολογισμού Συγγένειας";
		$text['findrel'] = "Εύρεση Συγγένειας";
		$text['person1'] = "Άτομο 1:";
		$text['person2'] = "Άτομο 2:";
		$text['calculate'] = "Υπολογισμός";
		$text['select2inds'] = "Παρακαλώ επιλέξτε δύο άτομα.";
		$text['findpersonid'] = "Εύρεση Κωδικού Ατόμου";
		$text['enternamepart'] = "πληκτρολογήστε τμήμα του ονόματος ή/και του επωνύμου";
		$text['pleasenamepart'] = "Παρακαλώ πληκτρολογήστε τμήμα του ονόματος ή του επιθέτου.";
		$text['clicktoselect'] = "πατήστε για να επιλέξτε";
		$text['nobirthinfo'] = "Δεν υπάρχουν πληροφορίες γέννησης";
		$text['relateto'] = "Συγγένεια ως προς";
		$text['sameperson'] = "Τα δύο άτομα είναι το ίδιο πρόσωπο.";
		$text['notrelated'] = "Τα δύο άτομα δεν έχουν συγγένεια μέσα σε xxx γενιές."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Πληκτρολογήστε κωδικούς για δύο άτομα, ή κρατήστε τα άτομα που εμφανίζονται, και μετά επιλέξτε το κουμπί 'Υπολογισμός' για την παραγωγή του διαγράμματος συγγένειας (μέχρι xxx γενεές).";
		$text['sometimes'] = "(Sometimes checking over a different number of generations yields a different result.)";
		$text['findanother'] = "Εύρεση άλλης συσχέτισης";
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
		$text['changeto'] = "Αλλαγή σε:";
		$text['notvalid'] = "is not a valid Person ID number or does not exist in this database. Please try again.";
		$text['halfbrother'] = "the half brother of";
		$text['halfsister'] = "the half sister of";
		$text['halfsibling'] = "the half sibling of";
		//changed in 8.0.0
		$text['gencheck'] = "Μέγιστος αριθμός γενεών<br />προς έλεγχο";
		$text['mcousin'] = "the xxx cousin of";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "the xxx cousin of";  //female cousin
		$text['cousin'] = "the xxx cousin of";
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
		$text['dospouses2'] = "Show Spouses";
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
		$text['pathscalc'] = "Search for connections";
		$text['findrel2'] = "Εύρεση Συγγένειας";
		$text['makeme2nd'] = "Use my ID";
		$text['usebookmarks'] = "Use bookmarks";
		$text['select2inds'] = "Παρακαλώ επιλέξτε δύο άτομα.";
		$text['indinfofor'] = "Ατομικές πληροφορίες για";
		$text['nobookmarks'] = "There is no bookmark to use";
		$text['bkmtitle'] = "Persons found in bookmarks";
		$text['bkminfo'] = "Select a person:";
		$text['sortpathsby'] = "Sort paths by number of";
		$text['sortbyshort'] = "Sort by";
		$text['bylengthshort'] = "Length";
		$text['badID1'] = ": bad person1 ID - please go back and correct";
		$text['badID2'] = ": bad person2 ID - please go back and correct";
		$text['notintree'] = ": the person with this ID is not in the current tree database.";
		$text['sameperson'] = "Τα δύο άτομα είναι το ίδιο πρόσωπο.";;
		$text['nopaths'] = "These persons are not connected.";
		$text['nopaths1'] = "No more connections shorter than xxx";
		$text['nopaths2'] = "in xxx search steps";
		$text['longestpath'] = "(longest path checked so far was xxx steps long)";
		$text['relevantpaths'] = "The number of different relevant paths found: xxx";
		$text['skipMarr'] = "(in addition, the number of paths found but not displayed due to too many marriages was: xxx)";
		$text['mjaor'] = "or";
		$text['connectionsto'] = "Connections to ";
		$text['findanotherpers'] = "Find another person...";
		$text['sometimes'] = "(Sometimes checking over a different number of generations yields a different result.)";
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
		$text['dospouses2'] = "Show Spouses";
		$text['maxmopt'] = "Max marriages per connection";
		$text['maxm'] = "Max marriages";
		$text['arerelated'] = "These persons are relatives - their relationship is shown in the Path 1";
		$text['simplerel'] = "Simple relationship search";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Σελίδα Οικογενειακής Μερίδας για ";
		$text['ldsords'] = "LDS Διάταγμα";
		$text['baptizedlds'] = "Βάπτιση (LDS)";
		$text['endowedlds'] = "Προίκιση (LDS)";
		$text['sealedplds'] = "Σφράγιση P (LDS)";
		$text['sealedslds'] = "Σφράγιση S (LDS)";
		$text['otherspouse'] = "Άλλος/η Σύζυγος";
		$text['husband'] = "Σύζυγος-Άνδρας";
		$text['wife'] = "Σύζυγος-Γυναίκα";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "ΓΕΝ";
		$text['capaltbirthabbr'] = "A";
		$text['capdeathabbr'] = "ΘΑΝ";
		$text['capburialabbr'] = "ΤΑΦ";
		$text['capplaceabbr'] = "P";
		$text['capmarrabbr'] = "ΓΑΜ";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "Επανασχεδίαση με";
		$text['unknownlit'] = "Άγνωστο";
		$text['popupnote1'] = " = Επιπλέον πληροφορίες";
		$text['pedcompact'] = "Συμπίεση";
		$text['pedstandard'] = "Πρότυπο";
		$text['pedtextonly'] = "Μόνο Κείμενο";
		$text['descendfor'] = "Απόγονοι για";
		$text['maxof'] = "Μέγιστος αριθμός";
		$text['gensatonce'] = "γενεών που εμφανίζονται ταυτοχρόνως.";
		$text['sonof'] = "υιός του/της/των";
		$text['daughterof'] = "θυγατέρα του/της/των";
		$text['childof'] = "παιδί του/της/των";
		$text['stdformat'] = "Πρότυπη Δομή";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Προσθήκη Νέας Οικογένειας";
		$text['editfam'] = "Διόρθωση Οικογένειας";
		$text['side'] = "Μεριά";
		$text['familyof'] = "Οικογένεια του/της/των";
		$text['paternal'] = "Πατρικά";
		$text['maternal'] = "Μητρικά";
		$text['gen1'] = "Ίδιος";
		$text['gen2'] = "Γονείς";
		$text['gen3'] = "Παπούδες-Γιαγιάδες";
		$text['gen4'] = "Προ Παπούδες-Γιαγιάδες";
		$text['gen5'] = "Προ Προ Παπούδες-Γιαγιάδες";
		$text['gen6'] = "Τρίτου βαθμού Προ Παπούδες-Γιαγιάδες";
		$text['gen7'] = "Τέταρτου βαθμού Προ Παπούδες-Γιαγιάδες";
		$text['gen8'] = "Πέμπτου βαθμού Προ Παπούδες-Γιαγιάδες";
		$text['gen9'] = "Έκτου βαθμού Προ Παπούδες-Γιαγιάδες";
		$text['gen10'] = "Έβδομου βαθμού Προ Παπούδες-Γιαγιάδες";
		$text['gen11'] = "Όγδοου βαθμού Προ Παπούδες-Γιαγιάδες";
		$text['gen12'] = "Ένατου βαθμού Προ Παπούδες-Γιαγιάδες";
		$text['graphdesc'] = "Γραφική απεικόνιση απογόνων έως αυτό το σημείο";
		$text['pedbox'] = "Πλαίσιο";
		$text['regformat'] = "Δομή Ληξιαρχείου";
		$text['extrasexpl'] = "If photos or histories exist for the following individuals, corresponding icons will be displayed next to the names.";
		$text['popupnote3'] = " = New chart";
		$text['mediaavail'] = "Media Available";
		$text['pedigreefor'] = "Γενεαλογία για";
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
		$text['noreports'] = "Δεν υπάρχουν αναφορές.";
		$text['reportname'] = "Όνομα Αναφοράς";
		$text['allreports'] = "Όλες οι Αναφορές";
		$text['report'] = "Αναφορά";
		$text['error'] = "Σφάλμα";
		$text['reportsyntax'] = "Η σύνταξη της αναζήτησης που σχετίζεται με την αναφορά αυτή";
		$text['wasincorrect'] = "ήταν λανθασμένη, και σαν αποτέλεσμα η αναφορά δεν μπορούσε να ολοκληρωθεί. Παρακαλώ επικοινωνήστε με τον διαχειριστή του συστήματος στο";
		$text['errormessage'] = "Μήνυμα Σφάλματος";
		$text['equals'] = "ισούται";
		$text['endswith'] = "τελειώνει με";
		$text['soundexof'] = "soundex of";
		$text['metaphoneof'] = "metaphone of";
		$text['plusminus10'] = "+/- 10 χρόνια από";
		$text['lessthan'] = "μικρότερο από";
		$text['greaterthan'] = "μεγαλύτερο από";
		$text['lessthanequal'] = "μικρότερο ή ίσο με";
		$text['greaterthanequal'] = "μεγαλύτερο ή ίσο με";
		$text['equalto'] = "ίσο με";
		$text['tryagain'] = "Παρακαλώ δοκιμάστε πάλι";
		$text['joinwith'] = "Σύνδεση με";
		$text['cap_and'] = "ΚΑΙ";
		$text['cap_or'] = "Η";
		$text['showspouse'] = "Εμφάνιση συζύγου (θα εμφανίσει διπλά στοιχεία εάν το άτομο έχει πολλαπλούς συζύγους)";
		$text['submitquery'] = "Υποβολή Αιτήματος Αναζήτησης";
		$text['birthplace'] = "Τόπος Γέννησης";
		$text['deathplace'] = "Τόπος Θανάτου";
		$text['birthdatetr'] = "Έτος Γέννησης";
		$text['deathdatetr'] = "Έτος Θανάτου";
		$text['plusminus2'] = "+/- 2 χρόνια από";
		$text['resetall'] = "Επαναφορά Όλων των Μεταβλητών";
		$text['showdeath'] = "Εμφάνιση πληροφοριών θανάτου/ταφής";
		$text['altbirthplace'] = "Τόπος Βάπτισης";
		$text['altbirthdatetr'] = "Έτος Βάπτισης";
		$text['burialplace'] = "Τόπος Ταφής";
		$text['burialdatetr'] = "Έτος Ταφής";
		$text['event'] = "Γεγονός(ότα)";
		$text['day'] = "Ημέρα";
		$text['month'] = "Μήνας";
		$text['keyword'] = "Λέξη κλειδί (πχ, \"Abt\")";
		$text['explain'] = "Enter date components to see matching events. Leave a field blank to see matches for all.";
		$text['enterdate'] = "Please enter or select at least one of the following: Day, Month, Year, Keyword";
		$text['fullname'] = "Πλήρες Ονοματεπώνυμο";
		$text['birthdate'] = "Ημερομηνία Γέννησης";
		$text['altbirthdate'] = "Ημερομηνία Βάπτισης";
		$text['marrdate'] = "Ημερομηνία Γάμου";
		$text['spouseid'] = "Κωδικός Συζύγου";
		$text['spousename'] = "Όνομα Συζύγου";
		$text['deathdate'] = "Ημερομηνία Θανάτου";
		$text['burialdate'] = "Ημερομηνία Ταφής";
		$text['changedate'] = "Ημερομηνία Τελευταίας Ενημέρωσης";
		$text['gedcom'] = "Δέντρο";
		$text['baptdate'] = "Ημερομηνία Βάπτισης (LDS)";
		$text['baptplace'] = "Τόπος Βάπτισης (LDS)";
		$text['endldate'] = "Endowment Ημερομηνία (LDS)";
		$text['endlplace'] = "Endowment Τόπος (LDS)";
		$text['ssealdate'] = "Seal Ημερομηνία S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Seal Τόπος S (LDS)";
		$text['psealdate'] = "Seal Ημερομηνία P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Seal Τόπος P (LDS)";
		$text['marrplace'] = "Marriage Place";
		$text['spousesurname'] = "Spouse's Last Name";
		$text['spousemore'] = "If you enter a value for Spouse's Last Name, you must enter a value for at least one other field.";
		$text['plusminus5'] = "+/- 5 years from";
		$text['exists'] = "exists";
		$text['dnexist'] = "does not exist";
		$text['divdate'] = "Divorce Date";
		$text['divplace'] = "Divorce Place";
		$text['otherevents'] = "Άλλα Γεγονότα";
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
		$text['logfilefor'] = "Αρχείο Ημερολογίου για";
		$text['mostrecentactions'] = "Πρόσφατες Ενέργειες";
		$text['autorefresh'] = "Αυτόματη Ανανέωση (30 δευτερόλεπτα)";
		$text['refreshoff'] = "Απενεργοποίηση Αυτόματης Ανανέωσης";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Νεκτροταφεία και Ταφόπλακες";
		$text['showallhsr'] = "Εμφάνιση όλων των στοιχείων για ταφόπλακες";
		$text['in'] = "μέσα";
		$text['showmap'] = "Εμφάνιση χάρτη";
		$text['headstonefor'] = "Ταφόπλακα για";
		$text['photoof'] = "Φωτογραφία του/της";
		$text['photoowner'] = "Ιδιοκτήτης/Πηγή";
		$text['nocemetery'] = "Δεν υπάρχει Νεκτροταφείο";
		$text['iptc005'] = "Τίτλος";
		$text['iptc020'] = "Επιπλέον Κατηγορίες";
		$text['iptc040'] = "Ειδικές Οδηγίες";
		$text['iptc055'] = "Ημερομηνία Δημιουργίας";
		$text['iptc080'] = "Συγγραφέας";
		$text['iptc085'] = "Θέση Συγγραφέα";
		$text['iptc090'] = "Πόλη";
		$text['iptc095'] = "Πολυτεία";
		$text['iptc101'] = "Χώρα";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Κύριος Τίτλος";
		$text['iptc110'] = "Πηγή";
		$text['iptc115'] = "Φωτογραφία Πηγής";
		$text['iptc116'] = "Δικαιώματα Δημιουργού";
		$text['iptc120'] = "Λεζάντα";
		$text['iptc122'] = "Συγγραφέας Λεζάντας";
		$text['mapof'] = "Χάρτης του/της";
		$text['regphotos'] = "Περιληπτική Μορφή";
		$text['gallery'] = "Thumbnails Only";
		$text['cemphotos'] = "Φωτογραφίες Νεκροταφείων";
		$text['photosize'] = "Μέγεθος";
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
		$text['surnamesstarting'] = "Εμφάνιση επωνύμων που αρχίζουν με";
		$text['showtop'] = "Εμφάνιση επάνω";
		$text['showallsurnames'] = "Εμφάνιση όλων των επωνύμων";
		$text['sortedalpha'] = "ταξινομημένα αλφαβητικά";
		$text['byoccurrence'] = "ταξινομημένα κατά σειρά εμφάνισης";
		$text['firstchars'] = "Πρώτοι χαρακτήρες";
		$text['mainsurnamepage'] = "Κεντρική σελίδα επωνύμων";
		$text['allsurnames'] = "Όλα τα Επώνυμα";
		$text['showmatchingsurnames'] = "Επιλέξτε ένα επώνυμο για να εμφανιστούν τα αντίστοιχα στοιχεία.";
		$text['backtotop'] = "Επαναφορά στη κορυφή";
		$text['beginswith'] = "Αρχίζει με";
		$text['allbeginningwith'] = "Όλα τα επώνυμα που αρχίζουν με";
		$text['numoccurrences'] = "σύνολο των εμφανίσεων σε παρένθεση";
		$text['placesstarting'] = "Εμφάνιση Τοποθεσιω΄ν ξεκινώντας με";
		$text['showmatchingplaces'] = "Επιλέξτε ένα επώνυμο για να εμφανιστούν τα αντίστοιχα στοιχεία.";
		$text['totalnames'] = "σύνολο ατόμων";
		$text['showallplaces'] = "Εμφάνιση των μεγαλυτέρων localities";
		$text['totalplaces'] = "σύνολο τόπων";
		$text['mainplacepage'] = "Main places page";
		$text['allplaces'] = "All Largest Localities";
		$text['placescont'] = "Show all places containing";
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
		$text['pastxdays'] = "(τελευταίες xx ημέρες)";

		$text['photo'] = "Φωτογραφία";
		$text['history'] = "Ιστορικό/Έγγραφο";
		$text['husbid'] = "Κωδικός Συζύγου-Άνδρα";
		$text['husbname'] = "Όνομα Συζύγου-Άνδρα";
		$text['wifeid'] = "Κωδικός Συζύγου-Γυναίκας";
		//added in 11.0.0
		$text['wifename'] = "Mother's Name";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Διαγραφή";
		$text['addperson'] = "Προσθήκη Ατόμου";
		$text['nobirth'] = "Το ακόλουθο άτομο δεν έχει σωστή ημερομηνία γέννησης και δεν μπορούσε να προστεθεί";
		$text['event'] = "Γεγονός(ότα)";
		$text['chartwidth'] = "Chart width";
		$text['timelineinstr'] = "Προστέστε μέχρι τέσσερα ακόμη άτομα εισάγωντας τους κωδικούς τους παρακάτω:";
		$text['togglelines'] = "Toggle Lines";
		//changed in 9.0.0
		$text['noliving'] = "Το ακόλουθο άτομο έχει επισημανθεί ως εν ζωή και δεν μπορούσε να προστεθεί γιατί δεν έχετε συνδεθεί με τις κατάλληλες αρμοδιότητες";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Φυλλομέτρηση Όλων των Δέντρων";
		$text['treename'] = "Όνομα Δέντρου";
		$text['owner'] = "Ιδιοκτήτης";
		$text['address'] = "Διεύθυνση";
		$text['city'] = "Πόλη";
		$text['state'] = "Πολυτεία/Νομός";
		$text['zip'] = "Ταχυδρομικός Κώδικας";
		$text['country'] = "Χώρα";
		$text['email'] = "Διεύθυνση Ηλεκτρονικού Ταχυδρομείου";
		$text['phone'] = "Τηλεφωνο";
		$text['username'] = "Ψευδώνυμο";
		$text['password'] = "Κωδικός";
		$text['loginfailed'] = "Η Σύνδεση απέτυχε.";

		$text['regnewacct'] = "Εγγραφείται για Νέο Λογαριασμό Χρήστη";
		$text['realname'] = "Πραγματικό Ονοματεπώνυμο";
		$text['phone'] = "Τηλεφωνο";
		$text['email'] = "Διεύθυνση Ηλεκτρονικού Ταχυδρομείου";
		$text['address'] = "Διεύθυνση";
		$text['acctcomments'] = "Σημειώσεις ή Σχόλια";
		$text['submit'] = "Υποβολή";
		$text['leaveblank'] = "(αφήστε κενό εάν ζητάτε νέο δέντρο)";
		$text['required'] = "Υποχρεωτικά πεδία";
		$text['enterpassword'] = "Πληκτρολογήστε κωδικό.";
		$text['enterusername'] = "Πληκτρολογήστε ψευδώνυμο.";
		$text['failure'] = "Ζητάμε συγνώμη, αλλά το ψευδώνυμο που επιλέξατε χρησιμοποιείται ήδη. Παρακαλώ χρησιμοποιήστε το κουμπί 'πίσω' στο browser σας για να επιστρέψτε στη προηγούμενη σελίδα και να επιλέξτε νέο ψευδώνυμο.";
		$text['success'] = "Ευχαριστούμε. Έχουμε παραλάβει το αίτημα εγγραφής. Θα επικοινωνήσουμε μαζί σας όταν ενεργοποιηθεί ο λογαριασμός σας ή εάν χρειαστούμε επιπλέον πληροφορίες.";
		$text['emailsubject'] = "Αίτηση για εγγραφή νέου χρήστη της εφαρμογής TNG";
		$text['website'] = "Δικτυακός Τόπος";
		$text['nologin'] = "Δεν έχετε κωδικό σύνδεσης;";
		$text['loginsent'] = "Οι πληροφορίες διασύνδεσης σας έχουν αποσταλεί";
		$text['loginnotsent'] = "Οι πληροφορίες διασύνδεσης δεν έχουν σταλεί";
		$text['enterrealname'] = "Παρακαλώ εισάγετε το αληθινό σας όνομα.";
		$text['rempass'] = "Παραμείνετε συνδεσεμένη στον υπολογιστή αυτό";
		$text['morestats'] = "More statistics";
		$text['accmail'] = "<strong>NOTE:</strong> In order to receive mail from the site administrator regarding your account, please make sure that you are not blocking mail from this domain.";
		$text['newpassword'] = "New Password";
		$text['resetpass'] = "Reset your password";
		$text['nousers'] = "This form cannot be used until at least one user record exists. If you are the site owner, please go to Admin/Users to create your Administrator account.";
		$text['noregs'] = "We're sorry, but we are not accepting new user registrations at this time. Please <a href=\"suggest.php\">contact us</a> directly if you have comments or questions regarding anything on this site.";
		$text['emailmsg'] = "Έχετε νέο αίτημα για λογαριασμό χρήστη στην εφαρμογή TNG. Παρακαλώ συνδεθείτε στον λογαριασμό διαχειριστή στην εφαρμογή TNG και δώστε τις απαραίτητες πιστοποιήσεις για το νέο αυτό αίτημα. Εάν εγκρίνετε την νέα εγγραφή, παρακαλώ ενημερώστε τον νέο χρήστη απαντώντας στο ήνυμα αυτό.";
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
		$text['quantity'] = "Ποσότητα";
		$text['totindividuals'] = "Συνολικός Αριθμός Ατόμων";
		$text['totmales'] = "Συνολικός Αριθμός Ανδρών";
		$text['totfemales'] = "Συνολικός Αριθμός Γυναικών";
		$text['totunknown'] = "Συνολικός αριθμός Ατόμων αγνώστου φύλου";
		$text['totliving'] = "Συνολικός αριθμός εν ζωή Ατόμων";
		$text['totfamilies'] = "Συνολικός Αριθμός Οικογενειών";
		$text['totuniquesn'] = "Συνολικός Αριθμός Μοναδικών Επωνύμων";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Συνολικός Αριθμός Πηγών";
		$text['avglifespan'] = "Μέσος χρόνος ζωής";
		$text['earliestbirth'] = "Παλαιότερη Γέννηση";
		$text['longestlived'] = "Άτομο που έζησε περισσότερο";
		$text['days'] = "μέρες";
		$text['age'] = "Ηλικία";
		$text['agedisclaimer'] = "Υπολογισμοί που σχετίζονται με ηλικίες στηρίζονται σε άτομα που έχουν καταγεγραμμένη ημερομηνία γέννησης <EM>και</EM> ημερομηνία θανάτου.  Λόγω της ύπαρξης ημιτελών ημερομηνιών (π.χ., ημερομηνία θανάτου καταγεγραμμένη ως \"1945\" ή \"ΠΡΙΝ 1860\"), οι υπολογισμοί αυτοί δεν είνι 100% ακριβής.";
		$text['treedetail'] = "More information on this tree";
		$text['total'] = "Total";
		//added in 12.0
		$text['totdeceased'] = "Total Deceased";
		//added in 14.0
		$text['totalsourcecitations'] = "Total Source Citations";
		break;

	case "notes":
		$text['browseallnotes'] = "Επισκόπιση Όλων των Σημείσεων";
		break;

	case "help":
		$text['menuhelp'] = "Μενού Key";
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
$text['matches'] = "Ταιριάζει";
$text['description'] = "Περιγραφή";
$text['notes'] = "Σημειώσεις";
$text['status'] = "Κατάσταση";
$text['newsearch'] = "Νέα Αναζήτηση";
$text['pedigree'] = "Γενεαλόγιο";
$text['seephoto'] = "Δες φωτογραφία";
$text['andlocation'] = "& τοποθεσία";
$text['accessedby'] = "έχει χρησιμοποιηθεί από";
$text['children'] = "Παιδιά";  //from getperson
$text['tree'] = "Δέντρο";
$text['alltrees'] = "Όλα τα Δέντρα";
$text['nosurname'] = "[no surname]";
$text['thumb'] = "Σμίκρυνση";  //as in Thumbnail
$text['people'] = "Άνθρωποι";
$text['title'] = "Τίτλος";  //from getperson
$text['suffix'] = "Επίθεμα";  //from getperson
$text['nickname'] = "Παρατσούκλι";  //from getperson
$text['lastmodified'] = "Τελευταία Αλλαγή";  //from getperson
$text['married'] = "Παντρεμένος/η";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Όνομα"; //from showmap
$text['lastfirst'] = "Επώνυμο, Όνομα";  //from search
$text['bornchr'] = "Γεννηση/Βάπτιση";  //from search
$text['individuals'] = "Άτομα";  //from whats new
$text['families'] = "Οικογένειες";
$text['personid'] = "Κωδικός Ατόμου";
$text['sources'] = "Πηγές";  //from getperson (next several)
$text['unknown'] = "Άγνωστο";
$text['father'] = "Πατέρας";
$text['mother'] = "Μητέρα";
$text['christened'] = "Βάπτιση";
$text['died'] = "Θάνατος";
$text['buried'] = "Ταφή";
$text['spouse'] = "Σύζυγος";  //from search
$text['parents'] = "Γονείς";  //from pedigree
$text['text'] = "Κείμενο";  //from sources
$text['language'] = "Γλώσσα";  //from languages
$text['descendchart'] = "Απόγονοι";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Άτομο";
$text['edit'] = "Διόρθωση";
$text['date'] = "Ημερομηνία";
$text['login'] = "Σύνδεση";
$text['logout'] = "Αποσύνδεση";
$text['groupsheet'] = "Σελίδα Ομάδας";
$text['text_and'] = "και";
$text['generation'] = "Γενεάς";
$text['filename'] = "Όνομα αρχείου";
$text['id'] = "Κωδικός";
$text['search'] = "Αναζήτηση";
$text['user'] = "Χρήστης";
$text['firstname'] = "Πρώτο Όνομα";
$text['lastname'] = "Επώνυμο";
$text['searchresults'] = "Αποτελέσματα Αναζήτησης";
$text['diedburied'] = "Θάνατος/Ταφή";
$text['homepage'] = "Αρχική";
$text['find'] = "Αναζήτηση...";
$text['relationship'] = "Συγγένεια";		//in German, Verwandtschaft
$text['relationship2'] = "Relationship"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Χρονοδιάγραμμα";
$text['yesabbr'] = "Ν";               //abbreviation for 'yes'
$text['divorced'] = "Χωρισμένος/η";
$text['indlinked'] = "Σύνδεση με";
$text['branch'] = "Κλαδί";
$text['moreind'] = "Άλλα Άτομα";
$text['morefam'] = "Άλλες Οικογένειες";
$text['surnamelist'] = "Κατάλογος Επωνύμων";
$text['generations'] = "Γενεές";
$text['refresh'] = "Ανανέωση";
$text['whatsnew'] = "Νέα";
$text['reports'] = "Αναφορές";
$text['placelist'] = "Κατάλογος Τοποθεσιών";
$text['baptizedlds'] = "Βάπτιση (LDS)";
$text['endowedlds'] = "Προίκιση (LDS)";
$text['sealedplds'] = "Σφράγιση P (LDS)";
$text['sealedslds'] = "Σφράγιση S (LDS)";
$text['ancestors'] = "πρόγονοι";
$text['descendants'] = "απόγονοι";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Ημερομηνία τελευταίας εισαγωγής αρχείου GEDCOM";
$text['type'] = "Τύπος";
$text['savechanges'] = "Αποθήκευση Αλλαγών";
$text['familyid'] = "Κωδικός Οικογένειας";
$text['headstone'] = "Ταφόπλακες";
$text['historiesdocs'] = "Ιστορίες";
$text['anonymous'] = "ανώνυμος";
$text['places'] = "Τόποι";
$text['anniversaries'] = "Ημερομηνίες & Επέτειοι";
$text['administration'] = "Διαχείριση";
$text['help'] = "Βοήθεια";
//$text['documents'] = "Documents";
$text['year'] = "Έτος";
$text['all'] = "Όλα";
$text['address'] = "Διεύθυνση";
$text['suggest'] = "Προτείνετε";
$text['editevent'] = "Προτείνετε κάποια αλλαγή για το γεγονός αυτό";
$text['morelinks'] = "Και άλλες συνδέσεις";
$text['faminfo'] = "Οικογενειακές Πληροφορίες";
$text['persinfo'] = "Προσωπικές Πληροφορίες";
$text['srcinfo'] = "Πληροφορίες για Πηγή";
$text['fact'] = "Fact";
$text['goto'] = "Select a page";
$text['tngprint'] = "Print";
$text['databasestatistics'] = "Στατιστικά Βάσης Δεδομένων"; //needed to be shorter to fit on menu
$text['child'] = "Παιδί";  //from familygroup
$text['repoinfo'] = "Αποθετήριο Πληροφοριών";
$text['tng_reset'] = "Επαναφορά Ρυθμίσεων";
$text['noresults'] = "Δεν βρέθηκαν αποτελέσματα";
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
$text['cemetery'] = "Νεκροταφείο";
$text['gmapevent'] = "Event Map";
$text['gevents'] = "Event";
$text['googleearthlink'] = "Link to Google Earth";
$text['googlemaplink'] = "Link to Google Maps";
$text['gmaplegend'] = "Pin Legend";
$text['unmarked'] = "Χωρίς σήμανση";
$text['located'] = "Ευρίσκεται";
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
$text['reliability'] = "Αξιοπιστία";
$text['labels'] = "Labels";
$text['inclsrcs'] = "Include Sources";
$text['cont'] = "(cont.)"; //abbreviation for continued
$text['mnuheader'] = "Αρχική Σελίδα";
$text['mnusearchfornames'] = "Αναζήτηση Ονομάτων";
$text['mnulastname'] = "Επίθετο";
$text['mnufirstname'] = "Όνομα";
$text['mnusearch'] = "Αναζήτηση";
$text['mnureset'] = "Από την αρχή";
$text['mnulogon'] = "Σύνδεση";
$text['mnulogout'] = "Αποσύνδεση";
$text['mnufeatures'] = "Άλλες Λειτουργίες";
$text['mnuregister'] = "Αίτηση για Λογαριασμό Χρήστη";
$text['mnuadvancedsearch'] = "Προχωρημένη Αναζήτηση";
$text['mnulastnames'] = "Επίθετα";
$text['mnustatistics'] = "Στατιστικά";
$text['mnuphotos'] = "Φωτογραφίες";
$text['mnuhistories'] = "Ιστορικά & Κείμενα";
$text['mnumyancestors'] = "Photos &amp; Histories for Ancestors of [Person]";
$text['mnucemeteries'] = "Νεκροταφεία";
$text['mnutombstones'] = "Ταφόπλακες";
$text['mnureports'] = "Αναφορές";
$text['mnusources'] = "Πηγές";
$text['mnuwhatsnew'] = "Τι Νεότερο Υπάρχει;";
$text['mnushowlog'] = "Ημερολόγιο Πρόσβασης";
$text['mnulanguage'] = "Αλλαγή Γλώσσας";
$text['mnuadmin'] = "Διαχείριση";
$text['welcome'] = "Καλωσορίσατε";
$text['contactus'] = "Επικοινωνήσετε μαζί μας";
//changed in 8.0.0
$text['born'] = "Γέννηση";
$text['searchnames'] = "Αναζήτηση Ονομάτων";
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
$text['collapse'] = "Συστολή";
$text['expand'] = "Διαστολή";
$text['plot'] = "Plot";
$text['searchfams'] = "Search Families";
//added in 8.0.2
$text['wasmarried'] = "Married";
$text['anddied'] = "Died";
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
$text['directionsto'] = " to ";
$text['slidestart'] = "Start Slide Show";
$text['livingnote'] = "Άτομο εν ζωή - Λεπτομέρειες έχουν παρακρατηθεί";
$text['livingphoto'] = "Τουλάχιστον ένα άτομο εν ζωή έχει συνδεθεί με την φωτογραφία αυτή - Λεπτομέριες έχουν προστατευτεί.";
$text['waschristened'] = "was christened";
//added in 10.0.0
$text['branches'] = "Branches";
$text['detail'] = "Detail";
$text['moredetail'] = "More detail";
$text['lessdetail'] = "Less detail";
$text['conflds'] = "Confirmed (LDS)";
$text['initlds'] = "Initiatory (LDS)";
$text['wascremated'] = "was cremated";
//moved here in 11.0.0
$text['text_for'] = "για";
//added in 11.0.0
$text['searchsite'] = "ΑΝΑΖΗΤΗΣΗ";
$text['searchsitemenu'] = "ΑΝΑΖΗΤΗΣΗ";
$text['kmlfile'] = "Μεταφόρτωση ενός αρχείου .kml να δείξει αυτή την τοποθεσία στο Google Earth";
$text['download'] = "Κάντε κλικ για να κατεβάσετε";
$text['more'] = "Περισσότερο";
$text['heatmap'] = "Χάρτη θερμότητας";
$text['refreshmap'] = "Ανανέωση χάρτη";
$text['remnums'] = "Σαφή αριθμούς και καρφίτσες";
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
$text['quicklinks'] = "Γρήγοροι σύνδεσμοι";
$text['yourname'] = "Το όνομά σας";
$text['youremail'] = "Η διεύθυνσή σας ηλεκτρονικού ταχυδρομείου";
$text['liketoadd'] = "Οποιεσδήποτε πληροφορίες θέλετε να προσθέσετε";
$text['webmastermsg'] = "Μήνυμα Webmaster";
$text['gallery'] = "Δείτε τη συλλογή";
$text['wasborn_male'] = "γεννήθηκε";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "γεννήθηκε"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "βαπτίστηκε";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "βαπτίστηκε";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "died";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "πέθανε";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "θάφτηκε"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "θάφτηκε"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "έχει αποτεφρωθεί";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "έχει αποτεφρωθεί";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "Έγγαμος";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "Έγγαμος";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "διαζευγμένος";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "διαζευγμένος";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = "σε";			// used as a preposition to the location
$text['onthisdate'] = "σε";		// when used with full date
$text['inthisyear'] = "σε";		// when used with year only or month / year dates
$text['and'] = "και";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Test Info";
//added in 13.0
$text['visitor'] = "Visitor";

$text['popupnote2'] = " = Νέο γενεαλόγιο";

//moved here in 14.0
$text['zoomin'] = "Zoom In";
$text['zoomout'] = "Zoom Out";
$text['scrollnote'] = "Σημείωση: Ίσως χρεαιστεί να μετακινηθείτε κάτω ή δεξιά για να δείτε το διάγραμμα.";
$text['general'] = "General";

//changed in 14.0
$text['otherevents'] = "Άλλα Γεγονότα";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Connections";
$text['continue'] = "Continue";
$text['title2'] = "Title"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>