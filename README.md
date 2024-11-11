# Site-map-generation-lib
Библиотека генерации карты сайта 
# Установка 
1) Конфигурируем composer.json:

    {
        "minimum-stability": "dev",
        "autoload": {
            "psr-4": {
                "Src\\": "src/"
        {
            "minimum-stability": "dev",
            "autoload": {
                "psr-4": {
                    "Src\\": "src/"
                }
            },
            "require": {
                "php": ">=8.2",
                "marator2k07/site-map-generation-lib": "dev-main"
            },
            "scripts": {
                "post-install-cmd": [
                    "@php -r \"if (!is_dir('config')) { mkdir('config'); } file_put_contents('config/constants.php', '<?php \n\ndefine(\\'DEFAULT_PERMISSION_LEVEL\\', 0755);');\""
                ],
                "post-update-cmd": [
                    "@php -r \"if (!is_dir('config')) { mkdir('config'); } file_put_contents('config/constants.php', '<?php \n\ndefine(\\'DEFAULT_PERMISSION_LEVEL\\', 0755);');\""
                ]
            }
        },
        "require": {
            "php": ">=8.2",
            "marator2k07/site-map-generation-lib": "dev-main"
        },
        "scripts": {
            "post-install-cmd": [
                "@php -r \"if (!is_dir('config')) { mkdir('config'); } file_put_contents('config/constants.php', '<?php \n\ndefine(\\'DEFAULT_PERMISSION_LEVEL\\', 0755);');\""
            ],
            "post-update-cmd": [
                "@php -r \"if (!is_dir('config')) { mkdir('config'); } file_put_contents('config/constants.php', '<?php \n\ndefine(\\'DEFAULT_PERMISSION_LEVEL\\', 0755);');\""
            ]
        }
    }

2) Обновляем зависимости:

        composer update
   
# Пример использования
    <?php
        
    require 'config/constants.php';
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

# Примечания

На линукс системах, скорее всего, для корректной работы понадобиться установить права доступа для вашей директории командой:

    sudo chmod 755 /your_directory_path

Или в худшем случае командой:

    sudo chmod 777 /your_directory_path
