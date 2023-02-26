<?php
include("../../helplib.php");
echo help_header("Help: Nápověda módů");
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
		<span class="largeheader">Nápověda: Manažer módů</span>
		<p class="smaller menu">
			<a href="#overview" class="lightlink">Přehled</a> &nbsp; | &nbsp;
			<a href="#modlist" class="lightlink">Seznam módů</a> &nbsp; | &nbsp;
			<a href="#editor" class="lightlink">Editor módů</a> &nbsp; | &nbsp;
			<a href="#viewlog" class="lightlink">Zobrazit protokol</a> &nbsp; | &nbsp;
			<a href="#options" class="lightlink">Možnosti</a> &nbsp; | &nbsp;
			<a href="#analyzer" class="lightlink">Analýza souborů TNG</a> &nbsp; | &nbsp;
			<a href="#parser" class="lightlink">Tabulka parseru</a> &nbsp; | &nbsp;
      <a href="#recommended" class="lightlink">Doporučené aktualizace</a> &nbsp; | &nbsp;
			<a href="#credits" class="lightlink">Poděkování</a>
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

		<a name="overview"><p class="subheadbold">Přehled</p></a>

    <p>Pokud jste v TNG noví, Manažer módů je nástroj pro administrátory, který jim umožňuje instalovat, spravovat a odstraňovat úpravy softwarového balíčku TNG, a to buď stažením a instalací „módů“ vytvořených ostatními z TNGWiki, nebo vytvořením vlastních módů (a možná také jejich sdílením).</p>    

    <p><b>Mód</b> je textový soubor s příponou .cfg napsaný pomocí editoru kódu. Obsahuje "příkazy", které říkají Manažeru módů (MM), jak jeho instalací upravit kód v cílových souborech. Může také kopírovat soubory z doprovodné podpůrné složky nebo dokonce vytvářet nové soubory. -- podrobnosti najdete na stránce<i><a href="https://tng.lythgoes.net/wiki/index.php/Mod_Manager" target="_blank"> TNGWiki Mod Manager (v angličtině)</a></i>.</p>

	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="modlist"><p class="subheadbold">Seznam módů</p></a>

    <p>Na stránce Administrace TNG zobrazí Manažer módů (MM) seznam všech modů ve složce „mods“. Tuto složku můžete přejmenovat v Nastavení >> Základní nastavení >> Umístění a složky.</p>    

    <p>Pokud jste ještě žádné módy do složky "mods" na vašem webu nenačetli, bude výpis MM prázdný. Ze stránek TNGWiki si můžete stáhnout stovky modů. Přicházejí ve formě souborů zip, které budete muset rozbalit a nahrát do složky „mods“ na vašem webu pomocí programu FTP, jako je FileZilla nebo WinSCP, který můžete získat zdarma z internetu</p>

    <p>Před zobrazením modů Manažer módů zkontroluje každý z nich, zda je již nainstalován nebo zda jej lze nainstalovat, a hledá chyby, které by bránily jeho <i>instalaci</i> nebo <i>odstranění</i>. Výsledek se zobrazí ve výpisu módu ve sloupci <i>Stav</i>. Podrobnosti zobrazíte kliknutím na ikonu šipky nebo stavový text a poté na tlačítko <i>Podrobnosti</i>.</p>

    <p>Všechny uvedené mody mají barevně označený stav instalace:
      <ul>
        <li>
          <b>Lze instalovat</b> (bílý) -- MM potvrdil, že všechny příkazy v konfiguračním souboru módu lze nainstalovat bez chyby.
        </li>
        <li>
          <b>Instalováno </b> (zelený) -- všechny komponenty z konfiguračního souboru módu jsou nainstalovány.
        </li>
        <li>
          <b>Částečně instalováno</b> (oranžový) -- některé komponenty módu jsou nainstalovány a některé ne. To se může stát, pokud obnovíte soubor TNG, který byl součástí instalace Modu.
        </li>
        <li>
          <b>Nelze nainstalovat</b> (červený) -- některé konfigurační soubory módu nelze nainstalovat, například proto, že cílový soubor chybí.
        </li>
      </ul>
    </p>

    <h3>Panel filtrů</h3>

    <p>V horní části seznamu modů je panel filtrů, který omezuje zobrazení na módy s vybraným stavem nebo na <b>Všechny</b> módy nebo pouze ty, které <b>Vyberete</b>. Výběr libovolného filtru kromě <b>Všech</b> zobrazí seznam se zaškrtávacím políčkem pro každý zobrazený mód. Zaškrtnutí jednoho nebo více polí umožňuje další zpracování vybraných módů.</p>

    <p>Pokud například vyfiltrujete mody, které jsou ve stavu <i>Lze instalovat</i> a poté stisknete <i>Provést</i>, váš seznam bude obsahovat pouze ty módy, které jsou připraveny k instalaci. Pomocí zaškrtávacích políček ve filtrovaném seznamu můžete vybrat jedno, několik nebo všechny z nich, poté stisknout tlačítko Instalovat a módy se nainstalují hromadně. Všimněte si tlačítek <i>Vybrat vše</i> a <i>Vyčistit vše</i>, která vám pomohou se zaškrtávacími políčky.</p>


