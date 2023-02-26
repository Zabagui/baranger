<?php
include("../../helplib.php");
echo help_header("Nápovìda: Osoby");
?>

<body class="helpbody">
  <a name="top"></a>
  <table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
    <tr class="fieldnameback">	
      <td class="tngshadow">		
        <p style="float:right; text-align:right" class="smaller menu">			
          <a href="http://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp; 			
          <a href="http://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />			
          <a href="index_help.php" class="lightlink">&laquo; Nápovìda: Zaèínáme</a> &nbsp; | &nbsp; 			
          <a href="families_help.php" class="lightlink">Nápovìda: Rodiny &raquo;</a>		
        </p>		
        <span class="largeheader">Nápovìda: Osoby
        </span>		
        <p class="smaller menu">			
          <a href="#search" class="lightlink">Hledat</a> &nbsp; | &nbsp; 			
          <a href="#add" class="lightlink">Pøidat novou</a> &nbsp; | &nbsp; 			
          <a href="#edit" class="lightlink">Upravit existující</a> &nbsp; | &nbsp; 			
          <a href="#delete" class="lightlink">Vymazat</a> &nbsp; | &nbsp; 			
          <a href="#review" class="lightlink">Pøezkoumat</a> &nbsp; | &nbsp; 			
          <a href="#merge" class="lightlink">Slouèit</a>		
        </p>	</td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">		
        <a name="search">
		<div id="google_translate_element" style="float:right"></div><script type="text/javascript">
		function googleTranslateElementInit() {
		  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
		}
		</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
        <p class="subheadbold">Hledat</p></a>    
        <p>Nalezení existujících osob vyhledáním celého nebo èásti <strong>ID èísla osoby</strong> nebo <strong>Jména</strong>. Pro dal¹í zú¾ení va¹eho 
        hledání vyberte strom nebo jednu z dal¹ích mo¾ností. 		
        Výsledkem hledání bez zadaných voleb a hodnot ve vyhledávacích polích bude seznam v¹ech osob ve va¹í databázi.</p>		
        <p>Vyhledávací kritéria, která zadáte na této stránce, budou uchována, dokud nekliknete na tlaèítko <strong>Obnovit</strong>, které znovu obnoví 
        v¹echny výchozí hodnoty.</p>		
        
        <span class="optionhead">Akce</span>		
        <p>Tlaèítko Akce vedle ka¾dého výsledku hledání vám umo¾ní upravit, vymazat nebo otestovat výsledek. Chcete-li najednou vymazat více osob, za¹krtnìte políèko ve sloupci 		
        <strong>Vybrat</strong> u ka¾dého záznamu, která má být odstranìn, a poté kliknìte na tlaèítko "Vymazat 
        oznaèené" na zaèátku seznamu. Pro za¹krtnutí nebo vyèi¹tìní v¹ech výbìrových políèek najednou     
        mù¾ete pou¾ít tlaèítka <strong>Vybrat v¹e</strong> nebo <strong>Vyèistit v¹e</strong>.
        </p>	
        
        </td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">
      		
        <p style="float:right"><a href="#top">Nahoru</a></p>		
        <a name="add"><p class="subheadbold">Pøidat novou osobu</p></a>		   	
        <p>Chcete-li pøidat novou osobu, kliknìte na zálo¾ku <strong>Pøidat nové</strong> a poté vyplòte formuláø. Dal¹í informace jako poznámky, citace, spojení a  		
        dal¹í události, mù¾ete pøidat po ulo¾ení nebo zamknutí záznamu. Význam jednotlivých polí je následující:</p>
        		
        <span class="optionhead">Strom</span>		
        <p>Pokud máte pouze jeden strom, vybrán bude v¾dy tento strom. Jinak, prosím, pro novou osobu vyberte po¾adovaný strom.</p>
        		
        <span class="optionhead">Vìtev (volitelné)</span>		
        <p>Pøipojení osoby ke "vìtvi" omezí pøístup k informacím o osobì pro u¾ivatele, kteøí jsou spojeni k té¾e vìtvi. Je-li definována alespoò jedna vìtev 		
        a vá¹ u¾ivatelský úèet není spojen se ¾ádnou konkrétní vìtví, mù¾ete novou osobu pøipojit k více existujícím vìtvím. Chcete-li vìtev vybrat, 		
        kliknutím na odkaz "Upravit" se otevøe box se v¹emi vìtvemi ve vybraném stromì. Pro výbìr více vìtví pou¾ijte klávesu Control (Windows) nebo Command (Mac). 		
        Po dokonèení va¹eho výbìru pøesuòte kursor my¹i mimo okno úprav a toto okno zmizí.</p>
        		
        <span class="optionhead">ID èíslo osoby</span>		
        <p>ID èíslo osoby musí být jednoznaèné uvnitø vybraného stromu a mìlo by se skládat z velkého písmene <strong>I</strong> následovaného èíslem (nejvíce 21 èíslic). 		
        Pøi prvním zobrazení stránky a kdykoli je vybrán jiný strom, bude doplnìno volné a jednoznaèné èíslo, ale pokud chcete, mù¾ete vlo¾it své vlastní ID èíslo. 		
        Chcete-li zkontrolovat, zda je va¹e ID èíslo jednoznaèné, kliknìte na tlaèítko <strong>Zkontrolovat</strong>. Objeví se zpráva, která vám sdìlí, zda je ji¾ ID èíslo pou¾ito nebo ne. 		
        Chcete-li vygenerovat dal¹í jednoznaèné èíslo, kliknìte na <strong>Vygenerovat</strong>. Bude zji¹tìno nejvy¹¹í èíslo ve va¹í databázi a pøidána 1. 		
        Chcete-li zajistit, ¾e zobrazení ID èíslo není nárokováno jiným u¾ivatelem, zatímco vy zapisujete data, kliknìte na tlaèítko <strong>Zamknout</strong>.</p>
        		
        <p><strong>POZN.</strong>: Pou¾íváte-li tento program spolu s genealogickým programem pracujícím na platformách PC nebo Mac, který u nových osob vytváøí také ID èísla, 		
        DÙRAZNÌ DOPORUÈUJEME v¹echny tato èísla v¾dy mezi tìmito programy synchronizovat. Výsledkem zanedbání této èinnosti mohou být kolize a nepou¾itelnost 		
        odkazù na va¹e média. Pokud vá¹ primární program vytváøí ID èísla, která neodpovídají tradièním standardùm (napø.  		
        <strong>I</strong> je na konci a ne na zaèátku), mù¾ete konvence, které TNG pou¾ívá, zmìnit v Základním nastavení.</p>
        		
        <span class="optionhead">Jméno</span>		
        <p>Zapi¹te køestní jméno a/nebo pøíjmení osoby. Druhá jména by mìla být vlo¾ena do køestního jména. Pokud jste nastavili podporu 		
        pøedpon pøíjmení jako oddìlených subjektù (pøedpony budou bìhem tøídìní ignorovány), zapi¹te pøedponu do pole oznaèeného jako Pøedpona pøíjmení. 		
        <strong>Pozn.:</strong> Pokud toto pole není viditelné, pøejdìte do Nastavení/Základní nastavení a za¹krtnìte volbu o pou¾ití pøedpon pøíjmení.</p>		
        
        <span class="optionhead">Pøezdívka / Titul / Pøedpona / Pøípona / Poøadí jména a pøíjmení</span>		
        <p>Zapi¹te tolik údajù, kolik jich znáte. <strong>Pøezdívka</strong> je neformální jméno spojené nìkdy s osobou. 		
        <strong>Titul</strong> se pou¾ívá pøed jménem (napø. <em>Ing.</em> nebo <em>MUDr.</em>), ale není souèástí jména. <strong>Pøedpona</strong> se pou¾ívá pøed jménem a obvykle je souèástí 		
        jména. <strong>Pøípona</strong> se pou¾ívá za jménem (napø. <em>CSc.</em> nebo <em>MBA</em>). <strong>Poøadí jména a pøíjmení</strong> mù¾ete pou¾ít pro zmìnu zobrazení poøadí. 		
        Poøadí jména a pøíjmení pro v¹echny osoby v databázi mù¾ete zmìnit v Nastavení/Základní nastavení.</p>

        <span class="optionhead">Pohlaví</span>
        <p>Vyberte Neznámý, Mu¾, ®ena nebo Jiné. Je-li zvoleno Jiné, objeví se vpravo nové pole, do kterého mù¾ete zadat preferovaný popis pohlaví.</p>
         		
        <span class="optionhead">®ijící</span>		
        <p>Pokud tato osoba ¾ije nebo si pøejete omezit pøístup k údajùm této osoby pouze na u¾ivatele, kteøí jsou pøihlá¹eni a mají práva zobrazovat data ¾ijících osob, 		
        za¹krtnìte toto políèko.</p>
        		
        <span class="optionhead">Neveøejné</span>		
        <p>Bez ohledu na to, zda tato osoba ¾ije nebo ne, mù¾ete pøístupová práva k údajùm této osoby omezit za¹krtnutím této volby. 		
        Informace spojené s "neveøejnou" osobou budou moci vidìt pouze u¾ivatelé s právy zobrazovat neveøejná data.</p>
        	
        <span class="optionhead">Události</span>		
        <p>Zapi¹te data a místa k zobrazeným standardním událostem (pokud je znáte). Dal¹í události lze pøidat po ulo¾ení a zamknutí záznamu. Data v¾dy zapisujte 		
        ve standardním genealogickém formátu DD MMM RRRR (napø. <em>18 Úno 2008</em>). Informaci o místì øaïte za sebou od místního po obecnou a oddìlujte ka¾dý údaj èárkou 		
        (napø. <em>Bludov, ©umperk, Olomoucký kraj, Èeská republika</em>), nebo kliknutím na ikonu "Najít" vyberte existující místo (lupa). 		
        Chcete-li omezit poèet nalezených výsledkù, pøed kliknutím na ikonu Najít zapi¹te èást místa. V¹echny výsledky budou obsahovat to, co jste zapsali jako název místa.</p>		

        <p>Poznámka k událostem alternativního narození: Výchozí alternativní typ události narození je "Køtiny". Pole Køest mù¾e být zcela vypnuto v Nastavení/Základní nastavení/Vzhled a definice stránek, ale mù¾ete zde také zadat tagy GEDCOM pro jiné alternativní události narození. Pokud napøíklad zadáte "CHR,BAPM" jako alternativní typ události narození, u¾ivatel se mù¾e rozhodnout, ¾e jako alternativní událost narození pro jednotlivce urèí buï Køest nebo Køest. Poøadí také uvádí, který typ události je preferován jako výchozí.
        
        <p><span class="optionhead">Údaje CJKSpd (Køest, Obdarování, Biømování, Zasvìcení)</span><br />		
        Tyto události jsou spojeny s obøady provádìnými Církví Je¾í¹e Krista Svatých posledních dní (mormonská církev, která vytvoøila standard GEDCOM). 		
        <strong>Pozn.:</strong> Nechcete-li vidìt pole spojené s CJKSpd, jdìte na Nastavení/Základní nastavení/Ochrana údajù a zde tuto mo¾nost vypnìte (je tøeba se pak odhlásit a znovu pøihlásit).</p>	

        </td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">
      
        <p style="float:right"><a href="#top">Nahoru</a></p>
        <a name="edit"><p class="subheadbold">Upravit existující osobu</p></a>		
        <p>Chcete-li upravit existující osobu, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení osoby, a poté kliknìte na ikonu Upravit vedle této osoby.</p>		

        <span class="optionhead">Poznámky / Citace / Spojení / "Více"</span>		
        <p>Poznámky, citace a spojení lze pøipojit k událostem nebo osobì obecnì kliknutím na pøipojené ikony v horní èásti stránky 		
        nebo vedle ka¾dé události. Ke ka¾dé události mù¾ete také pøidat "více" informací kliknutím na ikonu "Plus". Pokud v nìjaké této kategorii existují údaje, 		
        na odpovídající ikonì bude v horním pravém rohu zelená teèka. Chcete-li znát více informací o ka¾dé kategorii, jdìte na odkazy nápovìdy, 		
        které budou viditelné po kliknutí na tyto ikony.</p>
        		
        <span class="optionhead">Jiné události / atributy</span>		
        <p>Chcete-li pøidat dal¹í události, kliknìte na tlaèítko "Pøidat nové" vedle <strong>Jiné události / atributy</strong>. Viz odkaz <a href="events_help.php">Nápovìda</a> pro více 		
        informací o pøidání nových událostí / atributù. Po pøidání události / atributu se pod tlaèítkem "Pøidat nové" zobrazí v tabulce krátké shrnutí. Tlaèítka akcí 		
        pro ka¾dou událost vám umo¾ní událost upravit nebo odstranit, nebo pøidat poznámky nebo citace. Poøadí, ve kterém se události zobrazí, závisí na datu (je-li zapsáno) 		
        a prioritì, kterou má daný typ události (není-li pøipojeno datum). Pøi úpravì typu události mù¾ete prioritu zmìnit. 		
        
        <p><strong>Poznámka</strong>: Poznámky, citace pramenù, spojení, "jiné" události a "více" informací se ukládá u standardních automaticky. Jiné zmìny (napø. jméno nebo 		
        standardní události) se ulo¾í kliknutím na tlaèítko Ulo¾it na konci stránky nebo kliknutím na ikonu Ulo¾it na stránce nahoøe. Strom a 		
        ID èíslo osoby nelze zmìnit.</p>
        		
        <span class="optionhead">Rodièe</span>		
        <p>Pokud má aktuální osoba rodièe, pod sekcí Události se bude nacházet sekce <strong>Rodièe</strong>. Sekce bude na zaèátku zobrazena jako zú¾ená a v závorkách bude 		
        poèet párù rodièù). Chcete-li sekci roz¹íøit a zobrazit v¹echny páry rodièù, kliknìte na slovo "Rodièe" nebo na ¹ipku vedle. Nìkteré údaje, vèetnì povahy 		
        vztahu mezi aktuální osobou a ka¾dým párem rodièù lze upravit v ka¾dém bloku. Pokud jste kurzorem my¹i nad párem rodièù, bude v horním pravém rohu      
        viditelná volba <strong>Odpojit</strong>. Chcete-li aktuální osobu odpojit od tohoto páru rodièù, kliknìte na tento odkaz.</p>
        	
        <p>Nový pár rodièù k aktuální osobì mù¾ete pøidat kliknutím na odkaz <strong>Pøidat nové</strong> vedle sekce 		
        Rodièe. V tomto okam¾iku se vám zobrazí zpráva, která se vás zeptá, zda chcete ulo¾it nejdøíve va¹e zmìny ("OK" nebo "Storno").  		
        Pokud vyberete "OK", stránka bude ulo¾ena a octnete se na stránce Nová rodina s aktuální osobou jako dítìtem. 		
        Pokud zvolíte "Storno", neulo¾í se ¾ádné zmìny, ale stejnì budete nasmìrováni na stránku Nová rodina s aktuální osobou jako dítìtem. 		
        Pak budete mít mo¾nost zadat nebo vybrat nové rodièe a podrobnosti o nové rodinì.</p>
        		 		
        <p>Nové rodièe mù¾ete pøidat také výbìrem volby "Pøejít na novou rodinu s touto osobou jako dítìtem" na konci stránky.</p>
        		 		
        <span class="optionhead">Man¾elé/Partneøi</span>    
        <p>Pokud má aktuální osoba nìjakého partnera, pod sekcí Rodièe se bude nacházet sekce <strong>Man¾elé/Partneøi</strong> . Sekce bude na zaèátku zobrazena jako zú¾ená a v závorkách bude 		
        poèet párù man¾elù/partnerù). Chcete-li sekci roz¹íøit a zobrazit v¹echny partnery, kliknìte na slova "Man¾elé/Partneøi" nebo na ¹ipku vedle. Pokud jste kurzorem my¹i nad partnerem, bude v horním pravém rohu      
        viditelná volba <strong>Odpojit</strong> . Chcete-li aktuální osobu odpojit od tohoto partnera, kliknìte na tento odkaz.</p>
        	 	
        <p>Nového partnera aktuální osoby mù¾ete pøidat kliknutím na odkaz <strong>Pøidat nové</strong> vedle sekce 		
        Partneøi. V tomto okam¾iku se vám zobrazí zpráva, která se vás zeptá, zda chcete ulo¾it nejdøíve va¹e zmìny ("OK" nebo "Storno").  		
        Pokud vyberete "OK", stránka bude ulo¾ena a octnete se na stránce Nová rodina s aktuální osobou jako man¾elem nebo man¾elkou (podle pohlaví dané osoby). 		
        Pokud zvolíte "Storno", neulo¾í se ¾ádné zmìny, ale stejnì budete nasmìrováni na stránku Nová rodina s aktuální osobou jako partnerem. 		
        Pak budete mít mo¾nost zadat nebo vybrat nového partnera a podrobnosti o nové rodinì.</p>
          		     
        <p>Nového partnera mù¾ete pøidat také výbìrem volby "Pøejít na novou rodinu s touto osobou jako partnerem" na konci stránky.</p>
        		 		
        <span class="optionhead">Poøadí rodièù nebo partnerù</span>        	
        <p>Pokud existuje více partnerù nebo párù rodièù, 		
        mù¾ete jejich poøadí zmìnit "pøeta¾ením" blokù nahoru nebo dolù. Chcete-li blok pøetáhnout, kliknìte my¹í na tlaèítko "Táhnout", toto tlaèítko podr¾te, a va¹i my¹ pøesuòte na stránce nahoru 		
        nebo dolù. Po pøesunu bloku do po¾adované pozice tlaèítko pus»te. Zmìny poøadí budou automaticky ulo¾eny.</p>	
        
        </td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">
      		
        <p style="float:right"><a href="#top">Nahoru</a></p>		
        <a name="delete"><p class="subheadbold">Vymazat osobu</p></a>   	
        <p>Chcete-li odstranit osobu, pou¾ijte zálo¾ku <a href="#search">Hledat</a> pro nalezení dané osoby, a poté kliknìte na ikonu Vymazat vedle této osoby. Tento øádek zmìní 		
        barvu a poté po odstranìní polo¾ky zmizí.  Chcete-li najednou odstranit více osob, za¹krtnìte políèko ve sloupci Vybrat vedle ka¾dé osoby, kterou     
        chcete odstranit, a poté kliknìte na tlaèítko "Vymazat vybrané" na stránce nahoøe</p>	
        
        </td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">
      		
        <p style="float:right"><a href="#top">Nahoru</a></p>		
        <a name="review"><p class="subheadbold">Pøedbì¾né prohlédnutí úprav</p></a>    
          Chcete-li si pøedbì¾nì prohlédnout zmìny provedené ostatními u¾ivateli, kliknìte na zálo¾ku "Pøezkoumat". Mù¾ete se pak rozhodnout, zda tyto navrhované zmìny ulo¾íte nebo odstraníte.     
          Zmìny mù¾ete prohlédnout podle stromu nebo podle u¾ivatele nebo podle obojího. Po ulo¾ení navrhovaných zmìn není zaslán ¾ádný mail, ale pokud nové zmìny existují, na zálo¾ce Pøezkoumat se objeví hvìzdièka (*).</p>		

        <span class="optionhead">Vybrat událost a akci</span><br />		
        <p>V tabulce, která popisuje události, které si pøejete pøezkoumat nebo odstranit, vyberte øádek. Seznam výsledkù mù¾ete zú¾it výbìrem u¾ivatele (osoba 		
        odpovìdná za navrhované zmìny) a/nebo strom. Po zobrazení výsledkù kliknìte na jednu z mo¾ných akcí nalevo od tohoto øádku. Chcete-li zmìny pøezkoumat a 		
        pøípadnì zaèlenit do databáze, vyberte <em>Pøezkoumat</em>. Chcete-li navrhované zmìny zamítnout, vyberte <em>Odstranit</em>.</p>		
  
        <span class="optionhead">Pøezkoumat</span><br />		
        <p>Na obrazovce Pøezkoumat mù¾ete provést dal¹í potøebné zmìny, vèetnì poznámek a pramenù, a poté kliknìte na "Ulo¾it a vymazat" pro 		
        ulo¾ení do databáze a odstranìní doèasného záznamu. Kliknutím na "Odmítnout a vymazat" mù¾ete rovnì¾ odstranit doèasný záznam, ani¾ byste jej ulo¾ili, 		
        nebo mù¾ete své rozhodnutí odlo¾it na pozdìj¹í dobu kliknutím na "Odlo¾it".</p>	
        
        </td>
    </tr>
    <tr class="databack">	
      <td class="tngshadow">
      		
        <p style="float:right"><a href="#top">Nahoru</a></p>		
        <a name="merge"><p class="subheadbold">Slouèení osob</p></a>		
          Chcete-li pøezkoumat a slouèit duplicitní záznamy, kliknìte na zálo¾ku "Slouèit". Zde rozhodnete, zda jsou dva záznamy toto¾né nebo ne.</p>		

        <span class="optionhead">Najít shodu</span><br />		
        <p>Vyberte nejprve strom. Nelze sluèovat osoby z rùzných stromù, vybrán musí být pouze jeden strom. Potom máte mo¾nost vybrat osobu jako 		
        výchozí bod va¹eho hledání (osoba 1) nebo nechat, aby první shodu osob za vás nalezl TNG. Chcete-li, aby TNG nalezl v¹echny zmìny, nechte pole ID èíslo osoby 1 prázdné</p>		
     
        <p>Pokud jste vybrali osobu jako Osobu 1, mù¾ete také ruènì vybrat ID èíslo osoby 2. Chcete-li, aby duplicity Osoby 1 nalezl TNG, nechte pole ID èíslo osoby 2 prázdné.</p>		
 
        <span class="optionhead">Porovnat následující pole</span><br />		
        <p>Toto jsou kritéria, která TNG pou¾ívá k urèení mo¾ných duplicit. Standardnì jsou vybrány køestní jméno a pøíjmení, co¾ znamená, ¾e tato pole 		
        musí být shodná, aby mohly být dva záznamy pova¾ovány za potenciálnì duplicitní. Vyberete-li také datum narození, místo narození, datum úmrtí a/nebo místo úmrtí, musí být také tato pole shodná.</p>		

        <span class="optionhead">Jiné mo¾nosti</span><br />        

        <p><em>Odmítnout prázdné</em> znamená, ¾e prázdná pole nebudou brána v potaz. Napø. nìkdo s pøíjmením, ale bez vyplnìného køestního jména 		
        nebude brán jako shodný s jiným záznamem, pokud je køestní jméno mezi vybranými kritérii.</p>
                
        <p><em>Pou¾ít Soundex</em> znamená, ¾e pøi porovnávání jmen bude pou¾ita funkce MySQL Soundex. V tomto pøípadì bude 		
        text "Blakely" pova¾ován za shodný s textem "Blackley".</p> 
               
        <p><em>Slouèit poznámky &amp; citace</em> znamená, ¾e poznámky a citace osoby 2 budou pøidány k poznámkám a citacím 		
        osoby 1 u v¹ech sluèovaných polí. Není-li tato volba vybrána a pole osoby 2 je za¹krtnuto, poznámky a citace osoby 2 k tomuto poli budou pøepsány 		
        záznamy z odpovídajícího pole osoby 1.</p>
        		
        <p><em>Slouèit média</em> znamená, ¾e fotografie a historie osoby 2 budou zachovány a pøidány k ji¾ existujícím 		
        u osoby 1, pokud budou tyto dvì osoby slouèeny. Není-li tato volba vybrána, v¹echny odkazy na fotografie, historie a náhrobky osoby 2 budou po slouèení odstranìny.</p>		
        
        <p><span class="optionhead">Varování!</span> Pokud probìhlo slouèení, nelze jej vzít zpìt! <em>Pøed zahájením operace sluèování proto v¾dy zazálohujte své databázové tabulky</em>    
          pro pøípad, ¾e byste dvì osoby slouèili omylem.</p>		
        
        <span class="optionhead">Dal¹í shoda</span><br />		
        <p>Najde dal¹í mo¾né porovnání, která nezahrne osobu 1. TNG postoupí seznamem mo¾ných osob v tøídìní podle ID èísla v textovém formátu. 		
        Znamená to, ¾e "10" bude po "1", ale pøed "2".</p>		

        <span class="optionhead">Dal¹í duplicita</span><br />		
        <p>Najde dal¹í mo¾nou duplicitu k osobì 1. Pokud výsledkem není záznam, který byl zobrazen u osoby 2, znamená to, ¾e duplicita nebyla nalezena.</p>		
        
        <span class="optionhead">Porovnat/Obnovit</span><br />		
        <p>Porovnání osoby 1 a osoby 2. Je-li toto porovnání ji¾ zobrazeno, kliknutí na toto tlaèítko zpùsobí obnovení stránky.</p>
        		
        <span class="optionhead">Prohodit</span><br />		
        <p>Osoba 1 se stane osobou 2 a naopak.</p>
        		
        <span class="optionhead">Slouèit</span><br />		
        <p>Osoba 2 bude slouèena s osobou 1. ID èíslo osoby 1 bude zachováno, stejnì jako ostatní údaje osoby 1, pokud nejsou za¹krtnuta odpovídající políèka 		
        u osoby 2. Napø. pokud je u osoby 2 za¹krtnuto políèko vedle data narození, bude bìhem slouèení údaj z tohoto pole zkopírován ze záznamu osoby 2 do záznamu osoby 1. 		
        Odpovídající údaj osoby 1 bude smazán. Políèka u osoby 2 jsou automaticky za¹krtnuta, pokud u osoby 1 nejsou odpovídající údaje. Není-li 		
        pole zobrazeno ani u jedné osoby, pak v tomto poli neexistuje ¾ádný údaj.</p>
        		
        <span class="optionhead">Upravit</span><br />		
        <p>Úprava záznamu osoby v novém oknì. Po provedení zmìn musíte kliknout na Porovnat/Obnovit, aby se zmìny projevily na obrazovce Slouèení.</p>	
        
        </td>
    </tr>
  </table>
</body>
</html>
