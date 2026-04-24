<?php
session_start();
error_reporting(0);
include('includes/config.php');

if(strlen($_SESSION['login'])==0)
{ 
header('location:index.php');
}
else{
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<title>User Dashboard | Library Management System</title>

<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<link href="assets/css/style.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

<style>

/* ================= MODERN UI DESIGN ================= */

body {
    background: #f4f6f9;
    font-family: "Open Sans", sans-serif;
}

/* HEADER TITLE */
.header-line {
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 25px;
}

/* DASHBOARD CARD */
.dashboard-card {
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: 0.3s;
    margin-bottom: 20px;
}

/* HOVER EFFECT */
.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

/* ICON */
.dashboard-card i {
    font-size: 60px;
    color: #6a5acd;
    margin-bottom: 10px;
}

/* NUMBER */
.dashboard-card h3 {
    font-size: 28px;
    font-weight: bold;
    margin: 10px 0;
}

/* TEXT */
.dashboard-card p {
    font-size: 16px;
    font-weight: 600;
}

/* COLORS */
.card-green {
    background: #e8f5e9;
}

.card-orange {
    background: #fff3e0;
}

.card-blue {
    background: #e3f2fd;
}

/* DARK MODE */
.dark-mode {
    background: #1e1e2f;
    color: #fff;
}

.dark-mode .dashboard-card {
    background: #2a2a40;
    color: #fff;
}

.dark-mode .dashboard-card i {
    color: #fff;
}

.dark-mode .card-green {
    background: #2e7d32 !important;
}

.dark-mode .card-orange {
    background: #ef6c00 !important;
}

.dark-mode .card-blue {
    background: #1565c0 !important;
}

</style>

</head>

<body>

<!-- MENU -->
<?php include('includes/header.php');?>

<div class="content-wrapper">
<div class="container">

    <h4 class="header-line">User Dashboard</h4>

    <div class="row">

        <!-- BOOKS LISTED -->
        <a href="listed-books.php">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-card card-green">

                <i class="fa fa-book"></i>

                <?php 
                $sql ="SELECT id from tblbooks";
                $query = $dbh -> prepare($sql);
                $query->execute();
                $listdbooks=$query->rowCount();
                ?>

                <h3><?php echo htmlentities($listdbooks);?></h3>
                <p>Books Listed</p>

            </div>
        </div>
        </a>

        <!-- NOT RETURNED -->
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-card card-orange">

                <i class="fa fa-recycle"></i>

                <?php 
                $rsts=0;
                $sid=$_SESSION['stdid'];

                $sql2 ="SELECT id from tblissuedbookdetails 
                        where StudentID=:sid 
                        and (RetrunStatus=:rsts || RetrunStatus is null || RetrunStatus='')";

                $query2 = $dbh -> prepare($sql2);
                $query2->bindParam(':sid',$sid,PDO::PARAM_STR);
                $query2->bindParam(':rsts',$rsts,PDO::PARAM_STR);
                $query2->execute();
                $returnedbooks=$query2->rowCount();
                ?>

                <h3><?php echo htmlentities($returnedbooks);?></h3>
                <p>Books Not Returned Yet</p>

            </div>
        </div>

        <!-- ISSUED BOOKS -->
        <a href="issued-books.php">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="dashboard-card card-blue">

                <i class="fa fa-book"></i>

                <?php 
                $ret =$dbh -> prepare("SELECT id from tblissuedbookdetails where StudentID=:sid");
                $ret->bindParam(':sid',$sid,PDO::PARAM_STR);
                $ret->execute();
                $totalissuedbook=$ret->rowCount();
                ?>

                <h3><?php echo htmlentities($totalissuedbook);?></h3>
                <p>Total Issued Books</p>

            </div>
        </div>
        </a>

    </div>

</div>
</div>

<?php include('includes/footer.php');?>

<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/custom.js"></script>

<!-- OPTIONAL DARK MODE SCRIPT -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    if (localStorage.getItem("darkMode") === "enabled") {
        document.body.classList.add("dark-mode");
    }
});
</script>

</body>
</html>

<?php } ?>