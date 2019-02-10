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

use EXSyst\OpenApi\Components;
use PHPUnit\Framework\TestCase;

class ComponentsTest extends TestCase
{
    public function testConstructor()
    {
        $object = new Components($arr = $this->getData());

        $this->assertEquals($arr, $object->toArray());

        $object = new Components();

        $this->assertEquals([], $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new Components($this->getData());

        $this->assertTrue($object->getSchemas()->has('Category'));
        $this->assertTrue($object->getParameters()->has('skipParameter'));
        $this->assertTrue($object->getResponses()->has('skipParameter'));
    }

    private function getData(): array
    {
        return [
            'schemas' => [
                'Category' => [
                    'type' => 'object',
                    'properties' => [
                        'id' => [
                            'type' => 'integer',
                            'format' => 'int64',
                        ],
                        'name' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
            'parameters' => [
                'skipParameter' => [
                    'name' => 'skip',
                    'in' => 'query',
                    'required' => true,
                    'schema' => [
                        'type' => 'integer',
                        'format' => 'int32',
                    ],
                ],
            ],
            'responses' => [
                'NotFound' => [
                    'description' => 'Entity not found.',
                ],
            ],
            'securitySchemes' => [
                'api_key' => [
                    '$ref' => 'https://example.com',
                ],
            ],
            'examples' => [
                'alice' => [
                    'value' => [
                        'Some' => 'body',
                        'once' => ['told', 'me', []],
                        'referenced' => [
                            '$ref' => 'https://example.com',
                        ],
                    ],
                ],
            ],
            'requestBodies' => [
                'foo' => [
                    'description' => 'bar',
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                '$ref' => 'https://example.com',
                            ],
                        ],
                    ],
                ],
            ],
            'headers' => [
                'Authorization' => [
                    'schema' => [
                        'type' => 'string',
                        'example' => 'Bearer asd234oijeasd',
                    ],
                ],
            ],
            'links' => [
                'Lincos' => [
                    'operationId' => 'cool_operation',
                ],
            ],
            'callbacks' => [
                'wait' => [
                    '$ref' => 'https://example.com',
                ],
            ],
        ];
    }
}
