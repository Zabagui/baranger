<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Извори информација";
		$text['shorttitle'] = "Кратак наслов";
		$text['callnum'] = "Позивни број";
		$text['author'] = "АУТОР";
		$text['publisher'] = "Издавач";
		$text['other'] = "Остале информације";
		$text['sourceid'] = "ИЗВОР ИД";
		$text['moresrc'] = "Други извори";
		$text['repoid'] = "ИД Репозиторијума";
		$text['browseallrepos'] = "Прикажи све Репозиторијуме";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Нови језик";
		$text['changelanguage'] = "Промена језика";
		$text['languagesaved'] = "Активирај одабрани језик";
		$text['sitemaint'] = "Одржавање сајта је у току";
		$text['standby'] = "Сајт је привремено недоступан, врши се ажурирање базе података. Молим вас покушајте мало касније да отворите сајт. Ако сајт остане угашен дуже време, молим вас <a href=\"suggest.php\">контактирајте власника сајта</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM почиње од";
		$text['producegedfrom'] = "Направи GEDCOM фајл у коме се налазе";
		$text['numgens'] = "Број генерација";
		$text['includelds'] = "Укљући ЛДС информације";
		$text['buildged'] = "Направи GEDCOM";
		$text['gedstartfrom'] = "GEDCOM стартује од";
		$text['nomaxgen'] = "Морате да одредите максималан број генерација. Вратите се на претходну страну, користећи дугме за назад и исправите грешку.";
		$text['gedcreatedfrom'] = "GEDCOM направљен од";
		$text['gedcreatedfor'] = "направљен за";
		$text['creategedfor'] = "Креирање GEDCOM фајлова";
		$text['email'] = "Ваша Е-маил адреса";
		$text['suggestchange'] = "Предлог за измену или допуну података";
		$text['yourname'] = "Ваше име и презиме";
		$text['comments'] = "Опис <br />предложених измена";
		$text['comments2'] = "Ваш коментар";
		$text['submitsugg'] = "Пошаљи сугестију";
		$text['proposed'] = "Предложена измена";
		$text['mailsent'] = "Хвала вам. Ваша порука је послата.";
		$text['mailnotsent'] = "Жао нам је, али ваша порука неможе бити испорућена.";
		$text['mailme'] = "Пошаљи копију и на ову адресу";
		$text['entername'] = "Заборавили сте да упишете ваше име.";
		$text['entercomments'] = "Заборавили сте да упишите ваш коментар";
		$text['sendmsg'] = "Пошаљи Поруку";
		//added in 9.0.0
		$text['subject'] = "Наслов поруке";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Фотографије и историје за";
		$text['indinfofor'] = "Информације особе за";
		$text['pp'] = "стр."; //page abbreviation
		$text['age'] = "ГОДИНА И ДАНА";
		$text['agency'] = "Кумство";
		$text['cause'] = "Узрок";
		$text['suggested'] = "Предложено";
		$text['closewindow'] = "Затвори прозор";
		$text['thanks'] = "Хвала";
		$text['received'] = "Ваша сугестија је прослеђена администратору на преглед.";
		$text['indreport'] = "Извештај о особи";
		$text['indreportfor'] = "Извештај особе за";
		$text['bkmkvis'] = "<strong>Напомена:</strong> Ове омиљене странице су видљиве само на овом рачунару и на овом wеб претраживачу.";
        //added in 9.0.0
		$text['reviewmsg'] = "Имате предложену примедбу, за коју је потребно ваше мишљење. Овај поднесак односи се на:";
        $text['revsubject'] = "Предложена сугестија треба вашу рецензију";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Калкулатор степена сродства";
		$text['findrel'] = "Пронађи Сродство";
		$text['person1'] = "Особа 1:";
		$text['person2'] = "Особа 2:";
		$text['calculate'] = "ИЗРАЧУНАЈ";
		$text['select2inds'] = "Изаберите две особе.";
		$text['findpersonid'] = "Пронађи ИД особе";
		$text['enternamepart'] = "Упишите део имена и / или презимена";
		$text['pleasenamepart'] = "Упишите део имена или презимена.";
		$text['clicktoselect'] = "кликните мишем и одаберите";
		$text['nobirthinfo'] = "Нема информација о рођењу";
		$text['relateto'] = "Сродство са особом по имену - ";
		$text['sameperson'] = "Две особе су иста особа.";
		$text['notrelated'] = "Ове две особе нису у сродству уназад xxx генерација."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Да би сте видели степен сродства између две особе, користите дугме 'ТРАЖИ' за проналажење особа (или задржите већ уписану особу), затим притисните дугме 'ИЗРАЧУНАЈ'";
		$text['sometimes'] = "(Понекад провера различитог броја генерација даје другачији резултат.)";
		$text['findanother'] = "Пронађи друго сродство";
		$text['brother'] = "брат";
		$text['sister'] = "сестра";
		$text['sibling'] = "полубрат";
		$text['uncle'] = "xxx стриц";
		$text['aunt'] = "xxx тетка";
		$text['uncleaunt'] = "xxx стриц/тетка";
		$text['nephew'] = "xxx нећак/братанац";
		$text['niece'] = "xxx сестричина/синовица";
		$text['nephnc'] = "xxx нећак/сестричина";
		$text['removed'] = "пута уклоњена";
		$text['rhusband'] = "муж ";
		$text['rwife'] = "жена ";
		$text['rspouse'] = "супруга ";
		$text['son'] = "син";
		$text['daughter'] = "ћерка";
		$text['rchild'] = "дете";
		$text['sil'] = "син по закону";
		$text['dil'] = "ћерка по закону";
		$text['sdil'] = "син или ћерка по закону";
		$text['gson'] = "xxx унук";
		$text['gdau'] = "xxx унука";
		$text['gsondau'] = "xxx унук/унука";
		$text['great'] = "велики";
		$text['spouses'] = "су супружници";
		$text['is'] = "је";
		$text['changeto'] = "Промени у: (унеси ИД):";
		$text['notvalid'] = "није важећи ИД број Особе или број не постоји у бази. Покушајте поново.";
		$text['halfbrother'] = "полубрат";
		$text['halfsister'] = "полусестра";
		$text['halfsibling'] = "полубрат по закону";
		//changed in 8.0.0
		$text['gencheck'] = "Максимални број генерација за проверу";
		$text['mcousin'] = "xxx рођак од yyy";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx рођакиња од yyy";  //female cousin
		$text['cousin'] = "xxx рођак од yyy";
		$text['mhalfcousin'] = "xxx полусестра од yyy";  //male cousin
		$text['fhalfcousin'] = "xxx полубрат од yyy";  //female cousin
		$text['halfcousin'] = "xxx полурођак од yyy";
		//added in 8.0.0
		$text['oneremoved'] = "од стрица";
		$text['gfath'] = "xxx деда од";
		$text['gmoth'] = "xxx баба од";
		$text['gpar'] = "xxx деда/баба од";
		$text['mothof'] = "мајка од";
		$text['fathof'] = "отац од";
		$text['parof'] = "родитељ од";
		$text['maxrels'] = "Максимални број веза за приказ";
		$text['dospouses'] = "Прикажи везе где су укључени и супружици";
		$text['rels'] = "СРОДСТВО";
		$text['dospouses2'] = "Прикажи супружнике";
		$text['fil'] = "отац по закону (очух)";
		$text['mil'] = "мајка по закону (маћеха)";
		$text['fmil'] = "отац или мајка по закону (очух/маћеха)";
		$text['stepson'] = "пасторак";
		$text['stepdau'] = "пасторка";
		$text['stepchild'] = "пасторче";
		$text['stepgson'] = "xxx усвојен-унук";
		$text['stepgdau'] = "xxx усвојена-унука";
		$text['stepgchild'] = "xxx усвојени-унуци";
		//added in 8.1.1
		$text['ggreat'] = "прадеда";
		//added in 8.1.2
		$text['ggfath'] = "xxx прадеда од";
		$text['ggmoth'] = "xxx прабаба од";
		$text['ggpar'] = "xxx прадеда/прабаба од";
		$text['ggson'] = "xxx праунук од";
		$text['ggdau'] = "xxx праунука од";
		$text['ggsondau'] = "xxx праунук/праунука од";
		$text['gstepgson'] = "xxx усвојен-праунук од";
		$text['gstepgdau'] = "xxx usvojena-praunuka od";
		$text['gstepgchild'] = "xxx усвојено-праунуче од";
		$text['guncle'] = "xxx деда стриц ";
		$text['gaunt'] = "xxx баба тетка од";
		$text['guncleaunt'] = "xxx деда стриц/баба тетка од";
		$text['gnephew'] = "xxx пра нећак/братанац од";
		$text['gniece'] = "xxx пра нећака/братаница од";
		$text['gnephnc'] = "xxx пра братанац/братаница од";
		//added in 14.0
		$text['pathscalc'] = "Потражите везе";
		$text['findrel2'] = "Пронађите сродства и друге везе";
		$text['makeme2nd'] = "Користи мој ID";
		$text['usebookmarks'] = "Користите обележиваче/bookmarks";
		$text['select2inds'] = "Изаберите две особе.";
		$text['indinfofor'] = "Индивидуалне информације за";
		$text['nobookmarks'] = "Нема обележивача/bookmark за коришćење";
		$text['bkmtitle'] = "Особе пронађене у обележивачима/bookmarks";
		$text['bkminfo'] = "Изаберите особу:";
		$text['sortpathsby'] = "Сортирај путање по броју";
		$text['sortbyshort'] = "Сортирај по";
		$text['bylengthshort'] = "Дужина";
		$text['badID1'] = ": ИД лоше особе1 - вратите се и исправите";
		$text['badID2'] = ": ИД лоше особе2 - вратите се и исправите";
		$text['notintree'] = ": особа са овим ID-ом није у тренутној бази података стабла.";
		$text['sameperson'] = "Две особе су иста особа.";;
		$text['nopaths'] = "Ове особе нису повезане, нису у сродству";
		$text['nopaths1'] = "Нема више веза краćих од xxx";
		$text['nopaths2'] = "у xxx корацима претраге";
		$text['longestpath'] = "(најдужа до сада проверена путања била је дуга xxx корака)";
		$text['relevantpaths'] = "Број пронађених различитих релевантних путања: xxx";
		$text['skipMarr'] = "(поред тога, број путања пронађених, али нису приказани због превеликог броја бракова био је: xxx)";
		$text['mjaor'] = "или";
		$text['connectionsto'] = "Везе за ";
		$text['findanotherpers'] = "Нађи другу особу...";
		$text['sometimes'] = "(Понекад провера различитог броја генерација даје другачији резултат.)";
		$text['anotherpath'] = "Потражите друге везе";
		$text['xpath'] = "Путања ";
		$text['primary'] = "Почетна особа"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Крајња особа";
		$text['parent'] = "Родитељ";
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
		$text['hfather'] = "отац";
		$text['hmother'] = "мајка";
		$text['hhusband'] = "супруг";
		$text['hwife'] = "супруга";
		$text['hson'] = "син";
		$text['hdaughter'] = "ћерка";
		$text['maxruns'] = "Максималан број путања које треба проверити";
		$text['maxrshort'] = "Максималан број путања";
		$text['maxlength'] = "Путање веза не дуже од";
		$text['maxlshort'] = "Максимална дужина";
		$text['xstep'] = "корак";
		$text['xsteps'] = "коракa";
		$text['xmarriages'] = "xxx бракова";
		$text['xmarriage'] = "1 брак";
		$text['showspouses'] = "Прикажите оба супружника";
		$text['showTxt'] = "Прикажи текстуални опис путање";
		$text['showTxtshort'] = "Текстуално потомци/descendant";
		$text['compactBox'] = "Прикажите особе у компатном облику";
		$text['compactBoxshort'] = "Компактни облик";
		$text['paths'] = "Путање";
		$text['dospouses2'] = "Прикажи супружнике";
		$text['maxmopt'] = "Максималан број бракова по сродству";
		$text['maxm'] = "Максималан број бракова";
		$text['arerelated'] = "Ове особе су рођаци - њихово сродство је приказано у Путањи 1";
		$text['simplerel'] = "Једноставна претрага сродства";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Породични лист за - ";
		$text['ldsords'] = "ЛДС Уредбе (за мормонску цркву-неп.код нас)";
		$text['baptizedlds'] = "Крштење (ЛДС)";
		$text['endowedlds'] = "Обдарен (ЛДС)";
		$text['sealedplds'] = "Запечаћен П (ЛДС)";
		$text['sealedslds'] = "Запечаћен С (ЛДС)";
		$text['otherspouse'] = "ДРУГИ БРАКОВИ";
		$text['husband'] = "Супруг";
		$text['wife'] = "Супруга";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "Рођ.";
		$text['capaltbirthabbr'] = "А";
		$text['capdeathabbr'] = "Смр.";
		$text['capburialabbr'] = "Сахр.";
		$text['capplaceabbr'] = "85П";
		$text['capmarrabbr'] = "Вен.";
		$text['capspouseabbr'] = "СП";
		$text['redraw'] = "Исцртава се";
		$text['unknownlit'] = "Нема података";
		$text['popupnote1'] = "= Додатне информације";
		$text['pedcompact'] = "ЗБИЈЕНО";
		$text['pedstandard'] = "СТАНДАРДНО";
		$text['pedtextonly'] = "ТЕКСТ";
		$text['descendfor'] = "Потомци";
		$text['maxof'] = "Максимално";
		$text['gensatonce'] = "генерација приказаних одједном.";
		$text['sonof'] = "син - родитељи";
		$text['daughterof'] = "кћи - родитељи";
		$text['childof'] = "дете - родитељи";
		$text['stdformat'] = "СТАНДАРДНИ ФОРМАТ";
		$text['ahnentafel'] = "ПО ГЕНЕРАЦИЈАМА (ПЕДИГРЕ ДИЈ.)";
		$text['addnewfam'] = "Додај нову породицу";
		$text['editfam'] = "Измени податке о породици";
		$text['side'] = "- Крило";
		$text['familyof'] = "свих предака који воде до особе са именом";
		$text['paternal'] = "Очево";
		$text['maternal'] = "Мајчино";
		$text['gen1'] = "Одабрана особа";
		$text['gen2'] = "Родитељ";
		$text['gen3'] = "Деда и Баба";
		$text['gen4'] = "Прадеде и Прабабе";
		$text['gen5'] = "Čukundede i čukunbabe";
		$text['gen6'] = "Наврдеде и Наврбабе";
		$text['gen7'] = "Курђели и Курђеле";
		$text['gen8'] = "Аскурђели и Аскурђеле";
		$text['gen9'] = "Курђепи и Курђепе";
		$text['gen10'] = "Курлебали и Курлебале";
		$text['gen11'] = "Сукурдови и Сукурдове";
		$text['gen12'] = "Сурдепачи и Сурдепаче";
		$text['graphdesc'] = "График до те тачке";
		$text['pedbox'] = "КАРТИЦЕ";
		$text['regformat'] = "ПО ГЕНЕРАЦИЈАМА";
		$text['extrasexpl'] = "Ако постоје фотографије, медији или нека друга документа (историје,...) за неку од особа, одговарајућа иконица ће се појавити поред тог имена.";
		$text['popupnote3'] = "Нови графикон";
		$text['mediaavail'] = "Доступни медији";
		$text['pedigreefor'] = "Граф Предака (Педигре) за";
		$text['pedigreech'] = "Граф Предака (Педигре)";
		$text['datesloc'] = "Датуми и Локације";
		$text['borchr'] = "Рођење/Алтернативно - Смрт/Сахрана (два)";
		$text['nobd'] = "Нема датума рођења или смрти";
		$text['bcdb'] = "Рођење/Алт/Смрт/Сахрана (четири)";
		$text['numsys'] = "Бројевни Систем";
		$text['gennums'] = "Бројеви Генерације";
		$text['henrynums'] = "Хенри Бројеви";
		$text['abovnums'] = "d'Aboville Бројеви";
		$text['devnums'] = "de Villiers Бројеви";
		$text['dispopts'] = "Приказ Опција";
		//added in 10.0.0
		$text['no_ancestors'] = "Нема пронађених предака";
		$text['ancestor_chart'] = "Вертикални графикон предака";
		$text['opennewwindow'] = "Отвори у новом прозору";
		$text['pedvertical'] = "Вертикално";
		//added in 11.0.0
		$text['familywith'] = "Породица са";
		$text['fcmlogin'] = "Пријавите се да бисте видели детаље";
		$text['isthe'] = "је";
		$text['otherspouses'] = "други супружници";
		$text['parentfamily'] = "Родитељска породица ";
		$text['showfamily'] = "Приказ породице";
		$text['shown'] = "показано";
		$text['showparentfamily'] = "приказ родитељске породице";
		$text['showperson'] = "приказ особе";
		//added in 11.0.2
		$text['otherfamilies'] = "Друге породице";
		//added in 14.0
		$text['dtformat'] = "Табеле";
		$text['dtchildren'] = "Деца";
		$text['dtgrandchildren'] = "Унуци";
		$text['dtggrandchildren'] = "Праунуци";
		$text['dtgggrandchildren'] = "Great grandchildren"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Нема потомака";
		$text['dtgen'] = "Ген";
		$text['dttotal'] = "Укупно";
		$text['dtselect'] = "Изабрати";
		$text['dteachfulltable'] = "Свака пуна табела ćе имати";
		$text['dtrows'] = "редова";
		$text['dtdisplayingtable'] = "Приказ табеле";
		$text['dtgototable'] = "Иди до табеле:";
		$text['fcinstrdn'] = "Прикажи породицу са супружником";
		$text['fcinstrup'] = "Прикажи породицу са родитељима";
		$text['fcinstrplus'] = "Изаберите друге супружнике";
		$text['fcinstrfam'] = "Изаберите друге родитеље";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Не постоји ни један Извештај.";
		$text['reportname'] = "Назив Извештаја";
		$text['allreports'] = "Сви Извештаји";
		$text['report'] = "Извештај";
		$text['error'] = "Грешка";
		$text['reportsyntax'] = "Синтакса упита који креира извештај";
		$text['wasincorrect'] = "је погрешна, и као резултат тога, извештај се не може приказати. Контактирајте систем администратора : vladimir@milicevic.rs";
		$text['errormessage'] = "Error Message";
		$text['equals'] = "налик на";
		$text['endswith'] = "завршава се са";
		$text['soundexof'] = "звући као";
		$text['metaphoneof'] = "метафора од";
		$text['plusminus10'] = "+/- 10 година од";
		$text['lessthan'] = "мање од";
		$text['greaterthan'] = "више од";
		$text['lessthanequal'] = "мање или једнако";
		$text['greaterthanequal'] = "веће или једнако";
		$text['equalto'] = "једнако";
		$text['tryagain'] = "Покушајте поново";
		$text['joinwith'] = "Однос параметара";
		$text['cap_and'] = "AND";
		$text['cap_or'] = "OR";
		$text['showspouse'] = "Покажи брачне партнере (ће приказати дупликате ако појединац има више од једног брачног друга)";
		$text['submitquery'] = "Ваш упит";
		$text['birthplace'] = "Место рођења";
		$text['deathplace'] = "Место смрти";
		$text['birthdatetr'] = "Година рођења";
		$text['deathdatetr'] = "Година смрти";
		$text['plusminus2'] = "+/- 2 године од";
		$text['resetall'] = "Ресетуј све вредности";
		$text['showdeath'] = "Прикажи информације о смрти/сахрани";
		$text['altbirthplace'] = "Место крштења";
		$text['altbirthdatetr'] = "Година крштења";
		$text['burialplace'] = "Место сахране";
		$text['burialdatetr'] = "Година сахране";
		$text['event'] = "Dogaђај(и)";
		$text['day'] = "Дан";
		$text['month'] = "Месец";
		$text['keyword'] = "Кључна реч (ie, \"Abt\")";
		$text['explain'] = "Унесите податке о датуму да би видели догађаје који одговарају задатом критеријуму. Или оставите празно да би видели све одабране догађаје.";
		$text['enterdate'] = "Упишите или одаберите минимум једну од ових информација: дан, месец, година, кључна реч";
		$text['fullname'] = "Пуно име и презиме";
		$text['birthdate'] = "Датум рођења";
		$text['altbirthdate'] = "Датум крштења";
		$text['marrdate'] = "Датум склапања брака";
		$text['spouseid'] = "Брачни друг - ИД";
		$text['spousename'] = "Име брачног друга";
		$text['deathdate'] = "Датум смрти";
		$text['burialdate'] = "Датум сахране";
		$text['changedate'] = "Datum zadnje promene";
		$text['gedcom'] = "Породично стабло";
		$text['baptdate'] = "Датум крштења (ЛДС)";
		$text['baptplace'] = "Место крштења (ЛДС)";
		$text['endldate'] = "Датум Задужбине (ЛДС)";
		$text['endlplace'] = "Место Задужбине (ЛДС)";
		$text['ssealdate'] = "Датум печата С (ЛДС)";   //Sealed to spouse
		$text['ssealplace'] = "Место печата С (ЛДС";
		$text['psealdate'] = "Датум печата П (ЛДС)";   //Sealed to parents
		$text['psealplace'] = "Место печата П (ЛДС)";
		$text['marrplace'] = "Место склапања брака";
		$text['spousesurname'] = "Презиме брачног друга";
		$text['spousemore'] = "Ако унесете презиме супружника, морате унети још једну вредност и за друго поље.";
		$text['plusminus5'] = "+/- 5 година од";
		$text['exists'] = "постоји";
		$text['dnexist'] = "не постоји";
		$text['divdate'] = "Датум Развода";
		$text['divplace'] = "Место Развода";
		$text['otherevents'] = "Други догађаји";
		$text['numresults'] = "Резултати по страници";
		$text['mysphoto'] = "Загонетне Фотографије";
		$text['mysperson'] = "Особе које се траже, за породично стабло";
		$text['joinor'] = "Је 'Члан са ИЛИ ' опција не може да се користи са презименом супружника";
		$text['tellus'] = "Реците нам шта знате о њима";
		$text['moreinfo'] = "Више информација:";
		//added in 8.0.0
		$text['marrdatetr'] = "Година Брака";
		$text['divdatetr'] = "Година Развода";
		$text['mothername'] = "Мајчино Име";
		$text['fathername'] = "Очево Име";
		$text['filter'] = "Филтер";
		$text['notliving'] = "Није у животу";
		$text['nodayevents'] = "Догађаји за овај месец, а који нису повезани са одређеним даноом:";
		//added in 9.0.0
		$text['csv'] = "Раздвојен зарезима CSV фајл";
		//added in 10.0.0
		$text['confdate'] = "Датум потврде (ЛДС)";
		$text['confplace'] = "Место поврде (ЛДС)";
		$text['initdate'] = "Уводни/Иницијаторни Датум (ЛДС)";
		$text['initplace'] = "Уводно/Иницијаторно Место (ЛДС)";
		//added in 11.0.0
		$text['marrtype'] = "Тип Брака";
		$text['searchfor'] = "Тражи";
		$text['searchnote'] = "Напомена: Ова страница користи Google за извршавање својих претрага. Број одговора ће директно утицати у којој мери Google је био у стању да индексира сајт.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Евиденција за";
		$text['mostrecentactions'] = "последњих извршених упита.";
		$text['autorefresh'] = "Стартуј аутоматско обнављање сваких 30 секунди";
		$text['refreshoff'] = "Заустави аутоматско обнављање";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Гробља и Надгробни Споменици";
		$text['showallhsr'] = "Покажи све записе о Надгробним Споменицима";
		$text['in'] = "-";
		$text['showmap'] = "Покажи мапу";
		$text['headstonefor'] = "Споменик за";
		$text['photoof'] = "Фотографија -";
		$text['photoowner'] = "Аутор/Извор";
		$text['nocemetery'] = "Нема Гробља";
		$text['iptc005'] = "Наслов";
		$text['iptc020'] = "Категорије подршке";
		$text['iptc040'] = "Посебна упутства";
		$text['iptc055'] = "Датум креирања";
		$text['iptc080'] = "Аутор";
		$text['iptc085'] = "Позиција Аутора";
		$text['iptc090'] = "Град";
		$text['iptc095'] = "Држава/Покрајна";
		$text['iptc101'] = "Земља";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Наслов";
		$text['iptc110'] = "Извор";
		$text['iptc115'] = "Извор Фотографије";
		$text['iptc116'] = "Обавештење о ауторским правима";
		$text['iptc120'] = "Наслов";
		$text['iptc122'] = "Писац Наслова";
		$text['mapof'] = "Мапа";
		$text['regphotos'] = "Листа са детаљима";
		$text['gallery'] = "Само сличице";
		$text['cemphotos'] = "Фотографије Гробља";
		$text['photosize'] = "Величина";
        $text['iptc010'] = "Приоритет";
		$text['filesize'] = "Величина Фајла";
		$text['seeloc'] = "Види Локацију";
		$text['showall'] = "Покажи Све";
		$text['editmedia'] = "Измени Медиј";
		$text['viewitem'] = "Погледај ову ставку";
		$text['editcem'] = "Измеми Гробље";
		$text['numitems'] = "# Ставка";
		$text['allalbums'] = "Сви Албуми";
		$text['slidestop'] = "Паузирај Фото слајд";
		$text['slideresume'] = "Настави Фото слајд";
		$text['slidesecs'] = "Секунде за сваку фотографију у слајду:";
		$text['minussecs'] = "минус 0.5 секунди";
		$text['plussecs'] = "плус 0.5 секунди";
		$text['nocountry'] = "Непозната замља";
		$text['nostate'] = "Непозната држава";
		$text['nocounty'] = "Непознат округ";
		$text['nocity'] = "Непознат град";
		$text['nocemname'] = "Непознат назив гробља";
		$text['editalbum'] = "Измени Албум";
		$text['mediamaptext'] = "<strong>Напомена:</strong> Померите показивач миша преко слике да бисте видели имена особа. Кликните да бисте видели страницу особе са именом.";
		//added in 8.0.0
		$text['allburials'] = "Сва Сахрањивања";
		$text['moreinfo'] = "Кликните мишем за више информација о овој слици.";
		//added in 9.0.0
        $text['iptc025'] = "Кључне речи";
        $text['iptc092'] = "Под-локација";
		$text['iptc015'] = "Категорија";
		$text['iptc065'] = "Изворни Програм";
		$text['iptc070'] = "Верзија Програма";
		//added in 13.0
		$text['toggletags'] = "Toggle Tags";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Приказ презимена која поћињу на";
		$text['showtop'] = "Прикажи прве";
		$text['showallsurnames'] = "Приказ свих презимена";
		$text['sortedalpha'] = "по абецеди";
		$text['byoccurrence'] = "по учесталости";
		$text['firstchars'] = "Почетна слова";
		$text['mainsurnamepage'] = "Почетна страна са презименима";
		$text['allsurnames'] = "Сва Презимена";
		$text['showmatchingsurnames'] = "Кликните на презиме да видите особе са тим презименом.";
		$text['backtotop'] = "Повратак на почетак";
		$text['beginswith'] = "Која почињу са";
		$text['allbeginningwith'] = "Сва презимена која почињу са";
		$text['numoccurrences'] = "укупан број локалитета у заградама";
		$text['placesstarting'] = "Прикажи највећа места/локалитете ћије име почиње са";
		$text['showmatchingplaces'] = "Кликните на име места да видите мање локалитете. Кликните на икону за претрагу ако желите да видите ко је све повезан са том особом.";
		$text['totalnames'] = "укупно особа";
		$text['showallplaces'] = "Прикажи сва већа места/локације";
		$text['totalplaces'] = "укупно места";
		$text['mainplacepage'] = "Главна листа места";
		$text['allplaces'] = "Сва већа Места/Локације";
		$text['placescont'] = "Прикажи сва места која у имену садрже";
		//changed in 8.0.0
		$text['top30'] = "Првих xxx презимена";
		$text['top30places'] = "Првих xxx већих места/локација";
		//added in 12.0.0
		$text['firstnamelist'] = "Листа Имена";
		$text['firstnamesstarting'] = "Прикажи имена која почињу са";
		$text['showallfirstnames'] = "Прикажи сва имена";
		$text['mainfirstnamepage'] = "Главна листа имена";
		$text['allfirstnames'] = "Сва Имена";
		$text['showmatchingfirstnames'] = "Кликните на Име да бисте приказали одговарајуће записе.";
		$text['allfirstbegwith'] = "Сва имена која почињу са";
		$text['top30first'] = "Првих xxx Имена";
		$text['allothers'] = "Сви други";
		$text['amongall'] = "(међу свим именима)";
		$text['justtop'] = "Само првих xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(у последњих xx дана)";

		$text['photo'] = "Фотографије";
		$text['history'] = "Историја/Документ";
		$text['husbid'] = "ИД Супруга";
		$text['husbname'] = "Име и Презиме Супруга";
		$text['wifeid'] = "ИД Супруге";
		//added in 11.0.0
		$text['wifename'] = "Име и Презиме Супруге";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Обриши";
		$text['addperson'] = "Додај нову Особу";
		$text['nobirth'] = "Одабрана особа нема корктан датум рођења и не може бити додата.";
		$text['event'] = "Догађај(и)";
		$text['chartwidth'] = "Ширина дијаграма";
		$text['timelineinstr'] = "Додај нове особе уносећи њихов ИД у доња поља";
		$text['togglelines'] = "Прикључене линије";
		//changed in 9.0.0
		$text['noliving'] = "Одабрана особа је маркирана као жива и н може бити додата јер ви немате довољно права, за ту активност";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Претражавање свих породичних стабала";
		$text['treename'] = "Породично стабло";
		$text['owner'] = "Власник";
		$text['address'] = "Адреса";
		$text['city'] = "Место";
		$text['state'] = "Област/Провинција";
		$text['zip'] = "Поштански број";
		$text['country'] = "Држава";
		$text['email'] = "Ваша регистрована Е-маил адреса";
		$text['phone'] = "Телефон";
		$text['username'] = "Корисничко име";
		$text['password'] = "Лозинка";
		$text['loginfailed'] = "Пријављивање није успело.";

		$text['regnewacct'] = "<strong>Регистровање новог корисничког налога</strong>";
		$text['realname'] = "Ваше пуно име и презиме";
		$text['phone'] = "Телефон";
		$text['email'] = "Ваша регистрована Е-маил адреса";
		$text['address'] = "Адреса";
		$text['acctcomments'] = "Коментар";
		$text['submit'] = "Пошаљи";
		$text['leaveblank'] = "(оставите презно ако желите ново породично стабло)";
		$text['required'] = "Поља која морате обавезно попунити. <br><br> (НАПОМЕНА: За УПИС ЛОЗИНКЕ, користите најмање 8 карактера: бар једно мало и велико слово и бар један број), Хвала";
		$text['enterpassword'] = "Молим Вас упишите лозинку.";
		$text['enterusername'] = "Молим Вас упишите кориничко име.";
		$text['failure'] = "Жао нам је, али корисничко име које сте одабрали је већ у употреби. Вратите се на претходну страницу користећи дугме за назад и одаберите неко друго корисничко име.";
		$text['success'] = "Хвала. Добили смо ваш захтев за регистрацију. Добићете е-маил, ћим ваша регистрација буде активирана или у случају да су потребне додатне информације. После тога можете се пријавити на сајт.";
		$text['emailsubject'] = "Захтев за регистрацију ново корисника";
		$text['website'] = "Web Сајт";
		$text['nologin'] = "Нисте регистровани на сајту? ";
		$text['loginsent'] = "Информације о пријави су послате";
		$text['loginnotsent'] = "Тражене информације нису послате";
		$text['enterrealname'] = "Молим Вас упишите ваше право, пуно име и презиме.";
		$text['rempass'] = "Активирај сталну пријаву на овом вашем компјутеру";
		$text['morestats'] = "Потпуна статистика";
		$text['accmail'] = "<strong>НАПОМЕНА:</strong> Да би добили е-маил поруку од администратора сајта о свом налогу проверите да нисте случајно блокирали е-пошту за овај домен. Овај сајт је приватан сајт породице Милићевић. Сви подаци сакупљени у овом пројекту подлежу закону Републике Србије  о заштити података о личности Члана 6. Свако копирање података без дозволе аутора овог сајта подлеже истом закону и може добити судски еполог.";
		$text['newpassword'] = "Нова Лозинка";
		$text['resetpass'] = "Ресетуј лозинку";
		$text['nousers'] = "Овај образац се не може користити, све док постоји бар један кориснички запис. Ако сте власник сајта, уђите као Адиминистратор да креирате Администраторски налог.";
		$text['noregs'] = "Жао нам је али у овом тренутку не прихватамо регистрацију нових корисничких налога. Молим Вас <a href=\"suggest.php\">контактирајте нас</a> директно, ако имате сугестије/коментаре или питања у вези свега на овом сајту.";
		$text['emailmsg'] = "Примили сте нови захтев за кориснички налог сајта. Пријавите се на админ панел сајта и доделите одговарајућа права за овај нови налог. Ако одобрите ове регистрације, молим вас обавестите подносиоца захтева за одговор на ову поруку.";
		$text['accactive'] = "Кориснички налог је сада активиран, али корисник неће имати специјална права док се то не потврди од стране администратора.";
		$text['accinactive'] = "Идите на Admin/Users/Review ради приступу подешавањима корисничким налозима. Кориснички налог ће остати неактиван док се не измени и сними/сачува запис бар једном.";
		$text['pwdagain'] = "Лозинка поново";
		$text['enterpassword2'] = "Унесите лозинку поново.";
		$text['pwdsmatch'] = "Лозинке се не подударају. Унесите исту лозинку у свако поље. (НАПОМЕНА: Користите најмање 8 карактера: бар једно мало и велико слово и бар један број)";
		$text['acksubject'] = "Хвала на регистрацији"; //for a new user account
		$text['ackmessage'] = "Ваш захтев за корисничким налогом је примљен. Ваш корисички налог ће бити НЕАКТИВАН док не буде прегледан од стране администратора сајта. Бићете обавештени путем е-маила када ваш кориснички налог буде спреман за употребу. Због других активности администратора, неки пут може и дуже трајати одговор али будите сигурни да ћете добили е-маил";
		//added in 12.0.0
		$text['switch'] = "Прекидач";
		//added in 14.0
		$text['newpassword2'] = "Нова лозинка поново";
		$text['resetsuccess'] = "Успех: Лозинка је ресетована";
		$text['resetfail'] = "Грешка: Лозинка није ресетована";
		$text['failreason0'] = " (непозната грешка базе података)";
		$text['failreason2'] = " (немате дозволу да промените лозинку)";
		$text['failreason3'] = " (лозинке се не поклапају)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Прегледај све Гране стабла";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "ВЕЛИЧИНА";
		$text['totindividuals'] = "Укупно особа";
		$text['totmales'] = "Укупно особа мушког пола";
		$text['totfemales'] = "Укупно особа женског пола";
		$text['totunknown'] = "Укупно особа непознатог пола";
		$text['totliving'] = "Укупно живих";
		$text['totfamilies'] = "Укупно породица";
		$text['totuniquesn'] = "Укупно једниствених презимена";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Укупно извора";
		$text['avglifespan'] = "Просечан животни век";
		$text['earliestbirth'] = "Најраније рођење";
		$text['longestlived'] = "НАЈДУЖЕ ЖИВЕЛИ";
		$text['days'] = "дана";
		$text['age'] = "ГОДИНА И ДАНА";
		$text['agedisclaimer'] = "Израчунавање година је базирано на подацима рођења и смрти. Будући да постоје непотпуни подаци као што су пре \"1869\" или око \"1863\" или иза \"1780\" ова израчунавања не могу бити 100% тачна.";
		$text['treedetail'] = "Више информација о овом дрвету";
		$text['total'] = "Укупно";
		//added in 12.0
		$text['totdeceased'] = "Укупно умрлих";
		//added in 14.0
		$text['totalsourcecitations'] = "Укупно Извора Цитата";
		break;

	case "notes":
		$text['browseallnotes'] = "Листа свих белешки";
		break;

	case "help":
		$text['menuhelp'] = "ИЗБОР";
		break;

	case "install":
		$text['perms'] = "Права су сва била сетована.";
		$text['noperms'] = "Права не могу да се подесе за ове фајлове:";
		$text['manual'] = "Молим Вас поставите их ручно.";
		$text['folder'] = "Фолдер";
		$text['created'] = "направљено је";
		$text['nocreate'] = "не могу да се креирају. Молим Вас креирајте их ручно.";
		$text['infosaved'] = "Информације су сачуване, конекција потврђена!";
		$text['tablescr'] = "Табеле су креиране!";
		$text['notables'] = "Следеће табеле нису могле бити креиране:";
		$text['nocomm'] = "ТНГ не комуницира са вашом базом података. Табеле нису креиране.";
		$text['newdb'] = "сачувана информација, верификована конекција, створена нова база података:";
		$text['noattach'] = "Информације су сачуване. Конекција је успостављена и база података је креирана, али ТНГ се не може прикључити на њу.";
		$text['nodb'] = "Информације су сачуване. Веза је направљена, али база података не постоји и није могла бити креирана овде. Проверите да ли је име базе података тачно и да ли корисник базе података има одговарајући приступ, или користите контролни панел да бисте га креирали.";
		$text['noconn'] = "Информације су сачуване, али веза није успела. Једно или више од следећих je погрешно:";
		$text['exists'] = "већ постоји.";
		$text['noop'] = "Није извршена никаква операција.";
		//added in 8.0.0
		$text['nouser'] = "Корисник није креиран. Корисничко име можда већ постоји.";
		$text['notree'] = "Дрво није креирано. ИД стабла можда већ постоји.";
		$text['infosaved2'] = "Информације су сачуване";
		$text['renamedto'] = "преименован у";
		$text['norename'] = "није могуће преименовати";
		//changed in 13.0.0
		$text['loginfirst'] = "Прво морате да се пријавите на сајт, а уколико немате кориснички налог морате се регистровати.";
		break;

	case "imgviewer":
		$text['magmode'] = "Приказ Увеличавања";
		$text['panmode'] = "Панорамски Приказ";
		$text['pan'] = "Кликните и повуците да бисте се кретали унутар слике";
		$text['fitwidth'] = "Подесива Ширина";
		$text['fitheight'] = "Подесива Висина";
		$text['newwin'] = "Нови Прозор";
		$text['opennw'] = "Отвори слику у новом прозору";
		$text['magnifyreg'] = "Кликните да бисте увећали регион слике";
		$text['imgctrls'] = "Омогући контроле слике";
		$text['vwrctrls'] = "Омогућити контроле прегледача слика";
		$text['vwrclose'] = "Затворите прегледач слика";
		break;

	case "dna":
		$text['test_date'] = "Датум теста";
		$text['links'] = "Релевантни линкови";
		$text['testid'] = "ID Теста";
		//added in 12.0.0
		$text['mode_values'] = "Вредности Мода";
		$text['compareselected'] = "Изабери за упоређивање";
		$text['dnatestscompare'] = "Упоређивање Y-DNA Тестове";
		$text['keep_name_private'] = "Задржи Имена Приватно";
		$text['browsealltests'] = "Прегледати све ДНА Тестове";
		$text['all_dna_tests'] = "Сви ДНА Тестови";
		$text['fastmutating'] = "Брзе&nbsp;Мутације";
		$text['alltypes'] = "Сви Типови";
		$text['allgroups'] = "Све Групе";
		$text['Ydna_LITbox_info'] = "Тестo(ви) који су повезани са овом особом нису обавезно преузети од ове особе.<br/>'Хаплогроупа' приказује податке у црвеној боји ако је резултат 'Предвиђен унапред' или зелен ако је тест 'Потврђен'";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Упоредите изабране mtDNA Tестове";
		$text['dnatestscompare_atdna'] = "Упоредите изабране atDNA Tестове";
		$text['chromosome'] = "Хром";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "секвенца";
		$text['extra_mutations'] = "Екстра Мутације";
		$text['mrca'] = "MRC Предак";
		$text['ydna_test'] = "Y-DNA Tестови";
		$text['mtdna_test'] = "mtDNA (Митохондријски) Тестови";
		$text['atdna_test'] = "atDNA (аутозомни) Тестови";
		$text['segment_start'] = "Почетак";
		$text['segment_end'] = "Крај";
		$text['suggested_relationship'] = "Предложено";
		$text['actual_relationship'] = "Актуелно";
		$text['12markers'] = "Маркери 1-12";
		$text['25markers'] = "Маркери 13-25";
		$text['37markers'] = "Маркери 26-37";
		$text['67markers'] = "Маркери 38-67";
		$text['111markers'] = "Маркери 68-111";
		//added in 13.1
		$text['comparemore'] = "At least two tests must be selected to compare.";
		break;
}

