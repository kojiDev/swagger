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

use EXSyst\OpenApi\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function testConstructor()
    {
        $object = new Contact($arr = [
            'name' => 'Alice',
            'url' => 'https://alice.com',
            'email' => 'alice@mail.com',
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new Contact();

        $this->assertEquals([], $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new Contact($arr = [
            'name' => 'Alice',
            'url' => 'https://alice.com',
            'email' => 'alice@mail.com',
        ]);

        $this->assertEquals('Alice', $object->getName());
        $this->assertEquals('https://alice.com', $object->getUrl());
        $this->assertEquals('alice@mail.com', $object->getEmail());

        $object->setName('foo');
        $object->setUrl(null);
        $object->setEmail(null);

        $this->assertEquals('foo', $object->getName());
        $this->assertNull($object->getUrl());
        $this->assertNull($object->getEmail());
    }
}
