<?php
include("../../helplib.php");
echo help_header("Help: Nápovìda módù");
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
		<span class="largeheader">Nápovìda: Mana¾er módù</span>
		<p class="smaller menu">
			<a href="#overview" class="lightlink">Pøehled</a> &nbsp; | &nbsp;
			<a href="#modlist" class="lightlink">Seznam módù</a> &nbsp; | &nbsp;
			<a href="#editor" class="lightlink">Editor módù</a> &nbsp; | &nbsp;
			<a href="#viewlog" class="lightlink">Zobrazit protokol</a> &nbsp; | &nbsp;
			<a href="#options" class="lightlink">Mo¾nosti</a> &nbsp; | &nbsp;
			<a href="#analyzer" class="lightlink">Analýza souborù TNG</a> &nbsp; | &nbsp;
			<a href="#parser" class="lightlink">Tabulka parseru</a> &nbsp; | &nbsp;
      <a href="#recommended" class="lightlink">Doporuèené aktualizace</a> &nbsp; | &nbsp;
			<a href="#credits" class="lightlink">Podìkování</a>
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

		<a name="overview"><p class="subheadbold">Pøehled</p></a>

    <p>Pokud jste v TNG noví, Mana¾er módù je nástroj pro administrátory, který jim umo¾òuje instalovat, spravovat a odstraòovat úpravy softwarového balíèku TNG, a to buï sta¾ením a instalací "módù" vytvoøených ostatními z TNGWiki, nebo vytvoøením vlastních módù (a mo¾ná také jejich sdílením).</p>    

    <p><b>Mód</b> je textový soubor s pøíponou .cfg napsaný pomocí editoru kódu. Obsahuje "pøíkazy", které øíkají Mana¾eru módù (MM), jak jeho instalací upravit kód v cílových souborech. Mù¾e také kopírovat soubory z doprovodné podpùrné slo¾ky nebo dokonce vytváøet nové soubory. -- podrobnosti najdete na stránce<i><a href="https://tng.lythgoes.net/wiki/index.php/Mod_Manager" target="_blank"> TNGWiki Mod Manager (v angliètinì)</a></i>.</p>

	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="modlist"><p class="subheadbold">Seznam módù</p></a>

    <p>Na stránce Administrace TNG zobrazí Mana¾er módù (MM) seznam v¹ech modù ve slo¾ce "mods". Tuto slo¾ku mù¾ete pøejmenovat v Nastavení >> Základní nastavení >> Umístìní a slo¾ky.</p>    

    <p>Pokud jste je¹tì ¾ádné módy do slo¾ky "mods" na va¹em webu nenaèetli, bude výpis MM prázdný. Ze stránek TNGWiki si mù¾ete stáhnout stovky modù. Pøicházejí ve formì souborù zip, které budete muset rozbalit a nahrát do slo¾ky "mods" na va¹em webu pomocí programu FTP, jako je FileZilla nebo WinSCP, který mù¾ete získat zdarma z internetu</p>

    <p>Pøed zobrazením modù Mana¾er módù zkontroluje ka¾dý z nich, zda je ji¾ nainstalován nebo zda jej lze nainstalovat, a hledá chyby, které by bránily jeho <i>instalaci</i> nebo <i>odstranìní</i>. Výsledek se zobrazí ve výpisu módu ve sloupci <i>Stav</i>. Podrobnosti zobrazíte kliknutím na ikonu ¹ipky nebo stavový text a poté na tlaèítko <i>Podrobnosti</i>.</p>

    <p>V¹echny uvedené mody mají barevnì oznaèený stav instalace:
      <ul>
        <li>
          <b>Lze instalovat</b> (bílý) -- MM potvrdil, ¾e v¹echny pøíkazy v konfiguraèním souboru módu lze nainstalovat bez chyby.
        </li>
        <li>
          <b>Instalováno </b> (zelený) -- v¹echny komponenty z konfiguraèního souboru módu jsou nainstalovány.
        </li>
        <li>
          <b>Èásteènì instalováno</b> (oran¾ový) -- nìkteré komponenty módu jsou nainstalovány a nìkteré ne. To se mù¾e stát, pokud obnovíte soubor TNG, který byl souèástí instalace Modu.
        </li>
        <li>
          <b>Nelze nainstalovat</b> (èervený) -- nìkteré konfiguraèní soubory módu nelze nainstalovat, napøíklad proto, ¾e cílový soubor chybí.
        </li>
      </ul>
    </p>

    <h3>Panel filtrù</h3>

    <p>V horní èásti seznamu modù je panel filtrù, který omezuje zobrazení na módy s vybraným stavem nebo na <b>V¹echny</b> módy nebo pouze ty, které <b>Vyberete</b>. Výbìr libovolného filtru kromì <b>V¹ech</b> zobrazí seznam se za¹krtávacím políèkem pro ka¾dý zobrazený mód. Za¹krtnutí jednoho nebo více polí umo¾òuje dal¹í zpracování vybraných módù.</p>

    <p>Pokud napøíklad vyfiltrujete mody, které jsou ve stavu <i>Lze instalovat</i> a poté stisknete <i>Provést</i>, vá¹ seznam bude obsahovat pouze ty módy, které jsou pøipraveny k instalaci. Pomocí za¹krtávacích políèek ve filtrovaném seznamu mù¾ete vybrat jedno, nìkolik nebo v¹echny z nich, poté stisknout tlaèítko Instalovat a módy se nainstalují hromadnì. V¹imnìte si tlaèítek <i>Vybrat v¹e</i> a <i>Vyèistit v¹e</i>, která vám pomohou se za¹krtávacími políèky.</p>


