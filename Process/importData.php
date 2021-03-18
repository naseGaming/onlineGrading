<?php
	$database = mysqli_connect("localhost","root","","onlinegrading");
	if(!$database){
		echo "Failed connecting to the database";
	}
if(isset($_POST['saveImport'])){
    echo "Please wait while the data is analyzing....<br/>";
   $file = $_FILES['file']['tmp_name'];
    $handle = fopen($file, "r");
    $i=0;
    while(($filesop = fgetcsv($handle, 1000, ",")) !== false) {

        if(!isset($filesop[1])){
            echo "Error while uploading! <br/> Your file is not suppoerted";
            exit();
        }
        if($i > 0){
            $insertData = Array(
                "accountType" => $filesop[0],
                "username" => $filesop[1],
                "first" => $filesop[2],
                "middle" => $filesop[3],
                "last" => $filesop[4],
                "year" => $filesop[5],
                "section" => $filesop[6]
            );

            $id = $database->insert ('tbl_students', $insertData);
            if($id){
                echo "$i.) Inserted Learner Number : ".$filesop[0]."<br/>";
            }else{
                echo "Error while inserting Learner Number: ".$filesop[0]."<br/>";
            }
        }

        $i++;
    }

}