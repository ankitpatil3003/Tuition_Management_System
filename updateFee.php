<?php


 session_start();
// define variables and set to empty values
$Student_name = "";
$Payment_id=0;
$Amount_to_be_paid=0;
$Stu_nErr= $Phon_Err = $Add_Err = $Enr_Err = $Level_iErr =$Sub_Err=$Pay_Err=$PayDate_Err= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Student_name"])) {
    $Stu_nErr = "Name is required";
  } else {
    $Student_name = test_input($_POST["Student_name"]);

  }
  
  if (empty($_POST["Payment_id"])) {
    $Phon_Err = "Payment Number is required";
  } else {
    $Payment_id= test_input($_POST["Payment_id"]);
    
  }
    
  if (empty($_POST["Amount_to_be_paid"])) {
    $Add_Err = "Enter Amount";
  } else {
    $Amount_to_be_paid = test_input($_POST["Amount_to_be_paid"]);
  }

}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}





?>




<!DOCTYPE html>
<html>
  <head>
    <title>UPDATE PAYMENT</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  </head>
  <body>
    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>Update Payment</h1>
          </div>
          <div class="panel-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
              <div class="form-group">
                <label for="Student_name">Name of Student</label>
                <input
                  type="text"
                  class="form-control"
                  id="Student_name"
                  name="Student_name"
                />
              </div>
              <div class="form-group">
                <label for="Payment_id">Payment ID</label>
                <input
                  type="number"
                  class="form-control"
                  id="Payment_id"
                  name="Payment_id"
                />
              </div>
              <div class="form-group">
                <label for="Amount_to_be_paid">Amount to be paid</label>
                <input
                  type="number"
                  class="form-control"
                  id="Amount_to_be_paid"
                  name="Amount_to_be_paid"
                />
              </div>
              <input type="submit" class="btn btn-primary" />
              <br>
              <br>
              <a href="home.html"><strong>BACK</strong></a>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
<?php
$servername = "localhost";
$username = "root";
$password = "1234";
$Sub_id=$last_pay="";

 if($Student_name!="" || $Payment_id!=0)
 {

    try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($Payment_id!=0)
      {
         $sql="SELECT c.Total_Fees from Payment a
          inner join Enroll b
              on a.Payment_id=b.Payment_id
          inner join Fees c
              on c.Subject_id=b.Subject_id
              where b.Payment_id='$Payment_id'";    

              
  
        $obj=$conn->prepare($sql);
        $obj->execute();
        $Total_Fees=$obj->fetchColumn();

        $sql="SELECT Payment_amt from Payment where Payment_id='$Payment_id'";
        $obj=$conn->prepare($sql);
        $obj->execute();
        $Early_Fees=$obj->fetchColumn();  




        
        $Payment_amt=$Amount_to_be_paid +$Early_Fees;
        $Fees_Remaining=$Total_Fees-$Payment_amt;         
         if($Fees_Remaining>=0) {
          $conn->exec("set foreign_key_checks=0");

          $sql = "UPDATE Payment
          SET Fees_Remaining='$Fees_Remaining',
          Payment_amt='$Payment_amt' where Payment_id='$Payment_id'";
        
           
            $obj=$conn->prepare($sql);
            $obj->execute();
             $conn->exec("set foreign_key_checks=1");

          }
     }
    else 
    {
        $sql="SELECT c.Payment_id from Students a
              inner join Enroll b
                on a.Student_id=b.Student_id
              inner join Payment c
                on b.Payment_id=c.Payment_id 
              where a.Student_name='$Student_name'";
              $obj=$conn->prepare($sql);
              $obj->execute();
              $Payment_id=$obj->fetchColumn();
        $sql="SELECT c.Total_Fees from Payment a
          inner join Enroll b
              on a.Payment_id=b.Payment_id
          inner join Fees c
              on c.Subject_id=b.Subject_id
              where b.Payment_id='$Payment_id'";    

              
  
        $obj=$conn->prepare($sql);
        $obj->execute();
        $Total_Fees=$obj->fetchColumn();

        $sql="SELECT Payment_amt from Payment where Payment_id='$Payment_id'";
        $obj=$conn->prepare($sql);
        $obj->execute();
        $Early_Fees=$obj->fetchColumn();

          $Payment_amt=$Amount_to_be_paid +$Early_Fees;
        $Fees_Remaining=$Total_Fees-$Payment_amt; 

               
         if($Fees_Remaining>=0) {
          $conn->exec("set foreign_key_checks=0");
        $sql = "UPDATE Payment
          SET Fees_Remaining='$Fees_Remaining',
          Payment_amt='$Payment_amt' where Payment_id='$Payment_id'";
       
  
  
       $obj=$conn->prepare($sql);
       $obj->execute();
        $conn->exec("set foreign_key_checks=1");
    }
      
    }
    echo "Updated";
  
  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }

    }
    
  ?>
  </body>
</html>
