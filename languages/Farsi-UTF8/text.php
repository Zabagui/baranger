<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "مرور همه منابع";
		$text['shorttitle'] = "عنوان کوتاه";
		$text['callnum'] = "شماره تماس";
		$text['author'] = "نویسنده";
		$text['publisher'] = "ناشر";
		$text['other'] = "اطلاعات دیگر";
		$text['sourceid'] = "منشاء ID";
		$text['moresrc'] = "منابع بیشتر";
		$text['repoid'] = " مخزن ID";
		$text['browseallrepos'] = "مرور همه مخازن";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "زبان جدید";
		$text['changelanguage'] = "تغییر زبان";
		$text['languagesaved'] = "زبان ذخیره شده";
		$text['sitemaint'] = "تعمیر و نگهداری سایت در حال پیشرفت";
		$text['standby'] = "این سایت به طور موقت در دسترس نیست در حالی که ما دیتا بیس اپدیت می کنیم. لطفا چند دقیقه ی دیگر دوباره سعی کنید. اگر سایت برای مدت زمان طولانی خراب است ، لطفاً <a href=\"suggest.php\"> با صاحب سایت تماس بگیرید </a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM از شروع";
		$text['producegedfrom'] = "تولید یک فایل GEDCOM از";
		$text['numgens'] = "تعداد نسل ها";
		$text['includelds'] = "شامل اطلاعات LDS";
		$text['buildged'] = "GEDCOM را بسازید";
		$text['gedstartfrom'] = "GEDCOM شروع از";
		$text['nomaxgen'] = "شما باید حداکثر تعداد نسل ها را نشان دهید. لطفاً برای بازگشت به صفحه قبلی و اصلاح خطا از دکمه برگشت استفاده کنید";
		$text['gedcreatedfrom'] = "GEDCOM ایجاد شده از";
		$text['gedcreatedfor'] = "ایجاد شده برای";
		$text['creategedfor'] = "GEDCOM ایجاد کنید";
		$text['email'] = "ایمیل شما";
		$text['suggestchange'] = "پیشنهاد یک تغییر";
		$text['yourname'] = "اسم شما";
		$text['comments'] = "شرح <br /> تغییرات پیشنهادی";
		$text['comments2'] = "نظرات";
		$text['submitsugg'] = "ارسال پیشنهاد";
		$text['proposed'] = "پیشنهاد تغییر";
		$text['mailsent'] = "متشکرم. پیام شما ارسال شده است";
		$text['mailnotsent'] = "متأسفیم ، پیام شما تحویل داده نشد. لطفاً مستقیماً با xxx در سال تماس بگیرید.";
		$text['mailme'] = "نسخه ای را به این آدرس ارسال کنید";
		$text['entername'] = "لطفا نام خود را وارد کنید";
		$text['entercomments'] = "لطفا نظرات خود را وارد کنید";
		$text['sendmsg'] = "ارسال پیام";
		//added in 9.0.0
		$text['subject'] = "موضوع";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "عکس و تاریخ برای";
		$text['indinfofor'] = "اطلاعات فردی برای";
		$text['pp'] = "pp."; //page abbreviation
		$text['age'] = "سن";
		$text['agency'] = "آژانس";
		$text['cause'] = "علت";
		$text['suggested'] = "پیشنهاد شده";
		$text['closewindow'] = "این پنجره را ببند";
		$text['thanks'] = "متشکرم";
		$text['received'] = "پیشنهاد شما برای بررسی به مدیر سایت ارسال شد.";
		$text['indreport'] = "گزارش فردی";
		$text['indreportfor'] = "گزارش فردی برای";
		$text['bkmkvis'] = "<strong> توجه: </ strong> این نبوک مارک ها فقط در این رایانه و در این مرورگر قابل مشاهده هستند.";
        //added in 9.0.0
		$text['reviewmsg'] = "شما یک تغییر پیشنهادی دارید که نیاز به بررسی شما دارد. این ارسال شامل موارد زیر است:";
        $text['revsubject'] = "تغییر پیشنهادی به بررسی شما نیاز دارد";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "رابطه ماشین حساب";
		$text['findrel'] = "رابطه را پیدا کنید";
		$text['person1'] = "شخص 1:";
		$text['person2'] = "شخص 2:";
		$text['calculate'] = "محاسبه";
		$text['select2inds'] = "لطفاً دو نفر را انتخاب کنید.";
		$text['findpersonid'] = "شناسه شخص را پیدا کنید";
		$text['enternamepart'] = "بخشی از نام و / یا نام خانوادگی را وارد کنید";
		$text['pleasenamepart'] = "لطفاً بخشی از نام یا نام خانوادگی را وارد کنید.";
		$text['clicktoselect'] = "برای انتخاب کلیک کنید";
		$text['nobirthinfo'] = "اطلاعات تولد وجود ندارد";
		$text['relateto'] = "رابطه با";
		$text['sameperson'] = "این دو نفر یک نفر هستند.";
		$text['notrelated'] = "این دو فرد در نسل های xxx با هم رابطه ندارند."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "To display the relationship between two people, use the 'Find' buttons below to locate the individuals (or keep the people displayed), then click 'Calculate'.";
		$text['sometimes'] = "(گاهی اوقات بررسی تعداد متفاوتی از نسل ها نتیجه متفاوتی به دست می دهد.)";
		$text['findanother'] = "رابطه دیگری پیدا کنید";
		$text['brother'] = "برادر";
		$text['sister'] = "خواهر";
		$text['sibling'] = "خواهر و برادر";
		$text['uncle'] = "دایی xxx از";
		$text['aunt'] = "عمه xxx از";
		$text['uncleaunt'] = "عموی / عمه xxx";
		$text['nephew'] = "خواهرزاده xxx از";
		$text['niece'] = "خواهرزاده xxx از";
		$text['nephnc'] = "خواهرزاده / خواهرزاده xxx از";
		$text['removed'] = "بار حذف";
		$text['rhusband'] = "شوهر ";
		$text['rwife'] = "همسر ";
		$text['rspouse'] = "همسر ";
		$text['son'] = "پسر";
		$text['daughter'] = "دختر";
		$text['rchild'] = "فرزند";
		$text['sil'] = "داماد";
		$text['dil'] = "عروس";
		$text['sdil'] = "داماد یا عروس";
		$text['gson'] = "نوه xxx از";
		$text['gdau'] = "نوه xxx از";
		$text['gsondau'] = "نوه xxx از";
		$text['great'] = "بزرگ";
		$text['spouses'] = "همسر هستند";
		$text['is'] = "است";
		$text['changeto'] = "تغییر به (شناسه را وارد کنید):";
		$text['notvalid'] = "شمار شناسه این فرد معتبر نیست در پایگاه یا دیتا بیس وجود ندارد. لطفا دوباره تلاش کنید.";
		$text['halfbrother'] = "برادر ناتنی از";
		$text['halfsister'] = "خواهر ناتنی از";
		$text['halfsibling'] = "خواهر و برادر ناتنی";
		//changed in 8.0.0
		$text['gencheck'] = "حداکثر نسل ها برای بررسی";
		$text['mcousin'] = "پسر عموی،عمه،دایی،یا خاله xxx سال";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "دختر عموی،عمه،دایی،یا خاله xxx سال";  //female cousin
		$text['cousin'] = "عمه،عمو،خاله، یا دایی زاده xxx سال";
		$text['mhalfcousin'] = "پسر عموی،عمه،دایی،یا خاله ناتنی xxx سال";  //male cousin
		$text['fhalfcousin'] = "دختر عموی،عمه،دایی،یا خاله ناتنی xxx سال";  //female cousin
		$text['halfcousin'] = "دختر یا پسر عموی،عمه،دایی،یا خاله ناتنی xxx سال";
		//added in 8.0.0
		$text['oneremoved'] = "یک بار حذف";
		$text['gfath'] = "پدر بزرگ xxx از";
		$text['gmoth'] = "مادر بزرگ xxx از";
		$text['gpar'] = "اجداد xxx از";
		$text['mothof'] = "مادر";
		$text['fathof'] = "پدر";
		$text['parof'] = "والدین";
		$text['maxrels'] = "حداکثر روابط برای نشان دادن";
		$text['dospouses'] = "نمایش روابط مربوط به همسر";
		$text['rels'] = "رابطه";
		$text['dospouses2'] = "نمایش همسران";
		$text['fil'] = "پدر شوهر از";
		$text['mil'] = "مادر شوهر از";
		$text['fmil'] = "پدر یا مادر شوهر از";
		$text['stepson'] = "پسر خوانده از";
		$text['stepdau'] = "دختر ناتنی";
		$text['stepchild'] = "فرزند ناتنی از";
		$text['stepgson'] = "نوه پسر زاده ناتنی xxx از";
		$text['stepgdau'] = "نوهدختر زاده ناتنی xxx از";
		$text['stepgchild'] = "نوهد ناتنی xxx از";
		//added in 8.1.1
		$text['ggreat'] = "بزرگ";
		//added in 8.1.2
		$text['ggfath'] = "پدر پدر بزرگ xxx از";
		$text['ggmoth'] = "مادر مادربزرگ xxx از";
		$text['ggpar'] = "پدر پدربزرگ و مادر مادربزرگ xxx";
		$text['ggson'] = "پسرنوه بزرگ xxx";
		$text['ggdau'] = "دخترنوه بزرگ xxx";
		$text['ggsondau'] = "نوه بزرگ xxx";
		$text['gstepgson'] = "xxx پسر نوه بزرگ ناتنی از";
		$text['gstepgdau'] = "xxx دختر نوه بزرگ ناتنی از";
		$text['gstepgchild'] = "xxx  نوه بزرگ ناتنی از";
		$text['guncle'] = "xxx دایی یا عمو بزرگ از";
		$text['gaunt'] = "xxx عمه یا خاله بزرگ از";
		$text['guncleaunt'] = "xxx دایی، دایی بزرگ /خاله، عمه";
		$text['gnephew'] = "خواهر، برادر زاده بزرگ xxxxxx";
		$text['gniece'] = "خواهر، برادر زاده بزرگ xxx";
		$text['gnephnc'] = "برادرزاده / خواهرزاده بزرگ xxx";
		//added in 14.0
		$text['pathscalc'] = "جستجو برای اتصالات";
		$text['findrel2'] = "پیدا کردن روابط و سایر ارتباطات";
		$text['makeme2nd'] = "از شناسه من استفاده کن";
		$text['usebookmarks'] = "استفاده از نشانک ها";
		$text['select2inds'] = "لطفاً دو نفر را انتخاب کنید.";
		$text['indinfofor'] = "اطلاعات فردی برای";
		$text['nobookmarks'] = "هیچ نشانکی برای استفاده وجود";
		$text['bkmtitle'] = "افراد یافت شده در نشانک ها";
		$text['bkminfo'] = "انتخاب یک شخص:";
		$text['sortpathsby'] = "Sort paths by number of";
		$text['sortbyshort'] = "مرتب سازی بر اساس";
		$text['bylengthshort'] = "طول";
		$text['badID1'] = ": شخص بد 1 ID - لطفا برگردید و تصحیح کنید";
		$text['badID2'] = ": شخص بد 2 ID - لطفا برگردید و تصحیح کنید";
		$text['notintree'] = ": فرد دارای این شناسه در پایگاه داده درختی فعلی نیست.";
		$text['sameperson'] = "این دو نفر یک نفر هستند.";;
		$text['nopaths'] = "این افراد با هم ارتباط ندارند.";
		$text['nopaths1'] = "دیگر اتصال کوتاهتر از xxx وجود ندارد";
		$text['nopaths2'] = "در مراحل جستجوی xxx";
		$text['longestpath'] = "(طولانی ترین مسیر بررسی شده تا کنون xxx گام بوده است)";
		$text['relevantpaths'] = "تعداد مسیرهای مرتبط مختلف پیدا شد: xxx";
		$text['skipMarr'] = "(علاوه بر این، تعداد مسیرهایی که یافت شد اما به دلیل ازدواج های زیاد نمایش داده نشد: xxx)";
		$text['mjaor'] = "یا";
		$text['connectionsto'] = "اتصالات به";
		$text['findanotherpers'] = "یک نفر دیگر را پیدا کن...";
		$text['sometimes'] = "(گاهی اوقات بررسی تعداد متفاوتی از نسل ها نتیجه متفاوتی به دست می دهد.)";
		$text['anotherpath'] = "جستجو برای اتصالات دیگر";
		$text['xpath'] = "مسیر ";
		$text['primary'] = "شخص شروع کننده"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "فرد نهایی";
		$text['parent'] = "والدین";
		$text['mhfather'] = "پدر او";
		$text['mhmother'] = "مادرش";
		$text['mhhusband'] = "مادرش";
		$text['mhwife'] = "his wife";
		$text['mhson'] = "پسرش";
		$text['mhdaughter'] = "دخترش";
		$text['fhfather'] = "پدرش";
		$text['fhmother'] = "مادرش";
		$text['fhhusband'] = "شوهرش";
		$text['fhwife'] = "همسرش";
		$text['fhson'] = "پسرش";
		$text['fhdaughter'] = "دخترش";
		$text['hfather'] = "پدر";
		$text['hmother'] = "مادر";
		$text['hhusband'] = "شوهر";
		$text['hwife'] = "همسر";
		$text['hson'] = "فرزند پسر";
		$text['hdaughter'] = "فرزند دختر";
		$text['maxruns'] = "حداکثر تعداد مسیرهایی که باید بررسی شوند";
		$text['maxrshort'] = "مسیرهای حداکثر";
		$text['maxlength'] = "Connection paths no longer than";
		$text['maxlshort'] = "بیشترین طول";
		$text['xstep'] = "گام";
		$text['xsteps'] = "گام ها";
		$text['xmarriages'] = "ازدواج xxx";
		$text['xmarriage'] = "1 ازدواج";
		$text['showspouses'] = "هر دو همسر را نشان دهید";
		$text['showTxt'] = "نمایش توضیحات مسیر متنی";
		$text['showTxtshort'] = "توصیف متنی.";
		$text['compactBox'] = "نمایش جعبه های افراد فشرده";
		$text['compactBoxshort'] = "جعبه های فشرده";
		$text['paths'] = "راه ها";
		$text['dospouses2'] = "نمایش همسران";
		$text['maxmopt'] = "حداکثر ازدواج در هر اتصال";
		$text['maxm'] = "ازدواج حداکثر";
		$text['arerelated'] = "این افراد خویشاوند هستند - رابطه آنها در مسیر 1 نشان داده شده است.";
		$text['simplerel'] = "جستجوی ساده رابطه";
		break;

	case "familygroup":
		$text['familygroupfor'] = "برگه گروه خانواده برای";
		$text['ldsords'] = "احکام LDS";
		$text['baptizedlds'] = "غسل تعمید (LDS)";
		$text['endowedlds'] = "وقف (LDS)";
		$text['sealedplds'] = "مهر و موم شده برای والدین (LDS)";
		$text['sealedslds'] = "مهر و موم شده به همسر (LDS)";
		$text['otherspouse'] = "همسر دیگر";
		$text['husband'] = "پدر";
		$text['wife'] = "مادر";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "ب";
		$text['capaltbirthabbr'] = "آ";
		$text['capdeathabbr'] = "د";
		$text['capburialabbr'] = "ب";
		$text['capplaceabbr'] = "پ";
		$text['capmarrabbr'] = "م";
		$text['capspouseabbr'] = "SP";
		$text['redraw'] = "دوباره بکشید با ";
		$text['unknownlit'] = "نا معلوم";
		$text['popupnote1'] = "اطلاعات اضافی";
		$text['pedcompact'] = "فشرده";
		$text['pedstandard'] = "استاندارد";
		$text['pedtextonly'] = "متن";
		$text['descendfor'] = "تبار برای";
		$text['maxof'] = "حداکثر";
		$text['gensatonce'] = "نسل در یک زمان نمایش داده شود.";
		$text['sonof'] = "پسر از";
		$text['daughterof'] = "دختر از";
		$text['childof'] = "فرزند از";
		$text['stdformat'] = "فرمت استاندارد";
		$text['ahnentafel'] = "Ahnentafel";
		$text['addnewfam'] = "خانواده جدید اضافه کنید";
		$text['editfam'] = "ویرایش خانواده";
		$text['side'] = "سمت";
		$text['familyof'] = "خانواده از";
		$text['paternal'] = "پدرانه";
		$text['maternal'] = "مادرانه";
		$text['gen1'] = "خود";
		$text['gen2'] = "والدین";
		$text['gen3'] = "پدربزرگ و مادربزرگ";
		$text['gen4'] = "پدر پدربزرگ و مادر  مادربزرگ";
		$text['gen5'] = "پدر پدربزرگ و مادر  مادربزرگ دوم";
		$text['gen6'] = "پدر پدربزرگ و مادر  مادربزرگ سوم";
		$text['gen7'] = "پدر پدربزرگ و مادر  مادربزرگ چهارم";
		$text['gen8'] = "پدر پدربزرگ و مادر  مادربزرگ پنجم";
		$text['gen9'] = "پدر پدربزرگ و مادر  مادربزرگ ششم";
		$text['gen10'] = "پدر پدربزرگ و مادر  مادربزرگ هفتم";
		$text['gen11'] = "پدر پدربزرگ و مادر  مادربزرگ هشتم";
		$text['gen12'] = "پدر پدربزرگ و مادر  مادربزرگ نهم";
		$text['graphdesc'] = "نمودار جدول به این نقطه";
		$text['pedbox'] = "جعبه";
		$text['regformat'] = "ثبت نام";
		$text['extrasexpl'] = "= حداقل یک عکس ، سابقه یا مورد رسانه دیگر برای این فرد وجود دارد.";
		$text['popupnote3'] = "جدول جدید";
		$text['mediaavail'] = "رسانه موجود";
		$text['pedigreefor'] = "نمودار شجره نامه برای";
		$text['pedigreech'] = "نمودار شجره نامه";
		$text['datesloc'] = "تاریخ ها و مکان ها";
		$text['borchr'] = "تولد / Alt - مرگ / دفن";
		$text['nobd'] = "بدون تاریخ تولد یا مرگ";
		$text['bcdb'] = "تمام تولد ها/ Alt / مرگ / دفن";
		$text['numsys'] = "سیستم شماره گذاری";
		$text['gennums'] = "شماره های تولید";
		$text['henrynums'] = "اعداد هنری";
		$text['abovnums'] = "d اعداد Aboville";
		$text['devnums'] = "اعداد de Villiers";
		$text['dispopts'] = "گزینه های نمایش";
		//added in 10.0.0
		$text['no_ancestors'] = "هیچ اجدادی پیدا نشد";
		$text['ancestor_chart'] = "جدول اجداد عمودی";
		$text['opennewwindow'] = "پنجره جدیدی باز کنید";
		$text['pedvertical'] = "عمودی";
		//added in 11.0.0
		$text['familywith'] = "خانواده با";
		$text['fcmlogin'] = "لطفا برای دیدن جزئیات واردسیستم شوید";
		$text['isthe'] = "هست";
		$text['otherspouses'] = "همسران دیگر";
		$text['parentfamily'] = "The parent family ";
		$text['showfamily'] = "نمایش خانواده";
		$text['shown'] = "نشان داده شده";
		$text['showparentfamily'] = "خانواده والدین را نشان دهید";
		$text['showperson'] = "نشان دادن شخص";
		//added in 11.0.2
		$text['otherfamilies'] = "خانواده های دیگر";
		//added in 14.0
		$text['dtformat'] = "جدول";
		$text['dtchildren'] = "فرزندان";
		$text['dtgrandchildren'] = "نوه ها";
		$text['dtggrandchildren'] = "نوه های بزرگ";
		$text['dtgggrandchildren'] = "نوه های بزرگ"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "بدون نسل";
		$text['dtgen'] = "نسل ها";
		$text['dttotal'] = "جمع";
		$text['dtselect'] = "انتخاب کنید";
		$text['dteachfulltable'] = "هر جدول کامل خواهد داشت";
		$text['dtrows'] = "ردیف ها";
		$text['dtdisplayingtable'] = "جدول نمایش";
		$text['dtgototable'] = "برو سر میز:";
		$text['fcinstrdn'] = "نشان دادن خانواده با همسر";
		$text['fcinstrup'] = "نمایش خانواده با پدر و مادر";
		$text['fcinstrplus'] = "انتخاب همسران دیگر";
		$text['fcinstrfam'] = "انتخاب والدین دیگر";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "هیچ گزارشی وجود ندارد";
		$text['reportname'] = "گزارش نام";
		$text['allreports'] = "همه گزارش ها";
		$text['report'] = "گزارش";
		$text['error'] = "خطا";
		$text['reportsyntax'] = "نحو پرس و جو با این گزارش اجرا می شود";
		$text['wasincorrect'] = "غلط دار بود ، و در نتیجه گزارش نمی تواند اجرا شود. لطفا با مدیر سیستم در تماس بگیرید";
		$text['errormessage'] = "پیغام خطا";
		$text['equals'] = "برابر";
		$text['endswith'] = "به پایان می رسد با";
		$text['soundexof'] = "soundex از";
		$text['metaphoneof'] = "تلفن متافون از";
		$text['plusminus10'] = "+/- 10 سال از";
		$text['lessthan'] = "کمتر از";
		$text['greaterthan'] = "بزرگتر از";
		$text['lessthanequal'] = "کمتر یا مساوی با";
		$text['greaterthanequal'] = "بزرگتر یا مساوی با";
		$text['equalto'] = "مساوی با";
		$text['tryagain'] = "لطفا دوباره تلاش کنید";
		$text['joinwith'] = "عضویت با";
		$text['cap_and'] = "و";
		$text['cap_or'] = "یا";
		$text['showspouse'] = "نشان دادن همسر (در صورت داشتن بیش از یک همسر موارد تکراری را نشان می دهد)";
		$text['submitquery'] = "ارسال پرس و جو";
		$text['birthplace'] = "محل تولد";
		$text['deathplace'] = "محل مرگ";
		$text['birthdatetr'] = "سال تولد";
		$text['deathdatetr'] = "سال مرگ";
		$text['plusminus2'] = "+/- 2 سال از";
		$text['resetall'] = "تنظیم مجدد همه ارزشها";
		$text['showdeath'] = "اطلاعات مرگ / دفن را نشان دهید";
		$text['altbirthplace'] = "مکان غسل تعمید";
		$text['altbirthdatetr'] = "سال غسل تعمید";
		$text['burialplace'] = "محل دفن";
		$text['burialdatetr'] = "سال دفن";
		$text['event'] = "رویداد";
		$text['day'] = "روز";
		$text['month'] = "ماه";
		$text['keyword'] = "Keyword (ie, \"Abt\")";
		$text['explain'] = "برای دیدن حوادث تطبیق، اجزاء های تاریخ را وارد کنید. برای دیدن مسابقات برای همه یک قسمت را خالی بگذارید.";
		$text['enterdate'] = "لطفاً حداقل یکی از موارد زیر را انتخاب کنید: روز ، ماه ، سال ، کلمه کلیدی";
		$text['fullname'] = "نام و نام خانوادگی";
		$text['birthdate'] = "تاریخ تولد";
		$text['altbirthdate'] = "تاریخ غسل تعمید";
		$text['marrdate'] = "تاریخ ازدواج";
		$text['spouseid'] = "ID همسر";
		$text['spousename'] = "نام همسر";
		$text['deathdate'] = "تاریخ مرگ";
		$text['burialdate'] = "تاریخ دفن";
		$text['changedate'] = "آخرین تاریخ اصلاح شده";
		$text['gedcom'] = "درخت";
		$text['baptdate'] = "تاریخ غسل تعمید (LDS)";
		$text['baptplace'] = "محل غسل تعمید (LDS)";
		$text['endldate'] = "تاریخ وقف (LDS)";
		$text['endlplace'] = "محل وقف (LDS)";
		$text['ssealdate'] = "تاریخ مهر S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = " مهر مکان S (LDS)";
		$text['psealdate'] = "تاریخ مهر P (LDS)";   //Sealed to parents
		$text['psealplace'] = "مهرمکان P (LDS)";
		$text['marrplace'] = "محل ازدواج";
		$text['spousesurname'] = "نام خانوادگی همسر";
		$text['spousemore'] = "اگر برای نام خانوادگی همسر مقداری وارد کنید ، باید جنسیت را انتخاب کنید.";
		$text['plusminus5'] = "+/- 5 سال از";
		$text['exists'] = "وجود دارد";
		$text['dnexist'] = "وجود ندارد";
		$text['divdate'] = "تاریخ طلاق";
		$text['divplace'] = "محل طلاق";
		$text['otherevents'] = "سایر معیارهای جستجو";
		$text['numresults'] = "نتایج در هر صفحه";
		$text['mysphoto'] = "عکس های رمز و راز";
		$text['mysperson'] = "افراد گریزان";
		$text['joinor'] = "پیوستن با یا گزینه با نام خانوادگی همسر قابل استفاده نیست";
		$text['tellus'] = "آنچه می دانید به ما بگویید";
		$text['moreinfo'] = "اطلاعات بیشتر:";
		//added in 8.0.0
		$text['marrdatetr'] = "سال ازدواج";
		$text['divdatetr'] = "سال طلاق";
		$text['mothername'] = "نام مادر";
		$text['fathername'] = "نام پدر";
		$text['filter'] = "فیلتر";
		$text['notliving'] = "زندگی نمی کنند";
		$text['nodayevents'] = "رویدادهای این ماه که با روز خاصی همراه نیستند:";
		//added in 9.0.0
		$text['csv'] = "پرونده  اCSV با کاما محدود شده ";
		//added in 10.0.0
		$text['confdate'] = "تاریخ تأیید (LDS)";
		$text['confplace'] = "محل تأیید (LDS)";
		$text['initdate'] = "تاریخ مقدماتی (LDS)";
		$text['initplace'] = "مکان آمقدماتی (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "نوع ازدواج";
		$text['searchfor'] = "جستجو برای";
		$text['searchnote'] = "توجه: این صفحه از Google برای انجام جستجوی خود استفاده می کند. تعداد موارد برگشتی مستقیماً تحت تأثیر میزان Google قادر به فهرسترسانی سایت خواهد بود.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "ثبت پرونده برای";
		$text['mostrecentactions'] = "آخرین اقدامات";
		$text['autorefresh'] = "تازه کردن خودکار (30 ثانیه)";
		$text['refreshoff'] = "بازخوانی خودکار را خاموش کنید";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "قبرستان ها و سنگ قبرها";
		$text['showallhsr'] = "نمایش تمام سوابق سنگ قبر";
		$text['in'] = "in";
		$text['showmap'] = "نمایش نقشه";
		$text['headstonefor'] = "سنگ قبر برای";
		$text['photoof'] = "عکس از";
		$text['photoowner'] = "مالک / منبع";
		$text['nocemetery'] = "بدون قبرستان";
		$text['iptc005'] = "عنوان";
		$text['iptc020'] = "عرضه دسته بندی ها";
		$text['iptc040'] = "دستورالعمل های ویژه";
		$text['iptc055'] = "تاریخ ایجاد";
		$text['iptc080'] = "نویسنده";
		$text['iptc085'] = "موقعیت نویسنده";
		$text['iptc090'] = "شهر";
		$text['iptc095'] = "استان / استان";
		$text['iptc101'] = "کشور";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "تیتر";
		$text['iptc110'] = "منبع";
		$text['iptc115'] = "منبع عکس";
		$text['iptc116'] = "کپی رایت";
		$text['iptc120'] = "زیرنویس";
		$text['iptc122'] = "زیرنویس";
		$text['mapof'] = "نقشه از";
		$text['regphotos'] = "نمای توصیفی";
		$text['gallery'] = "فقط تصاویر کوچک";
		$text['cemphotos'] = "عکس های قبرستان";
		$text['photosize'] = "ابعاد";
        $text['iptc010'] = "اولویت";
		$text['filesize'] = "حجم فایل";
		$text['seeloc'] = "دیدن مکان";
		$text['showall'] = "نمایش همه";
		$text['editmedia'] = "ویرایش رسانه";
		$text['viewitem'] = "مشاهده این مورد";
		$text['editcem'] = "ویرایشگورستان";
		$text['numitems'] = "# اقلام";
		$text['allalbums'] = "همه آلبوم ها";
		$text['slidestop'] = "مکث نمایش اسلاید";
		$text['slideresume'] = "نمایش اسلاید را از سر بگیرید";
		$text['slidesecs'] = "ثانیه برای هر اسلاید:";
		$text['minussecs'] = "منهای 0.5 ثانیه";
		$text['plussecs'] = "به علاوه 0.5 ثانیه";
		$text['nocountry'] = "کشور نامشخص";
		$text['nostate'] = "ایالت نامشخص";
		$text['nocounty'] = "بخش نامشخص";
		$text['nocity'] = "شهر نامشخص";
		$text['nocemname'] = "نام گورستان ناشناخته";
		$text['editalbum'] = "ویرایش آلبوم";
		$text['mediamaptext'] = "<strong> توجه: </ strong> نشانگر ماوس خود را بر روی تصویر قرار دهید تا نام ها نشان داده شود. برای دیدن صفحه هر نام کلیک کنید.";
		//added in 8.0.0
		$text['allburials'] = "همه دفن ها";
		$text['moreinfo'] = "برای اطلاعات بیشتر روی این تصویر کلیک کنید";
		//added in 9.0.0
        $text['iptc025'] = "کلمات کلیدی";
        $text['iptc092'] = "محل فرعی";
		$text['iptc015'] = "دسته بندی";
		$text['iptc065'] = "برنامه اصلی";
		$text['iptc070'] = "نسخه برنامه";
		//added in 13.0
		$text['toggletags'] = "Toggle Tags";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "نشان دادن نام خانوادگی شروع با";
		$text['showtop'] = "نمایش بالا";
		$text['showallsurnames'] = "نمایش تمام نام خانوادگی ها";
		$text['sortedalpha'] = "مرتب بر اساس حروف الفبا";
		$text['byoccurrence'] = "اتفاقی سفارش شده";
		$text['firstchars'] = "شخصیت های اول";
		$text['mainsurnamepage'] = "صفحه اصلی نام خانوادگی";
		$text['allsurnames'] = "نام خانوادگی همه";
		$text['showmatchingsurnames'] = "برای نمایش سوابق منطبق بر روی نام خانوادگی کلیک کنید.";
		$text['backtotop'] = "بازگشت به بالا";
		$text['beginswith'] = "شروع با";
		$text['allbeginningwith'] = "همه نهمه نام خانوادگی ها شروع با";
		$text['numoccurrences'] = "تعداد کل مکانهای داخل پرانتز";
		$text['placesstarting'] = "شروع نمایش بزرگترین مکان ها  با";
		$text['showmatchingplaces'] = "برای نمایش مکانهای کوچکتر ، روی مکانی کلیک کنید. برای نشان دادن افراد منطبق بر روی نماد جستجو کلیک کنید.";
		$text['totalnames'] = "کل افراد";
		$text['showallplaces'] = "نمایش همه بزرگترین مکان ها";
		$text['totalplaces'] = "کل مکان ها";
		$text['mainplacepage'] = "صفحه اصلی مکانهای";
		$text['allplaces'] = "بزرگترین مکانها";
		$text['placescont'] = "نمایش همه مکانهای حاوی";
		//changed in 8.0.0
		$text['top30'] = "نام های خانوادگی برتر xxx";
		$text['top30places'] = "بزرگترین مکانهای ";
		//added in 12.0.0
		$text['firstnamelist'] = "لیست نام";
		$text['firstnamesstarting'] = "نمایش نام های اولیه شروع با ";
		$text['showallfirstnames'] = "نمایش همه نام اول";
		$text['mainfirstnamepage'] = "نام صفحه اصلی";
		$text['allfirstnames'] = "همه نام ها";
		$text['showmatchingfirstnames'] = "برای نمایش سوابق منطبق بر روی یک نام کلیک کنید.";
		$text['allfirstbegwith'] = "همه نام های اولیه شروع با";
		$text['top30first'] = "نام های xxx برتر";
		$text['allothers'] = "همه دیگران";
		$text['amongall'] = "(در میان همه اسامی)";
		$text['justtop'] = "فقط xxx بالا";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(xx روز گذشته)";

		$text['photo'] = "عکس";
		$text['history'] = "تاریخچه / سند";
		$text['husbid'] = "پدر ID";
		$text['husbname'] = "نام پدر";
		$text['wifeid'] = "مادر ID";
		//added in 11.0.0
		$text['wifename'] = "نام مادر";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "حذف";
		$text['addperson'] = "افزودن شخص";
		$text['nobirth'] = "فرد زیر تاریخ تولد معتبری ندارد و نمی تواند اضافه شود";
		$text['event'] = "مناسبت (ها)";
		$text['chartwidth'] = "عرض جدول";
		$text['timelineinstr'] = "اضافه کردن مردم";
		$text['togglelines'] = "تعویض خطوط";
		//changed in 9.0.0
		$text['noliving'] = "فرد زیر به عنوان زنده یا خصوصی پرچم گذاری می شود و نمی تواند اضافه شود زیرا شما با مجوزهای مناسب وارد سیستم نشده اید";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "مرور تمام درختان";
		$text['treename'] = "نام درخت";
		$text['owner'] = "مالک";
		$text['address'] = "آدرس";
		$text['city'] = "شهر";
		$text['state'] = "استان / ولایت";
		$text['zip'] = "کد پستی / پستی";
		$text['country'] = "کشور";
		$text['email'] = "ایمیل";
		$text['phone'] = "تلفن";
		$text['username'] = "نام کاربری";
		$text['password'] = "رمز عبور";
		$text['loginfailed'] = "ورود ناموفق بود";

		$text['regnewacct'] = "ثبت نام برای کاربری جدید";
		$text['realname'] = "نام واقعی شما";
		$text['phone'] = "تلفن";
		$text['email'] = "ایمیل";
		$text['address'] = "آدرس";
		$text['acctcomments'] = "یادداشت ها یا نظرات";
		$text['submit'] = "ارسال";
		$text['leaveblank'] = "(برای درخت جدید جای خالی بگذارید)";
		$text['required'] = "فیلدهای مورد نیاز";
		$text['enterpassword'] = "لطفا رمز عبور وارد کنید";
		$text['enterusername'] = "لطفا نام کاربری وارد کنید.";
		$text['failure'] = "متأسفیم ، اما نام کاربری که وارد کرده اید از قبل استفاده می شود. لطفاً برای بازگشت به صفحه قبلی و انتخاب نام کاربری دیگری از دکمه بازگشت در مرورگر خود استفاده کنید.";
		$text['success'] = "متشکرم. ما ثبت نام شما را دریافت کرده ایم. هنگامی که حساب شما فعال است یا در صورت نیاز به اطلاعات بیشتر با شما تماس خواهیم گرفت.";
		$text['emailsubject'] = "درخواست ثبت نام کاربر TNG جدید";
		$text['website'] = "وب سایت";
		$text['nologin'] = "ورود به سیستم ندارید؟";
		$text['loginsent'] = "اطلاعات ورود به سیستم ارسال شد";
		$text['loginnotsent'] = "اطلاعات ورود به سیستم ارسال نشده است";
		$text['enterrealname'] = "لطفا نام واقعی خود را وارد کنید";
		$text['rempass'] = "در رایانه لاگین بمانید";
		$text['morestats'] = "آمار بیشتر";
		$text['accmail'] = "<strong> توجه: </ strong> برای دریافت نامه از مدیر سایت در مورد حساب خود ، لطفاً مطمئن شوید که نامه را از این دامنه مسدود نمی کنید.";
		$text['newpassword'] = "رمز ورود جدید";
		$text['resetpass'] = "تنظیم مجدد کلمه ورود";
		$text['nousers'] = "این فرم را نمی توان استفاده کرد تا حداقل یک رکورد کاربر وجود داشته باشد. اگر شما مالک سایت هستید ، لطفاً برای ایجاد حساب سرپرست خود به Admin / Users بروید.";
		$text['noregs'] = "متأسفیم ، اما در حال حاضر ثبت نام کاربر جدید را قبول نمی کنیم. اگر درباره هر چیزی در این سایت نظر یا س orالی دارید ، مستقیماً <a href=\"suggest.php\"> با ما تماس بگیرید </a>";
		$text['emailmsg'] = "درخواست جدیدی برای حساب کاربری TNG دریافت کرده اید. لطفاً به قسمت TNG Admin خود وارد شوید و مجوزهای مناسب را به این حساب جدید اختصاص دهید.";
		$text['accactive'] = "حساب فعال شده است ، اما کاربر تا زمانی که این حساب را اختصاص ندهید از حقوق خاصی برخوردار نیست.";
		$text['accinactive'] = "برای دسترسی به تنظیمات حساب به مدیر / کاربران / بررسی بروید. حساب حداقل غیرفعال خواهد ماند تا حداقل یک بار سابقه را ویرایش و ذخیره کنید.";
		$text['pwdagain'] = "رمز عبور دوباره";
		$text['enterpassword2'] = "لطفا دوباره رمز خود را وارد کنید";
		$text['pwdsmatch'] = "رمز ورود شما منطبق نمی باشند. لطفاً رمز ورود یکسان را در هر قسمت وارد کنید.";
		$text['acksubject'] = "با تشکر از شما برای ثبت نام"; //for a new user account
		$text['ackmessage'] = "درخواست شما برای حساب کاربری دریافت شده است. حساب شما غیرفعال خواهد بود تا زمانی که توسط سرپرست سایت بررسی شود. هنگام ورود به سیستم برای استفاده از طریق ایمیل به شما اطلاع داده می شود.";
		//added in 12.0.0
		$text['switch'] = "تعویض";
		//added in 14.0
		$text['newpassword2'] = "دوباره رمز عبور جدید";
		$text['resetsuccess'] = "موفقیت: رمز عبور بازنشانی شد";
		$text['resetfail'] = "شکست: رمز عبور بازنشانی نشد";
		$text['failreason0'] = "(خطای پایگاه داده ناشناخته)";
		$text['failreason2'] = "(شما اجازه تغییر رمز عبور خود را ندارید)";
		$text['failreason3'] = "(رمزهای عبور مطابقت نداشتند)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "مرور تمام شاخها";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "تعداد";
		$text['totindividuals'] = "مجموع افراد";
		$text['totmales'] = "مجموع مردان";
		$text['totfemales'] = "مجموع زنان";
		$text['totunknown'] = "مجموع جنسیت نامعلوم";
		$text['totliving'] = "مجموع زندگی";
		$text['totfamilies'] = "مجموع خانواده";
		$text['totuniquesn'] = "مجموع منحصر به فرد نام خانوادگی";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "مجموع منابع";
		$text['avglifespan'] = "طول عمر متوسط";
		$text['earliestbirth'] = "اولین تولد";
		$text['longestlived'] = "طولانی ترین زندگی";
		$text['days'] = "روزها";
		$text['age'] = "سن";
		$text['agedisclaimer'] = "Age-related calculations are based on individuals with recorded birth <em>and</em> death dates.  Due to the existence of incomplete date fields(e.g., a death date listed only as \"1945\" or \"BEF 1860\"), these calculations cannot be 100% accurate.";
		$text['treedetail'] = "اطلاعات بیشتر در مورد این درخت";
		$text['total'] = "جمع";
		//added in 12.0
		$text['totdeceased'] = "مجموع درگذشتگان";
		//added in 14.0
		$text['totalsourcecitations'] = "(رمزهای عبور مطابقت نداشتند)";
		break;

	case "notes":
		$text['browseallnotes'] = "مرور همه یادداشت ها";
		break;

	case "help":
		$text['menuhelp'] = "کلید منو";
		break;

	case "install":
		$text['perms'] = "مجوزها همه تعیین شده است.";
		$text['noperms'] = "مجوزها برای این پرونده ها قابل تنظیم نیست:";
		$text['manual'] = "لطفاً آنها را به صورت دستی تنظیم کنید.";
		$text['folder'] = "پوشه";
		$text['created'] = "ایجاد شده است";
		$text['nocreate'] = "ایجاد نشد لطفاً آن را به صورت دستی ایجاد کنید.";
		$text['infosaved'] = "اطلاعات ذخیره شده، ارتباط تأیید شده!";
		$text['tablescr'] = "جداول ایجاد شده اند!";
		$text['notables'] = "جداول زیر ایجاد نمی شوند:";
		$text['nocomm'] = "TNG با پایگاه داده شما ارتباط برقرار نمی کند. هیچ جدولی ایجاد نشده است";
		$text['newdb'] = "اطلاعات ذخیره شده، ارتباط تأیید شده، پایگاه داده جدید ایجاد شده:";
		$text['noattach'] = "اطلاعات ذخیره شد اتصال ایجاد شد و پایگاه داده ایجاد شد ، اما TNG نمی تواند به آن متصل شود.";
		$text['nodb'] = "محاسبات مربوط به سن براساس افرادی است که تاریخ تولد <em> و </ em> ثبت شده را ثبت کرده اند. به دلیل وجود فیلدهای تاریخ ناقص (به عنوان مثال ، یک تاریخ مرگ که فقط به عنوان 1945  یا  BEF 1860 ذکر شده است) ، این محاسبات نمی توانند 100٪ دقیق باشند.";
		$text['noconn'] = "اطلاعات ذخیره شد اما اتصال قطع شد. یک یا چند مورد زیر نادرست است:";
		$text['exists'] = "درحال حاضر وجود دارد.";
		$text['noop'] = "هیچ عملی انجام نشده است.";
		//added in 8.0.0
		$text['nouser'] = "کاربر ایجاد نشد نام کاربری ممکن است از قبل وجود داشته باشد.";
		$text['notree'] = "درخت ایجاد نشده است. درخت ID حال حاضر ممکن است وجود داشته باشد.";
		$text['infosaved2'] = "اطلاعات ذخیره شده";
		$text['renamedto'] = "تغییر نام داد به";
		$text['norename'] = "نمی توان تغییر نام داد";
		//changed in 13.0.0
		$text['loginfirst'] = " شما اول باید وارد شوید.";
		break;

	case "imgviewer":
		$text['magmode'] = "حالت بزرگنمایی";
		$text['panmode'] = "حالت پان";
		$text['pan'] = "برای جابجایی در تصویر کلیک کنید و بکشید";
		$text['fitwidth'] = "عرض متناسب";
		$text['fitheight'] = "قد مناسب";
		$text['newwin'] = "صفحه جدید";
		$text['opennw'] = "باز کردن تصویر در یک صفه جدید";
		$text['magnifyreg'] = "برای بزرگنمایی یک منطقه از تصویر کلیک کنید";
		$text['imgctrls'] = "فعال کردن کنترل های تصویر";
		$text['vwrctrls'] = "کنترلهای مشاهدهگر تصویر را فعال کنید";
		$text['vwrclose'] = "بستن نمایشگر تصویر";
		break;

	case "dna":
		$text['test_date'] = "تاریخ تست";
		$text['links'] = "لینک های مرتبط";
		$text['testid'] = "تست ID";
		//added in 12.0.0
		$text['mode_values'] = "ارزش حالت";
		$text['compareselected'] = "مقایسه انتخاب";
		$text['dnatestscompare'] = "مقایسه تست Y-DNA";
		$text['keep_name_private'] = "نام را خصوصی نگه دارید";
		$text['browsealltests'] = "مرور تمام آزمون";
		$text['all_dna_tests'] = "تمام آزمایشات DNA";
		$text['fastmutating'] = "Fast&nbsp;Mutating";
		$text['alltypes'] = "همه انواع";
		$text['allgroups'] = "همه گروه ها";
		$text['Ydna_LITbox_info'] = "آزمون (های) مرتبط با این شخص لزوماً توسط این شخص انجام نشده است. <br /> ستون Haplogroup داده ها را با قرمز نشان می دهد اگر نتیجه پیش بینی شده  یا سبز باشد اگر آزمایش باشد (تأیید شده)";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "آزمایش های انتخاب شده mtDNA را مقایسه کنید";
		$text['dnatestscompare_atdna'] = "تست های انتخاب شده در DNA را مقایسه کنید";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNPs";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "مراجعه";
		$text['extra_mutations'] = "جهش فوق العاده";
		$text['mrca'] = "پیشینی MRC";
		$text['ydna_test'] = "آزمایش Y-DNA";
		$text['mtdna_test'] = "آزمایشات mtDNA (میتوکندری)";
		$text['atdna_test'] = "تست های atDNA (اتوزومال)";
		$text['segment_start'] = "شروع";
		$text['segment_end'] = "پایان";
		$text['suggested_relationship'] = "پیشنهاد کرد";
		$text['actual_relationship'] = "واقعی";
		$text['12markers'] = "نشانگرهای 1-12";
		$text['25markers'] = "نشانگرهای 25-25";
		$text['37markers'] = "نشانگرهای 26-37";
		$text['67markers'] = "نشانگرهای 38-67";
		$text['111markers'] = "نشانگرهای 68-111";
		//added in 13.1
		$text['comparemore'] = "At least two tests must be selected to compare.";
		break;
}

