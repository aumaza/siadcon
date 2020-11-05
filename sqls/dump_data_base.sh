#!/usr/local/bin/bash
fecha=`date +%d-%m-%Y`
archivo="siadcon-$fecha.sql"
sudo mysqldump --user=siadcon --password=siadcon siadcon > $archivo

echo -e "Database Backing Up Successfully \n File storage Successfully"

