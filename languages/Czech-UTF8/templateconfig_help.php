<?php
include("../../helplib.php");
echo help_header("Nápověda: Nastavení šablony");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="mapconfig_help.php" class="lightlink">&laquo; Nápověda: Nastavení mapy</a> &nbsp; | &nbsp;
			<a href="users_help.php" class="lightlink">Nápověda: Uživatelé &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Nastavení šablony</span>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  
		<p><span class="optionhead">Použití šablony</span><br />Šablony TNG umožní dát vašim stránkám rychle profesionální vzhled a atmosféru. Chcete-li šablonu použít, nejdříve nastavte
			"Umožnit výběr šablony" na <strong>Ano</strong>, pak vyberte číslo šablony, kterou chcete (viz volby na
			<a href="https://tngsitebuilding.com/templates.php">https://tngsitebuilding.com/templates.php</a>). Po uložení změn bude nová šablony účinkovat.</p>
		<p>Chcete-li zachovat existující nastavení stránky (z verze před 8.1.0), nechte volbu <strong>Umožnit výběr šablony</strong> nastavenu na <b>Ne</b>.</p>
		<p><span class="optionhead">Přizpůsobení</span><br />Vaši stránku můžete upravit podle toho, co vám soubory šablon dovolí. Vaše výchozí domovská stránka je index.php, vaše
			výchozí záhlaví a zápatí je topmenu.php a footer.php. Soubory s těmito názvy jsou umístěny uvnitř složky každé šablony. Specifický "styl" šablony (barvy, písma a jiné
			formátování) je definováno v souboru templatestyle.css (v podsložce "css" u každé šablony), ale pokud chcete něco měnit, je lepší změny provést
			v souboru mytngstyle.css (také v podsložce "css" u každé šablony), takže vaše změny nebudou v budoucnu přepsány aktualizací programu.</p>
		<p><span class="optionhead">Podpora více jazyků</span><br />Pokud chcete, aby byla nějaká zpráva v nastavení šablony dostupná v jiném jazyku,
			vyberte tento jazyk z rozbalovacího seznamu vedle odpovídající zprávy, poté klikněte na tlačítko "Provést". Objeví se
			nové pole, kam můžete zapsat překlad této zprávy. Po kliknutí na tlačítko "Uložit" v horní části stránky se tato zpráva stane trvalou součástí
			nastavení šablony vaší stránky.</p>
		<p><span class="optionhead">Jednoduché změny</span><br />Změny můžete udělat přímo úpravou souborů zmíněných v předešlém odstavcích, ale některé jednoduché změny můžete provést
			zde v Nastavení šablony. Vyberte šablonu podle čísla a zobrazí se vám některé klíčové prvky stránky. Změna těchto nastavení
			automaticky upraví vaši stránku, při předpokladu, že již jste stránky neupravili
			ručně. Můžete udělat změn, kolik chcete, ale pokud odstraníte některý PHP kód,
			nemusí už tyto změny působit.</p>
		<p><span class="optionhead">Obrázky</span><br />Chcete-li změnit nějaký obrázek, nejjednodušší je kliknout na tlačítko "Změnit" vedle pole obsahujícího
			název obrázku. Zobrazí se vám pak nové pole, které vám umožní najít obrázek na vašem počítači. Po nahrání nového obrázku se jeho
			název zobrazí v poli místo názvu původního obrázku. Chcete-li jeho název změnit, zadejte v tomto poli jeho nový název.
			S ohledem na co nejlepší kvalitu dbejte na to, aby měl váš nový obrázek stejné rozměry jako obrázek existující. Rozměry obrázku zjistíte
			kliknutím pravým tlačítkem myši na obrázek, který vidíte ve svém prohlížeči (použijte tlačítko "Náhled"), a výběrem "Vlastnosti" nebo "Zobrazit vlastnosti obrázku". Pokud musíte
			rozměry obrázku změnit, musíte je změnit ručně.</p>
			<p>Po nahrání obrázku a dokončení všech změn klikněte na "Uložit" v dolní části stránky. Pokud tento proces neproběhne, můžete mít chybně nastavena přístupová
			práva na vaši složku šablon. Ujistěte se, zda jsou práva nastavena na 755 nebo 777. Pokud stále nemůžete pracovat, můžete k nahrání nového obrázku přímo do podsložky "img" ve složce šablony,
      kterou používáte, použít FTP program nebo jiný online správce souborů.</p>
		<p><span class="optionhead">Odkazy na funkce a zdroje</span><br />Pokud vaše vybraná šablona obsahuje některou z těchto možností, můžete vytvořit odkazy v těchto
			sekcích pomocí seznamu názvů odkazů a jejich URL na jednom řádku oddělených čárkou. Např. <em>TNG, https://tngsitebuilding.com</em>.</p>
		<p><span class="optionhead">Změna názoru</span><br />Volby nastavení můžete upravit pro více šablon, ale použita může být pouze jedna. Pokud se později rozhodnete, že chcete používat jinou
			šablonu, v horní části stránky Nastavení šablony vyberte nové číslo šablony. Změny nastavení, které jste provedli ve vaší původní šabloně,
			zůstanou zachovány, kdybyste se rozhodli pro návrat na předchozí šablonu.</p>
	</td>
</tr>

</table>
</body>
</html>
