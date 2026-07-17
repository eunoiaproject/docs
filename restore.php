<?php
include 'src/Database/Connection.php';
// IMPORTANT: This script is dangerous and should be run with extreme caution.
// It should be deleted from the server after use.
// It is recommended to run this script only from the command line (CLI).

if (php_sapi_name() !== 'cli') {
    header('HTTP/1.1 403 Forbidden');
    die('This script can only be run from the command line.');
}

// Best Practice: Use environment variables for credentials instead of hardcoding them.
// Example for Linux/macOS: export DB_HOST="localhost"
// Example for Windows: set DB_HOST="localhost"
$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root'; // Default to root if not set
$pass = getenv('DB_PASS') ?: '';      // Default to empty if not set
$db   = getenv('DB_NAME') ?: 'eunoiaverse.db';
$backup_file = 'backup.sql';

if (!file_exists($backup_file)) {
    die("Error: Backup file '$backup_file' not found.\n");
}

// Use environment variables for the mysql command to avoid exposing the password in the process list.
// The MYSQL_PWD environment variable is used by the mysql client.
putenv("MYSQL_PWD=$pass");

// Command to import the SQL file
// Using escapeshellarg to prevent command injection vulnerabilities.
$command = sprintf(
    "mysql -h %s -u %s %s < %s",
    escapeshellarg($host),
    escapeshellarg($user),
    escapeshellarg($db),
    escapeshellarg($backup_file)
);

// Execute the command
system($command, $return_status);

if ($return_status === 0) {
    echo "Database restored successfully from '$backup_file'!\n";
} else {
    echo "Restore failed. Check your credentials, database name, and file path.\n";
}
?>