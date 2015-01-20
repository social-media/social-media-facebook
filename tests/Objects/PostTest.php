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

use SocialMedia\Facebook\Objects\Post as FacebookPost;

/**
 * Post Class which contains all the post
 * to post to the Facebook service.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class PostTest extends \PHPUnit_Framework_TestCase
{
    protected static $post;

    /**
     * Set up extra variables
     */
    protected function setUp()
    {
        $this->post = new FacebookPost();
    }

    /**
     * Tear down after class
     */
    public function tearDown()
    {
        $this->post = null;
    }

    /**
     * Test message
     */
    public function testMessage()
    {
        $message = "This message will be posted on FB.";
        $this->post->setMessage($message);
        $this->assertEquals($message, $this->post->getMessage());
    }
}
