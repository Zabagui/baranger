<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Examinar Todas las Fuentes";
		$text['shorttitle'] = "Título Abreviado";
		$text['callnum'] = "Número Referencia";
		$text['author'] = "Autor";
		$text['publisher'] = "Editor";
		$text['other'] = "Otra Información";
		$text['sourceid'] = "ID de Fuente";
		$text['moresrc'] = "Más fuentes";
		$text['repoid'] = "ID de Repositorio";
		$text['browseallrepos'] = "Examinar Todos los Repositorios";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Nuevo idioma";
		$text['changelanguage'] = "Cambiar Idioma";
		$text['languagesaved'] = "Idioma Guardado";
		$text['sitemaint'] = "Mantenimiento del sitio en progreso";
		$text['standby'] = "El sitio web se encuentra momentáneamente fuera de línea mientras se actualiza la base de datos. Por favor, inténtelo nuevamente en algunos minutos. Si el sitio permanece fuera de línea por un intervalo de tiempo excesivo, por favor <a href=\"suggest.php\">contacte con el Administrador del sitio web</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "Comenzar GEDCOM desde";
		$text['producegedfrom'] = "Generar archivo GEDCOM desde";
		$text['numgens'] = "Número de generaciones";
		$text['includelds'] = "Incluir información LDS";
		$text['buildged'] = "Generar GEDCOM";
		$text['gedstartfrom'] = "GEDCOM iniciado desde";
		$text['nomaxgen'] = "Debe indicar un número máximo de generaciones. Por favor, vuelva a la página anterior utilizando el botón volver de su navegador y corrija el error";
		$text['gedcreatedfrom'] = "GEDCOM creado desde";
		$text['gedcreatedfor'] = "creado para";
		$text['creategedfor'] = "Crear GEDCOM";
		$text['email'] = "Dirección E-mail";
		$text['suggestchange'] = "Sugerir un cambio";
		$text['yourname'] = "Su Nombre";
		$text['comments'] = "Notas o Comentarios";
		$text['comments2'] = "Comentarios";
		$text['submitsugg'] = "Presentar Sugerencia";
		$text['proposed'] = "Cambio Propuesto";
		$text['mailsent'] = "Gracias. Su mensaje ha sido enviado.";
		$text['mailnotsent'] = "Lo sentimos, pero su mensaje no ha podido ser enviado. Por favor, comuníquese directamente con xxx en yyy.";
		$text['mailme'] = "Enviar copia a ésta dirección";
		$text['entername'] = "Por favor, ingrese su nombre.";
		$text['entercomments'] = "Por favor, ingrese sus comentarios";
		$text['sendmsg'] = "Enviar Mensaje";
		//added in 9.0.0
		$text['subject'] = "Asunto";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Fotos e Historias para";
		$text['indinfofor'] = "Información individual para";
		$text['pp'] = "Pág."; //page abbreviation
		$text['age'] = "Edad";
		$text['agency'] = "Organismo";
		$text['cause'] = "Causa";
		$text['suggested'] = "Sugerido";
		$text['closewindow'] = "Cerrar esta ventana";
		$text['thanks'] = "Gracias";
		$text['received'] = "Su sugerencia fue remitida al administrador del sitio para su revisión.";
		$text['indreport'] = "Reporte Individual";
		$text['indreportfor'] = "Informe de Individuo para";
		$text['bkmkvis'] = "<strong>Nota:</strong> Estos favoritos solo es posible verlos en esta computadora y utilizando este explorador de internet.";
        //added in 9.0.0
		$text['reviewmsg'] = "Usted tiene disponible una sugerencia que necesita ser revisada. La sugerencia se refiere a:";
        $text['revsubject'] = "Cambios sugeridos necesitan su revisión";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Calculador de Parentesco";
		$text['findrel'] = "Buscar Parentesco";
		$text['person1'] = "Persona 1:";
		$text['person2'] = "Persona 2:";
		$text['calculate'] = "Calcular";
		$text['select2inds'] = "Por favor, seleccionar dos individuos.";
		$text['findpersonid'] = "Buscar ID de Persona";
		$text['enternamepart'] = "ingrese parte del nombre o del apellido";
		$text['pleasenamepart'] = "Por favor, ingrese una parte del nombre o del apellido.";
		$text['clicktoselect'] = "Clic para seleccionar";
		$text['nobirthinfo'] = "No hay información de nacimiento";
		$text['relateto'] = "Parentesco con";
		$text['sameperson'] = "Los dos individuos son la misma persona.";
		$text['notrelated'] = "Los dos individuos seleccionados no están relacionados dentro de xxx generaciones."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Puede utilizar los botones 'Buscar' para localizar a individuos cuyo parentesco desee conocer o mantener los individuos actuales. Luego oprima el botón 'Calcular'.";
		$text['sometimes'] = "(Tenga en cuenta que el cambio del número de generaciones puede producir resultados diversos.)";
		$text['findanother'] = "Buscar otro parentesco";
		$text['brother'] = "el hermano de";
		$text['sister'] = "la hermana de";
		$text['sibling'] = "el hermano de";
		$text['uncle'] = "el xxx tío de";
		$text['aunt'] = "la xxx tía de";
		$text['uncleaunt'] = "el xxx tío/tía de";
		$text['nephew'] = "el xxx sobrino de";
		$text['niece'] = "la xxx sobrina de";
		$text['nephnc'] = "el xxx sobrino/a de";
		$text['removed'] = "generación";
		$text['rhusband'] = "el marido de ";
		$text['rwife'] = "la esposa de ";
		$text['rspouse'] = "el esposo de ";
		$text['son'] = "el hijo de";
		$text['daughter'] = "la hija de";
		$text['rchild'] = "los hijos de";
		$text['sil'] = "el yerno de";
		$text['dil'] = "la nuera de";
		$text['sdil'] = "el yerno o nuera de";
		$text['gson'] = "el xxx nieto de";
		$text['gdau'] = "la xxx nieta de";
		$text['gsondau'] = "el xxx nieto/a de";
		$text['great'] = "gran";
		$text['spouses'] = "son esposos";
		$text['is'] = "es";
		$text['changeto'] = "Cambiar a (ingresar ID):";
		$text['notvalid'] = "no es el ID válido de una Persona o no existe en ésta base de datos. Por favor intente nuevamente.";
		$text['halfbrother'] = "el medio hermano de";
		$text['halfsister'] = "la media hermana de";
		$text['halfsibling'] = "el medio hermano de";
		//changed in 8.0.0
		$text['gencheck'] = "Número máximo de generaciones <br />a comprobar";
		$text['mcousin'] = "el primo en xxx yyy de";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "la prima en xxx yyy de";  //female cousin
		$text['cousin'] = "el primo en xxx yyy de";
		$text['mhalfcousin'] = "el medio primo en xxx yyy de";  //male cousin
		$text['fhalfcousin'] = "la media prima en xxx yyy de";  //female cousin
		$text['halfcousin'] = "el medio primo en xxx yyy de";
		//added in 8.0.0
		$text['oneremoved'] = "segunda generación";
		$text['gfath'] = "el xxx abuelo de";
		$text['gmoth'] = "la xxx abuela de";
		$text['gpar'] = "los xxx abuelos de";
		$text['mothof'] = "la madre de";
		$text['fathof'] = "el padre de";
		$text['parof'] = "los padres de";
		$text['maxrels'] = "Máximo parentesco a mostrar";
		$text['dospouses'] = "Mostrar parentesco que implica un cónyuge";
		$text['rels'] = "Parentesco";
		$text['dospouses2'] = "Mostrar Cónyuges";
		$text['fil'] = "el suegro de";
		$text['mil'] = "la suegra de";
		$text['fmil'] = "el suegro o la suegra de";
		$text['stepson'] = "el hijastro de";
		$text['stepdau'] = "la hijastra de";
		$text['stepchild'] = "el hijastro/a de";
		$text['stepgson'] = "el xxx nietastro de";
		$text['stepgdau'] = "la xxx nietastra de";
		$text['stepgchild'] = "xxx nieto/a político/a de";
		//added in 8.1.1
		$text['ggreat'] = "gran";
		//added in 8.1.2
		$text['ggfath'] = "el xxx bisabuelo de";
		$text['ggmoth'] = "la xxx bisabuela de";
		$text['ggpar'] = "es xxx bisabuelo/a de";
		$text['ggson'] = "el xxx bisnieto de";
		$text['ggdau'] = "la xxx bisnieta de";
		$text['ggsondau'] = "es xxx bisnieto/a de";
		$text['gstepgson'] = "el xxx bisnietastro de";
		$text['gstepgdau'] = "la xxx bisnietastra de";
		$text['gstepgchild'] = "los xxx bisnietastros de";
		$text['guncle'] = "el xxx tío abuelo de";
		$text['gaunt'] = "la xxx tía abuela de";
		$text['guncleaunt'] = "es xxx tío/a abuelo/a de";
		$text['gnephew'] = "el xxx sobrino nieto de";
		$text['gniece'] = "la xxx sobrina nieta de";
		$text['gnephnc'] = "es xxx sobrino/a nieto/a de";
		//added in 14.0
		$text['pathscalc'] = "Search for connections";
		$text['findrel2'] = "Buscar Parentesco";
		$text['makeme2nd'] = "Use my ID";
		$text['usebookmarks'] = "Use bookmarks";
		$text['select2inds'] = "Por favor, seleccionar dos individuos.";
		$text['indinfofor'] = "Información individual para";
		$text['nobookmarks'] = "There is no bookmark to use";
		$text['bkmtitle'] = "Persons found in bookmarks";
		$text['bkminfo'] = "Select a person:";
		$text['sortpathsby'] = "Sort paths by number of";
		$text['sortbyshort'] = "Sort by";
		$text['bylengthshort'] = "Length";
		$text['badID1'] = ": bad person1 ID - please go back and correct";
		$text['badID2'] = ": bad person2 ID - please go back and correct";
		$text['notintree'] = ": the person with this ID is not in the current tree database.";
		$text['sameperson'] = "Los dos individuos son la misma persona.";;
		$text['nopaths'] = "These persons are not connected.";
		$text['nopaths1'] = "No more connections shorter than xxx";
		$text['nopaths2'] = "in xxx search steps";
		$text['longestpath'] = "(longest path checked so far was xxx steps long)";
		$text['relevantpaths'] = "The number of different relevant paths found: xxx";
		$text['skipMarr'] = "(in addition, the number of paths found but not displayed due to too many marriages was: xxx)";
		$text['mjaor'] = "or";
		$text['connectionsto'] = "Connections to ";
		$text['findanotherpers'] = "Find another person...";
		$text['sometimes'] = "(Tenga en cuenta que el cambio del número de generaciones puede producir resultados diversos.)";
		$text['anotherpath'] = "Search for other connections";
		$text['xpath'] = "Path ";
		$text['primary'] = "Start Person"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "End Person";
		$text['parent'] = "Parent";
		$text['mhfather'] = "his father";
		$text['mhmother'] = "his mother";
		$text['mhhusband'] = "his husband";
		$text['mhwife'] = "his wife";
		$text['mhson'] = "his son";
		$text['mhdaughter'] = "her daughter";
		$text['fhfather'] = "her father";
		$text['fhmother'] = "her mother";
		$text['fhhusband'] = "her husband";
		$text['fhwife'] = "her wife";
		$text['fhson'] = "her son";
		$text['fhdaughter'] = "her daughter";
		$text['hfather'] = "father";
		$text['hmother'] = "mother";
		$text['hhusband'] = "husband";
		$text['hwife'] = "wife";
		$text['hson'] = "son";
		$text['hdaughter'] = "daughter";
		$text['maxruns'] = "Max number of paths to be checked";
		$text['maxrshort'] = "Max paths";
		$text['maxlength'] = "Connection paths no longer than";
		$text['maxlshort'] = "Max length";
		$text['xstep'] = "step";
		$text['xsteps'] = "steps";
		$text['xmarriages'] = "xxx marriages";
		$text['xmarriage'] = "1 marriage";
		$text['showspouses'] = "Show both spouses";
		$text['showTxt'] = "Show textual path description";
		$text['showTxtshort'] = "Textual desc.";
		$text['compactBox'] = "Show person boxes compacted";
		$text['compactBoxshort'] = "Compact boxes";
		$text['paths'] = "Paths";
		$text['dospouses2'] = "Mostrar Cónyuges";
		$text['maxmopt'] = "Maximo de matrimonios por conexión";
		$text['maxm'] = "Maximo de matrimonios";
		$text['arerelated'] = "Estas personas son familiares - su relación se muestra en el paso 1";
		$text['simplerel'] = "Busqueda simple de relaciones";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Hoja del grupo familiar de";
		$text['ldsords'] = "Ordenanzas LDS";
		$text['baptizedlds'] = "Bautismo (LDS)";
		$text['endowedlds'] = "Investido (LDS)";
		$text['sealedplds'] = "Sellado P (LDS)";
		$text['sealedslds'] = "Sellado C (LDS)";
		$text['otherspouse'] = "Otro cónyuge";
		$text['husband'] = "Padre";
		$text['wife'] = "Madre";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "N";
		$text['capaltbirthabbr'] = "A";
		$text['capdeathabbr'] = "F";
		$text['capburialabbr'] = "E";
		$text['capplaceabbr'] = "L";
		$text['capmarrabbr'] = "C";
		$text['capspouseabbr'] = "ES";
		$text['redraw'] = "Rediseñar con";
		$text['unknownlit'] = "Desconocido";
		$text['popupnote1'] = " = Información adicional";
		$text['pedcompact'] = "Compacto";
		$text['pedstandard'] = "Estándar";
		$text['pedtextonly'] = "Texto";
		$text['descendfor'] = "Descendencia para";
		$text['maxof'] = "Máximo de";
		$text['gensatonce'] = "generaciones mostradas a la vez.";
		$text['sonof'] = "hijo de";
		$text['daughterof'] = "hija de";
		$text['childof'] = "hijo de";
		$text['stdformat'] = "Formato estándar";
		$text['ahnentafel'] = "Método Ahnentafel";
		$text['addnewfam'] = "Añadir Nueva Familia";
		$text['editfam'] = "Editar Familia";
		$text['side'] = "(Ascendentes)";
		$text['familyof'] = "Familia de";
		$text['paternal'] = "Paternal";
		$text['maternal'] = "Maternal";
		$text['gen1'] = "Mismo";
		$text['gen2'] = "Padres";
		$text['gen3'] = "Abuelos";
		$text['gen4'] = "Bisabuelos";
		$text['gen5'] = "Tatarabuelos";
		$text['gen6'] = "Choznos";
		$text['gen7'] = "4º Bisabuelos";
		$text['gen8'] = "5º Bisabuelos";
		$text['gen9'] = "6º Bisabuelos";
		$text['gen10'] = "7º Bisabuelos";
		$text['gen11'] = "8º Bisabuelos";
		$text['gen12'] = "9º Bisabuelos";
		$text['graphdesc'] = "Gráfico descendencia hasta este punto";
		$text['pedbox'] = "Caja";
		$text['regformat'] = "Registro";
		$text['extrasexpl'] = "Al menos una foto, historia u otros medios existen para éste individuo.";
		$text['popupnote3'] = " = Nuevo gráfico";
		$text['mediaavail'] = "Medios Disponibles";
		$text['pedigreefor'] = "Arbol genealógico de";
		$text['pedigreech'] = "Gráfico genealógico";
		$text['datesloc'] = "Fechas y Ubicaciones";
		$text['borchr'] = "Nació/Alt - Murió/Enterrado";
		$text['nobd'] = "Sin Fecha de Nacimiento o Muerte";
		$text['bcdb'] = "Total datos de Nacimiento/Alt/Muerte/Entierro";
		$text['numsys'] = "Sistema de Numeración";
		$text['gennums'] = "Número de Generaciones";
		$text['henrynums'] = "Números de Henry";
		$text['abovnums'] = "Números de d'Aboville";
		$text['devnums'] = "Números de Villiers";
		$text['dispopts'] = "Mostrar Opciones";
		//added in 10.0.0
		$text['no_ancestors'] = "No se encontraron ancestros";
		$text['ancestor_chart'] = "Cuadro vertical de ancestros";
		$text['opennewwindow'] = "Abrir en nueva ventana";
		$text['pedvertical'] = "Vertical";
		//added in 11.0.0
		$text['familywith'] = "Family with";
		$text['fcmlogin'] = "Please log in to see details";
		$text['isthe'] = "is the";
		$text['otherspouses'] = "other spouses";
		$text['parentfamily'] = "The parent family ";
		$text['showfamily'] = "Show family";
		$text['shown'] = "shown";
		$text['showparentfamily'] = "show parent family";
		$text['showperson'] = "show person";
		//added in 11.0.2
		$text['otherfamilies'] = "Other families";
		//added in 14.0
		$text['dtformat'] = "Tables";
		$text['dtchildren'] = "Children";
		$text['dtgrandchildren'] = "Grandchildren";
		$text['dtggrandchildren'] = "Great grandchildren";
		$text['dtgggrandchildren'] = "Great grandchildren"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "No descendants";
		$text['dtgen'] = "Gen";
		$text['dttotal'] = "Total";
		$text['dtselect'] = "Select";
		$text['dteachfulltable'] = "Each full table will have";
		$text['dtrows'] = "rows";
		$text['dtdisplayingtable'] = "Displaying table";
		$text['dtgototable'] = "Go to table:";
		$text['fcinstrdn'] = "Show family with spouse";
		$text['fcinstrup'] = "Show family with parents";
		$text['fcinstrplus'] = "Select other spouses";
		$text['fcinstrfam'] = "Select other parents";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "No existen reportes";
		$text['reportname'] = "Nombre del Reporte";
		$text['allreports'] = "Todos los Reportes";
		$text['report'] = "Reporte";
		$text['error'] = "Error";
		$text['reportsyntax'] = "La sintaxis de la consulta se ejecuta con este reporte";
		$text['wasincorrect'] = "fue incorrecto, y como resultado el reporte no se pudo ejecutar. Por favor, póngase en contacto con el administrador del sitio en";
		$text['errormessage'] = "Mensaje de Error";
		$text['equals'] = "igual a";
		$text['endswith'] = "termina con";
		$text['soundexof'] = "soundex fonético de";
		$text['metaphoneof'] = "metafonía fonética de";
		$text['plusminus10'] = "+/- 10 años desde";
		$text['lessthan'] = "menor que";
		$text['greaterthan'] = "mayor que";
		$text['lessthanequal'] = "menor o igual a";
		$text['greaterthanequal'] = "mayor o igual a";
		$text['equalto'] = "igual a";
		$text['tryagain'] = "Por favor, intente nuevamente";
		$text['joinwith'] = "Unir con";
		$text['cap_and'] = "Y";
		$text['cap_or'] = "O";
		$text['showspouse'] = "Mostrar cónyuge (en caso de tener el individuo más de un cónyuge mostrará duplicados)";
		$text['submitquery'] = "Enviar Consulta";
		$text['birthplace'] = "Lugar de Nacimiento";
		$text['deathplace'] = "Lugar de Fallecimiento";
		$text['birthdatetr'] = "Año de Nacimiento";
		$text['deathdatetr'] = "Año de Fallecimiento";
		$text['plusminus2'] = "+/- 2 años desde";
		$text['resetall'] = "Reiniciar Todos los Valores";
		$text['showdeath'] = "Mostrar información de fallecimiento y/o entierro";
		$text['altbirthplace'] = "Lugar de Bautismo";
		$text['altbirthdatetr'] = "Año de Bautismo";
		$text['burialplace'] = "Lugar de Entierro";
		$text['burialdatetr'] = "Año de Entierro";
		$text['event'] = "Evento(s)";
		$text['day'] = "Día";
		$text['month'] = "Mes";
		$text['keyword'] = "Palabra clave (pej., \"Abt\")";
		$text['explain'] = "Ingrese la fecha para ver los eventos coincidentes. Deje el campo en blanco si quiere ver coincidencias para todos.";
		$text['enterdate'] = "Por favor, ingrese o seleccione por lo menos uno de los siguientes datos: Día, Mes, Año, Palabra Clave";
		$text['fullname'] = "Nombre Completo";
		$text['birthdate'] = "Fecha de Nacimiento";
		$text['altbirthdate'] = "Fecha de Bautismo";
		$text['marrdate'] = "Fecha de Casamiento";
		$text['spouseid'] = "ID del Cónyuge";
		$text['spousename'] = "Nombre del Cónyuge";
		$text['deathdate'] = "Fecha de Fallecimiento";
		$text['burialdate'] = "Fecha de Entierro";
		$text['changedate'] = "Fecha Última Modificación";
		$text['gedcom'] = "Arbol";
		$text['baptdate'] = "Fecha de Bautismo (LDS)";
		$text['baptplace'] = "Lugar de Bautismo (LDS)";
		$text['endldate'] = "Fecha de Investidura (LDS)";
		$text['endlplace'] = "Lugar de Investidura (LDS)";
		$text['ssealdate'] = "Fecha de Sellado Cóny. (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Lugar del Sellado Cóny. (LDS)";
		$text['psealdate'] = "Fecha Sellado de Padres (LDS)";   //Sealed to parents
		$text['psealplace'] = "Lugar Sellado P (LDS)";
		$text['marrplace'] = "Lugar del Casamiento";
		$text['spousesurname'] = "Apellido de los Esposos";
		$text['spousemore'] = "Si usted ingresa un valor para el Apellido de los Esposos, usted debe seleccionar un Sexo.";
		$text['plusminus5'] = "+/- 5 años desde";
		$text['exists'] = "ya existe";
		$text['dnexist'] = "no existe";
		$text['divdate'] = "Fecha del Divorcio";
		$text['divplace'] = "Lugar del Divorcio";
		$text['otherevents'] = "Otros Eventos";
		$text['numresults'] = "Resultados por página";
		$text['mysphoto'] = "Fotos Difíciles";
		$text['mysperson'] = "Personas Difíciles";
		$text['joinor'] = "La opción 'Unir con O' no puede ser usada con el Apellido del Esposo";
		$text['tellus'] = "Cuéntenos que sabe usted";
		$text['moreinfo'] = "Haga Clic para más información sobre esta imagen";
		//added in 8.0.0
		$text['marrdatetr'] = "Año del Matrimonio";
		$text['divdatetr'] = "Año del Divorcio";
		$text['mothername'] = "Nombre de la Madre";
		$text['fathername'] = "Nombre del Padre";
		$text['filter'] = "Filtro";
		$text['notliving'] = "No vivo";
		$text['nodayevents'] = "Eventos para este mes que no están asociados con un día específico :";
		//added in 9.0.0
		$text['csv'] = "Archivo CSV delimitado con comas";
		//added in 10.0.0
		$text['confdate'] = "Fecha de Confirmación (LDS)";
		$text['confplace'] = "Lugar de Confirmación (LDS)";
		$text['initdate'] = "Fecha de Inicio (LDS)";
		$text['initplace'] = "Lugar de Inicio (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Marriage Type";
		$text['searchfor'] = "Buscar";
		$text['searchnote'] = "Nota: esta página utiliza Google para realizar la búsqueda. El número de coincidencias devueltas se verá directamente afectado por el grado de indexación del sitio por parte de Google.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Archivo Log de";
		$text['mostrecentactions'] = "Acciones Más Recientes";
		$text['autorefresh'] = "Esta página se actualiza en forma automática cada 30 segundos";
		$text['refreshoff'] = "Desactivar Auto Refrescado";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Cementerios y Lápidas";
		$text['showallhsr'] = "Mostrar todos los registros de lápidas";
		$text['in'] = "en";
		$text['showmap'] = "Mostrar mapa";
		$text['headstonefor'] = "Lápida para";
		$text['photoof'] = "Foto de";
		$text['photoowner'] = "Propietario del original";
		$text['nocemetery'] = "Sin Cementerio";
		$text['iptc005'] = "Título";
		$text['iptc020'] = "Categorías Suple.";
		$text['iptc040'] = "Instrucciones Especiales";
		$text['iptc055'] = "Fecha de Creación";
		$text['iptc080'] = "Autor";
		$text['iptc085'] = "Posición del Autor";
		$text['iptc090'] = "Ciudad";
		$text['iptc095'] = "Provincia/Estado";
		$text['iptc101'] = "País";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Titular";
		$text['iptc110'] = "Fuente";
		$text['iptc115'] = "Fuente de la Foto";
		$text['iptc116'] = "Información de Copyright";
		$text['iptc120'] = "Encabezado";
		$text['iptc122'] = "Autor del Encabezado";
		$text['mapof'] = "Mapa de";
		$text['regphotos'] = "Vista Descriptiva";
		$text['gallery'] = "Sólo Miniaturas";
		$text['cemphotos'] = "Fotos de Cementerios";
		$text['photosize'] = "Dimensiones";
        $text['iptc010'] = "Prioridad";
		$text['filesize'] = "Tamaño de Archivo";
		$text['seeloc'] = "Ver Ubicación";
		$text['showall'] = "Mostrar Todo";
		$text['editmedia'] = "Editar Medios";
		$text['viewitem'] = "Ver este item";
		$text['editcem'] = "Editar Cementerio";
		$text['numitems'] = "Nro. de Items";
		$text['allalbums'] = "Todos los Albums";
		$text['slidestop'] = "Pausar Visor de Imágenes";
		$text['slideresume'] = "Reanudar Visor de Imágenes";
		$text['slidesecs'] = "Segundos para cada muestra:";
		$text['minussecs'] = "menos 0.5 segundos";
		$text['plussecs'] = "más 0.5 segundos";
		$text['nocountry'] = "País desconocido";
		$text['nostate'] = "Provincia desconocida";
		$text['nocounty'] = "Municipio desconocido";
		$text['nocity'] = "Ciudad desconocida";
		$text['nocemname'] = "Nombre de cementerio desconocido";
		$text['editalbum'] = "Editar Album";
		$text['mediamaptext'] = "<strong>Nota:</strong> Mueva el puntero de su ratón sobre las imágenes para mostrar los nombres. Haga Clic para ver una página por cada nombre.";
		//added in 8.0.0
		$text['allburials'] = "Todos los Entierros";
		$text['moreinfo'] = "Haga Clic para más información sobre esta imagen";
		//added in 9.0.0
        $text['iptc025'] = "Palabras Clave";
        $text['iptc092'] = "Sub-localización";
		$text['iptc015'] = "Categoría";
		$text['iptc065'] = "Programa de Origen";
		$text['iptc070'] = "Versión del Programa";
		//added in 13.0
		$text['toggletags'] = "Alternar Etiquetas";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Mostrar los apellidos que comiencen con";
		$text['showtop'] = "Mostrar los primeros";
		$text['showallsurnames'] = "Mostrar todos los apellidos";
		$text['sortedalpha'] = "ordenados alfabéticamente";
		$text['byoccurrence'] = "ordenados por frecuencia";
		$text['firstchars'] = "Iniciales";
		$text['mainsurnamepage'] = "Página principal de apellidos";
		$text['allsurnames'] = "Todos los Apellidos";
		$text['showmatchingsurnames'] = "Clic en un apellido para ver los registros coincidentes";
		$text['backtotop'] = "Volver arriba";
		$text['beginswith'] = "Comienza con";
		$text['allbeginningwith'] = "Todos los apellidos que comienzan con";
		$text['numoccurrences'] = "número total de coincidencias entre paréntesis";
		$text['placesstarting'] = "Mostrar los lugares mas grandes que comienzan con";
		$text['showmatchingplaces'] = "Clic en un lugar para mostrar lugares más pequeños. Clic en el icono de búsqueda para mostrar individuos coincidentes.";
		$text['totalnames'] = "individuos totales";
		$text['showallplaces'] = "Ver todos los lugares más grandes";
		$text['totalplaces'] = "total de lugares";
		$text['mainplacepage'] = "Página principal de lugares";
		$text['allplaces'] = "Todos los lugares más grandes";
		$text['placescont'] = "Mostrar todos los lugares que contienen";
		//changed in 8.0.0
		$text['top30'] = "Los xxx apellidos más frecuentes";
		$text['top30places'] = "Los xxx lugares más grandes";
		//added in 12.0.0
		$text['firstnamelist'] = "Lista de Nombres";
		$text['firstnamesstarting'] = "Muestre nombres que empiecen po";
		$text['showallfirstnames'] = "Muestre todos los nombres";
		$text['mainfirstnamepage'] = "Pagina principal de nombres";
		$text['allfirstnames'] = "Todos los Nombres";
		$text['showmatchingfirstnames'] = "Haga clic en un nombre para mostrar los registros coincidentes.";
		$text['allfirstbegwith'] = "Todos los nombres que empiezan por";
		$text['top30first'] = "Los mejores xxx nombres";
		$text['allothers'] = "Todos los Otros";
		$text['amongall'] = "(entre todos los nombres)";
		$text['justtop'] = "Solamente los mejores xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(últimos xx días)";

		$text['photo'] = "Foto";
		$text['history'] = "Historia/Documento";
		$text['husbid'] = "ID del Pdre";
		$text['husbname'] = "Nombre del Padre";
		$text['wifeid'] = "ID de la Madre";
		//added in 11.0.0
		$text['wifename'] = "Mother's Name";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Eliminar";
		$text['addperson'] = "Añadir Persona";
		$text['nobirth'] = "El siguiente individuo no tiene una fecha de nacimiento válida y por lo tanto no puede ser añadido";
		$text['event'] = "Evento(s)";
		$text['chartwidth'] = "Ancho del Cuadro";
		$text['timelineinstr'] = "Añadir Personas";
		$text['togglelines'] = "Invertir Líneas";
		//changed in 9.0.0
		$text['noliving'] = "El siguiente individuo está señalado como persona viva y no puede ser añadido. Para ello es necesario un nivel superior de permisos.";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Examinar Todos los Arboles";
		$text['treename'] = "Nombre de Arbol";
		$text['owner'] = "Propietario";
		$text['address'] = "Dirección";
		$text['city'] = "Ciudad";
		$text['state'] = "Estado/Provincia";
		$text['zip'] = "Código Postal/Zip";
		$text['country'] = "País";
		$text['email'] = "Dirección E-mail";
		$text['phone'] = "Teléfono";
		$text['username'] = "Nombre de Usuario";
		$text['password'] = "Contraseña";
		$text['loginfailed'] = "Falló el Acceso";

		$text['regnewacct'] = "Registrarse para Nueva Cuenta de Usuario";
		$text['realname'] = "Su Nombre Real";
		$text['phone'] = "Teléfono";
		$text['email'] = "Dirección E-mail";
		$text['address'] = "Dirección";
		$text['acctcomments'] = "Notas o Comentarios";
		$text['submit'] = "Enviar";
		$text['leaveblank'] = "(dejar en blanco si solicita un nuevo árbol)";
		$text['required'] = "Campos requeridos";
		$text['enterpassword'] = "Por favor, ingrese una contraseña.";
		$text['enterusername'] = "Por favor, ingrese un nombre de usuario.";
		$text['failure'] = "El nombre de usuario escogido por usted ya está siendo utilizado por otro usuario. Por favor, oprima el botón Volver de su navegador para regresar a la página anterior y escoja un nombre diferente.";
		$text['success'] = "Gracias. Hemos recibido su solicitud de registro. Nos pondremos en contacto con usted tan pronto como su cuenta esté activa o sea necesario ampliar la información suministrada.";
		$text['emailsubject'] = "Nueva solicitud de registro en TNG";
		$text['website'] = "Sitio Web";
		$text['nologin'] = " ¿Aún no está registrado? ";
		$text['loginsent'] = "Se envió información de acceso";
		$text['loginnotsent'] = "No se envió información de acceso";
		$text['enterrealname'] = "Por favor, ingrese su nombre real.";
		$text['rempass'] = "Recordar el ingreso en este equipo";
		$text['morestats'] = "Más estadísticas";
		$text['accmail'] = "<strong>NOTA:</strong> Con el fin de recibir un correo del administrador respecto a su cuenta, por favor asegurarse de no estar bloqueando el correo proveniente de éste dominio.";
		$text['newpassword'] = "Nueva Contraseña";
		$text['resetpass'] = "Cambiar su contraseña";
		$text['nousers'] = "Este formulario no puede usarse hasta que al menos exista un registro. Si usted es el propietario del sitio web, por favor vaya a Administración/Usuarios para crear su cuenta de Administrador.";
		$text['noregs'] = "Sepa disculparnos, pero momentáneamente no estamos aceptando el registro de nuevos usuarios. Por favor, <a href=\"suggest.php\">contáctenos</a> directamente si es que tiene comentarios o preguntas que se relacionen especificamente con el sitio web.";
		$text['emailmsg'] = "Se ha recibido una nueva solicitud de cuenta de usuario TNG. Por favor, ingrese al área de administración TNG y asigne los permisos adecuados para esta nueva cuenta.";
		$text['accactive'] = "La cuenta ha sido activada, pero el usuario no tendrá derechos especiales hasta que se le asignen.";
		$text['accinactive'] = "Ir a Administracion/Usuarios/Revisión para acceder a la configuración de la cuenta. La cuenta permanecerá inactiva hasta que edite y guarde el registro al menos una vez.";
		$text['pwdagain'] = "Nuevamente la Contraseña";
		$text['enterpassword2'] = "Por favor, ingrese su contraseña de nuevo.";
		$text['pwdsmatch'] = "Las contraseñas no coinciden. Por favor, introduzca la misma contraseña en cada campo.";
		$text['acksubject'] = "Gracias por registrarse"; //for a new user account
		$text['ackmessage'] = "Su solicitud de una cuenta de usuario ha sido recibida. Su cuenta está inactiva hasta que haya sido revisada por el administrador del sitio. Usted será notificado por correo electrónico cuando su nombre de usuario esté listo para su uso.";
		//added in 12.0.0
		$text['switch'] = "Cambiar";
		//added in 14.0
		$text['newpassword2'] = "New password again";
		$text['resetsuccess'] = "Success: Password has been reset";
		$text['resetfail'] = "Failure: Password not reset";
		$text['failreason0'] = " (unknown database error)";
		$text['failreason2'] = " (you don't have permission to change your password)";
		$text['failreason3'] = " (passwords did not match)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Navegar en Todas las Ramas";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Cantidad";
		$text['totindividuals'] = "Total de Individuos";
		$text['totmales'] = "Total de Hombres";
		$text['totfemales'] = "Total de Mujeres";
		$text['totunknown'] = "Total de Personas con Sexo Desconocido";
		$text['totliving'] = "Total de Individuos Vivos";
		$text['totfamilies'] = "Total de Familias";
		$text['totuniquesn'] = "Total de Apellidos Distintos";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Total de Fuentes";
		$text['avglifespan'] = "Promedio Años de Vida";
		$text['earliestbirth'] = "Primer Nacimiento";
		$text['longestlived'] = "Los más Longevos";
		$text['days'] = "días";
		$text['age'] = "Edad";
		$text['agedisclaimer'] = "Los cálculos de edad están basados en individuos con fecha de nacimiento <EM>y</EM> fallecimiento registrados. Debido a la existencia de campos de fecha incompletos (por ejemplo, una fecha consignada solamente como \"1945\" o \"DESP. 1860\"), estos cálculos no poseen una precisión del 100%.";
		$text['treedetail'] = "Más información sobre este árbol";
		$text['total'] = "Total";
		//added in 12.0
		$text['totdeceased'] = "Total de Fallecidos";
		//added in 14.0
		$text['totalsourcecitations'] = "Total Source Citations";
		break;

	case "notes":
		$text['browseallnotes'] = "Examinar Todas las Notas";
		break;

	case "help":
		$text['menuhelp'] = "Clave del Menú";
		break;

	case "install":
		$text['perms'] = "Todos los permisos se han establecido.";
		$text['noperms'] = "No se pudo establecer los permisos para los siguientes archivos:";
		$text['manual'] = "Por favor, establézcalos de forma manual.";
		$text['folder'] = "Carpeta";
		$text['created'] = "se ha creado";
		$text['nocreate'] = "no pudo crearse. Por favor, crearla de forma manual.";
		$text['infosaved'] = "¡Información guardada, conexión verificada!";
		$text['tablescr'] = "¡Las tablas han sido creadas!";
		$text['notables'] = "Las siguientes tablas no se pudieron crear:";
		$text['nocomm'] = "TNG no se está comunicando con su base de datos. No se creo ninguna tabla.";
		$text['newdb'] = "Información guardada, conexión verificada, nueva base de datos creada:";
		$text['noattach'] = "Información guardada. Conexión realizada y base de datos creada, pero TNG no puede comunicarse con ella.";
		$text['nodb'] = "Información guardada. Conexión realizada, pero la base de datos no existe y no pudo crearse aquí. Por favor verificar que el nombre de la base de datos es correcto, o bien use su panel de control para crear la misma.";
		$text['noconn'] = "Información guardada pero falló la conexión. Uno o más de los siguientes es incorrecto:";
		$text['exists'] = "ya existe";
		$text['noop'] = "No se realizó ninguna operación.";
		//added in 8.0.0
		$text['nouser'] = "El usuario no se ha creado. Puede que el Nombre de usuario ya exista.";
		$text['notree'] = "El Arbol no se ha creado. Puede que el ID del árbol ya exista.";
		$text['infosaved2'] = "Información guardada";
		$text['renamedto'] = "renombrado como";
		$text['norename'] = "no se pudo cambiar el nombre";
		//changed in 13.0.0
		$text['loginfirst'] = "Records de usuarios detectados. Para seguir, debe entrar primero o quitar todos los récords de la tabla de usuarios.";
		break;

	case "imgviewer":
		$text['magmode'] = "Modo Ampliado";
		$text['panmode'] = "Modo Panorámico";
		$text['pan'] = "Haga Clic y arrastre para moverse dentro de la imagen";
		$text['fitwidth'] = "Ajustar ancho";
		$text['fitheight'] = "Ajustar altura";
		$text['newwin'] = "Nueva ventana";
		$text['opennw'] = "Abrir imagen en nueva ventana";
		$text['magnifyreg'] = "Clic para ampliar una región de la imagen";
		$text['imgctrls'] = "Habilitar Controles de Imagen";
		$text['vwrctrls'] = "Habilitar controles del Visor de Imágenes";
		$text['vwrclose'] = "Cerrar Visor de Imágenes";
		break;

	case "dna":
		$text['test_date'] = "Test date";
		$text['links'] = "Relevant links";
		$text['testid'] = "Test ID";
		//added in 12.0.0
		$text['mode_values'] = "Valores del Mode";
		$text['compareselected'] = "Compare los Seleccionados";
		$text['dnatestscompare'] = "Compare los Tests Y-DNA";
		$text['keep_name_private'] = "Deje los Nombres en Privado";
		$text['browsealltests'] = "Examinar todos los Tests";
		$text['all_dna_tests'] = "Todos los Tests DNA";
		$text['fastmutating'] = "Mutación Rapida";
		$text['alltypes'] = "Todos los Tipos";
		$text['allgroups'] = "Todos los Grupos";
		$text['Ydna_LITbox_info'] = "La(s) prueba(s) vinculada(s) a esta persona no fueron tomadas necesariamente por esta persona. <br /> La columna 'Haplogroup' muestra datos en rojo si el resultado es 'Predicho' o verde si la prueba está 'Confirmada'.";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Compare selected mtDNA Tests";
		$text['dnatestscompare_atdna'] = "Compare selected atDNA Tests";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Extra Mutations";
		$text['mrca'] = "MRC Ancestor";
		$text['ydna_test'] = "Y-DNA Tests";
		$text['mtdna_test'] = "mtDNA (Mitochondrial) Tests";
		$text['atdna_test'] = "atDNA (autosomal) Tests";
		$text['segment_start'] = "Start";
		$text['segment_end'] = "End";
		$text['suggested_relationship'] = "Suggested";
		$text['actual_relationship'] = "Actual";
		$text['12markers'] = "Markers 1-12";
		$text['25markers'] = "Markers 13-25";
		$text['37markers'] = "Markers 26-37";
		$text['67markers'] = "Markers 38-67";
		$text['111markers'] = "Markers 68-111";
		//added in 13.1
		$text['comparemore'] = "At least two tests must be selected to compare.";
		break;
}

