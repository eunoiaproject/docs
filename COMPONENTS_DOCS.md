# Neumorphic Components Documentation

## Overview

Neumorphic Components is a modern UI component library featuring soft, minimal design with subtle shadows and inset effects. All components are built with Tailwind CSS and vanilla JavaScript, making them lightweight and easy to integrate.

## Color Palette

### Neumorphic Colors
```css
--bg-color: #ffffff;        /* Main background */
--primary: #05a4af;         /* Primary color */
--secondary: #13ac92;       /* Secondary background */
--sh-dark: #0a0a0a;         /* Dark shadow */
--sh-light: #cdcdcd;        /* Light shadow */
--accent: #056e58;          /* Emerald accent */
--accent-light: #0fa895;    /* Light accent */
--accent-dark: #043d34;
```

### Semantic Colors
```
Success: #10b981 (Emerald)
Warning: #eab308 (Yellow)
Error: #ef4444 (Red)
Info: #3b82f6 (Blue)
```

## Components

### 1. NeuButton

Creates neumorphic buttons with multiple styles and sizes.

#### Basic Usage
```javascript
const button = new NeuButton({
    text: 'Click Me',
    type: 'raised',
    size: 'medium',
    onClick: () => console.log('Clicked')
});
document.body.appendChild(button.render());
```

#### Options

| Option | Type | Default | Values | Description |
|--------|------|---------|--------|-------------|
| text | string | 'Button' | Any text | Button label |
| type | string | 'raised' | raised, inset, flat | Button style |
| size | string | 'medium' | small, medium, large | Button size |
| icon | string | null | Font Awesome class | Icon class |
| onClick | function | null | Any function | Click handler |
| disabled | boolean | false | true/false | Disable button |

#### Types

**Raised Button** - Outward shadow effect
```javascript
new NeuButton({ type: 'raised' })
```

**Inset Button** - Inward shadow effect
```javascript
new NeuButton({ type: 'inset' })
```

**Flat Button** - Minimal shadow
```javascript
new NeuButton({ type: 'flat' })
```

#### Sizes

**Small**
```javascript
new NeuButton({ size: 'small' })  // px-3 py-1.5 text-sm
```

**Medium**
```javascript
new NeuButton({ size: 'medium' })  // px-6 py-2.5 text-base
```

**Large**
```javascript
new NeuButton({ size: 'large' })  // px-8 py-4 text-lg
```

#### Examples

```javascript
// Button with icon
new NeuButton({
    text: 'Save',
    icon: 'fas fa-save',
    onClick: saveData
})

// Disabled button
new NeuButton({
    text: 'Submit',
    disabled: true
})

// Full trigger
new NeuButton({
    text: 'Create',
    size: 'large',
    type: 'raised',
    icon: 'fas fa-plus'
})
```

---

### 2. NeuInput

Creates neumorphic input fields with labels and icons.

#### Basic Usage
```javascript
const input = new NeuInput({
    label: 'Email',
    placeholder: 'Enter your email',
    type: 'email',
    icon: 'fas fa-envelope'
});
document.body.appendChild(input.render());
```

#### Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| label | string | '' | Input label |
| placeholder | string | '' | Placeholder text |
| type | string | 'text' | Input type (text, email, password, etc) |
| name | string | '' | Input name attribute |
| value | string | '' | Initial value |
| icon | string | null | Font Awesome icon class |
| required | boolean | false | Mark as required |
| onChange | function | null | Change event handler |

#### Input Types

```javascript
// Text input
new NeuInput({ type: 'text', label: 'Username' })

// Email input
new NeuInput({ type: 'email', label: 'Email', icon: 'fas fa-envelope' })

// Password input
new NeuInput({ type: 'password', label: 'Password', icon: 'fas fa-lock' })

// Number input
new NeuInput({ type: 'number', label: 'Age' })

// Date input
new NeuInput({ type: 'date', label: 'Birth Date' })
```

#### Examples

