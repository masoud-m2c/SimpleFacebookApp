<?php
namespace App\Config;

class Facebook {
    /*
     * Configuration and setup Facebook SDK
     */
    private static $appId = '216402475516805';
    private static $appSecret = '01eb295d66f4352a02f4e3f78c14b6c3';
    private static $baseUrl = 'http://localhost/simplefacebookapp/';
    private static $callbackLoginPage = 'login-callback.php';
    private static $instance;
 
    /**
     * @return Facebook object
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new \Facebook\Facebook([
                'app_id' => self::$appId,
                'app_secret' => self::$appSecret,
                'default_graph_version' => 'v2.9',
                'persistent_data_handler' => 'session'
            ]);
        }
        return self::$instance;
    }

    /**
     * @return string
     */
    public static function getAppSecret() {
        return self::$appSecret;
    }

    /**
     * @return string
     */
    public static function getBaseUrl() {
        return self::$baseUrl;
    }

    /**
     * @return string
     */
    public static function getCustomLoginUrl() {
        return self::getBaseUrl().self::$callbackLoginPage;
    }

    protected function __construct() {
        //
    }

    protected function __clone() {
        //
    }
}
