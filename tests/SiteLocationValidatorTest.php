<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Src\Validators\SiteLocationValidator;

class SiteLocationValidatorTest extends TestCase
{
    private $goodUrls;
    private $badUrls;

    protected function setUp(): void
    {
        $this->goodUrls = [
            "https://site.ru/",
            "http://site.ru/news",
            "https://example.com/",
            "http://my-site.org/about",
            "https://another-site.net/news/",
            "http://site-my.en"
        ];
        $this->badUrls = [
            "http:/my-site.org/about",
            "https:/",
            "htjp://invalid-site"
        ];
    }

    public function testValidate(): void
    {
        foreach ($this->goodUrls as $url) {
            $this->assertTrue(SiteLocationValidator::validate($url));
        }
        foreach ($this->badUrls as $url) {
            $this->assertFalse(SiteLocationValidator::validate($url));
        }
    }
}