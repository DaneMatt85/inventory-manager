#!/bin/bash

# First run default entrypoint and wait for start
docker-entrypoint.sh mysqld >> /var/log/mysql.log &
while ! mysqladmin ping -h127.0.0.1 --silent --connect_timeout=1; do
    sleep 1
    let counter=counter+1
    if (( counter >= 30 )); then
      echo "Mysql service failed to start within the specified timeout"
      exit 1;
    fi
done

echo '========= START Import schema ========= '
mysql $MYSQL_DATABASE -p$MYSQL_ROOT_PASSWORD < /init/schema.sql
echo '========= END Import schema ========= '

# Then tail log for container output
tail -f /var/log/mysql.log
