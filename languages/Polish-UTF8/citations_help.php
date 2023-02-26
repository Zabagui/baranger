<?php
include("../../helplib.php");
echo help_header("Pomoc: Odnośniki");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="notes_help.php" class="lightlink">&laquo; Pomoc: Przypisy</a> &nbsp; | &nbsp;
			<a href="events_help.php" class="lightlink">Pomoc: Wydarzenia &raquo;</a>
		</p>
		<span class="largeheader">Pomoc: Odnośniki</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co to jest odnośnik?</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Dodaj/Edycja/Usuń</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="what"><p class="subheadbold">Co to są Odnośniki?</p></a>

		<p><strong>Odnośnik</strong> jest odniesieniem do zapisu źródła, dokonanym z zamiarem udowodnienia
prawdziwości niektórych informacji. Źródło zawiera zwykle dane, wśród których została znaleziona 
informacja (np. księga lub spis ludności), odnośnik natomiast wskazuje w którym miejscu źródła znajduje
się informacja (np. na której stronie). Do tego samego źródła może odwoływać się wiele odnośników, 
wskazujących różne informacje podawane w treści dokumentu dla różnych osób, rodzin, przypisów i wydarzeń.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Dodawanie/Edycja/Usuwanie odnośników</p></a>

		<p>Aby dodawać, edytować lub usuwać odnośniki, należy kliknąć na ikonę na górze ekranu lub obok 
wybranego pola (jeśli istnieją już jakieś odnośniki, ikona będzie oznaczona zieloną kropką). Po kliknięciu 
ikony pojawi się małe okienko (popup), w którym zobaczysz wszystkie istniejące odnośniki dotyczące 
wybranego źródła, wydarzenia itp.</p>

		<p>Aby dodać nowy odnośnik, kliknij na "Dodaj nowe" i wypełnij formularz. </p>

		<p>Aby edytować lub usuwać istniejące odnośniki, kliknij na odpowiednią ikonkę obok tego odnośnika.</p>

		<p>Podczas dodawania lub edycji odnośników dostępne są następujące pola:</p>

		<span class="optionhead">Źródło</span>
		<p>Wybierz istniejące źródło, do którego ma powstać odnośnik. Jeśli źródło nie pojawia się na 
liście źródeł, to znaczy że albo nie zostało jeszcze utworzone albo istnieje w innym drzewie. Najpierw 
przejdź do Administracja / Źródła i utwórz źródło dla właściwego drzewa, a następnie wróć do listy 
odnośników i wybierz to źródło.</p>
		
<!--<span class="optionhead">Opis</span>
		<p>Jeśli Twój program genealogiczny nie przydziela numerów ID swoim źródłom, Odnośniki będą miały swój opis. Nie zobaczysz pola do opisu nowych cytatów.</p>-->

		<span class="optionhead">Strona</span>
		<p>Podaj stronę z wybranego źródła odnoszącą się do tego wydarzenia (opcjonalne).</p>
		
		<span class="optionhead">Wiarygodność</span>
		<p>Wybierz cyfrę (0-3) wskazującą, jak wiarygodne jest źródło (opcjonalnie). Wyższe cyfry oznaczają większą wiarygodność.</p>
		
		<span class="optionhead">Data odnośnika</span>
		<p>Data związana z tym odnośnikiem (opcjonalne).</p>
		
		<span class="optionhead">Faktyczny tekst</span>
		<p>Krótki fragment z materiału źródłowego (opcjonalne).</p>

		<span class="optionhead">Przypisy</span>
		<p>Wszelkie dodatkowe uwagi dotyczące tego źródła (opcjonalne).</p><br>
	
	<hr>Uwagi dotyczące polskiego tłumaczenia: <a href="mailto:michal@jarocinscy.pl">michal@jarocinscy.pl</a> lub <a href="mailto:januszkielak@gmail.com">januszkielak@gmail.com</a>. Prosimy zgłaszać ewentualne błędy lub niejasności.

	</td>
</tr>

</table>
</body>
</html>
