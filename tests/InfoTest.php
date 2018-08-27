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
use EXSyst\OpenApi\Info;
use EXSyst\OpenApi\License;
use PHPUnit\Framework\TestCase;

class InfoTest extends TestCase
{
    public function testConstructor()
    {
        $object = new Info($arr = [
            'title' => 'My API',
            'description' => 'Victrixs sunt turpiss de talis byssus.',
            'termsOfService' => 'Apolloniates trabems, tanquam domesticus extum.',
            'contact' => [
                'name' => 'Bob',
            ],
            'license' => [
                'name' => 'MIT',
            ],
            'version' => '1.0.2',
        ]);

        $this->assertEquals($arr, $object->toArray());

        $object = new Info($arr = [
            'title' => 'His API',
            'version' => '1.0.3',
        ]);

        $this->assertEquals($arr, $object->toArray());
    }

    public function testGettersAndSetters()
    {
        $object = new Info($arr = [
            'title' => $title = 'My API',
            'description' => $description = 'Victrixs sunt turpiss de talis byssus.',
            'termsOfService' => $terms = 'Apolloniates trabems, tanquam domesticus extum.',
            'contact' => [
                'name' => 'Bob',
            ],
            'license' => [
                'name' => 'MIT',
            ],
            'version' => '1.0.2',
        ]);

        $this->assertEquals($title, $object->getTitle());
        $this->assertEquals($description, $object->getDescription());
        $this->assertEquals($terms, $object->getTermsOfService());
        $this->assertEquals('Bob', $object->getContact()->getName());
        $this->assertEquals('MIT', $object->getLicense()->getName());
        $this->assertEquals('1.0.2', $object->getVersion());

        $object->setTitle('His API');
        $object->setDescription('Ho');
        $object->setTermsOfService('Ha');
        $object->setContact(new Contact(['name' => 'Alice']));
        $object->setLicense(new License(['name' => 'Some']));
        $object->setVersion('1.0.3');

        $this->assertEquals('His API', $object->getTitle());
        $this->assertEquals('Ho', $object->getDescription());
        $this->assertEquals('Ha', $object->getTermsOfService());
        $this->assertEquals('Alice', $object->getContact()->getName());
        $this->assertEquals('Some', $object->getLicense()->getName());
        $this->assertEquals('1.0.3', $object->getVersion());
    }
}
