<?php
function writelog( $string ) {
	global $text, $currentuser, $currentuserdesc, $cms, $rootpath, $_SERVER, $time_offset, $subroot, $exusers, $session_charset, $badhosts, $charset;

	require($subroot . "logconfig.php");

    if(!isset($_SERVER['REMOTE_HOST'])) $_SERVER['REMOTE_HOST'] = '';
    $remip2 = '';

	$string = str_replace(array("\n","\r")," ",$string);
	if(strpos($string,"http") !== false || strpos($string,"www") !== false)
		return;
	$string = "<td class=\"databack\">" . strip_tags($string, "<a>") . "</td>";

	if($exusers) {
		$users = explode(",", $exusers);
		if(in_array($currentuser,$users))
			return;
	}

	$remhost = $_SERVER['REMOTE_HOST'];
	if( !$remhost ) {
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		    $remip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else
		    $remip = $_SERVER['REMOTE_ADDR'];
		$remhost = @gethostbyaddr( $remip );
		if( !$remhost ) $remhost = $remip;
	}

	if( $badhosts && $remhost ) {
		$terms = explode(",", $badhosts);
		foreach( $terms as $term ) {
			if( $term ) {
				if( strstr( $remhost, trim($term) ) )
					return;
			}
		}
	}

	$remhost = $charset == "UTF-8" ? mb_convert_encoding($remhost, 'UTF-8', 'ISO-8859-1') : mb_convert_encoding($remhost, 'ISO-8859-1', 'UTF-8');

	if( $cms['support'] && $currentuser )
		$string .= "<td class=\"databack\">{$text['user']}: $currentuser</td>";
	else {
		$string .= "<td class=\"databack\">$remhost";
		if( $currentuser ) $string .= " ({$text['user']}: $currentuserdesc)";
		$string .= "</td>";
	}

	$fp = fopen($logfile, "r+");
	if($fp) {
		$locked = getLock($fp, LOCK_SH);
		if($locked) {
			flock($fp, LOCK_UN);
			$lines = file( $logfile );
			$locked = getLock($fp, LOCK_EX);

			if($locked && $lines !== false) {
				if( $maxloglines ) {
					$linecount = sizeof($lines);
					while($linecount >= $maxloglines) {
						array_pop( $lines );
						$linecount--;
					}
					$updated = date ("D d M Y H:i:s", time() + ( 3600 * intval($time_offset) ) );
					$updated = $charset == "UTF-8" ? mb_convert_encoding($updated, 'UTF-8', 'ISO-8859-1') : mb_convert_encoding($updated, 'ISO-8859-1', 'UTF-8');
					array_unshift( $lines, "<tr><td class=\"databack\">$updated</td>" . trim($string) . "</tr>\n" );
					$towrite = join('',$lines);
					//if($session_charset)
						//$towrite = mb_convert_encoding($towrite, $session_charset);

					ftruncate($fp,0);
					fwrite($fp,$towrite);
					fflush($fp);
				}
			}
			flock($fp, LOCK_UN);
		}
		fclose($fp);
	}
}

function getLock($ptr, $lockType) {
	$locked = flock($ptr, $lockType);
	if(!$locked) {
		$counter = 0;
		do {
			sleep(1);
			$locked = flock($ptr, LOCK_EX);
			$counter++;
		} while(!$locked && $counter < 5);
	}

	return $locked;
}

function preparebookmark($string) {
	global $gotlastpage;
	$_SESSION['tnglastpage'] = $string;
	$gotlastpage = true;
}
?>