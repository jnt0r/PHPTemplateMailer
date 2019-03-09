<?php
/**
 * Created by PhpStorm.
 * Date: 23.02.2019
 * Time: 19:59
 */

use jnt0r\mailer\exception\InvalidEmailException;
use jnt0r\mailer\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    /**
     * UnitTest test method
     *
     * @throws InvalidEmailException
     */
    public function testCreateAddressWithEmailOnly()
    {
        $recipient = new Address('mail@example.com');

        self::assertEquals('mail@example.com', $recipient->getEmail());
        self::assertEquals('', $recipient->getName());
    }

    /**
     * UnitTest test method
     *
     * @throws InvalidEmailException
     */
    public function testCreateAddressWithEmailAndName()
    {
        $recipient = new Address('mail@example.com', 'AnyName');

        self::assertEquals('mail@example.com', $recipient->getEmail());
        self::assertEquals('AnyName', $recipient->getName());
    }

    /**
     * UnitTest test method
     *
     * @throws InvalidEmailException
     */
    public function testThrowInvalidEmailExceptionWhenEmailIsInvalid()
    {
        $this->expectException(InvalidEmailException::class);

        new Address('anyInvalidEmail');
    }

    /**
     * UnitTest test method
     *
     * @throws InvalidEmailException
     */
    public function testThrowInvalidEmailExceptionWhenEmailIsEmpty()
    {
        $this->expectException(InvalidEmailException::class);

        new Address('');
    }

    protected function setUp(): void
    {
        parent::setUp();
    }
}
