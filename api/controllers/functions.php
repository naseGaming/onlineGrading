<?php
require_once("../config.php");

function login($username, $password, $connection) {
    $sql = "SELECT * FROM accounts WHERE username = ? ";
    $params = ["s", $username];
    
    $row = SelectExecuteStatement($connection, $sql, $params);

    while($row) {
		if (password_verify($password, $row["password"])){

            $_SESSION["userID"] = $row["id"];
            $_SESSION["userName"] = $row["username"];
            $_SESSION["userRole"] = $row["accountType"];

			return array(
                "type" => "success",
                "role" => $row["accountType"]
            );
		}

        return array(
            "type" => "error",
            "message" => "Wrong password. Try again or click Forgot password to reset it."
        );
    }
    
    return array(
        "type" => "error",
        "message" => "Account does not exist. Try again or signup an account!"
    );
}