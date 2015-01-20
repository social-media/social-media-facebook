<?php

namespace SocialMedia\Facebook\tests\Objects;

// required to load
require_once __DIR__ . '/../../vendor/autoload.php';

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Facebook\Objects\Credentials;

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
        $this->credentials = new Credentials();
    }

    /**
     * Tear down after class
     */
    public function tearDown()
    {
        $this->credentials = null;
    }

    /**
     * @expectedException Exception
     */
    public function testCredentials()
    {
        throw new Exception('error');
    }
}
