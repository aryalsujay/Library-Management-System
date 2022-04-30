<?php include "5data_class.php";
$search_keyword = '';
if(!empty($_POST['search']['keyword'])) {
    $search_keyword = $_POST['search']['keyword'];
}
$obj=new data();
$obj->setconnection();
$obj->search($search_keyword);
?>