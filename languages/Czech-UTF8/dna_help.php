<?php
include("../../helplib.php");
echo help_header("Nápověda: Testy DNA");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="reports_help.php" class="lightlink">&laquo; Nápověda: Reporty</a> &nbsp; | &nbsp;
			<a href="languages_help.php" class="lightlink">Nápověda: Jazyky &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Testy DNA</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nový</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#ydna" class="lightlink">Pole Y-DNA</a> &nbsp; | &nbsp;
			<a href="#mtdna" class="lightlink">Pole mtDNA</a> &nbsp; | &nbsp;
			<a href="#atdna" class="lightlink">Pole atDNA</a> &nbsp; | &nbsp;
			<a href="#common" class="lightlink">Společná pole</a> &nbsp; | &nbsp;      
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
    <p>Nalezení existujících testů vyhledáním celého nebo části <strong>ID osoby</strong> nebo <strong>jména</strong>. Pro další zúžení výsledků vašeho hledání vyberte strom nebo jiné možnosti.
    Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech osob ve vaší databázi.</p>

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
		<a name="add"><p class="subheadbold">Přidání nových testů</p></a>
		<p>Chcete-li přidat nový test, klikněte na záložku <strong>Přidat nový</strong>, a vyplňte formulář. Po uložení může být test připojen k osobě v databázi.</p>
		<p>Pole mohou zůstat prázdné a nebudou ve většině případů zobrazeny.</p>

		<span class="optionhead">Typ testu</span>
		<p>Vyberte typ testu DNA, na který tento záznam odkazuje. (Toto je jediné povinné pole)</p>
    
		<span class="optionhead">Číslo testu/název</span>
		<p>Zapište ID číslo spojené s tímto testem. Pokud nemůžete číslo najít nebo vám jej dodavatel nedal, nebojte se vytvořit číslo nové. <br /><strong>Všimněte si, </strong>že pokud nezadáte hodnotu do pole Číslo testu/název, nebudete mít k dispozici rychlý odkaz pro úpravu dat DNA z obrazovky prohlížení DNA, jako je browse_dna_tests.php.</p>
    
    <span class="optionhead">Dodavatel</span>
		<p>Zadejte název společnosti, která test provedla.</p>

		<span class="optionhead">Datum testu</span>
		<p>Toto je datum, kdy byl test DNA proveden.</p>

		<span class="optionhead">Datum shody</span>
		<p>Toto je datum, kdy byla zjištěna shoda vašeho testu s osobou, které byl test DNA proveden.</p>

		<span class="optionhead">GEDmatch ID</span>
		<p>Číslo ID tohoto testu na webu GEDmatch. Platí pouze pro testy atDNA.</p>

		<span class="optionhead">Ponechat test neveřejný</span>
		<p>Pokud zadáte do pole Ponechat test neveřejný Ano, zobrazení testu bude omezeno pouze na přihlášené uživatele, kteří mají přístupová práva nastavená na <strong>Povolit neveřejné</strong>. To umožní omezit přístup k testům DNA, které jste označili jako Ponechat test neveřejný. Test bude viditelný pro administrátora TNG.</p>

		<span class="optionhead">Testovaná osoba</span>
		<p>Jedná se o osobu, které patří test. Vyberte strom a zapište ID osoby nebo klikněte na lupu a vyhledejte osobu podle jména. NEBO můžete zadat jméno osoby, která není ve vaší databázi.</p>

		<span class="optionhead">Ponechat jméno neveřejné</span>
		<p>Pokud je zaškrtnuto toto políčko, jméno uvedené jako "testovaná osoba" se bude zobrazovat jako "Neveřejné". Jméno bude viditelné pro administrátora TNG.</p>
		
		<span class="optionhead">Přidat test ke skupině</span>
		<p>Test můžete přiřadit ke dříve vytvořené skupině testů DNA.<br />Chcete-li vytvořit skupinu testů DNA, přejděte na stránku Administrace >> Testy DNA >> a klikněte na kartu Skupiny DNA. Poté klikněte na záložku Přidat skupinu.</p>

		<span class="optionhead">Skupiny DNA</span>
    <p>Skupiny DNA se používají k výběru nebo filtrování testů DNA nebo typů testů v seznamu. Můžete například vytvořit skupinu pro vaši otcovskou linii a další skupinu pro mateřskou linii. Skupiny DNA jsou jen způsob, jak filtrovat seznam testů. Propojení testů se skupinou je nepovinné. Povšimněte si, že skupiny DNA jsou nyní spojeny s typem testu a pro dva různé typy testů nemůžete použít stejný název skupiny DNA.</p>

		<span class="optionhead">Haploskupina</span>
		<p>Haploskupina je genetická populace lidí, kteří sdílejí společného předka v otcovské nebo mateřské linii. Haploskupiny jsou označeny písmeny abecedy (A-T) a jejich upřesnění (SNP) obsahuje další kombinace číslic a písmen. K dispozici jsou dvě samostatná vstupní pole, protože některé testovací společnosti poskytují u testů atDNA obě odhadované haploskupiny nebo si testovaná osoba může nechat zhotovit test mtDNA i Y-DNA.</p>
		<p>Pole <strong>Haploskupina mtDNA</strong> je určeno pro matrilineální haploskupinu, která je běžně výsledkem testu mtDNA.</p>
		<p>Pole <strong>Haploskupina Y-DNA</strong> je určeno pro patrilineální haploskupinu, která je běžně výsledkem testu Y-DNA.</p>
		<p>Některé testovací společnosti poskytují ve svých testech atDNA haploskupiny mtDNA a Y-DNA. Family Tree DNA toto poskytuje, pokud byly provedeny odpovídající testy mtDNA a Y-DNA. Ostatní testovací společnosti předpovídají, jaké haploskupiny mohou být.</p>

    <p>Zaškrtávací políčko Potvrzeno slouží k označení, že test poskytl potvrzenou haploskupinu na rozdíl od předpokládané. Protože haploskupina se skládá z podobných haplotypů, je možné předpovědět haploskupinu z haplotypu. Pro potvrzení předpovědi haploskupiny je vyžadován test SNP. Ne všechny testovací společnosti nabízejí test SNP, proto jejich předpovědi haploskupiny zákazníka jsou někdy nepřesné.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="ydna"><p class="subheadbold">Pole výsledků testů Y-DNA</p></a>
			
    <p>Otcovskou linii daného muže lze stopovat prostřednictvím DNA obsažené v jeho chromozómu Y (Y-DNA). Test Y-DNA spočívá v analýze segmentů DNA chromozómu Y (přítomném pouze u mužů), zvaných krátká tandemová repetice (STR z anglického Short Tandem Repeat). Testované segmenty jsou označovány jako markery a nacházejí se v nekódující části DNA. STR vyjadřují změnu počtu opakování daného segmentu DNA.</p>
    
		<p><strong>Počet markerů</strong></p>
		<p>Genetický marker je gen nebo sekvence DNA se známým umístěním na chromozomu, který může být použit k identifikaci jednotlivce. Testy DNA se mohou lišit podle počtu markerů, které se testují.<br />Typické testy Y-DNA mohou být provedeny na 12, 25, 37, 44, 67, 91, 101 nebo 111 markerů.<br />Vzhledem k tomu, že Family Tree DNA je v současné době jediným dodavatelem nabízejícím testy Y-DNA, je ve porovnávacím reportu Y-DNA použito 12, 25, 37, 67 a 111 markerů.</p>
    
		<span class="optionhead">Hodnoty markerů</span>
		<p>Zadejte hodnoty vašeho Y-DNA markeru oddělené čárkou. Například: "13,24,14,10,11-14,12,12,12,13,14,30,17,9-10,11,11,24,15,19,30,15-15-16-17" (bez uvozovek).<br />nebo s mezerami za čárkou pro lepší čitelnost, "13, 24, 14, 10, 11-14, 12, 12, 12, 13, 14, 30, 17, 9-10, 11, 11, 24, 15, 19, 30,1 5-15-16-17" (bez uvozovek).</p>    
    <p>Všimněte si, že Y-DNA markery, které mají rozsah hodnot, musí být zadány pomocí pomlčky mezi hodnotami, protože rozsah hodnot může být proměnný</p>

		<strong>SNP</strong>
		<p>SNP (jednonukleotidový polymorfismus) se vyskytne, když se v průběhu procesu tvorby buněk změní jedno místo v sekvenci genomu a tato mutace v potomstvu přetrvá. Osoba má mnoho zděděných SNP, které společně tvoří pro daného jedince unikátní (UEP) vzor DNA.</p>
       <p>V genetické genealogii je unikátní polymorfismus (UEP) genetickým markerem, který odpovídá mutaci, která se pravděpodobně vyskytuje tak zřídka, že se předpokládá, že je naprosto pravděpodobné, že všichni jedinci, kteří sdílejí tento marker po celém světě, ji dědí od shodného společného předka a shodné události jednotlivé mutace.</p>

		<p><strong>Signifikantní SNPs</strong></p>
		<p>Tyto SNP mohou klinicky souviset, souviset s americkými indiány, apod.</p>

		<p><strong>Terminální SNP</strong></p>
    <p>Terminální SNP je definovaný SNP poslední (koncové) větve haploskupiny rozpoznané aktuálním výzkumem. Měl by být jedinečný a konstantní v čase. Někdy se "terminální SNP" používá k označení SNP, pro které byl člověk naposledy testován.</p>
		
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="mtdna"><p class="subheadbold">Pole výsledků testů mtDNA</p></a>
		
		<p>Mateřskou linii předků lze stopovat pomocí <span class="optionhead">mitochondriální DNA (mtDNA)</span>. Dle současných konvencí je mtDNA rozdělena do tří oblastí. Těmi jsou kódující oblast a dvě hypervariabilní oblasti (HVR1 a HVR2)
    
    <ul>
		<li><strong>HVR1</strong>, ve které jsou nukleotidy číslovány v rozsahu od 16001 do 16569. </li>
		<li><strong>HVR2</strong>, ve které jsou nukleotidy číslovány v rozsahu od 00001 do 00574. </li>
		<li><strong>Kódující oblast (CR)</strong> je část vaší mtDNA, ve které jsou nukleotidy číslovány v rozsahu od 00575 do 16000.</li></ul></p>
		<p>Více informací o mtDNA lze najít např. na stránkách <a href="https://www.familytreedna.com/learn/mtdna-testing/parts-mitochondrial-dna-mtdna-hvr1-hvr2-coding-region/" target="_blank">The Family Tree DNA Learning Center</a></p>

		<p><strong>Referenční sekvence</strong></p>
    <p> V polích výsledků testu mtDNA můžete vybrat jednu ze dvou referenčních sekvencí. Family Tree DNA poskytuje obě sekvence, takže je třeba zvolit, jakou verzi výsledků zadáte do vstupních polí.
		<ul><li><strong>RSRS</strong> - Reconstructed Sapiens Reference Sequence je referenční sekvence mitochondriální DNA (mtDNA), který využívá jak globální vzorkování moderních lidských vzorků, tak vzorků starých hominidů. Byla představena počátkem roku 2012 jako náhrada za rCRS (revised Cambridge Reference Sequence).  RSRS zachovává stejný systém číslování jako CRS, ale zastupuje dědičný genom mitochondriální Evy, ze kterého pocházejí všechny současně známé lidské mitochondrie.</li>
		
		<li><strong>rCRS</strong> - Revised Cambridge Reference Sequence pro lidskou mitochondriální DNA byla představena v roce 1981 a vedla k zahájení projektu lidského genomu.</li></ul> </p>
			
		<p><span class="optionhead">Rozdíly HVR1/HVR2/Kódující oblast, Zvláštní mutace</span></p>
		<p>Zadejte výsledky svého testu mtDNA oddělené čárkou.<br />Například: "A16129G,T16187C,C16189T,T16223C,G16230A,T16278C,C16311T,C16519T".<br />Výsledek můžete také zadat s mezerami za čárkou pro lepší čitelnost, například "A16129G, T16187C, C16189T, T16223C, G16230A, T16278C, C16311T, C16519T" (bez uvozovek)</p>
    
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="atdna"><p class="subheadbold">Pole výsledků testů atDNA</p></a>

		<p><span class="optionhead">Autozomální DNA (atDNA) </span> testuje vaše autozomální chromozómy, což je dalších 22 párů za pohlavními chromozomy X a Y. Testy autozomální DNA mohou pomoci identifikovat příbuzné, kteří sdílejí nedávné předky. Čím více segmentů sdílíte a čím větší je délka těchto segmentů, tím více jste spřízněni.</p>
		
		<p><strong>Sdílená DNA</strong><br />
    Sdílené segmenty DNA, označované také jako "odpovídající segmenty", jsou části DNA, které jsou shodné mezi dvěma jednotlivci. Tyto segmenty byly pravděpodobně zděděny od společného předka. Při rozhodování o tom, která shody DNA budete sledovat, postupujte podle těch s více než jedním velkým segmentem; to jsou vaše blízcí příbuzní, ti, jejichž stromy se snadněji spojí s vašimi.</p>
		
		<p><strong>Celkově sdílené cM</strong><br />
		Toto je součet autosomální DNA, dané v centimorgans (cM), který vy a vaše genetická shoda sdílíte.<br />Viz <a href="https://dnapainter.com/tools/sharedcmv4" traget="_blank">The Shared cM Project Tool</a>, kde je více informací o pravděpodobnosti zpřízněnosti na základě počtu celkového počtu sdílených cM.</p> 
    
		<p><strong>Sdílené segmenty</strong><br />
    Počet sdílených segmentů v této sdílené shodě DNA. Čím více segmentů sdílíte a čím větší je délka těchto segmentů, tím více jste zpřízněni.</p>
		
		<p><strong>Největší segment</strong><br />
    Segmenty, které společně sdílejí velké množství centiMorganů, jsou s větší pravděpodobností významné a označují v genealogickém časovém rámci společného předka. Toto je největší sdílený segment v této shodě DNA.</p>
		
		<p><strong>Chromozóm č.</strong><br />
		Toto je číslo chromozómu největšího shodného segmentu.</p>
		
		<p><strong>Začátek segmentu</strong><br />
    Toto je počáteční místo největšího shodného sdíleného segmentu DNA</p>	
		
		<p><strong>Konec segmentu</strong><br />
    Toto je konečné místo největšího shodného sdíleného segmentu DNA</p>
		
		<p><strong>centiMorgany</strong><br />
    V genetické genealogii je centiMorgan (cM) nebo mapová jednotka (m.u.) jednotkou frekvence rekombinace, která se používá k měření genetické vzdálenosti. Toto je počet cM v největším shodném segmentu.</p>
		
		<p><strong>Počet shodných SNP</strong><br />
		To je počet SNP pro největší shodný segment.</p>
		
		<p><strong>X-shoda</strong><br />
		Toto pole udává, zda se autosomální DNA shoduje také na chromozómu X.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="common"><p class="subheadbold">Společná pole výsledků testů</p></a>
		
		<p>Následující pole jsou společná pro všechny typy testů</p>

		<span class="optionhead">Nejvzdálenější předek</span>
		<p>Zadejte nejvzdálenějšího otcovského (Y-DNA) nebo mateřského (mtDNA) předka testované osoby.  Různé osoby s testy Y-DNA a mtDNA mohou mít různé nejvzdálenější předky v závislosti na tom, jak daleko do minulosti existuje jejich papírová stopa.</p>
		
		<span class="optionhead">Nejbližší společný předek</span>
		<p>Zadejte ID osoby nejbližšího společného předka (MRCA). MRCA je sdílený společný předek mezi dvěmi nebo více testovanými osobami.  MRCA se může lišit v závislosti na tom, kde se mezi testovanými osobami setkají jejich linie.</p>
		
		<span class="optionhead">Rodová příjmení</span>
		<p>Toto pole se vztahuje na všechny typy testů a bude automaticky vyplněno rodovými příjmeními osoby, u které byly provedeny testy Y-DNA a mtDNA, oddělenými čárkami<br />Doplněná příjmení závisí na typu testu a můžete je jakýmkoli způsobem upravit. <br />V Administrace >> Nastavení >> Konfigurace >> Základní nastavení >> Testy DNA je možnost vyloučení příjmení jako je neznámé nebo NEZNÁMÉ, a možnost zobrazit příjmení velkými písmeny.<br />Nyní je také možnost zvolit, z kolika generací vašeho rodokmenu se u testů atDNA vrátí rodové příjmení.</p>

		<span class="optionhead">Poznámky</span>
		<p>Zapište poznámky spojené s tímto testem nebo jakékoli jiné informace.</p>

		<span class="optionhead">Poznámky administrátora</span>
		<p>Totéž jako poznámky, ale pouze pro zobrazení uživatelům s právy administrátora.</p>

		<span class="optionhead">Odpovídající odkazy</span>
    <p>Pokud existují webové stránky spojené s tímto testem, zadejte je zde. Každý odkaz zadejte na nový řádek. Zapište stránky nebo název stránek a adresu URL,
    oddělené čárkou. Například, "Ancestry.com, https://www.ancestry.com". Pokud nevložíte stránky nebo název stránek, bude odkaz samo o sobě použit jako název.</p>

		<span class="optionhead">Média</span>
		<p>Zde můžete k testu přiřadit fotografie zadáním mediaID pro každou fotografii.<br />Více záznamů oddělte čárkou. Například: "4361,5992"</p>
		
		<span class="optionhead">Informace o testu k zobrazení</span>
		<p>Vedle informací zaškrtněte políčko, které chcete zobrazit na stránce osoby (getperson.php).<br />Na stránce každého testu se zobrazí všechny zapsané informace (show_dna_test.php).</p>

		<p>Po dokončení klikněte na tlačítko "Uložit" a vrátíte se zpět na seznam.</p>

		<p>Další informace (v angličtině) najdete na těchto stránkách TNG Wiki:</p>
		<ul>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/DNA_Tests" target="_blank">DNA Tests<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/TNG_and_DNA_Tests" target="_blank">TNG and DNA Tests<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/DNA_Tests_Enhancements‎" target="_blank">DNA Tests Enhancements‎<a></li>
			<li><a href="https://tng.lythgoes.net/wiki/index.php/Compare_DNA_Test_Results‎" target="_blank">Compare DNA Test Results‎<a></li>
		</ul>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Úprava existujících testů</p></a>
    <p>Chcete-li upravit existující test, použijte záložku <a href="#search">Hledat</a> pro nalezení testu, a poté klikněte na ikonu Upravit vedle tohoto testu.</p>

		<span class="optionhead">Odkazy na test</span>
		<p>Tento test můžete připojit k osobám ve vaší databázi. U každého připojení zvolte nejprve strom, ke kterému je jedinec připojen.
		Poté zadejte ID číslo osoby, ke které chcete test připojit, a pak kliknutím na tlačítko "Přidat" vytvoříte spojení.</p>

    <p>Neznáte-li ID číslo, kliknutím na ikonu lupy jej vyhledejte. Objeví se vyskakovací okno, ve kterém provedete vyhledání.
    Po nalezení požadované osoby klikněte na název osoby, čímž přidáte její ID do boxu pro přidání, a poté klikněte na tlačítko "Přidat", viz výše.</p>  
		<p>Osoba, u které byl proveden test, není automaticky s testem spojena.  Musíte vytvořit odkaz.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání existujících testů</p></a>
    <p>Chcete-li odstranit test, použijte záložku <a href="#search">Hledat</a> pro nalezení testu, a poté klikněte na ikonu Vymazat vedle tohoto testu. Tento řádek změní
		barvu a poté po odstranění místa zmizí. Chcete-li najednou odstranit víc testů, zaškrtněte políčko ve sloupci Vybrat vedle každého testu, který
    chcete odstranit, a poté klikněte na tlačítko "Vymazat označené" na stránce nahoře</p>

	</td>
</tr>

</table>
</body>
</html>
