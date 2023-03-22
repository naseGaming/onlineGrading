<?php
require_once("../config.php");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if(strtoupper($requestMethod) == get) {
    //SERVER SIDE GET METHOD FOR ACCOUNTS TO BE DISPLAYED IN A TABLE
    if(isset($_GET["page"])) {
        $page = $_GET["page"];

        $page--;
        $page *= 10;

        $sql = "SELECT id, accountType, record_id, username FROM accounts WHERE is_deleted = ? ORDER BY accountType Limit $page, 10";
        $params = ["i", 0];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $account = array();
    
        $count = 0;
        $flag = false;
    
        while($row = $result -> fetch_assoc()) {
            $flag = true;
            $name = "";

            if($row["accountType"] == 0) {
                $sql = "SELECT first_name, last_name FROM employee WHERE is_deleted = ? and id = ? Limit $page, 10";
                $params = ["ii", 0, $row["record_id"]];
        
                $employee = SelectExecuteStatement($con, $sql, $params);

                $employee_details = $employee -> fetch_assoc();

                $name = $employee_details["first_name"] . " " . $employee_details["last_name"];
            }

            if($row["accountType"] == 1) {
                $sql = "SELECT first_name, last_name FROM teachers WHERE is_deleted = ? and id = ? Limit $page, 10";
                $params = ["ii", 0, $row["record_id"]];
        
                $teacher = SelectExecuteStatement($con, $sql, $params);

                $teacher_details = $teacher -> fetch_assoc();

                $name = $teacher_details["first_name"] . " " . $teacher_details["last_name"];
            }

            if($row["accountType"] == 2) {
                $sql = "SELECT first_name, last_name FROM students WHERE is_deleted = ? and id = ? Limit $page, 10";
                $params = ["ii", 0, $row["record_id"]];
        
                $student = SelectExecuteStatement($con, $sql, $params);

                $student_details = $student -> fetch_assoc();

                $name = $student_details["first_name"] . " " . $student_details["last_name"];
            }

            $accountType = "Student";

            if($row["accountType"] == 0) {
                $accountType = "Employee";
            }
            if($row["accountType"] == 1) {
                $accountType = "Teacher";
            }
    
            $account[$count] = array (
                "id" => $row["id"],
                "account_type" => $accountType,
                "name" => $name,
                "username" => $row["username"]
            );
    
            $count++;
        }
        
        $sql = "SELECT COUNT(sectionID) AS max_count FROM sections WHERE is_deleted = ?";
        $params = ["i", 0];
        
        $result = SelectExecuteStatement($con, $sql, $params);
        $length = 0;

        while($row = $result -> fetch_assoc()) {
            $length = $row["max_count"];
        }
    
        if($flag) {
            $result = array(
                "type" => "success",
                "length" => $length,
                "content" => $account
            );
        }
        else {
            $result = array(
                "type" => "empty",
                "length" => 3,
                "message" => "No section to display!"
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
    error("Method not supported", "HTTP/1.1 405 Method Not Allowed");
}