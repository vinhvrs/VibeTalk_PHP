<?php
    error_reporting(E_ERROR | E_PARSE);
    
    $severName = "VRS-LAPTOP";
    $database = "WebDev";
    $uid = "sa";
    $PWD = "nguyentritue";
    
    $connectionInfo = [
        "Database" => $database,
        "Uid" => $uid,
        "PWD" => $PWD
    ];
    
    $conn = sqlsrv_connect($severName, $connectionInfo);
    if ($conn) {
        echo "<script> console.log('Connection established.'); </script>";
    } else {
        echo "<script> console.log('Connection could not be established.'); </script>";
        die(print_r(sqlsrv_errors(), true));
    }

    echo "<script> console.log(".$username."); </script>";
    if (isset($_POST["register"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $userID;
        $loggedIn = "false";
        
        $sql = "SELECT * FROM userInfo WHERE username = '$username'";
        $stmt = sqlsrv_query($conn, $sql);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        
        while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "<script> alert('The username has been taken'); </script>";
        }

        $sql = "SELECT COUNT(*) FROM userInfo";
        $stmt = sqlsrv_query($conn, $sql);
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $count = $row[''] + 1;

        $sql = "INSERT INTO userInfo (userID, username, password) VALUES ('$count', '$username', '$password')";
        $stmt = sqlsrv_query($conn, $sql);

        setcookie("loggedIn", true, time() + (86400 * 30), "/");
        setcookie("username", $username, time() + (86400 * 30), "/");
        setcookie("userID", $count, time() + (86400 * 30), "/");
        echo "<script> window.location.href = 'home.php'; </script>";
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>VibeTalk Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta type="text/html" charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap-grid.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap-reboot.css">
    <link rel="stylesheet" href="css/style.css">
    

    <style>

        #registerForm{
            padding: 0;
            background-color: #f8f9fa;
            border-radius: 5px;
            box-shadow: 0 0 5px 0 rgba(0, 0, 0, 0.1);
        }
    </style>

</head>
<body>
    <nav class="navbar bg-dark fixed-top" style="padding-top: 0px;padding-bottom: 0px;padding-left: 0px;">
        <div class="navbar-brand d-inline text-white">
            <a class="nav-brand text-white" href="home.jsp">
                <img src="imgs/logo.png" id="logo" width="70" height="70" class="d-inline-block align-top ml-1" alt="logo">
                <p id="brandname" class="d-inline-block align-middle">VibeTalk</p>
            </a>
        </div>

        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>

        <div class="navbar d-inline text-white bg-dark" id="tab-content">
            <a class="btn btn-outline-light" href="home.jsp" style="border: 0">Home</a>
            <a class="btn btn-outline-light" href="login.jsp" style="border: 0">Login</a>
            <a class="btn btn-outline-light" href="register.jsp" style="border: 0">Register</a>
        </div>
    </nav>

    <div class="container" style="margin-top: 8%;">
        <div class="row-3">
            <div class="col-lg-4 m-auto">
                <div class="card bg-white mt-5" id="registerForm">
                    <div class="card-title bg-primary text-white mt-3">
                        <h3 class="text-center py-3">Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <table>
                                <tr>
                                    <td class="text-dark"> Username </td>
                                    <td> <input type="text" name="username" placeholder="Username" class="form-control mb-3"> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark"> Password </td>
                                    <td> <input type="password" name="password" placeholder="Password" class="form-control mb-3"> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark"> Email </td>
                                    <td> <input type="email" name="email" placeholder="Email" class="form-control mb-3"> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark" style="display: inline"> Phone Number </td>
                                    <td> <input type="text" name="phone" placeholder="Phone Number" class="form-control mb-3"> </td>
                                </tr>
                            </table>
                            <button class="btn btn-success mt-2" style="position: relative; margin-left: 36%" name="register" >Register</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
</body>
</html>
