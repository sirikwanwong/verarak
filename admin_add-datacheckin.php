<?php
    $pdo = new PDO("mysql:host=localhost; dbname=verarak; charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php
// Assuming you have established a database connection already

// Retrieve form data
$patient_id = $_POST['patient_id'];

// Retrieve other form fields similarly

// Prepare and execute the SQL query
$stmt = $pdo->prepare("INSERT INTO treatment (patient_id, name_patient) VALUES (?, ?)");
$stmt->execute([$patient_id, $name_patient]);
// Execute for other form fields similarly

// You can return a success message if needed
echo "Data saved successfully";

// Remember to handle errors, exceptions, and sanitize input data appropriately in a real-world application
?>