```javascript
// Email with validation
new NeuInput({
    label: 'Email Address',
    placeholder: 'you@example.com',
    type: 'email',
    icon: 'fas fa-envelope',
    required: true,
    onChange: (e) => validateEmail(e.target.value)
})

// Phone with formatting
new NeuInput({
    label: 'Phone Number',
    placeholder: '08123456789',
    type: 'tel',
    icon: 'fas fa-phone',
    onChange: (e) => formatPhoneNumber(e)
})

// Search field
new NeuInput({
    label: 'Search',
    placeholder: 'Type to search...',
    type: 'text',
    icon: 'fas fa-search'
})
```

---

### 3. NeuCard

Creates neumorphic cards for content containers.

#### Basic Usage
```javascript
const card = new NeuCard({
    title: 'Card Title',
    icon: 'fas fa-info',
    content: '<p>Card content here</p>',
    footer: '<button>Action</button>'
});
document.body.appendChild(card.render());
```

#### Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| title | string | '' | Card title |
| content | string/HTML | '' | Card content |
| icon | string | null | Title icon |
| footer | string/HTML | null | Card footer |
| inset | boolean | false | Inset effect |
| padding | string | 'p-6' | Tailwind padding class |

#### Examples

```javascript
// Profile card
new NeuCard({
    title: 'Profile Information',
    icon: 'fas fa-user',
    content: `
        <div class="space-y-2">
            <p><strong>Name:</strong> John Doe</p>
            <p><strong>Email:</strong> john@example.com</p>
        </div>
    `,
    footer: '<button class="text-emerald-500">Edit Profile</button>'
})

// Stats card
new NeuCard({
    title: 'Statistics',
    icon: 'fas fa-chart-bar',
    content: `
        <div class="text-2xl font-bold text-emerald-500">1,234</div>
        <p class="text-sm text-neutral-400">Total Views</p>
    `,
    inset: true
})

// Inset card (sunken effect)
new NeuCard({
    title: 'Messages',
    content: 'No new messages',
    inset: true,
    padding: 'p-8'
})
```

---

### 4. NeuContainer

Creates flexible neumorphic containers for layout.

#### Basic Usage
```javascript
const container = new NeuContainer({
    children: [
        '<h2>Title</h2>',
        '<p>Content here</p>'
    ],
    layout: 'flex flex-col gap-4'
});
document.body.appendChild(container.render());
```

#### Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| children | array | [] | Child elements (strings or HTML) |
| layout | string | 'flex flex-col gap-4' | Tailwind layout classes |
| inset | boolean | false | Inset effect |
| padding | string | 'p-6' | Tailwind padding |

#### Layout Examples

```javascript
// Column layout
new NeuContainer({
    layout: 'flex flex-col gap-4',
    children: ['<div>Item 1</div>', '<div>Item 2</div>']
})

// Row layout
new NeuContainer({
    layout: 'flex flex-row gap-4',
    children: ['<div>Left</div>', '<div>Right</div>']
})

// Grid layout
new NeuContainer({
    layout: 'grid grid-cols-2 gap-4',
    children: ['<div>1</div>', '<div>2</div>', '<div>3</div>', '<div>4</div>']
})

// Centered layout
new NeuContainer({
    layout: 'flex items-center justify-center',
    children: ['<div>Centered</div>']
})
```

---

### 5. NeuToggle

Creates neumorphic toggle switches.

#### Basic Usage
```javascript
const toggle = new NeuToggle({
    label: 'Enable Feature',
    checked: false,
    onChange: (value) => console.log('Toggle:', value)
});
document.body.appendChild(toggle.render());
```

#### Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| label | string | '' | Toggle label |
| checked | boolean | false | Initial state |
| name | string | '' | Input name |
| onChange | function | null | Change handler |

#### Examples

```javascript
// Simple toggle
new NeuToggle({
    label: 'Dark Mode'
})

// Checked toggle
new NeuToggle({
    label: 'Notifications',
    checked: true
})

// Toggle with handler
new NeuToggle({
    label: 'Email Alerts',
    onChange: (value) => {
        localStorage.setItem('emailAlerts', value);
        updateSettings();
    }
})
```

