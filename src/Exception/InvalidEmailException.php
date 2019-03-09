<?php
/**
 * Created by PhpStorm.
 * Date: 23.02.2019
 * Time: 20:43
 */

namespace jnt0r\mailer\exception;

use Exception;

/**
 * Class InvalidEmailException
 * Short description about this class.
 *
 * @package jnt0r\mailer\exception
 */
class InvalidEmailException extends Exception
{
    public function __construct(string $email)
    {
        parent::__construct("Invalid Email! '$email' is not a valid email.");
    }
}