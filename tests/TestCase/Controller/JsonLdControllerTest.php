<?php

namespace MixerApi\JsonLdView\Test\TestCase\Controller;

use Cake\TestSuite\TestCase;
use Cake\TestSuite\IntegrationTestTrait;

class JsonLdControllerTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * @var string[]
     */
    public $fixtures = [
        'plugin.MixerApi/JsonLdView.Actors',
        'plugin.MixerApi/JsonLdView.Addresses',
        'plugin.MixerApi/JsonLdView.FilmActors',
        'plugin.MixerApi/JsonLdView.Films',
    ];

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        static::setAppNamespace('MixerApi\JsonLdView\Test\App');
    }

    public function testContexts()
    {
        $this->get('/contexts/Actor');

        $body = (string)$this->_response->getBody();
        $object = json_decode($body);

        $this->assertResponseOk();
        $this->assertEquals('https://schema.org/givenName', $object->{'@context'}->first_name);
    }

    public function testVocab()
    {
        $this->get('/vocab');

        $body = (string)$this->_response->getBody();
        $object = json_decode($body);

        $this->assertResponseOk();
        $this->assertCount(3, $object->{'supportedClass'});
    }
}
