function personalPost() {
    document.getElementById("userContent").src = "personalPost.php";
}

function personalInformation() {
    document.getElementById("userContent").src = "personalInformation.php";
}

function friendLists() {
    document.getElementById("userContent").src = "listFriend.php";
}

function personalPictures() {
    document.getElementById("userContent").src = "personalPictures.php";
}

function personalVideos() {
    document.getElementById("userContent").src = "personalVideos.php";
}

function personalMusic() {
    document.getElementById("userContent").src = "personalMusic.php";
}

function Normalize() {
    var topDistance = document.getElementById("nav-top").clientHeight;
    var wallpaperHeight = window.innerHeight / 2;
    var avatarHeight = document.getElementById("avatar").clientHeight;
    var contentPosition = document.getElementById("avatar").clientHeight + wallpaperHeight;
    document.getElementsByClassName("wall")[0].style.marginTop = topDistance + "px";
    document.getElementsByClassName("user-info")[0].style.marginTop = wallpaperHeight - avatarHeight / 5 * 2 + "px";
    document.getElementsByClassName("user-info")[0].style.width = window.innerWidth / 1.7 + "px";
    document.getElementsByClassName("personalPost")[0].style.marginTop = contentPosition + "px";
}



function userDetail(friendID){
    var url = "userInfo.php?userID=" + friendID;
    console.log(url);
    window.parent.location.href = url;
}

function Infomation(){
    var url = window.location.href;
    var userID = url.split("?")[1].split("=")[1];
    console.log(userID);
}

function AddFriend(){
    // var userID = window.location.href;
    // userID = userID.substring(userID.indexOf("userID=") + 7);
    // $.ajax({
    //     url: "addFriend.php",
    //     type: "POST",
    //     data: {userID: userID},
    //     success: function(data){
    //         if(data == "success"){
    //             alert("Friend request sent");
    //         } else {
    //             alert("Friend request failed");
    //         }
    //     }
    // });
}

function sendFriendRequest(userID, friendID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText){
                alert("Friend request sent");
                console.log(this.responseText);
            }
        }
        
    };
    xhttp.open("POST", "addFriend.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userID=" + userID + "&friendID=" + friendID);
}
