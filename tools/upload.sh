#!/bin/bash

cd /data/project/sinointer.com/;

echo "当前工作路径:";
pwd;

#echo '导出数据...';
#mysqldump -h 192.168.2.2 -uroot -proot zs > db.sql;


server_ip='119.10.58.174';
remote_path='/data/web/7k999.com/sino.7k999.com';

/bin/rm -rf src/data/*;

rsync -av \
    --exclude ".idea" \
    --exclude='.git' \
    --exclude "tools" \
    --exclude='node_modules' \
    --exclude='src/uploads' \
    * root@${server_ip}:${remote_path};


ssh root@${server_ip} "cd ${remote_path};
chown -R ftp:ftp .;
cd src;
/bin/rm -rf data/*;
chmod -R 777 data uploads;
";
