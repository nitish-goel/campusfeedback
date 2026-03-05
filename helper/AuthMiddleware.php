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

        $decoded = JWTService::validate($_COOKIE['token']);

        if (!$decoded) {
            return [
                "status" => false,
                "message" => "Invalid token"
            ];
        }

        return [
            "status" => true,
            "user" => $decoded
        ];
    }
}
