<?php
/**
 * Created by PhpStorm.
 * Date: 23.02.2019
 * Time: 21:30
 */
namespace jnt0r\mailer;

use PHLAK\Config\Config;
use PHLAK\Config\Exceptions\InvalidContextException;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Class Mailer
 * Short description about this class.
 *
 * @package ${NAMESPACE}
 */
class Mailer
{
    /**
     * @var PHPMailer
     */
    private $mail;
    /**
     * @var Environment
     */
    private $twig;

    /**
     * Mailer constructor.
     *
     * @param string $config_file
     */
    public function __construct(string $config_file)
    {
        $config = $this->getConfiguration($config_file);
        $this->mail = new PHPMailer($config->get('debug'));
        $loader = new FilesystemLoader(dirname(realpath($config_file)) . DIRECTORY_SEPARATOR . $config->get('templates_dir'));
        $this->twig = new Environment($loader);

        $this->mail->SMTPDebug = $config->get('smtp_debug');
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = $config->get('smtp_secure');

        $this->mail->Host = $config->get('smtp_host');
        $this->mail->Port = $config->get('smtp_port');

        $this->mail->Username = $config->get('smtp_user');
        $this->mail->Password = $config->get('smtp_password');

        $this->mail->CharSet = PHPMailer::CHARSET_UTF8;
    }

    /**
     * @param Mail $mail
     *
     * @param array $params
     * @throws Exception
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function send(Mail $mail, array $params = [])
    {
        $this->mail->isHTML($mail->isHTML);
        $this->mail->Subject = $mail->getSubject();
        $this->mail->setFrom($mail->getSender()->getEmail(), $mail->getSender()->getName());

        $this->mail->addAddress($mail->getRecipient()->getEmail(), $mail->getRecipient()->getName());

        $this->mail->Body = $this->twig->render($mail->getTemplate(), $params);
        $this->mail->AltBody = $this->twig->render($mail->getAltTemplate(), $params);

        $this->mail->send();
    }

    /**
     * @param string $config_file
     *
     * @return Config
     */
    private function getConfiguration(string $config_file): Config
    {
        return new Config($config_file);
    }
}
