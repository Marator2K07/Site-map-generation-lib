<?php

use PHPUnit\Framework\TestCase;
use Src\Validators\UpdateFrequencyValidator;

class UpdateFrequencyValidatorTest extends TestCase
{
    private $goodFrequencies;
    private $badFrequencies;

    public function setUp(): void 
    {
        $this->goodFrequencies = [
            "hourly",
            "daily",
            "weekly",
            "monthly",
            "annually"
        ];
        $this->badFrequencies = [
            "",
            "weel",
            "dat",
            "year"
        ];
    }

    public function testValidate(): void
    {
        foreach ($this->goodFrequencies as $freq) {
            $this->assertTrue(UpdateFrequencyValidator::validate($freq));
        }
        foreach ($this->badFrequencies as $freq) {
            $this->assertFalse(UpdateFrequencyValidator::validate($freq));
        }
    }
}