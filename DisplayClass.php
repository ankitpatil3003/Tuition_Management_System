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
  $sql="SELECT a.Subjects_name,a.Level_iname,b.Class_id,b.no_Of_Students,c.Branch_name,c.Address,d.Session_start_time,d.Session_end_time,e.Teacher_name
FROM Class b
    INNER JOIN Subjects a
        ON a.Subject_id=b.Subject_id
    INNER JOIN Branch c
        ON c.Branch_id=b.Branch_id
    INNER JOIN Session d
        ON d.Session_id = b.Session_id
    INNER JOIN Teacher e
    	ON e.Teacher_id=b.Teacher_id
    	order by b.Class_id";
$obj=  $conn->prepare($sql);
  	$obj->execute();
    
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
		<th colspan="9"><h2>Class Record</h2></th> 
		</tr> 
                <th> ID </th>
                <th> Level</th> 
                <th> Subjects </th> 
                <th> Session Start Time </th>
                <th> Session End Time </th> 
                <th> Branch Name </th> 
                <th> Address </th>
                <th> No Of Students </th>
                <th> Teacher Name</th>
        </tr> 
		
		<?php while($rows=$obj->fetch(PDO::FETCH_ASSOC)) 
		{ 
			$Class_id= $rows['Class_id'] ;
			$Level_iname=$rows['Level_iname'];
			$Subjects_name= $rows['Subjects_name'] ; 
			$Session_start_time= $rows['Session_start_time'];
			$Session_end_time=$rows['Session_end_time'];
			$Branch_name=$rows['Branch_name'];	
			$Address= $rows['Address'] ;
			$no_Of_Students= $rows['no_Of_Students'] ;
			$Teacher_name=$rows['Teacher_name'] ;
			
		

		 echo"
		<tr> 
			<td> $Class_id </td> 
			<td>  $Level_iname   </td> 
			<td> $Subjects_name     </td> 
			<td> $Session_start_time</td>
			<td> $Session_end_time </td>
			<td> $Branch_name</td>
			<td> $Address </td>
			<td> $no_Of_Students</td>
			<td> $Teacher_name</td> 
		</tr> ";
		 
		
        } 
    	?>
   </tr> 

	</table> 
	</body> <a href="home.html"><strong>BACK</strong></a>
</html>