<!DOCTYPE html>
<html>
  <head>
    <title>CLASS</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  </head>
  <body>

    <div class="container">
      <div class="row col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
          <div class="panel-heading text-center">
            <h1>CLASS</h1>
          </div>
          <div class="panel-body">
            <form action="<?php echo htmlspecialchars($_POST["PHP_SELF"])?>" method="POST">
              <div class="form-group">
                <label for="no_Of_Student">No of Student</label>
                <input
                  type="number"
                  class="form-control"
                  id="no_Of_Student"
                  name="no_Of_Student"
                />
              </div>
              <div class="form-group">
                <label for="Teachers">Teacher id</label>
                <input
                  type="number"
                  class="form-control"
                  id="no_Of_Student"
                  name="Teacher_id"
                />
              </div>
              
              <div class="form-group">
                <label for="Session_start_time">Session Start Time</label>
                <input
                  type="time"
                  class="form-control"
                  id="Session_start_time"
                  name="Session_start_time"
                />
              </div>
              <div class="form-group">
                <label for="Session_end_time">Session End Time</label>
                <input
                  type="time"
                  class="form-control"
                  id="Session_end_time"
                  name="Session_end_time"
                />
              </div>
              <div class="form-group">
                <label for="Branches">Branch Name</label>
                 <div>
                  <label for="Prodigy" class="radio-inline"
                    ><input
                      type="radio"
                      name="Branch_name"
                      value="Prodigy"
                      id="Branch"
                    />Prodigy</label
                  >
                  <label for="Perseverance" class="radio-inline"
                    ><input
                      type="radio"
                      name="Branch_name"
                      value="Perseverance"
                      id="Branch"
                    />Perseverance</label
                  >
                  <label for="Diligent" class="radio-inline"
                    ><input
                      type="radio"
                      name="Branch_name"
                      value="Diligent"
                      id="Branch"
                    />Diligent</label
                  >
                </div>
                
              
              <div class="form-group">
                <label for="Level">Level</label>
                <div>
                  <label for="Level_iname" class="radio-inline"
                    ><input
                      type="radio"
                      name="Level_iname"
                      value="11"
                      id="11"
                    />11</label
                  >
                  <label for="Level_iname" class="radio-inline"
                    ><input
                      type="radio"
                      name="Level_iname"
                      value="12"
                      id="12"
                    />12</label
                  >
                </div>
              </div>
              <div class="form-group">
                <label for="Subjects">Subject</label>
                <div>
                  <label for="Subjects_name" class="radio-inline"
                    ><input
                      type="radio"
                      name="Subjects_name"
                      value="PCM"
                      id="Subject"
                    />PCM</label
                  >
                  <label for="Subjects_name" class="radio-inline"
                    ><input
                      type="radio"
                      name="Subjects_name"
                      value="PCB"
                      id="Subject"
                    />PCB</label
                  >
                  <label for="Subjects_name" class="radio-inline"
                    ><input
                      type="radio"
                      name="Subjects_name"
                      value="PCMB"
                      id="Subject"
                    />PCMB</label
                  >
                </div>
              </div>
              <input name="submit" type="submit" class="btn btn-primary" />
              <a href="display.php" id="Teacher_button"><strong>ADD TEACHER</strong></a>
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
   
  
// define variables and set to empty values
$Session_start_time = $Session_end_time = $Branch_name =$Level_iname=$Subjects_name="";
$no_Of_Student=0;
$Teacher_id=0;
$Stu_nErr= $Phon_Err = $Add_Err = $Enr_Err = $Level_iErr =$Sub_Err=$Pay_Err=$PayDate_Err= "";

if (!empty($_POST["submit"]) ) {
  if (empty($_POST["Session_start_time"])) {
    $Stu_nErr = "Session_start_time is required";
  } else {
    $Session_start_time = test_input($_POST["Session_start_time"]);

  }
  
  if (empty($_POST["Session_end_time"])) {
    $Phon_Err = "Session_end_time is required";
  } else {
    $Session_end_time = test_input($_POST["Session_end_time"]);
    
  }
    
  if (empty($_POST["no_Of_Student"])) {
    $Add_Err = "Enter no_Of_Student";
  } else {
    $no_Of_Student = test_input($_POST["no_Of_Student"]);
    echo '$no_Of_Student';
  }

  if (empty($_POST["Teacher_id"])) {
    $Add_Err = "Teacher_id";
  } else {
    $Teacher_id= test_input($_POST["Teacher_id"]);
    echo "$Teacher_id";
  }

  if (empty($_POST["Branch_name"]))
   { 
   }else{$Branch_name = test_input($_POST["Branch_name"]);
    echo"$Branch_name";

  }
  if (empty($_POST["Level_iname"])) {
    $Level_iErr = "Enter Level (11/12)";
  } else {
    $Level_iname = test_input($_POST["Level_iname"]);
  }
  if (empty($_POST["Subjects_name"])) {
    $Sub_Err = "Enter Subjects('PCM','PCB','PCMB')";
  } else {
    $Subjects_name = test_input($_POST["Subjects_name"]);
  }
  $servername = "localhost";
$username = "root";
$password = "1234";
$Bran_id=1;
$Sess_id=0;
$Sub_id=0;
  
  
    try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "INSERT INTO Session (Session_start_time,Session_end_time)
  VALUES ('$Session_start_time','$Session_end_time')";
  
  $obj=$conn->prepare($sql);
  $obj->execute();
  $obj=$conn->prepare("Select last_insert_id()");
  $obj->execute();
  $Sess_id=$obj->fetchColumn();
   
  $sql="Select Subject_id  from Subjects Where Subjects_name='$Subjects_name' and Level_iname='$Level_iname'";
  $result=$conn->prepare($sql);
  
  $result->execute();

  $Sub_id=$result->fetchColumn();
 
  
  
  
$sql="Select Branch_id from Branch where Branch_name='$Branch_name'";
$obj=$conn->prepare($sql);
$obj->execute();
  $Bran_id=$obj->fetchColumn();
  echo "$Bran_id";
  $sql="INSERT INTO Class (Branch_id,Subject_id,Session_id,no_Of_Students,Teacher_availability)
  VALUES ('$Bran_id','$Sub_id','$Sess_id','$no_Of_Student','$Teacher_availability')";
  $conn->query($sql);

  
   
  echo "Succesfully Entered";

  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }
  
 
}

  

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  
 
?>

  </body>
</html>
