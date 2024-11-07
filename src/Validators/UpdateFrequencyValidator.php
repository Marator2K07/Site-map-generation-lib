<?php

namespace Src\Validators;

use Src\Interfaces\Validator;

class UpdateFrequencyValidator implements Validator
{
    /**
     * Проверка корректности частоты обновлений
     * @param mixed $value значение частоты обновлений
     * @param mixed $pattern массив фильтрации 
     * @return bool принадлежность массиву фильтрации
     */
    public static function validate(
        mixed $value,
        mixed $pattern = [
            "hourly",
            "daily",
            "weekly",
            "monthly",
            "annually" // ежегодно
        ]
    ): bool {
        if (!in_array($value, $pattern)) {
            return false;
        }

        return true;
    }
}
