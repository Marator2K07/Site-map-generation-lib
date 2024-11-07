<?php

use PHPUnit\Framework\TestCase;
use Src\Validators\DateValidator;

class DateValidatorTest extends TestCase
{
    private $goodDates;
    private $badDates;

    public function setUp(): void
    {
        $this->goodDates = [
            "2020-12-07",
            "2000-02-29",
            "2007-07-07"
        ];
        $this->badDates = [
            "2021-02-30", 
            "2020-13-01", 
            "2021-04-31" 
        ];
    }

    public function testValidateDate(): void
    {
        foreach ($this->goodDates as $date) {
            $this->assertTrue(DateValidator::validate($date));
        }
        foreach ($this->badDates as $date) {
            $this->assertFalse(DateValidator::validate($date));
        }
    }
}