# Site-map-generation-lib
Библиотека генерации карты сайта 
# Установка 
    composer require marator2k07/site-map-generation-lib
# Пример использования
    <?php
    
    require 'vendor/autoload.php';
    use Src\Main\SiteMapGenerator;
    
    //< Укажите страницы [поля: loc, lastmod, priority, changefreq]
    $pages = [
        [
            'loc' => 'http://test.com/page1',
            'lastmod' => '2024-01-01',
            'priority' => 0.8,
            'changefreq' => 'daily'        
        ],
        [
            'loc' => 'https://site.ru/news',
            'lastmod' => '2012-12-12',        
            'priority' => 0.3,
            'changefreq' => 'weekly'
        ],
        [
            'loc' => 'http://news.site/react',
            'lastmod' => '2019-09-03',        
            'priority' => 0.5,
            'changefreq' => 'monthly'
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
