<?php
error_reporting(E_ERROR | E_PARSE);
$Posts = array();
$Reactions = array();
$guestID = $_COOKIE["guestID"];
try {
    $conn = new PDO("sqlsrv:Server=VRS-LAPTOP;Database=WebDev", "sa", "nguyentritue");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM Post LEFT JOIN userInfo ON Post.Author = userInfo.userID WHERE Post.Author = '$guestID' ORDER BY postID DESC;");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link href="css/personalPost.css" rel="stylesheet">
    <meta type="text/html" charset="UTF-8">
    <style>
    body{
        background-color: #17151a;
    }
    </style>
</head>
<body>
    <script>
        function setCenter(){
            var i = 0;
            while (document.getElementsByClassName("card")[i] != null){
                var cardWidth = document.getElementsByClassName("card")[i].offsetWidth;
                var screenWidth = window.innerWidth;
                var marginLeft = (screenWidth - cardWidth) / 2;
                document.getElementsByClassName("card")[i].style.marginLeft = marginLeft + "px";
                i++;
            }
        }
        var href = parent.window.location.href;
        href = href.substring(51);
        if (href.indexOf("#") != -1)
            href = href.substring(0, href.indexOf("#"));
        
        var userID = href;
    </script>

    <?php
        $guestID = $_GET["guestID"];
        $guestName = $_GET["guestName"];
    ?>

    <div class="container">
        <?php
        if ($Posts == null) {
            ?>
            <div class="row">
                <div class="card border-success mb-3" style="width: 100%;">
                    <div class="card-body text-success">
                        <h5 class="card-title">No post yet</h5>
                    </div>
                </div>
            </div>
            <?php
        } else 
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
</body>

</html>