<?php
include("../../helplib.php");
echo help_header("Pomoc: Mapy Google");
?>

<body class="helpbody">
<a name="top"></a>
<table width="100%" border="0" cellpadding="10" cellspacing="2" class="tblback normal">
<tr class="fieldnameback">
	<td class="tngshadow">
		<p style="float:right; text-align:right" class="smaller menu">
			<a href="https://tng.community" target="_blank" class="lightlink">TNG Forum</a> &nbsp; | &nbsp;
			<a href="https://tng.lythgoes.net/wiki" target="_blank" class="lightlink">TNG Wiki</a><br />
			<a href="places_help.php" class="lightlink">&laquo; Pomoc: Miejsca</a> &nbsp; | &nbsp;
			<a href="tlevents_help.php" class="lightlink">Pomoc: Linia czasu wydarzeń &raquo;</a>
		</p>
		<span class="largeheader">Pomoc: Mapy Google</span>
		<p class="smaller menu">
			<a href="#show" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#search" class="lightlink">Search</a> &nbsp; | &nbsp;
			<a href="#controls" class="lightlink">Map Controls</a> &nbsp; | &nbsp;
			<a href="#help" class="lightlink">Pomoc</a>
		</p>
	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">
		<p><span class="subheadbold">Pokaż/ukryj mapę Google</span><br /><br />
		Kliknij przycisk "Pokaż/ukryj mapę Google", aby pokazać mapę Google i szukać szerokości i długości geograficznej lokalizacji oraz zoomu, lub ukryć mapę po
 zakończeniu. Domyślnie jest ustawienie początkowe określone w Administrator /Ustawienia i konfiguracja / Ustawienia mapy.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="show"><p class="subheadbold">Szukanie</p></a>
		<p>Interfejs Google Map Geocoder pozwala na zlokalizowanie szerokości i długości geograficznej miejsca za pomocą wywołania poprzez kliknięcie w wybrany punkt.
 Możesz również skorzystać z StreetMap (<a href="https://www.streetmap.co.uk" target="_blank">https://www.streetmap.co.uk</a>) aby odnaleźć współrzędne w Anglii, lub z Mapy Szukacza (<a href="https://mapa.szukacz.pl" target="_blank">https://mapa.szukacz.pl</a>) w Polsce.</p>

		<span class="optionhead">Określenie miejsca Geocode</span>
		<p>Karta dotycząca współrzędnych geograficznych miejsca TNG zawiera nazwę miejsca, jeśli jest ono już zdefiniowane w TNG. Podczas dodawania nowej lokalizacji, współrzędne geograficzne będą dodawane do
 każdego miejsca noszącego tę samą nazwę. Podczas dodawania lub cmentarzy mediów będą dotyczyły jednak wyłącznie jednej lokalizacji.</p>
		<p>Być może trzeba będzie dla istniejących nazw miejsc w TNG zmienić je w polu "Określenie miejsca Geocode" . Na przykład Google nie lubi <em>powiatu (County)</em> jako części nazwy miejsca dla lokalizacji w USA i Szkocji ani nie radzi sobie z prowincjami Nowej Zelandii.
 Być może warto spróbować podać dodatkowo nazwę kraju. Można także wpisać nazwę kraju w języku Angielskim.</p>
		<span class="optionhead">Przykłady nazw miejsc</span>
		<p>Oto przykłady, jak powinny być wpisanie nazwy miejsca w celu uzyskania prawidłowych współrzędnych:</p>
		<ul>
			<li>Śląska 12, 66400 Gorzów Wielkopolski, Polska</li>
			<li>1102 Shipwatch Circle, Tampa, Florida</li>
			<li>Klippan 1, 41451 Sweden</li>
			<li>49 Rue de Tournai, Lille, France</li>
			<li>Via Villanova 31, 40050 Bologna villanova, Italy</li>
			<li>Europaboulevard 10, Amsterdam</li>
			<li>Lise-Meitner-Strasse 2, 60486 Frankfurt, Germany</li>
		</ul>

		<p>Mapy niektórych krajów są niedostępne dla geocodera powodu krajowych praw autorskich i licencji. Dla tych krajów, będziesz musiał użyć linku <a href="https://maps.google.com/" target="_blank">Full Google Map Search</a>.</p>

		<span class="optionhead">Szerokość i długość geograficzna</span>
		<p>Musisz być bardzo ostrożny z przyjęciem szerokości i długości geograficznej, które są oferowane z mapki. Należy przynajmniej trochę znać lokalizację miejsca i to,
 czego oczekuje przed zaakceptowaniem tego, co jest proponowane na mapce. Jeżeli "szpilka" na mapie nie znajduje się w oczekiwanej lokalizacji, proponowana
 szerokość i długość mogą być niepoprawne. W takim przypadku, należy kliknąć na żądany punkt na mapie w celu ustalenia lepszej lokalizacji.</p>

		<p>Należy również sprawdzić przyjęte współrzędne za pomocą ikonki Test na liście miejsc, a następnie kliknąć na "szpilkę" przy wydarzeniu w celu otwarcia mapy
 zewnętrznej, aby zweryfikować to położenie.</p>
		
		<span class="optionhead">Zoom</span>
		<p>Jeśli lokalizacja na mapie nie jest odpowiednio powiększona, możesz użyć opcji kontroli zoomu opisanych poniżej w celu go dostosowania do potrzeb. Może to być
 szczególnie potrzebne w celu wyeliminowania komunikatu błędu informującego, że Google nie jest w stanie powiększyć mapy żądanego poziomu.
 Ustawione wartości powiększenia będą zapisywane w bazie danych TNG.</p>

		<span class="optionhead">Poziom miejsca</span>
		<p>Możesz skorzystać z rozwijanej listy poziomów miejsc , aby wybrać odpowiedni poziom nazwy miejsca. Do dyspozycji jest sześć poziomów począwszy od adresu do kraju. Adres jest najbardziej specyficzny.
 Można określić w Twoim pliku cust_text.php zastępcze preferencje do $admtext dla poziomów od 1 do 6 zawartych w pliku alltext.php. Poziomy etykietek od 2 do 5 mogą być zmienione w celu odzwierciedlenia na
 przykład kościółów / szpitali / domów opieki / cmentarzy, miejscowości/ miast / gmin, powiatów / wydziałów, stanów / województw / regionów. Różne kolorowe szpilki będą wskazywać różne skale poziomów
 miejsc na karcie osoby. Wskaźnika poziomu nie stosuje się do kart cmentarzy, ani mediów. Szpilki wyświetlane na cmentarzach są ustawione domyślnie do poziomu 2 w celu uwidocznienia nagrobków na najbardziej szczegółowym poziomie.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="controls"><p class="subheadbold">Sterowanie mapą Google</p></a>

		<span class="optionhead">Punkt / Kliknięcie</span>
		<p>Aby precyzyjnie ustawić szerokość i długość geograficzną, kliknij na mapę Google w wybranym przez Ciebie miejscu. Być może trzeba będzie skorzystać z przycisków Mapa, Satelita lub Hybrydowa
 aby łatwiej było ustalić współrzędne miejsca.</p>

		<span class="optionhead">Przesuwanie mapy</span>
		<p>Aby zobaczy obszar mapy znajdujący się poza obszarem ekranu możesz ją przesuwać używając myszy lub strzałek kierunkowych w lewo, prawo, w górę i w dół.
 The drag and pan capability means there is no clicking and waiting for graphics to reload each time you want to view the adjacent parts of a map.</p>

		<span class="optionhead">Zoom</span>
		<p>Można użyć plus znaków (+) i minus (-) lub suwaka, aby powiększyć lub zmniejszyć mapę. Być może trzeba będzie użyć strzałek do zmiany pozycji mapy przy powiększaniu.
 Jeśli dokonasz zmiany poziomu powiększenia, wartości zoom zostaną zapisane w tabeli TNG.</p>

	</td>
</tr>
<tr class="databack">
	<td class="tngshadow">

		<a name="help"><p class="subheadbold">Pomoc Google Map</p></a>

		<p>Tutaj możesz uzyskać dodatkową pomoc: <a href="https://www.google.com/apis/maps/documentation/" target="_blank">Google Maps API</a>.</p>
		<p>Możesz również skorzystać z tej: <a href="https://www.google.com/intl/en_us/help/maps/tour/" target="_blank">Google Maps tour</a>.</p>
	
	<hr>Uwagi dotyczące polskiego tłumaczenia: <a href="mailto:michal@jarocinscy.pl">michal@jarocinscy.pl</a> lub <a href="mailto:januszkielak@gmail.com">januszkielak@gmail.com</a>. Prosimy zgłaszać ewentualne błędy lub niejasności.

	</td>
</tr>

</table>
</body>
</html>
