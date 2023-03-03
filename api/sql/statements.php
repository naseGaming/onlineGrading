<?php

function SelectExecuteStatement($connection, $sql, $params = []) {
    $stmt = $connection->prepare($sql);
    
    if(!$stmt) {
        error("Bad Request", "HTTP/1.1 500 Internal Server Error");
    }
    
    if(count($params) > 0) {
        for($i = 0; $i < count($params); $i += 2) {
            $stmt->bind_param($params[$i], $params[$i + 1]);
        }
    }

    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result;
}