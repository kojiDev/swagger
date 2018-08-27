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

use EXSyst\OpenApi\Discriminator;
use PHPUnit\Framework\TestCase;

class DiscriminatorTest extends TestCase
{
    public function testConstructor()
    {
        $object = new Discriminator($arr = [
            'propertyName' => 'pet_type',
            'mapping' => [
                'dog' => '#/components/schemas/Dog',
            ],
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new Discriminator($arr = [
            'propertyName' => 'pet_type',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new Discriminator([
            'propertyName' => 'pet_type',
            'mapping' => [
                'dog' => '#/components/schemas/Dog',
            ],
        ]);

        $this->assertEquals('pet_type', $object->getPropertyName());
        $this->assertEquals([
            'dog' => '#/components/schemas/Dog',
        ], $object->getMapping());

        $object->setPropertyName('human_type');
        $object->setMapping([]);

        $this->assertEquals('human_type', $object->getPropertyName());
        $this->assertEquals([], $object->getMapping());
    }
}
