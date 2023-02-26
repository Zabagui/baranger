<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Voir toutes les sources";
		$text['shorttitle'] = "Sigle";
		$text['callnum'] = "No. de repérage";
		$text['author'] = "Auteur";
		$text['publisher'] = "Édition";
		$text['other'] = "Autre information";
		$text['sourceid'] = "No. de la source";
		$text['moresrc'] = "Autres sources";
		$text['repoid'] = "No. du dépositaire";
		$text['browseallrepos'] = "Rechercher parmi les dépositaires";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Autre langue";
		$text['changelanguage'] = "Changer la langue d'affichage";
		$text['languagesaved'] = "Langue enregistrée";
		$text['sitemaint'] = "Hors service";
		$text['standby'] = "Hors service. Revenir plus tard. Si le site reste inaccessible pendant une période anormalement longue, S.V.P. <a href=\"suggest.php\">contacter le webmaître</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "Probant initial du gedcom";
		$text['producegedfrom'] = "Type de gedcom";
		$text['numgens'] = "Générations";
		$text['includelds'] = "Inclure les informations SDJ";
		$text['buildged'] = "Créer un gedcom";
		$text['gedstartfrom'] = "Probant initial";
		$text['nomaxgen'] = "Il faut préciser un nombre de générations. Il faut cliquer sur le bouton 'Précédent' et corriger l'erreur";
		$text['gedcreatedfrom'] = "Le gedcom est créé à partir de";
		$text['gedcreatedfor'] = "créé pour";
		$text['creategedfor'] = "Créer un gedcom pour";
		$text['email'] = "Votre courriel";
		$text['suggestchange'] = "Suggérer un ajout ou une correction";
		$text['yourname'] = "Votre nom";
		$text['comments'] = "Notes ou Commentaires";
		$text['comments2'] = "Commentaires";
		$text['submitsugg'] = "Faire une suggestion";
		$text['proposed'] = "Modification proposée";
		$text['mailsent'] = "Merci. Votre message a été envoyé.";
		$text['mailnotsent'] = "Désolé, votre message n'a pas été envoyé. Il faut contacter directement xxx à yyy";
		$text['mailme'] = "Cocher pour recevoir une copie";
		$text['entername'] = "Saisir votre nom";
		$text['entercomments'] = "Saisir vos commentaires";
		$text['sendmsg'] = "Envoyer le message";
		//added in 9.0.0
		$text['subject'] = "Objet";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Photos et historique de";
		$text['indinfofor'] = "Recherche sur";
		$text['pp'] = "pp."; //page abbreviation
		$text['age'] = "Âge";
		$text['agency'] = "Agence";
		$text['cause'] = "Cause";
		$text['suggested'] = "Suggéré";
		$text['closewindow'] = "Fermer cette fenêtre";
		$text['thanks'] = "Merci";
		$text['received'] = "Le changement que vous avez proposé sera inclus après révision par le gestionnaire du site.";
		$text['indreport'] = "Fiche personnelle de probant";
		$text['indreportfor'] = "Fiche personnelle de";
		$text['bkmkvis'] = "<strong>Note:</strong> Ces signets ne sont visibles que dans votre ordinateur et seulement avec votre navigateur.";
        //added in 9.0.0
		$text['reviewmsg'] = "Vous avez reçu une proposition qui nécessite une révision de votre part. Cette proposition concerne:";
        $text['revsubject'] = "Le changement proposé nécessite une révision de votre part";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Calculateur de liens de parenté";
		$text['findrel'] = "Chercher des liens de parenté";
		$text['person1'] = "Probant 1:";
		$text['person2'] = "Probant 2:";
		$text['calculate'] = "Calculer";
		$text['select2inds'] = "Il faut choisir deux probants";
		$text['findpersonid'] = "Chercher le no. de la fiche de probant";
		$text['enternamepart'] = "Saisir le prénom ou le nom de famille";
		$text['pleasenamepart'] = "Il faut saisir le prénom ou le nom de famille.";
		$text['clicktoselect'] = "Cliquer pour choisir";
		$text['nobirthinfo'] = "Rien sur la naissance";
		$text['relateto'] = "Liens de parenté avec";
		$text['sameperson'] = "Ces deux probants sont une même personne.";
		$text['notrelated'] = "Les deux probants n'ont pas de lien de parenté sur xxx générations."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Pour voir les liens de parenté entre deux probants, il faut utiliser le bouton 'Chercher...' ci-dessous pour trouver les probants (ou utiliser les probants déjà affichés), ensuite il faut cliquer sur 'Calculer'.";
		$text['sometimes'] = "(Parfois, la vérification sur un nombre différent de générations donne un résultat différent.)";
		$text['findanother'] = "Chercher un autre lien";
		$text['brother'] = " frère de";
		$text['sister'] = " soeur de";
		$text['sibling'] = " frère ou soeur de";
		$text['uncle'] = "le xxx oncle de";
		$text['aunt'] = "la xxx tante de";
		$text['uncleaunt'] = "le xxx oncle/tante de";
		$text['nephew'] = "le xxx neveu de";
		$text['niece'] = "la xxx nièce de";
		$text['nephnc'] = "le xxx neveu/nièce de";
		$text['removed'] = "générations de décalage";
		$text['rhusband'] = "l'époux de";
		$text['rwife'] = "l'épouse de";
		$text['rspouse'] = "le conjoint de";
		$text['son'] = " fils de";
		$text['daughter'] = " fille de";
		$text['rchild'] = " enfant de";
		$text['sil'] = " gendre de";
		$text['dil'] = " bru de";
		$text['sdil'] = " gendre ou la bru de";
		$text['gson'] = " xxx petit-fils de";
		$text['gdau'] = " xxx petite-fille de";
		$text['gsondau'] = " xxx petit-fils ou petite-fille de";
		$text['great'] = "arrière";
		$text['spouses'] = "sont conjoints";
		$text['is'] = "est";
		$text['changeto'] = "Changer pour:";
		$text['notvalid'] = "n'est pas un No. valide ou n'existe pas dans ce fichier. Il faut essayer de nouveau.";
		$text['halfbrother'] = " demi-frère de";
		$text['halfsister'] = " demie-soeur de";
		$text['halfsibling'] = "demi frère/soeur de";
		//changed in 8.0.0
		$text['gencheck'] = "Nombre de générations à vérifier";
		$text['mcousin'] = " xxx cousin yyy avec";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = " xxx cousine yyy avec";  //female cousin
		$text['cousin'] = " xxx cousin yyy avec";
		$text['mhalfcousin'] = " xxx demi cousin  yyy avec";  //male cousin
		$text['fhalfcousin'] = " xxx demie cousine yyy avec";  //female cousin
		$text['halfcousin'] = " xxx demi cousin  yyy avec";
		//added in 8.0.0
		$text['oneremoved'] = "à compter de l'ancêtre commun";
		$text['gfath'] = " grand-père";
		$text['gmoth'] = " grand-mère";
		$text['gpar'] = " grands-parents";
		$text['mothof'] = " mère de";
		$text['fathof'] = " père de";
		$text['parof'] = " parent de";
		$text['maxrels'] = "Nombre de liens à voir";
		$text['dospouses'] = "Inclure la parenté par affinité";
		$text['rels'] = "Liens";
		$text['dospouses2'] = "Afficher les conjoints";
		$text['fil'] = " beau-père de";
		$text['mil'] = " belle-mère de";
		$text['fmil'] = " beau-père ou belle-mère de";
		$text['stepson'] = " gendre de";
		$text['stepdau'] = " brue de";
		$text['stepchild'] = " gendre / brue de";
		$text['stepgson'] = " xxx arrière beau-petit-fils de";
		$text['stepgdau'] = " xxx arrière belle-petite-fille de";
		$text['stepgchild'] = " xxx arrière-beau-petit-fils / belle-petite-fille de";
		//added in 8.1.1
		$text['ggreat'] = "arrière-arrière";
		//added in 8.1.2
		$text['ggfath'] = " xxx arrière-grand-père de";
		$text['ggmoth'] = " xxx arrière-grand-mère de";
		$text['ggpar'] = " xxx arrière-grands-parents de";
		$text['ggson'] = " xxx arrière-petit-fils de";
		$text['ggdau'] = " xxx arrière-petite-fille";
		$text['ggsondau'] = " xxx arrière-petit-enfant de";
		$text['gstepgson'] = " xxx petit-fils de";
		$text['gstepgdau'] = " xxx petite-fille";
		$text['gstepgchild'] = " xxx petit-enfant de";
		$text['guncle'] = " xxx grand-oncle de";
		$text['gaunt'] = " xxx grande-tante de";
		$text['guncleaunt'] = " xxx grand-oncle / grande-tante de";
		$text['gnephew'] = " xxx petit-neveu de";
		$text['gniece'] = " xxx petite-nièce de";
		$text['gnephnc'] = " xxx petit-neveu ou petite-nièce de";
		//added in 14.0
		$text['pathscalc'] = "Trouver les alliances";
		$text['findrel2'] = "Trouver une parenté ou autres alliances";
		$text['makeme2nd'] = "Utiliser mon no. ID";
		$text['usebookmarks'] = "Utiliser les signets";
		$text['select2inds'] = "Il faut choisir deux probants";
		$text['indinfofor'] = "Info particulière pour";
		$text['nobookmarks'] = "Aucun signet à utiliser";
		$text['bkmtitle'] = "probants trouvés dans les signets";
		$text['bkminfo'] = "Choisir un probant:";
		$text['sortpathsby'] = "Trier les chemins par nombre de";
		$text['sortbyshort'] = "Trier par";
		$text['bylengthshort'] = "Longueur";
		$text['badID1'] = ": mauvais no. ID du probant 1 - revenir et corriger";
		$text['badID2'] = ": mauvais no. ID du probant 2 - revenir et corriger";
		$text['notintree'] = ": le probant avec ce no. ID est introuvable dans cette base de données";
		$text['sameperson'] = "Ces deux probants sont une même personne.";;
		$text['nopaths'] = "Aucune alliance entre ces deux probants.";
		$text['nopaths1'] = "No more connections shorter than xxx";
		$text['nopaths2'] = "dans xxx niveaux de recherche";
		$text['longestpath'] = "(le chemin le plus long vérifié jusqu'à présent était long de xxx niveaux)";
		$text['relevantpaths'] = "Nombre de chemins pertinents différents trouvés : xxx";
		$text['skipMarr'] = "(de plus, le nombre de chemins trouvés mais non affichés à cause d'un trop grand nombre de mariages était de : xxx)";
		$text['mjaor'] = "ou";
		$text['connectionsto'] = "Chemins vers ";
		$text['findanotherpers'] = "Trouver un autre probant...";
		$text['sometimes'] = "(Parfois, la vérification sur un nombre différent de générations donne un résultat différent.)";
		$text['anotherpath'] = "Chercher un autre chemin";
		$text['xpath'] = "Chemin ";
		$text['primary'] = "Probant initial"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Probant final";
		$text['parent'] = "Parent";
		$text['mhfather'] = "son père";
		$text['mhmother'] = "sa mère";
		$text['mhhusband'] = "son époux";
		$text['mhwife'] = "son épouse";
		$text['mhson'] = "son fils";
		$text['mhdaughter'] = "sa fille";
		$text['fhfather'] = "son père";
		$text['fhmother'] = "sa mère";
		$text['fhhusband'] = "son époux";
		$text['fhwife'] = "son épouse";
		$text['fhson'] = "son fils";
		$text['fhdaughter'] = "sa fille";
		$text['hfather'] = "père";
		$text['hmother'] = "mère";
		$text['hhusband'] = "époux";
		$text['hwife'] = "épouse";
		$text['hson'] = "fils";
		$text['hdaughter'] = "fille";
		$text['maxruns'] = "Nombre max. de chemins à vérifier";
		$text['maxrshort'] = "Chemins max.";
		$text['maxlength'] = "Longueur de chemin limitée à";
		$text['maxlshort'] = "Longueur max.";
		$text['xstep'] = "niveau";
		$text['xsteps'] = "niveaux";
		$text['xmarriages'] = "xxx mariages";
		$text['xmarriage'] = "1 mariage";
		$text['showspouses'] = "Afficher les deux conjoints";
		$text['showTxt'] = "Afficher le chemin de la description";
		$text['showTxtshort'] = "Desc. textuelle.";
		$text['compactBox'] = "Compacter les cadres de personnes";
		$text['compactBoxshort'] = "Cadres compacts";
		$text['paths'] = "Chemins";
		$text['dospouses2'] = "Afficher les conjoints";
		$text['maxmopt'] = "Nombre optionnel de mariages par connexion";
		$text['maxm'] = "Nombre de mariages";
		$text['arerelated'] = "Ces probants sont apparentés - leur parenté est affichée dans le Chemin 1";
		$text['simplerel'] = "Recherche de parenté par alliance";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Page de la famille de";
		$text['ldsords'] = "Ordonnances SDJ";
		$text['baptizedlds'] = "Baptisé (SDJ)";
		$text['endowedlds'] = "Doté (SDJ)";
		$text['sealedplds'] = "Doté parents (SDJ)";
		$text['sealedslds'] = "Conjoint/e doté(e) (SDJ)";
		$text['otherspouse'] = "Autre conjoint(e)";
		$text['husband'] = "Époux";
		$text['wife'] = "Épouse";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "N";
		$text['capaltbirthabbr'] = "B";
		$text['capdeathabbr'] = "D";
		$text['capburialabbr'] = "S";
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
		$text['editfam'] = "Éditer la famille";
		$text['side'] = "(Ascendants)";
		$text['familyof'] = "Famille de";
		$text['paternal'] = "Paternel";
		$text['maternal'] = "Maternel";
		$text['gen1'] = "Soi-même";
		$text['gen2'] = "Parents";
		$text['gen3'] = "Grands-parents";
		$text['gen4'] = "Arrières-grands-parents";
		$text['gen5'] = "Arrières-arrières-grands-parents";
		$text['gen6'] = "3e Arrières-grands-parents";
		$text['gen7'] = "4e Arrières-grands-parents";
		$text['gen8'] = "5e Arrières-grands-parents";
		$text['gen9'] = "6e Arrières-grands-parents";
		$text['gen10'] = "7e Arrières-grands-parents";
		$text['gen11'] = "8e Arrières-grands-parents";
		$text['gen12'] = "9e Arrières-grands-parents";
		$text['graphdesc'] = "Tableau de descendance jusqu'à";
		$text['pedbox'] = "Cadre";
		$text['regformat'] = "Format registre";
		$text['extrasexpl'] = "Si des photos ou des histoires existent pour les probants suivants, les icônes correspondantes seront affichées à côté des noms.";
		$text['popupnote3'] = " = Nouveau tableau";
		$text['mediaavail'] = "Média disponible";
		$text['pedigreefor'] = "Fiche de";
		$text['pedigreech'] = "Tableau des ascendants";
		$text['datesloc'] = "Dates/Lieux";
		$text['borchr'] = "Naissance/Décès (2)";
		$text['nobd'] = "Aucune date de naissance ou de décès";
		$text['bcdb'] = "Naiss./Bap/Décès/Inhumation (4)";
		$text['numsys'] = "Choix de numérotation";
		$text['gennums'] = "Générations numérotées";
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
		$text['fcmlogin'] = "Il faut se connecter pour voir les détails";
		$text['isthe'] = "est le";
		$text['otherspouses'] = "Autres conjoints";
		$text['parentfamily'] = "Les parents";
		$text['showfamily'] = "Voir la famille";
		$text['shown'] = "affiché";
		$text['showparentfamily'] = "Voir les parents";
		$text['showperson'] = "Voir le probant";
		//added in 11.0.2
		$text['otherfamilies'] = "Autres familles";
		//added in 14.0
		$text['dtformat'] = "Format de tableau";
		$text['dtchildren'] = "Enfants";
		$text['dtgrandchildren'] = "Petits-enfants";
		$text['dtggrandchildren'] = "Arrières-petits-enfants";
		$text['dtgggrandchildren'] = "Arrières-arrières-petits-enfants"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Aucune descendance";
		$text['dtgen'] = "Gén";
		$text['dttotal'] = "Total";
		$text['dtselect'] = "Choisir";
		$text['dteachfulltable'] = "Chaque tableau complet aura";
		$text['dtrows'] = "lignes";
		$text['dtdisplayingtable'] = "Affichage du tableau";
		$text['dtgototable'] = "Voir la table:";
		$text['fcinstrdn'] = "Afficher la famille avec le conjoint";
		$text['fcinstrup'] = "Afficher la famille avec les parents";
		$text['fcinstrplus'] = "Choisir d'autres conjoints";
		$text['fcinstrfam'] = "Choisir d'autres parents";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Aucun répertoire en ligne";
		$text['reportname'] = "Nom du répertoire";
		$text['allreports'] = "Tous les répertoires";
		$text['report'] = "Répertoire";
		$text['error'] = "Erreur";
		$text['reportsyntax'] = "La syntaxe de cette requête";
		$text['wasincorrect'] = "est incorrecte, et la réponse n'est pas possible. Contacter l'administrateur système à ";
		$text['errormessage'] = "Message d'erreur";
		$text['equals'] = "égal à";
		$text['endswith'] = "se termine par";
		$text['soundexof'] = "Soundex";
		$text['metaphoneof'] = "Métaphone";
		$text['plusminus10'] = "+/- 10 ans";
		$text['lessthan'] = "Avant";
		$text['greaterthan'] = "Après";
		$text['lessthanequal'] = "Avant ou égal à";
		$text['greaterthanequal'] = "Après ou égal à";
		$text['equalto'] = "égal à";
		$text['tryagain'] = "Il faut essayer de nouveau";
		$text['joinwith'] = "Lien";
		$text['cap_and'] = "ET";
		$text['cap_or'] = "OU";
		$text['showspouse'] = "Voir le conjoint (Le probant sera répété avec chaque conjoint)";
		$text['submitquery'] = "Envoyer la requête";
		$text['birthplace'] = "Lieu de naissance";
		$text['deathplace'] = "Lieu de décès";
		$text['birthdatetr'] = "Année de naissance";
		$text['deathdatetr'] = "Année de décès";
		$text['plusminus2'] = "+/- 2 ans";
		$text['resetall'] = "Réinitialiser toutes les valeurs";
		$text['showdeath'] = "Voir l'information au sujet du décès ou au sujet de l'inhumation";
		$text['altbirthplace'] = "Lieu du baptême";
		$text['altbirthdatetr'] = "Année du baptême";
		$text['burialplace'] = "Lieu d'inhumation";
		$text['burialdatetr'] = "Année d'inhumation";
		$text['event'] = "Événement(s)";
		$text['day'] = "jour";
		$text['month'] = "mois";
		$text['keyword'] = "Mot-clef (par exemple, \"Vers\")";
		$text['explain'] = "Saisir les dates pour voir les événements correspondants. Laisser un champ vide pour voir toutes les occurences.";
		$text['enterdate'] = "Saisir ou choisir au moins un des éléments suivants: Jour, Mois, Année, Mot-Clef:";
		$text['fullname'] = "Nom complet";
		$text['birthdate'] = "Date de naissance";
		$text['altbirthdate'] = "Date du baptême";
		$text['marrdate'] = "Date du mariage";
		$text['spouseid'] = "No. conjoint/e";
		$text['spousename'] = "Conjoint ou Conjointe";
		$text['deathdate'] = "Date du décès";
		$text['burialdate'] = "Date d'inhumation";
		$text['changedate'] = "Date de la dernière modification";
		$text['gedcom'] = "Fichier";
		$text['baptdate'] = "Date du baptême (SDJ)";
		$text['baptplace'] = "Lieu du baptême (SDJ)";
		$text['endldate'] = "Date de confirmation (SDJ)";
		$text['endlplace'] = "Lieu de confirmation (SDJ)";
		$text['ssealdate'] = "Date du sceau S (SDJ)";   //Sealed to spouse
		$text['ssealplace'] = "Lieu du sceau S (SDJ)";
		$text['psealdate'] = "Date du sceau (SDJ)";   //Sealed to parents
		$text['psealplace'] = "Lieu du Sceau P (SDJ)";
		$text['marrplace'] = "Lieu du mariage";
		$text['spousesurname'] = "Patronyme de l'époux/épouse";
		$text['spousemore'] = "Si le patronyme du ou de la conjoint/e est saisi, il faut aussi indiquer son genre";
		$text['plusminus5'] = "+/- 5 ans";
		$text['exists'] = "Déjà saisi";
		$text['dnexist'] = "Pas encore saisi";
		$text['divdate'] = "Date du divorce";
		$text['divplace'] = "Lieu du divorce";
		$text['otherevents'] = "Événements complémentaires ou Attributs personnels";
		$text['numresults'] = "Résultats par page";
		$text['mysphoto'] = "Sujets à identifier";
		$text['mysperson'] = "Qui sont ces gens?";
		$text['joinor'] = "L'option 'Lien avec OU' ne peut pas être employée avec le nom de famille du conjoint";
		$text['tellus'] = "Dites-nous ce que vous savez";
		$text['moreinfo'] = "Plus d'informations:";
		//added in 8.0.0
		$text['marrdatetr'] = "Année de mariage";
		$text['divdatetr'] = "Année de divorce";
		$text['mothername'] = "Nom de la mère";
		$text['fathername'] = "Nom du père";
		$text['filter'] = "filtrage";
		$text['notliving'] = "décédés";
		$text['nodayevents'] = "Événements de ce mois non associés à un jour spécifique";
		//added in 9.0.0
		$text['csv'] = "Fichier CSV délimité par des virgules";
		//added in 10.0.0
		$text['confdate'] = "Date de confirmation (SDJ)";
		$text['confplace'] = "Lieu de confirmation (SDJ)";
		$text['initdate'] = "Date d'initiation (SDJ)";
		$text['initplace'] = "Lieu d'initiation (SDJ)";
		//added in 11.0.0
		$text['marrtype'] = "Type de Mariage";
		$text['searchfor'] = "Chercher";
		$text['searchnote'] = "Note: cette recherche est effectuée par Google et le résultat se limite au nombre de renseignements qui ont pu être relevés dans ce fichier par le moteur de recherche Google.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "carnet de bord pour";
		$text['mostrecentactions'] = "dernières activités";
		$text['autorefresh'] = "Rafraîchissement automatique au 30 secondes";
		$text['refreshoff'] = "Désactiver le rafraîchissement automatique";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cimetières";
		$text['showallhsr'] = "Voir tous les monuments";
		$text['in'] = "en";
		$text['showmap'] = "Voir la carte";
		$text['headstonefor'] = "Tombe de";
		$text['photoof'] = "Photo de";
		$text['photoowner'] = "Dépositaire";
		$text['nocemetery'] = "Pas de cimetière";
		$text['iptc005'] = "Titre";
		$text['iptc020'] = "Catégories supplémentaires";
		$text['iptc040'] = "Instructions spéciales";
		$text['iptc055'] = "Date de création";
		$text['iptc080'] = "Auteur";
		$text['iptc085'] = "Position de l'auteur";
		$text['iptc090'] = "Ville";
		$text['iptc095'] = "État";
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
		$text['cemphotos'] = "Monuments du cimetière";
		$text['photosize'] = "Dimension";
        $text['iptc010'] = "Priorité";
		$text['filesize'] = "Volume";
		$text['seeloc'] = "Voir le lieu";
		$text['showall'] = "Retour à la liste";
		$text['editmedia'] = "Modifier ce média";
		$text['viewitem'] = "Voir ce média";
		$text['editcem'] = "Modifier ce cimetière";
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
		$text['nocemname'] = "Cimetière inconnu";
		$text['editalbum'] = "Modifier l'album";
		$text['mediamaptext'] = "<strong>Note:</strong> Déplacer le pointeur de la souris sur l'image pour voir les noms. Cliquer pour voir une page pour chaque nom.";
		//added in 8.0.0
		$text['allburials'] = "Liste des inhumations";
		$text['moreinfo'] = "Plus d'informations:";
		//added in 9.0.0
        $text['iptc025'] = "Mots-clefs";
        $text['iptc092'] = "Lieu mineur";
		$text['iptc015'] = "Catégorie";
		$text['iptc065'] = "Programme d'origine";
		$text['iptc070'] = "Version du programme";
		//added in 13.0
		$text['toggletags'] = "Inverser les étiquettes";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Voir tous les patronymes commençant par la lettre";
		$text['showtop'] = "Voir les";
		$text['showallsurnames'] = "Voir tous les patronymes";
		$text['sortedalpha'] = "par ordre alphabétique";
		$text['byoccurrence'] = "par occurrence";
		$text['firstchars'] = "Premiers cararactères";
		$text['mainsurnamepage'] = "Patronymes";
		$text['allsurnames'] = "Tous les patronymes";
		$text['showmatchingsurnames'] = "Cliquer sur un patronyme pour voir la fiche";
		$text['backtotop'] = "Retour en haut de la page";
		$text['beginswith'] = "Commençant par";
		$text['allbeginningwith'] = "Voir tous les patronymes qui commencent par la lettre";
		$text['numoccurrences'] = "Nombre d'occurences";
		$text['placesstarting'] = "Voir les régions qui commencent par la lettre";
		$text['showmatchingplaces'] = "Cliquer sur la loupe pour voir la carte et les fiches associées";
		$text['totalnames'] = "Nombre total entre parenthèse";
		$text['showallplaces'] = "Voir toutes les régions";
		$text['totalplaces'] = "Nombre de lieux";
		$text['mainplacepage'] = "Page des principales régions";
		$text['allplaces'] = "par régions";
		$text['placescont'] = "Voir les lieux qui contiennent";
		//changed in 8.0.0
		$text['top30'] = "Les xxx patronymes les plus nombreux";
		$text['top30places'] = "Les xxx principales régions";
		//added in 12.0.0
		$text['firstnamelist'] = "Liste des prénoms";
		$text['firstnamesstarting'] = "Voir tous les prénoms commençant par";
		$text['showallfirstnames'] = "Voir tous les prénoms";
		$text['mainfirstnamepage'] = "Page des principaux prénoms";
		$text['allfirstnames'] = "Tous les prénoms";
		$text['showmatchingfirstnames'] = "Cliquer sur un prénom pour voir les enregistrements correspondants.";
		$text['allfirstbegwith'] = "Tous les prénoms commençant par";
		$text['top30first'] = "Les xxx prénoms les plus nombreux";
		$text['allothers'] = "Autres moins nombreux";
		$text['amongall'] = "(par rapport aux autres)";
		$text['justtop'] = "Pourcentage entre les xxx premiers";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(xx derniers jours)";

		$text['photo'] = "Photo";
		$text['history'] = "Histoire/Document";
		$text['husbid'] = "No. Époux";
		$text['husbname'] = "Époux";
		$text['wifeid'] = "No. Épouse";
		//added in 11.0.0
		$text['wifename'] = "Épouse";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Supprimer";
		$text['addperson'] = "Ajouter un probant";
		$text['nobirth'] = "Ce probant n'a pas une date de naissance valide et n'a donc pas été ajouté";
		$text['event'] = "Événement(s)";
		$text['chartwidth'] = "Largeur du graphique";
		$text['timelineinstr'] = "Ajouter des probants (saisir leur No.)";
		$text['togglelines'] = "Commuter les lignes";
		//changed in 9.0.0
		$text['noliving'] = "Le probant suivant est enregistré comme étant en vie ou marqué privé et n'est pas affiché parce que vous n'êtes pas connecté avec les privilèges requis";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Tous les fichiers";
		$text['treename'] = "Nom du fichier";
		$text['owner'] = "Propriétaire";
		$text['address'] = "Adresse résidence *";
		$text['city'] = "Ville *";
		$text['state'] = "Zone / Région";
		$text['zip'] = "Code postal *";
		$text['country'] = "Pays";
		$text['email'] = "Saisir votre courriel";
		$text['phone'] = "Téléphone *";
		$text['username'] = "Saisir votre pseudonyme";
		$text['password'] = "Saisir votre mot de passe";
		$text['loginfailed'] = "Erreur de connexion.";

		$text['regnewacct'] = "Demande d'accès (remplir au complet)";
		$text['realname'] = "Votre véritable identité";
		$text['phone'] = "Téléphone *";
		$text['email'] = "Saisir votre courriel";
		$text['address'] = "Adresse résidence *";
		$text['acctcomments'] = "But de votre<br>demande d'accès";
		$text['submit'] = "Soumettre";
		$text['leaveblank'] = "(laisser vide pour un nouveau fichier)";
		$text['required'] = "Remplir au complet";
		$text['enterpassword'] = "Saisir un mot de passe.";
		$text['enterusername'] = "Saisir un pseudonyme.";
		$text['failure'] = "Ce pseudonyme est déjà utilisé. Il faut utiliser la flèche de retour de votre navigateur pour revenir à la page précédente et choisir un autre pseudonyme.";
		$text['success'] = "Merci. Nous avons bien reçu votre demande. Nous vous contacterons quand votre accès sera actif ou pour compléter votre demande.";
		$text['emailsubject'] = "Accès au fichier";
		$text['website'] = "Site Web (si applicable)";
		$text['nologin'] = "Vous n'avez pas d'accès ?";
		$text['loginsent'] = "Vos données de connexion ont été envoyées";
		$text['loginnotsent'] = "Vos données de connexion n'ont pas été envoyées";
		$text['enterrealname'] = "Il faut saisir votre vrai nom.";
		$text['rempass'] = "Maintenir la connexion à cet ordinateur";
		$text['morestats'] = "Statistiques additionnelles";
		$text['accmail'] = "<strong>NOTE:</strong> Pour recevoir une réponse au sujet de votre demande d'accès, assurez-vous que le gestionnaire de courrier de votre ordinateur ne bloque pas les messages en provenance de ce site ou ne les dépose pas dans vos indésirables.";
		$text['newpassword'] = "Nouveau mot de passe";
		$text['resetpass'] = "Changer le mot de passe";
		$text['nousers'] = "Ce formulaire ne peut être utilisé sans qu'il y ait au moins un accès enregistré. Si vous êtes propriétaire du site, allez dans l'écran Administration et cliquez sur Accèss pour enregistrer votre compte administrateur.";
		$text['noregs'] = "Désolé, aucun accès autorisé pour l'instant. Il faut <a href=\"suggest.php\">envoyer un courriel</a> directement pour les commentaires ou les questions relatives à ce site.";
		$text['emailmsg'] = "Vous avez reçu une nouvelle demande d'accès TNG. Il faut se rendre dans la section Administration de TNG pour valider cette demande et accorder au besoin les privilèges requis. Si cette demande d'accès est approuvée, il faudra en informer le demandeur en répondant à ce message.";
		$text['accactive'] = "La demande d'accès à été activée, mais aucun privilège spécifique n'a été établi sauf le statut de visiteur";
		$text['accinactive'] = "Aller à Administration/Accès/Valider pour accéder au paramétrage des comptes. Le compte reste inactif tant qu'il n'est pas vérifié et enregistré au moins une fois";
		$text['pwdagain'] = "Répéter votre mot de passe";
		$text['enterpassword2'] = "Saisir votre mot de passe";
		$text['pwdsmatch'] = "Les mots de passe ne correspondent pas. Il faut saisir deux fois le même mot de passe";
		$text['acksubject'] = "Il faut vous être enregistré"; //for a new user account
		$text['ackmessage'] = "Votre demande d'accès généalogiste à bien été reçue. Votre compte restera inactif en attendant une vérification par l'administrateur. Nous vous contacterons par courriel dès que votre compte sera activé.";
		//added in 12.0.0
		$text['switch'] = "Alterner";
		//added in 14.0
		$text['newpassword2'] = "Saisir de nouveau le mot de passe";
		$text['resetsuccess'] = "Succès: Mot de passe changé";
		$text['resetfail'] = "Échec: Mot de passe inchangé";
		$text['failreason0'] = " (Erreur inconnue de la base)";
		$text['failreason2'] = " (Aucune autorisation de changer votre mot de passe)";
		$text['failreason3'] = " (Aucune correspondance des mots de passe)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Naviguer dans toutes les lignées";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Nombre de saisies";
		$text['totindividuals'] = "Nombre de probants";
		$text['totmales'] = "De genre masculin";
		$text['totfemales'] = "De genre féminin";
		$text['totunknown'] = "De genre inconnu";
		$text['totliving'] = "De probants en vie";
		$text['totfamilies'] = "De familles";
		$text['totuniquesn'] = "De patronymes distincts";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Nombre de sources";
		$text['avglifespan'] = "Longévité moyenne";
		$text['earliestbirth'] = "Probant le plus ancien";
		$text['longestlived'] = "Longévité exceptionnelle";
		$text['days'] = "jours";
		$text['age'] = "Âge";
		$text['agedisclaimer'] = "La longévité est calculée à partir des dates connues de naissance et de décès.  À cause des dates parfois incomplètes comme un décès enregistré seulement avec l'année \"1860\" ou \"avant 1860\", ce calcul ne donne pas toujours des résultats précis.";
		$text['treedetail'] = "À propos de ce fichier";
		$text['total'] = "Nombre : ";
		//added in 12.0
		$text['totdeceased'] = "Probants décédés";
		//added in 14.0
		$text['totalsourcecitations'] = "Total des citations de source";
		break;

	case "notes":
		$text['browseallnotes'] = "Voir les notes";
		break;

	case "help":
		$text['menuhelp'] = "Aide";
		break;

	case "install":
		$text['perms'] = "Les CHMODS ont tous été définis.";
		$text['noperms'] = "Les CHMODS n'ont pas été définis pour ces dossiers:";
		$text['manual'] = "Il faut les définir manuellement.";
		$text['folder'] = "Le dossier";
		$text['created'] = "a été créé";
		$text['nocreate'] = "n'a pas été créé. Il faut créer manuellement.";
		$text['infosaved'] = "Information enregistrée, connexion vérifiée.";
		$text['tablescr'] = "Les tables ont été ajoutées.";
		$text['notables'] = "Les tables suivantes n'ont pas été ajoutées:";
		$text['nocomm'] = "TNG ne communique pas avec le serveur. Aucune table n'a été ajoutée.";
		$text['newdb'] = "Information enregistrée, connexion vérifiée, le nouveau fichier a été ajouté:";
		$text['noattach'] = "Information enregistrée. Connexion établie et base de données ajoutée, mais TNG ne peut pas s'y connecter.";
		$text['nodb'] = "Information enregistrée. Connexion établie, mais cette base de données n'existe pas sur le serveur et n'a pu être ajoutée ici. Vérifier que le nom de la base de données est correct, ou utiliser le panneau administration pour l'ajouter.";
		$text['noconn'] = "Information enregistrée mais la connexion n'a pas été établie. Un ou plusieurs des paramètres suivants sont incorrects:";
		$text['exists'] = "existe déjà.";
		$text['noop'] = "Aucune opération n'a été effectuée.";
		//added in 8.0.0
		$text['nouser'] = "L'accès généalogiste n'a pas été ajouté. Ce nom est déja utilisé";
		$text['notree'] = "Impossible d'ajouter une fiche. Ce numéro de probant est déja utilisé";
		$text['infosaved2'] = "Donneés enregistrées";
		$text['renamedto'] = "renommé en";
		$text['norename'] = "n'a pas pu être renommé";
		//changed in 13.0.0
		$text['loginfirst'] = "Des enregistrements d'utilisateurs existants ont été détectés. Pour continuer, il faut d'abord vous connecter ou supprimer tous les enregistrements dans la table des utilisateurs.";
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
		$text['testid'] = "No. du test";
		//added in 12.0.0
		$text['mode_values'] = "Valeurs des modes";
		$text['compareselected'] = "Comparer les tests choisis";
		$text['dnatestscompare'] = "Comparer les tests ADN-Y";
		$text['keep_name_private'] = "Garder le nom confidentiel";
		$text['browsealltests'] = "Parcourir tous les tests";
		$text['all_dna_tests'] = "Tous les tests ADN";
		$text['fastmutating'] = "Mutation rapide";
		$text['alltypes'] = "Tous les types";
		$text['allgroups'] = "Tous les groupes";
		$text['Ydna_LITbox_info'] = "Les tests ADN associés à ce probant n'ont pas nécessairement été passés par ce probant.<br/>La colonne 'Haplogroupe' affiche le résultat en rouge s'il s'agit d'une 'estimation' et en vert si le test est 'confirmé'";
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
		$text['comparemore'] = "Il faut choisir au moins deux tests pour établir une comparaison.";
		break;
}