//common
$text['matches'] = "Листа пронађених, од";
$text['description'] = "ОПИС";
$text['notes'] = "БЕЛЕШКЕ";
$text['status'] = "Статус";
$text['newsearch'] = "Нова претрага";
$text['pedigree'] = "Претци";
$text['seephoto'] = "Види фотографију";
$text['andlocation'] = "&amp; локација";
$text['accessedby'] = "приступ са ";
$text['children'] = "ДЕЦА";  //from getperson
$text['tree'] = "Породично стабло";
$text['alltrees'] = "Сва породична стабла";
$text['nosurname'] = "[нема презиме]";
$text['thumb'] = "Сличица";  //as in Thumbnail
$text['people'] = "ПОВЕЗАНО СА";
$text['title'] = "НАСЛОВ";  //from getperson
$text['suffix'] = "Суфикс";  //from getperson
$text['nickname'] = "НАДИМАК";  //from getperson
$text['lastmodified'] = "ПРОМЕНА";  //from getperson
$text['married'] = "ВЕНЧАЊЕ";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "ПРЕЗИМЕ И ИМЕ"; //from showmap
$text['lastfirst'] = "ПРЕЗИМЕ, ИМЕ";  //from search
$text['bornchr'] = "РОÐЕЊЕ ИЛИ КРШТЕЊЕ";  //from search
$text['individuals'] = "Особе";  //from whats new
$text['families'] = "Породице";
$text['personid'] = "ЛИЧНИ ИД";
$text['sources'] = "ИЗВОРИ";  //from getperson (next several)
$text['unknown'] = "Непознат";
$text['father'] = "ОТАЦ";
$text['mother'] = "МАЈКА";
$text['christened'] = "КРШТЕЊЕ";
$text['died'] = "СМРТ";
$text['buried'] = "САХРАНА";
$text['spouse'] = "БРАК";  //from search
$text['parents'] = "РОДИТЕЉИ";  //from pedigree
$text['text'] = "ТЕКСТ";  //from sources
$text['language'] = "Језик";  //from languages
$text['descendchart'] = "Опадајући";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "ОДАБРАНА ОСОБА";
$text['edit'] = "ИЗМЕНЕ";
$text['date'] = "Датум";
$text['login'] = "Пријављивање";
$text['logout'] = "ОДЈАВА";
$text['groupsheet'] = "Породични лист";
$text['text_and'] = "и";
$text['generation'] = "Генерација";
$text['filename'] = "IME FAJLA";
$text['id'] = "ИД";
$text['search'] = "ТРАЖИ";
$text['user'] = "Корисник";
$text['firstname'] = "Име";
$text['lastname'] = "Презиме";
$text['searchresults'] = "Резултат претраге";
$text['diedburied'] = "СМРТ / САХРАНА";
$text['homepage'] = "ПОЧЕТНА СТРАНА";
$text['find'] = "Пронађи...";
$text['relationship'] = "СРОДСТВО";		//in German, Verwandtschaft
$text['relationship2'] = "Сродствo"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "ВРЕМЕПЛОВ";
$text['yesabbr'] = "Да";               //abbreviation for 'yes'
$text['divorced'] = "РАЗВОД";
$text['indlinked'] = "ПОВЕЗАНО СА";
$text['branch'] = "Грана";
$text['moreind'] = "Још особа";
$text['morefam'] = "Још породица/фамилија";
$text['surnamelist'] = "Презимена";
$text['generations'] = "БРОЈ ГЕНЕРАЦИЈА";
$text['refresh'] = "ПОНОВИ";
$text['whatsnew'] = "Шта има ново";
$text['reports'] = "Извештаји";
$text['placelist'] = "Листа свих места која у своме имену садрже";
$text['baptizedlds'] = "Крштење (ЛДС)";
$text['endowedlds'] = "Обдарен (ЛДС)";
$text['sealedplds'] = "Запечаћен П (ЛДС)";
$text['sealedslds'] = "Запечаћен С (ЛДС)";
$text['ancestors'] = "ПРЕТЦИ";
$text['descendants'] = "ПОТОМЦИ";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Датум последњег пријема GEDCOM података";
$text['type'] = "Тип";
$text['savechanges'] = "Запиши промене";
$text['familyid'] = "ПОРОДИЧНИ ИД";
$text['headstone'] = "СПОМЕНИК";
$text['historiesdocs'] = "Историје";
$text['anonymous'] = "анониман";
$text['places'] = "Места";
$text['anniversaries'] = "Датуми и годишњице";
$text['administration'] = "Администрација";
$text['help'] = "ПОМОЋ";
//$text['documents'] = "Documents";
$text['year'] = "Година";
$text['all'] = "СВЕ";
$text['address'] = "Адреса";
$text['suggest'] = "Сугестија";
$text['editevent'] = "Предлог за измену за овај догађај";
$text['morelinks'] = "Више линкова";
$text['faminfo'] = "ПОРОДИЧНЕ ИНФОРМАЦИЈЕ";
$text['persinfo'] = "ЛИЧНЕ ИНФОРМАЦИЈЕ";
$text['srcinfo'] = "ДЕТАЉИ И ВЕЗЕ";
$text['fact'] = "Чињеница";
$text['goto'] = "Одабери страну";
$text['tngprint'] = "ШТАМПАЈ";
$text['databasestatistics'] = "Статистика"; //needed to be shorter to fit on menu
$text['child'] = "Дете";  //from familygroup
$text['repoinfo'] = "Информације о Репозиторијуму";
$text['tng_reset'] = "Ресет";
$text['noresults'] = "За задати критеријум није пронађен ни један догађај.";
$text['allmedia'] = "Сви Медији";
$text['repositories'] = "Репозиторијуми";
$text['albums'] = "Албуми";
$text['cemeteries'] = "Гробља";
$text['surnames'] = "Презимена";
$text['dates'] = "Датуми";
$text['link'] = "Линк";
$text['media'] = "МЕДИЈИ";
$text['gender'] = "Пол";
$text['latitude'] = "Latitude";
$text['longitude'] = "Longitude";
$text['bookmarks'] = "Bookmarks";
$text['bookmark'] = "Додај Bookmark";
$text['mngbookmarks'] = "Иди на Bookmarks";
$text['bookmarked'] = "Bookmark додан";
$text['remove'] = "Обрисати";
$text['find_menu'] = "ТРАЖИ";
$text['info'] = "ИНФО"; //this needs to be a very short abbreviation
$text['cemetery'] = "ГРОБЉЕ";
$text['gmapevent'] = "МАПА ДОГАЂАЈА";
$text['gevents'] = "Догађај";
$text['googleearthlink'] = "Линк ка Google Earth";
$text['googlemaplink'] = "Линк ка Google Maps";
$text['gmaplegend'] = "Ознаке Легенде";
$text['unmarked'] = "Не обележен";
$text['located'] = "Локализован";
$text['albclicksee'] = "Кликните да бисте видели све ставке у овом албуму";
$text['notyetlocated'] = "Још увек није лоциран";
$text['cremated'] = "Кремиран";
$text['missing'] = "Недостаје";
$text['pdfgen'] = "ПДФ Генератор";
$text['blank'] = "Празан Графикон";
$text['fonts'] = "Фонтови";
$text['header'] = "Заглавље";
$text['data'] = "Подаци";
$text['pgsetup'] = "Подешавање странице";
$text['pgsize'] = "Величина странице";
$text['orient'] = "Ориjентација странице"; //for a page
$text['portrait'] = "Усправна оријентација";
$text['landscape'] = "Хоризонтална оријентација";
$text['tmargin'] = "Горња Маргина";
$text['bmargin'] = "Доња Маргина";
$text['lmargin'] = "Лева Маргина";
$text['rmargin'] = "Десна Маргина";
$text['createch'] = "Креирај Графикон";
$text['prefix'] = "Префикс";
$text['mostwanted'] = "У потрази за";
$text['latupdates'] = "Последње Измене";
$text['featphoto'] = "Истакнуте Фотографије";
$text['news'] = "Вести";
$text['ourhist'] = "Наша породична историја";
$text['ourhistanc'] = "Наша породична историја и порекло";
$text['ourpages'] = "Наша породична генеаолошка страница";
$text['pwrdby'] = "Овај сајт покреће";
$text['writby'] = "написан од ";
$text['searchtngnet'] = "TNG (GENDEX)";
$text['viewphotos'] = "Погледај све фотографије";
$text['anon'] = "Тренутно сте анонимни";
$text['whichbranch'] = "Којој грани припадаш?";
$text['featarts'] = "Главни Чланци";
$text['maintby'] = "Одржавање је";
$text['createdon'] = "Креирано од";
$text['reliability'] = "Веродостојност";
$text['labels'] = "Лабеле";
$text['inclsrcs'] = "Укључују Изворе";
$text['cont'] = "(настави)"; //abbreviation for continued
$text['mnuheader'] = "ПОЧЕТНА СТРАНА";
$text['mnusearchfornames'] = "Потражи особу";
$text['mnulastname'] = "Презиме";
$text['mnufirstname'] = "Име";
$text['mnusearch'] = "Тражи";
$text['mnureset'] = "Почети изнова";
$text['mnulogon'] = "Пријављивање";
$text['mnulogout'] = "Одјављивање";
$text['mnufeatures'] = "Ваш избор";
$text['mnuregister'] = "Региструјте се као корисник";
$text['mnuadvancedsearch'] = "Детаљнија претрага";
$text['mnulastnames'] = "Презимена";
$text['mnustatistics'] = "Статистика";
$text['mnuphotos'] = "Фотографије";
$text['mnuhistories'] = "Историје";
$text['mnumyancestors'] = "Фотографије &amp; Историјски документи о Прецима постојеће [Oсоба]";
$text['mnucemeteries'] = "Гробља";
$text['mnutombstones'] = "Надгробни споменици";
$text['mnureports'] = "Извештаји";
$text['mnusources'] = "Извори";
$text['mnuwhatsnew'] = "Шта има ново";
$text['mnushowlog'] = "Логови приступа";
$text['mnulanguage'] = "Промена језика";
$text['mnuadmin'] = "Администрација";
$text['welcome'] = "Добро дошли";
$text['contactus'] = "Контакт";
//changed in 8.0.0
$text['born'] = "РОЂЕЊЕ";
$text['searchnames'] = "Потражи Презиме";
//added in 8.0.0
$text['editperson'] = "Измена Особе";
$text['loadmap'] = "Учитај Мапу";
$text['birth'] = "Рођење";
$text['wasborn'] = "је рођен";
$text['startnum'] = "Први Број";
$text['searching'] = "Претрага";
//moved here in 8.0.0
$text['location'] = "Локација/Место";
$text['association'] = "Асоцијација";
$text['collapse'] = "Скупи";
$text['expand'] = "Отвори";
$text['plot'] = "Плот";
$text['searchfams'] = "Потражи Породице";
//added in 8.0.2
$text['wasmarried'] = "ВЕНЧАЊЕ";
$text['anddied'] = "СМРТ";
//added in 9.0.0
$text['share'] = "Дели";
$text['hide'] = "Сакри";
$text['disabled'] = "Ваш кориснички налог је искључен. Контактирајте администратора сајта за више информација.";
$text['contactus_long'] = "Уколико имате неко питање или сугестију око овог сајта, слободно <span class=\"emphasis\"><a href=\"suggest.php\">контактирајте нас</a></span>. Ми очекујемо ваше сугестије.";
$text['features'] = "Карактеристика сајта";
$text['resources'] = "Генеалошки сајтови";
$text['latestnews'] = "Најновије Вести";
$text['trees'] = "Породична стабла";
$text['wasburied'] = "сахрањен";
//moved here in 9.0.0
$text['emailagain'] = "е-маил поново";
$text['enteremail2'] = "Унесите вашу е-маил адресу поново.";
$text['emailsmatch'] = "Ваше е-маил адресе се не подударају. Унесите исту е-маил адресу у свако поље.";
$text['getdirections'] = "Кликните да бисте добили упутства";
$text['calendar'] = "Календар";
//changed in 9.0.0
$text['directionsto'] = " до ";
$text['slidestart'] = "Стартуј фото слајд";
$text['livingnote'] = "Најмање једна жива особа је повезана са овом белешком - Детаљи ускраћени.";
$text['livingphoto'] = "Најмање једна жива особа је повезана са овом фотографијом - Детаљи ускраћени.";
$text['waschristened'] = "КРШТЕЊЕ";
//added in 10.0.0
$text['branches'] = "Породичне Гране";
$text['detail'] = "Детаљ";
$text['moredetail'] = "Више детаља";
$text['lessdetail'] = "Мање детаља";
$text['conflds'] = "Потврђен (ЛДС)";
$text['initlds'] = "Уводни (ЛДС)";
$text['wascremated'] = "је кремиран/а";
//moved here in 11.0.0
$text['text_for'] = "за тражени појам";
//added in 11.0.0
$text['searchsite'] = "Претраживање овог сајта";
$text['searchsitemenu'] = "Претрага сајта";
$text['kmlfile'] = "Преузмите .kml фајл за приказ ове локације у Google Earth";
$text['download'] = "Кликни за download";
$text['more'] = "Више";
$text['heatmap'] = "Топлотна Мапа";
$text['refreshmap'] = "Освежи Мапу";
$text['remnums'] = "Обрисати Бројеве и ознаке на карти";
$text['photoshistories'] = "Фотографије &amp; Историјски документи ";
$text['familychart'] = "Графикон Породице";
//added in 12.0.0
$text['firstnames'] = "Имена";
//moved here in 12.0.0
$text['dna_test'] = "ДНА Тест";
$text['test_type'] = "Тип Теста";
$text['test_info'] = "Информације о тесту";
$text['takenby'] = "Тест узет од";
$text['haplogroup'] = "Хаплогрупа";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Релевантни линкови";
$text['nofirstname'] = "[без имена]";
//added in 12.0.1
$text['cookieuse'] = "Напомена: Овај сајт користи тзв. колачиће.";
$text['dataprotect'] = "Политика заштите података";
$text['viewpolicy'] = "Прикажи политику заштите података";
$text['understand'] = "Разумем";
$text['consent'] = "Дајем свој пристанак да овај сајт чува личне податке који су сакупљени овде. Разумем да могу затражити од власника веб локације да уклони ове информације у било које време.";
$text['consentreq'] = "Молимо Вас да дате свој пристанак да овај сајт чува личне податке.";

