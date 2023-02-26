<?php
include("../../helplib.php");
echo help_header("Nápovìda: Události èasové osy");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="places_googlemap_help.php" class="lightlink">&laquo; Nápovìda: Google Maps</a> &nbsp; | &nbsp;
			<a href="notes2_help.php" class="lightlink">Nápovìda: Poznámky &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Události èasové osy</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nebo Upravit</a> &nbsp; | &nbsp;
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
    <p>Nalezení existujících událostí èasové osy vyhledáním celého nebo èásti <strong>roku události</strong> nebo <strong>podrobností události</strong>.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech míst ve va¹í databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví v¹echny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlaèítko Akce vedle ka¾dého výsledku hledání vám umo¾ní upravit, odstranit nebo otestovat tento výsledek. Chcete-li najednou vymazat více záznamù, za¹krtnìte políèko ve sloupci
		<strong>Vybrat</strong> u ka¾dého záznamu, která má být vymazán a poté kliknìte na tlaèítko "Vymazat oznaèené" na zaèátku seznamu. Pro za¹krtnutí nebo vyèi¹tìní v¹ech výbìrových políèek najednou
    mù¾ete pou¾ít tlaèítka <strong>Vybrat v¹e</strong> nebo <strong>Vyèistit v¹e</strong>.</p>
     
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Pøidat novou / Upravit existující události èasové osy</p></a>
		<p>TNG umo¾òuje zobrazení schématu èasové osy pro porovnání rozsahu ¾ivota osob ve va¹í databázi.
		Roz¹íøit souvislosti tìchto schémat mù¾ete také vytvoøením událostí èasové osy. Pokud roky, které pokrývá
		schéma èasové osy, obsahují údaje spojené s tìmito událostmi, jsou ve schématu zobrazeny jako
		zápatí. Tyto události lze vyu¾ít pouze v TNG, nelze je exportovat do souboru GEDCOM.</p>

    <p>Chcete-li pøidat novou událost èasové osy, kliknìte na zálo¾ku <strong>Pøidat novou</strong> a poté vyplòte formuláø. <p>Chcete-li upravit existující událost, pou¾ijte
    zálo¾ku <a href="#search">Hledat</a> pro nalezení události, a poté kliknìte na ikonu Upravit vedle tohoto øádku.</p>
    Význam jednotlivých polí pøi pøidání nebo úpravì události èasové osy je následující:</p>

		<span class="optionhead">Poèáteèní datum / Koneèné datum</span>
		<p>Vyberte v¹echny známé slo¾ky (den, mìsíc, rok) poèáteèního a koneèného data události. Povinný je pouze rok poèáteèního data.
		Zapí¹ete-li nìjakou slo¾ku koneèného data, pak je také zde povinný rok.</p>

		<span class="optionhead">Titul události</span><br />
		<p>Zadejte velmi krátký titul události. Napø. <em>Potopení Titanicu</em> nebo <em>1. svìtová válka</em>. Toto pole bylo zavedeno v TNG 9.0. Události
		èasové osy pøidané pøed touto verzí nemají titul. V tomto pøípadì budou jako Titul události pou¾ity Podrobnosti události.</p>

		<span class="optionhead">Podrobnosti události</span><br />
		<p>Zapi¹te struèný popis události. Mìl by obsahovat pouze nìkolik vìt.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat události èasové osy</p></a>
		<p>Chcete-li odstranit událost èasové osy, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení události, a poté kliknìte na ikonu Vymazat vedle tohoto záznamu události. Tento øádek zmìní
		barvu a poté po odstranìní události zmizí. Chcete-li najednou odstranit více událostí, za¹krtnìte políèko ve sloupci Vybrat vedle ka¾dé události, kterou
    chcete odstranit, a poté kliknìte na tlaèítko "Vymazat oznaèené" na stránce nahoøe</p>
    
	</td>
</tr>

</table>
</body>
</html>
