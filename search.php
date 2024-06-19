<!DOCTYPE html>
<html>
<head>
    <title>VibeTalk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap-grid.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta type="text/html" charset="UTF-8">
    <script src="JavaScript/search.js"></script>
    <script src="JavaScript/userInfo.js"></script>
</head>
<>
    <?php
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
        error_reporting(E_ERROR | E_PARSE);
        $searchText = $_COOKIE["searchText"];
        $User = array();
        $UserID = array();  
        try {
            $conn = new PDO("sqlsrv:Server=VRS-LAPTOP;Database=WebDev", "sa", "nguyentritue");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM userInfo WHERE username LIKE '%$searchText%';");
            $stmt->execute();
            $i = 0;
            while ($row = $stmt->fetch()) {
                $User[$i] = $row["username"];
                $UserID[$i] = $row["userID"];
                $i++;
            }
            $conn = null;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    ?>
    <table>
        <?php 
            for ($i = 0; $i < count($User); $i++){ 
        ?>
        <tr>
            <td> 
                <a class="btn btn-outline-dark" onclick="var searchID = '<?php echo $UserID[$i]; ?>'; userDetail(searchID);" style="border: 0; color: #f3f5f6; width: 100%"><img src="img/avatar.png" alt="Avatar" style="width: 50px; height: 50px;"><?php echo $User[$i]; ?></a>
            </td>
        </tr>
        <?php 
            }
        ?>
    </table>
    <script>
        Normalize();
    </script>
</body>
</html>