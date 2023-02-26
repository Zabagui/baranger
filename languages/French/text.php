<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Toutes les sources";
		$text['shorttitle'] = "Titre court";
		$text['callnum'] = "Numéro d'archive";
		$text['author'] = "Auteur";
		$text['publisher'] = "Éditeur";
		$text['other'] = "Autre information";
		$text['sourceid'] = "ID de la source";
		$text['moresrc'] = "Autres sources";
		$text['repoid'] = "ID du lieu des Archives";
		$text['browseallrepos'] = "Rechercher les lieux des Archives";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nouvelle langue";
		$text['changelanguage'] = "Changer la Langue";
		$text['languagesaved'] = "Langue enregistrée";
		$text['sitemaint'] = "Site en cours de maintenance";
		$text['standby'] = "Notre site est temporairement hors service pendant que nous mettons à jour notre base de données. Merci de réessayer dans quelques minutes. Si notre site demeure inaccessible pendant une période prolongée, vous pouvez <a href=\"suggest.php\">contacter son propriétaire</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM commence à partir de";
		$text['producegedfrom'] = "Générer un fichier GEDCOM à partir de";
		$text['numgens'] = "Nombre de générations";
		$text['includelds'] = "Inclure les informations SDJ";
		$text['buildged'] = "Construire GEDCOM";
		$text['gedstartfrom'] = "GEDCOM à partir de";
		$text['nomaxgen'] = "Vous devez spécifier un nombre maximum de générations. Merci de cliquer sur le bouton 'Précédent' et corriger l'erreur";
		$text['gedcreatedfrom'] = "GEDCOM créé à partir de";
		$text['gedcreatedfor'] = "créé pour";
		$text['creategedfor'] = "Créer un fichier GEDCOM";
		$text['email'] = "Adresse de courriel";
		$text['suggestchange'] = "Suggérer une modification";
		$text['yourname'] = "Votre nom";
		$text['comments'] = "Notes ou Commentaires";
		$text['comments2'] = "Commentaires";
		$text['submitsugg'] = "Soumettre une suggestion";
		$text['proposed'] = "Modification proposée";
		$text['mailsent'] = "Merci. Votre message a été envoyé.";
		$text['mailnotsent'] = "Désolé, mais votre message n'a pu être envoyé. Merci de contacter directement xxx à yyy";
		$text['mailme'] = "Envoyer une copie à cette addresse";
		$text['entername'] = "Merci de saisir votre nom";
		$text['entercomments'] = "Merci de saisir vos commentaires";
		$text['sendmsg'] = "Envoyer le message";
		//added in 9.0.0
		$text['subject'] = "Objet";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Photos et historique de";
		$text['indinfofor'] = "Info personnelle concernant";
		$text['pp'] = "pp."; //page abbreviation
		$text['age'] = "Âgé de";
		$text['agency'] = "Agence";
		$text['cause'] = "Cause";
		$text['suggested'] = "Suggéré";
		$text['closewindow'] = "Fermer cette fenêtre";
		$text['thanks'] = "Merci";
		$text['received'] = "Le changement que vous avez proposé sera inclus après vérification par l'administrateur du site.";
		$text['indreport'] = "Rapport individuel";
		$text['indreportfor'] = "Rapport individuel pour";
		$text['bkmkvis'] = "<strong>Note:</strong> Ces signets sont seulement visibles sur cet ordinateur et avec ce navigateur.";
        //added in 9.0.0
		$text['reviewmsg'] = "Vous avez une proposition de modification qui nécessite une vérification de votre part. Cette proposition concerne:";
        $text['revsubject'] = "Le changement proposé nécessite une vérification de votre part";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Calculateur de liens de parenté";
		$text['findrel'] = "Recherche de liens de parenté";
		$text['person1'] = "Personne 1:";
		$text['person2'] = "Personne 2:";
		$text['calculate'] = "Calcul";
		$text['select2inds'] = "Merci de choisir deux personnes.";
		$text['findpersonid'] = "Trouver l'ID de la personne";
		$text['enternamepart'] = "Saisir le prénom ou le nom de famille ";
		$text['pleasenamepart'] = "Merci de saisir le prénom ou le nom de famille.";
		$text['clicktoselect'] = "Cliquer pour sélectionner";
		$text['nobirthinfo'] = "Pas de données de naissance";
		$text['relateto'] = "Liens de parenté avec";
		$text['sameperson'] = "Ces deux individus sont la même personne.";
		$text['notrelated'] = "Les deux individus n'ont pas de lien de parenté sur xxx générations."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Pour afficher les liens de parenté entre deux personnes, utiliser le bouton 'Recherche' ci-dessous pour trouver les individus (ou conserver les individus affichés), ensuite cliquer sur 'Calculer'.";
		$text['sometimes'] = "(Parfois, la vérification d'un nombre différent de générations donne un résultat différent..)";
		$text['findanother'] = "Trouver un autre lien";
		$text['brother'] = "le frère de";
		$text['sister'] = "la soeur de";
		$text['sibling'] = "le frère ou la soeur de";
		$text['uncle'] = "le xxx oncle de";
		$text['aunt'] = "la xxx tante de";
		$text['uncleaunt'] = "le xxx oncle/tante de";
		$text['nephew'] = "le xxx neveu de";
		$text['niece'] = "la xxx nièce de";
		$text['nephnc'] = "le xxx neveu/nièce de";
		$text['removed'] = "générations de différence (\"times removed\")";
		$text['rhusband'] = "l'époux de ";
		$text['rwife'] = "l'épouse de ";
		$text['rspouse'] = "le conjoint de ";
		$text['son'] = "le fils de";
		$text['daughter'] = "la fille de";
		$text['rchild'] = "l'enfant de";
		$text['sil'] = "le gendre de";
		$text['dil'] = "la bru de";
		$text['sdil'] = "le gendre ou la bru de";
		$text['gson'] = "le xxx petit-fils de";
		$text['gdau'] = "la xxx petite-fille de";
		$text['gsondau'] = "le xxx petit-fils/petite-fille de";
		$text['great'] = "arrière";
		$text['spouses'] = "sont conjoints";
		$text['is'] = "est";
		$text['changeto'] = "Changer en:";
		$text['notvalid'] = "n'est pas un ID valide ou n'existe pas dans cette base de données. Merci de réessayer.";
		$text['halfbrother'] = "le demi-frère de ";
		$text['halfsister'] = "la demi-soeur de ";
		$text['halfsibling'] = "demi frère/soeur de";
		//changed in 8.0.0
		$text['gencheck'] = "Générations max à explorer";
		$text['mcousin'] = "le xxx cousin yyy de";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "la xxx cousine yyy de";  //female cousin
		$text['cousin'] = "le xxx cousin yyy de";
		$text['mhalfcousin'] = "le xxx demi cousin  yyy de";  //male cousin
		$text['fhalfcousin'] = "la xxx demi cousine yyy de";  //female cousin
		$text['halfcousin'] = "le xxx demi cousin  yyy de";
		//added in 8.0.0
		$text['oneremoved'] = "au premier degré";
		$text['gfath'] = "le grand-père";
		$text['gmoth'] = "la grand-mère";
		$text['gpar'] = "les grands-parents";
		$text['mothof'] = "la mère de";
		$text['fathof'] = "le père de";
		$text['parof'] = "le parent de";
		$text['maxrels'] = "nombre maximal de relations à voir";
		$text['dospouses'] = "voir les relations comprenant un époux/une épouse";
		$text['rels'] = "relations";
		$text['dospouses2'] = "Afficher les conjoints";
		$text['fil'] = "le beau-père de";
		$text['mil'] = "la belle-mère de";
		$text['fmil'] = "le beau-père ou belle-mère de";
		$text['stepson'] = "le beau-fils de";
		$text['stepdau'] = "la belle-fille de";
		$text['stepchild'] = "le beau-fils / belle-fille de";
		$text['stepgson'] = "le xxx arrière beau-petit-fils de";
		$text['stepgdau'] = "la xxx arrière belle-petite-fille de";
		$text['stepgchild'] = "le xxx arrière-beau-petit-fils / belle-petite-fille de";
		//added in 8.1.1
		$text['ggreat'] = "arrière";
		//added in 8.1.2
		$text['ggfath'] = "le xxx arrière-grand-père de";
		$text['ggmoth'] = "la xxx arrière-grand-mère de";
		$text['ggpar'] = "les xxx arrière-grands-parents de";
		$text['ggson'] = "le xxx petit-fils de";
		$text['ggdau'] = "la xxx petite-fille de";
		$text['ggsondau'] = "le xxx petit-enfant de";
		$text['gstepgson'] = "le xxx petit-fils de";
		$text['gstepgdau'] = "la xxx petite-fille de";
		$text['gstepgchild'] = "le xxx petit-enfant de";
		$text['guncle'] = "le xxx grand-oncle de";
		$text['gaunt'] = "la xxx grande-tante de";
		$text['guncleaunt'] = "xxx grand-oncle / grande-tante de";
		$text['gnephew'] = "le xxx petit-neveu de";
		$text['gniece'] = "la xxx petite-nièce de";
		$text['gnephnc'] = "xxx petit-neveu ou petite-nièce de";
		//added in 14.0
		$text['pathscalc'] = "Rechercher des connexions";
		$text['findrel2'] = "Trouver des liens de parenté et d'autres connexions";
		$text['makeme2nd'] = "Utiliser mon identifiant (ID)";
		$text['usebookmarks'] = "Utiliser des marque-pages";
		$text['select2inds'] = "Merci de choisir deux personnes.";
		$text['indinfofor'] = "Informations individuelles pour";
		$text['nobookmarks'] = "Il n'y a aucun marque-page à utiliser";
		$text['bkmtitle'] = "Personnes trouvées dans les marque-pages";
		$text['bkminfo'] = "Choisir une personne:";
		$text['sortpathsby'] = "Trier les chemins par";
		$text['sortbyshort'] = "Trier par";
		$text['bylengthshort'] = "Longueur";
		$text['badID1'] = ": mauvais identifiant de la personne n°1 - revenir en arrière et recommencer";
		$text['badID2'] = ": mauvais identifiant de la personne n°2 - revenir en arrière et recommencer";
		$text['notintree'] = ": la personne avec cet identifiant n'est pas dans la base de l'arbre actuel.";
		$text['sameperson'] = "Ces deux individus sont la même personne.";;
		$text['nopaths'] = "Ces personnes ne sont pas liées.";
		$text['nopaths1'] = "Pas d'autre chemin plus court que xxx étapes";
		$text['nopaths2'] = "sur xxx testées";
		$text['longestpath'] = "(Le plus long chemin testé avait une longueur de xxx étapes.)";
		$text['relevantpaths'] = "Nombre de chemins trouvés: xxx";
		$text['skipMarr'] = "(en outre, le nombre de chemins trouvés mais non affichés en raison d'un trop grand nombre de mariages était de: xxx)";
		$text['mjaor'] = "ou";
		$text['connectionsto'] = "Connexions avec";
		$text['findanotherpers'] = "Trouver une autre personne...";
		$text['sometimes'] = "(Parfois, la vérification d'un nombre différent de générations donne un résultat différent..)";
		$text['anotherpath'] = "Rechercher d'autres connexions";
		$text['xpath'] = "Chemin ";
		$text['primary'] = "Personne de départ"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Personne finale";
		$text['parent'] = "Parent";
		$text['mhfather'] = "son père";
		$text['mhmother'] = "sa mère";
		$text['mhhusband'] = "son mari";
		$text['mhwife'] = "sa femme";
		$text['mhson'] = "son fils";
		$text['mhdaughter'] = "sa fille";
		$text['fhfather'] = "son père";
		$text['fhmother'] = "sa mère";
		$text['fhhusband'] = "son mari";
		$text['fhwife'] = "sa femme";
		$text['fhson'] = "son fils";
		$text['fhdaughter'] = "sa fille";
		$text['hfather'] = "père";
		$text['hmother'] = "mère";
		$text['hhusband'] = "mari";
		$text['hwife'] = "femme";
		$text['hson'] = "fils";
		$text['hdaughter'] = "fille";
		$text['maxruns'] = "Nombre maximum de chemins à vérifier";
		$text['maxrshort'] = "Nb Max chemins";
		$text['maxlength'] = "Longueur de chemin maximale";
		$text['maxlshort'] = "Long. Max de chemin";
		$text['xstep'] = "étape";
		$text['xsteps'] = "étapes";
		$text['xmarriages'] = "xxx mariages";
		$text['xmarriage'] = "1 mariage";
		$text['showspouses'] = "Afficher les deux conjoints";
		$text['showTxt'] = "Afficher l'énoncé textuel du chemin";
		$text['showTxtshort'] = "Descr. texte";
		$text['compactBox'] = "Afficher les boîtes de personnes sous forme compacte";
		$text['compactBoxshort'] = "Compact";
		$text['paths'] = "Chemins";
		$text['dospouses2'] = "Afficher les conjoints";
		$text['maxmopt'] = "Max mariages par connexion";
		$text['maxm'] = "Max mariages";
		$text['arerelated'] = "Ces personnes sont parentes. Leur relation est montrée dans le Chemin 1";
		$text['simplerel'] = "Recherche de liens de parenté";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Page de la famille de";
		$text['ldsords'] = "Ordonnances SDJ";
		$text['baptizedlds'] = "Baptisé (SDJ)";
		$text['endowedlds'] = "Doté (SDJ)";
		$text['sealedplds'] = "Doté parents (SDJ)";
		$text['sealedslds'] = "Conjoint(e) doté(e) (SDJ)";
		$text['otherspouse'] = "Autre conjoint(e)";
		$text['husband'] = "Mari";
		$text['wife'] = "Femme";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "N";
		$text['capaltbirthabbr'] = "A";
		$text['capdeathabbr'] = "D";
		$text['capburialabbr'] = "E";
		$text['capplaceabbr'] = "L";
		$text['capmarrabbr'] = "M";
		$text['capspouseabbr'] = "ÉP.";
		$text['redraw'] = "Redessiner avec";
		$text['unknownlit'] = "Inconnu";
		$text['popupnote1'] = " = Information supplémentaire";
		$text['pedcompact'] = "Compact";
		$text['pedstandard'] = "Standard";
		$text['pedtextonly'] = "Texte seul";
		$text['descendfor'] = "Descendance de";
		$text['maxof'] = "Maximum de";
		$text['gensatonce'] = "générations affichées en même temps";
		$text['sonof'] = "fils de";
		$text['daughterof'] = "fille de";
		$text['childof'] = "enfant de";
		$text['stdformat'] = "Format standard";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "Ajouter une nouvelle famille";
		$text['editfam'] = "Editer la famille";
		$text['side'] = "(Ascendants)";
		$text['familyof'] = "Famille de";
		$text['paternal'] = "Paternel";
		$text['maternal'] = "Maternel";
		$text['gen1'] = "Soi-même";
		$text['gen2'] = "Parents";
		$text['gen3'] = "Grand-parents (Aïeuls)";
		$text['gen4'] = "Bisaïeuls ";
		$text['gen5'] = "Trisaïeuls";
		$text['gen6'] = "Quatrièmes aïeuls";
		$text['gen7'] = "Cinquièmes aïeuls";
		$text['gen8'] = "Sixièmes aïeuls";
		$text['gen9'] = "Septièmes aïeuls";
		$text['gen10'] = "Huitièmes aïeuls";
		$text['gen11'] = "Neuvièmes aïeuls";
		$text['gen12'] = "Dixièmes aïeuls";
		$text['graphdesc'] = "Tableau de descendance jusqu'à ce point";
		$text['pedbox'] = "Boîte";
		$text['regformat'] = "Format registre";
		$text['extrasexpl'] = "Si des photos ou des histoires existent pour les individus suivants, les icônes correspondantes seront affichées à côté des noms.";
		$text['popupnote3'] = " = Nouveau tableau";
		$text['mediaavail'] = "Média disponible";
		$text['pedigreefor'] = "Arbre de";
		$text['pedigreech'] = "Tableau des ancêtres";
		$text['datesloc'] = "Dates et lieux";
		$text['borchr'] = "Naissance/Baptême – Décès/Sépultures (deux)";
		$text['nobd'] = "Aucune date de naissance ou de décès";
		$text['bcdb'] = "Naissance/Baptême/Décès/Sépulture (quatre)";
		$text['numsys'] = "Système de numérotation";
		$text['gennums'] = "Numérotations de générations";
		$text['henrynums'] = "Numérotation Henry";
		$text['abovnums'] = "Numérotation d'Aboville";
		$text['devnums'] = "Numérotation de Villiers";
		$text['dispopts'] = "Options d'affichage";
		//added in 10.0.0
		$text['no_ancestors'] = "Aucun ascendant";
		$text['ancestor_chart'] = "Tableau d'ascendance";
		$text['opennewwindow'] = "Ouvrir dans un nouvel onglet";
		$text['pedvertical'] = "Vertical";
		//added in 11.0.0
		$text['familywith'] = "famille avec";
		$text['fcmlogin'] = "Connectez-vous pour voir les détails";
		$text['isthe'] = "est le";
		$text['otherspouses'] = "autres conjoints";
		$text['parentfamily'] = "La famille des parents ";
		$text['showfamily'] = "Afficher la famille";
		$text['shown'] = "affiché";
		$text['showparentfamily'] = "Afficher la famille des parents";
		$text['showperson'] = "Afficher la personne";
		//added in 11.0.2
		$text['otherfamilies'] = "Autres familles";
		//added in 14.0
		$text['dtformat'] = "Tableaux";
		$text['dtchildren'] = "Enfants";
		$text['dtgrandchildren'] = "Petits-enfants";
		$text['dtggrandchildren'] = "Arrière-petits-enfants";
		$text['dtgggrandchildren'] = "Arrière-petits-enfants"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Aucun descendant";
		$text['dtgen'] = "Gén.";
		$text['dttotal'] = "Total";
		$text['dtselect'] = "Choisir";
		$text['dteachfulltable'] = "Chaque tableau complet aura";
		$text['dtrows'] = "rangées";
		$text['dtdisplayingtable'] = "Afficher le tableau";
		$text['dtgototable'] = "Aller au tableau :";
		$text['fcinstrdn'] = "Afficher la famille avec le conjoint";
		$text['fcinstrup'] = "Afficher la famille avec les parents";
		$text['fcinstrplus'] = "Choisir un autre conjoint";
		$text['fcinstrfam'] = "Choisir d'autres parents";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Aucun rapport.";
		$text['reportname'] = "Nom du rapport";
		$text['allreports'] = "Tous les rapports";
		$text['report'] = "Rapport";
		$text['error'] = "Erreur";
		$text['reportsyntax'] = "La syntaxe de cette requête";
		$text['wasincorrect'] = "est incorrecte, et le rapport n'a pu être lancé. Merci de contacter votre administrateur système à";
		$text['errormessage'] = "Message d'erreur";
		$text['equals'] = "égal";
		$text['endswith'] = "se termine par";
		$text['soundexof'] = "soundex de";
		$text['metaphoneof'] = "métaphone de";
		$text['plusminus10'] = "+/- 10 années de";
		$text['lessthan'] = "inf. à";
		$text['greaterthan'] = "sup. à";
		$text['lessthanequal'] = "inf. ou égale à";
		$text['greaterthanequal'] = "sup. ou égale à";
		$text['equalto'] = "égale à";
		$text['tryagain'] = "Merci de réessayer";
		$text['joinwith'] = "Lien";
		$text['cap_and'] = "ET";
		$text['cap_or'] = "OU";
		$text['showspouse'] = "Afficher le conjoint(e) (La personne sera répétée pour chaque conjoint)";
		$text['submitquery'] = "Rechercher";
		$text['birthplace'] = "Lieu de naissance";
		$text['deathplace'] = "Lieu de décès";
		$text['birthdatetr'] = "Année de naissance";
		$text['deathdatetr'] = "Année de décès";
		$text['plusminus2'] = "+/- 2 ans de";
		$text['resetall'] = "Réinitialiser toutes les valeurs";
		$text['showdeath'] = "Afficher l'information sur le décès ou l'inhumation";
		$text['altbirthplace'] = "Lieu de baptême";
		$text['altbirthdatetr'] = "Année de baptême";
		$text['burialplace'] = "Lieu de la sépulture";
		$text['burialdatetr'] = "Année de la sépulture";
		$text['event'] = "Évènement(s)";
		$text['day'] = "Jour";
		$text['month'] = "Mois";
		$text['keyword'] = "Mot-clef (par exemple, \"Vers\")";
		$text['explain'] = "Saisir les dates pour voir les évènements correspondants. Laisser un champ vide pour voir toutes les correspondances.";
		$text['enterdate'] = "Saisir ou sélectionner au moins un des éléments suivants: Jour, Mois, Année, Mot-Clef:";
		$text['fullname'] = "Nom entier";
		$text['birthdate'] = "Date de naissance";
		$text['altbirthdate'] = "Date de baptême";
		$text['marrdate'] = "Date de Mariage";
		$text['spouseid'] = "ID de l'épouse";
		$text['spousename'] = "Nom de l'épouse";
		$text['deathdate'] = "Date de décès";
		$text['burialdate'] = "Date de la sépulture";
		$text['changedate'] = "Date de la dernière modification";
		$text['gedcom'] = "Arbre";
		$text['baptdate'] = "Date de baptême (SDJ)";
		$text['baptplace'] = "Lieu de baptême (SDJ)";
		$text['endldate'] = "Date de confirmation (SDJ)";
		$text['endlplace'] = "Lieu de confirmation (SDJ)";
		$text['ssealdate'] = "Date du sceau S (SDJ)";   //Sealed to spouse
		$text['ssealplace'] = "Lieu du sceau S (SDJ)";
		$text['psealdate'] = "Date du sceau (SDJ)";   //Sealed to parents
		$text['psealplace'] = "Lieu du Sceau P (SDJ)";
		$text['marrplace'] = "Lieu du mariage";
		$text['spousesurname'] = "Nom de famille du conjoint";
		$text['spousemore'] = "Si vous entrez une valeur pour le nom de famille du conjoint, vous devez sélectionner un sexe";
		$text['plusminus5'] = "+/- 5 ans de";
		$text['exists'] = "est déjà créé.";
		$text['dnexist'] = "n'existe pas";
		$text['divdate'] = "Date du divorce";
		$text['divplace'] = "Lieu du divorce";
		$text['otherevents'] = "Autres faits";
		$text['numresults'] = "Résultats par page";
		$text['mysphoto'] = "Photos mystères";
		$text['mysperson'] = "Qui sont ces personnes ?";
		$text['joinor'] = "L'option 'Lien avec OU' ne peut pas être employée avec le nom de famille du conjoint";
		$text['tellus'] = "Dites-nous ce que vous savez";
		$text['moreinfo'] = "Plus d'informations :";
		//added in 8.0.0
		$text['marrdatetr'] = "Année de mariage";
		$text['divdatetr'] = "Année de divorce";
		$text['mothername'] = "Nom de la mère";
		$text['fathername'] = "Nom du père";
		$text['filter'] = "filtrage";
		$text['notliving'] = "décédés";
		$text['nodayevents'] = "événements de ce mois non associés à un jour spécifique";
		//added in 9.0.0
		$text['csv'] = "Fichier CSV délimité par des virgules";
		//added in 10.0.0
		$text['confdate'] = "Date de confirmation (SDJ)";
		$text['confplace'] = "Lieu de confirmation (SDJ)";
		$text['initdate'] = "Date d'initiation (SDJ)";
		$text['initplace'] = "Lieu d'initiation (SDJ)";
		//added in 11.0.0
		$text['marrtype'] = "Type de Mariage";
		$text['searchfor'] = "Rechercher";
		$text['searchnote'] = "Note: Cette page utilise Google pour effectuer sa recherche. Le nombre de résultats obtenus sera directement affecté par la faculté d'indexation du site par Google.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Fichier journal pour";
		$text['mostrecentactions'] = "Dernières actions";
		$text['autorefresh'] = "Rafraîchissement automatique (30 secondes)";
		$text['refreshoff'] = "Supprimer le rafraîchissement automatique";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cimetières et Pierres tombales";
		$text['showallhsr'] = "Afficher tous les enregistrements de pierres tombales";
		$text['in'] = "en";
		$text['showmap'] = "Afficher la carte";
		$text['headstonefor'] = "Tombe de";
		$text['photoof'] = "Photo de";
		$text['photoowner'] = "Propriétaire de l'original";
		$text['nocemetery'] = "Pas de cimetière";
		$text['iptc005'] = "Titre";
		$text['iptc020'] = "Catégories supplémentaires";
		$text['iptc040'] = "Instructions spéciales";
		$text['iptc055'] = "Date de création";
		$text['iptc080'] = "Auteur";
		$text['iptc085'] = "Position de l'auteur";
		$text['iptc090'] = "Ville";
		$text['iptc095'] = "Etat";
		$text['iptc101'] = "Pays";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Titre";
		$text['iptc110'] = "Source";
		$text['iptc115'] = "Source de la photo";
		$text['iptc116'] = "Notice de droit d'auteur";
		$text['iptc120'] = "Sous-titre";
		$text['iptc122'] = "Auteur du sous-titre";
		$text['mapof'] = "Carte de";
		$text['regphotos'] = "Vue Descriptive";
		$text['gallery'] = "Uniquement les vignettes";
		$text['cemphotos'] = "Photos du cimetières";
		$text['photosize'] = "Dimensions";
        $text['iptc010'] = "Priorité";
		$text['filesize'] = "Taille du fichier";
		$text['seeloc'] = "Voir le lieu";
		$text['showall'] = "Tout afficher";
		$text['editmedia'] = "Édite le média";
		$text['viewitem'] = "Voir cet item";
		$text['editcem'] = "Édite le cimetière";
		$text['numitems'] = "# Items";
		$text['allalbums'] = "tous les albums";
		$text['slidestop'] = "Arrêter le diaporama";
		$text['slideresume'] = "Reprendre le diaporama";
		$text['slidesecs'] = "Secondes pour chaque diapositive:";
		$text['minussecs'] = "moins 0,5 seconde";
		$text['plussecs'] = "plus 0,5 seconde";
		$text['nocountry'] = "Pays inconnu";
		$text['nostate'] = "État inconnu";
		$text['nocounty'] = "Comté inconnu";
		$text['nocity'] = "Ville inconnue";
		$text['nocemname'] = "Nom du cimetière inconnu";
		$text['editalbum'] = "Éditer l'album";
		$text['mediamaptext'] = "<strong>Note :</strong> Déplacer le pointeur de la souris sur l'image pour afficher les noms. Cliquer pour afficher une page pour chaque nom.";
		//added in 8.0.0
		$text['allburials'] = "Toutes les sépultures";
		$text['moreinfo'] = "Plus d'informations:";
		//added in 9.0.0
        $text['iptc025'] = "Mots-clefs";
        $text['iptc092'] = "Lieu mineur";
		$text['iptc015'] = "Catégorie";
		$text['iptc065'] = "Programme d'origine";
		$text['iptc070'] = "Version du programme";
		//added in 13.0
		$text['toggletags'] = "Montrer/Cacher les étiquettes";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Afficher les noms de famille commençant par";
		$text['showtop'] = "Afficher les ";
		$text['showallsurnames'] = "Afficher tous les noms de famille";
		$text['sortedalpha'] = "par ordre alphabétique";
		$text['byoccurrence'] = " premiers classés par occurrence";
		$text['firstchars'] = "Premiers cararactères";
		$text['mainsurnamepage'] = "noms de famille";
		$text['allsurnames'] = "Tous les noms de famille";
		$text['showmatchingsurnames'] = "Cliquer sur un nom de famille pour afficher les résultats.";
		$text['backtotop'] = "Retour en haut de la page";
		$text['beginswith'] = "Commençant par";
		$text['allbeginningwith'] = "Tous les noms de famille commençant par";
		$text['numoccurrences'] = "nombre de résultats entre parenthèses";
		$text['placesstarting'] = "Afficher les localisations les plus importantes commençant par";
		$text['showmatchingplaces'] = "Cliquer sur un nom pour voir les enregistrements associés.";
		$text['totalnames'] = "total des individus";
		$text['showallplaces'] = "Afficher les localisations les plus importantes";
		$text['totalplaces'] = "sur la totalité des lieux";
		$text['mainplacepage'] = "Page des lieux principaux";
		$text['allplaces'] = "Toutes les localisations les plus importantes";
		$text['placescont'] = "Afficher tous les lieux qui contiennent";
		//changed in 8.0.0
		$text['top30'] = "Les xxx principaux noms de famille";
		$text['top30places'] = "Les xxx localisations les plus importantes";
		//added in 12.0.0
		$text['firstnamelist'] = "Liste des prénoms";
		$text['firstnamesstarting'] = "Afficher les prénoms commençant par";
		$text['showallfirstnames'] = "Afficher tous les prénoms";
		$text['mainfirstnamepage'] = "Page des principaux prénoms";
		$text['allfirstnames'] = "Tous les prénoms";
		$text['showmatchingfirstnames'] = "Cliquer sur un prénom pour voir les enregistrements correspondants.";
		$text['allfirstbegwith'] = "Tous les prénoms commençant par";
		$text['top30first'] = "Les xxx prénoms les plus donnés";
		$text['allothers'] = "Tous les autres";
		$text['amongall'] = "(parmi tous les noms)";
		$text['justtop'] = "Seulement les xxx premiers";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(xx derniers jours)";

		$text['photo'] = "Photo";
		$text['history'] = "Histoire/Document";
		$text['husbid'] = "ID Époux";
		$text['husbname'] = "Nom de l'époux";
		$text['wifeid'] = "ID Épouse";
		//added in 11.0.0
		$text['wifename'] = "Nom de l'épouse";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Supprimer";
		$text['addperson'] = "Ajouter Individu";
		$text['nobirth'] = "L'individu suivant n'a pas de date de naissance valide et n'a donc pas été ajouté";
		$text['event'] = "Évènement(s)";
		$text['chartwidth'] = "Largeur du graphique";
		$text['timelineinstr'] = "Ajouter des individus (saisir leur ID)";
		$text['togglelines'] = "Commuter les lignes";
		//changed in 9.0.0
		$text['noliving'] = "L'individu suivant est enregistré comme étant en vie ou marqué privé et n'est pas affiché parce que vous n’avez pas les autorisations nécessaires";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Tous les arbres";
		$text['treename'] = "Nom de l'arbre";
		$text['owner'] = "Propriétaire";
		$text['address'] = "Adresse";
		$text['city'] = "Ville";
		$text['state'] = "État/Province";
		$text['zip'] = "Code Postal";
		$text['country'] = "Pays";
		$text['email'] = "Adresse de courriel";
		$text['phone'] = "Téléphone";
		$text['username'] = "Nom d'utilisateur";
		$text['password'] = "Mot de passe";
		$text['loginfailed'] = "Erreur de connexion.";

		$text['regnewacct'] = "Enregistrement de nouveau compte utilisateur";
		$text['realname'] = "Votre nom réel";
		$text['phone'] = "Téléphone";
		$text['email'] = "Adresse de courriel";
		$text['address'] = "Adresse";
		$text['acctcomments'] = "Notes ou Commentaires";
		$text['submit'] = "Soumettre";
		$text['leaveblank'] = "(laisser en blanc si vous désirez un nouvel arbre)";
		$text['required'] = "Champs requis";
		$text['enterpassword'] = "Saisir un mot de passe.";
		$text['enterusername'] = "Saisir un nom d'utilisateur.";
		$text['failure'] = "Ce nom d'utilisateur est déjà pris. Merci d'utiliser le bouton retour de votre navigateur pour revenir à la page précédente et sélectionner un autre nom d'utisateur.";
		$text['success'] = "Merci. Nous avons bien reçu votre enregistrement. Nous vous contacterons quand votre compte sera activé ou si nous avons besoin de plus d'information.";
		$text['emailsubject'] = "Demande d'enregistrement de nouvel utisateur TNG";
		$text['website'] = "Site Web";
		$text['nologin'] = "Vous n'avez pas de profil de connexion?";
		$text['loginsent'] = "Vos données de connexion ont été envoyées";
		$text['loginnotsent'] = "Vos données de connexion n'ont pas été envoyées";
		$text['enterrealname'] = "Merci d'entrer votre véritable nom.";
		$text['rempass'] = "Rester connecté sur cet ordinateur";
		$text['morestats'] = "Statistiques additionnelles";
		$text['accmail'] = "<strong>NOTE:</strong> Afin de pouvoir recevoir des courriels de l'administrateur du site concernant votre compte, assurez-vous de ne pas bloquer les courriels provenant de ce domaine.";
		$text['newpassword'] = "Nouveau mot de passe";
		$text['resetpass'] = "Changer de mot de passe";
		$text['nousers'] = "Ce formulaire ne peut être utilisé tant qu'il n'existe pas au moins un enregistrement d'utilisateur. Si vous êtes le propriétaire du site, allez sur Admin/Users pour créer votre compte d'Administrateur.";
		$text['noregs'] = "Nous sommes désolés, mais nous n'acceptons pas de nouveaux enregistrements d'utilisateurs pour le moment. Merci de <a href=\"suggest.php\">nous contacter</a> directement si vous avez commentaires ou questions concernant ce site.";
		$text['emailmsg'] = "Vous avez reçu une nouvelle demande de compte utilisateur TNG. Connectez-vous à la section administration de TNG et accordez à ce nouveau compte les autorisations appropriées. Si vous approuvez cet enregistrement, informez-en le demandeur en répondant à ce message.";
		$text['accactive'] = "Le compte a été activé, mais l'utilisateur n'a pas de droit spécifique tant que vous ne les avez pas spécifiés...";
		$text['accinactive'] = "Aller à Admin/utilisateurs/vérifier pour accéder aux paramètres des comptes. Le compte reste inactif tant que vous ne l'avez pas édité et sauvegardé au moins un fois";
		$text['pwdagain'] = "Répéter le mot de passe";
		$text['enterpassword2'] = "Saisir le mot de passe";
		$text['pwdsmatch'] = "Vos mots de passe ne correspondent pas. Merci de saisir le même mot de passe dans chacun des deux champs";
		$text['acksubject'] = "Merci de vous être enregistré"; //for a new user account
		$text['ackmessage'] = "Votre demande d'un compte d'utilisateur a bien été reçue. Votre compte restera inactif en attendant une vérification par l'administrateur. Nous vous contacterons par courriel dès que votre compte sera activé.";
		//added in 12.0.0
		$text['switch'] = "Commuter";
		//added in 14.0
		$text['newpassword2'] = "Répéter le nouveau mot de passe";
		$text['resetsuccess'] = "Succès : le mot de passe a été réinitialisé";
		$text['resetfail'] = "Échec : le mot de passe n'a pas été réinitialisé";
		$text['failreason0'] = " (erreur inconnue de base de données)";
		$text['failreason2'] = " (vous n'avez pas l'autorisation de changer votre mot de passe)";
		$text['failreason3'] = " (les mots de passe ne correspondent pas)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Naviguer dans toutes les branches";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Nombre";
		$text['totindividuals'] = "Individus";
		$text['totmales'] = "Hommes";
		$text['totfemales'] = "Femmes";
		$text['totunknown'] = "Individus de sexe inconnu";
		$text['totliving'] = "Individus en vie";
		$text['totfamilies'] = "Familles";
		$text['totuniquesn'] = "Noms de famille distincts";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Sources";
		$text['avglifespan'] = "Durée de vie moyenne";
		$text['earliestbirth'] = "Naissance la plus ancienne";
		$text['longestlived'] = "Vie la plus longue";
		$text['days'] = "jours";
		$text['age'] = "Âgé de";
		$text['agedisclaimer'] = "Les calculs liés à l'âge sont basés sur les individus avec une date de naissance connue <EM> et</EM> une date de décès.  En raison de l'existence de données incomplètes(ex. une date de décès enregistrée comme \"1945\" ou \"AVT 1860\"), ces calculs ne sont pas précis à 100%.";
		$text['treedetail'] = "Plus d'information sur cet arbre";
		$text['total'] = "Total";
		//added in 12.0
		$text['totdeceased'] = "Nombre total des morts";
		//added in 14.0
		$text['totalsourcecitations'] = "Total des citations de source";
		break;

	case "notes":
		$text['browseallnotes'] = "Afficher toutes les notes";
		break;

	case "help":
		$text['menuhelp'] = "Touche Menu";
		break;

	case "install":
		$text['perms'] = "Les CHMODS ont tous été définis.";
		$text['noperms'] = "Les CHMODS n'ont pas été définis pour ces fichiers:";
		$text['manual'] = "Merci de les définir manuellement.";
		$text['folder'] = "Le dossier";
		$text['created'] = "a été créé";
		$text['nocreate'] = "n'a pas été créé. Merci de le créer manuellement.";
		$text['infosaved'] = "Information sauvegardée, connexion vérifiée.";
		$text['tablescr'] = "Les tables ont été créées.";
		$text['notables'] = "Les tables suivantes n'ont pas été créées :";
		$text['nocomm'] = "TNG ne communique pas avec votre base de données. Aucune table n'a été créée.";
		$text['newdb'] = "Information sauvegardée, connexion vérifiée, la nouvelle base de données a été créée:";
		$text['noattach'] = "Information sauvegardée. Connexion établie et base de données créée, mais TNG ne peut pas s'y connecter.";
		$text['nodb'] = "Information sauvegardée. Connexion établie, mais la base de données n'existe pas et n'a pu être créée ici. Vérifier que le nom de la base de données est correct, ou utiliser le panneau de commande pour la créer.";
		$text['noconn'] = "Information sauvée mais la connexion n'a pas été établie. Un ou plusieurs des paramètres suivants est incorrect:";
		$text['exists'] = "est déjà créé.";
		$text['noop'] = "Aucune opération n'a été effectuée.";
		//added in 8.0.0
		$text['nouser'] = "L'utilisateur n'a pas été créé. ce nom de utilisateur est peut-être déja pris";
		$text['notree'] = "Impossible de crée l'arbre. L'ID de Arbre est peutêtre déja pris";
		$text['infosaved2'] = "Donneés sauvegardées";
		$text['renamedto'] = "renommé en ";
		$text['norename'] = "n'a pas pu être renommé";
		//changed in 13.0.0
		$text['loginfirst'] = "Des enregistrements d'utilisateur existants ont été détectés. Pour continuer, vous devez d'abord vous connecter ou supprimer tous les enregistrements dans la table des utilisateurs.";
		break;

	case "imgviewer":
		$text['magmode'] = "Mode loupe";
		$text['panmode'] = "Mode Panoramique";
		$text['pan'] = "Cliquer et glisser pour se déplacer à l'intérieur de l'image";
		$text['fitwidth'] = "Adapter à la largeur";
		$text['fitheight'] = "Adapter à la hauteur";
		$text['newwin'] = "Nouvelle fenêtre";
		$text['opennw'] = "Ouvrir l'image dans une nouvelle fenêtre";
		$text['magnifyreg'] = "Cliquer sur l'image pour agrandir une zone";
		$text['imgctrls'] = "Autoriser les contrôles de l'image";
		$text['vwrctrls'] = "Autoriser les contrôles de la visionneuse d'image";
		$text['vwrclose'] = "Fermer la visionneuse d'image";
		break;

	case "dna":
		$text['test_date'] = "Date du test";
		$text['links'] = "Liens utiles";
		$text['testid'] = "ID du test";
		//added in 12.0.0
		$text['mode_values'] = "Valeurs des Modes";
		$text['compareselected'] = "Comparer les tests sélectionnés";
		$text['dnatestscompare'] = "Comparer les Tests ADN-Y";
		$text['keep_name_private'] = "Garder le nom confidentiel";
		$text['browsealltests'] = "Parcourir tous les Tests";
		$text['all_dna_tests'] = "Tous les tests ADN";
		$text['fastmutating'] = "Mutation rapide";
		$text['alltypes'] = "Tous les types";
		$text['allgroups'] = "Tous les groupes";
		$text['Ydna_LITbox_info'] = "Les tests ADN associés à cette personne n'ont pas été nécessairement réalisés par cette personne.<br />La colonne 'Haplogroupe' affiche le résultat en rouge s'il s'agit d'une 'estimation' ou en vert si le test est 'confirmé'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Comparer les tests d'ADNmt sélectionnés";
		$text['dnatestscompare_atdna'] = "Comparer les tests d'ADNat sélectionnés";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "ADN-Y";
		$text['mt_haplogroup'] = "ADNmt";
		$text['sequence'] = "Réf";
		$text['extra_mutations'] = "Mutations additionnelles";
		$text['mrca'] = "Ancêtre RPC";
		$text['ydna_test'] = "Tests ADN-Y ";
		$text['mtdna_test'] = "Tests ADNmt (Mitochondrial)";
		$text['atdna_test'] = "Tests ADNat (autosomal)";
		$text['segment_start'] = "Début";
		$text['segment_end'] = "Fin";
		$text['suggested_relationship'] = "Suggéré";
		$text['actual_relationship'] = "Réel";
		$text['12markers'] = "Marqueurs 1-12";
		$text['25markers'] = "Marqueurs 13-25";
		$text['37markers'] = "Marqueurs 26-37";
		$text['67markers'] = "Marqueurs 38-67";
		$text['111markers'] = "Marqueurs 68-111";
		//added in 13.1
		$text['comparemore'] = "Au moins deux tests doivent être sélectionnés pour être comparés";
		break;
}

