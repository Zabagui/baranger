<?php
include("../../helplib.php");
echo help_header("Nápovìda: Import dat");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="mostwanted_help.php" class="lightlink">&laquo; Nápovìda: Hledá se</a> &nbsp; | &nbsp;
			<a href="second_help.php" class="lightlink">Nápovìda: Nástroje po importu &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Import / Export</span>
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
		<p>Na této stránce mù¾ete naimportovat v¹echna data ze standardního souboru GEDCOM do urèitého stromu.</p>

		<p><span class="optionhead">Pøed importem:</span> Z va¹eho genealogického programu vytvoøte standardní soubor GEDCOM (preferovaný je 5.5 nebo 7.0., ale 4.0 je také akceptovatelný). Neveøejné informace u ¾ijících osob
		mù¾ete vylouèit, ale není to nutné. Není také nutné vylouèit údaje týkající se CJKSpd, proto¾e mohou být také filtrovány v závislosti na u¾ivatelských právech.</p>

		<p>Po vytvoøení souboru GEDCOM je dal¹ím krokem, jak ho dostat na va¹e webové stránky. Význam jednotlivých polí je následující:</p>

		<p><span class="optionhead">Import souboru GEDCOM z va¹eho poèítaèe</span>
		Chcete-li nahrát a importovat vá¹ soubor na va¹e stránky bez pou¾ití FTP, kliknìte na tlaèítko "Prohledat" a najdìte soubor na va¹em disku. Po jeho vyhledání se v tomto poli objeví název a umístìní va¹eho souboru.
		<strong>POZN.</strong>: Pokud je vá¹ soubor GEDCOM velký (> 2MB), mù¾ete jej nejprve zkusit "zazipovat" (TNG soubor po nahrání automaticky rozbalí). Je-li výsledný soubor stále velký, budete muset pøed nahráním va¹eho souboru tímto zpùsobem kontaktovat poskytovatele svého hostingu, proto¾e server mù¾e mít omezení maximální
		velikosti pro nahrávání souborù prostøednictvím webového formuláøe. Pokud bìhem importu obdr¾íte chybové hlá¹ení, jedná se o tento pøípad. Zkuste místo toho pou¾ít k nakopírování svého souboru do slo¾ky GEDCOM program FTP, a pak jej naimportujte odtud (viz ní¾e).</p>

		<span class="optionhead">NEBO Import souboru GEDCOM z webových stránek (ve slo¾ce GEDCOM)</span>
		<p>Pokud jste pro pøenos souboru GEDCOM nebo ZIP do slo¾ky GEDCOM na va¹ich stránkách pou¾ili FTP nebo nìjaký online souborový mana¾er, zapi¹te sem pøesný název va¹eho souboru, který chcete nahrát nebo kliknìte na
		tlaèítko "Vybrat" pro jeho nalezení na va¹ich stránkách. Musí být ve slo¾ce GEDCOM nebo jej tlaèítko Vybrat nenajde. <strong>POZN.</strong>: Pokud vidíte seznam
		souborù, ale tyto nejsou z va¹í slo¾ky GEDCOM, máte zøejmì problém s umístìním souborù. Ovìøte svoji koøenovou slo¾ku (Admin/Nastavení/Základní nastavení) a va¹i slo¾ku GEDCOM (Admin/Nastavení/Nastavení importu).</p>

		<p>Pozn.: Pokud nahrajete/importujete soubor ZIP a vlo¾íte do souboru aktuální média, TNG rozbalí média do pøíslu¹ných slo¾ek médií (napø. "photos" nebo podslo¾ka "photos"). Dal¹í mo¾nosti týkající se vlo¾ených médií naleznete v èásti Administrace/Nastavení/Nastavení importu dat.</p>

		<span class="optionhead">Pøijmout data pro v¹echny typy vlastních událostí</span>
		<p>Vá¹ soubor GEDCOM mù¾e obsahovat události, které bude TNG pova¾ovat za nestandardní události. Normálnì jsou typy nových událostí a atributù, které soubor GEDCOM obsahuje, vlo¾eny do databáze, ale
		ale je nastaveno, aby tato data byla ignorována. Aby bylo mo¾né importovat události nebo atributy tohoto typu, musíte zmìnit stav takového typu na "Pøijmout" (jinými slovy,
		abyste nemuseli vá¹ soubor importovat dvakrát). Pokud tuto volbu za¹krtnete, TNG automaticky nastaví v¹echny typy nových událostí a atributù na "Pøijmout" a v¹echny va¹e události
		budou importovány napoprvé.</p>
    
		<span class="optionhead">Importovat pouze typy vlastních událostí a atributù (nebudou vlo¾eny, nahrazeny nebo pøidány ¾ádné údaje)</span>
		<p>Za¹krtnutí této volby zpùsobí, ¾e budou naimportovány pouze typy vlastních událostí a atributù (viz Administrace/Typy událostí / atributù). V¹echny dal¹í údaje budou ignorovány. To je ideální mo¾nost
		jak sestavit va¹e výchozí nastavení, proto¾e vám umo¾ní vidìt, které vlastní události vás soubor GEDCOM obsahuje. Poté mù¾ete zvolit, které události
		pøed importem va¹í celé databáze pøijmout a které odmítnout.</p>

		<span class="optionhead">Cílový strom</span><br />
		<p>Vyberte strom, do kterého chcete importovat data (povinné). Pokud strom, kam mají data pøijít, je¹tì neexistuje, kliknìte na tlaèítko "Pøidat nový strom" a vytvoøte jej.
		Objeví se malé okno, které vám umo¾ní zadat informace o novém stromu.</p>

		<span class="optionhead">Nahradit v¹echna aktuální data</span>
		<p>Zvolíte-li tuto mo¾nost, v¹echny va¹e døívìj¹í údaje ze souboru GEDCOM (osoby, rodiny, dìti, prameny, úlo¾i¹tì pramenù, události, poznámky, spojení a citace; ne média a cokoli jiného)
		budou pøed importem vymazána.
		<strong>POZN.</strong>: Odkazy na média budou zachovány, pokud se ID èísla osoby/rodiny/pramenu/úlo¾i¹tì pramenù ve va¹em novém souboru GEDCOM budou shodovat s ID èísly va¹ich dosavadních dat.
		Vìt¹ina genealogických programù pøiøazují stálá ID èísla ka¾dé osobì/rodinì/pramenu/úlo¾i¹ti pramenù, ale nìkteré ne. Pokud máte k datùm pøipojeny nìjaké polo¾ky médií, pøed importem, prosím, zkontrolujte,
		zda se ID èísla ve va¹em novém souboru GEDCOM shodují, bez ohledu na to, kterou z tìchto mo¾ností máte vybránu. Je také vhodné vytvoøit pøed importem zálohu va¹ich tabulek
		(viz Admin/Obslu¾né programy o vytvoøení zálohy).</p>

		<span class="optionhead">Nahradit pouze odpovídající záznamy</span>
		<p>S touto volbou jsou pøidány nové záznamy a odpovídající záznamy jsou nahrazeny (shoda je podmínìna pouze ID èísly). Staré údaje nejsou odstranìny.</p>

		<span class="optionhead">Nenahradit ¾ádná data</span>
		<p>Nové záznamy budou pøidány, ale shodné záznamy budou ignorovány (nenahrazeny).</p>

		<span class="optionhead">Pøidat v¹echny záznamy</span>
		<p>V¹echny záznamy budou naimportovány, bez ohledu na existující data, ale jejich ID èísla budou pøeèíslována. ID èísla importovaných záznamù budou vytvoøena od prvního volného èísla
		(nebo èísla, které urèíte).</p>

		<span class="optionhead">V¹echna pøíjmení velkými písmeny</span>
		<p>Za¹krtnutím tohoto políèka pøed importem zpùsobí pøevedení v¹ech pøíchozích pøíjmení na velká písmena. Pøíjmení budou tímto zpùsobem ulo¾ena v databázi,
		tak¾e tento proces nelze vzít zpìt, pokud vá¹ soubor GEDCOM nenaimportujete znovu.</p>

		<span class="optionhead">Nepøepoèítat oznaèení ®ijící</span>
		<p>Pokud zvolíte "Nahradit pouze odpovídající záznamy", zobrazí se vám tato volba. Pøed importem tuto volbu za¹krtnìte,
    pokud nechcete, aby bylo pøepoèítáno oznaèení "®ijící" pro osoby, které ji¾ jsou v databázi.</p>

		<span class="optionhead">Nahradit pouze, pokud jsou údaje novìj¹í</span>
		<p>Odpovídající záznamy budou nahrazeny pouze, pokud pøicházející záznam je novìj¹í ne¾ záznam, který se nachází v databázi. Porovnání je zalo¾eno na "Poslední aktualizace" nebo údaji CHAN,
		který je se s tímto záznamem spojen v souboru GEDCOM.</p>

		<span class="optionhead">Importovat média, pokud existují</span>
		<p>Pokud vá¹ soubor GEDCOM obsahuje odkazy na média, za¹krtnutím tohoto políèka umo¾níte TNG tyto odkazy naimportovat a nastavit pøíslu¹né propojení.
		Musíte v¹ak fyzické soubory, které tìmto odkazùm odpovídají, nakopírovat na va¹e stránky do pøíslu¹ných slo¾ek (napø. pomocí FTP). Nechcete-li importovat
		¾ádná média, pøed zahájením importu toto políèko od¹krtnìte.</p>

		<span class="optionhead">Zaèít èíslovat ID èísla od prvního volného èísla/Zaèít èíslovat ID èísla od</span>
		<p>Pokud zvolíte mo¾nost "Pøidat v¹echny záznamy", zobrazí se vám také tato volba. Výbìrem první mo¾nosti vytvoøí
		TNG nové ID èíslo pøíchozího záznamu pøidìlením prvního volného ID èísla v ka¾dé kategorii (osoby, rodiny, prameny, úlo¾i¹tì pramenù).
		Druhou mo¾nost vyberte, pokud chcete, aby TNG vytvoøil pro pøíchozí záznam nové ID èíslo od urèitého èísla (stejné pro ka¾dou kategorii).
		Vyberete-li tuto mo¾nost, ujistìte se, ¾e v urèeném rozsahu neexistují ¾ádné záznamy nebo dojde ke kolizím.</p>

 		<span class="optionhead">Starý styl importu</span>
		<p>Pøed verzí TNG 7 se zobrazoval prùbìh importu. Místo toho se na obrazovce opakovanì objevoval poèet importovaných osob a rodin.
		Nový poèet byl v¾dy zobrazen vedle starého poètu, tak¾e brzy pøesáhl rozmìr stránky. Li¹ta prùbìhu je èist¹í a názornìj¹í,
		ale v nìkterých pøípadech starý import pracoval lépe, proto¾e bylo na obrazovce zobrazeno více údajù. Pokud ve va¹em pøípadì nový import
		sel¾e, mù¾ete za¹krtnutím této volby zkusit, zda starý import neprobìhne lépe.</p>

		<p>Pokud jste pøipraveni, kliknìte na tlaèítko <strong>Importovat data</strong> a zahájíte proces. Mìli byste vidìt li¹tu prùbìhu a øadu èítaèù, které znázoròujících
		importované osoby, rodiny, prameny, poznámky a místa (pozn.: poèítána jsou pouze místa obsahující zemìpisné souøadnice). Závìreèná zpráva
		vám sdìlí, zda byl import úspì¹nì dokonèen.</p>

		<span class="optionhead">Funkce "zaèít znovu"</span>
		<p>Pokud neuvidíte zprávu o "dokonèení", vá¹ server mo¾ná proces importu ukonèil, proto¾e trval pøíli¹ dlouho.
		Pokud se vám to stalo, jdìte na stránku Admin/Nastavení/Nastavení importu
		a za¹krtnìte políèko <strong>Ulo¾it stav importu</strong>. Pak se vra»te na stránku importu a zkuste vá¹ import znovu. Pokud jsou stejné podmínky,
		import by se mìl sám restartovat.</p>

	</td>
