<?php
// based on the code supplied by the reCAPTCHA web site
// with modifications by Roger Moffat and Bryan S. Larson to work with TNG
// Version: No Captcha reCAPTCHA v10.1.0.3 last modified 23 Feb 2015 by Bryan S. Larson
// This update adds a feature to 'remember' if a visitor has successfully completed a reCAPTCHA challenge, no further challenges will be presented to that visitor during the visit.

global $currentuser, $enttype;
// The $_SESSION variable is not set upon initial entry.
if ( $currentuser || !empty($_SESSION['passedcaptcha']) )
	return;

include_once($cms['tngpath'] . "$mylanguage/admintext.php");
require_once($cms['tngpath'] . "recaptchalib.php");

// Sign up for a reCAPTCHA account from https://www.google.com/recaptcha/admin/create
// Once your account is created, enter your assigned keys
// in customconfig.php or uncomment the next 2 lines and enter it below.
//$siteKey = "yoursiteKeyHere";
//$secret = "yoursecretKeyHere";

// These variables seem to not be set.
$tngSiteKey = !empty($siteKey) ? $siteKey : $tngconfig['sitekey'];
$tngSecret = !empty($secret) ? $secret : $tngconfig['secret'];

if($tngSiteKey && $tngSecret) {

    // In the next group of 2 lines, comment out the line that you do NOT want
    //as the Theme. The last uncommented line will be in effect.

    $captchatheme = "light";
    //$captchatheme = "dark";


    // This "switch" statement sets the language code for the reCAPTCHA 
    $captchalang = isset($text['glang']) ? $text['glang'] : "";

    // The response from reCAPTCHA
    $resp = null;
    // The error code from reCAPTCHA, if any
    $error = null;

    $reCaptcha = new ReCaptcha($tngSecret);
    if (empty($reCaptcha->_secret)) {
        $reCaptcha->ReCaptcha($tngSecret);
    }

    # was there a reCAPTCHA response?
	// There isn't a response the first time.
    if (!empty($_POST["g-recaptcha-response"])) {
    		$resp = $reCaptcha->verifyResponse(
    										$_SERVER["REMOTE_ADDR"],
    										$_POST["g-recaptcha-response"]
    );
    }

    if ($resp != null && $resp->success) {
    		$_SESSION['passedcaptcha'] = 'true';
                    return;
    }										
    // if the response from the reCAPTCHA is valid, return to suggest.php

/*
echo "<script type=\"text/javascript\">
        var RecaptchaOptions = {
           lang : '$captchalang',
           theme : '$captchatheme'
        };
        </script>\n";
*/
    $uri = $_SERVER['REQUEST_URI'];
	// Typo in the regex
    $uri = preg_replace("/[^a-zA-Z0-9\s_.%&\/=?\-#]/", "", $uri);

 ?>

	<form action="<?php echo $uri; ?>" method="post">
		<div class="g-recaptcha" data-sitekey="<?php echo $tngSiteKey;?>" data-theme="<?php echo $captchatheme;?>"></div>
			<script type="text/javascript"
			src="https://www.google.com/recaptcha/api.js<?php echo !empty($captchalang) ? "?hl=" . $captchalang : "";?>">
			</script>
	<br/>
		<input type="submit" value="<?php echo $admtext['text_continue']; ?>" />
		<input type="hidden" name="enttype" value="<?php echo $enttype; ?>" />
		<input type="hidden" name="ID" value="<?php echo $ID; ?>" />
		<input type="hidden" name="tree" value="<?php echo $tree; ?>" />
	</form>
	<input type="hidden" name="fingerprint" value="realperson" />
<?php
    	tng_footer( "" );
    	exit;
    }
?>