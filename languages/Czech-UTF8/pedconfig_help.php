<?php
include("../../helplib.php");
echo help_header("Nápověda: Nastavení schémat");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="config_help.php" class="lightlink">&laquo; Nápověda: Základní nastavení</a> &nbsp; | &nbsp;
			<a href="logconfig_help.php" class="lightlink">Nápověda: Nastavení protokolování &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Nastavení schémat</span>
		<p class="smaller menu">
			<a href="#ped" class="lightlink">Předkové</a> &nbsp; | &nbsp;
			<a href="#desc" class="lightlink">Potomci</a> &nbsp; | &nbsp;
			<a href="#rel" class="lightlink">Příbuzenské vztahy</a> &nbsp; | &nbsp;
			<a href="#time" class="lightlink">Časová osa</a> &nbsp; | &nbsp;
			<a href="#common" class="lightlink">Společné prvky</a> &nbsp; | &nbsp;
			<a href="#thumb" class="lightlink">Náhledy</a>
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
      
		<a name="ped"><p class="subheadbold">Předkové</p></a>

		<span class="optionhead">Výchozí zobrazení</span>
		<p>Pomocí této volby nastavíte výchozí formát schématu předků. Je-li vybráno Standardně, všechna data narození, sňatku a úmrtí/pohřbu
		(jsou-li k dispozici) budou vložena do skrytého vyskakovacího rámečku. Fotografie osoby bude zobrazena (pokud existuje). Tam, kde jsou data k dispozici,
    bude na středu pod spodním okrajem rámečků schématu umístěn obrazový soubor (např. ArrowDown.gif), a když je vyvolán vyskakovací rámeček, objeví se pod rámečkem schématu. 
    Kompaktní formát je podobný Standardnímu, ale velikost rámečku je výrazně zmenšena, a nejsou zobrazeny fotografie. Když je vybrán formát Rámeček,
		standardní údaje se vždy objeví v rámečcích schématu. Je-li vybrán Pouze text, bude nejprve zobrazena textová verze schématu předků (žádné rámečky ani vyskakovací okna).
		Volba Svisle zobrazí výchozí osobu dole a předkové osoby budou zobrazeni nad ní.
    Po zobrazení výchozího formátu má uživatel vždy možnost přepnout mezi jednotlivými typy.</p>

		<span class="optionhead">Maximální počet generací</span>
		<p>Maximální počet generací, které povolíte uživateli zobrazit najednou.</p>

		<span class="optionhead">Výchozí počet generací</span>
		<p>Počet generací, které budou zobrazeny na začátku. Není-li nic specifikováno, bude tato hodnota nastavena na 4.</p>

		<span class="optionhead">Partneři ve vyskakovacích oknech</span>
		<p>Používají-li se vyskakovací okna, zaškrtnutím této volby budou do vyskakovacích rámečků vloženy odkazy na partnery. Ve výchozím stavu není zaškrtnuto.</p>

		<span class="optionhead">Děti ve vyskakovacích oknech</span>
		<p>Používají-li se vyskakovací okna a volba Partneři ve vyskakovacích oknech je zaškrtnuta, zaškrtnutím této volby budou do vyskakovacích rámečků vloženy odkazy na děti. Ve výchozím stavu není zaškrtnuto.</p>

		<span class="optionhead">Odkazy na schémata ve vyskakovacích oknech</span>
		<p>Používají-li se vyskakovací okna (a volby Partneři nebo děti ve vyskakovacích oknech jsou zaškrtnuty), zaškrtnutím této volby budou do vyskakovacích rámečků vloženy odkazy na schémata partnerů a dětí.
		Ve výchozím stavu je zaškrtnuto.</p>

		<span class="optionhead">Skrýt prázdné rámečky</span>
		<p>Výběrem 'Ano' odstraníte ze schématu prázdné rámečky.</p>

		<span class="optionhead">Šířka rámečku (bez vyskakovacích oken)</span>
		<p>Pevná šířka všech rámečků schématu (v pixelech), nepoužívají-li se vyskakovací okna. Výchozí hodnota je 211. Bude-li zadání číslo menší než 21, bude použito 21.
		Použité číslo by mělo být vždy liché, takže bude-li vloženo sudé číslo, bude zvětšeno o 1.</p>

		<span class="optionhead">Výška rámečku (bez vyskakovacích oken)</span>
		<p>Výška všech rámečků schématu (v pixelech), nepoužívají-li se vyskakovací okna, jestliže není specifikované nenulové posunutí výšky rámečku (viz níže), v tomto případě je Výška rámečku
		výškou prvního rámečku ve schématu. Výchozí hodnota je 121. Bude-li zadání číslo menší než 21, bude použito 21. Použité číslo by mělo
		být vždy liché, takže bude-li vloženo sudé číslo, bude zvětšeno o 1.</p>

		<span class="optionhead">Zarovnání rámečku (bez vyskakovacích oken)</span>
		<p>Zarovnání údajů, které se objeví v zobrazeném vyskakovacím okně.
		Pozn.: Data a místa budou vždy zarovnána doleva, ale blok, který je obsahuje, bude zarovnán podle tohoto nastavení.</p>

		<span class="optionhead">Posunutí výšky rámečku (bez vyskakovacích oken)</span>
		<p>Hodnota, podle které by se měla výška rámečků schématu měnit u dalších generací (v pixelech), když se nepoužívají vyskakovací okna.
		Mělo by to být záporné číslo. Výchozí hodnota je -2. Je-li vložena hodnota 0, neobjeví se v rozměrech rámečku žádná změna.
		Použité číslo by mělo být vždy liché, takže bude-li vloženo sudé číslo, bude zvětšeno o 1.</p>
    
    <h3>Svislé schéma</h3>

		<span class="optionhead">Šířka rámečku</span>
		<p>Šířka rámečku se jménem v pixelech ve svislém schématu.</p>

		<span class="optionhead">Výška rámečku</span>
		<p>Výška rámečku se jménem v pixelech ve svislém schématu.</p>

		<span class="optionhead">Vzdálenost mezi rámečky</span>
		<p>Vodorovná vzdálenost v pixelech mezi rámečky se jmény.</p>

		<span class="optionhead">Velikost jména v rámečku</span>
		<p>Velikost písma (v bodech) u jmen zobrazených ve svislém schématu.</p>

    <h3>Vějířový graf</h3>
		<p>Některá nastavení zobrazení vějířového grafu (barvy, výška, typ a velikost písma, počet generací, zobrazení informačních rámečků) 
    lze provést v souboru <b>fan_config.php</b>, který se nachází ve složce TNG.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="desc"><p class="subheadbold">Potomci</p></a>

		<span class="optionhead">Výchozí zobrazení</span>
 		<p>Pomocí této volby nastavíte výchozí formát potomků. Je-li vybráno Standardně, všechna data narození, sňatku a úmrtí/pohřbu
		(jsou-li k dispozici) budou vložena do skrytého vyskakovacího rámečku. Fotografie osoby bude zobrazena (pokud existuje). Tam, kde jsou data k dispozici,
    bude na středu pod spodním okrajem rámečků schématu umístěn obrazový soubor (např. ArrowDown.gif), a když je vyvolán vyskakovací rámeček, objeví se pod rámečkem schématu. 
    Kompaktní formát je podobný Standardnímu, ale velikost rámečku je výrazně zmenšena, a nejsou zobrazeny fotografie. Je-li vybrán Pouze text, bude zobrazena textová 
    verze schématu potomků (žádné rámečky ani vyskakovací okna). Formát Registr zobrazí stejné informace ve stylu vyprávění.
		Po zobrazení výchozího formátu má uživatel vždy možnost přepnout mezi jednotlivými typy.</p>

   	<span class="optionhead">Maximální počet generací</span>
		<p>Maximální počet generací, které povolíte uživateli zobrazit najednou.</p>

		<span class="optionhead">Výchozí počet generací</span>
		<p>Počet generací, které budou zobrazeny na začátku. Není-li nic specifikováno, bude tato hodnota nastavena na 4.</p>

		<span class="optionhead">Spuštění schématu potomků</span>
		<p>Vyberte, zda chcete spustit schémata potomků založená na textu se všemi generacemi rozbalenými nebo sbalenými. Uživatel bude mít vždy možnost
		rodiny sbalit nebo rozbalit.</p>

		<span class="optionhead">Zobrazit poznámky a vlastní události v Registru</span>
		<p>Označuje, zda budou poznámky k osobě nebo rodině zobrazeny na stránce Registru.</p>

		<span class="optionhead">Generace v Registru</span>
		<p>Vyberte, zda chcete při zobrazení generace zobrazit všechny osoby nebo počet osob omezit výběrem "Odstranit osoby bez rodin".
    Podle této volby budou zobrazeny pouze osoby, když se objeví jako děti. Nebudou však zobrazeny znovu,
		když bude jejich celá generace popsána v reportu později.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="rel"><p class="subheadbold">Schéma spojení</p></a>
		<span class="optionhead">Maximální počet spuštění vyhledávání spojení</span>
		<p>Maximální počet spojení, které lze nalézt při vyhledávání. Nastavte mezi 1 a 9999. Všimněte si, že pouze některá vzácná spuštění vedou k zobrazení cesty. 
      Je-li nastaveno na 1, prohledává se pouze nejkratší cesta. Výchozí hodnota je 99.</p>

		<span class="optionhead">Maximální délka cest spojení</span>
		<p>Maximální počet kroků v každém spojení. Výchozí hodnota je 30.</p>

		<span class="optionhead">Zobrazit textový příkaz cesty</span>
		<p>Zvolte, zda se má ve výchozím nastavení nad grafickou prezentací zobrazovat textový popis každé cesty.</p>

		<span class="optionhead">Zobrazit rámečky osob v kompaktní podobě</span>
		<p>Zvolte, zda se má pole každé osoby zobrazit v minimalizované podobě, bez náhledových fotografií a některých zkrácených prvků celého jména. 
      Jinými slovy, pokud toto nastavíte na <i>Ne</i>, zobrazí se miniatury a celá jména. Pokud to nastavíte na <i>Ano</i>, diagram bude kompaktnější.</p>

		<span class="optionhead">Seřadit cesty podle</span>
		<p>Vyberte, zda budou nalezené cesty seřazeny podle délky, počtu sňatků nebo vůbec. Výchozí hodnota je délka.</p>

		<span class="optionhead">Anchor ID</span>
		<p>ID "Osoby 2", které bude použito k hledání spojení, dokud uživatel nevybere Osoba 2. POZNÁMKA: Mělo by to být platné ID ve stejném stromu jako Osoba 1. 
    Pokud je tento parametr prázdný a přihlášený uživatel je členem tohoto stromu, bude ID uživatele navrženo jako Osoba 2.</p>

		<span class="optionhead">Maximální počet manželství ve spojení</span>
		<p>Maximální počet manželství povolený v jakékoli cestě připojení. Pokud je tato hodnota překročena, je připojení ignorováno, aby se zabránilo 
    zobrazení příliš širokých diagramů.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="time"><p class="subheadbold">Schéma časové osy</p></a>
		<span class="optionhead">Výchozí šířka schématu</span>
		<p>Výchozí šířka schématu délky života v pixelech. Návštěvníci si mohou šířku změnit na horním okraji obrazovky.</p>

		<span class="optionhead">Povolit časovou linii Simile</span>
		<p>Výběrem volby "Ano" můžete vedle standardní časové linie TNG také na stejné stránce zobrazit schéma časové linie Simile. Více
		informací o schématu časové linie Simile můžete najít na <a href="http://www.simile-widgets.org/timeline/">http://www.simile-widgets.org/timeline/</a>.</p>

		<span class="optionhead">Výška schématu</span>
		<p>Výška časové osy událostí (Simile) v pixelech. Je-li zobrazeno mnoho událostí najednou, mohou být některé vytlačeny
		mimo viditelnou oblast schématu. Pokud se vám zdá, že se to stalo, mohlo by zvýšení této hodnoty pomoci.</p>

		<span class="optionhead">Které události zahrnout</span>
		<p>Ovlivní, které události budou v časové ose událostí zahrnuty. Můžete vybrat zobrazení všech událostí nebo jenom těch, které spadají
		do období života osob ve schématu. Pokud máte mnoho událostí, výběrem zobrazení všech může mít za následek,
		že se schéma poprvé zobrazí pomaleji.</p>

		<p>Pozn.: Pokud je najednou ve schématu příliš mnoho událostí, události na konci nebudou vidět. Máte-li mnoho událostí časové osy a toto je častým jevem,
		můžete uvažovat o zvětšení hodnoty výšky schématu (viz výše). Další možností nastavení jsou k dispozici v souboru <b>timelineconfig.php</b>, který se nachází ve složce TNG:</p>
    <p>
    $band1_pct = "10%"; (Horní pruh; jsou zde zobrazeny velmi malé čárky, hrubá úroveň zobrazení událostí rodiny (narození, křtu, manželství, narození dětí, atd...) Zabírá 10% celkové výšky.)<br>
    $band1_interval = 150; (Počet pixelů mezi jednotlivými značkami.)<br>
    $band1_multiple = 1; (Počet let mezi značkami. Pokud je hodnota 2, bude přeskočen každý druhý rok.)<br>

    $band2_pct = "28%"; (Druhý pruh. Ukazuje události rodiny podrobněji. Zabírá 28% celkové výšky.)<br>
    $band2_interval = 50; (Počet pixelů mezi jednotlivými značkami.)<br>
    $band2_multiple = 1; (Počet let mezi značkami. Pokud je hodnota 2, bude přeskočen každý druhý rok.)<br>

    $band3_pct = "47%"; (Třetí pruh. Ukazuje obecné události časové osy. Zabírá 47% celkové výšky.)<br>
    $band3_interval = 175; (Počet pixelů mezi jednotlivými značkami.)<br>
    $band3_multiple = 1;  (Počet let mezi značkami. Pokud je hodnota 2, bude přeskočen každý druhý rok.)<br>

    $band4_pct = "15%"; (Spodní pruh; jsou zde zobrazeny velmi malé čárky, hrubá úroveň zobrazení obecných událostí časové osy z pruhu 3. Zabírá 15% celkové výšky.)<br> 
    $band4_interval = 150; (Počet pixelů mezi jednotlivými značkami.)<br>
    $band4_multiple = 1;  (Počet let mezi značkami. Pokud je hodnota 2, bude přeskočen každý druhý rok.)<br>
    </p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="common"><p class="subheadbold">Společné prvky</p></a>

		<span class="optionhead">Odsazení zleva</span>
		<p>Vodorovný posun, který bude použit u celého schématu (v pixelech). Lze tím např. zajistit, aby schéma nepřekrývalo
		okraj obrázku, menu nebo textu, které by mohly být na levém okraji. Výchozí hodnota je 10. Zadáte-li zápornou hodnotu, bude použita 0.</p>

		<span class="optionhead">Velikost jména v rámečku</span>
		<p>Velikost (v bodech) všech jmen ve schématu. V žádném případě není možno snížit toto hodnotu na méně než
		7 bodů. Výchozí hodnota je 12.</p>

		<span class="optionhead">Velikost data v rámečku</span>
		<p>Velikost (v bodech) ostatních údajů ve schématu (data a místa). V žádném případě není možno snížit toto hodnotu na méně než
		7 bodů. Výchozí hodnota je 10.</p>

		<span class="optionhead">Barva rámečku</span>
		<p>Barva pozadí, která bude použita ve všech rámečcích schématu, pokud není specifikována nenulová hodnota Posunu barvy, v tomto případě je jedná o definici barvy
		pozadí prvního rámečku ve schématu. Výchozí hodnota je #CCCC99 (khaki; bílá je #FFFFFF).</p>

		<span class="optionhead">Posun barvy</span>
		<p>Hodnota v procentech, která definuje, jak by měla být hodnota barvy "posunuta" nahoru nebo dolů (k bílé nebo k černé) v rozsahu všech
		zobrazených generací. Zadaná hodnota by měla být mezi -100 a 100. Zadáte-li hodnotu 0, rámečky v celém schématu (mimo ty, které jsou prázdné &#151; viz Barva prázdných)
		budou mít stejnou barvu pozadí. Výchozí hodnota je 80, což znamená, že barva pozadí rámečku zeslábne o 80% proti původní barvě směrem k bílé tak, jak
		jsou rámečky zobrazeny od první generace k poslední (záporné hodnoty posunou barvu směrem k černé).</p>

		<span class="optionhead">Barva prázdných rámečků</span>
		<p>Barva pozadí, která bude použita ve všech rámečcích schématu, ve kterých nejsou žádné údaje. Výchozí hodnota je #CCCCCC (stříbrná).</p>

		<span class="optionhead">Barva okraje</span>
		<p>Barva, která bude použita na okraje rámečků a spojnice. Výchozí hodnota je #000000 (černá).</p>

		<span class="optionhead">Barva stínu</span>
		<p>Barva, která bude použita pro stíny. Výchozí hodnota je #999999 (šedá).</p>

		<span class="optionhead">Posun stínu</span>
		<p>Posun, který bude použit pro vložení stínu rámečku a spojnice (v pixelech). Záporné číslo bude mít za následek,
		že bude stín nahoře a vlevo od rámečků a linek. Kladné číslo způsobí, že bude stín dole a vpravo od rámečků a linek. Je-li zadaná hodnota 0,
		stíny se neobjeví (protože budou striktně pod rámečky a linkami). Výchozí hodnota je 4.</p>

		<span class="optionhead">Vodorovné oddělení rámečků</span>
		<p>Pevné vodorovné oddělení rámečků schématu mezi jednotlivými generacemi (v pixelech). Výchozí hodnota je 31. Pokud je zadaná hodnota
		menší než 7, bude použita 7. Použité číslo by mělo být vždy liché, takže bude-li vloženo sudé číslo, bude zvýšeno o 1.</p>

		<span class="optionhead">Svislé oddělení rámečků</span>
		<p>Svislé oddělení rámečků schématu mezi jednotlivými generacemi (v pixelech), pokud není specifikována nenulová hodnota Posunutí výšky rámečku, v tomto 
    případě bude Svislé oddělení rámečků pevným vodorovným oddělením rámečků schématu poslední zobrazené generace. Výchozí hodnota je 11. Pokud je zadaná hodnota
		menší než 7, bude použita 7. Použité číslo by mělo být vždy liché, takže bude-li vloženo sudé číslo, bude zvýšeno o 1. Bez ohledu na výše uvedené
		může být hodnota zvýšena, je-li to nutné pro zajištění více místa pro stíny a indikátory dalších informací.</p>

		<span class="optionhead">Výchozí velikost stránky PDF</span>
		<p>Velikost papíru, která bude použita ve všech výstupech do PDF (návštěvníci ji mohou změnit před vytvořením každého výstupu).</p>

		<span class="optionhead">Šířka čáry</span>
		<p>Šířka čáry spojující rámečky ve schématu (v pixelech). Výchozí hodnota je 1. Pokud je zadaná hodnota menší než 1, bude použita 1.</p>

		<span class="optionhead">Šířka okraje</span>
		<p>Šířka okraje kolem rámečku ve schématu (v pixelech). Výchozí hodnota je 1. Pokud je zadaná hodnota menší než 1, bude použita 1.</p>

		<span class="optionhead">Barva vyskakovacích oken</span>
		<p>Barva pozadí použitá ve vyskakovacích oknech. Pokud bude ponechána prázdná, bude použita barva, která bude posunuta o jednu barvu od barvy rámečku. Výchozí hodnota je #DDDDDD (světle šedá). </p>

		<span class="optionhead">Velikost textu ve vyskakovacích oknech</span>
		<p>Velikost (v bodech) ostatních údajů (data a místa) uvnitř vyskakovacích oken. V žádném případě není možno snížit toto hodnotu na méně než
		7 bodů. Výchozí hodnota je 10.</p>

		<span class="optionhead">Časové zdržení vyskakovacích oken</span>
		<p>Pokud se používají vyskakovací okna, jde o počet milisekund, po které zůstane vyskakovací okno viditelné. Výchozí hodnota je 500 (1/2 sekundy). Dobu zobrazení vyskakovacího okna
		mohou ovlivnit dvě podmínky. Za prvé, má-li se objevit další vyskakovací okno, musí to první viditelné zmizet. Za druhé, je-li kursor nad viditelným vyskakovacím oknem,
		zdržení, které je zde definováno, nebude použito, dokud se kursor nepřesune mimo vyskakovací okno. Znamená to, že vyskakovací okno lez podržet viditelné po nedefinovanou dobu.</p>

		<span class="optionhead">Zobrazení vyskakovacího okna</span>
		<p>Akce myši, které jsou třeba pro zobrazení vyskakovacího okna. Tato akce je spojena se šipkou, která označuje, že jsou dostupné další údaje. Je-li vybrána volba
		Myš dolů, vyskakovací okno se zobrazí při kliknutí na šipku. Je-li vybrána volba Myš přes, vyskakovací okno se zobrazí, když se kursor myši umístí na šipku.</p>

    <span class="optionhead">Šířka rámečku (s vyskakovacím oknem)</span>
		<p>Pevná šířka všech rámečků schématu (v pixelech), používají-li se vyskakovací okna. Výchozí hodnota je 151. Bude-li zadání číslo menší než 21, bude použito 21.
		Použité číslo by mělo být vždy liché, takže bude-li vloženo sudé číslo, bude zvětšeno o 1.</p>

		<span class="optionhead">Výška rámečku (s vyskakovacím oknem)</span>
		<p>Výška všech rámečků schématu (v pixelech), používají-li se vyskakovací okna, jestliže není specifikované nenulové posunutí výšky rámečku (viz níže), v tomto případě je Výška rámečku
		výškou prvního rámečku ve schématu. Výchozí hodnota je 60. Bude-li zadáno číslo menší než 21, bude použito 21. Použité číslo by mělo
		být vždy liché, takže bude-li vloženo sudé číslo, bude zvětšeno o 1.</p>

		<span class="optionhead">Zarovnání rámečku (s vyskakovacím oknem)</span>
		<p>Zarovnání údajů, které se objeví v rámečku, když se nepoužívají vyskakovací okna.
		Pozn.: Data a místa budou vždy zarovnána doleva, ale blok, který je obsahuje, bude zarovnán podle tohoto nastavení.</p>

		<span class="optionhead">Posunutí výšky rámečku (s vyskakovacím oknem)</span>
		<p>Hodnota, podle které by se měla výška rámečků schématu měnit u dalších generací (v pixelech).
		Mělo by to být záporné číslo. Výchozí hodnota je -2. Je-li vložena hodnota 0, neobjeví se v rozměrech rámečku žádná změna.
		Použité číslo by mělo být vždy liché, takže bude-li vloženo sudé číslo, bude zvětšeno o 1.</p>

		<span class="optionhead">Vložit fotografie</span>
		<p>Je-li zaškrtnuta tato volba, do rámečků ve schématech budou vloženy náhledy fotografií (používají-li se vyskakovací okna a soubory obrázků byly nalezeny -- viz níže).
		Výchozí volbou je nezaškrtnuto.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="thumb"><p class="subheadbold">Poznámky k vložení náhledů fotografií</p></a>

		<ul>
 		<li>Chcete-li označit fotografii jako zástupce osoby ve schématech, jděte do úpravy fotografie (musí mít náhled) a zaškrtněte políčko označené <span class="emphasis">Nastavit jako výchozí</span> 
    pod odkazem požadované osoby a stránku uložte. Existující náhled pak bude použit ve schématech. Akce výběru <span class="choice">Nastavit jako výchozí</span> 
    se používala pro kopírování existujícího náhledu na nové umístění, kde byl kopírovaný soubor pojmenován <span class="emphasis">Mtreename.###.ext</span>, kde <span class="emphasis">strom</span> byl název stromu, 
    ke kterému patřila osoba, <span class="emphasis">###</span> bylo ID číslo osoby ze souboru GEDCOM a ext byla přípona fotografie definovaná výše (např. <span class="example">MLythgoe.I567.jpg</span>). 
    Tato konvence se již nepoužívá, ale existující náhledy vytvořené tímto způsobem jsou nadále využívány a mají přednost. <span class="emphasis">POZN.:</span> Můžete tímto způsobem vytvářet výchozí náhledy
    ručně, pokud nechcete, aby byla výchozí fotografie odvozena z jiné fotografie připojené k osobě.</li>
		
		<li>Je-li obrázek vytvořen výše uvedenou konvencí, jeho velikost může být zmenšena, je-li to třeba k tomu, aby se vešel do výšky rámečku. <span class="emphasis">Zvětšení</span> 
    obrázku se však neprovede, protože by tím utrpěla kvalita obrázku. Je třeba také poznamenat, že zmenšení velikosti obrázku nemá vliv na velikost souboru fotografie. Jinými slovy 
    to neznamená, že když obrázek vypadá menší, zobrazí se rychleji, než kdyby byl zobrazen ve své původní velikosti. Proto by velké fotografie neměly být používány jako obrázky ve schématech,
    protože by prodlužovaly čas načtení celé stránky.</li>
		
		<li>Vložení fotografií ovlivní prostor, který v rámečku zůstane pro jména a další údaje. V tomto případě by bylo vhodné rámeček a velikost písma <span class="emphasis">vyladit</span> použitím 
    výše popsaných konfiguračních metod nebo vybrat možnost <span class="choice">přetečení</span> popsanou výše.</li>
		</ul>
	</td>
</tr>

</table>
</body>
</html>
