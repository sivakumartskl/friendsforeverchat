var scrollToDown = true;

function regResponseHandler(data) {
    if (data.resData.regStatus) {
        $('#ffRegErr').html("");
        $('#ffRegSuc').html(data.resData.regMessage);
    } else {
        $('#ffRegSuc').html("");
        $('#ffRegErr').html(data.resData.regMessage);
    }
}

function logResponseHandler(data) {
    if (data.resData.logStatus) {
        $('#ffLogErr').html("");
        $('#ffLogSuccess').html(data.resData.logMessage);
        window.location.href = websiteAddress + "home.php";
    } else {
        $('#ffLogSuccess').html("");
        $('#ffLogErr').html(data.resData.logMessage);
    }
}

function onlineUsersResponseHandler(data) {
    if (data.resData.onlineUsers) {
        var divToConstruct = "";
        for (var i = 0; i < data.resData.users.length; i++) {
            divToConstruct += "<div class='userDv' title='Click to chat...'><div class='oUsrNme'>" + data.resData.users[i].ffusername + "</div><div class='oSymG'></div></div>";
        }
        $('#onlineUsers').empty();
        $('#onlineUsers').append(divToConstruct);
    } else {
        $('#onlineUsers').empty();
        $('#onlineUsers').html("No online users...");
    }
}

function storeShowResponseHandler(data) {
    if(data.resData.length) {
        var messagesDvToCons = "";
        for(var i =0; i < data.resData.length; i++) {
            if($('#loggedInUserId').val() === data.resData[i].ffmessageby) {
                messagesDvToCons += "<div class='showingDvR'><div class='msgOwner' data-msgId='"+data.resData[i].msg_id+"'>"+data.resData[i].ffusername+"</div>-&nbsp<div class='msgDte'>"+$.timeago(data.resData[i].ffmsgdate)+"</div><div class='smDv'>"+data.resData[i].ffmessage+"</div></div><br>";
            } else {
                messagesDvToCons += "<div class='showingDvL'><div class='msgOwner' data-msgId='"+data.resData[i].msg_id+"'>"+data.resData[i].ffusername+"</div>-&nbsp<div class='msgDte'>"+$.timeago(data.resData[i].ffmsgdate)+"</div><div class='smDv'>"+data.resData[i].ffmessage+"</div></div><br>";
            }
        }
        $('#ffMessages').empty();
        $('#ffMessages').append(messagesDvToCons);
        scrollToDwn();
    } else {
        $('#ffMessages').append("There is no conversation is started yet...");
    }
}

function scrollToDwn() {
    if(scrollToDown) {
        $('#ffMessages').animate({scrollTop:$('#ffMessages')[0].scrollHeight}, 'slow');
        return false;
    }
}

function logoutResponseHandler(data) {
    if (data.resData.logoutStatus) {
        window.location.href = websiteAddress + "index.php";
    }
}

function someMethod(data) {}

function buildRegisteredUsersTable(data) {
    var tableData = data.resData;
    $('#regUsers').DataTable({
        data : tableData,
        columnDefs : [
            {
                data : 'user_id',
                targets : 0
            }, {
                data : 'ffusername',
                targets : 1
            }, {
                data : 'ffemail',
                targets : 2
            }, {
                data : 'user_role',
                targets : 3
            }, {
                render : function (data, type, row) {
                    return "----";
                }, 
                targets : 4
            }
        ]
    });
}


