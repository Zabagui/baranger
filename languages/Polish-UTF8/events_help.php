<?php
include("../../helplib.php");
echo help_header("Pomoc: Wydarzenia");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="citations_help.php" class="lightlink">&laquo; Pomoc: Cytaty</a> &nbsp; | &nbsp;
			<a href="more_help.php" class="lightlink">Pomoc: Więcej &raquo;</a>
		</p>
		<span class="largeheader">Pomoc: Wydarzenia</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Wydarzenia standardowe a niestandardowe</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Dodaj nowe</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edycja istniejących</a> &nbsp; | &nbsp;
			<a href="#del" class="lightlink">Usuń</a> &nbsp; | &nbsp;
			<a href="#citations" class="lightlink">Cytaty</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="what"><p class="subheadbold">Wydarzenia standardowe a niestandardowe</p></a>
		Większość wydarzeń takich jak narodziny, śmierć, małżeństwo i kilka innych, jest wprowadzana na głównych stronach osób, rodzin, źródeł i repozytoriów.
		Te wydarzenia są przechowywane w odpowiednich tabelach bazy danych. Dokumentacja TNG odnosi się do tych wydarzeń jako "standardowych".
		Wszystkie inne wydarzenia są "niestandardowe" i zarządza się nimi w sekcji <strong>Inne wydarzenia</strong> na kartach osób, rodzin, źródeł i repozytoriów.
		Te wydarzenia są przechowywane w oddzielnych tabelach wydarzeń. Pomoc niniejsza odnosi się do zarządzania tymi <em>niestandardowymi</em> wydarzeniami.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Dodawanie wydarzeń</p></a>

		<p>Aby dodać nowe wydarzenie, kliknij na "Dodaj nowe" w sekcji Inne wydarzenia, a następnie wypełnij formularz. Jeśli istnieją już jakieś wydarzenia,
będą one wyświetlane w tabeli w sekcji Inne wydarzenia. Wyjaśnienia na temat dostępnych pól są przedstawione w rozdziale poniżej.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="edit"><p class="subheadbold">Edycja wydarzeń</p></a>

		<p>Aby edytować istniejące wydarzenie należy kliknąć na ikonę Edycja obok tego wydarzenia w sekcji Inne wydarzenia. Otworzy się wówczas pomocnicze okno Modyfikacja wydarzenia.<br/>Aby edytować dane w "standardowym" wydarzeniu, takim jak np. narodziny lub zgon, zmień po prostu tekst.</p>

		<p>Podczas dodawania lub edycji wydarzenia niestandardowego dostępne są następujące pola:</p>

		<span class="optionhead">Typ wydarzenia</span>
		<p>Wybierz typ wydarzenia z rozwijanej listy (nie można zmienić typu istniejącego wydarzenia). Jeśli potrzebnego typu wydarzenia nie ma na liście, przejdź najpierw do
Administracja / Niestandardowe wydarzenia i zdefiniuj pożądany typ wydarzenia, a następnie powróć na tę kartę, aby je wybrać.</p>

<span class="optionhead">Data wydarzenia</span>
		<p>Rzeczywista lub przybliżona data związana z wydarzeniem.</p>

<span class="optionhead">Miejsce wydarzenia</span>
		<p>Miejsce, gdzie nastąpiło wydarzenie. Podaj nazwę miejsca lub kliknij ikonkę "Znajdź" (lupka), aby wykorzystać mijsce wprowadzone już wcześniej.</p>

<span class="optionhead">Szczegóły</span>
		<p>Wszelkie dodatkowe informacje, jeśli są one konieczne. Jeśli nie ma daty lub miejsca związanego z wydarzeniem, pole "szczegóły" może zawierać informacje dotyczące tych brakujących danych.</p>

		<span class="optionhead">Duplikuj dla:</span>
		<p>W celu zduplikowania tego wydarzenia dla jednej lub więcej osób lub rodzin, w polu ID: wprowadź identyfikatory tych osób lub rodzin. Jeżeli wprowadzasz więcej niż jeden identyfikator, rozdzielaj je przecinkami. Jeżeli nie znasz identyfikatora, kliknij ikonę "Szukaj" z prawej aby wyszukać osobę po nazwisku. Powielenie wydarzenia nastąpi po kliknięciu przycisku "Zapisz".
<br/>Gdy okienko będzie ponownie otwarte później, jego pola znów będą puste. Zmiany wydarzenia wówczas wprowadzane <strong>nie będą</strong> propagowane dla duplikatów wykonanych wcześniej!</p>

<span class="optionhead">Więcej</span><br />
		<p>Inne rzadziej używane rodzaje informacji można dodać do każdego wydarzenia klikając na napis "Więcej" lub strzałkę obok niego. W ten sposób pojawią dodatkowe pola. Pola te możesz ukryć przez ponowne kliknięcie
na napis lub strzałkę. Ukrywanie pól nie usuwa zapisanych informacji. Te dodatkowe pola to:</p>

<p><span class="optionhead">Wiek</span>: Wiek osoby w czasie wydarzenia.</p>

<p><span class="optionhead">Urząd</span>: Kompetentny i/lub odpowiedzialny w momencie wydarzenia organ lub instytucja.</p>

<p><span class="optionhead">Przyczyna</span>: Przyczyna zdarzenia (najczęściej używane dla podania przyczyny zgonu).</p>

<p><span class="optionhead">Adres 1/Adres 2/Miasto/Województwo/Kod pocztowy/Kraj/Telefon/Mail/Witryna internetowa</span>: Adres oraz inne informacje kontaktowe związane z wydarzeniem.</p>

<span class="optionhead">Wymagane pola:</span>
		<p>Musisz wybrać rodzaj wydarzenia i wpisać coś w przynajmniej jednym z następujących pól: <strong>data wydarzenia</strong>, <strong>miejsce wydarzenia</strong>,
		lub <strong>szczególy</strong>. Wszystkie inne informacje są opcjonalne.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="del"><p class="subheadbold">Usuwanie wydarzeń</p></a>

		<p>Aby usunąć istniejące wydarzenie, należy kliknąć na ikonę Usuń obok tego wydarzenia w sekcji Inne wydarzenia. Wydarzenie zostanie usunięte, niezależnie od tego, czy strona zostanie zapisana.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="citations"><p class="subheadbold">Źródła</p>
		<p>Aby dodać lub edytować odnośnik do źródła dla wydarzenia trzeba najpierw zapisać wydarzenie, a następnie kliknąć na ikonę obok zapisu tego wydarzenia na liście wydarzeń. Aby uzyskać więcej informacji na ten temat odnośników do źródeł, zobacz <a href="citations_help.php">Pomoc: Odnośniki</a>.</p>
	
	<hr>Uwagi dotyczące polskiego tłumaczenia: <a href="mailto:michal@jarocinscy.pl">michal@jarocinscy.pl</a> lub <a href="mailto:januszkielak@gmail.com">januszkielak@gmail.com</a>. Prosimy zgłaszać ewentualne błędy lub niejasności.

	</td>
</tr>

</table>
</body>
</html>
