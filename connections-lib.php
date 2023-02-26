<?php
// functions used for data validation and result presentation

function failMessage($code,$msg) { // http error code with custom message
    die(header("HTTP/1.0 " . $code .": " . $msg));
}
function doneMessage($code,$msg) { // http result code with message
    echo $code . ": " . $msg;
}

function errorMessage($error,$displayText) { // display message and hide spinner
    global $text;
    echo "<p>$error {$text[$displayText]}<p>\n";
    echo "<script type='text/javascript'>jQuery(document).ready(function(){jQuery('#searching').hide();});</script>";
}

function swapPeople() {
	global $namestr1, $namestr2, $gender1, $gender2;
	$namestr3 = $namestr2;
	$namestr2 = $namestr1;
	$namestr1 = $namestr3;
	$gender3 = $gender2;
	$gender2 = $gender1;
	$gender1 = $gender3;
}

function calcDigits($graph) {
// determine number of digits in case ID length is fixed (like CFTW) to convert IRN->ID
    global $tngconfig; // Indi/Fam prefixes are inside
    $indPref = $tngconfig['personprefix'];
    $indSuff = $tngconfig['personsuffix'];
//    $famPref = $tngconfig['familyprefix'];
//    $famSuff = $tngconfig['familysuffix'];
// $idDigits=1 unless any numeric part of ID has leading 0
    $idDigits = 1;
    foreach ($graph as $indID => $nn) {
        $dig = substr($indID, strlen($indPref), strlen($indID) - strlen($indPref) - strlen($indSuff));
        if (is_numeric($dig)) { // either number or numeric string
            if (strval($dig)[0] == "0") { // starts with 0
                $idDigits = strlen(strval($dig));
                break; // don't search anymore - assume that other IDs are of the same structure
            }
        }
    }
//die("<br>digits = $idDigits");
    $tngconfig['iddigits'] = $idDigits;
    $tngconfig['maxidlength'] = max(6,$idDigits) + strlen($indPref) + strlen($indSuff);
    return $idDigits;
}

function checkedID (&$indID) {
    global $tngconfig;
    if (strlen($indID)>$tngconfig['maxidlength']) return("length"); // indID too long
    $indPref = $tngconfig['personprefix'];
    $indSuff = $tngconfig['personsuffix'];
    if(is_numeric($indID)) { // convert IRN to ID
        if ($indID<=0 || $indID>99999) return("number out of range");
        $idDigits = $tngconfig['iddigits']; // needed to convert IRN to ID
        $digstr="%0".$idDigits."d";
        $indID = $indPref.sprintf($digstr,$indID).$indSuff;
    }
    else {
        $indID = strtoupper($indID);
        if ($indID != cleanIt($indID)) return("chars");
        if (strpos($indID,$indPref)!==0) return("prefix");
        if (strlen($indSuff)!=0 && substr($indID,-strlen($indSuff))!=$indSuff) return("suffix");
        if (!is_numeric(substr($indID,strlen($indPref),strlen($indID)-strlen($indPref)-strlen($indSuff)))) return("numeric part");
    }
//    $x="idDigits = $idDigits"; die($x);
    return("");
}

function mjainitials ($allnames) {
    $initials = "";
    $names = preg_replace('/[^\p{L}( )-]/u',"",$allnames); // remove UTF non-letter leaving ( )-
    foreach (explode(" ",$names) as $name) {
        $name = preg_replace('/^-|-$/',"",$name); // leave hyphens only inside name (just for case)
        $chars = preg_split("//u", $name, -1, PREG_SPLIT_NO_EMPTY); // array of UTF chars
        if (reset($chars)=="(" && end($chars)==")" ) // spec case - name in brackets - ignore
           continue;
        elseif (in_array("-",$chars)) { // spec case - compound name like Jean-Marie
            $initials .= $chars[0];
            foreach ($chars as $pos=>$ch) if ($ch=="-")
                $initials .= "-{$chars[$pos+1]}";
        }
        else { // usual case
            $initials .= "$chars[0].";
        }
        $initials .= " ";
    }
    return $initials;
}

function shortname($row) { // return: first name + middle initials + surname + title if short + suffix if short
    global $text, $admtext, $tngconfig, $nonames, $nameorder, $session_charset;
//    $nameorder = !empty($row['nameorder']) ? $row['nameorder'] : (!empty($order) ? $order : 1);
//    $nameorder = $order;
    $indexlist = array('lastname','firstname','lnprefix','allow_living','allow_private','title','prefix');
    foreach($indexlist as $index) if(!isset($row[$index])) $row[$index] = '';

    $lastname = trim($row['lnprefix']." ".$row['lastname']);
    $lastname = ($tngconfig['ucsurnames']) ? tng_strtoupper($lastname) : mb_convert_case($row['lastname'], MB_CASE_TITLE, "UTF-8");
    $title = $row['title'] && ($row['title']==$row['prefix']) ? $row['title'] : trim($row['title']." ".$row['prefix']);
    $title = strlen($title)<6 ? $title : "";
    $suffix = $row['suffix'] && (strlen($row['suffix'])<6) ? $row['suffix'] : "";

    if ($row['living'] && !$row['allow_living'] && $nonames==2
        || $row['private'] && !$row['allow_private'] && $tngconfig['nnpriv']==2 ) { // only initials allowed
        $initials = mjainitials($row['firstname']);
        $namestr = constructName($initials, $lastname, $title, $suffix, $nameorder);
    }
    else {
        $firstnames = explode(" ",$row['firstname']);
        $firstname = $firstnames[0];
        $middlenames = implode(" ",array_slice($firstnames, 1));
        $initials = $middlenames ? " ".mjainitials($middlenames) : "";
        $namestr = constructName($firstname.$initials, $lastname, $title, $suffix, $nameorder);
        if ($row['living'] && !$row['allow_living'] && $nonames==1 )
            $namestr = $text['living'];
        elseif ($row['private'] && !$row['allow_private'] && $tngconfig['nnpriv']==1 )
            $namestr = $admtext['text_private'];
    }
    return $namestr;
}

function lifeYears($row) { // return string of birth-death years
    $signs = ["&#60;"=>"BEF","&#62;"=>"AFT","&#126;"=>"ABT","&#177;"=>"EST"];
    $bYr = $row['birth']; $dYr = $row['death'];
    $birth = $row['birthdate'] ? $row['birthdate'] : $row['altbirthdate'];
    $death = $row['deathdate'] ? $row['deathdate'] : $row['burialdate'];
    $bdYears='';
    if ($bYr) { // not empty
        if ($sign=array_search(substr($birth,0,3),$signs)) $bdYears .= $sign; // set sign if found, then attach year
        $bdYears.=$bYr;
    }
    else
        $bdYears.="?";
    if (!$row['living']) {
        $bdYears.="&#8239;&ndash;&#8239;";  // sign spaces, longer dash
        if ($dYr) { // not empty
            if ($sign=array_search(substr($death,0,3),$signs)) $bdYears .= $sign; // set sign if found
            $bdYears.=$dYr;
        }
        else
            $bdYears.="?";
    }
    return $bdYears;
}

function display($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
    return "";
}