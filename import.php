<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
<title>Settings - HooSched</title>
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/css/main.css" />
</head>
<script>
	var FormStuff = {
  
  init: function() {
    this.applyConditionalRequired();
    this.bindUIActions();
  },
  
  bindUIActions: function() {
    $("input[type='radio'], input[type='checkbox']").on("change", this.applyConditionalRequired);
  },
  
  applyConditionalRequired: function() {
    
    $(".require-if-active").each(function() {
      var el = $(this);
      if ($(el.data("require-pair")).is(":checked")) {
        el.prop("required", true);
      } else {
        el.prop("required", false);
      }
    });
    
  }
  
};

FormStuff.init();
</script>

<style>
.reveal-if-active {
	 opacity: 0;
	 max-height: 0;
	 overflow: hidden;
	 font-size: 16px;
	 transform: scale(0.8);
	 transition: 0.5s;
}
 .reveal-if-active label {
	 display: block;
	 margin: 0 0 3px 0;
}
 .reveal-if-active input[type=text] {
	 width: 100%;
}
 input[type="radio"]:checked ~ .reveal-if-active, input[type="checkbox"]:checked ~ .reveal-if-active {
	 opacity: 1;
	 max-height: 100px;
	 padding: 10px 20px;
	 transform: scale(1);
	 overflow: visible;
}
 form {
	 max-width: 500px;
	 margin: 20px auto;
}
 form > div {
	 margin: 0 0 20px 0;
}
 form > div label {
	 font-weight: bold;
}
 form > div > div {
	 padding: 5px;
}
 form > h4 {
	 color: green;
	 font-size: 24px;
	 margin: 0 0 10px 0;
	 border-bottom: 2px solid green;
}
 body {
	 font-size: 20px;
}
 * {
	 box-sizing: border-box;
}
</style>
<body class="is-preload">
	<div id="page-wrapper">

		<!-- Header -->
		<header id="header">
			<nav id="nav">
				<ul>
					<li><a href="rescalendar.html" style="font-size: 16px;">Back to Calendar</a></li>
					<li><a href="logout.php" style="font-size: 16px;">Log Out</a></li>
				</ul>
			</nav>
		</header>
		<section id="main" class="container medium">
			<header>
				<h2>Import</h2>
			</header>

<?php
session_start();
$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
		port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
		");
		$login_status = $_SESSION['logged_in'];
		if (! strcmp($login_status, "logged_in") == 0) {
			header('Location: elements.html');
		}

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
                    if($fileType != "csv") {
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

                                $handle = fopen($_FILES['fileToUpload']['name'], "r");
                                while($data = fgetcsv($handle)){
                                    print($data);
                                    $class_ID = data[0];
                                    $className = data[1];
                                    $location = data[2];
                                    $start_time = date('Y-m-d H:i:s', strtotime(data[3]));
                                    $end_time = date('Y-m-d H:i:s', strtotime(data[4]));
                                    $days = data[5];
                                    $teacher = data[6];
                                    $start_date = date('Y-m-d', strtotime(data[7]));
                                    $end_date = date('Y-m-d', strtotime(data[8]));
                                    $query = "INSERT INTO class VALUES('$class_ID', '$className', '$location', '$start_time', '$end_time', '$days', '$teacher', '$start_date', '$end_date')";
    	                            $result_1 = pg_query($db_connection,$query);
                                }
                                fclose($handle);
                                print("Import Successful");
                            
                        } 
                    }
                }
            }
        }
    } 
}
?>
		<!-- Footer -->
		<footer id="footer">
			<ul class="icons">
				<li><a href="#" class="icon brands fa-twitter"><span
						class="label">Twitter</span></a></li>
				<li><a href="#" class="icon brands fa-facebook-f"><span
						class="label">Facebook</span></a></li>
				<li><a href="#" class="icon brands fa-instagram"><span
						class="label">Instagram</span></a></li>
				<li><a href="#" class="icon brands fa-github"><span
						class="label">Github</span></a></li>
				<li><a href="#" class="icon brands fa-dribbble"><span
						class="label">Dribbble</span></a></li>
				<li><a href="#" class="icon brands fa-google-plus"><span
						class="label">Google+</span></a></li>
			</ul>
			<ul class="copyright">
				<li>&copy; HooSched. All rights reserved.</li>
				<li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
			</ul>
		</footer>

	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.dropotron.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>