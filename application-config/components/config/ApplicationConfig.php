<?php

require_once PROTECTED_PATH . '/components/config/ConfigCache.php';

class ApplicationConfig {

    private $_env;
    private $_cache;
    private $_mainConf;
    private $_configDir;
    private $_defaultEnvironment;

    const ENV_FILE = '.env';
    const ALIASES_FILE = '_aliases.php';
    const COMMON_COMPONENTS_FILE = '_.php';

    public function __construct($mainConf, $env = null) {
        $this->_mainConf= $mainConf;
        $this->_configDir = PROTECTED_PATH.'/config/';
        $this->_defaultEnvironment = 'dev';
        $this->_env = is_null($env) ? $this->readEnv() : $env;
        $this->_cache = new ConfigCache();
    }

    public function readEnv() {
        $filename = $this->_configDir.self::ENV_FILE;
        return $this->content($filename, $this->_defaultEnvironment);
    }

    public function getConfig() {
        require(PROTECTED_PATH . '/config/' . self::ALIASES_FILE);
        if ($this->useCache()) {
            $cache = $this->_cache->get($this->_env);
            if (!empty($cache)) {
                return $cache;
            }
        }

        $config = $this->buildConfig();

        if ($this->useCache()) {
            $this->_cache->put($this->_env, $config);
        }

        return $config;
    }

    private function buildConfig() {
        $mainConfig = $this->readConf(PROTECTED_PATH.'/config/'.$this->_mainConf.'.php');
        $mainConfig['modules'] = $this->readConf(PROTECTED_PATH.'/config/modules/_.php');
        $mainConfig['components'] = CMap::mergeArray($this->getComponents(), $this->getComponents($this->_mainConf));
        $mainConfig['import'] = $this->readConf(PROTECTED_PATH . '/config/_import.php');

        $envConfig = !empty($this->_env) ?
            $this->readConf(PROTECTED_PATH.'/config/'.$this->_env.'.php') :
            array();

        return CMap::mergeArray($mainConfig, $envConfig);
    }

    private function getComponents($specificDir = null) {
        $components = array();

        $dir = $specificDir ?
            PROTECTED_PATH . '/config/components/' . $specificDir . '/' :
            PROTECTED_PATH . '/config/components/';

        $_all = $this->readConf($dir . self::COMMON_COMPONENTS_FILE);
        $components = CMap::mergeArray($components, $_all);

        foreach (scandir($dir) as $file) {
            if (self::COMMON_COMPONENTS_FILE == $file || strpos($file, '.php') === false) continue;

            $componentName = str_replace('.php', '', trim($file));
            $components[$componentName] = require($dir . $file);
        }

        return $components;
    }

    private function readConf($filePath, $default = array()) {
        $conf = $default;
        if (file_exists($filePath)) {
            $conf = require($filePath);
        }
        return is_array($conf) ? $conf : $default;
    }

    private function content($filePath, $default = "") {
        if (!file_exists($filePath)) {
            return $default;
        }
        return (($content = @file_get_contents($filePath)) !== false) ? trim($content) : $default;
    }

    private function useCache() {
        return $this->_env == 'prod';
    }
}