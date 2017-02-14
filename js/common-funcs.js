function commonFuncs() {
    var url = websiteAddress+"api/api.php";

    this.makeRequest = function (data, blockMsg, responseHandler) {
        $.blockUI({message: '<h1>' + blockMsg + '</h1>'});
        $.ajax({
            url: url,
            method: "POST",
            timeout: 20000,
            dataType: "json",
            data: data,
            success: function (data) {
                responseHandler(data);
            },
            complete: function () {
                $.unblockUI();
            },
            error: function () {

            }
        });
    };

    this.makeRequestWithoutUIBlock = function (data, responseHandler) {
        $.ajax({
            url: url,
            method: "POST",
            timeout: 20000,
            dataType: "json",
            data: data,
            success: function (data) {
                responseHandler(data);
            },
            error: function () {

            }
        });
    };
}








