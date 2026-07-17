# Profile Page Documentation

## Overview

The Profile Page is a comprehensive user profile management system that allows users to view and edit their personal information, manage security settings, customize preferences, and access their account history.

## Features

### 1. Profile Header Section
- **Avatar Display** - Visual profile avatar with initials/image
- **User Information** - Name, username, and bio
- **Verification Badge** - Shows verified status
- **Join Date** - Account creation date
- **Edit Profile Button** - Quick access to edit mode

### 2. Statistics Dashboard
- **Total Purchases** - Number of completed purchases
- **Total Spent** - Sum of all purchase amounts
- **Wallet Balance** - Current account wallet balance
- **Member Status** - Current membership tier
-

### 3. Tab Navigation

#### Overview Tab
- Recent transaction history
- Transaction details (amount, date, status)
- Wishlist preview
- Quick action buttons

#### Personal Info Tab
- **Edit Mode** - Toggle between view and edit modes
- **Full Name** - User's complete name
- **Email Address** - Contact email
- **Phone Number** - Contact phone
- **Address** - Street address
- **City** - City of residence
- **Country** - Country of residence
- **Bio** - Personal biography (500 character limit)
- **Character Counter** - Real-time character count for bio
- **Save/Cancel Buttons** - Control editing

#### Security Tab
- **Change Password**
  - Current password verification
  - New password input
  - Password strength indicator
  - Confirmation password
  - Password visibility toggle
  
- **Two-Factor Authentication**
  - Enable/disable 2FA
  - Setup instructions
  
- **Active Sessions**
  - List of active login sessions
  - Device information
  - Last activity timestamp
  - Device management options

#### Preferences Tab
- **Notifications**
  - Email Notifications toggle
  - Push Notifications toggle
  - SMS Notifications toggle
  
- **Privacy**
  - Public Profile toggle
  - Activity Status toggle
  
- **Theme**
  - Dark Mode
  - Light Mode
  - System Default

### 4. Account Management
- **Danger Zone** - Account deletion section
- **Delete Account** - With confirmation dialog
- **Confirmation Required** - Type "DELETE" to confirm

## Technical Details

### Frontend Files

#### profile.html
- Responsive HTML structure
- Neumorphic design components
- Modal dialogs
- Form inputs with validation

#### assets/js/profile.js
- ProfileManager class for data management
- Tab switching logic
- Form validation and submission
- Password strength checking
- Notification system
- Local storage integration

### Backend Files

#### src/Profile/Profile.php
- Profile class with methods:
  - `getProfile()` - Retrieve user profile
  - `updateProfile()` - Update profile information
  - `changePassword()` - Change user password
  - `getUserStats()` - Get profile statistics
  - `getTransactions()` - Retrieve payment history
  - `enableTwoFactor()` - Setup 2FA
  - `deleteAccount()` - Delete user account
  - `searchUsers()` - Search for other users

#### service/profile.php
- API endpoint handler
- Route request actions to appropriate methods
- Return JSON responses
- Error handling

## Usage Examples

### JavaScript - ProfileManager

```javascript
import { ProfileManager } from './assets/js/profile.js';

// Initialize
const profileManager = new ProfileManager();

// Load user data
const userData = profileManager.userData;
console.log(userData.fullName);

// Update profile
profileManager.updateProfile({
    fullName: 'Jane Doe',
    phone: '08987654321',
    bio: 'Updated bio'
});

// Change password
const result = profileManager.changePassword('oldPass123', 'newPass456');

// Get transactions
const transactions = profileManager.getTransactions(10);

// Format currency
const formatted = ProfileManager.formatCurrency(1500000);
// Output: Rp 1.500.000
```

### HTML - Using Profile Manager

```html
<div id="profileName"><!-- Populated by JS --></div>
<div id="totalPurchases"><!-- Populated by JS --></div>
<input type="text" id="fullName" placeholder="Full name">
<button onclick="savePersonalInfo()">Save Profile</button>
```

### API - Getting User Profile

```bash
curl "http://localhost/eunoiaverse/service/profile.php?action=getProfile&userId=1"
```

