<?php

namespace SocialMedia\Facebook\tests\Types;

// required to load
require_once __DIR__ . '/../../vendor/autoload.php';

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Facebook\Types\Service as FacebookService;
use SocialMedia\Facebook\Types\Credentials as FacebookCredentials;

/**
 * Credentials Class which contains all credentials
 * to post to the Facebook service.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class ServiceTest extends \PHPUnit_Framework_TestCase
{
    protected static $service;

    /**
     * Set up extra variables
     */
    protected function setUp()
    {
        $this->service = new FacebookService(
            array(),
            new FacebookCredentials()
        );
    }

    /**
     * Tear down after class
     */
    public function tearDown()
    {
        $this->service = null;
    }

    /**
     * Test service
     */
    public function testService()
    {
        /*
        $accessToken = 'testAccessToken';
        $this->credentials->setAccessToken($accessToken);
        $this->assertEquals($accessToken, $this->credentials->getAccessToken());
        */
    }
}
