<?php
include("../../helplib.php");
echo help_header("Nápověda: Nástroje po importu");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="data_help.php" class="lightlink">&laquo; Nápověda: Import / Export</a> &nbsp; | &nbsp;
			<a href="setup_help.php" class="lightlink">Nápověda: Nastavení &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Nástroje po importu</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co to je?</a>
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

		<a name="what"><p class="subheadbold">Co jsou to Nástroje po importu?</p></a>
		<p>Nástroje po importu jsou operace, které lze provést na vašich datech bezprostředně po ukončení importu. Chcete-li nějakou operaci provést,
		musíte nejdříve vybrat, zda má být provedena ve "Všech stromech" nebo
		pouze v jednom konkrétním. Pokud pouze v jednom, vyberte tento strom zde. Operace, které můžete provést, jsou následující:</p>
		
		<span class="optionhead">Vysledovat linie</span>
		<p>Po naimportování vašich dat kliknutím sem projdete vybraný strom a označíte všechny osoby s dětmi, což návštěvníkovi vašich stránek
		umožní snadněji najít jeho primární linii potomků.</p>
		
		<span class="optionhead">Seřadit děti</span>
		<p>V každé rodině vybraného stromu dojde k seřazení dětí podle data narození. Bude nahrazeno dřívější řazení, které bylo
		provedeno jinými součástmi TNG nebo vaší desktopovou aplikací.</p>
		
		<span class="optionhead">Seřadit partnery</span>
    <p>Partneři každé osoby vybraného stromu budou seřazeni podle data sňatku. Bude nahrazeno dřívější řazení, které bylo
		provedeno jinými součástmi TNG nebo vaší desktopovou aplikací.</p>

		<span class="optionhead">Znovu označit větve</span>
		<p>Nový import vašeho souboru GEDCOM s volbou <span class="emphasis">Nahradit všechna data</span> způsobí, že všechna dříve existující označení větví budou
		odstraněna. Kliknutím na toto tlačítko tato označení obnovíte (čísla ID musí odpovídat vašim dřívějším datům).</p>

		<span class="optionhead">Vytvořit GENDEX</span>
		<p>Dojde k vytvoření indexovaného souboru ve formátu GENDEX. V Základním nastavení určíte název složky, kam bude soubor uložen.
		Pokud vyberete "Všechny stromy", bude tento soubor pojmenován "gendex.txt". Pokud vyberete jeden strom, název vašeho souboru GENDEX bude ID číslo stromu (nikoli název stromu),
		a přípona .txt. Další informace o souborech GENDEX najdete na
		<!--<a href="https://www.gendexnetwork.org">GenDex Network</a> or --><a href="https://www.familytreeseeker.com">FamilyTreeSeeker.com</a></p>
    
		<span class="optionhead">Publikování vašeho souboru GENDEX na TNG Network</span>
		<p>Máte-li indexovaný soubor GENDEX, navštivte <!--<a href="https://www.gendexnetwork.org">GenDex Network</a> or --><a href="https://www.familytreeseeker.com">FamilyTreeSeeker.com</a>.
		Budete si muset vytvořit účet a poté budete moci naimportovat váš soubor GENDEX. Pokaždé, když budete chtít aktualizovat váš výpis na TNG Network,
		budete potřebovat znovu vytvořit a znovu naimportovat váš soubor GENDEX.</p>
    
    <span class="optionhead">Zredukovat menu médií</span>
		<p>TNG obsahuje položky menu pro několik standardních kolekcí médií (Fotografie, Dokumenty, Vyprávění, Náhrobky, Videa a Zvukové záznamy). Pokud v některých kolekcích 
		nemáte žádné položky, můžete pomocí kliknutí na tuto volbu tyto položky z menu odstranit. Přidáte-li v budoucnu do "redukované" kolekce nějakou položku,
		do menu se tato položka automaticky vrátí.</p>
    
		<span class="optionhead">Obnovit Žijicí</span>
		<p>Vyhledány budou všechny osoby, které nemají zapsané datum úmrtí a které se narodily před takovou dobou, že mohou být teoreticky ještě naživu, a budou označeny jako "Žijící". 
    Přesný počet let je určen volbou "Pokud chybí datum úmrtí, předpokládat, že osoba zemřela, je-li starší než" na stránce Nastavení importu. Tam, kde je taková osoba partnerem, dojde 
    také k označení rodiny jako žijící. A naopak, tento nástroj nalezne i všechny osoby, které mají zapsané datum úmrtí nebo pohřbu, nebo které se nenarodily v tomto časovém rozmezí 
    a označí je jako zesnulé.</p>

		<span class="optionhead">Vytvořit neveřejné</span>
		<p>Vyhledány budou všechny osoby, které zemřely v nedávné minulosti, a budou označeny jako "Neveřejné". Přesný počet let vychází z volby "Osoba je neveřejná, pokud zemřela před méně než tolika lety"
    na stránce Nastavení importu. Tam, kde je taková osoba partnerem, dojde také k označení rodiny jako neveřejné. Na rozdíl od nástroje Obnovit žijicí zde 
    nedojde u žádné osoby k odstranění označení Neveřejné.
    </p>
	</td>
</tr>
</table>
</body>
</html>
