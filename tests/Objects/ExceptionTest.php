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

use SocialMedia\Facebook\Objects\Exception as FacebookException;

/**
 * Exception Class which throws a Facebook exception.
 *
 * @author Jeroen Desloovere <info@jeroendesloovere.be>
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Exception
     */
    public function testException()
    {
        throw new FacebookException('Exception correctly thrown in our test.');
    }
}
