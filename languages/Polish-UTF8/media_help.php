<?php
include("../../helplib.php");
echo help_header("Pomoc: Media");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="more_help.php" class="lightlink">&laquo; Pomoc: Więcej</a> &nbsp; | &nbsp;
			<a href="collections_help.php" class="lightlink">Pomoc: Kolekcje &raquo;</a>
		</p>
		<span class="largeheader">Pomoc: Media</span>
		<p class="smaller menu">
			<a href="#search" class="lightlink">Szukaj</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Dodaj</a> &nbsp; | &nbsp;
			<a href="#edit" class="lightlink">Edycja</a> &nbsp; | &nbsp;
			<a href="#delete" class="lightlink">Usuń</a> &nbsp; | &nbsp;
			<a href="#convert" class="lightlink">Konwertuj</a> &nbsp; | &nbsp;
			<a href="#album" class="lightlink">Dodaj do albumu</a> &nbsp; | &nbsp;
			<a href="#sort" class="lightlink">Sortuj</a> &nbsp; | &nbsp;
			<a href="#thumbs" class="lightlink">Miniaturki</a> &nbsp; | &nbsp;
			<a href="#import" class="lightlink">Import</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="search"><p class="subheadbold">Szukanie</p></a>
        <p>Znajdź istniejące media wpisując <strong>ID Medium, Tytuł, Opis, Łącze, Właścicela</strong> albo
		<strong>tekst Body</strong> (tylko dla historii) lub ich część. Wybierz jedną z dostępnych opcji w celu dalszego zawężenia kryteriów wyszukiwania.
Jeśli nie wybierzesz żadnej z proponowanych opcji, w polu wyszukiwania wyświetlą się wszystkie media zapisane w bazie danych. Opcje szukania zawierają:</p>

		<span class="optionhead">Drzewo</span>
		<p>Ogranicza wyniki do mediów przypisanych do wybranego drzewa.</p>

		<span class="optionhead">Kolekcja</span>
		<p>Ogranicza wyniki wyszukiwania do mediów z wybranej kolekcji. Aby dodać nową kolekcję, kliknij na "Dodaj kolekcję", a następnie wypełnij formularz w okienku (popup).
Aby utworzyć folder dla nowej kolekcji, należy utworzyć własną ikonkę (lub wybrać istniejącą). Pole "Takie same ustawienie jak" pozwala na wskazanie
jednego ze standardowych rodzajów kolekcji TNG, z jakiego nowa kolekcja powinna przejąć ustawienia.</p>

		<span class="optionhead">Rozszerzenie pliku</span>
		<p>Podaj rozszerzenie pliku (np. "jpg" lub "gif") przed kliknięciem przycisku Szukaj, aby ograniczyć wyniki wyszukiwania do mediów z nazwami plików mającymi takie rozszerzenie.</p>

		<span class="optionhead">Tylko bez łączy</span>
		<p>Zaznacz to pole, aby ograniczyć wyniki wyszukiwania do mediów, które nie są powiązane z żadnymi osobami, rodzinami, źródłami, repozytoriami lub miejscami.</p>

  		<span class="optionhead">Status</span>
		<p><strong>(Tylko nagrobki)</strong> Wybierz status nagrobka rozwijanej listy, aby wyszukać tylko nagrobki o tym statusie.</p>

		<span class="optionhead">Cmentarz</span>
		<p><strong>(Tylko nagrobki)</strong> Wybierz z listy cmentarz, aby wyszukać tylko nagrobki z tego cmentarza.</p>

		<p>Kryteria wyszukiwania na tej stronie zostaną zapamiętane, dopóki nie naciśniesz przycisku <strong>Wyczyść</strong>, który przywraca domyślne wartości wszystkich kryteriów.</p>

		<span class="optionhead">Czynność</span>
		<p>Ikony w kolumnie "Czynność" obok każdego wyniku wyszukiwania pozwalają na edycję, usuwanie lub podgląd tego wyniku.
