<?php
/**
 * Created by PhpStorm.
 * Date: 23.02.2019
 * Time: 19:58
 */

namespace jnt0r\mailer;

use jnt0r\mailer\exception\InvalidEmailException;

/**
 * Class Recipient
 * Short description about this class.
 *
 * @package jnt0r\mailer
 */
class Address
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $name;

    /**
     * Recipient constructor.
     *
     * @param string $email
     * @param string $name
     *
     * @throws InvalidEmailException
     */
    public function __construct(string $email, string $name = '')
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException($email);
        }
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}