<?php

namespace Tests\Feature\DataPump;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataValidatorTest extends TestCase
{
    /**
     * test ValidareDataFunction for int values
     *
     * @return void
     */
    public function testValidareDataFunctionForInt()
    {
        $validator = $this->getObjectForTrait(\App\DataPump\DataValidator::class);
        $this->assertEquals(1234, $validator->sanatizeData('int', '1234'));
        $this->assertEquals(0, $validator->sanatizeData('int', 'foobar'));
    }

    /**
     * test ValidareDataFunction for date values
     *
     * @return void
     */
    public function testValidareDataFunctionForDate()
    {
        $validator = $this->getObjectForTrait(\App\DataPump\DataValidator::class);
        $this->assertEquals('2021-07-28', $validator->sanatizeData('date', '20210728'));
        $this->assertEquals('1970-01-01', $validator->sanatizeData('date', 'foobar'));
    }

    /**
     * test ValidareDataFunction for time values
     *
     * @return void
     */
    public function testValidareDataFunctionForTime()
    {
        $validator = $this->getObjectForTrait(\App\DataPump\DataValidator::class);
        $this->assertEquals('16:35', $validator->sanatizeData('time', '1635+0100'));
    }

    /**
     * test ValidareDataFunction for bool values
     *
     * @return void
     */
    public function testValidareDataFunctionForBool()
    {
        $validator = $this->getObjectForTrait(\App\DataPump\DataValidator::class);
        $this->assertEquals('false', $validator->sanatizeData('bool', 'No'));
    }
}
