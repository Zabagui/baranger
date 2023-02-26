<?php
include("../../helplib.php");
echo help_header("Nápovìda: Alba");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="collections_help.php" class="lightlink">&laquo; Nápovìda: Kolekce</a> &nbsp; | &nbsp;
			<a href="cemeteries_help.php" class="lightlink">Nápovìda: Høbitovy &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Alba</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nové</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#sort" class="lightlink">Tøídit</a>
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
        <p>Existující média vyhledáte zadáním úplného výrazu nebo èásti <strong>Názvu alba, Popisu</strong> nebo
		<strong>Klíèových slov</strong>. Pokud do vyhledávacích polí nezadáte ¾ádná výbìrová kritéria, budou nalezena v¹echna alba, která se nacházejí ve va¹í databázi.</p>

		<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví v¹echny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlaèítko Akce vedle ka¾dého alba vám umo¾ní upravit, vymazat nebo zobrazit náhled tohoto alba.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Pøidání nových alb</p></a>
		<p><strong>Album</strong> v TNG je skupina médií. Album mù¾e obsahovat jakýkoli poèet médií a konkrétní médium mù¾e být souèástí více alb.
		Podobnì jako jednotlivé médium mù¾e být album pøipojeno k osobì, rodinì, pramenu, úlo¾i¹ti pramenù nebo místu.</p>

		<p>Chcete-li pøidat nové album, kliknìte na zálo¾ku <strong>Pøidat nové</strong> a poté vyplòte formuláø. Dal¹í informace jako média, která má album obsahovat, a 
		odkazy na osobu, rodinu a jiné entity, mù¾ete pøidat po ulo¾ení záznamu. Význam jednotlivých polí je následující:</p>

		<p><span class="optionhead">Název alba</span><br />
		Název va¹eho alba.</p>

		<p><span class="optionhead">Popis</span><br />
		Krátký popis alba nebo polo¾ek, které obsahuje.</p>

		<p><span class="optionhead">Klíèová slova</span><br />
		Jakýkoli poèet klíèových slov mimo název alba a popis, která mají být pou¾ita pøi vyhledávání tohoto alba.</p>

		<p><span class="optionhead">Aktivní</span><br />
		Je-li album oznaèeno jako "Aktivní", bude zobrazeno na va¹ich stránkách ve veøejném seznamu. Je-li pøíznak Aktivní nastaven na "Ne", náv¹tìvníci va¹ich stránek
		toto album vidìt nebudou.</p>

		<p><span class="optionhead">V¾dy viditelné</span><br />
		Je-li aktivní album oznaèeno jako "V¾dy viditelné" a je pøipojeno k osobì, rodinì, pramenu nebo úlo¾i¹ti pramenù, bude na stránkách u tìchto entit v¾dy viditelné, i kdy¾ je 
		pøipojeno k ¾ijící osobì nebo rodinì. Jinak jsou aktivní alba nebo média, která jsou pøipojená k ¾ijícím osobám, skryta pro náv¹tìvníky, kteøí nemají oprávnìní prohlí¾et data ¾ijících osob.
		</p>

		<p><span class="optionhead">Pole, která musí být vyplnìna:</span> Název alba je jediné pole, které je nutné vyplnit, ale je ve va¹em zájmu vyplnit i ostatní pole.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="edit"><p class="subheadbold">Úprava existujícího alba</p></a>
		<p>Chcete-li upravit existující album, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro vyhledání alba a poté kliknìte na ikonu Upravit vedle tohoto alba.
		Význam následujících polí, která nejsou na stránce "Pøidat nové album":</p>

		<span class="optionhead">Média v albu</span>
		<p>Chcete-li do alba pøidat média, kliknìte na tlaèítko "Pøidat médium", a poté pou¾ijte formuláø v zobrazeném oknì pro výbìr médií z polo¾ek, které obsahuje 
		va¹e databáze. Mù¾ete pou¾ít Kolekce a/nebo Strom (obì volby jsou nepovinné), poté do pole "Najít" zapi¹te èást názvu alba nebo popisu  
    a kliknìte na tlaèítko "Hledat". Kdy¾ najdete polo¾ku, kterou byste chtìli pøidat do alba, kliknìte na odkaz "Pøidat" vlevo na øádku polo¾ky. Tato
		polo¾ka bude do alba pøidána a okno zùstane zobrazené. Tento postup opakujte pro dal¹í média, která chcete pøidat, nebo kliknìte na odkaz "Zavøít okno" pro návrat na stránku Úprava alba.</p>

		<p>Chcete-li z alba odstranit médium, pøesuòte kursor my¹i nad tuto polo¾ku. Zobrazí se odkaz "Odstranit". Pro odstranìní polo¾ky kliknìte na tento odkaz. Po
		potvrzení bude polo¾ka zatemnìna.</p>

		<p>Pro výbìr náhledu, který má být pro toto album <strong>Výchozí fotografií</strong>, pøesuòte kursor my¹i nad tuto polo¾ku. Zobrazí se odkaz "Nastavit jako výchozí".
		Kliknutím na tento odkaz urèíte tento náhled jako výchozí fotografii tohoto alba. Chcete-li vybrat jinou výchozí fotografii, opakujte tento postup s jinou 
		polo¾kou ze seznamu. Chcete-li odstranit výchozí fotografii, kliknìte na odkaz "Odstranit výchozí fotografii" v horní èásti této stránky.</p>

		<p>Chcete-li v albu pøeøadit média, kliknìte na oblast "Táhnout" u urèité polo¾ky a pøi stisknutém tlaèítku my¹i pøetáhnìte polo¾ku na po¾adované místo
		v oblasti seznamu. Je-li polo¾ka na po¾adovaném místì, uvolnìte tlaèítko my¹i ("uchopit a táhnout"). V tomto okam¾iku jsou zmìny automaticky ulo¾eny.</p>

 		<p>Dal¹í mo¾ností jak pøetøídit polo¾ky je zápis po sobì jdoucích èísel do malého políèka vedle oblasti "Táhnout", a poté kliknout na odkaz "Jdi" pod oknem a stisknìte Enter.
		To mù¾e být vhodné pro pøesun polo¾ek, je-li seznam pøíli¹ dlouhý a v¹echny polo¾ky se nevejdou najednou na stránku.</p>

		<p>Kliknutím na ikonu dvojité ¹ipky napravo od oblasti "Táhnout" mù¾ete polo¾ku pøesunout pøímo na èelní místo seznamu.</p>

		<span class="optionhead">Odkazy na album</span>
		<p>Toto album mù¾ete pøipojit k osobì, rodinì, pramenu, úlo¾i¹ti pramenù nebo místu. Pro ka¾dé pøipojení nejprve vyberte strom spojený s entitou, kterou chci pøipojit.
		Dále vyberte typ propojení (osoba, rodina, pramen, úlo¾i¹tì pramenù nebo míst), a na závìr zapi¹te èíslo ID nebo název (pouze u míst) entity, kterou chcete pøipojit. Po
		vlo¾ení v¹ech údajù kliknìte na tlaèítko "Pøidat".</p>

		<p>Pokud neznáte ID èíslo nebo pøesný název místa, kliknìte na ikonu lupy pro vyhledání tìchto údajù. Zobrazí se okno, ve kterém mù¾ete vyhledávat.
		Po nalezení popisu po¾adované entity kliknìte na odkaz "Pøidat" vlevo. Kliknout na "Pøidat" mù¾ete u více entit. Po dokonèení tvorby propojení
		kliknìte na odkaz "Zavøít okno".</p>

		<p>POZNÁMKA: V¹echny zmìny, které se medií v albech a odkazù na alba, jsou ulo¾eny okam¾itì a není nutné kliknout na tlaèítko "Ulo¾it" na spodním okraji obrazovky.
		Pro ulo¾ení zmìn v sekci "Informace o albu" je nutné kliknout na "Ulo¾it".</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat alba</p></a>
		<p>Chcete-li album odstranit, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení alba, a poté kliknìte na ikonu Vymazat vedle tohoto alba. Tento øádek zmìní
		barvu a poté po odstranìní polo¾ky zmizí.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="sort"><p class="subheadbold">Tøídìní alb</p></a>
		<p>Standardnì jsou alba, která jsou propojena s osobou, rodinou, pramenem, úlo¾i¹tìm pramenù nebo místem, seøazena v poøadí, ve kterém byla k této entitì pøipojena. Chcete-li
		toto poøadí zmìnit, nové poøadí nastavíte na zálo¾ce Album/Tøídit.</p>

		<span class="optionhead">Strom, Typ odkazu, Kolekce:</span>
		<p>Vyberte strom spojený s entitou, u které chcete tøídit alba. Poté vyberte typ odkazu (osoba, rodina, pramen, úlo¾i¹tì pramenù nebo místo) a
		kolekci, kterou chcete tøídit.</p>

		<span class="optionhead">ID:</span>
		<p>Zapi¹te èíslo ID nebo název (pouze u místa) entity. Pokud neznáte ID èíslo nebo pøesný název místa, kliknìte na ikonu lupy pro vyhledání tìchto údajù.
		Po nalezení po¾adované entity kliknìte na odkaz "Vybrat" vedle této entity. Zobrazené okno se uzavøe a vybrané ID èíslo se objeví v poli ID èíslo.</p>

		<span class="optionhead">Procedura øazení</span>
		<p>Po výbìru nebo zapsání ID èísla kliknìte na tlaèítko "Pokraèovat" pro zobrazení v¹ech alb pro vybranou entitu a kolekci v jejich aktuálním poøadí.
		Chcete-li v alba pøeøadit, kliknìte na oblast "Táhnout" u urèité polo¾ky a pøi stisknutém tlaèítku my¹i pøetáhnìte polo¾ku na po¾adované místo
		v oblasti seznamu. Je-li polo¾ka na po¾adovaném místì, uvolnìte tlaèítko my¹i ("uchopit a táhnout"). V tomto okam¾iku jsou zmìny automaticky ulo¾eny.</p>

    <p>Dal¹í mo¾ností jak pøetøídit polo¾ky je zápis po sobì jdoucích èísel do malého políèka vedle oblasti "Táhnout", a poté kliknout na odkaz "Jdi" pod oknem a stisknìte Enter.
		To mù¾e být vhodné pro pøesun polo¾ek, je-li seznam pøíli¹ dlouhý a v¹echny polo¾ky se nevejdou najednou na stránku.</p>

		<p>Kliknutím na ikonu dvojité ¹ipky napravo od oblasti "Táhnout" mù¾ete polo¾ku pøesunout pøímo na èelní místo seznamu.</p>

	</td>
</tr>

</table>
</body>
</html>
