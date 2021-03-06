zeroconfPBX
============

beroFix PBX App, which requires no configuration, because it has a static configuration. Need asterisk base App.


v7, 20150219 - support@beronet.com
v6, 20140503 - devel@tootai.net

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

* new GUI
* SIP-Extensions are generated the way it is supposed to be
* use Gateways Session-Management, removed filemanager
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
* MusicOnHold during transfer
* Accept SIP or IAX trunk via App zeroconfPBX-trunk
* Create local context
* Add DIAL_OPTIONS global variable
* Add LOCAL_RINGPHONES as global variable to allow local setting of ringing phones for incoming calls
* Add LOCAL_CIDNUM and LOCAL_CIDNAME as global variables to allow general CID for outgoing calls
* Add LOCAL_VOICEMAIL as global variable to activate/deactivate voicemail
* Add LOCAL_RINGTIME as global variable to set the default ring timeout on incoming calls

Enjoy!

