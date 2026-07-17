# Eunoiaverse - Complete Documentation

## Table of Contents

1. [Project Overview](#project-overview)
2. [Getting Started](#getting-started)
3. [Architecture](#architecture)
4. [Features](#features)
5. [API Reference](#api-reference)
6. [Components](#components)
7. [File Structure](#file-structure)
8. [Developer Guide](#developer-guide)

---

## Project Overview

**Eunoiaverse** is a comprehensive e-commerce and digital wallet platform with modern neumorphic design. It provides users with the ability to browse products, manage their wallets, handle investments, and maintain detailed user profiles.

### Key Statistics
- **Language**: PHP, JavaScript, HTML, CSS
- **Framework**: Tailwind CSS, Custom Components
- **Database**: MySQL
- **Design Pattern**: Neumorphic UI
- **Theme**: Dark Mode
- **Primary Color**: Emerald (#056e58)

---

## Getting Started

### Prerequisites
- XAMPP or similar PHP server
- Modern web browser
- PHP 7.4+
- MySQL 5.7+

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/eunoiaproject/eunoiaverse.git eunoiaverse
   cd eunoiaverse
   ```

2. **Setup database**
   ```bash
   # Import database schema
   mysql -u root < database.sql
   ```

3. **Configure connection**
   - Edit `src/Database/Connection.php`
   - Update database credentials

4. **Start server**
   ```bash
   php -S localhost:8080
   
   # Access application
   http://localhost:8080
   ```

---

## Architecture

### Directory Structure
```
eunoiaverse/
├── assets/                    # Static assets
│   ├── css/
│   │   ├── neumorphic.css    # Neumorphic styles
│   │   ├── style.css         # Global styles
│   │   └── explore.css       # Explore page styles
│   ├── img/                  # Images and icons
│   └── js/
│       ├── components/       # Reusable components
│       │   ├── neumorphic.js # Neumorphic UI components
│       │   ├── cart.js       # Shopping cart
│       │   ├── wallet.js     # Wallet logic
│       │   ├── payments.js   # Payment processing
│       │   └── ...
│       ├── auth.js           # Authentication
│       ├── profile.js        # Profile management
│       └── home.js           # Home page logic
├── src/                      # PHP classes
│   ├── Auth/                 # Authentication
│   │   └── Authentication.php
│   ├── Database/             # Database
│   │   └── Connection.php
│   ├── Profile/              # User profiles
│   │   └── Profile.php
│   ├── Wallet/               # Wallet operations
│   │   └── Wallet.php
│   ├── Marketplace/          # Product management
│   │   └── Product.php
│   └── Helpers/              # Helper functions
│       └── functions.php
├── service/                  # API endpoints
│   ├── database.php          # General database operations
│   ├── profile.php           # Profile API
│   ├── wallet.php            # Wallet API
│   └── payments.php          # Payment API
├── layout/                   # Reusable templates
│   ├── header.html
│   ├── footer.html
│   └── head.html
├── tests/                    # Unit tests
├── profile.html              # User profile page
├── login.html                # Login page
├── register.html             # Registration page
├── index.html                # Home page
├── wallet.html               # Wallet page
├── marketplace.html          # Marketplace page
└── README.md                 # Project readme
```

---

## Features

### 1. Authentication System
- User registration and login
- Session management
- Password hashing with bcrypt
- Secure login state tracking

**File**: `assets/js/auth.js`, `src/Auth/Authentication.php`

### 2. User Profile Management
- Complete profile editing
- Personal information management
- Security settings
- User preferences
- Account deletion

**File**: `profile.html`, `assets/js/profile.js`, `src/Profile/Profile.php`

### 3. Wallet System
- Balance management
- Transaction history
- Fund transfers
- Promo code support
- Expense tracking

**File**: `wallet.html`, `assets/js/wallet.js`, `src/Wallet/Wallet.php`

### 4. Shopping Cart
- Add/remove items
- Update quantities
- Persistent storage
- Price calculations
- Discount application

**File**: `assets/js/components/cart.js`

### 5. Payment Processing
- Multiple payment methods
- Transaction tracking
- Payment verification
- Receipt generation

**File**: `assets/js/components/payments.js`

### 6. Investment Module
- Investment portfolio management
- Return tracking
- Risk assessment
- Investment history

**File**: `assets/js/components/investment.js`

### 7. Marketplace
- Product listing
- Product details
- Search functionality
- Category filtering
- Rating and reviews

**File**: `marketplace.html`, `assets/js/marketplace.js`, `src/Marketplace/Product.php`

---

## API Reference

### Authentication Endpoints

#### Login
```
POST /service/database.php
{
  "action": "login",
  "username": "user@example.com",
  "password": "password123"
}

Response:
{
  "success": true,
  "user_id": 1,
  "username": "user@example.com",
  "token": "jwt_token_here"
}
```

#### Register
```
POST /service/database.php
{
  "action": "register",
  "username": "newuser",
  "email": "newuser@example.com",
  "password": "password123"
}

Response:
{
  "success": true,
  "user_id": 2,
  "message": "Registration successful"
}
```

### Profile Endpoints

#### Get Profile
```
GET /service/profile.php?action=getProfile&userId=1

Response:
{
  "success": true,
  "data": {
    "id": 1,
    "username": "user",
    "full_name": "John Doe",
    "email": "user@example.com",
    "phone": "08123456789",
    "address": "Jl. Example",
    "city": "Jakarta",
    "country": "Indonesia",
    "bio": "User bio"
  },
  "stats": {
    "total_purchases": 5,
    "total_spent": 5500000,
    "member_since": "2026-01-15"
  }
}
```

#### Update Profile
```
POST /service/profile.php
{
  "action": "updateProfile",
  "userId": 1,
  "fullName": "John Doe",
  "phone": "08123456789",
  "address": "Jl. Example",
  "city": "Jakarta",
  "country": "Indonesia",
  "bio": "Updated bio"
}

Response:
{
  "success": true,
  "message": "Profile updated successfully"
}
```

#### Change Password
```
POST /service/profile.php
{
  "action": "changePassword",
  "userId": 1,
  "currentPassword": "oldPass123",
  "newPassword": "newPass456"
}

Response:
{
  "success": true,
  "message": "Password changed successfully"
}
```

### Wallet Endpoints

#### Get Wallet
```
GET /service/wallet.php?action=getWallet&userId=1

Response:
{
  "success": true,
  "balance": 500000,
  "transactions": [...]
}
```

#### Get Transactions
```
GET /service/wallet.php?action=getTransactions&userId=1&limit=10

Response:
{
  "success": true,
  "transactions": [
    {
      "id": 1,
      "type": "purchase",
      "amount": 100000,
      "description": "Product purchase",
      "date": "2026-02-10",
      "status": "completed"
    }
  ]
}
```

#### Transfer Funds
```
POST /service/wallet.php
{
  "action": "transfer",
  "userId": 1,
  "recipientId": 2,
  "amount": 250000,
  "description": "Transfer to friend"
}

Response:
{
  "success": true,
  "transactionId": "TRX123456",
  "message": "Transfer successful"
}
```

### Product Endpoints

#### Get Products
```
GET /service/database.php?action=getProducts&limit=20&offset=0

Response:
{
  "success": true,
  "products": [
    {
      "id": 1,
      "name": "Laptop Pro",
      "price": 15000000,
      "image": "laptop.jpg",
      "rating": 4.5,
      "reviews": 120,
      "seller": "Tech Store"
    }
  ]
}
```

---

## Components

### Neumorphic Components

Located in `assets/js/components/neumorphic.js`

#### NeuButton
```javascript
const button = new NeuButton({
    text: 'Click Me',
    type: 'raised',        // raised | inset | flat
    size: 'medium',        // small | medium | large
    icon: 'fas fa-check',
    onClick: () => console.log('Clicked')
});
document.body.appendChild(button.render());
```

#### NeuInput
```javascript
const input = new NeuInput({
    label: 'Email',
    placeholder: 'Enter email',
    type: 'email',
    icon: 'fas fa-envelope',
    required: true,
    onChange: (e) => console.log(e.target.value)
});
document.body.appendChild(input.render());
```

#### NeuCard
```javascript
const card = new NeuCard({
    title: 'Card Title',
    icon: 'fas fa-info',
    content: '<p>Card content here</p>',
    footer: '<button>Action</button>',
    inset: false
});
document.body.appendChild(card.render());
```

#### NeuToggle
```javascript
const toggle = new NeuToggle({
    label: 'Enable Feature',
    checked: false,
    onChange: (checked) => console.log(checked)
});
document.body.appendChild(toggle.render());
```

#### NeuBadge
```javascript
const badge = new NeuBadge({
    text: 'Premium',
    type: 'success',  // default | success | warning | error
    size: 'medium'    // small | medium | large
});
document.body.appendChild(badge.render());
```

### JavaScript Components

#### ShoppingCart
```javascript
import { ShoppingCart } from './assets/js/components/cart.js';

const cart = new ShoppingCart();
cart.addItem({id: 1, name: 'Product', price: 100000}, 1);
const total = cart.getCartTotal();
cart.removeItem(1);
```

#### Wallet
```javascript
import { Wallet } from './assets/js/components/wallet.js';

const wallet = new Wallet();
wallet.deposit(200000);
wallet.withdraw(50000);
wallet.getBalance();
```

#### Payment
```javascript
import { Payment } from './assets/js/components/payments.js';

const payment = new Payment();
payment.processPayment(150000, 'credit-card', promoCode);
```

---

## File Structure Details

### CSS Files

#### neumorphic.css
- Defines neumorphic color palette
- Shadow utilities (.neu-flat, .neu-inset)
- Button and input styles
- Animation keyframes
- Scrollbar styling

#### style.css
- Global styles
- Typography
- Layout utilities
- Responsive breakpoints

### JavaScript Files

#### auth.js
- User authentication logic
- Login/register form handling
- Session management
- Token management

#### profile.js
- ProfileManager class
- Profile data loading/saving
- Tab navigation
- Form editing
- Password validation

#### wallet.js
- Wallet operations
- Transaction management
- Balance display
- Filter functionality

#### home.js
- Home page initialization
- Story feed
- User feed display
- Navigation

### PHP Files

#### Authentication.php
- User login/registration
- Password hashing
- Session creation
- Token generation

#### Profile.php
- Profile retrieval
- Profile updates
- Password change
- Statistics calculation
- Account deletion

#### Wallet.php
- Balance management
- Transaction recording
- Fund transfers
- Promo validation

#### Product.php
- Product listing
- Category filtering
- Search functionality
- Rating management

---

## Developer Guide

### Adding a New Page

1. **Create HTML file**
   ```html
   <!DOCTYPE html>
   <html lang="en-ID">
   <head>
       <link rel="stylesheet" href="assets/css/neumorphic.css">
       <script src="assets/js/newpage.js" defer></script>
   </head>
   <body>
       <!-- Content -->
   </body>
   </html>
   ```

2. **Create JavaScript logic** in `assets/js/newpage.js`

3. **Add to navigation** in header/footer

### Adding a New Component

1. **Create component class** in `assets/js/components/newcomponent.js`
   ```javascript
   class NewComponent {
       constructor(options = {}) {
           this.options = options;
       }
       
       render() {
           const element = document.createElement('div');
           // Component logic
           return element;
       }
   }
   export { NewComponent };
   ```

2. **Add to COMPONENT_LIBRARY.js** for documentation

3. **Use in pages**
   ```javascript
   import { NewComponent } from './assets/js/components/newcomponent.js';
   const component = new NewComponent(options);
   ```

### API Endpoint Creation

1. **Create service file** in `service/newservice.php`

2. **Implement actions**
   ```php
   switch ($action) {
       case 'getData':
           // handler logic
           break;
   }
   ```

3. **Return JSON response**
   ```php
   echo json_encode([
       'success' => true,
       'data' => $data
   ]);
   ```

### Database Queries

Always use prepared statements:

```php
$stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
```

### Error Handling

Use try-catch blocks:

```javascript
try {
    const response = await fetch('/service/endpoint.php');
    const data = await response.json();
    if (!data.success) throw new Error(data.message);
} catch (error) {
    console.error('Error:', error);
    showNotification(error.message, 'error');
}
```

---

## Best Practices

### Code Style
- Use camelCase for variables and functions
- Use PascalCase for classes
- Use kebab-case for CSS classes
- Add JSDoc comments for functions

### Security
- Always hash passwords with bcrypt
- Use prepared statements for SQL
- Validate input on both client and server
- Sanitize output to prevent XSS
- Use HTTPS in production

### Performance
- Minimize HTTP requests
- Cache API responses in localStorage
- Lazy load images
- Minify CSS and JavaScript
- Use CSS Grid/Flexbox for layouts

### Accessibility
- Use semantic HTML
- Add ARIA labels
- Ensure keyboard navigation
- Use sufficient color contrast
- Add alt text to images

---

## Troubleshooting

### Database Connection Issues
- Check database credentials in `Connection.php`
- Ensure MySQL server is running
- Verify database exists

### Authentication Issues
- Clear localStorage and refresh
- Check browser console for errors
- Verify token expiration

### Component Not Rendering
- Check browser console for errors
- Verify CSS file is loaded
- Ensure JavaScript is not blocked

### API Errors
- Check network tab in browser DevTools
- Verify endpoint URL is correct
- Check request parameters
- Review server error logs

---

## Contributing

1. Create a new branch: `git checkout -b feature/feature-name`
2. Make changes and commit: `git commit -m "Add feature"`
3. Push to branch: `git push origin feature/feature-name`
4. Submit pull request

---

## License

This project is licensed under the MIT License - see LICENSE file for details.

---

## Support

For issues and questions:
1. Check existing documentation
2. Review API reference
3. Check browser console for errors
4. Contact development team

---

**Last Updated**: February 10, 2026
**Version**: 1.0.0