<p><strong><font color="#990000">Upozornění: Dávkové operace byste měli provádět pouze v případě, že máte dobrou zálohu svých webových stránek a můžete ji rychle obnovit, pokud dávkové operace způsobí nefunkčnost vašeho webu. To se může snadno stát, když neodstraníte předchozí verze modů.</font></strong></p>

  <p><strong>Poznámka: Před upgradem TNG doporučujeme dávkově odinstalovat všechny nainstalované módy a poté dávkově vyčistit všechny zbývající částečně nainstalované módy.</strong></p>

   <p>Filtr <b>Vybrat</b> zobrazí všechny módy a přidá zaškrtávací políčka. Vyberte jeden nebo více z nich a stiskněte tlačítko <i>Vybrat</i>. Manažer módů zobrazí pouze vybrané módy. To může být užitečné pro izolaci a testování jednoho módu bez zobrazení nebo zpracování ostatních.</p>

  <p>Pokud zaškrtnete políčko <b>Zamknout</b> u jakéhokoli filtrovaného záznamu, zůstane filtrovaný i po obnovení stránky. Zápis zůstane uzamčen, dokud jej nezrušíte nebo nepoužijete jiný filtr.</p>

    <h3>Sloupce seznamu módů</h3>

    <p>První tři sloupce jsou samozřejmé. V závislosti na nastavení zobrazení Manažera modů na <i>kartě Možnosti</i> můžete kliknout na Název módu a mód se zobrazí v tabulce parseru. Kliknutím na Název konfiguračního souboru zobrazíte na nové kartě obsah konfiguračního souboru módu.</p>

    <p>Pokud sloupec <b>Wiki</b> obsahuje ikonu wiki (W), můžete na ni kliknout a přejít na článek TNGWiki, který obsahuje popis a další informace o módu a také odkaz ke stažení módu.</p>

    <p>Pátý sloupec je sloupec <b>Stav</b>. Zobrazuje barevně odlišený stav instalace módu, jak je vysvětleno výše. Kliknutím na text stavu se otevře panel s popisem a příslušnými ovládacími prvky pro správu módu. Pokud je k dispozici tlačítko <i>Podrobnosti</i>, můžete vidět podrobný seznam všech akcí, které byly nebo mají být provedeny pro správu módu. Budou zobrazeny všechny chyby.</p>

    <p>Pro pokročilé uživatele jsou chybové zprávy často doprovázeny číslem E. To odkazuje na číslo řádku v souboru MM, kde došlo k chybě. E-čísla v seznamu modů jsou všechna generována souborem classes/modlister.class.php. V blízkosti tohoto čísla řádku se často objeví komentář vysvětlující povahu chyby a návrh možných oprav.</p>

    <p>Pokud se nevyskytnou žádné chyby, jednoduše stiskněte příslušný ovládací prvek pro instalaci nebo odinstalování (odstranění) módu.</p>
    <p>Některé módy jsou částečně nainstalovány. Když uvidíte tento stav, stiskněte tlačítko <i>Vyčistit</i> a MM odstraní všechny nainstalované součásti. Obvykle vám zůstane čistý mód, který lze znovu plně nainstalovat.</p>

  <p>Pokud mód zůstává částečně nainstalován i po několika pokusech o jeho vyčištění, měli byste upozornit vývojáře módu. Chcete-li upozornit vývojáře, klikněte na ikonu Wiki (W) a přejděte na stránku TNGWiki a poté klikněte na odkaz <i>Mod Support</i>. Pokud neexistuje odkaz na podporu, <a href="#morehelp" >kliknutím sem</a> získáte další pomoc.</p>


    <p>Poslední sloupec, <i>Soubory</i>, obsahuje ikonu pro další informace. Umístěte na něj kurzor a vyskakovací okno vám sdělí všechny soubory, které jsou nebo budou upraveny tímto modem.</p>

    <a name="morehelp"><h3>Hledání další pomoci</h3></a>

    <p>Pokud potřebujete další pomoc, ať už se Manažerem módů, nebo s konkrétním módem, můžete provést jednu z následujících akcí:
    <ul>
      <li>Potřebujete-li pomoc s chybami nebo problémy v <b>Manažeru módů</b>
      <ul>
        <li>kontaktujte Rick Bisbee <a href="https://bisbeefamily.com/suggest.php?page=Mod Manager Issues" target="_blank">zde</a></li>
        <li>kontaktujte Ken Roy: <a href="mailto:ken@royandboucher.com?subject=Mod&nbsp;Manager&nbsp;Help">zde</a></li>
      </ul>
      <li>Potřebujete-li pomoc s nějakým módem</li>
        <ul>
          <li>kontaktujte vývojáře modu ze stránky TNGWiki spojené s modem</li>
          <li>přejděte na <a href="https://tng.community/index.php?/forums/" target="_blank"> TNG Fórum</a> a vyhledejte název módu. Pokud nenajdete nic užitečného, můžete si vytvořit účet a zanechat žádost o pomoc na ostatní uživatele.</li>
          <li>použijte <b>Seznam e-mailových diskuzí</b> a položte otázku. <a href="https://tng.lythgoes.net/wiki/index.php/TNG_Discussion_Forums" target="_blank">Začněte kliknutím sem</a>.</li>
        </ul>
    </ul>
    </p>

	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="editor"><p class="subheadbold">Editor módů</p></a>

    <p>Editor modů (parametrů) je přístupný ze stránky se seznamy modů. Pokud má nainstalovaný mód upravitelné parametry, uvidíte to ve sloupci Stav v seznamu modů jako -- <i>Instalováno [Možnosti]</i>. Chcete-li upravit parametry módu, otevřete panel Stav a klikněte na tlačítko "Upravit možnosti". Editovatelné parametry jsou uživatelské možnosti módu, například nastavení barvy pro něco.</p>

    <p>Chování cílového souboru lze řídit hodnotou parametrů. Uživatel módu může být například požádán, aby zadal počet dní, po které si přeje uchovávat určité soubory protokolu.</p>

    <p>Počet parametrů, které může mód použít, není omezen. Každý parametr má výchozí hodnotu zobrazenou na panelu popisu editoru módu vlevo. Panel vpravo obsahuje oblast pro změnu hodnoty parametru. Jsou zde také dvě tlačítka, jedno pro aktualizaci cílového souboru s hodnotou ve vstupním poli a druhé pro resetování parametru na výchozí hodnotu.</p>

    <p><b>Ať už zadáváte řetězce nebo celá čísla, není nutné je uzavírat do uvozovek</b>. Editor módů to zjistí při aktualizaci hodnot.</p>
	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="viewlog"><p class="subheadbold">Zobrazit protokol</p></a>
    <p>V závislosti na uživatelských preferencích na kartě Možnosti se při chybách generovaných během instalace nebo odstranění módu automaticky otevře protokol chyb, takže administrátor může vidět, co se pokazilo. Jinak můžete otevřít protokol a zobrazit podrobnosti o svých operacích.</p>

    <p>Řádek protokolu zobrazuje datum a čas, pokus o operaci, název a verzi módu, výsledek a funkcionáře (správce webu), který operaci provedl.
    </p>

    <p>Chcete-li zobrazit podrobnosti, klikněte na řádek protokolu. Otevře se panel. Každý příkaz (začínající znakem %) zobrazuje číslo řádku v konfiguračním souboru módu, kde byl příkaz proveden, a výsledek.
    </p>

    <p>Jak bylo uvedeno dříve, chyby jsou doprovázeny číslem E odkazujícím na číslo řádku v souboru TNG Manažeru módů, kde k chybě došlo. Pokud k tomu došlo během pokusu o instalaci, E-číslo bude odkazovat na soubor classes/modinstaller.class.php. Když tento soubor otevřete s číslem řádku, často uvidíte poblíž komentář vysvětlující chybu a navrhující řešení.</p>

    <p>Nápovědu k příkazům a jejich použití naleznete na TNGWiki. Můžete také kliknout na odkaz <b>Syntaxe módů</b> přímo pod záložkami Manažera módů na většině obrazovek MM.</p>

