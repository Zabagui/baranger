<?php
include("../../helplib.php");
echo help_header("Nápovìda: Rodiny");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="people_help.php" class="lightlink">&laquo; Nápovìda: Osoby</a> &nbsp; | &nbsp;
			<a href="sources_help.php" class="lightlink">Nápovìda: Prameny &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Rodiny</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat novou</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#review" class="lightlink">Pøezkoumat</a>
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
        <p>Nalezení existujících rodin vyhledáním celého nebo èásti <strong>ID èísla rodiny</strong>, <strong>Jména otce</strong> nebo <strong>Jména matky</strong>. 
    Pro dal¹í zú¾ení va¹eho hledání vyberte strom nebo za¹krtnìte "Pouze pøesná shoda". Volbou "Jména otce" budou va¹e výbìrová kritéria porovnána se jmény v¹ech otcù.
		Volbou "Jména matky" budou va¹e výbìrová kritéria porovnána se jmény v¹ech matek. Volbou "Beze jména" budete hledat pouze mezi ID èísly rodiny.
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
		<a name="add"><p class="subheadbold">Pøidat novou rodinu</p></a>
		<p>Výrazem <strong>Rodina</strong> se v tomto programu rozumí ka¾dé spojení mezi "otcem" a "matkou" (dìti zde mohou nebo nemusí být obsa¾eny). Pokud byla osoba víckrát sezdána
		nebo má dìti s více partnery, mìli byste pro ka¾dý pár man¾elù nebo partnerù vytvoøit novou rodinu.</p>

		<p>Chcete-li pøidat novou rodinu, kliknìte na zálo¾ku <strong>Pøidat nové</strong> a poté vyplòte formuláø. Nìkteré informace (poznámky, citace a 
		dal¹í události) mù¾ete pøidat po ulo¾ení a zamknutí záznamu. Význam jednotlivých polí je následující:</p>

		<span class="optionhead">Strom</span>
		<p>Pokud máte pouze jeden strom, vybrán bude v¾dy tento strom. Jinak, prosím, pro novou rodinu vyberte po¾adovaný strom.</p>

		<span class="optionhead">Vìtev (volitelné)</span>
		<p>Pøipojení rodiny ke "vìtvi" omezí pøístup k informacím o rodinì pro u¾ivatele, kteøí jsou spojeni k té¾e vìtvi. Je-li definována alespoò jedna vìtev
		a vá¹ u¾ivatelský úèet není spojen se ¾ádnou konkrétní vìtví, mù¾ete novou rodinu pøipojit k více existujícím vìtvím. Chcete-li vìtev vybrat,
		kliknutím na odkaz "Upravit" se otevøe box se v¹emi vìtvemi ve vybraném stromì. Pro výbìr více vìtví pou¾ijte klávesu Control (Windows) nebo Command (Mac).
		Po dokonèení va¹eho výbìru pøesuòte kursor my¹i mimo okno úprav a toto okno zmizí.</p>

    <span class="optionhead">ID èíslo rodiny</span>
		<p>ID èíslo rodiny musí být jednoznaèné uvnitø vybraného stromu a mìlo by se skládat z velkého písmene <strong>F</strong> následovaného èíslem (nejvíce 21 èíslic).
		Pøi prvním zobrazení stránky a kdykoli je vybrán jiný strom, bude doplnìno volné a jednoznaèné èíslo, ale pokud chcete, mù¾ete vlo¾it své vlastní ID èíslo.
		Chcete-li zkontrolovat, zda je va¹e ID èíslo jednoznaèné, kliknìte na tlaèítko <strong>Zkontrolovat</strong>. Objeví se zpráva, která vám sdìlí, zda je ji¾ ID èíslo pou¾ito nebo ne.
		Chcete-li vygenerovat dal¹í jednoznaèné èíslo, kliknìte na <strong>Vygenerovat</strong>. Bude zji¹tìno nejvy¹¹í èíslo ve va¹í databázi a pøidána 1.
		Chcete-li zajistit, ¾e zobrazení ID èíslo není nárokováno jiným u¾ivatelem, zatímco vy zapisujete data, kliknìte na tlaèítko <strong>Zamknout</strong>.</p>

		<p><strong>POZN.</strong>: Pou¾íváte-li tento program spolu s genealogickým programem pracujícím na platformách PC nebo Mac, který u nových rodin vytváøí také ID èísla,
		DÙRAZNÌ DOPORUÈUJEME v¹echna tato èísla v¾dy mezi tìmito programy synchronizovat. Výsledkem zanedbání této èinnosti mohou být kolize a nepouµitelnost
		odkazù na va¹e média. Pokud vá¹ primární program vytváøí ID èísla, která neodpovídají tradièním standardùm (napø. 
		<strong>F</strong> je na konci a ne na zaèátku), mù¾ete konvence, které TNG pou¾ívá, zmìnit v Základním nastavení.</p>

		<span class="optionhead">Manµelé/Partneøi</span>
		<p>Kliknutím na "Najít..." vyberte existující osoby, které by mìly být v této rodinì <strong>otcem</strong> nebo <strong>matkou</strong> nebo kliknutím na "Vytvoøit"
		vytvoøte nové osoby. Pokud jste zvolili Vytvoøit, budete moci vlo¾it údaje o nových osobách bez toho, abyste museli opustit aktuální stránku.
		Po výbìru nebo vytvoøení osoby se v poli Otec nebo Matka objeví jméno a ID èíslo osoby (nelze upravit pøímo).
		Chcete-li partnera odstranit ze vztahu (nebude odstranìn z databáze),
		kliknìte na tlaèítko "Odstranit". Pokud chcete upravit záznam partnera, kliknìte na tlaèítko "Upravit".</p>

		<span class="optionhead">®ijící</span>
		<p>Pokud jeden z partnerù ¾ije nebo si pøejete omezit pøístup k údajùm této rodiny pouze na u¾ivatele, kteøí jsou pøihlá¹eni a mají práva zobrazovat data ¾ijících osob,
		za¹krtnìte toto políèko.</p>

		<span class="optionhead">Neveøejné</span>
		<p>Bez ohledu na to, zda je tato rodina oznaèena jako ¾ijící, mùµete pøístupová práva k údajùm této osoby omezit za±krtnutím této volby.
		Informace spojené s "neveøejnou" rodinou budou moci vidìt pouze u¾ivatelé s právy zobrazovat neveøejná data.</p>

		<span class="optionhead">Události</span>
		<p>Zapi¹te data a místa k zobrazeným standardním událostem (pokud je znáte). Dal¹í události lze pøidat po uloµení a zamknutí záznamu. Data v¾dy zapisujte
		ve standardním genealogickém formátu DD MMM RRRR (napø. <em>18 Úno 2008</em>). Informaci o místì øaïte za sebou od místního po obecnou a oddìlujte ka¾dý údaj èárkou
		(napø. <em>Bludov, ©umperk, Olomoucký kraj, Èeská republika</em>), nebo kliknutím na ikonu "Najít" vyberte existující místo (lupa).
		Chcete-li omezit poèet nalezených výsledkù, pøed kliknutím na ikonu Najít zapi¹te èást místa. V¹echny výsledky budou obsahovat to, co jste zapsali jako název místa.</p>

		<p><span class="optionhead">Údaje CJKSpd (Peèetìní s partnerem)</span><br />
		Tato událost je spojena s obøadem provádìným Církví Je¾íse Krista Svatých posledních dní (mormonská církev, která vytvoøila standard GEDCOM).
		<strong>Pozn.:</strong> Nechcete-li vidìt pole spojené s CJKSpd, jdìte na Nastavení/Základní nastavení a zde tuto mo¾nost vypnìte (je tøeba se pak odhlásit a znovu pøihlásit).</p>



	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Upravit existující rodinu</p></a>
    <p>Chcete-li upravit existující rodinu, pou¾ijte záloµku <a href="#search">Hledat</a> pro nalezení rodiny, a poté kliknìte na ikonu Upravit vedle této osoby.</p>

		<span class="optionhead">Poznámky / Citace / "Více"</span>
		<p>Poznámky a citace lze pøipojit k událostem nebo rodinì obecnì kliknutím na pøipojené ikony v horní èásti stránky
		nebo vedle ka¾dé události. Ke ka¾dé události mù¾ete také pøidat "více" informací kliknutím na ikonu "Plus". Pokud v nìjaké této kategorii existují údaje,
		na odpovídající ikonì bude v horním pravém rohu zelená teèka. Chcete-li znát více informací o ka¾dé kategorii, jdìte na odkazy nápovìdy,
		které budou viditelné po kliknutí na tyto ikony.</p>

		<span class="optionhead">Jiné události</span>
		<p>Chcete-li pøidat dal¹í události, kliknìte na tlaèítko "Pøidat nové" vedle <strong>Jiné události</strong>. Viz odkaz <a href="events_help.php">Nápovìda</a> pro více
		informací o pøidání nových událostí. Po pøidání události se pod tlaèítkem "Pøidat nové" zobrazí v tabulce krátké shrnutí. Tlaèítka akcí
		pro ka¾dou událost vám umo¾ní událost upravit nebo odstranit, nebo pøidat poznámky nebo citace. Poøadí, ve kterém se události zobrazí, závisí na datu (je-li zapsáno)
		a prioritì, kterou má daný typ události (není-li pøipojeno datum). Pøi úpravì typu události mùµete prioritu zmìnit.

		<p><strong>Poznámka</strong>: Poznámky, citace pramenù, "jiné" události a "více" informací se ukládá u standardních automaticky. Jiné zmìny (napø. 
		standardní události) se ulo¾í kliknutím na tlaèítko Ulo¾it na konci stránky nebo kliknutím na ikonu Ulo¾it na stránce nahoøe. Strom a
		ID èíslo osoby nelze zmìnit.</p>

		<p><span class="optionhead">Dìti</span><br />
		<p>Kliknutím na "Najít..." vyberte existující osoby, které by mìly být v této rodinì dìtmi, nebo kliknutím na "Vytvoøit"
		vytvoøte nové dítì. Pokud jste zvolili Vytvoøit, budete moci vlo¾it údaje o nové osobì bez toho, abyste museli opustit aktuální stránku.
    Po výbìru nebo vytvoøení osoby se v seznamu dìtí jméno, ID èíslo a datum narození osoby (nelze upravit pøímo). Tento seznam nelze
		upravovat pøímo, ale pro odstranìní dítìte ze seznamu mù¾ete pou¾ít odkaz "Odstranit" (viditelný, kdy¾ pøesunete kurzor my¹i nad ka¾dé dítì). Pou¾ít
		mù¾ete také odkaz "Vymazat" pro úplné vymazání dítìte z databáze. Mù¾ete pou¾ít tlaèítko "Vymazat" pro vymazání dítìte z databáze
		nebo tlaèítko "Upravit" pro úpravu záznamu dítìte.</p>

    <span class="optionhead">Poøadí dìtí</span>
    <p>Pokud existuje více dìtí,
		mù¾ete jejich poøadí zmìnit "pøeta¾ením" blokù nahoru nebo dolù. Chcete-li blok pøetáhnout, kliknìte my¹í na tlaèítko "Táhnout", toto tlaèítko podr¾te, a va¹i my¹ pøesuòte na stránce nahoru
		nebo dolù. Po pøesunu bloku do po¾adované pozice tlaèítko pus»te. Zmìny poøadí budou automaticky ulo¾eny.</p>


	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat rodinu</p></a>
    <p>Chcete-li odstranit rodinu, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení rodiny, a poté kliknìte na ikonu Odstranit vedle této rodiny. Tento øádek zmìní
		barvu a poté po odstranìní rodiny zmizí (partneøi a dìti nebudou odstranìni, ale vztah bude rozpojen). Chcete-li najednou odstranit více rodin, za¹krtnìte políèko ve sloupci Vybrat vedle ka¾dé rodiny, kterou
    chcete odstranit, a poté kliknìte na tlaèítko "Vymazat oznaèené" na stránce nahoøe</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="review"><p class="subheadbold">Pøedbìµné prohlédnutí úprav</p></a>
    Chcete-li si pøedbì¾nì prohlédnout zmìny provedené ostatními u¾ivateli, kliknìte na zálo¾ku "Pøezkoumat". Mù¾ete se pak rozhodnout, zda tyto navrhované zmìny ulo¾íte nebo odstraníte.
    Zmìny mù¾ete prohlédnout podle stromu nebo podle u¾ivatele nebo podle obojího. Po ulo¾ení navrhovaných zmìn není zaslán ¾ádný mail, ale pokud nové zmìny existují, na zálo¾ce Pøezkoumat se objeví hvìzdièka (*).</p>

		<span class="optionhead">Vybrat událost a akci</span><br />
		<p>V tabulce, která popisuje události, které si pøejete pøezkoumat nebo odstranit, vyberte øádek. Seznam výsledkù mù¾ete zú¾it výbìrem u¾ivatele (osoba
		odpovìdná za navrhované zmìny) a/nebo strom. Po zobrazení výsledkù kliknìte na jednu z mo¾ných akcí nalevo od tohoto øádku. Chcete-li zmìny pøezkoumat a
		pøípadnì zaèlenit do databáze, vyberte <em>Pøezkoumat</em>. Chcete-li navrhované zmìny zamítnout, vyberte <em>Odstranit</em>.</p>

		<span class="optionhead">Pøezkoumat</span><br />
		<p>Na obrazovce Pøezkoumat mù¾ete provést dal¹í potøebné zmìny, vèetnì poznámek a pramenù, a poté kliknìte na "Ulo¾it a vymazat" pro
		ulo¾ení do databáze a odstranìní doèasného záznamu. Kliknutím na "Odmítnout a vymazat" mù¾ete rovnìµ odstranit doèasný záznam, ani¾ byste jej ulo¾ili,
		nebo mù¾ete své rozhodnutí odlo¾it na pozdìj¹í dobu kliknutím na "Odlo¾it".</p>

  </td>
</tr>

</table>
</body>
</html>
