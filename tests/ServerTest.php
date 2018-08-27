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

use EXSyst\OpenApi\Collections\ServerVariables;
use EXSyst\OpenApi\Server;
use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase
{
    public function testConstructor()
    {
        $object = new Server($arr = [
            'url' => 'https://{username}.gigantic-server.com',
            'description' => 'foo',
            'variables' => [
                'username' => [
                    'default' => 'admin',
                ],
            ],
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new Server($arr = [
            'url' => 'https://gigantic-server.com',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new Server($arr = [
            'url' => 'https://{username}.gigantic-server.com',
            'description' => 'foo',
            'variables' => [
                'username' => [
                    'default' => 'admin',
                ],
            ],
        ]);

        $this->assertEquals('https://{username}.gigantic-server.com', $object->getUrl());
        $this->assertEquals('foo', $object->getDescription());
        $this->assertEquals('admin', $object->getVariables()->get('username')->getDefault());

        $object->setDescription(null);
        $this->assertNull($object->getDescription());

        $object->setUrl($url = 'http://foo.bar');
        $this->assertEquals($url, $object->getUrl());

        $object->setVariables(new ServerVariables([
            'username' => [
                'default' => 'user',
            ],
        ]));
        $this->assertEquals('user', $object->getVariables()->get('username')->getDefault());
    }
}