<br/>Aby usunąć jednocześnie więcej rekordów, pozaznaczaj pole w kolumnie
<strong>Wybierz</strong> dla każdego rekordu, który ma zostać usunięty, a następnie kliknij przycisk "Usuń wybrane" znajdujący się ponad listą. Użyj <strong>Wybierz wszystko</strong> lub <strong>Wyczyść wszystko</strong> aby zaznaczyć lub usunąć zaznaczenie wszystkich pól naraz.
<br/>Można również konwertować wiele mediów z jednej kolekcji do innej, lub dodawać do albumu w podobny sposób (patrz poniżej, aby uzyskać więcej informacji).</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="add"><p class="subheadbold">Dodawanie nowych mediów</p></a>
		<p>Aby dodać nowe media, kliknij przycisk <strong>Dodaj nowe</strong> a następnie wypełnij formularz. Niektóre informacje, w tym Mapa zdjęcia, informacje o lokalizacji, oraz łącza do osób, rodzin itp. mogą zostać dodane dopiero po kliknięciu na "Zapisz i kontynuuj". Do dyspozycji są następujące pola:</p>

		<span class="optionhead">Kolekcja</span>
		<p>Wybierz z rozwijanej listy kolekcję, do której ma zostać dodane medium (Zdjęcia, Dokumenty itd.) Nie ma ograniczeń dotyczących rozzerzeń (typów) plików dla żadnej z <span class="emphasis">kolekcji</span>.<br/>Jeżeli docelowa kolekcja jeszcze nie istnieje, można ją teraz utworzyć klikając "Dodaj kolekcję" - tak jak to już opisano w części <a href="#search">Szukaj</a></p>

		<span class="optionhead">To medium pochodzi z zewnętrznego źródła</span>
		<p>Zaznacz to pole, jeśli Twoje medium znajduje się w innym miejscu niż na Twoim serwerze. Musisz podać URL tzn. pełną ścieżkę dostępu do tego medium (np. "http://www.thatsite.com/image.jpg"). Jeśli chcesz mieć miniaturkę medium, musisz dostarczyć swoją (TNG jej dla takiego medium nie utworzy).</p>

		<span class="optionhead">Plik mediów</span>
		<p>Użyj przycisku "Wybierz plik", aby wskazać plik medium na swoim komputerze, albo podaj nazwę pliku znajdującego się on już na serwerze lub wyszukaj go tam używając przycisku "Wybierz..."</p>

		<p><strong>UWAGA</strong>: Jeśli załadowujesz nowe pliki, zarówno one jak i zawierające je katalogi muszą mieć ustawienia dostępu pozwalające na dostęp do nich. Jeśli nie, użyj programu FTP albo skontaktuj się z Administratorem, aby nadać właściwe uprawnienia (powinny być ustawione na 775, ale w niektórych przypadkach wymagane jest 777).<br>
