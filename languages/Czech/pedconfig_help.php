<?php
include("../../helplib.php");
echo help_header("Nápovìda: Nastavení schémat");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="config_help.php" class="lightlink">&laquo; Nápovìda: Základní nastavení</a> &nbsp; | &nbsp;
			<a href="logconfig_help.php" class="lightlink">Nápovìda: Nastavení protokolování &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Nastavení schémat</span>
		<p class="smaller menu">
			<a href="#ped" class="lightlink">Pøedkové</a> &nbsp; | &nbsp;
			<a href="#desc" class="lightlink">Potomci</a> &nbsp; | &nbsp;
			<a href="#rel" class="lightlink">Pøíbuzenské vztahy</a> &nbsp; | &nbsp;
			<a href="#time" class="lightlink">Èasová osa</a> &nbsp; | &nbsp;
			<a href="#common" class="lightlink">Spoleèné prvky</a> &nbsp; | &nbsp;
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
      
		<a name="ped"><p class="subheadbold">Pøedkové</p></a>

		<span class="optionhead">Výchozí zobrazení</span>
		<p>Pomocí této volby nastavíte výchozí formát schématu pøedkù. Je-li vybráno Standardnì, v¹echna data narození, sòatku a úmrtí/pohøbu
		(jsou-li k dispozici) budou vlo¾ena do skrytého vyskakovacího rámeèku. Fotografie osoby bude zobrazena (pokud existuje). Tam, kde jsou data k dispozici,
    bude na støedu pod spodním okrajem rámeèkù schématu umístìn obrazový soubor (napø. ArrowDown.gif), a kdy¾ je vyvolán vyskakovací rámeèek, objeví se pod rámeèkem schématu. 
    Kompaktní formát je podobný Standardnímu, ale velikost rámeèku je výraznì zmen¹ena, a nejsou zobrazeny fotografie. Kdy¾ je vybrán formát Rámeèek,
		standardní údaje se v¾dy objeví v rámeècích schématu. Je-li vybrán Pouze text, bude nejprve zobrazena textová verze schématu pøedkù (¾ádné rámeèky ani vyskakovací okna).
		Volba Svisle zobrazí výchozí osobu dole a pøedkové osoby budou zobrazeni nad ní.
    Po zobrazení výchozího formátu má u¾ivatel v¾dy mo¾nost pøepnout mezi jednotlivými typy.</p>

		<span class="optionhead">Maximální poèet generací</span>
		<p>Maximální poèet generací, které povolíte u¾ivateli zobrazit najednou.</p>

		<span class="optionhead">Výchozí poèet generací</span>
		<p>Poèet generací, které budou zobrazeny na zaèátku. Není-li nic specifikováno, bude tato hodnota nastavena na 4.</p>

		<span class="optionhead">Partneøi ve vyskakovacích oknech</span>
		<p>Pou¾ívají-li se vyskakovací okna, za¹krtnutím této volby budou do vyskakovacích rámeèkù vlo¾eny odkazy na partnery. Ve výchozím stavu není za¹krtnuto.</p>

		<span class="optionhead">Dìti ve vyskakovacích oknech</span>
		<p>Pou¾ívají-li se vyskakovací okna a volba Partneøi ve vyskakovacích oknech je za¹krtnuta, za¹krtnutím této volby budou do vyskakovacích rámeèkù vlo¾eny odkazy na dìti. Ve výchozím stavu není za¹krtnuto.</p>

		<span class="optionhead">Odkazy na schémata ve vyskakovacích oknech</span>
		<p>Pou¾ívají-li se vyskakovací okna (a volby Partneøi nebo dìti ve vyskakovacích oknech jsou za¹krtnuty), za¹krtnutím této volby budou do vyskakovacích rámeèkù vlo¾eny odkazy na schémata partnerù a dìtí.
		Ve výchozím stavu je za¹krtnuto.</p>

		<span class="optionhead">Skrýt prázdné rámeèky</span>
		<p>Výbìrem 'Ano' odstraníte ze schématu prázdné rámeèky.</p>

		<span class="optionhead">©íøka rámeèku (bez vyskakovacích oken)</span>
		<p>Pevná ¹íøka v¹ech rámeèkù schématu (v pixelech), nepou¾ívají-li se vyskakovací okna. Výchozí hodnota je 211. Bude-li zadání èíslo men¹í ne¾ 21, bude pou¾ito 21.
		Pou¾ité èíslo by mìlo být v¾dy liché, tak¾e bude-li vlo¾eno sudé èíslo, bude zvìt¹eno o 1.</p>

		<span class="optionhead">Vý¹ka rámeèku (bez vyskakovacích oken)</span>
		<p>Vý¹ka v¹ech rámeèkù schématu (v pixelech), nepou¾ívají-li se vyskakovací okna, jestli¾e není specifikované nenulové posunutí vý¹ky rámeèku (viz ní¾e), v tomto pøípadì je Vý¹ka rámeèku
		vý¹kou prvního rámeèku ve schématu. Výchozí hodnota je 121. Bude-li zadání èíslo men¹í ne¾ 21, bude pou¾ito 21. Pou¾ité èíslo by mìlo
		být v¾dy liché, tak¾e bude-li vlo¾eno sudé èíslo, bude zvìt¹eno o 1.</p>

		<span class="optionhead">Zarovnání rámeèku (bez vyskakovacích oken)</span>
		<p>Zarovnání údajù, které se objeví v zobrazeném vyskakovacím oknì.
		Pozn.: Data a místa budou v¾dy zarovnána doleva, ale blok, který je obsahuje, bude zarovnán podle tohoto nastavení.</p>

		<span class="optionhead">Posunutí vý¹ky rámeèku (bez vyskakovacích oken)</span>
		<p>Hodnota, podle které by se mìla vý¹ka rámeèkù schématu mìnit u dal¹ích generací (v pixelech), kdy¾ se nepou¾ívají vyskakovací okna.
		Mìlo by to být záporné èíslo. Výchozí hodnota je -2. Je-li vlo¾ena hodnota 0, neobjeví se v rozmìrech rámeèku ¾ádná zmìna.
		Pou¾ité èíslo by mìlo být v¾dy liché, tak¾e bude-li vlo¾eno sudé èíslo, bude zvìt¹eno o 1.</p>
    
    <h3>Svislé schéma</h3>

		<span class="optionhead">©íøka rámeèku</span>
		<p>©íøka rámeèku se jménem v pixelech ve svislém schématu.</p>

		<span class="optionhead">Vý¹ka rámeèku</span>
		<p>Vý¹ka rámeèku se jménem v pixelech ve svislém schématu.</p>

		<span class="optionhead">Vzdálenost mezi rámeèky</span>
		<p>Vodorovná vzdálenost v pixelech mezi rámeèky se jmény.</p>

		<span class="optionhead">Velikost jména v rámeèku</span>
		<p>Velikost písma (v bodech) u jmen zobrazených ve svislém schématu.</p>

    <h3>Vìjíøový graf</h3>
		<p>Nìkterá nastavení zobrazení vìjíøového grafu (barvy, vý¹ka, typ a velikost písma, poèet generací, zobrazení informaèních rámeèkù) 
    lze provést v souboru <b>fan_config.php</b>, který se nachází ve slo¾ce TNG.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="desc"><p class="subheadbold">Potomci</p></a>

		<span class="optionhead">Výchozí zobrazení</span>
 		<p>Pomocí této volby nastavíte výchozí formát potomkù. Je-li vybráno Standardnì, v¹echna data narození, sòatku a úmrtí/pohøbu
		(jsou-li k dispozici) budou vlo¾ena do skrytého vyskakovacího rámeèku. Fotografie osoby bude zobrazena (pokud existuje). Tam, kde jsou data k dispozici,
    bude na støedu pod spodním okrajem rámeèkù schématu umístìn obrazový soubor (napø. ArrowDown.gif), a kdy¾ je vyvolán vyskakovací rámeèek, objeví se pod rámeèkem schématu. 
    Kompaktní formát je podobný Standardnímu, ale velikost rámeèku je výraznì zmen¹ena, a nejsou zobrazeny fotografie. Je-li vybrán Pouze text, bude zobrazena textová 
    verze schématu potomkù (¾ádné rámeèky ani vyskakovací okna). Formát Registr zobrazí stejné informace ve stylu vyprávìní.
		Po zobrazení výchozího formátu má u¾ivatel v¾dy mo¾nost pøepnout mezi jednotlivými typy.</p>

   	<span class="optionhead">Maximální poèet generací</span>
		<p>Maximální poèet generací, které povolíte u¾ivateli zobrazit najednou.</p>

		<span class="optionhead">Výchozí poèet generací</span>
		<p>Poèet generací, které budou zobrazeny na zaèátku. Není-li nic specifikováno, bude tato hodnota nastavena na 4.</p>

		<span class="optionhead">Spu¹tìní schématu potomkù</span>
		<p>Vyberte, zda chcete spustit schémata potomkù zalo¾ená na textu se v¹emi generacemi rozbalenými nebo sbalenými. U¾ivatel bude mít v¾dy mo¾nost
		rodiny sbalit nebo rozbalit.</p>

		<span class="optionhead">Zobrazit poznámky a vlastní události v Registru</span>
		<p>Oznaèuje, zda budou poznámky k osobì nebo rodinì zobrazeny na stránce Registru.</p>

		<span class="optionhead">Generace v Registru</span>
		<p>Vyberte, zda chcete pøi zobrazení generace zobrazit v¹echny osoby nebo poèet osob omezit výbìrem "Odstranit osoby bez rodin".
    Podle této volby budou zobrazeny pouze osoby, kdy¾ se objeví jako dìti. Nebudou v¹ak zobrazeny znovu,
		kdy¾ bude jejich celá generace popsána v reportu pozdìji.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="rel"><p class="subheadbold">Schéma spojení</p></a>
		<span class="optionhead">Maximální poèet spu¹tìní vyhledávání spojení</span>
		<p>Maximální poèet spojení, které lze nalézt pøi vyhledávání. Nastavte mezi 1 a 9999. V¹imnìte si, ¾e pouze nìkterá vzácná spu¹tìní vedou k zobrazení cesty. 
      Je-li nastaveno na 1, prohledává se pouze nejkrat¹í cesta. Výchozí hodnota je 99.</p>

		<span class="optionhead">Maximální délka cest spojení</span>
		<p>Maximální poèet krokù v ka¾dém spojení. Výchozí hodnota je 30.</p>

		<span class="optionhead">Zobrazit textový pøíkaz cesty</span>
		<p>Zvolte, zda se má ve výchozím nastavení nad grafickou prezentací zobrazovat textový popis ka¾dé cesty.</p>

		<span class="optionhead">Zobrazit rámeèky osob v kompaktní podobì</span>
		<p>Zvolte, zda se má pole ka¾dé osoby zobrazit v minimalizované podobì, bez náhledových fotografií a nìkterých zkrácených prvkù celého jména. 
      Jinými slovy, pokud toto nastavíte na <i>Ne</i>, zobrazí se miniatury a celá jména. Pokud to nastavíte na <i>Ano</i>, diagram bude kompaktnìj¹í.</p>

		<span class="optionhead">Seøadit cesty podle</span>
		<p>Vyberte, zda budou nalezené cesty seøazeny podle délky, poètu sòatkù nebo vùbec. Výchozí hodnota je délka.</p>

		<span class="optionhead">Anchor ID</span>
		<p>ID "Osoby 2", které bude pou¾ito k hledání spojení, dokud u¾ivatel nevybere Osoba 2. POZNÁMKA: Mìlo by to být platné ID ve stejném stromu jako Osoba 1. 
    Pokud je tento parametr prázdný a pøihlá¹ený u¾ivatel je èlenem tohoto stromu, bude ID u¾ivatele navr¾eno jako Osoba 2.</p>

		<span class="optionhead">Maximální poèet man¾elství ve spojení</span>
		<p>Maximální poèet man¾elství povolený v jakékoli cestì pøipojení. Pokud je tato hodnota pøekroèena, je pøipojení ignorováno, aby se zabránilo 
    zobrazení pøíli¹ ¹irokých diagramù.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="time"><p class="subheadbold">Schéma èasové osy</p></a>
		<span class="optionhead">Výchozí ¹íøka schématu</span>
		<p>Výchozí ¹íøka schématu délky ¾ivota v pixelech. Náv¹tìvníci si mohou ¹íøku zmìnit na horním okraji obrazovky.</p>

		<span class="optionhead">Povolit èasovou linii Simile</span>
		<p>Výbìrem volby "Ano" mù¾ete vedle standardní èasové linie TNG také na stejné stránce zobrazit schéma èasové linie Simile. Více
		informací o schématu èasové linie Simile mù¾ete najít na <a href="http://www.simile-widgets.org/timeline/">http://www.simile-widgets.org/timeline/</a>.</p>

		<span class="optionhead">Vý¹ka schématu</span>
		<p>Vý¹ka èasové osy událostí (Simile) v pixelech. Je-li zobrazeno mnoho událostí najednou, mohou být nìkteré vytlaèeny
		mimo viditelnou oblast schématu. Pokud se vám zdá, ¾e se to stalo, mohlo by zvý¹ení této hodnoty pomoci.</p>

		<span class="optionhead">Které události zahrnout</span>
		<p>Ovlivní, které události budou v èasové ose událostí zahrnuty. Mù¾ete vybrat zobrazení v¹ech událostí nebo jenom tìch, které spadají
		do období ¾ivota osob ve schématu. Pokud máte mnoho událostí, výbìrem zobrazení v¹ech mù¾e mít za následek,
		¾e se schéma poprvé zobrazí pomaleji.</p>

		<p>Pozn.: Pokud je najednou ve schématu pøíli¹ mnoho událostí, události na konci nebudou vidìt. Máte-li mnoho událostí èasové osy a toto je èastým jevem,
		mù¾ete uva¾ovat o zvìt¹ení hodnoty vý¹ky schématu (viz vý¹e). Dal¹í mo¾ností nastavení jsou k dispozici v souboru <b>timelineconfig.php</b>, který se nachází ve slo¾ce TNG:</p>
    <p>
    $band1_pct = "10%"; (Horní pruh; jsou zde zobrazeny velmi malé èárky, hrubá úroveò zobrazení událostí rodiny (narození, køtu, man¾elství, narození dìtí, atd...) Zabírá 10% celkové vý¹ky.)<br>
    $band1_interval = 150; (Poèet pixelù mezi jednotlivými znaèkami.)<br>
    $band1_multiple = 1; (Poèet let mezi znaèkami. Pokud je hodnota 2, bude pøeskoèen ka¾dý druhý rok.)<br>

    $band2_pct = "28%"; (Druhý pruh. Ukazuje události rodiny podrobnìji. Zabírá 28% celkové vý¹ky.)<br>
    $band2_interval = 50; (Poèet pixelù mezi jednotlivými znaèkami.)<br>
    $band2_multiple = 1; (Poèet let mezi znaèkami. Pokud je hodnota 2, bude pøeskoèen ka¾dý druhý rok.)<br>

    $band3_pct = "47%"; (Tøetí pruh. Ukazuje obecné události èasové osy. Zabírá 47% celkové vý¹ky.)<br>
    $band3_interval = 175; (Poèet pixelù mezi jednotlivými znaèkami.)<br>
    $band3_multiple = 1;  (Poèet let mezi znaèkami. Pokud je hodnota 2, bude pøeskoèen ka¾dý druhý rok.)<br>

    $band4_pct = "15%"; (Spodní pruh; jsou zde zobrazeny velmi malé èárky, hrubá úroveò zobrazení obecných událostí èasové osy z pruhu 3. Zabírá 15% celkové vý¹ky.)<br> 
    $band4_interval = 150; (Poèet pixelù mezi jednotlivými znaèkami.)<br>
    $band4_multiple = 1;  (Poèet let mezi znaèkami. Pokud je hodnota 2, bude pøeskoèen ka¾dý druhý rok.)<br>
    </p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="common"><p class="subheadbold">Spoleèné prvky</p></a>

		<span class="optionhead">Odsazení zleva</span>
		<p>Vodorovný posun, který bude pou¾it u celého schématu (v pixelech). Lze tím napø. zajistit, aby schéma nepøekrývalo
		okraj obrázku, menu nebo textu, které by mohly být na levém okraji. Výchozí hodnota je 10. Zadáte-li zápornou hodnotu, bude pou¾ita 0.</p>

		<span class="optionhead">Velikost jména v rámeèku</span>
		<p>Velikost (v bodech) v¹ech jmen ve schématu. V ¾ádném pøípadì není mo¾no sní¾it toto hodnotu na ménì ne¾
		7 bodù. Výchozí hodnota je 12.</p>

		<span class="optionhead">Velikost data v rámeèku</span>
		<p>Velikost (v bodech) ostatních údajù ve schématu (data a místa). V ¾ádném pøípadì není mo¾no sní¾it toto hodnotu na ménì ne¾
		7 bodù. Výchozí hodnota je 10.</p>

		<span class="optionhead">Barva rámeèku</span>
		<p>Barva pozadí, která bude pou¾ita ve v¹ech rámeècích schématu, pokud není specifikována nenulová hodnota Posunu barvy, v tomto pøípadì je jedná o definici barvy
		pozadí prvního rámeèku ve schématu. Výchozí hodnota je #CCCC99 (khaki; bílá je #FFFFFF).</p>

		<span class="optionhead">Posun barvy</span>
		<p>Hodnota v procentech, která definuje, jak by mìla být hodnota barvy "posunuta" nahoru nebo dolù (k bílé nebo k èerné) v rozsahu v¹ech
		zobrazených generací. Zadaná hodnota by mìla být mezi -100 a 100. Zadáte-li hodnotu 0, rámeèky v celém schématu (mimo ty, které jsou prázdné &#151; viz Barva prázdných)
		budou mít stejnou barvu pozadí. Výchozí hodnota je 80, co¾ znamená, ¾e barva pozadí rámeèku zeslábne o 80% proti pùvodní barvì smìrem k bílé tak, jak
		jsou rámeèky zobrazeny od první generace k poslední (záporné hodnoty posunou barvu smìrem k èerné).</p>

		<span class="optionhead">Barva prázdných rámeèkù</span>
		<p>Barva pozadí, která bude pou¾ita ve v¹ech rámeècích schématu, ve kterých nejsou ¾ádné údaje. Výchozí hodnota je #CCCCCC (støíbrná).</p>

		<span class="optionhead">Barva okraje</span>
		<p>Barva, která bude pou¾ita na okraje rámeèkù a spojnice. Výchozí hodnota je #000000 (èerná).</p>

		<span class="optionhead">Barva stínu</span>
		<p>Barva, která bude pou¾ita pro stíny. Výchozí hodnota je #999999 (¹edá).</p>

		<span class="optionhead">Posun stínu</span>
		<p>Posun, který bude pou¾it pro vlo¾ení stínu rámeèku a spojnice (v pixelech). Záporné èíslo bude mít za následek,
		¾e bude stín nahoøe a vlevo od rámeèkù a linek. Kladné èíslo zpùsobí, ¾e bude stín dole a vpravo od rámeèkù a linek. Je-li zadaná hodnota 0,
		stíny se neobjeví (proto¾e budou striktnì pod rámeèky a linkami). Výchozí hodnota je 4.</p>

		<span class="optionhead">Vodorovné oddìlení rámeèkù</span>
		<p>Pevné vodorovné oddìlení rámeèkù schématu mezi jednotlivými generacemi (v pixelech). Výchozí hodnota je 31. Pokud je zadaná hodnota
		men¹í ne¾ 7, bude pou¾ita 7. Pou¾ité èíslo by mìlo být v¾dy liché, tak¾e bude-li vlo¾eno sudé èíslo, bude zvý¹eno o 1.</p>

		<span class="optionhead">Svislé oddìlení rámeèkù</span>
		<p>Svislé oddìlení rámeèkù schématu mezi jednotlivými generacemi (v pixelech), pokud není specifikována nenulová hodnota Posunutí vý¹ky rámeèku, v tomto 
    pøípadì bude Svislé oddìlení rámeèkù pevným vodorovným oddìlením rámeèkù schématu poslední zobrazené generace. Výchozí hodnota je 11. Pokud je zadaná hodnota
		men¹í ne¾ 7, bude pou¾ita 7. Pou¾ité èíslo by mìlo být v¾dy liché, tak¾e bude-li vlo¾eno sudé èíslo, bude zvý¹eno o 1. Bez ohledu na vý¹e uvedené
		mù¾e být hodnota zvý¹ena, je-li to nutné pro zaji¹tìní více místa pro stíny a indikátory dal¹ích informací.</p>

		<span class="optionhead">Výchozí velikost stránky PDF</span>
		<p>Velikost papíru, která bude pou¾ita ve v¹ech výstupech do PDF (náv¹tìvníci ji mohou zmìnit pøed vytvoøením ka¾dého výstupu).</p>

		<span class="optionhead">©íøka èáry</span>
		<p>©íøka èáry spojující rámeèky ve schématu (v pixelech). Výchozí hodnota je 1. Pokud je zadaná hodnota men¹í ne¾ 1, bude pou¾ita 1.</p>

		<span class="optionhead">©íøka okraje</span>
		<p>©íøka okraje kolem rámeèku ve schématu (v pixelech). Výchozí hodnota je 1. Pokud je zadaná hodnota men¹í ne¾ 1, bude pou¾ita 1.</p>

		<span class="optionhead">Barva vyskakovacích oken</span>
		<p>Barva pozadí pou¾itá ve vyskakovacích oknech. Pokud bude ponechána prázdná, bude pou¾ita barva, která bude posunuta o jednu barvu od barvy rámeèku. Výchozí hodnota je #DDDDDD (svìtle ¹edá). </p>

		<span class="optionhead">Velikost textu ve vyskakovacích oknech</span>
		<p>Velikost (v bodech) ostatních údajù (data a místa) uvnitø vyskakovacích oken. V ¾ádném pøípadì není mo¾no sní¾it toto hodnotu na ménì ne¾
		7 bodù. Výchozí hodnota je 10.</p>

		<span class="optionhead">Èasové zdr¾ení vyskakovacích oken</span>
		<p>Pokud se pou¾ívají vyskakovací okna, jde o poèet milisekund, po které zùstane vyskakovací okno viditelné. Výchozí hodnota je 500 (1/2 sekundy). Dobu zobrazení vyskakovacího okna
		mohou ovlivnit dvì podmínky. Za prvé, má-li se objevit dal¹í vyskakovací okno, musí to první viditelné zmizet. Za druhé, je-li kursor nad viditelným vyskakovacím oknem,
		zdr¾ení, které je zde definováno, nebude pou¾ito, dokud se kursor nepøesune mimo vyskakovací okno. Znamená to, ¾e vyskakovací okno lez podr¾et viditelné po nedefinovanou dobu.</p>

		<span class="optionhead">Zobrazení vyskakovacího okna</span>
		<p>Akce my¹i, které jsou tøeba pro zobrazení vyskakovacího okna. Tato akce je spojena se ¹ipkou, která oznaèuje, ¾e jsou dostupné dal¹í údaje. Je-li vybrána volba
		My¹ dolù, vyskakovací okno se zobrazí pøi kliknutí na ¹ipku. Je-li vybrána volba My¹ pøes, vyskakovací okno se zobrazí, kdy¾ se kursor my¹i umístí na ¹ipku.</p>

    <span class="optionhead">©íøka rámeèku (s vyskakovacím oknem)</span>
		<p>Pevná ¹íøka v¹ech rámeèkù schématu (v pixelech), pou¾ívají-li se vyskakovací okna. Výchozí hodnota je 151. Bude-li zadání èíslo men¹í ne¾ 21, bude pou¾ito 21.
		Pou¾ité èíslo by mìlo být v¾dy liché, tak¾e bude-li vlo¾eno sudé èíslo, bude zvìt¹eno o 1.</p>

		<span class="optionhead">Vý¹ka rámeèku (s vyskakovacím oknem)</span>
		<p>Vý¹ka v¹ech rámeèkù schématu (v pixelech), pou¾ívají-li se vyskakovací okna, jestli¾e není specifikované nenulové posunutí vý¹ky rámeèku (viz ní¾e), v tomto pøípadì je Vý¹ka rámeèku
		vý¹kou prvního rámeèku ve schématu. Výchozí hodnota je 60. Bude-li zadáno èíslo men¹í ne¾ 21, bude pou¾ito 21. Pou¾ité èíslo by mìlo
		být v¾dy liché, tak¾e bude-li vlo¾eno sudé èíslo, bude zvìt¹eno o 1.</p>

		<span class="optionhead">Zarovnání rámeèku (s vyskakovacím oknem)</span>
		<p>Zarovnání údajù, které se objeví v rámeèku, kdy¾ se nepou¾ívají vyskakovací okna.
		Pozn.: Data a místa budou v¾dy zarovnána doleva, ale blok, který je obsahuje, bude zarovnán podle tohoto nastavení.</p>

		<span class="optionhead">Posunutí vý¹ky rámeèku (s vyskakovacím oknem)</span>
		<p>Hodnota, podle které by se mìla vý¹ka rámeèkù schématu mìnit u dal¹ích generací (v pixelech).
		Mìlo by to být záporné èíslo. Výchozí hodnota je -2. Je-li vlo¾ena hodnota 0, neobjeví se v rozmìrech rámeèku ¾ádná zmìna.
		Pou¾ité èíslo by mìlo být v¾dy liché, tak¾e bude-li vlo¾eno sudé èíslo, bude zvìt¹eno o 1.</p>

		<span class="optionhead">Vlo¾it fotografie</span>
		<p>Je-li za¹krtnuta tato volba, do rámeèkù ve schématech budou vlo¾eny náhledy fotografií (pou¾ívají-li se vyskakovací okna a soubory obrázkù byly nalezeny -- viz ní¾e).
		Výchozí volbou je neza¹krtnuto.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="thumb"><p class="subheadbold">Poznámky k vlo¾ení náhledù fotografií</p></a>

		<ul>
 		<li>Chcete-li oznaèit fotografii jako zástupce osoby ve schématech, jdìte do úpravy fotografie (musí mít náhled) a za¹krtnìte políèko oznaèené <span class="emphasis">Nastavit jako výchozí</span> 
    pod odkazem po¾adované osoby a stránku ulo¾te. Existující náhled pak bude pou¾it ve schématech. Akce výbìru <span class="choice">Nastavit jako výchozí</span> 
    se pou¾ívala pro kopírování existujícího náhledu na nové umístìní, kde byl kopírovaný soubor pojmenován <span class="emphasis">Mtreename.###.ext</span>, kde <span class="emphasis">strom</span> byl název stromu, 
    ke kterému patøila osoba, <span class="emphasis">###</span> bylo ID èíslo osoby ze souboru GEDCOM a ext byla pøípona fotografie definovaná vý¹e (napø. <span class="example">MLythgoe.I567.jpg</span>). 
    Tato konvence se ji¾ nepou¾ívá, ale existující náhledy vytvoøené tímto zpùsobem jsou nadále vyu¾ívány a mají pøednost. <span class="emphasis">POZN.:</span> Mù¾ete tímto zpùsobem vytváøet výchozí náhledy
    ruènì, pokud nechcete, aby byla výchozí fotografie odvozena z jiné fotografie pøipojené k osobì.</li>
		
		<li>Je-li obrázek vytvoøen vý¹e uvedenou konvencí, jeho velikost mù¾e být zmen¹ena, je-li to tøeba k tomu, aby se ve¹el do vý¹ky rámeèku. <span class="emphasis">Zvìt¹ení</span> 
    obrázku se v¹ak neprovede, proto¾e by tím utrpìla kvalita obrázku. Je tøeba také poznamenat, ¾e zmen¹ení velikosti obrázku nemá vliv na velikost souboru fotografie. Jinými slovy 
    to neznamená, ¾e kdy¾ obrázek vypadá men¹í, zobrazí se rychleji, ne¾ kdyby byl zobrazen ve své pùvodní velikosti. Proto by velké fotografie nemìly být pou¾ívány jako obrázky ve schématech,
    proto¾e by prodlu¾ovaly èas naètení celé stránky.</li>
		
		<li>Vlo¾ení fotografií ovlivní prostor, který v rámeèku zùstane pro jména a dal¹í údaje. V tomto pøípadì by bylo vhodné rámeèek a velikost písma <span class="emphasis">vyladit</span> pou¾itím 
    vý¹e popsaných konfiguraèních metod nebo vybrat mo¾nost <span class="choice">pøeteèení</span> popsanou vý¹e.</li>
		</ul>
	</td>
</tr>

</table>
</body>
</html>
