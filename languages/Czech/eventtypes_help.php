<?php
include("../../helplib.php");
echo help_header("Nápovìda: Typy událostí / atributù");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="branches_help.php" class="lightlink">&laquo; Nápovìda: Vìtve</a> &nbsp; | &nbsp;
			<a href="reports_help.php" class="lightlink">Nápovìda: Reporty &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Typy událostí / atributù</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nebo upravit</a> &nbsp; | &nbsp;
			<a href="#accept" class="lightlink">Pøijmout nebo odmítnout</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a>
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

		<a name="search"><p class="subheadbold">Hledat</p></a>
    <p>Nalezení existujících typù událostí a atributù vyhledáním celého nebo èásti <strong>Tagu, Typu/popisu (pro události EVEN)</strong> nebo <strong>Zobrazit</strong>.
    Pro zú¾ení va¹eho hledání vyberte <strong>Spojeno s</strong> nebo zvolte jednu z dal¹ích mo¾ností.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech typù událostí a atributù ve va¹í databázi. Mo¾nosti výbìru jsou následující:</p>

		<p><span class="optionhead">Spojeno s</span><br />
		Pro omezení výbìru zvolte z tohoto rozbalovacího seznamu typy událostí a atributù spojené s osobami, rodinami, prameny nebo úlo¾i¹ti pramenù.</p>

		<p><span class="optionhead">Pøijmout/Odmítnout/V¹e</span><br />
		Výbìrem jedné z tìchto voleb omezíte výbìr typù událostí a atributù na ty, které jsou <strong>pøijaty</strong>, nebo na ty,
		které jsou <strong>odmítnuty</strong>. Volba <strong>V¹e</strong> neomezí výsledek výbìru.</p>

    <p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví v¹echny výchozí hodnoty.</p>
    
    <p><span class="optionhead">Smazat/Pøijmout/Odmítnout/Sbalit vybrané</span><br />
		Kliknìte na za¹krtávací políèko vedle jednoho nebo více typù událostí, a poté pou¾ijte tato tlaèítka k provedení akce na v¹ech vybraných typech událostí najednou.</p>

    <span class="optionhead">Akce</span>
		<p>Tlaèítko Akce vedle ka¾dého výsledku hledání vám umo¾ní upravit nebo odstranit tento výsledek. Chcete-li najednou odstranit více záznamù, za¹krtnìte políèko ve sloupci
		<strong>Vybrat</strong> u ka¾dého záznamu, který má být odstranìn a poté kliknìte na tlaèítko "Vymazat oznaèené" na zaèátku seznamu. Pro za¹krtnutí nebo vyèi¹tìní v¹ech výbìrových políèek najednou
    mù¾ete pou¾ít tlaèítka <strong>Vybrat v¹e</strong> nebo <strong>Vyèistit v¹e</strong>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Pøidat nebo upravit typy událostí / atributù</p></a>

		<p>Nejobvyklej¹í události neboli typy "základních" událostí, jako jsou Narození, Úmrtí, Sòatek a nìkolik dal¹ích, jsou spravovány pøímo na stránkách osoby, rodiny, pramenu nebo úlo¾i¹ti pramenù.
		V¹echny ostatní události a atributy jsou spravovány v sekcích <strong>Dal¹í události / atributy</strong> na stránkách osoby, rodiny, prameny nebo úlo¾i¹tì pramenù. Pøed zápisem nìkteré z tìchto "dal¹ích"
		událostí musíte mít záznam s ní spojeného typu události / atributu. TNG automaticky nastaví typy událostí / atributù pro v¹echny nestandardní události, které obsahuje
		vá¹ soubor GEDCOM, ale nastavit tyto typy mù¾ete také ruènì.</p>

    <p>Chcete-li pøidat nový typ události / atributu, kliknìte na zálo¾ku <strong>Pøidat nový</strong> a pak vyplòte formuláø. Chcete-li upravit existující typ, pou¾ijte
    zálo¾ku <a href="#search">Hledat</a> pro vyhledání záznamu a poté kliknìte na ikonu Upravit vedle tohoto øádku.
		Pøi pøidávání nebo úpravì typu mìjte na pamìti následující:</p>

		<span class="optionhead">Spojeno s</span>
		<p>Z tohoto rozbalovacího seznamu vyberte volbu, zda je tento typ události / atributu spojen s osobou, rodinou, pramenem nebo úlo¾i¹tìm pramenù.
		Jednotlivý typ události / atributu mù¾e být spojen pouze z jednou z tìchto mo¾ností. Volba tohoto pole
		urèí, které mo¾nosti se zobrazí v rozbalovacím seznamu Tag.</p>

		<span class="optionhead">Vybrat tag nebo zadat</span>
		<p>Toto je 3 nebo 4 znaková zkratka (v¹echna velká písmena) nebo mnemotechnický kód.
		Vìt¹inu obvyklých nestandardních událostí obsahuje výbìrové pole Tag. Pokud zde po¾adovaný tag nevidíte, zmù¾ete jej pøímo zadat do pole pod tímto polem. Vyberete-li tag z tohoto seznamu
		A souèasnì jej zapí¹ete do pole, tag, který zapí¹ete do pole, bude mít pøednost a tag vybraný ze seznamu bude odmítnut.</p>

		<span class="optionhead">Type/popis</span>
		<p>Toto pole by mìlo odpovídat hodnotì "TYPE" pro tento typ události z va¹eho genealogického programu. POZN.: Toto pole se zobrazí pouze, kdy¾ vyberete
		jako tag "EVEN". U jiných tagù bude toto pole ponecháno prázdné.</p>

		<span class="optionhead">Zobrazit</span>
		<p>Údaj z tohoto pole se zobrazí ve sloupci nalevo od údaje události pøi zobrazení ve veøejné oblasti. Pokud pou¾íváte více jazykù,
		pod tímto polem uvidíte sekci nazvanou "Dal¹í jazyky". Kliknete-li na název této sekce, zobrazí se
		zvlá¹tní pole Zobrazit pro ka¾dý podporovaný jazyk. Chcete-li, aby byl pro ka¾dý jazyk zobrazen stejný výraz,
		vyplòte pole Zobrazit vý¹e a nechte pole Zobrazit pro ostatní jazyky prázdné.</p>
    
		<span class="optionhead">Poøadí pøi zobrazení</span>
		<p>Události, které jsou spojeny s daty, jsou øazeny chronologicky. Události bez dat jsou øazeny podle tohoto seznamu v poøadí,
		ve kterém se objeví v databázi. Poøadí tohoto seznamu lze ovlivnit zápisem v poli Poøadí v zobrazení.
		Ni¾¹í èíslo zpùsobí, ¾e bude událost øazena vý¹e.</p>

		<span class="optionhead">Údaje události</span>
		<p>Chcete-li pøijmout importované údaje, která odpovídají tomuto typu události / atributu, vyberte <em>Pøijmout</em>. Chcete-li data, která odpovídají tomuto typu vlastní události, nepøijmout
		a zpùsobit, ¾e nebudou naimportována, vyberte <em>Odmítnout</em>. Kdy¾ je událost tohoto typu naimportována, nastavením této volby zpìt na Odmítnout
		nebude tento typ vlastní události zobrazován.</p>
    
    <span class="optionhead">Sbalit událost</span>
		<p>Zabere-li údaj této události na stránce osoby více ne¾ jeden øádek, v¹echny dal¹í øádky budou ve výchozím stavu skryty.
    Náv¹tìvníci mohou pomocí kliknutí na malý trojúhelník vedle popisu události zobrazit v¹echny údaje k této události.</p>
    
    <span class="optionhead">Událost CJKSpd</span>
		<p>Pokud by tento typ události mìl podléhat stejným pravidlùm ochrany osobních údajù, které upravují dal¹í události CJKSpd, zvolte zde mo¾nost "Ano".</p>

	  <p><span class="optionhead">Povinná pole:</span>Pro va¹i událost musíte vybrat nebo zadat GEDCOM tag. Pokud zvolíte tag "EVEN" (obecná událost),
		musíte zadat také Type/popis. Pokud jako tag nezvolíte EVEN, musíte nechat pole Type/popis prázdné. Musíte také zadat øetìzec Zobrazit.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="accept"><p class="subheadbold">Pøijmout vybrané / Odmítnout vybrané</p></a>
		<p>Chcete-li najednou oznaèit více typù jako <strong>Pøijmout</strong> nebo <strong>Odmítnout</strong>, za¹krtnìte políèko Vybrat vedle ka¾dého typu události / atributu,
		který chcete zmìnit, a poté kliknìte na tlaèítko "Pøijmout vybrané" nebo "Odmítnout vybrané" v horní èásti stránky.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat typy událostí / atributù</p></a>
    <p>Chcete-li odstranit typ události / atributu, pou¾ijte zálo¾ku <a href="#search">Hledat</a> k nalezení polo¾ky, a poté kliknìte na ikonku Vymazat vedle tohoto záznamu. Tento øádek zmìní
		barvu a poté po odstranìní typu události / atributu zmizí. Chcete-li najednou odstranit více záznamù, za¹krtnìte tlaèítko ve sloupci Vybrat vedle ka¾dého záznamu, který má být
		odstranìn, a poté kliknìte na tlaèítko "Vymazat vybrané" na stránce nahoøe.</p>

	</td>
</tr>

</table>
</body>
</html>
