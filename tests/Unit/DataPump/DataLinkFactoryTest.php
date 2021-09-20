<?php

/**
 * Unit tests for the DataLinkFactory
 */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DataLinkFactoryTest extends TestCase
{
    /**
     * Test to assert if the factory returns a valid datalink object
     *
     * @return void
     */
    public function testDatalinkFactoryReturnsDatalinkObject()
    {
        $datalinkFactory = new \App\DataPump\DataLinkFactory();

        $this->assertContains(
            'App\DataPump\DataLinkObjects\DataLinkInterface',
            class_implements($datalinkFactory->create('xml'))
        );

        $this->assertEquals('App\DataPump\DataLinkObjects\XMLDataLink', get_class($datalinkFactory->create('xml')));
    }

    /**
     * Test to assert if the factory throws exception for wrong value
     *
     * @return void
     */
    public function testDatalinkFactoryThrowsException()
    {
        $datalinkFactory = new \App\DataPump\DataLinkFactory();

        $this->expectException(\InvalidArgumentException::class);

        $this->expectErrorMessage('Invalid DataLink type');

        $datalinkFactory->create('foo');
    }
}
