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
use PHPUnit\Framework\TestCase;

class OAuthFlowTest extends TestCase
{
    public function testConstructor()
    {
        $object = new OAuthFlow([
            'authorizationUrl' => 'https://example.com/api/oauth/dialog',
            'tokenUrl' => 'https://example.com/api/oauth/token',
            'scopes' => [
                'post:read' => 'read posts',
            ],
        ]);

        $this->assertEquals([
            'authorizationUrl' => 'https://example.com/api/oauth/dialog',
            'tokenUrl' => 'https://example.com/api/oauth/token',
            'scopes' => [
                'post:read' => 'read posts',
            ],
        ], $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new OAuthFlow([
            'authorizationUrl' => 'https://example.com/api/oauth/dialog',
            'tokenUrl' => 'https://example.com/api/oauth/token',
            'refreshUrl' => 'https://example.com/api/oauth/refresh',
            'scopes' => [
                'post:read' => 'read posts',
            ],
        ]);

        $this->assertEquals('https://example.com/api/oauth/dialog', $object->getAuthorizationUrl());
        $this->assertEquals('https://example.com/api/oauth/token', $object->getTokenUrl());
        $this->assertEquals('https://example.com/api/oauth/refresh', $object->getRefreshUrl());
        $this->assertEquals([
            'post:read' => 'read posts',
        ], $object->getScopes());

        $object->setAuthorizationUrl('https://example.com/api/oauth/newDialog');
        $object->setTokenUrl('https://example.com/api/oauth/newToken');
        $object->setRefreshUrl('https://example.com/api/oauth/newRefresh');
        $object->setScopes([
            'post:write' => 'write posts',
        ]);

        $this->assertEquals('https://example.com/api/oauth/newDialog', $object->getAuthorizationUrl());
        $this->assertEquals('https://example.com/api/oauth/newToken', $object->getTokenUrl());
        $this->assertEquals('https://example.com/api/oauth/newRefresh', $object->getRefreshUrl());
        $this->assertEquals([
            'post:write' => 'write posts',
        ], $object->getScopes());
    }
}
