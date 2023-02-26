<?php
include("../../helplib.php");
echo help_header("Nápověda: Poznámky");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="assoc_help.php" class="lightlink">&laquo; Nápověda: Spojení</a> &nbsp; | &nbsp;
			<a href="citations_help.php" class="lightlink">Nápověda: Citace &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Poznámky</span>
		<p class="smaller menu">
			<a href="#add" class="lightlink">Přidat/Upravit/Vymazat</a> &nbsp; | &nbsp;
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

		<a name="add"><p class="subheadbold">Přidat/Upravit/Vymazat poznámky</p></a>

		<p>Chcete-li přidat, upravit nebo vymazat poznámky u osoby, rodiny, pramene, úložiště pramenů nebo události, klikněte na ikonu Poznámky na stránce nahoře nebo vedle nějaké události (pokud již poznámky existují,
		na ikoně je zelená tečka). Po kliknutí na ikonu se objeví okno, ve kterém jsou zobrazeny
		všechny poznámky existující pro aktivní subjekt nebo událost.</p>

		<p>Chcete-li přidat novou poznámku, klikněte na tlačítko "Přidat nové" a vyplňte formulář. Pokud vybraný subjekt nebo událost ještě neměly žádné
		poznámky, dostanete se přímo na obrazovku "Přidat novou poznámku".</p>

		<p>Pokud chcete existující poznámku upravit nebo vymazat, klikněte na příslušnou ikonu vedle této poznámky.</p>

		<p>Přidáváte-li nebo upravujete-li poznámku, zapisujte, prosím, vaši poznámku nebo vaše změny do velkého pole <strong>Poznámka</strong> a pak klikněte na tlačítko "Uložit". Poznámky budou uloženy v tomto okamžiku, i když třeba ještě
		u aktivního subjektu nejsou žádné jiné údaje. Do pole můžete zapsat HTML kód. Kódy PHP a Javascript nebudou pracovat.</p>

		<p>Chcete-li poznámky přetřídit, klikněte kamkoli na řádek (ne na ikonu) a přetáhněte poznámku nahoru nebo dolů.</p>

		<span class="optionhead">Neveřejné</span>
		<p>Zaškrtnutím tohoto políčka zamezíte zobrazení poznámky ve veřejné oblasti. Nezávisí to na označení Neveřejné, které může být spojeno s osobou
		nebo rodinou.</p>


	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="cite"><p class="subheadbold">Přidání citací pramenů k poznámkám</p></a>
		<p>Chcete-li přidat nebo upravit citaci pramenů u poznámky, poznámku nejprve uložte a poté klikněte na ikonu Citace vedle záznamu této poznámky v aktuálním seznamu poznámek.
		Více informací o citacích se dozvíte zde: <a href="citations_help.php">Nápověda: Citace</a>.</p>

	</td>
</tr>

</table>
</body>
</html>
