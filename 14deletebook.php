<?php include "5data_class.php";
    $bookid=$_GET['deletebook'];
    $obj=new data();
    $obj->setconnection();
    $obj->deletebook($bookid);
?>