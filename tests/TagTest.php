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
use EXSyst\OpenApi\Tag;
use PHPUnit\Framework\TestCase;

class TagTest extends TestCase
{
    public function testConstructor()
    {
        $object = new Tag($arr = [
            'name' => 'pet',
            'description' => 'Pets operations',
            'externalDocs' => [
                'url' => 'http://bar.com',
            ],
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new Tag($arr = [
            'name' => 'pet',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new Tag([
            'name' => 'pet',
            'description' => 'Pets operations',
            'externalDocs' => $docs = [
                'url' => 'http://bar.com',
            ],
        ]);

        $this->assertEquals('pet', $object->getName());
        $this->assertEquals('Pets operations', $object->getDescription());
        $this->assertEquals('http://bar.com', $object->getExternalDocs()->getUrl());

        $object->setName('human');
        $object->setDescription(null);
        $object->setExternalDocs(new ExternalDocumentation([
            'url' => 'http://foo.com',
        ]));

        $this->assertEquals('human', $object->getName());
        $this->assertNull($object->getDescription());
        $this->assertEquals('http://foo.com', $object->getExternalDocs()->getUrl());
    }
}
