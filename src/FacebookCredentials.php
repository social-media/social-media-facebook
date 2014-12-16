<?php

namespace JeroenDesloovere\SocialMedia\Facebook;

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use JeroenDesloovere\SocialMedia\Objects\Credentials as Credentials;

/**
 * Facebook Credentials
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class FacebookCredentials implements Credentials
{
    /**
     * Access token
     *
     * @var string
     */
    protected $accessToken;

    /**
     * App id
     *
     * @var string
     */
    protected $appId;

    /**
     * App secret
     *
     * @var string
     */
    protected $appSecret;

    /**
     * Get app secret
     *
     * @return string
     */
    public function getAccessToken()
    {
       return $this->accessToken;
    }

    /**
     * Get app secret
     *
     * @return string
     */
    public function getAppId()
    {
       return $this->appId;
    }

    /**
     * Get app secret
     *
     * @return string
     */
    public function getAppSecret()
    {
        return $this->appSecret;
    }

    /**
     * Set access token
     *
     * @param string
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Set app id
     *
     * @param string
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * Set app secret
     *
     * @param string
     */
    public function setAppSecret($appSecret)
    {
        $this->appSecret = $appSecret;
    }
}
