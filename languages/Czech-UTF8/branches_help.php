<?php
include("../../helplib.php");
echo help_header("Nápověda: Větve");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="trees_help.php" class="lightlink">&laquo; Nápověda: Stromy</a> &nbsp; | &nbsp;
			<a href="eventtypes_help.php" class="lightlink">Nápověda: Typy událostí / atributů&raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Větve</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co to je?</a> &nbsp; | &nbsp;
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nebo upravit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#label" class="lightlink">Označit</a>
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
    
		<a name="what"><p class="subheadbold">Co je to větev?</p></a>
		<p><strong>Větev</strong> je skupina osob ve společném stromě, které jsou označeny společnou značkou. Tato značka umožňuje programu TNG pomocí uživatelských přístupových práv
		omezit přístup k takto označeným osobám. Jinými slovy, uživatelé, kteří jsou připojeni k určité větvi, budou mít svá přístupová práva omezena
		na osoby a rodiny v této větvi. Osoba v databázi může patřit do různých větví. Uživatelé mohou být připojeni nanejvýš
		k jedné větvi, ale toto omezení lze obejít vytvořením tzv. pseudovětve, jejíž název tvoří textový řetězec, který může být současně obsažen
		v názvu jiných větví. Např. uživatel připojen k větvi "zeman" může mít práva na větve "zemanuvsyn" i "jihlavskyzeman", protože oba názvy
		obsahují slovo "zeman".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="search"><p class="subheadbold">Hledat</p></a>
    <p>Nalezení existujících větví vyhledáním celého nebo části <strong>ID čísla větve</strong> nebo <strong>Popisu</strong>. Pro zúžení vašeho hledání vyberte strom.
		Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech větví ve vaší databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlačítko <strong>Obnovit</strong>, které znovu obnoví všechny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlačítko Akce vedle každého výsledku hledání vám umožní upravit, odstranit nebo přidat označení k této větvi. Chcete-li najednou odstranit více větví, zaškrtněte políčko ve sloupci
		<strong>Vybrat</strong> u každé větve, která má být odstraněna a poté klikněte na tlačítko "Vymazat označené" na začátku seznamu. Pro zaškrtnutí nebo vyčištění všech výběrových políček najednou
    můžete použít tlačítka <strong>Vybrat vše</strong> nebo <strong>Vyčistit vše</strong>.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Přidat novou / Upravit existující větve</p></a>
		<p>Chcete-li přidat novou větev, klikněte na záložku <strong>Přidat nový</strong> a pak vyplňte formulář.
		Význam polí je následující:</p>

		<span class="optionhead">ID číslo větve</span>
		<p>Toto by měl být krátký, jednoznačný, jednoslovný identifikátor větve. Musí obsahovat pouze alfanumerické znaky (číslice a písmena). Nepoužívejte písmena
		s diakritikou a mezery. Tento údaj se nikde nezobrazuje, takže může být zapsán pouze malými písmeny v délce max. 20 znaků.</p>

		<span class="optionhead">Popis:</span>
		<p>Toto může být delší popis větve nebo údajů, které větev obsahuje.</p>
    
    <span class="optionhead">Starting Individual</span>
		<p>Enter or find the ID of the individual with whom your branch begins. All
		partial branches are defined by a starting individual and a number of ancestral or descendant generations from that individual. You can add additional names
		by repeating this process and picking a different "Starting Individual". When you save your branch, only the most recent Starting Individual will be remembered,
		but all labels added previously will not be affected.</p>

    <span class="optionhead">Výchozí osoba</span>
		<p>Zapište nebo vyhledejte ID číslo osoby, kterou vaše větev začíná. Všechny
		dílčí větve jsou definovány výchozí osobou a počtem generací předků nebo potomků počínaje touto osobou. Další jména můžete přidat
		později zopakováním tohoto procesu a volbou jiné "Výchozí osoby". Po uložení větve bude zapamatována pouze poslední výchozí osoba, 
    všechny dříve přidané značky ale nebudou ovlivněny.</p>

		<span class="optionhead">Počet generací</span>
		<p>Zvolte počet generací od výchozí osoby směrem zpět (předkové) nebo dopředu (potomci), které si přejete označit. Při
		označování předků můžete také zvolit, kolik má být označeno generací potomků od každého předka.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazání větve</p></a>
		<p>Chcete-li odstranit větev, použijte záložku <a href="#search">Hledat</a> k nalezení větve, a poté klikněte na ikonku Vymazat vedle záznamu této větve. Tento řádek změní
		barvu a poté po odstranění položky větev zmizí. Chcete-li najednou odstranit více větví, zaškrtněte tlačítko ve sloupci Vybrat vedle každé větve, která má být
		odstraněna, a poté klikněte na tlačítko "Vymazat vybrané" na stránce nahoře.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="label"><p class="subheadbold">Označení větví</p></a>
		<p>Chcete-li značku větve připojit k osobám ve své databázi, klikněte na tlačítko <strong>Přidat značku</strong> ve spodní části stránky Upravit větev,
		a pokračujte podle instrukcí v okně, které se objeví. Po provedení výběru klikněte na tlačítko "Přidat značku" ve spodní části. Možnosti na této stránce jsou následující:</p>

		<span class="optionhead">Akce</span>
		<p>Zvolte, zda chcete přidat nové značky, vyčistit stávající značky nebo vymazat osoby s vybraným označením větve. Pokud chcete vyčistit značky nebo vymazat osoby, 
    pak také zvolte, zda se tato akce bude týkat celého stromu ("Vše") nebo jen záznamů, které odpovídají vybraným kritériím ("Částečné").
    DŮLEŽITÉ: Pokud zvolíte "Vymazat", budou vymazány také osoby, nejen značky větví! Neexistuje žádná možnost akci "Vrátit zpět", takže byste měli před zahájením vytvořit zálohu tabulek.</p>

		<span class="optionhead">Existující značku</span>
		<p>Touto volbou určíte, co dělat, když některá osoba, kterou jste vybrali pro označení,
		již u sebe má zaznamenán příznak jiné větve. Existující značku můžete nechat netknutou, můžete ji přepsat
		nebo se můžete rozhodnout přidat novou značku. Pokud vyberete poslední možnost,
		postižené osoby budou nyní patřit k více větvím.</p>

		<span class="optionhead">Zobrazit osoby s tímto stromem/větví (označení):</span>
		<p>Kliknutím na toto tlačítko zobrazíte všechny osoby, které již mají vybranou větev
		vybraného stromu. V tomto zobrazení se kliknutím na odkaz Značka větve můžete  
		vrátít na předchozí stránku nebo kliknutím na osobu můžete úpravit její osobní záznam.</p>
	</td>
</tr>

</table>
</body>
</html>
