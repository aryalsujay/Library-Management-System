<?php include "5data_class.php";
    $deleteuser=$_GET['useriddelete'];
    $obj= new data();
    $obj->setconnection();
    $obj->deleteuser($deleteuser);
?>