</tr>
<tr>
	<td class="tngshadow databack">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="export"><p class="subheadbold">GEDCOM Export</p></a>
		<p>Tato stránka vám umo¾ní exportovat svá data z urèitého stromu do standardního souboru GEDCOM 5.5. Soubor bude ulo¾en ve va¹í slo¾ce
		GEDCOM (urèena v Nastavení importu) a bude pojmenován názvem stromu a pøíponou ".ged".</p>

		<span class="optionhead">Vìtev</span>
		<p>Chcete-li do exportovaného souboru GEDCOM vlo¾it pouze osoby a rodiny z urèité vìtve, mù¾ete tuto vìtev vybrat z tohoto seznamu.</p>

		<span class="optionhead">Vylouèit ¾ijící/Vylouèit neveøejné</span>
		<p>Za¹krtnutím tìchto tlaèítek vylouèíte ¾ijící nebo neveøejné osoby z exportovaného souboru GEDCOM.</p>

		<span class="optionhead">Exportovat odkazy na média</span>
		<p>Za¹krtnutím této volby vlo¾íte informace, které se vztahují ke v¹em fotografiím, vyprávìním a jiným médiím pøipojeným k osobám, rodinám,
		pramenùm a úlo¾i¹tím pramenù ve vybraném stromì. Tyto informace obsahují název souboru, popis a poznámky.</p>

		<span class="optionhead">Zazipovat a vlo¾it mediální soubory</span>
		<p>Pokud za¹krtnete mo¾nost Exportovat odkazy na média, dostáváte také mo¾nost za¹krtnout mo¾nost zazipovat hotový soubor a zahrnout fyzické mediální 
    soubory uvedené v souboru GEDCOM. Vezmìte na vìdomí, ¾e to mù¾e zpùsobit, ¾e vá¹ soubor bude extrémnì velký.</p>

		<span class="optionhead">Lokální umístìní fotografií/dokumentù/náhrobkù/vyprávìní/zvukových záznamù/videí</span>
		<p>Chcete-li pøipojit ke ka¾dému souboru média lokální umístìní (napø. "C:\mojefotografie\" nebo "..\genealogie\"), za¹krtnìte políèko "Exportovat odkazy na média", a poté do pøíslu¹ného pole
		toto umístìní zapi¹te (zadat musíte koncové lomítko). Ponecháte-li tyto øádky prázdné, budou do souboru GEDCOM ke ka¾dému médiu ulo¾eny pouze název souboru a umístìní, které jsou v TNG,
		a budou exportovány s tagem "FILE".
		</p>

		<span class="optionhead">Funkce "zaèít znovu"</span>
		<p>Pokud neuvidíte zprávu o "dokonèení", va¹e data nebyla vyexportovány kompletnì.
		Pokud neuvidíte ¾ádné poèty, nebo uvidíte poèty, ale neuvidíte zprávu o "dokonèení", vá¹ server mo¾ná proces exportu ukonèil, proto¾e trval pøíli¹ dlouho.
		Pokud se vám to stalo, jdìte na stránku Admin/Nastavení/Nastavení importu
		a za¹krtnìte políèko <strong>Ulo¾it stav importu</strong>. Pak se vra»te zpìt na tuto na stránku a zkuste vá¹ export znovu. Pokud vá¹ export nedobìhne do konce, budete nyní moci
		kliknout na odkaz "pokraèovat" v horní èásti stránky pro znovuzahájení exportu.</p>
    
		<span class="optionhead">Souhrn</span>
		<p>Po dokonèení exportu byste mìli vidìt souhrn toho, kolik osob, rodin, pramenù, poznámek, úlo¾i¹», médií a míst bylo exportováno. Je tøeba 
    poznamenat, ¾e do celkového poètu míst budou zapoèítána pouze místa, která mají informace o zemìpisné ¹íøce/délce nebo poznámky.</p>
        
	</td>
</tr>

</table>
</body>
</html>