//common
$text['matches'] = "تطابق";
$text['description'] = "شرح";
$text['notes'] = "یادداشت ها";
$text['status'] = "وضعیت";
$text['newsearch'] = "جستجوی جدید";
$text['pedigree'] = "نژاد";
$text['seephoto'] = "عکس را ببینید";
$text['andlocation'] = "&amp; محل";
$text['accessedby'] = "قابل دسترسی توسط";
$text['children'] = "فرزندان";  //from getperson
$text['tree'] = "درخت";
$text['alltrees'] = "همه درختان";
$text['nosurname'] = "[بدون نام خانوادگی]";
$text['thumb'] = "کوچک";  //as in Thumbnail
$text['people'] = "مردم";
$text['title'] = "عنوان";  //from getperson
$text['suffix'] = "پسوند";  //from getperson
$text['nickname'] = "نام مستعار";  //from getperson
$text['lastmodified'] = "آخرین اصلاح";  //from getperson
$text['married'] = "متاهل";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "نام"; //from showmap
$text['lastfirst'] = "نام خانوادگی ، نامگذاری شده";  //from search
$text['bornchr'] = "متولد / مسیح";  //from search
$text['individuals'] = "افراد";  //from whats new
$text['families'] = "خانواده ها";
$text['personid'] = "ID فرد";
$text['sources'] = "منابع";  //from getperson (next several)
$text['unknown'] = "نا معلوم";
$text['father'] = "پدر";
$text['mother'] = "مادر";
$text['christened'] = "تعمید";
$text['died'] = "درگذشت";
$text['buried'] = "دفن شده";
$text['spouse'] = "همسر";  //from search
$text['parents'] = "والدین";  //from pedigree
$text['text'] = "پیامک";  //from sources
$text['language'] = "زبان";  //from languages
$text['descendchart'] = "تبار";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "فرد";
$text['edit'] = "ویرایش";
$text['date'] = "تاریخ";
$text['login'] = "ورود به سایت";
$text['logout'] = "خروج از سیستم";
$text['groupsheet'] = "ورق گروه";
$text['text_and'] = "و";
$text['generation'] = "نسل";
$text['filename'] = "نام پرونده";
$text['id'] = "ID";
$text['search'] = "جستجو";
$text['user'] = "کاربر";
$text['firstname'] = "نام کوچک";
$text['lastname'] = "نام خانوادگی";
$text['searchresults'] = "نتایج جستجو";
$text['diedburied'] = "درگذشت / دفن شد";
$text['homepage'] = "خانه";
$text['find'] = "Find...";
$text['relationship'] = "رابطه";		//in German, Verwandtschaft
$text['relationship2'] = "رابطه"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "خط زمانی";
$text['yesabbr'] = "بله";               //abbreviation for 'yes'
$text['divorced'] = "طلاق";
$text['indlinked'] = "مربوط به";
$text['branch'] = "شاخه";
$text['moreind'] = "افراد بیشتر";
$text['morefam'] = "خانواده بیشتر";
$text['surnamelist'] = "فهرست نام خانوادگی";
$text['generations'] = "نسل ها";
$text['refresh'] = "تازه";
$text['whatsnew'] = "چه خبر";
$text['reports'] = "گزارش ها";
$text['placelist'] = "فهرست مکان";
$text['baptizedlds'] = "غسل تعمید (LDS)";
$text['endowedlds'] = "وقف (LDS)";
$text['sealedplds'] = "مهر و موم شده P (LDS)";
$text['sealedslds'] = "مهر و موم شده S (LDS)";
$text['ancestors'] = "اجداد";
$text['descendants'] = "فرزندان";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "تاریخ آخرین واردات GEDCOM";
$text['type'] = "تایپ";
$text['savechanges'] = "ذخیره تغییرات";
$text['familyid'] = "ID خانواده";
$text['headstone'] = "سنگ قبرها";
$text['historiesdocs'] = "تاریخ ها";
$text['anonymous'] = "بی نام";
$text['places'] = "مکانها";
$text['anniversaries'] = "تاریخ و سالگرد";
$text['administration'] = "مدیریت";
$text['help'] = "راهنما";
//$text['documents'] = "Documents";
$text['year'] = "سال";
$text['all'] = "همه";
$text['address'] = "آدرس";
$text['suggest'] = "پیشنهاد";
$text['editevent'] = "پیشنهاد یک تغییر برای این رویداد";
$text['morelinks'] = "لینک های بیشتر";
$text['faminfo'] = "اطلاعات خانواده";
$text['persinfo'] = "اطلاعات شخصی";
$text['srcinfo'] = "منبع اطلاعات";
$text['fact'] = "حقیقت";
$text['goto'] = "یک صفحه انتخاب کنید";
$text['tngprint'] = "چاپ";
$text['databasestatistics'] = "آمار"; //needed to be shorter to fit on menu
$text['child'] = "کودک";  //from familygroup
$text['repoinfo'] = "اطلاعات مخزن";
$text['tng_reset'] = "تنظیم مجدد";
$text['noresults'] = "نتیجه ای پیدا نشد";
$text['allmedia'] = "همه رسانه ها";
$text['repositories'] = "مخازن";
$text['albums'] = "آلبوم ها";
$text['cemeteries'] = "قبرستانها";
$text['surnames'] = "نام خانوادگی";
$text['dates'] = "تاریخ";
$text['link'] = "پیوند";
$text['media'] = "رسانه";
$text['gender'] = "جنسیت";
$text['latitude'] = "عرض جغرافیایی";
$text['longitude'] = "طول جغرافیایی";
$text['bookmarks'] = "بوک مارک ها";
$text['bookmark'] = "بوک مارک";
$text['mngbookmarks'] = "برو به بوک مارک ها";
$text['bookmarked'] = " بوک مارک اضافه شد";
$text['remove'] = "حذف";
$text['find_menu'] = "یافتن";
$text['info'] = "اطلاعات"; //this needs to be a very short abbreviation
$text['cemetery'] = "قبرستان";
$text['gmapevent'] = "نقشه رویداد";
$text['gevents'] = "واقعه";
$text['googleearthlink'] = "پیوند به Google Earth";
$text['googlemaplink'] = "پیوند به Google Maps";
$text['gmaplegend'] = "Pin Legend";
$text['unmarked'] = "بدون علامت";
$text['located'] = "واقع شده";
$text['albclicksee'] = "برای دیدن همه موارد در این آلبوم کلیک کنید";
$text['notyetlocated'] = "هنوز پیدا نشده است";
$text['cremated'] = "سوزانده";
$text['missing'] = "گم";
$text['pdfgen'] = "تولید کننده PDF";
$text['blank'] = "جدول خالی";
$text['fonts'] = "فونت";
$text['header'] = "سرتیتر";
$text['data'] = "اطلاعات";
$text['pgsetup'] = "تنظیمات صفحه";
$text['pgsize'] = "اندازه صفحه";
$text['orient'] = "جهت"; //for a page
$text['portrait'] = "تصویر";
$text['landscape'] = "Landscape";
$text['tmargin'] = "حاشیه بالا";
$text['bmargin'] = "حاشیه پایین";
$text['lmargin'] = "حاشیه چپ";
$text['rmargin'] = "حاشیه راست";
$text['createch'] = "جدول ایجاد کنید";
$text['prefix'] = "پیشوند";
$text['mostwanted'] = "پرطرفدار";
$text['latupdates'] = "آخرین روز رسانی ها";
$text['featphoto'] = "عکس ویژه";
$text['news'] = "اخبار";
$text['ourhist'] = "تاریخچه خانواده ما";
$text['ourhistanc'] = "تاریخچه خانوادگی و اجداد ما";
$text['ourpages'] = "صفحات شجره نامه خانواده ما";
$text['pwrdby'] = "این سایت طراحی شده توسط";
$text['writby'] = "نوشته شده توسط";
$text['searchtngnet'] = "جستجوی شبکه TNG (GENDEX)";
$text['viewphotos'] = "مشاهده همه عکس ها";
$text['anon'] = "شما در حال حاضر ناشناس هستید";
$text['whichbranch'] = "از کدام شاخه هستید؟";
$text['featarts'] = "مقالات ویژه";
$text['maintby'] = "نگهداری توسط";
$text['createdon'] = "ایجاد در";
$text['reliability'] = "قابلیت اعتماد";
$text['labels'] = "اتیکت";
$text['inclsrcs'] = "شامل منابع";
$text['cont'] = "(ادامه)"; //abbreviation for continued
$text['mnuheader'] = "صفحه اصلی";
$text['mnusearchfornames'] = "جستجو";
$text['mnulastname'] = "نام خانوادگی";
$text['mnufirstname'] = "نام کوچک";
$text['mnusearch'] = "جستجو";
$text['mnureset'] = "دوباره شروع کنید";
$text['mnulogon'] = "ورود به سیستم";
$text['mnulogout'] = "خروج از سیستم";
$text['mnufeatures'] = "ویژگی های دیگر";
$text['mnuregister'] = "ثبت نام برای یک حساب کاربری";
$text['mnuadvancedsearch'] = "جستجوی پیشرفته";
$text['mnulastnames'] = "نام خانوادگی";
$text['mnustatistics'] = "آمار";
$text['mnuphotos'] = "عکسها";
$text['mnuhistories'] = "تاریخ ها";
$text['mnumyancestors'] = "عکس ها&amp; تاریخچه برای نیاکان [شخص]";
$text['mnucemeteries'] = "قبرستان";
$text['mnutombstones'] = "سنگ قبرها";
$text['mnureports'] = "گزارش ها";
$text['mnusources'] = "منابع";
$text['mnuwhatsnew'] = "چه خبر";
$text['mnushowlog'] = "دسترسی ورود";
$text['mnulanguage'] = "تغییر زبان";
$text['mnuadmin'] = "مدیریت";
$text['welcome'] = "خوش آمدی";
$text['contactus'] = "تماس با ما";
//changed in 8.0.0
$text['born'] = "متولد";
$text['searchnames'] = "جستجو افراد";
//added in 8.0.0
$text['editperson'] = "ویرایش شخص";
$text['loadmap'] = "نقشه را بارگیری کنید";
$text['birth'] = "تولد";
$text['wasborn'] = "متولد شد";
$text['startnum'] = "شماره اول";
$text['searching'] = "جستجوکردن";
//moved here in 8.0.0
$text['location'] = "محل";
$text['association'] = "اتحادیه";
$text['collapse'] = "منقبض";
$text['expand'] = "گسترش";
$text['plot'] = "طرح";
$text['searchfams'] = "جستجو خانواده ها";
//added in 8.0.2
$text['wasmarried'] = "متاهل";
$text['anddied'] = "فوت کرد";
//added in 9.0.0
$text['share'] = "مشترک";
$text['hide'] = "پنهان";
$text['disabled'] = "حساب کاربری شما غیرفعال شده است. لطفا برای اطلاعات بیشتر با مدیر سایت تماس بگیرید.";
$text['contactus_long'] = "If you have any questions or comments about the information on this site, please <span class=\"emphasis\"><a href=\"suggest.php\">contact us</a></span>. We look forward to hearing from you.";
$text['features'] = "ویژگی های";
$text['resources'] = "منابع";
$text['latestnews'] = "آخرین اخبار";
$text['trees'] = "درختان";
$text['wasburied'] = "دفن";
//moved here in 9.0.0
$text['emailagain'] = "دوباره ایمیل";
$text['enteremail2'] = "لطفاً آدرس ایمیل خود را دوباره وارد کنید";
$text['emailsmatch'] = "ایمیل های شما مطابقت ندارد. لطفاً آدرس ایمیل را در هر قسمت وارد کنید.";
$text['getdirections'] = "برای دریافت راهنمایی کلیک کنید";
$text['calendar'] = "تقویم";
//changed in 9.0.0
$text['directionsto'] = " to ";
$text['slidestart'] = "نمایش اسلاید";
$text['livingnote'] = "حداقل یک فرد زنده یا خصوصی با این یادداشت مرتبط شده است - جزئیات را تأیید کرد.";
$text['livingphoto'] = "حداقل یک فرد زنده یا خصوصی با این مورد مرتبط شده است - جزئیات را نمی توان پنهان کرد.";
$text['waschristened'] = "تعمید داده شد";
//added in 10.0.0
$text['branches'] = "شاخه ها";
$text['detail'] = "جزئیات";
$text['moredetail'] = "جزئیات بیشتر";
$text['lessdetail'] = "جزئیات کمتر";
$text['conflds'] = "تأیید شده (LDS)";
$text['initlds'] = "مقدماتی (LDS)";
$text['wascremated'] = "سوزانده شد";
//moved here in 11.0.0
$text['text_for'] = "برای";
//added in 11.0.0
$text['searchsite'] = "در این سایت جستجو کنید";
$text['searchsitemenu'] = "جستجو در سایت";
$text['kmlfile'] = "برای نمایش این مکان در Google Earth ، یک فایل .kml بارگیری کنید";
$text['download'] = "برای دانلود کلیک کنید";
$text['more'] = "بیشتر";
$text['heatmap'] = "نقشه حرارتی";
$text['refreshmap'] = "تازه کردن نقشه";
$text['remnums'] = "اعداد و پین ها را پاک کنید";
$text['photoshistories'] = "عکسها &amp; تاریخ ها";
$text['familychart'] = "جدول خانواده";
//added in 12.0.0
$text['firstnames'] = "نامهای اول";
//moved here in 12.0.0
$text['dna_test'] = "آزمایش DNA";
$text['test_type'] = "نوع تست";
$text['test_info'] = "اطلاعات آزمون";
$text['takenby'] = "گرفته شده توسط";
$text['haplogroup'] = "هاپلاگروپ";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "لینک های مرتبط";
$text['nofirstname'] = "[بدون نام]";
//added in 12.0.1
$text['cookieuse'] = "توجه: این سایت از کوکی استفاده می کند.";
$text['dataprotect'] = "سیاست حفاظت از داده ها";
$text['viewpolicy'] = "مشاهده خط مشی";
$text['understand'] = "متوجه هستم";
$text['consent'] = "من رضایت می دهم که این سایت اطلاعات شخصی جمع آوری شده را در این سایت ذخیره کند. می دانم که ممکن است از مالک سایت بخواهم هر زمان بخواهد این اطلاعات را حذف کند.";
$text['consentreq'] = "لطفاً برای ذخیره اطلاعات شخصی رضایت خود را برای این سایت اعلام کنید.";

