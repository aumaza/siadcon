#!/usr/local/bin/bash
fecha=`date +%d%m%Y`
archivo="siadcon-$fecha.sql"
mysqldump --user=siadcon --password=siadcon siadcon > $archivo
echo "Databse Backing Up Successfully"
mv $archivo sqls/
echo "File storage Successfully"
