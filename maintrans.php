<?php

$servername = "localhost";
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "online_payment"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$payment = $_POST['payment'];

if ($payment === 'card') {
    $cardName = $_POST['cardName'];
    $cardNum = $_POST['cardNum'];
    $expMonth = $_POST['expMonth'];
    $expYear = $_POST['expYear'];
    $cvv = $_POST['cvv'];

  
    $sql = "INSERT INTO payments (name, email, address, city, state, zip, payment_type, card_name, card_number, exp_month, exp_year, cvv)
            VALUES ('$name', '$email', '$address', '$city', '$state', '$zip', '$payment', '$cardName', '$cardNum', '$expMonth', '$expYear', '$cvv')";
} else {
   
    $sql = "INSERT INTO payments (name, email, address, city, state, zip, payment_type)
            VALUES ('$name', '$email', '$address', '$city', '$state', '$zip', '$payment')";
}


if ($conn->query($sql) === TRUE) {
    echo "Payment processed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>