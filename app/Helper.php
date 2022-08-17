<?php

namespace App;

class Helper {

    static function validateEmail($email) : bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
