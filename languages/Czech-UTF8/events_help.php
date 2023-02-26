<?php
include("../../helplib.php");
echo help_header("Nápověda: Události");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="citations_help.php" class="lightlink">&laquo; Nápověda: Citace</a> &nbsp; | &nbsp;
			<a href="more_help.php" class="lightlink">Nápověda: Více &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Události</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Standardní a vlastní</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nové</a> &nbsp; | &nbsp;
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
		<p>Události obvyklé jako je narození, úmrtí, sňatek a některé další se vkládají na hlavní stránce osoby, rodiny, pramenu a úložiště pramenů
		a jsou uloženy do odpovídajících tabulek v databázi. Dokumentace TNG na tyto události odkazuje jako na "standardní" události. Všechny ostatní události jsou nazývány "vlastní" události
		a jsou spravovány v sekci <strong>Další události</strong> na stránkách osoby, rodiny, pramenu a úložiště pramenů. Tyto události se ukládají do zvláštní
		tabulky Události (Events). Toto téma nápovědy se věnuje těmto <em>vlastním</em> událostem.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Přidat událost</p></a>

		<p>Chcete-li přidat novou událost, klikněte na tlačítko "Přidat nové" v sekci Další události a vyplňte formulář. Pokud události již existují,
		budou zobrazeny v sekci Další události v tabulce. V další části jsou vysvětlena dostupná pole.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="edit"><p class="subheadbold">Upravit událost</p></a>

		<p>Pokud chcete upravit existující událost, klikněte v sekci Další události na ikonu Upravit vedle této události (pro úpravu údajů "standardních" událostí
		jako je narození nebo úmrtí změňte jednoduše text).</p>

		<p>Při přidání nebo úpravě události si všimněte následujícího:</p>

		<span class="optionhead">Typ události</span>
		<p>Vyberte typ události (u existující události nelze změnit typ události). Není-li typ události, který chcete, ve výběrovém poli typů událostí,
		jděte nejprve do Admin/Vlastní typy událostí a nastavte zde typ události, pak se vraťte na tuto obrazovku a vyberte jej.</p>

        <span class="optionhead">Datum události</span>
		<p>Aktuální nebo předpokládané datum spojené s událostí.</p>

        <span class="optionhead">Místo události</span>
		<p>Místo, kde událost proběhla. Zapište název místa nebo klikněte na ikonu Najít (lupa).</p>

        <span class="optionhead">Podrobnosti</span>
		<p>Další podrobnosti popisující událost. Pokud s událostí není spojeno žádné datum ani místo, může pole Podrobnosti obsahovat údaje, které tuto událost definují.</p>

        <span class="optionhead">Duplikovat pro (ID):</span>
		<p>Chcete-li tuto událost duplikovat pro více osob nebo rodin, zapište sem čísla ID těchto osob nebo rodin. Vkládáte-li více čísel ID, oddělte je čárkou. 
      Pokud číslo ID neznáte, klikněte na ikonu "Najít" vpravo od tohoto pole a můžete je vyhledat podle jména. Po kliknutí na tlačítko "Uložit" bude tato událost nakopírována 
      těmto osobám (rodinám). Pokud znovu otevřete okno s úpravou událolsti, toto pole bude prázdné. Všechny změny, které od tohoto okamžiku v této události 
      provedete, <b>nebudou</b> promítnuty do dříve vytvořených duplikátů.</p>

        <span class="optionhead">Více</span><br />
		<p>Kliknutím na "Více" můžete pro každou událost zapsat některé méně běžné údaje. Objeví se další pole.
		Tato pole lze skrýt opětovným kliknutím na "Více". Skrytí polí neznamená vymazání jejich obsahu. Tato pole obsahují:</p>

        <p><span class="optionhead">Věk</span>: Věk osoby v době události.</p>

        <p><span class="optionhead">Instituce</span>: Instituce nebo osoba, která měla v době události autoritu nebo odpovědnost.</p>

        <p><span class="optionhead">Příčina</span>: Příčina události (nejčastěji použita s událostí Úmrtí).</p>

        <p><span class="optionhead">Adresa 1/Adresa 2/Město/Kraj/provincie/PSČ/Země/Telefon/Email/Internetové stránky</span>: Adresa a ostatní kontaktní údaje spojené s událostí.</p>

        <span class="optionhead">Povinná pole:</span>
		<p>Vybrat musíte typ události a nejméně do jednoho z následujících polí musíte něco vložit: <strong>Datum události</strong>, <strong>Místo události</strong>,
		nebo <strong>Podrobnosti</strong>. Všechna ostatní pole jsou nepovinná.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="del"><p class="subheadbold">Vymazat událost</p></a>

		<p>Chcete-li vymazat existující událost, klikněte v sekci Další události na ikonu Vymazat vedle této události. Událost bude vymazána bez ohledu na to, zda ostatní údaje na stránce jsou uloženy.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="citations"><p class="subheadbold">Poznámky a citace</p>
		Chcete-li přidat nebo upravit poznámky nebo citace u události, událost nejdříve uložte, a poté klikněte na příslušnou ikonu vedle záznamu této události v aktuálním seznamu událostí.
		Více informací o poznámkách naleznete zde: <a href="notes_help.php">Nápověda: Poznámky</a>. 
		Více informací o citacích naleznete zde: <a href="citations_help.php">Nápověda: Citace</a>.</p>

	</td>
</tr>

</table>
</body>
</html>
