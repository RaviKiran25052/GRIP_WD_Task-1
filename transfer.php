<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer List</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="d-flex justify-content-center mt-5">
	<div class="transfer">
		<h2>Tranfer Money</h2>
		<table align="center"> 
			<form method="post" action="update.php"> 
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "Sasta@25052";
				$dbname = "bank";
				$conn = new mysqli($servername, $username, $password, $dbname);

				$sid = $_GET["sid"];
				$rid = $_GET["rid"];
				$sender = $conn->query("SELECT name, balance FROM customers WHERE id='$sid'");
				$receiver = $conn->query("SELECT name FROM customers WHERE id='$rid'");
			
				if ($sender->num_rows > 0 && $receiver->num_rows > 0) {
					$sender_data = $sender->fetch_assoc();
					$receiver_data = $receiver->fetch_assoc();

					$sender_name = $sender_data['name'];
					$sender_balance = $sender_data['balance'];
					$receiver_name = $receiver_data['name'];
				} else {
					echo "Sender or Receiver not found";
				}
				echo '
					<tr>
						<td><label>Sender</label></td>
						<td>:&nbsp; <input type="text" value='. $sender_name.' name="sname" readonly/></td>
					</tr>
					<tr>
						<td><label>Receiver</label></td>
						<td>:&nbsp; <input type="text" value='. $receiver_name.' name="rname" readonly/></td>
					</tr>
					<tr>
						<td><label>Balance</label></td>
						<td>:&nbsp; <input type="text" value="$'. $sender_balance.'" name="balance" readonly/></td>
					</tr>
					<tr>
						<td><label>Money to Transfer &nbsp;</label></td>
						<td>:&nbsp; <input type="number" name="amount" required/></td>
					</tr>					
					<input type="hidden" name="sid" value='.$sid.'>
					<input type="hidden" name="rid" value='.$rid.'>
					<tr align="center"><td colspan="2"><button type="submit" class="btn btn-primary btn-lg mt-2">Submit</button></td></tr>
			';?>
			</form>
		</table> 
	</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>