</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="options"><p class="subheadbold">Možnosti</p></a>
    <p>Karta <strong>Možnosti</strong> otevře obrazovku uživatelských preferencí rozdělenou do tří částí.</p>
</p>V sekci <b>Protokol Manažeru módů</b> můžete zadat preference týkající se souboru protokolu. Pod <i>Název souboru protokolu</i> můžete ve skutečnosti zadat cestu k serveru, abyste umístili svůj protokol mimo oblast webových stránek, která je přístupná z prohlížeče. Výchozí nastavení je umístit jej do kořenového adresáře TNG.</p>
    <p><b>Nastavení zobrazení</b> je místo, kde můžete zobrazit nebo skrýt karty na stránce Manažeru módů.</p>
    <p><b>Jiné</b> vám umožňuje rozhodnout, jak nakonfigurovat schopnost Manažeru módů mazat mody a jejich podpůrné složky.</p>
    <p>
			<ul>
 				<li><strong>Povolit Vymazat vybrané pro částečně nainstalované módy</strong> - povolí zobrazení tlačítka <strong>Vymazat</strong> v seznamu vybraných Částečně nainstalovaných módů, pomocí kterého lze vymazat více módů najednou, jako např. vymazání předchozích verzí modů, které nebyly vymazány před instalací novější verzí. Výchozí volbou je <strong>Ne</strong>. Tuto volbu doporučujeme povolit pouze v případě, že potřebujete vymazat více modů, aniž byste museli odinstalovat aktuální verze, abyste odstranili předchozí verze módu, když jste zapomněli odinstalovat a vymazat předchozí verze modu před instalací nové verze. Normálně tuto volbu nechte nastavenou na Ne a volbu Ne obnovte po odstranění předchozích verzí módu, které se zobrazují jako částečně nainstalované.</li>
				<li><strong>Povolit Vymazat pro samostatně nainstalované módy</strong> - umožní zapnutí volby zobrazení tlačítka <strong>Vymazat</strong> vedle tlačítka Odinstalovat u samostatně instalovaných módů, např. pro vymazání předchozí verze módu, která nebyla vymazána před instalací novější verze. Výchozí volbou je <strong>Ne</strong>.  Doporučujeme, abyste tuto volbu povolili pouze v případě, kdy je potřeba vymazat předchozí verzi módu, bez nutnosti odinstalování aktuální verze za účelem vymazání předchozí verze, a za normálních okolností ponechte tuto volbu nastavenou na <strong>Ne</strong> a volbu Ne obnovte po odstranění předchozích verzí módu, které se zobrazují jako nainstalované.</li>
				<li><strong>Povolit smazání podpůrné složky po vymazání modu</strong> - umožní zapnutí volby smazání složky (složek) přidružených k módu při mazání módu. Výchozí volbou je <strong>Ne</strong>. Doporučujeme tuto možnost povolit jen tehdy, pokud chápete nebezpečí vymazání nezamýšlených složek. Věříme, že toto riziko je velmi malé.</li>
		</ul>
  </p>
    <p>Nastavte předvolby, jak potřebujete, a stiskněte tlačítko <i>Uložit</i>.</p>