Nie można w nazwach plików stosować polskich liter (takich jak np. ą czy ę), przecinków ani kropek (z wyjątkiem kropki przed rozszerzeniem pliku - .jpg czy .gif). Nie powinno się również używać spacji. Na przykład zdjęcie o nazwie "zdjęcie Józefa Mrówczyńskiego 12.11.1988.jpg" może być poprawnie zapisane jako "zdjecie_jozefaMrowczynskiego_12_11_1988.jpg".</p>

		<span class="optionhead">ALBO Tekst główny (tylko dla Historii)</span>
		<p>Zamiast przesyłania plików tekstowych do historii, można tu wpisać lub wkleić tekst lub kod HTML. Można przy tym wykorzystać kontrolki (nad oknem tekstu) do formatowania tekstu. Ustawienie myszy nad kontrolką powoduje wyświetlenie podpowiedzi dla tej kontrolki.</p>

		<p><strong>UWAGA:</strong> Jeśli użyjesz HTML, <strong>nie może</strong> on zawierać znaczników &lt;html&gt; lub &lt;body&gt;.</p>

		<span class="optionhead">Plik miniaturki</span>
		<p>Bedziesz tu mógł zlecić TNG utworzenie miniaturki (o ile tylko Twój serwer wspiera bibliotekę GD Image Library, co zazwyczaj ma miejsce), albo wskazać do wykorzystania istniejący plik z twojego komputera lub ze strony www.</p>

		<span class="optionhead">Twórz z oryginału / Określone zdjęcie</span>
		<p>Jeżeli wybierzesz opcję "Twórz z oryginału" plik miniaturki będzie miał domyślnie nazwę taką jak oryginał, tyle że dołączony zostanie na początku prefiks lub na końcu sufiks, stosownie do ustawień Administracja >> Ustawienia główne. TNG może utworzyć miniaturkę tylko wtedy, jeżeli medium jest w obowiązującym formacie JPG, GIF lub PNG; może jednak reklamować, jeśli miniaturka ma zostać utworzona ze zbyt dużego zdjęcia (znacznie ponad 1 MB).
<br/>
<strong>UWAGA:</strong> Miniaturka <strong>NIE MOŻE</strong> być tym samym obrazem co oryginał!
TNG zgłosi zastrzeżenia jeżeli spróbujesz użyć oryginalnego obrazu jako miniaturki.</p>

		<span class="optionhead">Plik do załadowania</span>
		<p>Jeśli sobie życzysz, miniatury obrazów każdego zdjęcia związanego z osobą są wyświetlane na jej stronie. Jeśli dla Twojego medium nie ma jeszcze na serwerze załadowanego pliku miniaturki, kliknij przycisk "Przeglądaj" i zlokalizuj miniaturkę w Twoim komputerze.</p>

		<span class="optionhead">Nazwa pliku na serwerze</span>
		<p>Jeśli poprzednio załadowałeś własną miniaturkę, podaj jej ścieżkę dostępu i dokładną nazwę pliku taką, jaka zapisana jest w odpowiednim dla danej kolekcji folderze na serwerze (rada: jeśli chcesz trzymać miniaturki i oryginały oddzielnie, możesz je zapisywać w
folderze podrzędnym. Będą mogły mieć te same nazwy, jak oryginały). Jeśli nie znasz dokładnej nazwy pliku, możesz kliknąć przycisk Wybierz, aby go wyszukać na serwerze. Sugerowana ścieżka dostępu i nazwa pliku zostaną dla Ciebie wypełnione.</p>

		<p><strong>UWAGA</strong>: Jeśli załadowujesz nowe pliki, zarówno one jak i zawierające je katalogi muszą mieć ustawienia dostępu pozwalające na dostęp do nich. Jeśli nie, użyj programu FTP albo skontaktuj się z Administratorem, aby nadać właściwe uprawnienia (powinny być ustawione na 775, ale w niektórych przypadkach wymagane jest 777).</p>

		<span class="optionhead">Zapisz pliki w: Folder kolekcji (np."Zdjęcia") / Folder multimediów</span>
		<p>Możesz wybrać zapisywanie mediów w folderze odpowiadającym wybranej kolekcji (opcja domyślna), lub w ogólnym folderze multimediów.</p>

		<span class="optionhead">Szerokość, wysokość</span>
		<p><strong>(dotyczy tylko filmów)</strong> Niektóre odtwarzacze wideo (np. Quicktime) wymagają podania wymiarów filmu. Jeśli nie będą one wyszczególnione,
