<?php
/**
 * Eunoiaverse - Logout Script
 */

// Load autoloader and helpers
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
}
if (file_exists(__DIR__ . '/../src/Helpers/functions.php')) {
    require_once __DIR__ . '/../src/Helpers/functions.php';
}

// Use the auth service to properly log out
$app = Eunoiaverse\Application::getInstance();
$authService = $app->getAuthService();
$authService->logout();

// Redirect to the homepage
Eunoiaverse\Helpers\redirect('index.php');
?>