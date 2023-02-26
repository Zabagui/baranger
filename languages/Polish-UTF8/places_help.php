<?php
include("../../helplib.php");
echo help_header("Pomoc: Miejsca");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="cemeteries_help.php" class="lightlink">&laquo; Pomoc: Cmentarze</a> &nbsp; | &nbsp;
			<a href="places_googlemap_help.php" class="lightlink">: Mapy Google &raquo;</a>
		</p>
		<span class="largeheader">Pomoc: Miejsca</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Szukaj</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Dodaj lub Edycja</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Usuń</a> &nbsp; | &nbsp;
			<a href="#merge" class="lightlink">Scal</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="search"><p class="subheadbold">Szukanie</p></a>
        <p><p>Znajdź istniejące miejsce szukając jego pełnej nazwy lub jej części. Możesz wybrać drzewo lub zaznaczyć pole "Dokładne dopasowanie" w celu dalszego zawężenia kryteriów wyszukiwania.
              Jeśli nich nie wpiszesz w polu wyszukiwania, wyświetlone zostaną wszystkie miejsca zapisane w bazie danych.</p></p>

		<p>Twoje kryteria wyszukiwania na tej stronie zostaną zapamiętane dopóki nie naciśniesz przycisku <strong>Wyczyść</strong>, który przywraca domyślne wartości i opcje.</p>

		<span class="optionhead">Czynność</span>
		<p>Ikonki w kolumnie "Czynność" obok każdego wyniku wyszukiwania pozwalają na edycję, usuwanie lub podgląd tego wyniku. Aby usunąć więcej niż jeden rekord jednocześnie, kliknij pole w kolumnie
		<strong>Wybierz</strong> dla każdego rekordu, który ma zostać usunięty, a następnie kliknąć przycisk "Usuń wybrane" znajdujący się na górze listy. Użyj <strong>Wybierz wszystko</strong> lub <strong>Wyczyść wszystko</strong>
		aby zaznaczyć lub usunąć zaznaczenie wszystkich pól wyboru naraz.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="add"><p class="subheadbold">Dodaj nowe / Edytuj istniejące miejsca</p></a>

		<p>TNG automatycznie dodaje nowy rekord Miejsca za każdym razem, gdy są dodawane nowe miejsca w Administracja >> Osoby, Administracja >> Rodziny oraz jako część niestandardowego wydarzenia.
                Jeśli wprowadzasz zmiany istniejącego miejsca w którymś z tych działów i jest to nowa, unikatowa nazwa miejsca, utworzony zostanie nowy zapis miejsca.</p>

                <p>Aby dodać nowe miejsce, kliknij przycisk <strong>Dodaj nowe</strong>, a następnie wypełnić formularz. Aby edytować istniejące miejsce, należy użyć przycisku <a href="#search">Szukaj</a> aby zlokalizować miejsce,
                 a następnie kliknąć na ikonkę Edycja obok wybranej linii.</p>
                 <p>Podczas dodawania lub edycji miejsca dostępne są następujące elementy:</p>

		<span class="optionhead">Drzewo</span>
		<p>Wybierz jedno z istniejących drzew. Każde miejsce musi być przypisane do drzewa. <strong> Uwaga: </strong> Drzewo nie może być zmieniane dla raz utworzonego miejsca (zamiast tego musisz usunąć miejsce i dodać je ponownie dla innego drzewa).</p>

		<span class="optionhead">Miejsce</span>
		<p>Podaj nazwę miejsca oraz jego przynależności administracyjnej, podając nazwy jednostek administracyjnych w kolejności do najniższej do najwyższej (oddzielając je przecinkami). Na przykład <em>Jabłoń, Pisz, piski, warmińsko-mazurskie, Polska</em>.
                Nie używaj niejednoznacznych lub mało znanych skrótów.</p>

		<span class="optionhead">Pokaż/ukryj mapę Google</span>
		<p>Kliknij przycisk "Pokaż / Ukryj mapę Google", aby pokazać mapę. Ta opcja jest dostępna tylko jeśli masz "klucz mapy" z Google i wpisałeś go w Ustawienia i konfiguracja >> Konfiguracja >> Ustawienia mapy (patrz <a href="mapsettings_help.php">Pomoc: Ustawienia mapy</a>). Kliknij przycisk ponownie, aby ukryć mapę. Aby wyszukać
                miejscowość na mapie, wpisz jej nazwę w polu <strong>Określenie miejsca Geocode</strong> i kliknij "Szukaj". Możesz też kliknąć  na mapę i przeciągnąć, aby przenieść "szpilkę" na żądaną lokalizację. Można również użyć kontroli Powiększenie, aby pokazać bardziej szczegółowo żądany obszar. Zobacz stronę
		<a href="places_googlemap_help.php">Pomoc: Mapy Google</a> aby uzyskać więcej informacji. W celu uzyskania informacji na temat domyślnych ustawień mapy patrz również <a href="mapsettings_help.php">Pomoc: Ustawienia mapy</a>.</p>

		<span class="optionhead">Szerokość/długość (geograficzna)</span>
		<p>Wprowadź szerokość i długość geograficzną lokalizacji miejsca lub kliknij na wybrany punkt na mapie aby ustawić te wartości (opcjonalnie, patrz wyżej).</p>

		<span class="optionhead">Powiększenie</span>
		<p>Wpisz poziom powiększenia mapy, lub dostosuj poziom przy pomocy suwaka na mapie Google. Ta opcja jest dostępna tylko jeśli masz "klucz mapy" z Google i
                wpisałeś go w Administracja/Ustawienia i konfiguracja/Ustawienia mapy.</p>

		<span class="optionhead">Poziom miejsca</span></p>
		<p>Wybierz poziom miejsca, który najlepiej opisuje poziom lokalizacji reprezentujący nazwę miejsca. Może to pomóc odwiedzającym , jak można było dokładne identyfikować umiejscowienie "szpilki" .</p>

		<span class="optionhead">Przypisy</span>
		<p> Jeśli do opisania cmentarza lub jego lokalizacji potrzebne są dodatkowe informacje, wprowadź je tutaj (opcjonalnie).</p>

		<span class="optionhead">Zmień nazwy miejsca w istniejących wydarzeniach</span>
		<p>Zaznaczenie tego pola (widoczne tylko podczas edycji istniejącego miejsca) spowoduje, że wszystkie wydarzenia, w których to miejsce jest wykorzystywane będą uaktualniane podczas zapisywania zmian.</p>

        <p><strong>UWAGA:</strong> Kolejne importy GEDCOM z wykorzystaniem opcji "Nadpisz Wszystkie dane" <strong>NIE zastępują</strong> ani nie usuwają istniejących danych miejsca, jeżeli istniejące zapisy zawierają informacje o
                szerokości, długości lub przypisach, lub jeśli są załączone jakiekolwiek media.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="delete"><p class="subheadbold">Usuwanie miejsc</p></a>
		<p>Aby usunąć jedno miejsce, należy nacisnąć przycisk <a href="#search">Szukaj</a> w celu jego zlokalizowania, a następnie kliknąć na ikonkę Usuń  obok tego miejsca. Wiersz zmieni kolor,
		a następnie zniknie. Miejsce zostało usunięte. Aby usunąć więcej niż jedno miejsce naraz, zaznacz pole w kolumnie Wybierz obok każdego miejsca, które ma zostać usunięte, a następnie kliknij
                przycisk "Usuń wybrane" znajdujący się na górze strony.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="merge"><p class="subheadbold">Scalanie miejsc</p></a>
		Aby dokonać scalenia nazw miejsc, których nazwy mogą być nieco inne, lecz odnoszą się do tej samej lokalizacji, kliknij na "Scalanie".</p>

		<span class="optionhead">Znajdż kandydatów do scalenia</span>
		<p>Najpierw wybierz drzewo. Nie można scalać  miejsc z różnych drzew, a więc możesz wybrać tylko jedno drzewo. Wprowadź kryteria wyszukiwania,
                które będą wspólne dla wszystkich potencjalnych duplikatów, a następnie kliknij przycisk "Kontynuuj" (na przykład, możesz wpisać <em>Salt Lake</em> aby znaleźć
		<em>Salt Lake</em> i <em>Salt Lake City</em>).</p>

		<span class="optionhead">Wybierz miejsca do scalenia</span>
		<p>Na tej karcie można będzie zobaczyć listę miejsc pasującą do kryteriów wyszukiwania. Jeśli którykolwiek z nich odnosi się do tej samej lokalizacji, zaznacz pole
                "scal te (usuń)" po lewej stronie dla każdego z nich. Każdy wybrany wiersz będzie podświetli się na czerwono. Następnie kliknij kółko w kolumnie oznaczonej "do tego (zachowaj)".
                Będzie to nazwa miejsca, która zastąpi wszystkie zaznaczone miejsca. Ten wiersz stanie się zielony. Nie ma znaczenia, czy nazwa miejsca do zachowania jest również jednym z tych
                zaznaczonych w ramach "scal te (usuń)". Będziesz mógł wybrać tylko jeden zapis w kolumnie "zachowaj", ale można wybrać dowolną liczbę duplikatów aby je z nim scalić.
                Jeśli jesteś gotowy do scalania, kliknij przycisk "Scal miejsca" na górze lub na dole ekranu. Wszystkie nazwy usuniętych miejsc (w zapisach osób i rodzin) zostaną zastąpione przez nazwę
                aktualnie wybranego. <strong>Uwaga:</strong> informacje w polach Przypis i Szerokość / długość  będzie tylko zachowane dla miejsca które pozostaje.</p>
		
		<p>Aby ponownie szukać duplikatów, wystarczy wpisać nową wartość w polu "Szukaj" u góry ekranu i kliknąć przycisk "Kontynuuj".</p>
	
	<hr>Uwagi dotyczące polskiego tłumaczenia: <a href="mailto:michal@jarocinscy.pl">michal@jarocinscy.pl</a> lub <a href="mailto:januszkielak@gmail.com">januszkielak@gmail.com</a>. Prosimy zgłaszać ewentualne błędy lub niejasności.
	</td>
</tr>

</table>
</body>
</html>