film może zostać za mocno obcięty i jego fragmenty nie będą widoczne. Dlatego zalecamy podanie tutaj wymiarów Twojego filmu w pikselach. Proszę też pamiętać o
pozostawieniu około 16 pionowych pikseli dla pulpitu sterowania odtwarzacza wideo ( odtwarzanie / stop / regulacje głośności, itp.).</p>

		<p><span class="optionhead">Informacje o nowych mediach</span></p>

		<span class="optionhead">Tytuł</span>
		<p>Powinno to być krótka nazwa &#151; służąca do identyfikacji Twojego medium. Ta nazwa będzie użyta jako łącze do strony pokazującej Twoje medium.</p>

		<span class="optionhead">Opis</span>
		<p>Tutaj możesz podać więcej informacji o przedstawionym medium. Będą one widoczne jako przypis towarzyszący Tytułowi (poprzednie pole).</p>

		<span class="optionhead">Właściciel/Źródło, Data wykonania, Miejsce wykonania</span>
		<p>Są to pola opcjonalne. Jeśli posiadasz jakieś informacje, wpisz je tutaj.</p>

		<span class="optionhead">Drzewo</span>
		<p>Jeśli chciałbyś łączyć to medium z wybranym drzewem, wybierz to drzewo tutaj. Mogą to robić tylko użytkownicy mający uprawnienia do edycji danych dotyczących tych drzew.</p>

		<span class="optionhead">Cmentarz</span>
		<p><strong>(Tylko nagrobki)</strong> Wybierz z listy cmentarz, na którym znajduje się nagrobek. Musisz najpierw dodać cmentarz (pod Admin / Cmentarze) zanim będzie on widoczny w tym polu.</p>

		<span class="optionhead">Sektor</span>
		<p><strong>(Tylko nagrobki)</strong> Sektor, w którym zlokalizowany jest nagrobek (opcjonalne).</p>

		<span class="optionhead">Status</span>
		<p><strong>(Tylko nagrobki)</strong> Wybierz z listy określenie, które najlepiej opisuje okoliczność dotyczącą nagrobka.</p>

		<span class="optionhead">Zawsze widoczne</span>
		<p>Zaznacz to pole, jeśli chcesz, aby to medium było widoczne dla wszystkich bez względu na to, czy połączone z nim osoby są zapisane jako żyjące i niezależnie od uprawnień użytkownika.</p>

		<span class="optionhead">Otwieraj w nowym oknie</span>
		<p>Zaznacz to pole, jeśli chcesz, aby po kliknięciu na jego łącze to medium otwierało się w nowym oknie.</p>

		<span class="optionhead">Ustaw jako zdjęcie wybranego cmentarza</span>
		<p><strong>(Tylko nagrobki)</strong> Zaznacz to pole, aby połączyć to zdjęcie nagrobka z samym cmentarzem. Kiedy otworzy się ta strona, będą na niej widoczne wszystkie nagrobki zapisane dla tego cmentarza, zaś to zdjęcie zaś pokaże się jako pierwsze.</p>

		<span class="optionhead">Pokaż mapę cmentarza za każdym razem, kiedy to zdjęcie zostanie wybrane</span>
		<p><strong>(Tylko nagrobki)</strong> Zaznacz to pole, jeśli dla cmentarza, na którym znajduje się ten nagrobek, istnieje mapa lub zdjęcie. Będzie ona widoczna zawsze razem z tym nagrobkiem.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="edit"><p class="subheadbold">Edycja istniejących mediów</p></a>
		<p>Aby wprowadzić zmiany do istniejących mediów, znajdź je w zakładce <a href="#search">Szukaj</a> w celu znalezienia medium, a następnie kliknij na ikonę Edycja obok tego elementu.
		 Do dypozycji będą dodatkowe możliwości, których nie było w "Dodaj nowe":</p>

		<span class="optionhead">Linki mediów</span>
		<p>Możesz tworzyć łącza mediów do osób, rodzin, źródeł, repozytoriów lub miejsc. Dla każdego łącza, należy najpierw wybrać drzewo związane z łączonym medium. Następnie typ łącza
