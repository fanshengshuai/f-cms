<?php

class AdminSqlbackupCtrl extends AdminAbstractCtrl {
    public static $sqls="";
    public function indexAction(){
        $dbName=FConfig::get('db.db_name');

        $sql = 'SHOW TABLE STATUS FROM '.$dbName;
        $re=FDB::fetch($sql);
        $this->assign("re",$re);
        $this->display();
    }

    public function backAction(){
        $table=$this->getTable();
        $struct=$this->bakStruct($table);
        $record=$this->bakRecord($table);
        $sqls=$struct.$record;
        $dir="./data/data.sql";
        file_put_contents($dir,$sqls);
        if(file_exists($dir)) {
            $this->success("备份成功",'/admin/sqlbackup/index');
        }else {
            $this->error("备份失败",'/admin/sqlbackup/index');
        }
    }

    protected function getTable(){
        $dbName=FConfig::get('db.db_name');
        $sql = 'show tables from '.$dbName;
        $result=FDB::fetch($sql);
        foreach ($result as $v){
            $tbArray[]=$v['Tables_in_'.$dbName];
        }
        return $tbArray;
    }

    protected function bakStruct($array){
        $sql = '';
        foreach ($array as $vv){
            $tbName=$vv;

            $Struct_sql = 'show columns from '.$tbName;
            $result=FDB::fetch($Struct_sql);
            $sql.="--\r\n";
            $sql.="-- 数据表结构: `$tbName`\r\n";
            $sql.="--\r\n\r\n";
            $sql.="DROP TABLE IF EXISTS `$tbName`;\r\n";
            $sql.="create table `$tbName` (\r\n";
            $rsCount=count($result);
            foreach ($result as $k=>$v){
                $field  =       $v['Field'];
                $type   =       $v['Type'];
                $default=       $v['Default'];
                $extra  =       $v['Extra'];
                $null   =       $v['Null'];
                if(!($default=='')){
                    $default='default '.$default;
                }
                if($null=='NO'){
                    $null='not null';
                }else{
                    $null="null";
                }
                if($v['Key']=='PRI'){
                    $key    =       'primary key';
                }else{
                    $key    =       '';
                }
                if($k<($rsCount-1)){
                    $sql.="`$field` $type $null $default $key $extra ,\r\n";
                }else{
                    //最后一条不需要","号
                    $sql.="`$field` $type $null $default $key $extra \r\n";
                }
            }
            $sql.=") ENGINE=MyISAM DEFAULT CHARSET=utf8;\r\n\r\n";
        }
        return str_replace(',)',')',$sql);
    }

    protected function bakRecord($array){
        $sql = '';
        foreach ($array as $v){
            $tbName=$v;
            $Record_sql = 'select * from '.$tbName;
            $rs=FDB::fetch($Record_sql);
            if(count($rs)<=0){
                continue;
            }
            $sql.="--\r\n";
            $sql.="-- 数据表中的数据: `$tbName`\r\n";
            $sql.="--\r\n\r\n";
            foreach ($rs as $k=>$v){
                $sql.="INSERT INTO `$tbName` VALUES (";
                foreach ($v as $key=>$value){
                    if($value==''){
                        $value='null';
                    }
                    $type=gettype($value);
                    if($type=='string'){
                        $value="'".addslashes($value)."'";
                    }
                    $sql.="$value," ;
                }
                $sql.=");\r\n\r\n";
            }
        }
        return str_replace(',)',')',$sql);
    }

    public function downFilesAction(){
        if($_GET['act']==true){
            header('Content-type:application/octet-stream');
            header('Content-Disposition:attachment;filename="'.$_GET['name'].'"');
            readfile($_GET['name']);
        }else{
            echo "请重试";
        }
    }

}