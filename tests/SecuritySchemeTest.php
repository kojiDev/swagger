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

use EXSyst\OpenApi\OAuthFlows;
use EXSyst\OpenApi\SecurityScheme;
use PHPUnit\Framework\TestCase;

class SecuritySchemeTest extends TestCase
{
    public function testApiKey()
    {
        $object = new SecurityScheme($arr = [
            'type' => 'apiKey',
            'name' => 'Name',
            'in' => 'header',
        ]);

        $this->assertEquals('apiKey', $object->getType());

        $this->assertEquals($arr, $object->toArray());

        $object->setName($newName = 'New name');

        $this->assertEquals($newName, $object->getName());

        $object->setIn($newIn = 'query');

        $this->assertEquals($newIn, $object->getIn());
    }

    public function testHttp()
    {
        $object = new SecurityScheme($arr = [
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT',
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object->setSchema($newScheme = 'Basic');

        $this->assertEquals($newScheme, $object->getScheme());

        $object->setBearerFormat($newBearerFormat = null);

        $this->assertEquals($newBearerFormat, $object->getBearerFormat());
    }

    public function testOauth()
    {
        $object = new SecurityScheme($arr = [
            'type' => 'oauth2',
            'description' => 'Description',
            'flows' => [
                'implicit' => [
                    'authorizationUrl' => 'https://example.com/api/oauth/dialog',
                    'refreshUrl' => 'https://example.com/api/oauth/refresh',
                    'scopes' => [
                        'write:post' => 'write posts',
                    ],
                ],
            ],
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object->setDescription($newDescription = 'New description');

        $this->assertEquals($newDescription, $object->getDescription());

        $object->setFlows($oauthFlows = new OAuthFlows());

        $this->assertEquals($oauthFlows, $object->getFlows());
    }

    public function testOpenIdConnect()
    {
        $object = new SecurityScheme($arr = [
            'type' => 'openIdConnect',
            'openIdConnectUrl' => 'https://example.com/api/openid',
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object->setOpenIdConnectUrl($newUrl = 'https://example.com/api/newOpenid');

        $this->assertEquals($newUrl, $object->getOpenIdConnectUrl());
    }
}
