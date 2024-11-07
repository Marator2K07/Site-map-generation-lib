<?php

namespace Src\Builders;

use SimpleXMLElement;
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

}