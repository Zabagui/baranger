<?php
include("../../helplib.php");
echo help_header("Nápovìda: Google Maps");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="places_help.php" class="lightlink">&laquo; Nápovìda: Místa</a> &nbsp; | &nbsp;
			<a href="tlevents_help.php" class="lightlink">Nápovìda: Události èasové osy &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Google Maps</span>
		<p class="smaller menu">
			<a href="#show" class="lightlink">Zobrazit</a> &nbsp; | &nbsp;
			<a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp;
			<a href="#controls" class="lightlink">Ovládání mapy</a> &nbsp; | &nbsp;
			<a href="#help" class="lightlink">Nápovìda</a>
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
		<p>Kliknutím na tlaèítko "Zobrazit/skrýt klikací mapu" se zobrazí Google Maps a mo¾nost vyhledat místa pro geokódování
		nebo se po dokonèení mapa skryje. Výchozí nastavení je specifikováno v Admin/Nastavení/Nastavení mapy.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
	
		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="search"><p class="subheadbold">Hledat</p></a>
		<p>Google Map Geocoder vám umo¾ní nalézt souøadnice zemìpisné ¹íøky a délky pro název místa pøi pou¾ití pole Geokódovat umístìní jako vstupního pole.
		Pro vyhledání souøadnic mù¾ete také vyu¾ít aplikaci Streetmap (<a href="https://www.streetmap.co.uk" target="_blank">https://www.streetmap.co.uk</a>).</p>

		<span class="optionhead">Geokódovat umístìní</span>
		<p>Pokud ji¾ bylo místo zavedeno v TNG, obsahuje pole Geokódovat umístìní název tohoto místa. Pøi pøidání nového místa bude do pole Geokódovat umístìní
		doplnìn název místa z TNG. Pøi pøidání høbitovù nebo médií nejsou názvy míst doplnìny. </p>
		<p>U existujících názvù míst v TNG je nìkdy tøeba ve vstupním poli Geokódovat umístìní upravit název místa. Napø. Google nemá rád názvy okresù
		jako souèást názvù míst v USA, ani si neporadí s novozélandskými provinciemi. Jako vstup mù¾ete také chtít vlo¾it pouze název místa a zemi.
		Název zemì mù¾ete také zapsat v angliètinì.</p>
		<span class="optionhead">Pøíklady názvù míst</span>
		<p>Následují pøíklady, jak mají být zapsána místa, aby výsledek obsahoval správné údaje o zemìpisné ¹íøce a délce:
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

		<p>Geocoder nemù¾e pracovat s mapami nìkterých státù z národnostních nebo licenèních dùvodù.
		Pro tyto státy musíte pou¾ít odkaz <a href="https://maps.google.com/" target="_blank">Plné vyhledávání v Google Maps</a>.</p>

		<span class="optionhead">Zemìpisná ¹íøka a délka</span>
		<p>Pøi pøijetí souøadnic zemìpisné ¹íøky a délky, které vám nabízí vyhledávání v mapì, musíte být velmi peèliví. Pøinejmen¹ím byste mìli alespoò trochu
		vìdìt, kde se dané místo nachází a co oèekáváte pøed tím, ne¾ pøijmete výsledek z hledání v mapì. Pokud se ¹pendlík na mapì
		nenachází na místì, kde byste jej èekali, zemìpisná ¹íøka a délka, která je vrácena, nemusí být správná. V takovém pøípadì byste mìli zpozornìt a kliknout na
		Google Maps pro pozici k lep¹ímu umístìní.</p>

		<p>Pøijatou zemìpisnou ¹íøku a délku byste mìli také otestovat kliknutím na ikonu Test v seznamu míst a poté kliknutím na ¹pendlík ovìøit
		na externí mapì, ¾e umístìní je správné.</p>
		
		<span class="optionhead">Pøiblí¾ení</span>
		<p>Není-li místo na mapì v po¾adovaném pøiblí¾ení, mù¾ete pou¾ít ní¾e popsaný ovladaè pøiblí¾ení k pøizpùsobení zobrazení
		mapy, zvlá¹»e pro omezení chybových hlá¹ení, ¾e Google neobsahuje mapu v této úrovni pøiblí¾ení. Hodnota výsledného pøiblí¾ení bude
		ulo¾ena ve va¹í databázi TNG.</p>

		<span class="optionhead">Úroveò sídla</span>
		<p>Rozbalovací seznam Úroveò sídla mù¾ete pou¾ít k výbìru úrovnì èlenìní sídla zastoupeného názvem místa. K dispozici je ¹est úrovní v rozsahu od adresy po zemi,
		kde adresa je nejpodrobnìj¹í. Pøepsat obsah promìnné $admtext pro úrovnì 1 a¾ 6, které jsou v souboru alltext.php, mù¾ete ve svém souboru cust_text.php.
		Tagy pro úrovnì 2 a¾ 5 mù¾ete zmìnit, aby reflektovali napø. kostel/nemocnice/høbitov, mìsto/obec, okres/department, kraj/provincie/region.
		Rùznì barevné ¹pendlíky oznaèují èlenìní úrovnì sídla na stránce osoby. Indikátor úrovnì sídla se neobjevuje
		v tabulce høbitovù a médií. ©pendlíky zobrazené v tabulce høbitovù jsou v úrovni 2, co¾ umo¾òuje, ¾e náhrobky jsou zobrazeny v nejpodrobnìj¹í úrovni.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="controls"><p class="subheadbold">Ovládací prvky Google Maps</p></a>

		<span class="optionhead">Bod / Klik</span>
		<p>Chcete-li zpøesnit údaj o zemìpisné ¹íøce a délce u daného místa, kliknìte v Google Maps na bod, kde si myslíte, ¾e se místo nachází. Pro obdr¾ení lep¹ích údajù
		o zemìpisné ¹íøce a délce pro název místa v TNG mù¾ete také v Google Maps pou¾ít tlaèítka Mapa nebo Satelitní. </p>

		<span class="optionhead">Táhnout a posunout</span>
		<p>Mapy se dají posunovat, tak¾e mù¾ete pou¾ít my¹ nebo smìrové ¹ipky pro posun doleva, doprava, nahoru nebo dolù pro zobrazení oblastí, které jsou skryté
		mimo obrazovku. Mo¾nost táhnout a posunout znamená, ¾e nemusíte klikat ani èekat na nové naètení grafiky poka¾dé, kdy¾ chcete vidìt pøilehlé èásti mapy.</p>

		<span class="optionhead">Pøiblí¾ení</span>
		<p>Znaèky plus (+) a minus (-) nebo posuvník pøiblí¾ení mù¾ete pou¾ít pro pøiblí¾ení nebo oddálení mapy. Pøi pøiblí¾ení mapy mù¾ete pou¾ít smìrové ¹ipky 
    pro vylep¹ení pozice na mapì. Zmìníte-li úroveò pøiblí¾ení, hodnota pøiblí¾ení bude ulo¾ena v tabulce TNG.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="help"><p class="subheadbold">Nápovìda Google Maps</p></a>

		<p>Dal¹í nápovìdu najdete na <a href="https://www.google.com/apis/maps/documentation/" target="_blank">Google Maps API</a>.</p>
	</td>
</tr>

</table>
</body>
</html>
