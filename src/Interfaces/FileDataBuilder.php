<?php

namespace Src\Interfaces;

use Src\Main\PageDTO;

interface FileDataBuilder 
{
    /**
     * Начальная инициализация данных в зависимости от
     * конкретного формата наследника
     * @param array $attributes возможные атрибуты определения данных 
     * @return FileDataBuilder возврат для поддержания цепочки вызовов
     */
    public function init(array $attributes): FileDataBuilder; 
  
    /**
     * Добавление данных из страницы
     * @param PageDTO $pageDTO данные страницы для добавления
     * @return FileDataBuilder возврат для поддержания цепочки вызовов
     */
    public function appendPageDTO(PageDTO $pageDTO): FileDataBuilder;

    /**
     * Сохранение построенного содержимого в файл
     * @param string $filename путь сохранения
     * @return bool успешность операции
     */
    public function save(string $filename): bool;

    /**
     * Очистка содержимого
     * @return void
     */
    public function clear(): void;
}