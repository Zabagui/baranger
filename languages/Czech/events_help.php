<?php
include("../../helplib.php");
echo help_header("Nápovìda: Události");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="citations_help.php" class="lightlink">&laquo; Nápovìda: Citace</a> &nbsp; | &nbsp;
			<a href="more_help.php" class="lightlink">Nápovìda: Více &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Události</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Standardní a vlastní</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nové</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#del" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#citations" class="lightlink">Citace</a>
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

		<a name="what"><p class="subheadbold">Standardní a vlastní události</p></a>
		<p>Události obvyklé jako je narození, úmrtí, sòatek a nìkteré dal¹í se vkládají na hlavní stránce osoby, rodiny, pramenu a úlo¾i¹tì pramenù
		a jsou ulo¾eny do odpovídajících tabulek v databázi. Dokumentace TNG na tyto události odkazuje jako na "standardní" události. V¹echny ostatní události jsou nazývány "vlastní" události
		a jsou spravovány v sekci <strong>Dal¹í události</strong> na stránkách osoby, rodiny, pramenu a úlo¾i¹tì pramenù. Tyto události se ukládají do zvlá¹tní
		tabulky Události (Events). Toto téma nápovìdy se vìnuje tìmto <em>vlastním</em> událostem.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Pøidat událost</p></a>

		<p>Chcete-li pøidat novou událost, kliknìte na tlaèítko "Pøidat nové" v sekci Dal¹í události a vyplòte formuláø. Pokud události ji¾ existují,
		budou zobrazeny v sekci Dal¹í události v tabulce. V dal¹í èásti jsou vysvìtlena dostupná pole.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="edit"><p class="subheadbold">Upravit událost</p></a>

		<p>Pokud chcete upravit existující událost, kliknìte v sekci Dal¹í události na ikonu Upravit vedle této události (pro úpravu údajù "standardních" událostí
		jako je narození nebo úmrtí zmìòte jednodu¹e text).</p>

		<p>Pøi pøidání nebo úpravì události si v¹imnìte následujícího:</p>

		<span class="optionhead">Typ události</span>
		<p>Vyberte typ události (u existující události nelze zmìnit typ události). Není-li typ události, který chcete, ve výbìrovém poli typù událostí,
		jdìte nejprve do Admin/Vlastní typy událostí a nastavte zde typ události, pak se vra»te na tuto obrazovku a vyberte jej.</p>

        <span class="optionhead">Datum události</span>
		<p>Aktuální nebo pøedpokládané datum spojené s událostí.</p>

        <span class="optionhead">Místo události</span>
		<p>Místo, kde událost probìhla. Zapi¹te název místa nebo kliknìte na ikonu Najít (lupa).</p>

        <span class="optionhead">Podrobnosti</span>
		<p>Dal¹í podrobnosti popisující událost. Pokud s událostí není spojeno ¾ádné datum ani místo, mù¾e pole Podrobnosti obsahovat údaje, které tuto událost definují.</p>

        <span class="optionhead">Duplikovat pro (ID):</span>
		<p>Chcete-li tuto událost duplikovat pro více osob nebo rodin, zapi¹te sem èísla ID tìchto osob nebo rodin. Vkládáte-li více èísel ID, oddìlte je èárkou. 
      Pokud èíslo ID neznáte, kliknìte na ikonu "Najít" vpravo od tohoto pole a mù¾ete je vyhledat podle jména. Po kliknutí na tlaèítko "Ulo¾it" bude tato událost nakopírována 
      tìmto osobám (rodinám). Pokud znovu otevøete okno s úpravou událolsti, toto pole bude prázdné. V¹echny zmìny, které od tohoto okam¾iku v této události 
      provedete, <b>nebudou</b> promítnuty do døíve vytvoøených duplikátù.</p>

        <span class="optionhead">Více</span><br />
		<p>Kliknutím na "Více" mù¾ete pro ka¾dou událost zapsat nìkteré ménì bì¾né údaje. Objeví se dal¹í pole.
		Tato pole lze skrýt opìtovným kliknutím na "Více". Skrytí polí neznamená vymazání jejich obsahu. Tato pole obsahují:</p>

        <p><span class="optionhead">Vìk</span>: Vìk osoby v dobì události.</p>

        <p><span class="optionhead">Instituce</span>: Instituce nebo osoba, která mìla v dobì události autoritu nebo odpovìdnost.</p>

        <p><span class="optionhead">Pøíèina</span>: Pøíèina události (nejèastìji pou¾ita s událostí Úmrtí).</p>

        <p><span class="optionhead">Adresa 1/Adresa 2/Mìsto/Kraj/provincie/PSÈ/Zemì/Telefon/Email/Internetové stránky</span>: Adresa a ostatní kontaktní údaje spojené s událostí.</p>

        <span class="optionhead">Povinná pole:</span>
		<p>Vybrat musíte typ události a nejménì do jednoho z následujících polí musíte nìco vlo¾it: <strong>Datum události</strong>, <strong>Místo události</strong>,
		nebo <strong>Podrobnosti</strong>. V¹echna ostatní pole jsou nepovinná.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="del"><p class="subheadbold">Vymazat událost</p></a>

		<p>Chcete-li vymazat existující událost, kliknìte v sekci Dal¹í události na ikonu Vymazat vedle této události. Událost bude vymazána bez ohledu na to, zda ostatní údaje na stránce jsou ulo¾eny.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="citations"><p class="subheadbold">Poznámky a citace</p>
		Chcete-li pøidat nebo upravit poznámky nebo citace u události, událost nejdøíve ulo¾te, a poté kliknìte na pøíslu¹nou ikonu vedle záznamu této události v aktuálním seznamu událostí.
		Více informací o poznámkách naleznete zde: <a href="notes_help.php">Nápovìda: Poznámky</a>. 
		Více informací o citacích naleznete zde: <a href="citations_help.php">Nápovìda: Citace</a>.</p>

	</td>
</tr>

</table>
</body>
</html>