(Osoba, Rodzina, Źródło, Repozytorium, Miejsce) i wreszcie wprowadzić numer ID lub nazwę (tylko w przypadku miejsca) łączonego podmiotu. Po wykonaniu tych czynności kliknij przycisk "Dodaj".</p>

		<p>Jeśli nie znasz numeru ID lub dokładnej nazwy miejsca, kliknij na ikonę lupy aby w celu wyszukiwania. Pojawi się okienko popup. Gdy znajdziesz żądany opis podmiotu,
		kliknij przycisk "Dodaj" po lewej stronie. Możesz kliknąć "Dodaj" dla wielu podmiotów. Po zakończeniu tworzenia  łączy kliknij na czerwone pole z krzyżykiem w prawym górnym rogu.</p>

		<p><strong>Istniejące łącza:</strong> Możesz edytować lub usuwać istniejące łącza mediów klikając na ikonę Edycja lub Usuń obok wybranego łącza. Edycja łącza umożliwia
jego skojarzenie wydarzeniem oraz wpisanie <strong>dodatkowego tytułu</strong> i <strong>dodatkowego opisu</strong>.</p>

		<p><strong>OSTRZEŻENIE</strong>: Łącza do wydarzeń niestandardowych utworzonych w ramach TNG mogą zostać nadpisane przy następnym imporcie GEDCOM.</p>

		<span class="optionhead">Zdjęcie standardowe</span>
		<p>Zaznacz to pole podczas edycji łączy mediów, aby użyć miniaturki tego medium w diagramach i w tytułowych częściach innych stron związanych z daną osobą lub obiektem, które są z nim połączone.</p>

		<span class="optionhead">Opisy postaci na zdjęciu</span>
		<p>Ta sekcja jest przy starcie zamknięta. Aby ją rozwinąć, kliknij na napis "Opisy postaci na zdjęciu" lub strzałkę obok niego. Wyświetlona zostanie krótka instrukcja. Możliwe tu będzie łączenie fragmentów obrazu z osobami w bazie danych, lub do wyświetlania krótkich wiadomości,
kiedy wskaźnik myszy zostanie umieszczony nad tymi fragmentami.</p>

		<p><strong>Uwaga</strong>: Abyś mógł skorzystać z tej funkcji, medium musi być zapisane w formacie JPG, GIF lub PNG.</p>

		<p>Jeśli chcesz utworzyć łącze do osoby, musisz po pierwsze wybrać jej drzewo, a następnie kształt (okrąg albo prostokąt) obszaru ( złożone kształty są również możliwe, ale musisz sam dostarczyć dla nich tekst lub kod łącza).
Następnie postępuj według instrukcji dla wybranego kształtu, aby we właściwy sposób wybrać współrzędne łącza. Gdy współrzędne zostały wybrane, ukaże się okienko "Znajdź ID osoby". Podaj nazwisko oraz / lub imię (lub jego część) albo ID osoby.
Okienko zamknie się, kiedy klikniesz na wybraną osobę i tekst lub kod łącza dla wybranego obszaru zostanie dodany do pola "Opisy postaci na zdjęciu". Jeśli jest to konieczne, możesz ten tekst lub kod łącza edytować.</p>

		<p>Powtórz ten proces dla wszystkich obszarów, które będziesz potrzebował. Wszystkie nowe teksty lub kody łączy będą dodane w polu "Opisy postaci na zdjęciu".</p>

		<p>Aby połączyć różne fragmenty zdjęcia do różnych stron, lub uzyskać wyświetlanie krótkich wiadomości, kiedy wskaźnik myszy znajduje się nad tymi fragmentami, wprowadź potrzebny kod mapy zdjęcia w tym polu.