</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="analyzer"><p class="subheadbold">Analýza souborů TNG</p></a>
    <p>Karta <strong>Analýza souborů TNG</strong> je volitelná karta, kterou lze povolit na obrazovce Možnosti.</p>

<p>Toto je pokročilý nástroj, který vám umožňuje vybrat soubor TNG a zobrazit, které módy mění nebo změní tento konkrétní soubor TNG. Pokud se soubor neobjeví v seznamu vlevo, znamená to, že na něj necílí žádné mody.</p>

<p>Když vyberete soubor v levém sloupci, zobrazí se v pravém sloupci s názvy a stavem modů, které jej ovlivní. Odtud můžete kliknout na odkaz "Zobrazit úpravu" a zobrazit skutečnou změnu, kterou provede v cílovém souboru. <i>Není v rozsahu tohoto souboru nápovědy probírat příkazy konfigurace módů a jak fungují</i>. Informace naleznete na TNGWiki.</p>

<p>Pokud jste zvolili na kartě Možnosti, Nastavení zobrazení, „Zobrazit akce v analyzátoru modů“, uvidíte také odkazy, které vám umožní nainstalovat, odinstalovat nebo smazat mód přímo z této obrazovky, v závislosti na aktuálním stavu. </p>
<p>V horní části seznamu uvidíte panel filtrů s výběry pro <i>Všechny mody</i>, <i>Pouze nainstalované mody</i> nebo <i>Instalované+částečně nainstalované mody</i>. Výběrem <i>Pouze nainstalované mody</i> a kliknutím na <i>Odeslat dotaz</i> omezíte soubory v levém sloupci na ty, které jsou ovlivněny pouze aktuálně nainstalovanými mody.</p>

    <p>Tento nástroj je užitečný nejen pro nalezení konfliktů mezi dvěma módy, ale také pro zjištění, které módy je třeba po nahrazení daného cílového souboru vyčistit a znovu nainstalovat. </p>

    <p>The TNG Wiki provides additional information for the mod developers on <a href="https://tng.lythgoes.net/wiki/index.php?title=Using_the_Mod_Analyzer" target="_blank">Using the Mod Analyzer</a>.</p>
    <p>Další informace o <a href="https://tng.lythgoes.net/wiki/index.php?title=Using_the_Mod_Analyzer" target="_blank">Použití analyzátoru módů< /a> poskytuje vývojářům módů TNG Wiki.</p>

