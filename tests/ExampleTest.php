<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OpenApi\tests;

use EXSyst\OpenApi\Example;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testConstructor()
    {
        $object = new Example($arr = [
            'summary' => 'Summary',
            'description' => 'Description',
            'value' => [
                'literally' => 'anything',
                'boolean' => true,
                'array' => [
                    '123',
                    123,
                ],
            ],
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new Example($arr = [
            'summary' => 'Summary',
            'description' => 'Description',
            'externalValue' => 'http://foo.com',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new Example();

        $this->assertNull($object->getSummary());
        $this->assertNull($object->getDescription());
        $this->assertNull($object->getValue());
        $this->assertNull($object->getExternalValue());

        $object->setSummary('Foo');
        $object->setDescription('Bar');
        $object->setExternalValue('http://asd.das');
        $object->setValue(true);

        $this->assertEquals('Foo', $object->getSummary());
        $this->assertEquals('Bar', $object->getDescription());
        $this->assertEquals('http://asd.das', $object->getExternalValue());
        $this->assertTrue($object->getValue());
    }
}
