<?php 
//include_once('connection.php'); 

$Subjects_name = $Level_iname ="";

$Fees_id=$Subject_id=$Total_Fees=0;

$servername = "localhost";
$username = "root";
$password = "1234";
$Sub_id=$last_pay="";
try {
  $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="SELECT a.Subjects_name,a.Level_iname,b.Fees_id,b.Subject_id,b.Total_Fees
FROM Fees b
    INNER JOIN Subjects a
        ON b.Subject_id=a.Subject_id";
    
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
		<th colspan="9"><h2>COURSE FEES</h2></th> 
		</tr> 
                <th> ID </th>
                <th>Subject ID</th>
                <th> Level</th> 
                <th> Subjects </th>
                <th> Total Fees</th>
        </tr> 
		
		<?php while($rows=$obj->fetch(PDO::FETCH_ASSOC)) 
		{ 
			$Fees_id= $rows['Fees_id'] ;
			$Subject_id=$rows['Subject_id'];
			$Level_iname=$rows['Level_iname'];
			$Subjects_name= $rows['Subjects_name'] ; 
			
			$Total_Fees=$rows['Total_Fees'] ;
			
		

		 echo"
		<tr> 
			<td> $Fees_id 		</td> 
			<td> $Subject_id    </td>
			<td> $Level_iname 	</td> 
			<td> $Subjects_name	</td> 
			<td> $Total_Fees	</td> 
		</tr> ";
		 
		
        } 
    	?>
   </tr> 

	</table> 
	<a href="home.html"><strong>BACK</strong></a>
	</body> 
</html>