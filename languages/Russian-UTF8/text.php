<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Просмотр всех источников";
		$text['shorttitle'] = "Краткое название";
		$text['callnum'] = "Архивный номер";
		$text['author'] = "Автор";
		$text['publisher'] = "Издатель";
		$text['other'] = "Другая информация";
		$text['sourceid'] = "Источник";
		$text['moresrc'] = "Больше источников";
		$text['repoid'] = "ID архива";
		$text['browseallrepos'] = "Показать все архивы";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Новый язык";
		$text['changelanguage'] = "Изменить язык";
		$text['languagesaved'] = "Язык сохранен";
		$text['sitemaint'] = "Выполняется обслуживание сайта";
		$text['standby'] = "Сайт временно недоступен в связи с обновлением базы данных. Пожалуйста, попробуйте через несколько минут. Если сайт недоступен длительное время, вы можете <a href=\"suggest.php\">связаться с администратором</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "Начать GEDCOM с";
		$text['producegedfrom'] = "Создать GEDCOM из";
		$text['numgens'] = "Количество поколений";
		$text['includelds'] = "Включить информацию СПД";
		$text['buildged'] = "Создать GEDCOM";
		$text['gedstartfrom'] = "Начать с GEDCOM";
		$text['nomaxgen'] = "Вы должны указать максимальное количество поколений. Пожалуйста, используйте кнопку &#171;Назад&#187;, чтобы вернуться на предыдущую страницу и исправить ошибку";
		$text['gedcreatedfrom'] = "GEDCOM создан из";
		$text['gedcreatedfor'] = "предназначен для";
		$text['creategedfor'] = "Создать GEDCOM";
		$text['email'] = "Ваш Email";
		$text['suggestchange'] = "Предложить изменение";
		$text['yourname'] = "Ваше имя";
		$text['comments'] = "Описание <br/>предлагаемых изменений";
		$text['comments2'] = "Комментарии";
		$text['submitsugg'] = "Отправить предложение";
		$text['proposed'] = "Предлагаемое изменение";
		$text['mailsent'] = "Спасибо. Ваше сообщение было отправлено.";
		$text['mailnotsent'] = "Извините, но ваше сообщение не может быть доставлено. Пожалуйста, свяжитесь с xxx по yyy.";
		$text['mailme'] = "Отправить копию";
		$text['entername'] = "Пожалуйста, введите Ваше имя";
		$text['entercomments'] = "Пожалуйста, введите свои комментарии";
		$text['sendmsg'] = "Отправить сообщение";
		//added in 9.0.0
		$text['subject'] = "Тема";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Фотографии и истории для";
		$text['indinfofor'] = "Индивидуальная информация для";
		$text['pp'] = "стр."; //page abbreviation
		$text['age'] = "Возраст";
		$text['agency'] = "Агентство";
		$text['cause'] = "Причина";
		$text['suggested'] = "Предложенный";
		$text['closewindow'] = "Закрыть окно";
		$text['thanks'] = "Спасибо";
		$text['received'] = "Ваше предложение было отправлено администратору сайта для ознакомления.";
		$text['indreport'] = "Индивидуальный отчёт";
		$text['indreportfor'] = "Индивидуальный отчёт для";
		$text['bkmkvis'] = "<strong>Примечание:</strong> Эти закладки видны только на этом компьютере и только в этом браузере.";
        //added in 9.0.0
		$text['reviewmsg'] = "У вас есть предлагаемое изменение, которое требует вашей оценки. Это представление касается:";
        $text['revsubject'] = "Предлагаемое изменение требует вашей оценки";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "Калькулятор отношений";
		$text['findrel'] = "Найти родственников";
		$text['person1'] = "Человек 1:";
		$text['person2'] = "Человек 2:";
		$text['calculate'] = "Расчитать";
		$text['select2inds'] = "Пожалуйста, выберите двух человек.";
		$text['findpersonid'] = "Найти идентификатор лица";
		$text['enternamepart'] = "введите часть имени и/или фамилии";
		$text['pleasenamepart'] = "Введите часть имени или фамилии.";
		$text['clicktoselect'] = "нажмите, чтобы выбрать";
		$text['nobirthinfo'] = "Нет информации о рождении";
		$text['relateto'] = "Связь с";
		$text['sameperson'] = "Эти два человека - один и тот же человек.";
		$text['notrelated'] = "Эти два человека не связаны в поколениях ххх."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "Чтобы отобразить связь между двумя людьми, используйте кнопки «Найти» ниже, чтобы найти людей (или сохранить людей на экране), затем нажмите «Рассчитать».";
		$text['sometimes'] = "(Иногда проверка по другому количеству поколений дает другой результат.)";
		$text['findanother'] = "Найти другое отношение";
		$text['brother'] = "брат";
		$text['sister'] = "сестра";
		$text['sibling'] = "брат";
		$text['uncle'] = "ххх дядя";
		$text['aunt'] = "тётя xxx";
		$text['uncleaunt'] = "ххх дядя/тётя";
		$text['nephew'] = "племянник xxx";
		$text['niece'] = "племянница xxx";
		$text['nephnc'] = "племянник/племянница xxx";
		$text['removed'] = "раз(а) удалено";
		$text['rhusband'] = "муж";
		$text['rwife'] = "жена";
		$text['rspouse'] = "супруга";
		$text['son'] = "сын";
		$text['daughter'] = "дочь";
		$text['rchild'] = "ребенок";
		$text['sil'] = "зять";
		$text['dil'] = "невестка";
		$text['sdil'] = "сын или невестка";
		$text['gson'] = "внук xxx";
		$text['gdau'] = "внучка xxx";
		$text['gsondau'] = "внук xxx";
		$text['great'] = "Великий";
		$text['spouses'] = "супруги";
		$text['is'] = "является";
		$text['changeto'] = "Изменить на (введите идентификатор):";
		$text['notvalid'] = "не является допустимым идентификатором человека или не существует в этой базе данных. Пожалуйста, попробуйте ещё раз.";
		$text['halfbrother'] = "сводный брат";
		$text['halfsister'] = "сводная сестра";
		$text['halfsibling'] = "сводный брат или сестра";
		//changed in 8.0.0
		$text['gencheck'] = "Максимальное количество поколений для проверки";
		$text['mcousin'] = "xxx двоюродный брат yyy";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx двоюродная сестра yyy";  //female cousin
		$text['cousin'] = "xxx двоюродный брат yyy";
		$text['mhalfcousin'] = "xxx сводный двоюродный брат yyy";  //male cousin
		$text['fhalfcousin'] = "xxx сводная двоюродная сестра yyy";  //female cousin
		$text['halfcousin'] = "xxx сводный двоюродный брат yyy";
		//added in 8.0.0
		$text['oneremoved'] = "после удаления";
		$text['gfath'] = "ххх дедушка";
		$text['gmoth'] = "xxx бабушка";
		$text['gpar'] = "прародитель xxx";
		$text['mothof'] = "мать";
		$text['fathof'] = "отец";
		$text['parof'] = "родитель";
		$text['maxrels'] = "Максимум отношений для показа";
		$text['dospouses'] = "Показать отношения с участием супруга";
		$text['rels'] = "Отношения";
		$text['dospouses2'] = "Показать супругов";
		$text['fil'] = "тесть";
		$text['mil'] = "теща";
		$text['fmil'] = "отец или свекровь";
		$text['stepson'] = "пасынок";
		$text['stepdau'] = "падчерица";
		$text['stepchild'] = "падчерица";
		$text['stepgson'] = "приемный внук xxx";
		$text['stepgdau'] = "приемная внучка xxx";
		$text['stepgchild'] = "приемный внук xxx";
		//added in 8.1.1
		$text['ggreat'] = "пра";
		//added in 8.1.2
		$text['ggfath'] = "ххх прадедушка";
		$text['ggmoth'] = "ххх прабабушка";
		$text['ggpar'] = "ххх прародитель";
		$text['ggson'] = "ххх правнук";
		$text['ggdau'] = "ххх правнучка";
		$text['ggsondau'] = "ххх правнук";
		$text['gstepgson'] = "xxx приемный правнук";
		$text['gstepgdau'] = "xxx приемная правнучка";
		$text['gstepgchild'] = "ххх приемный правнук";
		$text['guncle'] = "ххх прадядя";
		$text['gaunt'] = "ххх пратётя xxx";
		$text['guncleaunt'] = "ххх прадядя/пратётя";
		$text['gnephew'] = "ххх праплемянник";
		$text['gniece'] = "ххх праплемянница";
		$text['gnephnc'] = "ххх праплемянник/праплемянница";
		//added in 14.0
		$text['pathscalc'] = "Поиск связей";
		$text['findrel2'] = "Найдите отношения и другие связи";
		$text['makeme2nd'] = "Использовать мой ID";
		$text['usebookmarks'] = "Использовать закладки";
		$text['select2inds'] = "Пожалуйста, выберите двух человек.";
		$text['indinfofor'] = "Индивидуальная информация для";
		$text['nobookmarks'] = "Нет закладок для использования";
		$text['bkmtitle'] = "Люди, обнаруженные в закладках";
		$text['bkminfo'] = "Выберите человека:";
		$text['sortpathsby'] = "Сортировка путей по количеству";
		$text['sortbyshort'] = "Сортировать по";
		$text['bylengthshort'] = "Длине";
		$text['badID1'] = ": плохой идентификатор person1 - пожалуйста, вернитесь назад и исправьте";
		$text['badID2'] = ": плохой идентификатор person2 - пожалуйста, вернитесь назад и исправьте";
		$text['notintree'] = ": человека с этим идентификатором нет в текущей базе данных древа.";
		$text['sameperson'] = "Эти два человека - один и тот же человек.";;
		$text['nopaths'] = "Эти люди не связаны между собой.";
		$text['nopaths1'] = "Больше никаких соединений короче xxx";
		$text['nopaths2'] = "в xxx шагах поиска";
		$text['longestpath'] = "(самый длинный проверенный путь был длиной в xxx шагов)";
		$text['relevantpaths'] = "Количество найденных различных соответствующих путей: xxx";
		$text['skipMarr'] = "(iкроме того, количество путей, найденных, но не отображенных из-за слишком большого количества браков, было: xxx)";
		$text['mjaor'] = "или";
		$text['connectionsto'] = "Соединения с ";
		$text['findanotherpers'] = "Найди другого человека...";
		$text['sometimes'] = "(Иногда проверка по другому количеству поколений дает другой результат.)";
		$text['anotherpath'] = "Поиск других связей";
		$text['xpath'] = "Путь ";
		$text['primary'] = "Начальный человек"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Конечный человек";
		$text['parent'] = "Родитель";
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
		$text['hfather'] = "отец";
		$text['hmother'] = "мать";
		$text['hhusband'] = "муж";
		$text['hwife'] = "жена";
		$text['hson'] = "сын";
		$text['hdaughter'] = "дочь";
		$text['maxruns'] = "Максимальное количество путей, подлежащих проверке";
		$text['maxrshort'] = "Максимальное количество путей";
		$text['maxlength'] = "Пути подключения не длиннее, чем";
		$text['maxlshort'] = "Максимальная длина";
		$text['xstep'] = "шаг";
		$text['xsteps'] = "шаги";
		$text['xmarriages'] = "xxx бракосочетаний";
		$text['xmarriage'] = "1 бракосочетание";
		$text['showspouses'] = "Показать обоих супругов";
		$text['showTxt'] = "Показать текстовое описание пути";
		$text['showTxtshort'] = "Текстовое описание.";
		$text['compactBox'] = "Отображить сжатые карточки людей";
		$text['compactBoxshort'] = "Компактные карточки";
		$text['paths'] = "Пути";
		$text['dospouses2'] = "Показать супругов";
		$text['maxmopt'] = "Максимальное количество браков на одну связь";
		$text['maxm'] = "Максимальное количество браков";
		$text['arerelated'] = "Эти люди являются родственниками - их отношения показаны на траектории 1";
		$text['simplerel'] = "Простой поиск отношений";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Семейная ведомость для";
		$text['ldsords'] = "Таинства СПД";
		$text['baptizedlds'] = "Крещеные (СПД)";
		$text['endowedlds'] = "Наделяемый (СПД)";
		$text['sealedplds'] = "Запечатано для родителей (СПД)";
		$text['sealedslds'] = "Запечатанное для супругом (СПД)";
		$text['otherspouse'] = "Другой супруг";
		$text['husband'] = "Отец";
		$text['wife'] = "Мама";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "Р.";
		$text['capaltbirthabbr'] = "Д. Р.";
		$text['capdeathabbr'] = "С.";
		$text['capburialabbr'] = "Пох.";
		$text['capplaceabbr'] = "М.";
		$text['capmarrabbr'] = "Ж.";
		$text['capspouseabbr'] = "С.";
		$text['redraw'] = "Перерисовать с";
		$text['unknownlit'] = "Неизвестный";
		$text['popupnote1'] = "Дополнительная информация";
		$text['pedcompact'] = "Компактный";
		$text['pedstandard'] = "Стандартный";
		$text['pedtextonly'] = "Текст";
		$text['descendfor'] = "Потомство для";
		$text['maxof'] = "Максимум";
		$text['gensatonce'] = "генерируемых одновременно.";
		$text['sonof'] = "сын";
		$text['daughterof'] = "дочь";
		$text['childof'] = "ребенок";
		$text['stdformat'] = "Стандартный формат";
		$text['ahnentafel'] = "Система &#171;Ahnentafel&#187;";
		$text['addnewfam'] = "Добавить новую семью";
		$text['editfam'] = "Изменить семью";
		$text['side'] = "Сторона";
		$text['familyof'] = "Семейство";
		$text['paternal'] = "отеческий";
		$text['maternal'] = "Материнский";
		$text['gen1'] = "Само";
		$text['gen2'] = "Родители";
		$text['gen3'] = "дедушка и бабушка";
		$text['gen4'] = "Прабабушка и прадедушка";
		$text['gen5'] = "2-й прародитель";
		$text['gen6'] = "3-й прародитель";
		$text['gen7'] = "4-й прародитель";
		$text['gen8'] = "5-й прародитель";
		$text['gen9'] = "6-й прародитель";
		$text['gen10'] = "7-й прародитель";
		$text['gen11'] = "8-й прародитель";
		$text['gen12'] = "9-й прародитель";
		$text['graphdesc'] = "Диаграмма происхождения к этому моменту";
		$text['pedbox'] = "Диаграмма &#171;Коробка&#187;";
		$text['regformat'] = "Реестр";
		$text['extrasexpl'] = "По крайней мере, одна фотография, история или другой медиафайл существует для этого человека.";
		$text['popupnote3'] = "Новая диаграмма";
		$text['mediaavail'] = "Доступные медиафайлы";
		$text['pedigreefor'] = "Диаграмма родословной для";
		$text['pedigreech'] = "Диаграмма родословной";
		$text['datesloc'] = "Даты и места";
		$text['borchr'] = "Рождение/крещение-смерть/погребение";
		$text['nobd'] = "Нет дат рождения или смерти";
		$text['bcdb'] = "Все данные о рождении/крещение/смерти/погребении";
		$text['numsys'] = "Система нумерации";
		$text['gennums'] = "Номера поколений";
		$text['henrynums'] = "Система Генри";
		$text['abovnums'] = "Система д'Абовилла";
		$text['devnums'] = "Система де Вильерса";
		$text['dispopts'] = "Показать варианты";
		//added in 10.0.0
		$text['no_ancestors'] = "Не найдено ни одного предка";
		$text['ancestor_chart'] = "Вертикальная диаграмма предков";
		$text['opennewwindow'] = "Открыть в новом окне";
		$text['pedvertical'] = "Вертикальный";
		//added in 11.0.0
		$text['familywith'] = "Семья с";
		$text['fcmlogin'] = "Пожалуйста, войдите, чтобы увидеть подробности";
		$text['isthe'] = "это";
		$text['otherspouses'] = "другие супруги";
		$text['parentfamily'] = "Родительское семейство";
		$text['showfamily'] = "Показать семью";
		$text['shown'] = "показанный";
		$text['showparentfamily'] = "показать родительскую семью";
		$text['showperson'] = "показать человека";
		//added in 11.0.2
		$text['otherfamilies'] = "Другие семьи";
		//added in 14.0
		$text['dtformat'] = "Таблицы";
		$text['dtchildren'] = "Дети";
		$text['dtgrandchildren'] = "Внучата";
		$text['dtggrandchildren'] = "Правнуки";
		$text['dtgggrandchildren'] = "Great grandchildren"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Нет потомков";
		$text['dtgen'] = "Пок";
		$text['dttotal'] = "Всего";
		$text['dtselect'] = "Выбрать";
		$text['dteachfulltable'] = "Каждая полная таблица будет иметь";
		$text['dtrows'] = "строк";
		$text['dtdisplayingtable'] = "Отобразить таблицу";
		$text['dtgototable'] = "Перейти к таблице:";
		$text['fcinstrdn'] = "Показать семью с супругом";
		$text['fcinstrup'] = "Показать семью с родителями";
		$text['fcinstrplus'] = "Выберать других супругов";
		$text['fcinstrfam'] = "Выберать других родителей";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Отчёты не существуют.";
		$text['reportname'] = "Название отчёта";
		$text['allreports'] = "Все отчёты";
		$text['report'] = "Отчёт";
		$text['error'] = "Ошибка";
		$text['reportsyntax'] = "Синтаксис запроса, выполняемого с этим отчётом";
		$text['wasincorrect'] = "неверный, и в результате отчёт не может быть запущен. Пожалуйста, обратитесь к системному администратору";
		$text['errormessage'] = "Сообщение об ошибке";
		$text['equals'] = "равняется";
		$text['endswith'] = "заканчивается на";
		$text['soundexof'] = "звучит (soundex) как";
		$text['metaphoneof'] = "звучит (metaphone) как";
		$text['plusminus10'] = "+/- 10 лет от";
		$text['lessthan'] = "меньше, чем";
		$text['greaterthan'] = "больше, чем";
		$text['lessthanequal'] = "меньше или равно, чем";
		$text['greaterthanequal'] = "больше или равно, чем";
		$text['equalto'] = "равно";
		$text['tryagain'] = "Попробуйте ещё раз";
		$text['joinwith'] = "Объединять используя";
		$text['cap_and'] = "И";
		$text['cap_or'] = "ИЛИ";
		$text['showspouse'] = "Показать супруга (покажет дубликаты, если человек имеет более одного супруга)";
		$text['submitquery'] = "Отправить запрос";
		$text['birthplace'] = "Место рождения";
		$text['deathplace'] = "Место смерти";
		$text['birthdatetr'] = "Дата рождения";
		$text['deathdatetr'] = "Дата смерти";
		$text['plusminus2'] = "+/- 2 года от";
		$text['resetall'] = "Сбросить все значения";
		$text['showdeath'] = "Показать информацию о смерти/похоронах";
		$text['altbirthplace'] = "Место крещения";
		$text['altbirthdatetr'] = "Дата крещения";
		$text['burialplace'] = "Место погребения";
		$text['burialdatetr'] = "Дата погребения";
		$text['event'] = "Событие(я)";
		$text['day'] = "День";
		$text['month'] = "Месяц";
		$text['keyword'] = "Ключевое слово (например, &#171;Abt (Около)&#187;, &#171;Bef (До)&#187;, &#171;Aft (После)&#187;)";
		$text['explain'] = "Введите компоненты даты, чтобы увидеть соответствующие события. Чтобы игнорировать поле, оставьте в нём пустое значение.";
		$text['enterdate'] = "Пожалуйста, введите или выберите хотя бы одно из следующих значений: &#171;День&#187;, &#171;Месяц&#187;, &#171;Год&#187;, &#171;Ключевое слово&#187;";
		$text['fullname'] = "Полное имя";
		$text['birthdate'] = "Дата рождения";
		$text['altbirthdate'] = "Дата крещения";
		$text['marrdate'] = "Дата брака";
		$text['spouseid'] = "ID Супруг(а)";
		$text['spousename'] = "Имя Супруг(а)";
		$text['deathdate'] = "Дата смерти";
		$text['burialdate'] = "Дата погребения";
		$text['changedate'] = "Дата последнего изменения";
		$text['gedcom'] = "Генеалогическое древо";
		$text['baptdate'] = "Дата Крещения (СПД)";
		$text['baptplace'] = "Место крещения (СПД)";
		$text['endldate'] = "Дата пожертвования (СПД)";
		$text['endlplace'] = "Место пожертвования (СПД)";
		$text['ssealdate'] = "Дата запечатывания S (СПД)";   //Sealed to spouse
		$text['ssealplace'] = "Место запечатывания S (СПД)";
		$text['psealdate'] = "Дата запечатывания P (СПД)";   //Sealed to parents
		$text['psealplace'] = "Место запечатывания P (СПД)";
		$text['marrplace'] = "Место брака";
		$text['spousesurname'] = "Фамилия супруга/супруги";
		$text['spousemore'] = "При вводе значения фамилии супруга необходимо выбрать пол.";
		$text['plusminus5'] = "+/- 5 лет от";
		$text['exists'] = "существует";
		$text['dnexist'] = "не существует";
		$text['divdate'] = "Дата развода";
		$text['divplace'] = "Место развода";
		$text['otherevents'] = "Другие критерии поиска";
		$text['numresults'] = "Результатов на странице";
		$text['mysphoto'] = "Неизвестные фотографии";
		$text['mysperson'] = "Неизвестные люди";
		$text['joinor'] = "Параметр &#171;Объединять используя ИЛИ&#187; не может использоваться с фамилией супруга";
		$text['tellus'] = "Расскажите нам, что вы знаете";
		$text['moreinfo'] = "Больше информации:";
		//added in 8.0.0
		$text['marrdatetr'] = "Год бракосочетания";
		$text['divdatetr'] = "Год развода";
		$text['mothername'] = "Имя матери";
		$text['fathername'] = "Имя отца";
		$text['filter'] = "Фильтр";
		$text['notliving'] = "Нет в живых";
		$text['nodayevents'] = "События за этот месяц, которые не связаны с конкретным днем:";
		//added in 9.0.0
		$text['csv'] = "Файл CSV с разделителями-запятыми";
		//added in 10.0.0
		$text['confdate'] = "Дата конфирмации (СПД)";
		$text['confplace'] = "Место конфирмации (СПД)";
		$text['initdate'] = "Дата посвящения (СПД)";
		$text['initplace'] = "Место посвящения (СПД)";
		//added in 11.0.0
		$text['marrtype'] = "Тип брака";
		$text['searchfor'] = "Поиск";
		$text['searchnote'] = "Примечание: эта страница использует Google, чтобы выполнять поиск. Количество возвращаемых совпадений будет напрямую зависеть от того, насколько Google сможет индексировать сайт.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Журнал записей для ";
		$text['mostrecentactions'] = "Последняя активность";
		$text['autorefresh'] = "Автообновление каждые (30 секунд)";
		$text['refreshoff'] = "Отключить автообновление";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Кладбища и надгробия";
		$text['showallhsr'] = "Показать полный список надгробий";
		$text['in'] = "в";
		$text['showmap'] = "Показать карту";
		$text['headstonefor'] = "Надгробие для";
		$text['photoof'] = "Фото";
		$text['photoowner'] = "Владелец оригинала";
		$text['nocemetery'] = "Нет кладбища";
		$text['iptc005'] = "Название";
		$text['iptc020'] = "Дополнительные категории";
		$text['iptc040'] = "Специальные инструкции";
		$text['iptc055'] = "Дата создания";
		$text['iptc080'] = "Автор";
		$text['iptc085'] = "Должность автора";
		$text['iptc090'] = "Город";
		$text['iptc095'] = "Штат/провинция";
		$text['iptc101'] = "Страна";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Заголовок";
		$text['iptc110'] = "Источник";
		$text['iptc115'] = "Источник фото";
		$text['iptc116'] = "Уведомление об авторских правах";
		$text['iptc120'] = "титр";
		$text['iptc122'] = "Подпись писателя";
		$text['mapof'] = "Карта";
		$text['regphotos'] = "Подробный вид";
		$text['gallery'] = "Только миниатюры";
		$text['cemphotos'] = "Фотографии кладбищ";
		$text['photosize'] = "Габаритные размеры";
        $text['iptc010'] = "Приоритет";
		$text['filesize'] = "Размер файла";
		$text['seeloc'] = "См. местоположение";
		$text['showall'] = "Показать все";
		$text['editmedia'] = "Редактировать медиафайл";
		$text['viewitem'] = "Просмотреть этот элемент";
		$text['editcem'] = "Редактировать кладбище";
		$text['numitems'] = "# Предметов";
		$text['allalbums'] = "Все альбомы";
		$text['slidestop'] = "Пауза Слайд-шоу";
		$text['slideresume'] = "Показ слайдов";
		$text['slidesecs'] = "Секунды для каждого слайда:";
		$text['minussecs'] = "минус 0,5 секунды";
		$text['plussecs'] = "плюс 0,5 секунды";
		$text['nocountry'] = "Неизвестная страна";
		$text['nostate'] = "Неизвестный штат";
		$text['nocounty'] = "Неизвестный район";
		$text['nocity'] = "Неизвестный город";
		$text['nocemname'] = "Неизвестное название кладбища";
		$text['editalbum'] = "Редактировать альбом";
		$text['mediamaptext'] = "<strong>Примечание:</strong> Переместите указатель мыши на изображение, чтобы отобразить имена. Нажмите, чтобы просмотреть страницу для каждого имени.";
		//added in 8.0.0
		$text['allburials'] = "Все погребения";
		$text['moreinfo'] = "Нажмите для получения дополнительной информации об этом изображении";
		//added in 9.0.0
        $text['iptc025'] = "Ключевые слова";
        $text['iptc092'] = "Суб-место";
		$text['iptc015'] = "Категория";
		$text['iptc065'] = "Исходная программа";
		$text['iptc070'] = "Версия программы";
		//added in 13.0
		$text['toggletags'] = "Переключить теги";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Показать фамилии на букву";
		$text['showtop'] = "Показать популярные";
		$text['showallsurnames'] = "Фамилии в виде списка";
		$text['sortedalpha'] = "в алфавитном порядке";
		$text['byoccurrence'] = "и упорядочить по дате происхождения";
		$text['firstchars'] = "Первые символы";
		$text['mainsurnamepage'] = "Фамилии в виде диаграммы";
		$text['allsurnames'] = "Все фамилии";
		$text['showmatchingsurnames'] = "Нажмите на фамилию, чтобы показать соответствующие записи.";
		$text['backtotop'] = "Наверх";
		$text['beginswith'] = "Начинается на";
		$text['allbeginningwith'] = "Все фамилии на букву";
		$text['numoccurrences'] = "общее количество мест (населенных пунктов) в скобках";
		$text['placesstarting'] = "Места на букву";
		$text['showmatchingplaces'] = "Нажмите на место, чтобы показать меньшие населенные пункты. Нажмите на значок поиска, чтобы показать соответствующих людей.";
		$text['totalnames'] = "из общего числа";
		$text['showallplaces'] = "Показать все места (населенные пункты)";
		$text['totalplaces'] = "из общего числа";
		$text['mainplacepage'] = "Главная страница мест (населенных пунктов)";
		$text['allplaces'] = "Все крупнейшие населенные пункты";
		$text['placescont'] = "Поиск мест (населенных пунктов)";
		//changed in 8.0.0
		$text['top30'] = "Популярные xxx фамилий";
		$text['top30places'] = "Популярные xxx мест";
		//added in 12.0.0
		$text['firstnamelist'] = "Имена";
		$text['firstnamesstarting'] = "Показать имена на букву";
		$text['showallfirstnames'] = "Имена в виде списка";
		$text['mainfirstnamepage'] = "Имена в виде диаграммы";
		$text['allfirstnames'] = "Все имена";
		$text['showmatchingfirstnames'] = "Нажмите на имя, чтобы отобразить соответствующие записи.";
		$text['allfirstbegwith'] = "Все имена на букву";
		$text['top30first'] = "Популярные xxx имён";
		$text['allothers'] = "Все остальные";
		$text['amongall'] = "(среди всех имен)";
		$text['justtop'] = "Просто ххх популярных";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(за последние xx дней)";

		$text['photo'] = "Фото";
		$text['history'] = "История/Документ";
		$text['husbid'] = "ID-отца";
		$text['husbname'] = "Имя отца";
		$text['wifeid'] = "ID-матери";
		//added in 11.0.0
		$text['wifename'] = "Имя матери";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Удалить";
		$text['addperson'] = "Добавить человека";
		$text['nobirth'] = "Этот человек не имеют действительную дату рождения и не может быть добавлен";
		$text['event'] = "Событие(я)";
		$text['chartwidth'] = "Ширина диаграммы";
		$text['timelineinstr'] = "Добавить людей";
		$text['togglelines'] = "Тумблер линии";
		//changed in 9.0.0
		$text['noliving'] = "Следующий человек помечен как живой или секретный и не может быть добавлен, потому что вы не вошли в систему с надлежащими разрешениями";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Просмотр всех деревьев";
		$text['treename'] = "Генеалогическое древо";
		$text['owner'] = "Владелец";
		$text['address'] = "Адрес";
		$text['city'] = "Город";
		$text['state'] = "Область";
		$text['zip'] = "Почтовый индекс";
		$text['country'] = "Страна";
		$text['email'] = "E-mail адрес";
		$text['phone'] = "Телефон";
		$text['username'] = "Логин";
		$text['password'] = "Пароль";
		$text['loginfailed'] = "Неправильный логин или пароль.";

		$text['regnewacct'] = "Создать новую учётную запись";
		$text['realname'] = "Настоящее имя";
		$text['phone'] = "Телефон";
		$text['email'] = "E-mail адрес";
		$text['address'] = "Адрес";
		$text['acctcomments'] = "Примечания или комментарии";
		$text['submit'] = "Отправить";
		$text['leaveblank'] = "(Оставьте пустым, если запрашивается новое генеалогическое древо)";
		$text['required'] = " Обязательные поля";
		$text['enterpassword'] = "Введите пароль.";
		$text['enterusername'] = "Введите логин.";
		$text['failure'] = "К сожалению введенное Вами имя пользователя уже используется. Пожалуйста, используйте кнопку Назад в вашем браузере, чтобы вернуться на предыдущую страницу и выберите другое имя пользователя.";
		$text['success'] = "Спасибо. Мы получили вашы данные для регистрации. Мы свяжемся с Вами, когда Ваш профиль будет активирован или потребуется дополнительная информация.";
		$text['emailsubject'] = "Новый пользователь TNG";
		$text['website'] = "Веб-сайт";
		$text['nologin'] = "Ещё не зарегистрированы?";
		$text['loginsent'] = "Информация для входа отправлена";
		$text['loginnotsent'] = "Информация для входа не отправлена";
		$text['enterrealname'] = "Введите Ваше настоящее имя.";
		$text['rempass'] = "Запомнить пароль на этом компьютере";
		$text['morestats'] = "Дополнительная статистика";
		$text['accmail'] = "<strong>Внимание:</strong> Для получения подтверждения регистрации от Администратора сайта, убедитесь что не блокируется адрес этого домена.";
		$text['newpassword'] = "Новый пароль";
		$text['resetpass'] = "Сбросить пароль";
		$text['nousers'] = "Эта форма не может быть использован до тех пор, по крайней мере, одна запись пользователя существует. Если вы являетесь владельцем сайта, пожалуйста, перейдите на администратора / пользователей для создания учетной записи администратора.";
		$text['noregs'] = "К сожалению, но мы не принимаем регистрацию новых пользователей в настоящее время. Пожалуйста <a href=\"suggest.php\">свяжитесь с администратором</a> напрямую, если у вас есть замечания или вопросы относительно чего-либо на этом сайте.";
		$text['emailmsg'] = "Вы получили новый запрос для учетной записи пользователя TNG. Пожалуйста, войдите в Вашу панель Администратора что бы задать соответствующие разрешения для этой новой учетной записи.";
		$text['accactive'] = "Учетная запись была активирована, но пользователь не будет иметь никаких особых прав, пока не назначать их.";
		$text['accinactive'] = "Зайдите в Администрирование/Пользователи/Обзор для доступа к настройкам учетной записи. Учётная запись будет оставаться неактивным, пока её не отредактировать и не сохранять  по крайней мере, один раз.";
		$text['pwdagain'] = "Пороль ещё раз";
		$text['enterpassword2'] = "Пожалуйста, введите пароль ещё раз.";
		$text['pwdsmatch'] = "Ваши пароли не совпадают. Введите один и тот же пароль в оба поля.";
		$text['acksubject'] = "Благодарим Вас за регистрацию"; //for a new user account
		$text['ackmessage'] = "Ваш запрос на регистрацию учётной записи получен. Ваша учетная запись будет неактивна, пока она не будет рассмотрена администратором сайта. Вы будете уведомлены по электронной почте, когда ваш логин будет готов к использованию.";
		//added in 12.0.0
		$text['switch'] = "Переключатель";
		//added in 14.0
		$text['newpassword2'] = "Снова новый пароль";
		$text['resetsuccess'] = "Успех: пароль был сброшен";
		$text['resetfail'] = "Ошибка: Пароль не сброшен";
		$text['failreason0'] = " (неизвестная ошибка базы данных)";
		$text['failreason2'] = " (у вас нет разрешения на изменение вашего пароля)";
		$text['failreason3'] = " (пароли не совпадали)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Просмотр всех ветвей";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Всего";
		$text['totindividuals'] = "Всего людей";
		$text['totmales'] = "Всего мужчин";
		$text['totfemales'] = "Всего женщин";
		$text['totunknown'] = "Всего с неизвестным полом";
		$text['totliving'] = "Всего живущих";
		$text['totfamilies'] = "Всего семей";
		$text['totuniquesn'] = "Всего уникальных фамилий";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Всего источников";
		$text['avglifespan'] = "Средняя продолжительность жизни";
		$text['earliestbirth'] = "Самая ранняя дата рождения";
		$text['longestlived'] = "Долгожители";
		$text['days'] = "дней";
		$text['age'] = "Возраст";
		$text['agedisclaimer'] = "Статистика продолжительности жизни расчитывается по записям о людях, с указанными датами рождения и смерти. Если информация не полная (например одна из дат указана не полностью, только год &#171;1945&#187; или только год и месяц без числа &#171;май 1755&#187;),  то точность расчётов не будет 100%-ой. Периоды &#171;с&#187;, &#171;до&#187;, &#171;после&#187;, &#171;приблизительно&#187;, &#171;между&#187; и т.п. в расчётах не участвуют.";
		$text['treedetail'] = "Иформация о древе";
		$text['total'] = "Всего";
		//added in 12.0
		$text['totdeceased'] = "Всего умерших";
		//added in 14.0
		$text['totalsourcecitations'] = "Общее количество ссылок на источники";
		break;

	case "notes":
		$text['browseallnotes'] = "Просмотр всех заметок";
		break;

	case "help":
		$text['menuhelp'] = "Кнопка меню";
		break;

	case "install":
		$text['perms'] = "Все разрешения были  установлены.";
		$text['noperms'] = "Права доступа не могут быть установлены ​​для этих файлов:";
		$text['manual'] = "Пожалуйста, установите их вручную.";
		$text['folder'] = "Папка";
		$text['created'] = "была создана";
		$text['nocreate'] = "не может быть создана. Пожалуйста, создайте её вручную.";
		$text['infosaved'] = "Информация сохранена, подключение проверено!";
		$text['tablescr'] = "Таблицы были созданы!";
		$text['notables'] = "Таблицы не могут быть созданы:";
		$text['nocomm'] = "TNG не не может соединиться с базой данных. Таблицы не были созданы.";
		$text['newdb'] = "Информация сохранена, подключение проверено, создана новая база данных:";
		$text['noattach'] = "Информация сохранена. Соединение установлено и базы данных создана, но TNG не может подключиться к ней.";
		$text['nodb'] = "Информация сохранена. Соединения установлено, но база данных не существует и не может быть создана. Пожалуйста, убедитесь, что имя базы данных правильное и есть права у пользователя базы данных, или зайдите в панель управления для её создания.";
		$text['noconn'] = "Информация сохранена, но соединение не установлено. Не выполнено одно или несколько из следующих условий:";
		$text['exists'] = "уже существует";
		$text['noop'] = "Операция не выполнялась.";
		//added in 8.0.0
		$text['nouser'] = "Пользователь не был создан. Возможно, имя пользователя уже существует.";
		$text['notree'] = "Генеалогическое древо не было создано. Номер генеалогического древа может уже существовать.";
		$text['infosaved2'] = "Информация сохранена";
		$text['renamedto'] = "переименовано в";
		$text['norename'] = "Не может быть переименовано";
		//changed in 13.0.0
		$text['loginfirst'] = "Обнаружены существующие записи пользователя. Для продолжения необходимо сначала войти в систему или удалить все записи из таблицы с пользователями.";
		break;

	case "imgviewer":
		$text['magmode'] = "Режим увеличения";
		$text['panmode'] = "Режим просмотра";
		$text['pan'] = "Нажмите и перетащите для перемещения по изображению";
		$text['fitwidth'] = "Вписать по ширине";
		$text['fitheight'] = "Вписать по высоте";
		$text['newwin'] = "Новое окно";
		$text['opennw'] = "Открыть изображение в новом окне";
		$text['magnifyreg'] = "Нажмите, чтобы увеличить область изображения";
		$text['imgctrls'] = "Включить элементы управления изображением";
		$text['vwrctrls'] = "Включить элементы управления просмотрщика изображений";
		$text['vwrclose'] = "Закрыть просмотрщик изображений";
		break;

	case "dna":
		$text['test_date'] = "Дата теста";
		$text['links'] = "Соответствующие ссылки";
		$text['testid'] = "ID теста";
		//added in 12.0.0
		$text['mode_values'] = "Значения режима";
		$text['compareselected'] = "Сравнить выбранные";
		$text['dnatestscompare'] = "Сравнить тесты Y-DNA";
		$text['keep_name_private'] = "Хранить приватно";
		$text['browsealltests'] = "Просмотр всех тестов";
		$text['all_dna_tests'] = "Все тесты ДНК";
		$text['fastmutating'] = "Быстрые & NBSP; мутации";
		$text['alltypes'] = "Все типы";
		$text['allgroups'] = "Все группы";
		$text['Ydna_LITbox_info'] = "Тест(ы), связанный с этим человеком, не обязательно проводились с этим человеком.<br />в столбце &#171;Гаплогруппа&#187; данные отображаются красным цветом, если результат &#171;Предсказан&#187;, и зелёным, если тест &#171;Подтверждён&#187;.";
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
$text['matches'] = "Совпадения";
$text['description'] = "Описание";
$text['notes'] = "Заметки";
$text['status'] = "Статус";
$text['newsearch'] = "Новый Поиск";
$text['pedigree'] = "Родословная";
$text['seephoto'] = "Посмотреть фото";
$text['andlocation'] = "и местоположение";
$text['accessedby'] = "Доступ из";
$text['children'] = "Дети";  //from getperson
$text['tree'] = "Генеалогическое древо";
$text['alltrees'] = "Все древеса";
$text['nosurname'] = "[без фамилии]";
$text['thumb'] = "Миниатюра";  //as in Thumbnail
$text['people'] = "Люди";
$text['title'] = "Название";  //from getperson
$text['suffix'] = "Суффикс";  //from getperson
$text['nickname'] = "Прозвище";  //from getperson
$text['lastmodified'] = "Последнее изменение";  //from getperson
$text['married'] = "Бракосочетание";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Имя"; //from showmap
$text['lastfirst'] = "Фамилия, Имя";  //from search
$text['bornchr'] = "Рождение/Крещение";  //from search
$text['individuals'] = "Люди";  //from whats new
$text['families'] = "Семьи";
$text['personid'] = "ID человека";
$text['sources'] = "Источники";  //from getperson (next several)
$text['unknown'] = "Неизвестно";
$text['father'] = "Отец";
$text['mother'] = "Мать";
$text['christened'] = "Крещение";
$text['died'] = "Смерть";
$text['buried'] = "Погребение";
$text['spouse'] = "Супруг(а)";  //from search
$text['parents'] = "Родители";  //from pedigree
$text['text'] = "Текст";  //from sources
$text['language'] = "Язык";  //from languages
$text['descendchart'] = "Диаграмма происхождения";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Информация о человеке";
$text['edit'] = "Редактировать";
$text['date'] = "Дата";
$text['login'] = "Войти";
$text['logout'] = "Выйти";
$text['groupsheet'] = "Семейная ведомость";
$text['text_and'] = "и";
$text['generation'] = "Поколение";
$text['filename'] = "Имя файла";
$text['id'] = "ID";
$text['search'] = "Поиск";
$text['user'] = "Пользователь";
$text['firstname'] = "Имя";
$text['lastname'] = "Фамилия";
$text['searchresults'] = "Результаты Поиска";
$text['diedburied'] = "Смерть/Погребение";
$text['homepage'] = "Главная";
$text['find'] = "Найти...";
$text['relationship'] = "Родство";		//in German, Verwandtschaft
$text['relationship2'] = "Отношение"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Хронология";
$text['yesabbr'] = "Y";               //abbreviation for 'yes'
$text['divorced'] = "Разведен(а)";
$text['indlinked'] = "Связано с";
$text['branch'] = "Ветвь";
$text['moreind'] = "Ещё люди";
$text['morefam'] = "Ещё семьи";
$text['surnamelist'] = "Список фамилий";
$text['generations'] = "Поколения";
$text['refresh'] = "Обновить";
$text['whatsnew'] = "Что нового";
$text['reports'] = "Отчёты";
$text['placelist'] = "Список мест";
$text['baptizedlds'] = "Крещение (СПД)";
$text['endowedlds'] = "Пожертвование (СПД)";
$text['sealedplds'] = "Запечатывание P (СПД)";
$text['sealedslds'] = "Запечатывание S (СПД)";
$text['ancestors'] = "Предки";
$text['descendants'] = "Потомки";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Дата последнего импорта GEDCOM";
$text['type'] = "Тип";
$text['savechanges'] = "Сохранить изменения";
$text['familyid'] = "ID семьи";
$text['headstone'] = "Надгробие";
$text['historiesdocs'] = "Истории";
$text['anonymous'] = "анонимно";
$text['places'] = "Места";
$text['anniversaries'] = "Даты и юбилеи";
$text['administration'] = "Администрирование";
$text['help'] = "Помощь";
//$text['documents'] = "Documents";
$text['year'] = "Год";
$text['all'] = "Все";
$text['address'] = "Адрес";
$text['suggest'] = "Замечания";
$text['editevent'] = "Предложить изменения для этого события";
$text['morelinks'] = "Другие ссылки";
$text['faminfo'] = "Семейная информация";
$text['persinfo'] = "Личная информация";
$text['srcinfo'] = "Источник информации";
$text['fact'] = "Факт";
$text['goto'] = "Выбери страницу";
$text['tngprint'] = "Печать";
$text['databasestatistics'] = "Статистика"; //needed to be shorter to fit on menu
$text['child'] = "ребёнок";  //from familygroup
$text['repoinfo'] = "Информация об архиве";
$text['tng_reset'] = "Сброс";
$text['noresults'] = "Результаты не найдены";
$text['allmedia'] = "Все медиафайлы";
$text['repositories'] = "Архивы";
$text['albums'] = "Альбомы";
$text['cemeteries'] = "Кладбища";
$text['surnames'] = "Фамилии";
$text['dates'] = "Даты";
$text['link'] = "Сноска";
$text['media'] = "Медиа";
$text['gender'] = "Пол";
$text['latitude'] = "Широта";
$text['longitude'] = "Долгота";
$text['bookmarks'] = "Закладки";
$text['bookmark'] = "Закладка";
$text['mngbookmarks'] = "Перейти к закладкам";
$text['bookmarked'] = "Закладка добавлена";
$text['remove'] = "Удалить";
$text['find_menu'] = "Найти";
$text['info'] = "Инфо"; //this needs to be a very short abbreviation
$text['cemetery'] = "Кладбище";
$text['gmapevent'] = "Карта событий";
$text['gevents'] = "Событие";
$text['googleearthlink'] = "Ссылка на Google Earth";
$text['googlemaplink'] = "Ссылка на Google Maps";
$text['gmaplegend'] = "Пин легенды";
$text['unmarked'] = "Неотмеченный";
$text['located'] = "Расположенный";
$text['albclicksee'] = "Нажмите, чтобы увидеть все элементы в этом альбоме";
$text['notyetlocated'] = "Пока не найдено";
$text['cremated'] = "Кремирован(а)";
$text['missing'] = "Пропал(а)";
$text['pdfgen'] = "Генератор PDF-файлов";
$text['blank'] = "Пустая диаграмма";
$text['fonts'] = "Шрифты";
$text['header'] = "Шапка";
$text['data'] = "Данные";
$text['pgsetup'] = "Параметры страницы";
$text['pgsize'] = "Размер страницы";
$text['orient'] = "Ориентация"; //for a page
$text['portrait'] = "Портрет";
$text['landscape'] = "Ландшафт";
$text['tmargin'] = "Верхнее Поле";
$text['bmargin'] = "Нижнее Поле";
$text['lmargin'] = "Левое Поле";
$text['rmargin'] = "Правое Поле";
$text['createch'] = "Создать PDF";
$text['prefix'] = "Префикс";
$text['mostwanted'] = "Розыск";
$text['latupdates'] = "Последние обновления";
$text['featphoto'] = "Избранные фото";
$text['news'] = "Новости";
$text['ourhist'] = "Наше семейная история";
$text['ourhistanc'] = "Наша семейная история и родословная";
$text['ourpages'] = "Страницы нашей семейной генеалогии";
$text['pwrdby'] = "Этот сайт работает на";
$text['writby'] = "Автор:";
$text['searchtngnet'] = "Поиск сети TNG (GENDEX)";
$text['viewphotos'] = "Посмотр всех фотографии";
$text['anon'] = "Вы в настоящее время анонимны";
$text['whichbranch'] = "Из какой ветви Вы?";
$text['featarts'] = "Избранные статьи";
$text['maintby'] = "Поддерживает";
$text['createdon'] = "Создан";
$text['reliability'] = "надёжность";
$text['labels'] = "Метки";
$text['inclsrcs'] = "Включить источники";
$text['cont'] = "(прод.)"; //abbreviation for continued
$text['mnuheader'] = "Главная страница";
$text['mnusearchfornames'] = "Поиск имён";
$text['mnulastname'] = "Фамилия";
$text['mnufirstname'] = "Имя, отчество";
$text['mnusearch'] = "Поиск";
$text['mnureset'] = "Начать всё сначала";
$text['mnulogon'] = "Вход";
$text['mnulogout'] = "Выход";
$text['mnufeatures'] = "Разделы сайта";
$text['mnuregister'] = "Зарегистрироваться";
$text['mnuadvancedsearch'] = "Расширенный поиск";
$text['mnulastnames'] = "Все фамилии";
$text['mnustatistics'] = "Статистика";
$text['mnuphotos'] = "Фотографии";
$text['mnuhistories'] = "Истории из жизни";
$text['mnumyancestors'] = "Фотографии и истории предков";
$text['mnucemeteries'] = "Кладбища";
$text['mnutombstones'] = "Надгробия";
$text['mnureports'] = "Отчёты";
$text['mnusources'] = "Источники";
$text['mnuwhatsnew'] = "Что нового";
$text['mnushowlog'] = "Последние действия";
$text['mnulanguage'] = "Изменить язык";
$text['mnuadmin'] = "Администрирование";
$text['welcome'] = "Добро пожаловать";
$text['contactus'] = "Обратная связь";
//changed in 8.0.0
$text['born'] = "Рождение";
$text['searchnames'] = "Поиск людей";
//added in 8.0.0
$text['editperson'] = "Изменить человека";
$text['loadmap'] = "Загрузить карту";
$text['birth'] = "Рождение";
$text['wasborn'] = "Родился";
$text['startnum'] = "Первый номер";
$text['searching'] = "Поиск";
//moved here in 8.0.0
$text['location'] = "Местоположение";
$text['association'] = "Взаимосвязь";
$text['collapse'] = "Свернуть";
$text['expand'] = "Развернуть";
$text['plot'] = "Участок";
$text['searchfams'] = "Поиск семей";
//added in 8.0.2
$text['wasmarried'] = "Женат (Замужем)";
$text['anddied'] = "Умер";
//added in 9.0.0
$text['share'] = "Поделиться";
$text['hide'] = "Спрятать";
$text['disabled'] = "Ваша учетная запись была отключена. Пожалуйста, обратитесь к администратору сайта для получения дополнительной информации.";
$text['contactus_long'] = "Если у вас возникли вопросы или замечания по поводу информации на этом сайте, пожалуйста, <span class=\"emphasis\"><a href=\"suggest.php\">свяжитесь с администратором</a></span>. ";
$text['features'] = "Разное";
$text['resources'] = "Ссылки";
$text['latestnews'] = "Последние новости";
$text['trees'] = "Древеса";
$text['wasburied'] = "был похоронен";
//moved here in 9.0.0
$text['emailagain'] = "Email повторно";
$text['enteremail2'] = "Введите свой адрес электронной почты ещё раз.";
$text['emailsmatch'] = "Ваши адреса не совпадают. Пожалуйста, введите тот же адрес в каждом поле.";
$text['getdirections'] = "Нажмите, чтобы проложить маршрут";
$text['calendar'] = "Календарь";
//changed in 9.0.0
$text['directionsto'] = " k ";
$text['slidestart'] = "Показ слайдов";
$text['livingnote'] = "По крайней мере, один живой человек связан с этой заметкой - детали скрыты.";
$text['livingphoto'] = "По крайней мере, один живой человек связан с этим предметом - детали скрыты.";
$text['waschristened'] = "Был крещён";
//added in 10.0.0
$text['branches'] = "Ветви";
$text['detail'] = "Детально";
$text['moredetail'] = "Больше деталей";
$text['lessdetail'] = "Меньше деталей";
$text['conflds'] = "Конфирмация (СПД)";
$text['initlds'] = "Посвящение (СПД)";
$text['wascremated'] = "кремировали";
//moved here in 11.0.0
$text['text_for'] = "для";
//added in 11.0.0
$text['searchsite'] = "Поиск по сайту";
$text['searchsitemenu'] = "Поиск";
$text['kmlfile'] = "Загрузите файл .kml, чтобы отобразить это местоположение в Google Планета Земля";
$text['download'] = "Нажмите, чтобы скачать";
$text['more'] = "Больше";
$text['heatmap'] = "Теплокарта";
$text['refreshmap'] = "Обновить карту";
$text['remnums'] = "Очистить номера и маркеры";
$text['photoshistories'] = "Фотографии и истории";
$text['familychart'] = "Семейная диаграмма";
//added in 12.0.0
$text['firstnames'] = "Имена";
//moved here in 12.0.0
$text['dna_test'] = "Тест ДНК";
$text['test_type'] = "Тип теста";
$text['test_info'] = "Информация о тесте";
$text['takenby'] = "Взято";
$text['haplogroup'] = "Гаплогруппа";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "Соответствующие ссылки";
$text['nofirstname'] = "[нет имени]";
//added in 12.0.1
$text['cookieuse'] = "Примечание: Этот сайт использует файлы cookie.";
$text['dataprotect'] = "Политика защиты данных";
$text['viewpolicy'] = "Просмотр политики";
$text['understand'] = "Я понимаю";
$text['consent'] = "Я даю свое согласие на хранение этим сайтом личной информации, собранной здесь. Я понимаю, что я могу попросить владельца сайта удалить эту информацию в любое время.";
$text['consentreq'] = "Пожалуйста, дайте свое согласие на хранение этим сайтом личной информации.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "Быстрые ссылки";
$text['yourname'] = "Ваше имя";
$text['youremail'] = "Ваш адрес электронной почты";
$text['liketoadd'] = "Любая информация, которую вы хотите добавить";
$text['webmastermsg'] = "Сообщение веб-мастера";
$text['gallery'] = "Просмотреть галерею";
$text['wasborn_male'] = "родился";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "родился"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "was christened";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "was christened";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "died";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "died";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "был похоронен"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "был похоронен"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "был кремирован";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "был кремирован";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "замужем";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "замужем";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "был разведен";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "был в разводе";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " in ";			// used as a preposition to the location
$text['onthisdate'] = " on ";		// when used with full date
$text['inthisyear'] = " in ";		// when used with year only or month / year dates
$text['and'] = "and ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "Данные теста ДНК";
//added in 13.0
$text['visitor'] = "Посетитель";

$text['popupnote2'] = "Новая родословная";

//moved here in 14.0
$text['zoomin'] = "Увеличить";
$text['zoomout'] = "Уменьшить";
$text['scrollnote'] = "Перетаскивайте и прокручивайте для просмотра всей диаграммы.";
$text['general'] = "Общее";

//changed in 14.0
$text['otherevents'] = "Другие события и атрибуты";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Связи";
$text['continue'] = "Продолжить";
$text['title2'] = "Наименование"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>