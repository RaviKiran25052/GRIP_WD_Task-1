<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Customer List</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "Sasta@25052";
		$dbname = "bank";
		$conn = new mysqli($servername, $username, $password, $dbname);

		$sid = $_GET["sid"];
		$name = $conn->query("SELECT name FROM customers WHERE id='$sid'");
	?>
	<div class="m-4">
		<?php echo '<p class="header">Now you are <span class="name">'.$name->fetch_array()['name'].'</span>, To whom do you want to send Money : </p>';?>
		<div class="row row-cols-2 row-cols-lg-3">
			<?php
				$sql = "SELECT * FROM customers WHERE id!='$sid'";
				$customers = $conn->query($sql);

				foreach ($customers as $customer) {
					echo '
					<div class="col-md-4 mb-4">
						<div class="card customer">
						<h4 class="card-header">' . $customer['name'] . '</h4>
							<div class="card-body d-flex flex-lg-row flex-column justify-content-between align-items-center">
								<p class="card-text">
									<span style="font-weight: 600;text-decoration: underline;">Email</span>&nbsp;: ' . $customer['email'] . '<br>
									<span style="font-weight: 600;text-decoration: underline;">Money</span> :  $' . $customer['balance'] . '
								</p>
								<a href="transfer.php?sid='.$sid.'&rid='.$customer['id'].'" class="btn btn-primary">Select</a>
							</div>
						</div>
					</div>';
				}
			?>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
