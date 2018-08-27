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

use EXSyst\OpenApi\ExternalDocumentation;
use PHPUnit\Framework\TestCase;

class ExternalDocumentationTest extends TestCase
{
    public function testConstructor()
    {
        $object = new ExternalDocumentation($arr = [
            'description' => 'foo',
            'url' => 'http://bar.com',
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new ExternalDocumentation($arr = [
            'url' => 'http://bar.com',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new ExternalDocumentation($arr = [
            'description' => 'foo',
            'url' => 'http://bar.com',
        ]);

        $this->assertEquals('foo', $object->getDescription());
        $this->assertEquals('http://bar.com', $object->getUrl());

        $object->setDescription(null);
        $object->setUrl('https://foo.net');

        $this->assertEquals('https://foo.net', $object->getUrl());
        $this->assertEquals(null, $object->getDescription());
    }
}
