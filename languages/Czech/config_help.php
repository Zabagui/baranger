<?php
include("../../helplib.php");
echo help_header("Nápovìda: Základní nastavení");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="setup_help.php" class="lightlink">&laquo; Nápovìda: Nastavení</a> &nbsp; | &nbsp;
			<a href="pedconfig_help.php" class="lightlink">Nápovìda: Nastavení schémat &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Základní nastavení</span>
		<p class="smaller menu">
			<a href="#data" class="lightlink">Databáze</a> &nbsp; | &nbsp;
			<a href="#table" class="lightlink">Tabulky</a> &nbsp; | &nbsp;
			<a href="#path" class="lightlink">Umístìní a slo¾ky</a> &nbsp; | &nbsp;
			<a href="#site" class="lightlink">Stránka</a> &nbsp; | &nbsp;
			<a href="#media" class="lightlink">Média</a> &nbsp; | &nbsp;
			<a href="#lang" class="lightlink">Jazyk</a> &nbsp; | &nbsp;
			<a href="#priv" class="lightlink">Ochrana údajù</a> &nbsp; | &nbsp;
			<a href="#name" class="lightlink">Jména</a> &nbsp; | &nbsp;
			<a href="#cem" class="lightlink">Høbitovy</a> &nbsp; | &nbsp;
			<a href="#mail" class="lightlink">Mail</a> &nbsp; | &nbsp;
			<a href="#pref" class="lightlink">Pøedpony</a> &nbsp; | &nbsp;      
			<a href="#mobile" class="lightlink">Mobil</a> &nbsp; | &nbsp;
			<a href="#misc" class="lightlink">Rùzné</a>
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

		<span class="optionhead">Hostitel databáze, název, u¾ivatelské jméno, heslo, port a socket</span>
		<p>Tyto údaje pou¾ije TNG a PHP k pøipojení k va¹í databázi. Kromì portu a socketu (málo pou¾ívané), musí být tato pole vyplnìna døív, ne¾ bude va¹e databáze 
		zpøístupnìna. <strong>Pozn.</strong>: Toto u¾ivatelské jméno a heslo mù¾e být jiné, ne¾ jsou va¹e obvyklé pøístupové údaje k webové stránce.
		Pokud se po vlo¾ení tìchto údajù objeví chybové hlá¹ení, ¾e TNG nemù¾e komunikovat s va¹í databází,
		pak je nìkterý z tìchto údajù chybný. Neznáte-li správné údaje, vy¾ádejte si je u poskytovatele va¹eho
		webového hostingu. Název hostitel mù¾e také obsahovat èíslo portu nebo cestu do socketu (socket path), napø. "localhost:3306" nebo "localhost:/path/to/socket".
		Tyto údaje jsou dùle¾ité, tak¾e je zadávejte s maximální pøesností. Pokud pùsobíte jako svùj vlastní webmaster, ujistìte se, ¾e jste vytvoøili databázi
		a pøidali do ní u¾ivatele (u¾ivatel musí mít V©ECHNA pøístupová práva).</p>

		<span class="optionhead">Re¾im údr¾by</span>
		<p>Je-li TNG v re¾imu údr¾by, data nejsou pøístupná veøejnosti. Náv¹tìvníkovi se zobrazí zpráva, 
		která mu oznámí, ¾e na stránkách probíhá údr¾ba a mù¾e se sem vrátit pozdìji. Va¹i stránku mù¾ete
		pøepnout do re¾imu údr¾by pøi importu va¹ich dat. Pokud chcete pøeèíslovat va¹e ID èísla, pøepnutí do re¾imu údr¾by
		je nutné. Pokud jste se v re¾imu údr¾by "zasekli", mù¾ete pøímo opravit vá¹ soubor config.php a obnovit nastavení promìnné $tngconfig['maint']
		na 0 nebo prázdnou.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="table"><p class="subheadbold">Názvy tabulek</p></a>

		<span class="optionhead">Názvy tabulek</span>
		<p>Výchozí názvy byste nemìli mìnit, pokud u¾ nìkteré tabulky mají tyto názvy. V¹echny názvy tabulek musí být vyplnìny a v¹echny názvy musí být jednoznaèné. 
    Nemìòte názvy existujících tabulek.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="path"><p class="subheadbold">Umístìní a slo¾ky</p></a>

		<span class="optionhead">Koøenová slo¾ka</span>
		<p>Toto je slo¾ka v systému, ve které jsou umístìny va¹e soubory TNG. Není to webová adresa.
		Zapsat musíte koncové lomítko. Pokud tuto stránku otevøete poprvé, va¹e koøenová slo¾ka by mìla být vyplnìna správnì. Nemìòte ji, pokud nejste pokroèilý u¾ivatel
		nebo nejste instruováni, jak to udìlat. Pokud sma¾ete obsah tohoto pole a stránku ulo¾íte, správná slo¾ka se objeví po opìtovném naètení této stránky, ale
		stránku musíte ulo¾it znovu, aby se nová slo¾ka ulo¾ila.</p>

		<span class="optionhead">Konfiguraèní slo¾ka</span>
		<p>Pokud chcete va¹e konfiguraèní TNG soubory na bezpeènìj¹í místo mimo koøenovou slo¾ku webu (tak¾e nebudou pøístupny
		z webu), zapi¹te tuto slo¾ku zde. <strong>Musí</strong> konèit koncovým lomítkem (/). Bude to pravdìpodobnì èást koøenové slo¾ky.
		Je-li napø. va¹e koøenová slo¾ka "/home/www/username/public_html/genealogy/", jako konfiguraèní slo¾ku mù¾ete zvolit "/home/www/username/".</p>

		<p><strong>DÙLE®ITÉ:</strong> Pou¾ití tohoto pole je
		zcela volitelné a nebude mít vliv na provoz va¹ich stránek. Vyplnit byste jej mìli pouze, kdy¾ dokonale znáte 
    strukturu slo¾ek na va¹ich webových. Pokud sem nìjaké umístìní zapí¹ete, <strong>musíte následující soubory pøesunout 
		do konfiguraèní slo¾ky okam¾itì po ulo¾ení</strong> a zmìnit je na zapisovatelné (oprávnìní 664 nebo 666): config.php, customconfig.php, importconfig.php,
		logconfig.php, mapconfig.php, mmconfig.php and pedconfig.php. Pokud tak neuèiníte, na va¹ich stránkách nebude nic fungovat. Pokud udìláte chybu a va¹e stránky pøestanou pracovat,
		budete muset ruènì opravit vá¹ soubor subroot.php a zapsat správnou slo¾ku do promìnné $tngconfig['subroot'] (její opìtovné nastavení na prázdnou hodnotu vrátí vá¹ systém
		do výchozího stavu).</p>

		<span class="optionhead">Slo¾ky Fotografie / Dokumenty / Vyprávìní / Náhrobky / Multimédia / Módy / Extensions / GENDEX / Záloha</span>
		<p>Do tìchto polí zapi¹te název slo¾ky nebo adresáøe pro zmínìné entity. V¹echny by mìly mít globální pøístup èíst+psát+provést (read+write+execute, 755 nebo 775, i kdy¾ nìkteré systémy vy¾adují 777).
		Slo¾ka multimédií je urèena jako "záchytná" pro v¹echny polo¾ky médií, které se nehodí do jiných kategorií (napø. videa a
		zvukové záznamy). Názvy tìchto slo¾ek lze zmìnit zadáním nových názvù a kliknutím na odpovídající tlaèítka "Pøejmenovat". A¾ budete s touto stránkou hotovi, nezapomeòte kliknout na "Ulo¾it".</p>
		<p>Pozn.: Políèko pod názvem slo¾ky zálohy za¹krtnìte, chcete-li, aby byla slo¾ka záloh ulo¾ena v umístìní konfiguraèní cesty (viz vý¹e). Skuteènou slo¾ku musíte pøesunout do konfiguraèního umístìní sami mimo TNG.</p>    

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="site"><p class="subheadbold">Vzhled a definice stránek</p></a>

		<span class="optionhead">Domovská stránka</span>
		<p>V¹echna menu v programu TNG obsahují odkaz na "domovskou stránku". Do tohoto pole zapi¹te adresu tohoto odkazu. Standardnì je to stránka index.php ve slo¾ce s ostatními
		soubory TNG. Musí to být relativní odkaz ("index.php" nebo "../otherhomepage.html"), nikoli absolutní odkaz ("https://yoursite.com").</p>

		<span class="optionhead">URL genealogických stránek</span>
		<p>Webová adresa va¹í genealogické slo¾ky (napø. "https://mysite.com/genealogy").</p>

		<span class="optionhead">Název stránek</span>
		<p>Obsah tohoto pole bude zobrazen v tagu HTML "Title" na ka¾dé stránce a bude zobrazen na horním okraji okna va¹eho prohlí¾eèe.</p>

		<span class="optionhead">Popis stránek</span>
		<p>Krátký popis va¹ich stránek pro pou¾ití v kanálu RSS.</p>

		<span class="optionhead">Doctype Deklarace</span>
		<p>Tento text je umístìn v horní èásti ka¾dé stránky ve veøejném prostøedí a dá prohlí¾eèi u¾ivatele informaci, kterou potøebuje
		ke správnému zobrazení stránky. Ovìøovací testy, které bì¾í na stránkách, pou¾ijí tento údaj k urèení, jaké se 
    mohou objevit problémy. Pokud toto pole necháte prázdné, bude pou¾it výchozí XHTML Transitional doctype.</p>

		<span class="optionhead">Majitel stránek</span>
		<p>Va¹e jméno, pøípadnì va¹e obchodní jméno. Toto jméno se objeví v odchozích mailech z TNG.</p>

		<span class="optionhead">Cílový rámec</span>
		<p>Pokud va¹e stránka pou¾ívá rámce, toto pole pou¾ijte pro oznaèení, ve kterém rámci mají být zobrazeny stránky TNG. Pokud rámce nepou¾íváte, 
		nechte v tomto poli hodnotu "_self".</p>

		<span class="optionhead">Vlastní záhlaví / zápatí / meta</span>
		<p>Názvy souborù pro èásti stránky, které se pou¾ívají jako záhlaví, zápatí a sekci HEAD ("meta") va¹í TNG stránky. Dodávány jsou soubory s výchozími názvy.
		Pou¾ívá-li se v tìchto souborech kódování PHP, musí mít pøípony .php. Chcete-li je vyu¾ít v ¹ablonách vzhledu, musíte tato záhlaví a zápatí mít nazvaná
		jako topmenu.php a footer.php.</p>
    
		<span class="optionhead">Volitelná zpráva zápatí</span>
		<p>Zpráva nebo fragment kódu HTML, který se zobrazí ve spodní èásti ka¾dé stránky.</p>    

		<span class="optionhead">Styl zálo¾ek</span>
		<p>Soubor, který urèuje styl zálo¾ek zobrazených na vìt¹inì veøejných stránek. Výchozí styl (tngtabs2.css) pou¾ívá jemnì zaoblené zálo¾ky, ale
		TNG dodává také alternativní styl se ¹ikmými zálo¾kami (tngtabs1.css). Chcete-li zobrazit zálo¾ky v tomto stylu, zapi¹te do tohoto pole "tngtabs1.css"
		a kliknìte na "Ulo¾it" ve spodní èásti stránek, a poté zkuste vyhledat nìjakou osobu ve veøejném prostøedí. Styl (tngtabs1.css) vyu¾ívá dva obrázky, "tngtab.png" (neaktivní
		zálo¾ky) a "tngtabactive.png" (aktivní zálo¾ky). Chcete-li zmìnit barvu tìchto obrázkù, mù¾ete pou¾ít jakýkoli obrazový editor nebo kliknout na odkaz na konci tohoto odstavce. Na dal¹í stránce
		zapi¹te <strong>decimální</strong> hodnoty èervené, zelené a modré komponenty uva¾ované nové barvy, a pak kliknìte na Potvrdit. Potom uvidíte nový obrázek, který mù¾ete ulo¾it na va¹e stránky jako
		tngtab.png nebo tngtabactive.png. <a href="https://lythgoes.net/genealogy/switchcolor.php">https://lythgoes.net/genealogy/switchcolor.php</a></p>

		<span class="optionhead">Umístìní menu</span>
		<p>TNG menu mù¾e být na ka¾dé stránce umístìno nahoøe vlevo nad jménem osoby nebo jiným èíslem stránky, nebo na ka¾dé stránce nahoøe vpravo, pøímo proti jménu nebo
		jinému èíslu stránky. Dynamický rozbalovací seznam pro výbìr jazyku bude na obrazovce umístìn ve stejné sekci.</p>

		<span class="optionhead">Zobrazit odkazy na domovskou stránku / Hledat / Pøihlá¹ení/Odhlá¹ení / Sdílet / Tisk / Pøidat zálo¾ku</span>
		<p>Nìkteré tyto volby (Domovská stránka/Hledat/Pøihlá¹ení) jsou na ka¾dé stránce umístìny nahoøe vlevo, pod záhlavím stránky a nad linií zálo¾ek. Jiné
		(Sdílet/Tisk/Pøidat zálo¾ku) jsou umístìny nahoøe vpravo, pod li¹tou menu.
		Ka¾dou tuto volbu mù¾ete pomocí ovládacích prvkù zapnout nebo vypnout.</p>
    
    <span class="optionhead">Cíl odkazu Hledat</span>
		<p>Odkaz Hledat v horní èásti ka¾dé stránky ve výchozím chování otevøe malé okno, ve kterém mù¾ete hledat pomocí zápisu jména nebo èísla ID. Toto se nazývá "Rychlé hledání".
    Výbìrem této pøedvolby mù¾ete místo toho pøejít na stránky Roz¹íøené hledání.</p>

		<span class="optionhead">Skrýt popisky køtu</span>
		<p>Tato volba umo¾òuje skrýt v¹echny zmínky o události "køtu".</p>

		<span class="optionhead">Alternativní události narození</span>
		<p>Výchozí alternativní události narození jsou køest (CHR) a køest (BAPM), ale mù¾ete to zmìnit zde pøidáním nebo nahrazením vlastních tagù GEDCOM. 
    U¾ivatelé, kteøí provádìjí zmìny v datech, pak budou moci vybrat pøíslu¹nou událost z tohoto seznamu.</p>

		<span class="optionhead">Výchozí strom</span>
		<p>Pokud existuje více stromù, na v¹ech stránkách, kde je mo¾ný výbìr stromu (vèetnì funkce hledání
		na va¹í domovské stránce) bude výchozí nastavení "V¹echny stromy". Chcete-li, aby tento výbìr nabízel pouze urèitý strom,
		tento strom vyberte zde. Kdekoli u¾ivatel zapí¹e URL bez ID èísla stromu (nebo s prázdným ID èíslem stromu), dotaz
		bude smìøovat k tomuto stromu. <strong>POZN.</strong>: Pokud máte pouze jeden strom, je lep¹í toto pole nechat prázdné.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="media"><p class="subheadbold">Média</p></a>

		<span class="optionhead">Typ souborù fotografií</span>
		<p>Pøípona souboru v¹ech malých fotografií pou¾ívaných ve schématech. Ostatní fotografie nemusí obsahovat tuto pøíponu. Pro vìt¹inu fotografií je doporuèena pøípona .jpg.</p>

		<span class="optionhead">Zobrazit roz¹íøenou informaci o obrázku</span>
		<p>Pokud je tato volba za¹krtnuta, budou u ka¾dé fotografie zobrazeny roz¹íøené informace. Ty obsahují fyzický název souboru, rozmìry v pixelech a
		existující údaje IPTC.</p>

		<span class="optionhead">Maximální vý¹ka a ¹íøka obrázku</span>
		<p>Jsou-li tyto hodnoty nastaveny (pixely), obrázky vìt¹í ne¾ tyto rozmìry budou pøi zobrazení ve veøejném prostøedí zmen¹eny (pou¾itím HTML).</p>

		<span class="optionhead">Pøedpona/prefix pro náhledy</span>
		<p>Pøi automatickém generování náhledu pøidá TNG tuto hodnotu pøed originální název souboru a vytvoøí tak název souboru náhledu. Pokud název originálního souboru obsahuje údaj o cestì,
		pøedpona bude vlo¾ena pøímo pøed název souboru. Tato pøedpona mù¾e obsahovat název slo¾ky (napø. "thumbnails/"). Pokud
		pou¾ijete název slo¾ky jako souèást pøípony, ujistìte se, ¾e tato slo¾ka existuje a má stejná oprávnìní jako slo¾ka nadøízená fotografií.</p>

		<span class="optionhead">Pøípona/sufix pro náhledy</span>
		<p>Pøi automatickém generování náhledu pøidá TNG tuto hodnotu k originálnímu názvu souboru a vytvoøí tak název souboru náhledu.</p>

		<span class="optionhead">Maximální vý¹ka náhledu</span>
		<p>TNG automaticky vytvoøí náhled obrázku, který nebude vy¹¹í, ne¾ je nastavená vý¹ka (pixely).</p>

		<span class="optionhead">Maximální ¹íøka náhledu</span>
		<p>TNG automaticky vytvoøí náhled obrázku, který nebude ¹ir¹í, ne¾ je nastavená ¹íøka (pixely).</p>

		<span class="optionhead">Pou¾ít výchozí náhledy</span>
		<p>Pokud osoba nemá výchozí fotografii a tato volba je povolena, na v¹ech stránkách, na kterých je odkaz na tuto osobu, bude pou¾it místo toho obecný náhled, který rozli¹uje pohlaví.</p>

		<span class="optionhead">Maximální poèet znakù v seznamu poznámek</span>
		<p>Chcete-li zkrátit poznámky, které jsou zobrazovány na stránkách se seznamy (jako jsou veøejné stránky fotografie, dokumenty a vyprávìní), nastavte toto pole na maximální
		poèet znakù, který má být zobrazen. Necháte-li jej prázdné, bude zobrazena kompletní poznámka.</p>

		<span class="optionhead">Povolit prezentaci</span>
		<p>Umo¾ní automatické postupné zobrazování fotografií ve veøejném prostøedí stránek po kliknutí na odkaz "Zahájit prezentaci". Nastavení
		této hodnoty na 'Ne' skryje tento odkaz a zaká¾e pou¾ití této funkce.</p>

		<span class="optionhead">Automatické opakování prezentace</span>
		<p>Nastavení této hodnoty na 'Ano' povolí automatický pokraèující bìh prezentace.</p>

		<span class="optionhead">Umo¾nit prohlí¾eè obrázkù</span>
		<p>Nastavení této volby na 'V¾dy' zobrazí ka¾dou obrázkovou polo¾ku (soubory .jpg, .gif a .png) v prohlí¾eèi obrázkù. Nastavení na 'Pouze dokumenty' vypne
		prohlí¾eè obrázkù pro v¹echny obrázková média, které nejsou 'Dokumenty' nebo jiné typy médií, které se chovají jako Dokumenty.</p>

		<span class="optionhead">Vý¹ka prohlí¾eèe obrázkù</span>
		<p>Nastavení této volby na 'V¾dy zobrazit celý obrázek' zajistí, ¾e je obrázek viditelný ve výchozích rozmìrech. Nastavení na 'Pevná (640px)' zapøíèiní, ¾e obrázky vy¹¹í ne¾
		640 pixelù budou pøi zobrazení oøíznuty na tuto vý¹ku. Ovládací prvky prohlí¾eèe mohou být dále pou¾ívány k posunu obrázku nebo pøiblí¾ení èi oddálení.</p>

    <span class="optionhead">Skrýt média osob</span>
		<p>Je-li tato pøedvolba nastavena na "Ano", seznam médií na stránce osoby bude zaèínat ve sbaleném stavu. Místo náhledù a popiskù uvidíte pouze celkový poèet podle typù médií.
    Náv¹tìvníci budou moci ka¾dou sekci médií rozbalit, ale po obnovení naètení stránky bude seznam opìt sbalen.</p>
    
    <span class="optionhead">Pøi smazání souèasnì odstranit fyzický soubor</span>
		<p>Tato volba urèuje, co se stane, kdy¾ bude smazán individuální záznam médií. Je-li tato mo¾nost nastavena na "Ano", pøidru¾ený fyzický soubor bude také smazán. 
    Je-li volba nastavena na hodnotu "Ne", bude odebrán pouze záznam v databázi a fyzický soubor zùstane neporu¹ený. Je-li tato mo¾nost nastavena na mo¾nost "Na vy¾ádání", 
    budete vyzváni k rozhodnutí, zda má být pøidru¾ený soubor smazán nebo ne.</p>

		<span class="optionhead">Zobrazit fotografie na jednom øádku</span>
		<p>Toto se týká náhledù zobrazených na stránce osoby. Pokud je v nìjaké oblasti obsa¾eno více náhledù, lze tuto volbu pou¾ít k zobrazení v¹ech náhledù vodorovnì na jednom øádku 
    (pokud je obrázkù pøíli¹ mnoho na to, aby byly v¹echny zobrazeny na jednom øádku, budou pokraèovat na dal¹ím øádku) nebo v seznamu, jak to bylo obvyklé ve star¹ích verzích TNG. 
    Pokud jsou náhledy zobrazeny vodorovnì, nebudou u nich zobrazeny ¾ádné popisky. Média, která nemají náhledy, budou stále zobrazena svisle.</p>

		<span class="optionhead">Rozdìlit média do slo¾ek stromù</span>
		<p>Ve výchozím nastavení jsou v¹echna fyzická média z ka¾dé kolekce (tj. Fotografie, Dokumenty, Historie atd.) ulo¾ena ve stejné fyzické slo¾ce. Aktivace této volby zpùsobí, 
    ¾e TNG bude ukládat média sice ve slo¾kách jejich pøíslu¹ných kolekcí, ale v podslo¾kách podle ID jejich pøiøazených stromù (pokud není pøipojen ¾ádný strom, soubor zùstane 
    ve hlavní slo¾ce kolekce). Kliknutím na tlaèítko "Pøevést" pøesunete pøíslu¹ná média do této nové struktury slo¾ek. Pokud cílové slo¾ky stromù neexistují, budou vytvoøeny.</p>

		<span class="optionhead">Favicon</span>
		<p>"Favicon" je malá ikona zobrazená v adresním øádku prohlí¾eèe, hned nalevo od adresy URL webu. TNG obsahuje výchozí ikony pro veøejnou 
    i administrátorskou èást programu. TNG neobsahuje nástroj, který by vám pomohl vytvoøit tyto ikony, ale pokud 
    nìjakou ikony máte (nebo samostatné pro veøejné i pro správce), nahrajte je do slo¾ek img/public a/nebo img/admin a zadejte název souboru zde 
    v nastavení. V¹imnìte si, ¾e pokud máte samostatné ikony pro veøejnost a správce, budete jim muset dát stejný název.</p>
      
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="lang"><p class="subheadbold">Jazyk</p></a>

		<span class="optionhead">Jazyk</span>
		<p>Výchozí slo¾ka jazyka (napø. 'Czech'). Pro náv¹tìvníky va¹ich stránek mù¾ete mít dostupných nìkolik jazykù, ale tento jazyk bude v¾dy zobrazen jako první.</p>

		<span class="optionhead">Znaková sada</span>
		<p>Znaková sada va¹eho výchozího jazyka. Pokud toto pole ponecháte prázdné, bude pou¾ita výchozí znaková sada va¹eho prohlí¾eèe. Znaková sada pro angliètinu a jiné západoevropské jazyky pou¾ívající 26 znakovou
		øímskou abecedu je ISO-8859-1. Pøevládající kódování èe¹tiny jsou ISO-8859-2, Windows-1250 a UTF-8.</p>

		<span class="optionhead">Dynamická zmìna jazyka</span>
		<p>Pokud máte nastaveno více jazykù a chcete, aby byli u¾ivatelé schopni vybrat jiný jazyk "za chodu",
		vyberte <em>Povolit</em>.</p>
    
 		<span class="optionhead">Vypnout výrazy pøíbuzenských vztahù</span>
		<p>Toto nastavení skryje písemné vysvìtlení pøíbuzenského vztahu v dolní èásti tabulky pøíbuzenských vztahù. To mù¾e být u¾iteèné, pokud formulace vysvìtlení nedává v pøíslu¹ném jazyce v¾dy smysl.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="priv"><p class="subheadbold">Ochrana údajù</p></a>

		<span class="optionhead">Vy¾adovat pøihlá¹ení</span>
		<p>Ka¾dý u¾ivatel mù¾e bì¾nì prohlí¾et veøejné prostøedí va¹ich stránek, s pøihlá¹ením mù¾e volitelnì vidìt data ¾ijících osob. Pokud v¹ak
		chcete, aby se muset pøihlásit ka¾dý pøed tím ne¾ mu¾e spatøit cokoli z va¹ich stránek, za¹krtnìte toto pole.</p>

		<span class="optionhead">Omezit pøístup pouze na pøipojený strom</span>
		<p>Je-li Vy¾adovat pøihlá¹ení nastaveno na 'Ano', pak nastavení této volby na 'Ano' zpùsobí, ¾e u¾ivatelé budou moci pouze vidìt data spojená se svými
		pøipojenými stromy. V¹echny jiné osoby, rodiny, prameny, atd. budou skryty.</p>

		<span class="optionhead">Zobrazit údaje CJKSpd</span>
		<p>Chcete-li v¾dy zobrazovat data CJKSpd (Církev Je¾í¹e Krista Svatých posledních dní (mormoni), jsou-li k dispozici), vyberte <em>V¾dy</em> (døíve to bylo výchozí). Vypnout zobrazení v¹ech údajù CJKSpd
		a mo¾nosti ruènì zapsat údaje CJKSpd mù¾ete výbìrem <em>Nikdy</em>. Chcete-li tuto mo¾nost pøepínat v závislosti na
		u¾ivatelském oprávnìní, vyberte <i>Podle práv u¾ivatele</i>. V tomto pøípadì údaje CJKSpd uvidí pouze pøihlá¹ení u¾ivatelé, kteøí mají oprávnìní je vidìt.
		Pro ostatní u¾ivatele budou skryty.</p>

		<span class="optionhead">Zobrazit údaje o ¾ivých osobách</span>
		<p>Chcete-li v¾dy zobrazovat údaje ¾ijících osob (data a místa), vyberte <i>V¾dy</i>. Vypnout zobrazení údajù ¾ijících osob mù¾ete
		výbìrem <i>Nikdy</i>. Chcete-li tuto mo¾nost pøepínat v závislosti na
		u¾ivatelském oprávnìní, vyberte <i>Podle práv u¾ivatele</i>. V tomto pøípadì údaje ¾ijících osob uvidí pouze pøihlá¹ení u¾ivatelé, kteøí mají oprávnìní je vidìt.
		Pro ostatní u¾ivatele budou skryty.</p>

		<span class="optionhead">Zobrazit jména ¾ijících osob</span>
		<p>Chcete-li skrýt jména osob oznaèených jako ¾ijící (chybí údaje o úmrtí nebo pohøbu a zároveò se narodili pøed více ne¾ 110 lety), vyberte <em>Ne</em>. Jména ¾ijících
		osob budou nahrazena slovem "®ijící". Pro zobrazení pøíjmení a iniciály køestního jména ¾ijících osob vyberte <em>Zkrátit køestní jméno</em>. Chcete-li
		jména ¾ijících osob zobrazit ka¾dému, vyberte <em>Ano</em>.</p>

		<span class="optionhead">Zobrazit jména osob oznaèených jako neveøejné</span>
		<p>Chcete-li skrýt jména osob oznaèených jako Neveøejné, vyberte <em>Ne</em>. Jména neveøejných
		osob budou nahrazena slovem "Neveøejné". Pro zobrazení pøíjmení a iniciály køestního jména neveøejných osob vyberte <em>Zkrátit køestní jméno</em>. Chcete-li
		jména neveøejných osob zobrazit ka¾dému, vyberte <em>Ano</em>.</p>
    
		<span class="optionhead">Zobrazit zprávu o povolení cookies</span>
		<p>Náv¹tìvníkùm stránek se zobrazí v pravém dolním rohu obrazovky malé vyskakovací okno a upozorní je, ¾e web pou¾ívá cookies.
    Jakmile náv¹tìvník klikne na tlaèítko "Rozumím", zpráva zmizí a soubor cookie bude nastaven na zapamatování akce. 
    Dokud tento soubor cookie pøetrvává, náv¹tìvníkovi se pøi následných náv¹tìvách vyskakovací okno ji¾ znovu nezobrazí.</p>

		<span class="optionhead">Zobrazit odkaz na zásady ochrany dat</span>
		<p>Náv¹tìvníkùm stránek se zobrazí v zápatí v dolní èásti ka¾dé stránky odkaz na zásady ochrany dat na webu.
    Odkaz se také zobrazí ve vyskakovacím oknì týkajícím se souborù cookie (viz vý¹e) a na stránkách, kde je náv¹tìvník po¾ádán, aby dal souhlas s ulo¾ením osobních
    údajù (registrace nového úètu, navrhnout/kontaktujte nás). Kopie tìchto zásad lze nalézt ve vìt¹inì jazykových slo¾ek.
    Tento dokument se nazývá data_protection_policy.php. Pokud náv¹tìvník pou¾ívá jazyk, který neobsahuje pøeklad tìchto zásad, bude mu zobrazena anglická verze.</p>

		<span class="optionhead">®ádost o souhlas ohlednì osobních údajù</span>
		<p>Pøed odesláním pøipomínek, návrhù nebo registrace nového u¾ivatele budou náv¹tìvníci stránek vyzváni, aby za¹krtli políèko, ve kterém uvedou
    souhlas s ulo¾ením údajù ve formuláøi, který vyplnili. Není-li políèko za¹krtnuto, tlaèítko pro odeslání bude neaktivní. Pokud
    pøesto dojde ke kliknutí na toto tlaèítko, vyskakovací okno upozorní náv¹tìvníka, ¾e musí pøed odesláním formuláøe za¹krtnouo políèko souhlasu.</p>

		<span class="optionhead">Nastavit oznaèení ®ijící pro nové osoby a rodiny</span>
		<p>Je-li tato mo¾nost zapnutá, v¹echny nové osoby a rodiny budou oznaèeny jako ®ijící. U ka¾dé osoby nebo rodiny mù¾ete toto oznaèení zru¹it.</p>

		<span class="optionhead">Povolit stahování csv u reportù</span>
		<p>Kdy¾ u¾ivatelé spou¹tìjí va¹e reporty, umo¾níte jim stáhnout soubor s výsledky oddìlený èárkami (csv soubor). Takové soubory èasto usnadòují import informací do tabulky.</p>
      
		<span class="optionhead">reCAPTCHA</span>
		<p>reCAPTCHA je bezplatná slu¾ba, která chrání va¹e stránky pøed spamem a zneu¾itím. Vyu¾ívá nástroj pokroèilé analýzy rizik a doká¾e oddìlit lidi a roboty. 
    Náv¹tìvníci budou muset pouze za¹krtnout políèko oznaèující, ¾e nejsou robot. Chcete-li tuto slu¾bu aktivovat, budete potøebovat dva klíèe: Site Key a Secret Key.</p>

		<span class="optionhead">Klíèe Site Key a Secret Key</span>
		<p>Chcete-li získat své klíèe Site Key a Secret Key, pøejdìte na stránku https://www.google.com/recaptcha/admin. Pokud je¹tì nemáte úèet Google, bude si jej muset vytvoøit.
    Pokud máte úèet Google, na vy¾ádání se pøihlaste a postupujte podle pokynù pro vytvoøení klíèù. Po zobrazení výzvy k zadání adresy/názvu domény NEZADÁVEJTE "www" a 
    nezadávejte zadní lomítko. Po vytvoøení klíèù je vlo¾te do polí na této stránce.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="name"><p class="subheadbold">Jména</p></a>

		<span class="optionhead">Poøadí jména a pøíjmení</span>
		<p>Urèí, jak budou ve vìt¹inì pøípadù jména zobrazena (nìkteré seznamy v¾dy zobrazí pøíjmení jako první). Zvolit mù¾ete zobrazení køestního jména jako první nebo pøíjmení jako první.
		Není-li nic vybráno, bude zobrazeno jako první køestní jméno.</p>

		<span class="optionhead">V¹echna pøíjmení velkými písmeny</span>
		<p>Umo¾ní zobrazit v¹echna pøíjmení velkými písmeny. Je-li tato volba nastavena na "Ne", budou jména zobrazena tak, jak byla zapsána nebo naimportována.</p>

		<span class="optionhead">Pøedpony pøíjmení</span>
		<p>Urèí, jak se bude zacházet s pøedponami pøíjmení (napø. "de" nebo "van"). Standardnì je v¹e, co je obsa¾eno v poli pøíjmení souboru GEDCOM souèástí pøíjmení, a podle toho jsou i
		pøíjmení tøídìna ("de Kalb" je døíve ne¾ "van Buren"). Pøedpony pøíjmení mù¾ete ponechat jako souèást pøíjmení nebo je mù¾ete oddìlit
		jako samostatné subjekty (takto bude "van Buren" v øazení pøed "de Kalb"). Toto nebude mít vliv na existující pøíjmení, dokud je ruènì neupravíte nebo nepøevedete pomocí surnameconvert400.php.</p>

		<span class="optionhead">Zji¹tìní pøedpon pøi importu</span>
		<p>Pokud jste zvolili oddìlení pøedpon jako samostatných subjektù, tato sekce stanoví pravidla, která pomohou rozhodnout importovací rutinì, co je pøedponou. Pøedpony jsou definovány jako
		èásti jmen oddìlené mezerami, ale vy mù¾ete zvolit, kolik pøedpon ka¾dého jména bude souèástí pøedpony v TNG. Jinými slovy, pokud urèíte, ¾e
		"Poèet pøedpon ka¾dého (max)" je 1, pak bude do pole pøedpona ze jména "van der Merwe" pøesunuto pouze "van". Na druhou stranu, pokud tuto hodnotu nastavíte na 2 nebo vy¹¹í, pøedponou
		bude "van der". Oznaèit mù¾ete také urèité pøedpony, které budou v¾dy oddìleny jako samostatné pøedpony. Jinými slovy, nastavíte-li tuto hodnotu na "van der", pak
		bude "van der" v¾dy uva¾ována jako platná pøedpona nezávisle na tom, jak vysoká nebo nízká je pøedchozí hodnota. Více hodnot oddìlujte èárkami. Je-li ve jménì pøedpona oddìlena
		apostrofem, tento apostrof uveïte v seznamu také. Napø.: "van,vander,van der,d',a',de,das".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="cem"><p class="subheadbold">Høbitovy</p></a>

		<span class="optionhead">Maximální poèet øádkù ve sloupci (prùm.)</span>
		<p>Pokud máte definováno velké mno¾ství høbitovù, tento údaj øekne TNG, ¾e je-li dosa¾en zadaný poèet, seznam má být rozdìlen
		a vytvoøen dal¹í sloupec.</p>

		<span class="optionhead">Potlaèit kategorii "Neznámé"</span>
		<p>Definujete-li høbitov s chybìjícími údaji o lokalitì (napø. bez kraje nebo okresu), TNG vytvoøí záhlaví nazvané
		"Neznámé" a tato prázdná pole zde budou seskupena. Výbìr této volby zpùsobí, ¾e TNG toto záhlaví vynechá.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="mail"><p class="subheadbold">Mail a registrace</p></a>

		<span class="optionhead">Emailová adresa</span>
		<p>Va¹e emailová adresa. Po¾ádá-li náv¹tìvník o nový u¾ivatelský úèet, email bude posílán z této adresy. Na tuto adresu budou také zasílány 
    v¹echny zprávy ze stránky "Napi¹te nám". Zprávy pocházející z formuláøe "Návrh" pøijdou na tuto adresu, pokud není se stromem odpovídajícím
    stránce, ze které byl poslán návrh, spojena ¾ádná emailová adresa (jinak bude zpráva poslána na tuto adresu).</p>

		<span class="optionhead">Posílat v¹echny maily z vý¹e uvedené adresy</span>
		<p>Kdy¾ vám u¾ivatel po¹le zprávu prostøednictvím TNG, program se ji pokusí odeslat, jako by pocházela od nìj,
    abyste mohli snáze odpovìdìt. Nìkteøí poskytovatelé hostingu to v¹ak neumo¾òují. Odmítají posílat emaily, kdy¾ adresa odesílatele
		nepochází ze stejné domény, jako jsou va¹e stránky. Pokud zjistíte, ¾e emaily z TNG nejsou posílány, vá¹ hostitel se právì takto
		chová. Je-li to tento pøípad, nastavení této volby na Ano zpùsobí, ¾e TNG bude posílat v¹echny maily z adresy 
		administrátora TNG (zapsaná vý¹e). To by mìlo problém vyøe¹it.</p>

		<span class="optionhead">Povolit nové registrace u¾ivatelù</span>
		<p>Umo¾ní vypnout mo¾nost náv¹tìvníkù po¾ádat o u¾ivatelský úèet na va¹ich stránkách.</p>

		<span class="optionhead">Upozornit na návrhy k pøezkoumání</span>
		<p>Nastavení této hodnoty na "Ano" zajistí, ¾e administrátorovi bude zaslána emailová zpráva, kdykoliv nìkdo s právem Vkládání
		vlo¾í pøedbì¾nou zmìnu a èeká na administrativní pøezkoumání.</p>

		<span class="optionhead">Vytvoøit nový strom pro u¾ivatele</span>
		<p>Je-li tato volba nastavena na Ano, pro ka¾dou novou u¾ivatelskou registraci bude automaticky vytvoøen nový strom a
		u¾ivatel bude pøipojen k tomuto stromu.</p>

		<span class="optionhead">Automaticky schválit nové u¾ivatele</span>
		<p>V¹echny nové u¾ivatelské registrace vy¾adují bì¾nì schválení administrátora pøed tím, ne¾ se stanou aktivními.
		Zmìnou tohoto nastavení na Ano budou automaticky aktivní v¹echny nové u¾ivatelské po¾adavky. Nastavení u¾ivatelského úètu budete
		ale moci upravit, abyste mìli jistotu, ¾e má u¾ivatel pøístupová práva, která jste mu chtìli dát.</p>

		<span class="optionhead">Posílat schvalovací mail</span>
		<p>Pokud je tato volba nastavena na Ano, ka¾dému potenciálnímu novému u¾ivateli bude poslán email, který ho bude informovat, jeho po¾adavek
		byl obdr¾en a je zpracováván. Toto neplatí, pokud jsou nové registrace automaticky aktivovány.</p>

		<span class="optionhead">Zahrnout heslo do uvítacího mailu</span>
		<p>Heslo zvolené u¾ivatelem je bì¾nì zahrnuto na "uvítacího" emailu, který jej informuje, ¾e je úèet
		nyní aktivní. Nechcete-li, aby bylo heslo do emailu vkládáno, nastavte tuto hodnotu Ne.</p>

		<span class="optionhead">Pou¾ít ovìøení SMTP</span>
		<p>TNG posílá normálnì maily pomocí PHP funkce "mail". Chcete-li radìji pou¾ít Simple Mail Transfer Protocol, pak tuto hodnotu nastavte na "Ano". 
    Zobrazí se navíc nìkteré dal¹í volby: Název SMTP hostitele, U¾ivatelské jméno pro email, Heslo pro email a Èíslo portu. Správné hodnoty tìchto polí
    by vám mìl být schopen dát poskytovatel va¹eho hostingu.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="pref"><p class="subheadbold">Pøedpony a pøípony</p></a>

    <p>Tato písmena ve spojení s èíslicí tvoøí identifikaèní èísla (ID èísla) osob, rodin, pramenù, úlo¾i¹» a poznámek ve va¹í databázi. Vìt¹ina genealogických
    programù pou¾ívá stejnou sadu standardních pøedpon (a ¾ádné pøípony). Pokud vá¹ desktopový program pou¾ívá pøípony nebo jiné pøedpony, mù¾ete je zadat zde.
    Nejsou-li zadány správné pøedpony nebo pøípony, nìkteré funkce TNG nebudou pracovat správnì.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="mobile"><p class="subheadbold">Mobil</p></a>

		<p>Sekce Mobil vám umo¾ní urèit, jak se bude TNG zobrazovat na chytrých telefonech a tabletech.</p>
		
		<span class="optionhead">Povolit responzivní tabulky</span>
		<p>Je-li tato volba nastavena na Ano, bbude aktivován plugin Tablesaw jQuery, který umo¾òuje responzivní tabulky.<br />Je-li volba nastavena na Ne, plugin Tablesaw jQuery nebude aktivní.</p>
		
		<span class="optionhead">Typ responzivní tabulky</span>
		<p>Typ responzivní tabulky mù¾e být nastaven na
		<ul>
			<li><strong>Toggle</strong>, který je výchozí, a zobrazí data ve sloupcích zalo¾ených na ¹íøce displeje a pøiøazené prioritì.  Otoèením displeje chytrého telefonu nebo tabletu na ¹íøku budou zobrazeny dal¹í sloupce dat.</li> 
				
			<li><strong>Stack</strong>, který shrne záhlaví tabulky do dvousloupcového návrhu se záhlavím nalevo, je-li ¹íøka výøezu men¹í ne¾ 40em (640px).</li>
			
			<li><strong>Swipe</strong>, který umo¾ní u¾ivateli k navigaci sloupcù pou¾ít gesto posunu (nebo pou¾ít levé a pravé tlaèítko).</li>
		</ul>
		<br />
		<span class="optionhead">Povolit pøepínaè módù responzivních tabulek:</span>
		<p>Volba pøepínaèe módù umo¾ní u¾ivateli pøepínat mezi jednotlivými typy zobrazení sloupcù tabulek: toggle, stack nebo swipe.</p>

		<span class="optionhead">Povolit minimapu responzivních tabulek</span>
		<p>Pou¾ití minimapy pøidá sérii malých teèek ukazujících, které sloupce jsou aktuálnì viditelné a které jsou skryté. 
			K dispozici pouze v módu swipe a toggle. </p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Top</a></p>
		<a name="misc"><p class="subheadbold">Testy DNA</p></a>

		<span class="optionhead">Skrýt v¹echny stránky a údaje k DNA</span>
		<p>Pokud nebudete pou¾ívat ¾ádnou z funkcí souvisejících s DNA a chtìli byste ji odstranit ze v¹ech veøejných stránek, nastavte tuto mo¾nost na Ano. Testy DNA ji¾ nebudou pøístupné z veøejných nabídek, 
    ani se nebudou zobrazovat na individuální stránce ¾ádné osoby.</p>
		<span class="optionhead">Maximální poèet výsledkù hledání</span>
    <p>Maximální poèet výsledkù hledání v sekci Testy DNA øídí poèet výsledkù DNA, které lze zobrazit nezávisle na výsledcích vyhledávání TNG pro dotazy z testù procházení DNA.</p><p><strong>Pozn.:</strong> Pokud nemù¾ete vybrat test DNA, který chcete porovnat, proto¾e je na jiné stránce, zvy¹te tento limit, aby se v¹echny testy DNA, které chcete porovnat, zobrazily na stejné stránce.</p>
		<span class="optionhead">Zobrazit poèet testù DNA veøejnì</span>
		<p>Tato volba umo¾òuje skrýt nebo zobrazit poèet testù DNA na veøejných stránkách testù DNA.</p>
		<span class="optionhead">Rodová pøíjmení vyplnit automaticky</span>
		<p>Tato volba automaticky pøidá rodová pøíjmení do va¹ich otcovských a mateøských pøímých linií po ulo¾ení testu DNA. Mo¾ná budete chtít omezit poèet generací, kterých se to má týkat.</p>
 		<span class="optionhead">Rodová pøíjmení velkými písmeny </span>
		<p>Tato volba pou¾ívá v¹echna velká písmena pro rodová pøíjmení, pokud je nastaveno automatické vyplòování pøíjmení pøedkù na Ano. Výchozí nastavení je Ne a pøíjmení jsou tedy zobrazena tak, jak jsou zapsána.</p>
		<span class="optionhead">Generace pro rodová pøíjmení</span> 
		<p>Urèuje, kolik generací zpìt se má vyhledat pøi pou¾ití mo¾nosti automatického vyplòování rodových pøíjmení.</p>
		<span class="optionhead">Vylouèit z rodových pøíjmení</span>
		<p>Urèuje, která pøíjmení nezahrnout pøi pou¾ití mo¾nosti automatického vyplòování rodových pøíjmení.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="misc"><p class="subheadbold">Rùzné</p></a>

		<span class="optionhead">Maximální poèet výsledkù hledání</span>
		<p>Tato volba omezuje poèet výsledkù, které mohou být zobrazeny z veøejného vyhledávacího dotazu. Mù¾e to být relativnì malé, zvládnutelné èíslo, aby byla
		maximalizována efektivnost a zlep¹ení zku¹eností u¾ivatelù.</p>

		<span class="optionhead">Osoby zaèínají na</span>
		<p>Tato volba oznaèuje, které údaje budou viditelné nejdøíve, kdy¾ je zobrazen záznam osoby. Pokud vyberete
		"Pouze osobní údaje", ostatní kategorie jako Poznámky, Citace nebo Fotografie a Vyprávìní
		budou skryty, dokud u¾ivatel nerozkryje pøíslu¹nou kategorii nebo "V¹e".</p>

		<span class="optionhead">Zobrazit poznámky</span>
		<p>Tato volba vám umo¾ní zvolit, kde budou na stránce osoby zobrazeny poznámky. Mo¾nosti jsou následující:</p>

		<ul>
			<li>V sekci poznámek: V¹echny poznámky budou zobrazeny ve zvlá¹tním bloku na konci stránky.</li>
			<li>Pod odpovídajícími událostmi, kde je to mo¾né: Poznámky k urèitým událostem budou zobrazeny pøímo pod odpovídajícími událostmi. Obecné poznámky budou zobrazeny
				na konci "Osobní" sekce a ka¾dé sekce "Rodina". Pokud jsou obecné poznámky dlouhé, objeví se posuvník, který zajistí, ¾e stránka nebude moc dlouhá
				(maximální vý¹ka oblasti je definována v souboru genstyle.css v bloku "notearea").</li>
			<li>Pod událostmi mimo obecných poznámek: Toté¾ jako v pøedchozím pøípadì, pouze obecné poznámky budou zobrazeny v¾dy v oddìleném bloku na konci stránek. Neukládá se
        ¾ádná maximální vý¹ka.</li>
		</ul>

    <span class="optionhead">Posouvání citací</span>
		<p>Nastavení této pøedvolby na "Ano" zpùsobí, ¾e oblast pramenù na konci ka¾dé stránky osoby bude mít maximální vý¹ku. Pokud je u osoby pøiøazeno více citací pramenù
    ne¾ jsou maximální rozmìry oblasti, objeví se v této oblasti posuvník.</p>

		<span class="optionhead">Èasový odstup serveru (v hodinách)</span>
		<p>Nachází-li se vá¹ server v jiné èasové zónì ne¾ vy, mù¾ete sem napsat rozdíl v hodinách. Je-li vá¹ èas vy¹¹í ne¾ èas serveru, zapi¹te záporné èíslo.</p>

		<span class="optionhead">Upravit prodlevu (v minutách)</span>
		<p>Poèet minut, který je u¾ivateli povolen pro výhradní právo u editace záznamu osoby nebo rodiny. Bìhem této doby uvidí jiný u¾ivatel, který se pokou¹í upravovat stejný
		záznam, zprávu, která mu sdìlí, ¾e je záznam uzamèen. Pokud se blí¾í èas k zapsanému limitu a pùvodní u¾ivatel stále záznam upravuje, uvidí tento u¾ivatel zprávu,
		která jej bude varovat, aby co nejrychleji ulo¾il své zmìny. Pokud u¾ivatel své zmìny neulo¾í pøed tím, ne¾ získá pøístup k tomuto záznamu jiný u¾ivatel, jeho zmìny
		budou ztraceny.</p>

		<span class="optionhead">Maximální poèet generací pøi ulo¾ení GEDCOMU</span>
		<p>Maximální poèet generací, které mohou být exportovány ve veøejném po¾adavku na vytvoøení souboru GEDCOM.</p>

		<span class="optionhead">Co je nového dny</span>
		<p>Poèet dní, po které budou na stránce "Co je nového" zobrazovány nové polo¾ky. Toto omezení odstraníte nastavením hodnoty na nulu. To zapøíèiní, ¾e na seznamu zùstanou
		star¹í polo¾ky, dokud nebudou nahrazeny novìj¹ími.</p>

		<span class="optionhead">Co je nového limit</span>
		<p>Maximální poèet polo¾ek v ka¾dé kategorii, který bude zobrazen na stránce "Co je nového".</p>

		<span class="optionhead">Pøednost èíselného data</span>
		<p>Zapí¹ete-li èíselné datum (napø. 04/09/2008), tato volba zajistí, zda bude zápis data interpretován jako Mìsíc/Den/Rok (9 Dub 2008)
		nebo Den/Mìsíc/Rok (4 Záø 2008).</p>

		<span class="optionhead">První den v týdnu</span>
		<p>Tento den bude prvním sloupcem zleva pøi zobrazení stránky kalendáøe.</p>

		<span class="optionhead">Údaje rodièù na stránce osoby</span>
		<p>Vyberte, které události (pokud nìjaké) spojené s rodinou rodièù osoby mají být zobrazeny.</p>

		<span class="optionhead">Konec øádku</span>
		<p>Jedná se o znakový øetìzec, který bude vlo¾en na konec ka¾dého øádku pøi exportu souboru GEDCOM. Je to té¾ øetìzec,
		který bude obsahovat konec øádku pøi importu. Výchozím je "\r\n", které znamená "návrat na zaèátek øádku a odøádkování".
    Nìkteré programy nebo operaèní systémy preferují jen návrat na zaèátek øádku (\r) nebo odøádkování (\n), tak¾e
		mù¾ete v nìkterých pøípadech toto nastavení mìnit.</p>

		<span class="optionhead">Typ ¹ifrování</span>
		<p>Pøed ulo¾ením do databáze jsou hesla v TNG ¹ifrována. Díky tomu jednodu¹e nelze ruèní opravou databáze heslo mìnit nebo smazat.
		Výchozí metodou ¹ifrování je md5, ale zde mù¾ete vybrat jinou metodu.</p>

		<span class="optionhead">Pøipojit záznamy míst ke stromùm</span>
		<p>Je-li tato volba nastavena na "Ano", ka¾dý záznam místa pak bude pøipojen k místu ve va¹em stromì. To znamená, ¾e máte-li více stromù, mù¾e se
		stejné místo objevit v tabulce míst vícekrát, proto¾e je spojeno s více stromy. Zmìníte-li tuto volbu na "Ne", bude 
		vám dána mo¾nost automaticky slouèit v¹echna místa do jednoho seznamu. Pokud tuto volbu zmìníte na "Ano", zobrazí se vám mo¾nost pøipojit
		urèitý strom ke v¹em místùm (pokud nemìly døíve ¾ádné pøipojení).</p>

		<span class="optionhead">Geokódovat v¹echna nová místa</span>
		<p>Je-li tato volba nastavena na "Ano", v¹echna nová místa zapsaná v Admin/Osoba a Admin/Rodina budou automaticky geokódována (pøedpokládá to
		pøipojení k internetu).</p>

 		<span class="optionhead">Znovu pou¾ít smazaná ID èísla</span>
		<p>Je-li tato volba nastavena na "Ano" u nové osoby, rodiny, pramenu a úlo¾i¹ti pramenù, budou znovu pou¾ita èísla ID, která byla døíve smazána.</p>

 		<span class="optionhead">Zobrazit poslední import</span>
		<p>Pokud je tato volba nastavena na "Ano", bude na stránkách Co je nového a Statistiky zobrazeno datum posledního importu souboru GEDCOM, je-li vybrán strom.</p>

    <span class="optionhead">Zobrazit oznámení 'Dùle¾ité úkoly'</span>
		<p>Nastavte "Ano", pokud chcete, aby program TNG zobrazoval v horní èásti nabídky Administrace seznam dùle¾itých úkolù. Ty budou obsahovat výzvy k zálohování dat, 
    ke kontrole nových u¾ivatelských registrací a dal¹í. Mù¾ete i nadále zvolit sbalení zprávy, i kdy¾ zde umo¾níte jejich zobrazení.</p>

		<span class="optionhead">Zobrazit celkové souèty záznamù v menu Administrace</span>
		<p>Umo¾ní TNG zobrazit v hlavní nabídce Administrace souèty pro ka¾dou kategorii. Napøíklad, pokud máte v TNG ulo¾eno 1000 lidí, na pravé stranì li¹ty "Osoby" uvidíte "1000".</p>

		<span class="optionhead">Upozornit, pokud záloha nebyla vytvoøena bìhem tohoto poètu dní</span>
		<p>Po uplynutí zadaného poètu dní od vytvoøení poslední zálohy alespoò jedné z va¹ich tabulek, TNG zaøadí upozornìní do sekce "Dùle¾ité úkoly" v horní èásti nabídky Administrace.
    Pokud nechcete tato upozornìní zobrazovat, nastavte tuto hodnotu na nulu.</p>
    
    <span class="optionhead">Pou¾ívám TNG offline</span>
		<p>Je-li vybráno "Ano", TNG pou¾ije lokální verze namísto on-line verzí knihoven tøetích stran (napø. JQuery) a nebude se pokou¹et o pøístup ke Google mapám.</p>

	</td>
</tr>

</table>
</body>
</html>
