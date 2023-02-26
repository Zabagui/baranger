<?php
include("../../helplib.php");
echo help_header("Nápovìda: Vìtve");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="trees_help.php" class="lightlink">&laquo; Nápovìda: Stromy</a> &nbsp; | &nbsp;
			<a href="eventtypes_help.php" class="lightlink">Nápovìda: Typy událostí / atributù&raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Vìtve</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co to je?</a> &nbsp; | &nbsp;
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nebo upravit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#label" class="lightlink">Oznaèit</a>
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
    
		<a name="what"><p class="subheadbold">Co je to vìtev?</p></a>
		<p><strong>Vìtev</strong> je skupina osob ve spoleèném stromì, které jsou oznaèeny spoleènou znaèkou. Tato znaèka umo¾òuje programu TNG pomocí u¾ivatelských pøístupových práv
		omezit pøístup k takto oznaèeným osobám. Jinými slovy, u¾ivatelé, kteøí jsou pøipojeni k urèité vìtvi, budou mít svá pøístupová práva omezena
		na osoby a rodiny v této vìtvi. Osoba v databázi mù¾e patøit do rùzných vìtví. U¾ivatelé mohou být pøipojeni nanejvý¹
		k jedné vìtvi, ale toto omezení lze obejít vytvoøením tzv. pseudovìtve, její¾ název tvoøí textový øetìzec, který mù¾e být souèasnì obsa¾en
		v názvu jiných vìtví. Napø. u¾ivatel pøipojen k vìtvi "zeman" mù¾e mít práva na vìtve "zemanuvsyn" i "jihlavskyzeman", proto¾e oba názvy
		obsahují slovo "zeman".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="search"><p class="subheadbold">Hledat</p></a>
    <p>Nalezení existujících vìtví vyhledáním celého nebo èásti <strong>ID èísla vìtve</strong> nebo <strong>Popisu</strong>. Pro zú¾ení va¹eho hledání vyberte strom.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech vìtví ve va¹í databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví v¹echny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlaèítko Akce vedle ka¾dého výsledku hledání vám umo¾ní upravit, odstranit nebo pøidat oznaèení k této vìtvi. Chcete-li najednou odstranit více vìtví, za¹krtnìte políèko ve sloupci
		<strong>Vybrat</strong> u ka¾dé vìtve, která má být odstranìna a poté kliknìte na tlaèítko "Vymazat oznaèené" na zaèátku seznamu. Pro za¹krtnutí nebo vyèi¹tìní v¹ech výbìrových políèek najednou
    mù¾ete pou¾ít tlaèítka <strong>Vybrat v¹e</strong> nebo <strong>Vyèistit v¹e</strong>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Pøidat novou / Upravit existující vìtve</p></a>
		<p>Chcete-li pøidat novou vìtev, kliknìte na zálo¾ku <strong>Pøidat nový</strong> a pak vyplòte formuláø.
		Význam polí je následující:</p>

		<span class="optionhead">ID èíslo vìtve</span>
		<p>Toto by mìl být krátký, jednoznaèný, jednoslovný identifikátor vìtve. Musí obsahovat pouze alfanumerické znaky (èíslice a písmena). Nepou¾ívejte písmena
		s diakritikou a mezery. Tento údaj se nikde nezobrazuje, tak¾e mù¾e být zapsán pouze malými písmeny v délce max. 20 znakù.</p>

		<span class="optionhead">Popis:</span>
		<p>Toto mù¾e být del¹í popis vìtve nebo údajù, které vìtev obsahuje.</p>
    
    <span class="optionhead">Starting Individual</span>
		<p>Enter or find the ID of the individual with whom your branch begins. All
		partial branches are defined by a starting individual and a number of ancestral or descendant generations from that individual. You can add additional names
		by repeating this process and picking a different "Starting Individual". When you save your branch, only the most recent Starting Individual will be remembered,
		but all labels added previously will not be affected.</p>

    <span class="optionhead">Výchozí osoba</span>
		<p>Zapi¹te nebo vyhledejte ID èíslo osoby, kterou va¹e vìtev zaèíná. V¹echny
		dílèí vìtve jsou definovány výchozí osobou a poètem generací pøedkù nebo potomkù poèínaje touto osobou. Dal¹í jména mù¾ete pøidat
		pozdìji zopakováním tohoto procesu a volbou jiné "Výchozí osoby". Po ulo¾ení vìtve bude zapamatována pouze poslední výchozí osoba, 
    v¹echny døíve pøidané znaèky ale nebudou ovlivnìny.</p>

		<span class="optionhead">Poèet generací</span>
		<p>Zvolte poèet generací od výchozí osoby smìrem zpìt (pøedkové) nebo dopøedu (potomci), které si pøejete oznaèit. Pøi
		oznaèování pøedkù mù¾ete také zvolit, kolik má být oznaèeno generací potomkù od ka¾dého pøedka.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání vìtve</p></a>
		<p>Chcete-li odstranit vìtev, pou¾ijte zálo¾ku <a href="#search">Hledat</a> k nalezení vìtve, a poté kliknìte na ikonku Vymazat vedle záznamu této vìtve. Tento øádek zmìní
		barvu a poté po odstranìní polo¾ky vìtev zmizí. Chcete-li najednou odstranit více vìtví, za¹krtnìte tlaèítko ve sloupci Vybrat vedle ka¾dé vìtve, která má být
		odstranìna, a poté kliknìte na tlaèítko "Vymazat vybrané" na stránce nahoøe.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="label"><p class="subheadbold">Oznaèení vìtví</p></a>
		<p>Chcete-li znaèku vìtve pøipojit k osobám ve své databázi, kliknìte na tlaèítko <strong>Pøidat znaèku</strong> ve spodní èásti stránky Upravit vìtev,
		a pokraèujte podle instrukcí v oknì, které se objeví. Po provedení výbìru kliknìte na tlaèítko "Pøidat znaèku" ve spodní èásti. Mo¾nosti na této stránce jsou následující:</p>

		<span class="optionhead">Akce</span>
		<p>Zvolte, zda chcete pøidat nové znaèky, vyèistit stávající znaèky nebo vymazat osoby s vybraným oznaèením vìtve. Pokud chcete vyèistit znaèky nebo vymazat osoby, 
    pak také zvolte, zda se tato akce bude týkat celého stromu ("V¹e") nebo jen záznamù, které odpovídají vybraným kritériím ("Èásteèné").
    DÙLE®ITÉ: Pokud zvolíte "Vymazat", budou vymazány také osoby, nejen znaèky vìtví! Neexistuje ¾ádná mo¾nost akci "Vrátit zpìt", tak¾e byste mìli pøed zahájením vytvoøit zálohu tabulek.</p>

		<span class="optionhead">Existující znaèku</span>
		<p>Touto volbou urèíte, co dìlat, kdy¾ nìkterá osoba, kterou jste vybrali pro oznaèení,
		ji¾ u sebe má zaznamenán pøíznak jiné vìtve. Existující znaèku mù¾ete nechat netknutou, mù¾ete ji pøepsat
		nebo se mù¾ete rozhodnout pøidat novou znaèku. Pokud vyberete poslední mo¾nost,
		posti¾ené osoby budou nyní patøit k více vìtvím.</p>

		<span class="optionhead">Zobrazit osoby s tímto stromem/vìtví (oznaèení):</span>
		<p>Kliknutím na toto tlaèítko zobrazíte v¹echny osoby, které ji¾ mají vybranou vìtev
		vybraného stromu. V tomto zobrazení se kliknutím na odkaz Znaèka vìtve mù¾ete  
		vrátít na pøedchozí stránku nebo kliknutím na osobu mù¾ete úpravit její osobní záznam.</p>
	</td>
</tr>

</table>
</body>
</html>
