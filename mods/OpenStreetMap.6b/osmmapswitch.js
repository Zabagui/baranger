
	switch (mapsrc) {
		case "OSMFR": srcurl = 'https://a.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png';
			srcatt = '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';
			break;

		case "EWSM": srcurl = 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}';
			srcatt = 'Tiles &copy; Esri &mdash; Source: Esri, DeLorme, NAVTEQ, USGS, Intermap, iPC, NRCAN, Esri Japan, METI, Esri China (Hong Kong), Esri (Thailand), TomTom, 2012';
			break;

		case "EWTM": srcurl = 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Topo_Map/MapServer/tile/{z}/{y}/{x}';
			srcatt = 'Tiles &copy; Esri &mdash; Esri, DeLorme, NAVTEQ, TomTom, Intermap, iPC, USGS, FAO, NPS, NRCAN, GeoBase, Kadaster NL, Ordnance Survey, Esri Japan, METI, Esri China (Hong Kong), and the GIS User Community';
			break;

		case "TOPO": srcurl = 'https://tile.opentopomap.org/{z}/{x}/{y}.png';
			srcatt = 'Map data: &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)';
			break;

		case "SURF": srcurl = 'https://korona.geog.uni-heidelberg.de/tiles/roads/x={x}&y={y}&z={z}';
			srcatt = 'Imagery from <a href="http://giscience.uni-hd.de/">GIScience Research Group @ University of Heidelberg</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';
			break;

		case "HYDDA": srcurl = 'https://tile.openstreetmap.se/hydda/full/{z}/{x}/{y}.png';
			srcatt = 'Tiles courtesy of <a href="http://openstreetmap.se/" target="_blank">OpenStreetMap Sweden</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';
			break;

		case "MTB": srcurl = 'http://tile.mtbmap.cz/mtbmap_tiles/{z}/{x}/{y}.png';
			srcatt = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> &amp; USGS';
			break;

		case "WIKI": srcurl = 'https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}.png';
			srcatt = '<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>';
			break;

		case "SAT": srcurl = 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}';
			srcatt = 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community';
			break;
	}

