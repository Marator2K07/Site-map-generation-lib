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

    public function save(string $path = 'file.xml'): bool
    {
        // пытаемся получить доступ к папке (и создать, если нужно)
        $directory = dirname($path);
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true)) {
                throw new BadPathFileDataBuilderException(
                    'Некорректное значение пути сохранения ['
                        . ($path ? $path : "null")
                        . '] при инициализации страницы.'
                );
            }
        }

        if (!$this->xmlData->asXML($path)) {
            throw new BadPathFileDataBuilderException(
                'Некорректное значение пути сохранения ['
                    . ($path ? $path : "null")
                    . '] при инициализации страницы.'
            );
        }

        return true;
    }

    public function clear(): void
    {
        $this->xmlData = new SimpleXMLElement('<urlset/>');
    }
}
