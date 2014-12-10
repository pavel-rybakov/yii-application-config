<?php

return array(
    'class' => 'vendor.twigrenderer.ETwigViewRenderer',
    'twigPathAlias' => 'vendor.twig.twig.lib.Twig',

    // Все параметры ниже являются необязательными
    'fileExtension' => '.twig',
    'options' => array(
        'autoescape' => false,
    ),
    'globals' => array(
        'html' => 'CHtml'
    ),
    'functions' => array(
        'rot13' => 'str_rot13',
        'date' => 'date',
    ),
    'filters' => array(
        'jencode' => 'CJSON::encode',
    ),
);