<?php
include("../../helplib.php");
echo help_header("Nápověda: Import dat");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="mostwanted_help.php" class="lightlink">&laquo; Nápověda: Hledá se</a> &nbsp; | &nbsp;
			<a href="second_help.php" class="lightlink">Nápověda: Nástroje po importu &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Import / Export</span>
		<p class="smaller menu">
			<a href="#import" class="lightlink">GEDCOM Import</a> &nbsp; | &nbsp;
			<a href="#export" class="lightlink">GEDCOM Export</a>
		</p>
	</td>
</tr>
<tr>
	<td class="tngshadow databack">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

		<a name="import"><p class="subheadbold">GEDCOM Import</p></a>
		<p>Na této stránce můžete naimportovat všechna data ze standardního souboru GEDCOM do určitého stromu.</p>

		<p><span class="optionhead">Před importem:</span> Z vašeho genealogického programu vytvořte standardní soubor GEDCOM (preferovaný je 5.5 nebo 7.0., ale 4.0 je také akceptovatelný). Neveřejné informace u žijících osob
		můžete vyloučit, ale není to nutné. Není také nutné vyloučit údaje týkající se CJKSpd, protože mohou být také filtrovány v závislosti na uživatelských právech.</p>

		<p>Po vytvoření souboru GEDCOM je dalším krokem, jak ho dostat na vaše webové stránky. Význam jednotlivých polí je následující:</p>

		<p><span class="optionhead">Import souboru GEDCOM z vašeho počítače</span>
		Chcete-li nahrát a importovat váš soubor na vaše stránky bez použití FTP, klikněte na tlačítko "Prohledat" a najděte soubor na vašem disku. Po jeho vyhledání se v tomto poli objeví název a umístění vašeho souboru.
		<strong>POZN.</strong>: Pokud je váš soubor GEDCOM velký (> 2MB), můžete jej nejprve zkusit „zazipovat“ (TNG soubor po nahrání automaticky rozbalí). Je-li výsledný soubor stále velký, budete muset před nahráním vašeho souboru tímto způsobem kontaktovat poskytovatele svého hostingu, protože server může mít omezení maximální
		velikosti pro nahrávání souborů prostřednictvím webového formuláře. Pokud během importu obdržíte chybové hlášení, jedná se o tento případ. Zkuste místo toho použít k nakopírování svého souboru do složky GEDCOM program FTP, a pak jej naimportujte odtud (viz níže).</p>

		<span class="optionhead">NEBO Import souboru GEDCOM z webových stránek (ve složce GEDCOM)</span>
		<p>Pokud jste pro přenos souboru GEDCOM nebo ZIP do složky GEDCOM na vašich stránkách použili FTP nebo nějaký online souborový manažer, zapište sem přesný název vašeho souboru, který chcete nahrát nebo klikněte na
		tlačítko "Vybrat" pro jeho nalezení na vašich stránkách. Musí být ve složce GEDCOM nebo jej tlačítko Vybrat nenajde. <strong>POZN.</strong>: Pokud vidíte seznam
		souborů, ale tyto nejsou z vaší složky GEDCOM, máte zřejmě problém s umístěním souborů. Ověřte svoji kořenovou složku (Admin/Nastavení/Základní nastavení) a vaši složku GEDCOM (Admin/Nastavení/Nastavení importu).</p>

		<p>Pozn.: Pokud nahrajete/importujete soubor ZIP a vložíte do souboru aktuální média, TNG rozbalí média do příslušných složek médií (např. "photos" nebo podsložka "photos"). Další možnosti týkající se vložených médií naleznete v části Administrace/Nastavení/Nastavení importu dat.</p>

		<span class="optionhead">Přijmout data pro všechny typy vlastních událostí</span>
		<p>Váš soubor GEDCOM může obsahovat události, které bude TNG považovat za nestandardní události. Normálně jsou typy nových událostí a atributů, které soubor GEDCOM obsahuje, vloženy do databáze, ale
		ale je nastaveno, aby tato data byla ignorována. Aby bylo možné importovat události nebo atributy tohoto typu, musíte změnit stav takového typu na „Přijmout“ (jinými slovy,
		abyste nemuseli váš soubor importovat dvakrát). Pokud tuto volbu zaškrtnete, TNG automaticky nastaví všechny typy nových událostí a atributů na "Přijmout" a všechny vaše události
		budou importovány napoprvé.</p>
    
		<span class="optionhead">Importovat pouze typy vlastních událostí a atributů (nebudou vloženy, nahrazeny nebo přidány žádné údaje)</span>
		<p>Zaškrtnutí této volby způsobí, že budou naimportovány pouze typy vlastních událostí a atributů (viz Administrace/Typy událostí / atributů). Všechny další údaje budou ignorovány. To je ideální možnost
		jak sestavit vaše výchozí nastavení, protože vám umožní vidět, které vlastní události vás soubor GEDCOM obsahuje. Poté můžete zvolit, které události
		před importem vaší celé databáze přijmout a které odmítnout.</p>

		<span class="optionhead">Cílový strom</span><br />
		<p>Vyberte strom, do kterého chcete importovat data (povinné). Pokud strom, kam mají data přijít, ještě neexistuje, klikněte na tlačítko "Přidat nový strom" a vytvořte jej.
		Objeví se malé okno, které vám umožní zadat informace o novém stromu.</p>

		<span class="optionhead">Nahradit všechna aktuální data</span>
		<p>Zvolíte-li tuto možnost, všechny vaše dřívější údaje ze souboru GEDCOM (osoby, rodiny, děti, prameny, úložiště pramenů, události, poznámky, spojení a citace; ne média a cokoli jiného)
		budou před importem vymazána.
		<strong>POZN.</strong>: Odkazy na média budou zachovány, pokud se ID čísla osoby/rodiny/pramenu/úložiště pramenů ve vašem novém souboru GEDCOM budou shodovat s ID čísly vašich dosavadních dat.
		Většina genealogických programů přiřazují stálá ID čísla každé osobě/rodině/pramenu/úložišti pramenů, ale některé ne. Pokud máte k datům připojeny nějaké položky médií, před importem, prosím, zkontrolujte,
		zda se ID čísla ve vašem novém souboru GEDCOM shodují, bez ohledu na to, kterou z těchto možností máte vybránu. Je také vhodné vytvořit před importem zálohu vašich tabulek
		(viz Admin/Obslužné programy o vytvoření zálohy).</p>

		<span class="optionhead">Nahradit pouze odpovídající záznamy</span>
		<p>S touto volbou jsou přidány nové záznamy a odpovídající záznamy jsou nahrazeny (shoda je podmíněna pouze ID čísly). Staré údaje nejsou odstraněny.</p>

		<span class="optionhead">Nenahradit žádná data</span>
		<p>Nové záznamy budou přidány, ale shodné záznamy budou ignorovány (nenahrazeny).</p>

		<span class="optionhead">Přidat všechny záznamy</span>
		<p>Všechny záznamy budou naimportovány, bez ohledu na existující data, ale jejich ID čísla budou přečíslována. ID čísla importovaných záznamů budou vytvořena od prvního volného čísla
		(nebo čísla, které určíte).</p>

		<span class="optionhead">Všechna příjmení velkými písmeny</span>
		<p>Zaškrtnutím tohoto políčka před importem způsobí převedení všech příchozích příjmení na velká písmena. Příjmení budou tímto způsobem uložena v databázi,
		takže tento proces nelze vzít zpět, pokud váš soubor GEDCOM nenaimportujete znovu.</p>

		<span class="optionhead">Nepřepočítat označení Žijící</span>
		<p>Pokud zvolíte "Nahradit pouze odpovídající záznamy", zobrazí se vám tato volba. Před importem tuto volbu zaškrtněte,
    pokud nechcete, aby bylo přepočítáno označení "Žijící" pro osoby, které již jsou v databázi.</p>

		<span class="optionhead">Nahradit pouze, pokud jsou údaje novější</span>
		<p>Odpovídající záznamy budou nahrazeny pouze, pokud přicházející záznam je novější než záznam, který se nachází v databázi. Porovnání je založeno na "Poslední aktualizace" nebo údaji CHAN,
		který je se s tímto záznamem spojen v souboru GEDCOM.</p>

		<span class="optionhead">Importovat média, pokud existují</span>
		<p>Pokud váš soubor GEDCOM obsahuje odkazy na média, zaškrtnutím tohoto políčka umožníte TNG tyto odkazy naimportovat a nastavit příslušné propojení.
		Musíte však fyzické soubory, které těmto odkazům odpovídají, nakopírovat na vaše stránky do příslušných složek (např. pomocí FTP). Nechcete-li importovat
		žádná média, před zahájením importu toto políčko odškrtněte.</p>

		<span class="optionhead">Začít číslovat ID čísla od prvního volného čísla/Začít číslovat ID čísla od</span>
		<p>Pokud zvolíte možnost "Přidat všechny záznamy", zobrazí se vám také tato volba. Výběrem první možnosti vytvoří
		TNG nové ID číslo příchozího záznamu přidělením prvního volného ID čísla v každé kategorii (osoby, rodiny, prameny, úložiště pramenů).
		Druhou možnost vyberte, pokud chcete, aby TNG vytvořil pro příchozí záznam nové ID číslo od určitého čísla (stejné pro každou kategorii).
		Vyberete-li tuto možnost, ujistěte se, že v určeném rozsahu neexistují žádné záznamy nebo dojde ke kolizím.</p>

 		<span class="optionhead">Starý styl importu</span>
		<p>Před verzí TNG 7 se zobrazoval průběh importu. Místo toho se na obrazovce opakovaně objevoval počet importovaných osob a rodin.
		Nový počet byl vždy zobrazen vedle starého počtu, takže brzy přesáhl rozměr stránky. Lišta průběhu je čistší a názornější,
		ale v některých případech starý import pracoval lépe, protože bylo na obrazovce zobrazeno více údajů. Pokud ve vašem případě nový import
		selže, můžete zaškrtnutím této volby zkusit, zda starý import neproběhne lépe.</p>

		<p>Pokud jste připraveni, klikněte na tlačítko <strong>Importovat data</strong> a zahájíte proces. Měli byste vidět lištu průběhu a řadu čítačů, které znázorňujících
		importované osoby, rodiny, prameny, poznámky a místa (pozn.: počítána jsou pouze místa obsahující zeměpisné souřadnice). Závěrečná zpráva
		vám sdělí, zda byl import úspěšně dokončen.</p>

		<span class="optionhead">Funkce "začít znovu"</span>
		<p>Pokud neuvidíte zprávu o "dokončení", váš server možná proces importu ukončil, protože trval příliš dlouho.
		Pokud se vám to stalo, jděte na stránku Admin/Nastavení/Nastavení importu
		a zaškrtněte políčko <strong>Uložit stav importu</strong>. Pak se vraťte na stránku importu a zkuste váš import znovu. Pokud jsou stejné podmínky,
		import by se měl sám restartovat.</p>

	</td>
