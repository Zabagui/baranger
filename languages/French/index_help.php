<?php
include("../../helplib.php");
echo help_header("Aide : Mise en route");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="backuprestore_help.php" class="lightlink">&laquo; Aide : Utilités</a> &nbsp; | &nbsp;
			<a href="people_help.php" class="lightlink">Aide : Personnes &raquo;</a>
		</p>
		<span class="largeheader">Aide : Mise en route</span>
		<p class="smaller menu">
			<a href="#gettingstarted" class="lightlink">Mise en route</a> &nbsp; | &nbsp;
			<a href="#notes" class="lightlink">Notes</a> &nbsp; | &nbsp;
			<a href="#otherresources" class="lightlink">Autres ressources</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<a name="gettingstarted"><p class="subheadbold">Mise en route:</p></a>
		<p>Directives de base pour débutants :</p>
		<ol>
				<li><p><strong>Lire attentivement les directives dans le fichier <a href="../readme.html" target="_blank">readme.html</a> file.</strong> Toutes les configurations essentielles peuvent
					être gérées directement depuis cette page, mais vous pouvez aussi le faire à partir de <strong>Configurations</strong> ici même dans le menu Administration</p></li>
				<li><p><strong>Créer au moins un arbre.</strong> À moins d'avoir plus d'un fichier GEDCOM indépendant, vous n'avez probablement besoin que d'un arbre.</p></li>
				<li><p><strong>Créer au moins un utilisateur.</strong> Et le premier à créer est un Administrateur, qui doit avoir tous les droits et ne PAS être associé à aucun arbre.</p></li>
				<li><p><strong>Importer vos données ou les saisir une à une</strong>. Si c'est ce que vous optez de faire, vous pouvez débuter n'importe où dans votre lignée,
					soit par une personne liée ensuite à une famille, soit par une famille et construire sa lignée.</p></li>
				<li><p><strong>Consulter les processus secondaires</strong> (sous Import/Export) et exécuter les actions nécessaires (voir l'Aide
					pour plus d'information).</p></li>
				<li><p><strong>Média.</strong> Une fois vos données saisies ou importées, vous pouvez leur lier des photos, des histoires et autres média. Faites-vous plaisir !</p></li>
				<li><p><strong>Et tout le reste.</strong> Les autres sections du menu Administratiuon sont là pour vous suggérer des actions à poser, et l'Aide est à votre portée à chaque page.</p></li>
		</ol>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="notes"><p class="subheadbold">Notes:</p></a>
		<ol>
				<li><p>Si vous remarquez que certaines options sont absentes du menu Administration, c'est peut-être parce que vous n'êtes pas connecté avec tous les droits, ou que vous êtes associé à un arbre en particulier.
				Pour apporter des changements aux droits d'un utilisateur, déconnectez-vous et reconnectez-vous comme Administrateurr, ou encore éditez vos données directement en utilisant phpMyAdmin ou un outil similaire.</p></li>
				<li><p>Le lien vers la Page d'accueil public en haut de l'écran vous permet d'ouvrir votre page et d'afficher l'adresse de votre site. De même, le lien à gauche en bas de l'écran vers l'Accueil public vous permet de naviguer dans votre site et de revenir à l'écran Admin. en cliquant sur le lien approprié dans la liste des fonctions diverses.</p></li>
		</ol>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="otherresources"><p class="subheadbold">Autres ressources:</p></a>
		<ol>
			<li><p>Liste des mises à jour : <a href="mailto:tngusers@lythgoes.net">tngusers@lythgoes.net</a>. Pour y souscrire, envoyer un message à
				<a href="mailto:tngusers-subscribe@lythgoes.net">tngusers-subscribe@lythgoes.net</a>. Cette liste ne sert qu'à informer les utilisateurs des mises à jour disponibles et d'autres informations. </p></li>
			<li><p>Liste des adresses courriel des utilisateurs : <a href="mailto:tngusers2@lythgoes.net">tngusers2@lythgoes.net</a>. Pour y souscrire, envoyer un message à
				  <a href="mailto:tngusers2-subscribe@lythgoes.net">tngusers2-subscribe@lythgoes.net</a>. Cette liste peut être utilisée comme lieu de discussion entre utilisateurs de TNG. </p></li>
			<li><p>Forum des utilisateurs : <a href="https://tng.community" target="_blank">https://tng.community</a>.</p></li>
			<li><p>Référence PHP : <a href="https://php.net" target="_blank">https://php.net</a>.</p></li>
			<li><p>RéférenceMySQL : <a href="https://mysql.com" target="_blank">https://mysql.com</a>.</p></li>
			<li><p>Référence HTML: <a href="https://htmlhelp.com" target="_blank">https://htmlhelp.com</a>.</p></li>
			<li><p>Pour contacter le créateur de TNG : <a href="mailto:darrin@lythgoes.net">darrin@lythgoes.net</a>.</p></li>
			</ol>
	</td>
</tr>

</table>
</body>
</html>
