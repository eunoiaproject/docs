<?php
/**
 * Eunoiaverse Platform - Main Entry Point
 */

// Enable error reporting in development
ini_set('display_errors', getenv('APP_DEBUG') ? 1 : 0);
error_reporting(E_ALL);

// Load autoloader
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

// Load helper functions
if (file_exists(__DIR__ . '/../src/Helpers/functions.php')) {
    require_once __DIR__ . '/../src/Helpers/functions.php';
}

// Initialize session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isAuthenticated = isset($_SESSION['user_id']);
$currentUser = $_SESSION['user_id'] ?? null;
$greeting = "Welcome to Eunoiaverse!";

// Include layout files
$head = file_exists(__DIR__ . '/../layout/head.html') ? file_get_contents(__DIR__ . '/../layout/head.html') : '<title>Eunoiaverse</title>';
$header = file_exists(__DIR__ . '/../layout/header.html') ? file_get_contents(__DIR__ . '/../layout/header.html') : '';
$footer = file_exists(__DIR__ . '/../layout/footer.html') ? file_get_contents(__DIR__ . '/../layout/footer.html') : '';

// Simple templating
$header = str_replace('{{page_title}}', 'Dashboard', $header);
$footer = str_replace('{{year}}', date("Y"), $footer);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $head; ?>
    <style>
        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background-color: #f4f4f9; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); text-align: center; }
        nav a { margin: 0 15px; text-decoration: none; color: #05a4af; }
    </style>
</head>
<body>
    <?php echo $header; ?>

    <div class="card">
        <h1><?php echo $greeting; ?></h1>
        <p>This is the main application entry point.</p>
        <?php if ($isAuthenticated): ?>
            <p>You are logged in as User #<?php echo htmlspecialchars($currentUser); ?>. <a href="logout.php">Logout</a></p>
        <?php else: ?>
            <p>You are not logged in. <a href="login.php">Login</a> or <a href="register.php">Register</a></p>
        <?php endif; ?>
    </div>

    <?php echo $footer; ?>
</body>
</html>