<p><strong><font color="#990000">Upozornìní: Dávkové operace byste mìli provádìt pouze v pøípadì, ¾e máte dobrou zálohu svých webových stránek a mù¾ete ji rychle obnovit, pokud dávkové operace zpùsobí nefunkènost va¹eho webu. To se mù¾e snadno stát, kdy¾ neodstraníte pøedchozí verze modù.</font></strong></p>

  <p><strong>Poznámka: Pøed upgradem TNG doporuèujeme dávkovì odinstalovat v¹echny nainstalované módy a poté dávkovì vyèistit v¹echny zbývající èásteènì nainstalované módy.</strong></p>

   <p>Filtr <b>Vybrat</b> zobrazí v¹echny módy a pøidá za¹krtávací políèka. Vyberte jeden nebo více z nich a stisknìte tlaèítko <i>Vybrat</i>. Mana¾er módù zobrazí pouze vybrané módy. To mù¾e být u¾iteèné pro izolaci a testování jednoho módu bez zobrazení nebo zpracování ostatních.</p>

  <p>Pokud za¹krtnete políèko <b>Zamknout</b> u jakéhokoli filtrovaného záznamu, zùstane filtrovaný i po obnovení stránky. Zápis zùstane uzamèen, dokud jej nezru¹íte nebo nepou¾ijete jiný filtr.</p>

    <h3>Sloupce seznamu módù</h3>

    <p>První tøi sloupce jsou samozøejmé. V závislosti na nastavení zobrazení Mana¾era modù na <i>kartì Mo¾nosti</i> mù¾ete kliknout na Název módu a mód se zobrazí v tabulce parseru. Kliknutím na Název konfiguraèního souboru zobrazíte na nové kartì obsah konfiguraèního souboru módu.</p>

    <p>Pokud sloupec <b>Wiki</b> obsahuje ikonu wiki (W), mù¾ete na ni kliknout a pøejít na èlánek TNGWiki, který obsahuje popis a dal¹í informace o módu a také odkaz ke sta¾ení módu.</p>

    <p>Pátý sloupec je sloupec <b>Stav</b>. Zobrazuje barevnì odli¹ený stav instalace módu, jak je vysvìtleno vý¹e. Kliknutím na text stavu se otevøe panel s popisem a pøíslu¹nými ovládacími prvky pro správu módu. Pokud je k dispozici tlaèítko <i>Podrobnosti</i>, mù¾ete vidìt podrobný seznam v¹ech akcí, které byly nebo mají být provedeny pro správu módu. Budou zobrazeny v¹echny chyby.</p>

    <p>Pro pokroèilé u¾ivatele jsou chybové zprávy èasto doprovázeny èíslem E. To odkazuje na èíslo øádku v souboru MM, kde do¹lo k chybì. E-èísla v seznamu modù jsou v¹echna generována souborem classes/modlister.class.php. V blízkosti tohoto èísla øádku se èasto objeví komentáø vysvìtlující povahu chyby a návrh mo¾ných oprav.</p>

    <p>Pokud se nevyskytnou ¾ádné chyby, jednodu¹e stisknìte pøíslu¹ný ovládací prvek pro instalaci nebo odinstalování (odstranìní) módu.</p>
    <p>Nìkteré módy jsou èásteènì nainstalovány. Kdy¾ uvidíte tento stav, stisknìte tlaèítko <i>Vyèistit</i> a MM odstraní v¹echny nainstalované souèásti. Obvykle vám zùstane èistý mód, který lze znovu plnì nainstalovat.</p>

  <p>Pokud mód zùstává èásteènì nainstalován i po nìkolika pokusech o jeho vyèi¹tìní, mìli byste upozornit vývojáøe módu. Chcete-li upozornit vývojáøe, kliknìte na ikonu Wiki (W) a pøejdìte na stránku TNGWiki a poté kliknìte na odkaz <i>Mod Support</i>. Pokud neexistuje odkaz na podporu, <a href="#morehelp" >kliknutím sem</a> získáte dal¹í pomoc.</p>


    <p>Poslední sloupec, <i>Soubory</i>, obsahuje ikonu pro dal¹í informace. Umístìte na nìj kurzor a vyskakovací okno vám sdìlí v¹echny soubory, které jsou nebo budou upraveny tímto modem.</p>

    <a name="morehelp"><h3>Hledání dal¹í pomoci</h3></a>

    <p>Pokud potøebujete dal¹í pomoc, a» u¾ se Mana¾erem módù, nebo s konkrétním módem, mù¾ete provést jednu z následujících akcí:
    <ul>
      <li>Potøebujete-li pomoc s chybami nebo problémy v <b>Mana¾eru módù</b>
      <ul>
        <li>kontaktujte Rick Bisbee <a href="https://bisbeefamily.com/suggest.php?page=Mod Manager Issues" target="_blank">zde</a></li>
        <li>kontaktujte Ken Roy: <a href="mailto:ken@royandboucher.com?subject=Mod&nbsp;Manager&nbsp;Help">zde</a></li>
      </ul>
      <li>Potøebujete-li pomoc s nìjakým módem</li>
        <ul>
          <li>kontaktujte vývojáøe modu ze stránky TNGWiki spojené s modem</li>
          <li>pøejdìte na <a href="https://tng.community/index.php?/forums/" target="_blank"> TNG Fórum</a> a vyhledejte název módu. Pokud nenajdete nic u¾iteèného, mù¾ete si vytvoøit úèet a zanechat ¾ádost o pomoc na ostatní u¾ivatele.</li>
          <li>pou¾ijte <b>Seznam e-mailových diskuzí</b> a polo¾te otázku. <a href="https://tng.lythgoes.net/wiki/index.php/TNG_Discussion_Forums" target="_blank">Zaènìte kliknutím sem</a>.</li>
        </ul>
    </ul>
    </p>

	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="editor"><p class="subheadbold">Editor módù</p></a>

    <p>Editor modù (parametrù) je pøístupný ze stránky se seznamy modù. Pokud má nainstalovaný mód upravitelné parametry, uvidíte to ve sloupci Stav v seznamu modù jako -- <i>Instalováno [Mo¾nosti]</i>. Chcete-li upravit parametry módu, otevøete panel Stav a kliknìte na tlaèítko "Upravit mo¾nosti". Editovatelné parametry jsou u¾ivatelské mo¾nosti módu, napøíklad nastavení barvy pro nìco.</p>

    <p>Chování cílového souboru lze øídit hodnotou parametrù. U¾ivatel módu mù¾e být napøíklad po¾ádán, aby zadal poèet dní, po které si pøeje uchovávat urèité soubory protokolu.</p>

    <p>Poèet parametrù, které mù¾e mód pou¾ít, není omezen. Ka¾dý parametr má výchozí hodnotu zobrazenou na panelu popisu editoru módu vlevo. Panel vpravo obsahuje oblast pro zmìnu hodnoty parametru. Jsou zde také dvì tlaèítka, jedno pro aktualizaci cílového souboru s hodnotou ve vstupním poli a druhé pro resetování parametru na výchozí hodnotu.</p>

    <p><b>A» u¾ zadáváte øetìzce nebo celá èísla, není nutné je uzavírat do uvozovek</b>. Editor módù to zjistí pøi aktualizaci hodnot.</p>
	</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="viewlog"><p class="subheadbold">Zobrazit protokol</p></a>
    <p>V závislosti na u¾ivatelských preferencích na kartì Mo¾nosti se pøi chybách generovaných bìhem instalace nebo odstranìní módu automaticky otevøe protokol chyb, tak¾e administrátor mù¾e vidìt, co se pokazilo. Jinak mù¾ete otevøít protokol a zobrazit podrobnosti o svých operacích.</p>

    <p>Øádek protokolu zobrazuje datum a èas, pokus o operaci, název a verzi módu, výsledek a funkcionáøe (správce webu), který operaci provedl.
    </p>

    <p>Chcete-li zobrazit podrobnosti, kliknìte na øádek protokolu. Otevøe se panel. Ka¾dý pøíkaz (zaèínající znakem %) zobrazuje èíslo øádku v konfiguraèním souboru módu, kde byl pøíkaz proveden, a výsledek.
    </p>

    <p>Jak bylo uvedeno døíve, chyby jsou doprovázeny èíslem E odkazujícím na èíslo øádku v souboru TNG Mana¾eru módù, kde k chybì do¹lo. Pokud k tomu do¹lo bìhem pokusu o instalaci, E-èíslo bude odkazovat na soubor classes/modinstaller.class.php. Kdy¾ tento soubor otevøete s èíslem øádku, èasto uvidíte poblí¾ komentáø vysvìtlující chybu a navrhující øe¹ení.</p>

    <p>Nápovìdu k pøíkazùm a jejich pou¾ití naleznete na TNGWiki. Mù¾ete také kliknout na odkaz <b>Syntaxe módù</b> pøímo pod zálo¾kami Mana¾era módù na vìt¹inì obrazovek MM.</p>

