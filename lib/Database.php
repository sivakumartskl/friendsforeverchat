<?php

require '../config.php';

class DBConnection {
    
    private $connection;

    public function __construct() {
        $this->connection = new PDO("mysql:host=".SERVER.";dbname=".DATABASE."", USERNAME, PASSWORD);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    
    public function fetchResults ($selQuery, $selParams) {
        $stmt = $this->connection->prepare($selQuery);
        foreach($selParams as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function storeResultsWithRtrnVal ($insertQuery, $insertParams) {
        $stmt = $this->connection->prepare($insertQuery);
        foreach($insertParams as $key => $value) {
            $stmt->bindValue($key, $value);
        }
        $stmt->execute();
        return $stmt->rowCount();
    }

}
