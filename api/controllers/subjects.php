<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    $data = $_GET["type"];

    //GET SUBJECTS
    if($data == "viewSubjects") {
        $sql = "SELECT s.subjID, s.subjcode, s.subjdesc, s.year, s.teacher, a.username, a.first, a.last FROM subjects s LEFT JOIN accounts a on s.teacher = a.username ORDER BY s.subjID Limit 1, 5";
        
        $result = SelectExecuteStatement($con, $sql, []);
        $subject = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $subject[$count] = array (
                "id" => $row["subjID"],
                "code" => $row["subjcode"],
                "description" => $row["subjdesc"],
                "year" => $row["year"],
                "teacher" => $row["first"] . " " . $row["last"],
            );
    
            $count++;
        }
    
        if($flag) {
            $result = array(
                "type" => "success",
                "content" => $subject
            );
        }
        else {
            $result = array(
                "type" => "error",
                "message" => "No subject to display!"
            );
        }

        output(json_encode($result), "HTTP/1.1 200 OK");
    }

    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == post) {
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == put) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else if(strtoupper($requestMethod) == delete) {
    
    error("Page not found", "HTTP/1.1 404 Not Found");
}

else {
    error("Method not supported", "HTTP/1.1 422 Unprocessable Entity");
}