<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Student</title>
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
       <h1>Search Student by ID</h1>
       <form action="" method="POST">
           <input type="number" name="Student_id" placeholder="Enter ID to search"><br>
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
                $id=$_POST['Student_id'];
               $sql= "SELECT a.Student_id,a.Student_name,a.Phone_no,a.Address,b.Enroll_date,c.Level_iname,c.Subjects_name,d.Payment_amt,d.Payment_date 
                    FROM Students a

                        INNER JOIN Enroll b
                            ON b.Student_id=a.Student_id
                        INNER JOIN Subjects c
                            ON c.Subject_id=b.Subject_id
                        INNER JOIN Payment d
                            ON d.Payment_id = b.Payment_id

                            Where a.Student_id='$id'";
                $obj=$conn->prepare($sql);
                $obj->execute();
            
               $r=$obj->rowCount();
               if($r>0)
               {
                while($row=$obj->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                        <form action="" method="POST">
                            <p>Student ID</p>
                            <input type="text" name="Student_id" value="<?php echo $row["Student_id"];?> "/><br>
                            <p>Student Name</p>
                            <input type="text" name="Student_name" value="<?php echo $row["Student_name"];?> "/><br>
                            <p>Address</p>
                            <input type="text" name="Address" value="<?php echo $row["Address"];?> "/><br>
                            <p>Enroll Date</p>
                            <input type="text" name="Enroll_date" value="<?php echo $row["Enroll_date"];?> "/><br>
                            <p>Level</p>
                            <input type="text" name="Level_iname" value="<?php echo $row["Level_iname"];?> "/><br>
                            <p>Subject Name</p>
                            <input type="text" name="Subjects_name" value="<?php echo $row["Subjects_name"];?> "/><br>
                            <p>Payment amount</p>
                            <input type="text" name="Payment_amt" value="<?php echo $row["Payment_amt"];?> "/><br>
                            <p>Payment Date</p>
                            <input type="text" name="Payment_date" value="<?php echo $row["Payment_date"];?> "/><br>
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