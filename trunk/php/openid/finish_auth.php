<?php

require_once "common.php";
session_start();

// Complete the authentication process using the server's response.
$response = $consumer->complete($_GET);

if ($response->status == Auth_OpenID_CANCEL) {
    // This means the authentication was cancelled.
	// FIXME: Was tun nach Abbruch?
    $msg = 'Verification cancelled.';
} else if ($response->status == Auth_OpenID_FAILURE) {
	// FIXME: Was tun nach fehlerhafter Anmeldung?
    $msg = "OpenID authentication failed: " . $response->message;
} else if ($response->status == Auth_OpenID_SUCCESS) {
    // This means the authentication succeeded.
    $openid = $response->identity_url;
    $esc_identity = htmlspecialchars($openid, ENT_QUOTES);
    $success = sprintf('You have successfully verified ' .
                       '<a href="%s">%s</a> as your identity.',
                       $esc_identity, $esc_identity);

    if ($response->endpoint->canonicalID) {
        $success .= '  (XRI CanonicalID: '.$response->endpoint->canonicalID.') ';
    }

    $sreg = $response->extensionResponse('sreg');

	$_SESSION["openidsreg"] = $sreg;
	$_SESSION["openid"] = $esc_identity;
	/*
    if (@$sreg['email']) {
        $success .= "  You also returned '".$sreg['email']."' as your email.";
    }
    if (@$sreg['postcode']) {
        $success .= "  Your postal code is '".$sreg['postcode']."'";
    }
	*/


}
	if (isset($msg)) Error($msg);
//    if (isset($error)) Error($error);
    if (isset($success)) Error($success);
?>