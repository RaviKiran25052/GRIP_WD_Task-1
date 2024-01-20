<?php
$servername = "localhost";
$username = "root";
$password = "Sasta@25052";
$dbname = "bank";
$conn = new mysqli($servername, $username, $password, $dbname);

$sender_id = $_POST['sid'];
$receiver_id = $_POST['rid'];
$amount = $_POST['amount'];

$sql_check_balance = "SELECT balance FROM customers WHERE id = $sender_id";
$result_check_balance = $conn->query($sql_check_balance);

if ($result_check_balance->num_rows > 0) {
   $row = $result_check_balance->fetch_assoc();
   $sender_balance = $row['balance'];

   if ($sender_balance < $amount) {
      echo "Insufficient balance";
   } else {
      $conn->begin_transaction();

      $sql_update_sender = "UPDATE customers SET balance = balance - $amount WHERE id = $sender_id";
      $conn->query($sql_update_sender);

      $sql_update_receiver = "UPDATE customers SET balance = balance + $amount WHERE id = $receiver_id";
      $conn->query($sql_update_receiver);

      $sql_record_transfer = "INSERT INTO transfers (sender_id, receiver_id, amount)  VALUES ($sender_id, $receiver_id, $amount)";
      $conn->query($sql_record_transfer);

      $conn->commit();

      header('location:index.php');
   }
} else {
   echo "Sender not found";
}
?>