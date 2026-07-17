<?php
// Eunoiaverse - Login Page

// Enable error reporting in development
ini_set('display_errors', getenv('APP_DEBUG') ? 1 : 0);
error_reporting(E_ALL);

// Load autoloader and helpers
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    die('<h1>Composer autoloader not found.</h1><p>Please run "composer install" in your project root.</p>');
}
if (file_exists(__DIR__ . '/../src/Helpers/functions.php')) {
    require_once __DIR__ . '/../src/Helpers/functions.php';
}

$app = Eunoiaverse\Application::getInstance();
$authService = $app->getAuthService();

// If user is already logged in, redirect to the homepage
if ($authService->isLoggedIn()) {
    Eunoiaverse\Helpers\redirect('index.php');
}

$errors = [];
$input = []; // Store user input for repopulating the form

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = 'Invalid security token. Please try submitting the form again.';
    } else {
        $input['email'] = Eunoiaverse\Helpers\sanitize($_POST['email'] ?? '');
        $input['password'] = $_POST['password'] ?? ''; // Don't sanitize password before processing

        // --- Server-Side Validation ---
        if (empty($input['email'])) {
            $errors[] = 'Email or Username is required.';
        }
        if (empty($input['password'])) {
            $errors[] = 'Password is required.';
        }

        if (empty($errors)) {
            try {
                $result = $authService->login($input['email'], $input['password']);

                if ($result['success']) {
                    Eunoiaverse\Helpers\redirect('index.php');
                } else {
                    $errors[] = $result['message'] ?? 'Invalid credentials. Please try again.';
                }
            } catch (Exception $e) {
                error_log('Login Error: ' . $e->getMessage());
                $errors[] = 'An unexpected error occurred during login.';
            }
        }
    }
}

// Generate CSRF token if it doesn't exist
Eunoiaverse\Helpers\generateCSRFToken();

// Include layout files
$head = __DIR__ . '/../layout/head.html';
$header = __DIR__ . '/../layout/header.php';
$footer = __DIR__ . '/../layout/footer.php';
?>
<!DOCTYPE html>
<html lang="en-ID">
<head>
    <meta charset="UTF-8">
    <title>Login - Eunoiaverse</title>
    <?php if (file_exists($head)) include $head; ?>
</head>
<body>

<?php if (!empty($errors)): ?>
    <div class="errors" style="color: red; border: 1px solid red; padding: 10px; margin-bottom: 15px;">
        <strong>Please correct the following errors:</strong>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="login.php" id="login-form" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <label for="email">Email or Username</label>
    <input type="text" id="email" name="email" placeholder="you@example.com" value="<?php echo htmlspecialchars($input['email'] ?? ''); ?>" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Your password" required>
    <input type="submit" name="login" value="Login">
</form>
<p>Don't have an account? <a href="register.php">Register here</a>.</p>

<?php if (file_exists($footer)) require $footer; ?>
</body>
</html>