<?php
    require 'config.php';
    session_start();

    $choice = $_GET['value'];
    $event_id = $_GET['event'];
    $user_id = $_GET['user_id'];

    $sql = "UPDATE EventParticipants set usersDecision = '$choice' WHERE event_id = '$event_id' AND user_id = '$user_id'";
    //mysqli_query($db, $sql);
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_execute($stmt);
?>
 