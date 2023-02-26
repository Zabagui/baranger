<?php
include("../../helplib.php");
echo help_header("Nápovìda: Nástroje po importu");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="data_help.php" class="lightlink">&laquo; Nápovìda: Import / Export</a> &nbsp; | &nbsp;
			<a href="setup_help.php" class="lightlink">Nápovìda: Nastavení &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Nástroje po importu</span>
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
		<p>Nástroje po importu jsou operace, které lze provést na va¹ich datech bezprostøednì po ukonèení importu. Chcete-li nìjakou operaci provést,
		musíte nejdøíve vybrat, zda má být provedena ve "V¹ech stromech" nebo
		pouze v jednom konkrétním. Pokud pouze v jednom, vyberte tento strom zde. Operace, které mù¾ete provést, jsou následující:</p>
		
		<span class="optionhead">Vysledovat linie</span>
		<p>Po naimportování va¹ich dat kliknutím sem projdete vybraný strom a oznaèíte v¹echny osoby s dìtmi, co¾ náv¹tìvníkovi va¹ich stránek
		umo¾ní snadnìji najít jeho primární linii potomkù.</p>
		
		<span class="optionhead">Seøadit dìti</span>
		<p>V ka¾dé rodinì vybraného stromu dojde k seøazení dìtí podle data narození. Bude nahrazeno døívìj¹í øazení, které bylo
		provedeno jinými souèástmi TNG nebo va¹í desktopovou aplikací.</p>
		
		<span class="optionhead">Seøadit partnery</span>
    <p>Partneøi ka¾dé osoby vybraného stromu budou seøazeni podle data sòatku. Bude nahrazeno døívìj¹í øazení, které bylo
		provedeno jinými souèástmi TNG nebo va¹í desktopovou aplikací.</p>

		<span class="optionhead">Znovu oznaèit vìtve</span>
		<p>Nový import va¹eho souboru GEDCOM s volbou <span class="emphasis">Nahradit v¹echna data</span> zpùsobí, ¾e v¹echna døíve existující oznaèení vìtví budou
		odstranìna. Kliknutím na toto tlaèítko tato oznaèení obnovíte (èísla ID musí odpovídat va¹im døívìj¹ím datùm).</p>

		<span class="optionhead">Vytvoøit GENDEX</span>
		<p>Dojde k vytvoøení indexovaného souboru ve formátu GENDEX. V Základním nastavení urèíte název slo¾ky, kam bude soubor ulo¾en.
		Pokud vyberete "V¹echny stromy", bude tento soubor pojmenován "gendex.txt". Pokud vyberete jeden strom, název va¹eho souboru GENDEX bude ID èíslo stromu (nikoli název stromu),
		a pøípona .txt. Dal¹í informace o souborech GENDEX najdete na
		<!--<a href="https://www.gendexnetwork.org">GenDex Network</a> or --><a href="https://www.familytreeseeker.com">FamilyTreeSeeker.com</a></p>
    
		<span class="optionhead">Publikování va¹eho souboru GENDEX na TNG Network</span>
		<p>Máte-li indexovaný soubor GENDEX, nav¹tivte <!--<a href="https://www.gendexnetwork.org">GenDex Network</a> or --><a href="https://www.familytreeseeker.com">FamilyTreeSeeker.com</a>.
		Budete si muset vytvoøit úèet a poté budete moci naimportovat vá¹ soubor GENDEX. Poka¾dé, kdy¾ budete chtít aktualizovat vá¹ výpis na TNG Network,
		budete potøebovat znovu vytvoøit a znovu naimportovat vá¹ soubor GENDEX.</p>
    
    <span class="optionhead">Zredukovat menu médií</span>
		<p>TNG obsahuje polo¾ky menu pro nìkolik standardních kolekcí médií (Fotografie, Dokumenty, Vyprávìní, Náhrobky, Videa a Zvukové záznamy). Pokud v nìkterých kolekcích 
		nemáte ¾ádné polo¾ky, mù¾ete pomocí kliknutí na tuto volbu tyto polo¾ky z menu odstranit. Pøidáte-li v budoucnu do "redukované" kolekce nìjakou polo¾ku,
		do menu se tato polo¾ka automaticky vrátí.</p>
    
		<span class="optionhead">Obnovit ®ijicí</span>
		<p>Vyhledány budou v¹echny osoby, které nemají zapsané datum úmrtí a které se narodily pøed takovou dobou, ¾e mohou být teoreticky je¹tì na¾ivu, a budou oznaèeny jako "®ijící". 
    Pøesný poèet let je urèen volbou "Pokud chybí datum úmrtí, pøedpokládat, ¾e osoba zemøela, je-li star¹í ne¾" na stránce Nastavení importu. Tam, kde je taková osoba partnerem, dojde 
    také k oznaèení rodiny jako ¾ijící. A naopak, tento nástroj nalezne i v¹echny osoby, které mají zapsané datum úmrtí nebo pohøbu, nebo které se nenarodily v tomto èasovém rozmezí 
    a oznaèí je jako zesnulé.</p>

		<span class="optionhead">Vytvoøit neveøejné</span>
		<p>Vyhledány budou v¹echny osoby, které zemøely v nedávné minulosti, a budou oznaèeny jako "Neveøejné". Pøesný poèet let vychází z volby "Osoba je neveøejná, pokud zemøela pøed ménì ne¾ tolika lety"
    na stránce Nastavení importu. Tam, kde je taková osoba partnerem, dojde také k oznaèení rodiny jako neveøejné. Na rozdíl od nástroje Obnovit ¾ijicí zde 
    nedojde u ¾ádné osoby k odstranìní oznaèení Neveøejné.
    </p>
	</td>
</tr>
</table>
</body>
</html>
