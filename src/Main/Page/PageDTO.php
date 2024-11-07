<?php

namespace Src\Main\Page;

use DateTime;
use Src\Exceptions\InvalidPageDTOException;
use Src\Validators\DateValidator;
use Src\Validators\SiteLocationValidator;
use Src\Validators\UpdateFrequencyValidator;

class PageDTO 
{
    // адрес страницы
    private string $loc;
    // дата изменения
    private DateTime $lastMod;
    // приоритет парсинга
    private float $priority;
    // периодичность обновления
    private string $changeFreq;

    public function __construct(array $data)
    {
        $this->setLoc($data["loc"]);
        $this->setLastMod($data["lastmod"]);
        $this->setPriority($data["priority"]);
        $this->setChangeFreq($data["changefreq"]);
    }

    public function getLoc(): string
    {
        return $this->loc;
    }
    public function setLoc(mixed $loc)
    {
        if ($loc === null || !SiteLocationValidator::validate($loc)) {
            throw new InvalidPageDTOException(
                'Некорректное значение адреса страницы [' 
                . ($loc ? $loc : "null") 
                . '] при инициализации страницы.', 3
            );
        }

        $this->loc = $loc;
    }

    public function getLastMod(string $format): string
    {
        return $this->lastMod->format($format);
    }
    public function setLastMod(mixed $lastMod): void
    {
        if ($lastMod === null || !DateValidator::validate($lastMod)) {
            throw new InvalidPageDTOException(
                'Некорректное значение даты последней модификации [' 
                . ($lastMod ? $lastMod : "null")
                . '] при инициализации страницы.'
            );
        }        

        $this->lastMod = new DateTime($lastMod);
    }

    public function getPriority(): float
    {
        return $this->priority;
    }
    public function setPriority(mixed $priority): void
    {
        if ($priority === null || !is_numeric($priority)) {
            throw new InvalidPageDTOException(
                'Некорректное значение приоритета парсинга ['
                . ($priority ? $priority : "null")
                . '] при инициализации страницы.'
            );
        }

        $this->priority = $priority;
    }

    public function getChangeFreq(): string
    {
        return $this->changeFreq;
    }
    public function setChangeFreq(mixed $changeFreq): void
    {
        if ($changeFreq === null || !UpdateFrequencyValidator::validate($changeFreq)) {
            throw new InvalidPageDTOException(
                'Некорректное значение частоты обновления [' 
                . ($changeFreq ? $changeFreq : "null") 
                . '] при инициализации страницы.'
            );
        }

        $this->changeFreq = $changeFreq;
    } 

    public function getData(): array
    {
        return [
           'loc' => $this->getLoc(),
           'lastmod' => $this->getLastMod('Y-m-d'),
           'priority' => $this->getPriority(),
           'changefreq' => $this->getChangeFreq()
        ];
    }
}