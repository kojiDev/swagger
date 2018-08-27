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

use EXSyst\OpenApi\Reference;
use PHPUnit\Framework\TestCase;

class ReferenceTest extends TestCase
{
    public function testConstructor()
    {
        $object = new Reference($arr = [
            '$ref' => 'whatever',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new Reference([
            '$ref' => 'whatever',
        ]);

        $this->assertEquals('whatever', $object->getRef());

        $object->setRef('newRef');

        $this->assertEquals('newRef', $object->getRef());
    }
}