//common
$text['matches'] = "Résultats";
$text['description'] = "Description";
$text['notes'] = "Notes";
$text['status'] = "Statut";
$text['newsearch'] = "Nouvelle Recherche";
$text['pedigree'] = "Arbre";
$text['seephoto'] = "Voir la photo";
$text['andlocation'] = "et le lieu";
$text['accessedby'] = "consulté par";
$text['children'] = "Enfants";  //from getperson
$text['tree'] = "Arbre";
$text['alltrees'] = "Tous les arbres";
$text['nosurname'] = "[sans prénom]";
$text['thumb'] = "Vignette";  //as in Thumbnail
$text['people'] = "Personnes";
$text['title'] = "Titre";  //from getperson
$text['suffix'] = "Suffixe";  //from getperson
$text['nickname'] = "Autre nom";  //from getperson
$text['lastmodified'] = "Dernière modif.";  //from getperson
$text['married'] = "Mariage";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nom"; //from showmap
$text['lastfirst'] = "Nom, Prénom(s)";  //from search
$text['bornchr'] = "Né/Baptisé";  //from search
$text['individuals'] = "Personnes";  //from whats new
$text['families'] = "Familles";
$text['personid'] = "ID personne";
$text['sources'] = "Sources";  //from getperson (next several)
$text['unknown'] = "Inconnu";
$text['father'] = "Père";
$text['mother'] = "Mère";
$text['christened'] = "Baptême";
$text['died'] = "Décès";
$text['buried'] = "Sépulture";
$text['spouse'] = "Conjoint(e)";  //from search
$text['parents'] = "Parents";  //from pedigree
$text['text'] = "Texte";  //from sources
$text['language'] = "Langue";  //from languages
$text['descendchart'] = "Descendants";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Personnes";
$text['edit'] = "Éditer";
$text['date'] = "Date";
$text['login'] = "Connexion";
$text['logout'] = "Déconnexion";
$text['groupsheet'] = "Feuille familiale";
$text['text_and'] = "et";
$text['generation'] = "Génération";
$text['filename'] = "Nom de fichier";
$text['id'] = "ID";
$text['search'] = "Chercher";
$text['user'] = "Utilisateur";
$text['firstname'] = "Prénom";
$text['lastname'] = "Nom";
$text['searchresults'] = "Résultats de la recherche";
$text['diedburied'] = "Décès/Sépulture";
$text['homepage'] = "Accueil";
$text['find'] = "Rechercher...";
$text['relationship'] = "Parenté";		//in German, Verwandtschaft
$text['relationship2'] = "Relation"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Frise chronologique";
$text['yesabbr'] = "O";               //abbreviation for 'yes'
$text['divorced'] = "Divorce";
$text['indlinked'] = "Lié à";
$text['branch'] = "Branche";
$text['moreind'] = "Plus d'individus";
$text['morefam'] = "Plus de familles";
$text['surnamelist'] = "Noms de famille";
$text['generations'] = "Générations";
$text['refresh'] = "Rafraîchir";
$text['whatsnew'] = "Quoi de neuf ?";
$text['reports'] = "Rapports";
$text['placelist'] = "Liste de Lieux";
$text['baptizedlds'] = "Baptisé (SDJ)";
$text['endowedlds'] = "Doté (SDJ)";
$text['sealedplds'] = "Doté parents (SDJ)";
$text['sealedslds'] = "Conjoint(e) doté(e) (SDJ)";
$text['ancestors'] = "Ancêtres";
$text['descendants'] = "Descendants";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Date de la dernière importation GEDCOM";
$text['type'] = "Type";
$text['savechanges'] = "Enregistrer les modifications";
$text['familyid'] = "ID Famille";
$text['headstone'] = "Pierres Tombales";
$text['historiesdocs'] = "Histoires";
$text['anonymous'] = "anonyme";
$text['places'] = "Lieux";
$text['anniversaries'] = "Dates & Anniversaires";
$text['administration'] = "Administration";
$text['help'] = "Aide";
//$text['documents'] = "Documents";
$text['year'] = "Année";
$text['all'] = "Tous";
$text['address'] = "Adresse";
$text['suggest'] = "Suggestion";
$text['editevent'] = "Suggérer une modification pour cet évènement";
$text['morelinks'] = "Plus de liens";
$text['faminfo'] = "Information sur la Famille";
$text['persinfo'] = "Information Personnelle";
$text['srcinfo'] = "Infos sur la source";
$text['fact'] = "Événement";
$text['goto'] = "Selectionner une page";
$text['tngprint'] = "Imprimer";
$text['databasestatistics'] = "Statistiques"; //needed to be shorter to fit on menu
$text['child'] = "Enfant";  //from familygroup
$text['repoinfo'] = "Infos lieu des Archives";
$text['tng_reset'] = "Vider";
$text['noresults'] = "Aucun résultat";
$text['allmedia'] = "Tous les médias";
$text['repositories'] = "Archives";
$text['albums'] = "Albums";
$text['cemeteries'] = "Cimetières";
$text['surnames'] = "Noms de famille";
$text['dates'] = "Dates";
$text['link'] = "Lien";
$text['media'] = "Médias";
$text['gender'] = "Genre";
$text['latitude'] = "Latitude";
$text['longitude'] = "Longitude";
$text['bookmarks'] = "Signets";
$text['bookmark'] = "Ajouter un signet";
$text['mngbookmarks'] = "Afficher les signets";
$text['bookmarked'] = "Signet ajouté";
$text['remove'] = "Effacer";
$text['find_menu'] = "Chercher";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cimetières";
$text['gmapevent'] = "Carte d'événements";
$text['gevents'] = "Événements";
$text['googleearthlink'] = "Lien Google Earth";
$text['googlemaplink'] = "Lien Google Map";
$text['gmaplegend'] = "Légende";
$text['unmarked'] = "non marquée(s)";
$text['located'] = "Située(s)";
$text['albclicksee'] = "Cliquer pour voir tous les items dans cet album";
$text['notyetlocated'] = "Pas encore trouvé";
$text['cremated'] = "Incinéré";
$text['missing'] = "Manquant";
$text['pdfgen'] = "Générateur de PDF";
$text['blank'] = "Diagramme vide";
$text['fonts'] = "Polices";
$text['header'] = "En-tête";
$text['data'] = "Données";
$text['pgsetup'] = "Mise en page";
$text['pgsize'] = "Dimensions de la page";
$text['orient'] = "Orientation"; //for a page
$text['portrait'] = "Portrait";
$text['landscape'] = "Paysage";
$text['tmargin'] = "Marge supérieure";
$text['bmargin'] = "Marge inférieure";
$text['lmargin'] = "Marge de gauche";
$text['rmargin'] = "Marge de droite";
$text['createch'] = "Créer le diagramme";
$text['prefix'] = "Préfixe";
$text['mostwanted'] = "Les plus recherchés";
$text['latupdates'] = "Les dernières mises à jour";
$text['featphoto'] = "Photo sélectionnée";
$text['news'] = "Nouvelles";
$text['ourhist'] = "Histoire de notre famille";
$text['ourhistanc'] = "Histoire et généalogie de notre famille";
$text['ourpages'] = "Page de la généalogie de notre famille";
$text['pwrdby'] = "Ce site fonctionne grace au logiciel";
$text['writby'] = "écrit par";
$text['searchtngnet'] = "Recherche dans le TNG Network (GENDEX)";
$text['viewphotos'] = "Regarder toutes les photos";
$text['anon'] = "Vous êtes actuellement anonyme";
$text['whichbranch'] = "De quelle branche êtes-vous ?";
$text['featarts'] = "Articles sélectionnés";
$text['maintby'] = "Géré par";
$text['createdon'] = "Créé le";
$text['reliability'] = "Fiabilité";
$text['labels'] = "Étiquettes";
$text['inclsrcs'] = "Inclure les Sources";
$text['cont'] = "(à suiv.)"; //abbreviation for continued
$text['mnuheader'] = "Accueil";
$text['mnusearchfornames'] = "Recherche";
$text['mnulastname'] = "Nom de famille";
$text['mnufirstname'] = "Prénom";
$text['mnusearch'] = "Chercher";
$text['mnureset'] = "Recommencer";
$text['mnulogon'] = "Connexion";
$text['mnulogout'] = "Déconnexion";
$text['mnufeatures'] = "Autres fonctions";
$text['mnuregister'] = "Demander un compte utilisateur";
$text['mnuadvancedsearch'] = "Recherche avancée";
$text['mnulastnames'] = "Noms de famille";
$text['mnustatistics'] = "Statistiques";
$text['mnuphotos'] = "Photos";
$text['mnuhistories'] = "Histoires";
$text['mnumyancestors'] = "Photos & Histoires des Ancêtres de [Personne]";
$text['mnucemeteries'] = "Cimetières";
$text['mnutombstones'] = "Pierres tombales";
$text['mnureports'] = "Rapports";
$text['mnusources'] = "Sources";
$text['mnuwhatsnew'] = "Quoi de neuf?";
$text['mnushowlog'] = "Journal d'accès";
$text['mnulanguage'] = "Changer de langue";
$text['mnuadmin'] = "Administration";
$text['welcome'] = "Bienvenue";
$text['contactus'] = "Contactez-nous";
//changed in 8.0.0
$text['born'] = "Naissance";
$text['searchnames'] = "Recherche individus";
//added in 8.0.0
$text['editperson'] = "Modifier individus";
$text['loadmap'] = "Charger la carte";
$text['birth'] = "Naissance";
$text['wasborn'] = "est né-e ";
$text['startnum'] = "Premier numéro";
$text['searching'] = "Recherche en cours";
//moved here in 8.0.0
$text['location'] = "Lieu";
$text['association'] = "Association";
$text['collapse'] = "Réduire";
$text['expand'] = "Développer";
$text['plot'] = "Lot";
$text['searchfams'] = "Recherche familles";
//added in 8.0.2
$text['wasmarried'] = "a épousé ";
$text['anddied'] = "est mort-e ";
//added in 9.0.0
$text['share'] = "Partager";
$text['hide'] = "Cacher";
$text['disabled'] = "Votre compte utilisateur a été désactivé. Merci de contacter l'administrateur du site pour plus d'information.";
$text['contactus_long'] = "Si vous avez des questions ou des commentaires à propos de l'information publiée sur ce site, merci de <span class=\"emphasis\"><a href=\"suggest.php\">nous contacter</a></span>. Nous attendons de vos nouvelles.";
$text['features'] = "Articles";
$text['resources'] = "Ressources";
$text['latestnews'] = "Dernières Nouvelles";
$text['trees'] = "Arbres";
$text['wasburied'] = "a été enterré-e ";
//moved here in 9.0.0
$text['emailagain'] = "Confirmer l'adresse courriel";
$text['enteremail2'] = "Merci de saisir de nouveau votre adresse courriel";
$text['emailsmatch'] = "Vos courriels ne correspondent pas. Merci de saisir la même adresse courriel dans chaque case.";
$text['getdirections'] = "Cliquer ici pour obtenir les instructions";
$text['calendar'] = "Calendrier";
//changed in 9.0.0
$text['directionsto'] = " au ";
$text['slidestart'] = "Diaporama";
$text['livingnote'] = "Au moins une personne vivante ou marquée privée est liée à cette note - Les détails ne sont donc pas publiés.";
$text['livingphoto'] = "Au moins une personne vivante ou marquée privée est liée à cette photo - Details cachés.";
$text['waschristened'] = "a été baptisé-e ";
//added in 10.0.0
$text['branches'] = "Branches";
$text['detail'] = "Détail";
$text['moredetail'] = "Plus détail";
$text['lessdetail'] = "Moins détail";
$text['conflds'] = "Confirmé/e (SDJ)";
$text['initlds'] = "Initié/e (SDJ)";
$text['wascremated'] = "a été incinéré";
//moved here in 11.0.0
$text['text_for'] = "pour";
//added in 11.0.0
$text['searchsite'] = "Rechercher sur ce site";
$text['searchsitemenu'] = "Recherche";
$text['kmlfile'] = "Télécharger un fichier .kml pour afficher ce lieu dans Google Earth";
$text['download'] = "Cliquer ici pour télécharger";
$text['more'] = "Plus";
$text['heatmap'] = "Carte de densité";
$text['refreshmap'] = "Actualiser la carte";
$text['remnums'] = "Retirer les nombres et les repères";
$text['photoshistories'] = "Photos et récits";
$text['familychart'] = "Tableau familial";
//added in 12.0.0
$text['firstnames'] = "Prénoms";
//moved here in 12.0.0
$text['dna_test'] = "Test ADN";
$text['test_type'] = "Type de test";
$text['test_info'] = "Information du test";
$text['takenby'] = "Réalisé par";
$text['haplogroup'] = "Haplogroupe";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Connexions pertinentes";
$text['nofirstname'] = "[pas de prénom]";
//added in 12.0.1
$text['cookieuse'] = "Note : Ce site utilise des cookies.";
$text['dataprotect'] = "Charte de protection des données";
$text['viewpolicy'] = "Afficher la charte";
$text['understand'] = "Je comprends";
$text['consent'] = "Je donne mon consentement pour que ce site stocke les informations personnelles collectées ici. Je comprends que je peux demander au propriétaire du site de supprimer ces informations à tout moment.";
$text['consentreq'] = "Merci de donner votre consentement à ce que ce site conserve vos données personnelles.";

