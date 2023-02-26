<?php
include("../../helplib.php");
echo help_header("Nápovìda: Nastavení");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="second_help.php" class="lightlink">&laquo; Nápovìda: Nástroje po importu</a> &nbsp; | &nbsp;
			<a href="config_help.php" class="lightlink">Nápovìda: Základní nastavení &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Nastavení</span>
		<p class="smaller menu">
			<a href="#config" class="lightlink">Konfigurace</a> &nbsp; | &nbsp;
			<a href="#diag" class="lightlink">Diagnostika</a> &nbsp; | &nbsp;
			<a href="#tables" class="lightlink">Vytvoøení tabulek</a>
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

		<a name="config"><p class="subheadbold">Konfigurace</p></a>
		<p>Tato stránka je pøístupovým místem pro nastavení rùzných oblastí TNG. Úprava nastavení v ka¾dé oblasti se odrazí na vzhledu va¹ich webových stránek, na
		databázi MySQL a dal¹ích mo¾nostech. Zmìna dal¹ích nastavení ovlivní zobrazení rùzných stránek.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="diag"><p class="subheadbold">Diagnostika</p></a>

		<span class="optionhead">Spustit diagnostiku</span>
		<p>Tato stránka zobrazí informace o nastavení va¹eho webového serveru, vèetnì varování týkajícího se nastavení, která mohou ovlivnit bìh TNG.</p>

		<span class="optionhead">Informace o PHP</span>
	  <p>Tato stránka zobrazí informace o instalaci PHP. Zobrazení tìchto informací je funkcí PHP, nikoli TNG. Stránka je rozdìlena do blokù,
    které popisují jednotlivé oblasti konfigurace. Pokud se nejste schopni pøipojit k databázi MySQL, podívejte se na tuto stránku a vyhledejte odstavec "mysql".
		Pokud jej nevidíte, znamená to, ¾e PHP je¹tì nekomunikuje s MySQL. Problém by mìl být v nastavení PHP, ne TNG.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="diag"><p class="subheadbold">Vytvoøení tabulek</p></a>

		<span class="optionhead">Vytvoøit tabulky</span>
		<p>Na toto tlaèítko kliknìte <strong>POUZE</strong>, kdy¾ va¹i stránku nastavujete poprvé, proto¾e zde budou vytvoøeny databázové tabulky potøebné
		k ulo¾ení va¹ich údajù. <strong>Pozn.: Pokud tabulky ji¾ existují, v¹echna data budou ztracena!</strong> Tuto operaci mù¾ete provést,
		pokud byla va¹e data po¹kozena a mají být po novém vytvoøení tabulek obnovena ze zálohy.</p>

    <span class="optionhead">Porovnávání</span>
		<p>Pokud pou¾íváte znakovou sadu UTF-8, mù¾ete do tohoto pole pøed vytvoøením tabulek zadat utf8_unicode_ci, utf8_general_ci nebo utf8_czech_ci.
    V ostatních pøípadech, ponecháte-li toto pole prázdné, pøijmete výchozí porovnávání.</p>
	</td>
</tr>

</table>
</body>
</html>
