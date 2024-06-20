let currentTab = "post_tab.php";
let boxchat = document.createElement("div");

function postTab() {
    document.getElementById("content").innerHTML = "<form action=\"submitPost.php\" method=\"post\" style=\"margin-top: 5%\">"
        + "<div class=\"mb-3\">"
        + "<label for=\"comment\" class=\"form-label\"></label>"
        + "<textarea class=\"form-control\" id=\"user_post\" name=\"postContent\" rows=\"3\" placeholder=\"How do you feel now?\"></textarea>"
        + "</div>"
        + "<button type=\"submit\" class=\"btn btn-primary\">Post</button>"
        + "</form>";
    document.getElementById("content").innerHTML += "<iframe src=\"post_tab.php\" id=\"switchTab\" width=\"100%\" onload=\"resizeIframe(this)\" scrolling=\"no\" style=\"border: none\"></iframe>";
    //document.getElementById("switchTab").src = "post_tab.php";
    currentTab = "post_tab.php";
}
function videoTab() {
    document.getElementById("content").innerHTML = "<iframe src=\"video_tab.php\" id=\"switchTab\" width=\"100%\" onload=\"resizeIframe(this)\" scrolling=\"no\" style=\"border: none\"></iframe>";
    //document.getElementById("switchTab").src = "video_tab.php";
    currentTab = "video_tab.php";
}
function musicTab() {
    document.getElementById("content").innerHTML = "<iframe src=\"music_tab.php\" id=\"switchTab\" width=\"100%\" onload=\"resizeIframe(this)\" scrolling=\"no\" style=\"border: none\"></iframe>";
    //document.getElementById("switchTab").src = "music_tab.php";
    currentTab = "music_tab.php";
}

function Resize() {
    if (document.getElementById("music-frame").clientHeight === 160) {
        document.getElementById("music-frame").style.height = "80px";
    } else {
        document.getElementById("music-frame").style.height = "160px";
    }

    var PanelHeight = document.getElementById("music-chat").clientHeight;
    var musicHeight = document.getElementById("music-frame").clientHeight;
    document.getElementById("chat-frame").style.height = PanelHeight - musicHeight + "px";
}

function closeIframe() {
    if (boxchat != null) {
        boxchat.remove();
    }
}

function chatBox(Friend, FriendID) {
    boxchat.id = "chat-box";
    boxchat.style.width = "300px";
    boxchat.style.height = "400px";
    boxchat.style.backgroundColor = "#ddd";
    boxchat.style.border = "1px solid black";
    boxchat.style.borderRadius = "10px";
    boxchat.style.position = "fixed";
    boxchat.style.bottom = "0";
    boxchat.style.right = "20px";
    boxchat.style.zIndex = "1000";
    ChatFrame(Friend);

    document.body.appendChild(boxchat);
}

function ChatFrame(Friend, FriendID) {
    boxchat.innerHTML = `<link rel=\"stylesheet\" href=\"css/boxchat.css\">`;

    boxchat.innerHTML += `<table class="chat-box">
                            <th id=\"chatHeader\">` + Friend + `<button id=\"close\" onclick = \"closeIframe();\">x</button> </th>
                            <tr>
                                <td>
                                    <iframe id=\"chatBox\"></iframe>
                                </td>
                            </tr>
                            <tr id=\"chatForm\">
                                <td>
                                <form id=\"messageForm\">
                                    <input type=\"textarea\" height=\"90%\" name=\"comment\" id=\"comment\" placeholder=\"Comment\">
                                    <button id=\"send\" type=\"submit\" onclick=\"ChatHandler(\"FriendID\");\" class=\"btn btn-primary\">Send</button>
                                </form>
                                </td>
                            </tr>
                        </table>`;
}

function loginHandler() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var url = "login.php?username=" + username + "&password=" + password;
    window.parent.location.href = url;
    console.log(username + " " + password);

}

function ChatHandler(friendID) {
    var messageSent;
    var messageReceived;
    var chatBox = document.getElementById('chatBox');
    document.getElementById('messageForm').addEventListener('submit', function (event) {
        event.preventDefault();

        messageSent = document.getElementById('comment').value;
        document.cookie = "messageSent = " + messageSent;

        // Send the message
        chatBox.contentWindow.postMessage(messageSent, '*');
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "sendMessage.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("message=" + messageSent + "&userID=" + userID + "&friendID=" + friendID);

        // Display the sent message in the chat box
        var p = document.createElement('p');
        p.textContent = 'Sent: ' + messageSent;
        chatBox.contentDocument.body.appendChild(p);

        // Clear the input field
        document.getElementById('comment').value = '';

    });

    window.addEventListener('message', function (event) {
        // Receive the message
        messageReceived = event.data;
        document.cookie = "messageReceived = " + messageReceived;

        // Display the received message in the chat box
        var p = document.createElement('p');
        p.textContent = 'Received: ' + messageReceived;
        chatBox.contentDocument.body.appendChild(p);
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var data = this.responseText;
                if (data != "0") {
                    // Handle the received message
                    var p = document.createElement('p');
                    p.textContent = 'Received: ' + data;
                    chatBox.contentDocument.body.appendChild(p);
                }
            }
        };
        xhttp.open("GET", "receiveMessage.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("userID=" + userID + "&friendID=" + friendID);
    });
}

function Normalize() {
    var navHeight = document.getElementsByClassName("navbar")[0].clientHeight;
    document.getElementsByClassName("nav-side")[0].style.top = navHeight + "px";
    document.getElementById("music-chat").style.top = navHeight + "px";
    document.getElementById("content").style.top = navHeight + "px";
    document.getElementById("switchTab").style.height = navHeight + "px";
}

function setCenter(obj) {
    var width = window.innerWidth;
    var height = window.innerHeight;
    var objWidth = obj.clientWidth;
    var objHeight = obj.clientHeight;
    obj.style.left = (width - objWidth) / 2 + "px";
    obj.style.top = (height - objHeight) / 2 + "px";

}

function LoadMore() {
    if (currentTab === "post_tab.php") {
        return;
    }
    var content = document.getElementById("content");
    var newContent = document.createElement("div");
    newContent.style.padding = "0";
    newContent.style.top = "0";
    newContent.innerHTML = "<iframe src=\"" + currentTab + "\" id=\"switchTab\" width=\"100%\" onload=\"resizeIframe(this)\" scrolling=\"no\" style=\"border: none;\"> </iframe>";
    content.appendChild(newContent);
}

function userDetail(friendID) {
    var url = "userInfo.php?userID=" + friendID;
    window.parent.location.href = url;
}

function Search() {
    document.cookie = "searchText = " + document.getElementsByName("searchText")[0].value;
    document.getElementById("switchTab").src = "search.php";
    currentTab = "search.php";
}

function getSpotify() {
    var url = document.getElementById("spotifyUrl").value;
    var pos = url.indexOf(".com/");
    var spotify = url.slice(0, pos + 5) + "embed/" + url.slice(pos + 5) + "?utm_source=generator";
    document.getElementById("music-frame").src = spotify;
    //alert(document.getElementById("music-frame").src);
}

function showNotification() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var data = this.responseText;
            if (data != "0") {
                document.getElementById('notificationBox').innerHTML = data;
                //document.getElementById('notificationBox').style.display = "block";
            }
        }
    };
    xhttp.open("GET", "showNotification.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("userID=" + userID);
}