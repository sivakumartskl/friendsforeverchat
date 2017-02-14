<?php
set_time_limit(0);
require '../classes/ChatClass.php';
class MessagesClass {
    
    private $objDB;
    
    public function __construct() {
        $this->objDB = new DBConnection();
        $this->request();
    }
    
    private function request() {
        if(isset($_REQUEST) ) {
            $this->makeResponse($_REQUEST);
        }
    }
    
    private function makeResponse($data) {
        try {
            $lastId = $data['lastId'];
            while(true) {
                $getMsgsQuery = "SELECT ffusers.ffusername, ffchatmessages.msg_id, ffchatmessages.ffmessageby, ffchatmessages.ffmessage, ADDTIME(ffchatmessages.ffmsgdate, '09:30') as ffmsgdate FROM ffusers JOIN ffchatmessages ON ffusers.user_id = ffchatmessages.ffmessageby WHERE ffchatmessages.msg_id > :lastid ORDER BY ffchatmessages.ffmsgdate";
                $getMsgsParams = array(':lastid' => $lastId);
                $getMsgsResult = $this->objDB->fetchResults($getMsgsQuery, $getMsgsParams);
                if(count($getMsgsResult) !== 0) {
                    $objChatClass = new ChatClass();
                    $data = $objChatClass->getNewMessages($data);
                    $result = array('resData' => $data);
                    echo json_encode($result);
                    die();
                } else {
                    sleep(20);
                    continue;
                }
            }
        } Catch (Exception $ex) {
            
        }
    }

}

new MessagesClass();

