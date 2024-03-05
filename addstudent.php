<!DOCTYPE html>
<html>
  <head>
    <title>Student</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  </head>
  <body>
  <?php
  
// define variables and set to empty values
$Student_name = $Address = $Enroll_date =$Level_iname=$Subject_name=$Payment_amt="";
$Phone_no="";
$Payment_date="";
$Stu_nErr= $Phon_Err = $Add_Err = $Enr_Err = $Level_iErr =$Sub_Err=$Pay_Err=$PayDate_Err= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Student_name"])) {
    $Stu_nErr = "Name is required";
  } else {
    $Student_name = test_input($_POST["Student_name"]);

  }
  
  if (empty($_POST["Phone_no"])) {
    $Phon_Err = "Phone Number is required";
  } else {
    $Phone_no = test_input($_POST["Phone_no"]);
    
  }
    
  if (empty($_POST["Address"])) {
    $Add_Err = "Enter Address";
  } else {
    $Address = test_input($_POST["Address"]);
  }

  if (empty($_POST["Enroll_date"])) {
    $Enr_Err = "Enter Enroll date";
  } else {
    $Enroll_date = test_input($_POST["Enroll_date"]);

  }
  if (empty($_POST["Level_iname"])) {
    $Level_iErr = "Enter Level (11/12)";
  } else {
    $Level_iname = test_input($_POST["Level_iname"]);
  }
  if (empty($_POST["Subject_name"])) {
    $Sub_Err = "Enter Subjects('PCM','PCB','PCMB')";
  } else {
    $Subject_name = test_input($_POST["Subject_name"]);
  }
  if (empty($_POST["Payment_amt"])) {
    $Pay_Err = " Enter Payment Amount";
  } else {
    $Payment_amt = test_input($_POST["Payment_amt"]);

  }

  if (empty($_POST["Payment_date"])) {
    $PayDate_Err = " Enter Payment Date";
  } else {
    $Payment_date = test_input($_POST["Payment_date"]);

  }
}

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


  
 
?>


    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>STUDENT</h1>
          </div>
          <div class="panel-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
              <div class="form-group">
                <label for="Student_name">Student Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="Student_name"
                  name="Student_name"
                />
              </div>
              <div class="form-group">
                <label for="Phone_no">Phone Number</label>
                <input
                  type="text"
                  class="form-control"
                  id="Phone_no"
                  name="Phone_no"
                />
              </div>
              <div class="form-group">
                <label for="Address">Address</label>
                <input
                  type="text"
                  class="form-control"
                  id="Address"
                  name="Address"
                />
              </div>
              <div>
                <label for="Enroll_date">Enroll Date</label>
                <br>
                <input 
                  type="date" 
                  id="Enroll_date" 
                  name="Enroll_date">
              </div>
              <div class="form-group">
                <label for="Level_iname">Level</label>
                <input
                  type="text"
                  class="form-control"
                  id="Level_iname"
                  name="Level_iname"
                />
              </div>
              <div class="form-group">
                <label for="Subjects">Subject</label>
                <div>
                  <label for="Subject_name" class="radio-inline"
                    ><input
                      type="radio"
                      name="Subject_name"
                      value="PCM"
                      id="Subject"
                    />PCM</label
                  >
                  <label for="Subject_name" class="radio-inline"
                    ><input
                      type="radio"
                      name="Subject_name"
                      value="PCB"
                      id="Subject"
                    />PCB</label
                  >
                  <label for="Subject_name" class="radio-inline"
                    ><input
                      type="radio"
                      name="Subject_name"
                      value="PCMB"
                      id="Subject"
                    />PCMB</label
                  >
                </div>
              </div>
              <div class="form-group">
                <label for="Payment_amt">Payment Amount</label>
                <input
                  type="number"
                  class="form-control"
                  id="Payment_amt"
                  name="Payment_amt"
                />
              </div>
              <div>
                <label for="Payment_date">Payment Date</label>
                <br>
                <input 
                  type="date" 
                  id="Payment_date" 
                  name="Payment_date">
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

 if($Student_name!="")
 {

    try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO Students (Phone_No, Student_name,Address)
  VALUES ('$Phone_no','$Student_name','$Address')";
  
  $conn->exec($sql);
  $obj=$conn->prepare("Select last_insert_id()");
  $obj->execute();
  $last_Stud=$obj->fetchColumn();



  
  $obj=$conn->prepare("Select last_insert_id()");
  $obj->execute();
  $last_pay=$obj->fetchColumn();
  $sql="Select subject_id from Subjects Where Subjects_name='$Subject_name' and Level_iname='$Level_iname'";
  $result=$conn->prepare($sql);
  $result->execute();
  $Sub_id=$result->fetchColumn();
  $str=$last_Stud;
  $str2=$Sub_id;

  
  $sql="SELECT Total_Fees from Fees where Subject_id ='$Sub_id'";
  
  $obj=$conn->prepare($sql);
  $obj->execute();
  $Total_Fees=$obj->fetchColumn();


  $Fees_Remaining=$Total_Fees-$Payment_amt;
  if($Fees_Remaining>=0)
  {
  $sql= "INSERT INTO Payment (Payment_amt, Payment_date,Fees_Remaining)
  VALUES ('$Payment_amt','$Payment_date','$Fees_Remaining')";
  $obj=$conn->prepare($sql);
  $obj->execute();

}

  $conn->exec("set foreign_key_checks=0");


  $sql=" INSERT into Enroll(Student_id,Subject_id,Enroll_date,Payment_id)
        Values('$str','$str2','$Enroll_date','$last_pay')" ;
  $conn->exec($sql);
    $conn->exec("set foreign_key_checks=1");
  echo "Succesfully Entered";


    

  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }

    
  }  
  
?>
  </body>
</html>
