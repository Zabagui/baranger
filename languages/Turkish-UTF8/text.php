<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "Tüm Kaynaklara Göz At";
		$text['shorttitle'] = "Kısa Başlık";
		$text['callnum'] = "Arama Numarası";
		$text['author'] = "Yazar";
		$text['publisher'] = "Yayıncı";
		$text['other'] = "Diğer Bilgiler";
		$text['sourceid'] = "Kaynak Kimliği";
		$text['moresrc'] = "Daha fazla kaynak";
		$text['repoid'] = "Depo Kimliği";
		$text['browseallrepos'] = "Tüm Depolara Göz At";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "Yeni dil";
		$text['changelanguage'] = "Dili Değiştir";
		$text['languagesaved'] = "Dil Kaydedildi";
		$text['sitemaint'] = "Site bakımı devam ediyor";
		$text['standby'] = "Veritabanımızı güncellerken site geçici olarak kullanılamıyor. Lütfen birkaç dakika içinde tekrar deneyin. Site uzun süre kapalı kalırsa, lütfen <a href=\"suggest.php\">si̇te sahi̇bi̇ i̇le i̇leti̇şi̇me geçi̇n</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "GEDCOM şundan başlıyor";
		$text['producegedfrom'] = "Şundan bir GEDCOM dosyası üret";
		$text['numgens'] = "Nesillerin sayısı";
		$text['includelds'] = "LDS bilgilerini dahil et";
		$text['buildged'] = "GEDCOM oluştur";
		$text['gedstartfrom'] = "GEDCOM şundan başlıyor";
		$text['nomaxgen'] = "Maksimum nesil sayısını belirtmelisiniz. Lütfen önceki sayfaya dönmek ve hatayı düzeltmek için Geri düğmesini kullanın";
		$text['gedcreatedfrom'] = "GEDCOM şundan oluşturuldu";
		$text['gedcreatedfor'] = "şunun için oluşturuldu:";
		$text['creategedfor'] = "GEDCOM oluştur";
		$text['email'] = "E-Posta adresiniz";
		$text['suggestchange'] = "Bir değişiklik öner";
		$text['yourname'] = "Adınız";
		$text['comments'] = "Önerilen değişikliklerin<br />açıklaması";
		$text['comments2'] = "Yorumlar";
		$text['submitsugg'] = "Öneri Gönder";
		$text['proposed'] = "Önerilen Değişiklik";
		$text['mailsent'] = "Teşekkürler. Mesajınız gönderildi.";
		$text['mailnotsent'] = "Maalesef, mesajınız gönderilemedi. Lütfen xxx ile doğrudan yyy aracılığıyla iletişime geçin.";
		$text['mailme'] = "Bu adrese bir kopyasını gönderin";
		$text['entername'] = "Lütfen adınızı girin";
		$text['entercomments'] = "Lütfen yorumlarınızı girin";
		$text['sendmsg'] = "Mesaj Gönder";
		//added in 9.0.0
		$text['subject'] = "Konu";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "Şunun için Fotoğraflar ve Tarihçeler:";
		$text['indinfofor'] = "Şunun için bireysel bilgi:";
		$text['pp'] = "s."; //page abbreviation
		$text['age'] = "Yaş";
		$text['agency'] = "Kuruluş";
		$text['cause'] = "Sebep";
		$text['suggested'] = "Önerildi";
		$text['closewindow'] = "Bu pencereyi kapat";
		$text['thanks'] = "Teşekkürler";
		$text['received'] = "Öneriniz incelenmek üzere site yöneticisine iletildi.";
		$text['indreport'] = "Bireysel Rapor";
		$text['indreportfor'] = "Şunun İçin Bireysel Rapor:";
		$text['bkmkvis'] = "<strong>Not:</strong> Bu yer imleri sadece bu bilgisayarda ve bu tarayıcıda görünür.";
        //added in 9.0.0
		$text['reviewmsg'] = "İncelemenizi gerektiren bir değişiklik öneriniz var. Bu başvuru şununla ilgilidir:";
        $text['revsubject'] = "Önerilen değişikliğin incelenmesi gerekiyor";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "İlişki Hesaplama";
		$text['findrel'] = "İlişki Bul";
		$text['person1'] = "Kişi 1:";
		$text['person2'] = "Kişi 2:";
		$text['calculate'] = "Hesapla";
		$text['select2inds'] = "Lütfen iki birey seçin.";
		$text['findpersonid'] = "Kişi Kimliği Bul";
		$text['enternamepart'] = "adın ve/veya soyadının bir kısmını girin";
		$text['pleasenamepart'] = "Lütfen ad veya soyadının bir kısmını girin.";
		$text['clicktoselect'] = "seçmek için tıklayın";
		$text['nobirthinfo'] = "Doğum bilgisi yok";
		$text['relateto'] = "Bununla ilişkisi (en alttaki satırda ilişki ifadesi oluşursa, satır sondan başa doğru yorumlanacak):";
		$text['sameperson'] = "İki birey, aynı kişidir.";
		$text['notrelated'] = "İki kişi xxx nesil içinde ilişkili değildir."; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "İki kişi arasındaki ilişkiyi görüntülemek; kişileri bulmak (veya görüntülenen kişileri tutmak) için aşağıdaki 'Bul' düğmelerini kullanın, ardından 'Hesapla'yı tıklayın.";
		$text['sometimes'] = "(Bazen farklı sayıda nesli kontrol etmek farklı bir sonuç verir.)";
		$text['findanother'] = "Başka bir ilişki bul";
		$text['brother'] = "kardeşi<";
		$text['sister'] = "kız kardeşi<";
		$text['sibling'] = "kardeşi<";
		$text['uncle'] = "xxx amcası/dayısı<";
		$text['aunt'] = "xxx teyzesi/halası<";
		$text['uncleaunt'] = "xxx amcası/halası<";
		$text['nephew'] = "xxx erkek yeğeni<";
		$text['niece'] = "xxx kız yeğeni<";
		$text['nephnc'] = "erkek yeğeni/kız yeğeni<";
		$text['removed'] = "nesil yukarıda";
		$text['rhusband'] = "kocası< ";
		$text['rwife'] = "hanımı< ";
		$text['rspouse'] = "eşi< ";
		$text['son'] = "oğlu<";
		$text['daughter'] = "kızı<";
		$text['rchild'] = "çocuğu<";
		$text['sil'] = "damadı<";
		$text['dil'] = "gelini<";
		$text['sdil'] = "damadı veya gelini<";
		$text['gson'] = "xxx torunu<";
		$text['gdau'] = "xxx kız torunu<";
		$text['gsondau'] = "xxx torunu<";
		$text['great'] = "büyük";
		$text['spouses'] = "eşler";
		$text['is'] = "<";
		$text['changeto'] = "Şuna değiştir (Kimliği girin):";
		$text['notvalid'] = "geçerli bir Kişi Kimliği numarası değil veya bu veri tabanında yok. Lütfen tekrar deneyin.";
		$text['halfbrother'] = "üvey erkek kardeşi<";
		$text['halfsister'] = "üvey kız kardeşi<";
		$text['halfsibling'] = "üvey kardeşi<";
		//changed in 8.0.0
		$text['gencheck'] = "Kontrol edilecek maksimum nesiller";
		$text['mcousin'] = "xxx kuzeni yyy<";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx kuzeni yyy<";  //female cousin
		$text['cousin'] = "xxx kuzeni yyy<";
		$text['mhalfcousin'] = "xxx üvey kuzeni yyy<";  //male cousin
		$text['fhalfcousin'] = "xxx üvey kuzeni yyy<";  //female cousin
		$text['halfcousin'] = "xxx üvey kuzeni yyy<";
		//added in 8.0.0
		$text['oneremoved'] = "bir nesil yukarıda";
		$text['gfath'] = "xxx büyükbabası<";
		$text['gmoth'] = "xxx büyükannesi<";
		$text['gpar'] = "xxx büyük ebeveyni<";
		$text['mothof'] = "annesi<";
		$text['fathof'] = "babası<";
		$text['parof'] = "ebeveyni<";
		$text['maxrels'] = "Gösterilecek maksimum ilişkiler";
		$text['dospouses'] = "Eş içeren ilişkileri göster";
		$text['rels'] = "İlişkiler";
		$text['dospouses2'] = "Eşleri göster";
		$text['fil'] = "kayınbabası<";
		$text['mil'] = "kayınvalidesi<";
		$text['fmil'] = "kayınbabası ya da kayınvalidesi<";
		$text['stepson'] = "üvey oğlu<";
		$text['stepdau'] = "üvey kızı<";
		$text['stepchild'] = "üvey çocuğu<";
		$text['stepgson'] = "xxx üvey erkek torunu<";
		$text['stepgdau'] = "xxx üvey kız torunu<";
		$text['stepgchild'] = "xxx üvey torunu<";
		//added in 8.1.1
		$text['ggreat'] = "büyük";
		//added in 8.1.2
		$text['ggfath'] = "xxx nesilden dedesi<";
		$text['ggmoth'] = "xxx nesilden büyükannesi<";
		$text['ggpar'] = "xxx nesilden ebeveyni<";
		$text['ggson'] = "xxx nesilden erkek torunu<";
		$text['ggdau'] = "xxx nesilden kız torunu<";
		$text['ggsondau'] = "xxx nesilden torunu<";
		$text['gstepgson'] = "xxx nesilden üvey erkek torunu<";
		$text['gstepgdau'] = "xxx nesilden üvey kız torunu<";
		$text['gstepgchild'] = "xxx nesilden üvey torunu<";
		$text['guncle'] = "xxx nesilden amcası/dayısı<";
		$text['gaunt'] = "xxx nesilden teyzesi/halası<";
		$text['guncleaunt'] = "xxx nesilden amcası/halası<";
		$text['gnephew'] = "xxx nesilden erkek yeğeni<";
		$text['gniece'] = "xxx nesilden kız yeğeni<";
		$text['gnephnc'] = "xxx nesilden erkek yeğeni/kız yeğeni<";
		//added in 14.0
		$text['pathscalc'] = "Bağlantıları ara";
		$text['findrel2'] = "İlişkileri ve diğer bağlantıları bul";
		$text['makeme2nd'] = "Kimliğimi kullan";
		$text['usebookmarks'] = "Yer imlerini kullan";
		$text['select2inds'] = "Lütfen iki birey seçin.";
		$text['indinfofor'] = "Şunun için bireysel bilgi";
		$text['nobookmarks'] = "Kullanılacak yer imi yok";
		$text['bkmtitle'] = "Yer imlerinde bulunan kişiler";
		$text['bkminfo'] = "Bir kişi seçin:";
		$text['sortpathsby'] = "Yolları sayısına göre sırala";
		$text['sortbyshort'] = "Sıralama ölçütü";
		$text['bylengthshort'] = "Uzunluk";
		$text['badID1'] = ": sahte kişi1 kimliği - lütfen geri dönün ve düzeltin";
		$text['badID2'] = ": sahte kişi2 kimliği - lütfen geri dönün ve düzeltin";
		$text['notintree'] = ": bu kimliğe sahip kişi geçerli ağaç veritabanında değil.";
		$text['sameperson'] = "İki birey, aynı kişidir.";;
		$text['nopaths'] = "Bu kişiler bağlı değil.";
		$text['nopaths1'] = "xxx hariç daha kısa bağlantı yok";
		$text['nopaths2'] = "xxx arama adımlarında";
		$text['longestpath'] = "(şimdiye kadar kontrol edilen en uzun yol xxx adım uzunluğundaydı)";
		$text['relevantpaths'] = "Bulunan farklı ilgili yolların sayısı: xxx";
		$text['skipMarr'] = "(ayrıca, çok fazla evlilik nedeniyle bulunan ancak görüntülenemeyen yolların sayısı: xxx)";
		$text['mjaor'] = "veya";
		$text['connectionsto'] = "Bağlantılar ";
		$text['findanotherpers'] = "Başka bir kişi bul...";
		$text['sometimes'] = "(Bazen farklı sayıda nesli kontrol etmek farklı bir sonuç verir.)";
		$text['anotherpath'] = "Diğer bağlantıları ara";
		$text['xpath'] = "Yol ";
		$text['primary'] = "Başlangıç ​​Kişisi"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "Son Kişi";
		$text['parent'] = "Ebeveyn";
		$text['mhfather'] = "his father";
		$text['mhmother'] = "his mother";
		$text['mhhusband'] = "his husband";
		$text['mhwife'] = "his wife";
		$text['mhson'] = "his son";
		$text['mhdaughter'] = "his daughter";
		$text['fhfather'] = "her father";
		$text['fhmother'] = "her mother";
		$text['fhhusband'] = "her husband";
		$text['fhwife'] = "her wife";
		$text['fhson'] = "her son";
		$text['fhdaughter'] = "her daughter";
		$text['hfather'] = "baba";
		$text['hmother'] = "anne";
		$text['hhusband'] = "koca";
		$text['hwife'] = "eş";
		$text['hson'] = "oğul";
		$text['hdaughter'] = "kız";
		$text['maxruns'] = "Kontrol edilecek maksimum yol sayısı";
		$text['maxrshort'] = "Maksimum yollar";
		$text['maxlength'] = "Bağlantı yolları şundan uzun değil";
		$text['maxlshort'] = "Maksimum uzunluk";
		$text['xstep'] = "adım";
		$text['xsteps'] = "adımlar";
		$text['xmarriages'] = "xxx evlilik";
		$text['xmarriage'] = "1 evlilik";
		$text['showspouses'] = "Her iki eşi de göster";
		$text['showTxt'] = "Metin yolu açıklamasını göster";
		$text['showTxtshort'] = "Metin açıklaması";
		$text['compactBox'] = "Sıkıştırılmış kişi kutularını göster";
		$text['compactBoxshort'] = "Kompakt kutular";
		$text['paths'] = "Yollar";
		$text['dospouses2'] = "Eşleri göster";
		$text['maxmopt'] = "Bağlantı başına maksimum evlilik";
		$text['maxm'] = "Maksimum evlilik";
		$text['arerelated'] = "Bu kişiler akrabadır - ilişkileri Yol 1'de gösterilmektedir";
		$text['simplerel'] = "Basit ilişki arama";
		break;

	case "familygroup":
		$text['familygroupfor'] = "Şunun İçin Aile Grubu Sayfası:";
		$text['ldsords'] = "LDS Yönetmelikleri";
		$text['baptizedlds'] = "Vaftiz Edilen (LDS)";
		$text['endowedlds'] = "Bağışlanan (LDS)";
		$text['sealedplds'] = "Ebeveynlere Mühürlü (LDS)";
		$text['sealedslds'] = "Eşe Mühürlü (LDS)";
		$text['otherspouse'] = "Diğer Eş";
		$text['husband'] = "Baba";
		$text['wife'] = "Anne";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "Doğdu";
		$text['capaltbirthabbr'] = "Alternatif Doğum";
		$text['capdeathabbr'] = "Vefat Etti";
		$text['capburialabbr'] = "Defnedildi";
		$text['capplaceabbr'] = "Yer";
		$text['capmarrabbr'] = "Evlendi";
		$text['capspouseabbr'] = "EŞ";
		$text['redraw'] = "Yeniden çiz";
		$text['unknownlit'] = "Bilinmeyen";
		$text['popupnote1'] = "Ek bilgiler";
		$text['pedcompact'] = "Kompakt";
		$text['pedstandard'] = "Standart";
		$text['pedtextonly'] = "Metin";
		$text['descendfor'] = "Soyundan";
		$text['maxof'] = "Maksimum";
		$text['gensatonce'] = "tek seferde görüntülenen nesiller.";
		$text['sonof'] = "oğlu←";
		$text['daughterof'] = "kızı←";
		$text['childof'] = "çocuğu←";
		$text['stdformat'] = "Standart Biçim";
		$text['ahnentafel'] = "Soyağacı Tablosu";
		$text['addnewfam'] = "Yeni Aile Ekle";
		$text['editfam'] = "Aileyi Düzenle";
		$text['side'] = "Tarafı";
		$text['familyof'] = "Ailesi";
		$text['paternal'] = "Baba tarafı";
		$text['maternal'] = "Anne tarafı";
		$text['gen1'] = "Kendi";
		$text['gen2'] = "Ebeveynler";
		$text['gen3'] = "Büyük Ebeveynler";
		$text['gen4'] = "Büyük Büyük Ebeveynler";
		$text['gen5'] = "2. Büyük Büyük Ebeveynler";
		$text['gen6'] = "3. Büyük Büyük Ebeveynler";
		$text['gen7'] = "4. Büyük Büyük Ebeveynler";
		$text['gen8'] = "5. Büyük Büyük Ebeveynler";
		$text['gen9'] = "6. Büyük Büyük Ebeveynler";
		$text['gen10'] = "7. Büyük Büyük Ebeveynler";
		$text['gen11'] = "8. Büyük Büyük Ebeveynler";
		$text['gen12'] = "9. Büyük Büyük Ebeveynler";
		$text['graphdesc'] = "Bu noktaya kadar olan soyağacı tablosu";
		$text['pedbox'] = "Kutu";
		$text['regformat'] = "Kayıt";
		$text['extrasexpl'] = "= Bu kişi için en az bir fotoğraf, tarihçe veya başka bir medya öğesi var.";
		$text['popupnote3'] = "Yeni grafik";
		$text['mediaavail'] = "Medya Kullanılabilir";
		$text['pedigreefor'] = "Şunun İçin Soyağacı Grafiği";
		$text['pedigreech'] = "Soyağacı Grafiği";
		$text['datesloc'] = "Tarihler ve Konumlar";
		$text['borchr'] = "Doğum/Alternatif Doğum - Vefat/Defin";
		$text['nobd'] = "Doğum veya Vefat Tarihleri Yok";
		$text['bcdb'] = "Tüm Doğum/Alternatif Doğum/Vefat/Defin verileri";
		$text['numsys'] = "Numaralandırma Sistemi";
		$text['gennums'] = "Nesil Numaralandırması";
		$text['henrynums'] = "Henry Numaralandırması";
		$text['abovnums'] = "d'Aboville Numaralandırması";
		$text['devnums'] = "de Villiers Numaralandırması";
		$text['dispopts'] = "Görüntüleme Seçenekleri";
		//added in 10.0.0
		$text['no_ancestors'] = "Ata bulunamadı";
		$text['ancestor_chart'] = "Dikey ata grafiği";
		$text['opennewwindow'] = "Yeni pencerede aç";
		$text['pedvertical'] = "Dikey";
		//added in 11.0.0
		$text['familywith'] = "Aile ile";
		$text['fcmlogin'] = "Ayrıntıları görmek için lütfen giriş yapın";
		$text['isthe'] = "bu";
		$text['otherspouses'] = "diğer eşler";
		$text['parentfamily'] = "Ebeveyn ailesi ";
		$text['showfamily'] = "Aileyi göster";
		$text['shown'] = "gösterilen";
		$text['showparentfamily'] = "ebeveyn ailesini göster";
		$text['showperson'] = "kişiyi göster";
		//added in 11.0.2
		$text['otherfamilies'] = "Diğer aileler";
		//added in 14.0
		$text['dtformat'] = "Tablolar";
		$text['dtchildren'] = "Çocuklar";
		$text['dtgrandchildren'] = "Torunlar";
		$text['dtggrandchildren'] = "Torunun çocuğu";
		$text['dtgggrandchildren'] = "Torunun çocuğu"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "Soyundan gelen yok";
		$text['dtgen'] = "Kuşak";
		$text['dttotal'] = "Toplam";
		$text['dtselect'] = "Seç";
		$text['dteachfulltable'] = "Her tam tablo sahip olacak";
		$text['dtrows'] = "satırlar";
		$text['dtdisplayingtable'] = "Tablo görüntüleme";
		$text['dtgototable'] = "Tabloya git:";
		$text['fcinstrdn'] = "Aileyi eşiyle göster";
		$text['fcinstrup'] = "Aileyi ebeveynleriyle göster";
		$text['fcinstrplus'] = "Diğer eşleri seç";
		$text['fcinstrfam'] = "Diğer ebeveynleri seç";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "Rapor yok.";
		$text['reportname'] = "Rapor Adı";
		$text['allreports'] = "Tüm Raporlar";
		$text['report'] = "Rapor";
		$text['error'] = "Hata";
		$text['reportsyntax'] = "Bu raporla çalıştırılan sorgunun sözdizimi";
		$text['wasincorrect'] = "yanlıştı ve sonuç olarak rapor çalıştırılamadı. Lütfen adresinden sistem yöneticisi ile iletişime geçin";
		$text['errormessage'] = "Hata Mesajı";
		$text['equals'] = "şuna eşit→";
		$text['endswith'] = "şununla biten→";
		$text['soundexof'] = "şununla aynı söyleyişi olan→";
		$text['metaphoneof'] = "şununla benzer söyleyişi olan→";
		$text['plusminus10'] = "+/- 10 yıl→";
		$text['lessthan'] = "şundan daha küçük→";
		$text['greaterthan'] = "şundan daha büyük→";
		$text['lessthanequal'] = "şuna eşit veya daha küçük→";
		$text['greaterthanequal'] = "şuna eşit veya daha büyük→";
		$text['equalto'] = "şuna eşit→";
		$text['tryagain'] = "Lütfen tekrar deneyin";
		$text['joinwith'] = "Şununla birleştir→";
		$text['cap_and'] = "VE";
		$text['cap_or'] = "VEYA";
		$text['showspouse'] = "Eşini göster (kişinin birden fazla eşi varsa tekrarlananları gösterecektir)";
		$text['submitquery'] = "Sorgu Gönder";
		$text['birthplace'] = "Doğum Yeri";
		$text['deathplace'] = "Vefat Yeri";
		$text['birthdatetr'] = "Doğum Yılı";
		$text['deathdatetr'] = "Vefat Yılı";
		$text['plusminus2'] = "+/- 2 yıl→";
		$text['resetall'] = "Tüm Değerleri Sıfırla";
		$text['showdeath'] = "Vefat/defin bilgilerini göster";
		$text['altbirthplace'] = "Ad Verme Yeri";
		$text['altbirthdatetr'] = "Ad Verme Yılı";
		$text['burialplace'] = "Defin Yeri";
		$text['burialdatetr'] = "Defin Yılı";
		$text['event'] = "Etkinlik";
		$text['day'] = "Gün";
		$text['month'] = "Ay";
		$text['keyword'] = "Anahtar Kelime (örn. \"May\")";
		$text['explain'] = "Eşleşen etkinlikleri görmek için tarih bileşenlerini girin. Tüm eşleşmeleri görmek için bir alanı boş bırakın.";
		$text['enterdate'] = "Lütfen aşağıdakilerden en az birini girin veya seçin: Gün, Ay, Yıl, Anahtar Kelime";
		$text['fullname'] = "Tam Adı";
		$text['birthdate'] = "Doğum Tarihi";
		$text['altbirthdate'] = "Ad Verme Tarihi";
		$text['marrdate'] = "Evlilik Tarihi";
		$text['spouseid'] = "Eşin Kimliği";
		$text['spousename'] = "Eşin Adı";
		$text['deathdate'] = "Vefat Tarihi";
		$text['burialdate'] = "Defin Tarihi";
		$text['changedate'] = "Son Değiştirilme Tarihi";
		$text['gedcom'] = "Ağaç";
		$text['baptdate'] = "Vaftiz Tarihi (LDS)";
		$text['baptplace'] = "Vaftiz Yeri (LDS)";
		$text['endldate'] = "Bağış Tarihi (LDS)";
		$text['endlplace'] = "Bağış Yeri (LDS)";
		$text['ssealdate'] = "Mühür Tarihi S (LDS)";   //Sealed to spouse
		$text['ssealplace'] = "Mühür Yeri S (LDS)";
		$text['psealdate'] = "Mühür Tarihi P (LDS)";   //Sealed to parents
		$text['psealplace'] = "Mühür Yeri P (LDS)";
		$text['marrplace'] = "Evlilik Yeri";
		$text['spousesurname'] = "Eşin Soyadı";
		$text['spousemore'] = "Eşin Soyadı için bir değer girerseniz, bir Cinsiyet seçmelisiniz.";
		$text['plusminus5'] = "+/- 5 yıl→";
		$text['exists'] = "var";
		$text['dnexist'] = "yok";
		$text['divdate'] = "Boşanma Tarihi";
		$text['divplace'] = "Boşanma Yeri";
		$text['otherevents'] = "Diğer Arama Kriterleri";
		$text['numresults'] = "Sayfa başına sonuçlar";
		$text['mysphoto'] = "Gizemli Fotoğraflar";
		$text['mysperson'] = "Anlaşılması Zor İnsanlar";
		$text['joinor'] = "'VEYA ile birleştir' seçeneği Eşin Soyadı ile kullanılamaz";
		$text['tellus'] = "Bize bildiklerini söyle";
		$text['moreinfo'] = "Daha fazla bilgi:";
		//added in 8.0.0
		$text['marrdatetr'] = "Evlilik Yılı";
		$text['divdatetr'] = "Boşanma Yılı";
		$text['mothername'] = "Annenin Adı";
		$text['fathername'] = "Babanın Adı";
		$text['filter'] = "Filtre";
		$text['notliving'] = "Yaşamayanlar";
		$text['nodayevents'] = "Bu ay için belirli bir günle ilişkili olmayan etkinlikler:";
		//added in 9.0.0
		$text['csv'] = "Virgülle ayrılmış CSV dosyası";
		//added in 10.0.0
		$text['confdate'] = "Onay Tarihi (LDS)";
		$text['confplace'] = "Onay Yeri (LDS)";
		$text['initdate'] = "Başlatma Tarihi (LDS)";
		$text['initplace'] = "Başlatma Yeri (LDS)";
		//added in 11.0.0
		$text['marrtype'] = "Evlilik Türü";
		$text['searchfor'] = "Ara";
		$text['searchnote'] = "Not: Bu sayfa arama yapmak için Google'ı kullanmaktadır. Döndürülen eşleşme sayısı, Google'ın siteyi ne ölçüde dizine ekleyebildiğinden doğrudan etkilenecektir.";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "Şunun için günlük dosyası";
		$text['mostrecentactions'] = "En Son Eylemler";
		$text['autorefresh'] = "Otomatik Yenileme (30 saniye)";
		$text['refreshoff'] = "Otomatik Yenilemeyi Kapat";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "Mezarlıklar ve Mezar Taşları";
		$text['showallhsr'] = "Tüm mezar taşı kayıtlarını göster";
		$text['in'] = ".";
		$text['showmap'] = "Haritayı göster";
		$text['headstonefor'] = "Şunun için mezar taşı";
		$text['photoof'] = "Fotoğrafı";
		$text['photoowner'] = "Orijinalin sahibi";
		$text['nocemetery'] = "Mezarlık Yok";
		$text['iptc005'] = "Başlık";
		$text['iptc020'] = "Ek Kategoriler";
		$text['iptc040'] = "Özel Talimatlar";
		$text['iptc055'] = "Oluşturulma Tarihi";
		$text['iptc080'] = "Yazar";
		$text['iptc085'] = "Yazarın Pozisyonu";
		$text['iptc090'] = "Şehir";
		$text['iptc095'] = "Eyalet/İl";
		$text['iptc101'] = "Ülke";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "Manşet";
		$text['iptc110'] = "Kaynak";
		$text['iptc115'] = "Fotoğraf Kaynağı";
		$text['iptc116'] = "Telif Hakkı Bildirimi";
		$text['iptc120'] = "Başlık";
		$text['iptc122'] = "Başlık Yazarı";
		$text['mapof'] = "Harita";
		$text['regphotos'] = "Açıklayıcı Görünüm";
		$text['gallery'] = "Sadece Minik Resimler";
		$text['cemphotos'] = "Mezarlık Fotoğrafları";
		$text['photosize'] = "Boyutlar";
        $text['iptc010'] = "Öncelik";
		$text['filesize'] = "Dosya Boyutu";
		$text['seeloc'] = "Konumu Gör";
		$text['showall'] = "Tümünü Göster";
		$text['editmedia'] = "Medyayı Düzenle";
		$text['viewitem'] = "Bu öğeyi görüntüle";
		$text['editcem'] = "Mezarlığı Düzenle";
		$text['numitems'] = "# Öğeler";
		$text['allalbums'] = "Tüm Albümler";
		$text['slidestop'] = "Slayt Gösterisini Duraklat";
		$text['slideresume'] = "Slayt Gösterisini Sürdür";
		$text['slidesecs'] = "Her slayt için saniye:";
		$text['minussecs'] = "eksi 0,5 saniye";
		$text['plussecs'] = "artı 0,5 saniye";
		$text['nocountry'] = "Bilinmeyen ülke";
		$text['nostate'] = "Bilinmeyen eyalet";
		$text['nocounty'] = "Bilinmeyen ilçe";
		$text['nocity'] = "Bilinmeyen şehir";
		$text['nocemname'] = "Bilinmeyen mezarlık adı";
		$text['editalbum'] = "Albümü Düzenle";
		$text['mediamaptext'] = "<strong>Not:</strong> Adları göstermek için fare işaretçinizi resmin üzerine getirin. Her ad için bir sayfa görmek üzere tıklayın.";
		//added in 8.0.0
		$text['allburials'] = "Tüm Definler";
		$text['moreinfo'] = "Bu resim hakkında daha fazla bilgi için tıklayın";
		//added in 9.0.0
        $text['iptc025'] = "Anahtar Kelimeler";
        $text['iptc092'] = "Alt konum";
		$text['iptc015'] = "Kategori";
		$text['iptc065'] = "Kaynak Program";
		$text['iptc070'] = "Program Sürümü";
		//added in 13.0
		$text['toggletags'] = "Etiketleri Değiştir";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "Bu harflerle başlayan soyadları göster:";
		$text['showtop'] = "Zirveyi göster:";
		$text['showallsurnames'] = "Tüm soyadlarını göster";
		$text['sortedalpha'] = "alfabetik olarak sıralanmış";
		$text['byoccurrence'] = "oluşumuna göre sıralanmış";
		$text['firstchars'] = "İlk karakterler";
		$text['mainsurnamepage'] = "Ana soyadı sayfası";
		$text['allsurnames'] = "Tüm Soyadları";
		$text['showmatchingsurnames'] = "Eşleşen kayıtları göstermek için bir soyadına tıklayın.";
		$text['backtotop'] = "Başa dön";
		$text['beginswith'] = "şununla başlayan→";
		$text['allbeginningwith'] = "Bu harflerle başlayan tüm soyadları:";
		$text['numoccurrences'] = "parantez içindeki toplam yerleşim yeri sayısı";
		$text['placesstarting'] = "Bu harflerle başlayan en büyük yerleşim yerlerini göster:";
		$text['showmatchingplaces'] = "Daha küçük yerleşim yerlerini göstermek için bir yere tıklayın. Eşleşen bireyleri göstermek için arama simgesine tıklayın.";
		$text['totalnames'] = "toplam bireyler";
		$text['showallplaces'] = "Tüm en büyük yerleşim yerlerini göster";
		$text['totalplaces'] = "toplam yerler";
		$text['mainplacepage'] = "Ana yerler sayfası";
		$text['allplaces'] = "Tüm En Büyük Yerleşim Yerleri";
		$text['placescont'] = "Şunu içeren tüm yerleri göster";
		//changed in 8.0.0
		$text['top30'] = "Zirvedeki xxx soyadı";
		$text['top30places'] = "Zirvedeki xxx büyük yerleşim yeri";
		//added in 12.0.0
		$text['firstnamelist'] = "Ad Listesi";
		$text['firstnamesstarting'] = "Bu harflerle başlayan adları göster:";
		$text['showallfirstnames'] = "Tüm adları göster";
		$text['mainfirstnamepage'] = "Ana ad sayfası";
		$text['allfirstnames'] = "Tüm Adlar";
		$text['showmatchingfirstnames'] = "Eşleşen kayıtları göstermek için bir ad üzerine tıklayın.";
		$text['allfirstbegwith'] = "Bu harflerle başlayan tüm adlar:";
		$text['top30first'] = "Zirvedeki xxx ad";
		$text['allothers'] = "Tüm diğerleri";
		$text['amongall'] = "(tüm adlar arasında)";
		$text['justtop'] = "Sadece zirvedeki xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(son xx gün)";

		$text['photo'] = "Fotoğraf";
		$text['history'] = "Tarihçe/Belge";
		$text['husbid'] = "Baba Kimliği";
		$text['husbname'] = "Babanın Adı";
		$text['wifeid'] = "Anne Kimliği";
		//added in 11.0.0
		$text['wifename'] = "Annenin Adı";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "Sil";
		$text['addperson'] = "Kişi Ekle";
		$text['nobirth'] = "Şu kişinin geçerli bir doğum tarihi yok ve eklenemedi";
		$text['event'] = "Etkinlik(ler)";
		$text['chartwidth'] = "Grafik genişliği";
		$text['timelineinstr'] = "İnsanları Ekle";
		$text['togglelines'] = "Satırları Değiştir";
		//changed in 9.0.0
		$text['noliving'] = "Şu kişi yaşayan veya özel olarak işaretlendi ve uygun izinlerle giriş yapmadığınız için eklenemedi";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "Tüm Ağaçlara Göz At";
		$text['treename'] = "Ağaç Adı";
		$text['owner'] = "Sahibi";
		$text['address'] = "Adres";
		$text['city'] = "Şehir";
		$text['state'] = "Eyalet/İl";
		$text['zip'] = "Posta/Posta Kodu";
		$text['country'] = "Ülke";
		$text['email'] = "E-posta";
		$text['phone'] = "Telefon";
		$text['username'] = "Kullanıcı adı";
		$text['password'] = "Şifre";
		$text['loginfailed'] = "Giriş başarısız.";

		$text['regnewacct'] = "Yeni Kullanıcı Hesabı İçin Kaydolun";
		$text['realname'] = "Gerçek Adın";
		$text['phone'] = "Telefon";
		$text['email'] = "E-posta";
		$text['address'] = "Adres";
		$text['acctcomments'] = "Notlar veya Yorumlar";
		$text['submit'] = "Gönder";
		$text['leaveblank'] = "(yeni bir ağaç isteniyorsa boş bırakın)";
		$text['required'] = "Zorunlu alanlar";
		$text['enterpassword'] = "Lütfen bir şifre girin.";
		$text['enterusername'] = "Lütfen bir kullanıcı adı girin.";
		$text['failure'] = "Üzgünüz, ancak girdiğiniz kullanıcı adı zaten kullanılıyor. Bir önceki sayfaya dönmek için lütfen tarayıcınızdaki Geri düğmesini kullanın ve farklı bir kullanıcı adı seçin.";
		$text['success'] = "Teşekkürler. Kaydınızı aldık. Hesabınız etkin olduğunda veya daha fazla bilgiye ihtiyaç duyulduğunda sizinle iletişime geçeceğiz.";
		$text['emailsubject'] = "Yeni TNG kullanıcı kaydı isteği";
		$text['website'] = "İnternet Sitesi";
		$text['nologin'] = "Girişiniz yok mu?";
		$text['loginsent'] = "Giriş bilgileri gönderildi";
		$text['loginnotsent'] = "Giriş bilgileri gönderilmedi";
		$text['enterrealname'] = "Lütfen gerçek adınızı girin.";
		$text['rempass'] = "Bu bilgisayarda kayıtlı kal";
		$text['morestats'] = "Daha fazla istatistik";
		$text['accmail'] = "<strong>NOT:</strong> Site yöneticisinden hesabınızla ilgili posta almak için lütfen bu alan adından gelen postaları engellemediğinizden emin olun.";
		$text['newpassword'] = "Yeni şifre";
		$text['resetpass'] = "Şifrenizi sıfırlayın";
		$text['nousers'] = "Bu form, en az bir kullanıcı kaydı bulunana kadar kullanılamaz. Site sahibiyseniz, Yönetici hesabınızı oluşturmak için lütfen Yönetici/Kullanıcılar bölümüne gidin.";
		$text['noregs'] = "Üzgünüz, ancak şu anda yeni kullanıcı kayıtlarını kabul etmiyoruz. Bu sitedeki herhangi bir şeyle ilgili yorumlarınız veya sorularınız varsa lütfen doğrudan <a href=\"suggest.php\">bizimle iletişime geçin</a>.";
		$text['emailmsg'] = "Bir TNG kullanıcı hesabı için yeni bir istek aldınız. Lütfen TNG Yönetici alanınıza giriş yapın ve bu yeni hesaba uygun izinleri atayın.";
		$text['accactive'] = "Hesap etkinleştirildi, ancak kullanıcı, siz onları atayana kadar hiçbir özel hakka sahip olmayacak.";
		$text['accinactive'] = "Hesap ayarlarına erişmek için Yönetici/Kullanıcılar/İncele sekmesine gidin. Siz kaydı en az bir kez düzenleyip kaydedene kadar hesap etkin olmayacaktır.";
		$text['pwdagain'] = "Tekrar şifre";
		$text['enterpassword2'] = "Lütfen şifrenizi tekrar girin.";
		$text['pwdsmatch'] = "Şifreleriniz uyuşmuyor. Lütfen her alana aynı şifreyi girin.";
		$text['acksubject'] = "Kayıt olduğunuz için teşekkürler"; //for a new user account
		$text['ackmessage'] = "Bir kullanıcı hesabı isteğiniz alındı. Hesabınız site yöneticisi tarafından incelenene kadar etkin olmayacaktır. Giriş bilgileriniz kullanıma hazır olduğunda e-posta ile bilgilendirileceksiniz.";
		//added in 12.0.0
		$text['switch'] = "Değişim";
		//added in 14.0
		$text['newpassword2'] = "Tekrar yeni şifre";
		$text['resetsuccess'] = "Başarılı: Şifre sıfırlandı";
		$text['resetfail'] = "Başarısız: Şifre sıfırlanamadı";
		$text['failreason0'] = " (bilinmeyen veritabanı hatası)";
		$text['failreason2'] = " (şifrenizi değiştirme izniniz yok)";
		$text['failreason3'] = " (şifreler eşleşmedi)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "Tüm Şubelere Göz At";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "Miktar";
		$text['totindividuals'] = "Toplam Bireyler";
		$text['totmales'] = "Toplam Erkekler";
		$text['totfemales'] = "Toplam Kadınlar";
		$text['totunknown'] = "Toplam Bilinmeyen Cinsiyet";
		$text['totliving'] = "Toplam Yaşayanlar";
		$text['totfamilies'] = "Toplam Aileler";
		$text['totuniquesn'] = "Toplam Benzersiz Soyadları";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "Toplam Kaynaklar";
		$text['avglifespan'] = "Ortalama Ömür";
		$text['earliestbirth'] = "En Erken Doğum";
		$text['longestlived'] = "En Uzun Ömürlü";
		$text['days'] = "gün";
		$text['age'] = "Yaş";
		$text['agedisclaimer'] = "Yaşa bağlı hesaplamalar, kayıtlı doğum <em>ve</em> vefat tarihlerine sahip bireylere dayanmaktadır. Eksik tarih alanlarının (örneğin, yalnızca \"1945\" veya \"1860 ÖNCESİ\" olarak listelenen bir vefat tarihi) bulunması nedeniyle, bu hesaplamalar %100 doğru olamaz.";
		$text['treedetail'] = "Bu ağaç hakkında daha fazla bilgi";
		$text['total'] = "Toplam";
		//added in 12.0
		$text['totdeceased'] = "Toplam Vefat Edenler";
		//added in 14.0
		$text['totalsourcecitations'] = "Toplam Kaynak Alıntıları";
		break;

	case "notes":
		$text['browseallnotes'] = "Tüm Notlara Göz At";
		break;

	case "help":
		$text['menuhelp'] = "Menü Tuşu";
		break;

	case "install":
		$text['perms'] = "İzinlerin tümü ayarlandı.";
		$text['noperms'] = "Bu dosyalar için izinler ayarlanamadı:";
		$text['manual'] = "Lütfen bunları manuel olarak ayarlayın.";
		$text['folder'] = "Klasör";
		$text['created'] = "oluşturuldu";
		$text['nocreate'] = "oluşturulamadı. Lütfen manuel olarak oluşturun.";
		$text['infosaved'] = "Bilgiler kaydedildi, bağlantı doğrulandı!";
		$text['tablescr'] = "Tablolar oluşturuldu!";
		$text['notables'] = "Aşağıdaki tablolar oluşturulamadı:";
		$text['nocomm'] = "TNG veritabanınızla iletişim kuramıyor. Hiçbir tablo oluşturulmadı.";
		$text['newdb'] = "Bilgiler kaydedildi, bağlantı doğrulandı, yeni veritabanı oluşturuldu:";
		$text['noattach'] = "Bilgiler kaydedildi. Bağlantı yapıldı ve veritabanı oluşturuldu, ancak TNG buna eklenemiyor.";
		$text['nodb'] = "Bilgiler kaydedildi. Bağlantı yapıldı, ancak veritabanı mevcut değil ve burada oluşturulamadı. Lütfen veritabanı adının doğru olduğunu ve veritabanı kullanıcısının uygun erişime sahip olduğunu doğrulayın veya oluşturmak için kontrol panelinizi kullanın.";
		$text['noconn'] = "Bilgiler kaydedildi ancak bağlantı başarısız oldu. Aşağıdakilerden biri veya daha fazlası yanlış:";
		$text['exists'] = "zaten var.";
		$text['noop'] = "Hiçbir işlem gerçekleştirilmedi.";
		//added in 8.0.0
		$text['nouser'] = "Kullanıcı oluşturulmadı. Kullanıcı adı zaten mevcut olabilir.";
		$text['notree'] = "Ağaç oluşturulmadı. Ağaç kimliği zaten mevcut olabilir.";
		$text['infosaved2'] = "Bilgiler kaydedildi";
		$text['renamedto'] = "yeniden adlandırıldı";
		$text['norename'] = "yeniden adlandırılamadı";
		//changed in 13.0.0
		$text['loginfirst'] = "Varolan kullanıcı kayıtları algılandı. Devam etmek için önce giriş yapmanız veya tüm kayıtları kullanıcılar tablosundan kaldırmanız gerekir.";
		break;

	case "imgviewer":
		$text['magmode'] = "Büyütme Modu";
		$text['panmode'] = "Kaydırma Modu";
		$text['pan'] = "Resmin içinde hareket etmek için tıklayın ve sürükleyin";
		$text['fitwidth'] = "Genişliğe Sığdır";
		$text['fitheight'] = "Yüksekliğe Sığdır";
		$text['newwin'] = "Yeni Pencere";
		$text['opennw'] = "Resmi yeni pencerede aç";
		$text['magnifyreg'] = "Resmin bir bölgesini büyütmek için tıklayın";
		$text['imgctrls'] = "Görüntü Kontrollerini Etkinleştir";
		$text['vwrctrls'] = "Resim Görüntüleyici Kontrollerini Etkinleştir";
		$text['vwrclose'] = "Resim Görüntüleyiciyi Kapat";
		break;

	case "dna":
		$text['test_date'] = "Test tarihi";
		$text['links'] = "İlgili bağlantılar";
		$text['testid'] = "Test Kimliği";
		//added in 12.0.0
		$text['mode_values'] = "Mod Değerleri";
		$text['compareselected'] = "Seçileni Karşılaştır";
		$text['dnatestscompare'] = "Y-DNA Testlerini Karşılaştır";
		$text['keep_name_private'] = "Adı Özel Tut";
		$text['browsealltests'] = "Tüm Testlere Göz At";
		$text['all_dna_tests'] = "Tüm DNA testleri";
		$text['fastmutating'] = "Hızlı&nbsp;Mutasyon";
		$text['alltypes'] = "Tüm Türler";
		$text['allgroups'] = "Tüm Gruplar";
		$text['Ydna_LITbox_info'] = "Bu kişiyle bağlantılı test(ler) mutlaka bu kişi tarafından alınmamıştır.<br />'Haplogroup' sütunu; sonuç 'Öngörülen' ise verileri kırmızı renkte veya test 'Onaylanan' ise yeşil renkte görüntüler";
		//added in 12.1.0
		$text['dnatestscompare_mtdna'] = "Seçilen mtDNA Testlerini Karşılaştır";
		$text['dnatestscompare_atdna'] = "Seçilen atDNA Testlerini Karşılaştır";
		$text['chromosome'] = "Chr";
		$text['centiMorgans'] = "cM";
		$text['snps'] = "SNP'ler";
		$text['y_haplogroup'] = "Y-DNA";
		$text['mt_haplogroup'] = "mtDNA";
		$text['sequence'] = "Ref";
		$text['extra_mutations'] = "Ekstra Mutasyonlar";
		$text['mrca'] = "MRC Atası";
		$text['ydna_test'] = "Y-DNA Testleri";
		$text['mtdna_test'] = "mtDNA (Mitokondriyal) Testleri";
		$text['atdna_test'] = "atDNA (otozomal) Testleri";
		$text['segment_start'] = "Başlat";
		$text['segment_end'] = "Sonlandır";
		$text['suggested_relationship'] = "Önerildi";
		$text['actual_relationship'] = "Gerçek";
		$text['12markers'] = "İşaretleyiciler 1-12";
		$text['25markers'] = "İşaretleyiciler 13-25";
		$text['37markers'] = "İşaretleyiciler 26-37";
		$text['67markers'] = "İşaretleyiciler 38-67";
		$text['111markers'] = "İşaretleyiciler 68-111";
		//added in 13.1
		$text['comparemore'] = "Karşılaştırma için en az iki test seçilmelidir.";
		break;
}

