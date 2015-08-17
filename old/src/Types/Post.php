<?php

namespace SocialMedia\Facebook\Types;

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Core\Types\Post as CorePost;

/**
 * Facebook Post
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class Post extends CorePost
{
    const KEY_FOR_MESSAGE = 'message';

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->get(self::KEY_FOR_MESSAGE);
    }

    /**
     * Set message
     *
     * @param string
     */
    public function setMessage($message)
    {
        $this->set(self::KEY_FOR_MESSAGE, $message);
    }
}
