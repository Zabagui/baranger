<?php
include("../../helplib.php");
echo help_header("Nápověda: Základní nastavení");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="setup_help.php" class="lightlink">&laquo; Nápověda: Nastavení</a> &nbsp; | &nbsp;
			<a href="pedconfig_help.php" class="lightlink">Nápověda: Nastavení schémat &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Základní nastavení</span>
		<p class="smaller menu">
			<a href="#data" class="lightlink">Databáze</a> &nbsp; | &nbsp;
			<a href="#table" class="lightlink">Tabulky</a> &nbsp; | &nbsp;
			<a href="#path" class="lightlink">Umístění a složky</a> &nbsp; | &nbsp;
			<a href="#site" class="lightlink">Stránka</a> &nbsp; | &nbsp;
			<a href="#media" class="lightlink">Média</a> &nbsp; | &nbsp;
			<a href="#lang" class="lightlink">Jazyk</a> &nbsp; | &nbsp;
			<a href="#priv" class="lightlink">Ochrana údajů</a> &nbsp; | &nbsp;
			<a href="#name" class="lightlink">Jména</a> &nbsp; | &nbsp;
			<a href="#cem" class="lightlink">Hřbitovy</a> &nbsp; | &nbsp;
			<a href="#mail" class="lightlink">Mail</a> &nbsp; | &nbsp;
			<a href="#pref" class="lightlink">Předpony</a> &nbsp; | &nbsp;      
			<a href="#mobile" class="lightlink">Mobil</a> &nbsp; | &nbsp;
			<a href="#misc" class="lightlink">Různé</a>
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
    
		<a name="data"><p class="subheadbold">Databáze</p></a>

		<span class="optionhead">Hostitel databáze, název, uživatelské jméno, heslo, port a socket</span>
		<p>Tyto údaje použije TNG a PHP k připojení k vaší databázi. Kromě portu a socketu (málo používané), musí být tato pole vyplněna dřív, než bude vaše databáze 
		zpřístupněna. <strong>Pozn.</strong>: Toto uživatelské jméno a heslo může být jiné, než jsou vaše obvyklé přístupové údaje k webové stránce.
		Pokud se po vložení těchto údajů objeví chybové hlášení, že TNG nemůže komunikovat s vaší databází,
		pak je některý z těchto údajů chybný. Neznáte-li správné údaje, vyžádejte si je u poskytovatele vašeho
		webového hostingu. Název hostitel může také obsahovat číslo portu nebo cestu do socketu (socket path), např. "localhost:3306" nebo "localhost:/path/to/socket".
		Tyto údaje jsou důležité, takže je zadávejte s maximální přesností. Pokud působíte jako svůj vlastní webmaster, ujistěte se, že jste vytvořili databázi
		a přidali do ní uživatele (uživatel musí mít VŠECHNA přístupová práva).</p>

		<span class="optionhead">Režim údržby</span>
		<p>Je-li TNG v režimu údržby, data nejsou přístupná veřejnosti. Návštěvníkovi se zobrazí zpráva, 
		která mu oznámí, že na stránkách probíhá údržba a může se sem vrátit později. Vaši stránku můžete
		přepnout do režimu údržby při importu vašich dat. Pokud chcete přečíslovat vaše ID čísla, přepnutí do režimu údržby
		je nutné. Pokud jste se v režimu údržby "zasekli", můžete přímo opravit váš soubor config.php a obnovit nastavení proměnné $tngconfig['maint']
		na 0 nebo prázdnou.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="table"><p class="subheadbold">Názvy tabulek</p></a>

		<span class="optionhead">Názvy tabulek</span>
		<p>Výchozí názvy byste neměli měnit, pokud už některé tabulky mají tyto názvy. Všechny názvy tabulek musí být vyplněny a všechny názvy musí být jednoznačné. 
    Neměňte názvy existujících tabulek.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="path"><p class="subheadbold">Umístění a složky</p></a>

		<span class="optionhead">Kořenová složka</span>
		<p>Toto je složka v systému, ve které jsou umístěny vaše soubory TNG. Není to webová adresa.
		Zapsat musíte koncové lomítko. Pokud tuto stránku otevřete poprvé, vaše kořenová složka by měla být vyplněna správně. Neměňte ji, pokud nejste pokročilý uživatel
		nebo nejste instruováni, jak to udělat. Pokud smažete obsah tohoto pole a stránku uložíte, správná složka se objeví po opětovném načtení této stránky, ale
		stránku musíte uložit znovu, aby se nová složka uložila.</p>

		<span class="optionhead">Konfigurační složka</span>
		<p>Pokud chcete vaše konfigurační TNG soubory na bezpečnější místo mimo kořenovou složku webu (takže nebudou přístupny
		z webu), zapište tuto složku zde. <strong>Musí</strong> končit koncovým lomítkem (/). Bude to pravděpodobně část kořenové složky.
		Je-li např. vaše kořenová složka "/home/www/username/public_html/genealogy/", jako konfigurační složku můžete zvolit "/home/www/username/".</p>

		<p><strong>DŮLEŽITÉ:</strong> Použití tohoto pole je
		zcela volitelné a nebude mít vliv na provoz vašich stránek. Vyplnit byste jej měli pouze, když dokonale znáte 
    strukturu složek na vašich webových. Pokud sem nějaké umístění zapíšete, <strong>musíte následující soubory přesunout 
		do konfigurační složky okamžitě po uložení</strong> a změnit je na zapisovatelné (oprávnění 664 nebo 666): config.php, customconfig.php, importconfig.php,
		logconfig.php, mapconfig.php, mmconfig.php and pedconfig.php. Pokud tak neučiníte, na vašich stránkách nebude nic fungovat. Pokud uděláte chybu a vaše stránky přestanou pracovat,
		budete muset ručně opravit váš soubor subroot.php a zapsat správnou složku do proměnné $tngconfig['subroot'] (její opětovné nastavení na prázdnou hodnotu vrátí váš systém
		do výchozího stavu).</p>

		<span class="optionhead">Složky Fotografie / Dokumenty / Vyprávění / Náhrobky / Multimédia / Módy / Extensions / GENDEX / Záloha</span>
		<p>Do těchto polí zapište název složky nebo adresáře pro zmíněné entity. Všechny by měly mít globální přístup číst+psát+provést (read+write+execute, 755 nebo 775, i když některé systémy vyžadují 777).
		Složka multimédií je určena jako "záchytná" pro všechny položky médií, které se nehodí do jiných kategorií (např. videa a
		zvukové záznamy). Názvy těchto složek lze změnit zadáním nových názvů a kliknutím na odpovídající tlačítka „Přejmenovat“. Až budete s touto stránkou hotovi, nezapomeňte kliknout na „Uložit“.</p>
		<p>Pozn.: Políčko pod názvem složky zálohy zaškrtněte, chcete-li, aby byla složka záloh uložena v umístění konfigurační cesty (viz výše). Skutečnou složku musíte přesunout do konfiguračního umístění sami mimo TNG.</p>    

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="site"><p class="subheadbold">Vzhled a definice stránek</p></a>

		<span class="optionhead">Domovská stránka</span>
		<p>Všechna menu v programu TNG obsahují odkaz na "domovskou stránku". Do tohoto pole zapište adresu tohoto odkazu. Standardně je to stránka index.php ve složce s ostatními
		soubory TNG. Musí to být relativní odkaz ("index.php" nebo "../otherhomepage.html"), nikoli absolutní odkaz ("https://yoursite.com").</p>

		<span class="optionhead">URL genealogických stránek</span>
		<p>Webová adresa vaší genealogické složky (např. "https://mysite.com/genealogy").</p>

		<span class="optionhead">Název stránek</span>
		<p>Obsah tohoto pole bude zobrazen v tagu HTML "Title" na každé stránce a bude zobrazen na horním okraji okna vašeho prohlížeče.</p>

		<span class="optionhead">Popis stránek</span>
		<p>Krátký popis vašich stránek pro použití v kanálu RSS.</p>

		<span class="optionhead">Doctype Deklarace</span>
		<p>Tento text je umístěn v horní části každé stránky ve veřejném prostředí a dá prohlížeči uživatele informaci, kterou potřebuje
		ke správnému zobrazení stránky. Ověřovací testy, které běží na stránkách, použijí tento údaj k určení, jaké se 
    mohou objevit problémy. Pokud toto pole necháte prázdné, bude použit výchozí XHTML Transitional doctype.</p>

		<span class="optionhead">Majitel stránek</span>
		<p>Vaše jméno, případně vaše obchodní jméno. Toto jméno se objeví v odchozích mailech z TNG.</p>

		<span class="optionhead">Cílový rámec</span>
		<p>Pokud vaše stránka používá rámce, toto pole použijte pro označení, ve kterém rámci mají být zobrazeny stránky TNG. Pokud rámce nepoužíváte, 
		nechte v tomto poli hodnotu "_self".</p>

		<span class="optionhead">Vlastní záhlaví / zápatí / meta</span>
		<p>Názvy souborů pro části stránky, které se používají jako záhlaví, zápatí a sekci HEAD ("meta") vaší TNG stránky. Dodávány jsou soubory s výchozími názvy.
		Používá-li se v těchto souborech kódování PHP, musí mít přípony .php. Chcete-li je využít v šablonách vzhledu, musíte tato záhlaví a zápatí mít nazvaná
		jako topmenu.php a footer.php.</p>
    
		<span class="optionhead">Volitelná zpráva zápatí</span>
		<p>Zpráva nebo fragment kódu HTML, který se zobrazí ve spodní části každé stránky.</p>    

		<span class="optionhead">Styl záložek</span>
		<p>Soubor, který určuje styl záložek zobrazených na většině veřejných stránek. Výchozí styl (tngtabs2.css) používá jemně zaoblené záložky, ale
		TNG dodává také alternativní styl se šikmými záložkami (tngtabs1.css). Chcete-li zobrazit záložky v tomto stylu, zapište do tohoto pole "tngtabs1.css"
		a klikněte na "Uložit" ve spodní části stránek, a poté zkuste vyhledat nějakou osobu ve veřejném prostředí. Styl (tngtabs1.css) využívá dva obrázky, "tngtab.png" (neaktivní
		záložky) a "tngtabactive.png" (aktivní záložky). Chcete-li změnit barvu těchto obrázků, můžete použít jakýkoli obrazový editor nebo kliknout na odkaz na konci tohoto odstavce. Na další stránce
		zapište <strong>decimální</strong> hodnoty červené, zelené a modré komponenty uvažované nové barvy, a pak klikněte na Potvrdit. Potom uvidíte nový obrázek, který můžete uložit na vaše stránky jako
		tngtab.png nebo tngtabactive.png. <a href="https://lythgoes.net/genealogy/switchcolor.php">https://lythgoes.net/genealogy/switchcolor.php</a></p>

		<span class="optionhead">Umístění menu</span>
		<p>TNG menu může být na každé stránce umístěno nahoře vlevo nad jménem osoby nebo jiným číslem stránky, nebo na každé stránce nahoře vpravo, přímo proti jménu nebo
		jinému číslu stránky. Dynamický rozbalovací seznam pro výběr jazyku bude na obrazovce umístěn ve stejné sekci.</p>

		<span class="optionhead">Zobrazit odkazy na domovskou stránku / Hledat / Přihlášení/Odhlášení / Sdílet / Tisk / Přidat záložku</span>
		<p>Některé tyto volby (Domovská stránka/Hledat/Přihlášení) jsou na každé stránce umístěny nahoře vlevo, pod záhlavím stránky a nad linií záložek. Jiné
		(Sdílet/Tisk/Přidat záložku) jsou umístěny nahoře vpravo, pod lištou menu.
		Každou tuto volbu můžete pomocí ovládacích prvků zapnout nebo vypnout.</p>
    
    <span class="optionhead">Cíl odkazu Hledat</span>
		<p>Odkaz Hledat v horní části každé stránky ve výchozím chování otevře malé okno, ve kterém můžete hledat pomocí zápisu jména nebo čísla ID. Toto se nazývá "Rychlé hledání".
    Výběrem této předvolby můžete místo toho přejít na stránky Rozšířené hledání.</p>

		<span class="optionhead">Skrýt popisky křtu</span>
		<p>Tato volba umožňuje skrýt všechny zmínky o události "křtu".</p>

		<span class="optionhead">Alternativní události narození</span>
		<p>Výchozí alternativní události narození jsou křest (CHR) a křest (BAPM), ale můžete to změnit zde přidáním nebo nahrazením vlastních tagů GEDCOM. 
    Uživatelé, kteří provádějí změny v datech, pak budou moci vybrat příslušnou událost z tohoto seznamu.</p>

		<span class="optionhead">Výchozí strom</span>
		<p>Pokud existuje více stromů, na všech stránkách, kde je možný výběr stromu (včetně funkce hledání
		na vaší domovské stránce) bude výchozí nastavení "Všechny stromy". Chcete-li, aby tento výběr nabízel pouze určitý strom,
		tento strom vyberte zde. Kdekoli uživatel zapíše URL bez ID čísla stromu (nebo s prázdným ID číslem stromu), dotaz
		bude směřovat k tomuto stromu. <strong>POZN.</strong>: Pokud máte pouze jeden strom, je lepší toto pole nechat prázdné.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="media"><p class="subheadbold">Média</p></a>

		<span class="optionhead">Typ souborů fotografií</span>
		<p>Přípona souboru všech malých fotografií používaných ve schématech. Ostatní fotografie nemusí obsahovat tuto příponu. Pro většinu fotografií je doporučena přípona .jpg.</p>

		<span class="optionhead">Zobrazit rozšířenou informaci o obrázku</span>
		<p>Pokud je tato volba zaškrtnuta, budou u každé fotografie zobrazeny rozšířené informace. Ty obsahují fyzický název souboru, rozměry v pixelech a
		existující údaje IPTC.</p>

		<span class="optionhead">Maximální výška a šířka obrázku</span>
		<p>Jsou-li tyto hodnoty nastaveny (pixely), obrázky větší než tyto rozměry budou při zobrazení ve veřejném prostředí zmenšeny (použitím HTML).</p>

		<span class="optionhead">Předpona/prefix pro náhledy</span>
		<p>Při automatickém generování náhledu přidá TNG tuto hodnotu před originální název souboru a vytvoří tak název souboru náhledu. Pokud název originálního souboru obsahuje údaj o cestě,
		předpona bude vložena přímo před název souboru. Tato předpona může obsahovat název složky (např. "thumbnails/"). Pokud
		použijete název složky jako součást přípony, ujistěte se, že tato složka existuje a má stejná oprávnění jako složka nadřízená fotografií.</p>

		<span class="optionhead">Přípona/sufix pro náhledy</span>
		<p>Při automatickém generování náhledu přidá TNG tuto hodnotu k originálnímu názvu souboru a vytvoří tak název souboru náhledu.</p>

		<span class="optionhead">Maximální výška náhledu</span>
		<p>TNG automaticky vytvoří náhled obrázku, který nebude vyšší, než je nastavená výška (pixely).</p>

		<span class="optionhead">Maximální šířka náhledu</span>
		<p>TNG automaticky vytvoří náhled obrázku, který nebude širší, než je nastavená šířka (pixely).</p>

		<span class="optionhead">Použít výchozí náhledy</span>
		<p>Pokud osoba nemá výchozí fotografii a tato volba je povolena, na všech stránkách, na kterých je odkaz na tuto osobu, bude použit místo toho obecný náhled, který rozlišuje pohlaví.</p>

		<span class="optionhead">Maximální počet znaků v seznamu poznámek</span>
		<p>Chcete-li zkrátit poznámky, které jsou zobrazovány na stránkách se seznamy (jako jsou veřejné stránky fotografie, dokumenty a vyprávění), nastavte toto pole na maximální
		počet znaků, který má být zobrazen. Necháte-li jej prázdné, bude zobrazena kompletní poznámka.</p>

		<span class="optionhead">Povolit prezentaci</span>
		<p>Umožní automatické postupné zobrazování fotografií ve veřejném prostředí stránek po kliknutí na odkaz "Zahájit prezentaci". Nastavení
		této hodnoty na 'Ne' skryje tento odkaz a zakáže použití této funkce.</p>

		<span class="optionhead">Automatické opakování prezentace</span>
		<p>Nastavení této hodnoty na 'Ano' povolí automatický pokračující běh prezentace.</p>

		<span class="optionhead">Umožnit prohlížeč obrázků</span>
		<p>Nastavení této volby na 'Vždy' zobrazí každou obrázkovou položku (soubory .jpg, .gif a .png) v prohlížeči obrázků. Nastavení na 'Pouze dokumenty' vypne
		prohlížeč obrázků pro všechny obrázková média, které nejsou 'Dokumenty' nebo jiné typy médií, které se chovají jako Dokumenty.</p>

		<span class="optionhead">Výška prohlížeče obrázků</span>
		<p>Nastavení této volby na 'Vždy zobrazit celý obrázek' zajistí, že je obrázek viditelný ve výchozích rozměrech. Nastavení na 'Pevná (640px)' zapříčiní, že obrázky vyšší než
		640 pixelů budou při zobrazení oříznuty na tuto výšku. Ovládací prvky prohlížeče mohou být dále používány k posunu obrázku nebo přiblížení či oddálení.</p>

    <span class="optionhead">Skrýt média osob</span>
		<p>Je-li tato předvolba nastavena na "Ano", seznam médií na stránce osoby bude začínat ve sbaleném stavu. Místo náhledů a popisků uvidíte pouze celkový počet podle typů médií.
    Návštěvníci budou moci každou sekci médií rozbalit, ale po obnovení načtení stránky bude seznam opět sbalen.</p>
    
    <span class="optionhead">Při smazání současně odstranit fyzický soubor</span>
		<p>Tato volba určuje, co se stane, když bude smazán individuální záznam médií. Je-li tato možnost nastavena na "Ano", přidružený fyzický soubor bude také smazán. 
    Je-li volba nastavena na hodnotu "Ne", bude odebrán pouze záznam v databázi a fyzický soubor zůstane neporušený. Je-li tato možnost nastavena na možnost "Na vyžádání", 
    budete vyzváni k rozhodnutí, zda má být přidružený soubor smazán nebo ne.</p>

		<span class="optionhead">Zobrazit fotografie na jednom řádku</span>
		<p>Toto se týká náhledů zobrazených na stránce osoby. Pokud je v nějaké oblasti obsaženo více náhledů, lze tuto volbu použít k zobrazení všech náhledů vodorovně na jednom řádku 
    (pokud je obrázků příliš mnoho na to, aby byly všechny zobrazeny na jednom řádku, budou pokračovat na dalším řádku) nebo v seznamu, jak to bylo obvyklé ve starších verzích TNG. 
    Pokud jsou náhledy zobrazeny vodorovně, nebudou u nich zobrazeny žádné popisky. Média, která nemají náhledy, budou stále zobrazena svisle.</p>

		<span class="optionhead">Rozdělit média do složek stromů</span>
		<p>Ve výchozím nastavení jsou všechna fyzická média z každé kolekce (tj. Fotografie, Dokumenty, Historie atd.) uložena ve stejné fyzické složce. Aktivace této volby způsobí, 
    že TNG bude ukládat média sice ve složkách jejich příslušných kolekcí, ale v podsložkách podle ID jejich přiřazených stromů (pokud není připojen žádný strom, soubor zůstane 
    ve hlavní složce kolekce). Kliknutím na tlačítko "Převést" přesunete příslušná média do této nové struktury složek. Pokud cílové složky stromů neexistují, budou vytvořeny.</p>

		<span class="optionhead">Favicon</span>
		<p>„Favicon“ je malá ikona zobrazená v adresním řádku prohlížeče, hned nalevo od adresy URL webu. TNG obsahuje výchozí ikony pro veřejnou 
    i administrátorskou část programu. TNG neobsahuje nástroj, který by vám pomohl vytvořit tyto ikony, ale pokud 
    nějakou ikony máte (nebo samostatné pro veřejné i pro správce), nahrajte je do složek img/public a/nebo img/admin a zadejte název souboru zde 
    v nastavení. Všimněte si, že pokud máte samostatné ikony pro veřejnost a správce, budete jim muset dát stejný název.</p>
      
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="lang"><p class="subheadbold">Jazyk</p></a>

		<span class="optionhead">Jazyk</span>
		<p>Výchozí složka jazyka (např. 'Czech'). Pro návštěvníky vašich stránek můžete mít dostupných několik jazyků, ale tento jazyk bude vždy zobrazen jako první.</p>

		<span class="optionhead">Znaková sada</span>
		<p>Znaková sada vašeho výchozího jazyka. Pokud toto pole ponecháte prázdné, bude použita výchozí znaková sada vašeho prohlížeče. Znaková sada pro angličtinu a jiné západoevropské jazyky používající 26 znakovou
		římskou abecedu je ISO-8859-1. Převládající kódování češtiny jsou ISO-8859-2, Windows-1250 a UTF-8.</p>

		<span class="optionhead">Dynamická změna jazyka</span>
		<p>Pokud máte nastaveno více jazyků a chcete, aby byli uživatelé schopni vybrat jiný jazyk "za chodu",
		vyberte <em>Povolit</em>.</p>
    
 		<span class="optionhead">Vypnout výrazy příbuzenských vztahů</span>
		<p>Toto nastavení skryje písemné vysvětlení příbuzenského vztahu v dolní části tabulky příbuzenských vztahů. To může být užitečné, pokud formulace vysvětlení nedává v příslušném jazyce vždy smysl.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="priv"><p class="subheadbold">Ochrana údajů</p></a>

		<span class="optionhead">Vyžadovat přihlášení</span>
		<p>Každý uživatel může běžně prohlížet veřejné prostředí vašich stránek, s přihlášením může volitelně vidět data žijících osob. Pokud však
		chcete, aby se muset přihlásit každý před tím než muže spatřit cokoli z vašich stránek, zaškrtněte toto pole.</p>

		<span class="optionhead">Omezit přístup pouze na připojený strom</span>
		<p>Je-li Vyžadovat přihlášení nastaveno na 'Ano', pak nastavení této volby na 'Ano' způsobí, že uživatelé budou moci pouze vidět data spojená se svými
		připojenými stromy. Všechny jiné osoby, rodiny, prameny, atd. budou skryty.</p>

		<span class="optionhead">Zobrazit údaje CJKSpd</span>
		<p>Chcete-li vždy zobrazovat data CJKSpd (Církev Ježíše Krista Svatých posledních dní (mormoni), jsou-li k dispozici), vyberte <em>Vždy</em> (dříve to bylo výchozí). Vypnout zobrazení všech údajů CJKSpd
		a možnosti ručně zapsat údaje CJKSpd můžete výběrem <em>Nikdy</em>. Chcete-li tuto možnost přepínat v závislosti na
		uživatelském oprávnění, vyberte <i>Podle práv uživatele</i>. V tomto případě údaje CJKSpd uvidí pouze přihlášení uživatelé, kteří mají oprávnění je vidět.
		Pro ostatní uživatele budou skryty.</p>

		<span class="optionhead">Zobrazit údaje o živých osobách</span>
		<p>Chcete-li vždy zobrazovat údaje žijících osob (data a místa), vyberte <i>Vždy</i>. Vypnout zobrazení údajů žijících osob můžete
		výběrem <i>Nikdy</i>. Chcete-li tuto možnost přepínat v závislosti na
		uživatelském oprávnění, vyberte <i>Podle práv uživatele</i>. V tomto případě údaje žijících osob uvidí pouze přihlášení uživatelé, kteří mají oprávnění je vidět.
		Pro ostatní uživatele budou skryty.</p>

		<span class="optionhead">Zobrazit jména žijících osob</span>
		<p>Chcete-li skrýt jména osob označených jako žijící (chybí údaje o úmrtí nebo pohřbu a zároveň se narodili před více než 110 lety), vyberte <em>Ne</em>. Jména žijících
		osob budou nahrazena slovem "Žijící". Pro zobrazení příjmení a iniciály křestního jména žijících osob vyberte <em>Zkrátit křestní jméno</em>. Chcete-li
		jména žijících osob zobrazit každému, vyberte <em>Ano</em>.</p>

		<span class="optionhead">Zobrazit jména osob označených jako neveřejné</span>
		<p>Chcete-li skrýt jména osob označených jako Neveřejné, vyberte <em>Ne</em>. Jména neveřejných
		osob budou nahrazena slovem "Neveřejné". Pro zobrazení příjmení a iniciály křestního jména neveřejných osob vyberte <em>Zkrátit křestní jméno</em>. Chcete-li
		jména neveřejných osob zobrazit každému, vyberte <em>Ano</em>.</p>
    
		<span class="optionhead">Zobrazit zprávu o povolení cookies</span>
		<p>Návštěvníkům stránek se zobrazí v pravém dolním rohu obrazovky malé vyskakovací okno a upozorní je, že web používá cookies.
    Jakmile návštěvník klikne na tlačítko "Rozumím", zpráva zmizí a soubor cookie bude nastaven na zapamatování akce. 
    Dokud tento soubor cookie přetrvává, návštěvníkovi se při následných návštěvách vyskakovací okno již znovu nezobrazí.</p>

		<span class="optionhead">Zobrazit odkaz na zásady ochrany dat</span>
		<p>Návštěvníkům stránek se zobrazí v zápatí v dolní části každé stránky odkaz na zásady ochrany dat na webu.
    Odkaz se také zobrazí ve vyskakovacím okně týkajícím se souborů cookie (viz výše) a na stránkách, kde je návštěvník požádán, aby dal souhlas s uložením osobních
    údajů (registrace nového účtu, navrhnout/kontaktujte nás). Kopie těchto zásad lze nalézt ve většině jazykových složek.
    Tento dokument se nazývá data_protection_policy.php. Pokud návštěvník používá jazyk, který neobsahuje překlad těchto zásad, bude mu zobrazena anglická verze.</p>

		<span class="optionhead">Žádost o souhlas ohledně osobních údajů</span>
		<p>Před odesláním připomínek, návrhů nebo registrace nového uživatele budou návštěvníci stránek vyzváni, aby zaškrtli políčko, ve kterém uvedou
    souhlas s uložením údajů ve formuláři, který vyplnili. Není-li políčko zaškrtnuto, tlačítko pro odeslání bude neaktivní. Pokud
    přesto dojde ke kliknutí na toto tlačítko, vyskakovací okno upozorní návštěvníka, že musí před odesláním formuláře zaškrtnouo políčko souhlasu.</p>

		<span class="optionhead">Nastavit označení Žijící pro nové osoby a rodiny</span>
		<p>Je-li tato možnost zapnutá, všechny nové osoby a rodiny budou označeny jako Žijící. U každé osoby nebo rodiny můžete toto označení zrušit.</p>

		<span class="optionhead">Povolit stahování csv u reportů</span>
		<p>Když uživatelé spouštějí vaše reporty, umožníte jim stáhnout soubor s výsledky oddělený čárkami (csv soubor). Takové soubory často usnadňují import informací do tabulky.</p>
      
		<span class="optionhead">reCAPTCHA</span>
		<p>reCAPTCHA je bezplatná služba, která chrání vaše stránky před spamem a zneužitím. Využívá nástroj pokročilé analýzy rizik a dokáže oddělit lidi a roboty. 
    Návštěvníci budou muset pouze zaškrtnout políčko označující, že nejsou robot. Chcete-li tuto službu aktivovat, budete potřebovat dva klíče: Site Key a Secret Key.</p>

		<span class="optionhead">Klíče Site Key a Secret Key</span>
		<p>Chcete-li získat své klíče Site Key a Secret Key, přejděte na stránku https://www.google.com/recaptcha/admin. Pokud ještě nemáte účet Google, bude si jej muset vytvořit.
    Pokud máte účet Google, na vyžádání se přihlaste a postupujte podle pokynů pro vytvoření klíčů. Po zobrazení výzvy k zadání adresy/názvu domény NEZADÁVEJTE "www" a 
    nezadávejte zadní lomítko. Po vytvoření klíčů je vložte do polí na této stránce.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="name"><p class="subheadbold">Jména</p></a>

		<span class="optionhead">Pořadí jména a příjmení</span>
		<p>Určí, jak budou ve většině případů jména zobrazena (některé seznamy vždy zobrazí příjmení jako první). Zvolit můžete zobrazení křestního jména jako první nebo příjmení jako první.
		Není-li nic vybráno, bude zobrazeno jako první křestní jméno.</p>

		<span class="optionhead">Všechna příjmení velkými písmeny</span>
		<p>Umožní zobrazit všechna příjmení velkými písmeny. Je-li tato volba nastavena na "Ne", budou jména zobrazena tak, jak byla zapsána nebo naimportována.</p>

		<span class="optionhead">Předpony příjmení</span>
		<p>Určí, jak se bude zacházet s předponami příjmení (např. "de" nebo "van"). Standardně je vše, co je obsaženo v poli příjmení souboru GEDCOM součástí příjmení, a podle toho jsou i
		příjmení tříděna ("de Kalb" je dříve než "van Buren"). Předpony příjmení můžete ponechat jako součást příjmení nebo je můžete oddělit
		jako samostatné subjekty (takto bude "van Buren" v řazení před "de Kalb"). Toto nebude mít vliv na existující příjmení, dokud je ručně neupravíte nebo nepřevedete pomocí surnameconvert400.php.</p>

		<span class="optionhead">Zjištění předpon při importu</span>
		<p>Pokud jste zvolili oddělení předpon jako samostatných subjektů, tato sekce stanoví pravidla, která pomohou rozhodnout importovací rutině, co je předponou. Předpony jsou definovány jako
		části jmen oddělené mezerami, ale vy můžete zvolit, kolik předpon každého jména bude součástí předpony v TNG. Jinými slovy, pokud určíte, že
		"Počet předpon každého (max)" je 1, pak bude do pole předpona ze jména "van der Merwe" přesunuto pouze "van". Na druhou stranu, pokud tuto hodnotu nastavíte na 2 nebo vyšší, předponou
		bude "van der". Označit můžete také určité předpony, které budou vždy odděleny jako samostatné předpony. Jinými slovy, nastavíte-li tuto hodnotu na "van der", pak
		bude "van der" vždy uvažována jako platná předpona nezávisle na tom, jak vysoká nebo nízká je předchozí hodnota. Více hodnot oddělujte čárkami. Je-li ve jméně předpona oddělena
		apostrofem, tento apostrof uveďte v seznamu také. Např.: "van,vander,van der,d',a',de,das".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="cem"><p class="subheadbold">Hřbitovy</p></a>

		<span class="optionhead">Maximální počet řádků ve sloupci (prům.)</span>
		<p>Pokud máte definováno velké množství hřbitovů, tento údaj řekne TNG, že je-li dosažen zadaný počet, seznam má být rozdělen
		a vytvořen další sloupec.</p>

		<span class="optionhead">Potlačit kategorii "Neznámé"</span>
		<p>Definujete-li hřbitov s chybějícími údaji o lokalitě (např. bez kraje nebo okresu), TNG vytvoří záhlaví nazvané
		"Neznámé" a tato prázdná pole zde budou seskupena. Výběr této volby způsobí, že TNG toto záhlaví vynechá.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="mail"><p class="subheadbold">Mail a registrace</p></a>

		<span class="optionhead">Emailová adresa</span>
		<p>Vaše emailová adresa. Požádá-li návštěvník o nový uživatelský účet, email bude posílán z této adresy. Na tuto adresu budou také zasílány 
    všechny zprávy ze stránky "Napište nám". Zprávy pocházející z formuláře "Návrh" přijdou na tuto adresu, pokud není se stromem odpovídajícím
    stránce, ze které byl poslán návrh, spojena žádná emailová adresa (jinak bude zpráva poslána na tuto adresu).</p>

		<span class="optionhead">Posílat všechny maily z výše uvedené adresy</span>
		<p>Když vám uživatel pošle zprávu prostřednictvím TNG, program se ji pokusí odeslat, jako by pocházela od něj,
    abyste mohli snáze odpovědět. Někteří poskytovatelé hostingu to však neumožňují. Odmítají posílat emaily, když adresa odesílatele
		nepochází ze stejné domény, jako jsou vaše stránky. Pokud zjistíte, že emaily z TNG nejsou posílány, váš hostitel se právě takto
		chová. Je-li to tento případ, nastavení této volby na Ano způsobí, že TNG bude posílat všechny maily z adresy 
		administrátora TNG (zapsaná výše). To by mělo problém vyřešit.</p>

		<span class="optionhead">Povolit nové registrace uživatelů</span>
		<p>Umožní vypnout možnost návštěvníků požádat o uživatelský účet na vašich stránkách.</p>

		<span class="optionhead">Upozornit na návrhy k přezkoumání</span>
		<p>Nastavení této hodnoty na "Ano" zajistí, že administrátorovi bude zaslána emailová zpráva, kdykoliv někdo s právem Vkládání
		vloží předběžnou změnu a čeká na administrativní přezkoumání.</p>

		<span class="optionhead">Vytvořit nový strom pro uživatele</span>
		<p>Je-li tato volba nastavena na Ano, pro každou novou uživatelskou registraci bude automaticky vytvořen nový strom a
		uživatel bude připojen k tomuto stromu.</p>

		<span class="optionhead">Automaticky schválit nové uživatele</span>
		<p>Všechny nové uživatelské registrace vyžadují běžně schválení administrátora před tím, než se stanou aktivními.
		Změnou tohoto nastavení na Ano budou automaticky aktivní všechny nové uživatelské požadavky. Nastavení uživatelského účtu budete
		ale moci upravit, abyste měli jistotu, že má uživatel přístupová práva, která jste mu chtěli dát.</p>

		<span class="optionhead">Posílat schvalovací mail</span>
		<p>Pokud je tato volba nastavena na Ano, každému potenciálnímu novému uživateli bude poslán email, který ho bude informovat, jeho požadavek
		byl obdržen a je zpracováván. Toto neplatí, pokud jsou nové registrace automaticky aktivovány.</p>

		<span class="optionhead">Zahrnout heslo do uvítacího mailu</span>
		<p>Heslo zvolené uživatelem je běžně zahrnuto na "uvítacího" emailu, který jej informuje, že je účet
		nyní aktivní. Nechcete-li, aby bylo heslo do emailu vkládáno, nastavte tuto hodnotu Ne.</p>

		<span class="optionhead">Použít ověření SMTP</span>
		<p>TNG posílá normálně maily pomocí PHP funkce "mail". Chcete-li raději použít Simple Mail Transfer Protocol, pak tuto hodnotu nastavte na "Ano". 
    Zobrazí se navíc některé další volby: Název SMTP hostitele, Uživatelské jméno pro email, Heslo pro email a Číslo portu. Správné hodnoty těchto polí
    by vám měl být schopen dát poskytovatel vašeho hostingu.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="pref"><p class="subheadbold">Předpony a přípony</p></a>

    <p>Tato písmena ve spojení s číslicí tvoří identifikační čísla (ID čísla) osob, rodin, pramenů, úložišť a poznámek ve vaší databázi. Většina genealogických
    programů používá stejnou sadu standardních předpon (a žádné přípony). Pokud váš desktopový program používá přípony nebo jiné předpony, můžete je zadat zde.
    Nejsou-li zadány správné předpony nebo přípony, některé funkce TNG nebudou pracovat správně.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="mobile"><p class="subheadbold">Mobil</p></a>

		<p>Sekce Mobil vám umožní určit, jak se bude TNG zobrazovat na chytrých telefonech a tabletech.</p>
		
		<span class="optionhead">Povolit responzivní tabulky</span>
		<p>Je-li tato volba nastavena na Ano, bbude aktivován plugin Tablesaw jQuery, který umožňuje responzivní tabulky.<br />Je-li volba nastavena na Ne, plugin Tablesaw jQuery nebude aktivní.</p>
		
		<span class="optionhead">Typ responzivní tabulky</span>
		<p>Typ responzivní tabulky může být nastaven na
		<ul>
			<li><strong>Toggle</strong>, který je výchozí, a zobrazí data ve sloupcích založených na šířce displeje a přiřazené prioritě.  Otočením displeje chytrého telefonu nebo tabletu na šířku budou zobrazeny další sloupce dat.</li> 
				
			<li><strong>Stack</strong>, který shrne záhlaví tabulky do dvousloupcového návrhu se záhlavím nalevo, je-li šířka výřezu menší než 40em (640px).</li>
			
			<li><strong>Swipe</strong>, který umožní uživateli k navigaci sloupců použít gesto posunu (nebo použít levé a pravé tlačítko).</li>
		</ul>
		<br />
		<span class="optionhead">Povolit přepínač módů responzivních tabulek:</span>
		<p>Volba přepínače módů umožní uživateli přepínat mezi jednotlivými typy zobrazení sloupců tabulek: toggle, stack nebo swipe.</p>

		<span class="optionhead">Povolit minimapu responzivních tabulek</span>
		<p>Použití minimapy přidá sérii malých teček ukazujících, které sloupce jsou aktuálně viditelné a které jsou skryté. 
			K dispozici pouze v módu swipe a toggle. </p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="misc"><p class="subheadbold">Testy DNA</p></a>

		<span class="optionhead">Skrýt všechny stránky a údaje k DNA</span>
		<p>Pokud nebudete používat žádnou z funkcí souvisejících s DNA a chtěli byste ji odstranit ze všech veřejných stránek, nastavte tuto možnost na Ano. Testy DNA již nebudou přístupné z veřejných nabídek, 
    ani se nebudou zobrazovat na individuální stránce žádné osoby.</p>
		<span class="optionhead">Maximální počet výsledků hledání</span>
    <p>Maximální počet výsledků hledání v sekci Testy DNA řídí počet výsledků DNA, které lze zobrazit nezávisle na výsledcích vyhledávání TNG pro dotazy z testů procházení DNA.</p><p><strong>Pozn.:</strong> Pokud nemůžete vybrat test DNA, který chcete porovnat, protože je na jiné stránce, zvyšte tento limit, aby se všechny testy DNA, které chcete porovnat, zobrazily na stejné stránce.</p>
		<span class="optionhead">Zobrazit počet testů DNA veřejně</span>
		<p>Tato volba umožňuje skrýt nebo zobrazit počet testů DNA na veřejných stránkách testů DNA.</p>
		<span class="optionhead">Rodová příjmení vyplnit automaticky</span>
		<p>Tato volba automaticky přidá rodová příjmení do vašich otcovských a mateřských přímých linií po uložení testu DNA. Možná budete chtít omezit počet generací, kterých se to má týkat.</p>
 		<span class="optionhead">Rodová příjmení velkými písmeny </span>
		<p>Tato volba používá všechna velká písmena pro rodová příjmení, pokud je nastaveno automatické vyplňování příjmení předků na Ano. Výchozí nastavení je Ne a příjmení jsou tedy zobrazena tak, jak jsou zapsána.</p>
		<span class="optionhead">Generace pro rodová příjmení</span> 
		<p>Určuje, kolik generací zpět se má vyhledat při použití možnosti automatického vyplňování rodových příjmení.</p>
		<span class="optionhead">Vyloučit z rodových příjmení</span>
		<p>Určuje, která příjmení nezahrnout při použití možnosti automatického vyplňování rodových příjmení.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="misc"><p class="subheadbold">Různé</p></a>

		<span class="optionhead">Maximální počet výsledků hledání</span>
		<p>Tato volba omezuje počet výsledků, které mohou být zobrazeny z veřejného vyhledávacího dotazu. Může to být relativně malé, zvládnutelné číslo, aby byla
		maximalizována efektivnost a zlepšení zkušeností uživatelů.</p>

		<span class="optionhead">Osoby začínají na</span>
		<p>Tato volba označuje, které údaje budou viditelné nejdříve, když je zobrazen záznam osoby. Pokud vyberete
		"Pouze osobní údaje", ostatní kategorie jako Poznámky, Citace nebo Fotografie a Vyprávění
		budou skryty, dokud uživatel nerozkryje příslušnou kategorii nebo "Vše".</p>

		<span class="optionhead">Zobrazit poznámky</span>
		<p>Tato volba vám umožní zvolit, kde budou na stránce osoby zobrazeny poznámky. Možnosti jsou následující:</p>

		<ul>
			<li>V sekci poznámek: Všechny poznámky budou zobrazeny ve zvláštním bloku na konci stránky.</li>
			<li>Pod odpovídajícími událostmi, kde je to možné: Poznámky k určitým událostem budou zobrazeny přímo pod odpovídajícími událostmi. Obecné poznámky budou zobrazeny
				na konci "Osobní" sekce a každé sekce "Rodina". Pokud jsou obecné poznámky dlouhé, objeví se posuvník, který zajistí, že stránka nebude moc dlouhá
				(maximální výška oblasti je definována v souboru genstyle.css v bloku "notearea").</li>
			<li>Pod událostmi mimo obecných poznámek: Totéž jako v předchozím případě, pouze obecné poznámky budou zobrazeny vždy v odděleném bloku na konci stránek. Neukládá se
        žádná maximální výška.</li>
		</ul>

    <span class="optionhead">Posouvání citací</span>
		<p>Nastavení této předvolby na "Ano" způsobí, že oblast pramenů na konci každé stránky osoby bude mít maximální výšku. Pokud je u osoby přiřazeno více citací pramenů
    než jsou maximální rozměry oblasti, objeví se v této oblasti posuvník.</p>

		<span class="optionhead">Časový odstup serveru (v hodinách)</span>
		<p>Nachází-li se váš server v jiné časové zóně než vy, můžete sem napsat rozdíl v hodinách. Je-li váš čas vyšší než čas serveru, zapište záporné číslo.</p>

		<span class="optionhead">Upravit prodlevu (v minutách)</span>
		<p>Počet minut, který je uživateli povolen pro výhradní právo u editace záznamu osoby nebo rodiny. Během této doby uvidí jiný uživatel, který se pokouší upravovat stejný
		záznam, zprávu, která mu sdělí, že je záznam uzamčen. Pokud se blíží čas k zapsanému limitu a původní uživatel stále záznam upravuje, uvidí tento uživatel zprávu,
		která jej bude varovat, aby co nejrychleji uložil své změny. Pokud uživatel své změny neuloží před tím, než získá přístup k tomuto záznamu jiný uživatel, jeho změny
		budou ztraceny.</p>

		<span class="optionhead">Maximální počet generací při uložení GEDCOMU</span>
		<p>Maximální počet generací, které mohou být exportovány ve veřejném požadavku na vytvoření souboru GEDCOM.</p>

		<span class="optionhead">Co je nového dny</span>
		<p>Počet dní, po které budou na stránce "Co je nového" zobrazovány nové položky. Toto omezení odstraníte nastavením hodnoty na nulu. To zapříčiní, že na seznamu zůstanou
		starší položky, dokud nebudou nahrazeny novějšími.</p>

		<span class="optionhead">Co je nového limit</span>
		<p>Maximální počet položek v každé kategorii, který bude zobrazen na stránce "Co je nového".</p>

		<span class="optionhead">Přednost číselného data</span>
		<p>Zapíšete-li číselné datum (např. 04/09/2008), tato volba zajistí, zda bude zápis data interpretován jako Měsíc/Den/Rok (9 Dub 2008)
		nebo Den/Měsíc/Rok (4 Zář 2008).</p>

		<span class="optionhead">První den v týdnu</span>
		<p>Tento den bude prvním sloupcem zleva při zobrazení stránky kalendáře.</p>

		<span class="optionhead">Údaje rodičů na stránce osoby</span>
		<p>Vyberte, které události (pokud nějaké) spojené s rodinou rodičů osoby mají být zobrazeny.</p>

		<span class="optionhead">Konec řádku</span>
		<p>Jedná se o znakový řetězec, který bude vložen na konec každého řádku při exportu souboru GEDCOM. Je to též řetězec,
		který bude obsahovat konec řádku při importu. Výchozím je "\r\n", které znamená "návrat na začátek řádku a odřádkování".
    Některé programy nebo operační systémy preferují jen návrat na začátek řádku (\r) nebo odřádkování (\n), takže
		můžete v některých případech toto nastavení měnit.</p>

		<span class="optionhead">Typ šifrování</span>
		<p>Před uložením do databáze jsou hesla v TNG šifrována. Díky tomu jednoduše nelze ruční opravou databáze heslo měnit nebo smazat.
		Výchozí metodou šifrování je md5, ale zde můžete vybrat jinou metodu.</p>

		<span class="optionhead">Připojit záznamy míst ke stromům</span>
		<p>Je-li tato volba nastavena na "Ano", každý záznam místa pak bude připojen k místu ve vašem stromě. To znamená, že máte-li více stromů, může se
		stejné místo objevit v tabulce míst vícekrát, protože je spojeno s více stromy. Změníte-li tuto volbu na "Ne", bude 
		vám dána možnost automaticky sloučit všechna místa do jednoho seznamu. Pokud tuto volbu změníte na "Ano", zobrazí se vám možnost připojit
		určitý strom ke všem místům (pokud neměly dříve žádné připojení).</p>

		<span class="optionhead">Geokódovat všechna nová místa</span>
		<p>Je-li tato volba nastavena na "Ano", všechna nová místa zapsaná v Admin/Osoba a Admin/Rodina budou automaticky geokódována (předpokládá to
		připojení k internetu).</p>

 		<span class="optionhead">Znovu použít smazaná ID čísla</span>
		<p>Je-li tato volba nastavena na "Ano" u nové osoby, rodiny, pramenu a úložišti pramenů, budou znovu použita čísla ID, která byla dříve smazána.</p>

 		<span class="optionhead">Zobrazit poslední import</span>
		<p>Pokud je tato volba nastavena na "Ano", bude na stránkách Co je nového a Statistiky zobrazeno datum posledního importu souboru GEDCOM, je-li vybrán strom.</p>

    <span class="optionhead">Zobrazit oznámení 'Důležité úkoly'</span>
		<p>Nastavte "Ano", pokud chcete, aby program TNG zobrazoval v horní části nabídky Administrace seznam důležitých úkolů. Ty budou obsahovat výzvy k zálohování dat, 
    ke kontrole nových uživatelských registrací a další. Můžete i nadále zvolit sbalení zprávy, i když zde umožníte jejich zobrazení.</p>

		<span class="optionhead">Zobrazit celkové součty záznamů v menu Administrace</span>
		<p>Umožní TNG zobrazit v hlavní nabídce Administrace součty pro každou kategorii. Například, pokud máte v TNG uloženo 1000 lidí, na pravé straně lišty "Osoby" uvidíte "1000".</p>

		<span class="optionhead">Upozornit, pokud záloha nebyla vytvořena během tohoto počtu dní</span>
		<p>Po uplynutí zadaného počtu dní od vytvoření poslední zálohy alespoň jedné z vašich tabulek, TNG zařadí upozornění do sekce "Důležité úkoly" v horní části nabídky Administrace.
    Pokud nechcete tato upozornění zobrazovat, nastavte tuto hodnotu na nulu.</p>
    
    <span class="optionhead">Používám TNG offline</span>
		<p>Je-li vybráno "Ano", TNG použije lokální verze namísto on-line verzí knihoven třetích stran (např. JQuery) a nebude se pokoušet o přístup ke Google mapám.</p>

	</td>
</tr>

</table>
</body>
</html>