//added in 12.1.0
$text['testsarelinked'] = "ДНA тестови су повезани са";
$text['testislinked'] = "ДНA тест је повезан са";

//added in 12.2
$text['quicklinks'] = "Брзи Линкови";
$text['yourname'] = "Твоје име";
$text['youremail'] = "Твоја емаил адреса";
$text['liketoadd'] = "Било коју информацију коју желите да додате";
$text['webmastermsg'] = "Порука Вебмастера";
$text['gallery'] = "Погледајте Галерију";
$text['wasborn_male'] = "је рођен";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "је рођена"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "крштен";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "крштена";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "умро";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "умрла";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "сахрањен"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "сахрањена"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "кремиран";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "кремирана";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "ожењен";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "удата";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "разведен";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "разведена";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " на локацији";			// used as a preposition to the location
$text['onthisdate'] = " на овај датум ";		// when used with full date
$text['inthisyear'] = " за месец/годину ";		// when used with year only or month / year dates
$text['and'] = "и ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "ДНА Test Инфо";
//added in 13.0
$text['visitor'] = "Visitor";

$text['popupnote2'] = "= Нови дијаграм";

//moved here in 14.0
$text['zoomin'] = "Увеличај";
$text['zoomout'] = "Смањи";
$text['scrollnote'] = "Ако не видите цео дијаграм померите слику доле или десно.";
$text['general'] = "Генерални";

//changed in 14.0
$text['otherevents'] = "Други догађаји и атрибути";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Везе";
$text['continue'] = "Настави";
$text['title2'] = "Наслов"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>