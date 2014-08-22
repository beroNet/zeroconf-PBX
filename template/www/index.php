<?php


function get_userapp_name () {
	$ret = "Unknown UserAppFS";
	if (($fp = fopen("/apps/asterisk/VERSION", "r"))) {
		$buf = fread($fp, 1024);
		fclose($fp);
		if (preg_match("/NAME=.+\n/", $buf, $matches)) {
			$ret = trim(substr($matches[0], strpos($matches[0], '=') + 1), "\"\n");
		}
	}
	return($ret);
}
$userapp_n	= get_userapp_name();

if ($_GET['action'] == "reload" ) {
    exec('/apps/asterisk/bin/asterisk -C /apps/asterisk/etc/asterisk/asterisk.conf -rnx "core reload"');
}

exec('/apps/asterisk/bin/asterisk -C /apps/asterisk/etc/asterisk/asterisk.conf -rnx "sip show peers" | sed "s/Dyn Forcerport ACL//" | sed "s/ D //" | sed "s/ N //" | sed "s/OK (\(.*\) ms)/OK-(\1_ms)/"  | grep -v "Monitored:" | sed "s/[ ]*/<\/td><td>/g"  | sed "s/^<td>//" | sed "s/^<\/td>//" | sed "s/<td>$//"', $tmppeers);
$sippeers=implode("<tr></tr>", $tmppeers);

exec('cat /apps/asterisk/etc/asterisk/sip_secrets.conf | sed "s/[\(\!\)]//g" | sed "s/[ ]*/<\/td><td>/g"  | sed "s/^<td>//" | sed "s/^<\/td>//" | sed "s/<td>$//"', $tmpsecrets);
$sipsecrets=implode("<tr></tr>", $tmpsecrets);

?>


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
 <head>
  <link type="text/css" href="./include/css/berofog.css" rel="Stylesheet" />
  <title><?php echo $userapp_n ?> </title>
 </head>

 <body>
  <div class='main'>
  <div class='top'><img src="./include/images/bg_top.png"/></div>
  <div class='left'>

  <h1> <?php echo $userapp_n ?>  </h1>
  <hr noshade/>
  <div>Go to: 
   <table><tr>
    <td><a href="/app/berogui/">berogui</a></td>
    <td><a href="filemanager.php">Asterisk Configuration</a></td>
    <td><a href="index.php?action=reload">Reload Configuration</a></td>
    </tr>
   </table>
  </div>

  <h2>Asterisk zeroconf-PBX</h2>
  <div>You can use SIP Phones to register at Asterisk with SIP Port 25060<br>
  There are 10 SIP Users: Username=10..19 Secret=CHECK BELOW..CHECK BELOW<br><br>
  <b>Example SIP Phone Configuration:</b><br>
  SIP Registrar: <?php echo $_SERVER['SERVER_NAME'] ?>:25060<br>
  SIP Server: <?php echo $_SERVER['SERVER_NAME'] ?>:25060<br>
  SIP Proxy: <?php echo $_SERVER['SERVER_NAME'] ?>:25060<br>
  SIP Server Port: 25060<br>
  Username=10<br>
  Secret=*** CHECK BELOW ***<br>
  <br>
  <b>Howto Dial</b><br>
  Every extensions can reach each other, by just dialing the extensions. <b>Example:</b> Dial 11 to reach Phone 11<br>
  The beroFix can be reached by prefixing the call with a 0. <b>Example:</b> Dial 01234 to dial 1234 to berofix.<br>
<pre>
extensions.conf
=============== 

. calls to FXS (_2X) ports
. calls to FXO (_9Z) ports
. prefix 9 for outgoing calls to first FXO port (equivalent to 91)

globals have an added parameter:

[globals](+)
DEFAULT_TRUNK=berofix-trunk
DEFAULT_TECH=SIP

sip.conf
========
SIP accounts ...: 10 to 19 (10)
SIP FXS accounts: 20 to 27 (8)
SIP FXO accounts: 91 to 98 (8)

SIP berofix-trunk has an added parameter:

[berofix-trunk](+)
insecure=invite

sip_secrets.conf
================
secret value for sip extensions


What's new:

* SIP extensions have secret value generated during installation
* FXS port(s) can be register as SIP extensions
* FXS port(s) can call each other as well as VOIP extensions
* VOIP extensions can call FXS port(s)
* FXO port(s) can be register as SIP extensions
* incoming ISDN or FXO calls are sended to extension 00, which per default call SIP/10, SIP/11 (2 first VOIP phones) and SIP/20, SIP/21 (2 first FXS phones)
* Not answered incoming calls to 00 extension are redirected to voicemail
* Voicemail is connected to extension *98, retrieve message LED on SIP phones is working (tested on snom320)
* FXO lines have to be connected in order (eg: the first MUST be in first port, second in second, aso)
  Please check the graphical representation of the port assignment to know the right order 
* Outgoing calls through berofix-trunk are automatically redirected to FXO port in case of failure (CONGESTION or CHANUNAVAIL)
* No more need to prefix with 0 for outgoing calls
* Extension 99 plays demo echotest, SIP phones connected outside the local LAN can now test audio (speaking and listening)
* Channel language is setted via a global variable DEVICE_LANGUAGE, english (en) is default value. A foreign asterisk_sound app have to set this variable.
  (see asterisk_sound_fr). Note: only one language can be installed at a time.
* Add DIAL_OPTIONS global variable
* Add LOCAL_RINGPHONES as global variable to allow local setting of ringing phones for incoming calls
* Add LOCAL_CIDNUM and LOCAL_CIDNAME as global variables to allow general CID for outgoing calls

</pre>


  <br><b>SIP Status:</b><br>
  <table width=100%>
   <?php echo $sippeers ?>
  </table>
  <br><b>SIP Secrets:</b><br>
  <table width=100%>
   <?php echo $sipsecrets ?>
  </table>
 </div>
 </div>
 <div class='bottom'><img src="./include/images/bg_bottom.png"></div>
 </div>
 </body>
</html>
