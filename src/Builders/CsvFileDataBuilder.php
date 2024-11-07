<?php

namespace Src\Builders;

use Src\Interfaces\FileDataBuilder;
use Src\Main\Page\PageDTO;

class CsvFileDataBuilder implements FileDataBuilder
{
    private $headers;
    private $data;   
    
    public function __construct()
    {
        $this->headers = [];
        $this->data = [];
    }

    public function init(array $attributes): FileDataBuilder
    {
        $this->headers = $attributes;

        return $this;
    }

    public function appendPageDTO(PageDTO $pageDTO): FileDataBuilder
    {
        $this->data[] = $pageDTO->getData();
        
        return $this;
    }

    public function save(string $filename): bool
    {
        // Пытаемся получить доступ к папке (создать, если нужно)
        $directory = dirname($filename);
        if (!is_dir($directory) && !mkdir($directory, 0755, true)) {
            return false;        
        }
        // И открыть файл для записи
        $file = fopen($filename, 'w');
        if (!$file) {
            return false;
        }
        // Пишем заголовки и данные
        fputcsv($file, $this->headers, ';');
        foreach ($this->data as $row) {
            fputcsv($file, $row, ';');
        }

        fclose($file);
        return true;
    }

    public function clear(): void
    {
        $this->data = [];
        $this->headers = [];
    }
}