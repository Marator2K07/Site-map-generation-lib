<?php

namespace Src\Builders;

use SimpleXMLElement;
use Src\Exceptions\BadPathFileDataBuilderException;
use Src\Interfaces\FileDataBuilder;
use Src\Main\Page\PageDTO;

class XmlFileDataBuilder implements FileDataBuilder
{
    private $xmlData;

    public function __construct()
    {
        $this->xmlData = new SimpleXMLElement('<urlset/>');
    }

    public function init(array $attributes): FileDataBuilder
    {
        // Добавляем все полученные атрибуты  
        foreach ($attributes as $key => $value) {
            $this->xmlData->addAttribute($key, $value);
        }

        return $this;
    }

    public function appendPageDTO(PageDTO $pageDTO): FileDataBuilder
    {
        // создаем раздел 
        $url = $this->xmlData->addChild('url');
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
        if (!$this->xmlData->saveXML($filename)) {
            return false;
        }

        return true;
    }

    public function clear(): void
    {
        $this->xmlData = new SimpleXMLElement('<urlset/>');
    }
}
