<?php
include("../../helplib.php");
echo help_header("Nápověda: Hledá se");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="misc_help.php" class="lightlink">&laquo; Nápověda: Různé</a> &nbsp; | &nbsp;
			<a href="data_help.php" class="lightlink">Nápověda: Import / Export &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Hledá se</span>
		<p class="smaller menu">
			<a href="#add" class="lightlink">Přidat nový</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#sort" class="lightlink">Třídit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a>
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

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Přidání nových zápisů</p></a>
		<p>Funkce <strong>Hledá se</strong> vám umožní vytvořit seznam kritických osob nebo fotografií, se kterými máte ve svém bádání problémy.
		Tento seznam je rozdělen do dvou kategorií, <strong>Hledané osoby</strong> a <strong>Tajemné fotografie</strong>. Chcete-li do nějaké kategorie přidat nový zápis,
		klikněte na tlačítko "Přidat nový" pod příslušným nadpisem a poté vyplňte formulář. Význam polí je následující:</p>

		<span class="optionhead">Titul</span>
		<p>Vašemu zápisu dejte titul, který může být i otázkou. Např. <em>Kdo je tato osoba?</em> nebo <em>Kdo je otcem Josefa Nováka?</em></p>

		<span class="optionhead">Popis</span>
		<p>Vašemu zápisu dejte také krátký popis. Může obsahovat aktuální údaje, které jste shromáždili, překážky, na které jste narazili
		nebo nějaké konkrétní informace, které hledáte.</p>

		<span class="optionhead">Strom</span>
		<p>Pokud chcete, můžete spojit tento zápis se stromem (nepovinné).</p>

		<span class="optionhead">Osoba</span>
		<p>Je-li tento zápis úzce spojen s nějakou osobou, zapište ID číslo osoby nebo klikněte na ikonu lupy pro její vyhledání. Po nalezení požadované
		osoby klikněte na odkaz "Vybrat" a vrátíte se do formuláře Hledá se s vybraným ID číslem.</p>

		<span class="optionhead">Vybrat fotografii</span>
		<p>Je-li tento zápis úzce spojen s nějakou fotografií, klikněte na tlačítko "Vybrat fotografii" pro vyhledání této fotografie ze záznamů fotografií
		z vaší databáze. Po nalezení požadované fotografie klikněte na odkaz "Vybrat" a vrátíte se do formuláře Hledá se s vybraným ID číslem.</p>

		<p>Po dokončení klikněte na tlačítko "Uložit" a vrátíte se do seznamu. Váš nový zápis bude přidán na konec kategorie, do které jste ho přidali.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Úprava existujících zápisů</p></a>
		<p>Chcete-li existující zápis upravit, přesuňte kursor myši nad záznam, který chcete upravit. Pod tímto zápisem by se měly objevit odkazy "Upravit" a "Vymazat". Kliknutím
		na odkaz "Upravit" se zobrazí formulář, ve kterém můžete provést své změny. Pole ve formuláři jsou stejná jako jsou popsána výše v odstavci "Přidání nových zápisů".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="sort"><p class="subheadbold">Třídění zápisů</p></a>
		<p>Chcete-li změnit pořadí zápisů, které jste vytvořili v sekci Hledá se, chytněte je a přetáhněte na požadované místo (klikněte na oblast "Táhnout", podržte tlačítko myši,
		dokud nepřesunete ukazovátko na požadované místo a pak myš uvolněte). </p>

		<p><strong>POZN.:</strong> Zápisy <strong>můžete</strong> přesunout z jednoho seznamu do druhého (např. přesunout zápis z "Hledaných osob" do "Tajemných fotografií").</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání existujících zápisů</p></a>
		<p>Chcete-li existující zápis vymazat, přesuňte kursor myši nad záznam, který chcete vymazat. Pod tímto zápisem by se měly objevit odkazy "Upravit" a "Vymazat". Kliknutím
		na odkaz  "Vymazat" zápis odstraníte (před tím budete požádáni o potvrzení této akce).</p>

	</td>
</tr>

</table>
</body>
</html>
