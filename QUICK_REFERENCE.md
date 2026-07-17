# Quick Reference Guide

## Table of Contents
1. [Getting Started](#getting-started)
2. [Common Tasks](#common-tasks)
3. [File Locations](#file-locations)
4. [Command Reference](#command-reference)
5. [Code Snippets](#code-snippets)

---

## Getting Started

### Installation
```bash
# 1. Clone repository
git clone https://github.com/eunoiaproject/eunoiaverse.git eunoiaverse
cd eunoiaverse

# 2. Install dependencies
composer install

# 3. Start development server
php -S localhost:8080

# 4. Setup database
mysql -u root < database.sql

# 4. Start XAMPP
xampp-control.exe

# 5. Access application
http://localhost/eunoiaverse
```

### First Login
- **Username**: admin
- **Password**: admin123
- **Email**: admin@eunoiaverse.com

---

## Common Tasks

### Add a New Page

1. **Create HTML file**
   ```bash
   newpage.html
   ```

2. **Create JavaScript logic**
   ```bash
   assets/js/newpage.js
   ```

3. **Add navigation link**
   - Update header/footer navigation
   - Link to new page

### Create New API Endpoint

1. **Create service file**
   - The file should be inside the `public/service/` directory.
   ```bash
   public/service/newservice.php
   ```

2. **Implement action handler**
   ```php
   switch($action) {
       case 'getData':
           // implementation
           break;
   }
   ```

3. **Return JSON response**
   ```php
   echo json_encode($response);
   ```

### Add New Component

1. **Create component class**
   ```bash
   assets/js/components/newcomponent.js
   ```

2. **Implement render method**
   ```javascript
   render() {
       const element = document.createElement('div');
       // implementation
       return element;
   }
   ```

3. **Export component**
   ```javascript
   export { NewComponent };
   ```

---

## File Locations

### Important Files

| File | Purpose |
|------|---------|
| `index.html` | Home page |
| `login.html` | Login page |
| `profile.html` | User profile |
| `wallet.html` | Wallet management |
| `marketplace.html` | Product marketplace |
| `DOCUMENTATION.md` | Full documentation |
| `DOCUMENTATION.md#api-reference` | API documentation |
| `DOCUMENTATION.md#components` | Component documentation |

### Asset Folders

| Folder | Purpose |
|--------|---------|
| `public/assets/css/` | Stylesheets |
| `public/assets/js/` | JavaScript files |
| `public/assets/js/components/` | Reusable components |
| `public/assets/img/` | Images and icons |

### Backend Folders

| Folder | Purpose |
|--------|---------|
| `src/` | PHP classes |
| `public/service/` | API endpoints |
| `src/Profile/` | Profile management |
| `src/Wallet/` | Wallet operations |
| `src/Database/` | Database connection |
| `tests/` | Unit tests |

---

## Command Reference

### Database Commands

```bash
# Connect to MySQL
mysql -u root -p

# Create database
CREATE DATABASE eunoiaverse;

# Use database
USE eunoiaverse;

# Show tables
SHOW TABLES;

# Describe table
DESCRIBE users;

# Backup database
mysqldump -u root -p eunoiaverse > backup.sql

# Restore database
mysql -u root -p eunoiaverse < backup.sql
```

### Git Commands

```bash
# Clone repository
git clone https://github.com/eunoiaproject/eunoiaverse.git
cd eunoiaverse

# Initialize git
git init

# Check status
git status

# Add changes
git add .

# Commit changes
git commit -m "message"

# Push changes
git push origin main

# Pull changes
git pull origin main

# Create branch
git checkout -b feature/feature-name

# Switch branch
git checkout branch-name

# Merge branch
git merge feature/feature-name
```

### PHP Commands

```bash
# Check PHP version
php -v

# Run PHP file
php filename.php

# Check syntax
php -l filename.php

# Start built-in server
php -S localhost:8000
```

---

## Code Snippets

### Authentication

```javascript
// Check if logged in
if (localStorage.getItem('isLoggedIn') !== 'true') {
    window.location.href = 'login.html';
}

// Get logged-in user info
const userId = localStorage.getItem('userId');
const username = localStorage.getItem('username');

// Logout
function logout() {
    localStorage.removeItem('isLoggedIn');
    localStorage.removeItem('userId');
    window.location.href = 'login.html';
}
```

### API Calls

```javascript
// GET request
fetch('/service/profile.php?action=getProfile&userId=1')
    .then(res => res.json())
    .then(data => console.log(data))
    .catch(err => console.error(err));

// POST request
fetch('/service/profile.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'action=updateProfile&userId=1&fullName=John'
})
    .then(res => res.json())
    .then(data => console.log(data));

// With error handling
try {
    const response = await fetch('/service/endpoint.php');
    const data = await response.json();
    if (!data.success) throw new Error(data.message);
    console.log(data);
} catch (error) {
    console.error('Error:', error);
}
```

### Database Operations

```php
// Connect to database
require_once 'src/Database/Connection.php';
use Eunoiaverse\Database\Connection;

$db = new Connection();
$connection = $db->connect();

// Simple query
$stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Insert query
$stmt = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $username, $email, $password);
$stmt->execute();

// Update query
$stmt = $connection->prepare("UPDATE users SET full_name = ? WHERE id = ?");
$stmt->bind_param('si', $fullName, $id);
$stmt->execute();

// Delete query
$stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
```

### Components

```javascript
// Create button
const button = new NeuButton({
    text: 'Click',
    onClick: () => alert('Clicked!')
});
document.body.appendChild(button.render());

// Create input
const input = new NeuInput({
    label: 'Email',
    type: 'email',
    required: true
});
document.body.appendChild(input.render());

// Create card
const card = new NeuCard({
    title: 'My Card',
    content: '<p>Content</p>'
});
document.body.appendChild(card.render());
```

### LocalStorage

```javascript
// Set item
localStorage.setItem('user_id', '1');

// Get item
const userId = localStorage.getItem('user_id');

// Remove item
localStorage.removeItem('user_id');

// Clear all
localStorage.clear();

// Check if exists
if (localStorage.getItem('isLoggedIn')) {
    // logged in
}

// Store object
const user = { id: 1, name: 'John' };
localStorage.setItem('user', JSON.stringify(user));

// Retrieve object
const savedUser = JSON.parse(localStorage.getItem('user'));
```

---

## Debugging

### Browser Console

```javascript
// Log messages
console.log('Message');
console.warn('Warning');
console.error('Error');

// Assert
console.assert(condition, 'Message');

// Time execution
console.time('timer');
// ... code ...
console.timeEnd('timer');

// View object
console.table(array_of_objects);
```

### Developer Tools

- **F12** or **Ctrl+Shift+I** - Open DevTools
- **Network** tab - View API calls
- **Console** tab - View errors
- **Storage** tab - View localStorage
- **Elements** tab - View HTML

### Common Issues

| Issue | Solution |
|-------|----------|
| "User not logged in" | Check localStorage keys |
| "API Error" | Check Network tab in DevTools |
| "Component not showing" | Check browser console for errors |
| "Database error" | Check connection parameters |
| "CORS error" | Check API endpoint headers |

---

## Performance Tips

1. **Minimize HTTP requests** - Combine files
2. **Cache API responses** - Use localStorage
3. **Lazy load images** - Load on demand
4. **Minify code** - Reduce file size
5. **Use CDN** - For external libraries
6. **Optimize images** - Compress files
7. **Reduce database queries** - Use indexes

---

## Security Checklist

- [ ] Use HTTPS in production
- [ ] Hash passwords with bcrypt
- [ ] Validate input on server side
- [ ] Sanitize output
- [ ] Use prepared statements
- [ ] Set CORS headers
- [ ] Use secure cookies
- [ ] Implement rate limiting
- [ ] Log security events
- [ ] Keep dependencies updated

---

## Useful Links

- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [PHP Documentation](https://www.php.net/manual/)
- [JavaScript MDN](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

---

## Contact & Support

For issues or questions:
1. Check documentation files
2. Review browser console
3. Check Network tab in DevTools
4. Review server error logs
5. Contact development team

---

**Last Updated**: February 10, 2026
**Version**: 1.0.0
