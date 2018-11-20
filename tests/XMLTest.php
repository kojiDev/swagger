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

use EXSyst\OpenApi\XML;
use PHPUnit\Framework\TestCase;

class XMLTest extends TestCase
{
    public function testConstructor()
    {
        $object = new XML($arr = [
            'name' => 'name',
            'namespace' => 'namespace',
            'prefix' => 'prefix',
            'attribute' => true,
            'wrapped' => false,
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new XML();

        $this->assertEquals(new \stdClass(), $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new XML();

        $object->setName('testName');
        $object->setNamespace('testNamespace');
        $object->setPrefix('testPrefix');
        $object->setAttribute(false);
        $object->setWrapped(false);

        $this->assertEquals('testName', $object->getName());
        $this->assertEquals('testNamespace', $object->getNamespace());
        $this->assertEquals('testPrefix', $object->getPrefix());
        $this->assertEquals(false, $object->getAttribute());
        $this->assertEquals(false, $object->getWrapped());
    }
}