//common
$text['matches'] = "Eşleştirmeler";
$text['description'] = "Açıklama";
$text['notes'] = "Notlar";
$text['status'] = "Durum";
$text['newsearch'] = "Yeni Arama";
$text['pedigree'] = "Soyağacı";
$text['seephoto'] = "Fotoğrafa bakın";
$text['andlocation'] = "&amp; konum";
$text['accessedby'] = "tarafından erişilen";
$text['children'] = "Çocuklar";  //from getperson
$text['tree'] = "Ağaç";
$text['alltrees'] = "Tüm Ağaçlar";
$text['nosurname'] = "[soyadı yok]";
$text['thumb'] = "Minik resim";  //as in Thumbnail
$text['people'] = "İnsanlar";
$text['title'] = "Unvan";  //from getperson
$text['suffix'] = "Sonek";  //from getperson
$text['nickname'] = "Lakap";  //from getperson
$text['lastmodified'] = "Son Değişiklik";  //from getperson
$text['married'] = "Evlendi";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "Ad"; //from showmap
$text['lastfirst'] = "Soyadı, Adı";  //from search
$text['bornchr'] = "Doğum/Ad Verildi";  //from search
$text['individuals'] = "Bireyler";  //from whats new
$text['families'] = "Aileler";
$text['personid'] = "Kişi Kimliği";
$text['sources'] = "Kaynaklar";  //from getperson (next several)
$text['unknown'] = "Bilinmeyen";
$text['father'] = "Baba";
$text['mother'] = "Anne";
$text['christened'] = "Ad Verildi";
$text['died'] = "Vefat Etti";
$text['buried'] = "Defnedildi";
$text['spouse'] = "Eş";  //from search
$text['parents'] = "Ebeveynler";  //from pedigree
$text['text'] = "Metin";  //from sources
$text['language'] = "Dil";  //from languages
$text['descendchart'] = "Soyu";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "Birey";
$text['edit'] = "Düzenle";
$text['date'] = "Tarih";
$text['login'] = "Giriş";
$text['logout'] = "Çıkış";
$text['groupsheet'] = "Aile Grubu Sayfası";
$text['text_and'] = "ve";
$text['generation'] = "Nesil";
$text['filename'] = "Dosya adı";
$text['id'] = "Kimlik";
$text['search'] = "Ara";
$text['user'] = "Kullanıcı";
$text['firstname'] = "Adı";
$text['lastname'] = "Soyadı";
$text['searchresults'] = "Arama Sonuçları";
$text['diedburied'] = "Vefat Etti/Defnedildi";
$text['homepage'] = "Ana Sayfa";
$text['find'] = "Bul...";
$text['relationship'] = "İlişki";		//in German, Verwandtschaft
$text['relationship2'] = "İlişki"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "Zaman Çizelgesi";
$text['yesabbr'] = "E";               //abbreviation for 'yes'
$text['divorced'] = "Boşandı";
$text['indlinked'] = "Şununla bağlantılı";
$text['branch'] = "Şube";
$text['moreind'] = "Daha fazla kişi";
$text['morefam'] = "Daha fazla aile";
$text['surnamelist'] = "Soyadı Listesi";
$text['generations'] = "Nesiller";
$text['refresh'] = "Yenile";
$text['whatsnew'] = "Yenilikler";
$text['reports'] = "Raporlar";
$text['placelist'] = "Yer Listesi";
$text['baptizedlds'] = "Vaftiz Edilen (LDS)";
$text['endowedlds'] = "Bağışlanan (LDS)";
$text['sealedplds'] = "Mühürlü P (LDS)";
$text['sealedslds'] = "Mühürlü S (LDS)";
$text['ancestors'] = "Atalar";
$text['descendants'] = "Nesiller";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "Son GEDCOM İçe Aktarma Tarihi";
$text['type'] = "Tür";
$text['savechanges'] = "Değişiklikleri Kaydet";
$text['familyid'] = "Aile Kimliği";
$text['headstone'] = "Mezar Taşları";
$text['historiesdocs'] = "Tarihçeler";
$text['anonymous'] = "anonim";
$text['places'] = "Yerler";
$text['anniversaries'] = "Tarihler ve Yıldönümleri";
$text['administration'] = "Yönetim";
$text['help'] = "Yardım";
//$text['documents'] = "Documents";
$text['year'] = "Yıl";
$text['all'] = "Tüm";
$text['address'] = "Adres";
$text['suggest'] = "Öner";
$text['editevent'] = "Bu etkinlik için bir değişiklik önerin";
$text['morelinks'] = "Daha Fazla Bağlantı";
$text['faminfo'] = "Aile Bilgisi";
$text['persinfo'] = "Kişisel Bilgi";
$text['srcinfo'] = "Kaynak Bilgisi";
$text['fact'] = "Gerçek";
$text['goto'] = "Bir sayfa seç";
$text['tngprint'] = "Yazdır";
$text['databasestatistics'] = "İstatistikler"; //needed to be shorter to fit on menu
$text['child'] = "Çocuk";  //from familygroup
$text['repoinfo'] = "Depo Bilgileri";
$text['tng_reset'] = "Sıfırla";
$text['noresults'] = "Sonuç bulunamadı";
$text['allmedia'] = "Tüm Medya";
$text['repositories'] = "Depolar";
$text['albums'] = "Albümler";
$text['cemeteries'] = "Mezarlıklar";
$text['surnames'] = "Soyadları";
$text['dates'] = "Tarihler";
$text['link'] = "Bağlantı";
$text['media'] = "Medya";
$text['gender'] = "Cinsiyet";
$text['latitude'] = "Enlem";
$text['longitude'] = "Boylam";
$text['bookmarks'] = "Yer İmleri";
$text['bookmark'] = "Yer İmi";
$text['mngbookmarks'] = "Yer İmlerine Git";
$text['bookmarked'] = "Yer İmi Eklendi";
$text['remove'] = "Kaldır";
$text['find_menu'] = "Bul";
$text['info'] = "Bilgi"; //this needs to be a very short abbreviation
$text['cemetery'] = "Mezarlık";
$text['gmapevent'] = "Etkinlik Haritası";
$text['gevents'] = "Etkinlik";
$text['googleearthlink'] = "Google Earth'e bağlantı";
$text['googlemaplink'] = "Google Haritalar'a bağlantı";
$text['gmaplegend'] = "Pim Göstergesi";
$text['unmarked'] = "İşaretlenmemiş";
$text['located'] = "Konumlandırılmış";
$text['albclicksee'] = "Bu albümdeki tüm öğeleri görmek için tıklayın";
$text['notyetlocated'] = "Henüz bulunamadı";
$text['cremated'] = "Yakıldı";
$text['missing'] = "Eksik";
$text['pdfgen'] = "PDF Oluşturucu";
$text['blank'] = "Boş Grafik";
$text['fonts'] = "Yazı Tipleri";
$text['header'] = "Üstbilgi";
$text['data'] = "Veri";
$text['pgsetup'] = "Sayfa Yapısı";
$text['pgsize'] = "Sayfa Boyutu";
$text['orient'] = "Yönlendirme"; //for a page
$text['portrait'] = "Dikey";
$text['landscape'] = "Yatay";
$text['tmargin'] = "Üst Kenar Boşluğu";
$text['bmargin'] = "Alt Kenar Boşluğu";
$text['lmargin'] = "Sol Kenar Boşluğu";
$text['rmargin'] = "Sağ Kenar Boşluğu";
$text['createch'] = "Grafik Oluştur";
$text['prefix'] = "Önek";
$text['mostwanted'] = "En Çok Aranan";
$text['latupdates'] = "Son Güncellemeler";
$text['featphoto'] = "Öne Çıkan Fotoğraf";
$text['news'] = "Haberler";
$text['ourhist'] = "Aile Tarihimiz";
$text['ourhistanc'] = "Aile Tarihimiz ve Atalarımız";
$text['ourpages'] = "Aile Şecere Sayfalarımız";
$text['pwrdby'] = "Bu siteyi destekleyen:";
$text['writby'] = "Yazan:";
$text['searchtngnet'] = "TNG Ağında Ara (GENDEX)";
$text['viewphotos'] = "Tüm fotoğrafları görüntüle";
$text['anon'] = "Şu anda anonimsiniz";
$text['whichbranch'] = "Hangi şubedensiniz?";
$text['featarts'] = "Özellik Makaleleri";
$text['maintby'] = "Bakımını yapan:";
$text['createdon'] = "Oluşturuldu";
$text['reliability'] = "Güvenilirlik";
$text['labels'] = "Etiketler";
$text['inclsrcs'] = "Kaynakları Dahil Et";
$text['cont'] = "(devam)"; //abbreviation for continued
$text['mnuheader'] = "Ana Sayfa";
$text['mnusearchfornames'] = "Ara";
$text['mnulastname'] = "Soyadı";
$text['mnufirstname'] = "Adı";
$text['mnusearch'] = "Ara";
$text['mnureset'] = "Baştan Başla";
$text['mnulogon'] = "Oturum Aç";
$text['mnulogout'] = "Oturumu Kapat";
$text['mnufeatures'] = "Diğer Özellikler";
$text['mnuregister'] = "Bir Kullanıcı Hesabı İçin Kayıt Olun";
$text['mnuadvancedsearch'] = "Gelişmiş Arama";
$text['mnulastnames'] = "Soyadları";
$text['mnustatistics'] = "İstatistikler";
$text['mnuphotos'] = "Fotoğraflar";
$text['mnuhistories'] = "Tarihçeler";
$text['mnumyancestors'] = "[Kişi] İçin Atalarının Fotoğrafları ve Tarihçeleri";
$text['mnucemeteries'] = "Mezarlıklar";
$text['mnutombstones'] = "Mezar Taşları";
$text['mnureports'] = "Raporlar";
$text['mnusources'] = "Kaynaklar";
$text['mnuwhatsnew'] = "Yenilikler";
$text['mnushowlog'] = "Erişim Günlüğü";
$text['mnulanguage'] = "Dili Değiştir";
$text['mnuadmin'] = "Yönetim";
$text['welcome'] = "Hoş Geldiniz";
$text['contactus'] = "Bizimle İletişime Geçin";
//changed in 8.0.0
$text['born'] = "Doğdu";
$text['searchnames'] = "İnsanları Ara";
//added in 8.0.0
$text['editperson'] = "Kişi Düzenle";
$text['loadmap'] = "Haritayı yükle";
$text['birth'] = "Doğum";
$text['wasborn'] = "doğdu";
$text['startnum'] = "İlk Sayı";
$text['searching'] = "Aranıyor";
//moved here in 8.0.0
$text['location'] = "Konum";
$text['association'] = "İlişkilendirme";
$text['collapse'] = "Daralt";
$text['expand'] = "Genişlet";
$text['plot'] = "Çizim";
$text['searchfams'] = "Aileleri Ara";
//added in 8.0.2
$text['wasmarried'] = "Evlendi";
$text['anddied'] = "Vefat Etti";
//added in 9.0.0
$text['share'] = "Paylaş";
$text['hide'] = "Gizle";
$text['disabled'] = "Kullanıcı hesabınız devre dışı bırakıldı. Daha fazla bilgi için lütfen site yöneticisi ile iletişime geçin.";
$text['contactus_long'] = "Bu sitedeki bilgilerle ilgili herhangi bir sorunuz veya yorumunuz varsa, lütfen <span class=\"emphasis\"><a href=\"suggest.php\">bizimle iletişime geçin</a></span>. Sizden haber almak için bekliyoruz.";
$text['features'] = "Özellikler";
$text['resources'] = "Kaynaklar";
$text['latestnews'] = "Son Haberler";
$text['trees'] = "Ağaçlar";
$text['wasburied'] = "defnedildi";
//moved here in 9.0.0
$text['emailagain'] = "Tekrar e-posta";
$text['enteremail2'] = "Lütfen e-posta adresinizi tekrar girin.";
$text['emailsmatch'] = "E-postalarınız eşleşmiyor. Lütfen her alana aynı e-posta adresini girin.";
$text['getdirections'] = "Yol tarifi almak için tıklayın";
$text['calendar'] = "Takvim";
//changed in 9.0.0
$text['directionsto'] = " için ";
$text['slidestart'] = "Slayt Gösterisi";
$text['livingnote'] = "En az bir yaşayan veya özel kişi bu not ile bağlantılıdır - Ayrıntıları gizli tutulmuştur.";
$text['livingphoto'] = "En az bir yaşayan veya özel kişi bu öğe ile bağlantılıdır - Ayrıntıları gizli tutulmuştur.";
$text['waschristened'] = "vaftiz edildi";
//added in 10.0.0
$text['branches'] = "Şubeler";
$text['detail'] = "Ayrıntı";
$text['moredetail'] = "Daha fazla ayrıntı";
$text['lessdetail'] = "Daha az ayrıntı";
$text['conflds'] = "Onaylanan (LDS)";
$text['initlds'] = "Başlatan (LDS)";
$text['wascremated'] = "yakıldı";
//moved here in 11.0.0
$text['text_for'] = ":";
//added in 11.0.0
$text['searchsite'] = "Bu sitede ara";
$text['searchsitemenu'] = "Sitede Ara";
$text['kmlfile'] = "Bu konumu Google Earth’te göstermek için bir .kml dosyası indirin";
$text['download'] = "İndirmek için tıklayın";
$text['more'] = "Daha fazla";
$text['heatmap'] = "Yoğunluk Haritası";
$text['refreshmap'] = "Haritayı Yenile";
$text['remnums'] = "Sayıları ve Pimleri Temizle";
$text['photoshistories'] = "Fotoğraflar ve Tarihçeler";
$text['familychart'] = "Aile Grafiği";
//added in 12.0.0
$text['firstnames'] = "Adlar";
//moved here in 12.0.0
$text['dna_test'] = "DNA Testi";
$text['test_type'] = "Test Türü";
$text['test_info'] = "Test Bilgileri";
$text['takenby'] = "Şunun tarafından alındı";
$text['haplogroup'] = "Haplogroup";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "İlgili bağlantılar";
$text['nofirstname'] = "[ad yok]";
//added in 12.0.1
$text['cookieuse'] = "Not: Bu site çerez kullanmaktadır.";
$text['dataprotect'] = "Veri Koruma Politikası";
$text['viewpolicy'] = "Politikayı görüntüle";
$text['understand'] = "Anladım";
$text['consent'] = "Bu sitenin burada toplanan kişisel bilgileri saklamasına izin veriyorum. Site sahibinden istediğim zaman bu bilgileri kaldırmasını isteyebileceğimi anlıyorum.";
$text['consentreq'] = "Lütfen bu sitenin kişisel bilgileri saklaması için onayınızı verin.";

