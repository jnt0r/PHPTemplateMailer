<?php
/**
 * Created by PhpStorm.
 * Date: 23.02.2019
 * Time: 19:45
 */

namespace jnt0r\mailer;

/**
 * Class Mail
 * Short description about this class.
 *
 * @package jnt0r\mailer
 */
class Mail
{
    /**
     * @var bool
     */
    public $isHTML = true;
    /**
     * @var string
     */
    private $subject;
    /**
     * @var Address
     */
    private $sender;
    /**
     * @var Address
     */
    private $recipient;
    /**
     * @var string
     */
    private $template;
    /**
     * @var string
     */
    private $altTemplate;

    /**
     * Mail constructor.
     *
     * @param string $subject
     * @param Address $sender
     * @param Address $recipient
     * @param string $template
     * @param string $altTemplate
     */
    public function __construct(string $subject, Address $sender, Address $recipient, string $template, string $altTemplate)
    {
        $this->subject = $subject;
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->template = $template;
        $this->altTemplate = $altTemplate;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @return Address
     */
    public function getSender(): Address
    {
        return $this->sender;
    }

    /**
     * @return Address
     */
    public function getRecipient(): Address
    {
        return $this->recipient;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template;
    }

    /**
     * @return string
     */
    public function getAltTemplate(): string
    {
        return $this->altTemplate;
    }
}