Aby budować własną mapę zdjęcia, wykorzystaj pole "Mapa zdjęcia HTML" na dole strony (pod zdjęciem).</p>

		<span class="optionhead">Miejsce wykonania zdjęcia</span>
		<p><p>Ta sekcja jest przy starcie zamknięta. Aby ją rozwinąć, kliknij na napis "Miejsce wykonania zdjęcia" lub strzałkę obok niego. Jeśli znasz nazwę miejsca, gdzie zdjęcie zostało zrobione, wpisz ją w polu "Miejsce wykonania zdjęcia".</p>

		<span class="optionhead">Szerokość, Długość (geograficzna)</span>
		<p>Jeśli znasz współrzędne geograficzne miejsca związanego z tym medium, wpisz je tutaj, aby pomóc innym dokładniej zlokalizować dane miejsce.
		Alternatywnie możesz użyć funkcji geocode Google Map, aby ustawić szerokość i długość geograficzną lokalizacji mediów. Kliknij na "Pokaż/ukryj mapę Google", aby zobaczyć mapę Google.
<br/>Ta opcja jest dostępna tylko jeśli masz "klucz mapy" z Google i wpisałeś go w Ustawienia i konfiguracja >> Konfiguracja >> Ustawienia mapy.</p>

		<span class="optionhead">Powiększenie</span>
		<p>Wpisz poziom powiększenia mapy, lub dostosuj poziom przy pomocy suwaka na mapie Google.</p>

		<p>Uwaga: Szerokość/Długość/Zoom to dane o lokalizacji mediów tylko w celach informacyjnych. Ta lokalizacja nie jest oznakowana na mapie w strefie publicznej.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="delete"><p class="subheadbold">Usuwanie mediów</p></a>
		<p>Aby usunąć jedno medium, należy nacisnąć przycisk <a href="#search">Szukaj</a> w celu jego zlokalizowania, a następnie kliknąć na ikonę Usuń  obok tego medium. Wiersz zmieni kolor,
		a następnie zniknie. Medium zostało usunięte. Aby usunąć więcej niż jedno medium naraz, zaznacz pole w kolumnie Wybierz obok każdego medium, które ma zostać usunięte, a następnie kliknij
przycisk "Usuń wybrane" znajdujący się nad listą mediów.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="convert"><p class="subheadbold">Konwertowanie mediów z jednej kolekcji do drugiej</p></a>
		Aby przekonwertować media z jednej kolekcji do innej, zaznacz je w kolumnie "Wybierz" na karcie Szukaj a następnie wybierz nową kolekcję z rozwijanej listy u góry strony
obok przycisku "Wybrane konwertuj do". Po dokonaniu wyboru kliknij ten przycisk. Strona zostanie otwarta ponownie i ukaże się czerwony napis informujący o statusie operacji.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="album"><p class="subheadbold">Dodawanie mediów do albumów</p></a>
		Aby dołączyć media do albumu, zaznacz odpowiednie pozycje w kolumnie "Wybierz" na karcie Szukaj, a następnie wybierz album z rozwijanej listy u góry strony obok przycisku "Dodaj do albumu". Po dokonaniu
wyboru kliknij ten przycisk. Media mogą być także dodane do albumów w Administracja / Albumy.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="sort"><p class="subheadbold">Sortowanie mediów</p></a>
		<p>Domyślnie media połączone z osobami, rodzinami, źródłami, repozytoriami lub miejscami są sortowane według kolejności, w jakiej zostały utworzone łącza. Aby zmienić tę kolejność, możesz w zakładce
Media / Sortuj przesuwać media według życzenia.</p>

		<span class="optionhead">Drzewo, Rodzaj łącza, Kolekcja:</span>
		<p>Wybierz z drzewo związane z podmiotem, dla którego chcesz sortować media. Następnie wybierz typ łącza z rozwijanej listy (Osoba, Rodzina, Źródło, Repozytorium, Miejsce), a także kolekcję, w której chcesz posortować media.</p>

		<span class="optionhead">ID:</span>
		<p>Wprowadź numer ID lub nazwę (tylko miejsca) podmiotu. Jeśli nie znasz numeru ID lub dokładnej nazwy miejsca, kliknij ikonę lupy w celu ich wyszukania. Po znalezieniu żądanego podmiotu, kliknij przycisk
