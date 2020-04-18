<!DOCTYPE HTML>
<!--
	Alpha by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
<title>Member Home Page - HooCooks</title>
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, user-scalable=no" />
<link rel="stylesheet" href="assets/css/main.css" />
		<?php
session_start();
$login_status = $_SESSION['logged_in'];
if (! strcmp($login_status, "logged_in") == 0) {
    header('Location: elements.html');
}
$email = unserialize($_SESSION['email']);
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
		<section id="banner">
			<header>
				<h2>Welcome to HooCooks!</h2>

			</header>
		</section>

		<!-- Main -->
		<section id="main" class="container">
			<div class="row">
				<div class="col-12">

					<!-- Text -->
					<section class="box special">
						<header class="major">
							<h2>Account information</h2>
							<p>
								<?php
        session_start();
        $email = $_SESSION['email'];
        echo "<table border='1'>
								<tr>
								<th>Email</th>
								</tr>";
        echo "<tr>";
        echo "<td>" . $email . "</td>";
        echo "</tr>";
        $db_connection = pg_connect("host=ec2-174-129-227-80.compute-1.amazonaws.com
 								port=5432 dbname=dbvs140f5cqkp1 user=zdlwovjrekrdar password=ea1a662a2d7df06996a35f5aee8b2ac1d852cbe10af9af3c5cc60b41ee0d21f5
								");
        $query = "SELECT * FROM sales WHERE email='$email'";
        $result = pg_query($db_connection, $query);
        echo "<table border='1'>
								<tr>
								<th>CookBook</th>
								<th>Subscription</th>
								</tr>";
        if (pg_num_rows($result) == 0) {
            $cb = "not purchased";
            $sub = "not purchased";
            echo "<tr>";
            echo "<td>" . $cb . "</td>";
            echo "<td>" . $sub . "</td>";
            echo "</tr>";
        } else {
            while ($row = pg_fetch_row($result)) {
                $cb = (strcmp(strval($row[1]), "0") == 0 ? "not purchased" : "purchased");
                $sub = (strcmp(strval($row[2]), "0") == 0 ? "not purchased" : "purchased");
                echo "<tr>";
                echo "<td>" . $cb . "</td>";
                echo "<td>" . $sub . "</td>";
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
		<section id="cta">
			<a href="unsub.html" class="button">Unsubscribe</a>
		</section>
	</div>

</body>
</html>