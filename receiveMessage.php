<?php
    $con = new PDO("sqlsrv:Server=VRS-LAPTOP;Database=WebDev", "sa", "nguyentritue");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $userID = $_GET['userID'];

        // Insert your code here to handle receiving the message
        // This could involve fetching the message from a database, etc.
        $stmt = $con->prepare("SELECT messageReceived FROM Messages WHERE receiverID = ?");
        $stmt->execute([$userID]);
        $messageReceived = $stmt->fetch(PDO::FETCH_ASSOC)['messageReceived'];
        echo $messageReceived;
    }
?>