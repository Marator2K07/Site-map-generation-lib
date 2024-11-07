<?php

namespace Src\Main;

use Src\Builders\CsvFileDataBuilder;
use Src\Builders\JsonFileDataBuilder;
use Src\Builders\XmlFileDataBuilder;
use Src\Exceptions\BadPathFileDataBuilderException;
use Src\Exceptions\InvalidFileTypeException;

class SiteMapGenerator 
{
    private $pagesDTO;
    private $fileDataBuilder;

    public function __construct(
        array $pages,
        string $fileType
    ) {
        // инициализируем конструктор данных файла
        switch ($fileType) {
            case 'xml':
                $this->fileDataBuilder = new XmlFileDataBuilder();
                // изначально неизвестно какими данными заполнять атрибуты xml 
                // так что пусть будет так
                $this->fileDataBuilder->init([
                    'xmlns' => "http://www.sitemaps.org/schemas/sitemap/0.9",
                    'xsi:schemaLocation' => "http://www.sitemaps.org/schemas/sitemap/0.9"
                ]);
                break;
            case 'csv':
                $this->fileDataBuilder = new CsvFileDataBuilder();
                $this->fileDataBuilder->init(['loc', 'lastmod', 'priority', 'changefreq']); 
                break;
            case 'json':
                $this->fileDataBuilder = new JsonFileDataBuilder();
                $this->fileDataBuilder->init(['loc', 'lastmod', 'priority', 'changefreq']); 
                break;            
            default:
                throw new InvalidFileTypeException(
                    'Неподдерживаемый тип файла [' 
                    . $fileType 
                    . ']; поддерживаемые [xml, csv, json]'
                );
        }
        // инициализация страниц 
        foreach ($pages as $page) {
            $this->pagesDTO[] = new PageDTO($page);
        }
    }

    /**
     * Генерация карты сайта в виде файла заранее указанного формата
     * @param string $fileName путь для созданного файла карты
     * @throws BadPathFileDataBuilderException
     * @return void
     */
    public function generate(string $fileName): void
    {
        // "строим" содержимое файла 
        foreach ($this->pagesDTO as $pageDTO) {
            $this->fileDataBuilder->appendPageDTO($pageDTO);
        }
        // и пытаемся сохранить
        if(!$this->fileDataBuilder->save($fileName)) {
            throw new BadPathFileDataBuilderException(
                'Не удалось сохранить карту страниц по указанному пути [' 
                . $fileName 
                . ']'
            );
        }  
    }
}