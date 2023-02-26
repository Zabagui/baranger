<?php
include("../../helplib.php");
echo help_header("Nápověda: Místa");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="cemeteries_help.php" class="lightlink">&laquo; Nápověda: Hřbitovy</a> &nbsp; | &nbsp;
			<a href="places_googlemap_help.php" class="lightlink">Nápověda: Google Maps &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Místa</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Přidat nebo Upravit</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp;
			<a href="#merge" class="lightlink">Sloučit</a> &nbsp; | &nbsp;
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
    <p>Nalezení existujících míst vyhledáním celého nebo části <strong>názvu místa</strong>. Pro další zúžení výsledků vašeho hledání na místa spojená s určitým stromem vyberte tento strom.
		Zaškrtnutím "Chybí zeměpisná šířka nebo délka" se zobrazí pouze místa, která je třeba doplnit tyto údaje. Zaškrtnutím "Vyhledat pouze kódy chrámů CJKSpd" se zobrazí pouze pětiznakové názvy míst,
    které byly označeny jako chrámy CJKSpd. Zaškrtnutím volby "Pouze přesná shoda" výsledek vašeho hledání dále zúžíte. 
    Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam všech míst ve vaší databázi.</p>

    <p>Zaškrtnutím políčka "Žádné připojené události" zobrazíte pouze místa, která nejsou spojena s žádnými událostmi.</p>

   	<p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlačítko <strong>Obnovit</strong>, které znovu obnoví všechny výchozí hodnoty.</p>

		<span class="optionhead">Akce</span>
		<p>Tlačítko Akce vedle každého výsledku hledání vám umožní upravit, odstranit nebo otestovat tento výsledek. Chcete-li najednou vymazat více záznamů, zaškrtněte políčko ve sloupci
		<strong>Vybrat</strong> u každého záznamu, která má být vymazán a poté klikněte na tlačítko "Vymazat označené" na začátku seznamu. Pro zaškrtnutí nebo vyčištění všech výběrových políček najednou
    můžete použít tlačítka <strong>Vybrat vše</strong> nebo <strong>Vyčistit vše</strong>.</p>
 
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="add"><p class="subheadbold">Přidat nové / Upravit existující místa</p></a>

		<p>TNG automaticky přidá záznam nového místa pokaždé, když zapíšete nové místo v Admin/Osoba, v Admin/Rodiny nebo jako součást nějaké vlastní události.
		Pokud na jakékoli z těchto obrazovek změníte existující místo a výsledkem bude nový jednoznačný název místa, nový záznam místa bude rovněž vytvořen.</p>

 		<p>Chcete-li přidat nové místo, klikněte na záložku <strong>Přidat nové</strong> a poté vyplňte formulář. <p>Chcete-li upravit existující místo, použijte
    záložku <a href="#search">Hledat</a> pro nalezení místa, a poté klikněte na ikonu Upravit vedle tohoto řádku.</p>
    Význam jednotlivých polí při přidání nebo úpravě hřbitova je následující:</p>

		<span class="optionhead">Strom</span>
		<p>Pokud jsou místa ve vašem Základním nastavení programu konfigurována tak, že jsou spojena se stromy, uvidíte zde pole výběru stromu. V tomto případě vyberte jeden z vašich existujících stromů,
		protože každé místo musí být spojeno se stromem. <strong>Pozn.:</strong> Po vytvoření místa nelze změnit jeho spojení se stromem
		(místo toho vymažte místo a znovu jej založte pod jiným stromem). Pokud nechcete, aby byla místa spojená se stromy, změňte nastavení v Admin/Nastavení/Základní nastavení/Různé.</p>

		<span class="optionhead">Místo</span>
		<p>Zapište název vašeho místa nejmenší částí místa počínaje. Všechny části místa by měla být oddělena čárkoou. Např.
		<em>Klášterec, Šumperk, Olomoucký kraj, Česká republika</em>. Nepoužívejte neurčité nebo máloznámé zkratky.</p>

    <span class="optionhead">Zobrazit/skrýt klikací mapu</span>
		<p>Kliknutím na tlačítko "Zobrazit/skrýt klikací mapu" se zobrazí Google Map. Tato funkce je aktivní, pokud jste obdrželi od Google "klíč" a vložili jej do
		svého nastavení map v TNG (viz <a href="mapconfig_help.php">Nápověda pro nastavení mapy</a> pro více informací). Opětovným kliknutím na toto tlačítko bude mapa skryta. Chcete-li, aby bylo umístění vyhledáno v Google Maps,
		zapište toto umístění do pole <strong>Geokódovat umístění</strong> a klikněte na tlačítko "Hledat". Do mapy můžete také klikat a pohybovat s ní, dokud
		nebude "špendlík" na požadovaném místě. Můžete také použít ovládací prvek Přiblížení pro zobrazení více podrobností v okolí požadované oblasti. Na stránce
		<a href="places_googlemap_help.php">Nápověda Google Maps</a> najdete více informací. Informace o výchozím nastavení vašich map najdete v <a href="mapconfig_help.php">Nápovědě: Nastavení map</a>.</p>

    <span class="optionhead">Zeměpisná šířka/délka</span>
		<p>Zapište souřadnice zeměpisné šířky a délky místa nebo pro nastavení hodnot použijte klikací Google Map (nepovinné, viz výše).</p>

		<span class="optionhead">Přiblížení</span>
		<p>Zadejte úroveň přiblížení nebo upravte ovládací prvek přiblížení v Google Map pro nastavení úrovně přiblížení. Tato volba je dostupná pouze, když jste obdrželi "klíč"
		od Google a zapsali jej do vašeho nastavení map v TNG.</p>

		<span class="optionhead">Úroveň sídla</span></p>
		<p>Úroveň sídla popisuje úroveň členění sídla zastoupeného názvem místa. Vašim návštěvníkům to může pomoci poznat přesnost umístění špendlíku na mapě.
		Např. chcete-li umístit špendlík do Francie, ale nevíte, kam přesně, měli byste vybrat v této volbě
		"Země", aby vaši návštěvníci věděli, umístění špendlíku ve Francii není přesné.</p>

		<span class="optionhead">Hřbitovy</span>
		<p>Chcete-li spojit hřbitov s aktuálním místem, klikněte zde na tlačítko <strong>Přidat nový</strong>.
		V malém okně, které se objeví, vyberte ze seznamu, který jste vytvořili v Admin/Hřbitovy hřbitov,
		a poté klikněte na tlačítko Go. Chcete-li vymazat hřbitov spojený s aktuálním místem, klikněte na malou ikonu
		Vymazat vedle tohoto hřbitova.</p>
		
   	<p>Je-li hřbitov propojen s místem, údaje o hřbitovu budou zobrazeny na stránce místa a seznam pohřbů
		spojených s místem bude zobrazen na stránce hřbitova.</p>
     
		<span class="optionhead">Poznámky</span>
		<p>Do tohoto pole zapište jakékoli poznámky, které mají vztah k vašemu místu.</p>

		<span class="optionhead">Provést změny názvu místa v existujících událostech</span>
		<p>Toto zaškrtnuté políčko (viditelné pouze při úpravě existujícího místa) označuje, že budou při uložení změn 
    aktualizovány všechny události, kde je toto místo použito.</p>

    <p><strong>POZN.:</strong> Všechny následné importy souborů GEDCOM, kde je zaškrtnuta volba "Nahradit všechna aktuální data" nepřepíše nebo nevymaže
		existující údaje o místech, pokud existující záznamy obsahují údaje v polích zeměpisná šířka, délka nebo poznámky nebo jsou připojena nějaká média.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="delete"><p class="subheadbold">Vymazat místa</p></a>
		<p>Chcete-li odstranit místo, použijte záložku <a href="#search">Hledat</a> pro nalezení místa, a poté klikněte na ikonu Vymazat vedle tohoto záznamu místa. Tento řádek změní
		barvu a poté po odstranění místa zmizí. Chcete-li najednou odstranit více míst, zaškrtněte políčko ve sloupci Vybrat vedle každého místa, který
    chcete odstranit, a poté klikněte na tlačítko "Vymazat označené" na stránce nahoře</p>
     
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="merge"><p class="subheadbold">Sloučit místa</p></a>
 		<p>Kliknutím na tuto záložku lze přezkoumat a sloučit názvy míst, které jsou lehce odlišné, ale odkazují na stejné místo.
		Musíte rozhodnout, zda jsou tyto záznamy totožné nebo ne.</p>

		<span class="optionhead">Najít kandidáty pro sloučení</span>
		<p>Pokud je ve vašem Základním nastavení konfigurováno, že místa jsou spojena se stromy, uvidíte zde výběrové pole Strom. V tomto případě vyberte strom.
		Nelze slučovat místa z různých stromů, takže lze vybrat pouze jeden strom. Poté zadejte výběrová kritéria,
		která budou společná pro všechny potenciální duplicity. Můžete např. zapsat <em>Horní Staré</em> pro nalezení
		<em>Horní Staré</em> a <em>Horní Staré Město</em>.</p>
		<p>Do prvního pole musíte něco zapsat, druhé pole je nepovinné. Chcete-li sloučit dvě místa, jejichž názvy nejsou moc podobné,
		můžete něco zapsat i do druhého pole. Např. pokud chcete sloučit <em>TU</em> a <em>Trutnov</em>, bude nejlepší zapsat do prvního pole <em>TU</em>
		a do druhého <em>Trutnov</em>. Po dokončení zápisu kritérií klikněte na "Pokračovat".</p>

		<span class="optionhead">Vybrat místa pro sloučení</span>
		<p>Pod tímto nadpisem uvidíte seznam výsledků, které odpovídají vašim výběrovým kritériím. Pokud některé z nich odkazují na stejné umístění,
		zaškrtněte políčko označení "Sloučit tyto (vymazat)" nalevo od každého. Každý vybraný řádek zčervená. Dále klikněte na přepínač ve sloupci označeném "do těchto (ponechat)", jehož
		název místa nahradí všechny zaškrtnutá místa. Tento řádek zezelená. Nezáleží to na tom, zda název místa, který má být ponechán, je současně
		zaškrtnut jako "Sloučit tyto (vymazat)". Pro "ponechání" můžete vybrat pouze jedno místo na jedno sloučení, ale můžete vybrat
		několik míst, která chcete sloučit do jednoho. Pokud jste připraveni sloučit místa, klikněte na tlačítko "Sloučit místa"
		na obrazovce nahoře nebo dole. Všechny výskyty vymazaných míst (v záznamech osoby nebo rodiny) budou nahrazeny názvem, který jste vybrali, že má být ponechán.
		<strong>Pozn.:</strong> Poznámky a údaje o zeměpisné šířce a délce zůstanou u míst, která ponecháváte.</p>

		<p>Pamatujte na to, že se zvyšujícím počtem položek, které jsou vybrány ke sloučení, klesá výkon. Jinými slovy sloučení dvou míst proběhne mnohem rychleji než sloučení 20 míst.</p>
		
		<p>Chcete-li znovu vyhledat, aniž byste slučovali, zapište novou hodnotu do pole "Hledat" na obrazovce nahoře a klikněte znovu na "Pokračovat".</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="geo"><p class="subheadbold">Geokódovat</p></a>
		<p>Nástroj Geokódování lze použít k nalezení a uložení souřadnic zeměpisné šířky a délky pro místa, která tyto údaje neobsahují.</p>

		<span class="optionhead">Omezení</span>
		<p>Délka trvání tohoto procesu záleží na počtu míst, která je potřeba geokódovat. Google také omezuje počet míst na 2500 denně. Z těchto důvodů můžete omezit počet míst, která mají být okódována najednou.
		Výchozí počet je 100. Pokud zjistíte, že prvních 100 míst proběhlo rychle, můžete v další dávce tento počet zvýšit.</p>
    
    <span class="optionhead">Obnovit</span>
		<p>Zaškrtnutím tohoto políčka začnete znovu od začátku seznamu míst. Jinak bude geokódování pokračovat od místa, kde skončila poslední dávka.</p>

		<span class="optionhead">Pokud bude pro jedno místo nalezeno více výsledků:</span>
		<p>Je-li název místa nejednoznačný, Google může vrátit více výsledků. V tomto případě doporučujeme odmítnout všechny vrácené výsledky (takže můžete
		dohledání provést později ručně), ale můžete také zvolit, aby TNG akceptoval první nalezený výsledek.</p>
	</td>
</tr>

</table>
</body>
</html>
