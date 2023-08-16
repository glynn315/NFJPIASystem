<?php

$date = date('Y-m-d');
$com ="SELECT * FROM eventregistrationtable WHERE eventDateStart >= '$date';";
$user = mysqli_query($conn , $com);
$count = mysqli_num_rows($user);

$com1 ="SELECT * FROM eventregistrationtable WHERE eventDateStart <= '$date';";
$user1 = mysqli_query($conn , $com1);
$count1 = mysqli_num_rows($user1);

$com2 ="SELECT * FROM eventmembershiptable WHERE membershipStatus= 'ACTIVE' and memID = '$login_session'";
$user2 = mysqli_query($conn , $com2);
$count2 = mysqli_num_rows($user2);
?>