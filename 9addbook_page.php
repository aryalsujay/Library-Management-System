<?php include "5data_class.php";
    $bookname=$_POST['bookname'];
    $bookdetail=$_POST['bookdetail'];
    $bookauthor=$_POST['bookauthor'];
    $bookpub=$_POST['bookpub'];
    $branch=$_POST['branch'];
    $bookprice=$_POST['bookprice'];
    $bookquantity=$_POST['bookquantity'];

    if(move_uploaded_file($_FILES["bookpic"]["tmp_name"],"uploads/" . $_FILES["bookpic"]["name"])){
        $bookpic=$_FILES["bookpic"]["name"];
        $obj= new data();
        $obj->setconnection();
        $obj->addbook($bookpic,$bookname,$bookdetail,$bookauthor,$bookpub,$branch,$bookprice,$bookquantity);
    }
    else{
        echo "File Not Uploaded";
    }
?>