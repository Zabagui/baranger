<?php
include("../../helplib.php");
echo help_header("Nápověda: Manažer módů");
?>

<body class="helpbody">
  <a name="top"></a>
  <table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
    <tr class="fieldnameback">	
      <td class="tngshadow">		
        <p style="float:right; text-align:right" class="smaller menu">			
          <a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp; 			
          <a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />			
          <a href="backuprestore_help.php" class="lightlink">&laquo; Nápověda: Obslužné programy</a> &nbsp; | &nbsp; 			
          <a href="index_help.php" class="lightlink">Nápověda: Začínáme &raquo;</a>		
        </p>		
        <span class="largeheader">Nápověda: Manažer módů
        </span>		
        <p class="smaller menu">			
          <a href="#overview" class="lightlink">Přehled</a> &nbsp; | &nbsp; 			
          <a href="#operation" class="lightlink">Operace</a> &nbsp; | &nbsp; 			
          <a href="#status" class="lightlink">Stav</a> &nbsp; | &nbsp;
          <a href="#syntax" class="lightlink">Syntaxe módů</a> &nbsp; | &nbsp;           			
          <a href="#files" class="lightlink">Konfigurační soubory</a> &nbsp; | &nbsp;
          <a href="#batch" class="lightlink">Dávková instalace</a> &nbsp; | &nbsp;
          <a href="#options" class="lightlink">Možnosti</a>		
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
          <p class="subheadbold">Přehled
          </p></a>		
        <p>TNG Manažer módů, který původně vyvinul Brian McFadyen a pro práci s Joomla TNG Component aktualizoval Sean Schwoere, je určen k poskytnutí ucelenějšího 
        způsobu instalování, odstraňování a správě modifikací TNG software, který s tímto manažerem dokáže pracovat. Aktualizace v TNG V9 provedli Bart Degryse a Ken Roy.
        Manažer módů je pro snazší přístup připojen ke stránce Administrace TNG. Manažer módů přidává do TNG tyto složky: 		
          <ul>			
            <li><strong>mods</strong> obsahuje konfigurační soubory módů a přidružené podpůrné soubory módů
            </li>			
            <li><strong>extensions</strong> obsahuje některá rozšíření módů, které jsou instalovány jinými konfiguračními soubory manažeru módů
            </li>		
          </ul></p>
        <p><strong>Dávkovou instalaci</strong> přidal do TNG 10.0.3 Rick Bisbee a umožňuje vykonat stejnou akci pro více módů. Popup okno s popisem přidal Jeff Robison.</p>
        <p><strong>Možnosti</strong> přidal do TNG 10.0.3 Ken Roy a umožňuje měnit některé chování manažeru módů.</p>
        <p><strong>Zobrazit protokol</strong> přidal do TNG 10.0.3 Ken Roy a zobrazuje protokol manažeru módů, který je nyní oddělen od protokolu administrace.  
        Protokol manažeru módů pro snadnější čitelnost akcí přeformátoval Rick Bisbee.</p>    
        <p>Další informace můžete najít v článku 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager" target="_blank">Manažer módů</a> a v kategorii článků 
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
        <p>Manažer módů prozkoumá složku módů a přečte každý soubor <strong>cfg</strong>, který najde. Soubory <strong>cfg</strong> jsou direktivní soubory, které popisují mód, soubory a umístění, které má být modifikováno, a kód, který je při modifikaci použit. 		
          <p>Manažer módů zkontroluje následující: 			
            <ul>				
              <li>zajistí, že je uživatel přihlášen 				
              <li>prověří umístění a změnu každého kódu 					
              <ul>						
                <li>zajistí, že lze umístění nalézt
                </li>						
                <li>zajistí, že cílové místo je jedinečné
                </li>						
                <li>určí, zda cílové umístění již bylo nainstalováno
                </li>					
              </ul>			
              <li>určí nové soubory, které mají být vytvořeny. Pokud nový soubor již existuje, určí jeho verzi.
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
        <p>Manažer módů vrací následující stavy: 			
          <ul>			
            <li><strong>Lze instalovat</strong>, pokud mód ještě nebyl nainstalován a cílové umístění bylo určeno, pak je uvedena možnost <strong>Instalovat</strong>
            </li>			
            <li><strong>Instalováno</strong>, pokud mód byl nainstalován, je uvedena možnost <strong>Odstranit</strong> mód a možnost <strong>Upravit</strong> parametry, pokud nějaké existují
            </li>			
            <li><strong>Vyčistit</strong>, pokud mód byl částečně nainstalován, je k dispozici tlačítko <strong>Vyčistit</strong>. Operace Vyčištění se pokusí odstranit vložený kód, obnovit a nahradit kód, a odstranit vytvořený soubor.
            </li>			
            <li><strong>Nelze nainstalovat</strong>, pokud mód <strong>nelze</strong> instalovat. Tato zpráva bude předcházet jinou zprávu, která poskytne více informací o tom, proč mód nelze nainstalovat.
            </li>			
          </ul>		
          <p>Příklady obrazovek stavu manažeru módů a jak interpretovat různé stavy najdete na 
            <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Interpreting_Status" target="_blank">Manažer módů - interpretace stavů</a>
          </p>	</td>
    </tr>
    <tr class="databack">
      <td class="tngshadow">
        <p style="float:right">
          <a href="#top">Nahoru</a>
        </p>
        <a name="syntax">
          <p class="subheadbold">Syntaxe módů
          </p></a>
        <p>The Mod Manager syntax basically includes:
        <p><strong>Sekce záhlaví</strong>, která obsahuje</p>
				<ul><li>Název - název módu, článek na TNG Wiki a název souboru</li>
				<li>Verze - verze módu, kde první 3 číslice představují nejnižší verzi TNG, ve které mód funguje</li>
				<li>Popis - obsahuje stručný popis módu, jméno vývojáře a URL článku o daném módu na TNG Wiki.</li>
				</ul>
				</p>
			<p><strong>Cílové sekce (Target)</strong>, kde je specifikován soubor, který je opravným módem změněn, a obsahuje tyto příkazy</p>
			<ul><li>Location - určuje umístění kódu, který je v souboru měněn</li>
			<li>Klíčové slovo akce - určuje, zda přepsat (Replace) nebo vložit (Insert) kód před (Before) nebo za (After) toto umístění</li>
			</ul>
			</p>
			<p><strong>Příkaz Nový soubor (New File)</strong>, který po instalaci módu vytvoří nový soubor</p>
			<p><strong>Příkaz Kopírovat soubor (Copy File)</strong>, který nakopíruje určitý soubor do řídící složky TNG (%copyfile) nebo do podsložky (%copyfile2)</p>
			<p>Detailní informace týkající se syntaxe módů najdete v článku <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Syntax" target="_blank">Mod Manager Syntax (v angličtině)</a></p>
      </td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">		
        <p style="float:right">
          <a href="#top">Nahoru</a>
        </p>		
        <a name="files">
          <p class="subheadbold">Konfigurační soubory
          </p></a>		
        <span class="optionhead">Instalování módů
        </span>		
        <p>Informace o použití 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Installing_Config_Files" target="_blank">konfiguračních souborů</a> k instalaci módů najdete na TNG Wiki.
        </p>		 		
        <span class="optionhead">Interpretace stavu
        </span>		
        <p>Informace o 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Creating_Config_Files" target="_blank">interpretaci stavu</a> najdete na TNG Wiki.
        </p>		 		
        <span class="optionhead">Syntaxe konfiguračních souborů
        </span>		
        <p>Informace o 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Config_File_Syntax" target="_blank">syntaxi konfiguračních souborů</a> najdete na TNG Wiki.
        </p>		 		
        <span class="optionhead">Vytvoření konfiguračního souboru
        </span>		
        <p>Informace pro vývojáře o 
          <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_-_Creating_Config_Files" target="_blank">vytvoření konfiguračních souborů</a> najdete na TNG Wiki.
        </p>	</td>
    </tr>
    
    <tr class="databack">
      <td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="batch"><p class="subheadbold">Dávková instalace</p></a>

		<p>Dávková instalace umožní provést specifické akce týkající se několika módů pomocí výběru filtru.  Z filtru seznamu stavů vyberte požadovaný stav a kliknutím na Provést zobrazíte
    dostupná ovládací tlačítka pro vybraný stav.  Pro stav Vyčistit není k dispozici akce Odstranit, takže pro odstranění módů ve stavu Vyčistit musíte použít záložku Seznam módů.
		<p>Možnosti výběrového filtru jsou tyto:
			<ul>
				<li><strong>Vše</strong> - zobrazí se úplný seznam všech souborů .cfg ze složky mods.  Pokud zvolíte určitý stav, objeví se dostupná tlačítka jednotlivých akcí
				<li><strong>Lze nainstalovat</strong> - zobrazí se seznam všech módů, které mohou být</li>
					<ul>
						<li>Nainstalovány - na základě vašeho výběru a kliknutím na tlačítko <strong>Instalovat</strong></li>
						<li>Vymazány ze složky mods - na základě vašeho výběru a kliknutím na tlačítko <strong>Vymazat</strong></li>
					</ul>
				<li><strong>Instalováno</strong> - zobrazí se seznam všech módů, které jsou aktuálně nainstalovány, a mohou být</li>
					<ul>
						<li>Odstraněny - na základě vašeho výběru a kliknutím na tlačítko <strong>Odstranit</strong></li>
					</ul>
				<li><strong>Vyčistit</strong> - zobrazí se seznam všech módů, které mohou být</li>
					<ul>
						<li>Vyčištěny - na základě vašeho výběru a kliknutím na tlačítko <strong>Vyčistit</strong></li>
					</ul>
				<li><strong>Nelze nainstalovat</strong> - zobrazí se seznam všech módů, které nelze nainstalovat z důvodu chybného cílového souboru nebo chybějících souborů, a mohou být</li>
					<ul>
						<li>Vymazány ze složky mods - na základě vašeho výběru a kliknutím na tlačítko <strong>Vymazat</strong></li>
					</ul></ul></p></p>
      </td>
    </tr>

