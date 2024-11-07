<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Builders\XmlFileDataBuilder;
use Src\Exceptions\BadPathFileDataBuilderException;
use Src\Main\Page\PageDTO;

class XmlFileDataBuilderTest extends TestCase
{
    private XmlFileDataBuilder $builder;
    private PageDTO $pageDataOne;
    private PageDTO $pageDataTwo;
    private PageDTO $pageDataThree;

    public function setUp(): void
    {
        $this->builder = new XmlFileDataBuilder();
        $this->pageDataOne = new PageDTO([
            "loc" => "https://site.ru",
            "lastmod" => "2020-10-12",
            "priority" => 0.1,
            "changefreq" => "daily"
        ]);
        $this->pageDataTwo = new PageDTO([
            "loc" => "https://site.ru/news",
            "lastmod" => "2017-05-03",
            "priority" => 0.4,
            "changefreq" => "weekly"
        ]);
        $this->pageDataThree = new PageDTO([
            "loc" => "http://site.ru/news/month",
            "lastmod" => "2007-01-07",
            "priority" => 1,
            "changefreq" => "monthly"
        ]);
    }

    // public function testSavingXmlFileDataBuilder(): void
    // {
    //     $this->builder
    //         ->init([
    //             'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
    //             'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9'
    //         ])
    //         ->appendPageDTO($this->pageDataOne)
    //         ->appendPageDTO($this->pageDataTwo)
    //         ->appendPageDTO($this->pageDataThree);

    //     $this->builder->save("/var/www/site.ru/file.xml");
    // }

    public function testSaving1XmlFileDataBuilder(): void
    {
        $this->builder
            ->init([
                'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9'
            ])
            ->appendPageDTO($this->pageDataOne)
            ->appendPageDTO($this->pageDataTwo)
            ->appendPageDTO($this->pageDataThree);

        try {
            $this->builder->save("w/??fr/:var/d:/test/run/site.ru");
        } catch (\Throwable $th) {
            error_log($th->getMessage(), 3, "errors.log");
        }
        
    }
}