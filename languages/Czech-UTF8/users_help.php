<?php
include("../../helplib.php");
echo help_header("Nápověda: Uživatelé");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="templateconfig_help.php" class="lightlink">&laquo; Nápověda: Nastavení šablony</a> &nbsp; | &nbsp;
			<a href="trees_help.php" class="lightlink">Nápověda: Stromy &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Uživatelé</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nebo Upravit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#review" class="lightlink">Přezkoumat</a> &nbsp; | &nbsp;
			<a href="#rights" class="lightlink">Přístupová práva</a> &nbsp; | &nbsp;
			<a href="#limits" class="lightlink">Omezení přístupu</a> &nbsp; | &nbsp;
			<a href="#email" class="lightlink">Email</a>
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
    <p>Nalezení existujících uživatelů vyhledáním celého nebo části <strong>Uživatelského jména, popisu nebo skutečného jména</strong> nebo <strong>emailu</strong>. Pro zúžení vašeho hledání zaškrtněte
		"Zobrazit pouze uživatele s administrátorským oprávněním". Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech uživatelů ve vaší databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlačítko <strong>Obnovit</strong>, které znovu obnoví všechny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlačítko Akce vedle každého výsledku hledání vám umožní upravit nebo odstranit tento výsledek. Chcete-li najednou odstranit více záznamů, zaškrtněte políčko ve sloupci
		<strong>Vybrat</strong> u každého záznamu, který má být odstraněn a poté klikněte na tlačítko "Vymazat označené" na začátku seznamu. Pro zaškrtnutí nebo vyčištění všech výběrových políček najednou
    můžete použít tlačítka <strong>Vybrat vše</strong> nebo <strong>Vyčistit vše</strong>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Přidání nového uživatele</p></a>
		<p>Nastavení uživatelských záznamů pro vaše návštěvníky vám umožní přidělit jim zvláštní přístupová práva, která vstoupí v platnost jejich přihlášením pomocí uživatelského jména a hesla.
		První uživatel, kterého vytvoříte, by měl být administrátor (někdo, kdo má všechna práva a není omezen žádným stromem, obvykle to jste vy). Pokud si nepřidělíte dostatečná (administrátorská) oprávnění, 
		nebudete schopni dostat se zpět do administrátorské oblasti programu. Zapomenete-li své uživatelské jméno, jděte na stránku Přihlášení a zadejte svoji emailovou adresu,
		která je spojena s vaším uživatelským účtem a uživatelské jméno vám bude zasláno emailem. Zapomenete-li své heslo, zadejte svoji emailovou adresu a uživatelské jméno a bude vám zasláno
		nové, dočasné heslo. Po přihlášení pomocí nového hesla se vraťte do Admin/Uživatelé a nastavte si heslo na nějaké zapamatovatelné.</p>
    
    <p>Chcete-li přidat nového uživatele, klikněte na záložku <strong>Přidat nový</strong> a pak vyplňte formulář. Chcete-li upravit existujícího uživatele, klikněte na ikonu Upravit vedle tohoto uživatele.
    Význam polí při přidání nebo úpravě uživatele je následující:</p>

		<span class="optionhead">Popis</span>
		<p>Vašemu uživateli můžete přidat stručný popis, abyste věděli, o koho jde. Můžete např. zapsat "Administrátor stránek" nebo "Teta Marta".</p>

		<span class="optionhead">Uživatelské jméno</span></span>
		<p>Jednoznačný jednoslovný identifikátor tohoto uživatele (stejné uživatelské jméno nemohou mít dva uživatelé). Uživatel bude při přihlášení požádán o zadání svého uživatelského jména v délce max. 20 znaků.</p> 

		<span class="optionhead">Heslo</span>
		<p>Důvěrné slovo nebo řetězec znaků (bez mezer), které tento uživatel musí také při přihlášení zadat. Při zápisu do tohoto pole budou zapisované znaky
		na obrazovce pro zachování utajení nahrazovány hvězdičkami nebo jinými podobnými znaky. Délka max. 20 znaků. Heslo je v databázi zašifrováno
		a nelze jej nikým zobrazit, ani tímto uživatelem nebo programem Next Generation.</p>

		<span class="optionhead">Skutečné jméno</span>
		<p>Aktuální jméno (pokud je platné) uživatele, které odpovídá těmto údajům.</p>

		<span class="optionhead">Telefon, email, internetové stránky, adresa, město, kraj/provincie, PSČ, země, poznámky</span>
		<p>Nepovinné údaje, které se týkají uživatele.</p>

		<span class="optionhead">Neposílat tomuto uživateli hromadné emaily</span>
		<p>Toto políčko zaškrtněte, pokud nechcete, aby tomuto uživateli byly posílány hromadné emaily (viz níže).</p>

		<span class="optionhead">Strom / ID číslo osoby</span>
		<p>Pokud tento uživatel odpovídá některé osobě z vaší databáze, můžete zde označit strom a ID číslo osoby jeho záznamu.
		Umožní to zobrazit tomuto uživateli všechny údaje ze svého záznamu, i když tento záznam není obsažen v připojeném stromu nebo větvi.</p>

		<span class="optionhead">Zakázat přístup</span>
		<p>Zaškrtnutím tohoto políčka zabráníte tomuto uživateli přihlásit se, aniž byste vymazali jeho celý uživatelský účet.</p>

		<span class="optionhead">Role a přístupová práva</span>
		<p>Viz <a href="#rights">níže, kde jsou uvedeny podrobnosti o rolích a přístupových právech</a>, která mohou být uživateli přidělena.</p>

		<p><span class="optionhead">Povinná pole:</span> Musíte zadat uživatelské jméno, heslo a popis uživatele. Všechna ostatní pole jsou nepovinná, ale doporučujeme
		zadat emailovou adresu pro případ, že zapomenete své uživatelské jméno nebo heslo.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání uživatelů</p></a>
	  <p>Chcete-li odstranit uživatele, použijte záložku <a href="#search">Hledat</a> k nalezení uživatele, a poté klikněte na ikonku Vymazat vedle záznamu tohoto uživatele. Tento řádek změní
		barvu a poté po odstranění položky uživatel zmizí.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="review"><p class="subheadbold">Přezkoumat</p></a>

		<p>Kliknutím na záložku "Přezkoumat" můžete spravovat nové uživatelské registrace. Tyto uživatelské záznamy nebudou aktivní, dokud je nejdřív neupravíte a neuložíte. Poté, co se stane 
		záznam aktivním, už nebude vidět na záložce Přezkoumat. Místo toho jej bude možno nalézt na záložce "Hledat".</p>
		
		<p>Nové uživatelské záznamy na záložce Přezkoumat mohou být vymazány nebo upravovány stejným způsobem jako řádné uživatelské záznamy. Při úpravě záznamu nového uživatele
		si povšimněte následujícího:</p>
		
		<span class="optionhead">Vyrozumět tohoto uživatele, že byl účet aktivován</span>
		<p>Zaškrtnutím tohoto políčka pošlete emailem novému uživateli informaci o aktivaci účtu (po uložení stránky). Text zprávy se objeví v poli pod
		touto volbou. Před odesláním můžete provést změny tohoto textu.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="rights"><p class="subheadbold">Role a přístupová práva</p></a>

		<p>"Přístupové právo" je to, co může uživatel dělat poté, co se přihlásí. "Role" je předdefinovaná sada přístupových práv, takže
		pokud vyberete jinou roli, seznam zvolených přístupových práv (na pravé straně stránky) se změní (přístupová práva "Povolit"
		na konci sloupce se výběrem role nezmění). Výběrem role "Vlastní" můžete uživateli definovat svoji vlastní sadu přístupových práv.
		Některé role v sobě zahrnují připojení uživatele k určitému stromu,
		v jiných rolích nebude uživatel připojen k žádnému stromu. Role, kterou vyberete, může pak způsobit, že pole připojený strom nebude zaškrtnuto.</p>
		
		<p>Uživateli mohou být připojena následující přístupová práva:</p>
		
		<span class="optionhead">Povolit přidávat nové záznamy</span>
		<p>Uživatel může v administrátorské oblasti přidat nové záznamy, včetně médií.</p>

		<span class="optionhead">Povolit přidávat pouze média</span>
		<p>Uživatel může v administrátorské oblasti přidat nová média, nic jiného.</p>

		<span class="optionhead">Bez práv přidávat</span>
		<p>Uživatel nesmí přidávat žádné nové údaje.</p>

		<span class="optionhead">Povolit úpravy existujících záznamů</span>
		<p>Uživatel může v administrátorské oblasti upravovat existující záznamy, včetně médií.</p>

		<span class="optionhead">Povolit úpravy pouze médií</span>
		<p>Uživatel může v administrátorské oblasti upravovat existující média, nic jiného.</p>

		<span class="optionhead">Povolit předložit úpravy pro přezkoumání administrátorem</span>
		<p>Uživatel nemůže v administrátorské oblasti záznamy upravovat. Předběžné změny může udělat ve veřejné oblasti kliknutím na malou ikonu
		Upravit vedle příslušných událostí na stránkách osoby a rodiny. Změny se nestanou trvalými, dokud nebudou schváleny administrátorem.</p>

		<span class="optionhead">Bez práv upravovat</span>
		<p>Uživatel nesmí provádět úpravy existujících záznamů.</p>

		<span class="optionhead">Povolit vymazat existující záznamy</span>
		<p>Uživatel může v administrátorské oblasti vymazat existující záznamy, včetně médií.</p>

		<span class="optionhead">Povolit vymazat pouze média</span>
		<p>Uživatel může v administrátorské oblasti vymazat média, nic jiného.</p>

		<span class="optionhead">Bez práv vymazat</span>
		<p>Uživatel nesmí vymazat žádné existující záznamy.</p>

		<p>Následující přístupová práva jsou nezávislá na zvolené roli:</p>

    <span class="optionhead">Povolit prohlížení údajů žijících osob</span>
		<p>Uživatel může ve veřejné oblasti prohlížet údaje žijících osob.</p>

    <span class="optionhead">Povolit prohlížení údajů osob označených jako neveřejné</span>
		<p>Uživatel může ve veřejné oblasti prohlížet údaje osob označených jako neveřejné.</p>
    
    <span class="optionhead">Povolit zobrazení neveřejných poznámek</span>
		<p>Uživatel může ve veřejné oblasti prohlížet poznámky označené jako neveřejné.</p>

	  <span class="optionhead">Povolit stažení souboru GEDCOM</span>
		<p>Uživatel může ve veřejné oblasti použít záložku GEDCOM ke stažení souboru GEDCOM. Toto potlačí nastavení pro každý strom v Administrace/Stromy.</p>

	  <span class="optionhead">Povolit stažení souboru PDF</span>
		<p>Uživatel může ve veřejné oblasti na různých stránkách použít volbu PDF pro vytvoření souboru PDF. Toto potlačí nastavení pro každý strom v Administrace/Stromy.</p>

		<span class="optionhead">Povolit prohlížení údajů CJKSpd</span>
		<p>Uživatel může ve veřejné oblasti prohlížet údaje CJKSpd.</p>

		<span class="optionhead">Povolit úpravy uživatelského profilu</span>
		<p>Uživatel může z odkazu ve veřejné oblasti upravovat svůj uživatelský profil (uživatelské jméno, heslo, atd.).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		
		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="rights"><p class="subheadbold">Omezení přístupu</p></a>

		<p>Toto definuje omezení uživatelských práv. Všichni uživatelé (včetně anonymních návštěvníků) mohou vždy vidět údaje zesnulých osob. Zde nejsou nutná žádná práva 
		nebo omezení přístupů.</p>
		
		<span class="optionhead">Omezit na strom/větev</span>
		<p>Chcete-li omezit přístupové právo uživatele na určitý strom, vyberte tento strom zde. Chcete-li omezit přístupová práva na určitou větev
		ve vybraném stromě, vyberte tuto větev také. Připojením větve k uživateli nezabráníte tomuto uživateli zobrazit jiné osoby, které nejsou součástí této větve.</p>

    <span class="optionhead">Uplatnit práva na více stromů</span>
		<p>Chcete-li omezit práva uživatele na více stromů, vyberte tuto možnost a poté pomocí klávesy Ctrl tyto stromy vyberte. Když se uživatel poprvé přihlásí, 
     bude vybrán první strom z tohoto seznamu. Uživatel se může přepínat mezi stromy pomocí rozbalovací nabídky v horní části stránky v pravém rohu nabídky Administrace
     (rozbalovací nabídka je viditelná pouze v případě, že je k dispozici výběr jiného stromu). Následné přihlášení ze stejného prohlížeče způsobí, že na začátku bude
     vybrán naposledy použitý strom. Uživatel se může přepínat mezi stromy také z veřejné stránky Stromy. V tomto režimu nelze provést výběr větve.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="email"><p class="subheadbold">Email</p></a>
		<p>tato záložka umožňuje poslat email všem uživatelům nebo všem uživatelům připojeným k určitému stromu/větvi.</p>
		
		<span class="optionhead">Předmět</span>
		<p>Předmět vašeho emailu.</p>

		<span class="optionhead">Text</span>
		<p>Tělo vaší emailové zprávy.</p>

		<span class="optionhead">Strom</span>
		<p>Pokud chcete poslat tuto zprávu pouze uživatelům připojeným k určitému stromu, tento strom vyberte zde.</p>

		<span class="optionhead">Větev</span>
		<p>Pokud chcete poslat tuto zprávu pouze uživatelům připojeným k určité větvi uvnitř vybraného stromu, tuto větev vyberte zde.</p>

	</td>
</tr>

</table>
</body>
</html>
