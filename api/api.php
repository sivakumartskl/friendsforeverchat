<?php
require_once __DIR__ . '/../classes/ChatClass.php';
class ApiClass {
    
    private static $chatClassMehods;
    
    public function __construct() {
        $this->request();
    }
    
    private function request() {
        if(isset($_REQUEST) ) {
            $this->makeResponse($_REQUEST);
        }
    }
    
    private function makeResponse($data) {
        $this->makeMehodsArray();
        if(in_array($data['method'], ApiClass::$chatClassMehods)) {
            $objChatClass = new ChatClass();
            $result = $objChatClass->$data['method']($data['data']);
        } else {
            $this->returnMethodError();
        }
        $this->returnResponse($result);
    }

    private function makeMehodsArray() {
        ApiClass::$chatClassMehods = get_class_methods('ChatClass');
    }
    
    private function returnResponse($result) {
        echo json_encode(array('resData' => $result));
        die();
    }
    
    private function returnMethodError() {
        echo json_encode(array('requestedMethodExist' => false));
        die();
    }

}

new ApiClass();