//common
$text['matches'] = "Résultats";
$text['description'] = "Détails";
$text['notes'] = "Notes";
$text['status'] = "Statut";
$text['newsearch'] = "Nouvelle Recherche";
$text['pedigree'] = "Lignée";
$text['seephoto'] = "Voir l'image";
$text['andlocation'] = "et le lieu";
$text['accessedby'] = "consulté par";
$text['children'] = "Enfants";  //from getperson
$text['tree'] = "Fichier";
$text['alltrees'] = "Tous les fichiers";
$text['nosurname'] = "[sans prénom]";
$text['thumb'] = "Vignette";  //as in Thumbnail
$text['people'] = "population";
$text['title'] = "Titre";  //from getperson
$text['suffix'] = "Suffixe";  //from getperson
$text['nickname'] = "Alias";  //from getperson
$text['lastmodified'] = "Mise à jour";  //from getperson
$text['married'] = "Mariage";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nom"; //from showmap
$text['lastfirst'] = "Nom, Prénom";  //from search
$text['bornchr'] = "Naissance/Baptême";  //from search
$text['individuals'] = "Probants";  //from whats new
$text['families'] = "Familles";
$text['personid'] = "No. probant";
$text['sources'] = "Sources consultées";  //from getperson (next several)
$text['unknown'] = "Inconnu";
$text['father'] = "Père";
$text['mother'] = "Mère";
$text['christened'] = "Baptême";
$text['died'] = "Décès";
$text['buried'] = "Inhumation";
$text['spouse'] = "Conjoint/e";  //from search
$text['parents'] = "Parents";  //from pedigree
$text['text'] = "Texte";  //from sources
$text['language'] = "Langue";  //from languages
$text['descendchart'] = "Descendance";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Probant";
$text['edit'] = "Modifier";
$text['date'] = "Date";
$text['login'] = "Accès";
$text['logout'] = "Quitter";
$text['groupsheet'] = "Collectif";
$text['text_and'] = "et";
$text['generation'] = "Génération";
$text['filename'] = "Nom du média";
$text['id'] = "No.";
$text['search'] = "Chercher";
$text['user'] = "Généalogiste";
$text['firstname'] = "Prénom";
$text['lastname'] = "Nom";
$text['searchresults'] = "Occurences";
$text['diedburied'] = "Décès/Inhumation";
$text['homepage'] = "Accueil";
$text['find'] = "Chercher...";
$text['relationship'] = "Recherche de parenté";		//in German, Verwandtschaft
$text['relationship2'] = "Affinité"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Au fil du temps";
$text['yesabbr'] = "O";               //abbreviation for 'yes'
$text['divorced'] = "Divorce";
$text['indlinked'] = "En lien avec";
$text['branch'] = "Branche";
$text['moreind'] = "Plus de probants";
$text['morefam'] = "Plus de familles";
$text['surnamelist'] = "Liste des patronymes";
$text['generations'] = "Générations";
$text['refresh'] = "Actualiser";
$text['whatsnew'] = "Nouveautés";
$text['reports'] = "Répertoires en ligne";
$text['placelist'] = "Lieux et régions";
$text['baptizedlds'] = "Baptisé (SDJ)";
$text['endowedlds'] = "Doté (SDJ)";
$text['sealedplds'] = "Doté parents (SDJ)";
$text['sealedslds'] = "Conjoint/e doté(e) (SDJ)";
$text['ancestors'] = "Ascendance";
$text['descendants'] = "Descendance";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Date du dernier import GEDCOM";
$text['type'] = "Type";
$text['savechanges'] = "Enregistrer";
$text['familyid'] = "No. Famille";
$text['headstone'] = "Monuments";
$text['historiesdocs'] = "Anecdotes";
$text['anonymous'] = "Anonyme";
$text['places'] = "Lieux et régions";
$text['anniversaries'] = "Anniversaires du jour";
$text['administration'] = "Administration";
$text['help'] = "Aide";
//$text['documents'] = "Documents";
$text['year'] = "Année";
$text['all'] = "Voir tous les renseignements";
$text['address'] = "Adresse civique *";
$text['suggest'] = "AJOUTEZ VOS COMMENTAIRES";
$text['editevent'] = "Proposer une modification";
$text['morelinks'] = "Plus de liens";
$text['faminfo'] = "Renseignements sur la famille";
$text['persinfo'] = "Renseignements sur ce probant";
$text['srcinfo'] = "Infos sur la source";
$text['fact'] = "Événement";
$text['goto'] = "Choisir une page";
$text['tngprint'] = "Imprimer";
$text['databasestatistics'] = "Statistiques"; //needed to be shorter to fit on menu
$text['child'] = "Enfant";  //from familygroup
$text['repoinfo'] = "Infos sur le dépositaire";
$text['tng_reset'] = "Vider";
$text['noresults'] = "Aucune occurence";
$text['allmedia'] = "Liste des médias";
$text['repositories'] = "Liste des dépositaires";
$text['albums'] = "Albums";
$text['cemeteries'] = "Cimetières";
$text['surnames'] = "Un patronyme";
$text['dates'] = "Dates";
$text['link'] = "Lien";
$text['media'] = "Médias";
$text['gender'] = "Genre";
$text['latitude'] = "Latitude";
$text['longitude'] = "Longitude";
$text['bookmarks'] = "Signets";
$text['bookmark'] = "Ajouter un signet";
$text['mngbookmarks'] = "Voir les signets";
$text['bookmarked'] = "Signet ajouté";
$text['remove'] = "Retirer";
$text['find_menu'] = "Chercher";
$text['info'] = "Sommaire"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cimetière";
$text['gmapevent'] = "Carte des événements";
$text['gevents'] = "Événements";
$text['googleearthlink'] = "Lien Google Earth";
$text['googlemaplink'] = "Lien Google Map";
$text['gmaplegend'] = "Légende";
$text['unmarked'] = "non marquée(s)";
$text['located'] = "Située(s)";
$text['albclicksee'] = "Cliquer pour voir tous les items dans cet album";
$text['notyetlocated'] = "Pas encore trouvé";
$text['cremated'] = "Crémation";
$text['missing'] = "Manquant";
$text['pdfgen'] = "Générateur PDF";
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
$text['lmargin'] = "Marge gauche";
$text['rmargin'] = "Marge droite";
$text['createch'] = "Préparation";
$text['prefix'] = "Préfixe";
$text['mostwanted'] = "Besoin d'aide";
$text['latupdates'] = "Dernière mise à jour";
$text['featphoto'] = "Les souvenirs de famille";
$text['news'] = "Nouvelles";
$text['ourhist'] = "Histoire de notre famille";
$text['ourhistanc'] = "Histoire et généalogie de notre famille";
$text['ourpages'] = "Page de la généalogie de notre famille";
$text['pwrdby'] = "Publication généalogique réalisée avec";
$text['writby'] = "une création de";
$text['searchtngnet'] = "Recherche sur le réseau TNG (Fonction obsolete et désactivée";
$text['viewphotos'] = "Voir toutes les photos";
$text['anon'] = "Visiteur anonyme en ligne";
$text['whichbranch'] = "Cherchez votre nom de famille:";
$text['featarts'] = "Articles de choix";
$text['maintby'] = "Droits réservés © Les éditions";
$text['createdon'] = "Ajouté le";
$text['reliability'] = "Type: 1=Probable | 2=Copie déposée | 3=Acte original déposé | Type ";
$text['labels'] = "Étiquettes";
$text['inclsrcs'] = "Inclure les sources";
$text['cont'] = "suite..."; //abbreviation for continued
$text['mnuheader'] = "Accueil";
$text['mnusearchfornames'] = "Chercher";
$text['mnulastname'] = "Patronyme";
$text['mnufirstname'] = "Prénom";
$text['mnusearch'] = "Chercher";
$text['mnureset'] = "Reprendre";
$text['mnulogon'] = "Accès";
$text['mnulogout'] = "Quitter";
$text['mnufeatures'] = "Sommaire";
$text['mnuregister'] = "Demande d'accès";
$text['mnuadvancedsearch'] = "Recherche détaillée";
$text['mnulastnames'] = "Patronymes";
$text['mnustatistics'] = "Statistiques";
$text['mnuphotos'] = "Photos";
$text['mnuhistories'] = "Histoire";
$text['mnumyancestors'] = "Photos et histoire des ascendants";
$text['mnucemeteries'] = "Cimetières";
$text['mnutombstones'] = "Monuments";
$text['mnureports'] = "Répertoires en ligne";
$text['mnusources'] = "Sources consultées";
$text['mnuwhatsnew'] = "Nouveautés";
$text['mnushowlog'] = "Historique de navigation";
$text['mnulanguage'] = "Langue d'affichage";
$text['mnuadmin'] = "Administration";
$text['welcome'] = "Bienvenue";
$text['contactus'] = "Messagerie";
//changed in 8.0.0
$text['born'] = "Naissance";
$text['searchnames'] = "Un probant";
//added in 8.0.0
$text['editperson'] = "Modifier une fiche";
$text['loadmap'] = "Charger la carte";
$text['birth'] = "Naissance";
$text['wasborn'] = "Naissance le";
$text['startnum'] = "Premier numéro";
$text['searching'] = "Recherche en cours";
//moved here in 8.0.0
$text['location'] = "Lieu";
$text['association'] = "Alliance";
$text['collapse'] = "Réduire";
$text['expand'] = "Étendre";
$text['plot'] = "Lotissement";
$text['searchfams'] = "Chercher une famille";
//added in 8.0.2
$text['wasmarried'] = "Mariage";
$text['anddied'] = "Décès";
//added in 9.0.0
$text['share'] = "Partager";
$text['hide'] = "Masquer";
$text['disabled'] = "Votre accès est refusé. Vous devez contacter le gestionnaire du serveur pour plus d'information.";
$text['contactus_long'] = "Pour les questions, commentaires ou suggestions sur cette activité généalogique, il faut cliquer sur  <span class=\"emphasis\"><a href=\"suggest.php\">\"CONTACT\"</a></span> pour nous écrire. Il nous fera plaisir de vous répondre.";
$text['features'] = "Articles";
$text['resources'] = "Ressources";
$text['latestnews'] = "Dernières Nouvelles";
$text['trees'] = "Liste des fichiers";
$text['wasburied'] = "Inhumation";
//moved here in 9.0.0
$text['emailagain'] = "Saisir votre courriel une 2e fois";
$text['enteremail2'] = "Saisir votre courriel";
$text['emailsmatch'] = "Les deux courriels ne sont pas identiques. Il faut saisir deux fois le même courriel.";
$text['getdirections'] = "Cliquer ici pour obtenir le trajet";
$text['calendar'] = "Calendrier du mois";
//changed in 9.0.0
$text['directionsto'] = " au";
$text['slidestart'] = "Diaporama";
$text['livingnote'] = "Le contenu de cette fiche concerne une personne vivante - Les renseignements personnels doivent rester confidentiels.";
$text['livingphoto'] = "Le contenu de cette image concerne au moins une personne encore vivante - Les détails doivent rester confidentiels.";
$text['waschristened'] = "Baptême";
//added in 10.0.0
$text['branches'] = "Lignées";
$text['detail'] = "Détails";
$text['moredetail'] = "Plus de détails";
$text['lessdetail'] = "Moins de détails";
$text['conflds'] = "Confirmation (SDJ)";
$text['initlds'] = "Initiation (SDJ)";
$text['wascremated'] = "Crémation";
//moved here in 11.0.0
$text['text_for'] = "pour";
//added in 11.0.0
$text['searchsite'] = "Chercher dans ce fichier";
$text['searchsitemenu'] = "Chercher sur le réseau Internet";
$text['kmlfile'] = "Télécharger un fichier .kml pour voir ce lieu avec Google Earth";
$text['download'] = "Cliquer ici pour télécharger";
$text['more'] = "En savoir plus";
$text['heatmap'] = "Carte de répartition";
$text['refreshmap'] = "Actualiser la carte";
$text['remnums'] = "Masquer les numéros et les pointeurs";
$text['photoshistories'] = "Photos et récits";
$text['familychart'] = "Tableau familial";
//added in 12.0.0
$text['firstnames'] = "Un prénom";
//moved here in 12.0.0
$text['dna_test'] = "Test ADN";
$text['test_type'] = "Type de test";
$text['test_info'] = "Information sur le test";
$text['takenby'] = "Prélevé par";
$text['haplogroup'] = "Haplogroupe";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Connexions pertinentes";
$text['nofirstname'] = "[pas de prénom]";
//added in 12.0.1
$text['cookieuse'] = "Nous utilisons des mouchards.<br>Vous acceptez notre politique de confidentialité pour consulter les pages de généalogie de ce site.";
$text['dataprotect'] = "Politique de confidentialité";
$text['viewpolicy'] = "Politique de confidentialité";
$text['understand'] = "Lu et compris !";
$text['consent'] = "Je consens à ce que ce site enregistre ma navigation dans ses pages. Je peux demander en tout temps au webmaître de supprimer cette information.";
$text['consentreq'] = "Merci de nous faire confiance pour la protection de vos renseignements.";

