<?php
include("../../helplib.php");
echo help_header("Nápovìda: Místa");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="cemeteries_help.php" class="lightlink">&laquo; Nápovìda: Høbitovy</a> &nbsp; | &nbsp;
			<a href="places_googlemap_help.php" class="lightlink">Nápovìda: Google Maps &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Místa</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Pøidat nebo Upravit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#merge" class="lightlink">Slouèit</a> &nbsp; | &nbsp;
			<a href="#merge" class="lightlink">Geokódovat</a>
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
    <p>Nalezení existujících míst vyhledáním celého nebo èásti <strong>názvu místa</strong>. Pro dal¹í zú¾ení výsledkù va¹eho hledání na místa spojená s urèitým stromem vyberte tento strom.
		Za¹krtnutím "Chybí zemìpisná ¹íøka nebo délka" se zobrazí pouze místa, která je tøeba doplnit tyto údaje. Za¹krtnutím "Vyhledat pouze kódy chrámù CJKSpd" se zobrazí pouze pìtiznakové názvy míst,
    které byly oznaèeny jako chrámy CJKSpd. Za¹krtnutím volby "Pouze pøesná shoda" výsledek va¹eho hledání dále zú¾íte. 
    Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech míst ve va¹í databázi.</p>

    <p>Za¹krtnutím políèka "®ádné pøipojené události" zobrazíte pouze místa, která nejsou spojena s ¾ádnými událostmi.</p>

   	<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví v¹echny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlaèítko Akce vedle ka¾dého výsledku hledání vám umo¾ní upravit, odstranit nebo otestovat tento výsledek. Chcete-li najednou vymazat více záznamù, za¹krtnìte políèko ve sloupci
		<strong>Vybrat</strong> u ka¾dého záznamu, která má být vymazán a poté kliknìte na tlaèítko "Vymazat oznaèené" na zaèátku seznamu. Pro za¹krtnutí nebo vyèi¹tìní v¹ech výbìrových políèek najednou
    mù¾ete pou¾ít tlaèítka <strong>Vybrat v¹e</strong> nebo <strong>Vyèistit v¹e</strong>.</p>
 
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Pøidat nové / Upravit existující místa</p></a>

		<p>TNG automaticky pøidá záznam nového místa poka¾dé, kdy¾ zapí¹ete nové místo v Admin/Osoba, v Admin/Rodiny nebo jako souèást nìjaké vlastní události.
		Pokud na jakékoli z tìchto obrazovek zmìníte existující místo a výsledkem bude nový jednoznaèný název místa, nový záznam místa bude rovnì¾ vytvoøen.</p>

 		<p>Chcete-li pøidat nové místo, kliknìte na zálo¾ku <strong>Pøidat nové</strong> a poté vyplòte formuláø. <p>Chcete-li upravit existující místo, pou¾ijte
    zálo¾ku <a href="#search">Hledat</a> pro nalezení místa, a poté kliknìte na ikonu Upravit vedle tohoto øádku.</p>
    Význam jednotlivých polí pøi pøidání nebo úpravì høbitova je následující:</p>

		<span class="optionhead">Strom</span>
		<p>Pokud jsou místa ve va¹em Základním nastavení programu konfigurována tak, ¾e jsou spojena se stromy, uvidíte zde pole výbìru stromu. V tomto pøípadì vyberte jeden z va¹ich existujících stromù,
		proto¾e ka¾dé místo musí být spojeno se stromem. <strong>Pozn.:</strong> Po vytvoøení místa nelze zmìnit jeho spojení se stromem
		(místo toho vyma¾te místo a znovu jej zalo¾te pod jiným stromem). Pokud nechcete, aby byla místa spojená se stromy, zmìòte nastavení v Admin/Nastavení/Základní nastavení/Rùzné.</p>

		<span class="optionhead">Místo</span>
		<p>Zapi¹te název va¹eho místa nejmen¹í èástí místa poèínaje. V¹echny èásti místa by mìla být oddìlena èárkoou. Napø.
		<em>Klá¹terec, ©umperk, Olomoucký kraj, Èeská republika</em>. Nepou¾ívejte neurèité nebo máloznámé zkratky.</p>

    <span class="optionhead">Zobrazit/skrýt klikací mapu</span>
		<p>Kliknutím na tlaèítko "Zobrazit/skrýt klikací mapu" se zobrazí Google Map. Tato funkce je aktivní, pokud jste obdr¾eli od Google "klíè" a vlo¾ili jej do
		svého nastavení map v TNG (viz <a href="mapconfig_help.php">Nápovìda pro nastavení mapy</a> pro více informací). Opìtovným kliknutím na toto tlaèítko bude mapa skryta. Chcete-li, aby bylo umístìní vyhledáno v Google Maps,
		zapi¹te toto umístìní do pole <strong>Geokódovat umístìní</strong> a kliknìte na tlaèítko "Hledat". Do mapy mù¾ete také klikat a pohybovat s ní, dokud
		nebude "¹pendlík" na po¾adovaném místì. Mù¾ete také pou¾ít ovládací prvek Pøiblí¾ení pro zobrazení více podrobností v okolí po¾adované oblasti. Na stránce
		<a href="places_googlemap_help.php">Nápovìda Google Maps</a> najdete více informací. Informace o výchozím nastavení va¹ich map najdete v <a href="mapconfig_help.php">Nápovìdì: Nastavení map</a>.</p>

    <span class="optionhead">Zemìpisná ¹íøka/délka</span>
		<p>Zapi¹te souøadnice zemìpisné ¹íøky a délky místa nebo pro nastavení hodnot pou¾ijte klikací Google Map (nepovinné, viz vý¹e).</p>

		<span class="optionhead">Pøiblí¾ení</span>
		<p>Zadejte úroveò pøiblí¾ení nebo upravte ovládací prvek pøiblí¾ení v Google Map pro nastavení úrovnì pøiblí¾ení. Tato volba je dostupná pouze, kdy¾ jste obdr¾eli "klíè"
		od Google a zapsali jej do va¹eho nastavení map v TNG.</p>

		<span class="optionhead">Úroveò sídla</span></p>
		<p>Úroveò sídla popisuje úroveò èlenìní sídla zastoupeného názvem místa. Va¹im náv¹tìvníkùm to mù¾e pomoci poznat pøesnost umístìní ¹pendlíku na mapì.
		Napø. chcete-li umístit ¹pendlík do Francie, ale nevíte, kam pøesnì, mìli byste vybrat v této volbì
		"Zemì", aby va¹i náv¹tìvníci vìdìli, umístìní ¹pendlíku ve Francii není pøesné.</p>

		<span class="optionhead">Høbitovy</span>
		<p>Chcete-li spojit høbitov s aktuálním místem, kliknìte zde na tlaèítko <strong>Pøidat nový</strong>.
		V malém oknì, které se objeví, vyberte ze seznamu, který jste vytvoøili v Admin/Høbitovy høbitov,
		a poté kliknìte na tlaèítko Go. Chcete-li vymazat høbitov spojený s aktuálním místem, kliknìte na malou ikonu
		Vymazat vedle tohoto høbitova.</p>
		
   	<p>Je-li høbitov propojen s místem, údaje o høbitovu budou zobrazeny na stránce místa a seznam pohøbù
		spojených s místem bude zobrazen na stránce høbitova.</p>
     
		<span class="optionhead">Poznámky</span>
		<p>Do tohoto pole zapi¹te jakékoli poznámky, které mají vztah k va¹emu místu.</p>

		<span class="optionhead">Provést zmìny názvu místa v existujících událostech</span>
		<p>Toto za¹krtnuté políèko (viditelné pouze pøi úpravì existujícího místa) oznaèuje, ¾e budou pøi ulo¾ení zmìn 
    aktualizovány v¹echny události, kde je toto místo pou¾ito.</p>

    <p><strong>POZN.:</strong> V¹echny následné importy souborù GEDCOM, kde je za¹krtnuta volba "Nahradit v¹echna aktuální data" nepøepí¹e nebo nevyma¾e
		existující údaje o místech, pokud existující záznamy obsahují údaje v polích zemìpisná ¹íøka, délka nebo poznámky nebo jsou pøipojena nìjaká média.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat místa</p></a>
		<p>Chcete-li odstranit místo, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení místa, a poté kliknìte na ikonu Vymazat vedle tohoto záznamu místa. Tento øádek zmìní
		barvu a poté po odstranìní místa zmizí. Chcete-li najednou odstranit více míst, za¹krtnìte políèko ve sloupci Vybrat vedle ka¾dého místa, který
    chcete odstranit, a poté kliknìte na tlaèítko "Vymazat oznaèené" na stránce nahoøe</p>
     
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="merge"><p class="subheadbold">Slouèit místa</p></a>
 		<p>Kliknutím na tuto zálo¾ku lze pøezkoumat a slouèit názvy míst, které jsou lehce odli¹né, ale odkazují na stejné místo.
		Musíte rozhodnout, zda jsou tyto záznamy toto¾né nebo ne.</p>

		<span class="optionhead">Najít kandidáty pro slouèení</span>
		<p>Pokud je ve va¹em Základním nastavení konfigurováno, ¾e místa jsou spojena se stromy, uvidíte zde výbìrové pole Strom. V tomto pøípadì vyberte strom.
		Nelze sluèovat místa z rùzných stromù, tak¾e lze vybrat pouze jeden strom. Poté zadejte výbìrová kritéria,
		která budou spoleèná pro v¹echny potenciální duplicity. Mù¾ete napø. zapsat <em>Horní Staré</em> pro nalezení
		<em>Horní Staré</em> a <em>Horní Staré Mìsto</em>.</p>
		<p>Do prvního pole musíte nìco zapsat, druhé pole je nepovinné. Chcete-li slouèit dvì místa, jejich¾ názvy nejsou moc podobné,
		mù¾ete nìco zapsat i do druhého pole. Napø. pokud chcete slouèit <em>TU</em> a <em>Trutnov</em>, bude nejlep¹í zapsat do prvního pole <em>TU</em>
		a do druhého <em>Trutnov</em>. Po dokonèení zápisu kritérií kliknìte na "Pokraèovat".</p>

		<span class="optionhead">Vybrat místa pro slouèení</span>
		<p>Pod tímto nadpisem uvidíte seznam výsledkù, které odpovídají va¹im výbìrovým kritériím. Pokud nìkteré z nich odkazují na stejné umístìní,
		za¹krtnìte políèko oznaèení "Slouèit tyto (vymazat)" nalevo od ka¾dého. Ka¾dý vybraný øádek zèervená. Dále kliknìte na pøepínaè ve sloupci oznaèeném "do tìchto (ponechat)", jeho¾
		název místa nahradí v¹echny za¹krtnutá místa. Tento øádek zezelená. Nezále¾í to na tom, zda název místa, který má být ponechán, je souèasnì
		za¹krtnut jako "Slouèit tyto (vymazat)". Pro "ponechání" mù¾ete vybrat pouze jedno místo na jedno slouèení, ale mù¾ete vybrat
		nìkolik míst, která chcete slouèit do jednoho. Pokud jste pøipraveni slouèit místa, kliknìte na tlaèítko "Slouèit místa"
		na obrazovce nahoøe nebo dole. V¹echny výskyty vymazaných míst (v záznamech osoby nebo rodiny) budou nahrazeny názvem, který jste vybrali, ¾e má být ponechán.
		<strong>Pozn.:</strong> Poznámky a údaje o zemìpisné ¹íøce a délce zùstanou u míst, která ponecháváte.</p>

		<p>Pamatujte na to, ¾e se zvy¹ujícím poètem polo¾ek, které jsou vybrány ke slouèení, klesá výkon. Jinými slovy slouèení dvou míst probìhne mnohem rychleji ne¾ slouèení 20 míst.</p>
		
		<p>Chcete-li znovu vyhledat, ani¾ byste sluèovali, zapi¹te novou hodnotu do pole "Hledat" na obrazovce nahoøe a kliknìte znovu na "Pokraèovat".</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="geo"><p class="subheadbold">Geokódovat</p></a>
		<p>Nástroj Geokódování lze pou¾ít k nalezení a ulo¾ení souøadnic zemìpisné ¹íøky a délky pro místa, která tyto údaje neobsahují.</p>

		<span class="optionhead">Omezení</span>
		<p>Délka trvání tohoto procesu zále¾í na poètu míst, která je potøeba geokódovat. Google také omezuje poèet míst na 2500 dennì. Z tìchto dùvodù mù¾ete omezit poèet míst, která mají být okódována najednou.
		Výchozí poèet je 100. Pokud zjistíte, ¾e prvních 100 míst probìhlo rychle, mù¾ete v dal¹í dávce tento poèet zvý¹it.</p>
    
    <span class="optionhead">Obnovit</span>
		<p>Za¹krtnutím tohoto políèka zaènete znovu od zaèátku seznamu míst. Jinak bude geokódování pokraèovat od místa, kde skonèila poslední dávka.</p>

		<span class="optionhead">Pokud bude pro jedno místo nalezeno více výsledkù:</span>
		<p>Je-li název místa nejednoznaèný, Google mù¾e vrátit více výsledkù. V tomto pøípadì doporuèujeme odmítnout v¹echny vrácené výsledky (tak¾e mù¾ete
		dohledání provést pozdìji ruènì), ale mù¾ete také zvolit, aby TNG akceptoval první nalezený výsledek.</p>
	</td>
</tr>

</table>
</body>
</html>
