<?php include "4db.php";

session_start();
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

        /*function search(){
            $search_keyword = '';
                if(!empty($_POST['search']['keyword'])) {
                    $search_keyword = $_POST['search']['keyword'];
                }
                //$sql= 'SELECT * FROM user WHERE name LIKE :keyword OR email LIKE :keyword OR type LIKE :keyword ORDER BY id DESC';
                $sql='SELECT u.id,u.name,u.email,u.type,i.issuebook,i.issuedays,i.issuedate,i.issuereturn FROM user u INNER JOIN issuebook i ON u.id=i.userid WHERE u.name LIKE :keyword OR u.email LIKE :keyword OR u.type LIKE :keyword OR i.issuebook LIKE :keyword OR i.issuedays LIKE :keyword OR i.issuedate LIKE :keyword OR i.issuereturn LIKE :keyword ORDER BY id DESC';

                // Pagination Code starts
                $per_page_html = '';
                $page = 1;
                $start=0;
                if(!empty($_POST["page"])) {
                    $page = $_POST["page"];
                    $start=($page-1) * 2;
                }
                $limit=" limit " . $start . "," . 2;
                $pagination_statement = $this->connection->prepare($sql);
                $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
                $pagination_statement->execute();

                $row_count = $pagination_statement->rowCount();
                if(!empty($row_count)){
                    $per_page_html .= "<div style='text-align:center;margin:20px 0px;'>";
                    $page_count=ceil($row_count/2);
                    if($page_count>1) {
                        for($i=1;$i<=$page_count;$i++){
                            if($i==$page){
                                $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
                            } else {
                                $per_page_html .= '<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
                            }
                        }
                    }
                    $per_page_html .= "</div>";
                }
                
                $query = $sql.$limit;
                $pdo_statement = $this->connection->prepare($query);
                $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
                $pdo_statement->execute();
                $result = $pdo_statement->fetchAll();
            return $result;        
        }
        */
        /* function search1() {

            $search_keyword = '';
            if(!empty($_POST['search']['keyword'])) {
                $search_keyword = $_POST['search']['keyword'];
            } 

            $sql1= 'SELECT * FROM issuebook WHERE issuebook LIKE :keyword OR issuedays LIKE :keyword OR issuedate LIKE :keyword ORDER BY userid DESC';
        $pdo_statement1 = $this->connection->prepare($sql1);
        $pdo_statement1->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
        $pdo_statement1->execute();
        $result1 = $pdo_statement1->fetchAll();
        return $result1;
        } */

        function userLogin($t1,$t2){
           /* $q="SELECT * FROM user where email='$t1' and pass='$t2'";
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
            } */

            try{
                $q="SELECT * FROM user where email=? and pass=?";
                //echo $q; 
                //exit(1);
                $recordSet=$this->connection->prepare($q);
                $recordSet->bindParam(1,$t1);
                $recordSet->bindParam(2,$t2);
                $recordSet->execute();
                $row=$recordSet->fetch(PDO::FETCH_ASSOC);
                //$result=$recordSet->rowCount();

                //if($result > 0){
                    //foreach($recordSet->fetchAll() as $row){
                        $logid=$row['id'];
                        $_SESSION["userid"]=$logid;                  
                    header("Location:6user_service_dashboard.php?userlogid=$logid");
                    //}
                }
                catch (PDOException $e) 
                {
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
            
            try{
                $q="SELECT * FROM admin where email=:em and pass=:ps";
                //echo $q; 
                //exit(1);
                $recordSet=$this->connection->prepare($q);
                $recordSet->bindParam(':em',$t1);
                $recordSet->bindParam(':ps',$t2);
                $recordSet->execute();
                $row=$recordSet->fetch(PDO::FETCH_ASSOC);
                //$result=$recordSet->rowCount();

                //if($result > 0){
                    //foreach($recordSet->fetchAll() as $row){
                        $logid=$row['id'];
                        $_SESSION["adminid"]=$logid;                  
                    header("Location:7admin_service_dashboard.php");
                    //}
                }
                catch (PDOException $e) 
                {
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
            $q="SELECT * FROM issuebook ORDER BY id DESC";
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
        function getbook(){
            $q="SELECT * FROM book";
            $data=$this->connection->query($q);
            return $data;
        }
        function userlog($lid){
            $uid="";
            $rcheck="";
            $type="";
            $idate="";
            $ireturn="";
            $q="SELECT * FROM log WHERE bookid='$lid'";
            $lg=$this->connection->query($q); 
            foreach($lg->fetchAll() as $row){
                $uid=$row['userid'];
            } 
            $q="SELECT * FROM user WHERE id='$uid'";
            $ur=$this->connection->query($q);
            foreach($ur->fetchAll() as $row){
                $uname=$row['name'];
                $type=$row['type'];
            }
            return [$uname,$type];
            //return $ur;
        }    
        
        function booklog($lid){
            $q="SELECT * FROM log AS l INNER JOIN user AS u ON l.userid=u.id WHERE bookid='$lid'";
            $lg=$this->connection->query($q); 
            return $lg;
            //$sql="SELECT u.id,u.name,u.type,b.id,l.bookid,l.userid,l.bookreturn,l.returncheck FROM log l INNER JOIN user u ON u.id=l.userid INNER JOIN book b WHERE l.userid='$uid' AND l.bookid='$lid'";
            //$lg=$this->connection->query($sql); 
            /*$q="SELECT * FROM log WHERE bookid='$lid'";
            $lg=$this->connection->query($q); 
                     
            return $lg;
            */
            /*foreach($lg->fetchAll() as $row){
                //$uid=$row['userid'];
                $rcheck=$row['returncheck'];
            }
            if($rcheck == '0'){
                $q="SELECT * FROM issuebook WHERE bookid='$lid'";
                $ib=$this->connection->query($q);                
                return $ib;

            }
            else{
                $q="SELECT * FROM ";
            }
            */
            /*
            $q="SELECT * FROM book WHERE id='$lid'";
            $res=$this->connection->query($q);
            foreach($res->fetchAll() as $row){
                $bname=$row['bookname'];
            }
            
            $sql="SELECT l.bookid,i.issuename,i.issuetype,i.issuedays,i.issuedate,i.issuereturn,l.returncheck FROM issuebook i RIGHT JOIN log l ON l.bookid=i.bookid AND l.userid WHERE l.issuebook='$bname'";
            $data=$this->connection->query($sql);
            return $data;
            */
            
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

            //Insert into log table
            $q="SELECT * FROM book where bookname='$book'";
            $bookres=$this->connection->query($q);

            $q="SELECT * FROM user where name='$user'";
            $userres=$this->connection->query($q);
            $res=$userres->rowCount();

            if($res > 0){
            foreach($bookres->fetchAll() as $row){
                $bookid=$row['id'];
            }
            foreach($userres->fetchAll() as $row){
                $issueid=$row['id'];
            }
            $sql="INSERT INTO log(userid, bookid, issuebook, bookissue, bookreturn, returncheck)VALUES('$issueid','$bookid', '$book', '$date', '$returndate', '0')";
            $this->connection->exec($sql);
            }

            //bookissue start

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
                    $q="INSERT INTO issuebook(userid, bookid, issuename, issuebook, issuetype, issuedays, issuedate, issuereturn, fine)VALUES('$issueid','$bookid','$user', '$bookname', '$issuetype', '$days', '$date', '$returndate', '')";
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

            

            //returnbook
            
            $fine="";
            $bookava="";
            $issuebook="";
            $bookrentel="";
            $ibook="";
            $bid="";
            $uid="";
            $idate="";
            
            //INSERT into log table
            $rdate=date('d/m/y');
            $q="SELECT * FROM issuebook where id='$id'";
            $ibookres=$this->connection->query($q);
            $rs=$ibookres->rowCount();

            if($rs > 0){
            foreach($ibookres->fetchAll() as $row){
                $ibook=$row['issuebook'];
                $uid=$row['userid'];
                $bid=$row['bookid'];
                $idate=$row['issuedate'];
            }
           
            
            $db="INSERT INTO log(userid, bookid, issuebook, bookissue, bookreturn, returncheck)VALUES('$uid','$bid', '$ibook', '$idate','$rdate', '1')";
            $this->connection->exec($db);
        }
             
            //log close

            $q="SELECT * FROM issuebook where id='$id'";
            $recordSet=$this->connection->query($q);
    
            foreach($recordSet->fetchAll() as $row) {
                
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