Response:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "username": "user",
    "full_name": "John Doe",
    "email": "user@example.com",
    "phone": "08123456789",
    "bio": "My bio"
  },
  "stats": {
    "total_purchases": 5,
    "total_spent": 5500000
  }
}
```

## Data Structure

### User Data Object
```javascript
{
  id: 1,
  username: 'user',
  fullName: 'John Doe',
  email: 'user@example.com',
  phone: '08123456789',
  address: 'Jl. Example',
  city: 'Jakarta',
  country: 'Indonesia',
  bio: 'User bio',
  joinDate: '2026-01-15T10:30:00Z',
  avatar: null,
  stats: {
    totalPurchases: 0,
    totalSpent: 0,
    walletBalance: 500000,
    memberStatus: 'Standard'
  },
  transactions: [],
  wishlist: []
}
```

### Transaction Object
```javascript
{
  id: 1,
  type: 'purchase',           // purchase | topup | transfer
  description: 'Laptop Pro',
  amount: 15000000,
  date: '2026-02-10T10:30:00Z',
  status: 'completed'          // completed | pending | failed
}
```

### Preferences Object
```javascript
{
  emailNotifications: true,
  pushNotifications: true,
  smsNotifications: false,
  publicProfile: false,
  activityStatus: true,
  theme: 'dark'
}
```

## Security Features

### Password Security
- **Minimum Length**: 8 characters
- **Strength Indicator**: Visual feedback on password strength
- **Confirmation**: Password must be confirmed
- **Hashing**: Passwords hashed with bcrypt
- **Current Password Verification**: Required for password changes

### Account Security
- **Login Check**: Redirects to login if not authenticated
- **Session Management**: Logout functionality
- **Two-Factor Authentication**: Optional 2FA setup
- **Account Deletion Confirmation**: Requires typing "DELETE"

### Data Protection
- **HTTPS Recommended**: For production deployments
- **CORS Headers**: Controlled cross-origin requests
- **Input Validation**: Server-side validation
- **SQL Injection Prevention**: Prepared statements

## Form Validation

### Personal Information Validation
```javascript
// Email format
/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)

// Phone format
/^\d{10,15}$/.test(phone)

// Name not empty
if (!fullName.trim()) throw new Error('Name required')

// Bio length
if (bio.length > 500) throw new Error('Bio too long')
```

### Password Validation
```javascript
// Minimum length
if (password.length < 8) throw new Error('Min 8 characters')

// Match confirmation
if (newPassword !== confirmPassword) 
  throw new Error('Passwords dont match')

// Not matching current
if (currentPassword === newPassword) 
  throw new Error('Use different password')
```

## Styling

### CSS Classes Used
- `.neu-flat` - Raised neumorphic effect
- `.neu-inset` - Inset neumorphic effect
- `.profile-tab` - Tab button styling
- `.tab-pane` - Tab content container
- `.tab-content` - Tab content wrapper

### Color Palette
- **Primary**: Emerald (#056e58)
- **Background**: Neutral-800 (#171717)
- **Text**: Neutral-100-500
- **Accents**: Red (errors), Yellow (warnings), Green (success), Blue (info)

## Accessibility

- **Semantic HTML**: Uses proper HTML5 tags
- **ARIA Labels**: Important elements labeled
- **Skip Links**: Navigation shortcuts
- **Keyboard Navigation**: Tab through form fields
- **Color Contrast**: WCAG AA compliant
- **Focus Indicators**: Visible focus states

## Performance

### Optimization Techniques
- **Local Storage**: Cache user data locally
- **Lazy Loading**: Load data on-demand
- **Debouncing**: Character counter updates
- **Event Delegation**: Single event listener for multiple elements
- **CSS Transitions**: GPU-accelerated animations

### Load Times
- Initial Load: < 2 seconds
- Data Updates: < 500ms
- API Responses: < 1 second

## Browser Support

- Chrome/Edge: Latest 2 versions
- Firefox: Latest 2 versions
- Safari: Latest 2 versions
- Mobile browsers: iOS 12+, Android 8+

## Known Limitations

1. **2FA**: Currently placeholder, not fully implemented
2. **File Uploads**: Avatar upload not yet implemented
3. **Social Links**: Social media profiles not integrated
4. **Email Verification**: Email verification not required
5. **Rate Limiting**: Not implemented on API

## Future Enhancements

- [ ] Avatar upload with image cropping
- [ ] Social media profile linking
- [ ] Email verification workflow
- [ ] Two-factor authentication (full implementation)
- [ ] Account recovery options
- [ ] Privacy policy acceptance
- [ ] Terms of service agreement
- [ ] Export account data
- [ ] Download data in PDF
- [ ] Activity log
- [ ] Login history
- [ ] Device management
- [ ] Account linking (multiple accounts)
- [ ] Email change with verification

## Troubleshooting

### Profile not loading
- Clear localStorage
- Check browser console for errors
- Verify login status

### Changes not saving
- Check network connection
- Verify user ID in localStorage
- Check API endpoint accessibility

### Password change failing
- Verify current password is correct
- Check password meets requirements
- Ensure new passwords match

### Form validation errors
- Check all required fields are filled
- Verify email format
- Check phone number format

## Support

For issues or questions about the profile page:
1. Check browser console for error messages
2. Review this documentation
3. Check API responses in Network tab
4. Contact support team

---

**Last Updated**: February 10, 2026
**Version**: 1.0.0
