<?php

namespace Src\Main\Page;

use DateTime;
use Src\Exceptions\InvalidPageDTOException;
use Src\Validators\DateValidator;
use Src\Validators\SiteLocationValidator;
use Src\Validators\UpdateFrequencyValidator;

abstract class PageDTO 
{
    // адрес страницы
    protected string $loc;
    // дата изменения
    protected DateTime $lastMod;
    // приоритет парсинга
    protected float $priority;
    // периодичность обновления
    protected string $changeFreq;

    public function getLoc(): string
    {
        return $this->loc;
    }
    public function setLoc(mixed $loc)
    {
        if (!SiteLocationValidator::validate($loc)) {
            throw new InvalidPageDTOException(
                'Некорректное значение адреса страницы [' . $loc . '] при инициализации страницы.'
            );
        }

        $this->loc = $loc;
    }

    public function getLastMod(): DateTime
    {
        return $this->lastMod;
    }
    public function setLastMod(mixed $lastMod): void
    {
        if (!DateValidator::validate($lastMod)) {
            throw new InvalidPageDTOException(
                'Некорректное значение даты последней модификации [' . $lastMod . '] при инициализации страницы.'
            );
        }
        
        $this->lastMod = $lastMod;
    }

    public function getPriority(): float
    {
        return $this->priority;
    }
    public function setPriority(mixed $priority): void
    {
        if (!is_numeric($priority)) {
            throw new InvalidPageDTOException(
                'Некорректное значение приоритета парсинга [' . $priority . '] при инициализации страницы.'
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
        if (!UpdateFrequencyValidator::validate($changeFreq)) {
            throw new InvalidPageDTOException(
                'Некорректное значение частоты обновления [' . $changeFreq . '] при инициализации страницы.'
            );
        }

        $this->changeFreq = $changeFreq;
    }

    /**
     * Приведение данных страницы в строку нужного формата 
     * @return string Xml, Csv или Json представление страницы
     */
    abstract public function toFormatStr(): string;
}