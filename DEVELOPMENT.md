# Eunoiaverse Platform 
# Development Guide
## Development Workflow

### Setting Up Your Development Environment

1. **Clone/Download the Project**
   ```bash
   git clone https://github.com/eunoiaproject/eunoiaverse.git
   cd eunoiaverse
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Run Development Server**
   ```bash
   php -S localhost:8080
   ```

4. **Access Application**
   Open browser: `http://localhost:8080`

## Project Structure Overview

### Core Directories

| Directory | Purpose |
|-----------|---------|
| `public/` | Web server document root (contains index.php, assets, etc.) |
| `src/` | PHP library classes (autoloaded via Composer PSR-4) |
| `public/assets/` | Frontend resources (CSS, JS, images) |
| `public/service/` | Public API endpoints |
| `layout/` | Reusable HTML components |
| `examples/` | Usage examples and documentation |
| `tests/` | Unit tests and test configuration |

### Root Files

| File | Purpose |
|------|---------|
| `composer.json` | Project metadata and dependencies |
| `phpunit.xml` | Test framework configuration |
| `README.md` | Main documentation |
| `QUICK_REFERENCE.md` | Setup instructions |
| `DOCUMENTATION.md` | Detailed architecture |
| `.gitignore` | Version control ignore rules |
| `LICENSE` | MIT License |

## Working with the Library

### Including Library Classes

```php
<?php
require 'vendor/autoload.php';

use Eunoiaverse\Database\Connection;
use Eunoiaverse\Auth\Authentication;
use Eunoiaverse\Marketplace\Product;
use Eunoiaverse\Wallet\Wallet;

// Your code here...
```

### Adding New Classes

1. Create class in appropriate namespace under `src/`
2. Follow PSR-4 naming conventions
3. Include proper docblocks
4. Update `composer.json` if needed

Example:
```php
<?php

namespace Eunoiaverse\Notification;

class EmailNotification
{
    // Class implementation...
}
```

## Frontend Development

### JavaScript Components

Located in `assets/js/components/`:

- Modular components
- Clear naming conventions
- Event-based architecture

Example:
```javascript
// assets/js/components/product-card.js
class ProductCard {
    constructor(productData) {
        this.product = productData;
    }
    
    render() {
        // Return HTML element
    }
}
```

### CSS Organization

- `style.css` - Global styles
- `marketplace.css` - Marketplace specific
- `neumorphic.css` - Design system

Use Tailwind CSS utilities for rapid development.

## Database Development

### Schema Changes

1. Create migration file:
   ```
   migrations/001_initial_schema.sql
   ```

2. Update tables as needed

3. Test thoroughly

### Query Best Practices

Always use prepared statements:

```php
// Good - Safe from SQL injection
$stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();

// Bad - Vulnerable to SQL injection
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $connection->query($query);
```

## Testing

### Run Tests

```bash
composer test
```

### Generate Coverage Report

```bash
composer test-coverage
```

### Write Tests

Create test files in `tests/` following this structure:

```php
<?php

namespace Eunoiaverse\Tests;

use Eunoiaverse\Auth\Authentication;
use PHPUnit\Framework\TestCase;

class AuthenticationTest extends TestCase
{
    public function testRegister()
    {
        // Test implementation
    }
}
```

## Code Standards

### PHP Style Guide

- Follow PSR-12 coding standards
- Use type hints where possible
- Write comprehensive docblocks
- Keep methods focused and small

### JavaScript Style

- Use modern ES6+ syntax
- Clear variable naming
- Proper error handling
- Comments for complex logic

### CSS

- Use semantic class names
- Follow BEM naming convention (when not using Tailwind)
- Organize by component
- Document custom properties

## Git Workflow

### Before Committing

1. Run tests: `composer test`
2. Check code style
3. Test in browser

### Commit Messages

Use clear, descriptive commit messages:

```
feat: Add product search functionality
fix: Correct wallet balance calculation
docs: Update installation guide
style: Format code to PSR-12 standards
test: Add authentication tests
refactor: Simplify database connection logic
```

### Branch Strategy

```
main (production ready)
├── develop (development)
    ├── feature/new-feature
    ├── bugfix/issue-name
    └── docs/documentation-updates
```

## Debugging

### PHP Debugging

1. Enable error reporting in `service/database.php`:
   ```php
   error_reporting(E_ALL);
   ini_set('display_errors', '1');
   ```

2. Use var_dump or print_r for inspection:
   ```php
   var_dump($variable);
   error_log(json_encode($data));
   ```

3. Check server logs

### JavaScript Debugging

1. Open Developer Tools (F12)
2. Check Console tab for errors
3. Use Network tab for API calls
4. Set breakpoints in Sources tab

### Database Debugging

Use phpMyAdmin or MySQL CLI:
```bash
mysql -u root -p eunoiaverse_db
SHOW TABLES;
SELECT * FROM users LIMIT 5;
```

## Performance Optimization

### Caching

- Implement database result caching
- Cache frequently accessed products
- Use browser caching headers

### Database Optimization

- Add proper indexes
- Use EXPLAIN for query analysis
- Optimize N+1 queries

### Frontend Optimization

- Minify CSS and JavaScript
- Optimize images
- Use lazy loading
- Bundle assets

## Deployment

### Prepare for Production

1. Update database credentials
2. Disable debugging/error display
3. Set proper file permissions
4. Run tests
5. Generate production build

### Environment Configuration

Use environment variables:

```php
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'root';
$db_pass = getenv('DB_PASS') ?: '';
```

## Common Tasks

### Add New Feature

1. Create feature branch
2. Implement functionality
3. Write tests
4. Update documentation
5. Submit pull request

### Fix Bug

1. Create bugfix branch
2. Reproduce issue
3. Fix root cause
4. Add test case
5. Verify fix

### Update Dependencies

```bash
composer update
composer update --lock
```

## Useful Commands

```bash
# Install dependencies
composer install

# Update dependencies
composer update

# Run tests
composer test

# Generate test coverage
composer test-coverage

# Development server
php -S localhost:8080

# Check syntax
php -l <filename>       # Check single file
find . -name "*.php" -exec php -l {} \;  # Check all PHP files
```

## Resources

- [Composer Documentation](https://getcomposer.org/doc/)
- [PHP Manual](https://www.php.net/manual/)
- [PHPUnit Documentation](https://phpunit.de/)
- [PSR-12 Coding Standards](https://www.php-fig.org/psr/psr-12/)
- [Tailwind CSS](https://tailwindcss.com/)

## Getting Help

- Check existing documentation
- Review code examples
- Search issue tracker
- Contact team: team@eunoiaverse.local

---

**Happy Coding!** ✨
