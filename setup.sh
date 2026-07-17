#!/bin/bash
# Quick Setup Script for Eunoiaverse
# Runs on Linux/Mac, use individual commands on Windows

set -e  # Exit on error

echo "╔═══════════════════════════════════════════╗"
echo "║     Eunoiaverse Quick Setup Script         ║"
echo "╚═══════════════════════════════════════════╝"
echo ""

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "❌ Composer not found. Please install Composer first."
    echo "   Visit: https://getcomposer.org/download/"
    exit 1
fi

echo "✓ Found Composer version: $(composer --version | head -1)"
echo ""

# Step 1: Install dependencies
echo "📦 Step 1: Installing Composer dependencies..."
composer install --quiet
echo "✓ Dependencies installed"
echo ""

# Step 2: Create .env file
echo "⚙️  Step 2: Creating .env configuration..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✓ Created .env (edit with your database credentials)"
else
    echo "✓ .env already exists"
fi
echo ""

# Step 3: Validate setup
echo "🔍 Step 3: Validating setup..."
php bin/validate.php
echo ""

# Step 4: Setup database
read -p "🗄️  Step 4: Create database now? (y/n) " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    php bin/setup-db.php
fi
echo ""

# Step 5: Summary
echo "╔═══════════════════════════════════════════╗"
echo "║     ✅ Setup Complete!                     ║"
echo "╚═══════════════════════════════════════════╝"
echo ""
echo "Next steps:"
echo ""
echo "1. Edit .env with your database credentials:"
echo "   $ nano .env"
echo ""
echo "2. Start the development server:"
echo "   $ php -S localhost:8080"
echo ""
echo "3. Open in browser:"
echo "   $ open http://localhost:8080"
echo ""
echo "For more help, see: BUILD.md"
