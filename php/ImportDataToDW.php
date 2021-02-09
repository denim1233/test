<?php
ini_set('max_execution_time', '1000');

IMPORT_DATA();

    function IMPORT_DATA(){
  
        $db = new PDO('mysql:host=192.168.4.44;port=3307;dbname=dw_dblink;charset=utf8','helpdesk','citihelpdesk');
        $sth = $db->prepare(
            "
                insert into dw_dblink.cic_inv_batch
                select * from dev_cicmonitoring.inv_batch as INB
                where INB.scheduletime > (select IFNULL(max(scheduletime),0) as scheduletime from dw_dblink.cic_inv_batch);

                insert into dw_dblink.cic_inv_product_dw
                select * from dev_cicmonitoring.inv_product_dw as INPD
                where INPD.datecreated > (select IFNULL(max(datecreated),0) as datecreated from dw_dblink.cic_inv_product_dw);

                insert into dw_dblink.cic_inv_product
                select * from dev_cicmonitoring.inv_product as INP
                where INP.productid > (select IFNULL(max(productid),0) as productid from dw_dblink.cic_inv_product);

		        insert into dw_dblink.cic_inv_schedule
                select * from dev_cicmonitoring.inv_schedule as INS
                where INS.scheduleid > (select IFNULL(max(scheduleid),0) as scheduleid from dw_dblink.cic_inv_schedule);

                insert into dw_dblink.cic_inv_batch
                select * from dev_cicmonitoring.inv_batch as INB
                where INB.scheduletime > (select IFNULL(max(scheduletime),0) as scheduletime from dw_dblink.cic_inv_batch);

                insert into dw_dblink.cic_sys_group
                select * from dev_cicmonitoring.sys_group as SG
                where SG.groupid > (select IFNULL(max(groupid),0) as groupid from dw_dblink.cic_sys_group);

		        insert into dw_dblink.cic_sys_status
                select * from dev_cicmonitoring.sys_status as SS
                where SS.statusid > (select IFNULL(max(statusid),0) as statusid from dw_dblink.cic_sys_status);
 
            "
        );

        if($sth->execute()){
             

        }else{
            print_r($sth->errorInfo());
        }
    }
?>                    