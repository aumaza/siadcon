#!/usr/local/bin/bash
fecha=`date +%d-%m-%Y`
archivo="siadcon-$fecha.sql"
mysqldump --user=siadcon --password=siadcon siadcon > $archivo
mv $archivo sqls/
echo -e "Database Backing Up Successfully \n File storage Successfully"

