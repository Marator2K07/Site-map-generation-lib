<?php

// Подготавливаем пути
$configDir = __DIR__ . '/../config';
$constantsFile = $configDir . '/constants.php';

// Пытаемся создать директорию под конфигурацию
if (!is_dir($configDir)) {
    if (!mkdir($configDir, 0755, true)) {
        error_log(
            "Не удалось создать файл /config/constants.php с содержимым:"
                . PHP_EOL
                . "define('DEFAULT_PERMISSION_LEVEL', 0755);"
                . PHP_EOL,
            3,
            "errors.log"
        );
    }
}

// А теперь заполняем файл, если его нет
if (!file_exists($constantsFile)) {
    file_put_contents(
        $constantsFile,
        "<?php\n\ndefine('DEFAULT_PERMISSION_LEVEL', 0755);\n"
    );
}
