<?php

namespace Src\Validators;

use Src\Interfaces\Validator;

class DateValidator implements Validator
{
    /**
     * Проверка корректности даты (формат Y-m-d) 
     * @param mixed $value дата для проверки
     * @param mixed $pattern заданное регулярное выражение для даты 
     * @return bool корректность даты
     */
    public static function validate(
        mixed $value,
        mixed $pattern = '/^\d{4}-\d{2}-\d{2}$/'
    ): bool {
        // сначала проверяем дату через регулярное выражение
        if (!preg_match($pattern, $value)) {
            return false;
        }
        // а теперь проверяем границы даты
        [$year, $month, $day] = explode('-', $value);

        return checkdate($month, $day, $year);
    }
}
