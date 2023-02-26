<?php
include("../../helplib.php");
echo help_header("Nápovìda: Hledá se");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="misc_help.php" class="lightlink">&laquo; Nápovìda: Rùzné</a> &nbsp; | &nbsp;
			<a href="data_help.php" class="lightlink">Nápovìda: Import / Export &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Hledá se</span>
		<p class="smaller menu">
			<a href="#add" class="lightlink">Pøidat nový</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#sort" class="lightlink">Tøídit</a> &nbsp; | &nbsp;
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
		<a name="add"><p class="subheadbold">Pøidání nových zápisù</p></a>
		<p>Funkce <strong>Hledá se</strong> vám umo¾ní vytvoøit seznam kritických osob nebo fotografií, se kterými máte ve svém bádání problémy.
		Tento seznam je rozdìlen do dvou kategorií, <strong>Hledané osoby</strong> a <strong>Tajemné fotografie</strong>. Chcete-li do nìjaké kategorie pøidat nový zápis,
		kliknìte na tlaèítko "Pøidat nový" pod pøíslu¹ným nadpisem a poté vyplòte formuláø. Význam polí je následující:</p>

		<span class="optionhead">Titul</span>
		<p>Va¹emu zápisu dejte titul, který mù¾e být i otázkou. Napø. <em>Kdo je tato osoba?</em> nebo <em>Kdo je otcem Josefa Nováka?</em></p>

		<span class="optionhead">Popis</span>
		<p>Va¹emu zápisu dejte také krátký popis. Mù¾e obsahovat aktuální údaje, které jste shromá¾dili, pøeká¾ky, na které jste narazili
		nebo nìjaké konkrétní informace, které hledáte.</p>

		<span class="optionhead">Strom</span>
		<p>Pokud chcete, mù¾ete spojit tento zápis se stromem (nepovinné).</p>

		<span class="optionhead">Osoba</span>
		<p>Je-li tento zápis úzce spojen s nìjakou osobou, zapi¹te ID èíslo osoby nebo kliknìte na ikonu lupy pro její vyhledání. Po nalezení po¾adované
		osoby kliknìte na odkaz "Vybrat" a vrátíte se do formuláøe Hledá se s vybraným ID èíslem.</p>

		<span class="optionhead">Vybrat fotografii</span>
		<p>Je-li tento zápis úzce spojen s nìjakou fotografií, kliknìte na tlaèítko "Vybrat fotografii" pro vyhledání této fotografie ze záznamù fotografií
		z va¹í databáze. Po nalezení po¾adované fotografie kliknìte na odkaz "Vybrat" a vrátíte se do formuláøe Hledá se s vybraným ID èíslem.</p>

		<p>Po dokonèení kliknìte na tlaèítko "Ulo¾it" a vrátíte se do seznamu. Vá¹ nový zápis bude pøidán na konec kategorie, do které jste ho pøidali.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Úprava existujících zápisù</p></a>
		<p>Chcete-li existující zápis upravit, pøesuòte kursor my¹i nad záznam, který chcete upravit. Pod tímto zápisem by se mìly objevit odkazy "Upravit" a "Vymazat". Kliknutím
		na odkaz "Upravit" se zobrazí formuláø, ve kterém mù¾ete provést své zmìny. Pole ve formuláøi jsou stejná jako jsou popsána vý¹e v odstavci "Pøidání nových zápisù".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="sort"><p class="subheadbold">Tøídìní zápisù</p></a>
		<p>Chcete-li zmìnit poøadí zápisù, které jste vytvoøili v sekci Hledá se, chytnìte je a pøetáhnìte na po¾adované místo (kliknìte na oblast "Táhnout", podr¾te tlaèítko my¹i,
		dokud nepøesunete ukazovátko na po¾adované místo a pak my¹ uvolnìte). </p>

		<p><strong>POZN.:</strong> Zápisy <strong>mù¾ete</strong> pøesunout z jednoho seznamu do druhého (napø. pøesunout zápis z "Hledaných osob" do "Tajemných fotografií").</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání existujících zápisù</p></a>
		<p>Chcete-li existující zápis vymazat, pøesuòte kursor my¹i nad záznam, který chcete vymazat. Pod tímto zápisem by se mìly objevit odkazy "Upravit" a "Vymazat". Kliknutím
		na odkaz  "Vymazat" zápis odstraníte (pøed tím budete po¾ádáni o potvrzení této akce).</p>

	</td>
</tr>

</table>
</body>
</html>
