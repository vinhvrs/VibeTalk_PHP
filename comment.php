<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postID = $_POST["postID"];
    $userID = $_COOKIE["userID"];
    $comment = $_POST["comment"];
    $reactionID;
    // Here, you would typically insert the post into your database.
    // For simplicity, we'll just echo the IDs.
    try{
        $con = new PDO("sqlsrv:Server=localhost,1433;Database=WebDev", "sa", "nguyentritue");
        $stmt = $con->prepare("SELECT COUNT(*) FROM Reaction;");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $reactionID = $row[''] + 1;

        $stmt = $con->prepare("SET IDENTITY_INSERT Post ON; INSERT INTO Reaction (reactionID, Comment, userID, postID) VALUES ('$reactionID', '$comment', '$userID', '$postID'); SET IDENTITY_INSERT Post OFF;");
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    header("Location: home.php");
}
?>