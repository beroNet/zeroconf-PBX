<?php

function get_secrets () {

	$content = @file('/apps/zeroconfPBX/etc/asterisk/sip.conf');

	if (empty($content)) {
		return(false);
	}

	unset($ret);
	unset($key);
	unset($val);
	foreach ($content as $line) {
		if (preg_match('/\[([0-9*]*)\]/', $line, $matches) == 1) {
			$key = $matches[1];
		}

		if (isset($key)) {
			if (preg_match('/secret=(.*)/', $line, $matches) == 1) {
				$val = $matches[1];
			}
		}

		if (isset($key) && isset($val)) {
			$ret[$key] = $val;
			unset($key);
			unset($val);
		}
	}

	return($ret);
}

$app_name = 'zeroconfPBX';
include(file_exists('/home/admin/lib/php/beroGui.class.php') ? '/home/admin/lib/php/beroGui.class.php' : '/apps/' . $app_name . '/lib/php/beroGui.class.php');
require_once(file_exists('/home/admin/lib/php/session.php') ? '/home/admin/lib/php/session.php' : '/apps/' . $app_name . '/lib/php/session.php');

$menu = array(  array('url' => 'index.php', 'id' => 'overview', 'title' => 'Overview'),
		array('url' => 'changelog.php', 'id' => 'changelog', 'title' => 'Changelog'),
		array('url' => 'sippeers.php', 'id' => 'sippeers', 'title' => 'SIP Peers'));

$gui = new beroGUIv2($app_name);

if (($secrets = get_secrets()) !== false) {

	$body =	'<div>' . "\n" .
		'<table id="table" class="contenttoc" width="35%">' . "\n" .
		'<tr><th colspan="2">SIP Peers</th></tr>' . "\n" .
		'<tr><td>Name</td><td>Secret</td></tr>' . "\n";

	foreach ($secrets as $peer => $secret) {
		$body .= '<tr><td>' . $peer . '</td><td style="font-family: monospace;">' . $secret . '</td></tr>' . "\n";
	}

	$body .='</table>' . "\n" .
		'</div>' . "\n";
}

echo    $gui->get_MainHeader($menu, null) .
	$body .
	$gui->get_MainFooter();

?>
