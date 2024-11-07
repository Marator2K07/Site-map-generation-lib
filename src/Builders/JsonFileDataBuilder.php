<?php

namespace Src\Builders;

use Src\Interfaces\FileDataBuilder;
use Src\Main\PageDTO;

class JsonFileDataBuilder implements FileDataBuilder
{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }

    public function init(array $attributes = []): FileDataBuilder
    {
        $this->data['attributes'] = $attributes;
        $this->data['values'] = [];

        return $this;
    }

    public function appendPageDTO(PageDTO $pageDTO): FileDataBuilder
    {
        $this->data['values'][] = $pageDTO->getData();

        return $this;
    }

    public function save(string $filename): bool
    {
        // пытаемся получить доступ к папке (создать, если нужно)
        $directory = dirname($filename);
        if (!is_dir($directory) && !mkdir($directory, 0755, true)) {
            return false;
        }
        // и сохранить данные в json файл
        $json = json_encode($this->data['values'], JSON_PRETTY_PRINT);
        if (file_put_contents($filename, $json) === false) {
            return false;
        }

        return true;
    }

    public function clear(): void
    {
        $this->data = [];
    }
}
