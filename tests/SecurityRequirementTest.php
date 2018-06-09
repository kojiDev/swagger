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

use EXSyst\OpenApi\SecurityRequirement;
use PHPUnit\Framework\TestCase;

class SecurityRequirementTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage SecurityRequirement has to has at least one requirement
     */
    public function testEmptyConstructor()
    {
        new SecurityRequirement([]);
    }

    public function testConstructor()
    {
        $object = new SecurityRequirement([
            'userOauth' => ['post:read'],
            'adminJwt'  => [],
        ]);

        $this->assertEquals([
            'userOauth' => ['post:read'],
            'adminJwt'  => [],
        ], $object->toArray());
    }

    public function testGetMethod()
    {
        $object = new SecurityRequirement([
            'userOauth' => ['post:read'],
            'adminJwt'  => [],
        ]);

        $this->assertEquals(['post:read'], $object->get('userOauth'));

        $this->assertNull($object->get('guest'));
    }

    public function testSetMethod()
    {
        $object = new SecurityRequirement([
            'userOauth' => ['post:read'],
        ]);

        $object->set('userJwt', []);

        $this->assertEquals([], $object->get('userJwt'));
    }

    // TODO: Check if we pass invalid scope array. May be make a simple VO
    // TODO: Validate that is references existing SecurityScheme
}
