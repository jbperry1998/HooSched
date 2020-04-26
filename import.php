<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ( isset($_POST["submit"]) ) {

    if ( isset($_FILES["fileToUpload"])) {
 
             //if there was an error uploading the file
         if ($_FILES["fileToUpload"]["error"] > 0) {
             echo "Return Code: " . $_FILES["fileToUpload"]["error"] . "<br />";
 
         }
         else {
                  //if file already exists
              if (file_exists("upload/" . $_FILES["fileToUpload"]["name"])) {
             echo $_FILES["file"]["name"] . " already exists. ";
              }
              else {
                // Check file size
                if ($_FILES["fileToUpload"]["size"] > 500000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                else{
                    // Allow certain file formats
                    if($imageFileType != "csv") {
                        echo "Sorry, only csv files are allowed.";
                        $uploadOk = 0;
                    }
                    else{
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "Sorry, your file was not uploaded.";
                        // if everything is ok, try to upload file
                        } 
                        else{
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                            } 
                            else {
                                echo "Sorry, there was an error uploading your file.";
                            }
                        }
                    }
                }
            }
        } 
    }
}

session_start();
		$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
		port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
		");
		$login_status = $_SESSION['logged_in'];
		if (! strcmp($login_status, "logged_in") == 0) {
			header('Location: elements.html');
		}


?>