<?php
$dbconfig = array(
    'db_server' => 'localhost',
    'db_port' => ':3306',
    'db_username' => 'root',
    'db_password' => '',
    'db_name' => 'demo'
);

$conn = new mysqli($dbconfig['db_server'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name']);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check outgoing server
$result = $conn->query("SELECT * FROM vtiger_systems WHERE server_type='email'");
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        print_r($row);
    }
} else {
    echo "No outgoing server configured.\n";
}
$conn->close();
?>