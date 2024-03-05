<?php 
//include_once('connection.php'); 

$Teacher_name = $Phone_no = $Address = $Start_teach_date =$Working_hours=$Hourly_fees="";
$Teacher_id=0;

$servername = "localhost";
$username = "root";
$password = "1234";
$Sub_id=$last_pay="";
try {
  $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="SELECT * FROM Teacher"; 
    
$obj=  $conn->prepare($sql);
  	$obj->execute();
  	
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
//		connect to database either U can write a code or can include file like c++ n all
// 		u can use this 2 queries
//		mysql_connect('localhost','root',''); 
//      mysql_select_db('database name');
//$query="select * from student"; //query
//$result=mysql_query($query); 	//result of query
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
	<table align="center" border="1px" style="width:600px; line-height:40px;"> 
	<tr> 
		<th colspan="8"><h2>Teachers Record</h2></th> 
		</tr> 
                <th> ID </th>
                <th> Name </th> 
                <th> Phone No </th> 
                <th> Address </th> 
                <th> Start teach Date </th> 
                <th> Working Hours </th>
                <th> Hourly Fees </th> 
        </tr> 
		
		<?php while($rows=$obj->fetch(PDO::FETCH_ASSOC)) 
		{ 
			$Teacher_id= $rows['Teacher_id'] ;
			$Teacher_name=$rows['Teacher_name'];
			$Phone_no= $rows['Phone_no'] ; 
			$Address= $rows['Address'] ;
			$Start_teach_date= $rows['Start_teach_date'] ;
			$Working_hours=$rows['Working_hours'] ;
			$Hourly_fees=$rows['Hourly_fees'] ; 
		

		 echo"
		<tr> 
			<td> $Teacher_id </td> 
			<td>  $Teacher_name   </td> 
			<td> $Phone_no     </td> 
			<td> $Address </td>
			<td> $Start_teach_date </td>
			<td> $Working_hours</td>
			<td> $Hourly_fees </td> 
		</tr> ";
		 
		
        } 
    	?>
   </tr> 

	</table> 
	<a href="home.html"><strong>BACK</strong></a>
	</body> 
</html>