<?php
require 'config.php';
session_start();

$group_id = $_POST['group_id'];
$user_id = $_POST['user_id'];
$date = date("Y-m-d");

$sql = "UPDATE GroupRequests set decision = 'accepted' WHERE group_id = '$group_id' AND user_id = '$user_id'";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_execute($stmt);

$sql1 = "INSERT INTO GroupParticipants (group_id, user_id) VALUES ('$group_id','$user_id')";
$stmt1 = mysqli_prepare($db, $sql1);
mysqli_stmt_execute($stmt1);

$sql2 = "SELECT * FROM EventOrganizes natural join Event WHERE group_id='$group_id' AND date >= '$date'";
$res2 = mysqli_query($db, $sql2);
while ($groupEvent = mysqli_fetch_object($res2)) {
    $sql3 = "INSERT INTO EventParticipants (event_id, usersDecision, user_id) VALUES ('$groupEvent->event_id', 'not replied', '$user_id')";
    $stmt0 = mysqli_prepare($db, $sql3);
    mysqli_stmt_execute($stmt0);
}
?>
