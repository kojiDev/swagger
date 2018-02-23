<?php

/*
 * This file is part of the Swagger package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\OAS\tests;

use EXSyst\OAS\OpenAPI;
use PHPUnit\Framework\TestCase;

class FullExampleTest extends TestCase
{
    public function fixtureNames(): array
    {
        return [
            ['petstore'],
            ['petstore-expanded'],
            ['api-with-examples'],
            ['callback-example'],
            ['link-example'],
            ['uspto'],
        ];
    }

    /**
     * @dataProvider fixtureNames
     *
     * @param string $fixture
     */
    public function testFullExample(string $fixture)
    {
        $data = json_decode(file_get_contents(__DIR__ . '/fixtures/' . $fixture . '.json'), true);

        $openApi = new OpenAPI($data);

        $this->assertEquals($data, $openApi->toArray());
    }
}