//added in 12.1.0
$text['testsarelinked'] = "tests ADN reliés à";
$text['testislinked'] = "test ADN relié à";

//added in 12.2
$text['quicklinks'] = "Liens rapides";
$text['yourname'] = "Votre nom";
$text['youremail'] = "Votre courriel";
$text['liketoadd'] = "Les informations que vous souhaitez ajouter";
$text['webmastermsg'] = "Message du webmaître";
$text['gallery'] = "Uniquement les vignettes";
$text['wasborn_male'] = "est né";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "est née"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "a été baptisé";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "a été baptisée";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "est décédé";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "est décédée";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "a été inhumé"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "a été inhumée"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "a été incinéré";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "a été incinérée";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "s'est marié à ";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "s'est mariée à ";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "s'est divorcé de ";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "s'est divorcée de ";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " à ";			// used as a preposition to the location
$text['onthisdate'] = " le ";		// when used with full date
$text['inthisyear'] = " en ";		// when used with year only or month / year dates
$text['and'] = " et ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Info test ADN";
//added in 13.0
$text['visitor'] = "Visiteur";

$text['popupnote2'] = " = Nouveau fichier";

//moved here in 14.0
$text['zoomin'] = "Augmenter le Zoom";
$text['zoomout'] = "Diminuer le Zoom";
$text['scrollnote'] = "Étendre ou faire défiler pour plus de détails.";
$text['general'] = "Notes générales";

//changed in 14.0
$text['otherevents'] = "Événements complémentaires ou Attributs personnels";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Connections";
$text['continue'] = "Continuer";
$text['title2'] = "Titre"; //pour media, sources, etc (pas pour probants)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>