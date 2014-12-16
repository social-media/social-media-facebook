<?php

namespace SocialMedia\Facebook;

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Objects\Post as Post;

/**
 * Facebook Post item
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class FacebookPost implements Post
{
    /**
     * Set message
     */
    public function setMessage($message)
    {
        $this->set('message', $message);
    }
}
