<?php
include("../../helplib.php");
echo help_header("Nápovìda: Nastavení mapy");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="importconfig_help.php" class="lightlink">&laquo; Nápovìda: Nastavení importu dat</a> &nbsp; | &nbsp;
			<a href="templateconfig_help.php" class="lightlink">Nápovìda: Nastavení ¹ablony &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Nastavení mapy</span>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

		<span class="optionhead">Klíè k mapì</span>
		<p>Chcete-li na svém webu pou¾ívat Mapy Google, musíte od spoleènosti Google získat <strong>klíè</strong>. Chcete-li získat klíè k mapì, musíte také
      mít u¾ivatelské ID Google. Pokud jste ji¾ zaregistrováni do slu¾by Google Mail, mù¾ete pou¾ít toto u¾ivatelské ID, jinak si budete muset vytvoøit nový
      úèet Google. Na svém úètu Google musíte také povolit fakturaci. Jakmile budete mít úèet s povolenou fakturací, mù¾ete získat klíè zde:
			<a href="https://console.cloud.google.com/" target="_blank">https://console.cloud.google.com/</a>.</p>
		<p>Jakmile tam budete, nejprve vyberte svùj projekt. Z knihovny API (èást Mapy) vyberte a povolte následující tøi klíèe:
      Maps JavaScript API, Geocoding API a Places API. Maps JavaScript API je potøeba k zobrazení mapy Google náv¹tìvníkùm va¹eho webu,
      se znaèkou na rùzných místech (místo narození, úmrtí, svatby atd.). Geocoding API se pou¾ívá v administrátorské sekci va¹eho
      webové stránky pro pøiøazení míst k souøadnicím.
		</p>
		<p>Více informací získáte na <a href="https://tng.lythgoes.net/wiki/index.php/Google_Maps_-_Getting_Started">https://tng.lythgoes.net/wiki/index.php/Google_Maps_-_Getting_Started</a>.

		<ul>
		<li>Vytvoøte API klíè pod polo¾kou "APIs &amp; Services (Credentials)" a pøidejte adresu svého webu jako "HTTP referrer".</li>
		<li>V nabídce "Mapy Google" povolte "Maps Javascript API".</li>
		</ul>    
    
		<p>Po získání va¹eho klíèe jej nakopírujte do pole <strong>Klíè k mapì</strong> na stránce Administrace > Nastavení > Nastavení map. Pokud se pozdìji rozhodnete, ¾e mapy z Google Maps ji¾ pou¾ívat nechcete,
		klíè z tohoto pole jednodu¹e odstraòte a mapy a pole s mapami spojená se vám ji¾ nebudou zobrazovat. Více informací o práci s Google Maps najdete na TNG Wiki: 
    <a href="http://tng.lythgoes.net/wiki/index.php/Google_Maps_-_Getting_Started" target="_blank">http://tng.lythgoes.net/wiki/index.php/Google_Maps_-_Getting_Started</a>.</p>

		<span class="optionhead">Umo¾nit mapy</span>
		<p>Chcete-li na va¹ich stránkách tam, kde jsou souøadnice zemìpisné ¹íøky a délky, zobrazit Google Maps, nastavte tuto volby na "Ano" (jinými slovy, i kdy¾ jste umo¾nili
		tuto volby, mapu neuvidíte, pokud záznamy va¹ich míst neobsahují souøadnice zemìpisné ¹íøky a délky (nebyly tzv. geokódovány)).</p>

		<span class="optionhead">Typ mapy</span>
		<p>Vyberte, který typ mapy bude zobrazen nejdøíve: Terénní, Cestovní mapa, Satelitní nebo Hybridní (satelitní mapa s ulicemi na povrchu).</p>

		<span class="optionhead">Výchozí zemìpisná ¹íøka, Výchozí zemìpisná délka</span>
		<p>Tyto souøadnice urèují, kde je výchozí "støed" mapy u míst, která je¹tì nemají pøipojeny zemìpisné souøadnice. ©pendlík bude zobrazen
		v tomto místì.</p>

		<span class="optionhead">Výchozí pøiblí¾ení</span>
		<p>Toto èíslo oznaèuje, jak blízko nebo daleko bude pøi zahájení zobrazena v administrátorské oblasti nová mapa. Ni¾¹í èíslo znamená, ¾e
		pohled bude dál, zatímco je-li èíslo vy¹¹í, pohled bude blí¾. Pokud bude pøiblí¾ení ulo¾eno s urèitou mapou, bude s touto mapou ulo¾eno.</p>

		<span class="optionhead">Pøiblí¾ení místa</span>
		<p>Toto èíslo oznaèuje, jak blízko nebo daleko bude na Google Maps zobrazeno v administrátorské oblasti místo, po jeho vyhledání a nalezení.</p>

		<span class="optionhead">Rozmìry na stránkách osob</span>
		<p>Zadejte rozmìry (¹íøka musí být v pixelech s oznaèením "px" na konci nebo v procentech; vý¹ka musí být v pixelech s oznaèením "px" na konci) map
		zobrazených na stránkách osob. Napø. chcete-li vytvoøit mapu vysokou 500 pixelù, nastavte <strong>vý¹ku</strong> na 500px. Chcete-li vytvoøit mapu, která má obsáhnout 80 procent
		místa z pøidìlené oblasti, nastavte <strong>¹íøku</strong> na 80%.</p>

		<span class="optionhead">Rozmìry na stránkách náhrobkù</span>
		<p>Zadejte rozmìry (¹íøka musí být v pixelech s oznaèením "px" na konci nebo v procentech; vý¹ka musí být v pixelech s oznaèením "px" na konci) map
		zobrazených na v¹ech stránkách, které jsou spojeny s náhrobky.</p>

		<span class="optionhead">Rozmìry na stránkách administrátora</span>
		<p>Zadejte rozmìry (¹íøka musí být v pixelech s oznaèením "px" na konci nebo v procentech; vý¹ka musí být v pixelech s oznaèením "px" na konci) map
		zobrazených na v¹ech administrátorských stránkách.</p>

		<span class="optionhead">Skrýt na zaèátku mapy v administrátorské oblasti</span>
		<p>Chcete-li na stránkách administrátora skrýt mapy, dokud jste neklikli na tlaèítko <span class="emphasis">Zobrazit/Skrýt</span>, vyberte zde volbu <span class="choice">Ano</span>.
		Chcete-li zobrazit mapy ihned po zobrazení tìchto stránek, vyberte volbu <span class="choice">Ne</span>.</p>

		<span class="optionhead">Skrýt na zaèátku mapy ve veøejné oblasti</span>
		<p>Chcete-li zpozdit zobrazení mapy na stránkách osoby, dokud je u¾ivatel nezavolá, vyberte zde volbu <span class="choice">Ano</span>. Umo¾ní to
		naèíst stránku rychleji. Mapa pak bude naètena po kliknutí na tlaèítko <span class="emphasis">Zobrazit mapu</span>.  
		Pokud vyberete volbu <span class="choice">Ne</span>, mapa na stránce osoby bude naètena hned po zobrazení této stránky.</p>

		<span class="optionhead">Slouèit duplicitní ¹pendlíky</span>
		<p>Pokud se na stejném místì objeví více událostí, nastavením této volby na <span class="emphasis">Ano</span> zabráním vytvoøení duplicitních ¹pendlíkù
		u nejednoznaèných názvù míst. Pozn.: Nastavením této volby na <span class="emphasis">Ne</span> zpùsobí, ¾e si duplicitní ¹pendlíky budou vzájemnì pøeká¾et.</p>

		<span class="optionhead">©pendlíky úrovní sídel: Oznaèení a barvy</span>
		<p>Ka¾dé místo se zemìpisnými souøadnicemi mù¾e být spojeno s jedním ze ¹esti <strong>Úrovní sídla</strong> (napø. Místo, Mìsto/obec, Okres, atd.). Oznaèení pro tyto úrovnì
		naleznete v souboru "alltext.php", který se nachází ve slo¾ce pøíslu¹ného jazyka a pøepsat je mù¾ete ve va¹em souboru "cust_text.php" (také v ka¾dé jazykové slo¾ce).</p>

		<p>Barvy ¹pendlíkù urèují hodnoty v souboru mapconfig.php. Chcete-li barvy ¹pendlíkù zmìnit, jdìte na stránku TNG download
		a stáhnìte si úplnou paletu 216 rùzných barev ¹pendlíkù, poté otevøete v textovém editoru svùj soubor mapconfig.php a zadejte èíslo
		nové barvy ¹pendlíkù vedle promìnné odpovídající úrovni sídla. Nakonec nahrajte soubor s novou barvou ¹pendlíku do slo¾ky <span class="emphasis">googlemaps</span> na va¹ich stránkách.</p>

	</td>
</tr>

</table>
</body>
</html>
