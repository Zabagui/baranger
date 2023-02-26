<?php
include("../../helplib.php");
echo help_header("Nápovìda: Mana¾er módù");
?>

<body class="helpbody">
  <a name="top"></a>
  <table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
    <tr class="fieldnameback">	
      <td class="tngshadow">		
        <p style="float:right; text-align:right" class="smaller menu">			
          <a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp; 			
          <a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />			
          <a href="backuprestore_help.php" class="lightlink">&laquo; Nápovìda: Obslu¾né programy</a> &nbsp; | &nbsp; 			
          <a href="index_help.php" class="lightlink">Nápovìda: Zaèínáme &raquo;</a>		
        </p>		
        <span class="largeheader">Nápovìda: Mana¾er módù
        </span>		
        <p class="smaller menu">			
          <a href="#overview" class="lightlink">Pøehled</a> &nbsp; | &nbsp; 			
          <a href="#operation" class="lightlink">Operace</a> &nbsp; | &nbsp; 			
          <a href="#status" class="lightlink">Stav</a> &nbsp; | &nbsp;
          <a href="#syntax" class="lightlink">Syntaxe módù</a> &nbsp; | &nbsp;           			
          <a href="#files" class="lightlink">Konfiguraèní soubory</a> &nbsp; | &nbsp;
          <a href="#batch" class="lightlink">Dávková instalace</a> &nbsp; | &nbsp;
          <a href="#options" class="lightlink">Mo¾nosti</a>		
        </p>	</td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      		
        <a name="overview">
          <p class="subheadbold">Pøehled
          </p></a>		
        <p>TNG Mana¾er módù, který pùvodnì vyvinul Brian McFadyen a pro práci s Joomla TNG Component aktualizoval Sean Schwoere, je urèen k poskytnutí ucelenìj¹ího 
        zpùsobu instalování, odstraòování a správì modifikací TNG software, který s tímto mana¾erem doká¾e pracovat. Aktualizace v TNG V9 provedli Bart Degryse a Ken Roy.
        Mana¾er módù je pro snaz¹í pøístup pøipojen ke stránce Administrace TNG. Mana¾er módù pøidává do TNG tyto slo¾ky: 		
          <ul>			
            <li><strong>mods</strong> obsahuje konfiguraèní soubory módù a pøidru¾ené podpùrné soubory módù
            </li>			
            <li><strong>extensions</strong> obsahuje nìkterá roz¹íøení módù, které jsou instalovány jinými konfiguraèními soubory mana¾eru módù
            </li>		
          </ul></p>
        <p><strong>Dávkovou instalaci</strong> pøidal do TNG 10.0.3 Rick Bisbee a umo¾òuje vykonat stejnou akci pro více módù. Popup okno s popisem pøidal Jeff Robison.</p>
        <p><strong>Mo¾nosti</strong> pøidal do TNG 10.0.3 Ken Roy a umo¾òuje mìnit nìkteré chování mana¾eru módù.</p>
        <p><strong>Zobrazit protokol</strong> pøidal do TNG 10.0.3 Ken Roy a zobrazuje protokol mana¾eru módù, který je nyní oddìlen od protokolu administrace.  
        Protokol mana¾eru módù pro snadnìj¹í èitelnost akcí pøeformátoval Rick Bisbee.</p>    
        <p>Dal¹í informace mù¾ete najít v èlánku 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager" target="_blank">Mana¾er módù</a> a v kategorii èlánkù 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Category:TNG_Mod_Manager" target="_blank">TNG Mod Manager</a> na TNG Wiki.
        </p>	</td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">		
        <p style="float:right">
          <a href="#top">Nahoru</a>
        </p>		
        <a name="operation">
          <p class="subheadbold">Operace
          </p></a>		
        <p>Mana¾er módù prozkoumá slo¾ku módù a pøeète ka¾dý soubor <strong>cfg</strong>, který najde. Soubory <strong>cfg</strong> jsou direktivní soubory, které popisují mód, soubory a umístìní, které má být modifikováno, a kód, který je pøi modifikaci pou¾it. 		
          <p>Mana¾er módù zkontroluje následující: 			
            <ul>				
              <li>zajistí, ¾e je u¾ivatel pøihlá¹en 				
              <li>provìøí umístìní a zmìnu ka¾dého kódu 					
              <ul>						
                <li>zajistí, ¾e lze umístìní nalézt
                </li>						
                <li>zajistí, ¾e cílové místo je jedineèné
                </li>						
                <li>urèí, zda cílové umístìní ji¾ bylo nainstalováno
                </li>					
              </ul>			
              <li>urèí nové soubory, které mají být vytvoøeny. Pokud nový soubor ji¾ existuje, urèí jeho verzi.
              </li>			
            </ul>
          </p>	</td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">		
        <p style="float:right">
          <a href="#top">Nahoru</a>
        </p>		
        <a name="status">
          <p class="subheadbold">Stav
          </p></a>			
        <p>Mana¾er módù vrací následující stavy: 			
          <ul>			
            <li><strong>Lze instalovat</strong>, pokud mód je¹tì nebyl nainstalován a cílové umístìní bylo urèeno, pak je uvedena mo¾nost <strong>Instalovat</strong>
            </li>			
            <li><strong>Instalováno</strong>, pokud mód byl nainstalován, je uvedena mo¾nost <strong>Odstranit</strong> mód a mo¾nost <strong>Upravit</strong> parametry, pokud nìjaké existují
            </li>			
            <li><strong>Vyèistit</strong>, pokud mód byl èásteènì nainstalován, je k dispozici tlaèítko <strong>Vyèistit</strong>. Operace Vyèi¹tìní se pokusí odstranit vlo¾ený kód, obnovit a nahradit kód, a odstranit vytvoøený soubor.
            </li>			
            <li><strong>Nelze nainstalovat</strong>, pokud mód <strong>nelze</strong> instalovat. Tato zpráva bude pøedcházet jinou zprávu, která poskytne více informací o tom, proè mód nelze nainstalovat.
            </li>			
          </ul>		
          <p>Pøíklady obrazovek stavu mana¾eru módù a jak interpretovat rùzné stavy najdete na 
            <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Interpreting_Status" target="_blank">Mana¾er módù - interpretace stavù</a>
          </p>	</td>
    </tr>
    <tr class="databack">
      <td class="tngshadow">
        <p style="float:right">
          <a href="#top">Nahoru</a>
        </p>
        <a name="syntax">
          <p class="subheadbold">Syntaxe módù
          </p></a>
        <p>The Mod Manager syntax basically includes:
        <p><strong>Sekce záhlaví</strong>, která obsahuje</p>
				<ul><li>Název - název módu, èlánek na TNG Wiki a název souboru</li>
				<li>Verze - verze módu, kde první 3 èíslice pøedstavují nejni¾¹í verzi TNG, ve které mód funguje</li>
				<li>Popis - obsahuje struèný popis módu, jméno vývojáøe a URL èlánku o daném módu na TNG Wiki.</li>
				</ul>
				</p>
			<p><strong>Cílové sekce (Target)</strong>, kde je specifikován soubor, který je opravným módem zmìnìn, a obsahuje tyto pøíkazy</p>
			<ul><li>Location - urèuje umístìní kódu, který je v souboru mìnìn</li>
			<li>Klíèové slovo akce - urèuje, zda pøepsat (Replace) nebo vlo¾it (Insert) kód pøed (Before) nebo za (After) toto umístìní</li>
			</ul>
			</p>
			<p><strong>Pøíkaz Nový soubor (New File)</strong>, který po instalaci módu vytvoøí nový soubor</p>
			<p><strong>Pøíkaz Kopírovat soubor (Copy File)</strong>, který nakopíruje urèitý soubor do øídící slo¾ky TNG (%copyfile) nebo do podslo¾ky (%copyfile2)</p>
			<p>Detailní informace týkající se syntaxe módù najdete v èlánku <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Syntax" target="_blank">Mod Manager Syntax (v angliètinì)</a></p>
      </td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">		
        <p style="float:right">
          <a href="#top">Nahoru</a>
        </p>		
        <a name="files">
          <p class="subheadbold">Konfiguraèní soubory
          </p></a>		
        <span class="optionhead">Instalování módù
        </span>		
        <p>Informace o pou¾ití 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Installing_Config_Files" target="_blank">konfiguraèních souborù</a> k instalaci módù najdete na TNG Wiki.
        </p>		 		
        <span class="optionhead">Interpretace stavu
        </span>		
        <p>Informace o 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Creating_Config_Files" target="_blank">interpretaci stavu</a> najdete na TNG Wiki.
        </p>		 		
        <span class="optionhead">Syntaxe konfiguraèních souborù
        </span>		
        <p>Informace o 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Config_File_Syntax" target="_blank">syntaxi konfiguraèních souborù</a> najdete na TNG Wiki.
        </p>		 		
        <span class="optionhead">Vytvoøení konfiguraèního souboru
        </span>		
        <p>Informace pro vývojáøe o 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Creating_Config_Files" target="_blank">vytvoøení konfiguraèních souborù</a> najdete na TNG Wiki.
        </p>	</td>
    </tr>
    
    <tr class="databack">
      <td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="batch"><p class="subheadbold">Dávková instalace</p></a>

		<p>Dávková instalace umo¾ní provést specifické akce týkající se nìkolika módù pomocí výbìru filtru.  Z filtru seznamu stavù vyberte po¾adovaný stav a kliknutím na Provést zobrazíte
    dostupná ovládací tlaèítka pro vybraný stav.  Pro stav Vyèistit není k dispozici akce Odstranit, tak¾e pro odstranìní módù ve stavu Vyèistit musíte pou¾ít zálo¾ku Seznam módù.
		<p>Mo¾nosti výbìrového filtru jsou tyto:
			<ul>
				<li><strong>V¹e</strong> - zobrazí se úplný seznam v¹ech souborù .cfg ze slo¾ky mods.  Pokud zvolíte urèitý stav, objeví se dostupná tlaèítka jednotlivých akcí
				<li><strong>Lze nainstalovat</strong> - zobrazí se seznam v¹ech módù, které mohou být</li>
					<ul>
						<li>Nainstalovány - na základì va¹eho výbìru a kliknutím na tlaèítko <strong>Instalovat</strong></li>
						<li>Vymazány ze slo¾ky mods - na základì va¹eho výbìru a kliknutím na tlaèítko <strong>Vymazat</strong></li>
					</ul>
				<li><strong>Instalováno</strong> - zobrazí se seznam v¹ech módù, které jsou aktuálnì nainstalovány, a mohou být</li>
					<ul>
						<li>Odstranìny - na základì va¹eho výbìru a kliknutím na tlaèítko <strong>Odstranit</strong></li>
					</ul>
				<li><strong>Vyèistit</strong> - zobrazí se seznam v¹ech módù, které mohou být</li>
					<ul>
						<li>Vyèi¹tìny - na základì va¹eho výbìru a kliknutím na tlaèítko <strong>Vyèistit</strong></li>
					</ul>
				<li><strong>Nelze nainstalovat</strong> - zobrazí se seznam v¹ech módù, které nelze nainstalovat z dùvodu chybného cílového souboru nebo chybìjících souborù, a mohou být</li>
					<ul>
						<li>Vymazány ze slo¾ky mods - na základì va¹eho výbìru a kliknutím na tlaèítko <strong>Vymazat</strong></li>
					</ul></ul></p></p>
      </td>
    </tr>

