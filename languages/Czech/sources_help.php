<?php
include("../../helplib.php");
echo help_header("Nápovìda: Prameny");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="families_help.php" class="lightlink">&laquo; Nápovìda: Rodiny</a> &nbsp; | &nbsp;
			<a href="repositories_help.php" class="lightlink">Nápovìda: Úlo¾i¹tì pramenù &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Prameny</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nový</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#merge" class="lightlink">Slouèit</a>
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
            <p>Nalezení existujících pramenù vyhledáním celého nebo èásti <strong>ID èísla pramenu, názvu pramenu, autora, archivaèního èísla</strong> nebo <strong>vydavatele</strong>. 
    Pro dal¹í zú¾ení va¹eho hledání vyberte strom nebo za¹krtnìte "Pouze pøesná shoda".
    Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech osob ve va¹í databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví v¹echny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlaèítko Akce vedle ka¾dého výsledku hledání vám umo¾ní upravit, vymazat nebo otestovat výsledek. Chcete-li najednou vymazat více záznamù, za¹krtnìte políèko ve sloupci
		<strong>Vybrat</strong> u ka¾dého záznamu, která má být vymazán, a poté kliknìte na tlaèítko "Vymazat oznaèené" na zaèátku seznamu. Pro za¹krtnutí nebo vyèi¹tìní v¹ech výbìrových políèek najednou
    mù¾ete pou¾ít tlaèítka <strong>Vybrat v¹e</strong> nebo <strong>Vyèistit v¹e</strong>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Pøidat nový pramen</p></a>
		<p><strong>Pramen</strong> je nìjaká forma dùkazu, která slou¾í k prokázání nebo dolo¾ení údajù ve va¹í databázi. Stejný pramen mù¾e být citován vícekrát
		u více osob, rodin nebo událostí.</p>
    
    <p>Chcete-li pøidat nový pramen, kliknìte na zálo¾ku <strong>Pøidat nový</strong> a poté vyplòte formuláø. Nìkteré informace (poznámky a 
		dal¹í události) mù¾ete pøidat po ulo¾ení a zamknutí záznamu. Význam jednotlivých polí je následující:</p>

  	<span class="optionhead">Strom</span>
		<p>Pokud máte pouze jeden strom, vybrán bude v¾dy tento strom. Jinak, prosím, pro novou rodinu vyberte po¾adovaný strom.</p>

    <span class="optionhead">ID èíslo pramenu</span>
		<p>ID èíslo pramenu musí být jednoznaèné uvnitø vybraného stromu a mìlo by se skládat z velkého písmene <strong>S</strong> následovaného èíslem (nejvíce 21 èíslic).
		Pøi prvním zobrazení stránky a kdykoli je vybrán jiný strom, bude doplnìno volné a jednoznaèné èíslo, ale pokud chcete, mù¾ete vlo¾it své vlastní ID èíslo.
		Chcete-li zkontrolovat, zda je va¹e ID èíslo jednoznaèné, kliknìte na tlaèítko <strong>Zkontrolovat</strong>. Objeví se zpráva, která vám sdìlí, zda je ji¾ ID èíslo pou¾ito nebo ne.
		Chcete-li vygenerovat dal¹í jednoznaèné èíslo, kliknìte na <strong>Vygenerovat</strong>. Bude zji¹tìno nejvy¹¹í èíslo ve va¹í databázi a pøidána 1.
		Chcete-li zajistit, ¾e zobrazení ID èíslo není nárokováno jiným u¾ivatelem, zatímco vy zapisujete data, kliknìte na tlaèítko <strong>Zamknout</strong>.</p>

		<p><strong>POZN.</strong>: Pou¾íváte-li tento program spolu s genealogickým programem pracujícím na platformách PC nebo Mac, který u nových pramenù vytváøí také ID èísla,
		DÙRAZNÌ DOPORUÈUJEME v¹echna tato èísla v¾dy mezi tìmito programy synchronizovat. Výsledkem zanedbání této èinnosti mohou být kolize a nepou¾itelnost
		odkazù na va¹e média. Pokud vá¹ primární program vytváøí ID èísla, která neodpovídají tradièním standardùm (napø. 
		<strong>S</strong> je na konci a ne na zaèátku), mù¾ete konvence, které TNG pou¾ívá, zmìnit v Základním nastavení.</p>
        
		<span class="optionhead">Krátký název</span>
		<p>Zkrácený název pramenu.</p>

		<span class="optionhead">Dlouhý název</span>
		<p>Dlouhý název pramene.</p>

		<span class="optionhead">Autor, archivaèní èíslo, vydavatel</span><br />
		<p>Dal¹í informace spojené s pramenem (pokud existují).</p>

		<span class="optionhead">Úlo¾i¹tì pramenù</span><br />
		<p>Vyberte úlo¾i¹tì pramenù, ve kterém se pramen nachází (je-li tato skuteènost známa). Pokud dané úlo¾i¹tì pramenù je¹tì v databázi neexistuje, jdìte na Administrace/Úlo¾i¹tì pramenù a
		kde jej zalo¾te, pak se vra»te a zde jej vyberte.</p>

		<span class="optionhead">Vlastní text</span><br />
		<p>Citace z materiálu pramene (volitelné).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Upravit existující prameny</p></a>
		<p>Chcete-li upravit existující pramen, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení pramenu, a poté kliknìte na ikonu Upravit vedle pramenu.</p>
        
		<span class="optionhead">Poznámky</span>
    <p>Poznámky lze pøipojit k událostem nebo pramenu obecnì kliknutím na ikonu Poznámky v horní èásti stránky
		nebo vedle ka¾dé události pod "Dal¹í události". Pokud pro událost ji¾ existují poznámky, na ikonì Poznámky se v horním pravém rohu zobrazí zelená teèka.  
    Více informací o poznámkách najdete v odkazu <a href="notes_help.php">Nápovìda</a> v oblasti Poznámky.</p>
    
		<span class="optionhead">Dal¹í události</span>
		<p>Chcete-li pøidat nebo spravovat dal¹í události, kliknìte na tlaèítko "Pøidat nové" vedle <strong>Dal¹ích událostí</strong>. Viz odkaz <a href="events_help.php">Nápovìda</a> v tomto oknì pro více
		informací o pøidání nových událostí. Po pøidání události se v tabulce pod tlaèítkem "Pøidat nové" zobrazí krátké shrnutí. Akèní tlaèítka pro
		ka¾dou událost vám umo¾ní upravit nebo vymazat událost, nebo pøidat poznámky. Poøadí, ve kterém jsou události zobrazeny, závisí na datu (pokud je pou¾ito),
		a poøadí zapsaném u typu události (není-li pøipojeno datum). Toto poøadí lze zmìnit pøi úpravì typù událostí.

		<p><strong>Poznámka</strong>: Poznámky a zmìny "Dal¹ích" událostí se ukládají automaticky. Jiné zmìny (napø. standardní události)
 		lze ulo¾it kliknutím na tlaèítko Ulo¾it na konci stránky, nebo kliknutím na ikonu Ulo¾it na stránce nahoøe. Strom a 
		ID èíslo pramenu nelze zmìnit.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat prameny</p></a>
    <p>Chcete-li odstranit pramen, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení pramenu, a poté kliknìte na ikonu Vymazat vedle tohoto pramenu. Tento øádek zmìní
		barvu a poté po odstranìní pramenu zmizí (v¹echny pøipojené citace budou také vymazány). Chcete-li najednou odstranit více pramenù, za¹krtnìte políèko ve sloupci Vybrat vedle ka¾dého pramenu, který
    chcete odstranit, a poté kliknìte na tlaèítko "Vymazat oznaèené" na stránce nahoøe</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="merge"><p class="subheadbold">Slouèit</p></a>
		<p>Kliknutím na tuto zálo¾ku lze pøezkoumat a slouèit prameny, které jsou lehce odli¹né, ale odkazují na stejný materiál.
		Musíte rozhodnout, zda jsou tyto záznamy toto¾né nebo ne.</p>
		
		<span class="optionhead">Najít shodu</span>
		<p>Vyberte nejprve strom. Nelze sluèovat prameny z rùzných stromù, vybrán musí být pouze jeden strom. Potom máte mo¾nost vybrat pramen jako
		výchozí bod va¹eho hledání (ID èíslo pramenu 1) nebo nechat, aby první shodu osob za vás nalezl TNG. Chcete-li, aby TNG nalezl v¹echny zmìny, nechte pole ID èíslo pramenu 1 prázdné</p>
		
    <p>Pokud jste vybrali pramen jako ID èíslo pramenu 1, mù¾ete také ruènì vybrat ID èíslo pramenu 2. Chcete-li, aby duplicity Pramenu 1 nalezl TNG, nechte pole ID èíslo pramenu 2 prázdné.</p>

		<span class="optionhead">Porovnat následující pole</span>
    <p>Toto jsou kritéria, která TNG pou¾ívá k urèení mo¾ných duplicit. Standardnì jsou vybrány krátký název a (dlouhý) název, co¾ znamená, ¾e tato pole
		musí být shodná, aby mohly být dva záznamy pova¾ovány za potenciálnì duplicitní. Vyberete-li také pole autor, vydavatel, úlo¾i¹tì pramenù nebo vlastní text, musí být také tato pole shodná.</p>

		<span class="optionhead">Jiné mo¾nosti</span>
    <p><em>Odmítnout prázdné</em> znamená, ¾e prázdná pole nebudou brána v potaz. Napø. pramen s krátkým názvem, ale bez titulu
		nebude brán jako shodný s jiným záznamem, pokud je titul mezi vybranými kritérii.</p>

    <p><em>Slouèit poznámky</em> znamená, ¾e poznámky z pramene 2 budou pøidány k poznámkám
		pramenu 1 u v¹ech sluèovaných polí. Není-li tato volba vybrána a pole pramenu 2 je za¹krtnuto, poznámky pramenu 2 k tomuto poli budou pøepsány
		záznamy z odpovídajícího pole pramenu 1.</p>

    <p><em>Slouèit média</em> znamená, ¾e média z pramenu 2 budou zachována a pøidána k ji¾ existujícím
		u pramenu 1, pokud budou tyto dva prameny slouèeny. Není-li tato volba vybrána, v¹echny odkazy na média pramenu 2 budou po slouèení odstranìny.</p>

 		<p><span class="optionhead">Varování!</span> Pokud probìhlo slouèení, nelze jej vzít zpìt! <em>Pøed zahájením operace sluèování proto v¾dy zazálohujte své databázové tabulky</em>
    pro pøípad, ¾e byste dva prameny slouèili omylem.</p>

		<span class="optionhead">Dal¹í shoda</span><br />
		<p>Najde dal¹í mo¾né porovnání, která nezahrne pramen 1. TNG postoupí seznamem mo¾ných pramenù v tøídìní podle ID èísla v textovém formátu.
		Znamená to, ¾e "10" bude po "1", ale pøed "2".</p>

		<span class="optionhead">Dal¹í duplicita</span><br />
		<p>Najde dal¹í mo¾nou duplicitu k pramenu 1. Pokud výsledkem není záznam, který byl zobrazen u pramenu 2, znamená to, ¾e duplicita nebyla nalezena.</p>

		<span class="optionhead">Porovnat/Obnovit</span><br />
		<p>Porovnání pramenu 1 a pramenu 2. Je-li toto porovnání ji¾ zobrazeno, kliknutí na toto tlaèítko zpùsobí obnovení stránky.</p>

		<span class="optionhead">Prohodit</span><br />
		<p>Pramen 1 se stane pramenem 2 a naopak.</p>

		<span class="optionhead">Slouèit</span><br />
		<p>Pramen 2 bude slouèen s pramenem 1. ID èíslo pramene 1 bude zachováno, stejnì jako ostatní údaje pramenu 1, pokud nejsou za¹krtnuta odpovídající políèka
		u pramenu 2. Napø. pokud je u pramenu 2 za¹krtnuto políèko vedle autora, bude bìhem slouèení údaj z tohoto pole zkopírován ze záznamu pramenu 2 do záznamu pramenu 1.
		Odpovídající údaj pramenu 1 bude smazán. Políèka u pramenu 2 jsou automaticky za¹krtnuta, pokud u pramenu 1 nejsou odpovídající údaje. Není-li
		pole zobrazeno ani u jednoho pramenu, pak v tomto poli neexistuje ¾ádný údaj.</p>

		<span class="optionhead">Upravit</span><br />
		<p>Úprava záznamu pramenu v novém oknì. Po provedení zmìn musíte kliknout na Porovnat/Obnovit, aby se zmìny projevily na obrazovce Slouèení.</p>

	</td>
</tr>

</table>
</body>
</html>
