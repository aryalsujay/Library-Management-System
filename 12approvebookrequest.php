<?php include "5data_class.php";
    $reqid=$_GET['reqid'];
    $book=$_POST['book'];
    $user=$_POST['user'];
    $date=date("d/m/y");
    $days=$_POST['days'];
    $returndate=date("d/m/y", strtotime('+'.$days.'days'));

    $obj=new data();
    $obj->setconnection();
    $obj->bookreqapprove($book,$user,$days,$date,$returndate,$reqid);
?>