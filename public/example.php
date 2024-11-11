<?php

require 'vendor/autoload.php';

use Src\Main\SiteMapGenerator;

// Укажите страницы [поля: loc, lastmod, priority, changefreq]
$pages = [
    [
        'loc' => 'http://site.ru',
        'lastmod' => '2024-01-01',
        'priority' => 0.8,
        'changefreq' => 'daily'
    ],
    [
        'loc' => 'http://example.ru/site/news',
        'lastmod' => '2022-01-02',
        'priority' => 0.77,
        'changefreq' => 'weekly'
    ],
    [
        'loc' => 'https://site.net/xbox',
        'lastmod' => '2012-12-12',
        'priority' => 0.2,
        'changefreq' => 'hourly'
    ]
];

// Укажите путь к файлу
// (название без указания пути, например, $filePath = 'sitemap.xml'
// приведет к созданию файла в папке проекта!)
$filePath = '/path/to/your/sitemap.xml';

// Укажите тип файла (xml, csv, json)
$fileType = 'xml';

try {
    $siteMapGenerator = new SiteMapGenerator($pages, $fileType, $filePath);
    $siteMapGenerator->generate();
} catch (\Throwable $th) {
    error_log($th->getMessage() . PHP_EOL, 3, "errors.log");
}
