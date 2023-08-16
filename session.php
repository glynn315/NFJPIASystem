<?php
require 'connection.php';
session_start();

$user_check = $_SESSION['login_user'];
$ses_sql = mysqli_query($conn,"SELECT * from meminfotbl where memID = '$user_check'");
   
$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
$login_session = $row['memID'];
$login_Name = $row['memFName'] . ' ' .$row['memLName'];
$schoolReg = $row['schoolID'];
$cred = $row["userAccess"];

if(!isset($_SESSION['login_user'])){
    header("location:index.php");
    die();
}
?>