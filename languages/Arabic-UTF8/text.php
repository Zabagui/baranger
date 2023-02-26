<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "تصفح كافة المصادر";
		$text['shorttitle'] = "العنوان القصير";
		$text['callnum'] = "رقم الاستدعاء";
		$text['author'] = "المؤلف";
		$text['publisher'] = "المؤلف";
		$text['other'] = "معلومات أخرى";
		$text['sourceid'] = "ترميز المصدر";
		$text['moresrc'] = "مصادر أخرى";
		$text['repoid'] = "ترميز المستودع";
		$text['browseallrepos'] = "تصفح كافة المستودعات";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "لغة جديدة";
		$text['changelanguage'] = "تغيير اللغة";
		$text['languagesaved'] = "تم تخزين اللغة";
		$text['sitemaint'] = "الموقع تحت الصيانة";
		$text['standby'] = " الموقع غير متوفر مؤقتا بينما نقوم بتحديث قاعدة البيانات. يرجى المحاولة مرة أخرى في بضع دقائق. إذا استمر الموقع خارج الخدمة لفترة مطولة، يرجى <a href=\"suggest.php\"> الاتصال </A> بمدير الموقع.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "ملف جيدكوم يبدأ من";
		$text['producegedfrom'] = "إنشاء ملف جيدكوم من";
		$text['numgens'] = "عدد الأجيال";
		$text['includelds'] = "شمول بيانات نصارى LDS";
		$text['buildged'] = "إنشاء جيدكوم";
		$text['gedstartfrom'] = "ملف جيدكوم يبدأ من";
		$text['nomaxgen'] = "يجب تحديد عدد الأجيال. الرجاء استخدام زر الرجوع للعودة إلى الصفحة السابقة لتصحيح الخطأ";
		$text['gedcreatedfrom'] = "تم إنشاء ملف جيدكوم من";
		$text['gedcreatedfor'] = "تم الإنشاء لصالح";
		$text['creategedfor'] = "إنشاء ملف جيدكوم";
		$text['email'] = "بريدك الإلكتروني";
		$text['suggestchange'] = "اقترح تغييرات";
		$text['yourname'] = "اسمك";
		$text['comments'] = " وصف <br /> التغييرات المقترحة";
		$text['comments2'] = "تعليقات";
		$text['submitsugg'] = "ارسال المقترحات";
		$text['proposed'] = "التغيير المقترح";
		$text['mailsent'] = "شكرا. تم إرسال رسالتك";
		$text['mailnotsent'] = "نأسف لتعذر تسليم رسالتكم. يرجي التواصل مع xxx مباشرة على yyy";
		$text['mailme'] = "ارسال نسخة إلى هذا العنوان";
		$text['entername'] = "فضلا أدخل اسمك";
		$text['entercomments'] = "فضلا أدخل ملاحظاتك";
		$text['sendmsg'] = "أرسل رسالة";
		//added in 9.0.0
		$text['subject'] = "الموضوع";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "صور وتواريخ تخص";
		$text['indinfofor'] = "معلومات أفراد تخص";
		$text['pp'] = "صفحة"; //page abbreviation
		$text['age'] = "عمر";
		$text['agency'] = "وكالة";
		$text['cause'] = "السبب";
		$text['suggested'] = "مقترح";
		$text['closewindow'] = "أغلق هذه النافذة";
		$text['thanks'] = "شكرا";
		$text['received'] = "تمت إحالة مقترحك إلى مدير الموقع للمراجعة";
		$text['indreport'] = "تقرير أفراد";
		$text['indreportfor'] = "تقرير أفراد يخص";
		$text['bkmkvis'] = "<strong> ملاحظة: </ قوي> هذه العلامات مرئية فقط على هذا الحاسب، وفي هذا المتصفح.";
        //added in 9.0.0
		$text['reviewmsg'] = " لديك تغيير مقترح بحاجة إلى مراجعة. هذا التغيير يخص:";
        $text['revsubject'] = "التغيير المقترح بحاجة إلى مراجعتك";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "حاسب العلاقات";
		$text['findrel'] = "البحث عن علاقة";
		$text['person1'] = "الفرد 1:";
		$text['person2'] = "الفرد 2:";
		$text['calculate'] = "حساب";
		$text['select2inds'] = "فضلا اختر فردين";
		$text['findpersonid'] = "البحث عن ترميز فرد";
		$text['enternamepart'] = "أدخل جزءا من الاسم الأول أو الأخير.";
		$text['pleasenamepart'] = "فضلا أدخل جزءا من اسم أول أو أخير.";
		$text['clicktoselect'] = "انقر لتختار";
		$text['nobirthinfo'] = "غياب معلومات الولادة";
		$text['relateto'] = "علاقة مع";
		$text['sameperson'] = " الفردان يمثلان نفس الشخص.";
		$text['notrelated'] = "لا توجد علاقة بين الفردين على مسافة xxx جيل"; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "لعرض العلاقة بين فردين، استخدم أزرار البحث أدناه لإيجادهما (أو اكتفي بالمعروضين)، ثم انقر على حساب.";
		$text['sometimes'] = "(أحيانا البحث عبر عدد مختلف من الأجيال يتيح نتائج مختلفة.)";
		$text['findanother'] = "البحث عن علاقة أخرى";
		$text['brother'] = "أخو لـ";
		$text['sister'] = "أخت لـ";
		$text['sibling'] = "طفل لـ";
		$text['uncle'] = "العم أو الخال رقم xxx لـ";
		$text['aunt'] = "العمة أو الخالة رقم xxx لـ";
		$text['uncleaunt'] = "خال أو خالة أو عم أو عمة رقم xxx لـ";
		$text['nephew'] = "ابن عم أو خال رقم xxx لـ";
		$text['niece'] = "ابنة عم أو خال رقم xxx لـ";
		$text['nephnc'] = "ابن أو ابنة عم أو خال رقم xxx لـ";
		$text['removed'] = "أجيال عنه";
		$text['rhusband'] = "زوج لـ ";
		$text['rwife'] = "زوجة لـ ";
		$text['rspouse'] = "زوج لـ ";
		$text['son'] = "ابن لـ";
		$text['daughter'] = "ابنة لـ";
		$text['rchild'] = "طفل لـ";
		$text['sil'] = "صِهر لـ";
		$text['dil'] = "كِنّة لـ";
		$text['sdil'] = "صِهر أو كِنّة لـ";
		$text['gson'] = "الحفيد xxx لـ";
		$text['gdau'] = "الحفيدة xxx لـ";
		$text['gsondau'] = "الحفيد xxx لـ";
		$text['great'] = "الكبير";
		$text['spouses'] = "هم أزواجا";
		$text['is'] = "يكون";
		$text['changeto'] = "غيره إلى (أدخل الترميز):";
		$text['notvalid'] = "ليس ترميزا صحيحا لفرد أو غير موجود في قاعدة المعلومات. فضلا حاول مجددا.";
		$text['halfbrother'] = "أخ غير شقيق لـ";
		$text['halfsister'] = "أخت غير شقيقة لـ";
		$text['halfsibling'] = "طفل غير شقيق لـ";
		//changed in 8.0.0
		$text['gencheck'] = "عدد الأجيال للتحري";
		$text['mcousin'] = "xxxابن أو ابنة الأعمام أو الخيلان yyy لـ";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxxابن أو ابنة الأعمام أو الخيلان yyy لـ";  //female cousin
		$text['cousin'] = "xxxابن أو ابنة الأعمام أو الخيلان yyy لـ";
		$text['mhalfcousin'] = "xxxابن أو ابنة الأعمام أو الخيلان غير الأشقاء للوالدين yyy لـ";  //male cousin
		$text['fhalfcousin'] = "xxxابن أو ابنة الأعمام أو الخيلان غير الأشقاء للوالدين yyy لـ";  //female cousin
		$text['halfcousin'] = "xxxابن أو ابنة الأعمام أو الخيلان غير الأشقاء للوالدين yyy لـ";
		//added in 8.0.0
		$text['oneremoved'] = "مع فارق جيل";
		$text['gfath'] = "الجد xxx لـ";
		$text['gmoth'] = "الجدة xxx لـ";
		$text['gpar'] = "الأجداد xxx لـ";
		$text['mothof'] = "أم لـ";
		$text['fathof'] = "أب لـ";
		$text['parof'] = "أحد الوالدين لـ";
		$text['maxrels'] = "عدد الأجيال للعرض";
		$text['dospouses'] = "أظهر العلاقات الخاصة بزوج";
		$text['rels'] = "علاقات";
		$text['dospouses2'] = "أظهر الأزواج";
		$text['fil'] = "أبو الزوجة لـ";
		$text['mil'] = "أم الزوجة لـ";
		$text['fmil'] = "أب أو أم الزوجة لـ";
		$text['stepson'] = "ابن الزوج لـ";
		$text['stepdau'] = "ابنة الزوج لـ";
		$text['stepchild'] = "طفل الزوج لـ";
		$text['stepgson'] = "xxx ابن لأطفال الزوج لـ";
		$text['stepgdau'] = "xxx ابنة لأطفال الزوج لـ";
		$text['stepgchild'] = "xxx طفل لأطفال الزوج لـ";
		//added in 8.1.1
		$text['ggreat'] = "الكبير";
		//added in 8.1.2
		$text['ggfath'] = "xxx أب للجد لـ";
		$text['ggmoth'] = "xxx أم للجد لـ";
		$text['ggpar'] = "xxx والدين للجد لـ";
		$text['ggson'] = "xxx ابن حفيد لـ";
		$text['ggdau'] = "xxx ابنة حفيد لـ";
		$text['ggsondau'] = "xxx طفل حفيد لـ";
		$text['gstepgson'] = "xxx ابن لحفيد الزوج لـ";
		$text['gstepgdau'] = "xxx ابنة لحفيد الزوج لـ";
		$text['gstepgchild'] = "xxx طفل لحفيد الزوج لـ";
		$text['guncle'] = "xxxعم أو خال للوالدين لـ";
		$text['gaunt'] = "xxx عمة أو خالة للوالدين لـ";
		$text['guncleaunt'] = "xxx أعمام أو خيلان لـ";
		$text['gnephew'] = "xxx ابن لأبناء الاخوة لـ";
		$text['gniece'] = "xxx ابنة لأبناء الاخوة لـ";
		$text['gnephnc'] = "xxx طفل لأبناء الاخوة لـ";
		//added in 14.0
		$text['pathscalc'] = "البحث عن ارتباطات";
		$text['findrel2'] = "البحث عن علاقات أو ارتباطات أخرى";
		$text['makeme2nd'] = "استخدام ترميزي الشخصي";
		$text['usebookmarks'] = "استخدام الإشارات المرجعية";
		$text['select2inds'] = "فضلا اختر فردين";
		$text['indinfofor'] = "بيانات أفراد لـ";
		$text['nobookmarks'] = "لا توجد إشارة مرجعية للاستخدام";
		$text['bkmtitle'] = "الأشخاص الذين عُثر عليهم في الإشارات المرجعية";
		$text['bkminfo'] = "اختر شخصا";
		$text['sortpathsby'] = "صنف المسارات بناء على عدد الـ";
		$text['sortbyshort'] = "صنف حسب";
		$text['bylengthshort'] = "طول";
		$text['badID1'] = ":ترميزة الشخص الأول غير سليمة - فضل أعد المحاولة لتصحيحها";
		$text['badID2'] = ":ترميزة الشخص الثاني غير سليمة - فضل أعد المحاولة لتصحيحها";
		$text['notintree'] = ":الشخص المالك لهذا الترميزة غير موجود في قاعدة معلومات هذه الشجرة.";
		$text['sameperson'] = " الفردان يمثلان نفس الشخص.";;
		$text['nopaths'] = " لا يوجد ارتباط بين هؤلاء الأشخاص.";
		$text['nopaths1'] = " لا تتبقى ارتباطات أقصر من xxx";
		$text['nopaths2'] = " في xxx خطوات بحث";
		$text['longestpath'] = " (أقصى طول مسار تم فحصه إلى الآن هو xxx خطوة)";
		$text['relevantpaths'] = " عدد المسارات المتباينة ذات العلاقة المكتشفة: xxx";
		$text['skipMarr'] = " (إضافة إلى ذلك، إن عدد المسارات المكتشفة غير المعروضة بسبب كثرة الزواجات هو: xxx)";
		$text['mjaor'] = "أو";
		$text['connectionsto'] = "ارتباطات إلى ";
		$text['findanotherpers'] = "البحث عن ...";
		$text['sometimes'] = "(أحيانا البحث عبر عدد مختلف من الأجيال يتيح نتائج مختلفة.)";
		$text['anotherpath'] = "البحث عن ارتباطات أخرى";
		$text['xpath'] = "مسار  ";
		$text['primary'] = "الشخص الابتدائي"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "الشخص النهائي";
		$text['parent'] = "ولي الأمر";
		$text['mhfather'] = "والده";
		$text['mhmother'] = "والدته";
		$text['mhhusband'] = "زوجه";
		$text['mhwife'] = "زوجته";
		$text['mhson'] = "ابنه";
		$text['mhdaughter'] = "ابنتها";
		$text['fhfather'] = "أباها";
		$text['fhmother'] = "أمها";
		$text['fhhusband'] = "والدها";
		$text['fhwife'] = "زوجتها";
		$text['fhson'] = "ابنها";
		$text['fhdaughter'] = "ابنتها";
		$text['hfather'] = "أباها";
		$text['hmother'] = "أمها";
		$text['hhusband'] = "أباها";
		$text['hwife'] = "زوجة";
		$text['hson'] = "ابن";
		$text['hdaughter'] = "ابنة";
		$text['maxruns'] = "الحد الأقصى لعدد المسارات التي يتم فحصها";
		$text['maxrshort'] = "الحد الأقصى للمسارات";
		$text['maxlength'] = "مسارات ارتباطات لا يتعدى طولها";
		$text['maxlshort'] = "أقصى طول";
		$text['xstep'] = "خطوة";
		$text['xsteps'] = "خطوات";
		$text['xmarriages'] = " عدد xxx زواجات";
		$text['xmarriage'] = "زواج واحد";
		$text['showspouses'] = "أظهر الزوجين";
		$text['showTxt'] = " أظهر نص وصف المسار";
		$text['showTxtshort'] = "النص الوصفي";
		$text['compactBox'] = "أظهر صناديق الأشخاص مضغوطة";
		$text['compactBoxshort'] = "اضغط الصناديق";
		$text['paths'] = "المسارات";
		$text['dospouses2'] = "أظهر الأزواج";
		$text['maxmopt'] = "أقصى عدد من الزواجات لكل رابط"; 
		$text['maxm'] = "أقصى عدد من الزواجات";
		$text['arerelated'] = "هؤلاء الأشخاص تربطهم علاقة أسرية - وعلاقتهم مبينة في المسار 1";
		$text['simplerel'] = "بحث علاقات بسيط";
		break;

	case "familygroup":
		$text['familygroupfor'] = "أوراق المجموعة العائلية لـ";
		$text['ldsords'] = "أوامر نصرانية";
		$text['baptizedlds'] = "معمد (نصارى)";
		$text['endowedlds'] = "موهوب (نصارى)";
		$text['sealedplds'] = "مختوم للوالدين (نصارى)";
		$text['sealedslds'] = "مختوم للزوج (نصارى)";
		$text['otherspouse'] = "زوج آخر";
		$text['husband'] = "أب";
		$text['wife'] = "أم";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "ميلاد";
		$text['capaltbirthabbr'] = "ميلاد";
		$text['capdeathabbr'] = "وفاة";
		$text['capburialabbr'] = "دفن";
		$text['capplaceabbr'] = "مكان";
		$text['capmarrabbr'] = "زواج";
		$text['capspouseabbr'] = "زوج";
		$text['redraw'] = "إعادة الرسم مستعلا";
		$text['unknownlit'] = "غير معروف";
		$text['popupnote1'] = "معلومات إضافية";
		$text['pedcompact'] = "ضغط";
		$text['pedstandard'] = "معياري";
		$text['pedtextonly'] = "نص";
		$text['descendfor'] = "سلالة لـ";
		$text['maxof'] = "الحد الأقصى لـ";
		$text['gensatonce'] = "أجيال العرض في آن واحد";
		$text['sonof'] = "ابن ";
		$text['daughterof'] = "ابنة ";
		$text['childof'] = "طفل لـ";
		$text['stdformat'] = "الصيغة المعيارية";
		$text['ahnentafel'] = "جدول السلالة Ahnentafel";
		$text['addnewfam'] = "عائلة جديدة";
		$text['editfam'] = "تعديل العائلة";
		$text['side'] = "جانب";
		$text['familyof'] = "عائلة لـ";
		$text['paternal'] = "من جانب الأب";
		$text['maternal'] = "من جانب الأم";
		$text['gen1'] = "ذاته";
		$text['gen2'] = "والدين";
		$text['gen3'] = "أجداد";
		$text['gen4'] = "أباء الأجداد";
		$text['gen5'] = "أجداد الأجداد";
		$text['gen6'] = "رابع جيل أجداد";
		$text['gen7'] = "خامس جيل أجداد";
		$text['gen8'] = "سادس جيل أجداد";
		$text['gen9'] = "سابع جيل أجداد";
		$text['gen10'] = "ثامن جيل أجداد";
		$text['gen11'] = "تاسع جيل أجداد";
		$text['gen12'] = "عاشر جيل أجداد";
		$text['graphdesc'] = "شجرة سلالة إلى هذا النقطة";
		$text['pedbox'] = "صندوق";
		$text['regformat'] = "سجل";
		$text['extrasexpl'] = "= توجد على الأقل صورة واحدة أو تاريخ أو وسائط أخرى لهذا الشخص.";
		$text['popupnote3'] = "رسمة بيانية جديدة";
		$text['mediaavail'] = "وسائط متوفرة";
		$text['pedigreefor'] = "رسمة أسلاف تخص";
		$text['pedigreech'] = "رسم بياني للأسلاف";
		$text['datesloc'] = "تواريخ وأماكن";
		$text['borchr'] = "الولادة/التعميد – الوفاة/الدفن";
		$text['nobd'] = "لا توجد تواريخ للولادة أو الوفاة";
		$text['bcdb'] = "كافة بيانات الولادة/التعميد/الوفاة/الدفن";
		$text['numsys'] = "نظام الترقيم";
		$text['gennums'] = "أرقام الأجيال";
		$text['henrynums'] = "أرقام هنري";
		$text['abovnums'] = "أرقام (d'Aboville)";
		$text['devnums'] = "أرقام de Villiers ";
		$text['dispopts'] = "خيارات العرض";
		//added in 10.0.0
		$text['no_ancestors'] = "لم يتم العثور على أسلاف";
		$text['ancestor_chart'] = "رسمة أسلاف عمودية";
		$text['opennewwindow'] = "فتح في نافذة جديدة";
		$text['pedvertical'] = "عمودي";
		//added in 11.0.0
		$text['familywith'] = "عائلة مع";
		$text['fcmlogin'] = "فضلا سجل الدخول لترى التفاصيل";
		$text['isthe'] = "هو";
		$text['otherspouses'] = "الأزواج الآخرين";
		$text['parentfamily'] = "عائلة الاباء ";
		$text['showfamily'] = "أظهر العائلة";
		$text['shown'] = "ظاهر";
		$text['showparentfamily'] = "أظهر عائلة الآباء";
		$text['showperson'] = "أظهر الفرد";
		//added in 11.0.2
		$text['otherfamilies'] = "العوائل الأخرى";
		//added in 14.0
		$text['dtformat'] = "الجداول";
		$text['dtchildren'] = "الأطفال";
		$text['dtgrandchildren'] = "الأحفاد";
		$text['dtggrandchildren'] = "أبناء الأحفاد";
		$text['dtgggrandchildren'] = "أبناء الأحفاد"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "بدون سلالة";
		$text['dtgen'] = "جيل";
		$text['dttotal'] = "اجمالي";
		$text['dtselect'] = "الختيار";
		$text['dteachfulltable'] = "كل جدول كامل سيحوي";
		$text['dtrows'] = "صفوف";
		$text['dtdisplayingtable'] = "اظهار الجدول";
		$text['dtgototable'] = "اذهب إلى الجدول:";
		$text['fcinstrdn'] = "أظهر العائلة مع الزوج";
		$text['fcinstrup'] = "أظهر العائلة مع الوالدين";
		$text['fcinstrplus'] = "اختر أزواج آخرين";
		$text['fcinstrfam'] = "اختر والدين آخرين";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "لا توجد تقارير.";
		$text['reportname'] = "اسم التقرير";
		$text['allreports'] = "كافة التقارير";
		$text['report'] = "تقرير";
		$text['error'] = "خطأ";
		$text['reportsyntax'] = "تركيب جملة الاستعلام المستخدم مع هذا التقرير";
		$text['wasincorrect'] = "كان خاطئا، وبالتالي تعذر توليد التقرير. يرجى التواصل مع مدير النظام على";
		$text['errormessage'] = "رسالة خطأ";
		$text['equals'] = "يساوي";
		$text['endswith'] = "ينتهي بـ";
		$text['soundexof'] = "تقريب soundex لـ";
		$text['metaphoneof'] = "تقريب metaphoneلـ";
		$text['plusminus10'] = "+ أو – عشرة سنوات من";
		$text['lessthan'] = "أقل من";
		$text['greaterthan'] = "أكبر من";
		$text['lessthanequal'] = "أقل من أو مساوي لـ";
		$text['greaterthanequal'] = "أكبر من أو مساوي لـ";
		$text['equalto'] = "يساوي";
		$text['tryagain'] = "فضلا حاول مجددا";
		$text['joinwith'] = "الدمج باستخدام";
		$text['cap_and'] = "AND";
		$text['cap_or'] = "OR";
		$text['showspouse'] = "إظهار الأزواج (سيتم عرض الجميع لو كان الفرد قد تزوج أكثر من مرة)";
		$text['submitquery'] = "ارسال الاستعلام";
		$text['birthplace'] = "مكان الميلاد";
		$text['deathplace'] = "مكان الوفاة";
		$text['birthdatetr'] = "سنة الميلاد";
		$text['deathdatetr'] = "سنة الوفاة";
		$text['plusminus2'] = "+ أو – سنتان من";
		$text['resetall'] = "إعادة الوضع الافتراضي لجميع القيم";
		$text['showdeath'] = "إظهار معلومات الموت والدفن";
		$text['altbirthplace'] = "مكان التعميد";
		$text['altbirthdatetr'] = "تاريخ التعميد";
		$text['burialplace'] = "مكان الدفن";
		$text['burialdatetr'] = "سنة الدفن";
		$text['event'] = "حدث";
		$text['day'] = "يوم";
		$text['month'] = "شهر";
		$text['keyword'] = "كلمة مفتاحية (مثل \"حول\")";
		$text['explain'] = "أدخل مكونات التاريخ لترى أحداثا مطابقة. اترك الحقل فارغا لترى التطابق للجميع.";
		$text['enterdate'] = "فضلا أدخل أو اختر على الأقل واحدا مما يلي: اليوم، الشهر، السنة، كلمة مفتاحية";
		$text['fullname'] = "الاسم الكامل";
		$text['birthdate'] = "تاريخ الميلاد";
		$text['altbirthdate'] = "تاريخ التعميد";
		$text['marrdate'] = "تاريخ الزواج";
		$text['spouseid'] = "ترويز الزوج";
		$text['spousename'] = "اسم الزوج";
		$text['deathdate'] = "تاريخ الوفاة";
		$text['burialdate'] = "تاريخ الدفن";
		$text['changedate'] = "تاريخ آخر تحديث";
		$text['gedcom'] = "شجرة";
		$text['baptdate'] = "تاريخ التعميد (نصارىLDS)";
		$text['baptplace'] = "مكان التعميد (نصارىLDS)";
		$text['endldate'] = "تاريخ الهبة (نصارىLDS)";
		$text['endlplace'] = "مكان الهبة (نصارىLDS)";
		$text['ssealdate'] = "تاريخ ختم الأزواج(نصارىLDS)";   //Sealed to spouse
		$text['ssealplace'] = "مكان ختم الأزواج (نصارىLDS)";
		$text['psealdate'] = "تاريخ ختم الوالدين(نصارىLDS)";   //Sealed to parents
		$text['psealplace'] = "مكان ختم الوالدين (نصارىLDS)";
		$text['marrplace'] = "مكان الزواج";
		$text['spousesurname'] = "اسم عائلة الزوج";
		$text['spousemore'] = "إذا أدخل اسم عائلة للزوج فعليك أيضا تحديد الجنس";
		$text['plusminus5'] = "+ أو – خمس سنوات من";
		$text['exists'] = "موجود.";
		$text['dnexist'] = "غير موجود";
		$text['divdate'] = "تاريخ الطلاق";
		$text['divplace'] = "مكان الطلاق";
		$text['otherevents'] = "معايير بحث أخرى";
		$text['numresults'] = "نتائج لكل صفحة";
		$text['mysphoto'] = "صور مبهمة";
		$text['mysperson'] = "أفرادا يصعب إدراكهم";
		$text['joinor'] = " لا يمكن استخدام خيار 'الانضمام مع OR' مع اسم عائلة الزوج";
		$text['tellus'] = "قل لنا ماذا تعرف";
		$text['moreinfo'] = "معلومات إضافية";
		//added in 8.0.0
		$text['marrdatetr'] = "تاريخ الزواج";
		$text['divdatetr'] = "تاريخ الطلاق";
		$text['mothername'] = "اسم الأم";
		$text['fathername'] = "اسم الأب";
		$text['filter'] = "ترشيح (فلترة)";
		$text['notliving'] = "ليس حيا";
		$text['nodayevents'] = "فعاليات لهذا الشهر التي لا ترتبط بيوم معين:";
		//added in 9.0.0
		$text['csv'] = "ملف مفصول بالفواصل بصيغة CVS";
		//added in 10.0.0
		$text['confdate'] = "تاريخ التأكيد (نصارىLDS)";
		$text['confplace'] = "مكان التأكيد (نصارىLDS)";
		$text['initdate'] = "تاريخ الاستهلال (نصارى LDS(";
		$text['initplace'] = "مكان الاستهلال (نصارى LDS)";
		//added in 11.0.0
		$text['marrtype'] = "نوع الزواج";
		$text['searchfor'] = "ابحث عن";
		$text['searchnote'] = " ملاحظة: هذه الصفحة تستخدم خدمات جوجل للبحث. بالتالي فإن عدد النتائج ستتأثر مباشرة بمدى فهرسة موقع جوجل للموقع.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "السجل الخاص بـ";
		$text['mostrecentactions'] = "أحدث العمليات";
		$text['autorefresh'] = "تحديث تلقائي (كل 30 ثانية)";
		$text['refreshoff'] = "اطفاء التحديث التلقائي";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "مقابر ومواقع قبور";
		$text['showallhsr'] = "عرض كافة سجلا مواقع القبور";
		$text['in'] = "في";
		$text['showmap'] = "أظهر الخارطة";
		$text['headstonefor'] = "موقع قبر يخص";
		$text['photoof'] = "صورة لـ";
		$text['photoowner'] = "مالك الأصل";
		$text['nocemetery'] = "بدون مقبرة";
		$text['iptc005'] = "عنوان";
		$text['iptc020'] = "فئات إضافية";
		$text['iptc040'] = "تعليمات خاصة";
		$text['iptc055'] = "تاريخ الإنشاء";
		$text['iptc080'] = "المؤلف";
		$text['iptc085'] = "منصب المؤلف";
		$text['iptc090'] = "مدينة";
		$text['iptc095'] = "منطقة";
		$text['iptc101'] = "دولة";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "عنوان رئيس";
		$text['iptc110'] = "مصدر";
		$text['iptc115'] = "مصدر الصور";
		$text['iptc116'] = "إعلان حقوق النشر";
		$text['iptc120'] = "النص المصاحب";
		$text['iptc122'] = "كاتب تعليقات الصور";
		$text['mapof'] = "خارطة لـ";
		$text['regphotos'] = "العرض الوصفي";
		$text['gallery'] = "صور صغيرة فقط";
		$text['cemphotos'] = "صور مقابر";
		$text['photosize'] = "أبعاد";
        $text['iptc010'] = "أولوية";
		$text['filesize'] = "مقاس الملف";
		$text['seeloc'] = "عرض الموقع";
		$text['showall'] = "عرض الكل";
		$text['editmedia'] = "تعديل وسائط";
		$text['viewitem'] = "عرض هذا العنصر";
		$text['editcem'] = "تعديل المقبرة";
		$text['numitems'] = "عدد العناصر";
		$text['allalbums'] = "كافة الألبومات";
		$text['slidestop'] = "إيقاف مؤقت لعرض سلسلة الشرائح";
		$text['slideresume'] = "استئناف عرض سلسلة الشرائح";
		$text['slidesecs'] = "ثوان لكل شريحة:";
		$text['minussecs'] = "إنقاص نصف ثانية";
		$text['plussecs'] = "إضافة نصف ثانية";
		$text['nocountry'] = "دولة مجهولة";
		$text['nostate'] = "محافظة مجهولة";
		$text['nocounty'] = "منطقة مجهولة";
		$text['nocity'] = "مدينة مجهولة";
		$text['nocemname'] = "مقبرة مجهولة";
		$text['editalbum'] = "تعديل الألبوم";
		$text['mediamaptext'] = "<strong>ملاحظة:</strong> حرك الفأرة فوق الصورة لإظهار الأسماء. انقر لعرض صفحة لكل اسم.";
		//added in 8.0.0
		$text['allburials'] = "كافة وقائع الدفن";
		$text['moreinfo'] = "انقر لمزيد من المعلومات حول هذه الصورة";
		//added in 9.0.0
        $text['iptc025'] = "الكلمات المفتاحية";
        $text['iptc092'] = "الموقع الفرعي";
		$text['iptc015'] = "الفئة";
		$text['iptc065'] = "برنامج المنشأ";
		$text['iptc070'] = "إصدار البرنامج";
		//added in 13.0
		$text['toggletags'] = "بدل العلامات";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "عرض أسماء العوائل التي تبدأ بما يلي";
		$text['showtop'] = "عرض الأكثر ورودا";
		$text['showallsurnames'] = "عرض كافة أسماء العوائل";
		$text['sortedalpha'] = "مرتبة أبجديا";
		$text['byoccurrence'] = "مرتبة حسب الورود";
		$text['firstchars'] = "الأحرف الأولى";
		$text['mainsurnamepage'] = "صفحة أسماء العوائل الرئيس";
		$text['allsurnames'] = "كافة أسماء العوائل";
		$text['showmatchingsurnames'] = "انقر على اسم عائلة لعرض السجلات المتطابقة.";
		$text['backtotop'] = "العودة إلى الأعلى";
		$text['beginswith'] = "يبدأ بـ";
		$text['allbeginningwith'] = "كافة أسماء العوائل التي تبدأ بـ";
		$text['numoccurrences'] = "عدد إجمالي المحافظات بين قوسين";
		$text['placesstarting'] = "عرض كبرى الجهات التي تبدأ بما يلي";
		$text['showmatchingplaces'] = "انقر على منطقة لإظهار المحافظات الجزئية. انقر على رمز البحث لإظهار الأفراد المتطابقين.";
		$text['totalnames'] = "إجمالي الأفراد";
		$text['showallplaces'] = "عرض كافة المحافظات الكبرى";
		$text['totalplaces'] = "إجمالي المناطق";
		$text['mainplacepage'] = "صفحة المناطق الرئيسة";
		$text['allplaces'] = "كافة المحافظات الكبرى";
		$text['placescont'] = "عرض كافة المناطق التي تحوي";
		//changed in 8.0.0
		$text['top30'] = "أكثر xxx اسم عائلي ورودا";
		$text['top30places'] = "أكثر xxx ورودا بين كبرى المحافظات";
		//added in 12.0.0
		$text['firstnamelist'] = "قائمة الأسماء الأولى";
		$text['firstnamesstarting'] = "أظهر الأسماء الأولى التي تبدأ بما يلي";
		$text['showallfirstnames'] = "أظهر كافة الأسماء الأولى";
		$text['mainfirstnamepage'] = "صفحة الأسماء الأولى الرئيسة";
		$text['allfirstnames'] = "كافة الأسماء الأولى";
		$text['showmatchingfirstnames'] = "انقر على أحد الأسماء الأولى لتظهر السجلات ذات الارتباط.";
		$text['allfirstbegwith'] = "كافة الأسماء الأولى التي تبدأ بما يلي";
		$text['top30first'] = "أعلى xxx أسما أولا";
		$text['allothers'] = "كافة الآخرين";
		$text['amongall'] = "(من بين كافة الأسماء)";
		$text['justtop'] = "فقط أعلى xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(آخر xx يوما)";

		$text['photo'] = "صورة";
		$text['history'] = "تاريخ أو مستند";
		$text['husbid'] = "ترميز الأب";
		$text['husbname'] = "ترميز الأب";
		$text['wifeid'] = "ترميز الأم";
		//added in 11.0.0
		$text['wifename'] = "اسم الأم";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "حذف";
		$text['addperson'] = "إضافة أفراد";
		$text['nobirth'] = "لا يمتلك الفرد التالي تاريخ ميلاد صحيحا لذلك تعذرت إضافته";
		$text['event'] = "أحداث";
		$text['chartwidth'] = "عرض الرسم البياني";
		$text['timelineinstr'] = "إضافة أفراد";
		$text['togglelines'] = "تبديل الخطوط";
		//changed in 9.0.0
		$text['noliving'] = "الفرد التالي حي أو مفعل في حقه خاصية الخصوصية لذلك لم يتيسر إضافته حيث أنك لم تقم بتسجيل الدخول من خلال حساب يمتلك الصلاحيات الكافية.";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "تصفح كافة الأشجار";
		$text['treename'] = "اسم الشجرة";
		$text['owner'] = "مالك";
		$text['address'] = "عنوان";
		$text['city'] = "مدينة";
		$text['state'] = "منطقة";
		$text['zip'] = "رمز بريدي";
		$text['country'] = "دولة";
		$text['email'] = "بريد إلكتروني";
		$text['phone'] = "هاتف";
		$text['username'] = "حساب مستخدم";
		$text['password'] = "كلمة سر";
		$text['loginfailed'] = "فشل تسجيل الدخول";

		$text['regnewacct'] = "التسجيل لحساب مستخدم جديد";
		$text['realname'] = "اسمك الحقيقي";
		$text['phone'] = "هاتف";
		$text['email'] = "بريد إلكتروني";
		$text['address'] = "عنوان";
		$text['acctcomments'] = "ملاحظات أو تعليقات";
		$text['submit'] = "أرسل";
		$text['leaveblank'] = "(اتركه فراغا لو كنت تطلب شجرة جديدة)";
		$text['required'] = "حقول إلزامية";
		$text['enterpassword'] = "فضلا أدخل كلمة سر.";
		$text['enterusername'] = "فضلا أدخل حساب مستخدم";
		$text['failure'] = "عذرا، لكن اسم المستخدم الذي أدخلته محجوز مسبقا. فضلا استخدم زر العودة إلى الخلف في متصفحك.";
		$text['success'] = "شكرا. لقد تم استلام تسجيلك. سنتواصل معك بعد تفعيل حسابك أو في حالة الاحتياج إلى معلومات أخرى.";
		$text['emailsubject'] = "طلب تسجيل حساب مستخدم جديد في نظام المواريث";
		$text['website'] = "موقع نسيجي";
		$text['nologin'] = "لا تمتلك حساب مستخدم";
		$text['loginsent'] = "تم إرسال معلومات تسجيل الدخول";
		$text['loginnotsent'] = "لم يتم إرسال معلومات تسجيل الدخول";
		$text['enterrealname'] = "فضلا أدخل اسمك الحقيقي.";
		$text['rempass'] = "استدامة تسجيل الدخول على هذا الحاسب";
		$text['morestats'] = "إحصاءات أخرى";
		$text['accmail'] = "<strong>ملاحظة:</strong> إذا رغبت باستلام رسائل بريد إلكتروني من مدير الموقع حيال حسابك، فعليك التأكد أن نظام البريد الإلكتروني الخاص بك لا يحجب نطاق هذا الموقع.";
		$text['newpassword'] = "كلمة سر جديدة";
		$text['resetpass'] = "إعادة تهيئة كلمة السر الخاصة بك";
		$text['nousers'] = "لا يمكن استخدام هذا النموذج حتى يتم إنشاء حساب مستخدم واحد على الأقل. إذا كنت أنت مالك الموقع، اذهب إلى (إدارة) ثم (مستخدمين) لصناعة حساب المدير الخاص بك.";
		$text['noregs'] = "عذرا، ولكننا لا نستقبل طلبات لحسابات جديدة في الوقت الراهن. فضلا <a href=\"suggest.php\">تواصل معنا </a> مباشرة لو كنت لديك استفسارات أو أسئلة تخص هذا الموقع.";
		$text['emailmsg'] = "لقد استلمت طلبا لحساب مستخدم جديد على نظام المواريث. فضلا قم بتسجيل الدخول في حساب المدير الخاص بك ثم خصص صلاحيات مناسبة لهذا الحساب الجديد.";
		$text['accactive'] = "لقد تم تفعيل الحساب، لكن لن يتم منح المستخدم صلاحيات خاصة حتى تخصصها له.";
		$text['accinactive'] = "اذهب إلى (إدارة) ثم (مستخدمين) ثم (مراجعة) للوصول إلى لوحة إعدادات الحساب. وسيستمر الحساب في وضعه غير المفعّل إلى أن تقوم بمعايرته ثم تخزينه على الأقل مرة واحدة.";
		$text['pwdagain'] = "كلمة السر مجددا";
		$text['enterpassword2'] = "فضلا أدخل كلمة السر الخاص بك مجددا.";
		$text['pwdsmatch'] = "لا تتطابق كلمتا السر. تأكد من إدخال كلمة السر ذاتها في الحقلين جميعا.";
		$text['acksubject'] = "شكرا على التسجيل"; //for a new user account
		$text['ackmessage'] = "تم استلام طلبكم لإنشاء حساب مستخدم. وسيستمر حسابكم في وضعه غير المفعّل حتى يتمكن مدير النظام من دراسة الطلب. وسيتم إبلاغكم عبر البريد الإلكتروني عند تفعيل حسابكم.";
		//added in 12.0.0
		$text['switch'] = "استبدال";
		//added in 14.0
		$text['newpassword2'] = "كرر كلمة السر الجديدة";
		$text['resetsuccess'] = "نجاح: تمت إعادة تعيين كلمة السر";
		$text['resetfail'] = "فشل: لم تتم إعادة تعيين كلمة السر";
		$text['failreason0'] = " (خطأ غير محدد في قاعدة المعلومات)";
		$text['failreason2'] = " (لا تمتلك الصلاحية المناسبة لتغيير كلمة السر الخاصة بك) ";
		$text['failreason3'] = " ( لم تتطابق كلمتا السر) ";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "تصفح كافة الفروع";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "كمية";
		$text['totindividuals'] = "إجمالي الأفراد";
		$text['totmales'] = "إجمالي الذكور";
		$text['totfemales'] = "إجمالي الإناث";
		$text['totunknown'] = "إجمال مجهولي الجنس";
		$text['totliving'] = "إجمالي الأحياء";
		$text['totfamilies'] = "إجمالي العوائل";
		$text['totuniquesn'] = "إجمالي أسماء العوائل المختلفة";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "إجمالي المصادر";
		$text['avglifespan'] = "متوسط الأعمار";
		$text['earliestbirth'] = "أبكر ولادة";
		$text['longestlived'] = "الأطول عمرا";
		$text['days'] = "أيام";
		$text['age'] = "عمر";
		$text['agedisclaimer'] = " تشترط الحسابات ذات العلاقة بالأعمار وجود تواريخ ميلاد للأفراد <em> و </ em> تواريخ وفاة. لكن أحيانا يتم تسجيل بيانات ناقصة في هذه الحقول (من نماذجها: السنة فقط، مثل: \"1945 \" أو \"قبل 1860 \")، مما ينتج بالضرورة إلى عدم دقة هذه الحسابات 100%.";
		$text['treedetail'] = "معلومات أخرى حول هذه الشجرة";
		$text['total'] = "إجمالي";
		//added in 12.0
		$text['totdeceased'] = "اجمالي المتوفين";
		//added in 14.0
		$text['totalsourcecitations'] = " اجمالي مصادر القتباسات";
		break;

	case "notes":
		$text['browseallnotes'] = "تصفح كافة الملاحظات";
		break;

	case "help":
		$text['menuhelp'] = "مفتاح القوائم";
		break;

	case "install":
		$text['perms'] = "تم تخصيص الصلاحيات جميعا";
		$text['noperms'] = "فشل تخصيص الصلاحيات لهذه الملفات:";
		$text['manual'] = "فضلا حددهم يدويا";
		$text['folder'] = "مجلد";
		$text['created'] = "تم الإنشاء";
		$text['nocreate'] = "فشل الإنشاء. يرجى إنشاءه يدويا.";
		$text['infosaved'] = "تم الحفظ وتأكيد الاتصال";
		$text['tablescr'] = "تم إنشاء الجداول!";
		$text['notables'] = "تعذر إنشاء الجداول التالية:";
		$text['nocomm'] = "تعذر اتصال برنامج المواريث بقاعدة معلوماتك.  لم يتم إنشاء أي جداول.";
		$text['newdb'] = "تم حفظ المعلومات. تم تحقيق الاتصال. تم إنشاء قاعدة المعلومات:";
		$text['noattach'] = "تم التخزين. نجح الاتصال وإنشاء قاعدة المعلومات، لكن فشل شبكها ببرنامج المواريث.";
		$text['nodb'] = "تم تخزين المعلومات. ونجح الاتصال. لكن قاعدة المعلومات غير موجودة وتعذر إنشاءها هنا. فضلا تثبت من صحة اسم قاعدة المعلومات وأن حساب مستخدم القاعدة يمتلك الصلاحيات الكافية، أو استخدم لوحة التحكم لإنشاءه.";
		$text['noconn'] = "تم تخزين المعلومات، لكن فشل الاتصال. واحد أو أكثر مما يلي غير صحيح:";
		$text['exists'] = "موجود مسبقا.";
		$text['noop'] = "لم يتم اتخاذ أي إجراء.";
		//added in 8.0.0
		$text['nouser'] = "لم يتم إنشاء اسم المستخدم. ربما يكون اسم المستخدم محجوزا لمستخدم آخر.";
		$text['notree'] = "فشل إنشاء الشجرة.  ربما لامتلاك شجرة أخرى لذلك الترميز";
		$text['infosaved2'] = "حُفظت المعلومات";
		$text['renamedto'] = "تغير الاسم إلى";
		$text['norename'] = "تعذرة إعادة التسمية";
		//changed in 13.0.0
		$text['loginfirst'] = "تم الكشف عن سجل المستخدم الحالي. سجل الدخول لكي للإتمام يجب تسجيل الدخول او إزالة كل السجلات  من جدول المستخدمين";
		break;

	case "imgviewer":
		$text['magmode'] = "وضع التكبير";
		$text['panmode'] = "وضع الإزاحة";
		$text['pan'] = "انقر واسحب للتحرك داخل الصورة";
		$text['fitwidth'] = "احتواء عرضي";
		$text['fitheight'] = "احتواء طولي";
		$text['newwin'] = "نافذة جديدة";
		$text['opennw'] = "افتح الصورة في نافذة جديدة";
		$text['magnifyreg'] = "انقر لتكبير منطقة من الصورة";
		$text['imgctrls'] = "تفعيل أدوات الصور";
		$text['vwrctrls'] = "تفعيل أدوات عارض الصور";
		$text['vwrclose'] = "أغلق عارض الصور";
		break;

	case "dna":
		$text['test_date'] = "تاريخ الاختبار";
		$text['links'] = "الروابط ذات العلاقة";
		$text['testid'] = "ترميزة الاختبار";
		//added in 12.0.0
		$text['mode_values'] = "قيم الوضعية";
		$text['compareselected'] = "قارن بين المنتقين";
		$text['dnatestscompare'] = "قارن اختبارات Y-DNA";
		$text['keep_name_private'] = "المحافظة على خصوصية الاسم";
		$text['browsealltests'] = "تصفح كافة الاختبارات";
		$text['all_dna_tests'] = "كافة اختبارات الحامض النووي";
		$text['fastmutating'] = "سريع ومتطور";
		$text['alltypes'] = "كافة الأنواع";
		$text['allgroups'] = "كافة المجموعات";
		$text['Ydna_LITbox_info'] = " ليس من الضرورة أن تكون الاختبارات المرتبطة بهذا الفرد قد تم إجراءها من قبله.<br /> قائمة 'السلالة العرقية Haplogroup' تظهر البيانات باللون الأحمر إذا كانت النتائج 'متوقعة' أو باللون الأخضر لو كان الاختبار 'مؤكدا'";
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
$text['matches'] = "تطابقات";
$text['description'] = "وصف";
$text['notes'] = "ملاحظات";
$text['status'] = "الوضع الراهن";
$text['newsearch'] = "بحث جديد";
$text['pedigree'] = "شجرة أسلاف";
$text['seephoto'] = "راجع الصورة";
$text['andlocation'] = "والموقع";
$text['accessedby'] = "تم النفاذ إليه من قبل";
$text['children'] = "أطفال";  //from getperson
$text['tree'] = "شجرة";
$text['alltrees'] = "كافة الأشجار";
$text['nosurname'] = "[بلا اسم عائلة]";
$text['thumb'] = "صورة مصغرة";  //as in Thumbnail
$text['people'] = "أفراد";
$text['title'] = "لقب";  //from getperson
$text['suffix'] = "لاحقة";  //from getperson
$text['nickname'] = "اسم الشهرة";  //from getperson
$text['lastmodified'] = "آخر تاريخ";  //from getperson
$text['married'] = "تزوج";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "الاسم"; //from showmap
$text['lastfirst'] = "العائلة، الاسم الأول";  //from search
$text['bornchr'] = "ولادة أو تعميد";  //from search
$text['individuals'] = "أفارد";  //from whats new
$text['families'] = "العوائل";
$text['personid'] = "ترميز فرد";
$text['sources'] = "مصادر";  //from getperson (next several)
$text['unknown'] = "مجهول";
$text['father'] = "أب";
$text['mother'] = "أم";
$text['christened'] = "عُمٍّد";
$text['died'] = "توفى";
$text['buried'] = "دفن";
$text['spouse'] = "زوج";  //from search
$text['parents'] = "والدين";  //from pedigree
$text['text'] = "نص";  //from sources
$text['language'] = "لغة";  //from languages
$text['descendchart'] = "شجرة سلالة";
$text['extractgedcom'] = "جيدكوم";
$text['indinfo'] = "فرد";
$text['edit'] = "تعديل";
$text['date'] = "تاريخ";
$text['login'] = "تسجل دخول";
$text['logout'] = "تسجيل خروج";
$text['groupsheet'] = "أوراق المجموعة";
$text['text_and'] = "و";
$text['generation'] = "جيل";
$text['filename'] = "اسم ملف";
$text['id'] = "ترميز";
$text['search'] = "بحث";
$text['user'] = "مستخدم";
$text['firstname'] = "الاسم الأول";
$text['lastname'] = "اسم العائلة";
$text['searchresults'] = "نتائج البحث";
$text['diedburied'] = "توفى/دفن";
$text['homepage'] = "الصفحة الرئيس";
$text['find'] = "البحث...";
$text['relationship'] = "علاقة";		//in German, Verwandtschaft
$text['relationship2'] = "علاقة"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "خط الزمن";
$text['yesabbr'] = "نعم";               //abbreviation for 'yes'
$text['divorced'] = "مطلّق";
$text['indlinked'] = "مرتبط بـ";
$text['branch'] = "فرع";
$text['moreind'] = "أفراد آخرين";
$text['morefam'] = "عوائل آخرين";
$text['surnamelist'] = "قائمة العوائل";
$text['generations'] = "أجيل";
$text['refresh'] = "تحديث";
$text['whatsnew'] = "الجديد";
$text['reports'] = "تقارير";
$text['placelist'] = "قائمة المواقع";
$text['baptizedlds'] = "تعميد (نصارى LDS)";
$text['endowedlds'] = "هبة (نصارى LDS)";
$text['sealedplds'] = "ختم الوالدين (نصارى LDS)";
$text['sealedslds'] = "ختم الأزواج (نصارى LDS)";
$text['ancestors'] = "أسلاف";
$text['descendants'] = "سلالة";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "تاريخ آخر توريد لجيدكوم";
$text['type'] = "نوع";
$text['savechanges'] = "حفظ التغييرات";
$text['familyid'] = "ترميز عائلة";
$text['headstone'] = "مواقع قبور";
$text['historiesdocs'] = "تواريخ";
$text['anonymous'] = "مجهول";
$text['places'] = "مناطق";
$text['anniversaries'] = "تواريخ وأعياد عائلية";
$text['administration'] = "إدارة";
$text['help'] = "مساعدة";
//$text['documents'] = "Documents";
$text['year'] = "سنة";
$text['all'] = "الكل";
$text['address'] = "عنوان";
$text['suggest'] = "اقترح";
$text['editevent'] = "اقتراح تغيير لهذا الحدث";
$text['morelinks'] = "روابط إضافية";
$text['faminfo'] = "معلومات عائلية";
$text['persinfo'] = "معلومات شخصية";
$text['srcinfo'] = "معلومات مصادر";
$text['fact'] = "حقيقة";
$text['goto'] = "اختر صفحة";
$text['tngprint'] = "اطبع";
$text['databasestatistics'] = "إحصاءات"; //needed to be shorter to fit on menu
$text['child'] = "طفل";  //from familygroup
$text['repoinfo'] = "معلومات مستودع";
$text['tng_reset'] = "إعادة تعيين";
$text['noresults'] = "لم يتم العثور على نتائج";
$text['allmedia'] = "كافة الوسائط";
$text['repositories'] = "مستودعات";
$text['albums'] = "ألبومات";
$text['cemeteries'] = "مقابر";
$text['surnames'] = "أسماء عوائل";
$text['dates'] = "تواريخ";
$text['link'] = "رابط";
$text['media'] = "وسائط";
$text['gender'] = "جنس";
$text['latitude'] = "خط عرض";
$text['longitude'] = "خط طول";
$text['bookmarks'] = "إشارات مرجعية";
$text['bookmark'] = "إشارة مرجعية";
$text['mngbookmarks'] = "اذهب إلى الإشارات المرجعية";
$text['bookmarked'] = "تمت إضافة إشارة مرجعية";
$text['remove'] = "إزالة";
$text['find_menu'] = "ابحث";
$text['info'] = "معلومات"; //this needs to be a very short abbreviation
$text['cemetery'] = "مقبرة";
$text['gmapevent'] = "خارطة الأحداث";
$text['gevents'] = "حدث";
$text['googleearthlink'] = "الربط مع خدمة Google Earth";
$text['googlemaplink'] = "الربط مع خدمة Google Maps";
$text['gmaplegend'] = "تثبيت دليل المصطلحات";
$text['unmarked'] = "غير معلًّم";
$text['located'] = "تم العثور عليه";
$text['albclicksee'] = "انقر لاستعراض كافة العناصر في هذا الألبوم";
$text['notyetlocated'] = "لم يعثر عليه بعد";
$text['cremated'] = "تم حرقه";
$text['missing'] = "مفقود";
$text['pdfgen'] = "مولد ملفات PDF";
$text['blank'] = "رسم بياني فاضي";
$text['fonts'] = "خطوط";
$text['header'] = "الترويسة";
$text['data'] = "بيانات";
$text['pgsetup'] = "اعدادات الصفحة";
$text['pgsize'] = "مقاس الصفحة";
$text['orient'] = "الاتجاه"; //for a page
$text['portrait'] = "عمودي";
$text['landscape'] = "أفقي";
$text['tmargin'] = "الهامش العلوي";
$text['bmargin'] = "الهامش السفلي";
$text['lmargin'] = "الهامش الأيسر";
$text['rmargin'] = "الهامش الأيمن";
$text['createch'] = "إنشاء الرسم البياني";
$text['prefix'] = "بادئة";
$text['mostwanted'] = "الأكثر طلبا";
$text['latupdates'] = "آخر التحديثات";
$text['featphoto'] = "صورة الساعة";
$text['news'] = "أخبار";
$text['ourhist'] = "تاريخ عائلتنا";
$text['ourhistanc'] = "تاريخ وسلالة عائلتنا";
$text['ourpages'] = "صفحات أنساب عائلتنا";
$text['pwrdby'] = "هذا الموقع يعمل بإدارة برنامج";
$text['writby'] = "تم التحرير من قبل";
$text['searchtngnet'] = "ابحث خلال شبكة TNG (GENDEX)";
$text['viewphotos'] = "مشاهدة كافة الصور";
$text['anon'] = "أنت حاليا مجهول الهوية";
$text['whichbranch'] = "من أي فرع أنت؟";
$text['featarts'] = "مقال الساعة";
$text['maintby'] = "تحت إشراف";
$text['createdon'] = "تم الإنشاء في";
$text['reliability'] = "موثوقية";
$text['labels'] = "ملصقات";
$text['inclsrcs'] = "إضافة المصادر";
$text['cont'] = "(يتبع)"; //abbreviation for continued
$text['mnuheader'] = "الصفحة الرئيسة";
$text['mnusearchfornames'] = "البحث";
$text['mnulastname'] = "الاسم الأخير";
$text['mnufirstname'] = "الاسم الأول";
$text['mnusearch'] = "البحث";
$text['mnureset'] = "الشروع مجددا";
$text['mnulogon'] = "تسجيل الدخول";
$text['mnulogout'] = "تسجيل الخروج";
$text['mnufeatures'] = "أخرى تستحق الإبراز";
$text['mnuregister'] = "التسجيل لحساب مستخدم";
$text['mnuadvancedsearch'] = "البحث المتقدم";
$text['mnulastnames'] = "أسماء العوائل";
$text['mnustatistics'] = "إحصاءات";
$text['mnuphotos'] = "صور";
$text['mnuhistories'] = "تواريخ";
$text['mnumyancestors'] = "صور وتاريخ لأسلاف [فرد]";
$text['mnucemeteries'] = "مقابر";
$text['mnutombstones'] = "مواقع قبور";
$text['mnureports'] = "تقارير";
$text['mnusources'] = "مصادر";
$text['mnuwhatsnew'] = "الجديد";
$text['mnushowlog'] = "سَجِل الدخول";
$text['mnulanguage'] = "تغيير اللغة";
$text['mnuadmin'] = "الإدارة";
$text['welcome'] = "أهلا وسهلا";
$text['contactus'] = "اتصل بنا";
//changed in 8.0.0
$text['born'] = "وُلِد";
$text['searchnames'] = "ابحث في الأفراد";
//added in 8.0.0
$text['editperson'] = "عدل بيانات فرد";
$text['loadmap'] = "حمل الخارطة";
$text['birth'] = "ولادة";
$text['wasborn'] = "وُلِد";
$text['startnum'] = "أول رقم";
$text['searching'] = "جاري البحث";
//moved here in 8.0.0
$text['location'] = "الموقع";
$text['association'] = "اقتران";
$text['collapse'] = "طي";
$text['expand'] = "بسط";
$text['plot'] = "خطط";
$text['searchfams'] = "ابحث في العوائل";
//added in 8.0.2
$text['wasmarried'] = "متزوج";
$text['anddied'] = "توفى";
//added in 9.0.0
$text['share'] = "شارك";
$text['hide'] = "إخفاء";
$text['disabled'] = "تم تعطيل حساب المستخدم الخاص بك. يرجى التواصل مع مدير الموقع للمزيد من المعلومات.";
$text['contactus_long'] = " إذا كانت لديك أية أسئلة أو تعليقات تخص المعلومات الواردة في هذا الموقع، فنأمل <span class=\"emphasis\"><a href=\"suggest.php\">التواصل معنا</a></span>. ونتطلع إلى الاستماع إليك.";
$text['features'] = "بارزة";
$text['resources'] = "موارد";
$text['latestnews'] = "آخر الأخبار";
$text['trees'] = "أشجار";
$text['wasburied'] = "تم دفنه";
//moved here in 9.0.0
$text['emailagain'] = "راسل مجددا";
$text['enteremail2'] = "يرجى إعادة إدخال بريدك الإلكتروني";
$text['emailsmatch'] = "عنوانا بريديك الإلكتروني لا يتطابقان. يرجي إدخال نفس العنوان في الحقلين";
$text['getdirections'] = "انقر للحصول على التوجيهات";
$text['calendar'] = "تقويم";
//changed in 9.0.0
$text['directionsto'] = " إلى ";
$text['slidestart'] = "عرض شرائح متسلسلة";
$text['livingnote'] = "يوجد على الأقل فرد واحد على قيد الحياة أو ذو خصوصية مرتبط بهذه المعلومة – فتم الحجب";
$text['livingphoto'] = "يوجد على الأقل فرد واحد على قيد الحياة أو ذو خصوصية مرتبط بهذا العنصر – فتم الحجب";
$text['waschristened'] = "تم تعميده";
//added in 10.0.0
$text['branches'] = "فروع";
$text['detail'] = "تقاصيل";
$text['moredetail'] = "مزيد من التفاصيل";
$text['lessdetail'] = "الحد من التفاصيل";
$text['conflds'] = "تأكيد (نصارى LDS)";
$text['initlds'] = "استهلال (نصارى LDS)";
$text['wascremated'] = "تم حرقه";
//moved here in 11.0.0
$text['text_for'] = "لأجل";
//added in 11.0.0
$text['searchsite'] = "ابحث في هذا الموقع";
$text['searchsitemenu'] = "بحث في الموقع";
$text['kmlfile'] = "قم بإنزال ملف .kml لإظهار هذا الموقع في خدمة Google Earth";
$text['download'] = "انقر للإنزال";
$text['more'] = "المزيد";
$text['heatmap'] = "خارطة حرارية";
$text['refreshmap'] = "تحديث الخارطة";
$text['remnums'] = "إزارة الأرقام والدبابيس";
$text['photoshistories'] = "صور وتواريخ ";
$text['familychart'] = "رسمة عائلة";
//added in 12.0.0
$text['firstnames'] = "الأسماء الأولى";
//moved here in 12.0.0
$text['dna_test'] = "اختبار الحامض النووي";
$text['test_type'] = "نوع الاختبار";
$text['test_info'] = "معلومات الاختبار";
$text['takenby'] = "أخذت من قبل";
$text['haplogroup'] = "السلالة العرقية Haplogroup";
$text['hvr1'] = " هيبيرفاريابل المنظقة 1 -HVR1";
$text['hvr2'] = " هيبيرفاريابل المنظقة 2 -HVR2";
$text['relevant_links'] = "روابط ذات العلاقة";
$text['nofirstname'] = "[غياب الاسم الأول]";
//added in 12.0.1
$text['cookieuse'] = "ملاحظة: هذا الموقع يستخدم ملفات تعريف الارتباط (الكوكيز)";
$text['dataprotect'] = "سياسة حماية البيانات";
$text['viewpolicy'] = "إظهار السياسة";
$text['understand'] = "فهمت";
$text['consent'] = "أوافق أن يحتفظ هذا الموقع بالملعلومات الشخصية التي تم جمعها هنا. أدرك بأن من حقي أن أطلب من مالك الموقع إزالة هذه المعلومات في أي وقت";
$text['consentreq'] = "فضلا امنح موافقتك لهذه الموقع لتخزين معلومات شخصية.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "روابط سريعة";
$text['yourname'] = "اسمك";
$text['youremail'] = "عنوان بريدك الإلكتروني";
$text['liketoadd'] = "أي معلومات تريد إضافتها";
$text['webmastermsg'] = "رسالة مشرفي المواقع";
$text['gallery'] = "انظر معرض";
$text['wasborn_male'] = "was born";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "was born"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "was christened";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "was christened";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "died";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "died";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "was buried"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "was buried"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "was cremated";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "was cremated";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "married";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "married";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "was divorced";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "was divorced";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " in ";			// used as a preposition to the location
$text['onthisdate'] = " on ";		// when used with full date
$text['inthisyear'] = " in ";		// when used with year only or month / year dates
$text['and'] = "and ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "معلومات حامض نووي";
//added in 13.0
$text['visitor'] = "زائر";

$text['popupnote2'] = "جدول أنساب جديد";

//moved here in 14.0
$text['zoomin'] = "التكبير";
$text['zoomout'] = "التصغير";
$text['scrollnote'] = "اسحب او مرر لترى اكثر من الخريطة";
$text['general'] = "عام";

//changed in 14.0
$text['otherevents'] = "أحداث وخواص أخرى";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "ارتباطات";
$text['continue'] = "استمرار";
$text['title2'] = "عنوان"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>