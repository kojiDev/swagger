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

use EXSyst\OpenApi\OAuthFlow;
use EXSyst\OpenApi\OAuthFlows;
use PHPUnit\Framework\TestCase;

class OAuthFlowsTest extends TestCase
{
    public function testConstructor()
    {
        $object = new OAuthFlows($arr = [
            'implicit' => [
                'authorizationUrl' => 'https://example.com/api/oauth/dialog',
                'refreshUrl' => 'https://example.com/api/oauth/refresh',
                'scopes' => [
                    'write:post' => 'write posts',
                ],
            ],
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new OAuthFlows();

        $this->assertEquals(new \stdClass(), $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new OAuthFlows();

        $object->setPassword(null);

        $this->assertEquals(null, $object->getPassword());

        $object->setPassword($OauthFlow = new OAuthFlow([
            'tokenUrl' => 'https://example.com/api/oauth/token',
            'scopes' => [
                'write:post' => 'write posts',
            ],
        ]));

        $this->assertEquals($OauthFlow, $object->getPassword());
    }
}
