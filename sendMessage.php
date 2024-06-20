<?php
    $con = new PDO("sqlsrv:Server=VRS-LAPTOP;Database=WebDev", "sa", "nguyentritue");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $message = $_COOKIE['message'];
        $userID = $_COOKIE['userID'];
        $friendID = $_COOKIE['friendID'];
        echo "<script> alert('$message'); </script>";
        echo "<script> alert('$userID'); </script>";
        // Insert your code here to handle sending the message
        // This could involve storing the message in a database, etc.
        $stmt = $con->prepare("INSERT INTO Messages (senderID, receiverID, messageSent) VALUES ('$userID', '$friendID', '$message')");
        $stmt->execute([$userID, $message]);
    }
?>