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

use EXSyst\OpenApi\License;
use PHPUnit\Framework\TestCase;

class LicenseTest extends TestCase
{
    public function testConstructor()
    {
        $object = new License($arr = [
            'name' => 'Apache 2.0',
            'url' => 'https://www.apache.org/licenses/LICENSE-2.0.html',
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new License($arr = [
            'name' => 'Apache 2.0',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new License($arr = [
            'name' => 'Apache 2.0',
            'url' => 'https://www.apache.org/licenses/LICENSE-2.0.html',
        ]);

        $this->assertEquals('Apache 2.0', $object->getName());
        $this->assertEquals('https://www.apache.org/licenses/LICENSE-2.0.html', $object->getUrl());

        $object->setName('foo');
        $object->setUrl(null);

        $this->assertEquals('foo', $object->getName());
        $this->assertNull($object->getUrl());
    }
}