"Wybierz" obok danego podmiotu. Okienko popup zostanie zamknięte i w polu ID pojawi się wybrany identyfikator.</p>

        <span class="optionhead">Łącze do wydarzeń niestandardowych</span>
		<p>Jeśli chcesz posortować tylko media  połączone z określonymi wydarzeniami związanymi z łączem podmiotu, zaznacz pole "Łącze do określonego wydarzenia". Możesz to jednak uczynić dopiero, kiedy wszystkie
inne pola zostaną wypełnione &mdash; w tym numer ID. Spowoduje to otwarcie dodatkowego pola, w którym można wybrać określone wydarzenie (opcjonalnie).</p>

		<span class="optionhead">Procedura sortowania</span>
		<p>Po wybraniu lub wprowadzeniu numeru ID kliknij "Kontynuuj", aby wyświetlić wszystkie media dla wybranych podmiotów i ich kolekcji w aktualnym porządku. Aby zmienić kolejność pozycji, kliknij na pole "Przeciągnij"
dla każdego medium, przytrzymaj przycisk myszy a następnie przesuń wskaźnik myszy do żądanej lokalizacji w obrębie listy, po czym zwolnij przycisk myszy ("przeciągnij i upuść"). Zmiany są zapisywane automatycznie .</p>

		<span class="optionhead">Zdjęcie standardowe</span>
		<p>Podczas sortowania, możesz również wybrać dowolne zdjęcie jako "zdjęcie domyślne". Oznacza to, że miniaturka wybranego zdjęcia będzie wyświetlana na diagramach i nagłówkach aktualnie wybranej nazwy podmiotu lub tytułu.
Aby ustawić lub usunąć zdjęcie standardowe, zatrzymaj wskaźnik myszy nad dowolnym z widocznych zdjęć a następnie kliknij na jedną z opcji "Jako standard" lub "Usuń". Aktualne zdjęcie standardowe może zostać również usunięte
przez kliknięcie przycisku "Usuń zdjęcie standardowe" u góry strony.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="thumbs"><p class="subheadbold">Miniatury</p></a>

		<span class="optionhead">Tworzenie miniaturek</span>
		<p> Kiedy klikniesz na przycisk "Twórz", TNG automatycznie utworzy miniaturki dla wszystkich plików JPG, GIF oraz PNG, które jej jeszcze nie mają. Nazwa nowej miniaturki będzie taka jak oryginału, ale będzie poprzedzona
prefiksem zdefiniowanym w Ustawieniach ogólnych. Zaznacz pole "Regeneruj istniejące miniaturki", aby ponownie utworzyć miniaturki dla mediów, które już je posiadają.
"Regeneruj nazwę ścieżki pliku miniaturki jeśli plik nie istnieje" jeśli sądzisz, że niektóre miniaturki dotyczą nieprawidłowych plików. To spowoduje przywrócenie przez TNG nazw łączy miniaturek przed ich regeneracją.</p>

		<p><strong>Uwaga</strong>: Jeśli nie widzisz pola Twórz miniaturki, Twój serwer nie wspiera biblioteki GD Image Library.</p>

		<span class="optionhead">Tworzenie zdjęć standardowych</span>
		<p>Ta opcja pozwala na wybranie pierwszego zdjęcia dla każdej osoby, rodziny i źródła jako zdjęcia standardowego (wyświetlanych w nagłówkach diagramów, arkuszy osób i rodzin oraz innych stron tego podmiotu).
Przyporządkowanie może być dokonane dla wszystkich osób, rodzin, źródła i repozytoriów w wybranym drzewie. Zaznacz pole "Nadpisz aktualne ustawienia standardowe", aby zmienić przyporządkowanie niezależnie od tego,
które zostało wcześniej ustalone. Jeśli nie zaznaczysz tego pola, poprzednie ustawienia pozostaną bez zmian.</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="import"><p class="subheadbold">Import zdjęć</p></a>

		<p>Ta funkcja tworzy zapis medium dla każdego pliku w dowolnym Twoim folderze mediów TNG z tytułem takim jak nazwa pliku. Do przeprowadzenia importu wybierz najpierw Kolekcję (lub wcześniej utwórz nową kolekcję) oraz drzewo
