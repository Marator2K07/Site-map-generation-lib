<?php

namespace Src\Interfaces;

interface Validator
{
    /**
     * Проверка корректности определенного значения
     * @param mixed $value значение для проверки
     * @param mixed $pattern паттерн валидации
     * @return bool результат проверки
     */
    public static function validate(mixed $value, mixed $pattern): bool;
}