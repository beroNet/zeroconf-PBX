#!/bin/bash


if [ ! -f /apps/zeroconf-PBX/etc/asterisk/extensions.conf ] ; then
    echo "Copying default confs."
    mkdir -p /apps/zeroconf-PBX/etc/asterisk/
    cp -a /apps/zeroconf-PBX/conf/* /apps/zeroconf-PBX/etc/asterisk/
    sync
fi
