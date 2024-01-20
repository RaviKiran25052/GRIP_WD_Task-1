<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer List</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<center class="d-flex justify-content-evenly mt-5">
		<div>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "Sasta@25052";
		$dbname = "bank";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		$sql_customers = "SELECT * FROM customers";
		$result_customers = $conn->query($sql_customers);

		echo "<h2 class='text-white'>Customers Table</h2>";
		if ($result_customers->num_rows > 0) {
			echo "
			<table class='table table-striped table-bordered mb-4' style='width: fit-content;'>
			<thead class='table-dark'>
				<tr>
					<th scope='col'>Id</th>
					<th scope='col'>Name</th>
					<th scope='col'>Email</th>
					<th scope='col'>Balance</th>
				</tr>
			</thead>
			<tbody>";

			while ($row = $result_customers->fetch_assoc()) {
				echo "<tr>
							<td>" . $row["id"] . "</td>
							<td>" . $row["name"] . "</td>
							<td>" . $row["email"] . "</td>
							<td>" . $row["balance"] . "</td>
						</tr>";
			}
			echo "
				</tbody>
			</table>";
		?>
		<button class='btn btn-primary' onclick='window.location.href="sender.php"'>Transfer Money</button>";
		<button class='btn btn-danger' onclick='window.location.href="reset.php"'>Reset</button>";
		<?php
		} else {
			echo "<h5 class='text-white'>No Transactions</h5>";
		}

		$sql_transfers = "SELECT transfers.id, 
               sender.name AS senders_name, 
               receiver.name AS receivers_name, 
               transfers.amount, 
               transfers.transferTime
					FROM transfers
					JOIN customers AS sender ON transfers.sender_id = sender.id
					JOIN customers AS receiver ON transfers.receiver_id = receiver.id";

		$result = $conn->query($sql_transfers);
		?>
		</div>
		<div>
		<?php
		echo "<h2 class='text-white'>Tranfers Table</h2>";
		if ($result->num_rows > 0) {
			echo "
				<table class='table table-striped' style='width: fit-content;'>
					<thead class='table-dark'>
						<tr>
							<th scope='col'>Id</th>
							<th scope='col'>Sender Name</th>
							<th scope='col'>Recevier Name</th>
							<th scope='col'>Amount</th>
							<th scope='col'>Time</th>
						</tr>
					</thead>
					<tbody>";
			while ($row = $result->fetch_assoc()) {
				echo "
					<tr>
						<td>" . $row["id"] . "</td>
						<td>" . $row["senders_name"] . "</td>
						<td>" . $row["receivers_name"] . "</td>
						<td>" . $row["amount"] . "</td>
						<td>" . $row["transferTime"] . "</td>
					</tr>";
			}
			echo "
				</tbody>
			</table>";
		} else {
			echo "<h5 class='text-white'>No Transactions</h5>";
		}

		$conn->close();
		
	?>
	</div>
	</center>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
