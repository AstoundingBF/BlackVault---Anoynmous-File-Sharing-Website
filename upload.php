<?php
// Include the database configuration file
$host = 'localhost'; // Replace with your database host
$dbName = 'uploads'; // Replace with your database name
$username = 'uploads'; // Replace with your database username
$password = '3fsn(ETB3D2Hb_Z'; // Replace with your database password

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

// Set the maximum file size (in bytes)
$maxFileSize = 100 * 1024 * 1024; // 50MB

// Define the upload directory
$uploadDir = 'uploads/';

// Ensure the upload directory exists and has appropriate permissions
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Check if files were uploaded successfully
if (isset($_FILES['file']['name'])) {
    $files = $_FILES['file'];

    // Loop through each uploaded file
    for ($i = 0; $i < count($files['name']); $i++) {
        $file = [
            'name' => $files['name'][$i],
            'type' => $files['type'][$i],
            'tmp_name' => $files['tmp_name'][$i],
            'error' => $files['error'][$i],
            'size' => $files['size'][$i]
        ];

        // Check for errors during upload
        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo 'Error uploading file: ' . getUploadErrorMessage($file['error']);
            continue;
        }

        // Validate file size
        if ($file['size'] > $maxFileSize) {
            echo 'File size exceeds the limit.';
            continue;
        }

        // Generate a unique filename for the uploaded file
        $filename = uniqid('file_', true) . '_' . $file['name'];

        // Set the path for the uploaded file
        $filePath = $uploadDir . $filename;

        // Move the uploaded file to the destination path
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Generate a unique hash for the file
            $hash = generateHash();

            // Save the file details to the database
            $stmt = $pdo->prepare("INSERT INTO files (filename, hash) VALUES (:filename, :hash)");
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':hash', $hash);
            $stmt->execute();

            // Perform any additional operations or tasks here

            // Generate the download link
            $downloadLink = generateDownloadLink($hash);

            // Return the download link as the response
            echo $downloadLink . "";
        } else {
            echo 'Error moving uploaded file to destination.';
        }
    }
}

/**
 * Get the error message for a specific upload error code.
 *
 * @param int $errorCode The upload error code.
 * @return string The error message.
 */
function getUploadErrorMessage($errorCode)
{
    switch ($errorCode) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded.';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded.';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder. Check upload_tmp_dir setting in php.ini.';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk.';
        case UPLOAD_ERR_EXTENSION:
            return 'A PHP extension stopped the file upload.';
        default:
            return 'Unknown error occurred during file upload.';
    }
}

/**
 * Function to generate a unique hash for the file.
 * Replace this with your own hash generation logic.
 *
 * @return string The hash value.
 */
function generateHash()
{
    return uniqid(); // Generates a unique ID as the hash
}

/**
 * Function to generate the download link based on the hash.
 * Replace this with your own link generation logic.
 *
 * @param string $hash The hash value.
 * @return string The download link.
 */
function generateDownloadLink($hash)
{
    $baseUrl = 'https://blackvault.cc'; // Replace with your website's base URL
    $downloadLink = $baseUrl . '/download.php?hash=' . $hash;
    return $downloadLink;
}
?>
