<?php

namespace JeroenDesloovere\SocialMedia\Facebook;

/*
 * This file is part of the Social Pushing from Jeroen Desloovere.
 *
 * For the full copyright and license information, please view the license
 * file that was distributed with this source code.
 */

use JeroenDesloovere\SocialMedia\Objects\Service as Service;

/**
 * In this file we store all generic functions that we will be using for Facebook.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class FacebookService implements Service
{
    /**
     * Facebook object - default false
     *
     * @var	Facebook
     */
    protected static $facebook;

    /**
     * Facebook object.
     *
     * @var	Facebook
     */
    protected static $facebookUserAccounts;

    /**
     * Get the disconnect url - Disconnects this app from Facebook.
     *
     * @return string
     */
    public static function getDisconnectUrl()
    {
        return BackendModel::createURLForAction('facebook_disconnect');
    }

    /**
     * Get the twitter object. If it does not exists yet it will be created.
     *
     * @return Twitter
     */
    public static function getInstance($publishAction = false)
    {
        // first time
        if (!isset(self::$facebook)) {
            // lazy load the facebook external class
            require_once PATH_WWW . '/library/external/facebook.php';

            // get variables
            $appSecret = BackendModel::getModuleSetting('core', 'facebook_app_secret');
            $appId = BackendModel::getModuleSetting('core', 'facebook_app_id');
            $accessToken = BackendModel::getModuleSetting('social_media', 'facebook_access_token');
            $wallId = BackendModel::getModuleSetting('social_media', 'facebook_wall_id');
            $wallAccessToken = BackendModel::getModuleSetting('social_media', 'facebook_wall_access_token');

            // stop here
            if(!$appSecret || !$appId) return false;

            // create facebook object
            self::$facebook = new Facebook(array(
               'appId' => $appId,
               'secret' => $appSecret,
               'cookie' => true
            ));

            // do we already have access token? Yes, set it, so we can skip the fase to get one.
            if ($accessToken) {
                // set access token for user
                self::$facebook->setAccessToken($accessToken);
            }

            // when publishing something, we need to use the access token for the user or page
            if ($publishAction && isset($wallAccessToken)) {
                // set access token for user or page
                self::$facebook->setAccessToken($wallAccessToken);
            }
        }

        // cough instance up
        return self::$facebook;
    }

    /**
     * Get user
     *
     * @return array
     */
    public static function getUser()
    {
        // get facebook
        $facebook = self::getInstance();

        // stop here
        if(!$facebook) return false;

        // is loggedIn
        if ($facebook->getUser()) {
            $profile = $facebook->api(
               '/me',
               'GET',
               array(
                  'access_token' => $facebook->getAccessToken()
               )
            );

            return $profile;
        } else return false;
    }

    /**
     * Get user account access token
     *
     * @return array
     */
    public static function getUserAccountAccessToken($id)
    {
        return self::$facebookUserAccounts[$id]['access_token'];
    }

    /**
     * Gets the possible accounts to publish from
     *
     * @param  array $facebookUser Contains 'id' and 'name'.
     * @return array $ddmValues
     */
    public static function getUserAccountsForDropdown($facebookUser)
    {
        // init
        $ddmValues = array();

        // get facebook
        $facebook = self::getInstance();

        // is loggedIn
        if ($facebookUser) {
            // add user
            $ddmValues[$facebookUser['id']] = $facebookUser['name'] . ' (' . BL::lbl('profile') . ')';
            $userAccounts[$facebookUser['id']] = array('name' => $facebookUser['name'], 'access_token' => $facebook->getAccessToken());

            // get possible accounts to publish from
            $accounts = $facebook->api(
               '/me/accounts',
               'GET',
               array(
                  'access_token' => $facebook->getAccessToken()
               )
            );

            // loop all accounts
            foreach ($accounts['data'] as $account) {
                // only use pages, deny applications
                if ($account['category'] != 'Application') {
                    $ddmValues[$account['id']] = $account['name'] . ' (' . BL::lbl('page') . ')';
                    $userAccounts[$account['id']] = array('name' => $account['name'], 'access_token' => $account['access_token']);
                }
            }

            // define facebook user accounts
            self::$facebookUserAccounts = $userAccounts;
        }

        // return dropdown values
        return $ddmValues;
    }

    /**
     * Is connected to Facebook?
     *
     * @return bool
     */
    public static function isConnected()
    {
        // is correct user
        return (bool) self::getUser();
    }

    /**
     * Unpublish from Facebook
     *
     * @param  mixed $post The Facebook post contains 'id', 'type' and 'media'[optional]
     * @return bool
     */
    public static function unpublish($post)
    {
        // init Facebook
        $facebook = self::getInstance(true);

        // FB not initialised, stop here
        if(!$facebook) return true;

        // create log
        if(SPOON_DEBUG) $log = new SpoonLog('custom', BACKEND_CACHE_PATH . '/logs/social_media');
        if(SPOON_DEBUG) $log->write('Starting unpublish function for FB.');

        // deleting item
        if ($post['type'] == 'item') {
            // delete from Facebook
            $facebook->api('/' . $post['id'], 'DELETE');
        }

        // deleting album
        elseif ($post['type'] == 'album') {
            // loop all media
            foreach ($post['media'] as $item) {
                try {
                    // delete image from Facebook
                    $facebook->api('/' . $post['id'] . '/photos/' . $item['post_id'], 'DELETE');

                    // log
                    if(SPOON_DEBUG) $log->write('Album (' . $post['id']. '): deleting image ' . $item['post_id'] . '.');
                }

                // fetch error
                catch(Exception $e) {
                    // log
                    if(SPOON_DEBUG) $log->write('Can not delete photo (' . $item['post_id'] . ') from album (' . $post['id']. ').');
                }
            }

            // delete album from Facebook
            $facebook->api('/' . $post['id'], 'DELETE');

            // log
            if(SPOON_DEBUG) $log->write('Deleting album ' . $post['id']. '.');
        }

        // always return true
        return true;
    }

    /**
     * Publish to Facebook
     *
     * @param string           $title The title for the item, this becomes the message in the FB post.
     * @param string[optional] $url   You can add an url to the page on the website.
     * @param mixed[optional]  $media You can add one image, or multiple images like this:
     *                                array(array('id' => X, 'title' => 'X', 'full_url' => X)).
     */
    public static function publish($title, $url = null, $media = null)
    {
        // init Facebook
        $facebook = self::getInstance(true);

        // no Facebook initialised, stop here
        if(!$facebook) return true;

        // create log
        if(SPOON_DEBUG) $log = new SpoonLog('custom', BACKEND_CACHE_PATH . '/logs/social_media');
        if(SPOON_DEBUG) $log->write('Starting publish function for FB.');

        // type for the post (album or title)
        $type = ($media && is_array($media)) ? 'album' : 'item';

        /*
         * Facebook only shows 3 images as an album, the other images get uploaded as separate items
         * and that sucks, so we push as an item instead of an album.
         * This can be deleted when Facebook decides to show albums with 1 or 2 images properly.
         */
        if ($type == 'album' && count($media) < 3) {
            // redefine as item
            $type = 'item';

            // get first image
            $media = SITE_URL . $media[0]['full_url'];
        }

        // init parameters
        $parameters = array();

        // set parameters
        $parameters['access_token'] = $facebook->getAccessToken();

        // we should post as an item
        if ($type == 'item') {
            // add message
            $parameters['message'] = (string) $title;

            // add url if we have one (when SPOON_DEBUG = true, we don't have an url)
            if($url) $parameters['link'] = (string) $url;

            // set image if we have one (when SPOON_DEBUG = true, results that FB uses picture as link)
            if($media) $parameters['picture'] = (string) $media;

            // define optional values
            $parameters['description'] = BackendModel::getModuleSetting('social_media', 'facebook_default_description', ' ');

            // logging when we are in debugmode
            if(SPOON_DEBUG) $log->write('Social media prepared a post: (' . serialize($parameters) . ').');

            // post using Facebook
            $post = $facebook->api('/me/feed', 'POST', $parameters);

            // return
            return array('id' => $post['id'], 'type' => $type);
        }

        // we should post as an album with multiple images
        elseif ($type == 'album') {
            // at the time of writing it is necessary to enable upload support in the Facebook SDK
            $facebook->setFileUploadSupport(true);

            // define more info message only when we have an url
            $msgMoreInfo = ($url) ? BL::lbl('FacebookAlbumMoreInfo') . ': ' . (string) $url : '';

            // create an album
            $parameters['message'] = SpoonFilter::ucfirst($msgMoreInfo);
            $parameters['name'] = (string) $title;

            // post album to Facebook
            $postedAlbum = $facebook->api('/me/albums', 'POST', $parameters);

            // get album ID of the album you've just created
            $albumId = $postedAlbum['id'];

            // init album media
            $albumMedia = array();

            // logging when we are in debugmode
            if(SPOON_DEBUG) $log->write('Social Media Facebook album posted: (' . serialize($postedAlbum) . ').');

            // loop all media
            foreach ($media as $image) {
                // init photo
                $photo = array();

                // define variables
                $photo['access_token'] = $facebook->getAccessToken();
                $photo['message'] = (string) $image['title'] . (($msgMoreInfo) ? ', ' . $msgMoreInfo : '');
                $photo['image'] = '@' . FRONTEND_FILES_PATH . str_replace('/frontend/files', '', (string) $image['full_url']);

                try {
                    // post photo to Facebook in created album
                    $postedPhoto = $facebook->api('/' . $albumId . '/photos', 'POST', $photo);

                    // add photo to album media
                    $albumMedia[(int) $image['id']] = array('id' => $postedPhoto['id'], 'post_id' => $postedPhoto['post_id']);
                } catch (Exception $e) {
                    // logging when we are in debugmode
                    if(SPOON_DEBUG) $log->write('Error when posting image to album: (' . serialize($e) . ').');
                }
            }

            // return
            return array('id' => $albumId, 'type' => $type, 'media' => $albumMedia);
        }
    }
}
