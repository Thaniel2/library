<?php
session_start();
error_reporting(0);
include('includes/config.php');

if($_SESSION['alogin']!=''){
    $_SESSION['alogin']='';
}

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    $sql ="SELECT UserName,Password FROM admin WHERE UserName=:username and Password=:password";
    $query= $dbh->prepare($sql);
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->execute();

    if($query->rowCount() > 0)
    {
        $_SESSION['alogin']=$username;
        echo "<script>document.location ='admin/dashboard.php';</script>";
    }
    else{
        echo "<script>alert('Invalid Details');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login | LMS</title>

<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />

<style>

/* BACKGROUND */
body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #6a5acd, #1e1e2f);
    height: 100vh;
    display: flex;
    flex-direction: column;
}

/* HEADER */
.header {
    padding: 20px;
    text-align: center;
    color: #fff;
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
    font-weight: bold;
    transition: 0.3s;
}

.back-btn:hover {
    background: #fff;
    color: #000;
}

/* LOGIN CONTAINER */
.login-container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* LOGIN BOX */
.login-box {
    width: 400px;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    color: #fff;
}

.login-box h3 {
    text-align: center;
    margin-bottom: 20px;
}

/* INPUT */
.form-control {
    background: transparent;
    border: 1px solid #fff;
    color: #fff;
    border-radius: 8px;
}

.form-control::placeholder {
    color: #ddd;
}

/* BUTTON */
.btn-login {
    width: 100%;
    background: #ff9800;
    border: none;
    padding: 10px;
    border-radius: 8px;
    font-weight: bold;
    margin-top: 10px;
}

/* ICON */
.icon {
    text-align: center;
    font-size: 50px;
    margin-bottom: 10px;
}

/* FOOTER */
.footer {
    text-align: center;
    color: #fff;
    padding: 10px;
    font-size: 12px;
}

</style>
</head>

<body>

<!-- 🔙 BACK BUTTON -->
<a href="index.php" class="back-btn">← Back</a>

<div class="header">
    📚 Library Management System - Admin
</div>

<div class="login-container">

    <div class="login-box">

        <div class="icon">🔐</div>

        <h3>Admin Login</h3>

        <form method="post">

            <div class="form-group">
                <label>Username</label>
                <input class="form-control" type="text" name="username" required placeholder="Enter username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" required placeholder="Enter password">
            </div>

            <button type="submit" name="login" class="btn-login">
                LOGIN
            </button>

        </form>

    </div>

</div>

<div class="footer">
    Library Management System © 2026
</div>

</body>
</html>