//common
$text['matches'] = "Coincidencias";
$text['description'] = "Descripción";
$text['notes'] = "Notas";
$text['status'] = "Estado";
$text['newsearch'] = "Nueva Búsqueda";
$text['pedigree'] = "Arbol Genealógico";
$text['seephoto'] = "Ver foto";
$text['andlocation'] = "&amp; ubicación";
$text['accessedby'] = "consultado por";
$text['children'] = "Hijos";  //from getperson
$text['tree'] = "Arbol";
$text['alltrees'] = "Todos los Arboles";
$text['nosurname'] = "[sin apellido]";
$text['thumb'] = "Miniatura";  //as in Thumbnail
$text['people'] = "Personas";
$text['title'] = "Título";  //from getperson
$text['suffix'] = "Sufijo";  //from getperson
$text['nickname'] = "Apodo";  //from getperson
$text['lastmodified'] = "Última Modificación";  //from getperson
$text['married'] = "Casado";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Nombre"; //from showmap
$text['lastfirst'] = "Apellido, Nombre(s)";  //from search
$text['bornchr'] = "Nacido/Bautizado";  //from search
$text['individuals'] = "Individuos";  //from whats new
$text['families'] = "Familias";
$text['personid'] = "ID Persona";
$text['sources'] = "Fuentes";  //from getperson (next several)
$text['unknown'] = "Desconocido";
$text['father'] = "Padre";
$text['mother'] = "Madre";
$text['christened'] = "Bautismo";
$text['died'] = "Fallecimiento";
$text['buried'] = "Enterrado/a";
$text['spouse'] = "Cónyuge";  //from search
$text['parents'] = "Padres";  //from pedigree
$text['text'] = "Texto";  //from sources
$text['language'] = "Idioma";  //from languages
$text['descendchart'] = "Descendientes";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Individuo";
$text['edit'] = "Editar";
$text['date'] = "Fecha";
$text['login'] = "Ingresar";
$text['logout'] = "Salir";
$text['groupsheet'] = "Hoja del Grupo";
$text['text_and'] = "y";
$text['generation'] = "Generación";
$text['filename'] = "Nombre de archivo";
$text['id'] = "ID";
$text['search'] = "Buscar";
$text['user'] = "Usuario";
$text['firstname'] = "Nombre";
$text['lastname'] = "Apellido";
$text['searchresults'] = "Resultados de la Búsqueda";
$text['diedburied'] = "Fallecido/Enterrado";
$text['homepage'] = "Inicio";
$text['find'] = "Buscando...";
$text['relationship'] = "Parentesco";		//in German, Verwandtschaft
$text['relationship2'] = "Relación"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Cronología";
$text['yesabbr'] = "Si";               //abbreviation for 'yes'
$text['divorced'] = "Divorcio";
$text['indlinked'] = "Vinculado a";
$text['branch'] = "Rama";
$text['moreind'] = "Más individuos";
$text['morefam'] = "Más familias";
$text['surnamelist'] = "Índice de apellidos";
$text['generations'] = "Generaciones";
$text['refresh'] = "Refrescar";
$text['whatsnew'] = "Novedades";
$text['reports'] = "Reportes";
$text['placelist'] = "Lista de Lugares";
$text['baptizedlds'] = "Bautismo (LDS)";
$text['endowedlds'] = "Investido (LDS)";
$text['sealedplds'] = "Sellado P (LDS)";
$text['sealedslds'] = "Sellado C (LDS)";
$text['ancestors'] = "Antepasados";
$text['descendants'] = "Descendientes";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Fecha última importación GEDCOM";
$text['type'] = "Tipo";
$text['savechanges'] = "Guardar Cambios";
$text['familyid'] = "ID Familia";
$text['headstone'] = "Lapidas";
$text['historiesdocs'] = "Historias";
$text['anonymous'] = "anónimos";
$text['places'] = "Lugares";
$text['anniversaries'] = "Fechas y aniversarios";
$text['administration'] = "Administración";
$text['help'] = "Ayuda";
//$text['documents'] = "Documents";
$text['year'] = "Año";
$text['all'] = "Todos";
$text['address'] = "Dirección";
$text['suggest'] = "Sugerir";
$text['editevent'] = " Sugiera un cambio para este evento";
$text['morelinks'] = "Más Enlaces";
$text['faminfo'] = "Información Familiar";
$text['persinfo'] = "Información Personal";
$text['srcinfo'] = "Fuente de la información";
$text['fact'] = "Hecho";
$text['goto'] = "Seleccione una página";
$text['tngprint'] = "Imprimir";
$text['databasestatistics'] = "Estadísticas"; //needed to be shorter to fit on menu
$text['child'] = "Hijos";  //from familygroup
$text['repoinfo'] = "Información Repositorio ";
$text['tng_reset'] = "Reiniciar";
$text['noresults'] = "No se encontraron resultados";
$text['allmedia'] = "Todos los Medios";
$text['repositories'] = "Repositorios";
$text['albums'] = "Álbumes";
$text['cemeteries'] = "Cementerios";
$text['surnames'] = "Apellidos";
$text['dates'] = "Fechas";
$text['link'] = "Enlaces";
$text['media'] = "Medios";
$text['gender'] = "Sexo";
$text['latitude'] = "Latitud";
$text['longitude'] = "Longitud";
$text['bookmarks'] = "Favoritos";
$text['bookmark'] = "Añadir a Favoritos";
$text['mngbookmarks'] = "Ir a Favoritos";
$text['bookmarked'] = "Favorito Añadido";
$text['remove'] = "Quitar";
$text['find_menu'] = "Buscar";
$text['info'] = "Info"; //this needs to be a very short abbreviation
$text['cemetery'] = "Cementerio";
$text['gmapevent'] = "Mapa del Evento";
$text['gevents'] = "Evento";
$text['googleearthlink'] = "Enlace a Google Earth";
$text['googlemaplink'] = "Enlace a Google Maps";
$text['gmaplegend'] = "Leyenda del Marcador";
$text['unmarked'] = "Sin marcar";
$text['located'] = "Ubicado";
$text['albclicksee'] = "Clic para ver todos los items en este álbum";
$text['notyetlocated'] = "Todavía sin ubicar";
$text['cremated'] = "Cremado";
$text['missing'] = "Falta";
$text['pdfgen'] = "Generador PDF";
$text['blank'] = "Cuadro Vacío";
$text['fonts'] = "Tipografía";
$text['header'] = "Encabezado";
$text['data'] = "Datos";
$text['pgsetup'] = "Configurar Página";
$text['pgsize'] = "Tamaño Página";
$text['orient'] = "Orientación"; //for a page
$text['portrait'] = "Retrato";
$text['landscape'] = "Apaisado";
$text['tmargin'] = "Margen Superior";
$text['bmargin'] = "Margen Inferior";
$text['lmargin'] = "Margen Izquierdo";
$text['rmargin'] = "Margen Derecho";
$text['createch'] = "Crear Gráfico";
$text['prefix'] = "Prefijo";
$text['mostwanted'] = "Más Buscado";
$text['latupdates'] = "Últimas Actualizaciones";
$text['featphoto'] = "Foto Destacada";
$text['news'] = "Noticias";
$text['ourhist'] = "Historia de Nuestra Familia";
$text['ourhistanc'] = "Historia de Nuestra Familia y Ancestros";
$text['ourpages'] = "Paginas Genealógicas de Nuestra Familia";
$text['pwrdby'] = "Este sitio está desarrollado por";
$text['writby'] = "escrito por";
$text['searchtngnet'] = "Buscar en TNG Network (GENDEX)";
$text['viewphotos'] = "Ver todas las fotos";
$text['anon'] = "Actualmente aparece como anónimo";
$text['whichbranch'] = "¿De qué rama es usted?";
$text['featarts'] = "Artículos Destacados";
$text['maintby'] = "Mantenido por";
$text['createdon'] = "Creado en";
$text['reliability'] = "Confiabilidad";
$text['labels'] = "Etiquetas";
$text['inclsrcs'] = "Incluir Fuentes";
$text['cont'] = "(cont.)"; //abbreviation for continued
$text['mnuheader'] = "Página de Inicio";
$text['mnusearchfornames'] = "Buscar";
$text['mnulastname'] = "Apellido";
$text['mnufirstname'] = "Nombre";
$text['mnusearch'] = "Buscar";
$text['mnureset'] = "Borrar todo";
$text['mnulogon'] = "Ingresar";
$text['mnulogout'] = "Salir";
$text['mnufeatures'] = "Otras características";
$text['mnuregister'] = "Solicitar Cuenta de Usuario";
$text['mnuadvancedsearch'] = "Búsqueda Avanzada";
$text['mnulastnames'] = "Apellidos";
$text['mnustatistics'] = "Estadísticas";
$text['mnuphotos'] = "Fotos";
$text['mnuhistories'] = "Historias";
$text['mnumyancestors'] = "Fotos &amp; Historias para los Ancestros de [Person]";
$text['mnucemeteries'] = "Cementerios";
$text['mnutombstones'] = "Lápidas";
$text['mnureports'] = "Reportes";
$text['mnusources'] = "Fuentes";
$text['mnuwhatsnew'] = "Novedades";
$text['mnushowlog'] = "Registro de Ingresos";
$text['mnulanguage'] = "Cambiar Idioma";
$text['mnuadmin'] = "Administración";
$text['welcome'] = "Bienvenido";
$text['contactus'] = "Contacto";
//changed in 8.0.0
$text['born'] = "Nacimiento";
$text['searchnames'] = "Buscar Personas";
//added in 8.0.0
$text['editperson'] = "Editar Persona";
$text['loadmap'] = "Cargar el mapa";
$text['birth'] = "Nacimiento";
$text['wasborn'] = "Nació";
$text['startnum'] = "Primer Número";
$text['searching'] = "Buscando";
//moved here in 8.0.0
$text['location'] = "Localidad";
$text['association'] = "Asociación";
$text['collapse'] = "Contraer";
$text['expand'] = "Expandir";
$text['plot'] = "Parcela";
$text['searchfams'] = "Buscar Familias";
//added in 8.0.2
$text['wasmarried'] = "Casado";
$text['anddied'] = "Fallecimiento";
//added in 9.0.0
$text['share'] = "Compartir";
$text['hide'] = "Esconder";
$text['disabled'] = "Su cuenta de usuario fue des-habilitada. Por favor haga contacto con el administrador por más información.";
$text['contactus_long'] = "Si usted tiene alguna pregunta o comentario respecto a la información existente en este sitio web, por favor póngase en <span class=\"emphasis\"><a href=\"suggest.php\">contacto</a></span> con nosotros.";
$text['features'] = "Características";
$text['resources'] = "Recursos";
$text['latestnews'] = "Últimas Noticias";
$text['trees'] = "Árboles";
$text['wasburied'] = "fue sepultado";
//moved here in 9.0.0
$text['emailagain'] = "Email de nuevo";
$text['enteremail2'] = "Por favor, introduzca su dirección de email de nuevo";
$text['emailsmatch'] = "Tu emails no coinciden. Por favor, introduzca la misma dirección en cada campo";
$text['getdirections'] = "Clic para conseguir direcciones";
$text['calendar'] = "Calendario";
//changed in 9.0.0
$text['directionsto'] = " al ";
$text['slidestart'] = "Mostrar como diapositivas";
$text['livingnote'] = "Al menos un individuo vivo está vinculado a esta nota - Detalles Reservados.";
$text['livingphoto'] = "Al menos un individuo vivo está vinculado a este ítem - Detalles Reservados.";
$text['waschristened'] = "Bautismo";
//added in 10.0.0
$text['branches'] = "Ramas";
$text['detail'] = "Detalles";
$text['moredetail'] = "Más detalles";
$text['lessdetail'] = "Menos detalles";
$text['conflds'] = "Confirmado (LDS)";
$text['initlds'] = "Iniciado (LDS)";
$text['wascremated'] = "fue cremado";
//moved here in 11.0.0
$text['text_for'] = "para";
//added in 11.0.0
$text['searchsite'] = "Busque en este sitio";
$text['searchsitemenu'] = "Buscar en el sitio";
$text['kmlfile'] = "Descarque un archivo .kml para mostrar su ubicación en Google Earth";
$text['download'] = "Click para descargar";
$text['more'] = "Mas";
$text['heatmap'] = "Mapa de Calor";
$text['refreshmap'] = "Refrescar Mapa";
$text['remnums'] = "Borre Numeros y Pines";
$text['photoshistories'] = "Photos &amp; Histories";
$text['familychart'] = "Family Chart";
//added in 12.0.0
$text['firstnames'] = "Nombres";
//moved here in 12.0.0
$text['dna_test'] = "DNA Test";
$text['test_type'] = "Tipo de Test";
$text['test_info'] = "Informacion del Test";
$text['takenby'] = "Taken by";
$text['haplogroup'] = "Haplogroupo";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Enlaces relevantes";
$text['nofirstname'] = "[no hay nombre]";
//added in 12.0.1
$text['cookieuse'] = "Nota: Este sitio usa cookies.";
$text['dataprotect'] = "Politica de Proteccion de Datos";
$text['viewpolicy'] = "Ver Politica";
$text['understand'] = "Yo entiendo";
$text['consent'] = "Doy mi consentimiento a este sitio para almacenar la informacion personal recogida aqui. Yo entiendo que puedo solicitarle al dueño del sitio que quite la informacion en cualquier momento.";
$text['consentreq'] = "Por favor de su consentimiento a este sitio para almacenar información personal.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Enlaces rápidos";
$text['yourname'] = "Tu nombre";
$text['youremail'] = "Su dirección de correo electrónico";
$text['liketoadd'] = "Cualquier información que desee agregar";
$text['webmastermsg'] = "Mensaje de webmaster";
$text['gallery'] = "Ver galería";
$text['wasborn_male'] = "nació";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "nació"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "fue bautizado";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "fue bautizada";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "falleció";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "falleció";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "fue sepultado"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "fue sepultada"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "fue incinerado";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "fue incinerada";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "se casó con";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "se casó con";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "se divorció";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "se divorció";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " en ";			// used as a preposition to the location
$text['onthisdate'] = " el ";		// when used with full date
$text['inthisyear'] = " en ";		// when used with year only or month / year dates
$text['and'] = "and ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Informacion del Test DNA";
//added in 13.0
$text['visitor'] = "Visitantes";

$text['popupnote2'] = " = Nuevo árbol";

//moved here in 14.0
$text['zoomin'] = "Acercar";
$text['zoomout'] = "Alejar";
$text['scrollnote'] = "Arrastre o baje para ver toda la tabla";
$text['general'] = "General";

//changed in 14.0
$text['otherevents'] = "Otros Eventos";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Connections";
$text['continue'] = "Continue";
$text['title2'] = "Título"; //para medios, fuentes, etc. (no para personas)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>