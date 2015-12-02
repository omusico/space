<?php

namespace ApplicationTest\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class SpaceRestfulControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $applicationConfig = require(__DIR__ . '/../../../../../config/application.config.php');
        $this->setApplicationConfig($applicationConfig);

        parent::setUp();
    }

    public function testGetList()
    {
        $this->dispatch('/api/spaces', 'GET');
        /** @var Response $response */
        $response = $this->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('', $response->getContent());
    }
}