//added in 12.1.0
$text['testsarelinked'] = "tests ADN sont associé à";
$text['testislinked'] = "test ADN est associé à";

//added in 12.2
$text['quicklinks'] = "Liens rapides";
$text['yourname'] = "Votre nom";
$text['youremail'] = "Votre adresse email";
$text['liketoadd'] = "Toutes les informations que vous souhaitez ajouter";
$text['webmastermsg'] = "Message du webmaster";
$text['gallery'] = "Voir la galerie";
$text['wasborn_male'] = "est né";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "est née"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "a été baptisé";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "a été baptisée";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "est mort";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "est morte";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "a été enterré"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "a été enterrée"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "a été incinéré";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "a été incinérée";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "a épousé";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "a épousé";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "est divorcé";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "est divorcée";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " à ";			// used as a preposition to the location
$text['onthisdate'] = " le ";		// when used with full date
$text['inthisyear'] = " en ";		// when used with year only or month / year dates
$text['and'] = "et ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Info test ADN";
//added in 13.0
$text['visitor'] = "Visiteur";

$text['popupnote2'] = " = Nouvel arbre";

//moved here in 14.0
$text['zoomin'] = "Augmenter le Zoom";
$text['zoomout'] = "Diminuer le Zoom";
$text['scrollnote'] = "Étirer ou faire défiler pour voir plus de détails sur le tableau.";
$text['general'] = "Généralités";

//changed in 14.0
$text['otherevents'] = "Autres événements/attributs";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Connexions";
$text['continue'] = "Continuer";
$text['title2'] = "Titre";  //from getperson

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>