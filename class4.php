<!DOCTYPE html>
<html>
  <head>
    <title>CLASS</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css" />
  </head>
  <body>
    <?php
  session_start();
// define variables and set to empty values

$no_Of_Student=0;
$Teacher_id=0;
$Teacher_availability=0;
$Session_start_time=$Session_end_time=$Branch_name=$Level_iname=$Subjects_name="";

$Stu_nErr= $Phon_Err = $Add_Err = $Enr_Err = $Level_iErr =$Sub_Err=$Pay_Err=$PayDate_Err= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["no_Of_Student"])) {
    $Stu_nErr = "Name is required";
  } else {
    $no_Of_Student = test_input($_POST["no_Of_Student"]);

  }
  if (empty($_POST["Teacher_id"])) {
    $Stu_nErr = "Name is required";
  } else {
    #echo $_POST["Teacher_id"];
    $Teacher_id = test_input($_POST["Teacher_id"]);

  }
  
  if (empty($_POST["Teacher_availability"])) {
    $Phon_Err = "Phone Number is required";
  } else {
    $Teacher_availability = test_input($_POST["Teacher_availability"]);
    
  }
    
  if (empty($_POST["Branch_name"])) {
    $Add_Err = "Enter Address";
  } else {
    $Branch_name = test_input($_POST["Branch_name"]);
  }

  if (empty($_POST["Session_start_time"])) {
    $Enr_Err = "Enter Enroll date";
  } else {
    $Session_start_time = test_input($_POST["Session_start_time"]);

  }

  if (empty($_POST["Session_end_time"])) {
    $Enr_Err = "Enter Enroll date";
  } else {
    $Session_end_time = test_input($_POST["Session_end_time"]);

  }
  if (empty($_POST["Level_iname"])) {
    $Level_iErr = "Enter Level (11/12)";
  } else {
    #echo $_POST['Level_iname'];
    $Level_iname=test_input($_POST["Level_iname"]);
  }
  if (empty($_POST["Subjects_name"])) {
    $Sub_Err = "Enter Subjects('PCM','PCB','PCMB')";
  } else {
    #echo $_POST["Subjects_name"];
    $Subjects_name= test_input($_POST["Subjects_name"]);
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
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
                <label for="Teacher_availability">Teaher availability</label>
                <div>
                  <label for="yes" class="radio-inline"
                    ><input
                      type="radio"
                      name="Teacher_availability"
                      value="1"
                      id="yes"
                    />Yes</label
                  >
                  <label for="Teacher_availability" class="radio-inline"
                    ><input
                      type="radio"
                      name="Teacher_availability"
                      value="0"
                      id="Teacher_availability"
                    />No</label
                  >
                </div>
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
                <label for="Teacher_id">Teacher id</label>
                <input
                  type="number"
                  class="form-control"
                  id="Teacher_id"
                  name="Teacher_id"
                />
              </div>
              <div class="form-group">
                <label for="Level_iname">Level</label>
                <div>
                  <label for="11" class="radio-inline"
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
                      id="level"
                    />12</label
                  >
                </div>
              </div>
              <div class="form-group">
                <label for="Subjects_name">Subject</label>
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
$Bran_id="";
$Sess_id="";
$Sub_id="";
if($Branch_name!="")
{try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to excepti
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql="Insert into Session(Session_start_time,Session_end_time) Values('$Session_start_time','$Session_end_time')";

  $obj=$conn->prepare($sql);
  $obj->execute();

  $sql="Select last_insert_id()";
  #echo 's';
  $obj= $conn->query($sql);
  $Sess_id=$obj->fetchColumn();
  #echo $Sess_id;


  $sql="select * from branch where Branch_name='$Branch_name'";

  $obj=$conn->query($sql);
  #$obj->execute();
  $Bran_id=$obj->fetchColumn();
  #echo $Bran_id;

  $sql="select * from Subjects where Subjects_name='$Subjects_name'and Level_iname='$Level_iname'";
    $obj=$conn->query($sql);
  #$obj->execute();
  $Sub_id=$obj->fetchColumn();
  #echo "Sub".$Sub_id;


  $sql="Insert into Class(no_Of_Students,Teacher_id,Session_id,Branch_id,Subject_id,Teacher_availability) values('$no_Of_Student','$Teacher_id','$Sess_id','$Bran_id','$Sub_id','$Teacher_availability')";
  $obj=$conn->prepare($sql);
  $obj->execute();
  echo"Successfully Entered";
}catch(PDOexception $e)
{
  echo"Connection failed:".$e->getMessage();
}
}



?>

  </body>
</html>
