#!/bin/bash

if [ "${1}" == "update" ]; then
	exit 0
fi

# remove zeroconfPBX-trunk related dialplan-entries
cat /usr/conf/isgw.dialplan | grep -v zeroconfPBX-trunk > /usr/conf/isgw.dialplan.tmp
mv /usr/conf/isgw.dialplan.tmp /usr/conf/isgw.dialplan

# remove zeroconfPBX-trunk from isgw.sip
keep=1;
while read line; do
	if [ "${line}" = "[zeroconfPBX-trunk]" ]; then
		keep=0
	elif [ "${line:0:1}" = "[" ]; then
		keep=1
	fi;

	if [ ${keep} -eq 1 ]; then
		echo ${line} >> /usr/conf/isgw.sip.tmp
	fi
done < /usr/conf/isgw.sip

# move the temporary file to isgw.sip
mv /usr/conf/isgw.sip.tmp /usr/conf/isgw.sip

# apply changes
/usr/bin/env -i bash -c "/usr/local/www/berogui/misc/ini_to_db.php" 2>/dev/null
