<?php
switch ( $textpart ) {
	//browsesources.php, showsource.php
	case "sources":
		$text['browseallsources'] = "浏览全部资源";
		$text['shorttitle'] = "短标题";
		$text['callnum'] = "电话号";
		$text['author'] = "作者";
		$text['publisher'] = "发行者";
		$text['other'] = "其他";
		$text['sourceid'] = "资源ID";
		$text['moresrc'] = "更多";
		$text['repoid'] = "版本ID";
		$text['browseallrepos'] = "浏览全部版本";
		break;

	//changelanguage.php, savelanguage.php
	case "language":
		$text['newlanguage'] = "新语言";
		$text['changelanguage'] = "切换语种";
		$text['languagesaved'] = "保存语言";
		$text['sitemaint'] = "网站维护中";
		$text['standby'] = "我们更新数据库时，该网站暂时不可用，请稍后再试。如果网站长时间停留，请 <a href=\"suggest.php\">联系站主</a>.";
		break;

	//gedcom.php, gedform.php
	case "gedcom":
		$text['gedstart'] = "家谱库创建";
		$text['producegedfrom'] = "处理家谱库文件";
		$text['numgens'] = "世代";
		$text['includelds'] = "包含教徒信息";
		$text['buildged'] = "创建家谱库";
		$text['gedstartfrom'] = "家谱库出自";
		$text['nomaxgen'] = "你必须明示家谱世代的最大代数. 请返回，并更正错误";
		$text['gedcreatedfrom'] = "导入家谱库";
		$text['gedcreatedfor'] = "创建";
		$text['creategedfor'] = "创建家谱库";
		$text['email'] = "邮箱";
		$text['suggestchange'] = "建议重选";
		$text['yourname'] = "你的姓名";
		$text['comments'] = "建议描述";
		$text['comments2'] = "内容";
		$text['submitsugg'] = "提交";
		$text['proposed'] = "建议";
		$text['mailsent'] = "谢谢，已提交.";
		$text['mailnotsent'] = "对不起，不能提交，请联系....";
		$text['mailme'] = "抄送";
		$text['entername'] = "输入姓名";
		$text['entercomments'] = "填写内容";
		$text['sendmsg'] = "发送";
		//added in 9.0.0
		$text['subject'] = "主题";
		break;

	//getextras.php, getperson.php
	case "getperson":
		$text['photoshistoriesfor'] = "照片和历史";
		$text['indinfofor'] = "个人信息";
		$text['pp'] = "页码."; //page abbreviation
		$text['age'] = "年龄";
		$text['agency'] = "中介";
		$text['cause'] = "原因";
		$text['suggested'] = "建议";
		$text['closewindow'] = "关闭窗口";
		$text['thanks'] = "谢谢";
		$text['received'] = "您的建议已转发给网站管理员进行审核.";
		$text['indreport'] = "个人报告";
		$text['indreportfor'] = "个人报告";
		$text['bkmkvis'] = "<strong>注意:</strong> 这些书签仅在此计算机上和此浏览器中可见.";
        //added in 9.0.0
		$text['reviewmsg'] = "您有一个需要您审核的建议更改:";
        $text['revsubject'] = "建议的变更需要你的评论";
        break;

	//relateform.php, relationship.php, findpersonform.php, findperson.php
	case "relate":
	case "connections":
		$text['relcalc'] = "关系计算";
		$text['findrel'] = "查找关系";
		$text['person1'] = "个人1:";
		$text['person2'] = "个人2:";
		$text['calculate'] = "计算";
		$text['select2inds'] = "请选择两个人。";
		$text['findpersonid'] = "查找人员ID";
		$text['enternamepart'] = "输入第一个和/或姓氏的一部分";
		$text['pleasenamepart'] = "请输入姓或名的一部分.";
		$text['clicktoselect'] = "点击选择";
		$text['nobirthinfo'] = "没有出生信息";
		$text['relateto'] = "与...的关系";
		$text['sameperson'] = "这两个人是同一个人。";
		$text['notrelated'] = "这两个人在xxx代不相关"; //xxx will be replaced with number of generations
		$text['findrelinstr'] = "要显示两个人之间的关系，请使用下面的\"查找\"按钮查找个人（或保持人员显示），然后单击\"计算\"";
		$text['sometimes'] = "(有时检查不同的代数会产生不同的结果。)";
		$text['findanother'] = "找到另一个关系";
		$text['brother'] = "兄弟";
		$text['sister'] = "姊妹";
		$text['sibling'] = "兄弟姐妹";
		$text['uncle'] = "xxx叔叔";
		$text['aunt'] = "xxx阿姨";
		$text['uncleaunt'] = "xxx叔叔/阿姨";
		$text['nephew'] = "xxx侄子";
		$text['niece'] = "xxx侄女";
		$text['nephnc'] = "xxx侄子/侄女";
		$text['removed'] = "移除";
		$text['rhusband'] = "丈夫";
		$text['rwife'] = "妻子";
		$text['rspouse'] = "配偶";
		$text['son'] = "儿子";
		$text['daughter'] = "女儿";
		$text['rchild'] = "小孩";
		$text['sil'] = "女婿";
		$text['dil'] = "媳妇";
		$text['sdil'] = "女婿或媳妇";
		$text['gson'] = "xxx 外孙";
		$text['gdau'] = "xxx 外孙女";
		$text['gsondau'] = "xxx 外孙外孙女";
		$text['great'] = "great";
		$text['spouses'] = "配偶";
		$text['is'] = "是";
		$text['changeto'] = "更改 (输入ID):";
		$text['notvalid'] = "不是有效的个人ID号码，或者该数据库中不存在，请重试.";
		$text['halfbrother'] = "同父/母兄弟";
		$text['halfsister'] = "同父/母姐妹";
		$text['halfsibling'] = "异父/母同胞";
		//changed in 8.0.0
		$text['gencheck'] = "检查最大代数";
		$text['mcousin'] = "xxx 堂兄弟 yyy ";  //male cousin; xxx = cousin number, yyy = times removed
		$text['fcousin'] = "xxx 堂姊妹 yyy ";  //female cousin
		$text['cousin'] = "xxx 堂兄弟姊妹 yyy ";
		$text['mhalfcousin'] = "xxx 表兄弟 yyy ";  //male cousin
		$text['fhalfcousin'] = "xxx 表姊妹 yyy ";  //female cousin
		$text['halfcousin'] = "xxx 表兄弟姊妹 yyy ";
		//added in 8.0.0
		$text['oneremoved'] = "一旦移走";
		$text['gfath'] = "xxx的祖父";
		$text['gmoth'] = "xxx的祖母";
		$text['gpar'] = "xxx祖父母";
		$text['mothof'] = "母亲";
		$text['fathof'] = "父亲";
		$text['parof'] = "双亲";
		$text['maxrels'] = "要显示的最大关系";
		$text['dospouses'] = "显示涉及配偶的关系";
		$text['rels'] = "关系";
		$text['dospouses2'] = "显示配偶";
		$text['fil'] = "岳父";
		$text['mil'] = "岳母";
		$text['fmil'] = "岳父母";
		$text['stepson'] = "继子";
		$text['stepdau'] = "继女";
		$text['stepchild'] = "继子女";
		$text['stepgson'] = "xxx的外继子";
		$text['stepgdau'] = "xxx的外继女";
		$text['stepgchild'] = "xxx的外继子女";
		//added in 8.1.1
		$text['ggreat'] = "曾";
		//added in 8.1.2
		$text['ggfath'] = "xxx曾祖父";
		$text['ggmoth'] = "xxx曾祖母";
		$text['ggpar'] = "xxx曾祖父母";
		$text['ggson'] = "xxx曾孙子";
		$text['ggdau'] = "xxx曾孙女";
		$text['ggsondau'] = "xxx曾子孙";
		$text['gstepgson'] = "xxx过继曾孙子";
		$text['gstepgdau'] = "xxx过继曾孙女";
		$text['gstepgchild'] = "xxx过继曾子孙";
		$text['guncle'] = "xxx叔伯祖父（舅老爷）";
		$text['gaunt'] = "xxx叔伯祖母（姑姥姥）";
		$text['guncleaunt'] = "xxx 叔伯祖父母";
		$text['gnephew'] = "xxx 曾侄子";
		$text['gniece'] = "xxx 增侄女";
		$text['gnephnc'] = "xxx 曾侄子女";
		//added in 14.0
		$text['pathscalc'] = "搜索连接";
		$text['findrel2'] = "查找关系和其他联系";
		$text['makeme2nd'] = "使用我的 ID";
		$text['usebookmarks'] = "使用书签";
		$text['select2inds'] = "请选择两个人。";
		$text['indinfofor'] = "个人信息";
		$text['nobookmarks'] = "没有书签可以使用";
		$text['bkmtitle'] = "在书签中找到的人";
		$text['bkminfo'] = "选择一个人:";
		$text['sortpathsby'] = "按数量排序路径";
		$text['sortbyshort'] = "排序依据";
		$text['bylengthshort'] = "长度";
		$text['badID1'] = ": 错误ID 1 -请返回并更正";
		$text['badID2'] = ": 错误ID 2 -请返回并更正";
		$text['notintree'] = ": 这个ID的人不在当前树数据库中。";
		$text['sameperson'] = "这两个人是同一个人。";;
		$text['nopaths'] = "这些人没有联系。";
		$text['nopaths1'] = "没有比 xxx 短的连接";
		$text['nopaths2'] = "在 xxx 搜索步骤中";
		$text['longestpath'] = "(到目前为止检查的最长路径是 xxx 步长)";
		$text['relevantpaths'] = "找到的不同相关路径的数量：xxx";
		$text['skipMarr'] = "(另外，由于婚姻过多，找到但未显示的路径数为：xxx)";
		$text['mjaor'] = "或";
		$text['connectionsto'] = "连接到  ";
		$text['findanotherpers'] = "找另一个人...";
		$text['sometimes'] = "(有时检查不同的代数会产生不同的结果。)";
		$text['anotherpath'] = "搜索其他连接";
		$text['xpath'] = "路径 ";
		$text['primary'] = "起始人"; // note: used for both Start and End if text['fin'] not set
		$text['secondary'] = "结束人";
		$text['parent'] = "父母";
		$text['mhfather'] = "他的父亲";
		$text['mhmother'] = "他的妈妈";
		$text['mhhusband'] = "他的丈夫";
		$text['mhwife'] = "他的妻子";
		$text['mhson'] = "他的儿子";
		$text['mhdaughter'] = "她的女儿";
		$text['fhfather'] = "她的父亲";
		$text['fhmother'] = "她妈妈";
		$text['fhhusband'] = "她的丈夫";
		$text['fhwife'] = "她的妻子";
		$text['fhson'] = "她的儿子";
		$text['fhdaughter'] = "她的女儿";
		$text['hfather'] = "父亲";
		$text['hmother'] = "妈妈";
		$text['hhusband'] = "丈夫";
		$text['hwife'] = "妻子";
		$text['hson'] = "儿子";
		$text['hdaughter'] = "女儿";
		$text['maxruns'] = "要检查的最大路径数";
		$text['maxrshort'] = "最大路径";
		$text['maxlength'] = "连接路径不超过";
		$text['maxlshort'] = "最大长度";
		$text['xstep'] = "步";
		$text['xsteps'] = "步数";
		$text['xmarriages'] = "xxx 婚姻";
		$text['xmarriage'] = "1 婚姻";
		$text['showspouses'] = "显示配偶双方";
		$text['showTxt'] = "显示文本路径描述";
		$text['showTxtshort'] = "文本描述.";
		$text['compactBox'] = "显示压缩的人物框";
		$text['compactBoxshort'] = "压缩框";
		$text['paths'] = "路径";
		$text['dospouses2'] = "显示配偶";
		$text['maxmopt'] = "Max marriages per connection";
		$text['maxm'] = "Max marriages";
		$text['arerelated'] = "These persons are relatives - their relationship is shown in the Path 1";
		$text['simplerel'] = "Simple relationship search";
		break;

	case "familygroup":
		$text['familygroupfor'] = "家族表";
		$text['ldsords'] = "LDS 条列";
		$text['baptizedlds'] = "洗礼(LDS)";
		$text['endowedlds'] = "入会 (LDS)";
		$text['sealedplds'] = "过继到父母(LDS)";
		$text['sealedslds'] = "过继到配偶(LDS)";
		$text['otherspouse'] = "其他配偶";
		$text['husband'] = "丈夫";
		$text['wife'] = "妻子";
		break;

	//pedigree.php
	case "pedigree":
		$text['capbirthabbr'] = "生";
		$text['capaltbirthabbr'] = "礼";
		$text['capdeathabbr'] = "死";
		$text['capburialabbr'] = "葬";
		$text['capplaceabbr'] = "住";
		$text['capmarrabbr'] = "婚";
		$text['capspouseabbr'] = "配偶";
		$text['redraw'] = "重读";
		$text['unknownlit'] = "未知";
		$text['popupnote1'] = "附加信息";
		$text['pedcompact'] = "紧凑";
		$text['pedstandard'] = "标准";
		$text['pedtextonly'] = "文本";
		$text['descendfor'] = "子孙";
		$text['maxof'] = "最大";
		$text['gensatonce'] = "一次显示.";
		$text['sonof'] = "儿子";
		$text['daughterof'] = "女儿";
		$text['childof'] = "孩子";
		$text['stdformat'] = "标准";
		$text['ahnentafel'] = "血统";
		$text['addnewfam'] = "添加新家庭";
		$text['editfam'] = "编辑家庭";
		$text['side'] = "边";
		$text['familyof'] = "家里";
		$text['paternal'] = "父方";
		$text['maternal'] = "母方";
		$text['gen1'] = "自己";
		$text['gen2'] = "父母";
		$text['gen3'] = "祖父母";
		$text['gen4'] = "曾祖辈";
		$text['gen5'] = "高祖辈";
		$text['gen6'] = "天祖辈";
		$text['gen7'] = "烈祖辈";
		$text['gen8'] = "太祖辈";
		$text['gen9'] = "远祖辈";
		$text['gen10'] = "9世祖";
		$text['gen11'] = "10世祖";
		$text['gen12'] = "11世祖";
		$text['graphdesc'] = "到此为止的传承图";
		$text['pedbox'] = "字框";
		$text['regformat'] = "注册";
		$text['extrasexpl'] = "= 此个人至少存在一张照片，历史记录或其他媒体项目.";
		$text['popupnote3'] = "新图表";
		$text['mediaavail'] = "有效资料";
		$text['pedigreefor'] = "世系图";
		$text['pedigreech'] = "世系图";
		$text['datesloc'] = "日期和地点";
		$text['borchr'] = "生/礼 - 死/葬";
		$text['nobd'] = "无生死期";
		$text['bcdb'] = "所有数据";
		$text['numsys'] = "编码系统";
		$text['gennums'] = "世代数";
		$text['henrynums'] = "Henry Numbers";
		$text['abovnums'] = "d'Aboville Numbers";
		$text['devnums'] = "de Villiers Numbers";
		$text['dispopts'] = "显示选项";
		//added in 10.0.0
		$text['no_ancestors'] = "无祖辈";
		$text['ancestor_chart'] = "垂直世系图";
		$text['opennewwindow'] = "新窗口打开";
		$text['pedvertical'] = "垂直型";
		//added in 11.0.0
		$text['familywith'] = "Family with";
		$text['fcmlogin'] = "请登录查看";
		$text['isthe'] = "is the";
		$text['otherspouses'] = "其他配偶";
		$text['parentfamily'] = "父母方";
		$text['showfamily'] = "显示家庭";
		$text['shown'] = "显示";
		$text['showparentfamily'] = "显示父母方";
		$text['showperson'] = "显示个人";
		//added in 11.0.2
		$text['otherfamilies'] = "其他家庭";
		//added in 14.0
		$text['dtformat'] = "表格";
		$text['dtchildren'] = "儿童";
		$text['dtgrandchildren'] = "孙子";
		$text['dtggrandchildren'] = "曾孙";
		$text['dtgggrandchildren'] = "曾孙"; //For 2x great grandchildren, 3x great grandchildren, etc. Usually different in Scandinavian languages
		$text['greatoffset'] = "0"; //Scandinavian languages should set this to 1 so counting starts a generation later
		$text['dtnodescendants'] = "没有后代";
		$text['dtgen'] = "世";
		$text['dttotal'] = "总计";
		$text['dtselect'] = "选择";
		$text['dteachfulltable'] = "每个完整的表都会有";
		$text['dtrows'] = "行";
		$text['dtdisplayingtable'] = "显示表格";
		$text['dtgototable'] = "转到表：";
		$text['fcinstrdn'] = "显示有配偶的家庭";
		$text['fcinstrup'] = "显示有父母的家庭";
		$text['fcinstrplus'] = "选择其他配偶";
		$text['fcinstrfam'] = "选择其他父母";
		break;

	//search.php, searchform.php
	//merged with reports and showreport in 5.0.0
	case "search":
	case "reports":
		$text['noreports'] = "无报告.";
		$text['reportname'] = "报告名";
		$text['allreports'] = "所有报告";
		$text['report'] = "报告";
		$text['error'] = "错误";
		$text['reportsyntax'] = "使用此报告运行的查询语法";
		$text['wasincorrect'] = "是不正确的，结果报告无法运行，请联系系统管理";
		$text['errormessage'] = "错误消息";
		$text['equals'] = "等于";
		$text['endswith'] = "和";
		$text['soundexof'] = "探测";
		$text['metaphoneof'] = "演算";
		$text['plusminus10'] = "从+/- 10 年";
		$text['lessthan'] = "少于";
		$text['greaterthan'] = "大于";
		$text['lessthanequal'] = "小与等于";
		$text['greaterthanequal'] = "大与等于";
		$text['equalto'] = "等于";
		$text['tryagain'] = "再试试";
		$text['joinwith'] = "加入";
		$text['cap_and'] = "和";
		$text['cap_or'] = "或";
		$text['showspouse'] = "显示配偶（如果个人有不止一个配偶会显示重复）";
		$text['submitquery'] = "提交查询";
		$text['birthplace'] = "出生地";
		$text['deathplace'] = "死亡地";
		$text['birthdatetr'] = "出生年";
		$text['deathdatetr'] = "死亡年";
		$text['plusminus2'] = "从+/- 2年";
		$text['resetall'] = "重置数据";
		$text['showdeath'] = "显示死亡/埋葬信息";
		$text['altbirthplace'] = "洗礼地";
		$text['altbirthdatetr'] = "洗礼年";
		$text['burialplace'] = "埋葬地";
		$text['burialdatetr'] = "埋葬年";
		$text['event'] = "事件";
		$text['day'] = "日";
		$text['month'] = "月";
		$text['keyword'] = "关键字（即，\"Abt \"）";
		$text['explain'] = "输入日期组件以查看匹配的事件。将字段留空以查看所有的匹配项.";
		$text['enterdate'] = "请输入或选择以下至少一项：日，月，年，关键字";
		$text['fullname'] = "全名";
		$text['birthdate'] = "出生日";
		$text['altbirthdate'] = "洗礼日";
		$text['marrdate'] = "结婚日";
		$text['spouseid'] = "配偶ID";
		$text['spousename'] = "配偶名";
		$text['deathdate'] = "死亡日";
		$text['burialdate'] = "埋葬日";
		$text['changedate'] = "最近修改日";
		$text['gedcom'] = "族谱";
		$text['baptdate'] = "洗礼日(LDS)";
		$text['baptplace'] = "洗礼地(LDS)";
		$text['endldate'] = "入会日(LDS)";
		$text['endlplace'] = "入会地(LDS)";
		$text['ssealdate'] = "注册日(LDS)";   //Sealed to spouse
		$text['ssealplace'] = "注册地(LDS)";
		$text['psealdate'] = "过继日(LDS)";   //Sealed to parents
		$text['psealplace'] = "过继地(LDS)";
		$text['marrplace'] = "结婚地";
		$text['spousesurname'] = "配偶姓";
		$text['spousemore'] = "如果您输入配偶姓氏的值，则必须选择\"性别.\"";
		$text['plusminus5'] = "从+/- 5年";
		$text['exists'] = "存在";
		$text['dnexist'] = "不存在";
		$text['divdate'] = "离婚日";
		$text['divplace'] = "离婚地";
		$text['otherevents'] = "其他搜索条件";
		$text['numresults'] = "每页结果";
		$text['mysphoto'] = "神秘照片";
		$text['mysperson'] = "待查人员";
		$text['joinor'] = "与OR'连接选项不能与配偶的姓氏一起使用";
		$text['tellus'] = "告诉我你要知道什么";
		$text['moreinfo'] = "更多信息:";
		//added in 8.0.0
		$text['marrdatetr'] = "结婚年";
		$text['divdatetr'] = "离婚年";
		$text['mothername'] = "母亲的名字";
		$text['fathername'] = "父亲的名字";
		$text['filter'] = "筛选";
		$text['notliving'] = "过世";
		$text['nodayevents'] = "与特定日期无关的本月事件:";
		//added in 9.0.0
		$text['csv'] = "逗号分隔的CSV文件";
		//added in 10.0.0
		$text['confdate'] = "确认日期(LDS)";
		$text['confplace'] = "确认地点(LDS)";
		$text['initdate'] = "入会日期(LDS)";
		$text['initplace'] = "入会场所(LDS)";
		//added in 11.0.0
		$text['marrtype'] = "婚姻类型";
		$text['searchfor'] = "搜索";
		$text['searchnote'] = "注意：此页面使用Google执行搜索，返回的匹配数量将直接受到Google对网站索引程度的影响";
		break;

	//showlog.php
	case "showlog":
		$text['logfilefor'] = "日志文件";
		$text['mostrecentactions'] = "最近的动作";
		$text['autorefresh'] = "自动刷新（30秒）";
		$text['refreshoff'] = "关闭自动刷新";
		break;

	case "headstones":
	case "showphoto":
		$text['cemeteriesheadstones'] = "坟场与墓碑";
		$text['showallhsr'] = "显示所有墓碑记录";
		$text['in'] = "在";
		$text['showmap'] = "显示地图";
		$text['headstonefor'] = "墓碑为";
		$text['photoof'] = "照片";
		$text['photoowner'] = "所有者/资源";
		$text['nocemetery'] = "没有公墓";
		$text['iptc005'] = "标题";
		$text['iptc020'] = "配偶目录";
		$text['iptc040'] = "特殊说明";
		$text['iptc055'] = "创建日期";
		$text['iptc080'] = "作者";
		$text['iptc085'] = "作者职务";
		$text['iptc090'] = "城市";
		$text['iptc095'] = "省/自治区";
		$text['iptc101'] = "国家";
		$text['iptc103'] = "OTR";
		$text['iptc105'] = "标题";
		$text['iptc110'] = "资源";
		$text['iptc115'] = "照片库";
		$text['iptc116'] = "版权声明";
		$text['iptc120'] = "说明";
		$text['iptc122'] = "说明作者";
		$text['mapof'] = "图例";
		$text['regphotos'] = "描述性视图";
		$text['gallery'] = "仅限缩略图";
		$text['cemphotos'] = "墓碑照";
		$text['photosize'] = "尺寸";
        $text['iptc010'] = "像素";
		$text['filesize'] = "大小";
		$text['seeloc'] = "查看位置";
		$text['showall'] = "全部显示";
		$text['editmedia'] = "编辑媒体";
		$text['viewitem'] = "查看此项目";
		$text['editcem'] = "编辑墓碑";
		$text['numitems'] = "# Items";
		$text['allalbums'] = "所有影集";
		$text['slidestop'] = "暂停幻灯片";
		$text['slideresume'] = "继续播放";
		$text['slidesecs'] = "幻灯片的秒数:";
		$text['minussecs'] = "减0.5秒";
		$text['plussecs'] = "加0.5秒";
		$text['nocountry'] = "未知国家";
		$text['nostate'] = "未知省份";
		$text['nocounty'] = "未知乡镇";
		$text['nocity'] = "未知城市";
		$text['nocemname'] = "未知墓地名称";
		$text['editalbum'] = "编辑相册";
		$text['mediamaptext'] = "<strong>注意：</strong> 将鼠标指针移动到图像上以显示名称，单击以查看每个名称的页面.";
		//added in 8.0.0
		$text['allburials'] = "所有葬礼";
		$text['moreinfo'] = "点击查看有关此图片的更多信息";
		//added in 9.0.0
        $text['iptc025'] = "关键字";
        $text['iptc092'] = "子位置";
		$text['iptc015'] = "类别";
		$text['iptc065'] = "发起程序";
		$text['iptc070'] = "程序版本";
		//added in 13.0
		$text['toggletags'] = "Toggle Tags";
		break;

	//surnames.php, surnames100.php, surnames-all.php, surnames-oneletter.php
	case "surnames":
	case "places":
		$text['surnamesstarting'] = "以姓氏开头显示姓氏";
		$text['showtop'] = "显示顶部";
		$text['showallsurnames'] = "显示所有姓氏";
		$text['sortedalpha'] = "按字母顺序排序";
		$text['byoccurrence'] = "按事件排序";
		$text['firstchars'] = "首字母";
		$text['mainsurnamepage'] = "主姓页";
		$text['allsurnames'] = "所有姓氏";
		$text['showmatchingsurnames'] = "点击一个姓氏来显示匹配的记录.";
		$text['backtotop'] = "返回顶部";
		$text['beginswith'] = "开始与";
		$text['allbeginningwith'] = "以\"\"开头的所有姓氏";
		$text['numoccurrences'] = "括号中的总地点数";
		$text['placesstarting'] = "以\"开头显示最大的地方\"";
		$text['showmatchingplaces'] = "点击一个地方来显示较小的地方，点击搜索图标显示匹配的人.";
		$text['totalnames'] = "总人数";
		$text['showallplaces'] = "显示所有最大的地方";
		$text['totalplaces'] = "总地点";
		$text['mainplacepage'] = "主分布地";
		$text['allplaces'] = "所有最大的地区";
		$text['placescont'] = "显示包含所有地点";
		//changed in 8.0.0
		$text['top30'] = "xxx 姓氏";
		$text['top30places'] = "xxx 做多地点";
		//added in 12.0.0
		$text['firstnamelist'] = "名字列表";
		$text['firstnamesstarting'] = "显示以开头的名字";
		$text['showallfirstnames'] = "显示所有名字";
		$text['mainfirstnamepage'] = "主名字首页";
		$text['allfirstnames'] = "所有名字";
		$text['showmatchingfirstnames'] = "点击要显示的名字匹配记录";
		$text['allfirstbegwith'] = "所有以”开头的名字";
		$text['top30first'] = "xxx名字排名";
		$text['allothers'] = "所有其他人";
		$text['amongall'] = "（在所有名字中）";
		$text['justtop'] = "仅排名前xxx";
		break;

	//whatsnew.php
	case "whatsnew":
		$text['pastxdays'] = "(过去 xx 天)";

		$text['photo'] = "照片";
		$text['history'] = "历史文档";
		$text['husbid'] = "父亲ID";
		$text['husbname'] = "父亲名字";
		$text['wifeid'] = "母亲ID";
		//added in 11.0.0
		$text['wifename'] = "母亲名字";
		break;

	//timeline.php, timeline2.php
	case "timeline":
		$text['text_delete'] = "删除";
		$text['addperson'] = "添加人员";
		$text['nobirth'] = "以下个人没有有效的出生日期，无法添加d";
		$text['event'] = "事件";
		$text['chartwidth'] = "图表宽";
		$text['timelineinstr'] = "添加人员";
		$text['togglelines'] = "行开关";
		//changed in 9.0.0
		$text['noliving'] = "以下个人被标记为生活或私人，无法添加，因为您没有正确的权限登录";
		break;
		
	//browsetrees.php
	//login.php, newacctform.php, addnewacct.php
	case "trees":
	case "login":
		$text['browsealltrees'] = "浏览所有谱";
		$text['treename'] = "谱书名";
		$text['owner'] = "所有者";
		$text['address'] = "地址";
		$text['city'] = "城市";
		$text['state'] = "省/自治区";
		$text['zip'] = "邮编号";
		$text['country'] = "国家";
		$text['email'] = "邮箱";
		$text['phone'] = "电话";
		$text['username'] = "用户名";
		$text['password'] = "密码";
		$text['loginfailed'] = "注册失败.";

		$text['regnewacct'] = "注册新用户帐户";
		$text['realname'] = "你的真实姓名";
		$text['phone'] = "电话";
		$text['email'] = "邮箱";
		$text['address'] = "地址";
		$text['acctcomments'] = "笔记和评论";
		$text['submit'] = "提交";
		$text['leaveblank'] = "(如果请求新谱，则为空)";
		$text['required'] = "必填字段";
		$text['enterpassword'] = "请输入密码.";
		$text['enterusername'] = "请输入用户名.";
		$text['failure'] = "W很抱歉，您输入的用户名已被使用，请使用浏览器上的\"返回\"按钮返回上一页，然后选择其他用户名.";
		$text['success'] = "谢谢，我们已收到您的注册，我们将在您的帐户激活或需要更多信息时与您联系.";
		$text['emailsubject'] = "新TNG用户注册请求";
		$text['website'] = "网站";
		$text['nologin'] = "还没有登录?";
		$text['loginsent'] = "发送登录信息t";
		$text['loginnotsent'] = "没发送登录信息";
		$text['enterrealname'] = "请输入你的真实姓名.";
		$text['rempass'] = "保持登录此计算机";
		$text['morestats'] = "更多统计信息";
		$text['accmail'] = "<strong>注意:</strong> 为了从站点管理员收到有关您的帐户的邮件，请确保您不会阻止来自此域的邮件.";
		$text['newpassword'] = "新密码";
		$text['resetpass'] = "重置密码";
		$text['nousers'] = "此表单在至少存在一个用户记录之前无法使用，如果您是网站所有者，请访问管理员/用户创建您的管理员帐户.";
		$text['noregs'] = "很抱歉，我们目前没有接受新的用户注册。如果您有意见，请直接<a href=\"suggest.php\">联系我们</a> 包括关于本网站上任何内容的问题.";
		$text['emailmsg'] = "您已收到TNG用户帐户的新请求，请登录您的TNG管理区域并为此新帐户分配适当的权限.";
		$text['accactive'] = "该帐户已被激活，但在您分配之前，用户将不会有特殊权利m.";
		$text['accinactive'] = "请到：管理员/用户/查看 以访问帐户设置。帐户将保持不活动，直到您至少编辑并保存记录一次.";
		$text['pwdagain'] = "再次密码";
		$text['enterpassword2'] = "确认密码.";
		$text['pwdsmatch'] = "您的密码不匹配，请在每个字段中输入相同的密码.";
		$text['acksubject'] = "谢谢你的注册"; //for a new user account
		$text['ackmessage'] = "您的用户帐户请求已被收到，您的帐户将被暂停，直到网站管理员审核，当您的登录名可以使用时，您将收到电子邮件通知.";
		//added in 12.0.0
		$text['switch'] = "开关";
		//added in 14.0
		$text['newpassword2'] = "再次输入新密码";
		$text['resetsuccess'] = "成功：密码已被重置";
		$text['resetfail'] = "失败：密码未重置";
		$text['failreason0'] = " (未知的数据库错误)";
		$text['failreason2'] = " （您无权更改密码）";
		$text['failreason3'] = " (密码不匹配)";
		break;

	//added in 10.0.0
	case "branches":
		$text['browseallbranches'] = "浏览所有分支";
		break;

	//statistics.php
	case "stats":
		$text['quantity'] = "数量";
		$text['totindividuals'] = "总人数";
		$text['totmales'] = "总男性";
		$text['totfemales'] = "总女性";
		$text['totunknown'] = "总未知性别 ";
		$text['totliving'] = "总活着";
		$text['totfamilies'] = "总家庭数";
		$text['totuniquesn'] = "总唯一姓";
		//$text['totphotos'] = "Total Photos";
		//$text['totdocs'] = "Total Histories &amp; Documents";
		//$text['totheadstones'] = "Total Headstones";
		$text['totsources'] = "总资源";
		$text['avglifespan'] = "平均性命";
		$text['earliestbirth'] = "最早出生";
		$text['longestlived'] = "最长寿";
		$text['days'] = "天数";
		$text['age'] = "年龄";
		$text['agedisclaimer'] = "年龄相关的计算是基于记录出生日期和死亡日期的个人.  由于存在不完整的日期字段（例如，死亡日期仅列为\" 1945\"或\"BEF 1860\"），这些计算不能100％准确.";
		$text['treedetail'] = "关于这谱系的更多信息e";
		$text['total'] = "总计";
		//added in 12.0
		$text['totdeceased'] = "全死亡";
		//added in 14.0
		$text['totalsourcecitations'] = "源引用总数";
		break;

	case "notes":
		$text['browseallnotes'] = "浏览所有备注";
		break;

	case "help":
		$text['menuhelp'] = "菜单键";
		break;

	case "install":
		$text['perms'] = "权限全部设置好了.";
		$text['noperms'] = "无法为这些文件设置权限:";
		$text['manual'] = "请手动设置y.";
		$text['folder'] = "文件夹";
		$text['created'] = "已创建d";
		$text['nocreate'] = "无法创建，请手动创建.";
		$text['infosaved'] = "信息保存，连接验证！";
		$text['tablescr'] = "表已创建！";
		$text['notables'] = "无法创建以下表：";
		$text['nocomm'] = "TNG不与您的数据库通信，没有创建表.";
		$text['newdb'] = "信息保存，连接验证，创建新数据库：";
		$text['noattach'] = "已保存信息。连接已创建，数据库已创建，但TNG无法附加.";
		$text['nodb'] = "保存信息连接，但数据库不存在，无法在此创建，请验证数据库名称是否正确，数据库用户是否正确访问，或使用控制面板创建它.";
		$text['noconn'] = "保存信息但连接失败，以下一个或多个不正确：";
		$text['exists'] = "已经存在";
		$text['noop'] = "没有执行任何操作.";
		//added in 8.0.0
		$text['nouser'] = "用户未创建，用户名可能已经存在.";
		$text['notree'] = "未创建谱，谱书ID可能已经存在.";
		$text['infosaved2'] = "已保存信息";
		$text['renamedto'] = "重命名为";
		$text['norename'] = "无法重命名";
		//changed in 13.0.0
		$text['loginfirst'] = "您必须先登录.";
		break;

	case "imgviewer":
		$text['magmode'] = "放大模式";
		$text['panmode'] = "平移模式";
		$text['pan'] = "点击并拖动在图像中移动";
		$text['fitwidth'] = "宽度匹配";
		$text['fitheight'] = "高度匹配";
		$text['newwin'] = "新窗口";
		$text['opennw'] = "在新窗口中打开图像";
		$text['magnifyreg'] = "点击放大图像的一个区域";
		$text['imgctrls'] = "启用图像控件";
		$text['vwrctrls'] = "启用图像查看器控件";
		$text['vwrclose'] = "关闭图像查看器";
		break;

	case "dna":
		$text['test_date'] = "测试日期";
		$text['links'] = "相关链接";
		$text['testid'] = "测试ID";
		//added in 12.0.0
		$text['mode_values'] = "模式值";
		$text['compareselected'] = "比较选定的\";  //Compare Selected";
		$text['dnatestscompare'] = "比较Y-DNA测试";
		$text['keep_name_private'] = "保留私人名称";
		$text['browsealltests'] = "浏览所有测试";
		$text['all_dna_tests'] = "所有DNA测试";
		$text['fastmutating'] = "快速＆nbsp;突变";
		$text['alltypes'] = "所有类型";
		$text['allgroups'] = "所有群组";
		$text['Ydna_LITbox_info'] = "与此人相关的测试不是必然由这个人采取。<br />'单倍组'专栏 如果结果为\"预测\"，则以红色显示数据，如果测试结果为绿色则显示数据是'确认";
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
$text['matches'] = "匹配";
$text['description'] = "描述";
$text['notes'] = "备注";
$text['status'] = "状态";
$text['newsearch'] = "新搜索";
$text['pedigree'] = "世系图";
$text['seephoto'] = "看图片";
$text['andlocation'] = "和分布";
$text['accessedby'] = "访问";
$text['children'] = "儿童";  //from getperson
$text['tree'] = "族谱";
$text['alltrees'] = "所有谱书";
$text['nosurname'] = "[无姓]";
$text['thumb'] = "缩略";  //as in Thumbnail
$text['people'] = "个人";
$text['title'] = "标题";  //from getperson
$text['suffix'] = "后缀";  //from getperson
$text['nickname'] = "昵称";  //from getperson
$text['lastmodified'] = "最近修改";  //from getperson
$text['married'] = "已婚";  //from getperson
//$text['photos'] = "Photos";
$text['name'] = "姓名"; //from showmap
$text['lastfirst'] = "姓 名";  //from search
$text['bornchr'] = "出生/洗礼";  //from search
$text['individuals'] = "个人";  //from whats new
$text['families'] = "家庭";
$text['personid'] = "个人ID";
$text['sources'] = "资源";  //from getperson (next several)
$text['unknown'] = "未知";
$text['father'] = "父亲";
$text['mother'] = "母亲";
$text['christened'] = "洗礼";
$text['died'] = "死";
$text['buried'] = "葬";
$text['spouse'] = "配偶";  //from search
$text['parents'] = "父母";  //from pedigree
$text['text'] = "文本";  //from sources
$text['language'] = "语言";  //from languages
$text['descendchart'] = "后辈";
$text['extractgedcom'] = "GEDCOM";
$text['indinfo'] = "个人";
$text['edit'] = "编辑";
$text['date'] = "日期";
$text['login'] = "登录";
$text['logout'] = "注销";
$text['groupsheet'] = "组表";
$text['text_and'] = "和";
$text['generation'] = "代";
$text['filename'] = "文件名";
$text['id'] = "ID";
$text['search'] = "搜索";
$text['user'] = "用户";
$text['firstname'] = "名";
$text['lastname'] = "姓";
$text['searchresults'] = "搜索结果";
$text['diedburied'] = "死/葬";
$text['homepage'] = "首页";
$text['find'] = "查找..";
$text['relationship'] = "关系";		//in German, Verwandtschaft
$text['relationship2'] = "关系"; //different in some languages, at least in German (Beziehung)
$text['timeline'] = "时间轴";
$text['yesabbr'] = "是";               //abbreviation for 'yes'
$text['divorced'] = "离婚";
$text['indlinked'] = "链接";
$text['branch'] = "支谱";
$text['moreind'] = "更多个人";
$text['morefam'] = "更多家庭";
$text['surnamelist'] = "姓氏表";
$text['generations'] = "代数";
$text['refresh'] = "刷新";
$text['whatsnew'] = "更新";
$text['reports'] = "报告";
$text['placelist'] = "分布表";
$text['baptizedlds'] = "洗礼(LDS)";
$text['endowedlds'] = "入会(LDS)";
$text['sealedplds'] = "过继(LDS)";
$text['sealedslds'] = "注册(LDS)";
$text['ancestors'] = "世祖";
$text['descendants'] = "子孙";
//$text['sex'] = "Sex";
$text['lastimportdate'] = "最后GEDCOM导入日期";
$text['type'] = "形式";
$text['savechanges'] = "保存更改";
$text['familyid'] = "家庭ID";
$text['headstone'] = "墓碑";
$text['historiesdocs'] = "历史";
$text['anonymous'] = "匿名";
$text['places'] = "区域";
$text['anniversaries'] = "日期和纪念日";
$text['administration'] = "管理";
$text['help'] = "帮助";
//$text['documents'] = "Documents";
$text['year'] = "年";
$text['all'] = "所有";
$text['address'] = "地址";
$text['suggest'] = "建议";
$text['editevent'] = "建议更改此事件";
$text['morelinks'] = "更多链接";
$text['faminfo'] = "家庭信息";
$text['persinfo'] = "个人信息";
$text['srcinfo'] = "源信息";
$text['fact'] = "事实";
$text['goto'] = "选择页面";
$text['tngprint'] = "打印";
$text['databasestatistics'] = "统计"; //needed to be shorter to fit on menu
$text['child'] = "孩子";  //from familygroup
$text['repoinfo'] = "文献信息";
$text['tng_reset'] = "重置";
$text['noresults'] = "没有找到结果";
$text['allmedia'] = "媒体";
$text['repositories'] = "文献";
$text['albums'] = "相册";
$text['cemeteries'] = "墓地";
$text['surnames'] = "姓氏";
$text['dates'] = "日期";
$text['link'] = "链接";
$text['media'] = "媒体";
$text['gender'] = "性别";
$text['latitude'] = "纬度";
$text['longitude'] = "经度";
$text['bookmarks'] = "书签";
$text['bookmark'] = "书签";
$text['mngbookmarks'] = "转到书签";
$text['bookmarked'] = "增减书签";
$text['remove'] = "移除";
$text['find_menu'] = "查找";
$text['info'] = "信息"; //this needs to be a very short abbreviation
$text['cemetery'] = "墓地";
$text['gmapevent'] = "事件图";
$text['gevents'] = "事件";
$text['googleearthlink'] = "链接到Google地球";
$text['googlemaplink'] = "链接到Google地图";
$text['gmaplegend'] = "Pin Legend";
$text['unmarked'] = "未标记";
$text['located'] = "定位";
$text['albclicksee'] = "点击查看此相册中的所有项目";
$text['notyetlocated'] = "尚未找到";
$text['cremated'] = "创建";
$text['missing'] = "缺失";
$text['pdfgen'] = "PDF生成";
$text['blank'] = "空白表";
$text['fonts'] = "字体";
$text['header'] = "页眉";
$text['data'] = "日期";
$text['pgsetup'] = "页面设置";
$text['pgsize'] = "页面大小";
$text['orient'] = "定位"; //for a page
$text['portrait'] = "肖像";
$text['landscape'] = "背景";
$text['tmargin'] = "上边距";
$text['bmargin'] = "下边距";
$text['lmargin'] = "左边距";
$text['rmargin'] = "右边距";
$text['createch'] = "创建图表";
$text['prefix'] = "前缀";
$text['mostwanted'] = "期望";
$text['latupdates'] = "最新更新";
$text['featphoto'] = "特色照片";
$text['news'] = "新闻";
$text['ourhist'] = "我们的家族史";
$text['ourhistanc'] = "我们的家史和祖辈";
$text['ourpages'] = "我们的家谱";
$text['pwrdby'] = "版权方";
$text['writby'] = "出自";
$text['searchtngnet'] = "查看TNG照片 (GENDEX)";
$text['viewphotos'] = "查看所有照片";
$text['anon'] = "你目前匿名";
$text['whichbranch'] = "你是哪个分支?";
$text['featarts'] = "特色文章";
$text['maintby'] = "维护者";
$text['createdon'] = "创建于";
$text['reliability'] = "可靠";
$text['labels'] = "标签";
$text['inclsrcs'] = "包含源头";
$text['cont'] = "(续.)"; //abbreviation for continued
$text['mnuheader'] = "首页";
$text['mnusearchfornames'] = "搜索";
$text['mnulastname'] = "姓";
$text['mnufirstname'] = "名字";
$text['mnusearch'] = "搜索";
$text['mnureset'] = "重新开始";
$text['mnulogon'] = "登录";
$text['mnulogout'] = "注销";
$text['mnufeatures'] = "其他特性";
$text['mnuregister'] = "注册用户帐户";
$text['mnuadvancedsearch'] = "高级搜索";
$text['mnulastnames'] = "姓氏";
$text['mnustatistics'] = "统计";
$text['mnuphotos'] = "照片";
$text['mnuhistories'] = "历史";
$text['mnumyancestors'] = "祖先的照片和历史";
$text['mnucemeteries'] = "墓地";
$text['mnutombstones'] = "墓碑";
$text['mnureports'] = "报告";
$text['mnusources'] = "资料";
$text['mnuwhatsnew'] = "更新";
$text['mnushowlog'] = "访问日志";
$text['mnulanguage'] = "切换语言";
$text['mnuadmin'] = "管理";
$text['welcome'] = "欢迎";
$text['contactus'] = "联系我们";
//changed in 8.0.0
$text['born'] = "出生";
$text['searchnames'] = "人员";
//added in 8.0.0
$text['editperson'] = "编辑";
$text['loadmap'] = "加载图表";
$text['birth'] = "生日";
$text['wasborn'] = "出生于";
$text['startnum'] = "第一个数字";
$text['searching'] = "搜索";
//moved here in 8.0.0
$text['location'] = "定位";
$text['association'] = "关联";
$text['collapse'] = "收缩";
$text['expand'] = "展开";
$text['plot'] = "绘制";
$text['searchfams'] = "家庭";
//added in 8.0.2
$text['wasmarried'] = "已婚";
$text['anddied'] = "去世";
//added in 9.0.0
$text['share'] = "分享";
$text['hide'] = "隐藏";
$text['disabled'] = "您的用户帐户已被禁用，请与站点管理员联系以获取更多信息.";
$text['contactus_long'] = "如果您对本网站上的信息有任何问题或意见， 请<span class=\"emphasis\"><a href=\"suggest.php\">联系我们</a></span>. 我们期待您的回音.";
$text['features'] = "Features";
$text['resources'] = "Resources";
$text['latestnews'] = "Latest News";
$text['trees'] = "族谱";
$text['wasburied'] = "埋葬";
//moved here in 9.0.0
$text['emailagain'] = "再次电子邮件";
$text['enteremail2'] = "请再次输入您的电子邮件地址.";
$text['emailsmatch'] = "您的电子邮件不匹配，请在每个字段中输入相同的电子邮件地址.";
$text['getdirections'] = "点击获取";
$text['calendar'] = "日历";
//changed in 9.0.0
$text['directionsto'] = " to ";
$text['slidestart'] = "幻灯片放映";
$text['livingnote'] = "至少有一个生活或私人个人与本说明相关联 - 细节被扣留.";
$text['livingphoto'] = "至少有一个生活或私人个人被链接到这个项目 - 被保留的细节.";
$text['waschristened'] = "被洗礼";
//added in 10.0.0
$text['branches'] = "支谱";
$text['detail'] = "详情";
$text['moredetail'] = "更多细节";
$text['lessdetail'] = "较少细节";
$text['conflds'] = "确认(LDS)";
$text['initlds'] = "入会(LDS)";
$text['wascremated'] = "被火化了";
//moved here in 11.0.0
$text['text_for'] = "for";
//added in 11.0.0
$text['searchsite'] = "搜索本网站";
$text['searchsitemenu'] = "站点";
$text['kmlfile'] = "下载.kml文件以在Google地球中显示此位置";
$text['download'] = "点击下载";
$text['more'] = "更多";
$text['heatmap'] = "热力图";
$text['refreshmap'] = "刷新地图";
$text['remnums'] = "清除数字和引脚";
$text['photoshistories'] = "照片与历史";
$text['familychart'] = "家谱";
//added in 12.0.0
$text['firstnames'] = "名字";
//moved here in 12.0.0
$text['dna_test'] = "DNA检测";
$text['test_type'] = "测试形式";
$text['test_info'] = "测试信息";
$text['takenby'] = "测试于";
$text['haplogroup'] = "Haplogroup";
$text['hvr1'] = "HVR1";
$text['hvr2'] = "HVR2";
$text['relevant_links'] = "相关链接";
$text['nofirstname'] = "[no first name]";
//added in 12.0.1
$text['cookieuse'] = "Note: This site uses cookies.";
$text['dataprotect'] = "Data Protection Policy";
$text['viewpolicy'] = "View policy";
$text['understand'] = "I understand";
$text['consent'] = "I give my consent for this site to store the personal information collected here. I understand that I may ask the site owner to remove this information at any time.";
$text['consentreq'] = "Please give your consent for this site to store personal information.";

//added in 12.1.0
$text['testsarelinked'] = "DNA tests are associated with";
$text['testislinked'] = "DNA test is associated with";

//added in 12.2
$text['quicklinks'] = "快速链接";
$text['yourname'] = "你的名字";
$text['youremail'] = "您的电子邮件地址";
$text['liketoadd'] = "您要添加的任何信息";
$text['webmastermsg'] = "网站管理员留言";
$text['gallery'] = "查看图库";
$text['wasborn_male'] = "出生";  	// same as $text['wasborn'] if no gender verb
$text['wasborn_female'] = "出生"; 	// same as $text['wasborn'] if no gender verb
$text['waschristened_male'] = "被命名为";	// same as $text['waschristened'] if no gender verb
$text['waschristened_female'] = "被命名为";	// same as $text['waschristened'] if no gender verb
$text['died_male'] = "死了";	// same as $text['anddied'] of no gender verb
$text['died_female'] = "死了";	// same as $text['anddied'] of no gender verb
$text['wasburied_male'] = "被埋葬了"; 	// same as $text['wasburied'] if no gender verb
$text['wasburied_female'] = "被埋葬了"; 	// same as $text['wasburied'] if no gender verb
$text['wascremated_male'] = "被火化";		// same as $text['wascremated'] if no gender verb
$text['wascremated_female'] = "被火化";	// same as $text['wascremated'] if no gender verb
$text['wasmarried_male'] = "已婚";	// same as $text['wasmarried'] if no gender verb
$text['wasmarried_female'] = "已婚";	// same as $text['wasmarried'] if no gender verb
$text['wasdivorced_male'] = "离婚了";	// might be the same as $text['divorce'] but as a verb
$text['wasdivorced_female'] = "离婚了";	// might be the same as $text['divorce'] but as a verb
$text['inplace'] = " in ";			// used as a preposition to the location
$text['onthisdate'] = " on ";		// when used with full date
$text['inthisyear'] = " in ";		// when used with year only or month / year dates
$text['and'] = "和 ";				// used in conjunction with wasburied or was cremated

//moved here in 12.2.1
$text['dna_info_head'] = "DNA测试信息";
//added in 13.0
$text['visitor'] = "Visitor";

$text['popupnote2'] = "新世系";

//moved here in 14.0
$text['zoomin'] = "放大";
$text['zoomout'] = "缩小";
$text['scrollnote'] = "注意：您可能需要向下或向右滚动以查看图表.";
$text['general'] = "通用";

//changed in 14.0
$text['otherevents'] = "其他事件和属性";

//added in 14.0
$text['times'] = "x";
$text['connections'] = "连接";
$text['continue'] = "继续";
$text['title2'] = "标题"; //for media, sources, etc (not people)

@include_once(dirname(__FILE__) . "/alltext.php");
if(empty($alltextloaded)) getAllTextPath();
?>