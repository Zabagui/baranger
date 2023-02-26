<?php
include("../../helplib.php");
echo help_header("Nápovìda: Høbitovy");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="albums_help.php" class="lightlink">&laquo; Nápovìda: Alba</a> &nbsp; | &nbsp;
			<a href="places_help.php" class="lightlink">Nápovìda: Místa &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Høbitovy</span>
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
    <p>Nalezení existujících høbitovù vyhledáním celého nebo èásti <strong>ID èísla høbitova, názvu høbitova, mìsta, okresu, kraje, zemì</strong> nebo <strong>názvu souboru mapy</strong>.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech høbitovù ve va¹í databázi.</p>

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
		<a name="add"><p class="subheadbold">Pøidat nový / Upravit existující høbitovy</p></a>
		<p>TNG vám umo¾ní tøídit a zobrazit va¹e fotografie náhrobkù podle høbitovù. Aby toto fungovalo, musíte pro ka¾dé místo nastavit nový záznam høbitova. Záznamy
		høbitovù v TNG se nevztahují k záznamùm míst a pro høitovy neexistuje konvence GEDCOM, tak¾e pokud vá¹ soubor GEDCOM obsehuje v nìkterých místech pohøbù
		názvy høbitovù, tyto názvy po naimporování souboru GEDCOM nebudou v TNG zalo¾eny jako záznamy høbitovù.</p>

		<p>Chcete-li pøidat nový høbitov, kliknìte na zálo¾ku <strong>Pøidat nový</strong> a poté vyplòte formuláø. <p>Chcete-li upravit existující høbitov, pou¾ijte
    zálo¾ku <a href="#search">Hledat</a> pro nalezení høbitova, a poté kliknìte na ikonu Upravit vedle tohoto øádku.</p>
    Význam jednotlivých polí pøi pøidání nebo úpravì høbitova je následující:</p>
    
		<span class="optionhead">Název høbitova</span>
		<p>Vlo¾te úplný název høbitova. Napø. Høbitov Klá¹terec by mìl být zapsán jako <em>Høbitov Klá¹terec</em> a ne jen jako <em>Klá¹terec</em>.</p>

		<span class="optionhead">Obrázek plánu pro nahrání</span>
		<p>Pokud máte plán nebo jinou fotografii tohoto høbitova a je¹tì jste ji nenahráli na na va¹e webové stránky, kliknìte na tlaèítko "Prohledat" a najdìte ji na svém disku.
		Je-li fotografie ji¾ na va¹ich stránkách ve slo¾ce náhrobkù, nechat toto pole prázdné a pou¾ijte místo toho pole "Název souboru plánu ve slo¾ce náhrobkù".</p>

		<span class="optionhead">Název souboru plánu ve slo¾ce náhrobkù</span>
		<p>Pokud jste ji¾ døíve nahráli svùj plán nebo fotografii do slo¾ky náhrobkù, zapi¹te umístìní a název souboru tak, jak existuje ve slo¾ce náhrobkù na va¹ich webových stránkách,
		nebo kliknìte na tlaèítko Vybrat pro nalezení souboru. Jestli¾e jste nahráli svùj plán nebo fotografii
		a¾ nyní pomocí pøedchozího pole, pou¾ijte toto pole k zápisu umístìní a názvu souboru po jeho nahrání. Pøedpokládané umístìní a název bude pro vás pøedvyplnìn.</p>

    <p> <span class="optionhead">POZN.</span>: Budete-li na stránky nahrávat nyní, adresáø, který jste zde oznaèili, musí existovat a musí mít nastaveno právo na zápis.
    Pokud slo¾ka neexistuje, mù¾ete ji vytvoøit pomocí tlaèítka "Vytvoøit slo¾ku" v Základním nastavení. Není-li tato operace mo¾ná, pou¾ijte vá¹ FTP program
		nebo jiný online souborový správce. </p>

		<span class="optionhead">Asociované místo</span>
		<p>Chcete-li tento høbitov propojit s místem, zadejte sem název místa tak, jak existuje ve va¹í databázi nebo postupujte tak, ¾e
		vyplníte údaje mìsto, okres/farnost, kraj/provincie, zemì a kliknìte na tlaèítko <strong>Doplnit místo</strong>.
		Kliknutím na toto tlaèítko se hodnoty, které jste zapsali do pøedchozích polí, vyplní do pole Asociované místo.</p>

		<p>Je-li høbitov propojen s místem, údaje o høbitovu budou zobrazeny na stránce místa a seznam pohøbù
		spojených s místem bude zobrazen na stránce høbitova.</p>

		<span class="optionhead">Mìsto, Okres/farnost, Kraj/provincie, Zemì</span>
		<p>Zadejte co nejvíce údajù o umístìní tohoto høbitova. Povinná je zemì, ostatní pole jsou nepovinná.</p>

		<p>Pøi vyplnìní polí <strong>Kraj/provincie</strong> a <strong>Zemì</strong> vyberte existující zápis z rozbalovacího seznamu. Pokud zde po¾adovaný údaj není, pro pøidání do seznamu pou¾ijte tlaèítko "Pøidat nové".
		Pokud zápis do tohoto seznamu nepatøí, nejdøíve jej vyberte a pak kliknìte na tlaèítko "Vymazat vybrané".</p>

		<span class="optionhead">Zobrazit/skrýt klikací mapu</span>
		<p>Kliknutím na tlaèítko "Zobrazit/skrýt klikací mapu" se zobrazí Google Map. Tato funkce je aktivní, pokud jste obdr¾eli od Google "klíè" a vlo¾ili jej do
		svého nastavení map v TNG (viz <a href="mapconfig_help.php">Nápovìda pro nastavení mapy</a> pro více informací). Opìtovným kliknutím na toto tlaèítko bude mapa skryta. Chcete-li, aby bylo umístìní vyhledáno v Google Maps,
		zapi¹te toto umístìní do pole <strong>Geokódovat umístìní</strong> a kliknìte na tlaèítko "Hledat". Do mapy mù¾ete také klikat a pohybovat s ní, dokud
		nebude "¹pendlík" na po¾adovaném místì. Mù¾ete také pou¾ít ovládací prvek Pøiblí¾ení pro zobrazení více podrobností v okolí po¾adované oblasti. Na stránce
		<a href="places_googlemap_help.php">Nápovìda Google Maps</a> najdete více informací. Informace o výchozím nastavení va¹ich map najdete v <a href="mapconfig_help.php">Nápovìdì: Nastavení map</a>.</p>

		<span class="optionhead">Zemìpisná ¹íøka/délka</span>
		<p>Zapi¹te souøadnice zemìpisné ¹íøky a délky høbitova nebo pro nastavení hodnot pou¾ijte klikací Google Map (nepovinné, viz vý¹e).</p>

		<span class="optionhead">Pøiblí¾ení</span>
		<p>Zadejte úroveò pøiblí¾ení nebo upravte ovládací prvek pøiblí¾ení v Google Map pro nastavení úrovnì pøiblí¾ení. Tato volba je dostupná pouze, kdy¾ jste obdr¾eli "klíè"
		od Google a zapsali jej do va¹eho nastavení map v TNG.</p>
    
		<span class="optionhead">Poznámky</span>
		<p>Jsou-li tøeba pro popis høbitova nebo jeho místa je¹tì dal¹í informace, zapi¹te je sem (nepovinné).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat høbitovy</p></a>

    <p>Chcete-li odstranit høbitov, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení høbitova, a poté kliknìte na ikonu Vymazat vedle tohoto záznamu høbitova. Tento øádek zmìní
		barvu a poté po odstranìní høbitova zmizí. Chcete-li najednou odstranit více høbitovù, za¹krtnìte políèko ve sloupci Vybrat vedle ka¾dého høbitova, který
    chcete odstranit, a poté kliknìte na tlaèítko "Vymazat oznaèené" na stránce nahoøe</p>


	</td>
</tr>

</table>
</body>
</html>
