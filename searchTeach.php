<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Teacher</title>
    <style>
        body{
            background-color: whitesmoke;
            
        }
        input{
            width:40%;
            height:5%;
            border: 1px;
            border-radius: 5px;
            padding: 8px 15px 8px 15px;
            margin: 10px 0px 15px 0px;
            box-shadow:1px 1px 2px 1px grey;
        }
    </style>
</head>
<body>
   <center>
       <h1>Search Teacher by ID</h1>
       <form action="" method="POST">
           <input type="number" name="Teacher_id" placeholder="Enter ID to search"><br>
           <input type="submit" name="search" value="Search data">
              <br>
              <a href="home.html"><strong>BACK</strong></a>
       </form>
       <?php
        $servername = "localhost";
        $username = "root";
        $password = "1234";

  
  try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            if(isset($_POST['search']))
            {
                $id=$_POST['Teacher_id'];
               $sql= "SELECT * from Teacher where Teacher_id='$id'";
                $obj=$conn->prepare($sql);
                $obj->execute();
            
               $r=$obj->rowCount();
               if($r>0)
               {
                while($row=$obj->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                        <form action="" method="POST">
                            <p>Teacher ID</p>
                            <input type="text" name="Teacher_id" value="<?php echo $row["Teacher_id"];?> "/><br>
                            <p>Teacher Name</p>
                            <input type="text" name="Teacher_name" value="<?php echo $row["Teacher_name"];?> "/><br>
                            <p>Phone No</p>
                            <input type="text" name="Phone_no" value="<?php echo $row["Phone_no"];?> "/><br>
                            <p>Address</p>
                            <input type="text" name="Address" value="<?php echo $row["Address"];?> "/><br>
                            <p>Start teach date</p>
                            <input type="text" name="Start_teach_date" value="<?php echo $row["Start_teach_date"];?> "/><br>
                            <p>Working_hours</p>
                            <input type="text" name="Working_hours" value="<?php echo $row["Working_hours"];?> "/><br>
                            <p>Hourly_rate</p>
                            <input type="text" name="Hourly_fees" value="<?php echo $row["Hourly_fees"];?> "/><br>
                        </form>
                    <?php
                }
            }
            else{
                echo "NO ENTRY FOUND!!!";
            }
            }
            } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
       ?>

   </center> 
</body>
</html>