<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="options"><p class="subheadbold">Mo¾nosti</p></a>

		<p>Mo¾nosti vám umo¾ní specifikovat chování mana¾eru módù v pøípadì
		<p><strong>Seznamu dotèených souborù</strong> 
			<ul>
				<li><strong>Zobrazit seznam dotèených souborù</strong> - umo¾ní vám zvolit, zda chcete v tabulce seznamu módù zobrazit seznam dotèených souborù.  Výchozí volbou je <strong>Ano</strong>.</li>
				<li><strong>Zobrazit v seznamu nové soubory</strong> - zobrazí nové soubory vytvoøené módem.  Výchozí volbou je <strong>Ano</strong>.</li>
				<li><strong>Zobrazit v seznamu kopírované soubory</strong> - zobrazí soubory, které jsou kopírovány módem. Výchozí volbou je <strong>Ano</strong>.</li>
				<li><strong>Zobrazit seznam ve sloupci</strong> - zobrazí seznam dotèených souborù ve zvoleném sloupci.  Výchozí volbou je sloupec <strong>Název konfiguraèního souboru</strong>.</li>
				<li><strong>Zobrazit seznam jako</strong> - umo¾ní vám zvolit, zda chcete seznam zobrazit jako tabulku nebo jako hodnoty oddìlené èárkou.  Výchozí volbou je <strong>Tabulka</strong>.</li>
				<li><strong>Zobrazit seznam v Dávkové instalaci</strong> - umo¾ní vám zvolit, zda chcete seznam zobrazit na zálo¾ce Dávková instalace ve vyskakovacím oknì.  Výchozí volbou je <strong>Ano</strong>.</li>
			</ul></p>
		<p><strong>Protokolu mana¾eru módù</strong> 
			<ul>
				<li><strong>Zaznamenávat akce mana¾eru módù</strong> - umo¾ní vám zvolit, zda chcete zaznamenávat potvrzení a akce mana¾eru módù.  Výchozí volbou je <strong>Ano</strong>.</li>
				<li><strong>Název protokolu</strong> - umo¾ní vám urèit název souboru, který bude pou¾it pro protokol mana¾eru módù.  Výchozí volbou je <strong>modmgrlog.txt</strong>.</li>
				<li><strong>Maximální poèet øádkù</strong> - umo¾ní vám urèit, kolik øádkù bude zachováváno v protokolu. Výchozí volbou je <strong>2000</strong>.</li>
			</ul></p>
		<p><strong>Jiné</strong> 
			<ul>
				<li><strong>Øadit seznamy podle</strong> - umo¾ní vám zvolit, podle kterého sloupce bude øazen Seznam módù a Dávková instalace.  Výchozí volbou je <strong>Název konfiguraèního souboru</strong>.</li>
				<li><strong>Vynechat potvrzení</strong> - umo¾ní vám zvolit, zda chcete vynechat zobrazení obrazovky Potvrzení v Seznamu módù.  I kdy¾ zvolíte Ano, Potvrzení bude stále zapisováno do protokolu.  Výchozí volbou je <strong>Ne</strong>.</li>
				<li><strong>Vynechat zprávy o akcích</strong> - umo¾ní vám zvolit, zda chcete vynechat zobrazení obrazovky Zpráva o akci v Seznamu módù.  I kdy¾ zvolíte Ano, Zpráva o akci bude stále zapisována do protokolu.  Výchozí volbou je <strong>Ne</strong>.</li>
			</ul></p></p>
	</td>
</tr>


    
  </table>
</body>
</html>
