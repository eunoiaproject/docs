<?php
// Eunoiaverse - Registration Page

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

$errors = [];
$input = []; // Store user input for repopulating the form

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $errors[] = 'Invalid security token. Please try submitting the form again.';
    } else {
        // Sanitize and store all inputs
        $input_keys = ['first-name', 'last-name', 'birthday', 'address', 'city', 'state', 'zip', 'country', 'phone', 'username', 'email', 'password', 'confirm-password'];
        foreach ($input_keys as $key) {
            $input[$key] = Eunoiaverse\Helpers\sanitize($_POST[$key] ?? '');
        }

        // --- Server-Side Validation ---
        if (empty($input['username'])) $errors[] = 'Username is required.';
        if (empty($input['first-name'])) $errors[] = 'First name is required.';
        if (empty($input['last-name'])) $errors[] = 'Last name is required.';
        if (empty($input['email'])) {
            $errors[] = 'Email is required.';
        } elseif (!Eunoiaverse\Helpers\validateEmail($input['email'])) {
            $errors[] = 'Invalid email format.';
        }
        if (empty($input['password'])) {
            $errors[] = 'Password is required.';
        } elseif (!Eunoiaverse\Helpers\validatePasswordStrength($input['password'])) {
            $errors[] = 'Password must be at least 8 characters and contain an uppercase letter, a number, and a special character.';
        }
        if ($input['password'] !== $input['confirm-password']) {
            $errors[] = 'Passwords do not match.';
        }

        if (empty($errors)) {
            try {
                if ($authService->userExists($input['username'], $input['email'])) {
                     $errors[] = 'A user with that username or email already exists.';
                } else {
                    // Correctly call the register method with individual arguments
                    $result = $authService->register(
                        $input['username'],
                        $input['email'],
                        $input['password'],
                        $input['first-name'],
                        $input['last-name']
                    );

                    if ($result['success']) {
                        // Automatically log the new user in after successful registration
                        $loginResult = $authService->login($input['email'], $input['password']);
                        if ($loginResult['success']) {
                            Eunoiaverse\Helpers\redirect('index.php');
                        } else {
                            $errors[] = 'Registration successful, but auto-login failed. Please log in manually.';
                        }
                    } else {
                        $errors[] = $result['message'] ?? 'Registration failed due to a server error.';
                    }
                }
            } catch (Exception $e) {
                error_log('Registration Error: ' . $e->getMessage());
                $errors[] = 'An unexpected error occurred during registration.';
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
    <title>Register - Eunoiaverse</title>
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

<form action="register.php" id="register-form" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <div>
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" name="first-name" placeholder="First Name" value="<?php echo $input['first-name'] ?? ''; ?>" required>
        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" name="last-name" placeholder="Last Name" value="<?php echo $input['last-name'] ?? ''; ?>" required>
        <!-- Other personal info fields... -->
    </div>
    <br>
    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="@edoerpani" value="<?php echo $input['username'] ?? ''; ?>" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="edoerpani@example.com" value="<?php echo $input['email'] ?? ''; ?>" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="minimal 8 characters, with uppercase, number, special char" minlength="8" required>
        <label for="confirm-password">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="retype password" required>
    </div>
    <br>
    <input type="submit" name="register" value="Register">
</form>
<p>Already have an account? <a href="login.php">Login here</a>.</p>

<?php if (file_exists($footer)) require $footer; ?>
</body>
</html>