</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="options"><p class="subheadbold">Mo¾nosti</p></a>
    <p>Karta <strong>Mo¾nosti</strong> otevøe obrazovku u¾ivatelských preferencí rozdìlenou do tøí èástí.</p>
</p>V sekci <b>Protokol Mana¾eru módù</b> mù¾ete zadat preference týkající se souboru protokolu. Pod <i>Název souboru protokolu</i> mù¾ete ve skuteènosti zadat cestu k serveru, abyste umístili svùj protokol mimo oblast webových stránek, která je pøístupná z prohlí¾eèe. Výchozí nastavení je umístit jej do koøenového adresáøe TNG.</p>
    <p><b>Nastavení zobrazení</b> je místo, kde mù¾ete zobrazit nebo skrýt karty na stránce Mana¾eru módù.</p>
    <p><b>Jiné</b> vám umo¾òuje rozhodnout, jak nakonfigurovat schopnost Mana¾eru módù mazat mody a jejich podpùrné slo¾ky.</p>
    <p>
			<ul>
 				<li><strong>Povolit Vymazat vybrané pro èásteènì nainstalované módy</strong> - povolí zobrazení tlaèítka <strong>Vymazat</strong> v seznamu vybraných Èásteènì nainstalovaných módù, pomocí kterého lze vymazat více módù najednou, jako napø. vymazání pøedchozích verzí modù, které nebyly vymazány pøed instalací novìj¹í verzí. Výchozí volbou je <strong>Ne</strong>. Tuto volbu doporuèujeme povolit pouze v pøípadì, ¾e potøebujete vymazat více modù, ani¾ byste museli odinstalovat aktuální verze, abyste odstranili pøedchozí verze módu, kdy¾ jste zapomnìli odinstalovat a vymazat pøedchozí verze modu pøed instalací nové verze. Normálnì tuto volbu nechte nastavenou na Ne a volbu Ne obnovte po odstranìní pøedchozích verzí módu, které se zobrazují jako èásteènì nainstalované.</li>
				<li><strong>Povolit Vymazat pro samostatnì nainstalované módy</strong> - umo¾ní zapnutí volby zobrazení tlaèítka <strong>Vymazat</strong> vedle tlaèítka Odinstalovat u samostatnì instalovaných módù, napø. pro vymazání pøedchozí verze módu, která nebyla vymazána pøed instalací novìj¹í verze. Výchozí volbou je <strong>Ne</strong>.  Doporuèujeme, abyste tuto volbu povolili pouze v pøípadì, kdy je potøeba vymazat pøedchozí verzi módu, bez nutnosti odinstalování aktuální verze za úèelem vymazání pøedchozí verze, a za normálních okolností ponechte tuto volbu nastavenou na <strong>Ne</strong> a volbu Ne obnovte po odstranìní pøedchozích verzí módu, které se zobrazují jako nainstalované.</li>
				<li><strong>Povolit smazání podpùrné slo¾ky po vymazání modu</strong> - umo¾ní zapnutí volby smazání slo¾ky (slo¾ek) pøidru¾ených k módu pøi mazání módu. Výchozí volbou je <strong>Ne</strong>. Doporuèujeme tuto mo¾nost povolit jen tehdy, pokud chápete nebezpeèí vymazání nezamý¹lených slo¾ek. Vìøíme, ¾e toto riziko je velmi malé.</li>
		</ul>
  </p>
    <p>Nastavte pøedvolby, jak potøebujete, a stisknìte tlaèítko <i>Ulo¾it</i>.</p>
