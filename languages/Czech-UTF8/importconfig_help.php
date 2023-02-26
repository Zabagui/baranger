<?php
include("../../helplib.php");
echo help_header("Nápověda: Nastavení importu dat");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="logconfig_help.php" class="lightlink">&laquo; Nápověda: Nastavení protokolování</a> &nbsp; | &nbsp;
			<a href="mapconfig_help.php" class="lightlink">Nápověda: Nastavení mapy &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Nastavení importu dat</span>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  
		<span class="optionhead">Složka souboru GEDCOM (Import/Export)</span>
		<p>Název složky, ze které bude TNG importovat soubory GEDCOM a místo, kam bude TNG ukládat exportované soubory GEDCOM.</p>
    
		<p>Pozn.: Pro větší zabezpečení vašich souborů GEDCOM zaškrtněte políčko označené "Uložit v konfigurační cestě", aby TNG ponechalo soubory GEDCOM v tomto umístění. Složku GEDCOM musíte přesunout na toto místo sami před uložením této hodnoty nebo bezprostředně poté.</p>    

		<span class="optionhead">Počet záznamů reportu</span>
		<p>Toto je počet záznamů, které TNG provede mezi reporty na obrazovce. Aby váš import běžel rychleji, zadejte tento počet
		o něco vyšší (kolem čísla 100). Pokud váš import selže nebo lišta průběhu přestane ukazovat nějaký pokrok,
		budete muset toto číslo snížit, což způsobí, že TNG bude reportovat méně často a obrazovková paměť se bude plnit rychleji.</p>

		<span class="optionhead">Interval průběhu (ms)</span>
		<p>Jedná se o počet milisekund, kdy TNG přeruší testy, aby viděl, zda bylo reportováno více importovaných záznamů.</p>

		<span class="optionhead">Výchozí volba Nahrazení</span>
		<p>Toto ovlivní, která volba importu "Nahradit" bude vybrána jako výchozí na stránce importu.</p>

		<span class="optionhead">Pokud je 'Datum změny' prázdné</span>
		<p>Pokud váš záznam osoby, rodiny nebo pramene nemá připojeno datum poslední změny, které označuje, kdy byl záznam
		naposledy aktualizován, TNG tuto hodnotu naplní podle této volby. Můžete použít dnešní datum nebo toto pole
		nechat prázdné. Ponecháte-li je prázdné, toto pole nepřepíše existující datum změny.</p>

		<span class="optionhead">Pokud chybí datum narození, předpokládat, že</span>
		<p>TNG označí všechny příchozí záznamy osob jako žijící nebo ne. Pokud osoba nemá datum úmrtí nebo pohřbu nebo místo,
		toto označení bude založeno na době, která uplynula od narození osoby. Pokud tato osoba nemá datum narození,
		TNG to může interpretovat různými způsoby. Vyberte, zda mají tyto osoby být označeny jako zesnulé nebo žijící.</p>

		<span class="optionhead">Pokud chybí datum úmrtí, předpokládat, že osoba zemřela, je-li starší než</span>
		<p>Pokud osoba nemá datum úmrtí nebo pohřbu nebo místo, označení Žijící bude založeno na době,
		která uplynula od narození osoby. Osoby mladší než věk označený v tomto poli budou považovány za žijící.
		Výchozí nastavení maximálního věku pro žijící osoby je 110 let.</p>

		<span class="optionhead">Osoba je neveřejná, pokud zemřela před méně než tolika lety</span>
		<p>TNG nastaví u osoby během importu označení Neveřejné, pokud tato osoba zemřela před méně než tolika lety. Toto pole
		nechte prázdné nebo jej nastavte na hodnotu 0, nechcete-li označení Neveřejné nastavovat tímto způsobem.</p>
    
    <span class="optionhead">Osoba je žijící, pokud zemřela před méně než tolika lety</span>
		<p>Podobně jako v předchozí volbě nastaví TNG během importu souboru GEDCOM označení Žijící u osoby, pokud zemřela před méně než tolika lety. 
    Toto pole nechte prázdné nebo jej nastavte na hodnotu 0, nechcete-li označení Žijící nastavovat tímto způsobem.</p>

		<span class="optionhead">Rodina je žijící, pokud je pár sezdán méně než tento počet let</span>
		<p>TNG nastaví u rodiny během importu označení Žijící, pokud ke sňatku došlo před méně než tolika lety. 
    Toto pole nechte prázdné nebo jej nastavte na hodnotu 0, nechcete-li označení Žijící nastavovat tímto způsobem.</p>
    
		<span class="optionhead">Vkládaná média</span>
		<p>Pokud zaškrtnete políčko "Nechat TNG pojmenovat vkládaná média", TNG bude ignorovat umístění a názvy souborů spojených s vašimi vkládanými médii a připojí
		nový název souboru založený na konvenci ID číslo stromu + ID číslo média + přípona média. Tento soubor pak bude uložen do složky fotografií (jak je definováno v Základním nastavení).
		Tuto volbu můžete vybrat, pokud jste importovali vkládaná média již dříve, protože TNG tuto konvenci používal jako výchozí před verzí 3.4.0. Pokud jste 
		názvy dříve importovaných médií pojmenovali pomocí TNG a nyní importujete názvy médií bez této vybrané volby, budete mít duplicitní soubory.</p>

		<span class="optionhead">Lokální umístění souborů fotografií</span>
		<p>Zapište základní umístění (více záznamů oddělujte čárkou), kde jsou na vašem počítači umístěny fotografie. Mělo by to odpovídat TNG složce fotografií
		na vašich webových stránkách. Jinými slovy, pokud jsou fotografie na vašem počítači umístěny "C:\MyGenealogy\MyPhotos", měli byste toto umístění zadat sem. Pokud odkazy některých fotografií
		ukazují na toto místo relativně (např. pouze "MyPhotos"), zadejte relativní cestu jako více vstupů. Pokud se některé fotografie
		nacházejí v podsložkách tohoto umístění a tuto strukturu chcete na vašem webu zachovat, nevkládejte do tohoto umístění podsložky. Pokud chcete, aby všechny fotografie byly ve stejném umístění
		(TNG složka Photos), nechte toto pole prázdné a zaškrtněte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Lokální umístění souborů vyprávění</span>
    <p>Zapište základní umístění (více záznamů oddělujte čárkou), kde jsou na vašem počítači umístěna vyprávění. Mělo by to odpovídat TNG složce vyprávění
		na vašich webových stránkách. Jinými slovy, pokud jsou vyprávění na vašem počítači umístěna "C:\MyGenealogy\MyHistories", měli byste toto umístění zadat sem. Pokud odkazy některých vyprávění
		ukazují na toto místo relativně (např. pouze "MyHistories"), zadejte relativní cestu jako více vstupů. Pokud se některá vyprávění
		nacházejí v podsložkách tohoto umístění a tuto strukturu chcete na vašem webu zachovat, nevkládejte do tohoto umístění podsložky. Pokud chcete, aby všechna vyprávění byla ve stejném umístění
		(TNG složka Histories), nechte toto pole prázdné a zaškrtněte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Lokální umístění souborů dokumentů</span>
    <p>Zapište základní umístění (více záznamů oddělujte čárkou), kde jsou na vašem počítači umístěny dokumenty. Mělo by to odpovídat TNG složce dokumentů
		na vašich webových stránkách. Jinými slovy, pokud jsou dokumenty na vašem počítači umístěny "C:\MyGenealogy\MyDocuments", měli byste toto umístění zadat sem. Pokud odkazy některých dokumentů
		ukazují na toto místo relativně (např. pouze "MyDocuments"), zadejte relativní cestu jako více vstupů. Pokud se některé dokumenty
		nacházejí v podsložkách tohoto umístění a tuto strukturu chcete na vašem webu zachovat, nevkládejte do tohoto umístění podsložky. Pokud chcete, aby všechny dokumenty byly ve stejném umístění
		(TNG složka Documents), nechte toto pole prázdné a zaškrtněte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Lokální umístění souborů náhrobků</span>
    <p>Zapište základní umístění (více záznamů oddělujte čárkou), kde jsou na vašem počítači umístěny náhrobky. Mělo by to odpovídat TNG složce náhrobků
		na vašich webových stránkách. Jinými slovy, pokud jsou náhrobky na vašem počítači umístěny "C:\MyGenealogy\MyHeadstones", měli byste toto umístění zadat sem. Pokud odkazy některých náhrobků
		ukazují na toto místo relativně (např. pouze "MyHeadstones"), zadejte relativní cestu jako více vstupů. Pokud se některé náhrobky
		nacházejí v podsložkách tohoto umístění a tuto strukturu chcete na vašem webu zachovat, nevkládejte do tohoto umístění podsložky. Pokud chcete, aby všechny náhrobky byly ve stejném umístění
		(TNG složka Headstones), nechte toto pole prázdné a zaškrtněte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Lokální umístění souborů ostatních médií</span>
    <p>Zapište základní umístění (více záznamů oddělujte čárkou), kde jsou na vašem počítači umístěny ostatní média (např. videa nebo zvukové záznamy). Mělo by to odpovídat TNG složce multimédií
		na vašich webových stránkách. Jinými slovy, pokud jsou videa nebo zvukové záznamy na vašem počítači umístěny "C:\MyGenealogy\MyMultimedia", měli byste toto umístění zadat sem. Pokud odkazy některých multimédií
		ukazují na toto místo relativně (např. pouze "MyMultimedia"), zadejte relativní cestu jako více vstupů. Pokud se některá videa nebo zvukové záznamy
		nacházejí v podsložkách tohoto umístění a tuto strukturu chcete na vašem webu zachovat, nevkládejte do tohoto umístění podsložky. Pokud chcete, aby všechna videa nebo zvukové záznamy byla ve stejném umístění
		(TNG složka Multimedia), nechte toto pole prázdné a zaškrtněte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Pokud lokální umístění neodpovídá</span>
		<p>Pokud je importována fotografie nebo vyprávění a umístění souboru neodpovídá ani jednomu z lokálních umístění označených výše, TNG může buď importovat celé umístění "tak, jak je" (doporučeno, pokud
		jsou všechna vaše umístění relativní a chcete, aby vaše lokální struktura odpovídala vaší TNG struktuře složek fotografií/vyprávění) nebo může oříznout údaj o umístění pouze na název souboru
		(doporučeno, pokud nechcete, aby byla vaše média vložena do podsložek TNG složek Photos nebo Histories).</p>

		<span class="optionhead">Předpona pro neveřejné poznámky</span>
		<p>Pokud chcete, aby byly některé vaše poznámky při importu označeny jako "neveřejné" a nebyly zobrazeny ve veřejné oblasti, TNG tak může učinit, pokud všechny
		poznámky, které mají tomuto popisu odpovídat, začínají stejným znakem. Pro tyto účely se obvykle používá znak tilda (~) nebo vykřičník (!).
		Před importem vašeho souboru GEDCOM sem zapište znak, který pro tyto účely používáte a automaticky bude připojeno označení "neveřejné".</p>

		<span class="optionhead">Změnit příchozí předpony tak, aby odpovídaly nastavení TNG</span>
		<p>Pokud obdržíte soubor GEDCOM z jiného zdroje, je možné, že soubor může obsahovat ID s různými předponami nebo příponami ID. 
    Chcete-li, aby TNG standardizovala příchozí ID tak, aby předpony odpovídaly vašemu nastavení, zapněte tuto možnost.</p>

	</td>
</tr>

</table>
</body>
</html>
