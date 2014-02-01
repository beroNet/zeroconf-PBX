zeroconf-PBX
============

beroFix PBX App, which requires no configuration, because it has a static configuration.



v20140201 - devel@tootai.net

extensions.conf
===============

. calls to FXS (_2X) ports
. calls to FXO (_9Z) ports
. prefix 9 for outgoing calls to first FXO port (equivalent to 91)

sip.conf
========
SIP accounts ...: 10 to 19 (10)
SIP FXS accounts: 20 to 27 (8)
SIP FXO accounts: 91 to 94 (4)

SIP berofix-trunk has an added parameter:

[berofix-trunk](+)
insecure=invite

What's new:

* FXS port(s) can be register as SIP extensions
* FXS port(s) can call each other as well as VOIP extensions
* VOIP extensions can call FXS port(s)
* FXO port(s) can be register as SIP extensions
* incoming ISDN or FXO calls can be send to extension 00, which per default call SIP/10, SIP/11 (2 first VOIP phones) and SIP/20, SIP/21 (2 first FXS phones)
* FXO lines have to be connected in order (eg: the first MUST be in first port, second in second, aso)
  Please check the graphical representation of the port assignment to know the right order


Enjoy!

