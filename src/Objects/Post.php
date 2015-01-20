<?php

namespace SocialMedia\Facebook\Objects;

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Core\Objects\Post as CorePost;

/**
 * Facebook Post
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class Post extends CorePost
{
    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        $this->get('message');
    }

    /**
     * Set message
     *
     * @param string
     */
    public function setMessage($message)
    {
        $this->set('message', $message);
    }
}
