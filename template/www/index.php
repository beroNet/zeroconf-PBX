<?php

include(file_exists('/home/admin/lib/php/beroGui.class.php') ? '/home/admin/lib/php/beroGui.class.php' : '/apps/asterisk/lib/php/beroGui.class.php');

$app_name = 'zeroconfPBX';
require_once(file_exists('/home/admin/lib/php/session.php') ? '/home/admin/lib/php/session.php' : '/apps/asterisk/lib/php/session.php');

$menu = array(  array('url' => 'index.php', 'id' => 'overview', 'title' => 'Overview'),
		array('url' => 'changelog.php', 'id' => 'changelog', 'title' => 'Changelog'),
		array('url' => 'sippeers.php', 'id' => 'sippeers', 'title' => 'SIP Peers'));

$gui = new beroGUIv2($app_name);

$body =	'<div>' . "\n" .
	'You can use SIP Phones to register at Asterisk with SIP Port 25060<br />' . "\n" .
	'There are 10 SIP Users. You can retrieve their Username and Secret from the section \'SIP-Peers\'.<br /><br />' . "\n" .
	'<h3>SIP-Phone Serversettings</h3><br />' . "\n" .
	'SIP Registrar: ' . $_SERVER['SERVER_NAME'] . ':25060<br />' . "\n" .
	'SIP Server: ' . $_SERVER['SERVER_NAME'] . ':25060<br/ >' . "\n" .
	'SIP Proxy: ' . $_SERVER['SERVER_NAME'] . ':25060<br /><br />' . "\n" .
	'<h3>Howto Dial</h3><br />' . "\n" .
	'The extensions can reach each other by just dialing an extension.<br />' . "\n" .
	'<b>Example:</b> Dial 11 to reach Phone 11<br /><br />' . "\n" .
	'The beroNet VoIP Gateway can be reached by prefixing the call with 0.<br />' . "\n" .
	'<b>Example:</b> Dial 01234 to dial 1234 to beroNet VoIP Gateway.' . "\n" .
	'</div>' . "\n";

echo    $gui->get_MainHeader($menu, null) .
	$body .
	$gui->get_MainFooter();

?>