</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="analyzer"><p class="subheadbold">Analýza souborù TNG</p></a>
    <p>Karta <strong>Analýza souborù TNG</strong> je volitelná karta, kterou lze povolit na obrazovce Mo¾nosti.</p>

<p>Toto je pokroèilý nástroj, který vám umo¾òuje vybrat soubor TNG a zobrazit, které módy mìní nebo zmìní tento konkrétní soubor TNG. Pokud se soubor neobjeví v seznamu vlevo, znamená to, ¾e na nìj necílí ¾ádné mody.</p>

<p>Kdy¾ vyberete soubor v levém sloupci, zobrazí se v pravém sloupci s názvy a stavem modù, které jej ovlivní. Odtud mù¾ete kliknout na odkaz "Zobrazit úpravu" a zobrazit skuteènou zmìnu, kterou provede v cílovém souboru. <i>Není v rozsahu tohoto souboru nápovìdy probírat pøíkazy konfigurace módù a jak fungují</i>. Informace naleznete na TNGWiki.</p>

<p>Pokud jste zvolili na kartì Mo¾nosti, Nastavení zobrazení, "Zobrazit akce v analyzátoru modù", uvidíte také odkazy, které vám umo¾ní nainstalovat, odinstalovat nebo smazat mód pøímo z této obrazovky, v závislosti na aktuálním stavu. </p>
<p>V horní èásti seznamu uvidíte panel filtrù s výbìry pro <i>V¹echny mody</i>, <i>Pouze nainstalované mody</i> nebo <i>Instalované+èásteènì nainstalované mody</i>. Výbìrem <i>Pouze nainstalované mody</i> a kliknutím na <i>Odeslat dotaz</i> omezíte soubory v levém sloupci na ty, které jsou ovlivnìny pouze aktuálnì nainstalovanými mody.</p>

    <p>Tento nástroj je u¾iteèný nejen pro nalezení konfliktù mezi dvìma módy, ale také pro zji¹tìní, které módy je tøeba po nahrazení daného cílového souboru vyèistit a znovu nainstalovat. </p>

    <p>The TNG Wiki provides additional information for the mod developers on <a href="https://tng.lythgoes.net/wiki/index.php?title=Using_the_Mod_Analyzer" target="_blank">Using the Mod Analyzer</a>.</p>
    <p>Dal¹í informace o <a href="https://tng.lythgoes.net/wiki/index.php?title=Using_the_Mod_Analyzer" target="_blank">Pou¾ití analyzátoru módù< /a> poskytuje vývojáøùm módù TNG Wiki.</p>

