<!DOCTYPE html>
<html>
<head>
    <title>ListFriend</title>
    <meta type="text/html" charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap-grid.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/listFriend.css">    
    <script src="JavaScript/userInfo.js"></script>
</head>
<body>
    <?php
        error_reporting(E_ERROR | E_PARSE);
        $username = $_COOKIE["username"];
        $userID = $_COOKIE["userID"];
        $guestID = $_COOKIE["guestID"];
        $Friends = array();
        $FriendID = array();
        if ($username != null) 
            try {
                $con = new PDO("sqlsrv:Server=localhost,1433;Database=WebDev", "sa", "nguyentritue");
                $stmt = $con->prepare("SELECT * FROM userInfo LEFT JOIN Friends ON userInfo.userID = Friends.friendID WHERE Friends.userID = '$guestID';");
                $stmt->execute();
                $i = 0;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $Friends[$i] = $row["username"];
                    $FriendID[$i] = $row["friendID"];
                    $i++;
                }
                $stmt = $con->prepare("SELECT * FROM userInfo LEFT JOIN Friends ON userInfo.userID = Friends.userID WHERE Friends.friendID = '$guestID';");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $Friends[$i] = $row["username"];
                    $FriendID[$i] = $row["userID"];
                    $i++;
                }
                $con = null;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
    ?>
    <table>
        <?php 
            for ($i = 0; $i < count($Friends) - (count($Friends)%2); $i++){ 
        ?>
        <tr>
            <td> 
                <a class="btn btn-outline-dark" onclick="var friendID = '<?php echo $FriendID[$i]; ?>'; userDetail(friendID);" style="border: 0; color: #f3f5f6; width: 100%"><img src="img/avatar.png" alt="Avatar" style="width: 50px; height: 50px;"><?php echo $Friends[$i]; ?></a>
            </td>
            <?php 
                if ($i+1 < count($Friends) - (count($Friends)%2)){
                    $i++;
            ?>
            <td>                     
                <a class="btn btn-outline-dark" onclick="var friendID = '<?php echo $FriendID[$i]; ?>'; userDetail(friendID);" style="border: 0; color: #f3f5f6; width: 100%"><img src="img/avatar.png" alt="Avatar" style="width: 50px; height: 50px;"><?php echo $Friends[$i]; ?></a>
            </td>
            <?php  } ?>
        </tr>
        <?php  
            } 
            if (count($Friends)%2 == 1){
        ?>
            <tr>
                <td> 
                    <a class="btn btn-outline-dark" onclick="var friendID = '<?php echo $FriendID[count($Friends)-1]; ?>'; userDetail(friendID);" style="border: 0; color: #f3f5f6; width: 100%"><img src="img/avatar.png" alt="Avatar" style="width: 50px; height: 50px;"><?php echo $Friends[count($Friends)-1]; ?></a>
                </td>
                <td></td>
            </tr>
        <?php 
            }     
        ?>
    </table>
</body>
</html>
