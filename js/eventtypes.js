var Itypes = new Array("EVEN","ADOP","ADDR","ALIA","ANCI","BARM","BASM","CAST","CENS","CHRA","CONF","CREM","DESI","DSCR","EDUC","EMIG","FCOM","GRAD","IDNO","IMMI","LANG","NATI","NATU","NCHI","NMR","OCCU","ORDI","ORDN","PHON","PROB","PROP","REFN","RELI","RESI","RESN","RETI","RFN","RIN","SSN","WILL");
var Ftypes = new Array("EVEN","ANUL","CENS","DIV","DIVF","ENGA","MARB","MARC","MARL","MARS","REFN","RIN");
var Stypes = new Array("EVEN","REFN","RIN");
var Rtypes = Stypes;
var messages = new Array();

function populateTags(etype,match) {
	var types = eval(etype + "types");
	var field = document.form1.tag1;
	var key, message;
	var found = false;

	field.options.length = 0;
	if(navigator.appName == "Netscape") {
   		field.options[0] = new Option('','',false,false)
		for( var i = 1; i <= types.length; i++ ) {
			key = types[i-1];
			message = messages[key];
			if( key == match ) {
				field.options[i] = new Option(key + " - " + message,key,false,true)
				found = true;
			}
			else
				field.options[i] = new Option(key + " - " + message,key,false,false)
		}
	}
	else if( navigator.appName == "Microsoft Internet Explorer") {
   		var newElem = document.createElement("OPTION");
		newElem.text = '';
		newElem.value = '';
   		field.options.add(newElem);
		for( var i = 1; i <= types.length; i++ ) {
			var newElem = document.createElement("OPTION");

			key = types[i-1];
			message = messages[key];
			newElem.text = key + " - " + message;
			newElem.value = key;
			field.options.add(newElem);
			if( key == match ) {
				newElem.selected = true;
				found = true;
			}
		}
	}
	if( !found && match) document.form1.tag2.value = match;
	if( match == "EVEN" )
		toggleTdesc(1);
	else
		toggleTdesc(0);
}

function toggleTdesc(flag) {
	if( flag ) {
		jQuery('#tdesc').fadeIn(400);
		jQuery('#typereq').fadeIn(400);
	}
	else {
		jQuery('#tdesc').fadeOut(400);
		jQuery('#typereq').fadeOut(400);
	}
}

