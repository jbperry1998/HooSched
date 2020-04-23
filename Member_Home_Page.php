<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
<<head>
		<title>HooSched</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<?php
		session_start();
		$login_status = $_SESSION['logged_in'];
		if (! strcmp($login_status, "logged_in") == 0) {
			header('Location: elements.html');
		}
		//$email = unserialize($_SESSION['email']);
		// $username = $_SESSION['username'];
		// $name = $_SESSION['name'];
		?>
</head>
<body class="is-preload">
	<div id="page-wrapper">

		<!-- Header -->
		<header id="header">
			<nav id="nav">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="generic.html">About Us</a></li>
					<li><a href="contact.html">Contact Us</a></li>
					<li><a href="product.html">Products</a></li>
					<li><a href="Member_Home_Page.php">Member Page</a></li>
					<li><a href="log_out.php" class="button">Log Out</a></li>
				</ul>
			</nav>
		</header>

		<!-- Banner -->

		<!-- Main -->
		<section id="main" class="container">
			<div class="row">
				<div class="col-12">

					<!-- Text -->
					<section class="box special">
						<header class="major">
							<h2>Results</h2>
							<p>
								<?php
        session_start();
        $username = $_SESSION['username'];
        echo "<table border='1'>
								<tr>
								<th>Username</th>
								</tr>";
        echo "<tr>";
        echo "<td>" . $username . "</td>";
        echo "</tr>";
		$db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
		port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
		");
		$valueToSearch = $_POST['valueToSearch'];
		$query="SELECT * FROM events";
		/*
		if(strcmp($valueToSearch, "Community") == 0) {
			$query = "SELECT * FROM events WHERE event_id LIKE 'c%' AND user_ID ='$username'";
		}
		else if(strcmp($valueToSearch, "Extracurricular") == 0) {
			$query = "SELECT * FROM events WHERE event_id LIKE 'e%' AND user_ID = '$username'";
		}
		else if(strcmp($valueToSearch, "Reminder") == 0) {
			$query = "SELECT * FROM events WHERE event_id LIKE 'r%' AND user_ID = '$username'";
		}
		*/
        $result = pg_query($db_connection, $query);
        echo "<table border='1'>
								<tr>
								<th>event_ID</th>
								<th>user_ID</th>
								<th>name</th>
								<th>date</th>
								<th>description</th>
								<th>frequency</th>
								<th>start_time</th>
								<th>end_time</th>

								</tr>";
        if (pg_num_rows($result) == 0) {
            $cb = "nothing returned";
            echo "<tr>";
            echo "<td>" . $cb . "</td>";
            echo "</tr>";
        } else {
            while ($row = pg_fetch_row($result)) {
                echo "<tr>";
                echo "<td>" . $row[0] . "</td>";
				echo "<td>" . $row[1] . "</td>";
				echo "<td>" . $row[2] . "</td>";
				echo "<td>" . $row[3] . "</td>";
				echo "<td>" . $row[4] . "</td>";
				echo "<td>" . $row[5] . "</td>";
				echo "<td>" . $row[6] . "</td>";
				echo "<td>" . $row[7] . "</td>";
                echo "</tr>";
            }
        }
        echo "</table>";
        // pg_close($db_connection);
        ?>
							</p>
						</header>
					</section>

				</div>
			</div>
		</section>
	</div>

</body>
</html>