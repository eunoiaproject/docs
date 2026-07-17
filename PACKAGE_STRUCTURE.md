# Eunoiaverse Library Package Structure

## Package Information

**Package Name:** eunoiaverse/eunoiaverse  
**Type:** PHP Library (Composer)  
**License:** MIT  
**Minimum PHP Version:** 7.4

## Directory Structure

```
eunoiaverse/
├── src/                          # Library source code (PSR-4 autoloadable)
│   ├── Database/
│   │   └── Connection.php         # Database connection handling
│   ├── Auth/
│   │   └── Authentication.php     # User authentication & sessions
│   ├── Marketplace/
│   │   └── Product.php            # Product management
│   ├── Wallet/
│   │   └── Wallet.php             # Wallet & payments
│   └── Helpers/
│       └── functions.php          # Utility helper functions
│
├── src/data/                      # SQL schema files
│
├── examples/                      # Usage examples
│   └── usage.php                  # Example implementations
│
├── tests/                         # Unit tests
│   └── bootstrap.php              # Test configuration
│
├── assets/                        # Frontend assets
│   ├── css/                       # Stylesheets
│   ├── js/                        # JavaScript files
│   │   ├── components/            # React-style components
│   │   └── utils/                 # JavaScript utilities
│   └── img/                       # Images and icons
│
├── layout/                        # HTML layout templates
│   ├── head.html
│   ├── header.html
│   └── footer.html
│
├── service/                       # Service layer
│   └── database.php               # Database configuration
│
├── proposal/                      # Project documentation
│
├── composer.json                  # Composer package definition
├── phpunit.xml                    # PHPUnit configuration
├── README.md                      # Package documentation
├── LICENSE                        # MIT License
└── .gitignore                     # Git ignore rules
```

## Core Classes

### Database\Connection
Handles MySQL database connections with prepared statements for security.

**Key Methods:**
- `connect()` - Establish database connection
- `query($query)` - Execute raw query
- `prepare($query)` - Prepare statement
- `close()` - Close connection

### Auth\Authentication
User authentication, registration, and session management.

**Key Methods:**
- `register($username, $email, $password)` - Register new user
- `login($email, $password)` - Authenticate user
- `getUserById($user_id)` - Get user information
- `emailExists($email)` - Check email availability

### Marketplace\Product
Product management in the marketplace.

**Key Methods:**
- `getAllProducts($limit, $offset)` - List products with pagination
- `getProductById($product_id)` - Get product details
- `searchProducts($search_term)` - Search products
- `createProduct($name, $description, $price, $seller_id)` - Create new product

### Wallet\Wallet
Wallet and payment system.

**Key Methods:**
- `getWallet($user_id)` - Get wallet information
- `getBalance($user_id)` - Get account balance
- `createWallet($user_id)` - Create wallet for user
- `addFunds($user_id, $amount)` - Add funds
- `withdrawFunds($user_id, $amount)` - Withdraw funds
- `recordTransaction(...)` - Record transaction
- `getTransactionHistory($user_id, $limit)` - Get transaction history

## Helper Functions

- `sanitize_input($input)` - Sanitize user input
- `validate_email($email)` - Validate email address
- `validate_password($password)` - Validate password strength
- `format_currency($amount, $currency)` - Format currency
- `get_time_ago($datetime)` - Get human-readable time difference
- `generate_token($length)` - Generate secure random token
- `redirect($url)` - Redirect to URL
- `json_response($data, $status_code)` - Send JSON response

## Installation & Setup

### 1. Install via Composer

```bash
composer require eunoiaverse/eunoiaverse
```

### 2. Configure Database

Edit `service/database.php`:

```php
<?php
$hostname = "localhost";
$user_name = "root";
$user_password = "your_password";
$database_name = "eunoiaverse_db";
?>
```

### 3. Create Database Tables

Run SQL scripts to create required tables:
- `users` - User accounts
- `products` - Marketplace products
- `wallets` - User wallets
- `transactions` - Transaction history

### 4. Autoload the Package

```php
<?php
require 'vendor/autoload.php';

use Eunoiaverse\Database\Connection;
use Eunoiaverse\Auth\Authentication;
use Eunoiaverse\Marketplace\Product;
use Eunoiaverse\Wallet\Wallet;

// Initialize and use...
?>
```

## Usage Examples

### Initialize Components

```php
$db = new Connection('localhost', 'root', 'password', 'eunoiaverse_db');
$connection = $db->connect();

$auth = new Authentication($connection);
$product = new Product($connection);
$wallet = new Wallet($connection);
```

### User Registration

```php
$success = $auth->register('username', 'email@example.com', 'Password123!');
```

### User Login

```php
$user = $auth->login('email@example.com', 'Password123!');
if ($user) {
    $_SESSION['user_id'] = $user['id'];
}
```

### Get Products

```php
$products = $product->getAllProducts(10, 0);
foreach ($products as $item) {
    echo $item['name'] . ' - ' . format_currency($item['price']);
}
```

### Wallet Operations

```php
$wallet->createWallet($user_id);
$wallet->addFunds($user_id, 100.00);
$balance = $wallet->getBalance($user_id);
```

## Testing

Run tests using composer script:

```bash
composer test
```

With coverage report:

```bash
composer test-coverage
```

## Security Features

- Password hashing with bcrypt
- Prepared statements to prevent SQL injection
- Input sanitization
- Email validation
- Password strength validation
- Token generation for secure operations

## Frontend Components

Located in `assets/js/components/`:

- **cart.js** - Shopping cart functionality
- **investment.js** - Investment features
- **payments.js** - Payment processing
- **product-card.js** - Product card component
- **product-feed.js** - Product feed/listing
- **transfer.js** - Fund transfers
- **wallet.js** - Wallet interface

## Documentation

Full documentation available in:
- `README.md` - Main documentation
- `examples/usage.php` - Code examples
- Inline code comments and docblocks

## Contributing

To contribute to Eunoiaverse:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

MIT License - see LICENSE file for details.

## Support

For issues, questions, or suggestions:
- Email: team@eunoiaverse.local
- Website: https://eunoiaverse.local

## Version

**Current Version:** 1.0.0 (Initial Release)

---

**Created:** February 2026  
**Last Updated:** February 9, 2026
