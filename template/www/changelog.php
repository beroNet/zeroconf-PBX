<?php

include(file_exists('/home/admin/lib/php/beroGui.class.php') ? '/home/admin/lib/php/beroGui.class.php' : '/apps/asterisk/lib/php/beroGui.class.php');

$app_name = 'zeroconfPBX';
require_once(file_exists('/home/admin/lib/php/session.php') ? '/home/admin/lib/php/session.php' : '/apps/asterisk/lib/php/session.php');

$menu = array(  array('url' => 'index.php', 'id' => 'overview', 'title' => 'Overview'),
		array('url' => 'changelog.php', 'id' => 'changelog', 'title' => 'Changelog'),
		array('url' => 'sippeers.php', 'id' => 'sippeers', 'title' => 'SIP Peers'),
		array('url' => '/userapp/asterisk/', 'id' => 'asterisk', 'title' => 'Asterisk'));

$gui = new beroGUIv2($app_name);

$body = '<h2>Changelog</h2>' . "\n" .
	'<div style="margin-left: 20px; font-family: monospace; font-size: 11px;">' . "\n" .
	'<ul>' . "\n" .
	'<li>SIP extensions have secret value generated during installation</li>' . "\n" .
	'<li>FXS port(s) can be register as SIP extensions</li>' . "\n" .
	'<li>FXS port(s) can call each other as well as VOIP extensions</li>' . "\n" .
	'<li>VOIP extensions can call FXS port(s)</li>' . "\n" .
	'<li>FXO port(s) can be register as SIP extensions</li>' . "\n" .
	'<li>incoming ISDN or FXO calls are sended to extension 00, which per default call SIP/10, SIP/11 (2 first VOIP phones) ' .
	'and SIP/20, SIP/21 (2 first FXS phones)</li>' . "\n" .
	'<li>Not answered incoming calls to 00 extension are redirected to voicemail</li>' . "\n" .
	'<li>Voicemail is connected to extension *98, retrieve message LED on SIP phones is working (tested on snom320)</li>' . "\n" .
	'<li>FXO lines have to be connected in order (eg: the first MUST be in first port, second in second, aso)<br />' . "\n" .
	'Please check the graphical representation of the port assignment to know the right order</li>' . "\n" .
	'<li>Outgoing calls through berofix-trunk are automatically redirected to FXO port in case of failure (CONGESTION or CHANUNAVAIL)</li>' . "\n" .
	'<li>No more need to prefix with 0 for outgoing calls</li>' . "\n" .
	'<li>Extension 99 plays demo echotest, SIP phones connected outside the local LAN can now test audio (speaking and listening)</li>' . "\n" .
	'<li>Channel language is setted via a global variable DEVICE_LANGUAGE, english (en) is default value. ' .
	'A foreign asterisk_sound app have to set this variable.<br />' . "\n" .
	'(see asterisk_sound_fr). Note: only one language can be installed at a time.</li>' . "\n" .
	'<li>Added DIAL_OPTIONS global variable</li>' . "\n" .
	'<li>Added LOCAL_RINGPHONES as global variable to allow local setting of ringing phones for incoming calls</li>' . "\n" .
	'<li>Added LOCAL_CIDNUM and LOCAL_CIDNAME as global variables to allow general CID for outgoing calls</li>' . "\n" .
	'<li>Added LOCAL_VOICEMAIL as global variable to activate/deactivate voicemail</li>' . "\n" .
	'<li>Added LOCAL_RINGTIME as global variable to set the default ring timeout on incoming calls</li>' . "\n" .
	'</ul>' ."\n" .
	'</div>' . "\n";

echo    $gui->get_MainHeader($menu, null) .
	$body .
	$gui->get_MainFooter();

?>
