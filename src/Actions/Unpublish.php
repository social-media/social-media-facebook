<?php

namespace SocialMedia\Facebook\Actions;

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Facebook\Types\Service as FacebookService;
use SocialMedia\Facebook\Types\Post as FacebookPost;

/**
 * Unpublish Post from Facebook.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class Unpublish
{
    /**
     * Construct
     *
     * @param FacebookService $service
     * @param FacebookPost $post
     */
    public function __construct(
        FacebookService $service,
        FacebookPost $post
    ) {
    }
}