//added in 12.1.0
$text['testsarelinked'] = "آزمایش DNA ارتباط دارد با";
$text['testislinked'] = "آزمایش DNA همراه است با ";

//added in 12.2
$text['quicklinks'] = "لینک های سریع";
$text['yourname'] = "اسم شما";
$text['youremail'] = "آدرس ایمیل شما";
$text['liketoadd'] = "هر اطلاعاتی که می خواهید اضافه کنید";
$text['webmastermsg'] = "پیام مدیر وب";
$text['gallery'] = "مشاهده گالری";
$text['wasborn_male'] = "متولد شد";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "متولد شد"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "تعمید شد";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "تعمید شد";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "درگذشت";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "درگذشت";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "دفن شد"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "دفن شد"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "سوزانده شد";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "سوزانده شد";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "متاهل";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "متاهل";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "طلاق گرفته بود";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "طلاق گرفته بود";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " در ";			// used as a preposition to the location
$text['onthisdate'] = " بر ";		// when used with full date
$text['inthisyear'] = " در ";		// when used with year only or month / year dates
$text['and'] = "and ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "اطلاعات آزمایش DNA";
//added in 13.0
$text['visitor'] = "Visitor";

$text['popupnote2'] = "شجره نامه جدید";

//moved here in 14.0
$text['zoomin'] = "بزرگنمایی";
$text['zoomout'] = "کوچک نمایی";
$text['scrollnote'] = "یادداشت ها: برای دیدن نمودار ممکن است مجبور شوید به پایین یا راست بروید.";
$text['general'] = "عمومی";

//changed in 14.0
$text['otherevents'] = "سایر رویدادها و ویژگی ها";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "اتصالات";
$text['continue'] = "ادامه هید";
$text['title2'] = "عنوان"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>