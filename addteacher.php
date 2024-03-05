<!DOCTYPE html>
<html>
  <head>
    <title>Teacher</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  </head>
  <body>


  	<?php
  session_start();
// define variables and set to empty values
$Teacher_name = $Address = $Start_teach_date ="";
$Working_hours="";
$Phone_no="";
$Hourly_fees=0;

$Stu_nErr= $Phon_Err = $Add_Err = $Enr_Err = $Level_iErr =$Sub_Err=$Pay_Err=$PayDate_Err= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Teacher_name"])) {
    $Stu_nErr = "Name is required";
  } else {
    $Teacher_name = test_input($_POST["Teacher_name"]);

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

  if (empty($_POST["Start_teach_date"])) {
    $Enr_Err = "Enter Enroll date";
  } else {
    $Start_teach_date = test_input($_POST["Start_teach_date"]);

  }
  if (empty($_POST["Working_hours"])) {
    $Level_iErr = "Enter Level (11/12)";
  } else {
    $Working_hours =test_input($_POST["Working_hours"]);
  }
  if (empty($_POST["Hourly_fees"])) {
    $Sub_Err = "Enter Subjects('PCM','PCB','PCMB')";
  } else {
    $Hourly_fees = test_input($_POST["Hourly_fees"]);
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
            <h1>TEACHER</h1>
          </div>
          <div class="panel-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <div class="form-group">
                <label for="Teacher_name">Teacher Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="Teacher_name"
                  name="Teacher_name"
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
                <label for="Start_teach_date">StartTeach Date</label>
                <br>
                <input 
                  type="date" 
                  id="Start_teach_date" 
                  name="Start_teach_date">
              </div>
              <div class="form-group">
                <label for="Working_hours">Working Hours</label>
                <input
                  type="time"
                  class="form-control"
                  id="Working_hours"
                  name="Working_hours"
                />
              </div>
              <div class="form-group">
                <label for="Hourly_fees">Hourly_fees</label>
                <input
                  type="number"
                  class="form-control"
                  id="Hourly_fees"
                  name="Hourly_fees"
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
$Class_id=0;
 
  if($Teacher_name!="")
  {  try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    $sql="SELECT Class_id FROM Class ORDER BY Class_id DESC LIMIT 1";
    $obj=$conn->prepare($sql);
    $obj->execute();
    $Class_id=$obj->fetchColumn();
    
$sql = "INSERT INTO Teacher (Phone_No, Teacher_name,Address,Working_hours,Start_teach_date,Hourly_fees)
  VALUES ('$Phone_no','$Teacher_name','$Address','$Working_hours','$Start_teach_date','$Hourly_fees')";
  $obj=$conn->prepare($sql);
  $obj->execute();
  $obj=$conn->prepare("Select last_insert_id()");
  $obj->execute();

  $Teacher_id=$obj->fetchColumn();
  $sql= "set foreign_key_checks=0";
  $conn->query($sql);
  $sql="UPDATE Class SET Teacher_id ='$Teacher_id'where Class_id='$Class_id'";
  $obj=$conn->prepare($sql);
  $obj->execute();
  $sql= "set foreign_key_checks=1";
  $conn->query($sql);
  
  echo "Succesfully Entered";
  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }

    
    
  }
?>
  </body>
</html>
