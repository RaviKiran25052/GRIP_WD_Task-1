<?php
	$servername = "localhost";
	$username = "root";
	$password = "Sasta@25052";
	$dbname = "bank";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} else {
		echo "<h1>Connection Established...!</h1>";
	}
	
	$sql = "SELECT id, name, email, balance FROM customers";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "ID: " . $row["id"]. " - Name: " . $row["name"]. " - Email: " . $row["email"]. " - Balance: " . $row["balance"]. "<br>";
		}
	} else {
		echo "0 results";
	}
	
?>