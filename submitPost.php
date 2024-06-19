<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $postContent = $_POST["postContent"];
    $userID = $_POST["userID"];
    $date = date("Y-m-d H:i:s");
    $type = "Status";
    // Here, you would typically insert the post into your database.
    // For simplicity, we'll just echo the IDs.
    try{
        $con = new PDO("sqlsrv:Server=localhost,1433;Database=WebDev", "sa", "nguyentritue");
        $stmt = $con->prepare("SELECT COUNT(*) FROM Post;");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $row[''] + 1;

        $stmt = $con->prepare("SET IDENTITY_INSERT Post ON; INSERT INTO Post (postID, Author, Date, Type, Data) VALUES ('$count', '$userID', '$date', '$type', '$postContent'); SET IDENTITY_INSERT Post OFF;");
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>