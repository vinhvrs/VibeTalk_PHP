<?php
error_reporting(E_ERROR | E_PARSE);
$Posts = array();
$Reactions = array();
try {
    $conn = new PDO("sqlsrv:Server=VRS-LAPTOP;Database=WebDev", "sa", "nguyentritue");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM Post LEFT JOIN userInfo ON Post.Author = userInfo.userID ORDER BY postID DESC;");
    $stmt->execute();
    $i = 0;
    while ($row = $stmt->fetch()) {
        $Posts[$i] = array(
            "authorName" => $row['username'],
            "postID" => $row['postID'],
            "date" => $row['Date'],
            "type" => $row['Type'],
            "postData" => $row['Data']
        );
        $i++;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/post.css">
    <title>Insert title here</title>
    <style>
        body {
            background-color: #17151a;
        }
    </style>
    <script>
        var userID = '${userID}';
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
        }
    </script>
</head>

<body>
    <div class="container">
        <?php
        foreach ($Posts as $post) {
            ?>
            <div class="row">
                <div class="card border-success mb-3" style="width: 30rem;">
                    <div class="card-header bg-transparent border-success"><?php echo $post["authorName"]; ?></div>
                    <div class="card-body text-success">
                        <h5 class="card-title">
                            <?php echo $post["type"]; ?>
                        </h5>
                        <div class="card-content">
                            <p class="card-text">
                                <?php echo $post["postData"]; ?>
                            </p>
                            <img src="postData/imgs/logo.jpg" class="card-img-top" alt="...">
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-success">
                        <?php
                        $stmt = $conn->prepare("SELECT * FROM Reaction LEFT JOIN userInfo ON Reaction.userID = userInfo.userID WHERE postID = '" . $post['postID'] . "';");
                        $stmt->execute();
                        $i = 0;
                        while ($row = $stmt->fetch()) {
                            $Reactions[$i] = array(
                                "usernameReaction" => $row['username'],
                                "comment" => $row['Comment']
                            );
                            $i++;
                        }
                        foreach ($Reactions as $reaction) {
                            ?>
                            <div class="reaction">
                                <p>
                                    <?php echo $reaction["usernameReaction"];
                                    echo ": ";
                                    echo $reaction["comment"]; ?>
                                </p>
                            </div>
                            <?php
                        }
                        ?>
                        <form action="comment.php">
                            <input type="hidden" name="postID" value="<?php echo $post['postID']; ?>">
                            <input type="text" name="comment" placeholder="Comment here">
                            <input type="submit" value="Comment">
                        </form>

                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
    </div>
</body>

</html>