//added in 12.1.0
$text['testsarelinked'] = "DNA testleri ile ilişkilidir";
$text['testislinked'] = "DNA testi ile ilişkilidir";

//added in 12.2
$text['quicklinks'] = "Hızlı Bağlantılar";
$text['yourname'] = "Adınız";
$text['youremail'] = "E-Posta Adresiniz";
$text['liketoadd'] = "Eklemek istediğiniz herhangi bir bilgi";
$text['webmastermsg'] = "Web Yöneticisi Mesajı";
$text['gallery'] = "Galeriye Bakın";
$text['wasborn_male'] = "doğdu";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "doğdu"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "vaftiz edildi";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "vaftiz edildi";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "vefat etti";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "vefat etti";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "defnedildi"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "defnedildi"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "yakıldı";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "yakıldı";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "evlendi";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "evlendi";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "boşandı";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "boşandı";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " - ";			// used as a preposition to the location
$text['onthisdate'] = " - ";		// when used with full date
$text['inthisyear'] = " - ";		// when used with year only or month / year dates
$text['and'] = "ve ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA Testi Bilgisi";
//added in 13.0
$text['visitor'] = "Ziyaretçi";

$text['popupnote2'] = "Yeni soyağacı";

//moved here in 14.0
$text['zoomin'] = "Yakınlaştır";
$text['zoomout'] = "Uzaklaştır";
$text['scrollnote'] = "Grafiğin daha fazlasını görmek için sürükleyin veya kaydırın.";
$text['general'] = "Genel";

//changed in 14.0
$text['otherevents'] = "Diğer Etkinlikler ve Öznitelikler";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "Bağlantılar";
$text['continue'] = "Devam et";
$text['title2'] = "Başlık"; //medya, kaynaklar vb. için (kişiler için değil)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>