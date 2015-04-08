<?php

namespace SocialMedia\Facebook\Types;

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use SocialMedia\Core\Types\Service as CoreService;
use SocialMedia\Core\Types\ServiceCredentials as CoreServiceCredentials;

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
        CoreServiceCredentials $credentials
    ) {
        $this->setApi($api);
        $this->setCredentials($credentials);
        $this->setName(self::NAME);
    }
}
