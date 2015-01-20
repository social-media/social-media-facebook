<?php

namespace SocialMedia\Facebook\tests\Actions;

// required to load
require_once __DIR__ . '/../../vendor/autoload.php';

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Facebook\Actions\Publish as FacebookPublish;
use SocialMedia\Facebook\Objects\Credentials as FacebookCredentials;
use SocialMedia\Facebook\Objects\Service as FacebookService;
use SocialMedia\Facebook\Objects\Post as FacebookPost;

/**
 * The Publish Class publishes a post to Facebook.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class PublishTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Set up extra variables
     */
    protected function setUp()
    {
        $this->service = new FacebookService(
            array(),
            new FacebookCredentials()
        );
        $this->post = new FacebookPost();
    }

    /**
     * Tear down after class
     */
    public function tearDown()
    {
        $this->service = $this->post = null;
    }

    /**
     * Test publish
     */
    public function testPublish()
    {
        return true;
    }
}