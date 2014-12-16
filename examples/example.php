<?php

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use JeroenDesloovere\SocialMedia\Facebook\Objects\Post as FacebookPost;
use JeroenDesloovere\SocialMedia\Facebook\Objects\Service as FacebookService;

// define api
$api = new SocialMedia();

use SocialMedia\SocialMedia as SocialMedia;
use SocialMedia\Facebook\Objects\Post as FacebookPost;
use SocialMedia\Facebook\Objects\Service as FacebookService;

// define api
$api = new SocialMedia();

// define external post objects
$post = new FacebookPost();
$credentials = new FacebookCredentials();
$api = array(); // todo
$service = new FacebookService($api, $credentials);

// (un)publish a message
$api->getTimeline()->publish($service, $post);
$api->getTimeline()->unpublish($service, $post);

