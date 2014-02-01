#!/bin/bash


if [ ! -f /apps/zeroconf-pbx_TOOTAi/etc/asterisk/extensions.conf ] ; then
    echo "Copying default confs."
    mkdir -p /apps/zeroconf-pbx_TOOTAi/etc/asterisk/
    cp -a /apps/zeroconf-pbx_TOOTAi/conf/* /apps/zeroconf-pbx_TOOTAi/etc/asterisk/
    sync
fi

