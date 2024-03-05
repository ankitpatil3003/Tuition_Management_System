<!DOCTYPE html>
<html>
  <head>
    <title>Sign up</title>
    <link rel="stylesheet" type="text/css" href="../bootstrap.css" />
  </head>
  <body>
<?php
  session_start();
// define variables and set to empty values
$Name=$Username=$password=$Phoneno= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["Username"])) {
    $Stu_nErr = "Name is required";
  } else {
    $Username = test_input($_POST["Username"]);

  }
  if (empty($_POST["Name"])) {
    $Stu_nErr = "Name is required";
  } else {
    $Name = test_input($_POST["Name"]);


  }
  if (empty($_POST["password"])) {
    $Stu_nErr = "Name is required";
  } else {
    $password = test_input($_POST["password"]);


  }
  

  
  if (empty($_POST["Phoneno"])) {
    $Phon_Err = "Phone Number is required";
  } else {
    $Phoneno = test_input($_POST["Phoneno"]);
    
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
            <h1>Sign up</h1>
          </div>
          <div class="panel-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
              <div class="form-group">
                <label for="Name">Your Name </label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="Name"
                />
              </div>
              <div class="form-group">
                <label for="Username">Username</label>
                <input
                  type="text"
                  class="form-control"
                  id="username"
                  name="Username"
                />
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="text"
                  class="form-control"
                  id="Password"
                  name="password"
                />
              </div>
              <div class="form-group">
                <label for="Phoneno">Phone No</label>
                <input
                  type="number"
                  class="form-control"
                  id="Phoneno"
                  name="Phoneno"
                />
              </div>
              <input type="submit" name='submit' class="btn btn-primary" />
              <br>
              <br>
              <a href="login.php"><strong>BACK</strong></a>
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


 
    if(isset($_POST['submit']))
   { 
    try {
    $conn = new PDO("mysql:host=$servername;dbname=tm2", $username, $password);
  // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="Select username from userinfo where username='$Username'";
   
  $obj=$conn->prepare($sql);
  $obj->execute();
  $r=$obj->fetchColumn();
  if($r>0)
  {
    echo"Username already Registered. Type another User name";
  }
  else
  {
    $sql="INSERT INTO userinfo(Name,username,Phoneno,password)
    values('$Name','$Username','$Phoneno','$password')";  
    $obj=$conn->prepare($sql);
    $obj->execute();
    
    echo "Successfully Created Login";


  }

  
    
  
 

  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }

    
   }
  
?>
  </body>
</html>
