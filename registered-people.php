<!DOCTYPE html>
<html>
    <head>
        <title>Friends Forever</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-2.1.4.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/datatables.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-block.js" type="text/javascript"></script>
        <script src="js/timeago.js" type="text/javascript"></script>
        <script src="js/script-global-constants.js" type="text/javascript"></script>
        <script src="js/callbacks.js" type="text/javascript"></script>
        <script src="js/common-funcs.js" type="text/javascript"></script>
        <script src="js/registered-people-script.js" type="text/javascript"></script>
    </head>
    <body>
        <?php 
            session_start();
            require_once 'config.php';
            if(isset($_SESSION['friendsforeverwebappuser']) && $_SESSION['ffloggedinuserrole'] === "1") {
                ?>
                    <nav class="navbar navbar-default navbar-fixed-top">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="home.php">Friends Forever</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['friendsforeverwebappuser']; ?><span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" id="ffPrfle">Profile</a></li>
                                            <li><a href="registered-people.php">Registered Users</a></li>
                                            <li><a href="logged-in-people.php">Logged in Users</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="" id="ffLogout">Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 reg-users">
                                <table id="regUsers" class="table table-striped table-responsive">
                                    <thead>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>Email </th>
                                        <th>Role</th>
                                        <th></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
            } else {
                header('Location: index.php');
                die();
            }
        ?>
    </body>
</html>