</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="parser"><p class="subheadbold">Tabulka parseru</p></a>
    <p>Tento nástroj je určen hlavně pro ladění modů. Tabulka parseru ukazuje, jak Manažer módů zanalyzoval příkazy konfiguračního souboru módu (.cfg). Je to zobrazeno ve formě tabulky, přičemž každý řádek představuje příkaz módu. Data uvedená v tabulce jsou předána dalším skriptům manažeru módů k dalšímu zpracování – instalaci, odstranění atd. Pokud se vyskytne problém s módem, je dobré začít s tabulkou parseru, abyste zjistili, zda jsou všechny příkazy a argumenty módu správně zachyceny.</p>

      <p>Tuto kartu můžete použít k výběru módu ze seznamu, jehož tabulku chcete zobrazit, nebo můžete kliknout na název modu v seznamu módů a zobrazit tabulku parseru pro tento mód, <i>pokud jste povolili možnost Zobrazit další nástroje pro vývojáře</i>.</p>

      <p>Zobrazení této karty je volitelné. Chcete-li jej použít, vyberte na kartě Možnosti „Zobrazit další nástroje pro vývojáře“. Pokud je možnost karty vypnutá, bude také deaktivován odkaz na stránce seznamu.</p>

      <p><i>Není v rozsahu tohoto souboru nápovědy probírat příkazy konfigurace módů a jak fungují</i>. Informace naleznete na TNGWiki.</p>

    </td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="recommended"><p class="subheadbold">Doporučené aktualizace</p></a>
    <p>Záložka <strong>Doporučené aktualizace</strong> je volitelná a lze ji povolit na obrazovce Možnosti. Umožňuje aktualizovat soubory cust_text.php, pokud jste tak neučinili v rámci readme aktualizace TNG. </p>



