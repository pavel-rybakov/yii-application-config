<?php

return array(
    'gii'=>array(
        'class'=>'system.gii.GiiModule',
        'password'=>'1234',
        // If removed, Gii defaults to localhost only. Edit carefully to taste.
        'ipFilters'=>array('127.0.0.1','::1'),
        'generatorPaths'=>array(
            'application.gii',
        ),
    ),
    'user'=>array(
        # encrypting method (php hash function)
        'hash' => 'md5',
        # send activation email
        'sendActivationMail' => true,
        # allow access for non-activated users
        'loginNotActiv' => false,
        # activate user on registration (only sendActivationMail = false)
        'activeAfterRegister' => false,
        # automatically login from registration
        'autoLogin' => true,
        # registration path
        'registrationUrl' => array('/user/registration'),
        # recovery password path
        'recoveryUrl' => array('/user/recovery'),
        # login form path
        'loginUrl' => array('/user/login'),
        # page after login
        'returnUrl' => array('/user/profile'),
        # page after logout
        'returnLogoutUrl' => array('/user/login'),
    ),
    'admin' => array(),
    'notifications' => array(
        'defaultController' => 'notifications',
    ),
    'image' => array(),
);