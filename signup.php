<?php 
session_start();
include('includes/config.php');
error_reporting(0);

if(isset($_POST['signup']))
{
$count_my_page = ("studentid.txt");
$hits = file($count_my_page);
$hits[0] ++;
$fp = fopen($count_my_page , "w");
fputs($fp , "$hits[0]");
fclose($fp); 

$StudentId= $hits[0];   
$fname=$_POST['fullanme'];
$mobileno=$_POST['mobileno'];
$email=$_POST['email']; 
$password=md5($_POST['password']); 
$status=1;

$sql="INSERT INTO tblstudents(StudentId,FullName,MobileNumber,EmailId,Password,Status) 
VALUES(:StudentId,:fname,:mobileno,:email,:password,:status)";
$query = $dbh->prepare($sql);

$query->bindParam(':StudentId',$StudentId,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mobileno',$mobileno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':password',$password,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();

$lastInsertId = $dbh->lastInsertId();

if($lastInsertId)
{
echo "<script>alert('Registration successful! Your ID: $StudentId');</script>";
}
else {
echo "<script>alert('Something went wrong');</script>";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Signup | LMS</title>

<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />

<style>

/* ================= BACKGROUND ================= */
body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #6a5acd, #1e1e2f);
}

/* CENTER CONTAINER */
.signup-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* CARD */
.signup-box {
    width: 500px;
    background: rgba(255,255,255,0.12);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    color: #fff;
}

/* TITLE */
.signup-box h2 {
    text-align: center;
    margin-bottom: 20px;
}

/* INPUT */
.form-control {
    border-radius: 8px;
    background: transparent;
    border: 1px solid #fff;
    color: #fff;
}

.form-control::placeholder {
    color: #ddd;
}

/* LABEL */
label {
    font-weight: bold;
}

/* BUTTON */
.btn-register {
    width: 100%;
    background: #ff9800;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-weight: bold;
    margin-top: 10px;
}

.btn-register:hover {
    background: #e68900;
}

/* HEADER */
.header {
    text-align: center;
    color: #fff;
    padding-top: 20px;
    font-size: 22px;
    font-weight: bold;
}

/* BACK BUTTON */
.back-btn {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255,255,255,0.2);
    color: #fff;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
}

.back-btn:hover {
    background: #fff;
    color: #000;
}

/* FOOTER */
.footer {
    text-align: center;
    color: #fff;
    font-size: 12px;
    padding: 10px;
}

</style>

<script>
function valid(){
if(document.signup.password.value!=document.signup.confirmpassword.value){
alert("Password and Confirm Password do not match!");
return false;
}
return true;
}
</script>

</head>

<body>

<!-- BACK -->
<a href="index.php" class="back-btn">← Back</a>

<div class="header">
    📚 Student Registration - Library System
</div>

<div class="signup-container">

<div class="signup-box">

    <h2>📝 Create Account</h2>

    <form name="signup" method="post" onsubmit="return valid();">

        <div class="form-group">
            <label>Full Name</label>
            <input class="form-control" type="text" name="fullanme" required placeholder="Enter full name">
        </div>

        <div class="form-group">
            <label>Mobile Number</label>
            <input class="form-control" type="text" name="mobileno" maxlength="10" required placeholder="09XXXXXXXXX">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input class="form-control" type="email" name="email" id="emailid" required placeholder="email@example.com">
        </div>

        <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="password" required placeholder="Password">
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input class="form-control" type="password" name="confirmpassword" required placeholder="Confirm Password">
        </div>

        <button type="submit" name="signup" class="btn-register">
            REGISTER NOW
        </button>

    </form>

</div>

</div>

<div class="footer">
    Library Management System © 2026
</div>


</body>
</html>