<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Exceptions\InvalidPageDTOException;
use Src\Main\PageDTO;
use function PHPUnit\Framework\assertSame;

class PageDTOTest extends TestCase
{
    private $goodPageDataOne;
    private $goodPageDataTwo;
    private $badPageDataOne;
    private $badPageDataTwo;
    private $badPageDataThree;
    private $badPageDataFour;

    public function setUp(): void
    {
        $this->goodPageDataOne = [
            "loc" => "https://site.ru",
            "lastmod" => "2020-10-12",
            "priority" => 0.1,
            "changefreq" => "daily"
        ];
        $this->goodPageDataTwo = [
            "loc" => "https://site.ru/news",
            "lastmod" => "2016-04-02",
            "priority" => "1",
            "changefreq" => "weekly"
        ];

        $this->badPageDataOne = [
            "loc" => "few//site",
            "lastmod" => "2020-10-12",
            "priority" => 0.1,
            "changefreq" => "daily"
        ];
        $this->badPageDataTwo = [
            "loc" => "https://correct.site.ru/news",
            "lastmod" => "2020-13-44",
            "priority" => 0.1,
            "changefreq" => "daily"
        ];
        $this->badPageDataThree = [
            "loc" => "https://correct.ru/news",
            "lastmod" => "2020-02-02",
            "priority" => "abc",
            "changefreq" => "daily"
        ];
        $this->badPageDataFour = [
            "loc" => "https://correct.ru/news",
            "lastmod" => "2020-02-02",
            "priority" => "0.5",
            "changefreq" => "random"
        ];
    }

    public function testValidPageDTO(): void
    {
        $pageDTO1 = new PageDTO($this->goodPageDataOne);
        assertSame("https://site.ru", $pageDTO1->getLoc());
        assertSame("2020-10-12", $pageDTO1->getLastMod("Y-m-d"));
        assertSame(0.1, $pageDTO1->getPriority());
        assertSame("daily", $pageDTO1->getChangeFreq());

        $pageDTO2 = new PageDTO($this->goodPageDataTwo);
        assertSame("https://site.ru/news", $pageDTO2->getLoc());
        assertSame("2016-04-02", $pageDTO2->getLastMod("Y-m-d"));
        assertSame(1.0, $pageDTO2->getPriority());
        assertSame("weekly", $pageDTO2->getChangeFreq());
    }

    public function testInvalidLocPageDTO(): void
    {
        $this->expectException(InvalidPageDTOException::class);
        $this->expectExceptionMessage(
            "Некорректное значение адреса страницы [few//site] при инициализации страницы."
        );
        $pageXmlDTO = new PageDTO($this->badPageDataOne);
    }

    public function testInvalidLastModPageDTO(): void
    {
        $this->expectException(InvalidPageDTOException::class);
        $this->expectExceptionMessage(
            "Некорректное значение даты последней модификации [2020-13-44] при инициализации страницы."
        );
        $pageXmlDTO = new PageDTO($this->badPageDataTwo);
    }

    public function testInvalidPriorityPageDTO(): void
    {
        $this->expectException(InvalidPageDTOException::class);
        $this->expectExceptionMessage(
            "Некорректное значение приоритета парсинга [abc] при инициализации страницы."
        );
        $pageXmlDTO = new PageDTO($this->badPageDataThree);
    }

    public function testInvalidChangeFreqPageDTO(): void
    {
        $this->expectException(InvalidPageDTOException::class);
        $this->expectExceptionMessage(
            "Некорректное значение частоты обновления [random] при инициализации страницы."
        );
        $pageXmlDTO = new PageDTO($this->badPageDataFour);
    }
}
