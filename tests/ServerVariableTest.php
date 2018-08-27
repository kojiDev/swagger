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

use EXSyst\OpenApi\ServerVariable;
use PHPUnit\Framework\TestCase;

class ServerVariableTest extends TestCase
{
    public function testConstructor()
    {
        $object = new ServerVariable($arr = [
            'default' => 'demo',
            'description' => 'foo',
            'enum' => ['foo'],
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new ServerVariable($arr = [
            'default' => 'demo',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new ServerVariable([
            'default' => 'demo',
            'description' => 'foo',
            'enum' => ['foo'],
        ]);

        $this->assertEquals('demo', $object->getDefault());
        $this->assertEquals('foo', $object->getDescription());
        $this->assertEquals(['foo'], $object->getEnum());

        $object->setDefault('stage');
        $object->setDescription('yo');
        $object->setEnum([]);

        $this->assertEquals('stage', $object->getDefault());
        $this->assertEquals([], $object->getEnum());
    }
}
