<?php
include("../../helplib.php");
echo help_header("Nápovìda: Nastavení ¹ablony");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="mapconfig_help.php" class="lightlink">&laquo; Nápovìda: Nastavení mapy</a> &nbsp; | &nbsp;
			<a href="users_help.php" class="lightlink">Nápovìda: U¾ivatelé &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Nastavení ¹ablony</span>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  
		<p><span class="optionhead">Pou¾ití ¹ablony</span><br />©ablony TNG umo¾ní dát va¹im stránkám rychle profesionální vzhled a atmosféru. Chcete-li ¹ablonu pou¾ít, nejdøíve nastavte
			"Umo¾nit výbìr ¹ablony" na <strong>Ano</strong>, pak vyberte èíslo ¹ablony, kterou chcete (viz volby na
			<a href="https://tngsitebuilding.com/templates.php">https://tngsitebuilding.com/templates.php</a>). Po ulo¾ení zmìn bude nová ¹ablony úèinkovat.</p>
		<p>Chcete-li zachovat existující nastavení stránky (z verze pøed 8.1.0), nechte volbu <strong>Umo¾nit výbìr ¹ablony</strong> nastavenu na <b>Ne</b>.</p>
		<p><span class="optionhead">Pøizpùsobení</span><br />Va¹i stránku mù¾ete upravit podle toho, co vám soubory ¹ablon dovolí. Va¹e výchozí domovská stránka je index.php, va¹e
			výchozí záhlaví a zápatí je topmenu.php a footer.php. Soubory s tìmito názvy jsou umístìny uvnitø slo¾ky ka¾dé ¹ablony. Specifický "styl" ¹ablony (barvy, písma a jiné
			formátování) je definováno v souboru templatestyle.css (v podslo¾ce "css" u ka¾dé ¹ablony), ale pokud chcete nìco mìnit, je lep¹í zmìny provést
			v souboru mytngstyle.css (také v podslo¾ce "css" u ka¾dé ¹ablony), tak¾e va¹e zmìny nebudou v budoucnu pøepsány aktualizací programu.</p>
		<p><span class="optionhead">Podpora více jazykù</span><br />Pokud chcete, aby byla nìjaká zpráva v nastavení ¹ablony dostupná v jiném jazyku,
			vyberte tento jazyk z rozbalovacího seznamu vedle odpovídající zprávy, poté kliknìte na tlaèítko "Provést". Objeví se
			nové pole, kam mù¾ete zapsat pøeklad této zprávy. Po kliknutí na tlaèítko "Ulo¾it" v horní èásti stránky se tato zpráva stane trvalou souèástí
			nastavení ¹ablony va¹í stránky.</p>
		<p><span class="optionhead">Jednoduché zmìny</span><br />Zmìny mù¾ete udìlat pøímo úpravou souborù zmínìných v pøede¹lém odstavcích, ale nìkteré jednoduché zmìny mù¾ete provést
			zde v Nastavení ¹ablony. Vyberte ¹ablonu podle èísla a zobrazí se vám nìkteré klíèové prvky stránky. Zmìna tìchto nastavení
			automaticky upraví va¹i stránku, pøi pøedpokladu, ¾e ji¾ jste stránky neupravili
			ruènì. Mù¾ete udìlat zmìn, kolik chcete, ale pokud odstraníte nìkterý PHP kód,
			nemusí u¾ tyto zmìny pùsobit.</p>
		<p><span class="optionhead">Obrázky</span><br />Chcete-li zmìnit nìjaký obrázek, nejjednodu¹¹í je kliknout na tlaèítko "Zmìnit" vedle pole obsahujícího
			název obrázku. Zobrazí se vám pak nové pole, které vám umo¾ní najít obrázek na va¹em poèítaèi. Po nahrání nového obrázku se jeho
			název zobrazí v poli místo názvu pùvodního obrázku. Chcete-li jeho název zmìnit, zadejte v tomto poli jeho nový název.
			S ohledem na co nejlep¹í kvalitu dbejte na to, aby mìl vá¹ nový obrázek stejné rozmìry jako obrázek existující. Rozmìry obrázku zjistíte
			kliknutím pravým tlaèítkem my¹i na obrázek, který vidíte ve svém prohlí¾eèi (pou¾ijte tlaèítko "Náhled"), a výbìrem "Vlastnosti" nebo "Zobrazit vlastnosti obrázku". Pokud musíte
			rozmìry obrázku zmìnit, musíte je zmìnit ruènì.</p>
			<p>Po nahrání obrázku a dokonèení v¹ech zmìn kliknìte na "Ulo¾it" v dolní èásti stránky. Pokud tento proces neprobìhne, mù¾ete mít chybnì nastavena pøístupová
			práva na va¹i slo¾ku ¹ablon. Ujistìte se, zda jsou práva nastavena na 755 nebo 777. Pokud stále nemù¾ete pracovat, mù¾ete k nahrání nového obrázku pøímo do podslo¾ky "img" ve slo¾ce ¹ablony,
      kterou pou¾íváte, pou¾ít FTP program nebo jiný online správce souborù.</p>
		<p><span class="optionhead">Odkazy na funkce a zdroje</span><br />Pokud va¹e vybraná ¹ablona obsahuje nìkterou z tìchto mo¾ností, mù¾ete vytvoøit odkazy v tìchto
			sekcích pomocí seznamu názvù odkazù a jejich URL na jednom øádku oddìlených èárkou. Napø. <em>TNG, https://tngsitebuilding.com</em>.</p>
		<p><span class="optionhead">Zmìna názoru</span><br />Volby nastavení mù¾ete upravit pro více ¹ablon, ale pou¾ita mù¾e být pouze jedna. Pokud se pozdìji rozhodnete, ¾e chcete pou¾ívat jinou
			¹ablonu, v horní èásti stránky Nastavení ¹ablony vyberte nové èíslo ¹ablony. Zmìny nastavení, které jste provedli ve va¹í pùvodní ¹ablonì,
			zùstanou zachovány, kdybyste se rozhodli pro návrat na pøedchozí ¹ablonu.</p>
	</td>
</tr>

</table>
</body>
</html>
