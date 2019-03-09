<?php
/**
 * Created by PhpStorm.
 * Date: 08.03.2019
 * Time: 16:08
 */

use PHPUnit\Framework\TestCase;

class IntegrationTest extends TestCase
{
    /**
     * UnitTest test method
     * @throws \jnt0r\mailer\exception\InvalidEmailException
     * @throws \PHPMailer\PHPMailer\Exception
     * @throws \PHLAK\Config\Exceptions\InvalidContextException
     */
    public function testSendMail()
    {
        $mailer = new \jnt0r\mailer\Mailer(__DIR__ . '/../../mailer_config.json');

        $mailer->send(new \jnt0r\mailer\Mail('Testing Emails', new \jnt0r\mailer\Address('test@jnt0r.com', 'Jonathan'), new \jnt0r\mailer\Address('jonathan.pollert@gmx.net', 'Jonathan Pollert'), 'Hallo, das ist eine Email!', 'Das ist der alt Content!'));
    }
}
