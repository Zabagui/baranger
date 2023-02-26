<?php
include("../../helplib.php");
echo help_header("Nápověda: Rodiny");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="people_help.php" class="lightlink">&laquo; Nápověda: Osoby</a> &nbsp; | &nbsp;
			<a href="sources_help.php" class="lightlink">Nápověda: Prameny &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Rodiny</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat novou</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#review" class="lightlink">Přezkoumat</a>
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
        <p>Nalezení existujících rodin vyhledáním celého nebo části <strong>ID čísla rodiny</strong>, <strong>Jména otce</strong> nebo <strong>Jména matky</strong>. 
    Pro další zúžení vašeho hledání vyberte strom nebo zaškrtněte "Pouze přesná shoda". Volbou "Jména otce" budou vaše výběrová kritéria porovnána se jmény všech otců.
		Volbou "Jména matky" budou vaše výběrová kritéria porovnána se jmény všech matek. Volbou "Beze jména" budete hledat pouze mezi ID čísly rodiny.
    Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech osob ve vaší databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlačítko <strong>Obnovit</strong>, které znovu obnoví všechny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlačítko Akce vedle každého výsledku hledání vám umožní upravit, vymazat nebo otestovat výsledek. Chcete-li najednou vymazat více záznamů, zaškrtněte políčko ve sloupci
		<strong>Vybrat</strong> u každého záznamu, která má být vymazán, a poté klikněte na tlačítko "Vymazat označené" na začátku seznamu. Pro zaškrtnutí nebo vyčištění všech výběrových políček najednou
    můžete použít tlačítka <strong>Vybrat vše</strong> nebo <strong>Vyčistit vše</strong>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Přidat novou rodinu</p></a>
		<p>Výrazem <strong>Rodina</strong> se v tomto programu rozumí každé spojení mezi "otcem" a "matkou" (děti zde mohou nebo nemusí být obsaženy). Pokud byla osoba víckrát sezdána
		nebo má děti s více partnery, měli byste pro každý pár manželů nebo partnerů vytvořit novou rodinu.</p>

		<p>Chcete-li přidat novou rodinu, klikněte na záložku <strong>Přidat nové</strong> a poté vyplňte formulář. Některé informace (poznámky, citace a 
		další události) můžete přidat po uložení a zamknutí záznamu. Význam jednotlivých polí je následující:</p>

		<span class="optionhead">Strom</span>
		<p>Pokud máte pouze jeden strom, vybrán bude vždy tento strom. Jinak, prosím, pro novou rodinu vyberte požadovaný strom.</p>

		<span class="optionhead">Větev (volitelné)</span>
		<p>Připojení rodiny ke "větvi" omezí přístup k informacím o rodině pro uživatele, kteří jsou spojeni k téže větvi. Je-li definována alespoň jedna větev
		a váš uživatelský účet není spojen se žádnou konkrétní větví, můžete novou rodinu připojit k více existujícím větvím. Chcete-li větev vybrat,
		kliknutím na odkaz "Upravit" se otevře box se všemi větvemi ve vybraném stromě. Pro výběr více větví použijte klávesu Control (Windows) nebo Command (Mac).
		Po dokončení vašeho výběru přesuňte kursor myši mimo okno úprav a toto okno zmizí.</p>

    <span class="optionhead">ID číslo rodiny</span>
		<p>ID číslo rodiny musí být jednoznačné uvnitř vybraného stromu a mělo by se skládat z velkého písmene <strong>F</strong> následovaného číslem (nejvíce 21 číslic).
		Při prvním zobrazení stránky a kdykoli je vybrán jiný strom, bude doplněno volné a jednoznačné číslo, ale pokud chcete, můžete vložit své vlastní ID číslo.
		Chcete-li zkontrolovat, zda je vaše ID číslo jednoznačné, klikněte na tlačítko <strong>Zkontrolovat</strong>. Objeví se zpráva, která vám sdělí, zda je již ID číslo použito nebo ne.
		Chcete-li vygenerovat další jednoznačné číslo, klikněte na <strong>Vygenerovat</strong>. Bude zjištěno nejvyšší číslo ve vaší databázi a přidána 1.
		Chcete-li zajistit, že zobrazení ID číslo není nárokováno jiným uživatelem, zatímco vy zapisujete data, klikněte na tlačítko <strong>Zamknout</strong>.</p>

		<p><strong>POZN.</strong>: Používáte-li tento program spolu s genealogickým programem pracujícím na platformách PC nebo Mac, který u nových rodin vytváří také ID čísla,
		DŮRAZNĚ DOPORUČUJEME všechna tato čísla vždy mezi těmito programy synchronizovat. Výsledkem zanedbání této činnosti mohou být kolize a nepouľitelnost
		odkazů na vaše média. Pokud váš primární program vytváří ID čísla, která neodpovídají tradičním standardům (např. 
		<strong>F</strong> je na konci a ne na začátku), můžete konvence, které TNG používá, změnit v Základním nastavení.</p>

		<span class="optionhead">Manľelé/Partneři</span>
		<p>Kliknutím na "Najít..." vyberte existující osoby, které by měly být v této rodině <strong>otcem</strong> nebo <strong>matkou</strong> nebo kliknutím na "Vytvořit"
		vytvořte nové osoby. Pokud jste zvolili Vytvořit, budete moci vložit údaje o nových osobách bez toho, abyste museli opustit aktuální stránku.
		Po výběru nebo vytvoření osoby se v poli Otec nebo Matka objeví jméno a ID číslo osoby (nelze upravit přímo).
		Chcete-li partnera odstranit ze vztahu (nebude odstraněn z databáze),
		klikněte na tlačítko "Odstranit". Pokud chcete upravit záznam partnera, klikněte na tlačítko "Upravit".</p>

		<span class="optionhead">Žijící</span>
		<p>Pokud jeden z partnerů žije nebo si přejete omezit přístup k údajům této rodiny pouze na uživatele, kteří jsou přihlášeni a mají práva zobrazovat data žijících osob,
		zaškrtněte toto políčko.</p>

		<span class="optionhead">Neveřejné</span>
		<p>Bez ohledu na to, zda je tato rodina označena jako žijící, můľete přístupová práva k údajům této osoby omezit zaąkrtnutím této volby.
		Informace spojené s "neveřejnou" rodinou budou moci vidět pouze uživatelé s právy zobrazovat neveřejná data.</p>

		<span class="optionhead">Události</span>
		<p>Zapište data a místa k zobrazeným standardním událostem (pokud je znáte). Další události lze přidat po uloľení a zamknutí záznamu. Data vždy zapisujte
		ve standardním genealogickém formátu DD MMM RRRR (např. <em>18 Úno 2008</em>). Informaci o místě řaďte za sebou od místního po obecnou a oddělujte každý údaj čárkou
		(např. <em>Bludov, Šumperk, Olomoucký kraj, Česká republika</em>), nebo kliknutím na ikonu "Najít" vyberte existující místo (lupa).
		Chcete-li omezit počet nalezených výsledků, před kliknutím na ikonu Najít zapište část místa. Všechny výsledky budou obsahovat to, co jste zapsali jako název místa.</p>

		<p><span class="optionhead">Údaje CJKSpd (Pečetění s partnerem)</span><br />
		Tato událost je spojena s obřadem prováděným Církví Ježíse Krista Svatých posledních dní (mormonská církev, která vytvořila standard GEDCOM).
		<strong>Pozn.:</strong> Nechcete-li vidět pole spojené s CJKSpd, jděte na Nastavení/Základní nastavení a zde tuto možnost vypněte (je třeba se pak odhlásit a znovu přihlásit).</p>



	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Upravit existující rodinu</p></a>
    <p>Chcete-li upravit existující rodinu, použijte záloľku <a href="#search">Hledat</a> pro nalezení rodiny, a poté klikněte na ikonu Upravit vedle této osoby.</p>

		<span class="optionhead">Poznámky / Citace / "Více"</span>
		<p>Poznámky a citace lze připojit k událostem nebo rodině obecně kliknutím na připojené ikony v horní části stránky
		nebo vedle každé události. Ke každé události můžete také přidat "více" informací kliknutím na ikonu "Plus". Pokud v nějaké této kategorii existují údaje,
		na odpovídající ikoně bude v horním pravém rohu zelená tečka. Chcete-li znát více informací o každé kategorii, jděte na odkazy nápovědy,
		které budou viditelné po kliknutí na tyto ikony.</p>

		<span class="optionhead">Jiné události</span>
		<p>Chcete-li přidat další události, klikněte na tlačítko "Přidat nové" vedle <strong>Jiné události</strong>. Viz odkaz <a href="events_help.php">Nápověda</a> pro více
		informací o přidání nových událostí. Po přidání události se pod tlačítkem "Přidat nové" zobrazí v tabulce krátké shrnutí. Tlačítka akcí
		pro každou událost vám umožní událost upravit nebo odstranit, nebo přidat poznámky nebo citace. Pořadí, ve kterém se události zobrazí, závisí na datu (je-li zapsáno)
		a prioritě, kterou má daný typ události (není-li připojeno datum). Při úpravě typu události můľete prioritu změnit.

		<p><strong>Poznámka</strong>: Poznámky, citace pramenů, "jiné" události a "více" informací se ukládá u standardních automaticky. Jiné změny (např. 
		standardní události) se uloží kliknutím na tlačítko Uložit na konci stránky nebo kliknutím na ikonu Uložit na stránce nahoře. Strom a
		ID číslo osoby nelze změnit.</p>

		<p><span class="optionhead">Děti</span><br />
		<p>Kliknutím na "Najít..." vyberte existující osoby, které by měly být v této rodině dětmi, nebo kliknutím na "Vytvořit"
		vytvořte nové dítě. Pokud jste zvolili Vytvořit, budete moci vložit údaje o nové osobě bez toho, abyste museli opustit aktuální stránku.
    Po výběru nebo vytvoření osoby se v seznamu dětí jméno, ID číslo a datum narození osoby (nelze upravit přímo). Tento seznam nelze
		upravovat přímo, ale pro odstranění dítěte ze seznamu můžete použít odkaz "Odstranit" (viditelný, když přesunete kurzor myši nad každé dítě). Použít
		můžete také odkaz "Vymazat" pro úplné vymazání dítěte z databáze. Můžete použít tlačítko "Vymazat" pro vymazání dítěte z databáze
		nebo tlačítko "Upravit" pro úpravu záznamu dítěte.</p>

    <span class="optionhead">Pořadí dětí</span>
    <p>Pokud existuje více dětí,
		můžete jejich pořadí změnit "přetažením" bloků nahoru nebo dolů. Chcete-li blok přetáhnout, klikněte myší na tlačítko "Táhnout", toto tlačítko podržte, a vaši myš přesuňte na stránce nahoru
		nebo dolů. Po přesunu bloku do požadované pozice tlačítko pusťte. Změny pořadí budou automaticky uloženy.</p>


	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat rodinu</p></a>
    <p>Chcete-li odstranit rodinu, použijte záložku <a href="#search">Hledat</a> pro nalezení rodiny, a poté klikněte na ikonu Odstranit vedle této rodiny. Tento řádek změní
		barvu a poté po odstranění rodiny zmizí (partneři a děti nebudou odstraněni, ale vztah bude rozpojen). Chcete-li najednou odstranit více rodin, zaškrtněte políčko ve sloupci Vybrat vedle každé rodiny, kterou
    chcete odstranit, a poté klikněte na tlačítko "Vymazat označené" na stránce nahoře</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="review"><p class="subheadbold">Předběľné prohlédnutí úprav</p></a>
    Chcete-li si předběžně prohlédnout změny provedené ostatními uživateli, klikněte na záložku "Přezkoumat". Můžete se pak rozhodnout, zda tyto navrhované změny uložíte nebo odstraníte.
    Změny můžete prohlédnout podle stromu nebo podle uživatele nebo podle obojího. Po uložení navrhovaných změn není zaslán žádný mail, ale pokud nové změny existují, na záložce Přezkoumat se objeví hvězdička (*).</p>

		<span class="optionhead">Vybrat událost a akci</span><br />
		<p>V tabulce, která popisuje události, které si přejete přezkoumat nebo odstranit, vyberte řádek. Seznam výsledků můžete zúžit výběrem uživatele (osoba
		odpovědná za navrhované změny) a/nebo strom. Po zobrazení výsledků klikněte na jednu z možných akcí nalevo od tohoto řádku. Chcete-li změny přezkoumat a
		případně začlenit do databáze, vyberte <em>Přezkoumat</em>. Chcete-li navrhované změny zamítnout, vyberte <em>Odstranit</em>.</p>

		<span class="optionhead">Přezkoumat</span><br />
		<p>Na obrazovce Přezkoumat můžete provést další potřebné změny, včetně poznámek a pramenů, a poté klikněte na "Uložit a vymazat" pro
		uložení do databáze a odstranění dočasného záznamu. Kliknutím na "Odmítnout a vymazat" můžete rovněľ odstranit dočasný záznam, aniž byste jej uložili,
		nebo můžete své rozhodnutí odložit na pozdější dobu kliknutím na "Odložit".</p>

  </td>
</tr>

</table>
</body>
</html>
