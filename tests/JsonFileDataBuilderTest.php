<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Builders\JsonFileDataBuilder;
use Src\Main\Page\PageDTO;

class JsonFileDataBuilderTest extends TestCase
{
    private JsonFileDataBuilder $builder;
    private PageDTO $pageDataOne;
    private PageDTO $pageDataTwo;
    private PageDTO $pageDataThree;

    public function setUp(): void
    {
        $this->builder = new JsonFileDataBuilder();
        $this->pageDataOne = new PageDTO([
            "loc" => "https://linux.net",
            "lastmod" => "2012-12-12",
            "priority" => 0.22,
            "changefreq" => "weekly"
        ]);
        $this->pageDataTwo = new PageDTO([
            "loc" => "https://test.ru/news",
            "lastmod" => "2014-05-04",
            "priority" => "0.7",
            "changefreq" => "daily"
        ]);
        $this->pageDataThree = new PageDTO([
            "loc" => "http://site.ru/today/greetings",
            "lastmod" => "2002-02-02",
            "priority" => 0.9,
            "changefreq" => "monthly"
        ]);
    }

    public function testSaveCsvFileDataBuilder(): void
    {
        $this->builder
            ->init($this->pageDataOne->getProperties())
            ->appendPageDTO($this->pageDataOne)
            ->appendPageDTO($this->pageDataTwo)
            ->appendPageDTO($this->pageDataThree);

        $this->assertTrue($this->builder->save("/var/www/site.ru/file.json"));      
        $this->assertFalse($this->builder->save("/var/www/site.ru/"));       
        $this->assertFalse($this->builder->save("w/??fr/:var/d:/test/run/site.ru/file.json"));        
    }
}