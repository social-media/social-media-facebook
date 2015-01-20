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

use SocialMedia\Core\SocialMedia as SocialMedia;
use SocialMedia\Facebook\Actions\Unpublish as FacebookUnpublish;
use SocialMedia\Facebook\Objects\Credentials as FacebookCredentials;
use SocialMedia\Facebook\Objects\Service as FacebookService;
use SocialMedia\Facebook\Objects\Post as FacebookPost;

/**
 * The Unpublish Class unpublishes a post from Facebook.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class UnpublishTest extends \PHPUnit_Framework_TestCase
{
    protected static $api;

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
     * Set up before class
     *
     * @return SocialMedia
     */
    public static function setUpBeforeClass()
    {
        self::$api = new SocialMedia();
    }

    /**
     * Tear down after class
     */
    public function tearDown()
    {
        $this->service = $this->post = null;
    }

    /**
     * Tear down after class
     */
    public static function tearDownAfterClass()
    {
        self::$api = null;
    }

    /**
     * Test unpublish
     */
    public function testUnpublish()
    {
        self::$api->getTimeline()->unpublish($this->service, $this->post);
    }
}
