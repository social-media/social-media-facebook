<?php

namespace SocialMedia\Facebook\Objects;

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Core\Objects\Service as CoreService;

/**
 * The Facebook Service
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class Service extends CoreService
{
    const NAME = 'Facebook';

    /**
     * Construct
     */
    public function __construct(
        $api,
        Credentials $credentials
    ) {
        $this->setApi($api);
        $this->setCredentials($credentials);
        $this->setServiceName(self::NAME);
    }
}
