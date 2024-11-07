<?php

namespace Src\Validators;

use Src\Interfaces\Validator;

class SiteLocationValidator implements Validator 
{    
    /**
     * Проверка корректности адреса страницы 
     * @param mixed $value строка страницы сайта
     * @param mixed $pattern регулярное выражение страницы сайта
     * @return bool результат проверки
     */
    public static function validate(
        mixed $value,
        mixed $pattern = '/^https?:\/\/[a-zA-Z0-9\-\.]+\.[a-z]{2,}(\/[a-zA-Z0-9\-\/]*)?\/?$/'        
    ): bool
    {
        if (preg_match($pattern, $value)) {
            return true;
        } else {
            return false;
        }
    }
}
 