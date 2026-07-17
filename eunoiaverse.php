<?php
/**
 * Eunoiaverse Platform
 * A comprehensive PHP platform for digital content creation, e-commerce marketplace, and wallet management
 * 
 * @package Eunoiaverse
 * @version 1.2.0
 * @author Edo Erpani (CEO), EdoErpani (Lead Developer)
 * @license MIT
 * @link https://github.com/eunoiaproject/eunoiaverse
 */

namespace Eunoiaverse;

// Composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

use Eunoiaverse\Database\Connection;
use Eunoiaverse\Auth\Authentication;
use Eunoiaverse\Marketplace\Product;
use Eunoiaverse\Wallet\Wallet;
use Eunoiaverse\Profile\Profile;

class Application {
    private static $instance;
    private $db;
    private $config;

    private function __construct() {
        $this->loadConfig();
        $this->initializeDatabase();
    }

    /**
     * Get singleton instance
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Load application configuration
     */
    private function loadConfig() {
        $this->config = [
            'app_name' => 'Eunoiaverse',
            'version' => '1.2.0',
            'debug' => getenv('APP_DEBUG') ?? false,
            'timezone' => 'Asia/Jakarta',
            'currency' => 'IDR',
        ];
        
        date_default_timezone_set($this->config['timezone']);
    }

    /**
     * Initialize database connection
     */
    private function initializeDatabase() {
        try {
            $this->db = new Connection(
                getenv('DB_HOST') ?? 'localhost',
                getenv('DB_USER') ?? 'root',
                getenv('DB_PASS') ?? '',
                getenv('DB_NAME') ?? 'eunoiaverse_db'
            );
        } catch (\Exception $e) {
            die('Failed to initialize database: ' . $e->getMessage());
        }
    }

    /**
     * Get database connection
     */
    public function getDatabase() {
        return $this->db;
    }

    /**
     * Get authentication service
     */
    public function getAuthService() {
        return new Authentication($this->db->getConnection());
    }

    /**
     * Get marketplace service
     */
    public function getMarketplaceService() {
        return new Product($this->db->getConnection());
    }

    /**
     * Get wallet service
     */
    public function getWalletService() {
        return new Wallet($this->db->getConnection());
    }

    /**
     * Get profile service
     */
    public function getProfileService($userId) {
        return new Profile($this->db->getConnection(), $userId);
    }

    /**
     * Get configuration
     */
    public function getConfig($key = null) {
        if ($key === null) {
            return $this->config;
        }
        return $this->config[$key] ?? null;
    }

    /**
     * Application entry point
     */
    public function run() {
        // Route handling logic would go here
        return [
            'status' => 'running',
            'version' => $this->config['version'],
            'message' => 'Eunoiaverse application is running successfully'
        ];
    }
}

// Export for use in index files
return Application::class;
?>