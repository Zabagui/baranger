<?php
include("../../helplib.php");
echo help_header("Nápovìda: Jazyky");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="dna_help.php" class="lightlink">&laquo; Nápovìda: Testy DNA</a> &nbsp; | &nbsp;
			<a href="backuprestore_help.php" class="lightlink">Nápovìda: Obslu¾né programy &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Jazyky</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nebo upravit</a> &nbsp; | &nbsp;
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
    <p>Nalezení existujících jazykù vyhledáním celého nebo èásti <strong>názvu pro zobrazení</strong> nebo <strong>názvu slo¾ky</strong>.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech jazykù ve va¹í databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví v¹echny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlaèítko Akce vedle ka¾dého výsledku hledání vám umo¾ní upravit nebo odstranit tento jazyk.</p>
    

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Pøidat nový / Upravit existující jazyky</p></a>
		<p>TNG zobrazuje programové výrazy, které byly pøelo¾eny do nìkolika rùzných jazykù. Chcete-li umo¾nit náv¹tìvníkùm va¹ich stránek zobrazit stránky mimo va¹eho výchozího jazyka
		také v jiných jazycích, musíte zde pro ka¾dý jazyk, který má být podporován, pøidat záznam, <strong>vèetnì</strong> svého výchozího jazyka. Napø.
		je-li va¹im výchozím jazykem èe¹tina a chcete také podporovat angliètinu, musíte v Admin/Jazyky pøidat záznam pro èe¹tinu i angliètinu.</p>

		<p>Chcete-li pøidat nový jazyk, kliknìte na zálo¾ku <strong>Pøidat nový</strong> a poté vyplòte formuláø.
		Význam jednotlivých polí je následující:</p>

		<span class="optionhead">Slo¾ka jazyku</span>
		<p>Pro výbìr umístìní souboru pro jazyk pou¾ijte rozbalovací seznam. Pokud vá¹ nový jazyk potøebuje znakovou sadu UTF-8, vyberte slo¾ku s "UTF8" v názvu.
		Chcete-li podporovat nový jazyk, který je¹tì není podporován programem TNG, pøidejte do slo¾ky TNG jazykù slo¾ku pro tento jazyk, a pak se vra»te na tuto stránku a vyberte ji.</p>

		<span class="optionhead">Název tohoto jazyku, jak bude zobrazen náv¹tìvníkùm</span>
		<p>Zadejte název jazyku, jak bude zobrazen náv¹tìvníkùm v poli pro výbìr jazykù. Je vhodné vlo¾it tento název v tomto pøíslu¹ném jazyce,
		aby jej mohli náv¹tìvníci snáze identifikovat. Napø. pou¾ijte "English" místo "Angliètina".</p>

		<span class="optionhead">Znaková sada</span>
		<p>Znaková sada pou¾itá pro tento jazyk. Necháte-li toto pole prázdné, bude pou¾ita znaková sada ISO-8859-1. Èe¹tina pou¾ívá znakovou sadu ISO-8859-2 nebo UTF-8</p>

		<span class="optionhead">Povinná pole:</span> Zadat musíte název jazyku pro zobrazení a zvolit musíte název slo¾ky jazyku.</p>

		<p><strong>DÙLE®ITÉ:</strong> Pokud uva¾ujete o umo¾nìní dynamického pøepínání jazykù, <strong>musíte nastavit vá¹ výchozí jazyk</strong> (v Nastavení/Základní nastavení) jako jazyk tìchto stránek.
		Pokud jej nenastavíte, nebudete se moci po pøepnutí na jiný jazyk pøepnout zpìt na vá¹ výchozí jazyk.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání jazykù</p></a>
		<p>Chcete-li odstranit jazyk, pou¾ijte zálo¾ku <a href="#search">Hledat</a> k nalezení jazyku, a poté kliknìte na ikonku Vymazat vedle tohoto záznamu jazyku. Tento øádek zmìní
		barvu a poté po odstranìní jazyku zmizí. <strong>Pozn.</strong>: Pøíslu¹ná slo¾ka jazyku nebude z va¹ich stránek vymazána.</p>

	</td>
</tr>

</table>
</body>
</html>
