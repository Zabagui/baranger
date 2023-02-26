<?php
include("../../helplib.php");
echo help_header("Pomoc: Cmentarze");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="albums_help.php" class="lightlink">&laquo; Pomoc: Albumy</a> &nbsp; | &nbsp;
			<a href="places_help.php" class="lightlink">Pomoc: Miejsca &raquo;</a>
		</p>
		<span class="largeheader">Pomoc: Cmentarze</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Szukaj</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Dodaj lub edytuj</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Usuń</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="search"><p class="subheadbold">Szukanie</p></a>
<p>Znajdź istniejący cmentarz wpisując jego pełną nazwę lub jej część, ID cmentarza, miasto, powiat, województwo, kraj lub nazwę pliku mapy. Jeśli nic nie wpiszesz,
w polu wyszukiwania zostaną wyświetlone wszystkie cmentarze zapisane w bazie danych.</p>

		<p>Kryteria wyszukiwania na tej stronie zostaną zapamiętane, dopóki nie naciśniesz przycisku <strong>Wyczyść</strong>, który przywraca domyślne wartości wszystkich kryteriów.</p>
		<span class="optionhead">Czynność</span>
		<p>Ikonki w polu "czynność" obok każdego wyniku wyszukiwania pozwalają na edycję, usuwanie lub podgląd tego wyniku. Aby usunąć więcej niż jeden rekord jednocześnie, zaznacz pole w kolumnie
		<strong>Wybierz</strong> dla każdego rekordu, który ma zostać usunięty, a następnie kliknąć przycisk "Usuń wybrane" znajdujący się na górze listy. Użyj <strong>Wybierz wszystkie</strong> lub <strong>Wyczyść wszystkie</strong>
		aby zaznaczyć lub usunąć zaznaczenie wszystkich wyświetlonych rekordów.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="add"><p class="subheadbold">Dodawanie nowych / Edycja istniejących cmentarzy</p></a>
		<p>TNG pozwala na grupowanie nagrobków i wyświetlanie ich przy danym cmentarzu. Aby to zrobić, należy utworzyć nowy cmentarz dla każdej lokalizacji. Zapisy dotyczące cmentarzy w TNG nie są związane z zapisami miejsc
pogrzebu i w pliku GEDCOM nie mają odwołania do cmentarzy. Jeśli więc nawet plik GEDCOM zawiera nazwy miejsc pogrzebów, nazwy te nie będą połączone z nazwami cmentarzy i po imporcie pliku GEDCOM łącza te muszą być utworzone w TNG. Standard GEDCOM nie obejmuje takiego typu obiektów jak cmentarze; jest własność specyficzna dla TNG.</p>

		<p>Aby dodać nowy cmentarz, kliknij przycisk <strong>Dodaj nowe</strong>, a następnie wypełnić formularz. Aby edytować istniejący cmentarz, należy znaleźć go w zakładce <a href="#search">Szukaj</a>,
a następnie kliknąć na ikonkę Edycja obok wybranej linii. Podczas dodawania lub edycji cmentarza dostępne są następujące elementy:</p>

		<span class="optionhead">Nazwa cmentarza</span>
		<p>Wpisz pełną nazwę cmentarza. Na przykład cmentarz znajdujący się w Warszawie na Wilanowie należy zapisać jako <em>Cmentarz rzymsko-katolicki w Wilanowie</em> lub <em>Warszawa, Wilanów, cmentarz rzymsko-katolicki</em> a nie tylko <em>Warszawa</em> lub <em>Wilanów</em>.</p>

		<span class="optionhead">Zdjęcie cmentarza do załadowania</span>
		<p>Jeśli masz plan lub inne zdjęcia z tego cmentarza, kliknij przycisk "Wybierz plik" i znajdź go na dysku twardym Twego komputera. Jeśli zdjęcie jest już umieszczone w folderze Cmentarze na Twojej stronie,
zostaw to pole puste i użyj zamiast tego pola "Nazwa pliku cmentarza w folderze Cmentarze"</p>

		<span class="optionhead">Nazwa pliku mapy w folderze Nagrobki</span>
		<p> Jeśli poprzednio załadowałeś plik mapy albo zdjęcie na serwer, podaj ścieżkę dostępu i dokładną nazwę pliku. Możesz także kliknąć na przycisk Wybierz, aby zlokalizować plik. Jeśli przesyłałeś plik mapy lub zdjęcia przy użyciu poprzedniego pola, ścieżka i nazwa pliku zostanie Ci zaproponowana.</p>

		<p><span class="optionhead">UWAGA</span>: Jeśli załadowujesz nowy plik, folder musi już istnieć i musi być zapisywalny. Jeśli folder jeszcze nie istnieje możesz skorzystać z funkcji "Utwórz folder" w Ustawieniach głównych. Jeśli to zawiedzie, należy użyć programu FTP lub menedżera plików online.
