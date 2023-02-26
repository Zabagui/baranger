<?php
include("../../helplib.php");
echo help_header("Nápovìda: Spojení");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="repositories_help.php" class="lightlink">&laquo; Nápovìda: Úlo¾i¹tì pramenù</a> &nbsp; | &nbsp;
			<a href="notes_help.php" class="lightlink">Nápovìda: Poznámky &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Spojení</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co to je?</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat/Upravit/Odstranit</a>
		</p>
	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  
		<a name="what"><p class="subheadbold">Co jsou spojení?</p></a>

		<p><strong>Spojení</strong> je záznam vztahu mezi dvìma osobami, mezi dvìma rodinami nebo mezi osobou a rodinou.
		Ze stromové struktury va¹í databáze nemusí být vztah zøejmý. Ve skuteènosti dvì osoby/rodiny, které jsou propojeny 
    pomocí spojení, nemusí být vùbec pøíbuzné.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Pøidání/Úprava/Odstranìní spojení</p></a>

		<p>Chcete-li pøidat, upravit nebo odstranit spojení u osoby, vyhledejte osobu v Administrace/Osoba a upravte
		individuální záznam, a poté kliknìte na ikonu Spojení v horní èásti obrazovky (pokud spojení ji¾ existují,
		na ikonì je zelená teèka). Po kliknutí na ikonu se objeví malé okno, kde jsou zobrazena v¹echna existující spojení
		pro aktivní osobu. Chcete-li pracovat se spojeními u rodin, vyhledejte rodinu v Administrace/Rodiny
		a upravte záznam rodiny, poté proveïte toté¾ jako v pøípadì osoby.</p>

		<p>Chcete-li pøidat nové spojení, kliknìte na tlaèítko "Pøidat nové" a vyplòte formuláø. Pokud vybraná osoba nebo rodina nemají ¾ádné spojení,
		dostanete se pøímo na obrazovku "Pøidat nové spojení". Na této obrazovce budete moci oznaèit, 
		zda spojovaná entita je osoba nebo rodina.</p>

		<p>Chcete-li upravit nebo odstranit existující spojení, kliknìte na pøíslu¹nou ikonu vedle tohoto spojení.</p>

		<p>Pøi pøidání nebo úpravì spojení mìjte na pamìti následující:</p>

		<span class="optionhead">ID èísla osoby nebo rodiny</span>
		<p>Zapi¹te ID èíslo osoby nebo rodiny, která má být spojena s aktivní osobou nebo rodinou, nebo kliknìte na ikonu Najít a vyhledejte ID èíslo.</p>

		<span class="optionhead">Vztah</span>
		<p>Zapi¹te povahu spojení. Napø. <em>Kmotr</em>, <em>Uèitel</em> nebo <em>Svìdek</em>.</p>

		<span class="optionhead">Obrácené spojení?</span>
		<p>Nìkdy jde spojení obìma smìry. Napø. vztah <em>Pøítel</em> mù¾e mít pùsobnost obìma smìry. Je-li to pravda,
		a chcete vytvoøit druhé spojení jdoucí opaèným smìrem, pak kliknìte na tuto volbu. Pokud povaha vztahu není taková, ¾e by
		platila i v opaèném smìru (napø. <em>Kmotr</em> nebo <em>Uèitel</em>), pak byste mìli vytvoøit jiné spojení, zaèínající
		od druhé osoby nebo rodiny, která zobrazí opaèný vztah.</p>

		<p>Po ukonèení pøidání, úpravy nebo odstranìní spojení u dané osoby nebo rodiny kliknìte na tlaèítko "Ukonèit" a okno se uzavøe.</p>

	</td>
</tr>

</table>
</body>
</html>
