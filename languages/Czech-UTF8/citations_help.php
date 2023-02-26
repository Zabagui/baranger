<?php
include("../../helplib.php");
echo help_header("Nápověda: Citace");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="notes_help.php" class="lightlink">&laquo; Nápověda: Poznámky</a> &nbsp; | &nbsp;
			<a href="events_help.php" class="lightlink">Nápověda: Události &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Citace</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co je to?</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat/Upravit/Vymazat</a>
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

		<p><strong>Citace</strong> je odkaz na záznam pramenu, provedená s úmyslem prokázat pravdivost nějakého údaje. Pramen obvykle
    všeobecně popisuje, kde byl uvedený údaj nalezen (např. matrika nebo sčítací arch), zatímco citace obvykle obsahuje konkrétní informaci (např. na které stránce).
		Jeden záznam pramenu může být citován vícekrát u různých osob, rodin, poznámek nebo událostí.</p>


	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Přidat/Upravit/Vymazat citace</p></a>

		<p>Chcete-li přidat, upravit nebo vymazat citace, klikněte na ikonu Citace na stránce nahoře nebo vedle nějaké poznámky nebo události (pokud již citace existuje,
		na ikoně je zelená tečka). Po kliknutí na ikonu se objeví okno, ve kterém jsou zobrazeny
		všechny citace existující pro aktivní subjekt nebo událost.</p>

		<p>Chcete-li přidat novou citaci, klikněte na tlačítko "Přidat nové" a vyplňte formulář. Pokud vybraný subjekt nebo událost ještě neměly žádné
		citace, dostanete se přímo na obrazovku "Přidat novou citaci".</p>

		<p>Pokud chcete existující citaci upravit nebo vymazat, klikněte na příslušnou ikonu vedle této citace.</p>

    <p>Při přidání nebo úpravě citace si všimněte následujícího:</p>

		<span class="optionhead">ID číslo pramenu</span>
		<p>Zapište ID číslo pramenu, který má být citován, nebo klikněte na tlačítko "Najít" pro jeho nalezení. Pokud pramen ještě nebyl vytvořen,
		přejděte do Admin/Prameny a vytvořte pramen v příslušném stromě. Poté se vraťte do seznamu citací nebo můžete kliknout na tlačítko "Vytvořit"
		pro zápis údajů o novém pramenu. Po uložení údajů bude do tohoto pole vloženo nové ID číslo pramenu.</p>
		<p>Pokud jste již během své aktuální relace pro stejný typ subjektu (osoba, rodina, atd.) vytvořili nějakou citaci, uvidíte také tlačítko "Kopírovat poslední". Kliknutí
		na toto tlačítko budou všechna pole vyplněna stejnými údaji, jako jste použili ve své minulé citaci.</p>
		
        <!--<span class="optionhead">Description</span>
		<p>If your desktop genealogy program does not assign ID numbers to your sources, your citation will have a Description instead. You will not see
		the Description field for a new citation.</p>-->

		<span class="optionhead">Strana</span>
		<p>Zapište stránku, na které se ve vybraném pramenu nachází tato událost (volitelné).</p>
		
		<span class="optionhead">Věrohodnost</span>
		<p>Vyberte číslo (0-3), které označuje, na kolik je tento pramen věrohodný (volitelné). Vyšší čísla označují větší věrohodnost.</p>
		
		<span class="optionhead">Datum citace</span>
		<p>Datum spojené s touto citací (volitelné).</p>
		
		<span class="optionhead">Vlastní text</span>
		<p>Krátký výňatek z materiálu pramenu (volitelné).</p>

		<span class="optionhead">Poznámky</span>
		<p>Užitečné poznámky, které se týkají tohoto pramenu (volitelné).</p>

		<span class="optionhead">Události</span>
		<p>Událost (události), ke které bude tato citace připojena. Chcete-li vybrat více událostí, použijte Shift+ nebo Ctrl/cmd+ kliknutí. Pokud je vybráno více událostí, 
    bude pro každou událost vytvořena kopie nové citace. Pokud není vybrána žádná událost, bude citace připojena k osobě obecně.</p>

	</td>
</tr>

</table>
</body>
</html>
