# Troubleshooting & Best Practices

## Table of Contents
1. [Common Issues & Solutions](#common-issues--solutions)
2. [Error Messages](#error-messages)
3. [Debugging Guide](#debugging-guide)
4. [Performance Optimization](#performance-optimization)
5. [Security Best Practices](#security-best-practices)
6. [Code Quality](#code-quality)

---

## Common Issues & Solutions

### Authentication Issues

#### Problem: "User not logged in" redirect loop
**Cause**: Login state not being saved or localStorage cleared

**Solution**:
```javascript
// Check localStorage
console.log(localStorage.getItem('isLoggedIn'));

// Verify token exists
console.log(localStorage.getItem('userId'));

// Clear and re-login
localStorage.clear();
window.location.href = 'login.html';
```

#### Problem: Password reset not working
**Cause**: Email not configured or token expired

**Solution**:
1. Check email configuration in `src/Auth/Authentication.php`
2. Verify token hasn't expired (check database)
3. Test email sending with test function
4. Check spam folder

#### Problem: Session timeout
**Cause**: Long inactivity or browser cache issue

**Solution**:
```javascript
// Add session refresh
setInterval(() => {
    if (localStorage.getItem('isLoggedIn') === 'true') {
        fetch('/service/database.php?action=refreshSession')
            .catch(() => logout());
    }
}, 5 * 60 * 1000); // Every 5 minutes
```

---

### Database Issues

#### Problem: "Database connection failed"
**Cause**: Wrong credentials or MySQL not running

**Solution**:
```bash
# 1. Check if MySQL is running
# Start XAMPP MySQL service

# 2. Verify credentials in src/Database/Connection.php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'eunoiaverse';

# 3. Test connection
php -r "
require 'src/Database/Connection.php';
\$db = new \Eunoiaverse\Database\Connection();
\$conn = \$db->connect();
echo \$conn ? 'Connected' : 'Failed';
"
```

#### Problem: "Table doesn't exist"
**Cause**: Database not imported or table name typo

**Solution**:
```bash
# 1. Check if database exists
mysql -u root -p -e "SHOW DATABASES;"

# 2. Check tables
mysql -u root -p eunoiaverse -e "SHOW TABLES;"

# 3. Import database
mysql -u root -p eunoiaverse < database.sql

# 4. Create missing table
# Use database.sql script
```

#### Problem: "Duplicate entry" error
**Cause**: Unique constraint violation (duplicate username/email)

**Solution**:
```sql
-- Check for duplicates
SELECT username, COUNT(*) FROM users GROUP BY username HAVING COUNT(*) > 1;

-- Remove duplicates
DELETE FROM users WHERE id NOT IN (
    SELECT MAX(id) FROM users GROUP BY username
);

-- Or update the duplicate
UPDATE users SET username = CONCAT(username, '_', id) WHERE id = 123;
```

#### Problem: Slow queries
**Cause**: Missing indexes

**Solution**:
```sql
-- Add indexes
ALTER TABLE users ADD INDEX idx_email (email);
ALTER TABLE transactions ADD INDEX idx_created_at (created_at);
ALTER TABLE products ADD FULLTEXT INDEX ft_search (name, description);

-- Check query execution
EXPLAIN SELECT * FROM users WHERE email = 'test@example.com';
```

---

### API Issues

#### Problem: "404 Not Found" on API call
**Cause**: Wrong endpoint URL or method

**Solution**:
```javascript
// Check URL format
console.log('Endpoint:', '/service/profile.php?action=getProfile&userId=1');

// Verify method
// POST for modifications, GET for retrieval

// Check parameters
console.log({
    action: 'getProfile',
    userId: 1
});
```

#### Problem: "CORS error"
**Cause**: Cross-origin request blocked

**Solution**:
Add headers to PHP files:
```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');
```

#### Problem: API returns empty response
**Cause**: No data found or query error

**Solution**:
```javascript
// Check API response in DevTools
console.log(data);

// Verify response structure
if (!data.success) {
    console.error('Error:', data.message);
}

// Check parameters being sent
console.log({action: 'getProfile', userId: 1});
```

---

### Component Issues

#### Problem: Component not rendering
**Cause**: Missing CSS or DOM element

**Solution**:
```javascript
// 1. Check CSS is loaded
console.log(document.querySelector('link[href*="neumorphic.css"]'));

// 2. Debug component render
const button = new NeuButton({text: 'Test'});
const element = button.render();
console.log(element); // Check if element created
document.body.appendChild(element); // Check if DOM updated

// 3. Check console for errors
// Open DevTools and check Console tab
```

#### Problem: Component styling looks wrong
**Cause**: CSS not applied or conflicting styles

**Solution**:
```javascript
// Check applied styles in DevTools
// Right-click element > Inspect > Styles tab

// Clear browser cache
// Ctrl+Shift+Del or Cmd+Shift+Del

// Force refresh
// Ctrl+F5 or Cmd+Shift+R

// Check CSS file is loaded
fetch('assets/css/neumorphic.css')
    .then(r => r.ok ? console.log('CSS loaded') : console.error('CSS not found'));
```

---

## Error Messages

### Authentication Errors

| Error | Meaning | Solution |
|-------|---------|----------|
| Invalid username or password | Credentials don't match | Check spelling, ResetPassword if forgotten |
| Username already exists | Username taken | Choose different username |
| Invalid email format | Email not valid | Use format: user@example.com |
| Account not verified | Email not confirmed | Check email for verification link |
| Account locked | Too many failed attempts | Wait 30 minutes or contact support |

### Database Errors

| Error | Meaning | Solution |
|-------|---------|----------|
| Connection refused | MySQL not running | Start MySQL server |
| No database selected | Database not chosen | Check database.php configuration |
| Table doesn't exist | Table not created | Import database schema |
| Duplicate entry | Unique constraint violated | Use different value |
| Access denied | Wrong credentials | Check username/password |

### API Errors

| Error | Meaning | Solution |
|-------|---------|----------|
| 400 Bad Request | Invalid parameters | Check request format |
| 401 Unauthorized | Not authenticated | Login first |
| 403 Forbidden | Don't have permission | Check user role |
| 404 Not Found | Resource not found | Check URL and parameters |
| 500 Server Error | Server error | Check server logs |

---

## Debugging Guide

### Browser DevTools

#### Console Tab
```javascript
// Log variables
console.log('User:', localStorage.getItem('userId'));

// Log objects
console.table(users);

// Conditional logging
console.assert(userId, 'User ID is missing!');

// Measure performance
console.time('myTimer');
// code here
console.timeEnd('myTimer');
```

#### Network Tab
1. Open DevTools (F12)
2. Go to Network tab
3. Refresh page
4. Look for:
   - Red requests (errors)
   - Slow requests (performance)
   - Verify API responses

#### Storage Tab
1. Open DevTools
2. Go to Application/Storage
3. Check:
   - LocalStorage values
   - Cookies
   - Session storage

### Server-Side Debugging

#### PHP Logging
```php
// Add logging
error_log('Debug message: ' . print_r($data, true));
error_log('User ID: ' . $user_id);

// Check logs
// Windows: tail -f logs/php_errors.log
// Linux: tail -f /var/log/apache2/error.log
```

#### Error Display
```php
// Show errors (development only)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Log to file (production)
ini_set('log_errors', 1);
ini_set('error_log', 'logs/php_errors.log');
```

---

## Performance Optimization

### Frontend Optimization

#### 1. Minify CSS/JavaScript
```bash
# Using online tools
# https://minifier.org
# https://cssminifier.com
```

#### 2. Lazy Load Images
```html
<img src="image.jpg" loading="lazy" alt="Description">
```

#### 3. Cache Strategy
```javascript
// Cache API responses
const cache = new Map();

async function getCachedData(url) {
    if (cache.has(url)) {
        return cache.get(url);
    }
    const data = await fetch(url).then(r => r.json());
    cache.set(url, data);
    return data;
}
```

#### 4. Debounce Events
```javascript
function debounce(func, delay) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func(...args), delay);
    };
}

// Usage
input.addEventListener('input', debounce(() => {
    // API call here
}, 300));
```

### Backend Optimization

#### 1. Database Optimization
```sql
-- Add indexes for frequently queried fields
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_transaction_user ON transactions(user_id);

-- Use EXPLAIN to analyze queries
EXPLAIN SELECT * FROM users WHERE email = 'test@example.com';
```

#### 2. Query Optimization
```php
// Use SELECT specific columns, not *
SELECT id, name, email FROM users; // Good
SELECT * FROM users; // Bad

// Use LIMIT for pagination
SELECT * FROM transactions LIMIT 10 OFFSET 0; // Good

// Use joins instead of multiple queries
SELECT u.*, t.* FROM users u JOIN transactions t; // Good
```

#### 3. Caching
```php
// Cache expensive queries
$cacheKey = 'user_' . $user_id;
if (apcu_exists($cacheKey)) {
    $user = apcu_fetch($cacheKey);
} else {
    $user = getUserFromDB($user_id);
    apcu_store($cacheKey, $user, 3600); // 1 hour
}
```

---

## Security Best Practices

### 1. Password Security

```php
// Hash passwords
$hashed = password_hash($password, PASSWORD_BCRYPT);

// Verify passwords
if (password_verify($password, $hashed)) {
    // Correct
}

// Enforce password requirements
if (strlen($password) < 8) {
    throw new Exception('Password too short');
}
```

### 2. Input Validation

```php
// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    throw new Exception('Invalid email');
}

// Validate integer
if (!is_numeric($id) || $id < 1) {
    throw new Exception('Invalid ID');
}

// Sanitize string
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
```

### 3. SQL Injection Prevention

```php
// Use prepared statements (GOOD)
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();

// Never concatenate (BAD)
$query = "SELECT * FROM users WHERE email = '$email'"; // Vulnerable!
```

### 4. CORS Headers

```php
// Set appropriate CORS headers
header('Access-Control-Allow-Origin: https://yourdomain.com');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Credentials: true');
```

### 5. SSL/TLS (HTTPS)

```php
// Enforce HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $url, true, 301);
    exit;
}
```

### 6. Session Security

```php
// Secure session configuration
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => 'yourdomain.com',
    'secure' => true, // HTTPS only
    'httponly' => true, // JS cannot access
    'samesite' => 'Strict' // CSRF protection
]);
```

---

## Code Quality

### 1. Code Style

```javascript
// Use consistent naming
const userName = 'John';  // camelCase for variables
const MAX_SIZE = 100;     // UPPER_CASE for constants
class UserManager {}      // PascalCase for classes

// Use meaningful names
const data = [];          // Bad
const userList = [];      // Good
```

### 2. Functions

```javascript
// Keep functions small and focused
function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

// Use JSDoc comments
/**
 * Get user by ID
 * @param {number} userId - User ID
 * @returns {Object} User object
 */
function getUserById(userId) {
    // implementation
}
```

### 3. Error Handling

```javascript
// Use try-catch
try {
    const response = await fetch(url);
    if (!response.ok) throw new Error('Network error');
    return await response.json();
} catch (error) {
    console.error('Error:', error);
    throw error;
}

// Provide meaningful error messages
throw new Error('User email is required');
```

### 4. Testing

```javascript
// Write unit tests
function add(a, b) {
    return a + b;
}

// Test
console.assert(add(2, 3) === 5, 'add(2,3) should equal 5');
console.assert(add(-1, 1) === 0, 'add(-1,1) should equal 0');

// Use testing frameworks
// Jest, Mocha, Jasmine
```

---

## Production Checklist

Before deploying to production:

- [ ] All tests passing
- [ ] No console errors
- [ ] HTTPS enabled
- [ ] Database backed up
- [ ] Environment variables set
- [ ] Error logging configured
- [ ] Security headers set
- [ ] Rate limiting enabled
- [ ] Monitoring setup
- [ ] Disaster recovery plan
- [ ] Documentation updated
- [ ] Code reviewed

---

## Performance Metrics

Target metrics for good performance:

| Metric | Target |
|--------|--------|
| Page Load Time | < 3 seconds |
| First Contentful Paint | < 1.8 seconds |
| Largest Contentful Paint | < 2.5 seconds |
| Cumulative Layout Shift | < 0.1 |
| API Response Time | < 500ms |
| Database Query Time | < 100ms |

---

## Resources

### Documentation
- [MDN Web Docs](https://developer.mozilla.org/)
- [PHP Manual](https://www.php.net/manual/)
- [MySQL Reference](https://dev.mysql.com/doc/)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)

### Tools
- Chrome DevTools: F12
- VS Code: https://code.visualstudio.com/
- Postman: https://www.postman.com/

### Learning
- Udemy courses
- freeCodeCamp
- Codecademy
- YouTube tutorials

---

**Last Updated**: February 10, 2026
**Version**: 1.0.0