(jeżeli importowana zawartość powinna być połączona z tym drzewem). Następnie kliknij przycisk "Import". Jeżeli istnieje już zapis dla tej zawartości, to nowy zapis nie zostanie utworzony.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<p style="float:right"><a href="#top">Wróć</a></p>
		<a name="upload"><p class="subheadbold">Ładowanie plików mediów na serwer</p></a>

		<span class="optionhead">Cel i sposób użycia</span>
		<p>Zakładka "Załaduj" umożliwia załadowanie na serwer wielu mediów na raz, a następnie nadanie im lepszych tytułów i opisów oraz powiązanie ich z osobami, rodzinami, źródłami lub miejscami.</p>

		<p>Najpierw należy wybrać kolekcję z rozwijanej listy oraz drzewo (jeżeli obiekty mają być powiązane z konkretnym drzewem), a następnie kliknąć przycisk "Dodaj pliki" aby wybrać pliki mediów z komputera. Większość przeglądarek umożliwi także przeciąganie plików do białego obszaru poniżej przycisków na tym ekranie. Jeżeli pliki mają trafić do podkatalogu wybranego katalogu mediów, można wprowadzić nazwę podkatalogu w polu Folder albo użyć przycisku Wybierz umożliwiającego wybranie istniejącego katalogu. Jeżeli wskazanie podkatalogu jest niepotrzebne, należy zostawić to pole puste.</p>

		<p>Po wybraniu plików oraz ich miejsca przeznaczenia można rozpocząć ładowanie wszystkich plików przez kliknięcie przycisku "Zacznij wysyłanie". Można też ładować pliki pojedyńczo klikając przycisk "Start" obok nazwy każdego pliku.
Po zakończeniu ładowania można nadać nowe tytuły i opisy, a także powiązać media z obiektami w bazie danych, ewentualnie pousuwać je.</p>

		<span class="optionhead">Zmiana tytułu i opisu</span>
		<p>Po załadowaniu pliku wyświetlaja sie pola Tytuł i Opis, których zawartość jest tworzona z nazwy pliku. Można je zmienić wpisując żądaney tekst i klikając przycisk "Zapisz". Inne informacje można będzie dodać później edytując media, jak to opisano w rozdziale <a href="#edit">Edycja istniejących mediów</a></p>

		<span class="optionhead">Dodaj łącza</span>
		<p>Powiązanie mediów z obiektami w bazie danych jest możliwe po zakończeniu ładowania plików.Można wówczas kliknąć przycisk "Łącza mediów" w linii danego pliku.
Wprowadź identyfikator ID lub użyj ikonki Wyszukaj (lupka) w celu znalezienia i wyboru żądanego obiektu.
<br/>W celu wygodnego powiązania wielu mediów z tym samym obiektem należy zaznacz pola Wybierz w wierszu każdego z tych mediów (albo użyj "Zaznacz wszystko"), a następnie użyj pól w dolnej części strony aby zakończyć definiowanie łączy. Jeżeli w polu ID wyświetlony jest identyfikator i wybrane zostało przynajmniej jedno medium, kliknięcie przycisku "Link do wybranych" spowoduje utworzenie wszystkich żądanych łączy.</p>
	
	<hr>Uwagi dotyczące polskiego tłumaczenia: <a href="mailto:michal@jarocinscy.pl">michal@jarocinscy.pl</a> lub <a href="mailto:januszkielak@gmail.com">januszkielak@gmail.com</a>. Prosimy zgłaszać ewentualne błędy lub niejasności.
	</td>
</tr>

</table>
</body>
</html>
