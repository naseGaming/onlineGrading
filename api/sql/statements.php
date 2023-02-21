<?php

function SelectExecuteStatement($connection, $sql, $params = []) {
    $stmt = $connection->prepare($sql);

    if(!$stmt) {
        error("Bad Request", "HTTP/1.1 400 Bad Request");
    }

    for($i = 0; $i < count($params); $i += 2) {
        $stmt->bind_param($params[$i], $params[$i + 1]);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_assoc();
}