</tr>
<tr>
	<td class="tngshadow databack">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="export"><p class="subheadbold">GEDCOM Export</p></a>
		<p>Tato stránka vám umožní exportovat svá data z určitého stromu do standardního souboru GEDCOM 5.5. Soubor bude uložen ve vaší složce
		GEDCOM (určena v Nastavení importu) a bude pojmenován názvem stromu a příponou ".ged".</p>

		<span class="optionhead">Větev</span>
		<p>Chcete-li do exportovaného souboru GEDCOM vložit pouze osoby a rodiny z určité větve, můžete tuto větev vybrat z tohoto seznamu.</p>

		<span class="optionhead">Vyloučit žijící/Vyloučit neveřejné</span>
		<p>Zaškrtnutím těchto tlačítek vyloučíte žijící nebo neveřejné osoby z exportovaného souboru GEDCOM.</p>

		<span class="optionhead">Exportovat odkazy na média</span>
		<p>Zaškrtnutím této volby vložíte informace, které se vztahují ke všem fotografiím, vyprávěním a jiným médiím připojeným k osobám, rodinám,
		pramenům a úložištím pramenů ve vybraném stromě. Tyto informace obsahují název souboru, popis a poznámky.</p>

		<span class="optionhead">Zazipovat a vložit mediální soubory</span>
		<p>Pokud zaškrtnete možnost Exportovat odkazy na média, dostáváte také možnost zaškrtnout možnost zazipovat hotový soubor a zahrnout fyzické mediální 
    soubory uvedené v souboru GEDCOM. Vezměte na vědomí, že to může způsobit, že váš soubor bude extrémně velký.</p>

		<span class="optionhead">Lokální umístění fotografií/dokumentů/náhrobků/vyprávění/zvukových záznamů/videí</span>
		<p>Chcete-li připojit ke každému souboru média lokální umístění (např. "C:\mojefotografie\" nebo "..\genealogie\"), zaškrtněte políčko "Exportovat odkazy na média", a poté do příslušného pole
		toto umístění zapište (zadat musíte koncové lomítko). Ponecháte-li tyto řádky prázdné, budou do souboru GEDCOM ke každému médiu uloženy pouze název souboru a umístění, které jsou v TNG,
		a budou exportovány s tagem "FILE".
		</p>

		<span class="optionhead">Funkce "začít znovu"</span>
		<p>Pokud neuvidíte zprávu o "dokončení", vaše data nebyla vyexportovány kompletně.
		Pokud neuvidíte žádné počty, nebo uvidíte počty, ale neuvidíte zprávu o "dokončení", váš server možná proces exportu ukončil, protože trval příliš dlouho.
		Pokud se vám to stalo, jděte na stránku Admin/Nastavení/Nastavení importu
		a zaškrtněte políčko <strong>Uložit stav importu</strong>. Pak se vraťte zpět na tuto na stránku a zkuste váš export znovu. Pokud váš export nedoběhne do konce, budete nyní moci
		kliknout na odkaz "pokračovat" v horní části stránky pro znovuzahájení exportu.</p>
    
		<span class="optionhead">Souhrn</span>
		<p>Po dokončení exportu byste měli vidět souhrn toho, kolik osob, rodin, pramenů, poznámek, úložišť, médií a míst bylo exportováno. Je třeba 
    poznamenat, že do celkového počtu míst budou započítána pouze místa, která mají informace o zeměpisné šířce/délce nebo poznámky.</p>
        
	</td>
</tr>

</table>
</body>
</html>
