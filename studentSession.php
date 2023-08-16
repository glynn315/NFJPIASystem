<?php
require 'connection.php';
session_start();

$user_check = $_SESSION['login_user'];
$ses_sql = mysqli_query($conn,"SELECT * from studentinfotable where studentID = '$user_check'");
   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$login_session = $row['studentID'];
$login_Name = $row['studentFname'] . ' ' .$row['studentLname'];
$schoolReg = $row['schoolID'];

if(!isset($_SESSION['login_user'])){
    header("location:index.php");
    die();
}
?>