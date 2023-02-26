<?php
include("../../helplib.php");
echo help_header("Nápověda: Nastavení protokolování");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="pedconfig_help.php" class="lightlink">&laquo; Nápověda: Nastavení schémat</a> &nbsp; | &nbsp;
			<a href="importconfig_help.php" class="lightlink">Nápověda: Nastavení importu &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Nastavení protokolování</span>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
		<span class="optionhead">Název souboru protokolu (Veřejná oblast)</span>
		<p>Soubor protokolu je soubor, kam jsou zaznamenávány akce návštěvníků. Původní název "genlog.txt" byste neměli měnit.</p>

		<span class="optionhead">Název souboru protokolu (Administrace)</span>
		<p>Soubor protokolu je soubor, kam jsou zaznamenávány akce v administrativní oblasti. Původní název "adminlog.txt" byste neměli měnit.</p>

		<p>Pozn.: Pro větší zabezpečení vašich souborů protokolu zaškrtněte políčko označené „Uložit v konfigurační cestě“, aby TNG uložil soubory protokolu v tomto umístění. Soubory protokolu musíte do tohoto umístění přesunout sami před uložením této hodnoty nebo bezprostředně poté.</p>

		<span class="optionhead">Maximální počet řádků v protokolu (Veřejná oblast)</span>
		<p>Maximální počet řádků v protokolu udává, kolik akcí týkajících se veřejné oblasti by měl protokol aktuálně uchovávat.
		Pokud je toto číslo příliš vysoké, může dojít ke snížení výkonu.</p>
    
    <span class="optionhead">Maximální počet řádků v protokolu (Administrace)</span>
		<p>Maximální počet řádků v protokolu udává, kolik akcí týkajících administrace by měl protokol aktuálně uchovávat.
		Pokud je toto číslo příliš vysoké, může dojít ke snížení výkonu.</p>

		<span class="optionhead">Vyloučit názvy hostitele</span>
		<p>Před provedením zápisu do protokolu TNG tento seznam otestuje. Pokud hostitel návštěvníka podléhají případnému zápisu do protokolu
		je v seznamu, nebude proveden žádný zápis. Názvy hostitelů by měly být odděleny čárkami (bez mezer) a mají obsahovat úplný
		název hostitele, IP adresu nebo části obou. Např. "googlebot" bude blokovat "crawler4.googlebot.com".</p>

		<span class="optionhead">Vyloučit uživatelská jména</span>
		<p>Před provedením zápisu do protokolu TNG tento seznam otestuje také. Pokud je přihlášený uživatel
		v seznamu, nebude proveden žádný zápis. Uživatelská jména by měla být oddělena čárkami (bez mezer).</p>

		<span class="optionhead">Zablokovat návrhy nebo nové uživatelské registrace</span></p>

		<span class="optionhead">Adresa obsahuje</span>
		<p>Blokuje všechny příchozí návrhy nebo nové uživatelské registrace, kde emailová adresa odesílatele obsahuje nějaké ze zapsaných slov nebo částí slov.
		Více slov oddělujte čárkou.</p>

		<span class="optionhead">Zpráva obsahuje</span>
		<p>Blokuje všechny příchozí návrhy nebo nové uživatelské registrace, kde tělo zprávy obsahuje nějaké ze zapsaných slov nebo částí slov.
		Více slov oddělujte čárkou.</p>
	</td>
</tr>

</table>
</body>
</html>
