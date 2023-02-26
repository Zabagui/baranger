<?php
include("../../helplib.php");
echo help_header("Nápovìda: Stromy");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="users_help.php" class="lightlink">&laquo; Nápovìda: U¾ivatelé</a> &nbsp; | &nbsp;
			<a href="branches_help.php" class="lightlink">Nápovìda: Vìtve &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Stromy</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nebo upravit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#clear" class="lightlink">Vyèistit</a>
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
    <p>Nalezení existujících stromù vyhledáním celého nebo èásti <strong>ID èísla stromu, názvu stromu, popisu</strong> nebo <strong>vlastníka</strong>.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech stromù ve va¹í databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví v¹echny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlaèítko Akce vedle ka¾dého výsledku hledání vám umo¾ní upravit, odstranit nebo pøidat oznaèení k tomuto stromu.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Pøidat nový / Upravit existující stromy</p></a>
		<p><strong>Strom</strong> v TNG je zásobník samostatného souboru rodinných údajù. TNG umo¾òuje na va¹ich stránkách podporu více stromù, ale proto¾e
		jsou stromy samostatné, nelze propojit osobu z jednoho stromu s osobou nebo rodinou z jiného stromu. Z tohoto dùvodu by mìly být osoby, které jsou nebo by mìly být navzájem spojeny,
		udr¾ovány ve stejném stromì.</p>

		<p><strong>POZN.: Strom musíte pøidat pøed tím, ne¾ budete zadávat nebo importovat data</strong> osob, rodin, pramenù nebo úlo¾i¹tì pramenù. Pokud jste aktualizovali z ni¾¹í verze,
		nepodporovala stromy, budou va¹e data spojena s výchozím stromem, který má prázdné ID èíslo stromu. Dal¹í údaje tohoto stromu mù¾ete upravit,
		ale ID èíslo stromu zùstane prázdné (program s tímto doká¾e pracovat).</p>

		<p>Chcete-li pøidat nový strom, kliknìte na zálo¾ku <strong>Pøidat nový</strong> a pak vyplòte formuláø.
		Význam polí je následující:</p>

		<span class="optionhead">ID èíslo stromu</span>
		<p>Toto by mìl být krátký, jednoznaèný, jednoslovný identifikátor stromu. Musí obsahovat pouze alfanumerické znaky (èíslice a písmena). Nepou¾ívejte písmena
		s diakritikou a mezery. Tento údaj se nikde nezobrazuje, s výjimkou øádku adresy ve va¹em prohlí¾eèi, tak¾e mù¾e být zapsán pouze malými písmeny. Pozdìji tento údaj nelze zmìnit.
    Délka max. 20 znakù.</p>

		<span class="optionhead">Název stromu:</span>
		<p>Krátký název nebo fráze, která se bude zobrazovat a identifikovat strom. Objeví se na v¹ech místech výbìru stromu a podle tohoto názvu budou u¾ivatelé strom znát.</p>

		<span class="optionhead">Popis:</span>
		<p>Del¹í popis tohoto stromu nebo dat, která obsahuje.</p>

		<span class="optionhead">Majitel:</span>
		<p>Osoba nebo organizace, která vytvoøila nebo shromá¾dila údaje v tomto stromì, nebo osoba èi organizace odpovìdná za správu tìchto údajù.</p>

		<span class="optionhead">Email:</span>
		<p>Emailová adresa majitele. Návrhy týkající se osob v tomto stromu budou posílány na tuto adresu, pokud existuje (jinak budou návrhy
		posílány na adresu uvedenou v Základním nastavení).</p>

		<span class="optionhead">Adresa/mìsto/kraj/PSÈ/zemì/telefon:</span>
		<p>Kontaktní údaje majitele.</p>

		<span class="optionhead">Informace o majiteli zachovat neveøejné</span>
		<p>Za¹krtnutím tohoto políèka skryjete emailovou adresu a jiné kontaktní údaje majitele tohoto stromu (pro náv¹tìvníky ve veøejné oblasti).</p>

		<span class="optionhead">Nepovolit u¾ivatelùm stáhnutí souborù GEDCOM</span>
		<p>Za¹krtnutím tohoto políèka zabráníte u¾ivatelùm stáhnout z tohoto stromu soubory GEDCOM.</p>

		<span class="optionhead">Nepovolit u¾ivatelùm tvorbu souborù PDF</span>
		<p>Za¹krtnutím tohoto políèka zabráníte u¾ivatelùm vytvoøit z tohoto stromu soubory PDF.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání stromù</p></a>
    <p>Chcete-li odstranit strom, pou¾ijte zálo¾ku <a href="#search">Hledat</a> k nalezení stromu, a poté kliknìte na ikonku Vymazat vedle záznamu tohoto stromu. Tento øádek zmìní
		barvu a poté po odstranìní polo¾ky strom zmizí. <em>V¹echna data spojená s tímto stromem (vèetnì osob, rodin,
    pramenù, úlo¾i¹» pramenù, médií a vìtví) budou také odstranìna</em>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="clear"><p class="subheadbold">Vyèi¹tìní stromù</p>
		Chcete-li strom "vyèistit" (vymazat v¹echny údaje, ale strom samotný ponechat), pou¾ijte zálo¾ku <a href="#search">Hledat</a> k nalezení stromu, a poté kliknìte na ikonku Vyèistit vedle záznamu tohoto stromu.
		<em>V¹echny údaje spojené s tímto stromem (vèetnì osob, rodin, pramenù, úlo¾i¹» pramenù, médií a vìtví) budou odstranìny</em>.</p>

	</td>
</tr>

</table>
</body>
</html>
