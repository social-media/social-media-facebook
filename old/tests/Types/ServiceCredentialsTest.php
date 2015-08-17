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

use SocialMedia\Facebook\Types\Credentials as FacebookCredentials;

/**
 * Credentials Class which contains all credentials
 * to post to the Facebook service.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class CredentialsTest extends \PHPUnit_Framework_TestCase
{
    protected static $credentials;

    /**
     * Set up extra variables
     */
    protected function setUp()
    {
        $this->credentials = new FacebookCredentials();
    }

    /**
     * Tear down after class
     */
    public function tearDown()
    {
        $this->credentials = null;
    }

    /**
     * Test access token
     */
    public function testAccessToken()
    {
        $accessToken = 'testAccessToken';
        $this->credentials->setAccessToken($accessToken);
        $this->assertEquals($accessToken, $this->credentials->getAccessToken());
    }

    /**
     * Test app id
     */
    public function testAppId()
    {
        $appId = 'testAppId';
        $this->credentials->setAppId($appId);
        $this->assertEquals($appId, $this->credentials->getAppId());
    }

    /**
     * Test app secret
     */
    public function testAppSecret()
    {
        $appSecret = 'testAppSecret';
        $this->credentials->setAppSecret($appSecret);
        $this->assertEquals($appSecret, $this->credentials->getAppSecret());
    }
}
