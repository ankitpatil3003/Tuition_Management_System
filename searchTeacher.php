
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
            button{
                padding: 8px;
                text-decoration:none;
            }
            button:hover{
                background-color:lightcoral;
            }
		</style>
	</head> 


	<body> 
		<?php 

		$Teacher_name = $Phone_no = $Address = $Start_teach_date =$Teacher_id=$Working_hours=$Hourly_fees="";


		$servername = "localhost";
		$username = "root";
		$password = "1234";
		$Sub_id=$last_pay="";
		try {
		  $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  $sql="SELECT * FROM Teacher";
		  $obj=  $conn->prepare($sql);
		  	$obj->execute();
		  	?>



		<form action="<?php echo htmlspecialchars($_POST["Teacher_id"]);?>" method="POST">
           <input type="number" name="Teacher_id" placeholder="Enter ID to search"><br>
           <input type="submit" name="search" value="Search data">
              <br>
              <a href="home.html"><strong>BACK</strong></a>
       </form>
        
	<table align="center" border="1px" style="width:800px; line-height:40px;"> 
	<tr> 
		<th colspan="8"><h2>Teachers Record</h2></th> 
		</tr> 
                <th> ID </th>
                <th> Name </th> 
                <th> Phone No </th> 
                <th> Address </th> 
                <th> Start teach Date </th> 
                <th> Working Hours </th>
                <th> Hourly Rate </th> 
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
			<?php
				if(isset($_POST["search"]))
				{
					echo $_POST["search"];
				}
		  
		    	if(!empty($_POST["Teacher_id"]) )
		    	{
		                $id=$_POST['Teacher_id'];
		                echo $id;
		                $sql="SELECT Class_id FROM Class ORDER BY Class_id DESC LIMIT 1";
		    $obj=$conn->prepare($sql);
		    $obj->execute();
		    $Class_id=$obj->fetchColumn();
		     $sql= "set foreign_key_checks=0";
		  $conn->query($sql);
		  $sql="UPDATE Class SET Teacher_id ='$id' where Class_id='$Class_id'";
		  $obj=$conn->prepare($sql);
		  $obj->execute();
		  $sql= "set foreign_key_checks=1";
		  $conn->query($sql);

		  
		  	}
		  	else{

		  		echo"Error";
		  	}
		  	echo"Succesfully Entered";
		   

		} catch(PDOException $e) {
		  echo "Connection failed: " . $e->getMessage();
		}

		?>  
	</body> 
</html>