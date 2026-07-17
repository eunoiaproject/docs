@echo off
REM Quick Setup Script for Windows
REM Eunoiaverse Project Setup

echo.
echo ╔═══════════════════════════════════════════╗
echo ║     Eunoiaverse Quick Setup (Windows)     ║
echo ╚═══════════════════════════════════════════╝
echo.

REM Check if composer is installed
composer --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Composer not found. Please install Composer first.
    echo    Visit: https://getcomposer.org/download/
    pause
    exit /b 1
)

for /f "tokens=*" %%A in ('composer --version') do set COMPOSER_VERSION=%%A
echo ✓ Found %COMPOSER_VERSION%
echo.

REM Step 1: Install dependencies
echo 📦 Step 1: Installing Composer dependencies...
call composer install --quiet
if errorlevel 1 (
    echo ❌ Failed to install dependencies
    pause
    exit /b 1
)
echo ✓ Dependencies installed
echo.

REM Step 2: Create .env file
echo ⚙️  Step 2: Creating .env configuration...
if not exist .env (
    copy .env.example .env
    echo ✓ Created .env (edit with your database credentials)
) else (
    echo ✓ .env already exists
)
echo.

REM Step 3: Validate setup
echo 🔍 Step 3: Validating setup...
php bin/validate.php
echo.

REM Step 4: Setup database
set /p SETUP_DB="🗄️  Step 4: Create database now? (y/n): "
if /i "%SETUP_DB%"=="y" (
    php bin/setup-db.php
)
echo.

REM Step 5: Summary
echo.
echo ╔═══════════════════════════════════════════╗
echo ║     ✅ Setup Complete!                     ║
echo ╚═══════════════════════════════════════════╝
echo.
echo Next steps:
echo.
echo 1. Edit .env with your database credentials:
echo    notepad .env
echo.
echo 2. Start the development server:
echo    php -S localhost:8080
echo.
echo 3. Open in browser:
echo    start http://localhost:8080
echo.
echo For more help, see: BUILD.md
echo.
pause
