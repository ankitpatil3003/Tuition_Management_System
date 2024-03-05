<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
    <link rel="stylesheet" type="text/css" href="whichteacher.css">
</head>
<body>
    <?php
    session_start();
        if(isset($_SESSION['id']))
        echo $_SESSION['id'];
    //$Class_id=$_POST['id1'];
    //echo $Class_id;
    
    ?>
    <center>
        <h2>Which teacher you want
        to include in class ?</h2>
        <br><br><br><br><br><br><br>
        <button><a href="searchTeacher.php"><Strong>Existing Teacher</Strong></a></button>
        <br><br>
        <button><a href="addteacher.php?id='$Class_id'"><Strong>Add new teacher</Strong></a></button>
    </center>
</body>
</html>