Folder ten musi mieć uprawnienia 777 lub 755, które w wielu przypadkach również wystarczą. Nie używaj polskich liter takich jak np. ą, ę ż, ź. Pisz małymi literami, nie rozdzielaj nazwy kropkami lub przecinkami (np. 12.10.99 moje zdjęcie.jpg) Staraj się zapisywać nazwy plików jak w przykładzie: <strong>12_10_99_moje_zdjecie.jpg</strong>.</p>

		<span class="optionhead">Miasto, Powiat, Województwo, Kraj</span>
		<p>Podaj tyle informacji, ile wiesz o lokalizacji tego cmentarza. Kraj jest wymagany, pozostałe pola opcjonalne.
		W polach <strong>Województwo</strong> i <strong>Kraj</strong> wybierz istniejący zapis korzystając z rozwijanej listy. Jeśli żądanego wpisu nie ma, skorzystaj z "Dodaj nowe", aby go dodać. Jeśli znajdziesz na liście niewłaściwy wpis zaznacz go, a następnie kliknij przycisk "Usuń zaznaczone".</p>

		<span class="optionhead">Pokaż/ukryj mapę Google</span>
		<p>Kliknij przycisk "Pokaż / Ukryj mapę Google", aby pokazać mapę. Ta opcja jest dostępna tylko jeśli masz "klucz mapy" z Google i wpisałeś go w Ustawienia i konfiguracja >> Konfiguracja >> Ustawienia mapy (patrz <a href="mapsettings_help.php">Pomoc: Ustawienia mapy</a>). Kliknij przycisk ponownie, aby ukryć mapę. Aby wyszukać
miejscowość na mapie, wpisz jej nazwę w polu <strong>Określenie miejsca Geocode</strong> i kliknij "Szukaj". Możesz też kliknąć na mapę i przeciągnąć, aby przenieść "szpilkę" na żądaną lokalizację. Można użyć kontroli Zoom, aby pokazyeać bardziej lub mniej szczegółowo żądany obszar. Zobacz stronę
<a href="places_googlemap_help.php">Pomoc: Mapy Google</a> aby uzyskać więcej informacji. W celu uzyskania informacji na temat domyślnych ustawień mapy patrz również <a href="mapsettings_help.php">Pomoc: Ustawienia mapy</a>.</p>

		<span class="optionhead">Szerokość/długość (geograficzna)</span>
		<p>Wprowadź szerokość i długość geograficzną lokalizacji cmentarza lub kliknij na wybrany punkt na mapie aby ustawić te wartości (jeśli możesz korzystać z mapy, patrz wyżej).</p>

		<span class="optionhead">Zoom</span>
		<p>Wpisz poziom powiększenia mapy, lub dostosuj poziom przy pomocy suwaka na mapie Google. Ta opcja jest dostępna tylko jeśli masz "klucz mapy" z Google i
wpisałeś go w Administracja/Ustawienia i konfiguracja/Ustawienia mapy.</p>

		<span class="optionhead">Przypisy</span>
		<p> Jeśli do opisania cmentarza lub jego lokalizacji potrzebne są dodatkowe informacje, wprowadź je tutaj (opcjonalnie).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="delete"><p class="subheadbold">Usuwanie cmentarzy</p></a>
		<p>Aby usunąć jeden cmentarz, należy nacisnąć przycisk <a href="#search">Szukaj</a> w celu jego zlokalizowania, a następnie kliknąć na ikonę Usuń obok tego cmentarza. Wiersz zmieni kolor,
		a następnie zniknie. Cmentarz został usunięty. Aby usunąć więcej niż jeden cmentarz naraz, zaznacz pole w kolumnie Wybierz obok każdego cmentarza, który ma zostać usunięty, a następnie kliknij
przycisk "Usuń wybrane" ponad tabelą.</p>
	
	<hr>Uwagi dotyczące polskiego tłumaczenia: <a href="mailto:michal@jarocinscy.pl">michal@jarocinscy.pl</a> lub <a href="mailto:januszkielak@gmail.com">januszkielak@gmail.com</a>. Prosimy zgłaszać ewentualne błędy lub niejasności.

	</td>
</tr>

</table>
</body>
</html>
