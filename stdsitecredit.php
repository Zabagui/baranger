<?php
	global $dbowner, $tngconfig, $text;
	$sitecredit = "<p class=\"smaller center\">{$text['pwrdby']} <a href=\"https://tngsitebuilding.com\" class=\"footer\" target=\"_blank\" title=\"Learn more about TNG\">The Next Generation of Genealogy Sitebuilding</a> v. $tng_version,  {$text['writby']} Darrin Lythgoe  &copy; 2001-" . date('Y') . ".</p>\n";
	if($dbowner) {
		$suggest_url = getURL( "suggest", 1 );
		if(!empty($tngconfig['dataprotect']) && strpos($_SERVER['REQUEST_URI'],"/data_protection_policy.php") === FALSE) {
			$dataprotect_url = getURL( "data_protection_policy", 0 );
			$data_protection_link = " | <a href=\"{$dataprotect_url}\" class=\"footer\" title=\"{$text['dataprotect']}\" target=\"_blank\">{$text['dataprotect']}</a>.\n";
		}
		else
			$data_protection_link = "";
		$sitecredit .= "<p class=\"smaller center\">{$text['maintby']} <a href=\"$suggest_url\" class=\"footer\" title=\"{$text['contactus']}\">$dbowner</a>.{$data_protection_link}</p>\n";
	}
	if(!empty($tngconfig['footermsg'])) {
		$sitecredit .= "<p class=\"smaller center \">{$tngconfig['footermsg']}</p>\n";
	}
?>