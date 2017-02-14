$(document).ready(function () {

    var objHCommonFuncs = new commonFuncs();

    var getOnlineUsers = function () {
        var data = {
            method: 'showOnlineUsers',
            data: {
                loggedInuser: $('#loggedInUserId').val()
            }
        };
        objHCommonFuncs.makeRequestWithoutUIBlock(data, onlineUsersResponseHandler);
    };

    var newMessages = function () {
        var data = {
            method: 'getNewMessages',
            data: {
                'getNewMsgs': ""
            }
        };
        objHCommonFuncs.makeRequestWithoutUIBlock(data, storeShowResponseHandler);
    };

    getOnlineUsers();
//    setInterval(getOnlineUsers, 45000);
    newMessages();
    $(function getChatMessages() {
        setTimeout(function () {
            $.ajax({
                url: websiteAddress + "api/messageapi.php",
                method: "POST",
                dataType: "json",
                data: {lastId : $('.msgOwner').last().data('msgid')},
                success: function (data) {
                    storeShowResponseHandler(data);
                },
                complete: function () {
                    getChatMessages();
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        }, 3000);
    });

    $('#ffLogout').click(function (e) {
        e.preventDefault();
        var data = {
            method: 'doUserLogout',
            data: {
                logout: 1
            }
        };
        var message = "Please be patient, we are logging you out.";
        objHCommonFuncs.makeRequest(data, message, logoutResponseHandler);
    });

    $('#msgBx').keypress(function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            strAGetMsgs();
        }
    });

    $('#ffSndMsg').click(function () {
        strAGetMsgs();
    });

    function strAGetMsgs() {
        if ($('#msgBx').val() !== "" && $('#msgBx').val() !== null) {
            var data = {
                method: 'storeAndGetNewMsgs',
                data: {
                    userid: $('#loggedInUserId').val(),
                    ffmessage: $('#msgBx').val()
                }
            };
            $('#msgBx').val("");
            objHCommonFuncs.makeRequestWithoutUIBlock(data, someMethod);
        } else {
            $('#msgBx').focus();
        }
    }

    $('#ffMessages').bind('mouseover', function () {
        scrollToDown = false;
    }).bind('mouseleave', function () {
        scrollToDown = true;
    });

    $('#onlineUsers').on('click', '.userDv', function () {
        $('#chatName').text($(this).find('.oUsrNme').text());
    });

});