</td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="parser"><p class="subheadbold">Tabulka parseru</p></a>
    <p>Tento nástroj je urèen hlavnì pro ladìní modù. Tabulka parseru ukazuje, jak Mana¾er módù zanalyzoval pøíkazy konfiguraèního souboru módu (.cfg). Je to zobrazeno ve formì tabulky, pøièem¾ ka¾dý øádek pøedstavuje pøíkaz módu. Data uvedená v tabulce jsou pøedána dal¹ím skriptùm mana¾eru módù k dal¹ímu zpracování - instalaci, odstranìní atd. Pokud se vyskytne problém s módem, je dobré zaèít s tabulkou parseru, abyste zjistili, zda jsou v¹echny pøíkazy a argumenty módu správnì zachyceny.</p>

      <p>Tuto kartu mù¾ete pou¾ít k výbìru módu ze seznamu, jeho¾ tabulku chcete zobrazit, nebo mù¾ete kliknout na název modu v seznamu módù a zobrazit tabulku parseru pro tento mód, <i>pokud jste povolili mo¾nost Zobrazit dal¹í nástroje pro vývojáøe</i>.</p>

      <p>Zobrazení této karty je volitelné. Chcete-li jej pou¾ít, vyberte na kartì Mo¾nosti "Zobrazit dal¹í nástroje pro vývojáøe". Pokud je mo¾nost karty vypnutá, bude také deaktivován odkaz na stránce seznamu.</p>

      <p><i>Není v rozsahu tohoto souboru nápovìdy probírat pøíkazy konfigurace módù a jak fungují</i>. Informace naleznete na TNGWiki.</p>

    </td>
