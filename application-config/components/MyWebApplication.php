<?php

class MyWebApplication extends CWebApplication {

    private $_env;

    public function __construct($config, $env = null) {
        $this->_env = $env;
        $applicationConfig = new ApplicationConfig($config, $env);
        parent::__construct($applicationConfig->getConfig());
    }
}