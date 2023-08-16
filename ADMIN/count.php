<?php
require '../connection.php'; 

$com ="SELECT * FROM meminfotbl where memAccount != 'ADMIN' AND memStatus='ACTIVE'";
$user = mysqli_query($conn , $com);
$count = mysqli_num_rows($user);

$com1 ="SELECT * FROM meminfotbl where memStatus='APPROVAL'";
$user1 = mysqli_query($conn , $com1);
$count1 = mysqli_num_rows($user1);

$com2 ="SELECT * FROM eventregistrationtable WHERE eventStatus = 'ACTIVE'";
$user2 = mysqli_query($conn , $com2);
$count2 = mysqli_num_rows($user2);

$com3 ="SELECT * FROM studentinfotable WHERE studentStatus = 'REGISTERED'";
$user3 = mysqli_query($conn , $com3);
$count3 = mysqli_num_rows($user3);

$com4 ="SELECT * FROM meminfotbl where memStatus='REGISTERED' AND memAccount = 'FACULTY'";
$user4 = mysqli_query($conn , $com4);
$count4 = mysqli_num_rows($user4);

$fin = $count3 + $count4;
?>