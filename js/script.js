$(document).ready(function () {

    var passwordsMatch = false;
    var validEmail = false;
    var objCommonFuncs = new commonFuncs();

    function validateEmail(email) {
        var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var valid = emailReg.test(email);
        if (!valid) {
            return false;
        } else {
            return true;
        }
    }
    
    $('#fflpwd').keydown(function (e) {
        if(e.keyCode == 13) {
            $('#ffLogBtnClk').trigger('click');
        }
    });
    
    $('#ffemail').keydown(function (e) {
        if(e.keyCode == 13) {
            $('#ffRegBtnClk').trigger('click');
        }
    });

    $('#ffRegBtnClk').click(function () {
        var ffusername = $('#ffusername').val();
        var ffpassword = $('#ffpwd').val();
        var ffrpassword = $('#ffrpwd').val();
        var ffemail = $('#ffemail').val();
        if (ffusername == "" || ffpassword == "" || ffrpassword == "" || ffemail == "") {
            $('#ffRegErr').html("Please fill all fields.");
        }
        if (ffpassword != ffrpassword) {
            $('#ffRegErr').html("Passwords doesn't match, Please type passwords again.");
        } else {
            passwordsMatch = true;
        }
        if (passwordsMatch && ffemail != "") {
            validEmail = validateEmail(ffemail);
            if (validEmail) {
                $('#ffRegErr').html("");
                var data = {
                    method: 'storeUserRegistrationDtls',
                    data: {
                        ffusername: ffusername,
                        ffpassword: ffpassword,
                        ffemail: ffemail
                    }
                };
                var message = "Please be patient, we are joining you in this website...";
                objCommonFuncs.makeRequest(data, message, regResponseHandler);
            } else {
                $('#ffRegErr').html("Entered email address is invalid, please check once.");
            }
        }
    });

    $('#ffLogBtnClk').click(function () {
        var username = $('#fflusername').val();
        var password = $('#fflpwd').val();
        if (username == "" || password == "") {
            $('#ffLogErr').html("Please fill all fields.");
        } else {
            var data = {
                method: 'validateUserLoginDtls',
                data: {
                    username: username,
                    password: password
                }
            }
            var message = "Please be patient, we are validating your login details...";
            objCommonFuncs.makeRequest(data, message, logResponseHandler);
        }
    });

});


