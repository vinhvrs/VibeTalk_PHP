<?php
// addFriend.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $friendID = $_POST["friendID"];
    $userID = $_POST["userID"];
    $date = date("Y-m-d H:i:s");
    // Here, you would typically insert the friend request into your database.
    // For simplicity, we'll just echo the IDs.
    try{
        $con = new PDO("sqlsrv:Server=localhost,1433;Database=WebDev", "sa", "nguyentritue");
        $stmt = $con->prepare("SELECT COUNT(*) FROM FriendRequest;");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row[''] + 1;

        $stmt = $con->prepare("SET IDENTITY_INSERT FriendRequest ON; INSERT INTO FriendRequest (requestID, senderID, receiverID, requestDate, status) VALUES ('$count', '$userID', '$friendID', '$date', 'pending'); SET IDENTITY_INSERT FriendRequest OFF;");
        $stmt->execute();


    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    echo "<script> alert('Friend request sent!'); </script>";

    echo "User ID: " . $userID . "\n";
    echo "Friend ID: " . $friendID . "\n";
}
?>