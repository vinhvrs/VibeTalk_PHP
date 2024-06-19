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

    if (count($_COOKIE) > 0){
        echo "<script> login(); </script>";
        $loggedIn = $_COOKIE["loggedIn"];
        $username = $_COOKIE["username"];
        $password = $_COOKIE["password"];
        $userID = $_COOKIE["userID"];   
    }
    else {
        $loggedIn = "false";
        $username = null;
        $password = null;
        $userID = null;
    }

    echo "<script> console.log('".$username."'); </script>";
    echo "<script> console.log('".$loggedIn."'); </script>";
    echo "<script> console.log('".$password."'); </script>";
?>
<html>
<head>
    <title>VibeTalk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta type="text/html" charset="UTF-8">
    <script src="JavaScript/CheckLogin.js"></script>
    <script src="JavaScript/homepage.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        var userID = '${userID}';
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
        }
    </script>
    <style>
        a {
        text-decoration: none;
        }
        a:hover{
        text-decoration: none;
        }
        .my-dropdown-toggle::after {
        content: none;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark fixed-top" style="padding-top: 0px;padding-bottom: 0px;padding-left: 0px;">
        <div class="navbar-brand d-inline text-white">
            <a class="nav-brand text-white" href="home.php">
                <img src="imgs/logo.png" id="logo" width="70" height="70" class="d-inline-block align-top ml-1" alt="logo">
                <p id="brandname" class="d-inline-block align-middle">VibeTalk</p>
            </a>
        </div>

        <form class="form-inline d-inline ml-1 text-white" id="searchForm" style="margin: 0;">
            <input class="form-control mr-sm-2 d-inline" type="text" placeholder="Search" aria-label="Search" id="searchText"
                name="searchText">
            <button class="btn btn-outline-light my-2 my-sm-0 d-inline" type="submit" onclick="Search();">Search</button>
        </form>

        <div class="space"></div>

        <div class="navbar d-inline text-white" id="tab-content">
            <a class="btn btn-outline-light" href="#post" onclick="postTab()" style="border: 0">Post</a>
            <a class="btn btn-outline-light" href="#video" onclick="videoTab()" style="border: 0">Video</a>
            <a class="btn btn-outline-light" href="#music" onclick="musicTab()" style="border: 0">Music</a>
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

        <script>
            var form=document.getElementById("searchForm");
            function submitForm(event){
                event.preventDefault();
            }
            form.addEventListener('submit', submitForm);
        </script>

        <?php
            if (isset($_POST["searchText"])) {
                echo "<script>document.getElementById('searchText').value = '".$_POST["searchText"]."';</script>";
            }
        ?>

        <a class="nav-brand" href="#notification" id="notification" onclick="showNotification()">
            <img src="imgs/bell.png" height="30" width="30" alt="notification" loading="lazy">
        </a>
        <div id="notificationBox" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p><?php echo $output; ?></p>
            </div>
        </div>

        <div class="nav-brand ml-2" id="userDetail">
        </div>

        <div class="dropdown bg-dark float-lg-end" id="login">
            
        </div>
        <div id="dom-target" style="display: none;">
            <?php
                echo htmlspecialchars($userID); /* You have to escape because the result
                                                will not be valid HTML otherwise. */
            ?>
        </div>
        <script>
            var loggedIn = "<?php echo $loggedIn; ?>";
            var username = "<?php echo $username; ?>";
            var userID = "<?php echo $userID; ?>";
            const space = "<div class='space d-inline'></div>";
            const image = "<img src='imgs/avatar.jpg' alt='avatar' style='width: 40px; height: 40px; border-radius: 50%; margin-left: 30px; margin-right: 10px'>";
            const loginHTML = "<a class='nav-brand d-inline mr-4' href=''>Guest</a>" + space
                            + "<a class='btn btn-outline-light' id='button' href='login.php'>Login</a>";
            const logoutHtml = "<a class='nav-brand' onclick = 'userDetail("+userID+");'>" + image +"   "+ username + "</a>";
            const button =  "<button class='btn btn-secondary dropdown-toggle my-dropdown-toggle navbar-light' type='button' id='userAction' data-bs-toggle='dropdown'"
                            + " aria-haspopup='true' aria-expanded='false'> "
                            +    "<span class='navbar-toggler-icon'></span>"
                            + "</button>"
                            + "<div class='dropdown-menu dropdown-menu-end bg-secondary' aria-labelledby='userAction'>"
                            +    "<a class='dropdown-item' type='button' href='changePassword.php'>Change Password</button>"
                            +    "<a class='dropdown-item' type='button' href='logout.php'>Logout</button>"
                            + "</div>";
            if (loggedIn === "false") {
                document.getElementById("login").innerHTML = loginHTML;
            } else {
                document.getElementById("userDetail").innerHTML = logoutHtml;
                document.getElementById("login").innerHTML = button;
            }
        </script>
    </nav>

    <div class="wrapper" id = "wrapper-content">
        <div class="nav-side">
            <div class="flex-column">
                <a class="nav-link" href="http://localhost/VibeTalk_PHP/userInfo.php?userID=<?php echo $userID; ?>#friends">
                    <button type="button" class="btn btn-outline-light" style="width: 100%; text-align: left">Friends</button>
                </a>
                <a class="nav-link" href="userInfo.php?userID=<%=userID%>#videos">
                    <button type="button" class="btn btn-outline-light" style="width: 100%; text-align: left">Your video</button>
                </a>
                <a class="nav-link" href="bookmark.php">
                    <button type="button" class="btn btn-outline-light" style="width: 100%; text-align: left">Bookmark</button>
                </a>
                <a class="nav-link" href="Group.php">
                    <button type="button" class="btn btn-outline-light" style="width: 100%; text-align: left">Groups</button>
                </a>
                <hr style="border: 1px solid #2c2d2e; width: 90%">
                <h4 style="text-align: center; font-size: large; color: #f3f5f6">Recommendation</h4>
                <!-- <iframe src="recommendation.php" style="border-radius:12px; margin-left: 2%" width="96%" height="39%" frameBorder="0" loading="eager"></iframe> -->
            </div>
        </div>    
        
        <script>
            if (loggedIn === "false") {
                document.getElementsByClassName("nav-side")[0].style.display = "none";
            }
        </script>

        <div class="post-content" id ="content">
            <iframe src="post_tab.php" id="switchTab" width="100%" onload="resizeIframe(this)" scrolling="no" style="border: none; bottom-margin: 0"></iframe>
        </div>
        <div class="music-chat" id ="music-chat">
            <form id="Spotify">
                <input type="text" id="spotifyUrl" name="spotify" placeholder="Spotify Playlist Link" style="width: 70%; height: 30px; border-radius: 5px; margin-top: 10px">
                <input type="submit" value="Get" style="width: 20%; height: 30px; border-radius: 5px; margin-top: 10px" onclick="getSpotify();">
            </form>
            <button id ="Music-Expand" onclick = "Resize()"></button>
            <iframe id ="music-frame" src="https://open.spotify.com/embed/playlist/37i9dQZEVXbvnp90hdyDxB?utm_source=generator" height="80px" width="300px" frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture" loading="lazy"></iframe>
            <div id="chat-frame" class="chat-frame">
                <?php
                    $Friends = array();
                    if ($username != null) {
                        try {
                            $conn = new PDO("sqlsrv:Server=VRS-LAPTOP;Database=WebDev", "sa", "nguyentritue");
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $conn->prepare("SELECT username FROM userInfo LEFT JOIN Friends ON userInfo.userID = Friends.friendID WHERE Friends.userID = (SELECT userID FROM userInfo WHERE userInfo.username = :username);");
                            $stmt->bindParam(':username', $username);
                            $stmt->execute();
                            $j = 0;
                            while ($row = $stmt->fetch()) {
                                $Friends[$j] = $row['username'];
                                $j++;
                            }
                            $stmt = $conn->prepare("SELECT username FROM userInfo LEFT JOIN Friends ON userInfo.userID = Friends.userID WHERE Friends.friendID = (SELECT userID FROM userInfo WHERE userInfo.username = :username);");
                            $stmt->bindParam(':username', $username);
                            $stmt->execute();
                            while ($row = $stmt->fetch()) {
                                $Friends[$j] = $row['username'];
                                $j++;
                            }
                            $conn = null;
                        } catch (PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }
                ?>
                <?php
                    if (count($Friends) > 0)
                    {
                ?>
                <table style="width: 100%">
                    <?php
                        for ($i = 0; $i < count($Friends); $i++) {
                            echo "<tr><td><a class='btn btn-outline-dark' style='width: 100%' onclick='var friendName = \"$Friends[$i]\"; chatBox(friendName);'>".$Friends[$i]."</a></td></tr>";
                        }
                    ?>
                </table>
                <?php
                    }
                ?>
            </div>
        </div>
    <script>
        if (window.location.hash == "#video") {
            document.getElementById("switchTab").src = "video_tab.php";
            currentTab = "video_tab.php";
        }
        if (window.location.hash == "#music") {
            document.getElementById("switchTab").src = "music_tab.php";
            currentTab = "music_tab.php";
        }
        window.onscroll = function () {
            var position = window.scrollY + window.innerHeight;
            var maxHeight = window.document.body.scrollHeight - 20;
            if (position >= maxHeight) {
                LoadMore();
            }
        };
        if (window.location.href.includes("searchText")){
            document.getElementById("switchTab").src = "search.php";
            currentTab = "search.php";
        }
    </script>

    </div>
</body>
<script> Normalize(); </script>
</html>