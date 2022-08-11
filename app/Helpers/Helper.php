<?php

namespace App\Helpers;

class Helper {
    public static function generatePassword($length = 6, $chars = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_?,.')
    {
        $password = '';
    
        for ($i = 1; $i <= $length; $i++) {
            $password .= substr($chars, (rand() % (strlen($chars))), 1);
        }
    
        return $password;
    }
}
