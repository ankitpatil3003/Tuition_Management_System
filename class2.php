<!DOCTYPE html>
<html>
  <head>
    <title>CLASS</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  </head>
  <body>
<?php
  
// define variables and set to empty values
$Student_name = $Branch_name =  $Session_start_time=$Level_iname=$Subjects_name=$Session_end_time="";
$Teacher_id=$no_Of_Student=0;
$Phone_no="";
$Payment_date="";
$Stu_nErr= $Phon_Err = $Add_Err = $Enr_Err = $Level_iErr =$Sub_Err=$Pay_Err=$PayDate_Err= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["no_Of_Student"])) {
    $Stu_nErr = "Name is required";
  } else {
    $no_Of_Student = test_input($_POST["no_Of_Student"]);

  }
  
  if (empty($_POST["Teacher_id"])) {
    $Phon_Err = "Phone Number is required";
  } else {
    $Teacher_id= test_input($_POST["Teacher_id"]);
    
  }
    
  if (empty($_POST["Branch_name"])) {
    $Add_Err = "Enter Address";
  } else {
    $Branch_name = $_POST["Branch_name"];
  }

  if (empty($_POST["Session_start_time"])) {
    $Enr_Err = "Enter Enroll date";
  } else {
    $Session_start_time = test_input($_POST["Session_start_time"]);

  }
  if (empty($_POST["Level_iname"])) {
    $Level_iErr = "Enter Level (11/12)";
  } else {
    $Level_iname = $_POST["Level_iname"];
  }
  if (empty($_POST["Subjects_name"])) {
    $Sub_Err = "Enter Subjects('PCM','PCB','PCMB')";
  } else {
    $Subjects_name = $_POST["Subjects_name"];
  }
  if (empty($_POST["Session_end_time"])) {
    $Pay_Err = " Enter Payment Amount";
  } else {
    $Session_end_time = test_input($_POST["Session_end_time"]);

  }


$servername = "localhost";
$username = "root";
$password = "1234";
$Sub_id=$last_pay="";

  if(isset($_POST["submit"]))
  {
    try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    $sql="insert into session(Session_start_time,Session_end_time)
    values('$Session_start_time','$Session_end_time')";
    $obj=$conn->prepare($sql);
    $obj->execute();
    $obj=$conn->query("Select last_insert_id()");
    #$obj->execute();
    $Sess_id=$obj->fetchColumn();


    $sql="Select Branch_id from Branch where Branch_name='$Branch_name'";
    $obj=$conn->query($sql);
    #$obj->execute();

    $Bran_id=$obj->fetchColumn();


    $sql="Select Subject_id from Subjects where Subjects_name='$Subjects_name'and Level_iname='$Level_iname'";
    $obj=$conn->query($sql);
    #$obj->execute();
    $Sub_id=$obj->fetchColumn();
    #$Sub_id=intval($Sub_id);
    echo '$Sub_id';
    $TA=1;
    $sql = "INSERT INTO class (Teacher_id,Branch_id,Subject_id,Session_id,no_Of_Students,Teacher_availability)
  VALUES ($Teacher_id,$Bran_id,$Sub_id,$Sess_id,$no_Of_Student,$TA
)";
  $obj=$conn->prepare($sql);
  $obj->execute();
  
  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }

    
    
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
                <label for="Branch_name">Branch Name</label>
                 <div>
                  <label for="Prodigy" class="radio-inline"
                    ><input
                      type="radio"
                      name="Branch_name"
                      value="Prodigy"
                      id="Branch"
                    />Prodigy</label
                  >
                  <label for="Branch_name" class="radio-inline"
                    ><input
                      type="radio"
                      name="Branch_name"
                      value="Perseverance"
                      id="Branch"
                    />Perseverance</label
                  >
                  <label for="Branch_name" class="radio-inline"
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
                      value=11
                      id="11"
                    />11</label
                  >
                  <label for="Level_iname" class="radio-inline"
                    ><input
                      type="radio"
                      name="Level_iname"
                      value=12
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
$servername = "localhost";
$username = "root";
$password = "1234";
$Sub_id=$last_pay="";

 
    try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    $sql="insert into session(Session_start_time,Session_end_time)
    values('$Session_start_time','$Session_end_time')";
    $obj=$conn->prepare($sql);
    $obj->execute();
    $obj=$conn->query("Select last_insert_id()");
    $Sess_id=$obj->fetchColumn();


    $sql="Select Branch_id from Branch where Branch_name='$Branch_name'";
    $obj=$conn->prepare($sql);
    $obj->execute();
    $Bran_id=$obj->fetchColumn();


    $sql="Select Subject_id from subjects where Subjects_name='$Subjects_name'and Level_iname='$Level_iname'";
    $obj=$conn->prepare($sql);
    $obj->execute();
    $Sub_id=$obj->fetchColumn();
    $TA=1;
    $sql = "INSERT INTO class (Teacher_id,Subject_id,Session_id,no_Of_Students,Teacher_availability)
  VALUES ('$Teacher_id','$Sub_id','$Sess_id','$no_Of_Student','$TA'
)";
  $obj=$conn->prepare($sql);
  $obj->execute();
  
  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }

    
    
  
?>
</body>

</html>