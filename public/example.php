<?php

require 'vendor/autoload.php';
use Src\Main\SiteMapGenerator;

//< Укажите страницы [поля: loc, lastmod, priority, changefreq]
$pages = [
    [
        'loc' => 'http://example.com/page1',
        'lastmod' => '2024-01-01',
        'priority' => 0.8,
        'changefreq' => 'daily'        
    ],
    [
        'loc' => 'http://example.com/page2',
        'lastmod' => '2022-01-02',        
        'priority' => 0.5,
        'changefreq' => 'weekly'
    ]
];
//>

//< Укажите путь к файлу
$filePath = '/path/to/your/sitemap.xml'; 
//>

//< Укажите тип файла (xml, csv, json)
$fileType = 'xml'; 
//>

try {
    $siteMapGenerator = new SiteMapGenerator($pages, $fileType);
    $siteMapGenerator->generate($filePath);
} catch (\Throwable $th) {
    error_log($th->getMessage() . PHP_EOL, 3, "errors.log");
}

