#! /bin/sh

rm -rf /run/httpd/* /tmp/httpd*
exec /usr/sbin/apache2ctl -D FOREGROUND

