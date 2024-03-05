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
       ob_start();
       $Student_name = $Phone_no = $Address = $Enroll_date =$Level_iname=$Subject_name=$Payment_amt="";
$Payment_date="";
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
                while($rows=$obj->fetch(PDO::FETCH_ASSOC))
                {
                    $Student_name=$rows['Student_name'];
                    
            $Phone_no= $rows['Phone_no'] ; 
            $Address= $rows['Address'] ;
            $Enroll_date= $rows['Enroll_date'] ;
            $Level_iname=$rows['Level_iname'] ;
            $Subject_name=$rows['Subjects_name'] ;
            $Payment_amt= $rows['Payment_amt'] ;
            $Payment_date= $rows['Payment_date'];

                
    require('fpdf182/fpdf.php');
    $pdf=new FPDF();
    $pdf->AddPage();

    $pdf->SetFont("Arial","",12);
    $pdf->Cell(0,15,"STUDENT FORM",1,1,"C");

    $pdf->Cell(40,10,"Student Name : ",0,0,"");
    $pdf->Cell(20,10,$Student_name,0,1,"");

    $pdf->Cell(40,10,"Phone_no : ",0,0,"");
    $pdf->Cell(20,10,$Phone_no,0,1,"");
    
    $pdf->Cell(40,10,"Address : ",0,0,"");
    $pdf->Cell(40,10,$Address,0,1,"");  

    $pdf->Cell(40,10,"Enroll Date : ",0,0,"");
    $pdf->Cell(20,10,$Enroll_date,0,1,"");

    $pdf->Cell(40,10,"Level : ",0,0,"");
    $pdf->Cell(20,10,$Level_iname,0,1,"");

    $pdf->Cell(40,10,"Payment amount : ",0,0,"");
    $pdf->Cell(20,10,$Payment_amt,0,1,"");

    $pdf->Cell(40,10,"Payment Date : ",0,0,"");
    $pdf->Cell(20,10,$Payment_date,0,1,"");

    $pdf->output();
                        
                    
             ob_end_flush();   
            }
        }
        else{
                echo "NO ENTRY FOUND!!!";
            }
    }

            
           } 
             catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
       ?>

   </center> 
</body>
</html>






<?php



?>


       
  


