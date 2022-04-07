<?php include "4db.php";

//session_start();
    class data extends db{
        private $bookauthor;
        private $bookdetail;
        private $bookname;
        private $bookpic;
        private $bookprice;
        private $bookpub;
        private $bookquantity;

        private $book;
        private $user;
        private $days;
        private $date;
        private $returnDate;

        function userLogin($t1,$t2){
            $q="SELECT * FROM user where email='$t1' and pass='$t2'";
            $recordSet=$this->connection->query($q);
            $result=$recordSet->rowCount();

            if($result > 0){
                foreach($recordSet->fetchAll() as $row){
                    $logid=$row['id'];                                  
                header("Location:6user_service_dashboard.php?userlogid=$logid");
                }
            }
            else{
                header("Location:1index.php?msg=Invalid Credentials");
            }
        }
        function userdetail($id){
            $q="SELECT * FROM user where id='$id'";
            $data=$this->connection->query($q);
            return $data;
        }

        function bookissued($id){
            $fine="";
            $issueret="";
            
            $q="SELECT * FROM issuebook where userid='$id'";
            $recordset=$this->connection->query($q);

            foreach($recordset as $row){
                $issueret=$row['issuereturn'];
                $fine=$row['fine'];
            }

            $date=date("d/m/y");
            if($date>$issueret){
                $q="UPDATE issuebook SET fine='$fine' where userid='$id'";
                if($this->connection->exec($q)) {
                    $q="SELECT * FROM issuebook where userid='$id'";
                    $data=$this->connection->query($q);
                    return $data;
                }
                else{
                    $q="SELECT * FROM issuebook where userid='$id' ";
                    $data=$this->connection->query($q);
                    return $data;  
                }
    
            }
            else{
                $q="SELECT * FROM issuebook where userid='$id'";
                $data=$this->connection->query($q);
                return $data;
            }
        }

        function reqbook($userid,$bookid){
            $q="SELECT * FROM book where id='$bookid'";
            $recordset=$this->connection->query($q);

            $q="SELECT * FROM user where id='$userid'";
            $recordSet=$this->connection->query($q);

            foreach($recordSet->fetchAll() as $row){
                $user=$row['name'];
                $type=$row['type'];
               
            }

            foreach($recordset->fetchAll() as $row){
                $book=$row['bookname'];
            
                if($type=="student"){
                    $days=7;
                }
                if($type=="teacher"){
                    $days=21;
                }
            }


            $q="INSERT INTO requestbook (id,userid,bookid,username,usertype,bookname,issuedays)VALUES('', $userid, $bookid, $user, $type, $book, $days)";
            if($this->connection->exec($q)){
                header("Location:6user_service_dashboard.php?userlogid=$userid");
            }
            else
            {  
                header("Location:6user_service_dashboard.php?msg=fail");
            }
        }    

        function returnbook($id){
            $fine="";
            $bookava="";
            $issuebook="";
            $bookrentel="";
    
            $q="SELECT * FROM issuebook where id='$id'";
            $recordSet=$this->connection->query($q);
    
            foreach($recordSet->fetchAll() as $row) {
                $userid=$row['userid'];
                $issuebook=$row['issuebook'];
                $fine=$row['fine'];
    
            }
            if($fine==0){
    
            $q="SELECT * FROM book where bookname='$issuebook'";
            $recordSet=$this->connection->query($q);   
    
            foreach($recordSet->fetchAll() as $row) {
                $bookava=$row['bookava']+1;
                $bookrentel=$row['bookrent']-1;
            }
            $q="UPDATE book SET bookava='$bookava', bookrent='$bookrentel' where bookname='$issuebook'";
            $this->connection->exec($q);
    
            $q="DELETE from issuebook where id=$id and issuebook='$issuebook' and fine='0' ";
            if($this->connection->exec($q)){
        
                header("Location:6user_service_dashboard.php?userlogid=$userid");
             }
            //  else{
            //     header("Location:otheruser_dashboard.php?msg=fail");
            //  }
            }
            // if($fine!=0){
            //     header("Location:otheruser_dashboard.php?userlogid=$userid&msg=fine");
            // }
           
    
        }
        //Admin
        function adminLogin($t1,$t2){
            $q="SELECT * FROM admin where email='$t1' and pass='$t2'";
            //echo $q; 
            //exit(1);
            $recordSet=$this->connection->query($q);
            $result=$recordSet->rowCount();

            if($result > 0){
                foreach($recordSet->fetchAll() as $row){
                    $logid=$row['id'];
                    //$_SESSION["adminid"]=$logid;                  
                header("Location:7admin_service_dashboard.php?adminid=$logid");
                }
            }
            else{
                header("Location:1index.php?msg=Invalid Credentials");
            }
        }
        function addperson($name,$email,$pass,$type){
            $this->name=$name;
            $this->email=$email;
            $this->pass=$pass;
            $this->type=$type;
            $q="INSERT INTO user(id, name, email, pass, type)VALUES('', '$name', '$email', '$pass', '$type')";
            if($this->connection->exec($q)){
                header("Location:7admin_service_dashboard.php?msg=New person added");
            }
            else{
                header ("Location:7admin_service_dashboard.php?msg=Registration failed");
            }
        }
        function addbook($bookpic,$bookname,$bookdetail,$bookauthor,$bookpub,$branch,$bookprice,$bookquantity){
            $this->$bookpic=$bookpic;
            $this->bookname=$bookname;
            $this->bookdetail=$bookdetail;
            $this->bookauthor=$bookauthor;
            $this->bookpub=$bookpub;
            $this->branch=$branch;
            $this->bookprice=$bookprice;
            $this->bookquantity=$bookquantity;

            $q="INSERT INTO book(id, bookpic, bookname, bookdetail, bookauthor, bookpub, branch, bookprice, bookquantity, bookava, bookrent)VALUES('', '$bookpic', '$bookname', '$bookdetail', '$bookauthor', '$bookpub', '$branch', '$bookprice', '$bookquantity', '$bookquantity', 0)";
            if($this->connection->exec($q)){
                header("Location:7admin_service_dashboard.php?msg=New Book Added");
            }
            else{
                header("Location:7admin_service_dashboard.php?msg=Book Addition Failed");
            }

        } 
        function issuereport(){
            $q="SELECT * FROM issuebook";
            $data=$this->connection->query($q);
            return $data;
        }
        function studentrecord(){
            $q="SELECT * FROM user";
            $data=$this->connection->query($q);
            return $data;
        }
        function deleteuser($id){
            $q="DELETE FROM user where id='$id'";
            if($this->connection->exec($q)){
                header("Location:7admin_service_dashboard.php?msg=done");
            }
            else{
                header("Location:7admin_service_dashboard.php?msg=failed");
            }
        }
        function deletebook($id){
            $q="DELETE FROM book where id='$id'";
            if($this->connection->exec($q)){
                header("Location:7admin_service_dashboard.php?msg=done");
            }
            else{
                header("Location:7admin_service_dashboard.php?msg=failed");
            }
        }
        function bookrecord(){
            $q="SELECT * FROM book";
            $data=$this->connection->query($q);
            return $data;
        }
        function bookdetail($viewid){
            $q="SELECT * FROM book where id='$viewid'";
            $data=$this->connection->query($q);
            return $data;
            
        }
        function getbookissue(){
            $q="SELECT * FROM book where bookava !=0";
            $data=$this->connection->query($q);
            return $data;
        }
        function bookissue($book,$user,$date,$days,$returndate){
            $this->book=$book;
            $this->user=$user;
            $this->date=$date;
            $this->days=$days;
            $this->returnDate=$returndate;

            $q="SELECT * FROM book where bookname='$book'";
            $recordSet=$this->connection->query($q);

            $q="SELECT * FROM user where name='$user'";
            $recordset=$this->connection->query($q);
            $result=$recordset->rowCount();

            if($result > 0){
                foreach($recordSet->fetchAll() as $row){
                    $bookid=$row['id'];
                    $bookname=$row['bookname'];
                    $bookava=$row['bookava'];
                    $bookrent=$row['bookrent'];

                    $newbookava=$bookava-1;
                    $newbookrent=$bookrent+1;
                }    
                foreach($recordset->fetchAll() as $row){
                    $issueid=$row['id'];
                    $issuetype=$row['type'];
                }

                $q="UPDATE book SET bookava='$newbookava',bookrent='$newbookrent' where id='$bookid'";
                if($this->connection->exec($q)){
                    $q="INSERT INTO issuebook(userid, issuename, issuebook, issuetype, issuedays, issuedate, issuereturn, fine)VALUES('$issueid','$user', '$bookname', '$issuetype', '$days', '$date', '$returndate', '')";
                    if($this->connection->exec($q)){
                        header("Location:7admin_service_dashboard.php?msg=done");
                    }else{
                        header("Location:7admin_service_dashboard.php?msg=fail");
                    }
                }
                else{
                    header("Location:7admin_service_dashboard.php?msg=fail");
                }
            }
            else{
                header("Location:7admin_service_dashboard.php?msg=Invalid Credentials");
            }

        }

        function bookreq(){
            $q="SELECT * FROM requestbook";
            $data=$this->connection->query($q);
            return $data;
        }

        function bookreqapprove($book,$user,$days,$date,$returndate,$reqid){
            $this->book=$book;
            $this->user=$user;
            $this->date=$date;
            $this->days=$days;
            $this->returnDate=$returndate;

            $q="SELECT * FROM user where name='$user'";
            $recordset=$this->connection->query($q);
            $result=$recordset->rowCount();

            $q="SELECT * FROM book where bookname='$book'";
            $recordSet=$this->connection->query($q);
            
            if($result > 0){
                foreach($recordSet->fetchAll() as $row){
                    $bookid=$row['id'];
                    $bookname=$row['bookname'];
                    $newbookava=$row['bookava']-1;
                    $newbookrent=$row['bookrent']+1;
                }
                foreach($recordset->fetchAll() as $row){
                    $issueid=$row['id'];
                    $issuetype=$row['type'];
                }
                $q="UPDATE book SET bookava='$newbookava', bookrent='$newbookrent' where id='$bookid'";
                if($this->connection->exec($q)){
                    $q="INSERT INTO issuebook(userid,issuename,issuebook,issuetype,issuedays,issuedate,issuereturn,fine)VALUES('$issueid','$user','$bookname','$issuetype','$days','$date','$returndate','0')";
                    if($this->connection->exec($q)){
                        $q="DELETE FROM requestbook where id='$reqid'";
                        $this->connection->exec($q);
                        header("Location:7admin_service_dashboard.php?msg=done");
                    }
                    else{
                        header("Location:7admin_service_dashboard.php?msg=fail");
                    }                    
                }
                else{
                    header("Location:7admin_service_dashboard.php?msg=fail");
                }
            }
            else{
                header("Location:7admin_service_dashboard.php?msg=Invalid Credentials");
            }
        }

        function returnbookad($id){
            $fine="";
            $bookava="";
            $issuebook="";
            $bookrentel="";
    
            $q="SELECT * FROM issuebook where id='$id'";
            $recordSet=$this->connection->query($q);
    
            foreach($recordSet->fetchAll() as $row) {
                //$userid=$row['userid'];
                $issuebook=$row['issuebook'];
                $fine=$row['fine'];
    
            }
            if($fine==0){
    
            $q="SELECT * FROM book where bookname='$issuebook'";
            $recordSet=$this->connection->query($q);   
    
            foreach($recordSet->fetchAll() as $row) {
                $bookava=$row['bookava']+1;
                $bookrentel=$row['bookrent']-1;
            }
            $q="UPDATE book SET bookava='$bookava', bookrent='$bookrentel' where bookname='$issuebook'";
            $this->connection->exec($q);
    
            $q="DELETE from issuebook where id=$id and issuebook='$issuebook' and fine='0' ";
            if($this->connection->exec($q)){
        
                header("Location:7admin_service_dashboard.php");
             }
            
            }
                     
    
        }
    }
    
?>