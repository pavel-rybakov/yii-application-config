<?php

class ConfigCache {
    public function get($env) {
        $cachePath = PROTECTED_PATH . '/runtime/config/' . $env . '.conf';
        return file_exists($cachePath)
            ? json_decode(file_get_contents($cachePath), true)
            : null;
    }

    public function put($env, $config) {
        $cacheDir = PROTECTED_PATH . '/runtime/config/';
        if (!file_exists($cacheDir)) {
            mkdir($cacheDir);
        }
        $cachePath = $cacheDir . $env . '.conf';
        file_put_contents($cachePath, json_encode($config));
    }
}