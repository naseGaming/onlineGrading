<?php
require_once("../config.php");

if(isset($_SESSION["userName"])) {
    if($_SESSION["userRole"] === 0) {
        $sql = "SELECT schoolYear FROM `studentlist` order by `schoolYear` asc";

        $result = SelectExecuteStatement($con, $sql, []);
        
        while($row=mysqli_fetch_array($result)){
            $year = $row['schoolYear'];
        }
        
        $years = $year+1;
        
        $filename = "SchoolYear".$year."-".$years.".csv";
        header('Content-Type:text/csv');
        header("Content-Disposition: attachment; filename=$filename");
        $data = array();
        $data[] = array("Student Number","First Name","Middle Name","Last Name","Year","Section");
        
        $fp = fopen('php://output','w');
        foreach($data as $line){
            fputcsv($fp,$line);
        }
        fclose($fp);
    }
    else {
        header("location: ../redirect.php?code=403&message=Not Allowed");
    }
}
else {
    header("location: ../redirect.php?code=403&message=Not Allowed");
}