<?php
include("../../helplib.php");
echo help_header("Nápovìda: Obslu¾né programy");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="languages_help.php" class="lightlink">&laquo; Nápovìda: Jazyky</a> &nbsp; | &nbsp;
			<a href="modmanager_help.php" class="lightlink">Nápovìda: Mana¾er módù &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Obslu¾né programy</span>
		<p class="smaller menu">
			<a href="#tables" class="lightlink">Záloha - Obnova - Optimalizace</a> &nbsp; | &nbsp;
			<a href="#structure" class="lightlink">Záloha struktury tabulek</a> &nbsp; | &nbsp;
			<a href="#ids" class="lightlink">Pøeèíslování ID èísel</a>
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
		<p>Pomocí tìchto funkcí zabezpeèíte svá data a svoje stránky udr¾íte rychlé. Pamatujte, ¾e pokud zálohy ukládáte do soukromé slo¾ky,
      mo¾nost Stáhnout zde nebude k dispozici. V takovém pøípadì budete muset ke sta¾ení va¹ich zálo¾ních souborù pou¾ít FTP program nebo online správce souborù.</p>

		<p><em><strong>POZNÁMKA:</strong> Je-li va¹e databáze velmi velká, mù¾ete pro zálohu a obnovu databáze pou¾ít nìjaký nezávislý nástroj 
    (napø. mysqldumper or phpMyAdmin). Alespoò jeden z nich byste mìli mít k dispozici na ovládacím panelu va¹ich stránek.
     Pokud je va¹e databáze pøíli¹ velká a pokud vá¹ hostitel má limit omezující èas k provedení a dokonèení skriptu, nemusí být operace 
     zálohování nebo obnovy úspì¹nì dokonèena. Co je to "velká databáze" zále¾í na ka¾dém serveru a jeho dostupných zdrojích, ale urèitým
     mìøítkem mù¾e být poèet 50 000 osob ve va¹em stromì.</em></p>
     
		<p class="optionhead">Mo¾nosti zálohování
			<ul>
				<li><b>Exportovat jako SQL:</b> Zálo¾ní soubor dat se vytvoøí ve formátu SQL. Výhodou je, ¾e zálohu lze pak obnovit do jiné databáze MySQL bez pøítomnosti TNG.</li>
				<li><b>Vlo¾it CREATE TABLE:</b> Pokud zálo¾ní soubor obsahuje pøíkaz "CREATE TABLE", operace obnovy se pokusí o vytvoøení tabulky pøed obnovením dat.</li>
				<li><b>Vlo¾it DROP TABLE IF EXISTS:</b> Lze pou¾ít pouze v pøípadì, ¾e je vlo¾en také pøíkaz CREATE TABLE. Jsou-li oba pøíkazy pøítomny, operace obnovy, která najde 
        existující tabulku se stejným názvem ji nejprve odstraní a poté znovu vytvoøí.</li>
			</ul>
		</p>
		<p class="optionhead">Mo¾nosti obnovení
			<ul>
				<li><b>Nejprve vymazat pøedchozí obsah:</b> I kdy¾ nebylo vybráno vlo¾ení pøíkazu DROP TABLE, tato volba zajistí, ¾e stávající obsah obnovované tabulky bude pøed 
        pokraèováním obnovy odstranìn. Pokud stávající data nejsou pøed obnovením odstranìna, mù¾e dojít k duplicitním záznamùm.</li>
			</ul>
		</p>     

		<span class="optionhead">Záloha</span>
		<p>Chcete-li zálohovat jednotlivou tabulku, kliknìte na ikonu Zálohovat ve sloupci Akcí vedle tabulky, kterou chcete zálohovat. Na pravé stranì øádku se vám
		zobrazí hlá¹ení o dokonèení této akce. Aktualizován bude také obsah sloupce Poslední záloha, stejnì jako velikost výsledného souboru. Pokud operace neprobìhla úspì¹nì,
		nemáte zøejmì vytvoøenou slo¾ku "Backups" (není nutné toto pojmenování; podívejte se do svého Základního nastavení) nebo nemá potøebná pøístupová práva.
		Vytvoøte tuto slo¾ku ve své hlavní TNG slo¾ce a pøidìlte jí práva pro ètení/zápis/spu¹tìní pro ostatní/skupinu/majitele (755 nebo 775, nìkteré systémy vy¾adují 777),
		poté jdìte do Základního nastavení a ujistìte se, ¾e se název slo¾ky zde pøesnì shoduje s aktuálním názvem (velikost písmen). Po vytvoøení
		úvodního souboru záloh byste mìli pro zvý¹ení úrovnì bezpeènosti nastavit pøístupová práva zpìt na 771.
		<strong>POZN.</strong>: Pokud va¹e ve¹keré údaje osob a rodin pocházejí z importu souboru GEDCOM,
		není nutné zálohovat tabulky osob, dìtí a rodin, proto¾e by tyto zálohy mohly být dost velké a mohly by zabírat cenné místo.
		Pokud by do¹lo ke ztrátì dat, mù¾ete pak tyto tabulky jednodu¹e obnovit novým importem va¹eho souboru GEDCOM.</p>

		<span class="optionhead">Obnova</span>
		<p>Chcete-li obnovit jednotlivou tabulku, kliknìte na ikonu Obnovit ve sloupci Akcí vedle tabulky, kterou chcete obnovit. Na pravé stranì øádku se vám
		zobrazí hlá¹ení o dokonèení této akce. Není-li ikona Obnovit vedle názvu pøíslu¹né tabulky vidìt, není pro tuto tabulku k dispozici ¾ádný soubor zálohy.
		<strong>POZN.</strong>: Pokud pokus o obnovu konèí chybou, je mo¾né, ¾e se pokou¹íte obnovit tabulku, její¾ aktuální struktura sloupcù
		neodpovídá struktuøe, která byla v dobì, kdy byla vytvoøena poslední záloha. Zøejmì jste zálohu vytvoøili pøed aktualizací, která
		zmìnila strukturu tabulky.</p>

		<span class="optionhead">Optimalizace</span>
		<p>Chcete-li optimalizovat jednotlivou tabulku, kliknìte na ikonu Optimalizovat ve sloupci Akcí vedle tabulky, kterou chcete optimalizovat. Na pravé stranì øádku se vám
		zobrazí hlá¹ení o dokonèení této akce. Tabulka by mìla být optimalizována, pokud jste vymazali velkou èást tabulky, od doby va¹í poslední optimalizace provedli nìkolik importù
		nebo jste provedli mnoho zmìn v polích s promìnlivou délkou. Optimalizací bude získáno zpìt nevyu¾ité místo a datový soubor bude defragmentován,
		výsledkem bývá obvykle zlep¹ený výkon. S optimalizací velkých tabulek jsou spojena nìkterá nebezpeèí, tak¾e své tabulky pøed optimalizací radìji zazálohujte.</p>

		<span class="optionhead">Zálohovat vybrané / Obnovit vybrané / Optimalizovat vybrané / Vymazat vybrané</span>
		<p>Chcete-li zálohovat, obnovit nebo optimalizovat více tabulek najednou, nebo vymazat zálo¾ní soubory, za¹krtnìte políèko ve sloupci Vybrat vedle po¾adovaných tabulek, a poté vyberte
		z rozbalovacího seznamu "S vybranými" v horní èásti stránky vyberte pøíslu¹nou akci. Pokud chcete pro nìkterou operaci vybrat v¹echny tabulky, kliknìte na tlaèítko "Vybrat v¹e".
		Podobnì mù¾ete v¹echny výbìry zru¹it kliknutím na tlaèítko "Vyèistit v¹e".</p>

		<span class="optionhead">Dal¹í doporuèení</span>
		<p>Po vytvoøení zálohy bude zálo¾ní soubor ulo¾en ve slo¾ce Backups (podle definice ve va¹em Základním nastavení). Doporuèujeme, abyste si tyto soubory zkopírovali
		do svého poèítaèe, proto¾e katastrofická událost, která mù¾e postihnout va¹e databázové tabulky, mù¾e také postihnout zálo¾ní soubory ulo¾ené na stejném poèítaèi. Pokud jsou va¹e zálo¾ní 
		soubory pøíli¹ velké, mù¾ete je poté z va¹ich webových stránek odstranit a nakopírovat je zpìt a¾, kdy¾ je nutná obnova.</p>
		<p>Také vám doporuèujeme, abyste svou slo¾ku pro ukládání zálo¾ních souborù nazvali jinak ne¾ 'backups', proto¾e by nìkteøí u¾ivatelé TNG s neèestnými úmysly mohli snadno zcizit va¹e data.
		Také vám radíme, je-li to mo¾né, pøidìlit va¹í slo¾ce záloh pøístupová práva 771 (po vytvoøení poèáteèních záloh), proto¾e to zabrání komukoli získat výpis slo¾ky.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="structure"><p class="subheadbold">Zálohování struktury tabulek</p></a>
		<p>Chcete-li zálohovat strukturu va¹ich TNG tabulek, kliknìte v této sekci na ikonu Zálohovat. Od TNG 14 bude tato záloha v¾dy vytvoøena jako soubor .SQL. 
    Pokud byla operace úspì¹ná, stránka se znovu zobrazí s èervenou zprávou v horní èásti s podrobnostmi o provedené akci.
		Vyplnìn bude také obsah sloupce Poslední záloha, stejnì jako velikost výsledného souboru. Záloha struktury va¹ich tabulek vám umo¾ní snáze obnovit va¹e data
		v pøípadì katastrofy na va¹em serveru, zvlá¹tì pokud se aktuální struktura va¹ich tabulek li¹í od struktury, která byla na poèátku.</p>
		<p>Pokud chcete obnovit strukturu va¹ich TNG tabulek, kliknìte v této sekci na ikonu Obnovit. Pokud byla operace úspì¹ná, stránka bude znovu zobrazena s èervenou zprávou nahoøe.</p>
		<strong>VAROVÁNÍ: Obnova struktury tabulek sma¾e v¹echna existující data!</strong></p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="ids"><p class="subheadbold">Pøeèíslování ID èísel</p></a>
		<p>Pomocí této funkce mù¾ete ke v¹em va¹im osobám, rodinám, pramenùm a/nebo úlo¾i¹tím pramenù pøiøadit nová, po sobì jdoucí ID èísla. V pøípadì této operace musíte být re¾imu údr¾by.
		Chcete-li spustit re¾im údr¾by, jdìte do Admin/Nastavení/Základní nastavení a v sekci "Databáze" vyberte volbu Re¾im údr¾by.</p>

		<p><strong>VAROVÁNÍ: Provedení této operace by mohlo mít vá¾né vedlej¹í úèinky!</strong> Mohlo by pøeru¹it propojení nebo zálo¾ky, které ukazují na va¹e stránky, mohlo by pøeru¹it indexování vyhledávaèe,
		a mohlo by zpùsobit, ¾e va¹e ID èísla nebudou synchronizována s va¹ím pùvodním souborem GEDCOM (pokud nìjaký máte). Doporuèujeme, abyste pøed zahájením této operace
		zazálohovali své tabulky, zvlá¹tì v pøípadì, kdy výsledek nedoká¾ete pøedem odhadnout.</p>

		<p>Volby na této stránce jsou následující:</p>

		<span class="optionhead">Strom</span>
		<p>Strom musíte vybrat. Tuto operaci mù¾ete provést pouze v jednom stromì.</p>

		<span class="optionhead">Typ ID èísla</span>
		<p>Volby jsou osoby, rodiny, prameny nebo úlo¾i¹tì pramenù. Pøeèíslování jednoho typu, ani¾ byste provedli toté¾ s jinými typy, by nemìlo
		mít ¾ádné ne¾ádoucí úèinky, které jsou obsahem vý¹e uvedeného varování.</p>

		<span class="optionhead">Minimální poèet èíslic</span>
		<p>Toto èíslo urèuje, jak budou va¹e nová ID èísla dlouhá. Je-li èíslo dané osoby men¹í ne¾ minimální poèet èíslic, zbývající èísla
		budou doplnìna nulami zleva. Napø. pokud je vá¹ minimální poèet èíslic roven 5, va¹e nejmen¹í èísla budou I00001, I00002, I00003, atd. Nechcete-li nuly zleva,
		nastavte toto èíslo na 1 (do poètu není zahrnuta pøedpona ID èísla).</p>

	</td>
</tr>

</table>
</body>
</html>
