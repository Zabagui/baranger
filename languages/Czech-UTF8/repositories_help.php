<?php
include("../../helplib.php");
echo help_header("Nápověda: Úložiště pramenů");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="sources_help.php" class="lightlink">&laquo; Nápověda: Prameny</a> &nbsp; | &nbsp;
			<a href="assoc_help.php" class="lightlink">Nápověda: Spojení &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Úložiště pramenů</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nový</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#merge" class="lightlink">Sloučit</a>
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
    <p>Nalezení existujících úložišť pramenů vyhledáním celého nebo části <strong>ID čísla úložiště</strong> nebo <strong>názvu úložiště pramenů</strong>. 
    Pro další zúžení vašeho hledání vyberte strom nebo zaškrtněte "Pouze přesná shoda".
    Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech osob ve vaší databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlačítko <strong>Obnovit</strong>, které znovu obnoví všechny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlačítko Akce vedle každého výsledku hledání vám umožní upravit, vymazat nebo otestovat výsledek. Chcete-li najednou vymazat více záznamů, zaškrtněte políčko ve sloupci
		<strong>Vybrat</strong> u každého záznamu, která má být vymazán, a poté klikněte na tlačítko "Vymazat označené" na začátku seznamu. Pro zaškrtnutí nebo vyčištění všech výběrových políček najednou
    můžete použít tlačítka <strong>Vybrat vše</strong> nebo <strong>Vyčistit vše</strong>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Přidat nové úložiště pramenů</p></a>
		<p><strong>Úložiště pramenů</strong> je archív, sborník či kolekce pramenů, fyzická či jiná.</p>

    <p>Chcete-li přidat nové úložiště pramenů, klikněte na záložku <strong>Přidat nový</strong> a poté vyplňte formulář. Některé informace (poznámky a 
		další události) můžete přidat po uložení a zamknutí záznamu. Význam jednotlivých polí je následující:</p>

  	<span class="optionhead">Strom</span>
		<p>Pokud máte pouze jeden strom, vybrán bude vždy tento strom. Jinak, prosím, pro nové úložiště pramenů vyberte požadovaný strom.</p>

    <span class="optionhead">ID číslo úložiště</span>
		<p>ID číslo úložiště musí být jednoznačné uvnitř vybraného stromu a mělo by se skládat z velkých písmen <strong>REPO</strong> nebo <strong>R</strong> následovaného číslem (nejvíce 22 znaků celkem).
		Při prvním zobrazení stránky a kdykoli je vybrán jiný strom, bude doplněno volné a jednoznačné číslo, ale pokud chcete, můžete vložit své vlastní ID číslo.
		Chcete-li zkontrolovat, zda je vaše ID číslo jednoznačné, klikněte na tlačítko <strong>Zkontrolovat</strong>. Objeví se zpráva, která vám sdělí, zda je již ID číslo použito nebo ne.
		Chcete-li vygenerovat další jednoznačné číslo, klikněte na <strong>Vygenerovat</strong>. Bude zjištěno nejvyšší číslo ve vaší databázi a přidána 1.
		Chcete-li zajistit, že zobrazení ID číslo není nárokováno jiným uživatelem, zatímco vy zapisujete data, klikněte na tlačítko <strong>Zamknout</strong>.</p>

		<p><strong>POZN.</strong>: Používáte-li tento program spolu s genealogickým programem pracujícím na platformách PC nebo Mac, který u nových úložišť pramenů vytváří také ID čísla,
		DŮRAZNĚ DOPORUČUJEME všechna tato čísla vždy mezi těmito programy synchronizovat. Výsledkem zanedbání této činnosti mohou být kolize a nepoužitelnost
		odkazů na vaše média. Pokud váš primární program vytváří ID čísla, která neodpovídají tradičním standardům (např. 
		<strong>R</strong> je na konci a ne na začátku), můžete konvence, které TNG používá, změnit v Základním nastavení.</p>
 
		<span class="optionhead">Název</span>
		<p>Krátký název úložiště.</p>

		<span class="optionhead">Adresa 1, Adresa 2, Město, Kraj/provincie, PSČ, Země</span><br />
		<p>Umístění úložiště (při využití těchto polí jsou všechny části volitelné).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Upravit existující úložiště pramenů</p></a>
    <p>Chcete-li upravit existující úložiště pramenů, použijte záložku <a href="#search">Hledat</a> pro nalezení úložiště pramenů, a poté klikněte na ikonu Upravit vedle úložiště.</p>
        
		<span class="optionhead">Poznámky</span>
    <p>Poznámky lze připojit k události nebo úložišti pramenů obecně kliknutím na ikonu Poznámky v horní části stránky
		nebo vedle každé události pod "Další události". Pokud pro událost již existují poznámky, na ikoně Poznámky se v horním pravém rohu zobrazí zelená tečka.  
    Více informací o poznámkách najdete v odkazu <a href="notes_help.php">Nápověda</a> v oblasti Poznámky.</p>
    
		<span class="optionhead">Další události</span>
		<p>Chcete-li přidat nebo spravovat další události, klikněte na tlačítko "Přidat nové" vedle <strong>Dalších událostí</strong>. Viz odkaz <a href="events_help.php">Nápověda</a> v tomto okně pro více
		informací o přidání nových událostí. Po přidání události se v tabulce pod tlačítkem "Přidat nové" zobrazí krátké shrnutí. Akční tlačítka pro
		každou událost vám umožní upravit nebo vymazat událost, nebo přidat poznámky. Pořadí, ve kterém jsou události zobrazeny, závisí na datu (pokud je použito),
		a pořadí zapsaném u typu události (není-li připojeno datum). Toto pořadí lze změnit při úpravě typů událostí.

		<p><strong>Poznámka</strong>: Poznámky a změny "Dalších" událostí se ukládají automaticky. Jiné změny (např. standardní události)
 		lze uložit kliknutím na tlačítko Uložit na konci stránky, nebo kliknutím na ikonu Uložit na stránce nahoře. Strom a 
		ID číslo úložiště nelze změnit.</p>
    

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat úložiště pramenů</p></a>
    <p>Chcete-li odstranit úložiště pramenů, použijte záložku <a href="#search">Hledat</a> pro nalezení úložiště pramenů, a poté klikněte na ikonu Vymazat vedle tohoto úložiště. Tento řádek změní
		barvu a poté po odstranění úložiště zmizí. Chcete-li najednou odstranit více úložišť pramenů, zaškrtněte políčko ve sloupci Vybrat vedle každého úložiště, který
    chcete odstranit, a poté klikněte na tlačítko "Vymazat označené" na stránce nahoře</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>

    <p>Kliknutím na tuto záložku lze přezkoumat a sloučit úložiště pramenů, která jsou lehce odlišná, ale odkazují na stejný materiál.
		Musíte rozhodnout, zda jsou tyto záznamy totožné nebo ne.</p>
		
		<span class="optionhead">Najít shodu</span>
		<p>Vyberte nejprve strom. Nelze slučovat úložiště pramenů z různých stromů, vybrán musí být pouze jeden strom. Potom máte možnost vybrat úložiště pramenů jako
		výchozí bod vašeho hledání (ID číslo úložiště 1) nebo nechat, aby první shodu osob za vás nalezl TNG. Chcete-li, aby TNG nalezl všechny změny, nechte pole ID číslo úložiště 1 prázdné</p>
		
    <p>Pokud jste vybrali úložiště pramenů jako ID číslo úložiště 1, můžete také ručně vybrat ID číslo úložiště 2. Chcete-li, aby duplicity úložiště pramenů 1 nalezl TNG, nechte pole ID číslo úložiště 2 prázdné.</p>

		<span class="optionhead">Jiné možnosti</span>
    <p><em>Sloučit poznámky</em> znamená, že poznámky z úložiště pramenů 2 budou přidány k poznámkám
		úložiště pramenů 1 u všech slučovaných polí. Není-li tato volba vybrána a pole úložiště pramenů 2 je zaškrtnuto, poznámky úložiště pramenů 2 k tomuto poli budou přepsány
		záznamy z odpovídajícího pole úložiště pramenů 1.</p>

    <p><em>Sloučit média</em> znamená, že média z úložiště pramenů 2 budou zachována a přidána k již existujícím
		u úložiště pramenů 1, pokud budou tyto dvě úložiště pramenů sloučeny. Není-li tato volba vybrána, všechny odkazy na média úložiště pramenů 2 budou po sloučení odstraněny.</p>

 		<p><span class="optionhead">Varování!</span> Pokud proběhlo sloučení, nelze jej vzít zpět! <em>Před zahájením operace slučování proto vždy zazálohujte své databázové tabulky</em>
    pro případ, že byste dvě úložiště pramenů sloučili omylem.</p>

		<span class="optionhead">Další shoda</span><br />
		<p>Najde další možné porovnání, která nezahrne úložiště pramenů 1. TNG postoupí seznamem možných úložišť pramenů v třídění podle ID čísla úložiště v textovém formátu.
		Znamená to, že "10" bude po "1", ale před "2".</p>

		<span class="optionhead">Další duplicita</span><br />
		<p>Najde další možnou duplicitu k úložiště pramenů 1. Pokud výsledkem není záznam, který byl zobrazen u úložiště pramenů 2, znamená to, že duplicita nebyla nalezena.</p>

		<span class="optionhead">Porovnat/Obnovit</span><br />
		<p>Porovnání úložiště pramenů 1 a úložiště pramenů 2. Je-li toto porovnání již zobrazeno, kliknutí na toto tlačítko způsobí obnovení stránky.</p>

		<span class="optionhead">Prohodit</span><br />
		<p>Úložiště pramenů 1 se stane úložištěm pramenů 2 a naopak.</p>

		<span class="optionhead">Sloučit</span><br />
		<p>Úložiště pramenů 2 bude sloučeno s úložištěm pramenů 1. ID číslo úložiště 1 bude zachováno, stejně jako ostatní údaje úložiště pramenů 1, pokud nejsou zaškrtnuta odpovídající políčka
		u úložiště pramenů 2. Např. pokud je u úložiště pramenů 2 zaškrtnuto políčko vedle autora, bude během sloučení údaj z tohoto pole zkopírován ze záznamu úložiště pramenů 2 do záznamu úložiště pramenů 1.
		Odpovídající údaj úložiště pramenů 1 bude smazán. Políčka u úložiště pramenů 2 jsou automaticky zaškrtnuta, pokud u úložiště pramenů 1 nejsou odpovídající údaje. Není-li
		pole zobrazeno ani u jednoho úložiště pramenů, pak v tomto poli neexistuje žádný údaj.</p>

		<span class="optionhead">Upravit</span><br />
		<p>Úprava záznamu úložiště pramenů v novém okně. Po provedení změn musíte kliknout na Porovnat/Obnovit, aby se změny projevily na obrazovce Sloučení.</p>
 
	</td>
</tr>

</table>
</body>
</html>
