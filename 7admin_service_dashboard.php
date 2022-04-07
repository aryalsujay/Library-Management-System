<?php include "5data_class.php";
    //if(empty($_SESSION['adminid'])){
      //  header("Location:1index.php?msg=Login first");
    //}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="!style.css">
    <title>Document</title>
</head>
<style>
.container,
.row,
.imglogo{
    margin: auto;
}
.innerdiv{
    text-align: center;
    margin: 100px;
}
.leftinnerdiv{
    float: left;
    width: 25%;
}
.rightinnerdiv{
    float: right;
    width: 75%;
}
.greenbtn{    
    background-color: greenyellow;
    border-radius: 1rem;
    padding: 0.5%;
    width: 95%;
    height: 40px;
    font-size: medium;
    box-shadow: rgb(16,170,16);
    margin:3px;
    cursor: pointer;
}

th{
    background-color: orange;
    color: black;
    }
    td{
    background-color: #fed8b1;
    color: black;
    }
    td, a{
    color:black;
    } 
    a{
        text-decoration: none;
    }
    
</style>
<body>
    <div class="container">
        <div class="innerdiv">
            <div class="row"><img class="imglogo" src="images/logo.png"></div>
            <div class="leftinnerdiv">
                <Button class="greenbtn">Admin</Button>
                <Button class="greenbtn" onclick="openpart('addbook')">Add book</Button>
                <Button class="greenbtn" onclick="openpart('bookreport')">Book Report</Button>
                <Button class="greenbtn" onclick="openpart('bookrequestapprove')">Book Request</Button>
                <Button class="greenbtn" onclick="openpart('addperson')">Add Student</Button>
                <Button class="greenbtn" onclick="openpart('studentrecord')">Student Record</Button>
                <Button class="greenbtn" onclick="openpart('issuebook')">Issue Book</Button>                
                <Button class="greenbtn" onclick="openpart('issuebookreport')">Issue Book Report</Button>
                <a href="1index.php"><Button class="greenbtn">Logout</Button></a>
            </div>

            <div class="rightinnerdiv">
                <div id="addbook" class="innerright portion" style="<?php if(!empty($_REQUEST['viewid'])){echo "display:none";}else{echo "";} ?>">               
                <Button class="greenbtn">Add Book</Button>
                    <form action="9addbook_page.php" method="post" enctype="multipart/form-data">
                        <label>BookName: </label><input type="text"  name="bookname"/>
                        <br>
                        <label>Detail: </label><input type="text"  name="bookdetail"/>
                        <br>
                        <label>Author: </label><input type="text"  name="bookauthor"/>
                        <br>
                        <label>Publication: </label><input type="text"  name="bookpub"/>
                        <br>
                        <div>Branch: <input type="radio" name="branch" value="Other"/>Other<input type="radio" name="branch" value="it"/>IT<div style="margin-left: 60px;"><input type="radio" name="branch" value="ece"/>ECE<input type="radio" name="branch" value="coe"/>COE</div>
                        </div><br>
                        <label>Price: </label><input type="number"  name="bookprice"/>
                        <br>
                        <label>Quantity: </label><input type="number"  name="bookquantity"/>                        
                        <br>
                        <label>Book Photo: </label><input type="file" name="bookpic"/><br>
                        <input type="submit" class="btn-primary" value="Submit"/>
                        <br>
                        <br>    
                    </form>
                </div>
            </div>
            
            <div class="rightinnerdiv">
                <div id="addperson" class="innerright portion" style="display:none">
                    <Button class="greenbtn">Add Person</Button>
                    <form action="8addperson_server_page.php" method="post" enctype="multipart/form-data">
                        <label>Name: </label><input type="text"  name="addname"/>
                        <br>
                        <label>Email: </label><input type="email"  name="addemail"/>
                        <br>
                        <label>Password: </label><input type="password"  name="addpass"/>
                        <br>
                        <label for="type">Type: </label>
                        <select name="type" >
                            <option id="Student">Student</option>
                            <option id="Teacher">Teacher</option>
                        </select>
                        <br>
                        <input type="submit" class="btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>   
            
            <div class="rightinnerdiv">
                <div id="issuebookreport" class="innerright portion" style="display:none">
                    <button class="greenbtn">Issue Book Report</button>
                    <?php
                        $u= new data;
                        $u->setconnection();
                        $u->issuereport();
                        $recordset=$u->issuereport();

                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
            padding: 8px;'>Issue Name</th><th>Book Name</th><th>Issue Date</th><th>Return Date</th><th>Fine</th></th><th>Issue Type</th><th>Return</th></tr>";
                        
                        foreach($recordset as $row){
                        $table.="<tr>";
                        "<td>$row[0]</td>";
                        $table.="<td>$row[2]</td>";
                        $table.="<td>$row[3]</td>";
                        $table.="<td>$row[6]</td>";
                        $table.="<td>$row[7]</td>";
                        $table.="<td>$row[8]</td>";
                        $table.="<td>$row[4]</td>";
                        $table.="<td><button type='button' class='btn btn-primary'><a href='7admin_service_dashboard.php?returnid=$row[0]'>RETURN</a></button></td>";
                        $table.="</tr>";
                        }
                        $table.="</table>";
                        echo $table;
                    ?>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="return" class="innerright portion" style="<?php if(!empty($_REQUEST['returnid'])){ $returnid=$_REQUEST['returnid']; echo "display:none";}else{echo "display:none";} ?>">
                    <button class="greenbtn">Return</button>
                        <?php
                            $obj=new data;
                            $obj->setconnection();
                            $obj->returnbookad($returnid);
                            $recordset=$obj->returnbookad($returnid);
                        ?>
                </div>
            </div>
            
            <div class="rightinnerdiv">
                <div id="studentrecord" class="innerright portion" style="display:none">
                <button class="greenbtn">Student Record</button>
                <?php
                    $u= new data;
                    $u->setconnection();
                    $u->studentrecord();
                    $recordset=$u->studentrecord();

                    $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                    padding: 8px;'>Student Name</th><th>Email</th><th>Type</th><th>Delete</th></tr>";
                    foreach($recordset as $row){
                        $table.="<tr>";
                        "<td>$row[0]</td>";
                        $table.="<td>$row[1]</td>";
                        $table.="<td>$row[2]</td>";
                        $table.="<td>$row[4]</td>";
                        $table.="<td><button type='button' class='btn btn-primary'><a href='10deleteuser_page.php?useriddelete=$row[0]'>Delete</a></button></td>";
                        $table.="</tr>";
                    }
                    $table.="</table>";
                    echo $table;
                 ?>       
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="bookreport" class="innerright portion" style="display:none">
                    <button class="greenbtn">Book Record</button>
                    <?php
                        $u= new data;
                        $u->setconnection();
                        $u->bookrecord();
                        $recordset=$u->bookrecord();
                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                        padding: 8px;'>Book Name</th><th>Price</th><th>Qty</th><th>Available</th><th>Rent</th></th><th>View</th><th>Delete</th></tr>";

                        foreach($recordset as $row){
                            $table.="<tr>";
                            "<td>$row[0]</td>";
                            $table.="<td>$row[2]</td>";
                            $table.="<td>$row[7]</td>";
                            $table.="<td>$row[8]</td>";
                            $table.="<td>$row[9]</td>";
                            $table.="<td>$row[10]</td>";
                            $table.="<td><button type='button' class='btn btn-primary' style='font-family: Arial;padding 10px;'><a href='7admin_service_dashboard.php?viewid=$row[0]'>View Book</button></a></td>";
                            $table.="<td><button type='button' class='btn btn-primary'><a href=14deletebook.php?deletebook=$row[0]>DELETE</a></button></td>";
                            $table.="</tr>";
                        }
                        $table.="</table>";
                        echo $table;
                    ?>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="bookdetail" class="innerright portion" style="<?php if(!empty($_REQUEST['viewid'])){$viewid=$_REQUEST['viewid'];}else{echo "display:none";}?>">
                        <button class="greenbtn">Book Detail</button>
                        <?php
                            $obj= new data;
                            $obj->setconnection();
                            $obj->bookdetail($viewid);
                            $recordset=$obj->bookdetail($viewid);

                            foreach($recordset as $row){

                                $bookid= $row[0];
                               $bookimg= $row[1];
                               $bookname= $row[2];
                               $bookdetail= $row[3];
                               $bookauthor= $row[4];
                               $bookpub= $row[5];
                               $branch= $row[6];
                               $bookprice= $row[7];
                               $bookquantity= $row[8];
                               $bookava= $row[9];
                               $bookrent= $row[10];
                
                            }       
                                                   
                        ?>
                        <img width='150px' height='150px' style='border:1px solid #333333; float:left;margin-left:20px' src="uploads/<?php echo $bookimg?> "/>
                        </br>
                        <p style="color:black"><u>Book Name:</u> &nbsp&nbsp<?php echo $bookname ?></p>
                        <p style="color:black"><u>Book Detail:</u> &nbsp&nbsp<?php echo $bookdetail ?></p>
                        <p style="color:black"><u>Book Authour:</u> &nbsp&nbsp<?php echo $bookauthor ?></p>
                        <p style="color:black"><u>Book Publisher:</u> &nbsp&nbsp<?php echo $bookpub ?></p>
                        <p style="color:black"><u>Book Branch:</u> &nbsp&nbsp<?php echo $branch ?></p>
                        <p style="color:black"><u>Book Price:</u> &nbsp&nbsp<?php echo $bookprice ?></p>
                        <p style="color:black"><u>Book Available:</u> &nbsp&nbsp<?php echo $bookava ?></p>
                        <p style="color:black"><u>Book Rent:</u> &nbsp&nbsp<?php echo $bookrent ?></p>

                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="issuebook" class="innerright portion" style="display:none;">
                    <button class="greenbtn">Issue Book</button>                    
                    <form action="11issuebook_server.php" method="post" enctype="multipart/form-data">
                        <label for="type">Choose Book: </label>
                        <select name="book">
                            <?php
                                $obj= new data();
                                $obj->setconnection();
                                $obj->getbookissue($id);
                                $recordset=$obj->getbookissue($id);
                                foreach($recordset as $row){
                                    echo "<option value ='" . $row[2] . "'>" . $row[2] . "</option>";
                                }
                            ?>                            
                        </select>
                        <select name="user">
                            <?php
                                $obj= new data();
                                $obj->setconnection();
                                $obj->studentrecord();
                                $recordset=$obj->studentrecord();
                                foreach($recordset as $row){
                                    echo "<option value='" . $row[1] . "'>" . $row[1] . "</option>";
                                }
                            ?>
                        </select>
                        <br>
                        <label>Days: </label>
                        <input type="number" name="days"/>
                        <input type="submit" class="btn-primary" value="Submit"/>
                    </form>
                </div>
            </div>

            <div class="rightinnerdiv">
                <div id="bookrequestapprove" class="innerright portion" style="display:none">
                    <label class="greenbtn">Book Request Approve</label>
                    <?php
                        $obj= new data();
                        $obj->setconnection();
                        $obj->bookreq();
                        $recordset=$obj->bookreq();

                        $table="<table style='font-family: Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;'><tr><th style='  border: 1px solid #ddd;
                        padding: 8px;'>Person Name</th><th>Person type</th><th>Book name</th><th>Days </th><th>Approve</th></tr>";
                        foreach($recordset as $row){
                            $table.="<tr>";
                            "<td>$row[0]</td>";
                            "<td>$row[1]</td>";
                            "<td>$row[2]</td>";
                            $table.="<td>$row[3]</td>";
                            $table.="<td>$row[4]</td>";                    
                            $table.="<td>$row[5]</td>";
                            $table.="<td>$row[6]</td>";
                            $table.="<td><button type='button' class='btn btn-primary'><a href='12approvebookrequest.php?reqid=$row[0]&book=$row[5]&user=$row[3]&days=$row[6]'>Approve</button></a></td>";
                            $table.="<tr>";
                            }
                            $table.="</table>";
                            echo $table;

                        
                    ?>
                </div>
            </div>

        </div>                
    </div>
    
    <script>
        function openpart(portion){
            var i;
            var x=document.getElementsByClassName("portion");
            for(i=0;i<x.length;i++){
                x[i].style.display="none";
            }
            document.getElementById(portion).style.display="block";
        }        
    </script>
    
</body>
</html>