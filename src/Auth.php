<?php

class Auth{

    public static function login($username, $password)
    {
        foreach(AUTH_USERS as $user)
        {
            if($user['email'] == $username && $user['password'] == $password)
            {
                $_SESSION['fm_logged'] = true;
                $_SESSION['email'] = $username;

                return true;
            }
        }

        return false;
    }
}