<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService {

    private static function getSecret() {
        $JWT_secret = '_need_some_caffine__32_chars!!!!!';
                       
        // return $_ENV['JWT_SECRET']; // from .env
        return $JWT_secret; // from .env
    }
    public static function generate($user) {

        $payload = [
            "iss" => "CampusFeedback",
            "iat" => time(),
            "exp" => time() + 3600,
            "data" => [
                "id" => $user['id'],
                "name" => $user['username']
            ]
        ];

        return JWT::encode($payload, self::getSecret(), 'HS256');
    }

    public static function validate($token) {
        try {
            return JWT::decode($token, new Key(self::getSecret(), 'HS256'));
        } catch (Exception $e) {
            return false;
        }
    }
}