<p>Další informace (v angličtině) naleznete v článku <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager" target="_blank">Mod Manager</a> a v kategorie článků <a href="https://tng.lythgoes.net/wiki/index.php?title=Category:TNG_Mod_Manager" target="_blank">TNG Mod Manager</a> na TNG Wiki.</p>
<p>V TNG Wiki si můžete prohlédnout článek <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Enhancements" target="_blank">Mod Manager</a> jaká vylepšení byla provedena v TNG v12.</p>

	</td>
</tr>

<tr class="databack">
  <td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="credits"><p class="subheadbold">Poděkování</p></a>

      <table style='table-layout:fixed;width:100%'>
        <tr>
          <td style='width:20%;vertical-align:top;'>
            Brian McFadyen
          </td>
          <td style='width:80%'>
            <ul><li>autor</li></ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Sean Schwoere
          </td>
          <td>
            <ul>
                <li>integrace pro Joomla</li>
                <li>lepší integrace pro instalaci, odebírání a správu módů</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Ken Roy
          </td>
          <td>
            <ul>
                <li>vedoucí vývojového týmu, verze 12 - 14</li>
                <li>vytvořil kartu Zobrazit protokol</li>
                <li>vytvořil kartu Možnosti</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Rick Bisbee
          </td>
          <td>
            <ul>
                <li>vedoucí programátor, verze 12 - 14</li>
                <li>přidal dávkové zpracování</li>
                <li>přidal kartu Zobrazit tabulku parseru</li>
                <li>přidal kartu Analyzovat soubory TNG</li>
                <li>refaktoroval kód TNG pro údržbu, v14</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Jeff Robson
          </td>
          <td>
            <ul>
                <li>beta testovací tým, verze 12</li>
                <li>přidal kartu Ovlivněné soubory</li>
                <li>hlavní příspěvky ke stylu</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
            Robin Richmond
          </td>
          <td>
            <ul>
                <li>beta testovací tým, verze 12</li>
                <li>poskytl kód pro přerušení dlouhých řádků textu bez mezer, který se používá především ve sloupci Stav MM</li>
                <li>hlavní příspěvky k zobrazení protokolu MM</li>
            </ul>
          </td>
        </tr>


        <tr>
          <td style='vertical-align:top;'>
            Michel Kirsh
          </td>
          <td>
            <ul>
                <li>beta testovací tým, verze 14</li>
                <li>hlavní aktualizace Analýzy souborů TNG</li>
            </ul>
          </td>
        </tr>

        <tr>
          <td style='vertical-align:top;'>
              beta testovací tým TNG v14
          </td>
          <td>

            <ul>
                <li>Mogens C. Fenger</li>
                <li>William Herndon</li>
                <li>Michel Kirsch</li>
                <li>Ron Krzmarzick</li>
                <li>Roger Moffat</li>
                <li>Jan-Thore Solem</li>
            </ul>
          </td>
        </tr>
      </table>
  </td>
</tr>
</table>
</body>