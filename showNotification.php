<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userID = $_COOKIE["userID"];
    try {
        $conn = new PDO("sqlsrv:Server=VRS-LAPTOP;Database=WebDev", "sa", "nguyentritue");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM FriendRequest WHERE receiverID = '$userID';");
        $stmt->execute();
        // Output data of each row
        while ($row = $stmt->fetch()) {
            echo "Request ID: " . $row["requestID"] . " - Sender ID: " . $row["senderID"] . " - Receiver ID: " . $row["receiverID"] . " - Request Date: " . $row["requestDate"] . " - Status: " . $row["status"] . "<br>";
        }
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p><?php echo $output; ?></p>
        </div>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("notification");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</body>

</html>