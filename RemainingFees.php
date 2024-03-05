<?php 
//include_once('connection.php'); 

$Student_name = $Phone_no = $Address = $Enroll_date =$Level_iname=$Subject_name=$Payment_amt="";
$Payment_date="";



$servername = "localhost";
$username = "root";
$password = "1234";
$Sub_id=$last_pay="";
try {
  $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="SELECT a.Student_name,a.Phone_no,a.Address,b.Enroll_date,c.Level_iname,c.Subjects_name,d.Payment_amt,d.Payment_date,d.Fees_Remaining
FROM Students a
    INNER JOIN Enroll b
        ON b.Student_id=a.Student_id
    INNER JOIN Subjects c
        ON c.Subject_id=b.Subject_id
    INNER JOIN Payment d
        ON d.Payment_id = b.Payment_id
        where d.Fees_Remaining>0";
$obj=  $conn->prepare($sql);
    $obj->execute();
    
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
//    connect to database either U can write a code or can include file like c++ n all
//    u can use this 2 queries
//    mysql_connect('localhost','root',''); 
//      mysql_select_db('database name');
//$query="select * from student"; //query
//$result=mysql_query($query);  //result of query
?> 
<!DOCTYPE html> 
<html> 
  <head> 
    <title> Display </title> 
    <style>
      table{
        border-collapse: collapse;
        width:100%;
        color:#d96459;
        font font-family: monospace;
        font-size: 18px;
        text-align: middle;
      }
      th{
        background-color: #d96459;
        color:white;
      }
      tr:nth-child(even){background-color:#f2f2f2;}
    </style>
  </head> 


  <body> 
  <table align="center" border="2px"  style="width:1000px; line-height:40px;"> 
  <tr> 
    <th colspan="9" ><h2>Student Record</h2></th> 
    <tr> 
        <th> Name </th> 
        <th> Phone No </th> 
        <th> Address </th> 
        <th> Enroll Date </th> 
        <th> Level </th>
        <th> Subject </th>
        <th> Payment Ammount </th>
        <th> Payment Date </th>
        <th>Fees Remaining</th>   
    </tr> 
    
    <?php while($rows=$obj->fetch(PDO::FETCH_ASSOC)) 
    { 
        $Student_name=$rows['Student_name'];
      $Phone_no= $rows['Phone_no'] ; 
      $Address= $rows['Address'] ;
      $Enroll_date= $rows['Enroll_date'] ;
      $Level_iname=$rows['Level_iname'] ;
      $Subject_name=$rows['Subjects_name'] ;
      $Payment_amt= $rows['Payment_amt'] ;
      $Payment_date= $rows['Payment_date']; 
      $Fees_Remaining=$rows['Fees_Remaining'];    



     echo"
    <tr> 
      <td>$Student_name </td> 
      <td>  $Phone_no   </td> 
      <td> $Address     </td> 
      <td> $Enroll_date </td>
      <td> $Level_iname </td>
      <td> $Subject_name</td>
      <td> $Payment_amt </td>
      <td> $Payment_date</td> 
      <td>$Fees_Remaining</td>
    </tr> ";
     
    
        } 
      ?>
   </tr> 

  </table> 
  <a href="home.html"><strong>BACK</strong></a>
  </body> 
</html>