<?php
include("../../helplib.php");
echo help_header("Nápovìda: Administrace");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="modmanager_help.php" class="lightlink">&laquo; Nápovìda: Mana¾er módù</a> &nbsp; | &nbsp;
			<a href="people_help.php" class="lightlink">Nápovìda: Osoby &raquo;</a>
		</p>
		<span class="largeheader">Nápovìda: Zaèínáme</span>
		<p class="smaller menu">
			<a href="#gettingstarted" class="lightlink">Zaèínáme</a> &nbsp; | &nbsp;
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
  
		<a name="gettingstarted"><p class="subheadbold">Zaèínáme:</p></a>
		<p>Èím zaèít nejdøíve? Zde je základ:</p>
		<ol>
				<li><p><strong>Peèlivì dodr¾ujte instrukce k instalaci, které jsou obsa¾ené v souboru <a href="../../readme.html" target="_blank">readme.html</a> .</strong> Pøímo z této stránky
					lze nastavit základní konfiguraci, ale v¹echny potøebné hodnoty mù¾ete nastavit z volby <strong>Nastavení</strong> zde z hlavního administrátorského menu.</p></li>
				<li><p><strong>Vytvoøte alespoò jeden strom.</strong> Nebudete-li mít více nezávislých souborù GEDCOM, budete pravdìpodobnì potøebovat pouze jeden strom.</p></li>
				<li><p><strong>Vytvoøte alespoò jednoho u¾ivatele.</strong> První u¾ivatel, kterého vytvoøíte, musí být Administrátor (musí mít v¹echna pøístupová práva a NESMÍ mít omezení týkající se ¾ádného stromu).</p></li>
				<li><p><strong>Naimportujte svùj soubor GEDCOM nebo zaènìte ruènì vkládat svá data</strong>. Pokud je budete vkládat ruènì, nezále¾í na to, co vlo¾íte nejdøíve.
					Nìkdo radìji vkládá nejprve osoby a potom je spojí do rodin, zatímco jiní zaèínají rodinami a pak do nich pøidávají osoby. Nemusíte
					se øídit ¾ádnou strategií.</p></li>
				<li><p><strong>Podívejte se na Nástroje po importu</strong> (pod Import/Export) a proveïte ty, o kterých si myslíte, ¾e jsou nutné (více informací
					dozvíte zde v Nápovìdì).</p></li>
				<li><p><strong>Média.</strong> Pokud jste vlo¾ili nebo naimportovali svá data, mù¾ete je spojit s fotografiemi, vyprávìními èi jinými médii. Bavte se!</p></li>
        <li><p><strong>Získejte mapový klíè.</strong> Mapy Google opìt ke svému pou¾ití vy¾adují klíè. Pøejdìte do Nastavení a potom do Nastavení map a kliknìte na odkaz Nápovìda. Zde najdete pokyny, jak získat klíè 
          a co s ním dìlat. Va¹e mapy nebudou fungovat, dokud to nebude hotovo.</p></li>
				<li><p><strong>Nìco jiného.</strong> Budete chtít projít také dal¹í sekce z menu Administrace. Dal¹í nápovìdu naleznete
					na ka¾dé stránce.</p></li>
		</ol>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="notes"><p class="subheadbold">Poznámky:</p></a>
		<ol>
				<li><p>Pokud vám v menu Administrace chybí nìkteré volby, zøejmì jste se nepøihlásili s úplnými pøístupovými právy nebo jsou va¹e pøístupová práva omezena pouze na urèitý strom.
				Chcete-li u¾ivatelská práva zmìnit, odhlaste se a pøihlaste se jako Administrátor, nebo svoji databázi upravte pøímo pomocí phpMyAdmin nebo podobnými nástroji.</p></li>
				<li><p>Pomocí odkazu na domovskou stránku na horním okraji rámce se dostanete na domovskou stránku a zobrazíte ji v oknì va¹eho prohlí¾eèe. Pomocí odkazu na domovskou stránku v levém rámci otevøete svoji
				stránku vpravo v hlavním rámci, co¾ vám umo¾ní pohyb po va¹ich stránkách a kdykoli návrat do sekce Administrátora jedním kliknutím v levém rámci.</p></li>
		</ol>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="otherresources"><p class="subheadbold">Jiné zdroje:</p></a>
		<ol>
			<li><p>Mailový seznam pro aktualizace: <a href="mailto:tngusers@lythgoes.net">tngusers@lythgoes.net</a>. Pøijímat a posílat maily na
				<a href="mailto:tngusers-subscribe@lythgoes.net">tngusers-subscribe@lythgoes.net</a>. Tento seznam se pou¾ívá výhradnì na informování u¾ivatelù
				o programových aktualizacích a vydaných opravách. </p></li>
			<li><p>U¾ivatelský mailový seznam: <a href="mailto:tngusers2@lythgoes.net">tngusers2@lythgoes.net</a>. Pøijímat a posílat maily na
				  <a href="mailto:tngusers2-subscribe@lythgoes.net">tngusers2-subscribe@lythgoes.net</a>. Tento seznam se pou¾ívá pro diskuze mezi u¾ivateli TNG. </p></li>
			<li><p>U¾ivatelské fórum: <a href="https://tng.community" target="_blank">https://tng.community</a>.</p></li>
			<li><p>TNG Wiki: <a href="https://tng.lythgoes.net/wiki" target="_blank">https://tng.lythgoes.net/wiki</a>. Stránka MediaWiki, která obsahuje:</p>
				<ul>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Getting_Started" target="_blank">Prùvodce uvodem do TNG</a>. Jak nastavit va¹e stránky a vytvoøit u¾ivatelské stránky.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Visitors" target="_blank">Prùvodce pro náv¹tìvníky TNG</a>. Jak se mohou náv¹tìvníci pohybovat po va¹ich stránkách.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Registered_Users" target="_blank">Prùvodce pro registrované u¾ivatele TNG</a>. Jak vyu¾ít mo¾nosti TNG jako registrovaný u¾ivatel nebo Administrátor.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Administrator" target="_blank">Prùvodce pro administrátora TNG</a>. Poskytne informace pro administrátora webových stránek TNG.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=Category:Programmer" target="_blank">Prùvodce pro programátora TNG</a>. Pomù¾e porozumìt, jak TNG pracuje, a pro programátory, jak vytvoøit zmìny v TNG.</li>
				<li><a href="https://tng.lythgoes.net/wiki/index.php?title=TNG_Glossary" target="_blank">Seznam termínù TNG</a>. Slova a vìty pou¾ité v TNG, které souvisí s genealogií, poèítaèovou technikou a organizací archivace.</li>
				</ul><br />
			</li>
			<li><p>Odkazy PHP: <a href="https://php.net" target="_blank">https://php.net</a>.</p></li>
			<li><p>Odkazy MySQL: <a href="https://mysql.com" target="_blank">https://mysql.com</a>.</p></li>
			<li><p>Odkazy HTML: <a href="https://htmlhelp.com" target="_blank">https://htmlhelp.com</a>.</p></li>
			<li><p>Kontakt pøímo na autora: <a href="mailto:darrin@lythgoes.net">darrin@lythgoes.net</a>.</p></li>
			</ol>
	</td>
</tr>

</table>
</body>
</html>
