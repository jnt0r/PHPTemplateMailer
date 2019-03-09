<?php
/**
 * Created by PhpStorm.
 * Date: 23.02.2019
 * Time: 21:35
 */

use jnt0r\mailer\exception\InvalidEmailException;
use jnt0r\mailer\Mail;
use jnt0r\mailer\Mailer;
use jnt0r\mailer\Address;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var MockObject|PHPMailer
     */
    private $mailerMock;

    /**
     * @var Address
     */
    private $anySender;
    /**
     * @var Address
     */
    private $anyRecipient;

    /**
     * UnitTest test method
     *
     * @throws Exception
     * @throws Twig_Error_Loader
     * @throws Twig_Error_Runtime
     * @throws Twig_Error_Syntax
     */
    public function testSendMethodGetsCalled()
    {
        $this->mailerMock->expects(self::once())->method('send');

        $mail = new Mail('AnySubject', $this->anySender, $this->anyRecipient, 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     */
    public function testSubjectGetsSetWhenSendingEmail()
    {
        $mail = new Mail('AnySubject', $this->anySender, $this->anyRecipient, 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);

        self::assertEquals('AnySubject', $this->mailerMock->Subject);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     * @throws InvalidEmailException
     */
    public function testSenderEmailGetsSetWhenSendingEmail()
    {
        $this->mailerMock->expects(self::once())->method('setFrom')->with('email@example.com');

        $mail = new Mail('AnySubject', new Address('email@example.com'), $this->anyRecipient, 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     * @throws InvalidEmailException
     */
    public function testSenderEmailAndNameGetsSetWhenSendingEmail()
    {
        $this->mailerMock->expects(self::once())->method('setFrom')->with('email@example.com', 'AnyName');

        $mail = new Mail('AnySubject', new Address('email@example.com', 'AnyName'), $this->anyRecipient, 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     * @throws InvalidEmailException
     */
    public function testRecipientEmailGetsSetWhenSendingEmail()
    {
        $this->mailerMock->expects(self::once())->method('addAddress')->with('any@example.com');

        $mail = new Mail('AnySubject', $this->anySender, new Address('any@example.com'), 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     * @throws InvalidEmailException
     */
    public function testRecipientEmailAndNameGetsSetWhenSendingEmail()
    {
        $this->mailerMock->expects(self::once())->method('addAddress')->with('any@example.com', 'AnyName');

        $mail = new Mail('AnySubject', $this->anySender, new Address('any@example.com', 'AnyName'), 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     */
    public function testSetHTMLEmailWhenMailIsHTML()
    {
        $this->mailerMock->expects(self::once())->method('isHTML')->with(true);

        $mail = new Mail('AnySubject', $this->anySender, $this->anyRecipient, 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     */
    public function testSetHTMLEmailToFalseWhenMailIsNotHTML()
    {
        $this->mailerMock->expects(self::once())->method('isHTML')->with(false);

        $mail = new Mail('AnySubject', $this->anySender, $this->anyRecipient, 'email_test_html.tpl', 'email_test_alt.tpl');
        $mail->isHTML = false;

        $this->mailer->send($mail);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     */
    public function testContentGetsSetWhenSendingEmail()
    {
        $mail = new Mail('AnySubject', $this->anySender, $this->anyRecipient, 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);

        self::assertEquals('Any Content to display as email message.', $this->mailerMock->Body);
    }

    /**
     * UnitTest test method
     *
     * @throws Exception
     */
    public function testAltContentGetsSetWhenSendingEmail()
    {
        $mail = new Mail('AnySubject', $this->anySender, $this->anyRecipient, 'email_test_html.tpl', 'email_test_alt.tpl');

        $this->mailer->send($mail);

        self::assertEquals('Any AltContent to display as email message.', $this->mailerMock->AltBody);
    }

    /**
     * @throws ReflectionException
     * @throws InvalidEmailException
     * @throws \PHLAK\Config\Exceptions\InvalidContextException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->anySender = new Address('any@example.com');
        $this->anyRecipient = new Address('any@example.com');

        $this->mailerMock = $this->getMockBuilder(PHPMailer::class)->disableOriginalConstructor()->setMethodsExcept([])->getMock();

        $this->mailer = new Mailer(__DIR__ . '/../../mailer_config.json');

        $property = new ReflectionProperty(Mailer::class, 'mail');
        $property->setAccessible(true);
        $property->setValue($this->mailer, $this->mailerMock);
    }
}
