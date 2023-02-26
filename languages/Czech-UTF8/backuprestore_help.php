<?php
include("../../helplib.php");
echo help_header("Nápověda: Obslužné programy");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="languages_help.php" class="lightlink">&laquo; Nápověda: Jazyky</a> &nbsp; | &nbsp;
			<a href="modmanager_help.php" class="lightlink">Nápověda: Manažer módů &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Obslužné programy</span>
		<p class="smaller menu">
			<a href="#tables" class="lightlink">Záloha - Obnova - Optimalizace</a> &nbsp; | &nbsp;
			<a href="#structure" class="lightlink">Záloha struktury tabulek</a> &nbsp; | &nbsp;
			<a href="#ids" class="lightlink">Přečíslování ID čísel</a>
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

		<a name="tables"><p class="subheadbold">Zálohování, obnovování &amp; optimalizace dat v tabulkách</p></a>
		<p>Pomocí těchto funkcí zabezpečíte svá data a svoje stránky udržíte rychlé. Pamatujte, že pokud zálohy ukládáte do soukromé složky,
      možnost Stáhnout zde nebude k dispozici. V takovém případě budete muset ke stažení vašich záložních souborů použít FTP program nebo online správce souborů.</p>

		<p><em><strong>POZNÁMKA:</strong> Je-li vaše databáze velmi velká, můžete pro zálohu a obnovu databáze použít nějaký nezávislý nástroj 
    (např. mysqldumper or phpMyAdmin). Alespoň jeden z nich byste měli mít k dispozici na ovládacím panelu vašich stránek.
     Pokud je vaše databáze příliš velká a pokud váš hostitel má limit omezující čas k provedení a dokončení skriptu, nemusí být operace 
     zálohování nebo obnovy úspěšně dokončena. Co je to "velká databáze" záleží na každém serveru a jeho dostupných zdrojích, ale určitým
     měřítkem může být počet 50 000 osob ve vašem stromě.</em></p>
     
		<p class="optionhead">Možnosti zálohování
			<ul>
				<li><b>Exportovat jako SQL:</b> Záložní soubor dat se vytvoří ve formátu SQL. Výhodou je, že zálohu lze pak obnovit do jiné databáze MySQL bez přítomnosti TNG.</li>
				<li><b>Vložit CREATE TABLE:</b> Pokud záložní soubor obsahuje příkaz "CREATE TABLE", operace obnovy se pokusí o vytvoření tabulky před obnovením dat.</li>
				<li><b>Vložit DROP TABLE IF EXISTS:</b> Lze použít pouze v případě, že je vložen také příkaz CREATE TABLE. Jsou-li oba příkazy přítomny, operace obnovy, která najde 
        existující tabulku se stejným názvem ji nejprve odstraní a poté znovu vytvoří.</li>
			</ul>
		</p>
		<p class="optionhead">Možnosti obnovení
			<ul>
				<li><b>Nejprve vymazat předchozí obsah:</b> I když nebylo vybráno vložení příkazu DROP TABLE, tato volba zajistí, že stávající obsah obnovované tabulky bude před 
        pokračováním obnovy odstraněn. Pokud stávající data nejsou před obnovením odstraněna, může dojít k duplicitním záznamům.</li>
			</ul>
		</p>     

		<span class="optionhead">Záloha</span>
		<p>Chcete-li zálohovat jednotlivou tabulku, klikněte na ikonu Zálohovat ve sloupci Akcí vedle tabulky, kterou chcete zálohovat. Na pravé straně řádku se vám
		zobrazí hlášení o dokončení této akce. Aktualizován bude také obsah sloupce Poslední záloha, stejně jako velikost výsledného souboru. Pokud operace neproběhla úspěšně,
		nemáte zřejmě vytvořenou složku "Backups" (není nutné toto pojmenování; podívejte se do svého Základního nastavení) nebo nemá potřebná přístupová práva.
		Vytvořte tuto složku ve své hlavní TNG složce a přidělte jí práva pro čtení/zápis/spuštění pro ostatní/skupinu/majitele (755 nebo 775, některé systémy vyžadují 777),
		poté jděte do Základního nastavení a ujistěte se, že se název složky zde přesně shoduje s aktuálním názvem (velikost písmen). Po vytvoření
		úvodního souboru záloh byste měli pro zvýšení úrovně bezpečnosti nastavit přístupová práva zpět na 771.
		<strong>POZN.</strong>: Pokud vaše veškeré údaje osob a rodin pocházejí z importu souboru GEDCOM,
		není nutné zálohovat tabulky osob, dětí a rodin, protože by tyto zálohy mohly být dost velké a mohly by zabírat cenné místo.
		Pokud by došlo ke ztrátě dat, můžete pak tyto tabulky jednoduše obnovit novým importem vašeho souboru GEDCOM.</p>

		<span class="optionhead">Obnova</span>
		<p>Chcete-li obnovit jednotlivou tabulku, klikněte na ikonu Obnovit ve sloupci Akcí vedle tabulky, kterou chcete obnovit. Na pravé straně řádku se vám
		zobrazí hlášení o dokončení této akce. Není-li ikona Obnovit vedle názvu příslušné tabulky vidět, není pro tuto tabulku k dispozici žádný soubor zálohy.
		<strong>POZN.</strong>: Pokud pokus o obnovu končí chybou, je možné, že se pokoušíte obnovit tabulku, jejíž aktuální struktura sloupců
		neodpovídá struktuře, která byla v době, kdy byla vytvořena poslední záloha. Zřejmě jste zálohu vytvořili před aktualizací, která
		změnila strukturu tabulky.</p>

		<span class="optionhead">Optimalizace</span>
		<p>Chcete-li optimalizovat jednotlivou tabulku, klikněte na ikonu Optimalizovat ve sloupci Akcí vedle tabulky, kterou chcete optimalizovat. Na pravé straně řádku se vám
		zobrazí hlášení o dokončení této akce. Tabulka by měla být optimalizována, pokud jste vymazali velkou část tabulky, od doby vaší poslední optimalizace provedli několik importů
		nebo jste provedli mnoho změn v polích s proměnlivou délkou. Optimalizací bude získáno zpět nevyužité místo a datový soubor bude defragmentován,
		výsledkem bývá obvykle zlepšený výkon. S optimalizací velkých tabulek jsou spojena některá nebezpečí, takže své tabulky před optimalizací raději zazálohujte.</p>

		<span class="optionhead">Zálohovat vybrané / Obnovit vybrané / Optimalizovat vybrané / Vymazat vybrané</span>
		<p>Chcete-li zálohovat, obnovit nebo optimalizovat více tabulek najednou, nebo vymazat záložní soubory, zaškrtněte políčko ve sloupci Vybrat vedle požadovaných tabulek, a poté vyberte
		z rozbalovacího seznamu "S vybranými" v horní části stránky vyberte příslušnou akci. Pokud chcete pro některou operaci vybrat všechny tabulky, klikněte na tlačítko "Vybrat vše".
		Podobně můžete všechny výběry zrušit kliknutím na tlačítko "Vyčistit vše".</p>

		<span class="optionhead">Další doporučení</span>
		<p>Po vytvoření zálohy bude záložní soubor uložen ve složce Backups (podle definice ve vašem Základním nastavení). Doporučujeme, abyste si tyto soubory zkopírovali
		do svého počítače, protože katastrofická událost, která může postihnout vaše databázové tabulky, může také postihnout záložní soubory uložené na stejném počítači. Pokud jsou vaše záložní 
		soubory příliš velké, můžete je poté z vašich webových stránek odstranit a nakopírovat je zpět až, když je nutná obnova.</p>
		<p>Také vám doporučujeme, abyste svou složku pro ukládání záložních souborů nazvali jinak než 'backups', protože by někteří uživatelé TNG s nečestnými úmysly mohli snadno zcizit vaše data.
		Také vám radíme, je-li to možné, přidělit vaší složce záloh přístupová práva 771 (po vytvoření počátečních záloh), protože to zabrání komukoli získat výpis složky.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="structure"><p class="subheadbold">Zálohování struktury tabulek</p></a>
		<p>Chcete-li zálohovat strukturu vašich TNG tabulek, klikněte v této sekci na ikonu Zálohovat. Od TNG 14 bude tato záloha vždy vytvořena jako soubor .SQL. 
    Pokud byla operace úspěšná, stránka se znovu zobrazí s červenou zprávou v horní části s podrobnostmi o provedené akci.
		Vyplněn bude také obsah sloupce Poslední záloha, stejně jako velikost výsledného souboru. Záloha struktury vašich tabulek vám umožní snáze obnovit vaše data
		v případě katastrofy na vašem serveru, zvláště pokud se aktuální struktura vašich tabulek liší od struktury, která byla na počátku.</p>
		<p>Pokud chcete obnovit strukturu vašich TNG tabulek, klikněte v této sekci na ikonu Obnovit. Pokud byla operace úspěšná, stránka bude znovu zobrazena s červenou zprávou nahoře.</p>
		<strong>VAROVÁNÍ: Obnova struktury tabulek smaže všechna existující data!</strong></p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="ids"><p class="subheadbold">Přečíslování ID čísel</p></a>
		<p>Pomocí této funkce můžete ke všem vašim osobám, rodinám, pramenům a/nebo úložištím pramenů přiřadit nová, po sobě jdoucí ID čísla. V případě této operace musíte být režimu údržby.
		Chcete-li spustit režim údržby, jděte do Admin/Nastavení/Základní nastavení a v sekci "Databáze" vyberte volbu Režim údržby.</p>

		<p><strong>VAROVÁNÍ: Provedení této operace by mohlo mít vážné vedlejší účinky!</strong> Mohlo by přerušit propojení nebo záložky, které ukazují na vaše stránky, mohlo by přerušit indexování vyhledávače,
		a mohlo by způsobit, že vaše ID čísla nebudou synchronizována s vaším původním souborem GEDCOM (pokud nějaký máte). Doporučujeme, abyste před zahájením této operace
		zazálohovali své tabulky, zvláště v případě, kdy výsledek nedokážete předem odhadnout.</p>

		<p>Volby na této stránce jsou následující:</p>

		<span class="optionhead">Strom</span>
		<p>Strom musíte vybrat. Tuto operaci můžete provést pouze v jednom stromě.</p>

		<span class="optionhead">Typ ID čísla</span>
		<p>Volby jsou osoby, rodiny, prameny nebo úložiště pramenů. Přečíslování jednoho typu, aniž byste provedli totéž s jinými typy, by nemělo
		mít žádné nežádoucí účinky, které jsou obsahem výše uvedeného varování.</p>

		<span class="optionhead">Minimální počet číslic</span>
		<p>Toto číslo určuje, jak budou vaše nová ID čísla dlouhá. Je-li číslo dané osoby menší než minimální počet číslic, zbývající čísla
		budou doplněna nulami zleva. Např. pokud je váš minimální počet číslic roven 5, vaše nejmenší čísla budou I00001, I00002, I00003, atd. Nechcete-li nuly zleva,
		nastavte toto číslo na 1 (do počtu není zahrnuta předpona ID čísla).</p>

	</td>
</tr>

</table>
</body>
</html>
