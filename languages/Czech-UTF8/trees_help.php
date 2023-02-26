<?php
include("../../helplib.php");
echo help_header("Nápověda: Stromy");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="users_help.php" class="lightlink">&laquo; Nápověda: Uživatelé</a> &nbsp; | &nbsp;
			<a href="branches_help.php" class="lightlink">Nápověda: Větve &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Stromy</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nebo upravit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#clear" class="lightlink">Vyčistit</a>
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

		<a name="search"><p class="subheadbold">Hledat</p></a>
    <p>Nalezení existujících stromů vyhledáním celého nebo části <strong>ID čísla stromu, názvu stromu, popisu</strong> nebo <strong>vlastníka</strong>.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech stromů ve vaší databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlačítko <strong>Obnovit</strong>, které znovu obnoví všechny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlačítko Akce vedle každého výsledku hledání vám umožní upravit, odstranit nebo přidat označení k tomuto stromu.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Přidat nový / Upravit existující stromy</p></a>
		<p><strong>Strom</strong> v TNG je zásobník samostatného souboru rodinných údajů. TNG umožňuje na vašich stránkách podporu více stromů, ale protože
		jsou stromy samostatné, nelze propojit osobu z jednoho stromu s osobou nebo rodinou z jiného stromu. Z tohoto důvodu by měly být osoby, které jsou nebo by měly být navzájem spojeny,
		udržovány ve stejném stromě.</p>

		<p><strong>POZN.: Strom musíte přidat před tím, než budete zadávat nebo importovat data</strong> osob, rodin, pramenů nebo úložiště pramenů. Pokud jste aktualizovali z nižší verze,
		nepodporovala stromy, budou vaše data spojena s výchozím stromem, který má prázdné ID číslo stromu. Další údaje tohoto stromu můžete upravit,
		ale ID číslo stromu zůstane prázdné (program s tímto dokáže pracovat).</p>

		<p>Chcete-li přidat nový strom, klikněte na záložku <strong>Přidat nový</strong> a pak vyplňte formulář.
		Význam polí je následující:</p>

		<span class="optionhead">ID číslo stromu</span>
		<p>Toto by měl být krátký, jednoznačný, jednoslovný identifikátor stromu. Musí obsahovat pouze alfanumerické znaky (číslice a písmena). Nepoužívejte písmena
		s diakritikou a mezery. Tento údaj se nikde nezobrazuje, s výjimkou řádku adresy ve vašem prohlížeči, takže může být zapsán pouze malými písmeny. Později tento údaj nelze změnit.
    Délka max. 20 znaků.</p>

		<span class="optionhead">Název stromu:</span>
		<p>Krátký název nebo fráze, která se bude zobrazovat a identifikovat strom. Objeví se na všech místech výběru stromu a podle tohoto názvu budou uživatelé strom znát.</p>

		<span class="optionhead">Popis:</span>
		<p>Delší popis tohoto stromu nebo dat, která obsahuje.</p>

		<span class="optionhead">Majitel:</span>
		<p>Osoba nebo organizace, která vytvořila nebo shromáždila údaje v tomto stromě, nebo osoba či organizace odpovědná za správu těchto údajů.</p>

		<span class="optionhead">Email:</span>
		<p>Emailová adresa majitele. Návrhy týkající se osob v tomto stromu budou posílány na tuto adresu, pokud existuje (jinak budou návrhy
		posílány na adresu uvedenou v Základním nastavení).</p>

		<span class="optionhead">Adresa/město/kraj/PSČ/země/telefon:</span>
		<p>Kontaktní údaje majitele.</p>

		<span class="optionhead">Informace o majiteli zachovat neveřejné</span>
		<p>Zaškrtnutím tohoto políčka skryjete emailovou adresu a jiné kontaktní údaje majitele tohoto stromu (pro návštěvníky ve veřejné oblasti).</p>

		<span class="optionhead">Nepovolit uživatelům stáhnutí souborů GEDCOM</span>
		<p>Zaškrtnutím tohoto políčka zabráníte uživatelům stáhnout z tohoto stromu soubory GEDCOM.</p>

		<span class="optionhead">Nepovolit uživatelům tvorbu souborů PDF</span>
		<p>Zaškrtnutím tohoto políčka zabráníte uživatelům vytvořit z tohoto stromu soubory PDF.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání stromů</p></a>
    <p>Chcete-li odstranit strom, použijte záložku <a href="#search">Hledat</a> k nalezení stromu, a poté klikněte na ikonku Vymazat vedle záznamu tohoto stromu. Tento řádek změní
		barvu a poté po odstranění položky strom zmizí. <em>Všechna data spojená s tímto stromem (včetně osob, rodin,
    pramenů, úložišť pramenů, médií a větví) budou také odstraněna</em>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="clear"><p class="subheadbold">Vyčištění stromů</p>
		Chcete-li strom "vyčistit" (vymazat všechny údaje, ale strom samotný ponechat), použijte záložku <a href="#search">Hledat</a> k nalezení stromu, a poté klikněte na ikonku Vyčistit vedle záznamu tohoto stromu.
		<em>Všechny údaje spojené s tímto stromem (včetně osob, rodin, pramenů, úložišť pramenů, médií a větví) budou odstraněny</em>.</p>

	</td>
</tr>

</table>
</body>
</html>
