<?php

require_once PROTECTED_PATH . '/components/config/ApplicationConfig.php';

class Yii extends YiiBase {
    /**
     * @param null $config
     * @param null $env
     * @return MyWebApplication
     */
    public static function createWebApplication($config = null, $env = null) {
        if (is_null($config)) $config = 'main';
        require_once PROTECTED_PATH .'/components/MyWebApplication.php';
        return new MyWebApplication($config, $env);
    }

    /**
     * @return MyWebApplication
     */
    public static function createConsoleApplication($config = null, $env = null) {
        if (is_null($config)) $config = 'console';
        require_once PROTECTED_PATH .'/components/MyConsoleApplication.php';
        return new MyConsoleApplication($config, $env);
    }

    /**
     * @return MyWebApplication
     */
    public static function app() {
        return parent::app();
    }
}