#!/bin/bash

base_path=/apps/zeroconfPBX
ext_conf=${base_path}/etc/asterisk/extensions.conf
sip_conf=${base_path}/etc/asterisk/sip.conf

if ! grep "\[berofix-trunk\]" /usr/conf/isgw.sip > /dev/null; then
	cat ${base_path}/setup/berofix-trunk_isgw.sip >> /usr/conf/isgw.sip
	/usr/bin/env -i bash -c "/usr/local/www/berogui/misc/ini_to_db.php" 2>/dev/null
fi


if [ -f ${ext_conf} ] ; then
	exit 0
fi

mkdir -p ${base_path}/etc/asterisk/
cp -a ${base_path}/conf/* ${base_path}/etc/asterisk/

if [ -f ${sip_conf} ] ; then
	exit 0
fi

# add header
echo -e "; sip.conf for zeroconfPBX generated by post_install.sh\n" > ${sip_conf}

# add berofix-trunk
echo -e "[berofix-trunk]\ntype=friend\nhost=127.0.0.1\nsecret=berofix-trunk\nusername=berofix-trunk\nfromuser=berofix-trunk\n; insecure=invite\n" >> ${sip_conf}

# add mailbox
echo -e "[vm](!)\nmailbox=100\nvmexten=*98\n" >> ${sip_conf}

# add sip-clients with mailbox
for i in $(seq 10 19); do
	secret=$(sed 's/[^A-Za-z0-9+_@*%?=]//g' /dev/urandom | tr -d "\n" | dd bs=12 count=1 2>/dev/null)
	echo -e "[${i}](vm)\ntype=friend\nhost=dynamic\nusername=${i}\nsecret=${secret}\n" >> ${sip_conf}
done

# add FXO-accounts
for i in $(seq 20 27); do
	secret=$(sed 's/[^A-Za-z0-9+_@*%?=]//g' /dev/urandom | tr -d "\n" | dd bs=12 count=1 2>/dev/null)
	echo -e "[${i}]\ntype=friend\nhost=dynamic\nusername=${i}\nsecret=${secret}\n" >> ${sip_conf}
done

# add FXO-accounts
for i in $(seq 91 99); do
	secret=$(sed 's/[^A-Za-z0-9+_@*%?=]//g' /dev/urandom | tr -d "\n" | dd bs=12 count=1 2>/dev/null)
	echo -e "[${i}]\ntype=friend\nhost=dynamic\nusername=${i}\nsecret=${secret}\n" >> ${sip_conf}
done
