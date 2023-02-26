<?php
include("../../helplib.php");
echo help_header("Nápověda: Administrace");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="modmanager_help.php" class="lightlink">&laquo; Nápověda: Manažer módů</a> &nbsp; | &nbsp;
			<a href="people_help.php" class="lightlink">Nápověda: Osoby &raquo;</a>
		</p>
		<span class="largeheader">Nápověda: Začínáme</span>
		<p class="smaller menu">
			<a href="#gettingstarted" class="lightlink">Začínáme</a> &nbsp; | &nbsp;
			<a href="#notes" class="lightlink">Poznámky</a> &nbsp; | &nbsp;
			<a href="#otherresources" class="lightlink">Jiné zdroje</a>
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
  
		<a name="gettingstarted"><p class="subheadbold">Začínáme:</p></a>
		<p>Čím začít nejdříve? Zde je základ:</p>
		<ol>
				<li><p><strong>Pečlivě dodržujte instrukce k instalaci, které jsou obsažené v souboru <a href="../../readme.html" target="_blank">readme.html</a> .</strong> Přímo z této stránky
					lze nastavit základní konfiguraci, ale všechny potřebné hodnoty můžete nastavit z volby <strong>Nastavení</strong> zde z hlavního administrátorského menu.</p></li>
				<li><p><strong>Vytvořte alespoň jeden strom.</strong> Nebudete-li mít více nezávislých souborů GEDCOM, budete pravděpodobně potřebovat pouze jeden strom.</p></li>
				<li><p><strong>Vytvořte alespoň jednoho uživatele.</strong> První uživatel, kterého vytvoříte, musí být Administrátor (musí mít všechna přístupová práva a NESMÍ mít omezení týkající se žádného stromu).</p></li>
				<li><p><strong>Naimportujte svůj soubor GEDCOM nebo začněte ručně vkládat svá data</strong>. Pokud je budete vkládat ručně, nezáleží na to, co vložíte nejdříve.
					Někdo raději vkládá nejprve osoby a potom je spojí do rodin, zatímco jiní začínají rodinami a pak do nich přidávají osoby. Nemusíte
					se řídit žádnou strategií.</p></li>
				<li><p><strong>Podívejte se na Nástroje po importu</strong> (pod Import/Export) a proveďte ty, o kterých si myslíte, že jsou nutné (více informací
					dozvíte zde v Nápovědě).</p></li>
				<li><p><strong>Média.</strong> Pokud jste vložili nebo naimportovali svá data, můžete je spojit s fotografiemi, vyprávěními či jinými médii. Bavte se!</p></li>
        <li><p><strong>Získejte mapový klíč.</strong> Mapy Google opět ke svému použití vyžadují klíč. Přejděte do Nastavení a potom do Nastavení map a klikněte na odkaz Nápověda. Zde najdete pokyny, jak získat klíč 
          a co s ním dělat. Vaše mapy nebudou fungovat, dokud to nebude hotovo.</p></li>
				<li><p><strong>Něco jiného.</strong> Budete chtít projít také další sekce z menu Administrace. Další nápovědu naleznete
					na každé stránce.</p></li>
		</ol>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="notes"><p class="subheadbold">Poznámky:</p></a>
		<ol>
				<li><p>Pokud vám v menu Administrace chybí některé volby, zřejmě jste se nepřihlásili s úplnými přístupovými právy nebo jsou vaše přístupová práva omezena pouze na určitý strom.
				Chcete-li uživatelská práva změnit, odhlaste se a přihlaste se jako Administrátor, nebo svoji databázi upravte přímo pomocí phpMyAdmin nebo podobnými nástroji.</p></li>
				<li><p>Pomocí odkazu na domovskou stránku na horním okraji rámce se dostanete na domovskou stránku a zobrazíte ji v okně vašeho prohlížeče. Pomocí odkazu na domovskou stránku v levém rámci otevřete svoji
				stránku vpravo v hlavním rámci, což vám umožní pohyb po vašich stránkách a kdykoli návrat do sekce Administrátora jedním kliknutím v levém rámci.</p></li>
		</ol>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="otherresources"><p class="subheadbold">Jiné zdroje:</p></a>
		<ol>
			<li><p>Mailový seznam pro aktualizace: <a href="mailto:tngusers@lythgoes.net">tngusers@lythgoes.net</a>. Přijímat a posílat maily na
				<a href="mailto:tngusers-subscribe@lythgoes.net">tngusers-subscribe@lythgoes.net</a>. Tento seznam se používá výhradně na informování uživatelů
				o programových aktualizacích a vydaných opravách. </p></li>
			<li><p>Uživatelský mailový seznam: <a href="mailto:tngusers2@lythgoes.net">tngusers2@lythgoes.net</a>. Přijímat a posílat maily na
				  <a href="mailto:tngusers2-subscribe@lythgoes.net">tngusers2-subscribe@lythgoes.net</a>. Tento seznam se používá pro diskuze mezi uživateli TNG. </p></li>
			<li><p>Uživatelské fórum: <a href="https://tng.community" target="_blank">https://tng.community</a>.</p></li>
			<li><p>TNG Wiki: <a href="https://tng.lythgoes.net/wiki" target="_blank">https://tng.lythgoes.net/wiki</a>. Stránka MediaWiki, která obsahuje:</p>
				<ul>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Getting_Started" target="_blank">Průvodce uvodem do TNG</a>. Jak nastavit vaše stránky a vytvořit uživatelské stránky.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Visitors" target="_blank">Průvodce pro návštěvníky TNG</a>. Jak se mohou návštěvníci pohybovat po vašich stránkách.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Registered_Users" target="_blank">Průvodce pro registrované uživatele TNG</a>. Jak využít možnosti TNG jako registrovaný uživatel nebo Administrátor.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Administrator" target="_blank">Průvodce pro administrátora TNG</a>. Poskytne informace pro administrátora webových stránek TNG.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Programmer" target="_blank">Průvodce pro programátora TNG</a>. Pomůže porozumět, jak TNG pracuje, a pro programátory, jak vytvořit změny v TNG.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=TNG_Glossary" target="_blank">Seznam termínů TNG</a>. Slova a věty použité v TNG, které souvisí s genealogií, počítačovou technikou a organizací archivace.</li>
				</ul><br />
			</li>
			<li><p>Odkazy PHP: <a href="https://php.net" target="_blank">https://php.net</a>.</p></li>
			<li><p>Odkazy MySQL: <a href="https://mysql.com" target="_blank">https://mysql.com</a>.</p></li>
			<li><p>Odkazy HTML: <a href="https://htmlhelp.com" target="_blank">https://htmlhelp.com</a>.</p></li>
			<li><p>Kontakt přímo na autora: <a href="mailto:darrin@lythgoes.net">darrin@lythgoes.net</a>.</p></li>
			</ol>
	</td>
</tr>

</table>
</body>
</html>
