<?php
ini_set('max_execution_time', '1000');

TEST();


 function TEST(){
  
    $datacontainer = array();
    $db = new PDO('mysql:host=192.168.49.103;port=3306;dbname=cicmonitoring_store;charset=utf8','root','password');
    $sth = $db->prepare("select * from sys_users_division ");


    $ctr = 0;

        if($sth->execute()){
                 $datacontainer = $sth->fetchAll(PDO::FETCH_ASSOC);
                    print_r($datacontainer);

        }else{
            print_r($sth->errorInfo());
        }
    }
?>