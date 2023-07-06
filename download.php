<?php
// Include the database configuration file
$host = 'localhost'; // Replace with your database host
$dbName = 'uploads'; // Replace with your database name
$username = 'uploads'; // Replace with your database username
$password = 'db_pass'; // Replace with your database password

// Create a database connection
$dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}

// Check if the hash parameter is present in the URL
if (isset($_GET['hash'])) {
    $hash = $_GET['hash'];
    
    // Retrieve the filename associated with the hash from the database
    $stmt = $pdo->prepare("SELECT filename FROM files WHERE hash = :hash");
    $stmt->bindParam(':hash', $hash);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $filename = $row['filename'];
        $filePath = 'uploads/' . $filename;
        
        // Check if the file exists
        if (file_exists($filePath)) {
            // Perform any additional verification or security checks here
            
            // Set appropriate headers for the file download
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            header('Content-Length: ' . filesize($filePath));
            
            // Output the file contents
            readfile($filePath);
            exit;
        }
    }
}

// If the hash or file doesn't exist, display an error message
echo 'File not found. Invalid Hash: ' . $hash;
exit;
?>
