# Eunoiaverse

A comprehensive PHP library for building the Eunoiaverse platform - a digital content creation, marketplace, and wallet management system.

## Features

- 🎨 **Content Management** - Create and manage digital content
- 🛒 **Marketplace** - Sell and purchase products and services
- 💰 **Wallet System** - Secure payment and wallet management
- 👤 **User Authentication** - Robust user authentication system
- 📱 **Responsive UI** - Mobile-first design with Tailwind CSS
- 🎯 **Product Details** - Rich product pages with detailed information

## Installation

Install via Composer:

```bash
composer require eunoiaverse/eunoiaverse
```

Or clone the repository:

```bash
git clone https://github.com/eunoiaverse/eunoiaverse.git
cd eunoiaverse
composer install
```

## Project Structure

```
eunoiaverse/
├── src/
│   ├── Database/          # Database connection and queries
│   ├── Auth/              # Authentication and authorization
│   ├── Marketplace/       # Marketplace logic
│   ├── Wallet/            # Wallet and payment systems
│   └── Helpers/           # Helper functions and utilities
├── assets/
│   ├── css/               # Stylesheets
│   ├── js/                # JavaScript files and components
│   └── img/               # Images, icons, and logos
├── layout/                # HTML layout components
├── proposal/              # Proposal and documentation files
├── service/               # Service files and database
└── tests/                 # Unit tests
```

## Quick Start

### 1. Environment Setup

It is highly recommended to use environment variables for your database credentials. Create a `.env` file in your project root (and add it to `.gitignore`):

```dotenv
DB_HOST="localhost"
DB_USER="root"
DB_PASS="your_password"
DB_NAME="eunoiaverse.db"
```

The application's database class `src/Database/Connection.php` should be updated to read these variables. If you are not using a library like `vlucas/phpdotenv`, you will need to configure your credentials directly in `src/Database/Connection.php`.

### 2. Authentication

User authentication is handled server-side using PHP sessions for security. The primary authentication scripts are:
- `login.php`: Handles user login.
- `register.php`: Handles new user registration.

```php
session_start(); // Ensure sessions are started
// ... logic in login.php and register.php
```

### 3. Using the Marketplace

Include marketplace components:

```html
<link rel="stylesheet" href="assets/css/marketplace.css">
<script src="assets/js/marketplace.js"></script>
```

## Main Pages

- **index.html** - Home/Dashboard page
- **login.html** - User login
- **register.html** - User registration
- **marketplace.html** - Browse products
- **product-detail.html** - Product information
- **wallet.html** - User wallet and transactions
- **profile.html** - User profile and premium features

## Components

JavaScript components available in `assets/js/components/`:

- `cart.js` - Shopping cart functionality
- `investment.js` - Investment features
- `payments.js` - Payment processing
- `product-card.js` - Product card rendering
- `product-feed.js` - Product feed/listing
- `transfer.js` - Fund transfers
- `wallet.js` - Wallet operations

## Utilities

Helper functions in `assets/js/utils/`:

- `data.js` - Data handling and utilities

## Technologies Used

- **Backend**: PHP 7.4+
- **Frontend**: HTML5, CSS3, Tailwind CSS
- **JavaScript**: Vanilla JS, Font Awesome icons
- **Icons**: Lucide icons, Cool icons
- **Database**: MySQL

## CSS Frameworks & Libraries

- **Tailwind CSS** - Utility-first CSS framework
- **Neumorphic Design** - Modern UI design system
- **Font Awesome** - Icon library

## Usage Examples

### Initialize the Platform

```php
<?php
require 'vendor/autoload.php';

use Eunoiaverse\Database\Connection;
use Eunoiaverse\Auth\Authentication;

// Initialize database
$db = new Connection();
$connection = $db->connect();

// Initialize authentication
$auth = new Authentication($connection);
?>
```

### Create User Account

```javascript
// See auth.js for registration logic
const registerUser = async (email, password, username) => {
    // Validation and API call
};
```

### Marketplace Operations

```javascript
// See marketplace.js for product operations
const fetchProducts = async () => {
    // Fetch product feed
};
```

## API Endpoints

The platform provides RESTful endpoints through the PHP service layer:

- Authentication endpoints
- Product management
- Wallet operations
- Transaction processing

## Testing

Run the test suite:

```bash
composer test
```

With coverage:

```bash
composer test-coverage
```

## Configuration

Key configuration files:

- `service/database.php` - Database credentials
- `assets/css/` - Styling configuration
- `layout/head.html` - Head meta tags and imports

## Security

- User authentication required for main pages
- Session-based access control
- Password hashing for user accounts
- Database prepared statements

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## License

MIT License - see LICENSE file for details

## Contributing

Contributions welcome! Please follow the project structure and coding standards.

## Support

For support, issues, or questions:
- Email: team@eunoiaverse.local
- Website: https://eunoiaverse.local

## Version History

### v1.0.0
- Initial release with core features
- Marketplace implementation
- Wallet system
- User authentication

---

## 📦 JavaScript Component Library

Eunoiaverse includes a modular ES6 component library for frontend development. All components are organized and exportable.

### Available Components

#### **ShoppingCart**
Manages shopping cart operations with localStorage persistence.

```javascript
import { ShoppingCart } from './assets/js/components/cart.js';
const cart = new ShoppingCart();
cart.addItem(product, quantity);
```

#### **WalletManager**
Comprehensive wallet management including balance, transactions, and bank accounts.

```javascript
import { WalletManager } from './assets/js/components/wallet.js';
const wallet = new WalletManager();
const balance = wallet.getBalance();
```

#### **PaymentHandler**
Handles payment processing, fee calculations, and promo codes.

```javascript
import { PaymentHandler } from './assets/js/components/payments.js';
const payment = new PaymentHandler();
const total = payment.calculateTotal(amount, methodId);
```

#### **TransferHandler**
Manages user-to-user and bank transfers with fee calculation.

```javascript
import { TransferHandler } from './assets/js/components/transfer.js';
const transfer = new TransferHandler();
const fee = transfer.calculateTransferFee(amount);
```

#### **InvestmentHandler**
Manages investment products and operations.

```javascript
import { InvestmentHandler } from './assets/js/components/investment.js';
const investment = new InvestmentHandler();
investment.addToInvestmentCart(productId, amount);
```

#### **Product Components**
Create and manage product cards and feeds.

```javascript
import { createProductCard } from './assets/js/components/product-card.js';
import { ProductFeed } from './assets/js/components/product-feed.js';

const card = createProductCard(product);
const feed = new ProductFeed();
feed.init(products);
```

### Import All Components

```javascript
import EunoiaLib from './assets/js/index.js';

// Access all components
const { ShoppingCart, WalletManager, PaymentHandler } = EunoiaLib;
```

### Development Server

```bash
npm install
npm run dev
```

Server runs on `http://localhost:8000`

---

Made with ❤️ by the Eunoiaverse Team
#
