<?php
function performQuery($query,$table = null) {
	global $badtables;
	
	$result = @tng_query($query);
	if( !$result && $table ) {
		$badtables .= $badtables ? ",$table" : $table;
	}
	return $result;
}

function addPrefix($table,$prefix) {
	return ($prefix && strpos($table,$prefix) !== 0) ? $prefix . $table : $table;
}

if(empty($collation)) {
	$query = "SELECT @@collation_database AS collation";
	$result = performQuery($query);
	$collation = tng_fetch_assoc($result);
	$collation = $collation['collation'];
}

$collationstr = $collation ? "COLLATE $collation" : "";
$engine = strpos($collation, "utf8mb4") === false ? "MYISAM" : "InnoDb ROW_FORMAT=DYNAMIC";

if(!isset($table_prefix)) $table_prefix = "";

$address_table = addPrefix($address_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $address_table";
$result = performQuery($query);
$query = "CREATE TABLE $address_table (
	addressID INT NOT NULL AUTO_INCREMENT,
	address1 VARCHAR(64) NOT NULL,
	address2 VARCHAR(64) NOT NULL,
	city VARCHAR(64) NOT NULL,
	state VARCHAR(64) NOT NULL,
	zip VARCHAR(10) NOT NULL,
	country VARCHAR(64) NOT NULL,
	www VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	phone VARCHAR(30) NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	PRIMARY KEY (addressID),
	INDEX address (gedcom, country, state, city)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$address_table);

$albums_table = addPrefix($albums_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $albums_table";
$result = performQuery($query);
$query = "CREATE TABLE $albums_table (
	albumID INT NOT NULL AUTO_INCREMENT,
	albumname VARCHAR(100) NOT NULL,
	description TEXT NULL,
	alwayson TINYINT NULL,
	keywords TEXT NULL,
	active TINYINT NOT NULL,
	PRIMARY KEY (albumID),
	INDEX albumname (albumname)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$albums_table);

$albumlinks_table = addPrefix($albumlinks_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $albumlinks_table";
$result = performQuery($query);
$query = "CREATE TABLE $albumlinks_table (
	albumlinkID INT NOT NULL AUTO_INCREMENT,
	albumID INT NOT NULL,
	mediaID INT NOT NULL,
	ordernum INT NULL,
	defphoto VARCHAR(1) NOT NULL,
	PRIMARY KEY (albumlinkID),
	INDEX albumID (albumID,ordernum)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$albumlinks_table);

$album2entities_table = addPrefix($album2entities_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $album2entities_table";
$result = performQuery($query);
$query = "CREATE TABLE $album2entities_table (
	alinkID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	linktype CHAR(1) NOT NULL,
	entityID VARCHAR(100) NOT NULL,
	eventID VARCHAR(10) NOT NULL,
	albumID INT NOT NULL,
	ordernum FLOAT NOT NULL,
	PRIMARY KEY (alinkID),
	UNIQUE alinkID (gedcom, entityID, albumID),
	INDEX entityID (gedcom, entityID, ordernum)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$album2entities_table);

