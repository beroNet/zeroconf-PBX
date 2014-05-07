#!/bin/bash

sip_secrets=/apps/zeroconf-PBX/etc/asterisk/sip_secrets.conf

if [ ! -f /apps/zeroconf-PBX/etc/asterisk/extensions.conf ] ; then
    echo "Copying default confs."
    mkdir -p /apps/zeroconf-PBX/etc/asterisk/
    cp -a /apps/zeroconf-PBX/conf/* /apps/zeroconf-PBX/etc/asterisk/

    if [ ! -f $sip_secrets ] ; then
	i=10
	echo "" > $sip_secrets

	while [ $i -lt 28 ]; do 
	    echo "[secret_$i](!)" >> $sip_secrets
	    echo "secret="$(sed 's/[^A-Za-z0-9+_@*%?=]//g' /dev/urandom | tr -d "\n" | dd bs=12 count=1 2>/dev/null) >> $sip_secrets
	    echo "" >> $sip_secrets

	    i=$(($i + 1))
	done

	i=91

	while [ $i -lt 99 ]; do 
	    echo "[secret_$i](!)" >> $sip_secrets
	    echo "secret="$(sed 's/[^A-Za-z0-9+_@*%?=]//g' /dev/urandom | tr -d "\n" | dd bs=12 count=1 2>/dev/null) >> $sip_secrets 
	    echo "" >> $sip_secrets

	    i=$(($i + 1))
	done
    fi

    sync
fi