</tr>

<tr class="databack">
	<td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="recommended"><p class="subheadbold">Doporuèené aktualizace</p></a>
    <p>Zálo¾ka <strong>Doporuèené aktualizace</strong> je volitelná a lze ji povolit na obrazovce Mo¾nosti. Umo¾òuje aktualizovat soubory cust_text.php, pokud jste tak neuèinili v rámci readme aktualizace TNG. </p>



<p>Dal¹í informace (v angliètinì) naleznete v èlánku <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager" target="_blank">Mod Manager</a> a v kategorie èlánkù <a href="https://tng.lythgoes.net/wiki/index.php?title=Category:TNG_Mod_Manager" target="_blank">TNG Mod Manager</a> na TNG Wiki.</p>
<p>V TNG Wiki si mù¾ete prohlédnout èlánek <a href="https://tng.lythgoes.net/wiki/index.php?title=Mod_Manager_Enhancements" target="_blank">Mod Manager</a> jaká vylep¹ení byla provedena v TNG v12.</p>

	</td>
</tr>

<tr class="databack">
  <td class="tngshadow">
    <p style="float:right"><a href="#top">Nahoru</a></p>
    <a name="credits"><p class="subheadbold">Podìkování</p></a>

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
                <li>lep¹í integrace pro instalaci, odebírání a správu módù</li>
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
                <li>vytvoøil kartu Zobrazit protokol</li>
                <li>vytvoøil kartu Mo¾nosti</li>
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
                <li>pøidal dávkové zpracování</li>
                <li>pøidal kartu Zobrazit tabulku parseru</li>
                <li>pøidal kartu Analyzovat soubory TNG</li>
                <li>refaktoroval kód TNG pro údr¾bu, v14</li>
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
                <li>pøidal kartu Ovlivnìné soubory</li>
                <li>hlavní pøíspìvky ke stylu</li>
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
                <li>poskytl kód pro pøeru¹ení dlouhých øádkù textu bez mezer, který se pou¾ívá pøedev¹ím ve sloupci Stav MM</li>
                <li>hlavní pøíspìvky k zobrazení protokolu MM</li>
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
                <li>hlavní aktualizace Analýzy souborù TNG</li>
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