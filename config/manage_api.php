<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12/11/2018
 * Time: 2:51 PM
 */
return [
    'get_access_token'=>[
        'grant_type' => 'password',
        'client_id' => 'client-id',
        'client_secret' => 'client-secret',
        'username' => 'taylor@laravel.com',
        'password' => 'my-password',
        'scope' => '*',
        ],
    'get_refresh_token'=>[
        'grant_type' => 'refresh_token',
        'refresh_token' => 'the-refresh-token',
        'client_id' => 'client-id',
        'client_secret' => 'client-secret',
        'scope' => ''
        ]
];