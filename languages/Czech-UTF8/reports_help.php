<?php
include("../../helplib.php");
echo help_header("Nápověda: Reporty");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="eventtypes_help.php" class="lightlink">&laquo; Nápověda: Typy událostí / atributů</a> &nbsp; | &nbsp;
			<a href="dna_help.php" class="lightlink">Nápověda: Testy DNA &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Reporty</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nebo upravit</a> &nbsp; | &nbsp;
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

    <p>Nalezení existujících reportů vyhledáním celého nebo části <strong>názvu reportu</strong> nebo <strong>popisu</strong>.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech reportů ve vaší databázi.</p>

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
		<a name="add"><p class="subheadbold">Přidání nebo úprava reportu</p></a>

		<p>Reportem se v TNG rozumí uživatelský seznam osob z vaší databáze. Vy rozhodnete, která pole mají být zobrazena, které osoby mají být do reportu vloženy a jak mají být seřazeny.
		Můžete použít rozhraní pro tvorbu reportů nebo můžete místo toho použít své vlastní příkazy SQL.</p>

		<p>Chcete-li přidat nový report, klikněte na záložku <strong>Přidat nový</strong> a poté vyplňte formulář. <p>Chcete-li upravit existující report, použijte
    záložku <a href="#search">Hledat</a> pro nalezení reportu, a poté klikněte na ikonu Upravit vedle tohoto řádku.</p>
    Význam jednotlivých polí při přidání nebo úpravě reportu je následující:</p>

		<span class="optionhead">Název reportu</span>
		<p>Svému reportu musíte dát název. Při zobrazení reportu se objeví jako jeho titul.</p>

		<span class="optionhead">Popis</span>
		<p>Svůj report stručně popište. Tento popis se objeví při zobrazení reportu pod titulem. Popis by měl stručně vysvětlit, co report zobrazuje a při
		použití jakých kritérií.</p>

		<span class="optionhead">Pořadí/Priorita</span>
		<p>Reporty budou tříděny alfabeticky podle názvu, pokud každému nepřidělíte pořadí nebo prioritu. Nejdříve se řadí nižší čísla. Prázdné pořadí se dostane před číslo.</p>

		<span class="optionhead">Aktivní</span>
		<p>Váš nový report nebude na stránkách návštěvníků viditelný, dokud jej neoznačíte zde jako aktivní. Je dobré před aktivací nový report uložit a otestovat, zda pracuje tak, jak chcete.</p>

		<span class="optionhead">Zvolte pole pro zobrazení</span>
		<p>Zkopírováním z levé části do pravé určíte, která pole chcete ve svém reportu zobrazit. Provést to můžete
		přetažením pole z levé části doprava nebo jednoduše dvojitým kliknutím na název pole.</p>

		<p>Pole můžete odstranit ze seznamu zobrazení vpravo dvojitým kliknutím na název pole.</p>

		<p>Pole, která jsou v seznamu zobrazení nahoře, budou v reportu zobrazena nalevo. Změnit pořadí zobrazovaných polí
		můžete kliknutím a podržením pole v pravé části a přetáhnutím v seznamu nahoru nebo dolů.</p>

		<span class="optionhead">Vyberte kritéria</span>
		<p>Volbou kritérií označte osoby, které chcete vložit do svého reportu. Osoby, které kritériím neodpovídají, v reportu nebudou obsaženy. Příkazy pro kritéria jsou
		dobře zformulovány, když obsahují název pole a podmínku. Např. "Příjmení = 'Novák' " nebo "Místo narození obsahuje 'Olomouc' ". Více kritérií musí být spojeno příkazy A nebo
		NE. Pořadí je indikováno pomocí závorek.</p>
    
		<p>Příkaz začněte výběrem názvu pole z horního levého rámce a přidejte jej do pravého rámce. Provést to můžete
		výběrem pole a kliknutím na sousední tlačítko <em>Přidat >></em> nebo jednoduše dvojklikem na název pole (pouze IE).</p>
    
		<p>Jakýkoli příkaz začněte výběrem názvu pole z levé horního části a jeho přetažením do pravé části. Můžete také dvakrát kliknout na název pole.</p>    

		<p><strong>POZN.</strong>: Všechna datová pole mimo Datum poslední aktualizace se chovají jako řetězce a ne jako
		skutečná data POKUD NEJSOU označena jako 'True'. Porovnání dat, které používají textová nebo řetězcová pole, se nejlépe provede porovnáním komponent data,
		jako je pouze rok nebo pouze den. Chcete-li tímto způsobem izolovat komponentu data, vyberte nejdříve  <em>Měsíc pouze</em>,
		<em>Den pouze</em> nebo <em>Rok pouze</em>, a pak vyberte pole data, ze kterého tato komponenta pochází.</p>

		<p>Při práci se skutečnými datovými poli (jako Datum poslední aktualizace) můžete porovnat pole přímo s jiným skutečným datem
		nebo skutečnými datovými poli. Předdefinované skutečné datum, které můžete použít jako operátor, je 'Dnes'. Při porovnávání dvou skutečných dat můžete také použít 
    operátor 'Převést na dny'. Např. pro nalezení všech záznamů, u kterých je Datum poslední aktualizace menší než 30 dní,
		můžete zvolit toto kritérium:<br/><br/>

		<i>Převést na dny<br/>
		Dnes (true)<br/>
		-<br/>
		Převést na dny<br/>
		Datum poslední aktualizace<br/>
		<=<br/>
		30</i></p>

		<p>Po výběru názvu pole zvolte dále ze seznamu <em>Operátory &amp; Speciální hodnoty</em> porovnávací operátor. Jsou to "=, !=, < > <=, >=, obsahuje, začíná na, končí na". Operátor
		zkopírujte do pravé části přetažením nebo dvojklikem na název operátora.</p>

		<p>Příkaz zakončete výběrem pole nebo hodnoty pro porovnání s vaším původním polem. Můžete také zvolit některou ze speciálních hodnot: <em>Aktuální měsíc, aktuální rok</em> nebo
		<em>aktuální den</em>. Chcete-li vybrat hodnotu konstantního řetězce, zadejte do pole <em>Konstantní řetězec</em> hodnotu řetězce bez uvozovek a klikněte na sousední tlačítko <em>>></em>.
		Chcete-li přidat prázdný řetězec, nechte před kliknutím na toto tlačítko pole prázdné. Pokud chcete zvolit hodnotu číselné konstanty, zadejte do pole <em>Číselná konstanta</em> číslo a klikněte na sousední
		tlačítko <em>>></em>.</p>

		<p>Odstranit jakoukoli položku z pravé části můžete dvojklikem na položku.
		Chcete-li změnit pořadí položek v seznamu, vyberte položku a přesuňte ji nahoru nebo dolů kliknutím na tlačítka <em>Posunout nahoru</em> nebo <em>Posunout dolů</em>.</p>

		<span class="optionhead">Vybrat třídění</span>
		<p>Výběrem jednoho nebo více polí určíte, jak mají být odpovídající záznamy tříděny.
		Pokud nelze určit pořadí záznamů podle prvního pole v seznamu, bude použito druhé pole ze seznamu, a tak dále. Není-li určeno žádné třídění, odpovídající
		záznamy budou zobrazeny v pořadí, v jakém byly přidány do databáze.
		Pole, podle kterých má být tříděno, přetažením z levého pole doprava nebo kliknutím na název pole.</p>

		<p>Všechna pole se obvykle třídí ve vzestupném pořadí (např. A-Z nebo 0-9). Chcete-li pole třídit v sestupném pořadí, použijte pseudopole 'Sestupně (Předchozí)'.
		Výraz 'Předchozí' v závorce znamená, že tento výraz musí <i>následovat</i> za polem, které upravuje. Jinými slovy,
		pokud chcete třídit podle Příjmení, zvolte vaše tříděni takto:<br/><br/>

		<i>Příjmení<br/>
		Sestupně (Předchozí)</i></p>

		<span class="optionhead">Různé</span>
		<p>Odstranit jakoukoli položku z pravé části můžete jejím výběrem a kliknutím na tlačítko <em><< Odstranit</em> nebo jednoduše dvojklikem na položku (pouze IE).
		Chcete-li změnit pořadí položek v seznamu, vyberte položku a přesuňte ji nahoru nebo dolů kliknutím na tlačítka <em>Posunout nahoru</em> nebo <em>Posunout dolů</em>.</p>

		<span class="optionhead">Vlastní SQL dotaz</span>
		<p>Pokud znáte SQL (structured query language) a znáte strukturu tabulek TNG, můžete nechat oblasti Zobrazit, Kritéria a Třídění prázdná a místo toho zapsat do rámečku na konci obrazovky přímo
		SQL příkaz SELECT.</p>

    <span class="optionhead">Uložit + Konec vs. Uložit + Zůstat</span>
		<p>Chcete-li report uložit, kliknìte na "Uložit + Konec" a zůstanete na stejné stránce a můžete pokračovat v editaci. Kliknutím na "Uložit + Zůstat" report uložíte a vrátíte se na menu Reporty.</p>

		<p>Několik vzorových reportů můžete vidět na <a href="https://lythgoes.net/genealogy/demo.php" target="_blank">https://lythgoes.net/genealogy/demo.php</a>. Zvolte zde Administrative Demo a vyhledejte sekci Reporty.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání reportu</p></a>
		<p>Chcete-li odstranit report, použijte záložku <a href="#search">Hledat</a> k nalezení reportu, a poté klikněte na ikonku Vymazat vedle tohoto záznamu. Tento řádek změní
		barvu a poté po odstranění reportu zmizí.</p>

	</td>
</tr>

</table>
</body>
</html>
