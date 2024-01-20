<?php
$servername = "localhost";
$username = "root";
$password = "Sasta@25052";
$dbname = "bank";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// SQL script
$sqlScript = "
	DROP TABLE IF EXISTS transfers, customers;

	CREATE TABLE customers (
		 id INT AUTO_INCREMENT PRIMARY KEY,
		 name VARCHAR(50) NOT NULL,
		 email VARCHAR(50) NOT NULL,
		 balance DECIMAL(10, 2) NOT NULL
	);

	CREATE TABLE transfers (
		 id INT AUTO_INCREMENT PRIMARY KEY,
		 sender_id INT,
		 receiver_id INT,
		 amount DECIMAL(10, 2),
		 transferTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		 FOREIGN KEY (sender_id) REFERENCES customers(id),
		 FOREIGN KEY (receiver_id) REFERENCES customers(id)
	);

	INSERT INTO customers (name, email, balance) VALUES
		 ('John Doe', 'john@gmail.com', 1000.00),
		 ('Jane Smith', 'jane@gmail.com', 1500.00),
		 ('Alice Johnson', 'alice@gmail.com', 2000.00),
		 ('Bob Williams', 'bob@gmail.com', 1800.00),
		 ('Eva Brown', 'eva@gmail.com', 1200.00),
		 ('Mike Davis', 'mike@gmail.com', 1600.00),
		 ('Olivia Wilson', 'olivia@gmail.com', 1900.00),
		 ('Sophia Martinez', 'sophia@gmail.com', 2200.00),
		 ('William Anderson', 'william@gmail.com', 1350.00),
		 ('Grace Thomas', 'grace@gmail.com', 1750.00);
";

// Execute multi-query
if ($conn->multi_query($sqlScript)) {
	do {
		 // Fetch the result
		 if ($result = $conn->store_result()) {
			  $result->free();
		 }
		 // Move to the next statement if any
	} while ($conn->more_results() && $conn->next_result());

	header('location:index.php');
} else {
	echo "Error executing queries: " . $conn->error;
}

// Close connection
$conn->close();
?>