$assoc_table = addPrefix($assoc_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $assoc_table";
$result = performQuery($query);
$query = "CREATE TABLE $assoc_table (
	assocID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	personID VARCHAR(22) NOT NULL,
	passocID VARCHAR(22) NOT NULL,
	reltype VARCHAR(1) NOT NULL,
	relationship VARCHAR(75) NOT NULL,
	PRIMARY KEY (assocID),
	INDEX assoc (gedcom, personID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$assoc_table);

$branches_table = addPrefix($branches_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $branches_table";
$result = performQuery($query);
$query = "CREATE TABLE $branches_table (
	branch VARCHAR(20) NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	description VARCHAR(128) NOT NULL,
	personID VARCHAR(22) NOT NULL,
	agens INT NOT NULL,
	dgens INT NOT NULL,
	dagens INT NOT NULL,
	inclspouses TINYINT NOT NULL,
	action TINYINT NOT NULL,
	PRIMARY KEY (gedcom, branch),
	INDEX description (gedcom, description)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$branches_table);

$branchlinks_table = addPrefix($branchlinks_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $branchlinks_table";
$result = performQuery($query);
$query = "CREATE TABLE $branchlinks_table (
	ID INT NOT NULL AUTO_INCREMENT,
	branch VARCHAR(20) NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	persfamID VARCHAR(22) NOT NULL,
	PRIMARY KEY (ID),
	UNIQUE branch (gedcom, branch, persfamID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$branchlinks_table);

$cemeteries_table = addPrefix($cemeteries_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $cemeteries_table";
$result = performQuery($query);
$query = "CREATE TABLE $cemeteries_table (
	cemeteryID INT NOT NULL AUTO_INCREMENT,
	cemname VARCHAR(64) NOT NULL,
	maplink VARCHAR(255) NOT NULL,
	city VARCHAR(64) NULL,
	county VARCHAR(64) NULL,
	state VARCHAR(64) NULL,
	country VARCHAR(64) NULL,
	longitude VARCHAR(22) NULL,
	latitude VARCHAR(22) NULL,
	zoom TINYINT NULL,
	notes TEXT NULL,
	place VARCHAR(248) NOT NULL,
	PRIMARY KEY (cemeteryID),
	INDEX cemname (cemname),
	INDEX place (place)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$cemeteries_table);

$children_table = addPrefix($children_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $children_table";
$result = performQuery($query);
$query = "CREATE TABLE $children_table (
	ID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	familyID VARCHAR(22) NOT NULL,
	personID VARCHAR(22) NOT NULL,
	frel VARCHAR(20) NOT NULL,
	mrel VARCHAR(20) NOT NULL,
	sealdate VARCHAR(50) NOT NULL,
	sealdatetr DATE NOT NULL,
	sealplace TEXT NOT NULL,
	haskids TINYINT NOT NULL,
	ordernum SMALLINT NOT NULL,
	parentorder TINYINT NOT NULL,
	PRIMARY KEY (ID),
	UNIQUE familyID (gedcom, familyID, personID),
	INDEX personID (gedcom, personID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$children_table);

$citations_table = addPrefix($citations_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $citations_table";
$result = performQuery($query);
$query = "CREATE TABLE $citations_table (
	citationID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	persfamID VARCHAR(22) NOT NULL,
	eventID VARCHAR(10) NOT NULL,
	sourceID VARCHAR(22) NOT NULL,
	ordernum FLOAT NOT NULL,
	description TEXT NOT NULL,
	citedate VARCHAR(50) NOT NULL,
	citedatetr DATE NOT NULL,
	citetext TEXT NOT NULL,
	page TEXT NOT NULL,
	quay VARCHAR(2) NOT NULL,
	note TEXT NOT NULL,
	PRIMARY KEY (citationID),
	INDEX citation (gedcom, persfamID, eventID, sourceID, description(20))
) ENGINE = $engine $collationstr";
$result = performQuery($query,$citations_table);

$countries_table = addPrefix($countries_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $countries_table";
$result = performQuery($query);
$query = "CREATE TABLE $countries_table (
    country varchar(64) NOT NULL,
    PRIMARY KEY (country)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$countries_table);

$dna_groups_table = addPrefix($dna_groups_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $dna_groups_table";
$result = performQuery($query);
$query = "CREATE TABLE $dna_groups_table (
	dna_group varchar(20) NOT NULL, 
	test_type varchar(40) NOT NULL, 
	gedcom varchar(20) NOT NULL, 
	description varchar(128) NOT NULL, 
	action TINYINT NOT NULL, 
	PRIMARY KEY (dna_group)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$dna_groups_table);

$dna_links_table = addPrefix($dna_links_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $dna_links_table";
$result = performQuery($query);
$query = "CREATE TABLE $dna_links_table (
	ID INT NOT NULL AUTO_INCREMENT,
	testID INT NOT NULL,
	personID varchar(22) NOT NULL,
	gedcom varchar(20) NOT NULL,
	dna_group VARCHAR(128) NOT NULL,
	PRIMARY KEY (ID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$dna_links_table);

$dna_tests_table = addPrefix($dna_tests_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $dna_tests_table";
$result = performQuery($query);
$query = "CREATE TABLE $dna_tests_table (
	testID INT NOT NULL AUTO_INCREMENT,
	test_type varchar(40) NOT NULL,
	test_number varchar(50) NOT NULL,
	notes text NOT NULL,
	vendor varchar(100) NOT NULL,
	test_date date NOT NULL,
	match_date date NOT NULL,
	personID varchar(22) NOT NULL,
	gedcom varchar(20) NOT NULL,
 	person_name varchar(100) NOT NULL,
	urls text NOT NULL,
	mtdna_haplogroup varchar(40) NOT NULL,
	ydna_haplogroup VARCHAR(30) NOT NULL,
	significant_snp varchar(255) NOT NULL,
	terminal_snp varchar(80) NOT NULL,
	markers varchar(40) NOT NULL,
	y_results varchar(512) NOT NULL,
	hvr1_results varchar(100) NOT NULL,
	hvr2_results varchar(100) NOT NULL,
	mtdna_confirmed varchar(2) NOT NULL,
	ydna_confirmed varchar(2) NOT NULL,
	markeropt varchar(2) NOT NULL,
	notesopt varchar(2) NOT NULL,
	linksopt varchar(2) NOT NULL,
	surnamesopt TINYINT NOT NULL,
	private_dna varchar(2) NOT NULL,
	private_test VARCHAR(2) NOT NULL,
	dna_group varchar(128) NOT NULL,
	dna_group_desc varchar(128) NOT NULL,
	surnames text NOT NULL,
	MD_ancestorID varchar(20) NOT NULL,
	MRC_ancestorID varchar(20) NOT NULL,
	admin_notes text NOT NULL,
	medialinks text NOT NULL,
	ref_seq text NOT NULL,
	xtra_mut text NOT NULL,
	coding_reg text NOT NULL,
	GEDmatchID VARCHAR(30) NOT NULL,
	relationship_range VARCHAR(80) NOT NULL,
	suggested_relationship VARCHAR(80) NOT NULL,
	actual_relationship VARCHAR(40) NOT NULL,
	related_side VARCHAR(120) NOT NULL,
	shared_cMs VARCHAR(10) NOT NULL,
	shared_segments VARCHAR(10) NOT NULL,
	chromosome VARCHAR(4) NOT NULL,
	segment_start VARCHAR(40) NOT NULL,
	segment_end VARCHAR(40) NOT NULL,
	centiMorgans VARCHAR(40) NOT NULL,
	matching_SNPs VARCHAR(10) NOT NULL,
	x_match VARCHAR(2) NOT NULL,
	PRIMARY KEY (testID),
	INDEX test_date (test_date)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$dna_tests_table);

$events_table = addPrefix($events_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $events_table";
$result = performQuery($query);
$query = "CREATE TABLE $events_table (
	eventID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	persfamID VARCHAR(22) NOT NULL,
	eventtypeID INT NOT NULL,
	eventdate VARCHAR(50) NOT NULL,
	eventdatetr DATE NOT NULL,
	eventplace TEXT NOT NULL,
	age VARCHAR(12) NOT NULL,
	agency VARCHAR(120) NOT NULL,
	cause VARCHAR(90) NOT NULL,
	addressID VARCHAR(10) NOT NULL,
	parenttag VARCHAR(10) NOT NULL,
	info TEXT NOT NULL,
	PRIMARY KEY (eventID),
	INDEX persfamID (gedcom, persfamID),
	INDEX eventplace (gedcom, eventplace(20))
) ENGINE = $engine $collationstr";
$result = performQuery($query,$events_table);

$eventtypes_table = addPrefix($eventtypes_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $eventtypes_table";
$result = performQuery($query);
$query = "CREATE TABLE $eventtypes_table (
	eventtypeID INT NOT NULL AUTO_INCREMENT,
	tag VARCHAR(10) NOT NULL,
	description VARCHAR(90) NOT NULL,
	display TEXT NOT NULL,
	keep TINYINT NOT NULL,
	collapse TINYINT NOT NULL,
	ordernum SMALLINT NOT NULL,
	ldsevent TINYINT NOT NULL,
	type CHAR(1) NOT NULL,
	PRIMARY KEY (eventtypeID),
	UNIQUE typetagdesc (type, tag, description),
	INDEX ordernum (ordernum)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$eventtypes_table);

$families_table = addPrefix($families_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $families_table";
$result = performQuery($query);
$query = "CREATE TABLE $families_table (
	ID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	familyID VARCHAR(22) NOT NULL,
	husband VARCHAR(22) NOT NULL,
	wife VARCHAR(22) NOT NULL,
	marrdate VARCHAR(50) NOT NULL,
	marrdatetr DATE NOT NULL,
	marrplace TEXT NOT NULL,
	marrtype VARCHAR(90) NOT NULL,
	divdate VARCHAR(50) NOT NULL,
	divdatetr DATE NOT NULL,
	divplace TEXT NOT NULL,
	status VARCHAR(20) NOT NULL,
	sealdate VARCHAR(50) NOT NULL,
	sealdatetr DATE NOT NULL,
	sealplace TEXT NOT NULL,
	husborder TINYINT NOT NULL,
	wifeorder TINYINT NOT NULL,
	changedate DATETIME NOT NULL,
	living TINYINT NOT NULL,
	private TINYINT NOT NULL,
	branch VARCHAR(512) NOT NULL,
	changedby VARCHAR(100) NOT NULL,
	edituser VARCHAR(100) NOT NULL,
	edittime INT NOT NULL,
	PRIMARY KEY (ID),
	UNIQUE familyID (gedcom, familyID),
	INDEX husband (gedcom, husband),
	INDEX wife (gedcom, wife),
	INDEX marrplace (marrplace(20)),
	INDEX divplace (divplace(20)),
	INDEX changedate (changedate)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$families_table);

$image_tags_table = addPrefix($image_tags_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $image_tags_table";
$result = performQuery($query);
$query = "CREATE TABLE $image_tags_table (
	ID INT NOT NULL AUTO_INCREMENT,
	mediaID INT NOT NULL,
	rtop INT NOT NULL,
	rleft INT NOT NULL,
	rheight INT NOT NULL,
	rwidth INT NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	linktype CHAR(1) NOT NULL,
	persfamID VARCHAR(100) NOT NULL,
	label VARCHAR(64) NOT NULL,
	PRIMARY KEY (ID),
	UNIQUE mediaID (mediaID,gedcom,persfamID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$image_tags_table);

$languages_table = addPrefix($languages_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $languages_table";
$result = performQuery($query);
$query = "CREATE TABLE $languages_table (
	languageID SMALLINT NOT NULL AUTO_INCREMENT,
	display VARCHAR(100) NOT NULL,
	folder VARCHAR(50) NOT NULL,
	charset VARCHAR(30) NOT NULL,
	norels VARCHAR(1) NOT NULL,
	PRIMARY KEY (languageID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$languages_table);

$medialinks_table = addPrefix($medialinks_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $medialinks_table";
$result = performQuery($query);
$query = "CREATE TABLE $medialinks_table (
	medialinkID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	linktype CHAR(1) NOT NULL,
	personID VARCHAR(248) NOT NULL,
	eventID VARCHAR(10) NOT NULL,
	mediaID INT NOT NULL,
	altdescription TEXT NOT NULL,
	altnotes TEXT NOT NULL,
	ordernum FLOAT NOT NULL,
	dontshow TINYINT NOT NULL,
	defphoto VARCHAR(1) NOT NULL,
	PRIMARY KEY (medialinkID),
	UNIQUE mediaID (gedcom, personID(22), mediaID, eventID),
	INDEX personID (gedcom, personID(22), ordernum)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$medialinks_table);

$media_table = addPrefix($media_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $media_table";
$result = performQuery($query);
$query = "CREATE TABLE $media_table (
	mediaID INT NOT NULL AUTO_INCREMENT,
	mediatypeID VARCHAR(20) NOT NULL,
	mediakey VARCHAR(255) NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	form VARCHAR(10) NOT NULL,
	path VARCHAR(255) NULL,
	description TEXT NULL,
	datetaken VARCHAR(50) NULL,
	placetaken TEXT NULL,
	notes TEXT NULL,
	owner TEXT NULL,
	thumbpath VARCHAR(255) NULL,
	alwayson TINYINT NULL,
	map TEXT NULL,
	abspath TINYINT NULL,
	status VARCHAR(40) NULL,
	showmap SMALLINT NULL,
	cemeteryID INT NULL,
	plot TEXT NULL,
	linktocem TINYINT NULL,
	longitude VARCHAR(22) NULL,
	latitude VARCHAR(22) NULL,
	zoom TINYINT NULL,
	width SMALLINT NULL,
	height SMALLINT NULL,
	left_value SMALLINT NOT NULL,
	top_value SMALLINT NOT NULL,
	bodytext TEXT NULL,
	usenl TINYINT NULL,
	newwindow TINYINT NULL,
	usecollfolder TINYINT NULL,
	private TINYINT NOT NULL,
	changedate DATETIME NOT NULL,
	changedby VARCHAR(100) NOT NULL,
	PRIMARY KEY (mediaID),
	UNIQUE mediakey (gedcom, mediakey),
	INDEX mediatypeID (mediatypeID),
	INDEX changedate (changedate),
	INDEX description (description(20)),
	INDEX headstones (cemeteryID, description(20))
) ENGINE = $engine $collationstr";
$result = performQuery($query,$media_table);

$mediatypes_table = addPrefix($mediatypes_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $mediatypes_table";
$result = performQuery($query);
$query = "CREATE TABLE $mediatypes_table (
	mediatypeID VARCHAR(20) NOT NULL,
	display VARCHAR(40) NOT NULL,
	path VARCHAR(127) NOT NULL,
	liketype VARCHAR(20) NOT NULL,
	icon VARCHAR(50) NOT NULL,
	thumb VARCHAR(50) NOT NULL,
    exportas VARCHAR(20) NOT NULL,
	disabled TINYINT NOT NULL,
	ordernum TINYINT NOT NULL,
	localpath VARCHAR(250) NOT NULL,
	PRIMARY KEY (mediatypeID),
	INDEX ordernum (ordernum, display)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$mediatypes_table);

$query = "INSERT IGNORE INTO $mediatypes_table (mediatypeID,display,path,liketype,icon,thumb,exportas,disabled,ordernum,localpath) VALUES('photos','','','','','','',0,0,'')";
$result = performQuery($query);
$query = "INSERT IGNORE INTO $mediatypes_table (mediatypeID,display,path,liketype,icon,thumb,exportas,disabled,ordernum,localpath) VALUES('documents','','','','','','',0,0,'')";
$result = performQuery($query);
$query = "INSERT IGNORE INTO $mediatypes_table (mediatypeID,display,path,liketype,icon,thumb,exportas,disabled,ordernum,localpath) VALUES('headstones','','','','','','',0,0,'')";
$result = performQuery($query);
$query = "INSERT IGNORE INTO $mediatypes_table (mediatypeID,display,path,liketype,icon,thumb,exportas,disabled,ordernum,localpath) VALUES('histories','','','','','','',0,0,'')";
$result = performQuery($query);
$query = "INSERT IGNORE INTO $mediatypes_table (mediatypeID,display,path,liketype,icon,thumb,exportas,disabled,ordernum,localpath) VALUES('recordings','','','','','','',0,0,'')";
$result = performQuery($query);
$query = "INSERT IGNORE INTO $mediatypes_table (mediatypeID,display,path,liketype,icon,thumb,exportas,disabled,ordernum,localpath) VALUES('videos','','','','','','',0,0,'')";
$result = performQuery($query);

$mostwanted_table = addPrefix($mostwanted_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $mostwanted_table";
$result = performQuery($query);
$query = "CREATE TABLE $mostwanted_table (
	ID INT NOT NULL AUTO_INCREMENT,
	ordernum FLOAT NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	mwtype VARCHAR(10) NOT NULL,
	title VARCHAR(128) NOT NULL,
	description TEXT NOT NULL,
	personID VARCHAR(22) NOT NULL,
	mediaID INT NOT NULL,
	PRIMARY KEY (ID),
	INDEX mwtype (mwtype,ordernum,title)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$mostwanted_table);

$notelinks_table = addPrefix($notelinks_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $notelinks_table";
$result = performQuery($query);
$query = "CREATE TABLE $notelinks_table (
	ID INT NOT NULL AUTO_INCREMENT,
	persfamID VARCHAR(22) NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	xnoteID INT NOT NULL,
	eventID VARCHAR(10) NOT NULL,
	ordernum FLOAT NOT NULL,
	secret TINYINT NOT NULL,
	PRIMARY KEY (ID),
	INDEX notelinks (gedcom, persfamID, eventID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$notelinks_table);

$people_table = addPrefix($people_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $people_table";
$result = performQuery($query);
$query = "CREATE TABLE $people_table (
	ID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	personID VARCHAR(22) NOT NULL,
	lnprefix VARCHAR(25) NOT NULL,
	lastname VARCHAR(127) NOT NULL,
	firstname VARCHAR(127) NOT NULL,
	birthdate VARCHAR(50) NOT NULL,
	birthdatetr DATE NOT NULL,
	sex VARCHAR(25) NOT NULL,
	birthplace TEXT NOT NULL,
	deathdate VARCHAR(50) NOT NULL,
	deathdatetr DATE NOT NULL,
	deathplace TEXT NOT NULL,
	altbirthtype VARCHAR(5) NOT NULL,
	altbirthdate VARCHAR(50) NOT NULL,
	altbirthdatetr DATE NOT NULL,
	altbirthplace TEXT NOT NULL,
	burialdate VARCHAR(50) NOT NULL,
	burialdatetr DATE NOT NULL,
	burialplace TEXT NOT NULL,
	burialtype TINYINT NOT NULL,
	baptdate VARCHAR(50) NOT NULL,
	baptdatetr DATE NOT NULL,
	baptplace TEXT NOT NULL,
	confdate VARCHAR(50) NOT NULL,
	confdatetr DATE NOT NULL,
	confplace TEXT NOT NULL,
	initdate VARCHAR(50) NOT NULL,
	initdatetr DATE NOT NULL,
	initplace TEXT NOT NULL,
	endldate VARCHAR(50) NOT NULL,
	endldatetr DATE NOT NULL,
	endlplace TEXT NOT NULL,
	changedate DATETIME NOT NULL,
	nickname TEXT NOT NULL,
	title TINYTEXT NOT NULL,
	prefix TINYTEXT NOT NULL,
	suffix TINYTEXT NOT NULL,
	nameorder TINYINT NOT NULL,
	famc VARCHAR(22) NOT NULL,
	metaphone VARCHAR(15) NOT NULL,
	living TINYINT NOT NULL,
	private TINYINT NOT NULL,
	branch VARCHAR(512) NOT NULL,
	changedby VARCHAR(100) NOT NULL,
	edituser VARCHAR(100) NOT NULL,
	edittime INT NOT NULL,
	PRIMARY KEY (ID),
	UNIQUE gedpers (gedcom, personID),
	INDEX lastname (lastname, firstname),
	INDEX firstname (firstname),
	INDEX gedlast (gedcom, lastname, firstname),
	INDEX gedfirst (gedcom, firstname),
	INDEX birthplace (birthplace(20)),
	INDEX altbirthplace (altbirthplace(20)),
	INDEX deathplace (deathplace(20)),
	INDEX burialplace (burialplace(20)),
	INDEX baptplace (baptplace(20)),
	INDEX confplace (confplace(20)),
	INDEX initplace (initplace(20)),
	INDEX endlplace (endlplace(20)),
	INDEX changedate (changedate)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$people_table);

$places_table = addPrefix($places_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $places_table";
$result = performQuery($query);
$query = "CREATE TABLE $places_table (
	ID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	place VARCHAR(248) NOT NULL,
	longitude VARCHAR(22) NULL,
	latitude VARCHAR(22) NULL,
	zoom TINYINT NULL,
	placelevel TINYINT NULL,
	temple TINYINT NOT NULL,
    geoignore TINYINT NOT NULL,
	notes TEXT NULL,
	changedate DATETIME NOT NULL,
	changedby VARCHAR(100) NOT NULL,
	PRIMARY KEY (ID),
	UNIQUE place (gedcom, place),
	INDEX temple (temple, gedcom, place)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$places_table);

$reports_table = addPrefix($reports_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $reports_table";
$result = performQuery($query);
$query = "CREATE TABLE $reports_table (
	reportID INT NOT NULL AUTO_INCREMENT,
	reportname VARCHAR(80) NOT NULL,
	reportdesc TEXT NOT NULL,
	ranking INT NOT NULL,
	display TEXT NOT NULL,
	criteria TEXT NOT NULL,
	orderby TEXT NOT NULL,
	sqlselect TEXT NOT NULL,
	active TINYINT NOT NULL,
	PRIMARY KEY (reportID),
	INDEX reportname (reportname),
	INDEX ranking (ranking)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$reports_table);

$repositories_table = addPrefix($repositories_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $repositories_table";
$result = performQuery($query);
$query = "CREATE TABLE $repositories_table (
	ID INT NOT NULL AUTO_INCREMENT,
	repoID VARCHAR(22) NOT NULL,
	reponame VARCHAR(90) NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	addressID INT NOT NULL,
	changedate DATETIME NOT NULL,
	changedby VARCHAR(100) NOT NULL,
	PRIMARY KEY (ID),
	UNIQUE repoID (gedcom, repoID),
	INDEX reponame (reponame)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$repositories_table);

$saveimport_table = addPrefix($saveimport_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $saveimport_table";
$result = performQuery($query);
$query = "CREATE TABLE $saveimport_table (
	ID INT NOT NULL AUTO_INCREMENT,
	filename VARCHAR(255) NULL,
	icount INT NULL,
	ioffset INT NULL,
	fcount INT NULL,
	foffset INT NULL,
	scount INT NULL,
	soffset INT NULL,
	fileoffset INT NULL,
	barwidth INT NOT NULL,
	delvar VARCHAR(10) NULL,
	gedcom VARCHAR(20) NULL,
	branch VARCHAR(20) NULL,
	ncount INT NULL,
	noffset INT NULL,
	rcount INT NULL,
	roffset INT NULL,
	mcount INT NULL,
    pcount INT NULL,
	ucaselast TINYINT NULL,
	norecalc TINYINT NULL,
	media TINYINT NULL,
	neweronly TINYINT NULL,
	allevents TINYINT NULL,
	lasttype TINYINT NULL,
	lastid VARCHAR(255) NULL,
	PRIMARY KEY (ID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$saveimport_table);

$sources_table = addPrefix($sources_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $sources_table";
$result = performQuery($query);
$query = "CREATE TABLE $sources_table (
	ID INT NOT NULL AUTO_INCREMENT,
	gedcom VARCHAR(20) NOT NULL,
	sourceID VARCHAR(22) NOT NULL,
	callnum VARCHAR(120) NOT NULL,
	type VARCHAR(20) NULL,
	title TEXT NOT NULL,
	author TEXT NOT NULL,
	publisher TEXT NOT NULL,
	other TEXT NOT NULL,
	shorttitle TEXT NOT NULL,
	comments TEXT NULL,
	actualtext TEXT NOT NULL,
	repoID VARCHAR(22) NOT NULL,
	changedate DATETIME NOT NULL,
	changedby VARCHAR(100) NOT NULL,
	PRIMARY KEY (ID),
	FULLTEXT sourcetext (actualtext),
	UNIQUE sourceID (gedcom, sourceID),
	INDEX changedate (changedate)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$sources_table);

$states_table = addPrefix($states_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $states_table";
$result = performQuery($query);
$query = "CREATE TABLE $states_table (
   state varchar(64) NOT NULL,
   PRIMARY KEY (state)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$states_table);

$temp_events_table = addPrefix($temp_events_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $temp_events_table";
$result = performQuery($query);
$query = "CREATE TABLE $temp_events_table (
	tempID INT NOT NULL AUTO_INCREMENT,
	type CHAR(1) NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	personID VARCHAR(22) NOT NULL,
	familyID VARCHAR(22) NOT NULL,
	eventID VARCHAR(10) NOT NULL,
	eventdate VARCHAR(50) NOT NULL,
	eventplace TEXT NOT NULL,
	info TEXT NOT NULL,
	note TEXT NOT NULL,
	user VARCHAR(20) NOT NULL,
	postdate DATETIME NOT NULL,
	PRIMARY KEY (tempID),
	INDEX gedtype (gedcom, type),
	INDEX user (user)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$temp_events_table);

include($tngconfig['subroot'] . "templateconfig.php");
$templates_table = addPrefix($templates_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $templates_table";
$result = performQuery($query);
$query = "CREATE TABLE $templates_table (
	id INT NOT NULL AUTO_INCREMENT,
	template varchar(64) NOT NULL,
	ordernum INT NOT NULL,
	keyname varchar(64) NOT NULL,
	language varchar(64) NOT NULL,
	value text NOT NULL,
	PRIMARY KEY (id),
	UNIQUE template (template, keyname, language),
	INDEX var_order (template, ordernum)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$templates_table);

$query = "INSERT IGNORE INTO $templates_table (template,ordernum,keyname,language,value) VALUES ";
$values = "";
foreach($tmp as $key => $value) {
	$keyparts = explode("_",$key);
	$template = substr($keyparts[0],1);
	if(!isset($orders[$template]))
		$orders[$template] = 1;
	else
		$orders[$template]++;
	$keyname = $keyparts[1];
	$num_keyparts = count($keyparts);
	if($values) $values .= ", ";
	$values .= "(\"$template\",\"{$orders[$template]}\",\"$keyname\",\"\",\"" . addslashes($value) . "\")";
}
$query .= $values;
$result = tng_query($query);

$tlevents_table = addPrefix($tlevents_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $tlevents_table";
$result = performQuery($query);
$query = "CREATE TABLE $tlevents_table (
   tleventID INT NOT NULL AUTO_INCREMENT,
   evday TINYINT NOT NULL,
   evmonth TINYINT NOT NULL,
   evyear VARCHAR(10) NOT NULL,
   endday TINYINT NOT NULL,
   endmonth TINYINT NOT NULL,
   endyear VARCHAR(10) NOT NULL,
   evtitle VARCHAR(128) NOT NULL,
   evdetail TEXT NOT NULL,
   PRIMARY KEY (tleventID),
   INDEX evyear (evyear, evmonth, evday, evdetail(100)),
   INDEX evdetail (evdetail(100))
) ENGINE = $engine $collationstr";
$result = performQuery($query,$tlevents_table);

$trees_table = addPrefix($trees_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $trees_table";
$result = performQuery($query);
$query = "CREATE TABLE $trees_table (
	gedcom VARCHAR(20) NOT NULL,
	treename VARCHAR(100) NOT NULL,
	description TEXT NOT NULL,
	owner VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL,
	address VARCHAR(100) NOT NULL,
	city VARCHAR(40) NOT NULL,
	state VARCHAR(30) NOT NULL,
	country VARCHAR(30) NOT NULL,
	zip VARCHAR(20) NOT NULL,
	phone VARCHAR(30) NOT NULL,
	secret TINYINT NOT NULL,
	disallowgedcreate TINYINT NOT NULL,
    disallowpdf TINYINT NOT NULL,
	lastimportdate DATETIME NOT NULL,
	importfilename VARCHAR(100) NOT NULL,
	PRIMARY KEY (gedcom)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$trees_table);

$users_table = addPrefix($users_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $users_table";
$result = performQuery($query);
$query = "CREATE TABLE $users_table (
	userID INT NOT NULL AUTO_INCREMENT,
	description VARCHAR(50) NOT NULL,
	username VARCHAR(100) NOT NULL,
	password VARCHAR(128) NOT NULL,
	password_type VARCHAR(10) NOT NULL,
	gedcom VARCHAR(128) NULL,
	mygedcom VARCHAR(20) NOT NULL,
	personID VARCHAR(22) NOT NULL,
	role VARCHAR(15) NOT NULL,
	allow_edit TINYINT NOT NULL,
	allow_add TINYINT NOT NULL,
	tentative_edit TINYINT NOT NULL,
	allow_delete TINYINT NOT NULL,
	allow_lds TINYINT NOT NULL,
	allow_ged TINYINT NOT NULL,
	allow_pdf TINYINT NOT NULL,
	allow_living TINYINT NOT NULL,
	allow_private TINYINT NOT NULL,
	allow_private_notes TINYINT NOT NULL,
	allow_private_media TINYINT NOT NULL,
	allow_profile TINYINT NOT NULL,
	branch VARCHAR(20) NULL,
	realname VARCHAR(50) NULL,
	phone VARCHAR(30) NULL,
	email VARCHAR(50) NULL,
	address VARCHAR(100) NULL,
	city VARCHAR(64) NULL,
	state VARCHAR(64) NULL,
	zip VARCHAR(10) NULL,
	country VARCHAR(64) NULL,
	website VARCHAR(128) NULL,
	languageID SMALLINT NOT NULL,
	lastlogin DATETIME NOT NULL,
	disabled TINYINT NOT NULL,
	dt_registered DATETIME NOT NULL,
	dt_activated DATETIME NOT NULL,
	dt_consented DATETIME NOT NULL,
	no_email TINYINT NULL,
	notes TEXT NULL,
	reset_pwd_code VARCHAR(30) NULL,
	PRIMARY KEY (userID),
	UNIQUE username (username)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$users_table);

$xnotes_table = addPrefix($xnotes_table,$table_prefix);
$query = "DROP TABLE IF EXISTS $xnotes_table";
$result = performQuery($query);
$query = "CREATE TABLE $xnotes_table (
	ID INT NOT NULL AUTO_INCREMENT,
	noteID VARCHAR(22) NOT NULL,
	gedcom VARCHAR(20) NOT NULL,
	note TEXT NOT NULL,
	PRIMARY KEY (ID),
	FULLTEXT note (note),
	INDEX noteID (gedcom, noteID)
) ENGINE = $engine $collationstr";
$result = performQuery($query,$xnotes_table);
?>