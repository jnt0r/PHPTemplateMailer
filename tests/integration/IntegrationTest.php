<?php
/**
 * Created by PhpStorm.
 * Date: 08.03.2019
 * Time: 16:08
 */

use jnt0r\mailer\Address;
use jnt0r\mailer\exception\InvalidEmailException;
use jnt0r\mailer\Mail;
use jnt0r\mailer\Mailer;
use PHPMailer\PHPMailer\Exception;
use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    /**
     * UnitTest test method
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     * @throws Exception
     * @throws InvalidEmailException
     */
    public function testSendMail()
    {
        $mailer = new Mailer(__DIR__ . '/../../mailer_config.json');

        $mailer->send(new Mail(
            'Testing Emails',
            new Address('test@jnt0r.com', 'Jonathan'),
            new Address('jonathan.pollert@gmx.net', 'Jonathan Pollert'),
            'Hallo, das ist eine Email!',
            'Das ist der alt Content!')
        );
    }
}
