<?php
include("../../helplib.php");
echo help_header("Nápovìda: Reporty");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="eventtypes_help.php" class="lightlink">&laquo; Nápovìda: Typy událostí / atributù</a> &nbsp; | &nbsp;
			<a href="dna_help.php" class="lightlink">Nápovìda: Testy DNA &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Reporty</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nebo upravit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
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

    <p>Nalezení existujících reportù vyhledáním celého nebo èásti <strong>názvu reportu</strong> nebo <strong>popisu</strong>.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech reportù ve va¹í databázi.</p>

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
		<a name="add"><p class="subheadbold">Pøidání nebo úprava reportu</p></a>

		<p>Reportem se v TNG rozumí u¾ivatelský seznam osob z va¹í databáze. Vy rozhodnete, která pole mají být zobrazena, které osoby mají být do reportu vlo¾eny a jak mají být seøazeny.
		Mù¾ete pou¾ít rozhraní pro tvorbu reportù nebo mù¾ete místo toho pou¾ít své vlastní pøíkazy SQL.</p>

		<p>Chcete-li pøidat nový report, kliknìte na zálo¾ku <strong>Pøidat nový</strong> a poté vyplòte formuláø. <p>Chcete-li upravit existující report, pou¾ijte
    zálo¾ku <a href="#search">Hledat</a> pro nalezení reportu, a poté kliknìte na ikonu Upravit vedle tohoto øádku.</p>
    Význam jednotlivých polí pøi pøidání nebo úpravì reportu je následující:</p>

		<span class="optionhead">Název reportu</span>
		<p>Svému reportu musíte dát název. Pøi zobrazení reportu se objeví jako jeho titul.</p>

		<span class="optionhead">Popis</span>
		<p>Svùj report struènì popi¹te. Tento popis se objeví pøi zobrazení reportu pod titulem. Popis by mìl struènì vysvìtlit, co report zobrazuje a pøi
		pou¾ití jakých kritérií.</p>

		<span class="optionhead">Poøadí/Priorita</span>
		<p>Reporty budou tøídìny alfabeticky podle názvu, pokud ka¾dému nepøidìlíte poøadí nebo prioritu. Nejdøíve se øadí ni¾¹í èísla. Prázdné poøadí se dostane pøed èíslo.</p>

		<span class="optionhead">Aktivní</span>
		<p>Vá¹ nový report nebude na stránkách náv¹tìvníkù viditelný, dokud jej neoznaèíte zde jako aktivní. Je dobré pøed aktivací nový report ulo¾it a otestovat, zda pracuje tak, jak chcete.</p>

		<span class="optionhead">Zvolte pole pro zobrazení</span>
		<p>Zkopírováním z levé èásti do pravé urèíte, která pole chcete ve svém reportu zobrazit. Provést to mù¾ete
		pøeta¾ením pole z levé èásti doprava nebo jednodu¹e dvojitým kliknutím na název pole.</p>

		<p>Pole mù¾ete odstranit ze seznamu zobrazení vpravo dvojitým kliknutím na název pole.</p>

		<p>Pole, která jsou v seznamu zobrazení nahoøe, budou v reportu zobrazena nalevo. Zmìnit poøadí zobrazovaných polí
		mù¾ete kliknutím a podr¾ením pole v pravé èásti a pøetáhnutím v seznamu nahoru nebo dolù.</p>

		<span class="optionhead">Vyberte kritéria</span>
		<p>Volbou kritérií oznaète osoby, které chcete vlo¾it do svého reportu. Osoby, které kritériím neodpovídají, v reportu nebudou obsa¾eny. Pøíkazy pro kritéria jsou
		dobøe zformulovány, kdy¾ obsahují název pole a podmínku. Napø. "Pøíjmení = 'Novák' " nebo "Místo narození obsahuje 'Olomouc' ". Více kritérií musí být spojeno pøíkazy A nebo
		NE. Poøadí je indikováno pomocí závorek.</p>
    
		<p>Pøíkaz zaènìte výbìrem názvu pole z horního levého rámce a pøidejte jej do pravého rámce. Provést to mù¾ete
		výbìrem pole a kliknutím na sousední tlaèítko <em>Pøidat >></em> nebo jednodu¹e dvojklikem na název pole (pouze IE).</p>
    
		<p>Jakýkoli pøíkaz zaènìte výbìrem názvu pole z levé horního èásti a jeho pøeta¾ením do pravé èásti. Mù¾ete také dvakrát kliknout na název pole.</p>    

		<p><strong>POZN.</strong>: V¹echna datová pole mimo Datum poslední aktualizace se chovají jako øetìzce a ne jako
		skuteèná data POKUD NEJSOU oznaèena jako 'True'. Porovnání dat, které pou¾ívají textová nebo øetìzcová pole, se nejlépe provede porovnáním komponent data,
		jako je pouze rok nebo pouze den. Chcete-li tímto zpùsobem izolovat komponentu data, vyberte nejdøíve  <em>Mìsíc pouze</em>,
		<em>Den pouze</em> nebo <em>Rok pouze</em>, a pak vyberte pole data, ze kterého tato komponenta pochází.</p>

		<p>Pøi práci se skuteènými datovými poli (jako Datum poslední aktualizace) mù¾ete porovnat pole pøímo s jiným skuteèným datem
		nebo skuteènými datovými poli. Pøeddefinované skuteèné datum, které mù¾ete pou¾ít jako operátor, je 'Dnes'. Pøi porovnávání dvou skuteèných dat mù¾ete také pou¾ít 
    operátor 'Pøevést na dny'. Napø. pro nalezení v¹ech záznamù, u kterých je Datum poslední aktualizace men¹í ne¾ 30 dní,
		mù¾ete zvolit toto kritérium:<br/><br/>

		<i>Pøevést na dny<br/>
		Dnes (true)<br/>
		-<br/>
		Pøevést na dny<br/>
		Datum poslední aktualizace<br/>
		<=<br/>
		30</i></p>

		<p>Po výbìru názvu pole zvolte dále ze seznamu <em>Operátory &amp; Speciální hodnoty</em> porovnávací operátor. Jsou to "=, !=, < > <=, >=, obsahuje, zaèíná na, konèí na". Operátor
		zkopírujte do pravé èásti pøeta¾ením nebo dvojklikem na název operátora.</p>

		<p>Pøíkaz zakonèete výbìrem pole nebo hodnoty pro porovnání s va¹ím pùvodním polem. Mù¾ete také zvolit nìkterou ze speciálních hodnot: <em>Aktuální mìsíc, aktuální rok</em> nebo
		<em>aktuální den</em>. Chcete-li vybrat hodnotu konstantního øetìzce, zadejte do pole <em>Konstantní øetìzec</em> hodnotu øetìzce bez uvozovek a kliknìte na sousední tlaèítko <em>>></em>.
		Chcete-li pøidat prázdný øetìzec, nechte pøed kliknutím na toto tlaèítko pole prázdné. Pokud chcete zvolit hodnotu èíselné konstanty, zadejte do pole <em>Èíselná konstanta</em> èíslo a kliknìte na sousední
		tlaèítko <em>>></em>.</p>

		<p>Odstranit jakoukoli polo¾ku z pravé èásti mù¾ete dvojklikem na polo¾ku.
		Chcete-li zmìnit poøadí polo¾ek v seznamu, vyberte polo¾ku a pøesuòte ji nahoru nebo dolù kliknutím na tlaèítka <em>Posunout nahoru</em> nebo <em>Posunout dolù</em>.</p>

		<span class="optionhead">Vybrat tøídìní</span>
		<p>Výbìrem jednoho nebo více polí urèíte, jak mají být odpovídající záznamy tøídìny.
		Pokud nelze urèit poøadí záznamù podle prvního pole v seznamu, bude pou¾ito druhé pole ze seznamu, a tak dále. Není-li urèeno ¾ádné tøídìní, odpovídající
		záznamy budou zobrazeny v poøadí, v jakém byly pøidány do databáze.
		Pole, podle kterých má být tøídìno, pøeta¾ením z levého pole doprava nebo kliknutím na název pole.</p>

		<p>V¹echna pole se obvykle tøídí ve vzestupném poøadí (napø. A-Z nebo 0-9). Chcete-li pole tøídit v sestupném poøadí, pou¾ijte pseudopole 'Sestupnì (Pøedchozí)'.
		Výraz 'Pøedchozí' v závorce znamená, ¾e tento výraz musí <i>následovat</i> za polem, které upravuje. Jinými slovy,
		pokud chcete tøídit podle Pøíjmení, zvolte va¹e tøídìni takto:<br/><br/>

		<i>Pøíjmení<br/>
		Sestupnì (Pøedchozí)</i></p>

		<span class="optionhead">Rùzné</span>
		<p>Odstranit jakoukoli polo¾ku z pravé èásti mù¾ete jejím výbìrem a kliknutím na tlaèítko <em><< Odstranit</em> nebo jednodu¹e dvojklikem na polo¾ku (pouze IE).
		Chcete-li zmìnit poøadí polo¾ek v seznamu, vyberte polo¾ku a pøesuòte ji nahoru nebo dolù kliknutím na tlaèítka <em>Posunout nahoru</em> nebo <em>Posunout dolù</em>.</p>

		<span class="optionhead">Vlastní SQL dotaz</span>
		<p>Pokud znáte SQL (structured query language) a znáte strukturu tabulek TNG, mù¾ete nechat oblasti Zobrazit, Kritéria a Tøídìní prázdná a místo toho zapsat do rámeèku na konci obrazovky pøímo
		SQL pøíkaz SELECT.</p>

    <span class="optionhead">Ulo¾it + Konec vs. Ulo¾it + Zùstat</span>
		<p>Chcete-li report ulo¾it, kliknite na "Ulo¾it + Konec" a zùstanete na stejné stránce a mù¾ete pokraèovat v editaci. Kliknutím na "Ulo¾it + Zùstat" report ulo¾íte a vrátíte se na menu Reporty.</p>

		<p>Nìkolik vzorových reportù mù¾ete vidìt na <a href="https://lythgoes.net/genealogy/demo.php" target="_blank">https://lythgoes.net/genealogy/demo.php</a>. Zvolte zde Administrative Demo a vyhledejte sekci Reporty.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání reportu</p></a>
		<p>Chcete-li odstranit report, pou¾ijte zálo¾ku <a href="#search">Hledat</a> k nalezení reportu, a poté kliknìte na ikonku Vymazat vedle tohoto záznamu. Tento øádek zmìní
		barvu a poté po odstranìní reportu zmizí.</p>

	</td>
</tr>

</table>
</body>
</html>
