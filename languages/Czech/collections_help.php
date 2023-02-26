<?php
include("../../helplib.php");
echo help_header("Nápovìda: Kolekce");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="media_help.php" class="lightlink">&laquo; Nápovìda: Média</a> &nbsp; | &nbsp;
			<a href="albums_help.php" class="lightlink">Nápovìda: Alba &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Kolekce</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co to je?</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat/Upravit/Vymazat</a>
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

		<a name="what"><p class="subheadbold">Co jsou to kolekce?</p></a>

		<p><strong>Kolekcemi</strong> se v TNG rozumí typ média. Standardní kolekce v TNG jsou Fotografie, Dokumenty, Náhrobky, Vyprávìní, Videa a Zvukové záznamy,
		ale TNG vám umo¾ní vytvoøit i vlastní kolekce. Kolekce není omezena jedním typem souboru. Napø. obrázky .jpg mohou být souèástí kterékoli kolekce,
		nejen fotografií a dokumentù, a kolekce Fotografie nemusí obsahovat pouze obrazové soubory.</p>


	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Pøidání kolekce</p></a>

		<p>Chcete-li pøidat novou kolekci, kliknìte na tlaèítko "Pøidat kolekci" kdekoli je viditelné (napø. na obrazovkách Média, Pøidat média a Upravit média).
		Po zobrazení malého okna vyplòte formuláø. Význam jednotlivých polí je následující:</p>

		<span class="optionhead">ID èíslo kolekce</span>
		<p>Velmi krátký øetìzec znakù, který slou¾í jako identifikátor této kolekce. Nemìl by obsahovat mezery ani ¾ádné znaky, které nejsou alfanumerické,
		a mìl mít maximálnì 10 znakù. Napø. pokud jste vytvoøili kolekci pro vojenské záznamy, do tohoto pole byste mìli zapsat "military".
		Tato hodnota se nikde nezobrazí, tak¾e není dùle¾ité, jak ji pojmenujete, ale musí být jednoznaèná.</p>

		<span class="optionhead">Exportovat jako</span>
		<p>Kdy¾ exportujete soubor GEDCOM, který obsahuje média, soubor bude obsahovat øádek pro ka¾dou polo¾ku oznaèující, o jaký typ média jde. Mìlo by to být
		jedno slovo zapsané velkými písmeny. Napø. fotografie se bude exportovat s typem "PHOTO". Pokud jste vytvoøili novou kolekci nazvanou "Noviny",
		do tohoto pole mù¾ete vlo¾it "NEWSPAPER".</p>

		<span class="optionhead">Zobrazený titul</span>
		<p>Jde o název, který bude zobrazen kdekoli je zmínìna kolekce a kdekoli je zobrazena polo¾ka z této kolekce. Zobrazený titul mù¾e být o nìco del¹í
		ne¾ ID èíslo kolekce, ale mìl by být také relativnì krátký. Pøi pou¾ití stejného pøíkladu mù¾ete do tohoto pole vlo¾it "Vojenské záznamy".
		Standardnì bude název, který zapí¹ete, pou¾it ve v¹ech jazycích. Pokud podporujete více jazykù a chcete, aby byl Zobrazovaný název pøelo¾en do jazykù, které podporujete,
		budete do souboru "cust_text.php" ve slo¾ce ka¾dého jazyka muset vytvoøit zápis. Klíèem promìnné $text by mìlo být ID èíslo kolekce a
		hodnotou je Zobrazovaný titul. V tomto pøíkladì by mìl zápis vypadat takto:</p>

		<pre>$text['military'] = "Vojenské záznamy";</pre>

		<p>Tento zápis vlo¾te do souboru cust_text.php v ka¾dém jazyce a pøelo¾te pouze èást "Vojenské záznamy". Klíè neboli ID èíslo ("military") by nemìl
    být pøelo¾en.</p>

		<span class="optionhead">Název slo¾ky</span>
		<p>Název fyzické slo¾ky nebo adresáøe na va¹ich webových stránkách, kde budou polo¾ky z této kolekce ulo¾eny. Mìl by být relativnì krátký, bez mezer
		a s pouze alfanumerickými znaky (napø. "military"). Po zápisu hodnoty mù¾ete kliknout na tlaèítko "Vytvoøit slo¾ku". Mìli byste
		uvidìt zprávu o tom, zda bylo vytvoøení úspì¹né èi nikoli. Pokud vá¹ server tuto operaci nepovoluje, musíte pro vytvoøení slo¾ky pou¾ít program FTP nebo
		nìjaký online správce souborù. Slo¾ka by mìla být vytvoøena ve stejné rodièovské slo¾ce jako slo¾ky kolekcí "photos", "documents", "histories" a dal¹ích.
		Aktuální název musí pøesnì odpovídat názvu, který jste zapsali ("Military" není stejné jako "military").</p>

		<span class="optionhead">Lokální umístìní</span>
		<p>Toto pole vám pomù¾e stanovit, jak velkou èást názvu lokálního umístìní va¹ich médií je tøeba ulo¾it na va¹ich stránkách bìhem importu souboru GEDCOM
    pomocí odebrání èásti názvu, která je jedineèná pro vá¹ domácí poèítaè. Zadejte základní cestu nebo cesty (více polo¾ek oddìlte èárkami), kde jsou soubory z této kolekce 
    umístìny na va¹em domácím poèítaèi. Jinými slovy, v pøípadì, ¾e soubory v poèítaèi se nachází ve slo¾ce "C:\Genealogie\Soubory", to je to, co byste sem mìli zadat.</p>
     
    <p>TNG pak oddìlí tuto èást z ka¾dého pøíchozího názvu cesty a ponechá pouze název souboru nebo název dal¹í podslo¾ky.
    Pokud soubory pro tuto kolekci jsou v místním poèítaèi na více místech nebo pokud na nì vá¹ soubor GEDCOM odkazuje, ani¾ by mìly název plné cesty (napø. pouze "MojeSoubory"), 
    zadejte ty cesty jako více zápisù. 
    Pokud jsou nìkteré z va¹ich souborù umístìny v podslo¾kách tohoto umístìní a na svých webových stránkách chcete tuto strukturu zachovat, podslo¾ky nezadávejte do tohoto umístìní.
    Chcete-li, aby se v¹echny soubory dostaly na va¹em webu do stejné slo¾ky, ponechte toto pole prázdné. Pokud toto pole je prázdné, TNG automaticky odstraní v¹echno mimo názvù souborù.
    </p>

    <p>TNG také pou¾ije lokální umístìní k naplnìní lokálního umístìní pøi exportu, vyberete-li Exportovat odkazy na média.</p>
   
		<span class="optionhead">Soubor s ikonou</span>
		<p>Musíte vytvoøit svoji vlastní ikonu nebo pou¾ít nìjakou existující a název souboru s ikonou zapsat do tohoto pole. Soubor s ikonou mù¾e být umístìn v hlavní slo¾ce TNG
		nebo jej mù¾ete ulo¾it do slo¾ky "img" spolu s ostatními standardními ikonami (jako "tng_photo.gif" nebo "tng_doc.gif"). Pokud jej ulo¾íte do slo¾ky "img",
		musíte k názvu souboru pøidat pøíponu "img/".</p>

		<span class="optionhead">Soubor náhledu</span>
		<p>Toto je název výchozího obrázku náhledu této kolekce. Jinými slovy, pokud vytvoøíte v této kolekci mediální polo¾ku a pro tuto specifickou polo¾ku nepou¾ijete
		náhled, obrázek zapsaný zde bude pou¾it jako náhled. Obrázek náhledu mù¾e být ulo¾en v hlavní slo¾ce TNG
		nebo jej mù¾ete ulo¾it do slo¾ky "img" spolu s ostatními standardními ikonami. Pokud jej ulo¾íte do slo¾ky "img",
		musíte k názvu souboru pøidat pøíponu "img/".</p>

		<span class="optionhead">Poøadí v zobrazení</span>
		<p>Zde zapi¹te celé èíslo, které bude udávat poøadí, ve které bude va¹e vlastní kolekce zobrazena v rozbalovacích nabídkách ve veøejné oblasti. Ni¾¹í èísla se objeví jako první.</p>

		<span class="optionhead">Stejné nastavení jako</span>
		<p>Mo¾ná jste si v¹imli, ¾e se obrazovky Pøidat médium a Upravit médium tro¹ku mìní v závislosti na zvolené kolekci. Toto pole "stejné nastavení jako" vám umo¾ní
		oznaèit, kterou standardní kolekci va¹e nová kolekce nejvíce pøipomíná, s ohledem na uspoøádání tìchto obrazovek.</p>

		<p class="subheadbold">Úprava/Vymazání kolekce</p>

		<p>Pro úpravu existující vlastní kolekce (standardní nelze mìnit, s výjimkou hodnot v Základním nastavení) vyberte kolekci z rozbalovacího seznamu a
		kliknìte na tlaèítko Upravit. Zobrazí se stejná pole, jako jsou vý¹e uvedena.</p>

		<p>Pro vymazání existující vlastní kolekce vyberte kolekci z rozbalovacího seznamu a kliknìte na tlaèítko Vymazat. Vymazána by nemìla být ani fyzická slo¾ka, kterou jste vytvoøili,
		ani ¾ádná polo¾ka nacházející se v této slo¾ce.</p>

	</td>
</tr>

</table>
</body>
</html>