<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Nahoru</a></p>
		<a name="options"><p class="subheadbold">Možnosti</p></a>

		<p>Možnosti vám umožní specifikovat chování manažeru módů v případě
		<p><strong>Seznamu dotčených souborů</strong> 
			<ul>
				<li><strong>Zobrazit seznam dotčených souborů</strong> - umožní vám zvolit, zda chcete v tabulce seznamu módů zobrazit seznam dotčených souborů.  Výchozí volbou je <strong>Ano</strong>.</li>
				<li><strong>Zobrazit v seznamu nové soubory</strong> - zobrazí nové soubory vytvořené módem.  Výchozí volbou je <strong>Ano</strong>.</li>
				<li><strong>Zobrazit v seznamu kopírované soubory</strong> - zobrazí soubory, které jsou kopírovány módem. Výchozí volbou je <strong>Ano</strong>.</li>
				<li><strong>Zobrazit seznam ve sloupci</strong> - zobrazí seznam dotčených souborů ve zvoleném sloupci.  Výchozí volbou je sloupec <strong>Název konfiguračního souboru</strong>.</li>
				<li><strong>Zobrazit seznam jako</strong> - umožní vám zvolit, zda chcete seznam zobrazit jako tabulku nebo jako hodnoty oddělené čárkou.  Výchozí volbou je <strong>Tabulka</strong>.</li>
				<li><strong>Zobrazit seznam v Dávkové instalaci</strong> - umožní vám zvolit, zda chcete seznam zobrazit na záložce Dávková instalace ve vyskakovacím okně.  Výchozí volbou je <strong>Ano</strong>.</li>
			</ul></p>
		<p><strong>Protokolu manažeru módů</strong> 
			<ul>
				<li><strong>Zaznamenávat akce manažeru módů</strong> - umožní vám zvolit, zda chcete zaznamenávat potvrzení a akce manažeru módů.  Výchozí volbou je <strong>Ano</strong>.</li>
				<li><strong>Název protokolu</strong> - umožní vám určit název souboru, který bude použit pro protokol manažeru módů.  Výchozí volbou je <strong>modmgrlog.txt</strong>.</li>
				<li><strong>Maximální počet řádků</strong> - umožní vám určit, kolik řádků bude zachováváno v protokolu. Výchozí volbou je <strong>2000</strong>.</li>
			</ul></p>
		<p><strong>Jiné</strong> 
			<ul>
				<li><strong>Řadit seznamy podle</strong> - umožní vám zvolit, podle kterého sloupce bude řazen Seznam módů a Dávková instalace.  Výchozí volbou je <strong>Název konfiguračního souboru</strong>.</li>
				<li><strong>Vynechat potvrzení</strong> - umožní vám zvolit, zda chcete vynechat zobrazení obrazovky Potvrzení v Seznamu módů.  I když zvolíte Ano, Potvrzení bude stále zapisováno do protokolu.  Výchozí volbou je <strong>Ne</strong>.</li>
				<li><strong>Vynechat zprávy o akcích</strong> - umožní vám zvolit, zda chcete vynechat zobrazení obrazovky Zpráva o akci v Seznamu módů.  I když zvolíte Ano, Zpráva o akci bude stále zapisována do protokolu.  Výchozí volbou je <strong>Ne</strong>.</li>
			</ul></p></p>
	</td>
</tr>


    
  </table>
</body>
</html>
