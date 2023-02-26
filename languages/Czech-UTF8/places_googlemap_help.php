<?php
include("../../helplib.php");
echo help_header("Nápověda: Google Maps");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="places_help.php" class="lightlink">&laquo; Nápověda: Místa</a> &nbsp; | &nbsp;
			<a href="tlevents_help.php" class="lightlink">Nápověda: Události časové osy &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Google Maps</span>
		<p class="smaller menu">
			<a href="#show" class="lightlink">Zobrazit</a> &nbsp; | &nbsp;
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#controls" class="lightlink">Ovládání mapy</a> &nbsp; | &nbsp;
			<a href="#help" class="lightlink">Nápověda</a>
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
      
		<a name="show"><p class="subheadbold">Zobrazit/skrýt klikací mapu</p></a>
		<p>Kliknutím na tlačítko "Zobrazit/skrýt klikací mapu" se zobrazí Google Maps a možnost vyhledat místa pro geokódování
		nebo se po dokončení mapa skryje. Výchozí nastavení je specifikováno v Admin/Nastavení/Nastavení mapy.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
	
		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="search"><p class="subheadbold">Hledat</p></a>
		<p>Google Map Geocoder vám umožní nalézt souřadnice zeměpisné šířky a délky pro název místa při použití pole Geokódovat umístění jako vstupního pole.
		Pro vyhledání souřadnic můžete také využít aplikaci Streetmap (<a href="https://www.streetmap.co.uk" target="_blank">https://www.streetmap.co.uk</a>).</p>

		<span class="optionhead">Geokódovat umístění</span>
		<p>Pokud již bylo místo zavedeno v TNG, obsahuje pole Geokódovat umístění název tohoto místa. Při přidání nového místa bude do pole Geokódovat umístění
		doplněn název místa z TNG. Při přidání hřbitovů nebo médií nejsou názvy míst doplněny. </p>
		<p>U existujících názvů míst v TNG je někdy třeba ve vstupním poli Geokódovat umístění upravit název místa. Např. Google nemá rád názvy okresů
		jako součást názvů míst v USA, ani si neporadí s novozélandskými provinciemi. Jako vstup můžete také chtít vložit pouze název místa a zemi.
		Název země můžete také zapsat v angličtině.</p>
		<span class="optionhead">Příklady názvů míst</span>
		<p>Následují příklady, jak mají být zapsána místa, aby výsledek obsahoval správné údaje o zeměpisné šířce a délce:
		<ul>
			<li>1102 Shipwatch Circle, Tampa, Florida</li>
			<li>Klippan 1, 41451 Sweden</li>
			<li>Avenida de Velasquez 126, Malaga</li>
			<li>49 Rue de Tournai, Lille, France</li>
			<li>Ocean Drive, Twin Waters, Queensland, Australia</li>
			<li>Rue de la Wastinne 45, 1301 Wavre, Belgium</li>
			<li>Via Villanova 31, 40050 Bologna villanova, Italy</li>
			<li>Europaboulevard 10, Amsterdam</li>
			<li>Lise-Meitner-Strasse 2, 60486 Frankfurt, Germany</li>
		</ul></p>

		<p>Geocoder nemůže pracovat s mapami některých států z národnostních nebo licenčních důvodů.
		Pro tyto státy musíte použít odkaz <a href="https://maps.google.com/" target="_blank">Plné vyhledávání v Google Maps</a>.</p>

		<span class="optionhead">Zeměpisná šířka a délka</span>
		<p>Při přijetí souřadnic zeměpisné šířky a délky, které vám nabízí vyhledávání v mapě, musíte být velmi pečliví. Přinejmenším byste měli alespoň trochu
		vědět, kde se dané místo nachází a co očekáváte před tím, než přijmete výsledek z hledání v mapě. Pokud se špendlík na mapě
		nenachází na místě, kde byste jej čekali, zeměpisná šířka a délka, která je vrácena, nemusí být správná. V takovém případě byste měli zpozornět a kliknout na
		Google Maps pro pozici k lepšímu umístění.</p>

		<p>Přijatou zeměpisnou šířku a délku byste měli také otestovat kliknutím na ikonu Test v seznamu míst a poté kliknutím na špendlík ověřit
		na externí mapě, že umístění je správné.</p>
		
		<span class="optionhead">Přiblížení</span>
		<p>Není-li místo na mapě v požadovaném přiblížení, můžete použít níže popsaný ovladač přiblížení k přizpůsobení zobrazení
		mapy, zvlášťe pro omezení chybových hlášení, že Google neobsahuje mapu v této úrovni přiblížení. Hodnota výsledného přiblížení bude
		uložena ve vaší databázi TNG.</p>

		<span class="optionhead">Úroveň sídla</span>
		<p>Rozbalovací seznam Úroveň sídla můžete použít k výběru úrovně členění sídla zastoupeného názvem místa. K dispozici je šest úrovní v rozsahu od adresy po zemi,
		kde adresa je nejpodrobnější. Přepsat obsah proměnné $admtext pro úrovně 1 až 6, které jsou v souboru alltext.php, můžete ve svém souboru cust_text.php.
		Tagy pro úrovně 2 až 5 můžete změnit, aby reflektovali např. kostel/nemocnice/hřbitov, město/obec, okres/department, kraj/provincie/region.
		Různě barevné špendlíky označují členění úrovně sídla na stránce osoby. Indikátor úrovně sídla se neobjevuje
		v tabulce hřbitovů a médií. Špendlíky zobrazené v tabulce hřbitovů jsou v úrovni 2, což umožňuje, že náhrobky jsou zobrazeny v nejpodrobnější úrovni.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="controls"><p class="subheadbold">Ovládací prvky Google Maps</p></a>

		<span class="optionhead">Bod / Klik</span>
		<p>Chcete-li zpřesnit údaj o zeměpisné šířce a délce u daného místa, klikněte v Google Maps na bod, kde si myslíte, že se místo nachází. Pro obdržení lepších údajů
		o zeměpisné šířce a délce pro název místa v TNG můžete také v Google Maps použít tlačítka Mapa nebo Satelitní. </p>

		<span class="optionhead">Táhnout a posunout</span>
		<p>Mapy se dají posunovat, takže můžete použít myš nebo směrové šipky pro posun doleva, doprava, nahoru nebo dolů pro zobrazení oblastí, které jsou skryté
		mimo obrazovku. Možnost táhnout a posunout znamená, že nemusíte klikat ani čekat na nové načtení grafiky pokaždé, když chcete vidět přilehlé části mapy.</p>

		<span class="optionhead">Přiblížení</span>
		<p>Značky plus (+) a minus (-) nebo posuvník přiblížení můžete použít pro přiblížení nebo oddálení mapy. Při přiblížení mapy můžete použít směrové šipky 
    pro vylepšení pozice na mapě. Změníte-li úroveň přiblížení, hodnota přiblížení bude uložena v tabulce TNG.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="help"><p class="subheadbold">Nápověda Google Maps</p></a>

		<p>Další nápovědu najdete na <a href="https://www.google.com/apis/maps/documentation/" target="_blank">Google Maps API</a>.</p>
	</td>
</tr>

</table>
</body>
</html>
