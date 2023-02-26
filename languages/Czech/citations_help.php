<?php
include("../../helplib.php");
echo help_header("Nápovìda: Citace");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="notes_help.php" class="lightlink">&laquo; Nápovìda: Poznámky</a> &nbsp; | &nbsp;
			<a href="events_help.php" class="lightlink">Nápovìda: Události &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Citace</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co je to?</a> &nbsp; | &nbsp;
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

		<a name="what"><p class="subheadbold">Co jsou to citace?</p></a>

		<p><strong>Citace</strong> je odkaz na záznam pramenu, provedená s úmyslem prokázat pravdivost nìjakého údaje. Pramen obvykle
    v¹eobecnì popisuje, kde byl uvedený údaj nalezen (napø. matrika nebo sèítací arch), zatímco citace obvykle obsahuje konkrétní informaci (napø. na které stránce).
		Jeden záznam pramenu mù¾e být citován vícekrát u rùzných osob, rodin, poznámek nebo událostí.</p>


	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Pøidat/Upravit/Vymazat citace</p></a>

		<p>Chcete-li pøidat, upravit nebo vymazat citace, kliknìte na ikonu Citace na stránce nahoøe nebo vedle nìjaké poznámky nebo události (pokud ji¾ citace existuje,
		na ikonì je zelená teèka). Po kliknutí na ikonu se objeví okno, ve kterém jsou zobrazeny
		v¹echny citace existující pro aktivní subjekt nebo událost.</p>

		<p>Chcete-li pøidat novou citaci, kliknìte na tlaèítko "Pøidat nové" a vyplòte formuláø. Pokud vybraný subjekt nebo událost je¹tì nemìly ¾ádné
		citace, dostanete se pøímo na obrazovku "Pøidat novou citaci".</p>

		<p>Pokud chcete existující citaci upravit nebo vymazat, kliknìte na pøíslu¹nou ikonu vedle této citace.</p>

    <p>Pøi pøidání nebo úpravì citace si v¹imnìte následujícího:</p>

		<span class="optionhead">ID èíslo pramenu</span>
		<p>Zapi¹te ID èíslo pramenu, který má být citován, nebo kliknìte na tlaèítko "Najít" pro jeho nalezení. Pokud pramen je¹tì nebyl vytvoøen,
		pøejdìte do Admin/Prameny a vytvoøte pramen v pøíslu¹ném stromì. Poté se vra»te do seznamu citací nebo mù¾ete kliknout na tlaèítko "Vytvoøit"
		pro zápis údajù o novém pramenu. Po ulo¾ení údajù bude do tohoto pole vlo¾eno nové ID èíslo pramenu.</p>
		<p>Pokud jste ji¾ bìhem své aktuální relace pro stejný typ subjektu (osoba, rodina, atd.) vytvoøili nìjakou citaci, uvidíte také tlaèítko "Kopírovat poslední". Kliknutí
		na toto tlaèítko budou v¹echna pole vyplnìna stejnými údaji, jako jste pou¾ili ve své minulé citaci.</p>
		
        <!--<span class="optionhead">Description</span>
		<p>If your desktop genealogy program does not assign ID numbers to your sources, your citation will have a Description instead. You will not see
		the Description field for a new citation.</p>-->

		<span class="optionhead">Strana</span>
		<p>Zapi¹te stránku, na které se ve vybraném pramenu nachází tato událost (volitelné).</p>
		
		<span class="optionhead">Vìrohodnost</span>
		<p>Vyberte èíslo (0-3), které oznaèuje, na kolik je tento pramen vìrohodný (volitelné). Vy¹¹í èísla oznaèují vìt¹í vìrohodnost.</p>
		
		<span class="optionhead">Datum citace</span>
		<p>Datum spojené s touto citací (volitelné).</p>
		
		<span class="optionhead">Vlastní text</span>
		<p>Krátký výòatek z materiálu pramenu (volitelné).</p>

		<span class="optionhead">Poznámky</span>
		<p>U¾iteèné poznámky, které se týkají tohoto pramenu (volitelné).</p>

		<span class="optionhead">Události</span>
		<p>Událost (události), ke které bude tato citace pøipojena. Chcete-li vybrat více událostí, pou¾ijte Shift+ nebo Ctrl/cmd+ kliknutí. Pokud je vybráno více událostí, 
    bude pro ka¾dou událost vytvoøena kopie nové citace. Pokud není vybrána ¾ádná událost, bude citace pøipojena k osobì obecnì.</p>

	</td>
</tr>

</table>
</body>
</html>
