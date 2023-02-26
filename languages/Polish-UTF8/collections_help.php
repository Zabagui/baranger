<?php
include("../../helplib.php");
echo help_header("Pomoc: Kolekcje");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="media_help.php" class="lightlink">&laquo; Pomoc: Media</a> &nbsp; | &nbsp;
			<a href="albums_help.php" class="lightlink">Pomoc: Albumy &raquo;</a>
		</p>
		<span class="largeheader">Pomoc: Kolekcje</span>
		<p class="smaller menu">
			<a href="#what" class="lightlink">Co to jest kolekcja?</a> &nbsp; | &nbsp;
			<a href="#add" class="lightlink">Dodaj/Eytuj/Usuń</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="what"><p class="subheadbold">Co to są kolekcje?</p></a>

		<p><strong>Kolekcja</strong> w TNG odnosi się do rodzaju mediów. Standardowymi kolekcjami w TNG 
są  zdjęcia, dokumenty, nagrobki, historie, filmy i nagrania. TNG pozwala jednak również na tworzenie 
własnych kolekcji. Kolekcja nie jest ograniczona do jednego formatu (rodzaju) plików.
Na przykład zdjęcia w formacie jpg mogą być częścią każdej kolekcji, nie tylko zdjęć lub dokumentów. 
Kolekcja zdjęć nie musi zawierać wyłącznie plików graficznych.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="add"><p class="subheadbold">Dodawanie kolekcji</p></a>

		<p>Aby dodać nową kolekcję, kliknij na przycisk "Dodaj kolekcję" tam gdzie jest on widoczny
(na przykład w dziale Media na kartach Szukaj i Dodaj nowe).
Kiedy pojawi się okienko popup, wypełnij formularz. Do dyspozycji są następujące pola:</p>

		<span class="optionhead">ID kolekcji</span>
		<p>ID kolekcji to krótki ciąg znaków alfanumerycznych. Nie powinien by dłuższy niż 10 znaków.
Na przykład, jeśli tworzysz kolekcję dla tematów wojskowych, możesz podać "wojsko" jako jej ID.
Ta wartość nie będzie wyświetlana więc to, jak ją nazwiesz nie jest ważne, o ile jest unikalna.</p>

		<span class="optionhead">Wyświetlany tytuł</span>
		<p>Nazwa ta będzie wyświetlana na liście kolekcji i gdy będą pokazywane elementy tej kolekcji.
Wyświetlany tytuł może być nieco dłuższy niż ID kolekcji, ale powinien być nadal stosunkowo krótki.
Korzystając z tego samego przykładu możesz wpisać "Zdjęcia z wojska" jako nazwę dla tej kolekcji.
Jeśli korzystasz na Twojej stronie z wielu języków i chcesz by wyświetlany tytuł został przetłumaczony, 
musisz utworzyć wpis w pliku "cust_text.php" w folderze każdego języka. W kluczu wiadomości $text należy 
wpisać ID, a wartość jest wyświetlanym tytułem. Dla tego przykładu Twój wpis będzie wyglądać następująco:</p>
		<pre>$text['wojsko'] = "Zdjęcia z wojska";</pre>

		<p>Musisz powielić plik cust_text.php dla każdego języka, tłumacząc tylko nazwę "Zdjęcia z wojska". Ani klucz ani ID ("wojsko") nie może być tłumaczone.</p>

		<span class="optionhead">Nazwa folderu</span>
		<p>Nazwa folderu (katalogu) na serwerze Twojej strony internetowej, w którym będą przechowywane 
elementy tej kolekcji. Powinna być stosunkowo krótka, bez spacji i składać się wyłącznie ze
znaków alfanumerycznych (np. "wojsko"). Po wprowadzeniu wartości, możesz kliknąć na przycisk "Twórz 
folder". Powinien pojawić się komunikat informujący, czy tworzenie było udane, czy nie.
Jeśli serwer nie pozwala na tę operację, będziesz musiał skorzystać z programu FTP lub menedżera plików 
online w celu utworzenia folderu. Powinien on zostać utworzony w tym samym folderze
nadrzędnym co "zdjęcia", "dokumenty", "historie" i inne foldery kolekcji. Upewnij się, że jego 
rzeczywista nazwa odpowiada dokładnie nazwie wpisanej tutaj ("Wojsko" to nie to samo co "wojsko").</p>

		<span class="optionhead">Plik ikony</span>
		<p>Musisz utworzyć własną ikonę lub użyć jednej z już istniejących i podać nazwę pliku ikony.
Plik ikony powinien znajdować się w głównym folderze grafik TNG (tzn. <i>img</i>), wraz z innymi standardowymi ikonami mediów (np. "tng_photo.gif" lub "tng_doc.gif").</p>

		<span class="optionhead">Kolejność wyświetlania</span>
		<p>Wpisz tutaj liczbę aby wskazać kolejność wyświetlania w menu publicznym niestandardowych
kolekcji. Jako pierwsze pojawiają się najniższe numery.</p>

		<span class="optionhead">Takie same ustawienia jak</span>
		<p>Być może zauważyliście, że karty Dodaj nowe i Edycja zmieniają się nieco w zależności od 
wybranej kolekcji. Pole "Takie same ustawienia jak" pozwala na wskazanie jednej ze standardowych 
kolekcji, którą w odniesieniu do układu tych kart powinna najbardziej przypominać nowa kolekcja.</p>

		<p class="subheadbold">Edycja/Usuwanie kolekcji</p></a>

		<p>Aby edytować istniejące niestandardowe kolekcje (standardowe nie mogą być edytowane, chyba że 
w Ustawieniach głównych), zaznacz kolekcję na liście i kliknij przycisk Edycja. Pola wypełnij w sposób 
opisany powyżej.</p>

		<p>Aby usunąć istniejącą kolekcję niestandardową wybierz ją z listy i kliknij przycisk Usuń.
Ani folder kolekcji utworzony na serwerze, ani żaden z jego elementów nie zostaną usunięte.</p>
	
	<hr>Uwagi dotyczące polskiego tłumaczenia: <a href="mailto:michal@jarocinscy.pl">michal@jarocinscy.pl</a> lub <a href="mailto:januszkielak@gmail.com">januszkielak@gmail.com</a>. Prosimy zgłaszać ewentualne błędy lub niejasności.

	</td>
</tr>

</table>
</body>
</html>
