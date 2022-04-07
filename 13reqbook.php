<?php include "5data_class.php";
    $userid=$_GET['userid'];
    $bookid=$_GET['bookid'];

    $obj=new data();
    $obj->setconnection();
    $obj->reqbook($userid,$bookid);
?>