<!DOCTYPE html>
<html>
    <head>
        <title>Friends Forever</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-block.js" type="text/javascript"></script>
        <script src="js/script-global-constants.js" type="text/javascript"></script>
        <script src="js/callbacks.js" type="text/javascript"></script>
        <script src="js/common-funcs.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Friends Forever</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li type="button" class="btn modal-btn" data-toggle="modal" data-target="#ffRegistrationForm">Register</li>
                        <li type="button" class="btn modal-btn" data-toggle="modal" data-target="#ffLoginForm">Login</li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div><img src="img/friendsforeverbg2.jpg" id="ffbg"></img></div>
            <div id="ffRegistrationForm" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Registration</h4>
                        </div>
                        <div class="modal-body">
                            <div id="ffregForm">
                                <form id="ffregMnFrm" class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="ffusername">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="ffusername" placeholder="Enter username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="ffpwd">Password</label>
                                        <div class="col-sm-8"> 
                                            <input type="password" class="form-control" id="ffpwd" placeholder="Enter password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="ffrpwd">Retype password</label>
                                        <div class="col-sm-8"> 
                                            <input type="password" class="form-control" id="ffrpwd" placeholder="Retype password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="ffemail">Email</label>
                                        <div class="col-sm-8"> 
                                            <input type="email" class="form-control" id="ffemail" placeholder="Enter valid email">
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="button" class="btn btn-success" id="ffRegBtnClk">Register</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="ffRegErr"class="forms-errors"></div>
                            <div id="ffRegSuc"class="forms-success"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ffLoginForm" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Login</h4>
                        </div>
                        <div class="modal-body">
                            <div id="ffLogForm">
                                <form id="fflogMnFrm" class="form-horizontal" role="form">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="fflusername">Username</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="fflusername" placeholder="Enter your username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="fflpwd">Password</label>
                                        <div class="col-sm-10"> 
                                            <input type="password" class="form-control" id="fflpwd" placeholder="Enter password">
                                        </div>
                                    </div>
                                    <div class="form-group"> 
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="button" class="btn btn-success" id="ffLogBtnClk">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="ffLogErr"class="forms-errors"></div>
                            <div id="ffLogSuccess"class="forms-success"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

