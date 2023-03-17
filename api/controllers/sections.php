<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    $key = array_keys($_GET);

    if(isset($_GET["year"])) {
        $sql = "SELECT sectionID, section FROM sections WHERE year = ?";
        $params = ["s", $_GET["year"]];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $sections = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
    
            $sections[$count] = array (
                "id" => $row["sectionID"],
                "section" => $row["section"]
            );
    
            $count++;
        }

        $result = array(
            "type" => "success",
            "content" => $sections
        );

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
    error("Method not supported", "HTTP/1.1 405 Method Not Allowed");
}