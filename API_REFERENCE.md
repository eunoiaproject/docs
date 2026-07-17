# API Reference - Eunoiaverse Platform

## Overview

All API endpoints return JSON responses with the following structure:

```json
{
  "success": true,
  "data": {},
  "message": "Response message"
}
```

## Base URL
```
http://localhost/eunoiaverse/service/
```

## Authentication Endpoints

### POST /database.php - Login

**Request**
```javascript
fetch('/service/database.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'action=login&username=user@example.com&password=password123'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "login" |
| username | string | Yes | Username or email |
| password | string | Yes | User password |

**Success Response (200)**
```json
{
  "success": true,
  "user_id": 1,
  "username": "user",
  "email": "user@example.com",
  "message": "Login successful"
}
```

**Error Response (401)**
```json
{
  "success": false,
  "message": "Invalid username or password"
}
```

---

### POST /database.php - Register

**Request**
```javascript
fetch('/service/database.php', {
    method: 'POST',
    body: 'action=register&username=newuser&email=user@example.com&password=pass123'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "register" |
| username | string | Yes | Desired username |
| email | string | Yes | User email |
| password | string | Yes | User password (min 8 chars) |

**Success Response (201)**
```json
{
  "success": true,
  "user_id": 2,
  "message": "Registration successful"
}
```

**Error Response (400)**
```json
{
  "success": false,
  "message": "Username already exists"
}
```

---

## Profile Endpoints

### GET /profile.php - Get Profile

**Request**
```
GET /profile.php?action=getProfile&userId=1
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "getProfile" |
| userId | integer | Yes | User ID |

**Success Response**
```json
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
    "bio": "User bio",
    "avatar_url": "https://example.com/avatar.jpg",
    "created_at": "2026-01-15 10:30:00"
  },
  "stats": {
    "total_purchases": 5,
    "total_spent": 5500000,
    "member_since": "2026-01-15",
    "last_purchase": "2026-02-09"
  }
}
```

---

### POST /profile.php - Update Profile

**Request**
```javascript
fetch('/service/profile.php', {
    method: 'POST',
    body: new FormData(document.querySelector('form'))
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "updateProfile" |
| userId | integer | Yes | User ID |
| fullName | string | No | Full name |
| phone | string | No | Phone number |
| address | string | No | Street address |
| city | string | No | City |
| country | string | No | Country |
| bio | string | No | User biography |

**Success Response**
```json
{
  "success": true,
  "message": "Profile updated successfully"
}
```

---

### POST /profile.php - Change Password

**Request**
```javascript
fetch('/service/profile.php', {
    method: 'POST',
    body: 'action=changePassword&userId=1&currentPassword=old&newPassword=new&confirmPassword=new'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "changePassword" |
| userId | integer | Yes | User ID |
| currentPassword | string | Yes | Current password |
| newPassword | string | Yes | New password (min 8 chars) |
| confirmPassword | string | Yes | Password confirmation |

**Success Response**
```json
{
  "success": true,
  "message": "Password changed successfully"
}
```

---

### GET /profile.php - Get Transactions

**Request**
```
GET /profile.php?action=getTransactions&userId=1&limit=10
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "getTransactions" |
| userId | integer | Yes | User ID |
| limit | integer | No | Number of results (default: 10) |

**Success Response**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "type": "purchase",
      "amount": 150000,
      "description": "Product Purchase",
      "status": "completed",
      "created_at": "2026-02-10 10:30:00"
    }
  ]
}
```

---

### POST /profile.php - Enable 2FA

**Request**
```javascript
fetch('/service/profile.php', {
    method: 'POST',
    body: 'action=enableTwoFactor&userId=1'
})
```

**Success Response**
```json
{
  "success": true,
  "secret": "abcd1234efgh5678",
  "message": "2FA enabled successfully"
}
```

---

### POST /profile.php - Delete Account

**Request**
```javascript
fetch('/service/profile.php', {
    method: 'POST',
    body: 'action=deleteAccount&userId=1&password=userpassword'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "deleteAccount" |
| userId | integer | Yes | User ID |
| password | string | Yes | User password for confirmation |

**Success Response**
```json
{
  "success": true,
  "message": "Account deleted successfully"
}
```

---

## Wallet Endpoints

### GET /wallet.php - Get Wallet

**Request**
```
GET /wallet.php?action=getWallet&userId=1
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "getWallet" |
| userId | integer | Yes | User ID |

**Response**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "user_id": 1,
    "balance": 500000,
    "last_updated": "2026-02-10 15:30:00"
  }
}
```

---

### GET /wallet.php - Get Balance

**Request**
```
GET /wallet.php?action=getBalance&userId=1
```

**Response**
```json
{
  "success": true,
  "balance": 500000
}
```

---

### POST /wallet.php - Deposit

**Request**
```javascript
fetch('/service/wallet.php', {
    method: 'POST',
    body: 'action=deposit&userId=1&amount=100000'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "deposit" |
| userId | integer | Yes | User ID |
| amount | number | Yes | Deposit amount |

**Response**
```json
{
  "success": true,
  "message": "Deposit successful",
  "new_balance": 600000
}
```

---

### POST /wallet.php - Withdraw

**Request**
```javascript
fetch('/service/wallet.php', {
    method: 'POST',
    body: 'action=withdraw&userId=1&amount=50000'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "withdraw" |
| userId | integer | Yes | User ID |
| amount | number | Yes | Withdrawal amount |

**Response**
```json
{
  "success": true,
  "message": "Withdrawal successful",
  "new_balance": 450000,
  "transaction_id": "TRX123456"
}
```

---

### POST /wallet.php - Transfer

**Request**
```javascript
fetch('/service/wallet.php', {
    method: 'POST',
    body: 'action=transfer&userId=1&recipientId=2&amount=100000&description=Transfer'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "transfer" |
| userId | integer | Yes | Sender ID |
| recipientId | integer | Yes | Recipient ID |
| amount | number | Yes | Transfer amount |
| description | string | No | Transfer description |

**Response**
```json
{
  "success": true,
  "message": "Transfer successful",
  "transaction_id": "TRX123456",
  "new_balance": 400000
}
```

---

### GET /wallet.php - Get Transactions

**Request**
```
GET /wallet.php?action=getTransactions&userId=1&limit=20&offset=0
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "getTransactions" |
| userId | integer | Yes | User ID |
| limit | integer | No | Results per page (default: 10) |
| offset | integer | No | Pagination offset (default: 0) |

**Response**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "type": "purchase",
      "amount": 100000,
      "description": "Product purchase",
      "status": "completed",
      "from_user_id": 1,
      "to_user_id": null,
      "created_at": "2026-02-10 10:30:00"
    }
  ],
  "total": 50
}
```

---

### POST /wallet.php - Apply Promo Code

**Request**
```javascript
fetch('/service/wallet.php', {
    method: 'POST',
    body: 'action=applyPromo&userId=1&promoCode=SAVE20&amount=100000'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "applyPromo" |
| userId | integer | Yes | User ID |
| promoCode | string | Yes | Promo code |
| amount | number | Yes | Transaction amount |

**Response**
```json
{
  "success": true,
  "discount": 20000,
  "final_amount": 80000,
  "message": "Promo applied successfully"
}
```

---

## Product Endpoints

### GET /database.php - Get Products

**Request**
```
GET /database.php?action=getProducts&limit=20&offset=0&category=electronics
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "getProducts" |
| limit | integer | No | Results per page (default: 10) |
| offset | integer | No | Pagination offset (default: 0) |
| category | string | No | Product category |
| search | string | No | Search query |
| sort | string | No | Sort field (price, rating) |

**Response**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Laptop Pro 15\"",
      "price": 15000000,
      "original_price": 18000000,
      "discount": 17,
      "image": "laptop.jpg",
      "rating": 4.5,
      "reviews": 120,
      "seller": "Tech Store",
      "description": "High-performance laptop",
      "in_stock": true
    }
  ],
  "total": 250
}
```

---

### GET /database.php - Get Product Details

**Request**
```
GET /database.php?action=getProductDetails&productId=1
```

**Response**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Laptop Pro 15\"",
    "price": 15000000,
    "description": "Detailed description",
    "images": ["img1.jpg", "img2.jpg"],
    "rating": 4.5,
    "reviews": [],
    "specifications": {},
    "seller_id": 5
  }
}
```

---

### POST /database.php - Create Review

**Request**
```javascript
fetch('/service/database.php', {
    method: 'POST',
    body: 'action=createReview&userId=1&productId=1&rating=5&comment=Great product'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "createReview" |
| userId | integer | Yes | User ID |
| productId | integer | Yes | Product ID |
| rating | integer | Yes | Rating (1-5) |
| comment | string | Yes | Review comment |

**Response**
```json
{
  "success": true,
  "message": "Review created successfully"
}
```

---

## Payment Endpoints

### POST /payments.php - Process Payment

**Request**
```javascript
fetch('/service/payments.php', {
    method: 'POST',
    body: 'action=processPayment&userId=1&amount=150000&method=credit-card'
})
```

**Parameters**
| Name | Type | Required | Description |
|------|------|----------|-------------|
| action | string | Yes | "processPayment" |
| userId | integer | Yes | User ID |
| amount | number | Yes | Payment amount |
| method | string | Yes | credit-card, bank-transfer, e-wallet |
| promoCode | string | No | Promo code |

**Response**
```json
{
  "success": true,
  "transaction_id": "TRX123456",
  "status": "completed",
  "message": "Payment processed successfully"
}
```

---

## Error Codes

| Code | Message | HTTP Status |
|------|---------|------------|
| AUTH_001 | Invalid credentials | 401 |
| AUTH_002 | User not found | 404 |
| AUTH_003 | Account locked | 403 |
| PROFILE_001 | Profile not found | 404 |
| PROFILE_002 | Invalid password | 400 |
| WALLET_001 | Insufficient balance | 400 |
| WALLET_002 | Transaction failed | 500 |
| PRODUCT_001 | Product not found | 404 |
| PRODUCT_002 | Out of stock | 400 |
| PAYMENT_001 | Payment failed | 400 |
| PAYMENT_002 | Invalid payment method | 400 |

---

## Rate Limiting

- **Limit**: 100 requests per minute per IP
- **Headers**: `X-RateLimit-Limit`, `X-RateLimit-Remaining`

---

## Pagination

Use `limit` and `offset` for pagination:

```javascript
// Get 10 items, skip first 20
GET /service/database.php?action=getProducts&limit=10&offset=20
```

---

## Sorting

Use sort parameter with direction:

```javascript
// Sort by price ascending
GET /service/database.php?action=getProducts&sort=price&direction=asc

// Sort by rating descending
GET /service/database.php?action=getProducts&sort=rating&direction=desc
```

---

## Status Codes

| Code | Meaning |
|------|---------|
| 200 | Success |
| 201 | Created |
| 400 | Bad Request |
| 401 | Unauthorized |
| 403 | Forbidden |
| 404 | Not Found |
| 500 | Server Error |

---

**Last Updated**: February 10, 2026
**API Version**: 1.0.0
