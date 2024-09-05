<?php
$DB_HOST = "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "recipe_manager";
$DB_PORT = 3308;

// Function to initialize the database
function initializeDatabase($host, $username, $password, $port, $dbname) {
    // Create connection without specifying the database
    $conn = new mysqli($host, $username, $password, "", $port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed during initialization: " . $conn->connect_error);
    }

    // Read SQL file
    $sql = file_get_contents(__DIR__ . '/../sql/schema.sql');
    if ($sql === false) {
        die("Error reading SQL file.");
    }

    // SQL commands
    if ($conn->multi_query($sql) === TRUE) {
        do {
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->next_result());

        echo "Database setup completed successfully<br>";
    } else {
        die("Error executing SQL during initialization: " . $conn->error . "<br>");
    }

    $conn->close();
}

// create a connection to the MySQL server
$conn = @new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, "", $DB_PORT);

// Check connection to the server
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database exists 
$db_selected = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$DB_NAME'");

if ($db_selected->num_rows == 0) {
    // If the database does not exist, initialize it
    echo "Database not found. Initializing...<br>";
    initializeDatabase($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_PORT, $DB_NAME);
}

$conn->close();

//  connect to the MySQL server specifying the database
$conn = new mysqli($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME, $DB_PORT);

// Check connection to the database
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to database successfully.<br>";
?>
