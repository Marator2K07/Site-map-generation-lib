<?php

namespace Src\Builders;

use SimpleXMLElement;
use Src\Interfaces\FileDataBuilder;
use Src\Main\PageDTO;

class XmlFileDataBuilder implements FileDataBuilder
{
    private $data;

    public function __construct()
    {
        $this->data = new SimpleXMLElement('<urlset/>');
    }

    public function init(array $attributes = []): FileDataBuilder
    {
        // добавляем все полученные атрибуты  
        foreach ($attributes as $key => $value) {
            $this->data->addAttribute($key, $value);
        }

        return $this;
    }

    public function appendPageDTO(PageDTO $pageDTO): FileDataBuilder
    {
        // создаем раздел 
        $url = $this->data->addChild('url');
        // и заполняем его
        foreach ($pageDTO->getData() as $key => $value) {
            $url->addChild($key, $value);
        }

        return $this;
    }

    public function save(string $filename = 'file.xml'): bool
    {
        // пытаемся получить доступ к папке (создать, если нужно)
        $directory = dirname($filename);
        if (!is_dir($directory) && !mkdir($directory, 0755, true)) {
            return false;
        }
        // и наконец, сохранить 
        if (!$this->data->saveXML($filename)) {
            return false;
        }

        return true;
    }

    public function clear(): void
    {
        $this->data = new SimpleXMLElement('<urlset/>');
    }
}