---

### 6. NeuBadge

Creates neumorphic badges and labels.

#### Basic Usage
```javascript
const badge = new NeuBadge({
    text: 'Premium',
    type: 'success',
    size: 'medium'
});
document.body.appendChild(badge.render());
```

#### Options

| Option | Type | Default | Values | Description |
|--------|------|---------|--------|-------------|
| text | string | 'Badge' | Any text | Badge text |
| type | string | 'default' | default, success, warning, error | Badge style |
| size | string | 'medium' | small, medium, large | Badge size |

#### Types

**Default** - Neutral style
```javascript
new NeuBadge({ type: 'default' })
```

**Success** - Green background
```javascript
new NeuBadge({ type: 'success', text: 'Verified' })
```

**Warning** - Yellow background
```javascript
new NeuBadge({ type: 'warning', text: 'Pending' })
```

**Error** - Red background
```javascript
new NeuBadge({ type: 'error', text: 'Failed' })
```

#### Examples

```javascript
// Status badges
new NeuBadge({ text: 'Active', type: 'success' })
new NeuBadge({ text: 'Inactive', type: 'warning' })
new NeuBadge({ text: 'Declined', type: 'error' })

// Tag badges
new NeuBadge({ text: 'JavaScript', type: 'default', size: 'small' })
new NeuBadge({ text: 'UI Design', type: 'default', size: 'small' })

// Large badges
new NeuBadge({ text: 'NEW', type: 'success', size: 'large' })
```

---

## Complete Example

```html
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/neumorphic.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div id="app"></div>
    
    <script type="module">
        import { 
            NeuButton, NeuInput, NeuCard, 
            NeuContainer, NeuToggle, NeuBadge 
        } from './assets/js/components/neumorphic.js';

        // Create form
        const container = new NeuContainer({
            children: [
                '<h2 class="text-2xl font-bold mb-4">Contact Form</h2>',
                new NeuInput({
                    label: 'Name',
                    placeholder: 'Your name',
                    icon: 'fas fa-user'
                }).render(),
                new NeuInput({
                    label: 'Email',
                    type: 'email',
                    placeholder: 'your@email.com',
                    icon: 'fas fa-envelope'
                }).render(),
                new NeuToggle({
                    label: 'Subscribe to updates'
                }).render(),
                new NeuButton({
                    text: 'Submit',
                    type: 'raised',
                    size: 'large',
                    onClick: () => alert('Form submitted!')
                }).render()
            ]
        });

        document.getElementById('app').appendChild(container.render());
    </script>
</body>
</html>
```

## Styling API

### CSS Variables

Use CSS custom properties to customize colors:

```css
:root {
    --bg-color: #171717;
    --sh-dark: #0a0a0a;
    --sh-light: #cdcdcd;
    --accent: #056e58;
}
```

### Shadow Utilities

```css
.neu-flat {
    box-shadow: 8px 8px 16px var(--sh-dark), 
                -8px -8px 16px var(--sh-light);
}

.neu-inset {
    box-shadow: inset 6px 6px 12px var(--sh-dark), 
                inset -6px -6px 12px var(--sh-light);
}
```

## Best Practices

1. **Consistency** - Use same size and type throughout app
2. **Accessibility** - Always include labels for inputs
3. **Performance** - Minimize component creation in loops
4. **Responsiveness** - Test on multiple screen sizes
5. **Validation** - Handle user input on both sides
6. **Feedback** - Provide visual feedback for actions

## Browser Support

- Chrome/Edge: Latest 2 versions
- Firefox: Latest 2 versions
- Safari: Latest 2 versions
- Mobile: iOS 12+, Android 8+

## Performance

All components are lightweight and optimized:
- Minimal DOM manipulation
- Efficient event handling
- CSS-based animations
- No external dependencies (except Font Awesome)

---

**Last Updated**: February 10, 2026
**Version**: 1.0.0
