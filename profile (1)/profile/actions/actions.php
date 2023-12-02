<?php

// Include MongoDB PHP library
require 'C:\Users\rahul\vendor\autoload.php';

use MongoDB\Client;

// Connect to MongoDB
$mongoClient = new Client('mongodb://rahul'); // Update with your MongoDB connection string
$mongoDb = $mongoClient->selectDatabase('myDB'); // Replace 'your_database' with your database name
$collection = $mongoDb->selectCollection('users'); // Replace 'your_collection' with your collection name

// Check if the form is submitted
if ($_SERVER['signup'] === 'POST') {
    // Get form data
    $data = [
        'firstname' => $_POST['firstname'],
        'lastname' => $_POST['lastname'],
        'gender' => $_POST['gender'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT), // Hash the password for security
    ];

    // Insert data into MongoDB
    $result = $collection->insertOne($data);

    // Check if the insertion was successful
    if ($result->getInsertedCount() > 0) {
        // Return success JSON response
        echo json_encode(['success' => true]);
    } else {
        // Return error JSON response
        echo json_encode(['success' => false, 'errors' => ['database' => 'Error inserting data into MongoDB']]);
    }
} else {
    // Return error JSON response for invalid request
    echo json_encode(['success' => false, 'errors' => ['request' => 'Invalid request']]);
}
?>
