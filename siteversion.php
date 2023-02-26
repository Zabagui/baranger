<?php
function getSiteVersion($nomobile = false) {
	$sitever = "standard";
	if(!empty($_SERVER['HTTP_USER_AGENT'])) {
		$ua = $_SERVER['HTTP_USER_AGENT'];
		$tablet = stristr($ua, 'Tablet') || stristr($ua, 'iPad') || (stristr($ua, 'Android') && !stristr($ua, 'Mobile')) || stristr($ua, 'Android 3') || stristr($ua, 'Android 4') && !stristr($ua, 'Mobile') || stristr($ua, 'Touch');
		$mobile = !$nomobile && (stristr($ua, 'Android') || stristr($ua, 'webOS') || stristr($ua, 'Blackberry') || stristr($ua, 'iPhone')
			 || stristr($ua, 'iPod') || stristr($ua, 'Kindle') || stristr($ua, 'facebookexternalhit') || stristr($ua, 'Twitterbot')
			 || stristr($ua, 'Pinterest') || stristr($ua, 'Silk') || stristr($ua, 'IEMobile'));
		if($tablet)
			$sitever = "tablet";
		else if($mobile)
			$sitever = "mobile";
	}
	return $sitever;
}
?>