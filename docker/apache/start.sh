#!/bin/bash

# no need to clone/update or correct permissions on code
# since this is handled on main site pod and mounted via nfs

#run apache
chown www-data:www-data /var/www/html/tmp/ /var/www/html/logs/ -R
chmod 775 /var/www/html/tmp/  /var/www/html/logs/ -R
/usr/sbin/apache2ctl -D FOREGROUND