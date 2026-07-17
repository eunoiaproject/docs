-- Eunoiaverse Database Schema
-- MySQL 5.7+

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS eunoiaverse_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE eunoiaverse_db;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    phone VARCHAR(20),
    address VARCHAR(255),
    city VARCHAR(100),
    state VARCHAR(100),
    zip VARCHAR(20),
    country VARCHAR(100),
    bio TEXT,
    avatar_url VARCHAR(255),
    two_factor_enabled BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username)
);

-- Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(15, 2) NOT NULL,
    seller_id INT NOT NULL,
    image_url VARCHAR(255),
    category VARCHAR(100),
    stock INT DEFAULT 0,
    rating DECIMAL(3, 2) DEFAULT 0,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_seller (seller_id),
    INDEX idx_category (category),
    FULLTEXT INDEX ft_search (name, description)
);

-- Wallets Table
CREATE TABLE IF NOT EXISTS wallets (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT UNIQUE NOT NULL,
    balance DECIMAL(15, 2) DEFAULT 0,
    currency VARCHAR(3) DEFAULT 'IDR',
    linked_bank_account VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Transactions Table
CREATE TABLE IF NOT EXISTS transactions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('credit', 'debit') NOT NULL,
    amount DECIMAL(15, 2) NOT NULL,
    description VARCHAR(255),
    reference_id VARCHAR(100),
    status ENUM('pending', 'completed', 'failed') DEFAULT 'completed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user (user_id),
    INDEX idx_created_at (created_at)
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    buyer_id INT NOT NULL,
    seller_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    total_amount DECIMAL(15, 2) NOT NULL,
    status ENUM('pending', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (buyer_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    INDEX idx_buyer (buyer_id),
    INDEX idx_seller (seller_id)
);

-- Promo Codes Table
CREATE TABLE IF NOT EXISTS promo_codes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    code VARCHAR(50) UNIQUE NOT NULL,
    discount_percent DECIMAL(5, 2),
    discount_amount DECIMAL(15, 2),
    max_uses INT,
    used_count INT DEFAULT 0,
    expiry_date DATE,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Cart Table (for persistent storage)
CREATE TABLE IF NOT EXISTS cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_cart_item (user_id, product_id)
);

-- Sessions Table (optional, for session management)
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(100) PRIMARY KEY,
    user_id INT,
    data LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert sample users (optional)
INSERT IGNORE INTO users (username, email, password, first_name, last_name) VALUES
('admin', 'admin@eunoiaverse.local', '$2y$10$5n9yNqmEYv2D.PJqFN2KO.YZbB5XD1pLvVqvvJ9Wh7J4p3z9Z9XxC', 'Admin', 'User'),
('testuser', 'test@eunoiaverse.local', '$2y$10$5n9yNqmEYv2D.PJqFN2KO.YZbB5XD1pLvVqvvJ9Wh7J4p3z9Z9XxC', 'Test', 'User');

-- Insert sample products (optional)
INSERT IGNORE INTO products (name, description, price, seller_id, category) VALUES
('Sample Product 1', 'This is a sample product for testing', 50000, 1, 'Electronics'),
('Sample Product 2', 'Another sample product', 75000, 2, 'Accessories');

-- Create wallets for sample users
INSERT IGNORE INTO wallets (user_id, balance) VALUES (1, 1000000), (2, 500000);
