<?php

require_once __DIR__ . '/JWTService.php';

class AuthMiddleware {

    public static function check()
    {
        if (!isset($_COOKIE['token'])) {
            return [
                "status" => false,
                "message" => "Token missing"
            ];
        }

        $token = $_COOKIE['token'];

        try {
            $decoded = JWTService::validate($token);

            return [
                "status" => true,
                "user" => $decoded
            ];

        } catch (Exception $e) {
            return [
                "status" => false,
                "message" => "Invalid token"
            ];
        }
    }
}
