# Eunoiaverse - Installation & Quick Start Guide

## System Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Composer (for dependency management)
- Apache/Nginx web server

## Installation Steps

### 1. Install Dependencies

Navigate to the project root and run:

```bash
composer install
```

### 2. Database Setup

1. Create a new MySQL database:

```sql
CREATE DATABASE eunoiaverse.db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Create required tables:

```sql
-- Users Table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Products Table
CREATE TABLE products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    seller_id INT NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES users(id)
);

-- Wallets Table
CREATE TABLE wallets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE NOT NULL,
    balance DECIMAL(15, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Transactions Table
CREATE TABLE transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('credit', 'debit') NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    description VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 3. Configure Database Connection

1.  **Copy the example environment file:**
    ```bash
    cp .env.example .env
    ```

2.  **Edit the `.env` file** with your database credentials. This file is ignored by Git for security.
    ```dotenv
    DB_HOST="localhost"
    DB_USER="root"
    DB_PASS="your_password"
    DB_NAME="eunoiaverse_db"
    ```

### 4. Web Server Configuration

#### For Apache:

Create `.htaccess` in the root directory:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /eunoiaverse/
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.html [QSA,L]
</IfModule>
```

#### For Nginx:

```nginx
location / {
    if (!-e $request_filename) {
        rewrite ^(.*)$ /index.html break;
    }
}
```

## First Run

1. Open your browser and navigate to:
   ```
   http://localhost/eunoiaverse
   ```

2. You should see the login page

3. Click "Register" to create a new account

4. Log in with your credentials

## File Locations

- **Main HTML files** - Root directory
- **JavaScript** - `assets/js/`
- **CSS Styles** - `assets/css/`
- **Images** - `assets/img/`
- **PHP Backend** - `service/`
- **PHP Library** - `src/`

## Running Tests

```bash
composer test
```

## Troubleshooting

### Database Connection Error

- Verify MySQL is running
- Check credentials in `service/database.php`
- Ensure database exists

### Login Redirect Loop

- Clear browser cookies and cache
- Check database `users` table exists
- Verify JavaScript is enabled

### 404 on Sub-pages

- Check web server rewrite rules
- Ensure directory structure is intact

## Next Steps

1. Review `PACKAGE_STRUCTURE.md` for detailed architecture
2. Check `examples/usage.php` for code examples
3. Explore `src/` directory for available classes
4. Read inline documentation in source files

## Support

- Check README.md for documentation
- Review code examples in `examples/`
- Check error logs in browser console (F12)

---

**For more information, see README.md and PACKAGE_STRUCTURE.md**
