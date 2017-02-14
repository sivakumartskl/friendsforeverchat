<?php
require '../lib/Database.php';

class ChatClass {
    
    private $objDB;
    private static $timeZoneStr = "UTC";
    
    public function __construct() {
        $this->objDB = new DBConnection();
    }
    
    public function storeUserRegistrationDtls($data) {
        date_default_timezone_set(ChatClass::$timeZoneStr);
        $username = $data['ffusername'];
        $password = $data['ffpassword'];
        $email = $data['ffemail'];
        $usernameSelQuery = "SELECT * FROM ffusers WHERE ffusername = :username";
        $usernameSelParams = array(
            ':username' => $username
        );
        $usernameResult = $this->objDB->fetchResults($usernameSelQuery, $usernameSelParams);
        if(count($usernameResult) != 0) {
            return array(
                'regStatus' => 0,
                'regMessage' => "Username is already in use."
            );
        } else {
            $emailSelQuery = "SELECT * FROM ffusers WHERE ffemail = :email";
            $emailSelParams = array(
                ':email' => $email
            );
            $emailResult = $this->objDB->fetchResults($emailSelQuery, $emailSelParams);
        }
        if(count($emailResult) != 0) {
            return array(
                'regStatus' => 0,
                'regMessage' => "Email address is already in use."
            );
        } else {
            $regInsertQuery = "INSERT INTO ffusers(ffusername, ffpassword, ffemail) VALUES(:username, :password, :email)";
            $regInsertDetails = array(
                ':username' => $username,
                ':password' => $password,
                ':email' => $email
            );
            $result = $this->objDB->storeResultsWithRtrnVal($regInsertQuery, $regInsertDetails);
            if($result) {
                return array(
                    'regStatus' => 1,
                    'regMessage' => "You have successfully registered with this website. Please close this dialog and click on login."
                );
            }
        }
    } 
    
    public function validateUserLoginDtls($data) {
        date_default_timezone_set(ChatClass::$timeZoneStr);
        $username = $data['username'];
        $password = $data['password'];
        $logSelQuery = "SELECT * FROM ffusers WHERE ffusername = :username AND ffpassword = :password";
        $logSelParams = array(
            ':username' => $username,
            ':password' => $password
        );
        $logResult = $this->objDB->fetchResults($logSelQuery, $logSelParams);
        if(count($logResult) != 0) {
            session_start();
            $_SESSION['loggedinuserid'] = $logResult[0]['user_id'];
            $_SESSION['ffloggedinuserrole'] = $logResult[0]['user_role'];
            $_SESSION['friendsforeverwebappuser'] = $username;
            $isUserAlreadyLoggedIn = "SELECT online_user_id FROM ffloggedinusers WHERE online_user_id = :onlineUsrId";
            $isUserAlreadyLoggedInPrms = array(
                ':onlineUsrId' => $_SESSION['loggedinuserid']
            );
            $isUserAlreadyLoggedInRes = $this->objDB->fetchResults($isUserAlreadyLoggedIn, $isUserAlreadyLoggedInPrms);
            if(count($isUserAlreadyLoggedInRes) == 0) {
                $loggedInInsertQuery = "INSERT INTO ffloggedinusers(online_user_id) VALUES(:onlineuserid)";
                $loggedInInsertParams = array(
                    ':onlineuserid' => $_SESSION['loggedinuserid']
                );
                $loggedInInsertResult = $this->objDB->storeResultsWithRtrnVal($loggedInInsertQuery, $loggedInInsertParams);
            }
            return array(
                'logStatus' => 1,
                'logMessage' => "Login success. please wait, we are redirecting you to home page."
            );
        } else {
            return array(
                'logStatus' => 0,
                'logMessage' => "Username or password incorrect, please enter valid credentials."
            );
        }
    }
    
    public function showOnlineUsers($data) {
        date_default_timezone_set(ChatClass::$timeZoneStr);
        $loggedInUser = $data['loggedInuser'];
        $getOnlineUsersSelQuery = "SELECT ffusername FROM ffusers JOIN ffloggedinusers ON ffusers.user_id = ffloggedinusers.online_user_id WHERE ffloggedinusers.online_user_id != :loggedinuser";
        $getOnlineUsersSelParams = array(
            ':loggedinuser' => $loggedInUser
        );
        $getOnlineUsersSelResult = $this->objDB->fetchResults($getOnlineUsersSelQuery, $getOnlineUsersSelParams);
        if(count($getOnlineUsersSelResult) != 0) {
            return array(
                'onlineUsers' => 1,
                'users' => $getOnlineUsersSelResult
            );
        } else {
            return array(
                'onlineUsers' => 0
            );
        }
    }
    
    public function storeAndGetNewMsgs($data) {
        date_default_timezone_set(ChatClass::$timeZoneStr);
        $userId = $data['userid'];
        $message = $data['ffmessage'];
        $msgInsertQuery = "INSERT INTO ffchatmessages(ffmessage, ffmessageby, ffmsgdate) VALUES(:msg, :msgby, NOW())";
        $msgInsertParams = array(
            ':msg' => $message,
            ':msgby' => $userId
        );
        $msgInsertResult = $this->objDB->storeResultsWithRtrnVal($msgInsertQuery, $msgInsertParams);
        if($msgInsertResult) {
            $this->getNewMessages($data);
        }
    }
    
    public function getNewMessages($data) {
        date_default_timezone_set(ChatClass::$timeZoneStr);
        $getMsgDtlsQuery = "SELECT ffusers.ffusername, ffchatmessages.msg_id, ffchatmessages.ffmessageby, ffchatmessages.ffmessage, ADDTIME(ffchatmessages.ffmsgdate, '09:30') as ffmsgdate FROM ffusers JOIN ffchatmessages ON ffusers.user_id = ffchatmessages.ffmessageby ORDER BY ffchatmessages.ffmsgdate";
        $getMsgDtlsParams = array();
        $getMsgDtlsResult = $this->objDB->fetchResults($getMsgDtlsQuery, $getMsgDtlsParams);
        return $getMsgDtlsResult;
    }
    
    public function doUserLogout($data) {
        session_start();
        $this->deleteLoggedInusers();
        session_destroy();
        return array(
            'logoutStatus' => 1
        );
    }
    
    public function deleteLoggedInusers() {
        $delOnlineUsersSelQuery = "DELETE FROM ffloggedinusers WHERE online_user_id = :loggedinuser";
        $delOnlineUsersSelParams = array(
            ':loggedinuser' => $_SESSION['loggedinuserid']
        );
        $delOnlineUsersSelResult = $this->objDB->storeResultsWithRtrnVal($delOnlineUsersSelQuery, $delOnlineUsersSelParams);
    }
    
    public function getAllRegisteredUsers($data) {
        $getRegisteredUsersSelQuery = "SELECT user_id, ffusername, ffemail, user_role FROM ffusers";
        $getRegisteredUsersSelParams = array();
        $getOnlineUsersSelResult = $this->objDB->fetchResults($getRegisteredUsersSelQuery, $getRegisteredUsersSelParams);
        return $getOnlineUsersSelResult;
    }
    
}

