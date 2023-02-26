<?php
include("../../helplib.php");
echo help_header("Nápovìda: Poznámky");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="assoc_help.php" class="lightlink">&laquo; Nápovìda: Spojení</a> &nbsp; | &nbsp;
			<a href="citations_help.php" class="lightlink">Nápovìda: Citace &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Poznámky</span>
		<p class="smaller menu">
			<a href="#add" class="lightlink">Pøidat/Upravit/Vymazat</a> &nbsp; | &nbsp;
			<a href="#cite" class="lightlink">Citace</a>
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

		<a name="add"><p class="subheadbold">Pøidat/Upravit/Vymazat poznámky</p></a>

		<p>Chcete-li pøidat, upravit nebo vymazat poznámky u osoby, rodiny, pramene, úlo¾i¹tì pramenù nebo události, kliknìte na ikonu Poznámky na stránce nahoøe nebo vedle nìjaké události (pokud ji¾ poznámky existují,
		na ikonì je zelená teèka). Po kliknutí na ikonu se objeví okno, ve kterém jsou zobrazeny
		v¹echny poznámky existující pro aktivní subjekt nebo událost.</p>

		<p>Chcete-li pøidat novou poznámku, kliknìte na tlaèítko "Pøidat nové" a vyplòte formuláø. Pokud vybraný subjekt nebo událost je¹tì nemìly ¾ádné
		poznámky, dostanete se pøímo na obrazovku "Pøidat novou poznámku".</p>

		<p>Pokud chcete existující poznámku upravit nebo vymazat, kliknìte na pøíslu¹nou ikonu vedle této poznámky.</p>

		<p>Pøidáváte-li nebo upravujete-li poznámku, zapisujte, prosím, va¹i poznámku nebo va¹e zmìny do velkého pole <strong>Poznámka</strong> a pak kliknìte na tlaèítko "Ulo¾it". Poznámky budou ulo¾eny v tomto okam¾iku, i kdy¾ tøeba je¹tì
		u aktivního subjektu nejsou ¾ádné jiné údaje. Do pole mù¾ete zapsat HTML kód. Kódy PHP a Javascript nebudou pracovat.</p>

		<p>Chcete-li poznámky pøetøídit, kliknìte kamkoli na øádek (ne na ikonu) a pøetáhnìte poznámku nahoru nebo dolù.</p>

		<span class="optionhead">Neveøejné</span>
		<p>Za¹krtnutím tohoto políèka zamezíte zobrazení poznámky ve veøejné oblasti. Nezávisí to na oznaèení Neveøejné, které mù¾e být spojeno s osobou
		nebo rodinou.</p>


	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="cite"><p class="subheadbold">Pøidání citací pramenù k poznámkám</p></a>
		<p>Chcete-li pøidat nebo upravit citaci pramenù u poznámky, poznámku nejprve ulo¾te a poté kliknìte na ikonu Citace vedle záznamu této poznámky v aktuálním seznamu poznámek.
		Více informací o citacích se dozvíte zde: <a href="citations_help.php">Nápovìda: Citace</a>.</p>

	</td>
</tr>

</table>
</body>
</html>
