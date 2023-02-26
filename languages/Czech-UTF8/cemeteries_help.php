<?php
include("../../helplib.php");
echo help_header("Nápověda: Hřbitovy");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="albums_help.php" class="lightlink">&laquo; Nápověda: Alba</a> &nbsp; | &nbsp;
			<a href="places_help.php" class="lightlink">Nápověda: Místa &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Hřbitovy</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nebo Upravit</a> &nbsp; | &nbsp;
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
    <p>Nalezení existujících hřbitovů vyhledáním celého nebo části <strong>ID čísla hřbitova, názvu hřbitova, města, okresu, kraje, země</strong> nebo <strong>názvu souboru mapy</strong>.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech hřbitovů ve vaší databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlačítko <strong>Obnovit</strong>, které znovu obnoví všechny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlačítko Akce vedle každého výsledku hledání vám umožní upravit, odstranit nebo otestovat tento výsledek. Chcete-li najednou vymazat více záznamů, zaškrtněte políčko ve sloupci
		<strong>Vybrat</strong> u každého záznamu, která má být vymazán a poté klikněte na tlačítko "Vymazat označené" na začátku seznamu. Pro zaškrtnutí nebo vyčištění všech výběrových políček najednou
    můžete použít tlačítka <strong>Vybrat vše</strong> nebo <strong>Vyčistit vše</strong>.</p>
 
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Přidat nový / Upravit existující hřbitovy</p></a>
		<p>TNG vám umožní třídit a zobrazit vaše fotografie náhrobků podle hřbitovů. Aby toto fungovalo, musíte pro každé místo nastavit nový záznam hřbitova. Záznamy
		hřbitovů v TNG se nevztahují k záznamům míst a pro hřitovy neexistuje konvence GEDCOM, takže pokud váš soubor GEDCOM obsehuje v některých místech pohřbů
		názvy hřbitovů, tyto názvy po naimporování souboru GEDCOM nebudou v TNG založeny jako záznamy hřbitovů.</p>

		<p>Chcete-li přidat nový hřbitov, klikněte na záložku <strong>Přidat nový</strong> a poté vyplňte formulář. <p>Chcete-li upravit existující hřbitov, použijte
    záložku <a href="#search">Hledat</a> pro nalezení hřbitova, a poté klikněte na ikonu Upravit vedle tohoto řádku.</p>
    Význam jednotlivých polí při přidání nebo úpravě hřbitova je následující:</p>
    
		<span class="optionhead">Název hřbitova</span>
		<p>Vložte úplný název hřbitova. Např. Hřbitov Klášterec by měl být zapsán jako <em>Hřbitov Klášterec</em> a ne jen jako <em>Klášterec</em>.</p>

		<span class="optionhead">Obrázek plánu pro nahrání</span>
		<p>Pokud máte plán nebo jinou fotografii tohoto hřbitova a ještě jste ji nenahráli na na vaše webové stránky, klikněte na tlačítko "Prohledat" a najděte ji na svém disku.
		Je-li fotografie již na vašich stránkách ve složce náhrobků, nechat toto pole prázdné a použijte místo toho pole "Název souboru plánu ve složce náhrobků".</p>

		<span class="optionhead">Název souboru plánu ve složce náhrobků</span>
		<p>Pokud jste již dříve nahráli svůj plán nebo fotografii do složky náhrobků, zapište umístění a název souboru tak, jak existuje ve složce náhrobků na vašich webových stránkách,
		nebo klikněte na tlačítko Vybrat pro nalezení souboru. Jestliže jste nahráli svůj plán nebo fotografii
		až nyní pomocí předchozího pole, použijte toto pole k zápisu umístění a názvu souboru po jeho nahrání. Předpokládané umístění a název bude pro vás předvyplněn.</p>

    <p> <span class="optionhead">POZN.</span>: Budete-li na stránky nahrávat nyní, adresář, který jste zde označili, musí existovat a musí mít nastaveno právo na zápis.
    Pokud složka neexistuje, můžete ji vytvořit pomocí tlačítka "Vytvořit složku" v Základním nastavení. Není-li tato operace možná, použijte váš FTP program
		nebo jiný online souborový správce. </p>

		<span class="optionhead">Asociované místo</span>
		<p>Chcete-li tento hřbitov propojit s místem, zadejte sem název místa tak, jak existuje ve vaší databázi nebo postupujte tak, že
		vyplníte údaje město, okres/farnost, kraj/provincie, země a klikněte na tlačítko <strong>Doplnit místo</strong>.
		Kliknutím na toto tlačítko se hodnoty, které jste zapsali do předchozích polí, vyplní do pole Asociované místo.</p>

		<p>Je-li hřbitov propojen s místem, údaje o hřbitovu budou zobrazeny na stránce místa a seznam pohřbů
		spojených s místem bude zobrazen na stránce hřbitova.</p>

		<span class="optionhead">Město, Okres/farnost, Kraj/provincie, Země</span>
		<p>Zadejte co nejvíce údajů o umístění tohoto hřbitova. Povinná je země, ostatní pole jsou nepovinná.</p>

		<p>Při vyplnění polí <strong>Kraj/provincie</strong> a <strong>Země</strong> vyberte existující zápis z rozbalovacího seznamu. Pokud zde požadovaný údaj není, pro přidání do seznamu použijte tlačítko "Přidat nové".
		Pokud zápis do tohoto seznamu nepatří, nejdříve jej vyberte a pak klikněte na tlačítko "Vymazat vybrané".</p>

		<span class="optionhead">Zobrazit/skrýt klikací mapu</span>
		<p>Kliknutím na tlačítko "Zobrazit/skrýt klikací mapu" se zobrazí Google Map. Tato funkce je aktivní, pokud jste obdrželi od Google "klíč" a vložili jej do
		svého nastavení map v TNG (viz <a href="mapconfig_help.php">Nápověda pro nastavení mapy</a> pro více informací). Opětovným kliknutím na toto tlačítko bude mapa skryta. Chcete-li, aby bylo umístění vyhledáno v Google Maps,
		zapište toto umístění do pole <strong>Geokódovat umístění</strong> a klikněte na tlačítko "Hledat". Do mapy můžete také klikat a pohybovat s ní, dokud
		nebude "špendlík" na požadovaném místě. Můžete také použít ovládací prvek Přiblížení pro zobrazení více podrobností v okolí požadované oblasti. Na stránce
		<a href="places_googlemap_help.php">Nápověda Google Maps</a> najdete více informací. Informace o výchozím nastavení vašich map najdete v <a href="mapconfig_help.php">Nápovědě: Nastavení map</a>.</p>

		<span class="optionhead">Zeměpisná šířka/délka</span>
		<p>Zapište souřadnice zeměpisné šířky a délky hřbitova nebo pro nastavení hodnot použijte klikací Google Map (nepovinné, viz výše).</p>

		<span class="optionhead">Přiblížení</span>
		<p>Zadejte úroveň přiblížení nebo upravte ovládací prvek přiblížení v Google Map pro nastavení úrovně přiblížení. Tato volba je dostupná pouze, když jste obdrželi "klíč"
		od Google a zapsali jej do vašeho nastavení map v TNG.</p>
    
		<span class="optionhead">Poznámky</span>
		<p>Jsou-li třeba pro popis hřbitova nebo jeho místa ještě další informace, zapište je sem (nepovinné).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat hřbitovy</p></a>

    <p>Chcete-li odstranit hřbitov, použijte záložku <a href="#search">Hledat</a> pro nalezení hřbitova, a poté klikněte na ikonu Vymazat vedle tohoto záznamu hřbitova. Tento řádek změní
		barvu a poté po odstranění hřbitova zmizí. Chcete-li najednou odstranit více hřbitovů, zaškrtněte políčko ve sloupci Vybrat vedle každého hřbitova, který
    chcete odstranit, a poté klikněte na tlačítko "Vymazat označené" na stránce nahoře</p>


	</td>
</tr>

</table>
</body>
</html>
