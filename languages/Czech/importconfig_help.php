<?php
include("../../helplib.php");
echo help_header("Nápovìda: Nastavení importu dat");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="logconfig_help.php" class="lightlink">&laquo; Nápovìda: Nastavení protokolování</a> &nbsp; | &nbsp;
			<a href="mapconfig_help.php" class="lightlink">Nápovìda: Nastavení mapy &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Nastavení importu dat</span>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  
		<span class="optionhead">Slo¾ka souboru GEDCOM (Import/Export)</span>
		<p>Název slo¾ky, ze které bude TNG importovat soubory GEDCOM a místo, kam bude TNG ukládat exportované soubory GEDCOM.</p>
    
		<p>Pozn.: Pro vìt¹í zabezpeèení va¹ich souborù GEDCOM za¹krtnìte políèko oznaèené "Ulo¾it v konfiguraèní cestì", aby TNG ponechalo soubory GEDCOM v tomto umístìní. Slo¾ku GEDCOM musíte pøesunout na toto místo sami pøed ulo¾ením této hodnoty nebo bezprostøednì poté.</p>    

		<span class="optionhead">Poèet záznamù reportu</span>
		<p>Toto je poèet záznamù, které TNG provede mezi reporty na obrazovce. Aby vá¹ import bì¾el rychleji, zadejte tento poèet
		o nìco vy¹¹í (kolem èísla 100). Pokud vá¹ import sel¾e nebo li¹ta prùbìhu pøestane ukazovat nìjaký pokrok,
		budete muset toto èíslo sní¾it, co¾ zpùsobí, ¾e TNG bude reportovat ménì èasto a obrazovková pamì» se bude plnit rychleji.</p>

		<span class="optionhead">Interval prùbìhu (ms)</span>
		<p>Jedná se o poèet milisekund, kdy TNG pøeru¹í testy, aby vidìl, zda bylo reportováno více importovaných záznamù.</p>

		<span class="optionhead">Výchozí volba Nahrazení</span>
		<p>Toto ovlivní, která volba importu "Nahradit" bude vybrána jako výchozí na stránce importu.</p>

		<span class="optionhead">Pokud je 'Datum zmìny' prázdné</span>
		<p>Pokud vá¹ záznam osoby, rodiny nebo pramene nemá pøipojeno datum poslední zmìny, které oznaèuje, kdy byl záznam
		naposledy aktualizován, TNG tuto hodnotu naplní podle této volby. Mù¾ete pou¾ít dne¹ní datum nebo toto pole
		nechat prázdné. Ponecháte-li je prázdné, toto pole nepøepí¹e existující datum zmìny.</p>

		<span class="optionhead">Pokud chybí datum narození, pøedpokládat, ¾e</span>
		<p>TNG oznaèí v¹echny pøíchozí záznamy osob jako ¾ijící nebo ne. Pokud osoba nemá datum úmrtí nebo pohøbu nebo místo,
		toto oznaèení bude zalo¾eno na dobì, která uplynula od narození osoby. Pokud tato osoba nemá datum narození,
		TNG to mù¾e interpretovat rùznými zpùsoby. Vyberte, zda mají tyto osoby být oznaèeny jako zesnulé nebo ¾ijící.</p>

		<span class="optionhead">Pokud chybí datum úmrtí, pøedpokládat, ¾e osoba zemøela, je-li star¹í ne¾</span>
		<p>Pokud osoba nemá datum úmrtí nebo pohøbu nebo místo, oznaèení ®ijící bude zalo¾eno na dobì,
		která uplynula od narození osoby. Osoby mlad¹í ne¾ vìk oznaèený v tomto poli budou pova¾ovány za ¾ijící.
		Výchozí nastavení maximálního vìku pro ¾ijící osoby je 110 let.</p>

		<span class="optionhead">Osoba je neveøejná, pokud zemøela pøed ménì ne¾ tolika lety</span>
		<p>TNG nastaví u osoby bìhem importu oznaèení Neveøejné, pokud tato osoba zemøela pøed ménì ne¾ tolika lety. Toto pole
		nechte prázdné nebo jej nastavte na hodnotu 0, nechcete-li oznaèení Neveøejné nastavovat tímto zpùsobem.</p>
    
    <span class="optionhead">Osoba je ¾ijící, pokud zemøela pøed ménì ne¾ tolika lety</span>
		<p>Podobnì jako v pøedchozí volbì nastaví TNG bìhem importu souboru GEDCOM oznaèení ®ijící u osoby, pokud zemøela pøed ménì ne¾ tolika lety. 
    Toto pole nechte prázdné nebo jej nastavte na hodnotu 0, nechcete-li oznaèení ®ijící nastavovat tímto zpùsobem.</p>

		<span class="optionhead">Rodina je ¾ijící, pokud je pár sezdán ménì ne¾ tento poèet let</span>
		<p>TNG nastaví u rodiny bìhem importu oznaèení ®ijící, pokud ke sòatku do¹lo pøed ménì ne¾ tolika lety. 
    Toto pole nechte prázdné nebo jej nastavte na hodnotu 0, nechcete-li oznaèení ®ijící nastavovat tímto zpùsobem.</p>
    
		<span class="optionhead">Vkládaná média</span>
		<p>Pokud za¹krtnete políèko "Nechat TNG pojmenovat vkládaná média", TNG bude ignorovat umístìní a názvy souborù spojených s va¹imi vkládanými médii a pøipojí
		nový název souboru zalo¾ený na konvenci ID èíslo stromu + ID èíslo média + pøípona média. Tento soubor pak bude ulo¾en do slo¾ky fotografií (jak je definováno v Základním nastavení).
		Tuto volbu mù¾ete vybrat, pokud jste importovali vkládaná média ji¾ døíve, proto¾e TNG tuto konvenci pou¾íval jako výchozí pøed verzí 3.4.0. Pokud jste 
		názvy døíve importovaných médií pojmenovali pomocí TNG a nyní importujete názvy médií bez této vybrané volby, budete mít duplicitní soubory.</p>

		<span class="optionhead">Lokální umístìní souborù fotografií</span>
		<p>Zapi¹te základní umístìní (více záznamù oddìlujte èárkou), kde jsou na va¹em poèítaèi umístìny fotografie. Mìlo by to odpovídat TNG slo¾ce fotografií
		na va¹ich webových stránkách. Jinými slovy, pokud jsou fotografie na va¹em poèítaèi umístìny "C:\MyGenealogy\MyPhotos", mìli byste toto umístìní zadat sem. Pokud odkazy nìkterých fotografií
		ukazují na toto místo relativnì (napø. pouze "MyPhotos"), zadejte relativní cestu jako více vstupù. Pokud se nìkteré fotografie
		nacházejí v podslo¾kách tohoto umístìní a tuto strukturu chcete na va¹em webu zachovat, nevkládejte do tohoto umístìní podslo¾ky. Pokud chcete, aby v¹echny fotografie byly ve stejném umístìní
		(TNG slo¾ka Photos), nechte toto pole prázdné a za¹krtnìte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Lokální umístìní souborù vyprávìní</span>
    <p>Zapi¹te základní umístìní (více záznamù oddìlujte èárkou), kde jsou na va¹em poèítaèi umístìna vyprávìní. Mìlo by to odpovídat TNG slo¾ce vyprávìní
		na va¹ich webových stránkách. Jinými slovy, pokud jsou vyprávìní na va¹em poèítaèi umístìna "C:\MyGenealogy\MyHistories", mìli byste toto umístìní zadat sem. Pokud odkazy nìkterých vyprávìní
		ukazují na toto místo relativnì (napø. pouze "MyHistories"), zadejte relativní cestu jako více vstupù. Pokud se nìkterá vyprávìní
		nacházejí v podslo¾kách tohoto umístìní a tuto strukturu chcete na va¹em webu zachovat, nevkládejte do tohoto umístìní podslo¾ky. Pokud chcete, aby v¹echna vyprávìní byla ve stejném umístìní
		(TNG slo¾ka Histories), nechte toto pole prázdné a za¹krtnìte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Lokální umístìní souborù dokumentù</span>
    <p>Zapi¹te základní umístìní (více záznamù oddìlujte èárkou), kde jsou na va¹em poèítaèi umístìny dokumenty. Mìlo by to odpovídat TNG slo¾ce dokumentù
		na va¹ich webových stránkách. Jinými slovy, pokud jsou dokumenty na va¹em poèítaèi umístìny "C:\MyGenealogy\MyDocuments", mìli byste toto umístìní zadat sem. Pokud odkazy nìkterých dokumentù
		ukazují na toto místo relativnì (napø. pouze "MyDocuments"), zadejte relativní cestu jako více vstupù. Pokud se nìkteré dokumenty
		nacházejí v podslo¾kách tohoto umístìní a tuto strukturu chcete na va¹em webu zachovat, nevkládejte do tohoto umístìní podslo¾ky. Pokud chcete, aby v¹echny dokumenty byly ve stejném umístìní
		(TNG slo¾ka Documents), nechte toto pole prázdné a za¹krtnìte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Lokální umístìní souborù náhrobkù</span>
    <p>Zapi¹te základní umístìní (více záznamù oddìlujte èárkou), kde jsou na va¹em poèítaèi umístìny náhrobky. Mìlo by to odpovídat TNG slo¾ce náhrobkù
		na va¹ich webových stránkách. Jinými slovy, pokud jsou náhrobky na va¹em poèítaèi umístìny "C:\MyGenealogy\MyHeadstones", mìli byste toto umístìní zadat sem. Pokud odkazy nìkterých náhrobkù
		ukazují na toto místo relativnì (napø. pouze "MyHeadstones"), zadejte relativní cestu jako více vstupù. Pokud se nìkteré náhrobky
		nacházejí v podslo¾kách tohoto umístìní a tuto strukturu chcete na va¹em webu zachovat, nevkládejte do tohoto umístìní podslo¾ky. Pokud chcete, aby v¹echny náhrobky byly ve stejném umístìní
		(TNG slo¾ka Headstones), nechte toto pole prázdné a za¹krtnìte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Lokální umístìní souborù ostatních médií</span>
    <p>Zapi¹te základní umístìní (více záznamù oddìlujte èárkou), kde jsou na va¹em poèítaèi umístìny ostatní média (napø. videa nebo zvukové záznamy). Mìlo by to odpovídat TNG slo¾ce multimédií
		na va¹ich webových stránkách. Jinými slovy, pokud jsou videa nebo zvukové záznamy na va¹em poèítaèi umístìny "C:\MyGenealogy\MyMultimedia", mìli byste toto umístìní zadat sem. Pokud odkazy nìkterých multimédií
		ukazují na toto místo relativnì (napø. pouze "MyMultimedia"), zadejte relativní cestu jako více vstupù. Pokud se nìkterá videa nebo zvukové záznamy
		nacházejí v podslo¾kách tohoto umístìní a tuto strukturu chcete na va¹em webu zachovat, nevkládejte do tohoto umístìní podslo¾ky. Pokud chcete, aby v¹echna videa nebo zvukové záznamy byla ve stejném umístìní
		(TNG slo¾ka Multimedia), nechte toto pole prázdné a za¹krtnìte "Importovat pouze název souboru" jako poslední volbu na této stránce.</p>

		<span class="optionhead">Pokud lokální umístìní neodpovídá</span>
		<p>Pokud je importována fotografie nebo vyprávìní a umístìní souboru neodpovídá ani jednomu z lokálních umístìní oznaèených vý¹e, TNG mù¾e buï importovat celé umístìní "tak, jak je" (doporuèeno, pokud
		jsou v¹echna va¹e umístìní relativní a chcete, aby va¹e lokální struktura odpovídala va¹í TNG struktuøe slo¾ek fotografií/vyprávìní) nebo mù¾e oøíznout údaj o umístìní pouze na název souboru
		(doporuèeno, pokud nechcete, aby byla va¹e média vlo¾ena do podslo¾ek TNG slo¾ek Photos nebo Histories).</p>

		<span class="optionhead">Pøedpona pro neveøejné poznámky</span>
		<p>Pokud chcete, aby byly nìkteré va¹e poznámky pøi importu oznaèeny jako "neveøejné" a nebyly zobrazeny ve veøejné oblasti, TNG tak mù¾e uèinit, pokud v¹echny
		poznámky, které mají tomuto popisu odpovídat, zaèínají stejným znakem. Pro tyto úèely se obvykle pou¾ívá znak tilda (~) nebo vykøièník (!).
		Pøed importem va¹eho souboru GEDCOM sem zapi¹te znak, který pro tyto úèely pou¾íváte a automaticky bude pøipojeno oznaèení "neveøejné".</p>

		<span class="optionhead">Zmìnit pøíchozí pøedpony tak, aby odpovídaly nastavení TNG</span>
		<p>Pokud obdr¾íte soubor GEDCOM z jiného zdroje, je mo¾né, ¾e soubor mù¾e obsahovat ID s rùznými pøedponami nebo pøíponami ID. 
    Chcete-li, aby TNG standardizovala pøíchozí ID tak, aby pøedpony odpovídaly va¹emu nastavení, zapnìte tuto mo¾nost.</p>

	</td>
</tr>

</table>
</body>
</html>
