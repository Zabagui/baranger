<?php
include("../../helplib.php");
echo help_header("Nápovìda: Testy DNA");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="reports_help.php" class="lightlink">&laquo; Nápovìda: Reporty</a> &nbsp; | &nbsp;
			<a href="languages_help.php" class="lightlink">Nápovìda: Jazyky &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Testy DNA</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nový</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#ydna" class="lightlink">Pole Y-DNA</a> &nbsp; | &nbsp;
			<a href="#mtdna" class="lightlink">Pole mtDNA</a> &nbsp; | &nbsp;
			<a href="#atdna" class="lightlink">Pole atDNA</a> &nbsp; | &nbsp;
			<a href="#common" class="lightlink">Spoleèná pole</a> &nbsp; | &nbsp;      
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
    <p>Nalezení existujících testù vyhledáním celého nebo èásti <strong>ID osoby</strong> nebo <strong>jména</strong>. Pro dal¹í zú¾ení výsledkù va¹eho hledání vyberte strom nebo jiné mo¾nosti.
    Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech osob ve va¹í databázi.</p>

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
		<a name="add"><p class="subheadbold">Pøidání nových testù</p></a>
		<p>Chcete-li pøidat nový test, kliknìte na zálo¾ku <strong>Pøidat nový</strong>, a vyplòte formuláø. Po ulo¾ení mù¾e být test pøipojen k osobì v databázi.</p>
		<p>Pole mohou zùstat prázdné a nebudou ve vìt¹inì pøípadù zobrazeny.</p>

		<span class="optionhead">Typ testu</span>
		<p>Vyberte typ testu DNA, na který tento záznam odkazuje. (Toto je jediné povinné pole)</p>
    
		<span class="optionhead">Èíslo testu/název</span>
		<p>Zapi¹te ID èíslo spojené s tímto testem. Pokud nemù¾ete èíslo najít nebo vám jej dodavatel nedal, nebojte se vytvoøit èíslo nové. <br /><strong>V¹imnìte si, </strong>¾e pokud nezadáte hodnotu do pole Èíslo testu/název, nebudete mít k dispozici rychlý odkaz pro úpravu dat DNA z obrazovky prohlí¾ení DNA, jako je browse_dna_tests.php.</p>
    
    <span class="optionhead">Dodavatel</span>
		<p>Zadejte název spoleènosti, která test provedla.</p>

		<span class="optionhead">Datum testu</span>
		<p>Toto je datum, kdy byl test DNA proveden.</p>

		<span class="optionhead">Datum shody</span>
		<p>Toto je datum, kdy byla zji¹tìna shoda va¹eho testu s osobou, které byl test DNA proveden.</p>

		<span class="optionhead">GEDmatch ID</span>
		<p>Èíslo ID tohoto testu na webu GEDmatch. Platí pouze pro testy atDNA.</p>

		<span class="optionhead">Ponechat test neveøejný</span>
		<p>Pokud zadáte do pole Ponechat test neveøejný Ano, zobrazení testu bude omezeno pouze na pøihlá¹ené u¾ivatele, kteøí mají pøístupová práva nastavená na <strong>Povolit neveøejné</strong>. To umo¾ní omezit pøístup k testùm DNA, které jste oznaèili jako Ponechat test neveøejný. Test bude viditelný pro administrátora TNG.</p>

		<span class="optionhead">Testovaná osoba</span>
		<p>Jedná se o osobu, které patøí test. Vyberte strom a zapi¹te ID osoby nebo kliknìte na lupu a vyhledejte osobu podle jména. NEBO mù¾ete zadat jméno osoby, která není ve va¹í databázi.</p>

		<span class="optionhead">Ponechat jméno neveøejné</span>
		<p>Pokud je za¹krtnuto toto políèko, jméno uvedené jako "testovaná osoba" se bude zobrazovat jako "Neveøejné". Jméno bude viditelné pro administrátora TNG.</p>
		
		<span class="optionhead">Pøidat test ke skupinì</span>
		<p>Test mù¾ete pøiøadit ke døíve vytvoøené skupinì testù DNA.<br />Chcete-li vytvoøit skupinu testù DNA, pøejdìte na stránku Administrace >> Testy DNA >> a kliknìte na kartu Skupiny DNA. Poté kliknìte na zálo¾ku Pøidat skupinu.</p>

		<span class="optionhead">Skupiny DNA</span>
    <p>Skupiny DNA se pou¾ívají k výbìru nebo filtrování testù DNA nebo typù testù v seznamu. Mù¾ete napøíklad vytvoøit skupinu pro va¹i otcovskou linii a dal¹í skupinu pro mateøskou linii. Skupiny DNA jsou jen zpùsob, jak filtrovat seznam testù. Propojení testù se skupinou je nepovinné. Pov¹imnìte si, ¾e skupiny DNA jsou nyní spojeny s typem testu a pro dva rùzné typy testù nemù¾ete pou¾ít stejný název skupiny DNA.</p>

		<span class="optionhead">Haploskupina</span>
		<p>Haploskupina je genetická populace lidí, kteøí sdílejí spoleèného pøedka v otcovské nebo mateøské linii. Haploskupiny jsou oznaèeny písmeny abecedy (A-T) a jejich upøesnìní (SNP) obsahuje dal¹í kombinace èíslic a písmen. K dispozici jsou dvì samostatná vstupní pole, proto¾e nìkteré testovací spoleènosti poskytují u testù atDNA obì odhadované haploskupiny nebo si testovaná osoba mù¾e nechat zhotovit test mtDNA i Y-DNA.</p>
		<p>Pole <strong>Haploskupina mtDNA</strong> je urèeno pro matrilineální haploskupinu, která je bì¾nì výsledkem testu mtDNA.</p>
		<p>Pole <strong>Haploskupina Y-DNA</strong> je urèeno pro patrilineální haploskupinu, která je bì¾nì výsledkem testu Y-DNA.</p>
		<p>Nìkteré testovací spoleènosti poskytují ve svých testech atDNA haploskupiny mtDNA a Y-DNA. Family Tree DNA toto poskytuje, pokud byly provedeny odpovídající testy mtDNA a Y-DNA. Ostatní testovací spoleènosti pøedpovídají, jaké haploskupiny mohou být.</p>

    <p>Za¹krtávací políèko Potvrzeno slou¾í k oznaèení, ¾e test poskytl potvrzenou haploskupinu na rozdíl od pøedpokládané. Proto¾e haploskupina se skládá z podobných haplotypù, je mo¾né pøedpovìdìt haploskupinu z haplotypu. Pro potvrzení pøedpovìdi haploskupiny je vy¾adován test SNP. Ne v¹echny testovací spoleènosti nabízejí test SNP, proto jejich pøedpovìdi haploskupiny zákazníka jsou nìkdy nepøesné.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="ydna"><p class="subheadbold">Pole výsledkù testù Y-DNA</p></a>
			
    <p>Otcovskou linii daného mu¾e lze stopovat prostøednictvím DNA obsa¾ené v jeho chromozómu Y (Y-DNA). Test Y-DNA spoèívá v analýze segmentù DNA chromozómu Y (pøítomném pouze u mu¾ù), zvaných krátká tandemová repetice (STR z anglického Short Tandem Repeat). Testované segmenty jsou oznaèovány jako markery a nacházejí se v nekódující èásti DNA. STR vyjadøují zmìnu poètu opakování daného segmentu DNA.</p>
    
		<p><strong>Poèet markerù</strong></p>
		<p>Genetický marker je gen nebo sekvence DNA se známým umístìním na chromozomu, který mù¾e být pou¾it k identifikaci jednotlivce. Testy DNA se mohou li¹it podle poètu markerù, které se testují.<br />Typické testy Y-DNA mohou být provedeny na 12, 25, 37, 44, 67, 91, 101 nebo 111 markerù.<br />Vzhledem k tomu, ¾e Family Tree DNA je v souèasné dobì jediným dodavatelem nabízejícím testy Y-DNA, je ve porovnávacím reportu Y-DNA pou¾ito 12, 25, 37, 67 a 111 markerù.</p>
    
		<span class="optionhead">Hodnoty markerù</span>
		<p>Zadejte hodnoty va¹eho Y-DNA markeru oddìlené èárkou. Napøíklad: "13,24,14,10,11-14,12,12,12,13,14,30,17,9-10,11,11,24,15,19,30,15-15-16-17" (bez uvozovek).<br />nebo s mezerami za èárkou pro lep¹í èitelnost, "13, 24, 14, 10, 11-14, 12, 12, 12, 13, 14, 30, 17, 9-10, 11, 11, 24, 15, 19, 30,1 5-15-16-17" (bez uvozovek).</p>    
    <p>V¹imnìte si, ¾e Y-DNA markery, které mají rozsah hodnot, musí být zadány pomocí pomlèky mezi hodnotami, proto¾e rozsah hodnot mù¾e být promìnný</p>

		<strong>SNP</strong>
		<p>SNP (jednonukleotidový polymorfismus) se vyskytne, kdy¾ se v prùbìhu procesu tvorby bunìk zmìní jedno místo v sekvenci genomu a tato mutace v potomstvu pøetrvá. Osoba má mnoho zdìdìných SNP, které spoleènì tvoøí pro daného jedince unikátní (UEP) vzor DNA.</p>
       <p>V genetické genealogii je unikátní polymorfismus (UEP) genetickým markerem, který odpovídá mutaci, která se pravdìpodobnì vyskytuje tak zøídka, ¾e se pøedpokládá, ¾e je naprosto pravdìpodobné, ¾e v¹ichni jedinci, kteøí sdílejí tento marker po celém svìtì, ji dìdí od shodného spoleèného pøedka a shodné události jednotlivé mutace.</p>

		<p><strong>Signifikantní SNPs</strong></p>
		<p>Tyto SNP mohou klinicky souviset, souviset s americkými indiány, apod.</p>

		<p><strong>Terminální SNP</strong></p>
    <p>Terminální SNP je definovaný SNP poslední (koncové) vìtve haploskupiny rozpoznané aktuálním výzkumem. Mìl by být jedineèný a konstantní v èase. Nìkdy se "terminální SNP" pou¾ívá k oznaèení SNP, pro které byl èlovìk naposledy testován.</p>
		
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="mtdna"><p class="subheadbold">Pole výsledkù testù mtDNA</p></a>
		
		<p>Mateøskou linii pøedkù lze stopovat pomocí <span class="optionhead">mitochondriální DNA (mtDNA)</span>. Dle souèasných konvencí je mtDNA rozdìlena do tøí oblastí. Tìmi jsou kódující oblast a dvì hypervariabilní oblasti (HVR1 a HVR2)
    
    <ul>
		<li><strong>HVR1</strong>, ve které jsou nukleotidy èíslovány v rozsahu od 16001 do 16569. </li>
		<li><strong>HVR2</strong>, ve které jsou nukleotidy èíslovány v rozsahu od 00001 do 00574. </li>
		<li><strong>Kódující oblast (CR)</strong> je èást va¹í mtDNA, ve které jsou nukleotidy èíslovány v rozsahu od 00575 do 16000.</li></ul></p>
		<p>Více informací o mtDNA lze najít napø. na stránkách <a href="https://www.familytreedna.com/learn/mtdna-testing/parts-mitochondrial-dna-mtdna-hvr1-hvr2-coding-region/" target="_blank">The Family Tree DNA Learning Center</a></p>

		<p><strong>Referenèní sekvence</strong></p>
    <p> V polích výsledkù testu mtDNA mù¾ete vybrat jednu ze dvou referenèních sekvencí. Family Tree DNA poskytuje obì sekvence, tak¾e je tøeba zvolit, jakou verzi výsledkù zadáte do vstupních polí.
		<ul><li><strong>RSRS</strong> - Reconstructed Sapiens Reference Sequence je referenèní sekvence mitochondriální DNA (mtDNA), který vyu¾ívá jak globální vzorkování moderních lidských vzorkù, tak vzorkù starých hominidù. Byla pøedstavena poèátkem roku 2012 jako náhrada za rCRS (revised Cambridge Reference Sequence).  RSRS zachovává stejný systém èíslování jako CRS, ale zastupuje dìdièný genom mitochondriální Evy, ze kterého pocházejí v¹echny souèasnì známé lidské mitochondrie.</li>
		
		<li><strong>rCRS</strong> - Revised Cambridge Reference Sequence pro lidskou mitochondriální DNA byla pøedstavena v roce 1981 a vedla k zahájení projektu lidského genomu.</li></ul> </p>
			
		<p><span class="optionhead">Rozdíly HVR1/HVR2/Kódující oblast, Zvlá¹tní mutace</span></p>
		<p>Zadejte výsledky svého testu mtDNA oddìlené èárkou.<br />Napøíklad: "A16129G,T16187C,C16189T,T16223C,G16230A,T16278C,C16311T,C16519T".<br />Výsledek mù¾ete také zadat s mezerami za èárkou pro lep¹í èitelnost, napøíklad "A16129G, T16187C, C16189T, T16223C, G16230A, T16278C, C16311T, C16519T" (bez uvozovek)</p>
    
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="atdna"><p class="subheadbold">Pole výsledkù testù atDNA</p></a>

		<p><span class="optionhead">Autozomální DNA (atDNA) </span> testuje va¹e autozomální chromozómy, co¾ je dal¹ích 22 párù za pohlavními chromozomy X a Y. Testy autozomální DNA mohou pomoci identifikovat pøíbuzné, kteøí sdílejí nedávné pøedky. Èím více segmentù sdílíte a èím vìt¹í je délka tìchto segmentù, tím více jste spøíznìni.</p>
		
		<p><strong>Sdílená DNA</strong><br />
    Sdílené segmenty DNA, oznaèované také jako "odpovídající segmenty", jsou èásti DNA, které jsou shodné mezi dvìma jednotlivci. Tyto segmenty byly pravdìpodobnì zdìdìny od spoleèného pøedka. Pøi rozhodování o tom, která shody DNA budete sledovat, postupujte podle tìch s více ne¾ jedním velkým segmentem; to jsou va¹e blízcí pøíbuzní, ti, jejich¾ stromy se snadnìji spojí s va¹imi.</p>
		
		<p><strong>Celkovì sdílené cM</strong><br />
		Toto je souèet autosomální DNA, dané v centimorgans (cM), který vy a va¹e genetická shoda sdílíte.<br />Viz <a href="https://dnapainter.com/tools/sharedcmv4" traget="_blank">The Shared cM Project Tool</a>, kde je více informací o pravdìpodobnosti zpøíznìnosti na základì poètu celkového poètu sdílených cM.</p> 
    
		<p><strong>Sdílené segmenty</strong><br />
    Poèet sdílených segmentù v této sdílené shodì DNA. Èím více segmentù sdílíte a èím vìt¹í je délka tìchto segmentù, tím více jste zpøíznìni.</p>
		
		<p><strong>Nejvìt¹í segment</strong><br />
    Segmenty, které spoleènì sdílejí velké mno¾ství centiMorganù, jsou s vìt¹í pravdìpodobností významné a oznaèují v genealogickém èasovém rámci spoleèného pøedka. Toto je nejvìt¹í sdílený segment v této shodì DNA.</p>
		
		<p><strong>Chromozóm è.</strong><br />
		Toto je èíslo chromozómu nejvìt¹ího shodného segmentu.</p>
		
		<p><strong>Zaèátek segmentu</strong><br />
    Toto je poèáteèní místo nejvìt¹ího shodného sdíleného segmentu DNA</p>	
		
		<p><strong>Konec segmentu</strong><br />
    Toto je koneèné místo nejvìt¹ího shodného sdíleného segmentu DNA</p>
		
		<p><strong>centiMorgany</strong><br />
    V genetické genealogii je centiMorgan (cM) nebo mapová jednotka (m.u.) jednotkou frekvence rekombinace, která se pou¾ívá k mìøení genetické vzdálenosti. Toto je poèet cM v nejvìt¹ím shodném segmentu.</p>
		
		<p><strong>Poèet shodných SNP</strong><br />
		To je poèet SNP pro nejvìt¹í shodný segment.</p>
		
		<p><strong>X-shoda</strong><br />
		Toto pole udává, zda se autosomální DNA shoduje také na chromozómu X.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="common"><p class="subheadbold">Spoleèná pole výsledkù testù</p></a>
		
		<p>Následující pole jsou spoleèná pro v¹echny typy testù</p>

		<span class="optionhead">Nejvzdálenìj¹í pøedek</span>
		<p>Zadejte nejvzdálenìj¹ího otcovského (Y-DNA) nebo mateøského (mtDNA) pøedka testované osoby.  Rùzné osoby s testy Y-DNA a mtDNA mohou mít rùzné nejvzdálenìj¹í pøedky v závislosti na tom, jak daleko do minulosti existuje jejich papírová stopa.</p>
		
		<span class="optionhead">Nejbli¾¹í spoleèný pøedek</span>
		<p>Zadejte ID osoby nejbli¾¹ího spoleèného pøedka (MRCA). MRCA je sdílený spoleèný pøedek mezi dvìmi nebo více testovanými osobami.  MRCA se mù¾e li¹it v závislosti na tom, kde se mezi testovanými osobami setkají jejich linie.</p>
		
		<span class="optionhead">Rodová pøíjmení</span>
		<p>Toto pole se vztahuje na v¹echny typy testù a bude automaticky vyplnìno rodovými pøíjmeními osoby, u které byly provedeny testy Y-DNA a mtDNA, oddìlenými èárkami<br />Doplnìná pøíjmení závisí na typu testu a mù¾ete je jakýmkoli zpùsobem upravit. <br />V Administrace >> Nastavení >> Konfigurace >> Základní nastavení >> Testy DNA je mo¾nost vylouèení pøíjmení jako je neznámé nebo NEZNÁMÉ, a mo¾nost zobrazit pøíjmení velkými písmeny.<br />Nyní je také mo¾nost zvolit, z kolika generací va¹eho rodokmenu se u testù atDNA vrátí rodové pøíjmení.</p>

		<span class="optionhead">Poznámky</span>
		<p>Zapi¹te poznámky spojené s tímto testem nebo jakékoli jiné informace.</p>

		<span class="optionhead">Poznámky administrátora</span>
		<p>Toté¾ jako poznámky, ale pouze pro zobrazení u¾ivatelùm s právy administrátora.</p>

		<span class="optionhead">Odpovídající odkazy</span>
    <p>Pokud existují webové stránky spojené s tímto testem, zadejte je zde. Ka¾dý odkaz zadejte na nový øádek. Zapi¹te stránky nebo název stránek a adresu URL,
    oddìlené èárkou. Napøíklad, "Ancestry.com, https://www.ancestry.com". Pokud nevlo¾íte stránky nebo název stránek, bude odkaz samo o sobì pou¾it jako název.</p>

		<span class="optionhead">Média</span>
		<p>Zde mù¾ete k testu pøiøadit fotografie zadáním mediaID pro ka¾dou fotografii.<br />Více záznamù oddìlte èárkou. Napøíklad: "4361,5992"</p>
		
		<span class="optionhead">Informace o testu k zobrazení</span>
		<p>Vedle informací za¹krtnìte políèko, které chcete zobrazit na stránce osoby (getperson.php).<br />Na stránce ka¾dého testu se zobrazí v¹echny zapsané informace (show_dna_test.php).</p>

		<p>Po dokonèení kliknìte na tlaèítko "Ulo¾it" a vrátíte se zpìt na seznam.</p>

		<p>Dal¹í informace (v angliètinì) najdete na tìchto stránkách TNG Wiki:</p>
		<ul>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/DNA_Tests" target="_blank">DNA Tests<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/TNG_and_DNA_Tests" target="_blank">TNG and DNA Tests<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/DNA_Tests_Enhancements?" target="_blank">DNA Tests Enhancements?<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/Compare_DNA_Test_Results?" target="_blank">Compare DNA Test Results?<a></li>
		</ul>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Úprava existujících testù</p></a>
    <p>Chcete-li upravit existující test, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení testu, a poté kliknìte na ikonu Upravit vedle tohoto testu.</p>

		<span class="optionhead">Odkazy na test</span>
		<p>Tento test mù¾ete pøipojit k osobám ve va¹í databázi. U ka¾dého pøipojení zvolte nejprve strom, ke kterému je jedinec pøipojen.
		Poté zadejte ID èíslo osoby, ke které chcete test pøipojit, a pak kliknutím na tlaèítko "Pøidat" vytvoøíte spojení.</p>

    <p>Neznáte-li ID èíslo, kliknutím na ikonu lupy jej vyhledejte. Objeví se vyskakovací okno, ve kterém provedete vyhledání.
    Po nalezení po¾adované osoby kliknìte na název osoby, èím¾ pøidáte její ID do boxu pro pøidání, a poté kliknìte na tlaèítko "Pøidat", viz vý¹e.</p>  
		<p>Osoba, u které byl proveden test, není automaticky s testem spojena.  Musíte vytvoøit odkaz.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání existujících testù</p></a>
    <p>Chcete-li odstranit test, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení testu, a poté kliknìte na ikonu Vymazat vedle tohoto testu. Tento øádek zmìní
		barvu a poté po odstranìní místa zmizí. Chcete-li najednou odstranit víc testù, za¹krtnìte políèko ve sloupci Vybrat vedle ka¾dého testu, který
    chcete odstranit, a poté kliknìte na tlaèítko "Vymazat oznaèené" na stránce nahoøe</p>

	</td>
</tr>

</table>
</body>
</html>
